<?php
// koneksi.php - menghubungkan PHP ke database MySQL
// Nilainya dibaca dari Environment Variables (diisi di dashboard Vercel):
//   DB_HOST, DB_PORT, DB_USER, DB_PASS, DB_NAME
// Kalau belum diisi, dipakai nilai bawaan XAMPP (untuk uji coba di komputer sendiri).

error_reporting(E_ALL & ~E_DEPRECATED);
ini_set('display_errors', '0');          // jangan tampilkan error PHP mentah (merusak JSON)
date_default_timezone_set('Asia/Jakarta');
header('Content-Type: application/json; charset=utf-8');

// Error apa pun yang tidak tertangkap dikirim sebagai JSON, detailnya masuk ke Logs Vercel
set_exception_handler(function ($e) {
    error_log($e);
    http_response_code(500);
    echo json_encode(['error' => 'Terjadi kesalahan di server. Cek Logs di dashboard Vercel.']);
});

$host = getenv('DB_HOST') ?: 'localhost';
$port = getenv('DB_PORT') ?: '3306';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: '';
$nama_database = getenv('DB_NAME') ?: 'taqwatech';

$opsi = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

// Jika penyedia database mewajibkan SSL: isi Environment Variable DB_SSL = 1
if (getenv('DB_SSL') === '1') {
    $kunci_verifikasi = class_exists('Pdo\Mysql') ? Pdo\Mysql::ATTR_SSL_VERIFY_SERVER_CERT : PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT;
    $opsi[$kunci_verifikasi] = false;

    // (opsional) lokasi file sertifikat CA, isi lewat DB_SSL_CA
    if (getenv('DB_SSL_CA')) {
        $kunci_ca = class_exists('Pdo\Mysql') ? Pdo\Mysql::ATTR_SSL_CA : PDO::MYSQL_ATTR_SSL_CA;
        $opsi[$kunci_ca] = getenv('DB_SSL_CA');
    }
}

try {
    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$nama_database;charset=utf8mb4",
        $user,
        $pass,
        $opsi
    );
} catch (PDOException $e) {
    error_log($e);
    http_response_code(500);
    echo json_encode(['error' => 'Koneksi database gagal. Periksa Environment Variables DB_* dan pastikan database sudah di-import.']);
    exit;
}

// Fungsi bantu: kirim pesan error lalu berhenti
function gagal($pesan, $kode = 400) {
    http_response_code($kode);
    echo json_encode(['error' => $pesan]);
    exit;
}
