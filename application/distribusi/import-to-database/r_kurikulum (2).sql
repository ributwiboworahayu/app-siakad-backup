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
-- Table structure for table `r_kurikulum`
--

CREATE TABLE `r_kurikulum` (
  `id` int(11) NOT NULL,
  `tahun` varchar(5) NOT NULL,
  `namakurikulum` varchar(128) NOT NULL,
  `prodi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `r_kurikulum`
--

INSERT INTO `r_kurikulum` (`id`, `tahun`, `namakurikulum`, `prodi_id`) VALUES
(1, '2021', 'PPM', 12),
(2, '2022', 'PPM22', 12),
(9, '2011', '2011', 13),
(21, '2021', 'K2022', 13),
(22, '2022', '2022', 13),
(23, '2021', 'ABI', 14);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `r_kurikulum`
--
ALTER TABLE `r_kurikulum`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `r_kurikulum`
--
ALTER TABLE `r_kurikulum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
