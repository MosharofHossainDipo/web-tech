<?php

class db {
    private $DBHostName;
    private $DBUserName;
    private $DBPassword;
    private $DBName;

    function __construct() {
        $this->DBHostName = "localhost";
        $this->DBUserName = "root";
        $this->DBPassword = "";
        $this->DBName     = "customerreg";
    }

    function createConObject() {
        $conn = new mysqli($this->DBHostName, $this->DBUserName, $this->DBPassword, $this->DBName);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

    function insertCustomer($conn, $table, $name, $email, $phone, $location, $datetime, $need_for, $image, $password) {
        $qrystring = "INSERT INTO $table (
            name, email, phone, location, datetime, need_for, image, password
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($qrystring);
        if ($stmt === false) {
            return $conn->error;
        }

        $stmt->bind_param(  "ssssssss",  $name,  $email,  $phone,  $location,  $datetime,  $need_for,  $image,  $password );

        $result = $stmt->execute();

        if ($result === false) {
            $error = $stmt->error;
            $stmt->close();
            return $error;
        } else {
            $stmt->close();
            return true;
        }
    }

    // New function to update the password
    function updatePassword($conn, $table, $email, $password) {
        $qrystring = "UPDATE $table SET password = ? WHERE email = ?";

        $stmt = $conn->prepare($qrystring);
        if ($stmt === false) {
            return $conn->error;
        }

        $stmt->bind_param("ss", $password, $email);

        $result = $stmt->execute();

        if ($result === false) {
            $error = $stmt->error;
            $stmt->close();
            return $error;
        } else {
            if ($stmt->affected_rows > 0) {
                 $stmt->close();
                 return true;
            } else {
                 $stmt->close();
                 return "No user found with that email address.";
            }
        }
    }

    function closeCon($conn) {
        $conn->close();
    }
}
?>