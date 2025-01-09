<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'jadual');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the project details from the session or database
$project_name = "Project ABC"; // Example project name, replace with actual value from session/db
$distance = "50 km"; // Example distance, replace with actual value from session/db
$selected_negeri = "Selangor"; // Example negeri, replace with actual value from session/db

// Fetch user_cart items (ITEM JKKE)
$user_cart_query = "SELECT * FROM user_cart";
$user_cart_result = mysqli_query($conn, $user_cart_query);

// Fetch approved_items (ITEM HARGA PERSETUJUAN)
$approved_items_query = "SELECT * FROM approved_items";
$approved_items_result = mysqli_query($conn, $approved_items_query);

// Start of the HTML table
echo "<h3>Projek: $project_name</h3>";
echo "<p>Jarak: $distance</p>";
echo "<p>Negeri: $selected_negeri</p>";

echo "<table border='1'>";
echo "<tr><th>No</th><th>Keterangan</th><th>Bhg.</th><th>Bil</th><th>RM</th><th>Kuantiti</th><th>Harga</th></tr>";

// Section A: ITEM JKKE
echo "<tr><td colspan='7'><b>A</b> ITEM JKKE</td></tr>";
while ($row = mysqli_fetch_assoc($user_cart_result)) {
    $no = $row['no']; // Example value, replace with actual field from user_cart
    $description = $row['description']; // Example value, replace with actual field
    $section = $row['section']; // Example value, replace with actual field
    $quantity = $row['quantity']; // Example value, replace with actual field
    $price = $row['price']; // Example value, replace with actual field
    $total_price = $quantity * $price; // Calculate total price

    echo "<tr>
            <td>$no</td>
            <td>$description</td>
            <td>$section</td>
            <td>$quantity</td>
            <td>$price</td>
            <td>$quantity</td>
            <td>$total_price</td>
          </tr>";
}

// Section B: ITEM HARGA PERSETUJUAN
echo "<tr><td colspan='7'><b>B</b> ITEM HARGA PERSETUJUAN</td></tr>";
while ($row = mysqli_fetch_assoc($approved_items_result)) {
    $no = $row['no']; // Example value, replace with actual field from approved_items
    $description = $row['description']; // Example value, replace with actual field
    $section = $row['section']; // Example value, replace with actual field
    $quantity = $row['quantity']; // Example value, replace with actual field
    $price = $row['price']; // Example value, replace with actual field
    $total_price = $quantity * $price; // Calculate total price

    echo "<tr>
            <td>$no</td>
            <td>$description</td>
            <td>$section</td>
            <td>$quantity</td>
            <td>$price</td>
            <td>$quantity</td>
            <td>$total_price</td>
          </tr>";
}

// Calculate total amount for both sections
$total_amount = 0;
mysqli_data_seek($user_cart_result, 0); // Reset the pointer to the beginning of the result set
while ($row = mysqli_fetch_assoc($user_cart_result)) {
    $quantity = $row['quantity'];
    $price = $row['price'];
    $total_amount += ($quantity * $price);
}

mysqli_data_seek($approved_items_result, 0); // Reset the pointer to the beginning of the result set
while ($row = mysqli_fetch_assoc($approved_items_result)) {
    $quantity = $row['quantity'];
    $price = $row['price'];
    $total_amount += ($quantity * $price);
}

echo "</table>";
echo "<p><b>Jumlah Nilai Kerja: RM $total_amount</b></p>";

// Closing PHP tags are not required in modern PHP, but it's okay if included at the end
?>
