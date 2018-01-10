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

 Date: 10/01/2018 23:45:56
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tt_extension
-- ----------------------------
DROP TABLE IF EXISTS `tt_extension`;
CREATE TABLE `tt_extension`  (
  `extension_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `code` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`extension_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tt_extension
-- ----------------------------
INSERT INTO `tt_extension` VALUES (2, 'module', 'product_sale');

SET FOREIGN_KEY_CHECKS = 1;
