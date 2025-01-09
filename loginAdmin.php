<?php
session_start();
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

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            $_SESSION['username'] = $username;
            header("Location: kemaskini.html");
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    } else {
        $error = "Invalid username or password.";
    }

    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e3f2fd;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: white;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 300px;
        }
        .container h2 {
            margin-bottom: 20px;
            color: #1565c0;
        }
        .container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #90caf9;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
        }
        .container button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #1565c0;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        .container button:hover {
            background-color: #0d47a1;
        }
        .toggle {
            margin-top: 15px;
            font-size: 14px;
            color: #333;
        }
        .toggle a {
            color: #1565c0;
            text-decoration: none;
            font-weight: bold;
        }
        .toggle a:hover {
            text-decoration: underline;
        }
        .error {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Hi, Admin! <br> Selamat Datang!</h2>
        <form action="loginAdmin.php" method="POST">
            <input type="text" name="username" placeholder="Masukkan username" required>
            <input type="password" name="password" placeholder="Masukkan password" required>
            <button type="submit">Log Masuk</button>
        </form>
        <?php if (isset($error)): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>
        <p class="toggle">
            Tiada Akaun? <a href="signupAdmin.html">Daftar Akaun</a>
        </p>
    </div>
</body>
</html>
