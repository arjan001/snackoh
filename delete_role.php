<?php
include_once "./config/config.php"; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $role_id = intval($_GET['id']); // Sanitize role ID

    if ($role_id <= 0) {
        echo "<script>alert('Invalid role ID!'); window.location.href='roles-permissions.php';</script>";
        exit;
    }

    // Check if the role exists
    $checkQuery = "SELECT * FROM roles WHERE id = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("i", $role_id);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows === 0) {
        echo "<script>alert('Role not found!'); window.location.href='roles_permissions.php';</script>";
        exit;
    }

    // Delete the role
    $deleteQuery = "DELETE FROM roles WHERE id = ?";
    $deleteStmt = $conn->prepare($deleteQuery);
    $deleteStmt->bind_param("i", $role_id);

    if ($deleteStmt->execute()) {
        echo "<script>alert('Role deleted successfully!'); window.location.href='roles_permissions.php';</script>";
    } else {
        echo "<script>alert('Error deleting role!'); window.location.href='roles_permissions.php';</script>";
    }

    $deleteStmt->close();
    $checkStmt->close();
    $conn->close();
} else {
    echo "<script>alert('Invalid request!'); window.location.href='roles_permissions.php';</script>";
}
?>
