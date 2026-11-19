<?php
// proses_target.php - menyimpan status ceklis target harian
//   GET  proses_target.php  -> daftar kode target yang sudah selesai HARI INI
//   POST proses_target.php  -> kode, selesai (1 = selesai, 0 = batal)
// Tanggal diambil dari server (zona waktu Asia/Jakarta), bukan dari browser.

require '../includes/koneksi.php';

$hari_ini = date('Y-m-d');

// 1. Ambil target yang sudah selesai hari ini
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $pdo->prepare('SELECT kode FROM target_harian WHERE tanggal = ? AND selesai = 1');
    $stmt->execute([$hari_ini]);

    echo json_encode([
        'tanggal' => $hari_ini,
        'selesai' => $stmt->fetchAll(PDO::FETCH_COLUMN)
    ]);
    exit;
}

// 2. Simpan status satu target
$kode = trim($_POST['kode'] ?? '');
$selesai = ($_POST['selesai'] ?? '0') === '1' ? 1 : 0;

if ($kode === '' || strlen($kode) > 30) {
    gagal('Kode target tidak valid.');
}

// Jika baris sudah ada -> diperbarui, jika belum -> dibuat baru
$stmt = $pdo->prepare(
    'INSERT INTO target_harian (tanggal, kode, selesai) VALUES (?, ?, ?)
     ON DUPLICATE KEY UPDATE selesai = VALUES(selesai)'
);
$stmt->execute([$hari_ini, $kode, $selesai]);

echo json_encode(['ok' => true]);
