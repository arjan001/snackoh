<?php
session_start();
include './config/config.php';
include_once './includes/permission_middleware.php';

// Check if user has permission to assign permissions
requirePermission('permissions.assign');

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
    
    // Get current role permissions
    $current_permissions_query = "SELECT permission_id FROM role_permissions WHERE role_id = ?";
    $stmt = $conn->prepare($current_permissions_query);
    $stmt->bind_param("i", $role_id);
    $stmt->execute();
    $current_permissions_result = $stmt->get_result();
    
    $current_permissions = [];
    while ($row = $current_permissions_result->fetch_assoc()) {
        $current_permissions[] = $row['permission_id'];
    }
    
    // Get all permissions grouped by module
    $permissions_query = "SELECT * FROM permissions WHERE status = 'active' ORDER BY module, permission_name";
    $permissions_result = $conn->query($permissions_query);
    
    $permissions_by_module = [];
    while ($permission = $permissions_result->fetch_assoc()) {
        $module = $permission['module'];
        if (!isset($permissions_by_module[$module])) {
            $permissions_by_module[$module] = [];
        }
        $permissions_by_module[$module][] = $permission;
    }
    
    ?>
    <form id="rolePermissionsForm">
        <input type="hidden" name="role_id" value="<?php echo $role_id; ?>">
        
        <div class="alert alert-info">
            <h6>Editing permissions for role: <strong><?php echo htmlspecialchars($role['role_name']); ?></strong></h6>
            <p class="mb-0">Check the permissions you want to assign to this role.</p>
        </div>
        
        <div class="row">
            <?php foreach ($permissions_by_module as $module => $permissions): ?>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">
                            <i data-feather="folder" class="feather-16 me-2"></i>
                            <?php echo ucfirst($module); ?> (<?php echo count($permissions); ?>)
                        </h6>
                    </div>
                    <div class="card-body">
                        <?php foreach ($permissions as $permission): ?>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" 
                                   name="permissions[]" 
                                   value="<?php echo $permission['id']; ?>" 
                                   id="perm_<?php echo $permission['id']; ?>"
                                   <?php echo in_array($permission['id'], $current_permissions) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="perm_<?php echo $permission['id']; ?>">
                                <div>
                                    <strong><?php echo htmlspecialchars($permission['permission_name']); ?></strong>
                                    <br>
                                    <small class="text-muted">
                                        <code><?php echo htmlspecialchars($permission['permission_key']); ?></code>
                                    </small>
                                    <?php if ($permission['description']): ?>
                                    <br>
                                    <small class="text-muted"><?php echo htmlspecialchars($permission['description']); ?></small>
                                    <?php endif; ?>
                                </div>
                            </label>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">
                <i data-feather="save" class="feather-16 me-2"></i>Save Permissions
            </button>
            <button type="button" class="btn btn-secondary" onclick="viewRolePermissions(<?php echo $role_id; ?>)">
                <i data-feather="eye" class="feather-16 me-2"></i>View Permissions
            </button>
        </div>
    </form>
    
    <script>
    $('#rolePermissionsForm').on('submit', function(e) {
        e.preventDefault();
        
        var formData = $(this).serialize();
        
        $.ajax({
            url: 'save_role_permissions.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    alert('Permissions updated successfully!');
                    viewRolePermissions(<?php echo $role_id; ?>);
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function() {
                alert('Error updating permissions');
            }
        });
    });
    </script>
    <?php
} else {
    echo '<div class="alert alert-danger">Invalid request</div>';
}

$conn->close();
?> 