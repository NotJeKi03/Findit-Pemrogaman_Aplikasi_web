<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: /login.php");
    exit();
}

include 'DB_Connection.php';

// Ambil data dari form
$jenis_laporan = $_POST['jenis_laporan'];
$nama_barang = $_POST['nama_barang'];
$nomor_penghubung = $_POST['nomor_penghubung'];
$deskripsi_barang = $_POST['deskripsi_barang'];
$lokasi_kejadian = $_POST['lokasi_kejadian'];
$user_id = $_SESSION['user_id'];

// Simpan data awal (tanpa foto dulu)
$sql = "INSERT INTO daftar_barang (jenis_laporan, nama_barang, nomor_penghubung, deskripsi_barang, lokasi_kejadian, user_id)
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssi", $jenis_laporan, $nama_barang, $nomor_penghubung, $deskripsi_barang, $lokasi_kejadian, $user_id);

if ($stmt->execute()) {
    $itemID = $stmt->insert_id; // Ambil ID dari data yang baru dimasukkan

    // Upload dan rename file sesuai format imgX-itemIDY
    $foto1 = uploadFile('foto1', "img1-itemID{$itemID}");
    $foto2 = uploadFile('foto2', "img2-itemID{$itemID}");
    $foto3 = uploadFile('foto3', "img3-itemID{$itemID}");

    // Update kolom foto setelah insert
    $update_sql = "UPDATE daftar_barang SET foto1=?, foto2=?, foto3=? WHERE id=?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sssi", $foto1, $foto2, $foto3, $itemID);
    $update_stmt->execute();
    $update_stmt->close();

    echo "<script>alert('Data berhasil dimasukkan.'); window.location='/views/buat_laporan.php';</script>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

// Fungsi upload file
function uploadFile($input_name, $custom_filename_base)
{
    $upload_dir = "/uploads/";
    $target_path = $_SERVER['DOCUMENT_ROOT'] . $upload_dir;

    if (isset($_FILES[$input_name]) && $_FILES[$input_name]['error'] == 0) {
        $file_ext = pathinfo($_FILES[$input_name]['name'], PATHINFO_EXTENSION);
        $filename = $custom_filename_base . '.' . $file_ext;
        $destination = $target_path . $filename;

        // Pastikan direktori ada
        if (!file_exists($target_path)) {
            mkdir($target_path, 0755, true);
        }

        if (move_uploaded_file($_FILES[$input_name]['tmp_name'], $destination)) {
            return $upload_dir . $filename; // path relatif
        }
    }

    return null;
}
?>