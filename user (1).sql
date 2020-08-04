-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 12, 2019 at 03:31 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `HealthcareChatbot`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `appointment` (
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phoneno` varchar(10) NOT NULL,
  `hospital` varchar(100) NOT NULL,
  `date` varchar(20) NOT NULL,
  `time` time(0) NOT NULL
  );

  CREATE TABLE IF NOT EXISTS `groupnames` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`groupname` varchar(50) DEFAULT NULL,
`name` varchar(50) DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO `groupnames` (`id`, `groupname`, `name`) VALUES
(1, 'Apollo', 'Dr.Robert'),
(2, 'Apollo', 'Dr.Sreeja'),
(3, 'Apollo', 'Dr.Karthik'),
(4, 'KIMS', 'Dr.Priya'),
(5, 'KIMS', 'Dr.Avinash'),
(6, 'KIMS', 'Dr.Kushi'),
(7, 'Nirmala', 'Dr.Arnav'),
(8, 'Nirmala', 'Dr.Manvisree'),
(9, 'Nirmala', 'Dr.Indhu'),
(10, 'Fernandaze', 'Dr.Manish'),
(11, 'Fernandaze', 'Dr.Vineel'),
(12, 'Fernandaze', 'Dr.Ravi'),
(13, 'Holistic', 'Dr.Vamshi'),
(14, 'Holistic', 'Dr.Vijaya'),
(15, 'Holistic', 'Dr.Susheela');


CREATE TABLE `user` (
  `full_name` varchar(20) NOT NULL,
  `email_id` varchar(35) NOT NULL,
  `mobile_no` bigint(10) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--



INSERT INTO `user` (`full_name`, `email_id`, `mobile_no`, `password`) VALUES
('Jayram Nandagiri', 'jayram.nandagiri@spit.ac.in', 7738916989, 'jayram'),
('Om Rajpurkar', 'om.sam1999@gmail.com', 9619695656, 'Gta19@99'),
('Siddesh Kamble', 'siddeshkamble45@gmail.com', 8108433881, 'siddesh');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
