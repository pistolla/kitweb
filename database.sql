CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `admins` (`id`, `name`, `email`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@kenyansintexas.co.ke', 'admin', '$2y$10$o6jIMYuJnGngVx46FbSCQeuadlw2m1nq2X.2L3Ac.HD9ri8TSktZy', 'nY6i4L7mxNYtdz8aEnEOZJqzv2N0hr7vgjJuDXchRl0jJ49dKK2RxTNl4TmK', '2021-05-18 18:00:00', '2021-05-24 01:23:18');
CREATE TABLE `adtypes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `slag` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `adtypes` (`id`, `name`, `type`, `width`, `height`, `slag`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Banner Ad', 'Image', 970, 250, '970x250', 1, '2020-07-07 00:51:55', '2020-10-14 20:42:10'),
(2, 'Sidebar Add', 'Image', 728, 90, '728x90', 1, '2020-07-07 01:17:02', '2020-10-14 20:42:01'),
(3, 'Footer Ad', 'Image', 300, 250, '300x250', 1, '2020-07-07 01:24:24', '2020-10-14 20:42:27'),
(4, 'Inner Ad', 'Image', 300, 600, '300x600', 1, '2020-10-14 09:30:55', '2020-10-14 20:43:30');
CREATE TABLE `advertises` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `adtype_id` int(11) NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hashid` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `click` tinyint(2) NOT NULL DEFAULT '0',
  `total` int(11) DEFAULT '0',
  `count_click` int(11) NOT NULL DEFAULT '0',
  `count_imp` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `category_id` int(11) NOT NULL DEFAULT '1',
  `category` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `analytics` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `publisher_id` int(11) NOT NULL,
  `type` tinyint(2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `blogs` (
  `id` int(10) UNSIGNED NOT NULL,
  `admin_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `heading` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(200) NOT NULL,
  `tags` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `blogs` (`id`, `admin_id`, `category_id`, `photo`, `slug`, `heading`, `details`, `created_at`, `updated_at`) VALUES
(2, 1, 1, '5bc36d746a8eb.jpg', 'digital_marketing_agency_all_the_foundational', 'Digital Marketing Agency all the foundational.', '<div>Sportsman do offending supported extremity breakfast by listening.<span style=\"font-size: 0.875rem;\">Decisively advantages nor expression unpleasing she led met.&nbsp;</span><span style=\"font-size: 0.875rem;\">Estate was tended ten boy nearer seemed. As so seeing latter he should thirty whence. Steepest speaking up attended it as. Made neat an on</span><span style=\"font-size: 0.875rem;\">Sportsman do offending supported extremity breakfast by listening.</span><span style=\"font-size: 0.875rem;\">Decisively advantages nor expression unpleasing she led met.&nbsp;</span><span style=\"font-size: 0.875rem;\">Estate was tended ten boy nearer seemed. As so seeing latter he should thirty whence. Steepest speaking up attended it as. Made neat an on</span><span style=\"font-size: 0.875rem;\">Sportsman do offending supported extremity breakfast by listening.</span><span style=\"font-size: 0.875rem;\">Decisively advantages nor expression unpleasing she led met.&nbsp;</span><span style=\"font-size: 0.875rem;\">Estate was tended ten boy nearer seemed. As so seeing latter he should thirty whence. Steepest speaking up attended it as. Made neat an on</span></div>', '2020-10-07 02:43:59', '2020-10-14 20:23:16'),
(3, 1, 1, '5bc36d79e24d1.jpg', 'sportsman_do_offending_supported_extremity','Sportsman do offending supported extremity', 'Sportsman do offending supported extremity breakfast by listening.Decisively advantages nor expression unpleasing she led met.Sportsman do offending supported extremity breakfast by listening.Decisively advantages nor expression unpleasing she led met.Sportsman do offending supported extremity breakfast by listening.Decisively advantages nor expression unpleasing she led met.Sportsman do offending supported extremity breakfast by listening.Decisively advantages nor expression unpleasing she led met.Sportsman do offending supported extremity breakfast by listening.Decisively advantages nor expression unpleasing she led met.Sportsman do offending supported extremity breakfast by listening.Decisively advantages nor expression unpleasing she led met.Sportsman do offending supported extremity breakfast by&nbsp;<br>', '2020-10-07 02:48:41', '2020-10-14 20:23:21'),
(4, 1, 1, '5bc36d7ee6162.jpg', 'decisively_advantages_nor_expression_unpleasing_she_led_met','Decisively advantages nor expression unpleasing she led met.', 'Sportsman do offending supported extremity breakfast by listening.Decisively advantages nor expression unpleasing she led met.Sportsman do offending supported extremity breakfast by listening.Decisively advantages nor expression unpleasing she led met.Sportsman do offending supported extremity breakfast by listening.Decisively advantages nor expression unpleasing she led met.Sportsman do offending supported extremity breakfast by listening.Decisively advantages nor expression unpleasing she led met.Sportsman do offending supported extremity breakfast by listening.Decisively advantages nor expression unpleasing she led met.Sportsman do offending supported extremity breakfast by listening.Decisively advantages nor expression unpleasing she led met.Sportsman do offending supported extremity breakfast by listening.Decisively advantages nor expression unpleasing she led met.Sportsman do offending supported extremity breakfast by listening.Decisively advantages nor expression unpleasing she led met.Sportsman do offending supported extremity breakfast by listening.Decisively advantages nor expression unpleasing she led met.<br>', '2020-10-07 02:49:13', '2020-10-14 20:23:26'),
(7, 1, 1, '5bc36d946c3c3.jpg', 'the_foundational_tool_you_need_inbound_success','The foundational tool you need inbound success.', 'We are a full service Digital Marketing Agency all&nbsp; &nbsp; the foundational tool you need inbound success. With this module theres no need to another dayWe are a full service Digital Marketing Agency all&nbsp; &nbsp; the foundational tool you need inbound success. With this module theres no need to another dayWe are a full service Digital Marketing Agency all&nbsp; &nbsp; the foundational tool you need inbound success. With this module theres no need to another dayWe are a full service Digital Marketing Agency all&nbsp; &nbsp; the foundational tool you need inbound success. With this module theres no need to another dayWe are a full service Digital Marketing Agency all&nbsp; &nbsp; the foundational tool you need inbound success. With this module theres no need to another day We are a full service Digital Marketing Agency all&nbsp; &nbsp; the foundational tool you need inbound success. With this module theres no need to another dayWe are a full service Digital Marketing Agency all&nbsp; &nbsp; the foundational tool you need inbound success. With this module theres no need to another dayWe are a full service Digital Marketing Agency all&nbsp; &nbsp; the foundational tool you need inbound success. With this module theres no need to another dayWe are a full service Digital Marketing Agency all&nbsp; &nbsp; the foundational tool you need inbound success. With this module theres no need to another dayWe are a full service Digital Marketing Agency all&nbsp; &nbsp; the foundational tool you need inbound success. With this module theres no need to another dayWe are a full service Digital Marketing Agency all&nbsp; &nbsp; the foundational tool you need inbound success. With this module theres no need to another dayWe are a full service Digital Marketing Agency all&nbsp; &nbsp; the foundational tool you need inbound success. With this module theres no need to another dayWe are a full service Digital Marketing Agency all&nbsp; &nbsp; the foundational tool you need inbound success. With this module theres no need to another dayWe are a full service Digital Marketing Agency all&nbsp; &nbsp; the foundational tool you need inbound success. With this module theres no need to another dayWe are a full service Digital Marketing Agency all&nbsp; &nbsp; the foundational tool you need inbound success. With this module theres no need to another day<br>', '2020-10-07 03:24:48', '2020-10-14 20:23:48'),
(8, 1, 1, '5bc36d59411ed.jpg', 'agency_allhe_foundational_tool_you_need_inbound_success','Agency allhe foundational tool you need inbound success', '<div>We are a full service Digital Marketing Agency all<span style=\"font-size: 0.875rem;\">he foundational tool you need inbound success.&nbsp;</span><span style=\"font-size: 0.875rem;\">With this module theres no need to another day&nbsp;</span><span style=\"font-size: 0.875rem;\">We are a full service Digital Marketing Agency all</span><span style=\"font-size: 0.875rem;\">he foundational tool you need inbound success.&nbsp;</span><span style=\"font-size: 0.875rem;\">With this module theres no need to another day</span><span style=\"font-size: 0.875rem;\">We are a full service Digital Marketing Agency all</span><span style=\"font-size: 0.875rem;\">he foundational tool you need inbound success.&nbsp;</span><span style=\"font-size: 0.875rem;\">With this module theres no need to another day</span><span style=\"font-size: 0.875rem;\">We are a full service Digital Marketing Agency all</span><span style=\"font-size: 0.875rem;\">he foundational tool you need inbound success.&nbsp;</span><span style=\"font-size: 0.875rem;\">With this module theres no need to another day</span><span style=\"font-size: 0.875rem;\">We are a full service Digital Marketing Agency all</span><span style=\"font-size: 0.875rem;\">he foundational tool you need inbound success.&nbsp;</span><span style=\"font-size: 0.875rem;\">With this module theres no need to another day</span></div>', '2020-10-07 03:26:26', '2020-10-14 20:22:49');
CREATE TABLE `deposits` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `gateway_id` int(11) DEFAULT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charge` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usd_amo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btc_amo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btc_wallet` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `try` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES 
(1, 'Technology', '2020-10-06 03:31:37', '2020-10-06 03:31:37'),
(2, 'Scholarship/Grants', '2020-10-06 03:31:37', '2020-10-06 03:31:37'),
(3, 'Fashion', '2020-10-06 03:31:37', '2020-10-06 03:31:37'),
(4, 'Career', '2020-10-06 03:31:37', '2020-10-06 03:31:37'),
(5, 'Politics', '2020-10-06 03:31:37', '2020-10-06 03:31:37'),
(6, 'Music Lifestyle', '2020-10-06 03:31:37', '2020-10-06 03:31:37');
CREATE TABLE `faqs` (
  `id` int(10) UNSIGNED NOT NULL,
  `heading` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `faqs` (`id`, `heading`, `details`, `created_at`, `updated_at`) VALUES
(1, 'I have questions about the updated trems ?', 'We are full service Digital Marketing Agency all the tools you need for inbound success. With this module theres no need to go another day.', '2020-10-06 03:31:37', '2020-10-06 03:31:37'),
(2, 'Lorem ipsum dolor', 'We are full service Digital Marketing Agency all the tools you need for inbound success. With this module theres no need to go another day.', '2020-10-06 03:32:11', '2020-10-06 03:32:11'),
(3, 'There are many variations of passages of Lorem Ipsum', 'We are full service Digital Marketing Agency all the tools you need for inbound success. With this module theres no need to go another day.', '2020-10-06 03:32:17', '2020-10-06 03:32:17'),
(4, 'Lorem ipsum dolor Lorem ipsum dolor', 'We are full service Digital Marketing Agency all the tools you need for inbound success. With this module theres no need to go another day.', '2020-10-06 03:32:27', '2020-10-06 03:32:27'),
(5, 'There are many variations oLorem Ipsum', 'We are full service Digital Marketing Agency all the tools you need for inbound success. With this module theres no need to go another day.', '2020-10-06 03:32:31', '2020-10-15 15:55:09'),
(6, 'There are many variations of passages of Lorem Ipsum', 'We are full service Digital Marketing Agency all the tools you need for inbound success. With this module theres no need to go another day.', '2020-10-06 03:32:37', '2020-10-06 03:32:37');
CREATE TABLE `frontends` (
  `id` int(10) UNSIGNED NOT NULL,
  `banner_heading` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_details` text COLLATE utf8mb4_unicode_ci,
  `about_heading` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `about_details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `about_company` text COLLATE utf8mb4_unicode_ci,
  `about_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_heading` text COLLATE utf8mb4_unicode_ci,
  `testimonial_heading` text COLLATE utf8mb4_unicode_ci,
  `feature_heading` text COLLATE utf8mb4_unicode_ci,
  `stat_heading` text COLLATE utf8mb4_unicode_ci,
  `faq_heading` text COLLATE utf8mb4_unicode_ci,
  `service_details` text COLLATE utf8mb4_unicode_ci,
  `testim_details` text COLLATE utf8mb4_unicode_ci,
  `faq_details` text COLLATE utf8mb4_unicode_ci,
  `stat_details` text COLLATE utf8mb4_unicode_ci,
  `feature_details` text COLLATE utf8mb4_unicode_ci,
  `stat1` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stat2` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stat3` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stat4` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stat5` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stat6` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stat7` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stat8` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stat9` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_address` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `frontends` (`id`, `banner_heading`, `banner_details`, `about_heading`, `about_details`,`about_company`, `about_image`, `service_heading`, `testimonial_heading`, `stat_heading`, `faq_heading`, `service_details`, `testim_details`, `faq_details`, `stat_details`, `stat1`, `stat2`, `stat3`, `stat4`, `stat5`, `stat6`, `video`, `stat7`, `stat8`, `stat9`, `footer`, `contact_email`, `contact_number`, `contact_address`, `created_at`, `updated_at`,`feature_heading`,`feature_details`) VALUES
(1, 'Kenyans In Texas', '&nbsp;We are a full service Digital Marketing Agency all the foundational tools you need for inbound success. With this module theres no need to go another day.<br>', 'What is KenyansInTexas?', 'Lorem ipsum dolor sit amet, consectetur adipiscing cididunt ut labore et dolore magna aliqua. Ut enim ad ci.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labor, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exerci.', 'The Internet has its origins in cold war and technological rivalry between USSR and US. In fact while the World Wide Web was created in 1991, its origin dates back to 1957 when the Soviet Union launched the Sputnik I satellite (Dickey and Lewis, 2011: 2).<br> US reacted with establishment a department of Defense Advanced Research Project Agency (DARPA) which launched in 1960s ARPANET, an experimental project of computer networks from which what we now know as internet developed. Since then internet contributed to science incredibly and by the late 1980s the internet was being used by many government and business institutions.<br> We are located along the edges of the universe but we know we are not alone', '5bc36bbe25601.jpg', 'Our Special Services', 'Some Awesome Words by Our Customers', 'Our Achivment & Success', 'Frequently Asked Questions', 'We are a full service Digital Marketing Agency all the foundational tools you need for inbound success. With this module theres no need to go another day.', 'We are a full service Digital Marketing Agency all the foundational tools you need for inbound success. With this module theres no need to go another day.', 'We are full service Digital Marketing Agency all the tools you need for inbound success. With this module theres no need to go another day.', 'We are a full service Digital Marketing Agency all the foundational tools you need for inbound success. With this module theres no need to go another day.', '10', 'K', 'Global Customer', '5', 'Y', 'Years Experience', 'https://www.youtube.com/watch?v=6NgaP8Y6y8s', '10', 'M', 'Daily Ad Serve', '&nbsp;We are a full service Digital Marketing Agency all the foundational tool you nee. this module theres no need to another day.', 'do-not-reply@kenyansintexas.co.ke', '(254) 771 797 603', 'Nairobi, Kenya<br>', '2020-05-27 01:47:18', '2020-10-15 15:59:43', 'Features', 'Our service and innovations');
CREATE TABLE `gateways` (
  `id` int(10) UNSIGNED NOT NULL,
  `main_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `minamo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maxamo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fixed_charge` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `percent_charge` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `val1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `val2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `gateways` (`id`, `main_name`, `name`, `minamo`, `maxamo`, `fixed_charge`, `percent_charge`, `rate`, `val1`, `val2`, `status`, `created_at`, `updated_at`) VALUES
(101, 'MPESA', 'MPesa Paybill', '5', '1000', '0.511', '2.52', '80', '999666', NULL, 1, NULL, '2020-07-05 04:23:19'),
(102, 'PayPal', 'PayPall', '5', '1000', '0.511', '2.52', '80', 'bitjosef@hotmail.com', NULL, 1, NULL, '2020-07-05 04:23:19'),
(103, 'PerfectMoney', 'Perfect Money', '20', '20000', '2', '1', '80', 'U5376900', 'G079qn4Q7XATZBqyoCkBteGRg', 1, NULL, '2020-05-20 11:58:59'),
(104, 'Stripe', 'Credit Card', '10', '50000', '3', '3', '80', 'sk_test_aat3tzBCCXXBkS4sxY3M8A1B', 'pk_test_AU3G7doZ1sbdpJLj0NaozPBu', 1, NULL, '2020-05-27 18:11:50'),
(105, 'Skrill', 'Skrill', '10', '50000', '3', '3', '80', 'support@globeskill.com', 'jabali2006', 1, NULL, '2020-05-20 12:01:09'),
(501, 'Blockchain.info', 'BitCoin', '1', '20000', '1', '0.5', '80', '3965f52f-ec19-43af-90ed-d613dc60657eSSS', 'xpub6DREmHywjNizvs9b4hhNekcjFjvL4rshJjnrHHgtLNCSbhhx5jKFRgqdmXAecLAddEPudDZY4xoDbV1NVHSCeDp1S7NumPCNNjbxB7sGasY0000', 1, NULL, '2020-05-21 01:20:29'),
(502, 'block.io - BTC', 'BitCoin', '1', '99999', '1', '0.5', '80', '0be4-5d50-aa54-8a7a', '09876softk', 1, '2020-01-27 18:00:00', '2020-10-06 23:55:52'),
(503, 'block.io - LTC', 'LiteCoin', '100', '10000', '0.4', '1', '80', '42fe-23c3-fb4a-f5b1', '09876softk', 1, NULL, '2020-10-06 23:55:36'),
(504, 'block.io - DOGE', 'DogeCoin', '1', '50000', '0.51', '2.52', '80', 'c1a4-269d-44e7-08d8', '09876softk', 1, NULL, '2020-10-06 23:56:06'),
(505, 'CoinPayment - BTC', 'BitCoin', '1', '50000', '0.51', '2.52', '80', '596f0097ed9d1ab8cfed05eb59c70e9f066513dfe4df64a8fc3917d309328315', '7472928395208f70E3cE30B9e10dc882cBDD3e9967b7942AaE492106d9C7bE44', 1, NULL, '2020-05-31 09:38:33'),
(506, 'CoinPayment - ETH', 'Etherium', '1', '50000', '0.51', '2.52', '80', '596f0097ed9d1ab8cfed05eb59c70e9f066513dfe4df64a8fc3917d309328315', '7472928395208f70E3cE30B9e10dc882cBDD3e9967b7942AaE492106d9C7bE44', 1, NULL, '2020-05-31 09:39:04'),
(507, 'CoinPayment - BCH', 'Bitcoin Cash', '1', '50000', '0.51', '2.52', '80', '596f0097ed9d1ab8cfed05eb59c70e9f066513dfe4df64a8fc3917d309328315', '7472928395208f70E3cE30B9e10dc882cBDD3e9967b7942AaE492106d9C7bE44', 1, NULL, '2020-05-31 09:39:04'),
(508, 'CoinPayment - DASH', 'DASH', '1', '50000', '0.51', '2.52', '80', '596f0097ed9d1ab8cfed05eb59c70e9f066513dfe4df64a8fc3917d309328315', '7472928395208f70E3cE30B9e10dc882cBDD3e9967b7942AaE492106d9C7bE44', 1, NULL, '2020-05-31 09:39:04'),
(509, 'CoinPayment - DOGE', 'DOGE', '1', '50000', '0.51', '2.52', '80', '596f0097ed9d1ab8cfed05eb59c70e9f066513dfe4df64a8fc3917d309328315', '7472928395208f70E3cE30B9e10dc882cBDD3e9967b7942AaE492106d9C7bE44', 1, NULL, '2020-05-31 09:39:04'),
(510, 'CoinPayment - LTC', 'LTC', '1', '50000', '0.51', '2.52', '80', '596f0097ed9d1ab8cfed05eb59c70e9f066513dfe4df64a8fc3917d309328315', '7472928395208f70E3cE30B9e10dc882cBDD3e9967b7942AaE492106d9C7bE44', 1, NULL, '2020-05-31 09:39:04'),
(512, 'CoinGate', 'CoinGate', '10', '1000', '05', '5', '80', 'Ba1VgPx6d437xLXGKCBkmwVCEw5kHzRJ6thbGo-N', NULL, 1, '2020-07-08 18:00:00', '2020-05-21 01:20:54'),
(513, 'CoinPayment-ALL', 'Coin Payment', '10', '1000', '05', '5', '80', 'db1d9f12444e65c921604e289a281c56', NULL, 1, NULL, '2020-05-21 01:20:54');
CREATE TABLE `generals` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Website',
  `subtitle` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Sub Title',
  `color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '336699',
  `cur` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'USD',
  `cursym` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '$',
  `reg` int(11) NOT NULL DEFAULT '1',
  `emailver` int(11) NOT NULL DEFAULT '1',
  `smsver` int(11) NOT NULL DEFAULT '1',
  `decimal` int(11) NOT NULL DEFAULT '2',
  `emailnotf` int(11) NOT NULL DEFAULT '1',
  `smsnotf` int(11) NOT NULL DEFAULT '1',
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `template` text COLLATE utf8mb4_unicode_ci,
  `smsapi` text COLLATE utf8mb4_unicode_ci,
  `view` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `click` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `generals` (`id`, `title`, `subtitle`, `color`, `cur`, `cursym`, `reg`, `emailver`, `smsver`, `decimal`, `emailnotf`, `smsnotf`, `email`, `template`, `smsapi`, `view`, `click`, `created_at`, `updated_at`) VALUES
(1, 'KenyansInTexas', 'Advertisement Network', '2ecc71', 'USD', '$', 1, 1, 1, 2, 0, 0, 'do-not-reply@kenyansintexas.co.ke', '<br><br>\r\n	<div class=\"contents\" style=\"max-width: 600px; margin: 0 auto; border: 2px solid #000036;\">\r\n\r\n<div class=\"header\" style=\"background-color: #000036; padding: 15px; text-align: center;\">\r\n	<div class=\"logo\" style=\"width: 260px;text-align: center; margin: 0 auto;\">\r\n		<img src=\"https://i.imgur.com/4NN55uD.png\" alt=\"THESOFTKING\" style=\"width: 100%;\">\r\n	</div>\r\n</div>\r\n\r\n<div class=\"mailtext\" style=\"padding: 30px 15px; background-color: #f6f6f6; font-family: \'Open Sans\', sans-serif; font-size: 16px; line-height: 26px;\">\r\n\r\nDear {{name}}, <br>{{message}}</div>\r\n\r\n<div class=\"footer\" style=\"background-color: #000036; padding: 15px; text-align: center;\">\r\n\r\n<font color=\"#66FF00\">CopyRight KenyansInTexas</font><br>\r\n</div>\r\n\r\n	</div>\r\n<br><br>', 'https://api.infobip.com/api/v3/sendsms/plain?user=****&password=*****&sender=KenyansInTexas&SMSText={{message}}&GSM={{number}}&type=longSMS', '0.0001', '0.001', NULL, '2020-10-15 14:59:07');
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `plans` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `credit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(2) NOT NULL DEFAULT '1',
  `status` int(2) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `publishers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tauth` int(11) NOT NULL DEFAULT '1',
  `tfver` int(11) NOT NULL DEFAULT '1',
  `emailv` int(11) NOT NULL,
  `smsv` int(11) NOT NULL,
  `refer` int(11) NOT NULL DEFAULT '0',
  `balance` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `vsent` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vercode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secretcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `members` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tauth` int(11) NOT NULL DEFAULT '1',
  `tfver` int(11) NOT NULL DEFAULT '1',
  `emailv` int(11) NOT NULL,
  `smsv` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `vsent` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vercode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secretcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `linked_social_accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `member_id` int(11) NOT NULL,
  `provider_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `sliders` (
  `id` int(10) UNSIGNED NOT NULL,
  `heading` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `sliders` (`id`, `heading`, `details`, `icon`, `created_at`, `updated_at`) VALUES
(9, 'First Service', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exerci.', 'sample_service.png', '2020-07-05 06:50:40', '2020-10-14 20:14:20'),
(10, 'Second Service', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exerci.', 'sample_service.png', '2020-07-05 06:51:12', '2020-10-14 20:14:32'),
(11, 'Banner Service', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exerci.', 'sample_service.png', '2020-10-06 02:17:47', '2020-10-14 20:14:36'),
(12, 'Lorem ipsum dolor', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exerci.', 'sample_service.png', '2020-10-06 02:27:10', '2020-10-14 20:14:40');
CREATE TABLE `socials` (
  `id` int(10) UNSIGNED NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `socials` (`id`, `icon`, `link`, `created_at`, `updated_at`) VALUES
(2, 'linkedin', 'https://www.facebook.com/pgu', '2020-05-27 05:41:27', '2020-05-27 05:45:35'),
(3, 'twitter', 'https://www.facebook.com/pguk', '2020-05-27 05:41:57', '2020-05-27 05:41:57'),
(8, 'facebook', 'https://www.facebook.com/page', '2020-10-06 03:34:15', '2020-10-06 03:34:20');
CREATE TABLE `subscribes` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `likes` (
  `id` int(10) UNSIGNED NOT NULL,
  `member_id` int(10) DEFAULT NULL,
  `activity_id` int(10) DEFAULT NULL,
  `comment_id` int(10) DEFAULT NULL,
  `blog_id` int(10) UNSIGNED NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `member_id` int(10) DEFAULT NULL,
  `parent_id` int(10) DEFAULT NULL,
  `activity_id` int(10) DEFAULT NULL,
  `blog_id` int(10) DEFAULT NULL,
  `text` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `activities` (
  `id` int(10) UNSIGNED NOT NULL,
  `member_id` int(10) DEFAULT NULL,
  `heading` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(200) NOT NULL,
  `image_url` varchar(300) COLLATE utf8mb4_unicode_ci NULL,
  `link_url` varchar(500) COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `testimonials` (
  `id` int(10) UNSIGNED NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `heading` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `testimonials` (`id`, `photo`, `name`, `heading`, `details`, `created_at`, `updated_at`) VALUES
(1, '5bc36c92df8db.jpg', 'John Doe', 'CTO, Dr', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exerci.Lorem ipsum dolor sit amet.', '2020-10-06 02:57:19', '2020-10-14 20:19:30'),
(2, '5bb8790adb410.jpg', 'Jane Doe', 'Team Lead, C20W', 'We are a full service Digital Marketing Agency am dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exerci.', '2020-10-06 02:57:46', '2020-10-14 20:18:27'),
(3, '5bb879428e999.jpg', 'Jean Doe', 'Marketer', 'We are a full service Digital Marketing Agency all the foundational tools you need for inbound success. With this module theres no need to go another day.', '2020-10-06 02:58:42', '2020-10-14 20:19:01');
CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trxid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `features` (
  `id` int(10) UNSIGNED NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `heading` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `features` (`id`, `photo`, `name`, `heading`, `details`, `created_at`, `updated_at`) VALUES
(1, 'placeholder_1.png', 'Advertiser', 'CTO, Dr', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exerci.Lorem ipsum dolor sit amet.', '2020-10-06 02:57:19', '2020-10-14 20:19:30'),
(2, 'placeholder_2.png', 'Advertiser', 'Visibility', 'We are a full service Digital Marketing Agency am dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exerci.', '2020-10-06 02:57:46', '2020-10-14 20:18:27'),
(3, 'placeholder_3.png', 'Advertiser', 'Marketer', 'We are a full service Digital Marketing Agency all the foundational tools you need for inbound success. With this module theres no need to go another day.', '2020-10-06 02:58:42', '2020-10-14 20:19:01'),
(4, 'placeholder_4.png', 'Advertiser', 'Marketer', 'We are a full service Digital Marketing Agency all the foundational tools you need for inbound success. With this module theres no need to go another day.', '2020-10-06 02:58:42', '2020-10-14 20:19:01'),
(5, 'placeholder_5.png', 'Publisher', 'Marketer', 'We are a full service Digital Marketing Agency all the foundational tools you need for inbound success. With this module theres no need to go another day.', '2020-10-06 02:58:42', '2020-10-14 20:19:01'),
(6, 'placeholder_6.png', 'Publisher', 'Marketer', 'We are a full service Digital Marketing Agency all the foundational tools you need for inbound success. With this module theres no need to go another day.', '2020-10-06 02:58:42', '2020-10-14 20:19:01'),
(7, 'placeholder_7.png', 'Publisher', 'Marketer', 'We are a full service Digital Marketing Agency all the foundational tools you need for inbound success. With this module theres no need to go another day.', '2020-10-06 02:58:42', '2020-10-14 20:19:01'),
(8, 'placeholder_8.png', 'Publisher', 'Marketer', 'We are a full service Digital Marketing Agency all the foundational tools you need for inbound success. With this module theres no need to go another day.', '2020-10-06 02:58:42', '2020-10-14 20:19:01');
CREATE TABLE `documents` (
  `id` int(10) UNSIGNED NOT NULL,
  `cookiepolicy` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `privacypolicy` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `refundpolicy` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `termofservice` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sitexml` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `robottxt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tauth` int(11) NOT NULL DEFAULT '0',
  `tfver` int(11) NOT NULL DEFAULT '1',
  `emailv` int(11) NOT NULL,
  `smsv` int(11) NOT NULL,
  `refer` int(11) NOT NULL DEFAULT '0',
  `balance` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `credit` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `click` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `vsent` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vercode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secretcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `withdraws` (
  `id` int(10) UNSIGNED NOT NULL,
  `publisher_id` int(11) NOT NULL,
  `wmethod_id` int(11) NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `wmethods` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `minamo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `maxamo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `fixed_charge` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `percent_charge` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `rate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `val1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `wmethods` (`id`, `name`, `minamo`, `maxamo`, `fixed_charge`, `percent_charge`, `rate`, `val1`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bank of America', '50', '1000', '2', '1.5', '88', 'rexrifat6sds36@gmail.com', 1, '2020-07-07 06:30:23', '2020-08-04 15:04:01'),
(2, 'National Bank', '500', '10000', '2', '2.52', '77', 'jfkldsfjkldsjfklsjd fdsalkjfklsdajfljsakldjfl', 1, '2020-07-07 06:34:18', '2020-07-07 06:34:24');
CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phonecode` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `states` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `mpesa_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Password` varchar(200) DEFAULT NULL,
  `TransactionType` varchar(40) NOT NULL,
  `TransID` varchar(40) DEFAULT NULL,
  `TransTime` varchar(100) DEFAULT NULL,
  `TransAmount` double DEFAULT NULL,
  `BusinessShortCode` varchar(15) DEFAULT NULL,
  `BillRefNumber` varchar(40) DEFAULT NULL,
  `InvoiceNumber` varchar(40) DEFAULT NULL,
  `ThirdPartyTransID` varchar(40) DEFAULT NULL,
  `MSISDN` varchar(20) DEFAULT NULL,
  `FirstName` varchar(60) DEFAULT NULL,
  `MiddleName` varchar(60) DEFAULT NULL,
  `LastName` varchar(60) DEFAULT NULL,
  `OrgAccountBalance` double DEFAULT NULL,
  `Timestamp` varchar(100) DEFAULT NULL,
  `Amount` varchar(500) DEFAULT NULL,
  `PartyA` varchar(50) DEFAULT NULL,
  `PartyB` varchar(50) DEFAULT NULL,
  `PhoneNumber` varchar(50) DEFAULT NULL,
  `CallBackURL` varchar(50) DEFAULT NULL,
  `AccountReference` varchar(50) DEFAULT NULL,
  `TransactionDesc` varchar(50) DEFAULT NULL,
  `TransactionDate` varchar(20) DEFAULT NULL,
  `MpesaReceiptNumber` varchar(20) DEFAULT NULL,
  `ResultCode` varchar(20) DEFAULT NULL,
  `ResultDesc` varchar(50) DEFAULT NULL,
  `ResponseCode` varchar(20) DEFAULT NULL,
  `ResponseDescription` varchar(50) DEFAULT NULL,
  `MerchantRequestID` varchar(50) DEFAULT NULL,
  `CheckoutRequestID` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
  PRIMARY KEY (`id`)
);
CREATE TABLE `api_configs` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `url` varchar(50) NOT NULL,
  `account_no` varchar(50) NOT NULL,
  `business_number` varchar(20) DEFAULT NULL,
  `public_key` varchar(100) DEFAULT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `access_token` varchar(200) DEFAULT NULL,
  `refresh_time` datetime DEFAULT NULL,
  `pass_key` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
  PRIMARY KEY (`id`)
);

ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD UNIQUE KEY `admins_username_unique` (`username`);
ALTER TABLE `adtypes`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `advertises`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `analytics`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `frontends`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `gateways`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `generals`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_resets_email_index` (`email`);
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `publishers_email_unique` (`email`),
  ADD UNIQUE KEY `publishers_username_unique` (`username`);
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `socials`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `members_email_unique` (`email`),
  ADD UNIQUE KEY `members_username_unique` (`username`);
ALTER TABLE `linked_social_accounts`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `subscribes`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);
ALTER TABLE `withdraws`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `wmethods`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE `adtypes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE `advertises`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `analytics`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `blogs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE `deposits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `faqs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE `frontends`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE `gateways`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE `generals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `plans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `publishers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `members`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `linked_social_accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `likes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `activities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `sliders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE `socials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE `subscribes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `testimonials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `withdraws`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `wmethods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;