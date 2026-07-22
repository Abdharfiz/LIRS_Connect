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

    // Any logged-in admin/officer can view the taxpayer directory.
    requireAdmin();

    $status = cleanStr($_GET['status'] ?? ''); // 'active' | 'deactivated' | ''
    $search = cleanStr($_GET['search'] ?? '');
    $page = max(1, (int)($_GET['page'] ?? 1));
    $per_page = (int)($_GET['per_page'] ?? 20);
    $per_page = $per_page > 0 && $per_page <= 100 ? $per_page : 20;
    $offset = ($page - 1) * $per_page;

    $where = [];
    $params = [];

    if ($status === 'active' || $status === 'deactivated') {
        $where[] = 't.status = ?';
        $params[] = $status;
    }

    if ($search !== '') {
        $where[] = "(t.first_name LIKE ? OR t.last_name LIKE ? OR CONCAT(t.first_name, ' ', t.last_name) LIKE ?
                     OR t.tin LIKE ? OR t.email LIKE ? OR t.phone LIKE ? OR t.pay_id LIKE ?)";
        $like = '%' . $search . '%';
        for ($i = 0; $i < 7; $i++) {
            $params[] = $like;
        }
    }

    $whereSql = $where ? ('WHERE ' . implode(' AND ', $where)) : '';

    $count_sql = "SELECT COUNT(*) as total FROM taxpayers t $whereSql";
    $count_stmt = $pdo->prepare($count_sql);
    $count_stmt->execute($params);
    $total = (int)$count_stmt->fetch()['total'];

    $sql = "SELECT t.id, t.first_name, t.last_name, t.pay_id, t.email, t.phone, t.tin,
                   t.lga, t.address, t.status, t.created_at,
                   (SELECT COUNT(*) FROM complaints c WHERE c.taxpayer_id = t.id) AS complaints_count
            FROM taxpayers t
            $whereSql
            ORDER BY t.created_at DESC
            LIMIT ?, ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array_merge($params, [$offset, $per_page]));
    $rows = $stmt->fetchAll();

    $taxpayers = [];
    foreach ($rows as $row) {
        $taxpayers[] = [
            'id' => $row['id'],
            'name' => trim($row['first_name'] . ' ' . $row['last_name']),
            'pay_id' => $row['pay_id'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'tin' => $row['tin'],
            'lga' => $row['lga'],
            'address' => $row['address'],
            'status' => $row['status'] === 'active' ? 'Active' : 'Inactive',
            'status_raw' => $row['status'],
            'complaints_count' => (int)$row['complaints_count'],
            'created_at' => safeDateTime($row['created_at'], 'c'),
            'created_at_label' => safeDateTime($row['created_at'], 'M d, Y'),
        ];
    }

    // Counts for the summary strip, independent of current filter/page.
    $counts_stmt = $pdo->query(
        "SELECT
            COUNT(*) AS all_count,
            SUM(status = 'active') AS active_count,
            SUM(status = 'deactivated') AS inactive_count
         FROM taxpayers"
    );
    $counts = $counts_stmt->fetch();

    respond(true, 'Taxpayers retrieved successfully.', [
        'taxpayers' => $taxpayers,
        'counts' => [
            'all' => (int)$counts['all_count'],
            'active' => (int)$counts['active_count'],
            'inactive' => (int)$counts['inactive_count'],
        ],
        'pagination' => [
            'page' => $page,
            'per_page' => $per_page,
            'total' => $total,
            'total_pages' => (int)ceil($total / $per_page),
        ],
    ]);
} catch (Throwable $e) {
    error_log('admin/get-admintaxpayers failed: ' . $e->getMessage());
    respond(false, 'Unable to load taxpayers.', [], 500);
}
