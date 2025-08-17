<?php
require __DIR__ . '/config.php';

// Cek filter kategori
$kategori = $_GET['kategori'] ?? '';

if ($kategori) {
  $stmt = $mysqli->prepare("SELECT id, nama, harga, deskripsi, kategori, created_at FROM produk WHERE kategori = ? ORDER BY id DESC");
  $stmt->bind_param("s", $kategori);
  $stmt->execute();
  $res = $stmt->get_result();
} else {
  $res = $mysqli->query("SELECT id, nama, harga, deskripsi, kategori, created_at FROM produk ORDER BY id DESC");
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Daftar Produk</title>
</head>
<body>
  <h1>Daftar Produk</h1>
  <form method="get">
    <label>Filter Kategori:</label>
    <select name="kategori">
      <option value="">-- Semua --</option>
      <option value="Skincare" <?= $kategori==='Skincare'?'selected':'' ?>>Skincare</option>
      <option value="Makeup" <?= $kategori==='Makeup'?'selected':'' ?>>Makeup</option>
      <option value="Haircare" <?= $kategori==='Haircare'?'selected':'' ?>>Haircare</option>
    </select>
    <button type="submit">Terapkan</button>
  </form>
  <table border="1" cellpadding="10">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Harga (Rp)</th>
        <th>Deskripsi</th>
        <th>Kategori</th>
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
        <td><?= htmlspecialchars($row['kategori']) ?></td>
        <td><?= htmlspecialchars($row['created_at']) ?></td>
      </tr>
    <?php endwhile; ?>
    </tbody>
  </table>
</body>
</html>
