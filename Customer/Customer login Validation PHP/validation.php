<?php
session_start();
include '../model/db.php';
$_err_name = $_err_email = $_err_phone = $_err_business_area = $_err_dob = $_err_service_type = $_err_password = $_err_profile_pic = "";
$hasError = false;
$filename="";

$name = trim($_POST["name"]);
if (empty($name)) {
    $_err_name = "Full Name is required.";
    $hasError = true;
} elseif (str_word_count($name) < 2) {
    $_err_name = "Full Name must contain at least two words.";
    $hasError = true;
}

$email = trim($_POST["email"]);
if (empty($email)) {
    $_err_email = "Email is required.";
    $hasError = true;
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_err_email = "Invalid email format.";
    $hasError = true;
}

$phone = trim($_POST["phone"]);
if (empty($phone)) {
    $_err_phone = "Phone number is required.";
    $hasError = true;
} elseif (substr($phone, 0, 5) !== "+8801" || strlen($phone) !== 14) {
    $_err_phone = "Phone must start with +8801 and be 14 characters long.";
    $hasError = true;
}

$business_area = isset($_POST["Business_area"]) ? trim($_POST["Business_area"]) : '';
if (empty($business_area)) {
    $_err_business_area = "Business area must be selected.";
    $hasError = true;
}

$dob = trim($_POST["dob"]);
if (empty($dob)) {
    $_err_dob = "Date of Birth is required.";
    $hasError = true;
} elseif (!DateTime::createFromFormat('Y-m-d', $dob)) {
    $_err_dob = "Date of Birth must be in YYYY-MM-DD format.";
    $hasError = true;
}

$service_type = isset($_POST["service_type"]) ? trim($_POST["service_type"]) : '';
if (empty($service_type)) {
    $_err_service_type = "Please select a service type.";
    $hasError = true;
}

$password = $_POST["password"];
if (empty($password)) {
    $_err_password = "Password is required.";
    $hasError = true;
} elseif (!strpbrk($password, "0123456789") || !strpbrk($password, "!@#$%^&*")) {
    $_err_password = "Password must include at least one number and one special character.";
    $hasError = true;
}

$profile_pic_name = "";
if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($_FILES['profile_pic']['type'], $allowed_types)) {
        $_err_profile_pic = "Only JPG, PNG, and GIF images are allowed.";
        $hasError = true;
    } else {
        $upload_dir = "../uploads/";
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $profile_pic_name = basename($_FILES['profile_pic']['name']);
        $target_file = $upload_dir . $profile_pic_name;
        move_uploaded_file($_FILES['profile_pic']['tmp_name'], $target_file);
    }
}

$butchering_time = trim($_POST["butchering_time"]);

if (!$hasError) {
    $db = new db();
    $conn = $db->createConObject();

    $customerInsert = $db->insertCustomer($conn, $name, $email, $phone, $business_area, $dob, $profile_pic_name, $butchering_time, $password);

    if ($customerInsert === true) {
        $_SESSION['customer_name'] = $name;
        $_SESSION['customer_email'] = $email;

        setcookie("customer_email", $email, time() + (7 * 24 * 60 * 60), "/");

        
    } else {
        $_err_name = "Customer Insertion Error: " . $customerInsert;
        $hasError = true;
    }
    $db->closeCon($conn);
}
?>
