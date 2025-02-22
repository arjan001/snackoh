<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="POS - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">
        <title>Login - Pos admin template</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
        <!-- Fontawesome CSS -->
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
		
    </head>
    <body class="account-page">

        <div id="global-loader" >
			<div class="whirly-loader"> </div>
		</div>
	
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			<div class="account-content">
				<div class="login-wrapper login-new">
                    <div class="login-content user-login">
                        <div class="login-logo">
                            <img src="assets/img/logo.png" alt="img">
                            <a href="index.html" class="login-logo logo-white">
                                <img src="assets/img/logo-white.png"  alt="">
                            </a>
                        </div>

                        <?php
require 'config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $new_password = $_POST['password'];

    if (!empty($token) && !empty($new_password)) {
        // Check if the token is valid
        $stmt = $conn->prepare("SELECT id FROM employees WHERE reset_token = ? AND reset_expires > NOW()");
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($user_id);
            $stmt->fetch();
            $stmt->close();

            // Hash new password
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Update the user's password
            $stmt = $conn->prepare("UPDATE employees SET password_hash = ?, reset_token = NULL, reset_expires = NULL WHERE id = ?");
            $stmt->bind_param("si", $hashed_password, $user_id);
            $stmt->execute();

            echo "<script>alert('Password reset successfully! You can now log in.'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Invalid or expired token.'); window.location.href='forgot_password.php';</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Please enter a new password.');</script>";
    }
} elseif (isset($_GET['token'])) {
    $token = $_GET['token'];
} else {
    echo "<script>alert('Invalid request.'); window.location.href='login.php';</script>";
    exit();
}
?>



                        <form action="success-3.html">
                        <input type="hidden" name="token" value="<?= htmlspecialchars($token); ?>">
                            <div class="login-userset">
                                <div class="login-userheading">
                                    <h3>Reset password?</h3>
                                    <h4>Enter New Password & Confirm Password to get inside</h4>
                                </div>

                                <div class="form-login">
                                    <label>New Password</label>
                                    <div class="pass-group">
                                        <input type="password" class="pass-inputa">
                                        <span class="fas toggle-passworda fa-eye-slash"></span>
                                    </div>
                                </div>
                                <div class="form-login">
                                    <label> New Confirm Passworrd</label>
                                    <div class="pass-group">
                                        <input type="password" class="pass-inputs">
                                        <span class="fas toggle-passwords fa-eye-slash"></span>
                                    </div>
                                </div>
                                <div class="form-login">
                                    <button type="submit" class="btn btn-login">Change Password</button>
                                </div>
                                <div class="signinform text-center">
                                    <h4>Return to <a href="signin-3.html" class="hover-a"> login </a></h4>
                                </div>
                            </div>
                        </form>
                       
                    </div>
                    <div class="my-4 d-flex justify-content-center align-items-center copyright-text">
                        <p>Copyright &copy; 2023 DreamsPOS. All rights reserved</p>
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