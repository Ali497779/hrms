-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2025 at 05:01 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hrms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('0ff37893-cc9b-449d-928a-cd8fbfd7069e', 'App\\Notifications\\TicketCreatedNotification', 'App\\Models\\User', 1, '{\"message\":\"New ticket created by Robert Mckenzie\",\"ticket_id\":3,\"date\":\"2025-06-03\",\"user_id\":2}', NULL, '2025-06-25 05:06:45', '2025-06-25 05:06:45'),
('3b9d06e7-297a-47f3-8ad7-e9b06fdd1bed', 'App\\Notifications\\TicketStatusNotification', 'App\\Models\\User', 2, '{\"message\":\"Your ticket for 03 Jun 2025 has been approved\",\"ticket_id\":2,\"status\":\"Approved\",\"date\":\"2025-06-02T19:00:00.000000Z\"}', NULL, '2025-06-25 05:14:32', '2025-06-25 05:14:32'),
('6cdaf9a9-a337-4edb-ac48-549ecec7bbca', 'App\\Notifications\\TicketCreatedNotification', 'App\\Models\\User', 1, '{\"message\":\"New ticket created by Robert Mckenzie\",\"ticket_id\":2,\"date\":\"2025-06-03\",\"user_id\":2}', NULL, '2025-06-25 05:06:28', '2025-06-25 05:06:28'),
('81125700-2741-4689-8c9f-0f25c51a17c6', 'App\\Notifications\\TicketStatusNotification', 'App\\Models\\User', 2, '{\"message\":\"Your ticket for 03 Jun 2025 has been approved\",\"ticket_id\":1,\"status\":\"Approved\",\"date\":\"2025-06-02T19:00:00.000000Z\"}', NULL, '2025-06-25 05:12:42', '2025-06-25 05:12:42'),
('df9dd8fd-aee3-4d73-b4c7-f0f935a19adb', 'App\\Notifications\\TicketCreatedNotification', 'App\\Models\\User', 1, '{\"message\":\"New ticket created by Robert Mckenzie\",\"ticket_id\":1,\"date\":\"2025-06-03\",\"user_id\":2}', NULL, '2025-06-25 05:02:27', '2025-06-25 05:02:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
