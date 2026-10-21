document.getElementById('login-form').addEventListener('submit', function(event) {
    event.preventDefault();

    
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;

    
    if (username === 'Admin' && password === 'slebew123') {
      alert('Login berhasil!');
      redirectToDashboard();
    } else {
      alert('Login gagal. Silakan coba lagi.');
    }
  });
  function redirectToDashboard() {

  setTimeout(function() {
    window.location.href = 'index.html'; 
  }, 20); //(milidetik)
}
