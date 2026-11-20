// tasbih.js - logika halaman tasbih.php
// Dzikir harian ditulis manual, Asmaul Husna diambil dari API Aladhan.
// Hitungan tasbih disimpan di database MySQL lewat proses_tasbih.php

// 1. Daftar dzikir dasar
var dzikirDasar = [
  { arab: 'سُبْحَانَ ٱللّٰه', latin: 'Subhanallah', arti: 'Maha Suci Allah' },
  { arab: 'ٱلْحَمْدُ لِلّٰه', latin: 'Alhamdulillah', arti: 'Segala puji bagi Allah' },
  { arab: 'ٱللّٰهُ أَكْبَر', latin: 'Allahu Akbar', arti: 'Allah Maha Besar' },
  { arab: 'لَا إِلٰهَ إِلَّا ٱللّٰه', latin: 'La ilaha illallah', arti: 'Tiada Tuhan selain Allah' },
  { arab: 'أَسْتَغْفِرُ ٱللّٰه', latin: 'Astaghfirullah', arti: 'Aku memohon ampun kepada Allah' }
];
var daftar = dzikirDasar.slice();   // nanti ditambah Asmaul Husna dari API
var terpilih = 0;                   // nomor dzikir yang sedang dipakai
var hitungan = {};                  // jumlah hitungan tiap dzikir (diambil dari database)

function ambil(id) { return document.getElementById(id); }
function targetSekarang() { return Math.max(1, Number(ambil('target').value) || 33); }

// Simpan hitungan dzikir yang sedang dipakai ke database
function simpan() {
  var kunci = 'd' + terpilih;
  kirimData('proses_tasbih.php', { kunci: kunci, jumlah: hitungan[kunci] || 0 })
    .catch(function () { ambil('pesan').textContent = 'Gagal menyimpan ke database. ' + PESAN_SERVER_GAGAL; });
}

// 2. Tampilkan dzikir & hitungan
function tampilkan() {
  var d = daftar[terpilih];
  var n = hitungan['d' + terpilih] || 0;
  var t = targetSekarang();
  ambil('arab').textContent = d.arab;
  ambil('latin').textContent = d.latin;
  ambil('arti').textContent = d.arti;
  ambil('jumlah').textContent = n;
  ambil('teksProgres').textContent = n + ' / ' + t;
  ambil('isiProgres').style.width = Math.min(100, n / t * 100) + '%';
}

// 3. Isi pilihan dzikir
function isiPilihan() {
  var html = '<optgroup label="Dzikir harian">';
  dzikirDasar.forEach(function (d, i) { html += '<option value="' + i + '">' + d.latin + '</option>'; });
  html += '</optgroup>';
  if (daftar.length > dzikirDasar.length) {
    html += '<optgroup label="Asmaul Husna (API)">';
    for (var i = dzikirDasar.length; i < daftar.length; i++) {
      html += '<option value="' + i + '">' + daftar[i].nomor + '. ' + daftar[i].latin + '</option>';
    }
    html += '</optgroup>';
  }
  ambil('pilih').innerHTML = html;
  ambil('pilih').value = terpilih;
}

// 4. Tombol-tombol
ambil('tombolHitung').addEventListener('click', function () {
  var kunci = 'd' + terpilih;
  hitungan[kunci] = (hitungan[kunci] || 0) + 1;
  simpan();
  tampilkan();
  var tercapai = hitungan[kunci] === targetSekarang();
  ambil('pesan').textContent = tercapai ? 'Target tercapai, masyaAllah! 🎉' : '';
  if (navigator.vibrate) navigator.vibrate(tercapai ? [120, 60, 120] : 15);
});
ambil('tombolKurang').addEventListener('click', function () {
  var kunci = 'd' + terpilih;
  hitungan[kunci] = Math.max(0, (hitungan[kunci] || 0) - 1);
  simpan(); tampilkan();
});
ambil('tombolReset').addEventListener('click', function () {
  hitungan['d' + terpilih] = 0;
  simpan(); tampilkan();
  ambil('pesan').textContent = '';
});
ambil('pilih').addEventListener('change', function (e) {
  terpilih = Number(e.target.value);
  ambil('pesan').textContent = '';
  tampilkan();
});
ambil('target').addEventListener('input', tampilkan);

// 5. Ambil Asmaul Husna dari API
fetch('https://api.aladhan.com/v1/asmaAlHusna')
  .then(function (res) { return res.json(); })
  .then(function (hasil) {
    hasil.data.forEach(function (a) {
      daftar.push({ arab: a.name, latin: a.transliteration, nomor: a.number, arti: a.en.meaning });
    });
    isiPilihan();
    tampilkan();
  })
  .catch(function () {
    ambil('pesan').textContent = 'Asmaul Husna gagal dimuat. Dzikir harian tetap bisa dipakai.';
  });

// 6. Ambil hitungan tersimpan dari database
ambilData('proses_tasbih.php')
  .then(function (data) {
    hitungan = data;
    tampilkan();
  })
  .catch(function () { ambil('pesan').textContent = PESAN_SERVER_GAGAL; });

isiPilihan();
tampilkan();
