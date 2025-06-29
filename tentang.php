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
                <a href="/views/caripage.php" class="text-2xl font-bold text-sky-600 hidden md:inline">
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
        <a href="register.php" class="text-white bg-sky-500  font-semibold py-1.5 px-4 rounded-lg transition">
          Sign Up
        </a>
      </div>
    </div>
  </header>


  <!-- Hero Section - About Us -->
  <section class="hero-bg relative pt-20 pb-16 flex items-center justify-center min-h-[60vh] text-white">
    <div class="question-mark top-10 left-10">?</div>
    <div class="question-mark top-20 right-20">?</div>
    <div class="question-mark bottom-20 left-20">?</div>
    <div class="question-mark bottom-10 right-10">?</div>
    <div class="question-mark top-1/2 left-1/4">?</div>
    <div class="question-mark top-1/3 right-1/3">?</div>

    <div class="absolute inset-0">
      <img src="/img/mikir.png" alt="Background" class="w-full h-full object-cover" />
      <div class="absolute inset-0 bg-black bg-opacity-60"></div> <!-- Overlay gelap -->
    </div>

    <div class="relative z-10 text-center max-w-4xl mx-auto px-6">
      <h1 class="text-5xl md:text-6xl font-bold mb-6">Tentang Kami</h1>
      <p class="text-lg md:text-xl leading-relaxed">
        Platform terdepan untuk mengelola dan menemukan barang hilang dengan
        teknologi modern dan sistem yang terintegrasi untuk membantu Anda
        menemukan kembali barang berharga.
      </p>
      <button type="button" onclick="window.location.href='login.php';"
        class="mt-5 font-bold text-white border-4  border-white hover:border-sky-500 hover:text-sky-500 transition-colors duration-300 rounded-lg text-sm px-6 py-3">
        Gabung Sekarang
      </button>
    </div>

  </section>

  <!-- What is FindIt Section -->
  <section class="py-16 bg-white">
    <div class="max-w-6xl mx-auto px-6">
      <div class="flex flex-col lg:flex-row items-center gap-12">
        <div class="lg:w-2/3">
          <h2 class="text-4xl font-bold text-gray-800 mb-6 text-center lg:text-left">
            Apa itu FindIt?
            <div class="w-24 h-1 bg-findit-blue mt-2 mx-auto lg:mx-0"></div>
          </h2>

          <div class="space-y-6 text-gray-600 leading-relaxed">
            <p>
              FindIt adalah platform inovatif yang menghubungkan orang-orang
              yang kehilangan barang dengan mereka yang menemukannya. Kami
              percaya bahwa setiap barang memiliki cerita dan pemiliknya yang
              tepat.
            </p>

            <p>
              Dengan teknologi pencarian canggih dan komunitas yang peduli,
              kami menyediakan solusi komprehensif untuk masalah barang hilang
              yang sering terjadi dalam kehidupan sehari-hari.
            </p>
          </div>
        </div>

        <div class="lg:w-1/3 flex justify-center">
          <div class="relative">
            <div class="text-9xl text-gray-200">?</div>
            <div class="absolute -top-4 -right-4 text-6xl text-gray-300">
              ?
            </div>
            <div class="absolute -bottom-4 -left-4 text-4xl text-gray-400">
              ?
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Why Choose FindIt Section -->
  <section class="py-16 bg-findit-blue text-white">
    <div class="max-w-6xl mx-auto px-6">
      <h2 class="text-4xl font-bold text-center mb-12">
        Mengapa Memilih FindIt?
      </h2>

      <div class="grid md:grid-cols-3 gap-8">
        <div class="bg-white bg-opacity-10 rounded-lg p-8 text-center backdrop-blur-sm">
          <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-6">
            <i data-feather="search" class="w-8 h-8"></i>
          </div>
          <h3 class="text-xl font-semibold mb-4">Pencarian Cerdas</h3>
          <p class="text-sm leading-relaxed">
            Algoritma pencarian yang canggih membantu mencocokkan deskripsi
            barang hilang dengan barang temuan dengan akurat dan cepat.
          </p>
        </div>

        <div class="bg-white bg-opacity-10 rounded-lg p-8 text-center backdrop-blur-sm">
          <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-6">
            <i data-feather="users" class="w-8 h-8"></i>
          </div>
          <h3 class="text-xl font-semibold mb-4">Komunitas Aktif</h3>
          <p class="text-sm leading-relaxed">
            Bergabung dengan ribuan pengguna yang saling membantu menemukan
            barang hilang dan memberikan bantuan kepada sesama.
          </p>
        </div>

        <div class="bg-white bg-opacity-10 rounded-lg p-8 text-center backdrop-blur-sm">
          <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-6">
            <i data-feather="shield" class="w-8 h-8"></i>
          </div>
          <h3 class="text-xl font-semibold mb-4">Keamanan Terjamin</h3>
          <p class="text-sm leading-relaxed">
            Sistem verifikasi berbagai dan perlindungan data pribadi
            memberikan keamanan informasi dan transaksi yang optimal.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Our Values Section -->
  <section class="py-16 bg-gray-50">
    <div class="max-w-6xl mx-auto px-6">
      <div class="flex flex-col lg:flex-row gap-12">
        <div class="lg:w-1/3 flex items-center justify-center">
          <div class="bg-findit-blue text-white rounded-lg p-8 h-full flex flex-col items-center justify-center">
            <h3 class="text-2xl font-bold mb-6">Komitmen Kami</h3>
            <p class="leading-relaxed text-center">
              Membangun ekosistem digital yang memungkinkan setiap orang
              berkontribusi dalam membantu sesama menemukan kembali barang
              berharga mereka dengan mudah dan aman.
            </p>
          </div>
        </div>

        <div class="lg:w-2/3">
          <h2 class="text-3xl font-bold text-gray-800 mb-8">
            Nilai - Nilai Kami
          </h2>

          <div class="space-y-6">
            <div class="flex items-start space-x-4">
              <div
                class="bg-findit-blue text-white rounded-full w-8 h-8 flex items-center justify-center flex-shrink-0 mt-1">
                <span class="text-sm font-bold">1</span>
              </div>
              <div>
                <h4 class="text-xl font-semibold text-gray-800 mb-2">
                  Kepercayaan
                </h4>
                <p class="text-gray-600">
                  Kami membangun platform berdasarkan kepercayaan antara
                  pengguna, dengan sistem verifikasi yang ketat dan sistem
                  poin setiap pengguna.
                </p>
              </div>
            </div>

            <div class="flex items-start space-x-4">
              <div
                class="bg-findit-blue text-white rounded-full w-8 h-8 flex items-center justify-center flex-shrink-0 mt-1">
                <span class="text-sm font-bold">2</span>
              </div>
              <div>
                <h4 class="text-xl font-semibold text-gray-800 mb-2">
                  Kemudahan
                </h4>
                <p class="text-gray-600">
                  Interface yang intuitif dan proses yang sederhana
                  memungkinkan siapa saja dapat menggunakan platform ini tanpa
                  kesulitan teknis.
                </p>
              </div>
            </div>

            <div class="flex items-start space-x-4">
              <div
                class="bg-findit-blue text-white rounded-full w-8 h-8 flex items-center justify-center flex-shrink-0 mt-1">
                <span class="text-sm font-bold">3</span>
              </div>
              <div>
                <h4 class="text-xl font-semibold text-gray-800 mb-2">
                  Kecepatan
                </h4>
                <p class="text-gray-600">
                  Sistem notifikasi real-time dan pencarian cepat memastikan
                  informasi sampai tepat waktu kepada pihak yang membutuhkan.
                </p>
              </div>
            </div>

            <div class="flex items-start space-x-4">
              <div
                class="bg-findit-blue text-white rounded-full w-8 h-8 flex items-center justify-center flex-shrink-0 mt-1">
                <span class="text-sm font-bold">4</span>
              </div>
              <div>
                <h4 class="text-xl font-semibold text-gray-800 mb-2">
                  Keamanan
                </h4>
                <p class="text-gray-600">
                  Perlindungan data pribadi dan sistem keamanan berlapis
                  menjadi prioritas utama dalam setiap fitur yang kami
                  kembangkan.
                </p>
              </div>
            </div>
          </div>
        </div>
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
              <a href="index.php" class="hover:underline">Tentang Kami</a>
            </li>
            <li>
              <a href="#" class="hover:underline">Syarat & Ketentuan</a>
            </li>
            <li><a href="#" class="hover:underline">Kebijakan Privasi</a></li>
            <li><a href="kontak.html" class="hover:underline">Pusat Bantuan</a></li>
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