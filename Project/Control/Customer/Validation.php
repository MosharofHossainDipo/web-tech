<?php
session_start();
include '../../Model/Customer/db.php';

$_SESSION['errors'] = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hasError = false;

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $location = trim($_POST["location"]);
    $datetime = trim($_POST["datetime"]);
    $need_for = trim($_POST["need_for"]);
    $password = $_POST["password"];
    $image = "";

    // Validations
    if (empty($name) || !preg_match("/^[a-zA-Z\s]{3,}$/", $name) || str_word_count($name) < 2) {
        $_SESSION['errors'][] = "Valid full name required.";
        $hasError = true;
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['errors'][] = "Valid email required.";
        $hasError = true;
    }

    if (empty($phone) || !preg_match("/^\+8801[0-9]{9}$/", $phone)) {
        $_SESSION['errors'][] = "Phone must start with +8801 and have 14 digits.";
        $hasError = true;
    }

    if (empty($location)) {
        $_SESSION['errors'][] = "Location is required.";
        $hasError = true;
    }

    if (empty($datetime) || !DateTime::createFromFormat('Y-m-d\TH:i', $datetime)) {
        $_SESSION['errors'][] = "Valid date/time is required.";
        $hasError = true;
    }

    if (empty($need_for)) {
        $_SESSION['errors'][] = "Please select purpose.";
        $hasError = true;
    }

    if (empty($password) || !preg_match("/^(?=.*[0-9])(?=.*[!@#$%^&*]).{8,}$/", $password)) {
        $_SESSION['errors'][] = "Password must be at least 8 chars, include a number and special char.";
        $hasError = true;
    }

    // Image Handling
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = "../../uploads/";
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);

        $temp_path = $_FILES['image']['tmp_name'];
        $file_type = mime_content_type($temp_path);

        $allowed = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($file_type, $allowed)) {
            $_SESSION['errors'][] = "Only JPG, PNG, GIF allowed.";
            $hasError = true;
        } else {
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $image = uniqid("img_", true) . "." . $ext;
            move_uploaded_file($temp_path, $upload_dir . $image);
        }
    } else {
        $_SESSION['errors'][] = "Image is required and must be JPG, PNG, or GIF.";
        $hasError = true;
    }

    // If no errors, proceed
    if (!$hasError) {
        $db = new db();
        $conn = $db->createConObject();

        // Optional: Check for duplicate email (if function exists)
        /*
        if ($db->checkEmailExists($conn, "customerreg", $email)) {
            $_SESSION['errors'][] = "Email already registered.";
            $hasError = true;
        }
        */

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $result = $db->insertCustomer($conn, "customerreg", $name, $email, $phone, $location, $datetime, $need_for, $image, $hashedPassword);

        if ($result === true) {
            $_SESSION['registration_success'] = true;
        } else {
            $_SESSION['errors'][] = "Database error: " . $result;
        }

        if (!empty($name)) {
            setcookie("customer_name", $name, time() + 3600, "/");
        }

        $db->closeCon($conn);
    }

    // Redirect to form after submission
    header("Location: ../../View/Customer/Customer_Registration.php");
    exit();
}
?>
