<?php
include '../model/DB_Connection.php';

$sql = "SELECT * FROM daftar_barang ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Laporan Barang Hilang/Ditemukan</title>
    <!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- DataTables Bootstrap 5 CSS -->
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- DataTables Bootstrap 5 JS -->
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

</head>
<body class="flex flex-col min-h-screen bg-gray-100">
    <header
      class="bg-white shadow-md border-b p-5 flex items-center justify-between fixed top-0 left-0 right-0 z-10"
    >
      <img src="logo.png" alt="Logo FindIt" class="w-40 h-auto" />
      <a href="#" class="mr-8">
        <i data-feather="user" class="text-gray-700 w-12 h-12"></i>
      </a>
    </header>
    
    <h2 class="mb-4">Daftar Laporan</h2>
    <div class="table-responsive">
        <table id="laporanTable" class="table table-striped table-bordered table-hover" style="width:100%">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Jenis</th>
                    <th>Nama Barang</th>
                    <th>Nomor Penghubung</th>
                    <th>Deskripsi</th>
                    <th>Foto</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= htmlspecialchars($row["id"]); ?></td>
                    <td><?= htmlspecialchars($row["jenis_laporan"]); ?></td>
                    <td><?= htmlspecialchars($row["nama_barang"]); ?></td>
                    <td><?= htmlspecialchars($row["nomor_penghubung"]); ?></td>
                    <td><?= nl2br(htmlspecialchars($row["deskripsi_barang"])); ?></td>
                    <td>
                        <?php if ($row["foto1"] || $row["foto2"] || $row["foto3"]) { ?>
                            <?php if ($row["foto1"]) { ?>
                                <img src="http://localhost:8000<?= htmlspecialchars($row["foto1"]); ?>" width="100" class="mb-1"><br>
                            <?php } ?>
                            <?php if ($row["foto2"]) { ?>
                                <img src="http://localhost:8000<?= htmlspecialchars($row["foto2"]); ?>" width="100" class="mb-1"><br>
                            <?php } ?>
                            <?php if ($row["foto3"]) { ?>
                                <img src="http://localhost:8000<?= htmlspecialchars($row["foto3"]); ?>" width="100" class="mb-1"><br>
                            <?php } ?>
                        <?php } else { echo "Tidak ada foto"; } ?>
                    </td>
                    <td><?= htmlspecialchars($row["created_at"]); ?></td>
                    <td>
                        <a href="/model/hapus_laporan.php?id=<?= urlencode($row['id']); ?>" onclick="return confirm('Yakin ingin menghapus laporan ini?');" style="color: red;">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            $('#laporanTable').DataTable({
                "pageLength": 5,
                "lengthMenu": [5, 10, 20],
                "language": {
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "paginate": {
                        "previous": "Sebelumnya",
                        "next": "Berikutnya"
                    }
                }
            });
        });
    </script>
</body>
</html>