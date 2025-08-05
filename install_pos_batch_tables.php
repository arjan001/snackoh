<?php
// Database Connection
include './config/config.php';

echo "<h2>🔧 Installing POS Batch Management System...</h2>";

try {
    // Read and execute the SQL file
    $sql_file = file_get_contents('create_pos_batch_tables.sql');
    $queries = explode(';', $sql_file);
    
    foreach ($queries as $query) {
        $query = trim($query);
        if (!empty($query)) {
            if ($conn->query($query) === TRUE) {
                echo "<p style='color: green;'>✓ Executed: " . substr($query, 0, 50) . "...</p>";
            } else {
                echo "<p style='color: orange;'>⚠ Note: " . $conn->error . "</p>";
            }
        }
    }
    
    echo "<h3 style='color: green;'>✅ POS Batch Management System Ready!</h3>";
    echo "<p><strong>Features Available:</strong></p>";
    echo "<ul>";
    echo "<li>✅ POS Session Management (Open/Close shifts)</li>";
    echo "<li>✅ Batch Tracking for Orders</li>";
    echo "<li>✅ Daily Batch Summaries</li>";
    echo "<li>✅ Employee Session Tracking</li>";
    echo "<li>✅ Opening/Closing Balance Management</li>";
    echo "</ul>";
    echo "<p><a href='pos.php'>Go to POS</a> | <a href='pos_sessions.php'>Manage Sessions</a></p>";
    
} catch (Exception $e) {
    echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
}
?> 