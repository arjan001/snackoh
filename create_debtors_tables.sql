-- Create debtors table
CREATE TABLE IF NOT EXISTS debtors (
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
);

-- Create debt_transactions table
CREATE TABLE IF NOT EXISTS debt_transactions (
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
);

-- Create index for better performance
CREATE INDEX idx_debtors_customer_id ON debtors(customer_id);
CREATE INDEX idx_debt_transactions_customer_id ON debt_transactions(customer_id);
CREATE INDEX idx_debt_transactions_order_id ON debt_transactions(order_id); 