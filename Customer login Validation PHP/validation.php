<?php
$full_name = trim($_POST["full_name"]);
if (empty($full_name)) {
    $errors[] = "Full Name is required.";
} elseif (str_word_count($full_name) < 2) {
    $errors[] = "Full Name must contain at least two words.";
}

$email = trim($_POST["email"]);
if (empty($email)) {
    $errors[] = "Email is required.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format.";
}

$phone = trim($_POST["phone"]);
if (empty($phone)) {
    $errors[] = "Phone number is required.";
} elseif (substr($phone, 0, 5) !== "+8801" || strlen($phone) !== 14) {
    $errors[] = "Phone must start with +8801 and be 14 characters long.";
}

$business_area = isset($_POST["Business_area"]) ? trim($_POST["Business_area"]) : '';
if (empty($business_area)) {
    $errors[] = "Business area must be selected.";
}

$dob = trim($_POST["dob"]);
if (empty($dob)) {
    $errors[] = "Date of Birth is required.";
} elseif (!DateTime::createFromFormat('Y-m-d', $dob)) {
    $errors[] = "Date of Birth must be in YYYY-MM-DD format.";
}

$service_type = isset($_POST["service_type"]) ? trim($_POST["service_type"]) : '';
if (empty($service_type)) {
    $errors[] = "Please select a service type.";
}

$password = $_POST["password"];
if (empty($password)) {
    $errors[] = "Password is required.";
} elseif (
    !strpbrk($password, "0123456789") || 
    !strpbrk($password, "!@#$%^&*")
) {
    $errors[] = "Password must include at least one number and one special character.";
}

if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($_FILES['profile_pic']['type'], $allowed_types)) {
        $errors[] = "Only JPG, PNG, and GIF images are allowed.";
    }
}
?>
