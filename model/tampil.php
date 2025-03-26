<?php
include 'config.php';
$sql = "SELECT * FROM daftar";
$result = $conn->query($sql);
echo "<h2><b>Daftar Account</b></h2>";
echo "<table style='width: 60%; border-collapse: collapse; text-align: left; font-family: Arial, sans-serif;'>";
echo "<tr style='background-color: #f2f2f2;'>";
echo "<th style='border: 1px solid black; padding: 8px;'>Name</th>";
echo "<th style='border: 1px solid black; padding: 8px;'>Email</th>";
echo "<th style='border: 1px solid black; padding: 8px;'>Password</th>";
echo "</tr>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td style='border: 1px solid black; padding: 8px;'>" . $row["name"] . "</td>";
        echo "<td style='border: 1px solid black; padding: 8px;'>" . $row["email"] . "</td>";
        echo "<td style='border: 1px solid black; padding: 8px;'>" . $row["password"] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3' style='border: 1px solid black; padding: 8px; text-align: center;'>Tidak ada data.</td></tr>";
}
echo "</table>";
$conn->close();
?>