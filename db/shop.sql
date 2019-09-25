-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2019 at 10:03 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`) VALUES
(7, 'Samsang'),
(8, 'Lenevo'),
(9, 'Sony'),
(10, 'Symphony'),
(11, 'Asus');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `cart_id` int(11) NOT NULL,
  `session_id` varchar(200) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `product_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`cart_id`, `session_id`, `product_id`, `product_name`, `price`, `quantity`, `product_image`) VALUES
(1, 'e4h9sdjjmdc8bli56arnp0adak', 13, 'Camera', 0, 5260, 'upload/4f4abe4655.jpg'),
(2, 'e4h9sdjjmdc8bli56arnp0adak', 13, 'Camera', 0, 5260, 'upload/4f4abe4655.jpg'),
(3, 'e4h9sdjjmdc8bli56arnp0adak', 13, 'Camera', 5260, 2, 'upload/4f4abe4655.jpg'),
(4, 'e4h9sdjjmdc8bli56arnp0adak', 13, 'Camera', 5260, 3, 'upload/4f4abe4655.jpg'),
(5, 'e4h9sdjjmdc8bli56arnp0adak', 13, 'Camera', 5260, 3, 'upload/4f4abe4655.jpg'),
(6, 'e4h9sdjjmdc8bli56arnp0adak', 13, 'Camera', 5260, 1, 'upload/4f4abe4655.jpg'),
(7, 'e4h9sdjjmdc8bli56arnp0adak', 13, 'Camera', 5260, 2, 'upload/4f4abe4655.jpg'),
(8, 'e4h9sdjjmdc8bli56arnp0adak', 12, 'Symphony P7', 1250, 4, 'upload/d8fc6fc651.jpg'),
(9, 'e4h9sdjjmdc8bli56arnp0adak', 12, 'Symphony P7', 1250, 4, 'upload/d8fc6fc651.jpg'),
(10, 'e4h9sdjjmdc8bli56arnp0adak', 12, 'Symphony P7', 1250, 1, 'upload/d8fc6fc651.jpg'),
(11, 'e4h9sdjjmdc8bli56arnp0adak', 12, 'Symphony P7', 1250, 3, 'upload/d8fc6fc651.jpg'),
(12, 'e4h9sdjjmdc8bli56arnp0adak', 12, 'Symphony P7', 1250, 1, 'upload/d8fc6fc651.jpg'),
(13, 'e4h9sdjjmdc8bli56arnp0adak', 12, 'Symphony P7', 1250, 1, 'upload/d8fc6fc651.jpg'),
(14, 'e4h9sdjjmdc8bli56arnp0adak', 12, 'Symphony P7', 1250, 3, 'upload/d8fc6fc651.jpg'),
(15, 'e4h9sdjjmdc8bli56arnp0adak', 13, 'Camera', 5260, 3, 'upload/4f4abe4655.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`) VALUES
(5, 'Cloths'),
(6, 'Cloths'),
(7, 'Educaiton'),
(8, 'Vehicle'),
(9, 'updated vehicle part'),
(10, 'Tea Shirts'),
(12, 'New Category'),
(13, 'Mobile'),
(14, 'Computer'),
(15, 'By Cicle');

-- --------------------------------------------------------

--
-- Table structure for table `products2`
--

CREATE TABLE `products2` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `product_price` float NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_type` tinyint(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products2`
--

INSERT INTO `products2` (`product_id`, `product_name`, `cat_id`, `brand_id`, `description`, `product_price`, `product_image`, `product_type`) VALUES
(5, 'second product', 7, 2, '<p>This is a second product description</p>', 1000, 'upload/7d397f94b9.jpg', 0),
(6, 'second product', 7, 2, '<p>updated</p>', 1000, 'upload/fc829733dd.png', 1),
(9, 'Camera', 12, 4, '<p>This is a very nice camera</p>', 1000, 'upload/c56772b34b.jpg', 0),
(10, 'Ice cream', 7, 6, '<p><span>At this point, your project working directory is exactly the way it was before you started working on issue #53, and you can concentrate on your hotfix. This is an important point to remember: when you switch branches,</span></p>', 12500, 'upload/ebd7c3f79a.png', 1),
(11, 'Test product', 8, 5, '<p>This is a product for testing file</p>', 1253, 'upload/2f95c50218.jpg', 0),
(12, 'Symphony P7', 13, 8, '<p><span>If we do the same example using the&nbsp;</span><code class=\"w3-codespan\">require</code><span>&nbsp;statement, the echo statement will not be executed because the script execution dies after the&nbsp;</span><code class=\"w3-codespan\">require</code><span>&nbsp;statement returned a fatal error&nbsp;not be executed because the script execution dies after the&nbsp;<code class=\"w3-codespan\">require</code>&nbsp;statement returned a fatal error</span></p>', 1250, 'upload/d8fc6fc651.jpg', 1),
(13, 'Camera', 13, 9, '<p><span>The page/output always&nbsp;</span><em>follows</em><span>&nbsp;the headers. PHP has to pass the headers to the webserver first. It can only do that once. After the double linebreak it can nevermore amend them.</span></p>\r\n<p><span>&nbsp;PHP has to pass the headers to the webserver first. It can only do that once. After the double linebreak it can nevermore amend them.</span></p>', 5260, 'upload/4f4abe4655.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `adminId` int(11) NOT NULL,
  `adminName` varchar(200) NOT NULL,
  `adminUser` varchar(200) NOT NULL,
  `adminEmail` varchar(200) NOT NULL,
  `adminPass` varchar(20) NOT NULL,
  `status` tinyint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`adminId`, `adminName`, `adminUser`, `adminEmail`, `adminPass`, `status`) VALUES
(1, 'mamun', 'mamun2', 'mamun23r@gmail.com', 'asdfg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `products2`
--
ALTER TABLE `products2`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`adminId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `products2`
--
ALTER TABLE `products2`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
