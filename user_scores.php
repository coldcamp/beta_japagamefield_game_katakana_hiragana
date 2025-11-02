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

// Fetch user's scores
$stmt = $conn->prepare("SELECT game, score, date_taken FROM scores WHERE username = ? ORDER BY date_taken DESC");
$stmt->bind_param("s", $username);
$stmt->execute();
$scores_result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Score History - Gamified Hiragana and Katakana Learning</title>
    <link rel="stylesheet" href="css/bootstrap.css" />
    <style>
        body {
            padding: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background: #ffffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #FF1493;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #dee2e6;
            padding: 8px 12px;
            text-align: left;
        }
        th {
            background-color: #FF1493;
            color: white;
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
        <h1>Your Score History</h1>
        <p>Welcome, <?php echo htmlspecialchars($username); ?>! Here are your game scores.</p>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Game</th>
                    <th>Score</th>
                    <th>Date Taken</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($scores_result && $scores_result->num_rows > 0): ?>
                    <?php while($row = $scores_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['game']); ?></td>
                            <td><?php echo htmlspecialchars($row['score']); ?></td>
                            <td><?php echo htmlspecialchars($row['date_taken']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="3">No scores yet. Play some games!</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="back-link">
            <a href="user_home.php">Back to Home</a>
        </div>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
