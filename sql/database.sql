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

/*Table structure for table `menu` */

CREATE TABLE `menu` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(50) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `img_url` varchar(200) DEFAULT NULL,
  `tooltip` varchar(200) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  UNIQUE KEY `id` (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=cp1251;

/*Data for the table `menu` */

insert  into `menu`(`ID`,`text`,`url`,`img_url`,`tooltip`,`sort`) values (3,'�������','~/profile','~/images/main.gif','�������',0);
insert  into `menu`(`ID`,`text`,`url`,`img_url`,`tooltip`,`sort`) values (4,'��� ���������','~/mymessages','~/images/mymessages.gif','��� ���������',2);
insert  into `menu`(`ID`,`text`,`url`,`img_url`,`tooltip`,`sort`) values (5,'��� �������','~/my_recipes','~/images/myreciepts.gif','��� ������',3);
insert  into `menu`(`ID`,`text`,`url`,`img_url`,`tooltip`,`sort`) values (6,'��� �����','~/search','~/images/search.gif','��� �����',4);
insert  into `menu`(`ID`,`text`,`url`,`img_url`,`tooltip`,`sort`) values (7,'�����','~/logout','~/images/logout.gif','�����',5);
insert  into `menu`(`ID`,`text`,`url`,`img_url`,`tooltip`,`sort`) values (8,'��� ������','~/myfriends','~/images/myfriends.gif','��� ������',1);

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


CREATE TABLE `recipes` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(300) NOT NULL,
  `category_id` int(11) NOT NULL,
  `kitchen_id` int(11) NOT NULL,
  `portions` int(3) NOT NULL,
  `ingredients` varchar(2000) NOT NULL,
  `recipe_text` varchar(3000) NOT NULL,
  `photo_name` varchar(200) default NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `user_id` int(10) NOT NULL,
  `rating` int(10) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=48 ;
        
        

CREATE TABLE `categorys` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(70) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=23 ;

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
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=69 ;

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



CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL auto_increment,
  `text` varchar(1500) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;




CREATE TABLE IF NOT EXISTS `word_censor` (
  `id` int(11) NOT NULL auto_increment,
  `word` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=12 ;

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