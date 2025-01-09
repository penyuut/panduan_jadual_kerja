<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'jadual');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$bil = $_POST['bil'];
$keterangan = $_POST['keterangan'];
$unit = $_POST['unit'];
$harga = $_POST['harga'];

// Insert data into database
$sql = "INSERT INTO bahagian_i_a (bil, keterangan, unit, harga) VALUES ('$bil', '$keterangan', '$unit', '$harga')";

if ($conn->query($sql) === TRUE) {
    echo "Data saved successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Redirect back to the main page
header("Location: index.html");
$conn->close();
?>
