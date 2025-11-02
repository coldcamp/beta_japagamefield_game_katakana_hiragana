<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

$username = $_SESSION['username'];

// Full Hiragana list
$all_hiragana = [
    'a' => 'あ', 'i' => 'い', 'u' => 'う', 'e' => 'え', 'o' => 'お',
    'ka' => 'か', 'ki' => 'き', 'ku' => 'く', 'ke' => 'け', 'ko' => 'こ',
    'sa' => 'さ', 'shi' => 'し', 'su' => 'す', 'se' => 'せ', 'so' => 'そ',
    'ta' => 'た', 'chi' => 'ち', 'tsu' => 'つ', 'te' => 'て', 'to' => 'と',
    'na' => 'な', 'ni' => 'に', 'nu' => 'ぬ', 'ne' => 'ね', 'no' => 'の',
    'ha' => 'は', 'hi' => 'ひ', 'fu' => 'ふ', 'he' => 'へ', 'ho' => 'ほ',
    'ma' => 'ま', 'mi' => 'み', 'mu' => 'む', 'me' => 'め', 'mo' => 'も',
    'ya' => 'や', 'yu' => 'ゆ', 'yo' => 'よ',
    'ra' => 'ら', 'ri' => 'り', 'ru' => 'る', 're' => 'れ', 'ro' => 'ろ',
    'wa' => 'わ', 'wo' => 'を', 'n' => 'ん'
];

// Select 30 random keys
$selected_keys = array_rand($all_hiragana, 30);

// Shuffle the selected keys
shuffle($selected_keys);

// Generate options for each question (roman options)
$quiz_questions = [];
foreach ($selected_keys as $roman) {
    $correct = $all_hiragana[$roman];
    $options = [$roman];
    $wrong_options = array_diff(array_keys($all_hiragana), [$roman]);
    $wrong_keys = array_rand($wrong_options, 3);
    if (is_array($wrong_keys)) {
        foreach ($wrong_keys as $wk) {
            $options[] = $wrong_options[$wk];
        }
    } else {
        $options[] = $wrong_options[$wrong_keys];
    }
    shuffle($options);
    $quiz_questions[] = [
        'hiragana' => $correct,
        'correct' => $roman,
        'options' => $options
    ];
}

// Store in session for scoring
$_SESSION['quiz_questions'] = $quiz_questions;

// Handle quiz submission
$score = 0;
$total_questions = 30;
$feedback = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $quiz_questions = $_SESSION['quiz_questions'];
    foreach ($quiz_questions as $q) {
        if (isset($_POST[$q['hiragana']]) && $_POST[$q['hiragana']] == $q['correct']) {
            $score++;
        }
    }

    $feedback = "You scored $score out of $total_questions!";

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

    // Add game column if not exists (for backward compatibility)
    $alter_sql = "ALTER TABLE scores ADD game VARCHAR(50) NOT NULL DEFAULT 'quiz'";
    //$conn->query($alter_sql); // Ignore error if column already exists

    $stmt = $conn->prepare("INSERT INTO scores (username, game, score) VALUES (?, ?, ?)");
    $game = 'hiragana_quiz';
    $stmt->bind_param("ssi", $username, $game, $score);
    if ($stmt->execute()) {
        $feedback .= " Score saved successfully!";
    } else {
        $feedback .= " Error saving score: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gamification Quiz - Hiragana and Katakana Learning</title>
    <link rel="stylesheet" href="css/bootstrap.css" />
    <style>
        body {
            padding: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: Arial, sans-serif;
        }
        .quiz-container {
            max-width: 800px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #FF1493;
        }
        .question {
            margin-bottom: 20px;
        }
        .question h3 {
            color: #495057;
        }
        .options {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .option {
            flex: 1 1 45%;
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
        .feedback {
            text-align: center;
            margin-top: 20px;
            font-size: 1.2em;
            color: #28a745;
        }
    </style>
</head>
<body>
    <div class="quiz-container">
        <h1>Gamification Quiz: Hiragana Basics</h1>
        <p class="text-center">Test your knowledge of basic Hiragana characters. Select the correct romanization for each character.</p>

        <?php if ($feedback): ?>
            <div class="feedback">
                <strong><?php echo $feedback; ?></strong>
            </div>
        <?php endif; ?>

        <form method="post">
            <?php foreach ($quiz_questions as $index => $q): ?>
                <div class="question">
                    <h3><?php echo ($index + 1) . ". What is the romanization for '" . $q['hiragana'] . "'?"; ?></h3>
                    <div class="options">
                        <?php foreach ($q['options'] as $option): ?>
                            <label class="option"><input type="radio" name="<?php echo $q['hiragana']; ?>" value="<?php echo $option; ?>" required> <?php echo $option; ?></label>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg">Submit Quiz</button>
            </div>
        </form>

        <div class="back-link">
            <a href="user_home.php">Back to Home</a>
        </div>
    </div>
</body>
</html>
