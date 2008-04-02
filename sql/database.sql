-- phpMyAdmin SQL Dump
-- version 2.6.1
-- http://www.phpmyadmin.net
-- 
-- ����: localhost
-- ����� ��������: ��� 02 2008 �., 19:49
-- ������ �������: 5.0.45
-- ������ PHP: 5.2.4
-- 
-- ��: `moyvkus_db`
-- 

-- --------------------------------------------------------

-- 
-- ��������� ������� `captcha`
-- 

CREATE TABLE `captcha` (
  `captcha_id` bigint(13) unsigned NOT NULL auto_increment,
  `captcha_time` int(10) unsigned NOT NULL,
  `ip_address` varchar(16) NOT NULL default '0',
  `word` varchar(20) NOT NULL,
  PRIMARY KEY  (`captcha_id`),
  KEY `word` (`word`)
) ENGINE=MyISAM AUTO_INCREMENT=410 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=410 ;

-- 


-- 
-- ��������� ������� `menu`
-- 

CREATE TABLE `menu` (
  `ID` int(11) NOT NULL auto_increment,
  `text` varchar(50) default NULL,
  `url` varchar(200) default NULL,
  `img_url` varchar(200) default NULL,
  `tooltip` varchar(200) default NULL,
  UNIQUE KEY `id` (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=3 ;

-- 
-- ��������� ������� `users`
-- 

CREATE TABLE `users` (
  `ID` int(11) NOT NULL auto_increment,
  `first_name` varchar(100) default NULL,
  `last_name` varchar(100) default NULL,
  `email` varchar(100) default NULL,
  `password` varchar(100) default NULL,
  `birthday` date default NULL,
  UNIQUE KEY `UserID` (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=6 ;