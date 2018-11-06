/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : hsyii

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-11-06 23:19:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for trade_order
-- ----------------------------
DROP TABLE IF EXISTS `trade_order`;
CREATE TABLE `trade_order` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `order_title` varchar(30) DEFAULT NULL,
  `order_num` char(10) NOT NULL,
  `order_time` date DEFAULT NULL,
  `customer_name` varchar(10) DEFAULT NULL,
  `receiver` varchar(10) DEFAULT NULL,
  `auditor` varchar(10) DEFAULT NULL,
  `remarks` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_num` (`order_num`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of trade_order
-- ----------------------------
INSERT INTO `trade_order` VALUES ('1', '华师十一月食品采购', '1811036498', '2018-11-01', '五山果行', '林俊贤', '刘镇源', '');
INSERT INTO `trade_order` VALUES ('2', '南山八月水果采购', '1811038021', '2018-08-09', '沃尔玛', '林俊贤', '钟柱明', '买苹果10');
