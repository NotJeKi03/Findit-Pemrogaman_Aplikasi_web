<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

include 'model/DB_Connection.php';

$kata_kunci = isset($_GET['kata_kunci']) ? mysqli_real_escape_string($conn, $_GET['kata_kunci']) : '';
$filter = isset($_GET['filter']) ? mysqli_real_escape_string($conn, $_GET['filter']) : '';

// Default filter = hilang
if (!in_array($filter, ['hilang', 'ditemukan', ''])) {
    $filter = '';
}

// Query pencarian
if (!empty($kata_kunci)) {
    $query_hilang = "SELECT * FROM daftar_barang 
                     WHERE (jenis_laporan = '$filter' OR '$filter' = '')
                     AND (nama_barang LIKE '%$kata_kunci%' 
                          OR deskripsi_barang LIKE '%$kata_kunci%' 
                          OR lokasi_kejadian LIKE '%$kata_kunci%')
                     ORDER BY created_at DESC";
} else {
    $query_hilang = "SELECT * FROM daftar_barang 
                     WHERE (jenis_laporan = '$filter' OR '$filter' = '') 
                     ORDER BY created_at DESC";
}

$result_hilang = mysqli_query($conn, $query_hilang);
?>

<!DOCTYPE html>
<html lang="en">

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
            <form action="list_laporan.php" method="GET" class="flex items-center flex-grow space-x-2">
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

      <!-- Tombol Sign In & Sign Up -->
      <div class="flex space-x-4">
        <a href="login.php"
          class="text-sky-500 border-2 border-sky-500 hover:bg-sky-500 hover:text-white font-semibold py-1.5 px-4 rounded-lg transition">
          Sign In
        </a>
        <a href="signup.php" class="text-white bg-sky-500  font-semibold py-1.5 px-4 rounded-lg transition">
          Sign Up
        </a>
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
    <main class="mt-10 mb-10 px-4 flex-grow flex justify-center">
        <div class="container mx-auto mt-4 mb-16">
            <section>
                <h3 class="text-[#008ecc] font-bold text-xl mb-4">Cari Barangmu</h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <?php if (mysqli_num_rows($result_hilang) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($result_hilang)): ?>
                            <?php $foto = $row['foto1'] ? $row['foto1'] : 'default.jpg'; ?>
                            <div class="card p-4 bg-white shadow rounded">
                                <a href="/views/detail_barang.php?id=<?= $row['id'] ?>" class="block">
                                    <img src="/uploads/<?= htmlspecialchars(basename($foto)) ?>"
                                        class="w-full h-40 object-contain rounded" />
                                    <div class="card-body mt-2">
                                        <p class="font-semibold">
                                            [<?= htmlspecialchars($row['jenis_laporan']) ?>]
                                            <?= htmlspecialchars($row['nama_barang']) ?>
                                        </p>
                                        <p class="text-gray-500 truncate">Terakhir di
                                            <?= htmlspecialchars($row['lokasi_kejadian']) ?></p>
                                    </div>
                                </a>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p class="text-gray-600 col-span-full text-center">Tidak ditemukan barang dengan kata kunci
                            tersebut.</p>
                    <?php endif; ?>
                </div>
            </section>
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

    <!-- Scripts -->
    <script>
        feather.replace();

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