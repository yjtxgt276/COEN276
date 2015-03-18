/*sql file for coen276*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `friend`
-- ----------------------------
DROP TABLE IF EXISTS `friend`;
CREATE TABLE `friend` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `f_name` varchar(32) NOT NULL,
  `zt` tinyint(1) NOT NULL DEFAULT '0',
  `fzt` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of friend
-- ----------------------------


-- ----------------------------
-- Table structure for `message`
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sender` varchar(32) NOT NULL,
  `recver` varchar(32) NOT NULL,
  `content` text NOT NULL,
  `stime` datetime NOT NULL,
  `mloop` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of message
-- ----------------------------

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `reg_time` datetime NOT NULL,
  `online` tinyint(1) not null DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------

