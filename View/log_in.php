<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Butcher Login</title>
</head>
<body>

<h2>Login</h2>

<form action="validation_login.php" method="post">
    <label>Email:</label><br>
    <input type="text" name="email"><br><br>

    <label>Password:</label><br>
    <input type="password" name="password"><br><br>

    <input type="submit" value="Login">
</form>

</body>
</html>
