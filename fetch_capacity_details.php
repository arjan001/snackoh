<?php
include('config/config.php');

if (isset($_POST['capacity_id'])) {
    $capacity_id = intval($_POST['capacity_id']);

    $query = "SELECT cm.*, a.asset_name 
              FROM capacity_management cm
              JOIN assets a ON cm.asset_id = a.id
              WHERE cm.id = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $capacity_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    echo json_encode($row);
}

$conn->close();
?>
