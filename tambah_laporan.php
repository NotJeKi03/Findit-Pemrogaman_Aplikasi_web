<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jenis_laporan = $_POST["jenis_laporan"];
    $nama_barang = $_POST["nama_barang"];
    $nomor_penghubung = $_POST["nomor_penghubung"];
    $lokasi_kejadian = $_POST["lokasi_kejadian"];
    $deskripsi_barang = $_POST["deskripsi_barang"];

    // Upload foto (opsional)
    $foto = "";
    if (!empty($_FILES["foto"]["name"])) {
        $foto = "uploads/" . basename($_FILES["foto"]["name"]);
        move_uploaded_file($_FILES["foto"]["tmp_name"], $foto);
    }

    $sql = "INSERT INTO laporan_barang (jenis_laporan, nama_barang, nomor_penghubung, lokasi_kejadian, deskripsi_barang, foto) 
            VALUES ('$jenis_laporan', '$nama_barang', '$nomor_penghubung', '$lokasi_kejadian', '$deskripsi_barang', '$foto')";

    if ($conn->query($sql) === TRUE) {
        echo "Laporan berhasil ditambahkan!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Laporan Barang</title>
</head>
<body>
    <h2>Tambah Laporan Barang Hilang/Ditemukan</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label>Jenis Laporan:</label>
        <select name="jenis_laporan">
            <option value="Hilang">Hilang</option>
            <option value="Ditemukan">Ditemukan</option>
        </select><br><br>

        <label>Nama Barang:</label>
        <input type="text" name="nama_barang" required><br><br>

        <label>Nomor Penghubung:</label>
        <input type="text" name="nomor_penghubung" required><br><br>

        <label>Lokasi Kejadian:</label>
        <input type="text" name="lokasi_kejadian" required><br><br>

        <label>Deskripsi Barang:</label>
        <textarea name="deskripsi_barang" required></textarea><br><br>

        <label>Upload Foto:</label>
        <input type="file" name="foto"><br><br>

        <button type="submit">Kirim</button>
    </form>
</body>
</html>
