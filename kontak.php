<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FindIt - Hubungi Kami</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
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
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        font-family: "Poppins", sans-serif;
        line-height: 1.6;
        color: #333;
      }

      /* Header custom styles */
      .search-input {
        border: 1px solid #e5e7eb;
      }

      .search-input:focus {
        outline: none;
        border-color: #008ecc;
        box-shadow: 0 0 0 1px #008ecc;
      }

      /* Main Content */
      main {
        margin-top: 80px;
        padding: 2rem;
        background-color: #f8f9fa;
      }

      .contact-container {
        max-width: 1200px;
        margin: 0 auto;
      }

      .contact-header {
        text-align: center;
        margin-bottom: 3rem;
      }

      .contact-header h1 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 1rem;
      }

      .contact-header p {
        color: #666;
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto;
      }

      .contact-content {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 3rem;
        margin-bottom: 3rem;
      }

      .contact-info {
        background: white;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        height: fit-content;
      }

      .info-item {
        display: flex;
        margin-bottom: 2rem;
        align-items: flex-start;
      }

      .info-icon {
        background: #008ecc;
        color: white;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        font-size: 1.2rem;
      }

      .info-content h3 {
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #333;
      }

      .info-content p {
        color: #666;
        font-size: 0.95rem;
      }

      .contact-form {
        background: white;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      }

      .form-group {
        margin-bottom: 1.5rem;
      }

      .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: #333;
      }

      .form-group input,
      .form-group textarea {
        width: 100%;
        padding: 0.8rem;
        border: 2px solid #e0e0e0;
        border-radius: 5px;
        font-family: "Poppins", sans-serif;
        transition: border-color 0.3s ease;
      }

      .form-group input:focus,
      .form-group textarea:focus {
        outline: none;
        border-color: #008ecc;
      }

      .form-group textarea {
        height: 120px;
        resize: vertical;
      }

      .submit-btn {
        background: #008ecc;
        color: white;
        padding: 0.8rem 2rem;
        border: none;
        border-radius: 5px;
        font-family: "Poppins", sans-serif;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s ease;
        width: 100%;
      }

      .submit-btn:hover {
        background: #006ba3;
      }

      @media (max-width: 768px) {
        .contact-content {
          grid-template-columns: 1fr;
          gap: 2rem;
        }

        nav {
          display: none;
        }

        .contact-header h1 {
          font-size: 2rem;
        }
      }
    </style>
  </head>
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


    <!-- Main Content -->
    <main>
      <div class="contact-container">
        <div class="contact-header">
          <h1>Hubungi Kami</h1>
          <p>
            Untuk Informasi Lebih Lanjut Tentang Produk & Layanan Kami, Silakan
            Kirimkan Email Kepada Kami. Staf Kami Selalu Siap Membantu Anda.
            Jangan Ragu!
          </p>
        </div>

        <div class="contact-content">
          <div class="contact-info">
            <div class="info-item">
              <div class="info-icon">
                <i data-feather="map-pin" class="w-6 h-6"></i>
              </div>
              <div class="info-content">
                <h3>Alamat</h3>
                <p>Magelang, Jawa Tengah</p>
              </div>
            </div>

            <div class="info-item">
              <div class="info-icon">
                <i data-feather="phone" class="w-6 h-6"></i>
              </div>
              <div class="info-content">
                <h3>Telepon</h3>
                <p>Mobile: +(62) 546-6789-5462</p>
              </div>
            </div>

            <div class="info-item">
              <div class="info-icon">
                <i data-feather="clock" class="w-6 h-6"></i>
              </div>
              <div class="info-content">
                <h3>Jam Kerja</h3>
                <p>
                  Senin-Jumat: 09.00 - 22.00<br />
                  Sabtu-Minggu: 09.00 - 21.00
                </p>
              </div>
            </div>
          </div>

          <div class="contact-form">
            <form>
              <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" required />
              </div>

              <div class="form-group">
                <label for="email">Alamat Email</label>
                <input type="email" id="email" name="email" required />
              </div>

              <div class="form-group">
                <label for="subjek">Subjek</label>
                <input type="text" id="subjek" name="subjek" required />
              </div>

              <div class="form-group">
                <label for="pesan">Pesan</label>
                <textarea id="pesan" name="pesan" required></textarea>
              </div>

              <button type="submit" class="submit-btn">Kirim</button>
            </form>
          </div>
        </div>
      </div>
    </main>

    <!-- Footer -->
    <footer class="bg-findit-blue text-white py-12">
      <div class="max-w-6xl mx-auto px-6">
        <div class="grid md:grid-cols-3 gap-8">
          <!-- Company Info -->
          <div>
            <div class="footer-logo flex items-center mb-6">
              <h2 class="text-3xl font-bold text-white">FindIt</h2>
              <!-- Plain text logo -->
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
              <div
                class="app-download flex space-x-3 justify-center md:justify-start"
              >
                <!-- Revert to old download buttons with App Store and Google Play badges -->
                <a href="#" class="flex items-center space-x-2">
                  <img
                    src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg"
                    alt="App Store"
                    class="h-10 cursor-pointer hover:opacity-80 transition-opacity"
                  />
                </a>
                <a href="#" class="flex items-center space-x-2">
                  <img
                    src="https://play.google.com/intl/en_us/badges/static/images/badges/en_badge_web_generic.png"
                    alt="Google Play"
                    class="h-10 cursor-pointer hover:opacity-80 transition-opacity"
                  />
                </a>
              </div>
            </div>
          </div>

          <!-- Customer Service -->
          <div>
            <h4 class="font-semibold mb-6">Layanan Pelanggan</h4>
            <ul class="space-y-3">
              <li>
                <a
                  href="tentang.html"
                  class="text-sm hover:opacity-80 transition-opacity"
                  >Tentang Kami</a
                >
              </li>

              <li>
                <a href="#" class="text-sm hover:opacity-80 transition-opacity"
                  >Syarat & Ketentuan</a
                >
              </li>
              <li>
                <a href="#" class="text-sm hover:opacity-80 transition-opacity"
                  >Kebijakan Privasi</a
                >
              </li>
              <li>
                <a href="#" class="text-sm hover:opacity-80 transition-opacity"
                  >Pusat Bantuan</a
                >
              </li>
              <li>
                <a href="#" class="text-sm hover:opacity-80 transition-opacity"
                  >Pertanyaan Umum</a
                >
              </li>
            </ul>
          </div>

          <!-- Popular Categories -->
          <div>
            <h4 class="font-semibold mb-6">Kategori Terpopuler</h4>
            <ul class="space-y-3">
              <li>
                <a href="#" class="text-sm hover:opacity-80 transition-opacity"
                  >Cari Barang Hilang</a
                >
              </li>
              <li>
                <a href="#" class="text-sm hover:opacity-80 transition-opacity"
                  >Laporkan Temuan</a
                >
              </li>
            </ul>
          </div>
        </div>

        <!-- Footer Divider -->
        <div
          class="footer-divider border-t border-white border-opacity-20 mt-8 pt-6 text-center"
        >
          <p class="text-sm opacity-80">
            © 2025 FindIt. Hak cipta dilindungi undang-undang.
          </p>
        </div>
      </div>
    </footer>

    <script>
      // Initialize Feather icons
      feather.replace();

      // Form submission handler
      document.querySelector("form").addEventListener("submit", function (e) {
        e.preventDefault();
        alert(
          "Terima kasih! Pesan Anda telah berhasil dikirim. Kami akan segera menghubungi Anda."
        );
      });

      // Button disable function
      function disableButton(buttonId) {
        // You can add logic here to handle active states
        console.log("Button clicked:", buttonId);
      }
    </script>
  </body>
</html>
