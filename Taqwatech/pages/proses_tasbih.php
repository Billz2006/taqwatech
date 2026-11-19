<?php
// proses_tasbih.php - menyimpan hitungan tasbih
//   GET  proses_tasbih.php  -> semua hitungan, contoh: {"d0": 12, "d1": 33}
//   POST proses_tasbih.php  -> kunci, jumlah

require __DIR__ . '/../includes/koneksi.php';

// 1. Ambil semua hitungan
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $hasil = [];
    foreach ($pdo->query('SELECT kunci, jumlah FROM tasbih') as $baris) {
        $hasil[$baris['kunci']] = (int) $baris['jumlah'];
    }
    echo json_encode((object) $hasil);   // (object) supaya tetap {} saat kosong
    exit;
}

// 2. Simpan hitungan satu dzikir
$kunci = trim($_POST['kunci'] ?? '');
$jumlah = max(0, (int) ($_POST['jumlah'] ?? 0));

if (!preg_match('/^d[0-9]{1,3}$/', $kunci)) {
    gagal('Kunci dzikir tidak valid.');
}

$stmt = $pdo->prepare(
    'INSERT INTO tasbih (kunci, jumlah) VALUES (?, ?)
     ON DUPLICATE KEY UPDATE jumlah = VALUES(jumlah)'
);
$stmt->execute([$kunci, $jumlah]);

echo json_encode(['ok' => true]);
