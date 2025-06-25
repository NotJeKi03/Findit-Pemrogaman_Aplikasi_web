<?php

session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: /login.php"); // not logged in
  exit();
}

include '../model/DB_Connection.php';

// Tangkap nilai dari GET jika ada, atau beri nilai default kosong
$kata_kunci = isset($_GET['kata_kunci']) ? $_GET['kata_kunci'] : '';
$filter = isset($_GET['filter']) ? $_GET['filter'] : '';

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $query = "SELECT * FROM daftar_barang WHERE id = $id";
  $result = mysqli_query($conn, $query);

  if ($result && mysqli_num_rows($result) == 1) {
    $data = mysqli_fetch_assoc($result);
  } else {
    echo "Data tidak ditemukan.";
    exit;
  }
} else {
  echo "ID tidak diberikan.";
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FindIt - Detail Barang</title>
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

<body class="bg-gray-50">

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


    <!-- Body -->
   <!-- Main Content -->
  <main class="mt-28 mb-10 px-4 flex-grow flex justify-center">
    <div class="w-full max-w-6xl bg-white shadow-lg rounded-lg p-8 flex flex-col md:flex-row gap-10">

      <!-- Gambar dan Thumbnail -->
      <div class="flex flex-col md:flex-row gap-6 w-full md:w-1/2">
        <!-- Thumbnails -->
        <div class="flex md:flex-col gap-3">
          <?php if (!empty($data['foto1'])): ?>
            <img src="<?= htmlspecialchars($data['foto1']) ?>" alt="Thumb 1"
              class="w-16 h-16 border rounded object-cover cursor-pointer" onclick="changeImage(this.src)" />
          <?php endif; ?>
          <?php if (!empty($data['foto2'])): ?>
            <img src="<?= htmlspecialchars($data['foto2']) ?>" alt="Thumb 2"
              class="w-16 h-16 border rounded object-cover cursor-pointer" onclick="changeImage(this.src)" />
          <?php endif; ?>
          <?php if (!empty($data['foto3'])): ?>
            <img src="<?= htmlspecialchars($data['foto3']) ?>" alt="Thumb 3"
              class="w-16 h-16 border rounded object-cover cursor-pointer" onclick="changeImage(this.src)" />
          <?php endif; ?>
        </div>

        <!-- Gambar Utama -->
        <div class="flex-grow">
          <img id="mainImage" src="<?= $data['foto1'] ? htmlspecialchars($data['foto1']) : '/uploads/default.jpg' ?>"
            alt="<?= htmlspecialchars($data['nama_barang']) ?>"
            class="w-full max-h-[500px] object-contain rounded shadow border" />
        </div>
      </div>

      <!-- Detail Informasi -->
      <div class="flex-1 space-y-4">
        <h2 class="text-3xl font-bold text-gray-800"><?= htmlspecialchars($data['nama_barang']) ?></h2>
        <h3 class="text-xl text-gray-600">
          [<?= ucfirst($data['jenis_laporan']) ?>] - Lokasi: <?= htmlspecialchars($data['lokasi_kejadian']) ?>
        </h3>
        <p class="text-gray-700 whitespace-pre-line"><?= htmlspecialchars($data['deskripsi_barang']) ?></p>

        <!-- Tombol WhatsApp -->
        <a href="https://wa.me/<?= htmlspecialchars($data['nomor_penghubung']) ?>" target="_blank"
          class="inline-flex items-center px-6 py-3 bg-green-500 hover:bg-green-600 text-white rounded transition">
          <i data-feather="message-circle" class="w-5 h-5 mr-2"></i>
          Hubungi via WhatsApp
        </a>
      </div>

    </div>
  </main>



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