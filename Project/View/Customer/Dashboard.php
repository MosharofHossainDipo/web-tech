<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: Customer_login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Customer Dashboard</title>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h1>
    <p>This is your dashboard.</p>
    <a href="Customer_logout.php">Logout</a>
</body>
</html>
