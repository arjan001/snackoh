SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
/*!40101 SET NAMES utf8mb4 */;

--
-- SnackOH Bakery ERP: Schema + seed (employees)
-- Still FK-deferred; run constraints_optional.sql afterwards if you want foreign keys
-- Seed is idempotent (ON DUPLICATE KEY UPDATE) and safe on existing databases
--

-- ========== CORE REFERENCE TABLES ==========
CREATE TABLE IF NOT EXISTS roles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  role_name VARCHAR(100) UNIQUE NOT NULL,
  description TEXT NULL,
  status ENUM('active','inactive') DEFAULT 'active',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS departments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  department_name VARCHAR(100) NOT NULL,
  status ENUM('active','inactive') DEFAULT 'active',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS designation (
  id INT AUTO_INCREMENT PRIMARY KEY,
  designation_name VARCHAR(100) NOT NULL,
  status ENUM('active','inactive') DEFAULT 'active',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS employees (
  id INT AUTO_INCREMENT PRIMARY KEY,
  first_name VARCHAR(100) NOT NULL,
  last_name VARCHAR(100) NOT NULL,
  email VARCHAR(255) UNIQUE,
  contact_number VARCHAR(50),
  emp_code VARCHAR(50) UNIQUE,
  dob DATE,
  gender VARCHAR(20),
  nationality VARCHAR(100),
  joining_date DATE,
  department_id INT,
  designation_id INT,
  blood_group VARCHAR(10),
  emergency_no_1 VARCHAR(50),
  emergency_no_2 VARCHAR(50),
  kra_pin VARCHAR(50),
  address VARCHAR(255),
  country VARCHAR(100),
  physical_address VARCHAR(255),
  city VARCHAR(100),
  zipcode VARCHAR(20),
  profile_photo VARCHAR(255),
  national_id VARCHAR(255),
  employee_status TINYINT(1) DEFAULT 1,
  user_role INT,
  password_hash VARCHAR(255) NULL,
  reset_token VARCHAR(255) NULL,
  reset_expires DATETIME NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_employees_dept (department_id),
  INDEX idx_employees_desig (designation_id),
  INDEX idx_employees_role (user_role)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ========== CUSTOMERS ==========
CREATE TABLE IF NOT EXISTS customers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  customer_name VARCHAR(255) NOT NULL,
  email VARCHAR(255) UNIQUE,
  phone VARCHAR(20),
  physical_address TEXT,
  town VARCHAR(100),
  segment ENUM('Retailer','Wholesaler','Distributor','Consumer') DEFAULT 'Retailer',
  city VARCHAR(100),
  gender ENUM('Male','Female') DEFAULT 'Male',
  payment_terms ENUM('Cash','Credit') DEFAULT 'Cash',
  latitude DECIMAL(10,8) NULL,
  longitude DECIMAL(11,8) NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  password_hash VARCHAR(255) NULL,
  INDEX idx_customers_email (email),
  INDEX idx_customers_name (customer_name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ========== PRODUCTS & RECIPES ==========
CREATE TABLE IF NOT EXISTS product_category (
  id INT AUTO_INCREMENT PRIMARY KEY,
  category_name VARCHAR(255) NOT NULL,
  category_slug VARCHAR(255) NULL,
  status ENUM('active','inactive') DEFAULT 'active',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS units (
  id INT AUTO_INCREMENT PRIMARY KEY,
  unit_name VARCHAR(100) NOT NULL,
  short_name VARCHAR(50) NOT NULL,
  no_of_products INT DEFAULT 0,
  status ENUM('active','inactive') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS recipes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  recipe_name VARCHAR(255) NOT NULL,
  upper_temperature VARCHAR(50) NULL,
  lower_temperature VARCHAR(50) NULL,
  recipe_instructions TEXT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS recipe_ingredients (
  id INT AUTO_INCREMENT PRIMARY KEY,
  recipe_id INT NOT NULL,
  ingredients_json LONGTEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_recipe_ingredients_recipe (recipe_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  product_name VARCHAR(255) UNIQUE NOT NULL,
  product_category INT,
  recipe_name INT,
  product_unit INT,
  product_quantity DECIMAL(10,2) DEFAULT 0,
  product_price DECIMAL(10,2) DEFAULT 0,
  product_quantity_alert DECIMAL(10,2) DEFAULT 0,
  manufactured_on DATETIME NULL,
  product_image VARCHAR(255) NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_products_category (product_category),
  INDEX idx_products_recipe (recipe_name),
  INDEX idx_products_unit (product_unit)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ========== SUPPLIERS & STOCK ==========
CREATE TABLE IF NOT EXISTS supplier_category (
  id INT AUTO_INCREMENT PRIMARY KEY,
  category_name VARCHAR(255) NOT NULL,
  category_description TEXT NULL,
  status ENUM('active','inactive') DEFAULT 'active',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS suppliers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  supplier_name VARCHAR(255) NOT NULL,
  contact_person_name VARCHAR(255) NULL,
  phone_no VARCHAR(50) NULL,
  email_address VARCHAR(255) NULL,
  supplier_category INT NULL,
  physical_address TEXT NULL,
  payment_terms VARCHAR(100) NULL,
  tax_information TEXT NULL,
  bank_details TEXT NULL,
  status ENUM('active','inactive') DEFAULT 'active',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_suppliers_category (supplier_category)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS stock_category (
  id INT AUTO_INCREMENT PRIMARY KEY,
  stock_category_name VARCHAR(255) NOT NULL,
  stock_category_description TEXT NULL,
  stock_category_status ENUM('active','inactive') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS stock (
  id INT AUTO_INCREMENT PRIMARY KEY,
  product_name VARCHAR(255) NOT NULL, -- ingredient key in flows
  stock_category_id INT NULL,
  stock_quantity DECIMAL(10,2) DEFAULT 0,
  stock_price DECIMAL(10,2) DEFAULT 0,
  stock_expiry_date DATE NULL,
  stock_unit INT NULL, -- FK to units (deferred)
  reorder_level INT DEFAULT 0,
  stock_supplier_id INT NULL,
  status ENUM('active','inactive') DEFAULT 'active',
  unit VARCHAR(50) NULL, -- textual unit used in some views
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_stock_category (stock_category_id),
  INDEX idx_stock_unit (stock_unit),
  INDEX idx_stock_supplier (stock_supplier_id),
  INDEX idx_stock_product_name (product_name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ========== SALES & POS ==========
CREATE TABLE IF NOT EXISTS orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  transaction_id VARCHAR(100) UNIQUE NOT NULL,
  customer_id INT NULL,
  employee_id INT NOT NULL,
  total_price DECIMAL(10,2) NOT NULL,
  payment_status VARCHAR(50) NOT NULL,
  payment_type VARCHAR(50) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_orders_customer (customer_id),
  INDEX idx_orders_employee (employee_id),
  INDEX idx_orders_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS order_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  order_id INT NOT NULL,
  product_name VARCHAR(255) NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  quantity DECIMAL(10,2) NOT NULL,
  image VARCHAR(255) NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_order_items_order (order_id),
  INDEX idx_order_items_product (product_name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  status ENUM('open','closed') DEFAULT 'open',
  notes TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_pos_sessions_employee (employee_id),
  INDEX idx_pos_sessions_status (status),
  INDEX idx_pos_sessions_opening_time (opening_time)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS order_batches (
  id INT AUTO_INCREMENT PRIMARY KEY,
  order_id INT NOT NULL,
  session_id VARCHAR(50) NOT NULL,
  batch_number VARCHAR(20) NOT NULL,
  product_name VARCHAR(255) NOT NULL,
  quantity_sold DECIMAL(10,2) NOT NULL,
  unit_price DECIMAL(10,2) NOT NULL,
  total_price DECIMAL(10,2) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_order_batches_order (order_id),
  INDEX idx_order_batches_session (session_id),
  INDEX idx_order_batches_product (product_name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  INDEX idx_daily_batch_employee (employee_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ========== DEBTORS ==========
CREATE TABLE IF NOT EXISTS debtors (
  id INT AUTO_INCREMENT PRIMARY KEY,
  customer_id INT NOT NULL,
  customer_name VARCHAR(255) NOT NULL,
  email VARCHAR(255),
  phone VARCHAR(50),
  total_debt DECIMAL(10,2) DEFAULT 0.00,
  created_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_date DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  status ENUM('active','inactive') DEFAULT 'active',
  INDEX idx_debtors_customer (customer_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS debt_transactions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  customer_id INT NOT NULL,
  order_id INT NOT NULL,
  transaction_id VARCHAR(100) NOT NULL,
  amount DECIMAL(10,2) NOT NULL,
  transaction_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  status ENUM('pending','paid','cancelled') DEFAULT 'pending',
  payment_date DATETIME NULL,
  notes TEXT,
  INDEX idx_debt_tx_customer (customer_id),
  INDEX idx_debt_tx_order (order_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ========== QUOTATIONS ==========
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
  status ENUM('draft','sent','accepted','rejected','expired') DEFAULT 'draft',
  notes TEXT,
  terms_conditions TEXT,
  created_by INT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX idx_quotation_customer (customer_id),
  INDEX idx_quotation_status (status),
  INDEX idx_quotation_date (quotation_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS quotation_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  quotation_id INT NOT NULL,
  product_name VARCHAR(255) NOT NULL,
  product_description TEXT,
  quantity DECIMAL(10,2) NOT NULL,
  unit_price DECIMAL(10,2) NOT NULL,
  discount DECIMAL(10,2) DEFAULT 0.00,
  tax_rate DECIMAL(5,2) DEFAULT 0.00,
  tax_amount DECIMAL(10,2) DEFAULT 0.00,
  total_amount DECIMAL(10,2) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_quote_items_quote (quotation_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ========== NOTIFICATIONS ==========
CREATE TABLE IF NOT EXISTS notifications (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  message TEXT NOT NULL,
  type ENUM('success','error','warning','info') DEFAULT 'info',
  user_id INT,
  is_read TINYINT(1) DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_notifications_user_read (user_id, is_read),
  INDEX idx_notifications_created (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ========== HELD TRANSACTIONS ==========
CREATE TABLE IF NOT EXISTS held_transactions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  hold_id VARCHAR(50) UNIQUE NOT NULL,
  employee_id INT NOT NULL,
  cart_data LONGTEXT NOT NULL,
  total_price DECIMAL(10,2) NOT NULL,
  reference VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_held_emp (employee_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ========== BOM / INGREDIENT USAGE ==========
CREATE TABLE IF NOT EXISTS ingredient_usage (
  id INT AUTO_INCREMENT PRIMARY KEY,
  product_name VARCHAR(255) NOT NULL,
  ingredient_name VARCHAR(255) NOT NULL,
  quantity_consumed DECIMAL(10,2) NOT NULL,
  order_id INT NOT NULL,
  transaction_id VARCHAR(100) NOT NULL,
  usage_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_ing_usage_product (product_name),
  INDEX idx_ing_usage_ingredient (ingredient_name),
  INDEX idx_ing_usage_order (order_id),
  INDEX idx_ing_usage_date (usage_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ========== INVENTORY ENHANCEMENTS ==========
CREATE TABLE IF NOT EXISTS ingredient_waste (
  id INT AUTO_INCREMENT PRIMARY KEY,
  ingredient_name VARCHAR(255) NOT NULL,
  waste_quantity DECIMAL(10,2) NOT NULL,
  waste_reason ENUM('expired','damaged','production_waste','spillage','other') NOT NULL,
  waste_date DATE NOT NULL,
  recorded_by INT NULL,
  notes TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_waste_ingredient_date (ingredient_name, waste_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS reorder_notifications (
  id INT AUTO_INCREMENT PRIMARY KEY,
  ingredient_name VARCHAR(255) NOT NULL,
  current_quantity DECIMAL(10,2) NOT NULL,
  reorder_level INT NOT NULL,
  suggested_quantity INT NOT NULL,
  notification_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  status ENUM('pending','acknowledged','ordered','received') DEFAULT 'pending',
  INDEX idx_reorder_status (status, notification_date),
  INDEX idx_reorder_ingredient (ingredient_name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ========== DELIVERIES ==========
CREATE TABLE IF NOT EXISTS deliveries (
  id INT AUTO_INCREMENT PRIMARY KEY,
  customer_id INT NOT NULL,
  address VARCHAR(255) NOT NULL,
  order_id INT NULL,
  schedule_datetime DATETIME NOT NULL,
  driver_id INT NULL,
  vehicle_id INT NULL,
  notification_method ENUM('SMS','WHATSAPP','EMAIL') NOT NULL,
  status ENUM('Pending','Completed','Cancelled') DEFAULT 'Pending',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_deliveries_customer (customer_id),
  INDEX idx_deliveries_order (order_id),
  INDEX idx_deliveries_driver (driver_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ========== ASSETS & FLEET ==========
CREATE TABLE IF NOT EXISTS asset_category (
  id INT AUTO_INCREMENT PRIMARY KEY,
  category_name VARCHAR(255) NOT NULL,
  category_description TEXT DEFAULT NULL,
  status TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS assets (
  id INT AUTO_INCREMENT PRIMARY KEY,
  asset_name VARCHAR(255) NOT NULL,
  category_id INT NOT NULL,
  company_code VARCHAR(50) NOT NULL,
  registration_number VARCHAR(50) NOT NULL,
  initial_cost DECIMAL(10,2) NOT NULL,
  current_cost DECIMAL(10,2) NOT NULL,
  status ENUM('Operational','Maintenance Required','Out of Service') NOT NULL,
  next_maintenance DATE NOT NULL,
  ownership ENUM('Owned','Leased') NOT NULL,
  maintenance_cost DECIMAL(10,2) NOT NULL,
  depreciation_factor DECIMAL(5,2) NOT NULL,
  lifespan INT NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  serial_number VARCHAR(255) DEFAULT NULL,
  INDEX idx_assets_category (category_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS asset_replacement_policy (
  id INT AUTO_INCREMENT PRIMARY KEY,
  asset_id INT DEFAULT NULL,
  serial_number VARCHAR(255) DEFAULT NULL,
  purchase_date DATE DEFAULT NULL,
  policy_years INT DEFAULT NULL,
  replacement_date DATE DEFAULT NULL,
  current_value DECIMAL(10,2) DEFAULT NULL,
  asset_condition ENUM('New','Good','Fair','Needs Replacement') DEFAULT NULL,
  policy_description TEXT NOT NULL,
  INDEX idx_asset_policy_asset (asset_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS capacity_management (
  id INT AUTO_INCREMENT PRIMARY KEY,
  asset_id INT NOT NULL,
  category VARCHAR(255) NOT NULL,
  max_capacity INT NOT NULL,
  current_usage INT NOT NULL,
  available_capacity INT NOT NULL,
  status ENUM('Available','Near Limit','Overloaded') NOT NULL,
  last_updated DATE NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_capacity_asset (asset_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS fleet (
  id INT AUTO_INCREMENT PRIMARY KEY,
  registration_number VARCHAR(50) UNIQUE,
  insurance VARCHAR(100) NULL,
  capacity VARCHAR(100) NULL,
  assigned_driver INT NULL,
  status VARCHAR(50) NULL,
  last_service_date DATE NULL,
  next_service_date DATE NULL,
  INDEX idx_fleet_driver (assigned_driver)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ========== PRODUCTION ==========
CREATE TABLE IF NOT EXISTS production_batches (
  id INT AUTO_INCREMENT PRIMARY KEY,
  batch_id VARCHAR(50) UNIQUE NOT NULL,
  product_id INT NOT NULL,
  recipe_id INT NOT NULL,
  priority VARCHAR(50) NULL,
  start_time DATETIME NULL,
  end_time DATETIME NULL,
  status VARCHAR(50) NULL,
  assigned_employee_id INT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_prod_batches_product (product_id),
  INDEX idx_prod_batches_recipe (recipe_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS new_batch_production (
  id INT AUTO_INCREMENT PRIMARY KEY,
  batch_id VARCHAR(50) UNIQUE NOT NULL,
  product_id INT NOT NULL,
  recipe_id INT NOT NULL,
  category_id INT NULL,
  produced_by INT NULL,
  start_time DATETIME NULL,
  end_time DATETIME NULL,
  status VARCHAR(50) NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_new_batch_product (product_id),
  INDEX idx_new_batch_recipe (recipe_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS production_wastage (
  id INT AUTO_INCREMENT PRIMARY KEY,
  batch_id VARCHAR(50) NOT NULL,
  wastage_type VARCHAR(100) NOT NULL,
  quantity_wasted DECIMAL(10,2) NOT NULL,
  reason TEXT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_wastage_batch (batch_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS unsold_goods (
  id INT AUTO_INCREMENT PRIMARY KEY,
  product_id INT NOT NULL,
  quantity DECIMAL(10,2) NOT NULL,
  expiry_date DATE NULL,
  unit_id INT NULL,
  resolution VARCHAR(255) NULL,
  status VARCHAR(50) NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_unsold_product (product_id),
  INDEX idx_unsold_unit (unit_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS damaged_goods (
  id INT AUTO_INCREMENT PRIMARY KEY,
  product_name INT NOT NULL, -- stores product id in code
  category_id INT NULL,
  quantity DECIMAL(10,2) NOT NULL,
  product_category VARCHAR(255) NULL,
  damaged_date DATE NOT NULL,
  reported_by INT NULL,
  damage_type VARCHAR(100) NULL,
  location VARCHAR(255) NULL,
  resolution VARCHAR(255) NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_damaged_reported_by (reported_by)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ========== EXPENSES ==========
CREATE TABLE IF NOT EXISTS expense_category (
  id INT AUTO_INCREMENT PRIMARY KEY,
  expense_name VARCHAR(255) NOT NULL,
  expense_description TEXT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS expenses (
  id INT AUTO_INCREMENT PRIMARY KEY,
  expense_category_id INT NULL,
  category_name VARCHAR(255) NULL,
  reference VARCHAR(100) NULL,
  date DATE NULL,
  amount DECIMAL(10,2) NOT NULL,
  description TEXT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_expenses_category (expense_category_id),
  INDEX idx_expenses_date (date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ========== RBAC ==========
CREATE TABLE IF NOT EXISTS permissions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  permission_name VARCHAR(100) UNIQUE NOT NULL,
  permission_key VARCHAR(100) UNIQUE NOT NULL,
  module VARCHAR(50) NOT NULL,
  description TEXT,
  status ENUM('active','inactive') DEFAULT 'active',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS role_permissions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  role_id INT NOT NULL,
  permission_id INT NOT NULL,
  granted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  granted_by INT NULL,
  UNIQUE KEY unique_role_permission (role_id, permission_id),
  INDEX idx_role_permissions_role (role_id),
  INDEX idx_role_permissions_perm (permission_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS user_permissions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  permission_id INT NOT NULL,
  is_granted BOOLEAN DEFAULT TRUE,
  granted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  granted_by INT NULL,
  expires_at TIMESTAMP NULL,
  UNIQUE KEY unique_user_permission (user_id, permission_id),
  INDEX idx_user_permissions_user (user_id),
  INDEX idx_user_permissions_perm (permission_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ========== PAYMENTS (MPESA) ==========
CREATE TABLE IF NOT EXISTS stkresponse (
  id INT AUTO_INCREMENT PRIMARY KEY,
  result TEXT NULL,
  phone VARCHAR(50) NULL,
  amount DECIMAL(10,2) NULL,
  requestid VARCHAR(100) NULL,
  txncode VARCHAR(100) NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ========== SEED: CORE REFS AND EMPLOYEES (IDEMPOTENT) ==========

-- Departments
INSERT INTO `departments` (`id`, `department_name`)
VALUES
  (1, 'Sales'),
  (2, 'Production'),
  (3, 'Finance'),
  (4, 'Human Resources'),
  (5, 'Logistics')
ON DUPLICATE KEY UPDATE department_name = VALUES(department_name);

-- Designations
INSERT INTO `designation` (`id`, `designation_name`)
VALUES
  (1, 'Manager'),
  (2, 'Cashier'),
  (3, 'Baker'),
  (4, 'Driver'),
  (5, 'Accountant'),
  (6, 'HR Officer')
ON DUPLICATE KEY UPDATE designation_name = VALUES(designation_name);

-- Shared bcrypt hash for password: "Password@123"
SET @pwd := '$2y$10$qaYe5Aa9nKBa7IS8mkDWO.UZZwZexTyB5XrFC7kpEK.K4L/AGRs.i';

-- Employees (realistic data, valid dates, unique email/emp_code)
INSERT INTO `employees` (
  `first_name`,
  `last_name`,
  `email`,
  `contact_number`,
  `emp_code`,
  `dob`,
  `gender`,
  `nationality`,
  `joining_date`,
  `department_id`,
  `designation_id`,
  `blood_group`,
  `emergency_no_1`,
  `emergency_no_2`,
  `kra_pin`,
  `address`,
  `country`,
  `physical_address`,
  `city`,
  `zipcode`,
  `profile_photo`,
  `national_id`,
  `employee_status`,
  `user_role`,
  `password_hash`,
  `reset_token`,
  `reset_expires`
) VALUES
  ('John', 'Doe', 'john.doe@example.com', '+254700000001', 'SNK-EMP-001', '1990-05-12', 'Male', 'Kenyan', '2024-06-01', 1, 1, 'A+', '0700000001', '0700001001', 'A123456789D', 'P.O. Box 12345', 'Kenya', 'Westlands, Waiyaki Way', 'Nairobi', '00100', 'uploads/profiles/john_doe.jpg', '23456789', 1, NULL, @pwd, NULL, NULL),
  ('Jane', 'Smith', 'jane.smith@example.com', '+254700000002', 'SNK-EMP-002', '1992-08-21', 'Female', 'Kenyan', '2024-06-15', 1, 2, 'B+', '0700000002', '0700001002', 'B987654321K', 'P.O. Box 23456', 'Kenya', 'Kilimani, Ngong Rd', 'Nairobi', '00100', 'uploads/profiles/jane_smith.jpg', '34567890', 1, NULL, @pwd, NULL, NULL),
  ('Peter', 'Kimani', 'peter.kimani@example.com', '+254700000003', 'SNK-EMP-003', '1988-11-03', 'Male', 'Kenyan', '2024-07-01', 2, 3, 'O+', '0700000003', '0700001003', 'KRA12345678A', 'P.O. Box 34567', 'Kenya', 'Industrial Area, Likoni Rd', 'Nairobi', '00100', 'uploads/profiles/peter_kimani.jpg', '45678901', 1, NULL, @pwd, NULL, NULL),
  ('Aisha', 'Khan', 'aisha.khan@example.com', '+254700000004', 'SNK-EMP-004', '1995-02-14', 'Female', 'Kenyan', '2024-07-10', 3, 5, 'AB+', '0700000004', '0700001004', 'KRA87654321Z', 'P.O. Box 45678', 'Kenya', 'Upper Hill, Hospital Rd', 'Nairobi', '00100', 'uploads/profiles/aisha_khan.jpg', '56789012', 1, NULL, @pwd, NULL, NULL),
  ('Grace', 'Wanjiku', 'grace.wanjiku@example.com', '+254700000005', 'SNK-EMP-005', '1993-03-30', 'Female', 'Kenyan', '2024-08-01', 4, 6, 'A-', '0700000005', '0700001005', 'KRA11223344X', 'P.O. Box 56789', 'Kenya', 'Parklands, 3rd Ave', 'Nairobi', '00100', 'uploads/profiles/grace_wanjiku.jpg', '67890123', 1, NULL, @pwd, NULL, NULL),
  ('David', 'Otieno', 'david.otieno@example.com', '+254700000006', 'SNK-EMP-006', '1985-09-18', 'Male', 'Kenyan', '2024-08-15', 5, 4, 'B-', '0700000006', '0700001006', 'KRA55667788Y', 'P.O. Box 67890', 'Kenya', 'Embakasi, Airport North Rd', 'Nairobi', '00500', 'uploads/profiles/david_otieno.jpg', '78901234', 1, NULL, @pwd, NULL, NULL),
  ('Lucy', 'Njeri', 'lucy.njeri@example.com', '+254700000007', 'SNK-EMP-007', '1991-12-09', 'Female', 'Kenyan', '2024-09-01', 2, 3, 'O-', '0700000007', '0700001007', 'KRA66778899Q', 'P.O. Box 78901', 'Kenya', 'Donholm, Manyanja Rd', 'Nairobi', '00515', 'uploads/profiles/lucy_njeri.jpg', '89012345', 1, NULL, @pwd, NULL, NULL),
  ('Brian', 'Mwangi', 'brian.mwangi@example.com', '+254700000008', 'SNK-EMP-008', '1990-07-25', 'Male', 'Kenyan', '2024-09-10', 1, 2, 'A+', '0700000008', '0700001008', 'KRA77889900P', 'P.O. Box 89012', 'Kenya', 'CBD, Moi Ave', 'Nairobi', '00100', 'uploads/profiles/brian_mwangi.jpg', '90123456', 1, NULL, @pwd, NULL, NULL)
ON DUPLICATE KEY UPDATE
  first_name = VALUES(first_name),
  last_name = VALUES(last_name),
  contact_number = VALUES(contact_number),
  dob = VALUES(dob),
  gender = VALUES(gender),
  nationality = VALUES(nationality),
  joining_date = VALUES(joining_date),
  department_id = VALUES(department_id),
  designation_id = VALUES(designation_id),
  blood_group = VALUES(blood_group),
  emergency_no_1 = VALUES(emergency_no_1),
  emergency_no_2 = VALUES(emergency_no_2),
  kra_pin = VALUES(kra_pin),
  address = VALUES(address),
  country = VALUES(country),
  physical_address = VALUES(physical_address),
  city = VALUES(city),
  zipcode = VALUES(zipcode),
  profile_photo = VALUES(profile_photo),
  national_id = VALUES(national_id),
  employee_status = VALUES(employee_status),
  user_role = VALUES(user_role),
  password_hash = VALUES(password_hash),
  reset_token = VALUES(reset_token),
  reset_expires = VALUES(reset_expires);

COMMIT;
