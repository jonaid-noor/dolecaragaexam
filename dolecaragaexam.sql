/*
 Navicat Premium Data Transfer

 Source Server         : dole-caraga-exam
 Source Server Type    : MySQL
 Source Server Version : 100432 (10.4.32-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : dolecaragaexam

 Target Server Type    : MySQL
 Target Server Version : 100432 (10.4.32-MariaDB)
 File Encoding         : 65001

 Date: 15/01/2026 13:59:13
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for house_hold_member
-- ----------------------------
DROP TABLE IF EXISTS `house_hold_member`;
CREATE TABLE `house_hold_member`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `fk_household_id` int NOT NULL,
  `child_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `birth_date` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `sex` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `civil_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `is_delete` tinyint NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx-house_hold_member-fk_household_id`(`fk_household_id` ASC) USING BTREE,
  CONSTRAINT `fk-house_hold_member-household` FOREIGN KEY (`fk_household_id`) REFERENCES `household` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_household_member_household` FOREIGN KEY (`fk_household_id`) REFERENCES `household` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of house_hold_member
-- ----------------------------
INSERT INTO `house_hold_member` VALUES (7, 2, 'Kris Doe2', '2026-01-15', 'Male', 'Single', 0);
INSERT INTO `house_hold_member` VALUES (8, 2, 'Jose Doe2', '2026-01-15', 'Male', 'Single', 0);
INSERT INTO `house_hold_member` VALUES (9, 3, 'Kris Doe', '2026-01-15', 'Male', 'Single', 0);
INSERT INTO `house_hold_member` VALUES (10, 3, 'Jose Doe', '2026-01-15', 'Male', 'Single', 0);

-- ----------------------------
-- Table structure for household
-- ----------------------------
DROP TABLE IF EXISTS `household`;
CREATE TABLE `household`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `father_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `mother_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `father_occupation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `mother_occupation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `home_address` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `family_income` decimal(20, 2) NULL DEFAULT NULL,
  `house_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_delete` tinyint NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of household
-- ----------------------------
INSERT INTO `household` VALUES (2, 'John Doe2', 'Maria Doe2', 'Mechanic2', 'Nurse2', 'St. Michael Brgy 12', 100000.00, 'Living Together', 0);
INSERT INTO `household` VALUES (3, 'John Doe', 'Maria Doe', 'Mechanic', 'Nurse', 'St. Michael Brgy 1', 100000.00, 'Rent', 0);

-- ----------------------------
-- Table structure for migration
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration`  (
  `version` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `apply_time` int NULL DEFAULT NULL,
  PRIMARY KEY (`version`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migration
-- ----------------------------
INSERT INTO `migration` VALUES ('m000000_000000_base', 1768441140);
INSERT INTO `migration` VALUES ('m130524_201442_init', 1768441144);
INSERT INTO `migration` VALUES ('m190124_110200_add_verification_token_column_to_user_table', 1768441144);
INSERT INTO `migration` VALUES ('m260115_013816_create_dolecaragaexam_household', 1768441144);
INSERT INTO `migration` VALUES ('m260115_014423_create_house_hold_member_table', 1768441505);
INSERT INTO `migration` VALUES ('m260115_021843_alter_house_status_column_in_household', 1768443557);
INSERT INTO `migration` VALUES ('m260115_031650_add_is_delete', 1768447044);
INSERT INTO `migration` VALUES ('m260115_032032_add_fk_household_member_to_household', 1768447265);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint NOT NULL DEFAULT 10,
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  `verification_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `username`(`username` ASC) USING BTREE,
  UNIQUE INDEX `email`(`email` ASC) USING BTREE,
  UNIQUE INDEX `password_reset_token`(`password_reset_token` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'admin', 'S4IVD3sphz-sSdQZTEAyB1pm7bWy_0s4', '$2y$13$95m7ECWxwtQl83bERa2bFuS8hYDg3JKNPuc/1htILx3TtVWmBWqDK', NULL, 'admintest@gmail.com', 10, 1768442672, 1768442672, 'to5bmC48DK5opOdnyhIe8hzuFggh7enw_1768442672');

SET FOREIGN_KEY_CHECKS = 1;
