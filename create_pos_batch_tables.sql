-- POS Batch Management Tables

-- Table for POS sessions (opening/closing shifts)
CREATE TABLE IF NOT EXISTS pos_sessions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    session_id VARCHAR(50) UNIQUE NOT NULL,
    employee_id INT NOT NULL,
    opening_amount DECIMAL(10,2) DEFAULT 0.00,
    closing_amount DECIMAL(10,2) DEFAULT 0.00,
    total_sales DECIMAL(10,2) DEFAULT 0.00,
    total_transactions INT DEFAULT 0,
    opening_time DATETIME DEFAULT CURRENT_TIMESTAMP,
    closing_time DATETIME NULL,
    status ENUM('open', 'closed') DEFAULT 'open',
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (employee_id) REFERENCES employees(id),
    INDEX idx_session_status (status),
    INDEX idx_employee_session (employee_id, status),
    INDEX idx_opening_time (opening_time)
);

-- Table for batch tracking in orders
CREATE TABLE IF NOT EXISTS order_batches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    session_id VARCHAR(50) NOT NULL,
    batch_number VARCHAR(20) NOT NULL,
    product_name VARCHAR(255) NOT NULL,
    quantity_sold INT NOT NULL,
    unit_price DECIMAL(10,2) NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    INDEX idx_session_batch (session_id, batch_number),
    INDEX idx_product_batch (product_name, batch_number)
);

-- Table for daily batch summaries
CREATE TABLE IF NOT EXISTS daily_batch_summaries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date DATE NOT NULL,
    session_id VARCHAR(50) NOT NULL,
    employee_id INT NOT NULL,
    opening_amount DECIMAL(10,2) DEFAULT 0.00,
    closing_amount DECIMAL(10,2) DEFAULT 0.00,
    total_sales DECIMAL(10,2) DEFAULT 0.00,
    total_transactions INT DEFAULT 0,
    cash_sales DECIMAL(10,2) DEFAULT 0.00,
    mpesa_sales DECIMAL(10,2) DEFAULT 0.00,
    credit_sales DECIMAL(10,2) DEFAULT 0.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_session_date (session_id, date),
    INDEX idx_date_employee (date, employee_id),
    INDEX idx_session_date (session_id, date)
);

-- Insert sample data for testing
INSERT INTO pos_sessions (session_id, employee_id, opening_amount, status) 
VALUES ('POS-2024-001', 1, 1000.00, 'open')
ON DUPLICATE KEY UPDATE opening_amount = 1000.00; 