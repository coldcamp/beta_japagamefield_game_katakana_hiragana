<?php
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

// Create tables if not exist
$users_table_sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) DEFAULT 'user'
)";
if ($conn->query($users_table_sql) === FALSE) {
    die("Error creating users table: " . $conn->error);
}

$scores_table_sql = "CREATE TABLE IF NOT EXISTS scores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    game VARCHAR(50) NOT NULL,
    score INT NOT NULL,
    date_taken TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (username) REFERENCES users(username)
)";
if ($conn->query($scores_table_sql) === FALSE) {
    die("Error creating scores table: " . $conn->error);
}

// Add role column if not exists
//$conn->query("ALTER TABLE users ADD COLUMN role VARCHAR(20) DEFAULT 'user'");

// Insert default admin user if not exists
$check_admin = $conn->query("SELECT * FROM users WHERE username = 'admin'");
if ($check_admin && $check_admin->num_rows == 0) {
    $conn->query("INSERT INTO users (username, email, password, role) VALUES ('admin', 'admin@example.com', '5191', 'admin')");
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $confirm_pass = $_POST['confirm-password'];

    // Validate passwords match
    if ($pass !== $confirm_pass) {
        echo "Passwords do not match.";
        exit();
    }

    // Store password as plain text
    $plain_pass = $pass;

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $user, $email, $plain_pass);

    // Execute
    if ($stmt->execute()) {
        echo "Account created successfully on VISRODECK! You will be redirected to the login page.";
        echo "<script>setTimeout(function(){ window.location.href = 'login.html'; }, 3000);</script>";
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
