<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jadual";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get form data
    $id = $_POST['id'];
    $bil = $_POST['bil'];
    $keterangan = $_POST['keterangan'];
    $bhg = $_POST['bhg'];
    $unit = $_POST['unit'];
    $harga = $_POST['harga'];

    // Update query
    $stmt = $conn->prepare("UPDATE bahagian_iii SET bil = :bil, keterangan = :keterangan, bhg = :bhg, unit = :unit, harga = :harga WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':bil', $bil);
    $stmt->bindParam(':keterangan', $keterangan);
    $stmt->bindParam(':bhg', $bhg);
    $stmt->bindParam(':unit', $unit);
    $stmt->bindParam(':harga', $harga);
    $stmt->execute();

    echo "Item updated successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
