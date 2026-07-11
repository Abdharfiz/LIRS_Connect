<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET' && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(false, 'Invalid request method.', [], 405);
}

requireTaxpayer();

$taxpayer_id = $_SESSION['user_id'];

// GET - Retrieve notifications
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $unread_only = (bool)($_GET['unread_only'] ?? false);
    $limit = (int)($_GET['limit'] ?? 20);
    
    $query = 'SELECT id, type, title, message, is_read, complaint_id, created_at
              FROM notifications 
              WHERE taxpayer_id = ?';
    $params = [$taxpayer_id];
    
    if ($unread_only) {
        $query .= ' AND is_read = FALSE';
    }
    
    $query .= ' ORDER BY created_at DESC LIMIT ?';
    $params[] = $limit;
    
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    $notifications = $stmt->fetchAll();
    
    // Get unread count
    $count_stmt = $pdo->prepare('SELECT COUNT(*) as unread FROM notifications WHERE taxpayer_id = ? AND is_read = FALSE');
    $count_stmt->execute([$taxpayer_id]);
    $unread_count = $count_stmt->fetch()['unread'];
    
    // Format response
    $formatted = [];
    foreach ($notifications as $notif) {
        $formatted[] = [
            'id' => $notif['id'],
            'type' => $notif['type'],
            'title' => $notif['title'],
            'message' => $notif['message'],
            'is_read' => (bool)$notif['is_read'],
            'complaint_id' => $notif['complaint_id'],
            'created_at' => date('M d, Y h:i A', strtotime($notif['created_at'])),
            'time_ago' => getTimeAgo($notif['created_at'])
        ];
    }
    
    respond(true, 'Notifications retrieved.', [
        'notifications' => $formatted,
        'unread_count' => $unread_count
    ]);
}

// POST - Mark notifications as read
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $body = getRequestBody();
    $action = cleanStr($body['action'] ?? '');
    
    if ($action === 'mark-read') {
        $notification_id = (int)($body['notification_id'] ?? 0);
        
        if ($notification_id === 0) {
            respond(false, 'Notification ID is required.', [], 400);
        }
        
        // Verify notification belongs to taxpayer
        $verify = $pdo->prepare('SELECT id FROM notifications WHERE id = ? AND taxpayer_id = ?');
        $verify->execute([$notification_id, $taxpayer_id]);
        if (!$verify->fetch()) {
            respond(false, 'Notification not found.', [], 404);
        }
        
        $stmt = $pdo->prepare('UPDATE notifications SET is_read = TRUE WHERE id = ?');
        $stmt->execute([$notification_id]);
        
        respond(true, 'Notification marked as read.');
    } elseif ($action === 'mark-all-read') {
        $stmt = $pdo->prepare('UPDATE notifications SET is_read = TRUE WHERE taxpayer_id = ? AND is_read = FALSE');
        $stmt->execute([$taxpayer_id]);
        
        respond(true, 'All notifications marked as read.');
    } else {
        respond(false, 'Invalid action.', [], 400);
    }
}

// Helper function to get "time ago" format
function getTimeAgo($timestamp) {
    $seconds = time() - strtotime($timestamp);
    
    if ($seconds < 60) return 'just now';
    $minutes = intdiv($seconds, 60);
    if ($minutes < 60) return $minutes . 'm ago';
    $hours = intdiv($minutes, 60);
    if ($hours < 24) return $hours . 'h ago';
    $days = intdiv($hours, 24);
    if ($days < 7) return $days . 'd ago';
    $weeks = intdiv($days, 7);
    if ($weeks < 4) return $weeks . 'w ago';
    return date('M d', strtotime($timestamp));
}
