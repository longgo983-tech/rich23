<?php
require 'config.php';
requireLogin();

// Pastikan ada parameter ID yang dikirim melalui URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Menggunakan prepared statement untuk keamanan (menghindari SQL Injection)
    $stmt = $mysqli->prepare("DELETE FROM karyawan WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Jika berhasil, kembali ke halaman data karyawan dengan pesan sukses (opsional)
        header("Location: karyawan.php?status=sukses_hapus");
        exit;
    } else {
        echo "Gagal menghapus data: " . $mysqli->error;
    }
    
    $stmt->close();
} else {
    // Jika tidak ada ID, langsung kembalikan ke halaman utama
    header("Location: karyawan.php");
    exit;
}
?>