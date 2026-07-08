<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(false, 'Invalid request method.', [], 405);
}

$body = getRequestBody();

$email    = strtolower(cleanStr($body['email'] ?? ''));
$payId    = cleanStr($body['PayID'] ?? '');
$password = $body['password'] ?? '';

if ($email === '' || $password === '') {
    respond(false, 'Please enter your email and password.', [], 422);
}

$stmt = $pdo->prepare('SELECT * FROM taxpayers WHERE email = ?');
$stmt->execute([$email]);
$user = $stmt->fetch();

if (!$user || !password_verify($password, $user['password_hash'])) {
    respond(false, 'Invalid email or password. Please try again.', [], 401);
}

// If a PayID was supplied on the login form, it must match the account on file.
if ($payId !== '' && strcasecmp($payId, $user['pay_id']) !== 0) {
    respond(false, 'PayID does not match this account.', [], 401);
}

if ($user['status'] === 'deactivated') {
    respond(false, 'This account has been deactivated. Contact LIRS support.', [], 403);
}

// ---- Establish session ----
$_SESSION['user_id'] = $user['id'];
$_SESSION['role']    = 'taxpayer';
$_SESSION['email']   = $user['email'];

respond(true, 'Login successful.', [
    'id'       => $user['id'],
    'name'     => $user['first_name'] . ' ' . $user['last_name'],
    'email'    => $user['email'],
    'payId'    => $user['pay_id'],
    'role'     => 'taxpayer',
]);
