<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

$username = $_SESSION['username'];
$feedback = '';

// Handle score saving
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_score'])) {
    $score = intval($_POST['score']);

    // Save score to database
    $servername = "localhost";
    $db_username = "root";
    $db_password = "5191";
    $dbname = "katakanadatabase";

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Create scores table if not exists
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

    $stmt = $conn->prepare("INSERT INTO scores (username, game, score) VALUES (?, ?, ?)");
    $game = 'advance_memorycard';
    $stmt->bind_param("ssi", $username, $game, $score);
    if ($stmt->execute()) {
        $feedback = "Score saved successfully!";
    } else {
        $feedback = "Error saving score: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Advance Memory Card Game - Hiragana and Katakana</title>
    <link rel="stylesheet" href="css/bootstrap.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
        }
        .game-container {
            max-width: 700px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        h1 {
            color: #FF1493;
            margin-bottom: 20px;
        }
        .game-board {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            margin: 30px 0;
        }
        .card {
            width: 80px;
            height: 80px;
            background: #FF1493;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2em;
            cursor: pointer;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .card.flipped {
            background: white;
            color: black;
        }
        .card.matched {
            background: #28a745;
            cursor: default;
        }
        #score {
            margin-top: 20px;
            font-size: 1.2em;
            color: #28a745;
        }
        .back-link {
            margin-top: 30px;
        }
        .back-link a {
            color: #007bff;
            text-decoration: none;
        }
        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="game-container">
        <h1>Advance Memory Card Game</h1>
        <p>Click on cards to flip them. Match pairs of advanced Hiragana and Katakana characters!</p>
        <div class="game-board" id="game-board"></div>
        <div id="score">Matches: 0</div>
        <?php if ($feedback): ?>
            <div class="alert alert-success mt-3"><?php echo $feedback; ?></div>
        <?php endif; ?>
        <form method="post" class="mt-3">
            <input type="hidden" name="score" id="score-input" value="0">
            <button type="submit" name="save_score" class="btn btn-primary">Save Score</button>
        </form>
        <div class="back-link">
            <a href="advance_game.php">Back to Advance Games</a>
        </div>
    </div>

    <script>
        const characters = ['が', 'ざ', 'だ', 'ば', 'ぱ', 'きゃ', 'しゃ', 'ちゃ', 'にゃ', 'ひゃ', 'みゃ', 'りゃ', 'ぎゃ', 'じゃ', 'びゃ', 'ぴゃ', 'ガ', 'ザ', 'ダ', 'バ', 'パ', 'キャ', 'シャ', 'チャ', 'ニャ', 'ヒャ', 'ミャ', 'リャ', 'ギャ', 'ジャ', 'ビャ', 'ピャ'];
        const gameBoard = document.getElementById('game-board');
        const scoreDiv = document.getElementById('score');
        let cards = [];
        let flippedCards = [];
        let matchedPairs = 0;

        function shuffle(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
            return array;
        }

        function createBoard() {
            const cardValues = [...characters.slice(0, 8), ...characters.slice(0, 8)]; // Use first 8 for pairs
            const shuffledValues = shuffle(cardValues);
            shuffledValues.forEach(value => {
                const card = document.createElement('div');
                card.classList.add('card');
                card.dataset.value = value;
                card.addEventListener('click', flipCard);
                gameBoard.appendChild(card);
                cards.push(card);
            });
        }

        function flipCard() {
            if (flippedCards.length < 2 && !this.classList.contains('flipped') && !this.classList.contains('matched')) {
                this.classList.add('flipped');
                this.textContent = this.dataset.value;
                flippedCards.push(this);

                if (flippedCards.length === 2) {
                    setTimeout(checkMatch, 500);
                }
            }
        }

        function checkMatch() {
            const [card1, card2] = flippedCards;
            if (card1.dataset.value === card2.dataset.value) {
                card1.classList.add('matched');
                card2.classList.add('matched');
                matchedPairs++;
                scoreDiv.textContent = 'Matches: ' + matchedPairs;
                document.getElementById('score-input').value = matchedPairs;
                if (matchedPairs === 8) {
                    setTimeout(() => alert('Congratulations! You matched all pairs!'), 500);
                }
            } else {
                card1.classList.remove('flipped');
                card1.textContent = '';
                card2.classList.remove('flipped');
                card2.textContent = '';
            }
            flippedCards = [];
        }

        createBoard();
    </script>
</body>
</html>
