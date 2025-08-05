<?php
// Database Connection
include './config/config.php';

echo "<h2>Installing Debtors Tables...</h2>";

try {
    // Create debtors table
    $sql1 = "CREATE TABLE IF NOT EXISTS debtors (
        id INT AUTO_INCREMENT PRIMARY KEY,
        customer_id INT NOT NULL,
        customer_name VARCHAR(255) NOT NULL,
        email VARCHAR(255),
        phone VARCHAR(50),
        total_debt DECIMAL(10,2) DEFAULT 0.00,
        created_date DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_date DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        status ENUM('active', 'inactive') DEFAULT 'active',
        FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE CASCADE
    )";
    
    if ($conn->query($sql1) === TRUE) {
        echo "<p style='color: green;'>✓ Debtors table created successfully</p>";
    } else {
        echo "<p style='color: red;'>✗ Error creating debtors table: " . $conn->error . "</p>";
    }

    // Create debt_transactions table
    $sql2 = "CREATE TABLE IF NOT EXISTS debt_transactions (
        id INT AUTO_INCREMENT PRIMARY KEY,
        customer_id INT NOT NULL,
        order_id INT NOT NULL,
        transaction_id VARCHAR(100) NOT NULL,
        amount DECIMAL(10,2) NOT NULL,
        transaction_date DATETIME DEFAULT CURRENT_TIMESTAMP,
        status ENUM('pending', 'paid', 'cancelled') DEFAULT 'pending',
        payment_date DATETIME NULL,
        notes TEXT,
        FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE CASCADE,
        FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
    )";
    
    if ($conn->query($sql2) === TRUE) {
        echo "<p style='color: green;'>✓ Debt transactions table created successfully</p>";
    } else {
        echo "<p style='color: red;'>✗ Error creating debt_transactions table: " . $conn->error . "</p>";
    }

    // Create indexes
    $indexes = [
        "CREATE INDEX IF NOT EXISTS idx_debtors_customer_id ON debtors(customer_id)",
        "CREATE INDEX IF NOT EXISTS idx_debt_transactions_customer_id ON debt_transactions(customer_id)",
        "CREATE INDEX IF NOT EXISTS idx_debt_transactions_order_id ON debt_transactions(order_id)"
    ];

    foreach ($indexes as $index_sql) {
        if ($conn->query($index_sql) === TRUE) {
            echo "<p style='color: green;'>✓ Index created successfully</p>";
        } else {
            echo "<p style='color: orange;'>⚠ Index creation warning: " . $conn->error . "</p>";
        }
    }

    echo "<h3 style='color: green;'>Installation completed!</h3>";
    echo "<p><a href='pos.php'>Go to POS</a> | <a href='debtors.php'>View Debtors</a> | <a href='sales-list.php'>View Sales</a></p>";

} catch (Exception $e) {
    echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
}
?> 