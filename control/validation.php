<?php
session_start();
include '../model/db.php';
$err_name = $err_password = $err_email = $err_nid = $err_booking = $err_experience = $err_services = $err_contact = "";
$hasError = false;
$filename = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["butcher_name"])) {
        $err_name = "Invalid Username";
        $hasError = true;
    } else {
        $butcher_name = $_POST["butcher_name"];
    }

    if (empty($_POST["butcher_password"])) {
        $err_password = "Password is required.";
        $hasError = true;
    } elseif (strlen($_POST["butcher_password"]) < 6) {
        $err_password = "Password must be at least 6 characters.";
        $hasError = true;
    } else {
        $butcher_password = $_POST["butcher_password"];
    }

    if (empty($_POST["butcher_email"])) {
        $err_email = "Email is required.";
        $hasError = true;
    } elseif (!filter_var($_POST["butcher_email"], FILTER_VALIDATE_EMAIL)) {
        $err_email = "Invalid email format.";
        $hasError = true;
    } else {
        $butcher_email = $_POST["butcher_email"];
    }

    if (empty($_POST["national_id"])) {
        $err_nid = "NID is required.";
        $hasError = true;
    } elseif (!preg_match("/^[0-9]{10,17}$/", $_POST["national_id"])) {
        $err_nid = "Invalid NID (10–17 digits only).";
        $hasError = true;
    } else {
        $national_id = $_POST["national_id"];
    }

    if (empty($_POST["butcher_booking"])) {
        $err_booking = "Please select a booking type.";
        $hasError = true;
    } else {
        $butcher_booking = $_POST["butcher_booking"];
    }

    if (!isset($_POST["experience"]) || $_POST["experience"] < 0) {
        $err_experience = "Invalid experience.";
        $hasError = true;
    } else {
        $experience = $_POST["experience"];
    }

    $available_time = $_POST["available_time"] ?? "";

    if (empty($_POST["services"])) {
        $err_services = "Select at least one service.";
        $hasError = true;
    } else {
        $services = implode(", ", $_POST["services"]);
    }

    if (empty($_POST["emergency_contact"])) {
        $err_contact = "Contact is required.";
        $hasError = true;
    } elseif (!preg_match("/^[0-9]{10,15}$/", $_POST["emergency_contact"])) {
        $err_contact = "Invalid contact number.";
        $hasError = true;
    } else {
        $emergency_contact = $_POST["emergency_contact"];
    }

    if (!empty($_FILES["myfile"]["name"])) {
        $filename = "../uploads/" . time() . "_" . basename($_FILES["myfile"]["name"]);
        move_uploaded_file($_FILES["myfile"]["tmp_name"], $filename);
    } else {
        $filename = ""; 
    }

     if (!$hasError) {
        $db = new db();
        $conn = $db->createConObject();

        $query = "INSERT INTO butcherregistration 
        (butcher_name, butcher_password, butcher_email, business_area, national_id, butcher_booking, experience, available_time, services, emergency_contact, image_path) 
        VALUES 
        ('$butcher_name', '$butcher_password', '$butcher_email', '{$_POST["Business_area"]}', '$national_id', '$butcher_booking', '$experience', '$available_time', '$services', '$emergency_contact', '$filename')";

        if ($conn->query($query)) {
            // Set session variables
            $_SESSION["butcher_name"] = $butcher_name;
            $_SESSION["butcher_email"] = $butcher_email;

            // Set cookie
            $cookie_name = "butcher_user";
            $cookie_value = $butcher_name;
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); 

            echo "<h3 style='color:green;'>Successfully Registered</h3>";

            // Show cookie message
            if (!isset($_COOKIE[$cookie_name])) {
                echo "<p style='color:red;'>Cookie is not set!</p>";
            } else {
                echo "<p style='color:blue;'>Welcome back, " . $_COOKIE[$cookie_name] . "!</p>";
            }
        } else {
            echo "<h3 style='color:red;'>Error: " . $conn->error . "</h3>";
        }

        $db->closeCon($conn);
    }
}
 

?>
