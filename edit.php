<?php
require __DIR__ . '/config.php';
$id = $_GET['id'] ?? 0;
$stmt = $mysqli->prepare("SELECT * FROM produk WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
if (!$data) { die("Produk tidak ditemukan."); }
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Edit Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
  <h1>Edit Produk</h1>
  <form method="post" action="update.php" class="card p-3 shadow-sm" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $data['id'] ?>">
    <div class="mb-3">
      <label class="form-label">Nama Produk</label>
      <input type="text" class="form-control" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Harga</label>
      <input type="number" class="form-control" name="harga" value="<?= $data['harga'] ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Deskripsi</label>
      <textarea class="form-control" name="deskripsi" rows="3"><?= htmlspecialchars($data['deskripsi']) ?></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Kategori</label>
      <select name="kategori" class="form-select">
        <option value="Skincare" <?= $data['kategori']=='Skincare'?'selected':'' ?>>Skincare</option>
        <option value="Makeup" <?= $data['kategori']=='Makeup'?'selected':'' ?>>Makeup</option>
        <option value="Haircare" <?= $data['kategori']=='Haircare'?'selected':'' ?>>Haircare</option>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Gambar Produk</label>
      <?php if (!empty($data['image'])): ?>
        <div class="mb-2">
          <img src="uploads/<?= htmlspecialchars($data['image']) ?>" alt="Gambar" style="max-width:100px;max-height:100px;">
        </div>
      <?php endif; ?>
      <input type="file" class="form-control" name="image" accept="image/*">
      <div class="form-text">Kosongkan jika tidak ingin mengganti gambar.</div>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="daftar.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>
</body>
</html>
