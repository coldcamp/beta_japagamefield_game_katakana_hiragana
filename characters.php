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
    <title>Hiragana and Katakana Characters - Gamified Learning</title>
    <link rel="stylesheet" href="css/bootstrap.css" />
    <style>
        body {
            padding: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        h1, h2 {
            text-align: center;
            color: #FF1493;
        }
        table {
            width: 100%;
            margin-bottom: 30px;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #dee2e6;
        }
        th {
            background-color: #e9ecef;
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
        <h1>Hiragana and Katakana Characters</h1>
        <p class="text-center">Learn the basic characters for Hiragana and Katakana. Click on a character to hear its pronunciation (feature coming soon).</p>

        <h2>Hiragana</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th></th>
                    <th>a</th>
                    <th>i</th>
                    <th>u</th>
                    <th>e</th>
                    <th>o</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td>あ</td>
                    <td>い</td>
                    <td>う</td>
                    <td>え</td>
                    <td>お</td>
                </tr>
                <tr>
                    <td>k</td>
                    <td>か</td>
                    <td>き</td>
                    <td>く</td>
                    <td>け</td>
                    <td>こ</td>
                </tr>
                <tr>
                    <td>s</td>
                    <td>さ</td>
                    <td>し</td>
                    <td>す</td>
                    <td>せ</td>
                    <td>そ</td>
                </tr>
                <tr>
                    <td>t</td>
                    <td>た</td>
                    <td>ち</td>
                    <td>つ</td>
                    <td>て</td>
                    <td>と</td>
                </tr>
                <tr>
                    <td>n</td>
                    <td>な</td>
                    <td>に</td>
                    <td>ぬ</td>
                    <td>ね</td>
                    <td>の</td>
                </tr>
                <tr>
                    <td>h</td>
                    <td>は</td>
                    <td>ひ</td>
                    <td>ふ</td>
                    <td>へ</td>
                    <td>ほ</td>
                </tr>
                <tr>
                    <td>m</td>
                    <td>ま</td>
                    <td>み</td>
                    <td>む</td>
                    <td>め</td>
                    <td>も</td>
                </tr>
                <tr>
                    <td>y</td>
                    <td>や</td>
                    <td></td>
                    <td>ゆ</td>
                    <td></td>
                    <td>よ</td>
                </tr>
                <tr>
                    <td>r</td>
                    <td>ら</td>
                    <td>り</td>
                    <td>る</td>
                    <td>れ</td>
                    <td>ろ</td>
                </tr>
                <tr>
                    <td>w</td>
                    <td>わ</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>を</td>
                </tr>
                <tr>
                    <td>n</td>
                    <td>ん</td>
                    <td colspan="4"></td>
                </tr>
            </tbody>
        </table>

        <h2>Katakana</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th></th>
                    <th>a</th>
                    <th>i</th>
                    <th>u</th>
                    <th>e</th>
                    <th>o</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td>ア</td>
                    <td>イ</td>
                    <td>ウ</td>
                    <td>エ</td>
                    <td>オ</td>
                </tr>
                <tr>
                    <td>k</td>
                    <td>カ</td>
                    <td>キ</td>
                    <td>ク</td>
                    <td>ケ</td>
                    <td>コ</td>
                </tr>
                <tr>
                    <td>s</td>
                    <td>サ</td>
                    <td>シ</td>
                    <td>ス</td>
                    <td>セ</td>
                    <td>ソ</td>
                </tr>
                <tr>
                    <td>t</td>
                    <td>タ</td>
                    <td>チ</td>
                    <td>ツ</td>
                    <td>テ</td>
                    <td>ト</td>
                </tr>
                <tr>
                    <td>n</td>
                    <td>ナ</td>
                    <td>ニ</td>
                    <td>ヌ</td>
                    <td>ネ</td>
                    <td>ノ</td>
                </tr>
                <tr>
                    <td>h</td>
                    <td>ハ</td>
                    <td>ヒ</td>
                    <td>フ</td>
                    <td>ヘ</td>
                    <td>ホ</td>
                </tr>
                <tr>
                    <td>m</td>
                    <td>マ</td>
                    <td>ミ</td>
                    <td>ム</td>
                    <td>メ</td>
                    <td>モ</td>
                </tr>
                <tr>
                    <td>y</td>
                    <td>ヤ</td>
                    <td></td>
                    <td>ユ</td>
                    <td></td>
                    <td>ヨ</td>
                </tr>
                <tr>
                    <td>r</td>
                    <td>ラ</td>
                    <td>リ</td>
                    <td>ル</td>
                    <td>レ</td>
                    <td>ロ</td>
                </tr>
                <tr>
                    <td>w</td>
                    <td>ワ</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>ヲ</td>
                </tr>
                <tr>
                    <td>n</td>
                    <td>ン</td>
                    <td colspan="4"></td>
                </tr>
            </tbody>
        </table>

        <div class="back-link">
            <a href="user_home.php">Back to Home</a>
        </div>
    </div>
</body>
</html>
