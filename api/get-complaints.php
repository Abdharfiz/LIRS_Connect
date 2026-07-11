<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    respond(false, 'Invalid request method.', [], 405);
}

// Ensure user is logged in as a taxpayer
requireTaxpayer();

$taxpayer_id = $_SESSION['user_id'];

// Get query parameters for filtering
$status = cleanStr($_GET['status'] ?? '');
$sort = cleanStr($_GET['sort'] ?? 'created');
$page = (int)($_GET['page'] ?? 1);
$per_page = (int)($_GET['per_page'] ?? 10);
$offset = ($page - 1) * $per_page;

// Build query with filtering
$query = 'SELECT id, category, subject, status, priority, created_at, updated_at 
          FROM complaints 
          WHERE taxpayer_id = ?';
$params = [$taxpayer_id];

if ($status !== '' && in_array($status, ['new', 'pending', 'under_review', 'resolved', 'rejected', 'closed'])) {
    $query .= ' AND status = ?';
    $params[] = $status;
}

// Sorting
if ($sort === 'status') {
    $query .= ' ORDER BY status DESC, created_at DESC';
} elseif ($sort === 'priority') {
    $query .= ' ORDER BY FIELD(priority, "critical", "high", "medium", "low"), created_at DESC';
} else {
    $query .= ' ORDER BY created_at DESC';
}

// Get total count for pagination
$count_query = 'SELECT COUNT(*) as total FROM complaints WHERE taxpayer_id = ?';
$count_params = [$taxpayer_id];
if ($status !== '' && in_array($status, ['new', 'pending', 'under_review', 'resolved', 'rejected', 'closed'])) {
    $count_query .= ' AND status = ?';
    $count_params[] = $status;
}

$count_stmt = $pdo->prepare($count_query);
$count_stmt->execute($count_params);
$total = $count_stmt->fetch()['total'];

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

// Get paginated results
$stmt = $pdo->prepare($query . ' LIMIT ?, ?');
$stmt->execute(array_merge($params, [$offset, $per_page]));
$complaints = $stmt->fetchAll();

// Format response
$formatted_complaints = [];
foreach ($complaints as $complaint) {
    $updated_timestamp = !empty($complaint['updated_at']) ? strtotime($complaint['updated_at']) : false;
    $formatted_complaints[] = [
        'id' => $complaint['id'],
        'reference_id' => 'CPL-' . str_pad($complaint['id'], 6, '0', STR_PAD_LEFT),
        'category' => ucfirst(str_replace('_', ' ', (string)$complaint['category'])),
        'subject' => (string)$complaint['subject'],
        'status' => ucwords(str_replace('_', ' ', (string)$complaint['status'])),
        'priority' => ucfirst((string)$complaint['priority']),
        'created_at' => safeDateTime($complaint['created_at'], 'c'),
        'updated_at' => safeDateTime($complaint['updated_at'], 'c'),
        'created_at_label' => safeDateTime($complaint['created_at'], 'M d, Y'),
        'days_ago' => $updated_timestamp !== false ? (int)((time() - $updated_timestamp) / 86400) : 0
    ];
}

respond(true, 'Complaints retrieved successfully.', [
    'complaints' => $formatted_complaints,
    'pagination' => [
        'page' => $page,
        'per_page' => $per_page,
        'total' => $total,
        'total_pages' => ceil($total / $per_page)
    ]
]);
