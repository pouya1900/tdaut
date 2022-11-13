-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2022 at 04:16 PM
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
-- Dumping data for table `capabilities`
--

INSERT INTO `capabilities` (`id`, `office_id`, `text`, `created_at`, `updated_at`) VALUES
(21, 9, 'تولید نرم افزار های تجاری قدرتمند', '2022-10-21 12:03:06', '2022-10-21 12:03:06'),
(22, 9, 'ساخت ابزار الات مکانیکی نوین', '2022-10-21 12:03:06', '2022-10-21 12:03:06');

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'سیستم', '', '2022-08-28 06:43:04', '2022-08-28 06:43:04'),
(2, 'نرم افزار', '', '2022-08-28 06:43:04', '2022-08-28 06:43:04'),
(3, 'ماژول', '', '2022-08-28 06:43:04', '2022-08-28 06:43:04');

--
-- Dumping data for table `degrees`
--

INSERT INTO `degrees` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'کارشناسی', '2022-09-05 11:23:31', '2022-09-05 11:23:31');

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'مکانیک', '2022-08-27 11:16:46', '2022-08-27 11:16:46');

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `title`, `description`, `office_id`, `user_id`, `parent_id`, `type`, `created_at`, `updated_at`) VALUES
(1, 'scasc', 'sca cscascsa', 1, 1, 0, 'rfp', '2022-09-30 04:28:35', '2022-09-30 04:28:35'),
(3, 'sa sa', 'sa fasf afsf', 1, 1, 0, 'proposal', '2022-09-30 04:33:13', '2022-09-30 04:33:13'),
(4, 'sa sa', 'sa fasf afsf', 1, 1, 0, 'rfp', '2022-09-30 05:08:12', '2022-09-30 05:08:12'),
(5, 'sa sa', 'sa fasf afsf', 1, 1, 0, 'rfp', '2022-09-30 05:17:58', '2022-09-30 05:17:58'),
(6, 'sa sa', 'sa fasf afsf', 1, 1, 0, 'rfp', '2022-09-30 05:20:00', '2022-09-30 05:20:00'),
(7, 'fsf asf ss', 'fas fsfaf', 1, 1, 1, 'proposal', '2022-11-03 08:02:13', '2022-11-03 08:02:13'),
(8, 'dsf dfsfs', 'f sdfsdfsdf dfs', 1, 1, 4, 'proposal', '2022-11-03 08:07:19', '2022-11-03 08:07:19');

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `title`, `model_type`, `ext`, `size`, `width`, `height`, `duration`, `mediable_type`, `mediable_id`, `created_at`, `updated_at`) VALUES
(2, 'img_nature_wide.jpg', 'officeSlideshow', 'jpg', 0, NULL, NULL, NULL, 'App\\Models\\Office', 1, '2022-08-27 12:23:36', '2022-08-27 12:23:36'),
(3, 'img_snow_wide.jpg', 'officeSlideshow', 'jpg', 0, NULL, NULL, NULL, 'App\\Models\\Office', 1, '2022-08-27 12:23:36', '2022-08-27 12:23:36'),
(4, 'img_mountains_wide.jpg', 'officeSlideshow', 'jpg', 0, NULL, NULL, NULL, 'App\\Models\\Office', 1, '2022-08-27 12:23:36', '2022-08-27 12:23:36'),
(5, 'Tolkien.jpg', 'avatar', 'jpg', 0, NULL, NULL, NULL, 'App\\Models\\Profile', 1, '2022-08-27 11:36:44', '2022-08-27 11:36:44'),
(6, 'uav.png', 'productLogo', 'png', 0, NULL, NULL, NULL, 'App\\Models\\Product', 1, '2022-08-27 11:36:44', '2022-08-27 11:36:44'),
(7, 'lkBzqzCS0xPLSLQFazB7MXdqVf46dEfU4VTAp2Dh.docx', 'rfp', 'docx', 14068, NULL, NULL, NULL, 'App\\Models\\Document', 5, '2022-09-30 05:17:58', '2022-09-30 05:17:58'),
(8, 'ooU9G6G3Up5PRzXF4sGr6I2EHbdv19fBh2pudW3k.docx', 'rfp', 'docx', 14, NULL, NULL, NULL, 'App\\Models\\Document', 6, '2022-09-30 05:20:00', '2022-09-30 05:20:00'),
(9, 'AO6VwhWijXxtAQXLYZwyJlEzkZlaRLHOlbCTJAgh.pdf', 'cv', 'pdf', 373, NULL, NULL, NULL, 'App\\Models\\Profile', 1, '2022-10-03 18:56:27', '2022-10-03 18:56:27'),
(10, 'kgkIXCoAH3y2LHpnYuIBfjKwr7sZ26Vy5oTdFzKo.pdf', 'rfp', 'pdf', 3543, NULL, NULL, NULL, 'App\\Models\\Document', 7, '2022-11-03 08:02:13', '2022-11-03 08:02:13'),
(11, 'eMLZZCIHR23lynx1QBiRj6RBBUakhqzBHq7PTEuU.pdf', 'rfp', 'pdf', 46, NULL, NULL, NULL, 'App\\Models\\Document', 8, '2022-11-03 08:07:19', '2022-11-03 08:07:19'),
(13, 'dzbmarQl8L2lRFQqDdCceNLnHhlYCRn6U9FUVlbx.png', NULL, 'png', 266, 1920, 1080, NULL, NULL, NULL, '2022-11-08 08:30:50', '2022-11-08 08:30:50'),
(14, 'RZ4k6PIdViW6BtroEbgDxYjh3daUfvTAFcnoSRLW.png', NULL, 'png', 263, 1920, 1080, NULL, NULL, NULL, '2022-11-08 08:30:50', '2022-11-08 08:30:50'),
(15, 'cgpLfo0uodH2NUkmGOFOkk8d08MnDsLhBU27A3Fk.png', NULL, 'png', 266, 1920, 1080, NULL, NULL, NULL, '2022-11-08 08:32:18', '2022-11-08 08:32:18'),
(16, 'fvEU1BRbm1jlHevtdlmesfPN6GxBi4gjMyDbPFie.png', NULL, 'png', 263, 1920, 1080, NULL, NULL, NULL, '2022-11-08 08:32:18', '2022-11-08 08:32:18'),
(17, 'KYycdd4gRPT2zEXf3C064f0DCf1p5eIChJOLgArr.png', NULL, 'png', 864, 1920, 1080, NULL, NULL, NULL, '2022-11-08 08:48:44', '2022-11-08 08:48:44'),
(18, 'W4m1XqmX6hsJ4SVKc7h6BNpOoyFH3bE5QlH4yqlR.png', NULL, 'png', 890, 1920, 1080, NULL, NULL, NULL, '2022-11-08 08:48:44', '2022-11-08 08:48:44'),
(19, 'Fst5SyQHI6wYXe0C4AAFYqOcaEouVrxLQIacHWz1.png', NULL, 'png', 864, 1920, 1080, NULL, NULL, NULL, '2022-11-08 08:52:00', '2022-11-08 08:52:00'),
(20, 'G59cHYQ6drFbhwoQiaNhZFEgZ6wetWRGJvCMX4O3.png', NULL, 'png', 890, 1920, 1080, NULL, NULL, NULL, '2022-11-08 08:52:00', '2022-11-08 08:52:00'),
(21, 'qVZ1NvAhgn9o0ISBRlOTSgcz7yu30RFUtLDw9wdX.png', NULL, 'png', 232, 1920, 1080, NULL, NULL, NULL, '2022-11-08 09:30:57', '2022-11-08 09:30:57'),
(22, '7hlE2JAT90UqkSQ58qXbUkWUVTrnjSFXqm7vDiHW.png', NULL, 'png', 266, 1920, 1080, NULL, NULL, NULL, '2022-11-08 09:30:57', '2022-11-08 09:30:57'),
(23, 'GBWM7k3LIloZtPCAQqfvvPFHtuB5GbLtcW7LNRIc.png', NULL, 'png', 266, 1920, 1080, NULL, NULL, NULL, '2022-11-08 09:31:28', '2022-11-08 09:31:28'),
(24, 'EUzGILvnST0s9bXvSh32XVctkA7WzcKiVDCHQWte.png', NULL, 'png', 263, 1920, 1080, NULL, NULL, NULL, '2022-11-08 09:31:28', '2022-11-08 09:31:28'),
(25, 'qes9OHkarMV2S7FG8qj3bq98s2LSGyS7chPIKdqV.png', NULL, 'png', 849, 1920, 1080, NULL, NULL, NULL, '2022-11-08 09:31:28', '2022-11-08 09:31:28'),
(26, '3VuuHbRzdm9m0Ml6KuFwaO0cClIKDEQDSaCahIIB.png', NULL, 'png', 232, 1920, 1080, NULL, NULL, NULL, '2022-11-08 09:31:46', '2022-11-08 09:31:46'),
(27, 'Ch8eXRers64yhSpYNtrPLtmmrO1w3FtriXkfbgaC.png', NULL, 'png', 266, 1920, 1080, NULL, NULL, NULL, '2022-11-08 09:31:46', '2022-11-08 09:31:46'),
(28, 'Tfi5nN5N5b9lP0GznOLNZH3WwUvYTTZatt4UgkXs.png', NULL, 'png', 263, 1920, 1080, NULL, NULL, NULL, '2022-11-08 09:31:46', '2022-11-08 09:31:46'),
(29, 'TC8FmmnYJd9W6SLWuJ4B08sNXNYzXrZJGCLoNLmM.png', NULL, 'png', 864, 1920, 1080, NULL, NULL, NULL, '2022-11-08 09:31:46', '2022-11-08 09:31:46'),
(30, 'o9q9TyGPXni0B1Vt2tWLu4l3TL5P7wKev7o2wQjf.png', NULL, 'png', 232, 1920, 1080, NULL, NULL, NULL, '2022-11-08 09:33:01', '2022-11-08 09:33:01'),
(31, 'jpUXKvKEt9WgC9mM7hQUnhJbMxmYdry92PhKjSU9.png', NULL, 'png', 232, 1920, 1080, NULL, NULL, NULL, '2022-11-08 10:04:25', '2022-11-08 10:04:25'),
(32, '6hPgd7VkwU5mdQWLVxwXOP3BRKvAkPMAOQGDmgAr.png', NULL, 'png', 266, 1920, 1080, NULL, NULL, NULL, '2022-11-08 10:04:25', '2022-11-08 10:04:25'),
(33, 'gEV0yQJA89Gj4o8YrML0EakH3ob6ZNLhbwgcw2XX.png', NULL, 'png', 47, 1527, 752, NULL, NULL, NULL, '2022-11-08 10:26:43', '2022-11-08 10:26:43'),
(37, 'dxrlD7arO2jTTdr7muTh2qST2gJlJOGIIxbdzr7e.png', 'productImage', 'png', 890, 1920, 1080, NULL, 'App\\Models\\Product', 5, '2022-11-09 04:36:40', '2022-11-09 04:36:48'),
(38, 'rTzPnSjoSoVZau78HHH7E1X9OgJea0VUW0xOiG4s.png', 'productImage', 'png', 263, 1920, 1080, NULL, 'App\\Models\\Product', 5, '2022-11-09 04:36:46', '2022-11-09 04:36:48'),
(39, 'odv0YMOkpxLYNkOoDc4CRbag4sBmBD4bToqWiCoK.mp4', NULL, 'mp4', 10435, NULL, NULL, NULL, 'App\\Models\\Product', 5, '2022-11-09 10:17:43', '2022-11-09 10:17:43'),
(50, 'NZrIK1rT2aRcOI1juUtCzajY7j2uQi3nQC9XIbbO.png', 'productImage', 'png', 232, 1920, 1080, NULL, 'App\\Models\\Product', 6, '2022-11-13 04:57:29', '2022-11-13 04:57:31'),
(51, 'SakHjkLx6Roq8e9ambrIZdrbUW02sCfSeNCN43as.png', 'productImage', 'png', 266, 1920, 1080, NULL, 'App\\Models\\Product', 6, '2022-11-13 04:57:29', '2022-11-13 04:57:31'),
(52, 'UwO4qOzTpsiQPGdRJxMlCelWkeNBaYf7uP1LPnSo.png', 'productLogo', 'png', 864, 1920, 1080, NULL, 'App\\Models\\Product', 6, '2022-11-13 04:57:31', '2022-11-13 04:57:31'),
(53, 'QXZSmPAQwAkjREAt05vBTACjNRESqDy541wgg14E.mp4', 'productVideo', 'mp4', 10435, NULL, NULL, NULL, 'App\\Models\\Product', 6, '2022-11-13 04:58:04', '2022-11-13 04:58:04'),
(56, 'fVb3zU6A1NQuwSyFfuHW0W1z5vusBMLISioq9r8Y.png', 'officeLogo', 'png', 3, 225, 225, NULL, 'App\\Models\\Office', 1, '2022-11-13 05:03:00', '2022-11-13 05:03:00');

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `type`, `email`, `email_verified_at`, `password`, `rank_id`, `department_id`, `group`, `degree_id`, `student_number`, `confirmation_token`, `reset_token`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'professor', 'example_member@gmail.com', '2022-08-27 11:15:01', '$2y$10$YL69X.pypO2Cr5ki030zYevK/.LucLTe1wMHSMgMMpE23F0cCVC2O', 1, 1, 'csacasa', NULL, NULL, NULL, NULL, 'lmOLyh5SpSPgUffArZwJoFMsqP8bZESpTGSO9EIP3gVFWNn3CJ5d5oXMYDKm', '2022-08-27 11:15:01', '2022-10-08 05:49:08'),
(2, 'student', 'vvv@gmail.com', '2022-08-27 11:16:46', '', NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, '2022-08-27 11:16:46', '2022-08-27 11:16:46'),
(5, 'professor', 'poyyarahvar@gmail.com', '2022-09-17 10:12:07', '$2y$10$V/nQurBcg9ZLl.LFKD9ByOLj8bL8Q778UamxP9ZiduyC1.XhwRmxC', 1, 1, 'سیالات', NULL, NULL, '3NjtmwN03kdC', NULL, 'cz277nTAvWhZrAckJNoZ0TW5L1beWho4iMyZ4VDOZMfGXP2wCglsrXCmjFVs', '2022-09-17 10:04:53', '2022-09-17 10:12:07');

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `office_id`, `user_id`, `sender`, `text`, `seen_at`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'user', 'سلام', NULL, '2022-10-02 06:24:08', '2022-10-02 06:24:08'),
(2, 1, 1, 'office', 'سلام', NULL, '2022-10-03 06:24:08', '2022-10-03 06:24:08'),
(3, 1, 1, 'user', 'روزبخیر', NULL, '2022-10-03 06:24:10', '2022-10-03 06:24:08'),
(4, 1, 1, 'user', 'می خواستم از محصولاتتون دیدن کنم', NULL, '2022-10-03 06:24:18', '2022-10-03 06:24:08'),
(5, 1, 1, 'office', 'متاسفانه امکان نمایش حضوری نمی باشد. لطفا از بخش rfp اقدام به درخواست برای پروپوزال بفرمایید .', NULL, '2022-10-03 06:24:49', '2022-10-03 06:24:08'),
(6, 1, 1, 'office', 'متاسفانه امکان نمایش حضوری نمی باشد. لطفا از بخش rfp اقدام به درخواست برای پروپوزال بفرمایید .', NULL, '2022-10-03 06:25:08', '2022-10-03 06:24:08'),
(7, 1, 1, 'office', 'متاسفانه امکان نمایش حضوری نمی باشد. لطفا از بخش rfp اقدام به درخواست برای پروپوزال بفرمایید .', NULL, '2022-10-03 06:28:08', '2022-10-03 06:24:08'),
(8, 1, 1, 'user', 'می خواستم از محصولاتتون دیدن کنم', NULL, '2022-10-03 06:29:08', '2022-10-03 06:24:08'),
(9, 1, 1, 'user', 'می خواستم از محصولاتتون دیدن کنم', NULL, '2022-10-03 09:24:08', '2022-10-03 06:24:08'),
(10, 1, 1, 'user', 'می خواستم از محصولاتتون دیدن کنم', NULL, '2022-10-03 12:24:08', '2022-10-03 06:24:08'),
(11, 1, 1, 'office', 'متاسفانه امکان نمایش حضوری نمی باشد. لطفا از بخش rfp اقدام به درخواست برای پروپوزال بفرمایید .', NULL, '2022-10-25 17:24:08', '2022-10-03 06:24:08'),
(12, 1, 1, 'office', 'خوشا پرواز ما حتی به باغ خشک بی باران', NULL, '2022-11-02 04:11:22', '2022-11-02 04:11:22'),
(13, 1, 2, 'office', 'سلام', NULL, '2022-11-02 04:39:54', '2022-11-02 04:39:54');

--
-- Dumping data for table `offices`
--

INSERT INTO `offices` (`id`, `name`, `about`, `phone`, `email`, `address`, `admin_contact`, `department_id`, `content`, `projects_count`, `status`, `status_message`, `status_date`, `created_at`, `updated_at`) VALUES
(1, 'دفتر توسعه مالی', 'لورم ایپسوم یک متن ساختگی با تولید ساختگی نامفهوم از صنعت چاپ و با استفاده\r\n                                            از\r\n                                            طراحان\r\n                                            گرافیک است.', '2326515', 'eee@gmail.com', 'یتسرذذ عسغیرسیغرذ', '56115616', 1, '<div class=\"PageContainer\">\r\n<section id=\"About_WhatIsCIP\" class=\"Page_Info dflt-txt-align  wow fadeIn animated\" data-wow-duration=\"2s\" data-wow-delay=\"0.5s\">\r\n<div style=\"text-align: right;\">\r\n<div><strong><span style=\"font-size: 14pt;\">CIP</span><span style=\"font-size: 18pt;\"> چیست؟</span></strong></div>\r\n<div>\"<span style=\"font-size: 12pt;\">CIP</span>\"<span style=\"font-size: 12pt;\"> مخفف \"شخص تجاری مهم\"</span> (<span style=\"font-size: 12pt;\">commercial important person)</span> <span style=\"font-size: 12pt;\">است. سی آی پی تهران سرویسی است در ساختمانی سه طبقه در فرودگاه بین المللی امام که مسافران خروجی یا ورودی در حین سپری کردن زمان خود، تشریفات مراحل چک این و چک آوت انجام میشود. این ساختمان دارای یک سالن دو طبقه، یک اتاق نشیمن بزرگ مشرف به باند، یک رستوران سلف سرویس با سرو انواع غذا، نوشیدنی، دسر، شیرینی و غیره در طول روز، نمازخانه، سالن کنفرانس تا سقف می باشد. 15 نفر، اتاق کنفرانس VIP، کنسول بازی های ویدئویی برای سرگرمی کودکان، مغازه های فروش صنایع دستی، عطر، آجیل و ...، دستگاه های خودپرداز و اتاق ها و خدمات دیگر. مسافران پروازهای ورودی و خروجی می توانند در حین توقف در فرودگاه از مناطق و خدمات مختلف ترمینال CIP بهره مند شوند. از دیگر امکانات موجود در ترمینال CIP می توان به گیت امنیتی و گمرکی و تحویل بار، پارکینگ های اختصاصی با ظرفیت 88 خودرو و پارکینگ موقت در فضای باز اشاره کرد. ما به تمام پله های یک هواپیما برای مسافران خروجی یا ورود به هتل برای مسافران ورودی فکر می کنیم که خدمات منحصر به فردی را با تمام جزئیات ارائه می دهد.</span></div>\r\n<div><span style=\"font-size: 12pt;\">خدمات CIP شامل موارد زیر است.</span></div>\r\n<div>\r\n<ul>\r\n<li><span style=\"font-size: 12pt;\">تحویل کارت پرواز</span></li>\r\n<li><span style=\"font-size: 12pt;\">تحویل چمدان ها توسط کارکنان CIP </span></li>\r\n<li><span style=\"font-size: 12pt;\">امور گمرکی مسافران</span></li>\r\n<li><span style=\"font-size: 12pt;\">گذرنامه و کنترل پاسپورت</span></li>\r\n<li><span style=\"font-size: 12pt;\">مسائل مربوط به حیوانات خانگی</span></li>\r\n<li><span style=\"font-size: 12pt;\">خوردن و نوشیدن</span></li>\r\n<li><span style=\"font-size: 12pt;\">اگر هواپیما در باند باشد، سفر از هواپیما به ساختمان CIP یا بالعکس توسط ماشین های مخصوص انجام می شود.</span></li>\r\n<li><span style=\"font-size: 12pt;\">امکان پرداخت مستقیم هزینه خروج از ایران با کارت بانکی.</span></li>\r\n</ul>\r\n</div>\r\n</div>\r\n</section>\r\n</div>\r\n<div class=\"PageContainer\"> </div>', 0, 'verified', NULL, '2022-08-27 09:40:01', '2022-08-27 09:40:01', '2022-11-13 04:55:12'),
(2, 'دفتر بازرگانی دانشگاه', ' لورم ایپسوم یک متن ساختگی با تولید ساختگی نامفهوم از صنعت چاپ و با استفاده\r\n                                            از\r\n                                            طراحان\r\n                                            گرافیک است.', '\r\n2326515', 'eebe@gmail.com', 'یتسرذذ عسغیرسیغرذ', '56115616', 1, NULL, 0, 'verified', NULL, '2022-08-27 09:40:01', '2022-08-27 09:40:01', '2022-08-27 09:40:01'),
(9, 'دفتر جدید', '', '09211722656', 'poyyassdvar@gmail.com', 'cas saas d', '111111', 1, NULL, 5, 'pending', NULL, NULL, '2022-10-09 05:38:31', '2022-10-16 18:03:53');

--
-- Dumping data for table `office_member`
--

INSERT INTO `office_member` (`id`, `office_id`, `member_id`, `role_id`, `created_at`, `updated_at`) VALUES
(4, 2, 2, 1, '2022-08-27 11:16:46', '2022-08-27 11:16:46'),
(10, 9, 2, 3, '2022-10-09 05:38:31', '2022-10-09 05:38:31'),
(22, 1, 1, 1, NULL, NULL),
(38, 1, 2, 2, NULL, NULL),
(39, 1, 2, 3, NULL, NULL),
(40, 1, 1, 3, NULL, NULL);

--
-- Dumping data for table `office_permissions`
--

INSERT INTO `office_permissions` (`id`, `name`, `title`, `created_at`, `updated_at`) VALUES
(1, '*', 'همه دسترسی ها', '2022-09-19 13:12:40', '2022-09-19 13:12:40'),
(2, 'product.*', 'مدیریت محصولات', '2022-09-19 14:05:11', '2022-09-19 14:05:11'),
(3, 'capability.*', 'توانمندی ها', '2022-10-21 10:03:06', '2022-10-21 10:03:06'),
(4, 'member.*', 'کاربران', '2022-10-21 10:03:41', '2022-10-21 10:03:41'),
(5, 'update.*', 'ویرایش اطلاعات دفتر', '2022-10-21 10:05:58', '2022-10-21 10:05:58');

--
-- Dumping data for table `office_permission_role`
--

INSERT INTO `office_permission_role` (`id`, `permission_id`, `role_id`, `office_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2022-09-19 14:06:29', '2022-09-19 14:06:29'),
(3, 2, 1, 2, '2022-09-19 14:07:34', '2022-09-19 14:07:34'),
(4, 2, 2, 2, '2022-10-09 05:38:31', '2022-10-09 05:38:31'),
(21, 3, 3, 1, NULL, NULL),
(22, 4, 3, 1, NULL, NULL),
(28, 5, 2, 1, NULL, NULL);

--
-- Dumping data for table `office_roles`
--

INSERT INTO `office_roles` (`id`, `name`, `title`, `created_at`, `updated_at`) VALUES
(1, 'head', 'رئیس', '2022-08-27 11:16:10', '2022-08-27 11:16:10'),
(2, 'researcher', 'محقق', '2022-08-27 11:16:46', '2022-08-27 11:16:46'),
(3, 'board', 'هیئت مدیره', '2022-09-05 06:44:33', '2022-09-05 06:44:33');

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
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `office_id`, `category_id`, `status`, `status_message`, `status_date`, `link`, `created_at`, `updated_at`) VALUES
(2, 'زیردریایی', 'سشرب یبیبسییس', 1, 2, 'accepted', NULL, '2022-08-28 06:43:04', '', '2022-08-28 06:43:04', '2022-08-28 06:43:04'),
(3, 'زیردریایی', 'سشرب یبیبسییس', 1, 2, 'accepted', NULL, '2022-08-28 06:43:04', '', '2022-08-28 06:43:04', '2022-08-28 06:43:04'),
(4, 'زیردریایی', 'سشرب یبیبسییس', 1, 2, 'accepted', NULL, '2022-08-28 06:43:04', '', '2022-08-28 06:43:04', '2022-08-28 06:43:04'),
(5, 'csacasc', 'csacascs sc scsca', 1, 1, 'pending', NULL, NULL, NULL, '2022-11-07 06:06:06', '2022-11-07 06:06:06'),
(6, 'd wdqw', 'wdqwd', 1, 1, 'pending', NULL, NULL, NULL, '2022-11-12 10:34:17', '2022-11-12 10:34:17');

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `profileable_id`, `profileable_type`, `first_name`, `last_name`, `username`, `gender`, `birthday`, `about`, `linkedin`, `github`, `created_at`, `updated_at`) VALUES
(1, 1, 'App\\Models\\Member', 'اشکان', 'رضایی', 'rezee', 'male', NULL, NULL, 'httpd::/sdadzxczxc', 'https://github.com/pouya1900', '2022-08-27 11:31:54', '2022-10-03 18:33:44'),
(2, 2, 'App\\Models\\Member', 'علی', 'اسدی', '', 'male', NULL, 'لورم ایپسوم متن ساختگی با تولید تصادفی به وسیله طراجان گرافیک است .', 'httpd::/sdada', 'https://github.com/pouya1900s', '2022-08-27 11:31:54', '2022-08-27 11:31:54'),
(5, 1, 'App\\Models\\User', 'پویا', 'راهواره', 'pouya2', 'male', NULL, NULL, NULL, NULL, '2022-09-19 03:23:32', '2022-09-19 03:23:32'),
(6, 5, 'App\\Models\\Member', 'پویاfhg', 'راهوارهghf', 'pouya5', 'male', NULL, NULL, NULL, NULL, '2022-09-19 03:23:32', '2022-09-19 03:23:32'),
(7, 2, 'App\\Models\\User', 'علی', 'دایی', 'daee', 'male', NULL, NULL, NULL, NULL, '2022-09-19 03:23:32', '2022-09-19 03:23:32');

--
-- Dumping data for table `ranks`
--

INSERT INTO `ranks` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'استاد', '2022-08-27 11:16:46', '2022-08-27 11:16:46');

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `title`, `created_at`, `updated_at`) VALUES
(1, 'employer', 'کارفرما', '2022-09-19 07:50:56', '2022-09-19 07:50:56');

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `title`, `email`, `address`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'yfttd', '', '', '', '2022-07-27 04:41:05', '2022-07-27 04:41:05');

--
-- Dumping data for table `supports`
--

INSERT INTO `supports` (`id`, `supportable_type`, `supportable_id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\Office', 1, 'مشکل در افزودن محصول', 'pending', '2022-10-30 15:42:14', '2022-10-30 15:42:14'),
(2, 'App\\Models\\Office', 1, 'csassas', 'pending', '2022-10-31 06:26:33', '2022-10-31 06:26:33');

--
-- Dumping data for table `support_messages`
--

INSERT INTO `support_messages` (`id`, `support_id`, `admin_id`, `sender`, `text`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'user', 'لورم ایپسوم یک متن با تولید تصادفی برای استفاده در صنعت چاپ و طراحی است .\r\nایا امکان استفاده از لورم ایپسوم در همه جا وجود دارد ؟\r\nایا می توان از صنعت بی نشان و محتوایی در برابر فشار های خارجی تولید کرد.', '2022-10-31 05:10:37', '2022-10-31 05:10:37'),
(2, 1, 1, 'admin', 'با سلام\r\n\r\nاین مورد بررسی خواهد شد و نتیجه در ادامه به حضور اعلام می گردد.\r\n\r\nموفق باشید', '2022-10-31 05:10:37', '2022-10-31 05:10:37'),
(3, 1, 1, 'admin', 'با عرض سلام مجدد\r\nاین مورد بررسی و مرتفع شد، لطفا ملاحظه فرمایید.\r\n\r\nبا تشکر فراوان', '2022-10-31 05:10:37', '2022-10-31 05:10:37'),
(4, 1, 1, 'user', 'لورم ایپسوم یک متن با تولید تصادفی برای استفاده در صنعت چاپ و طراحی است .\r\nایا امکان استفاده از لورم ایپسوم در همه جا وجود دارد ؟\r\nایا می توان از صنعت بی نشان و محتوایی در برابر فشار های خارجی تولید کرد.', '2022-10-31 05:10:37', '2022-10-31 05:10:37'),
(5, 1, 1, 'admin', 'با عرض سلام مجدد\r\nاین مورد بررسی و مرتفع شد، لطفا ملاحظه فرمایید.\r\n\r\nبا تشکر فراوان', '2022-10-31 05:10:37', '2022-10-31 05:10:37'),
(6, 1, 1, 'admin', 'با عرض سلام مجدد\r\nاین مورد بررسی و مرتفع شد، لطفا ملاحظه فرمایید.\r\n\r\nبا تشکر فراوان', '2022-10-31 05:10:37', '2022-10-31 05:10:37'),
(7, 1, NULL, 'user', 'dasf sfa', '2022-10-31 03:33:04', '2022-10-31 03:33:04'),
(8, 1, NULL, 'user', 'dasf sfa', '2022-10-31 03:33:34', '2022-10-31 03:33:34'),
(9, 1, NULL, 'user', 'dfsd fdsf sdf', '2022-10-31 03:33:39', '2022-10-31 03:33:39'),
(10, 1, NULL, 'user', 'f fsdfsdfs', '2022-10-31 03:33:54', '2022-10-31 03:33:54'),
(11, 2, NULL, 'user', 'sdasdasdas', '2022-10-31 06:26:33', '2022-10-31 06:26:33'),
(12, 2, NULL, 'user', 'casf asfa', '2022-10-31 06:26:43', '2022-10-31 06:26:43');

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `type`, `email`, `email_verified_at`, `password`, `role_id`, `status`, `status_message`, `status_date`, `confirmation_token`, `reset_token`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'real', 'example_user@yahoo.com', '2022-09-19 04:36:33', '$2y$10$YL69X.pypO2Cr5ki030zYevK/.LucLTe1wMHSMgMMpE23F0cCVC2O', 1, 'verified', NULL, NULL, 'W8MAfUjiyiql', NULL, 'dCwQKAO5VyGEs4haYZuo0WiZnzQdPFcBtv589dHpsi6q0UnFVyTnwsBcGJb1', '2022-09-19 03:23:32', '2022-09-19 04:36:33'),
(2, 'real', 'fff@yahoo.com', '2022-09-19 04:36:33', '$2y$10$YL69X.pypO2Cr5ki030zYevK/.LucLTe1wMHSMgMMpE23F0cCVC2O', 1, 'verified', NULL, NULL, 'W8MAfUjiyiql', NULL, 'hs8EcHgFKGzXsLH8PGAedA6GCDXjg5Wts2XdopSCcenSXadGjRn1AlKGVXAR', '2022-09-27 04:23:32', '2022-09-19 04:36:33');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
