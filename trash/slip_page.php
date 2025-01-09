<?php
$conn = new mysqli('localhost', 'root', '', 'jadual');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission for adding approved items
if (isset($_POST['add_approved_item'])) {
    $item_name = $_POST['item_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    // Insert the approved item into the approved_items table
    $sql = "INSERT INTO approved_items (item_name, price, quantity) VALUES ('$item_name', '$price', '$quantity')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Approved item added successfully!');</script>";
    } else {
        echo "Error adding approved item: " . $conn->error;
    }
}

// Handle item removal
if (isset($_POST['remove_approved_item'])) {
    $item_id = $_POST['item_id'];

    // Delete the approved item from the database
    $remove_sql = "DELETE FROM approved_items WHERE id = '$item_id'";
    if ($conn->query($remove_sql) === TRUE) {
        echo "<script>alert('Approved item removed successfully!');</script>";
    } else {
        echo "Error removing approved item: " . $conn->error;
    }
}

// Fetch the selected items for the slip page
$sql = "SELECT 
            uc.id AS cart_id, 
            uc.quantity, 
            bia.keterangan, 
            bia.bil, 
            bia.harga AS price,
            uc.part
        FROM user_cart uc 
        INNER JOIN (
            SELECT id, keterangan, bil, harga, 'A' AS part FROM bahagian_i_a 
            UNION ALL 
            SELECT id, keterangan, bil, harga, 'B' AS part FROM bahagian_i_b
        ) bia 
        ON uc.item_id = bia.id";
$result = $conn->query($sql);

// Fetch the approved items for display
$approved_items_sql = "SELECT id, item_name, price, quantity FROM approved_items";
$approved_items_result = $conn->query($approved_items_sql);

//LOKASI 
if (isset($_POST['submit_lokasi'])) {
    // Get form data
    $projek = $_POST['projek'];
    $jarak = $_POST['jarak'];
    $negeri = $_POST['negeri'];
    $daerah = $_POST['daerah'];

    // Prepare SQL query to insert data into Lokasi table
    $sql = "INSERT INTO Lokasi (projek, jarak, negeri, daerah) VALUES ('$projek', '$jarak', '$negeri', '$daerah')";

    // Execute query
    if (mysqli_query($conn, $sql)) {
        echo "Data successfully saved!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

//TAMBAHAN PERATUSAN 
if (isset($_POST['submit_tambahan_peratusan'])) {
    // Get the selected kenderaan type and tax percentage
    $kenderaan = $_POST['kenderaan'];
    $tax_percentage = ($_POST['kenderaan'] === 'air') ? '2%' : '5%';

    // Prepare SQL query to insert the tax percentage
    $sql = "INSERT INTO Tambahan_Peratusan (kenderaan, tax_percentage) VALUES ('$kenderaan', '$tax_percentage')";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        echo "Data successfully saved!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slip Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            color: #333;
            padding: 20px;
        }
        h1, h2 {
            color: #0066cc;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #0066cc;
            color: white;
        }
        .form-section, .mini-form {
            border: 1px solid #ddd;
            padding: 20px;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 8px;
        }
        .form-section h3, .mini-form h3 {
            color: #0066cc;
        }
        label {
            margin-top: 10px;
            display: block;
        }
        input[type="text"], input[type="number"] {
            width: 200px;
            padding: 5px;
            margin-top: 5px;
        }
        button {
            padding: 8px 16px;
            background-color: #0066cc;
            color: white;
            border: none;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background-color: #005bb5;
        }
    </style>
</head>
<body>

    <h1>Slip Page</h1>

    <!-- Displaying selected items in a box container -->
    <div class="form-section">
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
            </tr>
            <?php
            if ($result->num_rows > 0) {
                $no = 1; // Counter for the "No" column
                while ($row = $result->fetch_assoc()) {
                    $total_harga = $row['quantity'] * $row['price']; // Calculate total price
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . $row['keterangan'] . "</td>";
                    echo "<td>" . $row['part'] . "</td>"; // Display part (A or B)
                    echo "<td>" . $row['bil'] . "</td>";
                    echo "<td>" . number_format($row['price'], 2) . "</td>";
                    echo "<td>" . $row['quantity'] . "</td>";
                    echo "<td>" . number_format($total_harga, 2) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Tiada item dipilih</td></tr>";
            }
            ?>
        </table>

	<h3>Tambah Item</h3>
        <li><a href="Bahagian I_User.php">BAHAGIAN I</a></li>
        <li><a href="Bahagian II_User.php">BAHAGIAN II</a></li>
        <li><a href="Bahagian III_User.php">BAHAGIAN III</a></li>
        <li><a href="Bahagian IV_User.php">BAHAGIAN IV</a></li>
        <li><a href="Bahagian V_User.php">BAHAGIAN V</a></li>
        <li><a href="Bahagian VI_User.php">BAHAGIAN VI</a></li>
        <li><a href="Bahagian VII_User.php">BAHAGIAN VII</a></li>
    </div>

    <!-- ITEM HARGA PERSETUJUAN Section -->
    <div class="form-section">
        <h2>ITEM HARGA PERSETUJUAN</h2>
        <form method="post">
            <p><b>Ada Item Persetujuan?</b></p>
            <input type="radio" id="ada" name="item_approval" value="ada" onclick="toggleApprovalForm(true)">
            <label for="ada">Ada</label>
            <input type="radio" id="tiada" name="item_approval" value="tiada" onclick="toggleApprovalForm(false)">
            <label for="tiada">Tiada</label>

            <!-- Form for adding approved items (hidden by default) -->
            <div id="approvalForm" style="display: none;">
                <h3>Add Approved Item</h3>
                <label for="item_name">Item:</label>
                <input type="text" id="item_name" name="item_name" required>
                <br>
                <label for="price">Harga:</label>
                <input type="number" id="price" name="price" required step="0.01">
                <br>
                <label for="quantity">Kuantiti:</label>
                <input type="number" id="quantity" name="quantity" required>
                <br><br>
                <button type="submit" name="add_approved_item">Add New Item</button>
            </div>
        </form>
    </div>

    <!-- Displaying approved items in a separate box container -->
    <div class="form-section">
        <h2>LIST ITEM HARGA PERSETUJUAN</h2>
        <table>
            <tr>
                <th>No</th>
                <th>Item</th>
                <th>Harga (RM)</th>
                <th>Kuantiti</th>
                <th>Total Harga (RM)</th>
                <th>Action</th>
            </tr>
            <?php
            if ($approved_items_result->num_rows > 0) {
                $no = 1; // Counter for the "No" column
                while ($row = $approved_items_result->fetch_assoc()) {
                    $total_harga_approved = $row['quantity'] * $row['price']; // Calculate total price for approved items
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . $row['item_name'] . "</td>";
                    echo "<td>" . number_format($row['price'], 2) . "</td>";
                    echo "<td>" . $row['quantity'] . "</td>";
                    echo "<td>" . number_format($total_harga_approved, 2) . "</td>";
                    echo "<td>
                            <form method='post'>
                                <input type='hidden' name='item_id' value='" . $row['id'] . "'>
                                <button type='submit' name='remove_approved_item'>Remove</button>
                            </form>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Tiada item yang disetujui</td></tr>";
            }
            ?>
        </table>
    </div>

	<!-- Lokasi Form -->
<div class="form-section">
    <h2>Lokasi</h2>
    <form method="post">
        <label for="projek">Projek:</label>
        <input type="text" id="projek" name="projek" style="width: 80%; padding: 10px;" required>

        <br>

        <label for="jarak">Jarak (km):</label>
        <input type="number" id="jarak" name="jarak" required>

        <br>

        <label for="negeri">Negeri:</label>
        <select id="negeri" name="negeri" onchange="updateDaerah()" required>
            <option value="pahang">JKR Elektrik Pahang</option>
            <option value="johor">JKR Elektrik Johor</option>
            <option value="selangor">JKR Elektrik Selangor</option>
            <option value="negeri_sembilan">JKR Elektrik Negeri Sembilan</option>
            <option value="melaka">JKR Elektrik Melaka</option>
            <option value="kelantan">JKR Elektrik Kelantan</option>
            <option value="kedah">JKR Elektrik Kedah</option>
            <option value="pulau_pinang">JKR Elektrik Pulau Pinang</option>
            <option value="perak">JKR Elektrik Perak</option>
            <option value="terengganu">JKR Elektrik Terengganu</option>
            <option value="putrajaya">JKR Elektrik Putrajaya</option>
            <option value="kuala_lumpur">JKR Elektrik Kuala Lumpur</option>
            <option value="labuan">JKR Elektrik Labuan</option>
            <option value="perlis">JKR Elektrik Perlis</option>
            <option value="kesedar">JKR Elektrik KESEDAR</option>
            <option value="ketengah">JKR Elektrik KETENGAH</option>
        </select>

        <br>

        <label for="daerah">Daerah:</label>
        <select id="daerah" name="daerah" required>
            <!-- Daerah options will be updated dynamically -->
        </select>

        <br>

        <button type="submit" name="submit_lokasi">Hantar Lokasi</button>
    </form>
</div>

<!-- Tambahan Peratusan Form -->
<div class="form-section">
    <form method="post">
<h3>TAMBAHAN PERATUSAN</h3>
        
        <!-- Radio buttons for Kenderaan type -->
        <label>
            <input type="radio" name="kenderaan" value="darat" onclick="updateTaxPercentage('air')" required> Tambahan peratusan sebanyak 2% lagi dari JKKE hendaklah dibuat sekiranya jalan ke sesuatu tempat kerja hanya boleh dilalui oleh kenderaan darat berjentera beroda dua (two-wheel vehicle) atau kenderaan berjentera yang mempunyai pacuan empat roda (four-wheel drive vehicle).
        </label>
        <label>
            <input type="radio" name="kenderaan" value="air" onclick="updateTaxPercentage('darat')" required> Tambahan peratusan sebanyak 5% lagi dari JKKE hendaklah dibuat sekiranya jalan ke sesuatu tempat kerja hanya boleh dilalui menggunakan kenderaan air dengan mengharungi sungai, tasik atau laut, tanpa jambatan.
        </label>
        
        <!-- Display tax percentage -->
        <div>
            <label for="tax_percentage">Tax Percentage:</label>
            <input type="text" id="tax_percentage" name="tax_percentage" readonly>
        </div>

        <!-- Submit Button -->
        <button type="submit" name="submit_tambahan_peratusan">TAMBAHAN PERATUSAN</button>
  

    </form> 
</div>

<!-- Add this below the table displaying selected items -->
<a href="generate_slip.php" style="display:inline-block; padding: 10px 20px; background-color: #0066cc; color: white; text-decoration: none; border-radius: 5px;">Slip</a>





	
    <script>
	
	const daerahOptions = {
        pahang: ['Bentong', 'Temerloh', 'Raub', 'Bera', 'Maran', 'Kuantan', 'Cameron Highlands', 'Kuala Lipis', 'Pekan', 'Jerantut', 'Rompin', 'Ulu Tembeling (Taman Negara)', 'Pulau Tioman'],
        johor: ['Johor Bahru', 'Pontian', 'Segamat', 'Kluang', 'Batu Pahat', 'Muar', 'Kota Tinggi', 'Mersing', 'Tangkak', 'Kulaijaya', 'Pulau Sibu dan Pulau Tinggi', 'Pulau Aur dan Pulau Pemanggil'],
        selangor: ['Semua daerah kecuali Sabak Bernam dan Kuala Selangor', 'Sabak Bernam dan Kuala Selangor', 'Pulau Ketam'],
        negeri_sembilan: ['Seremban', 'Kuala Pilah', 'Port Dickson', 'Tampin', 'Rembau', 'Kuala Klawang', 'Bandar Baru Serting'],
        melaka: ['Bandar Melaka'],
        kelantan: ['Kota Bahru', 'Bachok', 'Pasir Puteh', 'Pasir Mas', 'Tumpat', 'Tanah Merah', 'Machang', 'Jeli', 'Kuala Krai', 'Gua Musang'],
        kedah: ['Kota Setar', 'Sungai Petani', 'Kulim', 'Baling', 'Padang Terap', 'Yan', 'Sik', 'Bandar Baharu', 'Pendang', 'Langkawi'],
        pulau_pinang: ['Pulau Pinang', 'Butterworth', 'Bukit Bendera', 'Pulau-pulau'],
        perak: ['Kinta', 'Kuala Kangsar', 'Larut & Matang', 'Kerian', 'Batang Padang', 'Hilir Perak', 'Manjung', 'Perak Tengah', 'Hulu Perak', 'Pos Orang Asli', 'Pulau-pulau (Pulau Pangkor)'],
        terengganu: ['Kuala Terengganu', 'Dungun', 'Kemaman', 'Besut', 'Hulu Terengganu', 'Setiu', 'Marang', 'Pulau-Pulau'],
        labuan: ['Labuan', 'Pulau-pulau'],
        putrajaya: ['Putrajaya'],
        kuala_lumpur: ['Kuala Lumpur'],
        perlis: ['Kangar'],
        kesedar: ['Kesedar'],
        ketengah: ['Ketengah']
    };

	 // Update Daerah options based on selected Negeri
    function updateDaerah() {
        const negeri = document.getElementById('negeri').value;
        const daerahSelect = document.getElementById('daerah');
        daerahSelect.innerHTML = ''; // Clear existing options

        // Add new options based on the selected Negeri
        if (daerahOptions[negeri]) {
            daerahOptions[negeri].forEach(function(daerah) {
                const option = document.createElement('option');
                option.value = daerah.toLowerCase().replace(/ /g, '_'); // Convert space to underscore
                option.textContent = daerah;
                daerahSelect.appendChild(option);
            });
        }
    }
 // Initialize Daerah options on page load
    window.onload = function() {
        updateDaerah(); // Populate Daerah dropdown based on default Negeri (if needed)
    };

        // Function to toggle the display of the approval form
        function toggleApprovalForm(show) {
            const approvalForm = document.getElementById('approvalForm');
            if (show) {
                approvalForm.style.display = 'block';
            } else {
                approvalForm.style.display = 'none';
            }
        }

function updateTaxPercentage(kenderaan) {
    var taxPercentage = 0;
    
    if (kenderaan === 'air') {
        taxPercentage = '2%';
    } else if (kenderaan === 'darat') {
        taxPercentage = '5%';
    }
    
    // Set the value in the tax percentage input field
    document.getElementById('tax_percentage').value = taxPercentage;
}


    </script>

</body>
</html>

<?php
$conn->close();
?>
