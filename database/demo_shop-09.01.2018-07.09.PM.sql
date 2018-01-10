/*
 Navicat Premium Data Transfer

 Source Server         : XAMPP
 Source Server Type    : MySQL
 Source Server Version : 100126
 Source Host           : 127.0.0.1:3306
 Source Schema         : demo_shop

 Target Server Type    : MySQL
 Target Server Version : 100126
 File Encoding         : 65001

 Date: 09/01/2018 19:09:24
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tt_attribute
-- ----------------------------
DROP TABLE IF EXISTS `tt_attribute`;
CREATE TABLE `tt_attribute`  (
  `attribute_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`attribute_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tt_attribute
-- ----------------------------
INSERT INTO `tt_attribute` VALUES (1, 'Màn hình');
INSERT INTO `tt_attribute` VALUES (2, 'Ram');
INSERT INTO `tt_attribute` VALUES (3, 'Hệ điều hành');

-- ----------------------------
-- Table structure for tt_category
-- ----------------------------
DROP TABLE IF EXISTS `tt_category`;
CREATE TABLE `tt_category`  (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `image` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `create_at` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `update_at` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`category_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tt_category
-- ----------------------------
INSERT INTO `tt_category` VALUES (1, 0, 'Laptop', 'ok', 'data/base2.png', 1, '1512386860', '1512386860');
INSERT INTO `tt_category` VALUES (2, 0, 'Mobile', 'dsf', 'data/base2.png', 1, '1512386860', '1512386860');
INSERT INTO `tt_category` VALUES (3, 1, 'Phụ kiện', '<p>sdmmlsdf &aacute;dfemo</p>\r\n', '', 1, '1515410141', '1515410300');

-- ----------------------------
-- Table structure for tt_color
-- ----------------------------
DROP TABLE IF EXISTS `tt_color`;
CREATE TABLE `tt_color`  (
  `color_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`color_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tt_color
-- ----------------------------
INSERT INTO `tt_color` VALUES (1, 'Xanh');
INSERT INTO `tt_color` VALUES (2, 'Đỏ');
INSERT INTO `tt_color` VALUES (3, 'Trắng');
INSERT INTO `tt_color` VALUES (4, 'Đen');

-- ----------------------------
-- Table structure for tt_order
-- ----------------------------
DROP TABLE IF EXISTS `tt_order`;
CREATE TABLE `tt_order`  (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `create_at` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `update_at` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `full_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`order_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tt_order_product
-- ----------------------------
DROP TABLE IF EXISTS `tt_order_product`;
CREATE TABLE `tt_order_product`  (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `count` int(5) NOT NULL,
  `price` decimal(10, 2) NOT NULL
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tt_product
-- ----------------------------
DROP TABLE IF EXISTS `tt_product`;
CREATE TABLE `tt_product`  (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `tag` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `image` varchar(0) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `price` decimal(10, 2) NOT NULL DEFAULT 0.00,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `viewed` int(11) DEFAULT 0,
  `create_at` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `update_at` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`product_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tt_product
-- ----------------------------
INSERT INTO `tt_product` VALUES (1, 'ffffffffffffffff', '<p>sdfasdf</p>\r\n', '', '', 1111.00, 1, 0, '1515498830', '1515499633');

-- ----------------------------
-- Table structure for tt_product_attribute
-- ----------------------------
DROP TABLE IF EXISTS `tt_product_attribute`;
CREATE TABLE `tt_product_attribute`  (
  `product_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `description` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `sort_order` int(3) DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tt_product_attribute
-- ----------------------------
INSERT INTO `tt_product_attribute` VALUES (1, 1, '111', 1);
INSERT INTO `tt_product_attribute` VALUES (1, 2, 'dsfsdf', 2);
INSERT INTO `tt_product_attribute` VALUES (1, 3, 'sdf', 3);

-- ----------------------------
-- Table structure for tt_product_color
-- ----------------------------
DROP TABLE IF EXISTS `tt_product_color`;
CREATE TABLE `tt_product_color`  (
  `product_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `count` int(5) NOT NULL DEFAULT 0
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tt_product_color
-- ----------------------------
INSERT INTO `tt_product_color` VALUES (1, 3, 0);

-- ----------------------------
-- Table structure for tt_product_image
-- ----------------------------
DROP TABLE IF EXISTS `tt_product_image`;
CREATE TABLE `tt_product_image`  (
  `product_id` int(11) NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tt_product_image
-- ----------------------------
INSERT INTO `tt_product_image` VALUES (1, 'data/images/san-pham/chat_icon_hover.png');

-- ----------------------------
-- Table structure for tt_product_sale
-- ----------------------------
DROP TABLE IF EXISTS `tt_product_sale`;
CREATE TABLE `tt_product_sale`  (
  `product_id` int(11) NOT NULL,
  `price` decimal(10, 2) DEFAULT NULL,
  `from_at` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `to_at` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tt_product_sale
-- ----------------------------
INSERT INTO `tt_product_sale` VALUES (1, 3444.00, '1514761200', '1515711600');
INSERT INTO `tt_product_sale` VALUES (1, 345345.00, '1514761200', '1515711600');
INSERT INTO `tt_product_sale` VALUES (1, 2222.00, '1514761200', '1515711600');
INSERT INTO `tt_product_sale` VALUES (1, 345345.00, '1514761200', '1515711600');

-- ----------------------------
-- Table structure for tt_product_to_category
-- ----------------------------
DROP TABLE IF EXISTS `tt_product_to_category`;
CREATE TABLE `tt_product_to_category`  (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tt_product_to_category
-- ----------------------------
INSERT INTO `tt_product_to_category` VALUES (1, 1);

-- ----------------------------
-- Table structure for tt_setting
-- ----------------------------
DROP TABLE IF EXISTS `tt_setting`;
CREATE TABLE `tt_setting`  (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `key` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `value` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `json` tinyint(1) NOT NULL,
  PRIMARY KEY (`setting_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 34 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tt_setting
-- ----------------------------
INSERT INTO `tt_setting` VALUES (32, 'config', 'config_name', 'TaiTT\'s Shop', 0);
INSERT INTO `tt_setting` VALUES (33, 'config', 'config_owner', 'TaiTT', 0);

-- ----------------------------
-- Table structure for tt_user
-- ----------------------------
DROP TABLE IF EXISTS `tt_user`;
CREATE TABLE `tt_user`  (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_group_id` int(11) NOT NULL,
  `username` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `create_at` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `update_at` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tt_user
-- ----------------------------
INSERT INTO `tt_user` VALUES (1, 1, 'taitt', 'a3f0bec59cebeb60553ec80bbfd5dfdf', 1, '1512386860', '1512386860');
INSERT INTO `tt_user` VALUES (2, 2, 'truongnx', 'a3f0bec59cebeb60553ec80bbfd5dfdf', 1, '1512386860', '1512386860');

-- ----------------------------
-- Table structure for tt_user_group
-- ----------------------------
DROP TABLE IF EXISTS `tt_user_group`;
CREATE TABLE `tt_user_group`  (
  `user_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `permission` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  PRIMARY KEY (`user_group_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tt_user_group
-- ----------------------------
INSERT INTO `tt_user_group` VALUES (1, 'admin', '{\"access\":[\"common\\/dashboard\",\"product\\/attribute_delete\",\"product\\/attribute_form\",\"product\\/attribute_list\",\"product\\/category_delete\",\"product\\/category_form\",\"product\\/category_list\",\"product\\/color_delete\",\"product\\/color_form\",\"product\\/color_list\",\"product\\/product_delete\",\"product\\/product_form\",\"product\\/product_list\",\"setting\\/setting\",\"user\\/user_group_delete\",\"user\\/user_group_form\",\"user\\/user_group_list\",\"user\\/user_list\"],\"modify\":[\"common\\/dashboard\",\"product\\/attribute_delete\",\"product\\/attribute_form\",\"product\\/attribute_list\",\"product\\/category_delete\",\"product\\/category_form\",\"product\\/category_list\",\"product\\/color_delete\",\"product\\/color_form\",\"product\\/color_list\",\"product\\/product_delete\",\"product\\/product_form\",\"product\\/product_list\",\"setting\\/setting\",\"user\\/user_group_delete\",\"user\\/user_group_form\",\"user\\/user_group_list\",\"user\\/user_list\"]}');
INSERT INTO `tt_user_group` VALUES (4, 'demo', '{\"access\":[\"common\\/dashboard\",\"setting\\/setting\",\"user\\/user_group_delete\",\"user\\/user_group_form\",\"user\\/user_group_list\"],\"modify\":[\"common\\/dashboard\",\"setting\\/setting\",\"user\\/user_group_delete\",\"user\\/user_group_form\",\"user\\/user_group_list\"]}');

SET FOREIGN_KEY_CHECKS = 1;
