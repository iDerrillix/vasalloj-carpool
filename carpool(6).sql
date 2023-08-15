-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2023 at 05:20 PM
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
(21, 'Terra', 5, 'Nissan', 'SUV', 'EZG-6969', '12345678901234567', 17, 1);

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
(3, 'Cash In', '2023-05-18 11:51:04', 50, 0, 10.00, '12345678', '09184639221', 1350, '', 9),
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
(32, 'Cash Out', '2023-06-08 15:50:01', 200, 20, 0.00, '', '09184639221', 1099, 'Pending', 9),
(33, 'Cash In', '2023-06-09 12:28:27', 500, 0, 50.00, '12345678', '09184639221', 900, 'Complete', 1),
(34, 'Cash In', '2023-06-11 06:02:48', 500, 0, 50.00, '12345678', '09184639221', 685, 'Complete', 14),
(35, 'Cash In', '2023-06-11 13:07:08', 500, 0, 50.00, '12345678', '09184639221', 460, 'Complete', 17),
(36, 'Cash Out', '2023-06-11 13:15:54', 50, 20, 0.00, '', '09184639221', 0, 'Complete', 16);

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
(292, 'Right Seat', 20, 76);

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
(10, 5, 'amazing', 17, 75);

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
(68, 'San Fernando, Pampanga', 'Baliuag, Bulacan', '2023-06-13 12:34:00', 4, 'Scheduled', 1, 3),
(69, 'San Simon, Pampanga', 'San Miguel, Bulacan', '2023-06-12 08:09:00', 3, 'Completed', 9, 16),
(70, 'San Miguel, Bulacan', 'Baliuag, Bulacan', '2023-06-12 12:12:00', 3, 'Completed', 9, 16),
(71, 'San Rafael, Bulacan', 'Baliuag, Bulacan', '2023-06-12 12:12:00', 3, 'Completed', 9, 15),
(72, 'San Miguel, Bulacan', 'San Rafael, Bulacan', '2023-06-12 08:09:00', 4, 'Cancelled', 9, 16),
(73, 'San Miguel, Bulacan', 'San Rafael, Bulacan', '2023-06-12 12:12:00', 3, 'Completed', 9, 15),
(74, 'San Rafael, Bulacan', 'Baliuag, Bulacan', '2023-06-13 12:13:00', 3, 'Completed', 9, 15),
(75, 'San Rafael, Bulacan', 'Baliuag, Bulacan', '2023-06-12 12:12:00', 4, 'Completed', 16, 20),
(76, 'San Rafael, Bulacan', 'Baliuag, Bulacan', '2023-06-12 12:31:00', 5, 'Scheduled', 16, 20);

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
(75, 1, '2023-06-11 13:10:49', 17, 288);

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
(1, 'rovic', 'test', 'vasallo', '09184639221', '2003-08-09', '1082 Kalsadang Bago Street', 'Caingin', 'San Rafael', 'Bulacan', 'jonasvasallo0809@gmail.com', 'jonas809', 'Driver', 0, 'A00-00-000000', 0, 'Pending Trip', 0, 'Daenerys-Targaryen.webp'),
(5, 'admin', 'admin', 'admin', '09184639221', '0000-00-00', '', '', '', '', 'admin@gmail.com', 'secret', 'Admin', 450, NULL, 0, 'Available', 0, 'default.jpg'),
(9, 'Drayber', 'N/A', 'Vasallo', '09184639221', '2003-08-09', '1082 Kalsadang Bago Street', 'Caingin', 'San Rafael', 'Bulacan', 'iderrillix@gmail.com', 'jonas809', 'Driver', 442, 'A00-00-000000', 0, 'Available', 1, 'default.jpg'),
(12, 'jonas', 'test', 'vasallo', '09184639222', '2003-08-09', '1082 Kalsadang Bago Street', 'Caingin', 'San Rafael', 'Bulacan', 'iderrillixkr@gmail.com', 'jonas809', 'Passenger', 260, NULL, 0, 'Available', 1, 'default.jpg'),
(14, 'Jonas', 'Cruz', 'Vasallo', '09184639221', '2003-08-09', '1082 Kalsadang Bago Street', 'Caingin', 'San Rafael', 'Bulacan', 'iderrillixjp@gmail.com', 'jonas809', 'Passenger', 336, NULL, 0, 'Available', 1, 'facecam.png'),
(15, 'temp1', 'temp1', 'temp1', '09184639223', '2003-08-09', 'IDK', 'Tambubong', 'San Rafael', 'Bulacan', 'finav59072@ozatvn.com', 'jonas809', 'Passenger', 460, NULL, 0, 'Available', 0, 'default.jpg'),
(16, 'dummy', 'dummy', 'driver1', '09184639224', '2003-08-09', 'dummy1', 'dummy1', 'dummy1', 'dummy1', 'jomof65192@onlcool.com', 'jonas809', 'Driver', 30, 'C07-21-008942', 0, 'Pending Trip', 0, 'ricardo.png'),
(17, 'dummy', 'dummy', 'Passenger1', '09184639225', '2003-08-09', 'dummy2', 'dummy2', 'dummy2', 'dummy2', 'fetat87119@rockdian.com', 'jonas809', 'Driver', 730, 'C07-21-008943', 0, 'Available', 0, '316829520_868864957582969_352311795304062113_n.jpg'),
(18, 'dummy', 'dummy', 'Passenger2', '09184639226', '2003-08-09', 'dummy3', 'dummy3', 'dummy3', 'dummy3', 'rohaj82267@ratedane.com', 'jonas809', 'Passenger', 10, NULL, 0, 'Available', 0, 'default.jpg');

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
  MODIFY `idCar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `cashtransaction`
--
ALTER TABLE `cashtransaction`
  MODIFY `idCashTransac` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `idRates` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=293;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `idRating` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `trip`
--
ALTER TABLE `trip`
  MODIFY `idTrip` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
