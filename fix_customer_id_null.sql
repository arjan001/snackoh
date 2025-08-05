-- SQL script to fix customer_id foreign key constraint issue
-- This script allows NULL values for customer_id in the orders table

-- First, let's check the current structure
DESCRIBE orders;

-- If customer_id doesn't allow NULL, we need to modify it
-- Uncomment the following lines if needed:

-- ALTER TABLE orders MODIFY COLUMN customer_id INT NULL;
-- ALTER TABLE orders DROP FOREIGN KEY fk_orders_customer;
-- ALTER TABLE orders ADD CONSTRAINT fk_orders_customer 
--     FOREIGN KEY (customer_id) REFERENCES customers(id) 
--     ON DELETE CASCADE ON UPDATE CASCADE;

-- Alternative approach: Create a "Walk-in Customer" record in customers table
-- INSERT INTO customers (id, customer_name, email, phone) 
-- VALUES (0, 'Walk-in Customer', 'walkin@example.com', 'N/A')
-- ON DUPLICATE KEY UPDATE customer_name = 'Walk-in Customer'; 