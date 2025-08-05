-- Create ingredient_usage table to track ingredient consumption
CREATE TABLE IF NOT EXISTS ingredient_usage (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(255) NOT NULL,
    ingredient_name VARCHAR(255) NOT NULL,
    quantity_consumed DECIMAL(10,2) NOT NULL,
    order_id INT NOT NULL,
    transaction_id VARCHAR(100) NOT NULL,
    usage_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
);

-- Create index for better performance
CREATE INDEX idx_ingredient_usage_product ON ingredient_usage(product_name);
CREATE INDEX idx_ingredient_usage_ingredient ON ingredient_usage(ingredient_name);
CREATE INDEX idx_ingredient_usage_order ON ingredient_usage(order_id);
CREATE INDEX idx_ingredient_usage_date ON ingredient_usage(usage_date); 