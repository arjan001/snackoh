<?php
// Prevent any output before JSON response
ob_start();
header('Content-Type: application/json');

session_start();
include './config/config.php';
include_once './includes/permission_middleware.php';

// Check if user has permission to delete roles
requirePermission('roles.delete');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $role_id = intval($_POST['role_id'] ?? 0);
    
    // Validation
    if ($role_id <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid role ID']);
        exit;
    }
    
    // Check if role exists
    $check_query = "SELECT role_name FROM roles WHERE id = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("i", $role_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'Role not found']);
        exit;
    }
    
    $role = $result->fetch_assoc();
    
    // Check if role is assigned to any users
    $users_query = "SELECT COUNT(*) as user_count FROM employees WHERE user_role = ?";
    $stmt = $conn->prepare($users_query);
    $stmt->bind_param("i", $role_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user_count = $result->fetch_assoc()['user_count'];
    
    if ($user_count > 0) {
        echo json_encode(['success' => false, 'message' => "Cannot delete role '{$role['role_name']}' - it is assigned to {$user_count} user(s)"]);
        exit;
    }
    
    // Check if it's a system role (admin, etc.)
    if (in_array(strtolower($role['role_name']), ['admin', 'administrator', 'super admin'])) {
        echo json_encode(['success' => false, 'message' => 'Cannot delete system roles']);
        exit;
    }
    
    // Delete role permissions first
    $delete_permissions_query = "DELETE FROM role_permissions WHERE role_id = ?";
    $stmt = $conn->prepare($delete_permissions_query);
    $stmt->bind_param("i", $role_id);
    $stmt->execute();
    
    // Delete the role
    $delete_role_query = "DELETE FROM roles WHERE id = ?";
    $stmt = $conn->prepare($delete_role_query);
    $stmt->bind_param("i", $role_id);
    
    if ($stmt->execute()) {
        $response = ['success' => true, 'message' => 'Role deleted successfully'];
    } else {
        $response = ['success' => false, 'message' => 'Error deleting role: ' . $conn->error];
    }
    
    $stmt->close();
} else {
    $response = ['success' => false, 'message' => 'Invalid request method'];
}

$conn->close();

// Clean any output buffer and ensure only JSON is sent
ob_end_clean();

// Send the JSON response
echo json_encode($response);
?>
