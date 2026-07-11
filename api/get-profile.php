<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // GET - Retrieve current profile
    requireTaxpayer();
    
    $taxpayer_id = $_SESSION['user_id'];
    
    $stmt = $pdo->prepare(
        'SELECT id, first_name, last_name, email, phone, tin, pay_id, lga, address, status, created_at
         FROM taxpayers 
         WHERE id = ?'
    );
    $stmt->execute([$taxpayer_id]);
    $user = $stmt->fetch();
    
    if (!$user) {
        respond(false, 'User not found.', [], 404);
    }
    
    respond(true, 'Profile retrieved.', [
        'profile' => [
            'id' => $user['id'],
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name'],
            'email' => $user['email'],
            'phone' => $user['phone'],
            'tin' => $user['tin'],
            'pay_id' => $user['pay_id'],
            'lga' => $user['lga'],
            'address' => $user['address'],
            'status' => $user['status'],
            'created_at' => date('M d, Y', strtotime($user['created_at'])),
            'member_since' => date('F Y', strtotime($user['created_at']))
        ]
    ]);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // POST - Update profile
    requireTaxpayer();
    
    $taxpayer_id = $_SESSION['user_id'];
    $body = getRequestBody();

    // Get fields that can be updated — matches every field the edit form
    // on profile.php actually exposes.
    $first_name = cleanStr($body['first_name'] ?? '');
    $last_name  = cleanStr($body['last_name'] ?? '');
    $email      = strtolower(cleanStr($body['email'] ?? ''));
    $phone      = cleanStr($body['phone'] ?? '');
    $lga        = cleanStr($body['lga'] ?? '');
    $address    = cleanStr($body['address'] ?? '');

    // Validation
    if ($first_name === '' || $last_name === '') {
        respond(false, 'First and last name are required.', [], 422);
    }
    if ($email === '' || !isValidEmail($email)) {
        respond(false, 'Please enter a valid email address.', [], 422);
    }
    if ($phone === '') {
        respond(false, 'Phone number is required.', [], 422);
    }
    if (strlen($phone) < 10) {
        respond(false, 'Please enter a valid phone number.', [], 422);
    }

    // Email must stay unique across taxpayers (excluding this taxpayer's
    // own current row).
    $emailCheck = $pdo->prepare('SELECT id FROM taxpayers WHERE email = ? AND id != ?');
    $emailCheck->execute([$email, $taxpayer_id]);
    if ($emailCheck->fetch()) {
        respond(false, 'That email address is already in use by another account.', [], 409);
    }

    try {
        $stmt = $pdo->prepare(
            'UPDATE taxpayers SET first_name = ?, last_name = ?, email = ?, phone = ?, lga = ?, address = ?, updated_at = NOW()
             WHERE id = ?'
        );
        $stmt->execute([$first_name, $last_name, $email, $phone, $lga, $address, $taxpayer_id]);

        // Keep the session's email in sync, since login.php checks against it.
        $_SESSION['email'] = $email;

        respond(true, 'Profile updated successfully.');
    } catch (Exception $e) {
        respond(false, 'Failed to update profile.', [], 500);
    }
} else {
    respond(false, 'Invalid request method.', [], 405);
}