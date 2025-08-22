<?php
require __DIR__ . '/config.php';
$kategori = $_GET['kategori'] ?? '';

if ($kategori) {
  $stmt = $mysqli->prepare("SELECT * FROM produk WHERE kategori = ? ORDER BY id DESC");
  $stmt->bind_param("s", $kategori);
  $stmt->execute();
  $res = $stmt->get_result();
} else {
  $res = $mysqli->query("SELECT * FROM produk ORDER BY id DESC");
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Daftar Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
  <h1 class="mb-4">Daftar Produk</h1>
  <nav class="mb-3">
    <a href="index.php" class="btn btn-primary btn-sm">Tambah Produk</a>
    <a href="cart.php" class="btn btn-warning btn-sm">Keranjang</a>
  </nav>

  <form method="get" class="row mb-3">
    <div class="col-auto">
      <select name="kategori" class="form-select">
        <option value="">-- Semua Kategori --</option>
        <option value="Skincare" <?= $kategori==='Skincare'?'selected':'' ?>>Skincare</option>
        <option value="Makeup" <?= $kategori==='Makeup'?'selected':'' ?>>Makeup</option>
        <option value="Haircare" <?= $kategori==='Haircare'?'selected':'' ?>>Haircare</option>
      </select>
    </div>
    <div class="col-auto">
      <button type="submit" class="btn btn-success">Filter</button>
    </div>
  </form>

  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Harga</th>
        <th>Deskripsi</th>
        <th>Kategori</th>
        <th>Gambar</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $res->fetch_assoc()): ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['nama']) ?></td>
        <td>Rp <?= number_format($row['harga'],0,',','.') ?></td>
        <td><?= nl2br(htmlspecialchars($row['deskripsi'])) ?></td>
        <td><?= htmlspecialchars($row['kategori']) ?></td>
        <td>
          <?php if (!empty($row['image'])): ?>
            <img src="uploads/<?= htmlspecialchars($row['image']) ?>" alt="Gambar" style="max-width:80px;max-height:80px;">
          <?php endif; ?>
        </td>
        <td>
          <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
          <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus produk ini?')">Hapus</a>
          <a href="cart.php?add=<?= $row['id'] ?>" class="btn btn-sm btn-success">+ Keranjang</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
</body>
</html>
