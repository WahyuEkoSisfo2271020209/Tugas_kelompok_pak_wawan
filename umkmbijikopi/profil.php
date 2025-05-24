<?php
include 'koneksi.php';

if (!isset($_SESSION['username'])) {
    echo "Silakan login terlebih dahulu.";
    exit;
}

$username = $_SESSION['username'];
$query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
$user = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Profil Saya</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }
    .containerrrr {
      max-width: 600px;
      margin: 4rem auto;
      background: #fff;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      color: #333;
    }
    .info {
      margin-bottom: 1rem;
    }
    .info label {
      font-weight: bold;
      display: block;
    }
    .info p {
      margin: 5px 0 15px;
    }
    .actions {
      text-align: center;
      margin-top: 2rem;
    }
    .actions a {
      background-color: #007bff;
      color: white;
      padding: 10px 20px;
      border-radius: 6px;
      text-decoration: none;
      margin: 0 5px;
    }
    .actions a:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <div class="containerrrr">
    <h2>Profil Saya</h2>

    <div class="info">
      <label>Username:</label>
      <p><?= htmlspecialchars($user['username']) ?></p>

      <label>Email:</label>
      <p><?= htmlspecialchars($user['email']) ?></p>

      <label>No HP:</label>
      <p><?= htmlspecialchars($user['no_hp']) ?></p>

      <label>Role:</label>
      <p><?= htmlspecialchars($user['role']) ?></p>
    </div>

    <div class="actions">
      <a href="user_dashboard.php?user_Home=19">Edit Profil</a>
      <a href="logout.php" style="background-color: #dc3545;">Logout</a>
    </div>
  </div>
</body>
</html>
