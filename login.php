<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "5191";
$dbname = "katakanadatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" || (isset($_GET['username']) && isset($_GET['password']))) {
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $user = $_GET['username'];
        $pass = $_GET['password'];
    } else {
        $user = $_POST['username'];
        $pass = $_POST['password'];
    }

    // Hardcoded user to bypass login  Added hardcoded user 'testuser' with password 'testpass' to login.php 88888888888888888888
    if ($user === 'testuser' && $pass === 'testpass') {
        $_SESSION['username'] = $user;
        $_SESSION['role'] = 'user';
        header("Location: user_home.php");
        exit();
    }

    // Prepare and bind
    $stmt = $conn->prepare("SELECT password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($db_pass, $role);
        $stmt->fetch();

        // Check password (plain text)
        if ($pass === $db_pass) {
            $_SESSION['username'] = $user;
            $_SESSION['role'] = $role;
            if ($role === 'admin') {
                header("Location: admin.php");
            } else {
                header("Location: user_home.php");
            }
            exit();
        } else {
            $error = "Invalid password ";
        }
    } else {
        $error = "Username not found ";
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
    <title>Login Error - VISRODECK</title>
    <link rel="stylesheet" href="css/bootstrap.css" />
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Arial', sans-serif;
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .error-container {
            max-width: 400px;
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            color: #dc3545;
            font-size: 1.5em;
        }
        .error-message {
            color: #dc3545;
            margin-bottom: 20px;
            font-size: 1.1em;
        }
        .back-btn {
            background-color: #FF1493;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px 24px;
            cursor: pointer;
            font-size: 1.1em;
            font-weight: bold;
            transition: background-color 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        .back-btn:hover {
            background-color: white;
            color: black;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h2>Login Failed</h2>
        <p class="error-message"><?php echo $error; ?></p>
        <a href="login.html" class="back-btn">Back to Login</a>
    </div>
</body>
</html>
