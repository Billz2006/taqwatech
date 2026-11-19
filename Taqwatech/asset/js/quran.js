// quran.js - logika halaman quran.php
// Data diambil dari Al Quran Cloud API (https://alquran.cloud/api) - gratis & open source
//   Daftar surah :  /v1/surah
//   Isi satu surah: /v1/surah/{nomor}/editions/quran-uthmani,id.indonesian,ar.alafasy
//                   (teks Arab, terjemahan Indonesia Kemenag, audio Mishary Alafasy)

var API = 'https://api.alquran.cloud/v1/';
var semuaSurah = [];       // daftar 114 surah
var ayatSekarang = [];     // ayat dari surah yang sedang dibaca
var ayatDiputar = -1;      // nomor urut ayat yang sedang diputar (-1 = tidak ada)
var ukuranArab = 32;       // ukuran huruf Arab (px)
var audio = new Audio();

function ambil(id) { return document.getElementById(id); }

// Amankan teks dari karakter HTML
function amankan(teks) {
  return String(teks).replace(/[&<>'"]/g, function (c) {
    return { '&': '&amp;', '<': '&lt;', '>': '&gt;', "'": '&#39;', '"': '&quot;' }[c];
  });
}

// =====================================================
// 1. DAFTAR SURAH
// =====================================================

// Samakan huruf supaya pencarian "fatihah" cocok dengan "Al-Faatiha"
function samakan(teks) {
  return teks.toLowerCase().replace(/[^a-z0-9]/g, '').replace(/(.)\1+/g, '$1');
}

function tampilkanDaftar(kata) {
  var cari = samakan(kata || '');
  var angka = /^\d+$/.test((kata || '').trim()) ? Number(kata) : null;
  var html = '';

  semuaSurah.forEach(function (s) {
    var cocok = cari === '' ||
      (angka !== null ? s.number === angka
                      : samakan(s.englishName + s.englishNameTranslation).indexOf(cari) !== -1);
    if (!cocok) return;

    var tempat = s.revelationType === 'Meccan' ? 'Mekah' : 'Madinah';
    html += '<a class="kartu-surah" href="#' + s.number + '">' +
      '<span class="no-surah">' + s.number + '</span>' +
      '<span class="info-surah"><b>' + amankan(s.englishName) + '</b>' +
      '<small>' + amankan(s.englishNameTranslation) + ' · ' + tempat + ' · ' + s.numberOfAyahs + ' ayat</small></span>' +
      '<span class="arab nama-arab">' + amankan(s.name.replace('سُورَةُ ', '')) + '</span></a>';
  });

  ambil('daftarSurah').innerHTML = html;
  ambil('statusDaftar').hidden = html !== '';
  if (html === '') ambil('statusDaftar').textContent = 'Surah tidak ditemukan.';
}

function muatDaftar() {
  fetch(API + 'surah')
    .then(function (res) { return res.json(); })
    .then(function (hasil) {
      semuaSurah = hasil.data;
      ambil('statusDaftar').hidden = true;
      tampilkanDaftar(ambil('cariSurah').value);
    })
    .catch(function () {
      ambil('statusDaftar').className = 'status error';
      ambil('statusDaftar').textContent = 'Gagal memuat daftar surah. Periksa koneksi internet lalu muat ulang halaman.';
    });
}

ambil('cariSurah').addEventListener('input', function (e) { tampilkanDaftar(e.target.value); });

// =====================================================
// 2. MEMBACA SATU SURAH
// =====================================================

// Hilangkan harakat supaya kata bisa dibandingkan
function tanpaHarakat(teks) {
  return teks.replace(/[\u0610-\u061A\u064B-\u065F\u0670\u06D6-\u06ED]/g, '');
}

// Di data API, ayat 1 hampir semua surah diawali Basmalah. Kita pisahkan supaya tampil sebagai judul.
function bersihkanBasmalah(teks, nomorSurah, nomorAyat) {
  var kata = teks.split(' ');
  if (nomorAyat === 1 && nomorSurah !== 1 && nomorSurah !== 9 && tanpaHarakat(kata[0]) === 'بسم') {
    return kata.slice(4).join(' ');
  }
  return teks;
}

function bukaSurah(nomor) {
  berhenti();
  ambil('tampilDaftar').hidden = true;
  ambil('tampilBaca').hidden = false;
  ambil('daftarAyat').innerHTML = '';
  ambil('basmalah').hidden = true;
  ambil('namaArab').textContent = '';
  ambil('namaLatin').textContent = 'Memuat...';
  ambil('infoSurah').textContent = '';
  window.scrollTo(0, 0);

  var status = ambil('statusBaca');
  status.hidden = false;
  status.className = 'status';
  status.textContent = 'Memuat ayat...';

  // tombol surah sebelum / berikutnya
  ambil('surahSebelum').hidden = nomor <= 1;
  ambil('surahSebelum').href = '#' + (nomor - 1);
  ambil('surahSesudah').hidden = nomor >= 114;
  ambil('surahSesudah').href = '#' + (nomor + 1);

  fetch(API + 'surah/' + nomor + '/editions/quran-uthmani,id.indonesian,ar.alafasy')
    .then(function (res) { return res.json(); })
    .then(function (hasil) {
      var arab = hasil.data[0], indo = hasil.data[1], suara = hasil.data[2];

      ambil('namaArab').textContent = arab.name;
      ambil('namaLatin').textContent = arab.number + '. ' + arab.englishName + ' (' + arab.englishNameTranslation + ')';
      ambil('infoSurah').textContent = (arab.revelationType === 'Meccan' ? 'Makkiyah' : 'Madaniyah') + ' · ' + arab.numberOfAyahs + ' ayat';
      ambil('basmalah').hidden = (nomor === 1 || nomor === 9);

      ayatSekarang = [];
      var html = '';
      arab.ayahs.forEach(function (a, i) {
        var teksArab = bersihkanBasmalah(a.text, nomor, a.numberInSurah);
        ayatSekarang.push({ audio: suara.ayahs[i].audio });

        html += '<div class="ayat" id="ayat-' + i + '">' +
          '<div class="ayat-atas"><span class="no-ayat">' + a.numberInSurah + '</span>' +
          '<button type="button" class="tombol tombol-terang tombol-kecil tombol-putar" data-i="' + i + '">▶ Putar</button></div>' +
          '<div class="teks-arab arab">' + amankan(teksArab) + '</div>' +
          '<div class="teks-arti">' + amankan(indo.ayahs[i].text) + '</div></div>';
      });

      ambil('daftarAyat').innerHTML = html;
      status.hidden = true;
    })
    .catch(function () {
      status.className = 'status error';
      status.textContent = 'Gagal memuat surah. Periksa koneksi internet lalu coba lagi.';
    });
}

// =====================================================
// 3. AUDIO PER AYAT (otomatis lanjut ke ayat berikutnya)
// =====================================================

function perbaruiTampilanAudio() {
  document.querySelectorAll('.ayat').forEach(function (el, i) {
    var sedangMain = i === ayatDiputar && !audio.paused;
    el.classList.toggle('diputar', i === ayatDiputar);
    el.querySelector('.tombol-putar').textContent = sedangMain ? '⏸ Jeda' : '▶ Putar';
  });
}

function putarAyat(i) {
  if (i < 0 || i >= ayatSekarang.length) { berhenti(); return; }
  ayatDiputar = i;
  audio.src = ayatSekarang[i].audio;
  audio.play().catch(function () { berhenti(); });
  perbaruiTampilanAudio();
  ambil('ayat-' + i).scrollIntoView({ behavior: 'smooth', block: 'center' });
}

function berhenti() {
  audio.pause();
  ayatDiputar = -1;
  perbaruiTampilanAudio();
}

ambil('daftarAyat').addEventListener('click', function (e) {
  var tombol = e.target.closest('.tombol-putar');
  if (!tombol) return;
  var i = Number(tombol.dataset.i);

  if (i === ayatDiputar && !audio.paused) {
    audio.pause();                       // klik lagi = jeda
    perbaruiTampilanAudio();
  } else if (i === ayatDiputar) {
    audio.play();                        // lanjutkan
    perbaruiTampilanAudio();
  } else {
    putarAyat(i);
  }
});

audio.addEventListener('ended', function () { putarAyat(ayatDiputar + 1); });

// =====================================================
// 4. UKURAN HURUF ARAB
// =====================================================

function aturUkuran(perubahan) {
  ukuranArab = Math.min(52, Math.max(24, ukuranArab + perubahan));
  document.documentElement.style.setProperty('--ukuran-arab', ukuranArab + 'px');
}
ambil('tombolKecil').addEventListener('click', function () { aturUkuran(-4); });
ambil('tombolBesar').addEventListener('click', function () { aturUkuran(4); });

// =====================================================
// 5. PINDAH HALAMAN LEWAT ALAMAT (#1 = Al-Fatihah, tanpa # = daftar)
// =====================================================

function arahkan() {
  var nomor = parseInt(location.hash.slice(1));
  if (nomor >= 1 && nomor <= 114) {
    bukaSurah(nomor);
  } else {
    berhenti();
    ambil('tampilBaca').hidden = true;
    ambil('tampilDaftar').hidden = false;
  }
}

window.addEventListener('hashchange', arahkan);
muatDaftar();
arahkan();
