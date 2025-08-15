-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2025 at 08:34 AM
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
-- Database: `barter-brains`
--

-- --------------------------------------------------------

--
-- Table structure for table `connection_requests`
--

CREATE TABLE `connection_requests` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `status` enum('pending','accepted','rejected') DEFAULT 'pending',
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `connection_requests`
--

INSERT INTO `connection_requests` (`id`, `sender_id`, `receiver_id`, `status`, `sent_at`) VALUES
(46, 7, 5, 'accepted', '2025-08-13 07:27:24'),
(47, 11, 5, 'pending', '2025-08-14 15:12:27'),
(48, 5, 11, 'accepted', '2025-08-15 06:21:58'),
(49, 5, 8, 'pending', '2025-08-15 06:22:52'),
(50, 11, 9, 'pending', '2025-08-15 06:28:28');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `teach_skills` text DEFAULT NULL,
  `learn_skills` text DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `cover_photo` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `profession` varchar(100) DEFAULT NULL,
  `about` text DEFAULT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `teach_skills`, `learn_skills`, `profile_photo`, `cover_photo`, `city`, `country`, `profession`, `about`, `role`, `created_at`) VALUES
(1, 'umer', 'nadeem', 'itsumernadeem@gmail.com', '6a8d11f37a9ece9ebc851ea11331160e', 'english', 'coding', '1754269503-.trashed-1748850841-IMG_20250501_200107_970.jpg', '1754269486-IMG-20230213-WA0001.jpg', 'karachi', 'pakistan', 'web developer', 'I am passionate about learning and exchanging skills.', 'admin', '2025-07-27 15:24:00'),
(5, 'asif', 'khan', 'asif@gmail.com', 'ce0b996aa0b7d64169a4b8ffeaf878c5', 'Editing', 'ms Excel', NULL, NULL, NULL, NULL, NULL, NULL, 'user', '2025-08-02 08:20:51'),
(7, 'kamran', 'sabir', 'kamran@gmail.com', 'c812e5bec4e315c9cf7ba3165016bcc3', 'math', 'english', NULL, NULL, NULL, NULL, NULL, NULL, 'user', '2025-08-13 06:02:03'),
(8, 'ahmad', 'khan', 'ahmad@gmail.com', '61243c7b9a4022cb3f8dc3106767ed12', 'coding', 'guitar', NULL, NULL, NULL, NULL, NULL, NULL, 'user', '2025-08-13 06:03:25'),
(9, 'hasan', 'khan', 'hasan@gmail.com', 'fc3f318fba8b3c1502bece62a27712df', 'Editing', 'coding', NULL, NULL, NULL, NULL, NULL, NULL, 'user', '2025-08-13 06:05:33'),
(11, 'usman', 'nadeem', 'romanking492@gmail.com', '2f1fed5365c79d8fea7859dcc8788d77', 'coding', 'editing', NULL, NULL, NULL, NULL, NULL, NULL, 'user', '2025-08-13 06:56:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `connection_requests`
--
ALTER TABLE `connection_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_review` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `connection_requests`
--
ALTER TABLE `connection_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `connection_requests`
--
ALTER TABLE `connection_requests`
  ADD CONSTRAINT `connection_requests_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `connection_requests_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `fk_user_review` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
