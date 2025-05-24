<h2 style="text-align:center; margin-top: 1rem;">Katalog Produk</h2>
<div class="product-list">
  <?php
  include 'koneksi.php'; // Koneksi ke database
  $upload_dir = "uploads/"; // Lokasi folder gambar

  $query = "SELECT * FROM produk";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    while ($item = mysqli_fetch_assoc($result)) {
      echo '
      <div class="product-item" style="border: 1px solid #ccc; padding: 15px; margin: 10px; border-radius: 8px; max-width: 300px;">
        <img src="' . $upload_dir . htmlspecialchars($item["gambar"]) . '" alt="' . htmlspecialchars($item["nama_produk"]) . '" width="100%" style="border-radius: 6px;">
        <div class="product-info">
          <h3>' . htmlspecialchars($item["nama_produk"]) . '</h3>
          <p>' . htmlspecialchars($item["deskripsi"]) . '</p>
          <p><strong>Stok tersedia:</strong> ' . intval($item["stok"]) . ' kg</p>
          <form action="index.php?Home=2" method="post">
            <input type="hidden" name="nama" value="' . htmlspecialchars($item["nama_produk"]) . '">
            <input type="hidden" name="harga" value="' . $item["harga"] . '">
            <label for="jumlah">Jumlah (kg):</label>
            <input type="number" id="jumlah" name="jumlah" min="1" max="' . intval($item["stok"]) . '" value="1" required>
            <p class="harga">Rp ' . number_format($item["harga"], 0, ',', '.') . '</p>
            <button type="submit">Checkout</button>
          </form>
        </div>
      </div>';
    }
  } else {
    echo '<p style="text-align:center;">Tidak ada produk yang tersedia.</p>';
  }
  ?>
</div>
