-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 09, 2026 at 04:27 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tiffintime`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `service_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

CREATE TABLE `favourites` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `service_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favourites`
--

INSERT INTO `favourites` (`id`, `user_id`, `service_id`, `created_at`, `updated_at`) VALUES
(1, 37, 49, '2026-04-18 03:50:54', '2026-04-18 03:50:54');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `seller_id` bigint UNSIGNED NOT NULL,
  `feedback` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `sender_id` bigint UNSIGNED NOT NULL,
  `sender_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `order_id`, `sender_id`, `sender_type`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(18, 32, 37, 'user', 'hi', 0, '2026-06-06 04:31:07', '2026-06-06 04:31:07');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2024_12_12_180538_create_sellers_table', 1),
(4, '2024_12_12_180539_create_services_table', 1),
(5, '2024_12_14_132911_create_users_table', 1),
(6, '2024_12_16_140213_create_user_profile_updates_table', 1),
(7, '2024_12_16_180740_create_sessions_table', 2),
(8, '2024_12_18_172704_create_notifications_table', 2),
(9, '2024_12_27_184305_create_orders_table', 2),
(10, '2024_12_27_184336_create_order_items_table', 2),
(11, '2025_03_09_205809_create_messages_table', 2),
(12, '2025_03_25_152156_create_feedback_table', 2),
(13, '2025_04_07_094536_create_seller_verifications_table', 2),
(14, '2025_04_24_224639_add_remember_token_to_sellers_table', 3),
(15, '2025_05_26_200506_create_favorites_table', 3),
(16, '2025_05_26_205032_add_cancellation_reason_to_orders_table', 3),
(17, '2025_05_26_215551_add_suspension_to_users_table', 3),
(18, '2025_05_27_000814_add_suspension_fields_to_sellers_table', 3),
(19, '2025_05_27_003613_add_category_to_services_table', 3),
(20, '2025_12_12_063444_add_smart_scheduling_to_services_table', 4),
(21, '2025_12_15_074122_update_status_column_in_orders_table', 5),
(22, '2026_04_13_000001_create_seller_verifications_table', 6),
(23, '2026_04_18_084350_create_favourites_table', 7),
(24, '2026_06_07_085703_add_is_suspended_to_users_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('00e81568-ea11-4d08-9a8f-28f6d7ebc545', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Seller', 12, '{\"seller_name\":\"Seller Wahab\",\"order_id\":6,\"order_details\":[{\"id\":7,\"order_id\":6,\"service_id\":33,\"quantity\":1,\"price\":\"1122.00\",\"created_at\":\"2025-04-24T16:40:29.000000Z\",\"updated_at\":\"2025-04-24T16:40:29.000000Z\"}]}', NULL, '2025-04-24 11:40:29', '2025-04-24 11:40:29'),
('0117fbb7-f0c4-46ab-8d2b-39e61109c3c9', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 18, '{\"message\":\"New service \'Seller UmairSolangiCEO\' added by Shalwar Qamiz Washing and Ironadf.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/11\\/services\"}', '2025-10-29 03:01:32', '2025-04-09 11:22:07', '2025-10-29 03:01:32'),
('02e10a58-1332-4e69-9ecb-6fd38d0b7331', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 10, '{\"message\":\"New service \'Seller UmairSolangiCEO\' added by Shalwar Qamiz Washing and Ironadf.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/11\\/services\"}', NULL, '2025-04-09 11:21:53', '2025-04-09 11:21:53'),
('047e4256-6230-4e66-8b3d-342238f81792', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 9, '{\"message\":\"New service \'Seller Wahab\' added by Laptop Bag Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', NULL, '2025-04-24 09:12:30', '2025-04-24 09:12:30'),
('0645de46-9bd8-4d5f-ab27-eb11358f2884', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 24, '{\"message\":\"New service \'Seller Umair\' added by Beef Biryani.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/18\\/services\"}', NULL, '2025-12-15 02:57:33', '2025-12-15 02:57:33'),
('078aad5d-316f-46bb-a3ac-468e0308f6bb', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 21, '{\"message\":\"New service \'Seller Wahab\' added by Karachi Wash.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', NULL, '2025-04-24 11:57:36', '2025-04-24 11:57:36'),
('07e517ba-a94a-4138-b259-5d325f71aa2d', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Seller', 11, '{\"seller_name\":\"Seller UmairSolangiCEO\",\"order_id\":15,\"order_details\":[{\"id\":16,\"order_id\":15,\"service_id\":32,\"quantity\":2,\"price\":\"333.00\",\"created_at\":\"2025-05-27T05:56:28.000000Z\",\"updated_at\":\"2025-05-27T05:56:28.000000Z\"},{\"id\":17,\"order_id\":15,\"service_id\":31,\"quantity\":1,\"price\":\"2211.00\",\"created_at\":\"2025-05-27T05:56:28.000000Z\",\"updated_at\":\"2025-05-27T05:56:28.000000Z\"}]}', NULL, '2025-05-27 00:56:28', '2025-05-27 00:56:28'),
('084f4a16-8b17-4779-8de5-acd5d42630bb', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 24, '{\"message\":\"New service \'umair seller\' added by Lab e Sheeren.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/16\\/services\"}', NULL, '2025-12-12 02:04:57', '2025-12-12 02:04:57'),
('0d8e5a72-a3c0-4b5e-bf2b-b9888de59baa', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 7, '{\"message\":\"New service \'Seller UmairSolangiCEO\' added by Carpet Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/11\\/services\"}', NULL, '2025-04-24 08:06:32', '2025-04-24 08:06:32'),
('0ff96889-e8fe-4dee-9c05-d1211ee262ba', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 30, '{\"message\":\"New service \'umair seller\' added by Lab e Sheeren.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/16\\/services\"}', NULL, '2025-12-12 02:04:54', '2025-12-12 02:04:54'),
('10246c4d-37f7-4c66-a7b1-1af461e2460c', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 17, '{\"message\":\"New service \'Seller Umair\' added by Biryani.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/17\\/services\"}', NULL, '2025-12-15 02:34:57', '2025-12-15 02:34:57'),
('1154df5c-0bd2-455c-9a54-d05eadb2b79f', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 5, '{\"message\":\"New service \'Seller Zubair\' added by Moosa Seller Washing Service.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/13\\/services\"}', NULL, '2025-04-24 14:29:33', '2025-04-24 14:29:33'),
('11a7c4e4-c709-4770-9704-8f46d198bdd8', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 11, '{\"message\":\"New service \'Seller UmairSolangiCEO\' added by Shalwar Qamiz Washing and Ironadf.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/11\\/services\"}', NULL, '2025-04-09 11:21:54', '2025-04-09 11:21:54'),
('11d59a73-a43c-46b3-b5ff-14f0f5724a30', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 13, '{\"message\":\"New service \'Seller UmairSolangiCEO\' added by Shalwar Qamiz Washing and Ironadf.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/11\\/services\"}', NULL, '2025-04-09 11:21:58', '2025-04-09 11:21:58'),
('145329ba-9918-4288-a601-72e7bb696c10', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 15, '{\"message\":\"New service \'Seller Zubair\' added by Cold Coffee.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/13\\/services\"}', NULL, '2026-01-24 07:56:44', '2026-01-24 07:56:44'),
('15fc7906-e700-47f6-ae4d-d517ba8ab385', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 21, '{\"message\":\"New service \'Seller Zubair\' added by Moosa Seller Washing Service.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/13\\/services\"}', NULL, '2025-04-24 14:30:09', '2025-04-24 14:30:09'),
('17542977-7100-40cb-8dad-b4fdcfb43d8f', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 11, '{\"message\":\"New service \'Seller Zubair\' added by Moosa Seller Washing Service.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/13\\/services\"}', NULL, '2025-04-24 14:29:49', '2025-04-24 14:29:49'),
('18297714-c0a2-4600-8aa2-a7ce51135721', 'App\\Notifications\\VerificationStatusNotification', 'App\\Models\\Seller', 21, '{\"message\":\"\\ud83c\\udf89 Congratulations! Your verification request has been approved. Your account is now verified!\",\"type\":\"verification_approved\"}', NULL, '2026-04-13 11:02:50', '2026-04-13 11:02:50'),
('1953f05f-e44c-4035-9682-c9a382ca7bcb', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 21, '{\"message\":\"New service \'Seller Wahab\' added by Laptop Bag Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', NULL, '2025-04-24 09:12:48', '2025-04-24 09:12:48'),
('19a85db4-d431-4703-92e6-fd528d7232b3', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 31, '{\"message\":\"New service \'umair seller\' added by Chicken Qorma.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/16\\/services\"}', NULL, '2025-12-12 01:41:35', '2025-12-12 01:41:35'),
('1bdec284-e022-450a-a84e-398b6a414bda', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 35, '{\"message\":\"New service \'Seller Zubair\' added by Cold Coffee.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/13\\/services\"}', NULL, '2026-01-24 07:56:37', '2026-01-24 07:56:37'),
('1be358bd-4283-443f-87ea-26c1a27a8d1f', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 28, '{\"message\":\"New service \'umair seller\' added by Falooda Ice Cream.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/16\\/services\"}', NULL, '2025-12-12 02:36:48', '2025-12-12 02:36:48'),
('1d100279-3711-4531-87b1-5837ec95e0ec', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Seller', 11, '{\"seller_name\":\"Seller UmairSolangiCEO\",\"order_id\":17,\"order_details\":[{\"id\":19,\"order_id\":17,\"service_id\":32,\"quantity\":2,\"price\":\"333.00\",\"created_at\":\"2025-05-27T06:06:20.000000Z\",\"updated_at\":\"2025-05-27T06:06:20.000000Z\"}]}', NULL, '2025-05-27 01:06:20', '2025-05-27 01:06:20'),
('1d555101-7276-4485-8fc6-998f3ed67d9c', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Seller', 12, '{\"seller_name\":\"Seller Wahab\",\"order_id\":11,\"order_details\":[{\"id\":12,\"order_id\":11,\"service_id\":35,\"quantity\":1,\"price\":\"222.00\",\"created_at\":\"2025-05-07T05:31:16.000000Z\",\"updated_at\":\"2025-05-07T05:31:16.000000Z\"}]}', NULL, '2025-05-07 00:31:18', '2025-05-07 00:31:18'),
('1dd403a8-469b-4c7d-a328-af926f3328c6', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 4, '{\"message\":\"New service \'Seller UmairSolangiCEO\' added by Shalwar Qamiz Washing and Ironadf.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/11\\/services\"}', NULL, '2025-04-09 11:21:42', '2025-04-09 11:21:42'),
('1e5d30a0-1e81-408b-be5c-d47734b2270b', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Seller', 19, '{\"seller_name\":\"seller umair\",\"order_id\":28,\"order_details\":[{\"id\":31,\"order_id\":28,\"service_id\":46,\"quantity\":1,\"price\":\"300.00\",\"created_at\":\"2025-12-17T12:34:58.000000Z\",\"updated_at\":\"2025-12-17T12:34:58.000000Z\"}]}', NULL, '2025-12-17 07:34:58', '2025-12-17 07:34:58'),
('20f34143-909f-4739-b99a-4ef25e25df88', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Seller', 11, '{\"seller_name\":\"Seller UmairSolangiCEO\",\"order_id\":5,\"order_details\":[{\"id\":6,\"order_id\":5,\"service_id\":31,\"quantity\":1,\"price\":\"2211.00\",\"created_at\":\"2025-04-22T16:54:53.000000Z\",\"updated_at\":\"2025-04-22T16:54:53.000000Z\"}]}', NULL, '2025-04-22 11:54:53', '2025-04-22 11:54:53'),
('2115a709-78d8-46f1-b10e-9ea9f15a05fa', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 20, '{\"message\":\"New service \'Seller UmairSolangiCEO\' added by Carpet Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/11\\/services\"}', NULL, '2025-04-24 08:06:57', '2025-04-24 08:06:57'),
('21b15703-5417-43b8-98e5-18c2f1d815f1', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 23, '{\"message\":\"New service \'Seller Umair\' added by Chicken Biryani.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/17\\/services\"}', NULL, '2025-12-12 06:37:04', '2025-12-12 06:37:04'),
('220ec207-d410-42e5-81e8-8ceb93d8ede3', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 6, '{\"message\":\"New service \'Seller Wahab\' added by Laptop Bag Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', NULL, '2025-04-24 09:12:25', '2025-04-24 09:12:25'),
('227f3139-1567-4bad-9a38-d13bd05d51ce', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 3, '{\"message\":\"New service \'Seller UmairSolangiCEO\' added by Carpet Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/11\\/services\"}', NULL, '2025-04-24 08:06:26', '2025-04-24 08:06:26'),
('22fab634-4868-4387-bfd0-79eac4ae1899', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Seller', 12, '{\"seller_name\":\"Seller Wahab\",\"order_id\":19,\"order_details\":[{\"id\":21,\"order_id\":19,\"service_id\":35,\"quantity\":1,\"price\":\"222.00\",\"created_at\":\"2025-08-18T05:47:18.000000Z\",\"updated_at\":\"2025-08-18T05:47:18.000000Z\"},{\"id\":22,\"order_id\":19,\"service_id\":33,\"quantity\":1,\"price\":\"1122.00\",\"created_at\":\"2025-08-18T05:47:18.000000Z\",\"updated_at\":\"2025-08-18T05:47:18.000000Z\"}]}', NULL, '2025-08-18 00:47:18', '2025-08-18 00:47:18'),
('241b00ce-ad9a-414e-a5d1-26ab0b8adc12', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 17, '{\"message\":\"New service \'Seller Wahab\' added by Laptop Bag Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', NULL, '2025-04-24 09:12:42', '2025-04-24 09:12:42'),
('271018dc-c9a9-4998-9b15-86fb16ca19c1', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 23, '{\"message\":\"New service \'Seller Zubair\' added by Moosa Seller Washing Service.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/13\\/services\"}', NULL, '2025-04-24 14:30:11', '2025-04-24 14:30:11'),
('29ebe32a-8b17-4334-8b87-663365b2cdf1', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 4, '{\"message\":\"New service \'Seller UmairSolangiCEO\' added by Carpet Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/11\\/services\"}', NULL, '2025-04-24 08:06:27', '2025-04-24 08:06:27'),
('2a742459-5683-442f-9013-89421e93d4c3', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 28, '{\"message\":\"New service \'umair seller\' added by Biryani.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/16\\/services\"}', NULL, '2025-12-12 01:18:11', '2025-12-12 01:18:11'),
('2a8f5505-6e5d-438a-8748-d0831eab8876', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 1, '{\"message\":\"New service \'Seller Wahab\' added by Karachi Wash.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', NULL, '2025-04-24 11:57:04', '2025-04-24 11:57:04'),
('2a9a36ab-1482-422b-8eab-fc5d536d0bbd', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 24, '{\"message\":\"New service \'umair seller\' added by Falooda Ice Cream.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/16\\/services\"}', NULL, '2025-12-12 02:36:49', '2025-12-12 02:36:49'),
('2ea4eac3-a7fa-4b88-8c84-bfabb26a950d', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Seller', 21, '{\"seller_name\":\"Umair seller\",\"order_id\":31,\"order_details\":[{\"id\":34,\"order_id\":31,\"service_id\":49,\"quantity\":1,\"price\":\"55556.00\",\"created_at\":\"2026-04-13T15:22:35.000000Z\",\"updated_at\":\"2026-04-13T15:22:35.000000Z\"}]}', NULL, '2026-04-13 10:22:35', '2026-04-13 10:22:35'),
('30511a44-fd77-46a3-bcf9-6f779b1a9ad2', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 16, '{\"message\":\"New service \'seller umair\' added by Chicken Qorma.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/19\\/services\"}', NULL, '2025-12-17 07:31:41', '2025-12-17 07:31:41'),
('32b0f646-b34d-4c04-bf08-84b0ca4ccfba', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Seller', 12, '{\"seller_name\":\"Seller Wahab\",\"order_id\":18,\"order_details\":[{\"id\":20,\"order_id\":18,\"service_id\":35,\"quantity\":1,\"price\":\"222.00\",\"created_at\":\"2025-08-18T05:46:30.000000Z\",\"updated_at\":\"2025-08-18T05:46:30.000000Z\"}]}', NULL, '2025-08-18 00:46:32', '2025-08-18 00:46:32'),
('35068204-d901-4a14-9205-c2d2d9e6be58', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 18, '{\"message\":\"New service \'Seller UmairSolangiCEO\' added by Carpet Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/11\\/services\"}', '2025-10-29 03:01:33', '2025-04-24 08:06:53', '2025-10-29 03:01:33'),
('365ac5ca-d0e9-4152-ae74-ce98e43ea35d', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 15, '{\"message\":\"New service \'seller umair\' added by Chicken Qorma.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/19\\/services\"}', NULL, '2025-12-17 07:31:43', '2025-12-17 07:31:43'),
('3974fab3-e0e5-476a-b9b9-3744a87f2869', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 31, '{\"message\":\"New service \'umair seller\' added by Biryani.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/16\\/services\"}', NULL, '2025-12-12 01:17:53', '2025-12-12 01:17:53'),
('3a40e1ef-1f62-47eb-b81e-02a1a6e2ef57', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Seller', 11, '{\"seller_name\":\"Seller UmairSolangiCEO\",\"order_id\":16,\"order_details\":[{\"id\":18,\"order_id\":16,\"service_id\":32,\"quantity\":2,\"price\":\"333.00\",\"created_at\":\"2025-05-27T06:05:51.000000Z\",\"updated_at\":\"2025-05-27T06:05:51.000000Z\"}]}', NULL, '2025-05-27 01:05:51', '2025-05-27 01:05:51'),
('3af2b658-013b-4aae-a9ec-783fcc316ef0', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 2, '{\"message\":\"New service \'Seller Wahab\' added by Laptop Bag Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', NULL, '2025-04-24 09:12:19', '2025-04-24 09:12:19'),
('3b22c695-6a7f-4803-a52e-fdcb103ee4e3', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 6, '{\"message\":\"New service \'Seller UmairSolangiCEO\' added by Carpet Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/11\\/services\"}', NULL, '2025-04-24 08:06:31', '2025-04-24 08:06:31'),
('3e8fc1af-d049-4d4b-9bec-6215e2b2a3be', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 17, '{\"message\":\"New service \'Seller Umair\' added by Beef Biryani.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/18\\/services\"}', NULL, '2025-12-15 02:57:36', '2025-12-15 02:57:36'),
('4128b956-8d84-486a-bbce-bbf2dedf2aa9', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 7, '{\"message\":\"New service \'Seller Zubair\' added by Moosa Seller Washing Service.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/13\\/services\"}', NULL, '2025-04-24 14:29:37', '2025-04-24 14:29:37'),
('413e814f-69ea-4541-ae71-804f104da5cc', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 12, '{\"message\":\"New service \'Seller Wahab\' added by Karachi Wash.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', NULL, '2025-04-24 11:57:23', '2025-04-24 11:57:23'),
('41be8d21-ae38-4311-84de-471951ec0194', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 22, '{\"message\":\"New service \'Seller Wahab\' added by Laptop Bag Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', NULL, '2025-04-24 09:12:50', '2025-04-24 09:12:50'),
('46462319-cc3a-4a03-9f29-8e8114f2678e', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 23, '{\"message\":\"New service \'Seller Umair\' added by Biryani.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/17\\/services\"}', NULL, '2025-12-15 02:34:55', '2025-12-15 02:34:55'),
('478b6f54-c0ad-40c9-ba4b-db1d7f50bada', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Seller', 11, '{\"seller_name\":\"Seller UmairSolangiCEO\",\"order_id\":14,\"order_details\":[{\"id\":15,\"order_id\":14,\"service_id\":32,\"quantity\":1,\"price\":\"333.00\",\"created_at\":\"2025-05-27T05:40:05.000000Z\",\"updated_at\":\"2025-05-27T05:40:05.000000Z\"}]}', NULL, '2025-05-27 00:40:06', '2025-05-27 00:40:06'),
('49219c73-c5d5-4268-b255-cde958af8f6f', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 12, '{\"message\":\"New service \'Seller UmairSolangiCEO\' added by Carpet Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/11\\/services\"}', NULL, '2025-04-24 08:06:43', '2025-04-24 08:06:43'),
('49857d3d-64e5-4f1c-96fc-b3c1f7a6aabc', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 3, '{\"message\":\"New service \'Seller UmairSolangiCEO\' added by Shalwar Qamiz Washing and Ironadf.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/11\\/services\"}', NULL, '2025-04-09 11:21:41', '2025-04-09 11:21:41'),
('4b03028a-582f-44ba-9776-9fe0ff24db9f', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 20, '{\"message\":\"New service \'Seller Wahab\' added by Laptop Bag Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', NULL, '2025-04-24 09:12:47', '2025-04-24 09:12:47'),
('4c3a5efc-5958-4e41-ae8c-20fd29319c66', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 18, '{\"message\":\"New service \'Seller Wahab\' added by Laptop Bag Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', '2025-10-29 03:01:33', '2025-04-24 09:12:44', '2025-10-29 03:01:33'),
('4eff3e7a-1cb8-485b-b86b-9a06a96dd07c', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 5, '{\"message\":\"New service \'Seller UmairSolangiCEO\' added by Carpet Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/11\\/services\"}', NULL, '2025-04-24 08:06:29', '2025-04-24 08:06:29'),
('4f69228f-3d1f-4d82-b0d1-e55edb5a13ff', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 23, '{\"message\":\"New service \'umair seller\' added by Biryani.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/16\\/services\"}', NULL, '2025-12-12 01:18:14', '2025-12-12 01:18:14'),
('521e47be-87bf-48c5-a13a-807e4a21c0d8', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 13, '{\"message\":\"New service \'Seller Wahab\' added by Laptop Bag Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', NULL, '2025-04-24 09:12:36', '2025-04-24 09:12:36'),
('52226421-0f86-4fe2-bf06-ec9ba11011d8', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 15, '{\"message\":\"New service \'Seller Zubair\' added by Chicken Paratha Roll.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/13\\/services\"}', NULL, '2026-01-24 07:48:27', '2026-01-24 07:48:27'),
('5239aca8-9523-4f15-b4c3-dd79aef4e691', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 23, '{\"message\":\"New service \'umair seller\' added by Falooda Ice Cream.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/16\\/services\"}', NULL, '2025-12-12 02:36:51', '2025-12-12 02:36:51'),
('5290f410-a7c8-4801-937a-fcb7275eee61', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 12, '{\"message\":\"New service \'seller umair\' added by Chicken Qorma.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/19\\/services\"}', NULL, '2025-12-17 07:31:46', '2025-12-17 07:31:46'),
('5437be81-8c91-420b-8798-927d20aad747', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 18, '{\"message\":\"New service \'Seller Zubair\' added by Moosa Seller Washing Service.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/13\\/services\"}', '2025-10-29 03:01:33', '2025-04-24 14:30:03', '2025-10-29 03:01:33'),
('5463c424-31fc-4bc2-9da6-204561baa75a', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 7, '{\"message\":\"New service \'Seller Wahab\' added by Laptop Bag Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', NULL, '2025-04-24 09:12:27', '2025-04-24 09:12:27'),
('549a1144-0ea8-43c6-918d-027957437cf0', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 16, '{\"message\":\"New service \'Seller Wahab\' added by Karachi Wash.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', NULL, '2025-04-24 11:57:29', '2025-04-24 11:57:29'),
('5502ddb7-0738-4e03-a4bc-5c0d1468a1b3', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 28, '{\"message\":\"New service \'Seller Umair\' added by Chicken Biryani.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/17\\/services\"}', NULL, '2025-12-12 06:37:02', '2025-12-12 06:37:02'),
('550d2ca1-f82c-4cc9-827d-90703111ed91', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 2, '{\"message\":\"New service \'Seller UmairSolangiCEO\' added by Carpet Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/11\\/services\"}', NULL, '2025-04-24 08:06:24', '2025-04-24 08:06:24'),
('554b0ad6-36e4-4282-9c8c-0110cb65ea2c', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 13, '{\"message\":\"New service \'Seller UmairSolangiCEO\' added by Carpet Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/11\\/services\"}', NULL, '2025-04-24 08:06:45', '2025-04-24 08:06:45'),
('559b9b0b-2bcc-46ab-b0df-0baddfc9607a', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 13, '{\"message\":\"New service \'Seller Zubair\' added by Moosa Seller Washing Service.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/13\\/services\"}', NULL, '2025-04-24 14:29:53', '2025-04-24 14:29:53'),
('5b424792-847d-4a06-b630-d527305949c1', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 1, '{\"message\":\"New service \'Seller UmairSolangiCEO\' added by Carpet Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/11\\/services\"}', NULL, '2025-04-24 08:06:19', '2025-04-24 08:06:19'),
('5f4e184c-bb11-4ea7-88fe-20814e824467', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 5, '{\"message\":\"New service \'Seller Wahab\' added by Karachi Wash.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', NULL, '2025-04-24 11:57:12', '2025-04-24 11:57:12'),
('5f79d128-5eb9-4c3f-a03d-2a1d2abb3469', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 2, '{\"message\":\"New service \'Seller Wahab\' added by Karachi Wash.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', NULL, '2025-04-24 11:57:08', '2025-04-24 11:57:08'),
('6064cd4f-27e5-482f-b6e7-7ee3bb46d0dc', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 11, '{\"message\":\"New service \'Seller UmairSolangiCEO\' added by Carpet Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/11\\/services\"}', NULL, '2025-04-24 08:06:40', '2025-04-24 08:06:40'),
('609d4dfa-588e-4f7e-83a6-7b5cf2970c9a', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Seller', 13, '{\"seller_name\":\"Seller Zubair\",\"order_id\":30,\"order_details\":[{\"id\":33,\"order_id\":30,\"service_id\":48,\"quantity\":1,\"price\":\"444.00\",\"created_at\":\"2026-01-24T12:57:08.000000Z\",\"updated_at\":\"2026-01-24T12:57:08.000000Z\"}]}', NULL, '2026-01-24 07:57:08', '2026-01-24 07:57:08'),
('60d45917-6297-4b42-b56a-d27861707614', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 9, '{\"message\":\"New service \'Seller UmairSolangiCEO\' added by Shalwar Qamiz Washing and Ironadf.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/11\\/services\"}', NULL, '2025-04-09 11:21:51', '2025-04-09 11:21:51'),
('62f4a759-57da-4a21-b54d-80040018b4e8', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 31, '{\"message\":\"New service \'umair seller\' added by Lab e Sheeren.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/16\\/services\"}', NULL, '2025-12-12 02:34:30', '2025-12-12 02:34:30'),
('63662f9a-1168-488b-87d6-3fa842dc15b2', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 16, '{\"message\":\"New service \'Seller UmairSolangiCEO\' added by Carpet Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/11\\/services\"}', NULL, '2025-04-24 08:06:50', '2025-04-24 08:06:50'),
('6411ee5f-fb35-4219-8881-8095b0a8c226', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 24, '{\"message\":\"New service \'Seller Umair\' added by Chicken Qorma.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/17\\/services\"}', NULL, '2025-12-12 06:39:12', '2025-12-12 06:39:12'),
('644a43e1-5e4e-4072-9fef-ac118de0a6ca', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 24, '{\"message\":\"New service \'umair seller\' added by Lab e Sheeren.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/16\\/services\"}', NULL, '2025-12-12 02:34:44', '2025-12-12 02:34:44'),
('65ca4741-80b5-4630-bd4b-a55b1be79cd1', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 15, '{\"message\":\"New service \'Seller UmairSolangiCEO\' added by Shalwar Qamiz Washing and Ironadf.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/11\\/services\"}', NULL, '2025-04-09 11:22:01', '2025-04-09 11:22:01'),
('66d7f574-e74f-44e6-83ac-4e617cc16a37', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 3, '{\"message\":\"New service \'Seller Zubair\' added by Moosa Seller Washing Service.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/13\\/services\"}', NULL, '2025-04-24 14:29:29', '2025-04-24 14:29:29'),
('66e56f7d-3105-4c39-a000-a34d660c28ea', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 28, '{\"message\":\"New service \'umair seller\' added by Lab e Sheeren.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/16\\/services\"}', NULL, '2025-12-12 02:04:56', '2025-12-12 02:04:56'),
('67e5b063-087d-4a79-9fb7-b9b5e4ac0c11', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 18, '{\"message\":\"New service \'Seller Wahab\' added by Karachi Wash.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', '2025-10-29 03:01:33', '2025-04-24 11:57:32', '2025-10-29 03:01:33'),
('69151e82-a712-4ee5-93b2-28bf1dc02c39', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 36, '{\"message\":\"New service \'Umair seller\' added by Chicken Biryani.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/21\\/services\"}', NULL, '2026-04-13 10:20:44', '2026-04-13 10:20:44'),
('691f9ec5-e173-4be5-b479-0ad1845e24ce', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 14, '{\"message\":\"New service \'Seller UmairSolangiCEO\' added by Shalwar Qamiz Washing and Ironadf.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/11\\/services\"}', NULL, '2025-04-09 11:22:00', '2025-04-09 11:22:00'),
('6948afa2-49be-43dc-9a70-939287ad6508', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 8, '{\"message\":\"New service \'Seller Wahab\' added by Laptop Bag Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', NULL, '2025-04-24 09:12:28', '2025-04-24 09:12:28'),
('698674aa-031a-4975-8306-e087a1602fe2', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 23, '{\"message\":\"New service \'umair seller\' added by Chicken Qorma.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/16\\/services\"}', NULL, '2025-12-12 01:41:43', '2025-12-12 01:41:43'),
('6bd4266d-c807-4d64-93f3-66b4b9f5cba6', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 28, '{\"message\":\"New service \'umair seller\' added by Chicken Qorma.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/16\\/services\"}', NULL, '2025-12-12 01:41:40', '2025-12-12 01:41:40'),
('6ed3cec0-1782-4105-8809-ede1f431a35c', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 21, '{\"message\":\"New service \'Seller Umair\' added by Biryani.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/17\\/services\"}', NULL, '2025-12-15 02:34:56', '2025-12-15 02:34:56'),
('6f5c1e23-08ca-426f-9c49-51f944854cfe', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 20, '{\"message\":\"New service \'Seller Zubair\' added by Moosa Seller Washing Service.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/13\\/services\"}', NULL, '2025-04-24 14:30:07', '2025-04-24 14:30:07'),
('70fcf440-a1b7-428a-95ed-d6ecfe356dac', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 20, '{\"message\":\"New service \'Seller Wahab\' added by Karachi Wash.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', NULL, '2025-04-24 11:57:35', '2025-04-24 11:57:35'),
('71058b56-57e6-44e4-bbd9-4d9b8ca4eb9a', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 31, '{\"message\":\"New service \'umair seller\' added by Lab e Sheeren.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/16\\/services\"}', NULL, '2025-12-12 02:04:51', '2025-12-12 02:04:51'),
('7236a129-66c1-4a62-9dc8-e9981b51a366', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 28, '{\"message\":\"New service \'umair seller\' added by Lab e Sheeren.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/16\\/services\"}', NULL, '2025-12-12 02:34:43', '2025-12-12 02:34:43'),
('73817f03-ea97-420b-b273-304e07d652bb', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 14, '{\"message\":\"New service \'Seller Zubair\' added by Moosa Seller Washing Service.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/13\\/services\"}', NULL, '2025-04-24 14:29:55', '2025-04-24 14:29:55'),
('73c14664-34ef-4b15-9497-2f46b2915499', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 16, '{\"message\":\"New service \'Seller Zubair\' added by Cold Coffee.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/13\\/services\"}', NULL, '2026-01-24 07:56:42', '2026-01-24 07:56:42'),
('73e76dec-4c8d-4e56-97a2-b232b3f02759', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Seller', 1, '{\"seller_name\":\"Kameron Dooley\",\"order_id\":1,\"order_details\":[{\"id\":1,\"order_id\":1,\"service_id\":3,\"quantity\":2,\"price\":\"449.00\",\"created_at\":\"2025-04-07T10:48:02.000000Z\",\"updated_at\":\"2025-04-07T10:48:02.000000Z\"},{\"id\":2,\"order_id\":1,\"service_id\":1,\"quantity\":1,\"price\":\"41.03\",\"created_at\":\"2025-04-07T10:48:02.000000Z\",\"updated_at\":\"2025-04-07T10:48:02.000000Z\"}]}', NULL, '2025-04-07 05:48:03', '2025-04-07 05:48:03'),
('74a7a9eb-d881-46e7-a401-26aa6f74bbe0', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 35, '{\"message\":\"New service \'Umair seller\' added by Chicken Biryani.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/21\\/services\"}', NULL, '2026-04-13 10:20:45', '2026-04-13 10:20:45'),
('750e1e63-12b4-474a-abc4-414068d287fe', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Seller', 16, '{\"seller_name\":\"umair seller\",\"order_id\":23,\"order_details\":[{\"id\":26,\"order_id\":23,\"service_id\":37,\"quantity\":1,\"price\":\"200.00\",\"created_at\":\"2025-12-12T06:21:55.000000Z\",\"updated_at\":\"2025-12-12T06:21:55.000000Z\"}]}', NULL, '2025-12-12 01:21:55', '2025-12-12 01:21:55'),
('76e2140b-c796-4895-a805-a413df1a8f33', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 10, '{\"message\":\"New service \'Seller Zubair\' added by Moosa Seller Washing Service.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/13\\/services\"}', NULL, '2025-04-24 14:29:47', '2025-04-24 14:29:47'),
('77781add-6dba-43d2-a1ec-57906d189cd5', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Seller', 19, '{\"seller_name\":\"seller umair\",\"order_id\":29,\"order_details\":[{\"id\":32,\"order_id\":29,\"service_id\":46,\"quantity\":1,\"price\":\"300.00\",\"created_at\":\"2026-01-24T12:34:33.000000Z\",\"updated_at\":\"2026-01-24T12:34:33.000000Z\"}]}', NULL, '2026-01-24 07:34:36', '2026-01-24 07:34:36'),
('7a39ef69-05cd-4c55-a918-3852d470a568', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Seller', 12, '{\"seller_name\":\"Seller Wahab\",\"order_id\":22,\"order_details\":[{\"id\":25,\"order_id\":22,\"service_id\":35,\"quantity\":1,\"price\":\"222.00\",\"created_at\":\"2025-09-01T04:04:11.000000Z\",\"updated_at\":\"2025-09-01T04:04:11.000000Z\"}]}', NULL, '2025-08-31 23:04:13', '2025-08-31 23:04:13'),
('7a3c2656-ac69-4f6f-a806-6e70c7cd7a78', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 6, '{\"message\":\"New service \'Seller Wahab\' added by Karachi Wash.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', NULL, '2025-04-24 11:57:14', '2025-04-24 11:57:14'),
('7aa1ff21-d1d8-4cd8-b532-a8494370e8a6', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Seller', 12, '{\"seller_name\":\"Seller Wahab\",\"order_id\":21,\"order_details\":[{\"id\":24,\"order_id\":21,\"service_id\":35,\"quantity\":1,\"price\":\"222.00\",\"created_at\":\"2025-08-18T05:52:14.000000Z\",\"updated_at\":\"2025-08-18T05:52:14.000000Z\"}]}', NULL, '2025-08-18 00:52:14', '2025-08-18 00:52:14'),
('7ad72e49-e22d-414c-b75f-2114e804957d', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Seller', 11, '{\"seller_name\":\"Seller UmairSolangiCEO\",\"order_id\":12,\"order_details\":[{\"id\":13,\"order_id\":12,\"service_id\":32,\"quantity\":1,\"price\":\"333.00\",\"created_at\":\"2025-05-07T06:47:42.000000Z\",\"updated_at\":\"2025-05-07T06:47:42.000000Z\"}]}', NULL, '2025-05-07 01:47:42', '2025-05-07 01:47:42'),
('7be64b67-0965-410c-9fbe-c14b17f83d84', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 32, '{\"message\":\"New service \'Seller Umair\' added by Biryani.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/17\\/services\"}', NULL, '2025-12-15 02:34:38', '2025-12-15 02:34:38'),
('7bf96246-c06b-44ac-8cce-9fbb1c27ca39', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 7, '{\"message\":\"New service \'Seller Wahab\' added by Karachi Wash.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', NULL, '2025-04-24 11:57:15', '2025-04-24 11:57:15'),
('7c977e32-7c51-4981-b9aa-e467f0bd9a54', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 6, '{\"message\":\"New service \'Seller Zubair\' added by Moosa Seller Washing Service.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/13\\/services\"}', NULL, '2025-04-24 14:29:35', '2025-04-24 14:29:35'),
('7e42f92b-d14b-4177-983c-c19365379946', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 32, '{\"message\":\"New service \'Seller Umair\' added by Chicken Biryani.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/17\\/services\"}', NULL, '2025-12-12 06:36:52', '2025-12-12 06:36:52'),
('813101f0-ecd5-4fe0-906e-f6e6d24348a4', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 21, '{\"message\":\"New service \'Seller UmairSolangiCEO\' added by Carpet Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/11\\/services\"}', NULL, '2025-04-24 08:06:58', '2025-04-24 08:06:58'),
('815dd56a-28b5-4812-8a62-6b665d2363e6', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 1, '{\"message\":\"New service \'Seller Wahab\' added by Laptop Bag Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', NULL, '2025-04-24 09:12:15', '2025-04-24 09:12:15'),
('817f23cf-fa08-49b4-ad18-5bcbddd7f138', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 24, '{\"message\":\"New service \'Seller Umair\' added by Chicken Biryani.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/17\\/services\"}', NULL, '2025-12-12 06:37:03', '2025-12-12 06:37:03'),
('837154e7-97e4-4424-8e6e-610356fe1703', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 16, '{\"message\":\"New service \'Umair seller\' added by Chicken Biryani.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/21\\/services\"}', NULL, '2026-04-13 10:20:48', '2026-04-13 10:20:48'),
('84088803-a765-4a5e-af81-1602ab0cf622', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 10, '{\"message\":\"New service \'Seller Wahab\' added by Karachi Wash.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', NULL, '2025-04-24 11:57:20', '2025-04-24 11:57:20'),
('845b8aca-f87b-48fd-ade7-b7b6eb582f05', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 16, '{\"message\":\"New service \'Seller Zubair\' added by Moosa Seller Washing Service.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/13\\/services\"}', NULL, '2025-04-24 14:29:59', '2025-04-24 14:29:59'),
('85f83a9b-9796-4eb8-9f1d-afa39c325f75', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 34, '{\"message\":\"New service \'seller umair\' added by Chicken Qorma.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/19\\/services\"}', NULL, '2025-12-17 07:31:29', '2025-12-17 07:31:29'),
('86c54118-443f-4015-9ac8-e19bb4b7b786', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 15, '{\"message\":\"New service \'Seller Wahab\' added by Laptop Bag Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', NULL, '2025-04-24 09:12:39', '2025-04-24 09:12:39'),
('87952b0c-4fab-4574-9ad1-9ec5e0ae2ec8', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Seller', 17, '{\"seller_name\":\"Seller Umair\",\"order_id\":25,\"order_details\":[{\"id\":28,\"order_id\":25,\"service_id\":42,\"quantity\":1,\"price\":\"300.00\",\"created_at\":\"2025-12-12T11:41:38.000000Z\",\"updated_at\":\"2025-12-12T11:41:38.000000Z\"}]}', NULL, '2025-12-12 06:41:38', '2025-12-12 06:41:38'),
('87e1844f-ed9d-45f8-8af4-e06f29e232fa', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 23, '{\"message\":\"New service \'umair seller\' added by Lab e Sheeren.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/16\\/services\"}', NULL, '2025-12-12 02:04:58', '2025-12-12 02:04:58'),
('8b9a4bb1-0b27-4d1d-85fc-ba9345694b9c', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 23, '{\"message\":\"New service \'Seller Umair\' added by Beef Biryani.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/18\\/services\"}', NULL, '2025-12-15 02:57:35', '2025-12-15 02:57:35'),
('8be0d95b-b891-49a6-a58f-3c9f995bcd12', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 34, '{\"message\":\"New service \'Seller Zubair\' added by Cold Coffee.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/13\\/services\"}', NULL, '2026-01-24 07:56:39', '2026-01-24 07:56:39'),
('8c0476ff-b8b3-4e4d-93b6-3472188faf9c', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 4, '{\"message\":\"New service \'Seller Wahab\' added by Laptop Bag Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', NULL, '2025-04-24 09:12:22', '2025-04-24 09:12:22'),
('8c5f6b3b-0816-4548-9c49-176f9be901af', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 6, '{\"message\":\"New service \'Seller UmairSolangiCEO\' added by Shalwar Qamiz Washing and Ironadf.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/11\\/services\"}', NULL, '2025-04-09 11:21:45', '2025-04-09 11:21:45'),
('8d6e0d5d-d06f-49ac-81c1-96ca53331310', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 28, '{\"message\":\"New service \'Seller Umair\' added by Chicken Qorma.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/17\\/services\"}', NULL, '2025-12-12 06:39:11', '2025-12-12 06:39:11'),
('8e4c9665-6619-4994-90f9-54c8ba3cec4a', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 1, '{\"message\":\"New service \'Seller UmairSolangiCEO\' added by Shalwar Qamiz Washing and Ironadf.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/11\\/services\"}', NULL, '2025-04-09 11:21:34', '2025-04-09 11:21:34'),
('913f4b9d-f846-457c-ba36-eb1c3a223410', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 16, '{\"message\":\"New service \'Seller UmairSolangiCEO\' added by Shalwar Qamiz Washing and Ironadf.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/11\\/services\"}', NULL, '2025-04-09 11:22:03', '2025-04-09 11:22:03'),
('930e6f96-8c91-4081-a0a1-f8ca7506025e', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 1, '{\"message\":\"New service \'Seller Zubair\' added by Moosa Seller Washing Service.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/13\\/services\"}', NULL, '2025-04-24 14:29:17', '2025-04-24 14:29:17'),
('954f3f16-a6d1-48a5-9cad-03b7dca56047', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 4, '{\"message\":\"New service \'Seller Wahab\' added by Karachi Wash.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', NULL, '2025-04-24 11:57:11', '2025-04-24 11:57:11'),
('95855e46-f153-477d-adde-b35a50da10b2', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 30, '{\"message\":\"New service \'umair seller\' added by Biryani.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/16\\/services\"}', NULL, '2025-12-12 01:18:09', '2025-12-12 01:18:09'),
('97b362df-148a-492a-aab1-bf19c3b69483', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 19, '{\"message\":\"New service \'Seller UmairSolangiCEO\' added by Carpet Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/11\\/services\"}', NULL, '2025-04-24 08:06:55', '2025-04-24 08:06:55'),
('9b7d213f-22d7-4443-ad0f-d52d796f2ef8', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Seller', 11, '{\"seller_name\":\"Seller UmairSolangiCEO\",\"order_id\":3,\"order_details\":[{\"id\":4,\"order_id\":3,\"service_id\":31,\"quantity\":1,\"price\":\"2211.00\",\"created_at\":\"2025-04-09T16:28:17.000000Z\",\"updated_at\":\"2025-04-09T16:28:17.000000Z\"}]}', NULL, '2025-04-09 11:28:17', '2025-04-09 11:28:17'),
('9d39809a-38b6-4ce7-b51a-a2f828dfdfad', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 17, '{\"message\":\"New service \'Seller Zubair\' added by Moosa Seller Washing Service.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/13\\/services\"}', NULL, '2025-04-24 14:30:01', '2025-04-24 14:30:01'),
('a0b61633-4130-4618-aea5-9d8dc62ecf2e', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 33, '{\"message\":\"New service \'Seller Umair\' added by Beef Biryani.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/18\\/services\"}', NULL, '2025-12-15 02:57:30', '2025-12-15 02:57:30'),
('a0e16d17-3751-40bd-9985-ba667d3a5772', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 15, '{\"message\":\"New service \'Seller Zubair\' added by Moosa Seller Washing Service.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/13\\/services\"}', NULL, '2025-04-24 14:29:57', '2025-04-24 14:29:57'),
('a16399dc-1bd8-4304-9fb2-50901d4a48fa', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 34, '{\"message\":\"New service \'Seller Zubair\' added by Chicken Paratha Roll.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/13\\/services\"}', NULL, '2026-01-24 07:48:22', '2026-01-24 07:48:22'),
('a2637a39-ae02-4f89-9b30-a9cbf47f2fb4', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Seller', 12, '{\"seller_name\":\"Seller Wahab\",\"order_id\":7,\"order_details\":[{\"id\":8,\"order_id\":7,\"service_id\":33,\"quantity\":1,\"price\":\"1122.00\",\"created_at\":\"2025-04-24T16:41:06.000000Z\",\"updated_at\":\"2025-04-24T16:41:06.000000Z\"}]}', NULL, '2025-04-24 11:41:06', '2025-04-24 11:41:06'),
('a2eb5d98-8157-4895-ad12-a56759fe391e', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 32, '{\"message\":\"New service \'Seller Umair\' added by Chicken Qorma.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/17\\/services\"}', NULL, '2025-12-12 06:39:04', '2025-12-12 06:39:04'),
('a3a01ab7-9d48-4ee5-ae74-55cd0710c2b0', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 16, '{\"message\":\"New service \'Seller Umair\' added by Beef Biryani.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/18\\/services\"}', NULL, '2025-12-15 02:57:37', '2025-12-15 02:57:37'),
('a3e96d50-5150-42e7-aa4b-849ed8a631ac', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 5, '{\"message\":\"New service \'Seller Wahab\' added by Laptop Bag Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', NULL, '2025-04-24 09:12:24', '2025-04-24 09:12:24'),
('a4e776c4-d61d-4c3b-b747-56b804cf1c1d', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 4, '{\"message\":\"New service \'Seller Zubair\' added by Moosa Seller Washing Service.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/13\\/services\"}', NULL, '2025-04-24 14:29:31', '2025-04-24 14:29:31'),
('a5c36cb8-9171-4f81-b734-0f93dabd4c86', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Seller', 12, '{\"seller_name\":\"Seller Wahab\",\"order_id\":10,\"order_details\":[{\"id\":11,\"order_id\":10,\"service_id\":33,\"quantity\":1,\"price\":\"1122.00\",\"created_at\":\"2025-05-04T09:38:40.000000Z\",\"updated_at\":\"2025-05-04T09:38:40.000000Z\"}]}', NULL, '2025-05-04 04:38:42', '2025-05-04 04:38:42'),
('a68411b8-b50b-4e3a-bb07-f7f6700cbbc3', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 2, '{\"message\":\"New service \'Seller Zubair\' added by Moosa Seller Washing Service.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/13\\/services\"}', NULL, '2025-04-24 14:29:22', '2025-04-24 14:29:22'),
('a6d1a5c7-d5e7-433d-acaf-a1586034bb44', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 11, '{\"message\":\"New service \'Seller Wahab\' added by Laptop Bag Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', NULL, '2025-04-24 09:12:33', '2025-04-24 09:12:33'),
('a6fcf2c0-04e2-46e0-8e20-784a82c553a0', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 36, '{\"message\":\"New service \'Seller Zubair\' added by Chicken Paratha Roll.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/13\\/services\"}', NULL, '2026-01-24 07:48:05', '2026-01-24 07:48:05'),
('ad0ba170-8c8b-4a29-9e8c-c107f61b71c6', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 17, '{\"message\":\"New service \'Seller Wahab\' added by Karachi Wash.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', NULL, '2025-04-24 11:57:30', '2025-04-24 11:57:30'),
('aef42cf2-b4e0-47fa-829a-8e1b2441d5e7', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 8, '{\"message\":\"New service \'Seller UmairSolangiCEO\' added by Shalwar Qamiz Washing and Ironadf.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/11\\/services\"}', NULL, '2025-04-09 11:21:50', '2025-04-09 11:21:50');
INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('aff31f15-7871-4b3d-aab2-b877c3f1b1bf', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 13, '{\"message\":\"New service \'Seller Wahab\' added by Karachi Wash.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', NULL, '2025-04-24 11:57:24', '2025-04-24 11:57:24'),
('b0dd0eea-bf64-4271-95d0-d2747cbdce10', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 35, '{\"message\":\"New service \'Seller Zubair\' added by Chicken Paratha Roll.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/13\\/services\"}', NULL, '2026-01-24 07:48:20', '2026-01-24 07:48:20'),
('b36f7014-8d35-44a9-86d9-56db04ac0e2c', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 30, '{\"message\":\"New service \'umair seller\' added by Lab e Sheeren.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/16\\/services\"}', NULL, '2025-12-12 02:34:42', '2025-12-12 02:34:42'),
('b3f1fc37-7068-4419-bfda-72328a24afc2', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 3, '{\"message\":\"New service \'Seller Wahab\' added by Laptop Bag Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', NULL, '2025-04-24 09:12:21', '2025-04-24 09:12:21'),
('b805830a-2ff0-4c51-91cd-a388e8df7883', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Seller', 17, '{\"seller_name\":\"Seller Umair\",\"order_id\":26,\"order_details\":[{\"id\":29,\"order_id\":26,\"service_id\":44,\"quantity\":1,\"price\":\"300.00\",\"created_at\":\"2025-12-15T07:35:35.000000Z\",\"updated_at\":\"2025-12-15T07:35:35.000000Z\"}]}', NULL, '2025-12-15 02:35:35', '2025-12-15 02:35:35'),
('ba813eb4-bb56-43ee-a28d-78205dbf5745', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 30, '{\"message\":\"New service \'umair seller\' added by Chicken Qorma.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/16\\/services\"}', NULL, '2025-12-12 01:41:39', '2025-12-12 01:41:39'),
('baf319e1-e210-4006-80f1-d25516238502', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 8, '{\"message\":\"New service \'Seller UmairSolangiCEO\' added by Carpet Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/11\\/services\"}', NULL, '2025-04-24 08:06:34', '2025-04-24 08:06:34'),
('bc85aaaf-d2db-4bd8-baa6-cfcc88da6637', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 17, '{\"message\":\"New service \'Seller UmairSolangiCEO\' added by Carpet Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/11\\/services\"}', NULL, '2025-04-24 08:06:51', '2025-04-24 08:06:51'),
('bcb28a0f-a629-4e64-87e4-3cb88533f805', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 16, '{\"message\":\"New service \'Seller Wahab\' added by Laptop Bag Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', NULL, '2025-04-24 09:12:40', '2025-04-24 09:12:40'),
('bd2116ca-7456-4016-8006-2680dd620f17', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 12, '{\"message\":\"New service \'Seller Zubair\' added by Moosa Seller Washing Service.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/13\\/services\"}', NULL, '2025-04-24 14:29:51', '2025-04-24 14:29:51'),
('bea8d1ae-de4d-4ac4-aa8a-f4bd13f30336', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 14, '{\"message\":\"New service \'Seller Wahab\' added by Laptop Bag Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', NULL, '2025-04-24 09:12:37', '2025-04-24 09:12:37'),
('bf486351-4d51-4663-b681-4d3948a31ba6', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 37, '{\"message\":\"New service \'Umair seller\' added by Chicken Biryani.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/21\\/services\"}', NULL, '2026-04-13 10:20:30', '2026-04-13 10:20:30'),
('bf6bff6b-f42a-446e-8af5-a45b15f59edc', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 16, '{\"message\":\"New service \'Seller Zubair\' added by Chicken Paratha Roll.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/13\\/services\"}', NULL, '2026-01-24 07:48:25', '2026-01-24 07:48:25'),
('bff9f084-8427-411c-b086-0bdbba2ddadc', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 22, '{\"message\":\"New service \'Seller Wahab\' added by Karachi Wash.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', NULL, '2025-04-24 11:57:38', '2025-04-24 11:57:38'),
('c005437b-9903-4418-84a9-998f824b08fc', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Seller', 21, '{\"seller_name\":\"Umair seller\",\"order_id\":32,\"order_details\":[{\"id\":35,\"order_id\":32,\"service_id\":49,\"quantity\":1,\"price\":\"55556.00\",\"created_at\":\"2026-06-06T08:55:50.000000Z\",\"updated_at\":\"2026-06-06T08:55:50.000000Z\"}]}', NULL, '2026-06-06 03:55:51', '2026-06-06 03:55:51'),
('c010fb4c-8de9-425c-b687-f02bbf519eab', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 14, '{\"message\":\"New service \'Seller Wahab\' added by Karachi Wash.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', NULL, '2025-04-24 11:57:26', '2025-04-24 11:57:26'),
('c0f47a71-3228-4d3d-b221-52f25791b924', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Seller', 18, '{\"seller_name\":\"Seller Umair\",\"order_id\":27,\"order_details\":[{\"id\":30,\"order_id\":27,\"service_id\":45,\"quantity\":2,\"price\":\"300.00\",\"created_at\":\"2025-12-15T07:58:07.000000Z\",\"updated_at\":\"2025-12-15T07:58:07.000000Z\"}]}', NULL, '2025-12-15 02:58:07', '2025-12-15 02:58:07'),
('c3b44516-2b4e-497d-8795-747a5fafd6d5', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 8, '{\"message\":\"New service \'Seller Zubair\' added by Moosa Seller Washing Service.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/13\\/services\"}', NULL, '2025-04-24 14:29:38', '2025-04-24 14:29:38'),
('c40c2b3f-9055-46d0-9462-39cdc6f40947', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 24, '{\"message\":\"New service \'Seller Umair\' added by Biryani.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/17\\/services\"}', NULL, '2025-12-15 02:34:53', '2025-12-15 02:34:53'),
('c47115e4-ea27-47e8-a194-d2b664e42c41', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 19, '{\"message\":\"New service \'Seller Wahab\' added by Laptop Bag Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', NULL, '2025-04-24 09:12:45', '2025-04-24 09:12:45'),
('c59c1ec8-4196-4e45-95bc-c0d7bb86da04', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 36, '{\"message\":\"New service \'Seller Zubair\' added by Cold Coffee.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/13\\/services\"}', NULL, '2026-01-24 07:56:30', '2026-01-24 07:56:30'),
('c7aa424f-219c-47de-97f7-15dcb3506d98', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 9, '{\"message\":\"New service \'Seller Wahab\' added by Karachi Wash.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', NULL, '2025-04-24 11:57:18', '2025-04-24 11:57:18'),
('c7fa3d2c-4b1f-4302-8bdc-e563f30867d0', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Seller', 16, '{\"seller_name\":\"umair seller\",\"order_id\":24,\"order_details\":[{\"id\":27,\"order_id\":24,\"service_id\":38,\"quantity\":1,\"price\":\"300.00\",\"created_at\":\"2025-12-12T06:47:28.000000Z\",\"updated_at\":\"2025-12-12T06:47:28.000000Z\"}]}', NULL, '2025-12-12 01:47:28', '2025-12-12 01:47:28'),
('c9914e2b-b172-4068-a67c-9916fa874f5b', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 2, '{\"message\":\"New service \'Seller UmairSolangiCEO\' added by Shalwar Qamiz Washing and Ironadf.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/11\\/services\"}', NULL, '2025-04-09 11:21:39', '2025-04-09 11:21:39'),
('c9b9b035-df6e-4f81-a80b-870419190fb9', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 12, '{\"message\":\"New service \'Seller Wahab\' added by Laptop Bag Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', NULL, '2025-04-24 09:12:34', '2025-04-24 09:12:34'),
('ccbbe658-5373-4a74-a29a-242a33969177', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Seller', 11, '{\"seller_name\":\"Seller UmairSolangiCEO\",\"order_id\":13,\"order_details\":[{\"id\":14,\"order_id\":13,\"service_id\":32,\"quantity\":1,\"price\":\"333.00\",\"created_at\":\"2025-05-07T06:49:12.000000Z\",\"updated_at\":\"2025-05-07T06:49:12.000000Z\"}]}', NULL, '2025-05-07 01:49:12', '2025-05-07 01:49:12'),
('cd650c9b-437a-49c3-940b-21798c10610d', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Seller', 11, '{\"seller_name\":\"Seller UmairSolangiCEO\",\"order_id\":4,\"order_details\":[{\"id\":5,\"order_id\":4,\"service_id\":31,\"quantity\":2,\"price\":\"2211.00\",\"created_at\":\"2025-04-22T16:54:02.000000Z\",\"updated_at\":\"2025-04-22T16:54:02.000000Z\"}]}', NULL, '2025-04-22 11:54:03', '2025-04-22 11:54:03'),
('cd7dce80-b0f4-47fb-9033-888fb68aad4b', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 30, '{\"message\":\"New service \'Seller Umair\' added by Chicken Qorma.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/17\\/services\"}', NULL, '2025-12-12 06:39:10', '2025-12-12 06:39:10'),
('cde19dee-eaad-4490-a253-5e949ac3485e', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 17, '{\"message\":\"New service \'Seller UmairSolangiCEO\' added by Shalwar Qamiz Washing and Ironadf.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/11\\/services\"}', NULL, '2025-04-09 11:22:05', '2025-04-09 11:22:05'),
('d0edbbf0-3bd3-4a7e-874f-67f7ba26801c', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 30, '{\"message\":\"New service \'Seller Umair\' added by Chicken Biryani.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/17\\/services\"}', NULL, '2025-12-12 06:37:00', '2025-12-12 06:37:00'),
('d13535bc-eaed-4568-978a-8119c508a0e9', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 15, '{\"message\":\"New service \'Seller Wahab\' added by Karachi Wash.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', NULL, '2025-04-24 11:57:27', '2025-04-24 11:57:27'),
('d6ccb3f7-efbf-4ebe-8406-c3b319eb6349', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 10, '{\"message\":\"New service \'Seller UmairSolangiCEO\' added by Carpet Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/11\\/services\"}', NULL, '2025-04-24 08:06:37', '2025-04-24 08:06:37'),
('d74f79af-b822-4892-b7f6-1b9722c5da1f', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 7, '{\"message\":\"New service \'Seller UmairSolangiCEO\' added by Shalwar Qamiz Washing and Ironadf.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/11\\/services\"}', NULL, '2025-04-09 11:21:47', '2025-04-09 11:21:47'),
('d7c64cd9-f2ed-4f93-8fa4-67bac67f5139', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 24, '{\"message\":\"New service \'umair seller\' added by Chicken Qorma.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/16\\/services\"}', NULL, '2025-12-12 01:41:42', '2025-12-12 01:41:42'),
('d86638fd-62a1-4b14-846a-1b448bd7b941', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 22, '{\"message\":\"New service \'Seller UmairSolangiCEO\' added by Carpet Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/11\\/services\"}', NULL, '2025-04-24 08:07:00', '2025-04-24 08:07:00'),
('d8a7b69f-73a5-4895-b7ff-0c1afd73eeed', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 23, '{\"message\":\"New service \'umair seller\' added by Lab e Sheeren.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/16\\/services\"}', NULL, '2025-12-12 02:34:46', '2025-12-12 02:34:46'),
('d905ed90-cebf-41da-825a-5fb8fdbe75b7', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Seller', 12, '{\"seller_name\":\"Seller Wahab\",\"order_id\":8,\"order_details\":[{\"id\":9,\"order_id\":8,\"service_id\":35,\"quantity\":1,\"price\":\"222.00\",\"created_at\":\"2025-04-24T17:13:01.000000Z\",\"updated_at\":\"2025-04-24T17:13:01.000000Z\"}]}', NULL, '2025-04-24 12:13:02', '2025-04-24 12:13:02'),
('de07933a-f72a-491f-8f40-0e9b52efd706', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 3, '{\"message\":\"New service \'Seller Wahab\' added by Karachi Wash.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', NULL, '2025-04-24 11:57:09', '2025-04-24 11:57:09'),
('df267580-700f-41d2-b5da-2911d60de039', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 30, '{\"message\":\"New service \'umair seller\' added by Falooda Ice Cream.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/16\\/services\"}', NULL, '2025-12-12 02:36:46', '2025-12-12 02:36:46'),
('e291c4f2-f0ef-4c02-b901-b74655ccae88', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 10, '{\"message\":\"New service \'Seller Wahab\' added by Laptop Bag Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', NULL, '2025-04-24 09:12:31', '2025-04-24 09:12:31'),
('e6853f4e-9a10-47b1-a375-b1206e9ae133', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 9, '{\"message\":\"New service \'Seller Zubair\' added by Moosa Seller Washing Service.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/13\\/services\"}', NULL, '2025-04-24 14:29:45', '2025-04-24 14:29:45'),
('e7abcfdd-db78-490d-8b32-70bca3891795', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 12, '{\"message\":\"New service \'Seller UmairSolangiCEO\' added by Shalwar Qamiz Washing and Ironadf.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/11\\/services\"}', NULL, '2025-04-09 11:21:56', '2025-04-09 11:21:56'),
('eaa0cf15-1b4a-4637-b99b-f4b099533e15', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 11, '{\"message\":\"New service \'seller umair\' added by Chicken Qorma.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/19\\/services\"}', NULL, '2025-12-17 07:31:44', '2025-12-17 07:31:44'),
('ed9bd426-ff11-4f6a-8e51-aadfb79bfd55', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Seller', 1, '{\"seller_name\":\"Kameron Dooley\",\"order_id\":2,\"order_details\":[{\"id\":3,\"order_id\":2,\"service_id\":1,\"quantity\":1,\"price\":\"41.03\",\"created_at\":\"2025-04-07T10:52:07.000000Z\",\"updated_at\":\"2025-04-07T10:52:07.000000Z\"}]}', NULL, '2025-04-07 05:52:07', '2025-04-07 05:52:07'),
('eea15aa3-c154-44a8-b7fb-7a8baf324329', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 11, '{\"message\":\"New service \'Seller Wahab\' added by Karachi Wash.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', NULL, '2025-04-24 11:57:21', '2025-04-24 11:57:21'),
('f02df578-fabe-48ee-bf2a-cce6caf6f939', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Seller', 13, '{\"seller_name\":\"Seller Zubair\",\"order_id\":20,\"order_details\":[{\"id\":23,\"order_id\":20,\"service_id\":36,\"quantity\":1,\"price\":\"222.00\",\"created_at\":\"2025-08-18T05:48:17.000000Z\",\"updated_at\":\"2025-08-18T05:48:17.000000Z\"}]}', NULL, '2025-08-18 00:48:17', '2025-08-18 00:48:17'),
('f174136e-3aa9-482d-b147-103506c1b62d', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 34, '{\"message\":\"New service \'Umair seller\' added by Chicken Biryani.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/21\\/services\"}', NULL, '2026-04-13 10:20:47', '2026-04-13 10:20:47'),
('f6adaa90-1c74-4016-8549-265181fe9f94', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 14, '{\"message\":\"New service \'Seller UmairSolangiCEO\' added by Carpet Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/11\\/services\"}', NULL, '2025-04-24 08:06:46', '2025-04-24 08:06:46'),
('f701788c-1287-4276-9196-42f018ac66d6', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 9, '{\"message\":\"New service \'Seller UmairSolangiCEO\' added by Carpet Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/11\\/services\"}', NULL, '2025-04-24 08:06:36', '2025-04-24 08:06:36'),
('f7bebdd0-5de9-4d4a-965a-d27fccbbc003', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 19, '{\"message\":\"New service \'Seller Zubair\' added by Moosa Seller Washing Service.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/13\\/services\"}', NULL, '2025-04-24 14:30:05', '2025-04-24 14:30:05'),
('f852b5e4-189f-4cd5-b9be-5e2fae933793', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 8, '{\"message\":\"New service \'Seller Wahab\' added by Karachi Wash.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', NULL, '2025-04-24 11:57:17', '2025-04-24 11:57:17'),
('fa7d45ff-b418-4970-9cf4-8cb9f5f8adca', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 31, '{\"message\":\"New service \'umair seller\' added by Falooda Ice Cream.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/16\\/services\"}', NULL, '2025-12-12 02:36:43', '2025-12-12 02:36:43'),
('faeb3902-87aa-44a9-9ac5-5fa6c3e1521b', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 24, '{\"message\":\"New service \'umair seller\' added by Biryani.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/16\\/services\"}', NULL, '2025-12-12 01:18:13', '2025-12-12 01:18:13'),
('fc07e3c0-caf1-481f-a69a-7bfe165e81dd', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 19, '{\"message\":\"New service \'Seller Wahab\' added by Karachi Wash.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/12\\/services\"}', NULL, '2025-04-24 11:57:33', '2025-04-24 11:57:33'),
('fcdbe5b2-108e-44a0-aab3-10ac8a1739b0', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 23, '{\"message\":\"New service \'Seller Umair\' added by Chicken Qorma.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/17\\/services\"}', NULL, '2025-12-12 06:39:14', '2025-12-12 06:39:14'),
('fd533323-9a27-4a38-9c17-e98f67efdf75', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 15, '{\"message\":\"New service \'Seller UmairSolangiCEO\' added by Carpet Washing.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/11\\/services\"}', NULL, '2025-04-24 08:06:48', '2025-04-24 08:06:48'),
('fda040b3-b75f-4511-a558-b341615f43ec', 'App\\Notifications\\NewServiceAddedNotification', 'App\\Models\\User', 5, '{\"message\":\"New service \'Seller UmairSolangiCEO\' added by Shalwar Qamiz Washing and Ironadf.\",\"service_url\":\"http:\\/\\/127.0.0.1:8000\\/sellers\\/11\\/services\"}', NULL, '2025-04-09 11:21:44', '2025-04-09 11:21:44'),
('ff3233af-ad0b-4c7e-9691-2c3c98c6ba01', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\Seller', 13, '{\"seller_name\":\"Seller Zubair\",\"order_id\":9,\"order_details\":[{\"id\":10,\"order_id\":9,\"service_id\":36,\"quantity\":1,\"price\":\"222.00\",\"created_at\":\"2025-04-24T19:32:35.000000Z\",\"updated_at\":\"2025-04-24T19:32:35.000000Z\"}]}', NULL, '2025-04-24 14:32:35', '2025-04-24 14:32:35');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `seller_id` bigint UNSIGNED NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `transaction_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancellation_reason` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `seller_id`, `address`, `phone`, `status`, `total_amount`, `transaction_id`, `cancellation_reason`, `cancelled_at`, `created_at`, `updated_at`) VALUES
(16, 18, 11, 'House NO 310 Street NO 17 Sector 4 Block B New Saeedabad Baldia Town Karachi', '03242232321', 'pending', '666.00', NULL, NULL, NULL, '2025-05-27 01:05:51', '2025-05-27 01:05:51'),
(17, 18, 11, 'House NO 310 Street NO 17 Sector 4 Block B New Saeedabad Baldia Town Karachi', '03242232321', 'pending', '666.00', NULL, NULL, NULL, '2025-05-27 01:06:20', '2025-05-27 01:06:20'),
(18, 18, 12, 'House NO 310 Street NO 17 Sector 4 Block B New Saeedabad Baldia Town Karachi', '03242232321', 'completed', '222.00', NULL, NULL, NULL, '2025-08-18 00:46:30', '2025-08-18 00:54:32'),
(19, 18, 12, 'House NO 310 Street NO 17 Sector 4 Block B New Saeedabad Baldia Town Karachi', '03161126421', 'pending', '1344.00', NULL, NULL, NULL, '2025-08-18 00:47:18', '2025-08-18 00:47:18'),
(20, 18, 13, 'House NO 310 Street NO 17 Sector 4 Block B New Saeedabad Baldia Town Karachi', '03161126421', 'completed', '222.00', '11223333445566', NULL, NULL, '2025-08-18 00:48:17', '2026-01-24 07:51:51'),
(21, 18, 12, 'House NO 310 Street NO 17 Sector 4 Block B New Saeedabad Baldia Town Karachi', '03161126421', 'pending', '222.00', NULL, NULL, NULL, '2025-08-18 00:52:14', '2025-08-18 00:52:14'),
(22, 21, 12, 'House NO 310 Street NO 17 Sector 4 Block B New Saeedabad Baldia Town Karachi', '8888888888888', 'completed', '222.00', NULL, NULL, NULL, '2025-08-31 23:04:11', '2025-08-31 23:07:41'),
(23, 31, 16, 'House NO 310 Street NO 17 Sector 4 Block B New Saeedabad Baldia Town Karachi', '03161126421', 'completed', '200.00', NULL, NULL, NULL, '2025-12-12 01:21:55', '2025-12-12 01:24:29'),
(24, 31, 16, 'House NO 310 Street NO 17 Sector 4 Block B New Saeedabad Baldia Town Karachi', '03242232321', 'pickup_departed', '300.00', NULL, NULL, NULL, '2025-12-12 01:47:28', '2025-12-12 01:47:57'),
(25, 32, 17, 'House NO 310 Street NO 17 Sector 4 Block B New Saeedabad Baldia Town Karachi', '03242232321', 'pickup_departed', '300.00', NULL, NULL, NULL, '2025-12-12 06:41:38', '2025-12-12 06:43:36'),
(26, 32, 17, 'House NO 310 Street NO 17 Sector 4 Block B New Saeedabad Baldia Town Karachi', '03242232321', 'completed', '300.00', NULL, NULL, NULL, '2025-12-15 02:35:35', '2025-12-15 02:44:42'),
(27, 33, 18, 'House NO 310 Street NO 17 Sector 4 Block B New Saeedabad Baldia Town Karachi', '03242232321', 'completed', '600.00', NULL, NULL, NULL, '2025-12-15 02:58:07', '2025-12-15 02:58:45'),
(28, 34, 19, 'House NO 310 Street NO 17 Sector 4 Block B New Saeedabad Baldia Town Karachi', '03242232321', 'completed', '300.00', NULL, NULL, NULL, '2025-12-17 07:34:58', '2025-12-17 07:38:36'),
(29, 36, 19, 'House NO 310 Street NO 17 Sector 4 Block B New Saeedabad Baldia Town Karachi', '03242232321', 'pending', '300.00', NULL, NULL, NULL, '2026-01-24 07:34:33', '2026-01-24 07:34:33'),
(30, 36, 13, 'House NO 310 Street NO 17 Sector 4 Block B New Saeedabad Baldia Town Karachi', '03242232321', 'packed', '444.00', NULL, NULL, NULL, '2026-01-24 07:57:08', '2026-01-24 07:57:51'),
(31, 37, 21, 'House NO 310 Street NO 17 Sector 4 Block B New Saeedabad Baldia Town Karachi', '03242232321', 'completed', '55556.00', NULL, NULL, NULL, '2026-04-13 10:22:35', '2026-04-13 10:23:25'),
(32, 37, 21, 'House NO 310 Street NO 17 Sector 4 Block B New Saeedabad Baldia Town Karachi', '1234456789', 'pending', '55556.00', NULL, NULL, NULL, '2026-06-06 03:55:50', '2026-06-06 03:55:50');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `service_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `service_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(4, 3, 31, 1, '2211.00', '2025-04-09 11:28:17', '2025-04-09 11:28:17'),
(5, 4, 31, 2, '2211.00', '2025-04-22 11:54:02', '2025-04-22 11:54:02'),
(6, 5, 31, 1, '2211.00', '2025-04-22 11:54:53', '2025-04-22 11:54:53'),
(7, 6, 33, 1, '1122.00', '2025-04-24 11:40:29', '2025-04-24 11:40:29'),
(8, 7, 33, 1, '1122.00', '2025-04-24 11:41:06', '2025-04-24 11:41:06'),
(9, 8, 35, 1, '222.00', '2025-04-24 12:13:01', '2025-04-24 12:13:01'),
(10, 9, 36, 1, '222.00', '2025-04-24 14:32:35', '2025-04-24 14:32:35'),
(11, 10, 33, 1, '1122.00', '2025-05-04 04:38:40', '2025-05-04 04:38:40'),
(12, 11, 35, 1, '222.00', '2025-05-07 00:31:16', '2025-05-07 00:31:16'),
(13, 12, 32, 1, '333.00', '2025-05-07 01:47:42', '2025-05-07 01:47:42'),
(14, 13, 32, 1, '333.00', '2025-05-07 01:49:12', '2025-05-07 01:49:12'),
(15, 14, 32, 1, '333.00', '2025-05-27 00:40:05', '2025-05-27 00:40:05'),
(16, 15, 32, 2, '333.00', '2025-05-27 00:56:28', '2025-05-27 00:56:28'),
(17, 15, 31, 1, '2211.00', '2025-05-27 00:56:28', '2025-05-27 00:56:28'),
(18, 16, 32, 2, '333.00', '2025-05-27 01:05:51', '2025-05-27 01:05:51'),
(19, 17, 32, 2, '333.00', '2025-05-27 01:06:20', '2025-05-27 01:06:20'),
(20, 18, 35, 1, '222.00', '2025-08-18 00:46:30', '2025-08-18 00:46:30'),
(21, 19, 35, 1, '222.00', '2025-08-18 00:47:18', '2025-08-18 00:47:18'),
(22, 19, 33, 1, '1122.00', '2025-08-18 00:47:18', '2025-08-18 00:47:18'),
(23, 20, 36, 1, '222.00', '2025-08-18 00:48:17', '2025-08-18 00:48:17'),
(24, 21, 35, 1, '222.00', '2025-08-18 00:52:14', '2025-08-18 00:52:14'),
(25, 22, 35, 1, '222.00', '2025-08-31 23:04:11', '2025-08-31 23:04:11'),
(26, 23, 37, 1, '200.00', '2025-12-12 01:21:55', '2025-12-12 01:21:55'),
(27, 24, 38, 1, '300.00', '2025-12-12 01:47:28', '2025-12-12 01:47:28'),
(28, 25, 42, 1, '300.00', '2025-12-12 06:41:38', '2025-12-12 06:41:38'),
(29, 26, 44, 1, '300.00', '2025-12-15 02:35:35', '2025-12-15 02:35:35'),
(30, 27, 45, 2, '300.00', '2025-12-15 02:58:07', '2025-12-15 02:58:07'),
(31, 28, 46, 1, '300.00', '2025-12-17 07:34:58', '2025-12-17 07:34:58'),
(32, 29, 46, 1, '300.00', '2026-01-24 07:34:33', '2026-01-24 07:34:33'),
(33, 30, 48, 1, '444.00', '2026-01-24 07:57:08', '2026-01-24 07:57:08'),
(34, 31, 49, 1, '55556.00', '2026-04-13 10:22:35', '2026-04-13 10:22:35'),
(35, 32, 49, 1, '55556.00', '2026-06-06 03:55:50', '2026-06-06 03:55:50');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE `sellers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Path to seller profile image',
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'City where seller operates',
  `area` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Area where seller operates',
  `accountIsApproved` int UNSIGNED NOT NULL COMMENT '1 for yes, 0 for no',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_suspended` tinyint(1) NOT NULL DEFAULT '0',
  `suspended_at` timestamp NULL DEFAULT NULL,
  `suspension_reason` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `suspended_by` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`id`, `name`, `email`, `password`, `remember_token`, `profile_image`, `city`, `area`, `accountIsApproved`, `is_deleted`, `created_at`, `updated_at`, `is_suspended`, `suspended_at`, `suspension_reason`, `suspended_by`) VALUES
(1, 'Kameron Dooley', 'volkman.cielo@example.org', '$2y$12$SCusb7lzF7DaJo7RmRWPVO17eY5J2lJEu9Z/VLSPmb0q5e1gqpFQ2', NULL, 'https://via.placeholder.com/640x480.png/0044cc?text=people+Faker+earum', 'Neldaport', 'Casper Knolls', 1, 0, '2025-04-07 05:45:34', '2025-04-07 05:45:34', 0, NULL, NULL, NULL),
(2, 'Bettie Grimes', 'lebsack.onie@example.org', '$2y$12$BAgzbpCt1pYz4/Gw19rO..H7jXVLhT7RhpnnnbKYTNvgwC0geGJLO', NULL, 'https://via.placeholder.com/640x480.png/001177?text=people+Faker+fuga', 'Lavonneberg', 'Boehm Creek', 1, 0, '2025-04-07 05:45:34', '2025-04-07 05:45:34', 0, NULL, NULL, NULL),
(3, 'Ulices Mayer', 'cade.dietrich@example.net', '$2y$12$iRGoGaVp/BqJS2RZKePVCe4vzpbDhvTio6bj3E/GMbsF7rUqXebEe', NULL, 'https://via.placeholder.com/640x480.png/0033ee?text=people+Faker+nisi', 'Lake Christa', 'Madisyn Forges', 0, 0, '2025-04-07 05:45:34', '2025-04-07 05:45:34', 0, NULL, NULL, NULL),
(4, 'Shaun Brakus', 'polly.okon@example.net', '$2y$12$KDgxK0WDjbAmJIXCH/q3Me6EXXMvUu4UennBOPfz8iHeqblWBW7Qq', NULL, 'https://via.placeholder.com/640x480.png/006677?text=people+Faker+facere', 'Hellerland', 'Foster Plains', 1, 0, '2025-04-07 05:45:34', '2025-04-07 05:45:34', 0, NULL, NULL, NULL),
(5, 'Prof. Clark Roberts IV', 'bednar.cooper@example.net', '$2y$12$BJdYKfQy/ytbZl/nXGsRE.R13F14WYt/1bO1A95Iu6FmgXZy7Te9C', NULL, 'https://via.placeholder.com/640x480.png/00eecc?text=people+Faker+minus', 'Lake Alysontown', 'Kayden Wells', 1, 0, '2025-04-07 05:45:34', '2025-04-07 05:45:34', 0, NULL, NULL, NULL),
(6, 'Chet Jacobs', 'georgette14@example.com', '$2y$12$9VJA1KtrwIfXh./lSXDM3eIJ6TBMYa.VIqwmbcoEcWFPXbC14pROa', NULL, 'https://via.placeholder.com/640x480.png/00dd88?text=people+Faker+facere', 'Ladariusville', 'Emil Pass', 1, 0, '2025-04-07 05:45:35', '2025-04-07 05:45:35', 0, NULL, NULL, NULL),
(7, 'Alda Wuckert', 'ohara.velma@example.org', '$2y$12$VzCY2c0NWDgtL2ILkKM0RuSwKTf5Qvqkv1iUSCIVULx1Q7ssq72FO', NULL, 'https://via.placeholder.com/640x480.png/006622?text=people+Faker+qui', 'Lake Cornellburgh', 'Eugene Fords', 1, 0, '2025-04-07 05:45:35', '2025-04-07 05:45:35', 0, NULL, NULL, NULL),
(8, 'Vergie Hackett PhD', 'harvey.bell@example.com', '$2y$12$RDwLrMmqslcaTKXY.YmIM.3/2bnz14WHgeQ0imzQIf7sKdl9LZJMG', NULL, 'https://via.placeholder.com/640x480.png/00bbaa?text=people+Faker+voluptatibus', 'South Betheltown', 'Lang Cove', 0, 0, '2025-04-07 05:45:35', '2025-04-07 05:45:35', 0, NULL, NULL, NULL),
(9, 'Jaiden Schmitt', 'dschmeler@example.org', '$2y$12$9LXLbUGROWcbj1qp8z/GBekJsblQuTBb4U0ydKd/cANNfqYygfTUK', NULL, 'https://via.placeholder.com/640x480.png/001188?text=people+Faker+atque', 'Nataliebury', 'Nash Forest', 0, 0, '2025-04-07 05:45:35', '2025-04-07 05:45:35', 0, NULL, NULL, NULL),
(10, 'Dr. Seth Walter II', 'okuneva.eve@example.org', '$2y$12$Ev3c3bYCYMnlZ.ApHrNmgOwO.u5fcyNoXFo.q0rlr.RmiKXwQf4uy', NULL, 'https://via.placeholder.com/640x480.png/00bb55?text=people+Faker+possimus', 'New Rainahaven', 'Olaf Camp', 0, 0, '2025-04-07 05:45:35', '2025-04-07 05:45:35', 0, NULL, NULL, NULL),
(12, 'Seller Wahab', 'sellerwahab@gmail.com', '$2y$12$AKDW6u5nWhislG21II8HveXB57yHg4.tRRqFy3nk8cxI7F0toRrNa', NULL, 'profile_images/1HvYJmpbGmJiddfmXrvLb3kbqMiErV2BKujYQFak.jpg', 'karachi', 'Baldia Town', 1, 0, '2025-04-24 09:09:00', '2025-04-24 09:10:11', 0, NULL, NULL, NULL),
(13, 'Seller Zubair', 'sellermoosa@gmail.com', '$2y$12$fgCJ2oIeDMNS25uC0WRxUOLelhS/UREV5H4HX/X9ky0doiXRa2Wpu', NULL, 'profile_images/YbH4ck1gxxMSgoNUrlUeQe9OEJJsLgu2KA9NhgAu.png', 'karachi', 'Baldia Town', 1, 0, '2025-04-24 14:25:59', '2025-04-24 14:26:50', 0, NULL, NULL, NULL),
(19, 'seller umair', 'sellerumair@gmail.com', '$2y$12$jSzsj7Etc6uBNfCkEqf.buzd8EqbVEBkpk7rj3CLctA724rnamARi', NULL, 'profile_images/MlOunvLkNXmhZZbqgmZfkIPYUfWSbQ090TSSow1E.jpg', 'karachi', 'Clifton', 1, 0, '2025-12-17 07:29:38', '2025-12-17 07:30:07', 0, NULL, NULL, NULL),
(20, 'hamza jawwed seller', 'hamzajawedseller@gmail.com', '$2y$12$DE8AjvPZuA0RcqbVNlfQ3ej0ccrrQmd3jDUhAejbzzpiU/UH1lNNi', NULL, 'profile_images/JHtixY1a1ukmQrpp3wlBZK1Ev2UhRItIur4q2tnz.jpg', 'karachi', 'clifton', 1, 0, '2026-01-24 07:36:24', '2026-01-24 07:39:00', 0, NULL, NULL, NULL),
(21, 'Umair seller', 'umairseller@gmail.com', '$2y$12$/6WQ5fahggHSuzLAWfP84OjvLKq9SFonBhvLTx9gOY56c30Gzdi1m', NULL, 'profile_images/v6cFKaxnJdRJ6z5NaiRbSnzR2j7CAWKjhBTyIMIO.png', 'karachi', 'Clifton', 1, 0, '2026-04-13 10:17:00', '2026-04-13 10:17:45', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `seller_verifications`
--

CREATE TABLE `seller_verifications` (
  `id` bigint UNSIGNED NOT NULL,
  `seller_id` bigint UNSIGNED NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cnic_number` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cnic_front_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cnic_back_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `admin_notes` text COLLATE utf8mb4_unicode_ci,
  `reviewed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seller_verifications`
--

INSERT INTO `seller_verifications` (`id`, `seller_id`, `full_name`, `cnic_number`, `address`, `phone`, `cnic_front_image`, `cnic_back_image`, `profile_picture`, `status`, `admin_notes`, `reviewed_at`, `created_at`, `updated_at`) VALUES
(1, 21, 'Umair seller', '42401-4124424-1', 'House NO 310 Street NO 17 Sector 4 Block B New Saeedabad Baldia Town Karachi\r\nHouse NO 310 Street NO 17 Sector 4 Block B New Saeedabad Baldia Town Karachi', '03161126421', 'verifications/cnic/e1eWZgqBUtSQRlrxJ1dFY25IqqclFG7uLXVDOxFp.jpg', 'verifications/cnic/DWYpa6Ov5D3bRCCWOtM1u1ERJdVEoz5sqcMJoKtP.jpg', 'verifications/profile/8CUCWffy6s4wpLIrPBlAssL7B3C1AlGSLAXvcz9A.jpg', 'approved', NULL, '2026-04-13 11:02:50', '2026-04-13 11:02:21', '2026-04-13 11:02:50');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint UNSIGNED NOT NULL,
  `seller_id` bigint UNSIGNED NOT NULL,
  `service_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `seller_city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `seller_area` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `availability` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `availability_days` json DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `is_recurring` tinyint(1) NOT NULL DEFAULT '1',
  `stock_quantity` int DEFAULT NULL,
  `category_tag` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority_score` int NOT NULL DEFAULT '0',
  `service_delivery_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `seller_contact_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_price` decimal(10,2) NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `seller_id`, `service_name`, `category`, `service_description`, `seller_city`, `seller_area`, `availability`, `availability_days`, `start_time`, `end_time`, `is_recurring`, `stock_quantity`, `category_tag`, `priority_score`, `service_delivery_time`, `seller_contact_no`, `service_price`, `image`, `is_approved`, `created_at`, `updated_at`) VALUES
(37, 16, 'Biryani', NULL, 'biryani fresh', 'karachi', 'clifton', 'Mon to Friday 1 to 5', NULL, NULL, NULL, 1, NULL, NULL, 0, '2 pm', '03164465356', '200.00', 'services/KQFhp408OBLAeZPCEeDcdQPPpdyRwxwYauaKQLTW.jpg', 0, '2025-12-12 01:17:50', '2025-12-12 01:17:50'),
(38, 16, 'Chicken Qorma', NULL, 'Fresh CHicken Qorma Salan', 'Karachi', 'Clifton', 'Thu, Fri, Sat, Sun', '[\"Thu\", \"Fri\", \"Sat\", \"Sun\"]', '03:43:00', '23:46:00', 1, 5, 'Lunch', 0, '1 Hour', '03162264654', '300.00', 'services/ukgNmJVTKfHFjHDIermXXLiRmNJ1zUZaQoZYQFN4.jpg', 0, '2025-12-12 01:41:35', '2025-12-12 01:41:35'),
(40, 16, 'Lab e Sheeren', NULL, 'Sweet and Delicious Desert Lab e Sheeren Make you Sunday Special', 'Karachi', 'Baldia Town', 'Sun', '[\"Sun\"]', '12:33:00', '18:39:00', 1, 500, 'All-Day', 0, '30 Minutes', '03165565653', '250.00', 'services/TTQbJqwruqAt0iNfQzMsXcaZNbkOj09CA8hdxzLi.jpg', 0, '2025-12-12 02:34:29', '2025-12-12 02:34:29'),
(41, 16, 'Falooda Ice Cream', NULL, 'Falooda Ice Cream Every Day Special', 'karachi', 'Baldia Town', 'Mon, Tue, Wed, Thu, Fri, Sat, Sun', '[\"Mon\", \"Tue\", \"Wed\", \"Thu\", \"Fri\", \"Sat\", \"Sun\"]', '03:36:00', '18:42:00', 1, 100, 'All-Day', 0, '30 Minutes', '03155565265', '360.00', 'services/TMZkskZij1fI0ygAkO4wlAoK0JhThTdcqYL9TVqc.jpg', 0, '2025-12-12 02:36:43', '2025-12-12 02:36:43'),
(42, 17, 'Chicken Biryani', NULL, 'Chicken Biryani Chicken Biryani Chicken Biryani Chicken Biryani Chicken Biryani', 'Karachi', 'Clifton', 'Wed, Thu, Fri', '[\"Wed\", \"Thu\", \"Fri\"]', '04:36:00', '18:36:00', 1, 44, 'Lunch', 0, '30 Minutes', '03166656565', '300.00', 'services/OuXtlQinaOSF8IWf3twskw9EoiKRxIupkI2eAYdY.jpg', 0, '2025-12-12 06:36:51', '2025-12-12 06:36:51'),
(43, 17, 'Chicken Qorma', NULL, 'Chicken Qorma special for students', 'KARACHI', 'Garden', 'Mon, Tue, Wed, Thu', '[\"Mon\", \"Tue\", \"Wed\", \"Thu\"]', '16:41:00', '21:38:00', 1, 11, 'Dinner', 0, '10 Minutes', '0326656565', '560.00', 'services/XfMTWp2XJVoACYWQmOCi2qCZXIUut2w2U5vDLuUB.jpg', 0, '2025-12-12 06:39:04', '2025-12-12 06:39:04'),
(44, 17, 'Biryani', NULL, 'Biryanin', 'karachi', 'baldia town', 'Mon, Tue, Wed, Thu, Fri, Sat, Sun', '[\"Mon\", \"Tue\", \"Wed\", \"Thu\", \"Fri\", \"Sat\", \"Sun\"]', '00:33:00', '18:34:00', 1, 50, 'Lunch', 0, '30 Minutes', '03161126421', '300.00', 'services/XKETki2CX4LZr558yKGIKR1IK3CxW5UmSzW2jufO.jpg', 0, '2025-12-15 02:34:36', '2025-12-15 02:34:36'),
(45, 18, 'Beef Biryani', NULL, 'Beef Biryani', 'Karachi', 'Clifton', 'Mon, Tue, Wed, Thu, Fri, Sat, Sun', '[\"Mon\", \"Tue\", \"Wed\", \"Thu\", \"Fri\", \"Sat\", \"Sun\"]', '00:56:00', '18:56:00', 1, 55, 'Lunch', 0, '30 Minutes', '03166656365', '300.00', 'services/dTugqvWlIRdA2UxIEtuZIrCe6x9dAK7FjCoOr63b.jpg', 0, '2025-12-15 02:57:30', '2025-12-15 02:57:30'),
(46, 19, 'Chicken Qorma', NULL, 'Chicken Qorma', 'Karachi', 'Clifton', 'Mon, Tue, Wed, Thu, Fri, Sat, Sun', '[\"Mon\", \"Tue\", \"Wed\", \"Thu\", \"Fri\", \"Sat\", \"Sun\"]', '05:31:00', '23:31:00', 1, 52, 'Dinner', 0, '30 Minutes', '0255545454', '300.00', 'services/4LJbaUHoaC6vyxd2WPzsyBRkxmgaYXUz1nzyCZB9.jpg', 0, '2025-12-17 07:31:26', '2025-12-17 07:31:26'),
(47, 13, 'Chicken Paratha Roll', NULL, 'Chicken Paratha Roll', 'Karachi', 'Clifton', 'Mon, Tue, Wed, Thu, Fri, Sat, Sun', '[\"Mon\", \"Tue\", \"Wed\", \"Thu\", \"Fri\", \"Sat\", \"Sun\"]', '13:46:00', '19:46:00', 1, 44, 'Lunch', 0, '20 Minute', '03242232564', '600.00', 'services/N7wZp6irRBW6Ln7QLbCJfJthArn7dCLyM4mPxDOS.jpg', 0, '2026-01-24 07:48:05', '2026-01-24 07:48:05'),
(48, 13, 'Cold Coffee', NULL, 'Cold COfee', 'KARACHI', 'Garden', 'Mon, Tue, Wed, Thu, Fri, Sat, Sun', '[\"Mon\", \"Tue\", \"Wed\", \"Thu\", \"Fri\", \"Sat\", \"Sun\"]', NULL, NULL, 1, 44, 'Dinner', 0, '1 hour', '0323323234', '444.00', 'services/LYuCoATMQz4eIu6hHBurNVglTxITVONCxODBAUsh.jpg', 0, '2026-01-24 07:56:30', '2026-01-24 07:56:30'),
(49, 21, 'Chicken Biryani', NULL, 'Chicken Biryani', 'karachi', 'clifton', 'Mon, Tue, Wed, Thu, Fri, Sat', '[\"Mon\", \"Tue\", \"Wed\", \"Thu\", \"Fri\", \"Sat\"]', NULL, NULL, 1, 55, 'Breakfast', 0, '1 hour', '03161126455', '55556.00', 'services/8mXYITOqiJIbucXL01HLJVGdAN48oxTGJP4UOges.jpg', 0, '2026-04-13 10:20:28', '2026-04-13 10:20:28');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Ew4yhQFVshj5XPl2IsHfeYasg7WqkYuMGeqIvStI', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoidkUyWk1RamJicndnYkx3RFJsYVdOTUtYeDNBcElZUEkwU21uNlEzdiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zZWxsZXIvb3JkZXIvMjgvaGFuZGxlIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MztzOjUzOiJsb2dpbl9zZWxsZXJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxMzt9', 1742142245),
('GZX7c6w3sgWo94kXuWkjnIMRQE5X59ZYB5zrxJ6G', 13, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36 Edg/132.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSzdHcjFJdThlQkl3NmZkb0dQc1gzcGpxbE12dXhDcHpwdzJEaE1LViI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vcmRlci90cmFjay8zMyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjEzO3M6NTM6ImxvZ2luX3NlbGxlcl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE0O30=', 1738044974);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `sellerType` tinyint NOT NULL DEFAULT '2' COMMENT '1 for admin, 2 for buyer, 3 for seller',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Mobile number of the user',
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Primary address line',
  `address2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Secondary address line (optional)',
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'City of residence',
  `state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'State of residence',
  `zip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Postal code',
  `pickup_time` enum('morning','afternoon','evening') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Preferred pickup time',
  `is_verified` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Indicates if the user has verified their email',
  `otp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'OTP for email verification',
  `is_suspended` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Indicates if the user has been suspended by admin',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `suspended_at` timestamp NULL DEFAULT NULL,
  `suspension_reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suspended_by` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `sellerType`, `name`, `email`, `email_verified_at`, `password`, `mobile`, `address`, `address2`, `city`, `state`, `zip`, `pickup_time`, `is_verified`, `otp`, `is_suspended`, `remember_token`, `created_at`, `updated_at`, `suspended_at`, `suspension_reason`, `suspended_by`) VALUES
(1, 1, 'Admin User', 'admin@tiffintime.com', '2025-04-07 05:45:31', '$2y$12$Ti5oedxU2.T9vcu8czwqw.NQxxRDH9ZNN/8JOWRvfyYD2NsWU6MFG', '385.933.1262', '7059 Josiah Common Apt. 521', 'Apt. 267', 'Vernontown', 'Hawaii', '24273-4282', 'morning', 1, NULL, 0, NULL, '2025-04-07 05:45:31', '2025-04-07 05:45:31', NULL, NULL, NULL),
(2, 2, 'Ms. Carolanne Oberbrunner Jr.', 'rico.mcclure@example.org', '2025-04-07 05:45:31', '$2y$12$7Ogt.8Aqm3P47ipqasUGCeMQhPF9yuA1GWgGde1eKcv96gKbwxFSK', '+1-407-368-3719', '63885 Dooley Roads', 'Suite 153', 'Averychester', 'Connecticut', '75327-3701', 'evening', 1, '455208', 0, NULL, '2025-04-07 05:45:31', '2025-04-07 05:45:31', NULL, NULL, NULL),
(3, 2, 'Tianna Medhurst PhD', 'goldner.delphine@example.net', '2025-04-07 05:45:31', '$2y$12$ehkHdRbBdoj7aQWHElad0u1o..Qvd4YyTLBb2dXbA2BV/aRv9m.4u', '941-874-3932', '7846 Koelpin Loaf Suite 264', 'Suite 326', 'South Opal', 'Wisconsin', '75364-5222', 'afternoon', 1, '727581', 0, NULL, '2025-04-07 05:45:31', '2025-04-07 05:45:31', NULL, NULL, NULL),
(4, 2, 'Donavon King', 'stracke.gracie@example.net', '2025-04-07 05:45:31', '$2y$12$Xf2KdWiukfUQ3d6SIN9vmOlRWr38sMmAQF6LgENAnuk9eBvM5rBNu', '(929) 504-5184', '7774 Salvatore Circle Apt. 991', 'Suite 686', 'Lednerbury', 'Nevada', '29125', 'morning', 1, '992787', 0, NULL, '2025-04-07 05:45:31', '2025-04-07 05:45:31', NULL, NULL, NULL),
(5, 2, 'Silas Heidenreich', 'vryan@example.com', '2025-04-07 05:45:31', '$2y$12$WBdSCOGZhi7A.d/P7CXZRuS7I3d6mWptZ5m6Sfl/TaKO1W/AtIGl2', '774-436-4939', '86837 Alberto Wells Suite 580', 'Apt. 451', 'Londonfort', 'Alaska', '44580', 'morning', 1, '122838', 0, NULL, '2025-04-07 05:45:32', '2025-04-07 05:45:32', NULL, NULL, NULL),
(6, 2, 'Xander Hodkiewicz', 'gardner37@example.org', '2025-04-07 05:45:32', '$2y$12$TUEg8Cr79F4SQ3iLXrYku.ZPX/aFz/UjdwK9dYC54vvG3oowzex8u', '620-709-2351', '714 Myrl Hollow Apt. 564', 'Suite 970', 'North Antonetta', 'Washington', '84044-8159', 'evening', 0, '957174', 0, NULL, '2025-04-07 05:45:32', '2025-04-07 05:45:32', NULL, NULL, NULL),
(7, 2, 'Ms. Taya Reynolds', 'charity.braun@example.com', '2025-04-07 05:45:32', '$2y$12$rtJoTHgZGUECoXnWnqDmVus4aQvc1kiCK7rMyjGokgWfzkEGYkDqa', '+1-339-501-3319', '70318 Felicia Pike', 'Suite 567', 'South Stacy', 'Minnesota', '30571-1405', 'evening', 0, '418576', 0, NULL, '2025-04-07 05:45:32', '2025-04-07 05:45:32', NULL, NULL, NULL),
(8, 2, 'Raegan Nicolas', 'murray.irma@example.org', '2025-04-07 05:45:32', '$2y$12$4tH9r7EWf0VTdCD3LoygTOLVJ4ILz7AGdo/htoX8333OoO.rSwAd2', '+1.661.306.4373', '26858 Hunter Trafficway', 'Apt. 665', 'North Jammie', 'Wisconsin', '78313-8107', 'afternoon', 1, '366494', 0, NULL, '2025-04-07 05:45:32', '2025-04-07 05:45:32', NULL, NULL, NULL),
(9, 2, 'Selena Schmidt DVM', 'emclaughlin@example.com', '2025-04-07 05:45:32', '$2y$12$PPTqVi71zzcmc2cbgF1z3eo.kzMvPRSeFfGBTJ5OwASdt2hshCe0y', '+14843521748', '93063 Keira Port Suite 096', 'Suite 427', 'Ulicesside', 'Colorado', '09105', 'evening', 0, '257173', 0, NULL, '2025-04-07 05:45:32', '2025-04-07 05:45:32', NULL, NULL, NULL),
(10, 2, 'Mr. Estevan Bailey Sr.', 'erice@example.net', '2025-04-07 05:45:32', '$2y$12$dghqbz1IrkOEDkL/o8moeeLZqIX/ASJzV0SXsx.DxSs1TbmxrABLW', '1-971-721-0605', '851 Terence Island', 'Apt. 647', 'South Jules', 'Mississippi', '41456-5185', 'evening', 0, '816999', 0, NULL, '2025-04-07 05:45:32', '2025-04-07 05:45:32', NULL, NULL, NULL),
(11, 2, 'Delilah Jerde', 'daugherty.giovanni@example.org', '2025-04-07 05:45:32', '$2y$12$3xq3pATBY7UkVcpqn1BDNuGybdNlAZBv/OiYbaJjHb2yzFFpM/j7K', '1-347-631-4707', '68010 Dibbert Squares Apt. 958', 'Suite 649', 'South Ansleyside', 'Kentucky', '33361-3241', 'afternoon', 1, '772286', 0, NULL, '2025-04-07 05:45:33', '2025-04-07 05:45:33', NULL, NULL, NULL),
(12, 3, 'Schowalter-Gaylord', 'mmueller@jast.com', '2025-04-07 05:45:33', '$2y$12$BzTYYnNWmyDRSD.G.6Q/sOJFRKc5uTfjWHCc7TLAwY.Ao9ZpEVfTu', '(929) 291-5663', '43933 Littel Isle Suite 839', 'Suite 687', 'Selmerburgh', 'Pennsylvania', '97743-2874', NULL, 1, NULL, 0, NULL, '2025-04-07 05:45:33', '2025-04-07 05:45:33', NULL, NULL, NULL),
(13, 3, 'Trantow, Willms and Jacobson', 'jacobi.ocie@leffler.com', '2025-04-07 05:45:33', '$2y$12$7qN.AKWjNSEVR87hcgDhd.pXkesYX9K3/Ak7S4piDAWuMZnM99Iym', '+17206259171', '18001 Reichel Stream', 'Suite 293', 'Kesslerton', 'Washington', '79654-0718', NULL, 1, NULL, 0, NULL, '2025-04-07 05:45:33', '2025-04-07 05:45:33', NULL, NULL, NULL),
(14, 3, 'Gaylord Ltd', 'deonte36@bergstrom.com', '2025-04-07 05:45:33', '$2y$12$xApcmBhyyUYRYmQJ1BRvB.faaIFuu3XGmY4s1L9CUmko.rgkjsDh2', '(682) 523-4543', '6886 Elmira Village Suite 894', 'Apt. 149', 'Camrenland', 'Illinois', '09372-1290', NULL, 1, NULL, 0, NULL, '2025-04-07 05:45:33', '2025-04-07 05:45:33', NULL, NULL, NULL),
(15, 3, 'Zieme, Borer and King', 'perry60@halvorson.com', '2025-04-07 05:45:33', '$2y$12$racpB0H5iGMyup8V8DDgIuV9jXIVt3wB2tYS9Yyzjj3DmE/fRG8Qu', '+1 (732) 894-5768', '1902 Bauch Shoals Apt. 115', 'Apt. 088', 'McLaughlinmouth', 'New Jersey', '76722-6604', NULL, 1, NULL, 0, NULL, '2025-04-07 05:45:33', '2025-04-07 05:45:33', NULL, NULL, NULL),
(16, 3, 'Paucek and Sons', 'ethyl.crist@botsford.com', '2025-04-07 05:45:33', '$2y$12$Yw7sBfvwET/gwbwIeoEaiu2ZgoTM/RMTdGtoxNZgQLwLtqS8/qGsK', '+1.424.705.5321', '4502 Waters Park', 'Suite 572', 'East Marguerite', 'Illinois', '13413', NULL, 1, NULL, 0, NULL, '2025-04-07 05:45:34', '2025-04-07 05:45:34', NULL, NULL, NULL),
(34, 2, 'Umair Solangi', 'bscs2112203@szabist.pk', NULL, '$2y$12$ww9J3vXsrzq/1Wn5EYSC1OUfCCflrjcH6ibPLiSjHc80tQupKkIBa', '03161126421', 'House NO 310 Street NO 1', 'House NO 310 Street NO 17 Sector 4 Block B New Saeedabad Baldia Town Karachi', 'Karachi', 'Sindh', '757603', 'afternoon', 1, NULL, 0, NULL, '2025-12-17 07:27:57', '2025-12-17 07:28:36', NULL, NULL, NULL),
(35, 2, 'Hamza Jawed', 'hamzajawed@gmail.com', NULL, '$2y$12$od8Gru/Cxrnk9j0r.GWWDO2Tr1Cevok3tMGt..IN1nFoQ55.G2BYq', '03161125445', 'karachi pakistan 123', NULL, 'Karachi', 'Sindh', '757603', 'afternoon', 0, '751116', 0, NULL, '2026-01-24 07:27:53', '2026-01-24 07:27:53', NULL, NULL, NULL),
(36, 2, 'Hamza Jawed', 'solangiumair35@gmail.com', NULL, '$2y$12$cHSfFZHxJ.oF6i1nklzA5OTXxHXrYhRrLsusRQ3kuU92yS7TSdGK.', '03161125445', 'karachi pakistan 123', NULL, 'Karachi', 'Sindh', '757603', 'afternoon', 1, NULL, 0, NULL, '2026-01-24 07:28:46', '2026-01-24 07:29:40', NULL, NULL, NULL),
(37, 2, 'Umair Umair', 'solangitv@gmail.com', NULL, '$2y$12$TQLii/5WuW2NLSOoitbLDeczoLy8Ny3DxwqlQ7qiNtVFbvjkUwbjm', '03161126421', 'House NO 310 Street', NULL, 'Karachi', 'Sindh', '757603', 'morning', 1, NULL, 0, NULL, '2026-04-13 10:15:08', '2026-04-13 10:15:58', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_profile_updates`
--

CREATE TABLE `user_profile_updates` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `profile_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_profile_updates`
--

INSERT INTO `user_profile_updates` (`id`, `user_id`, `profile_image`, `created_at`, `updated_at`) VALUES
(2, 4, 'profile_images/wtGfaABlj50WxV8Thl32BshGT9cV1JdbkWEQnDwu.jpg', '2025-01-01 11:58:28', '2025-01-01 11:58:28'),
(4, 16, 'profile_images/jh3PPO2Q0Zqw5y1DjX3twh4fqZH2UdsnQJGADKNo.png', '2025-01-27 06:13:26', '2025-01-27 06:20:52'),
(5, 13, 'profile_images/JpetreZzYWlCJPgW2LkmWCyPXY38j63mlTS9oHGu.png', '2025-01-27 08:45:17', '2025-01-27 08:45:17'),
(6, 30, 'profile_images/profile_30_1762157383.jpg', '2025-11-03 03:09:22', '2025-11-03 03:09:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `favorites_user_id_service_id_unique` (`user_id`,`service_id`),
  ADD KEY `favorites_service_id_foreign` (`service_id`);

--
-- Indexes for table `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `favourites_user_id_service_id_unique` (`user_id`,`service_id`),
  ADD KEY `favourites_service_id_foreign` (`service_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feedback_order_id_foreign` (`order_id`),
  ADD KEY `feedback_user_id_foreign` (`user_id`),
  ADD KEY `feedback_seller_id_foreign` (`seller_id`);

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
  ADD KEY `messages_order_id_foreign` (`order_id`);

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
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_seller_id_foreign` (`seller_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_service_id_foreign` (`service_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sellers_email_unique` (`email`),
  ADD KEY `sellers_suspended_by_foreign` (`suspended_by`);

--
-- Indexes for table `seller_verifications`
--
ALTER TABLE `seller_verifications`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `seller_verifications_seller_id_unique` (`seller_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_seller_id_foreign` (`seller_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_suspended_by_foreign` (`suspended_by`);

--
-- Indexes for table `user_profile_updates`
--
ALTER TABLE `user_profile_updates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_profile_updates_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `favourites`
--
ALTER TABLE `favourites`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `seller_verifications`
--
ALTER TABLE `seller_verifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `user_profile_updates`
--
ALTER TABLE `user_profile_updates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `favourites`
--
ALTER TABLE `favourites`
  ADD CONSTRAINT `favourites_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favourites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `seller_verifications`
--
ALTER TABLE `seller_verifications`
  ADD CONSTRAINT `seller_verifications_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
