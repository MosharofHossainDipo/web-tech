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
        $this->DBName     = "butcherregistration";
    }

    function createConObject() {
        $conn = new mysqli($this->DBHostName, $this->DBUserName, $this->DBPassword, $this->DBName);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

    // Prepared statement for insert to avoid SQL injection and maintain security
    function insertButcherRegistration($conn, $table, $name, $password, $email, $area, $nid, $booking, $experience, $time, $services, $contact, $imagePath) {
        $qrystring = "INSERT INTO $table 
            (butcher_name, butcher_password, butcher_email, business_area, national_id, butcher_booking, experience, available_time, services, emergency_contact, image_path)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($qrystring);
        if (!$stmt) {
            return $conn->error;
        }

        $stmt->bind_param(
            "sssssssssss",
            $name,
            $password,
            $email,
            $area,
            $nid,
            $booking,
            $experience,
            $time,
            $services,
            $contact,
            $imagePath
        );

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            $error = $stmt->error;
            $stmt->close();
            return $error;
        }
    }

    function closeCon($conn) {
        $conn->close();
    }
}
?>

