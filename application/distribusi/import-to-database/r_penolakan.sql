-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2022 at 07:48 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app-siakad-research`
--

-- --------------------------------------------------------

--
-- Table structure for table `r_penolakan`
--

CREATE TABLE `r_penolakan` (
  `id` int(11) NOT NULL,
  `prodi_id` int(11) NOT NULL,
  `ditolak_oleh` varchar(9) NOT NULL,
  `status` int(11) NOT NULL,
  `keterangan` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `r_penolakan`
--

INSERT INTO `r_penolakan` (`id`, `prodi_id`, `ditolak_oleh`, `status`, `keterangan`) VALUES
(3, 13, 'Ka. Baak', 0, 'Tidak Valid. Mohon Diperbaiki'),
(6, 13, 'Ka. Baak', 0, 'no comment'),
(8, 13, 'Ka. Baak', 0, 'test\r\n');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `r_penolakan`
--
ALTER TABLE `r_penolakan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `r_penolakan`
--
ALTER TABLE `r_penolakan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
