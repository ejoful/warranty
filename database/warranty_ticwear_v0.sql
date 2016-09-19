/*
Navicat MySQL Data Transfer

Source Server         : mobvoi_misc
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : warranty_ticwear

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-09-19 14:41:52
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tbl_check`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_check`;
CREATE TABLE `tbl_check` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '序号',
  `fpid` int(11) NOT NULL COMMENT '一级问题类别',
  `spid` int(11) NOT NULL COMMENT '二级问题类别',
  `des` text NOT NULL COMMENT '检查步骤',
  `position` int(11) NOT NULL COMMENT '显示顺序',
  `yes` varchar(255) DEFAULT NULL COMMENT 'action yes',
  `no` varchar(255) DEFAULT NULL COMMENT 'action no',
  PRIMARY KEY (`id`),
  KEY `fk_fid` (`fpid`),
  KEY `fk_sid` (`spid`),
  CONSTRAINT `fk_fid` FOREIGN KEY (`fpid`) REFERENCES `tbl_fp` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_sid` FOREIGN KEY (`spid`) REFERENCES `tbl_sp` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_check
-- ----------------------------
INSERT INTO `tbl_check` VALUES ('1', '1', '6', 'Try charging the watch for 5 minutes, then try to turn it on by long pressing the watch crown for more than 10 seconds. Does it turn on now?', '1', '0_right_Glad to help you solve the problem! ', '2_return');
INSERT INTO `tbl_check` VALUES ('2', '1', '7', 'Now unplug and plug your charging dock with your cable, and your cable with your charger. Tweak them a bit to see if now it turns on. (We want to check if it\'s a charging unit connection issue).', '1', '0_wrong_There may be something wrong with your charging unit connection. We will ship you a new set.', '1_#3');
INSERT INTO `tbl_check` VALUES ('3', '1', '7', 'Now take your charging cable, plug the USB connector into your computer, and try to charge your phone with it. Does your phone charge?', '2', '0_wrong_There may be something wrong with your charging cable. We will ship you a new one.', '2_return');
INSERT INTO `tbl_check` VALUES ('4', '1', '8', 'Try to press the watch crown. Can the watch crown be pressed down?', '1', '1_#5', '2_return');
INSERT INTO `tbl_check` VALUES ('5', '1', '8', 'Try resetting the watch by long pressing the watch crown. Does the watch return to normal? ', '2', '0_right_Glad a re-start solved the problem!', '2_return');
INSERT INTO `tbl_check` VALUES ('6', '2', '9', 'Please perform the following operation: 1) Factory reset the watch by long pressing the watch crown and clearing data. 2)Remove and re-install Ticwear companion. 3) Make sure your Bluetooth is turned on on your phone, delete all Ticwatch devices that shows up on your \"settings\", and try connecting again. Does it connect?', '1', '0_right_Glad a re-start solved the problem!', '1_#7');
INSERT INTO `tbl_check` VALUES ('7', '2', '9', 'Find another phone around you. Download Ticwear app on that phone. Factory resest your watch and try pairing it with the phone. Does it pair?', '2', '0_wrong_Hmmm... There may be some problems with the Bluetooth of your phone. Go check it out with your retailer!', '2_return');
INSERT INTO `tbl_check` VALUES ('8', '2', '10', 'Make sure your Ticwear app and your watch are both updated to the latest system (check how to check for system updates here). Reset your watch by long pressing the watch crown and choosing the \"Factory Reset\" option. Pair the watch with Ticwear app following instructions. Make sure Ticwear is a trusted app on your phone, and is allowed to run in the background. Now does the watch keep disconnected within 20 feet of distance from your phone?', '1', '2_return', '0_right_Glad a re-start solved the problem!');
INSERT INTO `tbl_check` VALUES ('9', '3', '11', 'Does it look like one of the following screens (花屏或气泡图例）? ', '1', '2_return', '2_return');
INSERT INTO `tbl_check` VALUES ('10', '3', '12', '', '2', '2_return', '2_return');
INSERT INTO `tbl_check` VALUES ('11', '3', '13', 'Make sure you are not touching the \"Tickle\" (side strip). Clean the screen area and the \"Tickle\" area with dry cloth. Restart your watch by long pressing the watch crown and check for the latest system update in \"Settings\" app (if there is, update your watch). Does the problem persist?', '3', '2_return', '0_right_Glad a re-start solved the problem!');
INSERT INTO `tbl_check` VALUES ('12', '3', '14', 'Clean the screen area and the \"Tickle\" area with dry cloth. Restart your watch by long pressing the watch crown and check for the latest system update in \"Settings\" app (if there is, update your watch). Does the problem persist?', '4', '2_return', '0_right_Glad a re-start solved the problem!');
INSERT INTO `tbl_check` VALUES ('13', '4', '15', 'Go to Health App. Start heart rate monitoring. Are both greenlights at the back of the watch lit up & blinking?', '1', '1_#14', '2_return');
INSERT INTO `tbl_check` VALUES ('14', '4', '15', '(If greenlights are normal) Wear the watch and tighten watch strap. Take two readings, each time waiting for 10 seconds for the reading to stabalize. Does one of the readings fall between the range 60 - 100? (???)', '2', '0_right_The fluctuation is normal; it sometimes takes more time to establish a stable heart rate reading', '2_return');
INSERT INTO `tbl_check` VALUES ('15', '5', '16', 'Press and hold the watch crown for three seconds, until the screen with \"Shut Down\" choice comes up. Did you feel the vibration?', '1', '0_right_The motor seems to be working! Maybe it\'s something to do with settings? See in settings if your vibration has been turned off.', '2_return');
INSERT INTO `tbl_check` VALUES ('16', '6', '17', '', '1', '2_return', '2_return');
INSERT INTO `tbl_check` VALUES ('17', '7', '18', 'Please conduct the following experiment: 1) Turn on flight mode. 2) In \"Settings\" app, choose \"Preference\" and disable the ambient mode. 3) Change to stock watch faces. 4) Charge your watch to more than 40% battery, and record the exact percentage. 5) Wait 8-10 hours and record the batter percentage. Does the watch consume more than 40% of battery during this time?', '1', '2_return', '0_right_Your watch seem to be ok. Please go to FAQ section to get advice on how to improve your battery life. (FAQ link)');
INSERT INTO `tbl_check` VALUES ('18', '8', '19', 'Make sure your Ticwear app and your watch are both updated to the latest system (check how to check for system updates here). Reset your watch by long pressing the watch crown and choosing the \"Factory Reset\" option. Pair the watch with Ticwear app following instructions. Make sure Ticwear is a trusted app on your phone, and is allowed to run in the background. Do you still experience call noise within 3 feet from your phone?', '1', '2_return', '0_right_Glad a re-start solved the problem!');
INSERT INTO `tbl_check` VALUES ('19', '9', '20', 'Open \"Recorder\" app in your app list. Record something, and save the file locally. Now swipe left for the recorded file, and play it. Do you hear anything?', '1', '0_right_Your microphone seems to be ok. Contact us via email (support@mobvoi.com) if you have further questions.', '2_return');
INSERT INTO `tbl_check` VALUES ('20', '10', '21', 'Make sure your Ticwear app and your watch are both updated to the latest system (check how to check for system updates here). Reset your watch by long pressing the watch crown and choosing the \"Factory Reset\" option. Pair the watch with Ticwear app following instructions. Does the problem persist?', '1', '', '0_right_Glad a re-start solved the problem!');

-- ----------------------------
-- Table structure for `tbl_country`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_country`;
CREATE TABLE `tbl_country` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '序号',
  `country_name` varchar(100) NOT NULL COMMENT '国家名',
  `position` int(11) DEFAULT NULL COMMENT '显示顺序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_country
-- ----------------------------
INSERT INTO `tbl_country` VALUES ('1', 'US', '1');
INSERT INTO `tbl_country` VALUES ('2', 'China', '2');

-- ----------------------------
-- Table structure for `tbl_form_info`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_form_info`;
CREATE TABLE `tbl_form_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '序号',
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
  `logisid` int(11) DEFAULT NULL COMMENT '物流人员',
  PRIMARY KEY (`id`),
  KEY `fk_fp_id` (`firstlevel_problem`),
  KEY `fk_sp_id` (`secondlevel_problem`),
  KEY `fk_country` (`country`),
  CONSTRAINT `fk_country` FOREIGN KEY (`country`) REFERENCES `tbl_country` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_fp_id` FOREIGN KEY (`firstlevel_problem`) REFERENCES `tbl_fp` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_sp_id` FOREIGN KEY (`secondlevel_problem`) REFERENCES `tbl_sp` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_form_info
-- ----------------------------
INSERT INTO `tbl_form_info` VALUES ('1', 'wf', '18811717528', '232', '771569533@qq.com', '1', 'center', '', '1', '6', '', 'dfdfdf', 'www.baidu.com', '2016-09-07 19:20:00', '5', null, '2016-09-07 19:20:00', '0', '0', '0');
INSERT INTO `tbl_form_info` VALUES ('2', 'z', 'z', 'z', 'z', '1', 'z', '', '1', '6', '', '<p>zzz</p><p><img></p>', 'z', '2016-09-07 06:30:00', '5', null, '2016-09-07 20:45:00', '0', '0', '0');
INSERT INTO `tbl_form_info` VALUES ('3', 'w', 'w', 'w', 'w', '1', 'w', '', '1', '6', '', '<p>www</p><p><img></p>', 'w', '2016-09-07 20:50:00', '5', null, '2016-09-01 03:30:00', '0', '0', '0');
INSERT INTO `tbl_form_info` VALUES ('4', 'liming', '18792512639', 'sdffdsfdsfdsfsdfsdfdsf', 'yaoyang@mobvi.com', '1', 'fdsfdsfdsfsdf', '0115689', null, null, '<p>Upload&nbsp;the purchasing proof of your watch:<span class=\"redactor-invisible-space\" data-redactor-tag=\"span\" data-redactor-class=\"redactor-invisible-space\" data-verified=\"redactor\">​Upload the purchasing proof of your watch:<span class=\"redactor-invisible-space\" data-redactor-tag=\"span\" data-redactor-class=\"redactor-invisible-space\" data-verified=\"redactor\">​Upload the purchasing proof of your watch:<span class=\"redactor-invisible-space\" data-redactor-tag=\"span\" data-redactor-class=\"redactor-invisible-space\" data-verified=\"redactor\">​Upload the purchasing proof of your watch:<span class=\"redactor-invisible-space\" data-redactor-tag=\"span\" data-redactor-class=\"redactor-invisible-space\" data-verified=\"redactor\">​Upload the purchasing proof of your watch:</span></span></span></span><span class=\"redactor-invisible-space\">​</span></p>', '<p>please fill in the concrete problem description,not less than 20 words.<span>please fill in the concrete problem description,not less than 20 words.</span></p>', 'https://www.youtube.com/watch?v=RqS_PxMHqV8&list=RDMMRqS_PxMHqV8', '2016-09-12 15:09:46', '5', null, null, '1', null, null);
INSERT INTO `tbl_form_info` VALUES ('5', 'l1', '18792512639', 'sdfdsfsdfds', 'q@q.com', '1', 'fsdf', '789456', '1', '6', '<p>​fsd&nbsp;Upload the purchasing proof of your watch:<span class=\"redactor-invisible-space\">​Upload the purchasing proof of your watch:<span class=\"redactor-invisible-space\">​Upload the purchasing proof of your watch:<span class=\"redactor-invisible-space\">​&nbsp;Upload the purchasing proof of your watch:<span class=\"redactor-invisible-space\">​</span></span></span></span></p>', null, null, '2016-09-12 15:15:35', '5', null, null, '1', null, null);
INSERT INTO `tbl_form_info` VALUES ('6', 'l2', '18792512639', 'sdfsdfdsf', 'w@q.com', '1', 'sdfsdf', 'dsfdsf', null, null, '<p>​dffs&nbsp;Upload the purchasing proof of your watch:<span class=\"redactor-invisible-space\">​Upload the purchasing proof of your watch:<span class=\"redactor-invisible-space\">​Upload the purchasing proof of your watch:<span class=\"redactor-invisible-space\">​Upload the purchasing proof of your watch:<span class=\"redactor-invisible-space\">​</span></span></span></span></p>', '<p>​Write down the url of the video that can best help describe t<span class=\"redactor-invisible-space\">​Write down the url of the video that can best help describe t<span class=\"redactor-invisible-space\">​Write down the url of the video that can best help describe t<span class=\"redactor-invisible-space\">​Write down the url of the video that can best help describe t<span class=\"redactor-invisible-space\">​Write down the url of the video that can best help describe t<span class=\"redactor-invisible-space\">​Write down the url of the video that can best help describe t<span class=\"redactor-invisible-space\">​Write down the url of the video that can best help describe t<span class=\"redactor-invisible-space\">​</span></span></span></span></span></span></span></p>', null, '2016-09-12 15:17:15', '5', null, null, '1', null, null);
INSERT INTO `tbl_form_info` VALUES ('7', 'www', '18811717528', '222', '2222@qq.com', '1', '23', '13', '1', '6', '<p>​Upload the purchasing proof of your watch:<span class=\"redactor-invisible-space\">​Upload the purchasing proof of your watch:<span class=\"redactor-invisible-space\">​Upload the purchasing proof of your watch:<span class=\"redactor-invisible-space\">​Upload the purchasing proof of your watch:<span class=\"redactor-invisible-space\">​Upload the purchasing proof of your watch:<span class=\"redactor-invisible-space\">​Upload the purchasing proof of your watch:<span class=\"redactor-invisible-space\">​</span></span></span></span></span></span></p>', '<p>​</p>', null, '2016-09-14 07:31:59', '5', null, null, '1', null, null);
INSERT INTO `tbl_form_info` VALUES ('8', 'dfd', '18811717528', '111', '771569533@qq.com', '1', 'ddf', 'fdf', '1', '22', '<p>​Upload the purchasing proof of your watch:<span class=\"redactor-invisible-space\">​Upload the purchasing proof of your watch:<span class=\"redactor-invisible-space\">​Upload the purchasing proof of your watch:<span class=\"redactor-invisible-space\">​Upload the purchasing proof of your watch:<span class=\"redactor-invisible-space\">​Upload the purchasing proof of your watch:<span class=\"redactor-invisible-space\">​Upload the purchasing proof of your watch:<span class=\"redactor-invisible-space\">​Upload the purchasing proof of your watch:<span class=\"redactor-invisible-space\">​Upload the purchasing proof of your watch:<span class=\"redactor-invisible-space\">​Upload the purchasing proof of your watch:<span class=\"redactor-invisible-space\">​Upload the purchasing proof of your watch:<span class=\"redactor-invisible-space\">​Upload the purchasing proof of your watch:<span class=\"redactor-invisible-space\">​</span></span></span></span></span></span></span></span></span></span></span></p>', '<p>​Write down the url of the video that can best help describe the problem:<span class=\"redactor-invisible-space\">​Write down the url of the video that can best help describe the problem:<span class=\"redactor-invisible-space\">​Write down the url of the video that can best help describe the problem:<span class=\"redactor-invisible-space\">​Write down the url of the video that can best help describe the problem:<span class=\"redactor-invisible-space\">​Write down the url of the video that can best help describe the problem:<span class=\"redactor-invisible-space\">​Write down the url of the video that can best help describe the problem:<span class=\"redactor-invisible-space\">​Write down the url of the video that can best help describe the problem:<span class=\"redactor-invisible-space\">​Write down the url of the video that can best help describe the problem:<span class=\"redactor-invisible-space\">​Write down the url of the video that can best help describe the problem:<span class=\"redactor-invisible-space\">​</span></span></span></span></span></span></span></span></span></p>', null, '2016-09-19 05:04:56', null, null, null, '1', null, null);

-- ----------------------------
-- Table structure for `tbl_fp`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_fp`;
CREATE TABLE `tbl_fp` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '序号',
  `des` varchar(200) NOT NULL COMMENT '一级问题描述',
  `position` int(11) NOT NULL DEFAULT '0' COMMENT '问题显示顺序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_fp
-- ----------------------------
INSERT INTO `tbl_fp` VALUES ('1', 'Power-on', '1');
INSERT INTO `tbl_fp` VALUES ('2', 'Connection', '2');
INSERT INTO `tbl_fp` VALUES ('3', 'Display', '3');
INSERT INTO `tbl_fp` VALUES ('4', 'Heart Rate Monitoring', '4');
INSERT INTO `tbl_fp` VALUES ('5', 'Vibration', '5');
INSERT INTO `tbl_fp` VALUES ('6', 'Watch crown', '5');
INSERT INTO `tbl_fp` VALUES ('7', 'Battery consumption', '7');
INSERT INTO `tbl_fp` VALUES ('8', 'Calls', '8');
INSERT INTO `tbl_fp` VALUES ('9', 'Microphone', '9');
INSERT INTO `tbl_fp` VALUES ('10', 'Others', '10');

-- ----------------------------
-- Table structure for `tbl_lookup`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_lookup`;
CREATE TABLE `tbl_lookup` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(128) NOT NULL COMMENT '名字',
  `code` int(11) NOT NULL COMMENT '编码',
  `type` varchar(128) NOT NULL COMMENT '类型',
  `position` int(11) NOT NULL COMMENT '显示顺序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_lookup
-- ----------------------------
INSERT INTO `tbl_lookup` VALUES ('1', 'Created', '1', 'RMAStatus', '1');
INSERT INTO `tbl_lookup` VALUES ('2', 'Updated', '2', 'RMAStatus', '2');
INSERT INTO `tbl_lookup` VALUES ('3', 'Pending', '3', 'RMAStatus', '3');
INSERT INTO `tbl_lookup` VALUES ('4', 'Approved', '4', 'RMAStatus', '4');
INSERT INTO `tbl_lookup` VALUES ('5', 'Rejected', '5', 'RMAStatus', '5');
INSERT INTO `tbl_lookup` VALUES ('6', 'Shipped', '6', 'RMAStatus', '6');

-- ----------------------------
-- Table structure for `tbl_migration`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_migration`;
CREATE TABLE `tbl_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_migration
-- ----------------------------
INSERT INTO `tbl_migration` VALUES ('m000000_000000_base', '1473156347');
INSERT INTO `tbl_migration` VALUES ('m140209_132017_init', '1473156369');
INSERT INTO `tbl_migration` VALUES ('m140403_174025_create_account_table', '1473156371');
INSERT INTO `tbl_migration` VALUES ('m140504_113157_update_tables', '1473156376');
INSERT INTO `tbl_migration` VALUES ('m140504_130429_create_token_table', '1473156378');
INSERT INTO `tbl_migration` VALUES ('m140830_171933_fix_ip_field', '1473156378');
INSERT INTO `tbl_migration` VALUES ('m140830_172703_change_account_table_name', '1473156379');
INSERT INTO `tbl_migration` VALUES ('m141222_110026_update_ip_field', '1473156380');
INSERT INTO `tbl_migration` VALUES ('m141222_135246_alter_username_length', '1473156380');
INSERT INTO `tbl_migration` VALUES ('m150614_103145_update_social_account_table', '1473156383');
INSERT INTO `tbl_migration` VALUES ('m150623_212711_fix_username_notnull', '1473156384');
INSERT INTO `tbl_migration` VALUES ('m151218_234654_add_timezone_to_profile', '1473156385');

-- ----------------------------
-- Table structure for `tbl_profile`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_profile`;
CREATE TABLE `tbl_profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `public_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci,
  `timezone` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `fk_user_profile` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_profile
-- ----------------------------
INSERT INTO `tbl_profile` VALUES ('1', null, null, null, null, null, null, null, null);

-- ----------------------------
-- Table structure for `tbl_social_account`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_social_account`;
CREATE TABLE `tbl_social_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_unique` (`provider`,`client_id`),
  UNIQUE KEY `account_unique_code` (`code`),
  KEY `fk_user_account` (`user_id`),
  CONSTRAINT `fk_user_account` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_social_account
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_sp`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_sp`;
CREATE TABLE `tbl_sp` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '序号',
  `des` varchar(255) DEFAULT NULL COMMENT '二级问题描述',
  `position` int(11) DEFAULT '0' COMMENT '问题显示顺序',
  `fpid` int(11) NOT NULL COMMENT '一级问题分类',
  PRIMARY KEY (`id`),
  KEY `fk_fp` (`fpid`),
  CONSTRAINT `fk_fp` FOREIGN KEY (`fpid`) REFERENCES `tbl_fp` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_sp
-- ----------------------------
INSERT INTO `tbl_sp` VALUES ('6', 'My watch charges, but it doesn\'t turn on.', '1', '1');
INSERT INTO `tbl_sp` VALUES ('7', 'My watch cannot be charged. (The \"charging\" display doesn\'t show; the watch doesn\'t get warm after 10 minutes of charging.', '2', '1');
INSERT INTO `tbl_sp` VALUES ('8', 'My watch restarts by itself all the time.', '3', '1');
INSERT INTO `tbl_sp` VALUES ('9', 'My watch cannot be connected to my phone using BlueTooth.', '1', '2');
INSERT INTO `tbl_sp` VALUES ('10', 'My watch keeps disconnecting with my phone.', '2', '2');
INSERT INTO `tbl_sp` VALUES ('11', 'My display can be lit up, but there are abnormalies on my screen.', '1', '3');
INSERT INTO `tbl_sp` VALUES ('12', 'My display does not lit up, although I can see words/pictures.', '2', '3');
INSERT INTO `tbl_sp` VALUES ('13', 'When I swipe for next page, the displayed content seem to be stuck half way.', '3', '3');
INSERT INTO `tbl_sp` VALUES ('14', 'The watch doesn\'t react to my touch. ', '4', '3');
INSERT INTO `tbl_sp` VALUES ('15', 'The readings of my heart rate doesn\'t seem to be right.', '1', '4');
INSERT INTO `tbl_sp` VALUES ('16', 'When receiving notifications, my watch doesn\'t vibrate.', '1', '5');
INSERT INTO `tbl_sp` VALUES ('17', 'My watch crown cannot be pressed down.', '1', '6');
INSERT INTO `tbl_sp` VALUES ('18', 'My battery consumption doesn\'t seem to be normal.', '1', '7');
INSERT INTO `tbl_sp` VALUES ('19', 'I experience call noise when making/receiving calls from the watch.', '1', '8');
INSERT INTO `tbl_sp` VALUES ('20', 'I can\'t hear anything from the microphone.', '1', '9');
INSERT INTO `tbl_sp` VALUES ('21', '', null, '10');
INSERT INTO `tbl_sp` VALUES ('22', 'Others', '4', '1');
INSERT INTO `tbl_sp` VALUES ('23', 'Others', '3', '2');
INSERT INTO `tbl_sp` VALUES ('24', 'Others', '5', '3');
INSERT INTO `tbl_sp` VALUES ('25', 'Others', '2', '4');
INSERT INTO `tbl_sp` VALUES ('26', 'Others', '2', '6');
INSERT INTO `tbl_sp` VALUES ('27', 'Others', '2', '7');
INSERT INTO `tbl_sp` VALUES ('28', 'Others', '2', '8');
INSERT INTO `tbl_sp` VALUES ('29', 'Others', '2', '9');
INSERT INTO `tbl_sp` VALUES ('30', 'Others', '2', '5');

-- ----------------------------
-- Table structure for `tbl_token`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_token`;
CREATE TABLE `tbl_token` (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL,
  UNIQUE KEY `token_unique` (`user_id`,`code`,`type`),
  CONSTRAINT `fk_user_token` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_token
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_user`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `identity` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '身份',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_unique_email` (`email`),
  UNIQUE KEY `user_unique_username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
INSERT INTO `tbl_user` VALUES ('1', 'admin', '1@qq.com', '$2y$10$FbWvhYbJZ5ImhuE8YBW9PeUVEelX09rrcYjMzLHUergSEn3QxCq2O', 'zg0Zhy5Nr-8TALdUlvD2NIq46fl9UJzh', '1473156555', null, null, '127.0.0.1', '1473156555', '1473156555', '0', '');

-- ----------------------------
-- Table structure for `tbl_user_data`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user_data`;
CREATE TABLE `tbl_user_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wwid` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '问问id',
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '手機號碼',
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_user_data
-- ----------------------------
INSERT INTO `tbl_user_data` VALUES ('16', '', '898150165@qq.com', '898150165@qq.com', null, '', '123456', 'i4dshVnCY1nZjTw1xBnmdlSbmX0Z_q9Q_1473423252', '-1', '1473423252', '1473423252');
INSERT INTO `tbl_user_data` VALUES ('17', '', 'yaoyang@mobvoi.com', 'yaoyang@mobvoi.com', null, '', '123456', 'Q33vEoUUkTsPTJ1QmlY2E8FI2JJT9tQz_1473423294', '-1', '1473423294', '1473423294');
