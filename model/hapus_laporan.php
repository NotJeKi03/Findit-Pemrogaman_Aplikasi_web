<?php
include 'DB_Connection.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];  // casting ke int untuk keamanan
    $sql = "DELETE FROM daftar_barang WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "data berhasil dihapus";
    } else {
        // Optional: pesan error
    }
}

header("Location: /views/lihat_laporan_user.php");
exit();
?>
