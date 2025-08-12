<?php
/**
 * Permission Middleware for RBAC System
 * Handles all permission checking and access control
 */

class PermissionMiddleware {
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    /**
     * Check if user has a specific permission
     * @param int $user_id User ID
     * @param string $permission_key Permission key to check
     * @return bool True if user has permission, false otherwise
     */
    public function hasPermission($user_id, $permission_key) {
        // First check user-specific permissions (overrides role permissions)
        $user_permission = $this->checkUserPermission($user_id, $permission_key);
        if ($user_permission !== null) {
            return $user_permission;
        }
        
        // Then check role-based permissions
        return $this->checkRolePermission($user_id, $permission_key);
    }
    
    /**
     * Check user-specific permission
     * @param int $user_id User ID
     * @param string $permission_key Permission key
     * @return bool|null True if granted, false if denied, null if not set
     */
    private function checkUserPermission($user_id, $permission_key) {
        $query = "
            SELECT up.is_granted, up.expires_at 
            FROM user_permissions up
            JOIN permissions p ON up.permission_id = p.id
            WHERE up.user_id = ? AND p.permission_key = ? AND p.status = 'active'
        ";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("is", $user_id, $permission_key);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            // Check if permission has expired
            if ($row['expires_at'] && strtotime($row['expires_at']) < time()) {
                return false; // Permission expired
            }
            return (bool)$row['is_granted'];
        }
        
        return null; // No user-specific permission set
    }
    
    /**
     * Check role-based permission
     * @param int $user_id User ID
     * @param string $permission_key Permission key
     * @return bool True if user's role has permission
     */
    private function checkRolePermission($user_id, $permission_key) {
        $query = "
            SELECT COUNT(*) as has_permission
            FROM role_permissions rp
            JOIN permissions p ON rp.permission_id = p.id
            JOIN employees e ON rp.role_id = e.user_role
            WHERE e.id = ? AND p.permission_key = ? AND p.status = 'active'
        ";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("is", $user_id, $permission_key);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        return $row['has_permission'] > 0;
    }
    
    /**
     * Get all permissions for a user (both role and user-specific)
     * @param int $user_id User ID
     * @return array Array of permission keys
     */
    public function getUserPermissions($user_id) {
        $permissions = [];
        
        // Get role-based permissions
        $role_query = "
            SELECT DISTINCT p.permission_key
            FROM role_permissions rp
            JOIN permissions p ON rp.permission_id = p.id
            JOIN employees e ON rp.role_id = e.user_role
            WHERE e.id = ? AND p.status = 'active'
        ";
        
        $stmt = $this->conn->prepare($role_query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($row = $result->fetch_assoc()) {
            $permissions[] = $row['permission_key'];
        }
        
        // Get user-specific permissions
        $user_query = "
            SELECT p.permission_key, up.is_granted, up.expires_at
            FROM user_permissions up
            JOIN permissions p ON up.permission_id = p.id
            WHERE up.user_id = ? AND p.status = 'active'
        ";
        
        $stmt = $this->conn->prepare($user_query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($row = $result->fetch_assoc()) {
            // Check if permission has expired
            if ($row['expires_at'] && strtotime($row['expires_at']) < time()) {
                continue; // Skip expired permissions
            }
            
            if ($row['is_granted']) {
                // Add permission if granted
                if (!in_array($row['permission_key'], $permissions)) {
                    $permissions[] = $row['permission_key'];
                }
            } else {
                // Remove permission if denied
                $key = array_search($row['permission_key'], $permissions);
                if ($key !== false) {
                    unset($permissions[$key]);
                }
            }
        }
        
        return array_values($permissions);
    }
    
    /**
     * Get user's role information
     * @param int $user_id User ID
     * @return array Role information
     */
    public function getUserRole($user_id) {
        $query = "
            SELECT r.id, r.role_name, r.status
            FROM roles r
            JOIN employees e ON r.id = e.user_role
            WHERE e.id = ?
        ";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_assoc();
    }
    
    /**
     * Check if user has any permission from a list
     * @param int $user_id User ID
     * @param array $permission_keys Array of permission keys
     * @return bool True if user has at least one permission
     */
    public function hasAnyPermission($user_id, $permission_keys) {
        foreach ($permission_keys as $permission_key) {
            if ($this->hasPermission($user_id, $permission_key)) {
                return true;
            }
        }
        return false;
    }
    
    /**
     * Check if user has all permissions from a list
     * @param int $user_id User ID
     * @param array $permission_keys Array of permission keys
     * @return bool True if user has all permissions
     */
    public function hasAllPermissions($user_id, $permission_keys) {
        foreach ($permission_keys as $permission_key) {
            if (!$this->hasPermission($user_id, $permission_key)) {
                return false;
            }
        }
        return true;
    }
    
    /**
     * Grant permission to a user
     * @param int $user_id User ID
     * @param string $permission_key Permission key
     * @param int $granted_by User ID who granted the permission
     * @param string $expires_at Expiration date (optional)
     * @return bool Success status
     */
    public function grantUserPermission($user_id, $permission_key, $granted_by, $expires_at = null) {
        // Get permission ID
        $stmt = $this->conn->prepare("SELECT id FROM permissions WHERE permission_key = ?");
        $stmt->bind_param("s", $permission_key);
        $stmt->execute();
        $result = $stmt->get_result();
        $permission = $result->fetch_assoc();
        
        if (!$permission) {
            return false;
        }
        
        // Insert or update user permission
        $query = "
            INSERT INTO user_permissions (user_id, permission_id, is_granted, granted_by, expires_at)
            VALUES (?, ?, TRUE, ?, ?)
            ON DUPLICATE KEY UPDATE 
            is_granted = TRUE, 
            granted_by = ?, 
            expires_at = ?
        ";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iiiss", $user_id, $permission['id'], $granted_by, $expires_at, $granted_by, $expires_at);
        
        return $stmt->execute();
    }
    
    /**
     * Revoke permission from a user
     * @param int $user_id User ID
     * @param string $permission_key Permission key
     * @param int $revoked_by User ID who revoked the permission
     * @return bool Success status
     */
    public function revokeUserPermission($user_id, $permission_key, $revoked_by) {
        // Get permission ID
        $stmt = $this->conn->prepare("SELECT id FROM permissions WHERE permission_key = ?");
        $stmt->bind_param("s", $permission_key);
        $stmt->execute();
        $result = $stmt->get_result();
        $permission = $result->fetch_assoc();
        
        if (!$permission) {
            return false;
        }
        
        // Insert or update user permission (deny)
        $query = "
            INSERT INTO user_permissions (user_id, permission_id, is_granted, granted_by)
            VALUES (?, ?, FALSE, ?)
            ON DUPLICATE KEY UPDATE 
            is_granted = FALSE, 
            granted_by = ?
        ";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iiii", $user_id, $permission['id'], $revoked_by, $revoked_by);
        
        return $stmt->execute();
    }
    
    /**
     * Assign permission to a role
     * @param int $role_id Role ID
     * @param string $permission_key Permission key
     * @param int $granted_by User ID who granted the permission
     * @return bool Success status
     */
    public function assignRolePermission($role_id, $permission_key, $granted_by) {
        // Get permission ID
        $stmt = $this->conn->prepare("SELECT id FROM permissions WHERE permission_key = ?");
        $stmt->bind_param("s", $permission_key);
        $stmt->execute();
        $result = $stmt->get_result();
        $permission = $result->fetch_assoc();
        
        if (!$permission) {
            return false;
        }
        
        // Insert role permission
        $query = "INSERT IGNORE INTO role_permissions (role_id, permission_id, granted_by) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iii", $role_id, $permission['id'], $granted_by);
        
        return $stmt->execute();
    }
    
    /**
     * Remove permission from a role
     * @param int $role_id Role ID
     * @param string $permission_key Permission key
     * @return bool Success status
     */
    public function removeRolePermission($role_id, $permission_key) {
        // Get permission ID
        $stmt = $this->conn->prepare("SELECT id FROM permissions WHERE permission_key = ?");
        $stmt->bind_param("s", $permission_key);
        $stmt->execute();
        $result = $stmt->get_result();
        $permission = $result->fetch_assoc();
        
        if (!$permission) {
            return false;
        }
        
        // Delete role permission
        $query = "DELETE FROM role_permissions WHERE role_id = ? AND permission_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $role_id, $permission['id']);
        
        return $stmt->execute();
    }
}

// Helper functions for easy permission checking
function hasPermission($permission_key) {
    global $conn;
    if (!isset($_SESSION['user_id'])) {
        return false;
    }
    
    $permissionMiddleware = new PermissionMiddleware($conn);
    return $permissionMiddleware->hasPermission($_SESSION['user_id'], $permission_key);
}

function hasAnyPermission($permission_keys) {
    global $conn;
    if (!isset($_SESSION['user_id'])) {
        return false;
    }
    
    $permissionMiddleware = new PermissionMiddleware($conn);
    return $permissionMiddleware->hasAnyPermission($_SESSION['user_id'], $permission_keys);
}

function hasAllPermissions($permission_keys) {
    global $conn;
    if (!isset($_SESSION['user_id'])) {
        return false;
    }
    
    $permissionMiddleware = new PermissionMiddleware($conn);
    return $permissionMiddleware->hasAllPermissions($_SESSION['user_id'], $permission_keys);
}

function requirePermission($permission_key) {
    if (!hasPermission($permission_key)) {
        header("Location: access_denied.php");
        exit;
    }
}

function requireAnyPermission($permission_keys) {
    if (!hasAnyPermission($permission_keys)) {
        header("Location: access_denied.php");
        exit;
    }
}

function requireAllPermissions($permission_keys) {
    if (!hasAllPermissions($permission_keys)) {
        header("Location: access_denied.php");
        exit;
    }
}
?> 