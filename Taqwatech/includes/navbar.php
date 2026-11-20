<?php
// navbar.php - navbar Bootstrap yang dipakai SEMUA halaman
// Untuk menambah / mengubah menu, cukup edit daftar $menu di bawah ini.

$menu = [
    'dashboard.php'     => 'Home',
    'quote.php'         => 'Quote islamic',
    'quran.php'         => "Al-Qur'an",
    'Catatan.php'       => 'Catatan',
    'target.php'        => 'Target kebiasaan',
    'tasbih.php'        => 'Tasbih',
    'kalenderhijri.php' => 'Kalender Hijriah',
    'Login.php'         => 'Logout',
];

// Nama file halaman yang sedang dibuka (supaya menunya ditandai active)
$halaman_sekarang = basename($_GET['p'] ?? parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
?>
<nav class="navbar bg-1 fg-2">
  <div class="container-fluid">
    <button class="btn-icon navbar-toggler" type="button" data-bs-toggle="drawer" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon" aria-hidden="true"></span>
    </button>
    <a class="navbar-brand" href="dashboard.php">Takwatech</a>
    <button type="button" id="tombolTema" class="tombol-tema" title="Ganti tema">🌓 Auto</button>
    <dialog class="drawer drawer-end" tabindex="-1" id="navbarTogglerDemo03" aria-labelledby="navbarTogglerDemo03Label">
      <div class="drawer-header">
        <h5 class="drawer-title" id="navbarTogglerDemo03Label">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="drawer" aria-label="Close"></button>
      </div>
      <div class="drawer-body">
        <ul class="navbar-nav me-auto mb-2">
          <?php foreach ($menu as $file => $nama) { ?>
          <li class="nav-item">
            <a class="nav-link<?= ($file === $halaman_sekarang) ? ' active' : '' ?>" href="<?= $file ?>"><?= $nama ?></a>
          </li>
          <?php } ?>
        </ul>
      </div>
    </dialog>
  </div>
</nav>