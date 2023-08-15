-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2023 at 11:15 AM
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
(16, 'Fortuner', 7, 'Toyota', 'SUV', 'ABM-1234', '12345678901234567', 9, 1),
(20, 'Mirage', 4, 'Mitsubishi', 'Sedan', 'CDN-7826', 'LJD4AA19BL0078798', 16, 1),
(21, 'Terra', 5, 'Nissan', 'SUV', 'EZG-6969', '12345678901234567', 17, 1),
(22, 'Accent', 5, 'Hyundai', 'Sedan', 'UMO-6666', 'LJD4AA19BL0078799', 19, 1),
(23, 'Raptor', 5, 'Ford', 'SUV', 'AZN-2121', '12345678901234567', 20, 1),
(24, 'sdsdsd', 6, 'sdsdsd', 'SUV', 'sdddsdsd', 'sdsdsdsdsdsdddddd', 22, 0),
(25, 'Cat', 5, 'Tiger', 'Sedan', 'TGR-6969', '12345678901234567', 23, 1),
(26, 'Albion', 4, 'Swiftclaw', 'Sedan', 'WTF-2454', '13231232131212342', 24, 1),
(27, 'Stonic', 4, 'Mitsubishi', 'SUV', 'WWW-5566', '12345678901234567', 25, 1),
(28, 'Wigo', 4, 'Toyota', 'SUV', 'ABM-1234', '12345678901234567', 27, 1),
(29, 'Stonic', 4, 'Kia', 'SUV', 'WTP-1234', '09494394393493949', 29, 1),
(30, 'Fortuner', 4, 'Toyota', 'SUV', 'CBM-7626', '12345678901234567', 30, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cashtransaction`
--

CREATE TABLE `cashtransaction` (
  `idCashTransac` int(11) NOT NULL,
  `transac_type` varchar(45) DEFAULT NULL,
  `transac_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `transac_amount` double DEFAULT NULL,
  `process_fee` int(11) NOT NULL,
  `convert_fee` double(16,2) NOT NULL,
  `gcash_ref` char(8) NOT NULL,
  `gcash_no` char(11) NOT NULL,
  `transac_bal` int(11) NOT NULL,
  `transac_status` varchar(45) NOT NULL,
  `Users_idUsers` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cashtransaction`
--

INSERT INTO `cashtransaction` (`idCashTransac`, `transac_type`, `transac_date`, `transac_amount`, `process_fee`, `convert_fee`, `gcash_ref`, `gcash_no`, `transac_bal`, `transac_status`, `Users_idUsers`) VALUES
(1, 'Cash In', '2023-05-17 16:31:37', 50, 0, 10.00, '12345678', '09184639221', 450, '', 1),
(2, 'Cash In', '2023-05-18 11:42:19', 50, 0, 10.00, '12345678', '09184639221', 900, '', 9),
(3, 'Cash Out', '2023-05-18 11:51:04', 50, 0, 10.00, '12345678', '09184639221', 1350, '', 9),
(4, 'Cash In', '2023-05-18 13:01:26', 500, 0, 50.00, '12345678', '09184639222', 1800, '', 9),
(5, 'Cash Out', '2023-05-18 13:25:49', 1740, 60, 0.00, '', '09184639221', 60, '', 9),
(6, 'Cash In', '2023-05-18 13:29:11', 500, 0, 50.00, '12345678', '09184639221', 510, '', 9),
(7, 'Cash Out', '2023-05-18 13:29:21', 190, 20, 0.00, '', '09184639221', 300, '', 9),
(8, 'Cash Out', '2023-05-18 13:30:04', 280, 20, 0.00, '', '09184639221', 0, '', 9),
(9, 'Cash In', '2023-05-18 13:30:19', 500, 0, 50.00, '12345678', '09184639221', 450, '', 9),
(10, 'Cash Out', '2023-05-18 13:30:27', 430, 20, 0.00, '', '09184639221', 0, '', 9),
(11, 'Cash In', '2023-05-18 13:50:06', 500, 0, 50.00, '12345678', '09184639222', 450, 'Complete', 9),
(12, 'Cash Out', '2023-05-18 13:50:48', 430, 20, 0.00, '', '09184639221', 0, 'Complete', 9),
(13, 'Cash In', '2023-05-18 13:52:47', 500, 0, 50.00, '12345678', '09184639221', 450, 'Complete', 9),
(14, 'Cash Out', '2023-05-18 14:40:30', 1010, 40, 0.00, '', '09184639221', 0, 'Complete', 9),
(15, 'Cash In', '2023-05-18 14:41:23', 500, 0, 50.00, '12345678', '09184639221', 450, 'Complete', 9),
(16, 'Cash Out', '2023-05-18 14:43:20', 480, 20, 0.00, '', '09184639221', 0, 'Complete', 9),
(17, 'Cash In', '2023-05-18 14:43:44', 500, 0, 50.00, '12345678', '09184639221', 450, 'Complete', 9),
(18, 'Cash In', '2023-05-21 06:32:24', 500, 0, 50.00, '12345678', '09184639221', 900, 'Complete', 9),
(19, 'Cash In', '2023-05-21 06:35:04', 500, 0, 50.00, '12345678', '09184639222', 1350, 'Complete', 9),
(20, 'Cash Out', '2023-05-21 06:36:43', 1310, 40, 0.00, '', '09184639221', 0, 'Complete', 9),
(21, 'Cash In', '2023-05-21 09:08:30', 500, 0, 50.00, '12345678', '09184639221', 450, 'Complete', 9),
(22, 'Cash Out', '2023-05-21 09:12:32', 430, 20, 0.00, '', '09184639221', 0, 'Complete', 9),
(23, 'Cash In', '2023-05-21 10:54:49', 50, 0, 10.00, '12345678', '09184639221', 40, 'Complete', 9),
(24, 'Cash In', '2023-05-21 10:54:56', 500, 0, 50.00, '12345678', '09184639221', 450, 'Complete', 9),
(25, 'Cash In', '2023-05-21 12:05:40', 500, 0, 50.00, '12345678', '09184639221', 940, 'Complete', 9),
(26, 'Cash In', '2023-05-21 12:07:00', 500, 0, 50.00, '12345678', '09184639221', 1390, 'Complete', 9),
(27, 'Cash In', '2023-05-21 13:22:19', 500, 0, 50.00, '12345678', '09184639221', 1840, 'Complete', 9),
(28, 'Cash Out', '2023-05-21 13:23:26', 1000, 20, 0.00, '', '09184639221', 820, 'Complete', 9),
(29, 'Cash In', '2023-06-04 11:26:13', 500, 0, 50.00, '12345678', '09184639221', 460, 'Complete', 14),
(30, 'Cash In', '2023-06-07 10:01:28', 500, 0, 50.00, '12345678', '09184639221', 460, 'Complete', 15),
(31, 'Cash In', '2023-06-08 15:03:28', 50, 0, 10.00, '12345678', '09184639221', 395, 'Pending', 14),
(32, 'Cash Out', '2023-06-08 15:50:01', 200, 20, 0.00, '12345678', '09184639221', 1099, 'Complete', 9),
(33, 'Cash In', '2023-06-09 12:28:27', 500, 0, 50.00, '12345678', '09184639221', 900, 'Complete', 1),
(34, 'Cash In', '2023-06-11 06:02:48', 500, 0, 50.00, '12345678', '09184639221', 685, 'Complete', 14),
(35, 'Cash In', '2023-06-11 13:07:08', 500, 0, 50.00, '12345678', '09184639221', 460, 'Complete', 17),
(36, 'Cash Out', '2023-06-11 13:15:54', 50, 20, 0.00, '', '09184639221', 0, 'Complete', 16),
(37, 'Cash In', '2023-06-11 16:10:25', 500, 0, 50.00, '12345678', '09184639221', 1180, 'Pending', 17),
(38, 'Cash In', '2023-06-11 19:01:54', 500, 0, 50.00, '12345678', '09184639221', 500, 'Complete', 20),
(39, 'Cash Out', '2023-06-11 19:02:44', 100, 20, 0.00, '', '09184639221', 380, 'Complete', 20),
(40, 'Cash In', '2023-06-12 05:00:44', 500, 0, 50.00, '1001 543', '09182838182', 460, 'Complete', 21),
(41, 'Cash In', '2023-06-12 06:27:51', 500, 0, 50.00, '12345678', '09184639221', 450, 'Complete', 1),
(42, 'Cash In', '2023-06-12 09:03:58', 500, 0, 50.00, '12345678', '09184639221', 460, 'Complete', 22),
(43, 'Cash In', '2023-06-12 11:22:44', 500, 0, 50.00, '12344', '232141234', 460, 'Complete', 24),
(44, 'Cash In', '2023-06-12 15:33:01', 500, 0, 50.00, '12345678', '09184639221', 949, 'Pending', 14),
(45, 'Cash Out', '2023-06-12 15:33:45', 100, 20, 0.00, '', '09184639221', 109, 'Declined', 9),
(46, 'Cash Out', '2023-06-12 15:35:48', 100, 20, 0.00, '', '09184639221', 109, 'Pending', 9),
(47, 'Cash In', '2023-06-12 16:53:01', 500, 0, 50.00, '12345678', '09184639221', 460, 'Complete', 26),
(48, 'Cash Out', '2023-06-12 17:09:07', 67, 20, 0.00, '12345678', '09184639221', 0, 'Complete', 25),
(49, 'Cash In', '2023-06-12 17:14:11', 500, 0, 50.00, '12345678', '09184639221', 363, 'Complete', 25),
(50, 'Cash Out', '2023-06-12 17:14:41', 100, 20, 0.00, '12345678', '09184639221', 243, 'Complete', 25),
(51, 'Cash In', '2023-06-13 06:14:09', 500, 0, 50.00, '12345678', '09184639221', 1225, 'Complete', 18),
(52, 'Cash Out', '2023-06-13 06:15:24', 530, 20, 0.00, '12345678', '09184639221', 0, 'Complete', 23),
(53, 'Cash In', '2023-06-13 07:04:00', 500, 0, 50.00, '092313', '09323041481', 460, 'Complete', 28),
(54, 'Cash Out', '2023-06-13 07:08:50', 120, 20, 0.00, '123', '09323041481', 10, 'Complete', 29),
(55, 'Cash In', '2023-06-23 06:56:18', 500, 0, 50.00, '12345678', '09184639222', 843, 'Complete', 26),
(56, 'Cash Out', '2023-06-23 07:03:00', 80, 20, 0.00, '12345678', '09184639221', 0, 'Complete', 30);

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE `rates` (
  `idRates` int(11) NOT NULL,
  `seat_position` varchar(45) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `Trip_idTrip` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`idRates`, `seat_position`, `price`, `Trip_idTrip`) VALUES
(1, 'Front Seat', 300, 1),
(2, 'Middle Seat', 140, 1),
(3, 'Left Seat', 250, 1),
(4, 'Right Seat', 250, 1),
(5, 'Front Seat', 130, 2),
(6, 'Middle Seat', 130, 2),
(7, 'Left Seat', 130, 2),
(8, 'Right Seat', 130, 2),
(9, 'Front Seat', 100, 3),
(10, 'Middle Seat', 100, 3),
(11, 'Left Seat', 100, 3),
(12, 'Right Seat', 100, 3),
(13, 'Front Seat', 60, 4),
(14, 'Middle Seat', 65, 4),
(15, 'Left Seat', 60, 4),
(16, 'Right Seat', 63, 4),
(17, 'Front Seat', 300, 5),
(18, 'Middle Seat', 300, 5),
(19, 'Left Seat', 300, 5),
(20, 'Right Seat', 300, 5),
(21, 'Front Seat', 100, 6),
(22, 'Middle Seat', 100, 6),
(23, 'Left Seat', 100, 6),
(24, 'Right Seat', 100, 6),
(25, 'Front Seat', 250, 7),
(26, 'Middle Seat', 100, 7),
(27, 'Left Seat', 150, 7),
(28, 'Right Seat', 150, 7),
(29, 'Front Seat', 400, 8),
(30, 'Middle Seat', 200, 8),
(31, 'Left Seat', 300, 8),
(32, 'Right Seat', 300, 8),
(49, 'Front Seat', 25, 16),
(50, 'Middle Seat', 10, 16),
(51, 'Left Seat', 15, 16),
(52, 'Right Seat', 15, 16),
(53, 'Front Seat', 200, 17),
(54, 'Middle Seat', 100, 17),
(55, 'Left Seat', 150, 17),
(56, 'Right Seat', 150, 17),
(57, 'Front Seat', 150, 18),
(58, 'Middle Seat', 50, 18),
(59, 'Left Seat', 100, 18),
(60, 'Right Seat', 100, 18),
(61, 'Front Seat', 100, 19),
(62, 'Middle Seat', 50, 19),
(63, 'Left Seat', 75, 19),
(64, 'Right Seat', 75, 19),
(65, 'Front Seat', 100, 20),
(66, 'Middle Seat', 50, 20),
(67, 'Left Seat', 75, 20),
(68, 'Right Seat', 75, 20),
(69, 'Front Seat', 100, 21),
(70, 'Middle Seat', 100, 21),
(71, 'Left Seat', 100, 21),
(72, 'Right Seat', 100, 21),
(73, 'Front Seat', 100, 22),
(74, 'Middle Seat', 100, 22),
(75, 'Left Seat', 100, 22),
(76, 'Right Seat', 100, 22),
(77, 'Front Seat', 10, 23),
(78, 'Middle Seat', 1, 23),
(79, 'Left Seat', 1, 23),
(80, 'Right Seat', 1, 23),
(81, 'Front Seat', 1, 24),
(82, 'Middle Seat', 1, 24),
(83, 'Left Seat', 1, 24),
(84, 'Right Seat', 1, 24),
(85, 'Front Seat', 1, 25),
(86, 'Middle Seat', 1, 25),
(87, 'Left Seat', 1, 25),
(88, 'Right Seat', 1, 25),
(89, 'Front Seat', 1, 26),
(90, 'Middle Seat', 1, 26),
(91, 'Left Seat', 1, 26),
(92, 'Right Seat', 1, 26),
(93, 'Front Seat', 1, 27),
(94, 'Middle Seat', 1, 27),
(95, 'Left Seat', 1, 27),
(96, 'Right Seat', 1, 27),
(97, 'Front Seat', 1, 28),
(98, 'Middle Seat', 1, 28),
(99, 'Left Seat', 1, 28),
(100, 'Right Seat', 1, 28),
(101, 'Front Seat', 1, 29),
(102, 'Middle Seat', 1, 29),
(103, 'Left Seat', 1, 29),
(104, 'Right Seat', 1, 29),
(105, 'Front Seat', 1, 30),
(106, 'Middle Seat', 1, 30),
(107, 'Left Seat', 1, 30),
(108, 'Right Seat', 1, 30),
(109, 'Front Seat', 1, 31),
(110, 'Middle Seat', 1, 31),
(111, 'Left Seat', 1, 31),
(112, 'Right Seat', 1, 31),
(113, 'Front Seat', 1, 32),
(114, 'Middle Seat', 1, 32),
(115, 'Left Seat', 1, 32),
(116, 'Right Seat', 1, 32),
(117, 'Front Seat', 1, 33),
(118, 'Middle Seat', 1, 33),
(119, 'Left Seat', 1, 33),
(120, 'Right Seat', 1, 33),
(121, 'Front Seat', 1, 34),
(122, 'Middle Seat', 1, 34),
(123, 'Left Seat', 1, 34),
(124, 'Right Seat', 1, 34),
(125, 'Front Seat', 1, 35),
(126, 'Middle Seat', 1, 35),
(127, 'Left Seat', 1, 35),
(128, 'Right Seat', 1, 35),
(129, 'Front Seat', 1, 36),
(130, 'Middle Seat', 1, 36),
(131, 'Left Seat', 1, 36),
(132, 'Right Seat', 1, 36),
(133, 'Front Seat', 1, 37),
(134, 'Middle Seat', 1, 37),
(135, 'Left Seat', 1, 37),
(136, 'Right Seat', 1, 37),
(137, 'Front Seat', 1, 38),
(138, 'Middle Seat', 1, 38),
(139, 'Left Seat', 1, 38),
(140, 'Right Seat', 1, 38),
(141, 'Front Seat', 1, 39),
(142, 'Middle Seat', 2, 39),
(143, 'Left Seat', 3, 39),
(144, 'Right Seat', 4, 39),
(145, 'Front Seat', 100, 40),
(146, 'Middle Seat', 50, 40),
(147, 'Left Seat', 75, 40),
(148, 'Right Seat', 75, 40),
(149, 'Front Seat', 50, 41),
(150, 'Middle Seat', 15, 41),
(151, 'Left Seat', 25, 41),
(152, 'Right Seat', 25, 41),
(153, 'Front Seat', 30, 42),
(154, 'Middle Seat', 15, 42),
(155, 'Left Seat', 20, 42),
(156, 'Right Seat', 20, 42),
(157, 'Front Seat', 40, 43),
(158, 'Middle Seat', 20, 43),
(159, 'Left Seat', 30, 43),
(160, 'Right Seat', 30, 43),
(161, 'Front Seat', 50, 44),
(162, 'Middle Seat', 20, 44),
(163, 'Left Seat', 30, 44),
(164, 'Right Seat', 30, 44),
(165, 'Front Seat', 40, 45),
(166, 'Middle Seat', 15, 45),
(167, 'Left Seat', 20, 45),
(168, 'Right Seat', 20, 45),
(169, 'Front Seat', 50, 46),
(170, 'Middle Seat', 20, 46),
(171, 'Left Seat', 30, 46),
(172, 'Right Seat', 30, 46),
(173, 'Front Seat', 40, 47),
(174, 'Middle Seat', 20, 47),
(175, 'Left Seat', 30, 47),
(176, 'Right Seat', 30, 47),
(177, 'Front Seat', 50, 48),
(178, 'Middle Seat', 25, 48),
(179, 'Left Seat', 30, 48),
(180, 'Right Seat', 30, 48),
(181, 'Front Seat', 50, 49),
(182, 'Middle Seat', 20, 49),
(183, 'Left Seat', 30, 49),
(184, 'Right Seat', 30, 49),
(185, 'Front Seat', 50, 50),
(186, 'Middle Seat', 20, 50),
(187, 'Left Seat', 30, 50),
(188, 'Right Seat', 30, 50),
(189, 'Front Seat', 50, 51),
(190, 'Middle Seat', 20, 51),
(191, 'Left Seat', 30, 51),
(192, 'Right Seat', 30, 51),
(193, 'Front Seat', 30, 52),
(194, 'Middle Seat', 15, 52),
(195, 'Left Seat', 25, 52),
(196, 'Right Seat', 25, 52),
(197, 'Front Seat', 50, 53),
(198, 'Middle Seat', 20, 53),
(199, 'Left Seat', 30, 53),
(200, 'Right Seat', 30, 53),
(201, 'Front Seat', 25, 54),
(202, 'Middle Seat', 10, 54),
(203, 'Left Seat', 17, 54),
(204, 'Right Seat', 17, 54),
(205, 'Front Seat', 1, 55),
(206, 'Middle Seat', 1, 55),
(207, 'Left Seat', 1, 55),
(208, 'Right Seat', 1, 55),
(209, 'Front Seat', 2, 56),
(210, 'Middle Seat', 2, 56),
(211, 'Left Seat', 2, 56),
(212, 'Right Seat', 2, 56),
(213, 'Front Seat', 30, 57),
(214, 'Middle Seat', 15, 57),
(215, 'Left Seat', 20, 57),
(216, 'Right Seat', 20, 57),
(217, 'Front Seat', 20, 58),
(218, 'Middle Seat', 20, 58),
(219, 'Left Seat', 20, 58),
(220, 'Right Seat', 20, 58),
(221, 'Front Seat', 2, 59),
(222, 'Middle Seat', 2, 59),
(223, 'Left Seat', 2, 59),
(224, 'Right Seat', 2, 59),
(225, 'Front Seat', 1, 60),
(226, 'Middle Seat', 2, 60),
(227, 'Left Seat', 3, 60),
(228, 'Right Seat', 4, 60),
(229, 'Front Seat', 1, 61),
(230, 'Middle Seat', 2, 61),
(231, 'Left Seat', 3, 61),
(232, 'Right Seat', 4, 61),
(233, 'Front Seat', 12, 62),
(234, 'Middle Seat', 13, 62),
(235, 'Left Seat', 14, 62),
(236, 'Right Seat', 15, 62),
(237, 'Front Seat', 12, 63),
(238, 'Middle Seat', 13, 63),
(239, 'Left Seat', 14, 63),
(240, 'Right Seat', 15, 63),
(241, 'Front Seat', 12, 64),
(242, 'Middle Seat', 13, 64),
(243, 'Left Seat', 14, 64),
(244, 'Right Seat', 15, 64),
(245, 'Front Seat', 50, 65),
(246, 'Middle Seat', 20, 65),
(247, 'Left Seat', 25, 65),
(248, 'Right Seat', 25, 65),
(249, 'Front Seat', 50, 66),
(250, 'Middle Seat', 25, 66),
(251, 'Left Seat', 30, 66),
(252, 'Right Seat', 30, 66),
(253, 'Front Seat', 50, 67),
(254, 'Middle Seat', 25, 67),
(255, 'Left Seat', 30, 67),
(256, 'Right Seat', 30, 67),
(257, 'Front Seat', 40, 68),
(258, 'Middle Seat', 20, 68),
(259, 'Left Seat', 25, 68),
(260, 'Right Seat', 25, 68),
(261, 'Front Seat', 50, 69),
(262, 'Middle Seat', 20, 69),
(263, 'Left Seat', 30, 69),
(264, 'Right Seat', 30, 69),
(265, 'Front Seat', 50, 70),
(266, 'Middle Seat', 30, 70),
(267, 'Left Seat', 40, 70),
(268, 'Right Seat', 40, 70),
(269, 'Front Seat', 25, 71),
(270, 'Middle Seat', 10, 71),
(271, 'Left Seat', 15, 71),
(272, 'Right Seat', 15, 71),
(273, 'Front Seat', 50, 72),
(274, 'Middle Seat', 20, 72),
(275, 'Left Seat', 30, 72),
(276, 'Right Seat', 30, 72),
(277, 'Front Seat', 15, 73),
(278, 'Middle Seat', 15, 73),
(279, 'Left Seat', 15, 73),
(280, 'Right Seat', 15, 73),
(281, 'Front Seat', 15, 74),
(282, 'Middle Seat', 15, 74),
(283, 'Left Seat', 15, 74),
(284, 'Right Seat', 15, 74),
(285, 'Front Seat', 25, 75),
(286, 'Middle Seat', 15, 75),
(287, 'Left Seat', 20, 75),
(288, 'Right Seat', 20, 75),
(289, 'Front Seat', 20, 76),
(290, 'Middle Seat', 20, 76),
(291, 'Left Seat', 20, 76),
(292, 'Right Seat', 20, 76),
(293, 'Front Seat', 50, 77),
(294, 'Middle Seat', 25, 77),
(295, 'Left Seat', 30, 77),
(296, 'Right Seat', 30, 77),
(297, 'Front Seat', 50, 78),
(298, 'Middle Seat', 25, 78),
(299, 'Left Seat', 30, 78),
(300, 'Right Seat', 30, 78),
(301, 'Front Seat', 50, 79),
(302, 'Middle Seat', 20, 79),
(303, 'Left Seat', 25, 79),
(304, 'Right Seat', 25, 79),
(305, 'Front Seat', 50, 80),
(306, 'Middle Seat', 25, 80),
(307, 'Left Seat', 30, 80),
(308, 'Right Seat', 30, 80),
(309, 'Front Seat', 50, 81),
(310, 'Middle Seat', 25, 81),
(311, 'Left Seat', 30, 81),
(312, 'Right Seat', 30, 81),
(313, 'Front Seat', 50, 82),
(314, 'Middle Seat', 25, 82),
(315, 'Left Seat', 30, 82),
(316, 'Right Seat', 30, 82),
(317, 'Front Seat', 50, 83),
(318, 'Middle Seat', 25, 83),
(319, 'Left Seat', 30, 83),
(320, 'Right Seat', 30, 83),
(321, 'Front Seat', 50, 84),
(322, 'Middle Seat', 25, 84),
(323, 'Left Seat', 30, 84),
(324, 'Right Seat', 30, 84),
(325, 'Front Seat', 50, 85),
(326, 'Middle Seat', 25, 85),
(327, 'Left Seat', 30, 85),
(328, 'Right Seat', 30, 85),
(329, 'Front Seat', 50, 86),
(330, 'Middle Seat', 20, 86),
(331, 'Left Seat', 30, 86),
(332, 'Right Seat', 30, 86),
(333, 'Front Seat', 40, 87),
(334, 'Middle Seat', 20, 87),
(335, 'Left Seat', 30, 87),
(336, 'Right Seat', 30, 87),
(337, 'Front Seat', 40, 88),
(338, 'Middle Seat', 20, 88),
(339, 'Left Seat', 30, 88),
(340, 'Right Seat', 30, 88),
(341, 'Front Seat', 40, 89),
(342, 'Middle Seat', 20, 89),
(343, 'Left Seat', 25, 89),
(344, 'Right Seat', 25, 89),
(345, 'Front Seat', 40, 90),
(346, 'Middle Seat', 20, 90),
(347, 'Left Seat', 20, 90),
(348, 'Right Seat', 20, 90),
(349, 'Front Seat', 30, 91),
(350, 'Middle Seat', 20, 91),
(351, 'Left Seat', 25, 91),
(352, 'Right Seat', 25, 91),
(353, 'Front Seat', 25, 92),
(354, 'Middle Seat', 15, 92),
(355, 'Left Seat', 20, 92),
(356, 'Right Seat', 20, 92),
(357, 'Front Seat', 50, 93),
(358, 'Middle Seat', 25, 93),
(359, 'Left Seat', 30, 93),
(360, 'Right Seat', 30, 93),
(361, 'Front Seat', 50, 94),
(362, 'Middle Seat', 25, 94),
(363, 'Left Seat', 30, 94),
(364, 'Right Seat', 30, 94),
(365, 'Front Seat', 500, 95),
(366, 'Middle Seat', 500, 95),
(367, 'Left Seat', 500, 95),
(368, 'Right Seat', 500, 95),
(369, 'Front Seat', 500, 96),
(370, 'Middle Seat', 500, 96),
(371, 'Left Seat', 500, 96),
(372, 'Right Seat', 500, 96),
(373, 'Front Seat', 500, 97),
(374, 'Middle Seat', 50, 97),
(375, 'Left Seat', 100, 97),
(376, 'Right Seat', 100, 97),
(377, 'Front Seat', 25, 98),
(378, 'Middle Seat', 15, 98),
(379, 'Left Seat', 20, 98),
(380, 'Right Seat', 20, 98),
(381, 'Front Seat', 50, 99),
(382, 'Middle Seat', 25, 99),
(383, 'Left Seat', 30, 99),
(384, 'Right Seat', 30, 99),
(385, 'Front Seat', 20, 100),
(386, 'Middle Seat', 20, 100),
(387, 'Left Seat', 20, 100),
(388, 'Right Seat', 20, 100),
(389, 'Front Seat', 20, 101),
(390, 'Middle Seat', 20, 101),
(391, 'Left Seat', 20, 101),
(392, 'Right Seat', 20, 101),
(393, 'Front Seat', 30, 102),
(394, 'Middle Seat', 20, 102),
(395, 'Left Seat', 25, 102),
(396, 'Right Seat', 25, 102),
(397, 'Front Seat', 30, 103),
(398, 'Middle Seat', 20, 103),
(399, 'Left Seat', 25, 103),
(400, 'Right Seat', 25, 103),
(401, 'Front Seat', 100, 104),
(402, 'Middle Seat', 50, 104),
(403, 'Left Seat', 50, 104),
(404, 'Right Seat', 50, 104),
(405, 'Front Seat', 25, 105),
(406, 'Middle Seat', 10, 105),
(407, 'Left Seat', 15, 105),
(408, 'Right Seat', 15, 105),
(409, 'Front Seat', 50, 106),
(410, 'Middle Seat', 30, 106),
(411, 'Left Seat', 40, 106),
(412, 'Right Seat', 40, 106),
(413, 'Front Seat', 25, 107),
(414, 'Middle Seat', 10, 107),
(415, 'Left Seat', 15, 107),
(416, 'Right Seat', 15, 107),
(417, 'Front Seat', 50, 108),
(418, 'Middle Seat', 25, 108),
(419, 'Left Seat', 35, 108),
(420, 'Right Seat', 35, 108);

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

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`idRating`, `rating_stars`, `rating_msg`, `Users_idUsers`, `Trip_idTrip`) VALUES
(1, 3, NULL, 14, 39),
(3, 4, 'test', 14, 40),
(4, 2, 'medyo late si idol', 12, 43),
(5, 3, 'scammaz', 14, 46),
(6, 1, 'ok lang', 14, 50),
(7, 5, 'awdwa', 14, 42),
(8, 5, 'amazing', 14, 48),
(9, 2, 'awdaw', 14, 51),
(10, 5, 'amazing', 17, 75),
(11, 3, 'amazing', 14, 49),
(12, 5, 'amazing', 18, 78),
(13, 1, 'konting respeto naman ', 14, 95),
(14, 1, 'naflat si tropa', 26, 98),
(15, 1, 'naflat bobo pa', 26, 103),
(16, 5, 'magaling', 28, 104),
(17, 5, 'ang galing', 26, 108);

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
(1, 'San Rafael, Bulacan', 'Malolos, Bulacan', '2023-05-04 08:50:00', 5, 'Completed', 9, 15),
(2, 'Malolos, Bulacan', 'Pulian, Bulacan', '2023-05-04 08:57:00', 5, 'Completed', 9, 15),
(3, 'San Rafael, Bulacan', 'Baliuag, Bulacan', '2023-05-04 08:59:00', 4, 'Completed', 1, 2),
(4, 'Plaridel, Bulacan', 'Malolos, Bulacan', '2023-05-04 09:01:00', 5, 'Completed', 9, 15),
(5, 'Baliuag, Bulacan', 'Malolos, Bulacan', '2023-05-04 09:07:00', 5, 'Completed', 9, 15),
(6, 'Malolos, Bulacan', 'Baliuag, Bulacan', '2023-05-04 09:22:00', 5, 'Completed', 9, 16),
(7, 'Malolos, Bulacan', 'Baliuag, Bulacan', '2023-05-21 21:20:00', 5, 'Completed', 9, 16),
(8, 'Malolos, Bulacan', 'Baliuag, Bulacan', '2023-06-03 15:52:00', 5, 'Completed', 9, 15),
(16, 'San Rafael, Bulacan', 'Baliuag, Bulacan', '2023-06-10 16:15:00', 1, 'Completed', 9, 16),
(17, 'San Rafael, Bulacan', 'Baliuag, Bulacan', '2023-06-05 17:52:00', 2, 'Completed', 9, 15),
(18, 'Malolos, Bulacan', 'Baliuag, Bulacan', '2023-06-05 18:01:00', 2, 'Completed', 9, 15),
(19, 'Plaridel, Bulacan', 'Malolos, Bulacan', '2023-06-06 19:02:00', 2, 'Completed', 9, 15),
(20, 'San Rafael, Bulacan', 'Baliuag, Bulacan', '2023-06-05 19:43:00', 2, 'Completed', 9, 16),
(21, 'San Rafael, Bulacan', 'Baliuag, Bulacan', '2023-06-04 19:59:00', 4, 'Completed', 9, 15),
(22, 'San Rafael, Bulacan', 'Baliuag, Bulacan', '2023-06-06 20:05:00', 2, 'Completed', 9, 15),
(23, 'San Rafael, Bulacan', 'Baliuag, Bulacan', '2023-06-08 20:16:00', 2, 'Completed', 9, 15),
(24, 'San Rafael, Bulacan', 'Baliuag, Bulacan', '2023-06-06 20:26:00', 2, 'Completed', 9, 15),
(25, 'Plaridel, Bulacan', 'Malolos, Bulacan', '2023-06-05 20:28:00', 2, 'Completed', 9, 15),
(26, 'San Rafael, Bulacan', 'Baliuag, Bulacan', '2023-06-06 20:36:00', 2, 'Completed', 9, 15),
(27, 'San Rafael, Bulacan', 'Baliuag, Bulacan', '2023-06-05 20:39:00', 2, 'Completed', 9, 15),
(28, 'San Rafael, Bulacan', 'Baliuag, Bulacan', '2023-06-05 20:40:00', 2, 'Completed', 9, 15),
(29, 'San Rafael, Bulacan', 'Baliuag, Bulacan', '2023-06-05 20:42:00', 2, 'Completed', 9, 15),
(30, 'San Rafael, Bulacan', 'Baliuag, Bulacan', '2023-06-05 20:47:00', 2, 'Completed', 9, 15),
(31, 'San Rafael, Bulacan', 'Baliuag, Bulacan', '2023-06-05 20:49:00', 2, 'Completed', 9, 15),
(32, 'San Rafael, Bulacan', 'Baliuag, Bulacan', '2023-06-05 20:51:00', 2, 'Completed', 9, 15),
(33, 'San Rafael, Bulacan', 'Malolos, Bulacan', '2023-06-30 22:19:00', 2, 'Completed', 9, 15),
(34, 'San Rafael, Bulacan', 'Malolos, Bulacan', '2023-06-30 22:22:00', 2, 'Completed', 9, 15),
(35, 'San Rafael, Bulacan', 'Baliuag, Bulacan', '2023-06-06 22:23:00', 2, 'Completed', 9, 15),
(36, 'San Rafael, Bulacan', 'San Miguel, Bulacan', '2023-06-08 08:09:00', 1, 'Completed', 9, 15),
(37, 'San Rafael, Bulacan', 'San Miguel, Bulacan', '2023-06-07 08:09:00', 2, 'Completed', 9, 16),
(38, 'San Rafael, Bulacan', 'San Miguel, Bulacan', '2023-06-07 12:00:00', 0, 'Completed', 9, 15),
(39, 'San Rafael, Bulacan', 'San Miguel, Bulacan', '2023-06-08 08:09:00', 0, 'Completed', 9, 16),
(40, 'San Miguel, Bulacan', 'San Rafael, Bulacan', '2023-06-08 08:09:00', 1, 'Completed', 9, 16),
(41, 'San Miguel, Bulacan', 'San Rafael, Bulacan', '2023-06-08 08:09:00', 2, 'Completed', 9, 16),
(42, 'Baliuag, Bulacan', 'San Miguel, Bulacan', '2023-06-09 08:09:00', 4, 'Completed', 9, 15),
(43, 'Calumpit, Bulacan', 'Pulilan, Bulacan', '2023-06-08 08:09:00', 8, 'Completed', 9, 16),
(44, 'San Rafael, Bulacan', 'Malolos, Bulacan', '2023-06-14 21:40:00', 5, 'Completed', 9, 15),
(45, 'Baliuag, Bulacan', 'Malolos, Bulacan', '2023-06-15 21:41:00', 4, 'Completed', 1, 3),
(46, 'SM City Baliuag, Baliuag, Bulacan', 'Bulacan State University, Malolos, Bulacan', '2023-06-12 08:09:00', 3, 'Completed', 9, 16),
(47, 'San Rafael, Bulacan', 'Malolos, Bulacan', '2023-06-12 08:09:00', 4, 'Completed', 9, 15),
(48, 'Baliuag, Bulacan', 'Plaridel, Bulacan', '2023-06-13 12:13:00', 3, 'Completed', 1, 2),
(49, 'San Fernando, Pampanga', 'San Simon, Pampanga', '2023-06-13 08:09:00', 3, 'Completed', 1, 1),
(50, 'San Simon, Pampanga', 'San Rafael, Bulacan', '2023-06-13 08:09:00', 3, 'Completed', 1, 2),
(51, 'San Simon, Pampanga', 'San Rafael, Bulacan', '2023-06-12 08:09:00', 3, 'Completed', 9, 15),
(52, 'San Miguel, Bulacan', 'Baliuag, Bulacan', '2023-06-12 02:57:00', 4, 'Completed', 1, 3),
(53, 'San Simon, Pampanga', 'San Miguel, Bulacan', '2023-06-13 08:09:00', 3, 'Cancelled', 9, 15),
(54, 'San Rafael, Bulacan', 'Baliuag, Bulacan', '2023-06-12 08:09:00', 3, 'Cancelled', 9, 16),
(55, 'Test', 'Testing', '2023-06-12 08:09:00', 3, 'Cancelled', 9, 16),
(56, 'Last Test', 'Last Testers', '2023-06-13 08:09:00', 3, 'Cancelled', 9, 16),
(57, 'Finish Test', 'Finish Testers', '2023-06-13 08:09:00', 3, 'Completed', 9, 16),
(58, 'Finish Test', 'Finish Testers', '2023-06-13 12:12:00', 3, 'Completed', 9, 16),
(59, 'Last Test', 'Finish Testers', '2023-06-13 12:12:00', 3, 'Completed', 9, 16),
(60, 'Testing', 'Testing lang', '2023-06-13 12:12:00', 3, 'Completed', 9, 15),
(61, 'Test', 'Alert', '2023-06-12 12:21:00', 3, 'Completed', 9, 16),
(62, 'AWDAW', 'DWAAWD', '2023-06-12 12:22:00', 3, 'Completed', 9, 16),
(63, 'LAST ', 'LAST NA', '2023-12-12 09:02:00', 3, 'Completed', 9, 16),
(64, 'Test', 'Finish Testers', '2023-06-12 12:23:00', 3, 'Completed', 9, 15),
(65, 'balance test', 'balance', '2023-12-12 12:01:00', 3, 'Completed', 9, 15),
(66, 'dawwda', 'dawawd', '2023-06-12 12:12:00', 3, 'Completed', 9, 15),
(67, 'San Miguel, Bulacan', 'San Simon, Pampanga', '2023-06-12 12:12:00', 3, 'Completed', 9, 16),
(68, 'San Fernando, Pampanga', 'Baliuag, Bulacan', '2023-06-13 12:34:00', 3, 'Cancelled', 1, 3),
(69, 'San Simon, Pampanga', 'San Miguel, Bulacan', '2023-06-12 08:09:00', 3, 'Completed', 9, 16),
(70, 'San Miguel, Bulacan', 'Baliuag, Bulacan', '2023-06-12 12:12:00', 3, 'Completed', 9, 16),
(71, 'San Rafael, Bulacan', 'Baliuag, Bulacan', '2023-06-12 12:12:00', 3, 'Completed', 9, 15),
(72, 'San Miguel, Bulacan', 'San Rafael, Bulacan', '2023-06-12 08:09:00', 4, 'Cancelled', 9, 16),
(73, 'San Miguel, Bulacan', 'San Rafael, Bulacan', '2023-06-12 12:12:00', 3, 'Completed', 9, 15),
(74, 'San Rafael, Bulacan', 'Baliuag, Bulacan', '2023-06-13 12:13:00', 3, 'Completed', 9, 15),
(75, 'San Rafael, Bulacan', 'Baliuag, Bulacan', '2023-06-12 12:12:00', 4, 'Completed', 16, 20),
(76, 'San Rafael, Bulacan', 'Baliuag, Bulacan', '2023-06-12 12:31:00', 5, 'Scheduled', 16, 20),
(77, 'Angat, Bulacan', 'Baliuag, Bulacan', '2023-06-12 08:09:00', 4, 'Cancelled', 19, 22),
(78, 'Angat, Bulacan', 'Baliuag, Bulacan', '2023-06-13 08:09:00', 4, 'Completed', 19, 22),
(79, 'Marilao, Bulacan', 'Malolos, Bulacan', '2023-06-13 12:32:00', 3, 'Completed', 19, 22),
(80, 'San Fernando, Pampanga', 'Baliuag, Bulacan', '2023-06-13 12:12:00', 3, 'Completed', 19, 22),
(81, 'San Miguel, Bulacan', 'Malolos, Bulacan', '2023-06-13 08:09:00', 4, 'Cancelled', 19, 22),
(82, 'San Miguel, Bulacan', 'San Rafael, Bulacan', '2023-06-13 12:23:00', 3, 'Completed', 19, 22),
(83, 'San Miguel, Bulacan', 'San Rafael, Bulacan', '2023-06-13 12:31:00', 3, 'Completed', 19, 22),
(84, 'San Simon, Pampanga', 'San Rafael, Bulacan', '2023-06-13 12:51:00', 3, 'Completed', 19, 22),
(85, 'San Simon, Pampanga', 'Baliuag, Bulacan', '2023-06-13 12:13:00', 3, 'Completed', 19, 22),
(86, 'Clark, Pampanga', 'San Simon, Pampanga', '2023-06-13 12:31:00', 3, 'Completed', 19, 22),
(87, 'Bongabon, Nueva Ecija', 'San Rafael, Bulacan', '2023-06-13 12:41:00', 3, 'Completed', 19, 22),
(88, 'Hagonoy, Bulacan', 'Bongabon, Nueva Ecija', '2023-06-13 12:31:00', 3, 'Completed', 19, 22),
(89, 'San Fernando, Pampanga ', 'Baliuag, Bulacan ', '2023-06-13 12:34:00', 3, 'Cancelled', 1, 3),
(90, 'San Fernando, Pampanga', 'Baliuag, Bulacan', '2023-06-13 13:33:00', 3, 'Cancelled', 1, 3),
(91, 'San Rafael, Bulacan', 'Malolos, Bulacan', '2023-06-13 14:16:00', 4, 'Completed', 1, 3),
(92, 'San Rafael, Bulacan', 'Baliuag, Bulacan', '2023-06-12 16:21:00', 4, 'Completed', 1, 4),
(93, 'Malolos, Bulacan', 'Baliuag, Bulacan', '2023-06-12 14:42:00', 4, 'Completed', 1, 2),
(94, 'Plaridel, Bulacan', 'Malolos, Bulacan', '2023-06-13 16:19:00', 4, 'Scheduled', 17, 21),
(95, 'STI Baliuag, Baliuag, Bulacan', 'Resto Bar, Baliuag, Bulacan', '2023-06-14 16:36:00', 3, 'Completed', 23, 25),
(96, 'STI Baliuag, Baliuag, Bulacan', 'Restobar, Baliuag, Bulacan', '2023-06-14 00:00:00', 4, 'Cancelled', 23, 25),
(97, 'baliwag', 'mars', '2023-06-13 19:29:00', 4, 'Cancelled', 24, 26),
(98, 'Sabang, Baliuag, Bulacan', 'Caingin, San Rafael, Bulacan', '2023-06-13 00:48:00', 3, 'Completed', 25, 27),
(99, 'Malolos, Bulacan', 'Baliuag, Bulacan', '2023-06-13 03:00:00', 4, 'Cancelled', 25, 27),
(100, 'San Rafael, Bulacan', 'Malolos, Bulacan', '2023-06-13 15:03:00', 3, 'Cancelled', 25, 27),
(101, 'Plaridel, Bulacan', 'Malolos, Bulacan', '2023-06-13 01:06:00', 3, 'Cancelled', 25, 27),
(102, 'Caingin, San Rafael, Bulacan', 'Sabang, Baliuag, Bulacan', '2023-06-13 15:00:00', 4, 'Scheduled', 20, 23),
(103, 'Malolos, Bulacan', 'Marilao, Bulacan', '2023-06-13 15:00:00', 3, 'Completed', 27, 28),
(104, 'San Rafael, Bulacan', 'Baliuag, Bulacan', '2023-06-15 15:02:00', 3, 'Completed', 29, 29),
(105, 'San Rafael, Bulacan', 'Baliuag, Bulacan', '2023-06-23 14:48:00', 4, 'Cancelled', 9, 15),
(106, 'San Miguel, Bulacan', 'San Fernando, Pampanga', '2023-06-24 14:49:00', 4, 'Scheduled', 23, 25),
(107, 'San Rafael, Bulacan', 'Baliuag, Bulacan', '2023-06-23 20:50:00', 4, 'Scheduled', 9, 15),
(108, 'Malolos, Bulacan', 'San Fernando, Pampanga', '2023-06-23 16:56:00', 3, 'Completed', 30, 30);

-- --------------------------------------------------------

--
-- Table structure for table `trip_passengers`
--

CREATE TABLE `trip_passengers` (
  `Trip_idTrip` int(11) DEFAULT NULL,
  `approved` tinyint(4) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `Users_idUsers` int(11) DEFAULT NULL,
  `Rates_idRates` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trip_passengers`
--

INSERT INTO `trip_passengers` (`Trip_idTrip`, `approved`, `timestamp`, `Users_idUsers`, `Rates_idRates`) VALUES
(39, 1, '2023-06-06 17:51:57', 14, 144),
(40, 1, '2023-06-06 18:59:11', 12, 148),
(40, 1, '2023-06-06 19:00:15', 14, 147),
(41, 1, '2023-06-06 19:11:40', 12, 152),
(42, 1, '2023-06-07 09:03:12', 14, 153),
(43, 1, '2023-06-07 09:43:27', 12, 157),
(46, 1, '2023-06-09 12:53:00', 14, 172),
(48, 1, '2023-06-10 17:20:13', 14, 180),
(49, 1, '2023-06-10 17:35:08', 14, 184),
(50, 1, '2023-06-10 18:45:53', 14, 188),
(51, 1, '2023-06-11 05:10:24', 14, 192),
(53, 1, '2023-06-11 06:03:22', 14, 200),
(54, 1, '2023-06-11 06:13:24', 14, 201),
(55, 1, '2023-06-11 06:19:40', 14, 208),
(56, 1, '2023-06-11 06:22:53', 14, 212),
(57, 1, '2023-06-11 06:35:38', 14, 216),
(58, 1, '2023-06-11 06:39:05', 14, 220),
(59, 1, '2023-06-11 07:02:05', 14, 224),
(60, 1, '2023-06-11 07:04:13', 14, 228),
(61, 1, '2023-06-11 07:08:36', 14, 232),
(62, 1, '2023-06-11 07:13:20', 14, 236),
(63, 1, '2023-06-11 07:15:34', 14, 238),
(64, 1, '2023-06-11 07:18:16', 14, 244),
(65, 1, '2023-06-11 07:33:32', 14, 248),
(66, 1, '2023-06-11 07:37:42', 14, 252),
(67, 1, '2023-06-11 08:18:46', 14, 256),
(69, 1, '2023-06-11 11:27:28', 14, 261),
(70, 1, '2023-06-11 11:35:24', 14, 266),
(71, 1, '2023-06-11 11:43:04', 14, 272),
(73, 1, '2023-06-11 12:11:34', 14, 280),
(74, 1, '2023-06-11 12:18:45', 14, 284),
(75, 1, '2023-06-11 13:10:49', 17, 288),
(78, 1, '2023-06-11 16:48:26', 18, 300),
(79, 1, '2023-06-11 16:55:45', 18, 301),
(80, 1, '2023-06-11 17:18:24', 18, 305),
(82, 1, '2023-06-11 17:31:35', 18, 313),
(83, 1, '2023-06-11 17:33:43', 18, 320),
(84, 1, '2023-06-11 17:35:58', 18, 324),
(85, 1, '2023-06-11 17:43:32', 18, 326),
(86, 1, '2023-06-11 18:01:26', 18, 330),
(87, 1, '2023-06-11 18:19:28', 18, 334),
(88, 1, '2023-06-11 18:23:51', 18, 338),
(68, 1, '2023-06-12 04:00:37', 18, 260),
(89, 1, '2023-06-12 05:05:53', 21, 341),
(90, 1, '2023-06-12 05:34:38', 12, 348),
(95, 1, '2023-06-12 08:46:19', 14, 366),
(98, 1, '2023-06-12 16:54:25', 26, 377),
(100, 1, '2023-06-12 17:01:53', 26, 386),
(101, 1, '2023-06-12 17:04:41', 26, 390),
(103, 1, '2023-06-13 05:56:57', 26, 397),
(104, 1, '2023-06-13 07:04:42', 28, 401),
(108, 1, '2023-06-23 06:59:35', 26, 417);

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
  `ticket_bal` int(11) NOT NULL,
  `lic_no` char(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `applicant` tinyint(4) NOT NULL DEFAULT 0,
  `user_status` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `alert` tinyint(1) NOT NULL DEFAULT 0,
  `prof_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uID`, `fname`, `mname`, `lname`, `uPhone`, `birthday`, `street`, `brgy`, `city`, `prov`, `uEmail`, `uPswd`, `uType`, `ticket_bal`, `lic_no`, `applicant`, `user_status`, `alert`, `prof_path`) VALUES
(1, 'rovic', 'test', 'vasallo', '09184639221', '2003-08-09', '1082 Kalsadang Bago Street', 'Caingin', 'San Rafael', 'Bulacan', 'jonasvasallo0809@gmail.com', 'jonas809', 'Driver', 475, 'A00-00-000000', 0, 'Available', 0, 'Daenerys-Targaryen.webp'),
(5, 'admin', 'admin', 'admin', '09184639221', '0000-00-00', '', '', '', '', 'admin@gmail.com', 'secret', 'Admin', 450, NULL, 0, 'Available', 0, 'default.jpg'),
(9, 'Drayber', 'N/A', 'Vasallo', '09184639221', '2003-08-09', '1082 Kalsadang Bago Street', 'Caingin', 'San Rafael', 'Bulacan', 'iderrillix@gmail.com', 'jonas809', 'Driver', 109, 'A00-00-000000', 0, 'Pending Trip', 1, 'default.jpg'),
(12, 'jonas', 'test', 'vasallo', '09184639222', '2003-08-09', '1082 Kalsadang Bago Street', 'Caingin', 'San Rafael', 'Bulacan', 'iderrillixkr@gmail.com', 'jonas809', 'Passenger', 260, NULL, 0, 'Available', 1, 'default.jpg'),
(14, 'Jonas', 'Cruz', 'Vasallo', '09184639221', '2003-08-09', '1082 Kalsadang Bago Street', 'Caingin', 'San Rafael', 'Bulacan', 'iderrillixjp@gmail.com', 'jonas809', 'Passenger', 499, NULL, 0, 'Available', 1, 'default (2).jpg'),
(15, 'temp1', 'temp1', 'temp1', '09184639223', '2003-08-09', 'IDK', 'Tambubong', 'San Rafael', 'Bulacan', 'finav59072@ozatvn.com', 'jonas809', 'Passenger', 460, NULL, 0, 'Available', 0, 'default.jpg'),
(16, 'dummy', 'dummy', 'driver1', '09184639224', '2003-08-09', 'dummy1', 'dummy1', 'dummy1', 'dummy1', 'jomof65192@onlcool.com', 'jonas809', 'Driver', 30, 'C07-21-008942', 0, 'Pending Trip', 0, 'ricardo.png'),
(17, 'dummy', 'dummy', 'Passenger1', '09184639225', '2003-08-09', 'dummy2', 'dummy2', 'dummy2', 'dummy2', 'fetat87119@rockdian.com', 'jonas809', 'Driver', 730, 'C07-21-008943', 0, 'Pending Trip', 0, '316829520_868864957582969_352311795304062113_n.jpg'),
(18, 'dummy', 'dummy', 'Passenger2', '09184639226', '2003-08-09', 'dummy3', 'dummy3', 'dummy3', 'dummy3', 'rohaj82267@ratedane.com', 'jonas809', 'Passenger', 1225, NULL, 0, 'Waiting Confirmation', 0, '278644362_1532637477130314_1488566840514091125_n.jpg'),
(19, 'dummy', 'dummy', 'driver2', '09184639227', '2003-08-09', 'dummy4', 'dummy4', 'dummy4', 'dummy4', 'tiver84417@onlcool.com', 'jonas809', 'Driver', 455, 'C07-21-008944', 1, 'Available', 0, 'default.jpg'),
(20, 'dummy', 'dummy', 'driver3', '09184639229', '2003-08-09', 'dummy5', 'dummy5', 'dummy5', 'dummy5', 'hicamoj607@rockdian.com', 'jonas809', 'Driver', 380, 'C07-21-008949', 0, 'Pending Trip', 0, 'default.jpg'),
(21, 'Jasper James', 'Luartes', 'Paragas', '09293819', '2002-05-14', 'JP Rizal', 'Makinabang', 'Baliuag', 'Bulacan', 'percy@gmail.com', '123', 'Passenger', 460, NULL, 0, 'Available', 0, '72f23e7914b9ba6530e42a2530918a7b.jpg'),
(22, 'Don', 'Eladio', 'Dodo', '0915391111', '2003-07-12', 'Elm', 'Elm', 'elmer', 'elm', 'psibs123@gmail.com', 'test123', 'Passenger', 460, 'sdsdsdsd', 1, 'Available', 0, 'lebronCrying.jpg'),
(23, 'Tiger', 'Tiger', 'Tiger', '09184639215', '2003-08-09', 'STI', 'STI', 'STI', 'STI', 'jataga2795@vaband.com', 'tiger', 'Driver', 0, 'C07-21-008932', 0, 'Pending Trip', 0, 'tigerhaha.jpg'),
(24, 'asda', 'asdas', 'asdsa', '12313', '2005-06-01', '123hello', 'tamboba', 'asda', 'asdsad', 'franzdainellvalones0107@gmail.com', '123', 'Driver', 500, 'A00-00-000001', 0, 'Available', 0, 'default.jpg'),
(25, 'demo', 'demo', 'demo', '09184639229', '2005-06-12', 'demo lang', 'demo lang', 'demo lang', 'demo lang', 'sipifit848@soremap.com', 'jonas809', 'Driver', 243, 'A00-00-000000', 0, 'Available', 0, 'default.jpg'),
(26, 'new passenger', 'new passenger', 'new passenger', '09184639222', '2003-08-09', '1082 Kalsadang Luma', 'Caingin', 'San Rafael', 'Bulacan', 'tayolo5901@onlcool.com', 'jonas809', 'Passenger', 793, NULL, 0, 'Available', 0, '0f6136c2d273deca5331970e27cbea98.jpg'),
(27, 'driver', 'driver', 'presentation', '09184639222', '2003-08-09', 'baliuag', 'baliuag', 'baliuag', 'baliuag', 'mgmgbjo814@wemail.pics', 'jonas809', 'Driver', 80, 'A00-00-000000', 0, 'Available', 0, '2022_Acer_Commercial_Option_01_3840x2400.jpg'),
(28, 'passenger', 'N/A', 'presentation', '09184639221', '2003-08-09', 'awdaw1', 'dawdaw2', 'dawdaw3', 'dwaawd4', 'bqwkaeq743@marketstore.pw', 'jonas809', 'Passenger', 360, NULL, 0, 'Available', 0, 'download (1).jpg'),
(29, 'Hello', 'Test', 'Try', '09323041481', '2005-06-07', '146', 'Tambubong', 'San Rafael', 'Bulacan', 'lawocaj230@pyadu.com', '123', 'Driver', 10, 'A00-00-000001', 0, 'Available', 0, 'default.jpg'),
(30, 'test', 'test', 'test', '09184639222', '2003-08-09', 'awdawdawdaw', 'Pantubig', 'San Rafael', 'Bulacan', 'tijedeg897@byorby.com', 'jonas809', 'Driver', 0, 'C07-21-008936', 0, 'Available', 0, 'B2ED6678-4B0C-4E22-8673-319D8403E6BB.jpg');

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
  ADD KEY `Users_idUsers` (`Users_idUsers`),
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
  MODIFY `idCar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `cashtransaction`
--
ALTER TABLE `cashtransaction`
  MODIFY `idCashTransac` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `idRates` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=421;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `idRating` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `trip`
--
ALTER TABLE `trip`
  MODIFY `idTrip` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
  ADD CONSTRAINT `trip_passengers_ibfk_2` FOREIGN KEY (`Users_idUsers`) REFERENCES `users` (`uID`),
  ADD CONSTRAINT `trip_passengers_ibfk_3` FOREIGN KEY (`Rates_idRates`) REFERENCES `rates` (`idRates`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
