<?php
include_once './config/config.php';

try {
    // Create held_transactions table
    $sql = "
    CREATE TABLE IF NOT EXISTS held_transactions (
        id INT AUTO_INCREMENT PRIMARY KEY,
        hold_id VARCHAR(50) UNIQUE NOT NULL,
        employee_id INT NOT NULL,
        cart_data TEXT NOT NULL,
        total_price DECIMAL(10,2) NOT NULL,
        reference VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (employee_id) REFERENCES employees(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ";
    
    if ($conn->query($sql) === TRUE) {
        echo "✅ held_transactions table created successfully!<br>";
    } else {
        echo "❌ Error creating held_transactions table: " . $conn->error . "<br>";
    }
    
    // Add index for better performance
    $index_sql = "CREATE INDEX IF NOT EXISTS idx_employee_id ON held_transactions(employee_id);";
    $conn->query($index_sql);
    
    echo "✅ Indexes created successfully!<br>";
    echo "✅ Held transactions system is ready to use!<br>";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "<br>";
}
?> 