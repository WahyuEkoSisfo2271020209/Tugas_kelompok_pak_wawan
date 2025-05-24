<?php
include 'koneksi.php';

// Cek jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama       = $_POST['nama'];
    $deskripsi  = $_POST['deskripsi'];
    $harga      = $_POST['harga'];
    $stok       = $_POST['stok'];

    // Proses upload gambar
    $namaFile   = $_FILES['gambar']['name'];
    $tmpName    = $_FILES['gambar']['tmp_name'];
    $folderTujuan = 'uploads/';

    if (!is_dir($folderTujuan)) {
        mkdir($folderTujuan, 0777, true);
    }

    // Hindari nama file bentrok
    $namaBaru = time() . '_' . basename($namaFile);
    $pathFile = $folderTujuan . $namaBaru;

    if (move_uploaded_file($tmpName, $pathFile)) {
        // Simpan ke database
        $query = "INSERT INTO produk (nama_produk, deskripsi, harga, stok, gambar)
                  VALUES ('$nama', '$deskripsi', '$harga', '$stok', '$namaBaru')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "<p style='color:green;'>Produk berhasil ditambahkan!</p>";
        } else {
            echo "<p style='color:red;'>Gagal menyimpan ke database: " . mysqli_error($conn) . "</p>";
        }
    } else {
        echo "<p style='color:red;'>Gagal mengupload gambar.</p>";
    }
}
?>

<h2>Tambah Produk</h2>
<form action="" method="post" enctype="multipart/form-data">
  Nama Produk:<br>
  <input type="text" name="nama" required><br><br>

  Deskripsi:<br>
  <textarea name="deskripsi" required></textarea><br><br>

  Harga:<br>
  <input type="number" name="harga" required><br><br>

  Stok:<br>
  <input type="number" name="stok" required><br><br>

  Gambar Produk:<br>
  <input type="file" name="gambar" accept="image/*" required><br><br>

  <button type="submit">Simpan</button>
</form>

<div class="back-link">
<a href="admin_dashboard.php?admin_Home=24">← Kembali ke Daftar Produk</a>
</div>
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