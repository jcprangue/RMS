-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2018 at 07:06 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rms_v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nick` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`, `nick`, `created_at`, `updated_at`) VALUES
(1, 'Purchase Order', 'PO', NULL, NULL),
(2, 'Voucher', 'DV', NULL, NULL),
(3, 'Check', 'CHK', NULL, NULL),
(4, 'RIS', 'RIS', NULL, NULL),
(5, 'Purchase Request', 'PR', NULL, NULL),
(6, 'Purchase Order (TF)', 'POTF', NULL, NULL),
(7, 'Voucher (TF)', 'DVTF', NULL, NULL),
(8, 'Purchase Request (TF)', 'PRTF', NULL, NULL),
(9, 'RIS (TF)', 'RISTF', NULL, NULL),
(10, 'Payroll (Assistance)', 'PRL', NULL, NULL),
(11, 'Leave', 'L', NULL, NULL),
(12, 'BAC', 'BA', NULL, NULL),
(13, 'BER', 'BE', NULL, NULL),
(14, 'Contract Agreement', 'CA', NULL, NULL),
(15, 'NOA / NTP', 'NN', NULL, NULL),
(16, 'Payroll', 'PL', NULL, NULL),
(17, 'Financial Assistance', 'FA', NULL, NULL),
(18, 'Activity Design', 'AD', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `department` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dept_nick` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_` tinyint(5) DEFAULT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci,
  `level1` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department`, `dept_nick`, `img`, `type_`, `slug`, `level1`, `created_at`, `updated_at`) VALUES
(1, 'Office of the Governor', 'GO', NULL, 1, 'PGOrM-GO', 1, '2018-06-14 00:01:17', '2018-07-25 19:21:11'),
(2, 'Provincial Administrator\'s Office', 'PA', NULL, 1, 'PGOrM-PA', 1, '2018-06-14 00:01:17', '2018-07-25 19:22:22'),
(3, 'Provincial Human Resource Management Office', 'PHRMO', NULL, 2, 'PGOrM-PHRMO', 1, '2018-06-14 00:01:17', '2018-06-14 00:01:17'),
(4, 'Office of the Vice Governor and Sangguniang Panlalawigan', 'OVG / SP', NULL, 1, 'PGOrM-OVGSP', 1, '2018-06-14 00:01:17', '2018-06-14 00:01:17'),
(5, 'Provincial Engineering\'s Office', 'PEO', NULL, 1, 'PGOrM-PEO', 1, '2018-06-14 00:01:17', '2018-06-14 00:01:17'),
(6, 'Provincial Legal Office', 'PLO', NULL, 1, 'PGOrM-PLO', 1, '2018-06-14 00:01:17', '2018-06-14 00:01:17'),
(7, 'Office of the Provincial Accountant', 'OPA', NULL, 1, 'PGOrM-OPA', 1, '2018-06-14 00:01:17', '2018-06-14 00:01:17'),
(8, 'Provincial Agriculturist\'s Office', 'PAGO', NULL, 1, 'PGOrM-PAGO', 1, '2018-06-14 00:01:17', '2018-06-14 00:01:17'),
(9, 'Provincial Assessor\'s Office', 'PASO', NULL, 1, 'PGOrM-PASO', 1, '2018-06-14 00:01:17', '2018-06-14 00:01:17'),
(10, 'Provincial Budget Office', 'PBO', NULL, 1, 'PGOrM-PBO', 1, '2018-06-14 00:01:17', '2018-06-14 00:01:17'),
(11, 'Disaster Risk Reduction Management Division', 'DRRMD', NULL, 1, 'PGOrM-DRRMO', 2, '2018-06-14 00:01:17', '2018-06-14 00:01:17'),
(12, 'Provincial Environment and Natural Resources Office ', 'ENRO', NULL, 1, 'PGOrM-ENRO', 1, '2018-06-14 00:01:17', '2018-06-14 00:01:17'),
(13, 'Provincial General Services Office', 'PGSO', NULL, 1, 'PGOrM-GSO', 1, '2018-06-14 00:01:17', '2018-06-14 00:01:17'),
(14, 'Management Information Services Division', 'MIS', NULL, 1, 'PGOrM-MIS', 4, '2018-06-14 00:01:17', '2018-06-14 00:01:17'),
(15, 'Oriental Mindoro Provincial Jail', 'OMPJ', NULL, 1, 'PGOrM-OMPJ', 2, '2018-06-14 00:01:17', '2018-06-14 00:01:17'),
(16, 'Provincial Planning and Development Office', 'PPDO', NULL, 1, 'PGOrM-PPDO', 1, '2018-06-14 00:01:17', '2018-06-14 00:01:17'),
(17, 'Communication and Public Relation Services Division', 'CPRSD', NULL, 1, 'PGOrM-PESO', 2, '2018-06-14 00:01:17', '2018-06-14 00:01:17'),
(18, 'Provincial Social Welfare and Development Office', 'PSWDO', NULL, 1, 'PGOrM-PSWDO', 1, '2018-06-14 00:01:17', '2018-06-14 00:01:17'),
(19, 'Provincial Veterinary Office', 'PROVET', NULL, 1, 'PGOrM-PROVET', 1, '2018-06-14 00:01:17', '2018-06-14 00:01:17'),
(20, 'Provincial Health Office', 'PHO', NULL, 1, 'PGOrM-PHO', 1, '2018-06-14 00:01:17', '2018-06-14 00:01:17'),
(21, 'Oriental Mindoro Provincial Hospital', 'OMPH', NULL, 1, 'PGOrM-OMPH', 3, '2018-06-14 00:01:17', '2018-06-14 00:01:17'),
(22, 'Oriental Mindoro Central District Hospital', 'OMCDH', NULL, 1, 'PGOrM-OMCDH', 3, '2018-06-14 00:01:17', '2018-06-14 00:01:17'),
(23, 'Oriental Mindoro Southern District Hospital', 'OMSDH', NULL, 1, 'PGOrM-OMSDH', 3, '2018-06-14 00:01:17', '2018-06-14 00:01:17'),
(24, 'Bulalacao Community Hospital', 'BCH', NULL, 1, 'PGOrM-BCH', 3, '2018-06-14 00:01:17', '2018-06-14 00:01:17'),
(25, 'Drug Rehab Center', 'DRC', NULL, 1, 'PGOrM-DRC', 3, '2018-06-14 00:01:17', '2018-06-14 00:01:17'),
(26, 'Naujan Community Hospital', 'NCH', NULL, 1, 'PGOrM-NCH', 3, '2018-06-14 00:01:17', '2018-06-14 00:01:17'),
(27, 'Provincial Tourism, Investment and Enterprise Development Office', 'PTIEDO', NULL, 1, 'PGOrM-PTIEDO', 1, '2018-06-14 00:01:17', '2018-06-14 00:01:17'),
(28, 'Botika ng Lalawigan ng Oriental Mindoro', 'BLOM', NULL, 1, 'PGOrM-BLOM', 2, '2018-06-14 00:01:17', '2018-06-14 00:01:17'),
(32, 'Management Support Staff Division', 'MSSD / EA', NULL, 1, 'PGOrM-GO-MSSD', 2, '2018-06-14 00:01:17', '2018-06-14 00:01:17'),
(34, 'Internal Audit and Services Division ', 'IASD', NULL, 1, 'PGOrM-GO-IASD', 2, '2018-06-14 00:01:17', '2018-06-14 00:01:17'),
(35, 'Language Skills Institution', 'LSI', NULL, 1, 'PGOrM-LSI', 2, '2018-06-14 00:01:17', '2018-06-14 00:01:17'),
(37, 'Special Concerns Division', 'SCD', NULL, 1, 'PGOrM-GO-SCD', 2, '2018-06-14 00:01:17', '2018-06-14 00:01:17'),
(41, 'Provincial Treasurer\'s Office', 'PTO', NULL, 1, 'PGOrM-PTO', 1, '2018-06-14 00:01:17', '2018-06-14 00:01:17'),
(42, 'Education and Employment Services Division', 'EESD', NULL, 1, 'PGOrM-EESD', 2, '2018-06-14 00:01:17', '2018-06-14 00:01:17'),
(43, 'Strategic Intervention and Community-Focused Action Towards Development', 'SICAD', NULL, 1, 'PGOrM-SICAD', 2, '2018-06-14 00:01:17', '2018-06-14 00:01:17');

-- --------------------------------------------------------

--
-- Table structure for table `doc_update`
--

CREATE TABLE `doc_update` (
  `id` int(10) UNSIGNED NOT NULL,
  `document` int(11) DEFAULT NULL,
  `doc_update` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fa_category`
--

CREATE TABLE `fa_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `type_fa` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nick` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fa_category`
--

INSERT INTO `fa_category` (`id`, `type_fa`, `nick`, `created_at`, `updated_at`) VALUES
(1, 'Transportation', 'TRANSPO', NULL, NULL),
(2, 'RA (Victim of Abuse)', 'RA', NULL, NULL),
(3, 'Medical', 'MEDICAL', NULL, NULL),
(4, 'Balik Probinsya', 'BP', NULL, NULL),
(5, 'Burial', 'BURIAL', NULL, NULL),
(6, 'Emergency Shelter Assistance (ESA)', 'ESA', NULL, NULL),
(7, 'Self Employed Assitance (SEA)', 'SEA', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `incomings`
--

CREATE TABLE `incomings` (
  `id` int(10) UNSIGNED NOT NULL,
  `control_num` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_receive` date NOT NULL,
  `office` int(11) DEFAULT NULL,
  `particulars` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` int(11) DEFAULT NULL,
  `amount` decimal(20,2) DEFAULT NULL,
  `check_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_leave` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_leave` text COLLATE utf8mb4_unicode_ci,
  `fa_category` int(11) DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `verified` datetime DEFAULT NULL,
  `verified_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_09_25_064603_create_categories_table', 1),
(4, '2018_09_26_130510_create_doc_update_table', 1),
(5, '2018_09_27_103307_create_outgoings_table', 1),
(6, '2018_10_25_085826_create_incomings_table', 1),
(7, '2018_12_03_114517_create_table_fa_category', 2);

-- --------------------------------------------------------

--
-- Table structure for table `outgoings`
--

CREATE TABLE `outgoings` (
  `id` int(10) UNSIGNED NOT NULL,
  `control_num` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_receive` date NOT NULL,
  `office` int(11) DEFAULT NULL,
  `particulars` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` int(11) DEFAULT NULL,
  `amount` decimal(20,2) DEFAULT NULL,
  `check_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_leave` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_leave` text COLLATE utf8mb4_unicode_ci,
  `fa_category` int(11) DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acl` int(11) NOT NULL DEFAULT '2',
  `category` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `acl`, `category`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Christopher Prangue', 'admin', NULL, '$2y$10$g2kgeP9ytUgkFzsavpUvdu9bxdarA6GnZT5XS0oLEEhK51nT8hvj6', 1, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18', 'w0MeVfYIunZcM1X6Lra7skfwscgRzFUxecY88usK3XPsAafsAA9gVVblk1sj', '2018-11-22 00:47:23', '2018-11-22 00:47:23'),
(2, 'Neilson Arellano', 'neilson', NULL, '$2y$10$g2kgeP9ytUgkFzsavpUvdu9bxdarA6GnZT5XS0oLEEhK51nT8hvj6', 2, '1,2,3,4,5,16,17', 'ZS8XYcboijTXKWQiLyQLJNSBhmq0CM3z9aDgFVUW552zKuW83hOKeMyIS4eH', '2018-11-22 00:47:23', '2018-11-22 00:47:23'),
(3, 'Whenie May Momog', 'whenie', NULL, '$2y$10$g2kgeP9ytUgkFzsavpUvdu9bxdarA6GnZT5XS0oLEEhK51nT8hvj6', 5, '6,7,8,9,10,11,12,13,14,15', 'BOkBPDsuHOygoRpRrdFq5RAjSIpzeaaA9IcZUlhHya7ndKkRxmrfy7QKMYrC', '2018-11-22 00:47:23', '2018-11-22 00:47:23'),
(4, 'Cecille', 'cecille', NULL, '$2y$10$g2kgeP9ytUgkFzsavpUvdu9bxdarA6GnZT5XS0oLEEhK51nT8hvj6', 4, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18', 'aBx8ASKqJpeJbuCtKb60JRNHH00UN9hqQlAWWHB27smpdaT2fbXdXVa1RfhG', '2018-11-22 00:47:23', '2018-11-22 00:47:23'),
(5, 'Marian', 'Marian', NULL, '$2y$10$g2kgeP9ytUgkFzsavpUvdu9bxdarA6GnZT5XS0oLEEhK51nT8hvj6', 3, '1,2,3,4,5,16', 'aRbgaiQqWaO15YNzWyLte3fOgQv6t1Wz5o4EhRcw7lkmo0xPleQF76JwtW20', '2018-11-22 00:47:23', '2018-11-22 00:47:23'),
(6, 'Jennefer De Roxas', 'jen', NULL, '$2y$10$g2kgeP9ytUgkFzsavpUvdu9bxdarA6GnZT5XS0oLEEhK51nT8hvj6', 3, '17,18', 'cknuD9C33wmrYuiDq33pr9I3aaZCrkwZchl0k1Dw9A74rYPObqmk2fUCIkhy', '2018-11-22 00:47:23', '2018-11-22 00:47:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_update`
--
ALTER TABLE `doc_update`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fa_category`
--
ALTER TABLE `fa_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incomings`
--
ALTER TABLE `incomings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `outgoings`
--
ALTER TABLE `outgoings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `doc_update`
--
ALTER TABLE `doc_update`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fa_category`
--
ALTER TABLE `fa_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `incomings`
--
ALTER TABLE `incomings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `outgoings`
--
ALTER TABLE `outgoings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
