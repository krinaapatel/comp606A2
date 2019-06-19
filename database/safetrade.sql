-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2019 at 07:59 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `safetrade`
--

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

CREATE TABLE `bids` (
  `bid_id` int(11) NOT NULL,
  `requierment_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `tdr_id` int(11) NOT NULL,
  `bidt_amount` float(15,2) NOT NULL,
  `bidl_amount` float(15,2) NOT NULL,
  `bidm_amount` float(15,2) NOT NULL,
  `time_arrival` date NOT NULL,
  `createdon` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`bid_id`, `requierment_id`, `member_id`, `tdr_id`, `bidt_amount`, `bidl_amount`, `bidm_amount`, `time_arrival`, `createdon`) VALUES
(9, 16, 10, 11, 11.00, 22.00, 33.00, '2019-06-13', '2019-06-17'),
(10, 17, 17, 18, 12.00, 52.00, 63.00, '2019-06-20', '2019-06-18');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `requierment_id` int(11) NOT NULL,
  `sendby` int(11) NOT NULL,
  `receiveby` int(11) NOT NULL,
  `message` text NOT NULL,
  `createdon` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `requierment_id`, `sendby`, `receiveby`, `message`, `createdon`) VALUES
(20, 16, 11, 10, 'qwqwqw', '2019-06-17'),
(19, 16, 11, 10, 'ohhh', '2019-06-17'),
(18, 16, 11, 10, 'hello man', '2019-06-17'),
(17, 16, 11, 10, '///', '2019-06-17'),
(15, 16, 11, 10, 'asasasA', '2019-06-17'),
(16, 16, 11, 10, 'QWQWQ', '2019-06-17'),
(14, 16, 11, 10, 'asaasa', '2019-06-17'),
(21, 16, 11, 10, 'last', '2019-06-17'),
(22, 16, 11, 10, 'sdsada', '2019-06-17'),
(23, 16, 11, 10, 'q', '2019-06-17'),
(24, 16, 11, 10, 'bs', '2019-06-17'),
(25, 16, 11, 10, 'qq', '2019-06-17'),
(26, 16, 11, 10, 'aaaa', '2019-06-17'),
(27, 16, 11, 10, '///', '2019-06-17'),
(28, 16, 11, 10, './/', '2019-06-17'),
(29, 16, 11, 10, 'hjhjh/', '2019-06-17'),
(30, 16, 11, 10, 'xcxczxcxc', '2019-06-17'),
(31, 17, 18, 17, 'hyy', '2019-06-18'),
(32, 17, 17, 18, 'hy how are you', '2019-06-18');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(10) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_pass` varchar(50) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `member_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `user_name`, `user_pass`, `user_email`, `member_type`) VALUES
(10, 'cmak', 'password', 'cmak@cmak.com', 'member'),
(11, 'tmak', 'password', 'tmak@tmak.com', 'trader'),
(12, 'ami', '123', 'patelami1608@gmail.com', 'trader'),
(13, 'krina', '123', 'krina@mail.com', 'trader'),
(14, 'ami', '1234', 'ami@gmail.com', 'member'),
(15, 'akash', '123', 'a@gmail.com', 'member'),
(16, 'trade', '123', 't@gmail.com', 'trader'),
(17, 'krinap', 'admin123', 'krinapatel@gmail.com', 'member'),
(18, 'Amipatel', 'admin123', 'Amipatel@gmail.com', 'trader');

-- --------------------------------------------------------

--
-- Table structure for table `requierments`
--

CREATE TABLE `requierments` (
  `requierment_id` int(11) NOT NULL,
  `member_id` int(10) NOT NULL,
  `budget` decimal(15,2) NOT NULL,
  `place_job` varchar(100) NOT NULL,
  `date_s` date NOT NULL,
  `date_e` date NOT NULL,
  `details` text NOT NULL,
  `create_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requierments`
--

INSERT INTO `requierments` (`requierment_id`, `member_id`, `budget`, `place_job`, `date_s`, `date_e`, `details`, `create_date`) VALUES
(16, 10, '2500.00', 'chandigarh', '2019-06-20', '2019-06-08', 'This is testing', '2019-06-17'),
(15, 15, '4000.00', 'Hamilton', '2019-05-27', '2019-06-17', 'construction', '2019-06-17'),
(14, 15, '3000.00', 'wellington', '2019-06-05', '2019-06-12', 'painter', '2019-06-17'),
(13, 15, '2000.00', 'auckland', '2019-06-05', '2019-06-19', 'hii', '2019-06-17'),
(12, 15, '123.00', 'hamilton', '2019-06-12', '2019-06-26', 'hello', '2019-06-17'),
(17, 17, '25.00', 'hemiltom', '2019-06-07', '2019-06-14', 'need developer', '2019-06-18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`bid_id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requierments`
--
ALTER TABLE `requierments`
  ADD PRIMARY KEY (`requierment_id`),
  ADD KEY `member_id` (`member_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bids`
--
ALTER TABLE `bids`
  MODIFY `bid_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `requierments`
--
ALTER TABLE `requierments`
  MODIFY `requierment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
