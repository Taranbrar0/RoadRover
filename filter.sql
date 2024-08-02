-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2024 at 08:41 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `filter`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `make` text NOT NULL,
  `model` text NOT NULL,
  `price` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `transmission` text NOT NULL,
  `fuelType` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `make`, `model`, `price`, `year`, `transmission`, `fuelType`, `image`) VALUES
(1, 'Honda', 'Civic', 30000, 2019, 'Manual', 'Electric', 'images\\pexels-jakub-pabis-147246622-16475137-removebg-preview.png'),
(2, 'Mercedes', 'AMG GT', 155000, 2022, 'Automatic', 'Gasoline', 'images/pexels-mikebirdy-193021-removebg-preview.png'),
(3, 'Range Rover', 'Sports', 110000, 2020, 'Automatic', 'Gasoline', 'images/jack-lucas-smith-crhK6sKfaAY-unsplash-removebg-preview.jpg'),
(4, 'Toyota', 'Carolla', 20000, 2023, 'Automatic', 'Gasoline', 'images/kashif-afridi-ld3jq4dsj8w-unsplash-removebg-preview.png'),
(5, 'Ford', 'Bronco', 40000, 2018, 'Automatic', 'Gasoline', 'images/pexels-jakewymoore-18205407-removebg-preview.png'),
(6, 'Audi', 'A4', 40000, 2020, 'Automatic', 'Gasoline', 'images/pexels-ryan-west-838532-1719648-removebg-preview.png'),
(7, 'Toyota', 'Supra', 45000, 2021, 'Automatic', 'Gasoline', 'images/pexels-introspectivedsgn-25955747-removebg-preview.png'),
(15, 'Jeep', 'Wrangler', 40000, 2020, 'manual', 'gasoline', 'images/kenny-eliason-yDekvyZ52dU-unsplash-removebg.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `newcars`
--

CREATE TABLE `newcars` (
  `id` int(11) NOT NULL,
  `make` text NOT NULL,
  `model` text NOT NULL,
  `price` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `transmission` text NOT NULL,
  `fuelType` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `newcars`
--

INSERT INTO `newcars` (`id`, `make`, `model`, `price`, `year`, `transmission`, `fuelType`, `image`) VALUES
(1, 'Honda', 'Civic', 30000, 2024, 'Manual', 'Gasoline', 'images\\pexels-jakub-pabis-147246622-16475137-removebg-preview.png'),
(2, 'Mercedes', 'AMG GT', 155000, 2024, 'Automatic', 'Gasoline', 'images\\pexels-mikebirdy-193021-removebg-preview.png'),
(3, 'Range Rover', 'Sports', 110000, 2024, 'Manual', 'Electric', 'images\\jack-lucas-smith-crhK6sKfaAY-unsplash-removebg-preview.jpg'),
(4, 'Toyota', 'Carolla', 20000, 2024, 'Automatic', 'Electric', 'images\\kashif-afridi-ld3jq4dsj8w-unsplash-removebg-preview.png'),
(5, 'Ford', 'Bronco', 40000, 2024, 'Manual', 'Gasoline', 'images\\pexels-jakewymoore-18205407-removebg-preview.png'),
(6, 'Audi', 'A4', 40000, 2024, 'Automatic', 'Electric', 'images/pexels-ryan-west-838532-1719648-removebg-preview.png'),
(7, 'Toyota', 'Supra', 45000, 2024, 'Automatic', 'Gasoline', 'images\\pexels-introspectivedsgn-25955747-removebg-preview.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newcars`
--
ALTER TABLE `newcars`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `newcars`
--
ALTER TABLE `newcars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
