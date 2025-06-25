<?php
session_start();
include 'DB_Connection.php'; // or your DB connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Query to check user
  $query = "SELECT * FROM account WHERE email='$email' AND password='$password'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);

    // If you're using password_hash, use password_verify here
    if ($password === $user['password']) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['user_name'] = $user['name'];
      $_SESSION['Status'] = $user['Status']; // admin or user

      // Redirect based on status
      if ($user['Status'] === 'admin') {
        header("Location: ../views/lihat_laporan.php");
      } else {
        header("Location: ../views/caripage.php");
      }
      exit();
    } else {
      echo "Incorrect password.";
    }
  } else {
    echo "Email not found.";
  }
}
?>

