<?php
require 'config.php';
requireLogin();

$message = '';
$today = date('Y-m-d');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $karyawan_id = intval($_POST['karyawan_id']);
    $tanggal = $today;
    $jam_masuk = $_POST['jam_masuk'];
    $jam_keluar = $_POST['jam_keluar'] ?: null;
    $status = $_POST['status'];
    $catatan = $mysqli->real_escape_string($_POST['catatan']);

    $mysqli->query(
      "INSERT INTO absensi (karyawan_id, tanggal, jam_masuk, jam_keluar, status, catatan) VALUES ($karyawan_id, '$tanggal', '$jam_masuk', " . ($jam_keluar ? "'$jam_keluar'" : "NULL") . ", '$status', '$catatan')"
    );
    $message = 'Absensi berhasil dicatat.';
}

$karyawans = $mysqli->query("SELECT * FROM karyawan ORDER BY nama");
$absensi = $mysqli->query(
  "SELECT a.*, k.nama FROM absensi a JOIN karyawan k ON a.karyawan_id = k.id ORDER BY a.tanggal DESC, a.jam_masuk DESC"
);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Absensi Karyawan</title>
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
    <h2>Absensi Karyawan</h2>
    <?php if ($message): ?>
      <div class="success"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>
    <form method="post">
      <label>Karyawan</label>
      <select name="karyawan_id" required>
        <?php while ($k = $karyawans->fetch_assoc()): ?>
          <option value="<?= $k['id'] ?>"><?= htmlspecialchars($k['nama']) ?></option>
        <?php endwhile; ?>
      </select>
      <label>Tanggal</label>
      <input type="text" value="<?= $today ?>" readonly>
      <input type="hidden" name="tanggal" value="<?= $today ?>">
      <label>Jam Masuk</label>
      <input type="time" name="jam_masuk" required value="<?= date('H:i') ?>">
      <label>Jam Keluar</label>
      <input type="time" name="jam_keluar">
      <label>Status</label>
      <select name="status" required>
        <option value="Hadir">Hadir</option>
        <option value="Izin">Izin</option>
        <option value="Sakit">Sakit</option>
        <option value="Alpha">Alpha</option>
      </select>
      <label>Catatan</label>
      <textarea name="catatan"></textarea>
      <button type="submit">Catat Absensi</button>
    </form>

    <h3>Riwayat Absensi</h3>
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Nama</th>
          <th>Tanggal</th>
          <th>Masuk</th>
          <th>Keluar</th>
          <th>Status</th>
          <th>Catatan</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $absensi->fetch_assoc()): ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td><?= $row['tanggal'] ?></td>
            <td><?= $row['jam_masuk'] ?></td>
            <td><?= htmlspecialchars($row['jam_keluar']) ?></td>
            <td><?= $row['status'] ?></td>
            <td><?= htmlspecialchars($row['catatan']) ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
