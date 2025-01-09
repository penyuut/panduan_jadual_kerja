<?php
session_start(); // Make sure to start the session

if (isset($_POST['addToCart'])) {
    $cartItem = json_decode($_POST['item'], true);
    $cartItem['kuantiti'] = $_POST['quantity'];  // Ensure quantity is updated
    $_SESSION['cart'][] = $cartItem; // Add item to the session cart
    echo "Item ditambah";
    exit;
}

if (isset($_POST['removeFromCart'])) {
    $index = $_POST['index'];
    array_splice($_SESSION['cart'], $index, 1); // Remove the item from the session cart
    echo "Item sudah dibatalkan";
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User View</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 0;
            color: #333;
        }

        h1, h2 {
            color: #1E3A8A;
            text-align: center;
        }

        .table-container {
            margin: 30px auto;
            width: 90%;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }

        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #3B82F6;
            color: white;
        }

        table td {
            background-color: #f9fafb;
        }

        .button {
            background-color: blue;
            color: white;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
            border-radius: 5px;
        }

        .button:hover {
            background-color: #2563EB;
        }

        .cart-container {
            margin-top: 40px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .cart-container h3 {
            text-align: center;
            color: #1E3A8A;
        }
    </style>
</head>
<body>
    <h1>User Page</h1>
    <h2>All Parts Items</h2>
    <div id="content">
        <!-- All part data will be displayed here -->
    </div>

    <div class="cart-container">
        <h3>Selected Items</h3>
        <table id="cartTable">
            <tr>
                <th>No</th>
                <th>Keterangan</th>
                <th>BHG</th>
                <th>Bil</th>
                <th>RM</th>
                <th>Kuantiti</th>
                <th>Harga</th>
                <th>Action</th>
            </tr>
            <?php
            $totalAmount = 0;
            foreach ($_SESSION['cart'] as $index => $item) {
                $totalAmount += $item['harga'] * $item['kuantiti'];
                echo "<tr>
                        <td>" . ($index + 1) . "</td>
                        <td>" . $item['keterangan'] . "</td>
                        <td>" . $item['bhg'] . "</td>
                        <td>" . $item['bil'] . "</td>
                        <td>" . number_format($item['harga'], 2) . "</td>
                        <td>" . $item['kuantiti'] . "</td>
                        <td>" . number_format($item['harga'] * $item['kuantiti'], 2) . "</td>
                        <td>
                            <form method='post'>
                                <input type='hidden' name='index' value='$index'>
                                <button type='submit' name='removeFromCart'>Batal</button>
                            </form>
                        </td>
                    </tr>";
            }
            ?>
        </table>

        <p><strong>Jumlah Keseluruhan: </strong> RM <?php echo number_format($totalAmount, 2); ?></p>
    </div>

    <a href="slip_page.php" class="button">Go to User Page</a>

    <script>
        // Function to fetch all parts (A to I) and display them
        function loadAllParts() {
            const contentDiv = document.getElementById('content');
            contentDiv.innerHTML = ''; // Clear existing content

            // Loop through all parts (A to I)
            const parts = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'];
            parts.forEach(part => {
                fetch(`fetch_data.php?part=${part}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            contentDiv.innerHTML = `<h2>Error: ${data.error}</h2>`;
                            return;
                        }

                        let html = `<h3>Part ${part}</h3>`;
                        html += `<div class="table-container">
                                    <table>
                                        <tr>
                                            <th>BIL</th>
                                            <th>KETERANGAN</th>
                                            <th>BHG</th>
                                            <th>UNIT</th>
                                            <th>HARGA 2023</th>
                                            <th>Quantity</th>
                                            <th>Action</th>
                                        </tr>`;

                        data.forEach(row => {
                            html += 
                                `<tr>
                                    <td>${row.bil}</td>
                                    <td>${row.keterangan}</td>
                                    <td>${row.bhg}</td>
                                    <td>${row.unit}</td>
                                    <td>${row.harga}</td>
                                    <td>
                                        <input type="number" id="quantity_${row.bil}" value="1" min="1" />
                                    </td>
                                    <td>
                                        <button class="button" onclick="addToCart(${JSON.stringify(row).replace(/"/g, '&quot;')})">Add to Cart</button>
                                    </td>
                                </tr>`;
                        });

                        html += `</table></div>`;
                        contentDiv.innerHTML += html;
                    })
                    .catch(error => {
                        console.error(error);
                        contentDiv.innerHTML = `<h2>Error loading data</h2>`;
                    });
            });
        }

        // Function to add item to cart
        function addToCart(item) {
            const quantity = document.getElementById(`quantity_${item.bil}`).value;

            if (quantity <= 0 || isNaN(quantity)) {
                alert("Please enter a valid quantity greater than 0.");
                return;
            }

            const cartItem = {
                bil: item.bil,
                keterangan: item.keterangan,
                bhg: item.bhg,
                harga: item.harga,
                kuantiti: quantity
            };

            const formData = new FormData();
            formData.append('addToCart', true);
            formData.append('item', JSON.stringify(cartItem));
            formData.append('quantity', quantity);

            fetch('cart.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                console.log('Server response:', data); // Log server response for debugging
                if (data.includes('Item added to cart')) {
                    location.reload(); // Reload to reflect cart changes
                } else {
                    alert('There was an error adding the item to the cart.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        // Load all parts data when the page loads
        window.onload = loadAllParts;
    </script>
</body>
</html>
