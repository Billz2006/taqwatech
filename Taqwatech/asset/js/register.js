// register.js - logika halaman Register.php
// Data akun baru disimpan ke database MySQL lewat proses_register.php

document.getElementById('register-form').addEventListener('submit', function (event) {
  event.preventDefault();

  var username = document.getElementById('username').value.trim();
  var password = document.getElementById('password').value;
  var konfirmasi = document.getElementById('konfirmasi').value;

  // Cek di browser dulu supaya cepat
  if (password !== konfirmasi) {
    alert('Konfirmasi password tidak sama.');
    return;
  }

  kirimData('proses_register.php', { username: username, password: password, konfirmasi: konfirmasi })
    .then(function () {
      alert('Register berhasil! Silakan login.');
      window.location.href = 'Login.php';
    })
    .catch(function (err) {
      alert(err instanceof TypeError ? PESAN_SERVER_GAGAL : 'Register gagal. ' + err.message);
    });
});
