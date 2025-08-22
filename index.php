<?php
$sukses = $_GET['sukses'] ?? '';
$error  = $_GET['error']  ?? '';
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Tambah Produk</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
  <h1 class="mb-4">Tambah Produk</h1>
  <nav class="mb-3">
    <a href="index.php" class="btn btn-primary btn-sm">Form</a>
    <a href="daftar.php" class="btn btn-success btn-sm">Daftar Produk</a>
    <a href="cart.php" class="btn btn-warning btn-sm">Keranjang</a>
  </nav>

  <?php if ($sukses): ?>
    <div class="alert alert-success"><?= htmlspecialchars($sukses) ?></div>
  <?php endif; ?>
  <?php if ($error): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <div class="card shadow-sm">
    <div class="card-body">
      <form method="post" action="simpan.php" enctype="multipart/form-data" novalidate>
        <div class="mb-3">
          <label for="nama" class="form-label">Nama Produk</label>
          <input type="text" class="form-control" id="nama" name="nama" placeholder="Contoh: Gentle Cleanser" required>
        </div>
        <div class="mb-3">
          <label for="harga" class="form-label">Harga (Rp)</label>
          <input type="number" class="form-control" id="harga" name="harga" min="0" step="1" placeholder="Contoh: 75000" required>
        </div>
        <div class="mb-3">
          <label for="deskripsi" class="form-label">Deskripsi</label>
          <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
        </div>
        <div class="mb-3">
          <label for="kategori" class="form-label">Kategori</label>
          <select class="form-select" id="kategori" name="kategori" required>
            <option value="">-- Pilih Kategori --</option>
            <option value="Skincare">Skincare</option>
            <option value="Makeup">Makeup</option>
            <option value="Haircare">Haircare</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="image" class="form-label">Gambar Produk</label>
          <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
        </div>
        <button class="btn btn-primary" type="submit">Simpan</button>
      </form>
    </div>
  </div>
</div>
</body>
</html>
