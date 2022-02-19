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
-- Table structure for table `r_distribusi_lp`
--

CREATE TABLE `r_distribusi_lp` (
  `id_distribusi_lp` int(11) NOT NULL,
  `prodi_id` int(11) NOT NULL,
  `prodi_lintas_id` int(11) NOT NULL,
  `dosen_lintas_id` int(11) NOT NULL,
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
-- Dumping data for table `r_distribusi_lp`
--

INSERT INTO `r_distribusi_lp` (`id_distribusi_lp`, `prodi_id`, `prodi_lintas_id`, `dosen_lintas_id`, `dosen_ke`, `matkul_id`, `kelas_id`, `tahunakad_id`, `status_submit`, `status_baak`, `status_wadir`, `status_direktur`, `keterangan`) VALUES
(36, 13, 11, 6, 1, 112, 16, 5, 1, 1, 1, 1, 'Lintas Prodi TPS'),
(37, 13, 14, 15, 1, 44, 16, 5, 1, 1, 1, 1, 'Lintas Prodi ABI'),
(38, 13, 14, 15, 1, 117, 6, 5, 1, 1, 1, 1, 'Lintas Prodi ABI');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `r_distribusi_lp`
--
ALTER TABLE `r_distribusi_lp`
  ADD PRIMARY KEY (`id_distribusi_lp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `r_distribusi_lp`
--
ALTER TABLE `r_distribusi_lp`
  MODIFY `id_distribusi_lp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
