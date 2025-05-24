<?php
include 'koneksi.php';
$produk = mysqli_query($conn, "SELECT * FROM produk");
?>

<style>
  .tambah-btn {
    display: inline-block;
    background-color: #28a745;
    color: white;
    padding: 10px 16px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: bold;
    margin-bottom: 16px;
  }
  .tambah-btn:hover {
    background-color: #218838;
  }
  table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    border: 1px solid #ddd;
  }
  table th, table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
  }
  table th {
    background-color: #f2f2f2;
  }
  img {
    border-radius: 4px;
  }
</style>

<h2>Kelola Produk</h2>
<a href="admin_dashboard.php?admin_Home=26" class="tambah-btn">+ Tambah Produk</a>

<table>
  <tr>
    <th>No</th>
    <th>Nama</th>
    <th>Deskripsi</th>
    <th>Harga</th>
    <th>Stok</th>
    <th>Gambar</th>
    <th>Aksi</th>
  </tr>
  <?php $no = 1; while ($p = mysqli_fetch_assoc($produk)): ?>
  <tr>
    <td><?= $no++ ?></td>
    <td><?= htmlspecialchars($p['nama_produk']) ?></td>
    <td><?= nl2br(htmlspecialchars($p['deskripsi'])) ?></td>
    <td>Rp<?= number_format($p['harga'], 0, ',', '.') ?></td>
    <td><?= $p['stok'] ?></td>
    <td>
      <?php if (!empty($p['gambar']) && file_exists('uploads/' . $p['gambar'])): ?>
        <img src="uploads/<?= $p['gambar'] ?>" width="50">
      <?php else: ?>
        Tidak ada gambar
      <?php endif; ?>
    </td>
    <td>
      <a href="admin_dashboard.php?admin_Home=27&id=<?= $p['id'] ?>">Edit</a> |
      <a href="admin_hapus_produk.php?id=<?= $p['id'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
    </td>
  </tr>
  <?php endwhile; ?>
</table>
