<?php
include 'config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $name = $_POST['name'];
 $email = $_POST['email'];
 $password = $_POST['password'];
 $sql = "INSERT INTO daftar (name, email, password) VALUES
('$name', '$email', '$password')";
 if ($conn->query($sql) === TRUE) {
 echo "Data berhasil disimpan.";
 } else {
 echo "Error: " . $sql . "<br>" . $conn->error;
 }
 $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SweetAlert2 Berhasil</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #b3b3b3;
        }
    </style>
</head>
<body>
<script>
    Swal.fire({
        icon: "success",
        text: "Data berhasil disimpan!",
        confirmButtonColor: "#3085d6",
        confirmButtonText: "OK"
    });
</script>
</body>
</html>