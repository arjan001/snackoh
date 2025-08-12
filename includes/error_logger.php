<?php
/**
 * Error Logger Utility
 * Provides centralized error logging and monitoring
 */
class ErrorLogger {
    private static $logFile = 'logs/error.log';
    
    /**
     * Initialize logger
     */
    public static function init() {
        $logDir = dirname(self::$logFile);
        if (!is_dir($logDir)) {
            mkdir($logDir, 0755, true);
        }
    }
    
    /**
     * Log error message
     * @param string $message Error message
     * @param string $level Error level (ERROR, WARNING, INFO)
     * @param array $context Additional context data
     */
    public static function log($message, $level = 'ERROR', $context = []) {
        self::init();
        
        $timestamp = date('Y-m-d H:i:s');
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        $user = $_SESSION['user_id'] ?? 'guest';
        $url = $_SERVER['REQUEST_URI'] ?? 'unknown';
        
        $logEntry = [
            'timestamp' => $timestamp,
            'level' => $level,
            'message' => $message,
            'ip' => $ip,
            'user' => $user,
            'url' => $url,
            'context' => $context
        ];
        
        $logLine = json_encode($logEntry) . PHP_EOL;
        file_put_contents(self::$logFile, $logLine, FILE_APPEND | LOCK_EX);
    }
    
    /**
     * Log database error
     * @param string $query SQL query
     * @param string $error Error message
     */
    public static function logDatabaseError($query, $error) {
        self::log("Database error: $error", 'ERROR', [
            'query' => $query,
            'type' => 'database'
        ]);
    }
    
    /**
     * Log security event
     * @param string $event Event description
     * @param array $details Event details
     */
    public static function logSecurityEvent($event, $details = []) {
        self::log("Security event: $event", 'WARNING', array_merge($details, ['type' => 'security']));
    }
    
    /**
     * Log authentication event
     * @param string $event Event description
     * @param string $user User identifier
     * @param bool $success Success status
     */
    public static function logAuthEvent($event, $user, $success) {
        self::log("Authentication: $event", $success ? 'INFO' : 'WARNING', [
            'user' => $user,
            'success' => $success,
            'type' => 'authentication'
        ]);
    }
    
    /**
     * Log file upload event
     * @param string $filename File name
     * @param string $status Upload status
     * @param array $details Additional details
     */
    public static function logFileUpload($filename, $status, $details = []) {
        self::log("File upload: $status", 'INFO', array_merge([
            'filename' => $filename,
            'type' => 'file_upload'
        ], $details));
    }
    
    /**
     * Get recent logs
     * @param int $lines Number of lines to retrieve
     * @return array Array of log entries
     */
    public static function getRecentLogs($lines = 100) {
        if (!file_exists(self::$logFile)) {
            return [];
        }
        
        $logs = [];
        $file = new SplFileObject(self::$logFile);
        $file->seek(PHP_INT_MAX);
        $totalLines = $file->key();
        
        $startLine = max(0, $totalLines - $lines);
        $file->seek($startLine);
        
        while (!$file->eof()) {
            $line = trim($file->current());
            if (!empty($line)) {
                $logs[] = json_decode($line, true);
            }
            $file->next();
        }
        
        return array_reverse($logs);
    }
    
    /**
     * Clean old logs
     * @param int $daysToKeep Number of days to keep logs
     */
    public static function cleanOldLogs($daysToKeep = 30) {
        if (!file_exists(self::$logFile)) {
            return;
        }
        
        $cutoff = time() - ($daysToKeep * 24 * 60 * 60);
        $tempFile = self::$logFile . '.tmp';
        
        $input = fopen(self::$logFile, 'r');
        $output = fopen($tempFile, 'w');
        
        while (($line = fgets($input)) !== false) {
            $logEntry = json_decode($line, true);
            if ($logEntry && isset($logEntry['timestamp'])) {
                $logTime = strtotime($logEntry['timestamp']);
                if ($logTime >= $cutoff) {
                    fwrite($output, $line);
                }
            }
        }
        
        fclose($input);
        fclose($output);
        
        rename($tempFile, self::$logFile);
    }
}
?> 