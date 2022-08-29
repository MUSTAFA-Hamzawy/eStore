-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2022 at 12:24 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryId` int(10) UNSIGNED NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Image` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryId`, `Name`, `Image`) VALUES
(14, 'PC', '3c3191567c081cf4dd640dfd9.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `ClientId` int(10) UNSIGNED NOT NULL,
  `Name` varchar(50) NOT NULL,
  `PhoneNumber` varchar(15) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `ExpenseId` tinyint(3) UNSIGNED NOT NULL,
  `Name` varchar(30) NOT NULL,
  `FixedPayment` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `expenses_daily_list`
--

CREATE TABLE `expenses_daily_list` (
  `DExpenseId` int(10) UNSIGNED NOT NULL,
  `Expense_Id` tinyint(3) UNSIGNED NOT NULL,
  `payment` decimal(7,2) NOT NULL,
  `createdTime` datetime NOT NULL,
  `User_Id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `InvoiceId` int(10) UNSIGNED NOT NULL,
  `SupplierId` int(10) UNSIGNED NOT NULL,
  `PaymentType` tinyint(1) NOT NULL,
  `PaymentStatus` tinyint(1) NOT NULL,
  `Created` date NOT NULL,
  `Discount` decimal(8,2) DEFAULT NULL,
  `UserId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invoices_details`
--

CREATE TABLE `invoices_details` (
  `Id` int(10) UNSIGNED NOT NULL,
  `Product_id` int(10) UNSIGNED NOT NULL,
  `Quantity` smallint(6) NOT NULL,
  `Price` decimal(8,2) NOT NULL,
  `InvoiceId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_receipt`
--

CREATE TABLE `invoice_receipt` (
  `ReceiptId` int(10) UNSIGNED NOT NULL,
  `InvoiceId` int(10) UNSIGNED NOT NULL,
  `PaymentType` tinyint(1) NOT NULL,
  `PaymnetAmount` decimal(8,2) NOT NULL,
  `PaymentLiteral` varchar(60) NOT NULL,
  `BankName` varchar(30) DEFAULT NULL,
  `BankAccountNumber` varchar(30) DEFAULT NULL,
  `CheckNumber` varchar(15) DEFAULT NULL,
  `TransferedTo` varchar(30) DEFAULT NULL,
  `Created` date NOT NULL,
  `UserId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `Id` int(10) UNSIGNED NOT NULL,
  `title` varchar(30) NOT NULL,
  `content` varchar(250) NOT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `Created` datetime NOT NULL,
  `UserId` int(10) UNSIGNED NOT NULL,
  `seen` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `privilleges`
--

CREATE TABLE `privilleges` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `privillege` varchar(30) DEFAULT NULL,
  `url_title` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `privilleges`
--

INSERT INTO `privilleges` (`id`, `privillege`, `url_title`) VALUES
(15, 'Modify supplier&#39;s data', 'supplier/edit'),
(16, 'Remove a supplier', 'supplier/delete'),
(17, 'Create a new user', 'user/add'),
(18, 'Modify user&#39;s data', 'user/edit'),
(27, 'Remove user', 'user/delete'),
(36, 'Create a supplier', 'supplier/add'),
(38, 'show users', 'user/main'),
(39, 'show suppliers', 'supplier/main'),
(40, 'Add Group', 'userGroups/add'),
(41, 'Edit Group', 'userGroups/edit'),
(42, 'Remove Group', 'userGroups/delete'),
(43, 'Add privilege', 'privileges/add'),
(44, 'Remove Privilege', 'privileges/delete'),
(45, 'Edit Privilege', 'privileges/edit'),
(47, 'Edit Category', 'category/edit'),
(48, 'delete Category', 'category/delete'),
(50, 'Edit Client', 'client/edit'),
(51, 'Remove Client', 'client/delete'),
(52, 'Add Product', 'product/add'),
(53, 'Edit product', 'product/edit'),
(54, 'remove product', 'product/delete'),
(55, 'Show Groups', 'userGroups/main'),
(56, 'Show Privileges', 'privileges/main'),
(57, 'Show Suppliers', 'supplier/main'),
(58, 'Show Clients', 'client/main'),
(59, 'Show Products', 'product/main'),
(60, 'Show Categories', 'categories/main'),
(62, 'Show Categories', 'category/main'),
(63, 'Add Category', 'category/add');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ProductId` int(10) UNSIGNED NOT NULL,
  `CategoryId` int(10) UNSIGNED NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Image` varchar(30) NOT NULL,
  `Quantity` smallint(5) UNSIGNED NOT NULL,
  `Price` decimal(6,2) NOT NULL,
  `BarCode` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductId`, `CategoryId`, `Name`, `Image`, `Quantity`, `Price`, `BarCode`) VALUES
(5, 14, 'Monitor', 'ab729fc7de5fddcc35b773c80.webp', 12, '1200.00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sales_invoices`
--

CREATE TABLE `sales_invoices` (
  `InvoiceId` int(10) UNSIGNED NOT NULL,
  `ClientId` int(10) UNSIGNED NOT NULL,
  `PaymentType` tinyint(1) NOT NULL,
  `PaymnetAmount` decimal(8,2) NOT NULL,
  `PaymentLiteral` varchar(60) NOT NULL,
  `BankName` varchar(30) DEFAULT NULL,
  `BankAccountNumber` varchar(30) DEFAULT NULL,
  `CheckNumber` varchar(15) DEFAULT NULL,
  `TransferedTo` varchar(30) DEFAULT NULL,
  `Created` date NOT NULL,
  `UserId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sales_invoices_details`
--

CREATE TABLE `sales_invoices_details` (
  `Id` int(10) UNSIGNED NOT NULL,
  `ProductId` int(10) UNSIGNED NOT NULL,
  `Quantity` smallint(6) NOT NULL,
  `ProductPrice` decimal(7,2) NOT NULL,
  `InvoiceId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sales_invoices_receipts`
--

CREATE TABLE `sales_invoices_receipts` (
  `ReceiptId` int(10) UNSIGNED NOT NULL,
  `InvoiceId` int(10) UNSIGNED NOT NULL,
  `PaymentType` tinyint(1) NOT NULL,
  `PaymnetAmount` decimal(8,2) NOT NULL,
  `PaymentLiteral` varchar(60) NOT NULL,
  `BankName` varchar(30) DEFAULT NULL,
  `BankAccountNumber` varchar(30) DEFAULT NULL,
  `CheckNumber` varchar(15) DEFAULT NULL,
  `TransferedTo` varchar(30) DEFAULT NULL,
  `Created` date NOT NULL,
  `UserId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `SupplierId` int(10) UNSIGNED NOT NULL,
  `Name` varchar(50) NOT NULL,
  `PhoneNumber` varchar(15) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`SupplierId`, `Name`, `PhoneNumber`, `Email`, `address`) VALUES
(2, 'Mustafa Mahmoud', '123412341234', 'mustafa@1.com', 'safj123');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `join_date` date NOT NULL DEFAULT current_timestamp(),
  `last_login` datetime NOT NULL,
  `group_id` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `phone_number`, `join_date`, `last_login`, `group_id`, `status`) VALUES
(27, 'Hamzawy2022', '7e5e78f150eb58726674af7f999363b0', 'mustafa123@gmail.com', '01121333421', '2022-08-28', '0000-00-00 00:00:00', 360, 1),
(30, 'Ahmed1122', '7e5e78f150eb58726674af7f999363b0', 'ahmed@yahoo.com', NULL, '2022-08-28', '0000-00-00 00:00:00', 398, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `name`) VALUES
(360, 'Managers'),
(398, 'Accountant');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups_privilleges`
--

CREATE TABLE `users_groups_privilleges` (
  `id` int(4) NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL,
  `privillege_id` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups_privilleges`
--

INSERT INTO `users_groups_privilleges` (`id`, `group_id`, `privillege_id`) VALUES
(605, 360, 16),
(607, 360, 18),
(624, 360, 15),
(625, 360, 17),
(626, 360, 27),
(681, 398, 15),
(690, 360, 36),
(691, 360, 38),
(692, 360, 39),
(693, 360, 40),
(694, 360, 41),
(695, 360, 42),
(696, 360, 43),
(697, 360, 44),
(698, 360, 45),
(700, 360, 47),
(701, 360, 48),
(703, 360, 50),
(704, 360, 51),
(705, 360, 52),
(706, 360, 53),
(707, 360, 54),
(708, 360, 55),
(709, 360, 56),
(710, 360, 57),
(711, 360, 58),
(712, 360, 59),
(713, 360, 60),
(719, 360, 62),
(720, 398, 18),
(721, 398, 41),
(722, 398, 45),
(723, 398, 47),
(724, 398, 50),
(725, 398, 53),
(726, 398, 38),
(727, 398, 39),
(728, 398, 55),
(729, 398, 56),
(730, 398, 57),
(731, 398, 58),
(732, 398, 59),
(733, 398, 60),
(734, 398, 62),
(735, 360, 63);

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `address` varchar(50) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `first_name`, `last_name`, `address`, `DOB`, `image`) VALUES
(27, 'Mustafa', 'Mahmoud', NULL, NULL, NULL),
(30, 'Ahmed', '', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryId`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`ClientId`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`ExpenseId`);

--
-- Indexes for table `expenses_daily_list`
--
ALTER TABLE `expenses_daily_list`
  ADD PRIMARY KEY (`DExpenseId`),
  ADD KEY `Expense_Id` (`Expense_Id`),
  ADD KEY `User_Id` (`User_Id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`InvoiceId`),
  ADD KEY `SupplierId` (`SupplierId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `invoices_details`
--
ALTER TABLE `invoices_details`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Product_id` (`Product_id`),
  ADD KEY `InvoiceId` (`InvoiceId`);

--
-- Indexes for table `invoice_receipt`
--
ALTER TABLE `invoice_receipt`
  ADD PRIMARY KEY (`ReceiptId`),
  ADD KEY `InvoiceId` (`InvoiceId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `privilleges`
--
ALTER TABLE `privilleges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductId`),
  ADD KEY `CategoryId` (`CategoryId`);

--
-- Indexes for table `sales_invoices`
--
ALTER TABLE `sales_invoices`
  ADD PRIMARY KEY (`InvoiceId`),
  ADD KEY `ClientId` (`ClientId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `sales_invoices_details`
--
ALTER TABLE `sales_invoices_details`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `ProductId` (`ProductId`),
  ADD KEY `InvoiceId` (`InvoiceId`);

--
-- Indexes for table `sales_invoices_receipts`
--
ALTER TABLE `sales_invoices_receipts`
  ADD PRIMARY KEY (`ReceiptId`),
  ADD KEY `InvoiceId` (`InvoiceId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`SupplierId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `phone_number` (`phone_number`),
  ADD KEY `user_group_FK` (`group_id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups_privilleges`
--
ALTER TABLE `users_groups_privilleges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `privillege_id` (`privillege_id`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `ClientId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `ExpenseId` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses_daily_list`
--
ALTER TABLE `expenses_daily_list`
  MODIFY `DExpenseId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `InvoiceId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices_details`
--
ALTER TABLE `invoices_details`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_receipt`
--
ALTER TABLE `invoice_receipt`
  MODIFY `ReceiptId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `privilleges`
--
ALTER TABLE `privilleges`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ProductId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sales_invoices`
--
ALTER TABLE `sales_invoices`
  MODIFY `InvoiceId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_invoices_details`
--
ALTER TABLE `sales_invoices_details`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_invoices_receipts`
--
ALTER TABLE `sales_invoices_receipts`
  MODIFY `ReceiptId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `SupplierId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=403;

--
-- AUTO_INCREMENT for table `users_groups_privilleges`
--
ALTER TABLE `users_groups_privilleges`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=736;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `expenses_daily_list`
--
ALTER TABLE `expenses_daily_list`
  ADD CONSTRAINT `expenses_daily_list_ibfk_1` FOREIGN KEY (`Expense_Id`) REFERENCES `expenses` (`ExpenseId`),
  ADD CONSTRAINT `expenses_daily_list_ibfk_2` FOREIGN KEY (`User_Id`) REFERENCES `user` (`id`);

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`SupplierId`) REFERENCES `supplier` (`SupplierId`),
  ADD CONSTRAINT `invoice_ibfk_2` FOREIGN KEY (`UserId`) REFERENCES `user` (`id`);

--
-- Constraints for table `invoices_details`
--
ALTER TABLE `invoices_details`
  ADD CONSTRAINT `invoices_details_ibfk_1` FOREIGN KEY (`Product_id`) REFERENCES `product` (`ProductId`),
  ADD CONSTRAINT `invoices_details_ibfk_2` FOREIGN KEY (`InvoiceId`) REFERENCES `invoice` (`InvoiceId`);

--
-- Constraints for table `invoice_receipt`
--
ALTER TABLE `invoice_receipt`
  ADD CONSTRAINT `invoice_receipt_ibfk_1` FOREIGN KEY (`InvoiceId`) REFERENCES `invoice` (`InvoiceId`),
  ADD CONSTRAINT `invoice_receipt_ibfk_2` FOREIGN KEY (`UserId`) REFERENCES `user` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `user` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `Product_ibfk_1` FOREIGN KEY (`CategoryId`) REFERENCES `category` (`CategoryId`);

--
-- Constraints for table `sales_invoices`
--
ALTER TABLE `sales_invoices`
  ADD CONSTRAINT `sales_invoices_ibfk_1` FOREIGN KEY (`InvoiceId`) REFERENCES `invoice` (`InvoiceId`),
  ADD CONSTRAINT `sales_invoices_ibfk_2` FOREIGN KEY (`ClientId`) REFERENCES `client` (`ClientId`);

--
-- Constraints for table `sales_invoices_details`
--
ALTER TABLE `sales_invoices_details`
  ADD CONSTRAINT `sales_invoices_details_ibfk_1` FOREIGN KEY (`ProductId`) REFERENCES `product` (`ProductId`),
  ADD CONSTRAINT `sales_invoices_details_ibfk_2` FOREIGN KEY (`InvoiceId`) REFERENCES `invoice` (`InvoiceId`);

--
-- Constraints for table `sales_invoices_receipts`
--
ALTER TABLE `sales_invoices_receipts`
  ADD CONSTRAINT `sales_invoices_receipts_ibfk_1` FOREIGN KEY (`InvoiceId`) REFERENCES `sales_invoices` (`InvoiceId`),
  ADD CONSTRAINT `sales_invoices_receipts_ibfk_2` FOREIGN KEY (`UserId`) REFERENCES `user` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_group_FK` FOREIGN KEY (`group_id`) REFERENCES `users_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_groups_privilleges`
--
ALTER TABLE `users_groups_privilleges`
  ADD CONSTRAINT `user_groups_FK` FOREIGN KEY (`group_id`) REFERENCES `users_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_groups_privilleges_ibfk_2` FOREIGN KEY (`privillege_id`) REFERENCES `privilleges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD CONSTRAINT `user_profile_ibfk_1` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
