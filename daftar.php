<?php
require __DIR__ . '/config.php';
$res = $mysqli->query("SELECT id, nama, harga, deskripsi, created_at FROM produk ORDER BY id DESC");
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Daftar Produk</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body{font-family:system-ui,Arial;margin:24px;max-width:960px}
    table{width:100%;border-collapse:collapse}
    th,td{padding:10px;border:1px solid #ddd;vertical-align:top}
    th{background:#f7f7f7;text-align:left}
    nav a{margin-right:12px}
  </style>
</head>
<body>
  <h1>Daftar Produk</h1>
  <nav>
    <a href="index.php">+ Tambah Produk</a>
  </nav>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Harga (Rp)</th>
        <th>Deskripsi</th>
        <th>Dibuat</th>
      </tr>
    </thead>
    <tbody>
    <?php while ($row = $res->fetch_assoc()): ?>
      <tr>
        <td><?= (int)$row['id'] ?></td>
        <td><?= htmlspecialchars($row['nama']) ?></td>
        <td><?= number_format((int)$row['harga'], 0, ',', '.') ?></td>
        <td><?= nl2br(htmlspecialchars($row['deskripsi'])) ?></td>
        <td><?= htmlspecialchars($row['created_at']) ?></td>
      </tr>
    <?php endwhile; ?>
    </tbody>
  </table>
</body>
</html>

