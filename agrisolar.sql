-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 27, 2019 at 04:08 PM
-- Server version: 10.1.29-MariaDB-6+b1
-- PHP Version: 7.2.4-1+b1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agrisolar`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission` text COLLATE utf8mb4_unicode_ci,
  `redirect` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `slug`, `permission`, `redirect`, `created_at`, `updated_at`) VALUES
(2, 'editor', 'nader', '{\"show_pump\":\"true\",\"create_pump\":\"false\",\"edit_pump\":\"false\",\"delete_pump\":\"false\",\"show_pump_height\":\"false\",\"create_pump_height\":\"true\",\"edit_pump_height\":\"false\",\"delete_pump_height\":\"false\",\"show_settings\":\"false\",\"create_settings\":\"false\",\"edit_settings\":\"true\",\"delete_settings\":\"false\",\"show_groups\":\"false\",\"create_groups\":\"true\",\"edit_groups\":\"false\",\"delete_groups\":\"false\",\"show_user\":\"true\",\"create_user\":\"false\",\"edit_user\":\"false\",\"delete_user\":\"false\"}', 'admin', '2019-04-19 23:41:36', '2019-04-21 19:38:28'),
(3, 'Administrator', 'editor', '{\"show_pump\":\"true\",\"create_pump\":\"true\",\"edit_pump\":\"true\",\"delete_pump\":\"true\",\"show_pump_height\":\"true\",\"create_pump_height\":\"true\",\"edit_pump_height\":\"true\",\"delete_pump_height\":\"true\",\"show_settings\":\"true\",\"create_settings\":\"true\",\"edit_settings\":\"true\",\"delete_settings\":\"true\",\"show_groups\":\"true\",\"create_groups\":\"true\",\"edit_groups\":\"true\",\"delete_groups\":\"true\",\"show_user\":\"true\",\"create_user\":\"true\",\"edit_user\":\"true\",\"delete_user\":\"true\"}', 'admin', '2019-04-19 23:53:02', '2019-04-21 19:38:09'),
(4, 'public User', 'public-user', '{\"show_pump\":\"false\",\"create_pump\":\"false\",\"edit_pump\":\"false\",\"delete_pump\":\"false\",\"show_pump_height\":\"false\",\"create_pump_height\":\"false\",\"edit_pump_height\":\"false\",\"delete_pump_height\":\"false\",\"show_settings\":\"false\",\"create_settings\":\"false\",\"edit_settings\":\"false\",\"delete_settings\":\"false\",\"show_groups\":\"false\",\"create_groups\":\"false\",\"edit_groups\":\"false\",\"delete_groups\":\"false\",\"show_user\":\"false\",\"create_user\":\"false\",\"edit_user\":\"false\",\"delete_user\":\"false\"}', 'user', '2019-04-27 22:17:07', '2019-04-27 22:17:07');

-- --------------------------------------------------------

--
-- Table structure for table `height_pumps`
--

CREATE TABLE `height_pumps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `head` float DEFAULT NULL,
  `c0` float NOT NULL,
  `c1` float NOT NULL,
  `c2` float NOT NULL,
  `c3` float NOT NULL,
  `c4` float NOT NULL,
  `c5` float NOT NULL,
  `q_max` float NOT NULL,
  `q_min` float NOT NULL,
  `p_min` float NOT NULL,
  `p_max` float NOT NULL,
  `pump_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `height_pumps`
--

INSERT INTO `height_pumps` (`id`, `head`, `c0`, `c1`, `c2`, `c3`, `c4`, `c5`, `q_max`, `q_min`, `p_min`, `p_max`, `pump_id`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 2, '2019-04-13 20:21:48', '2019-04-13 20:21:48'),
(2, NULL, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 2, '2019-04-13 20:24:16', '2019-04-13 20:33:23'),
(4, NULL, 1, 2, 3, 4, 5, 6, 7, 8, 10, 9, 3, '2019-04-13 20:35:19', '2019-04-13 20:35:19'),
(5, NULL, -4, -5, -6, -8, -9, -10, -11, -12, -14, -36, 3, '2019-04-13 20:36:34', '2019-04-16 19:06:46'),
(6, NULL, 11.5, 12.5, 13.5, 17.8, 62.6, 56.6, 17.5, 1878.8, 20.2, 19.6, 3, '2019-04-13 20:36:55', '2019-04-16 19:06:25'),
(8, 4, 0, 1, 2, 3, 4, 5, 55, 66, 77, 88, 4, '2019-04-20 14:05:20', '2019-04-20 14:05:20'),
(10, 5, 4000.91, 120.265, -12.5036, 0.667537, -0.01753, 0.000180252, 50, 5, 3, 70, 4, '2019-04-20 14:18:48', '2019-04-20 22:00:17'),
(11, 26.6, 7.4983, -12.923, 13.4375, -3.01549, 0.288167, -0.0101337, 75, 15, 0, 9.453, 5, '2019-04-22 18:56:42', '2019-04-22 18:56:42'),
(13, 4.8, -24.6964, 218.295, -508.969, 717.762, -514.766, 144.289, 35, 7, 0.164, 1.16, 28, '2019-05-08 17:01:08', '2019-05-08 17:01:08'),
(14, 5.2, -27.8008, 227.256, -529.251, 717.762, -524.972, 145.298, 34, 6.8, 0.184, 1.16, 28, '2019-05-08 17:06:54', '2019-05-08 17:06:54'),
(15, 5.65, -33.4201, 256.148, -612.321, 857.07, -603.701, 166.073, 33, 6.6, 0.209, 1.15, 28, '2019-05-08 17:08:48', '2019-05-08 17:08:48'),
(16, 6, -38.5204, 282.757, -682.158, 942.917, -651.89, 175.809, 32, 6.4, 0.229, 1.15, 28, '2019-05-08 17:14:31', '2019-05-08 17:14:31'),
(17, 6.44, -45.5339, 320.592, -786.776, 1087.84, -752.323, 203.861, 31, 6.2, 0.254, 1.14, 28, '2019-05-08 17:16:51', '2019-05-08 17:16:51'),
(18, 6.9, -52.4734, 348.978, -836.584, 1113.42, -739.758, 192.807, 29, 5.8, 0.282, 1.12, 28, '2019-05-08 17:23:45', '2019-05-08 17:23:45'),
(19, 7.3, -58.5414, 372.173, -877.521, 1146.31, -753.291, 196.108, 28, 5.6, 0.307, 1.11, 28, '2019-05-08 17:24:55', '2019-05-08 17:24:55'),
(20, 7.72, -66.7175, 407.057, -940.561, 1189.76, -755.651, 190.038, 26, 5.2, 0.334, 1.09, 28, '2019-05-08 17:26:13', '2019-05-08 17:26:13'),
(21, 8.14, -70.2899, 402.128, -878.356, 1049.57, -630.611, 150.223, 24, 4.8, 0.361, 1.06, 28, '2019-05-08 17:28:07', '2019-05-08 17:28:07'),
(22, 8.57, -83.437, 475.474, -1072.48, 1322.51, -830.743, 210.155, 22, 4.4, 0.39, 1.02, 28, '2019-05-08 17:29:21', '2019-05-08 17:29:21'),
(23, 9, -94.4347, 521.772, -1159.49, 1404.63, -871.069, 218.88, 20, 4, 0.42, 0.989, 28, '2019-05-08 17:31:04', '2019-05-08 17:31:04'),
(24, 4.4, -21.2804, 274.821, -843.171, 1583.03, -1523.35, 575.469, 36, 7.2, 0.1071, 0.8663, 29, '2019-05-19 14:20:25', '2019-05-19 14:20:25'),
(25, 4.8, -24.5157, 290.135, -902.269, 1701.34, -1633.38, 613.169, 35, 7, 0.122, 0.8656, 29, '2019-05-19 14:21:52', '2019-05-19 14:21:52'),
(26, 5.2, -28.4102, 313.026, -991.475, 1701.34, -1787.99, 665.485, 34, 6.8, 0.1376, 0.8638, 29, '2019-05-19 14:24:39', '2019-05-19 14:24:39'),
(27, 5.65, -33.5434, 345.459, -1110.32, 2084.33, -1965.76, 723.075, 33, 6.6, 0.1558, 0.8608, 29, '2019-05-19 14:25:39', '2019-05-19 14:25:39'),
(28, 6.01, -38.2142, 376.641, -1220.9, 2271.94, -2115.17, 768.121, 32, 6.4, 0.1705, 0.8566, 29, '2019-05-19 14:26:55', '2019-05-19 14:34:22'),
(29, 6.44, -44.9019, 421.06, -1369.18, 2513.06, -2307.75, 830.571, 31, 6.2, 0.1896, 0.851, 29, '2019-05-19 14:35:50', '2019-05-19 14:44:18'),
(30, 6.9, -51.3867, 454.447, -1440.94, 2544.54, -2244.88, 777.031, 29, 5.8, 0.2102, 0.8375, 29, '2019-05-19 14:45:43', '2019-05-19 14:45:43'),
(31, 7.3, -59.7307, 513.043, -1638.25, 2885.45, -2550.51, 891.343, 28, 5.6, 0.2288, 0.8291, 29, '2019-05-19 14:46:46', '2019-05-19 14:46:46'),
(32, 7.72, -66.4186, 543.703, -1687.18, 2871.05, -2456.83, 833.93, 26, 5.2, 0.2488, 0.8098, 29, '2019-05-19 14:48:42', '2019-05-19 14:48:42'),
(33, 8.14, -73.7487, 577.61, -1745.06, 2878.84, -2395.37, 793.738, 24, 4.8, 0.2694, 0.7873, 29, '2019-05-19 14:50:21', '2019-05-19 14:50:21'),
(34, 8.57, -83.1615, 630.354, -1880.47, 3054.89, -2516.55, 830.961, 22, 4.4, 0.291, 0.7634, 29, '2019-05-19 16:01:17', '2019-05-19 16:01:17'),
(35, 9.001, -96.6614, 724.248, -2190.38, 3606.41, -3038.35, 1036.25, 20, 4, 0.3132, 0.7377, 29, '2019-05-19 16:02:35', '2019-05-19 16:02:35');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pivot_id` int(11) NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image`, `pivot_id`, `type`, `created_at`, `updated_at`) VALUES
(3, '/images/service/Beach_by_Samuel_Scrimshaw1552522419.jpg', 19, 'service', '2019-03-13 22:13:39', '2019-03-13 22:13:39'),
(9, '/images/service/Aurora1552522600.jpg', 22, 'service', '2019-03-13 22:16:40', '2019-03-13 22:16:40'),
(11, '/images/service/Dew_by_Aaron_Burden1552612293.jpg', 21, 'service', '2019-03-14 23:11:33', '2019-03-14 23:11:33'),
(13, '/images/setting/Hummingbird_by_Shu_Le1552665787.jpg', 7, 'setting', '2019-03-15 14:03:07', '2019-03-15 14:03:07'),
(14, '/images/setting/Reflection_of_the_Kanas_Lake_by_Wang_Jinyu1552667610.jpg', 8, 'setting', '2019-03-15 14:33:30', '2019-03-15 14:33:30'),
(15, '/images/setting/Reflection_of_the_Kanas_Lake_by_Wang_Jinyu1552667663.jpg', 9, 'setting', '2019-03-15 14:34:23', '2019-03-15 14:34:23'),
(16, '/images/setting/Aurora1552667696.jpg', 10, 'setting', '2019-03-15 14:34:56', '2019-03-15 14:34:56'),
(18, '/images/user/Aurora1552678885.jpg', 6, 'user', '2019-03-15 17:41:25', '2019-03-15 17:41:25'),
(44, '/images/page/home11552948408.jpg', 2, 'page', '2019-03-18 20:33:28', '2019-03-18 20:33:28'),
(45, '/images/team/team-31552949277.jpg', 3, 'team', '2019-03-18 20:47:57', '2019-03-18 20:47:57'),
(46, '/images/team/team-11552949331.jpg', 4, 'team', '2019-03-18 20:48:51', '2019-03-18 20:48:51'),
(47, '/images/team/team-21552949373.jpg', 5, 'team', '2019-03-18 20:49:33', '2019-03-18 20:49:33'),
(48, '/images/slider/215529438991552949972.jpg', 4, 'slider', '2019-03-18 20:59:32', '2019-03-18 20:59:32'),
(49, '/images/slider/1-115529439811552949988.jpg', 3, 'slider', '2019-03-18 20:59:48', '2019-03-18 20:59:48'),
(50, '/images/page/home115529478761552950006.jpg', 3, 'page', '2019-03-18 21:00:06', '2019-03-18 21:00:06'),
(52, '/images/setting/cropped-fav-big-32x321552952130.jpg', 14, 'setting', '2019-03-18 21:35:30', '2019-03-18 21:35:30'),
(53, '/images/setting/HR-Advisor1553031445.png', 13, 'setting', '2019-03-19 19:37:25', '2019-03-19 19:37:25'),
(54, '/images/page/Depositphotos_24653263_original1553032297.jpg', 1, 'page', '2019-03-19 19:51:37', '2019-03-19 19:51:37'),
(55, '/images/testimonial/image-141553117915.jpg', 3, 'testimonial', '2019-03-20 19:38:35', '2019-03-20 19:38:35'),
(56, '/images/testimonial/image-21553118032.jpg', 2, 'testimonial', '2019-03-20 19:40:32', '2019-03-20 19:40:32'),
(57, '/images/testimonial/1-1170x7311553118094.jpg', 4, 'testimonial', '2019-03-20 19:41:34', '2019-03-20 19:41:34'),
(59, '/images/testimonial/image-101553118174.jpg', 5, 'testimonial', '2019-03-20 19:42:54', '2019-03-20 19:42:54'),
(60, '/images/user/team-21553123979.jpg', 2, 'user', '2019-03-20 21:19:39', '2019-03-20 21:19:39'),
(61, '/images/user/team-21553124231.jpg', 1, 'user', '2019-03-20 21:23:51', '2019-03-20 21:23:51'),
(62, '/images/user/Scenery_in_Plateau_by_Arto_Marttinen1555195667.jpg', 7, 'user', '2019-04-13 20:47:47', '2019-04-13 20:47:47'),
(63, '/images/user/11555729030.jpg', 3, 'user', '2019-04-20 00:57:10', '2019-04-20 00:57:10'),
(64, '/images/user/visitor1555882809.png', 4, 'user', '2019-04-21 19:40:09', '2019-04-21 19:40:09');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2014_10_12_000000_create_images_table', 3),
(6, '2014_10_12_000000_create_setting_table', 3),
(18, '2019_04_13_161849_create_pumps_table', 4),
(19, '2019_06_13_161904_create_heights_table', 4),
(22, '2010_10_12_000000_create_groups_table', 5),
(23, '2014_10_12_000000_create_users_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `pumps`
--

CREATE TABLE `pumps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `motor` float DEFAULT NULL,
  `stages` float DEFAULT NULL,
  `q_min` float NOT NULL,
  `q_max` float NOT NULL,
  `h_min` float NOT NULL,
  `h_max` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pumps`
--

INSERT INTO `pumps` (`id`, `model`, `motor`, `stages`, `q_min`, `q_max`, `h_min`, `h_max`, `created_at`, `updated_at`) VALUES
(5, 'ESP 06060/06', 15, 6, 50, 75, 26, 45, '2019-04-22 18:53:09', '2019-04-22 18:53:09'),
(17, 'ESP 06045/07', 15, 7, 35, 55, 44, 57, '2019-05-05 19:35:36', '2019-05-09 17:43:20'),
(18, 'ESP 06045/09', 20, 9, 35, 55, 56, 78, '2019-05-05 19:36:26', '2019-05-22 15:52:44'),
(19, 'ESP 06045/12', 25, 12, 35, 55, 78, 111, '2019-05-05 19:37:11', '2019-05-22 15:52:31'),
(21, 'ESP 06060/08', 20, 8, 50, 75, 37, 62, '2019-05-05 19:38:45', '2019-05-22 15:52:19'),
(22, 'ESP 06060/10', 25, 10, 50, 75, 47, 77, '2019-05-05 19:39:30', '2019-05-22 15:50:43'),
(23, 'ESP 06060/12', 30, 12, 50, 75, 56, 92, '2019-05-05 19:40:11', '2019-05-22 15:50:32'),
(24, 'ESP 07075/03', 15, 3, 70, 93, 25.5, 34, '2019-05-05 19:41:08', '2019-05-22 15:50:19'),
(25, 'ESP 07075/04', 20, 4, 70, 93, 34, 45.8, '2019-05-05 19:41:45', '2019-05-22 15:50:08'),
(26, 'ESP 07075/05', 25, 5, 70, 93, 43.6, 58, '2019-05-05 19:42:52', '2019-05-22 15:49:59'),
(27, 'ESP 07075/06', 30, 6, 70, 93, 51.8, 69, '2019-05-05 19:43:30', '2019-05-22 15:49:50'),
(29, 'ESP 06030/01', 1.5, 1, 35, 55, 4.4, 8, '2019-05-15 16:42:02', '2019-05-15 16:42:02');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('text','image') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'text',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `type`, `created_at`, `updated_at`) VALUES
(15, 'phone-number', '+3 833 211 32', 'text', '2019-03-18 21:36:14', '2019-03-18 21:36:14'),
(16, 'facebook', 'http://www.facebook.com', 'text', '2019-03-18 21:36:31', '2019-03-18 21:36:31'),
(17, 'twitter', 'http://www.twitter.com', 'text', '2019-03-18 21:37:09', '2019-03-18 21:37:09'),
(18, 'linkedin', 'http://www.linkedin.com', 'text', '2019-03-18 21:37:32', '2019-03-18 21:37:32'),
(19, 'copy-right', 'nevdia.com ©. All rights reserved.', 'text', '2019-03-18 21:38:04', '2019-03-18 21:38:04'),
(20, 'email', 'info@hradviser.com', 'text', '2019-03-18 21:38:18', '2019-03-18 21:38:18'),
(21, 'address', '123, New Lenox Chicago,  IL 60606', 'text', '2019-03-18 21:38:29', '2019-03-18 21:38:29'),
(22, 'public-user-group', 'public-user', 'text', '2019-04-27 22:17:49', '2019-04-27 22:17:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `image`, `phone_number`, `email`, `email_verified_at`, `password`, `group_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'nader ahmed', 'nader.png', '8524456987', 'asd@gmail.com', '2019-04-19 22:00:00', '$2y$10$1qjDeZ2Lx2tWKokNFFYYm.Y3JLByZs7tLcU5m2r72JleTnILZmHiu', 4, 'tJsRi2vp46UIxZLvwO2rDYnHf5Po68PiMrHVOJi8ViBex7WVJKKwrzNBawKt', '2019-04-19 22:00:00', '2019-04-28 22:12:23'),
(3, 'ffffgfg', NULL, '45698713', 'ahmed@gmail.com', NULL, '$2y$10$hvDRLKXwrUtcSUzgMJel6OZjIOztNcNC62UTABKZ8puVJQa8pSVCS', 3, NULL, '2019-04-20 00:57:10', '2019-04-20 00:57:10'),
(4, 'agrisolar', NULL, '123654456123', 'agrisolar@nevdia.com', NULL, '$2y$10$KQksnLseLctufcESoTncIeNcv8SKVnNrq4zQ8YlmN0CSuuL2lnvsu', 3, NULL, '2019-04-21 19:40:09', '2019-04-21 19:40:09'),
(9, 'mohamed', NULL, '789654123', 'mohamed@gmail.com', NULL, '$2y$10$qyUIrn2O9qTuURMrL7PkOeMuXjiKrIwcB2tC3/sdefTTZh9J6rzJG', 4, NULL, '2019-04-28 21:40:46', '2019-04-28 21:40:46'),
(10, 'ahmed', NULL, '123456', 'hamed@gmail.com', NULL, '$2y$10$Nj3zqgxoPWScMxOiSPsvte1dCKfNceVynAmrZJBA4W3hqukEwrIda', 4, NULL, '2019-04-28 21:42:07', '2019-04-28 21:42:07'),
(11, 'nader', NULL, '123654789', 'nader@gmail.com', NULL, '$2y$10$8CkYcjTcft89eMetvmOC1.8dfMd17UQX1FapBmC4pAmxHW35psl4i', 4, NULL, '2019-04-29 20:27:08', '2019-04-29 20:27:08'),
(12, 'nader', NULL, '12365478934', 'naderahmed@gmail.com', NULL, '$2y$10$iSpFyTxCEoJ48qiBMEbrxedv.E1IJknLwd9oDtqCpmzrugygQlRYe', 4, NULL, '2019-04-30 05:21:52', '2019-04-30 05:21:52'),
(13, 'Moustafa', NULL, '01023040030', 'moustafa@nevdia.com', NULL, '$2y$10$SLZU7Tbg12y81eW2.Fxi5Ool0hZ4zrHgW/GBbkFPoSCuA3wBey8ze', 4, NULL, '2019-04-30 19:59:40', '2019-04-30 19:59:40'),
(14, 'mohaed', NULL, '123654789qw', 'ahmed@gmail.coma', NULL, '$2y$10$QV99ySBiyFRFeAwMu/4jEOkwJGgGzz.Oou6moTeO2ExhGZXjIrcKa', 4, NULL, '2019-05-05 03:23:27', '2019-05-05 03:23:27'),
(15, 'nader', NULL, '1236547892121', 'ahmed@gmail.comhamed', NULL, '$2y$10$wAbRprAyfQAFVnaWoDC4punYIRr7W9qoLT3eKSN7eHPMEg48xeyFa', 4, NULL, '2019-05-05 20:20:19', '2019-05-05 20:20:19'),
(16, 'Moustafa', NULL, '01555550889', 'm.abdelmawla36@gmail.com', NULL, '$2y$10$xi.EUIWRa/HhDWymBDcsb.FZ1Ro3L1M4VN2zBINQmLwW9V6kNGeGm', 4, NULL, '2019-05-05 20:31:43', '2019-05-05 20:31:43'),
(17, 'Salah Elmarsafawy', NULL, '01289102435', 'salah@agrisolar-eg.com', NULL, '$2y$10$0ZTTD0eZa.lUPH.DM1HLZOnlZ3IkYKeI4sY74ghYAL39gtL1w7vme', 4, NULL, '2019-05-06 16:36:13', '2019-05-06 16:36:13'),
(18, 'nader', NULL, '123654789322', 'ahmed001@gmail.com', NULL, '$2y$10$KStyfwgd3phh3KLZ2KMUxeSGa8YnW8uqUMMnFXEj..RjSBgfqiKJO', 4, NULL, '2019-05-12 03:11:31', '2019-05-12 03:11:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `groups_slug_unique` (`slug`);

--
-- Indexes for table `height_pumps`
--
ALTER TABLE `height_pumps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `height_pumps_pump_id_index` (`pump_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_pivot_id_index` (`pivot_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pumps`
--
ALTER TABLE `pumps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_group_id_foreign` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `height_pumps`
--
ALTER TABLE `height_pumps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `pumps`
--
ALTER TABLE `pumps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
