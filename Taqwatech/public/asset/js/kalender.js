// kalender.js - logika halaman kalenderhijri.php
// Data tanggal Hijriah diambil dari API Aladhan (https://aladhan.com/islamic-calendar-api)

var sekarang = new Date();
var tahun = sekarang.getFullYear();
var bulan = sekarang.getMonth() + 1;          // 1 - 12
var namaHari = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];

function ambil(id) { return document.getElementById(id); }
function dua(n) { return String(n).padStart(2, '0'); }
function formatTanggal(d) {
  return d.toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });
}

// 1. Tampilkan tanggal hari ini (Masehi + Hijriah)
fetch('https://api.aladhan.com/v1/gToH/' + dua(sekarang.getDate()) + '-' + dua(bulan) + '-' + tahun)
  .then(function (res) { return res.json(); })
  .then(function (hasil) {
    var h = hasil.data.hijri;
    ambil('hariIni').textContent = 'Hari ini: ' + formatTanggal(sekarang) + '  •  ' + parseInt(h.day) + ' ' + h.month.en + ' ' + h.year + ' H';
  })
  .catch(function () { ambil('hariIni').textContent = formatTanggal(sekarang); });

// 2. Gambar kalender satu bulan
function muatKalender() {
  var status = ambil('statusKal');
  status.hidden = false;
  status.className = 'status';
  status.textContent = 'Memuat kalender...';
  ambil('kalender').innerHTML = '';
  ambil('daftarLibur').innerHTML = '';
  ambil('judulBulan').textContent = new Date(tahun, bulan - 1, 1).toLocaleDateString('id-ID', { month: 'long', year: 'numeric' });

  fetch('https://api.aladhan.com/v1/gToHCalendar/' + bulan + '/' + tahun)
    .then(function (res) { return res.json(); })
    .then(function (hasil) {
      var hari = hasil.data;

      // judul: rentang bulan Hijriah
      var awal = hari[0].hijri, akhir = hari[hari.length - 1].hijri;
      var rentang = awal.month.en + ' ' + awal.year + ' H';
      if (awal.month.number !== akhir.month.number) {
        rentang += ' – ' + akhir.month.en + ' ' + akhir.year + ' H';
      }
      ambil('judulBulan').innerHTML += '<small>' + rentang + '</small>';

      // nama hari (Min - Sab)
      var html = '';
      namaHari.forEach(function (n) { html += '<div class="kal-hari-nama">' + n + '</div>'; });

      // kotak kosong sebelum tanggal 1
      var hariPertama = new Date(tahun, bulan - 1, 1).getDay();
      for (var i = 0; i < hariPertama; i++) html += '<div class="kal-hari kosong"></div>';

      // kotak tiap tanggal
      var libur = [];
      hari.forEach(function (d) {
        var tglMasehi = parseInt(d.gregorian.day);
        var tglHijri = parseInt(d.hijri.day);
        var adaLibur = d.hijri.holidays && d.hijri.holidays.length > 0;
        var hariIni = tglMasehi === sekarang.getDate() && bulan === sekarang.getMonth() + 1 && tahun === sekarang.getFullYear();

        var kelas = 'kal-hari' + (hariIni ? ' hari-ini' : '') + (adaLibur ? ' libur' : '');
        html += '<div class="' + kelas + '"><b>' + tglMasehi + '</b><span>' + tglHijri + '</span></div>';

        if (adaLibur) {
          d.hijri.holidays.forEach(function (nama) {
            libur.push('<li><span><b>' + tglMasehi + '</b> – ' + nama + '</span><span>' + tglHijri + ' ' + d.hijri.month.en + '</span></li>');
          });
        }
      });

      ambil('kalender').innerHTML = html;
      status.hidden = true;
      ambil('daftarLibur').innerHTML = libur.length ? libur.join('') : '<li>Tidak ada hari besar pada bulan ini.</li>';
    })
    .catch(function () {
      status.className = 'status error';
      status.textContent = 'Gagal memuat data dari API. Periksa koneksi internet lalu coba lagi.';
    });
}

// 3. Tombol bulan sebelum / sesudah
function pindahBulan(arah) {
  bulan += arah;
  if (bulan < 1) { bulan = 12; tahun--; }
  if (bulan > 12) { bulan = 1; tahun++; }
  muatKalender();
}
ambil('bulanSebelum').addEventListener('click', function () { pindahBulan(-1); });
ambil('bulanSesudah').addEventListener('click', function () { pindahBulan(1); });

muatKalender();
