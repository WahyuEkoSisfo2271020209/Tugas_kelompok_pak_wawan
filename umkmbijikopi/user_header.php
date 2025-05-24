<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UMKM Kopi Lampung</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">



<header>
  <div class="logo">
    <img src="logo.png" alt="Logo">
    Biji Kopi Lampung
  </div>
  <nav>
    <a href="user_dashboard.php">Home</a>
    <a href="user_dashboard.php?user_Home=11">katalog</a>
    <a href="user_dashboard.php?user_Home=13">pesanan</a>
    

    <?php if (isset($_SESSION['username'])): ?>
      <span style="margin-left:1rem; font-weight:500;">
        👤 <?= htmlspecialchars($_SESSION['username']) ?> |
        <a href="logout.php" style="color: red; text-decoration: none;">Logout</a>
      </span>
    <?php else: ?>
      <a href="index.php?Home=2">Login</a>
    <?php endif; ?>
  </nav>
</header>
