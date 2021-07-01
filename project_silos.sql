-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2021 at 11:22 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_silos`
--

-- --------------------------------------------------------

--
-- Table structure for table `ps_customers`
--

CREATE TABLE `ps_customers` (
  `id` int(11) NOT NULL,
  `lead_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(50) NOT NULL,
  `password` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ps_customers`
--

INSERT INTO `ps_customers` (`id`, `lead_id`, `name`, `email`, `number`, `password`) VALUES
(16, 20, 'Flynn Burks', 'dopopy@mailinator.com', '+1 (934) 586-7425', '140b543013d988f4767277b6f45ba542'),
(17, 21, 'Flynn Burks', 'dopopy@mailinator.com', '+1 (934) 586-7425', '140b543013d988f4767277b6f45ba542'),
(18, 22, 'Rose Wise', 'dysavoro@mailinator.com', '+1 (984) 606-5843', '140b543013d988f4767277b6f45ba542');

-- --------------------------------------------------------

--
-- Table structure for table `ps_department`
--

CREATE TABLE `ps_department` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `fk_team_id` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ps_department`
--

INSERT INTO `ps_department` (`id`, `name`, `fk_team_id`, `status`) VALUES
(1, 'CRM', '2', '1'),
(2, 'Admin', '2', '1'),
(3, 'Sales', '1', '1'),
(4, 'Support', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `ps_invoice_basic`
--

CREATE TABLE `ps_invoice_basic` (
  `id` int(11) NOT NULL,
  `invoice_no` varchar(25) NOT NULL,
  `lead_id` int(11) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `currency` varchar(100) NOT NULL,
  `display_id` int(11) NOT NULL DEFAULT 1,
  `added_by` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `team` varchar(10) NOT NULL,
  `website` varchar(50) NOT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ps_invoice_basic`
--

INSERT INTO `ps_invoice_basic` (`id`, `invoice_no`, `lead_id`, `amount`, `currency`, `display_id`, `added_by`, `created_at`, `team`, `website`, `status`) VALUES
(12, 'INV-1', 22, '100', 'USD', 1, '9', '2021-06-23 00:46:08', '2', '3', '1'),
(13, 'INV-2', 22, '100', 'USD', 1, '9', '2021-06-23 00:47:52', '2', '3', '1'),
(14, 'INV-3', 22, '100', 'USD', 1, '9', '2021-06-23 00:49:32', '2', '3', '1'),
(15, 'INV-4', 21, '100', 'CAD', 1, '9', '2021-06-23 18:43:39', '2', '2', '1'),
(16, 'INV-5', 0, '100', 'CAD', 1, '9', '2021-06-23 20:07:41', '2', '2', '1'),
(17, 'INV-6', 0, '100', 'CAD', 1, '9', '2021-06-23 20:09:03', '2', '2', '1'),
(18, 'INV-7', 0, '100', 'CAD', 1, '9', '2021-06-23 20:12:06', '2', '2', '1'),
(19, 'INV-8', 0, '100', 'CAD', 1, '9', '2021-06-23 20:13:00', '2', '2', '1'),
(20, 'INV-9', 0, '100', 'CAD', 1, '9', '2021-06-23 20:14:02', '2', '3', '1'),
(21, 'INV-10', 0, '100', 'CAD', 1, '9', '2021-06-23 20:15:34', '2', '3', '1'),
(22, 'INV-11', 0, '100', 'CAD', 1, '9', '2021-06-23 20:17:20', '2', '3', '1'),
(23, 'INV-12', 0, '100', 'CAD', 1, '9', '2021-06-23 20:40:13', '2', '2', '1'),
(24, 'INV-13', 0, '100', 'CAD', 1, '9', '2021-06-23 20:41:04', '2', '2', '1'),
(25, 'INV-14', 0, '100', 'CAD', 1, '9', '2021-06-23 20:43:28', '2', '2', '1'),
(26, 'INV-15', 0, '100', 'CAD', 1, '9', '2021-06-23 20:55:48', '2', '2', '1'),
(27, 'INV-16', 0, '100', 'CAD', 1, '9', '2021-06-23 21:06:13', '2', '2', '1'),
(28, 'INV-17', 0, '100', 'CAD', 1, '9', '2021-06-23 21:08:57', '2', '2', '1'),
(29, 'INV-18', 0, '100', 'CAD', 1, '9', '2021-06-23 21:09:59', '2', '2', '1'),
(30, 'INV-19', 0, '100', 'CAD', 1, '9', '2021-06-23 21:16:51', '2', '2', '1'),
(31, 'INV-20', 0, '100', 'CAD', 1, '9', '2021-06-23 21:17:33', '2', '2', '1'),
(32, 'INV-21', 0, '100', 'CAD', 1, '9', '2021-06-23 21:17:56', '2', '2', '1'),
(33, 'INV-22', 0, '100', 'CAD', 1, '9', '2021-06-23 21:18:14', '2', '2', '1'),
(34, 'INV-23', 0, '100', 'CAD', 1, '9', '2021-06-23 21:19:03', '2', '2', '1'),
(35, 'INV-24', 0, '100', 'CAD', 1, '9', '2021-06-23 21:19:19', '2', '2', '1'),
(36, 'INV-25', 0, '100', 'CAD', 1, '9', '2021-06-23 21:19:58', '2', '2', '1'),
(37, 'INV-26', 0, '100', 'CAD', 1, '9', '2021-06-23 21:20:18', '2', '2', '1'),
(38, 'INV-27', 0, '100', 'CAD', 1, '9', '2021-06-23 21:53:22', '2', '2', '1'),
(39, 'INV-28', 0, '100', 'CAD', 1, '9', '2021-06-23 21:53:25', '2', '2', '1'),
(40, 'INV-29', 0, '100', 'CAD', 1, '9', '2021-06-23 21:53:45', '2', '2', '1'),
(41, 'INV-30', 0, '100', 'CAD', 1, '9', '2021-06-23 21:54:18', '2', '2', '1'),
(42, 'INV-31', 0, '100', 'CAD', 1, '9', '2021-06-23 21:55:14', '2', '2', '1'),
(43, 'INV-32', 0, '100', 'CAD', 1, '9', '2021-06-23 21:56:08', '2', '2', '1'),
(44, 'INV-33', 0, '100', 'CAD', 1, '9', '2021-06-23 21:57:43', '2', '2', '1'),
(45, 'INV-34', 0, '100', 'CAD', 1, '9', '2021-06-23 21:58:28', '2', '2', '1'),
(46, 'INV-35', 0, '100', 'CAD', 1, '9', '2021-06-23 21:59:21', '2', '2', '1'),
(47, 'INV-36', 0, '100', 'CAD', 1, '9', '2021-06-23 21:59:30', '2', '2', '1'),
(48, 'INV-37', 0, '100', 'CAD', 1, '9', '2021-06-23 22:00:29', '2', '2', '1'),
(49, 'INV-38', 0, '100', 'CAD', 1, '9', '2021-06-23 22:01:52', '2', '2', '1'),
(50, 'INV-39', 0, '100', 'CAD', 1, '9', '2021-06-23 22:02:06', '2', '2', '1'),
(51, 'INV-40', 0, '100', 'CAD', 1, '9', '2021-06-23 22:02:30', '2', '2', '1'),
(52, 'INV-41', 0, '100', 'CAD', 1, '9', '2021-06-23 22:02:58', '2', '2', '1'),
(53, 'INV-42', 0, '100', 'CAD', 1, '9', '2021-06-23 22:04:00', '2', '2', '1'),
(54, 'INV-43', 0, '100', 'CAD', 1, '9', '2021-06-23 22:05:32', '2', '2', '1'),
(55, 'INV-44', 0, '100', 'CAD', 1, '9', '2021-06-23 22:06:02', '2', '2', '1'),
(56, 'INV-45', 0, '100', 'CAD', 1, '9', '2021-06-23 22:06:48', '2', '2', '1'),
(57, 'INV-46', 0, '100', 'CAD', 1, '9', '2021-06-23 22:07:38', '2', '2', '1'),
(58, 'INV-47', 0, '100', 'CAD', 1, '9', '2021-06-23 22:07:54', '2', '2', '1'),
(59, 'INV-48', 0, '100', 'CAD', 1, '9', '2021-06-23 22:08:26', '2', '2', '1'),
(60, 'INV-49', 0, '100', 'CAD', 1, '9', '2021-06-23 22:08:50', '2', '2', '1'),
(61, 'INV-50', 0, '100', 'CAD', 1, '9', '2021-06-23 22:09:44', '2', '2', '1'),
(62, 'INV-51', 0, '100', 'CAD', 1, '9', '2021-06-23 22:10:03', '2', '2', '1'),
(63, 'INV-52', 0, '100', 'CAD', 1, '9', '2021-06-23 22:12:36', '2', '2', '1'),
(64, 'INV-53', 0, '100', 'CAD', 1, '9', '2021-06-23 22:12:51', '2', '2', '1'),
(65, 'INV-54', 0, '100', 'CAD', 1, '9', '2021-06-23 22:35:44', '2', '2', '1'),
(66, 'INV-55', 0, '100', 'CAD', 1, '9', '2021-06-23 22:37:04', '2', '2', '1'),
(67, 'INV-56', 0, '100', 'CAD', 1, '9', '2021-06-23 22:38:57', '2', '2', '1'),
(68, 'INV-57', 0, '100', 'CAD', 1, '9', '2021-06-23 22:39:25', '2', '2', '1'),
(69, 'INV-58', 0, '100', 'CAD', 1, '9', '2021-06-23 22:39:51', '2', '2', '1'),
(70, 'INV-59', 0, '100', 'CAD', 1, '9', '2021-06-23 22:40:23', '2', '2', '1'),
(71, 'INV-60', 0, '100', 'CAD', 1, '9', '2021-06-23 22:40:38', '2', '2', '1'),
(72, 'INV-61', 0, '100', 'CAD', 1, '9', '2021-06-23 22:41:10', '2', '2', '1'),
(73, 'INV-62', 0, '100', 'CAD', 1, '9', '2021-06-23 22:41:42', '2', '2', '1'),
(74, 'INV-63', 0, '100', 'CAD', 1, '9', '2021-06-23 22:42:48', '2', '2', '1'),
(75, 'INV-64', 0, '100', 'CAD', 1, '9', '2021-06-23 22:43:36', '2', '2', '1'),
(76, 'INV-65', 0, '100', 'CAD', 1, '9', '2021-06-23 22:44:13', '2', '2', '1'),
(77, 'INV-66', 0, '100', 'CAD', 1, '9', '2021-06-23 22:54:30', '2', '2', '1'),
(78, 'INV-67', 0, '100', 'CAD', 1, '9', '2021-06-23 22:55:45', '2', '2', '1'),
(79, 'INV-68', 0, '100', 'CAD', 1, '9', '2021-06-23 22:57:22', '2', '2', '1'),
(80, 'INV-69', 0, '100', 'CAD', 1, '9', '2021-06-23 22:57:58', '2', '2', '1'),
(81, 'INV-70', 0, '100', 'CAD', 1, '9', '2021-06-23 22:58:12', '2', '2', '1'),
(82, 'INV-71', 21, '100', 'GBP', 1, '9', '2021-06-23 23:03:02', '2', '2', '1'),
(83, 'INV-72', 21, '100', 'GBP', 1, '9', '2021-06-23 23:04:03', '2', '2', '1'),
(84, 'INV-73', 21, '100', 'CAD', 1, '1', '2021-06-23 23:18:44', '2', '2', '0'),
(85, 'INV-74', 21, '100', 'CAD', 1, '9', '2021-06-23 23:18:54', '2', '2', '1'),
(86, 'INV-75', 21, '1', 'USD', 1, '9', '2021-06-24 00:17:09', '2', '2', '1'),
(87, 'INV-76', 22, '40', 'CAD', 1, '1', '2021-06-25 19:06:56', '1', '1', '0'),
(88, 'INV-77', 22, '6.01', 'GBP', 1, '1', '2021-06-26 00:50:24', '1', '2', '0'),
(89, 'INV-78', 22, '4', 'CAD', 0, '1', '2021-06-28 19:06:53', '1', '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `ps_invoice_detail`
--

CREATE TABLE `ps_invoice_detail` (
  `id` int(11) NOT NULL,
  `invoice_id` varchar(25) NOT NULL,
  `service_id` int(11) NOT NULL,
  `comments` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ps_invoice_detail`
--

INSERT INTO `ps_invoice_detail` (`id`, `invoice_id`, `service_id`, `comments`) VALUES
(110, '13', 1, 'sdf'),
(111, '13', 3, 'sdfdfs'),
(112, '13', 7, 'sdfdfsdsf'),
(113, '14', 1, 'sdf'),
(114, '14', 3, 'sdfdfs'),
(115, '14', 7, 'sdfdfsdsf'),
(116, '14', 14, 'sdfdfsdsfsadfadsfsa'),
(117, '14', 18, 'sdfdfsdsfsadfadsfsafsdfs'),
(118, '15', 1, 'test'),
(119, '15', 3, 'testtest'),
(120, '16', 11, 'dsf'),
(121, '17', 11, 'dsf'),
(122, '18', 11, 'dsf'),
(123, '19', 11, 'dsf'),
(124, '20', 17, 'df'),
(125, '20', 13, 'dfdf'),
(126, '21', 17, 'df'),
(127, '21', 13, 'dfdf'),
(128, '22', 17, 'df'),
(129, '22', 13, 'dfdf'),
(130, '23', 6, 'dsf'),
(131, '23', 14, 'dsfdfsd'),
(132, '24', 6, 'dsf'),
(133, '24', 14, 'dsfdfsd'),
(134, '24', 16, 'dsfdfsdsd'),
(135, '25', 6, 'dsf'),
(136, '25', 14, 'dsfdfsd'),
(137, '25', 16, 'dsfdfsdsd'),
(138, '26', 6, 'dsf'),
(139, '26', 14, 'dsfdfsd'),
(140, '26', 16, 'dsfdfsdsd'),
(141, '27', 6, 'dsf'),
(142, '27', 14, 'dsfdfsd'),
(143, '27', 16, 'dsfdfsdsd'),
(144, '28', 6, 'dsf'),
(145, '28', 14, 'dsfdfsd'),
(146, '28', 16, 'dsfdfsdsd'),
(147, '29', 6, 'dsf'),
(148, '29', 14, 'dsfdfsd'),
(149, '29', 16, 'dsfdfsdsd'),
(150, '30', 6, 'dsf'),
(151, '30', 14, 'dsfdfsd'),
(152, '30', 16, 'dsfdfsdsd'),
(153, '31', 6, 'dsf'),
(154, '31', 14, 'dsfdfsd'),
(155, '31', 16, 'dsfdfsdsd'),
(156, '32', 6, 'dsf'),
(157, '32', 14, 'dsfdfsd'),
(158, '32', 16, 'dsfdfsdsd'),
(159, '33', 6, 'dsf'),
(160, '33', 14, 'dsfdfsd'),
(161, '33', 16, 'dsfdfsdsd'),
(162, '34', 6, 'dsf'),
(163, '34', 14, 'dsfdfsd'),
(164, '34', 16, 'dsfdfsdsd'),
(165, '35', 6, 'dsf'),
(166, '35', 14, 'dsfdfsd'),
(167, '35', 16, 'dsfdfsdsd'),
(168, '36', 6, 'dsf'),
(169, '36', 14, 'dsfdfsd'),
(170, '36', 16, 'dsfdfsdsd'),
(171, '37', 6, 'dsf'),
(172, '37', 14, 'dsfdfsd'),
(173, '37', 16, 'dsfdfsdsd'),
(174, '38', 6, 'dsf'),
(175, '38', 14, 'dsfdfsd'),
(176, '38', 16, 'dsfdfsdsd'),
(177, '39', 6, 'dsf'),
(178, '39', 14, 'dsfdfsd'),
(179, '39', 16, 'dsfdfsdsd'),
(180, '40', 6, 'dsf'),
(181, '40', 14, 'dsfdfsd'),
(182, '40', 16, 'dsfdfsdsd'),
(183, '41', 6, 'dsf'),
(184, '41', 14, 'dsfdfsd'),
(185, '41', 16, 'dsfdfsdsd'),
(186, '42', 6, 'dsf'),
(187, '42', 14, 'dsfdfsd'),
(188, '42', 16, 'dsfdfsdsd'),
(189, '43', 6, 'dsf'),
(190, '43', 14, 'dsfdfsd'),
(191, '43', 16, 'dsfdfsdsd'),
(192, '44', 6, 'dsf'),
(193, '44', 14, 'dsfdfsd'),
(194, '44', 16, 'dsfdfsdsd'),
(195, '45', 6, 'dsf'),
(196, '45', 14, 'dsfdfsd'),
(197, '45', 16, 'dsfdfsdsd'),
(198, '46', 6, 'dsf'),
(199, '46', 14, 'dsfdfsd'),
(200, '46', 16, 'dsfdfsdsd'),
(201, '47', 6, 'dsf'),
(202, '47', 14, 'dsfdfsd'),
(203, '47', 16, 'dsfdfsdsd'),
(204, '48', 6, 'dsf'),
(205, '48', 14, 'dsfdfsd'),
(206, '48', 16, 'dsfdfsdsd'),
(207, '49', 6, 'dsf'),
(208, '49', 14, 'dsfdfsd'),
(209, '49', 16, 'dsfdfsdsd'),
(210, '50', 6, 'dsf'),
(211, '50', 14, 'dsfdfsd'),
(212, '50', 16, 'dsfdfsdsd'),
(213, '51', 6, 'dsf'),
(214, '51', 14, 'dsfdfsd'),
(215, '51', 16, 'dsfdfsdsd'),
(216, '52', 6, 'dsf'),
(217, '52', 14, 'dsfdfsd'),
(218, '52', 16, 'dsfdfsdsd'),
(219, '53', 6, 'dsf'),
(220, '53', 14, 'dsfdfsd'),
(221, '53', 16, 'dsfdfsdsd'),
(222, '54', 6, 'dsf'),
(223, '54', 14, 'dsfdfsd'),
(224, '54', 16, 'dsfdfsdsd'),
(225, '55', 6, 'dsf'),
(226, '55', 14, 'dsfdfsd'),
(227, '55', 16, 'dsfdfsdsd'),
(228, '56', 6, 'dsf'),
(229, '56', 14, 'dsfdfsd'),
(230, '56', 16, 'dsfdfsdsd'),
(231, '57', 6, 'dsf'),
(232, '57', 14, 'dsfdfsd'),
(233, '57', 16, 'dsfdfsdsd'),
(234, '58', 6, 'dsf'),
(235, '58', 14, 'dsfdfsd'),
(236, '58', 16, 'dsfdfsdsd'),
(237, '59', 6, 'dsf'),
(238, '59', 14, 'dsfdfsd'),
(239, '59', 16, 'dsfdfsdsd'),
(240, '60', 6, 'dsf'),
(241, '60', 14, 'dsfdfsd'),
(242, '60', 16, 'dsfdfsdsd'),
(243, '61', 6, 'dsf'),
(244, '61', 14, 'dsfdfsd'),
(245, '61', 16, 'dsfdfsdsd'),
(246, '62', 6, 'dsf'),
(247, '62', 14, 'dsfdfsd'),
(248, '62', 16, 'dsfdfsdsd'),
(249, '63', 6, 'dsf'),
(250, '63', 14, 'dsfdfsd'),
(251, '63', 16, 'dsfdfsdsd'),
(252, '64', 6, 'dsf'),
(253, '64', 14, 'dsfdfsd'),
(254, '64', 16, 'dsfdfsdsd'),
(255, '65', 6, 'dsf'),
(256, '65', 14, 'dsfdfsd'),
(257, '65', 16, 'dsfdfsdsd'),
(258, '66', 6, 'dsf'),
(259, '66', 14, 'dsfdfsd'),
(260, '66', 16, 'dsfdfsdsd'),
(261, '67', 6, 'dsf'),
(262, '67', 14, 'dsfdfsd'),
(263, '67', 16, 'dsfdfsdsd'),
(264, '68', 6, 'dsf'),
(265, '68', 14, 'dsfdfsd'),
(266, '68', 16, 'dsfdfsdsd'),
(267, '69', 6, 'dsf'),
(268, '69', 14, 'dsfdfsd'),
(269, '69', 16, 'dsfdfsdsd'),
(270, '70', 6, 'dsf'),
(271, '70', 14, 'dsfdfsd'),
(272, '70', 16, 'dsfdfsdsd'),
(273, '71', 6, 'dsf'),
(274, '71', 14, 'dsfdfsd'),
(275, '71', 16, 'dsfdfsdsd'),
(276, '72', 6, 'dsf'),
(277, '72', 14, 'dsfdfsd'),
(278, '72', 16, 'dsfdfsdsd'),
(279, '73', 6, 'dsf'),
(280, '73', 14, 'dsfdfsd'),
(281, '73', 16, 'dsfdfsdsd'),
(282, '74', 6, 'dsf'),
(283, '74', 14, 'dsfdfsd'),
(284, '74', 16, 'dsfdfsdsd'),
(285, '75', 6, 'dsf'),
(286, '75', 14, 'dsfdfsd'),
(287, '75', 16, 'dsfdfsdsd'),
(288, '76', 6, 'dsf'),
(289, '76', 14, 'dsfdfsd'),
(290, '76', 16, 'dsfdfsdsd'),
(291, '77', 6, 'dsf'),
(292, '77', 14, 'dsfdfsd'),
(293, '77', 16, 'dsfdfsdsd'),
(294, '78', 6, 'dsf'),
(295, '78', 14, 'dsfdfsd'),
(296, '78', 16, 'dsfdfsdsd'),
(297, '79', 6, 'dsf'),
(298, '79', 14, 'dsfdfsd'),
(299, '79', 16, 'dsfdfsdsd'),
(300, '80', 3, 'as'),
(301, '80', 6, 'asds'),
(302, '81', 3, 'as'),
(303, '81', 6, 'asds'),
(304, '82', 14, 'asdas'),
(305, '82', 10, 'asdasasda'),
(306, '83', 14, 'asdas'),
(307, '83', 10, 'asdasasda'),
(308, '84', 15, 'asad'),
(309, '85', 15, 'asad'),
(310, '85', 13, 'asadcvxcv'),
(311, '86', 19, 'test'),
(312, '87', 2, 'comments'),
(313, '87', 17, 'comments1'),
(314, '87', 12, 'comments2'),
(315, '88', 5, 'sa'),
(316, '88', 16, 'as'),
(317, '89', 7, 'test'),
(318, '89', 16, 'test1');

-- --------------------------------------------------------

--
-- Table structure for table `ps_invoice_history`
--

CREATE TABLE `ps_invoice_history` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` longtext NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ps_invoice_history`
--

INSERT INTO `ps_invoice_history` (`id`, `invoice_id`, `user_id`, `message`, `created_at`) VALUES
(1, 88, 2, 'test for history action', '2021-06-29 19:44:58'),
(2, 88, 2, 'test for history action', '2021-06-29 19:44:58'),
(3, 88, 2, 'Dani - DaniUpdated Amount 100.02', '2021-06-29 20:12:58'),
(4, 88, 1, 'Dani - Dani Updated Amount 4.04', '2021-06-29 20:14:22'),
(5, 88, 1, 'Dani - Dani Updated Amount 6.01', '2021-06-29 20:14:35');

-- --------------------------------------------------------

--
-- Table structure for table `ps_ip_allowed`
--

CREATE TABLE `ps_ip_allowed` (
  `id` int(11) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `added_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ps_ip_allowed`
--

INSERT INTO `ps_ip_allowed` (`id`, `ip`, `status`, `added_by`, `created_at`) VALUES
(1, '43.225.98.124', 1, 2, '2021-06-30 00:33:32'),
(2, '43.225.98.129', 1, 2, '2021-06-30 00:33:32'),
(3, '::1', 1, 1, '2021-06-30 18:29:31'),
(4, '43.225.98.129', 1, 1, '2021-06-30 18:46:45');

-- --------------------------------------------------------

--
-- Table structure for table `ps_leads`
--

CREATE TABLE `ps_leads` (
  `id` int(11) NOT NULL,
  `lead_code` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `comments` longtext NOT NULL,
  `expected_amount` varchar(10) NOT NULL,
  `lead_status` int(11) NOT NULL DEFAULT 0,
  `website_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `display_id` int(11) NOT NULL DEFAULT 1,
  `type_lead` varchar(25) NOT NULL DEFAULT 'None'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ps_leads`
--

INSERT INTO `ps_leads` (`id`, `lead_code`, `created_at`, `created_by`, `comments`, `expected_amount`, `lead_status`, `website_id`, `team_id`, `display_id`, `type_lead`) VALUES
(21, 'LD-2', '2021-06-15 06:18:32', 1, 'Voluptatem qui debi', '77', 3, 1, 1, 1, 'None'),
(22, 'LD-3', '2021-06-15 06:21:08', 1, 'Quo do qui in quia v', '92', 1, 1, 1, 0, 'None');

-- --------------------------------------------------------

--
-- Table structure for table `ps_leads_history`
--

CREATE TABLE `ps_leads_history` (
  `id` int(11) NOT NULL,
  `lead_id` varchar(50) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `comments` longtext DEFAULT NULL,
  `message` longtext NOT NULL,
  `file_path` varchar(100) DEFAULT NULL,
  `status` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ps_leads_history`
--

INSERT INTO `ps_leads_history` (`id`, `lead_id`, `user_id`, `comments`, `message`, `file_path`, `status`, `created_at`) VALUES
(21, '21', '1', 'Voluptatem qui debi', 'Dani-christ Added Lead 21', NULL, '1', '2021-06-15 21:18:32'),
(22, '21', '1', 'test', 'Dani-christ Added Lead 21', 'uploads/LD-2-0.png', '1', '2021-06-15 21:19:54'),
(23, '21', '1', 'test', '', NULL, '3', '2021-06-15 21:20:00'),
(24, '21', '1', 'test', '', NULL, '1', '2021-06-15 21:20:07'),
(25, '22', '1', 'Quo do qui in quia v', 'Dani-christ Added Lead 22', NULL, '1', '2021-06-15 21:21:08'),
(26, '21', '1', 'test', 'Dani-christ Added Lead 21', 'uploads/LD-2-1.zip', '1', '2021-06-15 22:46:25'),
(27, '22', '1', 'test', 'Dani-christ Added Lead 22', 'uploads/LD-3-0.zip', '1', '2021-06-15 22:58:54'),
(28, '22', '2', 'i am owner of this lead', 'Asad-Asad Owned Lead Id is22', '', '1', '2021-06-15 23:24:21');

-- --------------------------------------------------------

--
-- Table structure for table `ps_leads_status`
--

CREATE TABLE `ps_leads_status` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status_btn` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ps_leads_status`
--

INSERT INTO `ps_leads_status` (`id`, `name`, `status_btn`) VALUES
(1, 'Lead Owned', 'badge-warning'),
(2, 'In Conversation', 'badge-info'),
(3, 'Negotiation', 'badge-primary'),
(4, 'Close Won', 'badge-success'),
(5, 'Close Lost', 'badge-danger'),
(6, 'Invalid Lead', 'badge-danger'),
(7, 'Duplicate Lead', 'badge-danger'),
(8, 'Lead Free', 'badge-primary'),
(9, 'Not Intrested', 'badge-primary'),
(10, 'Non Compliant', 'badge-danger'),
(11, 'Junk Lead', 'badge-warning');

-- --------------------------------------------------------

--
-- Table structure for table `ps_logs`
--

CREATE TABLE `ps_logs` (
  `id` int(11) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `area` varchar(100) NOT NULL,
  `action` longtext NOT NULL,
  `ip` varchar(50) NOT NULL,
  `perform_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ps_logs`
--

INSERT INTO `ps_logs` (`id`, `user_id`, `area`, `action`, `ip`, `perform_at`) VALUES
(25, '1', 'Login Area', ' is Logged in', '::1', '2021-06-11 18:34:03'),
(26, '1', 'Login Area', ' is Logged in', '::1', '2021-06-11 18:39:18'),
(27, '1', 'Login Area', 'Daniyal-Memon is Logged in', '::1', '2021-06-12 16:42:09'),
(28, '1', 'Login Area', 'Daniyal-Memon is Logged in', '::1', '2021-06-12 22:38:35'),
(29, '1', 'Login Area', 'Daniyal-Memon is Logged in', '::1', '2021-06-12 22:42:56'),
(30, '2', 'Login Area', 'Asad-Asad is Logged in', '::1', '2021-06-12 23:35:18'),
(31, '1', 'Login Area', 'Daniyal-Memon is Logged in', '::1', '2021-06-14 17:23:08'),
(32, '1', 'Login Area', 'Daniyal-Memon is Logged in', '::1', '2021-06-15 17:59:07'),
(33, '2', 'Login Area', 'Asad-Asad is Logged in', '::1', '2021-06-15 23:23:46'),
(34, '1', 'Login Area', 'Daniyal-Memon is Logged in', '::1', '2021-06-16 01:28:15'),
(35, '1', 'Login Area', 'Daniyal-Memon is Logged in', '::1', '2021-06-16 18:01:58'),
(36, '1', 'Login Area', 'Daniyal-Memon is Logged in', '::1', '2021-06-16 21:40:08'),
(37, '9', 'Login Area', 'a-a is Logged in', '::1', '2021-06-17 18:17:22'),
(38, '9', 'Login Area', 'manager-manager is Logged in', '::1', '2021-06-17 22:35:06'),
(39, '9', 'Login Area', 'manager-manager is Logged in', '::1', '2021-06-18 18:03:29'),
(40, '9', 'Login Area', 'manager-manager is Logged in', '::1', '2021-06-18 18:09:57'),
(41, '9', 'Login Area', 'manager-manager is Logged in', '::1', '2021-06-19 19:03:54'),
(42, '9', 'Login Area', 'manager-manager is Logged in', '::1', '2021-06-20 00:39:32'),
(43, '9', 'Login Area', 'manager-manager is Logged in', '::1', '2021-06-21 20:32:34'),
(44, '9', 'Login Area', 'manager-manager is Logged in', '::1', '2021-06-22 18:00:10'),
(45, '9', 'Login Area', 'manager-manager is Logged in', '::1', '2021-06-22 23:29:23'),
(46, '15', 'Login Area', 'user2-user2 is Logged in', '::1', '2021-06-23 01:10:15'),
(47, '9', 'Login Area', 'manager-manager is Logged in', '::1', '2021-06-23 18:14:24'),
(48, '9', 'Login Area', 'manager-manager is Logged in', '::1', '2021-06-24 17:30:56'),
(49, '2', 'Login Area', 'Dani-Memon is Logged in', '::1', '2021-06-24 18:02:21'),
(50, '1', 'Login Area', 'Dani-Dani is Logged in', '::1', '2021-06-24 18:40:52'),
(51, '1', 'Login Area', 'Dani-Dani is Logged in', '::1', '2021-06-25 00:21:14'),
(52, '3', 'Login Area', 'adnan-adnan is Logged in', '::1', '2021-06-25 00:21:27'),
(53, '1', 'Login Area', 'Dani-Dani is Logged in', '::1', '2021-06-25 17:41:46'),
(54, '3', 'Login Area', 'adnan-adnan is Logged in', '::1', '2021-06-26 01:00:29'),
(55, '1', 'Login Area', 'Dani-Dani is Logged in', '::1', '2021-06-26 23:40:09'),
(56, '1', 'Login Area', 'Dani-Dani is Logged in', '::1', '2021-06-28 17:33:31'),
(57, '1', 'Login Area', 'Dani-Dani is Logged in', '::1', '2021-06-29 18:19:23'),
(58, '1', 'Login Area', 'Dani-Dani is Logged in', '::1', '2021-06-30 00:51:10'),
(59, '1', 'Login Area', 'Dani-Dani is Logged in', '::1', '2021-06-30 00:53:18'),
(60, '1', 'Login Area', 'Dani-Dani is Logged in', '::1', '2021-06-30 00:55:44'),
(61, '1', 'Login Area', 'Dani-Dani is Logged in', '::1', '2021-06-30 01:27:06'),
(62, '1', 'Login Area', 'Dani-Dani is Logged in', '::1', '2021-06-30 01:27:21'),
(63, '1', 'Login Area', 'Dani-Dani is Logged in', '::1', '2021-06-30 01:28:02'),
(64, '1', 'Login Area', 'Dani-Dani is Logged in', '::1', '2021-06-30 01:31:17'),
(65, '1', 'Login Area', 'Dani-Dani is Logged in', '::1', '2021-06-30 01:31:30'),
(66, '3', 'Login Area', 'adnan-adnan is Logged in', '::1', '2021-06-30 01:36:04'),
(67, '1', 'Login Area', 'Dani-Dani is Logged in', '::1', '2021-06-30 01:38:32'),
(68, '1', 'Login Area', 'Dani-Dani is Logged in', '::1', '2021-06-30 01:38:53'),
(69, '1', 'Login Area', 'Dani-Dani is Logged in', '::1', '2021-06-30 17:31:14'),
(70, '1', 'Team Area', 'Dani-Dani is Updated From Team B to Team C', '::1', '2021-06-30 21:15:28'),
(71, '1', 'Login Area', 'Dani-Dani is Logged in', '::1', '2021-07-02 00:00:44');

-- --------------------------------------------------------

--
-- Table structure for table `ps_menu`
--

CREATE TABLE `ps_menu` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `link` varchar(25) NOT NULL,
  `icon` varchar(25) NOT NULL,
  `parent` int(11) NOT NULL,
  `is_child` int(11) NOT NULL,
  `add_access` int(11) NOT NULL,
  `edit_access` int(11) NOT NULL,
  `delete_access` int(11) NOT NULL,
  `view_access` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ps_menu`
--

INSERT INTO `ps_menu` (`id`, `name`, `link`, `icon`, `parent`, `is_child`, `add_access`, `edit_access`, `delete_access`, `view_access`) VALUES
(1, 'Dashboard', 'dashboard', 'img/dashboard.png', 0, 0, 1, 1, 1, 1),
(2, 'Dashboard', 'dashboard', 'img/dashboard.png', 1, 0, 1, 1, 1, 1),
(3, 'Leads', 'leads', 'img/leads.png', 0, 0, 1, 1, 1, 1),
(4, 'Invoices', 'leads', 'img/invoice.png', 0, 0, 1, 1, 1, 1),
(5, 'Payments', 'leads', 'img/payments.png', 0, 0, 1, 1, 1, 1),
(6, 'Orders', 'leads', 'img/orders.png', 0, 0, 1, 1, 1, 1),
(7, 'Reportings', 'leads', 'img/reporting.png', 0, 0, 1, 1, 1, 1),
(8, 'Settings', 'leads', 'img/order-compliance.png', 0, 0, 1, 1, 1, 1),
(9, 'Show All Leads', 'leads', 'img/leads.png', 3, 0, 1, 1, 1, 1),
(10, 'Show Invoices', 'leads', 'img/invoice.png', 4, 0, 1, 1, 1, 1),
(11, 'Show Payments', 'leads', 'img/invoice.png', 5, 0, 1, 1, 1, 1),
(12, 'Show Orders', 'leads', 'img/invoice.png', 6, 0, 1, 1, 1, 1),
(13, 'Show Teams', 'leads', 'img/invoice.png', 8, 0, 1, 1, 1, 1),
(14, 'Show Roles', 'leads', 'img/invoice.png', 8, 0, 1, 1, 1, 1),
(15, 'Show Departments', 'leads', 'img/invoice.png', 8, 0, 1, 1, 1, 1),
(16, 'Show Users', 'leads', 'img/invoice.png', 8, 0, 1, 1, 1, 1),
(17, 'Show Websites', 'leads', 'img/invoice.png', 8, 0, 1, 1, 1, 1),
(18, 'Show IP\'s', 'leads', 'img/invoice.png', 8, 0, 1, 1, 1, 1),
(19, 'Show Permission', 'permissions', 'img/invoice.png', 8, 0, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ps_menu_access`
--

CREATE TABLE `ps_menu_access` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `depart_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `add_acces` int(11) NOT NULL,
  `edit_access` int(11) NOT NULL,
  `delete_access` int(11) NOT NULL,
  `view_access` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ps_menu_access`
--

INSERT INTO `ps_menu_access` (`id`, `role_id`, `depart_id`, `menu_id`, `add_acces`, `edit_access`, `delete_access`, `view_access`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1),
(2, 1, 1, 2, 1, 1, 1, 1),
(3, 1, 1, 3, 1, 1, 1, 1),
(4, 1, 1, 4, 1, 1, 1, 1),
(5, 1, 1, 5, 1, 1, 1, 1),
(6, 1, 1, 6, 1, 1, 1, 1),
(7, 1, 1, 7, 1, 1, 1, 1),
(8, 1, 1, 8, 1, 1, 1, 1),
(9, 1, 1, 9, 1, 1, 1, 1),
(10, 1, 1, 10, 1, 1, 1, 1),
(11, 1, 1, 11, 1, 1, 1, 1),
(12, 1, 1, 12, 1, 1, 1, 1),
(13, 1, 1, 13, 1, 1, 1, 1),
(14, 1, 1, 14, 1, 1, 1, 1),
(15, 1, 1, 15, 1, 1, 1, 1),
(16, 1, 1, 16, 1, 1, 1, 1),
(17, 1, 1, 17, 1, 1, 1, 1),
(18, 1, 1, 18, 1, 1, 1, 1),
(19, 1, 1, 19, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ps_order_child`
--

CREATE TABLE `ps_order_child` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `order_code` longtext DEFAULT NULL,
  `view_code` varchar(20) DEFAULT NULL,
  `services` int(11) NOT NULL,
  `delivery_date` datetime DEFAULT NULL,
  `sale_date` datetime NOT NULL DEFAULT current_timestamp(),
  `comments` longtext DEFAULT NULL,
  `order_d_att` varchar(100) NOT NULL,
  `order_c_att` varchar(100) NOT NULL,
  `assign_to` int(11) DEFAULT 0,
  `assign_by` int(11) DEFAULT 0,
  `assign_at` datetime NOT NULL DEFAULT current_timestamp(),
  `production_status` int(11) DEFAULT 0,
  `support_status` int(11) DEFAULT 0,
  `review` int(11) DEFAULT 0,
  `sow_review` int(11) DEFAULT 0,
  `qa_status` int(11) DEFAULT 0,
  `qa_user` int(11) DEFAULT 0,
  `group_id` int(2) NOT NULL DEFAULT 0,
  `start_date` datetime DEFAULT current_timestamp(),
  `display` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ps_order_child`
--

INSERT INTO `ps_order_child` (`id`, `order_id`, `order_code`, `view_code`, `services`, `delivery_date`, `sale_date`, `comments`, `order_d_att`, `order_c_att`, `assign_to`, `assign_by`, `assign_at`, `production_status`, `support_status`, `review`, `sow_review`, `qa_status`, `qa_user`, `group_id`, `start_date`, `display`) VALUES
(1, 1, 'O-abcd', 'O-abcd', 1, '2021-06-01 20:49:48', '2021-06-21 20:51:24', 'test', '../upload/-1.pdf', 'order_c', 3, 1, '2021-06-02 20:49:48', 1, 6, 0, 0, 0, 0, 1, '2021-06-21 20:51:24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ps_order_history`
--

CREATE TABLE `ps_order_history` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `comment` longtext NOT NULL,
  `files` varchar(100) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) NOT NULL,
  `action` longtext NOT NULL,
  `status` int(11) NOT NULL,
  `qa_status` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ps_order_history`
--

INSERT INTO `ps_order_history` (`id`, `order_id`, `comment`, `files`, `date`, `added_by`, `action`, `status`, `qa_status`) VALUES
(496, 1, 'assign to adnan by dani', '0', '2021-06-26 01:03:25', 1, '', 0, '0'),
(497, 1, 'done order ', 'uploads/O-abcd-2.zip', '2021-06-26 01:03:46', 3, '', 1, '0'),
(498, 1, 'next time acha order dena ', 'uploads/O-abcd-3.zip', '2021-06-26 01:04:08', 3, '', 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `ps_order_main`
--

CREATE TABLE `ps_order_main` (
  `id` int(11) NOT NULL,
  `order_code` longtext NOT NULL,
  `view_code` varchar(50) NOT NULL,
  `lead_id` varchar(50) NOT NULL,
  `invoice_id` varchar(200) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '0',
  `email` varchar(50) NOT NULL DEFAULT '0',
  `number` varchar(50) NOT NULL DEFAULT '0',
  `amount` varchar(50) NOT NULL DEFAULT '0',
  `currency` varchar(10) NOT NULL DEFAULT '0',
  `country` varchar(10) NOT NULL DEFAULT '0',
  `comments` longtext NOT NULL,
  `added_by` int(11) NOT NULL,
  `track_link` longtext NOT NULL,
  `website` int(11) NOT NULL,
  `type` int(11) NOT NULL DEFAULT 0,
  `display_id` int(11) NOT NULL DEFAULT 1,
  `team` varchar(11) NOT NULL DEFAULT 'A',
  `updated_at` datetime NOT NULL,
  `customer_type` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ps_order_main`
--

INSERT INTO `ps_order_main` (`id`, `order_code`, `view_code`, `lead_id`, `invoice_id`, `name`, `email`, `number`, `amount`, `currency`, `country`, `comments`, `added_by`, `track_link`, `website`, `type`, `display_id`, `team`, `updated_at`, `customer_type`) VALUES
(1, 'O-abcd', 'O-abcd', '1', '12', '0', '0', '0', '0', '0', '0', 'test', 2, 'tracklink  ', 1, 0, 0, 'A', '2021-06-01 20:47:28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ps_order_production_status`
--

CREATE TABLE `ps_order_production_status` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status_btn` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ps_order_production_status`
--

INSERT INTO `ps_order_production_status` (`id`, `name`, `status_btn`) VALUES
(1, 'Pending', 'badge-danger'),
(2, 'Assigned', 'badge-primary'),
(3, 'Submit', 'badge-warning'),
(4, 'Complete', 'badge-success');

-- --------------------------------------------------------

--
-- Table structure for table `ps_role`
--

CREATE TABLE `ps_role` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT '1',
  `depart_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ps_role`
--

INSERT INTO `ps_role` (`id`, `name`, `status`, `depart_id`) VALUES
(1, 'Manager', '1', '1'),
(2, 'Team Lead', '1', '1'),
(3, 'Executive', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `ps_services`
--

CREATE TABLE `ps_services` (
  `id` int(50) NOT NULL,
  `name` varchar(200) NOT NULL,
  `display` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ps_services`
--

INSERT INTO `ps_services` (`id`, `name`, `display`) VALUES
(1, 'Article', 0),
(2, 'Blog Post', 0),
(3, 'Website Content', 1),
(4, 'Press Release', 0),
(5, 'Social Media Content', 0),
(6, 'Product Description', 0),
(7, 'Review Writing', 0),
(8, 'Creative Writing', 0),
(9, 'Technical Writing', 0),
(10, 'Email / Newsletter', 0),
(11, 'E-Book', 0),
(12, 'White Paper', 0),
(13, 'Resume / Cover Letter', 0),
(14, 'Tagline / Slogan', 0),
(15, 'Video / Audio Script', 0),
(16, 'Misc', 0),
(17, 'Wikipedia', 0),
(18, 'Wikipedia Profile Creation\r\n \r\n', 0),
(19, 'Wikipedia Editing', 0),
(20, 'Wikipedia Monitoring', 0),
(24, 'Business Plan', 0),
(27, 'Logo', 1),
(25, 'Website', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ps_team`
--

CREATE TABLE `ps_team` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ps_team`
--

INSERT INTO `ps_team` (`id`, `name`, `status`) VALUES
(1, 'All Team', '1'),
(2, 'Team A', '1'),
(3, 'Team C', '1'),
(4, 'Team C', '0'),
(5, 'Team D', '0');

-- --------------------------------------------------------

--
-- Table structure for table `ps_user_login`
--

CREATE TABLE `ps_user_login` (
  `id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT '1',
  `ip_allow` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ps_user_login`
--

INSERT INTO `ps_user_login` (`id`, `user_name`, `password`, `status`, `ip_allow`) VALUES
(1, 'Dani.memon', '0cc175b9c0f1b6a831c399e269772661', '1', '0'),
(2, 'asad.memon', '0cc175b9c0f1b6a831c399e269772661', '1', '1'),
(3, 'adnan.khan', '0cc175b9c0f1b6a831c399e269772661', '1', '1'),
(4, 'Dani.memon1', '0cc175b9c0f1b6a831c399e269772661', '1', '1'),
(5, 'team.lead1', '0cc175b9c0f1b6a831c399e269772661', '1', '1'),
(6, 'dani.again', '202cb962ac59075b964b07152d234b70', '1', '1'),
(7, 'sales.team_lead', '202cb962ac59075b964b07152d234b70', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `ps_user_profile`
--

CREATE TABLE `ps_user_profile` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `first_name_real` varchar(100) NOT NULL,
  `last_name_real` varchar(100) NOT NULL,
  `role` varchar(2) NOT NULL,
  `team` varchar(2) NOT NULL,
  `department` varchar(10) NOT NULL,
  `employee_id` varchar(100) NOT NULL,
  `extension` varchar(100) NOT NULL,
  `fk_parent_id` int(11) NOT NULL,
  `added_by` varchar(10) NOT NULL,
  `manager` varchar(10) NOT NULL,
  `team_lead` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ps_user_profile`
--

INSERT INTO `ps_user_profile` (`id`, `first_name`, `last_name`, `first_name_real`, `last_name_real`, `role`, `team`, `department`, `employee_id`, `extension`, `fk_parent_id`, `added_by`, `manager`, `team_lead`) VALUES
(1, 'Dani', 'Dani', 'Dani', 'Dani', '1', '1', '3', '0', '0', 1, '2', '0', '0'),
(2, 'asad', 'asad', 'asad', 'asad', '2', '1', '3', '0', '0', 2, '2', '4', '0'),
(3, 'adnan', 'adnan', 'adnan', 'adnan', '3', '1', '3', '0', '0', 3, '2', '4', '5'),
(4, 'dani1', 'dani1', 'dani1', 'dani1', '1', '1', '3', '0', '0', 4, '2', '0', '0'),
(5, 'team', 'lead', 'team', 'lead', '2', '1', '3', '0', '0', 5, '2', '4', '0'),
(6, 'dani', 'again', 'dani', 'again', '1', '2', '1', '0', '0', 6, '2', '0', '0'),
(7, 'sales_team', 'lead', 'sales_team', 'lead', '2', '2', '1', '0', '0', 7, '2', '6', '0');

-- --------------------------------------------------------

--
-- Table structure for table `ps_website`
--

CREATE TABLE `ps_website` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `descriptor` varchar(100) NOT NULL,
  `logo` varchar(80) NOT NULL,
  `team` varchar(10) NOT NULL,
  `status` varchar(2) NOT NULL,
  `type` varchar(10) NOT NULL,
  `rigion` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(10) NOT NULL,
  `display_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ps_website`
--

INSERT INTO `ps_website` (`id`, `name`, `descriptor`, `logo`, `team`, `status`, `type`, `rigion`, `created_at`, `created_by`, `display_id`) VALUES
(1, 'www.proficienttutors.com', 'p', 'test.png', '1', '0', 'PPC', '0', '2021-06-14 23:40:41', '1', 1),
(2, 'www.xyz.com', 'test', 'test.png', '1', '1', 'SEO', '0', '2021-06-16 23:06:17', '1', 0),
(3, 'www.abc.com', 'abc', 'techvertix_logo.png', '1', '1', 'SEO', '0', '2021-06-19 19:15:16', '1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ps_website_access`
--

CREATE TABLE `ps_website_access` (
  `id` int(11) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `website_id` varchar(10) NOT NULL,
  `display_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ps_customers`
--
ALTER TABLE `ps_customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ps_department`
--
ALTER TABLE `ps_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ps_invoice_basic`
--
ALTER TABLE `ps_invoice_basic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ps_invoice_detail`
--
ALTER TABLE `ps_invoice_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ps_invoice_history`
--
ALTER TABLE `ps_invoice_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ps_ip_allowed`
--
ALTER TABLE `ps_ip_allowed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ps_leads`
--
ALTER TABLE `ps_leads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ps_leads_history`
--
ALTER TABLE `ps_leads_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ps_leads_status`
--
ALTER TABLE `ps_leads_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ps_logs`
--
ALTER TABLE `ps_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ps_menu`
--
ALTER TABLE `ps_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ps_menu_access`
--
ALTER TABLE `ps_menu_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ps_order_child`
--
ALTER TABLE `ps_order_child`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ps_order_history`
--
ALTER TABLE `ps_order_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`,`files`,`date`,`added_by`,`status`,`qa_status`);

--
-- Indexes for table `ps_order_main`
--
ALTER TABLE `ps_order_main`
  ADD PRIMARY KEY (`id`),
  ADD KEY `view_code` (`view_code`),
  ADD KEY `lead_id` (`lead_id`),
  ADD KEY `invoice_id` (`invoice_id`),
  ADD KEY `name` (`name`),
  ADD KEY `email` (`email`),
  ADD KEY `number` (`number`),
  ADD KEY `team` (`team`);

--
-- Indexes for table `ps_order_production_status`
--
ALTER TABLE `ps_order_production_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ps_role`
--
ALTER TABLE `ps_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ps_services`
--
ALTER TABLE `ps_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ps_team`
--
ALTER TABLE `ps_team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ps_user_login`
--
ALTER TABLE `ps_user_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ps_user_profile`
--
ALTER TABLE `ps_user_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ps_website`
--
ALTER TABLE `ps_website`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ps_website_access`
--
ALTER TABLE `ps_website_access`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ps_customers`
--
ALTER TABLE `ps_customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `ps_department`
--
ALTER TABLE `ps_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ps_invoice_basic`
--
ALTER TABLE `ps_invoice_basic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `ps_invoice_detail`
--
ALTER TABLE `ps_invoice_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=319;

--
-- AUTO_INCREMENT for table `ps_invoice_history`
--
ALTER TABLE `ps_invoice_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ps_ip_allowed`
--
ALTER TABLE `ps_ip_allowed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ps_leads`
--
ALTER TABLE `ps_leads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `ps_leads_history`
--
ALTER TABLE `ps_leads_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `ps_leads_status`
--
ALTER TABLE `ps_leads_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ps_logs`
--
ALTER TABLE `ps_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `ps_menu`
--
ALTER TABLE `ps_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `ps_menu_access`
--
ALTER TABLE `ps_menu_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `ps_order_child`
--
ALTER TABLE `ps_order_child`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ps_order_history`
--
ALTER TABLE `ps_order_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=499;

--
-- AUTO_INCREMENT for table `ps_order_main`
--
ALTER TABLE `ps_order_main`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ps_order_production_status`
--
ALTER TABLE `ps_order_production_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ps_role`
--
ALTER TABLE `ps_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ps_services`
--
ALTER TABLE `ps_services`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `ps_team`
--
ALTER TABLE `ps_team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ps_user_login`
--
ALTER TABLE `ps_user_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ps_user_profile`
--
ALTER TABLE `ps_user_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ps_website`
--
ALTER TABLE `ps_website`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ps_website_access`
--
ALTER TABLE `ps_website_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
