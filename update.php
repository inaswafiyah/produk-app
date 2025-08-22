<?php
require __DIR__ . '/config.php';

$id        = $_POST['id'];
$nama      = $_POST['nama'];
$harga     = $_POST['harga'];
$deskripsi = $_POST['deskripsi'];
$kategori  = $_POST['kategori'];

// Ambil gambar lama dari database
$stmt = $mysqli->prepare("SELECT image FROM produk WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_assoc();
$imageName = $row['image'];

// Proses upload gambar baru jika ada
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
  $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
  $imageName = uniqid('img_') . '.' . $ext;
  move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $imageName);
}

$stmt = $mysqli->prepare("UPDATE produk SET nama=?, harga=?, deskripsi=?, kategori=?, image=? WHERE id=?");
$stmt->bind_param("sdsssi", $nama, $harga, $deskripsi, $kategori, $imageName, $id);
$stmt->execute();

header("Location: daftar.php?sukses=Produk berhasil diupdate");
exit;
?>
