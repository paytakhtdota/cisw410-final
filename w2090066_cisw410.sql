-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2025 at 06:32 PM
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
-- Database: `w2090066_cisw410`
--
CREATE DATABASE IF NOT EXISTS `w2090066_cisw410` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `w2090066_cisw410`;

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
(1, 'California', 'Sacramento', '1110 2nd St', '', '95605', 'event'),
(2, 'California', 'Sacramento', '1110 2nd St', '', '95605', 'event'),
(3, 'California', 'Sacramento', '1110 2nd St', '', '95814', 'event'),
(4, 'California', 'Sacramento', '1110 2nd St', '', '95814', 'event'),
(5, 'California', 'Sacramento', '1110 2nd St', '', '95814', 'event'),
(6, 'California', 'Sacramento', '1110 2nd St', '', '95814', 'event'),
(7, 'California', 'Sacramento', '1110 2nd St', '', '95814', 'event'),
(8, 'California', 'San Diego', '500 Sunset Blvd', NULL, '92101', 'event'),
(9, 'New York', 'Manhattan', '350 5th Ave', 'Apt 10B', '10018', 'event'),
(10, 'Texas', 'Houston', '123 Bay Area Blvd', NULL, '77058', 'event'),
(11, 'Florida', 'Tampa', '789 Beach Dr', 'Unit 5A', '33602', 'event'),
(12, 'Illinois', 'Peoria', '456 River Rd', NULL, '61602', 'event'),
(13, 'Nevada', 'Carson City', '777 Silver St', 'Floor 3', '89701', 'event'),
(14, 'Washington', 'Tacoma', '888 Pacific Ave', NULL, '98402', 'event'),
(15, 'Oregon', 'Salem', '999 State St', 'Suite 2', '97301', 'event'),
(16, 'Arizona', 'Scottsdale', '111 Fashion Blvd', NULL, '85251', 'event'),
(17, 'Colorado', 'Colorado Springs', '222 Garden Rd', 'Room 7', '80903', 'event'),
(18, 'Georgia', 'Atlanta', '333 Peach St', NULL, '30303', 'event'),
(19, 'North Carolina', 'Charlotte', '444 Queen City Rd', 'Unit 8', '28202', 'event'),
(20, 'Ohio', 'Cincinnati', '555 Skyline Dr', NULL, '45202', 'event'),
(21, 'Michigan', 'Detroit', '666 Motor St', 'Apt 6C', '48226', 'event'),
(22, 'Pennsylvania', 'Philadelphia', '777 Liberty Ave', NULL, '19102', 'event'),
(23, 'Tennessee', 'Nashville', '500 Music Row', NULL, '37203', 'event'),
(24, 'Massachusetts', 'Boston', '123 Freedom Trail', 'Suite 5', '02108', 'event'),
(25, 'California', 'San Francisco', '100 Golden Gate Ave', NULL, '94102', 'event'),
(26, 'New York', 'Brooklyn', '250 Park Ave', 'Suite 10', '11201', 'event'),
(27, 'Texas', 'Dallas', '500 Elm St', 'Apt 3B', '75202', 'event'),
(28, 'Florida', 'Orlando', '350 Magic Rd', NULL, '32801', 'event'),
(29, 'Illinois', 'Springfield', '120 Capitol Ave', 'Unit 7', '62701', 'event'),
(30, 'Nevada', 'Reno', '777 Casino St', NULL, '89501', 'event'),
(31, 'Washington', 'Spokane', '888 River Rd', 'Floor 2', '99201', 'event'),
(32, 'Oregon', 'Eugene', '999 Oak St', 'Room 5', '97401', 'event'),
(33, 'Arizona', 'Tucson', '111 Desert Ave', NULL, '85701', 'event'),
(34, 'Colorado', 'Boulder', '222 University Blvd', 'Suite 4', '80301', 'event'),
(35, 'Missouri', 'Kansas City', '456 BBQ St', NULL, '64108', 'event');

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
(61, 'Jazz Night', '2025-07-15', '19:00:00', '22:00:00', 'public/upload/img11.jpg', 25, '{\"ops\": [{\"insert\": \"A relaxing jazz concert.\"}]}', 55.00),
(62, 'Startup Pitch', '2025-09-20', '10:00:00', '16:00:00', 'public/upload/img12.jpg', 26, '{\"ops\": [{\"insert\": \"Innovative startups presenting ideas.\"}]}', 30.00),
(63, 'Food Truck Festival', '2025-06-10', '11:00:00', '21:00:00', 'public/upload/img13.jpg', 27, '{\"ops\": [{\"insert\": \"Tasty treats from the best food trucks.\"}]}', 20.00),
(64, 'Art & Wine Evening', '2025-08-25', '18:00:00', '22:30:00', 'public/upload/img14.jpg', 28, '{\"ops\": [{\"insert\": \"Enjoy fine art with great wine.\"}]}', 45.00),
(65, 'E-Sports Tournament', '2025-10-05', '12:00:00', '23:00:00', 'public/upload/img15.jpg', 29, '{\"ops\": [{\"insert\": \"Compete in the biggest gaming event.\"}]}', 70.00),
(66, 'Fitness Bootcamp', '2025-04-23', '07:00:00', '11:00:00', 'public/upload/img16.jpg', 30, '{\"ops\": [{\"insert\": \"Get fit with expert trainers.\"}]}', 25.00),
(67, 'Stand-up Comedy', '2025-05-22', '20:00:00', '23:00:00', 'public/upload/img17.jpg', 31, '{\"ops\": [{\"insert\": \"A night full of laughs and fun.\"}]}', 40.00),
(68, 'Tech Expo', '2025-11-08', '09:00:00', '17:00:00', 'public/upload/img18.jpg', 32, '{\"ops\": [{\"insert\": \"Latest technology innovations showcased.\"}]}', 100.00),
(69, 'Poetry Slam', '2025-05-02', '18:30:00', '21:30:00', 'public/upload/img19.jpg', 33, '{\"ops\": [{\"insert\": \"Poets from around the country perform live.\"}]}', 15.00),
(70, 'Rock Concert', '2025-12-18', '20:00:00', '23:30:00', 'public/upload/img20.jpg', 34, '{\"ops\": [{\"insert\": \"Live rock music with famous bands.\"}]}', 60.00),
(71, 'Tech Summit', '2025-06-12', '09:00:00', '17:00:00', 'public/upload/img1.jpg', 1, '{\"ops\": [{\"insert\": \"Tech leaders share their insights.\"}]}', 150.00),
(72, 'Classical Concert', '2025-07-20', '19:00:00', '21:30:00', 'public/upload/img2.jpg', 2, '{\"ops\": [{\"insert\": \"A night of beautiful classical music.\"}]}', 80.00),
(73, 'Food Festival', '2025-08-15', '11:00:00', '20:00:00', 'public/upload/img3.jpg', 3, '{\"ops\": [{\"insert\": \"Enjoy food from the best local vendors.\"}]}', 20.00),
(74, 'Art Gallery Opening', '2025-05-22', '18:00:00', '22:00:00', 'public/upload/img4.jpg', 4, '{\"ops\": [{\"insert\": \"Discover the latest art trends.\"}]}', 25.00),
(75, 'Science Exhibition', '2025-09-15', '10:00:00', '18:00:00', 'public/upload/img5.jpg', 5, '{\"ops\": [{\"insert\": \"Explore the wonders of science.\"}]}', 30.00),
(76, 'Gaming Tournament', '2025-06-30', '12:00:00', '22:00:00', 'public/upload/img6.jpg', 6, '{\"ops\": [{\"insert\": \"The ultimate e-sports showdown!\"}]}', 40.00),
(77, 'Comedy Show', '2025-10-10', '20:00:00', '23:00:00', 'public/upload/img7.jpg', 7, '{\"ops\": [{\"insert\": \"Laugh out loud with top comedians.\"}]}', 50.00),
(78, 'Music Festival', '2025-07-05', '14:00:00', '23:00:00', 'public/upload/img8.jpg', 8, '{\"ops\": [{\"insert\": \"Live performances by local bands.\"}]}', 60.00),
(79, 'Literature Conference', '2025-11-01', '09:00:00', '17:00:00', 'public/upload/img9.jpg', 9, '{\"ops\": [{\"insert\": \"For those passionate about literature.\"}]}', 35.00),
(80, 'International Dance Festival', '2025-12-12', '17:00:00', '22:00:00', 'public/upload/img10.jpg', 10, '{\"ops\": [{\"insert\": \"Experience cultures through dance.\"}]}', 55.00),
(81, 'Fashion Show', '2025-09-30', '18:00:00', '21:00:00', 'public/upload/img11.jpg', 11, '{\"ops\": [{\"insert\": \"Watch top designers showcase their latest collections.\"}]}', 100.00),
(82, 'Tech Innovation Expo', '2025-08-18', '10:00:00', '18:00:00', 'public/upload/img12.jpg', 12, '{\"ops\": [{\"insert\": \"See the future of technology.\"}]}', 150.00),
(83, 'Photography Workshop', '2025-10-05', '09:00:00', '16:00:00', 'public/upload/img13.jpg', 13, '{\"ops\": [{\"insert\": \"Learn from professional photographers.\"}]}', 45.00),
(84, 'Cultural Festival', '2025-09-25', '12:00:00', '18:00:00', 'public/upload/img14.jpg', 14, '{\"ops\": [{\"insert\": \"Celebrate cultural diversity through music, food, and art.\"}]}', 30.00),
(85, 'Wine Tasting', '2025-07-25', '17:00:00', '21:00:00', 'public/upload/img15.jpg', 15, '{\"ops\": [{\"insert\": \"Sample the finest wines.\"}]}', 70.00),
(86, 'Mountain Trekking Event', '2025-06-20', '06:00:00', '18:00:00', 'public/upload/img16.jpg', 16, '{\"ops\": [{\"insert\": \"Join us for an adventurous mountain trek.\"}]}', 60.00),
(87, 'Charity Gala', '2025-12-05', '19:00:00', '23:00:00', 'public/upload/img17.jpg', 17, '{\"ops\": [{\"insert\": \"A glamorous night to raise funds for a great cause.\"}]}', 120.00),
(88, 'Beer Festival', '2025-11-20', '14:00:00', '20:00:00', 'public/upload/img18.jpg', 18, '{\"ops\": [{\"insert\": \"Taste a variety of craft beers from around the world.\"}]}', 25.00),
(89, 'Farmers Market', '2025-05-18', '08:00:00', '14:00:00', 'public/upload/img19.jpg', 19, '{\"ops\": [{\"insert\": \"Buy fresh local produce and handmade goods.\"}]}', 10.00),
(90, 'Fashion Week', '2025-10-15', '10:00:00', '18:00:00', 'public/upload/img20.jpg', 35, '{\"ops\": [{\"insert\": \"The latest trends from top designers.\"}]}', 80.00),
(91, 'Music Innovation Summit', '2025-07-15', '09:00:00', '17:00:00', 'public/upload/img15.jpg', 2, '{\"ops\": [{\"insert\": \"Explore the latest trends in music technology.\"}]}', 100.00),
(92, 'Photography Exhibition', '2025-08-23', '18:00:00', '22:00:00', 'public/upload/img12.jpg', 3, '{\"ops\": [{\"insert\": \"A showcase of breathtaking photography from local artists.\"}]}', 40.00),
(93, 'Tech Conference', '2025-11-05', '10:00:00', '18:00:00', 'public/upload/img5.jpg', 4, '{\"ops\": [{\"insert\": \"Join the industry leaders at the biggest tech conference of the year.\"}]}', 150.00),
(94, 'Halloween Party', '2025-10-31', '20:00:00', '23:59:59', 'public/upload/img18.jpg', 5, '{\"ops\": [{\"insert\": \"A spooky night of fun and frights!\"}]}', 25.00),
(95, 'Health and Fitness Expo', '2025-06-10', '08:00:00', '18:00:00', 'public/upload/img9.jpg', 6, '{\"ops\": [{\"insert\": \"Get inspired to live a healthier life.\"}]}', 30.00),
(96, 'Jazz Night', '2025-08-14', '19:00:00', '22:00:00', 'public/upload/img6.jpg', 7, '{\"ops\": [{\"insert\": \"Enjoy a night of smooth jazz.\"}]}', 50.00),
(97, 'Cooking Masterclass', '2025-09-22', '11:00:00', '16:00:00', 'public/upload/img3.jpg', 8, '{\"ops\": [{\"insert\": \"Learn how to cook like a pro!\"}]}', 45.00),
(98, 'Sculpture Show', '2025-12-07', '10:00:00', '16:00:00', 'public/upload/img20.jpg', 9, '{\"ops\": [{\"insert\": \"Marvel at sculptures from renowned artists.\"}]}', 60.00),
(99, 'Open Mic Night', '2025-10-03', '20:00:00', '23:00:00', 'public/upload/img13.jpg', 10, '{\"ops\": [{\"insert\": \"Come perform or enjoy live performances!\"}]}', 15.00),
(100, 'Fashion Design Workshop', '2025-07-12', '09:00:00', '17:00:00', 'public/upload/img10.jpg', 11, '{\"ops\": [{\"insert\": \"A day dedicated to fashion design and creativity.\"}]}', 75.00),
(101, 'Art and Craft Fair', '2025-06-05', '10:00:00', '18:00:00', 'public/upload/img4.jpg', 12, '{\"ops\": [{\"insert\": \"Explore art and crafts from local creators.\"}]}', 20.00),
(102, 'Poetry Reading', '2025-09-18', '18:00:00', '21:00:00', 'public/upload/img2.jpg', 13, '{\"ops\": [{\"insert\": \"Listen to powerful poems from emerging poets.\"}]}', 25.00),
(103, 'Modern Dance Performance', '2025-07-25', '19:00:00', '22:00:00', 'public/upload/img17.jpg', 14, '{\"ops\": [{\"insert\": \"A captivating modern dance performance.\"}]}', 55.00),
(104, 'Craft Beer Tasting', '2025-08-30', '16:00:00', '20:00:00', 'public/upload/img7.jpg', 15, '{\"ops\": [{\"insert\": \"Taste a variety of craft beers from local brewers.\"}]}', 40.00),
(105, 'Shakespeare in the Park', '2025-06-12', '19:00:00', '22:00:00', 'public/upload/img14.jpg', 16, '{\"ops\": [{\"insert\": \"Enjoy a classic Shakespeare play in the open air.\"}]}', 35.00),
(106, 'Coding Bootcamp', '2025-09-01', '08:00:00', '17:00:00', 'public/upload/img11.jpg', 17, '{\"ops\": [{\"insert\": \"Join a coding bootcamp to learn web development.\"}]}', 200.00),
(107, 'Magic Show', '2025-10-09', '19:00:00', '21:00:00', 'public/upload/img8.jpg', 18, '{\"ops\": [{\"insert\": \"A night of mind-blowing magic and illusions.\"}]}', 60.00),
(108, 'Street Art Festival', '2025-07-21', '12:00:00', '18:00:00', 'public/upload/img16.jpg', 19, '{\"ops\": [{\"insert\": \"Discover the best street art in the city.\"}]}', 20.00),
(109, 'Film Screening', '2025-08-09', '18:00:00', '21:00:00', 'public/upload/img1.jpg', 20, '{\"ops\": [{\"insert\": \"Watch critically acclaimed films with live discussions.\"}]}', 30.00),
(110, 'Literature Book Fair', '2025-09-28', '10:00:00', '17:00:00', 'public/upload/img19.jpg', 21, '{\"ops\": [{\"insert\": \"Meet authors and get your books signed.\"}]}', 40.00),
(111, 'Startup Pitching Event', '2025-10-20', '09:00:00', '17:00:00', 'public/upload/img8.jpg', 2, '{\"ops\": [{\"insert\": \"Witness the next big ideas in the startup world.\"}]}', 120.00),
(112, 'Christmas Gala', '2025-12-24', '19:00:00', '23:59:59', 'public/upload/img3.jpg', 3, '{\"ops\": [{\"insert\": \"A festive evening with music, dance, and celebration.\"}]}', 200.00),
(113, 'Digital Art Exhibition', '2025-11-15', '17:00:00', '21:00:00', 'public/upload/img1.jpg', 4, '{\"ops\": [{\"insert\": \"Explore the beauty of digital art.\"}]}', 50.00),
(114, 'Outdoor Cinema', '2025-07-19', '20:00:00', '23:00:00', 'public/upload/img17.jpg', 5, '{\"ops\": [{\"insert\": \"Enjoy a movie under the stars.\"}]}', 10.00),
(115, 'Charity Run', '2025-06-01', '07:00:00', '11:00:00', 'public/upload/img4.jpg', 6, '{\"ops\": [{\"insert\": \"Run for a cause and make a difference.\"}]}', 15.00),
(116, 'Rock Concert', '2025-09-05', '19:00:00', '22:30:00', 'public/upload/img14.jpg', 7, '{\"ops\": [{\"insert\": \"Feel the power of live rock music!\"}]}', 40.00),
(117, 'Drone Racing', '2025-10-10', '10:00:00', '16:00:00', 'public/upload/img6.jpg', 8, '{\"ops\": [{\"insert\": \"Watch the thrill of high-speed drone racing.\"}]}', 70.00),
(118, 'Virtual Reality Experience', '2025-11-03', '12:00:00', '18:00:00', 'public/upload/img2.jpg', 9, '{\"ops\": [{\"insert\": \"Experience the future with immersive VR experiences.\"}]}', 90.00),
(119, 'Dance Battle', '2025-07-26', '18:00:00', '23:00:00', 'public/upload/img12.jpg', 10, '{\"ops\": [{\"insert\": \"Show off your dance moves at the ultimate dance battle!\"}]}', 30.00),
(120, 'Literary Awards Ceremony', '2025-12-02', '18:00:00', '21:00:00', 'public/upload/img16.jpg', 11, '{\"ops\": [{\"insert\": \"Celebrate the best in literature.\"}]}', 80.00),
(121, 'Comic Book Convention', '2025-08-07', '10:00:00', '18:00:00', 'public/upload/img19.jpg', 12, '{\"ops\": [{\"insert\": \"Meet your favorite comic book artists and writers.\"}]}', 25.00),
(122, 'Business Networking Event', '2025-10-02', '08:00:00', '17:00:00', 'public/upload/img5.jpg', 13, '{\"ops\": [{\"insert\": \"Meet business leaders and grow your network.\"}]}', 100.00),
(123, 'Summer Pool Party', '2025-06-28', '14:00:00', '20:00:00', 'public/upload/img15.jpg', 14, '{\"ops\": [{\"insert\": \"Join us for a refreshing summer pool party.\"}]}', 20.00),
(124, 'Magic and Illusion Show', '2025-07-09', '20:00:00', '22:00:00', 'public/upload/img7.jpg', 15, '{\"ops\": [{\"insert\": \"Enjoy an evening filled with magic and illusions.\"}]}', 60.00),
(125, 'Yoga Retreat', '2025-09-18', '08:00:00', '17:00:00', 'public/upload/img9.jpg', 16, '{\"ops\": [{\"insert\": \"Join us for a day of relaxation and rejuvenation.\"}]}', 40.00),
(126, 'Christmas Craft Fair', '2025-12-10', '10:00:00', '18:00:00', 'public/upload/img18.jpg', 17, '{\"ops\": [{\"insert\": \"Shop for handmade gifts and decorations.\"}]}', 10.00),
(127, 'Spa Day Event', '2025-08-22', '09:00:00', '18:00:00', 'public/upload/img11.jpg', 18, '{\"ops\": [{\"insert\": \"Relax and unwind at our luxurious spa event.\"}]}', 120.00),
(128, 'Jazz and Blues Festival', '2025-09-03', '14:00:00', '22:00:00', 'public/upload/img13.jpg', 19, '{\"ops\": [{\"insert\": \"A celebration of jazz and blues music.\"}]}', 50.00),
(129, 'Tech Startup Showcase', '2025-10-15', '09:00:00', '17:00:00', 'public/upload/img20.jpg', 20, '{\"ops\": [{\"insert\": \"Discover innovative startups and new technology.\"}]}', 150.00),
(130, 'Food Truck Rally', '2025-06-15', '11:00:00', '21:00:00', 'public/upload/img10.jpg', 21, '{\"ops\": [{\"insert\": \"Enjoy delicious food from the best food trucks.\"}]}', 20.00),
(131, 'Tech Talk on AI', '2025-11-25', '14:00:00', '17:00:00', 'public/upload/img3.jpg', 2, '{\"ops\": [{\"insert\": \"Learn about the latest trends in artificial intelligence.\"}]}', 100.00),
(132, 'Classical Music Concert', '2025-10-01', '19:00:00', '22:00:00', 'public/upload/img12.jpg', 3, '{\"ops\": [{\"insert\": \"Enjoy an evening of beautiful classical music.\"}]}', 60.00),
(133, 'Innovation in Robotics', '2025-09-17', '10:00:00', '18:00:00', 'public/upload/img7.jpg', 4, '{\"ops\": [{\"insert\": \"Discover the advancements in robotics technology.\"}]}', 150.00),
(134, 'Literature Festival', '2025-12-05', '09:00:00', '17:00:00', 'public/upload/img17.jpg', 5, '{\"ops\": [{\"insert\": \"A festival celebrating authors, poets, and literature.\"}]}', 80.00),
(135, 'International Art Showcase', '2025-11-10', '18:00:00', '22:00:00', 'public/upload/img9.jpg', 6, '{\"ops\": [{\"insert\": \"Explore art from around the world.\"}]}', 45.00),
(136, 'Foodie Meetup', '2025-08-25', '16:00:00', '20:00:00', 'public/upload/img1.jpg', 7, '{\"ops\": [{\"insert\": \"A gathering for food lovers to explore local cuisines.\"}]}', 30.00),
(137, 'Live Stand-Up Comedy', '2025-09-12', '20:00:00', '22:00:00', 'public/upload/img8.jpg', 8, '{\"ops\": [{\"insert\": \"Get ready to laugh with top stand-up comedians.\"}]}', 40.00),
(138, 'Gourmet Wine Tasting', '2025-10-05', '18:00:00', '22:00:00', 'public/upload/img18.jpg', 9, '{\"ops\": [{\"insert\": \"Taste premium wines and enjoy gourmet bites.\"}]}', 75.00),
(139, 'Book Launch Event', '2025-07-28', '18:00:00', '21:00:00', 'public/upload/img14.jpg', 10, '{\"ops\": [{\"insert\": \"Celebrate the launch of a new book by an exciting author.\"}]}', 20.00),
(140, 'Beach Volleyball Tournament', '2025-08-14', '10:00:00', '16:00:00', 'public/upload/img13.jpg', 11, '{\"ops\": [{\"insert\": \"Compete in a fun and exciting beach volleyball tournament.\"}]}', 10.00),
(141, 'Cosplay Contest', '2025-09-28', '15:00:00', '18:00:00', 'public/upload/img16.jpg', 12, '{\"ops\": [{\"insert\": \"Show off your cosplay skills at our annual contest.\"}]}', 25.00),
(142, 'Charity Gala Dinner', '2025-12-11', '19:00:00', '22:00:00', 'public/upload/img10.jpg', 13, '{\"ops\": [{\"insert\": \"A night of fine dining and charity.\"}]}', 120.00),
(143, 'DIY Craft Workshop', '2025-07-19', '09:00:00', '13:00:00', 'public/upload/img5.jpg', 14, '{\"ops\": [{\"insert\": \"Learn how to create unique handmade crafts.\"}]}', 40.00),
(144, 'Science Fair', '2025-06-30', '10:00:00', '18:00:00', 'public/upload/img19.jpg', 15, '{\"ops\": [{\"insert\": \"A showcase of amazing science projects and experiments.\"}]}', 10.00),
(145, 'Outdoor Adventure', '2025-10-20', '08:00:00', '18:00:00', 'public/upload/img6.jpg', 16, '{\"ops\": [{\"insert\": \"Get outdoors and explore nature with fun activities.\"}]}', 50.00),
(146, 'Jazz Fusion Night', '2025-08-09', '19:00:00', '23:00:00', 'public/upload/img15.jpg', 17, '{\"ops\": [{\"insert\": \"Enjoy a night of jazz fusion and rhythm.\"}]}', 60.00),
(147, 'Startup Expo', '2025-11-18', '09:00:00', '17:00:00', 'public/upload/img11.jpg', 18, '{\"ops\": [{\"insert\": \"Check out the latest startups and innovations.\"}]}', 70.00),
(148, 'Travel and Adventure Conference', '2025-09-08', '09:00:00', '17:00:00', 'public/upload/img2.jpg', 19, '{\"ops\": [{\"insert\": \"Explore the world of travel and adventure.\"}]}', 100.00),
(149, 'Christmas Caroling', '2025-12-15', '18:00:00', '21:00:00', 'public/upload/img4.jpg', 20, '{\"ops\": [{\"insert\": \"Sing along to your favorite Christmas carols.\"}]}', 20.00),
(150, 'Street Food Festival', '2025-07-05', '12:00:00', '20:00:00', 'public/upload/img20.jpg', 21, '{\"ops\": [{\"insert\": \"Enjoy delicious street food from around the world.\"}]}', 25.00),
(151, 'Guitar Masterclass', '2025-11-08', '10:00:00', '14:00:00', 'public/upload/img2.jpg', 2, '{\"ops\": [{\"insert\": \"Join a guitar masterclass with a professional musician.\"}]}', 80.00),
(152, 'Cooking Class with Chef Alan', '2025-10-17', '12:00:00', '15:00:00', 'public/upload/img11.jpg', 3, '{\"ops\": [{\"insert\": \"Learn culinary skills from Chef Alan.\"}]}', 50.00),
(153, 'Creative Writing Workshop', '2025-12-12', '14:00:00', '17:00:00', 'public/upload/img8.jpg', 4, '{\"ops\": [{\"insert\": \"Enhance your creative writing skills.\"}]}', 40.00),
(154, 'Holiday Shopping Event', '2025-11-22', '09:00:00', '21:00:00', 'public/upload/img18.jpg', 5, '{\"ops\": [{\"insert\": \"Kick off the holiday season with an exclusive shopping event.\"}]}', 30.00),
(155, 'Photography Exhibition', '2025-09-30', '18:00:00', '21:00:00', 'public/upload/img10.jpg', 6, '{\"ops\": [{\"insert\": \"Explore stunning photography from around the world.\"}]}', 60.00),
(156, 'Tech Startup Pitch Night', '2025-08-18', '18:00:00', '21:00:00', 'public/upload/img14.jpg', 7, '{\"ops\": [{\"insert\": \"Listen to startup founders pitch their ideas to investors.\"}]}', 120.00),
(157, 'Winter Fashion Show', '2025-12-06', '19:00:00', '22:00:00', 'public/upload/img5.jpg', 8, '{\"ops\": [{\"insert\": \"Catch the latest trends in winter fashion.\"}]}', 100.00),
(158, 'Classic Movie Marathon', '2025-07-04', '14:00:00', '23:59:00', 'public/upload/img15.jpg', 9, '{\"ops\": [{\"insert\": \"Watch classic movies all day long.\"}]}', 20.00),
(159, 'Outdoor Yoga Session', '2025-06-25', '08:00:00', '09:30:00', 'public/upload/img6.jpg', 10, '{\"ops\": [{\"insert\": \"Start your day with a relaxing yoga session in the park.\"}]}', 15.00),
(160, 'Rock & Roll Dance Party', '2025-10-30', '20:00:00', '23:00:00', 'public/upload/img13.jpg', 11, '{\"ops\": [{\"insert\": \"Dance the night away to classic rock and roll tunes.\"}]}', 25.00);

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
  `guest_name` varchar(128) DEFAULT NULL,
  `purchase_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_seat` smallint(6) NOT NULL,
  `id_event` smallint(6) NOT NULL,
  `id_user` int(11) NOT NULL,
  `seat_name` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id_ticket`, `guest_name`, `purchase_time`, `id_seat`, `id_event`, `id_user`, `seat_name`) VALUES
(117, 'User Test', '2025-04-17 07:04:07', 25, 1, 36, 'B10'),
(118, 'User Test', '2025-04-17 07:07:21', 1, 89, 36, 'VIP-1'),
(123, 'User Test', '2025-04-17 07:08:44', 12, 116, 36, 'VIP-12'),
(127, 'fgsdf', '2025-04-17 08:09:38', 70, 7, 36, 'E10'),
(128, '3242zxcv cv', '2025-04-17 08:37:07', 34, 7, 36, 'C4'),
(129, 'asdfasdf', '2025-04-17 08:37:07', 35, 7, 36, 'C5');

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
(36, 'User', 'Test', NULL, 'test@test', '$2y$10$gdJV0Wj.kLde8Mgm3IwLrOtylIEyiDwkW8bhtrH.FclVq8bH2HHV6', '207222123123', '2025-03-15 20:33:01', 0, 'public/upload/67e64da19a547profile-2.jpg'),
(42, 'Admin', 'Admin', NULL, 'admin@admin', '$2y$10$6P53RWYJbeiTBuBlSktNJeotDMBLMZmOLeyfi0KE3yVQvwRRDmgj6', '2076151337', '2025-04-12 23:25:59', 5, 'public/upload/notset2.png');

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
  ADD UNIQUE KEY `event_seat` (`id_event`,`id_seat`) USING BTREE,
  ADD KEY `users` (`id_user`) USING BTREE,
  ADD KEY `seats` (`id_seat`) USING BTREE;

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
  MODIFY `location_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id_event` smallint(6) NOT NULL AUTO_INCREMENT COMMENT 'events id', AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id_ticket` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT 'id primary key', AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT COMMENT 'user id', AUTO_INCREMENT=43;

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
