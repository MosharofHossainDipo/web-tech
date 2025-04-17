<!DOCTYPE html>
<html>
<head>
    <title>Butcher Registration</title>
    <link rel="stylesheet" type="text/css" href="../ButcherCSS/styles.css">
    <style>
    </style>
</head>
<body>
    <h1><center>Welcome to the Butcher Registration</center></h1>
    <form action="ButcherRegistration.php" method="get">
        <fieldset>
            <legend>Butcher Information</legend>
            <table border="0" cellpadding="10" cellspacing="0">
                <tr>
                    <td><label for="butcher_name">User Name:</label></td>
                    <td>
                        <input type="text" id="butcher_name" name="butcher_name" >
                        <span id="nameError" class="error"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="butcher_password">Password:</label></td>
                    <td>
                        <input type="password" id="butcher_password" name="butcher_password" >
                        <span id="passwordError" class="error"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="butcher_email">Email Address:</label></td>
                    <td>
                        <input type="email" id="butcher_email" name="butcher_email" >
                        <span id="emailError" class="error"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="location">Business Area:</label></td>
                    <td>
                        <select id="location" name="Business_area" >
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
                    <td><label for="national_id">NID:</label></td>
                    <td>
                        <input type="text" id="national_id" name="national_id" >
                        <span id="nidError" class="error"></span>
                    </td>
                </tr>
                <tr>
                    <td><label>Butcher Booking:</label></td>
                    <td>
                        <input type="radio" id="eid" name="butcher_booking" value="EID" >
                        <label for="eid">EID</label><br>
                        <input type="radio" id="marriage" name="butcher_booking" value="Marriage" >
                        <label for="marriage">Marriage</label><br>
                        <input type="radio" id="other" name="butcher_booking" value="Other" >
                        <label for="other">Other</label>
                    </td>
                </tr>
                <tr>
                    <td><label for="experience">Years of Experience:</label></td>
                    <td><input type="number" id="experience" name="experience" min="0"></td>
                </tr>
                <tr>
                    <td><label for="available_time">Available Time Slots:</label></td>
                    <td><input type="time" id="available_time" name="available_time"></td>
                </tr>
                <tr>
                    <td><label>Services Offered:</label></td>
                    <td>
                        <input type="checkbox" id="goat" name="services[]" value="Goat">
                        <label for="goat">Goat</label>
                        <input type="checkbox" id="cow" name="services[]" value="Cow">
                        <label for="cow">Cow</label>
                        <input type="checkbox" id="chicken" name="services[]" value="Chicken">
                        <label for="chicken">Chicken</label>
                    </td>
                </tr>
                <tr>
                    <td><label for="emergency_contact">Emergency Contact Number:</label></td>
                    <td>
                        <input type="tel" id="emergency_contact" name="emergency_contact">
                        <span id="contactError" class="error"></span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Register">
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>

    <!-- JavaScript Validation -->
    <script src="../ButcherJS/javaScript.js"></script>
</body>
</html>
