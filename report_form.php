<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FindIT - Buat Laporan Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <header class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-primary">FindIT</h1>
            <i class="bi bi-person-circle fs-2"></i>
        </header>

        <div class="card shadow p-4">
            <h2 class="mb-4">Buat Laporan Baru</h2>
        
            <form action="model/report_process.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label>Jenis Laporan</label><br>
                <input type="radio" name="jenis_laporan" value="Barang Hilang" required> Barang Hilang
                <input type="radio" name="jenis_laporan" value="Barang Ditemukan"> Barang Ditemukan
            </div>

            <div class="mb-3">
                <label>Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Nomor Penghubung</label>
                <input type="text" name="nomor_penghubung" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Deskripsi Barang</label>
                <textarea name="deskripsi_barang" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label>Foto 1</label>
                <input type="file" name="foto1" class="form-control">
            </div>

            <div class="mb-3">
                <label>Foto 2</label>
                <input type="file" name="foto2" class="form-control">
            </div>

            <div class="mb-3">
                <label>Foto 3</label>
                <input type="file" name="foto3" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <footer class="text-center mt-4">
        &copy; 2024 All rights reserved. FindIT.
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

