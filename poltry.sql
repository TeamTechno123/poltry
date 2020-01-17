-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2020 at 01:22 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `poltry`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(250) NOT NULL,
  `admin_email` varchar(150) NOT NULL,
  `admin_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'Techno', 'info@technothinksup.com', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `advertisement`
--

CREATE TABLE `advertisement` (
  `advertisement_id` bigint(20) NOT NULL,
  `company_id` bigint(20) NOT NULL,
  `advertisement_name` varchar(250) NOT NULL,
  `advertisement_details` varchar(250) NOT NULL,
  `advertisement_logo` varchar(250) NOT NULL,
  `advertisement_sdate` varchar(250) NOT NULL,
  `advertisement_edate` varchar(250) NOT NULL,
  `advertisement_status` varchar(20) NOT NULL DEFAULT 'active',
  `advertisement_addedby` varchar(150) NOT NULL,
  `advertisement_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `advertisement`
--

INSERT INTO `advertisement` (`advertisement_id`, `company_id`, `advertisement_name`, `advertisement_details`, `advertisement_logo`, `advertisement_sdate`, `advertisement_edate`, `advertisement_status`, `advertisement_addedby`, `advertisement_date`) VALUES
(4, 1, 'banner 3', 'banner image 3', 'advertise_information_4_1579153353.jpg', '02-01-2020', '16-01-2020', 'active', '1', '2020-01-16 05:42:33'),
(5, 1, 'banner', 'abcds', 'product_5_1579148220.jpg', '01-01-2020', '16-01-2020', 'active', '1', '2020-01-16 04:17:00');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `blog_id` int(10) NOT NULL,
  `company_id` bigint(20) NOT NULL,
  `blog_category_id` bigint(20) NOT NULL,
  `blog_info_name` varchar(255) NOT NULL,
  `blog_details` text NOT NULL,
  `blog_status` varchar(255) NOT NULL,
  `blog_addedby` varchar(150) NOT NULL,
  `blog_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`blog_id`, `company_id`, `blog_category_id`, `blog_info_name`, `blog_details`, `blog_status`, `blog_addedby`, `blog_date`) VALUES
(4, 1, 1, 'datta', '        <u><span style=\"font-weight: bold; color: rgb(255, 0, 0);\" arial=\"\" black\";=\"\" color:=\"\" rgb(57,=\"\" 132,=\"\" 198);\"=\"\">datta Mane</span></u>', 'Public', '1', '2020-01-17 11:45:09'),
(5, 1, 1, 'nikhil', '        <u><span style=\"font-weight: bold; color: rgb(255, 0, 0);\" arial=\"\" black\";=\"\" color:=\"\" rgb(57,=\"\" 132,=\"\" 198);\"=\"\">Nikhil Kamble</span></u>', 'Public', '1', '2020-01-17 11:51:00'),
(6, 1, 1, 'dhananjay', '  dhananjay sawant ', 'Public', '1', '2020-01-17 11:59:44');

-- --------------------------------------------------------

--
-- Table structure for table `blog_category`
--

CREATE TABLE `blog_category` (
  `blog_category_id` int(12) NOT NULL,
  `blog_category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog_category`
--

INSERT INTO `blog_category` (`blog_category_id`, `blog_category_name`) VALUES
(1, 'Goverment Scheme');

-- --------------------------------------------------------

--
-- Table structure for table `business`
--

CREATE TABLE `business` (
  `business_id` bigint(20) NOT NULL,
  `company_id` bigint(20) NOT NULL,
  `business_category_id` bigint(20) NOT NULL,
  `business_name` varchar(250) NOT NULL,
  `business_address` varchar(250) NOT NULL,
  `business_mobile1` varchar(250) NOT NULL,
  `business_mobile2` varchar(250) NOT NULL,
  `business_logo` varchar(250) NOT NULL,
  `business_email` varchar(250) NOT NULL,
  `business_website` varchar(250) NOT NULL,
  `working_hours` varchar(250) NOT NULL,
  `working_days` varchar(250) NOT NULL,
  `business_status` varchar(20) NOT NULL DEFAULT 'active',
  `business_addedby` varchar(150) NOT NULL,
  `business_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `business`
--

INSERT INTO `business` (`business_id`, `company_id`, `business_category_id`, `business_name`, `business_address`, `business_mobile1`, `business_mobile2`, `business_logo`, `business_email`, `business_website`, `working_hours`, `working_days`, `business_status`, `business_addedby`, `business_date`) VALUES
(12, 1, 6, 'Satyam Plywood', 'kagal', '9876543210', '1234567890', 'product_12_1579173055.png', 'dhananjay@mail.com', 'www.dhananjay.com', '20 hours', '20', 'active', '1', '2020-01-17 12:08:14'),
(13, 1, 9, 'Satyam Plywood 2', 'kolhapur', '123456789121', '12345678956', '', 'abc@mail.com', 'www.demo.com', '15 hours', '18', 'active', '1', '2020-01-16 11:35:43');

-- --------------------------------------------------------

--
-- Table structure for table `business_category`
--

CREATE TABLE `business_category` (
  `business_category_id` bigint(20) NOT NULL,
  `company_id` bigint(20) NOT NULL,
  `business_category_name` varchar(250) NOT NULL,
  `business_category_status` varchar(20) NOT NULL DEFAULT 'active',
  `business_category_addedby` varchar(150) NOT NULL,
  `business_category_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `business_category`
--

INSERT INTO `business_category` (`business_category_id`, `company_id`, `business_category_name`, `business_category_status`, `business_category_addedby`, `business_category_date`) VALUES
(6, 1, 'Business', 'active', '1', '2020-01-12 07:30:04'),
(8, 1, 'Business b', 'active', '1', '2020-01-16 07:10:37'),
(9, 1, 'Business c', 'active', '1', '2020-01-16 07:10:42');

-- --------------------------------------------------------

--
-- Table structure for table `business_trans`
--

CREATE TABLE `business_trans` (
  `business_trans_id` bigint(20) NOT NULL,
  `business_id` bigint(20) DEFAULT NULL,
  `business_type` varchar(250) NOT NULL,
  `product_category_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `business_trans_addedby` varchar(150) NOT NULL,
  `business_trans_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `business_trans`
--

INSERT INTO `business_trans` (`business_trans_id`, `business_id`, `business_type`, `product_category_id`, `product_id`, `business_trans_addedby`, `business_trans_date`) VALUES
(9, 12, 'Product', 6, 11, '', '2020-01-16 11:12:55'),
(10, 12, 'Service', 7, 12, '', '2020-01-17 12:08:14'),
(11, 13, 'Product', 6, 11, '', '2020-01-16 11:35:28');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_id` bigint(20) NOT NULL,
  `company_name` varchar(250) NOT NULL,
  `company_address` varchar(350) NOT NULL,
  `company_city` varchar(150) NOT NULL,
  `company_state` varchar(150) NOT NULL,
  `company_district` varchar(150) NOT NULL,
  `company_statecode` bigint(20) NOT NULL,
  `company_pincode` varchar(20) DEFAULT NULL,
  `company_mob1` varchar(12) NOT NULL,
  `company_mob2` varchar(12) NOT NULL,
  `company_email` varchar(150) NOT NULL,
  `company_website` varchar(150) NOT NULL,
  `company_pan_no` varchar(12) NOT NULL,
  `company_gst_no` varchar(100) NOT NULL,
  `company_lic1` varchar(150) NOT NULL,
  `company_lic2` varchar(150) NOT NULL,
  `company_start_date` varchar(15) NOT NULL,
  `company_end_date` varchar(15) NOT NULL,
  `company_logo` varchar(200) NOT NULL,
  `company_seal` varchar(150) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `company_name`, `company_address`, `company_city`, `company_state`, `company_district`, `company_statecode`, `company_pincode`, `company_mob1`, `company_mob2`, `company_email`, `company_website`, `company_pan_no`, `company_gst_no`, `company_lic1`, `company_lic2`, `company_start_date`, `company_end_date`, `company_logo`, `company_seal`, `date`) VALUES
(1, 'Poltry Demo', 'fghfgh dfgh', 'Kolhapur', 'Maharashtra', 'Kolhaput', 0, '111222', '9876543210', '9998887770', 'demo@email.com', 'www.ppp.com', '111', '222', '333', '444', '01-01-2019', '01-01-2021', '', '', '2020-01-08 10:44:07');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` bigint(20) NOT NULL,
  `company_id` bigint(20) NOT NULL,
  `product_type` varchar(250) NOT NULL,
  `product_category` bigint(20) NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `product_logo` varchar(250) NOT NULL,
  `product_status` varchar(20) NOT NULL DEFAULT 'active',
  `product_addedby` varchar(150) NOT NULL,
  `product_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `company_id`, `product_type`, `product_category`, `product_name`, `product_logo`, `product_status`, `product_addedby`, `product_date`) VALUES
(11, 1, 'Product', 6, 'Product 1', 'product_11_1579085029.jpg', 'active', '1', '2020-01-16 07:46:09'),
(12, 1, 'Service', 7, 'service 3', 'product_12_1579160086.png', 'active', '1', '2020-01-16 11:51:58'),
(13, 1, 'Service', 7, 'Shell Morlina S1 B 101', 'product_13_1579175018.png', 'active', '1', '2020-01-17 12:06:44'),
(14, 1, 'Product', 6, 'Shell Lubricunts', 'product_14_1579263151.png', 'active', '1', '2020-01-17 12:12:31');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `product_category_id` bigint(20) NOT NULL,
  `company_id` bigint(20) NOT NULL,
  `product_category_type` varchar(250) NOT NULL,
  `product_category_name` varchar(250) NOT NULL,
  `product_category_logo` varchar(250) NOT NULL,
  `product_category_status` varchar(20) NOT NULL DEFAULT 'active',
  `product_category_addedby` varchar(150) NOT NULL,
  `product_category_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`product_category_id`, `company_id`, `product_category_type`, `product_category_name`, `product_category_logo`, `product_category_status`, `product_category_addedby`, `product_category_date`) VALUES
(6, 1, 'Product', 'product 2', 'product_category_6_1579089265.jpg', 'active', '1', '2020-01-15 11:54:25'),
(7, 1, 'Service', 'Service 2', 'product_7_1579159782.png', 'active', '1', '2020-01-16 07:29:42');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` bigint(20) NOT NULL,
  `company_id` bigint(20) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  `roll_id` int(11) NOT NULL DEFAULT 2,
  `user_name` varchar(250) NOT NULL,
  `user_lastname` varchar(100) NOT NULL,
  `user_city` varchar(150) NOT NULL,
  `user_email` varchar(250) NOT NULL,
  `user_mobile` varchar(12) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_otp` varchar(10) DEFAULT NULL,
  `user_status` varchar(20) NOT NULL DEFAULT 'active',
  `user_addedby` varchar(100) NOT NULL,
  `user_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_admin` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `company_id`, `branch_id`, `roll_id`, `user_name`, `user_lastname`, `user_city`, `user_email`, `user_mobile`, `user_password`, `user_otp`, `user_status`, `user_addedby`, `user_date`, `is_admin`) VALUES
(1, 1, '', 1, 'Admin', '', 'Kolhapur', 'demo@email.com', '9876543210', '123456', NULL, 'active', 'Admin', '2020-01-08 09:55:02', 1),
(6, 1, '', 2, 'Datta Mane', '', 'Kop', '', '9673454383', '123456', NULL, 'active', '1', '2020-01-08 12:39:59', 0),
(7, 1, '', 2, 'vaibhav Patil', '', 'Kolhapur', '', '9876543211', '123456', NULL, 'active', '1', '2020-01-12 06:22:22', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `advertisement`
--
ALTER TABLE `advertisement`
  ADD PRIMARY KEY (`advertisement_id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`blog_id`);

--
-- Indexes for table `blog_category`
--
ALTER TABLE `blog_category`
  ADD PRIMARY KEY (`blog_category_id`);

--
-- Indexes for table `business`
--
ALTER TABLE `business`
  ADD PRIMARY KEY (`business_id`);

--
-- Indexes for table `business_category`
--
ALTER TABLE `business_category`
  ADD PRIMARY KEY (`business_category_id`);

--
-- Indexes for table `business_trans`
--
ALTER TABLE `business_trans`
  ADD PRIMARY KEY (`business_trans_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`product_category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `advertisement`
--
ALTER TABLE `advertisement`
  MODIFY `advertisement_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `blog_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `blog_category`
--
ALTER TABLE `blog_category`
  MODIFY `blog_category_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `business`
--
ALTER TABLE `business`
  MODIFY `business_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `business_category`
--
ALTER TABLE `business_category`
  MODIFY `business_category_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `business_trans`
--
ALTER TABLE `business_trans`
  MODIFY `business_trans_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `product_category_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
