<?php
// proses_login.php - memeriksa username & password akun hasil Register
//   POST proses_login.php  -> username, password

require __DIR__ . '/../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    gagal('Metode tidak diizinkan.', 405);
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

$stmt = $pdo->prepare('SELECT password FROM users WHERE username = ?');
$stmt->execute([$username]);
$akun = $stmt->fetch();

// password_verify membandingkan password yang diketik dengan hash di database
if (!$akun || !password_verify($password, $akun['password'])) {
    gagal('Username atau password salah.', 401);
}

echo json_encode(['ok' => true]);
