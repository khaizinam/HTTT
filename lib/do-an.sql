-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2021 at 01:24 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `do-an`
--

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `sku` varchar(100) NOT NULL,
  `supplier` varchar(100) NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `warehouse_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `name`, `sku`, `supplier`, `product_id`, `warehouse_id`, `quantity`) VALUES
(1, 'Dell XPS 15 9500', 'DXPS159500Q10301121', 'Dell', 2, 1, 2500),
(2, 'Dell XPS 13 9500', 'DXPS139500QBD281121', 'Dell', 7, 3, 900),
(3, 'Dell XPS 15 9510', 'DXPS159510Q01281121', 'Dell', 2, 2, 1500),
(4, 'Dell XPS 13 9510', 'DXPS139510QBD291121', 'Dell', 7, 3, 1500),
(5, 'Dell XPS 15 9570', 'DXPS159570Q01291121', 'Dell', 2, 2, 2500),
(6, 'Acer Aspire 5 a514', 'AA5a514Q10301121', 'Acer', 9, 1, 928),
(7, 'Acer Aspire 5 a515', 'AA5a515QBD301121', 'Acer', 9, 3, 1699),
(15, 'Acer Aspire 7 a515', 'AA7a515Q01011221', 'Acer', 10, 2, 801),
(16, 'Dell XPS 15 9570', 'DXPS159570Q01021221', 'Dell', 7, 2, 500),
(17, 'Acer Aspire 7 a514', 'AA7a514QBD021221', 'Acer', 10, 3, 1649),
(18, 'Neville Melton', 'Ullamco consequatur', 'In labore officia ip', 9, 5, 445),
(19, 'Michelle Ramsey', 'Exercitation occaeca', 'Ea ab cupiditate et ', 10, 1, 213),
(20, 'Nora Kerr', 'Dicta dolores autem ', 'Tenetur facere asper', 9, 2, 1248),
(21, 'Eliana Merrill', 'Voluptate explicabo', 'Inventore tempor exe', 7, 3, 348),
(22, 'Vincent Frye', 'Voluptate corporis u', 'Praesentium harum et', 14, 1, 384),
(23, 'Jocelyn Stanton', 'Sunt possimus eius', 'Enim dolor qui offic', 10, 1, 478);

--
-- Triggers `item`
--
DELIMITER $$
CREATE TRIGGER `check_product_quantity` AFTER UPDATE ON `item` FOR EACH ROW UPDATE product SET quantity = (SELECT SUM(quantity) FROM item WHERE product_id = NEW.product_id) WHERE id = NEW.product_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `check_product_quantity1` AFTER INSERT ON `item` FOR EACH ROW UPDATE product
    SET quantity = (SELECT SUM(quantity) FROM item WHERE product_id = NEW.product_id)
    WHERE id = NEW.product_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `check_product_quantity2` AFTER DELETE ON `item` FOR EACH ROW UPDATE product SET quantity = (SELECT SUM(quantity) FROM item WHERE product_id = OLD.product_id) WHERE id = OLD.product_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `check_product_quantity3` AFTER UPDATE ON `item` FOR EACH ROW UPDATE product SET quantity = (SELECT SUM(quantity) FROM item WHERE product_id = OLD.product_id) WHERE id = OLD.product_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_id`, `item_id`, `quantity`) VALUES
(12, 1, 5),
(12, 2, 5),
(12, 3, 5),
(13, 3, 3),
(14, 1, 100),
(14, 4, 50),
(14, 5, 30),
(15, 2, 50),
(15, 3, 100),
(15, 4, 1050),
(15, 5, 200),
(16, 3, 220),
(16, 5, 170),
(17, 7, 900),
(18, 1, 800),
(18, 5, 700),
(18, 17, 600),
(19, 1, 1),
(19, 2, 1),
(19, 3, 1),
(19, 4, 1),
(19, 5, 1),
(19, 6, 1),
(19, 7, 1),
(19, 15, 1),
(19, 17, 1),
(19, 18, 3),
(19, 19, 1),
(19, 20, 1),
(19, 21, 1),
(20, 1, 500),
(20, 2, 86),
(20, 3, 600),
(20, 4, 14),
(20, 5, 800),
(20, 6, 29),
(20, 7, 50),
(20, 15, 602),
(20, 17, 150),
(20, 18, 318),
(20, 19, 437),
(20, 20, 200),
(20, 21, 90),
(21, 1, 800),
(21, 3, 350),
(21, 5, 900),
(21, 7, 250),
(21, 20, 520),
(22, 1, 399),
(22, 2, 35),
(22, 3, 249),
(22, 4, 13),
(22, 5, 899),
(23, 18, 500),
(23, 19, 500),
(23, 21, 500),
(23, 23, 250),
(24, 1, 500),
(24, 2, 500),
(24, 3, 500),
(24, 4, 500),
(24, 5, 500);

-- --------------------------------------------------------

--
-- Table structure for table `order_table`
--

CREATE TABLE `order_table` (
  `id` int(10) UNSIGNED NOT NULL,
  `userID` int(10) UNSIGNED NOT NULL,
  `order_type` int(11) NOT NULL,
  `order_reason` varchar(255) NOT NULL,
  `order_details` varchar(255) NOT NULL,
  `order_address` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_table`
--

INSERT INTO `order_table` (`id`, `userID`, `order_type`, `order_reason`, `order_details`, `order_address`, `order_date`) VALUES
(12, 1, 1, 'Cillum est consequat', 'Ea est minima praese', 'Quia velit asperior', '2021-11-29 07:23:13'),
(13, 1, 1, 'Dicta incidunt odit', 'Dignissimos reiciend', 'Rerum sunt dolore su', '2021-11-29 04:59:41'),
(14, 1, 1, 'Test Order', 'Details con cệc', '25 Phan Đăng Lưu', '2021-11-30 03:35:02'),
(15, 1, 2, 'Cho sinh viên bách khoa', 'Test order xuất', 'Dĩ An Bình Dương', '2021-11-30 04:39:49'),
(16, 1, 1, 'Iusto cum sit conse', 'Adipisci velit duis ', 'Ipsum est error sit', '2021-11-30 05:52:22'),
(17, 1, 1, 'Test trigger', 'Use to test', 'Kí túc xá khu A ĐHQG', '2021-12-01 04:50:02'),
(18, 1, 1, 'Numquam exercitation', 'Nihil aspernatur per', 'Illum ad sint ea in', '2021-12-02 03:07:56'),
(19, 2, 2, 'In eum fuga Incidid', 'Dolore debitis ullam', 'Amet voluptas volup', '2021-12-03 07:07:55'),
(20, 2, 1, 'Dolorem reiciendis n', 'Accusamus harum sit', 'Aut duis libero cum ', '2021-12-03 07:10:29'),
(21, 1, 1, 'Sed tempora dolor la', 'Voluptatibus officii', 'Natus ipsa odio aut', '2021-12-03 09:35:27'),
(22, 1, 2, 'Quibusdam expedita u', 'Quidem blanditiis im', 'Voluptatem incididun', '2021-12-03 09:36:34'),
(23, 1, 2, 'Dolor est do corpor', 'In maiores in fuga ', 'Itaque a est cillum ', '2021-12-03 11:59:43'),
(24, 1, 1, 'Dolor sint quia ani', 'Neque tempora duis b', 'Quia culpa aut tempo', '2021-12-03 12:00:48');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `product_type` varchar(100) NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `product_type`, `quantity`) VALUES
(2, 'Dell XPS 15', 'Laptop hàng đầu thế giới', 'Laptop', 6500),
(7, 'Dell XPS 13', 'Laptop cho người bình thường', 'Laptop', 3248),
(9, 'Acer Aspire 5', 'Laptop bình dân', 'Laptop', 4320),
(10, 'Acer Aspire 7', 'Laptop test edit', 'Laptop', 3141),
(14, 'John Manning', 'Expedita quia quasi ', 'Fugiat quia sunt ac', 384),
(15, 'Stone Herring', 'Voluptates non quaer', 'Quasi repellendus A', 0),
(16, 'Armando Romero', 'Vel irure ullamco an', 'Ullamco amet ea com', 0),
(17, 'Freya Fitzpatrick', 'Duis laudantium pos', 'Eius non quo iusto v', 0),
(18, 'Tanisha Gill', 'Quis quia aliquam ex', 'Maiores omnis ut min', 0),
(20, 'Iliana Rose', 'Consequatur consect', 'Dolorem magni nisi f', 0),
(22, 'Adam Williams', 'Ea sapiente eveniet', 'Modi magna ut cum do', 0);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(10) UNSIGNED NOT NULL,
  `roleID` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `roleID`, `name`, `address`, `phone_number`, `email`, `username`, `password`) VALUES
(1, 1, 'Halla Davenport', 'Illum quia recusand', '+1 (645) 616-8326', 'gelulinif@mailinator.com', 'hieu.locminh', 'c4ca4238a0b923820dcc509a6f75849b'),
(2, 3, 'Adam Holden', 'Voluptatem dolore o', '+1 (458) 146-9439', 'tepy@mailinator.com', 'admin', 'e00cf25ad42683b3df678c61f42c6bda'),
(6, 2, 'Reed Mckay', 'Aute voluptas distin', '+1 (667) 601-7218', 'xazizazyte@mailinator.com', 'ryjavanixa', 'f3ed11bbdb94fd9ebdefbaf646ab94d3'),
(8, 1, 'Dai Salazar', 'Non consequat Rerum', '+1 (336) 643-1365', 'zijuge@mailinator.com', 'kixox', 'f3ed11bbdb94fd9ebdefbaf646ab94d3'),
(9, 2, 'Morgan Sanford', 'Et quidem nulla natu', '+1 (541) 521-6292', 'hagyqo@mailinator.com', 'muziryri', 'f3ed11bbdb94fd9ebdefbaf646ab94d3'),
(10, 2, 'Chantale Mosley', 'Ut natus nisi ipsum', '+1 (162) 879-1814', 'kakilepota@mailinator.com', 'lyhetetid', 'f3ed11bbdb94fd9ebdefbaf646ab94d3'),
(11, 2, 'Yael Holt', 'Do officia laborum u', '+1 (705) 841-2405', 'wypajyvyg@mailinator.com', 'zofysuxy', 'f3ed11bbdb94fd9ebdefbaf646ab94d3'),
(12, 1, 'Nora Battle', 'Dolore tempora nulla', '+1 (475) 739-6578', 'polymyku@mailinator.com', 'kaqiq', 'f3ed11bbdb94fd9ebdefbaf646ab94d3'),
(13, 1, 'Camden Delaney', 'Ipsum consectetur e', '+1 (601) 329-4632', 'badixuda@mailinator.com', 'sobilasuc', 'f3ed11bbdb94fd9ebdefbaf646ab94d3'),
(14, 2, 'Harper Jensen', 'Veniam magna ullam ', '+1 (634) 559-9847', 'vonyhicuh@mailinator.com', 'noloci', 'f3ed11bbdb94fd9ebdefbaf646ab94d3'),
(15, 2, 'Zephr Larson', 'Autem duis numquam o', '+1 (666) 243-5746', 'xejad@mailinator.com', 'mosit', 'f3ed11bbdb94fd9ebdefbaf646ab94d3'),
(17, 2, 'Joseph Garner', 'Officiis dolorum tem', '+1 (283) 146-2967', 'bucananiq@mailinator.com', 'rumeno', 'f3ed11bbdb94fd9ebdefbaf646ab94d3');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`id`, `name`, `address`) VALUES
(1, 'Kho Quận 10', '10/10 Thành Thái Q.10'),
(2, 'Kho Quận 1', '10 Nguyễn Huệ'),
(3, 'Kho Bình Dương', 'Đông Hoà, Dĩ An, Bình Dương'),
(5, 'Kho Phú Nhuận', '163 Đào Duy Anh P9 Q.Phú Nhuận TP.HCM'),
(12, 'Nomlanga Solis', 'Vitae voluptatum del'),
(13, 'Amir Leblanc', 'Quisquam magnam fugi'),
(16, 'MacKenzie Beach', 'Soluta tempor quisqu'),
(17, 'Caleb Beasley', 'Odio et architecto e'),
(18, 'Nicole Day', 'Beatae ut irure aute'),
(19, 'Hope Welch', 'Enim sapiente minima'),
(20, 'Marah Cardenas', 'Autem praesentium ex');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sku` (`sku`),
  ADD KEY `item_product_id` (`product_id`),
  ADD KEY `item_warehouse_id` (`warehouse_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_id`,`item_id`),
  ADD KEY `order_items_item_id` (`item_id`);

--
-- Indexes for table `order_table`
--
ALTER TABLE `order_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_userID` (`userID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone_number` (`phone_number`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `order_table`
--
ALTER TABLE `order_table`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `item_warehouse_id` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouse` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_item_id` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `order_items_order_id` FOREIGN KEY (`order_id`) REFERENCES `order_table` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `order_table`
--
ALTER TABLE `order_table`
  ADD CONSTRAINT `order_userID` FOREIGN KEY (`userID`) REFERENCES `staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
