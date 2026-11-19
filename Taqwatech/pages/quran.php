<?php
$judul_halaman = "Baca Al-Qur'an - Taqwatech";
include '../includes/header.php';
?>

    <div class="halaman">
        <span class="label-atas">TAQWATECH / AL-QUR'AN</span>
        <h1 class="judul">Baca Al-Qur'an</h1>
        <p class="sub-judul">Teks Arab, terjemahan Indonesia, dan audio per ayat dari Al Quran Cloud API.</p>

        <!-- ===== TAMPILAN 1: daftar 114 surah ===== -->
        <div id="tampilDaftar">
            <input type="text" id="cariSurah" class="isian" placeholder="Cari surah (nama atau nomor), contoh: baqarah atau 36">
            <div id="statusDaftar" class="status">Memuat daftar surah...</div>
            <div class="quran-grid" id="daftarSurah"></div>
        </div>

        <!-- ===== TAMPILAN 2: membaca satu surah ===== -->
        <div id="tampilBaca" hidden>
            <div class="baca-atas">
                <a href="#" class="tombol tombol-terang">← Daftar Surah</a>
                <div>
                    <button type="button" class="tombol tombol-terang tombol-kecil" id="tombolKecil">A−</button>
                    <button type="button" class="tombol tombol-terang tombol-kecil" id="tombolBesar">A+</button>
                </div>
            </div>

            <div class="card">
                <div class="card-body judul-surah">
                    <div class="arab" id="namaArab"></div>
                    <h4 class="card-title" id="namaLatin"></h4>
                    <p class="card-text" id="infoSurah"></p>
                </div>
            </div>

            <div id="statusBaca" class="status" hidden></div>
            <div class="basmalah arab" id="basmalah" hidden>بِسْمِ ٱللَّهِ ٱلرَّحْمَٰنِ ٱلرَّحِيمِ</div>

            <!-- Ayat-ayat (diisi oleh asset/js/quran.js) -->
            <div id="daftarAyat"></div>

            <div class="baca-navigasi">
                <a href="#" class="tombol tombol-terang" id="surahSebelum">← Surah sebelumnya</a>
                <a href="#" class="tombol" id="surahSesudah">Surah berikutnya →</a>
            </div>
        </div>
    </div>

<script src="../asset/js/quran.js"></script>
<?php include '../includes/footer.php'; ?>
