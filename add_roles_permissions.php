<?php
include_once "./config/config.php"; // Ensure DB connection is established

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role_name = trim($_POST['role_name']);
    $status = isset($_POST['status']) ? 'active' : 'inactive'; // If checkbox is checked, set as active

    // Basic validation
    if (empty($role_name)) {
        echo "<script>alert('Role name cannot be empty!'); window.history.back();</script>";
        exit;
    }

    // Insert role into database
    $query = "INSERT INTO roles (role_name, status, created_at) VALUES (?, ?, NOW())";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $role_name, $status);

    if ($stmt->execute()) {
        // Redirect after success
        echo "<script>alert('Role added successfully'); window.location.href='./roles_permissions.php';</script>";
        exit;
    } else {
        echo "<script>alert('Error: " . addslashes($conn->error) . "'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
