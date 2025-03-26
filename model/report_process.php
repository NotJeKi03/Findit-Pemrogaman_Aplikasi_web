<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "findit";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$jenis_laporan = $_POST['jenis_laporan'];
$nama_barang = $_POST['nama_barang'];
$nomor_penghubung = $_POST['nomor_penghubung'];
$deskripsi_barang = $_POST['deskripsi_barang'];

$target_dir = "uploads/";
$foto1 = uploadFile('foto1', $target_dir);
$foto2 = uploadFile('foto2', $target_dir);
$foto3 = uploadFile('foto3', $target_dir);

$sql = "INSERT INTO findit_reports (jenis_laporan, nama_barang, nomor_penghubung, deskripsi_barang, foto1, foto2, foto3)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssss", $jenis_laporan, $nama_barang, $nomor_penghubung, $deskripsi_barang, $foto1, $foto2, $foto3);

if ($stmt->execute()) {
    echo "Report submitted successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();

function uploadFile($input_name, $target_dir) {
    if (isset($_FILES[$input_name]) && $_FILES[$input_name]['error'] == 0) {
        $target_file = $target_dir . basename($_FILES[$input_name]['name']);
        if (move_uploaded_file($_FILES[$input_name]['tmp_name'], $target_file)) {
            return $target_file;
        }
    }
    return null;
}
?>
