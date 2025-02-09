<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php";?>
    <body>
		
		<div id="global-loader" >
			<div class="whirly-loader"> </div>
		</div>

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
								<h4>Roles & Permission</h4>
								<h6>Manage your roles</h6>
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
							<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-units"><i data-feather="plus-circle" class="me-2"></i> Add New Role</a>
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
									<a class="btn btn-filter" id="filter_search">
										<i data-feather="filter" class="filter-icon"></i>
										<span><img src="assets/img/icons/closes.svg" alt="img"></span>
									</a>
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
												<i data-feather="zap" class="info-img"></i>
												<select class="select">
													<option>Choose Role</option>
													<option>Admin</option>
													<option>Shop Owner</option>
												</select>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<i data-feather="calendar" class="info-img"></i>
												<div class="input-groupicon">
													<input type="text" class="datetimepicker" placeholder="Choose Date" >
												</div>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12 ms-auto">
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
include_once "./config/config.php"; // Ensure DB connection

$query = "SELECT id, role_name, created_at FROM roles ORDER BY created_at DESC";
$result = $conn->query($query);
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
            <th>Role Name</th>
            <th>Created On</th>
            <th class="no-sort">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>
                        <label class='checkboxs'>
                            <input type='checkbox'>
                            <span class='checkmarks'></span>
                        </label>
                    </td>";
                echo "<td>" . htmlspecialchars($row['role_name']) . "</td>";
                echo "<td>" . date("d M Y", strtotime($row['created_at'])) . "</td>";
                echo "<td class='action-table-data'>
                        <div class='edit-delete-action'>
                            <a class='me-2 p-2 edit-role-btn' href='#' data-bs-toggle='modal' 
                               data-bs-target='#edit-units' 
                               data-role-id='" . $row['id'] . "' 
                               data-role-name='" . htmlspecialchars($row['role_name']) . "'>
                                <i data-feather='edit' class='feather-edit'></i>
                            </a>
                            <a class='p-2 me-2' href='permissions.php?role_id=" . $row['id'] . "'>
                                <i data-feather='shield' class='shield'></i>
                            </a>
                            <a class='confirm-text p-2' href='delete_role.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure?\");'>
                                <i data-feather='trash-2' class='feather-trash-2'></i>
                            </a>
                        </div>
                    </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4' class='text-center'>No roles found</td></tr>";
        }
        ?>
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

		<!-- Add Role -->
	<div class="modal fade" id="add-units">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Create Role</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
							<form action="add_roles_permissions.php" method="POST">
    <div class="mb-3">
        <label class="form-label">Role Name</label>
        <input type="text" class="form-control" name="role_name" required>
    </div>

    <!-- Status Toggle -->
    <div class="mt-4">
        <div class="status-toggle modal-status d-flex justify-content-between align-items-center">
            <span class="status-label">Status</span>
            <input type="checkbox" id="unit_status" class="check" name="status" value="active" checked>
            <label for="unit_status" class="checktoggle"></label>
        </div>
    </div>

    <!-- Submit & Cancel Buttons -->
    <div class="modal-footer-btn">
        <button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-submit">Create Role</button>
    </div>
</form>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Add Role -->

<!-- Edit Role Modal -->
<div class="modal fade" id="edit-units">
    <div class="modal-dialog modal-dialog-centered custom-modal-two">
        <div class="modal-content">
            <div class="page-wrapper-new p-0">
                <div class="content">
                    <div class="modal-header border-0 custom-modal-header">
                        <div class="page-title">
                            <h4>Edit Role</h4>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body custom-modal-body">
                        <form action="update_role.php" method="POST">
                            <input type="hidden" id="edit-role-id" name="role_id"> <!-- Hidden field for Role ID -->
                            <div class="mb-0">
                                <label class="form-label">Role Name</label>
                                <input type="text" class="form-control" id="edit-role-name" name="role_name">
                            </div>
                            <div class="modal-footer-btn">
                                <button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-submit">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Edit Role Modal -->

  
		<script>
document.addEventListener("DOMContentLoaded", function() {
    const editButtons = document.querySelectorAll(".edit-role-btn");

    editButtons.forEach(button => {
        button.addEventListener("click", function() {
            let roleId = this.getAttribute("data-role-id");
            let roleName = this.getAttribute("data-role-name");

            document.getElementById("edit-role-id").value = roleId;
            document.getElementById("edit-role-name").value = roleName;
        });
    });
});
</script>
<script>
function confirmDelete(roleId) {
    return confirm("Are you sure you want to delete this role (ID: " + roleId + ")?");
}
</script>


		<?php include "includes/footer.php";?>
	
    </body>
</html>