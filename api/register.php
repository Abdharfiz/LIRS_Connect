<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(false, 'Invalid request method.', [], 405);
}

$body = getRequestBody();

$firstName = cleanStr($body['fname'] ?? '');
$lastName  = cleanStr($body['lname'] ?? '');
$payId     = cleanStr($body['PayID'] ?? '');
$email     = strtolower(cleanStr($body['email'] ?? ''));
$phone     = cleanStr($body['phone'] ?? '');
$tin       = cleanStr($body['tin'] ?? '');
$password  = $body['password'] ?? '';
$confirm   = $body['confirmPassword'] ?? '';

// ---- Validation ----
if ($firstName === '' || $lastName === '' || $payId === '' || $email === '' || $phone === '' || $tin === '' || $password === '') {
    respond(false, 'Please fill in all required fields.', [], 422);
}
if (!isValidEmail($email)) {
    respond(false, 'Please enter a valid email address.', [], 422);
}
if (strlen($password) < 6) {
    respond(false, 'Password must be at least 6 characters.', [], 422);
}
if ($confirm !== '' && $password !== $confirm) {
    respond(false, 'Passwords do not match.', [], 422);
}

// ---- Check for existing email / PayID ----
$check = $pdo->prepare('SELECT id FROM taxpayers WHERE email = ? OR pay_id = ?');
$check->execute([$email, $payId]);
if ($check->fetch()) {
    respond(false, 'An account with this email or PayID already exists.', [], 409);
}

// ---- Create the account ----
$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $pdo->prepare(
    'INSERT INTO taxpayers (first_name, last_name, pay_id, email, phone, tin, password_hash)
     VALUES (?, ?, ?, ?, ?, ?, ?)'
);
$stmt->execute([$firstName, $lastName, $payId, $email, $phone, $tin, $hash]);

respond(true, 'Account created successfully. You can now log in.', [
    'id'    => $pdo->lastInsertId(),
    'email' => $email,
]);
