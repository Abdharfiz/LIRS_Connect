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

// Collapses the underlying 5-state status down to the 3 states admins
// actually want to see at a glance: New (nobody's touched it), Open
// (assigned/being worked), Closed (done, one way or another).
function statusGroup(string $status): string
{
    // Matches the ACTUAL live schema's ENUM:
    // ('new','in_progress','resolved','closed','rejected')
    if ($status === 'new') {
        return 'New';
    }
    if ($status === 'resolved' || $status === 'rejected' || $status === 'closed') {
        return 'Closed';
    }
    return 'Open'; // in_progress
}

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        respond(false, 'Invalid request method.', [], 405);
    }

    // Any logged-in admin/officer can view the full complaint list.
    requireAdmin();

    $group = cleanStr($_GET['group'] ?? ''); // 'New' | 'Open' | 'Closed' | ''
    $search = cleanStr($_GET['search'] ?? '');
    $page = max(1, (int)($_GET['page'] ?? 1));
    $per_page = (int)($_GET['per_page'] ?? 20);
    $per_page = $per_page > 0 && $per_page <= 100 ? $per_page : 20;
    $offset = ($page - 1) * $per_page;

    $where = [];
    $params = [];

    if ($group === 'New') {
        $where[] = "c.status = 'new'";
    } elseif ($group === 'Closed') {
        $where[] = "c.status IN ('resolved','rejected','closed')";
    } elseif ($group === 'Open') {
        $where[] = "c.status = 'in_progress'";
    }

    if ($search !== '') {
        $where[] = '(c.subject LIKE ? OR t.first_name LIKE ? OR t.last_name LIKE ? OR t.tin LIKE ? OR c.id = ?)';
        $like = '%' . $search . '%';
        $params[] = $like;
        $params[] = $like;
        $params[] = $like;
        $params[] = $like;
        $params[] = (int)preg_replace('/\D+/', '', $search) ?: 0;
    }

    $whereSql = $where ? ('WHERE ' . implode(' AND ', $where)) : '';

    $count_sql = "SELECT COUNT(*) as total FROM complaints c JOIN taxpayers t ON c.taxpayer_id = t.id $whereSql";
    $count_stmt = $pdo->prepare($count_sql);
    $count_stmt->execute($params);
    $total = (int)$count_stmt->fetch()['total'];

    $sql = "SELECT c.id, c.category, c.subject, c.status, c.priority, c.assigned_to, c.created_at, c.updated_at,
                   t.id AS taxpayer_id, t.first_name, t.last_name, t.tin,
                   a.name AS assigned_to_name
            FROM complaints c
            JOIN taxpayers t ON c.taxpayer_id = t.id
            LEFT JOIN admins a ON c.assigned_to = a.id
            $whereSql
            ORDER BY c.created_at DESC
            LIMIT ?, ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array_merge($params, [$offset, $per_page]));
    $rows = $stmt->fetchAll();

    $complaints = [];
    foreach ($rows as $row) {
        $complaints[] = [
            'id' => $row['id'],
            'reference_id' => 'CPL-' . str_pad($row['id'], 6, '0', STR_PAD_LEFT),
            'category' => ucfirst(str_replace('_', ' ', (string)$row['category'])),
            'subject' => (string)$row['subject'],
            'status' => ucwords(str_replace('_', ' ', (string)$row['status'])),
            'status_group' => statusGroup($row['status']),
            'priority' => ucfirst((string)$row['priority']),
            'taxpayer_id' => $row['taxpayer_id'],
            'taxpayer_name' => trim($row['first_name'] . ' ' . $row['last_name']),
            'taxpayer_tin' => $row['tin'],
            'assigned_to_id' => $row['assigned_to'],
            'assigned_to' => $row['assigned_to_name'], // null = unassigned
            'created_at' => safeDateTime($row['created_at'], 'c'),
            'created_at_label' => safeDateTime($row['created_at'], 'M d, Y'),
            'updated_at' => safeDateTime($row['updated_at'], 'c'),
        ];
    }

    // Counts for the New/Open/Closed tabs, independent of current filter/page.
    $group_counts_stmt = $pdo->query(
        "SELECT
            SUM(status = 'new') AS new_count,
            SUM(status = 'in_progress') AS open_count,
            SUM(status IN ('resolved','rejected','closed')) AS closed_count,
            COUNT(*) AS all_count
         FROM complaints"
    );
    $counts = $group_counts_stmt->fetch();

    respond(true, 'Complaints retrieved successfully.', [
        'complaints' => $complaints,
        'counts' => [
            'all' => (int)$counts['all_count'],
            'new' => (int)$counts['new_count'],
            'open' => (int)$counts['open_count'],
            'closed' => (int)$counts['closed_count'],
        ],
        'pagination' => [
            'page' => $page,
            'per_page' => $per_page,
            'total' => $total,
            'total_pages' => (int)ceil($total / $per_page),
        ],
    ]);
} catch (Throwable $e) {
    error_log('admin/get-admincomplaint failed: ' . $e->getMessage());
    respond(false, 'Unable to load complaints.', [], 500);
}