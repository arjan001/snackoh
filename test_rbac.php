<?php
session_start();
include './config/config.php';
include_once './includes/permission_middleware.php';

echo "<h2>RBAC System Test</h2>";

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<p style='color: red;'>❌ User not logged in</p>";
    echo "<p><a href='login.php'>Login here</a></p>";
    exit;
}

echo "<p style='color: green;'>✅ User logged in (ID: {$_SESSION['user_id']})</p>";

// Test permission middleware
try {
    $permissionMiddleware = new PermissionMiddleware($conn);
    echo "<p style='color: green;'>✅ Permission middleware loaded successfully</p>";
    
    // Get user permissions
    $user_permissions = $permissionMiddleware->getUserPermissions($_SESSION['user_id']);
    echo "<p style='color: green;'>✅ User permissions retrieved: " . count($user_permissions) . " permissions</p>";
    
    // Get user role
    $user_role = $permissionMiddleware->getUserRole($_SESSION['user_id']);
    if ($user_role) {
        echo "<p style='color: green;'>✅ User role: {$user_role['role_name']} ({$user_role['status']})</p>";
    } else {
        echo "<p style='color: orange;'>⚠ No role assigned to user</p>";
    }
    
    // Test specific permissions
    echo "<h3>Permission Tests:</h3>";
    
    $test_permissions = [
        'dashboard.view',
        'users.view',
        'roles.view',
        'permissions.view',
        'pos.access',
        'system.admin'
    ];
    
    foreach ($test_permissions as $permission) {
        $has_permission = $permissionMiddleware->hasPermission($_SESSION['user_id'], $permission);
        $status = $has_permission ? '✅' : '❌';
        echo "<p>{$status} {$permission}: " . ($has_permission ? 'ALLOWED' : 'DENIED') . "</p>";
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Error: " . $e->getMessage() . "</p>";
}

// Test database tables
echo "<h3>Database Tables Check:</h3>";

$tables = ['permissions', 'role_permissions', 'user_permissions'];
foreach ($tables as $table) {
    $result = $conn->query("SHOW TABLES LIKE '$table'");
    if ($result->num_rows > 0) {
        echo "<p style='color: green;'>✅ Table '$table' exists</p>";
        
        // Count records
        $count_result = $conn->query("SELECT COUNT(*) as count FROM $table");
        $count = $count_result->fetch_assoc()['count'];
        echo "<p style='color: blue;'>📊 Records in '$table': $count</p>";
    } else {
        echo "<p style='color: red;'>❌ Table '$table' missing</p>";
    }
}

echo "<h3>Quick Links:</h3>";
echo "<ul>";
echo "<li><a href='roles_permissions.php'>Manage Roles & Permissions</a></li>";
echo "<li><a href='permission_check.php'>Detailed Permission Test</a></li>";
echo "<li><a href='index.php'>Dashboard</a></li>";
echo "</ul>";

$conn->close();
?> 