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

                            <?php
require 'config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);

    if (!empty($email)) {
        // Check if email exists in the database
        $stmt = $conn->prepare("SELECT id FROM employees WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Generate a secure random token
            $token = bin2hex(random_bytes(32));
            $expires = date("Y-m-d H:i:s", strtotime("+1 hour")); // Token expires in 1 hour

            // Store the token in the database
            $stmt = $conn->prepare("UPDATE employees SET reset_token = ?, reset_expires = ? WHERE email = ?");
            $stmt->bind_param("sss", $token, $expires, $email);
            $stmt->execute();

            // Send reset email
            $reset_link = "http://yourwebsite.com/reset_password.php?token=" . $token;
            $subject = "Password Reset Request";
            $message = "Click the link below to reset your password:\n\n" . $reset_link;
            $headers = "From: no-reply@yourwebsite.com";

            if (mail($email, $subject, $message, $headers)) {
                echo "<script>alert('Password reset link sent! Check your email.');</script>";
            } else {
                echo "<script>alert('Failed to send email. Try again later.');</script>";
            }
        } else {
            echo "<script>alert('No account found with that email.');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Please enter your email.');</script>";
    }
}
?>



                            <form action=""method="POST">
                                <div class="login-userset">
                                    <div class="login-userheading">
                                        <h3>Forgot password?</h3>
                                        <h4>If you forgot your password, well, then we’ll email you instructions to reset your password.</h4>
                                    </div>
                                    <div class="form-login">
                                        <label>Email</label>
                                        <div class="form-addons">
                                            <input type="email" class="form-control">
                                            <img src="assets/img/icons/mail.svg" alt="img">
                                        </div>
                                    </div>
                                    <div class="form-login">
                                        <button type="submit" class="btn btn-login">Sign Up</button>
                                    </div>
                                    <div class="signinform text-center">
                                        <h4>Return to<a href="login.php" class="hover-a"> login </a></h4>
                                    </div>
                                    <div class="form-setlogin or-text">
                                        <h4>OR</h4>
                                    </div>
                                    <div class="form-sociallink">
                                        <ul class="d-flex justify-content-center">
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
                            <p>Copyright &copy; 2025  SNACK-OH ERP. All rights reserved</p>
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