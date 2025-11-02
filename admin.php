<?php

session_start();

// Check if user is logged in and is admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.html");
    exit();
}

// Database connection
$servername = "localhost";
$db_username = "root";
$db_password = "5191";
$dbname = "katakanadatabase";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create messages table if not exists
$conn->query("CREATE TABLE IF NOT EXISTS messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sender VARCHAR(255),
    recipient VARCHAR(255),
    message TEXT,
    date_sent TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_read TINYINT DEFAULT 0
)");

// Handle delete user request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
    $user_to_delete = $_POST['delete_user'];
    // Delete user scores first due to foreign key constraint
    $stmt_scores = $conn->prepare("DELETE FROM scores WHERE username = ?");
    $stmt_scores->bind_param("s", $user_to_delete);
    $stmt_scores->execute();
    $stmt_scores->close();

    // Delete user
    $stmt_user = $conn->prepare("DELETE FROM users WHERE username = ?");
    $stmt_user->bind_param("s", $user_to_delete);
    $stmt_user->execute();
    $stmt_user->close();
}

// Fetch all users
$users_sql = "SELECT username, email, password, role FROM users";
$users_result = $conn->query($users_sql);

// Fetch all scores with usernames and games
$scores_sql = "SELECT username, game, score, date_taken FROM scores ORDER BY date_taken DESC";
$scores_result = $conn->query($scores_sql);

// Fetch all reports
$reports_sql = "SELECT username, type, description, date_submitted FROM reports ORDER BY date_submitted DESC";
$reports_result = $conn->query($reports_sql);

// Handle send message request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_message'])) {
    $recipient = $_POST['recipient'];
    $message = $_POST['message'];
    $sender = $_SESSION['username'];

    $stmt = $conn->prepare("INSERT INTO messages (sender, recipient, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $sender, $recipient, $message);
    $stmt->execute();
    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Dashboard - User Accounts and Scores</title>
    <link rel="stylesheet" href="css/bootstrap.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
        }
        .container {
            max-width: 900px;
            margin: 30px auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #007bff;
            margin-bottom: 20px;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }
        th, td {
            border: 1px solid #dee2e6;
            padding: 8px 12px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        caption {
            font-weight: bold;
            font-size: 1.2em;
            margin-bottom: 10px;
            text-align: left;
        }
        form {
            margin: 0;
        }
        button.delete-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 6px 12px;
            cursor: pointer;
            border-radius: 4px;
        }
        button.delete-btn:hover {
            background-color: #c82333;
        }
        .logout {
            text-align: center;
            margin-top: 20px;
        }
        .logout a {
            color: #dc3545;
            text-decoration: none;
            font-weight: bold;
        }
        .logout a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Dashboard</h1>
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>

        <h2>User Accounts</h2>
        <table>
            <caption>User Accounts</caption>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($users_result && $users_result->num_rows > 0): ?>
                    <?php while($row = $users_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['password']); ?></td>
                            <td><?php echo htmlspecialchars($row['role']); ?></td>
                            <td>
                                <?php if ($row['username'] !== 'admin'): ?>
                                <form method="POST" onsubmit="return confirm('Are you sure you want to delete this user and their scores?');">
                                    <input type="hidden" name="delete_user" value="<?php echo htmlspecialchars($row['username']); ?>" />
                                    <button type="submit" class="delete-btn">Delete</button>
                                </form>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="4">No users found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h2>User Scores</h2>
        <table>
            <caption>User Scores</caption>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Game</th>
                    <th>Score</th>
                    <th>Date Taken</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($scores_result && $scores_result->num_rows > 0): ?>
                    <?php while($row = $scores_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                            <td><?php echo htmlspecialchars($row['game']); ?></td>
                            <td><?php echo htmlspecialchars($row['score']); ?></td>
                            <td><?php echo htmlspecialchars($row['date_taken']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="4">No scores found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h2>User Reports</h2>
        <table>
            <caption>User Reports</caption>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Date Submitted</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($reports_result && $reports_result->num_rows > 0): ?>
                    <?php while($row = $reports_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                            <td><?php echo htmlspecialchars($row['type']); ?></td>
                            <td><?php echo htmlspecialchars($row['description']); ?></td>
                            <td><?php echo htmlspecialchars($row['date_submitted']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="4">No reports found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h2>Send Message to User</h2>
        <form method="POST">
            <div class="form-group">
                <label for="recipient">Recipient:</label>
                <select name="recipient" id="recipient" class="form-control" required>
                    <option value="">Select a user</option>
                    <?php
                    $users_result->data_seek(0); // Reset pointer
                    while($row = $users_result->fetch_assoc()): ?>
                        <option value="<?php echo htmlspecialchars($row['username']); ?>"><?php echo htmlspecialchars($row['username']); ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea name="message" id="message" class="form-control" rows="4" required></textarea>
            </div>
            <button type="submit" name="send_message" class="btn btn-primary">Send Message</button>
        </form>

        <div class="logout">
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
