<?php
session_start();
include 'DB_Connection.php';

// Pastikan user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: /login.php");
    exit();
}

// Ambil ID laporan yang ingin diupdate
$id = $_POST['id'];
$jenis_laporan = $_POST['jenis_laporan'];
$nama_barang = $_POST['nama_barang'];
$nomor_penghubung = $_POST['nomor_penghubung'];
$deskripsi_barang = $_POST['deskripsi_barang'];
$lokasi_kejadian = $_POST['lokasi_kejadian'];
$user_id = $_SESSION['user_id'];

// Ambil data lama untuk cek apakah foto perlu diubah
$sql = "SELECT foto1, foto2, foto3 FROM daftar_barang WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$oldData = $result->fetch_assoc();

if (!$oldData) {
    echo "Data tidak ditemukan atau bukan milik Anda.";
    exit();
}

// Upload foto baru jika ada
$foto1 = uploadFile('foto1', "img1-itemID{$id}") ?? $oldData['foto1'];
$foto2 = uploadFile('foto2', "img2-itemID{$id}") ?? $oldData['foto2'];
$foto3 = uploadFile('foto3', "img3-itemID{$id}") ?? $oldData['foto3'];

// Update data
$update_sql = "UPDATE daftar_barang SET jenis_laporan=?, nama_barang=?, nomor_penghubung=?, deskripsi_barang=?, lokasi_kejadian=?, foto1=?, foto2=?, foto3=? WHERE id=? AND user_id=?";
$update_stmt = $conn->prepare($update_sql);
$update_stmt->bind_param("ssssssssii", $jenis_laporan, $nama_barang, $nomor_penghubung, $deskripsi_barang, $lokasi_kejadian, $foto1, $foto2, $foto3, $id, $user_id);

if ($update_stmt->execute()) {
    echo "<script>alert('Laporan berhasil diperbarui.'); window.location='/views/lihat_laporan_user.php';</script>";
} else {
    echo "Error: " . $update_stmt->error;
}

$update_stmt->close();
$conn->close();


// === Fungsi uploadFile tetap sama ===
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
