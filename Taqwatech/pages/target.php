<?php
$judul_halaman = 'Target Kebiasaan - Taqwatech';
include __DIR__ . '/../includes/header.php';
?>

    <div class="halaman">
        <a href="dashboard.php" class="tombol tombol-terang">← Kembali</a>
        <br><br>

        <!-- ===== Aktivitas Sholat ===== -->
        <span class="label-atas">TAQWATECH / SHOLAT</span>
        <h1 class="judul">Aktivitas Sholat</h1>
        <p class="sub-judul">Catat dan evaluasi ibadah salat fardhu harianmu.</p>
        <div class="kotak-info">Checklist ini adalah pengingat pribadi. Gunakan untuk mengevaluasi rutinitas dengan tenang.</div>
        <h2 class="judul-bagian" style="margin-top:0">Sholat Fardhu Hari Ini</h2>
        <p class="tanggal-hari-ini sub-judul"></p>

        <div class="row row-cols-1 md:row-cols-2 g-4">
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="ikon-card">🌅</div>
                        <h4 class="card-title">Subuh</h4>
                        <p class="card-text">2 rakaat dikerjakan sebelum matahari terbit.</p>
                        <button type="button" class="tombol tombol-status" data-kode="sholat-subuh">Tandai selesai</button>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="ikon-card">☀️</div>
                        <h4 class="card-title">Dzuhur</h4>
                        <p class="card-text">4 rakaat dikerjakan setelah matahari tergelincir.</p>
                        <button type="button" class="tombol tombol-status" data-kode="sholat-dzuhur">Tandai selesai</button>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="ikon-card">🌤️</div>
                        <h4 class="card-title">Ashar</h4>
                        <p class="card-text">4 rakaat dikerjakan pada waktu sore.</p>
                        <button type="button" class="tombol tombol-status" data-kode="sholat-ashar">Tandai selesai</button>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="ikon-card">🌆</div>
                        <h4 class="card-title">Magrib</h4>
                        <p class="card-text">3 rakaat dikerjakan setelah matahari terbenam.</p>
                        <button type="button" class="tombol tombol-status" data-kode="sholat-magrib">Tandai selesai</button>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="ikon-card">🌙</div>
                        <h4 class="card-title">Isya</h4>
                        <p class="card-text">4 rakaat dikerjakan pada malam hari.</p>
                        <button type="button" class="tombol tombol-status" data-kode="sholat-isya">Tandai selesai</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== Tantangan Amal ===== -->
        <br><br>
        <span class="label-atas">TAQWATECH / TANTANGAN</span>
        <h2 class="judul">Tantangan Amal</h2>
        <p class="sub-judul">Pilih tantangan kebaikan sederhana sesuai kemampuanmu.</p>
        <div class="kotak-info">Tantangan ini adalah pengingat untuk melakukan kebaikan, bukan perlombaan.</div>

        <div class="row row-cols-1 md:row-cols-2 g-4">
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="ikon-card">📖</div>
                        <h4 class="card-title">Membaca Al-Qur'an</h4>
                        <p class="card-text">Baca beberapa halaman sesuai waktu dan kemampuanmu.</p>
                        <button type="button" class="tombol tombol-status" data-kode="amal-quran">Tandai selesai</button>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="ikon-card">🤝</div>
                        <h4 class="card-title">Melakukan Satu Kebaikan</h4>
                        <p class="card-text">Bantu orang lain atau lakukan hal baik sederhana.</p>
                        <button type="button" class="tombol tombol-status" data-kode="amal-kebaikan">Tandai selesai</button>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="ikon-card">🤲</div>
                        <h4 class="card-title">Meluangkan Waktu untuk Dzikir</h4>
                        <p class="card-text">Ambil waktu sejenak untuk mengingat Allah.</p>
                        <button type="button" class="tombol tombol-status" data-kode="amal-dzikir">Tandai selesai</button>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="ikon-card">💚</div>
                        <h4 class="card-title">Menjaga Ucapan</h4>
                        <p class="card-text">Biasakan berkata baik dan tidak menyakiti orang lain.</p>
                        <button type="button" class="tombol tombol-status" data-kode="amal-ucapan">Tandai selesai</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="../asset/js/api.js"></script>
<script src="../asset/js/target.js"></script>
<?php include '../includes/footer.php'; ?>
