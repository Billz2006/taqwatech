<?php
// api/index.php - "pintu tunggal" semua halaman PHP di Vercel
// vercel.json mengarahkan setiap alamat berakhiran .php ke file ini,
// lalu file ini membuka halaman yang cocok dari folder pages/.

// Daftar halaman yang BOLEH dibuka. Halaman baru harus ditambahkan ke sini.
$boleh = [
    'Login.php', 'Register.php', 'dashboard.php', 'quote.php', 'quran.php',
    'Catatan.php', 'target.php', 'tasbih.php', 'kalenderhijri.php',
    'proses_login.php', 'proses_register.php',
    'proses_catatan.php', 'proses_target.php', 'proses_tasbih.php'
];

// Nama halaman diambil dari ?p=... (diisi vercel.json), cadangannya dari alamat asli
$nama = basename($_GET['p'] ?? parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
if ($nama === '' || $nama === 'index.php') {
    $nama = 'Login.php';                  // alamat utama "/" -> halaman login
}

if (!in_array($nama, $boleh, true)) {
    http_response_code(404);
    echo 'Halaman tidak ditemukan.';
    exit;
}

require __DIR__ . '/../pages/' . $nama;
