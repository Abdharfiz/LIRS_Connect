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

    // ---- KPI counts ----
    // NOTE: this schema's status ENUM is ('new','in_progress','resolved','closed','rejected','returned') —
    // there's no "escalated" state, so the 4th KPI uses priority='high' instead.
    $countsStmt = $pdo->query(
        "SELECT
            COUNT(*) AS total,
            SUM(status = 'new') AS new_count,
            SUM(status = 'in_progress') AS in_progress_count,
            SUM(status = 'returned') AS returned_count,
            SUM(status = 'resolved') AS resolved_count,
            SUM(status = 'rejected') AS rejected_count,
            SUM(status = 'closed') AS closed_count,
            SUM(priority = 'high') AS high_priority_count
         FROM complaints"
    );
    $counts = $countsStmt->fetch();

    $total = (int)$counts['total'];
    $resolved = (int)$counts['resolved_count'];
    $resolutionRate = $total > 0 ? round(($resolved / $total) * 100, 1) : 0;

    // ---- Recent complaints (top 5) ----
    // Returned complaints bubble to the top regardless of date, so admins
    // never have to scroll to notice a taxpayer followed up.
    $recentStmt = $pdo->query(
        "SELECT c.id, c.category, c.status, c.priority, c.created_at,
                t.first_name, t.last_name
         FROM complaints c
         JOIN taxpayers t ON c.taxpayer_id = t.id
         ORDER BY (c.status = 'returned') DESC, c.created_at DESC
         LIMIT 5"
    );
    $recentRows = $recentStmt->fetchAll();

    $recent = [];
    foreach ($recentRows as $row) {
        $recent[] = [
            'id' => $row['id'],
            'reference_id' => 'CPL-' . str_pad($row['id'], 6, '0', STR_PAD_LEFT),
            'taxpayer_name' => trim($row['first_name'] . ' ' . $row['last_name']),
            'category' => ucfirst(str_replace('_', ' ', (string)$row['category'])),
            'priority' => ucfirst((string)$row['priority']),
            'status' => ucwords(str_replace('_', ' ', (string)$row['status'])),
            'status_raw' => $row['status'],
            'created_at_label' => safeDateTime($row['created_at'], 'M d, Y'),
        ];
    }

    // ---- Recent activity (last 6 complaints touched, newest first) ----
    $activityStmt = $pdo->query(
        "SELECT c.id, c.status, c.created_at, c.updated_at,
                t.first_name, t.last_name
         FROM complaints c
         JOIN taxpayers t ON c.taxpayer_id = t.id
         ORDER BY c.updated_at DESC
         LIMIT 6"
    );
    $activityRows = $activityStmt->fetchAll();

    $activity = [];
    foreach ($activityRows as $row) {
        $ref = 'CPL-' . str_pad($row['id'], 6, '0', STR_PAD_LEFT);
        $taxpayerName = trim($row['first_name'] . ' ' . $row['last_name']);
        $wasJustCreated = $row['created_at'] === $row['updated_at'];

        if ($wasJustCreated) {
            $text = "New complaint {$ref} filed by {$taxpayerName}";
            $color = 'blue';
        } elseif ($row['status'] === 'returned') {
            $text = "{$ref} RETURNED by {$taxpayerName} — needs review";
            $color = 'red';
        } elseif ($row['status'] === 'resolved') {
            $text = "{$ref} marked Resolved";
            $color = 'green';
        } elseif ($row['status'] === 'rejected') {
            $text = "{$ref} marked Rejected";
            $color = 'red';
        } elseif ($row['status'] === 'in_progress') {
            $text = "{$ref} is now In Progress";
            $color = 'amber';
        } else {
            $text = "{$ref} status updated to " . ucwords(str_replace('_', ' ', $row['status']));
            $color = 'amber';
        }

        $activity[] = [
            'text' => $text,
            'color' => $color,
            'time' => safeDateTime($row['updated_at'], 'g:i A'),
            'time_full' => safeDateTime($row['updated_at'], 'M d, Y g:i A'),
        ];
    }

    respond(true, 'Dashboard stats retrieved.', [
        'kpis' => [
            'total' => $total,
            'new' => (int)$counts['new_count'],
            'in_progress' => (int)$counts['in_progress_count'],
            'returned' => (int)$counts['returned_count'],
            'resolved' => $resolved,
            'rejected' => (int)$counts['rejected_count'],
            'closed' => (int)$counts['closed_count'],
            'high_priority' => (int)$counts['high_priority_count'],
            'resolution_rate' => $resolutionRate,
        ],
        'recent_complaints' => $recent,
        'recent_activity' => $activity,
    ]);
} catch (Throwable $e) {
    error_log('admin/get-dashboard-stats failed: ' . $e->getMessage());
    respond(false, 'Unable to load dashboard stats.', [], 500);
}