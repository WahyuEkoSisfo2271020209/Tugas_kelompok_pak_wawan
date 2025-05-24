<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']); // Hash password dengan MD5

    // Cek apakah username dan password cocok
    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    $user = mysqli_fetch_assoc($query);

    if ($user) {
        // Set session
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // Redirect sesuai role
        if ($user['role'] === 'admin') {
            header("Location: admin_dashboard.php");
            exit;
        } else {
            header("Location: user_dashboard.php");
            exit;
        }
    } else {
        echo "<script>
                alert('Username atau password salah!');
                window.location='index.php?Home=2';
              </script>";
    }
} else {
    header("Location: login.php");
    exit;
}
?>

