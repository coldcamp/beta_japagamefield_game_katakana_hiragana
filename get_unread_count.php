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

// Fetch unread message count
$sql = "SELECT COUNT(*) as unread FROM messages WHERE recipient = ? AND is_read = 0";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$stmt->close();
$conn->close();

echo json_encode(['unread' => $row['unread']]);
?>
