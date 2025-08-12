<!DOCTYPE html>
<html lang="en">
	
<?php
include_once "./includes/session_check.php" ;
include "includes/header.php"; ?>

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
								<h4>Edit Employee</h4>
								<h6>edit your company employee</h6>
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
require_once 'config/config.php'; // Database connection

// Get Employee ID from URL
$employee_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch employee data
$employee = $conn->query("SELECT * FROM employees WHERE id = $employee_id")->fetch_assoc();

// Fetch Departments
$departments = $conn->query("SELECT id, department_name FROM departments");

// Fetch Designations
$designations = $conn->query("SELECT id, designation_name FROM designation");
?>
					<form action="update_employee.php" method='POST' enctype="multipart/form-data">
					<input type="hidden" name="employee_id" value="<?= $employee_id ?>">

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
        <?php if (!empty($employee['profile_photo'])): ?>
            <img src="<?= htmlspecialchars($employee['profile_photo']) ?>" 
                 alt="Profile Photo" 
                 style="object-fit: cover; width: 100px; height: 100px; border-radius: 50%;">
        <?php else: ?>
            <span><i data-feather="plus-circle" class="plus-down-add"></i> Profile Photo</span>
        <?php endif; ?>
    </div>

    <div class="input-blocks mb-0">
        <div class="image-upload mb-0">
            <input type="file" name="profile_photo" accept="image/*">
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
												<input type="text" class="form-control" name='first_name'value="<?= htmlspecialchars($employee['first_name']) ?>" required>
											</div>
										</div>
										<div class="col-lg-4 col-md-6">
											<div class="mb-3">
												<label class="form-label">Last Name</label>
												<input type="text" class="form-control" name='last_name'value="<?= htmlspecialchars($employee['last_name']) ?>" required>
											</div>
										</div>
										<div class="col-lg-4 col-md-6">
											<div class="mb-3">
												<label class="form-label">Email</label>
												<input type="email" class="form-control" name='email'value="<?= htmlspecialchars($employee['email']) ?>" required>
											</div>
										</div>
										<div class="col-lg-4 col-md-6">
											<div class="mb-3">
												<label class="form-label">Contact Number</label>
												<input type="text" class="form-control" name='contact_number'value="<?= htmlspecialchars($employee['contact_number']) ?>" required>
											</div>
										</div>
										<div class="col-lg-4 col-md-6">
											<div class="mb-3">
												<label class="form-label">Emp Code</label>
												<input type="text" class="form-control" name='emp_code'value="<?= htmlspecialchars($employee['emp_code']) ?>" required>
											</div>
										</div>
										<div class="col-lg-4 col-md-6">
											<div class="input-blocks">
												<label>Date of Birth</label>

												<div class="input-groupicon calender-input">
													<i data-feather="calendar" class="info-img"></i>
													<input type="text" class="datetimepicker form-control"
														placeholder="Select Date" name='dob'value="<?= htmlspecialchars($employee['dob']) ?>" required>
												</div>
											</div>
										</div>
										<div class="col-lg-4 col-md-6">
											<div class="mb-3">
												<label class="form-label">Gender</label>
												<select class="select" name="gender" required>
            <option value="">Choose Gender</option>
            <option value="Male" <?= (isset($employee['gender']) && $employee['gender'] == 'Male') ? 'selected' : '' ?>>Male</option>
            <option value="Female" <?= (isset($employee['gender']) && $employee['gender'] == 'Female') ? 'selected' : '' ?>>Female</option>
        </select>
											</div>
										</div>
										<div class="col-lg-4 col-md-6">
											<div class="mb-3">
												<label class="form-label">Nationality</label>
												<input type="text" class="form-control" name='nationality'value="<?= htmlspecialchars($employee['nationality']) ?>" required>
											</div>
										</div>
									
									<div class="col-lg-4 col-md-6">
										<div class="input-blocks">
											<label>Joining Date</label>
											<div class="input-groupicon calender-input">
												<i data-feather="calendar" class="info-img"></i>
												<input type="text" class="datetimepicker form-control"
													placeholder="Select Date" name="joining_date"value="<?= htmlspecialchars($employee['joining_date']) ?>" required>
											</div>
										</div>
									</div>
									
									<div class="col-lg-4 col-md-6">
										<div class="mb-3">
											<label class="form-label">Department</label>
											<select name="department_id" class="select" required>
    <option value="">Choose</option>
    <?php while ($row = $departments->fetch_assoc()): ?>
        <option value="<?= $row['id'] ?>" <?= ($row['id'] == $employee['department_id']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($row['department_name']) ?>
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
        <option value="<?= $row['id'] ?>" <?= ($row['id'] == $employee['designation_id']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($row['designation_name']) ?>
        </option>
    <?php endwhile; ?>
</select>
										</div>
									</div>
									<div class="col-lg-4 col-md-6">
										<div class="mb-3">
											<label class="form-label">Blood Group</label>
											<select class="select" name='blood_group'required>
											<option value="">Choose blood group</option>
    <option value="A+" <?= ($employee['blood_group'] == 'A+') ? 'selected' : '' ?>>A+</option>
    <option value="A-" <?= ($employee['blood_group'] == 'A-') ? 'selected' : '' ?>>A-</option>
    <option value="B+" <?= ($employee['blood_group'] == 'B+') ? 'selected' : '' ?>>B+</option>
    <option value="B-" <?= ($employee['blood_group'] == 'B-') ? 'selected' : '' ?>>B-</option>
    <option value="O+" <?= ($employee['blood_group'] == 'O+') ? 'selected' : '' ?>>O+</option>
    <option value="O-" <?= ($employee['blood_group'] == 'O-') ? 'selected' : '' ?>>O-</option>
    <option value="AB+" <?= ($employee['blood_group'] == 'AB+') ? 'selected' : '' ?>>AB+</option>
    <option value="AB-" <?= ($employee['blood_group'] == 'AB-') ? 'selected' : '' ?>>AB-</option>
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
												<input type="text" class="form-control" name='emergency_no_1'value="<?= htmlspecialchars($employee['emergency_no_1']) ?>" required>
											</div>
										</div>
										<div class="col-lg-4 col-md-6">
											<div class="mb-3">
												<label class="form-label">Emergency No 2</label>
												<input type="text" class="form-control" name="emergency_no_2"value="<?= htmlspecialchars($employee['emergency_no_1']) ?>" required>
											</div>
										</div>
										<div class="col-lg-4 col-md-6">
											<div class="mb-3">
												<label class="form-label">KRA PIN</label>
												<input type="text" class="form-control" name='kra_pin'value="<?= htmlspecialchars($employee['kra_pin']) ?>" required>
											</div>
										</div>
										<div class="col-lg-4 col-md-6">
											<div class="mb-3">
												<label class="form-label ">National Id Upload</label>

												<input class="form-control" type="file" name='national_id'value="<?= htmlspecialchars($employee['national_id']) ?>" required>

											</div>
										</div>

										<div class="col-lg-4 col-md-6">
											<div class="mb-3">
												<label class="form-label">Address</label>
												<input type="text" class="form-control" name="address"value="<?= htmlspecialchars($employee['address']) ?>" required>
											</div>
										</div>
										<div class="col-lg-4 col-md-6">
											<div class="mb-3">
												<label class="form-label">Country</label>
												<input type="text" class="form-control" name='country'value="<?= htmlspecialchars($employee['country']) ?>" required>
											</div>
										</div>
										<div class="col-lg-4 col-md-6">
											<div class="mb-3">
												<label class="form-label">Location address</label>
												<input type="text" class="form-control" name="physical_address"value="<?= htmlspecialchars($employee['physical_address']) ?>" required>
											</div>
										</div>
										<div class="col-lg-4 col-md-6">
											<div class="mb-3">
												<label class="form-label">City</label>
												<input type="text" class="form-control" name='city'value="<?= htmlspecialchars($employee['city']) ?>" required>
											</div>
										</div>
										<div class="col-lg-4 col-md-6">
											<div class="mb-3">
												<label class="form-label">Zipcode</label>
												<input type="text" class="form-control" name='zipcode'value="<?= htmlspecialchars($employee['zipcode']) ?>" required>
											</div>
										</div>

										<div class="col-lg-4 col-md-6">
										<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
    <span class="status-label">EMPLOYEE STATUS</span>
    <input type="checkbox" id="user3" class="check" name="employee_status"
        value="1" <?= (isset($employee['employee_status']) && $employee['employee_status'] == 1) ? 'checked' : '' ?> required>
    <label for="user3" class="checktoggle"></label>
</div>

									</div>
									</div>
								</div>
								<!-- <div class="pass-info">
									<div class="card-title-head">
										<h6><span><i data-feather="info" class="feather-edit"></i></span>Password</h6>
									</div>
									<div class="row">
										<div class="col-lg-4 col-md-6">
											<div class="input-blocks mb-md-0 mb-sm-3">
												<label>Password</label>
												<div class="pass-group">
													<input type="password" class="pass-input" name="password_hash"required>
													<span class="fas toggle-password fa-eye-slash"></span>
												</div>
											</div>
										</div>
										<div class="col-lg-4 col-md-6">
											<div class="input-blocks mb-0">
												<label>Confirm Password</label>
												<div class="pass-group">
													<input type="password" class="pass-inputa" name="confirm_password"required>
													<span class="fas toggle-passworda fa-eye-slash"></span>
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

	<!-- populate image on the form.. -->

	<script>
document.querySelector('input[name="profile_photo"]').addEventListener('change', function(event) {
    let reader = new FileReader();
    reader.onload = function(e) {
        document.querySelector('.profile-pic').innerHTML = `<img src="${e.target.result}" 
            style="object-fit: cover; width: 100px; height: 100px; border-radius: 50%;">`;
    };
    reader.readAsDataURL(event.target.files[0]);
});
</script>


</body>

</html>