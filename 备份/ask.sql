/*
 Navicat Premium Data Transfer

 Source Server         : 本地测试数据库
 Source Server Type    : MySQL
 Source Server Version : 50635
 Source Host           : localhost
 Source Database       : ask

 Target Server Type    : MySQL
 Target Server Version : 50635
 File Encoding         : utf-8

 Date: 05/10/2018 15:40:34 PM
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `ask_admin`
-- ----------------------------
DROP TABLE IF EXISTS `ask_admin`;
CREATE TABLE `ask_admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `account` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nickname` varchar(255) DEFAULT NULL COMMENT '昵称',
  `remark` varchar(100) NOT NULL DEFAULT '' COMMENT '系统管理员',
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `account` (`account`(191))
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Records of `ask_admin`
-- ----------------------------
BEGIN;
INSERT INTO `ask_admin` VALUES ('1', 'admin', '$2y$10$tCsgrkTjQPPHPWJLrX2BkOvSJmf19hZzlS.EsMJ5nN/HdXJPOC3PG', 'admin', '超级管理员', '2018-04-27 10:06:34');
COMMIT;

-- ----------------------------
--  Table structure for `ask_answer`
-- ----------------------------
DROP TABLE IF EXISTS `ask_answer`;
CREATE TABLE `ask_answer` (
  `id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Table structure for `ask_artical`
-- ----------------------------
DROP TABLE IF EXISTS `ask_artical`;
CREATE TABLE `ask_artical` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL COMMENT '用户id',
  `type` tinyint(1) NOT NULL COMMENT '文章类型 1:文章 2:提问题',
  `title` varchar(255) NOT NULL,
  `content` text COMMENT '内容',
  `coverpic` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1草稿 2待审核 3已发表 4 已撤回 5未通过',
  `price` decimal(3,0) NOT NULL DEFAULT '0' COMMENT '价格',
  `is_blocked` int(1) DEFAULT '0' COMMENT '是否被屏蔽(屏蔽的文章无法查看)',
  `blocked_reason` varchar(255) DEFAULT NULL,
  `visitornum` int(9) unsigned NOT NULL DEFAULT '0' COMMENT '浏览人数',
  `is_anonymous` tinyint(1) unsigned DEFAULT NULL COMMENT '是否匿名发布',
  `latest_comment` datetime DEFAULT NULL COMMENT '最新评论时间',
  `is_lock` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否被锁定(被锁定的文章不可以删除、修改、评论)',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL COMMENT '最后更新时间',
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Records of `ask_artical`
-- ----------------------------
BEGIN;
INSERT INTO `ask_artical` VALUES ('1', '1', '1', '人工智能的局限性', '内容', null, '2', '0', '0', null, '0', null, '2018-05-03 14:33:57', '0', '2018-05-03 14:30:14', '2018-05-03 14:30:17', null), ('2', '1', '2', '测试问题', '问题内容', null, '2', '0', '0', null, '0', null, null, '0', '2018-05-08 15:16:17', '2018-05-08 15:16:24', null), ('3', '1', '1', '测试文章', '文章内容', null, '1', '0', '0', null, '0', null, null, '0', '2018-05-08 15:16:20', '2018-05-08 15:16:22', null);
COMMIT;

-- ----------------------------
--  Table structure for `ask_artical_collect_dir`
-- ----------------------------
DROP TABLE IF EXISTS `ask_artical_collect_dir`;
CREATE TABLE `ask_artical_collect_dir` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` int(10) unsigned NOT NULL,
  `name` char(10) NOT NULL COMMENT '收藏夹名称',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_id` (`users_id`,`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Table structure for `ask_artical_collect_item`
-- ----------------------------
DROP TABLE IF EXISTS `ask_artical_collect_item`;
CREATE TABLE `ask_artical_collect_item` (
  `id` int(11) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `collect_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Table structure for `ask_article_topic`
-- ----------------------------
DROP TABLE IF EXISTS `ask_article_topic`;
CREATE TABLE `ask_article_topic` (
  `artical_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  KEY `artical_id` (`artical_id`,`topic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='文章话题对应表';

-- ----------------------------
--  Records of `ask_article_topic`
-- ----------------------------
BEGIN;
INSERT INTO `ask_article_topic` VALUES ('1', '1'), ('1', '2'), ('1', '3'), ('2', '5'), ('2', '6'), ('2', '7'), ('2', '8');
COMMIT;

-- ----------------------------
--  Table structure for `ask_comment`
-- ----------------------------
DROP TABLE IF EXISTS `ask_comment`;
CREATE TABLE `ask_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artical_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `content` varchar(1000) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否审核 0未审核 1已审核',
  `satisfactory_answer` tinyint(1) DEFAULT '0' COMMENT '是否满意回答',
  PRIMARY KEY (`id`),
  KEY `artical_id` (`artical_id`,`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Records of `ask_comment`
-- ----------------------------
BEGIN;
INSERT INTO `ask_comment` VALUES ('1', '1', '1', '测试评论', '2018-05-08 10:14:47', '2018-05-08 10:14:49', '0', '0');
COMMIT;

-- ----------------------------
--  Table structure for `ask_interact`
-- ----------------------------
DROP TABLE IF EXISTS `ask_interact`;
CREATE TABLE `ask_interact` (
  `user_id` int(11) NOT NULL COMMENT '冗余字段 作者主键',
  `article_id` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1关注 2喜欢 3不喜欢 4感谢 5此问题对我没帮助',
  KEY `type` (`type`,`article_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户互动表';

-- ----------------------------
--  Table structure for `ask_invite_answer`
-- ----------------------------
DROP TABLE IF EXISTS `ask_invite_answer`;
CREATE TABLE `ask_invite_answer` (
  `id` int(10) unsigned NOT NULL,
  `users_id` int(11) unsigned NOT NULL COMMENT '邀请人id',
  `beinvited_id` int(11) unsigned NOT NULL COMMENT '被邀请人id',
  `question_id` int(11) unsigned NOT NULL COMMENT '问题id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Records of `ask_invite_answer`
-- ----------------------------
BEGIN;
INSERT INTO `ask_invite_answer` VALUES ('0', '1', '2', '3');
COMMIT;

-- ----------------------------
--  Table structure for `ask_question_collect_dir`
-- ----------------------------
DROP TABLE IF EXISTS `ask_question_collect_dir`;
CREATE TABLE `ask_question_collect_dir` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` int(10) unsigned NOT NULL,
  `name` char(10) NOT NULL COMMENT '收藏夹名称',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_id` (`users_id`,`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Records of `ask_question_collect_dir`
-- ----------------------------
BEGIN;
INSERT INTO `ask_question_collect_dir` VALUES ('1', '1', '计算机'), ('3', '1', '计算机1'), ('2', '2', '计算机');
COMMIT;

-- ----------------------------
--  Table structure for `ask_question_collect_item`
-- ----------------------------
DROP TABLE IF EXISTS `ask_question_collect_item`;
CREATE TABLE `ask_question_collect_item` (
  `id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `collect_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Table structure for `ask_special`
-- ----------------------------
DROP TABLE IF EXISTS `ask_special`;
CREATE TABLE `ask_special` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Records of `ask_special`
-- ----------------------------
BEGIN;
INSERT INTO `ask_special` VALUES ('1', '科技优秀作者（互联网、产品、科技）'), ('2', '历史优秀作者（历史、人物）'), ('3', '人文优秀作者（人文社科、文学读书）'), ('4', '故事优秀作者（小说故事、见闻经历）'), ('5', '影视优秀作者（影评、剧评）'), ('6', '旅行优秀作者（旅行、游记、见闻）'), ('7', '生活优秀作者（美食、购物、穿搭、美妆、健康、生活方式……）'), ('8', '观察优秀作者（社会热点、娱乐八卦、观点想法类）'), ('9', '连载小说优秀作者（连载小说）'), ('10', '漫画优秀作者（漫画）'), ('11', '体育优秀作者（体育）'), ('12', '经管优秀作者（经济、企业管理）'), ('13', '游戏优秀作者（游戏）'), ('14', '儿童故事优秀作者'), ('15', '科普优秀作者');
COMMIT;

-- ----------------------------
--  Table structure for `ask_topic`
-- ----------------------------
DROP TABLE IF EXISTS `ask_topic`;
CREATE TABLE `ask_topic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creator_id` int(11) NOT NULL COMMENT '创建人id 1:系统创建 其他的归属用户创建',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '预留数据 1:是 2:否',
  `name` varchar(50) NOT NULL,
  `code` varchar(20) DEFAULT NULL,
  `introduce` varchar(500) DEFAULT '' COMMENT '话题简介',
  `image` varchar(150) DEFAULT '' COMMENT '封面图',
  `notice` varchar(255) DEFAULT '' COMMENT '公告',
  `have_sub_level` varchar(255) DEFAULT NULL,
  `have_parent_level` varchar(255) DEFAULT NULL,
  `is_public` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否公开 1:是 0:否',
  `is_opened` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否被开启 1:是 0:否',
  `is_locking` tinyint(1) DEFAULT '0' COMMENT '是否锁定(锁定的专题无法删除、修改以及新增文章) 1:锁定 0:未锁定',
  `is_home` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否首页推荐 1:推荐 0不推荐',
  `is_choice` tinyint(1) NOT NULL DEFAULT '0' COMMENT '精选话题 1:是 2:否',
  `is_hot` tinyint(1) NOT NULL DEFAULT '0' COMMENT '热门话题 1:是 0:否',
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `subscribe` int(11) NOT NULL DEFAULT '0' COMMENT '关注人数',
  `is_city` tinyint(1) DEFAULT '0',
  `is_school` tinyint(1) DEFAULT '0',
  `is_recommend` tinyint(1) DEFAULT '0',
  `is_menu` tinyint(1) unsigned DEFAULT '0' COMMENT '发现页菜单话题（ISMenu是/否，指是否出现在发现页左边菜单）',
  `city_id` int(10) DEFAULT '0',
  `school_id` int(10) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Records of `ask_topic`
-- ----------------------------
BEGIN;
INSERT INTO `ask_topic` VALUES ('1', '1', '1', '校园', '0', '校园话题1', 'img/topic_image/15253273055446.png', '未开放', null, null, '1', '0', '0', '1', '0', '0', '2018-4-26', '2018-05-04 14:46:43', '0', '1', '0', '1', '0', '1', '12'), ('2', '1', '1', '读书', '0', '55', '', '77', null, null, '1', '0', '0', '0', '0', '0', '2018-4-26', '2018-05-03 17:30:48', '0', '0', '1', '1', '0', '0', '0'), ('3', '1', '1', '学霸笔记', '0', null, '', null, null, null, '1', '0', '0', '0', '0', '0', '2018-4-26', '2018-04-27 14:10:13', '0', '0', '0', '0', '0', '0', '0'), ('4', '1', '1', '课堂艺术', '0', '', '', '', null, null, '1', '0', '0', '0', '0', '0', '2018-4-26', null, '0', '0', '0', '0', '0', '0', '0'), ('5', '1', '1', '教师圈', '0', '', '', '', null, null, '1', '0', '0', '0', '0', '0', '2018-4-26', null, '0', '0', '0', '0', '0', '0', '0'), ('6', '1', '1', '幼儿教育', '0', '', '', '', null, null, '1', '0', '0', '0', '0', '0', '2018-4-26', null, '0', '0', '0', '0', '0', '0', '0'), ('7', '1', '1', '小学教育', '0', '', '', '', null, null, '1', '0', '0', '0', '0', '0', '2018-4-26', null, '0', '0', '0', '0', '0', '0', '0'), ('8', '1', '1', '初中教育', '0', '', '', '', null, null, '1', '0', '0', '0', '0', '0', '2018-4-26', null, '0', '0', '0', '0', '0', '0', '0'), ('9', '1', '1', '高中教育', '0', '', '', '', null, null, '1', '0', '0', '0', '0', '0', '2018-4-26', null, '0', '0', '0', '0', '0', '0', '0'), ('10', '1', '1', '职业教育', '0', '', '', '', null, null, '1', '0', '0', '0', '0', '0', '2018-4-26', null, '0', '0', '0', '0', '0', '0', '0'), ('11', '1', '1', '成人教育', '0', '', '', '', null, null, '1', '0', '0', '0', '0', '0', '2018-4-26', null, '0', '0', '0', '0', '0', '0', '0'), ('12', '1', '1', '高等教育', '0', '', '', '', null, null, '1', '0', '0', '0', '0', '0', '2018-4-26', null, '0', '0', '0', '0', '0', '0', '0'), ('13', '1', '1', '资格考试', '0', '', '', '', null, null, '1', '0', '0', '0', '0', '0', '2018-4-26', null, '0', '0', '0', '0', '0', '0', '0'), ('14', '1', '1', '中考聚焦', '0', '', '', '', null, null, '1', '0', '0', '0', '0', '0', '2018-4-26', null, '0', '0', '0', '0', '0', '0', '0'), ('15', '1', '1', '决战高考', '0', '', '', '', null, null, '1', '0', '0', '0', '0', '0', '2018-4-26', null, '0', '0', '0', '0', '0', '0', '0'), ('16', '1', '1', '出国留学·游学', '0', '', '', '', null, null, '1', '0', '0', '0', '0', '0', '2018-4-26', null, '0', '0', '0', '0', '0', '0', '0'), ('17', '1', '1', '旅行·在路上', '0', '', '', '', null, null, '1', '0', '0', '0', '0', '0', '2018-4-26', null, '0', '0', '0', '0', '0', '0', '0'), ('18', '1', '1', '运动·户外', '0', '', '', '', null, null, '1', '0', '0', '0', '0', '0', '2018-4-26', null, '0', '0', '0', '0', '0', '0', '0'), ('19', '1', '1', '互联网', '0', '', '', '', null, null, '1', '0', '0', '0', '0', '0', '2018-4-26', null, '0', '0', '0', '0', '0', '0', '0'), ('20', '1', '1', '短篇小说', '0', '', '', '', null, null, '1', '0', '0', '0', '0', '0', '2018-4-26', null, '0', '0', '0', '0', '0', '0', '0'), ('21', '1', '1', '故事', '0', '', '', '', null, null, '1', '0', '0', '0', '0', '0', '2018-4-26', null, '0', '0', '0', '0', '0', '0', '0'), ('22', '1', '1', '历史', '0', '', '', '', null, null, '1', '0', '0', '0', '0', '0', '2018-4-26', null, '0', '0', '0', '0', '0', '0', '0'), ('23', '1', '1', '手绘', '0', '', '', '', null, null, '1', '0', '0', '0', '0', '0', '2018-4-26', null, '0', '0', '0', '0', '0', '0', '0'), ('24', '1', '1', '漫画', '0', '', '', '', null, null, '1', '0', '0', '0', '0', '0', '2018-4-26', null, '0', '0', '0', '0', '0', '0', '0'), ('25', '1', '1', '游戏', '0', '', '', '', null, null, '1', '0', '0', '0', '0', '0', '2018-4-26', null, '0', '0', '0', '0', '0', '0', '0'), ('26', '1', '1', '电影', '0', '', '', '', null, null, '1', '0', '0', '0', '0', '0', '2018-4-26', null, '0', '0', '0', '0', '0', '0', '0'), ('27', '1', '1', '音乐', '0', '', '', '', null, null, '1', '0', '0', '0', '0', '0', '2018-4-26', null, '0', '0', '0', '0', '0', '0', '0'), ('28', '1', '1', '诗歌散文', '0', '', '', '', null, null, '1', '0', '0', '0', '0', '0', '2018-4-26', null, '0', '0', '0', '0', '0', '0', '0'), ('29', '1', '1', '自然科普', '0', '', '', '', null, null, '1', '0', '0', '0', '0', '0', '2018-4-26', null, '0', '0', '0', '0', '0', '0', '0'), ('30', '1', '1', '人文社科', '0', '', '', '', null, null, '1', '0', '0', '0', '0', '0', '2018-4-26', null, '0', '0', '0', '0', '0', '0', '0'), ('31', '1', '1', '生活休闲', '0', '', '', '', null, null, '1', '0', '0', '0', '0', '0', '2018-4-26', null, '0', '0', '0', '0', '0', '0', '0'), ('32', '1', '1', '1', null, '2', '', '3', null, null, '1', '1', '0', '0', '0', '0', '2018-04-26 18:44:17', '2018-04-26 18:44:17', '0', '0', '0', '0', '0', '0', '0'), ('33', '1', '1', '2', null, '2', '', '3', null, null, '1', '1', '0', '0', '0', '0', '2018-04-27 11:08:50', '2018-04-27 11:08:50', '0', '0', '0', '0', '0', '0', '0'), ('37', '1', '1', '21', null, '2', '', '3344', null, null, '1', '1', '0', '0', '0', '0', '2018-04-27 11:09:19', '2018-04-27 11:09:19', '0', '0', '0', '0', '0', '0', '0'), ('39', '1', '1', '3', null, '2', '', '3344', null, null, '1', '1', '0', '0', '0', '0', '2018-04-27 11:09:26', '2018-04-27 11:09:26', '0', '0', '0', '0', '0', '0', '0'), ('41', '1', '1', '测试', null, '11', '', '1', null, null, '1', '1', '0', '0', '0', '0', '2018-04-27 16:27:36', '2018-04-27 16:27:36', '0', '0', '0', '0', '0', '0', '0'), ('42', '1', '0', '测试话题', null, '1212', '', '21212', null, null, '1', '1', '0', '0', '0', '0', '2018-05-02 15:57:14', '2018-05-03 16:53:50', '0', '0', '0', '0', '0', '0', '0');
COMMIT;

-- ----------------------------
--  Table structure for `ask_topic_manager`
-- ----------------------------
DROP TABLE IF EXISTS `ask_topic_manager`;
CREATE TABLE `ask_topic_manager` (
  `topic_id` int(11) NOT NULL COMMENT '话题ID',
  `users_id` int(11) NOT NULL COMMENT '管理员id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='一个话题可以有多个管理员';

-- ----------------------------
--  Records of `ask_topic_manager`
-- ----------------------------
BEGIN;
INSERT INTO `ask_topic_manager` VALUES ('2', '1'), ('2', '2'), ('7', '1'), ('1', '1'), ('3', '1');
COMMIT;

-- ----------------------------
--  Table structure for `ask_topic_relative`
-- ----------------------------
DROP TABLE IF EXISTS `ask_topic_relative`;
CREATE TABLE `ask_topic_relative` (
  `topic_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '话题id',
  `arrow_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父级话题id',
  PRIMARY KEY (`topic_id`,`arrow_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='话题-父话题';

-- ----------------------------
--  Records of `ask_topic_relative`
-- ----------------------------
BEGIN;
INSERT INTO `ask_topic_relative` VALUES ('2', '3'), ('2', '5'), ('2', '6'), ('3', '1'), ('3', '2'), ('3', '31'), ('3', '33'), ('3', '37'), ('4', '1'), ('4', '7'), ('5', '2'), ('5', '3'), ('5', '4'), ('5', '6'), ('5', '7'), ('7', '4'), ('7', '9'), ('7', '11'), ('7', '14'), ('7', '16'), ('10', '1'), ('10', '4'), ('10', '32');
COMMIT;

-- ----------------------------
--  Table structure for `ask_topic_type`
-- ----------------------------
DROP TABLE IF EXISTS `ask_topic_type`;
CREATE TABLE `ask_topic_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `remark` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Records of `ask_topic_type`
-- ----------------------------
BEGIN;
INSERT INTO `ask_topic_type` VALUES ('1', '城市话题', '预留数据'), ('2', '校园话题', '预留数据');
COMMIT;

-- ----------------------------
--  Table structure for `ask_users`
-- ----------------------------
DROP TABLE IF EXISTS `ask_users`;
CREATE TABLE `ask_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(11) NOT NULL COMMENT '账号',
  `password` varchar(100) NOT NULL COMMENT '密码',
  `is_special` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否是推荐作家 0:否 1:是',
  `special_id` int(11) DEFAULT '0' COMMENT '外键 推荐类型id',
  `nickname` varchar(255) DEFAULT NULL COMMENT '昵称',
  `sex` tinyint(1) DEFAULT NULL COMMENT '性别 1:男 2:女',
  `occupation` varchar(50) DEFAULT '0' COMMENT '职业',
  `short_sign` varchar(50) NOT NULL DEFAULT '' COMMENT '简短签名',
  `long_sign` varchar(255) NOT NULL DEFAULT '' COMMENT '详细签名',
  `register_from` tinyint(1) NOT NULL DEFAULT '0' COMMENT '注册来源 -1:测试0:预留 1:Android 2:IOS 3:Web 4:Wechat',
  `wechat_qrcode` varchar(200) DEFAULT NULL COMMENT '微信二维码',
  `created_at` datetime DEFAULT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `allow_login` tinyint(1) DEFAULT '1' COMMENT '是否允许登录',
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_2` (`account`),
  KEY `account` (`account`,`password`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Records of `ask_users`
-- ----------------------------
BEGIN;
INSERT INTO `ask_users` VALUES ('1', '13265808085', '$2y$10$qF.ZEAi0sDiUoVUCcINXtuyIGUTWXtJxsaru4wFa6wLO3R9nxHsM2', '1', '0', 'fullstackvalley', '1', '0', '测试短签名', '测试长签名', '-1', null, '2018-04-26 11:19:28', null, '1'), ('2', '134', 'N', '1', '0', '用户2', '1', '0', '测试短签名', '测试长签名', '-1', null, '2018-04-26 11:19:28', null, '1'), ('3', '123', 'N', '1', '0', '用户3', '1', '0', '测试短签名', '测试长签名', '-1', null, '2018-04-26 11:19:28', null, '1'), ('4', '12212', 'N', '0', '0', '用户4', '1', '0', '测试短签名', '测试长签名', '-1', null, '2018-04-26 11:19:28', null, '1'), ('5', '1212', 'N', '0', '0', '用户5', '1', '0', '测试短签名', '测试长签名', '-1', null, '2018-04-26 11:19:28', null, '1'), ('7', '1', '', '0', '0', null, null, '0', '', '', '0', null, null, null, '1');
COMMIT;

-- ----------------------------
--  Table structure for `ask_users_action`
-- ----------------------------
DROP TABLE IF EXISTS `ask_users_action`;
CREATE TABLE `ask_users_action` (
  `users_id` int(10) DEFAULT NULL,
  `artical_id` int(10) DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='type=1:用户赞的文章\ntype=2:用户踩文章';

-- ----------------------------
--  Table structure for `ask_users_artical`
-- ----------------------------
DROP TABLE IF EXISTS `ask_users_artical`;
CREATE TABLE `ask_users_artical` (
  `users_id` int(11) NOT NULL,
  `artical_id` int(11) NOT NULL,
  PRIMARY KEY (`users_id`,`artical_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户关注的文章\n';

-- ----------------------------
--  Records of `ask_users_artical`
-- ----------------------------
BEGIN;
INSERT INTO `ask_users_artical` VALUES ('1', '1');
COMMIT;

-- ----------------------------
--  Table structure for `ask_users_author`
-- ----------------------------
DROP TABLE IF EXISTS `ask_users_author`;
CREATE TABLE `ask_users_author` (
  `users_id` tinyint(11) NOT NULL COMMENT '关注人id/用户id',
  `author_id` tinyint(11) NOT NULL COMMENT '作者id',
  `created_at` datetime NOT NULL COMMENT '关注时间',
  PRIMARY KEY (`author_id`,`users_id`),
  KEY `users_follower` (`users_id`,`author_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Records of `ask_users_author`
-- ----------------------------
BEGIN;
INSERT INTO `ask_users_author` VALUES ('4', '1', '2018-05-09 17:26:19'), ('1', '2', '2018-05-08 14:59:44'), ('1', '3', '2018-05-08 14:59:46'), ('2', '3', '2018-05-08 14:59:48');
COMMIT;

-- ----------------------------
--  Table structure for `ask_users_topic`
-- ----------------------------
DROP TABLE IF EXISTS `ask_users_topic`;
CREATE TABLE `ask_users_topic` (
  `topic_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  PRIMARY KEY (`topic_id`,`users_id`),
  KEY `topic_id` (`topic_id`,`users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户关注的话题';

-- ----------------------------
--  Records of `ask_users_topic`
-- ----------------------------
BEGIN;
INSERT INTO `ask_users_topic` VALUES ('1', '1'), ('2', '1');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
