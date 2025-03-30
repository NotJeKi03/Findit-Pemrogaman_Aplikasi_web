<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password']; 

    $result = mysqli_query($conn, "SELECT * FROM daftar WHERE email='$email'");
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        if ($password === $row['password']) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            echo "<script>alert('Login berhasil!'); window.location='caripage.html';</script>";
        } else {
            echo "<script>alert('Password salah!'); window.location='login.html';</script>";
        }
    } else {
        echo "<script>alert('Email tidak terdaftar!'); window.location='login.html';</script>";
    }
}
?>