<?php
require 'config.php';
requireLogin();

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $mysqli->real_escape_string($_POST['nama']);
    $jabatan = $mysqli->real_escape_string($_POST['jabatan']);
    $no_telp = $mysqli->real_escape_string($_POST['no_telp']);
    $alamat = $mysqli->real_escape_string($_POST['alamat']);

    $mysqli->query("INSERT INTO karyawan (nama, jabatan, no_telp, alamat) VALUES ('$nama', '$jabatan', '$no_telp', '$alamat')");
    $message = 'Karyawan berhasil ditambahkan.';
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Tambah Karyawan</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="navbar">
    <a href="dashboard.php">Dashboard</a>
    <a href="karyawan.php">Data Karyawan</a>
    <a href="absensi.php">Absensi</a>
    <a href="laporan.php">Laporan</a>
    <a href="logout.php" class="right">Logout</a>
  </div>
  <div class="container">
    <h2>Tambah Karyawan</h2>
    <?php if ($message): ?>
      <div class="success"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>
    <form method="post">
      <label>Nama</label>
      <input type="text" name="nama" required>
      <label>Jabatan</label>
      <input type="text" name="jabatan" required>
      <label>No. Telp</label>
      <input type="number" name="no_telp">
      <label>Alamat</label>
      <textarea name="alamat"></textarea>
      <button type="submit">Simpan</button>
    </form>
  </div>
</body>
</html>
