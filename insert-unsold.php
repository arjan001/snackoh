<?php
// Database connection
include_once "./config/config.php";



// Capture form data
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];
$expiry_date = $_POST['expiry_date'];
$unit_id = $_POST['unit_id'];
$resolution = $_POST['resolution'];
$status = $_POST['status'];

// Insert into database
$sql = "INSERT INTO unsold_goods (product_id, quantity, expiry_date, unit_id, resolution, status)
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iissss", $product_id, $quantity, $expiry_date, $unit_id, $resolution, $status);

if ($stmt->execute()) {
    echo "<script>alert('Unsold item Added succesfully'); window.location.href='unsold-goods.php';</script>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
