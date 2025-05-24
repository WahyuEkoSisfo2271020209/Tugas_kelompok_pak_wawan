<?php
include 'koneksi.php';

$id         = $_POST['id'];
$nama       = $_POST['nama'];
$deskripsi  = $_POST['deskripsi'];
$harga      = $_POST['harga'];
$stok       = $_POST['stok'];
$gambarLama = $_POST['gambar_lama'];

$folder     = 'upload/';
$gambarBaru = $gambarLama; // Default gunakan gambar lama

// Jika user upload gambar baru
if ($_FILES['gambar']['name']) {
    $namaFile = $_FILES['gambar']['name'];
    $tmpName  = $_FILES['gambar']['tmp_name'];
    $namaUnik = time() . '_' . basename($namaFile);
    $pathBaru = $folder . $namaUnik;

    // Buat folder jika belum ada
    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    // Proses upload
    if (move_uploaded_file($tmpName, $pathBaru)) {
        // Hapus gambar lama jika ada
        if (file_exists($folder . $gambarLama) && $gambarLama != '') {
            unlink($folder . $gambarLama);
        }
        $gambarBaru = $namaUnik;
    } else {
        echo "<p style='color:red;'>❌ Gagal mengupload gambar baru.</p>";
    }
}

// Update data produk
$query = "UPDATE produk SET 
            nama_produk = '$nama', 
            deskripsi   = '$deskripsi', 
            harga       = '$harga', 
            stok        = '$stok', 
            gambar      = '$gambarBaru'
          WHERE id = $id";

if (mysqli_query($conn, $query)) {
    echo "<p style='color:green;'>✅ Produk berhasil diupdate.</p>";
    echo "<a href='admin_kelola_produk.php'>← Kembali ke Daftar Produk</a>";
} else {
    echo "<p style='color:red;'>❌ Gagal update produk: " . mysqli_error($conn) . "</p>";
}
?>
