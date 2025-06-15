<?php
session_start();
$_SESSION = [];
session_destroy();


header("Location: Customer_login.php");
exit;
?>
