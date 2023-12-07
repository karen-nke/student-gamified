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
(2, NULL, 'testing', 'testing@gmail.com', 'ae8c47ebbf65d6c7dfb1d7a7910a74e2', 50, 'male'),
(3, NULL, 'testing2', 'testing2@gmail.com', 'ae8c47ebbf65d6c7dfb1d7a7910a74e2', 50, 'rather_not_to_say'),
(4, NULL, 'testing3', 'testing3@gmail.com', 'ae8c47ebbf65d6c7dfb1d7a7910a74e2', 50, 'rather_not_to_say'),
(5, NULL, 'testing4', 'testing4@gmail.com', 'ae8c47ebbf65d6c7dfb1d7a7910a74e2', 50, 'male');


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
