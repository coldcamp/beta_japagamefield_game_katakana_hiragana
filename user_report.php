<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

$username = $_SESSION['username'];

// Database connection
$servername = "localhost";
$db_username = "root";
$db_password = "5191";
$dbname = "katakanadatabase";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create reports table if not exists
$reports_table_sql = "CREATE TABLE IF NOT EXISTS reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    type VARCHAR(20) NOT NULL,
    description TEXT NOT NULL,
    date_submitted TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if ($conn->query($reports_table_sql) === FALSE) {
    die("Error creating reports table: " . $conn->error);
}

$message = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $type = $_POST['type'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("INSERT INTO reports (username, type, description) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $type, $description);
    if ($stmt->execute()) {
        $message = "Report submitted successfully!";
    } else {
        $message = "Error submitting report: " . $stmt->error;
    }
    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Issue - Gamified Hiragana and Katakana Learning</title>
    <link rel="stylesheet" href="css/bootstrap.css" />
    <style>
        body {
            padding: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(255, 255, 255, 0.1);
        }
        h1 {
            text-align: center;
            color: #FF1493;
        }
        .back-link {
            text-align: center;
            margin-top: 20px;
        }
        .back-link a {
            color: #FF1493;
            text-decoration: none;
        }
        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Report an Issue</h1>
        <p>Welcome, <?php echo htmlspecialchars($username); ?>! Use this form to report bugs, suggestions, or other issues.</p>

        <?php if ($message): ?>
            <div class="alert alert-info"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="form-group">
                <label for="type">Type of Issue:</label>
                <select class="form-control" id="type" name="type" required>
                    <option value="">Select...</option>
                    <option value="bug">Bug</option>
                    <option value="suggestion">Suggestion</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Report</button>
        </form>

        <div class="back-link">
            <a href="user_home.php">Back to Home</a>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
