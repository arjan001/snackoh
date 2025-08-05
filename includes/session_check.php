<?php
// Set secure session parameters BEFORE starting the session
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.use_strict_mode', 1);

// Start secure session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "./config/config.php"; // Include database connection
require_once "./includes/error_logger.php"; // Include error logger

// Ensure user is authenticated
if (!isset($_SESSION['user_id'])) {
    ErrorLogger::logSecurityEvent("Unauthorized access attempt", [
        'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
        'url' => $_SERVER['REQUEST_URI'] ?? 'unknown'
    ]);
    header("Location: login.php"); // Redirect to login if not authenticated
    exit();
}

// Validate session timeout (30 minutes)
$session_timeout = 1800; // 30 minutes
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $session_timeout)) {
    ErrorLogger::logAuthEvent("Session timeout", $_SESSION['user_id'] ?? 'unknown', false);
    session_unset();
    session_destroy();
    header("Location: login.php?timeout=1");
    exit();
}

// Update last activity
$_SESSION['last_activity'] = time();

// Ensure employee_id is available
if (!isset($_SESSION['employee_id'])) {
    $stmt = $conn->prepare("SELECT id FROM employees WHERE id = ?");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $stmt->bind_result($employee_id);
    
    if ($stmt->fetch()) {
        $_SESSION['employee_id'] = $employee_id;
    } else {
        ErrorLogger::logSecurityEvent("Employee record not found", [
            'user_id' => $_SESSION['user_id'] ?? 'unknown'
        ]);
        die("Error: Employee record not found.");
    }

    $stmt->close();
}
?>
