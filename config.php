<?php
$host = "localhost";
$user = "root";  // Ganti jika ada username lain
$password = "";  // Isi jika ada password
$database = "lost_found_db";

$conn = new mysqli($host, $user, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
