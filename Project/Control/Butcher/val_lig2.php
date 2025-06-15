<?php
session_start();
include '../model/db.php';

$email = strtolower(trim($_POST['email'] ?? ''));
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    echo "Email and Password are required.";
    exit;
}

$db = new db();
$conn = $db->createConObject();

// Secure version of the query using prepared statements
$query = "SELECT butcher_name, butcher_email, butcher_password FROM butcherregistration WHERE butcher_email=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();


if ($result->num_rows == 1) {
    
    $row = $result->fetch_assoc();
    
    // Verify password against hash
    if (password_verify($password, $row['butcher_password'])) {
        // Set session
        $_SESSION["butcher_name"] = $row["butcher_name"];
        $_SESSION["butcher_email"] = $row["butcher_email"];
        $_SESSION["loggedin"] = true;

        // Optional: Set a secure cookie
        setcookie("butcher_user", $row["butcher_name"], [
            'expires' => time() + (86400 * 30),
            'path' => '/',
            'secure' => true,
            'httponly' => true,
            'samesite' => 'Strict'
        ]);

        // Redirect to dashboard
        header("../view/Dashboard.php");
        exit;
    }
}

// If we get here, login failed
echo "Invalid email or password.";
$stmt->close();
$db->closeCon($conn);
?>