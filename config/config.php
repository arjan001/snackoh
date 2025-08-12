<?php // Database connection with production-friendly error reporting
// Enable verbose errors when explicitly allowed via env or query (?debug=1)
if (getenv('APP_DEBUG') === 'true' || (isset($_GET['debug']) && $_GET['debug'] == '1')) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    error_reporting(E_ALL);
}
$host = getenv('DB_HOST') ?: 'localhost';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: '';
$dbname = getenv('DB_NAME') ?: 'bakery';
$conn = @new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    // Log and show generic message
    require_once __DIR__ . '/../includes/error_logger.php';
    ErrorLogger::logDatabaseError('CONNECT', $conn->connect_error);
    http_response_code(500);
    die('Application database connection error.');
}
