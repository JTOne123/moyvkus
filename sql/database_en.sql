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
INSERT INTO `menu` VALUES (6, 'Search', '~/search', '', 'Search', 6);
INSERT INTO `menu` VALUES (8, 'My Friends', '~/myfriends', '', 'My Friends', 1);
INSERT INTO `menu` VALUES (9, 'Recipes', '~/recipes', '', 'Recipes', 5);
INSERT INTO `menu` VALUES (4, 'My Messages', '~/mymessages', '', 'My Messages', 2);
INSERT INTO `menu` VALUES (10, 'My News', '~/mynews', '', 'My News', 4);
INSERT INTO `menu` VALUES (3, 'Home', '~/profile', '', 'Home', 0);
INSERT INTO `menu` VALUES (11, 'Invate a friend', '~/invite', '', 'Invate a friend', 7);

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
        