<?php
session_start();
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Forgot Password</title>
    <link rel="stylesheet" href="../../Design/Style.css" />
</head>
<body>
    <div class="login-container">
        <h1>Reset Password</h1>
        <h4>Enter your email and new password</h4>

        <div class="error-messages">
            <?php foreach ($errors as $error): ?>
                <p class="error-message"><?= htmlspecialchars($error) ?></p>
            <?php endforeach; ?>
        </div>

        <form method="POST" action="../../Control/Customer/update_password.php">
            <input type="email" name="email" placeholder="Email address" required />
            <input type="password" name="new_password" placeholder="New Password" required />
            <input type="password" name="confirm_password" placeholder="Confirm New Password" required />
            <button type="submit" class="login-button">Reset Password</button>
        </form>
        <p class="signup-link">
            Remember your password? <a href="Customer_login.php">Back to login</a>
        </p>
    </div>
</body>
</html>