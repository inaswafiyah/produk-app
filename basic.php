<?php
// Deklarasi variabel
$namaPengguna = "Inas";
$harga = 10000;  // satuan rupiah
$qty   = 3;

// Operator aritmatika
$total = $harga * $qty;

// If–else (percabangan)
if ($total > 20000) {
  $diskon = 0.10; // 10%
  $totalBayar = $total - ($total * $diskon);
  $pesan = "Diskon 10% diterapkan.";
} else {
  $totalBayar = $total;
  $pesan = "Belum dapat diskon.";
}

echo "Halo $namaPengguna, total: Rp$total. $pesan Bayar: Rp$totalBayar.";
