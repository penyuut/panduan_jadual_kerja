<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jadual";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get the ID of the item to delete
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data['id'];

    // Delete query
    $stmt = $conn->prepare("DELETE FROM bahagian_vi WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    echo "Item deleted successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
