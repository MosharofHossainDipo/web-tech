<?php

class db {
    public $DBHostName = "";
    public $DBUserName = "";
    public $DBPassword = "";
    public $DBName = "";

    function __construct() {
        $this->DBHostName = "localhost";
        $this->DBUserName = "root";
        $this->DBPassword = "";
        $this->DBName = "customerregistration";
    }

    function createConObject() {
        return new mysqli($this->DBHostName, $this->DBUserName, $this->DBPassword, $this->DBName);
    }

    function insertCustomer($conn, $name, $email, $phone, $location, $dob, $profile_pic, $butchering_time, $password) {
        $qrystring = "INSERT INTO customerregistration (
            name, email, phone, location, dob, profile_pic, butchering_time, password
        ) VALUES (
            '$name', '$email', '$phone', '$location', '$dob', '$profile_pic', '$butchering_time', '$password'
        )";

        $result = $conn->query($qrystring);

        if ($result === false) {
            return $conn->error;
        } else {
            return true;
        }
    }
    function closeCon($conn) {
        $conn->close();
    }
}
?>
