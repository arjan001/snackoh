<?php
session_start();
require 'config/config.php'; // Include database and session handling

// Initialize error message variable
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($email) && !empty($password)) {
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
                // Store user data in session
                $_SESSION['user_id'] = $id;
                $_SESSION['email'] = $email;
                $_SESSION['first_name'] = $first_name;
                $_SESSION['last_name'] = $last_name;
                $_SESSION['full_name'] = $first_name . " " . $last_name;
                $_SESSION['user_role'] = $role_name; // Store actual role name

                header("Location: index.php"); // Redirect to dashboard
                exit();
            } else {
                $error = "Invalid password.";
            }
        } else {
            $error = "No account found with that email.";
        }
        $stmt->close();
    } else {
        $error = "Please fill in both fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'includes/header.php'; ?>
<body class="account-page">
    <div class="main-wrapper">
        <div class="account-content">
            <div class="login-wrapper">
                <div class="login-content">
                    <form action="login.php" method="POST">
                        <div class="login-userset">
                            <div class="login-logo logo-normal">
                                <img src="assets/img/logo1.jpg" alt="img">
                            </div>
                            <div class="login-userheading">
                                <h3>Sign In</h3>
                                <h4>Access the SnackOH panel using your email and passcode.</h4>
                            </div>
                            <?php if (!empty($error)) { ?>
                                <p style="color: red; text-align: center;"><?php echo $error; ?></p>
                            <?php } ?>
                            <div class="form-login">
                                <label>Email Address</label>
                                <div class="form-addons">
                                    <input type="text" class="form-control" name="email" required>
                                    <img src="assets/img/icons/mail.svg" alt="img">
                                </div>
                            </div>
                            <div class="form-login">
                                <label>Password</label>
                                <div class="pass-group">
                                    <input type="password" class="pass-input" name="password" required>
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                </div>
                            </div>
                            <div class="form-login">
                                <button type="submit" class="btn btn-login">Sign In</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="login-img">
                    <img src="assets/img/authentication/login02.png" alt="img">
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/feather.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/theme-script.js"></script>	
    <script src="assets/js/script.js"></script>
</body>
</html>
