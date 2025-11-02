<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

$username = $_SESSION['username'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $card_number = trim($_POST['card_number']);
    $expiry = trim($_POST['expiry']);
    $cvv = trim($_POST['cvv']);

    // Basic validation: check if fields are not empty
    if (!empty($card_number) && !empty($expiry) && !empty($cvv)) {
        // Simulate payment success
        $_SESSION['paid'] = true;
        header("Location: advance_level.php");
        exit();
    } else {
        $error = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Advance Level Access</title>
    <link rel="stylesheet" href="css/bootstrap.css" />
    <style>
        body {
            padding: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: Arial, sans-serif;
        }
        .payment-container {
            max-width: 600px;
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
        .form-group {
            margin-bottom: 15px;
        }
        .btn-submit {
            width: 100%;
            background-color: #FF1493;
            border: none;
        }
        .btn-submit:hover {
            background-color: white;
            color: black;
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
        .error {
            color: red;
            text-align: center;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="payment-container">
        <h1>Subscription Plans for Advance Level Access</h1>
        <p>Welcome, <?php echo htmlspecialchars($username); ?>! Choose a subscription plan to access the Advance Level. This is a mock payment for demonstration purposes.</p>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form id="payment-form" method="post" action="">
            <div class="form-group">
                <label for="plan">Select Subscription Plan:</label>
                <select class="form-control" id="plan" name="plan" required>
                    <option value="">Choose a plan</option>
                    <option value="monthly">Monthly - 100 pesos/month</option>
                    <option value="yearly">Yearly - 1000 pesos/year</option>
                </select>
            </div>
            <div class="form-group">
                <label for="card_number">Card Number:</label>
                <input type="text" class="form-control" id="card_number" name="card_number" placeholder="1234 5678 9012 3456" required>
            </div>
            <div class="form-group">
                <label for="expiry">Expiry Date (MM/YY):</label>
                <input type="text" class="form-control" id="expiry" name="expiry" placeholder="MM/YY" required>
            </div>
            <div class="form-group">
                <label for="cvv">CVV:</label>
                <input type="text" class="form-control" id="cvv" name="cvv" placeholder="123" required>
            </div>
            <button type="submit" class="btn btn-primary btn-submit">Subscribe and Access Advance Level</button>
        </form>

        <!-- Loading Screen -->
        <div id="loading-screen" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(255, 255, 255, 0.9); z-index: 9999; justify-content: center; align-items: center; flex-direction: column;">
            <div class="spinner" style="border: 8px solid #f3f3f3; border-top: 8px solid #FF1493; border-radius: 50%; width: 60px; height: 60px; animation: spin 1s linear infinite;"></div>
            <p style="margin-top: 20px; font-size: 18px; color: #FF1493;">Processing your subscription...</p>
        </div>
        <div class="back-link">
            <a href="user_home.php">Back to Home</a>
        </div>
    </div>

    <script>
        document.getElementById('payment-form').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            // Show loading screen
            document.getElementById('loading-screen').style.display = 'flex';

            // Simulate processing delay (5 seconds)
            setTimeout(function() {
                // Submit the form after 5 seconds
                document.getElementById('payment-form').submit();
            }, 5000);
        });
    </script>
</body>
</html>
