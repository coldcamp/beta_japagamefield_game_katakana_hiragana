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
    <title>Advanced Hiragana - Gamified Learning</title>
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
        <h1>Advanced Hiragana</h1>
        <p class="text-center">Comprehensive list of Hiragana characters organized by English letters, including basic, voiced, and combined sounds.</p>

        <div class="letter-section">
            <h2>🅰️ A</h2>
            <ul class="character-list">
                <li><strong>あ</strong> (a)</li>
                <li><strong>い</strong> (i)</li>
                <li><strong>う</strong> (u)</li>
                <li><strong>え</strong> (e)</li>
                <li><strong>お</strong> (o)</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🅱️ B</h2>
            <ul class="character-list">
                <li><strong>ば</strong> (ba)</li>
                <li><strong>び</strong> (bi)</li>
                <li><strong>ぶ</strong> (bu)</li>
                <li><strong>べ</strong> (be)</li>
                <li><strong>ぼ</strong> (bo)</li>
                <li><strong>びゃ</strong> (bya)</li>
                <li><strong>びゅ</strong> (byu)</li>
                <li><strong>びょ</strong> (byo)</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🅲️ C</h2>
            <ul class="character-list">
                <li><strong>ち</strong> (chi)</li>
                <li><strong>ちゃ</strong> (cha)</li>
                <li><strong>ちゅ</strong> (chu)</li>
                <li><strong>ちょ</strong> (cho)</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🅳 D</h2>
            <ul class="character-list">
                <li><strong>だ</strong> (da)</li>
                <li><strong>ぢ</strong> (ji – used rarely)</li>
                <li><strong>づ</strong> (zu – used rarely)</li>
                <li><strong>で</strong> (de)</li>
                <li><strong>ど</strong> (do)</li>
                <li><strong>ぢゃ</strong> (ja – archaic)</li>
                <li><strong>ぢゅ</strong> (ju – archaic)</li>
                <li><strong>ぢょ</strong> (jo – archaic)</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🅴 E</h2>
            <ul class="character-list">
                <li><strong>え</strong> (e)</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🅵 F</h2>
            <ul class="character-list">
                <li><strong>ふ</strong> (fu)</li>
                <li><strong>ふぁ</strong> (fa)</li>
                <li><strong>ふぃ</strong> (fi)</li>
                <li><strong>ふぇ</strong> (fe)</li>
                <li><strong>ふぉ</strong> (fo)</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🅶 G</h2>
            <ul class="character-list">
                <li><strong>が</strong> (ga)</li>
                <li><strong>ぎ</strong> (gi)</li>
                <li><strong>ぐ</strong> (gu)</li>
                <li><strong>げ</strong> (ge)</li>
                <li><strong>ご</strong> (go)</li>
                <li><strong>ぎゃ</strong> (gya)</li>
                <li><strong>ぎゅ</strong> (gyu)</li>
                <li><strong>ぎょ</strong> (gyo)</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🅷 H</h2>
            <ul class="character-list">
                <li><strong>は</strong> (ha)</li>
                <li><strong>ひ</strong> (hi)</li>
                <li><strong>ふ</strong> (fu)</li>
                <li><strong>へ</strong> (he)</li>
                <li><strong>ほ</strong> (ho)</li>
                <li><strong>ひゃ</strong> (hya)</li>
                <li><strong>ひゅ</strong> (hyu)</li>
                <li><strong>ひょ</strong> (hyo)</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🅸 I</h2>
            <ul class="character-list">
                <li><strong>い</strong> (i)</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🅹 J</h2>
            <ul class="character-list">
                <li><strong>じ</strong> (ji)</li>
                <li><strong>じゃ</strong> (ja)</li>
                <li><strong>じゅ</strong> (ju)</li>
                <li><strong>じょ</strong> (jo)</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🅺 K</h2>
            <ul class="character-list">
                <li><strong>か</strong> (ka)</li>
                <li><strong>き</strong> (ki)</li>
                <li><strong>く</strong> (ku)</li>
                <li><strong>け</strong> (ke)</li>
                <li><strong>こ</strong> (ko)</li>
                <li><strong>きゃ</strong> (kya)</li>
                <li><strong>きゅ</strong> (kyu)</li>
                <li><strong>きょ</strong> (kyo)</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🅻 L (not native — unofficial / approximated)</h2>
            <ul class="character-list">
                <li><strong>ら゚</strong> (la)</li>
                <li><strong>り゚</strong> (li)</li>
                <li><strong>る゚</strong> (lu)</li>
                <li><strong>れ゚</strong> (le)</li>
                <li><strong>ろ゚</strong> (lo)</li>
            </ul>
            <p class="note"><strong>Note:</strong> These are experimental — Japanese uses ら, り, る, れ, ろ (ra–ro) for both R and L sounds.</p>
        </div>

        <div class="letter-section">
            <h2>🅼 M</h2>
            <ul class="character-list">
                <li><strong>ま</strong> (ma)</li>
                <li><strong>み</strong> (mi)</li>
                <li><strong>む</strong> (mu)</li>
                <li><strong>め</strong> (me)</li>
                <li><strong>も</strong> (mo)</li>
                <li><strong>みゃ</strong> (mya)</li>
                <li><strong>みゅ</strong> (myu)</li>
                <li><strong>みょ</strong> (myo)</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🅽 N</h2>
            <ul class="character-list">
                <li><strong>な</strong> (na)</li>
                <li><strong>に</strong> (ni)</li>
                <li><strong>ぬ</strong> (nu)</li>
                <li><strong>ね</strong> (ne)</li>
                <li><strong>の</strong> (no)</li>
                <li><strong>にゃ</strong> (nya)</li>
                <li><strong>にゅ</strong> (nyu)</li>
                <li><strong>にょ</strong> (nyo)</li>
                <li><strong>ん</strong> (n)</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🅾️ O</h2>
            <ul class="character-list">
                <li><strong>お</strong> (o)</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🅿️ P</h2>
            <ul class="character-list">
                <li><strong>ぱ</strong> (pa)</li>
                <li><strong>ぴ</strong> (pi)</li>
                <li><strong>ぷ</strong> (pu)</li>
                <li><strong>ぺ</strong> (pe)</li>
                <li><strong>ぽ</strong> (po)</li>
                <li><strong>ぴゃ</strong> (pya)</li>
                <li><strong>ぴゅ</strong> (pyu)</li>
                <li><strong>ぴょ</strong> (pyo)</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🆀 Q</h2>
            <p class="note"><strong>Note:</strong> No native “Q” sound in Japanese. Closest: く (ku), くぁ (kwa), くぃ (kwi), くぇ (kwe), くぉ (kwo)</p>
        </div>

        <div class="letter-section">
            <h2>🆁 R</h2>
            <ul class="character-list">
                <li><strong>ら</strong> (ra)</li>
                <li><strong>り</strong> (ri)</li>
                <li><strong>る</strong> (ru)</li>
                <li><strong>れ</strong> (re)</li>
                <li><strong>ろ</strong> (ro)</li>
                <li><strong>りゃ</strong> (rya)</li>
                <li><strong>りゅ</strong> (ryu)</li>
                <li><strong>りょ</strong> (ryo)</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🆂 S</h2>
            <ul class="character-list">
                <li><strong>さ</strong> (sa)</li>
                <li><strong>し</strong> (shi)</li>
                <li><strong>す</strong> (su)</li>
                <li><strong>せ</strong> (se)</li>
                <li><strong>そ</strong> (so)</li>
                <li><strong>しゃ</strong> (sha)</li>
                <li><strong>しゅ</strong> (shu)</li>
                <li><strong>しょ</strong> (sho)</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🆃 T</h2>
            <ul class="character-list">
                <li><strong>た</strong> (ta)</li>
                <li><strong>ち</strong> (chi)</li>
                <li><strong>つ</strong> (tsu)</li>
                <li><strong>て</strong> (te)</li>
                <li><strong>と</strong> (to)</li>
                <li><strong>ちゃ</strong> (cha)</li>
                <li><strong>ちゅ</strong> (chu)</li>
                <li><strong>ちょ</strong> (cho)</li>
                <li><strong>てぃ</strong> (ti – semi-standard for foreign words)</li>
                <li><strong>とぅ</strong> (tu – semi-standard)</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🆄 U</h2>
            <ul class="character-list">
                <li><strong>う</strong> (u)</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🆅 V (not native — used for foreign words)</h2>
            <ul class="character-list">
                <li><strong>ゔ</strong> (vu)</li>
                <li><strong>う゛ぁ</strong> (va)</li>
                <li><strong>う゛ぃ</strong> (vi)</li>
                <li><strong>う゛ぇ</strong> (ve)</li>
                <li><strong>う゛ぉ</strong> (vo)</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🆆 W</h2>
            <ul class="character-list">
                <li><strong>わ</strong> (wa)</li>
                <li><strong>を</strong> (wo)</li>
                <li><strong>ゐ</strong> (wi – obsolete)</li>
                <li><strong>ゑ</strong> (we – obsolete)</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🆇 X</h2>
            <p class="note"><strong>Note:</strong> No “x” sound in Japanese. Used in romaji typing for small letters like: ぁ (xa), ぃ (xi), ぅ (xu), ぇ (xe), ぉ (xo)</p>
        </div>

        <div class="letter-section">
            <h2>🆈 Y</h2>
            <ul class="character-list">
                <li><strong>や</strong> (ya)</li>
                <li><strong>ゆ</strong> (yu)</li>
                <li><strong>よ</strong> (yo)</li>
                <li><strong>ゃ</strong> (small ya)</li>
                <li><strong>ゅ</strong> (small yu)</li>
                <li><strong>ょ</strong> (small yo)</li>
            </ul>
        </div>

        <div class="letter-section">
            <h2>🆉 Z</h2>
            <ul class="character-list">
                <li><strong>ざ</strong> (za)</li>
                <li><strong>じ</strong> (ji)</li>
                <li><strong>ず</strong> (zu)</li>
                <li><strong>ぜ</strong> (ze)</li>
                <li><strong>ぞ</strong> (zo)</li>
                <li><strong>じゃ</strong> (ja)</li>
                <li><strong>じゅ</strong> (ju)</li>
                <li><strong>じょ</strong> (jo)</li>
            </ul>
        </div>

        <div class="back-link">
            <a href="user_home.php">Back to Home</a>
        </div>
    </div>
</body>
</html>
