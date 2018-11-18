/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : hsyii

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-11-18 20:59:28
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for supplier_list
-- ----------------------------
DROP TABLE IF EXISTS `supplier_list`;
CREATE TABLE `supplier_list` (
  `s_id` int(10) NOT NULL AUTO_INCREMENT,
  `s_name` char(30) DEFAULT NULL,
  `s_type` int(4) unsigned DEFAULT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of supplier_list
-- ----------------------------
INSERT INTO `supplier_list` VALUES ('1', '沃尔玛', '100');
INSERT INTO `supplier_list` VALUES ('2', '五山果行', '101');
INSERT INTO `supplier_list` VALUES ('3', '金茂源', '101');
INSERT INTO `supplier_list` VALUES ('4', '金麦超市', '101');
INSERT INTO `supplier_list` VALUES ('5', '宜家', '100');
INSERT INTO `supplier_list` VALUES ('6', 'Sam', '100');
INSERT INTO `supplier_list` VALUES ('7', '华润万家', '100');
INSERT INTO `supplier_list` VALUES ('8', 'SevenEleven', '101');
INSERT INTO `supplier_list` VALUES ('9', '全家', '101');
INSERT INTO `supplier_list` VALUES ('10', '百里臣', '101');
INSERT INTO `supplier_list` VALUES ('11', '百佳', '100');
INSERT INTO `supplier_list` VALUES ('12', '刘镇源', '200');
INSERT INTO `supplier_list` VALUES ('13', '林俊贤', '200');
INSERT INTO `supplier_list` VALUES ('16', '罗剑钏', '200');
INSERT INTO `supplier_list` VALUES ('18', '林俊贤', '201');
INSERT INTO `supplier_list` VALUES ('19', '罗剑钏', '201');
INSERT INTO `supplier_list` VALUES ('20', '殷嘉维', '201');
INSERT INTO `supplier_list` VALUES ('21', '钟柱明', '201');
