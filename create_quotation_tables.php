<?php
include_once './config/config.php';

try {
    // Create quotations table
    $sql1 = "
    CREATE TABLE IF NOT EXISTS quotations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        quotation_number VARCHAR(50) UNIQUE NOT NULL,
        customer_id INT,
        customer_name VARCHAR(255) NOT NULL,
        customer_email VARCHAR(255),
        customer_phone VARCHAR(50),
        quotation_date DATE NOT NULL,
        expiry_date DATE NOT NULL,
        subtotal DECIMAL(10,2) DEFAULT 0.00,
        tax_rate DECIMAL(5,2) DEFAULT 0.00,
        tax_amount DECIMAL(10,2) DEFAULT 0.00,
        discount DECIMAL(10,2) DEFAULT 0.00,
        shipping DECIMAL(10,2) DEFAULT 0.00,
        grand_total DECIMAL(10,2) DEFAULT 0.00,
        status ENUM('draft', 'sent', 'accepted', 'rejected', 'expired') DEFAULT 'draft',
        notes TEXT,
        terms_conditions TEXT,
        created_by INT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE SET NULL,
        FOREIGN KEY (created_by) REFERENCES employees(id) ON DELETE SET NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ";
    
    if ($conn->query($sql1) === TRUE) {
        echo "✅ quotations table created successfully!<br>";
    } else {
        echo "❌ Error creating quotations table: " . $conn->error . "<br>";
    }
    
    // Create quotation_items table
    $sql2 = "
    CREATE TABLE IF NOT EXISTS quotation_items (
        id INT AUTO_INCREMENT PRIMARY KEY,
        quotation_id INT NOT NULL,
        product_name VARCHAR(255) NOT NULL,
        product_description TEXT,
        quantity INT NOT NULL,
        unit_price DECIMAL(10,2) NOT NULL,
        discount DECIMAL(10,2) DEFAULT 0.00,
        tax_rate DECIMAL(5,2) DEFAULT 0.00,
        tax_amount DECIMAL(10,2) DEFAULT 0.00,
        total_amount DECIMAL(10,2) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (quotation_id) REFERENCES quotations(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ";
    
    if ($conn->query($sql2) === TRUE) {
        echo "✅ quotation_items table created successfully!<br>";
    } else {
        echo "❌ Error creating quotation_items table: " . $conn->error . "<br>";
    }
    
    // Create indexes for better performance
    $indexes = [
        "CREATE INDEX IF NOT EXISTS idx_quotation_number ON quotations(quotation_number)",
        "CREATE INDEX IF NOT EXISTS idx_quotation_customer ON quotations(customer_id)",
        "CREATE INDEX IF NOT EXISTS idx_quotation_status ON quotations(status)",
        "CREATE INDEX IF NOT EXISTS idx_quotation_date ON quotations(quotation_date)",
        "CREATE INDEX IF NOT EXISTS idx_quotation_items_quotation_id ON quotation_items(quotation_id)"
    ];
    
    foreach ($indexes as $index_sql) {
        if ($conn->query($index_sql) === TRUE) {
            echo "✅ Index created successfully!<br>";
        } else {
            echo "❌ Error creating index: " . $conn->error . "<br>";
        }
    }
    
    echo "✅ Quotation system tables are ready to use!<br>";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "<br>";
}
?> 