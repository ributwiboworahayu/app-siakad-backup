-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2022 at 07:47 AM
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
-- Table structure for table `r_distribusi_setting`
--

CREATE TABLE `r_distribusi_setting` (
  `id` int(11) NOT NULL,
  `prodi_id` int(11) NOT NULL,
  `takad_id` int(11) NOT NULL,
  `status_portal` int(1) NOT NULL,
  `status_submit` int(1) NOT NULL,
  `status_baak` int(11) NOT NULL,
  `status_wadir` int(11) NOT NULL,
  `status_direktur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `r_distribusi_setting`
--

INSERT INTO `r_distribusi_setting` (`id`, `prodi_id`, `takad_id`, `status_portal`, `status_submit`, `status_baak`, `status_wadir`, `status_direktur`) VALUES
(1, 13, 5, 1, 1, 1, 1, 1),
(3, 14, 5, 1, 1, 1, 1, 1),
(4, 11, 5, 0, 0, 0, 0, 0),
(5, 12, 5, 1, 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `r_distribusi_setting`
--
ALTER TABLE `r_distribusi_setting`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `r_distribusi_setting`
--
ALTER TABLE `r_distribusi_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
