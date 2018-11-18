/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : hsyii

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-11-18 20:59:09
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
  `order_type` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_num` (`order_num`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of trade_order
-- ----------------------------
INSERT INTO `trade_order` VALUES ('1', '华师十一月食品采购', '1811036498', '2018-11-01', '五山果行', '林俊贤', '复读机', '', '0');
INSERT INTO `trade_order` VALUES ('2', '南山八月水果采购', '1811038021', '2018-08-09', '沃尔玛', '林俊贤', '真香', '买苹果10', '0');
INSERT INTO `trade_order` VALUES ('3', '华师十月教材采购', '1811108946', '2018-10-03', '广图', '林俊贤', '鸽子', '', '0');
INSERT INTO `trade_order` VALUES ('4', '南山八月水果采购', '1811120972', '2018-11-02', '', '林俊贤', '钟柱明', '复读机', '0');
INSERT INTO `trade_order` VALUES ('5', '南山八月水果采购', '1811120998', '2018-08-09', '街總頤康中心', '林俊贤', '刘镇源', '', '0');
INSERT INTO `trade_order` VALUES ('6', '华师十一月食品采购', '1811163137', '2018-11-01', '街總學生輔導中心', '林俊贤', '刘镇源', '', '0');
INSERT INTO `trade_order` VALUES ('7', '华农三月份食品采购', '1811173591', '2018-02-12', '沃尔玛', '罗剑钏', '钟柱明', '', '0');
INSERT INTO `trade_order` VALUES ('8', '华工三月水果采购', '1811173634', '2017-02-12', '宜家', '殷嘉维', '罗剑钏', '', '0');
INSERT INTO `trade_order` VALUES ('10', '华师十一月食品采购', '1811182309', '2018-11-02', '百佳', '罗剑钏', '殷嘉维', '', '0');
INSERT INTO `trade_order` VALUES ('12', '广州九月产品销售', '1811182283', '2018-10-10', '华润万家', '殷嘉维', '罗剑钏', '', '1');
INSERT INTO `trade_order` VALUES ('13', '深圳九月产品销售', '1811180174', '2018-10-06', '百佳', '刘镇源', '殷嘉维', '', '1');
INSERT INTO `trade_order` VALUES ('14', '深圳八月产品销售', '1811187638', '2018-09-06', '全家', '钟柱明', '林俊贤', '', '1');
