-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 05, 2017 at 04:14 AM
-- Server version: 5.7.20-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ge`
--

-- --------------------------------------------------------

--
-- Table structure for table `avatars`
--

CREATE TABLE `avatars` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `original_name` varchar(64) NOT NULL,
  `mime_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `careers`
--

CREATE TABLE `careers` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `degrees`
--

CREATE TABLE `degrees` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `employee_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `manager_id` int(11) NOT NULL,
  `location` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `description`, `manager_id`, `location`) VALUES
(1, 'IT Department', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum quis consectetur, exercitationem libero optio. Deserunt ut delectus atque, est, reiciendis adipisci sapiente ullam? Atque eum nesciunt suscipit, voluptatem enim explicabo.', 2, 'QUARTER JOHN STREET DOE NO 07 NYC');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `cin` varchar(255) CHARACTER SET utf16 NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf16 NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf16 NOT NULL,
  `email` varchar(255) CHARACTER SET utf16 NOT NULL,
  `address` varchar(255) CHARACTER SET utf16 NOT NULL,
  `phone_number` varchar(255) CHARACTER SET utf8 NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf16 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `job_id`, `service_id`, `cin`, `first_name`, `last_name`, `email`, `address`, `phone_number`, `avatar`, `created_at`) VALUES
(1, 1, 1, 'SH1', 'MA', 'H', 'hma_wd@gmail.com', 'QUARTER JOHN STREET DOE NO 07 NYC', '0765489541', 'images/vendor/avatars/581311f4aca3dc3a30dd32ea9e7dea72.jpg', '2017-12-01 17:13:49'),
(2, 2, NULL, 'SH2', 'S', 'U', 'su_dm@gmail.com', 'QUARTER JOHN STREET DOE NO 07 NYC', '056598743', 'images/vendor/avatars/867sqfdqf896453.png', '2017-12-03 00:36:41'),
(3, 3, 1, 'SH3', 'A', 'H', 'ha_sm@gmail.com', 'QUARTER JOHN STREET DOE NO 07 NYC', '0356948128', 'images/vendor/avatars/486746533dsg.png', '2017-12-03 00:28:16'),
(4, 3, 2, 'SH3998', 'DELL', 'HP', 'hp@gmail.com', 'QUARTER JOHN STREET DOE NO 07 NYC', '0712387875', 'images/vendor/avatars/581311f4aca3dc3a30dd32ea9e7d.png', '2017-12-04 20:34:26'),
(6, 1, 1, 'AUTE INVENTORE MAIORES QUOS ODIO BEATAE AUTEM AUT PROIDENT VOLUPTATEM QUASI', 'Emma', 'KNIGHT', 'lucozokaf@yahoo.com', 'DOLOR QUAERAT ALIQUAM NISI EST PERFERENDIS VOLUPTATUM BLANDITIIS NOBIS NULLA NON ANIMI', '+617-36-3719039', 'avatars/5a2608f3727d8.png', '2017-12-05 03:02:32');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '1',
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `salary` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `type`, `title`, `description`, `salary`) VALUES
(1, 1, 'FULL STACK WEB DEVELOPER', 'ONE MAN ARMY, WHEN IT COMES TO WEB DEVELOPMENT.', 100000),
(2, 3, 'Department Manager', 'Handles all things going in his department, and executes the commands of his superiors', 100000),
(3, 2, 'Service Manager', 'Handles, all things that going in a service, and executes the commands of the his department manager', 100000);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `type` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT 'd',
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `manager_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `type`, `name`, `description`, `department_id`, `manager_id`) VALUES
(1, 'd', 'Service of WEB DEV', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse voluptatum tenetur, obcaecati maiores est porro fugit similique corrupti molestiae, possimus, officia. Molestias facilis nesciunt dolore cum atque? Provident, assumenda vitae.', 1, 3),
(2, 'rh', 'Service of RH', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\\r\\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\\r\\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\\r\\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\\r\\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\\r\\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `trainings`
--

CREATE TABLE `trainings` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `started_at` date NOT NULL,
  `ended_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `username` varchar(255) CHARACTER SET utf16 NOT NULL,
  `password` varchar(255) CHARACTER SET utf16 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `employee_id`, `username`, `password`, `created_at`) VALUES
(2, 1, 'hma_wd', '$2y$10$XV8C9dOFJTGdXvI0h5VXvexDxLHCbP1Ap6e2hcR9eCvyi3IbXEJIG', '2017-12-03 23:33:57'),
(3, 2, 'su_dm', '$2y$10$XV8C9dOFJTGdXvI0h5VXvexDxLHCbP1Ap6e2hcR9eCvyi3IbXEJIG', '2017-12-03 23:33:57'),
(4, 3, 'ha_sm', '$2y$10$XV8C9dOFJTGdXvI0h5VXvexDxLHCbP1Ap6e2hcR9eCvyi3IbXEJIG', '2017-12-03 23:33:57'),
(5, 4, 'rh_sm', '$2y$10$XV8C9dOFJTGdXvI0h5VXvexDxLHCbP1Ap6e2hcR9eCvyi3IbXEJIG', '2017-12-04 20:36:11'),
(12, 6, 'salim', '$2y$10$obf6hqEn5fbfLTRiSQnXgenOPcAq7MlR1rH9S1H5YNh0vwVN6S6qu', '2017-12-05 03:02:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avatars`
--
ALTER TABLE `avatars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `careers`
--
ALTER TABLE `careers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `degrees`
--
ALTER TABLE `degrees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone_number` (`phone_number`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainings`
--
ALTER TABLE `trainings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `employee_id` (`employee_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `avatars`
--
ALTER TABLE `avatars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `careers`
--
ALTER TABLE `careers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `degrees`
--
ALTER TABLE `degrees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `trainings`
--
ALTER TABLE `trainings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;