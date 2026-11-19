<?php
// proses_catatan.php - menyimpan, menampilkan, dan menghapus catatan
//   GET  proses_catatan.php               -> daftar semua catatan
//   POST proses_catatan.php?aksi=tambah   -> judul, isi
//   POST proses_catatan.php?aksi=hapus    -> id

require __DIR__ . '/../includes/koneksi.php';

$aksi = $_GET['aksi'] ?? 'daftar';
$metode = $_SERVER['REQUEST_METHOD'];

// 1. Tampilkan semua catatan (terbaru di atas)
if ($aksi === 'daftar') {
    $data = $pdo->query('SELECT id, judul, isi, dibuat FROM catatan ORDER BY id DESC')->fetchAll();
    echo json_encode($data);
    exit;
}

// 2. Tambah catatan baru
if ($aksi === 'tambah' && $metode === 'POST') {
    $judul = trim($_POST['judul'] ?? '');
    $isi = trim($_POST['isi'] ?? '');

    if ($judul === '' || $isi === '') {
        gagal('Judul dan isi catatan wajib diisi.');
    }

    $stmt = $pdo->prepare('INSERT INTO catatan (judul, isi, dibuat) VALUES (?, ?, ?)');
    $stmt->execute([mb_substr($judul, 0, 150), $isi, date('Y-m-d H:i:s')]);

    echo json_encode(['ok' => true, 'id' => $pdo->lastInsertId()]);
    exit;
}

// 3. Hapus catatan
if ($aksi === 'hapus' && $metode === 'POST') {
    $stmt = $pdo->prepare('DELETE FROM catatan WHERE id = ?');
    $stmt->execute([(int) ($_POST['id'] ?? 0)]);

    echo json_encode(['ok' => true]);
    exit;
}

gagal('Aksi tidak dikenal.');
