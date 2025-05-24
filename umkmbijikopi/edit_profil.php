<?php
include 'koneksi.php';

if (!isset($_SESSION['username'])) {
    echo "Silakan login terlebih dahulu.";
    exit;
}

$username = $_SESSION['username'];
$query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
$user = mysqli_fetch_assoc($query);

// Proses update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $no_hp = mysqli_real_escape_string($conn, $_POST['no_hp']);

    $update = mysqli_query($conn, "UPDATE users SET email='$email', no_hp='$no_hp' WHERE username='$username'");

    if ($update) {
        echo "<script>alert('Profil berhasil diperbarui'); window.location='user_dashboard.php?user_Home=18';</script>";
        exit;
    } else {
        echo "<script>alert('Gagal memperbarui profil');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Profil</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }
    .containere {
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
    form label {
      display: block;
      margin-top: 1rem;
      font-weight: bold;
    }
    form input {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border-radius: 6px;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }
    button {
      margin-top: 1.5rem;
      background-color: #28a745;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 6px;
      cursor: pointer;
    }
    button:hover {
      background-color: #218838;
    }
  </style>
</head>
<body>
  <div class="containere">
    <h2>Edit Profil</h2>
    <form method="POST">
      <label>Email</label>
      <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

      <label>No HP</label>
      <input type="text" name="no_hp" value="<?= htmlspecialchars($user['no_hp']) ?>">

      <button type="submit">Simpan Perubahan</button>
    </form>
  </div>
</body>
</html>
