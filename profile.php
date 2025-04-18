<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php";?>

<?php

include "config/config.php"; // Ensure this file connects to your database

include_once "./includes/session_check.php" ;

$user_id = isset($_GET['id']) ? intval($_GET['id']) : $_SESSION['user_id'];

// Handle Profile Update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_profile'])) {
    $profile_photo = trim($_POST['profile_photo']);
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['contact_number']);
    $password = trim($_POST['password']);

    // Fetch current password from database
    $query = "SELECT password_hash FROM employees WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($current_password);
    $stmt->fetch();
    $stmt->close();

    // If user entered a new password, hash it
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    } else {
        $hashed_password = $current_password; // Keep existing password
    }

    // Update user data
    $query = "UPDATE employees SET first_name=?, last_name=?, email=?, contact_number=?, password_hash=? WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssi", $first_name, $last_name, $email, $phone, $hashed_password, $user_id);
    
    if ($stmt->execute()) {
        $_SESSION['success'] = "Profile updated successfully!";
        header("Location: profile.php?id=$user_id"); // Prevent resubmission
        exit();
    } else {
        $_SESSION['error'] = "Something went wrong. Please try again.";
    }
}

// Fetch user details
$query = "SELECT * FROM employees WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>
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
						<div class="page-title">
							<h4>Profile</h4>
							<h6>User Profile</h6>
						</div>
					</div>
					<!-- /product list -->
					<div class="card">
						<div class="card-body">
							<div class="profile-set">
								<div class="profile-head">

								

								</div>

 					 	<form method="POST" action="profile.php">
                                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
								<div class="profile-top">
									<div class="profile-content">
										<div class="profile-contentimg">
										<img src="<?= !empty($profile_photo['profile_photo']) ? htmlspecialchars($profile_photo['profile_photo']) : 'assets/img/users/default.jpg'; ?>" 
         alt="Profile Photo" 
         style="object-fit: cover;" id="blah">
											<div class="profileupload">
												<input type="file" id="imgInp">
												<a href="javascript:void(0);" ><img src="assets/img/icons/edit-set.svg"  alt="img"></a>
											</div>
										</div>
										<div class="profile-contentname">
											<h2><?= htmlspecialchars($full_name); ?></h2>
											<h4>Updates Your Photo and Personal Details.</h4>
										</div>
									</div>
									
								</div>
							</div>

							<div class="row">
								<div class="col-lg-6 col-sm-12">
									<div class="input-blocks">
										<label class="form-label">First Name</label>
										<input type="text"  name="first_name" class="form-control" value="<?php echo htmlspecialchars($user['first_name']); ?>">
									</div>
								</div>
								<div class="col-lg-6 col-sm-12">
									<div class="input-blocks">
										<label class="form-label">Last Name</label>
										<input type="text"  name="last_name" class="form-control" value="<?php echo htmlspecialchars($user['last_name']); ?>">
									</div>
								</div>
								<div class="col-lg-6 col-sm-12">
									<div class="input-blocks">
										<label>Email</label>
										<input type="email"   name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>">
									</div>
								</div>
								<div class="col-lg-6 col-sm-12">
									<div class="input-blocks">
										<label class="form-label">Phone</label>
										<input type="text" class="form-control"  name="contact_number" value="<?php echo htmlspecialchars($user['contact_number']); ?>">
									</div>
								</div>
								<div class="col-lg-6 col-sm-12">
									<!-- <div class="input-blocks">
										<label class="form-label">User Name</label>
										<input type="text" class="form-control" value="George Castilo">
									</div> -->
								</div>
								<div class="col-lg-6 col-sm-12">
									<div class="input-blocks">
										<label class="form-label">Password</label>
										<div class="pass-group">
											<input type="password" name="password" class="pass-input form-control">
											<span class="fas toggle-password fa-eye-slash"></span>
										</div>
									</div>
								</div>
								<div class="col-12">
								<button type="button" class="btn btn-cancel me-2"
										data-bs-dismiss="modal">Cancel</button>
									<button type="submit" name="update_profile" class="btn btn-submit">Submit</button>
								</div>
							</div>
							</form>

						</div>
					</div>
					<!-- /product list -->
				</div>
			</div>
        </div>

		
		<!-- /Main Wrapper -->
  

		 
		<?php include "includes/footer.php";?>
    </body>
</html>