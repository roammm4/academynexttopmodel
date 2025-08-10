-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2025 at 05:22 PM
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
-- Database: `academyntm`
--

-- --------------------------------------------------------

--
-- Table structure for table `awards`
--

CREATE TABLE `awards` (
  `id` int(11) NOT NULL,
  `id_model` int(11) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `event_name` varchar(255) DEFAULT NULL,
  `year` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id_bookings` int(11) NOT NULL,
  `id_model` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `careers`
--

CREATE TABLE `careers` (
  `id` int(11) NOT NULL,
  `id_model` int(11) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `event_name` varchar(255) DEFAULT NULL,
  `year` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, '2024_05_18_000001_update_foreign_keys_to_cascade', 1);

-- --------------------------------------------------------

--
-- Table structure for table `models`
--

CREATE TABLE `models` (
  `id_model` int(11) NOT NULL,
  `nama_model` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `shoes_size` int(11) DEFAULT NULL,
  `bust` int(11) DEFAULT NULL,
  `waist` int(11) DEFAULT NULL,
  `size` varchar(50) DEFAULT NULL,
  `experience` text DEFAULT NULL,
  `categories` enum('kids','teens') DEFAULT NULL,
  `status` enum('available','unavailable') DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `models`
--

INSERT INTO `models` (`id_model`, `nama_model`, `city`, `age`, `height`, `weight`, `shoes_size`, `bust`, `waist`, `size`, `experience`, `categories`, `status`, `photo`) VALUES
(7, 'Afia Khansa Rafani', 'Bogor,  Jawa Barat', 11, 160, 40, 38, 73, 65, 'xs', '1 Years', 'teens', 'available', 'photos/NJP5dJwA7L504LSMlFVuf1FqDBzvpgykXYKfEKp8.png'),
(8, 'Camilla Aleecea', 'Bekasi,  Jawa Barat', 15, 166, 50, 39, 78, 63, 'S', '1 Years', 'teens', 'available', 'photos/z9gftwpEXuv9ojtpMPg8iel51R2LF4Yhpw85ktFC.png'),
(9, 'Violla Alexandria Kirana', 'Jakarta, DKI Jakarta', 10, 141, 37, 37, 73, 67, 'S', '6 Month', 'kids', 'available', 'photos/LCJzL3AXmh4C3xIxlPLHq8PJWoLwVKrv3XQzuMeJ.png'),
(10, 'Clarissa Cheryl Steyz', 'Tangerang, Banten', 6, 121, 23, 30, 65, 60, 'M', '3 Years', 'kids', 'available', 'photos/SHrZwa6lrR2COlOwElJPq0A0GsLrvFFBIVmZiKhJ.png');

-- --------------------------------------------------------

--
-- Table structure for table `portfolios`
--

CREATE TABLE `portfolios` (
  `id_portfolios` int(11) NOT NULL,
  `id_model` int(11) DEFAULT NULL,
  `nama_model` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `portfolios`
--

INSERT INTO `portfolios` (`id_portfolios`, `id_model`, `nama_model`, `photo`, `description`) VALUES
(22, 7, 'Afia Khansa Rafani', 'portfolio/iq0YHxDH9cEDkAgPf8ks4qYKtGPRTGbEfzTWLCsJ.png', 'slot_1'),
(23, 7, 'Afia Khansa Rafani', 'portfolio/Cdbgj3GloYggFd21o0GAYWnovI5FuEu6POaDOEOj.png', 'slot_2'),
(24, 7, 'Afia Khansa Rafani', 'portfolio/kemYpnFeYOXCT3tYKgAr4viOGN6FfYD7IWBwyh7b.png', 'slot_3'),
(25, 7, 'Afia Khansa Rafani', 'portfolio/qIrkhBoSsgrMvJBhf3tqBU1pyRXSzHQFDZ6cUc54.png', 'slot_4'),
(26, 7, 'Afia Khansa Rafani', 'portfolio/W8ZJlwZTpVBzajSK6LOhdvQInS1h2QkStBdig00r.png', 'slot_5'),
(27, 8, 'Camilla Aleecea', 'portfolio/xdV2FeE8mgqq3FQD6zZnBXVcPM2E38SPKKf3BFIP.png', 'slot_1'),
(28, 8, 'Camilla Aleecea', 'portfolio/76niA3NF3bsxMkZiy4M4LJoGocH6jYKHM4Zr0Yqq.png', 'slot_2'),
(29, 8, 'Camilla Aleecea', 'portfolio/mtWDpqxBaMHGSG0ZlOHqULV09pJ8pJQMsM7ie99v.png', 'slot_3'),
(30, 8, 'Camilla Aleecea', 'portfolio/OEUTdnEQcymAmOpDTah20pFIhWKkxgRY98YLwioD.png', 'slot_4'),
(31, 8, 'Camilla Aleecea', 'portfolio/yJq28XWTdN5FYCo1XFzpnn1ub27TSS6iSkkF9Nef.png', 'slot_5'),
(32, 9, 'Violla Alexandria Kirana', 'portfolio/35ETiLW1tmSsLIBvci5yEXuQbGsk5L3zJEuxPLFx.png', 'slot_1'),
(33, 9, 'Violla Alexandria Kirana', 'portfolio/KWswJ1DtDXPs1gmYOyuwN36RMrXw5xKGGy0dedrm.png', 'slot_2'),
(34, 9, 'Violla Alexandria Kirana', 'portfolio/FxgUYYVq6R6VUTdYZshsT7Sc4UBN5eqMoC8GzDqw.png', 'slot_3'),
(35, 9, 'Violla Alexandria Kirana', 'portfolio/PkL0sLhOeNsqHjyaTqWaGYNmSf3ccLGfw6u35e6G.png', 'slot_4'),
(36, 9, 'Violla Alexandria Kirana', 'portfolio/9vFYhlphxtOzx7JUQniK1JrNcUaI2EATf5BaTBlU.png', 'slot_5'),
(37, 10, 'Clarissa Cheryl Steyz', 'portfolio/5MMpRuB3uOnB8vW6vsWqfcTiAMMVdcVUIeSczhrS.png', 'slot_1'),
(38, 10, 'Clarissa Cheryl Steyz', 'portfolio/udfzLFM2fQgH12ik4T1klZoZEuZRPCI661coc6uX.png', 'slot_2'),
(39, 10, 'Clarissa Cheryl Steyz', 'portfolio/xxjQrbzGqzkcKy1qlPAPHCmwUov90ZvhdMf4szBO.png', 'slot_3'),
(40, 10, 'Clarissa Cheryl Steyz', 'portfolio/w6lOd1MnVZqYoHb7nQGZdNOb8qlvFetWCYlkB3CE.png', 'slot_4'),
(41, 10, 'Clarissa Cheryl Steyz', 'portfolio/CYMaATyaBsTBpPNlMIlZ4Z1Z3Uf3PivIBinRhS2b.png', 'slot_5');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `number_phone` varchar(20) DEFAULT NULL,
  `role` enum('admin','client') DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `name`, `email`, `password`, `number_phone`, `role`, `remember_token`) VALUES
(1, 'admin', 'admin@a', '$2y$12$AsFkkODzpY5wAqRUsVzADugUf/CRq3NIhZhFdbTMsmS.2EnpCy0FW', '0987654321', 'admin', '7VXAQ7TlUYOeIPGCTzQxo6YA1TtPR33JmRZy9FfSApUZxQqUhP8F876xIhuL'),
(4, 'Faiz Firstian Nugroho', 'nugrohofaiz99@gmail.com', '$2y$12$ueUGKzz/sE25p.1BbTTEbOIyaRBUaqAiPpKab5om6nUcvNZkNYO2W', '08979359266', 'client', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `awards`
--
ALTER TABLE `awards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `awards_id_model_foreign` (`id_model`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id_bookings`),
  ADD KEY `id_model` (`id_model`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `careers`
--
ALTER TABLE `careers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `careers_id_model_foreign` (`id_model`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`id_model`);

--
-- Indexes for table `portfolios`
--
ALTER TABLE `portfolios`
  ADD PRIMARY KEY (`id_portfolios`),
  ADD KEY `id_model` (`id_model`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `awards`
--
ALTER TABLE `awards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id_bookings` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `careers`
--
ALTER TABLE `careers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `models`
--
ALTER TABLE `models`
  MODIFY `id_model` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `portfolios`
--
ALTER TABLE `portfolios`
  MODIFY `id_portfolios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `awards`
--
ALTER TABLE `awards`
  ADD CONSTRAINT `awards_id_model_foreign` FOREIGN KEY (`id_model`) REFERENCES `models` (`id_model`) ON DELETE CASCADE;

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`id_model`) REFERENCES `models` (`id_model`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `careers`
--
ALTER TABLE `careers`
  ADD CONSTRAINT `careers_id_model_foreign` FOREIGN KEY (`id_model`) REFERENCES `models` (`id_model`) ON DELETE CASCADE;

--
-- Constraints for table `portfolios`
--
ALTER TABLE `portfolios`
  ADD CONSTRAINT `portfolios_id_model_foreign` FOREIGN KEY (`id_model`) REFERENCES `models` (`id_model`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
