<?php
// Lightweight health check to diagnose white page on production
header('Content-Type: text/plain');

// 1) Error visibility
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "Health check start\n";

// 2) PHP basics
echo "PHP version: ".PHP_VERSION."\n";
echo "Document root: ".($_SERVER['DOCUMENT_ROOT'] ?? 'unknown')."\n";
echo "Current script: ".__FILE__."\n";
echo "HTTPS: ".((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'on' : 'off')."\n";

// 3) Error logger test (create logs dir if needed)
try {
    require_once __DIR__ . '/includes/error_logger.php';
    ErrorLogger::log('Healthcheck write test', 'INFO');
    echo "Logger: ok (wrote to logs/error.log)\n";
} catch (Throwable $e) {
    echo "Logger error: ".$e->getMessage()."\n";
}

// 4) DB connection test via app config
try {
    require __DIR__ . '/config/config.php';
    if (!isset($conn)) {
        echo "DB: config loaded but no connection variable created\n";
    } else {
        echo "DB: connection object created\n";
        // Simple query
        $res = $conn->query('SELECT 1 as one');
        if ($res) {
            $row = $res->fetch_assoc();
            echo "DB: simple query ok (".json_encode($row).")\n";
        } else {
            echo "DB: simple query failed: ".$conn->error."\n";
        }
    }
} catch (Throwable $e) {
    echo "DB error: ".$e->getMessage()."\n";
}

// 5) Session test
try {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['__health'] = time();
    echo "Session: ok\n";
} catch (Throwable $e) {
    echo "Session error: ".$e->getMessage()."\n";
}

echo "Health check end\n";
?>

