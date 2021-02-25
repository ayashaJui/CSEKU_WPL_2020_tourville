-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Feb 22, 2021 at 05:03 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tourism_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `admin_firstname` varchar(255) NOT NULL,
  `admin_lastname` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_contact` varchar(255) NOT NULL,
  `admin_status` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `admin_firstname`, `admin_lastname`, `admin_email`, `admin_password`, `admin_contact`, `admin_status`, `date`) VALUES
(2, 'admin', 'System', 'Admin', 'admin@gmail.com', '$2y$12$YKWXPghlo3lhBMvjmlPIh./3DUggNr7euUErMMY2L67yvNLTelQPq', '', 'approved', '2020-10-25'),
(3, 'admin001', 'Ryan', 'Smith', 'ryan@gmail.com', '$2y$12$sd2tv2Rb/jcEdeKMbq.QuenjzKmtVlbgmEMZYXAQB0848i7qU2uMe', '', 'unapproved', '2020-10-25'),
(4, 'brad004', 'Brad', 'Coelho', 'brad@gmail.com', '$2y$12$OZyLotlfc7TLf6VHRxHKaepNIMlSP6xFC8rLkxJ1povxUgpSIoMo2', '', 'approved', '2021-02-22');

-- --------------------------------------------------------

--
-- Table structure for table `agencies`
--

CREATE TABLE `agencies` (
  `agency_id` int(11) NOT NULL,
  `agency_name` varchar(255) NOT NULL,
  `owner_firstname` varchar(255) NOT NULL,
  `owner_lastname` varchar(255) NOT NULL,
  `agency_email` varchar(255) NOT NULL,
  `agency_password` varchar(255) NOT NULL,
  `logo_image` text NOT NULL,
  `cover_image` text NOT NULL,
  `agency_contact` varchar(255) NOT NULL,
  `agency_address` varchar(255) NOT NULL,
  `agency_status` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agencies`
--

INSERT INTO `agencies` (`agency_id`, `agency_name`, `owner_firstname`, `owner_lastname`, `agency_email`, `agency_password`, `logo_image`, `cover_image`, `agency_contact`, `agency_address`, `agency_status`, `date`) VALUES
(2, 'Holidays', 'George', 'Smith', 'george@gmail.com', '$2y$12$xHb7FvRS3jRly6DX9Z/fxesZ.Ox.I7kVkJLrws0HBgMxrJcXTqWEu', 'agency_logo.jpg', 'agency.jpg', '01478635912', '22, wall street, Dhaka', 'approved', '2020-10-27'),
(3, 'Discover', 'Will', 'Martin', 'will@gmail.com', '$2y$12$7h2.szSNl9HEVScOYBGNmu6u3WfiHahskOKxo97SpBi5sGL0ouLvG', 'pexels-magda-ehlers-1337380.jpg', 'pexels-francisco-valerio-trujillo-1824392.jpg', '01778635912', '22, bk street, Khulna', 'approved', '2020-10-27'),
(5, 'TravelZoo', 'Brida', 'Manson', 'brida@gmail.com', '$2y$12$Aq7puCCxM5WDvFmiH/nNDeUUUELpSwyelUedy.3/4WD21IXz6LEcy', 'laura-chouette-Zg6UTBHQiI4-unsplash.jpg', 'luca-bravo-SRjZtxsK3Os-unsplash.jpg', '01478635912', '20, new street, sylhet', 'approved', '2020-12-31'),
(6, 'Horizon', 'Megan', 'Taylor', 'megan@gmail.com', '$2y$12$opFrZrLRmhDKeZVarR6lxOqNBCp7fI2K1bqlmpjx8nx8N1NRacaK.', 'alexey-mak-sMZLg77Z2Dk-unsplash.jpg', 'alexander-popov-i0KaMiYdpDM-unsplash.jpg', '01278635912', '22, mk street, Rajshahi', 'approved', '2021-01-12'),
(7, 'Lost Panorama', 'Tag', 'Jones', 'tag@gmail.com', '$2y$12$Yn6g6oanzUvPgjw8cuXMXej/BWyqdmnC6ub0A//YeDe1YT8SSjwlC', 'francesco-ungaro-9UWXNSbEuYw-unsplash.jpg', 'hugo-delauney-feHioLsUj8o-unsplash.jpg', '01278635919', '22, mk street, Barisal', 'approved', '2021-01-12'),
(8, 'Tropical Travel', 'Michael', 'Willson', 'michael@gmail.com', '$2y$12$ziF9ELWkDtGEM.rwgv8HQe97QlpLI18hQ6.lOngi1hbCd5Soiamri', 'moritz-mentges-5MlBMYDsGBY-unsplash.jpg', 'riz-mooney-Ep3NPU9Uhkw-unsplash.jpg', '01278635919', '22, bk street, Chittagong', 'approved', '2021-01-12'),
(12, 'BookIt', 'Liam', 'Reece', 'liam@gmail.com', '$2y$12$UD6ISyYopu51fC6El45xv.6hqP6JsWmyZdN37TDalxeVwhtqLzT7S', '1agency_logo.jpg', '1agency_cover.jpg', '01254789632', '22,bl road, Dhaka', 'approved', '2021-01-12'),
(13, 'new', 'sss', 'kkk', 'some@gmail.com', '$2y$12$UIJyUDObjV8PhLsgC1eGrO9nhgIWeNg0SCdYqwAQWL2Svsbth7WYS', '', '', '01778635912', '22, mk street, Barisal', 'unapproved', '2021-02-22');

-- --------------------------------------------------------

--
-- Table structure for table `agency_employees`
--

CREATE TABLE `agency_employees` (
  `employee_id` int(11) NOT NULL,
  `agency_id` int(11) NOT NULL,
  `employee_firstname` varchar(255) NOT NULL,
  `employee_lastname` varchar(255) NOT NULL,
  `employee_email` varchar(255) NOT NULL,
  `employee_password` varchar(255) NOT NULL,
  `employee_contact` varchar(255) NOT NULL,
  `employee_address` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agency_employees`
--

INSERT INTO `agency_employees` (`employee_id`, `agency_id`, `employee_firstname`, `employee_lastname`, `employee_email`, `employee_password`, `employee_contact`, `employee_address`, `role`, `date`) VALUES
(2, 3, 'Nicholas', 'Martin', 'nicholas@gmail.com', '$2y$12$E6vy6NcMbgrb6KBVxk881Oovt/TpEwKLuNa6ZvM9QIHjjF3P3k3ma', '01879359632', '22, ak street, ohio', 'manager', '2020-11-01'),
(3, 3, 'Alice', 'Jane', 'alice@gmail.com', '$2y$12$Qe7wIzhdH0YsAgDAzC85/O85FKW/uA3TZdGFl9DSqqpqfVuF/G1H.', '01879359632', '22, no street, ohio', 'staff', '2020-11-07'),
(4, 2, 'Christina', 'Jones', 'christina@gmail.com', '$2y$12$2NfFKVii4OzBaE8MGuz5qOhpEDu90L0Kgeh7mxfvfaz.6iF6d8IKe', '01789365477', '21, ak street, sylhet', 'manager', '2020-11-02'),
(5, 3, 'Kathleen', 'Homes', 'kathy@gmail.com', '$2y$12$ztOf8xukuxJhCo1hpxIBfOKv6AMKhmqBUVdpOtETzw8dgWrpioqO2', '01789365477', '21, pk street, sylhet', 'staff', '2020-11-07'),
(6, 5, 'Samia', 'Shorna', 'samia@gmail.com', '$2y$12$wa.AJAFFQ4DUS.WzThAxI.VrQ7hGClsvvSaHW5GBOr1YTAKwDiMlm', '01879359632', '22, ak street, ohio', 'staff', '2020-12-28'),
(8, 5, 'Alice', 'Shorna', 'alice@gmail.com', '$2y$12$fpI4Qz5SW1Bqa9pACSCOa.x7lxaldfDLVTNPBFDSdc6OnGsiOQX9S', '01879359632', '21, pk street, sylhet', 'manager', '2020-12-27'),
(9, 5, 'jui', 'ayasha', 'jui@gmail.com', '$2y$12$fZ5dkQsOhvm4ACUOOup/lOkA8L5dWuD1VWeJuivGHeezztNPESt/e', '01879359632', '22, no street, ohio', 'staff', '2020-12-27'),
(10, 12, 'Jacob', 'Evans', 'jacob@gmail.com', '$2y$12$YNMtoi5/b9SDrBpJyY8eXeX/PM35/j6qM18TmAu25VomciqLnzMM2', '01358974630', '22,bk road, khulna', 'manager', '2020-12-27'),
(11, 12, 'Tessa', 'May', 'tes@gmail.com', '$2y$12$3lnwMfi9rLOsxYHgWwD7veuOM1nWtDcm0UgNQW4mKg2rjD7RiF9WG', '01358974630', '21, ak street, sylhet', 'staff', '2021-02-01');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `tourist_id` int(11) NOT NULL,
  `agency_id` int(11) NOT NULL,
  `persons` int(11) NOT NULL,
  `travel_style` varchar(255) NOT NULL,
  `tourist_firstname` varchar(255) NOT NULL,
  `tourist_lastname` varchar(255) NOT NULL,
  `tourist_email` varchar(255) NOT NULL,
  `tourist_contact` varchar(255) NOT NULL,
  `enquiry_msg` text NOT NULL,
  `booking_status` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `package_id`, `tourist_id`, `agency_id`, `persons`, `travel_style`, `tourist_firstname`, `tourist_lastname`, `tourist_email`, `tourist_contact`, `enquiry_msg`, `booking_status`, `date`) VALUES
(3, 10, 3, 3, 8, 'comfortable', 'John', 'Green', 'john@gmail.com', '', '', 'confirm', '2020-12-30'),
(4, 3, 4, 3, 5, 'luxury', 'James', 'Rollins', 'james@gmail.com', '', '', 'confirm', '2020-12-30'),
(5, 5, 3, 3, 5, 'budget', 'John', 'Green', 'john@gmail.com', '', '', 'confirm', '2020-12-31'),
(6, 6, 4, 3, 4, 'budget', 'James', 'Green', 'james@gmail.com', '', '', 'confirm', '2021-01-03'),
(7, 12, 4, 2, 30, 'comfortable', 'James', 'Rollins', 'james@gmail.com', '', '', 'confirm', '2021-01-12'),
(8, 15, 3, 6, 30, 'budget', 'John', 'Green', 'john@gmail.com', '', '', 'confirm', '2021-01-12'),
(9, 2, 5, 2, 20, 'comfortable', 'Lizzy', 'Bennet', 'liz@gmail.com', '', '', 'confirm', '2021-01-12'),
(10, 15, 5, 6, 10, 'luxury', 'Lizzy', 'Bennet', 'liz@gmail.com', '', '', 'confirm', '2021-01-12'),
(11, 16, 8, 7, 15, 'budget', 'Fitzwilliam', 'Darcy', 'darcy@gmail.com', '', '', 'confirm', '2021-01-12'),
(12, 14, 8, 5, 10, 'comfortable', 'Fitzwilliam', 'Darcy', 'darcy@gmail.com', '', '', 'confirm', '2021-01-12'),
(13, 16, 10, 7, 15, 'budget', 'Jasmin', 'Chew', 'jasmin@gmail.com', '', '', 'confirm', '2021-01-12'),
(14, 14, 10, 5, 15, 'budget', 'Jasmin', 'Chew', 'jasmin@gmail.com', '', '', 'confirm', '2021-01-12'),
(15, 17, 9, 8, 10, 'luxury', 'Maria', 'Smith', 'maria@gmail.com', '', '', 'confirm', '2021-01-12'),
(16, 2, 9, 2, 12, 'comfortable', 'Maria', 'Smith', 'maria@gmail.com', '', '', 'confirm', '2021-01-12'),
(17, 17, 11, 8, 20, 'comfortable', 'Oliver', 'Bingley', 'oliver@gmail.com', '', '', 'confirm', '2021-01-12'),
(18, 16, 11, 7, 15, 'budget', 'Oliver', 'Bingley', 'oliver@gmail.com', '', '', 'confirm', '2021-01-12'),
(21, 19, 14, 12, 15, 'comfortable', 'Jack', 'Charles', 'jack@gmail.com', '', '', 'confirm', '2021-01-12');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `tourist_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `agency_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `tourist_id`, `package_id`, `agency_id`, `content`, `comment_status`, `comment_date`) VALUES
(1, 4, 3, 3, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 'published', '2020-12-30'),
(2, 10, 14, 5, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor&nbsp;<br>incididunt ut labore et dolore magna aliqua</p>', 'published', '2021-01-12'),
(3, 10, 16, 7, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor&nbsp;<br>incididunt ut labore et dolore magna aliqua</p>', 'published', '2021-01-12'),
(4, 9, 2, 2, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor&nbsp;<br>incididunt ut labore et dolore magna aliqua</p>', 'published', '2021-01-12'),
(5, 9, 17, 8, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor&nbsp;<br>incididunt ut labore et dolore magna aliqua</p>', 'published', '2021-01-12'),
(6, 5, 15, 6, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor&nbsp;<br>incididunt ut labore et dolore magna aliqua</p>', 'published', '2021-01-12'),
(7, 5, 2, 2, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor&nbsp;<br>incididunt ut labore et dolore magna aliqua</p>', 'published', '2021-01-12'),
(8, 8, 14, 5, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor&nbsp;<br>incididunt ut labore et dolore magna aliqua</p>', 'published', '2021-01-12'),
(9, 8, 16, 7, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor&nbsp;<br>incididunt ut labore et dolore magna aliqua</p>', 'published', '2021-01-12'),
(10, 3, 15, 6, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor&nbsp;<br>incididunt ut labore et dolore magna aliqua</p>', 'published', '2021-01-12'),
(11, 3, 5, 3, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor&nbsp;<br>incididunt ut labore et dolore magna aliqua</p>', 'published', '2021-01-12'),
(12, 11, 16, 7, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor&nbsp;<br>incididunt ut labore et dolore magna aliqua</p>', 'published', '2021-01-12'),
(13, 14, 19, 12, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor&nbsp;<br>incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis&nbsp;<br>nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.&nbsp;<br>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolor<br>&nbsp;</p>', 'published', '2021-01-12');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `package_id` int(11) NOT NULL,
  `agency_id` int(11) NOT NULL,
  `package_name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `place_details` text NOT NULL,
  `place_images` text NOT NULL,
  `num_days` int(11) NOT NULL,
  `num_nights` int(11) NOT NULL,
  `budget_price` int(11) NOT NULL,
  `comfort_price` int(11) NOT NULL,
  `lux_price` int(11) NOT NULL,
  `budget_details` varchar(255) NOT NULL,
  `comfort_details` varchar(255) NOT NULL,
  `lux_details` varchar(255) NOT NULL,
  `booking_percentage` int(11) NOT NULL,
  `min_people` int(11) NOT NULL,
  `includes` text NOT NULL,
  `excludes` text NOT NULL,
  `optional` text NOT NULL,
  `itinerary` text NOT NULL,
  `package_status` varchar(255) NOT NULL,
  `package_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`package_id`, `agency_id`, `package_name`, `location`, `country`, `place_details`, `place_images`, `num_days`, `num_nights`, `budget_price`, `comfort_price`, `lux_price`, `budget_details`, `comfort_details`, `lux_details`, `booking_percentage`, `min_people`, `includes`, `excludes`, `optional`, `itinerary`, `package_status`, `package_date`) VALUES
(2, 2, 'Sajek Tour', 'Sajek', 'Bangladesh', '<p>This place is awesome… dddddddddddd..&nbsp;</p>', '(\'pexels-nathan-cowley-1300510.jpg\'),(\'pexels-oliver-sjöström-1005417.jpg\'),(\'pexels-francesco-ungaro-1671324.jpg\')', 3, 4, 7000, 9000, 12000, 'Economy transport options and normal accommodation', 'Mid-range transport options and 4* accommodation', 'High-end transport options and 5* accommodation', 10, 20, '<ul><li>Bus Fare</li><li>Breakfast</li><li>Hotel</li></ul>', '<ul><li>lunch</li><li>dinner</li></ul>', '<ul><li>warm cloth</li><li>Hiking Gear</li></ul>', '<p><strong>Day 1: </strong>Visiting ….</p><p><strong>Day 2:</strong> Hiking</p>', 'available', '2020-10-28'),
(3, 3, 'St. Martin Tour', 'St. Martin', 'Bangladesh', '<p>St. Martin\'s Island is a small island in the northeastern part of the Bay of Bengal, about 9 km south of the tip of the Cox\'s Bazar-Teknaf peninsula, and forming the southernmost part of Bangladesh. There is a small adjoining island that is separated at high tide, called Chera Dwip.</p>', '(\'pexels-kellie-churchman-1001682.jpg\'),(\'pexels-nathan-cowley-1300510.jpg\'),(\'pexels-sebastian-voortman-189349.jpg\'),(\'pexels-oliver-sjöström-1005417.jpg\')', 3, 2, 6000, 8000, 10000, 'Economy transport options and nomal accommodation', 'Mid - range transport options and 4* accommodation', 'High-end transport options and 5* accommodation', 5, 20, '<ul><li>Bus Fare</li><li>Ship Fare</li><li>Hotel</li><li>Breakfast</li></ul>', '<ul><li>Lunch</li><li>Dinner</li><li>Travelling inside island</li></ul>', '<ul><li>Sponge Sandle</li><li>Extra Cloth</li></ul>', '<p><strong>Day 1: </strong>We will visit the main island &amp; Chera Dip</p><p><strong>Day 2: </strong>We will visit ‘Samudro Bilas’.</p>', 'available', '2020-10-28'),
(5, 3, 'Rangamati', 'Rangamati', 'Bangladesh', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>', '(\'pexels-nathan-cowley-1300510.jpg\'),(\'pexels-oliver-sjöström-1005417.jpg\'),(\'pexels-francisco-valerio-trujillo-1824392.jpg\')', 4, 3, 10000, 12000, 15000, 'Economy transport options and normal accommodation', 'Mid-range transport options and 4* accommodation', 'High-end transport options and 5* accommodation', 20, 40, '<ul><li>Bus Ticket</li><li>Breakfast</li></ul>', '<ul><li>Lunch</li><li>Dinner</li></ul>', '<ul><li>Hiking Shoe</li><li>Sunscreen</li></ul>', '<p><strong>Day 1: </strong>hhhhhhhhhhhhhhhhhhhhhhhhhhhhh</p><p><strong>Day 2: </strong>Jhulonto Bridge</p>', 'available', '2020-11-04'),
(6, 3, 'Cox\'s Bazar Tour', 'Cox\'s Bazar', 'Bangladesh', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>', '(\'pexels-nathan-cowley-1300510.jpg\'),(\'pexels-magda-ehlers-1337380.jpg\'),(\'astronomy-beautiful-clouds-constellation-355465.jpg\')', 2, 3, 8000, 10000, 15000, 'Economy transport options and nomal accommodation', 'Mid - range transport options and 4* accommodation', 'High-end transport options and 5* accommodation', 15, 15, '<ul><li>Breakfast</li><li>Bus Fare</li></ul>', '<ul><li>Lunch</li><li>Dinner</li></ul>', '<ul><li>Sunscreen</li><li>Hat</li></ul>', '<p><strong>Day 1:</strong> Inani Beach</p><p><strong>Day 2: </strong>Himchori</p>', 'available', '2020-11-11'),
(10, 3, 'Sundarban Tour', 'Sundarbon', 'Bangladesh', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>', '(\'sharp.jpg\'),(\'pexels-nathan-cowley-1300510.jpg\'),(\'pexels-francesco-ungaro-1671324.jpg\')', 5, 4, 6000, 7500, 9000, 'Economy transport options and normal accommodation', 'Mid - range transport options and 4* accommodation', 'High-end transport options and 5* accommodation', 12, 15, '<ul><li>Breakfast</li><li>Lunch</li><li>Dinner</li></ul>', '<ul><li>Bus Fare</li><li>Train Fare</li></ul>', '<ul><li>Carry Fresh Drinking Water</li><li>Sunscreen</li></ul>', '<p><strong>Day 1: </strong>Koromjol</p><p><strong>Day 2: </strong>Dublar chor</p><p><strong>Day 3: </strong>Hiron Point</p><p><strong>Day 4: </strong>Tiger Point</p>', 'available', '2020-11-30'),
(11, 3, 'Srimongol', 'Srimongol', 'Bangladesh', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur</p>', '(\'sharp.jpg\'),(\'astronomy-beautiful-clouds-constellation-355465.jpg\'),(\'pexels-francesco-ungaro-1671324.jpg\')', 3, 4, 7000, 9000, 11000, 'Economy transport options and normal accommodation', 'Mid - range transport options and 4* accommodation', 'High-end transport options and 5* accommodation', 8, 30, '<ul><li>Transport</li><li>Breakfast</li></ul>', '<ul><li>Lunch</li><li>Dinner</li></ul>', '<ul><li>Medical Kit</li></ul>', '<p><strong>Day 1: </strong>Visiting “Cha Baghan”</p>', 'available', '2020-12-08'),
(12, 2, 'Sundarban Tour', 'Sundarbon', 'Bangladesh', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>', '(\'pexels-kellie-churchman-1001682.jpg\'),(\'pexels-sebastian-voortman-189349.jpg\'),(\'pexels-francesco-ungaro-1671324.jpg\')', 6, 5, 8000, 12000, 15000, 'Economy transport options and normal accommodation', 'Mid - range transport options and 4* accommodation', 'High-end transport options and 5* accommodation', 20, 50, '<ul><li>Breakfast</li><li>Lunch</li><li>Dinner</li></ul>', '<ul><li>Bus Fare</li><li>Train Fare</li><li>Medical kit</li></ul>', '<ul><li>Carry Fresh Drinking Water</li><li>Sunscreen</li></ul>', '<p><strong>Day 1: </strong>Koromjol</p><p><strong>Day 2: </strong>Dublar chor</p><p><strong>Day 3: </strong>Hiron Point</p><p><strong>Day 4: </strong>Tiger Point</p>', 'available', '2020-12-31'),
(13, 5, 'Rangamati Tour', 'Rangamati', 'Bangladesh', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>', '(\'kurt-cotoaga-cqbLg3lZEpk-unsplash.jpg\'),(\'grey.jpg\'),(\'astronomy-beautiful-clouds-constellation-355465.jpg\')', 3, 3, 8000, 10000, 12000, 'Economy transport options and normal accommodation', 'Mid - range transport options and 4* accommodation', 'High-end transport options and 5* accommodation', 15, 20, '<ul><li>Bus Ticket</li><li>Breakfast</li></ul>', '<ul><li>Lunch&nbsp;</li><li>Dinner</li><li>Medical</li></ul>', '<ul><li>Hiking Gear</li></ul>', '<p><strong>Day 1: </strong>Hiking</p><p><strong>Day 2: </strong>Tourist Spot</p>', 'available', '2020-12-31'),
(14, 5, 'Sylhet Tour', 'Sylhet', 'Bangladesh', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>', '(\'hemendra-ahuja-WWDXwam1jG4-unsplash.jpg\'),(\'kurt-cotoaga-cqbLg3lZEpk-unsplash.jpg\'),(\'sharp.jpg\')', 4, 5, 10000, 13000, 16000, 'Economy transport options and normal accommodation', 'Mid - range transport options and 4* accommodation', 'High-end transport options and 5* accommodation', 30, 15, '<ul><li>Bus Fare</li><li>Internal Travel Cost</li><li>Breakfast</li></ul>', '<ul><li>Lunch</li><li>Dinner</li></ul>', '<ul><li>Medical Kit</li><li>Warm Cloth</li></ul>', '<p><strong>Day 1: </strong>Visiting Tea Garden</p><p><strong>Day 2: </strong>Jaflong</p><p><strong>Day 2:</strong> Tourist Spot</p>', 'available', '2020-12-31'),
(15, 6, 'St. Martin Tour', 'St. Martin', 'Bangladesh', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolor</p>', '(\'322709_136261_saint-martin-island-beach-compressor.jpg\'),(\'prothomalo-english_import_media_2018_10_08_a2d10327119a0074a878943cde03472a-St-Martin-s.jpg\'),(\'the-saint-martin-s-island.jpg\')', 3, 3, 5000, 8000, 10000, 'Economy transport options and normal accommodation', 'Mid - range transport options and 4* accommodation', 'High-end transport options and 5* accommodation', 15, 30, '<ul><li>Ship Fare</li><li>Breakfast</li><li>Hotel</li></ul>', '<ul><li>Lunch&nbsp;</li><li>Dinner</li><li>Medical</li></ul>', '<ul><li>Medical Kit</li><li>Sandle</li></ul>', '<p><strong>Day 1: </strong>Cheradip</p><p><strong>Day 2: </strong>Somudro Bilas</p>', 'available', '2021-01-12'),
(16, 7, 'Cox\'s Bazar Tour', 'Cox\'s Bazar', 'Bangladesh', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor&nbsp;<br>incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis&nbsp;<br>nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.&nbsp;<br>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolor</p>', '(\'2e.jpg\'),(\'coxs_bazar.jpg\'),(\'sea-beach.jpg\')', 2, 2, 4000, 5000, 7000, 'Economy transport options and normal accommodation', 'Mid - range transport options and 4* accommodation', 'High-end transport options and 5* accommodation', 12, 20, '<ul><li>Breakfast</li><li>Bus Fare</li></ul>', '<ul><li>Lunch</li><li>Dinner</li></ul>', '<ul><li>Medical Kit</li><li>Sunscreen</li></ul>', '<p><strong>Day 1: </strong>Visiting Inani Beach</p><p><strong>Day 2: </strong>Himchori</p>', 'available', '2021-01-12'),
(17, 8, 'Sajek Tour', 'Sajek', 'Bangladesh', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor&nbsp;<br>incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis&nbsp;<br>nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.&nbsp;<br>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolor</p>', '(\'cover22-870x555.jpg\'),(\'Discover-sajek-valley.jpg\'),(\'Sajek-Valley.jpg\')', 3, 4, 6000, 8000, 12000, 'Economy transport options and normal accommodation', 'Mid - range transport options and 4* accommodation', 'High-end transport options and 5* accommodation', 20, 15, '<ul><li>Bus Fare</li><li>Breakfast</li></ul>', '<ul><li>Lunch</li><li>Dinner</li></ul>', '<ul><li>Medical Kit</li><li>Hiking Gear<strong>&nbsp;</strong></li></ul>', '<p><strong>Day 1: </strong>Trekking</p><p><strong>Day 2: </strong>Visiting Local Area</p>', 'available', '2021-01-12'),
(19, 12, 'Sylhet Tour', 'Sylhet', 'Bangladesh', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor&nbsp;<br>incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis&nbsp;<br>nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.&nbsp;<br>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolor<br>&nbsp;</p>', '(\'1sylhet.jpg\'),(\'1sylhet2.jpg\'),(\'1sylhet3.jpg\')', 2, 3, 6000, 8000, 10000, 'Economy transport options and normal accommodation', 'Mid - range transport options and 4* accommodation', 'High-end transport options and 5* accommodation', 15, 15, '<ul><li>Bus Fare</li><li>Breakfast</li></ul>', '<ul><li>Lunch</li><li>Dinner</li></ul>', '<ul><li>Medical Kit</li></ul>', '<p><strong>Day 1: </strong>Tea Garden</p><p><strong>Day 2: </strong>Jaflong</p>', 'available', '2021-01-12');

-- --------------------------------------------------------

--
-- Table structure for table `package_dates`
--

CREATE TABLE `package_dates` (
  `date_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `agency_id` int(11) NOT NULL,
  `last_date` date NOT NULL,
  `travel_date` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `package_dates`
--

INSERT INTO `package_dates` (`date_id`, `package_id`, `agency_id`, `last_date`, `travel_date`, `status`, `date`) VALUES
(10, 10, 3, '2020-12-29', '2021-01-07', 'booking on', '2020-12-23'),
(11, 3, 3, '2021-01-02', '2021-01-08', 'booking on', '2020-12-23'),
(12, 11, 3, '2020-12-24', '2020-12-29', 'booking on', '2020-12-25'),
(13, 2, 2, '2021-01-16', '2021-01-19', 'booking on', '2020-12-31'),
(14, 5, 3, '2021-01-08', '2021-01-12', 'extended', '2021-01-03'),
(15, 6, 3, '2021-01-09', '2021-01-11', 'booking off', '2021-01-03'),
(16, 13, 5, '2021-01-14', '2021-01-19', 'booking on', '2021-01-11'),
(17, 12, 2, '2021-01-15', '2021-01-21', 'booking on', '2021-01-12'),
(18, 15, 6, '2021-01-15', '2021-01-20', 'booking on', '2021-01-12'),
(19, 16, 7, '2021-01-14', '2021-01-22', 'booking on', '2021-01-12'),
(20, 17, 8, '2021-01-14', '2021-01-16', 'booking on', '2021-01-12'),
(21, 14, 5, '2021-01-18', '2021-01-22', 'booking on', '2021-01-12'),
(23, 19, 12, '2021-01-17', '2021-01-20', 'booking off', '2021-01-12');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `agency_id` int(11) NOT NULL,
  `tourist_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `txn_id` varchar(255) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `card_name` varchar(255) NOT NULL,
  `tour_status` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `booking_id`, `package_id`, `agency_id`, `tourist_id`, `amount`, `currency`, `txn_id`, `payment_type`, `payment_status`, `card_name`, `tour_status`, `date`) VALUES
(2, 3, 10, 3, 3, 7200, 'bdt', 'txn_1I3zvdFRq96Mv30aZ9otD9An', 'book_price', 'succeeded', 'John', 'completed', '2020-12-30'),
(3, 4, 3, 3, 4, 2500, 'bdt', 'txn_1I40I8FRq96Mv30aZvGqTNpz', 'book_price', 'succeeded', 'James', 'completed', '2020-12-30'),
(4, 5, 5, 3, 3, 10000, 'bdt', 'txn_1I4ODqFRq96Mv30ajYvsOQCn', 'book_price', 'succeeded', 'John', 'completed', '2020-12-31'),
(5, 18, 16, 7, 11, 7200, 'bdt', 'txn_1I8q4iFRq96Mv30a5aAJU7S5', 'book_price', 'succeeded', 'Darcy', 'completed', '2021-01-12'),
(6, 17, 17, 8, 11, 32000, 'bdt', 'txn_1I8q5cFRq96Mv30aFuRR9FY0', 'book_price', 'succeeded', 'Oliver', 'completed', '2021-01-12'),
(7, 12, 14, 5, 8, 39000, 'bdt', 'txn_1I8q9oFRq96Mv30a767HeJKI', 'book_price', 'succeeded', 'darcy', 'completed', '2021-01-12'),
(8, 15, 17, 8, 9, 24000, 'bdt', 'txn_1I8qACFRq96Mv30aoCDE7BRq', 'book_price', 'succeeded', 'Maria', 'completed', '2021-01-12'),
(9, 11, 16, 7, 8, 7200, 'bdt', 'txn_1I8qAHFRq96Mv30aT8CIMJ0W', 'book_price', 'succeeded', 'darcy', 'completed', '2021-01-12'),
(10, 16, 2, 2, 9, 10800, 'bdt', 'txn_1I8qApFRq96Mv30aeuwiPbbv', 'book_price', 'succeeded', 'Maria', 'completed', '2021-01-12'),
(11, 7, 12, 2, 4, 72000, 'bdt', 'txn_1I8qBCFRq96Mv30aPjYHHkhR', 'book_price', 'succeeded', 'james', 'completed', '2021-01-12'),
(12, 10, 15, 6, 5, 15000, 'bdt', 'txn_1I8qBcFRq96Mv30anEzZGhY0', 'book_price', 'succeeded', 'Lizzy', 'completed', '2021-01-12'),
(13, 6, 6, 3, 4, 4800, 'bdt', 'txn_1I8qByFRq96Mv30ayobMrIUf', 'book_price', 'succeeded', 'james', 'completed', '2021-01-12'),
(14, 9, 2, 2, 5, 18000, 'bdt', 'txn_1I8qCHFRq96Mv30aGqQwxOhY', 'book_price', 'succeeded', 'Lizzy', 'completed', '2021-01-12'),
(15, 8, 15, 6, 3, 22500, 'bdt', 'txn_1I8qCmFRq96Mv30a7Wbk6oJt', 'book_price', 'succeeded', 'john', 'completed', '2021-01-12'),
(16, 14, 14, 5, 10, 45000, 'bdt', 'txn_1I8qDUFRq96Mv30azLsjBlEp', 'book_price', 'succeeded', 'Jasmin', 'completed', '2021-01-12'),
(17, 13, 16, 7, 10, 7200, 'bdt', 'txn_1I8qDzFRq96Mv30aPnYszjFw', 'book_price', 'succeeded', 'Jasmin', 'completed', '2021-01-12'),
(18, 21, 19, 12, 14, 18000, 'bdt', 'txn_1I8tsbFRq96Mv30aLNKvabWD', 'book_price', 'succeeded', 'Jack', 'not started', '2021-01-12');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `agency_id` int(11) NOT NULL,
  `tourist_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text NOT NULL,
  `review_status` varchar(255) NOT NULL,
  `review_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `agency_id`, `tourist_id`, `rating`, `comment`, `review_status`, `review_date`) VALUES
(1, 3, 4, 4, '', 'unpublished', '2020-12-30'),
(2, 3, 3, 3, '', 'published', '2020-12-31'),
(3, 5, 10, 4, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor&nbsp;</p>', 'published', '2021-01-12'),
(4, 7, 10, 3, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor&nbsp;</p>', 'published', '2021-01-12'),
(5, 2, 9, 2, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing&nbsp;</p>', 'published', '2021-01-12'),
(6, 7, 11, 5, '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'published', '2021-01-12'),
(7, 8, 9, 5, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor&nbsp;</p>', 'published', '2021-01-12'),
(8, 6, 5, 4, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing&nbsp;</p>', 'published', '2021-01-12'),
(9, 2, 5, 4, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing&nbsp;</p>', 'published', '2021-01-12'),
(10, 5, 8, 5, '', 'published', '2021-01-12'),
(11, 7, 8, 4, '', 'published', '2021-01-12'),
(12, 6, 3, 2, '', 'published', '2021-01-12'),
(13, 2, 4, 5, '', 'published', '2021-01-12'),
(14, 8, 11, 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing&nbsp;</p>', 'published', '2021-01-12'),
(15, 12, 14, 4, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor&nbsp;<br>incididunt ut labore et dolore magna aliqua. Ut&nbsp;</p>', 'published', '2021-01-12');

-- --------------------------------------------------------

--
-- Table structure for table `tourists`
--

CREATE TABLE `tourists` (
  `tourist_id` int(11) NOT NULL,
  `tourist_stripe` varchar(255) NOT NULL,
  `tourist_username` varchar(255) NOT NULL,
  `tourist_firstname` varchar(255) NOT NULL,
  `tourist_lastname` varchar(255) NOT NULL,
  `tourist_email` varchar(255) NOT NULL,
  `tourist_password` varchar(255) NOT NULL,
  `profile_image` text NOT NULL,
  `tourist_contact` varchar(255) NOT NULL,
  `tourist_address` varchar(255) NOT NULL,
  `tourist_status` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tourists`
--

INSERT INTO `tourists` (`tourist_id`, `tourist_stripe`, `tourist_username`, `tourist_firstname`, `tourist_lastname`, `tourist_email`, `tourist_password`, `profile_image`, `tourist_contact`, `tourist_address`, `tourist_status`, `date`) VALUES
(3, 'cus_IfKZWihUWnctLc', 'john11', 'John', 'Green', 'john@gmail.com', '$2y$12$NMY5bfT4NrnMPfQKncdtQOL5E4n89kfj10afg5JLotXXLRAuOYBY2', 'download (1).jpg', '', '', 'approved', '2020-12-30'),
(4, 'cus_IfKsR5lD0VJ5Zk', 'james13', 'James', 'Rollins', 'james@gmail.com', '$2y$12$Ty275THcKi.louXDelK5ROabmqJLNEO4.PleoJBbgvw8hvJhN3ybu', '', '', '', 'approved', '2020-12-30'),
(5, 'cus_IfeSNCc0xKSOqa', 'Lizzy110', 'Lizzy', 'Bennet', 'liz@gmail.com', '$2y$12$kvvZXgRBDNPluv6yu.YktufV01Bfd/BD2X7dE2Kl5f6B.bfCYp79y', 'christopher-campbell-rDEOVtE7vOs-unsplash.jpg', '', '', 'approved', '2020-12-31'),
(8, 'cus_IkDTn94kqMAT0w', 'darcy001', 'Fitzwilliam', 'Darcy', 'darcy@gmail.com', '$2y$12$pHdgcRSmxJ0ks1pn2AVdneVoSoDx5e5yHEo2X75JZse1W.aSEwfpS', 'jonny-neuenhagen-49e5-juD4co-unsplash.jpg', '', '', 'approved', '2021-01-12'),
(9, 'cus_IkDVouLPuOSrg9', 'maria420', 'Maria', 'Smith', 'maria@gmail.com', '$2y$12$sxCd9cnpcZ.llyhVHYPMIuSjRJd3XhZmQPaEfqdNeJgEoSXSJZOpW', 'manny-moreno-gVPmUcMgoII-unsplash.jpg', '', '', 'approved', '2021-01-12'),
(10, 'cus_IkDXhVrPXPnFv4', 'jasmin223', 'Jasmin', 'Chew', 'jasmin@gmail.com', '$2y$12$up.rkb13MqBRQUyeoMdDUuKzMjHQHthIKt9tA9P5JuKO/QaoutUoG', 'jasmin-chew-yMdI_y-zfzs-unsplash.jpg', '', '', 'approved', '2021-01-12'),
(11, 'cus_IkDZQK21VDbAc1', 'oliver556', 'Oliver', 'Bingley', 'oliver@gmail.com', '$2y$12$58StAtIkNWZGduhhEOyWuumnSgKA6x2SeJYmWot0T1szHAcDmdJSm', 'aeecc22a67dac7987a80ac0724658493.jpg', '', '', 'approved', '2021-01-12'),
(12, 'cus_IkDd4H4bHyMv5K', 'heisenberg', 'Walter', 'White', 'walter@gmail.com', '$2y$12$nPNbKXMRdRLw5HFRnMHMmOf/UpIhnBiRjj6fqowmdByWwqN7ixphO', 'Walter_White_pilot.png', '', '', 'approved', '2021-01-12'),
(14, 'cus_IkNtRL2LSUWj8v', 'jack003', 'Jack', 'Charles', 'jack@gmail.com', '$2y$12$ATcijkSNj6WYoiSh3h6Roe2vkVqH59JECRRUyt.HnN6ZzDGZwIF8.', '1tourist.jpg', '', '', 'approved', '2021-01-12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `agencies`
--
ALTER TABLE `agencies`
  ADD PRIMARY KEY (`agency_id`);

--
-- Indexes for table `agency_employees`
--
ALTER TABLE `agency_employees`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `agency_employees_ibfk_1` (`agency_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `package_id` (`package_id`),
  ADD KEY `tourist_id` (`tourist_id`),
  ADD KEY `agency_id` (`agency_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `tourist_id` (`tourist_id`),
  ADD KEY `package_id` (`package_id`),
  ADD KEY `agency_id` (`agency_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`package_id`),
  ADD KEY `agency_id` (`agency_id`);

--
-- Indexes for table `package_dates`
--
ALTER TABLE `package_dates`
  ADD PRIMARY KEY (`date_id`),
  ADD KEY `package_id` (`package_id`),
  ADD KEY `agency_id` (`agency_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `package_id` (`package_id`),
  ADD KEY `agency_id` (`agency_id`),
  ADD KEY `tourist_id` (`tourist_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `agency_id` (`agency_id`),
  ADD KEY `tourist_id` (`tourist_id`);

--
-- Indexes for table `tourists`
--
ALTER TABLE `tourists`
  ADD PRIMARY KEY (`tourist_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `agencies`
--
ALTER TABLE `agencies`
  MODIFY `agency_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `agency_employees`
--
ALTER TABLE `agency_employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `package_dates`
--
ALTER TABLE `package_dates`
  MODIFY `date_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tourists`
--
ALTER TABLE `tourists`
  MODIFY `tourist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agency_employees`
--
ALTER TABLE `agency_employees`
  ADD CONSTRAINT `agency_employees_ibfk_1` FOREIGN KEY (`agency_id`) REFERENCES `agencies` (`agency_id`) ON DELETE CASCADE;

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `packages` (`package_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`tourist_id`) REFERENCES `tourists` (`tourist_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_3` FOREIGN KEY (`agency_id`) REFERENCES `agencies` (`agency_id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`tourist_id`) REFERENCES `tourists` (`tourist_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`package_id`) REFERENCES `packages` (`package_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`agency_id`) REFERENCES `agencies` (`agency_id`) ON DELETE CASCADE;

--
-- Constraints for table `packages`
--
ALTER TABLE `packages`
  ADD CONSTRAINT `packages_ibfk_1` FOREIGN KEY (`agency_id`) REFERENCES `agencies` (`agency_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `package_dates`
--
ALTER TABLE `package_dates`
  ADD CONSTRAINT `package_dates_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `packages` (`package_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `package_dates_ibfk_2` FOREIGN KEY (`agency_id`) REFERENCES `agencies` (`agency_id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`package_id`) REFERENCES `packages` (`package_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_ibfk_3` FOREIGN KEY (`agency_id`) REFERENCES `agencies` (`agency_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_ibfk_4` FOREIGN KEY (`tourist_id`) REFERENCES `tourists` (`tourist_id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`agency_id`) REFERENCES `agencies` (`agency_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`tourist_id`) REFERENCES `tourists` (`tourist_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
