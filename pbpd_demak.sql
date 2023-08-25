-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2023 at 08:04 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pbpd_demak`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_capel`
--

CREATE TABLE `data_capel` (
  `id_capel` int(11) NOT NULL,
  `id_ulp` int(11) DEFAULT NULL,
  `nama_capel` varchar(255) DEFAULT NULL,
  `daya_capel` int(11) DEFAULT NULL,
  `biaya_penyambungan` int(11) DEFAULT NULL,
  `biaya_investasi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_detail_mdu`
--

CREATE TABLE `data_detail_mdu` (
  `id_detail_mdu` int(11) NOT NULL,
  `id_master_mdu` int(11) DEFAULT NULL,
  `nama_detail_mdu` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_kebutuhan_mdu`
--

CREATE TABLE `data_kebutuhan_mdu` (
  `id_rincian_mdu` int(11) NOT NULL,
  `id_detail_mdu` int(11) DEFAULT NULL,
  `id_capel` int(11) DEFAULT NULL,
  `volume_mdu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_master_mdu`
--

CREATE TABLE `data_master_mdu` (
  `id_master_mdu` int(11) NOT NULL,
  `nama_master_mdu` varbinary(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_ulp`
--

CREATE TABLE `data_ulp` (
  `id_ulp` int(5) NOT NULL,
  `nama_ulp` varchar(11) NOT NULL,
  `ket_ulp` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `data_ulp`
--

INSERT INTO `data_ulp` (`id_ulp`, `nama_ulp`, `ket_ulp`) VALUES
(52551, 'Demak', 'DMK'),
(52552, 'Tegowanu', 'TGW'),
(52553, 'Purwodadi', 'PWD'),
(52554, 'Wirosari', 'WRS');

-- --------------------------------------------------------

--
-- Table structure for table `data_user`
--

CREATE TABLE `data_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(15) DEFAULT NULL,
  `pass_user` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `data_user`
--

INSERT INTO `data_user` (`id_user`, `nama_user`, `pass_user`) VALUES
(1, '52550.ANGGA', 'f390f13c2a08201077a3dad372164f4a'),
(2, '52550.TEST', 'f390f13c2a08201077a3dad372164f4a');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_capel`
--
ALTER TABLE `data_capel`
  ADD PRIMARY KEY (`id_capel`),
  ADD KEY `fk_to_id_ulp` (`id_ulp`);

--
-- Indexes for table `data_detail_mdu`
--
ALTER TABLE `data_detail_mdu`
  ADD PRIMARY KEY (`id_detail_mdu`),
  ADD KEY `fk_to_master_mdu` (`id_master_mdu`);

--
-- Indexes for table `data_kebutuhan_mdu`
--
ALTER TABLE `data_kebutuhan_mdu`
  ADD PRIMARY KEY (`id_rincian_mdu`),
  ADD KEY `fk_to_detail_mdu` (`id_detail_mdu`),
  ADD KEY `fk_to_capel` (`id_capel`);

--
-- Indexes for table `data_master_mdu`
--
ALTER TABLE `data_master_mdu`
  ADD PRIMARY KEY (`id_master_mdu`);

--
-- Indexes for table `data_ulp`
--
ALTER TABLE `data_ulp`
  ADD PRIMARY KEY (`id_ulp`),
  ADD KEY `id_ulp` (`id_ulp`);

--
-- Indexes for table `data_user`
--
ALTER TABLE `data_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_capel`
--
ALTER TABLE `data_capel`
  MODIFY `id_capel` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_detail_mdu`
--
ALTER TABLE `data_detail_mdu`
  MODIFY `id_detail_mdu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_user`
--
ALTER TABLE `data_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_capel`
--
ALTER TABLE `data_capel`
  ADD CONSTRAINT `fk_to_id_ulp` FOREIGN KEY (`id_ulp`) REFERENCES `data_ulp` (`id_ulp`);

--
-- Constraints for table `data_detail_mdu`
--
ALTER TABLE `data_detail_mdu`
  ADD CONSTRAINT `fk_to_master_mdu` FOREIGN KEY (`id_master_mdu`) REFERENCES `data_master_mdu` (`id_master_mdu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_kebutuhan_mdu`
--
ALTER TABLE `data_kebutuhan_mdu`
  ADD CONSTRAINT `fk_to_capel` FOREIGN KEY (`id_capel`) REFERENCES `data_capel` (`id_capel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_to_detail_mdu` FOREIGN KEY (`id_detail_mdu`) REFERENCES `data_detail_mdu` (`id_detail_mdu`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
