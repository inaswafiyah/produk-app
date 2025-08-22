<?php
session_start();
require __DIR__ . '/config.php';

if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}

// Tambah ke keranjang
if (isset($_GET['add'])) {
  $id = (int)$_GET['add'];
  $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
  header("Location: cart.php");
  exit;
}

$items = [];
if ($_SESSION['cart']) {
  $ids = implode(',', array_keys($_SESSION['cart']));
  $res = $mysqli->query("SELECT * FROM produk WHERE id IN ($ids)");
  while ($row = $res->fetch_assoc()) {
    $row['qty'] = $_SESSION['cart'][$row['id']];
    $items[] = $row;
  }
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Keranjang Belanja</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
  <h1>Keranjang Belanja</h1>
  <a href="daftar.php" class="btn btn-primary mb-3">Kembali ke Daftar Produk</a>

  <?php if (!$items): ?>
    <div class="alert alert-info">Keranjang masih kosong.</div>
  <?php else: ?>
    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>Gambar</th>
          <th>Nama</th>
          <th>Harga</th>
          <th>Qty</th>
          <th>Subtotal</th>
        </tr>
      </thead>
      <tbody>
        <?php $total=0; foreach ($items as $it): 
          $sub = $it['harga'] * $it['qty'];
          $total += $sub;
        ?>
        <tr>
          <td>
            <?php if (!empty($it['image'])): ?>
              <img src="uploads/<?= htmlspecialchars($it['image']) ?>" alt="Gambar" style="max-width:60px;max-height:60px;">
            <?php endif; ?>
          </td>
          <td><?= htmlspecialchars($it['nama']) ?></td>
          <td>Rp <?= number_format($it['harga'],0,',','.') ?></td>
          <td><?= $it['qty'] ?></td>
          <td>Rp <?= number_format($sub,0,',','.') ?></td>
        </tr>
        <?php endforeach; ?>
        <tr class="fw-bold">
          <td colspan="4">Total</td>
          <td>Rp <?= number_format($total,0,',','.') ?></td>
        </tr>
      </tbody>
    </table>
  <?php endif; ?>
</div>
</body>
</html>
