<?php
require_once '../autoload.php';
$config = require('../config.php');
$db = new Database($config['db_path']);
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$stmt = $db->query("SELECT * FROM departments");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Data</title>
  <link rel="manifest" href="/manifest.json">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="shortcut icon" href="https://www.fastcr.cz/public/26/20/77/2939_9221_favicon.ico">
</head>
<body>
  <!-- Navigation bar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Presouvani lidi</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../controllers/logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Main content -->
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-8 col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="mb-3 d-flex justify-content-center align-items-center">
                <img src="https://www.fastcr.cz/public/a8/c7/70/2459_7813_logo_fast.png" alt="FAST Logo" style="max-width: 75%; height: auto;"> 
            </div>
            <?php
            if (isset($_COOKIE['flash_message'])) {
              echo "<div class='alert alert-success' role='alert'>
                      Data added successfully!
                    </div>";
              setcookie("flash_message", "", time() - 3600, "/"); 
            }
            ?>
            <h5 class="card-title text-center">Add Data</h5>
            <form method="POST" action="../controllers/add_data.php">
              <div class="mb-3">
                <label for="lastname" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" autocomplete="off" required>
                <ul class="list-group mt-1" id="suggestions" style="position: absolute; z-index: 1000; width: 100%; display: none;"></ul>
              </div>
              <div class="mb-3">
                <label for="select1" class="form-label">From</label>
                <select class="form-select" id="select1" name="select1" required>
                    <option value="" disabled selected>Choose...</option>
                    <?php
                      foreach($results as $row)
                      echo "<option value=".$row['id'].">".$row['department_name']."</option>";
                    ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="select2" class="form-label">To</label>
                <select class="form-select" id="select2" name="select2" required>
                    <option value="" disabled selected>Choose...</option>
                    <?php
                      foreach($results as $row)
                      echo "<option value=".$row['id'].">".$row['department_name']."</option>";
                    ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="time" class="form-label">Select Time</label>
                <input type="time" name="time" class="form-control" id="time" required>
              </div>
              <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
          </div>
        </div>
        <div class="mt-4 text-center">
          <p>Support: <a href="mailto:nastenko.as@gmail.com">nastenko.as@gmail.com</a></p>
          <p>Phone: <a href="tel:+420723868194">+420723868194</a></p>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../main.js"></script>
</body>
</html>

