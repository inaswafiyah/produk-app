<?php
require __DIR__ . '/config.php';

// Helper redirect dengan pesan
function redirect_with(array $params) {
  $q = http_build_query($params);
  header("Location: index.php?$q");
  exit;
}

// Ambil & rapikan input
$nama = trim($_POST['nama'] ?? '');
$harga = trim($_POST['harga'] ?? '');
$deskripsi = trim($_POST['deskripsi'] ?? '');

// Validasi sederhana (server-side, WAJIB)
$errors = [];
if ($nama === '')            $errors[] = 'Nama produk wajib diisi.';
if ($harga === '')           $errors[] = 'Harga wajib diisi.';
elseif (!ctype_digit($harga) || (int)$harga < 0)
                             $errors[] = 'Harga harus angka bulat ≥ 0.';
if ($deskripsi === '')       $errors[] = 'Deskripsi wajib diisi.';

if ($errors) {
  redirect_with(['error' => implode(' ', $errors)]);
}

// Simpan (prepared statement untuk cegah SQL injection)
$stmt = $mysqli->prepare(
  "INSERT INTO produk (nama, harga, deskripsi, created_at) VALUES (?, ?, ?, NOW())"
);
if (!$stmt) {
  redirect_with(['error' => 'Gagal menyiapkan query: ' . $mysqli->error]);
}

$hargaInt = (int)$harga;
$stmt->bind_param('sis', $nama, $hargaInt, $deskripsi);

if ($stmt->execute()) {
  redirect_with(['sukses' => 'Produk berhasil disimpan.']);
} else {
  redirect_with(['error' => 'Gagal menyimpan: ' . $stmt->error]);
}
