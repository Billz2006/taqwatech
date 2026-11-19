<?php
$judul_halaman = 'Tasbih Digital - Taqwatech';
include '../includes/header.php';
?>

    <div class="halaman">
      <div class="tasbih-wrap">
        <span class="label-atas">TAQWATECH / TASBIH</span>
        <h1 class="judul">Tasbih Digital</h1>
        <p class="sub-judul">Hitung dzikirmu. Daftar Asmaul Husna diambil dari API Aladhan.</p>

        <!-- Pilihan dzikir & target -->
        <div class="row g-3" style="text-align:left">
            <div class="col"><label for="pilih">Pilih dzikir</label><select id="pilih" class="isian"></select></div>
            <div class="col"><label for="target">Target</label><input type="number" id="target" class="isian" value="33" min="1"></div>
        </div>

        <!-- Teks dzikir -->
        <div class="card">
            <div class="card-body">
                <div class="tasbih-arab arab" id="arab"></div>
                <h4 class="card-title" id="latin"></h4>
                <p class="card-text" id="arti"></p>
            </div>
        </div>

        <!-- Tombol hitung -->
        <button type="button" class="tasbih-tombol" id="tombolHitung"><b id="jumlah">0</b>KETUK UNTUK MENGHITUNG</button>
        <div class="progres"><i id="isiProgres"></i></div>
        <p id="teksProgres">0 / 33</p>

        <button type="button" class="tombol tombol-terang" id="tombolKurang">↶ Kurangi</button>
        <button type="button" class="tombol" id="tombolReset">Reset</button>
        <p id="pesan" style="margin-top:14px"></p>
      </div>
    </div>

<script src="../asset/js/api.js"></script>
<script src="../asset/js/tasbih.js"></script>
<?php include '../includes/footer.php'; ?>
