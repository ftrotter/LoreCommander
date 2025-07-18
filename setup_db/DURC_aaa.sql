-- MySQL dump 10.17  Distrib 10.3.25-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: DURC_aaa
-- ------------------------------------------------------
-- Server version	10.3.25-MariaDB-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Should be Ignored`
--

DROP TABLE IF EXISTS `Should be Ignored`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Should be Ignored` (
  `firstname` varchar(11) DEFAULT NULL,
  `lastname` varchar(12) DEFAULT NULL,
  `NULL` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `author`
--

DROP TABLE IF EXISTS `author`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `author` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=266 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `author_book`
--

DROP TABLE IF EXISTS `author_book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `author_book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `authortype_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `authortype`
--

DROP TABLE IF EXISTS `authortype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `authortype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `authortypedesc` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `release_date` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `characterTest`
--

DROP TABLE IF EXISTS `characterTest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `characterTest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `funny_character_field` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_text` varchar(1000) NOT NULL,
  `post_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `donation`
--

DROP TABLE IF EXISTS `donation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `donation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` int(11) NOT NULL,
  `nonprofitcorp_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `filterTest`
--

DROP TABLE IF EXISTS `filterTest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `filterTest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `test_url` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `test_json` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `foreignkeytestgizmo`
--

DROP TABLE IF EXISTS `foreignkeytestgizmo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `foreignkeytestgizmo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gizmoname` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `foreignkeytestthingy`
--

DROP TABLE IF EXISTS `foreignkeytestthingy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `foreignkeytestthingy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `thingyname` varchar(100) NOT NULL,
  `gizmopickupaskey` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `gizmopickupaskey` (`gizmopickupaskey`),
  CONSTRAINT `forgizmo` FOREIGN KEY (`gizmopickupaskey`) REFERENCES `foreignkeytestgizmo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `funnything`
--

DROP TABLE IF EXISTS `funnything`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `funnything` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `thisint` int(11) DEFAULT NULL,
  `thisfloat` float DEFAULT NULL,
  `thisdecimal` decimal(5,5) DEFAULT NULL,
  `thisvarchar` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thisdate` date DEFAULT NULL,
  `thisdatetime` datetime DEFAULT NULL,
  `thistimestamp` timestamp NULL DEFAULT NULL,
  `thischar` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thistext` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `thisblob` blob DEFAULT NULL,
  `thistinyint` tinyint(11) NOT NULL,
  `thistinytext` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `graphdata_nodetypetests`
--

DROP TABLE IF EXISTS `graphdata_nodetypetests`;

CREATE TABLE `graphdata_nodetypetests` (
  `source_id` varchar(25) NOT NULL,
  `source_name` varchar(190) NOT NULL,
  `source_size` int(11) NOT NULL DEFAULT 0,
  `source_type` varchar(100) NOT NULL,
  `source_group` varchar(190) NOT NULL,
  `source_longitude` decimal(17,7) NOT NULL DEFAULT 0.0000000,
  `source_latitude` decimal(17,7) NOT NULL DEFAULT 0.0000000,
  `source_img` varchar(190) DEFAULT NULL,
  `target_id` varchar(25) NOT NULL,
  `target_name` varchar(190) NOT NULL,
  `target_size` int(11) NOT NULL DEFAULT 0,
  `target_type` varchar(100) NOT NULL,
  `target_group` varchar(190) NOT NULL,
  `target_longitude` decimal(17,7) NOT NULL DEFAULT 0.0000000,
  `target_latitude` decimal(17,7) NOT NULL DEFAULT 0.0000000,
  `target_img` varchar(190) DEFAULT NULL,
  `weight` int(11) NOT NULL DEFAULT 50,
  `link_type` varchar(190) NOT NULL,
  `query_num` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


ALTER TABLE `graphdata_nodetypetests`
  ADD PRIMARY KEY (`source_id`,`source_type`,`target_id`,`target_type`);


--
-- Table structure for table `magicField`
--

DROP TABLE IF EXISTS `magicField`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `magicField` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `editsome_markdown` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `typesome_sql_code` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `typesome_php_code` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `typesome_python_code` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `typesome_javascript_code` varchar(3000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `this_datetime` datetime NOT NULL,
  `this_date` date NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sibling`
--

DROP TABLE IF EXISTS `sibling`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sibling` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `siblingname` varchar(255) NOT NULL,
  `step_sibling_id` int(11) DEFAULT NULL,
  `sibling_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tags_report`
--

DROP TABLE IF EXISTS `tags_report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags_report` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `field_to_bold_in_report_display` varchar(255) NOT NULL,
  `field_to_hide_by_default` varchar(255) NOT NULL,
  `field_to_italic_in_report_display` varchar(255) NOT NULL,
  `field_to_right_align_in_report` varchar(255) NOT NULL,
  `field_to_bolditalic_in_report_display` varchar(255) NOT NULL,
  `numeric_field` int(11) NOT NULL,
  `decimal_field` decimal(10,4) NOT NULL,
  `currency_field` varchar(255) NOT NULL,
  `percent_field` int(11) NOT NULL,
  `url_field` varchar(255) NOT NULL,
  `time_field` time NOT NULL,
  `date_field` date NOT NULL,
  `datetime_field` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `test_boolean`
--

DROP TABLE IF EXISTS `test_boolean`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test_boolean` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) NOT NULL,
  `is_something` varchar(255) NOT NULL,
  `has_something` varchar(255) NOT NULL,
  `is_something2` tinyint(4) DEFAULT NULL,
  `has_something2` tinyint(4) DEFAULT NULL,
  `has_something3` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `test_created_only`
--

DROP TABLE IF EXISTS `test_created_only`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test_created_only` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `test_default_date`
--

DROP TABLE IF EXISTS `test_default_date`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test_default_date` (
  `id` int(11) NOT NULL,
  `datetime_none` datetime NOT NULL,
  `date_none` date NOT NULL,
  `datetime_current` datetime NOT NULL DEFAULT current_timestamp(),
  `date_current` varchar(255) DEFAULT 'Current timestamp not supported for date',
  `datetime_null` datetime DEFAULT NULL,
  `date_null` date DEFAULT NULL,
  `datetime_defined` datetime NOT NULL DEFAULT '2000-01-01 01:23:45',
  `date_defined` date NOT NULL DEFAULT '2000-01-01',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `test_null_default`
--

DROP TABLE IF EXISTS `test_null_default`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test_null_default` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `null_var` varchar(255) DEFAULT NULL,
  `non_null_var_def` varchar(255) NOT NULL,
  `non_null_var_no_def` varchar(255) DEFAULT NULL,
  `nullable_w_default` varchar(255) DEFAULT 'THIS IS THE DEFAULT',
  `non_null_default` varchar(255) NOT NULL DEFAULT 'I CANNOT BE NULL',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `vote`
--

DROP TABLE IF EXISTS `vote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `votenum` varchar(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

--
-- Table structure for table `leading_zero`
--

DROP TABLE IF EXISTS `leading_zero`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leading_zero` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `leading_zero_field` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

-- Dump completed on 2020-12-28  2:44:01
