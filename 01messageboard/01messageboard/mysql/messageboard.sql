/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 60011
Source Host           : localhost:3306
Source Database       : messageboard

Target Server Type    : MYSQL
Target Server Version : 60011
File Encoding         : 65001

Date: 2015-11-10 21:21:56
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `mb_admin_user`
-- ----------------------------
DROP TABLE IF EXISTS `mb_admin_user`;
CREATE TABLE `mb_admin_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员ID',
  `username` varchar(20) NOT NULL COMMENT '管理员用户名',
  `password` varchar(40) NOT NULL COMMENT '管理员密码',
  `email` varchar(30) DEFAULT NULL COMMENT '管理员邮箱',
  `lastip` varchar(15) DEFAULT NULL COMMENT '管理员最后登陆IP地址',
  `state` tinyint(1) NOT NULL COMMENT '管理员状态：-1→删除；0→禁用；1→正常；2→留言板主人',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mb_admin_user
-- ----------------------------
INSERT INTO `mb_admin_user` VALUES ('1', 'luxury', '4297f44b13955235245b2497399d7a93', '406764368@qq.com', '183.129.210.90', '2');
INSERT INTO `mb_admin_user` VALUES ('2', 'admin', '4297f44b13955235245b2497399d7a93', '1044809909@qq.com', '183.129.210.90', '1');
INSERT INTO `mb_admin_user` VALUES ('3', 'hd', '4297f44b13955235245b2497399d7a93', null, '112.65.201.117', '1');
INSERT INTO `mb_admin_user` VALUES ('4', 'pzq', '4297f44b13955235245b2497399d7a93', '236091829@qq.com', '112.65.201.117', '1');
INSERT INTO `mb_admin_user` VALUES ('5', 'pack', '4297f44b13955235245b2497399d7a93', null, '183.129.210.90', '1');

-- ----------------------------
-- Table structure for `mb_comment`
-- ----------------------------
DROP TABLE IF EXISTS `mb_comment`;
CREATE TABLE `mb_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '留言ID',
  `author` varchar(20) NOT NULL COMMENT '留言作者',
  `ip` varchar(15) DEFAULT NULL COMMENT '留言IP地址',
  `content` varchar(200) NOT NULL COMMENT '留言内容',
  `state` tinyint(1) NOT NULL COMMENT '留言状态：-1→删除；0→禁用；1→正常',
  `portrait` varchar(100) DEFAULT NULL COMMENT '留言作者头像',
  `ctime` int(10) NOT NULL COMMENT '留言创建时间',
  `pid` int(10) DEFAULT NULL COMMENT '0→留言，其他→回复对象的ID',
  `who` varchar(20) DEFAULT NULL COMMENT '回复对象姓名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mb_comment
-- ----------------------------
INSERT INTO `mb_comment` VALUES ('28', '测试1号', '183.129.210.90', '今天天气好晴朗', '1', '/phpspe/v2.0/Uploads/messageboard/image/20151110/20151110145042_89947.png', '1447138253', '0', '测试1号');
INSERT INTO `mb_comment` VALUES ('29', '王小二', '183.129.210.90', '阿的卡口凉水都哭了', '1', '', '1447138950', '0', '王小二');
INSERT INTO `mb_comment` VALUES ('30', '王小二', '183.129.210.90', '测试一下了', '1', '', '1447138963', '0', '王小二');
INSERT INTO `mb_comment` VALUES ('31', 'admin', '183.129.210.90', '我是管理员,呵呵呵呵.......................', '1', '', '1447139002', '0', 'admin');
INSERT INTO `mb_comment` VALUES ('32', 'luxury', '183.129.210.90', '版主驾到', '1', '/phpspe/v2.0/Uploads/messageboard/image/20151110/20151110150355_87225.png', '1447139037', '0', 'luxury');
INSERT INTO `mb_comment` VALUES ('33', '测试二号', '183.129.210.90', '大家好，我是测试二号', '1', '/phpspe/v2.0/Uploads/messageboard/image/20151110/20151110183543_52283.png', '1447151745', '0', '测试二号');
INSERT INTO `mb_comment` VALUES ('34', '测试二号', '183.129.210.90', '试试看哦', '1', '/phpspe/v2.0/Uploads/messageboard/image/20151110/20151110183543_52283.png', '1447154413', '0', '测试二号');
INSERT INTO `mb_comment` VALUES ('35', '测试二号', '183.129.210.90', '测试', '1', '', '1447156145', '34', '测试二号');
INSERT INTO `mb_comment` VALUES ('36', '测试二号', '183.129.210.90', '版主威武！', '1', '', '1447156174', '32', 'luxury');
INSERT INTO `mb_comment` VALUES ('37', '测试三号', '183.129.210.90', '继续测试', '1', '/phpspe/v2.0/Uploads/messageboard/image/20151110/20151110183543_52283.png', '1447158353', '0', '测试三号');
INSERT INTO `mb_comment` VALUES ('39', 'luxury', '183.129.210.90', '啊啊啊', '1', '', '1447159097', '34', '测试二号');
INSERT INTO `mb_comment` VALUES ('40', 'luxury', '183.129.210.90', '再来一次', '1', '', '1447159831', '34', '测试二号');

-- ----------------------------
-- Table structure for `mb_comment_info`
-- ----------------------------
DROP TABLE IF EXISTS `mb_comment_info`;
CREATE TABLE `mb_comment_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '留言ID',
  `author` varchar(20) NOT NULL COMMENT '留言作者',
  `ip` varchar(15) DEFAULT NULL COMMENT '留言IP地址',
  `content` varchar(200) NOT NULL COMMENT '留言内容',
  `state` tinyint(1) NOT NULL COMMENT '留言状态：-1→删除；0→禁用；1→正常',
  `portrait` varchar(100) DEFAULT NULL COMMENT '留言作者头像',
  `ctime` int(10) NOT NULL COMMENT '留言创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mb_comment_info
-- ----------------------------
INSERT INTO `mb_comment_info` VALUES ('6', 'admin', '183.129.210.90', '版主威武', '1', '', '1446122772');
INSERT INTO `mb_comment_info` VALUES ('7', 'pack', '183.129.210.90', '版主居然比我还帅', '1', 'upload/20151029/e8b48daa88a512dccf2783075c3cbd69.png', '1446123137');
INSERT INTO `mb_comment_info` VALUES ('8', 'pack', '112.65.201.117', '版主为什么这么帅呢，这是个千古之谜', '1', 'upload/20151029/0c367c24b2ce1558dc43be5f43c22df5.png', '1446123345');
INSERT INTO `mb_comment_info` VALUES ('9', 'luxury', '112.65.201.117', '版主驾到', '1', 'upload/20151029/a3f03f79fc889300e7115710debfc172.png', '1446123388');
INSERT INTO `mb_comment_info` VALUES ('10', '一二三四五六七八九十一二三四五六七八九十', '112.65.201.117', '一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十', '1', '', '1446123136');
INSERT INTO `mb_comment_info` VALUES ('11', '发的', '183.129.210.90', '123', '1', '', '1446122771');
INSERT INTO `mb_comment_info` VALUES ('12', '萨达', '112.65.201.113', '123', '1', '', '1446122762');
INSERT INTO `mb_comment_info` VALUES ('13', '萨达', '112.65.201.113', '测试测试1', '1', '', '1446122672');
INSERT INTO `mb_comment_info` VALUES ('14', '萨达', '112.65.201.113', '测试测试2', '1', '', '1446122662');
INSERT INTO `mb_comment_info` VALUES ('15', '萨达', '112.65.201.113', '测试测试3', '1', '', '1446122744');
INSERT INTO `mb_comment_info` VALUES ('16', '萨达', '112.65.201.113', '测试测试4', '1', '', '1446122734');
INSERT INTO `mb_comment_info` VALUES ('17', '撒旦阿萨德', '183.129.210.90', '四大', '1', '', '1446003734');
INSERT INTO `mb_comment_info` VALUES ('18', '撒旦阿萨德', '', '的飒爽阿萨德', '1', '', '1446004734');
INSERT INTO `mb_comment_info` VALUES ('19', '撒旦阿萨德', '', '阿萨德爱是阿萨德阿萨德', '1', '', '1446005734');
INSERT INTO `mb_comment_info` VALUES ('20', '撒旦阿萨德', '', '多少阿萨德阿萨德阿萨德', '1', '', '1446006734');
INSERT INTO `mb_comment_info` VALUES ('21', '撒旦阿萨德', '183.129.210.90', '阿萨德阿萨德阿萨德啊', '1', '', '1446007734');
INSERT INTO `mb_comment_info` VALUES ('22', '撒旦阿萨德', '183.129.210.90', '的飒爽打算', '1', '', '1446008834');
INSERT INTO `mb_comment_info` VALUES ('23', '撒旦阿萨德', '183.129.210.90', '第三方放', '1', '', '1446009734');
INSERT INTO `mb_comment_info` VALUES ('24', '撒旦阿萨德', '183.129.210.90', '才vxbfg', '1', '', '1446003444');
INSERT INTO `mb_comment_info` VALUES ('25', '撒旦阿萨德', '183.129.210.90', '电话try好人他', '1', '', '1446002734');
INSERT INTO `mb_comment_info` VALUES ('26', '撒旦阿萨德', '183.129.210.90', '四大啊', '1', '', '1446002664');

-- ----------------------------
-- Table structure for `mb_reply_info`
-- ----------------------------
DROP TABLE IF EXISTS `mb_reply_info`;
CREATE TABLE `mb_reply_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '回复ID',
  `pid` varchar(10) NOT NULL COMMENT '回复对象ID',
  `author` varchar(20) NOT NULL COMMENT '回复作者',
  `ip` varchar(15) DEFAULT NULL COMMENT '回复IP地址',
  `content` varchar(200) NOT NULL,
  `state` tinyint(1) NOT NULL COMMENT '回复状态：-1→删除；0→禁用；1→正常',
  `ctime` int(10) NOT NULL COMMENT '留言创建时间',
  `who` varchar(20) NOT NULL COMMENT '回复对象',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mb_reply_info
-- ----------------------------
INSERT INTO `mb_reply_info` VALUES ('1', '9', '一二三四五六七八九十一二三四五六七八九十', '112.65.201.117', '版主最帅', '1', '1446134929', 'luxury');
INSERT INTO `mb_reply_info` VALUES ('4', '8', '一二三四五六七八九十一二三四五六七八九十', '112.65.201.117', '我也想知道答案', '1', '1446136406', 'pack');
INSERT INTO `mb_reply_info` VALUES ('5', '9', 'admin', '112.65.201.117', '版主我爱你', '1', '1446139781', 'luxury');
INSERT INTO `mb_reply_info` VALUES ('6', '8', 'admin', '112.65.201.117', '我不会告诉你的', '1', '1446139228', 'pack');
INSERT INTO `mb_reply_info` VALUES ('7', '9', 'luxury', '112.65.201.117', 'of course!', '1', '1446136541', '一二三四五六七八九十一二三四五六七八九十');
INSERT INTO `mb_reply_info` VALUES ('8', '9', 'luxury', '112.65.201.117', '我也爱你', '1', '1446139948', 'admin');
INSERT INTO `mb_reply_info` VALUES ('10', '9', 'luxury', '112.65.201.117', '睡觉去了！睡觉去了！睡觉去了！睡觉去了！睡觉去了！睡觉去了！睡觉去了！睡觉去了！睡觉去了！睡觉去了！睡觉去了！睡觉去了！睡觉去了！睡觉去了！睡觉去了！睡觉去了！', '1', '1446140043', 'luxury');
INSERT INTO `mb_reply_info` VALUES ('11', '9', '一二三四五六七八九十一二三四五六七八九十', '183.129.210.90', '测试下', '1', '1446166811', 'luxury');
INSERT INTO `mb_reply_info` VALUES ('12', '10', 'luxury', '183.129.210.90', '数得一手好数', '1', '1446168995', '一二三四五六七八九十一二三四五六七八九十');
INSERT INTO `mb_reply_info` VALUES ('13', '9', 'pack', '183.129.210.90', '一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十', '1', '1446170373', 'luxury');
INSERT INTO `mb_reply_info` VALUES ('16', '9', '发的', '183.129.210.90', 'sdfsd', '-1', '1446173956', '一二三四五六七八九十一二三四五六七八九十');
INSERT INTO `mb_reply_info` VALUES ('17', '9', '发的', '183.129.210.90', 'sdfsd', '-1', '1446173956', '一二三四五六七八九十一二三四五六七八九十');
INSERT INTO `mb_reply_info` VALUES ('18', '9', '发的', '183.129.210.90', 'sdfsd', '-1', '1446173957', '一二三四五六七八九十一二三四五六七八九十');
INSERT INTO `mb_reply_info` VALUES ('19', '9', '发的', '183.129.210.90', 'sdfsd', '-1', '1446173957', '一二三四五六七八九十一二三四五六七八九十');
INSERT INTO `mb_reply_info` VALUES ('20', '10', '萨达', '183.129.210.90', '一二三四五，上山打老虎', '-1', '1446183734', '一二三四五六七八九十一二三四五六七八九十');
