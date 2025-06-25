<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FindIt-Sign Up</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="login.css">
    <script src="https://unpkg.com/feather-icons"></script>
    <style type="text/tailwindcss">
        h1{
                @apply md:text-base lg:text-lg xl:text-xl
            }
            p{
                @apply md:text-sm lg:text-base xl:text-lg
            }
        </style>
</head>

<body class="bg-gray-50">

    <div class="flex justify-center bg-gray-50 min-h-screen mt-50">

        <div
            class="flex flex-col md:flex-row-reverse p-8 justify-center  border shadow-xl h-min m-10 my-0 rounded-xl bg-white border-gray-100">
            <div>
                <img class="logo-main" src="img/findit-logo.png" alt="Logo Login" />
            </div>
            <div class="login-box">
                <div class="pe-px">
                    <h1 class="heading">New Here?</h1>
                    <p class="mb-4">Enter your Credentials to create your new account</p>
                </div>

                <form action="model/signup.php" method="POST" class="flex flex-col gap-4">
                    <p class="font-semibold">Full Name</p>
                    <input type="text" name="name" placeholder="Enter your full name" class="input-style" required />

                    <p class="font-semibold">Email Address</p>
                    <input type="email" name="email" placeholder="Enter your email" class="input-style" required />

                    <p class="font-semibold">Password</p>
                    <input type="password" name="password" placeholder="Enter your password" class="input-style"
                        required />

                    <div class="mt-3">
                        <input type="checkbox" id="agree" class="form-check-input" required />
                        <label for="agree" class="form-check-label">
                            I agree to the <a href="#" class="underline text-blue-500">terms and policy</a>
                        </label>
                    </div>

                    <button type="submit" class="login-button" name="signup">Sign Up</button>
                </form>

                <p class="mt-3 text-center">
                    Already have an account? <a href="login.php" class="text-blue-500">Login</a>
                </p>
            </div>

        </div>
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
        function disableButton(buttonId) {
            console.log("Button clicked:", buttonId);
        }
    </script>
</body>

</html>