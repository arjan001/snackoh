-- Add a "Walk-in Customer" record to handle foreign key constraints
-- This allows us to use customer_id = 0 for walk-in customers

-- First, let's try with basic columns that should exist
INSERT INTO customers (id, customer_name, email, phone) 
VALUES (0, 'Walk-in Customer', 'walkin@snackoh.com', 'N/A')
ON DUPLICATE KEY UPDATE 
    customer_name = 'Walk-in Customer',
    email = 'walkin@snackoh.com',
    phone = 'N/A';

-- If the above fails, try this simpler version:
-- INSERT INTO customers (id, customer_name) 
-- VALUES (0, 'Walk-in Customer')
-- ON DUPLICATE KEY UPDATE customer_name = 'Walk-in Customer'; 