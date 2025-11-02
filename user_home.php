 <?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Home - Gamified Hiragana and Katakana Learning</title>
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            padding: 20px;
            background: linear-gradient(135deg, #ff0000 0%, #800080 50%, #0000ff 100%);
            background-size: 200% 200%;
            animation: moveGradient 5s ease infinite;
            font-family: Arial, sans-serif;
        }
        .home-container {
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
        .logout {
            text-align: center;
            margin-top: 20px;
        }
        .logout a {
            color: #dc3545;
            text-decoration: none;
        }
        .btn {
            background-color: #FF1493;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: white;
            color: black;
        }
        .logout a:hover {
            text-decoration: underline;
        }

        @keyframes moveGradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
    </style>
</head>
<body>
    <div class="home-container">
        <div class="message-icon" style="position: absolute; top: 20px; right: 20px; cursor: pointer;" onclick="showMessages()">
            <i class="fas fa-envelope" style="font-size: 24px; color: #FF1493;"></i>
            <span id="unread-count" style="background-color: red; color: white; border-radius: 50%; padding: 2px 6px; font-size: 12px; display: none;"></span>
        </div>
        <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
        <p>This is your personal home page for gamified Hiragana and Katakana learning.</p>
        <nav>
            <ul style="list-style: none; padding: 0;">
                <li><button class="btn" onclick="window.location.href='payment.php'">Advance Level</button></li>
                <li><button class="btn" onclick="window.location.href='characters.php'">Hiragana and Katakana Characters</button></li>
               
                <li><button class="btn" onclick="window.location.href='hiragana_quiz.php'">Hiragana Quiz</button></li>
                <li><button class="btn" onclick="window.location.href='katakana_quiz.php'">Katakana Quiz</button></li>
                <li><button class="btn" onclick="window.location.href='game.php'">Game to Learn (More will Coming Soon)</button></li>
                <li><button class="btn" onclick="window.location.href='user_scores.php'">View My Scores</button></li>
                <li><button class="btn" onclick="window.location.href='user_report.php'">Report Issue</button></li>
            </ul>
        </nav>
        <div class="logout">
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <!-- Messages Modal -->
    <div id="messages-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); z-index: 1000;">
        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px; border-radius: 8px; max-width: 500px; width: 90%;">
            <h3>Messages</h3>
            <div id="messages-list" style="max-height: 300px; overflow-y: auto;">
                <!-- Messages will be loaded here -->
            </div>
            <button onclick="closeMessages()" style="margin-top: 10px;">Close</button>
        </div>
    </div>

    <script>
        function showMessages() {
            fetch('get_messages.php')
                .then(response => response.json())
                .then(data => {
                    const messagesList = document.getElementById('messages-list');
                    messagesList.innerHTML = '';
                    if (data.length > 0) {
                        data.forEach(message => {
                            const messageDiv = document.createElement('div');
                            messageDiv.innerHTML = `<strong>From: ${message.sender}</strong><br>${message.message}<br><small>${message.date_sent}</small><hr>`;
                            messagesList.appendChild(messageDiv);
                        });
                        // Mark messages as read
                        fetch('mark_messages_read.php', { method: 'POST' })
                            .then(() => {
                                // Hide unread count
                                document.getElementById('unread-count').style.display = 'none';
                            })
                            .catch(error => console.error('Error marking messages as read:', error));
                    } else {
                        messagesList.innerHTML = '<p>No messages.</p>';
                    }
                    document.getElementById('messages-modal').style.display = 'block';
                })
                .catch(error => console.error('Error fetching messages:', error));
        }

        function closeMessages() {
            document.getElementById('messages-modal').style.display = 'none';
        }

        // Load unread count on page load
        window.onload = function() {
            fetch('get_unread_count.php')
                .then(response => response.json())
                .then(data => {
                    if (data.unread > 0) {
                        document.getElementById('unread-count').textContent = data.unread;
                        document.getElementById('unread-count').style.display = 'inline';
                    }
                })
                .catch(error => console.error('Error fetching unread count:', error));
        };
    </script>
</body>
</html>
