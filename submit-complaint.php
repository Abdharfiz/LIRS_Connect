<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(false, 'Invalid request method.', [], 405);
}

requireTaxpayer();

$taxpayer_id = $_SESSION['user_id'];
$body = getRequestBody();

$name    = cleanStr($body['name'] ?? '');
$email   = cleanStr($body['email'] ?? '');
$topic   = cleanStr($body['topic'] ?? 'General Enquiry');
$message = cleanStr($body['message'] ?? '');

if ($name === '' || $email === '' || $message === '') {
    respond(false, 'Please fill in all required fields.', [], 422);
}
if (!isValidEmail($email)) {
    respond(false, 'Please enter a valid email address.', [], 422);
}
if (strlen($message) < 5) {
    respond(false, 'Please enter a message.', [], 422);
}

try {
    $stmt = $pdo->prepare(
        'INSERT INTO support_messages (taxpayer_id, name, email, topic, message)
         VALUES (?, ?, ?, ?, ?)'
    );
    $stmt->execute([$taxpayer_id, $name, $email, $topic, $message]);

    respond(true, 'Message sent — an officer will respond by email shortly.', [
        'id' => $pdo->lastInsertId(),
    ]);
} catch (Exception $e) {
    respond(false, 'Failed to send message. Please try again.', [], 500);
}