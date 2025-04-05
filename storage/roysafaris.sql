-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2025 at 02:29 PM
-- Server version: 8.0.40
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `roysafaris`
--

-- --------------------------------------------------------

--
-- Table structure for table `accommodations`
--

CREATE TABLE `accommodations` (
  `id` bigint UNSIGNED NOT NULL,
  `hotel_chain_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accommodations_type_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `camping_logistics` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balloon_pickup` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `voucher_copies` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_ccy` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coordinates` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accommodations`
--

INSERT INTO `accommodations` (`id`, `hotel_chain_id`, `name`, `code`, `accommodations_type_id`, `address`, `city`, `country`, `phone`, `email`, `website`, `camping_logistics`, `balloon_pickup`, `voucher_copies`, `pay_to`, `billing_ccy`, `coordinates`, `status`, `created_at`, `updated_at`) VALUES
(1, '1', 'Lodge Road', 'LR', '3', 'Lodge Rd, Arusha, Tanzania', 'Arusha', 'Tanzania', '+255752123345', 'pha@gmail.com', 'http://www.sopalodges.com/', 'yes', 'no', '3', 'hotel', 'EUR', '-3.3657554,36.6972218', 'active', '2025-03-20 06:56:34', '2025-03-20 06:56:34');

-- --------------------------------------------------------

--
-- Table structure for table `accommodation_types`
--

CREATE TABLE `accommodation_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accommodation_types`
--

INSERT INTO `accommodation_types` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Hotel', 'active', NULL, NULL),
(2, 'Camp', 'active', NULL, NULL),
(3, 'Cottages', 'active', NULL, NULL),
(4, 'Safari Lodge', 'active', NULL, NULL),
(5, 'Resort', 'active', NULL, NULL),
(6, 'Guest House', 'active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `age_groups`
--

CREATE TABLE `age_groups` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_age` int DEFAULT NULL,
  `max_age` int DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `age_groups`
--

INSERT INTO `age_groups` (`id`, `name`, `code`, `min_age`, `max_age`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Adult', NULL, 16, NULL, 'Adults (age 16 and above)', 'active', NULL, NULL),
(2, 'Child', NULL, 5, 15, 'Children (age 5-15)', 'active', NULL, NULL),
(3, 'Infant', NULL, NULL, 4, 'Infants (under 5)', 'active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` bigint UNSIGNED NOT NULL,
  `account_for` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Hotel/Hotel Chain',
  `ref_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_accounts`
--

INSERT INTO `bank_accounts` (`id`, `account_for`, `ref_id`, `bank_name`, `bank_no`, `status`, `created_at`, `updated_at`) VALUES
(1, 'hotelchain', '3', 'Azania Bank Limited', '6008761276', 'active', '2025-03-20 11:53:05', '2025-03-20 11:53:05'),
(2, 'carrier', '1', 'I&M Bank Tanzania Limited', '6009876512', 'active', '2025-03-23 13:45:54', '2025-03-23 13:45:54'),
(3, 'service_provider', '1', 'Exim Bank Tanzania Limited', '6009876512', 'active', '2025-03-26 08:38:56', '2025-03-26 08:38:56');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carriers`
--

CREATE TABLE `carriers` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `carrier_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `voucher_copies` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carriers`
--

INSERT INTO `carriers` (`id`, `code`, `name`, `carrier_type`, `email`, `phone`, `website`, `city_id`, `country_id`, `voucher_copies`, `status`, `created_at`, `updated_at`) VALUES
(1, '0001', 'Azam Ferries', 'water', 'azamf@gmail.com', '+255752123345', 'http://www.azamferries.com', '3', '1', '3', 'active', '2025-03-23 13:45:54', '2025-03-23 13:45:54');

-- --------------------------------------------------------

--
-- Table structure for table `channels`
--

CREATE TABLE `channels` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `channels`
--

INSERT INTO `channels` (`id`, `name`, `code`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Online Enquiry', '0001', 'active', '2025-03-27 04:59:51', '2025-03-27 04:59:51'),
(2, 'Direct Email', '0002', 'active', '2025-03-27 04:59:57', '2025-03-27 04:59:57'),
(3, 'Walk in', '0003', 'active', '2025-03-27 05:00:04', '2025-03-27 05:00:04'),
(4, 'Referral', '0004', 'active', '2025-03-27 05:00:15', '2025-03-27 05:00:15'),
(5, 'Repeat Client', '0005', 'active', '2025-03-27 05:00:27', '2025-03-27 05:00:27'),
(6, 'Agent', '0006', 'active', '2025-03-27 05:00:33', '2025-03-27 05:00:33');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint UNSIGNED NOT NULL,
  `country_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `country_id`, `name`, `created_at`, `updated_at`) VALUES
(1, '1', 'Dar es Salaam', '2025-03-20 06:56:34', NULL),
(2, '1', 'Dodoma', '2025-03-20 06:56:34', NULL),
(3, '1', 'Arusha', '2025-03-20 06:56:34', NULL),
(4, '1', 'Mwanza', '2025-03-20 06:56:34', NULL),
(5, '1', 'Tanga', '2025-03-20 06:56:34', NULL),
(6, '1', 'Moshi', '2025-03-20 06:56:34', NULL),
(7, '1', 'Mbeya', '2025-03-20 06:56:34', NULL),
(8, '1', 'Morogoro', '2025-03-20 06:56:34', NULL),
(9, '1', 'Zanzibar City', '2025-03-20 06:56:34', NULL),
(10, '1', 'Kigoma', '2025-03-20 06:56:34', NULL),
(11, '1', 'Tabora', '2025-03-20 06:56:34', NULL),
(12, '1', 'Musoma', '2025-03-20 06:56:34', NULL),
(13, '1', 'Shinyanga', '2025-03-20 06:56:34', NULL),
(14, '1', 'Singida', '2025-03-20 06:56:34', NULL),
(15, '1', 'Iringa', '2025-03-20 06:56:34', NULL),
(16, '1', 'Lindi', '2025-03-20 06:56:34', NULL),
(17, '1', 'Mtwara', '2025-03-20 06:56:34', NULL),
(18, '1', 'Songea', '2025-03-20 06:56:34', NULL),
(19, '1', 'Bukoba', '2025-03-20 06:56:34', NULL),
(20, '1', 'Sumbawanga', '2025-03-20 06:56:34', NULL),
(21, '1', 'Babati', '2025-03-20 06:56:34', NULL),
(22, '1', 'Kahama', '2025-03-20 06:56:34', NULL),
(23, '1', 'Tarime', '2025-03-20 06:56:34', NULL),
(24, '1', 'Chake Chake', '2025-03-20 06:56:34', NULL),
(25, '1', 'Wete', '2025-03-20 06:56:34', NULL),
(26, '1', 'Uvinza', '2025-03-20 06:56:34', NULL),
(27, '1', 'Nzega', '2025-03-20 06:56:34', NULL),
(28, '1', 'Ifakara', '2025-03-20 06:56:34', NULL),
(29, '1', 'Kilwa Masoko', '2025-03-20 06:56:34', NULL),
(30, '1', 'Masasi', '2025-03-20 06:56:34', NULL),
(31, '1', 'Njombe', '2025-03-20 06:56:34', NULL),
(32, '1', 'Geita', '2025-03-20 06:56:34', NULL),
(33, '1', 'Bariadi', '2025-03-20 06:56:34', NULL),
(34, '1', 'Mpanda', '2025-03-20 06:56:34', NULL),
(35, '1', 'Vwawa', '2025-03-20 06:56:34', NULL),
(36, '1', 'Kibaha', '2025-03-20 06:56:34', NULL),
(37, '1', 'Bagamoyo', '2025-03-20 06:56:34', NULL),
(38, '1', 'Karatu', '2025-03-20 06:56:34', NULL),
(39, '2', 'Nairobi', '2025-03-20 06:56:34', NULL),
(40, '2', 'Mombasa', '2025-03-20 06:56:34', NULL),
(41, '2', 'Kisumu', '2025-03-20 06:56:34', NULL),
(42, '2', 'Nakuru', '2025-03-20 06:56:34', NULL),
(43, '2', 'Eldoret', '2025-03-20 06:56:34', NULL),
(44, '2', 'Malindi', '2025-03-20 06:56:34', NULL),
(45, '2', 'Thika', '2025-03-20 06:56:34', NULL),
(46, '2', 'Kitale', '2025-03-20 06:56:34', NULL),
(47, '2', 'Garissa', '2025-03-20 06:56:34', NULL),
(48, '2', 'Nyeri', '2025-03-20 06:56:34', NULL),
(49, '2', 'Machakos', '2025-03-20 06:56:34', NULL),
(50, '2', 'Meru', '2025-03-20 06:56:34', NULL),
(51, '2', 'Embu', '2025-03-20 06:56:34', NULL),
(52, '2', 'Kericho', '2025-03-20 06:56:34', NULL),
(53, '2', 'Kakamega', '2025-03-20 06:56:34', NULL),
(54, '2', 'Nanyuki', '2025-03-20 06:56:34', NULL),
(55, '2', 'Narok', '2025-03-20 06:56:34', NULL),
(56, '2', 'Kiambu', '2025-03-20 06:56:34', NULL),
(57, '2', 'Bungoma', '2025-03-20 06:56:34', NULL),
(58, '2', 'Naivasha', '2025-03-20 06:56:34', NULL),
(59, '2', 'Kisii', '2025-03-20 06:56:34', NULL),
(60, '2', 'Lamu', '2025-03-20 06:56:34', NULL),
(61, '2', 'Wajir', '2025-03-20 06:56:34', NULL),
(62, '2', 'Lodwar', '2025-03-20 06:56:34', NULL),
(63, '2', 'Homa Bay', '2025-03-20 06:56:34', NULL),
(64, '2', 'Migori', '2025-03-20 06:56:34', NULL),
(65, '2', 'Voi', '2025-03-20 06:56:34', NULL),
(66, '2', 'Mandera', '2025-03-20 06:56:34', NULL),
(67, '2', 'Marsabit', '2025-03-20 06:56:34', NULL),
(68, '2', 'Kapenguria', '2025-03-20 06:56:34', NULL),
(69, '2', 'Busia', '2025-03-20 06:56:34', NULL),
(70, '2', 'Chuka', '2025-03-20 06:56:34', NULL),
(71, '2', 'Moyale', '2025-03-20 06:56:34', NULL),
(72, '2', 'Isiolo', '2025-03-20 06:56:34', NULL),
(73, '2', 'Taveta', '2025-03-20 06:56:34', NULL),
(74, '2', 'Mumias', '2025-03-20 06:56:34', NULL),
(75, '2', 'Kilifi', '2025-03-20 06:56:34', NULL),
(76, '2', 'Kwale.', '2025-03-20 06:56:34', NULL),
(77, '3', 'Kampala', '2025-03-20 06:56:34', NULL),
(78, '3', 'Entebbe', '2025-03-20 06:56:34', NULL),
(79, '3', 'Jinja', '2025-03-20 06:56:34', NULL),
(80, '3', 'Mbarara', '2025-03-20 06:56:34', NULL),
(81, '3', 'Gulu', '2025-03-20 06:56:34', NULL),
(82, '3', 'Mbale', '2025-03-20 06:56:34', NULL),
(83, '3', 'Masaka', '2025-03-20 06:56:34', NULL),
(84, '3', 'Fort Portal', '2025-03-20 06:56:34', NULL),
(85, '3', 'Arua', '2025-03-20 06:56:34', NULL),
(86, '3', 'Lira', '2025-03-20 06:56:34', NULL),
(87, '3', 'Hoima', '2025-03-20 06:56:34', NULL),
(88, '3', 'Soroti', '2025-03-20 06:56:34', NULL),
(89, '3', 'Kabale', '2025-03-20 06:56:34', NULL),
(90, '3', 'Tororo', '2025-03-20 06:56:34', NULL),
(91, '3', 'Wakiso', '2025-03-20 06:56:34', NULL),
(92, '3', 'Mukono', '2025-03-20 06:56:34', NULL),
(93, '3', 'Kasese', '2025-03-20 06:56:34', NULL),
(94, '3', 'Moroto', '2025-03-20 06:56:34', NULL),
(95, '3', 'Mubende', '2025-03-20 06:56:34', NULL),
(96, '3', 'Busia', '2025-03-20 06:56:34', NULL),
(97, '3', 'Masindi', '2025-03-20 06:56:34', NULL),
(98, '3', 'Iganga', '2025-03-20 06:56:34', NULL),
(99, '3', 'Kamuli', '2025-03-20 06:56:34', NULL),
(100, '3', 'Ntungamo', '2025-03-20 06:56:34', NULL),
(101, '3', 'Katakwi', '2025-03-20 06:56:34', NULL),
(102, '3', 'Adjumani', '2025-03-20 06:56:34', NULL),
(103, '3', 'Nebbi', '2025-03-20 06:56:34', NULL),
(104, '3', 'Kapchorwa', '2025-03-20 06:56:34', NULL),
(105, '3', 'Kisoro', '2025-03-20 06:56:34', NULL),
(106, '3', 'Bundibugyo', '2025-03-20 06:56:34', NULL),
(107, '3', 'Nakasongola', '2025-03-20 06:56:34', NULL),
(108, '3', 'Rakai', '2025-03-20 06:56:34', NULL),
(109, '3', 'Lugazi', '2025-03-20 06:56:34', NULL),
(110, '3', 'Kyenjojo', '2025-03-20 06:56:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'Tanzania', 'TZ', '2025-03-23 16:04:30', NULL),
(2, 'Kenya', 'KE', '2025-03-23 16:04:30', NULL),
(3, 'Uganda', 'UG', '2025-03-23 16:04:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `base` int DEFAULT NULL,
  `rate` int NOT NULL DEFAULT '1',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `code`, `base`, `rate`, `status`, `created_at`, `updated_at`) VALUES
(1, 'US Dollar', 'USD', NULL, 2540, 'active', '2025-03-28 06:50:23', NULL),
(2, 'Tanzanian Shilling', 'TZS', 1, 1, 'active', '2025-03-28 06:50:26', NULL),
(3, 'Kenyan Shillings', 'KSH', NULL, 20, 'active', '2025-03-28 04:02:31', '2025-03-28 04:02:31');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver_type_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fleet_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `license_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `name`, `driver_type_id`, `fleet_id`, `license_no`, `phone`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Emanuel Bariki', '1', '1', '50007827372', '0752129305', 'ebariki@diamondtrust.co.tz', 'active', '2025-03-03 12:53:41', '2025-03-03 12:53:41');

-- --------------------------------------------------------

--
-- Table structure for table `driver_types`
--

CREATE TABLE `driver_types` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `driver_types`
--

INSERT INTO `driver_types` (`id`, `created_at`, `updated_at`, `name`, `status`) VALUES
(1, '2025-03-03 11:35:11', '2025-03-03 11:35:11', 'Transfer', 'active'),
(2, '2025-03-03 11:38:48', '2025-03-03 11:39:36', 'Standard Safari', 'active'),
(3, '2025-03-03 11:40:01', '2025-03-03 11:40:01', 'Large Groups Safari', 'active'),
(4, '2025-03-03 11:40:10', '2025-03-03 11:40:10', 'VIP Safari', 'active'),
(5, '2025-03-03 11:40:18', '2025-03-03 11:40:18', 'Office', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fee_types`
--

CREATE TABLE `fee_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fee_types`
--

INSERT INTO `fee_types` (`id`, `name`, `code`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Park Fees', NULL, 'Entrance fees for the national parks', 'active', '2025-03-28 06:23:50', NULL),
(2, 'Concession Fees', NULL, 'Fees for special concessions within parks', 'active', '2025-03-28 06:23:50', NULL),
(3, 'Camp Fees', NULL, 'Fees for camping within the parks', 'active', '2025-03-28 06:23:50', NULL),
(4, 'WMA Fees', NULL, 'Wildlife Management Area fees', 'active', '2025-03-28 06:23:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fleets`
--

CREATE TABLE `fleets` (
  `id` bigint UNSIGNED NOT NULL,
  `reg_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fleet_type_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fleet_class_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seats` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fleet_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mileage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `make_model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fleets`
--

INSERT INTO `fleets` (`id`, `reg_no`, `fleet_type_id`, `fleet_class_id`, `seats`, `fleet_status`, `purchase_date`, `mileage`, `status`, `created_at`, `updated_at`, `make_model`) VALUES
(1, 'T407 CFR', '1', '2', '8', NULL, '2025-03-07', '430169', 'active', '2025-03-03 10:13:57', '2025-03-03 10:13:57', 'Toyota Land Cruiser');

-- --------------------------------------------------------

--
-- Table structure for table `fleet_classes`
--

CREATE TABLE `fleet_classes` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fleet_classes`
--

INSERT INTO `fleet_classes` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Luxury', 'active', '2025-03-03 09:19:11', '2025-03-03 09:20:57'),
(2, 'Semi Luxury', 'active', '2025-03-03 09:21:08', '2025-03-03 09:21:08'),
(3, 'Standard', 'active', '2025-03-03 09:21:26', '2025-03-03 09:21:26');

-- --------------------------------------------------------

--
-- Table structure for table `fleet_types`
--

CREATE TABLE `fleet_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fleet_types`
--

INSERT INTO `fleet_types` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Transfer', 'active', '2025-03-03 08:51:24', '2025-03-03 09:06:59'),
(2, 'Safari', 'active', '2025-03-03 08:51:55', '2025-03-23 13:21:41'),
(3, 'Pool', 'active', '2025-03-03 08:52:18', '2025-03-03 08:52:18');

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_chains`
--

CREATE TABLE `hotel_chains` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hotel_chains`
--

INSERT INTO `hotel_chains` (`id`, `name`, `code`, `email`, `phone`, `bank_name`, `bank_no`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Elewana Collection', '0001', 'email@elewana.co.tz', '0765456765', NULL, NULL, 'active', '2025-03-20 04:07:49', '2025-03-20 04:07:49'),
(2, 'Marriot Hotels', '0002', 'marit@email.com', '0765456765', 'Azania Bank Limited', '6008761276', 'active', '2025-03-20 11:43:57', '2025-03-20 11:43:57'),
(3, 'InterContinental Hotels Group', '0003', 'ihg@email.com', '0765456765', 'Azania Bank Limited', '6008761276', 'active', '2025-03-20 11:53:05', '2025-03-20 11:53:05'),
(4, 'Serena Group', '0004', 'serena@email.com', '0752123345', 'Access Bank Tanzania Limited', '6008761276', 'active', '2025-03-23 11:56:12', '2025-03-23 11:56:12');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_02_23_160028_create_fleet_types_table', 2),
(5, '2025_02_26_140451_create_fleet_classes_table', 3),
(6, '2025_02_26_141303_create_fleets_table', 4),
(7, '2025_02_27_080208_create_driver_types_table', 4),
(8, '2025_02_27_193059_create_drivers_table', 4),
(9, '2025_03_01_085454_create_trip_types_table', 4),
(10, '2025_03_01_091414_create_service_items_table', 4),
(11, '2025_03_03_071535_create_trips_table', 4),
(12, '2025_03_03_130530_modify_fleet_table', 5),
(13, '2025_03_03_143416_modify_driver_types_table', 6),
(14, '2025_03_20_064722_create_hotel_chains_table', 7),
(15, '2025_03_20_082316_create_hotels_table', 8),
(16, '2025_03_20_082536_create_accomodations_table', 8),
(17, '2025_03_20_084410_create_accommodation_types_table', 8),
(18, '2025_03_20_143054_create_bank_accounts_table', 9),
(19, '2025_03_23_151950_create_carriers_table', 10),
(20, '2025_03_23_154411_create_cities_table', 10),
(21, '2025_03_23_154420_create_countries_table', 10),
(22, '2025_03_25_081413_create_service_proviers_table', 11),
(23, '2025_03_27_065145_create_mountains_table', 12),
(24, '2025_03_27_071359_create_mountain_routes_table', 13),
(25, '2025_03_27_074236_create_channels_table', 14),
(26, '2025_03_27_114825_create_national_parks_table', 15),
(27, '2025_03_28_060755_create_fee_types_table', 16),
(28, '2025_03_28_060756_create_visitor_categories_table', 16),
(29, '2025_03_28_060757_create_age_groups_table', 16),
(30, '2025_03_28_060758_create_seasons_table', 16),
(31, '2025_03_28_060759_create_currencies_table', 16),
(32, '2025_03_28_060800_create_park_fees_table', 16),
(33, '2025_03_28_060800_create_special_fees_table', 16),
(34, '2025_03_28_060801_create_park_special_fees_table', 16);

-- --------------------------------------------------------

--
-- Table structure for table `mountains`
--

CREATE TABLE `mountains` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mountains`
--

INSERT INTO `mountains` (`id`, `name`, `code`, `country_id`, `city_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Mt. Kilimanjaro', '0001', '1', '6', 'active', '2025-03-27 04:09:29', '2025-03-27 04:09:29'),
(2, 'Mt. Elgon', '0002', '2', '41', 'active', '2025-03-27 04:10:27', '2025-03-27 04:10:27'),
(3, 'Mt. Kenya', '0003', '2', '39', 'active', '2025-03-27 04:11:36', '2025-03-27 04:11:36'),
(4, 'Mt. Meru', '0004', '1', '3', 'active', '2025-03-27 04:11:59', '2025-03-27 04:11:59');

-- --------------------------------------------------------

--
-- Table structure for table `mountain_routes`
--

CREATE TABLE `mountain_routes` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mountain_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_days` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_days` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mountain_routes`
--

INSERT INTO `mountain_routes` (`id`, `name`, `code`, `description`, `mountain_id`, `min_days`, `max_days`, `status`, `created_at`, `updated_at`) VALUES
(1, 'machame', '0001', 'Machame Route', '1', '6', '8', 'active', '2025-03-27 04:29:57', '2025-03-27 04:29:57');

-- --------------------------------------------------------

--
-- Table structure for table `national_parks`
--

CREATE TABLE `national_parks` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `regulator` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `google_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coordinates` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `national_parks`
--

INSERT INTO `national_parks` (`id`, `name`, `code`, `regulator`, `google_name`, `coordinates`, `country_id`, `city_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Lake Manyara National Park', '0001', 'TANAPA', 'Lake Manyara National Park, Tanzania', '-3.6077859,35.7575588', '1', '3', 'active', '2025-03-27 11:21:32', '2025-03-27 11:21:32'),
(2, 'Arusha National Park', '0002', 'TANAPA', 'Arusha National Park, Tanzania', '-3.261975099999999,36.84514240000001', '1', '3', 'active', '2025-03-27 11:22:13', '2025-03-27 11:22:13'),
(3, 'Gombe National Park', '0003', 'TANAPA', 'Gombe National Park, Mwamgongo, Tanzania', '-4.6983429,29.6446088', '1', '10', 'active', '2025-03-27 11:22:37', '2025-03-27 11:22:37');

-- --------------------------------------------------------

--
-- Table structure for table `park_fees`
--

CREATE TABLE `park_fees` (
  `id` bigint UNSIGNED NOT NULL,
  `national_park_id` bigint UNSIGNED NOT NULL,
  `fee_type_id` bigint UNSIGNED NOT NULL,
  `visitor_category_id` bigint UNSIGNED NOT NULL,
  `age_group_id` bigint UNSIGNED NOT NULL,
  `season_id` bigint UNSIGNED NOT NULL,
  `currency_id` bigint UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `vat_rate` decimal(5,2) NOT NULL DEFAULT '18.00',
  `is_vat_inclusive` tinyint(1) NOT NULL DEFAULT '0',
  `effective_date` date DEFAULT NULL,
  `is_one_time_fee` int DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `park_fees`
--

INSERT INTO `park_fees` (`id`, `national_park_id`, `fee_type_id`, `visitor_category_id`, `age_group_id`, `season_id`, `currency_id`, `amount`, `notes`, `vat_rate`, `is_vat_inclusive`, `effective_date`, `is_one_time_fee`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, 2, 30000.00, NULL, 18.00, 0, '2025-03-28', NULL, 'active', '2025-03-28 06:33:24', NULL),
(2, 2, 2, 2, 2, 1, 1, 41.00, NULL, 18.00, 1, '2025-03-28', 1, 'active', '2025-03-28 08:27:07', '2025-03-28 08:27:07'),
(3, 3, 2, 1, 2, 1, 1, 60.00, NULL, 18.00, 1, '2025-03-26', 1, 'active', '2025-03-28 08:33:45', '2025-03-28 08:33:45'),
(4, 3, 3, 2, 2, 1, 1, 10.00, NULL, 18.00, 1, '2025-03-26', NULL, 'active', '2025-03-28 08:33:45', '2025-03-28 08:33:45');

-- --------------------------------------------------------

--
-- Table structure for table `park_special_fees`
--

CREATE TABLE `park_special_fees` (
  `park_id` bigint UNSIGNED NOT NULL,
  `special_fee_id` bigint UNSIGNED NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seasons`
--

CREATE TABLE `seasons` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seasons`
--

INSERT INTO `seasons` (`id`, `name`, `code`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'High Season', NULL, 'Peak tourist season with higher fees', 'active', NULL, NULL),
(2, 'Low Season', NULL, 'Off-peak season with potentially lower fees', 'active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service_items`
--

CREATE TABLE `service_items` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_items`
--

INSERT INTO `service_items` (`id`, `name`, `category`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Lunch Box', 'food', 'active', '2025-03-04 04:04:37', '2025-03-04 04:04:37'),
(2, 'Water', 'food', 'active', '2025-03-04 04:04:55', '2025-03-04 04:04:55'),
(3, 'Pickup Board', 'essentials', 'active', '2025-03-04 04:05:30', '2025-03-04 04:05:30');

-- --------------------------------------------------------

--
-- Table structure for table `service_providers`
--

CREATE TABLE `service_providers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_company_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Agent,Baloon Company etc',
  `voucher_copies` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '3',
  `bill_to` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'service_provider',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_providers`
--

INSERT INTO `service_providers` (`id`, `name`, `code`, `parent_company_id`, `phone`, `email`, `website`, `address`, `city_id`, `country_id`, `type`, `voucher_copies`, `bill_to`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Kibo Mountain', '0001', NULL, '+255752123345', 'kibomountain@email.com', 'https://www.google.com', 'Dar Posta, India St', '12', '1', 'mountain', '3', 'service_provider', 'active', '2025-03-26 08:38:56', '2025-03-26 08:38:56');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('MdtH6KTS7WN8c8vUqwfPnsCCz5COw5fVOYhTLeg5', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZWtnN0NBaG5vblFwTENhRzNyOGMzYlA5NGxtdUZVRlh3OFpxVjlYdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTA6Imh0dHA6Ly9sb2NhbGhvc3Qvcm95c2FmYXJpcy9wdWJsaWMvbW91bnRhaW4tcm91dGVzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1743330587);

-- --------------------------------------------------------

--
-- Table structure for table `special_fees`
--

CREATE TABLE `special_fees` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `visitor_category_id` bigint UNSIGNED DEFAULT NULL,
  `age_group_id` bigint UNSIGNED DEFAULT NULL,
  `currency_id` bigint UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `vat_rate` decimal(5,2) NOT NULL DEFAULT '18.00',
  `is_vat_inclusive` tinyint(1) NOT NULL DEFAULT '0',
  `is_one_time_fee` tinyint(1) NOT NULL DEFAULT '0',
  `effective_date` date DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `special_fees`
--

INSERT INTO `special_fees` (`id`, `name`, `location`, `description`, `visitor_category_id`, `age_group_id`, `currency_id`, `amount`, `vat_rate`, `is_vat_inclusive`, `is_one_time_fee`, `effective_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 'WMA Entry + Wildlife Conservation', 'Tarangire/Lake Manyara area', 'Combined WMA fees for Tarangire/Lake Manyara area', 3, 1, 2, 7000.00, 18.00, 0, 0, '2025-03-28', 'active', NULL, NULL),
(2, 'WMA Entry + Wildlife Conservation', 'Tarangire/Lake Manyara area', 'Combined WMA fees for Tarangire/Lake Manyara area', 1, 1, 1, 25.00, 18.00, 0, 0, '2025-03-28', 'active', NULL, NULL),
(3, 'WMA Entry + Wildlife Conservation', 'Tarangire/Lake Manyara area', 'Combined WMA fees for Tarangire/Lake Manyara area', 2, 1, 1, 25.00, 18.00, 0, 0, '2025-03-28', 'active', NULL, NULL),
(4, 'WMA Entry + Wildlife Conservation', 'Tarangire/Lake Manyara area', 'Combined WMA fees for Tarangire/Lake Manyara area', 6, 2, 2, 6000.00, 18.00, 0, 0, '2025-03-28', 'active', NULL, NULL),
(5, 'WMA Entry + Wildlife Conservation', 'Tarangire/Lake Manyara area', 'Combined WMA fees for Tarangire/Lake Manyara area', 4, 2, 1, 20.00, 18.00, 0, 0, '2025-03-28', 'active', NULL, NULL),
(6, 'WMA Entry + Wildlife Conservation', 'Tarangire/Lake Manyara area', 'Combined WMA fees for Tarangire/Lake Manyara area', 5, 2, 1, 20.00, 18.00, 0, 0, '2025-03-28', 'active', NULL, NULL),
(7, 'Lake Natron Entry', 'Lake Natron', 'One-time entry fee for Lake Natron', NULL, NULL, 1, 55.00, 18.00, 0, 1, '2025-03-28', 'active', NULL, NULL),
(8, 'Vehicle Fee', 'Lake Natron', 'Vehicle fee for Lake Natron', NULL, NULL, 2, 2000.00, 18.00, 0, 1, '2025-03-28', 'active', NULL, NULL),
(9, 'Ngorongoro District Council Fee', 'Ngorongoro', 'District council fee per adult', NULL, 1, 1, 15.00, 18.00, 0, 0, '2025-03-28', 'active', NULL, NULL),
(10, 'Longido & Monduli District Fee', 'Longido & Monduli', 'District fee per adult', NULL, 1, 1, 10.00, 18.00, 0, 0, '2025-03-28', 'active', NULL, NULL),
(11, 'Engaresero Eramatare CBO Fee', 'Lake Natron', 'Covers all guiding activities in Lake Natron', NULL, NULL, 1, 20.00, 18.00, 0, 0, '2025-03-28', 'active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE `trips` (
  `id` bigint UNSIGNED NOT NULL,
  `trip_type_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fleet_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_passengers` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trip_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trip_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trip_types`
--

CREATE TABLE `trip_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trip_types`
--

INSERT INTO `trip_types` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Transfer', 'active', '2025-03-04 03:50:35', '2025-03-04 03:52:31'),
(2, 'Safari', 'active', '2025-03-04 03:50:44', '2025-03-04 03:50:44'),
(3, 'Office', 'active', '2025-03-04 03:50:56', '2025-03-04 03:50:56'),
(4, 'Mountain', 'active', '2025-03-22 07:20:57', '2025-03-22 07:20:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Emanuel Bariki', 'test@example.com', '2025-02-22 04:53:40', '$2y$12$Q1OeVqYIfnQus758hsHN0u2BEdwj1iK0urmK7Pc3U6eBrKDknP6I6', 'xjhzqFzVJc', '2025-02-22 04:53:41', '2025-02-22 04:53:41');

-- --------------------------------------------------------

--
-- Table structure for table `visitor_categories`
--

CREATE TABLE `visitor_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visitor_categories`
--

INSERT INTO `visitor_categories` (`id`, `name`, `code`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Non Citizen Adult', 'NCAD', 'Foreign adult visitors (NCAD)', 'active', NULL, NULL),
(2, 'Non Citizen Resident Adult', 'NCRESAD', 'Expatriate adult residents (NCRESAD)', 'active', NULL, NULL),
(3, 'Tanzania Citizen Adult', 'TZCAD', 'Tanzanian adult citizens (TZCAD)', 'active', NULL, NULL),
(4, 'Non Citizen Child', 'NCC', 'Foreign child visitors (NCC)', 'active', NULL, NULL),
(5, 'Non Citizen Resident Child', 'NCRESC', 'Expatriate child residents (NCRESC)', 'active', NULL, NULL),
(6, 'Tanzania Citizen Child', 'TZCC', 'Tanzanian child citizens (TZCC)', 'active', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accommodations`
--
ALTER TABLE `accommodations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accommodation_types`
--
ALTER TABLE `accommodation_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `age_groups`
--
ALTER TABLE `age_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `carriers`
--
ALTER TABLE `carriers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `channels`
--
ALTER TABLE `channels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driver_types`
--
ALTER TABLE `driver_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fee_types`
--
ALTER TABLE `fee_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fleets`
--
ALTER TABLE `fleets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fleet_classes`
--
ALTER TABLE `fleet_classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fleet_types`
--
ALTER TABLE `fleet_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel_chains`
--
ALTER TABLE `hotel_chains`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mountains`
--
ALTER TABLE `mountains`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mountain_routes`
--
ALTER TABLE `mountain_routes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `national_parks`
--
ALTER TABLE `national_parks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `park_fees`
--
ALTER TABLE `park_fees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `park_fees_national_park_id_foreign` (`national_park_id`),
  ADD KEY `park_fees_fee_type_id_foreign` (`fee_type_id`),
  ADD KEY `park_fees_visitor_category_id_foreign` (`visitor_category_id`),
  ADD KEY `park_fees_age_group_id_foreign` (`age_group_id`),
  ADD KEY `park_fees_season_id_foreign` (`season_id`),
  ADD KEY `park_fees_currency_id_foreign` (`currency_id`);

--
-- Indexes for table `park_special_fees`
--
ALTER TABLE `park_special_fees`
  ADD PRIMARY KEY (`park_id`,`special_fee_id`),
  ADD KEY `park_special_fees_special_fee_id_foreign` (`special_fee_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `seasons`
--
ALTER TABLE `seasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_items`
--
ALTER TABLE `service_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_providers`
--
ALTER TABLE `service_providers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `special_fees`
--
ALTER TABLE `special_fees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `special_fees_visitor_category_id_foreign` (`visitor_category_id`),
  ADD KEY `special_fees_age_group_id_foreign` (`age_group_id`),
  ADD KEY `special_fees_currency_id_foreign` (`currency_id`);

--
-- Indexes for table `trips`
--
ALTER TABLE `trips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trip_types`
--
ALTER TABLE `trip_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `visitor_categories`
--
ALTER TABLE `visitor_categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accommodations`
--
ALTER TABLE `accommodations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `accommodation_types`
--
ALTER TABLE `accommodation_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `age_groups`
--
ALTER TABLE `age_groups`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `carriers`
--
ALTER TABLE `carriers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `channels`
--
ALTER TABLE `channels`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `driver_types`
--
ALTER TABLE `driver_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fee_types`
--
ALTER TABLE `fee_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fleets`
--
ALTER TABLE `fleets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fleet_classes`
--
ALTER TABLE `fleet_classes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fleet_types`
--
ALTER TABLE `fleet_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotel_chains`
--
ALTER TABLE `hotel_chains`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `mountains`
--
ALTER TABLE `mountains`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mountain_routes`
--
ALTER TABLE `mountain_routes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `national_parks`
--
ALTER TABLE `national_parks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `park_fees`
--
ALTER TABLE `park_fees`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `seasons`
--
ALTER TABLE `seasons`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `service_items`
--
ALTER TABLE `service_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `service_providers`
--
ALTER TABLE `service_providers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `special_fees`
--
ALTER TABLE `special_fees`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `trips`
--
ALTER TABLE `trips`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trip_types`
--
ALTER TABLE `trip_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `visitor_categories`
--
ALTER TABLE `visitor_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `park_fees`
--
ALTER TABLE `park_fees`
  ADD CONSTRAINT `park_fees_age_group_id_foreign` FOREIGN KEY (`age_group_id`) REFERENCES `age_groups` (`id`),
  ADD CONSTRAINT `park_fees_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`),
  ADD CONSTRAINT `park_fees_fee_type_id_foreign` FOREIGN KEY (`fee_type_id`) REFERENCES `fee_types` (`id`),
  ADD CONSTRAINT `park_fees_national_park_id_foreign` FOREIGN KEY (`national_park_id`) REFERENCES `national_parks` (`id`),
  ADD CONSTRAINT `park_fees_season_id_foreign` FOREIGN KEY (`season_id`) REFERENCES `seasons` (`id`),
  ADD CONSTRAINT `park_fees_visitor_category_id_foreign` FOREIGN KEY (`visitor_category_id`) REFERENCES `visitor_categories` (`id`);

--
-- Constraints for table `park_special_fees`
--
ALTER TABLE `park_special_fees`
  ADD CONSTRAINT `park_special_fees_park_id_foreign` FOREIGN KEY (`park_id`) REFERENCES `national_parks` (`id`),
  ADD CONSTRAINT `park_special_fees_special_fee_id_foreign` FOREIGN KEY (`special_fee_id`) REFERENCES `special_fees` (`id`);

--
-- Constraints for table `special_fees`
--
ALTER TABLE `special_fees`
  ADD CONSTRAINT `special_fees_age_group_id_foreign` FOREIGN KEY (`age_group_id`) REFERENCES `age_groups` (`id`),
  ADD CONSTRAINT `special_fees_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`),
  ADD CONSTRAINT `special_fees_visitor_category_id_foreign` FOREIGN KEY (`visitor_category_id`) REFERENCES `visitor_categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
