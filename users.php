<?php include_once "./includes/session_check.php" ?>
<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php";?>
    <body>
		
		<!-- <div id="global-loader" >
			<div class="whirly-loader"> </div>
		</div> -->
	
		 
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			
			<!-- Header -->
			<?php include "includes/navbar.php";?>
			<!-- /Header -->
			
			<!-- Sidebar -->
			<?php include "includes/sidebar.php";?>
			<!-- /Sidebar -->



			<div class="page-wrapper">
				<div class="content">
					<div class="page-header">
						<div class="add-item d-flex">
							<div class="page-title">
								<h4>System Users List</h4>
								<h6>Manage Your System Users</h6>
							</div>
						</div>
						<ul class="table-top-head">
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"><img src="assets/img/icons/pdf.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Excel"><img src="assets/img/icons/excel.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Print"><i data-feather="printer" class="feather-rotate-ccw"></i></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i data-feather="rotate-ccw" class="feather-rotate-ccw"></i></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i data-feather="chevron-up" class="feather-chevron-up"></i></a>
							</li>
						</ul>
						<div class="page-btn">
							<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-units"><i data-feather="plus-circle" class="me-2"></i>Add New User</a>
						</div>
					</div>


					<!-- /product list -->
					<div class="card table-list-card">
						<div class="card-body">
							<div class="table-top">
								<div class="search-set">
									<div class="search-input">
										<a href="" class="btn btn-searchset"><i data-feather="search" class="feather-search"></i></a>
									</div>
								</div>
								<div class="search-path">
									<div class="d-flex align-items-center">
										<a class="btn btn-filter" id="filter_search">
											<i data-feather="filter" class="filter-icon"></i>
											<span><img src="assets/img/icons/closes.svg" alt="img"></span>
										</a>
									</div>
								</div>
								<div class="form-sort">
									<i data-feather="sliders" class="info-img"></i>
									<select class="select">
										<option>Sort by Date</option>
										<option>Newest</option>
										<option>Oldest</option>
									</select>
								</div>
							</div>
							<!-- /Filter -->
							<div class="card" id="filter_inputs">
								<div class="card-body pb-0">
									<div class="row">
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<i data-feather="user" class="info-img"></i>
												<select class="select">
													<option>Choose Name</option>
													<option>Lilly</option>
													<option>Benjamin</option>
												</select>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<i data-feather="stop-circle" class="info-img"></i>
												<select class="select">
													<option>Choose Status</option>
													<option>Active</option>
													<option>Inactive</option>
												</select>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<i data-feather="zap" class="info-img"></i>
												<select class="select">
													<option>Choose Role</option>
													<option>Store Keeper</option>
													<option>Salesman</option>
												</select>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<a class="btn btn-filters ms-auto"> <i data-feather="search" class="feather-search"></i> Search </a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- /Filter -->
							<div class="table-responsive">
	<?php
// Include database connection
include "config/config.php";

// Fetch employees with role names
$employeeQuery = "
    SELECT id, 
           CONCAT(first_name, ' ', last_name) AS full_name, 
           contact_number, 
           email, 
           (SELECT role_name FROM roles WHERE roles.id = employees.user_role) AS role_name, 
           created_at, 
           employee_status 
    FROM employees
    WHERE user_role IS NOT NULL AND user_role != ''
";


$employeeResult = $conn->query($employeeQuery);
?>

<table class="table datanew">
    <thead>
        <tr>
            <th class="no-sort">
                <label class="checkboxs">
                    <input type="checkbox" id="select-all">
                    <span class="checkmarks"></span>
                </label>
            </th>
            <th>User Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Role</th>
            <th>Created On</th>
            <th>Status</th>
            <th class="no-sort">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($employee = $employeeResult->fetch_assoc()): ?>
            <tr>
                <td>
                    <label class="checkboxs">
                        <input type="checkbox">
                        <span class="checkmarks"></span>
                    </label>
                </td>
                <td><?= htmlspecialchars($employee['full_name']); ?></td>
                <td><?= htmlspecialchars($employee['contact_number']); ?></td>
                <td><?= htmlspecialchars($employee['email']); ?></td>
                <td><?= htmlspecialchars($employee['role_name'] ?? 'N/A'); ?></td>
                <td><?= date("d M Y", strtotime($employee['created_at'])); ?></td>
                <td>
                    <?php if ($employee['employee_status'] == 1): ?>
                        <span class="badge badge-linesuccess">Active</span>
                    <?php else: ?>
                        <span class="badge badge-linedanger">Inactive</span>
                    <?php endif; ?>
                </td>
                <td class="action-table-data">
    <div class="edit-delete-action">
    <a class="me-2 p-2 mb-0 edit-user" 
   data-bs-toggle="modal" 
   data-bs-target="#edit-units" 
   data-id="<?= $employee['id']; ?>" 
   data-name="<?= htmlspecialchars($employee['full_name']); ?>" 
   data-role=" <?= $employee['role_name']; ?>">
    <i data-feather="edit" class="feather-edit"></i>
</a>

    
        </a>
    </div>
</td>

            </tr>
        <?php endwhile; ?>
    </tbody>
</table>



							</div>
						</div>
					</div>
					<!-- /product list -->
				</div>
			</div>
			
        </div>
		<!-- /Main Wrapper -->

		<!-- Add User -->
		<?php
// Include database connection
include "config/config.php";

// Fetch employees
$employeeQuery = "SELECT id, CONCAT(first_name, ' ', last_name) AS full_name FROM employees";
$employeeResult = $conn->query($employeeQuery);

// Fetch roles
$roleQuery = "SELECT id, role_name FROM roles";
$roleResult = $conn->query($roleQuery);
?>

<!-- Add User Modal -->
<div class="modal fade" id="add-units">
    <div class="modal-dialog modal-dialog-centered custom-modal-two">
        <div class="modal-content">
            <div class="page-wrapper-new p-0">
                <div class="content">
                    <div class="modal-header border-0 custom-modal-header">
                        <div class="page-title">
                            <h4>Add System User</h4>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body custom-modal-body">
                        <form action="save_user.php" method="POST">
                            <div class="row">
                                <!-- User Name Selection -->
                                <div class="col-lg-6">
                                    <div class="input-blocks">
                                        <label>User Name</label>
                                        <select class="select" name="employee_id" required>
                                            <option value="">Select User</option>
                                            <?php while ($employee = $employeeResult->fetch_assoc()): ?>
                                                <option value="<?= htmlspecialchars($employee['id']); ?>">
                                                    <?= htmlspecialchars($employee['full_name']); ?>
                                                </option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- User Role Selection -->
                                <div class="col-lg-6">
                                    <div class="input-blocks">
                                        <label>Role</label>
                                        <select class="select" name="user_role" required>
                                            <option value="">Choose</option>
                                            <?php while ($role = $roleResult->fetch_assoc()): ?>
                                                <option value="<?= htmlspecialchars($role['id']); ?>">
                                                    <?= htmlspecialchars($role['role_name']); ?>
                                                </option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Password -->
                                <div class="col-lg-6 mt-4">
                                    <div class="input-blocks">
                                        <label>Password</label>
                                        <div class="pass-group">
                                            <input type="password" class="pass-input" name="password" required>
                                            <span class="fas toggle-password fa-eye-slash"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Confirm Password -->
                                <div class="col-lg-6 mt-4">
                                    <div class="input-blocks">
                                        <label>Confirm Password</label>
                                        <div class="pass-group">
                                            <input type="password" class="pass-input" name="confirm_password" required>
                                            <span class="fas toggle-password fa-eye-slash"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer-btn">
                                <button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Add User Modal -->

 <!-- edit User Modal -->

 <?php 
 // Fetch roles
$roleQuery = "SELECT id, role_name FROM roles";
$roleResult = $conn->query($roleQuery);
?>
<div class="modal fade" id="edit-units">
    <div class="modal-dialog modal-dialog-centered custom-modal-two">
        <div class="modal-content">
            <div class="page-wrapper-new p-0">
                <div class="content">
                    <div class="modal-header border-0 custom-modal-header">
                        <div class="page-title">
                            <h4>Edit system User Role</h4>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body custom-modal-body">
                    <form id="editUserForm" action="save_user.php" method="POST">
    <input type="hidden" name="employee_id" id="employeeId">

    <div class="row">
        <div class="col-lg-12">
            <div class="input-blocks">
                <label>Role</label>
                <select class="select" name="user_role" id="roleDropdown" required>
                    <option value="">Choose</option>
                    <?php while ($role = $roleResult->fetch_assoc()): ?>
                        <option value="<?= htmlspecialchars($role['id']); ?>">
                            <?= htmlspecialchars($role['role_name']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>

        <div class="col-lg-6 mt-4">
            <div class="input-blocks">
                <label>Password</label>
                <div class="pass-group">
                    <input type="password" class="pass-input" name="password">
                    <span class="fas toggle-password fa-eye-slash"></span>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mt-4">
            <div class="input-blocks">
                <label>Confirm Password</label>
                <div class="pass-group">
                    <input type="password" class="pass-input" name="confirm_password">
                    <span class="fas toggle-password fa-eye-slash"></span>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-footer-btn">
        <button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-submit">Submit</button>
    </div>
</form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /edit User Modal -->



		 


		<?php include "includes/footer.php";?>
        <script>
$(document).on("click", ".edit-user", function () {
    var userId = $(this).data("id");
    var userRole = $(this).data("role");
    var userName = $(this).data("name");

    $("#editModalTitle").text('Edit employee "' + userName + '" User Role');
    $("#employeeId").val(userId);
    $("#roleDropdown").val(userRole);
});

$("#editUserForm").on("submit", function (event) {
    event.preventDefault(); // Prevent default form submission

    $.ajax({
        type: "POST",
        url: "save_user.php",
        data: $(this).serialize(),
        dataType: "json",
        success: function (response) {
            if (response.status === "success") {
                alert("User role updated successfully!");
                $("#edit-units").modal("hide"); // Close modal
                location.reload(); // Reload DataTable
            } else {
                alert("Error: " + response.message);
            }
        },
        error: function () {
            alert("Something went wrong.");
        }
    });
});


        </script>

	
    </body>
</html>