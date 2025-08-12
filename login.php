<?php
session_start();
require __DIR__ . '/config/config.php'; // Include database and session handling
require_once __DIR__ . '/includes/error_logger.php'; // Include error logger

// Initialize error message variable
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (!empty($email) && !empty($password)) {
        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email format.";
            ErrorLogger::logAuthEvent("Invalid email format", $email, false);
        } else {
            // Join employees and roles tables to get the role_name instead of role_id
            $stmt = $conn->prepare("
                SELECT e.id, e.first_name, e.last_name, r.role_name, e.password_hash 
                FROM employees e 
                LEFT JOIN roles r ON e.user_role = r.id
                WHERE e.email = ?
            ");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id, $first_name, $last_name, $role_name, $hashed_password);
                $stmt->fetch();

                if (password_verify($password, $hashed_password)) {
                    // Regenerate session ID for security
                    session_regenerate_id(true);
                    
                    // Store user data in session
                    $_SESSION['user_id'] = $id;
                    $_SESSION['employee_id'] = $id; // Store employee ID
                    $_SESSION['email'] = $email;
                    $_SESSION['first_name'] = $first_name;
                    $_SESSION['last_name'] = $last_name;
                    $_SESSION['full_name'] = $first_name . " " . $last_name;
                    $_SESSION['user_role'] = $role_name; // Store actual role name
                    $_SESSION['last_activity'] = time(); // Set last activity time

                    ErrorLogger::logAuthEvent("Successful login", $email, true);
                    header("Location: index.php"); // Redirect to dashboard
                    exit();
                } else {
                    $error = "Invalid password.";
                    ErrorLogger::logAuthEvent("Invalid password", $email, false);
                }
            } else {
                $error = "No account found with that email.";
                ErrorLogger::logAuthEvent("Account not found", $email, false);
            }
            $stmt->close();
        }
    } else {
        $error = "Please fill in both fields.";
        ErrorLogger::logAuthEvent("Empty login fields", 'unknown', false);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include 'includes/header.php'; ?>
    <body class="account-page">

        <div id="global-loader" >
			<div class="whirly-loader"> </div>
		</div>
	
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			<div class="account-content">
				<div class="login-wrapper login-new">
                    <div class="container">
                        <div class="login-content user-login">
                            <div class="login-logo">
                                <img src="assets/img/logo.png" alt="img">
                                <a href="index.html" class="login-logo logo-white">
                                    <img src="assets/img/logo-white.png"  alt="">
                                </a>
                            </div>
                            <form action="login.php" method="POST">
                                <div class="login-userset">
                                    <div class="login-userheading">
                                        <h3>Sign In</h3>
                                        <h4>Access the SnackOH panel using your email and passcode.</h4>
                                    </div>
                                    <?php if (!empty($error)) { ?>
                                <p style="color: red; text-align: center;"><?php echo $error; ?></p>
                            <?php } ?>
                                    <div class="form-login">
                                        <label class="form-label">Email Address</label>
                                        <div class="form-addons">
                                            <input type="email" class="form-control" name="email" required>
                                            <img src="assets/img/icons/mail.svg" alt="img">
                                        </div>
                                    </div>
                                    <div class="form-login">
                                        <label>Password</label>
                                        <div class="pass-group">
                                            <input type="password" class="pass-input"name="password" required>
                                            <span class="fas toggle-password fa-eye-slash"></span>
                                        </div>
                                    </div>
                                    <div class="form-login authentication-check">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="custom-control custom-checkbox">
                                                    <label class="checkboxs ps-4 mb-0 pb-0 line-height-1">
                                                        <input type="checkbox">
                                                        <span class="checkmarks"></span>Remember me
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-6 text-end">
                                                <a class="forgot-link" href="forgot-password.php">Forgot Password?</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-login">
                                        <button class="btn btn-login" type="submit">Sign In</button>
                                    </div>
                                    <!-- <div class="signinform">
                                        <h4>New on our platform?<a href="register-3.html" class="hover-a"> Create an account</a></h4>
                                    </div> -->
                                    <div class="form-setlogin or-text">
                                        <h4>OR</h4>
                                    </div>
                                    <div class="form-sociallink">
                                        <ul class="d-flex">
                                            <li>
                                                <a href="javascript:void(0);" class="facebook-logo">
                                                    <img src="assets/img/icons/facebook-logo.svg" alt="Facebook">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">
                                                    <img src="assets/img/icons/google.png" alt="Google">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="apple-logo">
                                                    <img src="assets/img/icons/apple-logo.svg" alt="Apple">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </form>
                           
                        </div>
                        <div class="my-4 d-flex justify-content-center align-items-center copyright-text">
                            <p>Copyright &copy; 2025 SNACK-OH. All rights reserved</p>
                        </div>
                    </div>
                </div>
			</div>
        </div>
		<!-- /Main Wrapper -->
  

		<!-- jQuery -->
        <script src="assets/js/jquery-3.7.1.min.js"></script>

         <!-- Feather Icon JS -->
		<script src="assets/js/feather.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="assets/js/bootstrap.bundle.min.js"></script>
		
		<!-- Custom JS --><script src="assets/js/theme-script.js"></script>	
		<script src="assets/js/script.js"></script>

	
    </body>
</html>