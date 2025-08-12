<?php
session_start();
include './config/config.php';
include_once './includes/permission_middleware.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$permissionMiddleware = new PermissionMiddleware($conn);
$user_permissions = $permissionMiddleware->getUserPermissions($_SESSION['user_id']);
$user_role = $permissionMiddleware->getUserRole($_SESSION['user_id']);

include_once "./includes/header.php";
?>

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Permission System Test</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Permission Test</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Your Information</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm">
                            <tr>
                                <td><strong>User ID:</strong></td>
                                <td><?php echo $_SESSION['user_id']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Name:</strong></td>
                                <td><?php echo $_SESSION['full_name'] ?? 'N/A'; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Email:</strong></td>
                                <td><?php echo $_SESSION['email'] ?? 'N/A'; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Role:</strong></td>
                                <td>
                                    <?php if ($user_role): ?>
                                        <span class="badge bg-primary"><?php echo htmlspecialchars($user_role['role_name']); ?></span>
                                        <span class="badge bg-<?php echo $user_role['status'] === 'active' ? 'success' : 'danger'; ?>">
                                            <?php echo ucfirst($user_role['status']); ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-warning">No Role Assigned</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Total Permissions:</strong></td>
                                <td><span class="badge bg-info"><?php echo count($user_permissions); ?></span></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Permission Tests</h4>
                    </div>
                    <div class="card-body">
                        <h6>Test Specific Permissions:</h6>
                        <div class="mb-3">
                            <strong>Dashboard Access:</strong>
                            <?php if (hasPermission('dashboard.view')): ?>
                                <span class="badge bg-success">✓ Allowed</span>
                            <?php else: ?>
                                <span class="badge bg-danger">✗ Denied</span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="mb-3">
                            <strong>User Management:</strong>
                            <?php if (hasPermission('users.view')): ?>
                                <span class="badge bg-success">✓ Allowed</span>
                            <?php else: ?>
                                <span class="badge bg-danger">✗ Denied</span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="mb-3">
                            <strong>Role Management:</strong>
                            <?php if (hasPermission('roles.view')): ?>
                                <span class="badge bg-success">✓ Allowed</span>
                            <?php else: ?>
                                <span class="badge bg-danger">✗ Denied</span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="mb-3">
                            <strong>POS Access:</strong>
                            <?php if (hasPermission('pos.access')): ?>
                                <span class="badge bg-success">✓ Allowed</span>
                            <?php else: ?>
                                <span class="badge bg-danger">✗ Denied</span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="mb-3">
                            <strong>System Admin:</strong>
                            <?php if (hasPermission('system.admin')): ?>
                                <span class="badge bg-success">✓ Allowed</span>
                            <?php else: ?>
                                <span class="badge bg-danger">✗ Denied</span>
                            <?php endif; ?>
                        </div>
                        
                        <hr>
                        
                        <h6>Test Multiple Permissions:</h6>
                        <div class="mb-3">
                            <strong>Any Sales Permission:</strong>
                            <?php if (hasAnyPermission(['sales.view', 'sales.create', 'sales.edit'])): ?>
                                <span class="badge bg-success">✓ Allowed</span>
                            <?php else: ?>
                                <span class="badge bg-danger">✗ Denied</span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="mb-3">
                            <strong>All Product Permissions:</strong>
                            <?php if (hasAllPermissions(['products.view', 'products.create', 'products.edit'])): ?>
                                <span class="badge bg-success">✓ Allowed</span>
                            <?php else: ?>
                                <span class="badge bg-danger">✗ Denied</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Your Permissions (<?php echo count($user_permissions); ?>)</h4>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($user_permissions)): ?>
                            <div class="row">
                                <?php
                                $permissions_by_module = [];
                                foreach ($user_permissions as $permission_key) {
                                    $module = explode('.', $permission_key)[0];
                                    if (!isset($permissions_by_module[$module])) {
                                        $permissions_by_module[$module] = [];
                                    }
                                    $permissions_by_module[$module][] = $permission_key;
                                }
                                
                                foreach ($permissions_by_module as $module => $permissions):
                                ?>
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="mb-0">
                                                <i data-feather="folder" class="feather-16 me-2"></i>
                                                <?php echo ucfirst($module); ?> (<?php echo count($permissions); ?>)
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <?php foreach ($permissions as $permission): ?>
                                            <div class="mb-1">
                                                <span class="badge bg-secondary"><?php echo htmlspecialchars($permission); ?></span>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-warning">
                                <h6>No Permissions Assigned</h6>
                                <p class="mb-0">You don't have any permissions assigned. Please contact your administrator.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Quick Actions</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <a href="roles_permissions.php" class="btn btn-primary w-100">
                                    <i data-feather="shield" class="feather-16 me-2"></i>Manage Roles
                                </a>
                            </div>
                            <div class="col-md-3 mb-3">
                                <a href="users.php" class="btn btn-info w-100">
                                    <i data-feather="users" class="feather-16 me-2"></i>Manage Users
                                </a>
                            </div>
                            <div class="col-md-3 mb-3">
                                <a href="pos.php" class="btn btn-success w-100">
                                    <i data-feather="shopping-cart" class="feather-16 me-2"></i>POS System
                                </a>
                            </div>
                            <div class="col-md-3 mb-3">
                                <a href="index.php" class="btn btn-secondary w-100">
                                    <i data-feather="home" class="feather-16 me-2"></i>Dashboard
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once "./includes/footer.php"; ?> 