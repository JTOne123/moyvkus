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
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- 


--
-- ��������� ������� `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `ID` int(11) NOT NULL auto_increment,
  `text` varchar(50) default NULL,
  `url` varchar(200) default NULL,
  `img_url` varchar(200) default NULL,
  `tooltip` varchar(200) default NULL,
  `sort` int(11) NOT NULL,
  UNIQUE KEY `id` (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=14 ;

--
-- ���� ������ ������� `menu`
--

INSERT INTO `menu` (`ID`, `text`, `url`, `img_url`, `tooltip`, `sort`) VALUES
(5, '��������', '~/users', '', '��������', 3),
(6, '�����', '~/search', '', '�����', 7),
(8, '������', '~/myfriends', '', '������', 1),
(9, '�������', '~/recipes', '', '�������', 5),
(4, '���������', '~/mymessages', '', '���������', 2),
(10, '��� �������', '~/mynews', '', '��� �������', 4),
(3, '�������', '~/profile', '', '�������', 0),
(11, '���������� �����', '~/invite', '', '���������� �����', 8),
(13, '�����', '~/blogs', NULL, '�����', 6);


/*Table structure for table `user_data` */

DROP TABLE IF EXISTS `user_data`;
CREATE TABLE IF NOT EXISTS `user_data` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `phone` varchar(15) default NULL,
  `website` varchar(100) default NULL,
  `activities` varchar(2000) default NULL,
  `interests` varchar(2000) default NULL,
  `about` varchar(2000) default NULL,
  `avatar_name` varchar(200) default NULL,
  `rating` int(10) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

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
  `ci_sessions` text DEFAULT NULL,
  UNIQUE KEY `UserID` (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=cp1251;


DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL default '0',
  `ip_address` varchar(16) NOT NULL default '0',
  `user_agent` varchar(50) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL default '0',
  `user_data` text NOT NULL,
  PRIMARY KEY  (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `myfriends` */

CREATE TABLE `myfriends` (
  `user_id` int(11) DEFAULT NULL,
  `friend_id` int(11) DEFAULT NULL,
  `is_confirmed` tinyint(1) DEFAULT NULL
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
  `from_id` int(11) default NULL,
  `to_id` int(11) default NULL,
  `subject` varchar(100) default NULL,
  `text` text,
  `id` int(11) NOT NULL auto_increment,
  `date` datetime default NULL,
  `is_readed` int(11) NOT NULL default '0',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=16;

/*Table structure for table `message_spam_filter` */

CREATE TABLE `message_spam_filter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `message_count` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;


DROP TABLE IF EXISTS `recipes`;
CREATE TABLE IF NOT EXISTS `recipes` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(300) NOT NULL,
  `category_id` int(11) NOT NULL,
  `kitchen_id` int(11) NOT NULL,
  `portions` int(3) NOT NULL,
  `ingredients` varchar(2000) NOT NULL,
  `recipe_text` varchar(3000) NOT NULL,
  `photo_name` varchar(200) default NULL,
  `source` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `user_id` int(10) NOT NULL,
  `rating` int(10) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=3 ;
        
        

CREATE TABLE `categorys` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(70) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

INSERT INTO `categorys` VALUES (2, '�������� �������');
INSERT INTO `categorys` VALUES (3, '������');
INSERT INTO `categorys` VALUES (4, '������� �������');
INSERT INTO `categorys` VALUES (5, '����');
INSERT INTO `categorys` VALUES (6, '�������� �����');
INSERT INTO `categorys` VALUES (7, '�������');
INSERT INTO `categorys` VALUES (8, '�������');
INSERT INTO `categorys` VALUES (9, '�������');
INSERT INTO `categorys` VALUES (10, '�����');
INSERT INTO `categorys` VALUES (11, '�������������� �������');
INSERT INTO `categorys` VALUES (12, '����������� �������');
INSERT INTO `categorys` VALUES (13, '������� �����');
INSERT INTO `categorys` VALUES (14, '������� �������');
INSERT INTO `categorys` VALUES (15, '��� ������� ���');
INSERT INTO `categorys` VALUES (16, '��� �������� ���');
INSERT INTO `categorys` VALUES (17, '��� ����� ���������');
INSERT INTO `categorys` VALUES (18, '��� ������������� ����');
INSERT INTO `categorys` VALUES (19, '������� ��� �����');
INSERT INTO `categorys` VALUES (20, '������� � ��������');
INSERT INTO `categorys` VALUES (21, '������������ ����');
INSERT INTO `categorys` VALUES (22, '������');


CREATE TABLE IF NOT EXISTS `kitchens` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(70) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

INSERT INTO `kitchens` VALUES (1, '��������');
INSERT INTO `kitchens` VALUES (2, '���������');
INSERT INTO `kitchens` VALUES (3, '�������������');
INSERT INTO `kitchens` VALUES (4, '�����������');
INSERT INTO `kitchens` VALUES (5, '���������������');
INSERT INTO `kitchens` VALUES (6, '������������');
INSERT INTO `kitchens` VALUES (7, '����������');
INSERT INTO `kitchens` VALUES (8, '��������');
INSERT INTO `kitchens` VALUES (9, '������������');
INSERT INTO `kitchens` VALUES (10, '���������');
INSERT INTO `kitchens` VALUES (11, '�����������');
INSERT INTO `kitchens` VALUES (12, '�����������');
INSERT INTO `kitchens` VALUES (13, '�����������');
INSERT INTO `kitchens` VALUES (14, '����������');
INSERT INTO `kitchens` VALUES (15, '�����������');
INSERT INTO `kitchens` VALUES (16, '���������');
INSERT INTO `kitchens` VALUES (17, '����������');
INSERT INTO `kitchens` VALUES (18, '����������');
INSERT INTO `kitchens` VALUES (19, '�����������');
INSERT INTO `kitchens` VALUES (20, '���������');
INSERT INTO `kitchens` VALUES (21, '�����������');
INSERT INTO `kitchens` VALUES (22, '���������');
INSERT INTO `kitchens` VALUES (23, '����������');
INSERT INTO `kitchens` VALUES (24, '�������');
INSERT INTO `kitchens` VALUES (25, '���������');
INSERT INTO `kitchens` VALUES (26, '����������');
INSERT INTO `kitchens` VALUES (27, '���������');
INSERT INTO `kitchens` VALUES (28, '��������');
INSERT INTO `kitchens` VALUES (29, '����������');
INSERT INTO `kitchens` VALUES (30, '���������');
INSERT INTO `kitchens` VALUES (31, '�����������');
INSERT INTO `kitchens` VALUES (32, '����������');
INSERT INTO `kitchens` VALUES (33, '���������');
INSERT INTO `kitchens` VALUES (34, '���������');
INSERT INTO `kitchens` VALUES (35, '���������');
INSERT INTO `kitchens` VALUES (36, '����');
INSERT INTO `kitchens` VALUES (37, '���������');
INSERT INTO `kitchens` VALUES (38, '���������');
INSERT INTO `kitchens` VALUES (39, '����� �������');
INSERT INTO `kitchens` VALUES (40, '���������');
INSERT INTO `kitchens` VALUES (41, '���������');
INSERT INTO `kitchens` VALUES (42, '������������');
INSERT INTO `kitchens` VALUES (43, '������������');
INSERT INTO `kitchens` VALUES (44, '������������');
INSERT INTO `kitchens` VALUES (45, '����������');
INSERT INTO `kitchens` VALUES (46, '�����������');
INSERT INTO `kitchens` VALUES (47, '��������');
INSERT INTO `kitchens` VALUES (48, '����������');
INSERT INTO `kitchens` VALUES (49, '��������');
INSERT INTO `kitchens` VALUES (50, '�������������');
INSERT INTO `kitchens` VALUES (51, '���������');
INSERT INTO `kitchens` VALUES (52, '�������');
INSERT INTO `kitchens` VALUES (53, '���������');
INSERT INTO `kitchens` VALUES (54, '�������');
INSERT INTO `kitchens` VALUES (55, '���������');
INSERT INTO `kitchens` VALUES (56, '��������');
INSERT INTO `kitchens` VALUES (57, '���������');
INSERT INTO `kitchens` VALUES (58, '����������');
INSERT INTO `kitchens` VALUES (59, '���������');
INSERT INTO `kitchens` VALUES (60, '�������');
INSERT INTO `kitchens` VALUES (61, '�����������');
INSERT INTO `kitchens` VALUES (62, '�������');
INSERT INTO `kitchens` VALUES (63, '��������');
INSERT INTO `kitchens` VALUES (64, '�����������');
INSERT INTO `kitchens` VALUES (65, '�����������');
INSERT INTO `kitchens` VALUES (66, '���������');
INSERT INTO `kitchens` VALUES (67, '�����������');
INSERT INTO `kitchens` VALUES (68, '��������');



CREATE TABLE `comments` (
  `id` int(11) NOT NULL auto_increment,
  `text` varchar(1500) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;



CREATE TABLE IF NOT EXISTS `word_censor` (
  `id` int(11) NOT NULL auto_increment,
  `word` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- 
-- ���� ������ ������� `word_censor`
-- 

INSERT INTO `word_censor` VALUES (1, '���');
INSERT INTO `word_censor` VALUES (2, '����');
INSERT INTO `word_censor` VALUES (3, '����');
INSERT INTO `word_censor` VALUES (4, '�����');
INSERT INTO `word_censor` VALUES (5, '�����');
INSERT INTO `word_censor` VALUES (7, '������');
INSERT INTO `word_censor` VALUES (8, '�����');
INSERT INTO `word_censor` VALUES (9, '�����');
INSERT INTO `word_censor` VALUES (10, 'fuck');
INSERT INTO `word_censor` VALUES (11, 'suck');


CREATE TABLE `favorites` (
`id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
`recipe_id` INT( 11 ) NOT NULL ,
`who_add_user_id` INT( 11 ) NOT NULL ,
PRIMARY KEY ( `id` )
);

CREATE TABLE IF NOT EXISTS `rating_act_desk` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

CREATE TABLE `forget_password` (
  `user_id` int(11) DEFAULT NULL,
  `user_code` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;



--
-- ��������� ������� `blog`
--

DROP TABLE IF EXISTS `blog`;
CREATE TABLE IF NOT EXISTS `blog` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(150) NOT NULL,
  `text` text NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=0 ;