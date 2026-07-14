<?php
require_once __DIR__ . '/../../includes/helpers.php';
require_once __DIR__ . '/../../config/db.php';

set_error_handler(function ($severity, $message, $file, $line) {
    throw new ErrorException($message, 0, $severity, $file, $line);
});

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        respond(false, 'Invalid request method.', [], 405);
    }

    requireAdmin();
    $current_admin_id = $_SESSION['admin_id'];

    $body = getRequestBody();
    $complaint_id = (int)($body['complaint_id'] ?? 0);
    $message = cleanStr($body['message'] ?? '');
    $is_internal = !empty($body['is_internal']) ? 1 : 0;
    // Matches the ACTUAL live schema's ENUM: ('new','in_progress','resolved','closed','rejected')
    $new_status = cleanStr($body['status'] ?? '');
    $valid_statuses = ['new', 'in_progress', 'resolved', 'rejected', 'closed'];

    if ($complaint_id === 0) {
        respond(false, 'Complaint ID is required.', [], 400);
    }
    if ($message === '' && $new_status === '') {
        respond(false, 'Enter a message or choose a new status.', [], 422);
    }
    if ($new_status !== '' && !in_array($new_status, $valid_statuses, true)) {
        respond(false, 'Invalid status.', [], 422);
    }

    $check = $pdo->prepare('SELECT id, taxpayer_id, status FROM complaints WHERE id = ?');
    $check->execute([$complaint_id]);
    $complaint = $check->fetch();

    if (!$complaint) {
        respond(false, 'Complaint not found.', [], 404);
    }

    // Log the response, if one was written.
    if ($message !== '') {
        $stmt = $pdo->prepare(
            'INSERT INTO complaint_responses (complaint_id, admin_id, message, is_internal)
             VALUES (?, ?, ?, ?)'
        );
        $stmt->execute([$complaint_id, $current_admin_id, $message, $is_internal]);
    }

    // Update status, if a new one was chosen and it's actually different.
    $statusChanged = $new_status !== '' && $new_status !== $complaint['status'];
    if ($statusChanged) {
        if (in_array($new_status, ['resolved', 'rejected', 'closed'], true)) {
            $update = $pdo->prepare('UPDATE complaints SET status = ?, resolved_at = NOW() WHERE id = ?');
        } else {
            $update = $pdo->prepare('UPDATE complaints SET status = ?, resolved_at = NULL WHERE id = ?');
        }
        $update->execute([$new_status, $complaint_id]);
    }

    // Notify the taxpayer if there's something worth telling them: a
    // visible (non-internal) reply, or a status change.
    if (($message !== '' && !$is_internal) || $statusChanged) {
        $ref = 'CPL-' . str_pad($complaint_id, 6, '0', STR_PAD_LEFT);
        if ($statusChanged) {
            $title = 'Complaint Status Updated';
            $body_text = "Complaint #{$ref} status changed to " . ucwords(str_replace('_', ' ', $new_status)) . '.';
        } else {
            $title = 'New Response on Your Complaint';
            $body_text = "An LIRS officer replied to complaint #{$ref}.";
        }

        $notif = $pdo->prepare(
            'INSERT INTO notifications (taxpayer_id, complaint_id, type, title, message)
             VALUES (?, ?, ?, ?, ?)'
        );
        $notif->execute([$complaint['taxpayer_id'], $complaint_id, 'complaint_response', $title, $body_text]);
    }

    respond(true, 'Response saved.', [
        'complaint_id' => $complaint_id,
        'status' => $statusChanged ? ucwords(str_replace('_', ' ', $new_status)) : ucwords(str_replace('_', ' ', $complaint['status'])),
    ]);
} catch (Throwable $e) {
    error_log('admin/respond-complaint failed: ' . $e->getMessage());
    respond(false, 'Unable to save response.', [], 500);
}