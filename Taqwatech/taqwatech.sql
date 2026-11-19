-- =====================================================
-- taqwatech.sql - database Taqwatech (MySQL / MariaDB)
-- Cara pakai: buka phpMyAdmin > tab "Import" > pilih file ini > Go
-- (atau jalankan:  mysql -u root -p < database.sql)
-- =====================================================

CREATE DATABASE IF NOT EXISTS taqwatech
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE taqwatech;


-- 1. Tabel catatan (halaman Catatan.html)
CREATE TABLE IF NOT EXISTS catatan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(150) NOT NULL,
    isi TEXT NOT NULL,
    dibuat DATETIME NOT NULL
);


-- 2. Tabel target harian (halaman target.html)
--    Satu baris = satu target pada satu tanggal.
--    kode contoh: sholat-subuh, amal-quran
CREATE TABLE IF NOT EXISTS target_harian (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tanggal DATE NOT NULL,
    kode VARCHAR(30) NOT NULL,
    selesai TINYINT(1) NOT NULL DEFAULT 0,
    UNIQUE KEY unik_target (tanggal, kode)
);


-- 3. Tabel tasbih (halaman tasbih.html)
--    kunci contoh: d0 (Subhanallah), d1 (Alhamdulillah), d5 (Asmaul Husna ke-1)
CREATE TABLE IF NOT EXISTS tasbih (
    kunci VARCHAR(20) PRIMARY KEY,
    jumlah INT NOT NULL DEFAULT 0
);


-- 4. Tabel users (halaman Register.php & Login.php)
--    Password disimpan sebagai hash (password_hash), bukan teks asli.
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    dibuat DATETIME NOT NULL
);
