<?php
/**
 * Database Utility Class
 * Provides secure database operations and common functions
 */
class DatabaseUtils {
    private $conn;
    
    public function __construct($connection) {
        $this->conn = $connection;
    }
    
    /**
     * Execute a SELECT query with parameters
     * @param string $query SQL query
     * @param array $params Parameters to bind
     * @return mysqli_result|false
     */
    public function select($query, $params = []) {
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            throw new Exception("Query preparation failed: " . $this->conn->error);
        }
        
        if (!empty($params)) {
            $types = str_repeat('s', count($params)); // Default to string type
            $stmt->bind_param($types, ...$params);
        }
        
        $stmt->execute();
        return $stmt->get_result();
    }
    
    /**
     * Execute an INSERT query with parameters
     * @param string $query SQL query
     * @param array $params Parameters to bind
     * @return int|false Insert ID or false on failure
     */
    public function insert($query, $params = []) {
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            throw new Exception("Query preparation failed: " . $this->conn->error);
        }
        
        if (!empty($params)) {
            $types = str_repeat('s', count($params)); // Default to string type
            $stmt->bind_param($types, ...$params);
        }
        
        if ($stmt->execute()) {
            return $stmt->insert_id;
        }
        return false;
    }
    
    /**
     * Execute an UPDATE query with parameters
     * @param string $query SQL query
     * @param array $params Parameters to bind
     * @return bool Success status
     */
    public function update($query, $params = []) {
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            throw new Exception("Query preparation failed: " . $this->conn->error);
        }
        
        if (!empty($params)) {
            $types = str_repeat('s', count($params)); // Default to string type
            $stmt->bind_param($types, ...$params);
        }
        
        return $stmt->execute();
    }
    
    /**
     * Execute a DELETE query with parameters
     * @param string $query SQL query
     * @param array $params Parameters to bind
     * @return bool Success status
     */
    public function delete($query, $params = []) {
        return $this->update($query, $params);
    }
    
    /**
     * Sanitize input data
     * @param mixed $data Input data
     * @return mixed Sanitized data
     */
    public function sanitize($data) {
        if (is_array($data)) {
            return array_map([$this, 'sanitize'], $data);
        }
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }
    
    /**
     * Validate email address
     * @param string $email Email to validate
     * @return bool Valid email status
     */
    public function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
    
    /**
     * Validate integer
     * @param mixed $value Value to validate
     * @return bool Valid integer status
     */
    public function validateInteger($value) {
        return is_numeric($value) && floor($value) == $value;
    }
    
    /**
     * Validate float
     * @param mixed $value Value to validate
     * @return bool Valid float status
     */
    public function validateFloat($value) {
        return is_numeric($value);
    }
    
    /**
     * Begin transaction
     */
    public function beginTransaction() {
        $this->conn->begin_transaction();
    }
    
    /**
     * Commit transaction
     */
    public function commit() {
        $this->conn->commit();
    }
    
    /**
     * Rollback transaction
     */
    public function rollback() {
        $this->conn->rollback();
    }
    
    /**
     * Close database connection
     */
    public function close() {
        $this->conn->close();
    }
}
?> 