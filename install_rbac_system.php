<?php
include './config/config.php';

echo "<h2>🔧 Installing Comprehensive RBAC System...</h2>";

// 1. Create permissions table
$permissions_table = "
CREATE TABLE IF NOT EXISTS permissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    permission_name VARCHAR(100) UNIQUE NOT NULL,
    permission_key VARCHAR(100) UNIQUE NOT NULL,
    module VARCHAR(50) NOT NULL,
    description TEXT,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($permissions_table)) {
    echo "<p style='color: green;'>✓ Permissions table created successfully</p>";
} else {
    echo "<p style='color: red;'>✗ Error creating permissions table: " . $conn->error . "</p>";
}

// 2. Create role_permissions table
$role_permissions_table = "
CREATE TABLE IF NOT EXISTS role_permissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role_id INT NOT NULL,
    permission_id INT NOT NULL,
    granted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    granted_by INT,
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE,
    FOREIGN KEY (permission_id) REFERENCES permissions(id) ON DELETE CASCADE,
    FOREIGN KEY (granted_by) REFERENCES employees(id) ON DELETE SET NULL,
    UNIQUE KEY unique_role_permission (role_id, permission_id)
)";

if ($conn->query($role_permissions_table)) {
    echo "<p style='color: green;'>✓ Role permissions table created successfully</p>";
} else {
    echo "<p style='color: red;'>✗ Error creating role permissions table: " . $conn->error . "</p>";
}

// 3. Create user_permissions table (for user-specific permissions)
$user_permissions_table = "
CREATE TABLE IF NOT EXISTS user_permissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    permission_id INT NOT NULL,
    is_granted BOOLEAN DEFAULT TRUE,
    granted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    granted_by INT,
    expires_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES employees(id) ON DELETE CASCADE,
    FOREIGN KEY (permission_id) REFERENCES permissions(id) ON DELETE CASCADE,
    FOREIGN KEY (granted_by) REFERENCES employees(id) ON DELETE SET NULL,
    UNIQUE KEY unique_user_permission (user_id, permission_id)
)";

if ($conn->query($user_permissions_table)) {
    echo "<p style='color: green;'>✓ User permissions table created successfully</p>";
} else {
    echo "<p style='color: red;'>✗ Error creating user permissions table: " . $conn->error . "</p>";
}

// 4. Insert default permissions
$default_permissions = [
    // Dashboard permissions
    ['Dashboard View', 'dashboard.view', 'dashboard', 'View dashboard and analytics'],
    ['Dashboard Export', 'dashboard.export', 'dashboard', 'Export dashboard data'],
    
    // User Management permissions
    ['Users View', 'users.view', 'users', 'View user list'],
    ['Users Create', 'users.create', 'users', 'Create new users'],
    ['Users Edit', 'users.edit', 'users', 'Edit existing users'],
    ['Users Delete', 'users.delete', 'users', 'Delete users'],
    ['Users Export', 'users.export', 'users', 'Export user data'],
    
    // Role Management permissions
    ['Roles View', 'roles.view', 'roles', 'View roles list'],
    ['Roles Create', 'roles.create', 'roles', 'Create new roles'],
    ['Roles Edit', 'roles.edit', 'roles', 'Edit existing roles'],
    ['Roles Delete', 'roles.delete', 'roles', 'Delete roles'],
    ['Roles Assign', 'roles.assign', 'roles', 'Assign roles to users'],
    
    // Permission Management permissions
    ['Permissions View', 'permissions.view', 'permissions', 'View permissions list'],
    ['Permissions Assign', 'permissions.assign', 'permissions', 'Assign permissions to roles'],
    ['Permissions Revoke', 'permissions.revoke', 'permissions', 'Revoke permissions from roles'],
    
    // Product Management permissions
    ['Products View', 'products.view', 'products', 'View products list'],
    ['Products Create', 'products.create', 'products', 'Create new products'],
    ['Products Edit', 'products.edit', 'products', 'Edit existing products'],
    ['Products Delete', 'products.delete', 'products', 'Delete products'],
    ['Products Export', 'products.export', 'products', 'Export product data'],
    
    // Inventory Management permissions
    ['Inventory View', 'inventory.view', 'inventory', 'View inventory'],
    ['Inventory Update', 'inventory.update', 'inventory', 'Update inventory levels'],
    ['Inventory Adjust', 'inventory.adjust', 'inventory', 'Make inventory adjustments'],
    ['Inventory Export', 'inventory.export', 'inventory', 'Export inventory data'],
    
    // Sales Management permissions
    ['Sales View', 'sales.view', 'sales', 'View sales data'],
    ['Sales Create', 'sales.create', 'sales', 'Create new sales'],
    ['Sales Edit', 'sales.edit', 'sales', 'Edit existing sales'],
    ['Sales Delete', 'sales.delete', 'sales', 'Delete sales'],
    ['Sales Export', 'sales.export', 'sales', 'Export sales data'],
    ['Sales Refund', 'sales.refund', 'sales', 'Process refunds'],
    
    // POS permissions
    ['POS Access', 'pos.access', 'pos', 'Access POS system'],
    ['POS Open Session', 'pos.open_session', 'pos', 'Open POS session'],
    ['POS Close Session', 'pos.close_session', 'pos', 'Close POS session'],
    ['POS View Sessions', 'pos.view_sessions', 'pos', 'View POS sessions'],
    
    // Customer Management permissions
    ['Customers View', 'customers.view', 'customers', 'View customers list'],
    ['Customers Create', 'customers.create', 'customers', 'Create new customers'],
    ['Customers Edit', 'customers.edit', 'customers', 'Edit existing customers'],
    ['Customers Delete', 'customers.delete', 'customers', 'Delete customers'],
    ['Customers Export', 'customers.export', 'customers', 'Export customer data'],
    
    // Supplier Management permissions
    ['Suppliers View', 'suppliers.view', 'suppliers', 'View suppliers list'],
    ['Suppliers Create', 'suppliers.create', 'suppliers', 'Create new suppliers'],
    ['Suppliers Edit', 'suppliers.edit', 'suppliers', 'Edit existing suppliers'],
    ['Suppliers Delete', 'suppliers.delete', 'suppliers', 'Delete suppliers'],
    ['Suppliers Export', 'suppliers.export', 'suppliers', 'Export supplier data'],
    
    // Reports permissions
    ['Reports View', 'reports.view', 'reports', 'View reports'],
    ['Reports Generate', 'reports.generate', 'reports', 'Generate reports'],
    ['Reports Export', 'reports.export', 'reports', 'Export reports'],
    
    // Settings permissions
    ['Settings View', 'settings.view', 'settings', 'View system settings'],
    ['Settings Edit', 'settings.edit', 'settings', 'Edit system settings'],
    ['Settings Backup', 'settings.backup', 'settings', 'Create system backups'],
    
    // System Administration permissions
    ['System Admin', 'system.admin', 'system', 'Full system administration access'],
    ['System Logs', 'system.logs', 'system', 'View system logs'],
    ['System Maintenance', 'system.maintenance', 'system', 'Perform system maintenance']
];

$permission_insert = $conn->prepare("INSERT IGNORE INTO permissions (permission_name, permission_key, module, description) VALUES (?, ?, ?, ?)");

foreach ($default_permissions as $permission) {
    $permission_insert->bind_param("ssss", $permission[0], $permission[1], $permission[2], $permission[3]);
    if ($permission_insert->execute()) {
        echo "<p style='color: green;'>✓ Permission added: {$permission[0]}</p>";
    } else {
        echo "<p style='color: orange;'>⚠ Permission already exists: {$permission[0]}</p>";
    }
}

// 5. Assign permissions to admin role
$admin_role_id = 1; // Assuming admin role has ID 1

// Get all permission IDs
$permission_ids = $conn->query("SELECT id FROM permissions WHERE status = 'active'");
$admin_permissions = [];
while ($row = $permission_ids->fetch_assoc()) {
    $admin_permissions[] = $row['id'];
}

// Assign all permissions to admin role
$role_permission_insert = $conn->prepare("INSERT IGNORE INTO role_permissions (role_id, permission_id, granted_by) VALUES (?, ?, ?)");

foreach ($admin_permissions as $permission_id) {
    $role_permission_insert->bind_param("iii", $admin_role_id, $permission_id, $admin_role_id);
    if ($role_permission_insert->execute()) {
        echo "<p style='color: green;'>✓ Admin permission assigned: ID {$permission_id}</p>";
    } else {
        echo "<p style='color: orange;'>⚠ Admin permission already assigned: ID {$permission_id}</p>";
    }
}

// 6. Assign basic permissions to managers role
$managers_role_id = 3; // Assuming managers role has ID 3

$manager_permissions = [
    'dashboard.view',
    'dashboard.export',
    'users.view',
    'products.view',
    'products.create',
    'products.edit',
    'inventory.view',
    'inventory.update',
    'sales.view',
    'sales.create',
    'sales.edit',
    'pos.access',
    'pos.open_session',
    'pos.close_session',
    'pos.view_sessions',
    'customers.view',
    'customers.create',
    'customers.edit',
    'suppliers.view',
    'reports.view',
    'reports.generate',
    'settings.view'
];

foreach ($manager_permissions as $permission_key) {
    $stmt = $conn->prepare("SELECT id FROM permissions WHERE permission_key = ?");
    $stmt->bind_param("s", $permission_key);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($permission = $result->fetch_assoc()) {
        $role_permission_insert->bind_param("iii", $managers_role_id, $permission['id'], $admin_role_id);
        if ($role_permission_insert->execute()) {
            echo "<p style='color: green;'>✓ Manager permission assigned: {$permission_key}</p>";
        } else {
            echo "<p style='color: orange;'>⚠ Manager permission already assigned: {$permission_key}</p>";
        }
    }
}

echo "<h3 style='color: green;'>✅ RBAC System Installation Complete!</h3>";
echo "<p><strong>Features Available:</strong></p>";
echo "<ul>";
echo "<li>✅ Granular Permission System</li>";
echo "<li>✅ Role-Based Access Control</li>";
echo "<li>✅ User-Specific Permissions</li>";
echo "<li>✅ Permission Inheritance</li>";
echo "<li>✅ Admin Interface</li>";
echo "<li>✅ Permission Checking Middleware</li>";
echo "</ul>";

echo "<p><strong>Next Steps:</strong></p>";
echo "<ul>";
echo "<li><a href='roles_permissions.php'>Manage Roles & Permissions</a></li>";
echo "<li><a href='users.php'>Manage Users</a></li>";
echo "<li><a href='permission_check.php'>Test Permission System</a></li>";
echo "</ul>";

$conn->close();
?> 