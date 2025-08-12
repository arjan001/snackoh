<!DOCTYPE html>
<html lang="en">
<?php 
include_once "./includes/session_check.php"
?>
<?php include "includes/header.php"; ?>

<body>

	<!-- <div id="global-loader" >
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

		<body>



			<div class="page-wrapper">
				<div class="content">
					<div class="page-header">
						<div class="add-item d-flex">
							<div class="page-title">
								<h4>New Employee</h4>
								<h6>Create new Employee</h6>
							</div>
						</div>
						<ul class="table-top-head">
							<li>
								<div class="page-btn">
									<a href="employees.php" class="btn btn-secondary"><i data-feather="arrow-left"
											class="me-2"></i>Back to Employee List</a>
								</div>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse"
									id="collapse-header"><i data-feather="chevron-up"
										class="feather-chevron-up"></i></a>
							</li>
						</ul>
					</div>
					<!-- /product list -->

					<?php
					require_once 'config/config.php'; // Ensure database connection is included
					
					// Fetch Departments
					$departments = $conn->query("SELECT id, department_name FROM departments");

					// Fetch Designations
					$designations = $conn->query("SELECT id, designation_name FROM designation");
					?>
					<form action="insert_employee.php" method='POST' enctype="multipart/form-data">
						<div class="card">
							<div class="card-body">
								<div class="new-employee-field">
									<div class="card-title-head">
										<h6><span><i data-feather="info" class="feather-edit"></i></span>Employee
											Information</h6>
									</div>
									<div class="row">
										<div class="profile-pic-upload">
											<div class="profile-pic">
												<span><i data-feather="plus-circle" class="plus-down-add"></i> Profile
													Photo</span>
											</div>
											<div class="input-blocks mb-0">
												<div class="image-upload mb-0">
													<input type="file" name="profile_photo" required>
													<div class="image-uploads">
														<h4>Upload Image</h4>
													</div>
												</div>
											</div>
										</div>
										
										<div class="row">
											<div class="col-lg-4 col-md-6">
												<div class="mb-3">
													<label class="form-label">First Name</label>
													<input type="text" class="form-control" name='first_name' required>
												</div>
											</div>
											<div class="col-lg-4 col-md-6">
												<div class="mb-3">
													<label class="form-label">Last Name</label>
													<input type="text" class="form-control" name='last_name' required>
												</div>
											</div>
											<div class="col-lg-4 col-md-6">
												<div class="mb-3">
													<label class="form-label">Email</label>
													<input type="email" class="form-control" name='email' required>
												</div>
											</div>
											<div class="col-lg-4 col-md-6">
												<div class="mb-3">
													<label class="form-label">Contact Number</label>
													<input type="text" class="form-control" name='contact_number'
														required>
												</div>
											</div>
											<div class="col-lg-4 col-md-6">
												<div class="mb-3">
													<label class="form-label">Emp Code</label>
													<input type="text" class="form-control" name='emp_code' required>
												</div>
											</div>
											<div class="col-lg-4 col-md-6">
												<div class="input-blocks">
													<label for="dob">Date of Birth</label>
													<div class="input-groupicon">
														<!-- <i data-feather="calendar" class="info-img"></i> -->
														<input type="date" class="form-control" name="dob" id="dob"
															required>
													</div>
												</div>
											</div>

											<div class="col-lg-4 col-md-6">
												<div class="mb-3">
													<label class="form-label">Gender</label>
													<select class="select" name='gender' required>
														<option>Choose Gender</option>
														<option value='Male'>Male</option>
														<option value='Female'>Female</option>
													</select>
												</div>
											</div>
											<div class="col-lg-4 col-md-6">
												<div class="mb-3">
													<label class="form-label">Nationality</label>
													<input type="text" class="form-control" name='nationality' required>
												</div>
											</div>

											<div class="col-lg-4 col-md-6">
												<div class="input-blocks">
													<label for="joining_date">Joining Date</label>
													<div class="input-groupicon">
														<!-- <i data-feather="calendar" class="info-img"></i> -->
														<input type="date" class="form-control" name="joining_date"
															id="joining_date" required>
													</div>
												</div>
											</div>


											<div class="col-lg-4 col-md-6">
												<div class="mb-3">
													<label class="form-label">Department</label>
													<select name="department_id" class="select" required>
														<option value="">Choose</option>
														<?php while ($row = $departments->fetch_assoc()): ?>
															<option value="<?= $row['id'] ?>"><?= $row['department_name'] ?>
															</option>
														<?php endwhile; ?>
													</select>
												</div>
											</div>
											<div class="col-lg-4 col-md-6">
												<div class="mb-3">
													<label class="form-label">Designation</label>
													<select name="designation_id" class="select" required>
														<option value="">Choose</option>
														<?php while ($row = $designations->fetch_assoc()): ?>
															<option value="<?= $row['id'] ?>">
																<?= $row['designation_name'] ?>
															</option>
														<?php endwhile; ?>
													</select>
												</div>
											</div>
											<div class="col-lg-4 col-md-6">
												<div class="mb-3">
													<label class="form-label">Blood Group</label>
													<select class="select" name='blood_group' required>
														<option>Choose blood group</option>
														<option value='A+'>A+</option>
														<option value='A-'>A-</option>
														<option value='B+'>B+</option>
														<option value='B'>B-</option>
														<option value='O+'>O+</option>
														<option value='O'>O-</option>
														<option value='AB+'>AB+</option>
														<option value='AB-'>AB-</option>
													</select>
												</div>
											</div>

										</div>
									</div>
									<div class="other-info">
										<div class="card-title-head">
											<h6><span><i data-feather="info" class="feather-edit"></i></span>Other
												Information</h6>
										</div>
										<div class="row">
											<div class="col-lg-4 col-md-6">
												<div class="mb-3">
													<label class="form-label">Emergency No 1</label>
													<input type="text" class="form-control" name='emergency_no_1'
														required>
												</div>
											</div>
											<div class="col-lg-4 col-md-6">
												<div class="mb-3">
													<label class="form-label">Emergency No 2</label>
													<input type="text" class="form-control" name="emergency_no_2"
														required>
												</div>
											</div>
											<div class="col-lg-4 col-md-6">
												<div class="mb-3">
													<label class="form-label">KRA PIN</label>
													<input type="text" class="form-control" name='kra_pin' required>
												</div>
											</div>
											<div class="col-lg-4 col-md-6">
												<div class="mb-3">
													<label class="form-label ">National Id Upload</label>

													<input class="form-control" type="file" name='national_id' required>

												</div>
											</div>

											<div class="col-lg-4 col-md-6">
												<div class="mb-3">
													<label class="form-label">Address</label>
													<input type="text" class="form-control" name="address" required>
												</div>
											</div>
											<div class="col-lg-4 col-md-6">
												<div class="mb-3">
													<label class="form-label">Country</label>
													<input type="text" class="form-control" name='country' required>
												</div>
											</div>
											<div class="col-lg-4 col-md-6">
												<div class="mb-3">
													<label class="form-label">Location address</label>
													<input type="text" class="form-control" name="physical_address"
														required>
												</div>
											</div>
											<div class="col-lg-4 col-md-6">
												<div class="mb-3">
													<label class="form-label">City</label>
													<input type="text" class="form-control" name='city' required>
												</div>
											</div>
											<div class="col-lg-4 col-md-6">
												<div class="mb-3">
													<label class="form-label">Zipcode</label>
													<input type="text" class="form-control" name='zipcode' required>
												</div>
											</div>
										</div>
									</div>
									<!-- <div class="pass-info">
										<div class="card-title-head">
											<h6><span><i data-feather="info" class="feather-edit"></i></span>Password
											</h6>
										</div>
										<div class="row">
											<div class="col-lg-4 col-md-6">
												<div class="input-blocks mb-md-0 mb-sm-3">
													<label>Password</label>
													<div class="pass-group">
														<input type="password" class="pass-input" name="password_hash"
															required>
														<span class="fas toggle-password fa-eye-slash"></span>
													</div>
												</div>
											</div>
											<div class="col-lg-4 col-md-6">
												<div class="input-blocks mb-0">
													<label>Confirm Password</label>
													<div class="pass-group">
														<input type="password" class="pass-inputa"
															name="confirm_password" required>
														<span class="fas toggle-passworda fa-eye-slash"></span>
													</div>
												</div>
											</div>
											<div class="col-lg-4 col-md-6">
											<div class="mb-0">
                                <div class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                    <span class="status-label">Employee Status</span>
                                    <input type="checkbox" id="unit_status" class="check" name="employee_status" checked>
                                    <label for="unit_status" class="checktoggle"></label>
                                </div>
                            </div>
											</div>

											
										</div>
									</div> -->
								</div>
							</div>
						</div>
						<!-- /product list -->

						<div class="text-end mb-3">
							<button type="button" class="btn btn-cancel me-2">Cancel</button>
							<button type="submit" class="btn btn-submit">Save User</button>
						</div>
					</form>
				</div>
			</div>
	</div>
	<!-- /Main Wrapper -->




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