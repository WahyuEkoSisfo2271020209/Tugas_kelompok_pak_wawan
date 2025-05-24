<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login Pengguna</title>
  <style>
    /* Gaya umum */
    body {
      font-family: Arial, sans-serif;
      background-color:rgb(141, 122, 107);
      margin: 0;
      padding: 0;
    }

    /* Tampilan section login */
    section {
      background-color: #fff;
      padding: 2rem;
      max-width: 400px;
      margin: 5rem auto;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    /* Judul form */
    section h2 {
      text-align: center;
      margin-bottom: 1.5rem;
      color: #333;
    }

    /* Label dan input */
    form label {
      font-weight: bold;
      display: block;
      margin-bottom: 0.5rem;
      color: #555;
    }

    form input[type="text"],
    form input[type="password"] {
      width: 100%;
      padding: 0.6rem;
      margin-bottom: 1rem;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    /* Tombol login */
    form button {
      width: 100%;
      padding: 0.7rem;
      background-color:rgb(226, 186, 92);
      color: white;
      border: none;
      border-radius: 4px;
      font-size: 1rem;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    form button:hover {
      background-color:rgb(200, 145, 26);
    }

    /* Teks link ke pendaftaran */
    section p {
      text-align: center;
      font-size: 0.95rem;
    }

    section p a {
      color:rgb(229, 161, 44);
      text-decoration: none;
    }

    section p a:hover {
      text-decoration: underline;
    }

    /* Pesan sudah login */
    .login-info {
      text-align: center;
      margin-top: 3rem;
      font-size: 1.1rem;
      color: #333;
    }

    .login-info strong {
      color:rgb(156, 163, 6);
    }

    .login-info a {
      color:rgb(212, 122, 20);
      text-decoration: none;
      margin-left: 0.5rem;
    }

    .login-info a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<?php
if (isset($_SESSION['username'])) {
    echo "<p class='login-info'>Anda sudah login sebagai <strong>{$_SESSION['username']}</strong>.<a href='logout.php'>Logout</a></p>";
    return;
}
?>

<section>
  <h2>Login Pengguna</h2>
  <form action="proses_login.php" method="post">
    <label>Username:</label>
    <input type="text" name="username" required>

    <label>Password:</label>
    <input type="password" name="password" required>

    <button type="submit">Login</button>
  </form>
  <p>Belum punya akun? <a href="index.php?Home=3">Daftar di sini</a></p>
</section>

</body>
</html>
