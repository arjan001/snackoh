<?php
include_once './config/config.php';

echo "<h2>🔧 Enhancing Inventory Management</h2>";

// Create waste tracking table
$waste_sql = "CREATE TABLE IF NOT EXISTS ingredient_waste (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ingredient_name VARCHAR(255) NOT NULL,
    waste_quantity DECIMAL(10,2) NOT NULL,
    waste_reason ENUM('expired', 'damaged', 'production_waste', 'spillage', 'other') NOT NULL,
    waste_date DATE NOT NULL,
    recorded_by INT,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($waste_sql) === TRUE) {
    echo "✅ Waste tracking table created<br>";
} else {
    echo "❌ Error: " . $conn->error . "<br>";
}

// Create reorder notifications table
$reorder_sql = "CREATE TABLE IF NOT EXISTS reorder_notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ingredient_name VARCHAR(255) NOT NULL,
    current_quantity DECIMAL(10,2) NOT NULL,
    reorder_level INT NOT NULL,
    suggested_quantity INT NOT NULL,
    notification_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pending', 'acknowledged', 'ordered', 'received') DEFAULT 'pending'
)";

if ($conn->query($reorder_sql) === TRUE) {
    echo "✅ Reorder notifications table created<br>";
} else {
    echo "❌ Error: " . $conn->error . "<br>";
}

echo "<h3>🎉 Enhancement Complete!</h3>";

$conn->close();
?> 