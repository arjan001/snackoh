<?php
session_start();
include './config/config.php';

echo "<h2>Session Test</h2>";
echo "<pre>";

echo "Session Status: " . session_status() . "\n";
echo "Session ID: " . session_id() . "\n\n";

echo "Session Variables:\n";
print_r($_SESSION);

echo "\n\nUser ID: " . ($_SESSION['user_id'] ?? 'NOT SET') . "\n";
echo "Employee ID: " . ($_SESSION['employee_id'] ?? 'NOT SET') . "\n";

if (isset($_SESSION['user_id'])) {
    // Check if employee exists in database
    $stmt = $conn->prepare("SELECT id, first_name, last_name FROM employees WHERE id = ?");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $employee = $result->fetch_assoc();
    $stmt->close();
    
    if ($employee) {
        echo "\nEmployee Found: " . $employee['first_name'] . " " . $employee['last_name'] . "\n";
    } else {
        echo "\nEmployee NOT found in database\n";
    }
}

echo "</pre>";
?> 