<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: /login.php");
  exit();
}

require '../model/DB_Connection.php'; // sesuaikan path file koneksi database

// Ambil ID laporan dari parameter
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Ambil data laporan
$stmt = $conn->prepare("SELECT * FROM daftar_barang WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$laporan = $result->fetch_assoc();

if (!$laporan) {
  echo "Laporan tidak ditemukan.";
  exit();
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Edit Laporan - Edit Laporan</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link href="https://fonts.googleapis.com/css2?family=Baloo+2&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/feather-icons"></script>
  <script type="text/javascript" src="https://livejs.com/live.js"></script>
  <style type="text/tailwindcss">

    h1{
                @apply md:text-base lg:text-lg xl:text-xl
            }
            p{
                @apply md:text-sm lg:text-base xl:text-lg
            }
            .hero img {
      max-height: 300px;
      object-fit: cover;
    }

    .search-input {
      background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-opacity="0.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>') no-repeat scroll 7px 7px;
      padding-left: 40px;
    }

    .container h3 {
      font-size: 1.5rem;
      line-height: 2rem;
      color: rgb(55, 122, 184);
    }
        </style>
</head>

<body class="bg-gray-100">
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
                    <a href="akun.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Akun
                        Saya</a>
                    <a href="buat_laporan.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Buat Laporan</a>
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


  <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Edit Laporan</h2>

    <form action="/model/update_laporan.php" method="POST" enctype="multipart/form-data" class="space-y-4">
      <input type="hidden" name="id" value="<?= $laporan['id'] ?>">

      <!-- Jenis Laporan -->
      <div>
        <label class="block mb-1 font-semibold">Jenis Laporan</label>
        <select name="jenis_laporan" required class="w-full border border-gray-300 rounded px-3 py-2">
          <option value="Hilang" <?= $laporan['jenis_laporan'] === 'Hilang' ? 'selected' : '' ?>>Barang Hilang</option>
          <option value="Ditemukan" <?= $laporan['jenis_laporan'] === 'Ditemukan' ? 'selected' : '' ?>>Barang Ditemukan
          </option>
        </select>
      </div>

      <!-- Nama Barang -->
      <div>
        <label class="block mb-1 font-semibold">Nama Barang</label>
        <input type="text" name="nama_barang" required value="<?= htmlspecialchars($laporan['nama_barang']) ?>"
          class="w-full border border-gray-300 rounded px-3 py-2" />
      </div>

      <!-- Nomor Penghubung -->
      <div>
        <label class="block mb-1 font-semibold">Nomor Penghubung</label>
        <input type="text" name="nomor_penghubung" required
          value="<?= htmlspecialchars($laporan['nomor_penghubung']) ?>"
          class="w-full border border-gray-300 rounded px-3 py-2" />
      </div>

      <!-- Lokasi Kejadian -->
      <div>
        <label class="block mb-1 font-semibold">Lokasi Kejadian</label>
        <input type="text" name="lokasi_kejadian" required value="<?= htmlspecialchars($laporan['lokasi_kejadian']) ?>"
          class="w-full border border-gray-300 rounded px-3 py-2" />
      </div>

      <!-- Deskripsi -->
      <div>
        <label class="block mb-1 font-semibold">Deskripsi Barang</label>
        <textarea name="deskripsi_barang" rows="4" required
          class="w-full border border-gray-300 rounded px-3 py-2"><?= htmlspecialchars($laporan['deskripsi_barang']) ?></textarea>
      </div>

      <!-- Foto -->
      <div>
        <label class="block font-semibold mb-2">Upload Ulang Foto (opsional)</label>
        <div class="flex gap-4 mb-2">
          <?php for ($i = 1; $i <= 3; $i++): ?>
            <div class="w-24 h-24 bg-gray-200 rounded overflow-hidden">
              <?php if ($laporan["foto$i"]): ?>
                <img src="<?= $laporan["foto$i"] ?>" alt="Foto <?= $i ?>" class="w-full h-full object-cover">
              <?php else: ?>
                <span class="flex items-center justify-center h-full text-gray-400">Tidak Ada</span>
              <?php endif; ?>
            </div>
          <?php endfor; ?>
        </div>
        <input type="file" name="foto1">
        <input type="file" name="foto2">
        <input type="file" name="foto3">
      </div>

      <!-- Submit -->
      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update Laporan</button>
    </form>
  </div>
  <!-- Footer -->
  <footer class="bg-sky-500 text-white py-12 w-full mt-6">
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
              <a href="/index.php" class="hover:underline">Tentang Kami</a>
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

    function toggleDropdown() {
      const menu = document.getElementById('dropdownMenu');
      menu.classList.toggle('hidden');
    }

    // Menutup dropdown jika klik di luar
    window.addEventListener('click', function (e) {
      const profileBtn = document.getElementById('profileBtn');
      const dropdownMenu = document.getElementById('dropdownMenu');

      if (!profileBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
        dropdownMenu.classList.add('hidden');
      }
    });

    function toggleFilterMenu() {
      const menu = document.getElementById("filterMenu");
      menu.classList.toggle("hidden");
    }

    function setFilter(value) {
      document.getElementById("filterInput").value = value;
      document.getElementById("filterMenu").classList.add("hidden");
    }

    function changeImage(src) {
      document.getElementById('mainImage').src = src;
    }
  </script>
</body>

</html>