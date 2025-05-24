<?php
include 'koneksi.php';

// Pastikan user login
if (!isset($_SESSION['username'])) {
    header("Location: index.php?Home=2");
    exit();
}

$username = $_SESSION['username'];

// Ambil data produk dari POST
$nama_produk = $_POST['nama'] ?? '';
$harga = $_POST['harga'] ?? 0;
$jumlah = $_POST['jumlah'] ?? 1;
$total = $harga * $jumlah;

// Ambil gambar dari database
$query = mysqli_query($conn, "SELECT gambar FROM produk WHERE nama_produk = '" . mysqli_real_escape_string($conn, $nama_produk) . "'");
$data = mysqli_fetch_assoc($query);
$gambar = $data ? $data['gambar'] : 'default.jpg';

// Ambil data user
$query_user = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
$user = mysqli_fetch_assoc($query_user);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Checkout</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f8f2e9;
      margin: 0;
      padding: 0;
    }
    .checkout-container {
      max-width: 600px;
      margin: 3rem auto;
      background-color: #fffaf0;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    .checkout-container img.produk {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-radius: 10px;
      margin-bottom: 1rem;
    }
    h2 {
      text-align: center;
      color: #3a2c1a;
      margin-bottom: 1rem;
    }
    .checkout-box p {
      margin: 0.5rem 0;
      font-size: 1rem;
    }
    .form-checkout label {
      display: block;
      margin-top: 1rem;
      font-weight: bold;
    }
    .form-checkout input,
    .form-checkout textarea,
    .form-checkout select {
      width: 100%;
      padding: 8px;
      margin-top: 4px;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 1rem;
      background-color: #fff;
    }
    .form-checkout button {
      margin-top: 1.5rem;
      background-color: #5c3a1c;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 8px;
      cursor: pointer;
      width: 100%;
    }
    .form-checkout button:hover {
      background-color: #44290d;
    }
  </style>
</head>
<body>
  <div class="checkout-container">
    <img src="uploads/<?= htmlspecialchars($gambar) ?>" alt="Gambar <?= htmlspecialchars($nama_produk) ?>" class="produk">

    <h2>Checkout</h2>

    <div class="checkout-box">
      <p><strong>Produk:</strong> <?= htmlspecialchars($nama_produk) ?></p>
      <p><strong>Harga:</strong> Rp <?= number_format($harga, 0, ',', '.') ?></p>
      <p><strong>Jumlah:</strong> <?= htmlspecialchars($jumlah) ?> kg</p>
      <p><strong>Total:</strong> <strong>Rp <?= number_format($total, 0, ',', '.') ?></strong></p>
    </div>

    <form class="form-checkout" action="proses_pesanan.php" method="post">
      <!-- Hidden inputs -->
      <input type="hidden" name="nama" value="<?= htmlspecialchars($nama_produk) ?>">
      <input type="hidden" name="harga" value="<?= htmlspecialchars($harga) ?>">
      <input type="hidden" name="jumlah" value="<?= htmlspecialchars($jumlah) ?>">
      <input type="hidden" name="total" value="<?= htmlspecialchars($total) ?>">
      <input type="hidden" name="gambar" value="<?= htmlspecialchars($gambar) ?>">

      <label for="nama_pembeli">Nama Lengkap</label>
      <input type="text" id="nama_pembeli" name="nama_pembeli" value="<?= htmlspecialchars($user['username']) ?>" readonly>

      <label for="alamat">Alamat Pengiriman</label>
      <textarea id="alamat" name="alamat" rows="4" required><?= htmlspecialchars($user['alamat'] ?? '') ?></textarea>

      <label for="telepon">Nomor Telepon</label>
      <input type="text" id="telepon" name="telepon" value="<?= htmlspecialchars($user['no_hp'] ?? '') ?>" required>

      <label for="metode_pembayaran">Metode Pembayaran</label>
      <select id="metode_pembayaran" name="metode_pembayaran" required>
        <option value="">-- Pilih Metode --</option>
        <optgroup label="Transfer Bank">
          <option value="Transfer Bank - Mandiri (1514454323)">Mandiri (1514454323)</option>
          <option value="Transfer Bank - BRI  (23176765)">BRI (23176765)</option>
          <option value="Transfer Bank - BNI  (128371623)">BNI (128371623)</option>
        </optgroup>
        <optgroup label="E-Wallet">
          <option value="E-Wallet - DANA (08111116666)">DANA (08111116666)</option>
          <option value="E-Wallet - GoPay  (62811111666)">GoPay (62811111666)</option>
          <option value="E-Wallet - OVO (0818763123)">OVO (0818763123)</option>
        </optgroup>
        <option value="COD">Bayar di Tempat (COD)</option>
      </select>

      <button type="submit">Pesan</button>
    </form>
  </div>
</body>
</html>
