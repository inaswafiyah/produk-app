<?php
require __DIR__ . '/../config.php';
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
  <title>Toko Online - Produk</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background-color: #f8f9fa; }
    .product-card {
      transition: transform .2s ease, box-shadow .2s ease;
    }
    .product-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 15px rgba(0,0,0,0.15);
    }
    .product-img {
      height: 200px;           /* Tinggi gambar maksimal 80px */
      width: 170px;            /* Lebar gambar maksimal 80px */
      object-fit: cover;
      border-radius: 8px;
      margin: 30px auto 0;    /* Tengah secara horizontal dan beri jarak atas */
      display: block;
      box-shadow: 0 2px 8px rgba(0,0,0,0.07);
    }
    .price {
      font-weight: bold;
      color: #dc3545;
    }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="shop.php">MyShop</a>
    <div>
      <a href="../cart.php" class="btn btn-warning btn-sm">Keranjang</a>
    </div>
  </div>
</nav>

<div class="container py-4">
  <h1 class="mb-4">Produk Kami</h1>

  <!-- Filter -->
  <form method="get" class="row g-2 mb-4">
    <div class="col-md-4">
      <select name="kategori" class="form-select">
        <option value="">-- Semua Kategori --</option>
        <option value="Skincare" <?= $kategori==='Skincare'?'selected':'' ?>>Skincare</option>
        <option value="Makeup" <?= $kategori==='Makeup'?'selected':'' ?>>Makeup</option>
        <option value="Haircare" <?= $kategori==='Haircare'?'selected':'' ?>>Haircare</option>
      </select>
    </div>
    <div class="col-md-2">
      <button type="submit" class="btn btn-success w-100">Filter</button>
    </div>
  </form>

  <!-- Produk Grid -->
  <div class="row">
    <?php while ($row = $res->fetch_assoc()): ?>
      <div class="col-md-3 mb-4">
        <div class="card product-card h-100">
          <?php if (!empty($row['image'])): ?>
            <img src="../uploads/<?= htmlspecialchars($row['image']) ?>" class="card-img-top product-img" alt="<?= htmlspecialchars($row['nama']) ?>">
          <?php else: ?>
            <img src="https://via.placeholder.com/300x240?text=No+Image" class="card-img-top product-img" alt="No Image">
          <?php endif; ?>
          <div class="card-body d-flex flex-column">
            <h5 class="card-title"><?= htmlspecialchars($row['nama']) ?></h5>
            <p class="price">Rp <?= number_format($row['harga'],0,',','.') ?></p>
            <p class="card-text text-muted small"><?= nl2br(htmlspecialchars($row['deskripsi'])) ?></p>
            <span class="badge bg-info text-dark mb-3"><?= htmlspecialchars($row['kategori']) ?></span>
            <a href="../cart.php?add=<?= $row['id'] ?>" class="btn btn-success w-100 mt-auto">+ Tambah ke Keranjang</a>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</div>

<footer class="bg-dark text-light text-center py-3 mt-5">
  <p class="mb-0">&copy; <?= date("Y") ?> MyShop - All Rights Reserved</p>
</footer>
</body>
</html>
