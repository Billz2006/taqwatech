// catatan.js - logika halaman Catatan.php
// Catatan disimpan di database MySQL lewat proses_catatan.php

var form = document.getElementById('noteForm');
var wadah = document.getElementById('notesContainer');

// 1. Amankan teks dari karakter HTML (mencegah XSS)
function amankan(teks) {
  return teks.replace(/[&<>'"]/g, function (c) {
    return { '&': '&amp;', '<': '&lt;', '>': '&gt;', "'": '&#39;', '"': '&quot;' }[c];
  });
}

// 2. Ubah "2026-11-12 08:30:00" menjadi "Kamis, 12 November 2026"
function formatTanggal(teks) {
  var d = new Date(teks.replace(' ', 'T'));
  return d.toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
}

// 3. Ambil catatan dari database lalu tampilkan
function muatCatatan() {
  ambilData('proses_catatan.php')
    .then(function (daftar) {
      if (daftar.length === 0) {
        wadah.innerHTML = '<div class="status">Belum ada catatan. Yuk, tulis hal baik hari ini!</div>';
        return;
      }
      var html = '';
      daftar.forEach(function (c) {
        html += '<div class="card mb-3"><div class="card-body">' +
          '<div class="catatan-judul">' + amankan(c.judul) + '</div>' +
          '<div class="catatan-isi">' + amankan(c.isi) + '</div>' +
          '<div class="catatan-tanggal">' + formatTanggal(c.dibuat) + '</div>' +
          '<button class="tombol tombol-terang mt-2" onclick="hapusCatatan(' + c.id + ')">Hapus</button>' +
          '</div></div>';
      });
      wadah.innerHTML = html;
    })
    .catch(function () {
      wadah.innerHTML = '<div class="status error">' + PESAN_SERVER_GAGAL + '</div>';
    });
}

// 4. Simpan catatan baru ke database
form.addEventListener('submit', function (e) {
  e.preventDefault();
  var judul = document.getElementById('title').value.trim();
  var isi = document.getElementById('content').value.trim();
  if (judul === '' || isi === '') return;

  kirimData('proses_catatan.php?aksi=tambah', { judul: judul, isi: isi })
    .then(function () {
      form.reset();
      muatCatatan();
    })
    .catch(function () { alert('Catatan gagal disimpan. ' + PESAN_SERVER_GAGAL); });
});

// 5. Hapus catatan dari database
function hapusCatatan(id) {
  kirimData('proses_catatan.php?aksi=hapus', { id: id })
    .then(muatCatatan)
    .catch(function () { alert('Catatan gagal dihapus.'); });
}

muatCatatan();
