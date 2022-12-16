-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 31, 2022 at 10:53 AM
-- Server version: 10.3.36-MariaDB-cll-lve
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ujianon4_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `price` double NOT NULL,
  `subTotal` double DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` int(100) NOT NULL,
  `variant_id` int(100) DEFAULT NULL,
  `user_id` int(100) NOT NULL,
  `customer_id` int(100) DEFAULT NULL,
  `transaction_id` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `name`, `qty`, `price`, `subTotal`, `status`, `created_at`, `updated_at`, `product_id`, `variant_id`, `user_id`, `customer_id`, `transaction_id`) VALUES
(2, 'anjasss', 2, 21.99, 43.98, '1', '2022-09-12 22:32:35', '2022-09-13 17:54:40', 980, NULL, 1, NULL, NULL),
(3, 'cobaaaaaaaa - XL', 3, 112, 336, '1', '2022-09-12 22:37:11', '2022-09-13 17:54:40', 1088, 1090, 1, NULL, NULL),
(8, 'anjasss', 1, 21.99, 21.99, '1', '2022-09-16 13:04:36', '2022-10-07 14:53:19', 980, NULL, 1, 1, 13),
(9, 'anjasss', 1, 21.99, 21.99, '1', '2022-09-16 13:08:40', '2022-10-07 14:53:19', 980, NULL, 1, 3, 13),
(11, 'UFO Buckethat', 1, 35, 35, '1', '2022-09-18 18:19:52', '2022-09-18 19:06:00', 414, NULL, 1, NULL, NULL),
(12, 'PANASONIC AWARD', 1, 35, 35, '1', '2022-09-18 18:46:26', '2022-09-18 19:06:00', 774, NULL, 1, NULL, NULL),
(13, 'PANASONIC AWARD', 1, 35, 35, '1', '2022-09-18 19:06:46', '2022-09-18 19:11:03', 774, NULL, 1, NULL, NULL),
(14, 'PANASONIC AWARD', 1, 35, 35, '1', '2022-09-18 19:11:54', '2022-09-18 19:14:53', 774, NULL, 1, NULL, NULL),
(15, 'PANASONIC AWARD', 1, 35, 35, '1', '2022-09-18 19:27:39', '2022-09-18 19:34:37', 774, NULL, 1, NULL, NULL),
(16, 'UFO Buckethat', 1, 35, 35, '1', '2022-09-18 19:36:19', '2022-09-18 19:37:29', 414, NULL, 1, NULL, 8),
(17, 'PANASONIC AWARD', 1, 35, 35, '1', '2022-09-18 20:06:52', '2022-09-18 20:07:56', 774, NULL, 1, NULL, 9),
(18, 'UFO Buckethat', 1, 35, 35, '1', '2022-09-18 20:06:59', '2022-09-18 20:07:56', 414, NULL, 1, NULL, 9),
(21, 'Blotter Baru - L', 1, 35, 35, '1', '2022-09-24 11:27:40', '2022-10-05 02:27:25', 1123, 1126, 5, NULL, 9),
(22, 'Blotter Baru - L', 1, 35, 35, '1', '2022-09-24 11:27:43', '2022-10-05 02:27:25', 1123, 1126, 5, NULL, 9),
(23, 'Blotter Baru - XL', 1, 35, 35, '1', '2022-10-05 02:29:15', '2022-10-05 02:29:55', 1123, 1127, 1, NULL, 11),
(24, 'Blotter Baru - XL', 1, 35, 35, '1', '2022-10-05 02:40:05', '2022-10-05 02:41:45', 1123, 1127, 1, NULL, 12),
(25, 'Blotter Baru - XL', 1, 35, 35, '0', '2022-10-11 15:23:35', '2022-10-11 15:23:35', 1123, 1127, 5, NULL, NULL),
(28, 'Blotter Baru - XL', 1, 35, 35, '0', '2022-10-24 05:32:21', '2022-10-24 05:32:21', 1123, 1127, 6, NULL, NULL),
(29, 'editt', 1, 333, 333, '0', '2022-10-31 02:17:16', '2022-10-31 02:17:16', 1111, NULL, 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_track` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_id`, `discount`, `created_at`, `updated_at`, `name`, `customer_track`) VALUES
(3, '7', '1', '2022-10-05 02:39:39', '2022-10-05 02:39:39', 'rizky putra', 'dqwdwq');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `name`, `discount`, `created_at`, `updated_at`) VALUES
(1, 'univv', '100', '2022-09-18 17:27:16', '2022-09-18 17:27:16'),
(2, 'test', '20%', '2022-10-19 14:50:17', '2022-10-19 14:50:17'),
(3, 'test', '20', '2022-10-24 05:27:38', '2022-10-24 05:27:38');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `name`, `price`, `created_at`, `updated_at`) VALUES
(3, 'ss', 20, '2022-09-06 11:31:57', '2022-09-13 17:55:39'),
(4, 'bayar listrik', 200000, '2022-10-11 15:28:01', '2022-10-11 15:28:01');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `labels`
--

CREATE TABLE `labels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `qty` int(50) NOT NULL DEFAULT 1,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_pirce` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `labels`
--

INSERT INTO `labels` (`id`, `user_id`, `product_id`, `status`, `created_at`, `updated_at`, `qty`, `name`, `unit_pirce`) VALUES
(16, 5, '1116', '0', '2022-10-06 11:09:00', '2022-10-06 11:09:00', 1, 'ddqwdqw', 22),
(17, 5, '1127', '0', '2022-10-06 11:09:13', '2022-10-06 11:09:13', 1, 'Blotter Baru - XL', 35),
(18, 5, '414', '0', '2022-10-07 16:53:06', '2022-10-07 16:53:06', 1, 'UFO Buckethat', 35),
(19, 5, '513', '0', '2022-10-07 16:54:10', '2022-10-07 16:54:10', 1, 'PRODUK-002 - XL', 35),
(21, 5, '1116', '0', '2022-10-11 15:12:54', '2022-10-11 15:12:54', 1, 'ddqwdqw', 22),
(22, 5, '1116', '0', '2022-10-11 15:13:07', '2022-10-11 15:13:07', 1, 'ddqwdqw', 22),
(23, 5, '1127', '0', '2022-10-11 15:13:23', '2022-10-11 15:13:23', 1, 'Blotter Baru - XL', 35),
(24, 5, '414', '0', '2022-10-14 12:11:39', '2022-10-14 12:11:39', 1, 'UFO Buckethat', 35),
(25, 1, '1127', '0', '2022-10-17 13:41:56', '2022-10-17 13:41:56', 1, 'Blotter Baru - XL', 35),
(26, 1, '411', '0', '2022-10-17 14:04:11', '2022-10-17 14:04:11', 1, 'Bondage Rabbit 2ND Blotter Anniversary Knitted Vest - XL', 60),
(27, 1, '414', '0', '2022-10-17 14:06:15', '2022-10-17 14:06:15', 1, 'UFO Buckethat', 35),
(30, 6, '1116', '0', '2022-10-19 15:13:22', '2022-10-19 15:13:22', 1, 'ddqwdqw', 22);

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_09_06_165107_create_products_table', 2),
(6, '2022_09_06_181211_create_expenses_table', 3),
(7, '2022_09_13_024928_create_carts_table', 4),
(8, '2022_09_13_223928_create_customers_table', 5),
(9, '2022_09_17_233842_create_discounts_table', 6),
(10, '2022_09_18_233047_create_transactions_table', 6),
(11, '2022_09_21_185040_create_labels_table', 7);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `api_product_api` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_modal` double NOT NULL,
  `price_sale` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `barcode` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `api_product_api`, `price_modal`, `price_sale`, `created_at`, `updated_at`, `barcode`) VALUES
(1, '896', 100000, 150000, '2022-09-06 10:27:54', '2022-09-06 10:27:54', 'qrcode'),
(2, '898', 100000, 44444444, '2022-09-09 11:10:09', '2022-09-09 11:10:09', 'barcode128'),
(3, '900', 100000, 44444444, '2022-09-09 11:12:23', '2022-09-09 11:12:23', 'barcode128'),
(4, '902', 10, 5002, '2022-09-09 11:14:19', '2022-09-09 11:14:19', 'barcode128'),
(5, '904', 12, 2121, '2022-09-09 11:18:28', '2022-09-09 11:18:28', 'barcode128'),
(6, '918', 22, 3333, '2022-09-09 11:42:18', '2022-09-09 11:42:18', 'qrcode'),
(7, '920', 22, 500, '2022-09-09 11:43:49', '2022-09-09 11:43:49', 'barcode128'),
(8, '938', 22222222, 23333333, '2022-09-09 11:52:06', '2022-09-09 11:52:06', 'barcode128'),
(9, '957', 22222222, 23333333, '2022-09-09 11:59:03', '2022-09-09 11:59:03', 'barcode128'),
(10, '961', 22222222, 23333333, '2022-09-09 12:10:22', '2022-09-09 12:10:22', 'barcode128'),
(11, '974', 22222222, 23333333, '2022-09-09 12:17:56', '2022-09-09 12:17:56', 'barcode128'),
(12, '982', 22222222, 23333333, '2022-09-09 12:24:41', '2022-09-09 12:24:41', 'barcode128'),
(13, '986', 122222, 500, '2022-09-09 12:28:24', '2022-09-09 12:28:24', 'barcode128'),
(14, '990', 122222, 500, '2022-09-09 12:31:30', '2022-09-09 12:31:30', 'barcode128'),
(15, '994', 122222, 500, '2022-09-09 12:35:18', '2022-09-09 12:35:18', 'barcode128'),
(16, '1006', 122222, 500, '2022-09-09 12:40:03', '2022-09-09 12:40:03', 'barcode128'),
(17, '1069', 122222, 500, '2022-09-09 13:07:53', '2022-09-09 13:07:53', 'barcode128'),
(18, '1077', 22, 112, '2022-09-12 19:09:51', '2022-09-12 19:09:51', 'barcode128'),
(19, '1081', 22, 112, '2022-09-12 19:11:27', '2022-09-12 19:11:27', 'barcode128'),
(20, '1085', 10, 223, '2022-09-12 19:22:51', '2022-09-12 19:22:51', 'barcode128'),
(21, '1088', 21, 112, '2022-09-12 19:26:35', '2022-09-12 19:26:35', 'barcode128'),
(22, '1109', 22, 333, '2022-09-20 12:20:46', '2022-09-20 12:20:46', 'barcode128'),
(23, '1111', 21, 333, '2022-09-20 13:24:59', '2022-09-20 13:29:09', 'barcode128'),
(24, '1116', 21, 22, '2022-09-23 16:27:06', '2022-09-23 16:27:06', 'barcode128'),
(25, '1118', 22, 222, '2022-09-23 16:31:12', '2022-09-23 16:31:12', 'barcode128'),
(26, '1123', 12, 35, '2022-09-24 11:06:18', '2022-09-24 11:06:18', 'barcode128');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount_pay` int(100) DEFAULT NULL,
  `note_pay` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hold` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `customer_id`, `created_at`, `updated_at`, `order`, `amount_pay`, `note_pay`, `hold`) VALUES
(12, 7, '2022-10-05 02:41:45', '2022-10-05 02:41:45', '1133', 22, 'hehehe', 'no'),
(13, 7, '2022-10-07 14:53:19', '2022-10-07 14:53:19', '1134', 22, 'dqwdqw', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'biasa',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'rizky putra', 'riskipatra5@gmail.com', NULL, '$2y$10$ilWzvUdVodKikuONYGyvtug5ASKX8hcWcrvUa4g3pmj1EBger4XRG', 'admin', 'p3bwoM3UjeK3z8dvDLxOVQby5vnT8rJtLZG1Jg7znusBiIOTbQAAsXlxNQOE', '2022-08-22 22:54:56', '2022-08-22 22:54:56'),
(2, 'riski putra', 'riskipatra11@gmail.com', NULL, '$2y$10$IrIMG3RB.PTNkFsyzaZZbuwynKyWumOjqbSjpHhimVBqnZrfA9QXa', 'biasa', NULL, '2022-09-19 08:48:32', '2022-09-19 08:48:32'),
(5, 'tbr', 'theblotterroom@workethicstudio.com', NULL, '$2y$10$aM1cJRvLeRuQ1Wfcr.0Use./KW/eLwzvvvPHobRIk4S0hQC1GDAm6', 'admin', NULL, '2022-09-22 09:51:22', '2022-09-22 09:51:22'),
(6, 'Musa', 'musaalfarid@gmail.com', NULL, '$2y$10$eUyOFqLNjHxaQzKFsvfXbOZLyl/2TmEn2F5h9xkZsoxx4JifQ.oYm', 'admin', NULL, '2022-09-23 17:39:23', '2022-09-23 17:39:23'),
(7, 'theblotterroom', 'theblotterroom@gmail.com', NULL, '$2y$10$jq7yNj5hJPTSGqfilid.J.RFJPF51qOghv/lThXBE8IUw/qKh/T1O', 'biasa', NULL, '2022-10-03 10:49:45', '2022-10-03 10:49:45'),
(8, 'abirusabil', 'm.abirusabil1@gmail.com', NULL, '$2y$10$6on9DPwGv/9Ap1wwewhJROBuKnFUy.bRYyNaGze.vh2jiRW1NclmW', 'biasa', NULL, '2022-10-25 06:19:20', '2022-10-25 06:19:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `labels`
--
ALTER TABLE `labels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `labels_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `labels`
--
ALTER TABLE `labels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `labels`
--
ALTER TABLE `labels`
  ADD CONSTRAINT `labels_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
