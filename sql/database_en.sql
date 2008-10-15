DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `ID` int(11) NOT NULL auto_increment,
  `text` varchar(50) default NULL,
  `url` varchar(200) default NULL,
  `img_url` varchar(200) default NULL,
  `tooltip` varchar(200) default NULL,
  `sort` int(11) NOT NULL,
  UNIQUE KEY `id` (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `menu`
-- 


insert  into `menu`(`ID`,`text`,`url`,`img_url`,`tooltip`,`sort`) values (5,'My Recipes','~/my_recipes','','My Recipes',3);
insert  into `menu`(`ID`,`text`,`url`,`img_url`,`tooltip`,`sort`) values (6,'Search','~/search','','Search',5);
insert  into `menu`(`ID`,`text`,`url`,`img_url`,`tooltip`,`sort`) values (8,'My Friends','~/myfriends','','My Friends',1);
insert  into `menu`(`ID`,`text`,`url`,`img_url`,`tooltip`,`sort`) values (9,'Recipes','~/recipes','','Recipes',4);
insert  into `menu`(`ID`,`text`,`url`,`img_url`,`tooltip`,`sort`) values (4,'My Messages','~/mymessages','','My Messages',2);
insert  into `menu`(`ID`,`text`,`url`,`img_url`,`tooltip`,`sort`) values (3,'Home','~/profile','','Home',0);
insert  into `menu`(`ID`,`text`,`url`,`img_url`,`tooltip`,`sort`) values (11,'Invate a friend','~/invite','','Invate a friend',6);


CREATE TABLE IF NOT EXISTS `kitchens` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(70) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

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
INSERT INTO `kitchens` VALUES (27 'Indian');
INSERT INTO `kitchens` VALUES (28, 'Iraq');
INSERT INTO `kitchens` VALUES (29, 'Ireland');
INSERT INTO `kitchens` VALUES (30, 'Spanish');
INSERT INTO `kitchens` VALUES (31, 'Italian');
INSERT INTO `kitchens` VALUES (32, 'Caucasus');
INSERT INTO `kitchens` VALUES (33, 'Kazakh');
INSERT INTO `kitchens` VALUES (34, 'Kalmyk');
INSERT INTO `kitchens` VALUES (35, 'Chinese');
INSERT INTO `kitchens` VALUES (36, 'the Committee');
INSERT INTO `kitchens` VALUES (37, 'Korea');
INSERT INTO `kitchens` VALUES (38, 'Cuba');
INSERT INTO `kitchens` VALUES (39, 'Cooking Maghreb');
INSERT INTO `kitchens` VALUES (40, 'Latvian');
INSERT INTO `kitchens` VALUES (41, 'Lithuanian');
INSERT INTO `kitchens` VALUES (42 'His');
INSERT INTO `kitchens` VALUES (43, 'Moroccan');
INSERT INTO `kitchens` VALUES (44, 'The Mexican');
INSERT INTO `kitchens` VALUES (45, 'Moldova');
INSERT INTO `kitchens` VALUES (46 'Mongol');
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
INSERT INTO `kitchens` VALUES (61, 'French');
INSERT INTO `kitchens` VALUES (62, 'Czech');
INSERT INTO `kitchens` VALUES (63, 'Swedish');
INSERT INTO `kitchens` VALUES (64, 'Swiss');
INSERT INTO `kitchens` VALUES (65, 'Scottish');
INSERT INTO `kitchens` VALUES (66, 'Estonia');
INSERT INTO `kitchens` VALUES (67, 'Yugoslav');
INSERT INTO `kitchens` VALUES (68, 'Japan');