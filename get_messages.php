<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
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
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed']);
    exit();
}

// Fetch messages for the user
$sql = "SELECT sender, message, date_sent FROM messages WHERE recipient = ? ORDER BY date_sent DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

$stmt->close();
$conn->close();

echo json_encode($messages);
?>
