<?php include 'header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Butcher Login</title>
    <link rel="stylesheet" type="text/css" href="../ButcherCSS/log_in.css">
</head>
<body>

<div class="login-container">
    <h2>Butcher Login</h2>
    <form action="validation_login.php" method="POST">
        <input type="email" name="email" placeholder="Enter Email" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <input type="submit" value="Login">
    </form>
    <div class="login-footer">
        Don't have an account? <a href="ButcherRegistration.php">Register here</a>
    </div>
</div>

</body>
</html>
