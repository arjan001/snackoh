<?php
require 'config/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT insurance, capacity, assigned_driver, status, last_service_date, next_service_date 
              FROM fleet WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        echo json_encode($row);
    } else {
        echo json_encode([]);
    }
}
?>
