-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2025 at 02:39 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 5, '2025-01-12 17:06:28', '2025-01-12 17:06:28');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `landlord_id` bigint(20) UNSIGNED NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `original_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `landlord_id`, `file_path`, `original_name`, `created_at`, `updated_at`) VALUES
(1, 6, 'landlord_documents/Deed Sample.pdf', 'Deed Sample.pdf', '2025-01-20 08:06:18', '2025-01-20 08:06:18');

-- --------------------------------------------------------

--
-- Table structure for table `landlords`
--

CREATE TABLE `landlords` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `address` text DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `phoneno` varchar(10) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `landlords`
--

INSERT INTO `landlords` (`id`, `user_id`, `address`, `gender`, `phoneno`, `dob`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 'f', '0149550314', '2004-11-09', '2025-01-12 17:06:28', '2025-01-12 20:05:34'),
(2, 3, NULL, 'm', '0145944032', '2002-09-17', '2025-01-12 17:06:28', '2025-01-12 20:06:51'),
(3, 4, NULL, 'm', '0159550493', '1999-07-22', '2025-01-12 17:06:28', '2025-01-12 20:07:54'),
(4, 6, 'No 25, Jalan Pandan Indah 5/24\r\nPandan Indah 55100 Kuala Lumpur', 'f', '0176682344', '2000-04-25', '2025-01-12 17:06:28', '2025-01-12 20:08:40'),
(5, 7, NULL, 'f', '0160449302', '1999-08-18', '2025-01-12 17:06:28', '2025-01-12 20:09:52'),
(6, 8, 'No 25, Jalan Pandan Indah 5/24\r\nPandan Indah 55100 Kuala Lumpur', 'f', '0145944032', '1996-07-02', '2025-01-12 17:06:28', '2025-01-20 08:06:18'),
(7, 9, NULL, 'f', '0174039410', '2003-06-18', '2025-01-12 17:06:28', '2025-01-12 20:11:51'),
(8, 10, NULL, 'f', '0180449302', '2001-07-08', '2025-01-12 17:06:28', '2025-01-12 20:12:47'),
(9, 11, NULL, 'f', '0194403921', '2001-08-08', '2025-01-12 17:06:28', '2025-01-12 20:14:25'),
(10, 12, NULL, 'f', '0119504432', '1998-11-22', '2025-01-12 17:06:29', '2025-01-12 20:15:29'),
(11, 13, NULL, 'm', '0185504921', '2004-08-04', '2025-01-12 17:06:29', '2025-01-12 20:16:48'),
(12, 14, NULL, 'm', '0160049321', '2001-04-24', '2025-01-12 17:06:29', '2025-01-12 20:18:38'),
(13, 15, NULL, 'm', '0149950315', '1996-12-05', '2025-01-12 17:06:29', '2025-01-12 20:19:59'),
(14, 16, NULL, 'm', '0119504924', '1995-06-08', '2025-01-12 17:06:29', '2025-01-12 20:20:56'),
(15, 17, NULL, 'm', '0196605941', '2002-03-07', '2025-01-12 17:06:29', '2025-01-12 20:22:02'),
(16, 18, NULL, 'm', '0159403200', '2000-08-09', '2025-01-12 17:06:29', '2025-01-12 20:23:18'),
(17, 19, NULL, 'f', '0178660531', '1996-12-04', '2025-01-12 17:06:29', '2025-01-12 20:24:03'),
(18, 20, 'No 25, Jalan Pandan Indah 5/24\r\nPandan Indah 55100 Kuala Lumpur', 'f', '0140059325', '1993-10-10', '2025-01-12 17:06:29', '2025-01-19 18:17:19'),
(19, 56, 'No 25, Jalan Pandan Indah 5/24\r\nPandan Indah 55100 Kuala Lumpur', 'f', '0176682344', '2025-02-02', '2025-01-20 10:07:03', '2025-02-02 06:44:45'),
(20, 57, NULL, NULL, NULL, NULL, '2025-02-07 08:46:25', '2025-02-07 08:46:25'),
(21, 58, NULL, NULL, NULL, NULL, '2025-02-07 08:48:46', '2025-02-07 08:48:46'),
(22, 59, NULL, NULL, NULL, NULL, '2025-02-07 08:51:48', '2025-02-07 08:51:48'),
(23, 60, NULL, NULL, NULL, NULL, '2025-02-07 08:52:49', '2025-02-07 08:52:49');

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
(41, '2014_10_12_000000_create_users_table', 1),
(42, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(43, '2014_10_12_100000_create_password_resets_table', 1),
(44, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(45, '2024_06_22_072448_create_students_table', 1),
(46, '2024_06_22_072454_create_admins_table', 1),
(47, '2024_06_22_072501_create_landlords_table', 1),
(48, '2024_11_02_201228_create_documents_table', 1),
(49, '2024_11_03_010103_create_properties_table', 1),
(50, '2024_11_03_230819_create_property_media_table', 1),
(51, '2024_11_26_214438_create_user_property_interactions_table', 1),
(52, '2024_06_22_080000_create_appointments_table', 2),
(53, '2024_06_24_074444_create_payments_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('syahirahmansor58@gmail.com', '$2y$10$aXvgaKA5TY0qRim5wBD0revAiz17AAbPejN8sbTbu/pBUPwxjeJCi', '2025-02-10 17:38:27');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `landlord_id` bigint(20) UNSIGNED NOT NULL,
  `property_name` varchar(255) NOT NULL,
  `property_number` varchar(10) NOT NULL,
  `price` varchar(255) NOT NULL,
  `types` enum('landed','room','high-rise') NOT NULL,
  `utilities` tinyint(3) UNSIGNED DEFAULT 0,
  `rooms` tinyint(3) UNSIGNED DEFAULT 10,
  `parking` tinyint(3) UNSIGNED DEFAULT 10,
  `furnished` enum('fully','partially','unfurnished') NOT NULL,
  `map_link` text DEFAULT NULL,
  `tenant` enum('male','female') NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `contract` tinyint(3) UNSIGNED DEFAULT 12,
  `apply_date` timestamp NULL DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` varchar(50) DEFAULT 'in progress',
  `remark` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `landlord_id`, `property_name`, `property_number`, `price`, `types`, `utilities`, `rooms`, `parking`, `furnished`, `map_link`, `tenant`, `contact_number`, `contract`, `apply_date`, `message`, `status`, `remark`, `created_at`, `updated_at`) VALUES
(1, 1, 'Brunsfield Riverview Apartment, Sek 13 Shah Alam', '24423', '500', 'room', 6, 3, 2, 'fully', 'https://maps.app.goo.gl/tN883XKEUM3xmUHp6', 'female', '0149550314', 12, '2025-01-12 16:00:00', '!!Suitable form 7-8 peoples!!\r\n1) Master Room - Max 4 person - RM1000 (RM250 x 4)\r\n2) 2nd Room - Max 2 person  - RM700 (RM350 x 2)\r\n3) 3rd Room - Max 2 Person - RM500 (RM250 x 2)\r\n*Entire House - RM2100 (monthly)\r\n\r\nNearby Amenities:\r\nWalking distance to MSU\r\nPoliteknik Shah Alam - 1km\r\nAeon Shah Alam, Giant, Tesco Extra 5mins driving distance\r\nKDU college, PTPTL, UiTM\r\nBatu Tiga KTM Commuter Station in 1.5km distance\r\nStadium Shah Alam LRT Station (Will complete soon) - 500m\r\n\r\nKindly Contact Owner for further information & viewing appointment', 'Approved', 'approved', '2025-01-12 21:53:08', '2025-01-14 15:42:27'),
(2, 1, 'Apartment Baiduri, Seksyen 7, Shah Alam', '46977', '162.50', 'room', 5, 2, 1, 'fully', 'https://maps.app.goo.gl/BmYUvJBwjenkLWVe7', 'female', '0149550314', 12, '2025-01-07 16:00:00', '‼️REPLACEMENT NEEDED (1 FEMALE)‼️\r\n📌 Berdekatan dgn kdai makan (hakeem lama), 99speedmart, 7e n etc\r\n📌Dobi pun ada dkt area kdai\r\n📌Apartment bersebelahan gate utama uitm\r\n📌Laluan bas \"B\" & SA 01\r\nRM162.50 monthly exc bil api & air \r\nfully furnished', 'Approved', 'approved', '2025-01-12 21:59:36', '2025-01-14 15:49:55'),
(3, 4, 'Pangsapuri Danaumas, Seksyen 7', '91018', '500', 'high-rise', 4, 1, 1, 'fully', 'https://maps.app.goo.gl/cqmgC5bUtvrr1AaH6', 'female', '0176682344', 6, '2025-01-08 16:00:00', 'KEKOSONGAN UNTUK 1 ORANG! \r\nSyarat :-\r\nBekerja diutamakan\r\nPerempuan Muslimah\r\nTidak Merokok\r\nPembersih\r\nBertimbang rasa\r\n\r\n*DEPOSIT*\r\n👉🏻 1 bulan - RM500 \r\n👉🏻 Tenancy agreement - RM50\r\n👉🏻 Sewa bulanan tidak termasuk bil api dan air 😊', 'Approved', 'approved', '2025-01-13 07:00:50', '2025-01-14 15:46:40'),
(4, 4, 'Arte Subang West, Seksyen 13, Shah Alam', '86484', '325', 'room', 6, 2, 1, 'fully', 'https://maps.app.goo.gl/8MVCPhi5ctiErvRH8', 'female', '0176682344', 6, '2025-01-05 16:00:00', 'Arte Subang West Near MSU & Menara U, Seksyen 13, Shah Alam. \r\nFully Furnished. NEW UNIT 2025!\r\n\r\n!!FIRST COME, FIRST SERVE!! \r\n\r\nFEMALE MUSLIM ONLY\r\nRental Room Per Person: \r\nQuadruple Room (4 person) = RM325 (4 SLOTS)\r\n\r\nIf interested, please feel free to contact.', 'Approved', 'approved', '2025-01-13 07:14:50', '2025-01-14 15:51:07'),
(5, 5, 'MENARA U, SHAH ALAM SEKSYEN 13 (Level 16)', '87902', '600', 'room', 4, 1, 1, 'fully', 'https://maps.app.goo.gl/u2kQGumHGjhUAnQw9', 'female', '0160449302', 12, '2025-01-09 16:00:00', '!!STARTING FEBRUARY 2025 INTAKE!!  \r\nFEMALE housemate only  \r\nSingle room\r\n\r\nMonthly rental exclude: \r\nElectricity ⚡️ & Hydro 💧bill  \r\n\r\nAmenities \r\n- Cooking allowed \r\n- Wifi', 'Approved', 'approved', '2025-01-13 07:21:18', '2025-01-14 15:45:25'),
(6, 2, 'Pusat Komersial Seksyen 7, Shah Alam (Blok Q)', '69668', '250', 'room', 4, 3, 1, 'fully', 'https://maps.app.goo.gl/cBSfaAjg9cYiM5Lc9', 'male', '0145944032', 12, '2025-01-01 16:00:00', 'Bilik Master - 3 Kekosongan (Kemasukan Segara)\r\n\r\nSatu rumah 7 org sahaja\r\nBilik master utk 4 org (Still Available)\r\nBilik tengah utk 2 org (occupied)\r\nBilik single utk 1 org (occupied)\r\n\r\nHarga Sewa Bilik Perhead RM250 Harga termasuk Bill Eletrik, Air & Wifi💡 internet\r\n\r\nKemudahan:\r\n➡️ Takda transport takda masalah ada bas percuma\r\n➡️Berdekatan dengan bus stop (Bas, kemudahan bas Uitm & Bas percuma Selangorku)\r\n➡️Berdekatan pintu belakang UiTM\r\n➡️Pelbagai kedai makan & kemudahan\r\n\r\nBerminat Boleh Whatsapp terus untuk tengok rumah.', 'Resubmission', 'Please provide more pictures or videos of your property.', '2025-01-13 07:25:55', '2025-01-14 15:55:10'),
(7, 2, 'DIAN RESIDENCE SEKSYEN 13 SHAH ALAM', '66539', '500', 'room', 5, 2, 1, 'fully', 'https://maps.app.goo.gl/1kbyozjqSyw2FkVaA', 'male', '0145944032', 12, '2025-01-03 16:00:00', 'Master Room sharing 2 orang\r\n⚠️1 kekosongan utk bilik Master Room\r\n\r\nKemudahan kediaman:\r\n24hours security\r\nSwimming pool & gym\r\nBBQ area, reading room, multipurpose hall and playground\r\nKemudahan awam lain:\r\n5min ke NEW MRT Station & MSU University \r\nShuttle service ke MRT Station, AEON Shah Alam, Giant Shah Alam\r\nBerdekatan tempat makan, dobi & bank\r\nGiant & AEON Shah Alam within 2KM\r\n\r\nIf interested, please contact me.', 'Approved', 'approved', '2025-01-13 07:30:52', '2025-01-14 15:50:45'),
(8, 3, 'Menara U, Seksyen 13, Shah Alam', '41024', '375', 'high-rise', 4, 2, 2, 'fully', 'https://maps.app.goo.gl/gEoiwTi5SKCcBRJm7', 'male', '0159550493', 6, '2025-01-07 16:00:00', '🏃🏻‍♀️ Walking distance to MSU, AEON, Bus Station, and many shops 🏃🏻‍♀️\r\n\r\n🛌 ROOMS AVAILABLE 🛌\r\n✅ Double SHARING - RM 750+ per month (375 per person)\r\n⏲️ Utilities pay according to meter\r\n\r\n🏨 Building Facilities 🏨\r\n✅ Gym\r\n✅ Pool\r\n✅ Family Mart, CU and many eateries & shops\r\n\r\n🚗 Close to 🚗\r\n✅ MSU\r\n✅ AEON\r\n✅ Lotus\r\n✅ UITM\r\n✅ Politeknik\r\n✅ LRT\r\n✅ Bus\r\n✅ KTM\r\n✅ Stadium', 'Approved', 'approved', '2025-01-13 07:37:11', '2025-01-14 15:47:33'),
(9, 3, 'V Residence 2 seksyen 22', '29170', '500', 'room', 3, 2, 1, 'fully', 'https://maps.app.goo.gl/5TFLKJ7fSRQ8DikA7', 'male', '0159550493', 12, '2025-01-11 16:00:00', 'Blok A2, Level 22 (parking Level 2)\r\n\r\nSmall room with individual bathroom (non sharing). \r\nSetiap bilik ada sorg tenant shj. (Only 2 tenants inside)\r\n〽️Rm500 sebulan termasuk parking exclude api & air (selalu rm 40++)\r\n〽️Deposit \r\n〽️Total upfront payment: 1.8k (depo) + 500 (renting month) = rm 2.3k (can nego)\r\n\r\nAmnities:\r\n✅Pool\r\n✅Gym\r\n✅Mini mart', 'Approved', 'approved', '2025-01-13 07:46:50', '2025-01-14 15:43:45'),
(10, 6, 'Iresidence @ I-City', '70087', '664', 'high-rise', 5, 2, 1, 'fully', 'https://maps.app.goo.gl/cgRXL3PpHHgRWupS6', 'female', '0145944032', 6, '2025-01-09 16:00:00', 'IMMEDIATE ADMISSION FEBRUARY-MARCH 2025\r\nLooking for 1 replacement Female Only! \r\n\r\nMaster Bedroom SHARING\r\nDeposit : RM 664 including first month rental\r\nMonthly Payment: RM190 not including bills\r\n*usually max RM220 including electricity bill, water, wifi, coway\r\n📍Guarded house, private gym, scenic and spacious pool 🏊\r\n\r\nNEARBY LOCATION : \r\nUITM Shah Alam (5-7mins)\r\nCentral Icity mall (walk distance only) \r\n\r\nPlease contact me for further information!', 'Approved', 'approved', '2025-01-13 07:53:31', '2025-01-14 15:45:40'),
(11, 6, 'PANGSAPURI PERDANA SEKSYEN 13 (Tingkat 4)', '87749', '1500', 'room', 4, 3, 2, 'fully', 'https://maps.app.goo.gl/9mHWuRR1JadhyRsg6', 'female', '0145944032', 12, '2025-01-02 16:00:00', 'Mencari Penyewa  (Max 8 Orang)\r\n📍Lokasi:\r\nPangsapuri Perdana, Shah Alam\r\nDekat dengan Giant, Stadium, AEON Mall, dan Eco Shop\r\nBerhampiran Politeknik, stesen bas Batu Tiga, dan LRT Glenmarie\r\n\r\n📊 Maklumat Sewa:\r\nSewa Bulanan:RM 1,500\r\nDeposit: 2 bulan\r\nTingkat 4 (ada 2 lif)\r\n\r\nBerminat atau ada pertanyaan? Sila hubungi nombor yang disediakan.', 'Approved', 'approved', '2025-01-13 08:08:39', '2025-01-14 15:52:08'),
(12, 6, 'Pusat Komersial, Section 7 Shah Alam (Shop-House)', '91476', '278.87', 'room', 5, 2, 0, 'partially', 'https://maps.app.goo.gl/cBSfaAjg9cYiM5Lc9', 'female', '0145944032', 12, '2025-01-07 16:00:00', 'HOUSEMATES HUNTING 🕊🕊🕊\r\n-1 sharing room, 1 out of 2 vacancies\r\n-1 master room, 2 out of 2 vacancies\r\n\r\n3 Rooms 🛏 (Total housemates : 5 People)\r\nOpen Lot Parking 🚙\r\n2nd floor ( Top of Thai Classic Shop)\r\n\r\nMonthly Rental: RM 278.87 (exclude utilities)\r\nDeposit : 2 bulan refundable rental deposit + 0.5 bulan refundable utilities deposit = RM 650 Refundable end of the contract\r\nAvailability: Mac 2025\r\n\r\nAny further information please contact me!', 'Approved', 'approved', '2025-01-13 08:43:32', '2025-01-14 15:47:14'),
(13, 6, 'Pangsapuri Kristal View, Seksyen 7, Shah Alam', '18861', '500', 'room', 5, 1, 1, 'fully', 'https://maps.app.goo.gl/RRC7oZow1aatEhwG9', 'female', '0145944032', 6, '2025-01-12 16:00:00', 'Please contact me through the information given.', 'Resubmission', 'Please include the photos or videos of your property.', '2025-01-13 08:50:32', '2025-01-14 15:42:56'),
(14, 7, 'Blok E, Pusat Komersial, Section 7 Shah Alam (Tingkat 1)', '90620', '300', 'room', 5, 2, 1, 'fully', 'https://maps.app.goo.gl/cBSfaAjg9cYiM5Lc9', 'female', '0174039410', 12, '2025-01-12 16:00:00', 'Bilik Tengah (ada 1 katil shj yg available)\r\n(bilik sharing-2 orang)\r\n*Deposit 1 bulan sewa\r\n*Sewa include bil air+elektrik+wifi\r\n\r\nKemudahan berdekatan:\r\n*Kedai runcit dan barangan keperluan berhampiran\r\n*Kedai dobi, kedai makan dan Pasaraya Giant\r\n*Kedai mamak dan 7e berhampiran\r\n*Stesen Minyak Petron, Shell,Petronas\r\n*Bank, KFC,Mc Donald\r\n*Berdekatan dengan Pintu Masuk Uitm (Jalan Kaki)\r\n*Free Parking Spot\r\n\r\nUntuk pertanyaan boleh whatsapp nombor yang telah disediakan.', 'Approved', 'approved', '2025-01-13 09:41:36', '2025-01-14 15:43:15'),
(15, 7, 'VISTA ALAM APARTMENT, SEKSYEN 14, SHAH ALAM', '26565', '384', 'room', 4, 1, 1, 'fully', 'https://maps.app.goo.gl/ZzSe7zaUFeBLfAJU7', 'female', '0174039410', 12, '2025-01-09 16:00:00', '[LOOKING FOR 1 FEMALE TENANT: STUDENT]\r\n\r\nFEBRUARY INTAKE (minimum 1 year)\r\n1 SOHO UNIT (1 BEDROOM & 1 TOILET)\r\nSHARING ROOM (2 PERSONS)\r\n\r\nVISTA ALAM AMENITIES\r\nLAUNDRYBAR\r\nSWIMMING POOL\r\nGYM\r\n24-HR CONVENIENCE STORE\r\n10+ RESTAURANTS\r\n\r\n**IF YOU HAVE A CAR, CAN APPLY FOR PARKING AT RM100/month\r\n**FOOD & PARCEL DELIVERY ARE DELIVERED UP TO OUR DOOSTEP\r\n**5KM to UITM SHAH ALAM \r\n\r\nIf you have any questions, pls hit us up! 🌸', 'Approved', 'approved', '2025-01-13 09:50:41', '2025-01-14 15:45:56'),
(16, 7, 'Alam Prima Apartment, Seksyen 22, Shah Alam', '99933', '600', 'high-rise', 4, 2, 1, 'fully', 'https://maps.app.goo.gl/zwP3bWU3nNfpK9RD6', 'female', '0174039410', 12, '2025-01-10 16:00:00', 'Looking for responsible & hygienic female housemate. \r\nSmoking is strictly prohibited.\r\n\r\nHouse and room are fully furnished. accommodates 2 persons.\r\n\r\nDeposit: 2 months + RM 120 (keycard) \r\n\r\nInternet and utilities will be on sharing basis.\r\n\r\nShops Nearby(within 10 mins drive): \r\n+ Aeon mall Seksyen 13 \r\n+ Tesco Seksyen 13 \r\n+ Speedmart (walking distance) \r\n+ 7-Eleven (walking distance) \r\n+ Laundry shop (walking distance) \r\n+ Mamak (walking distance) \r\n+ Clinics (walking distance)\r\n\r\nSerious tenants may schedule viewing appointments. \r\nOnly available after working hours or on weekends.', 'Approved', 'approved', '2025-01-13 10:00:56', '2025-01-14 15:44:01'),
(17, 8, 'Apartment Suria Jaya, Seksyen 16, Shah Alam', '82333', '260', 'high-rise', 6, 3, 2, 'fully', 'https://maps.app.goo.gl/kJnNMphyjgAHt9Et7', 'female', '0180449302', 6, '2025-01-08 16:00:00', 'Lokasi : Berdekatan dengan\r\n1. Uitm shah alam\r\n2. Ken Rimba Shoplot\r\n3. Padang Jawa. seksyen 16\r\n4. Walking distance KTM\r\n\r\nJenis Bilik: sharing of 2 lengkap dengan perabot katil , tilam , bantal , wardrobe dan side table setiap orang.\r\n\r\nUntuk kemasukan awal bulan 2 2025, akhir bulan1 2025\r\nInfo lanjut boleh hubungi no tertera', 'Approved', 'approved', '2025-01-13 10:10:59', '2025-01-14 15:46:57'),
(18, 8, 'Pangsapuri Baiduri, Seksyen 7, Shah Alam (Tingkat 6)', '59083', '700', 'room', 4, 2, 1, 'partially', 'https://maps.app.goo.gl/1BYvEHv3fi5Sa9mN7', 'female', '0180449302', 6, '2025-01-03 16:00:00', 'Perempuan sahaja.\r\n\r\nBilik utama - RM850\r\nBilik kedua - RM700\r\n\r\nRumah bersama perabot lengkap seperti katil, almari, penghawa dingin, dapur, peti sejuk dan internet.', 'Approved', 'approved', '2025-01-13 10:15:12', '2025-01-14 15:47:54'),
(19, 9, 'Blok 38, Flat PKNS Seksyen 7 Shah Alam', '94769', '850', 'high-rise', 4, 3, 1, 'partially', 'https://maps.app.goo.gl/YFL92F3o4N7bN5W7A', 'female', '0194403921', 12, '2025-01-04 16:00:00', 'KEMASUKAN SEGERA FEBRUARI 2025\r\n\r\nDETAIL RUMAH :\r\n✅ 3 Bilik Tidur\r\n✅ 1 Bilik Air, 1 Tandas\r\n✅ Saiz 750sqft\r\n✅ Tingkat 5 (Tiada Lif)\r\n\r\nBERDEKATAN :\r\n✅ UITM Shah Alam, UNISEL\r\n✅ Stesen LRT (akan dibuka tidak lama lagi - jalan kaki)\r\n✅ Bersebelahan I-CITY\r\n✅ Hospital Shah Alam\r\n✅ Pusat Komersial\r\n\r\nKADAR SEWA :\r\n✅ RM 850/Sebulan\r\n✅ Rental Deposit RM2000\r\n✅ Deposit 2+1 & RM 300 (Bil Utiliti)', 'Resubmission', 'Please upload a proper photos or videos', '2025-01-13 10:38:04', '2025-01-14 15:49:30'),
(20, 9, 'Pangsapuri Indahria, Seksyen 22, Shah Alam', '18546', '250', 'room', 5, 1, 2, 'fully', 'https://maps.app.goo.gl/SxNaH4bichLQikLq9', 'female', '0194403921', 12, '2025-01-12 16:00:00', 'Mencari penyewa bilik perempuan sahaja. 1-3 org. Katil atas dan bawah (seperti gambar)\r\n\r\nKatil atas RM 250 ,\r\nKatil bwh RM 300 seorang. \r\n\r\nHarga sewaan termasuk bills/utilities(Air,Tnb, Wifi maxis 300mbps)\r\ndeposit hanya 1 bulan.\r\n\r\nKemasukan secepat mungkin\r\nDuduk bersama org bekerja.\r\nPenyewa yg mengamalkan kebersihan dan disiplin.\r\n\r\n▪ 5min perjalanan ke ktm batu tiga\r\n▪ lokasi di depan kilang gula / CSR Shah Alam\r\n▪ lokasi berdekatan dengan seksyen 13 ( MSU , Aeon Mall , Giant Shah Alam , Menara U , Stadium Shah Alam dan lain lain )\r\n\r\nBoleh call/ whatsapp untuk sebarang pertanyaan.', 'Approved', 'approved', '2025-01-13 10:57:05', '2025-01-14 15:43:30'),
(21, 9, 'Menara U Condominium, Seksyen 13 Shah Alam', '26977', '250', 'high-rise', 5, 1, 0, 'fully', 'https://maps.app.goo.gl/gEoiwTi5SKCcBRJm7', 'female', '0194403921', 12, '2025-01-08 16:00:00', 'URGENT REPLACEMENT FOR FEBRUARY 2025❗️ \r\n\r\n🔑 **Available Rooms & Prices:**\r\n(RM250 per person not include utilities🫶🏻)\r\n\r\n**FOR FEMALE ONLY**\r\nTWIN SINGLE BEDROOM ( 2 person in double decker) \r\n\r\n🌟 **Special Perks:**\r\n- Gated and guarded area with 24/7 security access (access card & lobby)\r\n- Infinity swimming pool 🏊‍♀️\r\n- Gymnasium 🏋️‍♂️\r\n- Non-smoking environment preferred\r\n\r\n📍 **Prime Location:**\r\n- Close to restaurants, marts (7-Eleven, Family mart, cu mart), and cafes\r\n- ⁠10 minutes to Aeon Mall and MSU\r\n\r\n☎️📱🤙🏻Any inquiries/to set viewing, Please contact for further information 😀', 'Approved', 'approved', '2025-01-13 11:00:37', '2025-01-14 15:50:10'),
(22, 10, 'Pangsapuri Seri Pinang, Seksyen U13, Shah Alam', '47192', '680', 'room', 6, 2, 2, 'fully', 'https://maps.app.goo.gl/QJWHi6R6gejikqny9', 'female', '0119504432', 12, '2025-01-01 16:00:00', 'Single/Couple boleh \r\ndeposit 1 bulan\r\nBilk Master room - RM680\r\nBilik medium - RM580 (single bed/queen bed) \r\n(sewa termasuk eletrik, air & wifi)', 'in progress', NULL, '2025-01-13 11:05:47', '2025-01-13 11:05:47'),
(23, 10, 'Arte Subang West Shah Alam, Seksyen 13', '16325', '292', 'room', 6, 1, 2, 'fully', 'https://maps.app.goo.gl/x415gBszVcoqouzg6', 'female', '0119504432', 12, '2025-01-06 16:00:00', '🌹 FEMALE MUSLIM 🌹 🧕🏻\r\n‼IN NEEDED 2 PERSON FOR REPLACEMENT‼\r\n\r\n4 PEOPLE SHARING / 2 VACANCY\r\nShare of 4 - Double-decker (Single Bed each)\r\nFriendly, CLEAN and Responsible\r\n💯 Able to cooperate & tolerate with housemates\r\n\r\n📍 STUDENT / INTERN / BEKERJA\r\n\r\nURGENT INTAKE JAN/FEB 2025\r\n\r\nMONTHLY RENTAL\r\n💰 RM 328.48 (Included with SK Magic water filter and Wifi. Excluded electric and water bill)\r\n\r\nWalking distance to:\r\n📍MSU\r\n📍AEON, Shah Alam\r\n📍Restaurants\r\n📍Grocery stores\r\n📍Gadget & Computer stores\r\n📍Clinics\r\n📍Stationary & Printing stores\r\n📍Bus stop\r\n📍Petrol Pump\r\n\r\nIf any enquiries just contact me!', 'Approved', 'approved', '2025-01-13 11:10:07', '2025-01-14 15:51:23'),
(24, 14, 'The Greens, Seksyen 22, Shah Alam', '71381', '650', 'room', 4, 2, 1, 'fully', 'https://maps.app.goo.gl/5TcHTUfmTJ1qLEp98', 'male', '0119504924', 6, '2025-01-09 16:00:00', 'Single Room In The Green Seksyen 22 Shah Alam Near MSU\r\n\r\nService provided :\r\n- Gym & Swimming pool facility\r\n-Weekly cleaning & facilities\r\n-In - house maintenance team\r\n- Non- smoking environment\r\n\r\nAmenities:\r\n- 5 min drive to KTM Batu 3\r\n- 10 min drive to AEON Shah Alam\r\n- 10 min drive to MSU Medical Centre\r\n- 10 min drive to Management & Science University (MSU)', 'Approved', 'approved', '2025-01-13 11:14:20', '2025-01-14 15:46:13'),
(25, 14, 'Apartment Baiduri, Seksyen 7, Shah Alam (Tingkat 3)', '95591', '1250', 'high-rise', 6, 3, 2, 'fully', 'https://maps.app.goo.gl/T25CjQfegjxAZ3fd6', 'male', '0119504924', 12, '2025-01-06 16:00:00', '!!Kemasukan bulan March 2025!!\r\n\r\nKeterangan:\r\n\r\nUnit : Tingkat 3, Blok 4, (bersebelahan lif)\r\nKemudahan : Mesin Basuh (Washing Machine), Dapur masak + Tong Gas, Almari Dapur,\r\nPeti Sejuk, Kipas Siling (Untuk setiap bilik termasuk Ruang Tamu), meja makan + kerusi.\r\nAlmari pakaian setiap bilik (3 bilik)\r\n\r\nKadar sewa: RM1250.00', 'in progress', NULL, '2025-01-13 11:20:37', '2025-01-13 11:20:37'),
(26, 17, 'Paramount Utropolis @ Glenmarie', '86345', '550', 'room', 4, 2, 1, 'fully', 'https://maps.app.goo.gl/1T6hywKfYjtwcdt86', 'female', '0178660531', 6, '2025-01-08 16:00:00', 'Convenience Place to stay!! Comfy & Clean!!\r\n\r\nNearby:\r\n↗️270 M to KDU University College\r\n↗️3.2 KM to MSU University \r\n↗️6KM to SS15\r\n↗️11 KM to Sunway Pyramid\r\n\r\nRooms We Offer:\r\nSharing Room ✌️ RM450 each\r\nSingle Room 🛌 RM650\r\n\r\n🔥 We provide complimentary high quality maintenance service for the first month 🤩\r\n\r\n📌 Anyone is welcomed, no discrimination here 😉\r\n\r\nKindly contact me on Whatsapp!', 'Approved', 'approved', '2025-01-13 14:05:37', '2025-01-14 15:48:56'),
(27, 17, 'I-SOHO @ i-City, Seksyen 7, Shah Alam', '68623', '1600', 'high-rise', 5, 2, 1, 'fully', 'https://maps.app.goo.gl/LwZ66ALPYVbPkwL59', 'female', '0178660531', 6, '2025-01-08 16:00:00', 'ACCESSIBILITY\r\n==========\r\n- Easily Accessible to Federal Highway, NKVE, Kesas Highway\r\n- Near to Shops, Petrol Station, Upcoming LRT Station\r\n- UITM, Shops, Clinics, Kindergarten, Restaurant & Banks.\r\n- Near To AEON Bandar Baru Klang Shopping Centre, Tesco, Giant\r\n\r\nContact me for viewing arrangement.', 'Cancelled', 'Please upload related photos or videos of your property', '2025-01-13 14:10:16', '2025-01-14 15:48:21'),
(28, 17, 'I-SOHO @ i-City, Seksyen 7, Shah Alam', '13072', '1600', 'room', 5, 2, 1, 'fully', 'https://maps.app.goo.gl/LwZ66ALPYVbPkwL59', 'male', '0178660531', 6, '2025-01-03 16:00:00', 'ACCESSIBILITY\r\n==========\r\n- Easily Accessible to Federal Highway, NKVE, Kesas Highway\r\n- Near to Shops, Petrol Station, Upcoming LRT Station\r\n- UITM, Shops, Clinics, Kindergarten, Restaurant & Banks.\r\n- Near To AEON Bandar Baru Klang Shopping Centre, Tesco, Giant\r\n\r\nContact me for viewing arrangement!', 'in progress', NULL, '2025-01-13 14:12:31', '2025-01-13 14:12:31'),
(29, 17, 'Blok N, Pusat Komersial, Seksyen 7 Shah Alam (Tingkat 2)', '91708', '370', 'room', 7, 4, 2, 'fully', 'https://maps.app.goo.gl/3pbxnuSUKMYzwjTXA', 'female', '0178660531', 12, '2025-01-05 16:00:00', '📌 BILIK SEWA KEMASUKAN  FEBRUARI 2025.\r\n( MUSLIMAH ) - Direct Owner 📌\r\n\r\nSINGLE ROOM RM370 (1 KEKOSONGAN) \r\n\r\nBayaran kemasukan :\r\n🍓 Deposit + Bulan (1+1)\r\n🍓 Bulan seterusnya hanya perlu membayar sewa bulanan. \r\n🍓 SEWA EXCLUDE  API, AIR, COWAY \r\n \r\nJika berminat boleh Whatsapp number yang tertera.', 'Approved', 'approved', '2025-01-13 14:18:06', '2025-01-14 15:51:43'),
(30, 17, 'Blok A, Pusat Komersial, Seksyen 7, Shah Alam (Tingkat 2)', '38438', '1600', 'room', 6, 3, 1, 'fully', 'https://maps.app.goo.gl/fxkF5W4oZZXbei2CA', 'male', '0178660531', 12, '2025-01-10 16:00:00', 'Berhampiran Uitm SHAH ALAM/Unisel/i-City Mall/Jakel etc.\r\n\r\nBLOK A Unit apartment atas kedai Magicboo electrical shop/sebaris Murni restaurant. Tingkat 2. Tiada lift. Street parking. \r\n3 room 2 toilet. \r\n\r\nKadar sewa RM1600/pm\r\nDeposit RM1600 (1+1 adv rental)\r\n*Kemasukan segera Feb 2025*\r\nMinimum stay 1 year.\r\n\r\n*Lokasi strategik*\r\n- walking distance  to New LRT station\r\n- ⁠walking distance to UiTM Shah Alam / UNISEL / i-City Mall\r\n- MCD, KFC, PIZZA HUT, SUBWAY, JAKEL, dan kedai2 yang lain\r\n- KTM Padang Jawa\r\n-Exit FEDERAL HIGHWAY\r\n\r\nKadar sewa RM1600 per month tidak termasuk api air.', 'Approved', 'approved', '2025-01-13 14:30:33', '2025-01-14 15:44:24'),
(31, 13, 'Jalan Kristal, Seksyen 7 Shah Alam', '68118', '400', 'room', 7, 5, 2, 'fully', 'https://maps.app.goo.gl/8opXtBMPU7zy6CqZ9', 'male', '0149950315', 12, '2025-01-07 16:00:00', 'Please contact me for further information.', 'Approved', 'approved', '2025-01-13 14:41:27', '2025-01-14 15:54:40'),
(32, 13, 'Apartment Baiduri, Seksyen 7, Shah Alam', '50221', '450', 'high-rise', 5, 1, 1, 'fully', 'https://maps.app.goo.gl/1BYvEHv3fi5Sa9mN7', 'male', '0149950315', 12, '2025-01-04 16:00:00', 'Intake for Feb 2025 ✨\r\n\r\nRoom To Rent (Single Room, 1 person only, Lelaki sahaja)\r\n\r\nRM 450 + including bills\r\nSuitable for students who wants a clean place to stay/study\r\nCan come and see the place first if you want\r\nPM me if you\'re interested, nak tanya apa apa roger je 😁', 'Approved', 'approved', '2025-01-13 14:48:21', '2025-01-14 15:50:27'),
(33, 13, 'Flat PKNS, Seksyen 16, Shah Alam', '46596', '480', 'room', 4, 1, 1, 'fully', 'https://maps.app.goo.gl/z6tnT6CFK4GhGEwH8', 'female', '0149950315', 6, '2025-01-05 16:00:00', 'Kindly contact me for further information.', 'in progress', NULL, '2025-01-13 14:54:08', '2025-01-13 14:54:08'),
(34, 15, 'Alam Prima Apartment, Seksyen 22, Shah Alam', '95270', '1700', 'room', 5, 3, 1, 'partially', 'https://maps.app.goo.gl/zwP3bWU3nNfpK9RD6', 'male', '0196605941', 6, '2025-01-08 16:00:00', 'Half furnished with kitchen cabinets\r\nwashing machine\r\nmattress for each bedrooms\r\nfridge\r\nfor viewing pls leave your whatsapp numner', 'Approved', 'approved', '2025-01-13 15:01:13', '2025-01-14 15:48:39'),
(35, 6, 'Flat PKNS, Seksyen 16', '79680', '700', 'room', 4, 2, 1, 'partially', 'https://maps.app.goo.gl/X8DgnptWmgfx3LrW9', 'female', '0159902930', 6, '2025-01-19 16:00:00', 'kindly contact me', 'Cancelled', 'Please add more of photos or videos of your property.', '2025-01-19 18:40:19', '2025-01-19 18:41:21'),
(36, 6, 'Armani Residence Shah Alam Seksyen 13', '94860', '600', 'landed', 4, 3, 1, 'fully', 'https://maps.app.goo.gl/H5PQu1ckuZ6KuGg59', 'female', '0175584042', 6, '2025-01-19 16:00:00', 'hee', 'in progress', NULL, '2025-01-20 06:26:02', '2025-01-20 06:26:02'),
(37, 6, 'Pangsapuri Sri Lembayung', '54077', '500', 'landed', 5, 2, 1, 'unfurnished', 'https://maps.app.goo.gl/X8DgnptWmgfx3LrW9', 'female', '0185594038', 6, '2025-01-19 16:00:00', 'hee', 'in progress', NULL, '2025-01-20 06:37:55', '2025-01-20 06:37:55'),
(43, 4, 'Apartment Dahlia, Seksyen 7', '98565', '1000', 'room', 4, 2, 1, 'partially', 'https://maps.app.goo.gl/2yxRRaznYDqxy1Lf8', 'female', '0185594038', 5, '2025-02-10 16:00:00', 'hi', 'in progress', NULL, '2025-02-10 18:04:05', '2025-02-10 18:04:05'),
(44, 4, 'Pangsapuri Sri Lembayung', '47630', '500', 'room', 2, 3, 1, 'partially', 'https://maps.app.goo.gl/QaAmZQXgPj7r8c4P7', 'female', '0175584042', 6, '2025-02-10 16:00:00', 'hi', 'in progress', NULL, '2025-02-10 18:04:42', '2025-02-10 18:04:42'),
(45, 4, 'Flat PKNS, Seksyen 16', '62360', '500', 'room', 3, 1, 3, 'partially', 'https://maps.app.goo.gl/X8DgnptWmgfx3LrW9', 'male', '0175584042', 2, '2025-02-10 16:00:00', 'hi', 'in progress', NULL, '2025-02-10 18:08:10', '2025-02-10 18:08:10'),
(46, 4, 'Soho Alinea Suites Seksyen 14, Shah Alam', '67287', '1000', 'high-rise', 3, 2, 1, 'partially', 'https://maps.app.goo.gl/H5PQu1ckuZ6KuGg59', 'male', '0185594038', 6, '2025-02-10 16:00:00', 'hi', 'Approved', 'approved', '2025-02-10 18:13:59', '2025-02-11 10:53:00'),
(47, 4, 'Pangsapuri Sri Lembayung', '24055', '500', 'high-rise', 3, 2, 1, 'partially', 'https://maps.app.goo.gl/H5PQu1ckuZ6KuGg59', 'female', '0175584042', 6, '2025-02-10 16:00:00', 'test', 'in progress', NULL, '2025-02-10 18:25:17', '2025-02-10 18:25:17'),
(48, 4, 'Pangsapuri Sri Lembayung', '36042', '500', 'room', 3, 5, 1, 'fully', 'https://maps.app.goo.gl/X8DgnptWmgfx3LrW9', 'female', '0175584042', 6, '2025-02-10 16:00:00', 'test', 'in progress', NULL, '2025-02-10 18:25:56', '2025-02-10 18:25:56'),
(50, 4, 'Apartment Dahlia, Seksyen 7', '71758', '1100', 'room', 3, 1, 4, 'partially', 'https://maps.app.goo.gl/QaAmZQXgPj7r8c4P7', 'female', '0175584042', 6, '2025-02-10 16:00:00', 'test', 'in progress', NULL, '2025-02-10 18:31:02', '2025-02-10 18:31:02'),
(51, 4, 'Pangsapuri Sri Lembayung', '93384', '500', 'room', 3, 2, 1, 'fully', 'https://maps.app.goo.gl/X8DgnptWmgfx3LrW9', 'female', '0175584042', 6, '2025-02-10 16:00:00', 'test', 'in progress', NULL, '2025-02-10 18:39:53', '2025-02-10 18:39:53'),
(52, 4, 'Pangsapuri Sri Lembayung', '67171', '500', 'room', 3, 2, 1, 'fully', 'https://maps.app.goo.gl/X8DgnptWmgfx3LrW9', 'female', '0175584042', 6, '2025-02-10 16:00:00', 'test', 'Approved', 'approved', '2025-02-10 18:43:22', '2025-02-11 10:08:43');

-- --------------------------------------------------------

--
-- Table structure for table `property_media`
--

CREATE TABLE `property_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `property_id` bigint(20) UNSIGNED NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property_media`
--

INSERT INTO `property_media` (`id`, `property_id`, `file_path`, `created_at`, `updated_at`) VALUES
(192, 43, 'properties/images/1739210645_67aa3f95e5a4b.png', '2025-02-10 18:04:06', '2025-02-10 18:04:06'),
(193, 44, 'properties/images/1739210682_67aa3fba71033.png', '2025-02-10 18:04:42', '2025-02-10 18:04:42'),
(194, 45, 'properties/images/1739210890_67aa408a9e9bb.png', '2025-02-10 18:08:10', '2025-02-10 18:08:10'),
(195, 46, 'properties/images/1739211239_67aa41e774db7.png', '2025-02-10 18:13:59', '2025-02-10 18:13:59'),
(196, 47, 'properties/images/1739211917_67aa448de6fc9.png', '2025-02-10 18:25:18', '2025-02-10 18:25:18'),
(197, 48, 'properties/images/1739211956_67aa44b4996dc.png', '2025-02-10 18:25:56', '2025-02-10 18:25:56'),
(199, 52, 'properties/images/Screenshot 2025-02-10 092659.png', '2025-02-10 18:43:22', '2025-02-10 18:43:22');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `matric_number` varchar(10) NOT NULL,
  `address` text DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `phoneno` varchar(10) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `user_id`, `matric_number`, `address`, `gender`, `phoneno`, `dob`, `created_at`, `updated_at`) VALUES
(1, 1, '', NULL, 'f', '0196550412', '2002-10-10', '2025-01-12 17:06:28', '2025-01-12 19:21:19'),
(2, 21, '', NULL, 'f', '0126678493', '2000-06-13', '2025-01-12 17:06:29', '2025-01-12 19:20:19'),
(3, 22, '', NULL, 'm', '0105994031', '2000-02-08', '2025-01-12 17:06:29', '2025-01-12 19:22:14'),
(4, 23, '', NULL, 'm', '0138595031', '2002-08-30', '2025-01-12 17:06:29', '2025-01-12 19:24:12'),
(5, 24, '', NULL, 'f', '0134478393', '2003-03-19', '2025-01-12 17:06:29', '2025-01-12 19:28:37'),
(6, 25, '', NULL, 'm', '0139950473', '1998-05-09', '2025-01-12 17:06:29', '2025-01-12 19:30:36'),
(7, 26, '', NULL, 'f', '0105994031', '2002-04-24', '2025-01-12 17:06:29', '2025-01-12 19:40:51'),
(8, 27, '', NULL, 'f', '0135591032', '2000-01-02', '2025-01-12 17:06:30', '2025-01-12 19:42:20'),
(9, 28, '', NULL, 'f', '0138869515', '2001-10-22', '2025-01-12 17:06:30', '2025-01-12 19:43:39'),
(10, 29, '', NULL, 'm', '0196550412', '2003-07-24', '2025-01-12 17:06:30', '2025-01-12 19:44:53'),
(11, 30, '', NULL, 'f', '0180449302', '1999-06-10', '2025-01-12 17:06:30', '2025-01-12 19:46:12'),
(12, 31, '', NULL, 'f', '0117685933', '2002-06-17', '2025-01-12 17:06:30', '2025-01-12 19:47:39'),
(13, 32, '', NULL, 'f', '0114839201', '2004-08-18', '2025-01-12 17:06:30', '2025-01-12 19:48:49'),
(14, 33, '', NULL, 'f', '0119504850', '1998-12-23', '2025-01-12 17:06:30', '2025-01-12 19:49:58'),
(15, 34, '', NULL, 'f', '0116950477', '1999-04-01', '2025-01-12 17:06:30', '2025-01-12 19:50:59'),
(16, 35, '', NULL, 'm', '0118790452', '1999-02-09', '2025-01-12 17:06:30', '2025-01-12 19:56:16'),
(17, 36, '2023995014', NULL, 'f', '0129550423', '2025-01-13', '2025-01-12 20:42:27', '2025-01-12 20:52:12'),
(18, 37, '2023955019', NULL, 'f', '0196700322', '2025-01-13', '2025-01-12 20:42:53', '2025-01-12 20:52:49'),
(19, 38, '2023955010', NULL, 'f', '0106956043', '2025-01-13', '2025-01-12 20:43:42', '2025-01-12 20:53:30'),
(20, 39, '2023850491', NULL, 'm', '0160559341', '2025-01-13', '2025-01-12 20:44:11', '2025-01-12 20:54:04'),
(21, 40, '2023950491', NULL, 'm', '0140559301', '2025-01-13', '2025-01-12 20:44:39', '2025-01-12 20:51:46'),
(23, 42, '2023966059', NULL, 'm', '0106950492', '2025-01-15', '2025-01-12 20:54:46', '2025-01-14 16:07:48'),
(24, 43, '2023840031', NULL, NULL, NULL, NULL, '2025-01-12 20:55:19', '2025-01-12 20:55:19'),
(25, 44, '2023966043', NULL, NULL, NULL, NULL, '2025-01-12 20:55:49', '2025-01-12 20:55:49'),
(26, 45, '2023411950', NULL, NULL, NULL, NULL, '2025-01-12 20:56:21', '2025-01-12 20:56:21'),
(27, 46, '2023859110', NULL, NULL, NULL, NULL, '2025-01-12 20:56:46', '2025-01-12 20:56:46'),
(28, 47, '2023119600', NULL, NULL, NULL, NULL, '2025-01-12 20:57:13', '2025-01-12 20:57:13'),
(29, 48, '2023965501', NULL, NULL, NULL, NULL, '2025-01-12 20:58:01', '2025-01-12 20:58:01'),
(30, 49, '2023869110', '25/4 Jalan Pandan Mewah, 51000 Kuala Lumpur', 'f', '0189550942', '2025-01-20', '2025-01-12 20:58:43', '2025-01-19 17:46:58'),
(31, 50, '2023695504', NULL, NULL, NULL, NULL, '2025-01-12 20:59:00', '2025-01-12 20:59:00'),
(32, 51, '2023800133', NULL, NULL, NULL, NULL, '2025-01-12 20:59:22', '2025-01-12 20:59:22'),
(33, 52, '2023966051', NULL, NULL, NULL, NULL, '2025-01-12 20:59:45', '2025-01-12 20:59:45'),
(34, 53, '2023864403', NULL, NULL, NULL, NULL, '2025-01-12 21:00:03', '2025-01-12 21:00:03'),
(35, 54, '2023822013', NULL, NULL, NULL, NULL, '2025-01-12 21:00:27', '2025-01-12 21:00:27'),
(36, 55, '2023800143', NULL, NULL, NULL, NULL, '2025-01-12 21:00:45', '2025-01-12 21:00:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Noor Haizan', '2023165409@student.uitm.edu.my', NULL, '$2y$10$w4dIXIn6fRHqUuhZZuVqZerQXC53.BAtU/Dzve9WJYJbDn1xr04oW', 0, NULL, '2025-01-12 17:06:28', '2025-01-12 19:21:19'),
(2, 'Nur Alissa', 'nuralissa41@gmail.com', NULL, '$2y$10$fHyXa5F/i4EPuvi69YrrFugKCss2cbnD5m1OJiV54f/u5ngcUtOuK', 1, NULL, '2025-01-12 17:06:28', '2025-01-12 20:05:57'),
(3, 'Muhamad Firdaus', 'firdaus17@gmail.com', NULL, '$2y$10$L0f78dn96VDa5pLUmCuOmOoswkq.PbsLO3l1CVgbX8IMpAj1aBc8u', 1, NULL, '2025-01-12 17:06:28', '2025-01-12 20:07:17'),
(4, 'Muhamad Mikael', 'muhdmikael50@gmail.com', NULL, '$2y$10$06qaVpLFjUCMrlkVhq.fruximofaSps6mDzCaJjOKxz80F1zu2n/u', 1, NULL, '2025-01-12 17:06:28', '2025-01-12 20:08:13'),
(5, 'Admin', 'admin@nrhome.com', NULL, '$2y$10$YNSGPNKiQuIi7eMzr2ygj.d51bWKroKL77TktGeDL8QldbQ.4P.sC', 2, 'd26eQW2ARHu0nNUxa27OKB9gUVHlTsBpO9E8stId043yAyWAMzSIlZzhUTbY', '2025-01-12 17:06:28', '2025-01-14 15:41:52'),
(6, 'Siti Syahirah', 'syahirah25@gmail.com', '2025-01-12 17:06:28', '$2y$10$BwTUaxtnVZ2zdwpQbGt2rOrRRj208sv.xVsXWaM4mQxQhvRKIdDBO', 1, NULL, '2025-01-12 17:06:28', '2025-02-10 17:39:46'),
(7, 'Siti Raudhah', 'raudhah143@gmail.com', '2025-01-12 17:06:28', '$2y$10$QhoUPFwR8XcwWjwQ/I4Cpe3a4E2OV01Zsyd9Wk5lLjHBoAaF6U8OO', 1, NULL, '2025-01-12 17:06:28', '2025-01-12 20:10:11'),
(8, 'Nurul Syazwani', 'wanimansor10@gmail.com', '2025-01-12 17:06:28', '$2y$10$JzaYOQW7onFpHd5zR2HJzuynv7k2h9QK2OvkE/rebI440ITBIfyeC', 1, NULL, '2025-01-12 17:06:28', '2025-01-19 18:41:45'),
(9, 'Athinis Akasya', 'athinisakasya12@gmail.com', '2025-01-12 17:06:28', '$2y$10$F6L9H7nvuVgXQx7NzL7nrOJZy6mboFk8vGbi2A/A7lacUAXf9Pube', 1, NULL, '2025-01-12 17:06:28', '2025-01-12 20:12:14'),
(10, 'Nur Farhana', 'farhanahh410@gmail.com', '2025-01-12 17:06:28', '$2y$10$rsf43PpAN1RQbvLAZxh01u4kvnBB6sZn19OeYz4Yde/awUCvUNIZC', 1, NULL, '2025-01-12 17:06:28', '2025-01-12 20:13:04'),
(11, 'Athirah Hanis', 'hanisathirah@gmail.com', '2025-01-12 17:06:28', '$2y$10$OVsqS5T1yiS5O5Ovr2NzjuRlFfymP3LBm1WRt8U.AjPQUuAaWKtI.', 1, NULL, '2025-01-12 17:06:28', '2025-01-12 20:14:42'),
(12, 'Noor Baidari', 'baidari1005@gmail.com', '2025-01-12 17:06:29', '$2y$10$hos.fuo64tYH5U.N2/Tb..ZNvLVQ4MfO24egHadEIUiv0ldKMmDYG', 1, NULL, '2025-01-12 17:06:29', '2025-01-12 20:15:44'),
(13, 'Abdullah Yusof', 'abdullah601@gmail.com', '2025-01-12 17:06:29', '$2y$10$ZdWnlF3DTiL0sddyiek6yO.PWL/FF/NzxRwEVrGBbkd4TiRlW/GXa', 1, NULL, '2025-01-12 17:06:29', '2025-01-12 20:17:05'),
(14, 'Rahim Omar', 'omar4033@gmail.com', '2025-01-12 17:06:29', '$2y$10$Vinhuxa5rhrU91/fyK4m7ekT6.w8TAbRdZgYYfZV1x7ShambgHpji', 1, NULL, '2025-01-12 17:06:29', '2025-01-12 20:18:57'),
(15, 'Fattah Amin', 'fattahamin20@gmail.com', '2025-01-12 17:06:29', '$2y$10$ZofJAFmhODoFHMSApAUKx.xstFlVgkiJDG1U72cXWyv87IYPhp17K', 1, NULL, '2025-01-12 17:06:29', '2025-01-12 20:20:17'),
(16, 'Syukri Yahya', 'yahya115@gmail.com', '2025-01-12 17:06:29', '$2y$10$n.AaGSYdilZIprUFDnEVVO1FNHEFiZN8/zMQhfGvY6LOJoSwmScBi', 1, NULL, '2025-01-12 17:06:29', '2025-01-12 20:21:12'),
(17, 'Anuar Zain', 'anuarzain24@gmail.com', '2025-01-12 17:06:29', '$2y$10$RrwjLFEK7phtGAfP85CEdugDBLC8ERpKjmvFmahW2b2wLkch/.6Qu', 1, NULL, '2025-01-12 17:06:29', '2025-01-12 20:22:18'),
(18, 'Aiman Hakim Ridza', 'hakimredza33@gmail.com', '2025-01-12 17:06:29', '$2y$10$ypSmJoR5aLvWQC3FMCzYTOHXa8Z.P9U/3TL4eYfaQxGSRbltUjQRu', 1, NULL, '2025-01-12 17:06:29', '2025-01-12 20:23:33'),
(19, 'Ernie Zakri', 'erniezakri56@gmail.com', '2025-01-12 17:06:29', '$2y$10$n.hIbHBLgH4nqb3NuvBTo.O5MtuVdQDvOu/n0p7xcht2bijMZOVMW', 1, NULL, '2025-01-12 17:06:29', '2025-01-12 20:24:18'),
(20, 'Nabila Huda', 'nabilahuda10@gmail.com', '2025-01-12 17:06:29', '$2y$10$aMebMRX11ujWaIu0TQoJc.GAHM2R9P0xLGdKvbACFnRqAivCjH4I6', 1, NULL, '2025-01-12 17:06:29', '2025-01-12 20:25:08'),
(21, 'Noor Putri Balqis', '2023669518@student.uitm.edu.my', '2025-01-12 17:06:29', '$2y$10$KSVI2wN/oxda/01CfscCce0DCmU5OFUUT6EDfjT2vivDFQNtTJ9Ny', 0, NULL, '2025-01-12 17:06:29', '2025-01-12 19:20:44'),
(22, 'Amirul Shah', '2023665941@student.uitm.edu.my', '2025-01-12 17:06:29', '$2y$10$eRANeNP8eDXyrK9HK.kYaetMb43DUxDd5vT/kek5H2GKUF6Eth696', 0, NULL, '2025-01-12 17:06:29', '2025-01-12 19:22:56'),
(23, 'Ikmal Amri', '2023166504@student.uitm.edu.my', '2025-01-12 17:06:29', '$2y$10$GDqA/o3IwPCdKFKkFwdMe.IfYk2Xa8A3zd71gCR1MfPZYtRk7XbCS', 0, NULL, '2025-01-12 17:06:29', '2025-01-12 19:25:04'),
(24, 'Nurul Huda', '2023880041@student.uitm.edu.my', '2025-01-12 17:06:29', '$2y$10$MO20/.ujANc3OcF9/IL4MuxjNTXakbBdfN.yyYmxLPnMFbNTRO9l6', 0, NULL, '2025-01-12 17:06:29', '2025-01-12 19:29:14'),
(25, 'Ahmad Muaz', '2023170975@student.uitm.edu.my', '2025-01-12 17:06:29', '$2y$10$VvKdoU8FfxhB6qRN3vzzYOEcLA47APOS/s67ys7z9.hn1kQL1jmPK', 0, NULL, '2025-01-12 17:06:29', '2025-01-12 19:30:57'),
(26, 'Farisha Maisarah', '2023170890@student.uitm.edu.my', '2025-01-12 17:06:29', '$2y$10$g4XGLLIZDoUUcHFSGQu3zO2ET8nRBJJgjhGJMLozikixMc8DY3IQW', 0, NULL, '2025-01-12 17:06:29', '2025-01-12 19:41:42'),
(27, 'Nur Izzaty', '2023105961@student.uitm.edu.my', '2025-01-12 17:06:30', '$2y$10$4NkNJ/c8WgaSn0M9GPuCmeICZbsSWZT1u.mXue28BB5yrYl5TBbK6', 0, NULL, '2025-01-12 17:06:30', '2025-01-12 19:42:47'),
(28, 'Farah Afiqah', '2023005932@student.uitm.edu.my', '2025-01-12 17:06:30', '$2y$10$ucSdL/9UWP7u/XT1VVI.GevcR/IwB3wc5twdUMMJCEPr2.21WRfw.', 0, NULL, '2025-01-12 17:06:30', '2025-01-12 19:44:06'),
(29, 'Mohd Iskandar', '2023106943@student.uitm.edu.my', '2025-01-12 17:06:30', '$2y$10$.CRtUtYghU0WV0aK36G.gesRdsl0DXU2vCvynYomtK87h8ws9hkeC', 0, NULL, '2025-01-12 17:06:30', '2025-01-12 19:45:18'),
(30, 'Siti Fazura', '2023170113@student.uitm.edu.my', '2025-01-12 17:06:30', '$2y$10$lRuKrV3UkfLV36lbPj5mnOr8XHqU/1gpgw6TBcwFDyZsetL6Mwsc2', 0, NULL, '2025-01-12 17:06:30', '2025-01-12 19:47:09'),
(31, 'Nurul Aina', '2023069031@student.uitm.edu.my', '2025-01-12 17:06:30', '$2y$10$HAVePmZ7S9AQHYArpSFB0.332v2RUhDBzJ.gCdUaJJWrZRKRMgCze', 0, NULL, '2025-01-12 17:06:30', '2025-01-12 19:48:05'),
(32, 'Nordiana Alias', '2023886012@student.uitm.edu.my', '2025-01-12 17:06:30', '$2y$10$CucI/6kqlP5NDoQcIgpFyerA7DES8A/ecQaKD06BX1r3GGovquEme', 0, NULL, '2025-01-12 17:06:30', '2025-01-12 19:49:15'),
(33, 'Nurul Wahida', '2023009401@student.uitm.edu.my', '2025-01-12 17:06:30', '$2y$10$r.Xv7Tv6dWUm3sV.Y.u8reMNFubcej6t3VjBVWxVpIn6gIV.kPIC.', 0, NULL, '2025-01-12 17:06:30', '2025-01-12 19:50:23'),
(34, 'Nurul Qurratu Aini', '2023110594@student.uitm.edu.my', '2025-01-12 17:06:30', '$2y$10$7VHjZko2I14P9KC7f7EQ1.sH7N0se9i7etA1p84ynfku3tDjlXYqi', 0, NULL, '2025-01-12 17:06:30', '2025-01-12 19:51:22'),
(35, 'Noor Hakim', '2023203341@student.uitm.edu.my', '2025-01-12 17:06:30', '$2y$10$hXpMIw/l66RTxasEENWV8ekqKbVF.tUCAqLx1kiJQp0QftPRn8By2', 0, NULL, '2025-01-12 17:06:30', '2025-01-12 19:56:50'),
(36, 'Siti Nur Amani', '2023995014@student.uitm.edu.my', NULL, '$2y$10$4rl8iWgxCsnchj.AwYLfqevngGZIz8Ls6NnxycdHdC/IWkNdPzfbG', 0, NULL, '2025-01-12 20:42:27', '2025-01-12 20:52:20'),
(37, 'Mira Filzah', '2023955019@student.uitm.edu.my', NULL, '$2y$10$5Py.wsbHfsRPnGMhwBa1LOAw2s6UzL.2psjMxVC4VvOHQXnrTPr.C', 0, NULL, '2025-01-12 20:42:53', '2025-01-12 20:53:01'),
(38, 'Siti Nurliyana', '2023955010@student.uitm.edu.my', NULL, '$2y$10$xCwPTtI11OsLlGl6E29Xt.PV9r1/3tqOhWIa4Jp8PS10I7ubKv/IO', 0, NULL, '2025-01-12 20:43:42', '2025-01-12 20:53:39'),
(39, 'Muhammad Iqbal Hanif', '2023850491@student.uitm.edu.my', NULL, '$2y$10$eT7HdCnVKRbIv8Q4AMuw8Oj0indI3tB2gVZrZ3nDYrQRGCkR.91BS', 0, NULL, '2025-01-12 20:44:11', '2025-01-12 20:54:13'),
(40, 'Muhammad Azmi', '2023950491@student.uitm.edu.my', NULL, '$2y$10$0lyLfMMYa0.oY1Q2g8qhj.59UibOGJFcw/ath4KlikCnIRUYGCfje', 0, NULL, '2025-01-12 20:44:39', '2025-01-12 20:51:21'),
(42, 'Muhamad Ikhwan', '2023966059@student.uitm.edu.my', NULL, '$2y$10$p/4FbU080wmep1uWKmvNf.jcIWpib2zY.T3EjO/xQa9VHgCrVl.9.', 0, NULL, '2025-01-12 20:54:46', '2025-01-12 20:54:46'),
(43, 'Aisyah Nuraini', '2023840031@student.uitm.edu.my', NULL, '$2y$10$HbnmUwdbYltHhh502Qj7sO1zlrSU1vSkKt3hXeIywfsOQqgnfEYAK', 0, NULL, '2025-01-12 20:55:19', '2025-01-12 20:55:19'),
(44, 'Nurul Natasha', '2023966043@student.uitm.edu.my', NULL, '$2y$10$XIgOFD8uvke/vwKGLBCV0.HYZA6BORJwk9skchtHlEOa6noible1G', 0, NULL, '2025-01-12 20:55:49', '2025-01-12 20:55:49'),
(45, 'Noor Fazura', '2023411950@student.uitm.edu.my', NULL, '$2y$10$OeZYz.0Ok431xy3UX5iGpOpwwfh7gUuJP5cfCFJjKoeGGt.KwECw.', 0, NULL, '2025-01-12 20:56:21', '2025-01-12 20:56:21'),
(46, 'Muhammad Muiz', '2023859110@student.uitm.edu.my', NULL, '$2y$10$12JcX63F1prkMorAQk9aaeW3YInw6y76hJj1fB6vzsxwXqkWRTGi2', 0, NULL, '2025-01-12 20:56:46', '2025-01-12 20:56:46'),
(47, 'Nurliyana Balqis', '2023119600@student.uitm.edu.my', NULL, '$2y$10$L4/FDIt81Tckd5rw6kqLeulAHtKgH.mv5jEZzzjzLUcUECkG1a6ba', 0, NULL, '2025-01-12 20:57:13', '2025-01-12 20:57:13'),
(48, 'Zizan Razak', '2023965501@student.uitm.edu.my', NULL, '$2y$10$9J.aq9m4QhG6Hl1JGTKErOJPwSPc.A.KYwvrAQ2I9GrEP.ZKA2ZPy', 0, NULL, '2025-01-12 20:58:01', '2025-01-12 20:58:01'),
(49, 'Nur Izzati', '2023869110@student.uitm.edu.my', NULL, '$2y$10$YIVaCPnCruHClSLMIf4eHu0z7Kof.jJ7rPrC/OE2wVBWJQrUqp7m6', 0, NULL, '2025-01-12 20:58:43', '2025-01-12 20:58:43'),
(50, 'Siti Nur Fatimah', '2023695504@student.uitm.edu.my', NULL, '$2y$10$tfhU4KgWX.xtwU5qCK0kFeF2VRUp.3DeIXVc18nse/BlYUMZAmg5O', 0, NULL, '2025-01-12 20:59:00', '2025-01-12 20:59:00'),
(51, 'Nurizzati Nida', '2023800133@student.uitm.edu.my', NULL, '$2y$10$McISBmPwG5L92sbqEROQM.hq2vLI0gNSiNg69VNWlm4ZRwYWJm/Ey', 0, NULL, '2025-01-12 20:59:22', '2025-01-12 20:59:22'),
(52, 'Nurul Nadhirah', '2023966051@student.uitm.edu.my', NULL, '$2y$10$JCcooHqoz4ToO9Dsns0B6.ebYU30MQ8Seh5uCn7.XOaTAj1adz6Sm', 0, NULL, '2025-01-12 20:59:45', '2025-01-12 20:59:45'),
(53, 'Ahmad Safwan', '2023864403@student.uitm.edu.my', NULL, '$2y$10$TjPvlAYXPtW9sBKVasdWIOZVxcw7ZU4wkJtfWEPv0DhKWMzPbPTzy', 0, NULL, '2025-01-12 21:00:03', '2025-01-12 21:00:03'),
(54, 'Sharifah Afiqah', '2023822013@student.uitm.edu.my', NULL, '$2y$10$Q9ZmAKp2WPfwE0qsV4B8jexbGbto.Qh50d3H2HEEneZ0gtUl4PoWu', 0, NULL, '2025-01-12 21:00:27', '2025-01-12 21:00:27'),
(55, 'Nur Syahirah', '2023800143@student.uitm.edu.my', NULL, '$2y$10$tz45dMtmFJEi.D.lrlUYCeXaHORaAMX.0mCcMksSBv.DJj/YSJFJG', 0, NULL, '2025-01-12 21:00:45', '2025-01-12 21:00:45'),
(56, 'Siti Syahirah', 'syahirahmansor58@gmail.com', NULL, '$2y$10$13XW6dZxzSJbc./sRUSnZu4Fy.p519w9mKlDjJ46sncrqa12gLVIm', 1, 'cgYgOCFWRAUzPict2F88jeHWhDLLyqRmnFeJ3BYltx9kTCIpoE4H460n0aFj', '2025-01-20 10:07:03', '2025-02-05 15:25:45'),
(57, 'siti umairah', 'siti123@gmail.com', NULL, '$2y$10$gJH4w0qZ7Uq9zNigMVr5YeviC5IuhIPWuY2gka4WdevkDLzbPavM6', 1, NULL, '2025-02-07 08:46:25', '2025-02-07 08:46:25'),
(58, 'haikal', 'muhammadhaikal@gmail.com', NULL, '$2y$10$YvgmH7.FITmCnKucYcXWUe9WSJXNELoUrnjj9x1dZqHqDNC3/Yb7O', 1, NULL, '2025-02-07 08:48:46', '2025-02-07 08:48:46'),
(59, 'haikal', 'haikal@gmail.com', NULL, '$2y$10$uO3Vucmzs435R2/G3NqKF.L/Zrz/wOtSGP8zl/ezvisUAEkd1WW0S', 1, NULL, '2025-02-07 08:51:48', '2025-02-07 08:51:48'),
(60, 'ahmad', 'ahmad@gmail.com', NULL, '$2y$10$wuK3Y.ejNNgf3BiEz3OvKuHGEdUY7sWO90YWdb54LurjqpnMNmNce', 1, NULL, '2025-02-07 08:52:49', '2025-02-07 08:52:49');

-- --------------------------------------------------------

--
-- Table structure for table `user_property_interactions`
--

CREATE TABLE `user_property_interactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `property_id` bigint(20) UNSIGNED DEFAULT NULL,
  `search_term` varchar(255) DEFAULT NULL,
  `interaction_type` enum('view','search') NOT NULL,
  `interaction_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_property_interactions`
--

INSERT INTO `user_property_interactions` (`id`, `user_id`, `property_id`, `search_term`, `interaction_type`, `interaction_time`, `created_at`, `updated_at`) VALUES
(1, 21, 4, NULL, 'view', '2025-01-14 15:55:48', NULL, NULL),
(2, 21, 2, NULL, 'view', '2025-01-14 15:56:01', NULL, NULL),
(3, 21, 4, NULL, 'view', '2025-01-14 15:56:09', NULL, NULL),
(4, 21, 7, NULL, 'view', '2025-01-14 15:56:17', NULL, NULL),
(5, 21, 18, NULL, 'view', '2025-01-14 15:56:25', NULL, NULL),
(6, 21, 21, NULL, 'view', '2025-01-14 15:56:32', NULL, NULL),
(7, 21, 21, NULL, 'view', '2025-01-14 15:56:35', NULL, NULL),
(8, 21, NULL, NULL, 'search', '2025-01-14 15:56:41', NULL, NULL),
(9, 21, NULL, NULL, 'search', '2025-01-14 15:56:49', NULL, NULL),
(10, 21, NULL, NULL, 'search', '2025-01-14 15:56:53', NULL, NULL),
(11, 22, 21, NULL, 'view', '2025-01-14 15:57:19', NULL, NULL),
(12, 22, 1, NULL, 'view', '2025-01-14 15:57:25', NULL, NULL),
(13, 22, 1, NULL, 'view', '2025-01-14 15:57:31', NULL, NULL),
(14, 22, 24, NULL, 'view', '2025-01-14 15:57:36', NULL, NULL),
(15, 22, 26, NULL, 'view', '2025-01-14 15:57:42', NULL, NULL),
(16, 22, 30, NULL, 'view', '2025-01-14 15:57:49', NULL, NULL),
(17, 22, 31, NULL, 'view', '2025-01-14 15:57:52', NULL, NULL),
(18, 22, NULL, NULL, 'search', '2025-01-14 15:57:58', NULL, NULL),
(19, 22, NULL, NULL, 'search', '2025-01-14 15:58:03', NULL, NULL),
(20, 23, 7, NULL, 'view', '2025-01-14 15:58:30', NULL, NULL),
(21, 23, 9, NULL, 'view', '2025-01-14 15:58:36', NULL, NULL),
(22, 23, 14, NULL, 'view', '2025-01-14 15:58:43', NULL, NULL),
(23, 23, 32, NULL, 'view', '2025-01-14 15:58:51', NULL, NULL),
(24, 23, 32, NULL, 'view', '2025-01-14 15:58:56', NULL, NULL),
(25, 23, NULL, NULL, 'search', '2025-01-14 15:59:02', NULL, NULL),
(26, 23, NULL, NULL, 'search', '2025-01-14 15:59:07', NULL, NULL),
(27, 24, 16, NULL, 'view', '2025-01-14 15:59:37', NULL, NULL),
(28, 24, 17, NULL, 'view', '2025-01-14 15:59:41', NULL, NULL),
(29, 24, 23, NULL, 'view', '2025-01-14 15:59:45', NULL, NULL),
(30, 24, 31, NULL, 'view', '2025-01-14 15:59:51', NULL, NULL),
(31, 24, NULL, NULL, 'search', '2025-01-14 15:59:59', NULL, NULL),
(32, 24, NULL, NULL, 'search', '2025-01-14 16:00:03', NULL, NULL),
(33, 25, 4, NULL, 'view', '2025-01-14 16:01:39', NULL, NULL),
(34, 25, 15, NULL, 'view', '2025-01-14 16:01:46', NULL, NULL),
(35, 25, 34, NULL, 'view', '2025-01-14 16:01:52', NULL, NULL),
(36, 25, NULL, NULL, 'search', '2025-01-14 16:01:57', NULL, NULL),
(37, 26, 18, NULL, 'view', '2025-01-14 16:02:43', NULL, NULL),
(38, 26, 34, NULL, 'view', '2025-01-14 16:02:46', NULL, NULL),
(39, 26, 30, NULL, 'view', '2025-01-14 16:02:49', NULL, NULL),
(40, 26, 26, NULL, 'view', '2025-01-14 16:02:52', NULL, NULL),
(41, 26, NULL, NULL, 'search', '2025-01-14 16:03:00', NULL, NULL),
(42, 26, NULL, NULL, 'search', '2025-01-14 16:03:24', NULL, NULL),
(43, 26, 21, NULL, 'view', '2025-01-14 16:03:26', NULL, NULL),
(44, 27, 17, NULL, 'view', '2025-01-14 16:03:55', NULL, NULL),
(45, 27, 24, NULL, 'view', '2025-01-14 16:03:57', NULL, NULL),
(46, 27, 5, NULL, 'view', '2025-01-14 16:04:01', NULL, NULL),
(47, 27, 10, NULL, 'view', '2025-01-14 16:04:07', NULL, NULL),
(48, 27, NULL, NULL, 'search', '2025-01-14 16:04:23', NULL, NULL),
(49, 27, NULL, NULL, 'search', '2025-01-14 16:04:32', NULL, NULL),
(50, 27, NULL, NULL, 'search', '2025-01-14 16:04:38', NULL, NULL),
(51, 27, NULL, NULL, 'search', '2025-01-14 16:04:44', NULL, NULL),
(52, 28, 23, NULL, 'view', '2025-01-14 16:05:11', NULL, NULL),
(53, 28, 16, NULL, 'view', '2025-01-14 16:05:14', NULL, NULL),
(54, 28, NULL, NULL, 'search', '2025-01-14 16:05:21', NULL, NULL),
(55, 28, NULL, NULL, 'search', '2025-01-14 16:05:32', NULL, NULL),
(56, 28, 1, NULL, 'view', '2025-01-14 16:05:34', NULL, NULL),
(57, 42, 32, NULL, 'view', '2025-01-14 16:07:57', NULL, NULL),
(58, 42, 9, NULL, 'view', '2025-01-14 16:08:02', NULL, NULL),
(59, 42, 14, NULL, 'view', '2025-01-14 16:08:09', NULL, NULL),
(60, 42, NULL, NULL, 'search', '2025-01-14 16:08:14', NULL, NULL),
(61, 42, NULL, NULL, 'search', '2025-01-14 16:08:22', NULL, NULL),
(62, 36, 7, NULL, 'view', '2025-01-14 16:13:10', NULL, NULL),
(63, 36, 9, NULL, 'view', '2025-01-14 16:13:12', NULL, NULL),
(64, 36, 31, NULL, 'view', '2025-01-14 16:13:18', NULL, NULL),
(65, 36, NULL, NULL, 'search', '2025-01-14 16:13:23', NULL, NULL),
(66, 36, 34, NULL, 'view', '2025-01-14 16:13:25', NULL, NULL),
(67, 35, 10, NULL, 'view', '2025-01-14 16:13:54', NULL, NULL),
(68, 35, 29, NULL, 'view', '2025-01-14 16:14:05', NULL, NULL),
(69, 35, NULL, NULL, 'search', '2025-01-14 16:14:14', NULL, NULL),
(70, 35, 14, NULL, 'view', '2025-01-14 16:14:17', NULL, NULL),
(71, 35, 12, NULL, 'view', '2025-01-14 16:14:20', NULL, NULL),
(72, 34, 18, NULL, 'view', '2025-01-14 16:14:47', NULL, NULL),
(73, 34, 30, NULL, 'view', '2025-01-14 16:14:51', NULL, NULL),
(74, 34, 2, NULL, 'view', '2025-01-14 16:14:55', NULL, NULL),
(75, 34, NULL, NULL, 'search', '2025-01-14 16:15:02', NULL, NULL),
(76, 33, 11, NULL, 'view', '2025-01-14 16:15:28', NULL, NULL),
(77, 33, 15, NULL, 'view', '2025-01-14 16:15:38', NULL, NULL),
(78, 33, 5, NULL, 'view', '2025-01-14 16:15:44', NULL, NULL),
(79, 33, NULL, NULL, 'search', '2025-01-14 16:15:57', NULL, NULL),
(80, 33, 3, NULL, 'view', '2025-01-14 16:15:59', NULL, NULL),
(81, 32, 17, NULL, 'view', '2025-01-14 16:16:31', NULL, NULL),
(82, 32, 16, NULL, 'view', '2025-01-14 16:16:36', NULL, NULL),
(83, 32, NULL, NULL, 'search', '2025-01-14 16:16:42', NULL, NULL),
(84, 31, 23, NULL, 'view', '2025-01-14 16:17:17', NULL, NULL),
(85, 31, 29, NULL, 'view', '2025-01-14 16:17:23', NULL, NULL),
(86, 31, NULL, NULL, 'search', '2025-01-14 16:17:29', NULL, NULL),
(87, 31, NULL, NULL, 'search', '2025-01-14 16:17:29', NULL, NULL),
(88, 30, 26, NULL, 'view', '2025-01-14 16:18:04', NULL, NULL),
(89, 30, 24, NULL, 'view', '2025-01-14 16:18:11', NULL, NULL),
(90, 30, 24, NULL, 'view', '2025-01-14 16:18:13', NULL, NULL),
(91, 30, NULL, NULL, 'search', '2025-01-14 16:18:21', NULL, NULL),
(92, 29, 12, NULL, 'view', '2025-01-14 16:18:46', NULL, NULL),
(93, 29, 11, NULL, 'view', '2025-01-14 16:18:48', NULL, NULL),
(94, 29, NULL, NULL, 'search', '2025-01-20 08:27:47', NULL, NULL),
(95, 29, 21, NULL, 'view', '2025-01-20 08:28:09', NULL, NULL),
(96, 29, 1, NULL, 'view', '2025-01-20 08:28:17', NULL, NULL),
(97, 29, 9, NULL, 'view', '2025-01-20 08:28:22', NULL, NULL),
(98, 29, 4, NULL, 'view', '2025-01-20 08:28:29', NULL, NULL),
(99, 29, 31, NULL, 'view', '2025-01-20 08:28:33', NULL, NULL),
(100, 29, 31, NULL, 'view', '2025-02-02 06:45:14', NULL, NULL),
(101, 29, 5, NULL, 'view', '2025-02-02 06:45:26', NULL, NULL),
(102, 29, 2, NULL, 'view', '2025-02-02 06:45:59', NULL, NULL),
(103, 29, NULL, NULL, 'search', '2025-02-02 06:46:12', NULL, NULL),
(104, 29, 16, NULL, 'view', '2025-02-02 06:46:17', NULL, NULL),
(105, 29, 21, NULL, 'view', '2025-02-11 10:09:59', NULL, NULL),
(106, 29, 31, NULL, 'view', '2025-02-11 10:12:43', NULL, NULL),
(107, 29, 31, NULL, 'view', '2025-02-11 10:12:45', NULL, NULL),
(108, 29, 21, NULL, 'view', '2025-02-11 10:12:47', NULL, NULL),
(109, 29, 21, NULL, 'view', '2025-02-11 10:12:48', NULL, NULL),
(110, 29, 21, NULL, 'view', '2025-02-11 10:12:49', NULL, NULL),
(111, 29, 4, NULL, 'view', '2025-02-11 10:12:50', NULL, NULL),
(112, 29, 31, NULL, 'view', '2025-02-11 10:14:37', NULL, NULL),
(113, 29, 21, NULL, 'view', '2025-02-11 10:14:41', NULL, NULL),
(114, 29, 4, NULL, 'view', '2025-02-11 10:14:43', NULL, NULL),
(115, 29, NULL, 'pkns', 'search', '2025-02-11 10:15:18', NULL, NULL),
(116, 29, NULL, 'pkns', 'search', '2025-02-11 10:30:54', NULL, NULL),
(117, 29, NULL, 'pkns', 'search', '2025-02-11 10:32:04', NULL, NULL),
(118, 29, NULL, 'pkns', 'search', '2025-02-11 10:33:07', NULL, NULL),
(119, 29, NULL, 'pkns', 'search', '2025-02-11 10:37:12', NULL, NULL),
(120, 29, NULL, 'pkns', 'search', '2025-02-11 10:46:01', NULL, NULL),
(121, 29, 9, NULL, 'view', '2025-02-11 10:53:49', NULL, NULL),
(122, 29, 9, NULL, 'view', '2025-02-11 10:53:51', NULL, NULL),
(123, 29, NULL, 'kristal', 'search', '2025-02-11 10:54:35', NULL, NULL),
(124, 29, NULL, 'pkns', 'search', '2025-02-11 10:54:43', NULL, NULL),
(125, 29, NULL, 'pkns', 'search', '2025-02-11 10:55:17', NULL, NULL),
(126, 29, NULL, 'menara i', 'search', '2025-02-11 10:55:27', NULL, NULL),
(127, 29, NULL, 'menara u', 'search', '2025-02-11 10:55:30', NULL, NULL),
(128, 29, 21, NULL, 'view', '2025-02-11 10:56:02', NULL, NULL),
(129, 29, 21, NULL, 'view', '2025-02-11 10:56:03', NULL, NULL),
(130, 29, 21, NULL, 'view', '2025-02-11 10:56:04', NULL, NULL),
(131, 29, 5, NULL, 'view', '2025-02-11 10:56:05', NULL, NULL),
(132, 29, 5, NULL, 'view', '2025-02-11 10:56:31', NULL, NULL),
(133, 29, NULL, 'menara u', 'search', '2025-02-11 10:57:35', NULL, NULL),
(134, 29, 46, NULL, 'view', '2025-02-11 10:57:51', NULL, NULL),
(135, 29, 46, NULL, 'view', '2025-02-11 10:57:52', NULL, NULL),
(136, 29, 46, NULL, 'view', '2025-02-11 10:57:54', NULL, NULL),
(137, 29, 46, NULL, 'view', '2025-02-11 10:57:56', NULL, NULL),
(138, 29, 52, NULL, 'view', '2025-02-11 10:58:14', NULL, NULL),
(139, 29, 31, NULL, 'view', '2025-02-11 11:11:23', NULL, NULL),
(140, 29, 1, NULL, 'view', '2025-02-11 11:11:49', NULL, NULL),
(141, 29, 4, NULL, 'view', '2025-02-11 11:13:17', NULL, NULL),
(142, 29, 4, NULL, 'view', '2025-02-11 11:13:18', NULL, NULL),
(143, 29, 52, NULL, 'view', '2025-02-11 11:20:00', NULL, NULL),
(144, 29, 8, NULL, 'view', '2025-02-11 11:21:52', NULL, NULL),
(145, 29, 3, NULL, 'view', '2025-02-11 11:24:03', NULL, NULL),
(146, 29, 31, NULL, 'view', '2025-02-11 11:24:14', NULL, NULL),
(147, 29, 31, NULL, 'view', '2025-02-11 11:24:31', NULL, NULL),
(148, 29, 52, NULL, 'view', '2025-02-11 11:24:35', NULL, NULL),
(149, 29, 52, NULL, 'view', '2025-02-11 11:24:38', NULL, NULL),
(150, 29, 31, NULL, 'view', '2025-02-11 11:24:45', NULL, NULL),
(151, 29, 1, NULL, 'view', '2025-02-11 11:24:48', NULL, NULL),
(152, 29, 9, NULL, 'view', '2025-02-11 11:33:33', NULL, NULL),
(153, 29, 4, NULL, 'view', '2025-02-11 11:38:34', NULL, NULL),
(154, 29, NULL, 'danaumas', 'search', '2025-02-11 11:38:40', NULL, NULL),
(155, 29, NULL, 'danaumas', 'search', '2025-02-11 11:38:45', NULL, NULL),
(156, 29, NULL, 'kristal', 'search', '2025-02-11 11:38:51', NULL, NULL),
(157, 29, 5, NULL, 'view', '2025-02-11 11:44:56', NULL, NULL),
(158, 29, 5, NULL, 'view', '2025-02-11 11:44:58', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `landlord_id` (`landlord_id`);

--
-- Indexes for table `landlords`
--
ALTER TABLE `landlords`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `property_number` (`property_number`),
  ADD KEY `landlord_id` (`landlord_id`);

--
-- Indexes for table `property_media`
--
ALTER TABLE `property_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_property_interactions`
--
ALTER TABLE `user_property_interactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `property_id` (`property_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `landlords`
--
ALTER TABLE `landlords`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `property_media`
--
ALTER TABLE `property_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `user_property_interactions`
--
ALTER TABLE `user_property_interactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_ibfk_1` FOREIGN KEY (`landlord_id`) REFERENCES `landlords` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `landlords`
--
ALTER TABLE `landlords`
  ADD CONSTRAINT `landlords_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_ibfk_1` FOREIGN KEY (`landlord_id`) REFERENCES `landlords` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `property_media`
--
ALTER TABLE `property_media`
  ADD CONSTRAINT `property_media_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_property_interactions`
--
ALTER TABLE `user_property_interactions`
  ADD CONSTRAINT `user_property_interactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_property_interactions_ibfk_2` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
