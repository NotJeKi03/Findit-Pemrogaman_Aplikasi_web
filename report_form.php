<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FindIt - Buat Laporan Baru</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <script src="https://unpkg.com/feather-icons"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            "findit-blue": "#008ECC",
          },
          fontFamily: {
            poppins: ["Poppins", "sans-serif"],
          },
        },
      },
    };
  </script>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      padding-top: 80px; /* Space for fixed header */
    }
    .upload-box {
      width: 100px;
      height: 100px;
      border: 2px dashed #ccc;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      border-radius: 8px;
      overflow: hidden;
      position: relative;
      transition: all 0.3s ease;
    }
    .upload-box:hover {
      border-color: #008ECC;
      background-color: #f0f9ff;
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
    .toggle-btn {
      flex: 1;
      background-color: #e5e7eb;
      border: none;
      padding: 12px 20px;
      cursor: pointer;
      border-radius: 8px;
      font-weight: 500;
      transition: all 0.3s ease;
      color: #374151;
    }
    .toggle-btn:hover {
      background-color: #d1d5db;
    }
    .toggle-btn.active {
      background-color: #008ECC;
      color: white;
    }
    input[type="text"][name="nomor_penghubung"] {
      pattern: "\+?62[0-9]{8,15}";
      title: "Nomor harus dimulai dengan +62 atau 62 dan mengandung 8-15 angka.";
    }
  </style>
</head>
<body class="bg-gray-50 font-poppins">
  <!-- Header -->
  <header class="bg-white shadow-sm p-3 flex items-center justify-between fixed top-0 left-0 right-0 z-50">
    <!-- Logo aligned to the left -->
    <img src="logo.png" alt="Logo FindIt" class="w-32 h-auto" />
    
    <!-- Navigation Menu in the Center -->
    <nav class="flex-grow flex justify-center">
      <ul class="flex space-x-6">
        <li>
          <a href="caripage.html" id="beranda-link" class="text-black font-medium px-3 py-2 rounded hover:text-findit-blue" onclick="disableButton('beranda-link')">Beranda</a>
        </li>
        <li>
          <a href="tentang.html" id="tentang-link" class="text-black font-medium px-3 py-2 rounded hover:text-findit-blue" onclick="disableButton('tentang-link')">Tentang</a>
        </li>
        <li>
          <a href="kontak.html" id="kontak-link" class="text-black font-medium px-3 py-2 rounded hover:text-findit-blue" onclick="disableButton('kontak-link')">Kontak</a>
        </li>
      </ul>
    </nav>
    
    <!-- Notification and Account Icons aligned to the right -->
    <div class="flex items-center space-x-4">
      <a href="notifikasi.html" id="Notif button" class="text-gray-600 hover:text-findit-blue">
        <i data-feather="bell"></i>
      </a>
      <a href="profil.html" id="Akun button" class="text-gray-600 hover:text-findit-blue">
        <i data-feather="user"></i>
      </a>
    </div>
  </header>

  <!-- Main Content -->
  <div class="max-w-4xl mx-auto px-6 py-8">
    <div class="bg-white rounded-lg shadow-md p-8">
      <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">Buat Laporan Baru</h1>
      
      <form id="reportForm" action="report_process.php" method="post" enctype="multipart/form-data" class="space-y-6">
        <!-- Jenis Laporan -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-3">Jenis Laporan</label>
          <div class="flex gap-4">
            <button type="button" class="toggle-btn active" onclick="setType('Hilang', this)">Barang Hilang</button>
            <button type="button" class="toggle-btn" onclick="setType('Ditemukan', this)">Barang Ditemukan</button>
          </div>
          <input type="hidden" id="jenis_laporan" name="jenis_laporan" value="Hilang">
        </div>

        <!-- Nama Barang -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Barang</label>
          <input type="text" name="nama_barang" required placeholder="Masukkan nama barang" 
                 class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-findit-blue focus:border-transparent outline-none transition-all">
        </div>

        <!-- Nomor Penghubung -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Penghubung</label>
          <input type="text" name="nomor_penghubung" required placeholder="Masukkan nomor HP (contoh: +6281234567890)"
                 class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-findit-blue focus:border-transparent outline-none transition-all">
        </div>

        <!-- Lokasi Kejadian -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-2">Lokasi Kejadian</label>
          <input type="text" name="lokasi_kejadian" required placeholder="Masukkan lokasi kejadian"
                 class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-findit-blue focus:border-transparent outline-none transition-all">
        </div>

        <!-- Deskripsi Barang -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Barang</label>
          <textarea name="deskripsi_barang" required placeholder="Jelaskan tentang barang..." rows="4"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-findit-blue focus:border-transparent outline-none transition-all resize-none"></textarea>
        </div>

        <!-- Upload Foto -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-3">Upload Foto</label>
          <div class="flex gap-4 mb-4">
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
          
          <!-- File input fields for individual uploads -->
          <div class="space-y-2">
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
              <span class="text-sm text-gray-600">Nama File</span>
              <button type="button" class="text-findit-blue text-sm font-medium hover:underline" onclick="document.getElementById('foto1').click()">Unggah</button>
            </div>
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
              <span class="text-sm text-gray-600">Nama File</span>
              <button type="button" class="text-findit-blue text-sm font-medium hover:underline" onclick="document.getElementById('foto2').click()">Unggah</button>
            </div>
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
              <span class="text-sm text-gray-600">Nama File</span>
              <button type="button" class="text-findit-blue text-sm font-medium hover:underline" onclick="document.getElementById('foto3').click()">Unggah</button>
            </div>
          </div>

          <!-- Hidden file inputs -->
          <input type="file" name="foto1" id="foto1" hidden accept="image/*">
          <input type="file" name="foto2" id="foto2" hidden accept="image/*">
          <input type="file" name="foto3" id="foto3" hidden accept="image/*">
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
          <button type="submit" class="bg-findit-blue text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-600 transition-colors duration-300 shadow-lg hover:shadow-xl">
            Simpan / Post
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-findit-blue text-white py-12">
    <div class="max-w-6xl mx-auto px-6">
      <div class="grid md:grid-cols-3 gap-8">
        <!-- Company Info -->
        <div>
          <div class="footer-logo flex items-center mb-6">
            <h2 class="text-3xl font-bold text-white">FindIt</h2>
          </div>

          <div class="space-y-3 mb-6 text-center md:text-left">
            <h4 class="font-semibold mb-4">Kontak Kami</h4>
            <div class="flex items-center space-x-3">
              <i data-feather="message-circle" class="w-4 h-4"></i>
              <div>
                <p class="text-sm">WhatsApp</p>
                <p class="text-sm">+1 202-918-2132</p>
              </div>
            </div>
            <div class="flex items-center space-x-3">
              <i data-feather="phone" class="w-4 h-4"></i>
              <div>
                <p class="text-sm">Call Us</p>
                <p class="text-sm">+1 202-918-2132</p>
              </div>
            </div>
          </div>

          <div class="mt-6">
            <h4 class="font-semibold mb-4">Download App</h4>
            <div class="app-download flex space-x-3 justify-center md:justify-start">
              <a href="#" class="flex items-center space-x-2">
                <img src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg" alt="App Store" class="h-10 cursor-pointer hover:opacity-80 transition-opacity" />
              </a>
              <a href="#" class="flex items-center space-x-2">
                <img src="https://play.google.com/intl/en_us/badges/static/images/badges/en_badge_web_generic.png" alt="Google Play" class="h-10 cursor-pointer hover:opacity-80 transition-opacity" />
              </a>
            </div>
          </div>
        </div>

        <!-- Customer Service -->
        <div>
          <h4 class="font-semibold mb-6">Layanan Pelanggan</h4>
          <ul class="space-y-3">
            <li><a href="tentang.html" class="text-sm hover:opacity-80 transition-opacity">Tentang Kami</a></li>
            <li><a href="#" class="text-sm hover:opacity-80 transition-opacity">Syarat & Ketentuan</a></li>
            <li><a href="#" class="text-sm hover:opacity-80 transition-opacity">Kebijakan Privasi</a></li>
            <li><a href="#" class="text-sm hover:opacity-80 transition-opacity">Pusat Bantuan</a></li>
            <li><a href="#" class="text-sm hover:opacity-80 transition-opacity">Pertanyaan Umum</a></li>
          </ul>
        </div>

        <!-- Popular Categories -->
        <div>
          <h4 class="font-semibold mb-6">Kategori Terpopuler</h4>
          <ul class="space-y-3">
            <li><a href="#" class="text-sm hover:opacity-80 transition-opacity">Cari Barang Hilang</a></li>
            <li><a href="#" class="text-sm hover:opacity-80 transition-opacity">Laporkan Temuan</a></li>
          </ul>
        </div>
      </div>

      <!-- Footer Divider -->
      <div class="footer-divider border-t border-white border-opacity-20 mt-8 pt-6 text-center">
        <p class="text-sm opacity-80">© 2025 FindIt. Hak cipta dilindungi undang-undang.</p>
      </div>
    </div>
  </footer>

  <script>
    // Initialize Feather Icons
    feather.replace();

    function disableButton(linkId) {
      // Add any button disable logic here if needed
      console.log('Button clicked:', linkId);
    }

    function setType(type, element) {
      document.getElementById('jenis_laporan').value = type;
      document.querySelectorAll('.toggle-btn').forEach(btn => btn.classList.remove('active'));
      element.classList.add('active');
    }

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
            
            // Update file name in the corresponding row
            const fileRows = document.querySelectorAll('.bg-gray-50');
            if (fileRows[index]) {
              fileRows[index].querySelector('span').textContent = file.name;
            }
          }
          reader.readAsDataURL(file);
        }
      }
    }
  </script>
</body>
</html>
