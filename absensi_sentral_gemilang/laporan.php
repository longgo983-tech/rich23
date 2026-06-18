<?php
require 'config.php';
requireLogin();

$tanggal_mulai = $_GET['mulai'] ?? date('Y-m-01');
$tanggal_selesai = $_GET['selesai'] ?? date('Y-m-d');

$laporan = $mysqli->query(
  "SELECT a.*, k.nama FROM absensi a JOIN karyawan k ON a.karyawan_id = k.id WHERE a.tanggal BETWEEN '$tanggal_mulai' AND '$tanggal_selesai' ORDER BY a.tanggal DESC, k.nama"
);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Laporan Absensi</title>
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
    <h2>Laporan Absensi</h2>
    <form method="get" class="inline-form">
      <label>Dari</label>
      <input type="date" name="mulai" value="<?= htmlspecialchars($tanggal_mulai) ?>">
      <label>Sampai</label>
      <input type="date" name="selesai" value="<?= htmlspecialchars($tanggal_selesai) ?>">
      <button type="submit">Filter</button>
    </form>

    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Nama</th>
          <th>Tanggal</th>
          <th>Status</th>
          <th>Masuk</th>
          <th>Keluar</th>
          <th>Catatan</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $laporan->fetch_assoc()): ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td><?= $row['tanggal'] ?></td>
            <td><?= $row['status'] ?></td>
            <td><?= $row['jam_masuk'] ?></td>
            <td><?= htmlspecialchars($row['jam_keluar']) ?></td>
            <td><?= htmlspecialchars($row['catatan']) ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
