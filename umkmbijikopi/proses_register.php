<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $no_hp = mysqli_real_escape_string($conn, $_POST['no_hp']);
    $password = md5($_POST['password'], PASSWORD_DEFAULT); // Enkripsi password

    // Cek apakah username sudah ada
    $cek = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Username sudah digunakan!'); window.location='register.php';</script>";
    } else {
        // Simpan user baru dengan role 'user'
        $query = "INSERT INTO users (username, email, no_hp, password, role)
                  VALUES ('$username', '$email', '$no_hp', '$password', 'user')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "<script>alert('Pendaftaran berhasil! Silakan login.'); window.location='index.php?Home=2rr;</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan. Coba lagi!'); window.location='register.php';</script>";
        }
    }
} else {
    // Jika diakses tanpa POST
    header("Location: register.php");
    exit;
}
?>
