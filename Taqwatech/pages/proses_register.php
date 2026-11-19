<?php
// proses_register.php - membuat akun baru
//   POST proses_register.php  -> username, password, konfirmasi

require '../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    gagal('Metode tidak diizinkan.', 405);
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
$konfirmasi = $_POST['konfirmasi'] ?? '';

// 1. Periksa isian
if (!preg_match('/^[A-Za-z0-9_]{3,30}$/', $username)) {
    gagal('Username 3-30 karakter, hanya huruf, angka, dan underscore.');
}
if (strcasecmp($username, 'admin') === 0) {
    gagal('Username ini tidak boleh dipakai.');
}
if (strlen($password) < 6) {
    gagal('Password minimal 6 karakter.');
}
if ($password !== $konfirmasi) {
    gagal('Konfirmasi password tidak sama.');
}

// 2. Username belum boleh dipakai orang lain
$stmt = $pdo->prepare('SELECT id FROM users WHERE username = ?');
$stmt->execute([$username]);
if ($stmt->fetch()) {
    gagal('Username sudah dipakai, pilih yang lain.');
}

// 3. Simpan. Password disimpan dalam bentuk hash, BUKAN teks asli.
$stmt = $pdo->prepare('INSERT INTO users (username, password, dibuat) VALUES (?, ?, ?)');
$stmt->execute([$username, password_hash($password, PASSWORD_DEFAULT), date('Y-m-d H:i:s')]);

echo json_encode(['ok' => true]);
