<?php
include 'koneksi.php';

$nama = $_POST['nama'];
$deskripsi = $_POST['deskripsi'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];
$gambar = $_FILES['gambar']['name'];
$tmp = $_FILES['gambar']['tmp_name'];

$nama_file = time() . '_' . $gambar;
$upload_dir = "uploads/";

if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

if (move_uploaded_file($tmp, $upload_dir . $nama_file)) {
    $sql = "INSERT INTO produk (nama_produk, deskripsi, harga, stok, gambar)
            VALUES ('$nama', '$deskripsi', '$harga', '$stok', '$nama_file')";
    mysqli_query($conn, $sql);
    echo "Produk berhasil ditambahkan.";
} else {
    echo "Gagal upload gambar.";
}
?>
