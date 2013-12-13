-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Host: 173.201.214.106
-- Generation Time: Dec 12, 2013 at 01:48 AM
-- Server version: 5.0.96
-- PHP Version: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `zviniwww`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks`
--

DROP TABLE IF EXISTS `bookmarks`;
CREATE TABLE `bookmarks` (
  `idbookmarks` bigint(20) unsigned NOT NULL auto_increment,
  `idusers` bigint(20) unsigned NOT NULL,
  `title` varchar(128) character set utf8 collate utf8_unicode_ci NOT NULL,
  `url` varchar(2048) character set utf8 collate utf8_unicode_ci NOT NULL,
  `inserttime` bigint(20) unsigned NOT NULL,
  `updatetime` bigint(20) unsigned NOT NULL,
  PRIMARY KEY  (`idbookmarks`),
  KEY `idusers` (`idusers`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

-- --------------------------------------------------------

--
-- Table structure for table `channels`
--

DROP TABLE IF EXISTS `channels`;
CREATE TABLE `channels` (
  `idchannels` bigint(20) unsigned NOT NULL auto_increment,
  `idusers` bigint(20) unsigned NOT NULL,
  `channelname` varchar(32) character set ascii NOT NULL,
  `channelkey` binary(16) NOT NULL,
  `numnotifications` bigint(20) unsigned NOT NULL default '0',
  `inserttime` bigint(20) unsigned NOT NULL,
  PRIMARY KEY  (`idchannels`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts` (
  `idcontacts` bigint(20) unsigned NOT NULL auto_increment,
  `idusers` bigint(20) unsigned NOT NULL,
  `fullname` varchar(32) NOT NULL,
  `address` varchar(128) default NULL,
  `email` varchar(32) default NULL,
  `phone1` varchar(32) default NULL,
  `phone2` varchar(32) default NULL,
  PRIMARY KEY  (`idcontacts`),
  KEY `idusers` (`idusers`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE `events` (
  `idevents` bigint(20) unsigned NOT NULL auto_increment,
  `idusers` bigint(20) unsigned NOT NULL,
  `eventtext` text character set utf8 collate utf8_unicode_ci NOT NULL,
  `eventtime` bigint(20) unsigned NOT NULL,
  `inserttime` bigint(20) unsigned NOT NULL,
  `edittime` bigint(20) unsigned default NULL,
  PRIMARY KEY  (`idevents`),
  KEY `idusers` (`idusers`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

DROP TABLE IF EXISTS `feedbacks`;
CREATE TABLE `feedbacks` (
  `idfeedbacks` bigint(20) unsigned NOT NULL auto_increment,
  `idusers` bigint(20) unsigned NOT NULL,
  `feedbacktext` text character set utf8 collate utf8_unicode_ci NOT NULL,
  `inserttime` bigint(20) unsigned NOT NULL,
  PRIMARY KEY  (`idfeedbacks`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
CREATE TABLE `files` (
  `idfiles` bigint(20) unsigned NOT NULL auto_increment,
  `idfolders` bigint(20) unsigned NOT NULL,
  `idusers` bigint(20) unsigned NOT NULL,
  `filename` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  `filesize` bigint(20) unsigned NOT NULL,
  `modifieddate` timestamp NOT NULL default '0000-00-00 00:00:00',
  `inserttime` bigint(20) unsigned NOT NULL,
  PRIMARY KEY  (`idfiles`),
  KEY `idfolders` (`idfolders`),
  KEY `idusers` (`idusers`),
  KEY `filename` (`filename`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=661 ;

-- --------------------------------------------------------

--
-- Table structure for table `folders`
--

DROP TABLE IF EXISTS `folders`;
CREATE TABLE `folders` (
  `idfolders` bigint(20) unsigned NOT NULL auto_increment,
  `parentidfolders` bigint(20) unsigned NOT NULL,
  `idusers` bigint(20) unsigned NOT NULL,
  `foldername` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  `inserttime` bigint(20) unsigned NOT NULL,
  PRIMARY KEY  (`idfolders`),
  KEY `parentidfolders` (`parentidfolders`),
  KEY `idusers` (`idusers`),
  KEY `foldername` (`foldername`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=109 ;

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
CREATE TABLE `notes` (
  `idnotes` bigint(20) unsigned NOT NULL auto_increment,
  `idusers` bigint(20) unsigned NOT NULL,
  `notetext` varchar(1024) character set utf8 collate utf8_unicode_ci NOT NULL,
  `inserttime` bigint(20) unsigned NOT NULL,
  `updatetime` bigint(20) unsigned NOT NULL,
  PRIMARY KEY  (`idnotes`),
  KEY `idusers` (`idusers`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=56 ;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `idnotifications` bigint(20) unsigned NOT NULL auto_increment,
  `idusers` bigint(20) unsigned NOT NULL,
  `idchannels` bigint(20) unsigned NOT NULL,
  `channelname` varchar(32) character set ascii NOT NULL,
  `notificationtext` text character set utf8 collate utf8_unicode_ci NOT NULL,
  `inserttime` bigint(20) unsigned NOT NULL,
  PRIMARY KEY  (`idnotifications`),
  KEY `idusers` (`idusers`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE `tasks` (
  `idtasks` bigint(20) unsigned NOT NULL auto_increment,
  `idusers` bigint(20) unsigned NOT NULL,
  `tasktext` varchar(128) character set utf8 collate utf8_unicode_ci NOT NULL,
  `tags` varchar(256) character set utf8 collate utf8_unicode_ci NOT NULL,
  `inserttime` bigint(20) unsigned NOT NULL,
  `updatetime` bigint(20) unsigned NOT NULL,
  `done` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`idtasks`),
  KEY `idusers` (`idusers`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=112 ;

-- --------------------------------------------------------

--
-- Table structure for table `tasktags`
--

DROP TABLE IF EXISTS `tasktags`;
CREATE TABLE `tasktags` (
  `idtasktags` bigint(20) unsigned NOT NULL auto_increment,
  `idtasks` bigint(20) unsigned NOT NULL,
  `idusers` bigint(20) unsigned NOT NULL,
  `tagname` varchar(32) character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`idtasktags`),
  KEY `idtasks` (`idtasks`,`idusers`,`tagname`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=109 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `idusers` bigint(20) unsigned NOT NULL auto_increment,
  `username` varchar(32) character set ascii collate ascii_bin NOT NULL,
  `email` varchar(64) character set ascii collate ascii_bin NOT NULL,
  `password` binary(16) NOT NULL,
  `fullname` varchar(64) character set utf8 collate utf8_unicode_ci NOT NULL,
  `resetpasswordkey` binary(16) default NULL,
  `storageused` bigint(20) unsigned NOT NULL default '0',
  `theme` varchar(10) character set ascii collate ascii_bin NOT NULL default 'orange',
  `numnotifications` bigint(20) unsigned NOT NULL,
  `inserttime` bigint(20) unsigned NOT NULL,
  `lastlogintime` bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY  (`idusers`),
  UNIQUE KEY `username` (`username`),
  KEY `password` (`password`),
  KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=54 ;

