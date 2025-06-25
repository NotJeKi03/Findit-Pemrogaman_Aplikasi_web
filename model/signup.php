<?php
include 'DB_Connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Simpan langsung tanpa hash

    // Cek apakah email sudah terdaftar
    $check_email = mysqli_query($conn, "SELECT * FROM account WHERE email='$email'");
    if (mysqli_num_rows($check_email) > 0) {
        echo "<script>alert('Email sudah terdaftar! Silakan login.'); window.location='/signup.php';</script>";
        exit();
    }

    // Simpan data ke database
    $query = "INSERT INTO account (name, email, password) VALUES ('$name', '$email', '$password')";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='/login.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan. Coba lagi!'); window.location='/signup.php';</script>";
    }
}
?>