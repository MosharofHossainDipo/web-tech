<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background-color: #333;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }

        .navbar .menu a {
            color: white;
            text-decoration: none;
            margin-right: 15px;
            font-weight: bold;
        }

        .navbar .menu a:hover {
            text-decoration: underline;
        }

        .navbar .user {
            font-weight: normal;
        }

        .navbar .user a {
            color: red;
            margin-left: 10px;
            text-decoration: none;
        }

        .navbar .user a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="navbar">
    <div class="menu">
        <a href="../View/Customer/Greeting.php">Home</a>
        <a href="../View/Customer/Customer_Registration.php">Register</a>
        <a href="../View/Customer/Customer_login.php">Login</a>
    </div>
    <div class="user">
        <?php
        if (isset($_SESSION['name'])) {
            echo "Welcome, <strong>" . htmlspecialchars($_SESSION['name']) . "</strong>";
            echo "<a href='../View/Customer/Customer_logout.php'>Logout</a>";
        } else {
            echo "Guest";
        }
        ?>
    </div>
</div>

</body>
</html>

