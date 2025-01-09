<?php
$conn = new mysqli('localhost', 'root', '', 'jadual');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission for Part A (Tambah Item)
if (isset($_POST['save_part_a'])) {
    $bil = $_POST['bil_a'];
    $keterangan = $_POST['keterangan_a'];
    $unit = $_POST['unit_a'];
    $harga = $_POST['harga_a'];

    $sql = "INSERT INTO bahagian_i_a (bil, keterangan, unit, harga) VALUES ('$bil', '$keterangan', '$unit', '$harga')";
    $conn->query($sql);
}

// Handle form submission for Part B (Tambah Item)
if (isset($_POST['save_part_b'])) {
    $bil = $_POST['bil_b'];
    $keterangan = $_POST['keterangan_b'];
    $unit = $_POST['unit_b'];
    $harga = $_POST['harga_b'];

    $sql = "INSERT INTO bahagian_i_b (bil, keterangan, unit, harga) VALUES ('$bil', '$keterangan', '$unit', '$harga')";
    $conn->query($sql);
}

// Handle form submission for Part C (Tambah Item)
if (isset($_POST['save_part_c'])) {
    $bil = $_POST['bil_c'];
    $keterangan = $_POST['keterangan_c'];
    $unit = $_POST['unit_c'];
    $harga = $_POST['harga_c'];

    $sql = "INSERT INTO bahagian_i_c (bil, keterangan, unit, harga) VALUES ('$bil', '$keterangan', '$unit', '$harga')";
    $conn->query($sql);
}

// Handle form submission for Part D (Tambah Item)
if (isset($_POST['save_part_d'])) {
    $bil = $_POST['bil_d'];
    $keterangan = $_POST['keterangan_d'];
    $unit = $_POST['unit_d'];
    $harga = $_POST['harga_d'];

    $sql = "INSERT INTO bahagian_i_d (bil, keterangan, unit, harga) VALUES ('$bil', '$keterangan', '$unit', '$harga')";
    $conn->query($sql);
}

// Handle form submission for Part E (Tambah Item)
if (isset($_POST['save_part_e'])) {
    $bil = $_POST['bil_e'];
    $keterangan = $_POST['keterangan_e'];
    $unit = $_POST['unit_e'];
    $harga = $_POST['harga_e'];

    $sql = "INSERT INTO bahagian_i_e (bil, keterangan, unit, harga) VALUES ('$bil', '$keterangan', '$unit', '$harga')";
    $conn->query($sql);
}

// Handle form submission for Part F (Tambah Item)
if (isset($_POST['save_part_f'])) {
    $bil = $_POST['bil_f'];
    $keterangan = $_POST['keterangan_f'];
    $unit = $_POST['unit_f'];
    $harga = $_POST['harga_f'];

    $sql = "INSERT INTO bahagian_i_f (bil, keterangan, unit, harga) VALUES ('$bil', '$keterangan', '$unit', '$harga')";
    $conn->query($sql);
}

// Handle form submission for Part G (Tambah Item)
if (isset($_POST['save_part_g'])) {
    $bil = $_POST['bil_g'];
    $keterangan = $_POST['keterangan_g'];
    $unit = $_POST['unit_g'];
    $harga = $_POST['harga_g'];

    $sql = "INSERT INTO bahagian_i_g (bil, keterangan, unit, harga) VALUES ('$bil', '$keterangan', '$unit', '$harga')";
    $conn->query($sql);
}

// Handle form submission for Part H (Tambah Item)
if (isset($_POST['save_part_h'])) {
    $bil = $_POST['bil_h'];
    $keterangan = $_POST['keterangan_h'];
    $unit = $_POST['unit_h'];
    $harga = $_POST['harga_h'];

    $sql = "INSERT INTO bahagian_i_h (bil, keterangan, unit, harga) VALUES ('$bil', '$keterangan', '$unit', '$harga')";
    $conn->query($sql);
}

// Handle form submission for Part I (Tambah Item)
if (isset($_POST['save_part_i'])) {
    $bil = $_POST['bil_i'];
    $keterangan = $_POST['keterangan_i'];
    $unit = $_POST['unit_i'];
    $harga = $_POST['harga_i'];

    $sql = "INSERT INTO bahagian_i_i (bil, keterangan, unit, harga) VALUES ('$bil', '$keterangan', '$unit', '$harga')";
    $conn->query($sql);
}


// Handle edit request for Part A
if (isset($_GET['edit_part_a'])) {
    $id = $_GET['edit_part_a'];  // Get the ID of the item to edit

    // Fetch the item from the database
    $sql = "SELECT * FROM bahagian_i_a WHERE id = '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

// Handle update request for Part A
if (isset($_POST['update_part_a'])) {
    $id = $_POST['edit_id_a'];
    $bil = $_POST['bil_a'];
    $keterangan = $_POST['keterangan_a'];
    $unit = $_POST['unit_a'];
    $harga = $_POST['harga_a'];

    $sql = "UPDATE bahagian_i_a SET bil='$bil', keterangan='$keterangan', unit='$unit', harga='$harga' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Item updated successfully!";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Handle delete request for Part A
if (isset($_POST['delete_part_a'])) {
    $id = $_POST['delete_part_a'];

    // Delete the item from the database
    $sql = "DELETE FROM bahagian_i_a WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Item deleted successfully!";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Handle edit request for Part B
if (isset($_GET['edit_part_b'])) {
    $id = $_GET['edit_part_b'];  // Get the ID of the item to edit

    // Fetch the item from the database
    $sql = "SELECT * FROM bahagian_i_b WHERE id = '$id'";
    $result = $conn->query($sql);
    $row_b = $result->fetch_assoc();
}

// Handle update request for Part B
if (isset($_POST['update_part_b'])) {
    $id = $_POST['edit_id_b'];
    $bil = $_POST['bil_b'];
    $keterangan = $_POST['keterangan_b'];
    $unit = $_POST['unit_b'];
    $harga = $_POST['harga_b'];

    $sql = "UPDATE bahagian_i_b SET bil='$bil', keterangan='$keterangan', unit='$unit', harga='$harga' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Item updated successfully!";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Handle delete request for Part B
if (isset($_POST['delete_part_b'])) {
    $id = $_POST['delete_part_b'];

    // Delete the item from the database
    $sql = "DELETE FROM bahagian_i_b WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Item deleted successfully!";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Handle edit request for Part C
if (isset($_GET['edit_part_c'])) {
    $id = $_GET['edit_part_c'];  // Get the ID of the item to edit

    // Fetch the item from the database
    $sql = "SELECT * FROM bahagian_i_c WHERE id = '$id'";
    $result = $conn->query($sql);
    $row_c = $result->fetch_assoc();
}

// Handle update request for Part C
if (isset($_POST['update_part_c'])) {
    $id = $_POST['edit_id_c'];
    $bil = $_POST['bil_c'];
    $keterangan = $_POST['keterangan_c'];
    $unit = $_POST['unit_c'];
    $harga = $_POST['harga_c'];

    $sql = "UPDATE bahagian_i_c SET bil='$bil', keterangan='$keterangan', unit='$unit', harga='$harga' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Item updated successfully!";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Handle delete request for Part C
if (isset($_POST['delete_part_c'])) {
    $id = $_POST['delete_part_c'];

    // Delete the item from the database
    $sql = "DELETE FROM bahagian_i_c WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Item deleted successfully!";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Handle edit request for Part D
if (isset($_GET['edit_part_d'])) {
    $id = $_GET['edit_part_d'];  // Get the ID of the item to edit

    // Fetch the item from the database
    $sql = "SELECT * FROM bahagian_i_d WHERE id = '$id'";
    $result = $conn->query($sql);
    $row_d = $result->fetch_assoc();
}

// Handle update request for Part D
if (isset($_POST['update_part_d'])) {
    $id = $_POST['edit_id_d'];
    $bil = $_POST['bil_d'];
    $keterangan = $_POST['keterangan_d'];
    $unit = $_POST['unit_d'];
    $harga = $_POST['harga_d'];

    $sql = "UPDATE bahagian_i_d SET bil='$bil', keterangan='$keterangan', unit='$unit', harga='$harga' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Item updated successfully!";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Handle delete request for Part D
if (isset($_POST['delete_part_d'])) {
    $id = $_POST['delete_part_d'];

    // Delete the item from the database
    $sql = "DELETE FROM bahagian_i_d WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Item deleted successfully!";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Handle edit request for Part E
if (isset($_GET['edit_part_e'])) {
    $id = $_GET['edit_part_e'];  // Get the ID of the item to edit

    // Fetch the item from the database
    $sql = "SELECT * FROM bahagian_i_e WHERE id = '$id'";
    $result = $conn->query($sql);
    $row_e = $result->fetch_assoc();
}

// Handle update request for Part E
if (isset($_POST['update_part_e'])) {
    $id = $_POST['edit_id_e'];
    $bil = $_POST['bil_e'];
    $keterangan = $_POST['keterangan_e'];
    $unit = $_POST['unit_e'];
    $harga = $_POST['harga_e'];

    $sql = "UPDATE bahagian_i_e SET bil='$bil', keterangan='$keterangan', unit='$unit', harga='$harga' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Item updated successfully!";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Handle delete request for Part E
if (isset($_POST['delete_part_e'])) {
    $id = $_POST['delete_part_e'];

    // Delete the item from the database
    $sql = "DELETE FROM bahagian_i_e WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Item deleted successfully!";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Handle edit request for Part F
if (isset($_GET['edit_part_f'])) {
    $id = $_GET['edit_part_f'];  // Get the ID of the item to edit

    // Fetch the item from the database
    $sql = "SELECT * FROM bahagian_i_f WHERE id = '$id'";
    $result = $conn->query($sql);
    $row_f = $result->fetch_assoc();
}

// Handle update request for Part F
if (isset($_POST['update_part_f'])) {
    $id = $_POST['edit_id_f'];
    $bil = $_POST['bil_f'];
    $keterangan = $_POST['keterangan_f'];
    $unit = $_POST['unit_f'];
    $harga = $_POST['harga_f'];

    $sql = "UPDATE bahagian_i_f SET bil='$bil', keterangan='$keterangan', unit='$unit', harga='$harga' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Item updated successfully!";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Handle delete request for Part F
if (isset($_POST['delete_part_f'])) {
    $id = $_POST['delete_part_f'];

    // Delete the item from the database
    $sql = "DELETE FROM bahagian_i_f WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Item deleted successfully!";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Handle edit request for Part G
if (isset($_GET['edit_part_g'])) {
    $id = $_GET['edit_part_g'];  // Get the ID of the item to edit

    // Fetch the item from the database
    $sql = "SELECT * FROM bahagian_i_g WHERE id = '$id'";
    $result = $conn->query($sql);
    $row_g = $result->fetch_assoc();
}

// Handle update request for Part G
if (isset($_POST['update_part_g'])) {
    $id = $_POST['edit_id_g'];
    $bil = $_POST['bil_g'];
    $keterangan = $_POST['keterangan_g'];
    $unit = $_POST['unit_g'];
    $harga = $_POST['harga_g'];

    $sql = "UPDATE bahagian_i_g SET bil='$bil', keterangan='$keterangan', unit='$unit', harga='$harga' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Item updated successfully!";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Handle delete request for Part G
if (isset($_POST['delete_part_g'])) {
    $id = $_POST['delete_part_g'];

    // Delete the item from the database
    $sql = "DELETE FROM bahagian_i_g WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Item deleted successfully!";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Handle edit request for Part H
if (isset($_GET['edit_part_h'])) {
    $id = $_GET['edit_part_h'];  // Get the ID of the item to edit

    // Fetch the item from the database
    $sql = "SELECT * FROM bahagian_i_h WHERE id = '$id'";
    $result = $conn->query($sql);
    $row_h = $result->fetch_assoc();
}

// Handle update request for Part H
if (isset($_POST['update_part_h'])) {
    $id = $_POST['edit_id_h'];
    $bil = $_POST['bil_h'];
    $keterangan = $_POST['keterangan_h'];
    $unit = $_POST['unit_h'];
    $harga = $_POST['harga_h'];

    $sql = "UPDATE bahagian_i_h SET bil='$bil', keterangan='$keterangan', unit='$unit', harga='$harga' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Item updated successfully!";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Handle delete request for Part H
if (isset($_POST['delete_part_h'])) {
    $id = $_POST['delete_part_h'];

    // Delete the item from the database
    $sql = "DELETE FROM bahagian_i_h WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Item deleted successfully!";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Handle edit request for Part I
if (isset($_GET['edit_part_i'])) {
    $id = $_GET['edit_part_i'];  // Get the ID of the item to edit

    // Fetch the item from the database
    $sql = "SELECT * FROM bahagian_i_i WHERE id = '$id'";
    $result = $conn->query($sql);
    $row_i = $result->fetch_assoc();
}

// Handle update request for Part I
if (isset($_POST['update_part_i'])) {
    $id = $_POST['edit_id_i'];
    $bil = $_POST['bil_i'];
    $keterangan = $_POST['keterangan_i'];
    $unit = $_POST['unit_i'];
    $harga = $_POST['harga_i'];

    $sql = "UPDATE bahagian_i_i SET bil='$bil', keterangan='$keterangan', unit='$unit', harga='$harga' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Item updated successfully!";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Handle delete request for Part I
if (isset($_POST['delete_part_i'])) {
    $id = $_POST['delete_part_i'];

    // Delete the item from the database
    $sql = "DELETE FROM bahagian_i_i WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Item deleted successfully!";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bahagian I_Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            color: #333;
            padding: 20px;
        }

        h1 {
            color: #0066cc;
        }

        .section {
            margin-bottom: 40px;
        }

        .form-section {
            margin-bottom: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        table th,
        table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #0066cc;
        }

        table th {
            background-color: #0066cc;
            color: white;
        }

        button {
            display: block;
            margin-top: 10px;
            background-color: #0066cc;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 4px;
        }

        button:hover {
            background-color: #005bb5;
        }

        hr {
            border: 1px dashed #ccc;
        }

        .form-section label {
            display: block;
            margin-bottom: 5px;
        }

        .form-section input,
        .form-section textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-section button {
            background-color: #0066cc;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 4px;
        }

        .form-section button:hover {
            background-color: #005bb5;
        }

        /* Optional: Adding some specific styles for Part A and Part B */
        .part-a,
        .part-b {
            background-color: #e0f7ff;
            padding: 20px;
            border: 1px solid #0066cc;
            border-radius: 5px;
        }

        /* Floating Modal Styles */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Style for Table and Buttons */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
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
    </style>

</head>

<body>
    <h1>KEMAS KINI : BAHAGIAN I</h1>

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
    <br>
    <br>


    <!-- Part A Section -->
    <div id="partA" class="section part-a">
        <h2>BAHAGIAN A</h2>

        <!-- Form to Add New Item -->
        <h3>Tambah Item Bahagian A</h3>
        <div class="form-section">
            <form method="post">
                <label>Bil : </label><br>
                <input type="text" name="bil_a" required><br><br>

                <label>Keterangan : </label><br>
                <textarea name="keterangan_a" rows="5" required></textarea><br><br>

                <label>Unit :</label><br>
                <input type="text" name="unit_a" required><br><br>

                <label>Harga : </label><br>
                <input type="number" step="0.01" name="harga_a" required><br><br>

                <button type="submit" name="save_part_a">Tambah Item</button>
            </form>
        </div>

        <!-- Display Part A Data -->
        <h3>SENARAI ITEM BAHAGIAN A</h3>
        <table>
            <tr>
                <th>BIL</th>
                <th>KETERANGAN</th>
                <th>UNIT</th>
                <th>HARGA 2023</th>
                <th>ACTIONS</th>
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
                            <button onclick='openModal(" . $row['id'] . ", \"a\")'>Edit</button>
                            <form method='post' style='display:inline;'>
                                <button type='submit' name='delete_part_a' value='" . $row['id'] . "'>Delete</button>
                            </form>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No data available for Part A</td></tr>";
            }
            ?>
        </table>
    </div>

    <!-- Floating Modal for Edit Item -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Edit Item Bahagian A</h2>
            <form method="post" id="editFormA">
                <label>Bil : </label><br>
                <input type="text" name="bil_a" required><br><br>

                <label>Keterangan : </label><br>
                <textarea name="keterangan_a" rows="5" required></textarea><br><br>

                <label>Unit :</label><br>
                <input type="text" name="unit_a" required><br><br>

                <label>Harga :</label><br>
                <input type="number" step="0.01" name="harga_a" required><br><br>

                <input type="hidden" name="edit_id_a">
                <button type="submit" name="update_part_a">Update Item</button>
            </form>
        </div>
    </div>

    <!-- Part B Section -->
    <div id="partB" class="section part-b">
        <h2>BAHAGIAN B</h2>

        <!-- Form to Add New Item -->
        <h3>Tambah Item Bahagian B</h3>
        <div class="form-section">
            <form method="post">
                <label>Bil : </label><br>
                <input type="text" name="bil_b" required><br><br>

                <label>Keterangan : </label><br>
                <textarea name="keterangan_b" rows="5" required></textarea><br><br>

                <label>Unit :</label><br>
                <input type="text" name="unit_b" required><br><br>

                <label>Harga : </label><br>
                <input type="number" step="0.01" name="harga_b" required><br><br>

                <button type="submit" name="save_part_b">Tambah Item</button>
            </form>
        </div>

        <!-- Display Part B Data -->
        <h3>SENARAI ITEM BAHAGIAN B</h3>
        <table>
            <tr>
                <th>BIL</th>
                <th>KETERANGAN</th>
                <th>UNIT</th>
                <th>HARGA 2023</th>
                <th>ACTIONS</th>
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
                            <button onclick='openModal(" . $row['id'] . ", \"b\")'>Edit</button>
                            <form method='post' style='display:inline;'>
                                <button type='submit' name='delete_part_b' value='" . $row['id'] . "'>Delete</button>
                            </form>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No data available for Part B</td></tr>";
            }
            ?>
        </table>
    </div>

    <!-- Floating Modal for Edit Item - Part B -->
    <div id="editModalB" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('B')">&times;</span>
            <h2>Edit Item Bahagian B</h2>
            <form method="post" id="editFormB">
                <label>Bil : </label><br>
                <input type="text" name="bil_b" required><br><br>

                <label>Keterangan : </label><br>
                <textarea name="keterangan_b" rows="5" required></textarea><br><br>

                <label>Unit :</label><br>
                <input type="text" name="unit_b" required><br><br>

                <label>Harga :</label><br>
                <input type="number" step="0.01" name="harga_b" required><br><br>

                <input type="hidden" name="edit_id_b">
                <button type="submit" name="update_part_b">Update Item</button>
            </form>
        </div>
    </div>

    <!-- Part C Section -->
    <div id="partC" class="section part-c">
        <h2>BAHAGIAN C</h2>

        <!-- Form to Add New Item -->
        <h3>Tambah Item Bahagian C</h3>
        <div class="form-section">
            <form method="post">
                <label>Bil : </label><br>
                <input type="text" name="bil_c" required><br><br>

                <label>Keterangan : </label><br>
                <textarea name="keterangan_c" rows="5" required></textarea><br><br>

                <label>Unit :</label><br>
                <input type="text" name="unit_c" required><br><br>

                <label>Harga : </label><br>
                <input type="number" step="0.01" name="harga_c" required><br><br>

                <button type="submit" name="save_part_c">Tambah Item</button>
            </form>
        </div>

        <!-- Display Part C Data -->
        <h3>SENARAI ITEM BAHAGIAN C</h3>
        <table>
            <tr>
                <th>BIL</th>
                <th>KETERANGAN</th>
                <th>UNIT</th>
                <th>HARGA 2023</th>
                <th>ACTIONS</th>
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
                        <button onclick='openModal(" . $row['id'] . ", \"c\")'>Edit</button>
                        <form method='post' style='display:inline;'>
                            <button type='submit' name='delete_part_c' value='" . $row['id'] . "'>Delete</button>
                        </form>
                      </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No data available for Part C</td></tr>";
            }
            ?>
        </table>
    </div>

    <!-- Floating Modal for Edit Item - Part C -->
    <div id="editModalC" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('C')">&times;</span>
            <h2>Edit Item Bahagian C</h2>
            <form method="post" id="editFormC">
                <label>Bil : </label><br>
                <input type="text" name="bil_c" required><br><br>

                <label>Keterangan : </label><br>
                <textarea name="keterangan_c" rows="5" required></textarea><br><br>

                <label>Unit :</label><br>
                <input type="text" name="unit_c" required><br><br>

                <label>Harga :</label><br>
                <input type="number" step="0.01" name="harga_c" required><br><br>

                <input type="hidden" name="edit_id_c">
                <button type="submit" name="update_part_c">Update Item</button>
            </form>
        </div>
    </div>

    <!-- Part D Section -->
    <div id="partD" class="section part-d">
        <h2>BAHAGIAN D</h2>

        <!-- Form to Add New Item -->
        <h3>Tambah Item Bahagian D</h3>
        <div class="form-section">
            <form method="post">
                <label>Bil : </label><br>
                <input type="text" name="bil_d" required><br><br>

                <label>Keterangan : </label><br>
                <textarea name="keterangan_d" rows="5" required></textarea><br><br>

                <label>Unit :</label><br>
                <input type="text" name="unit_d" required><br><br>

                <label>Harga : </label><br>
                <input type="number" step="0.01" name="harga_d" required><br><br>

                <button type="submit" name="save_part_d">Tambah Item</button>
            </form>
        </div>

        <!-- Display Part D Data -->
        <h3>SENARAI ITEM BAHAGIAN D</h3>
        <table>
            <tr>
                <th>BIL</th>
                <th>KETERANGAN</th>
                <th>UNIT</th>
                <th>HARGA 2023</th>
                <th>ACTIONS</th>
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
                        <button onclick='openModal(" . $row['id'] . ", \"d\")'>Edit</button>
                        <form method='post' style='display:inline;'>
                            <button type='submit' name='delete_part_d' value='" . $row['id'] . "'>Delete</button>
                        </form>
                      </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No data available for Part D</td></tr>";
            }
            ?>
        </table>
    </div>

    <!-- Floating Modal for Edit Item - Part D -->
    <div id="editModalD" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('D')">&times;</span>
            <h2>Edit Item Bahagian D</h2>
            <form method="post" id="editFormD">
                <label>Bil : </label><br>
                <input type="text" name="bil_d" required><br><br>

                <label>Keterangan : </label><br>
                <textarea name="keterangan_d" rows="5" required></textarea><br><br>

                <label>Unit :</label><br>
                <input type="text" name="unit_d" required><br><br>

                <label>Harga :</label><br>
                <input type="number" step="0.01" name="harga_d" required><br><br>

                <input type="hidden" name="edit_id_d">
                <button type="submit" name="update_part_d">Update Item</button>
            </form>
        </div>
    </div>

    <!-- Part E Section -->
    <div id="partE" class="section part-e">
        <h2>BAHAGIAN E</h2>

        <!-- Form to Add New Item -->
        <h3>Tambah Item Bahagian E</h3>
        <div class="form-section">
            <form method="post">
                <label>Bil : </label><br>
                <input type="text" name="bil_e" required><br><br>

                <label>Keterangan : </label><br>
                <textarea name="keterangan_e" rows="5" required></textarea><br><br>

                <label>Unit :</label><br>
                <input type="text" name="unit_e" required><br><br>

                <label>Harga : </label><br>
                <input type="number" step="0.01" name="harga_e" required><br><br>

                <button type="submit" name="save_part_e">Tambah Item</button>
            </form>
        </div>

        <!-- Display Part E Data -->
        <h3>SENARAI ITEM BAHAGIAN E</h3>
        <table>
            <tr>
                <th>BIL</th>
                <th>KETERANGAN</th>
                <th>UNIT</th>
                <th>HARGA 2023</th>
                <th>ACTIONS</th>
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
                        <button onclick='openModal(" . $row['id'] . ", \"e\")'>Edit</button>
                        <form method='post' style='display:inline;'>
                            <button type='submit' name='delete_part_e' value='" . $row['id'] . "'>Delete</button>
                        </form>
                      </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No data available for Part E</td></tr>";
            }
            ?>
        </table>
    </div>

    <!-- Floating Modal for Edit Item - Part E -->
    <div id="editModalE" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('E')">&times;</span>
            <h2>Edit Item Bahagian E</h2>
            <form method="post" id="editFormE">
                <label>Bil : </label><br>
                <input type="text" name="bil_e" required><br><br>

                <label>Keterangan : </label><br>
                <textarea name="keterangan_e" rows="5" required></textarea><br><br>

                <label>Unit :</label><br>
                <input type="text" name="unit_e" required><br><br>

                <label>Harga :</label><br>
                <input type="number" step="0.01" name="harga_e" required><br><br>

                <input type="hidden" name="edit_id_e">
                <button type="submit" name="update_part_e">Update Item</button>
            </form>
        </div>
    </div>

    <!-- Part F Section -->
    <div id="partF" class="section part-f">
        <h2>BAHAGIAN F</h2>

        <!-- Form to Add New Item -->
        <h3>Tambah Item Bahagian F</h3>
        <div class="form-section">
            <form method="post">
                <label>Bil : </label><br>
                <input type="text" name="bil_f" required><br><br>

                <label>Keterangan : </label><br>
                <textarea name="keterangan_f" rows="5" required></textarea><br><br>

                <label>Unit :</label><br>
                <input type="text" name="unit_f" required><br><br>

                <label>Harga : </label><br>
                <input type="number" step="0.01" name="harga_f" required><br><br>

                <button type="submit" name="save_part_f">Tambah Item</button>
            </form>
        </div>

        <!-- Display Part F Data -->
        <h3>SENARAI ITEM BAHAGIAN F</h3>
        <table>
            <tr>
                <th>BIL</th>
                <th>KETERANGAN</th>
                <th>UNIT</th>
                <th>HARGA 2023</th>
                <th>ACTIONS</th>
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
                        <button onclick='openModal(" . $row['id'] . ", \"f\")'>Edit</button>
                        <form method='post' style='display:inline;'>
                            <button type='submit' name='delete_part_f' value='" . $row['id'] . "'>Delete</button>
                        </form>
                      </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No data available for Part F</td></tr>";
            }
            ?>
        </table>
    </div>

    <!-- Floating Modal for Edit Item - Part F -->
    <div id="editModalF" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('F')">&times;</span>
            <h2>Edit Item Bahagian F</h2>
            <form method="post" id="editFormF">
                <label>Bil : </label><br>
                <input type="text" name="bil_f" required><br><br>

                <label>Keterangan : </label><br>
                <textarea name="keterangan_f" rows="5" required></textarea><br><br>

                <label>Unit :</label><br>
                <input type="text" name="unit_f" required><br><br>

                <label>Harga :</label><br>
                <input type="number" step="0.01" name="harga_f" required><br><br>

                <input type="hidden" name="edit_id_f">
                <button type="submit" name="update_part_f">Update Item</button>
            </form>
        </div>
    </div>

    <!-- Part G Section -->
    <div id="partG" class="section part-g">
        <h2>BAHAGIAN G</h2>

        <!-- Form to Add New Item -->
        <h3>Tambah Item Bahagian G</h3>
        <div class="form-section">
            <form method="post">
                <label>Bil : </label><br>
                <input type="text" name="bil_g" required><br><br>

                <label>Keterangan : </label><br>
                <textarea name="keterangan_g" rows="5" required></textarea><br><br>

                <label>Unit :</label><br>
                <input type="text" name="unit_g" required><br><br>

                <label>Harga : </label><br>
                <input type="number" step="0.01" name="harga_g" required><br><br>

                <button type="submit" name="save_part_g">Tambah Item</button>
            </form>
        </div>

        <!-- Display Part G Data -->
        <h3>SENARAI ITEM BAHAGIAN G</h3>
        <table>
            <tr>
                <th>BIL</th>
                <th>KETERANGAN</th>
                <th>UNIT</th>
                <th>HARGA 2023</th>
                <th>ACTIONS</th>
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
                        <button onclick='openModal(" . $row['id'] . ", \"g\")'>Edit</button>
                        <form method='post' style='display:inline;'>
                            <button type='submit' name='delete_part_g' value='" . $row['id'] . "'>Delete</button>
                        </form>
                      </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No data available for Part G</td></tr>";
            }
            ?>
        </table>
    </div>

    <!-- Floating Modal for Edit Item - Part G -->
    <div id="editModalG" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('G')">&times;</span>
            <h2>Edit Item Bahagian G</h2>
            <form method="post" id="editFormG">
                <label>Bil : </label><br>
                <input type="text" name="bil_g" required><br><br>

                <label>Keterangan : </label><br>
                <textarea name="keterangan_g" rows="5" required></textarea><br><br>

                <label>Unit :</label><br>
                <input type="text" name="unit_g" required><br><br>

                <label>Harga :</label><br>
                <input type="number" step="0.01" name="harga_g" required><br><br>

                <input type="hidden" name="edit_id_g">
                <button type="submit" name="update_part_g">Update Item</button>
            </form>
        </div>
    </div>

    <!-- Part H Section -->
    <div id="partH" class="section part-h">
        <h2>BAHAGIAN H</h2>

        <!-- Form to Add New Item -->
        <h3>Tambah Item Bahagian H</h3>
        <div class="form-section">
            <form method="post">
                <label>Bil : </label><br>
                <input type="text" name="bil_h" required><br><br>

                <label>Keterangan : </label><br>
                <textarea name="keterangan_h" rows="5" required></textarea><br><br>

                <label>Unit :</label><br>
                <input type="text" name="unit_h" required><br><br>

                <label>Harga : </label><br>
                <input type="number" step="0.01" name="harga_h" required><br><br>

                <button type="submit" name="save_part_h">Tambah Item</button>
            </form>
        </div>

        <!-- Display Part H Data -->
        <h3>SENARAI ITEM BAHAGIAN H</h3>
        <table>
            <tr>
                <th>BIL</th>
                <th>KETERANGAN</th>
                <th>UNIT</th>
                <th>HARGA 2023</th>
                <th>ACTIONS</th>
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
                        <button onclick='openModal(" . $row['id'] . ", \"h\")'>Edit</button>
                        <form method='post' style='display:inline;'>
                            <button type='submit' name='delete_part_h' value='" . $row['id'] . "'>Delete</button>
                        </form>
                      </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No data available for Part H</td></tr>";
            }
            ?>
        </table>
    </div>

    <!-- Floating Modal for Edit Item - Part H -->
    <div id="editModalH" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('H')">&times;</span>
            <h2>Edit Item Bahagian H</h2>
            <form method="post" id="editFormH">
                <label>Bil : </label><br>
                <input type="text" name="bil_h" required><br><br>

                <label>Keterangan : </label><br>
                <textarea name="keterangan_h" rows="5" required></textarea><br><br>

                <label>Unit :</label><br>
                <input type="text" name="unit_h" required><br><br>

                <label>Harga :</label><br>
                <input type="number" step="0.01" name="harga_h" required><br><br>

                <input type="hidden" name="edit_id_h">
                <button type="submit" name="update_part_h">Update Item</button>
            </form>
        </div>
    </div>

    <!-- Part I Section -->
    <div id="partI" class="section part-i">
        <h2>BAHAGIAN I</h2>

        <!-- Form to Add New Item -->
        <h3>Tambah Item Bahagian I</h3>
        <div class="form-section">
            <form method="post">
                <label>Bil : </label><br>
                <input type="text" name="bil_i" required><br><br>

                <label>Keterangan : </label><br>
                <textarea name="keterangan_i" rows="5" required></textarea><br><br>

                <label>Unit :</label><br>
                <input type="text" name="unit_i" required><br><br>

                <label>Harga : </label><br>
                <input type="number" step="0.01" name="harga_i" required><br><br>

                <button type="submit" name="save_part_i">Tambah Item</button>
            </form>
        </div>

        <!-- Display Part I Data -->
        <h3>SENARAI ITEM BAHAGIAN I</h3>
        <table>
            <tr>
                <th>BIL</th>
                <th>KETERANGAN</th>
                <th>UNIT</th>
                <th>HARGA 2023</th>
                <th>ACTIONS</th>
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
                        <button onclick='openModal(" . $row['id'] . ", \"i\")'>Edit</button>
                        <form method='post' style='display:inline;'>
                            <button type='submit' name='delete_part_i' value='" . $row['id'] . "'>Delete</button>
                        </form>
                      </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No data available for Part I</td></tr>";
            }
            ?>
        </table>
    </div>

    <!-- Floating Modal for Edit Item - Part I -->
    <div id="editModalI" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('I')">&times;</span>
            <h2>Edit Item Bahagian I</h2>
            <form method="post" id="editFormI">
                <label>Bil : </label><br>
                <input type="text" name="bil_i" required><br><br>

                <label>Keterangan : </label><br>
                <textarea name="keterangan_i" rows="5" required></textarea><br><br>

                <label>Unit :</label><br>
                <input type="text" name="unit_i" required><br><br>

                <label>Harga :</label><br>
                <input type="number" step="0.01" name="harga_i" required><br><br>

                <input type="hidden" name="edit_id_i">
                <button type="submit" name="update_part_i">Update Item</button>
            </form>
        </div>
    </div>



    <script>

        window.onload = function () {
            showPart('a');  // Automatically show the "Part A" section when the page loads
        };


        // Open the modal and fill the form with the selected item's data for Part A or Part B
        function openModal(id, part) {
            if (part === "a") {
                document.getElementById("editModalA").style.display = "block";
                var form = document.getElementById("editFormA");
                form.edit_id_a.value = id;
            }

            else if (part === "b") {
                document.getElementById("editModalB").style.display = "block";
                var form = document.getElementById("editFormB");
                form.edit_id_b.value = id;
            }

            else if (part === "c") {
                document.getElementById("editModalC").style.display = "block";
                var form = document.getElementById("editFormC");
                form.edit_id_c.value = id;
            }

            else if (part === "d") {
                document.getElementById("editModalD").style.display = "block";
                var form = document.getElementById("editFormD");
                form.edit_id_d.value = id;
            }

            else if (part === "e") {
                document.getElementById("editModalE").style.display = "block";
                var form = document.getElementById("editFormE");
                form.edit_id_e.value = id;
            }

            else if (part === "f") {
                document.getElementById("editModalF").style.display = "block";
                var form = document.getElementById("editFormF");
                form.edit_id_f.value = id;
            }

            else if (part === "g") {
                document.getElementById("editModalG").style.display = "block";
                var form = document.getElementById("editFormG");
                form.edit_id_g.value = id;
            }

            else if (part === "h") {
                document.getElementById("editModalH").style.display = "block";
                var form = document.getElementById("editFormH");
                form.edit_id_h.value = id;
            }

            else if (part === "i") {
                document.getElementById("editModalI").style.display = "block";
                var form = document.getElementById("editFormI");
                form.edit_id_i.value = id;
            }

        }



        function showPart(part) {
            // Hide all sections first
            document.getElementById('partA').style.display = 'none';
            document.getElementById('partB').style.display = 'none';
            document.getElementById('partC').style.display = 'none';
            document.getElementById('partD').style.display = 'none';
            document.getElementById('partE').style.display = 'none';
            document.getElementById('partF').style.display = 'none';
            document.getElementById('partG').style.display = 'none';
            document.getElementById('partH').style.display = 'none';
            document.getElementById('partI').style.display = 'none';

            // Show the selected part
            if (part === 'a') {
                document.getElementById('partA').style.display = 'block';
            }
            else if (part === 'b') {
                document.getElementById('partB').style.display = 'block';
            }
            else if (part === 'c') {
                document.getElementById('partC').style.display = 'block';
            }
            else if (part === 'd') {
                document.getElementById('partD').style.display = 'block';
            }
            else if (part === 'e') {
                document.getElementById('partE').style.display = 'block';
            }
            else if (part === 'f') {
                document.getElementById('partF').style.display = 'block';
            }
            else if (part === 'g') {
                document.getElementById('partG').style.display = 'block';
            }
            else if (part === 'h') {
                document.getElementById('partH').style.display = 'block';
            }
            else if (part === 'i') {
                document.getElementById('partI').style.display = 'block';
            }
        }
    </script>

</body>

</html>