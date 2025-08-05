-- Option 1: Modify the database to allow NULL values for customer_id
-- This is often the better approach for POS systems

-- First, drop the existing foreign key constraint
ALTER TABLE orders DROP FOREIGN KEY fk_orders_customer;

-- Modify the customer_id column to allow NULL values
ALTER TABLE orders MODIFY COLUMN customer_id INT NULL;

-- Recreate the foreign key constraint to allow NULL values
ALTER TABLE orders ADD CONSTRAINT fk_orders_customer 
    FOREIGN KEY (customer_id) REFERENCES customers(id) 
    ON DELETE CASCADE ON UPDATE CASCADE;

-- Option 2: If you prefer to keep the walk-in customer approach, use this instead:
-- INSERT INTO customers (id, customer_name, email, phone) 
-- VALUES (0, 'Walk-in Customer', 'walkin@snackoh.com', 'N/A')
-- ON DUPLICATE KEY UPDATE 
--     customer_name = 'Walk-in Customer',
--     email = 'walkin@snackoh.com',
--     phone = 'N/A'; 