<?php

if (isset($_SESSION['username'])) {
    echo "<p style='text-align:center;'>Anda sudah login sebagai <strong>{$_SESSION['username']}</strong>. <a href='logout.php'>Logout</a></p>";
    return;
}
?>

<section style="padding: 2rem; max-width: 400px; margin: auto;">
  <h2>Login Pengguna</h2>
  <form action="proses_login.php" method="post">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
  </form>
  <p style="margin-top: 1rem;">Belum punya akun? <a href="index.php?Home=3">Daftar di sini</a></p>
</section>