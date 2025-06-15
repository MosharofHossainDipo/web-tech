<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$loginSuccess = $_SESSION['login_success'] ?? false;
unset($_SESSION['login_success']);

$registrationSuccess = $_SESSION['registration_success'] ?? false;
if ($registrationSuccess) {
    unset($_SESSION['registration_success']);
}

$passwordResetSuccess = $_SESSION['password_reset_success'] ?? false;
if($passwordResetSuccess){
    unset($_SESSION['password_reset_success']);
}

$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Customer Login</title>
    <link rel="stylesheet" href="../../Design/Style.css" />
</head>
<body>
    <?php if ($registrationSuccess): ?>
        <script>alert("Registration successful! Please login with your credentials.");</script>
    <?php endif; ?>

    <?php if ($passwordResetSuccess): ?>
        <script>alert("<?= htmlspecialchars($passwordResetSuccess) ?>");</script>
    <?php endif; ?>

    <div class="login-container">
        <h4>Please enter your details</h4>
        <h1>Welcome back</h1>

        <?php if ($loginSuccess): ?>
            <p class="success-message">Login Successful</p>
        <?php endif; ?>

        <form method="POST" action="../../Control/Customer/login_Validation.php">
            <div class="error-messages">
                <?php foreach ($errors as $error): ?>
                    <?php if (!empty($error)): ?>
                        <p class="error-message"><?= htmlspecialchars($error) ?></p>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <input type="email" name="email" placeholder="Email address" required />
            <input type="password" name="password" placeholder="Password" required />
            <button type="submit" class="login-button">Sign In</button>
            <a href="Forget_pass.php" class="forget-password-link">Forgot Password?</a>
        </form>

        <p class="signup-link">Don't have an account? <a href="Customer_Registration.php">Sign up</a></p>
    </div>
</body>
</html>