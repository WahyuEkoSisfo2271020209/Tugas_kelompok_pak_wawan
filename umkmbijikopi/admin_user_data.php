<?php
include 'koneksi.php';

// Cek apakah admin sudah login
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    echo "Akses ditolak. Halaman ini hanya untuk admin.";
    exit;
}

// Ambil semua data user
$result = $conn->query("SELECT id, username, email, no_hp, role FROM users ORDER BY id ASC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Pengguna</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f5f4;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
        }

        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #34495e;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .admin {
            color: red;
            font-weight: bold;
        }

        .user {
            color: green;
        }
    </style>
</head>
<body>

<h2>Daftar Pengguna Website</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>No. HP</th>
        <th>Role</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['username']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= htmlspecialchars($row['no_hp']) ?></td>
        <td class="<?= $row['role'] === 'admin' ? 'admin' : 'user' ?>">
            <?= htmlspecialchars($row['role']) ?>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>