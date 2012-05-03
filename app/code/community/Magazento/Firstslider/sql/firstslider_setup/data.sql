-- phpMyAdmin SQL Dump
-- version 3.3.8.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 23, 2011 at 11:39 AM
-- Server version: 5.1.49
-- PHP Version: 5.3.3-1ubuntu9.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `magento1420`
--

-- --------------------------------------------------------

--
-- Table structure for table `magazento_firstslider_category`
--

CREATE TABLE IF NOT EXISTS `magazento_firstslider_category` (
  `category_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `from_time` datetime DEFAULT NULL,
  `to_time` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `magazento_firstslider_category`
--

INSERT INTO `magazento_firstslider_category` (`category_id`, `name`, `from_time`, `to_time`, `is_active`) VALUES
(1, 'Category English', '2009-11-06 06:46:36', '2015-07-12 14:45:00', 1),
(2, 'Category Russian', '2009-11-06 10:46:36', '2014-07-02 02:45:23', 1),
(3, 'Category German', '2001-02-08 16:59:31', '2013-02-08 12:45:56', 1),
(4, 'Category French', '2011-02-10 18:20:56', '2015-03-13 16:27:06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `magazento_firstslider_category_store`
--

CREATE TABLE IF NOT EXISTS `magazento_firstslider_category_store` (
  `category_id` smallint(6) unsigned DEFAULT NULL,
  `store_id` smallint(6) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `magazento_firstslider_category_store`
--

INSERT INTO `magazento_firstslider_category_store` (`category_id`, `store_id`) VALUES
(7, 0),
(2, 0),
(5, 0),
(1, 0),
(4, 0),
(3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `magazento_firstslider_slide`
--

CREATE TABLE IF NOT EXISTS `magazento_firstslider_slide` (
  `slide_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `position` smallint(6) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `content` text,
  `from_time` datetime DEFAULT NULL,
  `to_time` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`slide_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `magazento_firstslider_slide`
--

INSERT INTO `magazento_firstslider_slide` (`slide_id`, `position`, `title`, `content`, `from_time`, `to_time`, `is_active`) VALUES
(2, 1, 'Slide #1', '<p><img style="vertical-align: middle; border: 0pt none;" src="/media/magazento_firstslider/slider1.jpg" alt="" /></p>', '2009-06-11 06:46:36', NULL, 1),
(3, 3, 'Slide #3', '<p><img style="vertical-align: middle; border: 0pt none;" src="/media/magazento_firstslider/slider111.jpg" /></p>', '2009-06-11 10:46:36', NULL, 1),
(4, 2, 'Slide #2', '<p><img style="vertical-align: middle; border: 0pt none;" src="/media/magazento_firstslider/slider11.jpg" alt="" width="150" height="100" /></p>', '2009-06-11 10:46:36', NULL, 1),
(5, 4, 'Slide #4', '<p><img style="vertical-align: middle; border: 0pt none;" src="/media/magazento_firstslider/slider2.jpg" alt="" width="536" height="100" /></p>', '2011-02-10 17:05:30', NULL, 1),
(6, 5, 'Slide #5', '<p><img style="vertical-align: middle; border: 0pt none;" src="/media/magazento_firstslider/slider22.jpg"  /></p>', '2011-02-10 17:06:40', NULL, 1),
(7, 6, 'Slide #6', '<p><img style="vertical-align: middle; border: 0pt none;" src="/media/magazento_firstslider/slider222.jpg" /></p>', '2011-02-10 17:07:48', NULL, 1),
(8, 7, 'Slide #7', '<p><img style="vertical-align: middle; border: 0pt none;" src="/media/magazento_firstslider/slider4.jpg" alt="" /></p>', '2008-09-02 18:21:00', NULL, 1),
(9, 8, 'Slide #8', '<p><img style="vertical-align: middle; border: 0pt none;" src="/media/magazento_firstslider/slider44.jpg" alt="" /></p>', '2008-06-02 18:22:00', NULL, 1),
(10, 9, 'Slide #9', '<p><img style="vertical-align: middle; border: 0pt none;" src="/media/magazento_firstslider/slider444.jpg" alt="" /></p>', '2007-10-02 18:22:00', NULL, 1),
(11, 11, 'Slide #11', '<p><img style="vertical-align: middle; border: 0pt none;" src="/media/magazento_firstslider/slider33.jpg" alt="" /></p>', '2008-10-01 18:23:00', NULL, 1),
(12, 10, 'Slide #10', '<p><img style="vertical-align: middle; border: 0pt none;" src="/media/magazento_firstslider/slider3.jpg" alt="" width="201" height="100" /></p>', '2007-09-03 18:23:00', NULL, 1),
(13, 12, 'Slide #12', '<p><img style="vertical-align: middle; border: 0pt none;" src="/media/magazento_firstslider/slider333.jpg" alt="" /></p>', '2008-10-07 18:24:00', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `magazento_firstslider_slide_category`
--

CREATE TABLE IF NOT EXISTS `magazento_firstslider_slide_category` (
  `slide_id` smallint(6) unsigned DEFAULT NULL,
  `category_id` smallint(6) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `magazento_firstslider_slide_category`
--

INSERT INTO `magazento_firstslider_slide_category` (`slide_id`, `category_id`) VALUES
(5, 2),
(4, 1),
(6, 2),
(3, 1),
(7, 2),
(2, 1),
(8, 4),
(9, 4),
(10, 4),
(12, 3),
(11, 3),
(13, 3);
