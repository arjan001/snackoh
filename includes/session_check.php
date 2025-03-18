<?php
session_start();
require_once "./config/config.php"; // Include database connection

// Ensure user is authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if not authenticated
    exit();
}

// Ensure employee_id is available
if (!isset($_SESSION['employee_id'])) {
    $stmt = $conn->prepare("SELECT id FROM employees WHERE id = ?");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $stmt->bind_result($employee_id);
    
    if ($stmt->fetch()) {
        $_SESSION['employee_id'] = $employee_id;
    } else {
        die("Error: Employee record not found.");
    }

    $stmt->close();
}
?>
