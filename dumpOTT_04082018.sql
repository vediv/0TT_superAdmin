-- MySQL dump 10.13  Distrib 5.7.13, for linux-glibc2.5 (x86_64)
--
-- 
-- ------------------------------------------------------
-- Server version	5.6.37-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bulkupload_status`
--

DROP TABLE IF EXISTS `bulkupload_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bulkupload_status` (
  `entryid` varchar(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` varchar(5) DEFAULT NULL,
  `uploading_time` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `catid` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `dept` int(11) DEFAULT NULL,
  `partner_id` int(11) DEFAULT NULL,
  `cat_name` varchar(200) DEFAULT NULL,
  `fullname` text,
  `fullids` text,
  `entry_count` int(11) DEFAULT NULL,
  `direct_sub_categories_count` int(11) DEFAULT NULL,
  `description` text,
  `tags` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `duser_id` int(11) DEFAULT NULL,
  `cat_thumbnail` longblob,
  `priority` int(11) DEFAULT NULL,
  `direct_entries_count` int(11) DEFAULT NULL,
  PRIMARY KEY (`catid`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `category_thumb_icon_url`
--

DROP TABLE IF EXISTS `category_thumb_icon_url`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_thumb_icon_url` (
  `category_id` int(11) DEFAULT NULL,
  `host_url_thumb` text,
  `host_url_icon` text,
  `t_original_url` text,
  `t_small_url` text,
  `t_mediam_url` text,
  `t_large_url` text,
  `t_custom_url` text,
  `i_original_url` text,
  `i_small_url` text,
  `i_mediam_url` text,
  `i_large_url` text,
  `i_custom_url` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `configuration_setup`
--

DROP TABLE IF EXISTS `configuration_setup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuration_setup` (
  `conf_id` int(11) NOT NULL AUTO_INCREMENT,
  `conf_user_id` int(11) DEFAULT NULL,
  `conf_title` varchar(45) DEFAULT NULL,
  `conf_data` text,
  `conf_date_added` datetime DEFAULT NULL,
  `conf_date_modified` datetime DEFAULT NULL,
  `conf_status` tinyint(1) DEFAULT '1',
  `conf_tag` varchar(50) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `device` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`conf_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `content_partner`
--

DROP TABLE IF EXISTS `content_partner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `content_partner` (
  `contentpartnerid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `license_start_date` date DEFAULT NULL,
  `license_end_date` date DEFAULT NULL,
  `video_count` varchar(4) DEFAULT NULL,
  `video_duration` varchar(10) DEFAULT NULL,
  `par_id` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`contentpartnerid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `content_setup`
--

DROP TABLE IF EXISTS `content_setup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `content_setup` (
  `content_id` int(11) NOT NULL AUTO_INCREMENT,
  `content_user_id` int(11) DEFAULT NULL,
  `content_title` varchar(45) DEFAULT NULL,
  `content_data` text,
  `content_date_added` datetime DEFAULT NULL,
  `content_date_modified` datetime DEFAULT NULL,
  `content_status` tinyint(1) DEFAULT '1',
  `content_url` varchar(45) DEFAULT NULL,
  `content_text` text,
  PRIMARY KEY (`content_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `continue_watching`
--

DROP TABLE IF EXISTS `continue_watching`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `continue_watching` (
  `userid` varchar(20) NOT NULL DEFAULT '',
  `entryid` varchar(100) NOT NULL DEFAULT '',
  `played_duration` varchar(150) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `addeddate` datetime DEFAULT NULL,
  PRIMARY KEY (`userid`,`entryid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `countries_currency`
--

DROP TABLE IF EXISTS `countries_currency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries_currency` (
  `ccid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `country_code` varchar(45) DEFAULT NULL,
  `currency` varchar(45) DEFAULT NULL,
  `status` enum('0','1') DEFAULT NULL,
  `symbol_native` text,
  PRIMARY KEY (`ccid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cue_point`
--

DROP TABLE IF EXISTS `cue_point`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cue_point` (
  `entryid` varchar(20) DEFAULT NULL,
  `partnerid` varchar(10) DEFAULT NULL,
  `created_at` varchar(20) DEFAULT NULL,
  `updated_at` varchar(20) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `start_time` varchar(20) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `adv_id` varchar(20) DEFAULT NULL,
  `URL` varchar(500) DEFAULT NULL,
  `adv_status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dashbord_footer`
--

DROP TABLE IF EXISTS `dashbord_footer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dashbord_footer` (
  `f_id` int(11) NOT NULL AUTO_INCREMENT,
  `f_year` varchar(50) DEFAULT NULL,
  `f_content` varchar(250) NOT NULL,
  `f_hyperlink` varchar(255) DEFAULT NULL,
  `f_date` datetime DEFAULT NULL,
  `f_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `entry`
--

DROP TABLE IF EXISTS `entry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entry` (
  `entryid` varchar(50) NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `thumbnail` varchar(256) DEFAULT NULL,
  `longdescription` text,
  `duration` varchar(8) DEFAULT NULL,
  `type` enum('0','1','2','3','4','5','6','7','8') DEFAULT NULL,
  `tag` text,
  `category` text,
  `categoryid` text,
  `status` enum('-2,''0','1','2','3','4','5','6') DEFAULT NULL,
  `isfeatured` enum('0','1') DEFAULT NULL,
  `ispremium` enum('0','1') DEFAULT '0',
  `planid` varchar(20) DEFAULT NULL,
  `contentpartnerid` varchar(20) DEFAULT NULL,
  `countrycode` text,
  `startdate` varchar(30) DEFAULT NULL,
  `enddate` varchar(30) DEFAULT NULL,
  `created_at` varchar(30) DEFAULT NULL,
  `updated_at` varchar(30) DEFAULT NULL,
  `shortdescription` text,
  `director` text,
  `producer` text,
  `cast` text,
  `crew` text,
  `sub_genre` text,
  `language` text,
  `pgrating` text,
  `video_status` varchar(15) DEFAULT NULL,
  `downloadURL` varchar(256) DEFAULT NULL,
  `puser_id` varchar(45) DEFAULT NULL,
  `country_data` text,
  `currency_data` text,
  `custom_data` text,
  PRIMARY KEY (`entryid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `favourite`
--

DROP TABLE IF EXISTS `favourite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favourite` (
  `entryid` varchar(20) NOT NULL DEFAULT '',
  `uid` varchar(20) NOT NULL DEFAULT '',
  `added_date` varchar(20) DEFAULT NULL,
  `status` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`entryid`,`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `featured_video_detail`
--

DROP TABLE IF EXISTS `featured_video_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `featured_video_detail` (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `entry_id` varchar(20) DEFAULT NULL,
  `feature_status` enum('1','0') DEFAULT NULL,
  `addded_date` date DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  `partner_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`fid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `filter_setting`
--

DROP TABLE IF EXISTS `filter_setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `filter_setting` (
  `fsid` int(11) NOT NULL AUTO_INCREMENT,
  `filtervalue` int(11) DEFAULT NULL,
  `filtertag` varchar(45) DEFAULT NULL,
  `filter_status` varchar(45) DEFAULT NULL,
  `par_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`fsid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `guest_user`
--

DROP TABLE IF EXISTS `guest_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `guest_user` (
  `userid` varchar(20) DEFAULT NULL,
  `device_uuid` varchar(50) DEFAULT NULL,
  `device_type` varchar(20) DEFAULT NULL,
  `device_os` varchar(20) DEFAULT NULL,
  `device_name` varchar(20) DEFAULT NULL,
  `last_visit` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `header_fixed_menu`
--

DROP TABLE IF EXISTS `header_fixed_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `header_fixed_menu` (
  `hfid` int(11) NOT NULL AUTO_INCREMENT,
  `header_fixed_mid` varchar(50) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `added_date` varchar(45) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`hfid`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `header_menu`
--

DROP TABLE IF EXISTS `header_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `header_menu` (
  `hid` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` varchar(50) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `header_name` varchar(45) DEFAULT NULL,
  `header_status` enum('1','0') DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `added_date` varchar(45) DEFAULT NULL,
  `update_date` varchar(45) DEFAULT NULL,
  `view_type` varchar(5) DEFAULT NULL,
  `host_url` text,
  `img_url` text,
  `menu_type` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`hid`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `home_title_tag`
--

DROP TABLE IF EXISTS `home_title_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `home_title_tag` (
  `tags_id` int(11) NOT NULL AUTO_INCREMENT,
  `title_tag_name` varchar(765) DEFAULT NULL,
  `search_tag` varchar(765) DEFAULT NULL,
  `tag_status` varchar(765) DEFAULT NULL,
  `priority` double DEFAULT NULL,
  `create_date` varchar(150) DEFAULT NULL,
  `home_menu` enum('1','0') DEFAULT NULL,
  PRIMARY KEY (`tags_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mail_config`
--

DROP TABLE IF EXISTS `mail_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mail_config` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_email` varchar(255) DEFAULT NULL,
  `mail_pass` varchar(255) DEFAULT NULL,
  `smtp_server` varchar(255) DEFAULT NULL,
  `port` int(11) DEFAULT NULL,
  `google_client_id` varchar(255) DEFAULT NULL,
  `client_secret` varchar(255) DEFAULT NULL,
  `refresh_token` varchar(255) DEFAULT NULL,
  `analytics_url` varchar(255) DEFAULT NULL,
  `publisherID` varchar(15) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `URL` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `mid` int(11) NOT NULL AUTO_INCREMENT,
  `mname` varchar(45) DEFAULT NULL,
  `menu_url` varchar(255) DEFAULT NULL,
  `mparentid` int(11) DEFAULT NULL,
  `mstatus` enum('0','1') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `multilevel` enum('0','1') DEFAULT '0',
  `child_id` varchar(255) DEFAULT NULL,
  `icon_class` varchar(255) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mywatch_list`
--

DROP TABLE IF EXISTS `mywatch_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mywatch_list` (
  `watch_id` int(11) NOT NULL AUTO_INCREMENT,
  `song_ids` varchar(100) DEFAULT NULL,
  `usr_ids` int(11) DEFAULT NULL,
  `tital_song` varchar(200) DEFAULT NULL,
  `song_add_time` datetime DEFAULT NULL,
  PRIMARY KEY (`watch_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `notification_details`
--

DROP TABLE IF EXISTS `notification_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notification_details` (
  `notification_id` varchar(20) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `message` text,
  `thumbnail` varchar(256) DEFAULT NULL,
  `total_success` varchar(256) DEFAULT NULL,
  `total_fail` varchar(256) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `mode` varchar(10) DEFAULT NULL,
  `sending_time` varchar(20) DEFAULT NULL,
  `sendingby` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `payment_history`
--

DROP TABLE IF EXISTS `payment_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_history` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `pay_amount` varchar(100) DEFAULT NULL,
  `paymode` varchar(100) DEFAULT NULL,
  `pay_date` varchar(100) DEFAULT NULL,
  `uid` varchar(100) DEFAULT NULL,
  `payment_status` enum('0','1') DEFAULT NULL,
  `plan_id` varchar(100) DEFAULT NULL,
  `subscribe_ID` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `plandetail`
--

DROP TABLE IF EXISTS `plandetail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plandetail` (
  `planID` varchar(20) NOT NULL,
  `planName` varchar(255) DEFAULT NULL,
  `pValue` varchar(255) DEFAULT NULL,
  `pduration` varchar(255) DEFAULT NULL,
  `pdescription` varchar(255) DEFAULT NULL,
  `pstatus` enum('1','0') DEFAULT '0',
  `plan_added_date` varchar(255) DEFAULT NULL,
  `plan_update_date` varchar(255) DEFAULT NULL,
  `plan_created_by` varchar(255) DEFAULT NULL,
  `partner_id` int(11) DEFAULT NULL,
  `color_code` varchar(20) DEFAULT NULL,
  `planuniquename` varchar(5) DEFAULT NULL,
  `currency` text,
  PRIMARY KEY (`planID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `playlist_config`
--

DROP TABLE IF EXISTS `playlist_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `playlist_config` (
  `pcid` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `song_id` varchar(255) DEFAULT NULL,
  `category_id` varchar(255) DEFAULT NULL,
  `song_title` varchar(255) DEFAULT NULL,
  `publise_date` varchar(255) DEFAULT NULL,
  `song_added_date` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`pcid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `playlists`
--

DROP TABLE IF EXISTS `playlists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `playlists` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `playlist_name` varchar(255) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `playlist_create_date` varchar(50) DEFAULT NULL,
  `playlist_update_date` varchar(50) DEFAULT NULL,
  `playlist_status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `publisher`
--

DROP TABLE IF EXISTS `publisher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publisher` (
  `par_id` int(11) NOT NULL AUTO_INCREMENT,
  `partner_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `duser_id` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `admin_secret` varchar(255) DEFAULT NULL,
  `service_url` varchar(255) DEFAULT NULL,
  `publisher_pass` varchar(255) DEFAULT NULL,
  `pstatus` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL,
  `acess_level` varchar(5) DEFAULT NULL,
  `parentid` int(11) DEFAULT NULL,
  `addedby` varchar(255) DEFAULT NULL,
  `dbName` varchar(255) DEFAULT NULL,
  `dbHostName` varchar(255) DEFAULT NULL,
  `dbUserName` varchar(255) DEFAULT NULL,
  `dbpassword` varchar(255) DEFAULT NULL,
  `publisherID` varchar(45) DEFAULT NULL,
  `cdnURL` varchar(255) DEFAULT NULL,
  `menu_permission` varchar(255) DEFAULT NULL,
  `operation_permission` varchar(255) DEFAULT NULL,
  `other_permission` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`par_id`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `publisher_setting`
--

DROP TABLE IF EXISTS `publisher_setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publisher_setting` (
  `setID` int(11) NOT NULL AUTO_INCREMENT,
  `sett_name` varchar(255) DEFAULT NULL,
  `sett_parentid` int(11) DEFAULT NULL,
  `sett_dept` int(11) DEFAULT NULL,
  `sett_on_off` enum('0','1') DEFAULT '0',
  `sett_status` enum('1','0') DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`setID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `slider_image_detail`
--

DROP TABLE IF EXISTS `slider_image_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `slider_image_detail` (
  `img_id` int(11) NOT NULL AUTO_INCREMENT,
  `img_name` varchar(255) DEFAULT NULL,
  `host_url` text,
  `img_url` text,
  `small_img_url` text,
  `medium_img_url` text,
  `large_img_url` text,
  `custom_img_url` text,
  `ventryid` varchar(50) DEFAULT NULL,
  `image` longblob,
  `img_status` tinyint(1) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `img_create_date` varchar(255) DEFAULT NULL,
  `partner_id` int(11) DEFAULT NULL,
  `theme` int(11) DEFAULT NULL,
  `slider_category` varchar(50) DEFAULT NULL,
  `slider_msg` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`img_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscribe_plan`
--

DROP TABLE IF EXISTS `subscribe_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscribe_plan` (
  `subscribeID` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) DEFAULT NULL,
  `planIDs` varchar(255) DEFAULT NULL,
  `subscribe_date` varchar(255) DEFAULT NULL,
  `subscribe_update_date` varchar(255) DEFAULT NULL,
  `subscribe_expire_date` varchar(255) DEFAULT NULL,
  `subcribe_status` enum('1','0') DEFAULT '0',
  `partner_id` int(11) DEFAULT NULL,
  `subscribe_event` varchar(255) DEFAULT NULL,
  `paymentID` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`subscribeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscribe_plan_log`
--

DROP TABLE IF EXISTS `subscribe_plan_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscribe_plan_log` (
  `uid` varchar(765) DEFAULT NULL,
  `planIDs` varchar(765) DEFAULT NULL,
  `subscribe_date` varchar(765) DEFAULT NULL,
  `subscribe_update_date` varchar(765) DEFAULT NULL,
  `subscribe_expire_date` varchar(765) DEFAULT NULL,
  `subcribe_status` varchar(3) DEFAULT NULL,
  `partner_id` double DEFAULT NULL,
  `subscribe_info` varchar(40) DEFAULT NULL,
  `archive_date_time` varchar(255) DEFAULT NULL,
  `paymentID` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_authentication_view_log`
--

DROP TABLE IF EXISTS `user_authentication_view_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_authentication_view_log` (
  `uaid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `entry_id` varchar(50) DEFAULT NULL,
  `view_date` datetime DEFAULT NULL,
  `last_seen` datetime DEFAULT NULL,
  `vlike` enum('L','D','N') DEFAULT 'N',
  `partner_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`uaid`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_device_info`
--

DROP TABLE IF EXISTS `user_device_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_device_info` (
  `userid` varchar(50) NOT NULL DEFAULT '',
  `deviceType` varchar(50) DEFAULT NULL,
  `deviceName` varchar(50) DEFAULT NULL,
  `os` varchar(50) DEFAULT NULL,
  `device_uuid` varchar(50) NOT NULL DEFAULT '',
  `user_status` varchar(10) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_logout` datetime DEFAULT NULL,
  `auth_provider` varchar(50) DEFAULT NULL,
  `uemail` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`userid`,`device_uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_notification`
--

DROP TABLE IF EXISTS `user_notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_notification` (
  `userid` varchar(15) DEFAULT NULL,
  `app_token` varchar(250) DEFAULT NULL,
  `device` varchar(30) DEFAULT NULL,
  `device_model` varchar(20) DEFAULT NULL,
  `os` varchar(20) DEFAULT NULL,
  `state` varchar(30) DEFAULT NULL,
  `registered_time` varchar(30) DEFAULT NULL,
  `badges` varchar(10) DEFAULT NULL,
  `uuid` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_payment_details`
--

DROP TABLE IF EXISTS `user_payment_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_payment_details` (
  `userid` varchar(10) DEFAULT NULL,
  `orderid` varchar(20) DEFAULT NULL,
  `trans_id` varchar(20) DEFAULT NULL,
  `order_status` varchar(10) DEFAULT NULL,
  `order_msg` varchar(250) DEFAULT NULL,
  `payment_mode` varchar(15) DEFAULT NULL,
  `status_code` int(1) DEFAULT NULL,
  `currency` varchar(10) DEFAULT NULL,
  `amount` varchar(10) DEFAULT NULL,
  `planid` varchar(5) DEFAULT NULL,
  `plan_days` int(5) DEFAULT NULL,
  `added_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `expire_date` datetime DEFAULT NULL,
  `trans_date` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_registration`
--

DROP TABLE IF EXISTS `user_registration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_registration` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `uemail` varchar(255) DEFAULT NULL,
  `upassword` varbinary(200) DEFAULT NULL,
  `dob` varchar(50) DEFAULT NULL,
  `ugender` varchar(10) DEFAULT NULL,
  `ulocation` varchar(255) DEFAULT NULL,
  `ustate` varchar(50) DEFAULT NULL,
  `ucountry` varchar(255) DEFAULT NULL,
  `ip` varchar(40) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `added_date` datetime DEFAULT '0000-00-00 00:00:00',
  `last_login` varchar(255) DEFAULT NULL,
  `oauth_provider` varchar(255) DEFAULT NULL,
  `oauth_uid` varchar(255) DEFAULT NULL,
  `host_url` text,
  `userimage_url` text,
  `intrest` varchar(100) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `country_code` varchar(10) DEFAULT NULL,
  `news_letter` enum('0','1') DEFAULT NULL,
  `flag` int(11) DEFAULT NULL,
  `wallet_point` int(11) DEFAULT '100',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `userhistory`
--

DROP TABLE IF EXISTS `userhistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userhistory` (
  `userid` int(11) NOT NULL DEFAULT '0',
  `entryid` varchar(25) NOT NULL DEFAULT '',
  `last_view` datetime DEFAULT NULL,
  `played_duration` int(11) DEFAULT '0',
  PRIMARY KEY (`userid`,`entryid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `userview_analtics`
--

DROP TABLE IF EXISTS `userview_analtics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userview_analtics` (
  `userid` varchar(10) DEFAULT NULL,
  `duration` varchar(20) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wallet_trans_info`
--

DROP TABLE IF EXISTS `wallet_trans_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wallet_trans_info` (
  `userid` varchar(10) DEFAULT NULL,
  `entryid` varchar(20) DEFAULT NULL,
  `video_price` varchar(10) DEFAULT NULL,
  `currency` varchar(5) DEFAULT NULL,
  `total_pont_used` varchar(5) DEFAULT NULL,
  `total_currency_used` varchar(10) DEFAULT NULL,
  `currency_trans_id` varchar(10) DEFAULT NULL,
  `purchase_date` datetime DEFAULT NULL,
  `expire_date` datetime DEFAULT NULL,
  `user_status` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `watch_later`
--

DROP TABLE IF EXISTS `watch_later`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `watch_later` (
  `entryid` varchar(20) DEFAULT NULL,
  `uid` varchar(20) DEFAULT NULL,
  `added_date` varchar(20) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-18 10:44:39
