<?php
$errors = [];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include '../Customer login Validation PHP/validation.php';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Registration</title>
    <link rel="stylesheet" type="text/css" href="../Customer login CSS/CRStyles.css">
</head>
<body>
    <div class="background-image"></div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (empty($errors)) {
            echo "<h3>Registration Successful!</h3>";
        } else {
            echo "<h3>Validation Errors:</h3><ul>";
            foreach ($errors as $error) {
                echo "<li style='color:blue;'>$error</li>";
            }
            echo "</ul>";
        }
    }
    ?>



    <h2>Customer Registration</h2>
    <form id="customer-registration-form" action="" method="POST" enctype="multipart/form-data">
    <fieldset id="customer-info-fieldset">
            <legend>Customer Information</legend>
            
            <table id="customer-registration-table">
                <tr>
                    <td><label for="full_name">Full Name:</label></td>
                    <td><input type="text" id="full_name" name="full_name" ></td>
                </tr>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input type="email" id="email" name="email"></td>
                </tr>
                <tr>
                    <td><label for="phone">Phone Number:</label></td>
                    <td><input type="tel" id="phone" name="phone"></td>
                </tr>
                <tr>
                    <td><label for="location">Business Area:</label></td>
                    <td>
                        <select id="location" name="Business_area">
                            <option value="">-- Select Area --</option>
                            <option value="Dhaka">Dhaka</option>
                            <option value="Khulna">Khulna</option>
                            <option value="Chittagong">Chittagong</option>
                            <option value="Rajshahi">Rajshahi</option>
                            <option value="Sylhet">Sylhet</option>
                            <option value="Barisal">Barisal</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="dob">Date of Birth:</label></td>
                    <td><input type="date" id="dob" name="dob"></td>
                </tr>
                <tr>
                    <td><label for="profile_pic">Upload Profile Picture:</label></td>
                    <td><input type="file" id="profile_pic" name="profile_pic" accept="image/*"></td>
                </tr>
                <tr>
                    <td><label for="butchering_time">Preferred Butchering Time:</label></td>
                    <td><input type="time" id="butchering_time" name="butchering_time"></td>
                </tr>
                <tr>
                    <td><label>Service Needed:</label></td>
                    <td>
                        <input type="radio" id="qurbani" name="service_type" value="qurbani">
                        <label for="qurbani">Qurbani Eid</label>
                        <input type="radio" id="general" name="service_type" value="general">
                        <label for="general">General</label>
                        <div id="service-error-container"></div>
                    </td>
                </tr>
                <tr>
                    <td><label for="password">Password:</label></td>
                    <td><input type="password" id="password" name="password" minlength="8" ></td>
                </tr>
                <tr>
                    <td colspan="2" class="form-buttons">
                        <input type="submit" value="Register">
                        <input type="reset" value="Reset">
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>

    <script src="../Customer login PHP/validation.js"></script>
</body>
</html>
