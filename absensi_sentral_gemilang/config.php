<?php
// 1. Pastikan session dimulai dengan aman
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. Konfigurasi Database (Sudah dibersihkan dari spasi gaib)
$host = "localhost";
$db   = "absensi_sentral_gemilang";
$user = "root";
$pass = "";

// 3. Menggunakan try-catch agar error database tidak membocorkan password/username ke browser
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $mysqli = new mysqli($host, $user, $pass, $db);
    $mysqli->set_charset("utf8mb4"); // Memastikan support karakter yang luas
} catch (mysqli_sql_exception $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}

// 4. Helper Functions
function isLogin() {
    return isset($_SESSION['user_id']);
}

function requireLogin() {
    if (!isLogin()) {
        // Menggunakan exit setelah header redirect adalah kewajiban demi keamanan
        header("Location: login.php");
        exit();
    }
}