<?php
require 'config.php';
requireLogin();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Dashboard Absensi</title>
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
    <h1>Selamat datang, <?= htmlspecialchars($_SESSION['nama_lengkap']) ?></h1>
    <p>Aplikasi absensi karyawan toko Sentral Gemilang Sakti.</p>
  </div>
</body>
</html>
