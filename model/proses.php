<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password']; 

    $check_email = mysqli_query($conn, "SELECT * FROM daftar WHERE email='$email'");
    if (mysqli_num_rows($check_email) > 0) {
        echo "<script>alert('Email sudah terdaftar! Silakan login.'); window.location='login.html';</script>";
        exit();
    }

    $query = "INSERT INTO daftar (name, email, password) VALUES ('$name', '$email', '$password')";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='login.html';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan. Coba lagi!'); window.location='signup.html';</script>";
    }
}
?>
