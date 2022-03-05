-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2022 at 04:16 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acc_powertools_trading`
--

-- --------------------------------------------------------

--
-- Table structure for table `accesses`
--

CREATE TABLE `accesses` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accesses`
--

INSERT INTO `accesses` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Office', NULL, NULL),
(2, 'Store', NULL, NULL),
(3, 'Warehouse', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `supplier_id`, `created_at`, `updated_at`) VALUES
(1, 'Ingco', 1, NULL, NULL),
(2, 'AEG', 2, NULL, NULL),
(3, 'Powercraft', 2, NULL, NULL),
(4, 'Contender', 2, NULL, NULL),
(5, 'Toptul', 2, NULL, NULL),
(6, 'Decakila', 1, '2021-11-20 06:10:12', '2021-11-20 06:10:12');

-- --------------------------------------------------------

--
-- Table structure for table `brand_colors`
--

CREATE TABLE `brand_colors` (
  `id` int(10) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `brand_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brand_colors`
--

INSERT INTO `brand_colors` (`id`, `brand_id`, `brand_color`, `text_color`, `created_at`, `updated_at`) VALUES
(1, 1, 'yellow', 'white', NULL, '2021-12-06 05:53:08'),
(2, 2, 'blue', 'white', NULL, '2021-12-06 05:53:17'),
(3, 3, 'pink', 'white', NULL, '2021-12-06 05:53:25'),
(4, 4, 'green', 'white', NULL, '2021-12-06 05:53:33'),
(5, 5, 'yellow-pink', 'white', NULL, '2021-12-06 05:53:41'),
(6, 6, 'lavander', 'white', NULL, '2021-12-06 05:54:12');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Power Tools', NULL, NULL),
(2, 'Hand Tools', NULL, NULL),
(3, 'Lighting', '2021-12-01 05:09:11', '2021-12-01 05:09:11');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'yellow', NULL, NULL),
(2, 'blue', NULL, NULL),
(3, 'pink', NULL, NULL),
(4, 'green', NULL, NULL),
(5, 'yellow-pink', NULL, NULL),
(6, 'lavander', NULL, NULL),
(7, 'violet-pink', NULL, NULL),
(8, 'orange-yellow', NULL, NULL),
(9, 'crimson-violet', NULL, NULL),
(10, 'torquis-violet', NULL, NULL),
(11, 'peach-maroon', NULL, NULL),
(12, 'violet-teal', NULL, NULL),
(13, 'crimson-cyan-teal', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `number`, `created_at`, `updated_at`) VALUES
(1, 'Ryan', '00000000', '2022-01-22 05:23:27', '2022-01-22 05:23:27'),
(2, 'Ryan', '12345677', '2022-02-12 08:14:05', '2022-02-12 08:14:05'),
(3, '1111', '1111', '2022-02-12 08:18:30', '2022-02-12 08:18:30');

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `product_id`, `quantity`, `store_id`, `created_at`, `updated_at`) VALUES
(1, 14, 5, 2, '2021-12-04 01:35:49', '2022-02-15 00:44:29'),
(2, 13, 2, 2, '2021-12-04 01:35:55', '2022-02-11 00:17:08'),
(3, 11, 6, 2, '2021-12-04 01:36:02', '2022-02-11 00:17:07'),
(4, 10, 2, 2, '2021-12-04 01:36:09', '2022-02-11 00:17:08'),
(5, 9, 0, 2, '2021-12-04 01:36:18', '2022-01-03 03:46:37'),
(6, 8, 1, 2, '2021-12-04 01:36:25', '2021-12-04 01:36:25'),
(7, 7, 2, 2, '2021-12-04 01:36:34', '2022-02-11 00:17:08'),
(8, 6, 1, 2, '2021-12-04 01:36:44', '2021-12-04 01:36:44'),
(9, 5, 1, 2, '2021-12-04 01:36:51', '2021-12-04 01:36:51'),
(10, 4, 1, 2, '2021-12-04 01:36:58', '2021-12-04 01:36:58'),
(11, 3, 1, 2, '2021-12-04 01:37:09', '2021-12-04 01:37:09'),
(12, 2, 1, 2, '2021-12-04 01:37:18', '2021-12-04 01:37:18'),
(13, 1, 0, 2, '2021-12-04 01:37:28', '2022-01-04 08:19:47'),
(14, 14, 2, 5, '2021-12-10 03:07:48', '2021-12-14 05:10:09'),
(15, 13, 1, 5, '2021-12-10 03:10:25', '2021-12-15 01:54:28'),
(16, 11, 3, 5, '2021-12-14 05:38:31', '2021-12-15 02:16:43'),
(17, 10, 1, 5, '2021-12-14 05:38:40', '2021-12-14 05:42:21'),
(18, 11, 1, 4, '2021-12-14 05:42:22', '2021-12-14 05:42:22'),
(19, 10, 1, 4, '2021-12-14 05:42:22', '2021-12-14 05:42:22'),
(20, 7, 2, 5, '2021-12-14 07:47:42', '2021-12-14 07:47:42'),
(21, 6, 1, 5, '2021-12-15 01:34:17', '2021-12-15 01:34:17'),
(22, 24, 2, 2, '2022-01-03 04:30:01', '2022-02-11 00:17:08'),
(23, 25, 3, 2, '2022-01-04 00:43:40', '2022-01-10 04:31:37'),
(24, 26, 50, 2, '2022-01-10 04:32:10', '2022-01-10 04:32:10'),
(25, 27, 6, 2, '2022-01-10 04:32:30', '2022-01-10 04:32:30'),
(26, 14, 6, 3, '2022-01-22 05:35:53', '2022-01-22 05:37:49'),
(27, 14, 0, 1, '2022-01-22 05:37:50', '2022-02-14 04:48:50'),
(28, 11, 6, 3, '2022-01-22 06:44:45', '2022-01-22 06:45:55'),
(29, 11, 1, 1, '2022-01-22 06:45:55', '2022-02-11 00:17:06'),
(30, 13, 0, 3, '2022-02-02 05:57:28', '2022-02-02 05:59:00'),
(31, 10, 0, 3, '2022-02-02 05:57:40', '2022-02-02 05:59:00'),
(32, 7, 0, 3, '2022-02-02 05:58:00', '2022-02-02 05:59:00'),
(33, 13, 1, 1, '2022-02-02 05:59:01', '2022-02-11 00:17:06'),
(34, 10, 1, 1, '2022-02-02 05:59:01', '2022-02-11 00:17:06'),
(35, 7, 1, 1, '2022-02-02 05:59:01', '2022-02-11 00:17:06'),
(36, 24, 0, 3, '2022-02-11 00:11:23', '2022-02-11 00:14:43'),
(37, 29, 0, 3, '2022-02-11 00:13:54', '2022-02-11 00:14:52'),
(38, 24, 1, 1, '2022-02-11 00:14:43', '2022-02-11 00:17:07'),
(39, 29, 1, 1, '2022-02-11 00:14:52', '2022-02-11 00:17:07'),
(40, 29, 1, 2, '2022-02-11 00:17:09', '2022-02-11 00:17:09');

-- --------------------------------------------------------

--
-- Table structure for table `location_names`
--

CREATE TABLE `location_names` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `location_names`
--

INSERT INTO `location_names` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Office', NULL, NULL),
(2, 'Warehouse', NULL, NULL),
(3, 'Prime Ledtric', NULL, NULL),
(4, 'Acc Powertools', NULL, NULL),
(5, 'Tools Moto', '2021-12-04 08:15:05', '2021-12-04 08:15:05'),
(6, 'AC18', '2021-12-04 08:16:23', '2021-12-04 08:16:23');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(8, '2014_10_12_100000_create_password_resets_table', 1),
(9, '2021_06_16_150829_create_stores_table', 1),
(10, '2021_06_16_150853_create_positions_table', 1),
(11, '2021_06_16_151146_create_roles_table', 1),
(12, '2021_06_16_151203_create_accesses_table', 1),
(15, '2014_10_12_000000_create_users_table', 2),
(17, '2021_06_22_151923_create_brands_table', 3),
(18, '2021_06_22_152001_create_categories_table', 3),
(19, '2021_06_22_152851_create_suppliers_table', 3),
(20, '2021_06_22_151746_create_products_table', 4),
(22, '2021_06_27_145350_create_inventories_table', 5),
(23, '2021_09_25_025737_create_trasactions_table', 6),
(24, '2021_09_25_025859_create_transaction_types_table', 6),
(25, '2021_09_25_031435_create_transactions_table', 7),
(30, '2021_09_25_033811_create_transactions_table', 8),
(31, '2021_09_25_053059_create_inventories_table', 8),
(32, '2021_09_28_022711_create_transaction_comments_table', 8),
(33, '2021_09_28_023315_create_reciepts_table', 8),
(34, '2021_09_29_002908_create_transaction_types_table', 9),
(35, '2021_09_29_055701_create_reciepts_table', 10),
(36, '2021_09_29_060509_create_receipts_table', 11),
(37, '2021_10_01_021120_create_inventories_table', 12),
(38, '2021_10_01_021323_create_transactions_table', 12),
(39, '2021_10_07_052845_create_transfer_lists_table', 13),
(40, '2021_10_07_072728_create_transfer_lists_table', 14),
(121, '2021_10_07_074926_create_transacted_items_table', 15),
(122, '2021_10_08_013222_create_transactions_table', 15),
(123, '2021_10_08_013937_create_inventories_table', 15),
(124, '2021_10_16_035318_create_units_table', 15),
(125, '2021_10_23_075943_create_brand_colors_table', 15),
(126, '2021_10_30_064057_create_transaction_cancelations_table', 15),
(127, '2021_11_13_102226_create_notifications_table', 15),
(128, '2021_11_20_085707_create_location_names_table', 15),
(129, '2021_11_20_113438_create_colors_table', 15),
(130, '2021_11_23_081019_create_repairs_table', 15),
(131, '2021_11_24_083657_create_customers_table', 15),
(132, '2021_11_27_143942_create_return_to_suppliers_table', 15),
(133, '2021_11_27_145519_create_return_to_supplier_items_table', 15);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `is_read` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `message`, `link`, `transaction_id`, `store_id`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 'New transfer from Acc Powertools - Mayamot Antipolo', 'recieve_stocks', 22, 4, 0, '2021-12-14 05:40:37', '2021-12-14 05:42:22'),
(2, 'New transfer from Warehouse - Tabing Ilog Tanay', 'recieve_stocks', 38, 1, 0, '2022-01-22 05:36:24', '2022-01-22 05:37:50'),
(3, 'New transfer from Warehouse - Tabing Ilog Tanay', 'recieve_stocks', 41, 1, 0, '2022-01-22 06:45:08', '2022-01-22 06:45:55'),
(4, 'New delivery from Office - Plaza Aldea Tanay', 'recieve_stocks', 45, 2, 1, '2022-01-28 06:48:18', '2022-01-28 06:48:18'),
(5, 'New delivery from Office - Plaza Aldea Tanay', 'recieve_delivery', 46, 2, 0, '2022-01-28 06:50:04', '2022-02-01 07:16:14'),
(6, 'New transfer from Acc Powertools - J. Sumulong Ext. Antipolo', 'recieve_stocks', 47, 2, 1, '2022-02-01 06:17:04', '2022-02-01 06:17:04'),
(7, 'New delivery from Office - Plaza Aldea Tanay', 'recieve_stocks', 49, 2, 0, '2022-02-01 07:18:48', '2022-02-01 07:19:39'),
(8, 'New delivery from Office - Plaza Aldea Tanay', 'recieve_stocks', 51, 2, 1, '2022-02-01 07:36:37', '2022-02-01 07:36:37'),
(9, 'New delivery from Office - Plaza Aldea Tanay', 'recieve_delivery', 52, 2, 0, '2022-02-01 07:39:57', '2022-02-01 07:40:20'),
(10, 'New delivery from Office - Plaza Aldea Tanay', 'recieve_delivery', 54, 2, 0, '2022-02-01 07:41:21', '2022-02-01 07:42:13'),
(11, 'New transfer from Warehouse - Tabing Ilog Tanay', 'recieve_stocks', 59, 1, 0, '2022-02-02 05:58:29', '2022-02-02 05:59:01'),
(12, 'New transfer from Warehouse - Tabing Ilog Tanay', 'recieve_stocks', 62, 1, 0, '2022-02-11 00:11:42', '2022-02-11 00:14:44'),
(13, 'New transfer from Warehouse - Tabing Ilog Tanay', 'recieve_stocks', 64, 1, 0, '2022-02-11 00:14:12', '2022-02-11 00:14:53'),
(14, 'New delivery from Office - Plaza Aldea Tanay', 'recieve_delivery', 67, 2, 0, '2022-02-11 00:15:47', '2022-02-11 00:17:09'),
(15, 'New transfer from Warehouse - Tabing Ilog Tanay', 'recieve_stocks', 69, 1, 1, '2022-02-12 00:32:30', '2022-02-12 00:32:30'),
(16, 'New delivery from Office - Plaza Aldea Tanay', 'recieve_delivery', 70, 2, 0, '2022-02-12 05:41:17', '2022-02-12 07:53:34');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Programmer', NULL, NULL),
(2, 'Sales Representative', NULL, NULL),
(3, 'Supervisor', NULL, NULL),
(4, 'Encoder', '2021-11-30 01:57:27', '2021-11-30 01:57:27'),
(5, 'President', '2021-11-30 02:30:36', '2021-11-30 02:30:36');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` int(11) NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `code`, `name`, `description`, `price`, `discount`, `brand_id`, `category_id`, `image`, `unit_id`, `created_at`, `updated_at`) VALUES
(1, 'AG850383', 'Ingco Angle Grinder 850W', 'Voltage:220-240V-50/60Hz, No Load Speed:11000rpm, Disc Diameter:100mm4″, Input Power:850W, Spinder Thread:M10 with 1PC Auxiliary Handle', '3000.00', 50, 1, 1, 'acc-60d2119d353ba.jpg', 1, '2021-06-22 08:37:10', '2021-06-22 08:37:10'),
(2, 'HGNG01', 'Ingco Nitrile Gloves', 'Use for oil environment (less oil)worker etc. Nitrile coated palm, smooth and rough-texture palm finish.', '40.00', 0, 1, 2, 'acc-60d2120eb7cae.jpg', 1, '2021-06-22 08:39:14', '2021-06-24 06:46:32'),
(3, 'AIW12562', 'Ingco Air Impact Wrench', 'Square Drive:12.5mm(1/2″), No load speed:7000rpm, Max.torque:610Nm(450ft), Twin Hammer mechanism, Air  \r\nConsumption:142.5l/min(5.0cfm), Length:187mm(7.3″) Air Inlet:1/4″, Weight:2.6kgs(5.7lbs) Air hose:3/8″, with 3PCS socket\r\n(17,19,21mm)', '7000.00', 50, 1, 1, 'acc-60d32f3dabffa.jpg', 1, '2021-06-23 04:56:09', '2021-06-23 04:56:09'),
(4, 'AB4018', 'Ingco Blower 400W', 'Voltage:220-240V-50/60Hz, Input Power:400w, No-load speed:14000rpm, Max.Blowing Rate:3.0m3/min, 1Dust Bag', '1800.00', 50, 1, 1, 'acc-60d32fb54560f.jpg', 1, '2021-06-23 04:58:23', '2021-06-23 04:58:23'),
(5, 'AP14008-2P', 'Ingco Angle Polisher 1400W', 'Voltage:220V-240V-50-60Hz, Input Power:1400W, No-Load speed:900-3800rpm polishing pad, Diameter:180mm, Durable aluminum gear box 1PC Polishing Pad&Bonnet', '8000.00', 50, 1, 1, 'acc-60d33045dc055.jpg', 1, '2021-06-23 05:00:54', '2021-06-23 05:00:54'),
(6, 'CS2358', 'Ingco Circular Saw 9″ 2200W', 'Voltage:220-240V-50/Hz, No load speed:3800rpm, Blade Diameter:235mm, Cutting Capacity, 45degree:65mm, 90degree:80mm, Aluminum\r\nHousing, Adjustable cutting depth, Adjustable bevel cutting with 1PC 60T TCT blade', '9900.00', 50, 1, 1, 'acc-60d330c02fcd4.jpg', 1, '2021-06-23 05:02:54', '2021-06-23 05:02:54'),
(7, 'HSPP4161', 'Ingco Knapsack Sprayer 16L', 'Model no: HSPP4161, Capacity: 16L 100%, New material, Y trigger with fiber glass lance, Adjustable nozzle from jet to mist, Large container specifically designed for spraying larger areas', '1450.00', 0, 1, 2, 'acc-60d3323a5d843.jpg', 1, '2021-06-23 05:08:57', '2021-06-23 05:08:57'),
(8, 'AKSDFL1208', 'Ingco 12PCS Flexible Shaft Screwdriver Set', '12pc Flexible shaft screwdriver set Include, 1pc flexible shaft handle, 1pc 4-6mm (25mm) bits adaptor, 10pcs 6.35*25mm screwdriver bit SL5,6,7,PH1,2,3,T10,T15,T20,T25', '220.00', 0, 1, 2, 'acc-60d48b9d2f18d.jpg', 1, '2021-06-23 05:13:10', '2021-06-24 06:39:03'),
(9, 'AKDB1195', 'Ingco 19PCS Cobalt Drill Bit Set', 'Size:1mm, 1.5mm, 2mm, 2.5mm, 3mm, 3.5mm, 4mm, 4.5mm, 5mm, 5.5mm, 6mm, 6.5mm, 7mm, 7.5mm, 8mm, 8.5mm, 9mm, 9.5mm, 10mm', '900.00', 0, 1, 2, 'acc-60d33543690f8.jpg', 1, '2021-06-23 05:21:47', '2021-06-24 06:31:19'),
(10, 'HR104', 'Ingco Hand Riveter *10.5″', 'Size:10.5″, Applicable rivet size: 2.4, 3.2, 4, 4.8mm', '220.00', 0, 1, 2, 'acc-60d3362e560f2.jpg', 1, '2021-06-23 05:25:58', '2021-06-23 05:25:58'),
(11, 'HCSPA361', 'Ingco Combination Spanner 36mm', 'Size:36mm Length:460mm', '650.00', 0, 1, 2, 'acc-60d3452931caa.jpg', 1, '2021-06-23 06:30:08', '2021-11-08 22:10:52'),
(13, 'BBH18BL-0', 'AEG Brushless Rotary Hammer Drill 18v', 'Power: 18V', '28300.00', 50, 2, 1, 'acc-617667b80f8a9.jpg', 1, '2021-10-25 00:17:02', '2021-10-25 00:17:02'),
(14, 'AG750162', 'Ingco Angle Grinder 750w', 'Voltage: 220-240V~50/60Hz Input power: 750WNo-load speed: 12000rpm Spindle thread: M10Disc Diameter: 100mm (4”) Additional features: Easy Carbon Brushes Maintenance &amp;amp;amp;amp; ON/OFF SwitchIncluded accessories: 1pc auxiliary handle &amp;amp;amp;amp; 1pc spandle with manual', '1998.00', 50, 1, 1, 'acc-618a149a2a4cb.jpg', 1, '2021-11-08 17:27:31', '2022-02-18 08:36:16'),
(24, 'DDDD111', 'fefds', 'fdfdf', '5.00', 0, 1, 3, NULL, 1, '2022-01-03 04:29:19', '2022-01-03 04:29:19'),
(25, 'MCD1210550', 'Ingco 50pcs Abrasive Metal Cutting Disc Set', '50pcs / set, 105x1.2x16mm (4\"x3/64\"x5/8\"), Max: 15.300/Min80m/s, Flat center', '650.00', 0, 1, 2, NULL, 4, '2022-01-04 00:43:12', '2022-01-04 00:43:12'),
(26, 'MCD1210550-PCS', 'Ingco Abrasive Metal Cutting Disc Set Per Pc', '105x1.2x16mm (4&quot;x3/64&quot;x5/8&quot;), Max: 15.300/Min80m/s, Flat center', '20.00', 0, 1, 2, NULL, 1, '2022-01-04 02:06:52', '2022-01-04 02:06:52'),
(27, 'THHN12YELLOW-BOX', 'Powerflex THHN Wire 12 Yellow Sold Per Box', '12 Yellow Sold Per Box', '3425.00', 0, 5, 2, NULL, 4, '2022-01-10 04:27:18', '2022-01-10 04:28:43'),
(28, 'THHN12YELLOW', 'Powerflex THHN Wire 12 Yellow', '12 Yellow', '25.00', 0, 6, 2, NULL, 1, '2022-01-10 04:28:29', '2022-01-10 04:28:29'),
(29, 'AAAA', 'AAAA', 'AAA', '2.00', 0, 6, 2, NULL, 1, '2022-02-11 00:13:05', '2022-02-11 00:13:05');

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abbreviation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`id`, `type`, `abbreviation`, `created_at`, `updated_at`) VALUES
(1, 'Delivery', 'DR', NULL, NULL),
(2, 'Sales Invoice', 'SI', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `repairs`
--

CREATE TABLE `repairs` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `serial` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receipt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entry_date` date NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `repairs`
--

INSERT INTO `repairs` (`id`, `product_id`, `serial`, `receipt`, `entry_date`, `status`, `store_id`, `customer_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 14, '12345678', 'Prime-2-DR0000-2022-01-22', '2022-01-22', 'Received', 2, 1, 5, '2022-01-22 05:23:27', '2022-01-22 05:24:38'),
(2, 14, '1111111111112221', 'Prime-2-DR0003-2022-02-08', '2022-02-12', 'Received', 2, 2, 5, '2022-02-12 08:14:05', '2022-02-12 08:14:58'),
(3, 14, '1111111111', 'Prime-2-DR3423423-2022-02-09', '2022-02-12', 'Delivered', 2, 3, 5, '2022-02-12 08:18:31', '2022-02-12 08:22:09');

-- --------------------------------------------------------

--
-- Table structure for table `return_to_suppliers`
--

CREATE TABLE `return_to_suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `return_date` date NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `return_to_suppliers`
--

INSERT INTO `return_to_suppliers` (`id`, `return_date`, `supplier_id`, `status`, `created_at`, `updated_at`) VALUES
(1, '2022-02-14', 1, 'Ready', '2022-02-14 04:48:50', '2022-02-14 04:49:32');

-- --------------------------------------------------------

--
-- Table structure for table `return_to_supplier_items`
--

CREATE TABLE `return_to_supplier_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `return_to_supplier_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `return_to_supplier_items`
--

INSERT INTO `return_to_supplier_items` (`id`, `return_to_supplier_id`, `product_id`, `quantity`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 1, 14, 1, '2000.00', '2022-02-14 04:48:50', '2022-02-14 04:48:50');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Full', NULL, NULL),
(2, 'Partial', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `name`, `street`, `city`, `province`, `access_id`, `created_at`, `updated_at`) VALUES
(1, 'Office', 'Plaza Aldea', 'Tanay', 'Rizal', 1, NULL, NULL),
(2, 'Prime Ledtric', 'Plaza Aldea', 'Tanay', 'Rizal', 2, NULL, NULL),
(3, 'Warehouse', 'Tabing Ilog', 'Tanay', 'Rizal', 3, NULL, NULL),
(4, 'Acc Powertools', 'J. Sumulong Ext.', 'Antipolo', 'Rizal', 2, NULL, NULL),
(5, 'Acc Powertools', 'Mayamot', 'Antipolo', 'Rizal', 2, '2021-11-20 01:52:24', '2021-11-20 01:52:24'),
(6, 'Prime Ledtric', 'Hulo', 'Pililia', 'Rizal', 2, '2021-11-20 01:53:55', '2021-11-20 01:53:55');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Ingco Traders', 'Metro Manila', NULL, '2021-11-20 08:06:26'),
(2, 'Electrowerks', 'Pasay City', NULL, NULL),
(3, 'Foshan Lighting', 'Binondo Metro Manila', '2021-11-20 08:16:47', '2021-11-20 08:16:47');

-- --------------------------------------------------------

--
-- Table structure for table `transacted_items`
--

CREATE TABLE `transacted_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `inventory_id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `serial` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_changed` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transacted_items`
--

INSERT INTO `transacted_items` (`id`, `inventory_id`, `transaction_id`, `serial`, `quantity`, `total_price`, `note`, `is_changed`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, 1, '2000.00', NULL, 1, '2021-12-04 01:35:49', '2021-12-04 01:35:49'),
(2, 2, 2, NULL, 1, '28300.00', NULL, 1, '2021-12-04 01:35:56', '2021-12-04 01:35:56'),
(3, 3, 3, NULL, 1, '650.00', NULL, 1, '2021-12-04 01:36:03', '2021-12-04 01:36:03'),
(4, 4, 4, NULL, 1, '220.00', NULL, 1, '2021-12-04 01:36:09', '2021-12-04 01:36:09'),
(5, 5, 5, NULL, 1, '900.00', NULL, 1, '2021-12-04 01:36:19', '2021-12-04 01:36:19'),
(6, 6, 6, NULL, 1, '220.00', NULL, 1, '2021-12-04 01:36:26', '2021-12-04 01:36:26'),
(7, 7, 7, NULL, 1, '1450.00', NULL, 1, '2021-12-04 01:36:35', '2021-12-04 01:36:35'),
(8, 8, 8, NULL, 1, '9900.00', NULL, 1, '2021-12-04 01:36:45', '2021-12-04 01:36:45'),
(9, 9, 9, NULL, 1, '8000.00', NULL, 1, '2021-12-04 01:36:51', '2021-12-04 01:36:51'),
(10, 10, 10, NULL, 1, '1800.00', NULL, 1, '2021-12-04 01:36:58', '2021-12-04 01:36:58'),
(11, 11, 11, NULL, 1, '7000.00', NULL, 1, '2021-12-04 01:37:10', '2021-12-04 01:37:10'),
(12, 12, 12, NULL, 1, '40.00', NULL, 1, '2021-12-04 01:37:18', '2021-12-04 01:37:18'),
(14, 14, 14, NULL, 2, '4000.00', NULL, 1, '2021-12-10 03:07:50', '2021-12-10 03:07:50'),
(15, 14, 15, NULL, 2, '4000.00', NULL, 1, '2021-12-10 03:09:26', '2021-12-10 03:09:26'),
(16, 15, 16, NULL, 1, '28300.00', NULL, 1, '2021-12-10 03:10:26', '2021-12-10 03:10:26'),
(17, 14, 17, '12233445556', 1, '1000.00', 'Change to Acc-5-2021-12-14', 0, '2021-12-14 05:05:25', '2021-12-14 05:10:10'),
(18, 15, 18, '1223344455576', 1, '14150.00', '', 1, '2021-12-14 05:06:37', '2021-12-14 05:06:37'),
(19, 14, 18, '1223334456655', 1, '1000.00', '', 1, '2021-12-14 05:06:37', '2021-12-14 05:06:37'),
(20, 14, 19, '5237738383', 1, '1000.00', '', 1, '2021-12-14 05:08:49', '2021-12-14 05:08:49'),
(21, 14, 19, '12233445556', 1, '-1000.00', 'Change from Acc-5-DR0001-2021-12-14', 0, '2021-12-14 05:10:09', '2021-12-14 05:10:09'),
(22, 16, 20, NULL, 2, '1300.00', NULL, 1, '2021-12-14 05:38:31', '2021-12-14 05:38:31'),
(23, 17, 21, NULL, 2, '440.00', NULL, 1, '2021-12-14 05:38:40', '2021-12-14 05:38:40'),
(24, 16, 22, NULL, 1, '650.00', '1-pcs has been transfered', 1, '2021-12-14 05:40:36', '2021-12-14 05:42:21'),
(25, 17, 22, NULL, 1, '220.00', '1-pcs has been transfered', 1, '2021-12-14 05:40:36', '2021-12-14 05:42:21'),
(26, 18, 23, NULL, 1, '650.00', '1-pcs has been recieved', 1, '2021-12-14 05:42:22', '2021-12-14 05:42:22'),
(27, 19, 23, NULL, 1, '220.00', '1-pcs has been recieved', 1, '2021-12-14 05:42:22', '2021-12-14 05:42:22'),
(28, 20, 24, NULL, 2, '2900.00', NULL, 1, '2021-12-14 07:47:43', '2021-12-14 07:47:43'),
(29, 21, 25, NULL, 1, '9900.00', NULL, 1, '2021-12-15 01:34:18', '2021-12-15 01:34:18'),
(30, 15, 26, NULL, 1, '28300.00', NULL, 1, '2021-12-15 01:54:28', '2021-12-15 01:54:28'),
(31, 16, 27, NULL, 1, '650.00', NULL, 1, '2021-12-15 01:56:44', '2021-12-15 01:56:44'),
(32, 16, 28, NULL, 1, '650.00', NULL, 1, '2021-12-15 02:16:43', '2021-12-15 02:16:43'),
(33, 5, 29, NULL, 1, '900.00', '', 1, '2022-01-03 03:46:37', '2022-01-03 03:46:37'),
(34, 22, 30, NULL, 1, '5.00', NULL, 1, '2022-01-03 04:30:01', '2022-01-03 04:30:01'),
(35, 23, 31, NULL, 6, '3900.00', NULL, 1, '2022-01-04 00:43:40', '2022-01-04 00:43:40'),
(36, 23, 32, NULL, 1, '650.00', NULL, 1, '2022-01-04 07:05:33', '2022-01-04 07:05:33'),
(37, 23, 33, NULL, 1, '650.00', NULL, 1, '2022-01-04 07:14:47', '2022-01-04 07:14:47'),
(38, 23, 34, NULL, 1, '650.00', NULL, 1, '2022-01-10 04:31:37', '2022-01-10 04:31:37'),
(39, 24, 35, NULL, 50, '1000.00', NULL, 1, '2022-01-10 04:32:11', '2022-01-10 04:32:11'),
(40, 25, 36, NULL, 6, '20550.00', NULL, 1, '2022-01-10 04:32:30', '2022-01-10 04:32:30'),
(41, 26, 37, NULL, 12, '24000.00', NULL, 1, '2022-01-22 05:35:53', '2022-01-22 05:35:53'),
(42, 26, 38, NULL, 6, '12000.00', '6-pcs has been transfered', 1, '2022-01-22 05:36:24', '2022-01-22 05:37:49'),
(43, 27, 39, NULL, 6, '12000.00', '6-pcs has been recieved', 1, '2022-01-22 05:37:50', '2022-01-22 05:37:50'),
(44, 28, 40, NULL, 12, '7800.00', NULL, 1, '2022-01-22 06:44:47', '2022-01-22 06:44:47'),
(45, 28, 41, NULL, 6, '3900.00', '6-pcs has been transfered', 1, '2022-01-22 06:45:07', '2022-01-22 06:45:55'),
(46, 29, 42, NULL, 6, '3900.00', '6-pcs has been recieved', 1, '2022-01-22 06:45:55', '2022-01-22 06:45:55'),
(47, 27, 45, NULL, 1, '2000.00', '1-pcs has been trying to trying to deliver', 1, '2022-01-28 06:48:17', '2022-01-28 06:48:17'),
(48, 29, 45, NULL, 1, '650.00', '1-pcs has been trying to trying to deliver', 1, '2022-01-28 06:48:17', '2022-01-28 06:48:17'),
(49, 27, 46, NULL, 1, '2000.00', '1-pcs has been delivered', 1, '2022-01-28 06:50:03', '2022-02-01 07:16:13'),
(50, 29, 46, NULL, 1, '650.00', '1-pcs has been delivered', 1, '2022-01-28 06:50:03', '2022-02-01 07:16:13'),
(51, 18, 47, NULL, 1, '650.00', '1-pcs has been trying to trying to transfer', 1, '2022-02-01 06:17:04', '2022-02-01 06:17:04'),
(52, 1, 48, NULL, 1, '2000.00', '1-pcs has been recieved', 1, '2022-02-01 07:16:14', '2022-02-01 07:16:14'),
(53, 3, 48, NULL, 1, '650.00', '1-pcs has been recieved', 1, '2022-02-01 07:16:14', '2022-02-01 07:16:14'),
(54, 27, 49, NULL, 2, '4000.00', '2-pcs has been transfered', 1, '2022-02-01 07:18:48', '2022-02-01 07:19:39'),
(55, 1, 50, NULL, 2, '4000.00', '2-pcs has been recieved', 1, '2022-02-01 07:19:39', '2022-02-01 07:19:39'),
(56, 29, 51, NULL, 2, '1300.00', '2-pcs has been trying to trying to deliver', 1, '2022-02-01 07:36:36', '2022-02-01 07:36:36'),
(57, 29, 52, NULL, 2, '1300.00', '2-pcs has been delivered', 1, '2022-02-01 07:39:57', '2022-02-01 07:40:18'),
(58, 3, 53, NULL, 2, '1300.00', '2-pcs has been recieved', 1, '2022-02-01 07:40:19', '2022-02-01 07:40:19'),
(59, 29, 54, NULL, 1, '650.00', '1-pcs has been delivered', 1, '2022-02-01 07:41:21', '2022-02-01 07:42:12'),
(60, 3, 55, NULL, 1, '650.00', '1-pcs has been recieved', 1, '2022-02-01 07:42:13', '2022-02-01 07:42:13'),
(61, 30, 56, NULL, 2, '56600.00', NULL, 1, '2022-02-02 05:57:28', '2022-02-02 05:57:28'),
(62, 31, 57, NULL, 2, '440.00', NULL, 1, '2022-02-02 05:57:41', '2022-02-02 05:57:41'),
(63, 32, 58, NULL, 2, '2900.00', NULL, 1, '2022-02-02 05:58:00', '2022-02-02 05:58:00'),
(64, 30, 59, NULL, 2, '56600.00', '2-pcs has been transfered', 1, '2022-02-02 05:58:29', '2022-02-02 05:59:00'),
(65, 31, 59, NULL, 2, '440.00', '2-pcs has been transfered', 1, '2022-02-02 05:58:29', '2022-02-02 05:59:00'),
(66, 32, 59, NULL, 2, '2900.00', '2-pcs has been transfered', 1, '2022-02-02 05:58:29', '2022-02-02 05:59:00'),
(67, 33, 60, NULL, 2, '56600.00', '2-pcs has been recieved', 1, '2022-02-02 05:59:01', '2022-02-02 05:59:01'),
(68, 34, 60, NULL, 2, '440.00', '2-pcs has been recieved', 1, '2022-02-02 05:59:01', '2022-02-02 05:59:01'),
(69, 35, 60, NULL, 2, '2900.00', '2-pcs has been recieved', 1, '2022-02-02 05:59:01', '2022-02-02 05:59:01'),
(70, 36, 61, NULL, 2, '10.00', NULL, 1, '2022-02-11 00:11:23', '2022-02-11 00:11:23'),
(71, 36, 62, NULL, 2, '10.00', '2-pcs has been transfered', 1, '2022-02-11 00:11:42', '2022-02-11 00:14:42'),
(72, 37, 63, NULL, 2, '4.00', NULL, 1, '2022-02-11 00:13:54', '2022-02-11 00:13:54'),
(73, 37, 64, NULL, 2, '4.00', '2-pcs has been transfered', 1, '2022-02-11 00:14:12', '2022-02-11 00:14:51'),
(74, 38, 65, NULL, 2, '10.00', '2-pcs has been recieved', 1, '2022-02-11 00:14:43', '2022-02-11 00:14:43'),
(75, 39, 66, NULL, 2, '4.00', '2-pcs has been recieved', 1, '2022-02-11 00:14:53', '2022-02-11 00:14:53'),
(76, 27, 67, NULL, 2, '4000.00', '2-pcs has been delivered', 1, '2022-02-11 00:15:46', '2022-02-11 00:17:05'),
(77, 29, 67, NULL, 1, '650.00', '1-pcs has been delivered', 1, '2022-02-11 00:15:46', '2022-02-11 00:17:05'),
(78, 33, 67, NULL, 1, '28300.00', '1-pcs has been delivered', 1, '2022-02-11 00:15:46', '2022-02-11 00:17:06'),
(79, 34, 67, NULL, 1, '220.00', '1-pcs has been delivered', 1, '2022-02-11 00:15:46', '2022-02-11 00:17:06'),
(80, 35, 67, NULL, 1, '1450.00', '1-pcs has been delivered', 1, '2022-02-11 00:15:46', '2022-02-11 00:17:06'),
(81, 38, 67, NULL, 1, '5.00', '1-pcs has been delivered', 1, '2022-02-11 00:15:46', '2022-02-11 00:17:07'),
(82, 39, 67, NULL, 1, '2.00', '1-pcs has been delivered', 1, '2022-02-11 00:15:47', '2022-02-11 00:17:07'),
(83, 1, 68, NULL, 2, '4000.00', '2-pcs has been recieved', 1, '2022-02-11 00:17:07', '2022-02-11 00:17:07'),
(84, 3, 68, NULL, 1, '650.00', '1-pcs has been recieved', 1, '2022-02-11 00:17:08', '2022-02-11 00:17:08'),
(85, 2, 68, NULL, 1, '28300.00', '1-pcs has been recieved', 1, '2022-02-11 00:17:08', '2022-02-11 00:17:08'),
(86, 4, 68, NULL, 1, '220.00', '1-pcs has been recieved', 1, '2022-02-11 00:17:08', '2022-02-11 00:17:08'),
(87, 7, 68, NULL, 1, '1450.00', '1-pcs has been recieved', 1, '2022-02-11 00:17:08', '2022-02-11 00:17:08'),
(88, 22, 68, NULL, 1, '5.00', '1-pcs has been recieved', 1, '2022-02-11 00:17:09', '2022-02-11 00:17:09'),
(89, 40, 68, NULL, 1, '2.00', '1-pcs has been recieved', 1, '2022-02-11 00:17:09', '2022-02-11 00:17:09'),
(90, 26, 69, NULL, 2, '4000.00', '2-pcs has been trying to trying to transfer', 1, '2022-02-12 00:32:30', '2022-02-12 00:32:30'),
(91, 28, 69, NULL, 2, '1300.00', '2-pcs has been trying to trying to transfer', 1, '2022-02-12 00:32:30', '2022-02-12 00:32:30'),
(94, 1, 71, NULL, 1, '1000.00', '', 1, '2022-02-15 00:44:29', '2022-02-15 00:44:29');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `transaction_type_id` bigint(20) UNSIGNED NOT NULL,
  `transaction_date` date NOT NULL,
  `transaction_comment_id` bigint(20) UNSIGNED NOT NULL,
  `transaction_receipt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `transaction_type_id`, `transaction_date`, `transaction_comment_id`, `transaction_receipt`, `status`, `user_id`, `from`, `to`, `store_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2021-12-04', 1, NULL, 'Received', 5, 'Office - Plaza Aldea Tanay', 'Prime Ledtric - Plaza Aldea Tanay', 2, '2021-12-04 01:35:49', '2021-12-04 01:35:49'),
(2, 1, '2021-12-04', 1, NULL, 'Received', 5, 'Office - Plaza Aldea Tanay', 'Prime Ledtric - Plaza Aldea Tanay', 2, '2021-12-04 01:35:56', '2021-12-04 01:35:56'),
(3, 1, '2021-12-04', 1, NULL, 'Received', 5, 'Office - Plaza Aldea Tanay', 'Prime Ledtric - Plaza Aldea Tanay', 2, '2021-12-04 01:36:02', '2021-12-04 01:36:02'),
(4, 1, '2021-12-04', 1, NULL, 'Received', 5, 'Office - Plaza Aldea Tanay', 'Prime Ledtric - Plaza Aldea Tanay', 2, '2021-12-04 01:36:09', '2021-12-04 01:36:09'),
(5, 1, '2021-12-04', 1, NULL, 'Received', 5, 'Office - Plaza Aldea Tanay', 'Prime Ledtric - Plaza Aldea Tanay', 2, '2021-12-04 01:36:18', '2021-12-04 01:36:18'),
(6, 1, '2021-12-04', 1, NULL, 'Received', 5, 'Office - Plaza Aldea Tanay', 'Prime Ledtric - Plaza Aldea Tanay', 2, '2021-12-04 01:36:26', '2021-12-04 01:36:26'),
(7, 1, '2021-12-04', 1, NULL, 'Received', 5, 'Office - Plaza Aldea Tanay', 'Prime Ledtric - Plaza Aldea Tanay', 2, '2021-12-04 01:36:35', '2021-12-04 01:36:35'),
(8, 1, '2021-12-04', 1, NULL, 'Received', 5, 'Office - Plaza Aldea Tanay', 'Prime Ledtric - Plaza Aldea Tanay', 2, '2021-12-04 01:36:44', '2021-12-04 01:36:44'),
(9, 1, '2021-12-04', 1, NULL, 'Received', 5, 'Office - Plaza Aldea Tanay', 'Prime Ledtric - Plaza Aldea Tanay', 2, '2021-12-04 01:36:51', '2021-12-04 01:36:51'),
(10, 1, '2021-12-04', 1, NULL, 'Received', 5, 'Office - Plaza Aldea Tanay', 'Prime Ledtric - Plaza Aldea Tanay', 2, '2021-12-04 01:36:58', '2021-12-04 01:36:58'),
(11, 1, '2021-12-04', 1, NULL, 'Received', 5, 'Office - Plaza Aldea Tanay', 'Prime Ledtric - Plaza Aldea Tanay', 2, '2021-12-04 01:37:09', '2021-12-04 01:37:09'),
(12, 1, '2021-12-04', 1, NULL, 'Received', 5, 'Office - Plaza Aldea Tanay', 'Prime Ledtric - Plaza Aldea Tanay', 2, '2021-12-04 01:37:18', '2021-12-04 01:37:18'),
(13, 1, '2021-12-04', 1, NULL, 'Cancelled', 5, 'Office - Plaza Aldea Tanay', 'Prime Ledtric - Plaza Aldea Tanay', 2, '2021-12-04 01:37:28', '2022-01-04 08:19:47'),
(14, 1, '2021-12-10', 1, NULL, 'Received', 2, 'Office - Plaza Aldea Tanay', 'Acc Powertools - Mayamot Antipolo', 5, '2021-12-10 03:07:50', '2021-12-10 03:07:50'),
(15, 1, '2021-12-10', 1, NULL, 'Received', 2, 'Office - Plaza Aldea Tanay', 'Acc Powertools - Mayamot Antipolo', 5, '2021-12-10 03:09:25', '2021-12-10 03:09:25'),
(16, 1, '2021-12-10', 1, NULL, 'Received', 2, 'Office - Plaza Aldea Tanay', 'Acc Powertools - Mayamot Antipolo', 5, '2021-12-10 03:10:25', '2021-12-10 03:10:25'),
(17, 3, '2021-12-14', 2, 'Acc-5-DR0001-2021-12-14', 'Sold', 2, 'Acc Powertools - Mayamot Antipolo', 'Customer', 5, '2021-12-14 05:05:24', '2021-12-14 05:05:24'),
(18, 3, '2021-12-14', 2, 'Acc-5-SI0001-2021-12-14', 'Sold', 2, 'Acc Powertools - Mayamot Antipolo', 'Customer', 5, '2021-12-14 05:06:37', '2021-12-14 05:06:37'),
(19, 3, '2021-12-14', 2, 'Acc-5-DR0002-2021-12-14', 'Sold', 2, 'Acc Powertools - Mayamot Antipolo', 'Customer', 5, '2021-12-14 05:08:48', '2021-12-14 05:08:48'),
(20, 1, '2021-12-14', 1, NULL, 'Received', 2, 'Office - Plaza Aldea Tanay', 'Acc Powertools - Mayamot Antipolo', 5, '2021-12-14 05:38:31', '2021-12-14 05:38:31'),
(21, 1, '2021-12-14', 1, NULL, 'Received', 2, 'Office - Plaza Aldea Tanay', 'Acc Powertools - Mayamot Antipolo', 5, '2021-12-14 05:38:40', '2021-12-14 05:38:40'),
(22, 2, '2021-12-14', 2, '22', 'Transfered', 2, 'Acc Powertools - Mayamot Antipolo', 'Acc Powertools - J. Sumulong Ext. Antipolo', 5, '2021-12-14 05:40:36', '2021-12-14 05:42:22'),
(23, 2, '2021-12-14', 1, '22', 'Received', 4, 'Acc Powertools - Mayamot Antipolo', 'Acc Powertools - J. Sumulong Ext. Antipolo', 4, '2021-12-14 05:42:22', '2021-12-14 05:42:22'),
(24, 1, '2021-12-14', 1, NULL, 'Received', 2, 'Office - Plaza Aldea Tanay', 'Acc Powertools - Mayamot Antipolo', 5, '2021-12-14 07:47:42', '2021-12-14 07:47:42'),
(25, 1, '2021-12-15', 1, NULL, 'Received', 2, 'Office - Plaza Aldea Tanay', 'Acc Powertools - Mayamot Antipolo', 5, '2021-12-15 01:34:18', '2021-12-15 01:34:18'),
(26, 1, '2021-12-15', 1, NULL, 'Received', 2, 'Office - Plaza Aldea Tanay', 'Acc Powertools - Mayamot Antipolo', 5, '2021-12-15 01:54:28', '2021-12-15 01:54:28'),
(27, 1, '2021-12-15', 1, NULL, 'Received', 2, 'Office - Plaza Aldea Tanay', 'Acc Powertools - Mayamot Antipolo', 5, '2021-12-15 01:56:44', '2021-12-15 01:56:44'),
(28, 1, '2021-12-15', 1, NULL, 'Received', 2, 'Office - Plaza Aldea Tanay', 'Acc Powertools - Mayamot Antipolo', 5, '2021-12-15 02:16:43', '2021-12-15 02:16:43'),
(29, 3, '2022-01-03', 2, 'Prime-2-DR2222-2022-01-03', 'Sold', 5, 'Prime Ledtric - Plaza Aldea Tanay', 'Customer', 2, '2022-01-03 03:46:37', '2022-01-03 03:46:37'),
(30, 1, '2022-01-03', 1, NULL, 'Received', 5, 'Office - Plaza Aldea Tanay', 'Prime Ledtric - Plaza Aldea Tanay', 2, '2022-01-03 04:30:01', '2022-01-03 04:30:01'),
(31, 1, '2022-01-04', 1, NULL, 'Received', 5, 'Office - Plaza Aldea Tanay', 'Prime Ledtric - Plaza Aldea Tanay', 2, '2022-01-04 00:43:40', '2022-01-04 00:43:40'),
(32, 4, '2022-01-04', 1, NULL, 'Unboxed', 5, 'Prime Ledtric - Plaza Aldea Tanay', 'Prime Ledtric - Plaza Aldea Tanay', 2, '2022-01-04 07:05:33', '2022-01-04 07:05:33'),
(33, 4, '2022-01-04', 1, NULL, 'Unboxed', 5, 'Prime Ledtric - Plaza Aldea Tanay', 'Prime Ledtric - Plaza Aldea Tanay', 2, '2022-01-04 07:14:47', '2022-01-04 07:14:47'),
(34, 4, '2022-01-10', 1, NULL, 'Unboxed', 5, 'Prime Ledtric - Plaza Aldea Tanay', 'Prime Ledtric - Plaza Aldea Tanay', 2, '2022-01-10 04:31:37', '2022-01-10 04:31:37'),
(35, 1, '2022-01-10', 1, NULL, 'Received', 5, 'Office - Plaza Aldea Tanay', 'Prime Ledtric - Plaza Aldea Tanay', 2, '2022-01-10 04:32:11', '2022-01-10 04:32:11'),
(36, 1, '2022-01-10', 1, NULL, 'Received', 5, 'Office - Plaza Aldea Tanay', 'Prime Ledtric - Plaza Aldea Tanay', 2, '2022-01-10 04:32:30', '2022-01-10 04:32:30'),
(37, 1, '2022-01-22', 1, NULL, 'Received', 3, 'Office - Plaza Aldea Tanay', 'Warehouse - Tabing Ilog Tanay', 3, '2022-01-22 05:35:53', '2022-01-22 05:35:53'),
(38, 2, '2022-01-22', 2, '38', 'Transfered', 3, 'Warehouse - Tabing Ilog Tanay', 'Office - Plaza Aldea Tanay', 3, '2022-01-22 05:36:24', '2022-01-22 05:37:50'),
(39, 2, '2022-01-22', 1, '38', 'Received', 1, 'Warehouse - Tabing Ilog Tanay', 'Office - Plaza Aldea Tanay', 1, '2022-01-22 05:37:50', '2022-01-22 05:37:50'),
(40, 1, '2022-01-22', 1, NULL, 'Received', 3, 'Office - Plaza Aldea Tanay', 'Warehouse - Tabing Ilog Tanay', 3, '2022-01-22 06:44:46', '2022-01-22 06:44:46'),
(41, 2, '2022-01-22', 2, '41', 'Transfered', 3, 'Warehouse - Tabing Ilog Tanay', 'Office - Plaza Aldea Tanay', 3, '2022-01-22 06:45:07', '2022-01-22 06:45:55'),
(42, 2, '2022-01-22', 1, '41', 'Received', 1, 'Warehouse - Tabing Ilog Tanay', 'Office - Plaza Aldea Tanay', 1, '2022-01-22 06:45:55', '2022-01-22 06:45:55'),
(43, 1, '2022-01-28', 2, NULL, 'Pending', 1, 'Office - Plaza Aldea Tanay', 'Prime Ledtric - Plaza Aldea Tanay', 1, '2022-01-28 06:05:47', '2022-01-28 06:05:47'),
(44, 1, '2022-01-28', 2, '66676', 'Pending', 1, 'Office - Plaza Aldea Tanay', 'Prime Ledtric - Plaza Aldea Tanay', 1, '2022-01-28 06:12:41', '2022-01-28 06:12:41'),
(45, 1, '2022-01-28', 2, '12345', 'Pending', 1, 'Office - Plaza Aldea Tanay', 'Prime Ledtric - Plaza Aldea Tanay', 1, '2022-01-28 06:48:17', '2022-01-28 06:48:17'),
(46, 1, '2022-01-28', 2, '123344', 'Delivered', 1, 'Office - Plaza Aldea Tanay', 'Prime Ledtric - Plaza Aldea Tanay', 1, '2022-01-28 06:50:03', '2022-02-01 07:16:14'),
(47, 2, '2022-02-01', 2, NULL, 'Pending', 4, 'Acc Powertools - J. Sumulong Ext. Antipolo', 'Prime Ledtric - Plaza Aldea Tanay', 4, '2022-02-01 06:17:04', '2022-02-01 06:17:04'),
(48, 1, '2022-02-01', 1, '123344', 'Received', 5, 'Office - Plaza Aldea Tanay', 'Prime Ledtric - Plaza Aldea Tanay', 2, '2022-02-01 07:16:14', '2022-02-01 07:16:14'),
(49, 1, '2022-02-01', 2, '49', 'Transfered', 1, 'Office - Plaza Aldea Tanay', 'Prime Ledtric - Plaza Aldea Tanay', 1, '2022-02-01 07:18:48', '2022-02-01 07:19:39'),
(50, 2, '2022-02-01', 1, '49', 'Received', 5, 'Office - Plaza Aldea Tanay', 'Prime Ledtric - Plaza Aldea Tanay', 2, '2022-02-01 07:19:39', '2022-02-01 07:19:39'),
(51, 1, '2022-02-01', 2, '664433', 'Pending', 1, 'Office - Plaza Aldea Tanay', 'Prime Ledtric - Plaza Aldea Tanay', 1, '2022-02-01 07:36:36', '2022-02-01 07:36:36'),
(52, 1, '2022-02-01', 2, '433755', 'Delivered', 1, 'Office - Plaza Aldea Tanay', 'Prime Ledtric - Plaza Aldea Tanay', 1, '2022-02-01 07:39:56', '2022-02-01 07:40:19'),
(53, 1, '2022-02-01', 1, '433755', 'Received', 5, 'Office - Plaza Aldea Tanay', 'Prime Ledtric - Plaza Aldea Tanay', 2, '2022-02-01 07:40:19', '2022-02-01 07:40:19'),
(54, 1, '2022-02-01', 2, '543543', 'Delivered', 1, 'Office - Plaza Aldea Tanay', 'Prime Ledtric - Plaza Aldea Tanay', 1, '2022-02-01 07:41:21', '2022-02-01 07:42:13'),
(55, 1, '2022-02-01', 1, '543543', 'Received', 5, 'Office - Plaza Aldea Tanay', 'Prime Ledtric - Plaza Aldea Tanay', 2, '2022-02-01 07:42:13', '2022-02-01 07:42:13'),
(56, 1, '2022-02-02', 1, NULL, 'Received', 3, 'Office - Plaza Aldea Tanay', 'Warehouse - Tabing Ilog Tanay', 3, '2022-02-02 05:57:28', '2022-02-02 05:57:28'),
(57, 1, '2022-02-02', 1, NULL, 'Received', 3, 'Office - Plaza Aldea Tanay', 'Warehouse - Tabing Ilog Tanay', 3, '2022-02-02 05:57:41', '2022-02-02 05:57:41'),
(58, 1, '2022-02-02', 1, NULL, 'Received', 3, 'Office - Plaza Aldea Tanay', 'Warehouse - Tabing Ilog Tanay', 3, '2022-02-02 05:58:00', '2022-02-02 05:58:00'),
(59, 2, '2022-02-02', 2, '59', 'Transfered', 3, 'Warehouse - Tabing Ilog Tanay', 'Office - Plaza Aldea Tanay', 3, '2022-02-02 05:58:28', '2022-02-02 05:59:00'),
(60, 2, '2022-02-02', 1, '59', 'Received', 1, 'Warehouse - Tabing Ilog Tanay', 'Office - Plaza Aldea Tanay', 1, '2022-02-02 05:59:00', '2022-02-02 05:59:00'),
(61, 1, '2022-02-11', 1, NULL, 'Received', 3, 'Office - Plaza Aldea Tanay', 'Warehouse - Tabing Ilog Tanay', 3, '2022-02-11 00:11:23', '2022-02-11 00:11:23'),
(62, 2, '2022-02-11', 2, '62', 'Transfered', 3, 'Warehouse - Tabing Ilog Tanay', 'Office - Plaza Aldea Tanay', 3, '2022-02-11 00:11:42', '2022-02-11 00:14:43'),
(63, 1, '2022-02-11', 1, NULL, 'Received', 3, 'Office - Plaza Aldea Tanay', 'Warehouse - Tabing Ilog Tanay', 3, '2022-02-11 00:13:54', '2022-02-11 00:13:54'),
(64, 2, '2022-02-11', 2, '64', 'Transfered', 3, 'Warehouse - Tabing Ilog Tanay', 'Office - Plaza Aldea Tanay', 3, '2022-02-11 00:14:12', '2022-02-11 00:14:52'),
(65, 2, '2022-02-11', 1, '62', 'Received', 1, 'Warehouse - Tabing Ilog Tanay', 'Office - Plaza Aldea Tanay', 1, '2022-02-11 00:14:43', '2022-02-11 00:14:43'),
(66, 2, '2022-02-11', 1, '64', 'Received', 1, 'Warehouse - Tabing Ilog Tanay', 'Office - Plaza Aldea Tanay', 1, '2022-02-11 00:14:52', '2022-02-11 00:14:52'),
(67, 1, '2022-02-11', 2, '2566', 'Delivered', 1, 'Office - Plaza Aldea Tanay', 'Prime Ledtric - Plaza Aldea Tanay', 1, '2022-02-11 00:15:45', '2022-02-11 00:17:07'),
(68, 1, '2022-02-11', 1, '2566', 'Received', 5, 'Office - Plaza Aldea Tanay', 'Prime Ledtric - Plaza Aldea Tanay', 2, '2022-02-11 00:17:07', '2022-02-11 00:17:07'),
(69, 2, '2022-02-12', 2, NULL, 'Pending', 3, 'Warehouse - Tabing Ilog Tanay', 'Office - Plaza Aldea Tanay', 3, '2022-02-12 00:32:30', '2022-02-12 00:32:30'),
(70, 1, '2022-02-12', 2, '00000005', 'Cancelled', 1, 'Office - Plaza Aldea Tanay', 'Prime Ledtric - Plaza Aldea Tanay', 1, '2022-02-12 05:41:16', '2022-02-12 07:53:34'),
(71, 3, '2022-02-15', 2, 'Prime-2-DR2222-2022-02-15', 'Sold', 5, 'Prime Ledtric - Plaza Aldea Tanay', 'Customer', 2, '2022-02-15 00:44:29', '2022-02-15 00:44:29');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_cancelations`
--

CREATE TABLE `transaction_cancelations` (
  `id` int(10) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cancelation_date` date NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_cancelations`
--

INSERT INTO `transaction_cancelations` (`id`, `transaction_id`, `reason`, `cancelation_date`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 13, 'Wrong', '2022-01-04', 5, '2022-01-04 08:19:47', '2022-01-04 08:19:47'),
(2, 70, 'Wrong Encode', '2022-02-12', 1, '2022-02-12 07:53:34', '2022-02-12 07:53:34');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_comments`
--

CREATE TABLE `transaction_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_comments`
--

INSERT INTO `transaction_comments` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Stock In', NULL, NULL),
(2, 'Stock Out', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_types`
--

CREATE TABLE `transaction_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_types`
--

INSERT INTO `transaction_types` (`id`, `type_name`, `created_at`, `updated_at`) VALUES
(1, 'Delivery', NULL, NULL),
(2, 'Transfer', NULL, NULL),
(3, 'Sales', NULL, NULL),
(4, 'Unbox', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'pc', NULL, NULL),
(2, 'meter', NULL, NULL),
(3, 'pair', '2021-11-30 02:09:17', '2021-11-30 02:09:17'),
(4, 'pack', '2022-01-04 00:42:06', '2022-01-04 00:42:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `position_id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `access_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `position_id`, `store_id`, `role_id`, `access_id`, `first_name`, `middle_name`, `last_name`, `username`, `password`, `is_active`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 'Renz Marion', 'San Felipe', 'Martinez', 'renzshock', '$2y$10$gJm/fYV/EKkKQKn/LC3gu.oBMlcczB4zrvurWeMTpH/h2LaPHbpku', 0, 'profile-618c8572140fd.jpg', 'apQXpJE8GKVZw7a7df0tnlQzi91so8Ex4eifQ95LjSLfdh17QMJ1y4yVvXKh', NULL, '2021-11-11 02:52:41'),
(2, 4, 5, 2, 2, 'Bea Nizza', 'Cahanap', 'Bilutan', 'bea nizza', '$2y$10$u6UOTXbRlI/JKkW0wyuXN.OMzaChJO.BnZ0v2dE1Mri.sU/I70hNa', 0, 'default-profile-pic.jpg', '48SazrSp4X0LbGiLRuUhpR4IzmfZfmc3RpoIgixa0gQtfFzr6EB4usG2p5zF', NULL, '2021-12-10 02:42:51'),
(3, 2, 3, 1, 3, 'Ryan', 'Regalado', 'Getusper', 'ryan', '$2y$10$YWsY7lCL0oudCQxhNp3H7OVlx8t5O9jQpdYrw6gSBgz/.qpTLRmv2', 0, 'default-profile-pic.jpg', 'evehCHVCMtw0p9WWi4IFifK5QMSypdcr9Yk0dsBAzMjEnydk251KumARMTTX', NULL, '2021-11-30 01:58:55'),
(4, 2, 4, 2, 2, 'Ronald', 'M', 'Arevalo', 'ronald', '$2y$10$MQnsS1.og3iq.ZJvcws9cO9Y3R3gXxU8YHhwTwbygeSVPnE3lnhrO', 0, 'default-profile-pic.jpg', 'IspyEJddwlebNp1171US3RylDd5qSCp9LNVX4nWAR4ThHM2Mpt3qBmuBPcjr', NULL, '2021-11-18 08:32:55'),
(5, 3, 2, 1, 2, 'Enrico', 'Vallesteros', 'Alcantara', 'enrico', '$2y$10$CXtJppvG2dmkaa6DzwsKCeI5F6u6R..01Z7GCe1rvMDGs3a2y18gi', 0, 'default-profile-pic.jpg', 'cZtqDvaoLB85y1IR4uPugMO8IeYM1XsWx6gLxcwbpYxyoh784OOKXvV5WIrR', '2021-11-18 07:57:06', '2021-11-18 07:57:06'),
(6, 5, 1, 1, 1, 'Albert Hax', 'N.', 'Cahanap', 'albert', '$2y$10$CXtJppvG2dmkaa6DzwsKCeI5F6u6R..01Z7GCe1rvMDGs3a2y18gi', 0, 'default-profile-pic.jpg', 'gfJcSAlxm3W6HMIFue9j7SAd5wvXfiqpKfpjajidZO2yD9AvTGFBYDIC6Ure', '2021-11-18 07:57:06', '2021-11-18 07:57:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accesses`
--
ALTER TABLE `accesses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand_colors`
--
ALTER TABLE `brand_colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location_names`
--
ALTER TABLE `location_names`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `repairs`
--
ALTER TABLE `repairs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `return_to_suppliers`
--
ALTER TABLE `return_to_suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `return_to_supplier_items`
--
ALTER TABLE `return_to_supplier_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transacted_items`
--
ALTER TABLE `transacted_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_cancelations`
--
ALTER TABLE `transaction_cancelations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_comments`
--
ALTER TABLE `transaction_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_types`
--
ALTER TABLE `transaction_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accesses`
--
ALTER TABLE `accesses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `brand_colors`
--
ALTER TABLE `brand_colors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `location_names`
--
ALTER TABLE `location_names`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `repairs`
--
ALTER TABLE `repairs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `return_to_suppliers`
--
ALTER TABLE `return_to_suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `return_to_supplier_items`
--
ALTER TABLE `return_to_supplier_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transacted_items`
--
ALTER TABLE `transacted_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `transaction_cancelations`
--
ALTER TABLE `transaction_cancelations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaction_comments`
--
ALTER TABLE `transaction_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaction_types`
--
ALTER TABLE `transaction_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
