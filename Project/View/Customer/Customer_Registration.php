<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Customer Registration</title>
  <link rel="stylesheet" href="../../Design/Style.css" />
</head>
<body>
  <div class="login-container">
    
    <h1>Register Now</h1>
    <h4>Please fill in your details</h4>

    <?php
    session_start();
    if (isset($_SESSION['registration_success']) && $_SESSION['registration_success']) {
        echo "<p class='success-message'>Registration Successful</p>";
        unset($_SESSION['registration_success']);
    }
    ?>

    <form method="POST" action="../../Control/Customer/Validation.php" enctype="multipart/form-data">
      <div class="error-messages">
        <?php
        if (isset($_SESSION['errors'])) {
            foreach ($_SESSION['errors'] as $error) {
                if (!empty($error)) {
                    echo "<p class='error-message'>$error</p>";
                }
            }
            unset($_SESSION['errors']);
        }
        ?>
      </div>

      <input type="text" name="name" placeholder="Name" required />
      <input type="email" name="email" placeholder="Email address" required />
      <input type="tel" name="phone" placeholder="Phone number" required />

      <select name="location" required>
        <option value="" disabled selected>Select Location</option>
        <option value="Dhaka">Dhaka</option>
        <option value="Chittagong">Chittagong</option>
        <option value="Khulna">Khulna</option>
        <option value="Rajshahi">Rajshahi</option>
        <option value="Barishal">Barishal</option>
        <option value="Sylhet">Sylhet</option>
      </select>

      <input type="datetime-local" name="datetime" required />

      <select name="need_for" required>
        <option value="" disabled selected>Need For</option>
        <option value="EID">EID</option>
        <option value="Marriage">Marriage</option>
        <option value="Others">Others</option>
      </select>
      
      <input type="file" name="image" accept="image/*" required />
      <input type="password" name="password" placeholder="Password" required />
      <button type="submit" class="login-button">Register</button>

      <p class="signup-link">
        Already have an account? <a href="Customer_login.php">Back to login</a>
      </p>
    </form>
  </div>
</body>
</html>
