<?php
require __DIR__ . '/config.php';

// Helper redirect dengan pesan
function redirect_with(array $params) {
  $q = http_build_query($params);
  header("Location: index.php?$q");
  exit;
}

// Ambil & rapikan input
$nama      = trim($_POST['nama'] ?? '');
$harga     = trim($_POST['harga'] ?? '');
$deskripsi = trim($_POST['deskripsi'] ?? '');
$kategori  = trim($_POST['kategori'] ?? '');

// Validasi sederhana (server-side, WAJIB)
$errors = [];
if ($nama === '')            $errors[] = 'Nama produk wajib diisi.';
if ($harga === '')           $errors[] = 'Harga wajib diisi.';
elseif (!ctype_digit($harga) || (int)$harga < 0)
                             $errors[] = 'Harga harus angka bulat ≥ 0.';
if ($deskripsi === '')       $errors[] = 'Deskripsi wajib diisi.';
if ($kategori === '')        $errors[] = 'Kategori wajib dipilih.';

if ($errors) {
  redirect_with(['error' => implode(' ', $errors)]);
}

// Proses upload gambar
$imageName = '';
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
  $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
  $imageName = uniqid('img_') . '.' . $ext;
  move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $imageName);
}

// Simpan (prepared statement untuk cegah SQL injection)
$stmt = $mysqli->prepare("INSERT INTO produk (nama, harga, deskripsi, kategori, image) VALUES (?, ?, ?, ?, ?)");
if (!$stmt) {
  redirect_with(['error' => 'Gagal menyiapkan query: ' . $mysqli->error]);
}

$stmt->bind_param("sdsss", $nama, $harga, $deskripsi, $kategori, $imageName);

if ($stmt->execute()) {
  redirect_with(['sukses' => 'Produk berhasil disimpan.']);
} else {
  redirect_with(['error' => 'Gagal menyimpan: ' . $stmt->error]);
}
