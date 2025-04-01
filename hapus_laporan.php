<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM laporan_barang WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Laporan berhasil dihapus.";
    } else {
        echo "Error: " . $conn->error;
    }
}

header("Location: lihat_laporan.php");
exit();
?>
