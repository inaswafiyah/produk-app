<?php
$host = '127.0.0.1';
$user = 'root';
$pass = '';          // ganti jika password MySQL-mu tidak kosong
$db   = 'praktek';

$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_errno) {
  die('Koneksi gagal: ' . $mysqli->connect_error);
}
$mysqli->set_charset('utf8mb4');
