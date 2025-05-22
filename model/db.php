<?php

class db{
    public $DBHostName = "";
    public $DBUserName = "";
    public $DBPassword = "";
    public $DBName = "";

   function __construct() {
        $this->DBHostName = "localhost";
        $this->DBUserName = "root";
        $this->DBPassword = "";
        $this->DBName = "butcherregistration";
    }

    function createConObject() {
        return new mysqli($this->DBHostName, $this->DBUserName, $this->DBPassword, $this->DBName);
    }

    function insertButcher($conn, $table, $name, $password, $email, $area, $nid, $booking, $experience, $time, $services, $contact, $imagePath) {
        $qrystring = "INSERT INTO $table (
            butcher_name, butcher_password, butcher_email, business_area, national_id, butcher_booking, experience, available_time, 
            services, emergency_contact, image_path
        ) VALUES (
            '$name', '$password', '$email', '$area', '$nid','$booking', $experience, '$time', '$services', '$contact', '$imagePath'
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
