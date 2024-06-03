-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2024 at 05:27 AM
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
-- Database: `liepajadetailing`
--

-- --------------------------------------------------------

--
-- Table structure for table `cenas`
--

CREATE TABLE `cenas` (
  `id` int(11) NOT NULL,
  `darbs` varchar(50) NOT NULL,
  `apraksts` varchar(255) NOT NULL,
  `cena1` int(40) NOT NULL,
  `cena2` int(40) NOT NULL,
  `statuss` enum('active','inactive','','') NOT NULL,
  `tips` enum('Salons','Virsbūve','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_latvian_ci;

--
-- Dumping data for table `cenas`
--

INSERT INTO `cenas` (`id`, `darbs`, `apraksts`, `cena1`, `cena2`, `statuss`, `tips`) VALUES
(1, 'Pulēšana', 'Virsbūves pulēšana', 22, 53, 'active', 'Salons'),
(2, 'Vaskošana', 'Virsbūves apstrāde ar vasku', 15, 35, 'active', 'Virsbūve'),
(3, 'Keramika', 'Lukturu keramika', 14, 66, 'active', 'Salons'),
(4, 'Keramika', 'Virsbūves keramika', 66, 88, 'active', 'Salons');

-- --------------------------------------------------------

--
-- Table structure for table `darbi`
--

CREATE TABLE `darbi` (
  `darbs_id` int(4) NOT NULL,
  `darbs_nosaukums` varchar(30) NOT NULL,
  `darbs_apraksts` varchar(60) NOT NULL,
  `darbs_attels` varchar(255) NOT NULL,
  `darbs_statuss` enum('active','inactive','','') NOT NULL,
  `tips` enum('Salons','Virsbūve','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_latvian_ci;

--
-- Dumping data for table `darbi`
--

INSERT INTO `darbi` (`darbs_id`, `darbs_nosaukums`, `darbs_apraksts`, `darbs_attels`, `darbs_statuss`, `tips`) VALUES
(1, 'Lukturi', 'Lukturu pulēšama', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSl6E6_90cqetaacLwtGOTsnwrk5bE6En921JqTNas_NA&s', 'inactive', 'Salons'),
(2, 'Pulēšana', 'Auto virsbūves pulēšana', 'https://assets.cars24.com/production/blog-in-cms/wax-car-0a42ec4bd0.jpg', 'active', 'Virsbūve'),
(5, '1', 'Pulēšanas autodarbi', 'https://surfnshine.com/wp-content/uploads/2023/06/car-polishing.jpg', 'active', 'Salons'),
(8, '1', 'Pulēšanas autodarbi', 'https://www.carpro-us.com/product_images/uploaded_images/dotfuk8zdk7uutxwigt5cjkucqdzhzq01643116809.jpg', 'active', 'Salons'),
(9, '1', 'a', 'https://www.carpro-us.com/product_images/uploaded_images/dotfuk8zdk7uutxwigt5cjkucqdzhzq01643116809.jpg', 'active', 'Virsbūve'),
(10, '1', 'Pulēšanas autodarbi', 'https://surfnshine.com/wp-content/uploads/2023/06/car-polishing.jpg', 'active', 'Salons'),
(11, '1', 'aeae', 'https://www.carpro-us.com/product_images/uploaded_images/dotfuk8zdk7uutxwigt5cjkucqdzhzq01643116809.jpg', 'active', 'Salons'),
(12, '2', 'Pulēšanas autodarbi', 'https://www.carpro-us.com/product_images/uploaded_images/dotfuk8zdk7uutxwigt5cjkucqdzhzq01643116809.jpg', 'active', 'Virsbūve');

-- --------------------------------------------------------

--
-- Table structure for table `pieteikumi`
--

CREATE TABLE `pieteikumi` (
  `id` int(11) NOT NULL,
  `vards` varchar(255) NOT NULL,
  `uzvards` varchar(255) NOT NULL,
  `epasts` varchar(255) NOT NULL,
  `talrunis` varchar(15) NOT NULL,
  `komentari` text DEFAULT NULL,
  `auto_tiriba` enum('Tirs','Videji','Netirs') NOT NULL,
  `bildes` text DEFAULT NULL,
  `datums` date NOT NULL,
  `laiks` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_latvian_ci;

--
-- Dumping data for table `pieteikumi`
--

INSERT INTO `pieteikumi` (`id`, `vards`, `uzvards`, `epasts`, `talrunis`, `komentari`, `auto_tiriba`, `bildes`, `datums`, `laiks`) VALUES
(3, 'gdf', 'fgdg', 'asad@faf.lv', '23323232', ' sdfsf', 'Tirs', '', '0000-00-00', '00:00:00'),
(4, 'gdf', 'fgdg', 'asad@faf.lv', '23323232', ' sdfsf', 'Tirs', 'IMG_1518.jpeg', '0000-00-00', '00:00:00'),
(6, 'gdf', 'fgdg', 'asad@faf.lv', '23323232', ' sdfsf', 'Tirs', 'IMG_1518.jpeg', '0000-00-00', '00:00:00'),
(7, 'gdf', 'fgdg', 'asad@faf.lv', '23323232', ' sdfsf', 'Tirs', 'IMG_1518.jpeg', '0000-00-00', '00:00:00'),
(8, 'gdf', 'fgdg', 'asad@faf.lv', '23323232', ' sdfsf', 'Tirs', 'IMG_1518.jpeg', '0000-00-00', '00:00:00'),
(9, 'gdf', 'fgdg', 'asad@faf.lv', '23323232', ' sdfsf', 'Tirs', 'IMG_1518.jpeg', '0000-00-00', '00:00:00'),
(10, 'gdf', 'fgdg', 'asad@faf.lv', '23323232', ' sdfsf', 'Tirs', 'IMG_1518.jpeg', '0000-00-00', '00:00:00'),
(11, 'gdf', 'fgdg', 'asad@faf.lv', '23323232', ' sdfsf', 'Videji', 'IMG_1534.jpeg', '0000-00-00', '00:00:00'),
(12, 'gdf', 'fgdg', 'asad@faf.lv', '23323232', ' sdfsf', 'Videji', 'IMG_1534.jpeg', '0000-00-00', '00:00:00'),
(13, 'gdf', 'fgdg', 'asad@faf.lv', '23323232', ' sdfsf', 'Videji', 'IMG_1534.jpeg', '0000-00-00', '00:00:00'),
(14, 'gdf', 'fgdg', 'asad@faf.lv', '23323232', ' sdfsf', 'Videji', 'IMG_1534.jpeg', '0000-00-00', '00:00:00'),
(15, 'gdf', 'fgdg', 'asad@faf.lv', '23323232', ' sdfsf', 'Tirs', 'IMG_1528.jpeg, IMG_1529.jpeg, IMG_1535.jpeg', '0000-00-00', '00:00:00'),
(17, 'gdf', 'fgdg', 'asad@faf.lv', '23323232', ' sdfsf', 'Videji', 'IMG_1535.jpeg', '0000-00-00', '00:00:00'),
(18, 'gdf', 'fgdg', 'asad@faf.lv', '23323232', ' sdfsf', 'Tirs', '', '0000-00-00', '02:33:33'),
(19, 'gdf', 'fgdg', 'asad@faf.lv', '23323232', ' sdfsf', 'Tirs', '', '2024-05-30', '10:00:00'),
(20, 'gdf209', 'fgdg', 'asad@faf.lv', '23323232', ' sdfsf', 'Tirs', '', '0000-00-00', '00:00:00'),
(21, 'gdf', 'fgdg', 'asad@faf.lv', '23323232', '', 'Videji', '', '2024-06-03', '09:00:00'),
(22, 'gdf', 'fgdg', 'asad@faf.lv', '23323232', ' sdfsf', 'Tirs', '', '2024-06-05', '14:00:00'),
(23, 'Antons ', 'Lohbergs', 'asad@faf.lv', '23323232', ' sdfsf', 'Tirs', '', '0000-00-00', '00:00:00'),
(24, 'Antons 00000000000', 'Lohbergs22000000000', 'asad@faf.lv', '23323232', ' sdfsfeae', 'Netirs', '', '2024-06-27', '00:00:00'),
(25, 'Antons 4500232222222222222', 'Lohbergs', 'asad@faf.lvwe', '32323333', 'aaaaaaaaaaaaaaaaaaaaa', 'Videji', '', '2024-06-13', '05:00:00'),
(26, 'Antons 4500232222222222222', 'Lohbergs', 'asad@faf.lvwe', '32323333', 'aaaaaaaaaaaaaaaaaaaaa', 'Videji', '', '2024-06-12', '23:28:00'),
(27, 'Antons 4500232222222222222', 'Lohbergs', 'asad@faf.lvwe', '32323333', 'aaaaaaaaaaaaaaaaaaaaa', 'Videji', '', '2024-06-05', '22:29:00'),
(28, 'Antons 4500232222222222222', 'Lohbergs', 'asad@faf.lvwe', '32323333', 'aaaaaaaaaaaaaaaaaaaaa', 'Videji', '', '2024-06-18', '21:29:00'),
(30, 'gdf696969696696996', 'fgdg', 'asad@faf.lv', '23323232', ' sdfsf', 'Videji', '', '2024-06-20', '16:00:00'),
(31, 'Jānis', 'Bērzs', 'linka@gmail.com', '22445566', 'Mans auto ir dikti traks', 'Videji', '', '2024-06-11', '12:00:00'),
(32, 'gana', 'asadsdasd', 'asad@faf.lv', '23323232', ' sdfsf', 'Tirs', '', '2024-06-05', '10:00:00'),
(33, 'Antons ', 'Lohbergs', 'asad@faf.lv', '32323333', ' sdfsf', 'Videji', '', '2024-06-11', '10:00:00'),
(34, 'Antons ', 'Lohbergs', 'asad@faf.lvwe', '23323232', 'Mans auto ir dikti traks', 'Videji', '', '2024-06-04', '14:00:00'),
(35, 'Antons ', 'Lohbergs', 'antansagris@gmail.com', '32323333', 'Mans auto ir dikti traks', 'Tirs', '', '2024-06-24', '15:00:00'),
(36, 'Antons ', 'Lohbergs', 'antansagris@gmail.com', '32323333', 'Mans auto ir dikti traks', 'Tirs', '', '2024-06-25', '12:00:00'),
(37, 'Antons ', 'Lohbergs', 'antansagris@gmail.com', '32323333', 'Mans auto ir dikti traks', 'Tirs', '', '2024-06-10', '11:00:00'),
(38, 'Antons ', 'Lohbergs', 'antansagris@gmail.com', '32323333', 'Mans auto ir dikti traks', 'Tirs', '', '2024-06-17', '11:00:00'),
(39, 'Antons ', 'Lohbergs22', 'antansagris@gmail.com', '32323333', 'Mans auto ir dikti traks', 'Tirs', '', '2024-06-18', '10:30:00'),
(40, 'Antons ', 'Lohbergs', 'antansagris@gmail.com', '32323333', 'Mans auto ir dikti traks', 'Tirs', '', '2024-06-12', '10:00:00'),
(41, 'Antons ', 'Lohbergs', 'antansagris@gmail.com', '32323333', 'aaaaaaaaaaaaaaaaaaaaa', 'Tirs', '', '2024-06-19', '16:00:00'),
(42, 'Antons ', 'Lohbergs', 'antansagris@gmail.com', '32323333', 'Mans auto ir dikti traks', 'Tirs', '', '2024-06-25', '14:00:00'),
(43, 'Antons ', 'Lohbergs', 'antansagris@gmail.com', '32323333', 'Mans auto ir dikti traks', 'Tirs', '', '2024-06-20', '10:00:00'),
(44, 'Antons 11', 'Lohbergs22', 'antansagris@gmail.com', '23323232', 'aaaaaaaaaaaaaaaaaaaaa', 'Tirs', '', '2024-06-13', '15:00:00'),
(45, 'Antons ', 'Lohbergs22', 'antansagris@gmail.com', '22445566', 'aaaaaaaaaaaaaaaaaaaaa', 'Tirs', '', '2024-06-13', '10:00:00'),
(46, 'Antons ', 'Lohbergs22', 'antansagris@gmail.com', '32323333', 'aaaaaaaaaaaaaaaaaaaaa', 'Tirs', '', '2024-06-12', '15:00:00'),
(47, 'Antons ', 'Lohbergs22', 'antansagris@gmail.com', '32323333', 'Mans auto ir dikti traks', 'Tirs', '', '2024-07-17', '11:00:00'),
(48, 'Antons ', 'Lohbergs', 'antansagris@gmail.com', '23323232', ' sdfsfeae', 'Tirs', '', '2024-06-19', '10:00:00'),
(49, 'Antons ', 'Lohbergs', 'antansagris@gmail.com', '23323232', 'Mans auto ir dikti traks', 'Tirs', '', '2024-09-11', '10:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `pieteikumi_tags`
--

CREATE TABLE `pieteikumi_tags` (
  `submission_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_latvian_ci;

--
-- Dumping data for table `pieteikumi_tags`
--

INSERT INTO `pieteikumi_tags` (`submission_id`, `tag_id`) VALUES
(4, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 8),
(12, 8),
(13, 8),
(14, 8),
(15, 12),
(17, 1),
(17, 8),
(17, 14),
(17, 18),
(18, 1),
(18, 8),
(18, 22),
(19, 1),
(19, 14),
(20, 14),
(20, 22),
(21, 22),
(22, 14),
(24, 12),
(24, 22),
(31, 1),
(33, 1),
(34, 18),
(35, 1),
(36, 1),
(37, 14),
(38, 14),
(39, 14),
(40, 1),
(41, 1),
(42, 14),
(43, 14),
(44, 8),
(45, 1),
(46, 1),
(47, 1),
(48, 14),
(49, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_latvian_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`) VALUES
(8, 'Disku tīrīšana'),
(1, 'Keramika virsbūvei'),
(22, 'Logu tīrīšana'),
(12, 'Lukturu pulēšana'),
(14, 'Salona tīrīšana'),
(18, 'Virsbūves pulēšana');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `lietotajvards` varchar(60) NOT NULL,
  `vards` varchar(30) NOT NULL,
  `uzvards` varchar(30) NOT NULL,
  `epasts` varchar(40) NOT NULL,
  `parole` varchar(60) NOT NULL,
  `loma` enum('owner','user','customer','') NOT NULL,
  `statuss` enum('active','inactive','deleted','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_latvian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `lietotajvards`, `vards`, `uzvards`, `epasts`, `parole`, `loma`, `statuss`) VALUES
(1, 'max', 'Agris', 'Antons', 'anta@gmail.com', '$2y$10$2ucHlN8RutMS6bOdwYMiTeb3Jo.8GFThaH.sRBYlwylAzSa/L9tvC', 'owner', 'active'),
(2, '1', 'a', 'a', 'anta@gmail.com', '$2y$10$tdU1Qh5zmAqNwv8UHoNAjOUd/bd2tgHTjTybTjMvqzFfsvzTAnaLW', 'owner', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `vacancies`
--

CREATE TABLE `vacancies` (
  `id` int(11) NOT NULL,
  `title` varchar(40) NOT NULL,
  `description` varchar(255) NOT NULL,
  `wage` int(255) NOT NULL,
  `wage2` int(33) NOT NULL,
  `statuss` enum('active','inactive','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_latvian_ci;

--
-- Dumping data for table `vacancies`
--

INSERT INTO `vacancies` (`id`, `title`, `description`, `wage`, `wage2`, `statuss`) VALUES
(1, 'Pulētājs', 'Nepieciešams profesionāls auto pulētājs ar vismaz 6 gadu pieredzi', 1500, 3000, 'active'),
(2, 'Krāsotājs', 'Tiek meklēts profesionāls krāsotājs ar vismaz 6 gadu pieredzi krāsojot automašīnas', 1243, 1500, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `veicdarbi`
--

CREATE TABLE `veicdarbi` (
  `id` int(11) NOT NULL,
  `darbs` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_latvian_ci;

--
-- Dumping data for table `veicdarbi`
--

INSERT INTO `veicdarbi` (`id`, `darbs`) VALUES
(1, 'Pulēšana'),
(2, 'Keramika');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cenas`
--
ALTER TABLE `cenas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `darbi`
--
ALTER TABLE `darbi`
  ADD PRIMARY KEY (`darbs_id`);

--
-- Indexes for table `pieteikumi`
--
ALTER TABLE `pieteikumi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pieteikumi_tags`
--
ALTER TABLE `pieteikumi_tags`
  ADD PRIMARY KEY (`submission_id`,`tag_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vacancies`
--
ALTER TABLE `vacancies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `veicdarbi`
--
ALTER TABLE `veicdarbi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cenas`
--
ALTER TABLE `cenas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `darbi`
--
ALTER TABLE `darbi`
  MODIFY `darbs_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pieteikumi`
--
ALTER TABLE `pieteikumi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vacancies`
--
ALTER TABLE `vacancies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `veicdarbi`
--
ALTER TABLE `veicdarbi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pieteikumi_tags`
--
ALTER TABLE `pieteikumi_tags`
  ADD CONSTRAINT `pieteikumi_tags_ibfk_1` FOREIGN KEY (`submission_id`) REFERENCES `pieteikumi` (`id`),
  ADD CONSTRAINT `pieteikumi_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
