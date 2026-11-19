<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Taqwatech</title>
    <link rel="stylesheet" href="/css/styleLog.css">
</head>
<body>

  <section class="container">
    <div class="login-container">
      <div class="circle circle-one"></div>
      <div class="form-container">
        <h1 class="opacity">LOGIN</h1>
        <form id="login-form">
          <input type="text" id="username" placeholder="Username" required>
          <input type="password" id="password" placeholder="Password" required>
          <input type="submit" value="Login">
        </form>
        <div class="register-forget opacity">
          <a href="Register.php">REGISTER</a>
          <a href="#">FORGOT PASSWORD</a>
        </div>
      </div>
      <div class="circle circle-two"></div>
    </div>
    <div class="theme-btn-container"></div>
  </section>

  <script src="/asset/js/api.js"></script>
  <script src="/asset/js/tema-login.js"></script>
  <script src="/asset/js/script.js"></script>
</body>
</html>
