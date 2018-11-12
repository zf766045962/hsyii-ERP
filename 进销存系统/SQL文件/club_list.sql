/*
Navicat MySQL Data Transfer

Source Server         : ls
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : hsyii

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2018-09-22 16:54:12
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `club_list`
-- ----------------------------
DROP TABLE IF EXISTS `club_list`;
CREATE TABLE `club_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `club_code` char(16) DEFAULT '' COMMENT '社区编码，采用树结构方式表示 年份+6位数序号   如2016000001',
  `club_name` varchar(30) DEFAULT '' COMMENT '社区单位名称',
  `club_logo_pic` varchar(100) DEFAULT '' COMMENT '社区缩略图',
  `apply_club_phone` char(11) DEFAULT '' COMMENT '申请法人联系电话',
  `apply_club_email` varchar(40) DEFAULT '' COMMENT '申请法人电子邮箱',
  `apply_name` varchar(30) DEFAULT '' COMMENT '联系人姓名',
  `contact_phone` char(11) DEFAULT '' COMMENT '联系人电话',
  `email` varchar(40) DEFAULT '' COMMENT '联系人电子邮箱',
  `club_area_country` char(20) DEFAULT '' COMMENT '社区单位地区：国（代码）',
  `club_area_province` char(20) DEFAULT '0' COMMENT '社区单位地区：省（代码）',
  `club_area_district` char(10) DEFAULT '' COMMENT '所在区域区县',
  `club_area_city` char(6) DEFAULT '0' COMMENT '社区单位地区：市（代码）',
  `club_area_street` char(16) DEFAULT '' COMMENT '所在区域街道',
  `club_address` varchar(60) DEFAULT '' COMMENT '详细地址',
  `latitude` varchar(20) DEFAULT '' COMMENT '纬度',
  `Longitude` varchar(20) DEFAULT '' COMMENT '经度',
  `apply_time` datetime DEFAULT NULL COMMENT '创办时间',
  `uDate` datetime DEFAULT NULL COMMENT '更新时间',
  `about_me` mediumtext COMMENT '关于我们URL，存放路径及命名查base_path表',
  `state` int(4) DEFAULT '371' COMMENT '状态,关联base_code表STATE类型状态id：371-374',
  `state_name` varchar(30) DEFAULT NULL COMMENT '状态名称',
  `reasons_for_failure` varchar(255) DEFAULT NULL COMMENT '操作备注',
  `reasons_adminid` int(11) DEFAULT NULL COMMENT '操作员id,关联qmdd_administrators表ID',
  `reasons_adminname` varchar(30) DEFAULT NULL COMMENT '操作员名称',
  `if_del` int(4) DEFAULT '510' COMMENT '逻辑删除，base_code表DATA类型 509-逻辑删除 510正常',
  `news_clicked` int(11) DEFAULT '0' COMMENT '单位点击率',
  `book_club_num` int(11) DEFAULT '0' COMMENT '单位订阅数',
  `dispay_xh` int(4) DEFAULT '0' COMMENT '显示序号，序号越小则排前，未输入的按最新注册时间排序',
  PRIMARY KEY (`id`),
  KEY `club_name` (`club_name`) USING BTREE,
  KEY `CLUB_CODE` (`club_code`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COMMENT='单位表';

-- ----------------------------
-- Records of club_list
-- ----------------------------
INSERT INTO `club_list` VALUES ('1', ' 21312312312313', '濠江中學', '', '', '', '231', '1231', '312354645', '', '0', '', '0', '', '121231231', '', '', null, null, null, '371', '审核中', null, null, null, '510', '0', '0', '0');
INSERT INTO `club_list` VALUES ('3', '20170003', '母親會安老院', '', '', '', '23123', '213123', '12312', '', '0', '', '0', '', '', '', '', null, null, null, '371', '审核中', null, null, null, '510', '0', '0', '0');
INSERT INTO `club_list` VALUES ('4', '20170004', '扶康會', '', '', '', '242', '23', '234254544', '', '0', '', '0', '', '', '', '', null, null, null, '371', '审核中', null, null, null, '510', '0', '0', '0');
INSERT INTO `club_list` VALUES ('6', '20170006', '特殊奧運會', '', '', '', 'werew', 'we', 'werew', '', '0', '', '0', '', '', '', '', null, null, null, '371', '审核中', null, null, null, '510', '0', '0', '0');
INSERT INTO `club_list` VALUES ('8', '20170008', '街總學生輔導中心', '', '', '', '', '', '', '', '0', '', '0', '', '', '', '', null, null, null, '371', '审核中', null, null, null, '510', '0', '0', '0');
INSERT INTO `club_list` VALUES ('10', '20170010', '街總公民教育中心', '', '', '', '', '', '', '', '0', '', '0', '', '', '', '', null, null, null, '371', '审核中', null, null, null, '510', '0', '0', '0');
INSERT INTO `club_list` VALUES ('11', '20170011', '街總頤康中心', '', '', '', '', '', '', '', '0', '', '0', '', '', '', '', null, null, null, '371', '审核中', null, null, null, '510', '0', '0', '0');
INSERT INTO `club_list` VALUES ('12', '20170012', '澳門少年飛鷹會', '', '', '', '', '', '', '', '0', '', '0', '', '', '', '', null, null, null, '371', '审核中', null, null, null, '510', '0', '0', '0');
INSERT INTO `club_list` VALUES ('16', '20170016', '街坊總會青少年綜合服務中心', '', '', '', '', '', '', '', '0', '', '0', '', '', '', '', null, null, null, '371', '审核中', null, null, null, '510', '0', '0', '0');
INSERT INTO `club_list` VALUES ('18', '20170018', '青洲社區中心', '', '', '', '', '', '', '', '0', '', '0', '', '', '', '', null, null, null, '371', '审核中', null, null, null, '510', '0', '0', '0');
INSERT INTO `club_list` VALUES ('19', '20170019', '祐漢社區中心', '', '', '', '', '', '', '', '0', '', '0', '', '', '', '', null, null, null, '371', '审核中', null, null, null, '510', '0', '0', '0');
INSERT INTO `club_list` VALUES ('20', '20170020', '婦聯青年中心', '', '', '', '', '', '', '', '0', '', '0', '', '', '', '', null, null, null, '371', '审核中', null, null, null, '510', '0', '0', '0');
INSERT INTO `club_list` VALUES ('21', '20170021', '街坊總會平安通呼援服務中心', '', '', '', '', '', '', '', '0', '', '0', '', '', '', '', null, null, null, '371', '审核中', null, null, null, '510', '0', '0', '0');
INSERT INTO `club_list` VALUES ('22', '20170022', '街坊總會海傍老人中心', '', '', '', '', '', '', '', '0', '', '0', '', '', '', '', null, null, null, '371', '审核中', null, null, null, '510', '0', '0', '0');
INSERT INTO `club_list` VALUES ('23', '20170023', '街坊總會綠揚長者日間護理中心', '', '', '', '', '', '', '', '0', '', '0', '', '', '', '', null, null, null, '371', '审核中', null, null, null, '510', '0', '0', '0');
INSERT INTO `club_list` VALUES ('24', '20170024', '街總青頤長者綜合服務中心', '', '', '', '', '', '', '', '0', '', '0', '', '', '', '', null, null, null, '371', '审核中', null, null, null, '510', '0', '0', '0');
INSERT INTO `club_list` VALUES ('25', '20170025', '街總頤駿長者中心', '', '', '', '', '', '', '', '0', '', '0', '', '', '', '', null, null, null, '371', '审核中', null, null, null, '510', '0', '0', '0');
INSERT INTO `club_list` VALUES ('26', '20170026', '街總栢蕙活動中心', '', '', '', '', '', '', '', '0', '', '0', '', '', '', '', null, null, null, '371', '审核中', null, null, null, '510', '0', '0', '0');
INSERT INTO `club_list` VALUES ('27', '20170027', '樂駿中心', '', '', '', '', '', '', '', '0', '', '0', '', '', '', '', null, null, null, '371', '审核中', null, null, null, '510', '0', '0', '0');
INSERT INTO `club_list` VALUES ('28', '20170028', '澳門社區青年義工發展協會', '', '', '', '', '', '', '', '0', '', '0', '', '', '', '', null, null, null, '371', '审核中', null, null, null, '510', '0', '0', '0');
INSERT INTO `club_list` VALUES ('29', '20170029', '澳門聾人協會聾人服務中心', '', '', '', '', '', '', '', '0', '', '0', '', '', '', '', null, null, null, '371', '审核中', null, null, null, '510', '0', '0', '0');
INSERT INTO `club_list` VALUES ('30', '20170030', '藝駿中心', '', '', '', '', '', '', '', '0', '', '0', '', '', '', '', null, null, null, '371', '审核中', null, null, null, '510', '0', '0', '0');
INSERT INTO `club_list` VALUES ('31', '20170031', '街坊總會望廈社區中心', '', '', '', '', '', '', '', '0', '', '0', '', '', '', '', null, null, null, '371', '审核中', null, null, null, '510', '0', '0', '0');
INSERT INTO `club_list` VALUES ('32', '20170032', '街總家庭服務社區中心', '', '', '', '', '', '', '', '0', '', '0', '', '', '', '', null, null, null, '371', '审核中', null, null, null, '510', '0', '0', '0');
INSERT INTO `club_list` VALUES ('33', '20170033', '街總黑沙環社區服務中心', '', '', '', '', '', '', '', '0', '', '0', '', '', '', '', null, null, null, '371', '审核中', null, null, null, '510', '0', '0', '0');
INSERT INTO `club_list` VALUES ('34', '20170034', '澳門中華學生聯合總會', '', '', '', '', '', '', '', '0', '', '0', '', '', '', '', null, null, null, '371', '审核中', null, null, null, '510', '0', '0', '0');
INSERT INTO `club_list` VALUES ('35', '20170035', '澳門仁慈堂盲人重建中心', '', '', '', '', '', '', '', '0', '', '0', '', '', '', '', null, null, null, '371', '审核中', null, null, null, '510', '0', '0', '0');
INSERT INTO `club_list` VALUES ('36', '20170036', '澳門弱智人士家長協進會附屬曉光中心', '', '', '', '', '', '', '', '0', '', '0', '', '', '', '', null, null, null, '371', '审核中', null, null, null, '510', '0', '0', '0');
