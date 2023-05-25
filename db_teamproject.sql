-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2023 at 05:06 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_teamproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `jobdesc`
--

CREATE TABLE `jobdesc` (
  `id_jobdesc` int(11) NOT NULL,
  `nama_jobdesc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobdesc`
--

INSERT INTO `jobdesc` (`id_jobdesc`, `nama_jobdesc`) VALUES
(2, 'Front End Developer'),
(16, 'Project Manager'),
(17, 'Back End Developer'),
(18, 'UI/UX Designer');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id_project` int(11) NOT NULL,
  `nama_project` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id_project`, `nama_project`) VALUES
(1, 'Weverse Official'),
(2, 'TechLabel'),
(8, 'SiMill Energy');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id_anggota` int(11) NOT NULL,
  `foto_anggota` varchar(255) NOT NULL,
  `nama_anggota` varchar(100) NOT NULL,
  `id_project` int(11) NOT NULL,
  `id_jobdesc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id_anggota`, `foto_anggota`, `nama_anggota`, `id_project`, `id_jobdesc`) VALUES
(16, 'yunjin.jpeg', 'Huh Yunjin', 1, 17),
(17, 'jungkook.jpeg', 'Jeon Jungkook', 8, 18),
(18, 'dahyun.jpeg', 'Kim Dahyun', 2, 2),
(20, 'yoongi.jpeg', 'Min Yoongi', 2, 17),
(21, 'rosé.jpeg', 'Roseanne Park', 8, 16),
(22, 'namjoon.jpeg', 'Kim Namjoon', 2, 16),
(23, 'mingyu.jpeg', 'Kim Mingyu', 2, 16);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jobdesc`
--
ALTER TABLE `jobdesc`
  ADD PRIMARY KEY (`id_jobdesc`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id_project`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id_anggota`),
  ADD KEY `divisi_id` (`id_project`),
  ADD KEY `jabatan_id` (`id_jobdesc`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jobdesc`
--
ALTER TABLE `jobdesc`
  MODIFY `id_jobdesc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id_project` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `team`
--
ALTER TABLE `team`
  ADD CONSTRAINT `team_ibfk_1` FOREIGN KEY (`id_project`) REFERENCES `project` (`id_project`) ON UPDATE CASCADE,
  ADD CONSTRAINT `team_ibfk_2` FOREIGN KEY (`id_jobdesc`) REFERENCES `jobdesc` (`id_jobdesc`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
