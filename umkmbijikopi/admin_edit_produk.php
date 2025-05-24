<?php
include 'koneksi.php';

if (!isset($_GET['id'])) {
    echo "<p style='color:red;'>ID produk tidak ditemukan.</p>";
    exit;
}
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM produk WHERE id=$id"));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama       = $_POST['nama'];
    $deskripsi  = $_POST['deskripsi'];
    $harga      = $_POST['harga'];
    $stok       = $_POST['stok'];
    $gambarLama = $_POST['gambar_lama'];

    $folderTujuan = 'uploads/';
    $gambarBaru   = $gambarLama;

    if (!empty($_FILES['gambar']['name'])) {
        $namaFile = $_FILES['gambar']['name'];
        $tmpName  = $_FILES['gambar']['tmp_name'];
        $namaUnik = time() . '_' . basename($namaFile);
        $pathBaru = $folderTujuan . $namaUnik;

        if (!is_dir($folderTujuan)) {
            mkdir($folderTujuan, 0777, true);
        }

        if (move_uploaded_file($tmpName, $pathBaru)) {
            if ($gambarLama && file_exists($folderTujuan . $gambarLama)) {
                unlink($folderTujuan . $gambarLama);
            }
            $gambarBaru = $namaUnik;
        } else {
            echo "<div class='error'>❌ Gagal upload gambar baru.</div>";
        }
    }

    $query = "UPDATE produk SET 
                nama_produk = '$nama', 
                deskripsi = '$deskripsi', 
                harga = '$harga', 
                stok = '$stok', 
                gambar = '$gambarBaru' 
              WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<div class='success'>✅ Produk berhasil diupdate!</div>";
    } else {
        echo "<div class='error'>❌ Gagal update ke database: " . mysqli_error($conn) . "</div>";
    }

    $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM produk WHERE id=$id"));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Produk</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f9f9f9;
      padding: 20px;
    }
    h2 {
      text-align: center;
      color: #333;
    }
    form {
      max-width: 600px;
      margin: auto;
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    label {
      font-weight: bold;
      display: block;
      margin-bottom: 6px;
      color: #333;
    }
    input[type="text"],
    input[type="number"],
    textarea,
    input[type="file"] {
      width: 100%;
      padding: 8px;
      margin-bottom: 15px;
      border-radius: 6px;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }
    button {
      background-color: #28a745;
      color: white;
      border: none;
      padding: 10px 16px;
      font-size: 16px;
      border-radius: 6px;
      cursor: pointer;
      width: 100%;
    }
    button:hover {
      background-color: #218838;
    }
    .back-link {
      text-align: center;
      margin-top: 15px;
    }
    .back-link a {
      color: #007bff;
      text-decoration: none;
    }
    .back-link a:hover {
      text-decoration: underline;
    }
    img.preview {
      display: block;
      margin-bottom: 10px;
      max-width: 150px;
      border: 1px solid #ddd;
      padding: 4px;
      border-radius: 6px;
    }
    .success {
      background: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
      padding: 10px;
      margin-bottom: 20px;
      border-radius: 6px;
      text-align: center;
    }
    .error {
      background: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
      padding: 10px;
      margin-bottom: 20px;
      border-radius: 6px;
      text-align: center;
    }
    .back-link a {
  display: inline-block;
  padding: 10px 20px;
  background-color: #007bff;
  color: white;
  border-radius: 6px;
  text-decoration: none;
  font-weight: bold;
  transition: background-color 0.3s;
}
.back-link a:hover {
  background-color: #0056b3;
}
  </style>
</head>
<body>

<h2>Edit Produk</h2>
<form action="" method="post" enctype="multipart/form-data">
  <input type="hidden" name="gambar_lama" value="<?= $data['gambar'] ?>">

  <label>Nama Produk</label>
  <input type="text" name="nama" value="<?= htmlspecialchars($data['nama_produk']) ?>" required>

  <label>Deskripsi</label>
  <textarea name="deskripsi" required><?= htmlspecialchars($data['deskripsi']) ?></textarea>

  <label>Harga</label>
  <input type="number" name="harga" value="<?= $data['harga'] ?>" step="0.01" required>

  <label>Stok</label>
  <input type="number" name="stok" value="<?= $data['stok'] ?>" required>

  <label>Gambar Saat Ini</label>
  <img src="uploads/<?= $data['gambar'] ?>" class="preview" alt="Gambar Produk">

  <label>Ganti Gambar (opsional)</label>
  <input type="file" name="gambar" accept="image/*">

  <button type="submit">Update</button>
</form>

<div class="back-link">
  <a href="admin_dashboard.php?admin_Home=24">← Kembali ke Daftar Produk</a>
</div>

</body>
</html>
