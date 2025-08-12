<!DOCTYPE html>
<html lang="en">
<?php include_once "./includes/session_check.php" ?>
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
							<h4>Employees</h4>
							<h6>Manage your employees</h6>
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
						<a href="add-employee.php" class="btn btn-added"><i data-feather="plus-circle"
								class="me-2"></i>Add New Employee</a>
					</div>
				</div>
				<!-- /product list -->
				<div class="card">
					<div class="card-body pb-0">
						<div class="table-top table-top-two table-top-new">

							<div class="search-set mb-0">
								<?php
								require_once 'config/config.php'; // Ensure database connection
								
								// Query to count total employees
								$result = $conn->query("SELECT COUNT(*) AS total FROM employees");
								$row = $result->fetch_assoc();
								$totalEmployees = $row['total'];
								?>

								<div class="total-employees">
									<h6><i data-feather="users" class="feather-user"></i>Total Employees
										<span><?php echo $totalEmployees; ?></span>
									</h6>
								</div>

								<div class="search-input">
									<a href="" class="btn btn-searchset"><i data-feather="search"
											class="feather-search"></i></a>
									<input type="search" class="form-control">
								</div>

							</div>
							<div class="search-path d-flex align-items-center search-path-new">
								<div class="d-flex">
									<a class="btn btn-filter" id="filter_search">
										<i data-feather="filter" class="filter-icon"></i>
										<span><img src="assets/img/icons/closes.svg" alt="img"></span>
									</a>
									<a href="employees-list.html" class="btn-list"><i data-feather="list"
											class="feather-user"></i></a>
									<a href="employees-grid.html" class="btn-grid active"><i data-feather="grid"
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
											<i data-feather="user" class="info-img"></i>
											<select class="select">
												<option>Choose Name</option>
												<option>Mitchum Daniel</option>
												<option>Susan Lopez</option>
												<option>Robert Grossman</option>
												<option>Janet Hembre</option>
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

					</div>
				</div>
				<!-- /product list -->


				<div class="employee-grid-widget">
					<?php
					// Database connection
					include_once "./config/config.php";

					// Fetch users with department and designation names
					$sql = "SELECT u.id, u.first_name, u.last_name, u.email, u.contact_number, u.emp_code, u.dob, u.gender, 
        u.nationality, u.joining_date, u.blood_group, u.emergency_no_1, u.emergency_no_2, 
        u.kra_pin, u.national_id, u.profile_photo, u.address, u.country, u.physical_address, 
        u.city, u.zipcode, d.department_name, des.designation_name, u.employee_status
        FROM employees u
        LEFT JOIN departments d ON u.department_id = d.id
        LEFT JOIN designation des ON u.designation_id = des.id";

					$result = $conn->query($sql);
					?>

					<div class="row">
						<?php while ($row = $result->fetch_assoc()): ?>
							<div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6">
								<div class="employee-grid-profile">
									<div class="profile-head">
										<label class="checkboxs">
											<input type="checkbox">
											<span class="checkmarks"></span>
										</label>
										<div class="profile-head-action">
										<span class="badge <?= $row['employee_status'] ? 'badge-linesuccess' : 'badge-linedanger' ?> text-center w-auto me-1">
    <?= $row['employee_status'] ? 'Active' : 'Inactive' ?>
</span>

											<div class="dropdown profile-action">
												<a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
													aria-expanded="false">
													<i data-feather="more-vertical" class="feather-user"></i>
												</a>
												<ul class="dropdown-menu">
													<li><a href="edit-employee.php?id=<?= $row['id'] ?>"
															class="dropdown-item"><i data-feather="edit"
																class="info-img"></i>Edit</a></li>
													<li><a href="delete-employee.php?id=<?= $row['id'] ?>"
															class="dropdown-item confirm-text mb-0"><i
																data-feather="trash-2" class="info-img"></i>Delete</a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="profile-info">
									<div class="profile-pic active-profile">
    <img src="<?= !empty($row['profile_photo']) ? htmlspecialchars($row['profile_photo']) : 'assets/img/users/default.jpg'; ?>" 
         alt="Profile Photo" 
         style="object-fit: cover;">
</div>

										<h5>EMPLOYEE CODE : <?= $row['emp_code'] ?></h5>
										<h4><?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></h4>
										<span><?= htmlspecialchars($row['designation_name'] ?? 'Not Assigned') ?></span>
									</div>
									<ul class="department">
										<li>Joined <span>
												<?= (!empty($row['joining_date']) && $row['joining_date'] != '0000-00-00')
													? date("d M Y", strtotime($row['joining_date']))
													: 'Not Set'; ?>
											</span></li>

										<li>Department
											<span><?= htmlspecialchars($row['department_name'] ?? 'Not Assigned') ?></span>
										</li>
									</ul>
								</div>
							</div>
						<?php endwhile; ?>
					</div>

					<?php $conn->close(); ?>
				</div>
				<div class="container-fluid">
					<div class="row custom-pagination">
						<div class="col-md-12">
							<div class="paginations d-flex justify-content-end mb-3">
								<span><i class="fas fa-chevron-left"></i></span>
								<ul class="d-flex align-items-center page-wrap">
									<li>
										<a href="javascript:void(0);" class="active">
											1
										</a>
									</li>
									<li>
										<a href="javascript:void(0);">
											2
										</a>
									</li>
									<li>
										<a href="javascript:void(0);">
											3
										</a>
									</li>
									<li>
										<a href="javascript:void(0);">
											4
										</a>
									</li>
								</ul>
								<span><i class="fas fa-chevron-right"></i></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Main Wrapper -->




	
	<?php include "includes/footer.php"; ?>
</body>

</html>