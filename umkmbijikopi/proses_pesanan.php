<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "umkm_kopi";

// Koneksi
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
  
  if (!isset($_SESSION['username'])) {
    echo "Silakan login terlebih dahulu.";
    exit;
}
}


// Ambil data dari form
$nama_produk = $_POST['nama'] ?? '';
$harga        = $_POST['harga'] ?? 0;
$jumlah       = $_POST['jumlah'] ?? 0;
$total        = $_POST['total'] ?? 0;
$nama_pembeli = $_POST['nama_pembeli'] ?? '';
$alamat       = $_POST['alamat'] ?? '';
$telepon      = $_POST['telepon'] ?? '';
$metode       = $_POST['metode_pembayaran'] ?? '';
$gambar       = $_POST['gambar'] ?? 'default.jpg';

// Query insert
$sql = "INSERT INTO pesanan 
  (nama_produk, harga, jumlah, total, nama_pembeli, alamat, telepon, metode_pembayaran, tanggal_pesan, gambar) 
  VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("siiisssss", $nama_produk, $harga, $jumlah, $total, $nama_pembeli, $alamat, $telepon, $metode, $gambar);

if ($stmt->execute()) {
    echo "<script>alert('Pesanan berhasil dikirim!'); window.location.href = 'user_dashboard.php';</script>";
} else {
    echo "Terjadi kesalahan: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
