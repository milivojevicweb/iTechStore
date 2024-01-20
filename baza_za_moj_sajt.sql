-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2024 at 06:41 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `baza_za_moj_sajt`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `idAuthor` int(11) NOT NULL,
  `nameLastName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text` varchar(1000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`idAuthor`, `nameLastName`, `text`) VALUES
(1, 'Marko Milivojević', 'Zovem se Marko Milivojević. Rodjen sam 3.8.1998. u Smederevskoj Palanci. Student sam Visoke ICT škole. Završio sam srednju Mašinsko-elektrotehničku školu GOŠA.Broj indeksa: 167/17');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `idCategory` int(255) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`idCategory`, `name`) VALUES
(1, 'iPhone'),
(2, 'iPad'),
(3, 'iWatch'),
(4, 'MacBook');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `idComment` int(11) NOT NULL,
  `idUser` int(255) NOT NULL,
  `idProduct` int(255) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`idComment`, `idUser`, `idProduct`, `comment`, `date`) VALUES
(55, 109, 210, 'Great!', '2021-03-23 15:35:57'),
(56, 109, 231, 'Great!', '2021-03-23 15:36:09'),
(57, 109, 218, 'Great!', '2021-03-23 15:36:27'),
(58, 109, 200, 'Great phone!', '2021-03-23 15:37:40'),
(59, 108, 203, 'Excellent', '2021-03-23 15:39:46'),
(60, 105, 230, 'Very bad', '2021-03-23 15:43:34');

-- --------------------------------------------------------

--
-- Table structure for table `comment_replies`
--

CREATE TABLE `comment_replies` (
  `idReplies` int(255) NOT NULL,
  `idComment` int(255) NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comment_replies`
--

INSERT INTO `comment_replies` (`idReplies`, `idComment`, `text`, `date`) VALUES
(77, 59, 'Thank you!', '2021-03-23 15:45:48'),
(78, 58, 'Thank you!', '2021-03-23 15:46:13'),
(79, 55, 'Thank you!', '2021-03-23 15:46:53'),
(80, 56, 'Thank you!', '2021-03-23 15:47:35'),
(81, 57, 'Thank you!', '2021-03-23 15:48:18');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `idContact` int(255) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`idContact`, `name`, `email`, `text`, `phone`, `status`) VALUES
(63, 'Milos Milosevic', 'markoczv314@gmail.com', 'Proizvodi su odlicni!', '0651344222', 0),
(64, 'Uros Predic', 'markoczv314@gmail.com', 'Sve je super', '0651344222', 1),
(65, 'Uros Predic', 'markoczv314@gmail.com', 'Pozdrav', '0651344222', 0),
(66, 'Marko Milivojevic', 'marko.milivojevic.167.17@ict.edu.rs', 'Usloga je odlicna.', '0651344222', 0),
(67, 'Korisnik Korisnik', 'marko.milivojevic.167.17@ict.edu.rs', 'Super!!!', '0651344222', 1),
(68, 'Mirko Mirkovic', 'mirko@gmail.com', 'Extra', '06554647', 0),
(69, 'Marko Milivojevic', 'markoczv314@gmail.com', 'Bas sam zadovoljan!', '0631632894', 0),
(70, 'Mileva Milic', 'markoczv314@gmail.com', 'iPhone koji sam kupila je odlican', '0631632894', 0);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `idCountry` int(255) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`idCountry`, `name`) VALUES
(1, 'Serbia'),
(2, 'United States'),
(3, 'Germany');

-- --------------------------------------------------------

--
-- Table structure for table `home_product`
--

CREATE TABLE `home_product` (
  `idHomeProduct` int(255) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `home_product`
--

INSERT INTO `home_product` (`idHomeProduct`, `name`) VALUES
(1, 'No'),
(2, 'Home');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `idImages` int(255) NOT NULL,
  `idProduct` int(255) NOT NULL,
  `path` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `pathOld` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `cover` int(1) NOT NULL,
  `alt` varchar(1000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`idImages`, `idProduct`, `path`, `pathOld`, `cover`, `alt`) VALUES
(315, 190, 'assets/images/users/nova_1616459146iphone_12_pro_silver_pdp_image_position-2__en-us_4.jpg', 'assets/images/users/1616459146iphone_12_pro_silver_pdp_image_position-2__en-us_4.jpg', 1, 'iPhone 12 Pro'),
(316, 190, 'assets/images/users/nova_1616459146iphone_12_pro_silver_pdp_image_position-1__en-us.jpg', 'assets/images/users/1616459146iphone_12_pro_silver_pdp_image_position-1__en-us.jpg', 0, 'iPhone 12 Pro'),
(317, 190, 'assets/images/users/nova_1616459146iphone_12_pro_silver_pdp_image_position-3__en-us_4.jpg', 'assets/images/users/1616459146iphone_12_pro_silver_pdp_image_position-3__en-us_4.jpg', 0, 'iPhone 12 Pro'),
(318, 190, 'assets/images/users/nova_1616459146iphone_12_pro_silver_pdp_image_position-4__en-us_4.jpg', 'assets/images/users/1616459146iphone_12_pro_silver_pdp_image_position-4__en-us_4.jpg', 0, 'iPhone 12 Pro'),
(319, 191, 'assets/images/users/nova_1616459912iphone_12_pro_pacific_blue_pdp_image_position-2__en-us_7.jpg', 'assets/images/users/1616459912iphone_12_pro_pacific_blue_pdp_image_position-2__en-us_7.jpg', 1, 'iPhone 12 Pro'),
(320, 191, 'assets/images/users/nova_1616459912iphone_12_pro_pacific_blue_pdp_image_position-3__en-us_6.jpg', 'assets/images/users/1616459912iphone_12_pro_pacific_blue_pdp_image_position-3__en-us_6.jpg', 0, 'iPhone 12 Pro'),
(321, 191, 'assets/images/users/nova_1616459912iphone_12_pro_pacific_blue_pdp_image_position-4__en-us_6.jpg', 'assets/images/users/1616459912iphone_12_pro_pacific_blue_pdp_image_position-4__en-us_6.jpg', 0, 'iPhone 12 Pro'),
(322, 191, 'assets/images/users/nova_1616459912iphone_12_pro_silver_pdp_image_position-1__en-us.jpg', 'assets/images/users/1616459912iphone_12_pro_silver_pdp_image_position-1__en-us.jpg', 0, 'iPhone 12 Pro'),
(323, 192, 'assets/images/users/nova_1616460207iphone_12_pro_gold_pdp_image_position-2__en-us_3.jpg', 'assets/images/users/1616460207iphone_12_pro_gold_pdp_image_position-2__en-us_3.jpg', 1, 'iPhone 12 Pro'),
(324, 192, 'assets/images/users/nova_1616460207iphone_12_pro_gold_pdp_image_position-1__en-us.jpg', 'assets/images/users/1616460207iphone_12_pro_gold_pdp_image_position-1__en-us.jpg', 0, 'iPhone 12 Pro'),
(325, 192, 'assets/images/users/nova_1616460207iphone_12_pro_gold_pdp_image_position-3__en-us_3.jpg', 'assets/images/users/1616460207iphone_12_pro_gold_pdp_image_position-3__en-us_3.jpg', 0, 'iPhone 12 Pro'),
(326, 192, 'assets/images/users/nova_1616460207iphone_12_pro_gold_pdp_image_position-4__en-us_3.jpg', 'assets/images/users/1616460207iphone_12_pro_gold_pdp_image_position-4__en-us_3.jpg', 0, 'iPhone 12 Pro'),
(339, 196, 'assets/images/users/nova_1616461104iphone_12__p_red_pdp_image_position-2__en-us_1_6.jpg', 'assets/images/users/1616461104iphone_12__p_red_pdp_image_position-2__en-us_1_6.jpg', 1, 'iPhone 12'),
(340, 196, 'assets/images/users/nova_1616461104iphone_12__p_red_pdp_image_position-1__en-us.jpg', 'assets/images/users/1616461104iphone_12__p_red_pdp_image_position-1__en-us.jpg', 0, 'iPhone 12'),
(341, 196, 'assets/images/users/nova_1616461104iphone_12__p_red_pdp_image_position-3__en-us_1_6.jpg', 'assets/images/users/1616461104iphone_12__p_red_pdp_image_position-3__en-us_1_6.jpg', 0, 'iPhone 12'),
(342, 196, 'assets/images/users/nova_1616461104iphone_12__p_red_pdp_image_position-4__en-us_1_6.jpg', 'assets/images/users/1616461104iphone_12__p_red_pdp_image_position-4__en-us_1_6.jpg', 0, 'iPhone 12'),
(343, 197, 'assets/images/users/nova_1616461967iphone_12_pdp_image_position-2__en-us_3.jpg', 'assets/images/users/1616461967iphone_12_pdp_image_position-2__en-us_3.jpg', 1, 'iPhone 12'),
(344, 197, 'assets/images/users/nova_1616461967iphone_12_pdp_image_position-1__en-us.jpg', 'assets/images/users/1616461967iphone_12_pdp_image_position-1__en-us.jpg', 0, 'iPhone 12'),
(345, 197, 'assets/images/users/nova_1616461967iphone_12_pdp_image_position-3__en-us_3.jpg', 'assets/images/users/1616461967iphone_12_pdp_image_position-3__en-us_3.jpg', 0, 'iPhone 12'),
(346, 197, 'assets/images/users/nova_1616461967iphone_12_pdp_image_position-4__en-us_3.jpg', 'assets/images/users/1616461967iphone_12_pdp_image_position-4__en-us_3.jpg', 0, 'iPhone 12'),
(347, 198, 'assets/images/users/nova_1616462290iphone_12_white_pdp_image_position-2__en-us_3.jpg', 'assets/images/users/1616462290iphone_12_white_pdp_image_position-2__en-us_3.jpg', 1, 'iPhone 12'),
(348, 198, 'assets/images/users/nova_1616462290iphone_12_white_pdp_image_position-1__en-us.jpg', 'assets/images/users/1616462290iphone_12_white_pdp_image_position-1__en-us.jpg', 0, 'iPhone 12'),
(349, 198, 'assets/images/users/nova_1616462290iphone_12_white_pdp_image_position-3__en-us_3.jpg', 'assets/images/users/1616462290iphone_12_white_pdp_image_position-3__en-us_3.jpg', 0, 'iPhone 12'),
(350, 198, 'assets/images/users/nova_1616462290iphone_12_white_pdp_image_position-4__en-us_3.jpg', 'assets/images/users/1616462290iphone_12_white_pdp_image_position-4__en-us_3.jpg', 0, 'iPhone 12'),
(351, 199, 'assets/images/users/nova_1616462398iphone_12_pro_pacific_blue_pdp_image_position-2__en-us_7.jpg', 'assets/images/users/1616462398iphone_12_pro_pacific_blue_pdp_image_position-2__en-us_7.jpg', 1, 'iPhone 12 Pro Max'),
(352, 199, 'assets/images/users/nova_1616462398iphone_12_pro_pacific_blue_pdp_image_position-1__en-us - Copy.jpg', 'assets/images/users/1616462398iphone_12_pro_pacific_blue_pdp_image_position-1__en-us - Copy.jpg', 0, 'iPhone 12 Pro Max'),
(353, 199, 'assets/images/users/nova_1616462398iphone_12_pro_pacific_blue_pdp_image_position-3__en-us_6.jpg', 'assets/images/users/1616462398iphone_12_pro_pacific_blue_pdp_image_position-3__en-us_6.jpg', 0, 'iPhone 12 Pro Max'),
(354, 199, 'assets/images/users/nova_1616462399iphone_12_pro_pacific_blue_pdp_image_position-4__en-us_6.jpg', 'assets/images/users/1616462399iphone_12_pro_pacific_blue_pdp_image_position-4__en-us_6.jpg', 0, 'iPhone 12 Pro Max'),
(355, 200, 'assets/images/users/nova_1616462520iphone_12_pro_silver_pdp_image_position-2__en-us_4.jpg', 'assets/images/users/1616462520iphone_12_pro_silver_pdp_image_position-2__en-us_4.jpg', 1, 'iPhone 12 Pro Max'),
(356, 200, 'assets/images/users/nova_1616462520iphone_12_pro_silver_pdp_image_position-1__en-us - Copy.jpg', 'assets/images/users/1616462520iphone_12_pro_silver_pdp_image_position-1__en-us - Copy.jpg', 0, 'iPhone 12 Pro Max'),
(357, 200, 'assets/images/users/nova_1616462520iphone_12_pro_silver_pdp_image_position-3__en-us_4 - Copy.jpg', 'assets/images/users/1616462520iphone_12_pro_silver_pdp_image_position-3__en-us_4 - Copy.jpg', 0, 'iPhone 12 Pro Max'),
(358, 200, 'assets/images/users/nova_1616462520iphone_12_pro_silver_pdp_image_position-4__en-us_4 - Copy.jpg', 'assets/images/users/1616462520iphone_12_pro_silver_pdp_image_position-4__en-us_4 - Copy.jpg', 0, 'iPhone 12 Pro Max'),
(359, 201, 'assets/images/users/nova_1616462758iphone_12_pro_max_graphite_pdp_image_position-2__en-us_3.jpg', 'assets/images/users/1616462758iphone_12_pro_max_graphite_pdp_image_position-2__en-us_3.jpg', 1, 'iPhone 12 Pro Max'),
(360, 201, 'assets/images/users/nova_1616462758iphone_12_pro_max_graphite_pdp_image_position-1__en-us_1.jpg', 'assets/images/users/1616462758iphone_12_pro_max_graphite_pdp_image_position-1__en-us_1.jpg', 0, 'iPhone 12 Pro Max'),
(361, 201, 'assets/images/users/nova_1616462758iphone_12_pro_max_graphite_pdp_image_position-3__en-us_3.jpg', 'assets/images/users/1616462758iphone_12_pro_max_graphite_pdp_image_position-3__en-us_3.jpg', 0, 'iPhone 12 Pro Max'),
(362, 201, 'assets/images/users/nova_1616462758iphone_12_pro_max_graphite_pdp_image_position-4__en-us_3.jpg', 'assets/images/users/1616462758iphone_12_pro_max_graphite_pdp_image_position-4__en-us_3.jpg', 0, 'iPhone 12 Pro Max'),
(363, 202, 'assets/images/users/nova_1616462897iphone_12_pdp_image_position-2__en-us_3.jpg', 'assets/images/users/1616462897iphone_12_pdp_image_position-2__en-us_3.jpg', 1, 'iPhone 12 Mini'),
(364, 202, 'assets/images/users/nova_1616462897iphone_12_pdp_image_position-1__en-us.jpg', 'assets/images/users/1616462897iphone_12_pdp_image_position-1__en-us.jpg', 0, 'iPhone 12 Mini'),
(365, 202, 'assets/images/users/nova_1616462897iphone_12_pdp_image_position-3__en-us_3.jpg', 'assets/images/users/1616462897iphone_12_pdp_image_position-3__en-us_3.jpg', 0, 'iPhone 12 Mini'),
(366, 202, 'assets/images/users/nova_1616462897iphone_12_pdp_image_position-4__en-us_3.jpg', 'assets/images/users/1616462897iphone_12_pdp_image_position-4__en-us_3.jpg', 0, 'iPhone 12 Mini'),
(367, 203, 'assets/images/users/nova_1616462921iphone_12_white_pdp_image_position-2__en-us_3.jpg', 'assets/images/users/1616462921iphone_12_white_pdp_image_position-2__en-us_3.jpg', 1, 'iPhone 12 Mini'),
(368, 203, 'assets/images/users/nova_1616462921iphone_12_white_pdp_image_position-1__en-us.jpg', 'assets/images/users/1616462921iphone_12_white_pdp_image_position-1__en-us.jpg', 0, 'iPhone 12 Mini'),
(369, 203, 'assets/images/users/nova_1616462921iphone_12_white_pdp_image_position-3__en-us_3.jpg', 'assets/images/users/1616462921iphone_12_white_pdp_image_position-3__en-us_3.jpg', 0, 'iPhone 12 Mini'),
(370, 203, 'assets/images/users/nova_1616462921iphone_12_white_pdp_image_position-4__en-us_3.jpg', 'assets/images/users/1616462921iphone_12_white_pdp_image_position-4__en-us_3.jpg', 0, 'iPhone 12 Mini'),
(371, 204, 'assets/images/users/nova_1616462934iphone_12__p_red_pdp_image_position-2__en-us_1_6.jpg', 'assets/images/users/1616462934iphone_12__p_red_pdp_image_position-2__en-us_1_6.jpg', 1, 'iPhone 12 Mini'),
(372, 204, 'assets/images/users/nova_1616462934iphone_12__p_red_pdp_image_position-1__en-us.jpg', 'assets/images/users/1616462934iphone_12__p_red_pdp_image_position-1__en-us.jpg', 0, 'iPhone 12 Mini'),
(373, 204, 'assets/images/users/nova_1616462934iphone_12__p_red_pdp_image_position-3__en-us_1_6.jpg', 'assets/images/users/1616462934iphone_12__p_red_pdp_image_position-3__en-us_1_6.jpg', 0, 'iPhone 12 Mini'),
(374, 204, 'assets/images/users/nova_1616462934iphone_12__p_red_pdp_image_position-4__en-us_1_6.jpg', 'assets/images/users/1616462934iphone_12__p_red_pdp_image_position-4__en-us_1_6.jpg', 0, 'iPhone 12 Mini'),
(375, 205, 'assets/images/users/nova_1616463040iphone_12_mini_green_pdp_image_position-2__en-us_6.jpg', 'assets/images/users/1616463040iphone_12_mini_green_pdp_image_position-2__en-us_6.jpg', 1, 'iPhone 12 Mini'),
(376, 205, 'assets/images/users/nova_1616463040iphone_12_mini_green_pdp_image_position-1__en-us.jpg', 'assets/images/users/1616463040iphone_12_mini_green_pdp_image_position-1__en-us.jpg', 0, 'iPhone 12 Mini'),
(377, 205, 'assets/images/users/nova_1616463040iphone_12_mini_green_pdp_image_position-3__en-us_6.jpg', 'assets/images/users/1616463040iphone_12_mini_green_pdp_image_position-3__en-us_6.jpg', 0, 'iPhone 12 Mini'),
(378, 205, 'assets/images/users/nova_1616463040iphone_12_mini_green_pdp_image_position-4__en-us_6.jpg', 'assets/images/users/1616463040iphone_12_mini_green_pdp_image_position-4__en-us_6.jpg', 0, 'iPhone 12 Mini'),
(379, 206, 'assets/images/users/nova_1616464177wwen_ipad_pro_2nd_generation_gps_space_gray_aluminum_11in_pdp_1a.jpg', 'assets/images/users/1616464177wwen_ipad_pro_2nd_generation_gps_space_gray_aluminum_11in_pdp_1a.jpg', 1, 'iPad Pro'),
(380, 206, 'assets/images/users/nova_1616464177wwen_ipad_pro_2nd_generation_gps_space_gray_aluminum_11in_pdp_1b.jpg', 'assets/images/users/1616464177wwen_ipad_pro_2nd_generation_gps_space_gray_aluminum_11in_pdp_1b.jpg', 0, 'iPad Pro'),
(381, 206, 'assets/images/users/nova_1616464177wwen_ipad_pro_2nd_generation_gps_space_gray_aluminum_11in_pdp_2.jpg', 'assets/images/users/1616464177wwen_ipad_pro_2nd_generation_gps_space_gray_aluminum_11in_pdp_2.jpg', 0, 'iPad Pro'),
(382, 206, 'assets/images/users/nova_1616464177wwen_ipad_pro_2nd_generation_gps_space_gray_aluminum_11in_pdp_4.jpg', 'assets/images/users/1616464177wwen_ipad_pro_2nd_generation_gps_space_gray_aluminum_11in_pdp_4.jpg', 0, 'iPad Pro'),
(383, 207, 'assets/images/users/nova_1616464366wwen_ipad_pro_2nd_generation_gps_silver_aluminum_11in_pdp_1a_1_1.jpg', 'assets/images/users/1616464366wwen_ipad_pro_2nd_generation_gps_silver_aluminum_11in_pdp_1a_1_1.jpg', 1, 'iPad Pro'),
(384, 207, 'assets/images/users/nova_1616464366wwen_ipad_pro_2nd_generation_gps_silver_aluminum_11in_pdp_1b_1_1.jpg', 'assets/images/users/1616464366wwen_ipad_pro_2nd_generation_gps_silver_aluminum_11in_pdp_1b_1_1.jpg', 0, 'iPad Pro'),
(385, 207, 'assets/images/users/nova_1616464366wwen_ipad_pro_2nd_generation_gps_silver_aluminum_11in_pdp_2_1_1.jpg', 'assets/images/users/1616464366wwen_ipad_pro_2nd_generation_gps_silver_aluminum_11in_pdp_2_1_1.jpg', 0, 'iPad Pro'),
(386, 207, 'assets/images/users/nova_1616464366wwen_ipad_pro_2nd_generation_gps_silver_aluminum_11in_pdp_4_1_1.jpg', 'assets/images/users/1616464366wwen_ipad_pro_2nd_generation_gps_silver_aluminum_11in_pdp_4_1_1.jpg', 0, 'iPad Pro'),
(387, 208, 'assets/images/users/nova_1616464644ipad-air-select-wifi-blue-202009_3.jpg', 'assets/images/users/1616464644ipad-air-select-wifi-blue-202009_3.jpg', 1, 'iPad Air'),
(388, 208, 'assets/images/users/nova_1616464644ipad_air_wi-fi_10.9_in_sky_blue_pdp_image_position-1a_wwen.jpg', 'assets/images/users/1616464644ipad_air_wi-fi_10.9_in_sky_blue_pdp_image_position-1a_wwen.jpg', 0, 'iPad Air'),
(389, 208, 'assets/images/users/nova_1616464742ipad_air_wii-fi_10.9_in_sky_blue_pdp_image_position-2__wwen.jpg', 'assets/images/users/1616464742ipad_air_wii-fi_10.9_in_sky_blue_pdp_image_position-2__wwen.jpg', 0, 'iPad Air'),
(390, 209, 'assets/images/users/nova_1616464896ipad-air-select-wifi-green-202009_1_3.jpg', 'assets/images/users/1616464896ipad-air-select-wifi-green-202009_1_3.jpg', 1, 'iPad Air'),
(391, 209, 'assets/images/users/nova_1616464896ipad_air_wi-fi_10_9_in_green_pdp_image_position-1a_wwen_1.jpg', 'assets/images/users/1616464896ipad_air_wi-fi_10_9_in_green_pdp_image_position-1a_wwen_1.jpg', 0, 'iPad Air'),
(392, 209, 'assets/images/users/nova_1616464896ipad_air_wi-fi_10_9_in_green_pdp_image_position-2__wwen_1.jpg', 'assets/images/users/1616464896ipad_air_wi-fi_10_9_in_green_pdp_image_position-2__wwen_1.jpg', 0, 'iPad Air'),
(393, 210, 'assets/images/users/nova_1616465009ipad-air-select-wifi-silver-202009_2.jpg', 'assets/images/users/1616465009ipad-air-select-wifi-silver-202009_2.jpg', 1, 'iPad Air'),
(394, 210, 'assets/images/users/nova_1616465009ipad_air_wi-fi_10_9_in_silver_pdp_image_position-1a_wwen_1.jpg', 'assets/images/users/1616465009ipad_air_wi-fi_10_9_in_silver_pdp_image_position-1a_wwen_1.jpg', 0, 'iPad Air'),
(395, 210, 'assets/images/users/nova_1616465009ipad_air_wi-fi_10_9_in_silver_pdp_image_position-2__wwen_1.jpg', 'assets/images/users/1616465009ipad_air_wi-fi_10_9_in_silver_pdp_image_position-2__wwen_1.jpg', 0, 'iPad Air'),
(396, 211, 'assets/images/users/nova_1616465152ipad-2020-gold_3.jpg', 'assets/images/users/1616465152ipad-2020-gold_3.jpg', 1, 'iPad'),
(397, 211, 'assets/images/users/nova_1616465152mylc2hc_2.jpg', 'assets/images/users/1616465152mylc2hc_2.jpg', 0, 'iPad'),
(398, 211, 'assets/images/users/nova_1616465152mylc2hc_3.jpg', 'assets/images/users/1616465152mylc2hc_3.jpg', 0, 'iPad'),
(399, 211, 'assets/images/users/nova_1616465152mylc2hc_6.jpg', 'assets/images/users/1616465152mylc2hc_6.jpg', 0, 'iPad'),
(400, 212, 'assets/images/users/nova_1616465302ipad-2020-spacegrey_2.jpg', 'assets/images/users/1616465302ipad-2020-spacegrey_2.jpg', 1, 'iPad'),
(401, 212, 'assets/images/users/nova_1616465303myl92hc_2.jpg', 'assets/images/users/1616465303myl92hc_2.jpg', 0, 'iPad'),
(402, 212, 'assets/images/users/nova_1616465303myl92hc_5.jpg', 'assets/images/users/1616465303myl92hc_5.jpg', 0, 'iPad'),
(403, 212, 'assets/images/users/nova_1616465303myl92hc_6.jpg', 'assets/images/users/1616465303myl92hc_6.jpg', 0, 'iPad'),
(404, 213, 'assets/images/users/nova_1616465400ipad-2020-silver_2.jpg', 'assets/images/users/1616465400ipad-2020-silver_2.jpg', 1, 'iPad'),
(405, 213, 'assets/images/users/nova_1616465400myla2hc_1.jpg', 'assets/images/users/1616465400myla2hc_1.jpg', 0, 'iPad'),
(406, 213, 'assets/images/users/nova_1616465400myla2hc_2.jpg', 'assets/images/users/1616465400myla2hc_2.jpg', 0, 'iPad'),
(407, 213, 'assets/images/users/nova_1616465401myla2hc_3.jpg', 'assets/images/users/1616465401myla2hc_3.jpg', 0, 'iPad'),
(408, 214, 'assets/images/users/nova_1616465571ipad-air-select-wifi-spacegray-202009_3.jpg', 'assets/images/users/1616465571ipad-air-select-wifi-spacegray-202009_3.jpg', 1, 'iPad Air'),
(412, 214, 'assets/images/users/nova_1616465634ipad_air_wi-fi_10_9_in_space_gray_pdp_image_position-2__wwen.jpg', 'assets/images/users/1616465634ipad_air_wi-fi_10_9_in_space_gray_pdp_image_position-2__wwen.jpg', 0, 'iPad Air'),
(413, 214, 'assets/images/users/nova_1616465640ipad_air_wi-fi_10_9_in_space_gray_pdp_image_position-1a_wwen.jpg', 'assets/images/users/1616465640ipad_air_wi-fi_10_9_in_space_gray_pdp_image_position-1a_wwen.jpg', 0, 'iPad Air'),
(414, 215, 'assets/images/users/nova_1616465719ipad-air-select-wifi-gold-202009_2_3.jpg', 'assets/images/users/1616465719ipad-air-select-wifi-gold-202009_2_3.jpg', 1, 'iPad Air'),
(415, 215, 'assets/images/users/nova_1616465719ipad_air_wi-fi_10_9_in_rose_gold_pdp_image_position-1a_wwen.jpg', 'assets/images/users/1616465719ipad_air_wi-fi_10_9_in_rose_gold_pdp_image_position-1a_wwen.jpg', 0, 'iPad Air'),
(416, 215, 'assets/images/users/nova_1616465719ipad_air_wi-fi_10_9_in_rose_gold_pdp_image_position-2__wwen.jpg', 'assets/images/users/1616465719ipad_air_wi-fi_10_9_in_rose_gold_pdp_image_position-2__wwen.jpg', 0, 'iPad Air'),
(417, 216, 'assets/images/users/nova_1616465902macbook_pro_13in_spgry_pdp_image_position-2_m1_chip__usen_7_2_7.jpg', 'assets/images/users/1616465902macbook_pro_13in_spgry_pdp_image_position-2_m1_chip__usen_7_2_7.jpg', 1, 'MacBook Pro 13'),
(418, 216, 'assets/images/users/nova_1616465903macbook_pro_13in_spgry_pdp_image_position-1_m1_chip__usen_8_2_7.jpg', 'assets/images/users/1616465903macbook_pro_13in_spgry_pdp_image_position-1_m1_chip__usen_8_2_7.jpg', 0, 'MacBook Pro 13'),
(419, 216, 'assets/images/users/nova_1616465903macbook_pro_13in_spgry_pdp_image_position-3_m1_chip__usen_8_2_7.jpg', 'assets/images/users/1616465903macbook_pro_13in_spgry_pdp_image_position-3_m1_chip__usen_8_2_7.jpg', 0, 'MacBook Pro 13'),
(420, 216, 'assets/images/users/nova_1616465903macbook_pro_13in_spgry_pdp_image_position-4_m1_chip__usen_8_2_7.jpg', 'assets/images/users/1616465903macbook_pro_13in_spgry_pdp_image_position-4_m1_chip__usen_8_2_7.jpg', 0, 'MacBook Pro 13'),
(421, 216, 'assets/images/users/nova_1616465903macbook_pro_13in_spgry_pdp_image_position-5_m1_chip__usen_8_2_7.jpg', 'assets/images/users/1616465903macbook_pro_13in_spgry_pdp_image_position-5_m1_chip__usen_8_2_7.jpg', 0, 'MacBook Pro 13'),
(422, 217, 'assets/images/users/nova_1616466006macbook_pro_13in_silver_pdp_image_position-2_m1_chip__usen_7_2_5.jpg', 'assets/images/users/1616466006macbook_pro_13in_silver_pdp_image_position-2_m1_chip__usen_7_2_5.jpg', 1, 'MacBook Pro 13'),
(423, 217, 'assets/images/users/nova_1616466006macbook_pro_13in_silver_pdp_image_position-1_m1_chip__usen_7_2_7.jpg', 'assets/images/users/1616466006macbook_pro_13in_silver_pdp_image_position-1_m1_chip__usen_7_2_7.jpg', 0, 'MacBook Pro 13'),
(424, 217, 'assets/images/users/nova_1616466006macbook_pro_13in_silver_pdp_image_position-3_m1_chip__usen_7_2_5.jpg', 'assets/images/users/1616466006macbook_pro_13in_silver_pdp_image_position-3_m1_chip__usen_7_2_5.jpg', 0, 'MacBook Pro 13'),
(425, 217, 'assets/images/users/nova_1616466006macbook_pro_13in_silver_pdp_image_position-4_m1_chip__usen_7_2_5.jpg', 'assets/images/users/1616466006macbook_pro_13in_silver_pdp_image_position-4_m1_chip__usen_7_2_5.jpg', 0, 'MacBook Pro 13'),
(426, 217, 'assets/images/users/nova_1616466006macbook_pro_13in_silver_pdp_image_position-5_m1_chip__usen_7_2_5.jpg', 'assets/images/users/1616466006macbook_pro_13in_silver_pdp_image_position-5_m1_chip__usen_7_2_5.jpg', 0, 'MacBook Pro 13'),
(427, 218, 'assets/images/users/nova_1616466214macbook_air_space_gray_pdp_image_position-1_m1_chip__usen_1_1_6.jpg', 'assets/images/users/1616466214macbook_air_space_gray_pdp_image_position-1_m1_chip__usen_1_1_6.jpg', 1, 'MacBook Air M1 '),
(428, 218, 'assets/images/users/nova_1616466214macbook_air_space_gray_pdp_image_position-2_m1_chip__usen_1_1_6.jpg', 'assets/images/users/1616466214macbook_air_space_gray_pdp_image_position-2_m1_chip__usen_1_1_6.jpg', 0, 'MacBook Air M1 '),
(429, 218, 'assets/images/users/nova_1616466214macbook_air_space_gray_pdp_image_position-3_m1_chip__usen_1_1_6.jpg', 'assets/images/users/1616466214macbook_air_space_gray_pdp_image_position-3_m1_chip__usen_1_1_6.jpg', 0, 'MacBook Air M1 '),
(430, 218, 'assets/images/users/nova_1616466214macbook_air_space_gray_pdp_image_position-4_m1_chip__usen_1_1_6.jpg', 'assets/images/users/1616466214macbook_air_space_gray_pdp_image_position-4_m1_chip__usen_1_1_6.jpg', 0, 'MacBook Air M1 '),
(431, 218, 'assets/images/users/nova_1616466214macbook_air_space_gray_pdp_image_position-5_m1_chip__usen_1_1_6.jpg', 'assets/images/users/1616466214macbook_air_space_gray_pdp_image_position-5_m1_chip__usen_1_1_6.jpg', 0, 'MacBook Air M1 '),
(432, 219, 'assets/images/users/nova_1616466276macbook_air_13-in_print.jpg', 'assets/images/users/1616466276macbook_air_13-in_print.jpg', 1, 'MacBook Air 13'),
(433, 219, 'assets/images/users/nova_1616466276macbook_air_13-in_print-2.jpg', 'assets/images/users/1616466276macbook_air_13-in_print-2.jpg', 0, 'MacBook Air 13'),
(434, 220, 'assets/images/users/nova_1616466361macbook_pro_16-in_touch_bar_pure_top_open_space_gray_wwen_screen-1_1_1_2_1_2.jpg', 'assets/images/users/1616466361macbook_pro_16-in_touch_bar_pure_top_open_space_gray_wwen_screen-1_1_1_2_1_2.jpg', 1, 'MacBook Pro 16'),
(435, 220, 'assets/images/users/nova_1616466361macbook_pro_16-in_touch_bar_pure_top_open_space_gray_wwen_screen-1_1_1_2_1_2.jpg', 'assets/images/users/1616466361macbook_pro_16-in_touch_bar_pure_top_open_space_gray_wwen_screen-1_1_1_2_1_2.jpg', 0, 'MacBook Pro 16'),
(436, 221, 'assets/images/users/nova_1616466984wwen_macbook_pro_13in_2ports_space_gray_pdp_us_3_1_1_8_2.jpg', 'assets/images/users/1616466984wwen_macbook_pro_13in_2ports_space_gray_pdp_us_3_1_1_8_2.jpg', 1, 'MacBook Pro 13'),
(437, 221, 'assets/images/users/nova_1616466984wwen_macbook_pro_13in_2ports_space_gray_pdp_us_1_1_1_8_2.jpg', 'assets/images/users/1616466984wwen_macbook_pro_13in_2ports_space_gray_pdp_us_1_1_1_8_2.jpg', 0, 'MacBook Pro 13'),
(438, 221, 'assets/images/users/nova_1616466984wwen_macbook_pro_13in_2ports_space_gray_pdp_us_2_1_1_8_2.jpg', 'assets/images/users/1616466984wwen_macbook_pro_13in_2ports_space_gray_pdp_us_2_1_1_8_2.jpg', 0, 'MacBook Pro 13'),
(439, 221, 'assets/images/users/nova_1616466984wwen_macbook_pro_13in_2ports_space_gray_pdp_us_4_1_1_8_2.jpg', 'assets/images/users/1616466984wwen_macbook_pro_13in_2ports_space_gray_pdp_us_4_1_1_8_2.jpg', 0, 'MacBook Pro 13'),
(440, 222, 'assets/images/users/nova_1616467028wwen_macbook_pro_13in_2ports_space_gray_pdp_us_3_1_1_8_2.jpg', 'assets/images/users/1616467028wwen_macbook_pro_13in_2ports_space_gray_pdp_us_3_1_1_8_2.jpg', 1, 'MacBook Pro 16'),
(441, 222, 'assets/images/users/nova_1616467028wwen_macbook_pro_13in_2ports_space_gray_pdp_us_1_1_1_8_2.jpg', 'assets/images/users/1616467028wwen_macbook_pro_13in_2ports_space_gray_pdp_us_1_1_1_8_2.jpg', 0, 'MacBook Pro 16'),
(442, 222, 'assets/images/users/nova_1616467028wwen_macbook_pro_13in_2ports_space_gray_pdp_us_2_1_1_8_2.jpg', 'assets/images/users/1616467028wwen_macbook_pro_13in_2ports_space_gray_pdp_us_2_1_1_8_2.jpg', 0, 'MacBook Pro 16'),
(443, 222, 'assets/images/users/nova_1616467028wwen_macbook_pro_13in_2ports_space_gray_pdp_us_4_1_1_8_2.jpg', 'assets/images/users/1616467028wwen_macbook_pro_13in_2ports_space_gray_pdp_us_4_1_1_8_2.jpg', 0, 'MacBook Pro 16'),
(444, 223, 'assets/images/users/nova_1616467617MYAN2_VW_PF+watch-40-stainless-graphite-cell-6s_VW_PF_WF_CO.jpg', 'assets/images/users/1616467353MYAN2_VW_34FR+watch-40-stainless-graphite-cell-6s_VW_34FR_WF_CO.jpg', 1, 'Apple Watch'),
(445, 223, 'assets/images/users/nova_1616467353MYAN2.jpg', 'assets/images/users/1616467353MYAN2.jpg', 0, 'Apple Watch'),
(446, 223, 'assets/images/users/nova_1616467629MYAN2_VW_34FR+watch-40-stainless-graphite-cell-6s_VW_34FR_WF_CO.jpg', 'assets/images/users/1616467629MYAN2_VW_34FR+watch-40-stainless-graphite-cell-6s_VW_34FR_WF_CO.jpg', 0, 'Apple Watch'),
(447, 224, 'assets/images/users/nova_1616467588MY6K2ref_VW_PF+watch-40-alum-spacegray-nc-6s_VW_PF_WF_CO.jpg', 'assets/images/users/1616467481MY6K2ref_VW_34FR+watch-40-alum-spacegray-nc-6s_VW_34FR_WF_CO.jpg', 1, 'Apple Watch'),
(448, 224, 'assets/images/users/nova_1616467481MY6K2ref.jpg', 'assets/images/users/1616467481MY6K2ref.jpg', 0, 'Apple Watch'),
(449, 224, 'assets/images/users/nova_1616467600MY6K2ref_VW_34FR+watch-40-alum-spacegray-nc-6s_VW_34FR_WF_CO.jpg', 'assets/images/users/1616467600MY6K2ref_VW_34FR+watch-40-alum-spacegray-nc-6s_VW_34FR_WF_CO.jpg', 0, 'Apple Watch'),
(450, 225, 'assets/images/users/nova_1616467710MYQP2ref_VW_PF+watch-40-alum-silver-nc-6s_VW_PF_WF_CO.jpg', 'assets/images/users/1616467710MYQP2ref_VW_PF+watch-40-alum-silver-nc-6s_VW_PF_WF_CO.jpg', 1, 'Apple Watch'),
(451, 225, 'assets/images/users/nova_1616467710MYQP2ref.jpg', 'assets/images/users/1616467710MYQP2ref.jpg', 0, 'Apple Watch'),
(452, 225, 'assets/images/users/nova_1616467710MYQP2ref_VW_34FR+watch-40-alum-silver-nc-6s_VW_34FR_WF_CO.jpg', 'assets/images/users/1616467710MYQP2ref_VW_34FR+watch-40-alum-silver-nc-6s_VW_34FR_WF_CO.jpg', 0, 'Apple Watch'),
(453, 226, 'assets/images/users/nova_1616467771MYPU2ref_VW_PF+watch-40-alum-gold-nc-6s_VW_PF_WF_CO.jpg', 'assets/images/users/1616467771MYPU2ref_VW_PF+watch-40-alum-gold-nc-6s_VW_PF_WF_CO.jpg', 1, 'Apple Watch'),
(454, 226, 'assets/images/users/nova_1616467771MYPU2ref.jpg', 'assets/images/users/1616467771MYPU2ref.jpg', 0, 'Apple Watch'),
(455, 226, 'assets/images/users/nova_1616467771MYPU2ref_VW_34FR+watch-40-alum-gold-nc-6s_VW_34FR_WF_CO.jpg', 'assets/images/users/1616467771MYPU2ref_VW_34FR+watch-40-alum-gold-nc-6s_VW_34FR_WF_CO.jpg', 0, 'Apple Watch'),
(456, 227, 'assets/images/users/nova_1616467850MY632ref_VW_PF+watch-40-stainless-silver-cell-6s_VW_PF_WF_CO.jpg', 'assets/images/users/1616467850MY632ref_VW_PF+watch-40-stainless-silver-cell-6s_VW_PF_WF_CO.jpg', 1, 'Apple Watch'),
(457, 227, 'assets/images/users/nova_1616467850MY632ref.jpg', 'assets/images/users/1616467850MY632ref.jpg', 0, 'Apple Watch'),
(458, 227, 'assets/images/users/nova_1616467850MY632ref_VW_34FR+watch-40-stainless-silver-cell-6s_VW_34FR_WF_CO.jpg', 'assets/images/users/1616467850MY632ref_VW_34FR+watch-40-stainless-silver-cell-6s_VW_34FR_WF_CO.jpg', 0, 'Apple Watch'),
(459, 228, 'assets/images/users/nova_1616468016MY982_VW_PF+watch-40-stainless-silver-cell-6s_VW_PF_WF_CO.jpg', 'assets/images/users/1616468016MY982_VW_PF+watch-40-stainless-silver-cell-6s_VW_PF_WF_CO.jpg', 1, 'Apple Watch'),
(460, 228, 'assets/images/users/nova_1616468016MY982.jpg', 'assets/images/users/1616468016MY982.jpg', 0, 'Apple Watch'),
(461, 228, 'assets/images/users/nova_1616468016MY982_VW_34FR+watch-40-stainless-silver-cell-6s_VW_34FR_WF_CO.jpg', 'assets/images/users/1616468016MY982_VW_34FR+watch-40-stainless-silver-cell-6s_VW_34FR_WF_CO.jpg', 0, 'Apple Watch'),
(462, 229, 'assets/images/users/nova_1616468101MYA22_VW_PF+watch-40-alum-spacegray-nc-6s_VW_PF_WF_CO.jpg', 'assets/images/users/1616468101MYA22_VW_PF+watch-40-alum-spacegray-nc-6s_VW_PF_WF_CO.jpg', 1, 'Apple Watch'),
(463, 229, 'assets/images/users/nova_1616468101MYA22.jpg', 'assets/images/users/1616468101MYA22.jpg', 0, 'Apple Watch'),
(464, 229, 'assets/images/users/nova_1616468101MYA22_VW_34FR+watch-40-alum-spacegray-nc-6s_VW_34FR_WF_CO.jpg', 'assets/images/users/1616468101MYA22_VW_34FR+watch-40-alum-spacegray-nc-6s_VW_34FR_WF_CO.jpg', 0, 'Apple Watch'),
(465, 230, 'assets/images/users/nova_1616468173MXAF2ref_VW_PF+watch-44-stainless-gold-cell-6s_VW_PF_WF_CO.jpg', 'assets/images/users/1616468173MXAF2ref_VW_PF+watch-44-stainless-gold-cell-6s_VW_PF_WF_CO.jpg', 1, 'Apple Watch'),
(466, 230, 'assets/images/users/nova_1616468173MXAF2ref.jpg', 'assets/images/users/1616468173MXAF2ref.jpg', 0, 'Apple Watch'),
(467, 230, 'assets/images/users/nova_1616468173MXAF2ref_VW_34FR+watch-44-stainless-gold-cell-6s_VW_34FR_WF_CO.jpg', 'assets/images/users/1616468173MXAF2ref_VW_34FR+watch-44-stainless-gold-cell-6s_VW_34FR_WF_CO.jpg', 0, 'Apple Watch'),
(468, 231, 'assets/images/users/nova_1616468242MYNM2ref_VW_PF+watch-40-alum-silver-nc-6s_VW_PF_WF_CO.jpg', 'assets/images/users/1616468242MYNM2ref_VW_PF+watch-40-alum-silver-nc-6s_VW_PF_WF_CO.jpg', 1, 'Apple Watch'),
(469, 231, 'assets/images/users/nova_1616468242MYNM2ref.jpg', 'assets/images/users/1616468242MYNM2ref.jpg', 0, 'Apple Watch'),
(470, 231, 'assets/images/users/nova_1616468242MYNM2ref_VW_34FR+watch-40-alum-silver-nc-6s_VW_34FR_WF_CO.jpg', 'assets/images/users/1616468242MYNM2ref_VW_34FR+watch-40-alum-silver-nc-6s_VW_34FR_WF_CO.jpg', 0, 'Apple Watch'),
(471, 232, 'assets/images/users/nova_1616468305MYNC2ref_VW_PF+watch-40-alum-spacegray-nc-6s_VW_PF_WF_CO.jpg', 'assets/images/users/1616468305MYNC2ref_VW_PF+watch-40-alum-spacegray-nc-6s_VW_PF_WF_CO.jpg', 1, 'Apple Watch'),
(472, 232, 'assets/images/users/nova_1616468305MYNC2ref.jpg', 'assets/images/users/1616468305MYNC2ref.jpg', 0, 'Apple Watch'),
(473, 232, 'assets/images/users/nova_1616468305MYNC2ref_VW_34FR+watch-40-alum-spacegray-nc-6s_VW_34FR_WF_CO.jpg', 'assets/images/users/1616468305MYNC2ref_VW_34FR+watch-40-alum-spacegray-nc-6s_VW_34FR_WF_CO.jpg', 0, 'Apple Watch');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `idMenu` int(50) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `href` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`idMenu`, `name`, `href`) VALUES
(5, 'News', 'index.php?page=news'),
(6, 'Login', 'index.php?page=login'),
(7, 'Contact', 'index.php?page=contact'),
(8, 'Author', 'index.php?page=author');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `idNews` int(255) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `bigImage` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `idUser` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`idNews`, `title`, `text`, `date`, `bigImage`, `image`, `idUser`) VALUES
(49, 'Be aware of gift card scams', '<p>Be aware of scams involving Apple Gift Cards, App Store &amp; iTunes Gift Cards, and Apple Store Gift Cards.</p>\r\n\r\n<p>If you believe you&#39;re the victim of a scam involving Apple Gift Cards, App Store &amp; iTunes Gift Cards, or Apple Store Gift Cards, you can call Apple at 800-275-2273 (U.S.) and say &quot;gift cards&quot; when prompted.</p>\r\n\r\n<p>A string of scams are taking place asking people to make payments over the phone for things such as taxes, hospital bills, bail money, debt collection, and utility bills. The scams are committed using many methods, including gift cards. As the fraudsters are sometimes requesting codes from Apple Gift Cards, App Store &amp; iTunes Gift Cards, or Apple Store Gift Cards, we want to make sure our customers are aware of these scams.</p>\r\n\r\n<p>Regardless of the reason for payment, the scam follows a certain formula: The victim receives a call instilling panic and urgency to make a payment by purchasing Apple Gift Cards, App Store &amp; iTunes Gift Cards, or Apple Store Gift Cards from the nearest retailer (convenience store, electronics retailer, etc.). After the cards have been purchased, the victim is asked to pay by sharing the code(s) on the back of the card with the caller over the phone.</p>\r\n\r\n<p>It&#39;s important to know that Apple Gift Cards and App Store &amp; iTunes Gift Cards can be used only to purchase goods and services from Apple &mdash; including from Apple Retail Stores,&nbsp;<a href=\"https://www.apple.com/\">apple.com</a>, the App Store, iTunes Store, Apple Books, for subscriptions to Apple services like Apple Music, Apple News+, and Apple Arcade, or for iCloud storage. Apple Store Gift Cards can be redeemed only on the Apple Online Store and at Apple Retail Stores. If you&#39;re approached to use the cards for any other payment, you could very likely be the target of a scam and should immediately report&nbsp;it to your local police department as well as the Federal Trade Commission (FTC) at&nbsp;<a href=\"https://reportfraud.ftc.gov/\">reportfraud.ftc.gov</a>.</p>\r\n\r\n<p><img alt=\"\" src=\"https://support.apple.com/content/dam/edam/applecare/images/en_US/psp/apple-store-app-store-gift-cards-art-stack.jpg\" style=\"height:215px; width:530px\" /></p>\r\n\r\n<p>Never provide the numbers on the back of a Gift Card to someone you do not know. Once those numbers are provided to the scammers, the funds on the card will likely be spent before you are able to contact Apple or law enforcement.&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"https://support.apple.com/content/dam/edam/applecare/images/en_US/psp/apple-gift-card-back-us-2.png\" style=\"height:215px; width:530px\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Tips to avoid becoming the victim of a scam</h2>\r\n\r\n<ul>\r\n	<li>If you are NOT purchasing an item from Apple &mdash; such as from the Apple Store, iTunes Store, App Store, Apple Books, or for an Apple Music subscription or iCloud storage &mdash; do NOT make a payment with an Apple Gift Card, App Store &amp; iTunes Gift Card, or Apple Store Gift Card. There&#39;s no other instance in which you&#39;ll be asked to make a payment with either of these gift cards.</li>\r\n	<li>Do not provide the numbers on the back of the gift card to anyone that you don&#39;t know.</li>\r\n	<li>Immediately report potential scams to your local&nbsp;police department as well as the FTC (<a href=\"https://reportfraud.ftc.gov/\">reportfraud.ftc.gov</a>).</li>\r\n</ul>\r\n\r\n<h2>Contact Apple</h2>\r\n\r\n<p>If you have additional questions, or if you&#39;ve been a victim of a scam involving Apple Gift Cards, App Store &amp; iTunes Gift Cards or Apple Store Gift Cards,&nbsp;you can call Apple at 800-275-2273 (U.S.) and say &quot;gift cards&quot; when prompted, or&nbsp;<a href=\"https://getsupport.apple.com/?caller=itgc&amp;PGF=PGF51002&amp;category_id=SC0082&amp;symptom_id=20256\">contact Apple Support</a>&nbsp;online.</p>\r\n\r\n<h2>&nbsp;</h2>\r\n', '2021-03-23', 'assets/images/users/1616468718og__dtukeczp0ygm_overview.png', 'assets/images/users/1616468718og__dtukeczp0ygm_overview.png', 92),
(50, 'Use 5G with your iPhone', '<p>iPhone 12, iPhone 12 mini, iPhone 12 Pro, and iPhone 12 Pro Max&nbsp;work with the 5G cellular networks of certain carriers. Learn how to use 5G cellular service.</p>\r\n\r\n<h2>What you need</h2>\r\n\r\n<ul>\r\n	<li>An iPhone 12, iPhone 12 mini, iPhone 12 Pro, or iPhone 12 Pro Max</li>\r\n	<li><a href=\"https://support.apple.com/kb/HT204039\">A carrier that supports 5G</a></li>\r\n	<li>A 5G cellular plan1</li>\r\n</ul>\r\n\r\n<p>If your new iPhone comes with a SIM card, use that SIM card. If not, use the SIM card from your previous iPhone. In some cases, you need to contact your carrier to&nbsp;set up the SIM card from your previous iPhone for use with a 5G network.</p>\r\n\r\n<p><img alt=\"\" src=\"https://support.apple.com/library/content/dam/edam/applecare/images/en_US/mac_apps/itunes/divider.png\" /></p>\r\n\r\n<h2>Understand the 5G icons in the status bar</h2>\r\n\r\n<p>When you&#39;re in an area with 5G coverage for your carrier and your 5G cellular plan has been activated, you&#39;ll see a 5G icon in the status bar of&nbsp;your iPhone:&nbsp;</p>\r\n\r\n<p><img alt=\"5G: The 5G status-bar icon.\" src=\"https://support.apple.com/library/content/dam/edam/applecare/images/en_US/iphone/ios14-5g-icon-formatted.png\" style=\"width:85px\" /></p>\r\n\r\n<p>Your carrier&#39;s 5G network is available, and your iPhone can connect to the Internet over that network.2&nbsp;Not available in all areas.</p>\r\n\r\n<p><img alt=\"5G+: A higher-frequency 5G status-bar icon.\" src=\"https://support.apple.com/library/content/dam/edam/applecare/images/en_US/iphone/ios14-5g-plus-icon-formatted.png\" style=\"width:85px\" /></p>\r\n\r\n<p>Your carrier&rsquo;s higher frequency version of 5G is available,&nbsp;or your iPhone has&nbsp;an active connection over that network. Not available in all areas.2</p>\r\n\r\n<p><img alt=\"5G U/W: A higher-frequency 5G status-bar icon.\" src=\"https://support.apple.com/library/content/dam/edam/applecare/images/en_US/iphone/ios14-5g-uw-icon-formatted.png\" style=\"width:85px\" /></p>\r\n\r\n<p>Your carrier&rsquo;s higher frequency version of 5G is available, or&nbsp;your iPhone has&nbsp;an active connection over that network. Not available in all areas.2</p>\r\n\r\n<p><img alt=\"\" src=\"https://support.apple.com/library/content/dam/edam/applecare/images/en_US/il/spacer.png\" style=\"width:810px\" /></p>\r\n\r\n<p>Learn what to do&nbsp;<a href=\"https://support.apple.com/en-us/HT211828#no-5g\">if you don&#39;t see a 5G icon in the status bar</a>.</p>\r\n\r\n<p><img alt=\"\" src=\"https://support.apple.com/library/content/dam/edam/applecare/images/en_US/mac_apps/itunes/divider.png\" /></p>\r\n\r\n<h2>Learn about 5G options</h2>\r\n\r\n<p>The default settings for 5G on iPhone are optimized for battery life and data usage based on your data plan. You can customize these options for when to use 5G and how much data to use in some apps.</p>\r\n\r\n<p>Find these options by going to Settings &gt; Cellular &gt; Cellular Data Options. If you&#39;re using Dual SIM, go to Settings &gt; Cellular and choose the number whose options you want to change.</p>\r\n\r\n<p><img alt=\"\" src=\"https://support.apple.com/library/content/dam/edam/applecare/images/en_US/iphone/ios14-iphone12-pro-settings-cellular-cellular-data-options-voice-data.jpg\" style=\"width:350px\" /></p>\r\n\r\n<h3>Voice &amp; Data</h3>\r\n\r\n<p>Choose how your iPhone uses the 5G network, which can affect battery life.</p>\r\n\r\n<ul>\r\n	<li>5G Auto: Enables Smart Data mode. When 5G speeds don&rsquo;t provide a noticeably&nbsp;better experience, your iPhone&nbsp;automatically switches&nbsp;to LTE, saving battery life.</li>\r\n	<li>5G On:&nbsp;Always uses 5G network when it&rsquo;s available. This might&nbsp;reduce battery life.</li>\r\n	<li>LTE:&nbsp;Uses only LTE network, even when 5G is available.</li>\r\n</ul>\r\n\r\n<p><img alt=\"\" src=\"https://support.apple.com/library/content/dam/edam/applecare/images/en_US/il/spacer.png\" style=\"width:810px\" /></p>\r\n\r\n<p><br />\r\n<img alt=\"\" src=\"https://support.apple.com/library/content/dam/edam/applecare/images/en_US/iphone/ios14-iphone12-pro-settings-cellular-cellular-data-options-data-mode.jpg\" style=\"width:350px\" /></p>\r\n\r\n<h3>Data Mode</h3>\r\n\r\n<ul>\r\n	<li>Allow More Data on 5G: Enables higher data-usage features for apps and system tasks. These include higher-quality FaceTime, high-definition content on Apple TV, Apple Music songs and videos, and iOS updates over cellular. This setting also allows third-party apps to use more cellular data for enhanced experiences.&nbsp;This is the default setting with some unlimited-data plans, depending on your carrier. This setting uses more cellular data.</li>\r\n	<li>Standard: Allows automatic updates and background tasks on cellular, and uses standard quality settings for video and FaceTime. This is generally the default mode.</li>\r\n	<li>Low Data Mode: Helps reduce Wi-Fi and cellular-data usage by pausing automatic updates and background tasks.</li>\r\n</ul>\r\n\r\n<p>&nbsp;&nbsp;</p>\r\n\r\n<h3>Data Roaming</h3>\r\n\r\n<p>Carriers around the world are still working to deploy their 5G roaming support. If you turn on Data Roaming, you can get cellular data through 4G or LTE networks when you travel. You can also obtain a local SIM card or eSIM and use it as a single line with 5G where available.</p>\r\n\r\n<p><img alt=\"\" src=\"https://support.apple.com/library/content/dam/edam/applecare/images/en_US/mac_apps/itunes/divider.png\" /></p>\r\n\r\n<h2>If you don&#39;t see 5G in the status bar</h2>\r\n\r\n<ol>\r\n	<li>Make sure that you&rsquo;re in an area with 5G coverage. Contact your carrier if you&#39;re not sure.</li>\r\n	<li>Go to Settings &gt; Cellular &gt; Cellular Data&nbsp;Options. If you see this screen, your&nbsp;device has 5G activated. If you don&rsquo;t see this screen, contact your carrier to confirm that your plan supports 5G.<br />\r\n	<img alt=\"\" src=\"https://support.apple.com/library/content/dam/edam/applecare/images/en_US/iphone/ios14-iphone12-pro-settings-cellular-cellular-data-options.jpg\" style=\"width:350px\" /></li>\r\n	<li><a href=\"https://support.apple.com/kb/HT204234\">Turn on Airplane Mode</a>, then turn it off.</li>\r\n</ol>\r\n\r\n<p>If you still don&#39;t have 5G service, contact your carrier.</p>\r\n', '2021-03-23', 'assets/images/users/1616469057How-to-turn-off-5G-on-iPhone-12.jpg', 'assets/images/users/1616469057How-to-turn-off-5G-on-iPhone-12.jpg', 92),
(51, 'Use widgets on your iPhone and iPod touch', '<p>With widgets, you get timely information from your favorite apps at a glance.</p>\r\n\r\n<p>With iOS 14, you can use widgets on your Home Screen to keep your favorite information at your fingertips.&nbsp;Or you can use widgets from Today View by swiping right from the Home Screen or Lock Screen.</p>\r\n\r\n<p><img alt=\"iPhone showing Home Screen with widgets\" src=\"https://support.apple.com/library/content/dam/edam/applecare/images/en_US/iOS/ios14-iphone-11pro-widgets-home-screen.jpg\" style=\"width:320px\" /></p>\r\n\r\n<h2>Add widgets to your Home Screen</h2>\r\n\r\n<ol>\r\n	<li>From the Home Screen, touch and hold a widget or an empty area until the apps jiggle.</li>\r\n	<li>Tap the Add button&nbsp;<img alt=\"Gray add button\" src=\"https://support.apple.com/library/content/dam/edam/applecare/images/en_US/il/ios14-widgets-add-icon.png\" style=\"width:20px\" />&nbsp;in the upper-left corner.</li>\r\n	<li>Select a widget, choose from three widget sizes,&nbsp;then tap Add Widget.</li>\r\n	<li>Tap Done.</li>\r\n</ol>\r\n\r\n<p>You can also add widgets from Today View. From Today View, touch and hold a widget until the quick actions menu opens, then tap Edit Home Screen. Drag the widget to the right edge of the screen until it appears on the Home Screen, then tap Done.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"https://support.apple.com/library/content/dam/edam/applecare/images/en_US/mac_apps/itunes/divider.png\" /></p>\r\n\r\n<p><img alt=\"iPhone showing widgets in the Today View\" src=\"https://support.apple.com/library/content/dam/edam/applecare/images/en_US/iOS/ios14-iphone-11pro-widgets-today-view.jpg\" style=\"width:320px\" /></p>\r\n\r\n<h2>Add widgets to Today View</h2>\r\n\r\n<ol>\r\n	<li>Touch and hold a widget or an empty area in Today View until the apps jiggle.</li>\r\n	<li>Tap the Add button&nbsp;<img alt=\"gray plus icon\" src=\"https://support.apple.com/library/content/dam/edam/applecare/images/en_US/il/ios14-widgets-add-icon.png\" style=\"width:20px\" />&nbsp;in the upper-left corner.</li>\r\n	<li>Scroll down to select a widget, then choose from three widget sizes.</li>\r\n	<li>Tap Add Widget, then tap Done.</li>\r\n</ol>\r\n\r\n<p><img alt=\"\" src=\"https://support.apple.com/library/content/dam/edam/applecare/images/en_US/mac_apps/itunes/divider.png\" /></p>\r\n\r\n<p><img alt=\"iPhone showing how to edit a widget\" src=\"https://support.apple.com/library/content/dam/edam/applecare/images/en_US/iOS/ios14-iphone-11pro-widgets-edit.jpg\" style=\"width:320px\" /></p>\r\n\r\n<h2>Edit your widgets</h2>\r\n\r\n<p>With iOS 14, you can configure your widgets.&nbsp;For example, you can edit the Weather widget to see the forecast for your current location or a different location. Here&rsquo;s how:</p>\r\n\r\n<ol>\r\n	<li>Touch and hold a widget to open the quick actions menu.</li>\r\n	<li>Tap Edit Widget&nbsp;<img alt=\"Edit Widget icon\" src=\"https://support.apple.com/library/content/dam/edam/applecare/images/en_US/il/ios14-edit-widget-icon.png\" style=\"width:22px\" />.</li>\r\n	<li>Make your changes, then tap outside of the widget to exit.</li>\r\n</ol>\r\n\r\n<p>You can also move your widgets around to put your favorites where they&#39;re easier to find. Just touch and hold a widget until it jiggles, then move the widget around on the screen.</p>\r\n\r\n<p><img alt=\"\" src=\"https://support.apple.com/library/content/dam/edam/applecare/images/en_US/mac_apps/itunes/divider.png\" /></p>\r\n\r\n<h2>Use widget stacks</h2>\r\n\r\n<p>With iOS 14, you can use widget stacks to save space on your Home Screen and in Today View. You can use Smart Stacks or create your own widget stacks.</p>\r\n\r\n<h3>Create a Smart Stack</h3>\r\n\r\n<p>A Smart Stack is a pre-built collection of widgets that displays the right widget based on factors like your location, an activity, or time. A Smart Stack automatically rotates widgets to show the most relevant information throughout the day. Here&#39;s how to create a Smart Stack:</p>\r\n\r\n<ol>\r\n	<li>Touch and hold an area on your Home Screen or in Today View until the apps jiggle.&nbsp;</li>\r\n	<li>Tap the Add button&nbsp;<img alt=\"gray plus icon\" src=\"https://support.apple.com/library/content/dam/edam/applecare/images/en_US/il/ios14-widgets-add-icon.png\" style=\"width:20px\" />&nbsp;in the upper-left corner.</li>\r\n	<li>Scroll down and tap Smart Stack.</li>\r\n	<li>Tap Add Widget.</li>\r\n</ol>\r\n\r\n<p><img alt=\"iPhone showing widget stack\" src=\"https://support.apple.com/library/content/dam/edam/applecare/images/en_US/iOS/ios14-iphone-11pro-widgets-stack-animation.gif\" style=\"width:320px\" /></p>\r\n\r\n<h3>Create your own widget stacks</h3>\r\n\r\n<ol>\r\n	<li>Touch and hold an app or empty area on the Home Screen or Today View until the apps jiggle.</li>\r\n	<li>Drag a widget on top of another widget. You can stack up to 10 widgets.</li>\r\n	<li>Tap Done.</li>\r\n</ol>\r\n\r\n<h3>Edit a widget stack</h3>\r\n\r\n<ol>\r\n	<li>Touch and hold the widget stack.</li>\r\n	<li>Tap Edit Stack. From here, you can reorder the widgets in the stack by dragging the grid icon&nbsp;<img alt=\"three gray lines\" src=\"https://support.apple.com/library/content/dam/edam/applecare/images/en_US/il/ios14-widgets-rearrange-hamburger-icon.png\" style=\"width:22px\" />. You can also turn on Smart Rotate if you want iOS to show you relevant widgets throughout the day. Or swipe left over a widget to delete it.</li>\r\n	<li>Tap&nbsp;<img alt=\"gray x icon for remove\" src=\"https://support.apple.com/library/content/dam/edam/applecare/images/en_US/il/ios14-widgets-edit-stack-close-icon.png\" style=\"width:22px\" />&nbsp;when you&#39;re done.</li>\r\n</ol>\r\n\r\n<p>You need iOS 14 to use Smart Stacks or create your own widget stacks.</p>\r\n\r\n<p><img alt=\"\" src=\"https://support.apple.com/library/content/dam/edam/applecare/images/en_US/mac_apps/itunes/divider.png\" /></p>\r\n\r\n<h2>Remove widgets</h2>\r\n\r\n<ol>\r\n	<li>Touch and hold the widget that you want to remove.</li>\r\n	<li>Tap Remove Widget.</li>\r\n	<li>Tap Remove again to confirm.</li>\r\n</ol>\r\n', '2021-03-23', 'assets/images/users/1616469320iphone-widgets-ios14.jpg', 'assets/images/users/nova_1616469320iphone-widgets-ios14.jpg', 92),
(52, 'Camera features on your iPhone', '<p>You can use QuickTake to record videos without switching out of photo mode. QuickTake is available on iPhone XS, iPhone XR, and later.</p>\r\n\r\n<p>Hold the shutter to take a video</p>\r\n\r\n<p>When you open the Camera app, you see the default photo mode. Tap the Shutter button&nbsp;<img alt=\"\" src=\"https://support.apple.com/library/content/dam/edam/applecare/images/en_US/iOS/ios11-camera-shutter-icon.png\" style=\"width:22px\" />&nbsp;to take a photo. Then tap the arrow&nbsp;<img alt=\"\" src=\"https://support.apple.com/library/content/dam/edam/applecare/images/en_US/il/ios14-camera-viewfinder-menu-icon.png\" style=\"width:22px\" />&nbsp;to adjust options, like flash,&nbsp;<a href=\"https://support.apple.com/kb/HT207310\">Live Photos</a>, timer, and more.</p>\r\n\r\n<p>If you want to capture a QuickTake video, just press and hold the Shutter button&nbsp;<img alt=\"\" src=\"https://support.apple.com/library/content/dam/edam/applecare/images/en_US/iOS/ios11-camera-shutter-icon.png\" style=\"width:22px\" />.* Release the button to stop recording.</p>\r\n\r\n<p>With iOS 14, you can hold one of the Volume buttons to capture a QuickTake video. If you have&nbsp;Use Volume Up for Burst enabled, you can use the Volume down button to capture a QuickTake video.</p>\r\n\r\n<h3>Slide to the right to lock recording</h3>\r\n\r\n<p>To keep recording video without having to hold the button, slide the Shutter button&nbsp;<img alt=\"\" src=\"https://support.apple.com/library/content/dam/edam/applecare/images/en_US/iOS/ios11-camera-shutter-icon.png\" style=\"width:22px\" />&nbsp;to the right, then release it. When video recording is locked, a Shutter button appears to the right. Tap the Shutter button&nbsp;<img alt=\"\" src=\"https://support.apple.com/library/content/dam/edam/applecare/images/en_US/iOS/ios11-camera-shutter-icon.png\" style=\"width:22px\" />&nbsp;to take a still photo during video recording. When you&#39;re ready to stop recording, tap the record button.</p>\r\n\r\n<h3>Slide to the left for burst mode</h3>\r\n\r\n<p>Slide the Shutter button&nbsp;<img alt=\"\" src=\"https://support.apple.com/library/content/dam/edam/applecare/images/en_US/iOS/ios11-camera-shutter-icon.png\" style=\"width:22px\" />&nbsp;to the left and hold it to take a burst of photos, then release it to stop.</p>\r\n\r\n<p>With iOS 14, you can capture photos in burst mode by pressing the Volume up button. Just go to Settings &gt; Camera and turn on Use Volume Up for Burst.</p>\r\n\r\n<p>* To take videos with customizable resolution, stereo audio, and audio zoom, switch to Video mode.</p>\r\n\r\n<p><img alt=\"\" src=\"https://support.apple.com/library/content/dam/edam/applecare/images/en_US/mac_apps/itunes/divider.png\" /></p>\r\n\r\n<h2>See beyond the frame</h2>\r\n\r\n<p><img alt=\"\" src=\"https://support.apple.com/library/content/dam/edam/applecare/images/en_US/iOS/ios14-iphone11-pro-camera-capture-outside-frame.jpg\" style=\"width:640px\" /></p>\r\n\r\n<p>On iPhone models with the Ultra Wide (0.5x) lens, the Camera interface&nbsp;shows you what&#39;s happening outside of the shot that you&#39;re framing. This can help you decide if you need to reframe your shot or switch to a different camera lens on your iPhone for a better photo.</p>\r\n\r\n<p><img alt=\"\" src=\"https://support.apple.com/library/content/dam/edam/applecare/images/en_US/mac_apps/itunes/divider.png\" /></p>\r\n\r\n<h2>Automatically apply a tailored look to your photos</h2>\r\n\r\n<p>With Scene Detection, the camera intelligently detects what you&#39;re taking a photo of and applies a tailored look to bring out the best qualities in the scene. To turn this feature off, go to Settings &gt; Camera, and turn off Scene Detection.</p>\r\n\r\n<p>Scene Detection is available on iPhone 12, iPhone 12 mini, iPhone 12 Pro, and iPhone 12 Pro Max.</p>\r\n\r\n<p><img alt=\"\" src=\"https://support.apple.com/library/content/dam/edam/applecare/images/en_US/mac_apps/itunes/divider.png\" /></p>\r\n\r\n<h2>Adjust your focus and exposure</h2>\r\n\r\n<p>Before you take a photo, the camera automatically sets the focus and exposure, and face detection balances the exposure across many faces. With iOS 14, you can use Exposure Compensation Control to precisely set and lock the exposure for upcoming shots.</p>\r\n\r\n<p>Just tap the arrow&nbsp;<img alt=\"\" src=\"https://support.apple.com/library/content/dam/edam/applecare/images/en_US/il/ios14-camera-viewfinder-menu-icon.png\" style=\"width:22px\" />, then tap&nbsp;<img alt=\"\" src=\"https://support.apple.com/library/content/dam/edam/applecare/images/en_US/il/ios14-camera-exposure-icon.png\" style=\"width:22px\" />&nbsp;and adjust your exposure level. The exposure locks until the next time you open the Camera app.</p>\r\n\r\n<p>Exposure Compensation Control is available on iPhone 11, iPhone 11 Pro, and later.</p>\r\n\r\n<p><img alt=\"\" src=\"https://support.apple.com/library/content/dam/edam/applecare/images/en_US/mac_apps/itunes/divider.png\" /></p>\r\n\r\n<h2>Take a mirrored selfie</h2>\r\n\r\n<p>With iOS 14, you can take a mirrored selfie that captures the shot as you see it in the camera frame. To turn Mirror Front Camera on, go to Settings&nbsp;&gt; Camera, then turn on the setting.</p>\r\n\r\n<p>The Mirror Front Camera for photo and video is available on iPhone XS, iPhone XR, and later. If you have an iPhone 6s to iPhone X, the setting is called Mirror Front Photos and captures photos only.</p>\r\n\r\n<p><img alt=\"\" src=\"https://support.apple.com/library/content/dam/edam/applecare/images/en_US/mac_apps/itunes/divider.png\" /></p>\r\n\r\n<h2>Capture photos even faster</h2>\r\n\r\n<p>With iOS 14, you can use Prioritize Faster Shooting to&nbsp;modify how images are processed &mdash; allowing you to capture more photos when you rapidly tap the Shutter button&nbsp;<img alt=\"\" src=\"https://support.apple.com/library/content/dam/edam/applecare/images/en_US/iOS/ios11-camera-shutter-icon.png\" style=\"width:22px\" />. To turn this off, go to Settings &gt; Camera, and turn off Prioritize Faster Shooting.</p>\r\n\r\n<p>Prioritize Faster Shooting is available on iPhone XS, iPhone XR, and later.</p>\r\n\r\n<p><img alt=\"\" src=\"https://support.apple.com/library/content/dam/edam/applecare/images/en_US/mac_apps/itunes/divider.png\" /></p>\r\n\r\n<p><img alt=\"\" src=\"https://support.apple.com/library/content/dam/edam/applecare/images/en_US/iOS/ios14-iphone11-pro-camera-take-portrait-photo.jpg\" style=\"width:320px\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Take portraits to the next level</h2>\r\n\r\n<p>With&nbsp;<a href=\"https://support.apple.com/kb/HT208118\">Portrait mode</a>, the camera creates a depth-of-field effect, which lets you compose studio-quality photos that keep the subject of your photo sharp while blurring the background.</p>\r\n\r\n<p><img alt=\"\" src=\"https://support.apple.com/library/content/dam/edam/applecare/images/en_US/il/spacer.png\" style=\"width:810px\" /></p>\r\n\r\n<h2>Enhance your selfies and Ultra Wide photos</h2>\r\n\r\n<p>With Lens Correction,&nbsp;when you take a selfie with the front-facing camera or a photo with the Ultra Wide (0.5x) lens, it automatically enhances the photos to make them appear more natural. To turn this off, go to Settings &gt; Camera, and turn off Lens Correction.</p>\r\n\r\n<p>Lens Correction is available on&nbsp;iPhone 12, iPhone 12 mini, iPhone 12 Pro, and iPhone 12 Pro Max.</p>\r\n', '2021-03-23', 'assets/images/users/1616469510iphone-camera-settings.jpg', 'assets/images/users/1616469510iphone-camera-settings.jpg', 92),
(53, 'Use the Touch Bar on Mac', '<p>The Control Strip, located at the right end of the Touch Bar, lets you ask Siri or easily adjust common settings&mdash;just tap the buttons or, for settings like brightness and volume, quickly swipe left or right on the buttons. You can also expand the Control Strip to access more buttons.</p>\r\n\r\n<p><img alt=\"The collapsed Control Strip includes buttons—from left to right—to expand the Control Strip, increase or decrease display brightness and volume, mute or unmute, and ask Siri.\" src=\"https://help.apple.com/assets/5FCA9DF4094622AC2BC6F94E/5FCA9E00094622AC2BC6F96C/en_US/d68e940110db6695b9f7dd417ac8cc84.png\" style=\"height:161px; width:425px\" /></p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><em>Expand the Control Strip:&nbsp;</em>Tap&nbsp;<img alt=\"the Expand button\" src=\"https://help.apple.com/assets/5FCA9DF4094622AC2BC6F94E/5FCA9E00094622AC2BC6F96C/en_US/544b377953995df2315172f408e60719.png\" style=\"height:30px; width:16px\" />.</p>\r\n\r\n	<p>Depending on your Mac model and how you&nbsp;<a href=\"https://support.apple.com/sr-rs/guide/mac-help/customize-the-touch-bar-mchl5a63b060/11.0/mac/11.0\">customize the Touch Bar</a>, you can also press and hold the Fn key or the Globe key&nbsp;<img alt=\"\" src=\"https://help.apple.com/assets/5FCA9DF4094622AC2BC6F94E/5FCA9E00094622AC2BC6F96C/en_US/1faa76ae5882af1040a984bf04c1f6ce.png\" style=\"height:30px; width:30px\" />&nbsp;on the keyboard to expand the Control Strip.</p>\r\n	</li>\r\n	<li>\r\n	<p><em>Use Control Strip buttons:&nbsp;</em>Tap the buttons to adjust settings or control video or music playback. For some settings&mdash;such as display brightness&mdash;you can touch and hold the button to change the setting.</p>\r\n	<img alt=\"Buttons in the expanded Control Strip include—from left to right—display brightness, Mission Control, Launchpad, keyboard brightness, video or music playback, and volume.\" src=\"https://help.apple.com/assets/5FCA9DF4094622AC2BC6F94E/5FCA9E00094622AC2BC6F96C/en_US/55f0990daca25f7bbf3d8cf7ff26d385.png\" style=\"height:113px; width:466px\" /></li>\r\n	<li>\r\n	<p><em>Collapse the Control Strip:&nbsp;</em>Tap&nbsp;<img alt=\"the Close button\" src=\"https://help.apple.com/assets/5FCA9DF4094622AC2BC6F94E/5FCA9E00094622AC2BC6F96C/en_US/9954900d78ed991e29314d254428531d.png\" style=\"height:30px; width:30px\" />.</p>\r\n	</li>\r\n</ul>\r\n\r\n<h2>App buttons</h2>\r\n\r\n<p>Other buttons in the Touch Bar vary depending on the app you&rsquo;re using or the task you&rsquo;re doing. Each app is different&mdash;try out the Touch Bar to see what you can do.</p>\r\n\r\n<p>For example, here are the buttons available to tap in the Touch Bar when you select a file in the&nbsp;<a href=\"https://support.apple.com/sr-rs/guide/mac-help/aside/glos00063759/11.0/mac/11.0\">Finder</a>:</p>\r\n\r\n<p><img alt=\"The Touch Bar with buttons specific to the Finder, such as the Tag button.\" src=\"https://help.apple.com/assets/5FCA9DF4094622AC2BC6F94E/5FCA9E00094622AC2BC6F96C/en_US/2e1aa1c85ff3c7d2a7ce8fd0199373de.png\" style=\"height:22px; width:443px\" /></p>\r\n\r\n<p>And here are the buttons when you view a picture in the Photos app:</p>\r\n\r\n<p><img alt=\"The Touch Bar with buttons specific to Photos, such as the Favorites and Rotate buttons.\" src=\"https://help.apple.com/assets/5FCA9DF4094622AC2BC6F94E/5FCA9E00094622AC2BC6F96C/en_US/0cd106f9b80767bb1435cc084c8e5e1f.png\" style=\"height:26px; width:355px\" /></p>\r\n\r\n<p>You can use the Touch Bar to quickly add emoji to your text in some apps. Just tap&nbsp;</p>\r\n\r\n<p><img alt=\"the Emoji button\" src=\"https://help.apple.com/assets/5FCA9DF4094622AC2BC6F94E/5FCA9E00094622AC2BC6F96C/en_US/097d0ca78d6569864ac0103d76be7275.png\" style=\"height:30px; width:30px\" />,&nbsp;swipe to scroll through the emoji (organized by category, such as Frequently Used or Smileys &amp; People), then tap the one you want to use.</p>\r\n\r\n<p><strong>Tip:&nbsp;</strong>In some apps, you can&nbsp;<a href=\"https://support.apple.com/sr-rs/guide/mac-help/customize-the-touch-bar-mchl5a63b060/11.0/mac/11.0\">customize the Touch Bar</a>&nbsp;to add buttons for the tasks you do most often.</p>\r\n\r\n<h2>Typing suggestions</h2>\r\n\r\n<p>When you&rsquo;re typing text on your Mac, the Touch Bar can show words or phrases you might want to use next (called&nbsp;<em>typing suggestions</em>), to help you save time.</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><em>Show typing suggestions:&nbsp;</em>Tap&nbsp;<img alt=\"the Typing Suggestions button\" src=\"https://help.apple.com/assets/5FCA9DF4094622AC2BC6F94E/5FCA9E00094622AC2BC6F96C/en_US/b239eff78b1f0fb54734fa93c6d24c0d.png\" style=\"height:30px; width:53px\" />.</p>\r\n	<img alt=\"The Typing suggestions button in the Touch Bar.\" src=\"https://help.apple.com/assets/5FCA9DF4094622AC2BC6F94E/5FCA9E00094622AC2BC6F96C/en_US/12fd2e04114806096c50166adc3d8983.png\" style=\"height:55px; width:467px\" /></li>\r\n	<li>\r\n	<p><em>Use typing suggestions:&nbsp;</em>Tap a word, phrase, or emoji. Spelling corrections are shown in blue.</p>\r\n	<img alt=\"Typing suggestions showing words and emojis, and the button on the left to hide typing suggestions.\" src=\"https://help.apple.com/assets/5FCA9DF4094622AC2BC6F94E/5FCA9E00094622AC2BC6F96C/en_US/41033b0ecac0a3ea59f65cad9b769d2c.png\" style=\"height:69px; width:466px\" /></li>\r\n	<li>\r\n	<p><em>Hide typing suggestions:&nbsp;</em>Tap&nbsp;<img alt=\"the Close button\" src=\"https://help.apple.com/assets/5FCA9DF4094622AC2BC6F94E/5FCA9E00094622AC2BC6F96C/en_US/62ae8c7c3e83fe2aae2d078ce2ca1c5b.png\" style=\"height:30px; width:16px\" />&nbsp;in the Touch Bar.</p>\r\n	</li>\r\n</ul>\r\n\r\n<p>If you don&rsquo;t see&nbsp;<img alt=\"the Typing Suggestions button\" src=\"https://help.apple.com/assets/5FCA9DF4094622AC2BC6F94E/5FCA9E00094622AC2BC6F96C/en_US/b239eff78b1f0fb54734fa93c6d24c0d.png\" style=\"height:30px; width:53px\" />&nbsp;in the Touch Bar, choose View &gt; Customize Touch Bar, then select &ldquo;Show typing suggestions.&rdquo; Or choose Apple menu&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"https://help.apple.com/assets/5FCA9DF4094622AC2BC6F94E/5FCA9E00094622AC2BC6F96C/en_US/2f77cc85238452e25cb517130188bf99.png\" style=\"height:30px; width:24px\" />&nbsp;&gt; System Preferences, click Keyboard, click Text, then select &ldquo;Touch Bar typing suggestions.&rdquo;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>While typing, you can display a list of suggested words onscreen by pressing F5 (you may need to also press the Fn key, depending on your Mac model).</p>\r\n\r\n<h2>Colors</h2>\r\n\r\n<p>In apps where you can change the color of text or objects, you can use the Touch Bar to select a color, shade, or mode (such as RGB or HSB).</p>\r\n\r\n<p><img alt=\"The Touch Bar showing the Colors button among app-specific buttons.\" src=\"https://help.apple.com/assets/5FCA9DF4094622AC2BC6F94E/5FCA9E00094622AC2BC6F96C/en_US/4210af5c3a7142953dbce5c77fffb7e8.png\" style=\"height:53px; width:463px\" /></p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><em>Select a color:&nbsp;</em>Touch and hold&nbsp;<img alt=\"the Colors button\" src=\"https://help.apple.com/assets/5FCA9DF4094622AC2BC6F94E/5FCA9E00094622AC2BC6F96C/en_US/b42ee6cb02be2a7ac25b7f352e9352b5.png\" style=\"height:30px; width:27px\" />,&nbsp;then slide your finger to a color.</p>\r\n\r\n	<p><img alt=\"The Touch Bar showing choices from no color on the left to black on the right.\" src=\"https://help.apple.com/assets/5FCA9DF4094622AC2BC6F94E/5FCA9E00094622AC2BC6F96C/en_US/69e370e381d297472008025524627cfb.png\" style=\"height:14px; width:466px\" /></p>\r\n	</li>\r\n	<li>\r\n	<p><em>Select a shade:&nbsp;</em>Tap&nbsp;<img alt=\"the Colors button\" src=\"https://help.apple.com/assets/5FCA9DF4094622AC2BC6F94E/5FCA9E00094622AC2BC6F96C/en_US/b42ee6cb02be2a7ac25b7f352e9352b5.png\" style=\"height:30px; width:27px\" />,&nbsp;touch and hold a color, then slide your finger to a shade.</p>\r\n	</li>\r\n	<li>\r\n	<p><em>Select a mode or custom color:&nbsp;</em>Tap&nbsp;<img alt=\"the Colors button\" src=\"https://help.apple.com/assets/5FCA9DF4094622AC2BC6F94E/5FCA9E00094622AC2BC6F96C/en_US/b42ee6cb02be2a7ac25b7f352e9352b5.png\" style=\"height:30px; width:27px\" />,&nbsp;tap the color list on the left, then tap a color mode, such as RGB. To use a custom color you saved, tap Swatches.</p>\r\n\r\n	<p><img alt=\"The Touch Bar showing color modes—from left to right—Simple, Grayscale, RGB, CMYK, and HSB. At the right end is the Swatches button.\" src=\"https://help.apple.com/assets/5FCA9DF4094622AC2BC6F94E/5FCA9E00094622AC2BC6F96C/en_US/ce2512ad4e89afd216192b64b9173a4b.png\" style=\"height:18px; width:444px\" /></p>\r\n\r\n	<p>Use the sliders for a mode to change values, such as hue or saturation. To save your changes to Swatches, tap the color (a + appears), then tap it again (a checkmark appears).</p>\r\n	<img alt=\"The Touch Bar showing hue, saturation, and brightness sliders for the HSB mode. At the left end is the button to show all modes; at the right, the button to save a custom color.\" src=\"https://help.apple.com/assets/5FCA9DF4094622AC2BC6F94E/5FCA9E00094622AC2BC6F96C/en_US/d84c4d899d89a8aa2d5ed8141595e92e.png\" style=\"height:121px; width:466px\" /></li>\r\n	<li>\r\n	<p><em>Hide colors or the color values:&nbsp;</em>Tap&nbsp;<img alt=\"the Close button\" src=\"https://help.apple.com/assets/5FCA9DF4094622AC2BC6F94E/5FCA9E00094622AC2BC6F96C/en_US/9954900d78ed991e29314d254428531d.png\" style=\"height:30px; width:30px\" />&nbsp;in the Touch Bar.</p>\r\n	</li>\r\n</ul>\r\n', '2021-03-23', 'assets/images/users/1616469719samplr-for-touchbar.jpg', 'assets/images/users/nova_1616469719samplr-for-touchbar.jpg', 92);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `idNewsletter` int(255) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`idNewsletter`, `title`, `code`, `date`) VALUES
(2, 'Newsletter', 'newsletter', '2021-01-12 03:45:57');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_client`
--

CREATE TABLE `newsletter_client` (
  `idNewsletterClient` int(255) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `newsletter_client`
--

INSERT INTO `newsletter_client` (`idNewsletterClient`, `email`, `date`) VALUES
(9, 'markoczv314@gmail.com', '2020-12-14 00:30:15'),
(10, 'markomilivojevic1998@gmail.com', '2020-12-14 00:30:31'),
(16, 'markoczv314@gmail.com', '2021-01-13 00:00:00'),
(17, 'markoczv314@gmail.com', '2021-01-13 00:00:00'),
(18, 'markoczv314@gmail.com', '2021-01-13 00:00:00'),
(19, 'markoczv314@gmail.com', '2021-01-13 00:00:00'),
(20, 'markoczv314@gmail.com', '2021-01-13 00:00:00'),
(21, 'markoczv314@gmail.com', '2021-01-13 00:00:00'),
(22, 'markoczv314@gmail.com', '2021-01-13 00:00:00'),
(23, 'markoczv314@gmail.com', '2021-01-13 00:00:00'),
(24, 'markoczv314@gmail.com', '2021-01-13 00:00:00'),
(25, 'markoczv314@gmail.com', '2021-01-13 00:00:00'),
(26, 'markoczv314@gmail.com', '2021-01-13 00:00:00'),
(27, 'markoczv314@gmail.com', '2021-01-13 00:00:00'),
(28, 'markoczv314@gmail.com', '2021-01-13 00:00:00'),
(29, 'markoczv314@gmail.com', '2021-01-31 00:00:00'),
(30, 'markoczv314@gmail.com', '2021-01-20 00:00:00'),
(31, 'markoczv314@gmail.com', '2021-01-22 00:00:00'),
(32, 'markoczv314@gmail.com', '2021-01-29 00:00:00'),
(33, 'markoczv314@gmail.com', '2021-01-19 00:00:00'),
(34, 'markoczv314@gmail.com', '2021-01-21 00:00:00'),
(35, 'markoczv314@gmail.com', '2021-01-27 00:00:00'),
(36, 'markoczv314@gmail.com', '2021-01-21 00:00:00'),
(37, 'markoczv314@gmail.com', '2021-01-20 00:00:00'),
(38, 'markoczv314@gmail.com', '2021-01-27 00:00:00'),
(39, 'markoczv314@gmail.com', '2021-01-31 00:00:00'),
(40, 'markoczv314@gmail.com', '2021-01-20 00:00:00'),
(41, 'markoczv314@gmail.com', '2021-01-22 00:00:00'),
(42, 'markoczv314@gmail.com', '2021-01-29 00:00:00'),
(43, 'markoczv314@gmail.com', '2021-01-19 00:00:00'),
(44, 'markoczv314@gmail.com', '2021-01-21 00:00:00'),
(45, 'markoczv314@gmail.com', '2021-01-27 00:00:00'),
(46, 'markoczv314@gmail.com', '2021-01-21 00:00:00'),
(47, 'markoczv314@gmail.com', '2021-01-20 00:00:00'),
(48, 'markoczv314@gmail.com', '2021-01-27 00:00:00'),
(49, 'markoczv314@gmail.com', '2021-01-27 00:00:00'),
(50, 'markoczv314@gmail.com', '2021-01-27 00:00:00'),
(51, 'markoczv314@gmail.com', '2021-01-27 00:00:00'),
(52, 'markoczv314@gmail.com', '2021-01-27 00:00:00'),
(53, 'markoczv314@gmail.com', '2021-01-27 00:00:00'),
(54, 'markoczv314@gmail.com', '2021-01-27 00:00:00'),
(55, 'markoczv314@gmail.com', '2021-01-27 00:00:00'),
(56, 'markoczv314@gmail.com', '2021-01-27 00:00:00'),
(57, 'markoczv314@gmail.com', '2021-01-27 00:00:00'),
(58, 'markoczv314@gmail.com', '2021-01-27 00:00:00'),
(59, 'markoczv314@gmail.com', '2021-01-27 00:00:00'),
(60, 'markoczv314@gmail.com', '2021-01-27 00:00:00'),
(61, 'markoczv314@gmail.com', '2021-01-27 00:00:00'),
(62, 'markoczv314@gmail.com', '2021-01-27 00:00:00'),
(63, 'markoczv314@gmail.com', '2021-01-27 00:00:00'),
(64, 'markoczv314@gmail.com', '2021-01-27 00:00:00'),
(65, 'markoczv314@gmail.com', '2021-01-27 00:00:00'),
(66, 'markoczv314@gmail.com', '2021-01-27 00:00:00'),
(67, 'markoczv314@gmail.com', '2021-01-27 00:00:00'),
(68, 'markoczv314@gmail.com', '2021-01-27 00:00:00'),
(69, 'markoczv314@gmail.com', '2021-01-27 00:00:00'),
(70, 'markoczv314@gmail.com', '2021-01-27 00:00:00'),
(71, 'test@gmail.com', '2021-03-13 17:44:09'),
(73, 'korisnikkk@gmail.com', '2021-03-22 21:49:26');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `idOrders` int(255) NOT NULL,
  `idUser` int(255) NOT NULL,
  `date` int(11) NOT NULL,
  `idOrderStatus` int(11) NOT NULL,
  `idOrderPaymentMethod` int(255) NOT NULL,
  `total` int(255) NOT NULL,
  `dateOrders` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`idOrders`, `idUser`, `date`, `idOrderStatus`, `idOrderPaymentMethod`, `total`, `dateOrders`) VALUES
(222, 1, 1612055388, 1, 1, 14252, '2021-01-31 02:09:48'),
(253, 109, 1616510235, 1, 2, 2399, '2021-03-23 15:37:15'),
(254, 109, 1616510270, 1, 1, 1200, '2021-03-23 15:37:50'),
(255, 109, 1616510312, 3, 2, 1615, '2021-03-23 15:38:32'),
(256, 108, 1616510401, 1, 1, 570, '2021-03-23 15:40:01'),
(257, 108, 1616510519, 1, 2, 598, '2021-03-23 15:41:59'),
(258, 105, 1616510634, 2, 1, 9407, '2021-03-23 15:43:54'),
(259, 105, 1616538149, 1, 1, 600, '2021-03-23 23:22:29'),
(260, 92, 1616975682, 1, 2, 570, '2021-03-29 01:54:42');

-- --------------------------------------------------------

--
-- Table structure for table `orders_products`
--

CREATE TABLE `orders_products` (
  `id` int(255) NOT NULL,
  `idOrders` int(255) NOT NULL,
  `idProduct` int(255) NOT NULL,
  `quantity` mediumint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders_products`
--

INSERT INTO `orders_products` (`id`, `idOrders`, `idProduct`, `quantity`) VALUES
(365, 253, 203, 1),
(366, 253, 210, 1),
(367, 253, 231, 1),
(368, 253, 218, 1),
(369, 254, 200, 2),
(370, 255, 216, 1),
(371, 256, 203, 1),
(372, 257, 232, 2),
(373, 258, 205, 1),
(374, 258, 202, 2),
(375, 258, 211, 2),
(376, 258, 224, 2),
(377, 258, 230, 1),
(378, 258, 222, 1),
(379, 259, 202, 1),
(380, 260, 203, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_payment_method`
--

CREATE TABLE `order_payment_method` (
  `idOrderPaymentMethod` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_payment_method`
--

INSERT INTO `order_payment_method` (`idOrderPaymentMethod`, `name`) VALUES
(1, 'Payment card'),
(2, 'Pay on Delivery');

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `idOrderStatus` int(11) NOT NULL,
  `name` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`idOrderStatus`, `name`) VALUES
(1, 'Processing in progress'),
(2, 'Delivered'),
(3, 'Canceled');

-- --------------------------------------------------------

--
-- Table structure for table `poll`
--

CREATE TABLE `poll` (
  `idPoll` int(255) NOT NULL,
  `question` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `poll`
--

INSERT INTO `poll` (`idPoll`, `question`, `date`, `status`) VALUES
(71, 'Which is the best phone?', '2021-03-22 23:33:26', 1),
(72, 'Which is the No 1 IT company in world?', '2021-03-22 23:38:37', 0);

-- --------------------------------------------------------

--
-- Table structure for table `poll_answer`
--

CREATE TABLE `poll_answer` (
  `idPollAnswer` int(255) NOT NULL,
  `answer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `idPoll` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `poll_answer`
--

INSERT INTO `poll_answer` (`idPollAnswer`, `answer`, `idPoll`) VALUES
(549, 'Apple iPhone 12', 71),
(550, 'Samsung S20', 71),
(551, 'OnePlus 8 PRO', 71),
(552, 'Xiaomi MI 10', 71),
(553, 'Vivo X50 PRO', 71),
(554, 'Apple', 72),
(555, 'Samsung', 72),
(556, 'Huawei', 72);

-- --------------------------------------------------------

--
-- Table structure for table `poll_user_answer`
--

CREATE TABLE `poll_user_answer` (
  `idPollUserAnswer` int(255) NOT NULL,
  `ipAddress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `idPollAnswer` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `poll_user_answer`
--

INSERT INTO `poll_user_answer` (`idPollUserAnswer`, `ipAddress`, `date`, `idPollAnswer`) VALUES
(49, '::11', '2021-03-23 15:36:52', 549),
(50, '::1gg', '2021-03-23 15:41:00', 550),
(51, '::1r', '2021-03-23 15:41:13', 552),
(52, '::1rdg', '2021-03-23 15:41:26', 549);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `idProduct` int(255) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `oldPrice` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `newPrice` int(255) DEFAULT NULL,
  `Quantity` int(255) NOT NULL,
  `idCategory` int(255) NOT NULL,
  `idUser` int(255) NOT NULL,
  `idHomeProduct` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`idProduct`, `name`, `description`, `oldPrice`, `newPrice`, `Quantity`, `idCategory`, `idUser`, `idHomeProduct`) VALUES
(190, 'iPhone 12 Pro', 'iPhone 12 Pro, 128GB, Silver', '1000', 1000, 1000, 1, 92, 1),
(191, 'iPhone 12 Pro', 'iPhone 12 Pro, 128GB, Pacific blue', '1000', 1000, 1000, 1, 92, 1),
(192, 'iPhone 12 Pro', 'iPhone 12 Pro, 128GB, Gold', '1000', 800, 1000, 1, 92, 1),
(196, 'iPhone 12', 'iPhone 12 Pro Max, 128GB, Product Red', '900', 900, 1000, 1, 92, 1),
(197, 'iPhone 12', 'iPhone 12 Pro Max, 128GB, Black', '900', 900, 1000, 1, 92, 1),
(198, 'iPhone 12', 'iPhone 12 Pro Max, 128GB, White', '900', 810, 1000, 1, 92, 1),
(199, 'iPhone 12 Pro Max', 'iPhone 12 Pro Max, 128GB, Green', '1200', 720, 1000, 1, 92, 2),
(200, 'iPhone 12 Pro Max', 'iPhone 12 Pro Max, 128GB, Silver', '1200', 600, 998, 1, 92, 2),
(201, 'iPhone 12 Pro Max', 'iPhone 12 Pro Max, 128GB, Graphite', '1200', 840, 1000, 1, 92, 1),
(202, 'iPhone 12 Mini', 'iPhone 12 Pro Max, 128GB, Black', '600', 600, 997, 1, 92, 1),
(203, 'iPhone 12 Mini', 'iPhone 12 Pro Max, 128GB, White', '600', 570, 997, 1, 92, 2),
(204, 'iPhone 12 Mini', 'iPhone 12 Pro Max, 128GB, Red', '600', 600, 1000, 1, 92, 2),
(205, 'iPhone 12 Mini', 'iPhone 12 Pro Max, 128GB, Green', '600', 570, 999, 1, 92, 1),
(206, 'iPad Pro', 'iPad Pro, 128GB, Space Gray', '1000', 1000, 1000, 2, 92, 2),
(207, 'iPad Pro', 'iPad Pro, 128GB, Silver', '1000', 1000, 1000, 2, 92, 1),
(208, 'iPad Air', 'iPad Air, 128GB, Sky Blue', '900', 810, 1000, 2, 92, 1),
(209, 'iPad Air', 'iPad Air, 128GB, Green', '900', 900, 1000, 2, 92, 1),
(210, 'iPad Air', 'iPad Air, 128GB, Silver', '900', 450, 999, 2, 92, 2),
(211, 'iPad', 'iPad, 128GB, Rose', '769', 769, 998, 2, 92, 1),
(212, 'iPad', 'iPad, 128GB, Space Gray', '769', 769, 1000, 2, 92, 1),
(213, 'iPad', 'iPad, 128GB, Silver', '769', 692, 1000, 2, 92, 1),
(214, 'iPad Air', 'iPad Air, 128GB, Space Gray', '900', 900, 1000, 2, 92, 1),
(215, 'iPad Air', 'iPad Air, 128GB, Rose Gold', '900', 720, 1000, 2, 92, 1),
(216, 'MacBook Pro 13', 'MacBook Pro 13', '1700', 1615, 999, 4, 92, 1),
(217, 'MacBook Pro 13', 'MacBook Pro 13', '1700', 1700, 1000, 4, 92, 2),
(218, 'MacBook Air M1 ', 'MacBook Air M1 256GB Space Gray', '1200', 1200, 999, 4, 92, 1),
(219, 'MacBook Air 13', 'MacBook Air 13', '800', 800, 1000, 4, 92, 1),
(220, 'MacBook Pro 16', 'MacBook Pro 16', '4000', 3200, 1000, 4, 92, 2),
(221, 'MacBook Pro 13', 'MacBook Pro 13', '3000', 3000, 1000, 4, 92, 2),
(222, 'MacBook Pro 16', 'MacBook Pro 16', '4999', 4999, 999, 4, 92, 1),
(223, 'Apple Watch', 'Graphite Stainless Steel Case with Milanese Loop', '400', 400, 1000, 3, 92, 1),
(224, 'Apple Watct', 'Space Gray Aluminum Case with Braided Solo Loop', '350', 350, 998, 3, 92, 2),
(225, 'Apple Watch', 'Silver Aluminum Case with Solo Loop', '300', 300, 1000, 3, 92, 1),
(226, 'Apple Watch', 'Gold Aluminum Case with Solo Loop', '300', 300, 1000, 3, 92, 2),
(227, 'Apple Watch', 'Silver Stainless Steel Case with Modern Buckle', '500', 500, 1000, 3, 92, 1),
(228, 'Apple Watch', 'Silver Stainless Steel Case with Leather Link', '600', 600, 1000, 3, 92, 1),
(229, 'Apple Watch', 'Space Gray Aluminum Case with Sport Loop', '399', 399, 1000, 3, 92, 1),
(230, 'Apple Watch', 'Gold Stainless Steel Case with Leather Loop', '800', 400, 999, 3, 92, 1),
(231, 'Apple Watch', 'Silver Aluminum Case with Solo Loop', '299', 179, 999, 3, 92, 2),
(232, 'Apple Watch', 'Space Gray Aluminum Case with Solo Loop', '299', 299, 998, 3, 92, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rating_product`
--

CREATE TABLE `rating_product` (
  `idRatingProduct` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL,
  `rating` smallint(6) NOT NULL,
  `ipAddress` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rating_product`
--

INSERT INTO `rating_product` (`idRatingProduct`, `idProduct`, `rating`, `ipAddress`) VALUES
(51, 203, 5, '::1'),
(52, 210, 5, '::1'),
(53, 218, 3, '::1'),
(54, 216, 4, '::1'),
(55, 217, 5, '::1'),
(56, 200, 5, '::1'),
(57, 211, 2, '::1'),
(58, 214, 4, '::1'),
(59, 224, 5, '::1'),
(60, 230, 1, '::1'),
(61, 222, 5, '::1'),
(62, 202, 4, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `idRole` int(255) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`idRole`, `name`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Moderator'),
(4, 'Developer');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `idUser` int(255) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip` int(5) NOT NULL,
  `token` int(255) NOT NULL,
  `idRole` int(255) NOT NULL,
  `idCountry` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`idUser`, `name`, `lastName`, `email`, `password`, `address`, `city`, `zip`, `token`, `idRole`, `idCountry`) VALUES
(1, 'Marko', 'Milivojevic', 'marko.milivojevic.167.17@ict.edu.rs', '4fb6f7fdae2dbc006a1d90cd0405bcc9', 'Rudnicka 14', 'Smederevska Palanka ', 11420, 1616388312, 1, 1),
(92, 'Developer', 'Developer', 'Developer@gmail.com', '11cbbddfe9e21c94d508745d82d7ec7d', 'Developer 123', 'Developer', 11111, 0, 4, 1),
(105, 'User', 'User', 'user@gmail.com', '36fdba5968850579c0a89444f4ca4772', 'Adresa 1', 'Smederevska Palanka', 11420, 0, 2, 2),
(106, 'Moderator', 'Moderator', 'moderator@gmail.com', 'acff8fbda74131fd13d720433a8cb22a', 'Adresa 12', 'Smederevska Palanka', 11420, 0, 3, 3),
(107, 'Admin', 'Admin', 'admin@gmail.com', 'a43c27c2babefd68df8a694900f30a1c', 'Adresa 123', 'Smederevska Palanka', 11420, 0, 1, 1),
(108, 'Milos', 'Milosevic', 'milos@gmail.com', '20f6b3d2156ea1bcda81f7d7fa866e57', 'Alekse Dundica 12', 'Beograd', 11000, 0, 2, 1),
(109, 'Marko', 'Urosevic', 'markourosevic@gmail.com', 'f7741f81f9edb5fb4880bf093e66f8b5', 'Alekse Dundica 14', 'Smederevo', 11000, 0, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_comment_replies`
--

CREATE TABLE `users_comment_replies` (
  `idU_c_r` int(255) NOT NULL,
  `idUser` int(255) NOT NULL,
  `idReplies` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users_comment_replies`
--

INSERT INTO `users_comment_replies` (`idU_c_r`, `idUser`, `idReplies`) VALUES
(62, 1, 77),
(63, 1, 78),
(64, 1, 79),
(65, 1, 80),
(66, 1, 81);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`idAuthor`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`idCategory`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`idComment`),
  ADD KEY `idKorisnici` (`idUser`,`idProduct`),
  ADD KEY `comments_ibfk_1` (`idProduct`);

--
-- Indexes for table `comment_replies`
--
ALTER TABLE `comment_replies`
  ADD PRIMARY KEY (`idReplies`),
  ADD KEY `idComment` (`idComment`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`idContact`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`idCountry`),
  ADD KEY `idContry` (`idCountry`);

--
-- Indexes for table `home_product`
--
ALTER TABLE `home_product`
  ADD PRIMARY KEY (`idHomeProduct`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`idImages`),
  ADD KEY `idProducts` (`idProduct`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`idMenu`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`idNews`),
  ADD UNIQUE KEY `idUsers` (`idNews`),
  ADD KEY `idUsers_2` (`idUser`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`idNewsletter`);

--
-- Indexes for table `newsletter_client`
--
ALTER TABLE `newsletter_client`
  ADD PRIMARY KEY (`idNewsletterClient`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`idOrders`),
  ADD KEY `idKorisnici` (`idUser`),
  ADD KEY `idOrderStatus` (`idOrderStatus`),
  ADD KEY `idorderPaymentMethod` (`idOrderPaymentMethod`);

--
-- Indexes for table `orders_products`
--
ALTER TABLE `orders_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idOrders` (`idOrders`,`idProduct`),
  ADD KEY `orders_products_ibfk_2` (`idProduct`);

--
-- Indexes for table `order_payment_method`
--
ALTER TABLE `order_payment_method`
  ADD PRIMARY KEY (`idOrderPaymentMethod`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`idOrderStatus`);

--
-- Indexes for table `poll`
--
ALTER TABLE `poll`
  ADD PRIMARY KEY (`idPoll`);

--
-- Indexes for table `poll_answer`
--
ALTER TABLE `poll_answer`
  ADD PRIMARY KEY (`idPollAnswer`),
  ADD KEY `idPoll` (`idPoll`);

--
-- Indexes for table `poll_user_answer`
--
ALTER TABLE `poll_user_answer`
  ADD PRIMARY KEY (`idPollUserAnswer`),
  ADD KEY `idPollAnswer` (`idPollAnswer`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`idProduct`),
  ADD KEY `idKategorije` (`idCategory`),
  ADD KEY `idKorisnici` (`idUser`),
  ADD KEY `idIstaknuti` (`idHomeProduct`);

--
-- Indexes for table `rating_product`
--
ALTER TABLE `rating_product`
  ADD PRIMARY KEY (`idRatingProduct`),
  ADD KEY `idProducts` (`idProduct`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`idRole`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`),
  ADD KEY `idUloge` (`idRole`),
  ADD KEY `idContry` (`idCountry`);

--
-- Indexes for table `users_comment_replies`
--
ALTER TABLE `users_comment_replies`
  ADD PRIMARY KEY (`idU_c_r`),
  ADD KEY `idKorisnici` (`idUser`,`idReplies`),
  ADD KEY `users_comment_replies_ibfk_1` (`idReplies`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `idAuthor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `idCategory` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `idComment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `comment_replies`
--
ALTER TABLE `comment_replies`
  MODIFY `idReplies` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `idContact` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `idCountry` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `home_product`
--
ALTER TABLE `home_product`
  MODIFY `idHomeProduct` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `idImages` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=474;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `idMenu` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `idNews` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `idNewsletter` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `newsletter_client`
--
ALTER TABLE `newsletter_client`
  MODIFY `idNewsletterClient` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `idOrders` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=261;

--
-- AUTO_INCREMENT for table `orders_products`
--
ALTER TABLE `orders_products`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=381;

--
-- AUTO_INCREMENT for table `order_payment_method`
--
ALTER TABLE `order_payment_method`
  MODIFY `idOrderPaymentMethod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `idOrderStatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `poll`
--
ALTER TABLE `poll`
  MODIFY `idPoll` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `poll_answer`
--
ALTER TABLE `poll_answer`
  MODIFY `idPollAnswer` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=557;

--
-- AUTO_INCREMENT for table `poll_user_answer`
--
ALTER TABLE `poll_user_answer`
  MODIFY `idPollUserAnswer` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `idProduct` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=233;

--
-- AUTO_INCREMENT for table `rating_product`
--
ALTER TABLE `rating_product`
  MODIFY `idRatingProduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `idRole` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `users_comment_replies`
--
ALTER TABLE `users_comment_replies`
  MODIFY `idU_c_r` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`idProduct`) REFERENCES `product` (`idProduct`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE CASCADE;

--
-- Constraints for table `comment_replies`
--
ALTER TABLE `comment_replies`
  ADD CONSTRAINT `comment_replies_ibfk_1` FOREIGN KEY (`idComment`) REFERENCES `comments` (`idComment`) ON DELETE CASCADE;

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`idProduct`) REFERENCES `product` (`idProduct`) ON DELETE CASCADE;

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`idOrderStatus`) REFERENCES `order_status` (`idOrderStatus`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`idOrderPaymentMethod`) REFERENCES `order_payment_method` (`idorderPaymentMethod`);

--
-- Constraints for table `orders_products`
--
ALTER TABLE `orders_products`
  ADD CONSTRAINT `orders_products_ibfk_1` FOREIGN KEY (`idOrders`) REFERENCES `orders` (`idOrders`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_products_ibfk_2` FOREIGN KEY (`idProduct`) REFERENCES `product` (`idProduct`) ON DELETE CASCADE;

--
-- Constraints for table `poll_answer`
--
ALTER TABLE `poll_answer`
  ADD CONSTRAINT `poll_answer_ibfk_1` FOREIGN KEY (`idPoll`) REFERENCES `poll` (`idPoll`) ON DELETE CASCADE;

--
-- Constraints for table `poll_user_answer`
--
ALTER TABLE `poll_user_answer`
  ADD CONSTRAINT `poll_user_answer_ibfk_1` FOREIGN KEY (`idPollAnswer`) REFERENCES `poll_answer` (`idPollAnswer`) ON DELETE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`),
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`idHomeProduct`) REFERENCES `home_product` (`idHomeProduct`),
  ADD CONSTRAINT `product_ibfk_4` FOREIGN KEY (`idCategory`) REFERENCES `category` (`idCategory`);

--
-- Constraints for table `rating_product`
--
ALTER TABLE `rating_product`
  ADD CONSTRAINT `rating_product_ibfk_1` FOREIGN KEY (`idProduct`) REFERENCES `product` (`idProduct`) ON DELETE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`idRole`) REFERENCES `role` (`idRole`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`idCountry`) REFERENCES `country` (`idCountry`);

--
-- Constraints for table `users_comment_replies`
--
ALTER TABLE `users_comment_replies`
  ADD CONSTRAINT `users_comment_replies_ibfk_1` FOREIGN KEY (`idReplies`) REFERENCES `comment_replies` (`idReplies`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_comment_replies_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
