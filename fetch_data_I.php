<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jadual";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get the part parameter from the URL
    if (isset($_GET['part'])) {
        $part = $_GET['part'];

        // Prepare SQL query to fetch data for the selected part
        $stmt = $conn->prepare("SELECT * FROM bahagian_i WHERE part = :part ORDER BY bil");
        $stmt->bindParam(':part', $part);
        $stmt->execute();

        // Fetch the results
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($results)) {
            echo json_encode(["error" => "No data found for part $part"]);
        } else {
            echo json_encode($results);
        }
    } else {
        echo json_encode(["error" => "Part parameter is missing"]);
    }
} catch (PDOException $e) {
    echo json_encode(["error" => "Database error: " . $e->getMessage()]);
}
?>
