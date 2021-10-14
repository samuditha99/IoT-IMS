-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2021 at 11:02 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iot_ims`
--

-- --------------------------------------------------------

--
-- Table structure for table `billing_details`
--

CREATE TABLE `billing_details` (
  `id` int(5) NOT NULL,
  `bill_id` varchar(50) NOT NULL,
  `companyname` varchar(50) NOT NULL,
  `diameter` varchar(50) NOT NULL,
  `tiresize` varchar(50) NOT NULL,
  `weight` varchar(50) NOT NULL,
  `price` varchar(10) NOT NULL,
  `quantity` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `billing_details`
--

INSERT INTO `billing_details` (`id`, `bill_id`, `companyname`, `diameter`, `tiresize`, `weight`, `price`, `quantity`) VALUES
(1, '1', 'maxis', '21', '185/60R13', '1', '5000', '5'),
(2, '1', 'CEAT', '26', '135/90R17', '3', '8000', '4'),
(3, '2', 'maxis', '21', '185/60R13', '1', '5000', '5'),
(4, '3', 'maxis', '21', '185/60R13', '1', '5000', '10');

-- --------------------------------------------------------

--
-- Table structure for table `billing_header`
--

CREATE TABLE `billing_header` (
  `id` int(5) NOT NULL,
  `cardnumber` varchar(50) NOT NULL,
  `partyname` varchar(50) NOT NULL,
  `billingdate` date NOT NULL,
  `billingtime` varchar(50) NOT NULL,
  `loadingdate` date NOT NULL,
  `loadingtime` varchar(20) NOT NULL,
  `exitdate` date NOT NULL,
  `exittime` varchar(20) NOT NULL,
  `driverid` varchar(50) NOT NULL,
  `drivername` varchar(50) NOT NULL,
  `vehiclenumber` varchar(50) NOT NULL,
  `trailernumber` varchar(50) NOT NULL,
  `bill_no` varchar(10) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `billing_header`
--

INSERT INTO `billing_header` (`id`, `cardnumber`, `partyname`, `billingdate`, `billingtime`, `loadingdate`, `loadingtime`, `exitdate`, `exittime`, `driverid`, `drivername`, `vehiclenumber`, `trailernumber`, `bill_no`, `status`) VALUES
(1, '123456', 'samu', '2021-09-13', '10:21:14pm', '2021-10-08', '03:38:16pm', '0000-00-00', '0', '990080453v', 'samudi', 'wp', 'wp', '0', 'Accepted'),
(2, 'efwef', 'Select', '2021-09-13', '10:27:36pm', '2021-10-08', '08:00:20pm', '0000-00-00', '0', 'tjurt', 'ujtdfurt', 'durtu', 'rtdurtdud', '00002', 'Accepted'),
(3, 'CAEE961A', 'Wijemanne', '2021-10-09', '08:48:28pm', '2021-10-09', '09:51:42pm', '0000-00-00', '0', '990080453v', 'samuditha', '8800', '8800', '00003', 'Accepted');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(5) NOT NULL,
  `companyname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `companyname`) VALUES
(2, 'maxis'),
(4, 'MRF'),
(5, 'CEAT'),
(6, 'DSI');

-- --------------------------------------------------------

--
-- Table structure for table `diameters`
--

CREATE TABLE `diameters` (
  `id` int(11) NOT NULL,
  `diameter` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `diameters`
--

INSERT INTO `diameters` (`id`, `diameter`) VALUES
(3, '21'),
(5, '22'),
(6, '23'),
(7, '24'),
(8, '25'),
(9, '26');

-- --------------------------------------------------------

--
-- Table structure for table `party_info`
--

CREATE TABLE `party_info` (
  `id` int(5) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `businessneame` varchar(50) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `party_info`
--

INSERT INTO `party_info` (`id`, `firstname`, `lastname`, `businessneame`, `contact`, `address`, `city`) VALUES
(5, 'Samuditha', 'Wijemanne', 'samu', '785', 'wefwef', 'matugama'),
(6, 'Lalith', 'Wijemanne', 'lalith', '54324523', 'sawfedsf', 'matugama'),
(7, 'Samuditha', 'Wijemanne', 'Wijemanne', '+94779209300', 'Ambalamovita', 'Baduraliya');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_info`
--

CREATE TABLE `purchase_info` (
  `id` int(5) NOT NULL,
  `companyname` varchar(50) NOT NULL,
  `diameter` varchar(20) NOT NULL,
  `tiresize` varchar(20) NOT NULL,
  `weight` varchar(20) NOT NULL,
  `quantity` varchar(10) NOT NULL,
  `unitprice` varchar(20) NOT NULL,
  `totalprice` varchar(20) NOT NULL,
  `paymenttype` varchar(20) NOT NULL,
  `purchasedate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_info`
--

INSERT INTO `purchase_info` (`id`, `companyname`, `diameter`, `tiresize`, `weight`, `quantity`, `unitprice`, `totalprice`, `paymenttype`, `purchasedate`) VALUES
(1, 'maxis', '21', '185/60R13', '1', '10', '1000', '10000', 'Check', '2021-09-09'),
(2, 'CEAT', '26', '135/90R17', '3', '5', '1500', '7500', 'Check', '2021-09-10'),
(3, 'MRF', '25', '115/70R19', '1.7', '500', '1000', '500000', 'Cash', '2021-09-16');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(5) NOT NULL,
  `companyname` varchar(20) NOT NULL,
  `diameter` varchar(20) NOT NULL,
  `tiresize` varchar(20) NOT NULL,
  `weight` varchar(20) NOT NULL,
  `quantity` varchar(10) NOT NULL,
  `sellingprice` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `companyname`, `diameter`, `tiresize`, `weight`, `quantity`, `sellingprice`) VALUES
(1, 'maxis', '21', '185/60R13', '1', 'quantity -', '5000'),
(2, 'CEAT', '26', '135/90R17', '3', '5', '8000'),
(3, 'MRF', '25', '115/70R19', '1.7', '500', '3000');

-- --------------------------------------------------------

--
-- Table structure for table `tire_info`
--

CREATE TABLE `tire_info` (
  `id` int(5) NOT NULL,
  `companyname` varchar(50) NOT NULL,
  `diameter` varchar(10) NOT NULL,
  `tiresize` varchar(20) NOT NULL,
  `weight` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tire_info`
--

INSERT INTO `tire_info` (`id`, `companyname`, `diameter`, `tiresize`, `weight`) VALUES
(1, 'maxis', '21', '185/60R13', '6'),
(2, 'maxis', '21', '215/50R13', '1'),
(3, 'maxis', '22', '225/45R13', '1.2'),
(4, 'maxis', '22', '115/70R15', '1.3'),
(5, 'maxis', '23', '135/80R15', '1'),
(6, 'maxis', '23', '215/45R16 ', '1.3'),
(7, 'MRF', '21', '165/55R14', '1.5'),
(8, 'MRF', '21', '165/50R15', '1.7'),
(9, 'MRF', '25', '115/70R19', '1.7'),
(11, 'CEAT', '26', '135/90R17 ', '3');

-- --------------------------------------------------------

--
-- Table structure for table `user_registrstion`
--

CREATE TABLE `user_registrstion` (
  `id` int(5) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `id_number` varchar(15) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `password` varchar(20) NOT NULL,
  `role` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_registrstion`
--

INSERT INTO `user_registrstion` (`id`, `full_name`, `user_name`, `id_number`, `dob`, `gender`, `password`, `role`, `status`) VALUES
(1, 'Sam', 'admin', 'fgj542', '1999-01-08', 'Male', '1234', 'Admin', 'Active'),
(2, 'ads', 'user', 'asfdwef', '2021-05-05', 'male', '123', 'User', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billing_details`
--
ALTER TABLE `billing_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billing_header`
--
ALTER TABLE `billing_header`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diameters`
--
ALTER TABLE `diameters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `party_info`
--
ALTER TABLE `party_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_info`
--
ALTER TABLE `purchase_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tire_info`
--
ALTER TABLE `tire_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_registrstion`
--
ALTER TABLE `user_registrstion`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billing_details`
--
ALTER TABLE `billing_details`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `billing_header`
--
ALTER TABLE `billing_header`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `diameters`
--
ALTER TABLE `diameters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `party_info`
--
ALTER TABLE `party_info`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `purchase_info`
--
ALTER TABLE `purchase_info`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tire_info`
--
ALTER TABLE `tire_info`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_registrstion`
--
ALTER TABLE `user_registrstion`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
