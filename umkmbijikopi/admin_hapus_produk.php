<?php
include 'koneksi.php';

$id = intval($_GET['id']); // pastikan id berupa angka

// Ambil data produk
$query = mysqli_query($conn, "SELECT gambar FROM produk WHERE id = $id");
$data = mysqli_fetch_assoc($query);

// Hapus gambar dari folder jika file ada
if (!empty($data['gambar'])) {
    $filePath = 'uploads/' . $data['gambar'];
    if (file_exists($filePath)) {
        unlink($filePath);
    }
}

// Hapus produk dari database
if (mysqli_query($conn, "DELETE FROM produk WHERE id = $id")) {
    echo "<script>
        alert('Produk berhasil dihapus.');
        window.location.href = 'admin_dashboard.php?admin_Home=24';
    </script>";
} else {
    echo "<script>
        alert('Gagal menghapus produk.');
        window.location.href = 'admin_dashboard.php?admin_Home=24';
    </script>";
}
?>
