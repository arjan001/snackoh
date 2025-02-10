<?php
include "config/config.php"; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_id = $_POST['employee_id'];
    $user_role = $_POST['user_role'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        die("Passwords do not match.");
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Update the employees table with user_role and password_hash
    $stmt = $conn->prepare("UPDATE employees SET user_role = ?, password_hash = ? WHERE id = ?");
    $stmt->bind_param("isi", $user_role, $hashed_password, $employee_id);

    if ($stmt->execute()) {
        echo "<script>alert('System User Info  added successfully'); window.location.href='./users.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>
