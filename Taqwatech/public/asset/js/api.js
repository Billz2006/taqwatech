// api.js - fungsi bantu untuk berbicara dengan server PHP (file proses_*.php di folder pages/)
// Dipakai oleh catatan.js, target.js, dan tasbih.js

var PESAN_SERVER_GAGAL = 'Tidak bisa terhubung ke server. Pastikan Apache & MySQL menyala, ' +
  'dan buka halaman lewat http://localhost/... (bukan klik dua kali file-nya).';

// Ambil data dari server (GET)
function ambilData(url) {
  return fetch(url).then(function (res) {
    return res.json().then(function (hasil) {
      if (!res.ok) throw new Error(hasil.error || 'Terjadi kesalahan.');
      return hasil;
    });
  });
}

// Kirim data ke server (POST), contoh: kirimData('proses_tasbih.php', { kunci: 'd0', jumlah: 5 })
function kirimData(url, data) {
  return fetch(url, { method: 'POST', body: new URLSearchParams(data) }).then(function (res) {
    return res.json().then(function (hasil) {
      if (!res.ok) throw new Error(hasil.error || 'Terjadi kesalahan.');
      return hasil;
    });
  });
}
