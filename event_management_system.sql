-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:4306
-- Generation Time: Jan 31, 2025 at 09:50 AM
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
-- Database: `event_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `capacity` int(11) NOT NULL,
  `registered` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `image`, `description`, `date`, `time`, `capacity`, `registered`, `created_by`, `created_at`) VALUES
(1, 'Ekushey Book Fair 2025 📚', '1738217562_event1.jpg', '📍 Location: Bangla Academy & Suhrawardy Udyan, Dhaka\r\n🎤 Chief Guest: Dr. Muhammad Yunus (Expected)\r\n📖 Event Details:\r\nThe Amar Ekushey Book Fair is Bangladesh’s largest and most prestigious book fair, held annually in February. Organized by the Bangla Academy, it commemorates the Language Movement of 1952. ', '2025-02-01', '10:00:00', 2, 2, 1, '2025-01-30 06:12:42'),
(2, 'Dhaka International Folk Festival 2025 🎶', '1738218135_event3.jpg', '📍 Location: Army Stadium, Dhaka\r\n🎤 Chief Guest: Dr. Hasan Mahmud\r\n🎸 Event Details:\r\nThe Dhaka International Folk Festival is Bangladesh’s biggest folk music event, featuring artists from Bangladesh, India, Pakistan, and beyond.', '2025-02-05', '16:30:00', 5, 3, 2, '2025-01-30 06:21:59'),
(3, 'Dhaka International Film Festival (DIFF) 2025 🎥', '1738223739_event2.jpg', '📍 Location: National Museum, Dhaka\r\n🎤 Chief Guest: Dr. A.K. Abdul Momen\r\n🎬 Event Details:\r\nOne of South Asia’s most prestigious film festivals, DIFF promotes global cinema, art-house films, and emerging Bangladeshi filmmakers. Organized by the Rainbow Film Society, the festival screens over 200 films from 70+ countries.', '2025-02-08', '13:00:00', 8, 4, 1, '2025-01-30 07:38:36');

-- --------------------------------------------------------

--
-- Table structure for table `event_attendees`
--

CREATE TABLE `event_attendees` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_attendees`
--

INSERT INTO `event_attendees` (`id`, `event_id`, `name`, `email`, `phone`, `created_at`) VALUES
(1, 1, 'Sadia Shakiba Bhuiyan', 'sadia.shakiba26@gmail.com', '01755004046', '2025-01-30 06:25:57'),
(2, 2, 'Abrar Bhuiyan', 'abrar@gmail.com', '01886294046', '2025-01-30 06:27:30'),
(3, 1, 'Nadira Nawara Bhuiyan', 'nadira@gmail.com', '01882694046', '2025-01-30 06:28:12'),
(8, 3, 'Abrar', 'abrar@gmail.com', '01886294046', '2025-01-30 10:11:09'),
(9, 2, 'nasrin', 'nasrin@gmail.com', '01556785857', '2025-01-30 10:43:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_as` tinyint(4) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role_as`, `created_at`) VALUES
(1, 'Sadia Shakiba Bhuiyan', 'sadia.shakiba26@gmail.com', '$2y$10$yaKTMMn/JPwCAwhr/2Wdeecp55z3.jCOx7WHgKoj6beYMU4NtCKs.', 1, '2025-01-30 00:20:11'),
(2, 'Nadira', 'nadira@gmail.com', '$2y$10$8GiKzHMb3YC8AzTGi3eX.eYvEnch0nn52i57D4KzwjW2eMIZviNIa', 0, '2025-01-30 00:26:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `event_attendees`
--
ALTER TABLE `event_attendees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`name`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `event_attendees`
--
ALTER TABLE `event_attendees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `event_attendees`
--
ALTER TABLE `event_attendees`
  ADD CONSTRAINT `event_attendees_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
