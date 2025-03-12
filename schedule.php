<?php
include('config/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_POST["customer_id"];
    $address = $_POST["address"];
    $order_id = NULL; // Since orders aren't implemented yet
    $schedule_datetime = $_POST["schedule_datetime"];
    $driver_id = $_POST["driver_id"];
    $vehicle_id = $_POST["vehicle_id"];
    $notification_method = $_POST["notification_method"];

    $stmt = $conn->prepare("INSERT INTO deliveries (customer_id, address, order_id, schedule_datetime, driver_id, vehicle_id, notification_method) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssiss", $customer_id, $address, $order_id, $schedule_datetime, $driver_id, $vehicle_id, $notification_method);

    if ($stmt->execute()) {
        echo "<script>alert('Delivery scheduled successfully'); window.location.href='./deliveries.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
