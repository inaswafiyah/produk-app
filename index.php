<?php
// Tampilkan pesan sukses/error via query string
$sukses = $_GET['sukses'] ?? '';
$error  = $_GET['error']  ?? '';
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Tambah Produk</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body{font-family:system-ui,Arial;margin:24px;max-width:720px}
    .box{padding:16px;border:1px solid #ddd;border-radius:12px}
    .row{margin-bottom:12px}
    label{display:block;margin-bottom:6px;font-weight:600}
    input, textarea, select{width:100%;padding:10px;border:1px solid #ccc;border-radius:8px}
    button{padding:10px 16px;border:0;border-radius:8px;cursor:pointer}
    .btn{background:#0d6efd;color:#fff}
    .info{padding:10px;border-radius:8px;margin-bottom:12px}
    .ok{background:#e7f7ee;border:1px solid #8bd1a1}
    .bad{background:#fdecea;border:1px solid #f5a09a}
    nav a{margin-right:12px}
  </style>
</head>
<body>
  <h1>Form Tambah Produk</h1>
  <nav>
    <a href="index.php">Form</a>
    <a href="daftar.php">Daftar Produk</a>
  </nav>

  <?php if ($sukses): ?>
    <div class="info ok"><?= htmlspecialchars($sukses) ?></div>
  <?php endif; ?>
  <?php if ($error): ?>
    <div class="info bad"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <div class="box">
    <form method="post" action="simpan.php" novalidate>
      <div class="row">
        <label for="nama">Nama Produk</label>
        <input type="text" id="nama" name="nama" placeholder="Contoh: Gentle Cleanser" required>
      </div>
      <div class="row">
        <label for="harga">Harga (Rp)</label>
        <input type="number" id="harga" name="harga" min="0" step="1" placeholder="Contoh: 75000" required>
      </div>
      <div class="row">
        <label for="deskripsi">Deskripsi</label>
        <textarea id="deskripsi" name="deskripsi" rows="4" placeholder="Tulis deskripsi produk..." required></textarea>
      </div>
      <div class="row">
        <label for="kategori">Kategori:</label>
        <select name="kategori" id="kategori" required>
          <option value="">-- Pilih Kategori --</option>
          <option value="Skincare">Skincare</option>
          <option value="Makeup">Makeup</option>
          <option value="Haircare">Haircare</option>
        </select>
      </div>
      <button class="btn" type="submit">Simpan</button>
    </form>
  </div>
</body>
</html>
