<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    respond(false, 'Invalid request method.', [], 405);
}

requireTaxpayer();

$taxpayer_id = $_SESSION['user_id'];

function dashboardDate(?string $value, string $format): ?string
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

function dashboardTimeAgo(?string $value): string
{
    if (empty($value)) {
        return '';
    }

    $timestamp = strtotime($value);
    if ($timestamp === false) {
        return '';
    }

    $seconds = time() - $timestamp;
    if ($seconds < 60) {
        return 'just now';
    }

    $minutes = intdiv($seconds, 60);
    if ($minutes < 60) {
        return $minutes . 'm ago';
    }

    $hours = intdiv($minutes, 60);
    if ($hours < 24) {
        return $hours . 'h ago';
    }

    $days = intdiv($hours, 24);
    if ($days < 7) {
        return $days . 'd ago';
    }

    $weeks = intdiv($days, 7);
    if ($weeks < 4) {
        return $weeks . 'w ago';
    }

    return date('M d', $timestamp);
}

function formatComplaintRow(array $complaint): array
{
    return [
        'id' => (int)$complaint['id'],
        'reference_id' => 'CPL-' . str_pad((string)$complaint['id'], 6, '0', STR_PAD_LEFT),
        'category' => ucfirst(str_replace('_', ' ', (string)$complaint['category'])),
        'subject' => (string)$complaint['subject'],
        'status' => ucwords(str_replace('_', ' ', (string)$complaint['status'])),
        'priority' => ucfirst((string)$complaint['priority']),
        'created_at' => dashboardDate($complaint['created_at'], 'c'),
        'created_at_label' => dashboardDate($complaint['created_at'], 'M d, Y'),
        'updated_at' => dashboardDate($complaint['updated_at'], 'c'),
    ];
}

$profile_stmt = $pdo->prepare(
    'SELECT id, first_name, last_name, email, phone, tin, pay_id, status
     FROM taxpayers
     WHERE id = ?'
);
$profile_stmt->execute([$taxpayer_id]);
$profile = $profile_stmt->fetch();

if (!$profile) {
    respond(false, 'User not found.', [], 404);
}

$count_stmt = $pdo->prepare(
    'SELECT
        COUNT(*) AS total,
        SUM(CASE WHEN status IN ("new", "pending") THEN 1 ELSE 0 END) AS pending,
        SUM(CASE WHEN status = "under_review" THEN 1 ELSE 0 END) AS under_review,
        SUM(CASE WHEN status = "resolved" THEN 1 ELSE 0 END) AS resolved
     FROM complaints
     WHERE taxpayer_id = ?'
);
$count_stmt->execute([$taxpayer_id]);
$counts = $count_stmt->fetch() ?: [];

$recent_stmt = $pdo->prepare(
    'SELECT id, category, subject, status, priority, created_at, updated_at
     FROM complaints
     WHERE taxpayer_id = ?
     ORDER BY created_at DESC
     LIMIT 5'
);
$recent_stmt->execute([$taxpayer_id]);
$recent_complaints = array_map('formatComplaintRow', $recent_stmt->fetchAll());

$notification_stmt = $pdo->prepare(
    'SELECT id, type, title, message, is_read, complaint_id, created_at
     FROM notifications
     WHERE taxpayer_id = ?
     ORDER BY created_at DESC
     LIMIT 3'
);
$notification_stmt->execute([$taxpayer_id]);
$notifications = [];
foreach ($notification_stmt->fetchAll() as $notification) {
    $notifications[] = [
        'id' => (int)$notification['id'],
        'type' => (string)$notification['type'],
        'title' => (string)$notification['title'],
        'message' => (string)$notification['message'],
        'is_read' => (bool)$notification['is_read'],
        'complaint_id' => $notification['complaint_id'] !== null ? (int)$notification['complaint_id'] : null,
        'created_at' => dashboardDate($notification['created_at'], 'c'),
        'created_at_label' => dashboardDate($notification['created_at'], 'M d, Y h:i A'),
        'time_ago' => dashboardTimeAgo($notification['created_at']),
    ];
}

$unread_stmt = $pdo->prepare(
    'SELECT COUNT(*) AS unread
     FROM notifications
     WHERE taxpayer_id = ? AND is_read = FALSE'
);
$unread_stmt->execute([$taxpayer_id]);
$unread_count = (int)($unread_stmt->fetch()['unread'] ?? 0);

$response_stmt = $pdo->prepare(
    'SELECT cr.id, cr.message, cr.created_at, c.id AS complaint_id, c.subject, c.status, a.name AS admin_name
     FROM complaint_responses cr
     INNER JOIN complaints c ON c.id = cr.complaint_id
     LEFT JOIN admins a ON a.id = cr.admin_id
     WHERE c.taxpayer_id = ? AND cr.is_internal = FALSE
     ORDER BY cr.created_at DESC
     LIMIT 3'
);
$response_stmt->execute([$taxpayer_id]);
$responses = [];
foreach ($response_stmt->fetchAll() as $response) {
    $responses[] = [
        'id' => (int)$response['id'],
        'complaint_id' => (int)$response['complaint_id'],
        'reference_id' => 'CPL-' . str_pad((string)$response['complaint_id'], 6, '0', STR_PAD_LEFT),
        'subject' => (string)$response['subject'],
        'status' => ucwords(str_replace('_', ' ', (string)$response['status'])),
        'message' => (string)$response['message'],
        'admin_name' => $response['admin_name'] ?: 'LIRS Officer',
        'created_at' => dashboardDate($response['created_at'], 'c'),
        'created_at_label' => dashboardDate($response['created_at'], 'M d, Y'),
    ];
}

respond(true, 'Dashboard retrieved successfully.', [
    'profile' => [
        'id' => (int)$profile['id'],
        'name' => trim($profile['first_name'] . ' ' . $profile['last_name']),
        'first_name' => $profile['first_name'],
        'last_name' => $profile['last_name'],
        'email' => $profile['email'],
        'phone' => $profile['phone'],
        'tin' => $profile['tin'],
        'pay_id' => $profile['pay_id'],
        'status' => $profile['status'],
    ],
    'counts' => [
        'total' => (int)($counts['total'] ?? 0),
        'pending' => (int)($counts['pending'] ?? 0),
        'under_review' => (int)($counts['under_review'] ?? 0),
        'resolved' => (int)($counts['resolved'] ?? 0),
    ],
    'recent_complaints' => $recent_complaints,
    'notifications' => $notifications,
    'unread_count' => $unread_count,
    'responses' => $responses,
]);
