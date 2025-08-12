<?php
/**
 * CSRF Protection Utility
 * Provides protection against Cross-Site Request Forgery attacks
 */
class CSRFProtection {
    
    /**
     * Generate CSRF token
     * @return string CSRF token
     */
    public static function generateToken() {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
    
    /**
     * Verify CSRF token
     * @param string $token Token to verify
     * @return bool Valid token status
     */
    public static function verifyToken($token) {
        if (!isset($_SESSION['csrf_token'])) {
            return false;
        }
        return hash_equals($_SESSION['csrf_token'], $token);
    }
    
    /**
     * Generate CSRF token input field
     * @return string HTML input field
     */
    public static function getTokenField() {
        $token = self::generateToken();
        return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($token) . '">';
    }
    
    /**
     * Validate CSRF token from POST request
     * @return bool Valid token status
     */
    public static function validatePostToken() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return false;
        }
        
        $token = $_POST['csrf_token'] ?? '';
        return self::verifyToken($token);
    }
    
    /**
     * Require valid CSRF token or die
     */
    public static function requireValidToken() {
        if (!self::validatePostToken()) {
            die('CSRF token validation failed. Please try again.');
        }
    }
    
    /**
     * Regenerate CSRF token
     */
    public static function regenerateToken() {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
}
?> 