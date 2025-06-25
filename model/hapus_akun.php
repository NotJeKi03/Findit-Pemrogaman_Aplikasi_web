<?php
session_start();
include 'DB_Connection.php';

// Pastikan user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: /login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Ambil semua foto yang terkait dengan user
$sql_select = "SELECT foto1, foto2, foto3 FROM daftar_barang WHERE user_id = ?";
$stmt_select = $conn->prepare($sql_select);
$stmt_select->bind_param("i", $user_id);
$stmt_select->execute();
$result = $stmt_select->get_result();

$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';

// Hapus file-file foto dari server
while ($row = $result->fetch_assoc()) {
    foreach (['foto1', 'foto2', 'foto3'] as $foto) {
        if (!empty($row[$foto])) {
            $file_path = $upload_dir . basename($row[$foto]);
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
    }
}
$stmt_select->close();

// Hapus laporan yang dibuat user
$sql_delete_laporan = "DELETE FROM daftar_barang WHERE user_id = ?";
$stmt_delete_laporan = $conn->prepare($sql_delete_laporan);
$stmt_delete_laporan->bind_param("i", $user_id);
$stmt_delete_laporan->execute();
$stmt_delete_laporan->close();

// Hapus akun user
$sql_delete_account = "DELETE FROM account WHERE id = ?";
$stmt_delete_account = $conn->prepare($sql_delete_account);
$stmt_delete_account->bind_param("i", $user_id);
$stmt_delete_account->execute();
$stmt_delete_account->close();

// Hapus sesi dan redirect
session_unset();
session_destroy();

echo "<script>alert('Akun dan semua data berhasil dihapus.'); window.location.href = '/login.php';</script>";
exit();
?>
