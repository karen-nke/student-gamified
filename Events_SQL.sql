-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 06, 2023 at 09:32 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Events`
--

-- --------------------------------------------------------

--
-- Table structure for table `checkin_history`
--

CREATE TABLE `checkin_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `checkin_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checkin_history`
--

INSERT INTO `checkin_history` (`id`, `user_id`, `checkin_date`) VALUES
(1, 15, '2023-11-15'),
(12, 15, '2023-11-17'),
(15, 15, '2023-11-20'),
(2, 21, '2023-11-15'),
(3, 25, '2023-11-15'),
(7, 25, '2023-11-16'),
(4, 26, '2023-11-15'),
(5, 27, '2023-11-15'),
(6, 27, '2023-11-16'),
(8, 28, '2023-11-16'),
(9, 32, '2023-11-17'),
(10, 33, '2023-11-17'),
(11, 34, '2023-11-17'),
(13, 35, '2023-11-17'),
(14, 36, '2023-11-18'),
(16, 37, '2023-12-03');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `event` varchar(255) NOT NULL,
  `club` varchar(255) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `username`, `event`, `club`, `datetime`) VALUES
(1, 'testing', 'a', 'a', '2023-10-14 05:23:00'),
(2, 'testing', 'testing', 'testing', '2023-10-14 05:37:00'),
(3, 'testing', 'testing', 'testing', '2023-10-14 05:38:00'),
(4, 'testing', 'testing', 'testing', '2023-10-14 05:40:00'),
(5, 'testing', 'testing', 'testing', '2023-10-14 06:32:00'),
(6, 'testing', 'testing', 'testing', '2023-10-14 06:35:00'),
(7, 'testing', 'testing', 'testing', '2023-10-14 06:44:00'),
(8, 'testing', 'testing', 'testing', '2023-10-14 06:45:00'),
(9, 'testing', 'testing', 'testing', '2023-10-06 06:49:00'),
(10, 'testing', 'testing', 'testing', '2023-10-14 06:55:00'),
(11, 'testing', 'testing', 'testing', '2023-10-14 06:56:00'),
(12, 'testing', 'testing', 'testing', '2023-10-14 06:57:00'),
(13, 'testing', 'testing', 'testing', '2023-10-14 06:58:00'),
(14, 'testing', 'testing', 'testing', '2023-10-14 07:01:00'),
(15, 'testing', 'testing', 'testing', '2023-10-14 12:58:00'),
(16, 'testing', 'testing', 'testing', '2023-10-14 13:00:00'),
(17, 'testing', 'testing', 'testing', '2023-10-14 13:00:00'),
(18, 'testing', 'testing', 'testing', '2023-10-14 13:00:00'),
(19, 'testing', 'testing', 'testing', '2023-10-14 13:03:00'),
(20, 'testing', 'testing', 'testing', '2023-10-14 13:03:00'),
(21, 'testing', 'Testing', 'Testing', '2023-10-14 13:05:00'),
(22, 'testing', 'testing', 'testing', '2023-10-14 13:05:00'),
(23, 'testing', 'testing', 'testing', '2023-10-16 19:37:00'),
(24, 'babiu', 'babiuubu', 'babi', '2023-10-21 12:18:00'),
(25, 'testing2', 'event', 'event', '2001-01-01 00:12:00'),
(26, 'testing2', 'testing2', 'testing2', '0001-01-01 01:01:00'),
(27, 'user1', 'test', 'test', '2023-11-07 13:42:00'),
(28, 'testing', 'testing', 'testing', '2023-11-08 11:20:00'),
(29, 'testing', 'testing', 'testing', '2023-11-08 11:20:00'),
(30, 'testing2', 'testing2', 'testing2', '0001-01-01 01:01:00'),
(31, 'testing2', 'testing2', 'testing2', '0001-01-01 01:01:00'),
(32, 'testing', 'tew', 'tests', '2023-11-17 17:43:00'),
(33, 'testing7', 'Test', 'Test', '0001-01-01 01:01:00'),
(34, 'testing8', 'event', 'event', '0001-01-01 01:01:00'),
(35, 'testing9', 'testing9', 'testing9', '0001-01-01 01:01:00'),
(36, 'testing9', 'testing9', 'testing9', '0001-01-01 01:01:00'),
(37, 'testing9', 'testing9', 'testing9', '0001-01-01 01:01:00'),
(38, 'testing7', 'testing7', 'testing7', '0001-01-01 01:01:00'),
(39, 'testing10', 'testing10', 'testing10', '0001-01-01 01:01:00'),
(40, 'testing', 'testing', 'testing', '0001-01-01 01:01:00'),
(41, 'testing11', 'testing', 'testing', '0002-02-01 14:22:00'),
(42, 'testingv2', 'testing', 'testing', '0001-01-01 01:01:00'),
(43, 'testingv2', 'testingv2', 'testingv2', '0001-01-01 01:01:00'),
(44, 'testingv3', 'testingv3', 'testingv3', '0001-01-01 01:01:00'),
(45, 'TestUser', 'TestUser', 'TestUser', '2023-12-03 04:48:00'),
(46, 'TestUser', 'TestUser', 'TestUser', '2023-12-03 15:47:00'),
(47, 'TestUser', 'TestUser', 'TestUser', '2023-12-03 15:47:00');

-- --------------------------------------------------------

--
-- Table structure for table `point_history`
--

CREATE TABLE `point_history` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `points_added` int(11) NOT NULL,
  `event_description` varchar(255) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `point_history`
--

INSERT INTO `point_history` (`id`, `username`, `points_added`, `event_description`, `added_at`) VALUES
(1, 'testing', 10, 'Event participation', '2023-10-14 05:04:52'),
(2, 'testing', 10, 'Event participation', '2023-10-14 05:05:07'),
(3, 'testing', 10, 'Event participation', '2023-10-14 05:05:57'),
(4, 'testing', 10, 'Event participation', '2023-10-16 11:37:53'),
(5, 'babiu', 10, 'Event participation', '2023-10-21 04:18:32'),
(6, 'testing2', 10, 'Event participation', '2023-11-04 16:28:52'),
(7, 'testing2', 10, 'Event participation', '2023-11-04 16:50:46'),
(8, 'user1', 10, 'Event participation', '2023-11-07 05:42:15'),
(9, 'testing', 10, 'Event participation', '2023-11-08 03:20:08'),
(10, 'testing', 10, 'Event participation', '2023-11-08 03:20:19'),
(11, 'testing2', 10, 'Event participation', '2023-11-08 08:52:41'),
(12, 'testing2', 10, 'Event participation', '2023-11-08 09:00:10'),
(13, 'root', 10, 'Challenge Point', '2023-11-10 16:23:04'),
(14, 'root', 10, 'Challenge Point', '2023-11-11 04:25:54'),
(15, 'user3', 10, 'Challenge Point', '2023-11-11 04:27:35'),
(16, 'testing2', 10, 'Challenge Point', '2023-11-11 05:00:48'),
(17, 'testing', 20, 'Challenge Point', '2023-11-14 23:49:21'),
(18, 'testing', 20, 'Challenge 2 Point', '2023-11-15 00:23:22'),
(19, 'testing2', 20, 'Challenge 2 Point', '2023-11-15 00:29:19'),
(20, 'testing3', 20, 'Challenge 2 Point', '2023-11-15 00:34:10'),
(21, 'testing5', 20, 'Challenge 2 Point', '2023-11-15 00:39:53'),
(22, 'user1', 20, 'Challenge 2 Point', '2023-11-15 00:43:56'),
(23, 'testing4', 20, 'Challenge 2 Point', '2023-11-15 00:49:51'),
(24, 'testing6', 20, 'Challenge 2 Point', '2023-11-15 00:54:03'),
(25, 'testing', 5, 'Check-in Points', '2023-11-15 07:59:22'),
(147, 'testing', 10, 'Event participation', '2023-11-15 09:43:26'),
(148, 'root', 20, 'Challenge 3 Point', '2023-11-15 09:46:24'),
(149, 'testing2', 20, 'Challenge 3 Point', '2023-11-15 09:48:58'),
(150, 'testing3', 20, 'Challenge 3 Point', '2023-11-15 09:53:25'),
(151, 'testing6', 20, 'Challenge 3 Point', '2023-11-15 10:04:53'),
(152, 'testing2', 5, 'Check-in Points', '2023-11-15 11:38:23'),
(153, 'testing2', 5, 'Check-in Points', '2023-11-15 11:38:27'),
(154, 'testing2', 5, 'Check-in Points', '2023-11-15 11:38:31'),
(155, 'testing6', 5, 'Check-in Points', '2023-11-15 11:47:11'),
(156, 'testing7', 5, 'Check-in Points', '2023-11-15 11:57:04'),
(157, 'testing7', 10, 'Event participation', '2023-11-15 11:57:40'),
(158, 'testing7', 20, 'Challenge Point', '2023-11-15 11:58:05'),
(159, 'testing7', 20, 'Challenge 2 Point', '2023-11-15 11:58:20'),
(160, 'testing7', 20, 'Challenge 3 Point', '2023-11-15 11:58:27'),
(161, 'testing8', 5, 'Check-in Points', '2023-11-15 12:15:59'),
(162, 'testing8', 10, 'Event participation', '2023-11-15 12:17:32'),
(163, 'testing8', 20, 'Challenge Point', '2023-11-15 12:18:11'),
(164, 'testing8', 20, 'Challenge 2 Point', '2023-11-15 12:18:47'),
(165, 'testing8', 20, 'Challenge 3 Point', '2023-11-15 12:18:55'),
(166, 'testing9', 5, 'Check-in Points', '2023-11-15 12:30:04'),
(167, 'testing9', 5, 'Check-in Points', '2023-11-16 05:30:09'),
(168, 'testing9', 10, 'Event participation', '2023-11-16 05:49:17'),
(169, 'testing9', 10, 'Event participation', '2023-11-16 05:49:31'),
(170, 'testing9', 10, 'Event participation', '2023-11-16 05:49:44'),
(171, 'testing7', 5, 'Check-in Points', '2023-11-16 05:53:49'),
(172, 'testing7', 10, 'Event participation', '2023-11-16 05:54:43'),
(173, 'testing10', 5, 'Check-in Points', '2023-11-16 05:58:04'),
(174, 'testing10', 10, 'Event participation', '2023-11-16 05:58:18'),
(175, 'testing', 10, 'Event participation', '2023-11-16 06:19:41'),
(176, 'testing11', 5, 'Check-in Points', '2023-11-16 18:23:09'),
(177, 'testing11', 20, 'Challenge Point', '2023-11-16 18:23:53'),
(178, 'testing12', 5, 'Check-in Points', '2023-11-16 18:58:49'),
(179, 'testing12', 20, 'Challenge Point', '2023-11-16 19:00:59'),
(180, 'testing13', 5, 'Check-in Points', '2023-11-16 19:04:27'),
(181, 'testing13', 20, 'Challenge Point', '2023-11-16 19:07:27'),
(182, 'testing11', 20, 'Challenge 2 Point', '2023-11-16 19:13:29'),
(183, 'testing11', 20, 'Challenge 3 Point', '2023-11-16 19:13:30'),
(184, 'testing', 5, 'Check-in Points', '2023-11-17 06:40:50'),
(185, 'testing11', 10, 'Event participation', '2023-11-17 06:44:13'),
(186, 'testingv2', 5, 'Check-in Points', '2023-11-17 11:25:43'),
(187, 'testingv2', 10, 'Event participation', '2023-11-17 11:25:59'),
(188, 'testingv2', 10, 'Event participation', '2023-11-17 11:26:34'),
(189, 'testingv2', 20, 'Challenge Point', '2023-11-17 11:26:52'),
(190, 'testingv3', 10, 'Event participation', '2023-11-17 15:44:21'),
(191, 'testingv3', 5, 'Check-in Points', '2023-11-17 16:23:33'),
(192, 'testingv3', 20, 'Challenge Point', '2023-11-17 17:03:18'),
(193, 'testingv3', 20, 'Challenge Point', '2023-11-17 17:05:39'),
(194, 'testingv3', 20, 'Challenge 2 Point', '2023-11-17 17:49:58'),
(195, 'testingv3', 20, 'Challenge 3 Point', '2023-11-17 18:39:37'),
(196, 'testingv3', 20, 'Challenge 2 Point', '2023-11-18 03:46:23'),
(197, 'testingv3', 20, 'Challenge 3 Point', '2023-11-18 03:46:25'),
(198, 'testingv3', 20, 'Challenge Point - Leadership', '2023-11-18 03:48:11'),
(199, 'testing', 5, 'Check-in Points', '2023-11-20 09:39:13'),
(200, 'testing', 20, 'Challenge 1 Point - Communication', '2023-12-03 06:02:45'),
(201, 'TestUser', 5, 'Check-in Points', '2023-12-03 07:46:22'),
(202, 'TestUser', 10, 'Event participation', '2023-12-03 07:47:24'),
(203, 'TestUser', 10, 'Event participation', '2023-12-03 07:47:50'),
(204, 'TestUser', 10, 'Event participation', '2023-12-03 07:47:57'),
(205, 'TestUser', 20, 'Challenge 1 Point - Leadership', '2023-12-03 07:49:05'),
(206, 'TestUser', 20, 'Challenge 2 Point - Leadership', '2023-12-03 07:49:57'),
(207, 'TestUser', 20, 'Challenge 3 Point - Leadership', '2023-12-03 07:50:29'),
(208, 'User2', 20, 'Challenge 2 Point - Leadership', '2023-12-03 14:02:24'),
(209, 'TestUser', 20, 'Challenge 1 Point - Communication', '2023-12-04 09:40:45'),
(210, 'TestUser', 20, 'Challenge 1 Point - Teamwork', '2023-12-04 09:41:45'),
(211, 'TestUser', 20, 'Challenge 1 Point - Communication', '2023-12-04 09:42:54'),
(212, 'TestUser', 20, 'Challenge 1 Point - Teamwork', '2023-12-04 09:46:57'),
(213, 'TestUser', 20, 'Challenge 1 Point - Teamwork', '2023-12-04 09:48:33');

-- --------------------------------------------------------

--
-- Table structure for table `practical_form`
--

CREATE TABLE `practical_form` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `soft_skill_id` int(11) DEFAULT NULL,
  `date_stamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `practical_form`
--

INSERT INTO `practical_form` (`id`, `user_id`, `soft_skill_id`, `date_stamp`, `description`) VALUES
(122, 15, 1, '2023-11-15 09:46:24', 'Description '),
(123, 15, 1, '2023-11-15 09:47:25', 'fsfd'),
(124, 17, 1, '2023-11-15 09:48:58', 'Testing'),
(125, 18, 1, '2023-11-15 09:53:25', 'fsdfsdf'),
(126, 18, 1, '2023-11-15 09:54:05', 'sdfsdf'),
(127, 19, 1, '2023-11-15 09:56:09', 'fsdfsdf'),
(128, 20, 1, '2023-11-15 09:58:58', 'tested'),
(129, 21, 1, '2023-11-15 10:04:53', 'test'),
(130, 25, 1, '2023-11-15 11:58:27', 'describe'),
(131, 26, 1, '2023-11-15 12:18:55', 'describe'),
(132, 32, 1, '2023-11-16 19:13:30', 'ss'),
(133, 36, 2, '2023-11-17 18:39:37', 'fdsdf'),
(134, 36, 3, '2023-11-18 03:46:25', 'fd'),
(135, 37, 1, '2023-12-03 07:50:29', 'TestUser');

-- --------------------------------------------------------

--
-- Table structure for table `soft_skills`
--

CREATE TABLE `soft_skills` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `badge_path` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `c1_description` text DEFAULT NULL,
  `question_1` text DEFAULT NULL,
  `option_1_A` varchar(255) DEFAULT NULL,
  `option_1_B` varchar(255) DEFAULT NULL,
  `option_1_C` varchar(255) DEFAULT NULL,
  `option_1_D` varchar(255) DEFAULT NULL,
  `correct_answer_1` varchar(255) DEFAULT NULL,
  `question_2` text DEFAULT NULL,
  `option_2_A` varchar(255) DEFAULT NULL,
  `option_2_B` varchar(255) DEFAULT NULL,
  `option_2_C` varchar(255) DEFAULT NULL,
  `option_2_D` varchar(255) DEFAULT NULL,
  `correct_answer_2` varchar(255) DEFAULT NULL,
  `question_3` text DEFAULT NULL,
  `option_3_A` varchar(255) DEFAULT NULL,
  `option_3_B` varchar(255) DEFAULT NULL,
  `option_3_C` varchar(255) DEFAULT NULL,
  `option_3_D` varchar(255) DEFAULT NULL,
  `correct_answer_3` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `soft_skills`
--

INSERT INTO `soft_skills` (`id`, `name`, `description`, `badge_path`, `image_path`, `c1_description`, `question_1`, `option_1_A`, `option_1_B`, `option_1_C`, `option_1_D`, `correct_answer_1`, `question_2`, `option_2_A`, `option_2_B`, `option_2_C`, `option_2_D`, `correct_answer_2`, `question_3`, `option_3_A`, `option_3_B`, `option_3_C`, `option_3_D`, `correct_answer_3`) VALUES
(1, 'Leadership', 'The ability to influence and inspire a group of individuals towards a common goal or purpose. Effective leadership involves making informed and strategic decisions, fostering collaboration, and motivating team members to perform at their best. <br> <br> A leader serves as a role model, guiding others by demonstrating integrity and a strong work ethic. Whether in the context of an organization, government, educational institution, or any collective effort, leadership plays a pivotal role in driving positive change and achieving shared objectives', 'Image/Leadership_Unlocked.png', 'Image/Leadership_Icon.png', 'This is leadership theory', 'Leadership Question 1', 'A', 'B', 'C', 'D', 'A', 'Leadership Question 2', 'A', 'B', 'C', 'D', 'A', 'Leadership Question 3', 'A', 'B', 'C', 'D', 'A'),
(2, 'Communication', 'Communication as a soft skill refers to the capacity to convey thoughts, ideas, and information effectively through verbal, written, or non-verbal means. It encompasses the ability to articulate thoughts clearly, listen attentively, and comprehend messages accurately. This skill extends beyond the mere transmission of information, emphasizing the establishment of a coherent and mutual understanding between communicators.  <br> <br> Proficiency in communication as a soft skill involves adapting one\'s communication style to suit diverse audiences, recognizing nuances in interpersonal dynamics, and fostering an environment conducive to open and productive dialogue. It is an essential element in fostering collaboration, resolving conflicts, and maintaining positive professional relationships.', 'Image/Communication_Unlocked.png', 'Image/Communication_Icon.png', 'This is communication theory', 'Communication Question 1', 'A', 'B', 'C', 'D', 'A', 'Communication Question 2', 'A', 'B', 'C', 'D', 'A', 'Communication Question 3', 'A', 'B', 'C', 'D', 'A'),
(3, 'Teamwork', 'Teamwork, as a professional skill, denotes the ability to collaborate and coordinate efforts within a group to attain shared objectives. It involves individuals working harmoniously, leveraging their respective strengths and expertise while compensating for each other\'s limitations.  <br> <br> Effective teamwork is underpinned by clear communication, a foundation of trust among team members, and a collective commitment to achieving common goals. It is a strategic and intentional approach to leveraging diverse skills and perspectives, fostering a collaborative environment that maximizes the overall productivity and success of the team.', 'Image/Teamwork_Unlocked.png', 'Image/Teamwork_Icon.png', 'This is teamwork theory', 'Teamwork Question 1', 'A', 'B', 'C', 'D', 'A', 'Teamwork Question 2', 'A', 'B', 'C', 'D', 'A', 'Teamwork Question 3', 'A', 'B', 'C', 'D', 'A'),
(4, 'a', 'a', 'a', 'a', 'C1 Theory', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `user_role_id` int(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `points` int(255) NOT NULL DEFAULT 0,
  `gender` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_role_id`, `username`, `email`, `password`, `points`, `gender`) VALUES
(1, 1, 'admin', 'admin@gmail.com', '751cb3f4aa17c36186f4856c8982bf27', 0, 'rather_not_to_say'),
(15, NULL, 'testing', 'testing@gmail.com', 'ae8c47ebbf65d6c7dfb1d7a7910a74e2', 1065, 'Male'),
(16, NULL, 'babiu', 'Jienee2@gmail.com', '7a7c5d0414df4cc96617d7a11b35a4c8', 10, NULL),
(17, NULL, 'testing2', 'testing2@gmail.com', 'ae8c47ebbf65d6c7dfb1d7a7910a74e2', 90, NULL),
(18, NULL, 'testing3', 'testing3@gmail.com', 'ae8c47ebbf65d6c7dfb1d7a7910a74e2', 50, NULL),
(19, NULL, 'testing4', 'testing4@gmail.com', 'ae8c47ebbf65d6c7dfb1d7a7910a74e2', 40, 'male'),
(20, NULL, 'testing5', 'testing5@gmail.com', 'ae8c47ebbf65d6c7dfb1d7a7910a74e2', 55, 'female'),
(21, NULL, 'testing6', 'testing6@gmail.com', 'ae8c47ebbf65d6c7dfb1d7a7910a74e2', 55, 'male'),
(22, NULL, 'user1', 'user@gmail.com', 'ae8c47ebbf65d6c7dfb1d7a7910a74e2', 60, 'female'),
(23, NULL, 'User2', 'user2@gmail.com', 'ae8c47ebbf65d6c7dfb1d7a7910a74e2', 30, 'female'),
(24, NULL, 'user3', 'user3@gmail.com', 'ae8c47ebbf65d6c7dfb1d7a7910a74e2', 20, 'male'),
(25, NULL, 'testing7', 'testing7@gmail.com', 'ae8c47ebbf65d6c7dfb1d7a7910a74e2', 90, 'rather_not_to_say'),
(26, NULL, 'testing8', 'testing8@gmail.com', 'ae8c47ebbf65d6c7dfb1d7a7910a74e2', 75, 'female'),
(27, NULL, 'testing9', 'testing9@gmail.com', 'ae8c47ebbf65d6c7dfb1d7a7910a74e2', 40, 'female'),
(28, NULL, 'testing10', 'testing10@gmail.com', 'ae8c47ebbf65d6c7dfb1d7a7910a74e2', 15, 'female'),
(32, NULL, 'testing11', 'testing11@gmail.com', 'ae8c47ebbf65d6c7dfb1d7a7910a74e2', 75, 'female'),
(33, NULL, 'testing12', 'testing12@gmail.com', 'ae8c47ebbf65d6c7dfb1d7a7910a74e2', 25, 'male'),
(34, NULL, 'testing13', 'testing13@gmail.com', 'ae8c47ebbf65d6c7dfb1d7a7910a74e2', 25, 'male'),
(35, NULL, 'testingv2', 'testingv2@gmail.com', 'ae8c47ebbf65d6c7dfb1d7a7910a74e2', 45, 'male'),
(36, NULL, 'testingv3', 'testingv3@gmail.com', 'ae8c47ebbf65d6c7dfb1d7a7910a74e2', 155, 'female'),
(37, NULL, 'TestUser', 'testuser@gmail.com', 'ae8c47ebbf65d6c7dfb1d7a7910a74e2', 1165, 'female'),
(38, NULL, 'abcdef', 'testing006@gmail.com', 'ae8c47ebbf65d6c7dfb1d7a7910a74e2', 0, 'male');

-- --------------------------------------------------------

--
-- Table structure for table `user_alerts`
--

CREATE TABLE `user_alerts` (
  `user_id` int(11) NOT NULL,
  `leadership_alert_shown` tinyint(1) DEFAULT NULL,
  `points_alert_shown` tinyint(1) DEFAULT NULL,
  `challenge_alert_shown` tinyint(1) DEFAULT NULL,
  `module_alert_shown` tinyint(1) DEFAULT NULL,
  `event_alert_shown` tinyint(1) DEFAULT NULL,
  `rank_alert_shown` tinyint(1) DEFAULT NULL,
  `lvl1_alert_shown` tinyint(1) DEFAULT NULL,
  `lvl5_alert_shown` tinyint(1) DEFAULT NULL,
  `communication_alert_shown` tinyint(1) DEFAULT NULL,
  `teamwork_alert_shown` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_alerts`
--

INSERT INTO `user_alerts` (`user_id`, `leadership_alert_shown`, `points_alert_shown`, `challenge_alert_shown`, `module_alert_shown`, `event_alert_shown`, `rank_alert_shown`, `lvl1_alert_shown`, `lvl5_alert_shown`, `communication_alert_shown`, `teamwork_alert_shown`) VALUES
(15, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(17, 1, 1, 1, 1, 1, NULL, 1, 1, NULL, NULL),
(32, 1, 1, 1, 1, NULL, NULL, 1, NULL, NULL, NULL),
(33, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, NULL, 1, 1, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(36, NULL, 1, 1, 1, NULL, NULL, 1, 1, 1, 1),
(37, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_levels`
--

CREATE TABLE `user_levels` (
  `user_id` int(11) NOT NULL,
  `current_level` int(11) DEFAULT 0,
  `alert_level` int(11) DEFAULT 0,
  `level_up_alert_shown` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_levels`
--

INSERT INTO `user_levels` (`user_id`, `current_level`, `alert_level`, `level_up_alert_shown`) VALUES
(15, 0, 0, 0),
(17, 0, 0, 0),
(35, 0, 0, 1),
(36, 0, 0, 0),
(37, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_soft_skill_progress`
--

CREATE TABLE `user_soft_skill_progress` (
  `user_id` int(11) NOT NULL,
  `soft_skill_id` int(11) NOT NULL,
  `challenge_number` int(11) NOT NULL,
  `completed` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_soft_skill_progress`
--

INSERT INTO `user_soft_skill_progress` (`user_id`, `soft_skill_id`, `challenge_number`, `completed`) VALUES
(15, 1, 1, 1),
(15, 1, 2, 1),
(15, 1, 3, 1),
(15, 2, 1, 1),
(17, 1, 1, 1),
(17, 1, 2, 1),
(17, 1, 3, 1),
(18, 1, 2, 1),
(18, 1, 3, 1),
(19, 1, 2, 1),
(19, 1, 3, 1),
(20, 1, 2, 1),
(20, 1, 3, 1),
(21, 1, 1, 1),
(21, 1, 2, 1),
(21, 1, 3, 1),
(22, 1, 1, 1),
(22, 1, 2, 1),
(23, 1, 1, 1),
(23, 1, 2, 1),
(24, 1, 1, 1),
(25, 1, 1, 1),
(25, 1, 2, 1),
(25, 1, 3, 1),
(26, 1, 1, 1),
(26, 1, 2, 1),
(26, 1, 3, 1),
(32, 1, 1, 1),
(32, 1, 2, 1),
(32, 1, 3, 1),
(33, 1, 1, 1),
(34, 1, 1, 1),
(35, 1, 1, 1),
(36, 1, 1, 1),
(36, 2, 1, 1),
(36, 2, 2, 1),
(36, 2, 3, 1),
(36, 3, 1, 1),
(36, 3, 2, 1),
(36, 3, 3, 1),
(37, 3, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checkin_history`
--
ALTER TABLE `checkin_history`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_date` (`user_id`,`checkin_date`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `point_history`
--
ALTER TABLE `point_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `practical_form`
--
ALTER TABLE `practical_form`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `soft_skill_id` (`soft_skill_id`);

--
-- Indexes for table `soft_skills`
--
ALTER TABLE `soft_skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_username` (`username`);

--
-- Indexes for table `user_alerts`
--
ALTER TABLE `user_alerts`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_levels`
--
ALTER TABLE `user_levels`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_soft_skill_progress`
--
ALTER TABLE `user_soft_skill_progress`
  ADD PRIMARY KEY (`user_id`,`soft_skill_id`,`challenge_number`),
  ADD KEY `soft_skill_id` (`soft_skill_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checkin_history`
--
ALTER TABLE `checkin_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `point_history`
--
ALTER TABLE `point_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- AUTO_INCREMENT for table `practical_form`
--
ALTER TABLE `practical_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `soft_skills`
--
ALTER TABLE `soft_skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `checkin_history`
--
ALTER TABLE `checkin_history`
  ADD CONSTRAINT `checkin_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `checkin_history_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `practical_form`
--
ALTER TABLE `practical_form`
  ADD CONSTRAINT `practical_form_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `practical_form_ibfk_2` FOREIGN KEY (`soft_skill_id`) REFERENCES `soft_skills` (`id`);

--
-- Constraints for table `user_soft_skill_progress`
--
ALTER TABLE `user_soft_skill_progress`
  ADD CONSTRAINT `user_soft_skill_progress_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_soft_skill_progress_ibfk_2` FOREIGN KEY (`soft_skill_id`) REFERENCES `soft_skills` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
