-- phpMyAdmin SQL Dump
-- version 2.6.1
-- http://www.phpmyadmin.net
-- 
-- Хост: localhost
-- Время создания: Апр 02 2008 г., 19:49
-- Версия сервера: 5.0.45
-- Версия PHP: 5.2.4
-- 
-- БД: `moyvkus_db`
-- 

-- --------------------------------------------------------

-- 
-- Структура таблицы `captcha`
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
-- Структура таблицы `menu`
-- 

CREATE TABLE `menu` (
  `ID` int(11) NOT NULL auto_increment,
  `text` varchar(50) default NULL,
  `url` varchar(200) default NULL,
  `img_url` varchar(200) default NULL,
  `tooltip` varchar(200) default NULL,
  UNIQUE KEY `id` (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=3 ;

/*Table structure for table `user_data` */

CREATE TABLE `user_data` (
  `user_id` int(11) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `activities` varchar(2000) DEFAULT NULL,
  `interests` varchar(2000) DEFAULT NULL,
  `about` varchar(2000) DEFAULT NULL,
  `avatar_name` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

/*Table structure for table `users` */

CREATE TABLE `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `sex` tinyint(1) DEFAULT NULL,
  `city` int(11) DEFAULT NULL,
  `region` int(11) DEFAULT NULL,
  `country` int(11) DEFAULT NULL,
  UNIQUE KEY `UserID` (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=cp1251;


CREATE TABLE IF NOT EXISTS  `ci_sessions` (
session_id varchar(40) DEFAULT '0' NOT NULL,
ip_address varchar(16) DEFAULT '0' NOT NULL,
user_agent varchar(50) NOT NULL,
last_activity int(10) unsigned DEFAULT 0 NOT NULL,
PRIMARY KEY (session_id)
);


/*Table structure for table `myfriends` */

CREATE TABLE `myfriends` (
  `user_id` int(11) DEFAULT NULL,
  `friend_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

/*Table structure for table `invite` */

CREATE TABLE `invite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `friend_email` varchar(100) DEFAULT NULL,
  `friend_first_name` varchar(100) DEFAULT NULL,
  `friend_last_name` varchar(100) DEFAULT NULL,
   UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

/*Table structure for table `message` */

CREATE TABLE `message` (
  `from_id` int(11) DEFAULT NULL,
  `to_id` int(11) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `text` text DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

/*Table structure for table `message_spam_filter` */

CREATE TABLE `message_spam_filter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `message_count` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;