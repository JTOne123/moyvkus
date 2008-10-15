-- phpMyAdmin SQL Dump
-- version 2.6.1
-- http://www.phpmyadmin.net
-- 
-- Хост: localhost
-- Время создания: Окт 15 2008 г., 22:22
-- Версия сервера: 5.0.45
-- Версия PHP: 5.2.4
-- 
-- БД: `moyvkusen`
-- 

-- --------------------------------------------------------

-- 
-- Структура таблицы `captcha`
-- 

DROP TABLE IF EXISTS `captcha`;
CREATE TABLE IF NOT EXISTS `captcha` (
  `captcha_id` bigint(13) unsigned NOT NULL auto_increment,
  `captcha_time` int(10) unsigned NOT NULL,
  `ip_address` varchar(16) NOT NULL default '0',
  `word` varchar(20) NOT NULL,
  PRIMARY KEY  (`captcha_id`),
  KEY `word` (`word`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=2 ;

-- 
-- Дамп данных таблицы `captcha`
-- 

INSERT INTO `captcha` VALUES (1, 1224063240, '127.0.0.1', 'BMCA');

-- --------------------------------------------------------

-- 
-- Структура таблицы `categorys`
-- 

DROP TABLE IF EXISTS `categorys`;
CREATE TABLE IF NOT EXISTS `categorys` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(400) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=23 ;

-- 
-- Дамп данных таблицы `categorys`
-- 

INSERT INTO `categorys` VALUES (2, 'Snacks');
INSERT INTO `categorys` VALUES (3, 'Salads');
INSERT INTO `categorys` VALUES (4, 'Hot snacks');
INSERT INTO `categorys` VALUES (5, 'Soups');
INSERT INTO `categorys` VALUES (6, 'Basics');
INSERT INTO `categorys` VALUES (7, 'Garnishes');
INSERT INTO `categorys` VALUES (8, 'Desserts');
INSERT INTO `categorys` VALUES (9, 'Baked Goods');
INSERT INTO `categorys` VALUES (10, 'Sauces');
INSERT INTO `categorys` VALUES (11, 'Vegetarian');
INSERT INTO `categorys` VALUES (12, 'Diet Nutrition');
INSERT INTO `categorys` VALUES (13, 'Recipes for Pets');
INSERT INTO `categorys` VALUES (14, 'Beauty Recipes');
INSERT INTO `categorys` VALUES (15, 'Seafood');
INSERT INTO `categorys` VALUES (16, 'For nursing mothers');
INSERT INTO `categorys` VALUES (17, 'For <font color="red">K</font><font color="green">i</font><font color="blue">d</font><font color="orange">s</font>');
INSERT INTO `categorys` VALUES (18, 'For microwave ovens');
INSERT INTO `categorys` VALUES (19, 'Seafood');
INSERT INTO `categorys` VALUES (20, 'Drinks and Cocktails');
INSERT INTO `categorys` VALUES (21, 'Breakfast Recipes');
INSERT INTO `categorys` VALUES (22, 'Other''s');

-- --------------------------------------------------------

-- 
-- Структура таблицы `ci_sessions`
-- 

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL default '0',
  `ip_address` varchar(16) NOT NULL default '0',
  `user_agent` varchar(50) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- 
-- Дамп данных таблицы `ci_sessions`
-- 

INSERT INTO `ci_sessions` VALUES ('12908c876870e4cd363d4e4d04822a5c', '127.0.0.1', 'Mozilla/5.0 (Windows; U; Windows NT 6.0; ru; rv:1.', 1224063240);
INSERT INTO `ci_sessions` VALUES ('4e17611d5129cfb7ebd3467940e6d7d8', '127.0.0.1', 'Mozilla/5.0 (Windows; U; Windows NT 6.0; ru; rv:1.', 1224065194);

-- --------------------------------------------------------

-- 
-- Структура таблицы `comments`
-- 

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL auto_increment,
  `text` varchar(1500) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `comments`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `favorites`
-- 

DROP TABLE IF EXISTS `favorites`;
CREATE TABLE IF NOT EXISTS `favorites` (
  `id` int(11) NOT NULL auto_increment,
  `recipe_id` int(11) NOT NULL,
  `who_add_user_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `favorites`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `forget_password`
-- 

DROP TABLE IF EXISTS `forget_password`;
CREATE TABLE IF NOT EXISTS `forget_password` (
  `user_id` int(11) default NULL,
  `user_code` varchar(20) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- 
-- Дамп данных таблицы `forget_password`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `invite`
-- 

DROP TABLE IF EXISTS `invite`;
CREATE TABLE IF NOT EXISTS `invite` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) default NULL,
  `friend_email` varchar(100) default NULL,
  `friend_first_name` varchar(100) default NULL,
  `friend_last_name` varchar(100) default NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `invite`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `kitchens`
-- 

DROP TABLE IF EXISTS `kitchens`;
CREATE TABLE IF NOT EXISTS `kitchens` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(70) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=61 ;

-- 
-- Дамп данных таблицы `kitchens`
-- 

INSERT INTO `kitchens` VALUES (1, 'Home');
INSERT INTO `kitchens` VALUES (2, 'Abkhaz');
INSERT INTO `kitchens` VALUES (3, 'The Australian');
INSERT INTO `kitchens` VALUES (4, 'Austrian');
INSERT INTO `kitchens` VALUES (5, 'Azerbaijan');
INSERT INTO `kitchens` VALUES (6, 'American');
INSERT INTO `kitchens` VALUES (7, 'English');
INSERT INTO `kitchens` VALUES (8, 'Arab');
INSERT INTO `kitchens` VALUES (9, 'Argentina');
INSERT INTO `kitchens` VALUES (10, 'Armenian');
INSERT INTO `kitchens` VALUES (11, 'Africa');
INSERT INTO `kitchens` VALUES (12, 'Belarusian');
INSERT INTO `kitchens` VALUES (13, 'Belgian');
INSERT INTO `kitchens` VALUES (14, 'Bulgarian');
INSERT INTO `kitchens` VALUES (15, 'Brazilian');
INSERT INTO `kitchens` VALUES (17, 'Welsh');
INSERT INTO `kitchens` VALUES (18, 'Hungarian');
INSERT INTO `kitchens` VALUES (19, 'Vietnam');
INSERT INTO `kitchens` VALUES (20, 'Hawaiian');
INSERT INTO `kitchens` VALUES (21, 'Dutch');
INSERT INTO `kitchens` VALUES (22, 'Greek');
INSERT INTO `kitchens` VALUES (23, 'Georgia');
INSERT INTO `kitchens` VALUES (24, 'Denmark');
INSERT INTO `kitchens` VALUES (25, 'Jewish');
INSERT INTO `kitchens` VALUES (26, 'Egypt');
INSERT INTO `kitchens` VALUES (28, 'Iraq');
INSERT INTO `kitchens` VALUES (29, 'Ireland');
INSERT INTO `kitchens` VALUES (30, 'Spanish');
INSERT INTO `kitchens` VALUES (31, 'Italian');
INSERT INTO `kitchens` VALUES (32, 'Caucasus');
INSERT INTO `kitchens` VALUES (33, 'Kazakh');
INSERT INTO `kitchens` VALUES (34, 'Kalmyk');
INSERT INTO `kitchens` VALUES (35, 'Chinese');
INSERT INTO `kitchens` VALUES (37, 'Korea');
INSERT INTO `kitchens` VALUES (38, 'Cuba');
INSERT INTO `kitchens` VALUES (39, 'Cooking Maghreb');
INSERT INTO `kitchens` VALUES (40, 'Latvian');
INSERT INTO `kitchens` VALUES (41, 'Lithuanian');
INSERT INTO `kitchens` VALUES (47, 'German');
INSERT INTO `kitchens` VALUES (48, 'Norwegian');
INSERT INTO `kitchens` VALUES (49, 'Polish');
INSERT INTO `kitchens` VALUES (50, 'Portuguese');
INSERT INTO `kitchens` VALUES (51, 'Romanian');
INSERT INTO `kitchens` VALUES (52, 'Russian');
INSERT INTO `kitchens` VALUES (53, 'Syrian');
INSERT INTO `kitchens` VALUES (54, 'Thai');
INSERT INTO `kitchens` VALUES (55, 'The Tunisian');
INSERT INTO `kitchens` VALUES (56, 'Turkish');
INSERT INTO `kitchens` VALUES (57, 'Uzbekistan');
INSERT INTO `kitchens` VALUES (58, 'Ukrainian');
INSERT INTO `kitchens` VALUES (59, 'Ural');
INSERT INTO `kitchens` VALUES (60, 'Finnish');

-- --------------------------------------------------------

-- 
-- Структура таблицы `menu`
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
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=12 ;

-- 
-- Дамп данных таблицы `menu`
-- 

INSERT INTO `menu` VALUES (5, 'My Recipes', '~/my_recipes', '', 'My Recipes', 3);
INSERT INTO `menu` VALUES (6, 'Search', '~/search', '', 'Search', 5);
INSERT INTO `menu` VALUES (8, 'My Friends', '~/myfriends', '', 'My Friends', 1);
INSERT INTO `menu` VALUES (9, 'Recipes', '~/recipes', '', 'Recipes', 4);
INSERT INTO `menu` VALUES (4, 'My Messages', '~/mymessages', '', 'My Messages', 2);
INSERT INTO `menu` VALUES (3, 'Home', '~/profile', '', 'Home', 0);
INSERT INTO `menu` VALUES (11, 'Invate a friend', '~/invite', '', 'Invate a friend', 6);

-- --------------------------------------------------------

-- 
-- Структура таблицы `message`
-- 

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `from_id` int(11) default NULL,
  `to_id` int(11) default NULL,
  `subject` varchar(100) default NULL,
  `text` text,
  `id` int(11) NOT NULL auto_increment,
  `date` datetime default NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `message`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `message_spam_filter`
-- 

DROP TABLE IF EXISTS `message_spam_filter`;
CREATE TABLE IF NOT EXISTS `message_spam_filter` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) default NULL,
  `message_count` int(11) default NULL,
  `date` datetime default NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `message_spam_filter`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `myfriends`
-- 

DROP TABLE IF EXISTS `myfriends`;
CREATE TABLE IF NOT EXISTS `myfriends` (
  `user_id` int(11) default NULL,
  `friend_id` int(11) default NULL,
  `is_confirmed` tinyint(1) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- 
-- Дамп данных таблицы `myfriends`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `rating_act_desk`
-- 

DROP TABLE IF EXISTS `rating_act_desk`;
CREATE TABLE IF NOT EXISTS `rating_act_desk` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `rating_act_desk`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `recipes`
-- 

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
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `user_id` int(10) NOT NULL,
  `rating` int(10) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `recipes`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `user_data`
-- 

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=2 ;

-- 
-- Дамп данных таблицы `user_data`
-- 

INSERT INTO `user_data` VALUES (1, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

-- 
-- Структура таблицы `users`
-- 

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL auto_increment,
  `first_name` varchar(100) default NULL,
  `last_name` varchar(100) default NULL,
  `email` varchar(100) default NULL,
  `password` varchar(100) default NULL,
  `birthday` date default NULL,
  `sex` tinyint(1) default NULL,
  `city` int(11) default NULL,
  `region` int(11) default NULL,
  `country` int(11) default NULL,
  UNIQUE KEY `UserID` (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=2 ;

-- 
-- Дамп данных таблицы `users`
-- 

INSERT INTO `users` VALUES (1, 'Alex', 'Verbovsky', 'alex.sanchos@gmail.com', 'b25dc89c98cb5d7f1b57088224d99624', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

-- 
-- Структура таблицы `word_censor`
-- 

DROP TABLE IF EXISTS `word_censor`;
CREATE TABLE IF NOT EXISTS `word_censor` (
  `id` int(11) NOT NULL auto_increment,
  `word` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=2 ;

-- 
-- Дамп данных таблицы `word_censor`
-- 

INSERT INTO `word_censor` VALUES (1, 'fuck');
        