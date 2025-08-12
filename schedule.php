<?php
include('config/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_POST["customer_id"];
    $address = $_POST["address"];
    $order_id = !empty($_POST["order_id"]) ? intval($_POST["order_id"]) : NULL; // Handle order_id properly
    $schedule_datetime = $_POST["schedule_datetime"];
    $driver_id = $_POST["driver_id"];
    $vehicle_id = $_POST["vehicle_id"];
    $notification_method = $_POST["notification_method"];

    // Validate required fields
    if (empty($customer_id) || empty($address) || empty($schedule_datetime)) {
        echo "<script>alert('Please fill in all required fields'); window.history.back();</script>";
        exit;
    }

    // If order_id is provided, validate that it exists and belongs to the customer
    if ($order_id !== NULL) {
        $stmt = $conn->prepare("SELECT id FROM orders WHERE id = ? AND customer_id = ?");
        $stmt->bind_param("ii", $order_id, $customer_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 0) {
            echo "<script>alert('Invalid order ID or order does not belong to this customer'); window.history.back();</script>";
            exit;
        }
        $stmt->close();
    }

    // Check if delivery already exists for this order
    if ($order_id !== NULL) {
        $stmt = $conn->prepare("SELECT id FROM deliveries WHERE order_id = ?");
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            echo "<script>alert('A delivery is already scheduled for this order'); window.history.back();</script>";
            exit;
        }
        $stmt->close();
    }

    $stmt = $conn->prepare("INSERT INTO deliveries (customer_id, address, order_id, schedule_datetime, driver_id, vehicle_id, notification_method) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssiss", $customer_id, $address, $order_id, $schedule_datetime, $driver_id, $vehicle_id, $notification_method);

    if ($stmt->execute()) {
        $delivery_id = $stmt->insert_id;
        
        // Add notification for successful delivery scheduling
        if (function_exists('addNotification')) {
            include_once './includes/notifications.php';
            $order_text = $order_id ? " for Order #$order_id" : "";
            addNotification(
                "Delivery Scheduled",
                "Delivery scheduled successfully$order_text. Delivery ID: $delivery_id",
                'info'
            );
        }
        
        echo "<script>alert('Delivery scheduled successfully'); window.location.href='./deliveries.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
