<?php
$conn = new mysqli('localhost', 'root', '', 'jadual');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission for adding items
if (isset($_POST['add_item'])) {
    $item_id = $_POST['item_id'];
    $part = $_POST['part'];
    $quantity = $_POST['quantity'];

    // Validate quantity
    if ($quantity > 0 && is_numeric($item_id)) {
        // Prepare the statement as you are already doing
        $stmt = $conn->prepare("INSERT INTO user_cart (item_id, part, quantity) VALUES (?, ?, ?)");
        $stmt->bind_param("isi", $item_id, $part, $quantity);

        if ($stmt->execute()) {
            echo "<script>alert('Item added successfully!');</script>";
        } else {
            echo "Error adding item: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "<script>alert('Invalid input! Please check the quantity and item ID.');</script>";
    }
}


// Handle item removal from cart
if (isset($_POST['remove_item'])) {
    $cart_id = $_POST['cart_id'];

    // Remove the item from the user_cart table
    $sql = "DELETE FROM user_cart WHERE id = '$cart_id'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Item removed successfully!');</script>";
    } else {
        echo "Error removing item: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            color: #333;
            padding: 20px;
        }

        h1,
        h2 {
            color: #0066cc;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #0066cc;
            color: white;
        }

        button {
            padding: 8px 16px;
            background-color: #0066cc;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #005bb5;
        }

        .section {
    display: none;
}

    </style>
</head>

<body>
    <h1>BAHAGIAN I</h1>

    <!-- Toggle Buttons -->
    <div class="toggle-buttons">
        <button onclick="showPart('a')">BAHAGIAN A</button>
        <button onclick="showPart('b')">BAHAGIAN B</button>
        <button onclick="showPart('c')">BAHAGIAN C</button>
        <button onclick="showPart('d')">BAHAGIAN D</button>
        <button onclick="showPart('e')">BAHAGIAN E</button>
        <button onclick="showPart('f')">BAHAGIAN F</button>
        <button onclick="showPart('g')">BAHAGIAN G</button>
        <button onclick="showPart('h')">BAHAGIAN H</button>
        <button onclick="showPart('i')">BAHAGIAN I</button>

    </div>
    <br><br>

    <!-- Bahagian A Section -->
    <div id="partA" class="section part-a">
        <h2>Bahagian A</h2>
        <table>
            <tr>
                <th>BIL</th>
                <th>KETERANGAN</th>
                <th>UNIT</th>
                <th>HARGA</th>
                <th>KUANTITI</th>
            </tr>
            <?php
            $sql = "SELECT * FROM bahagian_i_a";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['bil'] . "</td>";
                    echo "<td>" . $row['keterangan'] . "</td>";
                    echo "<td>" . $row['unit'] . "</td>";
                    echo "<td>" . $row['harga'] . "</td>";
                    echo "<td>
                            <form method='post' style='display:inline;'>
                                <input type='number' name='quantity' min='1' required>
                                <input type='hidden' name='item_id' value='" . $row['id'] . "'>
                                <input type='hidden' name='part' value='A'>
                                <button type='submit' name='add_item'>Add Item</button>
                            </form>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No items in Bahagian A</td></tr>";
            }
            ?>
        </table>
    </div>

    <!-- Bahagian B Section -->
    <div id="partB" class="section part-b">
        <h2>Bahagian B</h2>
        <table>
            <tr>
                <th>BIL</th>
                <th>KETERANGAN</th>
                <th>UNIT</th>
                <th>HARGA</th>
                <th>KUANTITI</th>
            </tr>
            <?php
            $sql = "SELECT * FROM bahagian_i_b";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['bil'] . "</td>";
                    echo "<td>" . $row['keterangan'] . "</td>";
                    echo "<td>" . $row['unit'] . "</td>";
                    echo "<td>" . $row['harga'] . "</td>";
                    echo "<td>
                            <form method='post' style='display:inline;'>
                                <input type='number' name='quantity' min='1' required>
                                <input type='hidden' name='item_id' value='" . $row['id'] . "'>
                                <input type='hidden' name='part' value='B'>
                                <button type='submit' name='add_item'>Add Item</button>
                            </form>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No items in Bahagian B</td></tr>";
            }
            ?>
        </table>
    </div>

    <!-- Bahagian C Section -->
    <div id="partC" class="section part-c">
        <h2>Bahagian C</h2>
        <table>
            <tr>
                <th>BIL</th>
                <th>KETERANGAN</th>
                <th>UNIT</th>
                <th>HARGA</th>
                <th>KUANTITI</th>
            </tr>
            <?php
            $sql = "SELECT * FROM bahagian_i_c";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['bil'] . "</td>";
                    echo "<td>" . $row['keterangan'] . "</td>";
                    echo "<td>" . $row['unit'] . "</td>";
                    echo "<td>" . $row['harga'] . "</td>";
                    echo "<td>
                        <form method='post' style='display:inline;'>
                            <input type='number' name='quantity' min='1' required>
                            <input type='hidden' name='item_id' value='" . $row['id'] . "'>
                            <input type='hidden' name='part' value='C'>
                            <button type='submit' name='add_item'>Add Item</button>
                        </form>
                      </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No items in Bahagian C</td></tr>";
            }
            ?>
        </table>
    </div>

    <!-- Bahagian D Section -->
    <div id="partD" class="section part-d">
        <h2>Bahagian D</h2>
        <table>
            <tr>
                <th>BIL</th>
                <th>KETERANGAN</th>
                <th>UNIT</th>
                <th>HARGA</th>
                <th>KUANTITI</th>
            </tr>
            <?php
            $sql = "SELECT * FROM bahagian_i_d";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['bil'] . "</td>";
                    echo "<td>" . $row['keterangan'] . "</td>";
                    echo "<td>" . $row['unit'] . "</td>";
                    echo "<td>" . $row['harga'] . "</td>";
                    echo "<td>
                        <form method='post' style='display:inline;'>
                            <input type='number' name='quantity' min='1' required>
                            <input type='hidden' name='item_id' value='" . $row['id'] . "'>
                            <input type='hidden' name='part' value='D'>
                            <button type='submit' name='add_item'>Add Item</button>
                        </form>
                      </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No items in Bahagian D</td></tr>";
            }
            ?>
        </table>
    </div>

    <!-- Bahagian E Section -->
    <div id="partE" class="section part-e">
        <h2>Bahagian E</h2>
        <table>
            <tr>
                <th>BIL</th>
                <th>KETERANGAN</th>
                <th>UNIT</th>
                <th>HARGA</th>
                <th>KUANTITI</th>
            </tr>
            <?php
            $sql = "SELECT * FROM bahagian_i_e";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['bil'] . "</td>";
                    echo "<td>" . $row['keterangan'] . "</td>";
                    echo "<td>" . $row['unit'] . "</td>";
                    echo "<td>" . $row['harga'] . "</td>";
                    echo "<td>
                        <form method='post' style='display:inline;'>
                            <input type='number' name='quantity' min='1' required>
                            <input type='hidden' name='item_id' value='" . $row['id'] . "'>
                            <input type='hidden' name='part' value='E'>
                            <button type='submit' name='add_item'>Add Item</button>
                        </form>
                      </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No items in Bahagian E</td></tr>";
            }
            ?>
        </table>
    </div>

    <!-- Bahagian F Section -->
    <div id="partF" class="section part-f">
        <h2>Bahagian F</h2>
        <table>
            <tr>
                <th>BIL</th>
                <th>KETERANGAN</th>
                <th>UNIT</th>
                <th>HARGA</th>
                <th>KUANTITI</th>
            </tr>
            <?php
            $sql = "SELECT * FROM bahagian_i_f";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['bil'] . "</td>";
                    echo "<td>" . $row['keterangan'] . "</td>";
                    echo "<td>" . $row['unit'] . "</td>";
                    echo "<td>" . $row['harga'] . "</td>";
                    echo "<td>
                        <form method='post' style='display:inline;'>
                            <input type='number' name='quantity' min='1' required>
                            <input type='hidden' name='item_id' value='" . $row['id'] . "'>
                            <input type='hidden' name='part' value='F'>
                            <button type='submit' name='add_item'>Add Item</button>
                        </form>
                      </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No items in Bahagian F</td></tr>";
            }
            ?>
        </table>
    </div>

    <!-- Bahagian G Section -->
    <div id="partG" class="section part-g">
        <h2>Bahagian G</h2>
        <table>
            <tr>
                <th>BIL</th>
                <th>KETERANGAN</th>
                <th>UNIT</th>
                <th>HARGA</th>
                <th>KUANTITI</th>
            </tr>
            <?php
            $sql = "SELECT * FROM bahagian_i_g";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['bil'] . "</td>";
                    echo "<td>" . $row['keterangan'] . "</td>";
                    echo "<td>" . $row['unit'] . "</td>";
                    echo "<td>" . $row['harga'] . "</td>";
                    echo "<td>
                        <form method='post' style='display:inline;'>
                            <input type='number' name='quantity' min='1' required>
                            <input type='hidden' name='item_id' value='" . $row['id'] . "'>
                            <input type='hidden' name='part' value='G'>
                            <button type='submit' name='add_item'>Add Item</button>
                        </form>
                      </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No items in Bahagian G</td></tr>";
            }
            ?>
        </table>
    </div>

    <!-- Bahagian H Section -->
    <div id="partH" class="section part-h">
        <h2>Bahagian H</h2>
        <table>
            <tr>
                <th>BIL</th>
                <th>KETERANGAN</th>
                <th>UNIT</th>
                <th>HARGA</th>
                <th>KUANTITI</th>
            </tr>
            <?php
            $sql = "SELECT * FROM bahagian_i_h";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['bil'] . "</td>";
                    echo "<td>" . $row['keterangan'] . "</td>";
                    echo "<td>" . $row['unit'] . "</td>";
                    echo "<td>" . $row['harga'] . "</td>";
                    echo "<td>
                        <form method='post' style='display:inline;'>
                            <input type='number' name='quantity' min='1' required>
                            <input type='hidden' name='item_id' value='" . $row['id'] . "'>
                            <input type='hidden' name='part' value='H'>
                            <button type='submit' name='add_item'>Add Item</button>
                        </form>
                      </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No items in Bahagian H</td></tr>";
            }
            ?>
        </table>
    </div>

    <!-- Bahagian I Section -->
<div id="partI" class="section part-i">
    <h2>Bahagian I</h2>
    <table>
        <tr>
            <th>BIL</th>
            <th>KETERANGAN</th>
            <th>UNIT</th>
            <th>HARGA</th>
            <th>KUANTITI</th>
        </tr>
        <?php
        $sql = "SELECT * FROM bahagian_i_i";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['bil'] . "</td>";
                echo "<td>" . $row['keterangan'] . "</td>";
                echo "<td>" . $row['unit'] . "</td>";
                echo "<td>" . $row['harga'] . "</td>";
                echo "<td>
                    <form method='post' style='display:inline;'>
                        <input type='number' name='quantity' min='1' required>
                        <input type='hidden' name='item_id' value='" . $row['id'] . "'>
                        <input type='hidden' name='part' value='I'>
                        <button type='submit' name='add_item'>Add Item</button>
                    </form>
                  </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No items in Bahagian I</td></tr>";
        }
        ?>
    </table>
</div>



    <!-- Unified Selected Items Section (Both Bahagian A & B) -->
    <h2>ITEM YANG DIPILIH</h2>
    <table>
        <tr>
            <th>No</th>
            <th>Keterangan</th>
            <th>Bhg.</th>
            <th>Bil.</th>
            <th>RM</th>
            <th>Kuantiti</th>
            <th>Harga</th>
            <th></th>
        </tr>
        <?php
      $sql = "SELECT 
    uc.id AS cart_id, 
    uc.quantity, 
    bia.keterangan, 
    bia.bil, 
    bia.harga AS price,
    'I' AS part  -- Set part to 'I' for all items
FROM user_cart uc 
INNER JOIN (
    SELECT id, keterangan, bil, harga FROM bahagian_i_a 
    UNION ALL 
    SELECT id, keterangan, bil, harga FROM bahagian_i_b
    UNION ALL 
    SELECT id, keterangan, bil, harga FROM bahagian_i_c
    UNION ALL 
    SELECT id, keterangan, bil, harga FROM bahagian_i_d
    UNION ALL 
    SELECT id, keterangan, bil, harga FROM bahagian_i_e
    UNION ALL 
    SELECT id, keterangan, bil, harga FROM bahagian_i_f
    UNION ALL 
    SELECT id, keterangan, bil, harga FROM bahagian_i_g
    UNION ALL 
    SELECT id, keterangan, bil, harga FROM bahagian_i_h
    UNION ALL 
    SELECT id, keterangan, bil, harga FROM bahagian_i_i
) bia 
ON uc.item_id = bia.id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $no = 1; // Counter for the "No" column
            while ($row = $result->fetch_assoc()) {
                $total_harga = $row['quantity'] * $row['price']; // Calculate total price
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . $row['keterangan'] . "</td>";
                echo "<td>" . $row['part'] . "</td>"; // Display page (e.g., "I")
                echo "<td>" . $row['bil'] . "</td>";
                echo "<td>" . number_format($row['price'], 2) . "</td>";
                echo "<td>" . $row['quantity'] . "</td>";
                echo "<td>" . number_format($total_harga, 2) . "</td>";
                echo "<td>
                    <form method='post' style='display:inline;'>
                        <input type='hidden' name='cart_id' value='" . $row['cart_id'] . "'>
                        <button type='submit' name='remove_item'>Remove</button>
                    </form>
                  </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>Tiada item dipilih</td></tr>";
        }
        ?>
    </table>


    <!-- Add this below the table displaying selected items -->
    <a href="slip_page.php"
        style="display:inline-block; padding: 10px 20px; background-color: #0066cc; color: white; text-decoration: none; border-radius: 5px;">Hasilkan
        Slip</a>


  <script>
      // Function to show the corresponding part when a button is clicked
    function showPart(part) {
        // Hide all sections
        const sections = document.querySelectorAll('.section');
        sections.forEach(function (section) {
            section.style.display = 'none';
        });

        // Show the clicked section
        const sectionToShow = document.getElementById('part' + part.toUpperCase());
        if (sectionToShow) {
            sectionToShow.style.display = 'block';
        }
    }

    // Initialize the page with 'Bahagian A' visible by default
    document.addEventListener('DOMContentLoaded', function () {
        showPart('a');
    });
</script>


</body>

</html>




