// tema-mode.js - mode terang / gelap / otomatis
// Dimuat di <head> (lewat includes/header.php) supaya tema terpasang SEBELUM halaman tampil (tidak berkedip).
// Pilihan pengguna disimpan di localStorage dengan kunci "taqwatech_tema": auto | terang | gelap
// Hasilnya dipasang sebagai atribut data-tema="terang" / "gelap" di tag <html>, dibaca oleh css/tema.css.

var KUNCI_TEMA = 'taqwatech_tema';
var URUTAN_TEMA = ['auto', 'terang', 'gelap'];
var LABEL_TEMA = { auto: '🌓 Auto', terang: '☀️ Terang', gelap: '🌙 Gelap' };
var sistemGelap = window.matchMedia('(prefers-color-scheme: dark)');

// 1. Baca & simpan pilihan
function bacaPilihan() {
  try { return localStorage.getItem(KUNCI_TEMA) || 'auto'; } catch (e) { return 'auto'; }
}
function simpanPilihan(pilihan) {
  try { localStorage.setItem(KUNCI_TEMA, pilihan); } catch (e) {}
}

// 2. Pasang tema ke halaman
function terapkanTema(pilihan) {
  var gelap = pilihan === 'gelap' || (pilihan === 'auto' && sistemGelap.matches);
  document.documentElement.setAttribute('data-tema', gelap ? 'gelap' : 'terang');

  var tombol = document.getElementById('tombolTema');
  if (tombol) {
    tombol.textContent = LABEL_TEMA[pilihan];
    tombol.title = 'Tema: ' + pilihan + ' (klik untuk mengganti)';
  }
}

// 3. Langsung dijalankan saat file dimuat
terapkanTema(bacaPilihan());

// 4. Mode "auto": ikuti perubahan pengaturan perangkat
sistemGelap.addEventListener('change', function () {
  if (bacaPilihan() === 'auto') terapkanTema('auto');
});

// 5. Tombol ganti tema di navbar: auto -> terang -> gelap -> auto
document.addEventListener('DOMContentLoaded', function () {
  terapkanTema(bacaPilihan());

  var tombol = document.getElementById('tombolTema');
  if (!tombol) return;

  tombol.addEventListener('click', function () {
    var berikut = URUTAN_TEMA[(URUTAN_TEMA.indexOf(bacaPilihan()) + 1) % URUTAN_TEMA.length];
    simpanPilihan(berikut);
    terapkanTema(berikut);
  });
});