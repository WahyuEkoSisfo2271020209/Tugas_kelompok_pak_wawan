<?php
include 'koneksi.php';

// Proses hapus jika ada parameter 'hapus'
if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    mysqli_query($conn, "DELETE FROM pesanan WHERE id = $id");
    echo "<p style='color:green;'>✅ Pesanan berhasil dihapus.</p>";
}

// Proses update status
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $id = intval($_POST['id']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    mysqli_query($conn, "UPDATE pesanan SET status = '$status' WHERE id = $id");
}

// Ambil data pesanan
$result = mysqli_query($conn, "SELECT * FROM pesanan ORDER BY tanggal_pesan DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Data Pesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f3ea;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #4b3621;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
            background: #fff;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }
        th {
            background: #eee2c9;
            color: #4b3621;
        }
        .hapus-btn {
            background-color: #dc3545;
            color: white;
            padding: 6px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }
        .hapus-btn:hover {
            background-color: #c82333;
        }
        select {
            padding: 6px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button.update-btn {
            padding: 6px 12px;
            border: none;
            background-color:rgb(13, 145, 96);
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
        button.update-btn:hover {
            background-color:rgb(60, 253, 11);
        }
    </style>
</head>
<body>

<h2>Data Pesanan</h2>

<table>
    <tr>
        <th>No</th>
        <th>Produk</th>
        <th>Harga</th>
        <th>Jumlah</th>
        <th>Total</th>
        <th>Nama Pembeli</th>
        <th>Alamat</th>
        <th>Telepon</th>
        <th>Metode</th>
        <th>Tanggal</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
    <?php
    $no = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
            <td>{$no}</td>
            <td>{$row['nama_produk']}</td>
            <td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>
            <td>{$row['jumlah']} kg</td>
            <td>Rp " . number_format($row['total'], 0, ',', '.') . "</td>
            <td>{$row['nama_pembeli']}</td>
            <td>{$row['alamat']}</td>
            <td>{$row['telepon']}</td>
            <td>{$row['metode_pembayaran']}</td>
            <td>{$row['tanggal_pesan']}</td>
            <td>
                <form method='post' style='margin: 0;'>
                    <input type='hidden' name='id' value='{$row['id']}'>
                    <select name='status'>
                        <option " . ($row['status'] == 'Menunggu' ? 'selected' : '') . ">Menunggu</option>
                        <option " . ($row['status'] == 'Diproses' ? 'selected' : '') . ">Diproses</option>
                        <option " . ($row['status'] == 'Dikirim' ? 'selected' : '') . ">Dikirim</option>
                        <option " . ($row['status'] == 'Selesai' ? 'selected' : '') . ">Selesai</option>
                        <option " . ($row['status'] == 'Dibatalkan' ? 'selected' : '') . ">Dibatalkan</option>
                    </select>
                    <button type='submit' name='update_status' class='update-btn'>Update</button>
                </form>
            </td>
            <td>
                <a class='hapus-btn' href='?admin_Home=22&hapus={$row['id']}' onclick=\"return confirm('Yakin ingin menghapus pesanan ini?')\">Hapus</a>
            </td>
        </tr>";
        $no++;
    }
    ?>
</table>

</body>
</html>
