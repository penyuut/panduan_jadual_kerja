<?php
include 'db_connection.php'; // Include your DB connection

// Fetch data for selected items
$selected_items_result = $conn->query("SELECT * FROM selected_items");

// Fetch data for approved items
$approved_items_result = $conn->query("SELECT * FROM approved_items");

// Calculate totals for Selected Items
$selected_items_total = 0;
if ($selected_items_result->num_rows > 0) {
    while ($row = $selected_items_result->fetch_assoc()) {
        $selected_items_total += $row['price'] * $row['quantity'];
    }
}

// Calculate totals for Approved Items
$approved_items_total = 0;
if ($approved_items_result->num_rows > 0) {
    while ($row = $approved_items_result->fetch_assoc()) {
        $approved_items_total += $row['price'] * $row['quantity'];
    }
}

// Final Total
$final_total = $selected_items_total + $approved_items_total;

// Return the calculated total
echo number_format($final_total, 2);
?>
