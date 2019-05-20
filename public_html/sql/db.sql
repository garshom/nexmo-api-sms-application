/*
SQLyog Enterprise - MySQL GUI v7.02 
MySQL - 5.7.13-log : Database - multi-admin
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`multi-admin` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `multi-admin`;

/*Table structure for table `credit_additions` */

DROP TABLE IF EXISTS `credit_additions`;

CREATE TABLE `credit_additions` (
  `user_id` int(5) NOT NULL,
  `credits_added` int(10) NOT NULL,
  `DateTime` datetime NOT NULL,
  `bywho` int(5) NOT NULL,
  PRIMARY KEY (`user_id`,`credits_added`,`DateTime`,`bywho`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `credit_additions` */

/*Table structure for table `credits` */

DROP TABLE IF EXISTS `credits`;

CREATE TABLE `credits` (
  `user_id` int(5) NOT NULL,
  `credits` int(10) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `credits` */

insert  into `credits`(`user_id`,`credits`) values (1,499);

/*Table structure for table `message_info` */

DROP TABLE IF EXISTS `message_info`;

CREATE TABLE `message_info` (
  `DateTime` datetime NOT NULL,
  `sender_id` varchar(16) NOT NULL,
  `recepient_id` varchar(16) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `message_sent` varchar(160) NOT NULL,
  `credit_balance_before` int(10) NOT NULL,
  `credit_balance_after` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `message_info` */

insert  into `message_info`(`DateTime`,`sender_id`,`recepient_id`,`user_id`,`message_sent`,`credit_balance_before`,`credit_balance_after`) values ('2017-04-16 00:41:59','00444787151854','00256783313038','1','Send Mr Opio Joseph 3,000,000 on this number, please dont forget as am currently in the meeting , Thanks',500,499);

/*Table structure for table `module` */

DROP TABLE IF EXISTS `module`;

CREATE TABLE `module` (
  `mod_modulegroupcode` varchar(25) NOT NULL,
  `mod_modulegroupname` varchar(50) NOT NULL,
  `mod_modulecode` varchar(25) NOT NULL,
  `mod_modulename` varchar(50) NOT NULL,
  `mod_modulegrouporder` int(3) NOT NULL,
  `mod_moduleorder` int(3) NOT NULL,
  `mod_modulepagename` varchar(255) NOT NULL,
  PRIMARY KEY (`mod_modulegroupcode`,`mod_modulecode`),
  UNIQUE KEY `mod_modulecode` (`mod_modulecode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `module` */

insert  into `module`(`mod_modulegroupcode`,`mod_modulegroupname`,`mod_modulecode`,`mod_modulename`,`mod_modulegrouporder`,`mod_moduleorder`,`mod_modulepagename`) values ('CHECKOUT','Checkout','PAYMENT','Payment',3,2,'users.php'),('CHECKOUT','Checkout','SHIPPING','Shipping',3,1,'shipping.php'),('CHECKOUT','Checkout','TAX','Tax',3,3,'tax.php'),('INVT','Inventory','PURCHASES','Purchases',2,1,'purchases.php'),('INVT','Inventory','SALES','Sales',2,3,'sales.php'),('INVT','Inventory','STOCKS','Stocks',2,2,'stocks.php');

/*Table structure for table `role` */

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `role_rolecode` varchar(50) NOT NULL,
  `role_rolename` varchar(50) NOT NULL,
  PRIMARY KEY (`role_rolecode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `role` */

insert  into `role`(`role_rolecode`,`role_rolename`) values ('ADMIN','Administrator'),('SUPERADMIN','Super Admin');

/*Table structure for table `role_rights` */

DROP TABLE IF EXISTS `role_rights`;

CREATE TABLE `role_rights` (
  `rr_rolecode` varchar(50) NOT NULL,
  `rr_modulecode` varchar(25) NOT NULL,
  `rr_create` enum('yes','no') NOT NULL DEFAULT 'no',
  `rr_edit` enum('yes','no') NOT NULL DEFAULT 'no',
  `rr_delete` enum('yes','no') NOT NULL DEFAULT 'no',
  `rr_view` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`rr_rolecode`,`rr_modulecode`),
  KEY `rr_modulecode` (`rr_modulecode`),
  CONSTRAINT `role_rights_ibfk_1` FOREIGN KEY (`rr_rolecode`) REFERENCES `role` (`role_rolecode`) ON UPDATE CASCADE,
  CONSTRAINT `role_rights_ibfk_2` FOREIGN KEY (`rr_modulecode`) REFERENCES `module` (`mod_modulecode`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `role_rights` */

insert  into `role_rights`(`rr_rolecode`,`rr_modulecode`,`rr_create`,`rr_edit`,`rr_delete`,`rr_view`) values ('ADMIN','PAYMENT','no','no','no','yes'),('ADMIN','PURCHASES','yes','yes','yes','yes'),('ADMIN','SALES','no','no','no','no'),('ADMIN','SHIPPING','yes','yes','yes','yes'),('ADMIN','STOCKS','no','no','no','yes'),('ADMIN','TAX','no','no','no','no'),('SUPERADMIN','PAYMENT','yes','yes','yes','yes'),('SUPERADMIN','PURCHASES','yes','yes','yes','yes'),('SUPERADMIN','SALES','yes','yes','yes','yes'),('SUPERADMIN','SHIPPING','yes','yes','yes','yes'),('SUPERADMIN','STOCKS','yes','yes','yes','yes'),('SUPERADMIN','TAX','yes','yes','yes','yes');

/*Table structure for table `system_users` */

DROP TABLE IF EXISTS `system_users`;

CREATE TABLE `system_users` (
  `u_userid` int(11) NOT NULL AUTO_INCREMENT,
  `u_username` varchar(100) NOT NULL,
  `u_password` varchar(255) NOT NULL,
  `u_rolecode` varchar(50) NOT NULL,
  PRIMARY KEY (`u_userid`),
  KEY `u_rolecode` (`u_rolecode`),
  CONSTRAINT `system_users_ibfk_1` FOREIGN KEY (`u_rolecode`) REFERENCES `role` (`role_rolecode`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `system_users` */

insert  into `system_users`(`u_userid`,`u_username`,`u_password`,`u_rolecode`) values (1,'kamau@lexusinc.com','3b8d849118850e1cd2b72cfa3f58a6c2','SUPERADMIN');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
