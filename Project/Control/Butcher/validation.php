<?php
// filepath: ../control/validation.php

include '../../model/Butcher/db.php';

$err_name = $err_password = $err_email = $err_nid = $err_booking = $err_experience = $err_services = $err_contact = "";

$butcher_name = $butcher_password = $butcher_email = $Business_area = $national_id = $butcher_booking = $experience = $available_time = $emergency_contact = "";
$services = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    function clean_input($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    $butcher_name = clean_input($_POST["butcher_name"] ?? "");
    $butcher_password = $_POST["butcher_password"] ?? "";
    $butcher_email = strtolower(clean_input($_POST["butcher_email"] ?? "")); // Normalize email to lowercase
    $Business_area = $_POST["Business_area"] ?? "";
    $national_id = clean_input($_POST["national_id"] ?? "");
    $butcher_booking = $_POST["butcher_booking"] ?? "";
    $experience = $_POST["experience"] ?? "";
    $available_time = $_POST["available_time"] ?? "";
    $services = $_POST["services"] ?? [];
    $emergency_contact = clean_input($_POST["emergency_contact"] ?? "");

    // Validation
    if (empty($butcher_name)) $err_name = "Name is required";
    if (empty($butcher_password)) $err_password = "Password is required";
    if (empty($butcher_email) || !filter_var($butcher_email, FILTER_VALIDATE_EMAIL)) $err_email = "Valid email is required";
    if (empty($national_id)) $err_nid = "NID is required";
    if (empty($butcher_booking)) $err_booking = "Select a booking type";
    if (empty($experience) || !is_numeric($experience)) $err_experience = "Enter valid years of experience";
    if (empty($services)) $err_services = "Select at least one service";
    if (empty($emergency_contact)) $err_contact = "Contact number required";

    if (
        empty($err_name) && empty($err_password) && empty($err_email) &&
        empty($err_nid) && empty($err_booking) && empty($err_experience) &&
        empty($err_services) && empty($err_contact)
    ) {
        //$hashed_password = password_hash($butcher_password, PASSWORD_DEFAULT);

        $db = new db();
        $conn = $db->createConObject();

        // Check for duplicate email
        $check_stmt = $conn->prepare("SELECT butcher_email FROM butcherregistration WHERE butcher_email = ?");
        $check_stmt->bind_param("s", $butcher_email);
        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows > 0) {
            $err_email = "Email already registered.";
            $check_stmt->close();
            $db->closeCon($conn);
        } else {
            $check_stmt->close();

            // Use the new insert method
            $result = $db->insertButcherRegistration($conn, "butcherregistration", $butcher_name, $butcher_password, $butcher_email, $Business_area, $national_id, $butcher_booking, $experience, $available_time, implode(", ", $services), $emergency_contact, ""); // Assuming no image path for now

            if ($result === true) {
                session_start();
                $_SESSION['registration_success'] = true;
                $db->closeCon($conn);
                header("Location: ../../View/Butcher/log_in.php");
                exit();
            } else {
                $err_name = "Database error: " . $result;
                $db->closeCon($conn);
            }
        }
    }
}
?>
