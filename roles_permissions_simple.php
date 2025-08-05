<?php
include_once "./includes/session_check.php";
include_once "./includes/permission_middleware.php";
requirePermission('roles.view');

include_once "./includes/header.php";
include_once "./includes/sidebar.php";

$permissionMiddleware = new PermissionMiddleware($conn);
?>

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Roles & Permissions Management</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Roles & Permissions</li>
                    </ul>
                </div>
                <div class="col-auto text-end float-end ms-auto">
                    <?php if (hasPermission('roles.create')): ?>
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoleModal">
                        <i data-feather="plus-circle" class="me-2"></i>Add New Role
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Roles Section -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Roles</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Role Name</th>
                                        <th>Status</th>
                                        <th>Users</th>
                                        <th>Permissions</th>
                                        <th>Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $roles_query = "SELECT r.*, COUNT(DISTINCT e.id) as user_count, COUNT(DISTINCT rp.permission_id) as permission_count 
                                                   FROM roles r 
                                                   LEFT JOIN employees e ON r.id = e.user_role 
                                                   LEFT JOIN role_permissions rp ON r.id = rp.role_id 
                                                   GROUP BY r.id 
                                                   ORDER BY r.role_name";
                                    $roles_result = $conn->query($roles_query);
                                    
                                    while ($role = $roles_result->fetch_assoc()):
                                    ?>
                                    <tr>
                                        <td>
                                            <strong><?php echo htmlspecialchars($role['role_name']); ?></strong>
                                        </td>
                                        <td>
                                            <span class="badge bg-<?php echo $role['status'] === 'active' ? 'success' : 'danger'; ?>">
                                                <?php echo ucfirst($role['status']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-info"><?php echo $role['user_count']; ?> users</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-warning"><?php echo $role['permission_count']; ?> permissions</span>
                                        </td>
                                        <td><?php echo date('M d, Y', strtotime($role['created_at'])); ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                    Actions
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <?php if (hasPermission('roles.view')): ?>
                                                    <li><a class="dropdown-item" href="#" onclick="viewRolePermissions(<?php echo $role['id']; ?>)">
                                                        <i data-feather="eye" class="feather-16 me-2"></i>View Permissions
                                                    </a></li>
                                                    <?php endif; ?>
                                                    
                                                    <?php if (hasPermission('permissions.assign')): ?>
                                                    <li><a class="dropdown-item" href="#" onclick="editRolePermissions(<?php echo $role['id']; ?>)">
                                                        <i data-feather="edit" class="feather-16 me-2"></i>Edit Permissions
                                                    </a></li>
                                                    <?php endif; ?>
                                                    
                                                    <?php if (hasPermission('roles.edit')): ?>
                                                    <li><a class="dropdown-item" href="#" onclick="editRole(<?php echo $role['id']; ?>, '<?php echo htmlspecialchars($role['role_name']); ?>', '<?php echo $role['status']; ?>')">
                                                        <i data-feather="edit-3" class="feather-16 me-2"></i>Edit Role
                                                    </a></li>
                                                    <?php endif; ?>
                                                    
                                                    <?php if (hasPermission('roles.delete') && $role['user_count'] == 0): ?>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item text-danger" href="#" onclick="deleteRole(<?php echo $role['id']; ?>)">
                                                        <i data-feather="trash-2" class="feather-16 me-2"></i>Delete Role
                                                    </a></li>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Role Modal -->
<?php if (hasPermission('roles.create')): ?>
<div class="modal fade" id="addRoleModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addRoleForm">
                    <div class="mb-3">
                        <label for="roleName" class="form-label">Role Name</label>
                        <input type="text" class="form-control" id="roleName" name="role_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="roleDescription" class="form-label">Description (Optional)</label>
                        <textarea class="form-control" id="roleDescription" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="roleStatus" name="status" checked>
                            <label class="form-check-label" for="roleStatus">
                                Active
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="createRole()">Create Role</button>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Edit Role Modal -->
<?php if (hasPermission('roles.edit')): ?>
<div class="modal fade" id="editRoleModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editRoleForm">
                    <input type="hidden" id="editRoleId" name="role_id">
                    <div class="mb-3">
                        <label for="editRoleName" class="form-label">Role Name</label>
                        <input type="text" class="form-control" id="editRoleName" name="role_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="editRoleDescription" class="form-label">Description (Optional)</label>
                        <textarea class="form-control" id="editRoleDescription" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="editRoleStatus" name="status">
                            <label class="form-check-label" for="editRoleStatus">
                                Active
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="updateRole()">Update Role</button>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<script>
function showNotification(message, type) {
    // Remove any existing notifications
    $('.custom-notification').remove();
    
    // Create notification element
    var notification = $('<div class="custom-notification custom-notification-' + type + '">' + message + '</div>');
    
    // Add to page
    $('body').append(notification);
    
    // Show notification
    setTimeout(function() {
        notification.addClass('show');
    }, 100);
    
    // Hide and remove after 2 seconds
    setTimeout(function() {
        notification.removeClass('show');
        setTimeout(function() {
            notification.remove();
        }, 300);
    }, 2000);
}

function createRole() {
    console.log('Creating role...');
    
    var formData = $('#addRoleForm').serialize();
    console.log('Form data:', formData);
    
    $.ajax({
        url: 'add_role.php',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
            console.log('Response:', response);
            if (response && response.success) {
                showNotification('Role created successfully!', 'success');
                $('#addRoleModal').modal('hide');
                $('#addRoleForm')[0].reset();
                setTimeout(function() {
                    location.reload();
                }, 1000);
            } else {
                showNotification('Error: ' + (response && response.message ? response.message : 'Unknown error'), 'error');
            }
        },
        error: function(xhr, status, error) {
            console.log('AJAX Error:', xhr.responseText);
            showNotification('Error creating role. Please try again.', 'error');
        }
    });
}

function updateRole() {
    console.log('Updating role...');
    
    var formData = $('#editRoleForm').serialize();
    console.log('Form data:', formData);
    
    $.ajax({
        url: 'update_role.php',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
            console.log('Response:', response);
            if (response && response.success) {
                showNotification('Role updated successfully!', 'success');
                $('#editRoleModal').modal('hide');
                setTimeout(function() {
                    location.reload();
                }, 1000);
            } else {
                showNotification('Error: ' + (response && response.message ? response.message : 'Unknown error'), 'error');
            }
        },
        error: function(xhr, status, error) {
            console.log('AJAX Error:', xhr.responseText);
            showNotification('Error updating role. Please try again.', 'error');
        }
    });
}

function editRole(roleId, roleName, status) {
    $('#editRoleId').val(roleId);
    $('#editRoleName').val(roleName);
    $('#editRoleStatus').prop('checked', status === 'active');
    $('#editRoleModal').modal('show');
}

function deleteRole(roleId) {
    if (confirm('Are you sure you want to delete this role?')) {
        $.ajax({
            url: 'delete_role.php',
            type: 'POST',
            data: { role_id: roleId },
            dataType: 'json',
            success: function(response) {
                if (response && response.success) {
                    showNotification('Role deleted successfully!', 'success');
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    showNotification('Error: ' + (response && response.message ? response.message : 'Unknown error'), 'error');
                }
            },
            error: function(xhr, status, error) {
                showNotification('Error deleting role. Please try again.', 'error');
            }
        });
    }
}

function viewRolePermissions(roleId) {
    $.ajax({
        url: 'get_role_permissions.php',
        type: 'GET',
        data: { role_id: roleId },
        success: function(response) {
            alert('Role permissions loaded');
        },
        error: function() {
            alert('Error loading role permissions');
        }
    });
}

function editRolePermissions(roleId) {
    $.ajax({
        url: 'edit_role_permissions.php',
        type: 'GET',
        data: { role_id: roleId },
        success: function(response) {
            alert('Role permissions editor loaded');
        },
        error: function() {
            alert('Error loading role permissions editor');
        }
    });
}
</script>

<style>
.custom-notification {
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 15px 20px;
    border-radius: 5px;
    color: white;
    font-weight: 500;
    z-index: 9999;
    transform: translateX(400px);
    transition: transform 0.3s ease;
    max-width: 300px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.custom-notification.show {
    transform: translateX(0);
}

.custom-notification-success {
    background-color: #28a745;
    border-left: 4px solid #1e7e34;
}

.custom-notification-error {
    background-color: #dc3545;
    border-left: 4px solid #c82333;
}
</style>

<?php include_once "./includes/footer.php"; ?> 