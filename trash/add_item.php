<?php
// Include the database connection
include('db_connect.php');  // Replace this with your actual database connection file

// Check if the form has been submitted
if (isset($_POST['add_item'])) {
    // Debug: Print the POST data to check if it's being received correctly
    var_dump($_POST);  // This will print the form data for debugging

    // Get the POST data
    $item_id = $_POST['item_id']; // The item ID
    $part = $_POST['part']; // The part (e.g., Bahagian C)
    $quantity = $_POST['quantity']; // The quantity selected by the user

    // Check if the data is not empty
    if (!empty($item_id) && !empty($quantity)) {
        // Prepare the SQL query to insert the item into the user_cart
        $stmt = $conn->prepare("INSERT INTO user_cart (item_id, part, quantity) VALUES (?, ?, ?)");
        $stmt->bind_param("isi", $item_id, $part, $quantity);  // Bind the parameters: item_id (integer), part (string), quantity (integer)

        // Execute the query and check if it was successful
        if ($stmt->execute()) {
            // If successful, show a success message
            echo "<script>alert('Item added to cart successfully!');</script>";
        } else {
            // If there was an error, show the error message
            echo "Error adding item: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        // If required fields are missing, show an error message
        echo "<script>alert('Please fill in all fields.');</script>";
    }
}

// Close the database connection
$conn->close();
?>

<!-- HTML Form to Add Item -->
<form method="post" style="display:inline;">
    <!-- Input fields for quantity and hidden values for item_id and part -->
    <label for="quantity">Quantity:</label>
    <input type="number" name="quantity" min="1" required>
    <input type="hidden" name="item_id" value="123"> <!-- Example Item ID, replace with dynamic ID -->
    <input type="hidden" name="part" value="C"> <!-- Hardcoded 'C' for Bahagian C, can be dynamic if needed -->
    <button type="submit" name="add_item">Add Item</button>
</form>
