<?php
$judul_halaman = 'Kalender Hijriah - Taqwatech';
include '../includes/header.php';
?>

    <div class="halaman">
        <a href="dashboard.php" class="tombol tombol-terang">← Kembali</a>
        <br><br>
        <span class="label-atas">TAQWATECH / KALENDER</span>
        <h1 class="judul">Kalender Hijriah</h1>
        <p class="sub-judul" id="hariIni">Memuat tanggal hari ini...</p>

        <div class="card">
            <div class="card-body">
                <!-- Navigasi bulan -->
                <div class="kal-atas">
                    <button type="button" class="tombol tombol-terang" id="bulanSebelum">‹</button>
                    <h2 id="judulBulan">...</h2>
                    <button type="button" class="tombol tombol-terang" id="bulanSesudah">›</button>
                </div>

                <div id="statusKal" class="status" hidden></div>
                <!-- Kotak tanggal (diisi oleh asset/js/kalender.js) -->
                <div class="kal-grid" id="kalender"></div>
            </div>
        </div>

        <div class="card" style="margin-top:20px">
            <div class="card-body">
                <h4 class="card-title">Hari besar bulan ini</h4>
                <ul class="daftar-libur" id="daftarLibur"></ul>
            </div>
        </div>
    </div>

<script src="../asset/js/kalender.js"></script>
<?php include '../includes/footer.php'; ?>
