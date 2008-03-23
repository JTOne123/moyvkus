/*Table structure for table `users` */

CREATE TABLE `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  UNIQUE KEY `UserID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/* Procedure structure for procedure `AddUser` */

/*!50003 DROP PROCEDURE IF EXISTS  `AddUser` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `AddUser`(
_email VARCHAR(100),
_password VARCHAR(100),
_first_name VARCHAR(100),
_last_name VARCHAR(100),
_birthday date
)
BEGIN
insert into `moyvkus_db`.`users` (`email`, `password`, `first_name`, `last_name`, `birthday`) 	values (_email, _password, _first_name, _last_name, _birthday);
END */$$
DELIMITER ;

/* Procedure structure for procedure `GetUser` */

/*!50003 DROP PROCEDURE IF EXISTS  `GetUser` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `GetUser`(
_ID INT
)
BEGIN
SELECT `FirstName`,`LastName`,`Email`,`Password` FROM `moyvkus_db`.`users` WHERE `ID`=_ID;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `IsUserExits` */

/*!50003 DROP PROCEDURE IF EXISTS  `IsUserExits` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `IsUserExits`(
_email VARCHAR(100)
)
BEGIN
	SELECT COUNT(*) as c FROM `moyvkus_db`.`users` WHERE `email` = _email;
    END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;