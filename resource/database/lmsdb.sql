-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2018 at 08:19 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `block`
--

CREATE TABLE `block` (
  `id` int(11) NOT NULL,
  `lga_id` int(11) NOT NULL,
  `block` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `block`
--

INSERT INTO `block` (`id`, `lga_id`, `block`) VALUES
(1, 2, 'Ode-Aye'),
(2, 2, 'Ayeka'),
(3, 2, 'Idepe'),
(4, 2, 'Ilutitun'),
(5, 2, 'Iretolu'),
(6, 4, 'Alagbaka'),
(7, 4, 'Arakale'),
(8, 6, 'Arakape');

-- --------------------------------------------------------

--
-- Table structure for table `ceo`
--

CREATE TABLE `ceo` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `pillar` text NOT NULL,
  `ifrom` text NOT NULL,
  `ito` text NOT NULL,
  `date` text NOT NULL,
  `mode_of_inh` text NOT NULL,
  `amt` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `pillar`, `ifrom`, `ito`, `date`, `mode_of_inh`, `amt`) VALUES
(1, '56477', 'Nature', '28768', '1445210593', 'Birth', 'Gift Equivalence'),
(2, '56478', 'Nature', '28768', '1445210639', 'Birth', 'Gift Equivalence'),
(5, '56477', '310372', '34588', '1445285340', 'Sale', '6777770'),
(6, '56477', '34588', '310372', '1445808124', 'Sale', '78888880'),
(7, '8778', 'Nature', '28768', '1445842038', 'Birth', 'Gift Equivalence'),
(8, '56470', 'Nature', '28768', '1445842059', 'Birth', 'Gift Equivalence'),
(9, '8778', '28768', '34588', '1446715565', 'Sale', '34000000'),
(10, '56470', '28768', '34588', '1446715566', 'Sale', '60000000');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `seller` text NOT NULL,
  `buyer` text NOT NULL,
  `pillar` text NOT NULL,
  `date` varchar(40) NOT NULL,
  `st` text NOT NULL,
  `size` varchar(100) NOT NULL,
  `amt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `landcart`
--

CREATE TABLE `landcart` (
  `id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `pillar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `landcart`
--

INSERT INTO `landcart` (`id`, `sale_id`, `pillar`) VALUES
(1, 310372, '56477'),
(2, 310372, '56478');

-- --------------------------------------------------------

--
-- Table structure for table `lga`
--

CREATE TABLE `lga` (
  `id` int(11) NOT NULL,
  `lga` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lga`
--

INSERT INTO `lga` (`id`, `lga`) VALUES
(2, 'Okitipupa'),
(3, 'Ilaje'),
(4, 'Akure South'),
(5, 'Owo'),
(6, 'Ifon'),
(7, 'Irele'),
(8, 'Ose'),
(9, 'Akoko North East'),
(10, 'Akoko North West'),
(11, 'Akure East'),
(12, 'Akoko South West'),
(13, 'Akure North'),
(14, 'Ese-Odo'),
(15, 'Idanre'),
(16, 'Ifedore'),
(17, 'Ile-Oluji'),
(18, 'Okeigbo'),
(19, 'Ondo East'),
(20, 'Ondo West');

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `id` int(11) NOT NULL,
  `layout` int(11) NOT NULL,
  `name` text NOT NULL,
  `tel` text NOT NULL,
  `addr` text NOT NULL,
  `sale_id` varchar(23) NOT NULL,
  `mail` text NOT NULL,
  `lga` int(11) NOT NULL,
  `inheritance` text NOT NULL,
  `pix` text NOT NULL,
  `actype` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`id`, `layout`, `name`, `tel`, `addr`, `sale_id`, `mail`, `lga`, `inheritance`, `pix`, `actype`) VALUES
(1, 1, 'Aladekahunsi Temitope', '08107926081', '59 iloro street', '28768', 'akins@gmail.com', 2, 'No Inheritance', '65a646423aa3e46581284dad021852b4img_20151004_090720.jpg', 'Government'),
(2, 1, 'Akindutire Ayomide Samuel', '08107926085', '98 mhjjkhl', '34588', 'akins@gmail.com', 2, 'No Inheritance', '44ec4b311cc2aa47740e6595c669c88010509628_10152551899628463_8664624520299255713_n.jpg', 'Individual'),
(3, 1, 'Toyin Laide Adelabi', '08107926091', '67 ghoty street, akure', '310372', 'akindutire33@gmail.com', 2, 'No Inheritance', '109a2b01c9c6c30598b308eb16d42c0662144_399396086847303_658717517_n.jpg', 'Individual');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `seller` text NOT NULL,
  `buyer` text NOT NULL,
  `pillar` text NOT NULL,
  `date` varchar(40) NOT NULL,
  `st` text NOT NULL,
  `size` varchar(100) NOT NULL,
  `amt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `seller`, `buyer`, `pillar`, `date`, `st`, `size`, `amt`) VALUES
(1, '310372', '34588', '56477', '1445285340', '1', '670*548', 6777770),
(2, '34588', '310372', '56477', '1445808124', '1', '670*548', 78888880),
(3, '28768', '34588', '8778', '1446715565', '1', '556*670', 34000000),
(4, '28768', '34588', '56470', '1446715566', '1', '450*790', 60000000);

-- --------------------------------------------------------

--
-- Table structure for table `performancetab`
--

CREATE TABLE `performancetab` (
  `id` int(11) NOT NULL,
  `ifr` text NOT NULL,
  `tg` text NOT NULL,
  `st` int(11) NOT NULL,
  `lm` varchar(78) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `performancetab`
--

INSERT INTO `performancetab` (`id`, `ifr`, `tg`, `st`, `lm`) VALUES
(1, '1445842876', '1461650476', 1, '1446715897');

-- --------------------------------------------------------

--
-- Table structure for table `plots`
--

CREATE TABLE `plots` (
  `id` int(11) NOT NULL,
  `lga_id` int(11) NOT NULL,
  `lay_id` int(11) NOT NULL,
  `limg` text NOT NULL,
  `size` text NOT NULL,
  `amount` text NOT NULL,
  `pillar` text NOT NULL,
  `sale_id` varchar(25) NOT NULL,
  `inheritance` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plots`
--

INSERT INTO `plots` (`id`, `lga_id`, `lay_id`, `limg`, `size`, `amount`, `pillar`, `sale_id`, `inheritance`) VALUES
(1, 2, 1, 'NULL', '670*548', '788888880', '56477', '310372', 'Sale'),
(2, 2, 1, 'NULL', '780*569', '90003990', '56478', '310372', 'Sale'),
(3, 2, 1, 'NULL', '556*670', '0', '8778', '34588', 'Sale'),
(4, 2, 1, 'NULL', '450*790', '0', '56470', '310372', 'Sale');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` text NOT NULL,
  `name` text NOT NULL,
  `mat` text NOT NULL,
  `password` text NOT NULL,
  `pix` text NOT NULL,
  `sex` text NOT NULL,
  `bk` varchar(2) NOT NULL,
  `dpt` text NOT NULL,
  `extrights` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `mat`, `password`, `pix`, `sex`, `bk`, `dpt`, `extrights`) VALUES
(1, 'Admin', 'Akinsuyi Allison Wilson', 'createaccount@cliqs.com', 'cbaac6303676c08e8dfa39d51d0d09e947878ad5', '1274882akinsuyi.jpg', 'Male', '0', '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `block`
--
ALTER TABLE `block`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ceo`
--
ALTER TABLE `ceo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `landcart`
--
ALTER TABLE `landcart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lga`
--
ALTER TABLE `lga`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `performancetab`
--
ALTER TABLE `performancetab`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plots`
--
ALTER TABLE `plots`
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
-- AUTO_INCREMENT for table `block`
--
ALTER TABLE `block`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ceo`
--
ALTER TABLE `ceo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `landcart`
--
ALTER TABLE `landcart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lga`
--
ALTER TABLE `lga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `owner`
--
ALTER TABLE `owner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `performancetab`
--
ALTER TABLE `performancetab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `plots`
--
ALTER TABLE `plots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
