-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2016-09-13 15:02:02
-- 服务器版本： 10.0.27-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `warranty_ticwear`
--

-- --------------------------------------------------------

--
-- 表的结构 `tbl_check`
--

DROP TABLE IF EXISTS `tbl_check`;
CREATE TABLE IF NOT EXISTS `tbl_check` (
  `id` int(11) NOT NULL COMMENT '序号',
  `fpid` int(11) NOT NULL COMMENT '一级问题类别',
  `spid` int(11) NOT NULL COMMENT '二级问题类别',
  `des` text NOT NULL COMMENT '检查步骤',
  `position` int(11) NOT NULL COMMENT '显示顺序'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- 插入之前先把表清空（truncate） `tbl_check`
--

TRUNCATE TABLE `tbl_check`;
--
-- 转存表中的数据 `tbl_check`
--

INSERT INTO `tbl_check` (`id`, `fpid`, `spid`, `des`, `position`) VALUES
(1, 1, 6, 'Try charging the watch for 5 minutes, then try to turn it on by long pressing the watch crown for more than 10 seconds. Does it turn on now?', 1),
(2, 1, 7, 'My watch cannot be charged. (The "charging" display doesn''t show; the watch doesn''t get warm after 10 minutes of charging.', 1),
(3, 1, 7, 'Now take your charging cable, plug the USB connector into your computer, and try to charge your phone with it. Does your phone charge?', 2),
(4, 1, 8, 'Try to press the watch crown. Can the watch crown be pressed down?', 1),
(5, 1, 8, 'Try resetting the watch by long pressing the watch crown. Does the watch return to normal? ', 2),
(6, 2, 9, 'Please perform the following operation: 1) Factory reset the watch by long pressing the watch crown and clearing data. 2)Remove and re-install Ticwear companion. 3) Make sure your Bluetooth is turned on on your phone, delete all Ticwatch devices that shows up on your "settings", and try connecting again. Does it connect?', 1),
(7, 2, 9, 'Find another phone around you. Download Ticwear app on that phone. Factory resest your watch and try pairing it with the phone. Does it pair?', 2),
(8, 2, 10, 'Make sure your Ticwear app and your watch are both updated to the latest system (check how to check for system updates here). Reset your watch by long pressing the watch crown and choosing the "Factory Reset" option. Pair the watch with Ticwear app following instructions. Make sure Ticwear is a trusted app on your phone, and is allowed to run in the background. Now does the watch keep disconnected within 20 feet of distance from your phone?', 1);

-- --------------------------------------------------------

--
-- 表的结构 `tbl_country`
--

DROP TABLE IF EXISTS `tbl_country`;
CREATE TABLE IF NOT EXISTS `tbl_country` (
  `id` int(11) NOT NULL COMMENT '序号',
  `country_name` varchar(100) NOT NULL COMMENT '国家名',
  `position` int(11) DEFAULT NULL COMMENT '显示顺序'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- 插入之前先把表清空（truncate） `tbl_country`
--

TRUNCATE TABLE `tbl_country`;
--
-- 转存表中的数据 `tbl_country`
--

INSERT INTO `tbl_country` (`id`, `country_name`, `position`) VALUES
(1, 'US', 1),
(2, 'China', 2);

-- --------------------------------------------------------

--
-- 表的结构 `tbl_form_info`
--

DROP TABLE IF EXISTS `tbl_form_info`;
CREATE TABLE IF NOT EXISTS `tbl_form_info` (
  `id` int(11) NOT NULL COMMENT '序号',
  `consumer_name` varchar(100) NOT NULL COMMENT '用户姓名',
  `consumer_phone` varchar(30) NOT NULL COMMENT '用户电话',
  `watch_id` varchar(100) NOT NULL COMMENT '手表sn码',
  `email` varchar(200) NOT NULL COMMENT '用户邮箱',
  `country` int(11) NOT NULL COMMENT '收货国家',
  `address` varchar(200) NOT NULL COMMENT '收货地址',
  `zip_code` varchar(20) NOT NULL COMMENT '邮编',
  `firstlevel_problem` int(11) DEFAULT NULL COMMENT '问题类别',
  `secondlevel_problem` int(11) DEFAULT NULL COMMENT '问题描述',
  `certificate` text NOT NULL COMMENT '凭证',
  `problem_des` text COMMENT '问题详细描述',
  `video` varchar(255) DEFAULT NULL COMMENT '视频链接',
  `create_time` datetime NOT NULL COMMENT '问题提交日期',
  `status` tinyint(4) DEFAULT NULL COMMENT '审核状态',
  `email_trace` varchar(255) DEFAULT NULL COMMENT '联系历史',
  `update_time` datetime DEFAULT NULL COMMENT '问题审核日期',
  `wwid` varchar(100) NOT NULL COMMENT '问问id',
  `reviewerid` int(11) DEFAULT NULL COMMENT '审核人员',
  `logisid` int(11) DEFAULT NULL COMMENT '物流人员'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- 插入之前先把表清空（truncate） `tbl_form_info`
--

TRUNCATE TABLE `tbl_form_info`;
--
-- 转存表中的数据 `tbl_form_info`
--

INSERT INTO `tbl_form_info` (`id`, `consumer_name`, `consumer_phone`, `watch_id`, `email`, `country`, `address`, `zip_code`, `firstlevel_problem`, `secondlevel_problem`, `certificate`, `problem_des`, `video`, `create_time`, `status`, `email_trace`, `update_time`, `wwid`, `reviewerid`, `logisid`) VALUES
(1, 'wf', '18811717528', '232', '771569533@qq.com', 1, 'center', '', 1, 6, '', 'dfdfdf', 'www.baidu.com', '2016-09-07 19:20:00', 4, NULL, '2016-09-07 19:20:00', '0', 0, 0),
(2, 'z', 'z', 'z', 'z', 1, 'z', '', 1, 6, '', '<p>zzz</p><p><img></p>', 'z', '2016-09-07 06:30:00', 4, NULL, '2016-09-07 20:45:00', '0', 0, 0),
(3, 'w', 'w', 'w', 'w', 1, 'w', '', 1, 6, '', '<p>www</p><p><img></p>', 'w', '2016-09-07 20:50:00', 5, NULL, '2016-09-01 03:30:00', '0', 0, 0),
(4, 'liming', '18792512639', 'sdffdsfdsfdsfsdfsdfdsf', 'yaoyang@mobvi.com', 1, 'fdsfdsfdsfsdf', '0115689', NULL, NULL, '<p>Upload&nbsp;the purchasing proof of your watch:<span class="redactor-invisible-space" data-redactor-tag="span" data-redactor-class="redactor-invisible-space" data-verified="redactor">​Upload the purchasing proof of your watch:<span class="redactor-invisible-space" data-redactor-tag="span" data-redactor-class="redactor-invisible-space" data-verified="redactor">​Upload the purchasing proof of your watch:<span class="redactor-invisible-space" data-redactor-tag="span" data-redactor-class="redactor-invisible-space" data-verified="redactor">​Upload the purchasing proof of your watch:<span class="redactor-invisible-space" data-redactor-tag="span" data-redactor-class="redactor-invisible-space" data-verified="redactor">​Upload the purchasing proof of your watch:</span></span></span></span><span class="redactor-invisible-space">​</span></p>', '<p>please fill in the concrete problem description,not less than 20 words.<span>please fill in the concrete problem description,not less than 20 words.</span></p>', 'https://www.youtube.com/watch?v=RqS_PxMHqV8&list=RDMMRqS_PxMHqV8', '2016-09-12 15:09:46', 4, NULL, NULL, '1', NULL, NULL),
(5, 'l1', '18792512639', 'sdfdsfsdfds', 'q@q.com', 1, 'fsdf', '789456', 1, 6, '<p>​fsd&nbsp;Upload the purchasing proof of your watch:<span class="redactor-invisible-space">​Upload the purchasing proof of your watch:<span class="redactor-invisible-space">​Upload the purchasing proof of your watch:<span class="redactor-invisible-space">​&nbsp;Upload the purchasing proof of your watch:<span class="redactor-invisible-space">​</span></span></span></span></p>', NULL, NULL, '2016-09-12 15:15:35', 5, NULL, NULL, '1', NULL, NULL),
(6, 'l2', '18792512639', 'sdfsdfdsf', 'w@q.com', 1, 'sdfsdf', 'dsfdsf', NULL, NULL, '<p>​dffs&nbsp;Upload the purchasing proof of your watch:<span class="redactor-invisible-space">​Upload the purchasing proof of your watch:<span class="redactor-invisible-space">​Upload the purchasing proof of your watch:<span class="redactor-invisible-space">​Upload the purchasing proof of your watch:<span class="redactor-invisible-space">​</span></span></span></span></p>', '<p>​Write down the url of the video that can best help describe t<span class="redactor-invisible-space">​Write down the url of the video that can best help describe t<span class="redactor-invisible-space">​Write down the url of the video that can best help describe t<span class="redactor-invisible-space">​Write down the url of the video that can best help describe t<span class="redactor-invisible-space">​Write down the url of the video that can best help describe t<span class="redactor-invisible-space">​Write down the url of the video that can best help describe t<span class="redactor-invisible-space">​Write down the url of the video that can best help describe t<span class="redactor-invisible-space">​</span></span></span></span></span></span></span></p>', NULL, '2016-09-12 15:17:15', 5, NULL, NULL, '1', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tbl_fp`
--

DROP TABLE IF EXISTS `tbl_fp`;
CREATE TABLE IF NOT EXISTS `tbl_fp` (
  `id` int(11) NOT NULL COMMENT '序号',
  `des` varchar(200) NOT NULL COMMENT '一级问题描述',
  `position` int(11) NOT NULL DEFAULT '0' COMMENT '问题显示顺序'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- 插入之前先把表清空（truncate） `tbl_fp`
--

TRUNCATE TABLE `tbl_fp`;
--
-- 转存表中的数据 `tbl_fp`
--

INSERT INTO `tbl_fp` (`id`, `des`, `position`) VALUES
(1, 'Power-on', 1),
(2, 'Connection', 2),
(3, 'Display', 3),
(4, 'Heart Rate Monitoring', 4),
(5, 'Vibration', 5),
(6, 'Watch crown', 5),
(7, 'Battery consumption', 7),
(8, 'Calls', 8),
(9, 'Microphone', 9),
(10, 'Others', 10);

-- --------------------------------------------------------

--
-- 表的结构 `tbl_lookup`
--

DROP TABLE IF EXISTS `tbl_lookup`;
CREATE TABLE IF NOT EXISTS `tbl_lookup` (
  `id` int(10) unsigned NOT NULL COMMENT '主键',
  `name` varchar(128) NOT NULL COMMENT '名字',
  `code` int(11) NOT NULL COMMENT '编码',
  `type` varchar(128) NOT NULL COMMENT '类型',
  `position` int(11) NOT NULL COMMENT '显示顺序'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- 插入之前先把表清空（truncate） `tbl_lookup`
--

TRUNCATE TABLE `tbl_lookup`;
--
-- 转存表中的数据 `tbl_lookup`
--

INSERT INTO `tbl_lookup` (`id`, `name`, `code`, `type`, `position`) VALUES
(1, 'Created', 1, 'RMAStatus', 1),
(2, 'Updated', 2, 'RMAStatus', 2),
(3, 'Pending', 3, 'RMAStatus', 3),
(4, 'Approved', 4, 'RMAStatus', 4),
(5, 'Rejected', 5, 'RMAStatus', 5),
(6, 'Shipped', 6, 'RMAStatus', 6);

-- --------------------------------------------------------

--
-- 表的结构 `tbl_migration`
--

DROP TABLE IF EXISTS `tbl_migration`;
CREATE TABLE IF NOT EXISTS `tbl_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 插入之前先把表清空（truncate） `tbl_migration`
--

TRUNCATE TABLE `tbl_migration`;
--
-- 转存表中的数据 `tbl_migration`
--

INSERT INTO `tbl_migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1473156347),
('m140209_132017_init', 1473156369),
('m140403_174025_create_account_table', 1473156371),
('m140504_113157_update_tables', 1473156376),
('m140504_130429_create_token_table', 1473156378),
('m140830_171933_fix_ip_field', 1473156378),
('m140830_172703_change_account_table_name', 1473156379),
('m141222_110026_update_ip_field', 1473156380),
('m141222_135246_alter_username_length', 1473156380),
('m150614_103145_update_social_account_table', 1473156383),
('m150623_212711_fix_username_notnull', 1473156384),
('m151218_234654_add_timezone_to_profile', 1473156385);

-- --------------------------------------------------------

--
-- 表的结构 `tbl_profile`
--

DROP TABLE IF EXISTS `tbl_profile`;
CREATE TABLE IF NOT EXISTS `tbl_profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `public_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci,
  `timezone` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 插入之前先把表清空（truncate） `tbl_profile`
--

TRUNCATE TABLE `tbl_profile`;
--
-- 转存表中的数据 `tbl_profile`
--

INSERT INTO `tbl_profile` (`user_id`, `name`, `public_email`, `gravatar_email`, `gravatar_id`, `location`, `website`, `bio`, `timezone`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tbl_social_account`
--

DROP TABLE IF EXISTS `tbl_social_account`;
CREATE TABLE IF NOT EXISTS `tbl_social_account` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 插入之前先把表清空（truncate） `tbl_social_account`
--

TRUNCATE TABLE `tbl_social_account`;
-- --------------------------------------------------------

--
-- 表的结构 `tbl_sp`
--

DROP TABLE IF EXISTS `tbl_sp`;
CREATE TABLE IF NOT EXISTS `tbl_sp` (
  `id` int(11) NOT NULL COMMENT '序号',
  `des` varchar(255) DEFAULT NULL COMMENT '二级问题描述',
  `position` int(11) DEFAULT '0' COMMENT '问题显示顺序',
  `fpid` int(11) NOT NULL COMMENT '一级问题分类'
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- 插入之前先把表清空（truncate） `tbl_sp`
--

TRUNCATE TABLE `tbl_sp`;
--
-- 转存表中的数据 `tbl_sp`
--

INSERT INTO `tbl_sp` (`id`, `des`, `position`, `fpid`) VALUES
(6, 'My watch charges, but it doesn''t turn on.', 1, 1),
(7, 'My watch cannot be charged. (The "charging" display doesn''t show; the watch doesn''t get warm after 10 minutes of charging.', 2, 1),
(8, 'My watch restarts by itself all the time.', 3, 1),
(9, 'My watch cannot be connected to my phone using BlueTooth.', 1, 2),
(10, 'My watch keeps disconnecting with my phone.', 2, 2),
(11, 'My display can be lit up, but there are abnormalies on my screen.', 1, 3),
(12, 'My display does not lit up, although I can see words/pictures.', 2, 3),
(13, 'When I swipe for next page, the displayed content seem to be stuck half way.', 3, 3),
(14, 'The watch doesn''t react to my touch. ', 4, 3),
(15, 'The readings of my heart rate doesn''t seem to be right.', 1, 4),
(16, 'When receiving notifications, my watch doesn''t vibrate.', 1, 5),
(17, 'My watch crown cannot be pressed down.', 1, 6),
(18, 'My battery consumption doesn''t seem to be normal.', 1, 7),
(19, 'I experience call noise when making/receiving calls from the watch.', 1, 8),
(20, 'I can''t hear anything from the microphone.', 1, 9),
(21, '', NULL, 10),
(22, 'Others', 4, 1);

-- --------------------------------------------------------

--
-- 表的结构 `tbl_token`
--

DROP TABLE IF EXISTS `tbl_token`;
CREATE TABLE IF NOT EXISTS `tbl_token` (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 插入之前先把表清空（truncate） `tbl_token`
--

TRUNCATE TABLE `tbl_token`;
-- --------------------------------------------------------

--
-- 表的结构 `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `unconfirmed_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `registration_ip` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flags` int(11) NOT NULL DEFAULT '0',
  `identity` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '身份'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 插入之前先把表清空（truncate） `tbl_user`
--

TRUNCATE TABLE `tbl_user`;
--
-- 转存表中的数据 `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `email`, `password_hash`, `auth_key`, `confirmed_at`, `unconfirmed_email`, `blocked_at`, `registration_ip`, `created_at`, `updated_at`, `flags`, `identity`) VALUES
(1, 'admin', '1@qq.com', '$2y$10$FbWvhYbJZ5ImhuE8YBW9PeUVEelX09rrcYjMzLHUergSEn3QxCq2O', 'zg0Zhy5Nr-8TALdUlvD2NIq46fl9UJzh', 1473156555, NULL, NULL, '127.0.0.1', 1473156555, 1473156555, 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `tbl_user_data`
--

DROP TABLE IF EXISTS `tbl_user_data`;
CREATE TABLE IF NOT EXISTS `tbl_user_data` (
  `id` int(11) NOT NULL,
  `wwid` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '问问id',
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '手機號碼',
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 插入之前先把表清空（truncate） `tbl_user_data`
--

TRUNCATE TABLE `tbl_user_data`;
--
-- 转存表中的数据 `tbl_user_data`
--

INSERT INTO `tbl_user_data` (`id`, `wwid`, `username`, `email`, `phone`, `auth_key`, `password_hash`, `password_reset_token`, `status`, `created_at`, `updated_at`) VALUES
(16, '', '898150165@qq.com', '898150165@qq.com', NULL, '', '123456', 'i4dshVnCY1nZjTw1xBnmdlSbmX0Z_q9Q_1473423252', -1, 1473423252, 1473423252),
(17, '', 'yaoyang@mobvoi.com', 'yaoyang@mobvoi.com', NULL, '', '123456', 'Q33vEoUUkTsPTJ1QmlY2E8FI2JJT9tQz_1473423294', -1, 1473423294, 1473423294);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_check`
--
ALTER TABLE `tbl_check`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_fid` (`fpid`),
  ADD KEY `fk_sid` (`spid`);

--
-- Indexes for table `tbl_country`
--
ALTER TABLE `tbl_country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_form_info`
--
ALTER TABLE `tbl_form_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_fp_id` (`firstlevel_problem`),
  ADD KEY `fk_sp_id` (`secondlevel_problem`),
  ADD KEY `fk_country` (`country`);

--
-- Indexes for table `tbl_fp`
--
ALTER TABLE `tbl_fp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_lookup`
--
ALTER TABLE `tbl_lookup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_migration`
--
ALTER TABLE `tbl_migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `tbl_profile`
--
ALTER TABLE `tbl_profile`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_social_account`
--
ALTER TABLE `tbl_social_account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `account_unique` (`provider`,`client_id`),
  ADD UNIQUE KEY `account_unique_code` (`code`),
  ADD KEY `fk_user_account` (`user_id`);

--
-- Indexes for table `tbl_sp`
--
ALTER TABLE `tbl_sp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_fp` (`fpid`);

--
-- Indexes for table `tbl_token`
--
ALTER TABLE `tbl_token`
  ADD UNIQUE KEY `token_unique` (`user_id`,`code`,`type`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_unique_email` (`email`),
  ADD UNIQUE KEY `user_unique_username` (`username`);

--
-- Indexes for table `tbl_user_data`
--
ALTER TABLE `tbl_user_data`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_check`
--
ALTER TABLE `tbl_check`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '序号',AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_country`
--
ALTER TABLE `tbl_country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '序号',AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_form_info`
--
ALTER TABLE `tbl_form_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '序号',AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_fp`
--
ALTER TABLE `tbl_fp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '序号',AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbl_lookup`
--
ALTER TABLE `tbl_lookup`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_social_account`
--
ALTER TABLE `tbl_social_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_sp`
--
ALTER TABLE `tbl_sp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '序号',AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_user_data`
--
ALTER TABLE `tbl_user_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- 限制导出的表
--

--
-- 限制表 `tbl_check`
--
ALTER TABLE `tbl_check`
  ADD CONSTRAINT `fk_fid` FOREIGN KEY (`fpid`) REFERENCES `tbl_fp` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sid` FOREIGN KEY (`spid`) REFERENCES `tbl_sp` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- 限制表 `tbl_form_info`
--
ALTER TABLE `tbl_form_info`
  ADD CONSTRAINT `fk_country` FOREIGN KEY (`country`) REFERENCES `tbl_country` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_fp_id` FOREIGN KEY (`firstlevel_problem`) REFERENCES `tbl_fp` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sp_id` FOREIGN KEY (`secondlevel_problem`) REFERENCES `tbl_sp` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- 限制表 `tbl_profile`
--
ALTER TABLE `tbl_profile`
  ADD CONSTRAINT `fk_user_profile` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE;

--
-- 限制表 `tbl_social_account`
--
ALTER TABLE `tbl_social_account`
  ADD CONSTRAINT `fk_user_account` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE;

--
-- 限制表 `tbl_sp`
--
ALTER TABLE `tbl_sp`
  ADD CONSTRAINT `fk_fp` FOREIGN KEY (`fpid`) REFERENCES `tbl_fp` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- 限制表 `tbl_token`
--
ALTER TABLE `tbl_token`
  ADD CONSTRAINT `fk_user_token` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
