<?php
session_start();

if (!isset($_SESSION["butcher_name"])) {
    echo "Access denied. Please login.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h2>Welcome to Dashboard</h2>

<p>Hello, <?php echo $_SESSION["butcher_name"]; ?>!</p>

<p>Your Email: <?php echo $_SESSION["butcher_email"]; ?></p>

<p><a href="logout.php">Logout</a></p>

</body>
</html>
