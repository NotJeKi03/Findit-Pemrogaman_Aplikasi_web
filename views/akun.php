<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /login.php"); // not logged in
    exit();
}

require_once '../model/akun_edit.php';

// Ambil data user
$id = $_SESSION['user_id'];
$user = getUserById($id);

// Proses update jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $update = updateUser($id, $name, $email, $password ?: null);
    if ($update) {
        $user = getUserById($id); // refresh data
        $success = "Data berhasil diperbarui.";
    } else {
        $error = "Gagal memperbarui data.";
    }
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
    <title>FindIt - Akun</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
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
                    <a href="akun.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Akun
                        Saya</a>
                    <a href="buat_laporan.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Buat
                        Laporan</a>
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

    <!-- Main -->
    <div class="bg-white  rounded-xl mx-10 my-10 flex flex-col gap-5 px-3 md:px-16 lg:px-28 md:flex-row text-[#161931]">
        <aside class="hidden py-4 md:w-1/3 lg:w-1/4 md:block">
            <div class="sticky flex flex-col gap-2 p-4 text-sm border-r border-sky-100 top-12">

                <h2 class="pl-3 mb-4 text-2xl font-semibold">Settings</h2>

                <a href="/views/akun.php"
                    class="flex items-center px-3 py-2.5 font-bold bg-white  text-sky-600 border rounded-full">
                    Edit Profil
                </a>
                <a href="/views/lihat_laporan_user.php"
                    class="flex items-center px-3 py-2.5 font-semibold hover:text-sky-600 hover:border hover:rounded-full  ">
                    Daftar Laporanmu
                </a>
                <a href="/views/buat_laporan.php"
                    class="flex items-center px-3 py-2.5 font-semibold hover:text-sky-600 hover:border hover:rounded-full  ">
                    Buat Laporan
                </a>
                <a href="/views/notifikasi.php"
                    class="flex items-center px-3 py-2.5 font-semibold hover:text-sky-600 hover:border hover:rounded-full  ">
                    Notifications
                </a>
            </div>
        </aside>
        <main class="w-full min-h-screen py-1 md:w-2/3 lg:w-3/4">
            <div class="bg-white p-6  w-full max-w-md">
                <h2 class="text-xl font-bold mb-4 text-center">Edit Profil</h2>

                <?php if (!empty($success)): ?>
                    <p class="text-green-600 mb-4"><?= $success ?></p>
                <?php elseif (!empty($error)): ?>
                    <p class="text-red-600 mb-4"><?= $error ?></p>
                <?php endif; ?>

                <form method="POST">
                    <div class="mb-4">
                        <label class="block text-sm mb-1">name</label>
                        <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required
                            class="w-full border px-3 py-2 rounded" />
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm mb-1">Email</label>
                        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required
                            class="w-full border px-3 py-2 rounded" />
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm mb-1">Password (kosongkan jika tidak diubah)</label>
                        <input type="password" name="password" class="w-full border px-3 py-2 rounded" />
                    </div>
                    <button type="submit"
                        class="w-full bg-sky-600 text-white py-2 rounded hover:bg-sky-700">Simpan</button>
                </form>
                <form method="POST" action="/model/hapus_akun.php" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini beserta semua data yang telah diupload?');" class="mt-20">
                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                    <button type="submit" class="text-red-600 hover:text-white border border-red-600 hover:bg-red-600 font-medium rounded px-4 py-1.5 text-sm">
                        Hapus Akun
                    </button>
                </form>
            </div>
        </main>
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

        // Toggle button for jenis laporan
        function setType(type, element) {
            document.getElementById('jenis_laporan').value = type;
            document.querySelectorAll('.toggle-btn').forEach((btn) => {
                btn.classList.remove('bg-blue-600', 'text-white');
                btn.classList.add('bg-gray-300', 'text-gray-700');
            });
            element.classList.add('bg-blue-600', 'text-white');
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