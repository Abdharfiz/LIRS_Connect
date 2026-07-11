<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(false, 'Invalid request method.', [], 405);
}

requireTaxpayer();

$body = getRequestBody();
$taxpayer_id = $_SESSION['user_id'];

$category = cleanStr($body['category'] ?? '');
$subject = cleanStr($body['subject'] ?? '');
$description = cleanStr($body['description'] ?? '');

if ($category === '') {
    respond(false, 'Please select a complaint category.', [], 422);
}
if ($subject === '') {
    respond(false, 'Please enter a complaint subject.', [], 422);
}
if ($description === '') {
    respond(false, 'Please enter a complaint description.', [], 422);
}
if (strlen($subject) < 5 || strlen($subject) > 200) {
    respond(false, 'Subject must be between 5 and 200 characters.', [], 422);
}
if (strlen($description) < 20) {
    respond(false, 'Description must be at least 20 characters.', [], 422);
}

$valid_categories = ['assessment', 'payment', 'refund', 'tax_clearance', 'other'];
$category_map = [
    'tax clearance certificate' => 'tax_clearance',
    'payment verification' => 'payment',
    'incorrect tax assessment' => 'assessment',
    'account / login issues' => 'other',
    'account/login issues' => 'other',
    'other' => 'other',
];

if (isset($category_map[strtolower($category)])) {
    $category = $category_map[strtolower($category)];
}

if (!in_array($category, $valid_categories, true)) {
    respond(false, 'Invalid complaint category.', [], 422);
}

$attachment_path = null;
if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['attachment'];
    $max_size = 5 * 1024 * 1024;
    $allowed_types = ['application/pdf', 'image/jpeg', 'image/png', 'application/msword'];

    if ($file['size'] > $max_size) {
        respond(false, 'File size cannot exceed 5MB.', [], 422);
    }
    if (!in_array($file['type'], $allowed_types, true)) {
        respond(false, 'Invalid file type. Allowed: PDF, JPG, PNG, DOC.', [], 422);
    }

    $upload_dir = __DIR__ . '/../uploads/complaints/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = 'complaint_' . $taxpayer_id . '_' . time() . '.' . $file_extension;
    $file_path = $upload_dir . $filename;

    if (!move_uploaded_file($file['tmp_name'], $file_path)) {
        respond(false, 'Failed to upload file.', [], 500);
    }

    $attachment_path = 'uploads/complaints/' . $filename;
}

try {
    $stmt = $pdo->prepare(
        'INSERT INTO complaints (taxpayer_id, category, subject, description, attachment_path, status, priority)
         VALUES (?, ?, ?, ?, ?, ?, ?)'
    );
    $stmt->execute([
        $taxpayer_id,
        $category,
        $subject,
        $description,
        $attachment_path,
        'new',
        'medium',
    ]);

    $complaint_id = $pdo->lastInsertId();

    $notif_stmt = $pdo->prepare(
        'INSERT INTO notifications (taxpayer_id, complaint_id, type, title, message)
         VALUES (?, ?, ?, ?, ?)'
    );
    $notif_stmt->execute([
        $taxpayer_id,
        $complaint_id,
        'complaint_submitted',
        'Complaint Submitted Successfully',
        'Your complaint has been submitted and assigned ID #' . str_pad((string)$complaint_id, 6, '0', STR_PAD_LEFT),
    ]);

    respond(true, 'Complaint submitted successfully!', [
        'complaint_id' => $complaint_id,
        'reference_id' => 'CPL-' . str_pad((string)$complaint_id, 6, '0', STR_PAD_LEFT),
    ]);
} catch (Exception $e) {
    respond(false, 'Failed to submit complaint. Please try again.', [], 500);
}
