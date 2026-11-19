// target.js - logika halaman target.php
// Status ceklis disimpan per hari di database MySQL lewat proses_target.php
// Tiap tombol punya atribut data-kode (contoh: sholat-subuh) sebagai penanda di database.

// 1. Tampilkan tanggal hari ini
var teksTanggal = new Date().toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });
document.querySelectorAll('.tanggal-hari-ini').forEach(function (el) {
  el.textContent = teksTanggal;
});

// 2. Ubah tampilan tombol
function atur(tombol, sudah) {
  if (sudah) {
    tombol.classList.add('selesai');
    tombol.textContent = '✓ Selesai';
  } else {
    tombol.classList.remove('selesai');
    tombol.textContent = 'Tandai selesai';
  }
}

var semuaTombol = document.querySelectorAll('.tombol-status');

// 3. Ambil status hari ini dari database
ambilData('proses_target.php')
  .then(function (hasil) {
    semuaTombol.forEach(function (tombol) {
      atur(tombol, hasil.selesai.indexOf(tombol.dataset.kode) !== -1);
    });
  })
  .catch(function () { alert(PESAN_SERVER_GAGAL); });

// 4. Saat tombol diklik: ubah tampilan, lalu simpan ke database
semuaTombol.forEach(function (tombol) {
  tombol.addEventListener('click', function () {
    var sudah = !tombol.classList.contains('selesai');
    atur(tombol, sudah);

    kirimData('proses_target.php', { kode: tombol.dataset.kode, selesai: sudah ? 1 : 0 })
      .catch(function () {
        atur(tombol, !sudah);          // gagal disimpan -> kembalikan tampilan
        alert('Gagal menyimpan ke database. ' + PESAN_SERVER_GAGAL);
      });
  });
});
