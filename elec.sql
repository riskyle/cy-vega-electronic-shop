-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2023 at 03:59 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4




/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elec`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `prod_qty` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `cust_id`, `prod_id`, `prod_qty`, `created_at`) VALUES
(181, 49, 2055, 1, '2023-12-14 08:27:10');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `tag_name` varchar(200) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `topsales` tinyint(4) NOT NULL DEFAULT 0,
  `image` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `tag_name`, `description`, `status`, `topsales`, `image`, `created_at`) VALUES
(1029, 'Cables', 'Cables', 'cables ', 0, 1, '1701946151.jpg', '2023-12-07 10:49:11'),
(1030, 'Computer Case', 'case', 'case', 0, 1, '1701946191.jpg', '2023-12-07 10:49:51'),
(1031, 'Headsets', 'Headsets', 'head', 0, 1, '1701946220.jpg', '2023-12-07 10:50:20'),
(1032, 'Keyboards', 'Keyboards', 'key', 0, 1, '1701946263.jpg', '2023-12-07 10:51:03'),
(1033, 'Laptops', 'Laptops', 'laptops', 0, 1, '1701946287.jpg', '2023-12-07 10:51:27'),
(1034, 'Monitors', 'Monitors', 'moni', 0, 1, '1701946326.jpg', '2023-12-07 10:52:06'),
(1035, 'Mouse', 'Mouse', 'rat', 0, 1, 'Razer_Gaming_Mouse-removebg-preview.png', '2023-12-07 10:52:39'),
(1036, 'Computer Power Supply', 'Psu', 'psu', 0, 1, '1701946393.jpg', '2023-12-07 10:53:13'),
(1037, 'Iphones', 'Apple', 'app', 0, 1, '1701946430.jpg', '2023-12-07 10:53:50'),
(1038, 'Android', 'smartphone', 'smart', 0, 1, '1701946455.jpg', '2023-12-07 10:54:15'),
(1039, 'Storage', 'Storage', 'storage', 0, 1, '1701946490.jpg', '2023-12-07 10:54:50');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `tracking_no` varchar(200) NOT NULL,
  `cust_id` int(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `address` mediumtext NOT NULL,
  `postalcode` int(200) NOT NULL,
  `total_price` int(200) NOT NULL,
  `payment_mode` varchar(200) NOT NULL,
  `payment_id` varchar(200) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `comments` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `tracking_no`, `cust_id`, `name`, `email`, `phone`, `address`, `postalcode`, `total_price`, `payment_mode`, `payment_id`, `status`, `comments`, `created_at`) VALUES
(30, 'SFOS9149167743239', 49, 'dd', 'dagaangdanilojr@gmail.com', '09167743239', 'dd', 5800, 47700, 'Gcash', '', 0, NULL, '2023-12-11 13:36:19');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` varchar(200) NOT NULL,
  `prod_id` varchar(200) NOT NULL,
  `qty` int(200) NOT NULL,
  `price` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `prod_id`, `qty`, `price`, `created_at`) VALUES
(43, '30', '2053', 1, '47000', '2023-12-11 13:36:19'),
(44, '30', '2050', 1, '700', '2023-12-11 13:36:19');

-- --------------------------------------------------------

--
-- Stand-in structure for view `order_summary`
-- (See below for the actual view)
--
CREATE TABLE `order_summary` (
`created_at` timestamp
,`total_price` int(200)
);

-- --------------------------------------------------------

--
-- Table structure for table `tblproducts`
--

CREATE TABLE `tblproducts` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `tag_name` varchar(200) NOT NULL,
  `description` mediumtext NOT NULL,
  `original_price` varchar(15) NOT NULL,
  `selling_price` varchar(15) NOT NULL,
  `image` varchar(200) NOT NULL,
  `qty` int(15) NOT NULL,
  `status` tinyint(10) NOT NULL,
  `topsales` tinyint(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblproducts`
--

INSERT INTO `tblproducts` (`id`, `category_id`, `name`, `tag_name`, `description`, `original_price`, `selling_price`, `image`, `qty`, `status`, `topsales`, `created_at`) VALUES
(2041, 1029, 'type c ugreen', 'cables 1', 'typec', '450', '150', '1701946722.jpg', 19, 0, 1, '2023-12-07 10:58:42'),
(2042, 1029, 'Type C cord', 'cables 2eqeq2e', 'typewefrgdgrfedw', '450', '300', '1701946749.jpg', 20, 0, 1, '2023-12-07 10:59:09'),
(2043, 1029, 'type c cable strong', 'type c cable strong', 'cable', '200', '150', '1701946777.jpg', 19, 0, 1, '2023-12-07 10:59:37'),
(2044, 1030, 'Antec AX90 Mid Tower', 'Antec AX90 Mid Tower', 'Antec AX90 Mid Tower Tempered Glass Side Panel Gaming PC Case Black', '2000', '1800', '1701946824.jpg', 13, 0, 1, '2023-12-07 11:00:24'),
(2045, 1030, 'Gigabyte Aorus ', 'caseGigabyte Aorus ', 'Gigabyte Aorus C500 Black Mid Tower Tempered Glass Gaming PC Case', '3000', '2000', '1701946869.jpg', 15, 0, 1, '2023-12-07 11:01:09'),
(2046, 1030, 'RAKK DULUS', 'RAKK DULUS', 'RAKK DULUS Gaming PC Case Black', '1500', '100', '1701946903.jpg', 15, 0, 1, '2023-12-07 11:01:43'),
(2047, 1031, 'Fantech HG13', 'Fantech HG13', 'Fantech HG13 Chief Series Gaming Headset', '450', '200', '1701946946.jpg', 19, 0, 1, '2023-12-07 11:02:26'),
(2048, 1031, 'FANTECH Tone HQ52', 'HQ52 Headset', 'FANTECH Tone HQ52 Headset', '1500', '900', '1701946977.jpg', 19, 0, 1, '2023-12-07 11:02:57'),
(2049, 1031, 'Redragon Medea ', 'GamingRedragon Medea ', 'Redragon Medea Gaming Headset (H280)', '2000', '1800', '1701947016.jpg', 19, 0, 1, '2023-12-07 11:03:36'),
(2050, 1032, 'Fantech K512 Archer ', 'Fantech K512 Archer ', 'Fantech K512 Archer One-Handed USB', '1000', '700', '1701947054.jpg', 18, 0, 1, '2023-12-07 11:04:14'),
(2051, 1032, 'FANTECH K613L ', 'FANTECHFANTECH K613L ', 'FANTECH K613L Fighter.jpg', '1500', '900', '1701947090.jpg', 19, 0, 1, '2023-12-07 11:04:50'),
(2052, 1032, 'Royal Kludge RKG68 ', 'Royal Kludge RKG68 ', 'Royal Kludge RKG68 Tri Mode RGB 68 Keys Hot Swappable Mechanical Keyboard White.', '3000', '2500', '1701947131.jpg', 19, 0, 1, '2023-12-07 11:05:31'),
(2053, 1033, 'acer nitro 5', 'acer nitro 5', 'acer nitro 5', '50000', '47000', '1701947184.jpg', 13, 0, 1, '2023-12-07 11:06:24'),
(2054, 1033, 'aspire 3', 'aspire 3', 'aspire 3', '30000', '28000', '1701947223.jpg', 13, 0, 1, '2023-12-07 11:07:03'),
(2055, 0, 'aspire7_a715-42g_bl_bk_win11', 'aspire7_a715-42g_bl_bk_win11', 'aspire7_a715-42g_bl_bk_win11-01c.jpg', '50000', '45000', '1701947285.jpg', 12, 0, 1, '2023-12-07 11:08:05'),
(2056, 1033, 'ASUS Vivobook ', 'ASUS Vivobook ', 'ASUS Vivobook Go 12 L210, 11.6”HD', '60000', '57000', '1701947333.jpg', 8, 0, 1, '2023-12-07 11:08:53'),
(2057, 1033, 'ASUS-TUF-F15', 'ASUS-TUF-F15', 'ASUS-TUF-F15-Gaming-Laptop-15', '55000', '52000', '1701993899.jpg', 12, 0, 1, '2023-12-08 00:04:59'),
(2058, 1034, '24 inch Curved Screen ', '24 inch Curved Screen ', '24 inch Curved Screen Monitor PC', '15000', '13000', '1701993967.jpg', 10, 0, 1, '2023-12-08 00:06:07'),
(2059, 1034, '27MP400-W LG 27 ', 'monitor27MP400-W LG 27 ', '27MP400-W LG 27 (68.58 cms) IPS Full HD Monitor', '7000', '6500', '1701994011.jpg', 10, 0, 0, '2023-12-08 00:06:51'),
(2060, 0, 'LG 32GR93U', 'LG 32GR93U', 'LG 32GR93U-B computer monitor 80 cm', '14000', '13500', '1701994053.jpg', 10, 0, 1, '2023-12-08 00:07:33'),
(2061, 1035, 'ASUS ROG Pugio ', 'ASUS ROG Pugio ', 'ASUS ROG Pugio Gaming Mouse', '3500', '3200', '1701994099.jpg', 10, 0, 1, '2023-12-08 00:08:19'),
(2062, 1035, 'Fantech-CRYPTO-VX7', 'Fantech-CRYPTO-VX7', 'Fantech-CRYPTO-VX7-Gaming-Mouse.', '2000', '1700', '1701994136.jpg', 10, 0, 1, '2023-12-08 00:08:56'),
(2063, 0, 'Razer Basilisk V3 Pro', 'Razer Basilisk V3 Pro', 'Razer Basilisk V3 Pro Customizable Wireless Gaming', '4200', '3900', '1701994177.jpg', 10, 0, 1, '2023-12-08 00:09:37'),
(2064, 0, 'Razer Cobra Pro Wireless', 'mouseRazer Cobra Pro Wireless', 'Razer Cobra Pro Wireless Gaming Mouse', '5020', '4600', '1701994218.jpg', 10, 0, 1, '2023-12-08 00:10:18'),
(2065, 1036, 'ACE 500W ATX ', 'psu', 'ACE 500W ATX Gaming PC Power Supply PSU', '3000', '2800', '1701994264.jpg', 9, 0, 1, '2023-12-08 00:11:04'),
(2066, 1036, 'Black 500W 12CM', 'psu1', 'Black 500W 12CM Silent Fan PC Power Supply ATX', '2700', '2500', '1701994299.jpg', 10, 0, 1, '2023-12-08 00:11:39'),
(2067, 0, 'Corsair CV650 80 Plus Bronze', 'psu2', 'Corsair CV650 80 Plus Bronze Certified PSU 650W 80+ Rated ATX Power Supply Non-Modular', '3500', '3400', '1701994334.jpg', 10, 0, 1, '2023-12-08 00:12:14'),
(2068, 1037, 'iPhone 14 Pro ', 'iphone', 'Apple debuts iPhone 14 Pro and iPhone 14 Pro Max ', '80000', '79000', '1701994401.jpg', 4, 0, 1, '2023-12-08 00:13:21'),
(2069, 0, 'Apple iPhone 13 Pro (256gb)', 'Iphone2', 'Apple iPhone 13 Pro (256gb)', '50000', '49000', '1701994445.jpg', 10, 0, 1, '2023-12-08 00:14:05'),
(2070, 1037, 'Apple iPhone 14 Plus', 'Iphone14', 'Apple iPhone 14 Plus - 128GB - Black', '60000', '56990', '1701994511.jpg', 5, 0, 1, '2023-12-08 00:15:11'),
(2071, 1038, 'Oppo A16 (4GB+64GB)', 'androidssaa', 'Oppo A16 (4GB+64GB)', '5000', '4500', '1701994557.jpg', 5, 0, 1, '2023-12-08 00:15:57'),
(2072, 1038, 'realme C53 (6GB + 128GB) ', 'androidss', 'realme C53 (6GB + 128GB) Mighty Black', '6000', '5990', '1701994601.jpg', 5, 0, 1, '2023-12-08 00:16:41'),
(2073, 1038, 'realme 8i (6GB + 128GB)', 'android', 'realme 8i (6GB + 128GB) Stellar Purple', '5400', '4990', '1701994637.jpg', 5, 0, 0, '2023-12-08 00:17:17'),
(2074, 1038, 'Xiaomi Redmi Note 11 Pro 5G ', 'androiddd', 'Xiaomi Redmi Note 11 Pro 5G Atlantic Blue', '12000', '11500', '1701994680.jpg', 5, 0, 0, '2023-12-08 00:18:00'),
(2075, 1039, 'sandisk 16gb', 'storage', 'sandisk 16gb', '300', '250', '1701994735.jpg', 20, 0, 0, '2023-12-08 00:18:55'),
(2076, 1039, 'Kingston Fury Beast RGB 16GB', 'storageers', 'Kingston Fury Beast RGB 16GB White DDR4', '4500', '4000', '1701994768.jpg', 20, 0, 0, '2023-12-08 00:19:28'),
(2077, 1039, 'Kingston FURY™ Beast DDR5 RGB ', 'storagessaa', 'Kingston FURY™ Beast DDR5 RGB Memory – 8GB, 16GB, 32GB, 64GB,.jpg', '7000', '5500', '1701994808.jpg', 20, 0, 1, '2023-12-08 00:20:08'),
(2078, 0, 'KINGSTON NV2 1TB NVME', 'storagedawd', 'KINGSTON NV2 1TB NVME', '5000', '4600', '1701994841.jpg', 20, 0, 1, '2023-12-08 00:20:41'),
(2079, 0, 'TEAMGROUPT-CreateClassic10L', 'storagedw', 'TEAMGROUPT-CreateClassic10L-b_12', '4500', '4300', '1701994889.jpg', 20, 0, 0, '2023-12-08 00:21:29'),
(2080, 0, 'Samsung 980 Pro 2TB PCIE 4.0 NVME M.2 SSD', 'storageg', 'Samsung 980 Pro 2TB PCIE 4.0 NVME M.2 SSD', '4500', '4000', '1701994933.jpg', 20, 0, 0, '2023-12-08 00:22:13'),
(2081, 1039, 'Sandisk Cruzer Blade USB Flash Drive 2.0 32GB', 'storage23', 'Sandisk Cruzer Blade USB Flash Drive 2.0 32GB.jpg', '500', '450', '1701994980.jpg', 20, 0, 1, '2023-12-08 00:23:00'),
(2082, 1039, 'Kingston 16 GB DDR4 Laptop RAM', 'storage54', '3200MHz, SODIMM', '2000', '1800', '1701995054.jpg', 20, 0, 0, '2023-12-08 00:24:14'),
(2084, 1039, '	Memory Card 512gb', 'storage21', '	Memory Card 512gb', '450', '400', '1702271528.jpg', 20, 0, 0, '2023-12-11 05:12:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role_as` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `role_as`, `created_at`) VALUES
(49, 'Dan Dagaang', 'dagaangdanilojr@gmail.com', '09167743239', '6fb40cfa74fb2d9ee3cf93f0d975238e', 0, '2023-12-11 13:22:43'),
(50, 'Danilo Admin', 'admin@gmail.com', '09167743239', '6fb40cfa74fb2d9ee3cf93f0d975238e', 1, '2023-12-11 13:26:22');

-- --------------------------------------------------------

--
-- Structure for view `order_summary`
--
DROP TABLE IF EXISTS `order_summary`;


--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblproducts`
--
ALTER TABLE `tblproducts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1040;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tblproducts`
--
ALTER TABLE `tblproducts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2085;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
