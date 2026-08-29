-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2026 at 07:38 PM
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
-- Database: `ctg_inven_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `ctg_itp_inventory`
--

CREATE TABLE `ctg_itp_inventory` (
  `id` int(11) NOT NULL,
  `material_no` varchar(11) DEFAULT NULL,
  `material_title` varchar(40) NOT NULL,
  `unit` enum('Kg','Pcs') NOT NULL,
  `avl_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ctg_itp_inventory`
--

INSERT INTO `ctg_itp_inventory` (`id`, `material_no`, `material_title`, `unit`, `avl_qty`) VALUES
(1, 'CTG_RMN_001', 'Palm Sterine Oil', 'Kg', 180),
(3, 'CTG_RMN_003', 'PFAD', 'Kg', 200),
(5, 'CTG_RMN_005', 'Soya Fatty Acid', 'Kg', 200),
(6, 'CTG_RMN_006', 'Soap Stock', 'Kg', 200),
(7, 'CTG_RMN_007', 'Caustic Soda', 'Kg', 200),
(8, 'CTG_RMN_008', 'Sodium Silicate', 'Kg', 120),
(11, 'CTG_RMN_011', 'Dolomite Powder', 'Kg', 200),
(13, 'CTG_RMN_013', 'Sulphonic Acid', 'Kg', 200),
(14, 'CTG_RMN_014', 'Titanium Dioxide', 'Kg', 200),
(15, 'CTG_RMN_015', 'Magnesium Silicate - Talc', 'Kg', 200),
(16, 'CTG_RMN_016', 'Soda Ash', 'Kg', 170),
(18, 'CTG_RMN_018', 'Colour Green', 'Kg', 200),
(19, 'CTG_RMN_019', 'Sunflower Wax', 'Kg', 200),
(20, 'CTG_RMN_020', 'Perfume', 'Kg', 200),
(22, 'CTG_RMN_022', 'Water', 'Kg', 300),
(23, 'CTG_RMN_023', 'Acid Oil', 'Kg', 200);

--
-- Triggers `ctg_itp_inventory`
--
DELIMITER $$
CREATE TRIGGER `getRMN` BEFORE INSERT ON `ctg_itp_inventory` FOR EACH ROW BEGIN 
	INSERT INTO itp_value_tbl VALUES (NULL);
    SET NEW.material_no = CONCAT("CTG_RMN_", 
    LPAD(LAST_INSERT_ID(), 3, "0"));
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ctg_itp_status`
--

CREATE TABLE `ctg_itp_status` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ctg_itp_status`
--

-- --------------------------------------------------------

--
-- Table structure for table `ctg_po_status`
--

CREATE TABLE `ctg_po_status` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ctg_po_status`
--

-- --------------------------------------------------------

--
-- Table structure for table `ctg_products`
--

CREATE TABLE `ctg_products` (
  `id` int(11) NOT NULL,
  `sku` varchar(11) DEFAULT NULL,
  `prod_name` varchar(50) NOT NULL,
  `prod_category` varchar(50) NOT NULL,
  `prod_price` float(5,2) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ctg_products`
--

INSERT INTO `ctg_products` (`id`, `sku`, `prod_name`, `prod_category`, `prod_price`, `qty`) VALUES
(1, 'CTG_SKU_001', 'Skin Lotion', 'Cosmetics', 3.99, 900),
(2, 'CTG_SKU_002', 'Bathing Soap', 'Laundry', 2.78, 950),
(3, 'CTG_SKU_003', 'Vaseline', 'Cosmetics', 12.75, 960),
(4, 'CTG_SKU_004', 'Glycerine', 'Cosmetics', 1.36, 850),
(5, 'CTG_SKU_005', 'Candles', 'Home Fragrances', 13.99, 960),
(6, 'CTG_SKU_006', 'Hand Sanitiser', 'Bodycare', 15.47, 1000);

--
-- Triggers `ctg_products`
--
DELIMITER $$
CREATE TRIGGER `getSKU` BEFORE INSERT ON `ctg_products` FOR EACH ROW BEGIN 
	INSERT INTO sku_value_tbl VALUES (NULL);
    SET NEW.sku = CONCAT("CTG_SKU_", 
    LPAD(LAST_INSERT_ID(), 3, "0"));
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ctg_purchase_orders`
--

CREATE TABLE `ctg_purchase_orders` (
  `id` int(11) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `order_no` varchar(11) DEFAULT NULL,
  `customer_name` varchar(50) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `street_address` varchar(50) NOT NULL,
  `city_name` varchar(50) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `quantity_kg` decimal(4,0) NOT NULL,
  `unit_price` float(5,2) NOT NULL,
  `sum_price` float(8,2) NOT NULL,
  `status` enum('Pending','Approved') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ctg_purchase_orders`
--

--
-- Triggers `ctg_purchase_orders`
--
DELIMITER $$
CREATE TRIGGER `getPO` BEFORE INSERT ON `ctg_purchase_orders` FOR EACH ROW BEGIN 
	INSERT INTO po_value_tbl VALUES (NULL);
    SET NEW.order_no = CONCAT("CTG_PO_", 
    LPAD(LAST_INSERT_ID(), 3, "0"));
    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `getSts` BEFORE INSERT ON `ctg_purchase_orders` FOR EACH ROW BEGIN 
	INSERT INTO ctg_po_status VALUES (NULL);
    SET NEW.status = ("Pending");
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ctg_users`
--

CREATE TABLE `ctg_users` (
  `id` int(11) NOT NULL,
  `role` enum('System Administrator','Production Manager','Warehouse Manager','Wholesaler') NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ctg_users`
--

INSERT INTO `ctg_users` (`id`, `role`, `fullname`, `email`, `username`, `password`) VALUES
(1, 'System Administrator', 'Admin', 'admin@gmail.com', 'Admin1', 'bd7bb27790e19f12e9c053c9b3024de50b3b07f4'),
(2, 'Production Manager', 'Chris Alba', 'chri7@gmail.com', 'Chris22', '99495472a17fd54520339972bd90c139642d8745'),
(3, 'Warehouse Manager', 'Lia Jones', 'lia81@gmail.com', 'Lia_1981', '3a0c070caf8dafd86ef6205eab16eae2f022ebf2'),
(4, 'Wholesaler', 'Jordan Henderson', 'jordan14@gmail.com', 'Jordan_14', '9358c7fd4fa3f0d7b37b757a4448f1051dde4cba');

-- --------------------------------------------------------

--
-- Table structure for table `issue_to_production`
--

CREATE TABLE `issue_to_production` (
  `id` int(11) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `voucher_number` varchar(11) DEFAULT NULL,
  `department` varchar(50) NOT NULL,
  `production_batchno` varchar(11) DEFAULT NULL,
  `created_by` varchar(50) NOT NULL,
  `material_name` varchar(40) NOT NULL,
  `unit` enum('Kg','Pcs') NOT NULL,
  `itp_qty` int(11) NOT NULL,
  `itp_status` enum('Pending','Approved') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issue_to_production`
--

--
-- Triggers `issue_to_production`
--
DELIMITER $$
CREATE TRIGGER `getItpSts` BEFORE INSERT ON `issue_to_production` FOR EACH ROW BEGIN 
	INSERT INTO ctg_itp_status VALUES (NULL);
    SET NEW.itp_status = ("Pending");
    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `getPBN` BEFORE INSERT ON `issue_to_production` FOR EACH ROW BEGIN 
	INSERT INTO vn_value_tbl VALUES (NULL);
    SET NEW.production_batchno = CONCAT("CTG_PBN_", 
    LPAD(LAST_INSERT_ID(), 3, "0"));
    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `getVN` BEFORE INSERT ON `issue_to_production` FOR EACH ROW BEGIN 
	INSERT INTO vn_value_tbl VALUES (NULL);
    SET NEW.voucher_number = CONCAT("CTG_ITP_", 
    LPAD(LAST_INSERT_ID(), 3, "0"));
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `itp_value_tbl`
--

CREATE TABLE `itp_value_tbl` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `itp_value_tbl`
--

-- --------------------------------------------------------

--
-- Table structure for table `po_value_tbl`
--

CREATE TABLE `po_value_tbl` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `po_value_tbl`
--

INSERT INTO `po_value_tbl` (`id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10),
(11),
(12),
(13),
(14),
(15),
(16),
(17),
(18),
(19),
(20),
(21),
(22),
(23);

-- --------------------------------------------------------

--
-- Table structure for table `sku_value_tbl`
--

CREATE TABLE `sku_value_tbl` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sku_value_tbl`
--

-- --------------------------------------------------------

--
-- Table structure for table `soap_costing`
--

CREATE TABLE `soap_costing` (
  `id` int(11) NOT NULL,
  `material` varchar(30) NOT NULL,
  `uom` enum('Kg','Pcs') NOT NULL,
  `percent` float(5,2) NOT NULL,
  `price_per_kg` float(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `soap_costing`
--

INSERT INTO `soap_costing` (`id`, `material`, `uom`, `percent`, `price_per_kg`) VALUES
(3, 'Palm Sterine Oil', 'Kg', 34.50, 1.19),
(4, 'PFAD', 'Kg', 1.00, 1.19),
(5, 'Soya Fatty Acid', 'Kg', 6.50, 0.55),
(7, 'Soap Stock', 'Kg', 2.00, 0.11),
(8, 'Caustic Soda', 'Kg', 6.02, 0.70),
(9, 'Sodium Silicate', 'Kg', 9.01, 0.66),
(10, 'Dolomite Powder', 'Kg', 9.21, 0.03),
(11, 'Sulphonic Acid', 'Kg', 0.20, 2.27),
(12, 'Titanium Dioxide', 'Kg', 0.01, 3.28),
(13, 'Magnesium Silicate - Talc', 'Kg', 0.50, 0.43),
(14, 'Soda Ash', 'Kg', 0.20, 0.66),
(15, 'Colour Green', 'Kg', 0.10, 17.88),
(16, 'Sunflower Wax', 'Kg', 0.20, 0.07),
(17, 'Perfume', 'Kg', 0.05, 13.50),
(18, 'Water', 'Kg', 25.00, 1.00),
(19, 'Acid Oil', 'Kg', 5.50, 0.55);

-- --------------------------------------------------------

--
-- Table structure for table `vn_value_tbl`
--

CREATE TABLE `vn_value_tbl` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vn_value_tbl`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ctg_itp_inventory`
--
ALTER TABLE `ctg_itp_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ctg_itp_status`
--
ALTER TABLE `ctg_itp_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ctg_po_status`
--
ALTER TABLE `ctg_po_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ctg_products`
--
ALTER TABLE `ctg_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ctg_purchase_orders`
--
ALTER TABLE `ctg_purchase_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ctg_users`
--
ALTER TABLE `ctg_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issue_to_production`
--
ALTER TABLE `issue_to_production`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itp_value_tbl`
--
ALTER TABLE `itp_value_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `po_value_tbl`
--
ALTER TABLE `po_value_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sku_value_tbl`
--
ALTER TABLE `sku_value_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `soap_costing`
--
ALTER TABLE `soap_costing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vn_value_tbl`
--
ALTER TABLE `vn_value_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ctg_itp_inventory`
--
ALTER TABLE `ctg_itp_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `ctg_itp_status`
--
ALTER TABLE `ctg_itp_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ctg_po_status`
--
ALTER TABLE `ctg_po_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ctg_products`
--
ALTER TABLE `ctg_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ctg_purchase_orders`
--
ALTER TABLE `ctg_purchase_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ctg_users`
--
ALTER TABLE `ctg_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `issue_to_production`
--
ALTER TABLE `issue_to_production`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `itp_value_tbl`
--
ALTER TABLE `itp_value_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `po_value_tbl`
--
ALTER TABLE `po_value_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `sku_value_tbl`
--
ALTER TABLE `sku_value_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `soap_costing`
--
ALTER TABLE `soap_costing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `vn_value_tbl`
--
ALTER TABLE `vn_value_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
