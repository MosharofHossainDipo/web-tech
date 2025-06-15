<?php
session_start();
include '../../Model/Customer/db.php';

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$errors = [];


if (empty($email)) {
    $errors[] = "Email is required.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format.";
}


if (empty($password)) {
    $errors[] = "Password is required.";
}


if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: ../../View/Customer/Customer_login.php");
    exit();
}


$db = new db();
$conn = $db->createConObject();

if ($conn->connect_error) {
    $_SESSION['errors'] = ["Database connection failed: " . $conn->connect_error];
    header("Location: ../../View/Customer/Customer_login.php");
    exit();
}


$escaped_email = $conn->real_escape_string($email);

$query = "SELECT * FROM customerreg WHERE email = '$escaped_email' LIMIT 1";
$result = $conn->query($query);

if ($result && $result->num_rows === 1) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
        $_SESSION['login_success'] = true;
        $_SESSION['name'] = $user['name'];
        $_SESSION['email'] = $user['email'];

        header("Location: ../../Dashboard/Customer_Dashboard.php");
        exit();
    }
}

$_SESSION['errors'] = ["Invalid email or password."];
header("Location: ../../View/Customer/Customer_login.php");
exit();

if (isset($_SESSION['login_success']) && $_SESSION['login_success'] === true) {
    setcookie('user_email', $_SESSION['email'], time() + (7 * 24 * 60 * 60), "/");
}
