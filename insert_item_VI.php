<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bil = $_POST['bil'];
    $keterangan = $_POST['keterangan'];
    $bhg = $_POST['bhg'];
    $unit = $_POST['unit'];
    $harga = $_POST['harga'];
    $part = $_POST['part'];

    // Insert query
    $query = "INSERT INTO bahagian_vi (bil, keterangan, bhg, unit, harga, part) 
              VALUES ('$bil', '$keterangan', '$bhg', '$unit', '$harga', '$part')";
    
    if ($conn->query($query) === TRUE) {
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
