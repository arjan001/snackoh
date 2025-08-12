<?php
include_once "./config/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $batch_id = $_POST['batch_id'];
    $product_id = $_POST['product_id'];
    $recipe_id = $_POST['recipe_id'];
    $priority = $_POST['priority'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $status = $_POST['status'];
    $assigned_employee_id = isset($_POST['employee_id']) ? $_POST['employee_id'] : null; // Single Employee ID

    // Insert production batch with assigned employee
    $stmt = $conn->prepare("INSERT INTO production_batches (batch_id, product_id, recipe_id, priority, start_time, end_time, status, assigned_employee_id) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("siissssi", $batch_id, $product_id, $recipe_id, $priority, $start_time, $end_time, $status, $assigned_employee_id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Schedule successfully created!'); window.location.href='schedule_production.php';</script>";
    } else {
        echo "<script>alert('Error: " . addslashes($stmt->error) . "'); window.location.href='schedule_production.php';</script>";
    }
    
    $stmt->close();
    $conn->close();
}
?>
