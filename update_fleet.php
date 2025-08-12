<?php
require_once 'config/config.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get input values
    $insurance = $_POST['insurance'] ?? '';
    $capacity = $_POST['capacity'] ?? '';
    $assigned_driver = $_POST['assigned_driver'] ?? '';
    $status = $_POST['status'] ?? '';
    $last_service_date = $_POST['last_service_date'] ?? '';
    $next_service_date = $_POST['next_service_date'] ?? '';

    // Insert or update vehicle details into the `fleet` table
    $query = "INSERT INTO fleet (insurance, capacity, assigned_driver, status, last_service_date, next_service_date) 
              VALUES (?, ?, ?, ?, ?, ?) 
              ON DUPLICATE KEY UPDATE 
                insurance = ?, 
                capacity = ?, 
                assigned_driver = ?, 
                status = ?, 
                last_service_date = ?, 
                next_service_date = ?";

    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die(json_encode(["status" => "error", "message" => "Prepare failed: " . $conn->error]));
    }

    $stmt->bind_param(
        "sissssssisss",
        $insurance, $capacity, $assigned_driver, $status, $last_service_date, $next_service_date,
        $insurance, $capacity, $assigned_driver, $status, $last_service_date, $next_service_date
    );

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Vehicle details saved successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to save vehicle details: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    die(json_encode(["status" => "error", "message" => "Invalid request method."]));
}
?>
