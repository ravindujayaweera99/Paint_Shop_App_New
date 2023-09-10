-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2023 at 11:05 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paintshopdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `time` datetime NOT NULL,
  `Id` int(11) NOT NULL,
  `customer_name` text NOT NULL,
  `total_value` double NOT NULL,
  `included_vat` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `creditcustomers`
--

CREATE TABLE `creditcustomers` (
  `customer_nic` text NOT NULL,
  `customer_name` text NOT NULL,
  `credit_limit` float NOT NULL,
  `current_credit` float NOT NULL,
  `remaining_credit` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `creditcustomers`
--

INSERT INTO `creditcustomers` (`customer_nic`, `customer_name`, `credit_limit`, `current_credit`, `remaining_credit`) VALUES
('992723068v', 'New Customer', 500000, 0, 500000);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_code` int(11) NOT NULL,
  `customer_name` text NOT NULL,
  `address` text NOT NULL,
  `tel_no` text NOT NULL,
  `contact_person` text NOT NULL,
  `tel_no_contact_person` text NOT NULL,
  `nic` text NOT NULL,
  `credit_limit` float NOT NULL,
  `vat_or_non_vat` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_code`, `customer_name`, `address`, `tel_no`, `contact_person`, `tel_no_contact_person`, `nic`, `credit_limit`, `vat_or_non_vat`, `time`) VALUES
(1, 'New Customer', 'Kandy', '0000000000', 'Test', '0000000000', '992723068v', 500000, 'vat', '2023-07-25 15:49:43');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `type` text NOT NULL,
  `description` text NOT NULL,
  `month` text NOT NULL,
  `amount` float NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `getpurchase`
--

CREATE TABLE `getpurchase` (
  `purchase_id` int(11) NOT NULL,
  `item_code` text NOT NULL,
  `supplier_id` text NOT NULL,
  `item_name` text NOT NULL,
  `item_type` text NOT NULL,
  `volume` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` double NOT NULL,
  `discount` double NOT NULL,
  `total_cost` double NOT NULL,
  `description` text NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `getpurchase`
--

INSERT INTO `getpurchase` (`purchase_id`, `item_code`, `supplier_id`, `item_name`, `item_type`, `volume`, `quantity`, `unit_price`, `discount`, `total_cost`, `description`, `time`) VALUES
(1, 'Test Item', 'Test Supplier ', 'Test Name', 'Test Type', 2, 5, 2500, 5, 59375, '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(11) NOT NULL,
  `included_vat` float NOT NULL,
  `total` float NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `included_vat`, `total`, `time`) VALUES
(1, 2375, 356.25, '2023-08-03 10:04:12'),
(2, 2375, 356.25, '2023-08-03 10:10:52'),
(3, 2375, 356.25, '2023-08-03 10:15:29'),
(4, 2375, 356.25, '2023-08-18 04:57:49');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `supplier_id` text NOT NULL,
  `item_code` text NOT NULL,
  `item_name` text NOT NULL,
  `item_type` text NOT NULL,
  `volume` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` float NOT NULL,
  `discount` float NOT NULL,
  `cost` float NOT NULL,
  `total_cost` float NOT NULL,
  `description` longtext NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`supplier_id`, `item_code`, `item_name`, `item_type`, `volume`, `quantity`, `unit_price`, `discount`, `cost`, `total_cost`, `description`, `time`) VALUES
('Test Supplier ', 'Test Item', 'Test Name', 'Test Type', 2, 5, 2500, 5, 11875, 59375, '', '2023-07-25 16:26:42');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `item_code` text NOT NULL,
  `supplier_id` text NOT NULL,
  `item_name` text NOT NULL,
  `item_type` text NOT NULL,
  `volume` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `min_qty` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `net_value` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`item_code`, `supplier_id`, `item_name`, `item_type`, `volume`, `quantity`, `min_qty`, `unit_price`, `discount`, `net_value`, `time`) VALUES
('1', 'Test Supplier ', 'Test Name', 'Emalsion', 2, -359, 5, 2500, 5, 2375, '2023-08-22 20:21:43'),
('2', 'Nippon', 'White ', 'Enamal', 3, 1420, 6, 500, 5, 475, '2023-08-22 20:21:43'),
('3', 'Nippon', 'White ', 'Emalsion', 3, 1450, 5, 1500, 3, 1455, '2023-08-22 20:21:43'),
('4', 'Nippon4', 'White4 ', 'Enamal', 3, 1450, 5, 1500, 3, 1455, '2023-08-22 20:21:43'),
('5', 'Nippon5', 'White5 ', 'Weather', 3, 1450, 5, 1500, 3, 1455, '2023-08-22 20:21:43'),
('6', 'Nippon6', 'White6 ', 'Emalsion', 3, 1450, 5, 1500, 3, 1455, '2023-08-22 20:21:43'),
('7', 'Nippon', 'White7 ', 'Emalsion', 3, 1450, 5, 1500, 3, 1455, '2023-08-22 20:21:43'),
('8', 'Nippon8', 'White8 ', 'Weather', 3, 1450, 5, 1500, 3, 1455, '2023-08-22 20:21:43'),
('9', 'Nippon9', 'White9 ', 'Weather', 3, 1450, 5, 1500, 3, 1455, '2023-08-22 20:21:43'),
('10', 'Nippon10', 'White10 ', 'Enamal', 3, 1450, 5, 1500, 3, 1455, '2023-08-22 20:21:43'),
('11', 'Nippon11', 'White11 ', 'Enamal', 3, 1450, 5, 1500, 3, 1455, '2023-08-22 20:21:43'),
('12', 'Nippon12', 'White12 ', 'Emalsion', 3, 1450, 5, 1500, 3, 1455, '2023-08-22 20:21:43'),
('13', 'Nippon13', 'White13 ', 'Emalsion', 3, 1450, 5, 1500, 3, 1455, '2023-08-22 20:21:43'),
('14', 'test', 'test name', 'Wood', 2, 4, 2, 400, 3, 388, '2023-08-22 20:25:19');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_code` int(11) NOT NULL,
  `supplier_name` text NOT NULL,
  `short_code` text NOT NULL,
  `address` text NOT NULL,
  `tel_no` varchar(10) NOT NULL,
  `contact_person` text NOT NULL,
  `tel_no_contact_person` varchar(10) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `temporarystock`
--

CREATE TABLE `temporarystock` (
  `purchase_id` int(11) NOT NULL,
  `supplier_id` text NOT NULL,
  `item_code` text NOT NULL,
  `item_name` text NOT NULL,
  `item_type` text NOT NULL,
  `volume` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `discount` decimal(10,0) NOT NULL,
  `cost` float NOT NULL,
  `total_cost` int(11) NOT NULL,
  `description` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `temporarystock`
--

INSERT INTO `temporarystock` (`purchase_id`, `supplier_id`, `item_code`, `item_name`, `item_type`, `volume`, `quantity`, `unit_price`, `discount`, `cost`, `total_cost`, `description`, `time`) VALUES
(1, 'Test Supplier ', 'Test Item', 'Test Name', 'Test Type', 2, 5, 2500, '5', 11875, 59375, '', '2023-07-25 16:26:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_type` enum('admin','cashier','','') NOT NULL,
  `user_code` text NOT NULL,
  `name` text NOT NULL,
  `psw` text NOT NULL,
  `repeat_password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_type`, `user_code`, `name`, `psw`, `repeat_password`) VALUES
('admin', 'Admin', 'AA', 'aaa', 'aaa'),
('cashier', 'CC', 'CC', 'ccc', 'ccc');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `creditcustomers`
--
ALTER TABLE `creditcustomers`
  ADD UNIQUE KEY `customer_nic` (`customer_nic`) USING HASH;

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_code`),
  ADD UNIQUE KEY `nic` (`nic`) USING HASH;

--
-- Indexes for table `getpurchase`
--
ALTER TABLE `getpurchase`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_code`),
  ADD UNIQUE KEY `short_code` (`short_code`) USING HASH;

--
-- Indexes for table `temporarystock`
--
ALTER TABLE `temporarystock`
  ADD PRIMARY KEY (`purchase_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `getpurchase`
--
ALTER TABLE `getpurchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_code` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temporarystock`
--
ALTER TABLE `temporarystock`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
