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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
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
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
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
      /* Additional custom styles */
      .notification-item {
        transition: all 0.3s ease;
      }

      .notification-item:hover {
        background-color: #f8f9fa;
      }

      .notification-item.unread::before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background-color: #008ecc;
      }

      .notification-actions {
        opacity: 0;
        transition: opacity 0.3s ease;
      }

      .notification-item:hover .notification-actions {
        opacity: 1;
      }

      .action-btn {
        transition: all 0.3s ease;
      }

      .action-btn:hover {
        background-color: #e3f2fd;
        color: #008ecc;
      }

      /* Responsive */
      @media (max-width: 768px) {
        .main-content {
          padding: 24px 16px;
        }

        .page-title {
          font-size: 24px;
        }
      }

      @media (max-width: 480px) {
        .notification-item {
          padding: 16px;
        }

        .notification-icon {
          width: 40px;
          height: 40px;
          font-size: 16px;
        }
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


    <!-- Main Content -->
    <main class="flex-1 max-w-6xl mx-auto px-6 pt-28 pb-12 w-full">
      <!-- Increased padding-top to 28 for more space -->
      <div class="page-header mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Notifikasi</h1>
      </div>

      <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Notifications Container with Scroll -->
        <div class="notifications-container p-4 max-h-[60vh] overflow-y-auto">
          <!-- Notification Item -->
          <div
            class="notification-item unread relative flex items-start gap-3 p-4 mb-4 border-b border-gray-100 cursor-pointer"
          >
            <div
              class="notification-icon bg-findit-blue text-white w-10 h-10 rounded-full flex items-center justify-center text-lg font-bold flex-shrink-0"
            >
              i
            </div>
            <div class="notification-content flex-1">
              <h3 class="text-sm font-semibold text-gray-800 mb-1">
                Pesan Baru
              </h3>
              <p class="text-gray-600 text-xs leading-relaxed mb-1">
                Ada yang tertarik dengan laporan dampak coklat Anda. Silakan cek
                pesan masuk untuk detail lebih lanjut.
              </p>
              <div class="notification-time text-xs text-gray-500">
                1 jam yang lalu
              </div>
            </div>
            <div class="notification-actions flex gap-2">
              <button
                class="action-btn px-2 py-1 border-none bg-transparent text-gray-600 cursor-pointer rounded-md text-xs"
              >
                Tandai Dibaca
              </button>
              <button
                class="action-btn px-2 py-1 border-none bg-transparent text-gray-600 cursor-pointer rounded-md text-xs"
              >
                Hapus
              </button>
            </div>
          </div>

          <!-- Notification Item -->
          <div
            class="notification-item unread relative flex items-start gap-3 p-4 mb-4 border-b border-gray-100 cursor-pointer"
          >
            <div
              class="notification-icon bg-findit-blue text-white w-10 h-10 rounded-full flex items-center justify-center text-lg font-bold flex-shrink-0"
            >
              i
            </div>
            <div class="notification-content flex-1">
              <h3 class="text-sm font-semibold text-gray-800 mb-1">
                Pesan Baru
              </h3>
              <p class="text-gray-600 text-xs leading-relaxed mb-1">
                Ada yang tertarik dengan laporan dampak coklat Anda. Pengguna
                ingin menghubungi Anda terkait temuan tersebut.
              </p>
              <div class="notification-time text-xs text-gray-500">
                2 jam yang lalu
              </div>
            </div>
            <div class="notification-actions flex gap-2">
              <button
                class="action-btn px-2 py-1 border-none bg-transparent text-gray-600 cursor-pointer rounded-md text-xs"
              >
                Tandai Dibaca
              </button>
              <button
                class="action-btn px-2 py-1 border-none bg-transparent text-gray-600 cursor-pointer rounded-md text-xs"
              >
                Hapus
              </button>
            </div>
          </div>

          <!-- Notification Item -->
          <div
            class="notification-item unread relative flex items-start gap-3 p-4 mb-4 border-b border-gray-100 cursor-pointer"
          >
            <div
              class="notification-icon bg-findit-blue text-white w-10 h-10 rounded-full flex items-center justify-center text-lg font-bold flex-shrink-0"
            >
              i
            </div>
            <div class="notification-content flex-1">
              <h3 class="text-sm font-semibold text-gray-800 mb-1">
                Pesan Baru
              </h3>
              <p class="text-gray-600 text-xs leading-relaxed mb-1">
                Ada yang tertarik dengan laporan dampak coklat Anda. Seseorang
                telah mengirim pesan terkait barang yang Anda laporkan.
              </p>
              <div class="notification-time text-xs text-gray-500">
                3 jam yang lalu
              </div>
            </div>
            <div class="notification-actions flex gap-2">
              <button
                class="action-btn px-2 py-1 border-none bg-transparent text-gray-600 cursor-pointer rounded-md text-xs"
              >
                Tandai Dibaca
              </button>
              <button
                class="action-btn px-2 py-1 border-none bg-transparent text-gray-600 cursor-pointer rounded-md text-xs"
              >
                Hapus
              </button>
            </div>
          </div>

          <!-- Notification Item -->
          <div
            class="notification-item unread relative flex items-start gap-3 p-4 mb-4 cursor-pointer"
          >
            <div
              class="notification-icon bg-findit-blue text-white w-10 h-10 rounded-full flex items-center justify-center text-lg font-bold flex-shrink-0"
            >
              i
            </div>
            <div class="notification-content flex-1">
              <h3 class="text-sm font-semibold text-gray-800 mb-1">
                Pesan Baru
              </h3>
              <p class="text-gray-600 text-xs leading-relaxed mb-1">
                Ada yang tertarik dengan laporan dampak coklat Anda. Pemilik
                barang yang hilang ingin menghubungi Anda.
              </p>
              <div class="notification-time text-xs text-gray-500">
                4 jam yang lalu
              </div>
            </div>
            <div class="notification-actions flex gap-2">
              <button
                class="action-btn px-2 py-1 border-none bg-transparent text-gray-600 cursor-pointer rounded-md text-xs"
              >
                Tandai Dibaca
              </button>
              <button
                class="action-btn px-2 py-1 border-none bg-transparent text-gray-600 cursor-pointer rounded-md text-xs"
              >
                Hapus
              </button>
            </div>
          </div>
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
      // Initialize Feather icons
      feather.replace();

      // Notification interactions
      document.querySelectorAll(".notification-item").forEach((item, index) => {
        item.addEventListener("click", function (e) {
          if (!e.target.classList.contains("action-btn")) {
            this.classList.remove("unread");
            console.log(`Opening notification ${index + 1}`);
          }
        });
      });

      // Action buttons
      document.querySelectorAll(".action-btn").forEach((btn) => {
        btn.addEventListener("click", function (e) {
          e.stopPropagation();
          const action = this.textContent;
          const notificationItem = this.closest(".notification-item");

          if (action === "Tandai Dibaca") {
            notificationItem.classList.remove("unread");
          } else if (action === "Hapus") {
            notificationItem.style.transform = "translateX(100%)";
            notificationItem.style.opacity = "0";
            setTimeout(() => {
              notificationItem.remove();
            }, 300);
          }
        });
      });

      // Navigation button disable function
      function disableButton(buttonId) {
        console.log(`Navigating to: ${buttonId}`);
      }
    </script>
  </body>
</html>
