-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2025 at 06:33 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bakery`
--

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` int(11) NOT NULL,
  `asset_name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `company_code` varchar(50) NOT NULL,
  `registration_number` varchar(50) NOT NULL,
  `initial_cost` decimal(10,2) NOT NULL,
  `current_cost` decimal(10,2) NOT NULL,
  `status` enum('Operational','Maintenance Required','Out of Service') NOT NULL,
  `next_maintenance` date NOT NULL,
  `ownership` enum('Owned','Leased') NOT NULL,
  `maintenance_cost` decimal(10,2) NOT NULL,
  `depreciation_factor` decimal(5,2) NOT NULL,
  `lifespan` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `serial_number` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id`, `asset_name`, `category_id`, `company_code`, `registration_number`, `initial_cost`, `current_cost`, `status`, `next_maintenance`, `ownership`, `maintenance_cost`, `depreciation_factor`, `lifespan`, `created_at`, `serial_number`) VALUES
(1, 'oven 100kg', 3, 'SNACK001', '123456HGF', 200.00, 150.00, 'Operational', '2025-03-03', 'Owned', 20.00, 0.06, 2, '2025-03-02 21:07:15', 'serial-12'),
(2, 'probox', 4, 'SNACK001', 'kbc 345d', 12000000.00, 1200000.00, 'Maintenance Required', '2025-03-12', 'Owned', 3000.00, 0.07, 35, '2025-03-02 21:29:57', 'sample serial');

-- --------------------------------------------------------

--
-- Table structure for table `asset_category`
--

CREATE TABLE `asset_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asset_category`
--

INSERT INTO `asset_category` (`id`, `category_name`, `category_description`, `status`, `created_at`) VALUES
(1, 'edwin', 'sample descriptions', 0, '2025-02-07 20:04:52'),
(2, 'trial 2', 'sample description', 1, '2025-02-07 20:13:12'),
(3, 'Big-utensils', 'sample description goes here', 1, '2025-02-27 20:18:55'),
(4, 'vehicles', 'list of all cars and motor vehicles', 1, '2025-02-27 22:27:19');

-- --------------------------------------------------------

--
-- Table structure for table `asset_replacement_policy`
--

CREATE TABLE `asset_replacement_policy` (
  `id` int(11) NOT NULL,
  `asset_id` int(11) DEFAULT NULL,
  `serial_number` varchar(255) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `policy_years` int(11) DEFAULT NULL,
  `replacement_date` date DEFAULT NULL,
  `current_value` decimal(10,2) DEFAULT NULL,
  `asset_condition` enum('New','Good','Fair','Needs Replacement') DEFAULT NULL,
  `policy_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asset_replacement_policy`
--

INSERT INTO `asset_replacement_policy` (`id`, `asset_id`, `serial_number`, `purchase_date`, `policy_years`, `replacement_date`, `current_value`, `asset_condition`, `policy_description`) VALUES
(1, 1, 'serial-12', '2025-03-04', 1, '2025-03-10', 150.00, 'Good', 'replaced after 1 year or when damaged');

-- --------------------------------------------------------

--
-- Table structure for table `capacity_management`
--

CREATE TABLE `capacity_management` (
  `id` int(11) NOT NULL,
  `asset_id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `max_capacity` int(11) NOT NULL,
  `current_usage` int(11) NOT NULL,
  `available_capacity` int(11) NOT NULL,
  `status` enum('Available','Near Limit','Overloaded') NOT NULL,
  `last_updated` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `capacity_management`
--

INSERT INTO `capacity_management` (`id`, `asset_id`, `category`, `max_capacity`, `current_usage`, `available_capacity`, `status`, `last_updated`, `created_at`) VALUES
(1, 1, 'smple asset category', 111, 80, 24, 'Near Limit', '2025-03-14', '2025-03-13 07:36:28');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `physical_address` text DEFAULT NULL,
  `town` varchar(100) DEFAULT NULL,
  `segment` enum('Retailer','Wholesaler','Distributor') NOT NULL,
  `city` varchar(100) DEFAULT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `payment_terms` enum('Cash','Credit') NOT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- Error reading data for table bakery.customers: #2006 - MySQL server has gone away
<div class="alert alert-danger" role="alert"><h1>Error</h1><p><strong>SQL query:</strong>  <a href="#" class="copyQueryBtn" data-text="SET SQL_QUOTE_SHOW_CREATE = 1">Copy</a>
<a href="index.php?route=/database/sql&sql_query=SET+SQL_QUOTE_SHOW_CREATE+%3D+1&show_query=1&db=bakery"><span class="text-nowrap"><img src="themes/dot.gif" title="Edit" alt="Edit" class="icon ic_b_edit">&nbsp;Edit</span></a>    </p>
<p>
<code class="sql"><pre>
SET SQL_QUOTE_SHOW_CREATE = 1
</pre></code>
</p>
<p>
    <strong>MySQL said: </strong><a href="./url.php?url=https%3A%2F%2Fdev.mysql.com%2Fdoc%2Frefman%2F8.0%2Fen%2Fserver-error-reference.html" target="mysql_doc"><img src="themes/dot.gif" title="Documentation" alt="Documentation" class="icon ic_b_help"></a>
</p>
<code>#2006 - MySQL server has gone away</code><br></div>