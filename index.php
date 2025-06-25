<?php

// Tangkap nilai dari GET jika ada, atau beri nilai default kosong
$kata_kunci = isset($_GET['kata_kunci']) ? $_GET['kata_kunci'] : '';
$filter = isset($_GET['filter']) ? $_GET['filter'] : '';


include 'model/DB_Connection.php';
$query_hilang = "SELECT * FROM daftar_barang WHERE jenis_laporan='hilang' ORDER BY created_at DESC";
$result_hilang = mysqli_query($conn, $query_hilang);

$query_ditemukan = "SELECT * FROM daftar_barang WHERE jenis_laporan='ditemukan' ORDER BY created_at DESC";
$result_ditemukan = mysqli_query($conn, $query_ditemukan);
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FindIt - Temukan & Laporkan Barang Hilang</title>
  <link href="https://fonts.googleapis.com/css2?family=Baloo+2&display=swap" rel="stylesheet">

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

    // Function to disable the clicked button
    function disableButton(id) {
      document.getElementById(id).style.pointerEvents = "none";
      document.getElementById(id).style.opacity = "0.5";
    }
  </script>
  <style>
    .search-input:focus {
      outline: none;
      border-color: #008ecc;
      box-shadow: 0 0 0 1px #008ecc;
    }

    .nav-menu a {
      transition: all 0.3s ease;
    }

    .nav-menu a:hover,
    .nav-menu a.active {
      background-color: #008ecc;
      color: white;
    }

    .hero-bg {
      background-image: url("mikir.png");
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }

    .question-mark {
      opacity: 0.1;
      position: absolute;
      color: white;
      font-size: 4rem;
      font-weight: bold;
    }
  </style>
</head>

<body class="flex flex-col min-h-screen bg-gray-100 font-poppins">

  <!-- Header -->
  <header class="bg-white p-4 border-b-2 border-gray-200">
    <div class="container mx-auto flex items-center justify-between">
      <!-- Logo -->
      <div class="flex items-center space-x-2">
        <a href="/views/caripage.php" class="text-2xl font-bold text-sky-500 hidden md:inline">
          FindIt
        </a>
      </div>

      <!-- Navigasi Tengah -->
      <nav class="flex-1 flex justify-center">
        <ul class="flex space-x-8">
          <li>
            <a href="index.php" class="font-semibold text-lg text-black hover:text-sky-500">Home</a>
          </li>
          <li>
            <a href="tentang.php" class="font-semibold text-lg text-black hover:text-sky-500">About</a>
          </li>
          <li>
            <a href="kontak.php" class="font-semibold text-lg text-black hover:text-sky-500">Contact</a>
          </li>
        </ul>
      </nav>

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
  </header>

  <!-- Hero Section -->
  <section class="hero-bg relative pt-20 pb-16 flex items-center justify-center min-h-[60vh]">
    <div class="absolute inset-0">
      <img src="/img/stickimg.jpg" alt="Background" class="w-full h-full object-cover" />
      <div class="absolute inset-0 bg-black bg-opacity-60"></div> <!-- Overlay gelap -->
    </div>
    <div class="max-w-7xl mx-auto px-6 py-16 text-center relative z-10">
      <h1 class="text-4xl md:text-5xl font-bold mb-4 text-white">Selamat Datang di <span
          class="text-sky-500">FindIt</span></h1>
      <p class="text-lg md:text-xl mb-6 text-white">
        Platform untuk membantu Anda <span class="font-semibold text-white">menemukan</span> atau <span
          class="font-semibold text-white">melaporkan</span> barang hilang secara cepat dan mudah.
      </p>
      <!-- Search Bar -->
      <form action="list_laporan.php" method="GET" class="flex items-center flex-grow space-x-2">
        <div class="relative w-full">
          <input type="text" name="kata_kunci" value="<?= htmlspecialchars($kata_kunci) ?>" required
            placeholder="Cari barang hilang atau ditemukan..."
            class="w-full border border-gray-300 rounded-full py-2 px-4 pl-10 focus:outline-none focus:ring-2 focus:ring-sky-500" />
          <i data-feather="search" class="absolute left-3 top-2.5 text-gray-400 w-5 h-5"></i>
        </div>

        <button type="submit"
          class="bg-sky-500 text-white px-4 py-2 rounded-full hover:bg-sky-600 transition font-semibold">
          Cari
        </button>
      </form>

      <div class="flex justify-center space-x-4 mt-5">
        <p class="text-lg md:text-xl text-white py-3">
          Menemukan / Kehilangan Barang?
        </p>
        <a href="/views/buat_laporan.php"
          class="font-bold px-6 py-3 bg-sky-500 text-white rounded-xl hover:bg-sky-700 transition">Buat Laporan</a>
      </div>
      <p class="mt-3 text-sm text-gray-600 font-semibold text-white">
        * Anda harus login terlebih dahulu sebelum dapat membuat dan melihat laporan.
      </p>
    </div>
  </section>

  <!-- About Section -->
  <section class="py-20 bg-gray-100">
    <div class="max-w-5xl mx-auto px-6 text-center">
      <h2 class="text-3xl font-bold mb-6">Apa itu FindIt?</h2>
      <p class="text-gray-700 text-lg leading-relaxed">
        FindIt adalah aplikasi web yang dirancang untuk memudahkan pengguna dalam mencari dan melaporkan barang hilang
        atau ditemukan.
        Dengan antarmuka yang sederhana dan efisien, Anda bisa membuat laporan hanya dalam beberapa menit.
        Setiap laporan berisi informasi penting seperti foto barang, deskripsi, dan lokasi kejadian.
      </p>
    </div>
  </section>

  <!-- Info Section -->
  <section class="py-16 bg-gray-50">
    <div class="max-w-5xl mx-auto px-6 text-center">
      <h3 class="text-2xl font-bold mb-6 text-black">Bagaimana Cara Kerjanya?</h3>
      <div class="grid md:grid-cols-3 gap-8 text-left">
        <div class="bg-white p-6 rounded-xl shadow">
          <h4 class="text-lg font-semibold mb-2">1. Login atau Daftar</h4>
          <p class="text-gray-600">Buat akun gratis untuk mulai menggunakan layanan FindIt.</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow">
          <h4 class="text-lg font-semibold mb-2">2. Buat atau Cari Laporan</h4>
          <p class="text-gray-600">Laporkan barang yang Anda temukan/hilang atau cari laporan yang sesuai.</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow">
          <h4 class="text-lg font-semibold mb-2">3. Hubungi Pemilik / Penemu</h4>
          <p class="text-gray-600">Hubungi pengguna lain melalui kontak yang tersedia dan bantu kembalikan barang.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Features Section -->
  <section class="py-10 bg-white">
    <div class="container mx-auto mb-16">
      <section class="mt-2">
        <h3 class="text-[#008ecc] font-bold text-2xl mb-4">Temukan Barangmu</h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
          <?php while ($row = mysqli_fetch_assoc($result_ditemukan)) {
            $foto = $row['foto1'] ? $row['foto1'] : 'default.jpg';
            ?>
            <div class="card p-4 bg-white shadow rounded">
              <a href="detail_barang.php?id=<?= $row['id'] ?>" class="block">
                <img src="/uploads/<?= htmlspecialchars(basename($foto)) ?>" class="w-full h-40 object-contain rounded" />
                <div class="card-body mt-2">
                  <p class="font-semibold">[Ditemukan] <?= htmlspecialchars($row['nama_barang']) ?></p>
                  <p class="text-gray-500 truncate">Terakhir di
                    <?= htmlspecialchars($row['lokasi_kejadian']) ?>
                  </p>

                </div>
              </a>
            </div>
          <?php } ?>
        </div>
      </section>

      <section class="mt-5">
        <h3 class="text-[#008ecc] font-bold text-2xl mb-4">Cari Barang yang hilang</h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
          <?php while ($row = mysqli_fetch_assoc($result_hilang)) {
            $foto = $row['foto1'] ? $row['foto1'] : 'default.jpg';
            ?>
            <div class="card p-4 bg-white shadow rounded">
              <a href="/views/detail_barang.php?id=<?= $row['id'] ?>" class="block">
                <img src="/uploads/<?= htmlspecialchars(basename($foto)) ?>" class="w-full h-40 object-contain rounded" />
                <div class="card-body mt-2">
                  <p class="font-semibold">[Hilang] <?= htmlspecialchars($row['nama_barang']) ?></p>
                  <p class="text-gray-500 truncate">Terakhir di
                    <?= htmlspecialchars($row['lokasi_kejadian']) ?>
                  </p>

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
    </div>
  </section>

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

    // Function to disable the clicked button
    function disableButton(id) {
      document.getElementById(id).style.pointerEvents = "none";
      document.getElementById(id).style.opacity = "0.5";
    }
  </script>

</body>

</html>