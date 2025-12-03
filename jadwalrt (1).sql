-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2025 at 05:55 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jadwalrt`
--

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id` int(200) NOT NULL,
  `tanggal` date NOT NULL,
  `acara` varchar(20) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `lokasi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id`, `tanggal`, `acara`, `keterangan`, `lokasi`) VALUES
(0, '0000-00-00', '', '', ''),
(1, '2025-11-13', 'adasdasdsa', 'asdasdwadds', 'dsadasdas'),
(3, '0000-00-00', '', 'asdsadsad', ''),
(4, '0000-00-00', '', 'sadsadasdsad', ''),
(5, '0000-00-00', '', 'sadsada', ''),
(6, '2025-08-17', 'perlombaan 17 agustu', 'merayakan 17 agustus adalah salah satu memperingati hari kemerdekaannya indonesia dari penjajahan', 'lapang balai kampung'),
(7, '2025-11-27', 'pengaosan rutin', 'pokonamah mantap seer jarcok', 'balai kampung'),
(9, '2025-12-03', 'pencerahan bulan roj', 'untuk menyambut kedatangan bukan rijab kita akan menyambutnya dengan kajian bersama ', 'majlis darutholibin'),
(11, '2025-12-01', 'gotong royong bersih', ' dengan ini saya meyatakan kemerdekaan\r\n', 'kampung cilemah');

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` int(10) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `tanggal_publikasi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `judul`, `keterangan`, `tanggal_publikasi`) VALUES
(0, 'hari ini ada mbg untuk masyarakat', 'pengumuman  ini menjadi momentum untuk warga kita karena telah di beri mbg sama prabowo', '2025-11-25'),
(1, 'rapat kerja bakti', 'menjadikan kampung yang bebas sampah', '2025-11-05'),
(2, 'hari ini ada mbg untuk masyarakat', 'welll', '2025-11-27'),
(3, 'saadsadsad', 'asdsadsad', '2025-11-27'),
(5, 'sdadad', 'sadsada', '2025-11-27'),
(7, 'dari bmkg', 'menjadikan apake gitu keteranganamah', '2025-12-03');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `nama` varchar(15) NOT NULL,
  `username` varchar(11) NOT NULL,
  `password` varchar(11) NOT NULL,
  `level` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`nama`, `username`, `password`, `level`) VALUES
('bunda', 'bun', 'cis', 'user'),
('lutvi jayadi', 'lutvi', 'well', 'admin'),
('pradika', 'pradik', 'masuk', 'user'),
('user', '123', 'user', '');

-- --------------------------------------------------------

--
-- Table structure for table `warga`
--

CREATE TABLE `warga` (
  `id` int(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `status` enum('warga','warga pendatang') DEFAULT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telepon` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `warga`
--

INSERT INTO `warga` (`id`, `nama`, `status`, `alamat`, `no_telepon`) VALUES
(1, 'upiii', 'warga pendatang', 'mana we', 897665768),
(2, 'nuryani', 'warga', 'kampung bojong waru', 897665768),
(3, 'kapal api mix', 'warga pendatang', 'sdsda', 234234),
(4, 'sadsa', 'warga pendatang', 'ddsadsa', 42342423),
(5, 'obet', 'warga', 'jl. Ciparay , des. Padamulya, rt 03/01 kec, das', 983897221);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`nama`);

--
-- Indexes for table `warga`
--
ALTER TABLE `warga`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
