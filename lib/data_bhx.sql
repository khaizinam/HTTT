-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2021 at 01:10 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `data_bhx`
--

-- --------------------------------------------------------

--
-- Table structure for table `hang_hoa`
--

CREATE TABLE `hang_hoa` (
  `ID` int(50) NOT NULL,
  `supplier_name` text NOT NULL,
  `productID` int(50) NOT NULL,
  `quantity` int(255) NOT NULL,
  `invenID` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hang_hoa`
--

INSERT INTO `hang_hoa` (`ID`, `supplier_name`, `productID`, `quantity`, `invenID`) VALUES
(12, '', 1, 25, 3);

-- --------------------------------------------------------

--
-- Table structure for table `kho_hang`
--

CREATE TABLE `kho_hang` (
  `ID` int(20) NOT NULL,
  `ten_kho` varchar(600) NOT NULL,
  `adress` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kho_hang`
--

INSERT INTO `kho_hang` (`ID`, `ten_kho`, `adress`) VALUES
(1, '[value-2]', '[value-3]'),
(2, 'khai', 'myhome'),
(3, 'kho hàng nươc uống', 'bình Thạnh'),
(4, 'kho hàng thức ăn', ''),
(5, 'thiên bình an', ''),
(6, 'Thiên Hòa Phước', '');

-- --------------------------------------------------------

--
-- Table structure for table `nhan_vien`
--

CREATE TABLE `nhan_vien` (
  `ID` varchar(20) NOT NULL,
  `roleID` varchar(50) NOT NULL,
  `full_name` varchar(500) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `phone_number` varchar(12) NOT NULL,
  `email` varchar(500) NOT NULL,
  `username` varchar(500) NOT NULL,
  `user_password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `orderID` int(50) NOT NULL,
  `product_ID` int(50) NOT NULL,
  `quantity` int(255) NOT NULL,
  `invenID` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `phieu_xuat_nhap`
--

CREATE TABLE `phieu_xuat_nhap` (
  `ID` int(200) NOT NULL,
  `userID` varchar(100) NOT NULL,
  `order_type` varchar(500) NOT NULL,
  `order_status` varchar(500) NOT NULL,
  `order_reason` text NOT NULL,
  `createAt` date NOT NULL,
  `updateAt` date NOT NULL,
  `details` text NOT NULL,
  `order_address` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `phieu_xuat_nhap`
--

INSERT INTO `phieu_xuat_nhap` (`ID`, `userID`, `order_type`, `order_status`, `order_reason`, `createAt`, `updateAt`, `details`, `order_address`) VALUES
(1, '', 'order_type', 'done', 'order_reaso', '0000-00-00', '0000-00-00', 'details', ''),
(2, '', 'import', '', '', '0000-00-00', '0000-00-00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ID` int(50) NOT NULL,
  `product_name` text NOT NULL,
  `product_description` text NOT NULL,
  `product_type` varchar(200) NOT NULL,
  `details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ID`, `product_name`, `product_description`, `product_type`, `details`) VALUES
(1, 'Máy tính', 'Dell HP pro max 13 ip', 'Lap TOP', 'IDK but i know'),
(2, 'khaizibnam', '', '', ''),
(3, 'Máy bảng', '', '', ''),
(4, 'tôi ', 'no', 'tôi', 'không'),
(5, 'mee', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hang_hoa`
--
ALTER TABLE `hang_hoa`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `invenID` (`invenID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `kho_hang`
--
ALTER TABLE `kho_hang`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `nhan_vien`
--
ALTER TABLE `nhan_vien`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD KEY `orderID` (`orderID`),
  ADD KEY `order_item_ibfk_2` (`product_ID`),
  ADD KEY `invenID` (`invenID`);

--
-- Indexes for table `phieu_xuat_nhap`
--
ALTER TABLE `phieu_xuat_nhap`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hang_hoa`
--
ALTER TABLE `hang_hoa`
  MODIFY `ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `kho_hang`
--
ALTER TABLE `kho_hang`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `phieu_xuat_nhap`
--
ALTER TABLE `phieu_xuat_nhap`
  MODIFY `ID` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hang_hoa`
--
ALTER TABLE `hang_hoa`
  ADD CONSTRAINT `hang_hoa_ibfk_1` FOREIGN KEY (`invenID`) REFERENCES `kho_hang` (`ID`),
  ADD CONSTRAINT `hang_hoa_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `product` (`ID`);

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`product_ID`) REFERENCES `hang_hoa` (`ID`),
  ADD CONSTRAINT `order_item_ibfk_2` FOREIGN KEY (`product_ID`) REFERENCES `product` (`ID`),
  ADD CONSTRAINT `order_item_ibfk_3` FOREIGN KEY (`invenID`) REFERENCES `kho_hang` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
