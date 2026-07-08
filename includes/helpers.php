<?php
/**
 * Shared helpers for every API endpoint.
 * Include this BEFORE config/db.php in each api/*.php file.
 */

// Start the PHP session (this is what makes a user "logged in" across pages).
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// All API responses are JSON.
header('Content-Type: application/json');

// Allow the frontend to send cookies with fetch() requests even if it's
// opened from a slightly different local URL. Same-origin is safest —
// if you serve the frontend from the same XAMPP htdocs folder as this
// backend, you generally won't need to touch this.
header('Access-Control-Allow-Credentials: true');

/**
 * Send a JSON response and stop execution.
 */
function respond(bool $success, string $message, array $data = [], int $httpCode = 200): void
{
    http_response_code($httpCode);
    echo json_encode(array_merge([
        'success' => $success,
        'message' => $message,
    ], $data ? ['data' => $data] : []));
    exit;
}

/**
 * Read JSON body sent by fetch() as application/json, OR fall back to
 * regular POST form data — so this works either way the frontend sends it.
 */
function getRequestBody(): array
{
    $raw = file_get_contents('php://input');
    $json = json_decode($raw, true);
    if (is_array($json)) {
        return $json;
    }
    return $_POST;
}

/** Trim + basic sanitize for a string field. */
function cleanStr(?string $value): string
{
    return trim($value ?? '');
}

/** Simple email format check. */
function isValidEmail(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/** Reject the request unless it's a taxpayer session. */
function requireTaxpayer(): void
{
    if (empty($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'taxpayer') {
        respond(false, 'You must be logged in as a taxpayer.', [], 401);
    }
}

/** Reject the request unless it's an admin/officer session. */
function requireAdmin(): void
{
    if (empty($_SESSION['admin_id'])) {
        respond(false, 'You must be logged in as an admin.', [], 401);
    }
}
