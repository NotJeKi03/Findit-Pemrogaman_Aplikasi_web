<?php

session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: /login.php"); // not logged in
  exit();

  // Tangkap nilai dari GET jika ada, atau beri nilai default kosong
$kata_kunci = isset($_GET['kata_kunci']) ? $_GET['kata_kunci'] : '';
$filter = isset($_GET['filter']) ? $_GET['filter'] : '';
}

include '../model/DB_Connection.php';
$query_hilang = "SELECT * FROM daftar_barang WHERE jenis_laporan='hilang' ORDER BY created_at DESC";
$result_hilang = mysqli_query($conn, $query_hilang);

$query_ditemukan = "SELECT * FROM daftar_barang WHERE jenis_laporan='ditemukan' ORDER BY created_at DESC";
$result_ditemukan = mysqli_query($conn, $query_ditemukan);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FindIt - Halaman Utama</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>
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
    <div class='bg-gray-50 mx-auto'>
    <div class="hero flex justify-center p-2">
        <img src="/img/BN 1.png" alt="Banner pencari" class="w-full max-w-4xl" />
    </div>

    
    <div class="flex justify-center space-x-4 mt-6">
      <p class=" text-black py-3" style="font-size: 25px;">
        Menemukan / Kehilangan Barang?
      </p>
      <a href="/views/buat_laporan.php"
        class="font-bold px-6 py-3 bg-sky-500 text-white rounded-xl hover:bg-sky-700 transition">Buat Laporan</a>
    </div>
    </div>

    <div class="container mx-auto mt-4 mb-16">
        <section>
            <h3 class="text-[#008ecc] font-bold text-xl mb-4">Cari Barangmu</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <?php while ($row = mysqli_fetch_assoc($result_hilang)) {
                    $foto = $row['foto1'] ? $row['foto1'] : 'default.jpg';
                    ?>
                    <div class="card p-4 bg-white shadow rounded">
                        <a href="detail_barang.php?id=<?= $row['id'] ?>" class="block">
                            <img src="/uploads/<?= htmlspecialchars(basename($foto)) ?>"
                                class="w-full h-40 object-contain rounded" />
                            <div class="card-body mt-2">
                                <p class="font-semibold">[Hilang] <?= htmlspecialchars($row['nama_barang']) ?></p>
                                <p class="text-gray-500 truncate">Terakhir di
                                    <?= htmlspecialchars($row['lokasi_kejadian']) ?></p>

                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>

            <section class="mt-8">
                <h3 class="text-[#008ecc] font-bold text-xl mb-4">Laporan Barang Ditemukan</h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <?php while ($row = mysqli_fetch_assoc($result_ditemukan)) {
                        $foto = $row['foto1'] ? $row['foto1'] : 'default.jpg';
                        ?>
                        <div class="card p-4 bg-white shadow rounded">
                            <a href="detail_barang.php?id=<?= $row['id'] ?>" class="block">
                                <img src="/uploads/<?= htmlspecialchars(basename($foto)) ?>"
                                    class="w-full h-40 object-contain rounded" />
                                <div class="card-body mt-2">
                                    <p class="font-semibold">[Ditemukan] <?= htmlspecialchars($row['nama_barang']) ?></p>
                                    <p class="text-gray-500 truncate">Terakhir di
                                        <?= htmlspecialchars($row['lokasi_kejadian']) ?></p>

                                </div>
                            </a>
                        </div>
                    <?php } ?>
                </div>
                <div class="flex justify-end mt-9">
                    <a href="/views/buat_laporan.php" class="bg-blue-500 text-white p-4 rounded-full shadow-lg">
                        <i data-feather="plus"></i>
                    </a>
                </div>
            </section>
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
    </script>
</body>

</html>