<?php
// koneksi.php - menghubungkan PHP ke database MySQL "taqwatech"
// Dipanggil oleh proses_catatan.php, proses_target.php, dan proses_tasbih.php

date_default_timezone_set('Asia/Jakarta');
header('Content-Type: application/json; charset=utf-8');

// Sesuaikan dengan MySQL kamu (bawaan XAMPP: user root, password kosong)
$host = 'localhost';
$user = 'root';
$pass = '';
$nama_database = 'taqwatech';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$nama_database;charset=utf8mb4",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Koneksi database gagal. Pastikan MySQL menyala dan database taqwatech sudah di-import.']);
    exit;
}

// Fungsi bantu: kirim pesan error lalu berhenti
function gagal($pesan, $kode = 400) {
    http_response_code($kode);
    echo json_encode(['error' => $pesan]);
    exit;
}
