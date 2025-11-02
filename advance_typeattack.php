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
    $game = 'advance_typeattack';
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
    <title>Advance Type Attack Game - Hiragana and Katakana</title>
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
            color: #007bff;
            margin-bottom: 20px;
        }
        #character {
            font-size: 5em;
            margin: 30px 0;
        }
        #input-area {
            font-size: 1.5em;
            padding: 10px;
            width: 100%;
            max-width: 300px;
            border: 1px solid #ced4da;
            border-radius: 4px;
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
        <h1>Advance Type Attack Game</h1>
        <p>Type the romanization of the displayed advanced Hiragana and Katakana character as fast as you can!</p>
        <div id="game-area" style="position: relative; height: 400px; border: 1px solid #ced4da; margin: 30px 0; overflow: hidden;"></div>
        <input type="text" id="input-area" placeholder="Type here..." autofocus autocomplete="off" />
        <div id="score">Score: 0</div>
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
        const characters = [
            { char: 'が', roman: 'ga' },
            { char: 'ざ', roman: 'za' },
            { char: 'だ', roman: 'da' },
            { char: 'ば', roman: 'ba' },
            { char: 'ぱ', roman: 'pa' },
            { char: 'きゃ', roman: 'kya' },
            { char: 'きゅ', roman: 'kyu' },
            { char: 'きょ', roman: 'kyo' },
            { char: 'しゃ', roman: 'sha' },
            { char: 'しゅ', roman: 'shu' },
            { char: 'しょ', roman: 'sho' },
            { char: 'ちゃ', roman: 'cha' },
            { char: 'ちゅ', roman: 'chu' },
            { char: 'ちょ', roman: 'cho' },
            { char: 'にゃ', roman: 'nya' },
            { char: 'にゅ', roman: 'nyu' },
            { char: 'にょ', roman: 'nyo' },
            { char: 'ひゃ', roman: 'hya' },
            { char: 'ひゅ', roman: 'hyu' },
            { char: 'ひょ', roman: 'hyo' },
            { char: 'みゃ', roman: 'mya' },
            { char: 'みゅ', roman: 'myu' },
            { char: 'みょ', roman: 'myo' },
            { char: 'りゃ', roman: 'rya' },
            { char: 'りゅ', roman: 'ryu' },
            { char: 'りょ', roman: 'ryo' },
            { char: 'ぎゃ', roman: 'gya' },
            { char: 'ぎゅ', roman: 'gyu' },
            { char: 'ぎょ', roman: 'gyo' },
            { char: 'じゃ', roman: 'ja' },
            { char: 'じゅ', roman: 'ju' },
            { char: 'じょ', roman: 'jo' },
            { char: 'びゃ', roman: 'bya' },
            { char: 'びゅ', roman: 'byu' },
            { char: 'びょ', roman: 'byo' },
            { char: 'ぴゃ', roman: 'pya' },
            { char: 'ぴゅ', roman: 'pyu' },
            { char: 'ぴょ', roman: 'pyo' },
            { char: 'ガ', roman: 'ga' },
            { char: 'ザ', roman: 'za' },
            { char: 'ダ', roman: 'da' },
            { char: 'バ', roman: 'ba' },
            { char: 'パ', roman: 'pa' },
            { char: 'キャ', roman: 'kya' },
            { char: 'キュ', roman: 'kyu' },
            { char: 'キョ', roman: 'kyo' },
            { char: 'シャ', roman: 'sha' },
            { char: 'シュ', roman: 'shu' },
            { char: 'ショ', roman: 'sho' },
            { char: 'チャ', roman: 'cha' },
            { char: 'チュ', roman: 'chu' },
            { char: 'チョ', roman: 'cho' },
            { char: 'ニャ', roman: 'nya' },
            { char: 'ニュ', roman: 'nyu' },
            { char: 'ニョ', roman: 'nyo' },
            { char: 'ヒャ', roman: 'hya' },
            { char: 'ヒュ', roman: 'hyu' },
            { char: 'ヒョ', roman: 'hyo' },
            { char: 'ミャ', roman: 'mya' },
            { char: 'ミュ', roman: 'myu' },
            { char: 'ミョ', roman: 'myo' },
            { char: 'リャ', roman: 'rya' },
            { char: 'リュ', roman: 'ryu' },
            { char: 'リョ', roman: 'ryo' },
            { char: 'ギャ', roman: 'gya' },
            { char: 'ギュ', roman: 'gyu' },
            { char: 'ギョ', roman: 'gyo' },
            { char: 'ジャ', roman: 'ja' },
            { char: 'ジュ', roman: 'ju' },
            { char: 'ジョ', roman: 'jo' },
            { char: 'ビャ', roman: 'bya' },
            { char: 'ビュ', roman: 'byu' },
            { char: 'ビョ', roman: 'byo' },
            { char: 'ピャ', roman: 'pya' },
            { char: 'ピュ', roman: 'pyu' },
            { char: 'ピョ', roman: 'pyo' }
        ];

        let activeLetters = [];
        let score = 0;
        let gameOver = false;
        let speed = 2; // pixels per frame
        const gameArea = document.getElementById('game-area');
        const inputArea = document.getElementById('input-area');
        const scoreDiv = document.getElementById('score');
        const gameWidth = gameArea.offsetWidth;
        let spawnInterval;
        let updateInterval;
        let speedInterval;
        let inputBuffer = '';

        function spawnLetter() {
            const randomChar = characters[Math.floor(Math.random() * characters.length)];
            const letter = {
                char: randomChar.char,
                roman: randomChar.roman,
                x: gameWidth, // start at right
                y: 150, // fixed y position
                element: null
            };
            letter.element = document.createElement('div');
            letter.element.textContent = letter.char;
            letter.element.style.position = 'absolute';
            letter.element.style.fontSize = '2em';
            letter.element.style.color = '#FF1493';
            gameArea.appendChild(letter.element);
            activeLetters.push(letter);
        }

        function updateDisplay() {
            activeLetters.forEach(letter => {
                if (letter.element) {
                    letter.element.style.left = letter.x + 'px';
                    letter.element.style.top = letter.y + 'px';
                }
            });
        }

        function updateGame() {
            if (gameOver) return;
            activeLetters.forEach((letter, index) => {
                letter.x -= speed;
                if (letter.x < 0) {
                    // Letter reached user, game over
                    gameOver = true;
                    endGame();
                    return;
                }
            });
            updateDisplay();
        }

        function endGame() {
            clearInterval(spawnInterval);
            clearInterval(updateInterval);
            clearInterval(speedInterval);
            scoreDiv.textContent = 'Game Over! Final Score: ' + score;
            inputArea.disabled = true;
        }

        inputArea.addEventListener('keydown', (e) => {
            if (e.key.length === 1 && e.key.match(/[a-z]/i)) {
                e.preventDefault();
                inputBuffer += e.key.toLowerCase();
                const target = activeLetters.find(letter => letter.roman === inputBuffer);
                if (target) {
                    score++;
                    scoreDiv.textContent = 'Score: ' + score;
                    document.getElementById('score-input').value = score;
                    gameArea.removeChild(target.element);
                    activeLetters = activeLetters.filter(l => l !== target);
                    inputBuffer = '';
                    inputArea.value = '';
                } else {
                    if (inputBuffer.length >= 3) {
                        inputBuffer = '';
                        inputArea.value = '';
                    } else {
                        inputArea.value = inputBuffer;
                    }
                }
            }
        });

        // Spawn initial letter
        spawnLetter();

        // Game loop
        updateInterval = setInterval(updateGame, 50);

        // Spawn new letters every 2 seconds
        spawnInterval = setInterval(spawnLetter, 2000);

        // Increase speed every 5 seconds
        speedInterval = setInterval(() => {
            speed += 0.5;
        }, 5000);
    </script>
</body>
</html>
