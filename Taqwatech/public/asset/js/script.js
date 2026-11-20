// script.js - logika halaman Login.php
// 1. Akun Admin bawaan (langsung dicek di sini)
// 2. Akun hasil Register dicek ke database lewat proses_login.php

document.getElementById('login-form').addEventListener('submit', function (event) {
  event.preventDefault();

  var username = document.getElementById('username').value;
  var password = document.getElementById('password').value;

  // Akun Admin bawaan
  if (username === 'Admin' && password === 'UIN SALATIGA') {
    alert('Login berhasil!');
    redirectToDashboard();
    return;
  }

  // Akun yang sudah register -> cek ke database
  kirimData('proses_login.php', { username: username, password: password })
    .then(function () {
      alert('Login berhasil!');
      redirectToDashboard();
    })
    .catch(function (err) {
      // TypeError = server tidak bisa dihubungi, selain itu = username/password salah
      alert(err instanceof TypeError ? PESAN_SERVER_GAGAL : 'Login gagal. ' + err.message);
    });
});

function redirectToDashboard() {
  setTimeout(function () {
    window.location.href = 'dashboard.php';
  }, 20); //(milidetik)
}
