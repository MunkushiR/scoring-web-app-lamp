-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2025 at 09:07 PM
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
-- Database: `scoring_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `judges`
--

CREATE TABLE `judges` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `display_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `judges`
--

INSERT INTO `judges` (`id`, `username`, `display_name`) VALUES
(1, 'naserianmunkushi@gmail.com', 'Nase'),
(2, 'joy m', 'Joy mutai'),
(3, 'brian', 'watai'),
(4, 'charles', 'Judge Charles'),
(5, 'anita', 'Judge Anita'),
(6, 'kevin', 'Judge Kevin'),
(7, 'wambui', 'Judge Wambui'),
(8, 'yusuf', 'Judge Yusuf'),
(9, 'zawadi', 'Judge Zawadi'),
(10, 'amina', 'Judge Amina');

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`id`, `name`) VALUES
(1, 'Ruth Munkushi'),
(2, 'Brian Watai'),
(3, 'Cate Mwangi'),
(4, 'John Kamau'),
(5, 'Mary Wanjiku'),
(6, 'James Kamau'),
(7, 'Alice Muthoni'),
(8, 'Brian Otieno'),
(9, 'Mercy Wanjiku'),
(10, 'David Mwangi'),
(11, 'Njeri Ndegwa'),
(12, 'Peter Kipkoech'),
(13, 'Sharon Achieng');

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `id` int(11) NOT NULL,
  `judge_id` int(11) NOT NULL,
  `participant_id` int(11) NOT NULL,
  `points` int(11) NOT NULL CHECK (`points` between 1 and 100),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`id`, `judge_id`, `participant_id`, `points`, `created_at`) VALUES
(1, 1, 2, 20, '2025-05-23 12:10:35'),
(2, 2, 4, 70, '2025-05-23 12:16:02'),
(3, 2, 5, 12, '2025-05-23 16:30:40'),
(4, 3, 5, 50, '2025-05-23 16:32:23'),
(5, 3, 2, 30, '2025-05-23 16:33:21'),
(6, 3, 2, 5, '2025-05-23 16:34:02'),
(7, 1, 2, 5, '2025-05-23 16:34:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `judges`
--
ALTER TABLE `judges`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `judge_id` (`judge_id`),
  ADD KEY `participant_id` (`participant_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `judges`
--
ALTER TABLE `judges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `scores`
--
ALTER TABLE `scores`
  ADD CONSTRAINT `scores_ibfk_1` FOREIGN KEY (`judge_id`) REFERENCES `judges` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `scores_ibfk_2` FOREIGN KEY (`participant_id`) REFERENCES `participants` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
