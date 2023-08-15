-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2023 at 05:13 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carpool`
--

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `idCar` int(11) NOT NULL,
  `model` varchar(255) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `car_make` varchar(255) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `plate_no` char(8) DEFAULT NULL,
  `chassis_no` char(17) NOT NULL,
  `Users_idUsers` int(11) DEFAULT NULL,
  `approved` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`idCar`, `model`, `capacity`, `car_make`, `type`, `plate_no`, `chassis_no`, `Users_idUsers`, `approved`) VALUES
(1, 'Stonic', 5, 'Kia', 'SUV', 'CBM-7625', '', 1, 1),
(2, 'Civic', 5, 'Honda', 'Sedan', 'ABM-1234', '', 1, 1),
(3, 'Wigo', 5, 'Toyota', 'SUV', 'BBM-4567', '', 1, 1),
(4, 'Kona', 5, 'Hyundai', 'SUV', 'ERD-1234', '', 1, 1),
(15, 'Stonic', 5, 'Kia', 'MPV', 'CBM-7625', '12345678901234567', 9, 1),
(16, 'Fortuner', 7, 'Toyota', 'SUV', 'ABM-1234', '12345678901234567', 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cashtransaction`
--

CREATE TABLE `cashtransaction` (
  `idCashTransac` int(11) NOT NULL,
  `transac_type` varchar(45) DEFAULT NULL,
  `transac_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `transac_amount` double DEFAULT NULL,
  `Users_idUsers` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE `rates` (
  `idRates` int(11) NOT NULL,
  `seat_position` varchar(45) DEFAULT NULL,
  `price` double(16,2) DEFAULT NULL,
  `Trip_idTrip` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`idRates`, `seat_position`, `price`, `Trip_idTrip`) VALUES
(1, 'Front Seat', 300.00, 1),
(2, 'Middle Seat', 140.00, 1),
(3, 'Left Seat', 250.00, 1),
(4, 'Right Seat', 250.00, 1),
(5, 'Front Seat', 130.00, 2),
(6, 'Middle Seat', 130.00, 2),
(7, 'Left Seat', 130.00, 2),
(8, 'Right Seat', 130.00, 2),
(9, 'Front Seat', 100.00, 3),
(10, 'Middle Seat', 100.00, 3),
(11, 'Left Seat', 100.00, 3),
(12, 'Right Seat', 100.00, 3),
(13, 'Front Seat', 60.00, 4),
(14, 'Middle Seat', 65.00, 4),
(15, 'Left Seat', 60.00, 4),
(16, 'Right Seat', 63.00, 4),
(17, 'Front Seat', 300.00, 5),
(18, 'Middle Seat', 300.00, 5),
(19, 'Left Seat', 300.00, 5),
(20, 'Right Seat', 300.00, 5),
(21, 'Front Seat', 100.00, 6),
(22, 'Middle Seat', 100.00, 6),
(23, 'Left Seat', 100.00, 6),
(24, 'Right Seat', 100.00, 6);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `idRating` int(11) NOT NULL,
  `rating_stars` int(11) DEFAULT NULL,
  `rating_msg` longtext DEFAULT NULL,
  `Users_idUsers` int(11) DEFAULT NULL,
  `Trip_idTrip` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trip`
--

CREATE TABLE `trip` (
  `idTrip` int(11) NOT NULL,
  `start_location` varchar(255) DEFAULT NULL,
  `end_location` varchar(255) DEFAULT NULL,
  `departure_date` datetime DEFAULT NULL,
  `seats_avail` int(11) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `Users_idUsers` int(11) DEFAULT NULL,
  `Car_idCar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trip`
--

INSERT INTO `trip` (`idTrip`, `start_location`, `end_location`, `departure_date`, `seats_avail`, `status`, `Users_idUsers`, `Car_idCar`) VALUES
(1, 'San Rafael, Bulacan', 'Malolos, Bulacan', '2023-05-04 08:50:00', 5, 'Waiting', 9, 15),
(2, 'Malolos, Bulacan', 'Pulian, Bulacan', '2023-05-04 08:57:00', 5, 'Waiting', 9, 15),
(3, 'San Rafael, Bulacan', 'Baliuag, Bulacan', '2023-05-04 08:59:00', 5, 'Waiting', 1, 2),
(4, 'Plaridel, Bulacan', 'Malolos, Bulacan', '2023-05-04 09:01:00', 5, 'Waiting', 9, 15),
(5, 'Baliuag, Bulacan', 'Malolos, Bulacan', '2023-05-04 09:07:00', 5, 'Waiting', 9, 15),
(6, 'Malolos, Bulacan', 'Baliuag, Bulacan', '2023-05-04 09:22:00', 5, 'Waiting', 9, 16);

-- --------------------------------------------------------

--
-- Table structure for table `trip_passengers`
--

CREATE TABLE `trip_passengers` (
  `Trip_idTrip` int(11) DEFAULT NULL,
  `Users_idUsers` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trip_passengers`
--

INSERT INTO `trip_passengers` (`Trip_idTrip`, `Users_idUsers`) VALUES
(2, 11);

-- --------------------------------------------------------

--
-- Table structure for table `trip_rates`
--

CREATE TABLE `trip_rates` (
  `Trip_idTrip` int(11) DEFAULT NULL,
  `Rates_idRates` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uID` int(11) NOT NULL,
  `fname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uPhone` char(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` date NOT NULL,
  `street` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `brgy` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prov` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `uEmail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uPswd` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uType` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uBal` double(16,2) DEFAULT NULL,
  `lic_no` char(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `applicant` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uID`, `fname`, `mname`, `lname`, `uPhone`, `birthday`, `street`, `brgy`, `city`, `prov`, `uEmail`, `uPswd`, `uType`, `uBal`, `lic_no`, `applicant`) VALUES
(1, 'rovic', 'test', 'vasallo', '09184639221', '2003-08-09', '1082 Kalsadang Bago Street', 'Caingin', 'San Rafael', 'Bulacan', 'jonasvasallo0809@gmail.com', 'jonas809', 'Driver', NULL, 'A00-00-000000', 0),
(5, 'admin', 'admin', 'admin', '09184639221', '0000-00-00', '', '', '', '', 'admin@gmail.com', 'secret', 'Admin', NULL, NULL, 0),
(9, 'Jonas', 'N/A', 'Vasallo', '09184639221', '2003-08-09', '1082 Kalsadang Bago Street', 'Caingin', 'San Rafael', 'Bulacan', 'iderrillix@gmail.com', 'jonas809', 'Driver', NULL, 'A00-00-000000', 0),
(11, 'Jonas', 'Cruz', 'Vasallo', '09184639221', '2023-05-09', '1082 Kalsadang Bago Street', 'Caingin', 'San Rafael', 'Bulacan', 'iderrillixjp@gmail.com', 'jonas809', 'Passenger', NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`idCar`),
  ADD KEY `Users_idUsers` (`Users_idUsers`);

--
-- Indexes for table `cashtransaction`
--
ALTER TABLE `cashtransaction`
  ADD PRIMARY KEY (`idCashTransac`),
  ADD KEY `Users_idUsers` (`Users_idUsers`);

--
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`idRates`),
  ADD KEY `Trip_idTrip` (`Trip_idTrip`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`idRating`),
  ADD KEY `Users_idUsers` (`Users_idUsers`),
  ADD KEY `Trip_idTrip` (`Trip_idTrip`);

--
-- Indexes for table `trip`
--
ALTER TABLE `trip`
  ADD PRIMARY KEY (`idTrip`),
  ADD KEY `Users_idUsers` (`Users_idUsers`),
  ADD KEY `Car_idCar` (`Car_idCar`);

--
-- Indexes for table `trip_passengers`
--
ALTER TABLE `trip_passengers`
  ADD KEY `Trip_idTrip` (`Trip_idTrip`),
  ADD KEY `Users_idUsers` (`Users_idUsers`);

--
-- Indexes for table `trip_rates`
--
ALTER TABLE `trip_rates`
  ADD KEY `Trip_idTrip` (`Trip_idTrip`),
  ADD KEY `Rates_idRates` (`Rates_idRates`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `car`
--
ALTER TABLE `car`
  MODIFY `idCar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `cashtransaction`
--
ALTER TABLE `cashtransaction`
  MODIFY `idCashTransac` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `idRates` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `idRating` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trip`
--
ALTER TABLE `trip`
  MODIFY `idTrip` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `car_ibfk_1` FOREIGN KEY (`Users_idUsers`) REFERENCES `users` (`uID`);

--
-- Constraints for table `cashtransaction`
--
ALTER TABLE `cashtransaction`
  ADD CONSTRAINT `cashtransaction_ibfk_1` FOREIGN KEY (`Users_idUsers`) REFERENCES `users` (`uID`);

--
-- Constraints for table `rates`
--
ALTER TABLE `rates`
  ADD CONSTRAINT `rates_ibfk_1` FOREIGN KEY (`Trip_idTrip`) REFERENCES `trip` (`idTrip`) ON DELETE CASCADE;

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`Users_idUsers`) REFERENCES `users` (`uID`),
  ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`Trip_idTrip`) REFERENCES `trip` (`idTrip`);

--
-- Constraints for table `trip`
--
ALTER TABLE `trip`
  ADD CONSTRAINT `trip_ibfk_1` FOREIGN KEY (`Users_idUsers`) REFERENCES `users` (`uID`),
  ADD CONSTRAINT `trip_ibfk_2` FOREIGN KEY (`Car_idCar`) REFERENCES `car` (`idCar`);

--
-- Constraints for table `trip_passengers`
--
ALTER TABLE `trip_passengers`
  ADD CONSTRAINT `trip_passengers_ibfk_1` FOREIGN KEY (`Trip_idTrip`) REFERENCES `trip` (`idTrip`),
  ADD CONSTRAINT `trip_passengers_ibfk_2` FOREIGN KEY (`Users_idUsers`) REFERENCES `users` (`uID`);

--
-- Constraints for table `trip_rates`
--
ALTER TABLE `trip_rates`
  ADD CONSTRAINT `trip_rates_ibfk_1` FOREIGN KEY (`Trip_idTrip`) REFERENCES `trip` (`idTrip`),
  ADD CONSTRAINT `trip_rates_ibfk_2` FOREIGN KEY (`Rates_idRates`) REFERENCES `rates` (`idRates`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
