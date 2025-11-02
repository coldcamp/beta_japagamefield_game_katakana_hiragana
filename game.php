<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Games to Learn - Hiragana and Katakana</title>
    <link rel="stylesheet" href="css/bootstrap.css" />
    <style>
        body {
            padding: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: Arial, sans-serif;
        }
        .game-menu {
            max-width: 600px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        h1 {
            color: #FF1493;
            margin-bottom: 30px;
        }
        .game-option {
            margin-bottom: 20px;
        }
        .game-option a {
            display: block;
            padding: 15px;
            background: #FF1493;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .game-option a:hover {
            background: #E60073;
        }
        .back-link {
            margin-top: 30px;
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
    <div class="game-menu">
        <h1>Games to Learn Hiragana and Katakana</h1>
        <p>Choose a game to practice and have fun learning!</p>
        <div class="game-option">
            <a href="typeattack.php">Type Attack Hiragana - Test your typing speed with Hiragana!</a>
        </div>
        <div class="game-option">
            <a href="typeattack_romanji.php">Type Attack Hiragana with Romanji - Test your typing speed with Hiragana and Romanji hints!</a>
        </div>
        <div class="game-option">
            <a href="typeattack_katakana.php">Type Attack Katakana - Test your typing speed with Katakana!</a>
        </div>
        <div class="game-option">
            <a href="typeattack_katakana_romanji.php">Type Attack Katakana with Romanji - Test your typing speed with Katakana and Romanji hints!</a>
        </div>
        <div class="game-option">
            <a href="memorycard.php">Memory Card Hiragana - Match Hiragana characters!</a>
        </div>
        <div class="game-option">
            <a href="memorycard_romanji.php">Memory Card Hiragana with Romanji - Match Hiragana characters with Romanji hints!</a>
        </div>
        <div class="game-option">
            <a href="memorycard_katakana.php">Memory Card Katakana - Match Katakana characters!</a>
        </div>
        <div class="game-option">
            <a href="memorycard_katakana_romanji.php">Memory Card Katakana with Romanji - Match Katakana characters with Romanji hints!</a>
        </div>
        <div class="back-link">
            <a href="user_home.php">Back to Home</a>
        </div>
    </div>
</body>
</html>
