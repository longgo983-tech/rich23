CREATE DATABASE IF NOT EXISTS absensi_sentral_gemilang CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE absensi_sentral_gemilang;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  nama_lengkap VARCHAR(150) NOT NULL,
  role ENUM('admin','staff') NOT NULL DEFAULT 'admin'
);

CREATE TABLE karyawan (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(150) NOT NULL,
  jabatan VARCHAR(100) NOT NULL,
  no_telp VARCHAR(20),
  alamat TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE absensi (
  id INT AUTO_INCREMENT PRIMARY KEY,
  karyawan_id INT NOT NULL,
  tanggal DATE NOT NULL,
  jam_masuk TIME NOT NULL,
  jam_keluar TIME DEFAULT NULL,
  status ENUM('Hadir','Izin','Sakit','Alpha') NOT NULL DEFAULT 'Hadir',
  catatan TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (karyawan_id) REFERENCES karyawan(id) ON DELETE CASCADE
);

INSERT INTO users (username, password, nama_lengkap, role)
VALUES ('admin', MD5('admin123'), 'Administrator', 'admin');
