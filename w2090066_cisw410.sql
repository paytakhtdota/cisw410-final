-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2025 at 06:11 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `w2090066_cisw410`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `location_id` smallint(6) NOT NULL,
  `state` varchar(16) NOT NULL,
  `city` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `unit` varchar(8) DEFAULT NULL,
  `zip_code` varchar(10) NOT NULL,
  `add_type` enum('event','user','admin','') NOT NULL DEFAULT 'event'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`location_id`, `state`, `city`, `street`, `unit`, `zip_code`, `add_type`) VALUES
(1, 'California', 'West Sacramento', '900 Simon Terrace', '63', '95605', 'event'),
(2, 'California', 'West Sacramento', '900 Simon Terrace', '63', '95605', 'event'),
(3, 'California', 'Sacramento', '1110 2nd St', '', '95814', 'event'),
(4, 'California', 'Sacramento', '1110 2nd St', '', '95814', 'event'),
(5, 'California', 'Sacramento', '1110 2nd St', '', '95814', 'event'),
(6, 'California', 'Sacramento', '1110 2nd St', '', '95814', 'event'),
(7, 'California', 'Sacramento', '1110 2nd St', '', '95814', 'event'),
(8, 'California', 'asdf', '90', '1', '65498', 'event'),
(9, 'Iowa', 'asdf', '90', '', '65498', 'event'),
(10, 'Idaho', 'asdf', '90', '1', '65498', 'event'),
(11, 'Arkansas', 'asdf', '90', '1', '65498', 'event'),
(12, 'Alaska', 'asdf', '90', '1', '65498', 'event'),
(13, 'Alaska', 'asdf', '90', '1', '65498', 'event'),
(14, 'Alaska', 'asdf', '90', '', '65498', 'event'),
(15, 'Alaska', 'asdf', '90', '', '65498', 'event'),
(16, 'Colorado', 'asdf', '90', '', '65498', 'event'),
(17, 'California', 'asdf', '90', '', '65498', 'event'),
(18, 'California', 'West Sacramento', '900 Simon Terrace', '63', '95605', 'event'),
(19, 'California', 'West Sacramento', '900 Simon Terrace', '63', '95605', 'event'),
(20, 'California', 'West Sacramento', '900 Simon Terrace', '63', '95605', 'event'),
(21, 'California', 'West Sacramento', '900 Simon Terrace', '63', '95605', 'event');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id_event` smallint(6) NOT NULL COMMENT 'events id',
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time DEFAULT NULL,
  `img` varchar(511) DEFAULT NULL,
  `location_id` smallint(6) NOT NULL,
  `description` text DEFAULT NULL,
  `base_price` decimal(8,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id_event`, `name`, `date`, `start_time`, `end_time`, `img`, `location_id`, `description`, `base_price`) VALUES
(1, 'Night 1: Symphonic Orchestra The Beginning', '2025-05-08', '20:00:00', NULL, 'public/upload/67d7a9c3db350AdobeStock_71758726.jpg', 1, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Festival Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Performance by \\\"The Beginning Symphony Orchestra\\\"\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Solo Piano Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Elizabeth Hardy\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Preview of the next night (Orchestral Music)\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 10.13),
(2, 'Night 2: Orchestral Music \"Symphony and Orchestra\"', '2025-05-09', '20:00:00', NULL, 'public/upload/67d7ac1333326night2.jpg', 2, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Performance by \\\"Artoville Grand Orchestra\\\"\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Violin Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Antonio Marco\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Preview of the next night (Chamber Music)\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 20.00),
(3, 'Night 3: Chamber Music \"Personal Moments\"', '2025-05-10', '20:00:00', NULL, 'public/upload/67d7aff206a1dnight3.jpg', 3, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Performance by \\\"The Four Musicians\\\" Chamber Group\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Solo Piano Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Maria O\'Hara\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Preview of the next night (Opera Music)\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 30.00),
(4, 'Night 4: Opera Music \"Magic and Enchantment\"', '2025-05-11', '20:00:00', NULL, 'public/upload/67d7b0d767902night4.jpg', 4, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Performance by \\\"Artoville Opera Group\\\"\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Solo Vocal Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Clara Cruz\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Preview of the next night (Piano Music)\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 40.00),
(5, 'Night 5: Piano Music \"Piano Magic\"', '2025-05-12', '20:00:00', NULL, 'public/upload/67d7b188f045anight5.jpg', 5, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Solo Piano Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Sergei Rishikov\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Piano Duet by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Gina and Lucas Thorne\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Preview of the next night (Medieval Music)\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 50.00),
(6, 'Night 6: Medieval Music \"Shadows and Light\"', '2025-05-13', '20:00:00', NULL, 'public/upload/67d7b2b723c46night6.jpg', 6, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Performance by \\\"Voices of the Middle Ages\\\"\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Solo Vocal Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Mariana Dosanto\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Preview of the next night (Contemporary Music)\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 75.00),
(7, 'Night 7: Contemporary Music \"New Art\"', '2025-05-14', '20:00:00', NULL, 'public/upload/67d7b34e68629night7.jpg', 7, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Performance by \\\"Artoville Contemporary Music Group\\\"\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Solo Piano Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Leila Bourchard\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Closing Ceremony and Farewell\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 75.00),
(23, 'Night 1: Symphonic Orchestra The Beginning', '2025-05-08', '20:00:00', NULL, 'public/upload/67d7a9c3db350AdobeStock_71758726.jpg', 1, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Festival Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Performance by \\\"The Beginning Symphony Orchestra\\\"\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Solo Piano Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Elizabeth Hardy\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Preview of the next night (Orchestral Music)\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 10.13),
(24, 'Night 2: Orchestral Music \"Symphony and Orchestra\"', '2025-05-09', '20:00:00', NULL, 'public/upload/67d7ac1333326night2.jpg', 2, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Performance by \\\"Artoville Grand Orchestra\\\"\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Violin Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Antonio Marco\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Preview of the next night (Chamber Music)\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 20.00),
(25, 'Night 3: Chamber Music \"Personal Moments\"', '2025-05-10', '20:00:00', NULL, 'public/upload/67d7aff206a1dnight3.jpg', 3, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Performance by \\\"The Four Musicians\\\" Chamber Group\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Solo Piano Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Maria O\'Hara\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Preview of the next night (Opera Music)\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 30.00),
(26, 'Night 4: Opera Music \"Magic and Enchantment\"', '2025-05-11', '20:00:00', NULL, 'public/upload/67d7b0d767902night4.jpg', 4, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Performance by \\\"Artoville Opera Group\\\"\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Solo Vocal Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Clara Cruz\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Preview of the next night (Piano Music)\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 40.00),
(27, 'Night 5: Piano Music \"Piano Magic\"', '2025-05-12', '20:00:00', NULL, 'public/upload/67d7b188f045anight5.jpg', 5, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Solo Piano Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Sergei Rishikov\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Piano Duet by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Gina and Lucas Thorne\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Preview of the next night (Medieval Music)\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 50.00),
(28, 'Night 6: Medieval Music \"Shadows and Light\"', '2025-05-13', '20:00:00', NULL, 'public/upload/67d7b2b723c46night6.jpg', 6, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Performance by \\\"Voices of the Middle Ages\\\"\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Solo Vocal Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Mariana Dosanto\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Preview of the next night (Contemporary Music)\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 75.00),
(29, 'Night 7: Contemporary Music \"New Art\"', '2025-05-14', '20:00:00', NULL, 'public/upload/67d7b34e68629night7.jpg', 7, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Performance by \\\"Artoville Contemporary Music Group\\\"\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Solo Piano Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Leila Bourchard\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Closing Ceremony and Farewell\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 75.00),
(30, 'Night 1: Symphonic Orchestra The Beginning', '2025-05-08', '20:00:00', NULL, 'public/upload/67d7a9c3db350AdobeStock_71758726.jpg', 1, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Festival Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Performance by \\\"The Beginning Symphony Orchestra\\\"\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Solo Piano Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Elizabeth Hardy\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Preview of the next night (Orchestral Music)\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 10.13),
(31, 'Night 2: Orchestral Music \"Symphony and Orchestra\"', '2025-05-09', '20:00:00', NULL, 'public/upload/67d7ac1333326night2.jpg', 2, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Performance by \\\"Artoville Grand Orchestra\\\"\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Violin Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Antonio Marco\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Preview of the next night (Chamber Music)\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 20.00),
(32, 'Night 3: Chamber Music \"Personal Moments\"', '2025-05-10', '20:00:00', NULL, 'public/upload/67d7aff206a1dnight3.jpg', 3, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Performance by \\\"The Four Musicians\\\" Chamber Group\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Solo Piano Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Maria O\'Hara\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Preview of the next night (Opera Music)\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 30.00),
(33, 'Night 4: Opera Music \"Magic and Enchantment\"', '2025-05-11', '20:00:00', NULL, 'public/upload/67d7b0d767902night4.jpg', 4, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Performance by \\\"Artoville Opera Group\\\"\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Solo Vocal Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Clara Cruz\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Preview of the next night (Piano Music)\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 40.00),
(34, 'Night 5: Piano Music \"Piano Magic\"', '2025-05-12', '20:00:00', NULL, 'public/upload/67d7b188f045anight5.jpg', 5, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Solo Piano Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Sergei Rishikov\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Piano Duet by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Gina and Lucas Thorne\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Preview of the next night (Medieval Music)\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 50.00),
(35, 'Night 6: Medieval Music \"Shadows and Light\"', '2025-05-13', '20:00:00', NULL, 'public/upload/67d7b2b723c46night6.jpg', 6, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Performance by \\\"Voices of the Middle Ages\\\"\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Solo Vocal Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Mariana Dosanto\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Preview of the next night (Contemporary Music)\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 75.00),
(36, 'Night 7: Contemporary Music \"New Art\"', '2025-05-14', '20:00:00', NULL, 'public/upload/67d7b34e68629night7.jpg', 7, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Performance by \\\"Artoville Contemporary Music Group\\\"\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Solo Piano Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Leila Bourchard\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Closing Ceremony and Farewell\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 75.00),
(37, 'Night 1: Symphonic Orchestra The Beginning', '2025-05-08', '20:00:00', NULL, 'public/upload/67d7a9c3db350AdobeStock_71758726.jpg', 1, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Festival Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Performance by \\\"The Beginning Symphony Orchestra\\\"\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Solo Piano Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Elizabeth Hardy\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Preview of the next night (Orchestral Music)\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 10.13),
(38, 'Night 2: Orchestral Music \"Symphony and Orchestra\"', '2025-05-09', '20:00:00', NULL, 'public/upload/67d7ac1333326night2.jpg', 2, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Performance by \\\"Artoville Grand Orchestra\\\"\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Violin Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Antonio Marco\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Preview of the next night (Chamber Music)\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 20.00),
(39, 'Night 3: Chamber Music \"Personal Moments\"', '2025-05-10', '20:00:00', NULL, 'public/upload/67d7aff206a1dnight3.jpg', 3, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Performance by \\\"The Four Musicians\\\" Chamber Group\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Solo Piano Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Maria O\'Hara\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Preview of the next night (Opera Music)\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 30.00),
(40, 'Night 4: Opera Music \"Magic and Enchantment\"', '2025-05-11', '20:00:00', NULL, 'public/upload/67d7b0d767902night4.jpg', 4, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Performance by \\\"Artoville Opera Group\\\"\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Solo Vocal Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Clara Cruz\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Preview of the next night (Piano Music)\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 40.00),
(41, 'Night 5: Piano Music \"Piano Magic\"', '2025-05-12', '20:00:00', NULL, 'public/upload/67d7b188f045anight5.jpg', 5, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Solo Piano Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Sergei Rishikov\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Piano Duet by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Gina and Lucas Thorne\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Preview of the next night (Medieval Music)\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 50.00),
(42, 'Night 6: Medieval Music \"Shadows and Light\"', '2025-05-13', '20:00:00', NULL, 'public/upload/67d7b2b723c46night6.jpg', 6, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Performance by \\\"Voices of the Middle Ages\\\"\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Solo Vocal Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Mariana Dosanto\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Preview of the next night (Contemporary Music)\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 75.00),
(43, 'Night 7: Contemporary Music \"New Art\"', '2025-05-14', '20:00:00', NULL, 'public/upload/67d7b34e68629night7.jpg', 7, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Performance by \\\"Artoville Contemporary Music Group\\\"\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Solo Piano Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Leila Bourchard\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Closing Ceremony and Farewell\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 75.00),
(44, 'Night 1: Symphonic Orchestra The Beginning', '2025-05-08', '20:00:00', NULL, 'public/upload/67d7a9c3db350AdobeStock_71758726.jpg', 1, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Festival Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Performance by \\\"The Beginning Symphony Orchestra\\\"\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Solo Piano Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Elizabeth Hardy\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Preview of the next night (Orchestral Music)\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 10.13),
(45, 'Night 2: Orchestral Music \"Symphony and Orchestra\"', '2025-05-09', '20:00:00', NULL, 'public/upload/67d7ac1333326night2.jpg', 2, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Performance by \\\"Artoville Grand Orchestra\\\"\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Violin Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Antonio Marco\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Preview of the next night (Chamber Music)\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 20.00),
(46, 'Night 3: Chamber Music \"Personal Moments\"', '2025-05-10', '20:00:00', NULL, 'public/upload/67d7aff206a1dnight3.jpg', 3, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Performance by \\\"The Four Musicians\\\" Chamber Group\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Solo Piano Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Maria O\'Hara\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Preview of the next night (Opera Music)\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 30.00),
(47, 'Night 4: Opera Music \"Magic and Enchantment\"', '2025-05-11', '20:00:00', NULL, 'public/upload/67d7b0d767902night4.jpg', 4, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Performance by \\\"Artoville Opera Group\\\"\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Solo Vocal Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Clara Cruz\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Preview of the next night (Piano Music)\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 40.00),
(48, 'Night 5: Piano Music \"Piano Magic\"', '2025-05-12', '20:00:00', NULL, 'public/upload/67d7b188f045anight5.jpg', 5, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Solo Piano Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Sergei Rishikov\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Piano Duet by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Gina and Lucas Thorne\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Preview of the next night (Medieval Music)\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 50.00),
(49, 'Night 6: Medieval Music \"Shadows and Light\"', '2025-05-13', '20:00:00', NULL, 'public/upload/67d7b2b723c46night6.jpg', 6, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Performance by \\\"Voices of the Middle Ages\\\"\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Solo Vocal Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Mariana Dosanto\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Preview of the next night (Contemporary Music)\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 75.00),
(50, 'Night 7: Contemporary Music \"New Art\"', '2025-05-14', '20:00:00', NULL, 'public/upload/67d7b34e68629night7.jpg', 7, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Performance by \\\"Artoville Contemporary Music Group\\\"\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Solo Piano Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Leila Bourchard\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Closing Ceremony and Farewell\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 75.00),
(51, 'Night 1: Symphonic Orchestra The Beginning', '2025-05-08', '20:00:00', NULL, 'public/upload/67d7a9c3db350AdobeStock_71758726.jpg', 1, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Festival Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Performance by \\\"The Beginning Symphony Orchestra\\\"\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Solo Piano Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Elizabeth Hardy\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Preview of the next night (Orchestral Music)\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 10.13),
(52, 'Night 2: Orchestral Music \"Symphony and Orchestra\"', '2025-05-09', '20:00:00', NULL, 'public/upload/67d7ac1333326night2.jpg', 2, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Performance by \\\"Artoville Grand Orchestra\\\"\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Violin Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Antonio Marco\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Preview of the next night (Chamber Music)\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 20.00),
(53, 'Night 3: Chamber Music \"Personal Moments\"', '2025-05-10', '20:00:00', NULL, 'public/upload/67d7aff206a1dnight3.jpg', 3, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Performance by \\\"The Four Musicians\\\" Chamber Group\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Solo Piano Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Maria O\'Hara\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Preview of the next night (Opera Music)\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 30.00),
(54, 'Night 4: Opera Music \"Magic and Enchantment\"', '2025-05-11', '20:00:00', NULL, 'public/upload/67d7b0d767902night4.jpg', 4, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Performance by \\\"Artoville Opera Group\\\"\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Solo Vocal Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Clara Cruz\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Preview of the next night (Piano Music)\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 40.00),
(55, 'Night 5: Piano Music \"Piano Magic\"', '2025-05-12', '20:00:00', NULL, 'public/upload/67d7b188f045anight5.jpg', 5, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Solo Piano Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Sergei Rishikov\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Piano Duet by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Gina and Lucas Thorne\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Preview of the next night (Medieval Music)\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 50.00),
(56, 'Night 6: Medieval Music \"Shadows and Light\"', '2025-05-13', '20:00:00', NULL, 'public/upload/67d7b2b723c46night6.jpg', 6, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Performance by \\\"Voices of the Middle Ages\\\"\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Solo Vocal Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Mariana Dosanto\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Preview of the next night (Contemporary Music)\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 75.00),
(57, 'Night 7: Contemporary Music \"New Art\"', '2025-05-14', '20:00:00', NULL, 'public/upload/67d7b34e68629night7.jpg', 7, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Performance by \\\"Artoville Contemporary Music Group\\\"\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Solo Piano Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Leila Bourchard\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Closing Ceremony and Farewell\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 75.00);
INSERT INTO `events` (`id_event`, `name`, `date`, `start_time`, `end_time`, `img`, `location_id`, `description`, `base_price`) VALUES
(58, 'Night 1: Symphonic Orchestra The Beginning', '2025-05-08', '20:00:00', NULL, 'public/upload/67d7a9c3db350AdobeStock_71758726.jpg', 1, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Festival Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Performance by \\\"The Beginning Symphony Orchestra\\\"\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Solo Piano Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Elizabeth Hardy\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Preview of the next night (Orchestral Music)\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 10.13),
(59, 'Night 2: Orchestral Music \"Symphony and Orchestra\"', '2025-05-09', '20:00:00', NULL, 'public/upload/67d7ac1333326night2.jpg', 2, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Performance by \\\"Artoville Grand Orchestra\\\"\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Violin Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Antonio Marco\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Preview of the next night (Chamber Music)\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 20.00),
(60, 'Night 3: Chamber Music \"Personal Moments\"', '2025-05-10', '20:00:00', NULL, 'public/upload/67d7aff206a1dnight3.jpg', 3, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"8:00 PM - 8:30 PM:\"},{\"insert\":\" Welcome and Introduction\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"8:30 PM - 10:00 PM:\"},{\"insert\":\" Performance by \\\"The Four Musicians\\\" Chamber Group\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:00 PM - 10:15 PM:\"},{\"insert\":\" Break\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:15 PM - 10:45 PM:\"},{\"insert\":\" Solo Piano Performance by \"},{\"attributes\":{\"bold\":true},\"insert\":\"Maria O\'Hara\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"10:45 PM - 11:00 PM:\"},{\"insert\":\" Preview of the next night (Opera Music)\"},{\"attributes\":{\"indent\":1,\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 30.00);

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `id_seat` smallint(6) NOT NULL,
  `seat_type` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`id_seat`, `seat_type`) VALUES
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id_ticket` mediumint(9) NOT NULL COMMENT 'id primary key',
  `guest_fname` int(11) DEFAULT NULL,
  `guest_lname` int(11) DEFAULT NULL,
  `purchase_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_seat` smallint(6) NOT NULL,
  `id_event` smallint(6) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL COMMENT 'user id',
  `fname` varchar(50) NOT NULL COMMENT 'first name',
  `lname` varchar(50) NOT NULL COMMENT 'last name',
  `prefix` enum('Mr.','Mrs.','Miss.','Ms.') DEFAULT NULL COMMENT 'prefix / title',
  `email` varchar(100) NOT NULL COMMENT 'email',
  `password` varchar(255) NOT NULL COMMENT 'password - users',
  `phone` varchar(16) DEFAULT NULL COMMENT 'phone number',
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'update / create time',
  `privilege_level` tinyint(4) NOT NULL DEFAULT 0,
  `img_path` varchar(1024) NOT NULL DEFAULT 'public/upload/notset2.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `fname`, `lname`, `prefix`, `email`, `password`, `phone`, `create_at`, `privilege_level`, `img_path`) VALUES
(5, 'Mohammad', 'Ansari', NULL, 'admin@admin.com', '$2y$10$Zr6RIkTynk9.4IFkpfb43Oi15MUPurJDacaTl3pFEfoTQnBRI9K1K', '2076151337', '2025-03-02 21:41:40', 5, 'public/upload/notset2.png'),
(25, 'New admin', 'New', NULL, 'new@admin.com', '$2y$10$ap7STD5SBqEnynatPhVlkemfkcXmSsW2lxhcBNKMoEq.QCq1VkpAq', '2076151337', '2025-03-06 21:54:47', 5, 'public/upload/notset2.png'),
(28, 'Mohammad', 'Ansari', NULL, 'paytakhtdota12312312@gmail.com', '$2y$10$TT2zykC/r76pLbzDj50KaObl1cHLB.zG.Xi6azBoCJ5nR/N2hXdFa', '2076151337', '2025-03-07 07:26:36', 4, 'public/upload/notset2.png'),
(29, 'Mohammad', 'Ansari', NULL, 'paytakht234234234dota@gmail.com', '$2y$10$Jn2KFd4.Qrv9UpNJmwv4We9CEqIPSPib/YUBKfnx/lRVzuETzXrMu', '2076151337', '2025-03-07 07:29:43', 4, 'public/upload/notset2.png'),
(31, 'Mohammad', 'Ansari2', NULL, 'paytsadfasdfakhtdota@gmail.com', '$2y$10$oOzrfO79/E1kdgLYe62T.ukCcMBr1SzfiUiO/2CyNVdJNJzpiw4t.', '2076151337', '2025-03-07 08:05:23', 0, 'public/upload/notset2.png'),
(32, 'Mohammad', 'Ansari', NULL, 'takhtasddota@gmail.com', '$2y$10$1JlUqBY7qAhhyNSnwsnjEu4MuHIwqW67.7ekIKmCedOvd3NxAO0YW', '2076151337', '2025-03-07 08:10:15', 0, 'public/upload/notset2.png'),
(35, 'Test', 'Test', NULL, 'user@user.com', '$2y$10$hglBCThy2NaE9.dJyjU2m.cp55XX0LvOvTvgmuyw4nGLGZJ6ppl3q', '916 000 1234', '2025-03-09 19:32:39', 0, 'public/upload/notset2.png'),
(36, 'User', 'Test', NULL, 'test@test', '$2y$10$gdJV0Wj.kLde8Mgm3IwLrOtylIEyiDwkW8bhtrH.FclVq8bH2HHV6', '207222123123', '2025-03-15 20:33:01', 0, 'public/upload/67e64da19a547profile-2.jpg'),
(38, 'Mohammad', 'Ansari', NULL, 'paytakhtdota@gmail.com', '$2y$10$aZzoJS4QQZcKP1YV.J0HT.qDTMozA5StoIzUf6j0utyegCP.NFSlW', '2076151337', '2025-03-29 22:54:04', 4, 'public/upload/notset2.png'),
(39, 'Mohammad', 'Ansari', NULL, 'pay123123@gmail.com', '$2y$10$xCckYp04AtuyQimTPh.v/.UFbSt0ix3ScquyadS6h1TXMOoPrF5VO', '2076151337', '2025-03-29 23:43:33', 4, 'public/upload/notset2.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id_event`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`id_seat`) USING BTREE;

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id_ticket`),
  ADD UNIQUE KEY `ticket_seat` (`id_event`,`id_seat`),
  ADD KEY `id_seat` (`id_seat`),
  ADD KEY `tickets_ibfk_1` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `location_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id_event` smallint(6) NOT NULL AUTO_INCREMENT COMMENT 'events id', AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id_ticket` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT 'id primary key';

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT COMMENT 'user id', AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `address` (`location_id`);

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`id_seat`) REFERENCES `seats` (`id_seat`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tickets_ibfk_3` FOREIGN KEY (`id_event`) REFERENCES `events` (`id_event`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
