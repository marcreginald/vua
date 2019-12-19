/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 80018
 Source Host           : localhost:3306
 Source Schema         : vua_db

 Target Server Type    : MySQL
 Target Server Version : 80018
 File Encoding         : 65001

 Date: 09/12/2019 15:13:16
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for approved_rql
-- ----------------------------
DROP TABLE IF EXISTS `approved_rql`;
CREATE TABLE `approved_rql`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rql_id` int(11) NULL DEFAULT NULL,
  `date_approved` date NULL DEFAULT NULL,
  `filepath_approved_confirmationrql` varchar(2000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `approved_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of approved_rql
-- ----------------------------
INSERT INTO `approved_rql` VALUES (2, 4, '2018-03-14', '15210104770chenchen.jpg/15210104771eticket.png', 1);
INSERT INTO `approved_rql` VALUES (3, 5, '2018-03-20', '15215276690img_0871.jpg/15215276691img_0872.jpg/15215276692img_0876.jpg', 1);
INSERT INTO `approved_rql` VALUES (4, 17, '2018-03-20', '15215296630img_0875.jpg/15215296631img_0876.jpg/15215296632img_0877.jpg', 1);

-- ----------------------------
-- Table structure for batched_trans_tbl
-- ----------------------------
DROP TABLE IF EXISTS `batched_trans_tbl`;
CREATE TABLE `batched_trans_tbl`  (
  `batch_id` int(11) NOT NULL AUTO_INCREMENT,
  `batch_no` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'batch-0',
  `batch_status` enum('complete','incomplete','processed','approved') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'incomplete',
  `manager_id` int(11) NULL DEFAULT 0,
  `arrival` date NULL DEFAULT NULL,
  `travel_type` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `via` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `flight_or_voyagenum` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `port_of_entry` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'none',
  `attached_eticket` varchar(2000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `batch_sender` int(11) NULL DEFAULT NULL,
  `date_sent` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`batch_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of batched_trans_tbl
-- ----------------------------
INSERT INTO `batched_trans_tbl` VALUES (13, 'batch-1', 'approved', 1, '2018-03-14', 'airplane', 'xaiamneed', '6515ib', 'jhvtf', 'uploads/01521009714airplane03142018xaiamneed6515ibjhvtf_eticket.docx', 1, '2018-03-14 14:41:54');
INSERT INTO `batched_trans_tbl` VALUES (14, 'batch-14', 'approved', 1, '2018-03-14', 'cruise', 'dsada', 'dsadad', 'dsada', 'uploads/01521010776airplane03142018dsadadsadaddsada_eticket.docx', 1, '2018-03-14 14:59:36');
INSERT INTO `batched_trans_tbl` VALUES (15, 'batch-15', 'processed', 0, '2018-03-20', 'airplane', 'Cebu Pacific', 'M42tgeagwg', 'Cebu international Airport', 'uploads/01521509873airplane03202018cebupacificm42tgeagwgcebuinternationalairport_eticket.pdf&uploads/11521509873airplane03202018cebupacificm42tgeagwgcebuinternationalairport_eticket.docx', 1, '2018-03-20 09:37:53');
INSERT INTO `batched_trans_tbl` VALUES (16, 'batch-16', 'processed', 0, '2018-03-23', 'cruise', 'Sea Voyage', 'MVPrincess', 'Caticlan', 'uploads/01521509938cruise03232018seavoyagemvprincesscaticlan_eticket.pdf&uploads/11521509938cruise03232018seavoyagemvprincesscaticlan_eticket.docx&uploads/21521509938cruise03232018seavoyagemvprincesscaticlan_eticket.docx', 1, '2018-03-20 09:38:58');
INSERT INTO `batched_trans_tbl` VALUES (17, 'batch-17', 'processed', 0, '2018-03-20', 'cruise', 'fafaf', 'aafaf', 'szafsadgsdg', 'uploads/01521513842cruise03202018fafafaafafszafsadgsdg_eticket.docx&uploads/11521513842cruise03202018fafafaafafszafsadgsdg_eticket.pdf', 1, '2018-03-20 10:44:02');
INSERT INTO `batched_trans_tbl` VALUES (18, 'batch-18', 'processed', 0, '2018-03-20', 'airplane', 'dsgsdg', 'sdgsg', 'safgsfh', 'uploads/01521514423airplane03202018dsgsdgsdgsgsafgsfh_eticket.pdf', 1, '2018-03-20 10:53:43');
INSERT INTO `batched_trans_tbl` VALUES (19, 'batch-19', 'processed', 0, '2018-03-20', 'cruise', 'sample', 'jjudfj', 'mactan bay', 'uploads/01521522030cruise03202018samplejjudfjmactanbay_eticket.docx', 1, '2018-03-20 13:00:30');
INSERT INTO `batched_trans_tbl` VALUES (20, 'batch-20', 'processed', 0, '2018-03-20', 'cruise', 'gaga', 'gasg', 'asgsag', 'uploads/01521525877cruise03202018gagagasgasgsag_eticket.docx&uploads/11521525877cruise03202018gagagasgasgsag_eticket.pdf', 1, '2018-03-20 14:04:37');
INSERT INTO `batched_trans_tbl` VALUES (21, 'batch-21', 'processed', 0, '2018-03-20', 'cruise', 'asgsaga', 'asgsag', 'sgsgs', 'uploads/01521526612cruise03202018asgsagaasgsagsgsgs_eticket.docx', 1, '2018-03-20 14:16:52');
INSERT INTO `batched_trans_tbl` VALUES (22, 'batch-22', 'processed', 0, '2018-03-20', 'airplane', 'Xiamen', 'XIAnsjsj', 'Manila International Airport', 'uploads/01521528998airplane03202018xiamenxiansjsjmanilainternationalairport_eticket.docx', 1, '2018-03-20 14:56:38');
INSERT INTO `batched_trans_tbl` VALUES (23, 'batch-23', 'approved', 1, '2018-03-31', 'cruise', 'Port of the sea', 'MVprincecharles', 'Kalibo international Airport', 'uploads/01521529177cruise03312018portoftheseamvprincecharleskalibointernationalairport_eticket.pdf&uploads/11521529177cruise03312018portoftheseamvprincecharleskalibointernationalairport_eticket.docx', 1, '2018-03-20 14:59:37');
INSERT INTO `batched_trans_tbl` VALUES (24, 'batch-24', 'incomplete', 0, '2018-03-20', 'airplane', 'asdgsadg', 'asdgsaghsa', 'ahahdah', 'uploads/01521533542airplane03202018asdgsadgasdgsaghsaahahdah_eticket.docx', 1, '2018-03-20 16:12:22');
INSERT INTO `batched_trans_tbl` VALUES (25, 'batch-25', 'complete', 0, '2019-12-05', 'airplane', 'BXU', 'FLIGHT', 'AASDQSDA', 'uploads/01575536223airplane12052019bxuflightaasdqsda_eticket.pdf', 1, '2019-12-05 16:57:03');
INSERT INTO `batched_trans_tbl` VALUES (26, 'batch-26', 'incomplete', 0, '2019-12-05', 'airplane', 'CDO', 'Plane', 'AASDQSDA', 'uploads/01575614643airplane12052019cdoplaneaasdqsda_eticket.pdf', 15, '2019-12-06 14:44:03');
INSERT INTO `batched_trans_tbl` VALUES (27, 'batch-27', 'complete', 0, '2019-12-05', 'airplane', 'CDO', 'plane', 'BXU', 'uploads/01575614853airplane12052019cdoplanebxu_eticket.pdf', 15, '2019-12-06 14:47:33');

-- ----------------------------
-- Table structure for batchedrequest_log_tbl
-- ----------------------------
DROP TABLE IF EXISTS `batchedrequest_log_tbl`;
CREATE TABLE `batchedrequest_log_tbl`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NULL DEFAULT NULL,
  `batch_no` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `batchrequest_stat` enum('new','read') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date_sentlogs` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of batchedrequest_log_tbl
-- ----------------------------
INSERT INTO `batchedrequest_log_tbl` VALUES (13, 1, 'batch-1', 'read', '2018-03-14 14:43:59');
INSERT INTO `batchedrequest_log_tbl` VALUES (14, 1, 'batch-14', 'read', '2018-03-14 14:59:36');
INSERT INTO `batchedrequest_log_tbl` VALUES (15, 1, 'batch-15', 'read', '2018-03-20 10:14:37');
INSERT INTO `batchedrequest_log_tbl` VALUES (16, 1, 'batch-16', 'read', '2018-03-20 09:38:58');
INSERT INTO `batchedrequest_log_tbl` VALUES (17, 1, 'batch-17', 'read', '2018-03-20 10:49:20');
INSERT INTO `batchedrequest_log_tbl` VALUES (18, 1, 'batch-18', 'read', '2018-03-20 12:44:18');
INSERT INTO `batchedrequest_log_tbl` VALUES (19, 1, 'batch-19', 'read', '2018-03-20 13:04:24');
INSERT INTO `batchedrequest_log_tbl` VALUES (20, 1, 'batch-20', 'read', '2018-03-20 14:10:00');
INSERT INTO `batchedrequest_log_tbl` VALUES (21, 1, 'batch-21', 'read', '2018-03-20 14:16:52');
INSERT INTO `batchedrequest_log_tbl` VALUES (22, 1, 'batch-22', 'read', '2018-03-20 14:56:38');
INSERT INTO `batchedrequest_log_tbl` VALUES (23, 1, 'batch-23', 'read', '2018-03-20 14:59:37');
INSERT INTO `batchedrequest_log_tbl` VALUES (24, 1, 'batch-24', 'read', '2019-12-05 22:41:46');
INSERT INTO `batchedrequest_log_tbl` VALUES (25, 1, 'batch-25', 'read', '2019-12-05 22:35:03');
INSERT INTO `batchedrequest_log_tbl` VALUES (26, 15, 'batch-26', 'read', '2019-12-06 14:44:03');
INSERT INTO `batchedrequest_log_tbl` VALUES (27, 15, 'batch-27', 'read', '2019-12-06 14:47:33');

-- ----------------------------
-- Table structure for boi_tbl
-- ----------------------------
DROP TABLE IF EXISTS `boi_tbl`;
CREATE TABLE `boi_tbl`  (
  `boiprofile_id` int(11) NOT NULL AUTO_INCREMENT,
  `current_commisioner` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `department` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `address` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`boiprofile_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of boi_tbl
-- ----------------------------
INSERT INTO `boi_tbl` VALUES (1, 'Hon. Jaime H. Morente', 'Bureau of Immigration', 'Magallanes Drive, Intramuros');
INSERT INTO `boi_tbl` VALUES (2, 'Hon. Sample2', 'Sample Bureu', 'Sample BureuAddress');

-- ----------------------------
-- Table structure for created_requestletter
-- ----------------------------
DROP TABLE IF EXISTS `created_requestletter`;
CREATE TABLE `created_requestletter`  (
  `requestletter_id` int(11) NOT NULL AUTO_INCREMENT,
  `batch_no` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `rq_to` int(11) NULL DEFAULT NULL,
  `letter_date` date NULL DEFAULT NULL,
  `assignatory` int(11) NULL DEFAULT NULL,
  `rq_status` enum('saved','printed','approved') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'saved',
  `created_by` int(11) NULL DEFAULT NULL,
  `date_created` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`requestletter_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of created_requestletter
-- ----------------------------
INSERT INTO `created_requestletter` VALUES (4, 'batch-1', 2, '2018-03-05', 3, 'approved', 1, '2018-03-14 14:45:19');
INSERT INTO `created_requestletter` VALUES (5, 'batch-14', 1, '2018-03-14', 1, 'approved', 1, '2018-03-14 15:17:38');
INSERT INTO `created_requestletter` VALUES (6, 'batch-15', 1, '2018-03-30', 3, 'printed', 1, '2018-03-20 10:19:56');
INSERT INTO `created_requestletter` VALUES (7, 'batch-15', 1, '2018-03-23', 1, 'printed', 1, '2018-03-20 10:22:08');
INSERT INTO `created_requestletter` VALUES (8, 'batch-16', 1, '2018-03-20', 1, 'printed', 1, '2018-03-20 10:21:51');
INSERT INTO `created_requestletter` VALUES (9, 'batch-17', 1, '2018-03-20', 1, 'printed', 1, '2018-03-20 10:50:10');
INSERT INTO `created_requestletter` VALUES (10, 'batch-18', 1, '2018-03-20', 1, 'printed', 1, '2018-03-20 12:53:14');
INSERT INTO `created_requestletter` VALUES (11, 'batch-19', 1, '2018-03-20', 1, 'printed', 1, '2018-03-20 13:27:07');
INSERT INTO `created_requestletter` VALUES (12, 'batch-19', 2, '2018-03-19', 3, 'printed', 1, '2018-03-20 13:28:47');
INSERT INTO `created_requestletter` VALUES (13, 'batch-19', 1, '2018-03-15', 1, 'printed', 1, '2018-03-20 13:29:25');
INSERT INTO `created_requestletter` VALUES (14, 'batch-20', 1, '2018-03-20', 3, 'printed', 1, '2018-03-20 14:10:21');
INSERT INTO `created_requestletter` VALUES (15, 'batch-21', 1, '2018-03-20', 1, 'printed', 1, '2018-03-20 14:18:22');
INSERT INTO `created_requestletter` VALUES (16, 'batch-22', 1, '2018-03-20', 1, 'printed', 1, '2018-03-20 15:06:16');
INSERT INTO `created_requestletter` VALUES (17, 'batch-23', 1, '2018-03-20', 1, 'approved', 1, '2018-03-20 15:06:28');
INSERT INTO `created_requestletter` VALUES (18, 'batch-27', 2, '2019-12-05', 1, 'saved', 1, '2019-12-06 14:49:10');

-- ----------------------------
-- Table structure for rq_assignatory_tbl
-- ----------------------------
DROP TABLE IF EXISTS `rq_assignatory_tbl`;
CREATE TABLE `rq_assignatory_tbl`  (
  `assignatory_id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `req_position` varchar(322) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`assignatory_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of rq_assignatory_tbl
-- ----------------------------
INSERT INTO `rq_assignatory_tbl` VALUES (1, 'Wilson Techico ', 'Vice President on Business & Product Development');
INSERT INTO `rq_assignatory_tbl` VALUES (3, 'Wilson Ang', 'Chief Operating Officer');

-- ----------------------------
-- Table structure for transremarks_tbl
-- ----------------------------
DROP TABLE IF EXISTS `transremarks_tbl`;
CREATE TABLE `transremarks_tbl`  (
  `trans_rmkid` int(11) NOT NULL AUTO_INCREMENT,
  `trans_no` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `remarks_by` int(11) NULL DEFAULT NULL,
  `remarks_type` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `description` varchar(999) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date_created` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`trans_rmkid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 140 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transremarks_tbl
-- ----------------------------
INSERT INTO `transremarks_tbl` VALUES (58, 'trans-1', 1, 'DRAFT', 'DRAFTED', '2018-03-14 14:35:10');
INSERT INTO `transremarks_tbl` VALUES (59, 'trans-21', 1, 'DRAFT', 'DRAFTED', '2018-03-14 14:35:32');
INSERT INTO `transremarks_tbl` VALUES (60, 'trans-22', 1, 'DRAFT', 'DRAFTED', '2018-03-14 14:35:53');
INSERT INTO `transremarks_tbl` VALUES (61, 'trans-22', 1, 'PENDING', 'PENDING', '2018-03-14 14:41:54');
INSERT INTO `transremarks_tbl` VALUES (62, 'trans-21', 1, 'PENDING', 'PENDING', '2018-03-14 14:41:54');
INSERT INTO `transremarks_tbl` VALUES (63, 'trans-1', 1, 'PENDING', 'PENDING', '2018-03-14 14:41:54');
INSERT INTO `transremarks_tbl` VALUES (64, 'trans-21', 1, 'VERIFIED', 'VERIFIED', '2018-03-14 14:43:06');
INSERT INTO `transremarks_tbl` VALUES (65, 'trans-1', 1, 'VERIFIED', 'VERIFIED', '2018-03-14 14:43:20');
INSERT INTO `transremarks_tbl` VALUES (66, 'trans-22', 1, 'VERIFIED', 'VERIFIED', '2018-03-14 14:43:39');
INSERT INTO `transremarks_tbl` VALUES (67, 'trans-23', 1, 'DRAFT', 'DRAFTED', '2018-03-14 14:59:19');
INSERT INTO `transremarks_tbl` VALUES (68, 'trans-23', 1, 'PENDING', 'PENDING', '2018-03-14 14:59:36');
INSERT INTO `transremarks_tbl` VALUES (69, 'trans-23', 1, 'VERIFIED', 'VERIFIED', '2018-03-14 14:59:48');
INSERT INTO `transremarks_tbl` VALUES (70, 'trans-24', 1, 'DRAFT', 'DRAFTED', '2018-03-20 08:44:27');
INSERT INTO `transremarks_tbl` VALUES (71, 'trans-25', 1, 'DRAFT', 'DRAFTED', '2018-03-20 08:57:29');
INSERT INTO `transremarks_tbl` VALUES (72, 'trans-26', 1, 'DRAFT', 'DRAFTED', '2018-03-20 09:33:33');
INSERT INTO `transremarks_tbl` VALUES (73, 'trans-27', 1, 'DRAFT', 'DRAFTED', '2018-03-20 09:34:49');
INSERT INTO `transremarks_tbl` VALUES (74, 'trans-28', 1, 'DRAFT', 'DRAFTED', '2018-03-20 09:35:43');
INSERT INTO `transremarks_tbl` VALUES (75, 'trans-29', 1, 'DRAFT', 'DRAFTED', '2018-03-20 09:36:22');
INSERT INTO `transremarks_tbl` VALUES (76, 'trans-26', 1, 'PENDING', 'PENDING', '2018-03-20 09:37:53');
INSERT INTO `transremarks_tbl` VALUES (77, 'trans-25', 1, 'PENDING', 'PENDING', '2018-03-20 09:37:53');
INSERT INTO `transremarks_tbl` VALUES (78, 'trans-29', 1, 'PENDING', 'PENDING', '2018-03-20 09:38:58');
INSERT INTO `transremarks_tbl` VALUES (79, 'trans-28', 1, 'PENDING', 'PENDING', '2018-03-20 09:38:58');
INSERT INTO `transremarks_tbl` VALUES (80, 'trans-27', 1, 'PENDING', 'PENDING', '2018-03-20 09:38:59');
INSERT INTO `transremarks_tbl` VALUES (81, 'trans-24', 1, 'PENDING', 'PENDING', '2018-03-20 09:38:59');
INSERT INTO `transremarks_tbl` VALUES (82, 'trans-25', 1, 'VERIFIED', 'VERIFIED', '2018-03-20 09:39:38');
INSERT INTO `transremarks_tbl` VALUES (83, 'trans-26', 1, 'VERIFIED', 'VERIFIED', '2018-03-20 09:39:50');
INSERT INTO `transremarks_tbl` VALUES (84, 'trans-30', 1, 'DRAFT', 'DRAFTED', '2018-03-20 09:50:13');
INSERT INTO `transremarks_tbl` VALUES (85, 'trans-24', 1, 'VERIFIED', 'VERIFIED', '2018-03-20 09:51:29');
INSERT INTO `transremarks_tbl` VALUES (86, 'trans-27', 1, 'VERIFIED', 'VERIFIED', '2018-03-20 09:53:20');
INSERT INTO `transremarks_tbl` VALUES (87, 'trans-28', 1, 'VERIFIED', 'VERIFIED', '2018-03-20 09:53:27');
INSERT INTO `transremarks_tbl` VALUES (88, 'trans-29', 1, 'VERIFIED', 'VERIFIED', '2018-03-20 09:53:33');
INSERT INTO `transremarks_tbl` VALUES (89, 'trans-30', 1, 'PENDING', 'PENDING', '2018-03-20 10:44:02');
INSERT INTO `transremarks_tbl` VALUES (90, 'trans-30', 1, 'VERIFIED', 'VERIFIED', '2018-03-20 10:46:13');
INSERT INTO `transremarks_tbl` VALUES (91, 'trans-31', 1, 'DRAFT', 'DRAFTED', '2018-03-20 10:52:09');
INSERT INTO `transremarks_tbl` VALUES (92, 'trans-31', 1, 'PENDING', 'PENDING', '2018-03-20 10:53:43');
INSERT INTO `transremarks_tbl` VALUES (93, 'trans-31', 1, 'VERIFIED', 'VERIFIED', '2018-03-20 10:55:11');
INSERT INTO `transremarks_tbl` VALUES (94, 'trans-32', 1, 'DRAFT', 'DRAFTED', '2018-03-20 12:58:11');
INSERT INTO `transremarks_tbl` VALUES (95, 'trans-32', 1, 'PENDING', 'PENDING', '2018-03-20 13:00:30');
INSERT INTO `transremarks_tbl` VALUES (96, 'trans-32', 1, 'VERIFIED', 'VERIFIED', '2018-03-20 13:03:01');
INSERT INTO `transremarks_tbl` VALUES (97, 'trans-33', 1, 'DRAFT', 'DRAFTED', '2018-03-20 13:12:28');
INSERT INTO `transremarks_tbl` VALUES (98, 'trans-34', 1, 'DRAFT', 'DRAFTED', '2018-03-20 14:04:16');
INSERT INTO `transremarks_tbl` VALUES (99, 'trans-34', 1, 'PENDING', 'PENDING', '2018-03-20 14:04:37');
INSERT INTO `transremarks_tbl` VALUES (100, 'trans-33', 1, 'PENDING', 'PENDING', '2018-03-20 14:04:37');
INSERT INTO `transremarks_tbl` VALUES (101, 'trans-33', 1, 'VERIFIED', 'VERIFIED', '2018-03-20 14:07:58');
INSERT INTO `transremarks_tbl` VALUES (102, 'trans-34', 1, 'VERIFIED', 'VERIFIED', '2018-03-20 14:08:25');
INSERT INTO `transremarks_tbl` VALUES (103, 'trans-35', 1, 'DRAFT', 'DRAFTED', '2018-03-20 14:16:38');
INSERT INTO `transremarks_tbl` VALUES (104, 'trans-35', 1, 'PENDING', 'PENDING', '2018-03-20 14:16:52');
INSERT INTO `transremarks_tbl` VALUES (105, 'trans-35', 1, 'VERIFIED', 'VERIFIED', '2018-03-20 14:17:01');
INSERT INTO `transremarks_tbl` VALUES (106, 'trans-36', 1, 'DRAFT', 'DRAFTED', '2018-03-20 14:42:56');
INSERT INTO `transremarks_tbl` VALUES (107, 'trans-37', 1, 'DRAFT', 'DRAFTED', '2018-03-20 14:43:17');
INSERT INTO `transremarks_tbl` VALUES (108, 'trans-38', 1, 'DRAFT', 'DRAFTED', '2018-03-20 14:43:41');
INSERT INTO `transremarks_tbl` VALUES (109, 'trans-39', 1, 'DRAFT', 'DRAFTED', '2018-03-20 14:44:47');
INSERT INTO `transremarks_tbl` VALUES (110, 'trans-40', 1, 'DRAFT', 'DRAFTED', '2018-03-20 14:45:08');
INSERT INTO `transremarks_tbl` VALUES (111, 'trans-41', 1, 'DRAFT', 'DRAFTED', '2018-03-20 14:46:13');
INSERT INTO `transremarks_tbl` VALUES (112, 'trans-36', 1, '', '', '2018-03-20 14:50:53');
INSERT INTO `transremarks_tbl` VALUES (113, 'trans-37', 1, 'PENDING', 'PENDING', '2018-03-20 14:56:38');
INSERT INTO `transremarks_tbl` VALUES (114, 'trans-36', 1, 'PENDING', 'PENDING', '2018-03-20 14:56:38');
INSERT INTO `transremarks_tbl` VALUES (115, 'trans-41', 1, 'PENDING', 'PENDING', '2018-03-20 14:59:37');
INSERT INTO `transremarks_tbl` VALUES (116, 'trans-40', 1, 'PENDING', 'PENDING', '2018-03-20 14:59:37');
INSERT INTO `transremarks_tbl` VALUES (117, 'trans-39', 1, 'PENDING', 'PENDING', '2018-03-20 14:59:38');
INSERT INTO `transremarks_tbl` VALUES (118, 'trans-38', 1, 'PENDING', 'PENDING', '2018-03-20 14:59:38');
INSERT INTO `transremarks_tbl` VALUES (119, 'trans-36', 1, 'VERIFIED', 'VERIFIED', '2018-03-20 14:59:48');
INSERT INTO `transremarks_tbl` VALUES (120, 'trans-37', 1, 'VERIFIED', 'VERIFIED', '2018-03-20 14:59:59');
INSERT INTO `transremarks_tbl` VALUES (121, 'trans-38', 1, 'VERIFIED', 'VERIFIED', '2018-03-20 15:02:59');
INSERT INTO `transremarks_tbl` VALUES (122, 'trans-39', 1, 'VERIFIED', 'VERIFIED', '2018-03-20 15:03:13');
INSERT INTO `transremarks_tbl` VALUES (123, 'trans-40', 1, 'VERIFIED', 'VERIFIED', '2018-03-20 15:03:24');
INSERT INTO `transremarks_tbl` VALUES (124, 'trans-41', 1, 'VERIFIED', 'VERIFIED', '2018-03-20 15:03:31');
INSERT INTO `transremarks_tbl` VALUES (125, 'trans-42', 3, 'DRAFT', 'DRAFTED', '2018-03-20 15:07:38');
INSERT INTO `transremarks_tbl` VALUES (126, 'trans-43', 3, 'DRAFT', 'DRAFTED', '2018-03-20 15:08:11');
INSERT INTO `transremarks_tbl` VALUES (127, 'trans-44', 1, 'DRAFT', 'DRAFTED', '2018-03-20 16:11:28');
INSERT INTO `transremarks_tbl` VALUES (128, 'trans-44', 1, 'PENDING', 'PENDING', '2018-03-20 16:12:22');
INSERT INTO `transremarks_tbl` VALUES (129, 'trans-45', 1, 'DRAFT', 'DRAFTED', '2019-12-05 16:42:13');
INSERT INTO `transremarks_tbl` VALUES (130, 'trans-45', 1, '', '', '2019-12-05 16:55:12');
INSERT INTO `transremarks_tbl` VALUES (131, 'trans-46', 1, 'DRAFT', 'DRAFTED', '2019-12-05 16:55:51');
INSERT INTO `transremarks_tbl` VALUES (132, 'trans-46', 1, 'PENDING', 'PENDING', '2019-12-05 16:57:03');
INSERT INTO `transremarks_tbl` VALUES (133, 'trans-47', 1, 'DRAFT', 'DRAFTED', '2019-12-05 16:57:43');
INSERT INTO `transremarks_tbl` VALUES (134, 'trans-46', 1, 'VERIFIED', 'VERIFIED', '2019-12-06 12:00:14');
INSERT INTO `transremarks_tbl` VALUES (135, 'trans-48', 15, 'DRAFT', 'DRAFTED', '2019-12-06 14:24:21');
INSERT INTO `transremarks_tbl` VALUES (136, 'trans-48', 15, 'PENDING', 'PENDING', '2019-12-06 14:44:03');
INSERT INTO `transremarks_tbl` VALUES (137, 'trans-48', 1, 'JUNKED', 'JUNKED', '2019-12-06 14:45:40');
INSERT INTO `transremarks_tbl` VALUES (138, 'trans-49', 15, 'DRAFT', 'DRAFTED', '2019-12-06 14:46:58');
INSERT INTO `transremarks_tbl` VALUES (139, 'trans-49', 15, 'PENDING', 'PENDING', '2019-12-06 14:47:33');
INSERT INTO `transremarks_tbl` VALUES (140, 'trans-49', 1, 'VERIFIED', 'VERIFIED', '2019-12-06 14:48:14');

-- ----------------------------
-- Table structure for uni_tbl
-- ----------------------------
DROP TABLE IF EXISTS `uni_tbl`;
CREATE TABLE `uni_tbl`  (
  `company_profile_id` int(11) NOT NULL AUTO_INCREMENT,
  `uni_name` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `uni_addr` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `uni_email` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `uni_tel` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `uni_website` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`company_profile_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of uni_tbl
-- ----------------------------
INSERT INTO `uni_tbl` VALUES (1, 'Uni Orient Travel, Inc.', 'Suite 2006A, Philippine Stock Exchange Center, 5 Pasig City,Metro Manila Philippines 1605', 'markramilo@uniorient.net', '+63-2-705-2222', 'http://www.uniorient.com/');

-- ----------------------------
-- Table structure for user_tbl
-- ----------------------------
DROP TABLE IF EXISTS `user_tbl`;
CREATE TABLE `user_tbl`  (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `user_pass` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'uni000',
  `user_status` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'active',
  `user_type` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `user_lname` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `user_fname` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `user_branch` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `user_profilepath` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'uploads/default.png',
  `created_by` int(11) NULL DEFAULT NULL,
  `date_created` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_tbl
-- ----------------------------
INSERT INTO `user_tbl` VALUES (1, 'admin@gmail.com', '03PeGuw1vSchw', 'active', 'admin', 'samplex', 'sample ', 'binondo', 'uploads/default.png', 0, '2018-02-05 09:04:09');
INSERT INTO `user_tbl` VALUES (2, 'frank@gmail.com', '03HsKggu1Celk', 'active', 'manager', 'Corpuz', 'Frank', 'binondo', 'uploads/default.png', 1, '2018-03-08 15:51:51');
INSERT INTO `user_tbl` VALUES (3, 'john@gmail.com', '03HsKggu1Celk', 'active', 'agent', 'bardinas', 'john', 'china', 'uploads/default.png', 1, '2018-03-09 13:15:28');
INSERT INTO `user_tbl` VALUES (6, 'marcpanaligan98@gmail.com', '03PeGuw1vSchw', 'active', 'admin', 'Panaligan', 'Marc', 'binondo', 'uploads/default.png', 1, '2019-12-05 14:36:37');
INSERT INTO `user_tbl` VALUES (15, 'user@gmail.com', '03PeGuw1vSchw', 'active', 'agent', 'user', 'user', 'binondo', 'uploads/default.png', 1, '2019-12-06 14:22:34');

-- ----------------------------
-- Table structure for verifying_visatransac_tbl
-- ----------------------------
DROP TABLE IF EXISTS `verifying_visatransac_tbl`;
CREATE TABLE `verifying_visatransac_tbl`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_no` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `verified_by` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date_verified` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 37 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of verifying_visatransac_tbl
-- ----------------------------
INSERT INTO `verifying_visatransac_tbl` VALUES (14, 'trans-21', '1', '2018-03-14 14:43:06');
INSERT INTO `verifying_visatransac_tbl` VALUES (15, 'trans-1', '1', '2018-03-14 14:43:20');
INSERT INTO `verifying_visatransac_tbl` VALUES (16, 'trans-22', '1', '2018-03-14 14:43:39');
INSERT INTO `verifying_visatransac_tbl` VALUES (17, 'trans-23', '1', '2018-03-14 14:59:48');
INSERT INTO `verifying_visatransac_tbl` VALUES (18, 'trans-25', '1', '2018-03-20 09:39:38');
INSERT INTO `verifying_visatransac_tbl` VALUES (19, 'trans-26', '1', '2018-03-20 09:39:50');
INSERT INTO `verifying_visatransac_tbl` VALUES (20, 'trans-24', '1', '2018-03-20 09:51:29');
INSERT INTO `verifying_visatransac_tbl` VALUES (21, 'trans-27', '1', '2018-03-20 09:53:20');
INSERT INTO `verifying_visatransac_tbl` VALUES (22, 'trans-28', '1', '2018-03-20 09:53:27');
INSERT INTO `verifying_visatransac_tbl` VALUES (23, 'trans-29', '1', '2018-03-20 09:53:33');
INSERT INTO `verifying_visatransac_tbl` VALUES (24, 'trans-30', '1', '2018-03-20 10:46:13');
INSERT INTO `verifying_visatransac_tbl` VALUES (25, 'trans-31', '1', '2018-03-20 10:55:11');
INSERT INTO `verifying_visatransac_tbl` VALUES (26, 'trans-32', '1', '2018-03-20 13:03:01');
INSERT INTO `verifying_visatransac_tbl` VALUES (27, 'trans-33', '1', '2018-03-20 14:07:58');
INSERT INTO `verifying_visatransac_tbl` VALUES (28, 'trans-34', '1', '2018-03-20 14:08:25');
INSERT INTO `verifying_visatransac_tbl` VALUES (29, 'trans-35', '1', '2018-03-20 14:17:01');
INSERT INTO `verifying_visatransac_tbl` VALUES (30, 'trans-36', '1', '2018-03-20 14:59:48');
INSERT INTO `verifying_visatransac_tbl` VALUES (31, 'trans-37', '1', '2018-03-20 14:59:59');
INSERT INTO `verifying_visatransac_tbl` VALUES (32, 'trans-38', '1', '2018-03-20 15:02:59');
INSERT INTO `verifying_visatransac_tbl` VALUES (33, 'trans-39', '1', '2018-03-20 15:03:13');
INSERT INTO `verifying_visatransac_tbl` VALUES (34, 'trans-40', '1', '2018-03-20 15:03:24');
INSERT INTO `verifying_visatransac_tbl` VALUES (35, 'trans-41', '1', '2018-03-20 15:03:31');
INSERT INTO `verifying_visatransac_tbl` VALUES (36, 'trans-46', '1', '2019-12-06 12:00:14');
INSERT INTO `verifying_visatransac_tbl` VALUES (37, 'trans-49', '1', '2019-12-06 14:48:14');

-- ----------------------------
-- Table structure for visatransactions_tbl
-- ----------------------------
DROP TABLE IF EXISTS `visatransactions_tbl`;
CREATE TABLE `visatransactions_tbl`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_no` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'trans-0',
  `batch_no` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'none',
  `va_lname` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `va_fname` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `va_dob` date NULL DEFAULT NULL,
  `va_gender` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `va_passportnum` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `trans_status` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'draft',
  `attached_passport` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'uploads/passport.png',
  `stampped_passport` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'uploads/passport.png',
  `created_by` int(11) NULL DEFAULT NULL,
  `date_created` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 49 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of visatransactions_tbl
-- ----------------------------
INSERT INTO `visatransactions_tbl` VALUES (20, 'trans-1', 'batch-1', 'bardinas', 'john lito', '2018-03-13', 'M', '32asd', 'APPROVED', 'uploads/1521009310bardinasjohnlito20180313_passport.jpg', 'uploads/koala.jpg', 1, '2018-03-14 14:35:10');
INSERT INTO `visatransactions_tbl` VALUES (21, 'trans-21', 'batch-1', 'corpuz', 'frank', '2018-03-12', 'M', 'szd324', 'APPROVED', 'uploads/1521009332corpuzfrank20180312_passport.jpg', 'uploads/sample_passport.jpg', 1, '2018-03-14 14:35:32');
INSERT INTO `visatransactions_tbl` VALUES (22, 'trans-22', 'batch-1', 'melvin', 'gonzales', '2018-03-14', 'M', 'dsada', 'APPROVED', 'uploads/1521009353melvingonzales20180314_passport.jpg', 'uploads/sample_passport.jpg', 1, '2018-03-14 14:35:53');
INSERT INTO `visatransactions_tbl` VALUES (23, 'trans-23', 'batch-14', 'm ', 'Zhayt', '2018-03-13', 'M', 'dasd32', 'APPROVED', 'uploads/1521010759mZhayt20180313_passport.jpg', 'uploads/img_0872.jpg', 1, '2018-03-14 14:59:19');
INSERT INTO `visatransactions_tbl` VALUES (24, 'trans-24', 'batch-16', 'Hanabishi', 'Recca', '2018-03-20', 'M', '02241191', 'PROCESSED', 'uploads/1521506667HanabishiRecca20180320_passport.jpg', 'uploads/passport.png', 1, '2018-03-20 08:44:27');
INSERT INTO `visatransactions_tbl` VALUES (25, 'trans-25', 'batch-15', 'dsada', 'dasda', '2018-03-20', 'M', 'dada', 'PROCESSED', 'uploads/1521509596dsadadasda20180320_passport.jpg', 'uploads/passport.png', 1, '2018-03-20 08:57:29');
INSERT INTO `visatransactions_tbl` VALUES (26, 'trans-26', 'batch-15', 's', 'sg', '2018-03-20', 'M', 'sgasg', 'PROCESSED', 'uploads/1521509613ssg20180320_passport.jpg', 'uploads/passport.png', 1, '2018-03-20 09:33:33');
INSERT INTO `visatransactions_tbl` VALUES (27, 'trans-27', 'batch-16', 'Dummonssss', 'Maxxessss', '1991-02-24', 'F', 'sagsags', 'PROCESSED', 'uploads/1521509689DummonMaxx19910224_passport.jpg', 'uploads/passport.png', 1, '2018-03-20 09:34:49');
INSERT INTO `visatransactions_tbl` VALUES (28, 'trans-28', 'batch-16', 'Yanagi', 'Anna', '1991-04-21', 'M', 'asdfsdfdsf', 'PROCESSED', 'uploads/1521509743YanagiAnna19910421_passport.jpg', 'uploads/passport.png', 1, '2018-03-20 09:35:43');
INSERT INTO `visatransactions_tbl` VALUES (29, 'trans-29', 'batch-16', 'Kirisawa', 'Aira', '1992-12-24', 'M', '35235235', 'PROCESSED', 'uploads/1521509782KirisawaAira19921224_passport.jpg', 'uploads/passport.png', 1, '2018-03-20 09:36:22');
INSERT INTO `visatransactions_tbl` VALUES (30, 'trans-30', 'batch-17', 'Yes', 'Yes', '2018-03-20', 'M', '25235', 'PROCESSED', 'uploads/1521510613YesYes20180320_passport.jpg', 'uploads/passport.png', 1, '2018-03-20 09:50:13');
INSERT INTO `visatransactions_tbl` VALUES (31, 'trans-31', 'batch-18', 'eryery', 'etyey', '2018-03-20', 'M', 'eyey', 'PROCESSED', 'uploads/1521514328eryeryetyey20180320_passport.jpg', 'uploads/passport.png', 1, '2018-03-20 10:52:09');
INSERT INTO `visatransactions_tbl` VALUES (32, 'trans-32', 'batch-19', 'chen', 'chen', '2018-03-20', 'M', 'dasdada', 'PROCESSED', 'uploads/1521521891chenchen20180320_passport.jpg', 'uploads/passport.png', 1, '2018-03-20 12:58:11');
INSERT INTO `visatransactions_tbl` VALUES (33, 'trans-33', 'batch-20', 'dgasg', 'sgsa', '2018-03-20', 'M', 'sadgsg', 'PROCESSED', 'uploads/1521522748dgasgsgsa20180320_passport.jpg', 'uploads/passport.png', 1, '2018-03-20 13:12:28');
INSERT INTO `visatransactions_tbl` VALUES (34, 'trans-34', 'batch-20', 'Asuncion', 'RJ', '2018-03-22', 'M', '123523525', 'PROCESSED', 'uploads/1521525856AsuncionRJ20180322_passport.jpg', 'uploads/passport.png', 1, '2018-03-20 14:04:16');
INSERT INTO `visatransactions_tbl` VALUES (35, 'trans-35', 'batch-21', 'Bugtong ', 'Mikay', '2018-03-23', 'M', '2525252', 'PROCESSED', 'uploads/1521526598BugtongMikay20180323_passport.jpg', 'uploads/passport.png', 1, '2018-03-20 14:16:38');
INSERT INTO `visatransactions_tbl` VALUES (36, 'trans-36', 'batch-22', 'Cariaga', 'Donna', '2018-02-13', 'M', '12412415', 'PROCESSED', 'uploads/1521528176CariagaDonna20180213_passport.jpg', 'uploads/passport.png', 1, '2018-03-20 14:42:56');
INSERT INTO `visatransactions_tbl` VALUES (37, 'trans-37', 'batch-22', 'Cariaga', 'James', '2018-03-08', 'M', '15151515', 'PROCESSED', 'uploads/1521528197CariagaJames20180308_passport.jpg', 'uploads/passport.png', 1, '2018-03-20 14:43:17');
INSERT INTO `visatransactions_tbl` VALUES (38, 'trans-38', 'batch-23', 'Uzumaki', 'Naruto', '2018-03-31', 'M', '23523523', 'APPROVED', 'uploads/1521528221UzumakiNaruto20180331_passport.jpg', 'uploads/img_0872.jpg', 1, '2018-03-20 14:43:41');
INSERT INTO `visatransactions_tbl` VALUES (39, 'trans-39', 'batch-23', 'Uzumaki', 'Borutoss', '2018-03-06', 'M', 'sadgsag', 'APPROVED', 'uploads/1521528287UzumakiBoruto20180306_passport.jpg', 'uploads/img_0882.jpg', 1, '2018-03-20 14:44:47');
INSERT INTO `visatransactions_tbl` VALUES (40, 'trans-40', 'batch-23', 'Uzumaki', 'Hinata', '2018-03-31', 'F', '236236236', 'APPROVED', 'uploads/1521528308UzumakiHinata20180331_passport.jpg', 'uploads/img_0877.jpg', 1, '2018-03-20 14:45:08');
INSERT INTO `visatransactions_tbl` VALUES (41, 'trans-41', 'batch-23', 'Uzumaki', 'Himawari', '2018-03-29', 'F', '25235235', 'APPROVED', 'uploads/1521528373UzumakiHimawari20180329_passport.jpg', 'uploads/img_0880.jpg', 1, '2018-03-20 14:46:13');
INSERT INTO `visatransactions_tbl` VALUES (42, 'trans-42', 'none', 'fsfs', 'fdsfs', '1966-12-15', 'M', 'fsf', 'draft', 'uploads/1521529658fsfsfdsfs20180320_passport.jpg', 'uploads/passport.png', 3, '2018-03-20 15:07:38');
INSERT INTO `visatransactions_tbl` VALUES (43, 'trans-43', 'none', 'mars', 'bruno', '2018-03-20', 'F', '4tsdg45', 'draft', 'uploads/1521529691marsbruno20180320_passport.jpg', 'uploads/passport.png', 3, '2018-03-20 15:08:11');
INSERT INTO `visatransactions_tbl` VALUES (44, 'trans-44', 'batch-24', 'asgsg', 'snaksng', '2018-03-22', 'M', 'sgsag', 'PENDING', 'uploads/1521533488asgsgsnaksng20180322_passport.jpg', 'uploads/passport.png', 1, '2018-03-20 16:11:28');
INSERT INTO `visatransactions_tbl` VALUES (45, 'trans-45', 'none', 'Panaligan', 'Marc', '2019-12-26', 'M', 'ABCD123456', NULL, 'uploads/1575535333PanaliganMarc20191226_passport.jpg', 'uploads/passport.png', 1, '2019-12-05 16:42:13');
INSERT INTO `visatransactions_tbl` VALUES (46, 'trans-46', 'batch-25', 'Panaligan', 'Marc', '2019-12-05', 'M', 'ABCD123456', 'VERIFIED', 'uploads/1575536151PanaliganMarc20191205_passport.jpg', 'uploads/passport.png', 1, '2019-12-05 16:55:51');
INSERT INTO `visatransactions_tbl` VALUES (47, 'trans-47', 'none', 'Panaligan', 'Marc', '2019-12-25', 'M', 'ABCD123456', 'draft', 'uploads/1575536263PanaliganMarc20191225_passport.jpg', 'uploads/passport.png', 1, '2019-12-05 16:57:43');
INSERT INTO `visatransactions_tbl` VALUES (48, 'trans-48', 'batch-26', 'User', 'Testing', '2019-12-03', 'M', 'ABCD123456', 'DELETED', 'uploads/1575613461UserTesting20191203_passport.jpg', 'uploads/passport.png', 15, '2019-12-06 14:24:21');
INSERT INTO `visatransactions_tbl` VALUES (49, 'trans-49', 'batch-27', 'Reginald', 'Marc', '2019-12-06', 'M', 'ABCD123456', 'VERIFIED', 'uploads/1575614818ReginaldMarc20191206_passport.jpg', 'uploads/passport.png', 15, '2019-12-06 14:46:58');

-- ----------------------------
-- View structure for agent_sentbatch
-- ----------------------------
DROP VIEW IF EXISTS `agent_sentbatch`;
CREATE ALGORITHM = UNDEFINED DEFINER = `root`@`localhost` SQL SECURITY DEFINER VIEW `agent_sentbatch` AS select distinct `bt`.`batch_id` AS `batch_id`,`bt`.`batch_no` AS `batch_no`,concat(`usr`.`user_fname`,'',`usr`.`user_lname`) AS `sender`,date_format(`bt`.`date_sent`,'%b. %d, %Y %l:%i %p') AS `date_sent`,`bt`.`batch_status` AS `batch_status`,`bt`.`batch_sender` AS `sender_id` from ((`batched_trans_tbl` `bt` join `visatransactions_tbl` `vt` on((convert(`bt`.`batch_no` using utf8) = `vt`.`batch_no`))) join `user_tbl` `usr` on((`bt`.`batch_sender` = `usr`.`user_id`))) where (`bt`.`batch_status` in ('incomplete','complete','processed','approved'));

-- ----------------------------
-- View structure for approved_view
-- ----------------------------
DROP VIEW IF EXISTS `approved_view`;
CREATE ALGORITHM = UNDEFINED DEFINER = `root`@`localhost` SQL SECURITY DEFINER VIEW `approved_view` AS select `rql`.`requestletter_id` AS `rql_id`,`bt`.`batch_no` AS `batch_no`,date_format(`rql`.`letter_date`,'%b. %d, %Y') AS `letter_date`,date_format(`bt`.`arrival`,'%b. %d, %Y') AS `arrival`,upper(`bt`.`flight_or_voyagenum`) AS `fov`,concat(`usr`.`user_fname`,'',`usr`.`user_lname`) AS `created_by`,date_format(`rql`.`date_created`,'%b. %d, %Y') AS `date_generated`,date_format(`rql`.`date_created`,'%Y-%m-%d') AS `iso_date` from ((`created_requestletter` `rql` join `batched_trans_tbl` `bt` on((`rql`.`batch_no` = `bt`.`batch_no`))) join `user_tbl` `usr` on((`rql`.`created_by` = `usr`.`user_id`))) where (`rql`.`rq_status` = 'approved');

-- ----------------------------
-- View structure for batchrec_view
-- ----------------------------
DROP VIEW IF EXISTS `batchrec_view`;
CREATE ALGORITHM = UNDEFINED DEFINER = `root`@`localhost` SQL SECURITY DEFINER VIEW `batchrec_view` AS select distinct `bt`.`batch_id` AS `batch_id`,`bt`.`batch_no` AS `batch_no`,concat(`usr`.`user_fname`,' ',`usr`.`user_lname`) AS `sender`,date_format(`bt`.`date_sent`,'%b. %d, %Y %l:%i %p') AS `date_sent`,`bt`.`batch_status` AS `batch_status`,`bt`.`batch_sender` AS `sender_id` from ((`batched_trans_tbl` `bt` join `visatransactions_tbl` `vt` on((convert(`bt`.`batch_no` using utf8) = `vt`.`batch_no`))) join `user_tbl` `usr` on((`bt`.`batch_sender` = `usr`.`user_id`))) where (`vt`.`trans_status` not in ('JUNKED','PROCESSED','APPROVED'));

-- ----------------------------
-- View structure for batchrql_view
-- ----------------------------
DROP VIEW IF EXISTS `batchrql_view`;
CREATE ALGORITHM = UNDEFINED DEFINER = `root`@`localhost` SQL SECURITY DEFINER VIEW `batchrql_view` AS select `btchlog`.`batch_no` AS `batch_no`,date_format(`btchlog`.`date_sentlogs`,'%b. %d, %Y %l:%i %p') AS `date_sent`,`usr`.`user_profilepath` AS `profile_pic`,lower(concat(`usr`.`user_fname`,'',`usr`.`user_lname`)) AS `sender`,upper(`btchlog`.`batchrequest_stat`) AS `status`,`bt`.`batch_status` AS `batch_status`,`btchlog`.`sender_id` AS `sender_id` from ((`batchedrequest_log_tbl` `btchlog` join `user_tbl` `usr` on((`btchlog`.`sender_id` = `usr`.`user_id`))) join `batched_trans_tbl` `bt` on((`btchlog`.`batch_no` = `bt`.`batch_no`))) where ((`btchlog`.`date_sentlogs` >= (cast(now() as date) - interval 7 day)) and (`bt`.`batch_status` in ('incomplete','complete','approved'))) order by `btchlog`.`date_sentlogs` desc;

-- ----------------------------
-- View structure for draft_rq
-- ----------------------------
DROP VIEW IF EXISTS `draft_rq`;
CREATE ALGORITHM = UNDEFINED DEFINER = `root`@`localhost` SQL SECURITY DEFINER VIEW `draft_rq` AS select `cr`.`requestletter_id` AS `rq_num`,`cr`.`batch_no` AS `rq_batchnum`,date_format(`cr`.`letter_date`,'%M %d, %Y') AS `letter_date`,date_format(`batch`.`arrival`,'%b. %d, %Y') AS `arrival`,`batch`.`flight_or_voyagenum` AS `fov`,concat(`usr`.`user_fname`,' ',`usr`.`user_lname`) AS `created_by`,date_format(`cr`.`date_created`,'%b. %d, %Y %l:%i %p') AS `last_saved` from ((((`created_requestletter` `cr` join `batched_trans_tbl` `batch` on((`cr`.`batch_no` = `batch`.`batch_no`))) join `boi_tbl` `bt` on((`cr`.`rq_to` = `bt`.`boiprofile_id`))) join `rq_assignatory_tbl` `sg` on((`cr`.`assignatory` = `sg`.`assignatory_id`))) join `user_tbl` `usr` on((`cr`.`created_by` = `usr`.`user_id`))) where ((`cr`.`rq_status` <> 'printed') and (`cr`.`rq_status` <> 'approved'));

-- ----------------------------
-- View structure for inbox_view
-- ----------------------------
DROP VIEW IF EXISTS `inbox_view`;
CREATE ALGORITHM = UNDEFINED DEFINER = `root`@`localhost` SQL SECURITY DEFINER VIEW `inbox_view` AS select `vt`.`id` AS `trans_id`,`bt`.`batch_id` AS `batch_id`,`bt`.`batch_no` AS `batch_no`,date_format(`bt`.`arrival`,'%b. %d, %Y') AS `arrival`,`vt`.`trans_no` AS `trans_no`,lower(concat(`vt`.`va_fname`,' ',`vt`.`va_lname`)) AS `full_name`,`vt`.`va_gender` AS `gender`,`vt`.`va_passportnum` AS `passport`,`bt`.`flight_or_voyagenum` AS `fov_num`,`vt`.`trans_status` AS `trans_status`,lower(concat(`user`.`user_fname`,'',`user`.`user_lname`)) AS `sender`,date_format(`bt`.`date_sent`,'%b. %d, %Y %h:%i %p') AS `date_sent`,`user`.`user_id` AS `sender_id` from ((`visatransactions_tbl` `vt` join `batched_trans_tbl` `bt` on((`vt`.`batch_no` = convert(`bt`.`batch_no` using utf8)))) join `user_tbl` `user` on((`bt`.`batch_sender` = `user`.`user_id`))) where ((`vt`.`trans_status` = 'PENDING') or (`vt`.`trans_status` = 'VERIFIED')) order by `bt`.`date_sent`;

-- ----------------------------
-- View structure for inprocess_view
-- ----------------------------
DROP VIEW IF EXISTS `inprocess_view`;
CREATE ALGORITHM = UNDEFINED DEFINER = `root`@`localhost` SQL SECURITY DEFINER VIEW `inprocess_view` AS select `rql`.`requestletter_id` AS `rql_id`,`bt`.`batch_no` AS `batch_no`,date_format(`rql`.`letter_date`,'%b. %d, %Y') AS `letter_date`,date_format(`bt`.`arrival`,'%b. %d, %Y') AS `arrival`,upper(`bt`.`flight_or_voyagenum`) AS `fov`,concat(`usr`.`user_fname`,'',`usr`.`user_lname`) AS `created_by`,date_format(`rql`.`date_created`,'%b. %d, %Y') AS `date_generated` from ((`created_requestletter` `rql` join `batched_trans_tbl` `bt` on((`rql`.`batch_no` = `bt`.`batch_no`))) join `user_tbl` `usr` on((`rql`.`created_by` = `usr`.`user_id`))) where (`rql`.`rq_status` = 'printed');

-- ----------------------------
-- View structure for junked_view
-- ----------------------------
DROP VIEW IF EXISTS `junked_view`;
CREATE ALGORITHM = UNDEFINED DEFINER = `root`@`localhost` SQL SECURITY DEFINER VIEW `junked_view` AS select `vt`.`trans_no` AS `trans_no`,concat(`vt`.`va_fname`,'',`vt`.`va_lname`) AS `fullname`,`vt`.`va_gender` AS `gender`,date_format(`vt`.`va_dob`,'%b. %d, %Y') AS `dob`,upper(`vt`.`va_passportnum`) AS `passport`,upper(`bt`.`flight_or_voyagenum`) AS `fov`,date_format(`bt`.`arrival`,'%b. %d, %Y') AS `arrival`,date_format(`vt`.`date_created`,'%b. %d, %Y %h:%i %p') AS `date_created` from (`visatransactions_tbl` `vt` join `batched_trans_tbl` `bt` on((`vt`.`batch_no` = convert(`bt`.`batch_no` using utf8)))) where (`vt`.`trans_status` = 'JUNKED');

-- ----------------------------
-- View structure for rqlprinted_view
-- ----------------------------
DROP VIEW IF EXISTS `rqlprinted_view`;
CREATE ALGORITHM = UNDEFINED DEFINER = `root`@`localhost` SQL SECURITY DEFINER VIEW `rqlprinted_view` AS select `rql`.`requestletter_id` AS `rqlid`,`rql`.`batch_no` AS `batchnum`,date_format(`rql`.`letter_date`,'%b. %d, %Y') AS `letter_date`,date_format(`bt`.`arrival`,'%b. %d, %Y') AS `arrival_date`,upper(`bt`.`flight_or_voyagenum`) AS `fov`,concat(`usr`.`user_fname`,'',`usr`.`user_lname`) AS `created_by`,date_format(`rql`.`date_created`,'%Y-%m-%d') AS `date_created` from ((`created_requestletter` `rql` left join `batched_trans_tbl` `bt` on((`rql`.`batch_no` = `bt`.`batch_no`))) left join `user_tbl` `usr` on((`rql`.`created_by` = `usr`.`user_id`))) where (`rql`.`rq_status` = 'printed') group by `rql`.`batch_no`;

-- ----------------------------
-- Procedure structure for agentDraft
-- ----------------------------
DROP PROCEDURE IF EXISTS `agentDraft`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `agentDraft`(IN `agentId` INT)
BEGIN
	SELECT 
	LOWER(trans_no) AS 'trans_no',
    LOWER(CONCAT(va_fname,' ',va_lname)) AS 'fullname',
    UPPER(va_gender) AS 'gender',
    DATE_FORMAT(va_dob, '%b. %d-%Y') AS 'birthdate',
    LOWER(va_passportnum) AS 'passport',
    DATE_FORMAT(date_created, '%b. %d, %Y %l:%i %p') AS 'created'
	FROM visatransactions_tbl
	WHERE created_by = agentId
    AND trans_status = 'draft'
	ORDER BY date_created DESC; 

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for agentRightBar
-- ----------------------------
DROP PROCEDURE IF EXISTS `agentRightBar`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `agentRightBar`(IN `inSender` INT)
BEGIN
	SELECT 
	 
	 btrql.batch_no AS 'batch_no',
	 btrql.date_sent AS 'date_sent',
	 btrql.sender 	AS 'sender',
	 `btrql`.`status` AS 'status',
	 btrql.profile_pic AS 'profile_pic'
	FROM 
	batchrql_view AS btrql
	INNER JOIN batched_trans_tbl AS bt 
	USING(batch_no)
	WHERE btrql.sender = inSender
	AND bt.batch_status = 'approved';
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for getTransacInfoBybatchNum
-- ----------------------------
DROP PROCEDURE IF EXISTS `getTransacInfoBybatchNum`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getTransacInfoBybatchNum`(IN `iNbatchno` VARCHAR(20))
BEGIN
	SELECT
    usr.user_profilepath AS 'senderpic',
    DATE_FORMAT(bt.date_sent, '%b. %d, %Y %l:%i %p') AS 'date_sent',
    CONCAT(usr.user_fname,' ',usr.user_lname) AS 'sender_name',
    usr.user_email 	 AS 'sender_email',
    vt.id 	     AS 'trans_id',
    vt.trans_no  AS 'trans_no',
    bt.batch_id  AS 'batch_id',
    bt.batch_no  AS 'batch_no',
	vt.va_lname  AS 'lname',
    vt.va_fname  AS 'fname',
    vt.va_gender AS	'gender',
    DATE_FORMAT(vt.va_dob, '%b. %d, %Y') AS 'dob',
    vt.va_passportnum AS 'passportnum',
    vt.attached_passport AS 'passport_pic',
    DATE_FORMAT(bt.arrival, '%b. %d, %Y') AS 'arrival',
    bt.via		AS 'via',
    bt.flight_or_voyagenum AS 'fov',
    bt.port_of_entry AS 'poe',
    vt.attached_eticket AS 'eticket_pic',
    bt.travel_type AS 'travel_type',
    vt.trans_status AS 'trans_stat'
    
	FROM visatransactions_tbl AS vt
	INNER JOIN batched_trans_tbl AS bt
	USING(batch_no)
	INNER JOIN user_tbl AS usr
	ON bt.batch_sender = usr.user_id
	WHERE vt.batch_no = iNbatchno;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for transacInfo
-- ----------------------------
DROP PROCEDURE IF EXISTS `transacInfo`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `transacInfo`(IN `inTransno` VARCHAR(45))
BEGIN
	SELECT
    usr.user_profilepath AS 'senderpic',
    DATE_FORMAT(bt.date_sent, '%b. %d, %Y %l:%i %p') AS 'date_sent',
    CONCAT(usr.user_fname,' ',usr.user_lname) AS 'sender_name',
    usr.user_email 	 AS 'sender_email',
    vt.id 	     AS 'trans_id',
    vt.trans_no  AS 'trans_no',
    bt.batch_id  AS 'batch_id',
    bt.batch_no  AS 'batch_no',
	vt.va_lname  AS 'lname',
    vt.va_fname  AS 'fname',
    vt.va_gender AS	'gender',
    vt.va_dob 	 AS 'dob',
    vt.va_passportnum AS 'passportnum',
    vt.attached_passport AS 'passport_pic',
    bt.arrival 	AS 'arrival',
    bt.via		AS 'via',
    bt.flight_or_voyagenum AS 'fov',
    bt.port_of_entry AS 'poe',
    
    vt.trans_status 	AS 'status'
    
	FROM visatransactions_tbl AS vt
	INNER JOIN batched_trans_tbl AS bt
	USING(batch_no)
	INNER JOIN user_tbl AS usr
	ON bt.batch_sender = usr.user_id
	WHERE trans_no = inTransno;
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
