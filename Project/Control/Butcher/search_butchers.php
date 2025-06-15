<?php
include '../../model/Butcher/db.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['location'])) {
    $location = trim($_GET['location']);
    
    $db = new db();
    $conn = $db->createConObject();
    
    $query = "SELECT * FROM butcherregistration WHERE business_area = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $location);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $butchers = [];
    while ($row = $result->fetch_assoc()) {
        $butchers[] = $row;
    }
    
    $stmt->close();
    $db->closeCon($conn);
    
    // Pass the results back to the view
    include '../../View/Butcher/search.php';
    exit;
}

header("Location: ../../View/Butcher/search.php");
exit;
?>