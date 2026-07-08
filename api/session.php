<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../config/db.php';

// Taxpayer session
if (!empty($_SESSION['user_id']) && ($_SESSION['role'] ?? '') === 'taxpayer') {
    $stmt = $pdo->prepare('SELECT id, first_name, last_name, email, pay_id FROM taxpayers WHERE id = ?');
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();

    if ($user) {
        respond(true, 'Authenticated.', [
            'loggedIn' => true,
            'role'     => 'taxpayer',
            'id'       => $user['id'],
            'name'     => $user['first_name'] . ' ' . $user['last_name'],
            'email'    => $user['email'],
            'payId'    => $user['pay_id'],
        ]);
    }
}

// Admin / officer session
if (!empty($_SESSION['admin_id'])) {
    $stmt = $pdo->prepare('SELECT id, name, email, role FROM admins WHERE id = ?');
    $stmt->execute([$_SESSION['admin_id']]);
    $admin = $stmt->fetch();

    if ($admin) {
        respond(true, 'Authenticated.', [
            'loggedIn' => true,
            'role'     => $admin['role'],
            'id'       => $admin['id'],
            'name'     => $admin['name'],
            'email'    => $admin['email'],
        ]);
    }
}

// Nobody logged in
respond(true, 'Not authenticated.', ['loggedIn' => false]);
