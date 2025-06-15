<?php
session_start();
$_SESSION = [];
session_destroy();


header("Location: customer_Login.php");
exit;
?>