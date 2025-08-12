<?php
// Database Connection
include './config/config.php';

echo "<h2>Creating Ingredient Usage Table...</h2>";

try {
    // Create ingredient_usage table
    $sql = "CREATE TABLE IF NOT EXISTS ingredient_usage (
        id INT AUTO_INCREMENT PRIMARY KEY,
        product_name VARCHAR(255) NOT NULL,
        ingredient_name VARCHAR(255) NOT NULL,
        quantity_consumed DECIMAL(10,2) NOT NULL,
        order_id INT NOT NULL,
        transaction_id VARCHAR(100) NOT NULL,
        usage_date DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
    )";
    
    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green;'>✓ Ingredient usage table created successfully</p>";
    } else {
        echo "<p style='color: red;'>✗ Error creating ingredient_usage table: " . $conn->error . "</p>";
    }

    // Create indexes
    $indexes = [
        "CREATE INDEX IF NOT EXISTS idx_ingredient_usage_product ON ingredient_usage(product_name)",
        "CREATE INDEX IF NOT EXISTS idx_ingredient_usage_ingredient ON ingredient_usage(ingredient_name)",
        "CREATE INDEX IF NOT EXISTS idx_ingredient_usage_order ON ingredient_usage(order_id)",
        "CREATE INDEX IF NOT EXISTS idx_ingredient_usage_date ON ingredient_usage(usage_date)"
    ];

    foreach ($indexes as $index_sql) {
        if ($conn->query($index_sql) === TRUE) {
            echo "<p style='color: green;'>✓ Index created successfully</p>";
        } else {
            echo "<p style='color: orange;'>⚠ Index creation warning: " . $conn->error . "</p>";
        }
    }

    echo "<h3 style='color: green;'>Installation completed!</h3>";
    echo "<p><strong>Bill of Materials (BOM) Features Now Available:</strong></p>";
    echo "<ul>";
    echo "<li>✅ Inventory validation before sales</li>";
    echo "<li>✅ Automatic ingredient consumption</li>";
    echo "<li>✅ Product stock reduction</li>";
    echo "<li>✅ Ingredient usage tracking</li>";
    echo "<li>✅ BOM-based inventory management</li>";
    echo "</ul>";
    echo "<p><a href='pos.php'>Go to POS</a> | <a href='manage-stocks.php'>View Stock</a> | <a href='product-list.php'>View Products</a> | <a href='ingredient_usage_tracking.php'>View BOM Tracking</a></p>";

} catch (Exception $e) {
    echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
}
?> 