<?php
session_start();
include './config/config.php';
include_once './includes/permission_middleware.php';

// Check if user has permission to assign permissions
requirePermission('permissions.assign');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $role_id = intval($_POST['role_id'] ?? 0);
    $permissions = $_POST['permissions'] ?? [];
    
    // Validation
    if ($role_id <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid role ID']);
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
    
    try {
        // Start transaction
        $conn->begin_transaction();
        
        // Remove all current permissions for this role
        $delete_query = "DELETE FROM role_permissions WHERE role_id = ?";
        $stmt = $conn->prepare($delete_query);
        $stmt->bind_param("i", $role_id);
        $stmt->execute();
        
        // Add new permissions
        if (!empty($permissions)) {
            $insert_query = "INSERT INTO role_permissions (role_id, permission_id, granted_by) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($insert_query);
            
            foreach ($permissions as $permission_id) {
                $permission_id = intval($permission_id);
                if ($permission_id > 0) {
                    $stmt->bind_param("iii", $role_id, $permission_id, $_SESSION['user_id']);
                    $stmt->execute();
                }
            }
        }
        
        // Commit transaction
        $conn->commit();
        
        echo json_encode(['success' => true, 'message' => 'Permissions updated successfully']);
        
    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollback();
        echo json_encode(['success' => false, 'message' => 'Error updating permissions: ' . $e->getMessage()]);
    }
    
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}

$conn->close();
?> 