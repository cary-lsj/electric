/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : power

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-04-15 18:24:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'admin', 'admin');

-- ----------------------------
-- Table structure for electricity
-- ----------------------------
DROP TABLE IF EXISTS `electricity`;
CREATE TABLE `electricity` (
  `int` int(11) NOT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`int`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of electricity
-- ----------------------------
INSERT INTO `electricity` VALUES ('1', '0.52', '220V');

-- ----------------------------
-- Table structure for feedback
-- ----------------------------
DROP TABLE IF EXISTS `feedback`;
CREATE TABLE `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `content` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of feedback
-- ----------------------------

-- ----------------------------
-- Table structure for notice
-- ----------------------------
DROP TABLE IF EXISTS `notice`;
CREATE TABLE `notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `content` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of notice
-- ----------------------------

-- ----------------------------
-- Table structure for recharge
-- ----------------------------
DROP TABLE IF EXISTS `recharge`;
CREATE TABLE `recharge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `source` varchar(255) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `money` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of recharge
-- ----------------------------

-- ----------------------------
-- Table structure for shoptype
-- ----------------------------
DROP TABLE IF EXISTS `shoptype`;
CREATE TABLE `shoptype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=263 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shoptype
-- ----------------------------

-- ----------------------------
-- Table structure for shopzone
-- ----------------------------
DROP TABLE IF EXISTS `shopzone`;
CREATE TABLE `shopzone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `typeid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shopzone
-- ----------------------------

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL COMMENT '学号',
  `password` varchar(255) DEFAULT NULL COMMENT '密码',
  `name` varchar(255) DEFAULT NULL COMMENT '姓名',
  `gender` int(11) DEFAULT NULL COMMENT '性别',
  `card` varchar(255) DEFAULT '' COMMENT '身份证号',
  `information` varchar(255) DEFAULT '' COMMENT '联系方式',
  `typeid` int(11) DEFAULT NULL,
  `zoneid` int(11) DEFAULT NULL,
  `shopname` varchar(255) DEFAULT NULL,
  `balance` decimal(11,2) DEFAULT '0.00',
  `used` decimal(11,2) DEFAULT '0.00',
  `recharge` decimal(11,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
