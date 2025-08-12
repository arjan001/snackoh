<?php
// Set secure session parameters BEFORE starting the session
ini_set('session.cookie_httponly', 1);
// Only force secure cookies when the request is HTTPS to avoid issues on HTTP hosts
if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
    ini_set('session.cookie_secure', 1);
} else {
    ini_set('session.cookie_secure', 0);
}
ini_set('session.use_strict_mode', 1);

// Start secure session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/error_logger.php'; // Include error logger

// Ensure user is authenticated
if (!isset($_SESSION['user_id'])) {
    ErrorLogger::logSecurityEvent("Unauthorized access attempt", [
        'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
        'url' => $_SERVER['REQUEST_URI'] ?? 'unknown'
    ]);
    // Build login URL relative to current app base path (supports subfolders like /projects/snackoh)
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? '';
    $scriptName = $_SERVER['SCRIPT_NAME'] ?? '/';
    $scriptDir = rtrim(str_replace('\\', '/', dirname($scriptName)), '/');
    $basePath = ($scriptDir === '' || $scriptDir === '/') ? '/' : ($scriptDir . '/');
    $loginPath = $basePath . 'login.php';
    $loginUrl = $host ? ($scheme . '://' . $host . $loginPath) : $loginPath;

    // Try header redirect first
    if (!headers_sent()) {
        header('Location: ' . $loginUrl, true, 302);
        exit();
    }
    // Fallbacks if headers already sent
    echo '<!DOCTYPE html><html><head><meta http-equiv="refresh" content="0;url=' . htmlspecialchars($loginPath, ENT_QUOTES) . '"></head>';
    echo '<body><script>window.location.href = ' . json_encode($loginPath) . ';</script>';
    echo '<a href="' . htmlspecialchars($loginPath, ENT_QUOTES) . '">Continue to Login</a></body></html>';
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

// From here on, we know the user is authenticated; it's safe to load DB
require_once __DIR__ . '/../config/config.php';

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
