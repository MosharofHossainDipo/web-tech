<?php
session_start();
include '../../model/Butcher/db.php';

// Initialize variables
$email = trim($_POST["email"] ?? "");
$password = $_POST["password"] ?? "";

// Input validation
$errors = [];
if (empty($email)) {
    $errors[] = "Email is required.";
}
if (empty($password)) {
    $errors[] = "Password is required.";
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: ../View/log_in.php");
    exit;
}

$db = new db();
$conn = $db->createConObject();

// Check if email exists
$query = "SELECT * FROM butcherregistration WHERE butcher_email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    
    // Verify password (assuming plain text for now - NOT RECOMMENDED)
    if ($password === $user['butcher_password']) {
        // Login successful
        $_SESSION["butcher_id"] = $user['id']; // Assuming you have an id column
        $_SESSION["butcher_name"] = $user["butcher_name"];
        $_SESSION["butcher_email"] = $user["butcher_email"];
        $_SESSION['login_success'] = true;
        
        setcookie("butcher_user", $user["butcher_name"], time() + (86400 * 30), "/");
        
        header("Location: ../../View/Butcher/Dashboard.php");
        exit;
    } else {
        $errors[] = "Invalid password.";
    }
} else {
    $errors[] = "Email not found.";
}

// If we get here, login failed
$_SESSION['errors'] = $errors;
header("Location: ../../View/Butcher/log_in.php");
exit;

$stmt->close();
$db->closeCon($conn);
?>