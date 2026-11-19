<?php
$judul_halaman = 'Catatan - Taqwatech';
include __DIR__ . '/../includes/header.php';
?>

    <div class="halaman" style="max-width:640px">
        <a href="dashboard.php" class="tombol tombol-terang">← Kembali</a>
        <br><br>
        <span class="label-atas">TAQWATECH / CATATAN</span>
        <h1 class="judul">Catatan</h1>
        <p class="sub-judul">Simpan refleksi, target, dan hal baik yang ingin kamu ingat.</p>

        <!-- Form tulis catatan -->
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tulis catatan baru</h4>
                <form id="noteForm">
                    <label for="title">Judul catatan</label>
                    <input type="text" id="title" class="isian" placeholder="Contoh: Target hari ini" required>

                    <label for="content">Isi catatan</label>
                    <textarea id="content" class="isian" rows="4" placeholder="Tulis catatanmu di sini..." required></textarea>

                    <button type="submit" class="tombol">Simpan Catatan</button>
                </form>
            </div>
        </div>

        <!-- Daftar catatan (diisi oleh asset/js/catatan.js dari database) -->
        <h2 class="judul-bagian">Catatan tersimpan</h2>
        <div id="notesContainer"></div>
    </div>

<script src="/asset/js/api.js"></script>
<script src="/asset/js/catatan.js"></script>
<?php include __DIR__ . '/../includes/footer.php'; ?>
