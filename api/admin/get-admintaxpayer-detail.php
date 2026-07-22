<?php
require_once __DIR__ . '/../../includes/helpers.php';
require_once __DIR__ . '/../../config/db.php';

set_error_handler(function ($severity, $message, $file, $line) {
    throw new ErrorException($message, 0, $severity, $file, $line);
});

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

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        respond(false, 'Invalid request method.', [], 405);
    }

    requireAdmin();

    $taxpayer_id = (int)($_GET['id'] ?? 0);

    if ($taxpayer_id === 0) {
        respond(false, 'Taxpayer ID is required.', [], 400);
    }

    $stmt = $pdo->prepare(
        'SELECT id, first_name, last_name, pay_id, email, phone, tin, lga, address,
                status, created_at, updated_at
         FROM taxpayers WHERE id = ?'
    );
    $stmt->execute([$taxpayer_id]);
    $taxpayer = $stmt->fetch();

    if (!$taxpayer) {
        respond(false, 'Taxpayer not found.', [], 404);
    }

    $complaints_stmt = $pdo->prepare(
        "SELECT c.id, c.category, c.subject, c.status, c.priority, c.created_at
         FROM complaints c
         WHERE c.taxpayer_id = ?
         ORDER BY c.created_at DESC"
    );
    $complaints_stmt->execute([$taxpayer_id]);
    $complaint_rows = $complaints_stmt->fetchAll();

    $complaints = [];
    foreach ($complaint_rows as $row) {
        $complaints[] = [
            'id' => $row['id'],
            'reference_id' => 'CPL-' . str_pad($row['id'], 6, '0', STR_PAD_LEFT),
            'category' => ucfirst(str_replace('_', ' ', (string)$row['category'])),
            'subject' => (string)$row['subject'],
            'status' => ucwords(str_replace('_', ' ', (string)$row['status'])),
            'status_raw' => $row['status'],
            'priority' => ucfirst((string)$row['priority']),
            'priority_raw' => $row['priority'],
            'created_at' => safeDateTime($row['created_at'], 'c'),
            'created_at_label' => safeDateTime($row['created_at'], 'M d, Y'),
        ];
    }

    respond(true, 'Taxpayer details retrieved.', [
        'taxpayer' => [
            'id' => $taxpayer['id'],
            'name' => trim($taxpayer['first_name'] . ' ' . $taxpayer['last_name']),
            'pay_id' => $taxpayer['pay_id'],
            'email' => $taxpayer['email'],
            'phone' => $taxpayer['phone'],
            'tin' => $taxpayer['tin'],
            'lga' => $taxpayer['lga'],
            'address' => $taxpayer['address'],
            'status' => $taxpayer['status'] === 'active' ? 'Active' : 'Inactive',
            'status_raw' => $taxpayer['status'],
            'created_at' => safeDateTime($taxpayer['created_at'], 'c'),
            'created_at_label' => safeDateTime($taxpayer['created_at'], 'M d, Y'),
            'complaints_count' => count($complaints),
        ],
        'complaints' => $complaints,
    ]);
} catch (Throwable $e) {
    error_log('admin/get-admintaxpayer-detail failed: ' . $e->getMessage());
    respond(false, 'Unable to load taxpayer details.', [], 500);
}
