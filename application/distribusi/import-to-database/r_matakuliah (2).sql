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
-- Table structure for table `r_matakuliah`
--

CREATE TABLE `r_matakuliah` (
  `id` int(11) NOT NULL,
  `kurikulum_id` int(11) NOT NULL,
  `semester_id` int(2) NOT NULL,
  `kodematkul` varchar(8) NOT NULL,
  `matkul` varchar(128) NOT NULL,
  `kel` varchar(3) NOT NULL,
  `sks` int(2) NOT NULL,
  `teori` int(2) NOT NULL,
  `praktek` int(2) NOT NULL,
  `smtket` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `r_matakuliah`
--

INSERT INTO `r_matakuliah` (`id`, `kurikulum_id`, `semester_id`, `kodematkul`, `matkul`, `kel`, `sks`, `teori`, `praktek`, `smtket`) VALUES
(31, 9, 1, 'PK1011', 'Agama', 'MPK', 2, 2, 0, 'Ganjil'),
(32, 9, 1, 'PK1021', 'Matematika Dasar', 'MKK', 2, 2, 0, 'Ganjil'),
(33, 9, 1, 'PK1031', 'Fisika Dasar', 'MKK', 2, 2, 0, 'Ganjil'),
(34, 9, 1, 'PK1041', 'Keselamatan dan Kesehatan Kerja', 'MKK', 2, 2, 0, 'Ganjil'),
(35, 9, 1, 'TI1011', 'Algoritma dan Pemrograman 1', 'MKB', 2, 2, 0, 'Ganjil'),
(36, 9, 1, 'TI1021', 'Komputer dan Internet', 'MPB', 1, 1, 0, 'Ganjil'),
(37, 9, 1, 'TI1031', 'Pengantar Sistem Informasi', 'MKB', 2, 2, 0, 'Ganjil'),
(38, 9, 1, 'PK1052', 'Praktik Aplikasi Perkantoran', 'MKK', 2, 0, 2, 'Ganjil'),
(39, 9, 1, 'PK1062', 'Praktik Bahasa Inggris Terapan 1', 'MBB', 1, 0, 1, 'Ganjil'),
(40, 9, 1, 'PK1072', 'Proses Permesinan', 'MPB', 1, 0, 1, 'Ganjil'),
(41, 9, 1, 'TI1012', 'Praktik Algoritma dan Pemrograman 1', 'MKB', 2, 0, 2, 'Ganjil'),
(42, 9, 1, 'TI1022', 'Praktik Komputer dan Internet', 'MPB', 2, 0, 2, 'Ganjil'),
(43, 9, 1, 'TI1042', 'Praktik Fisika', 'MKK', 1, 0, 1, 'Ganjil'),
(44, 9, 2, 'PK2081', 'Pancasila & Kewarganegaraan', 'MPK', 3, 3, 0, 'Genap'),
(89, 9, 5, 'ECM', 'Praktik E-Commerce', '', 0, 0, 2, 'Ganjil'),
(90, 9, 5, 'KWR', 'Kewirausahaan', '', 0, 2, 0, 'Ganjil'),
(91, 9, 5, 'AI', 'Praktik Jaringan Syaraf Tiruan/Kecerdasan Buatan', '', 0, 0, 2, 'Ganjil'),
(92, 9, 5, 'TA', 'Tugas Akhir', '', 0, 0, 6, 'Ganjil'),
(103, 9, 2, '=A2+1', 'PBO', '', 1, 1, 0, 'Genap'),
(104, 9, 2, '=A3+1', 'Matematika Diskrit', '', 2, 2, 0, 'Genap'),
(105, 9, 2, '=A4+1', 'Microcontroller*', '', 1, 1, 0, 'Genap'),
(106, 9, 2, '=A5+1', 'DBMS*', '', 2, 2, 0, 'Genap'),
(107, 9, 2, '=A6+1', 'Organisasi & Arsitektur Komputer', '', 3, 3, 0, 'Genap'),
(108, 9, 2, '=A7+1', 'Praktik Bahasa Inggris Terapan I', '', 2, 0, 2, 'Genap'),
(109, 9, 2, '=A8+1', 'Praktik PBO', '', 2, 0, 2, 'Genap'),
(110, 9, 2, '=A9+1', 'Praktek DBMS', '', 2, 0, 2, 'Genap'),
(111, 9, 2, '=A10+1', 'Praktik Microcontroller', '', 2, 0, 2, 'Genap'),
(112, 9, 2, '=A11+1', 'Multimedia', '', 2, 2, 0, 'Genap'),
(113, 9, 2, '=A12+1', 'Pemograman Dasar', '', 2, 2, 0, 'Genap'),
(114, 9, 4, '', 'Manajemen Proyek*', '', 2, 2, 0, 'Genap'),
(115, 9, 4, '', 'ERP (Enterprise Resources Planning)', '', 1, 1, 0, 'Genap'),
(116, 9, 4, '', 'Sistem Operasi', '', 1, 1, 0, 'Genap'),
(117, 9, 4, '', 'Praktik Bahasa Inggris Terapan I', '', 2, 0, 2, 'Genap'),
(118, 9, 4, '', 'Sistem Embended*', '', 2, 0, 0, 'Genap'),
(119, 9, 4, '', ' Praktik Sistem Operasi', '', 2, 0, 2, 'Genap'),
(120, 9, 4, '', 'Bahasa Indonesia (TTL)', '', 2, 0, 0, 'Genap'),
(121, 9, 4, '', 'Praktik GIS*', '', 2, 0, 2, 'Genap'),
(122, 9, 4, '', 'Animasi', '', 2, 0, 0, 'Genap'),
(123, 9, 4, '', 'Proyek 2', 'MPK', 2, 0, 2, 'Genap'),
(124, 9, 4, '', 'Praktik ERP (Enterprise Resources Planning)', '', 2, 0, 2, 'Genap'),
(125, 9, 4, '', 'Praktek Administasi jaringan(mikrotik)', '', 2, 0, 2, 'Genap'),
(126, 23, 2, 'ABI1', 'Bahasa Inggris 1', 'MPK', 2, 2, 2, 'Genap'),
(127, 23, 2, 'ABI2', 'Praktek Bahasa Inggris 1', 'MPK', 1, 1, 1, 'Genap'),
(128, 23, 2, 'ABI3', 'Pengantar Bisnis Internasional', 'MPK', 3, 3, 3, 'Genap'),
(129, 23, 2, 'ABI4', 'Pengantar Ekonomi', 'MPK', 3, 3, 3, 'Genap'),
(130, 23, 2, 'ABI5', 'Matematika Bisnis', 'MPK', 3, 3, 3, 'Genap'),
(131, 23, 2, 'ABI6', 'Matematika Bisnis', 'MPK', 2, 2, 2, 'Genap'),
(132, 23, 2, 'ABI7', 'Bahasa Indonesia', 'MPK', 2, 2, 2, 'Genap'),
(133, 23, 2, 'ABI8', ' Teori Organisasi', 'MPK', 3, 3, 3, 'Genap'),
(134, 23, 2, 'ABI9', 'Teori Administrasi', 'MPK', 3, 3, 3, 'Genap'),
(137, 9, 6, 'CPS', 'Capita Selecta', 'MKK', 2, 2, 0, 'Genap'),
(138, 9, 6, 'EP', 'Etika Profesi', 'MPK', 2, 2, 0, 'Genap'),
(139, 9, 6, 'PKL', 'Praktik Kerja Lapangan', 'MBB', 6, 0, 6, 'Genap');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `r_matakuliah`
--
ALTER TABLE `r_matakuliah`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `r_matakuliah`
--
ALTER TABLE `r_matakuliah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
