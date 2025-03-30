<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FindIt - Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  </head>

  <body>
    <div class="container mx-auto p-4">
      <h1 class="text-3xl font-bold mb-4">Dashboard</h1>
      <p>Welcome, <?php echo $_SESSION["user"]["name"]; ?>!</p>
      <a href="logout.php" class="text-blue-500">Logout</a>
    </div>
  </body>
</html>