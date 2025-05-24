<?php
include 'koneksi.php';

$pesan = '';

if (isset($_POST['daftar'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']); // Sebaiknya gunakan password_hash() untuk keamanan lebih baik
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $no_hp    = mysqli_real_escape_string($conn, $_POST['no_hp']);

    // Cek apakah username sudah digunakan
    $cek = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($cek) > 0) {
        $pesan = "❌ Username sudah digunakan!";
    } else {
        $simpan = mysqli_query($conn, "INSERT INTO users (username, email, no_hp, password, role)
                                       VALUES ('$username', '$email', '$no_hp', '$password', 'user')");
        if ($simpan) {
            $pesan = "✅ Pendaftaran berhasil. Silakan <a href='index.php?Home=2'>login</a>.";
        } else {
            $pesan = "❌ Pendaftaran gagal!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Akun</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background-color:rgb(184, 137, 114);
      margin: 0;
      padding: 0;
    }

    .form-container {
      max-width: 420px;
      background-color: #fff;
      margin: 60px auto;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 24px;
      color: #4a3e3e;
    }

    input {
      width: 100%;
      padding: 12px 14px;
      margin-bottom: 16px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 14px;
    }

    button {
      width: 100%;
      padding: 12px;
      background-color: #5c3a1c;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #44290d;
    }

    .message {
      margin-top: 20px;
      padding: 12px;
      background-color: #fff3cd;
      border: 1px solid #ffeeba;
      border-radius: 8px;
      font-size: 14px;
      text-align: center;
      color: #856404;
    }

    .message a {
      color: #5c3a1c;
      font-weight: bold;
      text-decoration: none;
    }

    .message a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<div class="form-container">
  <h2>Daftar Akun</h2>
  <form method="post">
    <input type="text" name="username" placeholder="Username" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="text" name="no_hp" placeholder="No. HP" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="daftar">Daftar</button>
  </form>

  <?php if ($pesan): ?>
    <div class="message"><?= $pesan ?></div>
  <?php endif; ?>
</div>

</body>
</html>
