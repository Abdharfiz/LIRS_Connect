<?php
require_once __DIR__ . '/../../includes/helpers.php';
require_once __DIR__ . '/../../config/db.php';

function safeDateTime(?string $value, string $format): ?string
{
    if (empty($value)) {
        return null;
    }
    $timestamp = strtotime($value);
    if ($timestamp === false) {
        return null;
    }
    return date($format, $timestamp);
}

set_error_handler(function ($severity, $message, $file, $line) {
    throw new ErrorException($message, 0, $severity, $file, $line);
});

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        respond(false, 'Invalid request method.', [], 405);
    }

    requireAdmin();
    $current_admin_id = $_SESSION['admin_id'];

    $complaint_ref = trim((string)($_GET['id'] ?? ''));
    $complaint_id = (int)preg_replace('/\D+/', '', $complaint_ref);

    if ($complaint_id === 0) {
        respond(false, 'Complaint ID is required.', [], 400);
    }

    $stmt = $pdo->prepare('SELECT id, status, assigned_to FROM complaints WHERE id = ?');
    $stmt->execute([$complaint_id]);
    $existing = $stmt->fetch();

    if (!$existing) {
        respond(false, 'Complaint not found.', [], 404);
    }

    // CLAIM ON VIEW: the first admin/officer to open an unassigned
    // complaint automatically becomes the one handling it. If someone
    // already claimed it, opening it again does NOT reassign it — you
    // just see who has it.
    if ($existing['assigned_to'] === null) {
        $newStatus = $existing['status'] === 'new' ? 'in_progress' : $existing['status'];

        $claim = $pdo->prepare('UPDATE complaints SET assigned_to = ?, status = ? WHERE id = ? AND assigned_to IS NULL');
        $claim->execute([$current_admin_id, $newStatus, $complaint_id]);

        // Only insert the "claimed" note/notification if we actually claimed (assigned_to was NULL).
        if ((int)$claim->rowCount() > 0) {
            $who = $pdo->prepare('SELECT name FROM admins WHERE id = ?');
            $who->execute([$current_admin_id]);
            $whoName = $who->fetch()['name'] ?? 'An officer';

            $note = $pdo->prepare(
                'INSERT INTO complaint_responses (complaint_id, admin_id, message, is_internal)
                 VALUES (?, ?, ?, 1)'
            );
            $note->execute([$complaint_id, $current_admin_id, "Complaint claimed by {$whoName} (opened for review)."]);

            // Let the taxpayer know their complaint is now being looked at.
            $taxpayerStmt = $pdo->prepare('SELECT taxpayer_id FROM complaints WHERE id = ?');
            $taxpayerStmt->execute([$complaint_id]);
            $taxpayer_id = $taxpayerStmt->fetch()['taxpayer_id'];

            $notif = $pdo->prepare(
                'INSERT INTO notifications (taxpayer_id, complaint_id, type, title, message)
                 VALUES (?, ?, ?, ?, ?)'
            );
            $notif->execute([
                $taxpayer_id,
                $complaint_id,
                'complaint_assigned',
                'Your Complaint Is Under Review',
                'Complaint #' . str_pad($complaint_id, 6, '0', STR_PAD_LEFT) . ' has been picked up by an LIRS officer and is now under review.',
            ]);
        }

        // Let the taxpayer know their complaint is now being looked at.
        // (moved inside rowCount guard above)


        // Let the taxpayer know their complaint is now being looked at.
        $taxpayerStmt = $pdo->prepare('SELECT taxpayer_id FROM complaints WHERE id = ?');
        $taxpayerStmt->execute([$complaint_id]);
        $taxpayer_id = $taxpayerStmt->fetch()['taxpayer_id'];

        $notif = $pdo->prepare(
            'INSERT INTO notifications (taxpayer_id, complaint_id, type, title, message)
             VALUES (?, ?, ?, ?, ?)'
        );
        $notif->execute([
            $taxpayer_id,
            $complaint_id,
            'complaint_assigned',
            'Your Complaint Is Under Review',
            'Complaint #' . str_pad($complaint_id, 6, '0', STR_PAD_LEFT) . ' has been picked up by an LIRS officer and is now under review.',
        ]);
    }

    // Now fetch the full, current detail (post-claim if it just happened).
    $stmt = $pdo->prepare(
        'SELECT c.id, c.category, c.subject, c.description, c.status, c.priority,
                c.attachment_path, c.created_at, c.updated_at, c.resolved_at,
                c.assigned_to,
                a.name AS assigned_to_name,
                t.id AS taxpayer_id, t.first_name, t.last_name, t.email AS taxpayer_email,
                t.phone AS taxpayer_phone, t.tin AS taxpayer_tin, t.pay_id AS taxpayer_pay_id
         FROM complaints c
         JOIN taxpayers t ON c.taxpayer_id = t.id
         LEFT JOIN admins a ON c.assigned_to = a.id
         WHERE c.id = ?'
    );
    $stmt->execute([$complaint_id]);
    $complaint = $stmt->fetch();

    // Admins see ALL responses, including internal notes.
    $resp_stmt = $pdo->prepare(
        "SELECT cr.id, cr.message, cr.attachment_path, cr.is_internal, cr.created_at,
                COALESCE(cr.sender_type, 'admin') AS sender_type,
                a.name as admin_name
         FROM complaint_responses cr
         LEFT JOIN admins a ON cr.admin_id = a.id
         WHERE cr.complaint_id = ?
         ORDER BY cr.created_at ASC"
    );
    $resp_stmt->execute([$complaint_id]);
    $responses = $resp_stmt->fetchAll();

    $taxpayerFullName = trim($complaint['first_name'] . ' ' . $complaint['last_name']);

    $formatted_responses = [];
    foreach ($responses as $response) {
        $isTaxpayer = $response['sender_type'] === 'taxpayer';
        $formatted_responses[] = [
            'id' => $response['id'],
            'sender_type' => $response['sender_type'],
            'admin_name' => $isTaxpayer ? ($taxpayerFullName . ' (Taxpayer)') : ($response['admin_name'] ?? 'LIRS Officer'),
            'message' => $response['message'],
            'attachment_path' => $response['attachment_path'],
            'is_internal' => (bool)$response['is_internal'],
            'created_at' => safeDateTime($response['created_at'], 'c'),
            'created_at_label' => safeDateTime($response['created_at'], 'M d, Y \a\t h:i A'),
        ];
    }

    respond(true, 'Complaint details retrieved.', [
        'complaint' => [
            'id' => $complaint['id'],
            'reference_id' => 'CPL-' . str_pad($complaint['id'], 6, '0', STR_PAD_LEFT),
            'category' => ucfirst(str_replace('_', ' ', (string)$complaint['category'])),
            'subject' => (string)$complaint['subject'],
            'description' => (string)$complaint['description'],
            'status' => ucwords(str_replace('_', ' ', (string)$complaint['status'])),
            'status_raw' => $complaint['status'],
            'priority' => ucfirst((string)$complaint['priority']),
            'priority_raw' => $complaint['priority'],
            'attachment_path' => $complaint['attachment_path'],
            'attachment_url' => $complaint['attachment_path'] ? ('../' . ltrim($complaint['attachment_path'], '/')) : null,

            'assigned_to' => $complaint['assigned_to_name'],
            'assigned_to_id' => $complaint['assigned_to'],
            'is_mine' => $complaint['assigned_to'] !== null && (int)$complaint['assigned_to'] === (int)$current_admin_id,
            'resolved_at' => safeDateTime($complaint['resolved_at'], 'c'),
            'created_at' => safeDateTime($complaint['created_at'], 'c'),
            'updated_at' => safeDateTime($complaint['updated_at'], 'c'),
            'created_at_label' => safeDateTime($complaint['created_at'], 'M d, Y \a\t h:i A'),
            'updated_at_label' => safeDateTime($complaint['updated_at'], 'M d, Y \a\t h:i A'),
        ],
        'taxpayer' => [
            'id' => $complaint['taxpayer_id'],
            'name' => trim($complaint['first_name'] . ' ' . $complaint['last_name']),
            'email' => $complaint['taxpayer_email'],
            'phone' => $complaint['taxpayer_phone'],
            'tin' => $complaint['taxpayer_tin'],
            'pay_id' => $complaint['taxpayer_pay_id'],
        ],
        'responses' => $formatted_responses,
    ]);
} catch (Throwable $e) {
    error_log('admin/get-admincomplaint-details failed: ' . $e->getMessage());
    respond(false, 'Unable to load complaint details.', [], 500);
}