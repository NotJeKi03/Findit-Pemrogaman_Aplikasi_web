<?php
include 'config.php';

$sql = "SELECT * FROM laporan_barang ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Laporan Barang Hilang/Ditemukan</title>
</head>
<body>
    <h2>Daftar Laporan</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Jenis</th>
            <th>Nama Barang</th>
            <th>Nomor Penghubung</th>
            <th>Lokasi</th>
            <th>Deskripsi</th>
            <th>Foto</th>
            <th>Tanggal</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row["id"]; ?></td>
            <td><?= $row["jenis_laporan"]; ?></td>
            <td><?= $row["nama_barang"]; ?></td>
            <td><?= $row["nomor_penghubung"]; ?></td>
            <td><?= $row["lokasi_kejadian"]; ?></td>
            <td><?= $row["deskripsi_barang"]; ?></td>
            <td>
                <?php if ($row["foto"]) { ?>
                    <img src="<?= $row["foto"]; ?>" width="100">
                <?php } else { echo "Tidak ada foto"; } ?>
            </td>
            <td><?= $row["created_at"]; ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
