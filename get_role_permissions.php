<?php
session_start();
include './config/config.php';
include_once './includes/permission_middleware.php';

// Check if user has permission to view roles
requirePermission('roles.view');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['role_id'])) {
    $role_id = intval($_GET['role_id']);
    
    if ($role_id <= 0) {
        echo '<div class="alert alert-danger">Invalid role ID</div>';
        exit;
    }
    
    // Get role information
    $role_query = "SELECT * FROM roles WHERE id = ?";
    $stmt = $conn->prepare($role_query);
    $stmt->bind_param("i", $role_id);
    $stmt->execute();
    $role = $stmt->get_result()->fetch_assoc();
    
    if (!$role) {
        echo '<div class="alert alert-danger">Role not found</div>';
        exit;
    }
    
    // Get role permissions
    $permissions_query = "
        SELECT p.permission_name, p.permission_key, p.module, p.description, rp.granted_at
        FROM role_permissions rp
        JOIN permissions p ON rp.permission_id = p.id
        WHERE rp.role_id = ? AND p.status = 'active'
        ORDER BY p.module, p.permission_name
    ";
    $stmt = $conn->prepare($permissions_query);
    $stmt->bind_param("i", $role_id);
    $stmt->execute();
    $permissions = $stmt->get_result();
    
    // Get users with this role
    $users_query = "
        SELECT id, CONCAT(first_name, ' ', last_name) as full_name, email
        FROM employees
        WHERE user_role = ?
        ORDER BY first_name, last_name
    ";
    $stmt = $conn->prepare($users_query);
    $stmt->bind_param("i", $role_id);
    $stmt->execute();
    $users = $stmt->get_result();
    
    ?>
    <div class="row">
        <div class="col-md-6">
            <h5>Role Information</h5>
            <table class="table table-sm">
                <tr>
                    <td><strong>Role Name:</strong></td>
                    <td><?php echo htmlspecialchars($role['role_name']); ?></td>
                </tr>
                <tr>
                    <td><strong>Status:</strong></td>
                    <td>
                        <span class="badge bg-<?php echo $role['status'] === 'active' ? 'success' : 'danger'; ?>">
                            <?php echo ucfirst($role['status']); ?>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td><strong>Created:</strong></td>
                    <td><?php echo date('M d, Y H:i', strtotime($role['created_at'])); ?></td>
                </tr>
                <?php if ($role['description']): ?>
                <tr>
                    <td><strong>Description:</strong></td>
                    <td><?php echo htmlspecialchars($role['description']); ?></td>
                </tr>
                <?php endif; ?>
            </table>
        </div>
        <div class="col-md-6">
            <h5>Users with this Role</h5>
            <?php if ($users->num_rows > 0): ?>
                <div class="list-group">
                    <?php while ($user = $users->fetch_assoc()): ?>
                    <div class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <strong><?php echo htmlspecialchars($user['full_name']); ?></strong>
                                <br><small class="text-muted"><?php echo htmlspecialchars($user['email']); ?></small>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <div class="alert alert-info">No users assigned to this role</div>
            <?php endif; ?>
        </div>
    </div>
    
    <hr>
    
    <h5>Permissions (<?php echo $permissions->num_rows; ?>)</h5>
    <?php if ($permissions->num_rows > 0): ?>
        <div class="table-responsive">
            <table class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th>Permission</th>
                        <th>Key</th>
                        <th>Module</th>
                        <th>Description</th>
                        <th>Granted</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($permission = $permissions->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($permission['permission_name']); ?></td>
                        <td><code><?php echo htmlspecialchars($permission['permission_key']); ?></code></td>
                        <td>
                            <span class="badge bg-secondary"><?php echo ucfirst($permission['module']); ?></span>
                        </td>
                        <td><?php echo htmlspecialchars($permission['description']); ?></td>
                        <td><?php echo date('M d, Y', strtotime($permission['granted_at'])); ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-warning">No permissions assigned to this role</div>
    <?php endif; ?>
    
    <div class="mt-3">
        <?php if (hasPermission('permissions.assign')): ?>
        <button class="btn btn-primary" onclick="editRolePermissions(<?php echo $role_id; ?>)">
            <i data-feather="edit" class="feather-16 me-2"></i>Edit Permissions
        </button>
        <?php endif; ?>
    </div>
    <?php
} else {
    echo '<div class="alert alert-danger">Invalid request</div>';
}

$conn->close();
?> 