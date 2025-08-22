<?php
require __DIR__ . '/config.php';

$id = $_GET['id'] ?? 0;
$stmt = $mysqli->prepare("DELETE FROM produk WHERE id=?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
  header("Location: daftar.php?sukses=Produk berhasil dihapus");
} else {
  header("Location: daftar.php?error=Gagal hapus produk");
}
