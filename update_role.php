<?php
header('Content-Type: application/json');
session_start();
include './config/config.php';
include_once './includes/permission_middleware.php';

// Check if user has permission to edit roles
requirePermission('roles.edit');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $role_id = intval($_POST['role_id'] ?? 0);
    $role_name = trim($_POST['role_name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $status = isset($_POST['status']) ? 'active' : 'inactive';
    
    // Validation
    if ($role_id <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid role ID']);
        exit;
    }
    
    if (empty($role_name)) {
        echo json_encode(['success' => false, 'message' => 'Role name is required']);
        exit;
    }
    
    // Check if role exists
    $check_query = "SELECT id FROM roles WHERE id = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("i", $role_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'Role not found']);
        exit;
    }
    
    // Check if role name already exists (excluding current role)
    $check_name_query = "SELECT id FROM roles WHERE role_name = ? AND id != ?";
    $stmt = $conn->prepare($check_name_query);
    $stmt->bind_param("si", $role_name, $role_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'Role name already exists']);
        exit;
    }
    
    // Update role
    $update_query = "UPDATE roles SET role_name = ?, description = ?, status = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("sssi", $role_name, $description, $status, $role_id);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Role updated successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error updating role: ' . $conn->error]);
    }
    
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}

$conn->close();
?>

