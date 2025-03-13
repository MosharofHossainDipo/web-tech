<!DOCTYPE html>
<html>
<head>
    <title>Customer Registration</title>
</head>
<body>
    <h2>Customer Registration</h2>
    
        <form action="customer_register.php" method="POST">
        <fieldset>
        <legend>Customer Information</legend>
            <table border="0" cellpadding="10" cellspacing="0">
                <tr>
                    <td><label for="full_name">Full Name:</label></td>
                    <td><input type="text" id="full_name" name="full_name" required></td>
                </tr>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input type="email" id="email" name="email" required></td>
                </tr>
                <tr>
                    <td><label for="phone">Phone Number:</label></td>
                    <td><input type="tel" id="phone" name="phone"></td>
                </tr>
                <tr>
                    <td><label for="location">Business Area:</label></td>
                    <td>
                        <select id="location" name="Business_area" required>
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
    <td><label>Service Needed:</label></td>
    <td>
        <input type="radio" id="qurbani" name="service_type" value="qurbani">
        <label for="qurbani">Qurbani Butchering</label>
        <input type="radio" id="general" name="service_type" value="general">
        <label for="general">General Butchering</label>
    </td>
</tr>

                <tr>
                    <td><label for="dob">Date of Birth:</label></td>
                    <td><input type="date" id="dob" name="dob"></td>
                </tr>
                <tr>
                    <td><label for="butchering_time">Preferred Butchering Time:</label></td>
                    <td><input type="time" id="butchering_time" name="butchering_time"></td>
                </tr>
                <tr>
                    <td><label for="password">Password:</label></td>
                    <td><input type="password" id="password" name="password" required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Register">
                        <input type="reset" value="Reset">
                    </td>
                </tr>
            </table>
            </fieldset>
        </form>
</body>
</html>
