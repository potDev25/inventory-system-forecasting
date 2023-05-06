-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2023 at 09:35 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'inventoryAdmin', '$2y$10$ISqeObzBE4EhRFAC/JA1AOD5owTWjlUJ.ENXSDF5zlykbTraiXPGi', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `user_id`, `product_category`, `description`, `created_at`, `updated_at`) VALUES
(3, 4, 'Beauty Products', 'sadfasdff', '2022-12-26 23:14:55', '2022-12-26 23:14:55'),
(4, 4, 'Can Goods', 'sdafjkdhfkj', '2022-12-27 00:49:59', '2022-12-27 00:49:59'),
(5, 4, 'Milk', 'sdvsdf', '2023-01-09 04:34:47', '2023-01-09 04:34:47'),
(7, 1, 'Beauty Products', 'lkuhk', '2023-01-09 06:10:34', '2023-01-09 06:10:34'),
(8, 1, 'Milk', 'fsadfdaf', '2023-01-09 06:11:19', '2023-01-09 06:11:19'),
(9, 4, 'School Supplies', 's.akjdf', '2023-01-10 00:05:09', '2023-01-10 00:05:09'),
(10, 4, 'Kitchen Utensils', 'jlhdj', '2023-01-10 00:24:10', '2023-01-10 00:24:10');

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
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) NOT NULL,
  `receive_id` bigint(20) NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `income` int(11) DEFAULT NULL,
  `total_sales` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sales` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `user_id`, `product_id`, `receive_id`, `date`, `income`, `total_sales`, `sales`, `created_at`, `updated_at`) VALUES
(1487, 4, 3170, 22, 'January,2023', 8275, '12275', 491, '2023-01-08 05:13:21', '2023-01-10 00:17:11'),
(1488, 4, 3171, 23, 'January,2023', 42000, '62000', 310, '2023-01-08 07:43:26', '2023-01-10 00:17:34'),
(1489, 4, 3172, 24, 'January,2023', -3500, '1500', 50, '2023-01-08 07:54:30', '2023-01-08 07:54:47'),
(1490, 4, 3173, 25, 'January,2023', -4400, '600', 20, '2023-01-08 07:56:10', '2023-01-08 07:56:23'),
(1491, 4, 3174, 26, 'January,2023', -1000, '200', 20, '2023-01-08 07:59:05', '2023-01-08 08:01:20'),
(1492, 4, 3175, 27, 'January,2023', 600, '3000', 200, '2023-01-08 08:00:00', '2023-01-08 08:01:39'),
(1493, 4, 3176, 28, 'January,2023', -3000, '3000', 50, '2023-01-08 08:00:58', '2023-01-08 08:01:50'),
(1494, 4, 3170, 29, 'February,2023', -1500, '2500', 100, '2023-01-08 20:03:16', '2023-01-08 20:03:37'),
(1495, 4, 3175, 30, 'February,2023', 600, '3000', 200, '2023-01-08 20:07:55', '2023-01-08 20:08:44'),
(1496, 1, 3177, 31, 'January,2023', 2000, '2500', 100, '2023-01-09 06:15:48', '2023-01-09 06:16:39'),
(1498, 4, 3178, 33, 'January,2023', 1000, '4000', 200, '2023-01-10 00:12:11', '2023-01-10 00:13:32'),
(1499, 4, 3175, 34, 'March,2023', -500, '1500', 100, '2023-01-10 00:19:52', '2023-01-10 00:20:14'),
(1500, 4, 3179, 35, 'March,2023', -3500, '4000', 100, '2023-01-10 00:30:13', '2023-01-10 00:31:35');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_files`
--

CREATE TABLE `inventory_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(6, '2014_10_12_000000_create_users_table', 1),
(7, '2014_10_12_100000_create_password_resets_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(10, '2022_12_08_011225_create_verify_emails_table', 1),
(11, '2022_12_08_143405_create_inventory_files_table', 1),
(12, '2022_12_08_143621_create_inventories_table', 1),
(13, '2022_12_10_093751_create_products_table', 2),
(14, '2022_12_12_045228_create_admins_table', 3),
(15, '2022_12_27_063736_create_categories_table', 4),
(16, '2023_01_06_034701_create_recieves_table', 5);

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
  `user_id` int(11) NOT NULL,
  `product_name` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_category` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_description` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remaining_quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `product_name`, `product_category`, `product_description`, `remaining_quantity`, `created_at`, `updated_at`) VALUES
(3170, 4, 'Bearbrand', 'Can Goods', 'testing', '9', '2023-01-05 18:42:39', '2023-01-10 00:17:11'),
(3171, 4, 'Make Up', 'Beauty Products', 'kjh', '90', '2023-01-05 18:45:38', '2023-01-10 00:17:34'),
(3172, 4, 'Sardines', 'Can Goods', 'dfdaf', '150', '2023-01-08 00:29:06', '2023-01-08 07:54:47'),
(3173, 4, 'Youngs Town', 'Can Goods', 'sda.fkjhsdfj', '180', '2023-01-08 00:29:21', '2023-01-08 07:56:23'),
(3174, 4, 'Piatos', 'Can Goods', 'asfsdfdf', '180', '2023-01-08 07:57:23', '2023-01-08 08:01:20'),
(3175, 4, 'Nova', 'Can Goods', 'lkjhk', '100', '2023-01-08 07:57:40', '2023-01-10 00:20:14'),
(3176, 4, 'Corn Beaf(Pure Foods)', 'Can Goods', 'sdakfhlksjdf', '50', '2023-01-08 07:58:04', '2023-01-08 08:01:50'),
(3177, 1, 'Bearbrand', 'Beauty Products', 'kljhlkj', '100', '2023-01-09 06:14:54', '2023-01-09 06:16:39'),
(3178, 4, 'Notebook', 'School Supplies', 'lskjdhfjsdf', '0', '2023-01-10 00:05:51', '2023-01-10 00:13:31'),
(3179, 4, 'Knife', 'Kitchen Utensils', 'etgef', '150', '2023-01-10 00:25:38', '2023-01-10 00:31:35');

-- --------------------------------------------------------

--
-- Table structure for table `recieves`
--

CREATE TABLE `recieves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_received` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiry_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recieves`
--

INSERT INTO `recieves` (`id`, `product_id`, `user_id`, `barcode`, `date_received`, `expiry_date`, `stock`, `price`, `unit`, `amount`, `created_at`, `updated_at`) VALUES
(22, 3170, 4, '250022', 'January,2023', '2023-01-26', '200', '25', 'Pack', '4000', '2023-01-08 05:13:21', '2023-01-08 05:13:21'),
(23, 3171, 4, '250025', 'January,2023', '2023-02-04', '200', '200', 'Pack', '20000', '2023-01-08 07:43:26', '2023-01-08 07:43:26'),
(24, 3172, 4, '2500222', 'January,2023', '2023-02-03', '200', '30', 'Pack', '5000', '2023-01-08 07:54:30', '2023-01-08 07:54:30'),
(25, 3173, 4, '25002026', 'January,2023', '2023-01-21', '200', '30', 'Pack', '5000', '2023-01-08 07:56:10', '2023-01-08 07:56:10'),
(26, 3174, 4, '2500229', 'January,2023', '2023-02-04', '200', '10', 'Pack', '1200', '2023-01-08 07:59:05', '2023-01-08 07:59:05'),
(27, 3175, 4, '25002229', 'January,2023', '2023-01-27', '200', '15', 'Pack', '2400', '2023-01-08 08:00:00', '2023-01-08 08:00:00'),
(28, 3176, 4, '250022265', 'January,2023', '2023-02-08', '100', '60', 'Pack', '6000', '2023-01-08 08:00:58', '2023-01-08 08:00:58'),
(29, 3170, 4, '12002226', 'February,2023', '2023-01-27', '200', '25', 'pack', '4000', '2023-01-08 20:03:16', '2023-01-08 20:03:16'),
(30, 3175, 4, '6965445', 'February,2023', '2023-01-31', '200', '15', 'pack', '2400', '2023-01-08 20:07:55', '2023-01-08 20:07:55'),
(31, 3177, 1, '1200222', 'January,2023', '2023-01-26', '200', '25', 'pack', '500.00', '2023-01-09 06:15:48', '2023-01-09 06:15:48'),
(33, 3178, 4, '9889465465', 'January,2023', '2023-01-27', '200', '20', 'Cartoon', '3000', '2023-01-10 00:12:11', '2023-01-10 00:12:11'),
(34, 3175, 4, '1200222699', 'March,2023', '2023-02-11', '200', '15', 'pack', '2000', '2023-01-10 00:19:52', '2023-01-10 00:19:52'),
(35, 3179, 4, '120022284547', 'March,2023', NULL, '250', '40', 'Box', '7500', '2023-01-10 00:30:13', '2023-01-10 00:30:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(11) NOT NULL DEFAULT 0,
  `allow` int(11) NOT NULL DEFAULT 1,
  `email_verified` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `last_name`, `first_name`, `image`, `business`, `email`, `email_verified_at`, `password`, `active`, `allow`, `email_verified`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Gilboy', 'Brenz', NULL, 'Prince HyperMart', 'apriljoypg@gmail.com', NULL, '$2y$10$R.k7edonew1ZhdgofjmFAeyuRidY2yLz6lSOpiCNPL7ucQP4dZqwu', 0, 1, '1', NULL, '2022-12-09 23:45:12', '2023-01-09 06:19:35'),
(3, 'Dueta', 'John Ralph', NULL, NULL, 'jespecajas@gmail.com', NULL, '$2y$10$8oI9xKSOwMu2B7uMeOzNnOlqQgkJ84MSNOFVavSUhR1KO7cSN.P2.', 1, 0, '0', NULL, '2022-12-10 23:25:59', '2023-01-09 05:36:59'),
(4, 'Neil', 'Bryan', 'logos/Czy5gUXgVk0U4PDtKR1wNYosNvlm88zy88HWZT7z.jpg', 'Prince HyperMart', 'neilbryangaviola02@gmail.com', NULL, '$2y$10$ISqeObzBE4EhRFAC/JA1AOD5owTWjlUJ.ENXSDF5zlykbTraiXPGi', 1, 1, '1', NULL, '2022-12-10 23:26:53', '2023-01-10 00:02:11'),
(5, 'Asombrado', 'Lori Mae', NULL, NULL, 'jclorimae18@gmail.com', NULL, '$2y$10$mi2JaosQpK0E5E9KugbSS.MVK1crIHDW82JBhkDwYZByOU4kTsSYK', 0, 1, '1', NULL, '2022-12-12 02:05:06', '2022-12-12 02:26:25');

-- --------------------------------------------------------

--
-- Table structure for table `verify_emails`
--

CREATE TABLE `verify_emails` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `verify_emails`
--

INSERT INTO `verify_emails` (`user_id`, `token`, `created_at`, `updated_at`) VALUES
(1, '129a49f8e14123c79467ef5876bdbf1542f9c94110578489f3679d2c0679b21dc', '2022-12-09 23:45:12', '2022-12-09 23:45:12'),
(3, '34c995d7b7689074137601f22b9f6f62d000790da8ec8996a9bd18cbfa4111106', '2022-12-10 23:25:59', '2022-12-10 23:25:59'),
(4, '45e6cc631c4a317afbc335f488845e3de25c40268bb9b59c2b681d5ed98bb638b', '2022-12-10 23:26:53', '2022-12-10 23:26:53'),
(5, '50cbd9a083a476b18407973e5faebf2b660e2ee8c159de6dc3e8299ebec3984f0', '2022-12-12 02:05:06', '2022-12-12 02:05:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_files`
--
ALTER TABLE `inventory_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventory_files_user_id_foreign` (`user_id`);

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
-- Indexes for table `recieves`
--
ALTER TABLE `recieves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recieves_product_id_foreign` (`product_id`),
  ADD KEY `recieves_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `verify_emails`
--
ALTER TABLE `verify_emails`
  ADD KEY `verify_emails_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1501;

--
-- AUTO_INCREMENT for table `inventory_files`
--
ALTER TABLE `inventory_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3180;

--
-- AUTO_INCREMENT for table `recieves`
--
ALTER TABLE `recieves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventories`
--
ALTER TABLE `inventories`
  ADD CONSTRAINT `inventories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `inventory_files`
--
ALTER TABLE `inventory_files`
  ADD CONSTRAINT `inventory_files_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `recieves`
--
ALTER TABLE `recieves`
  ADD CONSTRAINT `recieves_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `recieves_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `verify_emails`
--
ALTER TABLE `verify_emails`
  ADD CONSTRAINT `verify_emails_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
