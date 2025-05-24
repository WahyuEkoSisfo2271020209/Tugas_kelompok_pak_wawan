<?php

$host     = "localhost";
$username = "root";
$password = "";
$database = "umkm_kopi";

 
// untuk tulisan bercetak tebal silakan sesuaikan dengan detail database Anda
// membuat koneksi
$conn = mysqli_connect($host , $username, $password, $database);
// // mengecek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
//echo "Koneksi berhasil";
//mysqli_close($conn);

?>
