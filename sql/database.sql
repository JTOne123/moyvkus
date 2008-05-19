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

insert  into `menu`(`ID`,`text`,`url`,`img_url`,`tooltip`,`sort`) values (3,'Главная','~/profile','~/images/main.gif','Главная',0);
insert  into `menu`(`ID`,`text`,`url`,`img_url`,`tooltip`,`sort`) values (4,'Мои сообщения','~/mymessages','~/images/mymessages.gif','Мои сообщения',2);
insert  into `menu`(`ID`,`text`,`url`,`img_url`,`tooltip`,`sort`) values (5,'Мои рецепты','~/my_recipes','~/images/myreciepts.gif','Мои рецпты',3);
insert  into `menu`(`ID`,`text`,`url`,`img_url`,`tooltip`,`sort`) values (6,'Мой поиск','~/search','~/images/search.gif','Мой поиск',4);
insert  into `menu`(`ID`,`text`,`url`,`img_url`,`tooltip`,`sort`) values (7,'Выход','~/logout','~/images/logout.gif','Выход',5);
insert  into `menu`(`ID`,`text`,`url`,`img_url`,`tooltip`,`sort`) values (8,'Мои друзья','~/myfriends','~/images/myfriends.gif','Мои друзья',1);

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

INSERT INTO `categorys` VALUES (2, 'Холодные закуски');
INSERT INTO `categorys` VALUES (3, 'Салаты');
INSERT INTO `categorys` VALUES (4, 'Горячие закуски');
INSERT INTO `categorys` VALUES (5, 'Супы');
INSERT INTO `categorys` VALUES (6, 'Основные блюда');
INSERT INTO `categorys` VALUES (7, 'Гарниры');
INSERT INTO `categorys` VALUES (8, 'Десерты');
INSERT INTO `categorys` VALUES (9, 'Выпечка');
INSERT INTO `categorys` VALUES (10, 'Соусы');
INSERT INTO `categorys` VALUES (11, 'Вегетарианские рецепты');
INSERT INTO `categorys` VALUES (12, 'Диетическое питание');
INSERT INTO `categorys` VALUES (13, 'Постные блюда');
INSERT INTO `categorys` VALUES (14, 'Рецепты красоты');
INSERT INTO `categorys` VALUES (15, 'Для будущих мам');
INSERT INTO `categorys` VALUES (16, 'Для кормящих мам');
INSERT INTO `categorys` VALUES (17, 'Для самых маленьких');
INSERT INTO `categorys` VALUES (18, 'Для микроволновой печи');
INSERT INTO `categorys` VALUES (19, 'Рецепты для любви');
INSERT INTO `categorys` VALUES (20, 'Напитки и Коктейли');
INSERT INTO `categorys` VALUES (21, 'Консервируем сами');
INSERT INTO `categorys` VALUES (22, 'Разное');


CREATE TABLE IF NOT EXISTS `kitchens` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(70) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=69 ;

INSERT INTO `kitchens` VALUES (1, 'Домашняя');
INSERT INTO `kitchens` VALUES (2, 'Абхазская');
INSERT INTO `kitchens` VALUES (3, 'Австралийская');
INSERT INTO `kitchens` VALUES (4, 'Австрийская');
INSERT INTO `kitchens` VALUES (5, 'Азербайджанская');
INSERT INTO `kitchens` VALUES (6, 'Американская');
INSERT INTO `kitchens` VALUES (7, 'Английская');
INSERT INTO `kitchens` VALUES (8, 'Арабская');
INSERT INTO `kitchens` VALUES (9, 'Аргентинская');
INSERT INTO `kitchens` VALUES (10, 'Армянская');
INSERT INTO `kitchens` VALUES (11, 'Африканская');
INSERT INTO `kitchens` VALUES (12, 'Белорусская');
INSERT INTO `kitchens` VALUES (13, 'Бельгийская');
INSERT INTO `kitchens` VALUES (14, 'Болгарская');
INSERT INTO `kitchens` VALUES (15, 'Бразильская');
INSERT INTO `kitchens` VALUES (16, 'Бурятская');
INSERT INTO `kitchens` VALUES (17, 'Валлийская');
INSERT INTO `kitchens` VALUES (18, 'Венгерская');
INSERT INTO `kitchens` VALUES (19, 'Вьетнамская');
INSERT INTO `kitchens` VALUES (20, 'Гавайская');
INSERT INTO `kitchens` VALUES (21, 'Голландская');
INSERT INTO `kitchens` VALUES (22, 'Греческая');
INSERT INTO `kitchens` VALUES (23, 'Грузинская');
INSERT INTO `kitchens` VALUES (24, 'Датская');
INSERT INTO `kitchens` VALUES (25, 'Еврейская');
INSERT INTO `kitchens` VALUES (26, 'Египетская');
INSERT INTO `kitchens` VALUES (27, 'Индийская');
INSERT INTO `kitchens` VALUES (28, 'Иракская');
INSERT INTO `kitchens` VALUES (29, 'Ирландская');
INSERT INTO `kitchens` VALUES (30, 'Испанская');
INSERT INTO `kitchens` VALUES (31, 'Итальянская');
INSERT INTO `kitchens` VALUES (32, 'Кавказская');
INSERT INTO `kitchens` VALUES (33, 'Казахская');
INSERT INTO `kitchens` VALUES (34, 'Калмыцкая');
INSERT INTO `kitchens` VALUES (35, 'Китайская');
INSERT INTO `kitchens` VALUES (36, 'Коми');
INSERT INTO `kitchens` VALUES (37, 'Корейская');
INSERT INTO `kitchens` VALUES (38, 'Кубинская');
INSERT INTO `kitchens` VALUES (39, 'Кухня Магриба');
INSERT INTO `kitchens` VALUES (40, 'Латышская');
INSERT INTO `kitchens` VALUES (41, 'Литовская');
INSERT INTO `kitchens` VALUES (42, 'Малайзийская');
INSERT INTO `kitchens` VALUES (43, 'Марокканская');
INSERT INTO `kitchens` VALUES (44, 'Мексиканская');
INSERT INTO `kitchens` VALUES (45, 'Молдавская');
INSERT INTO `kitchens` VALUES (46, 'Монгольская');
INSERT INTO `kitchens` VALUES (47, 'Немецкая');
INSERT INTO `kitchens` VALUES (48, 'Норвежская');
INSERT INTO `kitchens` VALUES (49, 'Польская');
INSERT INTO `kitchens` VALUES (50, 'Португальская');
INSERT INTO `kitchens` VALUES (51, 'Румынская');
INSERT INTO `kitchens` VALUES (52, 'Русская');
INSERT INTO `kitchens` VALUES (53, 'Сирийская');
INSERT INTO `kitchens` VALUES (54, 'Тайская');
INSERT INTO `kitchens` VALUES (55, 'Тунисская');
INSERT INTO `kitchens` VALUES (56, 'Турецкая');
INSERT INTO `kitchens` VALUES (57, 'Узбекская');
INSERT INTO `kitchens` VALUES (58, 'Украинская');
INSERT INTO `kitchens` VALUES (59, 'Уральская');
INSERT INTO `kitchens` VALUES (60, 'Финская');
INSERT INTO `kitchens` VALUES (61, 'Французская');
INSERT INTO `kitchens` VALUES (62, 'Чешская');
INSERT INTO `kitchens` VALUES (63, 'Шведская');
INSERT INTO `kitchens` VALUES (64, 'Швейцарская');
INSERT INTO `kitchens` VALUES (65, 'Шотландская');
INSERT INTO `kitchens` VALUES (66, 'Эстонская');
INSERT INTO `kitchens` VALUES (67, 'Югославская');
INSERT INTO `kitchens` VALUES (68, 'Японская');



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
-- Дамп данных таблицы `word_censor`
-- 

INSERT INTO `word_censor` VALUES (1, 'хуй');
INSERT INTO `word_censor` VALUES (2, 'сука');
INSERT INTO `word_censor` VALUES (3, 'хуев');
INSERT INTO `word_censor` VALUES (4, 'блядь');
INSERT INTO `word_censor` VALUES (5, 'блять');
INSERT INTO `word_censor` VALUES (7, 'дерьмо');
INSERT INTO `word_censor` VALUES (8, 'гамно');
INSERT INTO `word_censor` VALUES (9, 'гавно');
INSERT INTO `word_censor` VALUES (10, 'fuck');
INSERT INTO `word_censor` VALUES (11, 'suck');