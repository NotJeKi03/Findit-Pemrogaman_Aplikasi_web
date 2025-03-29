<?php
$host = 'localhost';
$user = "root";
$password = "";
$database = "logindb";
$conn = new mysqli($host, $user, $password, $database);
if (!$conn) {
    echo "koneksi gagal";
    die("Connection failed: " . mysqli_connect_error());
}
?>