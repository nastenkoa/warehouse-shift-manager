<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Auth</title>
  <link rel="manifest" href="/manifest.json">
  <link rel="shortcut icon" href="https://www.fastcr.cz/public/26/20/77/2939_9221_favicon.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4" style="width: 100%; max-width: 400px;">
      <div class="mb-3 d-flex justify-content-center align-items-center">
        <img src="https://www.fastcr.cz/public/a8/c7/70/2459_7813_logo_fast.png" alt="FAST Logo" style="max-width: 75%; height: auto;"> 
      </div>  
      <h4 class="card-title text-center">Sign in</h4>
      <form method="POST" action="../controllers/login.php">
        <?php
          session_start();

          if (isset($_SESSION['error_message'])) {
            echo "<p style='color:red'>" . $_SESSION['error_message'] . "</p>";
            unset($_SESSION['error_message']);
          }
        ?>

        <div class="mb-3">
          <label for="login" class="form-label">Login</label>
          <input type="text" class="form-control" name="login" id="login" placeholder="Login" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Sign in</button>
      </form>
      <div class="mt-4 text-center">
      <p>Support: <a href="mailto:nastenko.as@gmail.com">nastenko.as@gmail.com</a></p>
      <p>Phone: <a href="tel:+420723868194">+420723868194</a></p>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>