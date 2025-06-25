<?php
$host = "sql112.infinityfree.com";
$user = "if0_39141491";  
$password = "akmalme01";  
$database = "if0_39141491_findit";

$conn = new mysqli($host, $user, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>