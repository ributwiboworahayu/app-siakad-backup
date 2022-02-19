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
-- Table structure for table `r_distribusi_lb`
--

CREATE TABLE `r_distribusi_lb` (
  `id_distribusi_lb` int(11) NOT NULL,
  `prodi_id` int(11) NOT NULL,
  `dosen_lb_id` int(11) NOT NULL,
  `dosen_ke` int(11) NOT NULL,
  `matkul_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `tahunakad_id` int(11) NOT NULL,
  `status_submit` int(11) NOT NULL,
  `status_baak` int(11) NOT NULL,
  `status_wadir` int(11) NOT NULL,
  `status_direktur` int(11) NOT NULL,
  `keterangan` varchar(17) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `r_distribusi_lb`
--

INSERT INTO `r_distribusi_lb` (`id_distribusi_lb`, `prodi_id`, `dosen_lb_id`, `dosen_ke`, `matkul_id`, `kelas_id`, `tahunakad_id`, `status_submit`, `status_baak`, `status_wadir`, `status_direktur`, `keterangan`) VALUES
(9, 13, 2, 1, 103, 17, 5, 1, 1, 1, 1, 'DLB '),
(10, 13, 1, 1, 104, 17, 5, 1, 1, 1, 1, 'DLB '),
(11, 13, 3, 1, 106, 17, 5, 1, 1, 1, 1, 'DLB '),
(12, 13, 1, 1, 105, 17, 5, 1, 1, 1, 1, 'DLB '),
(15, 13, 5, 1, 107, 16, 5, 1, 1, 1, 1, 'DLB '),
(16, 13, 3, 1, 108, 16, 5, 1, 1, 1, 1, 'DLB '),
(17, 13, 1, 1, 104, 16, 5, 1, 1, 1, 1, 'DLB '),
(19, 13, 3, 1, 119, 6, 5, 1, 1, 1, 1, 'DLB '),
(20, 13, 2, 1, 125, 6, 5, 1, 1, 1, 1, 'DLB '),
(21, 13, 3, 1, 116, 6, 5, 1, 1, 1, 1, 'DLB ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `r_distribusi_lb`
--
ALTER TABLE `r_distribusi_lb`
  ADD PRIMARY KEY (`id_distribusi_lb`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `r_distribusi_lb`
--
ALTER TABLE `r_distribusi_lb`
  MODIFY `id_distribusi_lb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
