<?php
session_start();
include './config/config.php';
include_once './includes/permission_middleware.php';

// Check if user has permission to create roles
requirePermission('roles.create');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $role_name = trim($_POST['role_name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $status = isset($_POST['status']) ? 'active' : 'inactive';
    
    // Validation
    if (empty($role_name)) {
        echo json_encode(['success' => false, 'message' => 'Role name is required']);
        exit;
    }
    
    // Check if role name already exists
    $check_query = "SELECT id FROM roles WHERE role_name = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("s", $role_name);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'Role name already exists']);
        exit;
    }
    
    // Insert new role
    $insert_query = "INSERT INTO roles (role_name, description, status, created_at) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("sss", $role_name, $description, $status);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Role created successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error creating role: ' . $conn->error]);
    }
    
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}

$conn->close();
?>
