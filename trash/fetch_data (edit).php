<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'jadual');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the table A
$sql = "SELECT * FROM bahagian_i_a";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Display data in table rows
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['bil'] . "</td>";
        echo "<td>" . $row['keterangan'] . "</td>";
        echo "<td>" . $row['unit'] . "</td>";
        echo "<td>" . $row['harga'] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No data available</td></tr>";
}

// Fetch data from the table B
$sql = "SELECT * FROM bahagian_i_b";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Display data in table rows
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['bil'] . "</td>";
        echo "<td>" . $row['keterangan'] . "</td>";
        echo "<td>" . $row['unit'] . "</td>";
        echo "<td>" . $row['harga'] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No data available</td></tr>";
}

$conn->close();
?>
