<?php
// Database Connection
include './config/config.php';

echo "<h2>🔔 Setting up Notifications System...</h2>";

try {
    // Create notifications table
    $sql = "CREATE TABLE IF NOT EXISTS notifications (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        message TEXT NOT NULL,
        type ENUM('success', 'error', 'warning', 'info') DEFAULT 'info',
        user_id INT,
        is_read TINYINT(1) DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        INDEX idx_user_read (user_id, is_read),
        INDEX idx_created_at (created_at)
    )";
    
    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green;'>✓ Notifications table created successfully</p>";
    } else {
        echo "<p style='color: red;'>✗ Error creating notifications table: " . $conn->error . "</p>";
    }

    echo "<h3 style='color: green;'>Notifications System Ready!</h3>";
    echo "<p><strong>Features Available:</strong></p>";
    echo "<ul>";
    echo "<li>✅ Store POS errors and successes</li>";
    echo "<li>✅ Track notification read status</li>";
    echo "<li>✅ User-specific notifications</li>";
    echo "<li>✅ Timestamp tracking</li>";
    echo "</ul>";
    echo "<p><a href='pos.php'>Go to POS</a> | <a href='activities.php'>View All Notifications</a></p>";

} catch (Exception $e) {
    echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
}
?> 