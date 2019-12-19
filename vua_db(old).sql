-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2018 at 04:27 PM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vua_db`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `agentDraft` (IN `agentId` INT)  BEGIN
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

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `agentRightBar` (IN `inSender` INT)  BEGIN
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
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getTransacInfoBybatchNum` (IN `iNbatchno` VARCHAR(20))  BEGIN
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
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `transacInfo` (IN `inTransno` VARCHAR(45))  BEGIN
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
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `agent_sentbatch`
-- (See below for the actual view)
--
CREATE TABLE `agent_sentbatch` (
`batch_id` int(11)
,`batch_no` varchar(20)
,`sender` varchar(90)
,`date_sent` varchar(51)
,`batch_status` enum('complete','incomplete','processed','approved')
,`sender_id` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `approved_rql`
--

CREATE TABLE `approved_rql` (
  `id` int(11) NOT NULL,
  `rql_id` int(11) DEFAULT NULL,
  `date_approved` date DEFAULT NULL,
  `filepath_approved_confirmationrql` varchar(2000) DEFAULT NULL,
  `approved_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `approved_rql`
--

INSERT INTO `approved_rql` (`id`, `rql_id`, `date_approved`, `filepath_approved_confirmationrql`, `approved_id`) VALUES
(2, 4, '2018-03-14', '15210104770chenchen.jpg/15210104771eticket.png', 1),
(3, 5, '2018-03-20', '15215276690img_0871.jpg/15215276691img_0872.jpg/15215276692img_0876.jpg', 1),
(4, 17, '2018-03-20', '15215296630img_0875.jpg/15215296631img_0876.jpg/15215296632img_0877.jpg', 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `approved_view`
-- (See below for the actual view)
--
CREATE TABLE `approved_view` (
`rql_id` int(11)
,`batch_no` varchar(20)
,`letter_date` varchar(42)
,`arrival` varchar(42)
,`fov` varchar(45)
,`created_by` varchar(90)
,`date_generated` varchar(42)
,`iso_date` varchar(10)
);

-- --------------------------------------------------------

--
-- Table structure for table `batchedrequest_log_tbl`
--

CREATE TABLE `batchedrequest_log_tbl` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `batch_no` varchar(20) DEFAULT NULL,
  `batchrequest_stat` enum('new','read') DEFAULT NULL,
  `date_sentlogs` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `batchedrequest_log_tbl`
--

INSERT INTO `batchedrequest_log_tbl` (`id`, `sender_id`, `batch_no`, `batchrequest_stat`, `date_sentlogs`) VALUES
(13, 1, 'batch-1', 'read', '2018-03-14 06:43:59'),
(14, 1, 'batch-14', 'read', '2018-03-14 06:59:36'),
(15, 1, 'batch-15', 'read', '2018-03-20 02:14:37'),
(16, 1, 'batch-16', 'read', '2018-03-20 01:38:58'),
(17, 1, 'batch-17', 'read', '2018-03-20 02:49:20'),
(18, 1, 'batch-18', 'read', '2018-03-20 04:44:18'),
(19, 1, 'batch-19', 'read', '2018-03-20 05:04:24'),
(20, 1, 'batch-20', 'read', '2018-03-20 06:10:00'),
(21, 1, 'batch-21', 'read', '2018-03-20 06:16:52'),
(22, 1, 'batch-22', 'read', '2018-03-20 06:56:38'),
(23, 1, 'batch-23', 'read', '2018-03-20 06:59:37'),
(24, 1, 'batch-24', 'new', '2018-03-20 08:12:22');

-- --------------------------------------------------------

--
-- Table structure for table `batched_trans_tbl`
--

CREATE TABLE `batched_trans_tbl` (
  `batch_id` int(11) NOT NULL,
  `batch_no` varchar(20) DEFAULT 'batch-0',
  `batch_status` enum('complete','incomplete','processed','approved') DEFAULT 'incomplete',
  `manager_id` int(11) DEFAULT '0',
  `arrival` date DEFAULT NULL,
  `travel_type` varchar(50) DEFAULT NULL,
  `via` varchar(45) DEFAULT NULL,
  `flight_or_voyagenum` varchar(45) DEFAULT NULL,
  `port_of_entry` varchar(500) DEFAULT 'none',
  `attached_eticket` varchar(2000) DEFAULT NULL,
  `batch_sender` int(11) DEFAULT NULL,
  `date_sent` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `batched_trans_tbl`
--

INSERT INTO `batched_trans_tbl` (`batch_id`, `batch_no`, `batch_status`, `manager_id`, `arrival`, `travel_type`, `via`, `flight_or_voyagenum`, `port_of_entry`, `attached_eticket`, `batch_sender`, `date_sent`) VALUES
(13, 'batch-1', 'approved', 1, '2018-03-14', 'airplane', 'xaiamneed', '6515ib', 'jhvtf', 'uploads/01521009714airplane03142018xaiamneed6515ibjhvtf_eticket.docx', 1, '2018-03-14 06:41:54'),
(14, 'batch-14', 'approved', 1, '2018-03-14', 'cruise', 'dsada', 'dsadad', 'dsada', 'uploads/01521010776airplane03142018dsadadsadaddsada_eticket.docx', 1, '2018-03-14 06:59:36'),
(15, 'batch-15', 'processed', 0, '2018-03-20', 'airplane', 'Cebu Pacific', 'M42tgeagwg', 'Cebu international Airport', 'uploads/01521509873airplane03202018cebupacificm42tgeagwgcebuinternationalairport_eticket.pdf&uploads/11521509873airplane03202018cebupacificm42tgeagwgcebuinternationalairport_eticket.docx', 1, '2018-03-20 01:37:53'),
(16, 'batch-16', 'processed', 0, '2018-03-23', 'cruise', 'Sea Voyage', 'MVPrincess', 'Caticlan', 'uploads/01521509938cruise03232018seavoyagemvprincesscaticlan_eticket.pdf&uploads/11521509938cruise03232018seavoyagemvprincesscaticlan_eticket.docx&uploads/21521509938cruise03232018seavoyagemvprincesscaticlan_eticket.docx', 1, '2018-03-20 01:38:58'),
(17, 'batch-17', 'processed', 0, '2018-03-20', 'cruise', 'fafaf', 'aafaf', 'szafsadgsdg', 'uploads/01521513842cruise03202018fafafaafafszafsadgsdg_eticket.docx&uploads/11521513842cruise03202018fafafaafafszafsadgsdg_eticket.pdf', 1, '2018-03-20 02:44:02'),
(18, 'batch-18', 'processed', 0, '2018-03-20', 'airplane', 'dsgsdg', 'sdgsg', 'safgsfh', 'uploads/01521514423airplane03202018dsgsdgsdgsgsafgsfh_eticket.pdf', 1, '2018-03-20 02:53:43'),
(19, 'batch-19', 'processed', 0, '2018-03-20', 'cruise', 'sample', 'jjudfj', 'mactan bay', 'uploads/01521522030cruise03202018samplejjudfjmactanbay_eticket.docx', 1, '2018-03-20 05:00:30'),
(20, 'batch-20', 'processed', 0, '2018-03-20', 'cruise', 'gaga', 'gasg', 'asgsag', 'uploads/01521525877cruise03202018gagagasgasgsag_eticket.docx&uploads/11521525877cruise03202018gagagasgasgsag_eticket.pdf', 1, '2018-03-20 06:04:37'),
(21, 'batch-21', 'processed', 0, '2018-03-20', 'cruise', 'asgsaga', 'asgsag', 'sgsgs', 'uploads/01521526612cruise03202018asgsagaasgsagsgsgs_eticket.docx', 1, '2018-03-20 06:16:52'),
(22, 'batch-22', 'processed', 0, '2018-03-20', 'airplane', 'Xiamen', 'XIAnsjsj', 'Manila International Airport', 'uploads/01521528998airplane03202018xiamenxiansjsjmanilainternationalairport_eticket.docx', 1, '2018-03-20 06:56:38'),
(23, 'batch-23', 'approved', 1, '2018-03-31', 'cruise', 'Port of the sea', 'MVprincecharles', 'Kalibo international Airport', 'uploads/01521529177cruise03312018portoftheseamvprincecharleskalibointernationalairport_eticket.pdf&uploads/11521529177cruise03312018portoftheseamvprincecharleskalibointernationalairport_eticket.docx', 1, '2018-03-20 06:59:37'),
(24, 'batch-24', 'incomplete', 0, '2018-03-20', 'airplane', 'asdgsadg', 'asdgsaghsa', 'ahahdah', 'uploads/01521533542airplane03202018asdgsadgasdgsaghsaahahdah_eticket.docx', 1, '2018-03-20 08:12:22');

-- --------------------------------------------------------

--
-- Stand-in structure for view `batchrec_view`
-- (See below for the actual view)
--
CREATE TABLE `batchrec_view` (
`batch_id` int(11)
,`batch_no` varchar(20)
,`sender` varchar(91)
,`date_sent` varchar(51)
,`batch_status` enum('complete','incomplete','processed','approved')
,`sender_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `batchrql_view`
-- (See below for the actual view)
--
CREATE TABLE `batchrql_view` (
`batch_no` varchar(20)
,`date_sent` varchar(51)
,`profile_pic` varchar(500)
,`sender` varchar(90)
,`status` varchar(4)
,`batch_status` enum('complete','incomplete','processed','approved')
,`sender_id` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `boi_tbl`
--

CREATE TABLE `boi_tbl` (
  `boiprofile_id` int(11) NOT NULL,
  `current_commisioner` varchar(100) DEFAULT NULL,
  `department` varchar(200) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `boi_tbl`
--

INSERT INTO `boi_tbl` (`boiprofile_id`, `current_commisioner`, `department`, `address`) VALUES
(1, 'Hon. Jaime H. Morente', 'Bureau of Immigration', 'Magallanes Drive, Intramuros'),
(2, 'Hon. Sample2', 'Sample Bureu', 'Sample BureuAddress');

-- --------------------------------------------------------

--
-- Table structure for table `created_requestletter`
--

CREATE TABLE `created_requestletter` (
  `requestletter_id` int(11) NOT NULL,
  `batch_no` varchar(20) DEFAULT NULL,
  `rq_to` int(11) DEFAULT NULL,
  `letter_date` date DEFAULT NULL,
  `assignatory` int(11) DEFAULT NULL,
  `rq_status` enum('saved','printed','approved') DEFAULT 'saved',
  `created_by` int(11) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `created_requestletter`
--

INSERT INTO `created_requestletter` (`requestletter_id`, `batch_no`, `rq_to`, `letter_date`, `assignatory`, `rq_status`, `created_by`, `date_created`) VALUES
(4, 'batch-1', 2, '2018-03-05', 3, 'approved', 1, '2018-03-14 06:45:19'),
(5, 'batch-14', 1, '2018-03-14', 1, 'approved', 1, '2018-03-14 07:17:38'),
(6, 'batch-15', 1, '2018-03-30', 3, 'printed', 1, '2018-03-20 02:19:56'),
(7, 'batch-15', 1, '2018-03-23', 1, 'printed', 1, '2018-03-20 02:22:08'),
(8, 'batch-16', 1, '2018-03-20', 1, 'printed', 1, '2018-03-20 02:21:51'),
(9, 'batch-17', 1, '2018-03-20', 1, 'printed', 1, '2018-03-20 02:50:10'),
(10, 'batch-18', 1, '2018-03-20', 1, 'printed', 1, '2018-03-20 04:53:14'),
(11, 'batch-19', 1, '2018-03-20', 1, 'printed', 1, '2018-03-20 05:27:07'),
(12, 'batch-19', 2, '2018-03-19', 3, 'printed', 1, '2018-03-20 05:28:47'),
(13, 'batch-19', 1, '2018-03-15', 1, 'printed', 1, '2018-03-20 05:29:25'),
(14, 'batch-20', 1, '2018-03-20', 3, 'printed', 1, '2018-03-20 06:10:21'),
(15, 'batch-21', 1, '2018-03-20', 1, 'printed', 1, '2018-03-20 06:18:22'),
(16, 'batch-22', 1, '2018-03-20', 1, 'printed', 1, '2018-03-20 07:06:16'),
(17, 'batch-23', 1, '2018-03-20', 1, 'approved', 1, '2018-03-20 07:06:28');

-- --------------------------------------------------------

--
-- Stand-in structure for view `draft_rq`
-- (See below for the actual view)
--
CREATE TABLE `draft_rq` (
`rq_num` int(11)
,`rq_batchnum` varchar(20)
,`letter_date` varchar(73)
,`arrival` varchar(42)
,`fov` varchar(45)
,`created_by` varchar(91)
,`last_saved` varchar(51)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `inbox_view`
-- (See below for the actual view)
--
CREATE TABLE `inbox_view` (
`trans_id` int(11)
,`batch_id` int(11)
,`batch_no` varchar(20)
,`arrival` varchar(42)
,`trans_no` varchar(45)
,`full_name` varchar(101)
,`gender` varchar(10)
,`passport` varchar(45)
,`fov_num` varchar(45)
,`trans_status` varchar(15)
,`sender` varchar(90)
,`date_sent` varchar(51)
,`sender_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `inprocess_view`
-- (See below for the actual view)
--
CREATE TABLE `inprocess_view` (
`rql_id` int(11)
,`batch_no` varchar(20)
,`letter_date` varchar(42)
,`arrival` varchar(42)
,`fov` varchar(45)
,`created_by` varchar(90)
,`date_generated` varchar(42)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `junked_view`
-- (See below for the actual view)
--
CREATE TABLE `junked_view` (
`trans_no` varchar(45)
,`fullname` varchar(100)
,`gender` varchar(10)
,`dob` varchar(42)
,`passport` varchar(45)
,`fov` varchar(45)
,`arrival` varchar(42)
,`date_created` varchar(51)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `rqlprinted_view`
-- (See below for the actual view)
--
CREATE TABLE `rqlprinted_view` (
`rqlid` int(11)
,`batchnum` varchar(20)
,`letter_date` varchar(42)
,`arrival_date` varchar(42)
,`fov` varchar(45)
,`created_by` varchar(90)
,`date_created` varchar(10)
);

-- --------------------------------------------------------

--
-- Table structure for table `rq_assignatory_tbl`
--

CREATE TABLE `rq_assignatory_tbl` (
  `assignatory_id` int(11) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `req_position` varchar(322) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rq_assignatory_tbl`
--

INSERT INTO `rq_assignatory_tbl` (`assignatory_id`, `fullname`, `req_position`) VALUES
(1, 'Wilson Techico ', 'Vice President on Business & Product Development'),
(3, 'Wilson Ang', 'Chief Operating Officer');

-- --------------------------------------------------------

--
-- Table structure for table `transremarks_tbl`
--

CREATE TABLE `transremarks_tbl` (
  `trans_rmkid` int(11) NOT NULL,
  `trans_no` varchar(45) DEFAULT NULL,
  `remarks_by` int(11) DEFAULT NULL,
  `remarks_type` varchar(45) DEFAULT NULL,
  `description` varchar(999) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transremarks_tbl`
--

INSERT INTO `transremarks_tbl` (`trans_rmkid`, `trans_no`, `remarks_by`, `remarks_type`, `description`, `date_created`) VALUES
(58, 'trans-1', 1, 'DRAFT', 'DRAFTED', '2018-03-14 06:35:10'),
(59, 'trans-21', 1, 'DRAFT', 'DRAFTED', '2018-03-14 06:35:32'),
(60, 'trans-22', 1, 'DRAFT', 'DRAFTED', '2018-03-14 06:35:53'),
(61, 'trans-22', 1, 'PENDING', 'PENDING', '2018-03-14 06:41:54'),
(62, 'trans-21', 1, 'PENDING', 'PENDING', '2018-03-14 06:41:54'),
(63, 'trans-1', 1, 'PENDING', 'PENDING', '2018-03-14 06:41:54'),
(64, 'trans-21', 1, 'VERIFIED', 'VERIFIED', '2018-03-14 06:43:06'),
(65, 'trans-1', 1, 'VERIFIED', 'VERIFIED', '2018-03-14 06:43:20'),
(66, 'trans-22', 1, 'VERIFIED', 'VERIFIED', '2018-03-14 06:43:39'),
(67, 'trans-23', 1, 'DRAFT', 'DRAFTED', '2018-03-14 06:59:19'),
(68, 'trans-23', 1, 'PENDING', 'PENDING', '2018-03-14 06:59:36'),
(69, 'trans-23', 1, 'VERIFIED', 'VERIFIED', '2018-03-14 06:59:48'),
(70, 'trans-24', 1, 'DRAFT', 'DRAFTED', '2018-03-20 00:44:27'),
(71, 'trans-25', 1, 'DRAFT', 'DRAFTED', '2018-03-20 00:57:29'),
(72, 'trans-26', 1, 'DRAFT', 'DRAFTED', '2018-03-20 01:33:33'),
(73, 'trans-27', 1, 'DRAFT', 'DRAFTED', '2018-03-20 01:34:49'),
(74, 'trans-28', 1, 'DRAFT', 'DRAFTED', '2018-03-20 01:35:43'),
(75, 'trans-29', 1, 'DRAFT', 'DRAFTED', '2018-03-20 01:36:22'),
(76, 'trans-26', 1, 'PENDING', 'PENDING', '2018-03-20 01:37:53'),
(77, 'trans-25', 1, 'PENDING', 'PENDING', '2018-03-20 01:37:53'),
(78, 'trans-29', 1, 'PENDING', 'PENDING', '2018-03-20 01:38:58'),
(79, 'trans-28', 1, 'PENDING', 'PENDING', '2018-03-20 01:38:58'),
(80, 'trans-27', 1, 'PENDING', 'PENDING', '2018-03-20 01:38:59'),
(81, 'trans-24', 1, 'PENDING', 'PENDING', '2018-03-20 01:38:59'),
(82, 'trans-25', 1, 'VERIFIED', 'VERIFIED', '2018-03-20 01:39:38'),
(83, 'trans-26', 1, 'VERIFIED', 'VERIFIED', '2018-03-20 01:39:50'),
(84, 'trans-30', 1, 'DRAFT', 'DRAFTED', '2018-03-20 01:50:13'),
(85, 'trans-24', 1, 'VERIFIED', 'VERIFIED', '2018-03-20 01:51:29'),
(86, 'trans-27', 1, 'VERIFIED', 'VERIFIED', '2018-03-20 01:53:20'),
(87, 'trans-28', 1, 'VERIFIED', 'VERIFIED', '2018-03-20 01:53:27'),
(88, 'trans-29', 1, 'VERIFIED', 'VERIFIED', '2018-03-20 01:53:33'),
(89, 'trans-30', 1, 'PENDING', 'PENDING', '2018-03-20 02:44:02'),
(90, 'trans-30', 1, 'VERIFIED', 'VERIFIED', '2018-03-20 02:46:13'),
(91, 'trans-31', 1, 'DRAFT', 'DRAFTED', '2018-03-20 02:52:09'),
(92, 'trans-31', 1, 'PENDING', 'PENDING', '2018-03-20 02:53:43'),
(93, 'trans-31', 1, 'VERIFIED', 'VERIFIED', '2018-03-20 02:55:11'),
(94, 'trans-32', 1, 'DRAFT', 'DRAFTED', '2018-03-20 04:58:11'),
(95, 'trans-32', 1, 'PENDING', 'PENDING', '2018-03-20 05:00:30'),
(96, 'trans-32', 1, 'VERIFIED', 'VERIFIED', '2018-03-20 05:03:01'),
(97, 'trans-33', 1, 'DRAFT', 'DRAFTED', '2018-03-20 05:12:28'),
(98, 'trans-34', 1, 'DRAFT', 'DRAFTED', '2018-03-20 06:04:16'),
(99, 'trans-34', 1, 'PENDING', 'PENDING', '2018-03-20 06:04:37'),
(100, 'trans-33', 1, 'PENDING', 'PENDING', '2018-03-20 06:04:37'),
(101, 'trans-33', 1, 'VERIFIED', 'VERIFIED', '2018-03-20 06:07:58'),
(102, 'trans-34', 1, 'VERIFIED', 'VERIFIED', '2018-03-20 06:08:25'),
(103, 'trans-35', 1, 'DRAFT', 'DRAFTED', '2018-03-20 06:16:38'),
(104, 'trans-35', 1, 'PENDING', 'PENDING', '2018-03-20 06:16:52'),
(105, 'trans-35', 1, 'VERIFIED', 'VERIFIED', '2018-03-20 06:17:01'),
(106, 'trans-36', 1, 'DRAFT', 'DRAFTED', '2018-03-20 06:42:56'),
(107, 'trans-37', 1, 'DRAFT', 'DRAFTED', '2018-03-20 06:43:17'),
(108, 'trans-38', 1, 'DRAFT', 'DRAFTED', '2018-03-20 06:43:41'),
(109, 'trans-39', 1, 'DRAFT', 'DRAFTED', '2018-03-20 06:44:47'),
(110, 'trans-40', 1, 'DRAFT', 'DRAFTED', '2018-03-20 06:45:08'),
(111, 'trans-41', 1, 'DRAFT', 'DRAFTED', '2018-03-20 06:46:13'),
(112, 'trans-36', 1, '', '', '2018-03-20 06:50:53'),
(113, 'trans-37', 1, 'PENDING', 'PENDING', '2018-03-20 06:56:38'),
(114, 'trans-36', 1, 'PENDING', 'PENDING', '2018-03-20 06:56:38'),
(115, 'trans-41', 1, 'PENDING', 'PENDING', '2018-03-20 06:59:37'),
(116, 'trans-40', 1, 'PENDING', 'PENDING', '2018-03-20 06:59:37'),
(117, 'trans-39', 1, 'PENDING', 'PENDING', '2018-03-20 06:59:38'),
(118, 'trans-38', 1, 'PENDING', 'PENDING', '2018-03-20 06:59:38'),
(119, 'trans-36', 1, 'VERIFIED', 'VERIFIED', '2018-03-20 06:59:48'),
(120, 'trans-37', 1, 'VERIFIED', 'VERIFIED', '2018-03-20 06:59:59'),
(121, 'trans-38', 1, 'VERIFIED', 'VERIFIED', '2018-03-20 07:02:59'),
(122, 'trans-39', 1, 'VERIFIED', 'VERIFIED', '2018-03-20 07:03:13'),
(123, 'trans-40', 1, 'VERIFIED', 'VERIFIED', '2018-03-20 07:03:24'),
(124, 'trans-41', 1, 'VERIFIED', 'VERIFIED', '2018-03-20 07:03:31'),
(125, 'trans-42', 3, 'DRAFT', 'DRAFTED', '2018-03-20 07:07:38'),
(126, 'trans-43', 3, 'DRAFT', 'DRAFTED', '2018-03-20 07:08:11'),
(127, 'trans-44', 1, 'DRAFT', 'DRAFTED', '2018-03-20 08:11:28'),
(128, 'trans-44', 1, 'PENDING', 'PENDING', '2018-03-20 08:12:22');

-- --------------------------------------------------------

--
-- Table structure for table `uni_tbl`
--

CREATE TABLE `uni_tbl` (
  `company_profile_id` int(11) NOT NULL,
  `uni_name` varchar(200) DEFAULT NULL,
  `uni_addr` varchar(500) DEFAULT NULL,
  `uni_email` varchar(100) DEFAULT NULL,
  `uni_tel` varchar(50) DEFAULT NULL,
  `uni_website` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uni_tbl`
--

INSERT INTO `uni_tbl` (`company_profile_id`, `uni_name`, `uni_addr`, `uni_email`, `uni_tel`, `uni_website`) VALUES
(1, 'Uni Orient Travel, Inc.', 'Suite 2006A, Philippine Stock Exchange Center, 5 Pasig City,Metro Manila Philippines 1605', 'markramilo@uniorient.net', '+63-2-705-2222', 'http://www.uniorient.com/');

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(200) DEFAULT NULL,
  `user_pass` varchar(50) DEFAULT 'uni000',
  `user_status` varchar(45) DEFAULT 'active',
  `user_type` varchar(10) DEFAULT NULL,
  `user_lname` varchar(45) DEFAULT NULL,
  `user_fname` varchar(45) DEFAULT NULL,
  `user_branch` varchar(45) DEFAULT NULL,
  `user_profilepath` varchar(500) DEFAULT 'uploads/default.png',
  `created_by` int(11) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`user_id`, `user_email`, `user_pass`, `user_status`, `user_type`, `user_lname`, `user_fname`, `user_branch`, `user_profilepath`, `created_by`, `date_created`) VALUES
(1, 'admin@gmail.com', '03sFmWJzxnVP.', 'active', 'admin', 'samplex', 'sample ', 'binondo', 'uploads/default.png', 0, '2018-02-05 01:04:09'),
(2, 'frank@gmail.com', '03HsKggu1Celk', 'active', 'manager', 'Corpuz', 'Frank', 'binondo', 'uploads/default.png', 1, '2018-03-08 07:51:51'),
(3, 'john@gmail.com', '03HsKggu1Celk', 'active', 'agent', 'bardinas', 'john', 'china', 'uploads/default.png', 1, '2018-03-09 05:15:28');

-- --------------------------------------------------------

--
-- Table structure for table `verifying_visatransac_tbl`
--

CREATE TABLE `verifying_visatransac_tbl` (
  `id` int(11) NOT NULL,
  `trans_no` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `verified_by` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `date_verified` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `verifying_visatransac_tbl`
--

INSERT INTO `verifying_visatransac_tbl` (`id`, `trans_no`, `verified_by`, `date_verified`) VALUES
(14, 'trans-21', '1', '2018-03-14 06:43:06'),
(15, 'trans-1', '1', '2018-03-14 06:43:20'),
(16, 'trans-22', '1', '2018-03-14 06:43:39'),
(17, 'trans-23', '1', '2018-03-14 06:59:48'),
(18, 'trans-25', '1', '2018-03-20 01:39:38'),
(19, 'trans-26', '1', '2018-03-20 01:39:50'),
(20, 'trans-24', '1', '2018-03-20 01:51:29'),
(21, 'trans-27', '1', '2018-03-20 01:53:20'),
(22, 'trans-28', '1', '2018-03-20 01:53:27'),
(23, 'trans-29', '1', '2018-03-20 01:53:33'),
(24, 'trans-30', '1', '2018-03-20 02:46:13'),
(25, 'trans-31', '1', '2018-03-20 02:55:11'),
(26, 'trans-32', '1', '2018-03-20 05:03:01'),
(27, 'trans-33', '1', '2018-03-20 06:07:58'),
(28, 'trans-34', '1', '2018-03-20 06:08:25'),
(29, 'trans-35', '1', '2018-03-20 06:17:01'),
(30, 'trans-36', '1', '2018-03-20 06:59:48'),
(31, 'trans-37', '1', '2018-03-20 06:59:59'),
(32, 'trans-38', '1', '2018-03-20 07:02:59'),
(33, 'trans-39', '1', '2018-03-20 07:03:13'),
(34, 'trans-40', '1', '2018-03-20 07:03:24'),
(35, 'trans-41', '1', '2018-03-20 07:03:31');

-- --------------------------------------------------------

--
-- Table structure for table `visatransactions_tbl`
--

CREATE TABLE `visatransactions_tbl` (
  `id` int(11) NOT NULL,
  `trans_no` varchar(45) NOT NULL DEFAULT 'trans-0',
  `batch_no` varchar(20) DEFAULT 'none',
  `va_lname` varchar(50) DEFAULT NULL,
  `va_fname` varchar(50) DEFAULT NULL,
  `va_dob` date DEFAULT NULL,
  `va_gender` varchar(10) DEFAULT NULL,
  `va_passportnum` varchar(45) DEFAULT NULL,
  `trans_status` varchar(15) DEFAULT 'draft',
  `attached_passport` varchar(100) DEFAULT 'uploads/passport.png',
  `stampped_passport` varchar(100) DEFAULT 'uploads/passport.png',
  `created_by` int(11) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `visatransactions_tbl`
--

INSERT INTO `visatransactions_tbl` (`id`, `trans_no`, `batch_no`, `va_lname`, `va_fname`, `va_dob`, `va_gender`, `va_passportnum`, `trans_status`, `attached_passport`, `stampped_passport`, `created_by`, `date_created`) VALUES
(20, 'trans-1', 'batch-1', 'bardinas', 'john lito', '2018-03-13', 'M', '32asd', 'APPROVED', 'uploads/1521009310bardinasjohnlito20180313_passport.jpg', 'uploads/koala.jpg', 1, '2018-03-14 06:35:10'),
(21, 'trans-21', 'batch-1', 'corpuz', 'frank', '2018-03-12', 'M', 'szd324', 'APPROVED', 'uploads/1521009332corpuzfrank20180312_passport.jpg', 'uploads/sample_passport.jpg', 1, '2018-03-14 06:35:32'),
(22, 'trans-22', 'batch-1', 'melvin', 'gonzales', '2018-03-14', 'M', 'dsada', 'APPROVED', 'uploads/1521009353melvingonzales20180314_passport.jpg', 'uploads/sample_passport.jpg', 1, '2018-03-14 06:35:53'),
(23, 'trans-23', 'batch-14', 'm ', 'Zhayt', '2018-03-13', 'M', 'dasd32', 'APPROVED', 'uploads/1521010759mZhayt20180313_passport.jpg', 'uploads/img_0872.jpg', 1, '2018-03-14 06:59:19'),
(24, 'trans-24', 'batch-16', 'Hanabishi', 'Recca', '2018-03-20', 'M', '02241191', 'PROCESSED', 'uploads/1521506667HanabishiRecca20180320_passport.jpg', 'uploads/passport.png', 1, '2018-03-20 00:44:27'),
(25, 'trans-25', 'batch-15', 'dsada', 'dasda', '2018-03-20', 'M', 'dada', 'PROCESSED', 'uploads/1521509596dsadadasda20180320_passport.jpg', 'uploads/passport.png', 1, '2018-03-20 00:57:29'),
(26, 'trans-26', 'batch-15', 's', 'sg', '2018-03-20', 'M', 'sgasg', 'PROCESSED', 'uploads/1521509613ssg20180320_passport.jpg', 'uploads/passport.png', 1, '2018-03-20 01:33:33'),
(27, 'trans-27', 'batch-16', 'Dummonssss', 'Maxxessss', '1991-02-24', 'F', 'sagsags', 'PROCESSED', 'uploads/1521509689DummonMaxx19910224_passport.jpg', 'uploads/passport.png', 1, '2018-03-20 01:34:49'),
(28, 'trans-28', 'batch-16', 'Yanagi', 'Anna', '1991-04-21', 'M', 'asdfsdfdsf', 'PROCESSED', 'uploads/1521509743YanagiAnna19910421_passport.jpg', 'uploads/passport.png', 1, '2018-03-20 01:35:43'),
(29, 'trans-29', 'batch-16', 'Kirisawa', 'Aira', '1992-12-24', 'M', '35235235', 'PROCESSED', 'uploads/1521509782KirisawaAira19921224_passport.jpg', 'uploads/passport.png', 1, '2018-03-20 01:36:22'),
(30, 'trans-30', 'batch-17', 'Yes', 'Yes', '2018-03-20', 'M', '25235', 'PROCESSED', 'uploads/1521510613YesYes20180320_passport.jpg', 'uploads/passport.png', 1, '2018-03-20 01:50:13'),
(31, 'trans-31', 'batch-18', 'eryery', 'etyey', '2018-03-20', 'M', 'eyey', 'PROCESSED', 'uploads/1521514328eryeryetyey20180320_passport.jpg', 'uploads/passport.png', 1, '2018-03-20 02:52:09'),
(32, 'trans-32', 'batch-19', 'chen', 'chen', '2018-03-20', 'M', 'dasdada', 'PROCESSED', 'uploads/1521521891chenchen20180320_passport.jpg', 'uploads/passport.png', 1, '2018-03-20 04:58:11'),
(33, 'trans-33', 'batch-20', 'dgasg', 'sgsa', '2018-03-20', 'M', 'sadgsg', 'PROCESSED', 'uploads/1521522748dgasgsgsa20180320_passport.jpg', 'uploads/passport.png', 1, '2018-03-20 05:12:28'),
(34, 'trans-34', 'batch-20', 'Asuncion', 'RJ', '2018-03-22', 'M', '123523525', 'PROCESSED', 'uploads/1521525856AsuncionRJ20180322_passport.jpg', 'uploads/passport.png', 1, '2018-03-20 06:04:16'),
(35, 'trans-35', 'batch-21', 'Bugtong ', 'Mikay', '2018-03-23', 'M', '2525252', 'PROCESSED', 'uploads/1521526598BugtongMikay20180323_passport.jpg', 'uploads/passport.png', 1, '2018-03-20 06:16:38'),
(36, 'trans-36', 'batch-22', 'Cariaga', 'Donna', '2018-02-13', 'M', '12412415', 'PROCESSED', 'uploads/1521528176CariagaDonna20180213_passport.jpg', 'uploads/passport.png', 1, '2018-03-20 06:42:56'),
(37, 'trans-37', 'batch-22', 'Cariaga', 'James', '2018-03-08', 'M', '15151515', 'PROCESSED', 'uploads/1521528197CariagaJames20180308_passport.jpg', 'uploads/passport.png', 1, '2018-03-20 06:43:17'),
(38, 'trans-38', 'batch-23', 'Uzumaki', 'Naruto', '2018-03-31', 'M', '23523523', 'APPROVED', 'uploads/1521528221UzumakiNaruto20180331_passport.jpg', 'uploads/img_0872.jpg', 1, '2018-03-20 06:43:41'),
(39, 'trans-39', 'batch-23', 'Uzumaki', 'Borutoss', '2018-03-06', 'M', 'sadgsag', 'APPROVED', 'uploads/1521528287UzumakiBoruto20180306_passport.jpg', 'uploads/img_0882.jpg', 1, '2018-03-20 06:44:47'),
(40, 'trans-40', 'batch-23', 'Uzumaki', 'Hinata', '2018-03-31', 'F', '236236236', 'APPROVED', 'uploads/1521528308UzumakiHinata20180331_passport.jpg', 'uploads/img_0877.jpg', 1, '2018-03-20 06:45:08'),
(41, 'trans-41', 'batch-23', 'Uzumaki', 'Himawari', '2018-03-29', 'F', '25235235', 'APPROVED', 'uploads/1521528373UzumakiHimawari20180329_passport.jpg', 'uploads/img_0880.jpg', 1, '2018-03-20 06:46:13'),
(42, 'trans-42', 'none', 'fsfs', 'fdsfs', '1966-12-15', 'M', 'fsf', 'draft', 'uploads/1521529658fsfsfdsfs20180320_passport.jpg', 'uploads/passport.png', 3, '2018-03-20 07:07:38'),
(43, 'trans-43', 'none', 'mars', 'bruno', '2018-03-20', 'F', '4tsdg45', 'draft', 'uploads/1521529691marsbruno20180320_passport.jpg', 'uploads/passport.png', 3, '2018-03-20 07:08:11'),
(44, 'trans-44', 'batch-24', 'asgsg', 'snaksng', '2018-03-22', 'M', 'sgsag', 'PENDING', 'uploads/1521533488asgsgsnaksng20180322_passport.jpg', 'uploads/passport.png', 1, '2018-03-20 08:11:28');

-- --------------------------------------------------------

--
-- Structure for view `agent_sentbatch`
--
DROP TABLE IF EXISTS `agent_sentbatch`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `agent_sentbatch`  AS  (select distinct `bt`.`batch_id` AS `batch_id`,`bt`.`batch_no` AS `batch_no`,concat(`usr`.`user_fname`,'',`usr`.`user_lname`) AS `sender`,date_format(`bt`.`date_sent`,'%b. %d, %Y %l:%i %p') AS `date_sent`,`bt`.`batch_status` AS `batch_status`,`bt`.`batch_sender` AS `sender_id` from ((`batched_trans_tbl` `bt` join `visatransactions_tbl` `vt` on((convert(`bt`.`batch_no` using utf8) = `vt`.`batch_no`))) join `user_tbl` `usr` on((`bt`.`batch_sender` = `usr`.`user_id`))) where (`bt`.`batch_status` in ('incomplete','complete','processed','approved'))) ;

-- --------------------------------------------------------

--
-- Structure for view `approved_view`
--
DROP TABLE IF EXISTS `approved_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `approved_view`  AS  (select `rql`.`requestletter_id` AS `rql_id`,`bt`.`batch_no` AS `batch_no`,date_format(`rql`.`letter_date`,'%b. %d, %Y') AS `letter_date`,date_format(`bt`.`arrival`,'%b. %d, %Y') AS `arrival`,ucase(`bt`.`flight_or_voyagenum`) AS `fov`,concat(`usr`.`user_fname`,'',`usr`.`user_lname`) AS `created_by`,date_format(`rql`.`date_created`,'%b. %d, %Y') AS `date_generated`,date_format(`rql`.`date_created`,'%Y-%m-%d') AS `iso_date` from ((`created_requestletter` `rql` join `batched_trans_tbl` `bt` on((`rql`.`batch_no` = `bt`.`batch_no`))) join `user_tbl` `usr` on((`rql`.`created_by` = `usr`.`user_id`))) where (`rql`.`rq_status` = 'approved')) ;

-- --------------------------------------------------------

--
-- Structure for view `batchrec_view`
--
DROP TABLE IF EXISTS `batchrec_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `batchrec_view`  AS  (select distinct `bt`.`batch_id` AS `batch_id`,`bt`.`batch_no` AS `batch_no`,concat(`usr`.`user_fname`,' ',`usr`.`user_lname`) AS `sender`,date_format(`bt`.`date_sent`,'%b. %d, %Y %l:%i %p') AS `date_sent`,`bt`.`batch_status` AS `batch_status`,`bt`.`batch_sender` AS `sender_id` from ((`batched_trans_tbl` `bt` join `visatransactions_tbl` `vt` on((convert(`bt`.`batch_no` using utf8) = `vt`.`batch_no`))) join `user_tbl` `usr` on((`bt`.`batch_sender` = `usr`.`user_id`))) where (`vt`.`trans_status` not in ('JUNKED','PROCESSED','APPROVED'))) ;

-- --------------------------------------------------------

--
-- Structure for view `batchrql_view`
--
DROP TABLE IF EXISTS `batchrql_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `batchrql_view`  AS  (select `btchlog`.`batch_no` AS `batch_no`,date_format(`btchlog`.`date_sentlogs`,'%b. %d, %Y %l:%i %p') AS `date_sent`,`usr`.`user_profilepath` AS `profile_pic`,lcase(concat(`usr`.`user_fname`,'',`usr`.`user_lname`)) AS `sender`,ucase(`btchlog`.`batchrequest_stat`) AS `status`,`bt`.`batch_status` AS `batch_status`,`btchlog`.`sender_id` AS `sender_id` from ((`batchedrequest_log_tbl` `btchlog` join `user_tbl` `usr` on((`btchlog`.`sender_id` = `usr`.`user_id`))) join `batched_trans_tbl` `bt` on((`btchlog`.`batch_no` = `bt`.`batch_no`))) where ((`btchlog`.`date_sentlogs` >= (cast(now() as date) - interval 7 day)) and (`bt`.`batch_status` in ('incomplete','complete','approved'))) order by `btchlog`.`date_sentlogs` desc) ;

-- --------------------------------------------------------

--
-- Structure for view `draft_rq`
--
DROP TABLE IF EXISTS `draft_rq`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `draft_rq`  AS  (select `cr`.`requestletter_id` AS `rq_num`,`cr`.`batch_no` AS `rq_batchnum`,date_format(`cr`.`letter_date`,'%M %d, %Y') AS `letter_date`,date_format(`batch`.`arrival`,'%b. %d, %Y') AS `arrival`,`batch`.`flight_or_voyagenum` AS `fov`,concat(`usr`.`user_fname`,' ',`usr`.`user_lname`) AS `created_by`,date_format(`cr`.`date_created`,'%b. %d, %Y %l:%i %p') AS `last_saved` from ((((`created_requestletter` `cr` join `batched_trans_tbl` `batch` on((`cr`.`batch_no` = `batch`.`batch_no`))) join `boi_tbl` `bt` on((`cr`.`rq_to` = `bt`.`boiprofile_id`))) join `rq_assignatory_tbl` `sg` on((`cr`.`assignatory` = `sg`.`assignatory_id`))) join `user_tbl` `usr` on((`cr`.`created_by` = `usr`.`user_id`))) where ((`cr`.`rq_status` <> 'printed') and (`cr`.`rq_status` <> 'approved'))) ;

-- --------------------------------------------------------

--
-- Structure for view `inbox_view`
--
DROP TABLE IF EXISTS `inbox_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `inbox_view`  AS  (select `vt`.`id` AS `trans_id`,`bt`.`batch_id` AS `batch_id`,`bt`.`batch_no` AS `batch_no`,date_format(`bt`.`arrival`,'%b. %d, %Y') AS `arrival`,`vt`.`trans_no` AS `trans_no`,lcase(concat(`vt`.`va_fname`,' ',`vt`.`va_lname`)) AS `full_name`,`vt`.`va_gender` AS `gender`,`vt`.`va_passportnum` AS `passport`,`bt`.`flight_or_voyagenum` AS `fov_num`,`vt`.`trans_status` AS `trans_status`,lcase(concat(`user`.`user_fname`,'',`user`.`user_lname`)) AS `sender`,date_format(`bt`.`date_sent`,'%b. %d, %Y %h:%i %p') AS `date_sent`,`user`.`user_id` AS `sender_id` from ((`visatransactions_tbl` `vt` join `batched_trans_tbl` `bt` on((`vt`.`batch_no` = convert(`bt`.`batch_no` using utf8)))) join `user_tbl` `user` on((`bt`.`batch_sender` = `user`.`user_id`))) where ((`vt`.`trans_status` = 'PENDING') or (`vt`.`trans_status` = 'VERIFIED')) order by `bt`.`date_sent`) ;

-- --------------------------------------------------------

--
-- Structure for view `inprocess_view`
--
DROP TABLE IF EXISTS `inprocess_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `inprocess_view`  AS  (select `rql`.`requestletter_id` AS `rql_id`,`bt`.`batch_no` AS `batch_no`,date_format(`rql`.`letter_date`,'%b. %d, %Y') AS `letter_date`,date_format(`bt`.`arrival`,'%b. %d, %Y') AS `arrival`,ucase(`bt`.`flight_or_voyagenum`) AS `fov`,concat(`usr`.`user_fname`,'',`usr`.`user_lname`) AS `created_by`,date_format(`rql`.`date_created`,'%b. %d, %Y') AS `date_generated` from ((`created_requestletter` `rql` join `batched_trans_tbl` `bt` on((`rql`.`batch_no` = `bt`.`batch_no`))) join `user_tbl` `usr` on((`rql`.`created_by` = `usr`.`user_id`))) where (`rql`.`rq_status` = 'printed')) ;

-- --------------------------------------------------------

--
-- Structure for view `junked_view`
--
DROP TABLE IF EXISTS `junked_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `junked_view`  AS  (select `vt`.`trans_no` AS `trans_no`,concat(`vt`.`va_fname`,'',`vt`.`va_lname`) AS `fullname`,`vt`.`va_gender` AS `gender`,date_format(`vt`.`va_dob`,'%b. %d, %Y') AS `dob`,ucase(`vt`.`va_passportnum`) AS `passport`,ucase(`bt`.`flight_or_voyagenum`) AS `fov`,date_format(`bt`.`arrival`,'%b. %d, %Y') AS `arrival`,date_format(`vt`.`date_created`,'%b. %d, %Y %h:%i %p') AS `date_created` from (`visatransactions_tbl` `vt` join `batched_trans_tbl` `bt` on((`vt`.`batch_no` = convert(`bt`.`batch_no` using utf8)))) where (`vt`.`trans_status` = 'JUNKED')) ;

-- --------------------------------------------------------

--
-- Structure for view `rqlprinted_view`
--
DROP TABLE IF EXISTS `rqlprinted_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `rqlprinted_view`  AS  (select `rql`.`requestletter_id` AS `rqlid`,`rql`.`batch_no` AS `batchnum`,date_format(`rql`.`letter_date`,'%b. %d, %Y') AS `letter_date`,date_format(`bt`.`arrival`,'%b. %d, %Y') AS `arrival_date`,ucase(`bt`.`flight_or_voyagenum`) AS `fov`,concat(`usr`.`user_fname`,'',`usr`.`user_lname`) AS `created_by`,date_format(`rql`.`date_created`,'%Y-%m-%d') AS `date_created` from ((`created_requestletter` `rql` left join `batched_trans_tbl` `bt` on((`rql`.`batch_no` = `bt`.`batch_no`))) left join `user_tbl` `usr` on((`rql`.`created_by` = `usr`.`user_id`))) where (`rql`.`rq_status` = 'printed') group by `rql`.`batch_no`) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approved_rql`
--
ALTER TABLE `approved_rql`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batchedrequest_log_tbl`
--
ALTER TABLE `batchedrequest_log_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batched_trans_tbl`
--
ALTER TABLE `batched_trans_tbl`
  ADD PRIMARY KEY (`batch_id`);

--
-- Indexes for table `boi_tbl`
--
ALTER TABLE `boi_tbl`
  ADD PRIMARY KEY (`boiprofile_id`);

--
-- Indexes for table `created_requestletter`
--
ALTER TABLE `created_requestletter`
  ADD PRIMARY KEY (`requestletter_id`);

--
-- Indexes for table `rq_assignatory_tbl`
--
ALTER TABLE `rq_assignatory_tbl`
  ADD PRIMARY KEY (`assignatory_id`);

--
-- Indexes for table `transremarks_tbl`
--
ALTER TABLE `transremarks_tbl`
  ADD PRIMARY KEY (`trans_rmkid`);

--
-- Indexes for table `uni_tbl`
--
ALTER TABLE `uni_tbl`
  ADD PRIMARY KEY (`company_profile_id`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `verifying_visatransac_tbl`
--
ALTER TABLE `verifying_visatransac_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visatransactions_tbl`
--
ALTER TABLE `visatransactions_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approved_rql`
--
ALTER TABLE `approved_rql`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `batchedrequest_log_tbl`
--
ALTER TABLE `batchedrequest_log_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `batched_trans_tbl`
--
ALTER TABLE `batched_trans_tbl`
  MODIFY `batch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `boi_tbl`
--
ALTER TABLE `boi_tbl`
  MODIFY `boiprofile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `created_requestletter`
--
ALTER TABLE `created_requestletter`
  MODIFY `requestletter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `rq_assignatory_tbl`
--
ALTER TABLE `rq_assignatory_tbl`
  MODIFY `assignatory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `transremarks_tbl`
--
ALTER TABLE `transremarks_tbl`
  MODIFY `trans_rmkid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;
--
-- AUTO_INCREMENT for table `uni_tbl`
--
ALTER TABLE `uni_tbl`
  MODIFY `company_profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `verifying_visatransac_tbl`
--
ALTER TABLE `verifying_visatransac_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `visatransactions_tbl`
--
ALTER TABLE `visatransactions_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
