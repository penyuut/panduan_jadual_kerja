<?php
session_start();

$conn = new mysqli('localhost', 'root', '', 'jadual');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the 'negeri' POST variable is set
$negeri = isset($_POST['negeri']) ? $_POST['negeri'] : '';  // Default to empty string if not set

// Handle adding approval section
if (isset($_POST['add_approved_item'])) {
    $item_name = $_POST['item_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO approved_items (item_name, price, quantity) VALUES (?, ?, ?)");
    $stmt->bind_param("sdi", $item_name, $price, $quantity);  // s = string, d = double, i = integer

    if ($stmt->execute()) {
        echo "<script>alert('Item added successfully.');</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Handle item removal
if (isset($_POST['remove_approved_item'])) {
    $item_id = $_POST['item_id'];
    $remove_sql = "DELETE FROM approved_items WHERE id = '$item_id'";
    if ($conn->query($remove_sql) === TRUE) {
        echo "<script>alert('Approved item removed successfully!');</script>";
    } else {
        echo "Error removing approved item: " . $conn->error;
    }
}

// Fetch approved items from the database
$approved_items_result = $conn->query("SELECT * FROM approved_items");
$approved_items = $approved_items_result->fetch_all(MYSQLI_ASSOC);

// Initialize totals
$totalAmount = 0;
$totalApprovedAmount = 0;

// Calculate total amount from the cart
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $totalAmount += $item['harga'] * $item['kuantiti'];
    }
}

// Calculate total approved amount
foreach ($approved_items as $item) {
    $totalApprovedAmount += $item['price'] * $item['quantity'];
}

// Unified Tax Calculation
$taxRate = 0;
$vehicleTaxRate = 0;
$taxRates = [
    'kangar' => [
        'lessThan16' => 0.04,
        'between16And32' => 0.09,
        'between32And48' => 0.12,
        'moreThan48' => 0.14
    ],
    'kota setar' => [
        'lessThan16' => 0.03,
        'between16And32' => 0.08,
        'between32And48' => 0.11,
        'moreThan48' => 0.13
    ],

    'sungai petani' => [
        'lessThan16' => 0.03,
        'between16And32' => 0.08,
        'between32And48' => 0.11,
        'moreThan48' => 0.13
    ],
    'kulim' => [
        'lessThan16' => 0.03,
        'between16And32' => 0.08,
        'between32And48' => 0.11,
        'moreThan48' => 0.13
    ],
    'baling' => [
        'lessThan16' => 0.03,
        'between16And32' => 0.08,
        'between32And48' => 0.11,
        'moreThan48' => 0.13
    ],
    'padang terap' => [
        'lessThan16' => 0.03,
        'between16And32' => 0.08,
        'between32And48' => 0.11,
        'moreThan48' => 0.13
    ],
    'yan' => [
        'lessThan16' => 0.03,
        'between16And32' => 0.08,
        'between32And48' => 0.11,
        'moreThan48' => 0.13
    ],
    'sik' => [
        'lessThan16' => 0.03,
        'between16And32' => 0.08,
        'between32And48' => 0.11,
        'moreThan48' => 0.13
    ],
    'bandar baharu' => [
        'lessThan16' => 0.03,
        'between16And32' => 0.08,
        'between32And48' => 0.11,
        'moreThan48' => 0.13
    ],
    'pendang' => [
        'lessThan16' => 0.03,
        'between16And32' => 0.08,
        'between32And48' => 0.11,
        'moreThan48' => 0.13
    ],
    'langkawi' => [
        'lessThan16' => 0.25,
        'between16And32' => 0.0,
        'between32And48' => 0.0,
        'moreThan48' => 0.0
    ],
    'pulau pinang' => [
        'lessThan16' => 0.03,
        'between16And32' => 0.08,
        'between32And48' => 0.11,
        'moreThan48' => 0.13
    ],
    'butterworth' => [
        'lessThan16' => 0.03,
        'between16And32' => 0.08,
        'between32And48' => 0.11,
        'moreThan48' => 0.13
    ],
    'bukit bendera' => [
        'lessThan16' => 0.15,
        'between16And32' => 0.0,
        'between32And48' => 0.0,
        'moreThan48' => 0.0
    ],
    'pulau-pulau' => [
        'lessThan16' => 0.20,
        'between16And32' => 0.0,
        'between32And48' => 0.0,
        'moreThan48' => 0.0
    ],
    'kinta' => [
        'lessThan16' => 0.03,
        'between16And32' => 0.08,
        'between32And48' => 0.11,
        'moreThan48' => 0.13
    ],
    'kuala kangsar' => [
        'lessThan16' => 0.03,
        'between16And32' => 0.08,
        'between32And48' => 0.11,
        'moreThan48' => 0.13
    ],
    'larut & matang' => [
        'lessThan16' => 0.03,
        'between16And32' => 0.08,
        'between32And48' => 0.11,
        'moreThan48' => 0.13
    ],
    'kerian' => [
        'lessThan16' => 0.03,
        'between16And32' => 0.08,
        'between32And48' => 0.11,
        'moreThan48' => 0.13
    ],
    'batang padang' => [
        'lessThan16' => 0.03,
        'between16And32' => 0.08,
        'between32And48' => 0.11,
        'moreThan48' => 0.13
    ],
    'hilir perak' => [
        'lessThan16' => 0.03,
        'between16And32' => 0.08,
        'between32And48' => 0.11,
        'moreThan48' => 0.13
    ],
    'manjung' => [
        'lessThan16' => 0.03,
        'between16And32' => 0.08,
        'between32And48' => 0.11,
        'moreThan48' => 0.13
    ],
    'perak tengah' => [
        'lessThan16' => 0.03,
        'between16And32' => 0.08,
        'between32And48' => 0.11,
        'moreThan48' => 0.13
    ],
    'hulu perak' => [
        'lessThan16' => 0.08,
        'between16And32' => 0.13,
        'between32And48' => 0.16,
        'moreThan48' => 0.18
    ],
    'pos orang asli' => [
        'lessThan16' => 0.20,
        'between16And32' => 0.0,
        'between32And48' => 0.0,
        'moreThan48' => 0.0
    ],
    'pulau-pulau (pulau pangkor)' => [
        'lessThan16' => 0.20,
        'between16And32' => 0.0,
        'between32And48' => 0.0,
        'moreThan48' => 0.0
    ],
    'semua daerah kecuali sabak bernam dan kuala selangor' => [
        'lessThan16' => 0.01,
        'between16And32' => 0.05,
        'between32And48' => 0.08,
        'moreThan48' => 0.11
    ],
    'sabak bernam dan kuala selangor' => [
        'lessThan16' => 0.03,
        'between16And32' => 0.08,
        'between32And48' => 0.11,
        'moreThan48' => 0.13
    ],

    'pulau ketam' => [
        'lessThan16' => 0.15,
        'between16And32' => 0.00,
        'between32And48' => 0.00,
        'moreThan48' => 0.00,
    ],
    'seremban' => [
        'lessThan16' => 0.03,
        'between16And32' => 0.08,
        'between32And48' => 0.11,
        'moreThan48' => 0.13,
    ],
    'kuala pilah' => [
        'lessThan16' => 0.03,
        'between16And32' => 0.08,
        'between32And48' => 0.11,
        'moreThan48' => 0.13,
    ],
    'port dickson' => [
        'lessThan16' => 0.03,
        'between16And32' => 0.08,
        'between32And48' => 0.11,
        'moreThan48' => 0.13,
    ],
    'tampin' => [
        'lessThan16' => 0.03,
        'between16And32' => 0.08,
        'between32And48' => 0.11,
        'moreThan48' => 0.13,
    ],
    'rembau' => [
        'lessThan16' => 0.04,
        'between16And32' => 0.09,
        'between32And48' => 0.13,
        'moreThan48' => 0.15,
    ],
    'kuala klawang' => [
        'lessThan16' => 0.04,
        'between16And32' => 0.09,
        'between32And48' => 0.13,
        'moreThan48' => 0.15,
    ],
    'bandar baru serting' => [
        'lessThan16' => 0.04,
        'between16And32' => 0.09,
        'between32And48' => 0.13,
        'moreThan48' => 0.15,
    ],
    'bandar melaka' => [
        'lessThan16' => 0.03,
        'between16And32' => 0.08,
        'between32And48' => 0.11,
        'moreThan48' => 0.13,
    ],
    'johor bahru' => [
        'lessThan16' => 0.03,
        'between16And32' => 0.08,
        'between32And48' => 0.11,
        'moreThan48' => 0.13,
    ],
    'pontian' => [
        'lessThan16' => 0.03,
        'between16And32' => 0.08,
        'between32And48' => 0.11,
        'moreThan48' => 0.13,
    ],
    'segamat' => [
        'lessThan16' => 0.06,
        'between16And32' => 0.11,
        'between32And48' => 0.14,
        'moreThan48' => 0.16,
    ],
    'kluang' => [
        'lessThan16' => 0.03,
        'between16And32' => 0.08,
        'between32And48' => 0.11,
        'moreThan48' => 0.13,
    ],
    'batu pahat' => [
        'lessThan16' => 0.03,
        'between16And32' => 0.08,
        'between32And48' => 0.11,
        'moreThan48' => 0.13,
    ],
    'muar' => [
        'lessThan16' => 0.06,
        'between16And32' => 0.11,
        'between32And48' => 0.14,
        'moreThan48' => 0.16,
    ],
    'kota tinggi' => [
        'lessThan16' => 0.06,
        'between16And32' => 0.11,
        'between32And48' => 0.14,
        'moreThan48' => 0.16,
    ],
    'tangkak' => [
        'lessThan16' => 0.03,
        'between16And32' => 0.08,
        'between32And48' => 0.11,
        'moreThan48' => 0.13,
    ],
    'kulaijaya' => [
        'lessThan16' => 0.03,
        'between16And32' => 0.08,
        'between32And48' => 0.11,
        'moreThan48' => 0.13,
    ],
    'pulau sibu dan pulau tinggi' => [
        'lessThan16' => 0.25,
        'between16And32' => 0.00,
        'between32And48' => 0.00,
        'moreThan48' => 0.00,
    ],
    'pulau aur dan pulau pemanggil' => [
        'lessThan16' => 0.40,
        'between16And32' => 0.00,
        'between32And48' => 0.00,
        'moreThan48' => 0.00,
    ],
    'bentong' => [
        'lessThan16' => 0.03,
        'between16And32' => 0.08,
        'between32And48' => 0.11,
        'moreThan48' => 0.13
    ],
    'temerloh' => [
        'lessThan16' => 0.03,
        'between16And32' => 0.08,
        'between32And48' => 0.11,
        'moreThan48' => 0.13
    ],
    'raub' => [
        'lessThan16' => 0.03,
        'between16And32' => 0.08,
        'between32And48' => 0.11,
        'moreThan48' => 0.13
    ],
    'bera' => [
        'lessThan16' => 0.03,
        'between16And32' => 0.08,
        'between32And48' => 0.11,
        'moreThan48' => 0.13
    ],
    'maran' => [
        'lessThan16' => 0.03,
        'between16And32' => 0.08,
        'between32And48' => 0.11,
        'moreThan48' => 0.13
    ],
    'kuantan' => [
        'lessThan16' => 0.03,
        'between16And32' => 0.08,
        'between32And48' => 0.11,
        'moreThan48' => 0.13
    ],
    'cameron highlands' => [
        'lessThan16' => 0.06,
        'between16And32' => 0.11,
        'between32And48' => 0.14,
        'moreThan48' => 0.16
    ],
    'kuala lipis' => [
        'lessThan16' => 0.03,
        'between16And32' => 0.08,
        'between32And48' => 0.11,
        'moreThan48' => 0.13
    ],
    'pekan' => [
        'lessThan16' => 0.03,
        'between16And32' => 0.08,
        'between32And48' => 0.11,
        'moreThan48' => 0.13
    ],
    'jerantut' => [
        'lessThan16' => 0.03,
        'between16And32' => 0.08,
        'between32And48' => 0.11,
        'moreThan48' => 0.13
    ],
    'rompin' => [
        'lessThan16' => 0.06,
        'between16And32' => 0.11,
        'between32And48' => 0.14,
        'moreThan48' => 0.16
    ],
    'ulu tembeling' => [
        'lessThan16' => 0.20,
        'between16And32' => 0.00,
        'between32And48' => 0.00,
        'moreThan48' => 0.00
    ],
    'pulau tioman' => [
        'lessThan16' => 0.50,
        'between16And32' => 0.00,
        'between32And48' => 0.00,
        'moreThan48' => 0.00
    ],
    'labuan' => [
        'lessThan16' => 0.25,
        'between16And32' => 0.00,
        'between32And48' => 0.00,
        'moreThan48' => 0.00
    ],
    'pulau pulau' => [
        'lessThan16' => 0.25,
        'between16And32' => 0.00,
        'between32And48' => 0.00,
        'moreThan48' => 0.00
    ],
    'kuala terengganu' => [
        'lessThan16' => 0.04,
        'between16And32' => 0.09,
        'between32And48' => 0.12,
        'moreThan48' => 0.14
    ],
    'dungun' => [
        'lessThan16' => 0.04,
        'between16And32' => 0.09,
        'between32And48' => 0.12,
        'moreThan48' => 0.14
    ],
    'kemaman' => [
        'lessThan16' => 0.04,
        'between16And32' => 0.09,
        'between32And48' => 0.12,
        'moreThan48' => 0.14
    ],
    'besut' => [
        'lessThan16' => 0.04,
        'between16And32' => 0.09,
        'between32And48' => 0.12,
        'moreThan48' => 0.14
    ],
    'hulu terengganu' => [
        'lessThan16' => 0.04,
        'between16And32' => 0.09,
        'between32And48' => 0.12,
        'moreThan48' => 0.14
    ],
    'setiu' => [
        'lessThan16' => 0.04,
        'between16And32' => 0.09,
        'between32And48' => 0.12,
        'moreThan48' => 0.14
    ],
    'marang' => [
        'lessThan16' => 0.06,
        'between16And32' => 0.11,
        'between32And48' => 0.14,
        'moreThan48' => 0.16
    ],
    'pulau Pulau' => [
        'lessThan16' => 0.04,
        'between16And32' => 0.09,
        'between32And48' => 0.12,
        'moreThan48' => 0.14
    ],
    'kota bahru' => [
        'lessThan16' => 0.04,
        'between16And32' => 0.09,
        'between32And48' => 0.12,
        'moreThan48' => 0.14
    ],
    'bachok' => [
        'lessThan16' => 0.04,
        'between16And32' => 0.09,
        'between32And48' => 0.12,
        'moreThan48' => 0.14
    ],
    'pasir puteh' => [
        'lessThan16' => 0.04,
        'between16And32' => 0.09,
        'between32And48' => 0.12,
        'moreThan48' => 0.14
    ],
    'pasir mas' => [
        'lessThan16' => 0.04,
        'between16And32' => 0.09,
        'between32And48' => 0.12,
        'moreThan48' => 0.14
    ],
    'tumpat' => [
        'lessThan16' => 0.04,
        'between16And32' => 0.09,
        'between32And48' => 0.12,
        'moreThan48' => 0.14
    ],
    'tanah merah' => [
        'lessThan16' => 0.04,
        'between16And32' => 0.09,
        'between32And48' => 0.12,
        'moreThan48' => 0.14
    ],
    'machang' => [
        'lessThan16' => 0.04,
        'between16And32' => 0.09,
        'between32And48' => 0.12,
        'moreThan48' => 0.14
    ],
    'jeli' => [
        'lessThan16' => 0.06,
        'between16And32' => 0.11,
        'between32And48' => 0.14,
        'moreThan48' => 0.16
    ],
    'kuala krai' => [
        'lessThan16' => 0.06,
        'between16And32' => 0.11,
        'between32And48' => 0.14,
        'moreThan48' => 0.16
    ],
    'gua musang' => [
        'lessThan16' => 0.08,
        'between16And32' => 0.13,
        'between32And48' => 0.16,
        'moreThan48' => 0.18
    ]

];

// Handle tax and vehicle type submission
if (isset($_POST['submit_lokasi'])) {
    $distance = $_POST['jarak'];
    $district = strtolower($_POST['daerah']);
    $vehicleType = $_POST['vehicle_type'];

    // Determine tax rate based on distance
    if (isset($taxRates[$district])) {
        if ($distance < 16) {
            $taxRate = $taxRates[$district]['lessThan16'];
        } elseif ($distance <= 32) {
            $taxRate = $taxRates[$district]['between16And32'];
        } elseif ($distance <= 48) {
            $taxRate = $taxRates[$district]['between32And48'];
        } else {
            $taxRate = $taxRates[$district]['moreThan48'];
        }

        // Determine vehicle tax rate
        if ($vehicleType === 'kenderaan_air') {
            $vehicleTaxRate = 0.05; // 5%
        } elseif ($vehicleType === 'kenderaan_darat') {
            $vehicleTaxRate = 0.02; // 2%
        }
    }
}
;

// Calculate the taxes
$totalAmountIncludingApprovedItems = $totalAmount + $totalApprovedAmount;
$taxAmount = $totalAmountIncludingApprovedItems * $taxRate;
$vehicleTaxAmount = $totalAmountIncludingApprovedItems * $vehicleTaxRate;
$totalTax = $taxAmount + $vehicleTaxAmount;

// Calculate Jumlah Nilai Kerja
$jumlahNilaiKerja = $totalAmountIncludingApprovedItems;

// Calculate Jumlah Besar (Jumlah Nilai Kerja + Total Cukai)
$jumlahBesar = $jumlahNilaiKerja + $totalTax;

// Apply condition to include/exclude tax based on Jumlah Nilai Kerja
$CukaiMoreRM1000 = 0; // Initialize as 0
$taxAmountLessThan1000 = 0;

if ($jumlahNilaiKerja < 1000) {
    // If Jumlah Nilai Kerja < RM 1000, tax is 20%
    $taxAmountLessThan1000 = $jumlahBesar * 0.20; // 20% tax applied
    $CukaiMoreRM1000 = $jumlahBesar + $taxAmountLessThan1000; // Jumlah Nilai Kerja + 20% tax
} else {
    // If Jumlah Nilai Kerja >= RM 1000, tax is not included
    $CukaiMoreRM1000 = $jumlahBesar; // No tax added
}

// Initialize a variable to control the display of approved items in the slip form
$displayApprovedItems = false; // Default to false
$noApprovedItemsMessage = ''; // Message for no approved items

// After handling the form submission for item approval
// Ensure the session is persistent and display logic is correctly checked
if (isset($_POST['item_approval'])) {
    if ($_POST['item_approval'] === 'ada') {
        $displayApprovedItems = true; // Show approved items
        $approved_items_result = $conn->query("SELECT * FROM approved_items");
        $approved_items = $approved_items_result->fetch_all(MYSQLI_ASSOC);
    } elseif ($_POST['item_approval'] === 'tiada') {
        $noApprovedItemsMessage = 'Tiada'; // Set message for no approved items
        $displayApprovedItems = false; // Hide approved items
    }
} else {
    // If no item approval was selected, default to showing "Tiada"
    $noApprovedItemsMessage = 'Tiada';
    $displayApprovedItems = false;
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SLIP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        h1,
        h2,
        h3 {
            color: #1E3A8A;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            /* Keep this if you want borders to collapse */
            margin: 20px auto;
        }

        table tr,
        table th,
        table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #1a1919;
            /* Add border to each cell */
        }

        th {
            text-align: center;
            background-color: white;
        }

        button {
            background-color: #3B82F6;
            ;
            /* Set the background color to blue */
            color: white;
            /* Set the text color to white for better contrast */
            border: none;
            /* Remove the default border */
            padding: 10px 15px;
            /* Add some padding */
            border-radius: 5px;
            /* Optional: add rounded corners */
            cursor: pointer;
            /* Change cursor to pointer on hover */
        }

        button:hover {
            background-color: darkblue;
            /* Change color on hover */
        }

        .form-section {
            border: 1px solid #ddd;
            padding: 20px;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 8px;
        }

        .slip-section {
            max-width: 210mm;
        /* Set max width to A4 width */
        margin: auto;
        /* Center the content */
        padding: 20px;
        /* Add padding */
        box-sizing: border-box;
        }

        .amount {
            display: inline-block;
            text-align: right;
            width: 100px;
            /* Adjust width as needed */
            float: right;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
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

        const negeriText = {
            pahang: 'JKR Elektrik Pahang (Pejabat pengeluar inden)',
            johor: 'JKR Elektrik Johor (Pejabat pengeluar inden)',
            selangor: 'JKR Elektrik Selangor (Pejabat pengeluar inden)',
            negeri_sembilan: 'JKR Elektrik Negeri Sembilan (Pejabat pengeluar inden)',
            melaka: 'JKR Elektrik Melaka (Pejabat pengeluar inden)',
            kelantan: 'JKR Elektrik Kelantan (Pejabat pengeluar inden)',
            kedah: 'JKR Elektrik Kedah (Pejabat pengeluar inden)',
            pulau_pinang: 'JKR Elektrik Pulau Pinang (Pejabat pengeluar inden)',
            perak: 'JKR Elektrik Perak (Pejabat pengeluar inden)',
            terengganu: 'JKR Elektrik Terengganu (Pejabat pengeluar inden)',
            labuan: 'JKR Elektrik Labuan (Pejabat pengeluar inden)',
            putrajaya: 'JKR Elektrik Putrajaya (Pejabat pengeluar inden)',
            kuala_lumpur: 'JKR Elektrik Kuala Lumpur (Pejabat pengeluar inden)',
            perlis: 'JKR Elektrik Perlis (Pejabat pengeluar inden)',
            kesedar: 'JKR Elektrik Kesedar (Pejabat pengeluar inden)',
            ketengah: 'JKR Elektrik Ketengah (Pejabat pengeluar inden)'
        };

        function toggleApprovalForm(show) {
            var approvalForm = document.getElementById('approvalForm');
            if (show) {
                approvalForm.style.display = 'block';
            } else {
                approvalForm.style.display = 'none';
            }
        }

        // Function to update daerah dropdown based on selected negeri
        function updateDistricts() {
            const negeriSelect = document.getElementById('negeri');
            const daerahSelect = document.getElementById('daerah');
            const selectedNegeri = negeriSelect.value;

            // Clear previous options
            daerahSelect.innerHTML = '<option value="">Select Daerah</option>';

            // Check if selected negeri exists in daerahOptions
            if (daerahOptions[selectedNegeri]) {
                daerahOptions[selectedNegeri].forEach(daerah => {
                    const option = document.createElement('option');
                    option.value = daerah.toLowerCase(); // Ensure lowercase value
                    option.textContent = daerah;
                    daerahSelect.appendChild(option);
                });
            }
        }

        function validateApprovalSelection() {
            // Check if either radio button is selected
            const adaSelected = document.getElementById('ada').checked;
            const tiadaSelected = document.getElementById('tiada').checked;

            if (!adaSelected && !tiadaSelected) {
                alert('Please select either "Ada" or "Tiada" before calculating tax.');
                return false; // Prevent form submission
            }
            return true; // Allow form submission
        }

        function toggleApprovedItems(show) {
            var approvalForm = document.getElementById('approvalForm');
            var approvedItemsList = document.getElementById('approvedItemsList');
            var noItemsMessage = document.getElementById('noItemsMessage');

            if (show) {
                approvalForm.style.display = 'block';
                approvedItemsList.style.display = 'block';
                noItemsMessage.style.display = 'none';
            } else {
                approvalForm.style.display = 'none';
                approvedItemsList.style.display = 'none';
                noItemsMessage.style.display = 'block';
            }
        }

        function downloadPDF() {
            const element = document.getElementById('slip-section');

            // Options for PDF formatting
            const options = {
                margin: 1,
                filename: 'slip.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'A4', orientation: 'portrait' }
            };

            // Convert and download the PDF
            html2pdf().set(options).from(element).save();
        }

        function exportToExcel() {
     // Get slip content
            var slipContent = document.getElementById('slip-section').innerHTML;

            // Create an Excel file content with table formatting
            var excelContent = `
                <html xmlns:o="urn:schemas-microsoft-com:office:office" 
                      xmlns:x="urn:schemas-microsoft-com:office:excel" 
                      xmlns="http://www.w3.org/TR/REC-html40">
                <head>
                    <!-- Disable gridlines -->
                    <style>
                        table { border-collapse: collapse; }
                        td { border: none; }
                    </style>
                </head>
                <body>
                    <table>
                        <tr>
                            <td>${slipContent}</td>
                        </tr>
                    </table>
                </body>
                </html>
            `;

            // Create a Blob object
            var blob = new Blob([excelContent], { type: 'application/vnd.ms-excel' });

            // Create a download link
            var link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = 'slip.xls';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

    </script>
</head>

<body>
    <div>
        <h1>SLIP</h1>

        <!-- Item JKKE-->
        <div class="form-section">
            <h2>ITEM JKKE</h2>
            <table>
                <tr>
                    <th>No</th>
                    <th>Bil</th>
                    <th>Bhg</th>
                    <th>Keterangan</th>
                    <th>Harga</th>
                    <th>Kuantiti</th>
                    <th>Jumlah</th>
                </tr>
                <?php if (!empty($_SESSION['cart'])): ?>
                    <?php foreach ($_SESSION['cart'] as $index => $item): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= htmlspecialchars($item['bil']) ?></td>
                            <td><?= htmlspecialchars($item['bhg']) ?></td>
                            <td><?= htmlspecialchars($item['keterangan']) ?></td>
                            <td>RM <?= number_format($item['harga'], 2) ?></td>
                            <td><?= htmlspecialchars($item['kuantiti']) ?></td>
                            <td>RM <?= number_format($item['harga'] * $item['kuantiti'], 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No items in the cart</td>
                    </tr>
                <?php endif; ?>
            </table>
            <p><strong>Jumlah Keseluruhan : RM <?= number_format($totalAmount, 2) ?></strong></p>

            <h3>Tambah Item</h3>
            <li><a href="Bahagian I_User.php">BAHAGIAN I</a></li>
            <li><a href="Bahagian II_User.php">BAHAGIAN II</a></li>
            <li><a href="Bahagian III_User.php">BAHAGIAN III</a></li>
            <li><a href="Bahagian IV_User.php">BAHAGIAN IV</a></li>
            <li><a href="Bahagian V_User.php">BAHAGIAN V</a></li>
            <li><a href="Bahagian VI_User.php">BAHAGIAN VI</a></li>
            <li><a href="Bahagian VII_User.php">BAHAGIAN VII</a></li>
        </div>

        <div class="form-section">
            <h2>ITEM HARGA PERSETUJUAN</h2>
            <form method="post" onsubmit="return validateApprovalSelection()">
                <p><b>Ada Item Persetujuan?</b></p>
                <input type="radio" id="ada" name="item_approval" value="ada" onclick="toggleApprovedItems(true)">
                <label for="ada">Tambah Item Harga Persetujuan</label>


                <!-- Form for adding approved items (hidden by default) -->
                <div id="approvalForm" style="display: none;">
                    <h3>Tambah Item Harga Persetujuan</h3>
                    <label for="item_name">Item : </label>
                    <input type="text" id="item_name" name="item_name" required>
                    <br>
                    <br><label for="price">Harga :</label>
                    <input type="number" id="price" name="price" required step="0.01">
                    <br>
                    <br><label for="quantity">Kuantiti :</label>
                    <input type="number" id="quantity" name="quantity" required>
                    <br><br>
                    <button type="submit" name="add_approved_item">Tambah</button>
                </div>
            </form>

            <div class="form-section">
                <h3>List Item Harga Persetujuan</h3>
                <table>
                    <tr>
                        <th>No</th>
                        <th>Keterangan</th>
                        <th>Harga</th>
                        <th>Kuantiti</th>
                        <th>Jumlah</th>
                        <th></th>
                    </tr>
                    <?php if (!empty($approved_items)): ?>
                        <?php foreach ($approved_items as $index => $item): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= htmlspecialchars($item['item_name']) ?></td>
                                <td>RM <?= number_format($item['price'], 2) ?></td>
                                <td><?= htmlspecialchars($item['quantity']) ?></td>
                                <td>RM <?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                                <td>
                                    <form method="post" style="display:inline;">
                                        <input type="hidden" name="item_id" value="<?= $item['id'] ?>">
                                        <button type="submit" name="remove_approved_item"
                                            onclick="return confirm('Anda pasti mahu batalkan item ini?');">Batal</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">Tiada</td>
                        </tr>
                    <?php endif; ?>
                </table>
                <p><strong>Jumlah Keseluruhan : RM <?= number_format($totalApprovedAmount, 2) ?></strong></p>
            </div>

            <h1>SLIP</h1>

            <!-- Lokasi Form -->
            <div class="format-section">
                <form method="post">
                    <label><b>Projek :</b></label>
                    <input type="text" name="projek" required style="width: 300px; height: 40px;"><br>

                    <br> <label><b>Jarak (km):</b></label>
                    <input type="number" name="jarak" required><br>

                    <br><label for="negeri"><b>Negeri:</b></label>
                    <select id="negeri" name="negeri" onchange="updateDistricts()" required>
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
                        <option value="labuan">JKR Elektrik Labuan</option>
                        <option value="putrajaya">JKR Elektrik Putrajaya</option>
                        <option value="kuala_lumpur">JKR Elektrik Kuala Lumpur</option>
                        <option value="perlis">JKR Elektrik Perlis</option>
                        <option value="kesedar">JKR Elektrik KESEDAR</option>
                        <option value="ketengah">JKR Elektrik KETENGAH</option>
                    </select><br>

                    <br><b><label for="daerah">Daerah:</label></b>
                    <select name="daerah" id="daerah" required>
                        <option value="">-- Pilih Daerah --</option>
                    </select><br>

                    <br><label><b>Kenderaan:</b></label><br>
                    <input type="radio" name="vehicle_type" value="kenderaan_darat" required>Tambahan peratusan sebanyak
                    2% lagi dari JKKE hendaklah dibuat sekiranya jalan ke sesuatu tempat kerja hanya boleh dilalui oleh
                    kenderaan darat berjentera beroda dua (two-wheel vehicle) atau kenderaan berjentera yang mempunyai
                    pacuan empat roda (four-wheel drive vehicle).<br>

                    <br> <input type="radio" name="vehicle_type" value="kenderaan_air">Tambahan peratusan sebanyak 5%
                    lagi dari JKKE hendaklah dibuat sekiranya jalan ke sesuatu tempat kerja hanya boleh dilalui
                    menggunakan kenderaan air dengan mengharungi sungai, tasik atau laut, tanpa jambatan.<br>

                    <br><button type="submit" name="submit_lokasi" id="calculate_tax">Hasilkan Slip</button>
                </form>
            </div>

            <!-- Tax Calculation Results -->
            <?php if (isset($_POST['submit_lokasi'])): ?>
                <div class="slip-section" id="slip-section">
                    <h3>Slip</h3>
                    <p>Projek : <?= htmlspecialchars($_POST['projek']) ?></p>
                    <p>Jarak : <?= htmlspecialchars($_POST['jarak']) ?> km daripada
                        <?php
                        $negeriText = [
                            'pahang' => 'JKR Elektrik Pahang (Pejabat pengeluar inden)',
                            'johor' => 'JKR Elektrik Johor (Pejabat pengeluar inden)',
                            'selangor' => 'JKR Elektrik Selangor (Pejabat pengeluar inden)',
                            'negeri_sembilan' => 'JKR Elektrik Negeri Sembilan (Pejabat pengeluar inden)',
                            'melaka' => 'JKR Elektrik Melaka (Pejabat pengeluar inden)',
                            'kelantan' => 'JKR Elektrik Kelantan (Pejabat pengeluar inden)',
                            'kedah' => 'JKR Elektrik Kedah (Pejabat pengeluar inden)',
                            'pulau_pinang' => 'JKR Elektrik Pulau Pinang (Pejabat pengeluar inden)',
                            'perak' => 'JKR Elektrik Perak (Pejabat pengeluar inden)',
                            'terengganu' => 'JKR Elektrik Terengganu (Pejabat pengeluar inden)',
                            'labuan' => 'JKR Elektrik Labuan (Pejabat pengeluar inden)',
                            'putrajaya' => 'JKR Elektrik Putrajaya (Pejabat pengeluar inden)',
                            'kuala_lumpur' => 'JKR Elektrik Kuala Lumpur (Pejabat pengeluar inden)',
                            'perlis' => 'JKR Elektrik Perlis (Pejabat pengeluar inden)',
                            'kesedar' => 'JKR Elektrik Kesedar (Pejabat pengeluar inden)',
                            'ketengah' => 'JKR Elektrik Ketengah (Pejabat pengeluar inden)'
                        ];
                        echo htmlspecialchars($negeriText[$negeri] ?? '');
                        ?>
                    </p>

                    <!-- DISPLAY TABLE ITEM JKKE AND ITEM HARGA PERSETUJUAN -->

                    <table>
                        <tr>
                            <th rowspan="2" style="text-align: center;">No</th>
                            <th rowspan="2" style="text-align: center;">Keterangan</th>
                            <th colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;JKKE</th>
                            <th rowspan="2" style="text-align: center;">Kuantiti</th>
                            <th rowspan="2" style="text-align: center;">Harga</th>
                        </tr>
                        <tr>
                            <th style="text-align: center;">Bhg.</th>
                            <th style="text-align: center;">Bil.</th>
                            <th style="text-align: center;">RM</th>
                        </tr>
                        <tr>
                            <th><b>A</b></th>
                            <th><u><b>ITEM JKKE</b></u></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>

                        <?php if (!empty($_SESSION['cart'])): ?>
                            <?php foreach ($_SESSION['cart'] as $index => $item): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= htmlspecialchars($item['keterangan']) ?></td>
                                    <td><?= htmlspecialchars($item['bhg']) ?></td>
                                    <td><?= htmlspecialchars($item['bil']) ?></td>
                                    <td>RM <?= number_format($item['harga'], 2) ?></td>
                                    <td><?= htmlspecialchars($item['kuantiti']) ?></td>
                                    <td>RM <?= number_format($item['harga'] * $item['kuantiti'], 2) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7">Tiada</td>
                            </tr>
                        <?php endif; ?>

                        <tr>
                            <th><b>B</b></th>
                            <th><b>ITEM HARGA PERSETUJUAN</b></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <?php if (!empty($approved_items)): ?>
                            <?php $index = 1; ?>
                            <?php foreach ($approved_items as $item): ?>
                                <tr>
                                    <td><?= $index++ ?></td>
                                    <td><?= htmlspecialchars($item['item_name']) ?></td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>RM <?= number_format($item['price'], 2) ?></td>
                                    <td><?= htmlspecialchars($item['quantity']) ?></td>
                                    <td>RM <?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5">Tiada</td>
                            </tr>
                        <?php endif; ?>
                    </table>

                    <p>Jumlah Nilai Kerja : <span class="amount">RM <?= number_format($jumlahNilaiKerja, 2) ?></span></p>

                    <h4><u>PENGIRAAN TAMBAHAN PERATUSAN</u></h4>

                    <p>i. Tambahan peratusan kawasan (Rujuk Jadual 1) :
                        <br>&emsp;
                        <?= number_format($taxRate * 100, 2) ?>%
                        daripada nilai kerja (NK)
                        <span class="amount">RM <?= number_format($taxAmount, 2) ?></span>
                    </p>

                    <p>ii. Tambahan peratusan kesukaran logistik (Rujuk item 1.2.2/1.2.3) :
                        <br>&emsp;
                        <?= number_format($vehicleTaxRate * 100, 2) ?>%
                        daripada nilai kerja (NK)
                        <span class="amount">RM <?= number_format($vehicleTaxAmount, 2) ?></span>
                    </p>

                    <p>Jumlah Besar (JB) 1 :
                        <span class="amount">RM <?= number_format($jumlahBesar, 2) ?></span>
                    </p>

                    <p>Tambahan 20% daripada JB1 oleh sebab jumlah kurang dari RM1,000.00,
                        <br> Rujuk item 1.2.4.
                        <span class="amount">RM <?= number_format($taxAmountLessThan1000, 2) ?></span>
                    </p>

                    <p>Jumlah Besar (JB) 2
                        <span class="amount">RM <?= number_format($CukaiMoreRM1000, 2) ?></span>
                    </p>

                    <?php if ($jumlahNilaiKerja < 1000): ?>
                        <p>Had maksimum bayaran kepada Kontraktor
                            <span class="amount">RM 1,000.00</span>
                        </p>
                        <p>Bayaran Muktamad
                            <span class="amount">RM 1,000.00</span>
                        </p>

                    <?php else: ?>
                        <h3>Bayaran Muktamad:
                            <span class="amount">RM <?= number_format($CukaiMoreRM1000, 2) ?></span>
                        </h3>
                    <?php endif; ?>


                </div>

            <?php endif; ?>

            <br><br>
            <button onclick="downloadPDF()">Download as PDF</button>
            <button onclick="exportToExcel()">Download as Excel</button>



</body>

</html>