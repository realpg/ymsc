# Host: 47.93.127.4  (Version 5.5.54-log)
# Date: 2018-06-20 11:52:36
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "t_address_area_info"
#

DROP TABLE IF EXISTS `t_address_area_info`;
CREATE TABLE `t_address_area_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '名称',
  `updated_at` datetime DEFAULT NULL COMMENT '修改时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='区管理表';

#
# Data for table "t_address_area_info"
#


#
# Structure for table "t_address_city_info"
#

DROP TABLE IF EXISTS `t_address_city_info`;
CREATE TABLE `t_address_city_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '名称',
  `updated_at` datetime DEFAULT NULL COMMENT '修改时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='市管理表';

#
# Data for table "t_address_city_info"
#


#
# Structure for table "t_address_info"
#

DROP TABLE IF EXISTS `t_address_info`;
CREATE TABLE `t_address_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `user_id` int(11) DEFAULT NULL COMMENT '用户编号',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '收货人姓名',
  `phonenum` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '电话',
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '固定电话',
  `province` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '省',
  `city` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '市',
  `town` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '区',
  `detail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '详细信息',
  `code` int(6) DEFAULT NULL COMMENT '邮编',
  `status` tinyint(1) DEFAULT '0' COMMENT '默认状态（0：正常；1：默认地址）',
  `delete` tinyint(1) DEFAULT '0' COMMENT '是否已删除（0：否；1：是）',
  `updated_at` datetime DEFAULT NULL COMMENT '修改时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='收货地址管理表';

#
# Data for table "t_address_info"
#

INSERT INTO `t_address_info` VALUES (1,14,'Amy','13012345678',NULL,'山东','潍坊市','潍城区','XX-XX-XX',NULL,0,0,'2018-03-12 12:10:44','2018-02-25 18:44:40',NULL),(2,14,'冰淇淋','13012345678','0241-0256-1234','上海','市辖区','徐汇区','XX街XX-XX-XX',701111,0,0,'2018-02-25 21:12:18','2018-02-25 19:34:45',NULL),(3,18,'毛耀宗','15640309805',NULL,'辽宁','沈阳市','沈河区','文化路72号',NULL,0,0,'2018-05-14 22:24:53','2018-02-28 14:40:45',NULL),(4,18,'shitongkang','11111111111',NULL,'北京','市辖区','东城区','顶顶顶顶',NULL,0,1,'2018-02-28 14:41:46','2018-02-28 14:41:37',NULL),(5,14,'Amy冰麒麟','13645612378',NULL,'天津','市辖区','津南区','XX街XX楼XX号XX单元',NULL,1,0,'2018-03-12 12:10:44','2018-03-01 09:42:11',NULL),(6,14,'冰麒麟','13012345678','024768686688','江西','南昌市','东湖区','XXXXXXXXX',NULL,0,0,'2018-03-12 12:10:44','2018-03-12 09:55:44',NULL),(7,14,'冰麒麟','13012345678',NULL,'山西','太原市','小店区','XXXXXX',NULL,0,0,'2018-03-12 12:10:44','2018-03-12 10:04:28',NULL),(8,14,'冰麒麟','13012345678','024712345678','北京','县','延庆县','XXXXXXXXXXXXXXX',123456,0,0,'2018-03-12 12:10:44','2018-03-12 10:08:04',NULL),(9,20,'吕兆栓','15068808725',NULL,'浙江','杭州市','西湖区','天目山路150号西溪新座6幢11楼',NULL,1,0,'2018-03-20 10:18:24','2018-03-20 10:16:55',NULL),(10,20,'sad','12345678909',NULL,'北京','市辖区','崇文区','阿达',NULL,0,1,'2018-03-20 10:18:31','2018-03-20 10:18:19',NULL),(11,21,'师同康','13080845113',NULL,'辽宁','沈阳市','沈河区','文化路139号群升新天地2号楼1007室',NULL,1,0,'2018-03-20 10:39:57','2018-03-20 10:39:57',NULL),(12,23,'师同康','15757133561',NULL,'辽宁','沈阳市','沈河区','文化路139号群升新天地2号楼1007室',NULL,1,0,'2018-03-20 17:11:17','2018-03-20 17:11:17',NULL),(13,23,'毛要总','13080045113',NULL,'上海','县','崇明县','文化路139号群升新天地2号楼1007室',NULL,0,0,'2018-03-20 17:12:19','2018-03-20 17:12:19',NULL),(14,24,'liyang','15038094563',NULL,'山东','青岛市','市南区','1323',NULL,1,0,'2018-03-25 22:03:04','2018-03-25 22:03:04',NULL),(15,14,'测试','13012345678',NULL,'上海','县','崇明县','详细地址',NULL,0,0,'2018-04-16 18:07:05','2018-04-16 18:07:05',NULL),(16,18,'毛耀宗','15640309805',NULL,'辽宁','沈阳市','沈河区','文化路72号',NULL,1,0,'2018-05-14 22:24:53','2018-05-14 22:24:48',NULL),(17,23,'师同康','15757133561',NULL,'北京','市辖区','东城区','文萃路103-2',NULL,0,0,'2018-05-14 22:41:56','2018-05-14 22:41:56',NULL);

#
# Structure for table "t_address_province_info"
#

DROP TABLE IF EXISTS `t_address_province_info`;
CREATE TABLE `t_address_province_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '名称',
  `updated_at` datetime DEFAULT NULL COMMENT '修改时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='省管理表';

#
# Data for table "t_address_province_info"
#


#
# Structure for table "t_admin_info"
#

DROP TABLE IF EXISTS `t_admin_info`;
CREATE TABLE `t_admin_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '昵称',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '密码',
  `phonenum` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '电话',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '头像',
  `type` tinyint(1) DEFAULT '0' COMMENT '管理员类型（0：普通管理员；1：超级管理员）',
  `updated_at` datetime DEFAULT NULL COMMENT '修改时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='管理员表';

#
# Data for table "t_admin_info"
#

INSERT INTO `t_admin_info` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3','13912345678',NULL,1,'2018-01-26 09:33:58','2018-01-26 09:21:10',NULL),(2,'Amy','21232f297a57a5a743894a0e4a801fc3','13012345678',NULL,1,'2018-01-26 10:01:02','2018-01-25 17:36:17',NULL),(3,'Aileen','afdd0b4ad2ec172c586e2150770fbf9e','13712345678',NULL,0,'2018-01-26 10:02:35','2018-01-26 10:00:21',NULL),(4,'小胖','afdd0b4ad2ec172c586e2150770fbf9e','13612345678',NULL,0,'2018-01-26 10:32:03','2018-01-26 10:02:49',NULL),(5,'TerryQi','afdd0b4ad2ec172c586e2150770fbf9e','15840345959',NULL,1,NULL,NULL,NULL),(6,'myz','afdd0b4ad2ec172c586e2150770fbf9e','15640309805',NULL,1,'2018-03-17 15:18:16','2018-03-17 15:18:16',NULL);

#
# Structure for table "t_advice_info"
#

DROP TABLE IF EXISTS `t_advice_info`;
CREATE TABLE `t_advice_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '类型',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '姓名',
  `phonenum` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '电话',
  `content` text COLLATE utf8mb4_unicode_ci COMMENT '内容',
  `status` tinyint(1) DEFAULT '0' COMMENT '审核状态（0：待定；1：已联系）',
  `updated_at` datetime DEFAULT NULL COMMENT '修改时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='投诉建议表';

#
# Data for table "t_advice_info"
#

INSERT INTO `t_advice_info` VALUES (12,'建议','问题少年','15612345678','你好，我可以问个问题吗？',0,'2018-04-09 11:07:20','2018-02-05 21:33:50','2018-04-09 11:07:20'),(13,'关于产品','问号先生','15812345678','关于产品，我有话要说',0,'2018-04-09 11:07:20','2018-02-05 21:38:19','2018-04-09 11:07:20'),(15,'其他','问题先生','13512345678','你吃了吗',0,'2018-04-09 11:07:20','2018-02-05 22:21:26','2018-04-09 11:07:20'),(16,'投诉','闲人一枚','13645612378','我要投诉，之前让你们客服给我找瓶矿泉水，他居然让我去超市买！！！我家附近只有便利店，你让我怎么买？服务太差了！！！！！！！！！！！！！！！！！！！！！！！！',0,'2018-04-09 11:07:20','2018-02-08 21:15:04','2018-04-09 11:07:20'),(17,'建议','丽丽','13012345678','没有',0,'2018-05-10 14:44:16','2018-04-16 17:32:02','2018-05-10 14:44:16');

#
# Structure for table "t_attribute_info"
#

DROP TABLE IF EXISTS `t_attribute_info`;
CREATE TABLE `t_attribute_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '名称',
  `menu_id` int(11) DEFAULT NULL COMMENT '一级栏目id(t_menu_info->id)',
  `attribute_id` int(11) DEFAULT '0' COMMENT '0：属性栏目（固定）；非0：属性栏目id',
  `sort` int(11) DEFAULT '0' COMMENT '排序（越大越靠前）',
  `updated_at` datetime DEFAULT NULL COMMENT '修改时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='商城搜索属性表';

#
# Data for table "t_attribute_info"
#

INSERT INTO `t_attribute_info` VALUES (1,'品牌',1,0,0,'2018-05-15 17:36:41','2018-01-28 10:25:32',NULL),(2,'分类',1,0,0,'2018-05-15 17:36:50','2018-01-28 10:25:41',NULL),(3,'应用领域分类',2,0,0,'2018-01-28 15:19:23','2018-01-28 10:26:28',NULL),(4,'仪器分类',2,0,0,'2018-01-28 16:26:43','2018-01-28 16:20:27',NULL),(5,'制造工业分类',3,0,0,NULL,'2018-01-30 11:08:18',NULL),(6,'Aldrich',1,1,0,NULL,'2018-01-30 11:08:55',NULL),(7,'aladdin',1,1,0,NULL,'2018-01-30 11:09:18',NULL),(8,'麦克林',1,1,0,NULL,'2018-01-30 11:09:37',NULL),(9,'AR,99%',1,2,0,'2018-05-15 17:56:22','2018-01-30 11:09:48','2018-05-15 17:56:22'),(10,'98%',1,2,0,'2018-05-15 17:56:25','2018-01-30 11:09:58','2018-05-15 17:56:25'),(11,'95%',1,2,0,'2018-05-15 17:56:28','2018-01-30 11:10:14','2018-05-15 17:56:28'),(12,'材料科学',2,3,0,NULL,'2018-01-30 11:10:46',NULL),(13,'分析化学',2,3,0,NULL,'2018-01-30 11:11:02',NULL),(14,'环境与资源',2,3,0,NULL,'2018-01-30 11:11:17',NULL),(15,'食品',2,3,0,NULL,'2018-01-30 11:11:32',NULL),(16,'细胞生物学仪器',2,4,0,NULL,'2018-01-30 11:11:53',NULL),(17,'光学显微镜仪器',2,4,0,NULL,'2018-01-30 11:12:15',NULL),(18,'分子生物学仪器',2,4,0,NULL,'2018-01-30 11:12:29',NULL),(19,'CNC加工',3,5,0,NULL,'2018-01-30 11:12:58',NULL),(20,'手板加工',3,5,0,NULL,'2018-01-30 11:13:18',NULL),(21,'3D打印',3,5,0,NULL,'2018-01-30 11:13:28',NULL),(22,'AR,85%',1,2,0,'2018-05-15 17:56:33','2018-03-17 15:37:04','2018-05-15 17:56:33'),(23,'≥99.99%',1,2,10,'2018-05-15 17:56:16','2018-05-11 20:08:08','2018-05-15 17:56:16'),(24,'GR',1,2,1,'2018-05-15 17:56:19','2018-05-11 20:30:25','2018-05-15 17:56:19'),(25,'环球',1,1,1,'2018-05-12 15:19:12','2018-05-12 15:19:12',NULL),(26,'实验试剂',1,2,1,'2018-05-15 17:57:00','2018-05-15 17:57:00',NULL),(27,'科研仪器',1,2,2,'2018-05-15 17:57:38','2018-05-15 17:57:38',NULL),(28,'实验耗材',1,2,0,'2018-05-15 17:59:56','2018-05-15 17:58:04',NULL),(29,'办公用品',1,2,4,'2018-05-15 17:58:53','2018-05-15 17:58:26',NULL),(30,'无',1,1,1,'2018-05-19 21:46:39','2018-05-19 21:46:39',NULL);

#
# Structure for table "t_banner_info"
#

DROP TABLE IF EXISTS `t_banner_info`;
CREATE TABLE `t_banner_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '标题',
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '图片',
  `sort` int(11) DEFAULT '0' COMMENT '|排序（越大越靠前）',
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '链接地址',
  `status` tinyint(3) DEFAULT '1' COMMENT '是否显示（0：隐藏；1：显示）',
  `menu_id` int(11) DEFAULT NULL COMMENT '栏目编号（t_menu_info->id）',
  `updated_at` datetime DEFAULT NULL COMMENT '修改时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Banner表';

#
# Data for table "t_banner_info"
#

INSERT INTO `t_banner_info` VALUES (1,'化学商城_01','http://dsyy.isart.me/o_1cao2pa99enrvtb70t3kr1mns9.jpg',0,'http://www.baidu.com',1,1,'2018-04-10 23:29:04','2018-01-26 11:11:34',NULL),(2,'化学商城_02','http://dsyy.isart.me/o_1cao2tada9ke6c12e316sv160l9.jpg',0,NULL,1,1,'2018-04-10 23:31:15','2018-01-26 11:18:52',NULL),(4,'化学商城_03','http://dsyy.isart.me/o_1cao23m0312aoafv1fkj58tqe9.png',0,NULL,1,1,'2018-04-10 23:17:16','2018-02-14 12:09:26',NULL),(5,'第三方检测_01','http://dsyy.isart.me/o_1cao240973c11ak1a36pps9pt9.jpg',0,NULL,1,2,'2018-04-10 23:17:26','2018-02-17 07:25:55',NULL),(6,'第三方检测_02','http://dsyy.isart.me/o_1cao2tt291mij212tieseh1iq69.jpg',0,NULL,1,2,'2018-04-10 23:31:35','2018-02-17 07:26:31',NULL),(7,'机加工_01','http://dsyy.isart.me/o_1c6gqr8ej1asgfpl1jql117n259.jpg',0,NULL,1,3,'2018-02-17 10:52:48','2018-02-17 09:08:38',NULL),(8,'机加工_02','http://dsyy.isart.me/o_1cao3599719vtii2fqg17oeuhj9.jpg',0,NULL,1,3,'2018-04-10 23:35:37','2018-02-17 09:10:01',NULL);

#
# Structure for table "t_base_info"
#

DROP TABLE IF EXISTS `t_base_info`;
CREATE TABLE `t_base_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'LOGO',
  `logo_page` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '子页LOGO',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '公司名称',
  `phonenum` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '电话',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '邮箱',
  `qq` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'QQ号',
  `wechat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '微信',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '公司地址',
  `time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '网站服务时间',
  `sms_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '接收短信通知的手机号',
  `copyright` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '版权',
  `number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '备案号',
  `content` text COLLATE utf8mb4_unicode_ci COMMENT '内容（关于我们）',
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '图片（关于我们）',
  `agreement` text COLLATE utf8mb4_unicode_ci COMMENT '用户服务协议',
  `postage` int(11) DEFAULT NULL COMMENT '邮费',
  `seo_title` text COLLATE utf8mb4_unicode_ci COMMENT '网站SEO优化——标题',
  `seo_keywords` text COLLATE utf8mb4_unicode_ci COMMENT '网站SEO优化——关键字',
  `seo_description` text COLLATE utf8mb4_unicode_ci COMMENT '网站SEO优化——描述',
  `updated_at` datetime DEFAULT NULL COMMENT '修改时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='网站基本信息表';

#
# Data for table "t_base_info"
#

INSERT INTO `t_base_info` VALUES (1,'http://dsyy.isart.me/o_1c8reh3c61ubm8j717ip1261jmnn.png','http://dsyy.isart.me/o_1c9gal8qepv01pb9vc6jrcadsu.png','优迈科研服务平台','02431373753','1318707388@qq.com','1911615547','http://dsyy.isart.me/o_1ca8q6to2h5k1noev7s1ieb8eiu.jpg','沈阳市沈河区文化路139号1007室','工作日07：00-24：00','‭13080845113‬','优迈众科版权所有','辽ICP备18001856号-1','遵循科研人员工作特点和规律，让科研工作者把更多精力集中于本职工作，把自己的才华和能量充分释放出来。优迈科研服务平台重新构建科研服务体系，帮助科研人员打理好杂事琐事，切实给科研活动松绑，提高科研服务效率，让科学家踏踏实实搞研究。','http://dsyy.isart.me/o_1c9oajogn3nb13271k951rne1807u.jpg','　　优迈商城（www.umylab.com）由优迈科研服务平台负责运营。大数据电子商务有限公司依据本协议的规定通过优迈商城为用户提供服务，本协议在用户和大数据电子商务有限公司之间具有合同的法律效力。\n\n大数据电子商务有限公司在此特别提醒用户认真阅读、充分理解本协议各条款，特别是其中所涉及的免除、限制大数据电子商务有限公司责任的条款、对用户权利限制条款、争议解决和法律适用等条款。\n\n请用户审慎阅读并选择是否接受本协议。除非用户接受本协议所有条款，否则用户无权使用大数据电子商务有限公司于本协议下所提供的服务。点击“同意以下协议并注册”按钮后，本协议即构成对双方有约束力的法律文件。\n\n　　一、用户注册\n1.1 优迈商城的各项服务的所有权和运作权归大数据电子商务有限公司所有。为了保障用户的权益，用户在自愿注册使用优迈商城服务前，必须仔细阅读本服务协议所有条款。用户同意并接受本协议所有条款并完成注册程序，才能成为优迈商城的正式用户。\n\n1.2 本协议内容包括协议正文及所有大数据电子商务有限公司已经发布或将来可能发布的各类服务条款及规则。所有条款与规则为协议不可分割的组成部分，与协议具有同等法律效力。\n\n1.3 用户在使用大数据电子商务有限公司提供的各项服务时，承诺接受并遵守各项相关条款的规定。大数据电子商务有限公司有权根据需要不时地制定、修改本协议或各项条款。如本协议有任何变更，大数据电子商务有限公司将在优迈商城上刊载公告，通知用户。如用户不同意相关变更，必须停止使用大数据电子商务有限公司所提供的服务。经修订的协议一经在优迈商城公布后，立即自动生效。各项条款会在发布后生效，亦成为本协议的一部分。登录或继续使用大数据电子商务有限公司所提供的服务表示用户接受经修订的协议。\n\n1.4 用户必须是具有完全民事行为能力的自然人，或者是具有合法经营资格的实体组织。无民事行为能力人、限制民事行为能力人以及无合法经营资格的组织不得注册为大数据电子商务有限公司用户或超过其民事权利或行为能力范围与大数据电子商务有限公司进行交易，如与大数据电子商务有限公司进行交易的，则服务协议自始无效，大数据电子商务有限公司有权立即停止与该用户的交易、注销该用户账户，并有权要求其承担相应的法律责任。\n\n1.5 用户点击同意本协议的，即视为用户确认自己具有享受优迈商城服务、下单购物等相应的权利能力和行为能力，能够独立承担法律责任，并且对用户在订单中提供的所有信息的真实性负责。\n\n　　二、用户账户\n2.1 用户注册成功后，大数据电子商务有限公司将为用户开通一个账户，作为用户在优迈商城交易及使用优迈商城服务时的唯一身份标识，该账户的用户名和密码由用户负责保管。\n\n2.2 用户使用优迈商城服务时，应谨慎、合理、安全地保存和使用用户名及密码，用户应对以其用户名和密码进行的操作和交易活动负责。用户如发现任何非法使用用户帐号或存在安全漏洞的情况，应立即通知大数据电子商务有限公司并向公安机关报案。\n\n　　三、用户信息\n3.1 基于大数据电子商务有限公司所提供的网络服务的重要性，用户同意：（1）提供真实、准确、完整、合法有效的个人资料；（2）用户有义务维护并更新用户资料，确保其为真实、准确、最新及完整。\n\n3.2 如用户提供任何错误、虚假、过时或不完整的资料，或者大数据电子商务有限公司有合理的理由怀疑资料为错误、虚假、过时或不完整，大数据电子商务有限公司有权暂停或终止用户的账户，并拒绝用户使用本服务的部分或全部功能。大数据电子商务有限公司不承担任何责任，用户同意负担因此所产生的直接或间接的任何支出。\n\n3.3 尊重用户个人隐私是大数据电子商务有限公司的基本原则。对用户在优迈商城进行浏览、下单购物等活动时，涉及的用户真实姓名（名称）、通信地址、联系电话、电子邮箱等隐私信息的，大数据电子商务有限公司将予以严格保密，除非得到用户的授权或法律另有规定，大数据电子商务有限公司不会向外界披露用户隐私信息。\n\n　　四、商品交易\n4.1 商品的基本信息、价格和可获性等信息均在优迈商城上标明并随时变动更新，对此类信息变动大数据电子商务有限公司不作特别通知。\n\n4.2 优迈商城上展示的商品的基本信息、价格和可获性等信息仅为要约邀请；用户的订单为订购商品的要约；大数据电子商务有限公司向用户发出订单确认及商品出库的电子邮件，或直接将商品发送至用户指定的收货地址时，构成大数据电子商务有限公司对该订单的承诺，此时商品订购合同即告成立。\n\n4.3 如果用户在一份订单里订购了多种商品并且大数据电子商务有限公司只发出了部分商品出库的电子邮件，则只有这部分商品的订购合同成立；直到大数据电子商务有限公司向用户发出其他商品出库的电子邮件，用户与大数据电子商务有限公司关于其他商品的订购合同才成立。\n\n4.4 大数据电子商务有限公司保留对商品订购数量的限制权。用户在下订单时，承诺具有订购相应商品的权利能力和行为能力，并且对在订单中提供的所有信息的真实性负责。\n\n4.5 用户可以随时登录在优迈商城注册的账户，查询订单状态。\n\n4.6 商品的价格都包含了增值税。如果发生了意外情况，在确认了用户的订单后，由于供应商提价，税额变化引起的价格变化，或是由于网站的错误等造成商品价格变化，用户有权取消订单，并希望用户能及时通过电子邮件或电话通知大数据电子商务有限公司客户服务部。\n\n4.7 用户所订购的商品，如果发生缺货，用户有权取消定单。\n\n4.8 在下列情况下，用户有权取消订单：\n4.8.1 经用户和大数据电子商务有限公司协商达成一致的；\n4.8.2 大数据电子商务有限公司就用户提交的订单做出承诺前；\n4.8.3 优迈商城公布的商品价格发生变化或错误，用户在大数据电子商务有限公司发货之前通知大数据电子商务有限公司的。\n\n4.9 在下列情况下，大数据电子商务有限公司有权取消订单：\n4.9.1 经用户和大数据电子商务有限公司协商达成一致的；\n4.9.2 优迈商城显示的商品信息明显错误或缺货的；\n4.9.3 用户订单信息明显错误或订货量超出大数据电子商务有限公司存货量；\n4.9.4 因不可抗力、优迈商城发生系统故障或遭受第三方攻击，以及大数据电子商务有限公司无法控制的其他情形。\n\n　　五、商品配送\n5.1 大数据电子商务有限公司将把商品送到用户指定的送货地址。所有在优迈商城上列出的送货时间均为参考时间，参考时间的计算是根据库存状况、正常的处理过程和送货时间、送货地点的基础上估计得出的。\n\n5.2 送货费用根据用户选择的配送方式不同而有所差异。\n\n5.3 为保证大数据电子商务有限公司能准确及时将商品送达，用户应清楚准确地填写用户或收货人的真实姓名、收货地址及联系方式等信息。\n\n5.4 因如下情况造成订单延迟或无法配送等，大数据电子商务有限公司将不承担责任：\n5.4.1 用户提供错误信息或不详细的地址，导致商品无法投递；\n5.4.2 商品送达无人签收，由此造成的重复配送所产生的费用及相关的后果；\n5.4.3 不可抗力事件，如自然灾害、交通戒严、罢工、骚乱、突发战争等。\n\n　　六、服务规则\n6.1 价格信息\n6.1.1 大数据电子商务有限公司将尽最大努力保证用户所购商品与网站上公布的价格一致，但价目表并不构成要约。尽管做出最大的努力，但因互联网技术等客观原因，优迈商城的部分商品可能会有定价错误。如果发现错误定价，优迈商城有权采取下列措施之一：\n6.1.1.1 如果某一商品的正确定价低于错误定价，大数据电子商务有限公司将按照较低的定价向用户销售该商品；\n6.1.1.2 如果某一商品的正确定价高于错误定价，大数据电子商务有限公司将根据具体情况，在交付前联系用户寻求指示, 或者取消订单并通知用户。\n\n6.2 商品缺货\n6.2.1 如果用户拟购买的商品发生缺货，则用户和大数据电子商务有限公司均有权取消该订单。\n6.2.2 大数据电子商务有限公司可对缺货商品进行预售登记，并尽最大努力在最短时间内满足用户的购买需求。当缺货商品到货，民族将第一时间通过邮件、短信或电话通知用户，方便用户进行购买。预售登记并不做订单处理，不构成要约。\n\n6.3 服务通知\n6.3.1 用户同意，大数据电子商务有限公司有通过邮件、短信、电话等形式，向用户及收货人发送订单信息、促销活动信息等通知的权利。\n6.3.2 如果用户不想接收除订单以外的邮件和短信，可以办理退阅。\n\n6.4 退换货/补货/退款\n6.4.1 大数据电子商务有限公司保留对商品退换货、补货的解释权和限制权。下订单即表明接受优迈商城的退换货、补货规则。退换货、补货规则具体以优迈商城公布内容为准。\n6.4.2 因退换货产生的退款，退回方式视用户的支付方式不同而有所区别：\n6.4.2.1 网上支付的订单，退款退回至原支付卡；\n6.4.2.2 银行转账支付的订单，退款退回至支付订单的账户中；\n6.4.2.3 现金支付的，则退还现金给用户。\n\n6.5 规则变更\n6.5.1 大数据电子商务有限公司可以根据需要变更本服务规则。对服务规则的修改和变更将被包含在优迈商城更新后的规则中。所有变更具有可分性，如果部分变更或条款被认定为无效的，不影响其他变更或条款的有效性。\n6.5.2 用户在使用优迈商城提供的各项服务时，承诺接受并遵守各项相关规则的规定。大数据电子商务有限公司有权根据需要不时地制定、修改本协议或各类规则，如本协议有任何变更，大数据电子商务有限公司将在网站重要页面上提示修改内容。如果用户不同意相关变更，则应当停止使用优迈商城服务。经修订的协议及服务规则一经在网站公布后，则立即生效。登录或继续使用优迈商城服务表示用户同意接受修订的后的协议或规则。\n\n　　七、责任限制\n7.1 在法律法规允许的限度内，因使用优迈商城服务而引起的任何损害或经济损失，大数据电子商务有限公司承担的全部责任均不超过用户所购买的与该索赔有关的商品金额。\n\n7.2 除非另有书面说明，大数据电子商务有限公司不对优迈商城的运营及其包含的信息、内容、材料、产品（包括软件）或服务作任何形式的、明示或默示的声明或担保。\n\n7.3 大数据电子商务有限公司不担保优迈商城提供给用户的全部信息，从优迈商城或其服务器发出的电子邮件、信息等没有病毒或其他有害成份。\n\n7.4 如因不可抗力或其他大数据电子商务有限公司无法控制的原因使优迈商城系统崩溃或无法正常使用导致网上交易无法完成或丢失有关的信息、记录等，大数据电子商务有限公司不承担责任。但是大数据电子商务有限公司会尽可能合理地协助处理善后事宜，并努力使用户免受经济损失。\n\n　　八、终止服务\n8.1 如用户向大数据电子商务有限公司提出注销用户帐号时，经大数据电子商务有限公司审核同意后予以注销其帐号，用户即解除与大数据电子商务有限公司的服务协议关系。但注销该用户帐号后，大数据电子商务有限公司仍保留以下权利：\n8.1.1 大数据电子商务有限公司有权保留该用户的注册信息及以前的交易信息；\n8.1.2 如用户在注销前在优迈商城上存在违法行为或违反本协议的行为，大数据电子商务有限公司仍可行使本协议所规定的权利。\n\n8.2 下列情形，大数据电子商务有限公司可以通过注销用户的方式终止服务：\n8.2.1 用户违反本协议相关规定，大数据电子商务有限公司有权终止向该用户提供服务。\n8.2.2 大数据电子商务有限公司发现用户注册信息中主要内容是虚假的，大数据电子商务有限公司有权随时终止向该用户提供服务。\n8.2.3 本协议终止或更新时，用户不愿接受新的服务协议的。\n\n　　九、用户管理\n9.1 用户不得在优迈商城发表包含以下内容的言论：\n9.1.1 反对宪法所确定的基本原则，煽动、抗拒、破坏宪法和法律、行政法规实施的；\n9.1.2 煽动颠覆国家政权，推翻社会主义制度，煽动、分裂国家，破坏国家统一的；\n9.1.3 损害国家荣誉和利益的；\n9.1.4 煽动民族仇恨、民族歧视，破坏民族团结的；\n9.1.5 任何包含对种族、性别、宗教、地域内容等歧视的；\n9.1.6 捏造或者歪曲事实，散布谣言，扰乱社会秩序的；\n9.1.7 宣扬封建迷信、邪教、淫秽、色情、赌博、暴力、凶杀、恐怖、教唆犯罪的；\n9.1.8 公然侮辱他人或者捏造事实诽谤他人的，或者进行其他恶意攻击的；\n9.1.9 其他违反宪法和法律法规的。\n\n9.2 用户同意严格遵守以下义务：\n9.2.1 不得利用优迈商城从事洗钱、窃取商业秘密、窃取个人信息等违法犯罪活动；\n9.2.2 不得干扰优迈商城的正常运营，不得侵入网站及计算机信息系统；\n9.2.3 不得利用在优迈商城注册的账户进行牟利性经营活动；\n9.2.4 不得发布任何侵犯他人著作权、商标权等知识产权或其他合法权利的内容。\n\n9.3 如用户未遵守以上规定的，大数据电子商务有限公司有权作出独立判断并采取暂停或注销用户账户等措施。用户对自己在网上的言论和行为独立承担法律责任。\n\n　　十、知识产权\n10.1 优迈商城的所有内容诸如文字、图表、标识、声音、图片、数字下载、数据编辑和软件、商标等全部内容，均是优迈商城或其内容提供者的财产，受著作权、商标及其他知识产权法律的保护。未经优迈商城或其内容提供者的书面授权或许可，任何人不得以任何目的进行复制、复印等或以其他方式加以利用。\n\n10.2 大数据电子商务有限公司有权将用户在优迈商城发表的商品使用体验、商品讨论或图片进行使用或者与其他人合作使用，使用范围包括但不限于网站、电子杂志、杂志、刊物等，使用时需为作者署名，以用户发表文章时注明的署名为准。作品有附带版权声明者除外。\n\n10.3 除法律另有强制性规定外，未经大数据电子商务有限公司明确的特别书面许可，任何单位或个人不得以任何方式非法地全部或部分复制、转载、引用、链接、抓取或以其他方式使用优迈商城的信息内容。\n\n　　十一、法律适用和争议管辖\n11.1 本协议的订立、执行和解释及争议的解决均应适用中华人民共和国法律。\n\n11.2 如发生大数据电子商务有限公司服务条款与中国法律相抵触时，则该等条款将按法律规定解释，而其他条款继续有效。\n\n11.3 如用户与大数据电子商务有限公司就本协议内容或其履行等发生的一切争议，双方应努力通过友好协商解决；协商不能解决时，任何一方均应将争议提交优迈科研服务平台所在地有管辖权的人民法院诉讼解决。',0,'优迈商城','优迈商城','优迈商城','2018-05-14 22:37:56','2018-01-26 15:59:59',NULL);

#
# Structure for table "t_cart_info"
#

DROP TABLE IF EXISTS `t_cart_info`;
CREATE TABLE `t_cart_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `user_id` int(11) DEFAULT NULL COMMENT '用户id (t_user_info->id)',
  `goods_id` int(11) DEFAULT NULL COMMENT '商品编号 (t_goods_info->id)',
  `count` int(11) DEFAULT NULL COMMENT '数量',
  `updated_at` datetime DEFAULT NULL COMMENT '修改时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='购物车表';

#
# Data for table "t_cart_info"
#

INSERT INTO `t_cart_info` VALUES (1,14,13,1,'2018-03-16 13:20:18','2018-03-07 09:48:18','2018-03-16 13:20:18'),(2,14,23,2,'2018-03-18 17:44:23','2018-03-07 09:51:27','2018-03-18 17:44:23'),(4,14,26,1,'2018-03-17 15:07:57','2018-03-07 12:02:37','2018-03-17 15:07:57'),(6,13,29,1,'2018-03-08 13:11:08','2018-03-08 13:11:08',NULL),(7,14,13,11,'2018-03-18 22:22:00','2018-03-08 14:08:28','2018-03-18 22:22:00'),(8,14,37,1,'2018-04-19 22:42:59','2018-03-08 14:31:20','2018-04-19 22:42:59'),(10,14,15,2,'2018-03-18 22:22:01','2018-03-09 14:43:44','2018-03-18 22:22:01'),(12,14,13,1,'2018-03-18 22:20:40','2018-03-14 20:48:48','2018-03-18 22:20:40'),(13,14,26,2,'2018-04-19 22:42:40','2018-03-14 21:01:35','2018-04-19 22:42:40'),(14,14,15,1,'2018-03-18 22:17:02','2018-03-15 20:10:44','2018-03-18 22:17:02'),(15,14,13,1,'2018-03-16 10:19:20','2018-03-15 20:12:36','2018-03-16 10:19:20'),(16,14,26,1,'2018-03-18 22:17:02','2018-03-15 20:38:31','2018-03-18 22:17:02'),(17,14,37,2,'2018-03-16 09:55:24','2018-03-15 22:21:00','2018-03-16 09:55:24'),(18,14,1,1,'2018-03-16 18:08:20','2018-03-16 18:08:00','2018-03-16 18:08:20'),(19,14,1,192,'2018-03-18 22:22:01','2018-03-17 09:23:07','2018-03-18 22:22:01'),(20,14,17,67,'2018-03-18 10:00:37','2018-03-17 09:50:17','2018-03-18 10:00:37'),(21,14,17,1,'2018-03-18 10:00:47','2018-03-18 10:00:40','2018-03-18 10:00:47'),(22,14,2,3,'2018-03-18 22:36:54','2018-03-18 22:33:47','2018-03-18 22:36:54'),(23,14,1,1,'2018-03-18 22:36:54','2018-03-18 22:36:44','2018-03-18 22:36:54'),(24,14,2,1,'2018-03-18 22:40:51','2018-03-18 22:40:25','2018-03-18 22:40:51'),(25,14,2,1,'2018-03-18 22:42:46','2018-03-18 22:41:20','2018-03-18 22:42:46'),(26,14,13,1,'2018-03-18 22:42:46','2018-03-18 22:42:26','2018-03-18 22:42:46'),(27,14,2,1,'2018-03-18 22:46:43','2018-03-18 22:46:21','2018-03-18 22:46:43'),(28,14,1,2,'2018-03-18 22:46:44','2018-03-18 22:46:35','2018-03-18 22:46:44'),(29,14,2,2,'2018-03-18 22:47:28','2018-03-18 22:47:20','2018-03-18 22:47:28'),(30,14,2,1,'2018-03-18 22:48:27','2018-03-18 22:47:44','2018-03-18 22:48:27'),(31,14,30,1,'2018-03-18 22:48:28','2018-03-18 22:48:19','2018-03-18 22:48:28'),(32,20,17,2,'2018-03-20 10:37:30','2018-03-20 10:37:01','2018-03-20 10:37:30'),(33,20,17,2,'2018-03-20 10:42:03','2018-03-20 10:39:19','2018-03-20 10:42:03'),(34,20,17,1,'2018-03-20 10:42:28','2018-03-20 10:42:19','2018-03-20 10:42:28'),(35,20,40,6,'2018-03-20 10:54:09','2018-03-20 10:49:59','2018-03-20 10:54:09'),(36,22,40,1,'2018-03-20 11:03:20','2018-03-20 11:03:20',NULL),(37,23,40,1,'2018-03-20 17:10:55','2018-03-20 17:07:24','2018-03-20 17:10:55'),(38,23,40,1,'2018-04-01 23:05:59','2018-03-20 17:49:33','2018-04-01 23:05:59'),(39,18,40,18,'2018-03-25 22:29:57','2018-03-25 16:45:19','2018-03-25 22:29:57'),(40,20,15,1,'2018-03-26 10:26:19','2018-03-26 10:24:15','2018-03-26 10:26:19'),(41,18,40,5,'2018-03-26 11:02:39','2018-03-26 11:02:30',NULL),(42,24,40,5,'2018-03-26 16:37:35','2018-03-26 16:34:23','2018-03-26 16:37:35'),(43,24,40,5,'2018-03-26 16:58:39','2018-03-26 16:57:44',NULL),(44,23,40,1,'2018-04-01 23:39:40','2018-04-01 23:37:36','2018-04-01 23:39:40'),(45,23,40,1,'2018-04-04 22:41:31','2018-04-04 22:41:02','2018-04-04 22:41:31'),(46,23,40,1,'2018-04-09 19:07:58','2018-04-09 19:07:44','2018-04-09 19:07:58'),(47,14,68,1,'2018-04-20 17:15:19','2018-04-20 17:15:12','2018-04-20 17:15:19'),(48,14,68,1,'2018-04-20 21:02:07','2018-04-20 21:01:59','2018-04-20 21:02:07'),(49,14,68,4,'2018-04-20 21:42:26','2018-04-20 21:41:40','2018-04-20 21:42:26'),(50,14,25,1,'2018-04-20 21:47:35','2018-04-20 21:47:15','2018-04-20 21:47:35'),(51,14,68,1,'2018-04-20 21:47:35','2018-04-20 21:47:28','2018-04-20 21:47:35'),(52,14,68,2,'2018-04-20 21:48:24','2018-04-20 21:48:02','2018-04-20 21:48:24'),(53,14,25,1,'2018-04-20 21:48:24','2018-04-20 21:48:18','2018-04-20 21:48:24'),(54,14,68,1,'2018-04-20 22:17:43','2018-04-20 22:17:25','2018-04-20 22:17:43'),(55,14,25,2,'2018-04-20 22:17:43','2018-04-20 22:17:36','2018-04-20 22:17:43'),(56,14,1,1,'2018-04-20 22:23:30','2018-04-20 22:23:22','2018-04-20 22:23:30'),(57,14,68,1,'2018-05-03 17:42:28','2018-05-03 17:42:23','2018-05-03 17:42:28'),(58,14,68,1,'2018-05-03 17:46:20','2018-05-03 17:46:15','2018-05-03 17:46:20'),(59,23,85,1,'2018-05-13 23:36:38','2018-05-13 23:36:31','2018-05-13 23:36:38'),(60,23,85,3,'2018-05-13 23:41:55','2018-05-13 23:36:49','2018-05-13 23:41:55'),(61,23,81,4,'2018-05-13 23:38:17','2018-05-13 23:37:40','2018-05-13 23:38:17'),(62,18,116,1,'2018-06-19 14:06:59','2018-06-19 14:06:59',NULL);

#
# Structure for table "t_chem_class_info"
#

DROP TABLE IF EXISTS `t_chem_class_info`;
CREATE TABLE `t_chem_class_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `menu_id` int(11) DEFAULT NULL COMMENT '二级栏目编号（t_menu_info->id）',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '名称',
  `sub_name` text COLLATE utf8mb4_unicode_ci COMMENT '中文别名',
  `english_name` text COLLATE utf8mb4_unicode_ci COMMENT '英文名称',
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '图片',
  `cas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'CAS号',
  `molecule` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '分子式',
  `hot` tinyint(1) DEFAULT '0' COMMENT '是否热销（0：否；1：是）',
  `sort` int(11) DEFAULT '0' COMMENT '排序（越大越靠前）',
  `f_attribute_ids` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '第一属性（品牌分类）编号集（t_attribute_info->id）',
  `s_attribute_ids` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '第二属性（纯度）编号集（t_attribute_info->id）',
  `seo_title` text COLLATE utf8mb4_unicode_ci COMMENT '网站SEO优化——标题',
  `seo_keywords` text COLLATE utf8mb4_unicode_ci COMMENT '网站SEO优化——关键字',
  `seo_description` text COLLATE utf8mb4_unicode_ci COMMENT '网站SEO优化——描述',
  `updated_at` datetime DEFAULT NULL COMMENT '修改时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='化学商品种类表';

#
# Data for table "t_chem_class_info"
#

INSERT INTO `t_chem_class_info` VALUES (1,4,'二氧化锰','二氧化锰','Manganese(IV) oxide[1]','http://dsyy.isart.me/o_1cd9hgehp11651mpo59t7cupmb9.png','1313-13-9','MnO2',1,1,'6,8,7','9,22,28,26',NULL,NULL,NULL,'2018-05-19 20:02:25','2018-05-10 14:19:53',NULL),(2,4,'乙醇','酒精','ethyl alcohol absolute','http://dsyy.isart.me/o_1cd4n22lkblv1jdj13t21mph1l219.png','64-17-5','C2H6O',0,1,'6,30','9,26',NULL,NULL,NULL,'2018-05-19 22:00:41','2018-05-10 17:46:47',NULL),(3,4,'无水硫酸铜','无水硫酸铜 ;硫酸铜,蓝矾,胆矾,铜矾','Copper sulfate','http://dsyy.isart.me/o_1cd9hasm0ht01v6hhm1n6u13kd9.png','231-159-6','CuSO4',1,1,'6,8','9,11,23,26',NULL,NULL,NULL,'2018-05-15 22:53:10','2018-05-10 21:27:17',NULL),(4,4,'硫酸铜，五水合物','硫酸铜，五水 ;结晶硫酸铜,蓝矾,胆矾,孔雀石','Copper sulfate pentahydrate','http://dsyy.isart.me/o_1cd9h5bq3f76sb512381ba21240e.png','7758-99-8','CuSO4·5H2O',1,4,'8','9,24,26',NULL,NULL,NULL,'2018-05-15 19:28:18','2018-05-11 20:26:14',NULL),(5,5,'烧杯','大口杯','beaker','http://dsyy.isart.me/o_1cd9e29np8vfkup1ihm1vqab979.png',NULL,NULL,1,1,'25','28,0',NULL,NULL,NULL,'2018-05-16 10:04:23','2018-05-12 13:53:52',NULL),(6,6,'电子天平','天平','electronic balance','http://dsyy.isart.me/o_1cd9fv5kljof1a1b1n11oktkeh9.png',NULL,'0',1,1,NULL,NULL,NULL,NULL,NULL,'2018-05-14 22:04:40','2018-05-12 14:18:14',NULL),(7,7,'打印纸A4','打印纸','printing paper','http://dsyy.isart.me/o_1cd9gdjagsrs68j16vt1lv63ha9.png','bg-1','0',1,1,NULL,NULL,NULL,NULL,NULL,'2018-05-12 14:28:03','2018-05-12 14:28:03',NULL),(8,5,'环氧树脂','环氧树脂','Epoxide resin;Araldite','http://dsyy.isart.me/o_1cdsab5t4fqt13621gh7k4gv839.jpg',NULL,NULL,1,1,'30','28',NULL,NULL,NULL,'2018-05-19 21:48:04','2018-05-19 21:45:40',NULL),(9,5,'定性滤纸','定性滤纸','Qualitative filter paper','http://dsyy.isart.me/o_1cdsanje050d5dcca2ta313h39.png',NULL,NULL,0,3,'30','28',NULL,NULL,NULL,'2018-05-19 21:54:33','2018-05-19 21:53:09',NULL),(10,5,'蓝色冷镶模具','蓝色冷镶模具','Blue cold set mould','http://dsyy.isart.me/o_1cdsbglkrtc81ogp1o8p14749lm9.png',NULL,NULL,0,3,NULL,NULL,NULL,NULL,NULL,'2018-05-19 22:05:59','2018-05-19 22:05:59',NULL),(11,5,'称量瓶','称量瓶','Weighing bottle','http://dsyy.isart.me/o_1cdsbkk8ctnq1thpqhijarjnp9.png',NULL,NULL,0,4,NULL,NULL,NULL,NULL,NULL,'2018-05-19 22:08:12','2018-05-19 22:08:12',NULL),(12,5,'容量瓶','容量瓶','Volumetric flask','http://dsyy.isart.me/o_1cdsc515113qa18fc1qu2s3t3tp9.png',NULL,NULL,0,1,NULL,NULL,NULL,NULL,NULL,'2018-05-19 22:17:10','2018-05-19 22:17:10',NULL),(13,5,'量筒','量筒','Measuring cylinder','http://dsyy.isart.me/o_1cdscge74vgc10il11jn16ka4g99.png',NULL,NULL,0,1,NULL,NULL,NULL,NULL,NULL,'2018-05-19 22:23:17','2018-05-19 22:23:17',NULL),(14,5,'培养皿','培养皿','Petri dishes','http://dsyy.isart.me/o_1cdsclrtjqo41ne1nna11oshuk9.png',NULL,NULL,0,1,NULL,NULL,NULL,NULL,NULL,'2018-05-19 22:26:18','2018-05-19 22:26:18',NULL),(15,4,'玻璃漏斗','玻璃漏斗','Glass funnel','http://dsyy.isart.me/o_1cdscri15di91stp1elnel01a439.png',NULL,NULL,0,1,NULL,NULL,NULL,NULL,NULL,'2018-05-19 22:29:18','2018-05-19 22:29:18',NULL),(16,4,'砂纸','砂纸','sandpaper','http://dsyy.isart.me/o_1cdsd0o45157e16u8180p1ivb1djq9.png',NULL,NULL,0,1,NULL,NULL,NULL,NULL,NULL,'2018-05-19 22:32:11','2018-05-19 22:32:11',NULL),(17,5,'橡胶手套','橡胶手套','Rubber gloves','http://dsyy.isart.me/o_1cdse434rlqomu34ug1ar32j9.png',NULL,NULL,0,2,NULL,NULL,NULL,NULL,NULL,'2018-05-19 22:51:30','2018-05-19 22:51:30',NULL),(18,4,'金刚石研磨膏','金刚石研磨膏','Diamond paste','http://dsyy.isart.me/o_1cdsecn261pio1q8e1fdk1ejq1e199.jpg',NULL,NULL,0,1,NULL,NULL,NULL,NULL,NULL,'2018-05-19 22:56:22','2018-05-19 22:56:22',NULL),(19,4,'抛光盘','抛光盘','Polishing plate','http://dsyy.isart.me/o_1cdut82ch1n2d10561c6a1thp1rka9.png',NULL,NULL,0,2,NULL,NULL,NULL,NULL,NULL,'2018-05-20 21:55:01','2018-05-20 21:55:01',NULL),(20,4,'氢氧化钠','氢氧化钠','Sodium hydroxide','http://dsyy.isart.me/o_1cdutfi0mcs5kjc1aeshr47p39.png','1310-73-2','NaOH',0,1,NULL,NULL,NULL,NULL,NULL,'2018-05-20 21:59:20','2018-05-20 21:59:20',NULL),(21,4,'氢氧化钾','氢氧化钾 ;苛性钾','Potassium hydroxide','http://dsyy.isart.me/o_1cdutp8a5e0roe21u46teov629.png','1310-58-3','KOH',0,5,NULL,NULL,NULL,NULL,NULL,'2018-05-20 22:03:53','2018-05-20 22:03:53',NULL),(22,4,'硫酸铵','硫酸铵','Ammonium Sulfate','http://dsyy.isart.me/o_1cdutsp76nna7sf2og182n1nlo9.png','7783-20-2','H8N2O4S',0,1,NULL,NULL,NULL,NULL,NULL,'2018-05-20 22:05:56','2018-05-20 22:05:56',NULL),(23,4,'硫酸镍','无水硫酸镍','Nickel(II) sulfate','http://dsyy.isart.me/o_1cduu3sh91o191a2sc8n15vrm0l9.png','7786-81-4','NiSO4',0,3,NULL,NULL,NULL,NULL,NULL,'2018-05-20 22:11:09','2018-05-20 22:11:09',NULL),(24,4,'无水碳酸钠','无水碳酸钠 ;碳酸钠,纯碱,苏打,食用纯碱','Sodium carbonate anhydrous','http://dsyy.isart.me/o_1cduuct841vkllf3q2kkkfikt9.png','497-19-8','Na2CO3',0,1,NULL,NULL,NULL,NULL,NULL,'2018-05-20 22:14:48','2018-05-20 22:14:48',NULL),(25,4,'乙酸钠,无水','乙酸钠，无水 ;乙酸钠,醋酸钠','Sodium acetate anhydrous','http://dsyy.isart.me/o_1cduuj1cqpda1ccpkksrcg18ut9.png','127-09-3','C2H3NaO2',0,1,NULL,NULL,NULL,NULL,NULL,'2018-05-20 22:19:04','2018-05-20 22:19:04',NULL),(26,4,'冰乙酸','Acetic acid glacial ;冰醋酸，乙酸','Acetate','http://dsyy.isart.me/o_1cduv06mi1f91661u4sobc8iv9.png','64-19-7','C2H4O2',0,1,NULL,NULL,NULL,NULL,NULL,'2018-05-20 22:26:02','2018-05-20 22:26:02',NULL),(27,4,'氯化钠','氯化钠 ;食盐','Sodium chloride','http://dsyy.isart.me/o_1cdv06s5b1dnr1s6segndnilq89.png','7647-14-5','NaCl',0,1,NULL,NULL,NULL,NULL,NULL,'2018-05-20 22:47:18','2018-05-20 22:47:18',NULL),(28,4,'氯化钾','氯化钾','Sodium chloride','http://dsyy.isart.me/o_1cdv0cg70alj1h2o1bi4kdhv3s9.png','7447-40-7','231-791-2',0,1,NULL,NULL,NULL,NULL,NULL,'2018-05-20 22:50:19','2018-05-20 22:50:19',NULL);

#
# Structure for table "t_comment_info"
#

DROP TABLE IF EXISTS `t_comment_info`;
CREATE TABLE `t_comment_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `user_id` int(11) DEFAULT NULL COMMENT '会员编号（t_user_info->id）',
  `content` text COLLATE utf8mb4_unicode_ci COMMENT '内容',
  `status` tinyint(1) DEFAULT '0' COMMENT '审核状态（0：未通过；1：通过）',
  `goods_id` int(11) DEFAULT NULL COMMENT '商品编号（t_goods_info->id）',
  `updated_at` datetime DEFAULT NULL COMMENT '修改时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='评论表';

#
# Data for table "t_comment_info"
#

INSERT INTO `t_comment_info` VALUES (1,14,'测试',1,41,'2018-04-10 16:16:45','2018-04-10 16:00:36',NULL),(2,14,'《后汉书·党锢传·范滂》：“君为人臣，不惟忠国，而共造部党，自相褒举，评论朝廷。”\n　　唐 吕岩《七言》诗之一：“此道非从它外得，千言万语谩评论。”\n　　《红楼梦》第五十回：“ 黛玉 写毕， 湘云 大家纔评论时，只见几个丫鬟跑进来道：‘老太太来了！’”\n　　巴金《观察人》：“不久前有两位读者寄给我他们写的评论我的文章。”',1,41,'2018-04-13 17:38:27','2018-04-13 17:38:27',NULL),(3,14,'123',1,41,'2018-04-16 16:38:15','2018-04-16 16:38:15',NULL),(4,14,'好评',1,41,'2018-04-16 16:39:20','2018-04-16 16:39:20',NULL),(5,14,'灰常满意',1,41,'2018-04-16 16:41:27','2018-04-16 16:41:27',NULL),(6,14,'老顾客了',0,41,'2018-04-16 16:47:52','2018-04-16 16:47:52',NULL),(7,14,'非常好',1,41,'2018-05-13 23:28:59','2018-04-16 16:48:41',NULL),(8,14,'良心企业',1,25,'2018-05-13 14:13:44','2018-04-16 16:50:04',NULL),(9,14,'第二次合作了，非常满意^_^',1,3,'2018-04-17 13:44:07','2018-04-16 16:52:05',NULL),(10,14,'挺好的',1,16,'2018-04-16 16:57:38','2018-04-16 16:56:00',NULL),(11,23,'很好',0,86,'2018-05-14 22:42:36','2018-05-14 22:42:36',NULL),(12,23,'很好',0,86,'2018-05-14 22:44:59','2018-05-14 22:44:59',NULL),(13,23,'好',0,86,'2018-05-21 20:02:37','2018-05-21 20:02:37',NULL),(14,23,'好',0,86,'2018-05-21 20:03:16','2018-05-21 20:03:16',NULL),(15,23,'公共',1,86,'2018-05-21 23:26:51','2018-05-21 23:24:43',NULL);

#
# Structure for table "t_drawing_info"
#

DROP TABLE IF EXISTS `t_drawing_info`;
CREATE TABLE `t_drawing_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '用户编号（t_user_info->id）',
  `content` text COLLATE utf8mb4_unicode_ci COMMENT '内容',
  `status` tinyint(1) DEFAULT '0' COMMENT '状态（0：未联系；1：已联系；2：处理中；3：已处理）',
  `remarks` text COLLATE utf8mb4_unicode_ci COMMENT '备注',
  `updated_at` datetime DEFAULT NULL COMMENT '修改时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='用户上传的机加工图纸';

#
# Data for table "t_drawing_info"
#

INSERT INTO `t_drawing_info` VALUES (1,14,'http://dsyy.isart.me/o_1c7t3063mc1ah241e5fq47ina.png,http://dsyy.isart.me/o_1c7t3063mejbm0f1d8n1g61ofjb.png',3,'第一张是正面图，第二张是俯视图，缺左视图','2018-04-09 11:07:37','2018-03-06 15:21:54','2018-04-09 11:07:37'),(2,14,'http://dsyy.isart.me/o_1c7t7lrb612mvcke1nkmam91bqsj.png,http://dsyy.isart.me/o_1c7t7m06q1ct7dfq8p711jgl03o.png,http://dsyy.isart.me/o_1c7t7m5a2ugi75jdu7167rupt.png',0,'要求7天完成','2018-04-09 11:07:37','2018-03-06 16:43:49','2018-04-09 11:07:37'),(3,13,'http://dsyy.isart.me/o_1c7t91mk6115ti361o3621g8n9.jpg,http://dsyy.isart.me/o_1c7t91rok18m41ud0saa1mp11f8oe.jpg,http://dsyy.isart.me/o_1c7t9293919cgarni84s451lrgo.jpg',0,'要求：2018年3月20日前发货，（回购三次的老客户）赠送精美礼品一份\n紧急联系电话：68686688','2018-04-09 11:07:37','2018-03-06 17:06:55','2018-04-09 11:07:37'),(4,18,'http://dsyy.isart.me/o_1cao38mus4n71h091uoc1uo81h9.jpg',0,NULL,'2018-04-11 13:30:50','2018-04-10 23:37:30','2018-04-11 13:30:50');

#
# Structure for table "t_friendship_info"
#

DROP TABLE IF EXISTS `t_friendship_info`;
CREATE TABLE `t_friendship_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '名称',
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '图片',
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '链接地址',
  `sort` int(11) DEFAULT NULL COMMENT '0',
  `updated_at` datetime DEFAULT NULL COMMENT '修改时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='外链表';

#
# Data for table "t_friendship_info"
#

INSERT INTO `t_friendship_info` VALUES (1,'SCI-HUB','http://dsyy.isart.me/o_1c8v9ei4i1u1o1a6p1n5k1vu3v199.jpg','http://sci-hub.hk/',0,'2018-03-25 17:07:57','2018-03-18 16:11:05',NULL);

#
# Structure for table "t_goods_case_info"
#

DROP TABLE IF EXISTS `t_goods_case_info`;
CREATE TABLE `t_goods_case_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `goods_id` int(11) DEFAULT NULL COMMENT '商品编号（t_goods_info->id）',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '名称',
  `content` text COLLATE utf8mb4_unicode_ci COMMENT '内容',
  `sort` int(11) DEFAULT '0' COMMENT '排序（正常排序）',
  `updated_at` datetime DEFAULT NULL COMMENT '修改时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT COMMENT='商品案例表';

#
# Data for table "t_goods_case_info"
#

INSERT INTO `t_goods_case_info` VALUES (1,18,'测试','http://dsyy.isart.me/o_1c6ut2eqa1lhq191db83j9s8gdr.jpg',1,'2018-01-31 15:34:15','2018-01-31 15:15:35',NULL),(2,18,'例子','http://dsyy.isart.me/o_1c6ut480m6l210uopb819vn1v0ur.jpg',0,'2018-01-31 15:34:12','2018-01-31 15:16:49',NULL),(4,27,'例子','http://dsyy.isart.me/o_1c6uqc3fn138o42i15ij15ftbvhr.jpg',1,'2018-02-22 21:39:43','2018-02-22 21:13:54',NULL),(5,27,'例子2','http://dsyy.isart.me/o_1c6ur5cvltb0ecmt8v19bmsgcr.jpg',0,'2018-02-22 21:40:02','2018-02-22 21:27:56',NULL),(6,27,'例子3','http://dsyy.isart.me/o_1c6ur9c971brq10dr1auu1ctdgksr.png',2,'2018-02-22 21:30:04','2018-02-22 21:30:04',NULL),(7,27,'测试','http://dsyy.isart.me/o_1c6ussvmefve41tdko4o128hr.jpg',3,'2018-02-22 21:58:11','2018-02-22 21:58:11',NULL),(8,16,'龙','http://dsyy.isart.me/o_1c6ut2eqa1lhq191db83j9s8gdr.jpg',1,'2018-02-22 22:01:10','2018-02-22 22:01:10',NULL),(9,16,'蝴蝶','http://dsyy.isart.me/o_1c6ut480m6l210uopb819vn1v0ur.jpg',2,'2018-02-22 22:02:07','2018-02-22 22:02:07',NULL),(10,16,'镂空雕花','http://dsyy.isart.me/o_1c6utk0ek1pjp10rj17kfotf14upr.jpg',2,'2018-02-22 22:10:48','2018-02-22 22:10:48',NULL),(11,16,'镂空圆盘','http://dsyy.isart.me/o_1c6utkmkh1s97vbn16io114i1n0q10.jpg',3,'2018-02-22 22:11:15','2018-02-22 22:11:15',NULL),(12,83,'304不锈钢-表面不处理','http://dsyy.isart.me/o_1cd9llj0ouad19ouakd1tetfpn17.jpg',0,'2018-05-12 15:58:17','2018-05-12 15:58:17',NULL);

#
# Structure for table "t_goods_chem_attribute_info"
#

DROP TABLE IF EXISTS `t_goods_chem_attribute_info`;
CREATE TABLE `t_goods_chem_attribute_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `goods_id` int(11) DEFAULT NULL COMMENT '对应的商品编号（t_goods_info->id）',
  `spec` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '规格',
  `delivery` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '货期',
  `depot` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '仓库',
  `merchant` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '品牌商户号',
  `molecular` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '分子量',
  `accurate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '精确量',
  `chem_class_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '化学商品种类编号（t_chem_class_info->id）',
  `updated_at` datetime DEFAULT NULL COMMENT '修改时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='化学试剂商品属性表';

#
# Data for table "t_goods_chem_attribute_info"
#

INSERT INTO `t_goods_chem_attribute_info` VALUES (1,70,'5g','98% metals basis','1号','M101140-5g','86.94','86.94','1','2018-05-19 20:08:28','2018-05-10 14:22:19',NULL),(2,71,'瓶','AR','500','yc001','46.07','46.07','2','2018-05-19 22:00:41','2018-05-10 17:49:08',NULL),(3,72,'500g','3','1','C805233-500g','159.61','159.61','3','2018-05-11 20:05:10','2018-05-10 21:29:18',NULL),(4,77,'5g','3','1','C805782-10g','159.61','159.61','3','2018-05-10 21:42:06','2018-05-10 21:42:06',NULL),(5,78,'10g','3','1','C805782-10g','159.61','159.61','3','2018-05-11 20:11:46','2018-05-11 20:10:26',NULL),(6,79,'500g','3','2','M812762-500g','86.94','86.94','1','2018-05-19 20:28:53','2018-05-11 20:17:32','2018-05-19 20:28:53'),(7,80,'99%-500g','3','1','C805353-500g','249.69','249.69','4','2018-05-15 23:09:23','2018-05-11 20:29:43',NULL),(8,81,'500g','3','1','C805354-500g','249.69','249.69','4','2018-05-11 20:31:55','2018-05-11 20:31:55',NULL),(9,85,'250ml','3','3','2','33','33','5','2018-05-14 17:27:06','2018-05-13 22:50:24','2018-05-14 17:27:06'),(10,86,'25ml','玻璃','2号',NULL,NULL,NULL,'5','2018-05-19 20:51:02','2018-05-14 18:18:09',NULL),(11,87,'25g','CP','1号','M101137-25g','86.94','86.94','1','2018-05-19 19:59:24','2018-05-19 19:59:24',NULL),(12,88,'500g','AR,85%','1号','M101135-500g','86.94','86.94','1','2018-05-19 20:02:25','2018-05-19 20:02:25',NULL),(13,89,'2.5KG','AR,85%','1号','M101135-2.5kg','86.94','86.94','1','2018-05-19 20:04:39','2018-05-19 20:04:39',NULL),(14,90,'25g','99.95% metals basis','1号','M101140-25g','86.94','86.94','1','2018-05-19 20:10:07','2018-05-19 20:10:07',NULL),(15,91,'100g','98% metals basis','1号','M118109-100g','86.94','86.94','1','2018-05-19 20:12:28','2018-05-19 20:12:28',NULL),(16,92,'2.5g','98% metals basis','1号','M118109-25g','86.94','86.94','1','2018-05-19 20:15:02','2018-05-19 20:15:02',NULL),(17,93,'500g','98% metals basis','1号','M118109-500g','86.95','86.95','1','2018-05-19 20:16:56','2018-05-19 20:16:56',NULL),(18,94,'250g','99% metals basis','1号','M118110-250g','86.94','86.94','1','2018-05-19 20:20:17','2018-05-19 20:20:17',NULL),(19,95,'10g','99% metals basis','1·号','M118110-10g','86.94','86.94','1','2018-05-19 20:22:17','2018-05-19 20:22:17',NULL),(20,96,'50g','99% metals basis','1号','M118110-50g','86.94',NULL,'1','2018-05-19 20:23:30','2018-05-19 20:23:30',NULL),(21,97,'100g','GR,≥90%','1号','M101141','86.94','86.94','1','2018-05-19 20:25:52','2018-05-19 20:25:52',NULL),(22,98,'500g','GR,≥90%','1号','M101141-500g','86.94','86.94','1','2018-05-19 20:27:31','2018-05-19 20:27:31',NULL),(23,99,'500g','AR,85%','1号','M812762-500g','86.94','86.94','1','2018-05-19 20:33:01','2018-05-19 20:33:01',NULL),(24,100,'2.5kg','AR,95%','1号','M812762-2.5kg','86.94','86.94','1','2018-05-19 20:34:14','2018-05-19 20:34:14',NULL),(25,101,'25g','99.95% metals basis','1号','M812765-25g','86.94','86.94','1','2018-05-19 20:36:16','2018-05-19 20:36:16',NULL),(26,102,'5g','99.95% metals basis','1号','M812765-25g','86.94','86.94','1','2018-05-19 20:37:31','2018-05-19 20:37:31',NULL),(27,103,'500g','GR,≥90%','1号','M812766-500g','86.94','86.94','1','2018-05-19 20:39:18','2018-05-19 20:39:18',NULL),(28,104,'10g','99%','21','M813969-10g','86.94','86.94','1','2018-05-19 20:41:39','2018-05-19 20:41:39',NULL),(29,105,'50g','99%','1号','M813969-50g','86.94','86.94','1','2018-05-19 20:42:52','2018-05-19 20:42:52',NULL),(30,106,'25g','99.8% metals basis','1号','M837251-25g','86.94','86.94','1','2018-05-19 20:44:53','2018-05-19 20:44:53',NULL),(31,107,'50ml','玻璃','2号',NULL,NULL,NULL,'5','2018-05-19 20:50:33','2018-05-19 20:50:33',NULL),(32,108,'100ml','玻璃','2号',NULL,NULL,NULL,'5','2018-05-19 20:52:23','2018-05-19 20:52:23',NULL),(33,109,'250ml','玻璃','2号',NULL,NULL,NULL,'5','2018-05-19 20:53:04','2018-05-19 20:53:04',NULL),(34,110,'500ml','玻璃','2号',NULL,NULL,NULL,'5','2018-05-19 20:54:32','2018-05-19 20:54:32',NULL),(35,111,'1000ml','玻璃','2号',NULL,NULL,NULL,'5','2018-05-19 20:55:14','2018-05-19 20:55:14',NULL),(36,112,'2000ml','玻璃','2号',NULL,NULL,NULL,'5','2018-05-19 20:56:02','2018-05-19 20:56:02',NULL),(37,113,'1kg','AB型','2号',NULL,NULL,NULL,'8','2018-05-19 21:48:04','2018-05-19 21:48:04',NULL),(38,114,'9cm','中速','2号',NULL,NULL,NULL,'9','2018-05-19 21:56:58','2018-05-19 21:54:33',NULL),(39,115,'7cm','中速','2号',NULL,NULL,NULL,'9','2018-05-19 21:56:39','2018-05-19 21:55:43',NULL),(40,116,'11cm','中速',NULL,NULL,NULL,NULL,'9','2018-05-19 21:56:23','2018-05-19 21:56:23',NULL),(41,117,'15cm',NULL,NULL,NULL,NULL,NULL,'9','2018-05-19 21:57:46','2018-05-19 21:57:46',NULL),(42,118,'18cm','中速',NULL,NULL,NULL,NULL,'9','2018-05-19 21:58:52','2018-05-19 21:58:52',NULL),(43,119,'12.5cm','中速','2号',NULL,NULL,NULL,'9','2018-05-19 21:59:45','2018-05-19 21:59:45',NULL),(44,120,'500ml','GR','1号',NULL,NULL,NULL,'2','2018-05-19 22:01:49','2018-05-19 22:01:49',NULL);

#
# Structure for table "t_goods_detail_info"
#

DROP TABLE IF EXISTS `t_goods_detail_info`;
CREATE TABLE `t_goods_detail_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `goods_id` int(11) DEFAULT NULL COMMENT '商品编号（t_goods_info->id）',
  `content` text COLLATE utf8mb4_unicode_ci COMMENT '内容',
  `type` tinyint(1) DEFAULT '0' COMMENT '类型（0:文字；1：图片；2：视频）',
  `sort` int(11) DEFAULT '0' COMMENT '排序（正常排序）',
  `updated_at` datetime DEFAULT NULL COMMENT '修改时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='商品详情表';

#
# Data for table "t_goods_detail_info"
#

INSERT INTO `t_goods_detail_info` VALUES (2,5,'http://osc6vvb9q.bkt.clouddn.com/2017-12-31_5a48611131aef.jpg',1,1,'2018-01-30 10:11:46','2018-01-29 15:47:33',NULL),(4,5,'http://dsyy.isart.me/o_1c50h3meelji1j9t53r1fprseag.jpg',1,5,'2018-01-29 17:36:39','2018-01-29 16:39:08',NULL),(5,5,'http://dsyy.isart.me/o_1c50h3vhqi6b15ma28pv321khil.mp4',2,7,'2018-01-29 17:36:39','2018-01-29 16:41:30',NULL),(9,5,'http://dsyy.isart.me/o_1c50jm8lpkjh8ii5j6g4110mig.jpg',1,8,'2018-01-29 17:24:13','2018-01-29 17:24:13',NULL),(10,4,'http://dsyy.isart.me/o_1c50jo68469rlku7o7lqc1unrg.jpg',1,1,'2018-01-30 10:18:22','2018-01-29 17:25:15',NULL),(12,4,'http://dsyy.isart.me/o_1c50jorig1kecm36rl88l1b7ml.mp4',2,2,'2018-01-30 10:18:20','2018-01-29 17:28:23',NULL),(13,18,'CNC又叫做电脑锣、CNCCH或数控机床其实是香港那边的一种叫法，后来传入大陆珠三角，其实就是数控铣床，在广、江浙沪一带有人叫“CNC加工中心”',0,0,'2018-02-22 22:14:37','2018-01-31 13:50:23',NULL),(17,16,'http://dsyy.isart.me/o_1c6utnun410ru1husf3cfq31vco15.jpg',1,1,'2018-04-20 15:53:09','2018-02-22 22:12:48','2018-04-20 15:53:09'),(18,18,'一般CNC加工通常是指精密机械加工、CNC加工车床、CNC加工铣床、CNC加工镗铣床等',0,1,'2018-02-22 22:15:03','2018-02-22 22:15:03',NULL),(19,17,'利用高功率密度激光束照射被切割材料，使材料很快被加热至汽化温度，蒸发形成孔洞，随着光束对材料的移动，孔洞连续形成宽度很窄的（如0．1mm左右）切缝，完成对材料的切割。',0,0,'2018-02-22 23:19:10','2018-02-22 23:19:10',NULL),(20,17,'http://dsyy.isart.me/o_1c6v1ho64ovoe2q33f8sq1248l.jpg',1,1,'2018-02-22 23:19:20','2018-02-22 23:19:20',NULL),(21,23,'我是商品的描述',0,0,'2018-02-23 16:11:05','2018-02-23 16:11:05',NULL),(26,22,'http://dsyy.isart.me/o_1c72r4viv92vot31mkbtoug5rl.png',1,0,'2018-02-24 10:46:33','2018-02-24 10:44:35',NULL),(27,22,'http://dsyy.isart.me/o_1c72r7svte611s9el5t1fbp1v0uq.jpg',1,1,'2018-02-24 10:46:33','2018-02-24 10:46:04',NULL),(33,16,'我是商品描述123',0,0,'2018-04-26 10:02:39','2018-04-20 15:53:20','2018-04-26 10:02:39'),(34,16,'http://dsyy.isart.me/o_1cbvobo7aduucvo1gb17ob1ldd17.jpg',1,1,'2018-04-26 09:54:49','2018-04-26 09:17:08','2018-04-26 09:54:49'),(35,41,'http://dsyy.isart.me/o_1cbvthgid15se1ig41ioe122mk5o11.jpg',1,0,'2018-05-03 15:32:04','2018-04-26 10:47:28','2018-05-03 15:32:04'),(36,41,'①舍利塔滩地公园<br/><br/>地址：皇姑区塔湾街家乐福附近<br/><br/>一座高高的舍利塔，前面是木质的小桥和回廊，还有几座古色古香的寺庙，不知道的还以为是影视基地！其实这座舍利塔可是沈阳最古老的建筑之一，这个滩地公园也是沈阳一处隐秘而美丽的踏青胜地。',0,1,'2018-05-03 15:31:58','2018-05-03 15:31:58',NULL),(37,41,'②罗士圈生态公园<br/><br/>地址：和平区工农桥至胜利桥之间的浑河北岸。<br/><br/>是谁给这地方起了个古色古香的名儿？乍一听还以为是古代将军……在大堤上小步那么一走，春风吹着，柳树斜着，再穿点儿飘飘的衣服，脚着可以“假装在西湖”，竟无以反驳……有兴致的话，再来个“浑河晚渡”，那美景儿那心情嗷嗷好。',0,1,'2018-05-03 15:32:34','2018-05-03 15:32:18',NULL),(38,83,'http://dsyy.isart.me/o_1cd9lodac1n4gn2l16lnbfhdpg1c.png',1,0,'2018-05-12 15:59:08','2018-05-12 15:59:08',NULL);

#
# Structure for table "t_goods_explain_info"
#

DROP TABLE IF EXISTS `t_goods_explain_info`;
CREATE TABLE `t_goods_explain_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `goods_id` int(11) DEFAULT NULL COMMENT '商品编号（t_goods_info->id）',
  `content` text COLLATE utf8mb4_unicode_ci COMMENT '内容',
  `type` tinyint(1) DEFAULT '0' COMMENT '类型（0:文字；1：图片；2：视频）',
  `sort` int(11) DEFAULT '0' COMMENT '排序（正常排序）',
  `updated_at` datetime DEFAULT NULL COMMENT '修改时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT COMMENT='开发和收费详情表';

#
# Data for table "t_goods_explain_info"
#

INSERT INTO `t_goods_explain_info` VALUES (1,3,'http://dsyy.isart.me/o_1cbgqhf4hhh14221stj145g97k11.jpg',1,0,'2018-04-20 14:07:46','2018-04-20 14:05:58',NULL),(2,3,'泰国位于亚洲中南半岛中部，东南临泰国湾，西南濒安达曼海。西北与缅甸为邻，西南与马来西亚交接，东北毗连老挝，东南与柬埔寨接壤，总面积513,115平方公里， 人口60,400,000人，是以泰族人为主，生活着华人、缅甸人、马来人、印度人、老挝人等的多民族国家。 泰国以“千佛之国”闻名于世，素有“黄袍佛国 ”美誉，是一个具有两千多年佛教史的文明古国，在美丽富饶的国土上，有30,OOO多座充满神话色彩的古老寺院和金碧辉煌的宫殿。泰国佛寺外观造型宏伟壮观，建筑装饰精巧卓绝，享有“泰国艺术博物馆”美称，是泰国的国宝、泰国文化的精萃。泰国90％的居民信奉佛教，民间艺术丰富多彩，是东南亚首屈一指的旅游大国。 泰国山区森林密布，奇花异木遍布，栖息着众多珍禽异兽。泰国政府把一些天然森林区划为自然保护区，并辟为森林公园。森林中空气清新，是森林浴的佳地。这里气候四季皆春，又有瀑布、湖泊和各种飞禽走兽，吸引了一批批旅游者慕名而来。 首都曼谷被誉为“天使之城”，是古典与现代的完美结合。既有高耸矗立的大型建筑，强调着城市奇情与超越时空的景致，又有古老的庙宇香火鼎盛，青烟缭绕，具有浓厚的东方色彩；既有家一样的温馨暖意，同时又充满异域情调，神秘与探险俯拾即是。 与首都曼谷不同，作为兰纳王国的故都，清迈则无不散发着迷人的古典气质。这里气候凉爽，四季百花争艳，被称为“泰北玫瑰”。在清迈，要慢下来细细品味你的感官所能接触到的一切。悠然穿行在清迈古城花木扶疏的小巷中，随意在古城中闲逛，不用装，自然而然便化身为文艺青年一枚。 值得一提的是，清迈是华语歌后邓丽君的一生挚爱，她也最终将生命交托于此。晚年的歌后曾不幸罹患气喘病，身体完全不允许接触存在花粉的环境。然而歌后对清迈的痴情却始终不渝，她不仅爱这座城的花，这座城的人，更爱这座城能给她带来的淡然与恬静。',0,1,'2018-04-20 14:07:46','2018-04-20 14:06:18',NULL),(4,3,'http://dsyy.isart.me/o_1cbgqqgnb1vje1tif1mmtbnrcng11.mp4',2,2,'2018-04-20 14:13:26','2018-04-20 14:13:26',NULL),(6,18,'http://dsyy.isart.me/o_1cbgslm0cld0164j5musjmmcr17.jpg',1,1,'2018-04-20 15:32:24','2018-04-20 14:43:12',NULL),(8,18,'AccuSizer780系列美国药典乳剂检测仪采用先进的SPOS单颗粒技术和带有专利的自动稀释进样模块，能真实地测试出样品尾端大粒子的粒度分布和颗粒浓度，具有超高的辨析率和快速测试能力。最高计数可达到E11个/mL, 从而确保各种分散体系的稳定性和品质。',0,2,'2018-04-20 15:32:34','2018-04-20 15:09:36',NULL),(22,18,'http://dsyy.isart.me/o_1cbgvk3ahot921d1fu6jb198f17.jpg',1,3,'2018-04-20 15:33:05','2018-04-20 15:33:05',NULL),(23,41,'http://dsyy.isart.me/o_1cbgvtu1vmfdl5k1igbgi13bl11.mp4',2,0,'2018-05-03 15:33:07','2018-04-20 15:38:31','2018-05-03 15:33:07'),(25,16,'http://dsyy.isart.me/o_1cbh0pf73uis1ui69791kai1qnr17.jpg',1,0,'2018-04-20 15:53:33','2018-04-20 15:53:33',NULL),(26,41,'③沈阳水洞<br/><br/>地址：沈阳水洞处于苏家屯区白清寨乡，沈阳方向能从杨千户出口入境<br/><br/>沈阳水洞，各种洞洞穴穴中穿梭。不亚于本溪水洞。',0,1,'2018-05-03 15:33:58','2018-04-20 20:31:16',NULL),(27,41,'http://dsyy.isart.me/o_1cciepn2p122sccm127gag02f511.mp4',2,2,'2018-05-03 15:33:43','2018-05-03 15:33:32',NULL),(28,41,'http://dsyy.isart.me/o_1ccieq029141t1dam54f1nc21j4a16.jpg',1,0,'2018-05-03 15:33:44','2018-05-03 15:33:41',NULL);

#
# Structure for table "t_goods_info"
#

DROP TABLE IF EXISTS `t_goods_info`;
CREATE TABLE `t_goods_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `menu_id` int(11) DEFAULT NULL COMMENT '二级栏目编号（t_menu_info->id）',
  `number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '货号',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '名称',
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '图片',
  `stock` int(11) DEFAULT '0' COMMENT '库存',
  `drimecost` int(11) DEFAULT NULL COMMENT '原价（备用）',
  `price` int(11) DEFAULT NULL COMMENT '售价',
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '商品单位',
  `hot` tinyint(1) DEFAULT '0' COMMENT '是否热销（0：否；1：是）',
  `f_attribute_id` int(11) DEFAULT NULL COMMENT '第一属性（品牌分类）编号（t_attribute_info->id）',
  `s_attribute_id` int(11) DEFAULT NULL COMMENT '第二属性（纯度）编号（t_attribute_info->id）',
  `region` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '地域',
  `sort` int(11) DEFAULT '0' COMMENT '排序（越大越靠前）',
  `cas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'CAS',
  `other` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '自定义属性',
  `seo_title` text COLLATE utf8mb4_unicode_ci COMMENT '网站SEO优化——标题',
  `seo_keywords` text COLLATE utf8mb4_unicode_ci COMMENT '网站SEO优化——关键字',
  `seo_description` text COLLATE utf8mb4_unicode_ci COMMENT '网站SEO优化——描述',
  `updated_at` datetime DEFAULT NULL COMMENT '修改时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='商品表';

#
# Data for table "t_goods_info"
#

INSERT INTO `t_goods_info` VALUES (1,NULL,'CJ1507279977822','补差价','http://dsyy.isart.me/o_1c8n3p3kjss91mf212aagsn1521l.jpg',NULL,NULL,100,'件',0,NULL,NULL,NULL,0,NULL,NULL,'优迈商城补差价专用','优迈商城补差价专用','优迈商城补差价专用',NULL,NULL,NULL),(3,8,'TS1517279977823','780 APS 乳剂检测仪','http://dsyy.isart.me/o_1c6gjp6m71kak3321npdlja4vl.jpg',1,NULL,1,'台',1,12,18,NULL,0,NULL,NULL,'780 APS 乳剂检测仪','780 APS 乳剂检测仪','780 APS 乳剂检测仪','2018-05-12 15:00:50','2018-01-29 14:40:11','2018-05-12 15:00:50'),(4,9,'TS1517279977824','总有机碳分析仪TOC-V系列','http://dsyy.isart.me/o_1c6gjfhr212qv13fmcvcr4jjlnl.jpg',0,NULL,2,'台',1,14,16,NULL,0,NULL,NULL,'总有机碳分析仪TOC-V系列','总有机碳分析仪TOC-V系列','总有机碳分析仪TOC-V系列','2018-05-12 15:00:50','2018-01-29 14:40:33','2018-05-12 15:00:50'),(5,8,'TS1517279977825','科诺科仪标准COD回流自动消解仪','http://dsyy.isart.me/o_1c6gjb58u1sheph9nfakma1vtpl.jpg',0,NULL,2,'台',1,14,16,NULL,0,NULL,NULL,'科诺科仪标准COD回流自动消解仪','科诺科仪标准COD回流自动消解仪','科诺科仪标准COD回流自动消解仪','2018-05-12 15:00:50','2018-01-29 14:43:24','2018-05-12 15:00:50'),(6,8,'TS1517279977826','奥林巴斯olympus CKX53倒置显微镜','http://dsyy.isart.me/o_1c6gj76n51p164cfgj0123abgl.jpg',0,NULL,1,'台',1,13,17,NULL,0,NULL,NULL,'奥林巴斯olympus CKX53倒置显微镜','奥林巴斯olympus CKX53倒置显微镜','奥林巴斯olympus CKX53倒置显微镜','2018-05-12 15:00:50','2018-01-30 10:35:37','2018-05-12 15:00:50'),(7,8,'TS1517279977871','KEWLAB BM1200 生物显微镜','http://dsyy.isart.me/o_1c6giun16rn3hkt1nlrf1b4dl.jpg',0,NULL,2,'台',1,13,17,NULL,0,NULL,NULL,'KEWLAB BM1200 生物显微镜','KEWLAB BM1200 生物显微镜','KEWLAB BM1200 生物显微镜','2018-05-12 15:00:50','2018-01-30 10:39:37','2018-05-12 15:00:50'),(8,8,'ZYQ1517281240696','德国FRITSCH（飞驰）P5 四罐行星式球磨机/仪','http://dsyy.isart.me/o_1c6gim868ghp1nt9op1kaln5eq.jpg',0,NULL,1,'瓶',1,12,16,NULL,0,NULL,NULL,'德国FRITSCH（飞驰）P5 四罐行星式球磨机/仪','德国FRITSCH（飞驰）P5 四罐行星式球磨机/仪','德国FRITSCH（飞驰）P5 四罐行星式球磨机/仪','2018-05-12 15:00:50','2018-01-30 11:00:40','2018-05-12 15:00:50'),(16,10,'JG1517368025882','3D打印','http://dsyy.isart.me/o_1c6gvmtabu5a16ic1v9422t16orr.png',0,NULL,2,'件',1,21,NULL,NULL,0,NULL,NULL,'3D打印','3D打印','3D打印','2018-05-12 15:30:19','2018-01-31 11:07:05','2018-05-12 15:30:19'),(17,11,'CS1517368710727','激光切割加工 - 铝合金 - 电镀','http://dsyy.isart.me/o_1c6gtf7qesrfel1hc09i41pjrl.jpg',0,NULL,1,'件',1,20,NULL,NULL,0,NULL,NULL,'激光切割加工 - 铝合金 - 电镀','激光切割加工 - 铝合金 - 电镀','激光切割加工 - 铝合金 - 电镀','2018-05-12 15:30:19','2018-01-31 11:18:30','2018-05-12 15:30:19'),(18,10,'GB1517370208426','CNC加工','http://dsyy.isart.me/o_1c6guv49p1801178le9u68nsc5r.png',0,NULL,1,'件',1,19,NULL,NULL,0,NULL,NULL,'CNC加工','CNC加工','CNC加工','2018-05-12 15:30:19','2018-01-31 11:43:28','2018-05-12 15:30:19'),(20,9,'ZZXD1518828649150','DNS RT-J3000 溶出仪（全自动溶出仪）','http://dsyy.isart.me/o_1c6gjrs0h1qj7o8hpbf1qkfuh4l.jpg',0,NULL,1,'台',1,12,16,NULL,0,NULL,NULL,'DNS RT-J3000 溶出仪（全自动溶出仪）','DNS RT-J3000 溶出仪（全自动溶出仪）','DNS RT-J3000 溶出仪（全自动溶出仪）','2018-05-12 15:00:50','2018-02-17 08:50:49','2018-05-12 15:00:50'),(21,9,'ZZXD1518828746670','ChemTron 分子蒸馏仪、馏程仪','http://dsyy.isart.me/o_1c6gjuqv91f26p226q7kr316pol.jpg',0,NULL,1,'台',1,13,18,NULL,0,NULL,NULL,'ChemTron 分子蒸馏仪、馏程仪','ChemTron 分子蒸馏仪、馏程仪','ChemTron 分子蒸馏仪、馏程仪','2018-05-12 15:00:50','2018-02-17 08:52:26','2018-05-12 15:00:50'),(22,9,'ZZXD1518828863513','华溶仪器DS-812溶出仪','http://dsyy.isart.me/o_1c6gk2dsk1obmj4k10ebt541bqll.jpg',0,NULL,1,'台',1,13,18,NULL,0,NULL,NULL,'华溶仪器DS-812溶出仪','华溶仪器DS-812溶出仪','华溶仪器DS-812溶出仪','2018-05-12 15:00:50','2018-02-17 08:54:23','2018-05-12 15:00:50'),(23,11,'JG1518839024101','激光切割加工 - 不锈钢 - 表面不处理','http://dsyy.isart.me/o_1c6gtnjmj1c1s174810rdbk71ubpe.jpg',0,NULL,1,'件',1,20,NULL,NULL,0,NULL,NULL,'激光切割加工 - 不锈钢 - 表面不处理','激光切割加工 - 不锈钢 - 表面不处理','激光切割加工 - 不锈钢 - 表面不处理','2018-05-12 15:30:19','2018-02-17 11:43:44','2018-05-12 15:30:19'),(24,10,'GB1518839131802','手板加工','http://dsyy.isart.me/o_1c6h02ea91j3o87b1flcr8t1925r.png',0,NULL,1,'件',1,20,NULL,NULL,0,NULL,NULL,'手板加工','手板加工','手板加工','2018-05-12 15:30:19','2018-02-17 11:45:31','2018-05-12 15:30:19'),(25,11,'GB1518839358866','3D打印 - 光敏树脂 - 抛光','http://dsyy.isart.me/o_1c6gtv9n01vvt1v6q28op921cnn9.jpg',14,NULL,1,'件',1,19,NULL,NULL,0,NULL,NULL,'3D打印 - 光敏树脂 - 抛光','3D打印 - 光敏树脂 - 抛光','3D打印 - 光敏树脂 - 抛光','2018-05-12 15:30:19','2018-02-17 11:49:18','2018-05-12 15:30:19'),(26,11,'GB1518839622787','钣金加工 - 不锈钢 - 喷油','http://dsyy.isart.me/o_1c6gu9q2m1ui4k981ng9qql1jtb9.jpg',1,NULL,2,'件',1,20,NULL,NULL,0,NULL,NULL,'钣金加工 - 不锈钢 - 喷油','钣金加工 - 不锈钢 - 喷油','钣金加工 - 不锈钢 - 喷油','2018-05-12 15:30:19','2018-02-17 11:53:42','2018-05-12 15:30:19'),(27,10,'JG1518840795829','钣金加工','http://dsyy.isart.me/o_1c6gvtgc96hd12h51osn1o5kitd10.png',0,NULL,2,'件',1,19,NULL,NULL,0,NULL,NULL,'钣金加工','钣金加工','钣金加工','2018-05-12 15:30:19','2018-02-17 12:13:15','2018-05-12 15:30:19'),(41,8,'ZYQ1521273858361','家居','http://dsyy.isart.me/o_1c8pfqto91pnjl8i8cq35k3hml.jpg',0,NULL,105,'次',1,12,16,'沈阳',1000,NULL,NULL,NULL,NULL,NULL,'2018-05-12 15:00:50','2018-03-17 16:04:18','2018-05-12 15:00:50'),(42,8,'ZYQ1521279616497','测试','http://dsyy.isart.me/o_1c8pl8noogbbitg12s31v5kqf6l.jpg',0,NULL,1,'台',0,15,17,'沈阳',0,NULL,NULL,NULL,NULL,NULL,'2018-05-12 15:00:53','2018-03-17 17:40:16','2018-05-12 15:00:53'),(43,10,'JG1521280099311','测试','http://dsyy.isart.me/o_1c8plnjbv1mn01cp11jrksut1moh9.jpg',12,NULL,1,'件',0,20,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,'2018-05-12 15:30:19','2018-03-17 17:48:19','2018-05-12 15:30:19'),(70,4,'SJ1525933339214','二氧化锰','http://dsyy.isart.me/o_1cd9hgehp11651mpo59t7cupmb9.png',90,NULL,12900,'瓶',0,7,26,NULL,1,'1313-13-9',NULL,NULL,NULL,NULL,'2018-05-19 20:08:28','2018-05-10 14:22:19',NULL),(71,4,'SJ1525945748575','乙醇','http://dsyy.isart.me/o_1cd4n22lkblv1jdj13t21mph1l219.png',1000,NULL,1000,'500ml',0,30,26,NULL,1,'64-17-5',NULL,NULL,NULL,NULL,'2018-05-19 22:00:41','2018-05-10 17:49:08',NULL),(72,4,'SJ1525958958179','无水硫酸铜','http://dsyy.isart.me/o_1cd9hasm0ht01v6hhm1n6u13kd9.png',5,NULL,15900,'瓶',0,8,9,NULL,1,'231-159-6',NULL,NULL,NULL,NULL,'2018-05-12 14:41:49','2018-05-10 21:29:18',NULL),(73,4,'SJ1525959452303','无水硫酸铜','http://dsyy.isart.me/o_1cd53mm46b7mnldpeq17kimpi9.png',1,NULL,19400,'瓶',0,8,9,NULL,2,'231-159-6',NULL,NULL,NULL,NULL,'2018-05-10 21:37:32','2018-05-10 21:37:32',NULL),(74,4,'SJ1525959463210','无水硫酸铜','http://dsyy.isart.me/o_1cd53mm46b7mnldpeq17kimpi9.png',1,NULL,19400,'瓶',0,8,9,NULL,2,'231-159-6',NULL,NULL,NULL,NULL,'2018-05-10 21:37:43','2018-05-10 21:37:43',NULL),(75,4,'SJ1525959480653','无水硫酸铜','http://dsyy.isart.me/o_1cd53mm46b7mnldpeq17kimpi9.png',1,NULL,19400,'瓶',0,8,9,NULL,1,'231-159-6',NULL,NULL,NULL,NULL,'2018-05-10 21:38:00','2018-05-10 21:38:00',NULL),(76,4,'SJ1525959623165','无水硫酸铜','http://dsyy.isart.me/o_1cd53mm46b7mnldpeq17kimpi9.png',3,NULL,19400,'瓶',0,6,9,NULL,2,'231-159-6',NULL,NULL,NULL,NULL,'2018-05-10 21:40:23','2018-05-10 21:40:23',NULL),(77,4,'SJ1525959726109','无水硫酸铜','http://dsyy.isart.me/o_1cd9hasm0ht01v6hhm1n6u13kd9.png',3,NULL,19400,'瓶',0,6,11,NULL,2,'231-159-6',NULL,NULL,NULL,NULL,'2018-05-12 14:41:49','2018-05-10 21:42:06',NULL),(78,4,'SJ1526040626423','无水硫酸铜','http://dsyy.isart.me/o_1cd9hasm0ht01v6hhm1n6u13kd9.png',5,NULL,19400,'瓶',0,8,26,NULL,12,'231-159-6','纯度：99%',NULL,NULL,NULL,'2018-05-15 22:53:10','2018-05-11 20:10:26',NULL),(79,4,'SJ1526041052433','二氧化锰','http://dsyy.isart.me/o_1cd9hgehp11651mpo59t7cupmb9.png',0,NULL,5800,'瓶',0,8,22,NULL,4,'1313-13-9',NULL,NULL,NULL,NULL,'2018-05-19 20:28:53','2018-05-11 20:17:32','2018-05-19 20:28:53'),(80,4,'SJ1526041783458','硫酸铜，五水合物','http://dsyy.isart.me/o_1cd9h5bq3f76sb512381ba21240e.png',1,NULL,5900,'瓶',0,8,26,NULL,1,'7758-99-8',NULL,'五水硫酸铜','五水硫酸铜',NULL,'2018-05-15 23:06:39','2018-05-11 20:29:43',NULL),(81,4,'SJ1526041915944','硫酸铜，五水合物','http://dsyy.isart.me/o_1cd9h5bq3f76sb512381ba21240e.png',0,NULL,6900,'瓶',0,8,26,NULL,1,'7758-99-8','纯度：98%',NULL,NULL,NULL,'2018-05-15 21:52:30','2018-05-11 20:31:55',NULL),(82,9,'ZZXD1526109081543','扫描电镜','http://dsyy.isart.me/o_1cd9iukcm5s1t8l1k8b1soc1e4m11.png',0,NULL,10000,'样',1,12,18,'全国',1,NULL,NULL,NULL,NULL,NULL,'2018-05-14 21:09:02','2018-05-12 15:11:21',NULL),(83,10,'JG1526110854515','线切割机','http://dsyy.isart.me/o_1cd9klq4h1sma1euvari17bp1aa99.png',0,NULL,100,'个',1,19,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,'2018-05-14 21:09:20','2018-05-12 15:40:54',NULL),(84,11,'GB1526112833455','样品块','http://dsyy.isart.me/o_1cd9miipm12vm17qv12hnmd31t7k9.png',1000,NULL,200,'个',1,19,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,'2018-05-14 21:09:33','2018-05-12 16:13:53',NULL),(85,5,'HC1526223024266','烧杯','http://dsyy.isart.me/o_1cd9e29np8vfkup1ihm1vqab979.png',2,NULL,100,'个',0,25,23,NULL,3,'1-1',NULL,NULL,NULL,NULL,'2018-05-14 17:27:06','2018-05-13 22:50:24','2018-05-14 17:27:06'),(86,5,'HC1526293088933','烧杯','http://dsyy.isart.me/o_1cd9e29np8vfkup1ihm1vqab979.png',10,NULL,200,'个',0,25,28,NULL,1,NULL,NULL,NULL,NULL,NULL,'2018-05-19 20:49:23','2018-05-14 18:18:08',NULL),(87,4,'SJ1526731164858','二氧化锰','http://dsyy.isart.me/o_1cd9hgehp11651mpo59t7cupmb9.png',10,NULL,8900,'瓶',0,7,28,NULL,1,'1313-13-9',NULL,NULL,NULL,NULL,'2018-05-19 19:59:24','2018-05-19 19:59:24',NULL),(88,4,'SJ1526731345490','二氧化锰','http://dsyy.isart.me/o_1cd9hgehp11651mpo59t7cupmb9.png',19,NULL,5900,'瓶',0,7,26,NULL,2,'1313-13-9',NULL,NULL,NULL,NULL,'2018-05-19 20:02:25','2018-05-19 20:02:25',NULL),(89,4,'SJ1526731479834','二氧化锰','http://dsyy.isart.me/o_1cd9hgehp11651mpo59t7cupmb9.png',10,NULL,23900,'瓶',0,7,26,NULL,3,'1313-13-9',NULL,NULL,NULL,NULL,'2018-05-19 20:05:20','2018-05-19 20:04:39',NULL),(90,4,'SJ1526731807834','二氧化锰','http://dsyy.isart.me/o_1cd9hgehp11651mpo59t7cupmb9.png',14,NULL,49800,'瓶',0,7,28,NULL,3,'1313-13-9',NULL,NULL,NULL,NULL,'2018-05-19 20:10:07','2018-05-19 20:10:07',NULL),(91,4,'SJ1526731948480','二氧化锰','http://dsyy.isart.me/o_1cd9hgehp11651mpo59t7cupmb9.png',12,NULL,31900,'瓶',0,7,26,NULL,2,'1313-13-9',NULL,NULL,NULL,NULL,'2018-05-19 20:12:28','2018-05-19 20:12:28',NULL),(92,4,'SJ1526732102746','二氧化锰','http://dsyy.isart.me/o_1cd9hgehp11651mpo59t7cupmb9.png',10,NULL,13900,'瓶',0,7,28,NULL,2,'1313-13-9',NULL,NULL,NULL,NULL,'2018-05-19 20:15:02','2018-05-19 20:15:02',NULL),(93,4,'SJ1526732216906','二氧化锰','http://dsyy.isart.me/o_1cd9hgehp11651mpo59t7cupmb9.png',502,NULL,77500,'瓶',0,7,26,NULL,1,'1313-13-9',NULL,NULL,NULL,NULL,'2018-05-19 20:16:56','2018-05-19 20:16:56',NULL),(94,4,'SJ1526732417232','二氧化锰','http://dsyy.isart.me/o_1cd9hgehp11651mpo59t7cupmb9.png',12,NULL,79900,'瓶',0,7,28,NULL,1,'1313-13-9',NULL,NULL,NULL,NULL,'2018-05-19 20:20:17','2018-05-19 20:20:17',NULL),(95,4,'SJ1526732537631','二氧化锰','http://dsyy.isart.me/o_1cd9hgehp11651mpo59t7cupmb9.png',10,NULL,9900,'瓶',0,7,26,NULL,2,'1313-13-9',NULL,NULL,NULL,NULL,'2018-05-19 20:22:17','2018-05-19 20:22:17',NULL),(96,4,'SJ1526732610284','二氧化锰','http://dsyy.isart.me/o_1cd9hgehp11651mpo59t7cupmb9.png',13,NULL,24900,'瓶',0,7,26,NULL,1,'1313-13-9',NULL,NULL,NULL,NULL,'2018-05-19 20:23:30','2018-05-19 20:23:30',NULL),(97,4,'SJ1526732752913','二氧化锰','http://dsyy.isart.me/o_1cd9hgehp11651mpo59t7cupmb9.png',13,NULL,6800,'瓶',0,7,26,NULL,1,'1313-13-9',NULL,NULL,NULL,NULL,'2018-05-19 20:25:52','2018-05-19 20:25:52',NULL),(98,4,'SJ1526732851260','二氧化锰','http://dsyy.isart.me/o_1cd9hgehp11651mpo59t7cupmb9.png',5,NULL,29600,'瓶',0,7,26,NULL,1,'1313-13-9',NULL,NULL,NULL,NULL,'2018-05-19 20:27:31','2018-05-19 20:27:31',NULL),(99,4,'SJ1526733181953','二氧化锰','http://dsyy.isart.me/o_1cd9hgehp11651mpo59t7cupmb9.png',14,NULL,5800,'瓶',0,8,26,NULL,1,'1313-13-9',NULL,NULL,NULL,NULL,'2018-05-19 20:33:01','2018-05-19 20:33:01',NULL),(100,4,'SJ1526733254383','二氧化锰','http://dsyy.isart.me/o_1cd9hgehp11651mpo59t7cupmb9.png',23,NULL,19500,'瓶',0,8,26,NULL,1,'1313-13-9',NULL,NULL,NULL,NULL,'2018-05-19 20:34:14','2018-05-19 20:34:14',NULL),(101,4,'SJ1526733376414','二氧化锰','http://dsyy.isart.me/o_1cd9hgehp11651mpo59t7cupmb9.png',10,NULL,48800,'瓶',0,8,26,NULL,1,'1313-13-9',NULL,NULL,NULL,NULL,'2018-05-19 20:36:16','2018-05-19 20:36:16',NULL),(102,4,'SJ1526733451233','二氧化锰','http://dsyy.isart.me/o_1cd9hgehp11651mpo59t7cupmb9.png',14,NULL,12600,'瓶',0,8,26,NULL,1,'1313-13-9',NULL,NULL,NULL,NULL,'2018-05-19 20:37:31','2018-05-19 20:37:31',NULL),(103,4,'SJ1526733558544','二氧化锰','http://dsyy.isart.me/o_1cd9hgehp11651mpo59t7cupmb9.png',132,NULL,6700,'瓶',0,8,26,NULL,1,'1313-13-9',NULL,NULL,NULL,NULL,'2018-05-19 20:39:18','2018-05-19 20:39:18',NULL),(104,4,'SJ1526733699901','二氧化锰','http://dsyy.isart.me/o_1cd9hgehp11651mpo59t7cupmb9.png',21,NULL,19900,'瓶',0,8,26,NULL,1,'1313-13-9',NULL,NULL,NULL,NULL,'2018-05-19 20:41:39','2018-05-19 20:41:39',NULL),(105,4,'SJ1526733772460','二氧化锰','http://dsyy.isart.me/o_1cd9hgehp11651mpo59t7cupmb9.png',12,NULL,39800,'瓶',0,8,26,NULL,1,'1313-13-9',NULL,NULL,NULL,NULL,'2018-05-19 20:42:52','2018-05-19 20:42:52',NULL),(106,4,'SJ1526733893426','二氧化锰','http://dsyy.isart.me/o_1cd9hgehp11651mpo59t7cupmb9.png',12,NULL,26800,'瓶',0,8,26,NULL,1,'1313-13-9',NULL,NULL,NULL,NULL,'2018-05-19 20:44:53','2018-05-19 20:44:53',NULL),(107,5,'HC1526734233491','烧杯','http://dsyy.isart.me/o_1cd9e29np8vfkup1ihm1vqab979.png',433,NULL,250,'个',0,25,28,NULL,3,NULL,NULL,NULL,NULL,NULL,'2018-05-19 20:50:33','2018-05-19 20:50:33',NULL),(108,5,'HC1526734343484','烧杯','http://dsyy.isart.me/o_1cd9e29np8vfkup1ihm1vqab979.png',1443,NULL,400,'个',0,25,28,NULL,3,NULL,NULL,NULL,NULL,NULL,'2018-05-19 20:53:34','2018-05-19 20:52:23',NULL),(109,5,'HC1526734384977','烧杯','http://dsyy.isart.me/o_1cd9e29np8vfkup1ihm1vqab979.png',3333,NULL,500,'个',0,25,28,NULL,4,NULL,NULL,NULL,NULL,NULL,'2018-05-19 20:53:18','2018-05-19 20:53:04',NULL),(110,5,'HC1526734472531','烧杯','http://dsyy.isart.me/o_1cd9e29np8vfkup1ihm1vqab979.png',1111,NULL,700,'个',0,25,28,NULL,5,NULL,NULL,NULL,NULL,NULL,'2018-05-19 20:54:32','2018-05-19 20:54:32',NULL),(111,5,'HC1526734514450','烧杯','http://dsyy.isart.me/o_1cd9e29np8vfkup1ihm1vqab979.png',333,NULL,1400,'个',0,25,28,NULL,6,NULL,NULL,NULL,NULL,NULL,'2018-05-19 20:55:14','2018-05-19 20:55:14',NULL),(112,5,'HC1526734562635','烧杯','http://dsyy.isart.me/o_1cd9e29np8vfkup1ihm1vqab979.png',332,NULL,2800,'个',0,25,28,NULL,7,NULL,NULL,NULL,NULL,NULL,'2018-06-19 14:06:13','2018-05-19 20:56:02',NULL),(113,5,'HC1526737684536','环氧树脂','http://dsyy.isart.me/o_1cdsab5t4fqt13621gh7k4gv839.jpg',5,NULL,12000,'套',0,30,28,NULL,3,NULL,NULL,NULL,NULL,NULL,'2018-05-19 21:48:04','2018-05-19 21:48:04',NULL),(114,5,'HC1526738073805','定性滤纸','http://dsyy.isart.me/o_1cdsanje050d5dcca2ta313h39.png',455,NULL,900,'盒',0,30,28,NULL,1,NULL,NULL,NULL,NULL,NULL,'2018-05-19 21:54:53','2018-05-19 21:54:33',NULL),(115,5,'HC1526738143480','定性滤纸','http://dsyy.isart.me/o_1cdsanje050d5dcca2ta313h39.png',442,NULL,600,'盒',0,30,28,NULL,2,NULL,NULL,NULL,NULL,NULL,'2018-05-19 21:55:43','2018-05-19 21:55:43',NULL),(116,5,'HC1526738183824','定性滤纸','http://dsyy.isart.me/o_1cdsanje050d5dcca2ta313h39.png',333,NULL,1400,'盒',0,30,28,NULL,3,NULL,NULL,NULL,NULL,NULL,'2018-05-19 21:56:23','2018-05-19 21:56:23',NULL),(117,5,'HC1526738266483','定性滤纸','http://dsyy.isart.me/o_1cdsanje050d5dcca2ta313h39.png',333,NULL,1800,'盒',0,30,28,NULL,2,NULL,NULL,NULL,NULL,NULL,'2018-05-19 21:57:46','2018-05-19 21:57:46',NULL),(118,5,'HC1526738332314','定性滤纸','http://dsyy.isart.me/o_1cdsanje050d5dcca2ta313h39.png',333,NULL,2400,'盒',0,30,28,NULL,1,NULL,NULL,NULL,NULL,NULL,'2018-05-19 21:58:52','2018-05-19 21:58:52',NULL),(119,5,'HC1526738385263','定性滤纸','http://dsyy.isart.me/o_1cdsanje050d5dcca2ta313h39.png',333,NULL,1600,'盒',0,30,28,NULL,1,NULL,NULL,NULL,NULL,NULL,'2018-05-19 21:59:45','2018-05-19 21:59:45',NULL),(120,4,'SJ1526738509197','乙醇','http://dsyy.isart.me/o_1cd4n22lkblv1jdj13t21mph1l219.png',222,NULL,1400,'瓶',0,30,26,NULL,2,'64-17-5',NULL,NULL,NULL,NULL,'2018-05-19 22:01:49','2018-05-19 22:01:49',NULL);

#
# Structure for table "t_goods_machining_attribute_info"
#

DROP TABLE IF EXISTS `t_goods_machining_attribute_info`;
CREATE TABLE `t_goods_machining_attribute_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `goods_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '对应的商品编号（t_goods_info->id）',
  `accuracy` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '精度',
  `service` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '服务商',
  `material` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '材料',
  `explain` text COLLATE utf8mb4_unicode_ci COMMENT '开发和收费情况',
  `updated_at` datetime DEFAULT NULL COMMENT '修改时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='机加工商品属性表';

#
# Data for table "t_goods_machining_attribute_info"
#

INSERT INTO `t_goods_machining_attribute_info` VALUES (1,'16',NULL,NULL,NULL,NULL,'2018-01-31 11:07:05','2018-01-31 11:07:05',NULL),(2,'18','10','太阳系机加工工厂','木头','不知道，哈哈哈','2018-02-22 22:16:08','2018-01-31 11:43:28',NULL),(3,'24',NULL,NULL,NULL,NULL,'2018-02-17 11:45:31','2018-02-17 11:45:31',NULL),(4,'27',NULL,NULL,NULL,NULL,'2018-02-17 12:13:15','2018-02-17 12:13:15',NULL),(5,'83','±0.01','优迈实验室','导电金属',NULL,'2018-05-14 22:08:51','2018-05-12 15:40:54',NULL);

#
# Structure for table "t_goods_standard_attribute_info"
#

DROP TABLE IF EXISTS `t_goods_standard_attribute_info`;
CREATE TABLE `t_goods_standard_attribute_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `goods_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '对应的商品编号（t_goods_info->id）',
  `accuracy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '精度',
  `size` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '尺寸',
  `component` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '成分',
  `updated_at` datetime DEFAULT NULL COMMENT '修改时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='国标商品属性表';

#
# Data for table "t_goods_standard_attribute_info"
#

INSERT INTO `t_goods_standard_attribute_info` VALUES (1,'17','1266','23','122','2018-01-31 15:45:40','2018-01-31 11:18:30',NULL),(2,'23','123','987','122','2018-02-17 11:43:44','2018-02-17 11:43:44',NULL),(3,'25','23','54','122','2018-02-17 11:49:18','2018-02-17 11:49:18',NULL),(4,'26','1','21','147','2018-02-17 11:53:43','2018-02-17 11:53:43',NULL),(5,'43',NULL,NULL,NULL,'2018-03-17 17:48:19','2018-03-17 17:48:19',NULL),(6,'84','±0.01mm','10×10×10mm','304不锈钢','2018-05-12 16:15:46','2018-05-12 16:13:53',NULL);

#
# Structure for table "t_goods_testing_attribute_info"
#

DROP TABLE IF EXISTS `t_goods_testing_attribute_info`;
CREATE TABLE `t_goods_testing_attribute_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `goods_id` int(11) DEFAULT NULL COMMENT '对应的商品编号（t_goods_info->id）',
  `lab` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '实验室',
  `contacts` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '联系人信息',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '送样地址',
  `explain` text COLLATE utf8mb4_unicode_ci COMMENT '开发和收费情况',
  `updated_at` datetime DEFAULT NULL COMMENT '修改时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='第三方检测商品属性表';

#
# Data for table "t_goods_testing_attribute_info"
#

INSERT INTO `t_goods_testing_attribute_info` VALUES (1,1,'优迈实验室','优迈客服','辽宁省葫芦岛市',NULL,'2018-01-30 10:11:26','2018-01-30 10:11:26',NULL),(2,2,'优迈实验室','优迈客服','辽宁省葫芦岛市',NULL,'2018-01-30 10:12:04','2018-01-30 10:12:04',NULL),(3,5,'优迈实验室','优迈客服','辽宁省葫芦岛市',NULL,'2018-01-30 10:17:58','2018-01-30 10:17:58',NULL),(4,4,'优迈实验室','优迈客服','辽宁省葫芦岛市',NULL,'2018-01-30 10:18:31','2018-01-30 10:18:31',NULL),(5,8,'优迈实验室','优迈客服','辽宁省葫芦岛市',NULL,'2018-01-30 11:14:56','2018-01-30 11:14:56',NULL),(8,3,'上海问号实验室','优迈客服','辽宁省葫芦岛市','请联系客服','2018-03-15 09:43:29','2018-02-17 08:18:02',NULL),(10,22,'北京问号实验室','问号先生','辽宁省葫芦岛市','开发和收费情况描述','2018-03-15 09:36:16','2018-02-17 08:55:33',NULL),(11,41,NULL,NULL,NULL,NULL,'2018-03-17 17:39:36','2018-03-17 17:39:36',NULL),(12,42,'优迈实验室','15666666666','中国','公司名称+还是断开连接方法数据库来电话发链接啊是','2018-03-19 22:22:51','2018-03-18 23:10:43',NULL),(13,82,NULL,NULL,NULL,NULL,'2018-05-14 21:08:55','2018-05-14 21:08:55',NULL);

#
# Structure for table "t_invoice_info"
#

DROP TABLE IF EXISTS `t_invoice_info`;
CREATE TABLE `t_invoice_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `type` tinyint(1) DEFAULT '0' COMMENT '类型（0：普通发票；1：专用发票）',
  `examine` tinyint(1) DEFAULT '0' COMMENT '专用发票审核状态（0：审核中；1：审核通过；2：审核未通过）',
  `status` tinyint(1) DEFAULT '0' COMMENT '默认状态（0：正常；1：默认发票）',
  `user_id` int(11) DEFAULT NULL COMMENT '会员编号（t_user_info->id）',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '普通发票-发票抬头；专用发票-单位名称',
  `credit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '普通发票-税号／信用代码；专用发票-纳税人识别码',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '收票人姓名',
  `phonenum` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '收票人电话',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '收票人地址',
  `company_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '注册地址（用于专用发票审核）',
  `company_tel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '注册电话（用于专用发票审核）',
  `bank` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '开户银行（专用发票必填字段；用于专用发票审核）',
  `number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '银行账号（专用发票必填字段；用于专用发票审核）',
  `licence` tinyint(1) DEFAULT '0' COMMENT '证照类型（0：非三证合一企业；1：三证合一企业）（用于专用发票审核）',
  `business_license` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '营业执照（用于专用发票审核）',
  `account_opening_permit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '开户许可证（非三证合一企业；用于专用发票审核）',
  `tax_registration_certificate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '税务登记证（非三证合一企业；用于专用发票审核）',
  `delete` tinyint(1) DEFAULT '0' COMMENT '是否已删除（0：否；1：是）',
  `updated_at` datetime DEFAULT NULL COMMENT '修改时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='发票管理表';

#
# Data for table "t_invoice_info"
#

INSERT INTO `t_invoice_info` VALUES (2,0,0,0,14,'冰麒麟','987654321','冰麒麟','13045612784','深圳市南山区科技园南区R2-B三楼',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,0,'2018-03-12 12:10:55','2018-03-01 10:38:54',NULL),(9,1,2,0,14,'冰麒麟的冰淇淋控股有限公司','789456123321654987','Amy','13012345678','辽宁省沈阳市浑南区','辽宁省沈阳市','13012345678','中国人民银行','123456789',1,'http://dsyy.isart.me/o_1c7qkaa2a1t141rnen4p1mckcms.jpg',NULL,NULL,0,'2018-04-05 18:34:27','2018-03-04 08:42:14',NULL),(10,1,1,1,14,'Amy冰麒麟','123456789','Amy冰麒麟','13412345678','辽宁省沈阳市浑南区亿丰不夜城','辽宁省沈阳市浑南区','13012345678','中国人民银行','987456321',0,'http://dsyy.isart.me/o_1c7qkurb5v141581p0tr4t19lh11.jpg','http://dsyy.isart.me/o_1c7qkv77s1dlt14o91nne1u3cu9416.jpg','http://dsyy.isart.me/o_1c7qkvhjj1ptc15lg1mvn1gu31n4e1b.jpg',0,'2018-03-12 12:10:54','2018-03-04 08:56:32',NULL),(11,0,0,0,14,'冰麒麟','123456789','冰麒麟','13012345678','123456',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,0,'2018-03-12 12:10:55','2018-03-12 09:58:55',NULL),(12,0,0,0,14,'冰麒麟','123456789','冰麒麟','13012345678','冰麒麟山谷',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,0,'2018-03-12 12:10:55','2018-03-12 10:03:52',NULL),(13,0,0,0,14,'冰麒麟','123456789','冰麒麟','13012345678','北京 县 延庆县 XXXXXXXXXXXXXXX',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,0,'2018-03-12 12:10:55','2018-03-12 10:08:55',NULL),(14,0,0,0,18,'中科院金属所','1289698689','毛要总','98689','986986986',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,'2018-05-14 22:29:29','2018-03-19 23:03:56',NULL),(15,0,0,1,21,'沈阳哈尔科技有限公司','91210103MA0U04427R','师同康','13080045113','中国',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,0,'2018-03-20 10:44:38','2018-03-20 10:44:38',NULL),(16,0,0,0,23,'沈阳哈尔科技有限公司','91210103MA0U04427R','师同康','13080045113','沈阳是和平区',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,'2018-03-20 17:36:37','2018-03-20 17:30:36',NULL),(17,0,0,0,23,'沈阳哈尔科技有限公司','91210103MA0U04427R','师同康','13080845113','沈阳是和平区',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,'2018-04-04 22:49:35','2018-03-20 17:36:37',NULL),(18,0,0,1,23,'沈阳哈尔科技有限公司','91210103MA0U04427R','师同康','13080845113','沈阳市沈河区文化路139号群升新天地2号楼1007室',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,0,'2018-04-04 22:49:35','2018-04-04 22:49:35',NULL),(22,0,0,0,14,'娃哈哈','123456789','哈哈','13656231245','辽宁省',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,0,'2018-04-16 21:07:37','2018-04-16 21:07:37',NULL),(23,1,0,0,14,'爽歪歪','36541236','123','321','456','辽宁省沈阳市','13012345678','中国银行','123456',0,NULL,NULL,NULL,0,'2018-04-16 21:09:09','2018-04-16 21:09:09',NULL),(24,0,0,0,23,'中国科学院金属研究所','121000004630037851','师同康','13080845113','沈阳市沈河区文化路139号群升新天地2号楼1007室',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,0,'2018-05-14 22:25:38','2018-05-14 22:25:38',NULL),(25,0,0,0,18,'中国科学院金属研究所','121000004630037851','毛耀宗','13012345678','沈阳市沈河区文化路72号',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,'2018-05-14 22:30:40','2018-05-14 22:27:15',NULL),(26,0,0,0,18,'中国科学院金属研究所','121000004630037851','毛耀宗','13294686005','沈阳市沈河区文化路72号',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,1,'2018-05-15 12:14:37','2018-05-14 22:29:29',NULL),(27,0,0,0,23,'中国科学院金属研究所','121000004630037851','毛耀宗','13080845113','沈阳市沈河区文化路72号',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,0,'2018-05-14 22:29:36','2018-05-14 22:29:36',NULL),(28,0,0,1,18,'中国科学院金属研究所','121000004630037851','毛耀宗','15640309805','沈阳市沈河区文化路72号',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,0,'2018-05-15 12:14:37','2018-05-15 12:14:37',NULL);

#
# Structure for table "t_league_info"
#

DROP TABLE IF EXISTS `t_league_info`;
CREATE TABLE `t_league_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '姓名',
  `phonenum` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '电话',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '电子邮箱',
  `content` text COLLATE utf8mb4_unicode_ci COMMENT '内容',
  `status` tinyint(1) DEFAULT '0' COMMENT '审核状态（0：待定；1：已联系）',
  `updated_at` datetime DEFAULT NULL COMMENT '修改时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='加盟表';

#
# Data for table "t_league_info"
#

INSERT INTO `t_league_info` VALUES (1,'小胖胖','13987654321','123@123.com','我想加盟',1,'2018-04-09 11:07:13','2018-01-26 17:10:09','2018-04-09 11:07:13'),(2,'小小胖','13798765432','321@321.com','我有货源',1,'2018-04-09 11:07:13','2018-01-26 17:49:21','2018-04-09 11:07:13'),(3,'3',NULL,NULL,NULL,0,'2018-02-08 21:19:36','2018-01-27 13:50:21','2018-02-08 21:19:36'),(4,'4',NULL,NULL,NULL,0,'2018-02-08 21:19:31','2018-01-27 13:50:23','2018-02-08 21:19:31'),(5,'5',NULL,NULL,NULL,0,'2018-02-08 21:19:31','2018-01-27 13:50:24','2018-02-08 21:19:31'),(6,'6',NULL,NULL,NULL,0,'2018-02-08 21:19:31','2018-01-27 13:50:25','2018-02-08 21:19:31'),(7,'7',NULL,NULL,NULL,0,'2018-02-08 21:19:31','2018-01-27 13:50:26','2018-02-08 21:19:31'),(8,'8',NULL,NULL,NULL,0,'2018-02-08 21:19:31','2018-01-27 13:50:27','2018-02-08 21:19:31'),(9,'9',NULL,NULL,NULL,0,'2018-02-08 21:19:31','2018-01-27 13:50:27','2018-02-08 21:19:31'),(10,'10',NULL,NULL,NULL,0,'2018-02-08 21:19:36','2018-01-27 13:50:28','2018-02-08 21:19:36'),(11,'11',NULL,NULL,NULL,0,'2018-02-08 21:19:36','2018-01-27 13:50:31','2018-02-08 21:19:36'),(12,'丽丽','15878945612','123@123.com','测试',0,'2018-04-09 11:07:13','2018-02-01 17:21:05','2018-04-09 11:07:13'),(13,'钱先生','13789456123','156@156.com','我有10箱矿泉水',0,'2018-04-09 11:07:13','2018-02-08 21:19:12','2018-04-09 11:07:13'),(14,'测试','13012345678','123@123.com','测试数据',0,'2018-04-09 11:07:13','2018-02-24 21:16:32','2018-04-09 11:07:13'),(15,'丽丽','13012345678','123@123.com','无',0,'2018-05-10 14:44:07','2018-04-16 17:42:08','2018-05-10 14:44:07');

#
# Structure for table "t_menu_info"
#

DROP TABLE IF EXISTS `t_menu_info`;
CREATE TABLE `t_menu_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '名称',
  `menu_id` int(11) DEFAULT '0' COMMENT '0：一级栏目；非0：对应上级栏目id',
  `prefix` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '货号前缀字母',
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '图标',
  `route` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '路由',
  `sort` int(11) DEFAULT '0' COMMENT '排序（越大越靠前）',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态（0：隐藏；1：显示）',
  `seo_title` text COLLATE utf8mb4_unicode_ci COMMENT '网站SEO优化——标题',
  `seo_keywords` text COLLATE utf8mb4_unicode_ci COMMENT '网站SEO优化——关键字',
  `seo_description` text COLLATE utf8mb4_unicode_ci COMMENT '网站SEO优化——描述',
  `updated_at` datetime DEFAULT NULL COMMENT '修改时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='商城栏目表';

#
# Data for table "t_menu_info"
#

INSERT INTO `t_menu_info` VALUES (1,'试剂耗材',0,NULL,'http://dsyy.isart.me/o_1ca8pomg41m69ar41mvg1ik51rjt9.jpg','chem',0,1,'试剂耗材','试剂耗材','试剂耗材','2018-04-05 01:02:50','2018-01-26 10:23:12',NULL),(2,'第三方检测',0,NULL,'http://dsyy.isart.me/o_1ca8q1kduokut5k1ick14j51nln9.jpg','testing',0,1,'第三方检测','第三方检测','第三方检测','2018-04-05 01:07:41','2018-01-26 10:23:40',NULL),(3,'机加工',0,NULL,'http://dsyy.isart.me/o_1ca8q258hchh1s35162q173r1ipg9.jpg','machining',0,1,'机加工','机加工','机加工','2018-04-05 01:07:58','2018-01-26 10:23:57',NULL),(4,'实验试剂',1,'SJ','http://dsyy.isart.me/o_1c6cc2seitna3e6342den1sag9.png',NULL,0,1,'实验试剂','实验试剂','实验试剂','2018-03-05 21:29:46','2018-01-28 09:49:13',NULL),(5,'实验耗材',1,'HC','http://dsyy.isart.me/o_1c6ccnffg5eg18fom6b3ic1auf9.png',NULL,0,1,'实验耗材','实验耗材','实验耗材','2018-02-15 17:29:11','2018-01-28 09:49:20',NULL),(6,'科研仪器',1,'YQ','http://dsyy.isart.me/o_1c6cd9mlh137ivuh1k2l1qqmp149.png',NULL,0,1,'科研仪器','科研仪器','科研仪器','2018-02-15 17:39:15','2018-01-28 09:49:28',NULL),(7,'办公用品',1,'BG','http://dsyy.isart.me/o_1c6cdd5i1mvo1l941ib115n1qu29.png',NULL,0,1,'办公用品','办公用品','办公用品','2018-02-15 17:41:08','2018-01-28 09:49:38',NULL),(8,'找仪器',2,'ZYQ','http://dsyy.isart.me/o_1c6gfsvhrjeregao6dj81m179.png',NULL,0,1,'找仪器','找仪器','找仪器','2018-03-05 20:45:16','2018-01-28 11:58:09',NULL),(9,'自助下单',2,'ZZXD','http://dsyy.isart.me/o_1c6gg11mpoc3roaig112qa1fsp9.png',NULL,0,1,'自助下单','自助下单','自助下单','2018-02-17 07:43:44','2018-01-28 11:58:15',NULL),(10,'机加工类型',3,'JG','http://dsyy.isart.me/o_1c6gl5kf51va6lr319q41k2otdl9.png',NULL,0,1,'机加工类型','机加工类型','机加工类型','2018-03-05 21:19:44','2018-01-28 11:58:15',NULL),(11,'标品库',3,'GB','http://dsyy.isart.me/o_1c6gl878fbsjnk13pl1rn7l3l9.png',NULL,0,1,'标品库','标品库','标品库','2018-03-05 20:49:22','2018-01-28 11:58:15',NULL);

#
# Structure for table "t_order_info"
#

DROP TABLE IF EXISTS `t_order_info`;
CREATE TABLE `t_order_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `trade_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '订单号',
  `prepay_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '微信预付订单id',
  `code_url` text COLLATE utf8mb4_unicode_ci,
  `user_id` int(11) DEFAULT NULL COMMENT '用户编号',
  `total_fee` int(11) DEFAULT '0' COMMENT '总价（分）',
  `count` int(11) DEFAULT '0' COMMENT '数量',
  `content` text COLLATE utf8mb4_unicode_ci COMMENT '备注',
  `status` tinyint(1) DEFAULT '1' COMMENT '订单状（1：下单成功（待支付）；2：支付成功；3：交易成功；4：退款中；5：退款成功；6：退款失败）',
  `pay_at` datetime DEFAULT NULL COMMENT '支付时间',
  `address_id` int(11) DEFAULT NULL COMMENT '收件人地址编号（t_address_info->id）',
  `invoice_id` int(11) DEFAULT NULL COMMENT '发票编号（t_invoice_info->id）',
  `invoice_type` tinyint(1) DEFAULT '0' COMMENT '发票类型（ 0：普通；1：专用）',
  `logistics_company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '物流公司',
  `logistics_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '物流单号',
  `postage` int(11) DEFAULT NULL COMMENT '邮费（元）',
  `delete` tinyint(1) DEFAULT '0' COMMENT '删除状态（0：正常；1：删除）',
  `updated_at` datetime DEFAULT NULL COMMENT '修改时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='订单表';

#
# Data for table "t_order_info"
#

INSERT INTO `t_order_info` VALUES (1,'33152483920000142296','wx2722264711398329736f12652647580635','weixin://wxpay/bizpayurl?pr=F0y2z2B',14,1,1,NULL,2,'2018-04-28 01:31:17',5,10,1,'sf','12354566666',0,0,'2018-05-13 23:27:42','2018-04-27 22:26:40',NULL),(2,'72152483925100147815','wx27222815893184fc30b0d7231096463689','weixin://wxpay/bizpayurl?pr=qW48LSx',14,1,1,NULL,2,'2018-04-28 01:32:48',5,10,1,NULL,NULL,0,0,'2018-04-28 01:32:48','2018-04-27 22:27:31',NULL),(3,'63152483932800143546',NULL,'https://qr.alipay.com/bax03539btgzs5u5peoi008a',14,1,1,NULL,2,NULL,5,10,1,NULL,NULL,0,0,'2018-05-03 09:31:08','2018-04-27 22:28:48',NULL),(4,'66152483977200144161',NULL,'https://qr.alipay.com/bax03410xjukbwr3zthz003b',14,1,1,NULL,2,NULL,5,10,1,NULL,NULL,0,0,'2018-05-03 09:27:49','2018-04-27 22:36:12',NULL),(5,'39152531111800141331',NULL,'https://qr.alipay.com/bax05791rhnqa2mfrswt20e9',14,1,1,NULL,1,NULL,5,10,1,NULL,NULL,0,1,'2018-05-03 17:24:46','2018-05-03 09:31:58',NULL),(6,'44152531315400148019',NULL,'https://qr.alipay.com/bax00676lr2i4qquq0sv4035',14,1,1,NULL,1,NULL,5,10,1,NULL,NULL,0,1,'2018-05-03 17:24:39','2018-05-03 10:05:54',NULL),(7,'20152531355700147991',NULL,'https://qr.alipay.com/bax05978xz8trsncrmvj40df',14,1,1,NULL,1,NULL,5,10,1,NULL,NULL,0,1,'2018-05-03 17:24:43','2018-05-03 10:12:37',NULL),(8,'21152533914400146996',NULL,'https://qr.alipay.com/bax057522hvfvlybuucm20f0',14,1,1,NULL,2,'2018-05-04 17:43:48',5,10,1,NULL,NULL,0,0,'2018-05-04 17:43:48','2018-05-03 17:19:04',NULL),(9,'54152533955700147985',NULL,'https://qr.alipay.com/bax09258ardaeysgzcjj40fb',14,1,1,NULL,2,'2018-05-04 17:50:36',5,10,1,NULL,NULL,0,0,'2018-05-04 17:50:36','2018-05-03 17:25:57',NULL),(10,'32152534036000144927',NULL,'https://qr.alipay.com/bax011365od61ov45ckz0039',14,1,1,NULL,2,'2018-05-04 18:03:17',5,10,1,NULL,NULL,0,0,'2018-05-04 18:03:17','2018-05-03 17:39:20',NULL),(11,'98152534054800147124','wx0317423160616977ee1342c64089018100','weixin://wxpay/bizpayurl?pr=aq5UEzG',14,1,1,NULL,2,'2018-05-03 20:47:02',5,10,1,NULL,NULL,0,0,'2018-05-03 20:47:02','2018-05-03 17:42:28',NULL),(12,'66152534078000144120',NULL,'https://qr.alipay.com/bax03056igcnqjxlwlf420d8',14,1,1,NULL,2,'2018-05-04 18:10:34',5,10,1,NULL,NULL,0,0,'2018-05-04 18:10:34','2018-05-03 17:46:20',NULL),(13,'41152534085400149592','wx0317473933585737532e8f941290865021','weixin://wxpay/bizpayurl?pr=UOenR7u',14,1,1,NULL,2,'2018-05-03 20:52:15',5,10,1,NULL,NULL,0,0,'2018-05-03 20:52:15','2018-05-03 17:47:34',NULL),(14,'33152593375000148255','wx10142914970480c90de227963120032310','https://qr.alipay.com/bax09149rjdzbbicuhaz00e6',14,12600,1,NULL,1,NULL,5,10,1,NULL,NULL,0,0,'2018-05-10 14:29:20','2018-05-10 14:29:10',NULL),(15,'60152593383400142232','wx1014310423420046c90ea6291509268445','https://qr.alipay.com/bax01234qbmjj2r2zjty208a',14,12600,1,NULL,1,NULL,5,10,1,NULL,NULL,0,0,'2018-05-10 14:31:32','2018-05-10 14:30:34',NULL),(16,'29152593428500188576',NULL,'https://qr.alipay.com/bax02220hze52efv8rrb8004',18,12600,1,NULL,1,NULL,3,NULL,0,NULL,NULL,0,1,'2018-05-14 22:24:09','2018-05-10 14:38:05',NULL),(17,'35152593610100237433',NULL,'https://qr.alipay.com/bax00634zmqyqtvqlm8x40bf',23,12600,1,NULL,1,NULL,12,18,0,NULL,NULL,0,0,'2018-05-10 15:08:37','2018-05-10 15:08:21',NULL),(18,'96152593622000231551',NULL,'https://qr.alipay.com/bax09965wblipuyxjxwp8071',23,10,1,NULL,2,'2018-05-11 15:35:34',12,18,0,NULL,NULL,0,0,'2018-05-11 15:35:34','2018-05-10 15:10:20',NULL),(19,'59152593658500231336',NULL,NULL,23,30,2,NULL,1,NULL,NULL,NULL,0,NULL,NULL,10,0,'2018-05-10 15:16:25','2018-05-10 15:16:25',NULL),(20,'23152610120800184077',NULL,'https://qr.alipay.com/bax02277mkcrq4so5jae80fe',18,5810,1,NULL,1,NULL,3,14,0,NULL,NULL,10,1,'2018-05-14 22:24:07','2018-05-12 13:00:08',NULL),(21,'78152610939800235450',NULL,NULL,23,5810,1,NULL,1,NULL,NULL,NULL,0,NULL,NULL,10,0,'2018-05-12 15:16:38','2018-05-12 15:16:38',NULL),(22,'16152612199900233914',NULL,NULL,23,20,1,NULL,1,NULL,NULL,NULL,0,NULL,NULL,10,0,'2018-05-12 18:46:39','2018-05-12 18:46:39',NULL),(23,'50152621957800222504',NULL,NULL,22,5810,1,NULL,1,NULL,NULL,NULL,0,NULL,NULL,10,0,'2018-05-13 21:52:58','2018-05-13 21:52:58',NULL),(24,'31152622580400234481',NULL,NULL,23,110,1,NULL,1,NULL,NULL,NULL,0,NULL,NULL,10,0,'2018-05-13 23:36:44','2018-05-13 23:36:44',NULL),(25,'98152622589700236715',NULL,NULL,23,27610,4,NULL,1,NULL,NULL,NULL,0,NULL,NULL,10,0,'2018-05-13 23:38:17','2018-05-13 23:38:17',NULL),(26,'58152622611500233993',NULL,NULL,23,500,0,NULL,1,NULL,NULL,NULL,0,NULL,NULL,500,0,'2018-05-13 23:41:55','2018-05-13 23:41:55',NULL),(27,'31152630854000236714',NULL,'https://qr.alipay.com/bax08938ykxw8o4g9dhx002f',23,1000,1,NULL,1,NULL,12,18,0,NULL,NULL,500,0,'2018-05-14 22:35:57','2018-05-14 22:35:40',NULL),(28,'96152630878600237309',NULL,'https://qr.alipay.com/bax09942ijbi0g4emcyr20a8',23,10,1,NULL,2,'2018-05-15 23:04:25',12,18,0,'sf','123',0,0,'2018-05-15 23:04:25','2018-05-14 22:39:46',NULL),(29,'57152630901300232989',NULL,'https://qr.alipay.com/bax05278fv5dv6klh2ps20a3',23,10,1,NULL,3,'2018-05-15 23:07:10',12,18,0,'sf','123',0,0,'2018-05-21 20:02:03','2018-05-14 22:43:33',NULL),(30,'49152635773400183153','wx1512155183449322598c45f23876687034','weixin://wxpay/bizpayurl?pr=FIw36M9',18,10,1,NULL,2,'2018-05-15 15:20:31',16,28,0,NULL,NULL,0,0,'2018-05-15 15:20:31','2018-05-15 12:15:34',NULL),(31,'92152938837300188951','wx191406268103231e1286141e0420297125','weixin://wxpay/bizpayurl?pr=M6FrkcD',18,2800,1,NULL,1,NULL,16,28,0,NULL,NULL,0,0,'2018-06-19 14:06:26','2018-06-19 14:06:13',NULL);

#
# Structure for table "t_searching_info"
#

DROP TABLE IF EXISTS `t_searching_info`;
CREATE TABLE `t_searching_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `goods` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '物品名称',
  `count` int(11) DEFAULT '0' COMMENT '采购数量',
  `unit` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '单位',
  `purity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '纯度',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '联系人姓名',
  `phonenum` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '联系人电话',
  `time` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '需求时效',
  `province` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '省',
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '市',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '公司地址',
  `content` text COLLATE utf8mb4_unicode_ci COMMENT '备注',
  `status` tinyint(1) DEFAULT '0' COMMENT '审核状态（0：待定；1：已联系）',
  `updated_at` datetime DEFAULT NULL COMMENT '修改时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='帮你找货表';

#
# Data for table "t_searching_info"
#

INSERT INTO `t_searching_info` VALUES (12,'乐果/二硫代磷酸二甲酯(甲基乙酰胺)',1,'g','99%','问号先生','13512345678','7天','山东','滨州市','XX号','能找到吗？',0,'2018-04-09 11:07:27','2018-02-05 23:12:26','2018-04-09 11:07:27'),(13,'硅油',20,'mg','96%','问号？？','13512345678','3个月','陕西','榆林市','XXXXXXXXXX','哈哈哈哈，还是我',0,'2018-04-09 11:07:27','2018-02-05 23:16:14','2018-04-09 11:07:27'),(14,'矿泉水',1000,'mg','95%','贤先生','13612345678','1个月','江西','上饶市','￥￥￥','我很急！',0,'2018-04-09 11:07:27','2018-02-08 21:11:58','2018-04-09 11:07:27'),(15,'二氧化锰',6,'g',NULL,'毛要总','15640309805','3天','辽宁','沈阳市','金属所','哈哈哈哈哈哈哈哈哈哈',1,'2018-04-09 11:07:27','2018-03-19 22:50:55','2018-04-09 11:07:27'),(16,'硝酸甘油',100,'g','99.99%','吕兆栓','15068808725','3天','浙江','杭州市','心怡科技','有货请及时联系我',0,'2018-04-09 11:07:27','2018-03-20 10:11:52','2018-04-09 11:07:27'),(17,'二氧化锰',6,'g',NULL,NULL,'15640309805','3天','河北','唐山市','金属所',NULL,0,'2018-04-09 11:07:27','2018-03-25 22:00:31','2018-04-09 11:07:27'),(18,'二氧化锰',6,'g',NULL,NULL,'15640309805','3天','河北','唐山市','金属所',NULL,0,'2018-04-09 11:07:27','2018-03-25 22:00:59','2018-04-09 11:07:27'),(19,'二氧化锰',1,'g','99',NULL,'15757133561','3天','山东',NULL,'恩恩',NULL,0,'2018-04-09 11:07:27','2018-04-01 23:34:52','2018-04-09 11:07:27'),(20,'发广告发布',5,NULL,NULL,NULL,'13080845113','3天','辽宁','沈阳市',NULL,NULL,0,'2018-04-09 11:07:27','2018-04-01 23:36:06','2018-04-09 11:07:27'),(21,'ff',1,'g','33','157566666662','13080845113','3天','浙江',NULL,'s',NULL,0,'2018-04-09 11:07:31','2018-04-02 10:15:16','2018-04-09 11:07:31'),(22,'个',5,'个',NULL,NULL,'15765733561','3天','山东',NULL,NULL,NULL,0,'2018-04-09 11:07:31','2018-04-02 22:33:43','2018-04-09 11:07:31'),(23,'的',2,NULL,NULL,NULL,'15757133561','3天','辽宁',NULL,NULL,NULL,0,'2018-04-09 11:07:27','2018-04-02 22:34:22','2018-04-09 11:07:27'),(24,'个',1,'的',NULL,NULL,'15757133561','3天',NULL,NULL,NULL,NULL,0,'2018-04-09 11:07:31','2018-04-04 22:35:27','2018-04-09 11:07:31'),(25,'娃哈哈',2,'瓶',NULL,NULL,'13012345678','3天','江西','赣州市',NULL,NULL,0,'2018-05-10 14:44:23','2018-04-16 17:21:16','2018-05-10 14:44:23'),(26,'果粒橙',5,'瓶',NULL,NULL,'13012365478','3天','山东','潍坊市','isart',NULL,0,'2018-05-10 14:44:23','2018-04-16 17:25:30','2018-05-10 14:44:23');

#
# Structure for table "t_service_info"
#

DROP TABLE IF EXISTS `t_service_info`;
CREATE TABLE `t_service_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '姓名',
  `phonenum` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '电话',
  `qq` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'QQ号',
  `updated_at` datetime DEFAULT NULL COMMENT '修改时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='客服表';

#
# Data for table "t_service_info"
#

INSERT INTO `t_service_info` VALUES (1,'试剂业务咨询','475677022','475677022','2018-04-09 23:15:04','2018-01-27 15:02:55',NULL),(2,'第三方检测咨询','234567890','234567890','2018-04-01 21:54:03','2018-01-27 15:02:55',NULL),(3,'机加工咨询','345678901123','345678901','2018-04-01 21:54:13','2018-01-27 15:02:57',NULL);

#
# Structure for table "t_suborder_info"
#

DROP TABLE IF EXISTS `t_suborder_info`;
CREATE TABLE `t_suborder_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `sub_trade_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '子订单号',
  `trade_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '父订单号',
  `user_id` int(11) DEFAULT NULL COMMENT '用户编号（t_user_info->id）',
  `goods_id` int(11) DEFAULT NULL COMMENT '商品编号（t_goods_info->id）',
  `goods_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '商品货号',
  `goods_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '商品名称',
  `goods_picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '商品图片',
  `total_fee` int(11) DEFAULT NULL COMMENT '订单价格（分）',
  `goods_unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '商品单位',
  `count` int(11) DEFAULT '0' COMMENT '数量',
  `content` text COLLATE utf8mb4_unicode_ci COMMENT '备注',
  `wl_np` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '物流单号',
  `wl_status` tinyint(1) DEFAULT '0' COMMENT '物流状态（0：备货中 1：已发货 2：配送中 3：已接收）',
  `status` tinyint(1) DEFAULT '0' COMMENT '订单状态（0：正常；1：申请退款；2：退款驳回；3：退款中；4：退款成功）',
  `updated_at` datetime DEFAULT NULL COMMENT '修改时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='子订单表';

#
# Data for table "t_suborder_info"
#

INSERT INTO `t_suborder_info` VALUES (1,'92152483920000142477','33152483920000142296',14,68,'SJ1524147839936','R835552 (R)-(-)-1-[(S)-2-二苯基膦二茂铁乙基-二叔丁基膦, 95%','http://attachments.macklin.cn/img/item/000/83/46198500.png',1,'瓶',1,NULL,NULL,0,0,'2018-04-27 22:26:40','2018-04-27 22:26:40',NULL),(2,'20152483925100145045','72152483925100147815',14,68,'SJ1524147839936','R835552 (R)-(-)-1-[(S)-2-二苯基膦二茂铁乙基-二叔丁基膦, 95%','http://attachments.macklin.cn/img/item/000/83/46198500.png',1,'瓶',1,NULL,NULL,0,0,'2018-04-27 22:27:31','2018-04-27 22:27:31',NULL),(3,'79152483932800142986','63152483932800143546',14,68,'SJ1524147839936','R835552 (R)-(-)-1-[(S)-2-二苯基膦二茂铁乙基-二叔丁基膦, 95%','http://attachments.macklin.cn/img/item/000/83/46198500.png',1,'瓶',1,NULL,NULL,0,0,'2018-04-27 22:28:48','2018-04-27 22:28:48',NULL),(4,'66152483977200143302','66152483977200144161',14,68,'SJ1524147839936','R835552 (R)-(-)-1-[(S)-2-二苯基膦二茂铁乙基-二叔丁基膦, 95%','http://attachments.macklin.cn/img/item/000/83/46198500.png',1,'瓶',1,NULL,NULL,0,0,'2018-04-27 22:36:12','2018-04-27 22:36:12',NULL),(5,'22152531111800143251','39152531111800141331',14,68,'SJ1524147839936','R835552 (R)-(-)-1-[(S)-2-二苯基膦二茂铁乙基-二叔丁基膦, 95%','http://attachments.macklin.cn/img/item/000/83/46198500.png',1,'瓶',1,NULL,NULL,0,0,'2018-05-03 09:31:58','2018-05-03 09:31:58',NULL),(6,'86152531315400141103','44152531315400148019',14,68,'SJ1524147839936','R835552 (R)-(-)-1-[(S)-2-二苯基膦二茂铁乙基-二叔丁基膦, 95%','http://attachments.macklin.cn/img/item/000/83/46198500.png',1,'瓶',1,NULL,NULL,0,0,'2018-05-03 10:05:54','2018-05-03 10:05:54',NULL),(7,'60152531355700149873','20152531355700147991',14,68,'SJ1524147839936','R835552 (R)-(-)-1-[(S)-2-二苯基膦二茂铁乙基-二叔丁基膦, 95%','http://attachments.macklin.cn/img/item/000/83/46198500.png',1,'瓶',1,NULL,NULL,0,0,'2018-05-03 10:12:37','2018-05-03 10:12:37',NULL),(8,'19152533914400141233','21152533914400146996',14,68,'SJ1524147839936','R835552 (R)-(-)-1-[(S)-2-二苯基膦二茂铁乙基-二叔丁基膦, 95%','http://attachments.macklin.cn/img/item/000/83/46198500.png',1,'瓶',1,NULL,NULL,0,0,'2018-05-03 17:19:04','2018-05-03 17:19:04',NULL),(9,'27152533955700143722','54152533955700147985',14,68,'SJ1524147839936','R835552 (R)-(-)-1-[(S)-2-二苯基膦二茂铁乙基-二叔丁基膦, 95%','http://attachments.macklin.cn/img/item/000/83/46198500.png',1,'瓶',1,NULL,NULL,0,0,'2018-05-03 17:25:57','2018-05-03 17:25:57',NULL),(10,'30152534036000145238','32152534036000144927',14,68,'SJ1524147839936','R835552 (R)-(-)-1-[(S)-2-二苯基膦二茂铁乙基-二叔丁基膦, 95%','http://attachments.macklin.cn/img/item/000/83/46198500.png',1,'瓶',1,NULL,NULL,0,0,'2018-05-03 17:39:20','2018-05-03 17:39:20',NULL),(11,'81152534054800141580','98152534054800147124',14,68,'SJ1524147839936','R835552 (R)-(-)-1-[(S)-2-二苯基膦二茂铁乙基-二叔丁基膦, 95%','http://attachments.macklin.cn/img/item/000/83/46198500.png',1,'瓶',1,NULL,NULL,0,0,'2018-05-03 17:42:28','2018-05-03 17:42:28',NULL),(12,'50152534078000149582','66152534078000144120',14,68,'SJ1524147839936','R835552 (R)-(-)-1-[(S)-2-二苯基膦二茂铁乙基-二叔丁基膦, 95%','http://attachments.macklin.cn/img/item/000/83/46198500.png',1,'瓶',1,NULL,NULL,0,0,'2018-05-03 17:46:20','2018-05-03 17:46:20',NULL),(13,'76152534085400147724','41152534085400149592',14,68,'SJ1524147839936','R835552 (R)-(-)-1-[(S)-2-二苯基膦二茂铁乙基-二叔丁基膦, 95%','http://attachments.macklin.cn/img/item/000/83/46198500.png',1,'瓶',1,NULL,NULL,0,0,'2018-05-03 17:47:34','2018-05-03 17:47:34',NULL),(14,'68152593375000146061','33152593375000148255',14,70,'SJ1525933339214','二氧化锰','http://dsyy.isart.me/o_1cd4b7d17tfd1j5fodhf491bfb9.png',12600,'瓶',1,NULL,NULL,0,0,'2018-05-10 14:29:10','2018-05-10 14:29:10',NULL),(15,'93152593383400147558','60152593383400142232',14,70,'SJ1525933339214','二氧化锰','http://dsyy.isart.me/o_1cd4b7d17tfd1j5fodhf491bfb9.png',12600,'瓶',1,NULL,NULL,0,0,'2018-05-10 14:30:34','2018-05-10 14:30:34',NULL),(16,'18152593428500187504','29152593428500188576',18,70,'SJ1525933339214','二氧化锰','http://dsyy.isart.me/o_1cd4b7d17tfd1j5fodhf491bfb9.png',12600,'瓶',1,NULL,NULL,0,0,'2018-05-10 14:38:05','2018-05-10 14:38:05',NULL),(17,'16152593610100235435','35152593610100237433',23,70,'SJ1525933339214','二氧化锰','http://dsyy.isart.me/o_1cd4b7d17tfd1j5fodhf491bfb9.png',12600,'瓶',1,NULL,NULL,0,0,'2018-05-10 15:08:21','2018-05-10 15:08:21',NULL),(18,'91152593622000232043','96152593622000231551',23,70,'SJ1525933339214','二氧化锰','http://dsyy.isart.me/o_1cd4b7d17tfd1j5fodhf491bfb9.png',10,'瓶',1,NULL,NULL,0,0,'2018-05-10 15:10:20','2018-05-10 15:10:20',NULL),(19,'77152593658500234614','59152593658500231336',23,70,'SJ1525933339214','二氧化锰','http://dsyy.isart.me/o_1cd4b7d17tfd1j5fodhf491bfb9.png',10,'瓶',2,NULL,NULL,0,0,'2018-05-10 15:16:25','2018-05-10 15:16:25',NULL),(20,'100152610120800189676','23152610120800184077',18,79,'SJ1526041052433','二氧化锰','http://dsyy.isart.me/o_1cd4l7et81d7l1qfu1rq130o11319.png',5800,'瓶',1,NULL,NULL,0,0,'2018-05-12 13:00:08','2018-05-12 13:00:08',NULL),(21,'44152610939800238448','78152610939800235450',23,79,'SJ1526041052433','二氧化锰','http://dsyy.isart.me/o_1cd9hgehp11651mpo59t7cupmb9.png',5800,'瓶',1,NULL,NULL,0,0,'2018-05-12 15:16:38','2018-05-12 15:16:38',NULL),(22,'74152612199900237642','16152612199900233914',23,70,'SJ1525933339214','二氧化锰','http://dsyy.isart.me/o_1cd9hgehp11651mpo59t7cupmb9.png',10,'瓶',1,NULL,NULL,0,0,'2018-05-12 18:46:39','2018-05-12 18:46:39',NULL),(23,'15152621957800224105','50152621957800222504',22,79,'SJ1526041052433','二氧化锰','http://dsyy.isart.me/o_1cd9hgehp11651mpo59t7cupmb9.png',5800,'瓶',1,NULL,NULL,0,0,'2018-05-13 21:52:58','2018-05-13 21:52:58',NULL),(24,'57152622580400237239','31152622580400234481',23,85,'HC1526223024266','烧杯','http://dsyy.isart.me/o_1cd9e29np8vfkup1ihm1vqab979.png',100,'个',1,NULL,NULL,0,0,'2018-05-13 23:36:44','2018-05-13 23:36:44',NULL),(25,'55152622589700236055','98152622589700236715',23,81,'SJ1526041915944','硫酸铜，五水合物','http://dsyy.isart.me/o_1cd9h5bq3f76sb512381ba21240e.png',6900,'瓶',4,NULL,NULL,0,0,'2018-05-13 23:38:17','2018-05-13 23:38:17',NULL),(26,'99152622611500238876','58152622611500233993',23,85,'HC1526223024266','烧杯','http://dsyy.isart.me/o_1cd9e29np8vfkup1ihm1vqab979.png',100,'个',NULL,NULL,NULL,0,0,'2018-05-13 23:41:55','2018-05-13 23:41:55',NULL),(27,'100152630854000238350','31152630854000236714',23,86,'HC1526293088933','烧杯','http://dsyy.isart.me/o_1cd9e29np8vfkup1ihm1vqab979.png',500,'个',1,NULL,NULL,0,0,'2018-05-14 22:35:40','2018-05-14 22:35:40',NULL),(28,'67152630878600238807','96152630878600237309',23,86,'HC1526293088933','烧杯','http://dsyy.isart.me/o_1cd9e29np8vfkup1ihm1vqab979.png',10,'个',1,NULL,NULL,0,0,'2018-05-14 22:39:46','2018-05-14 22:39:46',NULL),(29,'66152630901300231574','57152630901300232989',23,86,'HC1526293088933','烧杯','http://dsyy.isart.me/o_1cd9e29np8vfkup1ihm1vqab979.png',10,'个',1,NULL,NULL,0,0,'2018-05-14 22:43:33','2018-05-14 22:43:33',NULL),(30,'61152635773400184386','49152635773400183153',18,70,'SJ1525933339214','二氧化锰','http://dsyy.isart.me/o_1cd9hgehp11651mpo59t7cupmb9.png',10,'瓶',1,NULL,NULL,0,0,'2018-05-15 12:15:34','2018-05-15 12:15:34',NULL),(31,'42152938837300183072','92152938837300188951',18,112,'HC1526734562635','烧杯','http://dsyy.isart.me/o_1cd9e29np8vfkup1ihm1vqab979.png',2800,'个',1,NULL,NULL,0,0,'2018-06-19 14:06:13','2018-06-19 14:06:13',NULL);

#
# Structure for table "t_user_info"
#

DROP TABLE IF EXISTS `t_user_info`;
CREATE TABLE `t_user_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `nick_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '昵称',
  `real_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '真实姓名',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '密码',
  `xcx_openid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '小程序openid',
  `app_openid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'APP openid',
  `fwh_openid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '服务号openid',
  `web_openid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'web openid',
  `unionid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '统一unionid',
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'token',
  `phonenum` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '电话',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '电子邮件',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '头像',
  `gender` tinyint(1) DEFAULT NULL COMMENT '性别（1：男；2：女）',
  `qq` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'QQ号',
  `wechat` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '微信号',
  `score` int(11) DEFAULT '0' COMMENT '积分',
  `updated_at` datetime DEFAULT NULL COMMENT '修改时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='用户表';

#
# Data for table "t_user_info"
#

INSERT INTO `t_user_info` VALUES (1,'Amy',NULL,'21232f297a57a5a743894a0e4a801fc3',NULL,NULL,NULL,NULL,NULL,NULL,'13012345678',NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-01-25 17:35:26',NULL),(5,'未命名',NULL,'d41d8cd98f00b204e9800998ecf8427e',NULL,NULL,NULL,NULL,NULL,'C16E5E8B031D1A1D09CC5625BBE219E5','13512345678',NULL,NULL,NULL,NULL,NULL,0,'2018-02-03 08:29:53','2018-02-03 08:29:53',NULL),(6,'未命名',NULL,'d41d8cd98f00b204e9800998ecf8427e',NULL,NULL,NULL,NULL,NULL,'AB8805BFF163086AE3AAF46D6FF8AB25','13612345678',NULL,NULL,NULL,NULL,NULL,0,'2018-02-03 08:35:00','2018-02-03 08:35:00',NULL),(7,'未命名',NULL,'96e79218965eb72c92a549dd5a330112',NULL,NULL,NULL,NULL,NULL,'1D0A38A159C4516887FBEB990EDB983E','13712345678',NULL,NULL,NULL,NULL,NULL,0,'2018-02-04 09:52:14','2018-02-03 08:36:29',NULL),(8,'未命名',NULL,'e10adc3949ba59abbe56e057f20f883e',NULL,NULL,NULL,NULL,NULL,'D9AAA8381810F138E5C3ECF6966BDC0D','13112345678',NULL,NULL,NULL,NULL,NULL,0,'2018-02-04 09:58:15','2018-02-04 09:58:15',NULL),(9,'未命名',NULL,'e10adc3949ba59abbe56e057f20f883e',NULL,NULL,NULL,NULL,NULL,'09F8B866A89BB2926B65FAE094425CE1',NULL,'123@qq.com',NULL,NULL,NULL,NULL,0,'2018-02-04 22:36:18','2018-02-04 22:06:12',NULL),(10,'未命名',NULL,'c33367701511b4f6020ec61ded352059',NULL,NULL,NULL,NULL,NULL,'36FEB1AA8B991A2382BAC60198ADD76B','13312345678',NULL,NULL,NULL,NULL,NULL,0,'2018-02-08 16:28:14','2018-02-04 22:13:34',NULL),(11,'未命名',NULL,'e10adc3949ba59abbe56e057f20f883e',NULL,NULL,NULL,NULL,NULL,'E401D9A106CF46FEAA9F2916C0FEA111','13212345678',NULL,NULL,NULL,NULL,NULL,0,'2018-04-16 22:04:08','2018-02-05 21:55:00',NULL),(12,'未命名',NULL,'4297f44b13955235245b2497399d7a93',NULL,NULL,NULL,NULL,NULL,'DA2CF5016940C20CA434CEB84967F190',NULL,'123@123.com',NULL,NULL,NULL,NULL,0,'2018-02-05 21:58:27','2018-02-05 21:57:22',NULL),(13,'未命名',NULL,'c33367701511b4f6020ec61ded352059',NULL,NULL,NULL,NULL,NULL,'51AEA4A5C3221FEC88315A79A67BD038','13812345678',NULL,NULL,NULL,NULL,NULL,0,'2018-02-08 21:28:07','2018-02-08 21:26:43',NULL),(14,'Amy冰麒麟','Amy','c33367701511b4f6020ec61ded352059',NULL,NULL,NULL,NULL,NULL,'08A7FBD7F6E0A1C1533CAB144BE15534','13412345678','123@hotmail.com','http://dsyy.isart.me/o_1c7v4egggsaa6221eqghm39ac9.png',1,'123456789','Amy_bql',119,'2018-04-16 17:47:30','2018-02-08 21:29:16',NULL),(15,'未命名',NULL,'afdd0b4ad2ec172c586e2150770fbf9e',NULL,NULL,NULL,NULL,NULL,'46B1CFB6C6E1F71940830BA47A91F0A7','15840345959',NULL,NULL,NULL,NULL,NULL,0,'2018-02-22 14:20:05','2018-02-22 14:20:05',NULL),(16,'未命名','','e10adc3949ba59abbe56e057f20f883e',NULL,NULL,NULL,NULL,NULL,'F3FACE0B25832B84E326D65FE962A63E',NULL,'123@321.com',NULL,1,'123456','wechat',0,'2018-04-16 22:02:33','2018-02-24 18:42:20',NULL),(17,'未命名',NULL,'2423ac1ecb577d3150c6105575380b02',NULL,NULL,NULL,NULL,NULL,'71FD409E9BB5A4AAEE70663C51707EF1','17615110074',NULL,NULL,NULL,NULL,NULL,0,'2018-02-27 10:24:32','2018-02-27 10:24:32',NULL),(18,'MYZ','毛耀宗','a424367375c7813bdbdbdbeda0819223',NULL,NULL,NULL,NULL,NULL,'00D7AA4D44DA178C45BAFF7A625DFD4C','15640309805',NULL,'http://dsyy.isart.me/o_1cdfhb71q1db818701t0s1o8j9ni9.jpg',1,'269756526','15640309805',80,'2018-05-14 22:37:25','2018-02-28 14:38:15',NULL),(19,'未命名',NULL,'9188023184a4bec608e7443634ec466b',NULL,NULL,NULL,NULL,NULL,'AEF39C97FDC368331D180DD8EDE729C8','13002431879',NULL,NULL,NULL,NULL,NULL,0,'2018-03-01 17:02:39','2018-03-01 17:02:39',NULL),(20,'未命名','吕兆栓','e10adc3949ba59abbe56e057f20f883e',NULL,NULL,NULL,NULL,NULL,'E6E9B99AE25CB1617BE3E95BEB8588C3','15068808725',NULL,'http://dsyy.isart.me/o_1c90j0loh31rf131pto1fe01fga9.jpg',1,'1656108196','lvshuanshuan',0,'2018-03-20 10:15:27','2018-03-20 10:09:28',NULL),(21,'未命名',NULL,'4f807c45ccd8c09ee82a20a0ba440204',NULL,NULL,NULL,NULL,NULL,'4C635C76445D1127BC93FE94DBCEAB9B','13080845113',NULL,NULL,NULL,NULL,NULL,100,'2018-03-20 13:49:55','2018-03-20 10:35:29',NULL),(22,'未命名',NULL,'9c755c3607fa7fda554627ebd7919562',NULL,NULL,NULL,NULL,NULL,'10D25AA5860A7447426797127AEEE8AF','18609813058',NULL,NULL,NULL,NULL,NULL,0,'2018-03-20 11:01:50','2018-03-20 11:01:50',NULL),(23,'未命名',NULL,'4f807c45ccd8c09ee82a20a0ba440204',NULL,NULL,NULL,NULL,NULL,'121918745C568EF6F070FA5BD86FC962','15757133561',NULL,NULL,NULL,NULL,NULL,190,'2018-04-02 02:44:18','2018-03-20 17:05:55',NULL),(24,'莫愁莫愁','李洋','24ef9a2bad6ebce450c60e85456d63ec',NULL,NULL,NULL,NULL,NULL,'BF5CD451BD19A09DE03A978EDD22AB6A','15038094563',NULL,NULL,1,NULL,NULL,0,'2018-03-26 16:38:13','2018-03-25 21:30:16',NULL),(25,'未命名',NULL,'2423ac1ecb577d3150c6105575380b02',NULL,NULL,NULL,NULL,NULL,'EB43606B68B48F1BC40939DAA3A9A683','17640021270',NULL,NULL,NULL,NULL,NULL,0,'2018-04-09 09:44:02','2018-04-09 09:44:02',NULL),(26,'未命名',NULL,'25f9e794323b453885f5181f1b624d0b',NULL,NULL,NULL,NULL,NULL,'D4DCD73984BA329EAF13081416A99A32','17642054339',NULL,NULL,NULL,NULL,NULL,0,'2018-04-09 15:10:05','2018-04-09 15:10:05',NULL),(27,'未命名',NULL,'e10adc3949ba59abbe56e057f20f883e',NULL,NULL,NULL,NULL,NULL,'50C7E79580AE33169070489400CB67DB','13087654321',NULL,NULL,NULL,NULL,NULL,0,'2018-04-16 21:29:38','2018-04-16 21:29:38',NULL),(28,'Amy',NULL,'e10adc3949ba59abbe56e057f20f883e',NULL,NULL,NULL,'ordUM1CMZlUYv6Ld4cS9xtpOLXag','oaanu1BUQLEjoXm__38DshjoA620',NULL,'13912345678',NULL,'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJcWJ6ARicUWf9TiaYwsaRZXthHz321dRMJgcRvRzpRYOg9hZt0UaaZ5Lw1mFjic9ibst39hdBickibrAfQ/132',2,NULL,NULL,0,'2018-06-20 10:54:53','2018-06-20 10:42:57',NULL),(29,'TerryQi',NULL,NULL,NULL,NULL,NULL,'ordUM1KaVnXPawKzGq6j8cwOAcG4','oaanu1DIkPy0Oj4olGElUyCac9GA',NULL,NULL,NULL,'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLibhTSBgobtCic0hU1IBzMriaOfMAAGxnFibw7YNO1LTqZ7lYR0ZkL05ZbXxT1tzJN9m6WFNKEBMvlag/132',1,NULL,NULL,0,'2018-06-20 11:37:46','2018-06-20 11:37:46',NULL);

#
# Structure for table "t_vertify_info"
#

DROP TABLE IF EXISTS `t_vertify_info`;
CREATE TABLE `t_vertify_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `phonenum` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '手机号',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '邮箱',
  `code` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '验证码',
  `status` tinyint(1) DEFAULT '0' COMMENT '状态（0：未验证；1：验证）',
  `updated_at` datetime DEFAULT NULL COMMENT '修改时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='验证码表';

#
# Data for table "t_vertify_info"
#

INSERT INTO `t_vertify_info` VALUES (1,NULL,'zm_happiness66@163.com','6220',0,'2018-04-20 13:23:34','2018-04-20 13:23:34',NULL),(2,'13912345678',NULL,'4541',1,'2018-06-20 10:54:53','2018-06-20 10:46:16',NULL);

#
# Structure for table "t_word_info"
#

DROP TABLE IF EXISTS `t_word_info`;
CREATE TABLE `t_word_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '名称',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `updated_at` datetime DEFAULT NULL COMMENT '修改时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='热搜关键字推荐表';

#
# Data for table "t_word_info"
#

INSERT INTO `t_word_info` VALUES (1,'CNC',0,'2018-03-06 10:19:53','2018-03-06 10:11:08',NULL),(2,'3-甲基黄嘌呤',0,'2018-03-06 10:19:55','2018-03-06 10:05:45',NULL),(3,'甲醛',0,'2018-03-06 10:27:11','2018-03-06 10:27:11',NULL),(4,'乙醛',0,'2018-03-06 10:27:23','2018-03-06 10:27:23',NULL),(5,'丙醛',0,'2018-03-06 10:27:35','2018-03-06 10:27:35',NULL),(6,'1076-22-8',0,'2018-03-06 10:35:26','2018-03-06 10:28:03',NULL),(7,'熊果酸',0,'2018-03-16 09:32:06','2018-03-06 10:28:29',NULL);
