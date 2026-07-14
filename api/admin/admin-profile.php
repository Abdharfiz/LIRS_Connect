<?php
require_once __DIR__ . '/../../includes/helpers.php';
require_once __DIR__ . '/../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    requireAdmin();
    $admin_id = $_SESSION['admin_id'];

    $stmt = $pdo->prepare('SELECT id, name, email, role, created_at FROM admins WHERE id = ?');
    $stmt->execute([$admin_id]);
    $admin = $stmt->fetch();

    if (!$admin) {
        respond(false, 'Admin not found.', [], 404);
    }

    // A little context on their workload — how many complaints they're
    // currently handling and how many they've closed out.
    $statsStmt = $pdo->prepare(
        "SELECT
            SUM(status IN ('new','pending','under_review')) AS active_count,
            SUM(status IN ('resolved','rejected','closed')) AS closed_count,
            COUNT(*) AS total_count
         FROM complaints WHERE assigned_to = ?"
    );
    $statsStmt->execute([$admin_id]);
    $stats = $statsStmt->fetch();

    respond(true, 'Profile retrieved.', [
        'profile' => [
            'id' => $admin['id'],
            'name' => $admin['name'],
            'email' => $admin['email'],
            'role' => $admin['role'],
            'created_at' => date('M d, Y', strtotime($admin['created_at'])),
        ],
        'stats' => [
            'active' => (int)($stats['active_count'] ?? 0),
            'closed' => (int)($stats['closed_count'] ?? 0),
            'total' => (int)($stats['total_count'] ?? 0),
        ],
    ]);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    requireAdmin();
    $admin_id = $_SESSION['admin_id'];
    $body = getRequestBody();
    $action = cleanStr($body['action'] ?? 'update-info');

    if ($action === 'change-password') {
        $current = (string)($body['current_password'] ?? '');
        $new = (string)($body['new_password'] ?? '');
        $confirm = (string)($body['confirm_password'] ?? '');

        if ($current === '' || $new === '') {
            respond(false, 'Please fill in all password fields.', [], 422);
        }
        if (strlen($new) < 6) {
            respond(false, 'New password must be at least 6 characters.', [], 422);
        }
        if ($new !== $confirm) {
            respond(false, 'New passwords do not match.', [], 422);
        }

        $stmt = $pdo->prepare('SELECT password_hash FROM admins WHERE id = ?');
        $stmt->execute([$admin_id]);
        $row = $stmt->fetch();

        if (!$row || !password_verify($current, $row['password_hash'])) {
            respond(false, 'Current password is incorrect.', [], 401);
        }

        $newHash = password_hash($new, PASSWORD_DEFAULT);
        $update = $pdo->prepare('UPDATE admins SET password_hash = ? WHERE id = ?');
        $update->execute([$newHash, $admin_id]);

        respond(true, 'Password changed successfully.');
    }

    // Default action: update-info (name/email)
    $name = cleanStr($body['name'] ?? '');
    $email = strtolower(cleanStr($body['email'] ?? ''));

    if ($name === '') {
        respond(false, 'Name is required.', [], 422);
    }
    if ($email === '' || !isValidEmail($email)) {
        respond(false, 'Please enter a valid email address.', [], 422);
    }

    $emailCheck = $pdo->prepare('SELECT id FROM admins WHERE email = ? AND id != ?');
    $emailCheck->execute([$email, $admin_id]);
    if ($emailCheck->fetch()) {
        respond(false, 'That email address is already in use by another admin account.', [], 409);
    }

    $stmt = $pdo->prepare('UPDATE admins SET name = ?, email = ? WHERE id = ?');
    $stmt->execute([$name, $email, $admin_id]);
    $_SESSION['email'] = $email;

    respond(true, 'Profile updated successfully.');
} else {
    respond(false, 'Invalid request method.', [], 405);
}