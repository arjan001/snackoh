<?php
include_once "./config/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role_id = $_POST['role_id'];
    $role_name = trim($_POST['role_name']);

    if (empty($role_name) || empty($role_id)) {
        echo "<script>alert('Role name cannot be empty!'); window.history.back();</script>";
        exit;
    }

    $query = "UPDATE roles SET role_name = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $role_name, $role_id);

    if ($stmt->execute()) {
        echo "<script>alert('Role updated successfully'); window.location.href='roles_permissions.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

