<?php
$host = 'localhost';
$db = 'jadual';
$user = 'root';
$password = '';

// Connect to the database
$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Username exists
        $error = urlencode("Username already taken.");
        header("Location: signupAdmin.html?error=$error");
        exit();
    }

    // Hash the password before storing it
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert the new user into the database
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashed_password);
    
    if ($stmt->execute()) {
        header("Location: loginAdmin.php"); // Redirect to login page after successful signup
        exit();
    } else {
        $error = urlencode("Something went wrong. Please try again.");
        header("Location: signupAdmin.html?error=$error");
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
