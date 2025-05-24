<?php
include 'koneksi.php';

// Cek login
if (!isset($_SESSION['username'])) {
    echo "Silakan login terlebih dahulu.";
    exit;
}

$username = $_SESSION['username'];

// Ambil data pesanan milik user
$pesananSaya = $conn->query("SELECT * FROM pesanan WHERE nama_pembeli = '" . mysqli_real_escape_string($conn, $username) . "' ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pesanan Saya</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f2e9;
            margin: 0;
            padding: 20px;
        }
        h2 {
            text-align: center;
            margin-top: 2rem;
            color: #4b3621;
        }
        table {
            margin: 20px auto;
            background: #fff;
            border-collapse: collapse;
            width: 95%;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #f0e4cd;
            color: #4b3621;
        }
        img.produk-img {
            max-width: 100px;
            height: auto;
            border-radius: 6px;
        }
        .status {
            font-weight: bold;
            padding: 5px 8px;
            border-radius: 5px;
            display: inline-block;
        }
        .Menunggu { background: #ffd966; color: #000; }
        .Diproses { background: #8faadc; color: white; }
        .Dikirim { background: #f6b26b; color: white; }
        .Selesai { background: #93c47d; color: white; }
        .Dibatalkan { background: #e06666; color: white; }
    </style>
</head>
<body>

<h2>Pesanan Saya (<?= htmlspecialchars($username) ?>)</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Produk</th>
        <th>Gambar</th>
        <th>Harga/kg</th>
        <th>Jumlah</th>
        <th>Total</th>
        <th>Alamat</th>
        <th>No HP</th>
        <th>Pembayaran</th>
        <th>Tanggal</th>
        <th>Status</th>
    </tr>
    <?php while ($row = $pesananSaya->fetch_assoc()): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['nama_produk']) ?></td>
        <td><img src="uploads/<?= htmlspecialchars($row['gambar']) ?>" class="produk-img" alt="<?= htmlspecialchars($row['nama_produk']) ?>"></td>
        <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
        <td><?= $row['jumlah'] ?> kg</td>
        <td>Rp <?= number_format($row['total'], 0, ',', '.') ?></td>
        <td><?= htmlspecialchars($row['alamat']) ?></td>
        <td><?= htmlspecialchars($row['telepon']) ?></td>
        <td><?= htmlspecialchars($row['metode_pembayaran']) ?></td>
        <td><?= $row['tanggal_pesan'] ?></td>
        <td><span class="status <?= $row['status'] ?>"><?= $row['status'] ?></span></td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
