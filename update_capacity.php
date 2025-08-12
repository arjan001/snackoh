<?php
include('config/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['capacity_id']) &&
        !empty($_POST['product_unit']) &&
        !empty($_POST['category']) &&
        !empty($_POST['max_capacity']) &&
        !empty($_POST['current_usage']) &&
        !empty($_POST['available_capacity']) &&
        !empty($_POST['status']) &&
        !empty($_POST['last_updated'])
    ) {
        $capacity_id = intval($_POST['capacity_id']);
        $asset_id = intval($_POST['product_unit']);
        $category = trim($_POST['category']);
        $max_capacity = intval($_POST['max_capacity']);
        $current_usage = intval($_POST['current_usage']);
        $available_capacity = intval($_POST['available_capacity']);
        $status = trim($_POST['status']);
        $last_updated = $_POST['last_updated'];

        $stmt = $conn->prepare("UPDATE capacity_management 
            SET asset_id=?, category=?, max_capacity=?, current_usage=?, available_capacity=?, status=?, last_updated=? 
            WHERE id=?");

        if ($stmt) {
            $stmt->bind_param("isiiissi", $asset_id, $category, $max_capacity, $current_usage, $available_capacity, $status, $last_updated, $capacity_id);
            
            if ($stmt->execute()) {
                echo "<script>alert('Record updated successfully'); window.location.href='./capacity-manage.php';</script>";
            } else {
                echo "<script>alert('Error updating record: " . $stmt->error . "'); window.history.back();</script>";
            }

            $stmt->close();
        }
    } else {
        echo "<script>alert('All fields are required.'); window.history.back();</script>";
    }
}

$conn->close();
?>
