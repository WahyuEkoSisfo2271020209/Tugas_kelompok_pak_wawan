<?php
include 'koneksi.php';

$pesan = '';

if (isset($_POST['daftar'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']); // Jika ingin lebih aman, gunakan password_hash()
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
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f4f4f4;
      padding: 20px;
    }

    .form-container {
      background: #fff;
      padding: 25px;
      max-width: 400px;
      margin: 40px auto;
      border-radius: 10px;
      box-shadow: 0px 0px 12px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }

    input {
      width: 100%;
      padding: 12px;
      margin-top: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
    }

    button {
      width: 100%;
      padding: 12px;
      margin-top: 20px;
      background-color: #28a745;
      color: white;
      border: none;
      font-size: 16px;
      font-weight: 600;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #218838;
    }

    .message {
      margin-top: 20px;
      padding: 12px;
      background-color: #f8f9fa;
      border: 1px solid #ccc;
      border-radius: 6px;
      text-align: center;
      color: #333;
    }

    .message a {
      color: #28a745;
      text-decoration: none;
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
    <div class="message"><?php echo $pesan; ?></div>
  <?php endif; ?>
</div>

</body>
</html>
