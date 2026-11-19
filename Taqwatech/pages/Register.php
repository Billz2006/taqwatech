<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Taqwatech</title>
    <link rel="stylesheet" href="/css/styleLog.css">
</head>
<body>

  <section class="container">
    <div class="login-container">
      <div class="circle circle-one"></div>
      <div class="form-container">
        <h1 class="opacity">REGISTER</h1>
        <form id="register-form">
          <input type="text" id="username" placeholder="Username" required minlength="3" maxlength="30">
          <input type="password" id="password" placeholder="Password (min. 6 karakter)" required minlength="6">
          <input type="password" id="konfirmasi" placeholder="Konfirmasi Password" required minlength="6">
          <input type="submit" value="Register">
        </form>
        <div class="register-forget opacity">
          <a href="Login.php">SUDAH PUNYA AKUN? LOGIN</a>
        </div>
      </div>
      <div class="circle circle-two"></div>
    </div>
    <div class="theme-btn-container"></div>
  </section>

  <script src="/asset/js/api.js"></script>
  <script src="/asset/js/tema-login.js"></script>
  <script src="/asset/js/register.js"></script>
</body>
</html>
