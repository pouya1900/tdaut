-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2023 at 04:12 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tdaut`
--

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`id`, `email`, `email_verified_at`, `password`, `role_id`, `confirmation_token`, `reset_token`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'example_admin@gmail.com', '2022-11-21 08:21:37', '$2y$10$YL69X.pypO2Cr5ki030zYevK/.LucLTe1wMHSMgMMpE23F0cCVC2O', 1, NULL, NULL, 'axdCRUIvJLIJ9j5NJGXBKzwkHCzawh0cbWRP5j4PAsUSHoxRiUJL2K0zzm5h', '2022-11-21 08:21:37', '2022-12-06 06:06:38');

--
-- Dumping data for table `admin_permissions`
--

INSERT INTO `admin_permissions` (`id`, `name`, `title`, `created_at`, `updated_at`) VALUES
(1, '*', 'همه دسترسی ها', '2022-11-21 08:27:02', '2022-11-21 08:27:02'),
(2, 'office.*', 'دفاتر', '2022-12-07 11:33:17', '2022-12-07 11:33:17'),
(3, 'product.*', 'محصولات', '2022-12-07 11:33:17', '2022-12-07 11:33:17'),
(4, 'user.*', 'کارفرمایان', '2022-12-07 11:33:17', '2022-12-07 11:33:17'),
(5, 'member.*', 'اعضا', '2022-12-07 11:33:17', '2022-12-07 11:33:17'),
(6, 'support.*', 'پشتیبانی', '2022-12-07 11:33:17', '2022-12-07 11:33:17'),
(7, 'category.*', 'دسته بندی ها', '2022-12-07 11:33:17', '2022-12-07 11:33:17'),
(8, 'report.*', 'گزارشات', '2022-12-07 11:33:17', '2022-12-07 11:33:17'),
(9, 'list.*', 'لیست دانشکده ها ، مرتبه های علمی ، مقاطع تحصیلی ، تگ ها و...', '2022-12-07 11:33:17', '2022-12-07 11:33:17');

--
-- Dumping data for table `admin_permission_role`
--

INSERT INTO `admin_permission_role` (`id`, `permission_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2022-11-21 08:27:33', '2022-11-21 08:27:33');

--
-- Dumping data for table `admin_roles`
--

INSERT INTO `admin_roles` (`id`, `name`, `title`, `created_at`, `updated_at`) VALUES
(1, 'super', 'مدیر کل سامانه', '2022-11-21 08:25:54', '2022-11-21 08:25:54');

--
-- Dumping data for table `office_permissions`
--

INSERT INTO `office_permissions` (`id`, `name`, `title`, `created_at`, `updated_at`) VALUES
(1, '*', 'همه دسترسی ها', '2022-09-19 13:12:40', '2022-09-19 13:12:40'),
(2, 'product.*', 'مدیریت محصولات', '2022-09-19 14:05:11', '2022-09-19 14:05:11'),
(3, 'capability.*', 'توانمندی ها', '2022-10-21 10:03:06', '2022-10-21 10:03:06'),
(4, 'member.*', 'کاربران', '2022-10-21 10:03:41', '2022-10-21 10:03:41'),
(5, 'update.*', 'ویرایش اطلاعات دفتر', '2022-10-21 10:05:58', '2022-10-21 10:05:58'),
(6, 'content.*', 'مدیریت محتوا', '2023-01-22 13:52:14', '2023-01-22 13:52:14'),
(7, 'role.*', 'مدیریت سمت ها', '2023-01-22 13:53:39', '2023-01-22 13:53:39'),
(8, 'support.*', 'مدیریت پشتیبانی', '2023-01-22 13:54:12', '2023-01-22 13:54:12'),
(9, 'message.*', 'مدیریت پیام ها', '2023-01-22 13:55:25', '2023-01-22 13:55:25'),
(10, 'rfp.*', 'مدیریت rfp', '2023-01-22 13:56:02', '2023-01-22 13:56:02');

--
-- Dumping data for table `office_roles`
--

INSERT INTO `office_roles` (`id`, `name`, `title`, `created_at`, `updated_at`) VALUES
(1, 'head', 'رئیس', '2022-08-27 11:16:10', '2022-08-27 11:16:10'),
(2, 'board', 'هیئت مدیره', '2022-09-05 06:44:33', '2022-09-05 06:44:33');

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `title`, `created_at`, `updated_at`) VALUES
(1, 'rfp.*', 'ارسال rfp', '2022-09-19 15:42:09', '2022-09-19 15:42:09'),
(2, 'chat.*', 'چت با دفاتر', '2022-10-01 08:25:07', '2022-10-01 08:25:07');

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2022-09-19 15:42:33', '2022-09-19 15:42:33'),
(2, 2, 1, '2022-09-19 15:42:33', '2022-09-19 15:42:33');

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `profileable_id`, `profileable_type`, `first_name`, `last_name`, `username`, `gender`, `birthday`, `about`, `linkedin`, `github`, `created_at`, `updated_at`) VALUES
(1, 1, 'App\\Models\\Administrator', 'دکتر', 'غفاری نژاد', 'ghafari', 'male', NULL, 'hgyft ftf tft', NULL, 'dsfsd.com', '2022-11-15 05:55:43', '2022-12-06 05:49:20');

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `title`, `created_at`, `updated_at`) VALUES
(1, 'employer', 'کارفرما', '2022-09-19 07:50:56', '2022-09-19 07:50:56');

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `title`, `email`, `address`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'توسعه فناوری امیرکبیر', 'itech@aut.ac.ir', 'asacas', '55224', '2022-07-27 04:41:05', '2023-01-18 11:09:06');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
