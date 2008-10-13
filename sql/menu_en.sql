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
