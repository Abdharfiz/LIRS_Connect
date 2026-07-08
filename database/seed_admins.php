<?php
/**
 * ONE-TIME SCRIPT — creates the default admin account.
 *
 * How to run it:
 *   Option A (browser): visit http://localhost/lirs-v2/database/seed_admins.php
 *   Option B (terminal): php seed_admins.php   (from inside this folder)
 *
 * Delete this file (or move it outside the web root) once you've run it,
 * so nobody can re-run it and reset the admin password later.
 */

require_once __DIR__ . '/../config/db.php';

$defaultAdmins = [
    ['name' => 'Admin', 'email' => 'admin@example.com', 'password' => 'AdminPassword123', 'role' => 'super_admin'],
];

$inserted = [];
$skipped  = [];

foreach ($defaultAdmins as $admin) {
    $check = $pdo->prepare('SELECT id FROM admins WHERE email = ?');
    $check->execute([$admin['email']]);
    if ($check->fetch()) {
        $skipped[] = $admin['email'];
        continue;
    }

    $hash = password_hash($admin['password'], PASSWORD_DEFAULT);
    $stmt = $pdo->prepare(
        'INSERT INTO admins (name, email, password_hash, role) VALUES (?, ?, ?, ?)'
    );
    $stmt->execute([$admin['name'], $admin['email'], $hash, $admin['role']]);
    $inserted[] = $admin['email'];
}

header('Content-Type: text/plain');
echo "Seed complete.\n";
echo "Inserted: " . (empty($inserted) ? 'none' : implode(', ', $inserted)) . "\n";
echo "Already existed (skipped): " . (empty($skipped) ? 'none' : implode(', ', $skipped)) . "\n";
