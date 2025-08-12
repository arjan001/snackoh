<?php
session_start();
include './config/config.php';
include_once './includes/permission_middleware.php';

// Check if user has permission to view permissions
requirePermission('permissions.view');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['permission_key'])) {
    $permission_key = trim($_GET['permission_key']);
    
    if (empty($permission_key)) {
        echo '<div class="alert alert-danger">Invalid permission key</div>';
        exit;
    }
    
    // Get permission information
    $permission_query = "SELECT * FROM permissions WHERE permission_key = ?";
    $stmt = $conn->prepare($permission_query);
    $stmt->bind_param("s", $permission_key);
    $stmt->execute();
    $permission = $stmt->get_result()->fetch_assoc();
    
    if (!$permission) {
        echo '<div class="alert alert-danger">Permission not found</div>';
        exit;
    }
    
    // Get roles that have this permission
    $roles_query = "
        SELECT r.role_name, r.status, rp.granted_at, COUNT(e.id) as user_count
        FROM role_permissions rp
        JOIN roles r ON rp.role_id = r.id
        JOIN permissions p ON rp.permission_id = p.id
        LEFT JOIN employees e ON r.id = e.user_role
        WHERE p.permission_key = ?
        GROUP BY r.id, r.role_name, r.status, rp.granted_at
        ORDER BY r.role_name
    ";
    $stmt = $conn->prepare($roles_query);
    $stmt->bind_param("s", $permission_key);
    $stmt->execute();
    $roles = $stmt->get_result();
    
    // Get users with user-specific permissions
    $users_query = "
        SELECT e.id, CONCAT(e.first_name, ' ', e.last_name) as full_name, e.email, 
               up.is_granted, up.expires_at, up.granted_at,
               r.role_name as user_role
        FROM user_permissions up
        JOIN permissions p ON up.permission_id = p.id
        JOIN employees e ON up.user_id = e.id
        LEFT JOIN roles r ON e.user_role = r.id
        WHERE p.permission_key = ?
        ORDER BY e.first_name, e.last_name
    ";
    $stmt = $conn->prepare($users_query);
    $stmt->bind_param("s", $permission_key);
    $stmt->execute();
    $users = $stmt->get_result();
    
    ?>
    <div class="row">
        <div class="col-md-12">
            <h5>Permission Information</h5>
            <table class="table table-sm">
                <tr>
                    <td><strong>Permission Name:</strong></td>
                    <td><?php echo htmlspecialchars($permission['permission_name']); ?></td>
                </tr>
                <tr>
                    <td><strong>Permission Key:</strong></td>
                    <td><code><?php echo htmlspecialchars($permission['permission_key']); ?></code></td>
                </tr>
                <tr>
                    <td><strong>Module:</strong></td>
                    <td>
                        <span class="badge bg-secondary"><?php echo ucfirst($permission['module']); ?></span>
                    </td>
                </tr>
                <tr>
                    <td><strong>Status:</strong></td>
                    <td>
                        <span class="badge bg-<?php echo $permission['status'] === 'active' ? 'success' : 'danger'; ?>">
                            <?php echo ucfirst($permission['status']); ?>
                        </span>
                    </td>
                </tr>
                <?php if ($permission['description']): ?>
                <tr>
                    <td><strong>Description:</strong></td>
                    <td><?php echo htmlspecialchars($permission['description']); ?></td>
                </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
    
    <hr>
    
    <div class="row">
        <div class="col-md-6">
            <h5>Roles with this Permission (<?php echo $roles->num_rows; ?>)</h5>
            <?php if ($roles->num_rows > 0): ?>
                <div class="table-responsive">
                    <table class="table table-sm table-striped">
                        <thead>
                            <tr>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Users</th>
                                <th>Granted</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($role = $roles->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($role['role_name']); ?></td>
                                <td>
                                    <span class="badge bg-<?php echo $role['status'] === 'active' ? 'success' : 'danger'; ?>">
                                        <?php echo ucfirst($role['status']); ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-info"><?php echo $role['user_count']; ?> users</span>
                                </td>
                                <td><?php echo date('M d, Y', strtotime($role['granted_at'])); ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info">No roles have this permission</div>
            <?php endif; ?>
        </div>
        
        <div class="col-md-6">
            <h5>User-Specific Permissions (<?php echo $users->num_rows; ?>)</h5>
            <?php if ($users->num_rows > 0): ?>
                <div class="table-responsive">
                    <table class="table table-sm table-striped">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Expires</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($user = $users->fetch_assoc()): ?>
                            <tr>
                                <td>
                                    <div>
                                        <strong><?php echo htmlspecialchars($user['full_name']); ?></strong>
                                        <br><small class="text-muted"><?php echo htmlspecialchars($user['email']); ?></small>
                                    </div>
                                </td>
                                <td><?php echo htmlspecialchars($user['user_role'] ?? 'No role'); ?></td>
                                <td>
                                    <?php if ($user['expires_at'] && strtotime($user['expires_at']) < time()): ?>
                                        <span class="badge bg-danger">Expired</span>
                                    <?php else: ?>
                                        <span class="badge bg-<?php echo $user['is_granted'] ? 'success' : 'danger'; ?>">
                                            <?php echo $user['is_granted'] ? 'Granted' : 'Denied'; ?>
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($user['expires_at']): ?>
                                        <?php echo date('M d, Y', strtotime($user['expires_at'])); ?>
                                    <?php else: ?>
                                        <span class="text-muted">Never</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info">No user-specific permissions for this permission</div>
            <?php endif; ?>
        </div>
    </div>
    <?php
} else {
    echo '<div class="alert alert-danger">Invalid request</div>';
}

$conn->close();
?> 