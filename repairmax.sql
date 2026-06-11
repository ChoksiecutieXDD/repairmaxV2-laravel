-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2026 at 12:59 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.5.1

SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `repairmax`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_activity_logs`
--

CREATE TABLE `admin_activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `changes` text DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `style` varchar(255) NOT NULL DEFAULT 'info',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tracking_code` varchar(255) NOT NULL,
  `booking_number` varchar(255) DEFAULT NULL,
  `device_brand` varchar(255) NOT NULL,
  `device_model` varchar(255) NOT NULL,
  `fault_category` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `photo_paths` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`photo_paths`)),
  `pref_date` date NOT NULL,
  `pref_time` time NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `quote` decimal(10,2) DEFAULT NULL,
  `final_cost` decimal(10,2) DEFAULT NULL,
  `completion_notes` text DEFAULT NULL,
  `invoice_number` varchar(255) DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `service_method` varchar(255) NOT NULL DEFAULT 'Drop-off' COMMENT 'Drop-off or Pickup',
  `address` varchar(255) DEFAULT NULL COMMENT 'Customer address for pickup service',
  `barangay` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL COMMENT 'City for pickup service',
  `alt_address` varchar(255) DEFAULT NULL,
  `alt_barangay` varchar(255) DEFAULT NULL,
  `alt_city` varchar(255) DEFAULT NULL,
  `additional_fee` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'Additional fees for pickup or other services'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `user_id`, `tracking_code`, `booking_number`, `device_brand`, `device_model`, `fault_category`, `description`, `photo_paths`, `pref_date`, `pref_time`, `status`, `quote`, `final_cost`, `completion_notes`, `invoice_number`, `completed_at`, `created_at`, `updated_at`, `service_method`, `address`, `barangay`, `city`, `alt_address`, `alt_barangay`, `alt_city`, `additional_fee`) VALUES
(3, 5, 'RM-00001', 'Book ID: 3', 'ASUS', 'ROG Phone 7', 'Audio Jack Repair', 'Issue Description:\nIdk hahaha\n\nService Method:\nHome Pickup & Return\n\nPickup Address:\n11 , Brgy. Tatalon, Quezon City\n\nOther Details / Special Instructions:\nHello World', '[\"appointments\\/MaIfSABtLBuLLEhlqbUwgPoLTSFQMDBOiNv3uRyV.mp4\",\"appointments\\/CXT3byc8fEW36EylgeoyAoBEE9s5Vklsd7aoxSYc.jpg\"]', '2026-06-09', '09:00:00', 'Pending', 500.00, NULL, NULL, NULL, NULL, '2026-06-07 05:38:53', '2026-06-07 05:38:53', 'Pickup', '11 , Brgy. Tatalon', NULL, 'Quezon City', NULL, NULL, NULL, 0.00),
(4, 2, 'RM-00002', 'RM-00002', 'Apple', 'iPhone 11', 'Back Glass Replacement', 'Issue Description:\nn/a\n\nService Method:\nDrop-off at Shop\n\nPickup Address:\n11, Bicol Brigade, Bicol brigade, Brgy. Tatalon, Quezon City\n\nAlternative Address:\n11, Bicol Brigade, Bicol brigade, Brgy. Tatalon, Quezon City', '[]', '2026-06-10', '13:00:00', 'Pending', 1800.00, NULL, NULL, NULL, NULL, '2026-06-10 07:14:43', '2026-06-10 07:14:43', 'Drop-off', '11, Bicol Brigade, Bicol brigade', 'Tatalon', 'Quezon City', '11, Bicol Brigade, Bicol brigade', 'Tatalon', 'Quezon City', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Apple', 1, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(2, 'Samsung', 1, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(3, 'Xiaomi', 1, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(4, 'OPPO', 1, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(5, 'vivo', 1, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(6, 'realme', 1, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(7, 'Huawei', 1, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(8, 'Infinix', 1, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(9, 'TECNO', 1, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(10, 'Nothing', 1, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(11, 'Google Pixel', 1, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(12, 'OnePlus', 1, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(13, 'ASUS', 1, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(14, 'Sony', 1, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(15, 'Motorola', 1, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(16, 'Nokia', 1, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(17, 'Lenovo', 1, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(18, 'Honor', 1, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(19, 'ZTE', 1, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(20, 'RedMagic', 1, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(21, 'LG', 1, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(22, 'HTC', 1, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(23, 'Meizu', 1, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(24, 'Black Shark', 1, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(25, 'POCO', 1, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(26, 'HP', 1, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(27, 'Dell', 1, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(28, 'Acer', 1, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(29, 'MSI', 1, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(30, 'Gigabyte', 1, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(31, 'Razer', 1, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(32, 'Nintendo', 1, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(33, 'PlayStation', 1, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(34, 'Xbox', 1, '2026-05-17 07:05:13', '2026-05-17 07:05:13');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chatbot_messages`
--

CREATE TABLE `chatbot_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `chatbot_session_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata`)),
  `is_user` tinyint(1) NOT NULL DEFAULT 0,
  `message` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chatbot_messages`
--

INSERT INTO `chatbot_messages` (`id`, `chatbot_session_id`, `created_at`, `updated_at`, `metadata`, `is_user`, `message`) VALUES
(12, 2, '2026-05-10 05:07:09', '2026-05-10 05:07:09', NULL, 1, 'how you doing'),
(13, 2, '2026-05-10 05:07:09', '2026-05-10 05:07:09', NULL, 0, 'I\'m here, but I\'m having trouble thinking clearly.'),
(14, 2, '2026-05-10 05:55:21', '2026-05-10 05:55:21', NULL, 1, 'Test'),
(15, 2, '2026-05-10 05:55:23', '2026-05-10 05:55:23', NULL, 0, 'I\'m here, but I\'m having trouble thinking clearly.'),
(16, 2, '2026-05-10 05:56:36', '2026-05-10 05:56:36', NULL, 1, 'hello'),
(17, 2, '2026-05-10 05:56:37', '2026-05-10 05:56:37', NULL, 0, 'I\'m here, but I\'m having trouble thinking clearly.'),
(18, 2, '2026-05-10 05:57:54', '2026-05-10 05:57:54', NULL, 1, 'hello world'),
(19, 2, '2026-05-10 05:57:55', '2026-05-10 05:57:55', NULL, 0, 'Since there\'s no message, let\'s start fresh. What seems to be the problem with your device? Is it a phone, laptop, or something else? Please provide the brand and model, and describe the issue you\'re experiencing.'),
(20, 2, '2026-05-10 05:58:07', '2026-05-10 05:58:07', NULL, 1, 'what is your name'),
(21, 2, '2026-05-10 05:58:07', '2026-05-10 05:58:07', NULL, 0, 'I\'m having trouble connecting to my brain right now.'),
(22, 2, '2026-05-10 05:58:19', '2026-05-10 05:58:19', NULL, 1, 'what is your name?'),
(23, 2, '2026-05-10 05:58:19', '2026-05-10 05:58:19', NULL, 0, 'It looks like there\'s still no message. To help you, I need to know what device you\'re having trouble with. Can you please provide the device brand, model, and a description of the problem?'),
(24, 2, '2026-05-10 06:06:23', '2026-05-10 06:06:23', NULL, 1, 'good evening maxie'),
(25, 2, '2026-05-10 06:06:24', '2026-05-10 06:06:24', NULL, 0, 'Evening. What seems to be the issue with your device? Can you please tell me the brand, model, and what\'s not working the way it should?'),
(26, 2, '2026-05-10 06:07:11', '2026-05-10 06:07:11', NULL, 1, 'Hey maxieee'),
(27, 2, '2026-05-10 06:07:11', '2026-05-10 06:07:11', NULL, 0, 'Let\'s get down to business. I\'d love to help you with your device issue. Can you please tell me what kind of device you\'re having trouble with (e.g. phone, laptop, tablet), the brand (e.g. Apple, Samsung), the model, and what\'s not working correctly? 🔧💡'),
(28, 2, '2026-05-10 06:07:57', '2026-05-10 06:07:57', NULL, 1, 'who are you baby'),
(29, 2, '2026-05-10 06:07:58', '2026-05-10 06:07:58', NULL, 0, 'I\'m Maxie, your Repairmax AI assistant, here to help you fix your device issues 📱. Let\'s focus on getting your device up and running. To do that, I need some information from you. Can you please tell me the brand, model, and what\'s not working with your device? 💡'),
(40, 8, '2026-06-07 05:15:58', '2026-06-07 05:15:58', NULL, 1, 'My Laptop Won\'t Start'),
(41, 8, '2026-06-07 05:15:58', '2026-06-07 05:15:58', NULL, 0, 'Sorry to hear that your laptop won\'t start. Can you please tell me more about the issue? What happens when you press the power button? Does it make any noise, display any lights, or is it completely unresponsive?\n\nAlso, what\'s the brand and model of your laptop?'),
(42, 9, '2026-06-07 05:16:08', '2026-06-07 05:16:08', NULL, 1, 'Battery Drains Too Fast'),
(43, 9, '2026-06-07 05:16:09', '2026-06-07 05:16:09', NULL, 0, 'A battery drain issue can be frustrating. It\'s good that you mentioned it. To better understand the problem, can you please tell me the make and model of your laptop?'),
(44, 10, '2026-06-07 05:16:17', '2026-06-07 05:16:17', NULL, 1, 'Screen Turns Black Randomly'),
(45, 10, '2026-06-07 05:16:18', '2026-06-07 05:16:18', NULL, 0, 'That sounds like a concerning issue. It\'s possible that it\'s a hardware or software problem. To help me narrow it down, can you please tell me the brand and model of your laptop?'),
(46, 10, '2026-06-07 05:16:25', '2026-06-07 05:16:25', NULL, 1, 'Computer Running Very Slow'),
(47, 10, '2026-06-07 05:16:26', '2026-06-07 05:16:26', NULL, 0, 'A slow computer can be a real pain. Let\'s try to figure out what\'s causing it. Have you recently installed any new software or apps that might be consuming system resources?'),
(50, 8, '2026-06-07 05:19:52', '2026-06-07 05:19:52', NULL, 1, 'No lights or sounds.'),
(51, 8, '2026-06-07 05:19:52', '2026-06-07 05:19:52', NULL, 0, 'That suggests a possible power issue. Can you please try pressing the power button for a longer period, maybe 30 seconds or so, to see if it makes any difference? Also, do you have any other devices plugged into the same power source or outlet as your laptop?'),
(52, 10, '2026-06-08 21:43:55', '2026-06-08 21:43:55', NULL, 1, 'yo there?'),
(53, 10, '2026-06-08 21:43:57', '2026-06-08 21:43:57', NULL, 0, 'System error. Please try again later.');

-- --------------------------------------------------------

--
-- Table structure for table `chatbot_sessions`
--

CREATE TABLE `chatbot_sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT 'New Chat',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chatbot_sessions`
--

INSERT INTO `chatbot_sessions` (`id`, `user_id`, `title`, `created_at`, `updated_at`) VALUES
(2, 10, 'how you doing', '2026-05-10 05:07:09', '2026-05-10 05:07:09'),
(8, 2, 'My Laptop Won\'t Start', '2026-06-07 05:15:58', '2026-06-07 05:15:58'),
(9, 2, 'Battery Drains Too Fast', '2026-06-07 05:16:08', '2026-06-07 05:16:08'),
(10, 2, 'Screen Turns Black Randomly', '2026-06-07 05:16:17', '2026-06-07 05:16:17');

-- --------------------------------------------------------

--
-- Table structure for table `device_models`
--

CREATE TABLE `device_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `device_models`
--

INSERT INTO `device_models` (`id`, `brand_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'iPhone XS', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(2, 1, 'iPhone 11', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(3, 1, 'iPhone 12', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(4, 1, 'iPhone 13', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(5, 1, 'iPhone 14', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(6, 1, 'iPhone 15', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(7, 1, 'iPhone 15 Pro Max', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(8, 2, 'Galaxy S21', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(9, 2, 'Galaxy S22', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(10, 2, 'Galaxy S23', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(11, 2, 'Galaxy S24 Ultra', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(12, 2, 'Galaxy A54', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(13, 3, 'Redmi Note 12', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(14, 3, 'Redmi Note 13 Pro', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(15, 3, 'Xiaomi 13', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(16, 3, 'Xiaomi 14 Ultra', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(17, 4, 'Reno 10', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(18, 4, 'Reno 11 Pro', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(19, 4, 'Find X6', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(20, 5, 'V27', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(21, 5, 'V29 Pro', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(22, 5, 'Y17s', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(23, 6, 'realme 11 Pro', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(24, 6, 'realme C55', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(25, 6, 'realme GT Neo 5', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(26, 7, 'Mate 50 Pro', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(27, 7, 'Mate 60 Pro', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(28, 7, 'P60 Pro', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(29, 8, 'Note 30', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(30, 8, 'Zero 30', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(31, 8, 'Hot 30i', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(32, 9, 'Camon 20', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(33, 9, 'Pova 5', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(34, 9, 'Spark 10 Pro', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(35, 10, 'Phone (1)', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(36, 10, 'Phone (2)', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(37, 11, 'Pixel 6a', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(38, 11, 'Pixel 7 Pro', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(39, 11, 'Pixel 8 Pro', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(40, 12, 'OnePlus 10 Pro', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(41, 12, 'OnePlus 11', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(42, 12, 'OnePlus 12', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(43, 13, 'ROG Phone 7', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(44, 13, 'Zenfone 10', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(45, 14, 'Xperia 1 V', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(46, 14, 'Xperia 5 V', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(47, 15, 'Edge 40', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(48, 15, 'Razr 40 Ultra', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(49, 16, 'Nokia G42', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(50, 16, 'Nokia X30', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(51, 17, 'Legion Y70', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(52, 18, 'Honor 90', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(53, 18, 'Honor Magic5 Pro', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(54, 19, 'Blade V50', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(55, 19, 'Axon 50 Ultra', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(56, 20, 'RedMagic 8S Pro', '2026-05-17 07:11:02', '2026-05-17 07:11:02'),
(57, 20, 'RedMagic 9 Pro', '2026-05-17 07:11:02', '2026-05-17 07:11:02');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fault_types`
--

CREATE TABLE `fault_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `base_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `description` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `gallery_paths` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`gallery_paths`)),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fault_types`
--

INSERT INTO `fault_types` (`id`, `name`, `category`, `base_price`, `description`, `image_path`, `gallery_paths`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Audio Jack Repair', 'audio', 500.00, 'Repairs loose, damaged, or non-functional audio jacks to restore proper headphone and earphone connectivity.', 'storage/services/6196I1uj5kRm98Vr5i3rseJe7o2rDxMAVDV4zWge.jpg', '[]', 1, '2026-06-05 08:25:26', '2026-06-06 06:38:55'),
(2, 'LCD/Screen Replacement', 'screen', 2500.00, 'Replaces cracked, flickering, unresponsive, or damaged screens with a new LCD/display assembly.', 'storage/services/CQUT1KvFPGUmEgpwIs35zfFGacVlRSauUTyA09iR.jpg', '[]', 1, '2026-06-05 08:25:26', '2026-06-06 06:39:56'),
(3, 'Battery Replacement', 'power', 1200.00, 'Installs a new battery for devices experiencing fast battery drain, overheating, or unexpected shutdowns.', 'storage/services/PGzgSSzf1sQ8VjOEvXvnXUyh5UgcuHu5lo2CSb4f.jpg', '[]', 1, '2026-06-05 08:25:26', '2026-06-06 06:39:07'),
(4, 'Charging Port Repair', 'power', 800.00, 'Fixes charging issues caused by damaged, loose, or dirty charging ports to restore proper power connection.', 'storage/services/dOUfXZnUG31Ol71rrV0b01Qxjhpna1ChBRX6BYpl.jpg', '[]', 1, '2026-06-05 08:25:26', '2026-06-06 06:40:03'),
(5, 'Speaker Repair', 'audio', 700.00, 'Repairs distorted, low-volume, or non-working speakers to improve device audio output quality.', 'storage/services/QWJFrcMvqvZGUWyEwE3VTLEQlCRLsY4N9hCCZagl.jpg', '[]', 1, '2026-06-05 08:25:26', '2026-06-06 06:41:43'),
(6, 'Microphone Repair', 'audio', 700.00, 'Resolves microphone issues affecting voice calls, recordings, or voice command functionality.', 'storage/services/9ATICaLvOowpxirqDB6k5BvzW5j8U7942wSSiIZb.jpg', '[]', 1, '2026-06-05 08:25:26', '2026-06-06 06:45:03'),
(7, 'Camera Repair', 'hardware', 1500.00, 'Repairs blurry, malfunctioning, or damaged front and rear cameras for proper photo and video performance.', 'storage/services/pBWOzFW4an0iLPF7diMnKAVBG5w0ZLs6ad1hq17Z.jpg', '[]', 1, '2026-06-05 08:25:26', '2026-06-06 06:45:12'),
(8, 'Power Button Repair', 'power', 600.00, 'Fixes stuck, loose, or unresponsive power buttons to restore device power control functions.', 'storage/services/EBn99o3nLDDYILpjjpKxK65E6PrfuMAstVfGKxZ2.jpg', '[]', 1, '2026-06-05 08:25:26', '2026-06-06 06:46:35'),
(9, 'Volume Button Repair', 'hardware', 600.00, 'Repairs faulty volume buttons that no longer adjust sound levels properly.', 'storage/services/fDcf6mUQAPDgvOoECiyHMYNXLrtzvyPGocpXrTZN.jpg', '[]', 1, '2026-06-05 08:25:26', '2026-06-06 06:46:50'),
(10, 'Water Damage Repair', 'hardware', 1500.00, 'Performs cleaning, diagnostics, and component repair for devices exposed to water or liquid damage.', 'storage/services/QTYJZtDPb1Pc8QDX7cHQwTjaLDLZZZoUfOrhFxF6.jpg', '[]', 1, '2026-06-05 08:25:26', '2026-06-06 06:46:58'),
(11, 'Back Glass Replacement', 'screen', 1800.00, 'Replaces cracked or damaged back glass panels to restore device appearance and protection.', 'storage/services/1tqzRt3jCfctsPIQRiMcxNJohHibRvufu0Uh2A2R.jpg', '[]', 1, '2026-06-05 08:25:26', '2026-06-06 06:47:06'),
(16, 'Face ID / Fingerprint Sensor Repair', 'hardware', 2000.00, 'Repairs biometric authentication features that are not detecting fingerprints or facial recognition properly.', 'storage/services/k8dANNAJbTyJYdjd9OY7DzSEVnxnx3GxvLzi0cRv.png', '[]', 1, '2026-06-05 08:25:26', '2026-06-06 06:51:35'),
(17, 'Motherboard Repair', 'hardware', 3500.00, 'Diagnoses and repairs damaged motherboard components affecting overall device functionality.', 'storage/services/LLo7KbZe9AU6aOTz8TTyX6DI9w6zMkkwNyTHPnby.jpg', '[]', 1, '2026-06-05 08:25:26', '2026-06-06 06:51:29'),
(18, 'Overheating Issue Repair', 'hardware', 1000.00, 'Identifies and resolves hardware or software causes of excessive device heating.', 'storage/services/ApOLAzJfbtw97ReR6RjiH65DVfKINdnMFuD4cOnN.jpg', '[]', 1, '2026-06-05 08:25:26', '2026-06-06 06:51:22'),
(19, 'Wi-Fi / Bluetooth Repair', 'hardware', 1200.00, 'Repairs wireless connectivity issues affecting Wi-Fi and Bluetooth performance.', 'storage/services/RLSycdbG2msY9UGHWsfWYzcv984sIx8cGMDVQWda.jpg', '[\"storage\\/services\\/w0fGd73srRvZ2roaLIXsSJ7VucWFiTAST7BTZoEU.jpg\"]', 1, '2026-06-05 08:25:26', '2026-06-06 06:51:15'),
(20, 'Data Recovery Service', 'software', 2500.00, 'Attempts to recover lost, deleted, or inaccessible files, photos, videos, and documents from damaged devices.', 'storage/services/6fBsR2s1b1WGW0nv79tIqKxhVJOJ2Wm8I9eRTyB3.png', '[]', 1, '2026-06-05 08:25:26', '2026-06-06 06:47:24'),
(21, 'Software Troubleshooting', 'software', 500.00, 'Diagnoses and resolves software-related problems such as lagging, freezing, crashes, and app errors.', 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=400&h=400&fit=crop', NULL, 1, '2026-06-10 04:12:53', '2026-06-10 04:12:53'),
(22, 'Operating System Reinstallation', 'software', 800.00, 'Reinstalls the device operating system to fix severe software corruption or system failures.', 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=400&h=400&fit=crop', NULL, 1, '2026-06-10 04:12:53', '2026-06-10 04:12:53'),
(23, 'Boot Loop Fix', 'software', 900.00, 'Repairs devices stuck on startup logos or continuously restarting during boot.', 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=400&h=400&fit=crop', NULL, 1, '2026-06-10 04:12:53', '2026-06-10 04:12:53'),
(24, 'Tablet Screen Repair', 'screen', 3000.00, 'Professional glass and LCD replacement services for iPads and Android tablets.', 'https://images.unsplash.com/photo-1544244015-0df4b3ffc6b0?w=400&h=400&fit=crop', NULL, 1, '2026-06-10 04:12:53', '2026-06-10 04:12:53'),
(25, 'MacBook Display Repair', 'screen', 8500.00, 'Premium screen and backlight assembly replacement for MacBook Air and MacBook Pro models.', 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=400&h=400&fit=crop', NULL, 1, '2026-06-10 04:12:53', '2026-06-10 04:12:53'),
(26, 'Wireless Charging Repair', 'power', 1500.00, 'Fixes issues with wireless charging coils and motherboard power management chips.', 'https://images.unsplash.com/photo-1622445262465-2481c8573290?w=400&h=400&fit=crop', NULL, 1, '2026-06-10 04:12:53', '2026-06-10 04:12:53'),
(27, 'Earpiece Speaker Repair', 'audio', 600.00, 'Resolves low-volume, crackling, or non-functional ear speakers during voice calls.', 'https://images.unsplash.com/photo-1574920162043-b8728536b98b?w=400&h=400&fit=crop', NULL, 1, '2026-06-10 04:12:53', '2026-06-10 04:12:53'),
(28, 'Apple Watch Screen Repair', 'screen', 2500.00, 'Repair and replacement of damaged, cracked, or unresponsive Apple Watch screens.', NULL, NULL, 1, '2026-06-10 04:30:43', '2026-06-10 04:30:43'),
(29, 'Apple Watch Glass Replacement', 'screen', 1800.00, 'Replacement of cracked front glass on Apple Watches while retaining original LCD/OLED panel.', NULL, NULL, 1, '2026-06-10 04:30:43', '2026-06-10 04:30:43'),
(30, 'Smartwatch Display Repair', 'screen', 1500.00, 'Professional repair for cracked, bleeding, or faulty smartwatch screens.', NULL, NULL, 1, '2026-06-10 04:30:43', '2026-06-10 04:30:43'),
(31, 'Apple Watch Battery Replacement', 'power', 1200.00, 'Replacement of degraded or swollen Apple Watch batteries to restore original battery life.', NULL, NULL, 1, '2026-06-10 04:30:43', '2026-06-10 04:30:43'),
(32, 'Apple Watch Charger Port Repair', 'power', 1000.00, 'Repair or replacement of the induction charging sensor and charging contacts.', NULL, NULL, 1, '2026-06-10 04:30:43', '2026-06-10 04:30:43'),
(33, 'Smartwatch Charging Issue Fix', 'power', 800.00, 'Diagnostics and repair of charging connectivity issues for various smartwatch models.', NULL, NULL, 1, '2026-06-10 04:30:43', '2026-06-10 04:30:43'),
(34, 'Apple Watch Speaker Repair', 'audio', 900.00, 'Replacement of blown or muffled speakers on Apple Watches to restore clear audio.', NULL, NULL, 1, '2026-06-10 04:30:43', '2026-06-10 04:30:43'),
(35, 'Apple Watch Microphone Repair', 'audio', 900.00, 'Repair of Siri and call microphone connectivity issues on Apple Watch.', NULL, NULL, 1, '2026-06-10 04:30:43', '2026-06-10 04:30:43'),
(36, 'Smartwatch Audio Troubleshooting', 'audio', 600.00, 'Fixing muffled sound, speaker static, or microphone failure on smartwatches.', NULL, NULL, 1, '2026-06-10 04:30:43', '2026-06-10 04:30:43'),
(37, 'Apple Watch Software Restore', 'software', 800.00, 'Restoring Apple Watch software or updating watchOS when stuck on logo or boot loops.', NULL, NULL, 1, '2026-06-10 04:30:43', '2026-06-10 04:30:43'),
(38, 'Apple Watch OS Diagnostics', 'software', 500.00, 'Complete diagnostic run of watchOS software to identify connectivity and system errors.', NULL, NULL, 1, '2026-06-10 04:30:43', '2026-06-10 04:30:43'),
(39, 'Smartwatch Firmware Reinstallation', 'software', 700.00, 'Reinstalling firmware or flashing operating system to resolve boot errors on smartwatches.', NULL, NULL, 1, '2026-06-10 04:30:43', '2026-06-10 04:30:43');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_items`
--

CREATE TABLE `inventory_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `sku` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `unit_price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventory_items`
--

INSERT INTO `inventory_items` (`id`, `brand_id`, `name`, `category`, `sku`, `quantity`, `unit_price`, `created_at`, `updated_at`) VALUES
(1, 1, 'iPhone Screen Replacement', 'Screens', 'SKU-IPH-SCR', 45, 2500.00, '2026-05-17 07:12:29', '2026-06-05 08:25:26'),
(2, 2, 'Galaxy Battery Replacement', 'Batteries', 'SKU-GAL-BAT', 18, 950.00, '2026-05-17 07:12:29', '2026-06-05 08:25:26'),
(3, 1, 'MacBook Keyboard Assembly', 'Keyboards', 'SKU-MAC-KBD', 15, 3500.00, '2026-05-17 07:12:29', '2026-06-05 08:25:26');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `admin_read` tinyint(1) NOT NULL DEFAULT 0,
  `admin_read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `admin_id`, `subject`, `message`, `is_read`, `admin_read`, `admin_read_at`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'hello', 'world', 0, 0, NULL, '2026-06-10 08:12:58', '2026-06-10 08:12:58'),
(2, 2, NULL, 'hello', 'world', 0, 0, NULL, '2026-06-10 08:25:29', '2026-06-10 08:25:29');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_03_25_121935_create_repairs_table', 2),
(5, '2026_03_25_update_admin_email', 2),
(6, '2026_03_25_122825_create_appointments_table', 3),
(7, '2026_03_26_000000_create_settings_table', 4),
(8, '2026_03_26_010000_create_inventory_items_table', 4),
(9, '2026_04_04_000000_create_notifications_table', 5),
(10, '2026_04_04_000001_create_user_profiles_table', 5),
(11, '2026_04_04_000002_consolidate_profiles_to_users_table', 6),
(12, '2026_04_04_000003_add_country_to_users_table', 7),
(13, '2026_04_04_000004_convert_photo_path_to_json_on_appointments', 8),
(14, '2026_04_04_152656_create_messages_table', 9),
(15, '2026_04_04_add_cost_fields_to_appointments', 9),
(16, '2026_05_10_094956_create_chatbot_tables', 9),
(22, '2026_05_14_105011_create_brands_table', 10),
(23, '2026_05_14_105012_create_fault_types_table', 10),
(24, '2026_05_14_105110_add_brand_id_to_inventory_items_table', 10),
(25, '2026_05_17_131634_add_description_and_image_path_to_fault_types_table', 10),
(26, '2026_05_17_142500_add_gallery_paths_to_fault_types_table', 10),
(27, '2026_05_17_151007_create_device_models_table', 11),
(28, '2026_05_18_231300_add_category_to_fault_types_table', 12),
(29, '2026_05_19_130132_add_booking_number_to_appointments_table', 13),
(30, '2026_05_19_141612_change_role_column_to_string_in_users_table', 14),
(31, '2026_05_20_add_pickup_fields_to_appointments_table', 15),
(32, '2026_05_25_create_chatbot_messages_table', 16),
(33, '2026_06_03_133216_create_announcements_table', 17),
(34, '2026_06_03_133226_create_supported_cities_table', 17),
(35, '2026_06_03_162647_add_shipping_fee_to_supported_cities', 18),
(36, '2026_06_09_014938_add_barangay_and_alt_address_fields_to_tables', 19);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `related_model` varchar(255) DEFAULT NULL,
  `related_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `admin_id`, `title`, `message`, `type`, `related_model`, `related_id`, `is_read`, `read_at`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Appointment Scheduled', 'Your repair appointment has been scheduled. Please check the details in your booking.', 'appointment_confirmation', 'Appointment', NULL, 1, '2026-06-07 02:14:41', '2026-06-05 08:25:26', '2026-06-07 02:14:41'),
(2, 2, 1, 'Repair Status Update', 'Your repair is currently in progress. We will notify you once it is completed.', 'repair_update', 'Repair', NULL, 0, NULL, '2026-06-05 08:25:26', '2026-06-05 08:25:26'),
(3, 2, 3, 'Repair Completed', 'Your repair has been completed successfully. Please collect your device.', 'repair_completed', 'Repair', NULL, 1, '2026-06-03 08:25:26', '2026-06-05 08:25:26', '2026-06-05 08:25:26'),
(4, 1, 3, 'New Admin Created', 'A new admin account has been created in the system.', 'admin_alert', 'User', NULL, 0, NULL, '2026-06-05 08:25:26', '2026-06-05 08:25:26'),
(5, 1, NULL, 'Daily Report Ready', 'Your daily activity report is ready. Click to view the details.', 'system_alert', NULL, NULL, 0, NULL, '2026-06-05 08:25:26', '2026-06-05 08:25:26'),
(6, 3, 1, 'New Admin Created', 'A new admin account has been created in the system.', 'admin_alert', 'User', NULL, 0, NULL, '2026-06-05 08:25:26', '2026-06-05 08:25:26'),
(7, 3, NULL, 'Daily Report Ready', 'Your daily activity report is ready. Click to view the details.', 'system_alert', NULL, NULL, 0, NULL, '2026-06-05 08:25:26', '2026-06-05 08:25:26'),
(8, 1, 1, 'New Appointment Booking', 'Jane Doe has booked a repair appointment (Tracking: RM-00001) for ASUS - Audio Jack Repair', 'appointment_booked', 'Appointment', 3, 0, NULL, '2026-06-07 05:38:53', '2026-06-07 05:38:53'),
(9, 3, 3, 'New Appointment Booking', 'Jane Doe has booked a repair appointment (Tracking: RM-00001) for ASUS - Audio Jack Repair', 'appointment_booked', 'Appointment', 3, 0, NULL, '2026-06-07 05:38:53', '2026-06-07 05:38:53'),
(10, 1, 1, 'New Appointment Booking', 'Regular User has booked an appointment (Tracking: RM-00002) for Apple - Back Glass Replacement', 'appointment_booked', 'Appointment', 4, 0, NULL, '2026-06-10 07:14:43', '2026-06-10 07:14:43'),
(11, 3, 3, 'New Appointment Booking', 'Regular User has booked an appointment (Tracking: RM-00002) for Apple - Back Glass Replacement', 'appointment_booked', 'Appointment', 4, 0, NULL, '2026-06-10 07:14:43', '2026-06-10 07:14:43'),
(12, 1, 1, 'New Contact Message', 'Admin System sent a contact inquiry: hello', 'contact_inquiry', 'Message', 1, 0, NULL, '2026-06-10 08:12:58', '2026-06-10 08:12:58'),
(13, 3, 3, 'New Contact Message', 'Admin System sent a contact inquiry: hello', 'contact_inquiry', 'Message', 1, 0, NULL, '2026-06-10 08:12:58', '2026-06-10 08:12:58'),
(14, 1, 1, 'New Contact Message', 'Regular User sent a contact inquiry: hello', 'contact_inquiry', 'Message', 2, 0, NULL, '2026-06-10 08:25:29', '2026-06-10 08:25:29'),
(15, 3, 3, 'New Contact Message', 'Regular User sent a contact inquiry: hello', 'contact_inquiry', 'Message', 2, 0, NULL, '2026-06-10 08:25:29', '2026-06-10 08:25:29');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('tan1925alex@gmail.com', 'dJbuxgFizkf5c9wefn3Ivm5nMks8PodhYuOCn233Eam1kocMuFLf7OYfv3MGJz9x', '2026-06-05 03:27:58');

-- --------------------------------------------------------

--
-- Table structure for table `repairs`
--

CREATE TABLE `repairs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tracking_code` varchar(255) NOT NULL,
  `device_name` varchar(255) NOT NULL,
  `issue_type` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `quote` decimal(10,2) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `repairs`
--

INSERT INTO `repairs` (`id`, `user_id`, `tracking_code`, `device_name`, `issue_type`, `status`, `quote`, `notes`, `created_at`, `updated_at`) VALUES
(1, 2, 'RM-00001', 'iPhone 14 Pro', 'Screen Replacement', 'Completed', 4903.00, 'Device inspection completed. Estimate provided to customer.', '2026-06-05 08:25:26', '2026-06-05 08:25:26'),
(2, 2, 'RM-00002', 'iPhone 14 Pro', 'Screen Replacement', 'In Progress', 1564.00, 'Device inspection completed. Estimate provided to customer.', '2026-06-05 08:25:26', '2026-06-05 08:25:26'),
(3, 2, 'RM-00003', 'iPhone 14 Pro', 'Screen Replacement', 'Pending', 3451.00, 'Device inspection completed. Estimate provided to customer.', '2026-06-05 08:25:26', '2026-06-05 08:25:26');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('c5bkLtFSXnqJM3mVhUCy7T75IZqZgS4cHnK4u3NO', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaHhzVmhxUUx1eERaWWk2cGFzV3l5bzZBdnhtNzhlekhWcXFVbWFpcCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9oZWxwL2NvbnRhY3QiO3M6NToicm91dGUiO3M6MTI6ImhlbHAuY29udGFjdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1781108910),
('tr3QknBSnvBW35d7Yx5aEjjvBk9EEk3XD2BCcfRx', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSjhROUhtaWJXbEptQUxpQjFzTTN1ZVJYNXA1Y0ozeTBTNlA3WHNwbSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1781139540),
('wNop3DfUgB3RBPcnXvJ5utxmWzlppEPIq4fJN5xQ', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaHY5ZlI3Q3hXRjd2aDRIVUhIZDM1bEFSbnRlMnN2WWgzZHRkN3NwSSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9jYWxlbmRhciI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4uY2FsZW5kYXIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1781111051);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`value`)),
  `category` varchar(255) NOT NULL DEFAULT 'general',
  `type` varchar(255) NOT NULL DEFAULT 'string',
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `category`, `type`, `description`, `created_at`, `updated_at`) VALUES
(1, 'businessName', '\"Repairmax\"', 'general', 'string', NULL, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(2, 'businessEmail', '\"repairmaxsample@gmail.com\"', 'general', 'string', NULL, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(3, 'businessPhone', '\"+63 912 345 6789\"', 'general', 'string', NULL, '2026-05-17 07:05:13', '2026-06-10 08:59:41'),
(4, 'businessAddress', '\"Commonwealth Ave. Cor. IBP Road (Litex Junction), Brgy. Payatas, Quezon City, 1119\"', 'general', 'string', NULL, '2026-05-17 07:05:13', '2026-06-10 08:59:41'),
(5, 'businessCity', '\"Manila\"', 'general', 'string', NULL, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(6, 'businessState', '\"NCR\"', 'general', 'string', NULL, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(7, 'businessZipCode', '\"1000\"', 'general', 'string', NULL, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(8, 'businessWebsite', '\"https:\\/\\/repairmax.online\\/\"', 'general', 'string', NULL, '2026-05-17 07:05:13', '2026-06-10 08:59:41'),
(9, 'smtpHost', '\"smtp-relay.brevo.com\"', 'email', 'string', NULL, '2026-05-17 07:05:13', '2026-06-10 08:59:41'),
(10, 'smtpPort', '\"587\"', 'email', 'string', NULL, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(11, 'emailFromAddress', '\"repairmaxsample@gmail.com\"', 'email', 'string', NULL, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(12, 'emailFromName', '\"Repairmax\"', 'email', 'string', NULL, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(13, 'emailNotificationsEnabled', 'true', 'email', 'string', NULL, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(14, 'appointmentReminders', 'true', 'notifications', 'string', NULL, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(15, 'appointmentReminderTime', '\"24\"', 'notifications', 'string', NULL, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(16, 'statusUpdateNotifications', 'true', 'notifications', 'string', NULL, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(17, 'adminAlerts', 'true', 'notifications', 'string', NULL, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(18, 'paymentGateway', '\"stripe\"', 'payment', 'string', NULL, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(19, 'currencyCode', '\"PHP\"', 'payment', 'string', NULL, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(20, 'taxPercentage', '\"0\"', 'payment', 'string', NULL, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(21, 'businessHours', '\"{\\\"monday\\\":{\\\"open\\\":\\\"08:00\\\",\\\"close\\\":\\\"18:00\\\"},\\\"tuesday\\\":{\\\"open\\\":\\\"08:00\\\",\\\"close\\\":\\\"18:00\\\"},\\\"wednesday\\\":{\\\"open\\\":\\\"08:00\\\",\\\"close\\\":\\\"18:00\\\"},\\\"thursday\\\":{\\\"open\\\":\\\"08:00\\\",\\\"close\\\":\\\"18:00\\\"},\\\"friday\\\":{\\\"open\\\":\\\"08:00\\\",\\\"close\\\":\\\"18:00\\\"},\\\"saturday\\\":{\\\"open\\\":\\\"09:00\\\",\\\"close\\\":\\\"16:00\\\"},\\\"sunday\\\":{\\\"open\\\":\\\"\\\",\\\"close\\\":\\\"\\\"}}\"', 'business', 'string', NULL, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(22, 'passwordMinLength', '\"8\"', 'security', 'string', NULL, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(23, 'passwordRequireNumbers', 'true', 'security', 'string', NULL, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(24, 'passwordRequireSpecialChars', 'true', 'security', 'string', NULL, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(25, 'passwordExpireDays', '\"90\"', 'security', 'string', NULL, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(26, 'twoFactorAuthRequired', 'false', 'security', 'string', NULL, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(27, 'sessionTimeout', '\"60\"', 'security', 'string', NULL, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(28, 'maxLoginAttempts', '\"5\"', 'security', 'string', NULL, '2026-05-17 07:05:13', '2026-05-17 07:05:13'),
(29, 'n8nWebhookUrl', '\"http:\\/\\/localhost:5678\\/webhook-test\\/chatbot\"', 'system', 'string', NULL, '2026-05-22 06:12:37', '2026-05-22 06:12:37'),
(30, 'n8nWebhookSecret', '\"repairmax_secret_123\"', 'system', 'string', NULL, '2026-05-22 06:12:37', '2026-05-22 06:12:37'),
(31, 'autoBackupTime', '\"02:00\"', 'system', 'string', NULL, '2026-05-22 06:12:37', '2026-05-22 06:12:37'),
(32, 'maintenanceMode', 'true', 'system', 'string', NULL, '2026-05-22 06:17:48', '2026-06-10 08:46:37'),
(33, 'smtpUsername', '\"adddb0001@smtp-brevo.com\"', 'email', 'string', NULL, '2026-06-10 08:59:41', '2026-06-10 08:59:41');

-- --------------------------------------------------------

--
-- Table structure for table `supported_cities`
--

CREATE TABLE `supported_cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `shipping_fee` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supported_cities`
--

INSERT INTO `supported_cities` (`id`, `name`, `is_active`, `created_at`, `updated_at`, `shipping_fee`) VALUES
(1, 'Quezon City', 1, '2026-06-03 05:33:59', '2026-06-03 05:33:59', 0.00),
(2, 'Manila', 1, '2026-06-03 05:33:59', '2026-06-03 05:33:59', 0.00),
(3, 'Caloocan', 1, '2026-06-03 05:33:59', '2026-06-03 05:33:59', 0.00),
(4, 'Las Piñas', 1, '2026-06-03 05:33:59', '2026-06-03 05:33:59', 0.00),
(5, 'Makati', 1, '2026-06-03 05:33:59', '2026-06-03 05:33:59', 0.00),
(6, 'Malabon', 1, '2026-06-03 05:33:59', '2026-06-03 05:33:59', 0.00),
(7, 'Mandaluyong', 1, '2026-06-03 05:33:59', '2026-06-03 05:33:59', 0.00),
(8, 'Marikina', 1, '2026-06-03 05:33:59', '2026-06-03 05:33:59', 0.00),
(9, 'Muntinlupa', 1, '2026-06-03 05:33:59', '2026-06-03 05:33:59', 0.00),
(10, 'Navotas', 1, '2026-06-03 05:33:59', '2026-06-03 05:33:59', 0.00),
(11, 'Parañaque', 1, '2026-06-03 05:33:59', '2026-06-03 05:33:59', 0.00),
(12, 'Pasay', 1, '2026-06-03 05:33:59', '2026-06-03 05:33:59', 0.00),
(13, 'Pasig', 1, '2026-06-03 05:33:59', '2026-06-03 05:33:59', 0.00),
(14, 'San Juan', 1, '2026-06-03 05:33:59', '2026-06-03 05:33:59', 0.00),
(15, 'Taguig', 1, '2026-06-03 05:33:59', '2026-06-03 05:33:59', 0.00),
(16, 'Valenzuela', 1, '2026-06-03 05:33:59', '2026-06-03 05:33:59', 0.00),
(17, 'Pateros', 1, '2026-06-03 05:33:59', '2026-06-03 05:33:59', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `barangay` varchar(255) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `alt_address` varchar(255) DEFAULT NULL,
  `alt_barangay` varchar(255) DEFAULT NULL,
  `alt_city` varchar(255) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'user',
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `verification_token` varchar(255) DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_token_expiry` datetime DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bio` varchar(500) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `alternative_phone` varchar(255) DEFAULT NULL,
  `emergency_contact` varchar(255) DEFAULT NULL,
  `email_notifications` tinyint(1) NOT NULL DEFAULT 1,
  `sms_notifications` tinyint(1) NOT NULL DEFAULT 0,
  `push_notifications` tinyint(1) NOT NULL DEFAULT 1,
  `status` enum('active','inactive','suspended') NOT NULL DEFAULT 'active',
  `suspension_reason` text DEFAULT NULL,
  `suspended_at` timestamp NULL DEFAULT NULL,
  `preferred_language` varchar(255) NOT NULL DEFAULT 'en',
  `timezone` varchar(255) NOT NULL DEFAULT 'UTC',
  `last_login_ip` varchar(255) DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `admin_level` enum('super_admin','admin','moderator') DEFAULT NULL,
  `permissions` text DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `job_title` varchar(255) DEFAULT NULL,
  `admin_notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `phone`, `password`, `address`, `barangay`, `city`, `alt_address`, `alt_barangay`, `alt_city`, `state`, `country`, `postal_code`, `role`, `is_verified`, `verification_token`, `reset_token`, `reset_token_expiry`, `profile_picture`, `is_active`, `created_at`, `updated_at`, `bio`, `date_of_birth`, `gender`, `alternative_phone`, `emergency_contact`, `email_notifications`, `sms_notifications`, `push_notifications`, `status`, `suspension_reason`, `suspended_at`, `preferred_language`, `timezone`, `last_login_ip`, `last_login_at`, `admin_level`, `permissions`, `department`, `job_title`, `admin_notes`) VALUES
(1, 'Admin', 'System', 'admin@admin.com', '0000000000', '$2y$12$.X3x5iv1BH/xHhyr91oJO.HV0ggG1.CFsYIReebSiLb.zOv.9xBlO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin', 1, NULL, NULL, NULL, NULL, 1, '2026-05-12 03:25:27', '2026-06-05 08:25:26', NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 'active', NULL, NULL, 'en', 'UTC', NULL, NULL, 'super_admin', '\"[\\\"all\\\"]\"', 'Management', 'System Administrator', NULL),
(2, 'Regular', 'User', 'user@user.com', '1111111111', '$2y$12$VHbqh0Emy1AEWxOXp8OibOzWyjM8fTHRIxNWnY2goXXaDuobjT9z6', '11, Bicol Brigade, Bicol brigade', 'Tatalon', 'Quezon City', '11, Bicol Brigade, Bicol brigade', 'Tatalon', 'Quezon City', 'Metro Manila', 'PH', NULL, 'user', 1, NULL, NULL, NULL, NULL, 1, '2026-05-12 03:25:27', '2026-06-10 07:14:43', '', NULL, NULL, NULL, NULL, 1, 0, 1, 'active', NULL, NULL, 'en', 'UTC', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Admin', 'Repairmax', 'repairmaxsample@gmail.com', '1234567890', '$2y$12$H3.WHAMLFanbAjC4Lem/r.Vqn84QucIiLtpgEMxP44EP1oU4mc/c6', 'Admin Office', NULL, 'City', NULL, NULL, NULL, 'State', NULL, '00000', 'admin', 1, NULL, NULL, NULL, NULL, 1, '2026-05-17 07:04:19', '2026-06-05 08:25:26', NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 'active', NULL, NULL, 'en', 'UTC', NULL, NULL, 'super_admin', '\"[\\\"all\\\"]\"', 'Management', 'System Administrator', 'Default super admin account created during installation'),
(5, 'Jane', 'Doe', 'tan1925alex@gmail.com', '09442573412', '$2y$12$hftnYz7cjVDx796.XIa18.Lqju5Ez2BVIzSpdx8ANsBK3wdDBwcca', '11 , Brgy. Tatalon', NULL, 'Quezon City', NULL, NULL, NULL, NULL, NULL, NULL, 'guest', 0, NULL, NULL, NULL, NULL, 1, '2026-05-19 04:55:22', '2026-06-07 05:38:53', NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 'active', NULL, NULL, 'en', 'UTC', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_activity_logs`
--
ALTER TABLE `admin_activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_activity_logs_admin_id_created_at_index` (`admin_id`,`created_at`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `appointments_tracking_code_unique` (`tracking_code`),
  ADD UNIQUE KEY `appointments_invoice_number_unique` (`invoice_number`),
  ADD UNIQUE KEY `appointments_booking_number_unique` (`booking_number`),
  ADD KEY `appointments_user_id_foreign` (`user_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_name_unique` (`name`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `chatbot_messages`
--
ALTER TABLE `chatbot_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chatbot_messages_chatbot_session_id_created_at_index` (`chatbot_session_id`,`created_at`);

--
-- Indexes for table `chatbot_sessions`
--
ALTER TABLE `chatbot_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chatbot_sessions_user_id_foreign` (`user_id`);

--
-- Indexes for table `device_models`
--
ALTER TABLE `device_models`
  ADD PRIMARY KEY (`id`),
  ADD KEY `device_models_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fault_types`
--
ALTER TABLE `fault_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fault_types_name_unique` (`name`);

--
-- Indexes for table `inventory_items`
--
ALTER TABLE `inventory_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `inventory_items_sku_unique` (`sku`),
  ADD KEY `inventory_items_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_user_id_foreign` (`user_id`),
  ADD KEY `messages_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_admin_id_foreign` (`admin_id`),
  ADD KEY `notifications_user_id_is_read_index` (`user_id`,`is_read`),
  ADD KEY `notifications_created_at_index` (`created_at`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `repairs`
--
ALTER TABLE `repairs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `repairs_tracking_code_unique` (`tracking_code`),
  ADD KEY `repairs_user_id_foreign` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`),
  ADD KEY `settings_category_index` (`category`);

--
-- Indexes for table `supported_cities`
--
ALTER TABLE `supported_cities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `supported_cities_name_unique` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_activity_logs`
--
ALTER TABLE `admin_activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `chatbot_messages`
--
ALTER TABLE `chatbot_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `chatbot_sessions`
--
ALTER TABLE `chatbot_sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `device_models`
--
ALTER TABLE `device_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fault_types`
--
ALTER TABLE `fault_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `inventory_items`
--
ALTER TABLE `inventory_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `repairs`
--
ALTER TABLE `repairs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `supported_cities`
--
ALTER TABLE `supported_cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_activity_logs`
--
ALTER TABLE `admin_activity_logs`
  ADD CONSTRAINT `admin_activity_logs_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chatbot_messages`
--
ALTER TABLE `chatbot_messages`
  ADD CONSTRAINT `chatbot_messages_chatbot_session_id_foreign` FOREIGN KEY (`chatbot_session_id`) REFERENCES `chatbot_sessions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chatbot_sessions`
--
ALTER TABLE `chatbot_sessions`
  ADD CONSTRAINT `chatbot_sessions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `device_models`
--
ALTER TABLE `device_models`
  ADD CONSTRAINT `device_models_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `inventory_items`
--
ALTER TABLE `inventory_items`
  ADD CONSTRAINT `inventory_items_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `repairs`
--
ALTER TABLE `repairs`
  ADD CONSTRAINT `repairs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
