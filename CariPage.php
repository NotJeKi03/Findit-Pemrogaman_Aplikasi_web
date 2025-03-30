<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FindIt - Temukan Barang Hilang</title>
    <link
      href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css"
      rel="stylesheet"
    />
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
      body {
        margin-top: 80px;
      }
      .hero img {
        max-height: 300px;
        object-fit: cover;
      }
      .search-input {
        background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-opacity="0.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>')
          no-repeat scroll 7px 7px;
        padding-left: 40px;
      }
      .container h3 {
        font-size: 1.5rem;
        line-height: 2rem;
        color: rgb(55, 122, 184);
      }
    </style>
  </head>
  <body class="flex flex-col min-h-screen bg-gray-100">
    <header
      class="bg-white shadow-sm p-3 flex items-center space-x-4 fixed top-0 left-0 right-0 z-10"
    >
      <img src="logo.png" alt="Logo FindIt" class="w-32 h-auto" />
      <a href="#" id="Filter button"><i data-feather="filter"></i></a>
      <input
        type="text"
        class="form-control flex-grow p-2 border rounded search-input"
        placeholder="Temukan barangmu"
      />
      <a href="#" id="Notif button" class="p-7"><i data-feather="bell"></i></a>
      <a href="#" id="Akun button"><i data-feather="user"></i></a>
    </header>

    <div class="hero flex justify-center p-10">
      <img src="BN 1.png" alt="Banner pencari" class="w-full max-w-4xl" />
    </div>

    <div class="container mx-auto mt-4 mb-16">
      <section>
        <h3 class="text-[#008ecc] font-bold text-xl mb-4">Cari Barangmu</h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
          <a href="detail.html" class="block">
            <div class="card p-4 bg-white shadow rounded">
              <img
                src="iphone14.jpg"
                class="w-full h-40 object-contain rounded"
              />
              <div class="card-body mt-2">
                <p class="font-semibold">iPhone 14 Pro Max</p>
                <p class="text-gray-500">Terakhir terlihat di Mal</p>
              </div>
            </div>
          </a>
          <div class="card p-4 bg-white shadow rounded">
            <img src="dompet.png" class="w-full h-40 object-contain rounded" />
            <div class="card-body mt-2">
              <p class="font-semibold">Dompet Kulit Coklat</p>
              <p class="text-gray-500">Hilang di Kampus</p>
            </div>
          </div>
          <div class="card p-4 bg-white shadow rounded">
            <img src="asusrog.jpg" class="w-full h-40 object-contain rounded" />
            <div class="card-body mt-2">
              <p class="font-semibold">Laptop Asus ROG</p>
              <p class="text-gray-500">Terakhir terlihat di Taman</p>
            </div>
          </div>
          <div class="card p-4 bg-white shadow rounded">
            <img src="tasbiru.jpg" class="w-full h-40 object-contain rounded" />
            <div class="card-body mt-2">
              <p class="font-semibold">Tas Ransel Biru</p>
              <p class="text-gray-500">Hilang di Stasiun</p>
            </div>
          </div>
        </div>
      </section>

      <section class="mt-8">
        <h3 class="text-[#008ecc] font-bold text-xl mb-4">
          Laporan Barang Hilang
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
          <div class="card p-4 bg-white shadow rounded">
            <img src="airpods.jpg" class="w-full h-40 object-contain rounded" />
            <div class="card-body mt-2">
              <p class="font-semibold">AirPods Pro</p>
              <p class="text-gray-500">Ditemukan di Kafe</p>
            </div>
          </div>
          <div class="card p-4 bg-white shadow rounded">
            <img src="watch.jpg" class="w-full h-40 object-contain rounded" />
            <div class="card-body mt-2">
              <p class="font-semibold">Jam Tangan Apple Watch</p>
              <p class="text-gray-500">Ditemukan di Taman</p>
            </div>
          </div>
          <div class="card p-4 bg-white shadow rounded">
            <img src="ktm.png" class="w-full h-40 object-contain rounded" />
            <div class="card-body mt-2">
              <p class="font-semibold">Kartu Mahasiswa</p>
              <p class="text-gray-500">Ditemukan di Kantor</p>
            </div>
          </div>
          <div class="card p-4 bg-white shadow rounded">
            <img src="buku.png" class="w-full h-40 object-contain rounded" />
            <div class="card-body mt-2">
              <p class="font-semibold">Buku Catatan</p>
              <p class="text-gray-500">Ditemukan di Stasiun</p>
            </div>
          </div>
        </div>
        <div class="flex justify-end mt-9">
          <a
            href="laporan.html"
            class="bg-blue-500 text-white p-4 rounded-full shadow-lg"
          >
            <i data-feather="plus"></i>
          </a>
        </div>
      </section>
    </div>

    <footer class="bg-blue-500 text-white text-center p-4 mt-500">
      <p>&copy; 2024 All rights reserved. FindIt</p>
    </footer>

    <script>
      feather.replace();
    </script>
  </body>
</html>
