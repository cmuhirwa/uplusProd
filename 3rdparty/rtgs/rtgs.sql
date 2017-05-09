-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2016 at 06:09 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rtgs`
--

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `bankcolor` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `name`, `type`, `bankcolor`) VALUES
(1, 'MTN Rwanda', 'Telecom', '#ffbe00'),
(2, 'TIGO Rwanda', 'Telecom', '#002e6e'),
(3, 'AIRTEL Rwanda', 'Telecom', '#db030c'),
(4, 'MOBICASH', 'Telecom', NULL),
(5, 'BANK OF KIGALI (BK)', 'bank', '#36459b'),
(6, 'Bank Populaire du Rwanda (BPR)', 'bank', NULL),
(7, 'URWEGO OPPORTUNITY BANK', 'bank', NULL),
(8, 'ZIGAMA CREDIT AND SAVING SOCIETY', 'bank', NULL),
(9, 'COGEBANQUE', 'bank', NULL),
(10, 'GTBANK', 'bank', NULL),
(11, 'DEVELOPMENT BANK OF RWANDA (BRD)', 'bank', NULL),
(12, 'KCB', 'bank', 'rgba(95, 176, 44, 0.81);'),
(13, 'ECOBANK', 'bank', NULL),
(14, 'EQUITY', 'bank', NULL),
(15, 'I&M BANK', 'bank', NULL),
(16, 'AB BANK', 'bank', NULL),
(17, 'AGASEKE BANK', 'bank', NULL),
(18, 'UNGUKA', 'bank', NULL),
(19, 'ACCESS BANK RWANDA LTD', 'bank', NULL),
(20, 'CRANE BANK', 'bank', NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `bank_accounts`
--
CREATE TABLE `bank_accounts` (
`accountNumber` varchar(50)
,`bankName` varchar(255)
,`bankId` int(11)
,`clientName` varchar(255)
,`clientId` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `bank_client`
--

CREATE TABLE `bank_client` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `accountNumber` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_client`
--

INSERT INTO `bank_client` (`id`, `client_id`, `bank_id`, `accountNumber`) VALUES
(1, 1, 1, '0784848236'),
(2, 2, 1, '0788551893'),
(3, 3, 1, '0788551893'),
(4, 4, 1, '0788351606'),
(5, 5, 1, '0788302539'),
(6, 6, 2, '072345678'),
(7, 7, 3, '0738884646');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`) VALUES
(1, 'MUHIRWA Clement'),
(2, 'MUSHIMISHA Assumpta'),
(3, 'UMUTONI Francine'),
(4, 'DUSAIDI Dianne'),
(5, 'MASABO Martin'),
(6, 'MANIRAHO Evode'),
(7, 'MUTIJIMA Briant');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `amount` int(11) DEFAULT NULL,
  `operation` enum('credit','debit') NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `account_id` int(11) NOT NULL,
  `transaction_date` date DEFAULT NULL,
  `to_from_client` int(11) DEFAULT NULL,
  `to_from_bank` int(11) NOT NULL,
  `to_from_account` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `amount`, `operation`, `client_id`, `bank_id`, `account_id`, `transaction_date`, `to_from_client`, `to_from_bank`, `to_from_account`) VALUES
(1, 500, 'debit', 1, 1, 1, '2016-12-28', 2, 1, 2),
(2, 500, 'credit', 2, 1, 2, '2016-12-28', 1, 1, 1),
(3, 1000, 'debit', 1, 1, 1, '2016-12-28', 6, 2, 6),
(4, 1000, 'credit', 6, 2, 6, '2016-12-28', 1, 1, 1),
(5, 800, 'debit', 1, 1, 1, '2016-12-28', 7, 3, 7),
(6, 800, 'credit', 7, 3, 7, '2016-12-28', 1, 1, 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `transactionsview`
--
CREATE TABLE `transactionsview` (
`amount` int(11)
,`operation` enum('credit','debit')
,`account_id` int(11)
,`transaction_date` date
,`to_from_account` int(11)
,`to_from_bank` int(11)
,`to_from_client` int(11)
,`clientId` int(11)
,`clientName` varchar(255)
,`bankId` int(11)
,`bankName` varchar(255)
,`accountNumber` varchar(50)
);

-- --------------------------------------------------------

--
-- Structure for view `bank_accounts`
--
DROP TABLE IF EXISTS `bank_accounts`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bank_accounts`  AS  select `bc`.`accountNumber` AS `accountNumber`,`b`.`name` AS `bankName`,`b`.`id` AS `bankId`,`cl`.`name` AS `clientName`,`cl`.`id` AS `clientId` from ((`bank_client` `bc` join `banks` `b` on((`b`.`id` = `bc`.`bank_id`))) join `clients` `cl` on((`cl`.`id` = `bc`.`client_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `transactionsview`
--
DROP TABLE IF EXISTS `transactionsview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `transactionsview`  AS  select `t`.`amount` AS `amount`,`t`.`operation` AS `operation`,`t`.`account_id` AS `account_id`,`t`.`transaction_date` AS `transaction_date`,`t`.`to_from_account` AS `to_from_account`,`t`.`to_from_bank` AS `to_from_bank`,`t`.`to_from_client` AS `to_from_client`,`cl`.`id` AS `clientId`,`cl`.`name` AS `clientName`,`b`.`id` AS `bankId`,`b`.`name` AS `bankName`,`bc`.`accountNumber` AS `accountNumber` from (((`transactions` `t` join `clients` `cl` on((`cl`.`id` = `t`.`client_id`))) join `banks` `b` on((`b`.`id` = `t`.`bank_id`))) join `bank_client` `bc` on((`bc`.`id` = `t`.`account_id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_client`
--
ALTER TABLE `bank_client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `bank_client`
--
ALTER TABLE `bank_client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
