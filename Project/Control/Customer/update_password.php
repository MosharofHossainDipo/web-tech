<?php
session_start();
include '../../Model/Customer/db.php';

$_SESSION['errors'] = [];
$hasError = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email'] ?? '');
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Validations
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['errors'][] = "A valid email is required.";
        $hasError = true;
    }

    if (empty($new_password) || !preg_match("/^(?=.*[0-9])(?=.*[!@#$%^&*]).{8,}$/", $new_password)) {
        $_SESSION['errors'][] = "Password must be at least 8 characters long and include at least one number and one special character.";
        $hasError = true;
    }

    if ($new_password !== $confirm_password) {
        $_SESSION['errors'][] = "Passwords do not match.";
        $hasError = true;
    }

    if ($hasError) {
        header("Location: ../../View/Customer/Forget_pass.php");
        exit();
    }

    $db = new db();
    $conn = $db->createConObject();
    $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);

    $result = $db->updatePassword($conn, "customerreg", $email, $hashedPassword);
    $db->closeCon($conn);

    if ($result === true) {
        $_SESSION['password_reset_success'] = "Password has been reset successfully. Please login.";
        header("Location: ../../View/Customer/Customer_login.php");
        exit();
    } else {
        $_SESSION['errors'][] = $result;
        header("Location: ../../View/Customer/Forget_pass.php");
        exit();
    }

} else {
    header("Location: ../../View/Customer/Forget_pass.php");
    exit();
}
?>