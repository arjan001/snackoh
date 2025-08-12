<?php
include_once "./includes/header.php";
?>

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="mb-4">
                            <i data-feather="shield" class="feather-64 text-danger"></i>
                        </div>
                        <h2 class="text-danger mb-3">Access Denied</h2>
                        <p class="text-muted mb-4">
                            You don't have permission to access this resource. 
                            Please contact your administrator if you believe this is an error.
                        </p>
                        
                        <?php if (isset($_SESSION['user_id'])): ?>
                        <div class="alert alert-info">
                            <h6>Your Current Permissions:</h6>
                            <?php
                            include_once './includes/permission_middleware.php';
                            $permissionMiddleware = new PermissionMiddleware($conn);
                            $user_permissions = $permissionMiddleware->getUserPermissions($_SESSION['user_id']);
                            
                            if (!empty($user_permissions)) {
                                echo '<div class="mt-2">';
                                foreach (array_slice($user_permissions, 0, 10) as $permission) {
                                    echo '<span class="badge bg-secondary me-1 mb-1">' . htmlspecialchars($permission) . '</span>';
                                }
                                if (count($user_permissions) > 10) {
                                    echo '<span class="badge bg-secondary">+' . (count($user_permissions) - 10) . ' more</span>';
                                }
                                echo '</div>';
                            } else {
                                echo '<p class="text-muted mb-0">No permissions assigned</p>';
                            }
                            ?>
                        </div>
                        <?php endif; ?>
                        
                        <div class="mt-4">
                            <a href="index.php" class="btn btn-primary me-2">
                                <i data-feather="home" class="feather-16 me-2"></i>Go to Dashboard
                            </a>
                            <a href="javascript:history.back()" class="btn btn-secondary">
                                <i data-feather="arrow-left" class="feather-16 me-2"></i>Go Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once "./includes/footer.php"; ?> 