<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FindIt-SignUp</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <!-- <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace(); // Mengaktifkan Feather Icons
      </script> -->
  <script src="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1"></script>
</head>

<body>
  <div class="flex justify-center -mb-25">
    <img src="img/logo.png" alt="Logo FindIt" class="w-3xs" />
  </div>
  <div
    class="flex w-full justify-center md:gap-3 gap-0 md:scale-70 md:flex-row-reverse flex-col">
    <div>
      <img class="ml-45 w-2xl" src="img/findit-logo.png" alt="Logo Login" />
    </div>
    <div class="flex flex-col gap-8 p-8">
      <div class="pe-px">
        <h1 class="text-4xl font-semibold pb-4">Get Started Now</h1>
      </div>
      <form action="model/proses.php" method="POST" class="flex flex-col gap-4">
        <p class="font-semibold">Name</p>
        <input
          id="name"
          type="text"
          name="name"
          placeholder="Enter your name"
          class="border border-gray-200 px-2 py-1 rounded" />
        <p class="font-semibold">Email Address</p>
        <input
          id="email"
          type="text"
          name="email"
          placeholder="Enter your email"
          class="border border-gray-200 px-2 py-1 rounded" />
        <div class="font-semibold relative">Password
          <input
            id="password"
            type="password"
            name="password"
            placeholder="Enter your password"
            class="border border-gray-200 px-2 py-1 rounded w-full mt-4" />
          <button
            type="button"
            onclick="togglePassword()"
            class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500 mt-5">
            <i id="toggle-icon" class="ph ph-eye"></i>
          </button>
        </div>
        <div class="mt-3 mb-3">
          <input type="checkbox" class="form-check-input" />
          <label class="form-check-label">I agree to the <a style="text-decoration: underline;" class="cursor-pointer">terms & policy</a></label>
        </div>
        <button
          type="submit"
          class="bg-blue-500 text-white rounded-lg p-1 -mt-2 cursor-pointer"
          name="login">
          Signup
        </button>
      </form>
      <div class="flex w-full items-center gap-2">
        <hr class="border border-gray-200 w-full" />
        or
        <hr class="border border-gray-200 w-full" />
      </div>
      <div class="flex gap-8">
        <button
          type="button"
          class="border rounded border-gray-200 px-2 py-1 flex items-center gap-2 cursor-pointer"
          onclick="window.location.href='loginGoogle.html'">
          <i class="ph ph-google-logo"></i> Sign in with Google
        </button>
        <button
          type="button"
          class="border rounded border-gray-200 px-2 py-1 flex items-center gap-2 cursor-pointer"
          onclick="window.location.href='loginApple.html'">
          <i class="ph-fill ph-apple-logo"></i> Sign in with Apple
        </button>
      </div>
      <p class="mt-3 text-center">
        have an account? <a href="login.php" class="text-blue-500">Sign In</a>
      </p>
    </div>
  </div>
  <script>
    function togglePassword() {
      const passwordInput = document.getElementById("password");
      const toggleIcon = document.getElementById("toggle-icon");
      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleIcon.classList.replace("ph-eye", "ph-eye-slash");
      } else {
        passwordInput.type = "password";
        toggleIcon.classList.replace("ph-eye-slash", "ph-eye");
      }
    }
  </script>
</body>

</html>
