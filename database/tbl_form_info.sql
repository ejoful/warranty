-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2016-09-13 14:41:33
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
-- 表的结构 `tbl_form_info`
--

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_form_info`
--
ALTER TABLE `tbl_form_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_fp_id` (`firstlevel_problem`),
  ADD KEY `fk_sp_id` (`secondlevel_problem`),
  ADD KEY `fk_country` (`country`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_form_info`
--
ALTER TABLE `tbl_form_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '序号';
--
-- 限制导出的表
--

--
-- 限制表 `tbl_form_info`
--
ALTER TABLE `tbl_form_info`
  ADD CONSTRAINT `fk_country` FOREIGN KEY (`country`) REFERENCES `tbl_country` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_fp_id` FOREIGN KEY (`firstlevel_problem`) REFERENCES `tbl_fp` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sp_id` FOREIGN KEY (`secondlevel_problem`) REFERENCES `tbl_sp` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
