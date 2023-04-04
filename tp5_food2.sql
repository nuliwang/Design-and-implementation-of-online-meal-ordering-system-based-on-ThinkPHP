-- MySQL dump 10.13  Distrib 5.7.33, for Linux (x86_64)
--
-- Host: localhost    Database: tp5_food2
-- ------------------------------------------------------
-- Server version	5.7.33-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `shop_address`
--

DROP TABLE IF EXISTS `shop_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_address` (
  `address_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '收货地址id',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `consignee` varchar(60) NOT NULL COMMENT '收货人',
  `phone` char(12) NOT NULL COMMENT '手机号',
  `is_default` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否设为默认',
  `prov` varchar(255) DEFAULT NULL COMMENT '省',
  `city` varchar(255) DEFAULT NULL COMMENT '市',
  `district` varchar(255) DEFAULT NULL COMMENT '区',
  `address_detail` varchar(255) DEFAULT NULL COMMENT '地址',
  `address_info` varchar(255) DEFAULT NULL COMMENT '详细地址',
  PRIMARY KEY (`address_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_address`
--

LOCK TABLES `shop_address` WRITE;
/*!40000 ALTER TABLE `shop_address` DISABLE KEYS */;
INSERT INTO `shop_address` VALUES (33,18,'王翔名','13163990330',1,'河北省','沧州市','任丘市','华北石油','河北省沧州市任丘市华北石油'),(34,18,'王翔名','13163990330',0,'天津市','天津城区','南开区','迎水道','天津市天津城区南开区 迎水道'),(35,18,'王翔名','13163990330',0,NULL,'厦门市','集美区','集美大道','厦门市集美区集美大道');
/*!40000 ALTER TABLE `shop_address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_admin`
--

DROP TABLE IF EXISTS `shop_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `name` char(50) NOT NULL COMMENT '用户名',
  `password` char(50) NOT NULL COMMENT '用户密码',
  `addtime` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '本次登录时间',
  `static` int(11) DEFAULT '0' COMMENT '1为在线',
  `mobile` char(50) DEFAULT NULL COMMENT '手机号码',
  `email` char(50) DEFAULT NULL COMMENT '邮箱',
  `uimage` char(50) DEFAULT '/uploads/1.jpg' COMMENT '用户上传的头像地址',
  `type` tinyint(2) DEFAULT '1' COMMENT '1管理员2商户',
  `status` tinyint(1) DEFAULT '0' COMMENT '1正常登陆0禁用',
  PRIMARY KEY (`admin_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_admin`
--

LOCK TABLES `shop_admin` WRITE;
/*!40000 ALTER TABLE `shop_admin` DISABLE KEYS */;
INSERT INTO `shop_admin` VALUES (22,'大老板','e10adc3949ba59abbe56e057f20f883e','2018-04-07 12:54:15',1,'15350396762','1071655938@qq.com','/uploads/1522822611.png',1,1),(28,'浙江餐饮','e10adc3949ba59abbe56e057f20f883e','2021-01-12 06:15:07',0,'18170724524',NULL,'/uploads/1.jpg',2,1),(41,'湘爱','e10adc3949ba59abbe56e057f20f883e','2021-01-24 03:18:17',0,'12312312312','123@qq.com','/uploads/1.jpg',2,1),(45,'肯德基','e10adc3949ba59abbe56e057f20f883e','2021-01-26 06:41:41',0,'13163990330',NULL,'/uploads/1.jpg',2,1),(46,'芙南人','e10adc3949ba59abbe56e057f20f883e','2021-01-29 05:35:10',0,'12345678910','','/uploads/1.jpg',2,1),(50,'米斯特比萨','e10adc3949ba59abbe56e057f20f883e','2021-01-31 04:06:38',0,'13741552111','','/uploads/1.jpg',2,0),(54,'汉丽轩海鲜火锅烤肉自助','e10adc3949ba59abbe56e057f20f883e','2021-01-31 04:34:00',0,'15522263568','','/uploads/1.jpg',2,1),(55,'麦当劳','e10adc3949ba59abbe56e057f20f883e','2021-01-31 04:41:23',0,'13163990330','838029835@qq.com','/uploads/1.jpg',2,1),(57,'必胜客','e10adc3949ba59abbe56e057f20f883e','2021-02-06 03:55:57',0,'13163990330','838029835@qq.com','/uploads/1.jpg',2,1),(63,'三样菜','e10adc3949ba59abbe56e057f20f883e','2021-02-22 07:31:21',0,'15265854215','','/uploads/1.jpg',2,1),(64,'老屋川菜','e10adc3949ba59abbe56e057f20f883e','2021-02-22 07:35:08',0,'13526566985','','/uploads/1.jpg',2,1),(65,'渝信川菜','e10adc3949ba59abbe56e057f20f883e','2021-02-22 07:38:21',0,'16588569563','','/uploads/1.jpg',2,1),(66,'眉州东坡','e10adc3949ba59abbe56e057f20f883e','2021-02-22 07:39:06',0,'16855268966','','/uploads/1.jpg',2,1),(67,'湘菜馆','e10adc3949ba59abbe56e057f20f883e','2021-02-22 07:41:28',0,'16584225127','','/uploads/1.jpg',2,1),(68,'酷湘','e10adc3949ba59abbe56e057f20f883e','2021-02-22 07:42:10',0,'16855475124','','/uploads/1.jpg',2,1),(69,'新派小长沙湘菜馆','e10adc3949ba59abbe56e057f20f883e','2021-02-22 07:42:55',0,'16523554211','','/uploads/1.jpg',2,1),(71,'永和大王（蕾莎店）','e10adc3949ba59abbe56e057f20f883e','2021-02-28 13:12:29',0,'13163990330',NULL,'/uploads/1.jpg',2,1),(72,'正新鸡排','e10adc3949ba59abbe56e057f20f883e','2021-05-10 15:11:36',0,'13163990330',NULL,'/uploads/1.jpg',2,1),(73,'湾仔码头','e10adc3949ba59abbe56e057f20f883e','2021-05-10 15:13:21',0,'13163990330','','/uploads/1.jpg',2,1),(74,'星巴克','e10adc3949ba59abbe56e057f20f883e','2021-05-10 15:16:14',0,'13163990330','','/uploads/1.jpg',2,1),(75,'喜茶','e10adc3949ba59abbe56e057f20f883e','2021-05-10 15:16:59',0,'13163990330','','/uploads/1.jpg',2,1),(76,'真功夫','e10adc3949ba59abbe56e057f20f883e','2021-05-10 15:18:17',0,'13163990330','','/uploads/1.jpg',2,1),(77,'小郡肝','e10adc3949ba59abbe56e057f20f883e','2021-05-10 15:19:34',0,'13163990330','','/uploads/1.jpg',2,1);
/*!40000 ALTER TABLE `shop_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_article`
--

DROP TABLE IF EXISTS `shop_article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_article` (
  `article_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文章id',
  `title` varchar(255) NOT NULL COMMENT '文章标题',
  `content` text NOT NULL COMMENT '文章内容',
  `author` varchar(60) DEFAULT NULL COMMENT '发布人',
  `add_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '发布时间',
  `click` int(11) DEFAULT '0' COMMENT '点击量',
  `article_imgurl` varchar(255) DEFAULT '/uploads/1.jpg' COMMENT '图片的地址',
  `classify` char(50) DEFAULT NULL COMMENT '0├行业动态1├行业资讯2├行业新闻',
  `type` char(50) DEFAULT NULL COMMENT '文章类型',
  `keyword` varchar(255) DEFAULT NULL COMMENT '文章关键字',
  `state` int(11) DEFAULT '1' COMMENT '0下线，1在线',
  `abstract` varchar(255) DEFAULT NULL COMMENT '文章摘要',
  `allowcomments` int(11) DEFAULT '1' COMMENT '1允许0不允许',
  PRIMARY KEY (`article_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_article`
--

LOCK TABLES `shop_article` WRITE;
/*!40000 ALTER TABLE `shop_article` DISABLE KEYS */;
INSERT INTO `shop_article` VALUES (59,'永和备件库搬仓影响售后处理时效公告','<p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 微软雅黑; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">尊敬的各位京东用户：</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 微软雅黑; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\"><br>为了扩充备件库仓储面积，缩短售后服务商品流转路途，提高服务时效，故于4月5日启动搬仓工作，于4月10日全面恢复业务。以此为广大网友提供更加优质快捷的售后服务。 搬仓期间，可能会造成少量返修订单处理时效较平时有所延误，对此我司深表歉意！在此期间，如您所申请的返修商品未及时得到处理，请您耐心等待，我司将尽快为您解决问题！由此所造成的不便之处，敬请广大网友谅解！</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 微软雅黑; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\"><br>感谢您对京东商城一如既往的支持和理解，祝广大网友购物愉快！</p>','大老板','2021-05-13 07:12:46',609,'/uploads/1523111642.png','0','2','时效公告',1,'永和备件库搬仓影响售后处理时效公告',1),(60,'关于暂停违规用户享用PLUS会员权益的声明','<p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 微软雅黑; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">尊敬的各位用户：</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 微软雅黑; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\"><br/>PLUS会员项目自诞生以来，不断提升服务品质，并根据用户需求，提供了丰富的权益，例如360元/年的运费券礼包、免费上门退换货、9折服饰品类券、100元全品类专享券、和数以百万计的会员专享价商品等，受到广大用户的认可和喜爱，会员数量也得以高速增长。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 微软雅黑; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\"><br/>然而，近日发现PLUS会员中存在一批“职业黄牛”、“职业代购”、以及存在经销商采购行为的用户，频繁利用PLUS会员权益违规获利。这类行为影响了PLUS会员体系的正常运营，严重损害了广大PLUS会员的权益。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 微软雅黑; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\"><br/>根据后台运营数据及风控系统等监测显示，“职业黄牛”或“职业代购”会以非个人消费为目的，在商城多次下单，并将所购商品转卖给多个第三方；或利用非常规手段进行批量“抢券”、“秒杀”。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 微软雅黑; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\"><br/>在上述行为中，“职业黄牛”或“职业代购”不仅将订单返还的大量京豆据为己有，更利用专享价、优惠券等PLUS专属权益从中赚取差价、获取利润，使京东PLUS对于商品的专项优惠补贴，不少都流入了他们的口袋；同时，批量“抢券”“秒杀”的行为也大量侵占了其他PLUS用户应公平获取的资源，严重损害了广大PLUS会员的应享权益和购物体验。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 微软雅黑; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\"><br/>PLUS会员项目始终把会员的购物体验和服务品质放在首位，对于享受其权益和服务的对象，在用户开通PLUS会籍过程中，站内页面已明确说明，用户应当合理使用其享有的会员权益，除为实现自身的会员利益外，不得利用其享有的权益违规获利、或以任何形式售卖其所享有的权益或滥用其享有的权益。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 微软雅黑; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\"><br/>为保障广大PLUS会员的权益和体验，经过京东后台运营数据的筛查、确认后，将与个人消费行为不符合开通条件及平台规定、在享受PLUS会员权益过程中存在大量违规行为的用户，予以暂停PLUS会员权益处理。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 微软雅黑; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\"><br/>我们一直致力于保障公平公正的电商交易环境，努力为消费者创造健康的网络消费环境，提供更高品质的网购服务体验。</p><p><br/></p>','大老板','2021-05-13 02:29:48',575,'/uploads/1523111984.png','2','2','PLUS会员权益的声明',1,'关于暂停违规用户享用PLUS会员权益的声明',1),(61,'上海市、浙江省受大雪天气影响延误配送','<p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 微软雅黑; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">尊敬的各位客户：</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 微软雅黑; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\"><br/>受大雪天气影响导致大面积高速道路封路，上海市、浙江省订单配送将受到影响。如果您在订购的商品未能正常送达，请您耐心等待，商城会尽最大努力尽快为您配送，由此所造成的不便之处，敬请广大网友谅解！</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 微软雅黑; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\"><br/>感谢您对商城一如既往的支持和理解，祝广大网友购物愉快！</p><p><br/></p>','大老板','2021-05-13 02:29:46',608,'/uploads/1523112193.png','2','2','上海市',1,'上海市、浙江省受大雪天气影响延误配送',1),(63,'韩国高端美妆belif、VDL入驻','<p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 微软雅黑; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">亲爱的各位网友：</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 微软雅黑; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\"><br/></p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 微软雅黑; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">近日，继承英国150多年传统制造工艺与草本配方的高端护肤品牌碧研菲（belif）京东自营官方旗舰店开业，“水分膨润啫哩霜3件套礼盒”与“匈牙利女王保湿水润精华3件套礼盒”专供套装在京东独家首发。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 微软雅黑; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\"><br/></p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 微软雅黑; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">同期，时尚年轻的专业彩妆品牌薇蒂艾儿（VDL）京东自营官方旗舰店上线，清新亮肤妆前乳、美好银镜垫粉底液等多款新品火热开售，为您带来来自韩国的高端、时尚彩妆体验。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 微软雅黑; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\"><br/></p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 微软雅黑; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">作为LG生活健康公司旗下的高端护肤品牌，碧研菲（belif）精选优质的草本原料，研发和推出了符合现代人肌肤特质的“草本配方”，并收获了出色的产品效果与英国草本专家认证。碧研菲（belif）在2013和2014年连续2年在韩国4大百货商店里的销售第一。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 微软雅黑; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\"><br/></p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 微软雅黑; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">同为LG生活健康公司旗下的薇蒂艾儿（VDL），不断尝试前沿彩妆技术，为全球女性打造出强烈、生动、年轻的彩妆产品，现已成为韩国代表性彩妆品牌之一。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 微软雅黑; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\"><br/></p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 微软雅黑; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\">LG生活健康作为LG集团的创始母公司，成立于1947年，至今已有60余年的历史，是韩国快消行业的龙头企业。一直坚持自然美肤概念的LG生活健康，致力实现每个人追求美丽的梦想。早在碧研菲（belif）、薇蒂艾儿（VDL）入驻之前，LG生活健康旗下高端美妆品牌后（the history of 后）、苏秘（SUM37°）及大众品牌菲诗小铺（the face shop）均已入驻京东，实现销售稳步增长。</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 微软雅黑; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\"><br/></p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: 微软雅黑; font-size: 14px; white-space: normal; background-color: rgb(255, 255, 255);\"><span style=\"color: rgb(102, 102, 102); font-family: 微软雅黑; font-size: 14px; background-color: rgb(255, 255, 255);\">祝您购物愉快！</span></p><p><br/></p>','大老板','2021-05-13 02:29:43',683,'/uploads/1523112639.png','0','2','韩国高端美妆belif、VDL入驻',1,'韩国高端美妆belif、VDL入驻',1);
/*!40000 ALTER TABLE `shop_article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_car`
--

DROP TABLE IF EXISTS `shop_car`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_car` (
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `goods_info` varchar(255) DEFAULT NULL COMMENT '商品id',
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_car`
--

LOCK TABLES `shop_car` WRITE;
/*!40000 ALTER TABLE `shop_car` DISABLE KEYS */;
INSERT INTO `shop_car` VALUES (1,'{\"47\":\"1\",\"40\":1,\"46\":1}'),(24,'{\"43\":\"5\",\"41\":1}'),(18,'{\"59\":1,\"50\":1}'),(23,'{\"46\":1}');
/*!40000 ALTER TABLE `shop_car` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_classify`
--

DROP TABLE IF EXISTS `shop_classify`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_classify` (
  `classify_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` char(50) DEFAULT NULL COMMENT '产品的名字',
  `pid` int(11) DEFAULT '0' COMMENT '产品的关联字段',
  `path` char(50) DEFAULT NULL COMMENT '路径',
  `level` int(11) DEFAULT NULL COMMENT '父级',
  `bid` int(11) DEFAULT '0' COMMENT '父级的id',
  `status` tinyint(2) DEFAULT '1' COMMENT '1显示0不显示',
  `merchant_list` varchar(255) DEFAULT NULL COMMENT '商铺列表',
  PRIMARY KEY (`classify_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_classify`
--

LOCK TABLES `shop_classify` WRITE;
/*!40000 ALTER TABLE `shop_classify` DISABLE KEYS */;
INSERT INTO `shop_classify` VALUES (87,'简餐便当',0,'0,1',1,0,1,'2,16,17,19,23,27,30,32,31,45,46'),(88,'汉堡披萨',0,'0,1',1,0,1,'18,20,28,35,36,37,30,32'),(89,'炸鸡炸串',0,'0,1',1,0,1,'52,47'),(90,'奶茶果汁',0,'0,1',1,0,1,'49,50'),(91,'川湘菜',0,'0,1',1,0,1,'1,16,24,38,39,40,41,42,43,44'),(92,'盖浇饭',0,'0,1',1,0,1,'51'),(93,'米粉面馆',0,'0,1',1,0,1,'17,21,26'),(94,'饺子混沌',0,'0,1',1,0,1,'48'),(95,'能量西餐',0,'0,1',1,0,1,'22,25,29');
/*!40000 ALTER TABLE `shop_classify` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_collect`
--

DROP TABLE IF EXISTS `shop_collect`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_collect` (
  `collect_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '收藏商品id',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `goods_id` int(11) NOT NULL COMMENT '商品id',
  `add_time` int(11) NOT NULL COMMENT '收藏时间',
  PRIMARY KEY (`collect_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_collect`
--

LOCK TABLES `shop_collect` WRITE;
/*!40000 ALTER TABLE `shop_collect` DISABLE KEYS */;
INSERT INTO `shop_collect` VALUES (21,13,27,1523119108),(22,13,28,1523119113),(8,10,8,1522642865),(17,13,8,1523004773),(18,13,14,1523004820),(20,10,15,1523094463),(24,11,28,1609127425),(26,14,34,1610434339),(27,1,31,1611216087),(29,1,37,1611226131),(31,18,37,1611636903),(32,1,38,1611977764),(34,22,38,1612061129),(39,18,55,1620890456),(37,23,43,1614506732),(38,1,45,1616918290);
/*!40000 ALTER TABLE `shop_collect` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_comment`
--

DROP TABLE IF EXISTS `shop_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_comment` (
  `commnet_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '评论的id',
  `goods_id` int(11) NOT NULL COMMENT '商品id',
  `user_id` int(11) NOT NULL COMMENT '评论人的id',
  `content` varchar(255) NOT NULL COMMENT '评论的内容',
  `say_time` int(11) NOT NULL COMMENT '评论的时间',
  `goods_rand` tinyint(1) DEFAULT '1' COMMENT '评论的类型,1好评，2中评，3差评',
  `comment_img` varchar(255) DEFAULT NULL,
  `order_sn` varchar(64) NOT NULL COMMENT '相关订单号',
  `anonymous` tinyint(2) DEFAULT NULL COMMENT '是否匿名 ',
  PRIMARY KEY (`commnet_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_comment`
--

LOCK TABLES `shop_comment` WRITE;
/*!40000 ALTER TABLE `shop_comment` DISABLE KEYS */;
INSERT INTO `shop_comment` VALUES (12,40,18,'很好吃',1613110040,1,'/static/uploads/20210212/e8e7b3ec8431483d35ba2ac3ad737949.jpg','20210212135306033631',NULL),(29,35,1,'【辣条】价格：5元',1614504133,2,'/uploads/20210228/e7607bd8e18e40e09422b016c0be85d5.jpg','20210228171826007719',NULL),(28,38,18,'好吃',1614438918,1,'/uploads/20210227/5af32e300600dd2d5c064b3adf26138c.jpg','20210206114848063876',NULL),(27,40,18,'不好吃',1614438881,3,'/uploads/20210227/eefcef3eb3b78c326a67a79897187342.jpg','20210206114848063876',NULL),(26,43,1,'好好  asd fafg adf',1614233330,1,'/uploads/20210225/0720eb0be2f0627788ceb3e3a253dd6c.jpg','20210221175817063276',NULL),(25,42,1,'好好  asd fafg adf',1614233313,1,'','20210221175817063276',NULL),(24,43,1,'151515 ok ok',1614232886,3,'/uploads/20210225/d4b30a88bbc4c62b422afeb2e2833b66.jpg','20210221141827097380',NULL),(23,42,1,'qqqqqqqqqqqqqqqq',1614231627,2,'/uploads/20210225/7a6b6546f37eae090b5e47c291d06fb8.jpg','20210224150142006759',NULL),(30,43,23,'超喜欢的',1614504996,1,'/uploads/20210228/6a092ceb0f9f2f1f666ac8953a088b41.jpg','20210228173338080701',NULL),(31,40,18,'太好吃了',1614591722,1,'/uploads/20210301/c55b07e5e70aa56892b4ee4a18c57c53.jpg','20210206113604043756',NULL),(32,44,18,'一般般',1614598737,2,'/uploads/20210301/ca92c77da5c323de96957c1770b89262.jpg','20210301191912040084',NULL),(33,44,18,'太好吃了',1615966195,1,'','20210303140017049420',NULL),(34,44,18,'太好吃了',1615966239,1,'','20210301223700010005',NULL),(35,41,18,'太好吃了',1615966459,1,'','20210206120327039216',NULL),(36,44,18,'太好吃了',1615968017,1,'','20210317155838055871',NULL),(37,44,18,'好吃',1615969363,1,'','20210317162119010150',NULL),(38,46,23,'有点苦！！',1617691906,3,'','20210406144419038540',NULL),(39,38,18,'好吃！！！！',1617692960,1,'','20210406150759080981',NULL),(40,47,18,'爽！！！',1617692979,1,'','20210406150759080981',NULL),(41,46,18,'下午茶必选！！！',1617692995,1,'','20210406150759080981',NULL),(42,55,18,'好吃！！！',1620891328,1,'','20210513152807043006',NULL),(43,57,18,'针不戳',1620891343,1,'','20210513152807043006',NULL),(44,56,18,'好吃',1620891408,1,'','20210513152807043006',NULL);
/*!40000 ALTER TABLE `shop_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_goods`
--

DROP TABLE IF EXISTS `shop_goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_goods` (
  `goods_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品的id',
  `good_name` char(50) NOT NULL COMMENT '商品的标题',
  `classify_id` int(11) DEFAULT NULL COMMENT '分类栏目',
  `repertory` int(11) DEFAULT NULL COMMENT '库存数量',
  `unit` char(50) DEFAULT NULL COMMENT '价格计算单位',
  `price` float(10,2) DEFAULT NULL COMMENT '产品展示价格',
  `market` float(10,2) DEFAULT NULL COMMENT '市场价格',
  `cost` float(10,2) DEFAULT NULL COMMENT '成本价格',
  `detail` text COMMENT '详细内容',
  `imgpath` varchar(255) DEFAULT '/public/uploads/1.jpg' COMMENT '图片路径',
  `addtime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '输入时间',
  `static` int(11) DEFAULT '1' COMMENT '1表示发布',
  `comment_count` int(11) DEFAULT '0' COMMENT '评论数量',
  `sales_count` int(11) DEFAULT '0' COMMENT '销售数量',
  `desc` varchar(999) DEFAULT NULL COMMENT '商品简介',
  `merchant_id` int(11) DEFAULT NULL COMMENT '商户id',
  `status` tinyint(2) DEFAULT '1' COMMENT '1启用0下架',
  PRIMARY KEY (`goods_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='商品表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_goods`
--

LOCK TABLES `shop_goods` WRITE;
/*!40000 ALTER TABLE `shop_goods` DISABLE KEYS */;
INSERT INTO `shop_goods` VALUES (38,'热辣香骨鸡',88,10000,NULL,16.00,16.00,NULL,'                                                                                                                                                                                                                                ','/uploads/20210126/55267edd06ecf6da606dd68712419636.jpg','2021-05-10 16:28:18',1,2,8,'小食',20,1),(39,'德山香干',93,99,NULL,23.80,33.80,NULL,'<p><span style=\"text-align: center;\">德山香干 asdda<br></span></p>','/uploads/20210131/92ecaa6177c99d89751e9f65dc52a2b3.jpg','2021-01-31 02:19:40',1,0,0,'德山香干',21,1),(40,'巨无霸',87,99992,NULL,30.00,30.00,NULL,'                                                        ','/uploads/20210131/513e65ad619f266209c314511bfb55e5.png','2021-03-28 11:02:04',1,3,8,'牛肉',30,1),(42,'牛肉米粉',93,996,NULL,32.00,60.00,NULL,'<p>牛肉米粉</p>                            ','/uploads/20210221/bba8c3bdb7dcc957a0832904fd537bdd.jpg','2021-02-28 09:22:51',1,2,3,'牛肉米粉',21,1),(43,'臭臭豆腐',93,995,NULL,28.00,36.00,NULL,'                                                <h1 id=\"single-img\" class=\"title\">臭臭豆腐1</h1>                                    ','/uploads/20210221/d1afdc1ed1fa6e82cecb1629228fce2f.jpg','2021-03-21 10:35:41',1,3,4,'臭臭豆腐1',21,1),(44,'油条',87,0,NULL,5.00,8.00,NULL,'                                                                                    ','/uploads/20210228/1255497882e07bb9c31e5992f0eea028.png','2021-03-21 10:40:20',1,5,7,'早餐',46,0),(47,'可口可乐',87,0,NULL,10.00,10.00,NULL,'                            ','/uploads/20210406/99e57340c756a8c4bfaa64f0fa9670ac.png','2021-04-06 07:51:11',1,1,7,'饮品',30,1),(48,'香辣鸡排',89,1000000,NULL,10.00,19.90,NULL,'','/uploads/20210510/562ccd0ac1e94353075834a14350b8f6.jpg','2021-05-10 15:22:12',1,0,0,'鸡排',47,1),(49,'玉米猪肉水饺',94,10000,NULL,29.90,29.90,NULL,'                                <p style=\"text-align: center;\"><span><b>特選鮮甜多汁的非基因改造玉米，</b></span></p><p style=\"text-align: center;\"><span><b>搭配多種健康鮮蔬和整塊前腿豬肉，</b></span></p><p style=\"text-align: center;\"><span><b>每一口都能嘗到多種蔬菜的清甜及美味!</b></span></p>         ','/uploads/20210510/592eaae8eee6e3cecf495e7184d2e1c7.png','2021-05-10 16:44:22',1,0,0,'水饺',48,1),(50,'芝芝葡萄',90,100000,NULL,30.00,30.00,NULL,'','/uploads/20210510/49f2ba75aaf385b3e548c510969710d4.jpg','2021-05-10 15:32:23',1,0,0,' 芝芝葡萄',50,1),(51,'麻辣锅',89,10000,NULL,99.00,99.00,NULL,'','/uploads/20210510/0363784533ce940778d13117abce3fbc.png','2021-05-10 15:34:41',1,0,0,'锅底',52,1),(52,'折耳根牛肉',89,100000,NULL,10.00,10.00,NULL,'','/uploads/20210510/baa75b6aedf7e3548cd6ca6382fd1965.png','2021-05-10 15:35:02',1,0,0,'折耳根牛肉',52,1),(53,'贡菜牛肉',89,100000,NULL,10.00,10.00,NULL,'','/uploads/20210510/8a3d678daeee07938ae12e1be67121e2.png','2021-05-10 15:35:21',1,0,0,'贡菜牛肉',52,1),(54,'排骨饭',92,1000000,NULL,20.00,20.00,NULL,'','/uploads/20210510/7acea6bc7509d73fcceb8cdbfa46c224.jpg','2021-05-10 15:36:11',1,0,0,'排骨饭',51,1),(55,'卤肉饭',92,999999,NULL,20.00,20.00,NULL,'','/uploads/20210510/d7c811d415663a36b572d911da0c03d0.jpg','2021-05-13 07:35:28',1,1,1,'卤肉饭',51,1),(56,'美式',90,999999,NULL,30.00,30.00,NULL,'<p style=\"text-align: center;\"><span style=\"text-align: start;\">简单即是美味，萃取经典浓缩咖啡，以水调和，香气浓郁蔓溢。</span></p>','/uploads/20210510/3734ea3368b6f565d6b9bd7725f62bc7.jpg','2021-05-13 07:36:48',1,1,1,'美式',49,1),(57,'焦糖玛奇朵',90,999999,NULL,30.00,30.00,NULL,'<p style=\"text-align: center; \"><span>玛奇朵在意大利语中的意思是“印记”。从蒸煮牛奶和添加风味糖浆开始，再倒入醇厚的浓缩咖啡，留下属于玛奇朵的独有印记。</span></p>                            ','/uploads/20210510/21ec5aeb3811828372368782c2153890.jpg','2021-05-13 07:35:43',1,1,1,'焦糖玛奇朵',49,1),(58,'海鲜至尊比萨',88,10000,NULL,90.00,99.00,NULL,'<p style=\"text-align: center;\"><span style=\"text-align: start;\">大块鲜嫩鳕鱼搭配虾、鱿鱼等多种海鲜食材，佐以法式伯布兰科奶香酱汁，勾勒出海鲜的鲜美滋味。</span>大块鲜嫩鳕鱼搭配虾、鱿鱼等多种海鲜食材，佐以法式伯布兰科奶香酱汁，勾勒出海鲜的鲜美滋味。大块鲜嫩鳕鱼搭配虾、鱿鱼等多种海鲜食材，佐以法式伯布兰科奶香酱汁，勾勒出海鲜的鲜美滋味。大块鲜嫩鳕鱼搭配虾、鱿鱼等多种海鲜食材，佐以法式伯布兰科奶香酱汁，勾勒出海鲜的鲜美滋味。大块鲜嫩鳕鱼搭配虾、鱿鱼等多种海鲜食材，佐以法式伯布兰科奶香酱汁，勾勒出海鲜的鲜美滋味。aaa</p>','/uploads/20210510/1405e56bca26e6dd0b97c6e8ea136bec.jpg','2021-05-13 02:31:10',1,0,0,'招牌',32,1),(59,'美式精选比萨',88,10000,NULL,69.00,69.00,NULL,'<p style=\"text-align: left;\">精选鲜香的腊肉肠、配以香浓的芝士乳酪，搭配出经典美味，值得细细品味。</p><p style=\"text-align: left;\">主要原料:面团、芝士、腊肉肠。铁盘小装180克建议1人用，铁盘普通装310克建议2-3人用，铁盘大装630克建议3-4人用，芝心普通装500克建议2-3人用。69.0元 /普装精选鲜香的腊肉肠、配以香浓的芝士乳酪，搭配出经典美味，值得细细品味。</p><p style=\"text-align: left;\"><br></p><p style=\"text-align: left;\"><br></p><p style=\"text-align: left;\"><br></p><p style=\"text-align: left;\">主要原料:面团、芝士、腊肉肠。铁盘小装180克建议1人用，铁盘普通装310克建议2-3人用，铁盘大装630克建议3-4人用，芝心普通装500克建议2-3人用。69.0元 /普装</p>','/uploads/20210510/90d516971a870c63a596293388282f79.jpg','2021-05-12 09:00:08',1,0,0,'美式精选比萨',32,1),(60,'超级至尊比萨',88,10000,NULL,99.00,99.00,NULL,'<p></p><p style=\"text-align: center;\"><img src=\"/uploads/layui/20210512/3d9f70e4e6d809d4a9114e17aba4d14b.png\" alt=\"undefined\">腊肉肠、香肠、火腿、牛肉，搭配菠萝、蘑菇、洋葱、青椒等蔬菜水果，如此丰盛馅料，口口都是令人满足的好滋味。<br>主要原料:面团、牛肉粒、猪肉粒、火腿、腊肉肠、芝士、蔬菜、菠萝、黑橄榄。铁盘小装250克建议1人用，铁盘普通装440克建议2-3人用，铁盘大装880克建议3-4人用，芝心普通装570克建议2-3人用，大方薄底普通装390克建议2-3人用，薄脆大装建议2-3人用。</p><p></p>','/uploads/20210510/36cd2b82f3e1d359da75cb5a47e9aac6.jpg','2021-05-12 09:03:55',1,0,0,'招牌',32,0);
/*!40000 ALTER TABLE `shop_goods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_merchant`
--

DROP TABLE IF EXISTS `shop_merchant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_merchant` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `admin_id` int(11) DEFAULT NULL COMMENT '管理员id，type=2',
  `logo` varchar(255) DEFAULT '' COMMENT '商户logo',
  `status` tinyint(2) DEFAULT '1' COMMENT '1关闭，0开启',
  `class_id` int(11) DEFAULT NULL COMMENT '商户类型classify的id',
  `add_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `introduce` varchar(255) DEFAULT NULL COMMENT '介绍',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_merchant`
--

LOCK TABLES `shop_merchant` WRITE;
/*!40000 ALTER TABLE `shop_merchant` DISABLE KEYS */;
INSERT INTO `shop_merchant` VALUES (16,'湘爱',41,'/uploads/20210124/e401b23885757667dbda41724e3ea0b6.jpg',1,91,'2021-01-24 11:01:17',NULL,'湘爱(工体店)'),(20,'肯德基',45,'/uploads/photo/20210126/9fe3c3287e39c2c727a99bca12b4b096.jpg',1,88,'2021-01-26 14:41:41','2021-01-26 14:41:41','华油购物广店'),(21,'芙南人',46,'/uploads/20210129/4680bc95484219a3cf90c6ab1a59a885.jpg',1,93,'2021-01-29 13:01:10',NULL,'芙南人(望京店)'),(25,'米斯特比萨',50,'/uploads/20210131/a71fc6913c4bf8f4600ac83ec5d2abd0.jpg',1,95,'2021-01-31 12:01:38',NULL,'通州九棵树店'),(29,'汉丽轩海鲜火锅烤肉自助',54,'/uploads/20210131/9fe67ce1213c053a80d47955d71ae8bc.jpg',1,95,'2021-01-31 12:01:00',NULL,'汉丽轩海鲜火锅烤肉自助'),(30,'麦当劳',55,'/uploads/20210131/bce8db793b24df92aacabbbb5ccee706.jpg',1,88,'2021-01-31 12:01:23',NULL,'百货大楼店'),(32,'必胜客',57,'/uploads/20210206/2827683c166c6b435d4e1b98a4afb1dc.png',1,88,'2021-02-06 11:02:57',NULL,'蕾莎店'),(38,'三样菜',63,'/uploads/20210222/de27b34af063b99e691b5667fdf0ae3b.jpg',1,91,'2021-02-22 15:02:21',NULL,'三样菜(阜成路店)'),(39,'老屋川菜',64,'/uploads/20210222/28e08b617647a066c432ae554e064f8b.jpg',1,91,'2021-02-22 15:02:08',NULL,'老屋川菜·水煮鱼'),(40,'渝信川菜',65,'/uploads/20210222/e5d11650fa8e62da57c698f5a4179569.jpg',1,91,'2021-02-22 15:02:21',NULL,'渝信川菜(西单店)'),(41,'眉州东坡',66,'/uploads/20210222/5befd57b787fab038a0109ff712fb641.jpg',1,91,'2021-02-22 15:02:06',NULL,'眉州东坡'),(42,'湘菜馆',67,'/uploads/20210222/7659205976e8a0718a15b9752385f86e.jpg',1,91,'2021-02-22 15:02:28',NULL,'湘菜馆(石园店) '),(43,'酷湘',68,'/uploads/20210222/c252d1636504efb459865ef416606403.jpg',1,91,'2021-02-22 15:02:10',NULL,'酷湘·江南庭院餐厅·正统湘菜'),(44,'新派小长沙湘菜馆',69,'/uploads/20210222/a3e34f8c7ea57a57b521a699e68b0077.jpg',1,91,'2021-02-22 15:02:55',NULL,'新派小长沙湘菜馆'),(46,'永和大王（蕾莎店）',71,'/uploads/photo/20210228/481da98277831c8e6aa0def34e86ab53.png',1,87,'2021-02-28 21:12:29','2021-02-28 21:12:29','蕾莎店'),(47,'正新鸡排',72,'/uploads/photo/20210510/1f0160869244f61228d0034bfdbd8dc3.jpg',1,89,'2021-05-10 23:11:36','2021-05-10 23:11:36','易购商城店'),(48,'湾仔码头',73,'/uploads/20210510/385a6e612d296c4bcbe6311818713535.jpg',1,94,'2021-05-10 23:05:21',NULL,'新华都店'),(49,'星巴克',74,'/uploads/20210510/30f0c50aa048c01e9c997b81076b34d9.jpg',1,90,'2021-05-10 23:05:14',NULL,'集美万达店'),(50,'喜茶',75,'/uploads/20210510/7f6a66bc8192ce4af19745e6ecde130c.jpg',1,90,'2021-05-10 23:05:59',NULL,'万象城店'),(51,'真功夫',76,'/uploads/20210510/a6e63fbed6792bec8d0c342f165db4b8.jpg',1,92,'2021-05-10 23:05:17',NULL,'银泰百货店'),(52,'小郡肝',77,'/uploads/20210510/70acd71fff48784b962702fca3c47da1.jpg',1,89,'2021-05-10 23:05:34',NULL,'孙厝店');
/*!40000 ALTER TABLE `shop_merchant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_order`
--

DROP TABLE IF EXISTS `shop_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_order` (
  `order_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单id',
  `order_sn` varchar(255) NOT NULL COMMENT '订单编号',
  `order_status` tinyint(2) unsigned DEFAULT '0' COMMENT '订单状态',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `order_address` varchar(255) NOT NULL COMMENT '收获地址',
  `consignee` varchar(255) DEFAULT NULL COMMENT '收货人',
  `mobile` char(12) NOT NULL COMMENT '手机',
  `goods_price` varchar(60) NOT NULL COMMENT '总价格',
  `add_time` char(12) DEFAULT NULL COMMENT '下单时间',
  `pay_time` datetime DEFAULT NULL COMMENT '支付时间',
  `message` varchar(255) DEFAULT NULL COMMENT '买家留言',
  `goods_id` int(11) unsigned DEFAULT NULL,
  `goods_num` int(11) unsigned DEFAULT NULL,
  `is_multi` tinyint(2) unsigned DEFAULT '0' COMMENT '订单中是否有多个商品',
  `goods_list` varchar(255) DEFAULT NULL COMMENT '订单内的商品列表',
  PRIMARY KEY (`order_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=146 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_order`
--

LOCK TABLES `shop_order` WRITE;
/*!40000 ALTER TABLE `shop_order` DISABLE KEYS */;
INSERT INTO `shop_order` VALUES (2,'20180401174016043423',1,10,'浙江省温州市瑞安区班安杰道','凯凯','2147483647','3131','1522575840',NULL,'',15,1,0,NULL),(9,'20180402171907090452',1,10,'浙江省温州市瑞安区班安杰道','凯凯','18188888888','2367','1522660783',NULL,'',14,3,0,NULL),(10,'20180403191524066421',1,10,'广东省深圳市宝安区下角村','阳光宅男','13566666666','189','1522754141',NULL,'',19,1,0,NULL),(11,'20201228112444033262',1,11,'广东省深圳市宝安区顺丰到付顺丰的分数','拉开就','15111112222','64','1609125889',NULL,'',29,1,0,NULL),(12,'20201228115251056926',1,11,'广东省深圳市宝安区顺丰到付顺丰的分数','拉开就','15111112222','38','1609127587',NULL,'',28,2,0,NULL),(13,'20210112145058064096',1,14,'广东省深圳市宝安区西安路','小糯米','15344446666','19.9','1610434263',NULL,'',31,1,0,NULL),(14,'20210121094659014969',1,1,'江西省南昌市三角区斯科尼茨几道','大冬瓜','13838384848','19.9','1611193658',NULL,'',34,1,0,NULL),(72,'20210224150142006759',1,1,'广东省深圳市宝安区 洒出来呢','小海绵','15729827275','32','1614150102','2021-02-24 15:02:15','',42,1,0,''),(16,'20210122162943020579',0,1,'辽宁省本溪市南芬区西乡街道','大大金子','18170728888','51.8','1611304189',NULL,'',37,1,0,NULL),(17,'20210122182056088340',0,1,'辽宁省本溪市南芬区西乡街道','大大金子','18170728888','94.4','1611310863',NULL,'',0,0,0,NULL),(18,'20210122182517057599',0,1,'辽宁省本溪市南芬区西乡街道','大大金子','18170728888','75.6','1611311499',NULL,'',0,0,0,NULL),(19,'20210123112153023323',1,1,'辽宁省本溪市南芬区西乡街道','大大金子','18170728888','28.8','1611372487',NULL,'',0,0,1,'[\"35\",\"36\"]|[\"2\",\"1\"]'),(74,'20210228173338080701',1,23,'河北省秦皇岛市山海关区楼顶导热板和','老铁','13744547712','28','1614504818','2021-02-28 17:34:02','',43,1,0,''),(73,'20210228171826007719',1,1,'浙江省温州市龙湾区 学校学校学校学校1111','小冬瓜','13838384848','25','1614503906','2021-02-28 17:18:57','',35,5,0,''),(35,'20210130100405056192',1,1,'辽宁省本溪市南芬区西乡街道','大大金子','18170728888','99.5','1611972245','2021-01-30 10:04:29','',33,5,0,''),(36,'20210130112056001400',1,1,'辽宁省本溪市南芬区西乡街道','大大金子','18170728888','80','1611976856','2021-01-30 11:21:25','',0,5,1,'[\"38\"]|[\"5\"]'),(40,'20210130181315070345',1,22,'辽宁省丹东市振安区对牛鼓簧水电费电饭锅','千里之外','18170728880','160','1612001595','2021-01-30 18:13:41','',0,5,1,'[\"36\",\"37\"]|[\"3\",\"2\"]'),(41,'20210130204255015404',1,22,'北京城区朝阳区科技部神经病','南瓜','18847149999','139.7','1612010575','2021-01-30 20:43:29','',0,8,1,'[\"32\",\"33\",\"38\"]|[\"2\",\"1\",\"5\"]'),(42,'20210131102534075766',1,22,'天津城区河西区大路口假把式','大橙子','14825694226','47.6','1612059934','2021-01-31 10:26:03','',39,2,0,''),(47,'20210131122157086524',1,1,'广东省深圳市宝安区 洒出来呢','小海绵','15729827275','48.8','1612066917','2021-01-31 12:22:31','',0,0,1,'[\"35\",\"39\"]|[\"5\",\"1\"]'),(70,'20210221141827097380',1,1,'辽宁省本溪市南芬区 西乡街道','大大金子','18170728888','56','1613888307','2021-02-21 14:21:37','',43,2,0,''),(71,'20210221175817063276',1,1,'浙江省温州市龙湾区 学校学校学校学校1111','小冬瓜','13838384848','120','1613901497','2021-02-21 18:03:00','',0,4,1,'[\"42\",\"43\"]|[\"2\",\"2\"]'),(143,'20210513152807043006',1,18,'河北省沧州市任丘市华北石油','王翔名','13163990330','80','1620890887','2021-05-13 15:34:19','',0,3,1,'[\"55\",\"56\",\"57\"]|[\"1\",\"1\",\"1\"]'),(144,'20210513153901034054',2,18,'河北省沧州市任丘市华北石油','王翔名','13163990330','69','1620891541',NULL,'',0,1,1,'[\"59\"]|[\"1\"]'),(145,'20210513153950072604',2,18,'河北省沧州市任丘市华北石油','王翔名','13163990330','99','1620891590',NULL,'',0,2,1,'[\"50\",\"59\"]|[\"1\",\"1\"]'),(84,'20210326141813077098',0,24,'浙江省杭州市西湖区西湖发生地方','咖啡','15566667777','24','1616739493',NULL,'',46,1,0,''),(85,'20210326142148035314',0,24,'浙江省杭州市西湖区西湖发生地方','咖啡','15566667777','24','1616739708',NULL,'',46,1,0,''),(86,'20210326144210007317',0,24,'浙江省杭州市西湖区西湖发生地方','咖啡','15566667777','24','1616740930',NULL,'',46,1,0,''),(87,'20210326145349090912',0,24,'浙江省杭州市西湖区西湖发生地方','咖啡','15566667777','24','1616741629',NULL,'',46,1,0,''),(88,'20210326150045063252',0,24,'浙江省杭州市西湖区西湖发生地方','咖啡','15566667777','24','1616742045',NULL,'',46,1,0,''),(89,'20210326150604078314',0,24,'浙江省杭州市西湖区西湖发生地方','咖啡','15566667777','24','1616742364',NULL,'',46,1,0,''),(90,'20210326150927095101',0,24,'浙江省杭州市西湖区西湖发生地方','咖啡','15566667777','24','1616742567',NULL,'',46,1,0,''),(91,'20210326151151025323',0,24,'浙江省杭州市西湖区西湖发生地方','咖啡','15566667777','24','1616742711',NULL,'',46,1,0,''),(92,'20210326151526082402',0,24,'浙江省杭州市西湖区西湖发生地方','咖啡','15566667777','24','1616742926',NULL,'',46,1,0,''),(93,'20210326151946061468',0,24,'浙江省杭州市西湖区西湖发生地方','咖啡','15566667777','24','1616743186',NULL,'',46,1,0,''),(94,'20210326152712022081',0,24,'浙江省杭州市西湖区西湖发生地方','咖啡','15566667777','24','1616743632',NULL,'',46,1,0,''),(95,'20210326152752088871',0,24,'浙江省杭州市西湖区西湖发生地方','咖啡','15566667777','24','1616743672',NULL,'',46,1,0,''),(96,'20210326153151044414',0,24,'浙江省杭州市西湖区西湖发生地方','咖啡','15566667777','24','1616743911',NULL,'',46,1,0,''),(97,'20210326155307036609',0,24,'浙江省杭州市西湖区西湖发生地方','咖啡','15566667777','24','1616745187',NULL,'',46,1,0,''),(98,'20210327152833054366',0,1,'辽宁省本溪市南芬区西 乡街道','大大金子','18170728888','24','1616830113',NULL,'',46,1,0,''),(99,'20210327153056068828',0,1,'辽宁省本溪市南芬区西 乡街道','大大金子','18170728888','24','1616830256',NULL,'',46,1,0,''),(100,'20210328094433015616',0,1,'辽宁省本溪市南芬区西 乡街道','大大金子','18170728888','24','1616895873',NULL,'',46,1,0,''),(101,'20210328100358085795',0,1,'辽宁省本溪市南芬区西 乡街道','大大金子','18170728888','24','1616897038',NULL,'',46,1,0,''),(102,'20210328100443072284',0,1,'辽宁省本溪市南芬区西 乡街道','大大金子','18170728888','48','1616897083',NULL,'',46,2,0,''),(103,'20210328100748059294',0,1,'辽宁省本溪市南芬区西 乡街道','大大金子','18170728888','48','1616897268',NULL,'',46,2,0,''),(104,'20210328100957012923',0,1,'辽宁省本溪市南芬区西 乡街道','大大金子','18170728888','48','1616897397',NULL,'',46,2,0,''),(105,'20210328101123063815',0,1,'辽宁省本溪市南芬区西 乡街道','大大金子','18170728888','24','1616897483',NULL,'',46,1,0,''),(106,'20210328101210062574',0,1,'辽宁省本溪市南芬区西 乡街道','大大金子','18170728888','24','1616897530',NULL,'',46,1,0,''),(107,'20210328101255071124',0,1,'辽宁省本溪市南芬区西 乡街道','大大金子','18170728888','24','1616897575',NULL,'',46,1,0,''),(108,'20210328102518039840',0,1,'辽宁省本溪市南芬区西 乡街道','大大金子','18170728888','24','1616898318',NULL,'',46,1,0,''),(109,'20210328114010018077',0,1,'辽宁省本溪市南芬区西 乡街道','大大金子','18170728888','24','1616902810',NULL,'',46,1,0,''),(110,'20210328114025033043',0,1,'辽宁省本溪市南芬区西 乡街道','大大金子','18170728888','24','1616902825',NULL,'',46,1,0,''),(111,'20210328115523075530',2,1,'辽宁省本溪市南芬区西 乡街道','大大金子','18170728888','24','1616903723',NULL,'',46,1,0,''),(112,'20210328143942014458',0,1,'辽宁省本溪市南芬区西 乡街道','大大金子','18170728888','24','1616913582',NULL,'',46,1,0,''),(113,'20210328144020003104',0,1,'辽宁省本溪市南芬区西 乡街道','大大金子','18170728888','24','1616913620',NULL,'',46,1,0,''),(114,'20210328144228043705',0,1,'辽宁省本溪市南芬区西 乡街道','大大金子','18170728888','24','1616913748',NULL,'',46,1,0,''),(115,'20210328144246031708',0,1,'辽宁省本溪市南芬区西 乡街道','大大金子','18170728888','24','1616913766',NULL,'',46,1,0,''),(117,'20210328185140058829',0,24,'浙江省杭州市西湖区西湖发生地方','咖啡','15566667777','16','1616928700',NULL,'',38,1,0,''),(118,'20210328185228075892',2,23,'河北省秦皇岛市山海关区楼顶导热板和','老铁','13744547712','109','1616928748',NULL,'',0,1,1,'[\"45\"]|[\"1\"]'),(119,'20210328185257059053',0,24,'浙江省杭州市西湖区西湖发生地方','咖啡','15566667777','16','1616928777',NULL,'',38,1,0,''),(120,'20210328185312041407',0,23,'河北省秦皇岛市山海关区楼顶导热板和','老铁','13744547712','109','1616928792',NULL,'',0,1,1,'[\"45\"]|[\"1\"]'),(122,'20210328190305033773',0,24,'浙江省杭州市西湖区西湖发生地方','咖啡','15566667777','80','1616929385',NULL,'',38,5,0,''),(124,'20210329094739007338',0,1,'辽宁省本溪市南芬区西 乡街道','大大金子','18170728888','109','1616982459',NULL,'',45,1,0,''),(125,'20210330092611038930',1,1,'辽宁省本溪市南芬区西 乡街道','大大金子','18170728888','16','1617067571','2021-03-30 09:26:47','',38,1,0,''),(128,'20210406143302079819',2,1,'辽宁省本溪市南芬区西 乡街道','大大金子','18170728888','24','1617690782',NULL,'',46,1,0,''),(129,'20210406143521033344',2,1,'辽宁省本溪市南芬区西 乡街道','大大金子','18170728888','24','1617690921',NULL,'',46,1,0,''),(130,'20210406144318019657',2,23,'河北省秦皇岛市山海关区楼顶导热板和','老铁','13744547712','24','1617691398',NULL,'',0,1,1,'[\"46\"]|[\"1\"]'),(131,'20210406144419038540',1,23,'河北省秦皇岛市山海关区楼顶导热板和','老铁','13744547712','24','1617691459','2021-04-06 14:49:22','',0,1,1,'[\"46\"]|[\"1\"]'),(134,'20210406150925076207',1,1,'辽宁省本溪市南芬区西 乡街道','大大金子','18170728888','218','1617692972',NULL,'',0,2,1,'[\"45\"]|[\"2\"]'),(135,'20210406151108096755',1,1,'辽宁省本溪市南芬区西 乡街道','大大金子','18170728888','40','1617693074',NULL,'',0,2,1,'[\"38\",\"46\"]|[\"1\",\"1\"]');
/*!40000 ALTER TABLE `shop_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_user`
--

DROP TABLE IF EXISTS `shop_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `username` varchar(120) DEFAULT NULL COMMENT '用户名',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `email` varchar(120) DEFAULT NULL COMMENT '邮箱',
  `sex` tinyint(1) NOT NULL DEFAULT '1' COMMENT '性别,0保密，1男，2女',
  `brithday` varchar(255) DEFAULT NULL COMMENT '生日',
  `reg_time` int(11) NOT NULL COMMENT '注册时间',
  `qq` char(12) DEFAULT NULL COMMENT 'qq',
  `mobile` varchar(255) DEFAULT NULL COMMENT '手机号码',
  `head_pic` varchar(255) NOT NULL DEFAULT '/static/images/getAvatar.do.jpg' COMMENT '图片地址',
  `static` int(11) NOT NULL DEFAULT '1' COMMENT '在线状态',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_user`
--

LOCK TABLES `shop_user` WRITE;
/*!40000 ALTER TABLE `shop_user` DISABLE KEYS */;
INSERT INTO `shop_user` VALUES (18,'wxm111','e10adc3949ba59abbe56e057f20f883e','838029835@qq.com',1,'1998-04-24',1611635799,'838029835','13163990330','/static/uploads/20210206/eefc3a7371325e1bfdc4a14b0c9469c5.jpg',1,1),(23,'wff111','e10adc3949ba59abbe56e057f20f883e',NULL,1,NULL,1612958011,NULL,'15659802253','/static/images/getAvatar.do.jpg',1,1),(24,'user2','e10adc3949ba59abbe56e057f20f883e','15243362@qq.com',1,NULL,1613978955,'15243362','14545478542','/uploads/20210222/63bcf8614ba7cda9ff08c860d19410e3.jpg',1,1);
/*!40000 ALTER TABLE `shop_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-05-13 15:55:51
