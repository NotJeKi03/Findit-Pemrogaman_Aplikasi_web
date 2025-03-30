<?php
include "config.php"; 

$query = "SELECT * FROM daftar";
$result = $conn->query($query);

echo "<div class='container'>";
echo "<h2>Daftar Akun</h2>"; 
echo "<table>";
echo "<tr>";
echo "<th>Nama</th>";
echo "<th>Email</th>";
echo "<th>Password</th>";
echo "</tr>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["password"]) . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3' class='no-data'>Tidak ada data.</td></tr>";
}

echo "</table>";
echo "</div>";

$conn->close();
?>

<style>
    body {
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #f9f9f9;
        color: #333;
        margin: 0;
    }
    .container {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        width: 80%;
        max-width: 600px;
        text-align: center;
    }
    h2 {
        font-size: 1.5rem;
        margin-bottom: 25px; 
        color: #008ecc;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        font-size: 1rem;
    }
    th, td {
        border-bottom: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }
    .no-data {
        text-align: center;
        font-style: italic;
        color: #888;
    }
</style>
