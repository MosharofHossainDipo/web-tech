<?php
session_start();
include '../model/db.php';

$email = $_POST["email"] ?? "";
$password = $_POST["password"] ?? "";

if (empty($email) || empty($password)) {
    echo "Email and Password are required.";
    exit;
}

$db = new db();
$conn = $db->createConObject();

// Check if email and password match
$query = "SELECT * FROM butcherregistration WHERE butcher_email='$email' AND butcher_password='$password'";
$result = $conn->query($query);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    
    // Set session
    $_SESSION["butcher_name"] = $row["butcher_name"];
    $_SESSION["butcher_email"] = $row["butcher_email"];

    // Optional: Set a cookie
    setcookie("butcher_user", $row["butcher_name"], time() + (86400 * 30), "/");

    // Redirect to dashboard
    header("Location: Dashboard.php");
    exit;
} else {
    echo "Invalid email or password.";
}

$db->closeCon($conn);
?>
