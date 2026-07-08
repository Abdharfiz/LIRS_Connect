<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(false, 'Invalid request method.', [], 405);
}

$body = getRequestBody();

$email    = strtolower(cleanStr($body['email'] ?? ''));
$password = $body['password'] ?? '';

if ($email === '' || $password === '') {
    respond(false, 'Please enter your email and password.', [], 422);
}

$stmt = $pdo->prepare('SELECT * FROM admins WHERE email = ?');
$stmt->execute([$email]);
$admin = $stmt->fetch();

if (!$admin || !password_verify($password, $admin['password_hash'])) {
    respond(false, 'Invalid admin credentials. Check your email and password.', [], 401);
}

// ---- Establish session ----
$_SESSION['admin_id'] = $admin['id'];
$_SESSION['role']     = $admin['role']; // 'super_admin' or 'officer'
$_SESSION['email']    = $admin['email'];

respond(true, 'Login successful.', [
    'id'    => $admin['id'],
    'name'  => $admin['name'],
    'email' => $admin['email'],
    'role'  => $admin['role'],
]);
