<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../config/db.php';

set_error_handler(function ($severity, $message, $file, $line) {
    throw new ErrorException($message, 0, $severity, $file, $line);
});

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        respond(false, 'Invalid request method.', [], 405);
    }

    requireTaxpayer();
    $taxpayer_id = $_SESSION['user_id'];

    $body = getRequestBody();
    $complaint_id = (int)($body['complaint_id'] ?? 0);
    $message = cleanStr($body['message'] ?? '');

    if ($complaint_id === 0) {
        respond(false, 'Complaint ID is required.', [], 400);
    }
    if ($message === '') {
        respond(false, 'Please enter a message.', [], 422);
    }
    if (strlen($message) < 2) {
        respond(false, 'Message is too short.', [], 422);
    }

    // Ownership check — a taxpayer can only reply to their OWN complaint.
    $check = $pdo->prepare('SELECT id, status FROM complaints WHERE id = ? AND taxpayer_id = ?');
    $check->execute([$complaint_id, $taxpayer_id]);
    $complaint = $check->fetch();

    if (!$complaint) {
        respond(false, 'Complaint not found.', [], 404);
    }

    // Taxpayer replies are never internal — always visible.
    $stmt = $pdo->prepare(
        'INSERT INTO complaint_responses (complaint_id, admin_id, sender_type, taxpayer_id, message, is_internal)
         VALUES (?, NULL, ?, ?, ?, 0)'
    );
    $stmt->execute([$complaint_id, 'taxpayer', $taxpayer_id, $message]);

    // If this complaint had already been marked resolved/closed/rejected
    // and the taxpayer is following up (e.g. attaching a requested
    // document), mark it 'returned' — distinct from a fresh 'new'
    // complaint or one an officer is actively working ('in_progress') —
    // so admins can immediately see it needs another look.
    $reopened = false;
    if (in_array($complaint['status'], ['resolved', 'closed', 'rejected'], true)) {
        $update = $pdo->prepare("UPDATE complaints SET status = 'returned', resolved_at = NULL WHERE id = ?");
        $update->execute([$complaint_id]);
        $reopened = true;
    }

    respond(true, $reopened
        ? 'Reply sent — this complaint has been marked Returned for review.'
        : 'Reply sent.', [
        'complaint_id' => $complaint_id,
        'reopened' => $reopened,
    ]);
} catch (Throwable $e) {
    error_log('reply-complaint failed: ' . $e->getMessage());
    respond(false, 'Unable to send reply.', [], 500);
}