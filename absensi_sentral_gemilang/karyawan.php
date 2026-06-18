<?php
require 'config.php';
requireLogin();

$result = $mysqli->query("SELECT * FROM karyawan ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Data Karyawan</title>
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
    <h2>Data Karyawan</h2>
    <a class="button" href="tambah_karyawan.php">Tambah Karyawan</a>
    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Jabatan</th>
          <th>No. Telp</th>
          <th>Alamat</th>
          <th>Aksi</th> </tr>
      </thead>
      <tbody>
        <?php 
        $no = 1; // Opsional: Menggunakan penomoran urut (1, 2, 3...) bukan ID database agar lebih rapi
        while ($row = $result->fetch_assoc()): 
        ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td><?= htmlspecialchars($row['jabatan']) ?></td>
            <td><?= htmlspecialchars($row['no_telp']) ?></td>
            <td><?= htmlspecialchars($row['alamat']) ?></td>
            <td>
              <a class="button button-danger" 
                 href="hapus_karyawan.php?id=<?= $row['id'] ?>" 
                 onclick="return confirm('Apakah Anda yakin ingin menghapus karyawan ini?');">
                 Delete
              </a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</body>
</html>