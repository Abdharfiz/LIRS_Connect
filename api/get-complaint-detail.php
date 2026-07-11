<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../config/db.php';

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

    // Ensure user is logged in as a taxpayer
    requireTaxpayer();

    $taxpayer_id = $_SESSION['user_id'];
    // Accept either a numeric complaint id or a legacy reference like CMP001.
    $complaint_ref = trim((string)($_GET['id'] ?? ''));
    $complaint_id = (int)preg_replace('/\D+/', '', $complaint_ref);

    if ($complaint_id === 0) {
        respond(false, 'Complaint ID is required.', [], 400);
    }

    // IMPORTANT: filter by taxpayer_id too, so one taxpayer can never load
    // another taxpayer's complaint just by changing the id in the URL.
    $stmt = $pdo->prepare(
        'SELECT c.id, c.category, c.subject, c.description, c.status, c.priority, c.attachment_path, c.created_at, c.updated_at   
         FROM complaints c
        WHERE c.id = ? AND c.taxpayer_id = ?'
    );
    $stmt->execute([$complaint_id, $taxpayer_id]);
    $complaint = $stmt->fetch();

    if (!$complaint) {
        respond(false, 'Complaint not found.', [], 404);
    }

    
    $resp_stmt = $pdo->prepare(
        'SELECT cr.id, cr.message, cr.attachment_path, cr.created_at
         FROM complaint_responses cr
      
         WHERE cr.complaint_id = ? AND cr.is_internal = 0
         ORDER BY cr.created_at ASC'
    );
    $resp_stmt->execute([$complaint_id]);
    $responses = $resp_stmt->fetchAll();

    // Format response
    $formatted_responses = [];
    foreach ($responses as $response) {
        $formatted_responses[] = [
            'id' => $response['id'],
            'admin_name' => $response['admin_name'] ?? 'LIRS Officer',
            'message' => $response['message'],
            'attachment_path' => $response['attachment_path'],
            'created_at' => safeDateTime($response['created_at'], 'c'),
            'created_at_label' => safeDateTime($response['created_at'], 'M d, Y \a\t h:i A')
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
            'priority' => ucfirst((string)$complaint['priority']),
            'attachment_path' => $complaint['attachment_path'],
 
            'created_at' => safeDateTime($complaint['created_at'], 'c'),
            'updated_at' => safeDateTime($complaint['updated_at'], 'c'),
            'created_at_label' => safeDateTime($complaint['created_at'], 'M d, Y \a\t h:i A'),
            'updated_at_label' => safeDateTime($complaint['updated_at'], 'M d, Y \a\t h:i A')
        ],
        'responses' => $formatted_responses
    ]);
} catch (Throwable $e) {
    error_log('get-complaint-detail failed: ' . $e->getMessage());
    respond(false, 'Unable to load complaint details.', [], 500); 
}