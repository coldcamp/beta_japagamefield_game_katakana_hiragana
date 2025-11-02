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
    <title>Advanced Katakana - Gamified Learning</title>
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
        h1 {
            text-align: center;
            color: #FF1493;
        }
        h2 {
            color: #FF1493;
            border-bottom: 2px solid #FF1493;
            padding-bottom: 5px;
            margin-top: 30px;
        }
        .letter-section {
            margin-bottom: 20px;
        }
        .character-list {
            display: flex;
            flex-wrap: wrap;
            list-style: none;
            padding: 0;
        }
        .character-list li {
            background: white;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 10px;
            margin: 5px;
            text-align: center;
            flex: 1 1 200px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .character-list li strong {
            font-size: 1.5em;
            color: #FF1493;
        }
        .note {
            font-style: italic;
            color: #6c757d;
        }
        .back-link {
            text-align: center;
            margin-top: 40px;
        }
        .back-link a {
            color: #FF1493;
            text-decoration: none;
            font-weight: bold;
        }
        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Advanced Katakana</h1>
        <p class="text-center">Comprehensive list of Katakana characters organized by English letters, including basic, voiced, and combined sounds.</p>

        <div class="letter-section">
            <h2>🅰️ A</h2>
            <ul class="character-list">
                <li><strong>ア</strong> (a)</li>
                <li><strong>イ</strong> (i)</li>
                <li><strong>ウ</strong> (u)</li>
                <li><strong>エ</strong> (e)</li>
                <li><strong>オ</strong> (o)</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🅱️ B</h2>
            <ul class="character-list">
                <li><strong>バ</strong> (ba)</li>
                <li><strong>ビ</strong> (bi)</li>
                <li><strong>ブ</strong> (bu)</li>
                <li><strong>ベ</strong> (be)</li>
                <li><strong>ボ</strong> (bo)</li>
                <li><strong>ビャ</strong> (bya)</li>
                <li><strong>ビュ</strong> (byu)</li>
                <li><strong>ビョ</strong> (byo)</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🅲️ C</h2>
            <ul class="character-list">
                <li><strong>チ</strong> (chi)</li>
                <li><strong>チャ</strong> (cha)</li>
                <li><strong>チュ</strong> (chu)</li>
                <li><strong>チョ</strong> (cho)</li>
                <li><strong>シ</strong> (shi – for "ci" or "si" sounds in loanwords)</li>
                <li><strong>ツ</strong> (tsu – for "tu" sounds)</li>
                <li><strong>キャ</strong> (kya – sometimes for "ca")</li>
                <li><strong>キュ</strong> (kyu – sometimes for "cu")</li>
                <li><strong>キョ</strong> (kyo – sometimes for "co")</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🅳 D</h2>
            <ul class="character-list">
                <li><strong>ダ</strong> (da)</li>
                <li><strong>ヂ</strong> (ji – rarely used)</li>
                <li><strong>ヅ</strong> (zu – rarely used)</li>
                <li><strong>デ</strong> (de)</li>
                <li><strong>ド</strong> (do)</li>
                <li><strong>ディ</strong> (di)</li>
                <li><strong>ドゥ</strong> (du)</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🅴 E</h2>
            <ul class="character-list">
                <li><strong>エ</strong> (e)</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🅵 F</h2>
            <ul class="character-list">
                <li><strong>フ</strong> (fu)</li>
                <li><strong>ファ</strong> (fa)</li>
                <li><strong>フィ</strong> (fi)</li>
                <li><strong>フェ</strong> (fe)</li>
                <li><strong>フォ</strong> (fo)</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🅶 G</h2>
            <ul class="character-list">
                <li><strong>ガ</strong> (ga)</li>
                <li><strong>ギ</strong> (gi)</li>
                <li><strong>グ</strong> (gu)</li>
                <li><strong>ゲ</strong> (ge)</li>
                <li><strong>ゴ</strong> (go)</li>
                <li><strong>ギャ</strong> (gya)</li>
                <li><strong>ギュ</strong> (gyu)</li>
                <li><strong>ギョ</strong> (gyo)</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🅷 H</h2>
            <ul class="character-list">
                <li><strong>ハ</strong> (ha)</li>
                <li><strong>ヒ</strong> (hi)</li>
                <li><strong>フ</strong> (fu)</li>
                <li><strong>ヘ</strong> (he)</li>
                <li><strong>ホ</strong> (ho)</li>
                <li><strong>ヒャ</strong> (hya)</li>
                <li><strong>ヒュ</strong> (hyu)</li>
                <li><strong>ヒョ</strong> (hyo)</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🅸 I</h2>
            <ul class="character-list">
                <li><strong>イ</strong> (i)</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🅹 J</h2>
            <ul class="character-list">
                <li><strong>ジ</strong> (ji)</li>
                <li><strong>ジャ</strong> (ja)</li>
                <li><strong>ジュ</strong> (ju)</li>
                <li><strong>ジョ</strong> (jo)</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🅺 K</h2>
            <ul class="character-list">
                <li><strong>カ</strong> (ka)</li>
                <li><strong>キ</strong> (ki)</li>
                <li><strong>ク</strong> (ku)</li>
                <li><strong>ケ</strong> (ke)</li>
                <li><strong>コ</strong> (ko)</li>
                <li><strong>キャ</strong> (kya)</li>
                <li><strong>キュ</strong> (kyu)</li>
                <li><strong>キョ</strong> (kyo)</li>
                <li><strong>クァ</strong> (kwa)</li>
                <li><strong>クィ</strong> (kwi)</li>
                <li><strong>クェ</strong> (kwe)</li>
                <li><strong>クォ</strong> (kwo)</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🅻 L (unofficial — for foreign “L” sounds)</h2>
            <ul class="character-list">
                <li><strong>ラ</strong> (ra ≈ la)</li>
                <li><strong>リ</strong> (ri ≈ li)</li>
                <li><strong>ル</strong> (ru ≈ lu)</li>
                <li><strong>レ</strong> (re ≈ le)</li>
                <li><strong>ロ</strong> (ro ≈ lo)</li>
            </ul>
            <p class="note">🛈 Japanese doesn’t distinguish “L” and “R” — they’re both “R” sounds.</p>
        </div>

        <div class="letter-section">
            <h2>🅼 M</h2>
            <ul class="character-list">
                <li><strong>マ</strong> (ma)</li>
                <li><strong>ミ</strong> (mi)</li>
                <li><strong>ム</strong> (mu)</li>
                <li><strong>メ</strong> (me)</li>
                <li><strong>モ</strong> (mo)</li>
                <li><strong>ミャ</strong> (mya)</li>
                <li><strong>ミュ</strong> (myu)</li>
                <li><strong>ミョ</strong> (myo)</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🅽 N</h2>
            <ul class="character-list">
                <li><strong>ナ</strong> (na)</li>
                <li><strong>ニ</strong> (ni)</li>
                <li><strong>ヌ</strong> (nu)</li>
                <li><strong>ネ</strong> (ne)</li>
                <li><strong>ノ</strong> (no)</li>
                <li><strong>ニャ</strong> (nya)</li>
                <li><strong>ニュ</strong> (nyu)</li>
                <li><strong>ニョ</strong> (nyo)</li>
                <li><strong>ン</strong> (n)</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🅾️ O</h2>
            <ul class="character-list">
                <li><strong>オ</strong> (o)</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🅿️ P</h2>
            <ul class="character-list">
                <li><strong>パ</strong> (pa)</li>
                <li><strong>ピ</strong> (pi)</li>
                <li><strong>プ</strong> (pu)</li>
                <li><strong>ペ</strong> (pe)</li>
                <li><strong>ポ</strong> (po)</li>
                <li><strong>ピャ</strong> (pya)</li>
                <li><strong>ピュ</strong> (pyu)</li>
                <li><strong>ピョ</strong> (pyo)</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🆀 Q</h2>
            <p class="note">🛈 No native Q sound Approximate with: クァ (kwa), クィ (kwi), クゥ (kwu), クェ (kwe), クォ (kwo)</p>
        </div>

        <div class="letter-section">
            <h2>🆁 R</h2>
            <ul class="character-list">
                <li><strong>ラ</strong> (ra)</li>
                <li><strong>リ</strong> (ri)</li>
                <li><strong>ル</strong> (ru)</li>
                <li><strong>レ</strong> (re)</li>
                <li><strong>ロ</strong> (ro)</li>
                <li><strong>リャ</strong> (rya)</li>
                <li><strong>リュ</strong> (ryu)</li>
                <li><strong>リョ</strong> (ryo)</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🆂 S</h2>
            <ul class="character-list">
                <li><strong>サ</strong> (sa)</li>
                <li><strong>シ</strong> (shi)</li>
                <li><strong>ス</strong> (su)</li>
                <li><strong>セ</strong> (se)</li>
                <li><strong>ソ</strong> (so)</li>
                <li><strong>シャ</strong> (sha)</li>
                <li><strong>シュ</strong> (shu)</li>
                <li><strong>ショ</strong> (sho)</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🆃 T</h2>
            <ul class="character-list">
                <li><strong>タ</strong> (ta)</li>
                <li><strong>チ</strong> (chi)</li>
                <li><strong>ツ</strong> (tsu)</li>
                <li><strong>テ</strong> (te)</li>
                <li><strong>ト</strong> (to)</li>
                <li><strong>チャ</strong> (cha)</li>
                <li><strong>チュ</strong> (chu)</li>
                <li><strong>チョ</strong> (cho)</li>
                <li><strong>ティ</strong> (ti – semi-standard for foreign words)</li>
                <li><strong>トゥ</strong> (tu – semi-standard)</li>
                <li><strong>チェ</strong> (che)</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🆄 U</h2>
            <ul class="character-list">
                <li><strong>ウ</strong> (u)</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🆅 V (foreign use only)</h2>
            <ul class="character-list">
                <li><strong>ヴ</strong> (vu)</li>
                <li><strong>ヴァ</strong> (va)</li>
                <li><strong>ヴィ</strong> (vi)</li>
                <li><strong>ヴェ</strong> (ve)</li>
                <li><strong>ヴォ</strong> (vo)</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🆆 W</h2>
            <ul class="character-list">
                <li><strong>ワ</strong> (wa)</li>
                <li><strong>ヲ</strong> (wo)</li>
                <li><strong>ヰ</strong> (wi – obsolete)</li>
                <li><strong>ヱ</strong> (we – obsolete)</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🆇 X</h2>
            <p class="note">🛈 Used for small letters in typing: ァ (xa), ィ (xi), ゥ (xu), ェ (xe), ォ (xo)</p>
        </div>

        <div class="letter-section">
            <h2>🆈 Y</h2>
            <ul class="character-list">
                <li><strong>ヤ</strong> (ya)</li>
                <li><strong>ユ</strong> (yu)</li>
                <li><strong>ヨ</strong> (yo)</li>
                <li><strong>ャ</strong> (small ya)</li>
                <li><strong>ュ</strong> (small yu)</li>
                <li><strong>ョ</strong> (small yo)</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🆉 Z</h2>
            <ul class="character-list">
                <li><strong>ザ</strong> (za)</li>
                <li><strong>ジ</strong> (ji)</li>
                <li><strong>ズ</strong> (zu)</li>
                <li><strong>ゼ</strong> (ze)</li>
                <li><strong>ゾ</strong> (zo)</li>
                <li><strong>ジャ</strong> (ja)</li>
                <li><strong>ジュ</strong> (ju)</li>
                <li><strong>ジョ</strong> (jo)</li>
            </ul>
        </div>

        <div class="back-link">
            <a href="user_home.php">Back to Home</a>
        </div>
    </div>
</body>
</html>
