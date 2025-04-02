<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FindIt - Buat Laporan Baru</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
    }
    .container-custom {
      width: 60%;
      margin: auto;
      background: white;
      padding: 20px;
      box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
      border-radius: 10px;
      margin-top: 20px;
    }
    .header {
      text-align: center;
      padding: 10px;
    }
    .header img {
      height: 60px;
    }
    .form-group {
      margin-bottom: 15px;
    }
    label {
      font-weight: bold;
    }
    input, textarea, button {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    input[type="text"][name="nomor_penghubung"] {
      /* Pattern to start with +62 or 62 and contain 8-15 digits */
      pattern: "\+?62[0-9]{8,15}";
      title: "Nomor harus dimulai dengan +62 atau 62 dan mengandung 8-15 angka.";
    }
    .toggle-container {
      display: flex;
      gap: 10px;
    }
    .toggle-btn {
      flex: 1;
      background-color: #ddd;
      border: none;
      padding: 10px;
      cursor: pointer;
      border-radius: 5px;
    }
    .toggle-btn.active {
      background-color: #007bff;
      color: white;
    }
    .upload-container {
      display: flex;
      gap: 10px;
      margin-top: 10px;
    }
    .upload-box {
      width: 100px;
      height: 100px;
      border: 2px dashed #ccc;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      border-radius: 5px;
      overflow: hidden;
      position: relative;
    }
    .upload-box img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: none;
    }
    .upload-box span {
      position: absolute;
      font-size: 2rem;
      color: #ccc;
    }
    .submit-btn {
      background-color: #007bff;
      color: white;
      border: none;
      padding: 10px;
      cursor: pointer;
      border-radius: 5px;
    }
    .footer {
      background-color: #007bff;
      color: white;
      text-align: center;
      padding: 10px;
      margin-top: 20px;
      border-radius: 0 0 10px 10px;
    }
  </style>
</head>
<body class="bg-light">
  <div class="container py-5">
    <header class="d-flex justify-content-between align-items-center mb-4">
      <div class="header">
        <img src="FindIt.png" alt="FindIt Logo">
      </div>
      <!-- Optional user icon -->
      <i class="bi bi-person-circle fs-2"></i>
    </header>
    <div class="card shadow p-4">
      <h2 class="mb-4 text-center">Buat Laporan Baru</h2>
      <form id="reportForm" action="model/report_process.php" method="post" enctype="multipart/form-data">
        <div class="form-group mb-3">
          <label>Jenis Laporan:</label>
          <div class="toggle-container">
            <button type="button" class="toggle-btn active" onclick="setType('Hilang', this)">Barang Hilang</button>
            <button type="button" class="toggle-btn" onclick="setType('Ditemukan', this)">Barang Ditemukan</button>
          </div>
          <input type="hidden" id="jenis_laporan" name="jenis_laporan" value="Hilang">
        </div>
        <div class="form-group mb-3">
          <label>Nama Barang:</label>
          <input type="text" name="nama_barang" required placeholder="Masukkan nama barang">
        </div>
        <div class="form-group mb-3">
          <label>Nomor Penghubung:</label>
          <input type="text" name="nomor_penghubung" required placeholder="Masukkan nomor HP (contoh: +6281234567890)" >
        </div>
        <div class="form-group mb-3">
          <label>Lokasi Kejadian:</label>
          <input type="text" name="lokasi_kejadian" required placeholder="Masukkan lokasi kejadian">
        </div>
        <div class="form-group mb-3">
          <label>Deskripsi Barang:</label>
          <textarea name="deskripsi_barang" required placeholder="Jelaskan tentang barang..."></textarea>
        </div>
        <div class="form-group mb-3">
          <label>Upload Foto:</label>
          <div class="upload-container">
            <div class="upload-box" onclick="uploadImage(this, 0)">
              <img src="" alt="Preview">
              <span>+</span>
            </div>
            <div class="upload-box" onclick="uploadImage(this, 1)">
              <img src="" alt="Preview">
              <span>+</span>
            </div>
            <div class="upload-box" onclick="uploadImage(this, 2)">
              <img src="" alt="Preview">
              <span>+</span>
            </div>
          </div>
          <!-- Hidden file inputs for individual photos -->
          <input type="file" name="foto1" id="foto1" hidden>
          <input type="file" name="foto2" id="foto2" hidden>
          <input type="file" name="foto3" id="foto3" hidden>
        </div>
        <button type="submit" class="btn btn-primary submit-btn">Submit</button>
      </form>
    </div>
  </div>
  <footer class="text-center mt-4">
  <footer class="footer">© 2024 All rights reserved. FindIt.</footer>
  </footer>
  
  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function setType(type, element) {
      document.getElementById('jenis_laporan').value = type;
      document.querySelectorAll('.toggle-btn').forEach(btn => btn.classList.remove('active'));
      element.classList.add('active');
    }

    // Modified uploadImage to target a specific hidden file input based on index
    function uploadImage(box, index) {
      const fileInputIds = ['foto1', 'foto2', 'foto3'];
      const input = document.getElementById(fileInputIds[index]);
      input.click();
      input.onchange = function() {
        const file = input.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = function(e) {
            const img = box.querySelector('img');
            img.src = e.target.result;
            img.style.display = 'block';
            box.querySelector('span').style.display = 'none';
          }
          reader.readAsDataURL(file);
        }
      }
    }
  </script>
</body>
</html>