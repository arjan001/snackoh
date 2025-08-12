<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php"; ?>

<body>

	<!-- <div id="global-loader">
		<div class="whirly-loader"> </div>
	</div> -->

	<!-- Main Wrapper -->
	<div class="main-wrapper">

		<!-- Header -->
		<?php include "includes/navbar.php"; ?>
		<!-- /Header -->

		<!-- Sidebar -->
		<?php include "includes/sidebar.php"; ?>
		<!-- /Sidebar -->



		<div class="page-wrapper">
			<div class="content">
				<div class="page-header">
					<div class="add-item d-flex">
						<div class="page-title">
							<h4>Department</h4>
							<h6>Manage your departments</h6>
						</div>
					</div>
					<ul class="table-top-head">
						<li>
							<a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"><img
									src="assets/img/icons/pdf.svg" alt="img"></a>
						</li>
						<li>
							<a data-bs-toggle="tooltip" data-bs-placement="top" title="Excel"><img
									src="assets/img/icons/excel.svg" alt="img"></a>
						</li>
						<li>
							<a data-bs-toggle="tooltip" data-bs-placement="top" title="Print"><i data-feather="printer"
									class="feather-rotate-ccw"></i></a>
						</li>
						<li>
							<a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i
									data-feather="rotate-ccw" class="feather-rotate-ccw"></i></a>
						</li>
						<li>
							<a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i
									data-feather="chevron-up" class="feather-chevron-up"></i></a>
						</li>
					</ul>
					<div class="page-btn">
						<a href="" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-department"><i
								data-feather="plus-circle" class="me-2"></i>Add New Department</a>
					</div>
				</div>
				<!-- /product list -->
				<div class="card table-list-card">
					<div class="card-body pb-0">
						<div class="table-top table-top-new">

							<div class="search-set mb-0">
								<?php
								require_once 'config/config.php'; // Ensure database connection
								
								// Query to count total employees
								$result = $conn->query("SELECT COUNT(*) AS total FROM departments");
								$row = $result->fetch_assoc();
								$totalEmployees = $row['total'];
								?>
								<div class="total-employees">
									<h6><i data-feather="users" class="feather-user"></i>Total departments
										<span><?php echo $totalEmployees; ?></span>
									</h6>
								</div>
								<div class="search-input">
									<a href="" class="btn btn-searchset"><i data-feather="search"
											class="feather-search"></i></a>

								</div>

							</div>
							<div class="search-path d-flex align-items-center search-path-new">
								<div class="d-flex">
									<a class="btn btn-filter" id="filter_search">
										<i data-feather="filter" class="filter-icon"></i>
										<span><img src="assets/img/icons/closes.svg" alt="img"></span>
									</a>
									<a href="department-list.html" class="btn-list active"><i data-feather="list"
											class="feather-user"></i></a>
									<a href="department-grid.html" class="btn-grid"><i data-feather="grid"
											class="feather-user"></i></a>
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
						</div>
						<!-- /Filter -->
						<div class="card" id="filter_inputs">
							<div class="card-body pb-0">
								<div class="row">
									<div class="col-lg-3 col-sm-6 col-12">
										<div class="input-blocks">
											<i data-feather="file-text" class="info-img"></i>
											<select class="select">
												<option>Choose Department</option>
												<option>UI/UX</option>
												<option>HR</option>
												<option>Admin</option>
												<option>Engineering</option>
											</select>
										</div>
									</div>
									<div class="col-lg-3 col-sm-6 col-12">
										<div class="input-blocks">
											<i data-feather="users" class="info-img"></i>
											<select class="select">
												<option>Choose HOD</option>
												<option>Mitchum Daniel</option>
												<option>Susan Lopez</option>
											</select>
										</div>
									</div>
									<div class="col-lg-3 col-sm-6 col-12 ms-auto">
										<div class="input-blocks">
											<a class="btn btn-filters ms-auto"> <i data-feather="search"
													class="feather-search"></i> Search </a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- /Filter -->
						<div class="table-responsive">
						<?php
include_once "./config/config.php";

$sql = "
    SELECT 
        d.id, 
        d.department_name, 
        d.created_on, 
        d.status,
        e.first_name, 
        e.last_name,
        COUNT(emp.id) AS total_members
    FROM departments d
    LEFT JOIN employees e ON d.hod_id = e.id
    LEFT JOIN employees emp ON emp.department_id = d.id
    GROUP BY d.id
";

$result = $conn->query($sql);
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
										<th>Department</th>
										<th>HOD</th>
										<th>Total Members</th>
										<th>Created On</th>
										<th>Status</th>
										<th class="no-sort">Action</th>
									</tr>
								</thead>
								<tbody>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <td>
                    <label class="checkboxs">
                        <input type="checkbox">
                        <span class="checkmarks"></span>
                    </label>
                </td>
                <td><?php echo htmlspecialchars($row['department_name']); ?></td>

                <td><?php echo !empty($row['first_name']) ? htmlspecialchars($row['first_name'] . " " . $row['last_name']) : "Not Set"; ?></td>

                <td><?php echo $row['total_members']; ?></td>

                <td><?php echo date("d M Y", strtotime($row['created_on'])); ?></td>

                <td>
                    <span class="badge <?php echo ($row['status'] == 'active') ? 'badge-linesuccess' : 'badge-linedanger'; ?>">
                        <?php echo ucfirst($row['status']); ?>
                    </span>
                </td>

                <td class="action-table-data">
                    <div class="edit-delete-action">
                        <a class="me-2 p-2" href="javascript:void(0);">
                            <i data-feather="eye" class="feather-eye"></i>
                        </a>
                        <a class="me-2 p-2" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#edit-department">
                            <i data-feather="edit" class="feather-edit"></i>
                        </a>
                        <a class="confirm-text p-2" href="javascript:void(0);">
                            <i data-feather="trash-2" class="feather-trash-2"></i>
                        </a>
                    </div>
                </td>
            </tr>
            <?php
        }
    } else {
        echo "<tr><td colspan='7' class='text-center'>No departments found</td></tr>";
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

	<!-- Add Department -->
	<div class="modal fade" id="add-department">
		<div class="modal-dialog modal-dialog-centered custom-modal-two">
			<div class="modal-content">
				<div class="page-wrapper-new p-0">
					<div class="content">
						<div class="modal-header border-0 custom-modal-header">
							<div class="page-title">
								<h4>Add Department</h4>
							</div>
							<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body custom-modal-body">
						<form action="add_department.php" method="POST">
    <div class="row">
        <!-- Department Name Field -->
        <div class="col-lg-12">
            <div class="mb-3">
                <label class="form-label">Department Name</label>
                <input type="text" class="form-control" name="department_name" required>
            </div>
        </div>

        <!-- HOD Selection Dropdown -->
        <div class="col-lg-12">
            <div class="mb-3">
                <label class="form-label">Select HOD</label>
                <select class="form-control" name="hod_id" required>
                    <option value="">Select HOD</option>
                    <?php
                    include_once "./config/config.php";

                    $query = "SELECT id, CONCAT(first_name, ' ', last_name) AS full_name FROM employees";
                    $result = $conn->query($query);

                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='{$row['id']}'>" . htmlspecialchars($row['full_name']) . "</option>";
                        }
                    } else {
                        echo "<option value=''>No employees found</option>";
                    }

                    $conn->close(); // Close database connection
                    ?>
                </select>
            </div>
        </div>

        <!-- Status Toggle -->
        <div class="mb-0">
            <div class="status-toggle modal-status d-flex justify-content-between align-items-center">
                <span class="status-label">Status</span>
                <input type="checkbox" id="unit_status" class="check" name="status" checked>
                <label for="unit_status" class="checktoggle"></label>
            </div>
        </div>

        <!-- Submit & Cancel Buttons -->
        <div class="modal-footer-btn">
            <button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-submit">Save Changes</button>
        </div>
    </div>
</form>







						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Add Department -->

	<!-- Edit Department -->
	<div class="modal fade" id="edit-department">
		<div class="modal-dialog modal-dialog-centered custom-modal-two">
			<div class="modal-content">
				<div class="page-wrapper-new p-0">
					<div class="content">
						<div class="modal-header border-0 custom-modal-header">
							<div class="page-title">
								<h4>Edit Department</h4>
							</div>
							<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body custom-modal-body">
							<form action="department-list.html">
								<div class="row">
									<div class="col-lg-12">
										<div class="mb-3">
											<label class="form-label">Department Name</label>
											<input type="text" class="form-control" value="UI/UX">
										</div>
									</div>
									<div class="col-lg-12">
										<div class="mb-3">
											<label class="form-label">HOD</label>
											<select class="select">
												<option>Mitchum Daniel</option>
												<option>Susan Lopez</option>
											</select>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="mb-3 summer-description-box">
											<label class="form-label">Description</label>
											<div id="summernote2"></div>
										</div>
									</div>
									<div class="input-blocks m-0">
										<div
											class="status-toggle modal-status d-flex justify-content-between align-items-center">
											<span class="status-label">Status</span>
											<input type="checkbox" id="user3" class="check" checked>
											<label for="user3" class="checktoggle"> </label>
										</div>
									</div>
								</div>
								<div class="modal-footer-btn">
									<button type="button" class="btn btn-cancel me-2"
										data-bs-dismiss="modal">Cancel</button>
									<button type="submit" class="btn btn-submit">Save Changes</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Edit Department -->





	<!-- jQuery -->
	<script src="assets/js/jquery-3.7.1.min.js"></script>

	<!-- Feather Icon JS -->
	<script src="assets/js/feather.min.js"></script>

	<!-- Slimscroll JS -->
	<script src="assets/js/jquery.slimscroll.min.js"></script>

	<!-- Datatable JS -->
	<script src="assets/js/jquery.dataTables.min.js"></script>
	<script src="assets/js/dataTables.bootstrap5.min.js"></script>

	<!-- Bootstrap Core JS -->
	<script src="assets/js/bootstrap.bundle.min.js"></script>

	<!-- Datetimepicker JS -->
	<script src="assets/js/moment.min.js"></script>
	<script src="assets/js/bootstrap-datetimepicker.min.js"></script>

	<!-- Summernote JS -->
	<script src="assets/plugins/summernote/summernote-bs4.min.js"></script>

	<!-- Select2 JS -->
	<script src="assets/plugins/select2/js/select2.min.js"></script>

	<!-- Sweetalert 2 -->
	<script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
	<script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>

	<!-- Custom JS -->
	<script src="assets/js/theme-script.js"></script>
	<script src="assets/js/script.js"></script>

</body>

</html>