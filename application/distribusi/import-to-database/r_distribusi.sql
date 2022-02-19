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
-- Table structure for table `r_distribusi`
--

CREATE TABLE `r_distribusi` (
  `id_distribusi` int(11) NOT NULL,
  `prodi_id` int(11) NOT NULL,
  `dosen_id` int(11) NOT NULL,
  `dosen_ke` int(11) NOT NULL,
  `matkul_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `tahunakad_id` int(11) NOT NULL,
  `status_submit` int(11) NOT NULL,
  `status_baak` int(1) NOT NULL,
  `status_wadir` int(1) NOT NULL,
  `status_direktur` int(11) NOT NULL,
  `keterangan` varchar(17) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `r_distribusi`
--

INSERT INTO `r_distribusi` (`id_distribusi`, `prodi_id`, `dosen_id`, `dosen_ke`, `matkul_id`, `kelas_id`, `tahunakad_id`, `status_submit`, `status_baak`, `status_wadir`, `status_direktur`, `keterangan`) VALUES
(105, 13, 19, 1, 113, 16, 5, 1, 1, 1, 1, 'Prodi Lokal TIF'),
(106, 13, 4, 2, 113, 16, 5, 1, 1, 1, 1, 'Prodi Lokal TIF'),
(107, 13, 4, 1, 103, 16, 5, 1, 1, 1, 1, 'Prodi Lokal TIF'),
(108, 13, 19, 2, 103, 16, 5, 1, 1, 1, 1, 'Prodi Lokal TIF'),
(111, 13, 2, 1, 105, 16, 5, 1, 1, 1, 1, 'Prodi Lokal TIF'),
(112, 13, 5, 1, 106, 16, 5, 1, 1, 1, 1, 'Prodi Lokal TIF'),
(113, 13, 4, 1, 109, 16, 5, 1, 1, 1, 1, 'Prodi Lokal TIF'),
(114, 13, 5, 1, 110, 16, 5, 1, 1, 1, 1, 'Prodi Lokal TIF'),
(115, 13, 2, 1, 111, 16, 5, 1, 1, 1, 1, 'Prodi Lokal TIF'),
(117, 13, 3, 1, 114, 6, 5, 1, 1, 1, 1, 'Prodi Lokal TIF'),
(118, 13, 4, 1, 115, 6, 5, 1, 1, 1, 1, 'Prodi Lokal TIF'),
(119, 13, 4, 1, 118, 6, 5, 1, 1, 1, 1, 'Prodi Lokal TIF'),
(120, 13, 19, 1, 120, 6, 5, 1, 1, 1, 1, 'Prodi Lokal TIF'),
(121, 13, 5, 2, 120, 6, 5, 1, 1, 1, 1, 'Prodi Lokal TIF'),
(122, 13, 3, 1, 121, 6, 5, 1, 1, 1, 1, 'Prodi Lokal TIF'),
(123, 13, 19, 1, 122, 6, 5, 1, 1, 1, 1, 'Prodi Lokal TIF'),
(124, 13, 1, 1, 123, 6, 5, 1, 1, 1, 1, 'Prodi Lokal TIF'),
(125, 13, 4, 1, 124, 6, 5, 1, 1, 1, 1, 'Prodi Lokal TIF'),
(126, 14, 17, 1, 126, 18, 5, 1, 1, 1, 1, 'Prodi Lokal ABI');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `r_distribusi`
--
ALTER TABLE `r_distribusi`
  ADD PRIMARY KEY (`id_distribusi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `r_distribusi`
--
ALTER TABLE `r_distribusi`
  MODIFY `id_distribusi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
