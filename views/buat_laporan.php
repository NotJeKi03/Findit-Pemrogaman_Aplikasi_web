<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: /login.php"); // not logged in
  exit();
}

// Tangkap nilai dari GET jika ada, atau beri nilai default kosong
$kata_kunci = isset($_GET['kata_kunci']) ? $_GET['kata_kunci'] : '';
$filter = isset($_GET['filter']) ? $_GET['filter'] : '';
?>

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FindIt - Cari Barang</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>
    <style type="text/tailwindcss">
        h1 { @apply md:text-base lg:text-lg xl:text-xl; }
        p { @apply md:text-sm lg:text-base xl:text-lg; }

        .search-input {
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-opacity="0.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>') no-repeat scroll 7px 7px;
            padding-left: 40px;
        }
    </style>
</head>

<body class="bg-gray-100 font-sans">

    <!-- Header -->
    <header class="bg-white p-4 mb-5 border-b-2 border-gray-200">
        <div class="container mx-auto flex flex-wrap md:flex-nowrap justify-between items-center gap-4">
            <div class="flex items-center space-x-2">
                <a href="/views/caripage.php" class="text-2xl font-bold text-sky-600 hidden md:inline">
                    FindIt
                </a>
            </div>

            <!-- Search Bar -->
            <form action="/views/cari_laporan.php" method="GET" class="flex items-center flex-grow space-x-2">
                <div class="relative w-full">
                    <input type="text" name="kata_kunci" value="<?= htmlspecialchars($kata_kunci) ?>" required
                        placeholder="Cari barang hilang atau ditemukan..."
                        class="w-full border border-gray-300 rounded-full py-2 px-4 pl-10 focus:outline-none focus:ring-2 focus:ring-sky-500" />
                    <i data-feather="search" class="absolute left-3 top-2.5 text-gray-400 w-5 h-5"></i>
                </div>

                <input type="hidden" name="filter" id="filterInput" value="<?= htmlspecialchars($filter) ?>">

                <button type="button" onclick="toggleFilterMenu()"
                    class="p-2 rounded-full hover:bg-gray-100 transition">
                    <i data-feather="filter" class="w-5 h-5 text-gray-700"></i>
                </button>

                <button type="submit"
                    class="bg-sky-500 text-white px-4 py-2 rounded-full hover:bg-sky-600 transition font-semibold">
                    Cari
                </button>
            </form>

            <!-- Akun -->
            <div class="relative group">
                <button class="p-2 rounded-full hover:bg-gray-100 transition">
                    <i data-feather="user" class="w-6 h-6 text-gray-700"></i>
                </button>
                <div
                    class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-150 z-50">
                    <a href="/views/akun.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Akun
                        Saya</a>
                    <a href="/model/logout.php"
                        class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Logout</a>
                </div>
            </div>
        </div>

        <!-- Filter Menu -->
        <div id="filterMenu" class="hidden mt-2 px-4">
            <div
                class="bg-white border border-gray-200 rounded shadow p-3 max-w-xs mx-auto flex justify-around text-sm text-gray-700 font-medium">
                <button type="button" onclick="setFilter('')" class="hover:text-sky-600">Semua</button>
                <button type="button" onclick="setFilter('hilang')" class="hover:text-sky-600">Hilang</button>
                <button type="button" onclick="setFilter('ditemukan')" class="hover:text-sky-600">Ditemukan</button>
            </div>
        </div>
    </header>

    <div class="bg-white rounded-lg shadow-lg p-8 mx-5 md:mx-50 my-30">
      <h2 class="text-3xl font-semibold mb-8 text-center">Buat Laporan Baru</h2>

      <form id="reportForm" action="/model/report_process.php" method="post" enctype="multipart/form-data" class="space-y-6">
        <!-- Jenis Laporan -->
        <div>
          <label class="block font-semibold mb-2">Jenis Laporan:</label>
          <div class="flex gap-4">
            <button type="button" class="toggle-btn flex-1 py-2 rounded bg-sky-600 text-white" onclick="setType('Hilang', this)">Barang Hilang</button>
            <button type="button" class="toggle-btn flex-1 py-2 rounded bg-gray-300 text-gray-700" onclick="setType('Ditemukan', this)">Barang Ditemukan</button>
          </div>
          <input type="hidden" id="jenis_laporan" name="jenis_laporan" value="Hilang" />
        </div>

        <!-- Nama Barang -->
        <div>
          <label for="nama_barang" class="block font-semibold mb-2">Nama Barang:</label>
          <input
            id="nama_barang"
            type="text"
            name="nama_barang"
            required
            placeholder="Masukkan nama barang"
            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-500"
          />
        </div>

        <!-- Nomor Penghubung -->
        <div>
          <label for="nomor_penghubung" class="block font-semibold mb-2">Nomor Penghubung:</label>
          <input
            id="nomor_penghubung"
            type="text"
            name="nomor_penghubung"
            required
            placeholder="Masukkan nomor HP (contoh: +6281234567890)"
            pattern="^\+?62[0-9]{8,15}$"
            title="Nomor harus dimulai dengan +62 atau 62 dan mengandung 8-15 angka."
            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-500"
          />
        </div>

        <!-- Lokasi Kejadian -->
        <div>
          <label for="lokasi_kejadian" class="block font-semibold mb-2">Lokasi Kejadian:</label>
          <input
            id="lokasi_kejadian"
            type="text"
            name="lokasi_kejadian"
            required
            placeholder="Masukkan lokasi kejadian"
            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-500"
          />
        </div>

        <!-- Deskripsi Barang -->
        <div>
          <label for="deskripsi_barang" class="block font-semibold mb-2">Deskripsi Barang:</label>
          <textarea
            id="deskripsi_barang"
            name="deskripsi_barang"
            required
            placeholder="Jelaskan tentang barang..."
            rows="4"
            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-500 resize-none"
          ></textarea>
        </div>

        <!-- Upload Foto -->
        <div>
          <label class="block font-semibold mb-2">Upload Foto:</label>
          <div class="flex gap-4">
            <div
              class="upload-box w-24 h-24 border-2 border-dashed border-gray-300 rounded-md flex items-center justify-center cursor-pointer relative overflow-hidden"
              onclick="uploadImage(this, 0)"
            >
              <img src="" alt="Preview" class="w-full h-full object-cover hidden" />
              <span class="absolute text-4xl text-gray-300 select-none">+</span>
            </div>
            <div
              class="upload-box w-24 h-24 border-2 border-dashed border-gray-300 rounded-md flex items-center justify-center cursor-pointer relative overflow-hidden"
              onclick="uploadImage(this, 1)"
            >
              <img src="" alt="Preview" class="w-full h-full object-cover hidden" />
              <span class="absolute text-4xl text-gray-300 select-none">+</span>
            </div>
            <div
              class="upload-box w-24 h-24 border-2 border-dashed border-gray-300 rounded-md flex items-center justify-center cursor-pointer relative overflow-hidden"
              onclick="uploadImage(this, 2)"
            >
              <img src="" alt="Preview" class="w-full h-full object-cover hidden" />
              <span class="absolute text-4xl text-gray-300 select-none">+</span>
            </div>
          </div>
          <input type="file" name="foto1" id="foto1" hidden />
          <input type="file" name="foto2" id="foto2" hidden />
          <input type="file" name="foto3" id="foto3" hidden />
        </div>

        <!-- Submit -->
        <button
          type="submit"
          class="w-full py-3 bg-sky-600 hover:bg-sky-700 text-white font-semibold rounded-md transition-colors"
        >
          Submit
        </button>
      </form>
    </div>


    <!-- Footer -->
    <footer class="bg-sky-500 text-white py-12 w-full">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid md:grid-cols-3 gap-8">
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
                                <img src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg"
                                    alt="App Store" 
                                    class="h-14 object-contain aspect-[3/1] cursor-pointer hover:opacity-80 transition-opacity" />
                            </a>
                            <a href="#" class="flex items-center space-x-2">
                                <img src="https://play.google.com/intl/en_us/badges/static/images/badges/en_badge_web_generic.png"
                                    alt="Google Play"
                                    class="h-18 object-contain aspect-[3/1] cursor-pointer hover:opacity-80 transition-opacity" />
                            </a>
                        </div>
                    </div>
                </div>
                <div>
                    <h4 class="font-semibold mb-6">Layanan Pelanggan</h4>
                    <ul class="space-y-3 text-sm">
                        <li>
                            <a href="tentang.html" class="hover:underline">Tentang Kami</a>
                        </li>
                        <li>
                            <a href="#" class="hover:underline">Syarat & Ketentuan</a>
                        </li>
                        <li><a href="#" class="hover:underline">Kebijakan Privasi</a></li>
                        <li><a href="#" class="hover:underline">Pusat Bantuan</a></li>
                        <li><a href="#" class="hover:underline">Pertanyaan Umum</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-6">Kategori Terpopuler</h4>
                    <ul class="space-y-3 text-sm">
                        <li>
                            <a href="#" class="hover:underline">Cari Barang Hilang</a>
                        </li>
                        <li><a href="#" class="hover:underline">Laporkan Temuan</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-divider border-t border-white border-opacity-20 mt-8 pt-6 text-center">
                <p class="text-sm opacity-80">
                    © 2025 FindIt. Hak cipta dilindungi undang-undang.
                </p>
            </div>
        </div>
    </footer>

  <script>
    feather.replace();

    // Toggle button for jenis laporan
    function setType(type, element) {
      document.getElementById('jenis_laporan').value = type;
      document.querySelectorAll('.toggle-btn').forEach((btn) => {
        btn.classList.remove('bg-sky-600', 'text-white');
        btn.classList.add('bg-gray-300', 'text-gray-700');
      });
      element.classList.add('bg-sky-600', 'text-white');
      element.classList.remove('bg-gray-300', 'text-gray-700');
    }

    // Upload image preview logic
    function uploadImage(box, index) {
      const fileInputIds = ['foto1', 'foto2', 'foto3'];
      const input = document.getElementById(fileInputIds[index]);
      input.click();
      input.onchange = function () {
        const file = input.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = function (e) {
            const img = box.querySelector('img');
            img.src = e.target.result;
            img.classList.remove('hidden');
            box.querySelector('span').classList.add('hidden');
          };
          reader.readAsDataURL(file);
        }
      };
    }
  </script>
</body>
</html>
