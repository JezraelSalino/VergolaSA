-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2018 at 06:02 AM
-- Server version: 5.6.22
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vergola_quotedb_sa_v1`
--
CREATE DATABASE IF NOT EXISTS `vergola_quotedb_sa_v1` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `vergola_quotedb_sa_v1`;

-- --------------------------------------------------------

--
-- Table structure for table `accesslog`
--

DROP TABLE IF EXISTS `accesslog`;
CREATE TABLE IF NOT EXISTS `accesslog` (
`ID` int(11) NOT NULL,
  `AgentID` varchar(10) DEFAULT NULL,
  `AccessType` smallint(6) DEFAULT '0',
  `TodaysDate` datetime DEFAULT NULL,
  `TimeNow` datetime DEFAULT NULL,
  `Detail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `msyscompacterror`
--

DROP TABLE IF EXISTS `msyscompacterror`;
CREATE TABLE IF NOT EXISTS `msyscompacterror` (
  `ErrorCode` int(11) DEFAULT NULL,
  `ErrorDescription` longtext,
  `ErrorRecid` blob,
  `ErrorTable` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblactions`
--

DROP TABLE IF EXISTS `tblactions`;
CREATE TABLE IF NOT EXISTS `tblactions` (
`FID` int(11) NOT NULL,
  `Actions` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbladdrpts`
--

DROP TABLE IF EXISTS `tbladdrpts`;
CREATE TABLE IF NOT EXISTS `tbladdrpts` (
  `rptDesc` varchar(50) DEFAULT NULL,
  `rptMacro` varchar(50) NOT NULL,
  `Reg` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbladdrptsgen`
--

DROP TABLE IF EXISTS `tbladdrptsgen`;
CREATE TABLE IF NOT EXISTS `tbladdrptsgen` (
  `rptDesc` varchar(50) DEFAULT NULL,
  `rptMacro` varchar(50) NOT NULL,
  `Reg` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblbuilders`
--

DROP TABLE IF EXISTS `tblbuilders`;
CREATE TABLE IF NOT EXISTS `tblbuilders` (
`PID` int(11) NOT NULL,
  `BuilderID` varchar(10) NOT NULL,
  `BuildName` varchar(70) DEFAULT NULL,
  `BuildContact` varchar(50) DEFAULT NULL,
  `Address12` varchar(50) DEFAULT NULL,
  `Address22` varchar(50) DEFAULT NULL,
  `Suburb2` varchar(50) DEFAULT NULL,
  `State2` varchar(10) DEFAULT NULL,
  `Postcode2` varchar(5) DEFAULT NULL,
  `WPhone2` varchar(20) DEFAULT NULL,
  `HPhone2` varchar(20) DEFAULT NULL,
  `Fax2` varchar(20) DEFAULT NULL,
  `Mobile2` varchar(20) DEFAULT NULL,
  `Email2` varchar(70) DEFAULT NULL,
  `Suburb2ID` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblcatcomposites`
--

DROP TABLE IF EXISTS `tblcatcomposites`;
CREATE TABLE IF NOT EXISTS `tblcatcomposites` (
`AID` int(11) NOT NULL,
  `CatCode` varchar(25) DEFAULT NULL,
  `Category` varchar(50) DEFAULT NULL,
  `Desc` varchar(50) DEFAULT NULL,
  `InventID` varchar(50) DEFAULT NULL,
  `Qty` double DEFAULT '0',
  `LabourHrs` double DEFAULT '0',
  `Notes` longtext,
  `Order` double DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=334 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

DROP TABLE IF EXISTS `tblcategory`;
CREATE TABLE IF NOT EXISTS `tblcategory` (
`FID` int(11) NOT NULL,
  `CatCode` varchar(25) DEFAULT NULL,
  `Category` varchar(20) DEFAULT NULL,
  `Desc` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblclientaction`
--

DROP TABLE IF EXISTS `tblclientaction`;
CREATE TABLE IF NOT EXISTS `tblclientaction` (
`PID` int(11) NOT NULL,
  `ClientID` varchar(10) DEFAULT NULL,
  `DateEntered` datetime DEFAULT NULL,
  `CName` varchar(80) DEFAULT NULL,
  `Rep` varchar(50) DEFAULT NULL,
  `RepID` varchar(50) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `Actioned` bit(1) DEFAULT NULL,
  `DateActioned` datetime DEFAULT NULL,
  `TakenBy` varchar(50) DEFAULT NULL,
  `AppDate` datetime DEFAULT NULL,
  `AppPlace` longtext,
  `DateLetterPrt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblclientactions`
--

DROP TABLE IF EXISTS `tblclientactions`;
CREATE TABLE IF NOT EXISTS `tblclientactions` (
`AID` int(11) NOT NULL,
  `ActionID` varchar(50) DEFAULT NULL,
  `ClientID` varchar(10) DEFAULT NULL,
  `NoteID` varchar(50) DEFAULT NULL,
  `Notes` longtext,
  `Completed` bit(1) DEFAULT b'0',
  `DateCompleted` time DEFAULT NULL,
  `UserCreated` varchar(50) DEFAULT NULL,
  `DateCreated` datetime DEFAULT NULL,
  `UserModified` varchar(50) DEFAULT NULL,
  `DateModified` char(19) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblclientnotes`
--

DROP TABLE IF EXISTS `tblclientnotes`;
CREATE TABLE IF NOT EXISTS `tblclientnotes` (
`NID` int(11) NOT NULL,
  `NoteID` varchar(50) DEFAULT NULL,
  `ClientID` varchar(10) DEFAULT NULL,
  `Notes` longtext,
  `UserCreated` varchar(50) DEFAULT NULL,
  `DateCreated` datetime DEFAULT NULL,
  `UserModified` varchar(50) DEFAULT NULL,
  `DateModified` time DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblclientpersonal`
--

DROP TABLE IF EXISTS `tblclientpersonal`;
CREATE TABLE IF NOT EXISTS `tblclientpersonal` (
`PID` int(11) NOT NULL,
  `ClientID` varchar(10) NOT NULL,
  `DateLodged` date DEFAULT NULL,
  `Title1` varchar(50) DEFAULT NULL,
  `Surname1` varchar(70) DEFAULT NULL,
  `GivenName1` varchar(50) DEFAULT NULL,
  `Address11` varchar(50) DEFAULT NULL,
  `Address21` varchar(50) DEFAULT NULL,
  `Suburb1` varchar(50) DEFAULT NULL,
  `State1` varchar(10) DEFAULT NULL,
  `Postcode1` varchar(5) DEFAULT NULL,
  `WPhone1` varchar(20) DEFAULT NULL,
  `HPhone1` varchar(20) DEFAULT NULL,
  `Fax1` varchar(20) DEFAULT NULL,
  `Mobile1` varchar(20) DEFAULT NULL,
  `Email1` varchar(70) DEFAULT NULL,
  `BuildName` varchar(70) DEFAULT NULL,
  `BuildContact` varchar(50) DEFAULT NULL,
  `Address12` varchar(50) DEFAULT NULL,
  `Address22` varchar(50) DEFAULT NULL,
  `Suburb2` varchar(50) DEFAULT NULL,
  `State2` varchar(10) DEFAULT NULL,
  `Postcode2` varchar(5) DEFAULT NULL,
  `WPhone2` varchar(20) DEFAULT NULL,
  `HPhone2` varchar(20) DEFAULT NULL,
  `Fax2` varchar(20) DEFAULT NULL,
  `Mobile2` varchar(20) DEFAULT NULL,
  `Email2` varchar(70) DEFAULT NULL,
  `AppDate` datetime DEFAULT NULL,
  `TakenBy` varchar(50) DEFAULT NULL,
  `NotesSect` longtext,
  `Rep` varchar(50) DEFAULT NULL,
  `RepID` varchar(50) DEFAULT NULL,
  `Lead` varchar(50) DEFAULT NULL,
  `Label` bit(1) DEFAULT NULL,
  `Letter` bit(1) DEFAULT NULL,
  `MailName` varchar(50) DEFAULT NULL,
  `SecAddress1` varchar(50) DEFAULT NULL,
  `SecAddress2` varchar(50) DEFAULT NULL,
  `SecSuburb` varchar(50) DEFAULT NULL,
  `SecState` varchar(50) DEFAULT NULL,
  `SecPostcode` varchar(50) DEFAULT NULL,
  `EmailSent` bit(1) DEFAULT NULL,
  `Suburb1ID` int(11) DEFAULT NULL,
  `Suburb2ID` int(11) DEFAULT NULL,
  `SecSuburbID` int(11) DEFAULT NULL,
  `SecMobile` varchar(20) DEFAULT NULL,
  `SecWPhone` varchar(20) DEFAULT NULL,
  `SecEmail` varchar(200) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1001 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblcolour`
--

DROP TABLE IF EXISTS `tblcolour`;
CREATE TABLE IF NOT EXISTS `tblcolour` (
`FID` int(11) NOT NULL,
  `Colour` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblconstructionkpi`
--

DROP TABLE IF EXISTS `tblconstructionkpi`;
CREATE TABLE IF NOT EXISTS `tblconstructionkpi` (
`id` int(11) NOT NULL,
  `client_id` varchar(45) DEFAULT NULL,
  `project_id` varchar(45) DEFAULT NULL,
  `contract_date` date DEFAULT NULL,
  `check_measure_date` date DEFAULT NULL,
  `drawing_approve_date` date DEFAULT NULL,
  `planning_approve` date DEFAULT NULL,
  `bldg_rules_approval` date DEFAULT NULL,
  `fw_complete` date DEFAULT NULL,
  `handover_date` date DEFAULT NULL,
  `permit_approved_date` date DEFAULT NULL,
  `job_start_date` date DEFAULT NULL,
  `job_end_date` date DEFAULT NULL,
  `da_date` date DEFAULT NULL,
  `install_date` date DEFAULT NULL,
  `schedule_completion` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblcontractsummary`
--

DROP TABLE IF EXISTS `tblcontractsummary`;
CREATE TABLE IF NOT EXISTS `tblcontractsummary` (
`id` int(11) NOT NULL,
  `target_month` date DEFAULT NULL,
  `no_contract` int(11) DEFAULT '0',
  `no_check_measure` int(11) DEFAULT '0',
  `no_drawing_prep` int(11) DEFAULT '0',
  `no_drawing_approve` int(11) DEFAULT '0',
  `no_dev_approve` int(11) DEFAULT '0',
  `no_fw_complete_not_done` int(11) DEFAULT NULL,
  `no_fw_complete_done` int(11) DEFAULT '0',
  `no_job_sched` int(11) DEFAULT '0',
  `no_job_complete` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblcouncil`
--

DROP TABLE IF EXISTS `tblcouncil`;
CREATE TABLE IF NOT EXISTS `tblcouncil` (
`FID` int(11) NOT NULL,
  `Council` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbldefinedcomposites`
--

DROP TABLE IF EXISTS `tbldefinedcomposites`;
CREATE TABLE IF NOT EXISTS `tbldefinedcomposites` (
`AID` int(11) NOT NULL,
  `DefCode` varchar(25) DEFAULT NULL,
  `Desc` varchar(50) DEFAULT NULL,
  `Part1` varchar(50) DEFAULT NULL,
  `Part2` varchar(50) DEFAULT NULL,
  `Part3` varchar(50) DEFAULT NULL,
  `Part4` varchar(50) DEFAULT NULL,
  `Part5` varchar(50) DEFAULT NULL,
  `Part6` varchar(50) DEFAULT NULL,
  `Part7` varchar(50) DEFAULT NULL,
  `Part8` varchar(50) DEFAULT NULL,
  `Part9` varchar(50) DEFAULT NULL,
  `Part10` varchar(50) DEFAULT NULL,
  `Part11` varchar(50) DEFAULT NULL,
  `Part12` varchar(50) DEFAULT NULL,
  `Part13` varchar(50) DEFAULT NULL,
  `Part14` varchar(50) DEFAULT NULL,
  `Part15` varchar(50) DEFAULT NULL,
  `Part16` varchar(50) DEFAULT NULL,
  `Part17` varchar(50) DEFAULT NULL,
  `Part18` varchar(50) DEFAULT NULL,
  `Part19` varchar(50) DEFAULT NULL,
  `Part20` varchar(50) DEFAULT NULL,
  `Notes` longtext
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblemployees`
--

DROP TABLE IF EXISTS `tblemployees`;
CREATE TABLE IF NOT EXISTS `tblemployees` (
`UID` int(11) NOT NULL,
  `GivenName` varchar(50) DEFAULT NULL,
  `Surname` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblerectors`
--

DROP TABLE IF EXISTS `tblerectors`;
CREATE TABLE IF NOT EXISTS `tblerectors` (
`FID` int(11) NOT NULL,
  `EName` varchar(50) DEFAULT NULL,
  `PaymentType` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblflashing`
--

DROP TABLE IF EXISTS `tblflashing`;
CREATE TABLE IF NOT EXISTS `tblflashing` (
`FID` int(11) NOT NULL,
  `FCode` varchar(50) DEFAULT NULL,
  `ImageName` varchar(50) DEFAULT NULL,
  `Desc` varchar(50) DEFAULT NULL,
  `A` double DEFAULT '0',
  `B` double DEFAULT '0',
  `C` double DEFAULT '0',
  `D` double DEFAULT '0',
  `E` double DEFAULT '0',
  `Gauge` double DEFAULT '0',
  `Girth` double DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblgutters`
--

DROP TABLE IF EXISTS `tblgutters`;
CREATE TABLE IF NOT EXISTS `tblgutters` (
`FID` int(11) NOT NULL,
  `GCode` varchar(50) DEFAULT NULL,
  `ImageName` varchar(50) DEFAULT NULL,
  `Desc` varchar(50) DEFAULT NULL,
  `A` double DEFAULT '0',
  `B` double DEFAULT '0',
  `C` double DEFAULT '0',
  `D` double DEFAULT '0',
  `E` double DEFAULT '0',
  `F` double DEFAULT '0',
  `Pan` double DEFAULT '0',
  `Girth1` double DEFAULT '0',
  `Girth2` double DEFAULT '0',
  `LipIn` bit(1) DEFAULT NULL,
  `LipOut` bit(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblimages`
--

DROP TABLE IF EXISTS `tblimages`;
CREATE TABLE IF NOT EXISTS `tblimages` (
`FID` int(11) NOT NULL,
  `Type` varchar(20) DEFAULT NULL,
  `ImageName` varchar(50) DEFAULT NULL,
  `Desc` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblinventory`
--

DROP TABLE IF EXISTS `tblinventory`;
CREATE TABLE IF NOT EXISTS `tblinventory` (
`AID` int(11) NOT NULL,
  `InventID` varchar(25) DEFAULT NULL,
  `Section` varchar(50) DEFAULT NULL,
  `Desc` varchar(50) DEFAULT NULL,
  `PODesc` varchar(50) DEFAULT NULL,
  `QtyX` double DEFAULT '0',
  `UOM` varchar(50) DEFAULT NULL,
  `LabourHrs` double DEFAULT '0',
  `RRPExGST` decimal(19,4) DEFAULT '0.0000',
  `CostExGST` decimal(19,4) DEFAULT '0.0000',
  `POCostExGST` decimal(19,4) DEFAULT '0.0000',
  `Commission` bit(1) DEFAULT NULL,
  `SupID` varchar(50) DEFAULT NULL,
  `TypeOfOrder` varchar(50) DEFAULT NULL,
  `GCode` varchar(50) DEFAULT NULL,
  `FCode` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbljob`
--

DROP TABLE IF EXISTS `tbljob`;
CREATE TABLE IF NOT EXISTS `tbljob` (
`AID` int(11) NOT NULL,
  `JobID` varchar(50) NOT NULL,
  `DateEntered` date DEFAULT NULL,
  `QuoteDate` date DEFAULT NULL,
  `ClientID` varchar(10) DEFAULT NULL,
  `QuoteID` varchar(10) DEFAULT NULL,
  `ProjectName` varchar(150) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `Contract` varchar(50) DEFAULT NULL,
  `Council` varchar(50) DEFAULT NULL,
  `Rep` varchar(50) DEFAULT NULL,
  `RepID` varchar(50) DEFAULT NULL,
  `TotalSell` decimal(19,4) DEFAULT '0.0000',
  `TotalCost` decimal(19,4) DEFAULT '0.0000',
  `GST` double DEFAULT '0',
  `SalesRate` double DEFAULT '0',
  `SalesComm` decimal(19,4) DEFAULT '0.0000',
  `CommPerc` double DEFAULT '0',
  `EHrs` bit(1) DEFAULT NULL,
  `ErectorHrs` double DEFAULT '0',
  `HrlyRate` decimal(19,4) DEFAULT '0.0000',
  `ErectorFee` decimal(19,4) DEFAULT '0.0000',
  `ECom` bit(1) DEFAULT NULL,
  `ErectorRate` double DEFAULT '0',
  `ErectorComm` decimal(19,4) DEFAULT '0.0000',
  `Deposit` decimal(19,4) DEFAULT '0.0000',
  `RunningTotal` decimal(19,4) DEFAULT '0.0000',
  `Source` varchar(50) DEFAULT NULL,
  `TravelCost` decimal(19,4) DEFAULT '0.0000',
  `ExtraLabour` decimal(19,4) DEFAULT '0.0000',
  `ExtraHrs` double DEFAULT '0',
  `Accommodation` decimal(19,4) DEFAULT '0.0000',
  `HwareAllow` double DEFAULT '0',
  `Contact` varchar(50) DEFAULT NULL,
  `Approval` varchar(50) DEFAULT NULL,
  `Invoice` varchar(50) DEFAULT NULL,
  `Map` varchar(50) DEFAULT NULL,
  `Ref` varchar(50) DEFAULT NULL,
  `Erector` varchar(50) DEFAULT NULL,
  `SecAddress1` varchar(50) DEFAULT NULL,
  `SecAddress2` varchar(50) DEFAULT NULL,
  `SecSuburb` varchar(50) DEFAULT NULL,
  `SecState` varchar(50) DEFAULT NULL,
  `SecPostcode` varchar(50) DEFAULT NULL,
  `NotesSectPkg` longtext,
  `CheckMeasure` date DEFAULT NULL,
  `ProdOrd` date DEFAULT NULL,
  `CApplication` datetime DEFAULT NULL,
  `CApproval` date DEFAULT NULL,
  `ProdCompleted` date DEFAULT NULL,
  `InstallDate` date DEFAULT NULL,
  `Installer` varchar(50) DEFAULT NULL,
  `InstallerContacted` date DEFAULT NULL,
  `CustContacted` date DEFAULT NULL,
  `MaterialDue` date DEFAULT NULL,
  `DateContracted` datetime DEFAULT NULL,
  `DateJobComm` datetime DEFAULT NULL,
  `DateJobCompleted` date DEFAULT NULL,
  `WarrantyPeriod` date DEFAULT NULL,
  `NotesSect` longtext,
  `SecSuburbID` int(11) DEFAULT NULL,
  `DrawingApprovalDate` datetime DEFAULT NULL,
  `CertificationDate` datetime DEFAULT NULL,
  `BuildingPermitType` varchar(255) DEFAULT NULL,
  `BuildingPermitIssued` datetime DEFAULT NULL,
  `PlanningDispensationRequired` bit(1) DEFAULT b'0',
  `ModificationRequired` bit(1) DEFAULT b'0',
  `ModificationApplication` datetime DEFAULT NULL,
  `ModificationApproved` datetime DEFAULT NULL,
  `EngineeringApprovalDate` datetime DEFAULT NULL,
  `FootingInspectionDate` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbljobcomposite`
--

DROP TABLE IF EXISTS `tbljobcomposite`;
CREATE TABLE IF NOT EXISTS `tbljobcomposite` (
`QAID` int(11) NOT NULL,
  `JobID` varchar(50) DEFAULT NULL,
  `QuoteID` varchar(30) DEFAULT NULL,
  `QCostID` varchar(30) DEFAULT NULL,
  `CatCode` varchar(50) DEFAULT NULL,
  `CatDesc` varchar(50) DEFAULT NULL,
  `InventID` varchar(30) DEFAULT NULL,
  `InventDesc` varchar(50) DEFAULT NULL,
  `PODesc` varchar(50) DEFAULT NULL,
  `UOM` varchar(30) DEFAULT NULL,
  `Qty1` double DEFAULT '0',
  `Length` double DEFAULT '0',
  `Colour` varchar(50) DEFAULT NULL,
  `CostExGST` double DEFAULT '0',
  `RRPExGST` double DEFAULT '0',
  `POCostExGST` decimal(19,4) DEFAULT '0.0000',
  `LabourHrs` double DEFAULT '0',
  `Lock` bit(1) DEFAULT NULL,
  `SupID` varchar(50) DEFAULT NULL,
  `OrderProcessed` bit(1) DEFAULT NULL,
  `OrderNo` varchar(50) DEFAULT NULL,
  `Type` varchar(50) DEFAULT NULL,
  `Order` double DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbljobflashinginfo`
--

DROP TABLE IF EXISTS `tbljobflashinginfo`;
CREATE TABLE IF NOT EXISTS `tbljobflashinginfo` (
`QAID` int(11) NOT NULL,
  `JobID` varchar(50) DEFAULT NULL,
  `QuoteID` varchar(30) DEFAULT NULL,
  `QCostID` varchar(30) DEFAULT NULL,
  `InventDesc` varchar(50) DEFAULT NULL,
  `Image` varchar(50) DEFAULT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Qty` double DEFAULT '0',
  `Length` double DEFAULT '0',
  `A` double DEFAULT '0',
  `B` double DEFAULT '0',
  `C` double DEFAULT '0',
  `D` double DEFAULT '0',
  `E` double DEFAULT '0',
  `Gauge` double DEFAULT '0',
  `Girth` double DEFAULT '0',
  `Lock` bit(1) DEFAULT NULL,
  `SupID` varchar(50) DEFAULT NULL,
  `OrderProcessed` bit(1) DEFAULT NULL,
  `OrderNo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbljobgutterinfo`
--

DROP TABLE IF EXISTS `tbljobgutterinfo`;
CREATE TABLE IF NOT EXISTS `tbljobgutterinfo` (
`QAID` int(11) NOT NULL,
  `JobID` varchar(50) DEFAULT NULL,
  `QuoteID` varchar(30) DEFAULT NULL,
  `QCostID` varchar(30) DEFAULT NULL,
  `InventDesc` varchar(50) DEFAULT NULL,
  `Image` varchar(50) DEFAULT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Qty` double DEFAULT '0',
  `Length` double DEFAULT '0',
  `A` double DEFAULT '0',
  `B` double DEFAULT '0',
  `C` double DEFAULT '0',
  `D` double DEFAULT '0',
  `E` double DEFAULT '0',
  `F` double DEFAULT '0',
  `Pan` double DEFAULT '0',
  `Girth1` double DEFAULT '0',
  `Girth2` double DEFAULT '0',
  `LipIn` bit(1) DEFAULT NULL,
  `LipOut` bit(1) DEFAULT NULL,
  `Lock` bit(1) DEFAULT NULL,
  `SupID` varchar(50) DEFAULT NULL,
  `OrderProcessed` bit(1) DEFAULT NULL,
  `OrderNo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbljobstatus`
--

DROP TABLE IF EXISTS `tbljobstatus`;
CREATE TABLE IF NOT EXISTS `tbljobstatus` (
`FID` int(11) NOT NULL,
  `Status` varchar(20) DEFAULT NULL,
  `Quote` bit(1) DEFAULT NULL,
  `Contract` bit(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblleads`
--

DROP TABLE IF EXISTS `tblleads`;
CREATE TABLE IF NOT EXISTS `tblleads` (
`FID` int(11) NOT NULL,
  `Lead` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblletterssent`
--

DROP TABLE IF EXISTS `tblletterssent`;
CREATE TABLE IF NOT EXISTS `tblletterssent` (
`AID` int(11) NOT NULL,
  `ClientID` varchar(50) DEFAULT NULL,
  `LetterID` varchar(50) DEFAULT NULL,
  `LetterName` varchar(100) DEFAULT NULL,
  `Date` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblmonths`
--

DROP TABLE IF EXISTS `tblmonths`;
CREATE TABLE IF NOT EXISTS `tblmonths` (
`AID` int(11) NOT NULL,
  `Mth` double DEFAULT '0',
  `Month` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblquotecomposite`
--

DROP TABLE IF EXISTS `tblquotecomposite`;
CREATE TABLE IF NOT EXISTS `tblquotecomposite` (
`QAID` int(11) NOT NULL,
  `QuoteID` varchar(30) DEFAULT NULL,
  `QCostID` varchar(30) DEFAULT NULL,
  `CatCode` varchar(50) DEFAULT NULL,
  `CatDesc` varchar(50) DEFAULT NULL,
  `InventID` varchar(30) DEFAULT NULL,
  `InventDesc` varchar(50) DEFAULT NULL,
  `UOM` varchar(30) DEFAULT NULL,
  `Qty1` double DEFAULT '0',
  `Length` double DEFAULT '0',
  `Colour` varchar(50) DEFAULT NULL,
  `CostExGST` double DEFAULT '0',
  `RRPExGST` double DEFAULT '0',
  `LabourHrs` double DEFAULT '0',
  `Lock` bit(1) DEFAULT NULL,
  `SupID` varchar(50) DEFAULT NULL,
  `Order` double DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblquotes`
--

DROP TABLE IF EXISTS `tblquotes`;
CREATE TABLE IF NOT EXISTS `tblquotes` (
`AID` int(11) NOT NULL,
  `QuoteID` varchar(20) DEFAULT NULL,
  `ClientID` varchar(20) DEFAULT NULL,
  `ProjectName` varchar(150) DEFAULT NULL,
  `Rep` varchar(50) DEFAULT NULL,
  `RepID` varchar(50) DEFAULT NULL,
  `DateEntered` date DEFAULT NULL,
  `QuoteDate` date DEFAULT NULL,
  `TotalCost` double DEFAULT '0',
  `TotalSell` double DEFAULT '0',
  `Status` varchar(50) DEFAULT NULL,
  `NotesSect` longtext,
  `Lock` bit(1) DEFAULT NULL,
  `GST` double DEFAULT '0',
  `SalesComm` double DEFAULT '0',
  `SalesCommValue` decimal(19,4) DEFAULT '0.0000',
  `InstallComm` double DEFAULT '0',
  `ErectorComm` decimal(19,4) DEFAULT '0.0000',
  `CommPerc` double DEFAULT '0',
  `StdComm` bit(1) DEFAULT NULL,
  `CustCom` bit(1) DEFAULT NULL,
  `EnableCost` bit(1) DEFAULT b'0',
  `FollowUpDate1` date DEFAULT NULL,
  `FollowUpDate2` datetime DEFAULT NULL,
  `FollowUpDate3` datetime DEFAULT NULL,
  `CostingDate` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblreps`
--

DROP TABLE IF EXISTS `tblreps`;
CREATE TABLE IF NOT EXISTS `tblreps` (
`UID` int(11) NOT NULL,
  `GivenName` varchar(70) DEFAULT NULL,
  `Surname` varchar(50) DEFAULT NULL,
  `Phone` varchar(50) DEFAULT NULL,
  `Mobile` varchar(50) DEFAULT NULL,
  `ABN` varchar(50) DEFAULT NULL,
  `UserName` varchar(50) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `RepID` varchar(50) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `NotesSect` longtext,
  `EmailAddress` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblsaleskpi`
--

DROP TABLE IF EXISTS `tblsaleskpi`;
CREATE TABLE IF NOT EXISTS `tblsaleskpi` (
`id` int(11) NOT NULL,
  `client_id` varchar(45) DEFAULT NULL,
  `consultant_id` varchar(45) DEFAULT NULL,
  `project_id` varchar(45) DEFAULT NULL,
  `enquiry_date` date DEFAULT NULL,
  `quote_date` date DEFAULT NULL,
  `contract_cf_id` int(11) DEFAULT NULL,
  `contract_date` date DEFAULT NULL,
  `contract_value` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=871 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblsections`
--

DROP TABLE IF EXISTS `tblsections`;
CREATE TABLE IF NOT EXISTS `tblsections` (
`FID` int(11) NOT NULL,
  `Category` varchar(20) DEFAULT NULL,
  `CatCode` varchar(25) DEFAULT NULL,
  `CatOrder` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblsuburbs`
--

DROP TABLE IF EXISTS `tblsuburbs`;
CREATE TABLE IF NOT EXISTS `tblsuburbs` (
`ID` int(11) NOT NULL,
  `State` varchar(255) DEFAULT NULL,
  `Postcode` varchar(255) DEFAULT NULL,
  `District` varchar(255) DEFAULT NULL,
  `Suburb` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblsummarydailysalesgeneral`
--

DROP TABLE IF EXISTS `tblsummarydailysalesgeneral`;
CREATE TABLE IF NOT EXISTS `tblsummarydailysalesgeneral` (
`id` int(11) NOT NULL,
  `summary_date` date DEFAULT NULL,
  `summary_year` smallint(6) DEFAULT NULL,
  `summary_month` tinyint(4) DEFAULT NULL,
  `summary_day` tinyint(4) DEFAULT NULL,
  `consultant_id` varchar(45) DEFAULT NULL,
  `target_sales_amount` float DEFAULT NULL,
  `target_sales_contract` int(11) DEFAULT NULL,
  `sales_amount` float DEFAULT NULL,
  `num_enquiries` int(11) DEFAULT NULL,
  `num_quotes` int(11) DEFAULT NULL,
  `num_contracts` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4285668 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblsummarydailysalesgeneral_temp`
--

DROP TABLE IF EXISTS `tblsummarydailysalesgeneral_temp`;
CREATE TABLE IF NOT EXISTS `tblsummarydailysalesgeneral_temp` (
`id` int(11) NOT NULL,
  `summary_date` date DEFAULT NULL,
  `summary_year` smallint(6) DEFAULT NULL,
  `summary_month` tinyint(4) DEFAULT NULL,
  `summary_day` tinyint(4) DEFAULT NULL,
  `consultant_id` varchar(45) DEFAULT NULL,
  `target_sales_amount` float DEFAULT NULL,
  `target_sales_contract` int(11) DEFAULT NULL,
  `sales_amount` float DEFAULT NULL,
  `num_enquiries` int(11) DEFAULT NULL,
  `num_quotes` int(11) DEFAULT NULL,
  `num_contracts` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4285668 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblsummarydailysalesquote`
--

DROP TABLE IF EXISTS `tblsummarydailysalesquote`;
CREATE TABLE IF NOT EXISTS `tblsummarydailysalesquote` (
`id` int(11) NOT NULL,
  `quote_date` date DEFAULT NULL,
  `consultant_id` varchar(45) DEFAULT NULL,
  `quote_id` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5335818 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblsummarydailysalesquote_temp`
--

DROP TABLE IF EXISTS `tblsummarydailysalesquote_temp`;
CREATE TABLE IF NOT EXISTS `tblsummarydailysalesquote_temp` (
`id` int(11) NOT NULL,
  `quote_date` date DEFAULT NULL,
  `consultant_id` varchar(45) DEFAULT NULL,
  `quote_id` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5336757 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblsummarydatelist`
--

DROP TABLE IF EXISTS `tblsummarydatelist`;
CREATE TABLE IF NOT EXISTS `tblsummarydatelist` (
`id` int(11) NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5688660 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblsummarydatelist_temp`
--

DROP TABLE IF EXISTS `tblsummarydatelist_temp`;
CREATE TABLE IF NOT EXISTS `tblsummarydatelist_temp` (
`id` int(11) NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5688660 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblsuporders`
--

DROP TABLE IF EXISTS `tblsuporders`;
CREATE TABLE IF NOT EXISTS `tblsuporders` (
`AID` int(11) NOT NULL,
  `OrderNo` varchar(50) NOT NULL,
  `JobID` varchar(50) DEFAULT NULL,
  `SupID` varchar(50) DEFAULT NULL,
  `SupName` varchar(50) DEFAULT NULL,
  `DateEntered` datetime DEFAULT NULL,
  `RequiredDate` datetime DEFAULT NULL,
  `RequiredBy` varchar(10) DEFAULT NULL,
  `AccNo` varchar(10) DEFAULT NULL,
  `ContractNo` varchar(50) DEFAULT NULL,
  `AuthBy` varchar(50) DEFAULT NULL,
  `DeliverTo` varchar(50) DEFAULT NULL,
  `DeliverToAdd1` varchar(50) DEFAULT NULL,
  `DeliverToAdd2` varchar(50) DEFAULT NULL,
  `DeliverToSuburb` varchar(50) DEFAULT NULL,
  `DeliverToState` varchar(50) DEFAULT NULL,
  `DeliverToPostcode` varchar(50) DEFAULT NULL,
  `TotalExGST` decimal(19,4) DEFAULT '0.0000',
  `GST` double DEFAULT '0',
  `Type` varchar(50) DEFAULT NULL,
  `Notes` longtext,
  `CloseOrder` bit(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1004 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblsuppliers`
--

DROP TABLE IF EXISTS `tblsuppliers`;
CREATE TABLE IF NOT EXISTS `tblsuppliers` (
`AID` int(11) NOT NULL,
  `SupID` varchar(10) NOT NULL,
  `Company` varchar(50) DEFAULT NULL,
  `Address1` varchar(50) DEFAULT NULL,
  `Address2` varchar(50) DEFAULT NULL,
  `Suburb` varchar(50) DEFAULT NULL,
  `State` varchar(10) DEFAULT NULL,
  `Postcode` varchar(5) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `Fax` varchar(20) DEFAULT NULL,
  `Email` varchar(70) DEFAULT NULL,
  `Website` varchar(70) DEFAULT NULL,
  `Title` varchar(50) DEFAULT NULL,
  `Surname` varchar(70) DEFAULT NULL,
  `GivenName` varchar(50) DEFAULT NULL,
  `Mobile` varchar(20) DEFAULT NULL,
  `NotesSect` longtext
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblsystem`
--

DROP TABLE IF EXISTS `tblsystem`;
CREATE TABLE IF NOT EXISTS `tblsystem` (
  `Terms` varchar(80) DEFAULT NULL,
  `FirstInvNo` int(11) DEFAULT '0',
  `DefEnqCharge` decimal(19,4) DEFAULT '0.0000',
  `DefRenewal` decimal(19,4) DEFAULT '0.0000',
  `FindField` tinyint(3) unsigned DEFAULT '0',
  `InvMessage` varchar(250) DEFAULT NULL,
  `IDMessage` varchar(250) DEFAULT NULL,
  `CutOffDollars` decimal(19,4) DEFAULT '0.0000',
  `EnableCost` bit(1) DEFAULT b'0',
  `GSTStart` date DEFAULT NULL,
  `GSTPerc` float DEFAULT '0',
  `ImagePath` varchar(100) DEFAULT NULL,
  `CommPerc` float DEFAULT '0',
  `TemplatePath` varchar(100) DEFAULT NULL,
  `Image` longblob,
  `SiteName` varchar(50) DEFAULT NULL,
  `SiteAddress1` varchar(50) DEFAULT NULL,
  `SiteAddress2` varchar(50) DEFAULT NULL,
  `SiteSuburb` varchar(50) DEFAULT NULL,
  `SiteState` varchar(50) DEFAULT NULL,
  `SitePostcode` varchar(50) DEFAULT NULL,
  `SitePhoneWork` varchar(50) DEFAULT NULL,
  `SitePhoneFax` varchar(50) DEFAULT NULL,
  `SiteEmail` varchar(150) DEFAULT NULL,
  `SiteWebsite` varchar(150) DEFAULT NULL,
  `CurrentState` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblsystemtable`
--

DROP TABLE IF EXISTS `tblsystemtable`;
CREATE TABLE IF NOT EXISTS `tblsystemtable` (
`SystemTableID` int(11) NOT NULL,
  `SystemTableUserID` varchar(50) DEFAULT NULL,
  `Table` varchar(50) DEFAULT NULL,
  `StatusName` varchar(50) DEFAULT NULL,
  `DisplayName` varchar(50) DEFAULT NULL,
  `UserCode` varchar(50) DEFAULT NULL,
  `UserCreated` varchar(50) DEFAULT NULL,
  `DateCreated` datetime DEFAULT NULL,
  `UserModified` varchar(50) DEFAULT NULL,
  `DateModified` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbltarget`
--

DROP TABLE IF EXISTS `tbltarget`;
CREATE TABLE IF NOT EXISTS `tbltarget` (
`TargetID` int(11) NOT NULL,
  `TargetDate` datetime DEFAULT NULL,
  `TargetContracts` int(11) DEFAULT '0',
  `TargetValue` decimal(19,4) DEFAULT '0.0000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbltemplates`
--

DROP TABLE IF EXISTS `tbltemplates`;
CREATE TABLE IF NOT EXISTS `tbltemplates` (
  `Filename` varchar(100) DEFAULT NULL,
  `Description` varchar(100) DEFAULT NULL,
`TID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbltravel`
--

DROP TABLE IF EXISTS `tbltravel`;
CREATE TABLE IF NOT EXISTS `tbltravel` (
`FID` int(11) NOT NULL,
  `Zone` varchar(20) DEFAULT NULL,
  `Cost` decimal(19,4) DEFAULT '0.0000'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

DROP TABLE IF EXISTS `tblusers`;
CREATE TABLE IF NOT EXISTS `tblusers` (
`user_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblyear`
--

DROP TABLE IF EXISTS `tblyear`;
CREATE TABLE IF NOT EXISTS `tblyear` (
`AID` int(11) NOT NULL,
  `Year` double DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `active` int(11) DEFAULT '1',
  `user_type_id` int(11) DEFAULT '1',
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `is_admin` int(11) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `usergroup_id` int(11) DEFAULT NULL,
  `consultant_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COMMENT='user_type_id\n1-9 = Admin\n11 = Consultants\n21 = Tele Sales\n\nusergroup 1 = common user\nusergroup 2 = consultant\n31 = Custemer User';

-- --------------------------------------------------------

--
-- Table structure for table `ver_ak_profiles`
--

DROP TABLE IF EXISTS `ver_ak_profiles`;
CREATE TABLE IF NOT EXISTS `ver_ak_profiles` (
`id` int(10) unsigned NOT NULL,
  `description` varchar(255) NOT NULL,
  `configuration` longtext,
  `filters` longtext
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_ak_stats`
--

DROP TABLE IF EXISTS `ver_ak_stats`;
CREATE TABLE IF NOT EXISTS `ver_ak_stats` (
`id` bigint(20) unsigned NOT NULL,
  `description` varchar(255) NOT NULL,
  `comment` longtext,
  `backupstart` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `backupend` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` enum('run','fail','complete') NOT NULL DEFAULT 'run',
  `origin` varchar(30) NOT NULL DEFAULT 'backend',
  `type` varchar(30) NOT NULL DEFAULT 'full',
  `profile_id` bigint(20) NOT NULL DEFAULT '1',
  `archivename` longtext,
  `absolute_path` longtext,
  `multipart` int(11) NOT NULL DEFAULT '0',
  `tag` varchar(255) DEFAULT NULL,
  `filesexist` tinyint(3) NOT NULL DEFAULT '1',
  `remote_filename` varchar(1000) DEFAULT NULL,
  `total_size` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_ak_storage`
--

DROP TABLE IF EXISTS `ver_ak_storage`;
CREATE TABLE IF NOT EXISTS `ver_ak_storage` (
  `tag` varchar(255) NOT NULL,
  `lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `data` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_assets`
--

DROP TABLE IF EXISTS `ver_assets`;
CREATE TABLE IF NOT EXISTS `ver_assets` (
`id` int(10) unsigned NOT NULL COMMENT 'Primary Key',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set parent.',
  `lft` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set lft.',
  `rgt` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set rgt.',
  `level` int(10) unsigned NOT NULL COMMENT 'The cached level in the nested tree.',
  `name` varchar(50) NOT NULL COMMENT 'The unique name for the asset.\n',
  `title` varchar(100) NOT NULL COMMENT 'The descriptive title for the asset.',
  `rules` varchar(5120) NOT NULL COMMENT 'JSON encoded access control.'
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_associations`
--

DROP TABLE IF EXISTS `ver_associations`;
CREATE TABLE IF NOT EXISTS `ver_associations` (
  `id` varchar(50) NOT NULL COMMENT 'A reference to the associated item.',
  `context` varchar(50) NOT NULL COMMENT 'The context of the associated item.',
  `key` char(32) NOT NULL COMMENT 'The key for the association computed from an md5 on associated ids.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_banners`
--

DROP TABLE IF EXISTS `ver_banners`;
CREATE TABLE IF NOT EXISTS `ver_banners` (
`id` int(11) NOT NULL,
  `cid` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `imptotal` int(11) NOT NULL DEFAULT '0',
  `impmade` int(11) NOT NULL DEFAULT '0',
  `clicks` int(11) NOT NULL DEFAULT '0',
  `clickurl` varchar(200) NOT NULL DEFAULT '',
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `catid` int(10) unsigned NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `custombannercode` varchar(2048) NOT NULL,
  `sticky` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `params` text NOT NULL,
  `own_prefix` tinyint(1) NOT NULL DEFAULT '0',
  `metakey_prefix` varchar(255) NOT NULL DEFAULT '',
  `purchase_type` tinyint(4) NOT NULL DEFAULT '-1',
  `track_clicks` tinyint(4) NOT NULL DEFAULT '-1',
  `track_impressions` tinyint(4) NOT NULL DEFAULT '-1',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `reset` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `language` char(7) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_banner_clients`
--

DROP TABLE IF EXISTS `ver_banner_clients`;
CREATE TABLE IF NOT EXISTS `ver_banner_clients` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `contact` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `extrainfo` text NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `metakey` text NOT NULL,
  `own_prefix` tinyint(4) NOT NULL DEFAULT '0',
  `metakey_prefix` varchar(255) NOT NULL DEFAULT '',
  `purchase_type` tinyint(4) NOT NULL DEFAULT '-1',
  `track_clicks` tinyint(4) NOT NULL DEFAULT '-1',
  `track_impressions` tinyint(4) NOT NULL DEFAULT '-1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_banner_tracks`
--

DROP TABLE IF EXISTS `ver_banner_tracks`;
CREATE TABLE IF NOT EXISTS `ver_banner_tracks` (
  `track_date` datetime NOT NULL,
  `track_type` int(10) unsigned NOT NULL,
  `banner_id` int(10) unsigned NOT NULL,
  `count` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_categories`
--

DROP TABLE IF EXISTS `ver_categories`;
CREATE TABLE IF NOT EXISTS `ver_categories` (
`id` int(11) NOT NULL,
  `asset_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to the ver_assets table.',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  `lft` int(11) NOT NULL DEFAULT '0',
  `rgt` int(11) NOT NULL DEFAULT '0',
  `level` int(10) unsigned NOT NULL DEFAULT '0',
  `path` varchar(255) NOT NULL DEFAULT '',
  `extension` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `note` varchar(255) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `metadesc` varchar(1024) NOT NULL COMMENT 'The meta description for the page.',
  `metakey` varchar(1024) NOT NULL COMMENT 'The meta keywords for the page.',
  `metadata` varchar(2048) NOT NULL COMMENT 'JSON encoded metadata properties.',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `language` char(7) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoforms`
--

DROP TABLE IF EXISTS `ver_chronoforms`;
CREATE TABLE IF NOT EXISTS `ver_chronoforms` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `form_type` tinyint(1) NOT NULL,
  `content` longtext NOT NULL,
  `wizardcode` longtext,
  `events_actions_map` longtext,
  `params` longtext NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `app` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoforms_data_builderpersonal_lookup`
--

DROP TABLE IF EXISTS `ver_chronoforms_data_builderpersonal_lookup`;
CREATE TABLE IF NOT EXISTS `ver_chronoforms_data_builderpersonal_lookup` (
`id` int(11) NOT NULL,
  `clientid` varchar(45) DEFAULT NULL,
  `builder_name` varchar(45) DEFAULT NULL,
  `address1` varchar(45) DEFAULT NULL,
  `address2` varchar(45) DEFAULT NULL,
  `suburb` varchar(45) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `postcode` varchar(45) DEFAULT NULL,
  `workphone` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoforms_data_builderpersonal_vic`
--

DROP TABLE IF EXISTS `ver_chronoforms_data_builderpersonal_vic`;
CREATE TABLE IF NOT EXISTS `ver_chronoforms_data_builderpersonal_vic` (
`pid` int(11) NOT NULL,
  `datelodged` datetime DEFAULT NULL,
  `repid` varchar(255) DEFAULT NULL,
  `repident` varchar(255) DEFAULT NULL,
  `repname` varchar(255) DEFAULT NULL,
  `employeeid` varchar(255) DEFAULT NULL,
  `leadid` varchar(255) DEFAULT NULL,
  `leadname` varchar(255) DEFAULT NULL,
  `appointmentdate` datetime DEFAULT NULL,
  `builderid` varchar(255) DEFAULT NULL,
  `builder_suburbid` varchar(255) DEFAULT NULL,
  `builder_name` varchar(255) DEFAULT NULL,
  `builder_contact` varchar(255) DEFAULT NULL,
  `builder_address1` varchar(255) DEFAULT NULL,
  `builder_address2` varchar(255) DEFAULT NULL,
  `builder_suburb` varchar(255) DEFAULT NULL,
  `builder_state` varchar(255) DEFAULT NULL,
  `builder_postcode` varchar(255) DEFAULT NULL,
  `builder_wkphone` varchar(255) DEFAULT NULL,
  `builder_hmphone` varchar(255) DEFAULT NULL,
  `builder_mobile` varchar(255) DEFAULT NULL,
  `builder_fax` varchar(255) DEFAULT NULL,
  `builder_email` varchar(255) DEFAULT NULL,
  `site_suburbid` varchar(255) DEFAULT NULL,
  `site_project` varchar(255) DEFAULT NULL,
  `site_address1` varchar(255) DEFAULT NULL,
  `site_address2` varchar(255) DEFAULT NULL,
  `site_suburb` varchar(255) DEFAULT NULL,
  `site_state` varchar(255) DEFAULT NULL,
  `site_postcode` varchar(255) DEFAULT NULL,
  `site_wkphone` varchar(255) DEFAULT NULL,
  `site_hmphone` varchar(255) DEFAULT NULL,
  `site_mobile` varchar(255) DEFAULT NULL,
  `site_other` varchar(255) DEFAULT NULL,
  `site_email` varchar(255) DEFAULT NULL,
  `tenderid` varchar(255) DEFAULT NULL,
  `tenderstatus` varchar(255) DEFAULT NULL,
  `lastRepId` varchar(45) DEFAULT NULL,
  `mail_name` varchar(255) DEFAULT NULL,
  `taken_by` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `next_followup` date DEFAULT NULL,
  `is_builder` int(11) DEFAULT '1',
  `builder_other` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1247 DEFAULT CHARSET=utf8 COMMENT='status = WON if it has a contract signed';

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoforms_data_builder_vic`
--

DROP TABLE IF EXISTS `ver_chronoforms_data_builder_vic`;
CREATE TABLE IF NOT EXISTS `ver_chronoforms_data_builder_vic` (
`cf_id` int(11) NOT NULL,
  `suburbid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `builder_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `builder_contact` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `builder_address1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `builder_address2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `builder_suburb` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `builder_state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `builder_postcode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `builder_wkphone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `builder_hmphone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `builder_mobile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `builder_fax` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `builder_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoforms_data_clientpersonal_vic`
--

DROP TABLE IF EXISTS `ver_chronoforms_data_clientpersonal_vic`;
CREATE TABLE IF NOT EXISTS `ver_chronoforms_data_clientpersonal_vic` (
`pid` int(11) NOT NULL,
  `datelodged` datetime DEFAULT NULL,
  `repid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `repident` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `repname` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `employeeid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `leadid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `leadname` varchar(255) DEFAULT NULL,
  `appointmentdate` datetime DEFAULT NULL,
  `clientid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `client_suburbid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `client_title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `client_firstname` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `client_lastname` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `builder_name` varchar(255) DEFAULT NULL,
  `builder_contact` varchar(100) DEFAULT NULL,
  `builderid` varchar(45) DEFAULT NULL,
  `client_address1` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `client_address2` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `client_suburb` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `client_state` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `client_postcode` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `client_wkphone` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `client_hmphone` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `client_mobile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `client_other` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `client_email` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `site_suburbid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `site_title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `site_firstname` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `site_lastname` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `site_address1` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `site_address2` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `site_suburb` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `site_state` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `site_postcode` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `site_wkphone` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `site_hmphone` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `site_mobile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `site_other` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `site_email` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `lastRepId` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `fax` varchar(45) DEFAULT NULL,
  `is_builder` int(11) DEFAULT '0',
  `mail_name` varchar(255) DEFAULT NULL,
  `is_email_sent` int(11) DEFAULT '0',
  `status` varchar(45) DEFAULT NULL,
  `next_followup` date DEFAULT NULL,
  `qdelivered` date DEFAULT NULL,
  `date_contract_signed` date DEFAULT NULL,
  `is_first_appointment` int(11) DEFAULT '1',
  `tenderid` varchar(45) DEFAULT NULL,
  `tender_project_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6609 DEFAULT CHARSET=latin1 COMMENT='status = WON if it has a contract signed\nstatus, next_followup, date_contract_signed  are fields useful in to do list function to monitor the client''s status if needs a followup to sign a contract.\nNot untel the sales input the date_contract_signed the client will disappear in to do list.';

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoforms_data_colour_vic`
--

DROP TABLE IF EXISTS `ver_chronoforms_data_colour_vic`;
CREATE TABLE IF NOT EXISTS `ver_chronoforms_data_colour_vic` (
`cf_id` int(11) NOT NULL,
  `colour` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hex_value` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoforms_data_contract_bom_meterial_vic`
--

DROP TABLE IF EXISTS `ver_chronoforms_data_contract_bom_meterial_vic`;
CREATE TABLE IF NOT EXISTS `ver_chronoforms_data_contract_bom_meterial_vic` (
`id` int(11) NOT NULL,
  `contract_item_cf_id` int(11) DEFAULT NULL,
  `projectid` varchar(45) DEFAULT NULL,
  `inventoryid` varchar(45) DEFAULT NULL,
  `materialid` varchar(45) DEFAULT NULL,
  `raw_cost` float DEFAULT '0',
  `qty` int(11) DEFAULT '1',
  `length` decimal(19,3) DEFAULT NULL,
  `supplierid` varchar(45) DEFAULT NULL,
  `process_po` int(11) DEFAULT NULL,
  `section` varchar(45) DEFAULT NULL,
  `is_reorder` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=1659 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoforms_data_contract_bom_vic`
--

DROP TABLE IF EXISTS `ver_chronoforms_data_contract_bom_vic`;
CREATE TABLE IF NOT EXISTS `ver_chronoforms_data_contract_bom_vic` (
`cf_id` int(11) NOT NULL,
  `orderdate` datetime DEFAULT NULL,
  `quoteid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `inventoryid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `projectid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `framework_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `framework` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `length` decimal(19,3) DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `colour` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `finish` varchar(45) DEFAULT NULL,
  `qty` decimal(19,2) DEFAULT NULL,
  `uom` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `rrp` decimal(19,2) DEFAULT NULL,
  `cost` decimal(19,2) DEFAULT NULL,
  `supplierid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `contract_item_cf_id` int(11) DEFAULT NULL,
  `is_reorder` int(11) DEFAULT '0',
  `inventory_section` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `inventory_category` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1396 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoforms_data_contract_details_vic`
--

DROP TABLE IF EXISTS `ver_chronoforms_data_contract_details_vic`;
CREATE TABLE IF NOT EXISTS `ver_chronoforms_data_contract_details_vic` (
`cf_id` int(11) NOT NULL,
  `quoteid` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `projectid` varchar(255) DEFAULT NULL,
  `quotedate` datetime DEFAULT NULL,
  `contractdate` datetime DEFAULT NULL,
  `deposit_paid` datetime DEFAULT NULL,
  `progress_claim` datetime DEFAULT NULL,
  `final_payment` datetime DEFAULT NULL,
  `deposit_paid_amount` float NOT NULL DEFAULT '0',
  `progress_claim_amount` float NOT NULL DEFAULT '0',
  `final_payment_amount` float NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `travel` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `accomodation` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `cranage` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `scaffold` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `variation_amount` float DEFAULT NULL,
  `variation_date` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=158 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoforms_data_contract_items_default_deminsions`
--

DROP TABLE IF EXISTS `ver_chronoforms_data_contract_items_default_deminsions`;
CREATE TABLE IF NOT EXISTS `ver_chronoforms_data_contract_items_default_deminsions` (
`id` int(11) NOT NULL,
  `inventoryid` varchar(45) DEFAULT NULL,
  `length` float DEFAULT NULL,
  `dimension_a` float DEFAULT NULL,
  `dimension_b` float DEFAULT NULL,
  `dimension_c` float DEFAULT NULL,
  `dimension_d` float DEFAULT NULL,
  `dimension_e` float DEFAULT NULL,
  `dimension_f` float DEFAULT NULL,
  `dimension_p` float DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoforms_data_contract_items_deminsions`
--

DROP TABLE IF EXISTS `ver_chronoforms_data_contract_items_deminsions`;
CREATE TABLE IF NOT EXISTS `ver_chronoforms_data_contract_items_deminsions` (
`id` int(11) NOT NULL,
  `cf_id` int(11) DEFAULT '0',
  `quoteid` varchar(255) DEFAULT NULL,
  `projectid` varchar(45) DEFAULT NULL,
  `inventoryid` varchar(45) DEFAULT NULL,
  `section` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `length` float DEFAULT '0',
  `width` float DEFAULT '0',
  `dimension_a` float DEFAULT '0',
  `dimension_b` float DEFAULT '0',
  `dimension_c` float DEFAULT '0',
  `dimension_d` float DEFAULT '0',
  `dimension_e` float DEFAULT '0',
  `dimension_f` float DEFAULT '0',
  `dimension_p` float DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2331 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoforms_data_contract_items_vic`
--

DROP TABLE IF EXISTS `ver_chronoforms_data_contract_items_vic`;
CREATE TABLE IF NOT EXISTS `ver_chronoforms_data_contract_items_vic` (
`cf_id` int(11) NOT NULL,
  `quoteid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `inventoryid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `projectid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `project_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `framework_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `framework` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `length` decimal(19,3) DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `po_description` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `supplierid` varchar(45) DEFAULT NULL,
  `colour` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `qty` decimal(19,2) DEFAULT NULL,
  `webbing` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `finish` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `uom` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `rrp` decimal(19,2) DEFAULT NULL,
  `cost` decimal(19,2) DEFAULT NULL,
  `is_reorder` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `quote_no` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `quote_qno` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `cat_code` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `cat_desc` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_processed` int(11) DEFAULT '0',
  `order_no` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `order` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_additional` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=37519 DEFAULT CHARSET=latin1 COMMENT='quote_no = QuoteID (Old System DB Table) quoteid name is already used in new system db table\nquote_qno = QCostID  (Old System DB Table)';

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoforms_data_contract_list_vic`
--

DROP TABLE IF EXISTS `ver_chronoforms_data_contract_list_vic`;
CREATE TABLE IF NOT EXISTS `ver_chronoforms_data_contract_list_vic` (
`cf_id` int(11) NOT NULL,
  `quoteid` varchar(255) DEFAULT NULL,
  `projectid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `quotedate` datetime DEFAULT NULL,
  `contractdate` datetime DEFAULT NULL,
  `customer_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `site_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `sales_rep` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `project_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `framework_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `framework` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtotal_vergola` decimal(19,2) DEFAULT NULL,
  `subtotal_disbursement` decimal(19,2) DEFAULT NULL,
  `total_rrp` decimal(19,2) DEFAULT NULL,
  `total_rrp_gst` decimal(19,2) DEFAULT NULL,
  `total_cost` decimal(19,2) DEFAULT NULL,
  `total_cost_gst` decimal(19,2) DEFAULT NULL,
  `sales_comm` decimal(19,2) DEFAULT NULL,
  `install_comm` decimal(19,2) DEFAULT NULL,
  `sales_comm_cost` decimal(19,2) DEFAULT NULL,
  `install_comm_cost` decimal(19,2) DEFAULT NULL,
  `rep_id` varchar(45) DEFAULT NULL,
  `date_won` date DEFAULT NULL,
  `site_address2` varchar(255) DEFAULT NULL,
  `site_suburb` varchar(45) DEFAULT NULL,
  `site_state` varchar(45) DEFAULT NULL,
  `site_postcode` varchar(45) DEFAULT NULL,
  `building_permit_type` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_builder_project` int(11) DEFAULT '0',
  `is_tender_quote` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=939 DEFAULT CHARSET=latin1 COMMENT=' is_builder is a column to determine if the quote was for a builder use in sales report.';

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoforms_data_contract_po_old_sys_vic`
--

DROP TABLE IF EXISTS `ver_chronoforms_data_contract_po_old_sys_vic`;
CREATE TABLE IF NOT EXISTS `ver_chronoforms_data_contract_po_old_sys_vic` (
`id` int(11) NOT NULL,
  `aid` varchar(45) DEFAULT NULL,
  `order_no` varchar(45) DEFAULT NULL,
  `projectid` varchar(45) DEFAULT NULL,
  `supplierid` varchar(45) DEFAULT NULL,
  `sup_name` varchar(255) DEFAULT NULL,
  `date_entered` date DEFAULT NULL,
  `required_date` date DEFAULT NULL,
  `required_by` varchar(45) DEFAULT NULL,
  `acc_no` varchar(45) DEFAULT NULL,
  `contract_no` varchar(45) DEFAULT NULL,
  `auth_by` varchar(45) DEFAULT NULL,
  `deliver_to` varchar(45) DEFAULT NULL,
  `deliver_to_add1` varchar(45) DEFAULT NULL,
  `deliver_to_add2` varchar(45) DEFAULT NULL,
  `deliver_to_suburb` varchar(45) DEFAULT NULL,
  `deliver_to_state` varchar(45) DEFAULT NULL,
  `deliver_to_postcode` varchar(45) DEFAULT NULL,
  `total_ex_gst` varchar(45) DEFAULT NULL,
  `gst` varchar(45) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `close_order` varchar(45) DEFAULT NULL,
  `notes` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5306 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoforms_data_contract_statutory_vic`
--

DROP TABLE IF EXISTS `ver_chronoforms_data_contract_statutory_vic`;
CREATE TABLE IF NOT EXISTS `ver_chronoforms_data_contract_statutory_vic` (
`cf_id` int(11) NOT NULL,
  `quoteid` varchar(255) DEFAULT NULL,
  `projectid` varchar(255) DEFAULT NULL,
  `quotedate` datetime DEFAULT NULL,
  `contractdate` datetime DEFAULT NULL,
  `council` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `material_due_date` datetime DEFAULT NULL,
  `permit_application_date` datetime DEFAULT NULL,
  `permit_issued_date` datetime DEFAULT NULL,
  `planning_application_date` datetime DEFAULT NULL,
  `planning_application_followup` datetime DEFAULT NULL,
  `planning_approval_date` datetime DEFAULT NULL,
  `warranty_insurance_date` datetime DEFAULT NULL,
  `certifier_date` datetime DEFAULT NULL,
  `da_date` datetime DEFAULT NULL COMMENT 'development approval',
  `stat_req_easement_waterboard_approval_date` datetime DEFAULT NULL,
  `stat_req_easement_waterboard_followup` datetime DEFAULT NULL,
  `stat_req_easement_council_followup` datetime DEFAULT NULL,
  `stat_req_easement_council_approval_date` datetime DEFAULT NULL,
  `stat_req_planning` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `stat_req_planning_approval_date` datetime DEFAULT NULL,
  `engineering_approved_date` datetime DEFAULT NULL,
  `engineering_approved_date_followup` datetime DEFAULT NULL,
  `m_o_d` varchar(45) CHARACTER SET utf8 DEFAULT 'No',
  `m_o_d_followup` datetime DEFAULT NULL,
  `contract_note_number` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `permit_approved_date` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `citb` datetime DEFAULT NULL,
  `dev_application_date` datetime DEFAULT NULL,
  `dev_application_followup` datetime DEFAULT NULL,
  `bldg_rules_application` datetime DEFAULT NULL,
  `bldg_rules_approval` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1878 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoforms_data_contract_vergola_vic`
--

DROP TABLE IF EXISTS `ver_chronoforms_data_contract_vergola_vic`;
CREATE TABLE IF NOT EXISTS `ver_chronoforms_data_contract_vergola_vic` (
`cf_id` int(11) NOT NULL,
  `quoteid` varchar(255) DEFAULT NULL,
  `projectid` varchar(255) DEFAULT NULL,
  `quotedate` datetime DEFAULT NULL,
  `contractdate` datetime DEFAULT NULL,
  `check_measurer` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `check_measure_date` datetime DEFAULT NULL,
  `recheck_measure_date` datetime DEFAULT NULL,
  `drawing_prepare_date` datetime DEFAULT NULL,
  `drawing_prepare_date_followup` datetime DEFAULT NULL,
  `drawing_approve_date` datetime DEFAULT NULL,
  `drawing_approve_date_followup` datetime DEFAULT NULL,
  `production_start_date` datetime DEFAULT NULL,
  `production_complete_date` datetime DEFAULT NULL,
  `erectors_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `erectors_name2` varchar(100) DEFAULT NULL,
  `client_notified_date` datetime DEFAULT NULL,
  `erector_notified_date` datetime DEFAULT NULL,
  `warranty_start_date` date DEFAULT NULL,
  `elect_warranty_end_date` date DEFAULT NULL,
  `warranty_end_date` date DEFAULT NULL,
  `job_start_date` datetime DEFAULT NULL,
  `job_start_date_followup` datetime DEFAULT NULL,
  `job_end_date` datetime DEFAULT NULL,
  `final_inspection_date` datetime DEFAULT NULL,
  `install_date` date DEFAULT NULL,
  `building_permit_type` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `building_permit_issued` date DEFAULT NULL,
  `planning_dispensation_required` int(11) DEFAULT '0',
  `modification_required` int(11) DEFAULT '0',
  `modification_application` date DEFAULT NULL,
  `modification_approved` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `footing_inspection_date` date DEFAULT NULL,
  `fw_orderdate` date DEFAULT NULL,
  `fw_complete` date DEFAULT NULL,
  `gutter_flashing_ordered` date DEFAULT NULL,
  `louvers_ordered` date DEFAULT NULL,
  `handover_date` date DEFAULT NULL,
  `time_frame_letter` date DEFAULT NULL,
  `schedule_completion` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1878 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoforms_data_drawings_vic`
--

DROP TABLE IF EXISTS `ver_chronoforms_data_drawings_vic`;
CREATE TABLE IF NOT EXISTS `ver_chronoforms_data_drawings_vic` (
`cf_id` int(11) NOT NULL,
  `clientid` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `datestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoforms_data_followup_vic`
--

DROP TABLE IF EXISTS `ver_chronoforms_data_followup_vic`;
CREATE TABLE IF NOT EXISTS `ver_chronoforms_data_followup_vic` (
`cf_id` int(11) NOT NULL,
  `sales_rep` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `quoteid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `projectid` varchar(255) DEFAULT NULL,
  `quotedate` datetime DEFAULT NULL,
  `qdelivered` datetime DEFAULT NULL,
  `ffdate1` datetime DEFAULT NULL,
  `ffdate2` datetime DEFAULT NULL,
  `ffdate3` datetime DEFAULT NULL,
  `project_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `framework_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtotal_vergola` decimal(19,2) DEFAULT NULL,
  `subtotal_disbursement` decimal(19,2) DEFAULT NULL,
  `total_rrp` decimal(19,2) DEFAULT NULL,
  `total_gst` decimal(19,2) DEFAULT NULL,
  `total_rrp_gst` decimal(19,2) DEFAULT NULL,
  `total_cost` decimal(19,2) DEFAULT NULL,
  `total_cost_gst` decimal(19,2) DEFAULT NULL,
  `gst_percent` decimal(19,2) DEFAULT NULL,
  `comm_percent` decimal(19,2) DEFAULT NULL,
  `sales_comm` decimal(19,2) DEFAULT NULL,
  `install_comm` decimal(19,2) DEFAULT NULL,
  `sales_comm_cost` decimal(19,2) DEFAULT NULL,
  `install_comm_cost` decimal(19,2) DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_deposit` decimal(19,2) DEFAULT '0.00',
  `payment_progress` decimal(19,2) DEFAULT '0.00',
  `payment_final` decimal(19,2) DEFAULT '0.00',
  `com_pay1` decimal(19,2) DEFAULT '0.00',
  `com_pay2` decimal(19,2) DEFAULT '0.00',
  `com_final` decimal(19,2) DEFAULT '0.00',
  `rep_id` varchar(45) DEFAULT NULL,
  `date_won` date DEFAULT NULL,
  `is_done` int(11) DEFAULT '0',
  `date_lost` date DEFAULT NULL,
  `date_entered` date DEFAULT NULL,
  `costing_date` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `date_contract_signed` date DEFAULT NULL,
  `date_contract_system_created` date DEFAULT NULL,
  `is_builder_project` int(11) DEFAULT '0',
  `length` float DEFAULT '0',
  `width` float DEFAULT '0',
  `bay` int(11) DEFAULT '1',
  `default_color` varchar(45) DEFAULT NULL,
  `is_tender_quote` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=8871 DEFAULT CHARSET=latin1 COMMENT=' is_builder is a column to determine if the quote was for a builder use in sales report.';

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoforms_data_followup_vic_1`
--

DROP TABLE IF EXISTS `ver_chronoforms_data_followup_vic_1`;
CREATE TABLE IF NOT EXISTS `ver_chronoforms_data_followup_vic_1` (
`cf_id` int(11) NOT NULL,
  `sales_rep` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `quoteid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `projectid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `quotedate` datetime DEFAULT NULL,
  `qdelivered` datetime DEFAULT NULL,
  `ffdate1` datetime DEFAULT NULL,
  `ffdate2` datetime DEFAULT NULL,
  `ffdate3` datetime DEFAULT NULL,
  `project_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `framework_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtotal_vergola` decimal(19,2) DEFAULT NULL,
  `subtotal_disbursement` decimal(19,2) DEFAULT NULL,
  `total_rrp` decimal(19,2) DEFAULT NULL,
  `total_gst` decimal(19,2) DEFAULT NULL,
  `total_rrp_gst` decimal(19,2) DEFAULT NULL,
  `total_cost` decimal(19,2) DEFAULT NULL,
  `total_cost_gst` decimal(19,2) DEFAULT NULL,
  `gst_percent` decimal(19,2) DEFAULT NULL,
  `comm_percent` decimal(19,2) DEFAULT NULL,
  `sales_comm` decimal(19,2) DEFAULT NULL,
  `install_comm` decimal(19,2) DEFAULT NULL,
  `sales_comm_cost` decimal(19,2) DEFAULT NULL,
  `install_comm_cost` decimal(19,2) DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_deposit` decimal(19,2) DEFAULT '0.00',
  `payment_progress` decimal(19,2) DEFAULT '0.00',
  `payment_final` decimal(19,2) DEFAULT '0.00',
  `com_pay1` decimal(19,2) DEFAULT '0.00',
  `com_pay2` decimal(19,2) DEFAULT '0.00',
  `com_final` decimal(19,2) DEFAULT '0.00',
  `rep_id` varchar(45) DEFAULT NULL,
  `date_won` date DEFAULT NULL,
  `is_done` int(11) DEFAULT '0',
  `date_lost` date DEFAULT NULL,
  `date_entered` date DEFAULT NULL,
  `costing_date` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `date_contract_signed` date DEFAULT NULL,
  `date_contract_system_created` date DEFAULT NULL,
  `is_builder_project` int(11) DEFAULT '0',
  `length` float DEFAULT '0',
  `width` float DEFAULT '0',
  `bay` int(11) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=5749 DEFAULT CHARSET=latin1 COMMENT=' is_builder is a column to determine if the quote was for a builder use in sales report.';

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoforms_data_image_vic`
--

DROP TABLE IF EXISTS `ver_chronoforms_data_image_vic`;
CREATE TABLE IF NOT EXISTS `ver_chronoforms_data_image_vic` (
`cf_id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoforms_data_installer_vic`
--

DROP TABLE IF EXISTS `ver_chronoforms_data_installer_vic`;
CREATE TABLE IF NOT EXISTS `ver_chronoforms_data_installer_vic` (
`cf_id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoforms_data_inventory_material_vic`
--

DROP TABLE IF EXISTS `ver_chronoforms_data_inventory_material_vic`;
CREATE TABLE IF NOT EXISTS `ver_chronoforms_data_inventory_material_vic` (
`id` int(11) NOT NULL,
  `inventoryid` varchar(45) NOT NULL,
  `materialid` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=888 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoforms_data_inventory_vic`
--

DROP TABLE IF EXISTS `ver_chronoforms_data_inventory_vic`;
CREATE TABLE IF NOT EXISTS `ver_chronoforms_data_inventory_vic` (
`cf_id` int(11) NOT NULL,
  `inventoryid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `section` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `category` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `uom` varchar(255) CHARACTER SET utf8 DEFAULT '0.00',
  `rrp` decimal(19,2) DEFAULT '0.00',
  `cost` decimal(19,2) DEFAULT '0.00',
  `po_description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `po_cost` float DEFAULT '0',
  `sup_id` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `type_of_order` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `gcode` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `fcode` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=294 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoforms_data_inventory_vic_old_system`
--

DROP TABLE IF EXISTS `ver_chronoforms_data_inventory_vic_old_system`;
CREATE TABLE IF NOT EXISTS `ver_chronoforms_data_inventory_vic_old_system` (
`cf_id` int(11) NOT NULL,
  `inventoryid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `section` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `category` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `uom` varchar(255) CHARACTER SET utf8 DEFAULT '0.00',
  `rrp` decimal(19,2) DEFAULT '0.00',
  `cost` decimal(19,2) DEFAULT '0.00',
  `po_description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `po_cost` float DEFAULT '0',
  `sup_id` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `type_of_order` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `gcode` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `fcode` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=250 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoforms_data_lead_vic`
--

DROP TABLE IF EXISTS `ver_chronoforms_data_lead_vic`;
CREATE TABLE IF NOT EXISTS `ver_chronoforms_data_lead_vic` (
`cf_id` int(11) NOT NULL,
  `lead` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoforms_data_letters_vic`
--

DROP TABLE IF EXISTS `ver_chronoforms_data_letters_vic`;
CREATE TABLE IF NOT EXISTS `ver_chronoforms_data_letters_vic` (
`cf_id` int(11) NOT NULL,
  `clientid` varchar(255) DEFAULT NULL,
  `template_name` varchar(255) DEFAULT NULL,
  `datecreated` varchar(255) NOT NULL,
  `template_content` longtext,
  `template_type` varchar(45) DEFAULT NULL,
  `has_upload_file` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1396 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoforms_data_materials_vic`
--

DROP TABLE IF EXISTS `ver_chronoforms_data_materials_vic`;
CREATE TABLE IF NOT EXISTS `ver_chronoforms_data_materials_vic` (
`cf_id` int(11) NOT NULL,
  `raw_description` varchar(255) DEFAULT NULL,
  `raw_cost` decimal(19,2) DEFAULT '0.00',
  `qty` int(11) DEFAULT '1',
  `uom` varchar(45) DEFAULT NULL,
  `supplierid` varchar(45) DEFAULT 'UNK',
  `is_per_length` int(11) DEFAULT '0',
  `length_per_ea` float DEFAULT '1',
  `length_per_ea_us` float DEFAULT '1',
  `is_main_item` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=188 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoforms_data_material_default_supplier_vic`
--

DROP TABLE IF EXISTS `ver_chronoforms_data_material_default_supplier_vic`;
CREATE TABLE IF NOT EXISTS `ver_chronoforms_data_material_default_supplier_vic` (
`cf_id` int(11) NOT NULL,
  `supplierid` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `inventoryid` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `materialid` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoforms_data_material_default_supplier_vic__x`
--

DROP TABLE IF EXISTS `ver_chronoforms_data_material_default_supplier_vic__x`;
CREATE TABLE IF NOT EXISTS `ver_chronoforms_data_material_default_supplier_vic__x` (
`cf_id` int(11) NOT NULL,
  `supplierid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `inventoryid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `materialid` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoforms_data_material_supplier_vic`
--

DROP TABLE IF EXISTS `ver_chronoforms_data_material_supplier_vic`;
CREATE TABLE IF NOT EXISTS `ver_chronoforms_data_material_supplier_vic` (
`cf_id` int(11) NOT NULL,
  `supplierid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `inventoryid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `materialid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `projectid` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1211 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoforms_data_material_supplier_vic__x`
--

DROP TABLE IF EXISTS `ver_chronoforms_data_material_supplier_vic__x`;
CREATE TABLE IF NOT EXISTS `ver_chronoforms_data_material_supplier_vic__x` (
`cf_id` int(11) NOT NULL,
  `supplierid` varchar(255) DEFAULT NULL,
  `inventoryid` varchar(255) DEFAULT NULL,
  `materialid` varchar(255) DEFAULT NULL,
  `projectid` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoforms_data_measurement_vic`
--

DROP TABLE IF EXISTS `ver_chronoforms_data_measurement_vic`;
CREATE TABLE IF NOT EXISTS `ver_chronoforms_data_measurement_vic` (
`cf_id` int(11) NOT NULL,
  `projectid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `framework_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `width` decimal(19,2) DEFAULT NULL,
  `length` decimal(19,2) DEFAULT NULL,
  `bay` decimal(19,2) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4134 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoforms_data_notes_vic`
--

DROP TABLE IF EXISTS `ver_chronoforms_data_notes_vic`;
CREATE TABLE IF NOT EXISTS `ver_chronoforms_data_notes_vic` (
`cf_id` int(11) NOT NULL,
  `clientid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `datenotes` datetime DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `content` longtext CHARACTER SET utf8,
  `actionid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `action_by` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `checked` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `completed` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `rep_id` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5191 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoforms_data_notes_vic_1`
--

DROP TABLE IF EXISTS `ver_chronoforms_data_notes_vic_1`;
CREATE TABLE IF NOT EXISTS `ver_chronoforms_data_notes_vic_1` (
`cf_id` int(11) NOT NULL,
  `clientid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `datenotes` datetime DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `content` longtext CHARACTER SET utf8,
  `actionid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `action_by` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `checked` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `completed` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `rep_id` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3967 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoforms_data_pics_vic`
--

DROP TABLE IF EXISTS `ver_chronoforms_data_pics_vic`;
CREATE TABLE IF NOT EXISTS `ver_chronoforms_data_pics_vic` (
`cf_id` int(11) NOT NULL,
  `clientid` varchar(255) DEFAULT NULL,
  `datestamp` datetime DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `upload_type` varchar(45) DEFAULT 'pic',
  `ref_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=535 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoforms_data_quote_vic`
--

DROP TABLE IF EXISTS `ver_chronoforms_data_quote_vic`;
CREATE TABLE IF NOT EXISTS `ver_chronoforms_data_quote_vic` (
`cf_id` int(11) NOT NULL,
  `quoteid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `inventoryid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `supplier_id` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `supplierid` varchar(45) DEFAULT NULL,
  `projectid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `project_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `framework_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `framework` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `length` decimal(19,2) DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `colour` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `webbing` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `finish` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `uom` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `rrp` decimal(19,2) DEFAULT NULL,
  `cost` decimal(19,2) DEFAULT NULL,
  `is_additional` int(11) DEFAULT '0',
  `cat_code` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `cat_desc` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=166380 DEFAULT CHARSET=latin1 COMMENT='supplier_id = supplier id for new system\nsupplierid = supplier id from old system';

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoforms_data_quote_vic_old_system`
--

DROP TABLE IF EXISTS `ver_chronoforms_data_quote_vic_old_system`;
CREATE TABLE IF NOT EXISTS `ver_chronoforms_data_quote_vic_old_system` (
`cf_id` int(11) NOT NULL,
  `quoteid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `inventoryid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `supplier_id` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `supplierid` varchar(45) DEFAULT NULL,
  `projectid` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `project_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `framework_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `framework` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `length` decimal(19,2) DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `colour` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `webbing` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `finish` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `uom` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `rrp` decimal(19,2) DEFAULT NULL,
  `cost` decimal(19,2) DEFAULT NULL,
  `is_additional` int(11) DEFAULT '0',
  `cat_code` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `cat_desc` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=223711 DEFAULT CHARSET=latin1 COMMENT='supplier_id = supplier id for new system\nsupplierid = supplier id from old system';

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoforms_data_section_vic`
--

DROP TABLE IF EXISTS `ver_chronoforms_data_section_vic`;
CREATE TABLE IF NOT EXISTS `ver_chronoforms_data_section_vic` (
`cf_id` int(11) NOT NULL,
  `section` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sectionid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoforms_data_suburbs_vic`
--

DROP TABLE IF EXISTS `ver_chronoforms_data_suburbs_vic`;
CREATE TABLE IF NOT EXISTS `ver_chronoforms_data_suburbs_vic` (
`cf_id` int(11) NOT NULL,
  `suburb_district` varchar(255) NOT NULL,
  `suburb` varchar(255) NOT NULL,
  `suburb_state` varchar(255) NOT NULL,
  `suburb_postcode` varchar(255) NOT NULL,
  `old_id` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11386 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoforms_data_suburbs_vic_state_sa`
--

DROP TABLE IF EXISTS `ver_chronoforms_data_suburbs_vic_state_sa`;
CREATE TABLE IF NOT EXISTS `ver_chronoforms_data_suburbs_vic_state_sa` (
`cf_id` int(11) NOT NULL,
  `suburb_state` varchar(255) DEFAULT NULL,
  `suburb` varchar(255) NOT NULL,
  `suburb_postcode` varchar(255) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `suburb_district` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1939 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoforms_data_supplier_vic`
--

DROP TABLE IF EXISTS `ver_chronoforms_data_supplier_vic`;
CREATE TABLE IF NOT EXISTS `ver_chronoforms_data_supplier_vic` (
`cf_id` int(11) NOT NULL,
  `supplierid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `suburbid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `company_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `sup_id` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `address1` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `address2` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `suburb` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `postcode` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `firstname` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoforms_data_systable_vic`
--

DROP TABLE IF EXISTS `ver_chronoforms_data_systable_vic`;
CREATE TABLE IF NOT EXISTS `ver_chronoforms_data_systable_vic` (
`cf_id` int(11) NOT NULL,
  `gst` decimal(19,2) DEFAULT NULL,
  `commision` decimal(19,2) DEFAULT NULL,
  `sales_comm` decimal(19,2) DEFAULT NULL,
  `install_comm` decimal(19,2) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoforms_data_travel_vic`
--

DROP TABLE IF EXISTS `ver_chronoforms_data_travel_vic`;
CREATE TABLE IF NOT EXISTS `ver_chronoforms_data_travel_vic` (
`cf_id` int(11) NOT NULL,
  `zone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cost` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoform_actions`
--

DROP TABLE IF EXISTS `ver_chronoform_actions`;
CREATE TABLE IF NOT EXISTS `ver_chronoform_actions` (
`id` int(11) NOT NULL,
  `chronoform_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `params` longtext NOT NULL,
  `order` int(11) NOT NULL,
  `content1` longtext NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4348 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoform_maintenance_case_job_vic`
--

DROP TABLE IF EXISTS `ver_chronoform_maintenance_case_job_vic`;
CREATE TABLE IF NOT EXISTS `ver_chronoform_maintenance_case_job_vic` (
`id` int(11) NOT NULL,
  `case_id` int(11) DEFAULT NULL,
  `maintenance_person` varchar(45) DEFAULT NULL,
  `note` text,
  `taken_by` varchar(45) DEFAULT NULL,
  `schedule_visit` datetime DEFAULT NULL,
  `site_visited` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ver_chronoform_maintenance_case_vic`
--

DROP TABLE IF EXISTS `ver_chronoform_maintenance_case_vic`;
CREATE TABLE IF NOT EXISTS `ver_chronoform_maintenance_case_vic` (
`id` int(11) NOT NULL,
  `projectid` varchar(45) DEFAULT NULL,
  `clientid` varchar(45) DEFAULT NULL,
  `caller_name` varchar(45) DEFAULT NULL,
  `taken_by` varchar(45) DEFAULT NULL,
  `issue` text,
  `maintenance_person` varchar(45) DEFAULT NULL,
  `schedule_visit` datetime DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `date_close` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ver_contact_details`
--

DROP TABLE IF EXISTS `ver_contact_details`;
CREATE TABLE IF NOT EXISTS `ver_contact_details` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `con_position` varchar(255) DEFAULT NULL,
  `address` text,
  `suburb` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `postcode` varchar(100) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `misc` mediumtext,
  `image` varchar(255) DEFAULT NULL,
  `imagepos` varchar(20) DEFAULT NULL,
  `email_to` varchar(255) DEFAULT NULL,
  `default_con` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `catid` int(11) NOT NULL DEFAULT '0',
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `mobile` varchar(255) NOT NULL DEFAULT '',
  `webpage` varchar(255) NOT NULL DEFAULT '',
  `sortname1` varchar(255) NOT NULL,
  `sortname2` varchar(255) NOT NULL,
  `sortname3` varchar(255) NOT NULL,
  `language` char(7) NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `metadata` text NOT NULL,
  `featured` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Set if article is featured.',
  `xreference` varchar(50) NOT NULL COMMENT 'A reference to enable linkages to external data sets.',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_content`
--

DROP TABLE IF EXISTS `ver_content`;
CREATE TABLE IF NOT EXISTS `ver_content` (
`id` int(10) unsigned NOT NULL,
  `asset_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to the ver_assets table.',
  `title` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `title_alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT 'Deprecated in Joomla! 3.0',
  `introtext` mediumtext NOT NULL,
  `fulltext` mediumtext NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `sectionid` int(10) unsigned NOT NULL DEFAULT '0',
  `mask` int(10) unsigned NOT NULL DEFAULT '0',
  `catid` int(10) unsigned NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `images` text NOT NULL,
  `urls` text NOT NULL,
  `attribs` varchar(5120) NOT NULL,
  `version` int(10) unsigned NOT NULL DEFAULT '1',
  `parentid` int(10) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `metadata` text NOT NULL,
  `featured` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Set if article is featured.',
  `language` char(7) NOT NULL COMMENT 'The language code for the article.',
  `xreference` varchar(50) NOT NULL COMMENT 'A reference to enable linkages to external data sets.'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_content_frontpage`
--

DROP TABLE IF EXISTS `ver_content_frontpage`;
CREATE TABLE IF NOT EXISTS `ver_content_frontpage` (
  `content_id` int(11) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_content_rating`
--

DROP TABLE IF EXISTS `ver_content_rating`;
CREATE TABLE IF NOT EXISTS `ver_content_rating` (
  `content_id` int(11) NOT NULL DEFAULT '0',
  `rating_sum` int(10) unsigned NOT NULL DEFAULT '0',
  `rating_count` int(10) unsigned NOT NULL DEFAULT '0',
  `lastip` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_core_log_searches`
--

DROP TABLE IF EXISTS `ver_core_log_searches`;
CREATE TABLE IF NOT EXISTS `ver_core_log_searches` (
  `search_term` varchar(128) NOT NULL DEFAULT '',
  `hits` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_extensions`
--

DROP TABLE IF EXISTS `ver_extensions`;
CREATE TABLE IF NOT EXISTS `ver_extensions` (
`extension_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `element` varchar(100) NOT NULL,
  `folder` varchar(100) NOT NULL,
  `client_id` tinyint(3) NOT NULL,
  `enabled` tinyint(3) NOT NULL DEFAULT '1',
  `access` int(10) unsigned NOT NULL DEFAULT '1',
  `protected` tinyint(3) NOT NULL DEFAULT '0',
  `manifest_cache` text NOT NULL,
  `params` text NOT NULL,
  `custom_data` text NOT NULL,
  `system_data` text NOT NULL,
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) DEFAULT '0',
  `state` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=865 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_finder_filters`
--

DROP TABLE IF EXISTS `ver_finder_filters`;
CREATE TABLE IF NOT EXISTS `ver_finder_filters` (
`filter_id` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL,
  `created_by_alias` varchar(255) NOT NULL,
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `map_count` int(10) unsigned NOT NULL DEFAULT '0',
  `data` text NOT NULL,
  `params` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_finder_links`
--

DROP TABLE IF EXISTS `ver_finder_links`;
CREATE TABLE IF NOT EXISTS `ver_finder_links` (
`link_id` int(10) unsigned NOT NULL,
  `url` varchar(255) NOT NULL,
  `route` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `indexdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `md5sum` varchar(32) DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `state` int(5) DEFAULT '1',
  `access` int(5) DEFAULT '0',
  `language` varchar(8) NOT NULL,
  `publish_start_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_end_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `start_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `end_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `list_price` double unsigned NOT NULL DEFAULT '0',
  `sale_price` double unsigned NOT NULL DEFAULT '0',
  `type_id` int(11) NOT NULL,
  `object` mediumblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_finder_links_terms0`
--

DROP TABLE IF EXISTS `ver_finder_links_terms0`;
CREATE TABLE IF NOT EXISTS `ver_finder_links_terms0` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_finder_links_terms1`
--

DROP TABLE IF EXISTS `ver_finder_links_terms1`;
CREATE TABLE IF NOT EXISTS `ver_finder_links_terms1` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_finder_links_terms2`
--

DROP TABLE IF EXISTS `ver_finder_links_terms2`;
CREATE TABLE IF NOT EXISTS `ver_finder_links_terms2` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_finder_links_terms3`
--

DROP TABLE IF EXISTS `ver_finder_links_terms3`;
CREATE TABLE IF NOT EXISTS `ver_finder_links_terms3` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_finder_links_terms4`
--

DROP TABLE IF EXISTS `ver_finder_links_terms4`;
CREATE TABLE IF NOT EXISTS `ver_finder_links_terms4` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_finder_links_terms5`
--

DROP TABLE IF EXISTS `ver_finder_links_terms5`;
CREATE TABLE IF NOT EXISTS `ver_finder_links_terms5` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_finder_links_terms6`
--

DROP TABLE IF EXISTS `ver_finder_links_terms6`;
CREATE TABLE IF NOT EXISTS `ver_finder_links_terms6` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_finder_links_terms7`
--

DROP TABLE IF EXISTS `ver_finder_links_terms7`;
CREATE TABLE IF NOT EXISTS `ver_finder_links_terms7` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_finder_links_terms8`
--

DROP TABLE IF EXISTS `ver_finder_links_terms8`;
CREATE TABLE IF NOT EXISTS `ver_finder_links_terms8` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_finder_links_terms9`
--

DROP TABLE IF EXISTS `ver_finder_links_terms9`;
CREATE TABLE IF NOT EXISTS `ver_finder_links_terms9` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_finder_links_termsa`
--

DROP TABLE IF EXISTS `ver_finder_links_termsa`;
CREATE TABLE IF NOT EXISTS `ver_finder_links_termsa` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_finder_links_termsb`
--

DROP TABLE IF EXISTS `ver_finder_links_termsb`;
CREATE TABLE IF NOT EXISTS `ver_finder_links_termsb` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_finder_links_termsc`
--

DROP TABLE IF EXISTS `ver_finder_links_termsc`;
CREATE TABLE IF NOT EXISTS `ver_finder_links_termsc` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_finder_links_termsd`
--

DROP TABLE IF EXISTS `ver_finder_links_termsd`;
CREATE TABLE IF NOT EXISTS `ver_finder_links_termsd` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_finder_links_termse`
--

DROP TABLE IF EXISTS `ver_finder_links_termse`;
CREATE TABLE IF NOT EXISTS `ver_finder_links_termse` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_finder_links_termsf`
--

DROP TABLE IF EXISTS `ver_finder_links_termsf`;
CREATE TABLE IF NOT EXISTS `ver_finder_links_termsf` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_finder_taxonomy`
--

DROP TABLE IF EXISTS `ver_finder_taxonomy`;
CREATE TABLE IF NOT EXISTS `ver_finder_taxonomy` (
`id` int(10) unsigned NOT NULL,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `state` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `access` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ordering` tinyint(1) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_finder_taxonomy_map`
--

DROP TABLE IF EXISTS `ver_finder_taxonomy_map`;
CREATE TABLE IF NOT EXISTS `ver_finder_taxonomy_map` (
  `link_id` int(10) unsigned NOT NULL,
  `node_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_finder_terms`
--

DROP TABLE IF EXISTS `ver_finder_terms`;
CREATE TABLE IF NOT EXISTS `ver_finder_terms` (
`term_id` int(10) unsigned NOT NULL,
  `term` varchar(75) NOT NULL,
  `stem` varchar(75) NOT NULL,
  `common` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `phrase` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `weight` float unsigned NOT NULL DEFAULT '0',
  `soundex` varchar(75) NOT NULL,
  `links` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_finder_terms_common`
--

DROP TABLE IF EXISTS `ver_finder_terms_common`;
CREATE TABLE IF NOT EXISTS `ver_finder_terms_common` (
  `term` varchar(75) NOT NULL,
  `language` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_finder_tokens`
--

DROP TABLE IF EXISTS `ver_finder_tokens`;
CREATE TABLE IF NOT EXISTS `ver_finder_tokens` (
  `term` varchar(75) NOT NULL,
  `stem` varchar(75) NOT NULL,
  `common` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `phrase` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `weight` float unsigned NOT NULL DEFAULT '1',
  `context` tinyint(1) unsigned NOT NULL DEFAULT '2'
) ENGINE=MEMORY DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_finder_tokens_aggregate`
--

DROP TABLE IF EXISTS `ver_finder_tokens_aggregate`;
CREATE TABLE IF NOT EXISTS `ver_finder_tokens_aggregate` (
  `term_id` int(10) unsigned NOT NULL,
  `map_suffix` char(1) NOT NULL,
  `term` varchar(75) NOT NULL,
  `stem` varchar(75) NOT NULL,
  `common` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `phrase` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `term_weight` float unsigned NOT NULL,
  `context` tinyint(1) unsigned NOT NULL DEFAULT '2',
  `context_weight` float unsigned NOT NULL,
  `total_weight` float unsigned NOT NULL
) ENGINE=MEMORY DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_finder_types`
--

DROP TABLE IF EXISTS `ver_finder_types`;
CREATE TABLE IF NOT EXISTS `ver_finder_types` (
`id` int(10) unsigned NOT NULL,
  `title` varchar(100) NOT NULL,
  `mime` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_languages`
--

DROP TABLE IF EXISTS `ver_languages`;
CREATE TABLE IF NOT EXISTS `ver_languages` (
`lang_id` int(11) unsigned NOT NULL,
  `lang_code` char(7) NOT NULL,
  `title` varchar(50) NOT NULL,
  `title_native` varchar(50) NOT NULL,
  `sef` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `description` varchar(512) NOT NULL,
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `sitename` varchar(1024) NOT NULL DEFAULT '',
  `published` int(11) NOT NULL DEFAULT '0',
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_menu`
--

DROP TABLE IF EXISTS `ver_menu`;
CREATE TABLE IF NOT EXISTS `ver_menu` (
`id` int(11) NOT NULL,
  `menutype` varchar(24) NOT NULL COMMENT 'The type of menu this item belongs to. FK to ver_menu_types.menutype',
  `title` varchar(255) NOT NULL COMMENT 'The display title of the menu item.',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'The SEF alias of the menu item.',
  `note` varchar(255) NOT NULL DEFAULT '',
  `path` varchar(1024) NOT NULL COMMENT 'The computed path of the menu item based on the alias field.',
  `link` varchar(1024) NOT NULL COMMENT 'The actually link the menu item refers to.',
  `type` varchar(16) NOT NULL COMMENT 'The type of link: Component, URL, Alias, Separator',
  `published` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'The published state of the menu link.',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '1' COMMENT 'The parent menu item in the menu tree.',
  `level` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'The relative level in the tree.',
  `component_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to ver_extensions.id',
  `ordering` int(11) NOT NULL DEFAULT '0' COMMENT 'The relative ordering of the menu item in the tree.',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to ver_users.id',
  `checked_out_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'The time the menu item was checked out.',
  `browserNav` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'The click behaviour of the link.',
  `access` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'The access level required to view the menu item.',
  `img` varchar(255) NOT NULL COMMENT 'The image of the menu item.',
  `template_style_id` int(10) unsigned NOT NULL DEFAULT '0',
  `params` text NOT NULL COMMENT 'JSON encoded data for the menu item.',
  `lft` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set lft.',
  `rgt` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set rgt.',
  `home` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Indicates if this menu item is the home or default page.',
  `language` char(7) NOT NULL DEFAULT '',
  `client_id` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=201 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_menu_types`
--

DROP TABLE IF EXISTS `ver_menu_types`;
CREATE TABLE IF NOT EXISTS `ver_menu_types` (
`id` int(10) unsigned NOT NULL,
  `menutype` varchar(24) NOT NULL,
  `title` varchar(48) NOT NULL,
  `description` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_messages`
--

DROP TABLE IF EXISTS `ver_messages`;
CREATE TABLE IF NOT EXISTS `ver_messages` (
`message_id` int(10) unsigned NOT NULL,
  `user_id_from` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id_to` int(10) unsigned NOT NULL DEFAULT '0',
  `folder_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `priority` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `subject` varchar(255) NOT NULL DEFAULT '',
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_messages_cfg`
--

DROP TABLE IF EXISTS `ver_messages_cfg`;
CREATE TABLE IF NOT EXISTS `ver_messages_cfg` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `cfg_name` varchar(100) NOT NULL DEFAULT '',
  `cfg_value` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_modules`
--

DROP TABLE IF EXISTS `ver_modules`;
CREATE TABLE IF NOT EXISTS `ver_modules` (
`id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL DEFAULT '',
  `note` varchar(255) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `position` varchar(50) NOT NULL DEFAULT '',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `module` varchar(50) DEFAULT NULL,
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `showtitle` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `params` text NOT NULL,
  `client_id` tinyint(4) NOT NULL DEFAULT '0',
  `language` char(7) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_modules_menu`
--

DROP TABLE IF EXISTS `ver_modules_menu`;
CREATE TABLE IF NOT EXISTS `ver_modules_menu` (
  `moduleid` int(11) NOT NULL DEFAULT '0',
  `menuid` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_newsfeeds`
--

DROP TABLE IF EXISTS `ver_newsfeeds`;
CREATE TABLE IF NOT EXISTS `ver_newsfeeds` (
  `catid` int(11) NOT NULL DEFAULT '0',
`id` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `link` varchar(200) NOT NULL DEFAULT '',
  `filename` varchar(200) DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `numarticles` int(10) unsigned NOT NULL DEFAULT '1',
  `cache_time` int(10) unsigned NOT NULL DEFAULT '3600',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `rtl` tinyint(4) NOT NULL DEFAULT '0',
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `language` char(7) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `metadata` text NOT NULL,
  `xreference` varchar(50) NOT NULL COMMENT 'A reference to enable linkages to external data sets.',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_overrider`
--

DROP TABLE IF EXISTS `ver_overrider`;
CREATE TABLE IF NOT EXISTS `ver_overrider` (
`id` int(10) NOT NULL COMMENT 'Primary Key',
  `constant` varchar(255) NOT NULL,
  `string` text NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_profiler`
--

DROP TABLE IF EXISTS `ver_profiler`;
CREATE TABLE IF NOT EXISTS `ver_profiler` (
  `id` int(11) NOT NULL,
  `readaccess` int(11) NOT NULL,
  `access` int(11) NOT NULL DEFAULT '0',
  `deleteaccess` int(11) NOT NULL,
  `registeraccess` int(11) NOT NULL,
  `accessroprivate` int(11) NOT NULL DEFAULT '2',
  `accessprivate` int(11) NOT NULL DEFAULT '2'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_profiler_categories`
--

DROP TABLE IF EXISTS `ver_profiler_categories`;
CREATE TABLE IF NOT EXISTS `ver_profiler_categories` (
`id` int(11) NOT NULL,
  `extension` varchar(50) NOT NULL DEFAULT '',
  `type` varchar(50) NOT NULL,
  `extension_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `ordering` int(11) NOT NULL,
  `description` mediumtext NOT NULL,
  `template` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_profiler_fieldgroupprofile`
--

DROP TABLE IF EXISTS `ver_profiler_fieldgroupprofile`;
CREATE TABLE IF NOT EXISTS `ver_profiler_fieldgroupprofile` (
`id` int(11) NOT NULL,
  `catid` int(11) NOT NULL,
  `profile` int(11) NOT NULL,
  `published` int(11) NOT NULL,
  `registration` int(11) NOT NULL,
  `readonly` int(11) NOT NULL,
  `access` int(11) NOT NULL,
  `accessro` int(11) NOT NULL,
  `accessreg` int(11) NOT NULL,
  `accessroprivate` int(11) NOT NULL,
  `accessprivate` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_profiler_fieldprofile`
--

DROP TABLE IF EXISTS `ver_profiler_fieldprofile`;
CREATE TABLE IF NOT EXISTS `ver_profiler_fieldprofile` (
`id` int(11) NOT NULL,
  `fieldid` int(11) NOT NULL,
  `profile` int(11) NOT NULL,
  `published` int(11) NOT NULL,
  `required` int(11) NOT NULL,
  `accessrequired` int(11) NOT NULL,
  `registration` int(11) NOT NULL,
  `readonly` int(11) NOT NULL,
  `access` int(11) NOT NULL,
  `accessro` int(11) NOT NULL,
  `accessreg` int(11) NOT NULL,
  `accessroprivate` int(11) NOT NULL,
  `accessprivate` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_profiler_fields`
--

DROP TABLE IF EXISTS `ver_profiler_fields`;
CREATE TABLE IF NOT EXISTS `ver_profiler_fields` (
`id` int(11) NOT NULL,
  `extension` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '',
  `table` varchar(50) NOT NULL DEFAULT 'ver_profiler',
  `ordering` int(11) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `value` mediumtext NOT NULL,
  `multiple` int(11) NOT NULL,
  `description` mediumtext NOT NULL,
  `type` varchar(50) NOT NULL DEFAULT '',
  `maxlength` int(11) DEFAULT NULL,
  `minlength` int(11) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `catid` int(10) unsigned NOT NULL DEFAULT '0',
  `cols` int(11) DEFAULT NULL,
  `rows` int(11) DEFAULT NULL,
  `default` mediumtext,
  `accept` text NOT NULL,
  `displaytitle` tinyint(1) NOT NULL DEFAULT '1',
  `sys` tinyint(4) NOT NULL DEFAULT '0',
  `regex` mediumtext,
  `error` mediumtext,
  `forbidden` mediumtext,
  `format` varchar(50) NOT NULL,
  `inputformat` varchar(50) NOT NULL,
  `mimeenable` mediumtext NOT NULL,
  `extensionsenable` mediumtext NOT NULL,
  `query` mediumtext NOT NULL,
  `param` text NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_profiler_groups`
--

DROP TABLE IF EXISTS `ver_profiler_groups`;
CREATE TABLE IF NOT EXISTS `ver_profiler_groups` (
`groupid` int(11) NOT NULL,
  `groupname` varchar(255) NOT NULL DEFAULT '',
  `groupemail` varchar(100) NOT NULL DEFAULT '',
  `groupblock` tinyint(4) NOT NULL DEFAULT '0',
  `groupregisterDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_profiler_import`
--

DROP TABLE IF EXISTS `ver_profiler_import`;
CREATE TABLE IF NOT EXISTS `ver_profiler_import` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `params` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_profiler_usergroup_map`
--

DROP TABLE IF EXISTS `ver_profiler_usergroup_map`;
CREATE TABLE IF NOT EXISTS `ver_profiler_usergroup_map` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `group_id` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_profiler_users`
--

DROP TABLE IF EXISTS `ver_profiler_users`;
CREATE TABLE IF NOT EXISTS `ver_profiler_users` (
`id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `hits` int(11) NOT NULL DEFAULT '0',
  `avatar` varchar(255) DEFAULT NULL,
  `lastupdatedate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `registeripaddr` varchar(50) NOT NULL DEFAULT '',
  `registeredby` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `registerDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_redirect_links`
--

DROP TABLE IF EXISTS `ver_redirect_links`;
CREATE TABLE IF NOT EXISTS `ver_redirect_links` (
`id` int(10) unsigned NOT NULL,
  `old_url` varchar(255) NOT NULL,
  `new_url` varchar(255) NOT NULL,
  `referer` varchar(150) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `published` tinyint(4) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_rep_sales_target`
--

DROP TABLE IF EXISTS `ver_rep_sales_target`;
CREATE TABLE IF NOT EXISTS `ver_rep_sales_target` (
`id` int(11) NOT NULL,
  `rep_id` varchar(45) DEFAULT NULL,
  `sales_amount` float DEFAULT '0',
  `target_contract` float DEFAULT NULL,
  `target_amount` float DEFAULT '0',
  `target_date` date DEFAULT NULL,
  `dateFromTo` varchar(45) DEFAULT NULL,
  `year` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=672 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ver_schemas`
--

DROP TABLE IF EXISTS `ver_schemas`;
CREATE TABLE IF NOT EXISTS `ver_schemas` (
  `extension_id` int(11) NOT NULL,
  `version_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_session`
--

DROP TABLE IF EXISTS `ver_session`;
CREATE TABLE IF NOT EXISTS `ver_session` (
  `session_id` varchar(200) NOT NULL DEFAULT '',
  `client_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `guest` tinyint(4) unsigned DEFAULT '1',
  `time` varchar(14) DEFAULT '',
  `data` mediumtext,
  `userid` int(11) DEFAULT '0',
  `username` varchar(150) DEFAULT '',
  `usertype` varchar(50) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_template_styles`
--

DROP TABLE IF EXISTS `ver_template_styles`;
CREATE TABLE IF NOT EXISTS `ver_template_styles` (
`id` int(10) unsigned NOT NULL,
  `template` varchar(50) NOT NULL DEFAULT '',
  `client_id` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `home` char(7) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `params` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_updates`
--

DROP TABLE IF EXISTS `ver_updates`;
CREATE TABLE IF NOT EXISTS `ver_updates` (
`update_id` int(11) NOT NULL,
  `update_site_id` int(11) DEFAULT '0',
  `extension_id` int(11) DEFAULT '0',
  `categoryid` int(11) DEFAULT '0',
  `name` varchar(100) DEFAULT '',
  `description` text NOT NULL,
  `element` varchar(100) DEFAULT '',
  `type` varchar(20) DEFAULT '',
  `folder` varchar(20) DEFAULT '',
  `client_id` tinyint(3) DEFAULT '0',
  `version` varchar(10) DEFAULT '',
  `data` text NOT NULL,
  `detailsurl` text NOT NULL,
  `infourl` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=381 DEFAULT CHARSET=utf8 COMMENT='Available Updates';

-- --------------------------------------------------------

--
-- Table structure for table `ver_update_categories`
--

DROP TABLE IF EXISTS `ver_update_categories`;
CREATE TABLE IF NOT EXISTS `ver_update_categories` (
`categoryid` int(11) NOT NULL,
  `name` varchar(20) DEFAULT '',
  `description` text NOT NULL,
  `parent` int(11) DEFAULT '0',
  `updatesite` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Update Categories';

-- --------------------------------------------------------

--
-- Table structure for table `ver_update_sites`
--

DROP TABLE IF EXISTS `ver_update_sites`;
CREATE TABLE IF NOT EXISTS `ver_update_sites` (
`update_site_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT '',
  `type` varchar(20) DEFAULT '',
  `location` text NOT NULL,
  `enabled` int(11) DEFAULT '0',
  `last_check_timestamp` bigint(20) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='Update Sites';

-- --------------------------------------------------------

--
-- Table structure for table `ver_update_sites_extensions`
--

DROP TABLE IF EXISTS `ver_update_sites_extensions`;
CREATE TABLE IF NOT EXISTS `ver_update_sites_extensions` (
  `update_site_id` int(11) NOT NULL DEFAULT '0',
  `extension_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Links extensions to update sites';

-- --------------------------------------------------------

--
-- Table structure for table `ver_usergroups`
--

DROP TABLE IF EXISTS `ver_usergroups`;
CREATE TABLE IF NOT EXISTS `ver_usergroups` (
`id` int(10) unsigned NOT NULL COMMENT 'Primary Key',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Adjacency List Reference Id',
  `lft` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set lft.',
  `rgt` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set rgt.',
  `title` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_users`
--

DROP TABLE IF EXISTS `ver_users`;
CREATE TABLE IF NOT EXISTS `ver_users` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(150) NOT NULL DEFAULT '',
  `email` varchar(100) DEFAULT '',
  `password` varchar(100) DEFAULT '',
  `usertype` varchar(25) DEFAULT 'Victoria Users',
  `block` tinyint(4) DEFAULT '0',
  `sendEmail` tinyint(4) DEFAULT '0',
  `registerDate` datetime DEFAULT '0000-00-00 00:00:00',
  `lastvisitDate` datetime DEFAULT '0000-00-00 00:00:00',
  `activation` varchar(100) DEFAULT '',
  `params` text,
  `lastResetTime` datetime DEFAULT '0000-00-00 00:00:00' COMMENT 'Date of last password reset',
  `resetCount` int(11) DEFAULT '0' COMMENT 'Count of password resets since lastResetTime',
  `phone` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `abn` varchar(255) DEFAULT NULL,
  `RepID` varchar(255) DEFAULT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_user_notes`
--

DROP TABLE IF EXISTS `ver_user_notes`;
CREATE TABLE IF NOT EXISTS `ver_user_notes` (
`id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `catid` int(10) unsigned NOT NULL DEFAULT '0',
  `subject` varchar(100) NOT NULL DEFAULT '',
  `body` text NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_user_id` int(10) unsigned NOT NULL,
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `review_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_user_profiles`
--

DROP TABLE IF EXISTS `ver_user_profiles`;
CREATE TABLE IF NOT EXISTS `ver_user_profiles` (
  `user_id` int(11) NOT NULL,
  `profile_key` varchar(100) NOT NULL,
  `profile_value` varchar(255) NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Simple user profile storage table';

-- --------------------------------------------------------

--
-- Table structure for table `ver_user_usergroup_map`
--

DROP TABLE IF EXISTS `ver_user_usergroup_map`;
CREATE TABLE IF NOT EXISTS `ver_user_usergroup_map` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Foreign Key to ver_users.id',
  `group_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Foreign Key to ver_usergroups.id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_vergola_default_framework_items`
--

DROP TABLE IF EXISTS `ver_vergola_default_framework_items`;
CREATE TABLE IF NOT EXISTS `ver_vergola_default_framework_items` (
`id` int(11) NOT NULL,
  `framework` varchar(150) DEFAULT NULL,
  `inventoryid` varchar(45) DEFAULT NULL,
  `qty` int(11) DEFAULT '1',
  `section` varchar(45) DEFAULT NULL,
  `category` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=758 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ver_vergola_default_framework_items_old1`
--

DROP TABLE IF EXISTS `ver_vergola_default_framework_items_old1`;
CREATE TABLE IF NOT EXISTS `ver_vergola_default_framework_items_old1` (
`id` int(11) NOT NULL,
  `framework` varchar(150) DEFAULT NULL,
  `inventoryid` varchar(45) DEFAULT NULL,
  `qty` int(11) DEFAULT '1',
  `section` varchar(45) DEFAULT NULL,
  `category` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=321 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ver_viewlevels`
--

DROP TABLE IF EXISTS `ver_viewlevels`;
CREATE TABLE IF NOT EXISTS `ver_viewlevels` (
`id` int(10) unsigned NOT NULL COMMENT 'Primary Key',
  `title` varchar(100) NOT NULL DEFAULT '',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `rules` varchar(5120) NOT NULL COMMENT 'JSON encoded access control.'
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ver_weblinks`
--

DROP TABLE IF EXISTS `ver_weblinks`;
CREATE TABLE IF NOT EXISTS `ver_weblinks` (
`id` int(10) unsigned NOT NULL,
  `catid` int(11) NOT NULL DEFAULT '0',
  `sid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(250) NOT NULL DEFAULT '',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `url` varchar(250) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hits` int(11) NOT NULL DEFAULT '0',
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `archived` tinyint(1) NOT NULL DEFAULT '0',
  `approved` tinyint(1) NOT NULL DEFAULT '1',
  `access` int(11) NOT NULL DEFAULT '1',
  `params` text NOT NULL,
  `language` char(7) NOT NULL DEFAULT '',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `metadata` text NOT NULL,
  `featured` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Set if link is featured.',
  `xreference` varchar(50) NOT NULL COMMENT 'A reference to enable linkages to external data sets.',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_inventory_materials`
--
DROP VIEW IF EXISTS `v_inventory_materials`;
CREATE TABLE IF NOT EXISTS `v_inventory_materials` (
`inventoryid` varchar(45)
,`materialid` int(11)
,`description` varchar(255)
,`raw_description` varchar(255)
,`raw_cost` decimal(19,2)
,`company_name` varchar(255)
);
-- --------------------------------------------------------

--
-- Structure for view `v_inventory_materials`
--
DROP TABLE IF EXISTS `v_inventory_materials`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_inventory_materials` AS select `im`.`inventoryid` AS `inventoryid`,`im`.`materialid` AS `materialid`,`i`.`description` AS `description`,`m`.`raw_description` AS `raw_description`,`m`.`raw_cost` AS `raw_cost`,`s`.`company_name` AS `company_name` from (((`ver_chronoforms_data_inventory_material_vic` `im` join `ver_chronoforms_data_materials_vic` `m` on((`m`.`cf_id` = `im`.`materialid`))) join `ver_chronoforms_data_inventory_vic` `i` on((`i`.`inventoryid` = convert(`im`.`inventoryid` using utf8)))) join `ver_chronoforms_data_supplier_vic` `s` on((`s`.`supplierid` = convert(`m`.`supplierid` using utf8))));

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accesslog`
--
ALTER TABLE `accesslog`
 ADD PRIMARY KEY (`ID`), ADD KEY `AgentID` (`AgentID`);

--
-- Indexes for table `tblactions`
--
ALTER TABLE `tblactions`
 ADD PRIMARY KEY (`FID`), ADD KEY `FID` (`FID`);

--
-- Indexes for table `tbladdrpts`
--
ALTER TABLE `tbladdrpts`
 ADD PRIMARY KEY (`rptMacro`);

--
-- Indexes for table `tbladdrptsgen`
--
ALTER TABLE `tbladdrptsgen`
 ADD PRIMARY KEY (`rptMacro`);

--
-- Indexes for table `tblbuilders`
--
ALTER TABLE `tblbuilders`
 ADD PRIMARY KEY (`BuilderID`), ADD UNIQUE KEY `PID` (`PID`), ADD KEY `Suburb2ID` (`Suburb2ID`);

--
-- Indexes for table `tblcatcomposites`
--
ALTER TABLE `tblcatcomposites`
 ADD PRIMARY KEY (`AID`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
 ADD PRIMARY KEY (`FID`), ADD UNIQUE KEY `Code` (`CatCode`), ADD KEY `Category` (`Category`), ADD KEY `FID` (`FID`);

--
-- Indexes for table `tblclientaction`
--
ALTER TABLE `tblclientaction`
 ADD PRIMARY KEY (`PID`), ADD UNIQUE KEY `PID` (`PID`), ADD KEY `RepID` (`RepID`);

--
-- Indexes for table `tblclientactions`
--
ALTER TABLE `tblclientactions`
 ADD PRIMARY KEY (`AID`), ADD KEY `ActionID` (`ActionID`), ADD KEY `ClientID` (`ClientID`), ADD KEY `NoteID` (`NoteID`);

--
-- Indexes for table `tblclientnotes`
--
ALTER TABLE `tblclientnotes`
 ADD PRIMARY KEY (`NID`), ADD KEY `ActionID` (`NoteID`), ADD KEY `ClientID` (`ClientID`);

--
-- Indexes for table `tblclientpersonal`
--
ALTER TABLE `tblclientpersonal`
 ADD PRIMARY KEY (`ClientID`), ADD UNIQUE KEY `PID` (`PID`), ADD KEY `RepID` (`RepID`), ADD KEY `SecSuburbID` (`SecSuburbID`), ADD KEY `Suburb1ID` (`Suburb1ID`), ADD KEY `Suburb2ID` (`Suburb2ID`);

--
-- Indexes for table `tblcolour`
--
ALTER TABLE `tblcolour`
 ADD PRIMARY KEY (`FID`), ADD KEY `FID` (`FID`);

--
-- Indexes for table `tblconstructionkpi`
--
ALTER TABLE `tblconstructionkpi`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcontractsummary`
--
ALTER TABLE `tblcontractsummary`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcouncil`
--
ALTER TABLE `tblcouncil`
 ADD PRIMARY KEY (`FID`), ADD KEY `FID` (`FID`);

--
-- Indexes for table `tbldefinedcomposites`
--
ALTER TABLE `tbldefinedcomposites`
 ADD PRIMARY KEY (`AID`);

--
-- Indexes for table `tblemployees`
--
ALTER TABLE `tblemployees`
 ADD PRIMARY KEY (`UID`), ADD UNIQUE KEY `UID` (`UID`);

--
-- Indexes for table `tblerectors`
--
ALTER TABLE `tblerectors`
 ADD PRIMARY KEY (`FID`), ADD KEY `FID` (`FID`);

--
-- Indexes for table `tblflashing`
--
ALTER TABLE `tblflashing`
 ADD PRIMARY KEY (`FID`), ADD UNIQUE KEY `Code` (`FCode`), ADD KEY `FID` (`FID`);

--
-- Indexes for table `tblgutters`
--
ALTER TABLE `tblgutters`
 ADD PRIMARY KEY (`FID`), ADD UNIQUE KEY `GCode` (`GCode`), ADD KEY `FID` (`FID`);

--
-- Indexes for table `tblimages`
--
ALTER TABLE `tblimages`
 ADD PRIMARY KEY (`FID`), ADD KEY `FID` (`FID`);

--
-- Indexes for table `tblinventory`
--
ALTER TABLE `tblinventory`
 ADD PRIMARY KEY (`AID`);

--
-- Indexes for table `tbljob`
--
ALTER TABLE `tbljob`
 ADD PRIMARY KEY (`JobID`), ADD UNIQUE KEY `AID` (`AID`), ADD KEY `RepID` (`RepID`), ADD KEY `SecSuburbID` (`SecSuburbID`);

--
-- Indexes for table `tbljobcomposite`
--
ALTER TABLE `tbljobcomposite`
 ADD PRIMARY KEY (`QAID`);

--
-- Indexes for table `tbljobflashinginfo`
--
ALTER TABLE `tbljobflashinginfo`
 ADD PRIMARY KEY (`QAID`), ADD KEY `ClientID` (`QCostID`), ADD KEY `JobCostID` (`QuoteID`), ADD KEY `JobID1` (`JobID`);

--
-- Indexes for table `tbljobgutterinfo`
--
ALTER TABLE `tbljobgutterinfo`
 ADD PRIMARY KEY (`QAID`), ADD KEY `ClientID` (`QCostID`), ADD KEY `JobCostID` (`QuoteID`), ADD KEY `JobID1` (`JobID`);

--
-- Indexes for table `tbljobstatus`
--
ALTER TABLE `tbljobstatus`
 ADD PRIMARY KEY (`FID`), ADD UNIQUE KEY `StdComment` (`Status`), ADD KEY `FID` (`FID`);

--
-- Indexes for table `tblleads`
--
ALTER TABLE `tblleads`
 ADD PRIMARY KEY (`FID`), ADD KEY `FID` (`FID`);

--
-- Indexes for table `tblletterssent`
--
ALTER TABLE `tblletterssent`
 ADD PRIMARY KEY (`AID`), ADD UNIQUE KEY `AID` (`AID`);

--
-- Indexes for table `tblmonths`
--
ALTER TABLE `tblmonths`
 ADD PRIMARY KEY (`AID`), ADD KEY `AID` (`AID`);

--
-- Indexes for table `tblquotecomposite`
--
ALTER TABLE `tblquotecomposite`
 ADD PRIMARY KEY (`QAID`), ADD KEY `ClientID` (`QCostID`), ADD KEY `InventID2` (`UOM`), ADD KEY `JobCostID` (`QuoteID`), ADD KEY `JobID` (`InventID`);

--
-- Indexes for table `tblquotes`
--
ALTER TABLE `tblquotes`
 ADD PRIMARY KEY (`AID`), ADD UNIQUE KEY `TenderID` (`QuoteID`), ADD KEY `JobCostID` (`ClientID`);

--
-- Indexes for table `tblreps`
--
ALTER TABLE `tblreps`
 ADD PRIMARY KEY (`UID`), ADD UNIQUE KEY `UID` (`UID`), ADD KEY `RepID` (`RepID`);

--
-- Indexes for table `tblsaleskpi`
--
ALTER TABLE `tblsaleskpi`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsections`
--
ALTER TABLE `tblsections`
 ADD PRIMARY KEY (`FID`), ADD KEY `FID` (`FID`);

--
-- Indexes for table `tblsuburbs`
--
ALTER TABLE `tblsuburbs`
 ADD PRIMARY KEY (`ID`), ADD UNIQUE KEY `ID` (`ID`), ADD KEY `Postcode` (`Postcode`);

--
-- Indexes for table `tblsummarydailysalesgeneral`
--
ALTER TABLE `tblsummarydailysalesgeneral`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `summary_date` (`summary_date`,`summary_year`,`summary_month`,`summary_day`,`consultant_id`), ADD KEY `summary_date_2` (`summary_date`), ADD KEY `summary_year` (`summary_year`), ADD KEY `summary_month` (`summary_month`), ADD KEY `summary_day` (`summary_day`), ADD KEY `consultant_id` (`consultant_id`), ADD KEY `target_sales_amount` (`target_sales_amount`), ADD KEY `target_sales_contract` (`target_sales_contract`), ADD KEY `sales_amount` (`sales_amount`), ADD KEY `num_enquiries` (`num_enquiries`), ADD KEY `num_quotes` (`num_quotes`), ADD KEY `num_contracts` (`num_contracts`), ADD KEY `created_at` (`created_at`);

--
-- Indexes for table `tblsummarydailysalesgeneral_temp`
--
ALTER TABLE `tblsummarydailysalesgeneral_temp`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `summary_date` (`summary_date`,`summary_year`,`summary_month`,`summary_day`,`consultant_id`), ADD KEY `summary_date_2` (`summary_date`), ADD KEY `summary_year` (`summary_year`), ADD KEY `summary_month` (`summary_month`), ADD KEY `summary_day` (`summary_day`), ADD KEY `consultant_id` (`consultant_id`), ADD KEY `target_sales_amount` (`target_sales_amount`), ADD KEY `target_sales_contract` (`target_sales_contract`), ADD KEY `sales_amount` (`sales_amount`), ADD KEY `num_enquiries` (`num_enquiries`), ADD KEY `num_quotes` (`num_quotes`), ADD KEY `num_contracts` (`num_contracts`), ADD KEY `created_at` (`created_at`);

--
-- Indexes for table `tblsummarydailysalesquote`
--
ALTER TABLE `tblsummarydailysalesquote`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `quote_date` (`quote_date`,`consultant_id`,`quote_id`), ADD KEY `quote_date_2` (`quote_date`), ADD KEY `consultant_id` (`consultant_id`), ADD KEY `quote_id` (`quote_id`), ADD KEY `created_at` (`created_at`);

--
-- Indexes for table `tblsummarydailysalesquote_temp`
--
ALTER TABLE `tblsummarydailysalesquote_temp`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `quote_date` (`quote_date`,`consultant_id`,`quote_id`), ADD KEY `quote_date_2` (`quote_date`), ADD KEY `consultant_id` (`consultant_id`), ADD KEY `quote_id` (`quote_id`), ADD KEY `created_at` (`created_at`);

--
-- Indexes for table `tblsummarydatelist`
--
ALTER TABLE `tblsummarydatelist`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `date` (`date`), ADD KEY `date_2` (`date`);

--
-- Indexes for table `tblsummarydatelist_temp`
--
ALTER TABLE `tblsummarydatelist_temp`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `date` (`date`), ADD KEY `date_2` (`date`);

--
-- Indexes for table `tblsuporders`
--
ALTER TABLE `tblsuporders`
 ADD PRIMARY KEY (`OrderNo`), ADD UNIQUE KEY `AID` (`AID`), ADD KEY `DeliverToAdd1` (`DeliverToAdd2`), ADD KEY `DeliverToAdd11` (`DeliverToSuburb`), ADD KEY `DeliverToAdd12` (`DeliverToState`), ADD KEY `DeliverToAdd13` (`DeliverToPostcode`), ADD KEY `DeliverToAdd14` (`DeliverTo`), ADD KEY `RepID` (`DeliverToAdd1`);

--
-- Indexes for table `tblsuppliers`
--
ALTER TABLE `tblsuppliers`
 ADD PRIMARY KEY (`SupID`), ADD UNIQUE KEY `PID` (`AID`);

--
-- Indexes for table `tblsystem`
--
ALTER TABLE `tblsystem`
 ADD KEY `IDMessage` (`IDMessage`), ADD KEY `SitePostcode` (`SitePostcode`);

--
-- Indexes for table `tblsystemtable`
--
ALTER TABLE `tblsystemtable`
 ADD PRIMARY KEY (`SystemTableID`), ADD KEY `SystemTableID` (`SystemTableID`), ADD KEY `SystemTableUserID` (`SystemTableUserID`), ADD KEY `UserCode` (`UserCode`);

--
-- Indexes for table `tbltarget`
--
ALTER TABLE `tbltarget`
 ADD PRIMARY KEY (`TargetID`), ADD KEY `TargetID` (`TargetID`);

--
-- Indexes for table `tbltemplates`
--
ALTER TABLE `tbltemplates`
 ADD PRIMARY KEY (`TID`), ADD UNIQUE KEY `PrimaryKey` (`Filename`);

--
-- Indexes for table `tbltravel`
--
ALTER TABLE `tbltravel`
 ADD PRIMARY KEY (`FID`), ADD KEY `FID` (`FID`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
 ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tblyear`
--
ALTER TABLE `tblyear`
 ADD PRIMARY KEY (`AID`), ADD KEY `AID` (`AID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ver_ak_profiles`
--
ALTER TABLE `ver_ak_profiles`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ver_ak_stats`
--
ALTER TABLE `ver_ak_stats`
 ADD PRIMARY KEY (`id`), ADD KEY `idx_fullstatus` (`filesexist`,`status`), ADD KEY `idx_stale` (`status`,`origin`);

--
-- Indexes for table `ver_ak_storage`
--
ALTER TABLE `ver_ak_storage`
 ADD PRIMARY KEY (`tag`);

--
-- Indexes for table `ver_assets`
--
ALTER TABLE `ver_assets`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `idx_asset_name` (`name`), ADD KEY `idx_lft_rgt` (`lft`,`rgt`), ADD KEY `idx_parent_id` (`parent_id`);

--
-- Indexes for table `ver_associations`
--
ALTER TABLE `ver_associations`
 ADD PRIMARY KEY (`context`,`id`), ADD KEY `idx_key` (`key`);

--
-- Indexes for table `ver_banners`
--
ALTER TABLE `ver_banners`
 ADD PRIMARY KEY (`id`), ADD KEY `idx_state` (`state`), ADD KEY `idx_own_prefix` (`own_prefix`), ADD KEY `idx_metakey_prefix` (`metakey_prefix`), ADD KEY `idx_banner_catid` (`catid`), ADD KEY `idx_language` (`language`);

--
-- Indexes for table `ver_banner_clients`
--
ALTER TABLE `ver_banner_clients`
 ADD PRIMARY KEY (`id`), ADD KEY `idx_own_prefix` (`own_prefix`), ADD KEY `idx_metakey_prefix` (`metakey_prefix`);

--
-- Indexes for table `ver_banner_tracks`
--
ALTER TABLE `ver_banner_tracks`
 ADD PRIMARY KEY (`track_date`,`track_type`,`banner_id`), ADD KEY `idx_track_date` (`track_date`), ADD KEY `idx_track_type` (`track_type`), ADD KEY `idx_banner_id` (`banner_id`);

--
-- Indexes for table `ver_categories`
--
ALTER TABLE `ver_categories`
 ADD PRIMARY KEY (`id`), ADD KEY `cat_idx` (`extension`,`published`,`access`), ADD KEY `idx_access` (`access`), ADD KEY `idx_checkout` (`checked_out`), ADD KEY `idx_path` (`path`), ADD KEY `idx_left_right` (`lft`,`rgt`), ADD KEY `idx_alias` (`alias`), ADD KEY `idx_language` (`language`);

--
-- Indexes for table `ver_chronoforms`
--
ALTER TABLE `ver_chronoforms`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ver_chronoforms_data_builderpersonal_lookup`
--
ALTER TABLE `ver_chronoforms_data_builderpersonal_lookup`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ver_chronoforms_data_builderpersonal_vic`
--
ALTER TABLE `ver_chronoforms_data_builderpersonal_vic`
 ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `ver_chronoforms_data_builder_vic`
--
ALTER TABLE `ver_chronoforms_data_builder_vic`
 ADD PRIMARY KEY (`cf_id`);

--
-- Indexes for table `ver_chronoforms_data_clientpersonal_vic`
--
ALTER TABLE `ver_chronoforms_data_clientpersonal_vic`
 ADD PRIMARY KEY (`pid`), ADD UNIQUE KEY `clientid_UNIQUE` (`clientid`);

--
-- Indexes for table `ver_chronoforms_data_colour_vic`
--
ALTER TABLE `ver_chronoforms_data_colour_vic`
 ADD PRIMARY KEY (`cf_id`);

--
-- Indexes for table `ver_chronoforms_data_contract_bom_meterial_vic`
--
ALTER TABLE `ver_chronoforms_data_contract_bom_meterial_vic`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ver_chronoforms_data_contract_bom_vic`
--
ALTER TABLE `ver_chronoforms_data_contract_bom_vic`
 ADD PRIMARY KEY (`cf_id`);

--
-- Indexes for table `ver_chronoforms_data_contract_details_vic`
--
ALTER TABLE `ver_chronoforms_data_contract_details_vic`
 ADD PRIMARY KEY (`cf_id`);

--
-- Indexes for table `ver_chronoforms_data_contract_items_default_deminsions`
--
ALTER TABLE `ver_chronoforms_data_contract_items_default_deminsions`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ver_chronoforms_data_contract_items_deminsions`
--
ALTER TABLE `ver_chronoforms_data_contract_items_deminsions`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ver_chronoforms_data_contract_items_vic`
--
ALTER TABLE `ver_chronoforms_data_contract_items_vic`
 ADD PRIMARY KEY (`cf_id`);

--
-- Indexes for table `ver_chronoforms_data_contract_list_vic`
--
ALTER TABLE `ver_chronoforms_data_contract_list_vic`
 ADD PRIMARY KEY (`cf_id`), ADD UNIQUE KEY `projectid_UNIQUE` (`projectid`);

--
-- Indexes for table `ver_chronoforms_data_contract_po_old_sys_vic`
--
ALTER TABLE `ver_chronoforms_data_contract_po_old_sys_vic`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ver_chronoforms_data_contract_statutory_vic`
--
ALTER TABLE `ver_chronoforms_data_contract_statutory_vic`
 ADD PRIMARY KEY (`cf_id`);

--
-- Indexes for table `ver_chronoforms_data_contract_vergola_vic`
--
ALTER TABLE `ver_chronoforms_data_contract_vergola_vic`
 ADD PRIMARY KEY (`cf_id`);

--
-- Indexes for table `ver_chronoforms_data_drawings_vic`
--
ALTER TABLE `ver_chronoforms_data_drawings_vic`
 ADD PRIMARY KEY (`cf_id`);

--
-- Indexes for table `ver_chronoforms_data_followup_vic`
--
ALTER TABLE `ver_chronoforms_data_followup_vic`
 ADD PRIMARY KEY (`cf_id`);

--
-- Indexes for table `ver_chronoforms_data_followup_vic_1`
--
ALTER TABLE `ver_chronoforms_data_followup_vic_1`
 ADD PRIMARY KEY (`cf_id`);

--
-- Indexes for table `ver_chronoforms_data_image_vic`
--
ALTER TABLE `ver_chronoforms_data_image_vic`
 ADD PRIMARY KEY (`cf_id`);

--
-- Indexes for table `ver_chronoforms_data_installer_vic`
--
ALTER TABLE `ver_chronoforms_data_installer_vic`
 ADD PRIMARY KEY (`cf_id`);

--
-- Indexes for table `ver_chronoforms_data_inventory_material_vic`
--
ALTER TABLE `ver_chronoforms_data_inventory_material_vic`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ver_chronoforms_data_inventory_vic`
--
ALTER TABLE `ver_chronoforms_data_inventory_vic`
 ADD PRIMARY KEY (`cf_id`), ADD UNIQUE KEY `inventoryid_UNIQUE` (`inventoryid`);

--
-- Indexes for table `ver_chronoforms_data_inventory_vic_old_system`
--
ALTER TABLE `ver_chronoforms_data_inventory_vic_old_system`
 ADD PRIMARY KEY (`cf_id`);

--
-- Indexes for table `ver_chronoforms_data_lead_vic`
--
ALTER TABLE `ver_chronoforms_data_lead_vic`
 ADD PRIMARY KEY (`cf_id`);

--
-- Indexes for table `ver_chronoforms_data_letters_vic`
--
ALTER TABLE `ver_chronoforms_data_letters_vic`
 ADD PRIMARY KEY (`cf_id`);

--
-- Indexes for table `ver_chronoforms_data_materials_vic`
--
ALTER TABLE `ver_chronoforms_data_materials_vic`
 ADD PRIMARY KEY (`cf_id`);

--
-- Indexes for table `ver_chronoforms_data_material_default_supplier_vic`
--
ALTER TABLE `ver_chronoforms_data_material_default_supplier_vic`
 ADD PRIMARY KEY (`cf_id`);

--
-- Indexes for table `ver_chronoforms_data_material_default_supplier_vic__x`
--
ALTER TABLE `ver_chronoforms_data_material_default_supplier_vic__x`
 ADD PRIMARY KEY (`cf_id`);

--
-- Indexes for table `ver_chronoforms_data_material_supplier_vic`
--
ALTER TABLE `ver_chronoforms_data_material_supplier_vic`
 ADD PRIMARY KEY (`cf_id`);

--
-- Indexes for table `ver_chronoforms_data_material_supplier_vic__x`
--
ALTER TABLE `ver_chronoforms_data_material_supplier_vic__x`
 ADD PRIMARY KEY (`cf_id`);

--
-- Indexes for table `ver_chronoforms_data_measurement_vic`
--
ALTER TABLE `ver_chronoforms_data_measurement_vic`
 ADD PRIMARY KEY (`cf_id`);

--
-- Indexes for table `ver_chronoforms_data_notes_vic`
--
ALTER TABLE `ver_chronoforms_data_notes_vic`
 ADD PRIMARY KEY (`cf_id`);

--
-- Indexes for table `ver_chronoforms_data_notes_vic_1`
--
ALTER TABLE `ver_chronoforms_data_notes_vic_1`
 ADD PRIMARY KEY (`cf_id`);

--
-- Indexes for table `ver_chronoforms_data_pics_vic`
--
ALTER TABLE `ver_chronoforms_data_pics_vic`
 ADD PRIMARY KEY (`cf_id`);

--
-- Indexes for table `ver_chronoforms_data_quote_vic`
--
ALTER TABLE `ver_chronoforms_data_quote_vic`
 ADD PRIMARY KEY (`cf_id`);

--
-- Indexes for table `ver_chronoforms_data_quote_vic_old_system`
--
ALTER TABLE `ver_chronoforms_data_quote_vic_old_system`
 ADD PRIMARY KEY (`cf_id`);

--
-- Indexes for table `ver_chronoforms_data_section_vic`
--
ALTER TABLE `ver_chronoforms_data_section_vic`
 ADD PRIMARY KEY (`cf_id`);

--
-- Indexes for table `ver_chronoforms_data_suburbs_vic`
--
ALTER TABLE `ver_chronoforms_data_suburbs_vic`
 ADD PRIMARY KEY (`cf_id`);

--
-- Indexes for table `ver_chronoforms_data_suburbs_vic_state_sa`
--
ALTER TABLE `ver_chronoforms_data_suburbs_vic_state_sa`
 ADD UNIQUE KEY `id_UNIQUE` (`cf_id`);

--
-- Indexes for table `ver_chronoforms_data_supplier_vic`
--
ALTER TABLE `ver_chronoforms_data_supplier_vic`
 ADD PRIMARY KEY (`cf_id`);

--
-- Indexes for table `ver_chronoforms_data_systable_vic`
--
ALTER TABLE `ver_chronoforms_data_systable_vic`
 ADD PRIMARY KEY (`cf_id`);

--
-- Indexes for table `ver_chronoforms_data_travel_vic`
--
ALTER TABLE `ver_chronoforms_data_travel_vic`
 ADD PRIMARY KEY (`cf_id`);

--
-- Indexes for table `ver_chronoform_actions`
--
ALTER TABLE `ver_chronoform_actions`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ver_chronoform_maintenance_case_job_vic`
--
ALTER TABLE `ver_chronoform_maintenance_case_job_vic`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ver_chronoform_maintenance_case_vic`
--
ALTER TABLE `ver_chronoform_maintenance_case_vic`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ver_contact_details`
--
ALTER TABLE `ver_contact_details`
 ADD PRIMARY KEY (`id`), ADD KEY `idx_access` (`access`), ADD KEY `idx_checkout` (`checked_out`), ADD KEY `idx_state` (`published`), ADD KEY `idx_catid` (`catid`), ADD KEY `idx_createdby` (`created_by`), ADD KEY `idx_featured_catid` (`featured`,`catid`), ADD KEY `idx_language` (`language`), ADD KEY `idx_xreference` (`xreference`);

--
-- Indexes for table `ver_content`
--
ALTER TABLE `ver_content`
 ADD PRIMARY KEY (`id`), ADD KEY `idx_access` (`access`), ADD KEY `idx_checkout` (`checked_out`), ADD KEY `idx_state` (`state`), ADD KEY `idx_catid` (`catid`), ADD KEY `idx_createdby` (`created_by`), ADD KEY `idx_featured_catid` (`featured`,`catid`), ADD KEY `idx_language` (`language`), ADD KEY `idx_xreference` (`xreference`);

--
-- Indexes for table `ver_content_frontpage`
--
ALTER TABLE `ver_content_frontpage`
 ADD PRIMARY KEY (`content_id`);

--
-- Indexes for table `ver_content_rating`
--
ALTER TABLE `ver_content_rating`
 ADD PRIMARY KEY (`content_id`);

--
-- Indexes for table `ver_extensions`
--
ALTER TABLE `ver_extensions`
 ADD PRIMARY KEY (`extension_id`), ADD KEY `element_clientid` (`element`,`client_id`), ADD KEY `element_folder_clientid` (`element`,`folder`,`client_id`), ADD KEY `extension` (`type`,`element`,`folder`,`client_id`);

--
-- Indexes for table `ver_finder_filters`
--
ALTER TABLE `ver_finder_filters`
 ADD PRIMARY KEY (`filter_id`);

--
-- Indexes for table `ver_finder_links`
--
ALTER TABLE `ver_finder_links`
 ADD PRIMARY KEY (`link_id`), ADD KEY `idx_type` (`type_id`), ADD KEY `idx_title` (`title`), ADD KEY `idx_md5` (`md5sum`), ADD KEY `idx_url` (`url`(75)), ADD KEY `idx_published_list` (`published`,`state`,`access`,`publish_start_date`,`publish_end_date`,`list_price`), ADD KEY `idx_published_sale` (`published`,`state`,`access`,`publish_start_date`,`publish_end_date`,`sale_price`);

--
-- Indexes for table `ver_finder_links_terms0`
--
ALTER TABLE `ver_finder_links_terms0`
 ADD PRIMARY KEY (`link_id`,`term_id`), ADD KEY `idx_term_weight` (`term_id`,`weight`), ADD KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`);

--
-- Indexes for table `ver_finder_links_terms1`
--
ALTER TABLE `ver_finder_links_terms1`
 ADD PRIMARY KEY (`link_id`,`term_id`), ADD KEY `idx_term_weight` (`term_id`,`weight`), ADD KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`);

--
-- Indexes for table `ver_finder_links_terms2`
--
ALTER TABLE `ver_finder_links_terms2`
 ADD PRIMARY KEY (`link_id`,`term_id`), ADD KEY `idx_term_weight` (`term_id`,`weight`), ADD KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`);

--
-- Indexes for table `ver_finder_links_terms3`
--
ALTER TABLE `ver_finder_links_terms3`
 ADD PRIMARY KEY (`link_id`,`term_id`), ADD KEY `idx_term_weight` (`term_id`,`weight`), ADD KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`);

--
-- Indexes for table `ver_finder_links_terms4`
--
ALTER TABLE `ver_finder_links_terms4`
 ADD PRIMARY KEY (`link_id`,`term_id`), ADD KEY `idx_term_weight` (`term_id`,`weight`), ADD KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`);

--
-- Indexes for table `ver_finder_links_terms5`
--
ALTER TABLE `ver_finder_links_terms5`
 ADD PRIMARY KEY (`link_id`,`term_id`), ADD KEY `idx_term_weight` (`term_id`,`weight`), ADD KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`);

--
-- Indexes for table `ver_finder_links_terms6`
--
ALTER TABLE `ver_finder_links_terms6`
 ADD PRIMARY KEY (`link_id`,`term_id`), ADD KEY `idx_term_weight` (`term_id`,`weight`), ADD KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`);

--
-- Indexes for table `ver_finder_links_terms7`
--
ALTER TABLE `ver_finder_links_terms7`
 ADD PRIMARY KEY (`link_id`,`term_id`), ADD KEY `idx_term_weight` (`term_id`,`weight`), ADD KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`);

--
-- Indexes for table `ver_finder_links_terms8`
--
ALTER TABLE `ver_finder_links_terms8`
 ADD PRIMARY KEY (`link_id`,`term_id`), ADD KEY `idx_term_weight` (`term_id`,`weight`), ADD KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`);

--
-- Indexes for table `ver_finder_links_terms9`
--
ALTER TABLE `ver_finder_links_terms9`
 ADD PRIMARY KEY (`link_id`,`term_id`), ADD KEY `idx_term_weight` (`term_id`,`weight`), ADD KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`);

--
-- Indexes for table `ver_finder_links_termsa`
--
ALTER TABLE `ver_finder_links_termsa`
 ADD PRIMARY KEY (`link_id`,`term_id`), ADD KEY `idx_term_weight` (`term_id`,`weight`), ADD KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`);

--
-- Indexes for table `ver_finder_links_termsb`
--
ALTER TABLE `ver_finder_links_termsb`
 ADD PRIMARY KEY (`link_id`,`term_id`), ADD KEY `idx_term_weight` (`term_id`,`weight`), ADD KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`);

--
-- Indexes for table `ver_finder_links_termsc`
--
ALTER TABLE `ver_finder_links_termsc`
 ADD PRIMARY KEY (`link_id`,`term_id`), ADD KEY `idx_term_weight` (`term_id`,`weight`), ADD KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`);

--
-- Indexes for table `ver_finder_links_termsd`
--
ALTER TABLE `ver_finder_links_termsd`
 ADD PRIMARY KEY (`link_id`,`term_id`), ADD KEY `idx_term_weight` (`term_id`,`weight`), ADD KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`);

--
-- Indexes for table `ver_finder_links_termse`
--
ALTER TABLE `ver_finder_links_termse`
 ADD PRIMARY KEY (`link_id`,`term_id`), ADD KEY `idx_term_weight` (`term_id`,`weight`), ADD KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`);

--
-- Indexes for table `ver_finder_links_termsf`
--
ALTER TABLE `ver_finder_links_termsf`
 ADD PRIMARY KEY (`link_id`,`term_id`), ADD KEY `idx_term_weight` (`term_id`,`weight`), ADD KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`);

--
-- Indexes for table `ver_finder_taxonomy`
--
ALTER TABLE `ver_finder_taxonomy`
 ADD PRIMARY KEY (`id`), ADD KEY `parent_id` (`parent_id`), ADD KEY `state` (`state`), ADD KEY `ordering` (`ordering`), ADD KEY `access` (`access`), ADD KEY `idx_parent_published` (`parent_id`,`state`,`access`);

--
-- Indexes for table `ver_finder_taxonomy_map`
--
ALTER TABLE `ver_finder_taxonomy_map`
 ADD PRIMARY KEY (`link_id`,`node_id`), ADD KEY `link_id` (`link_id`), ADD KEY `node_id` (`node_id`);

--
-- Indexes for table `ver_finder_terms`
--
ALTER TABLE `ver_finder_terms`
 ADD PRIMARY KEY (`term_id`), ADD UNIQUE KEY `idx_term` (`term`), ADD KEY `idx_term_phrase` (`term`,`phrase`), ADD KEY `idx_stem_phrase` (`stem`,`phrase`), ADD KEY `idx_soundex_phrase` (`soundex`,`phrase`);

--
-- Indexes for table `ver_finder_terms_common`
--
ALTER TABLE `ver_finder_terms_common`
 ADD KEY `idx_word_lang` (`term`,`language`), ADD KEY `idx_lang` (`language`);

--
-- Indexes for table `ver_finder_tokens`
--
ALTER TABLE `ver_finder_tokens`
 ADD KEY `idx_word` (`term`), ADD KEY `idx_context` (`context`);

--
-- Indexes for table `ver_finder_tokens_aggregate`
--
ALTER TABLE `ver_finder_tokens_aggregate`
 ADD KEY `token` (`term`), ADD KEY `keyword_id` (`term_id`);

--
-- Indexes for table `ver_finder_types`
--
ALTER TABLE `ver_finder_types`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `ver_languages`
--
ALTER TABLE `ver_languages`
 ADD PRIMARY KEY (`lang_id`), ADD UNIQUE KEY `idx_sef` (`sef`), ADD UNIQUE KEY `idx_image` (`image`), ADD UNIQUE KEY `idx_langcode` (`lang_code`), ADD KEY `idx_access` (`access`), ADD KEY `idx_ordering` (`ordering`);

--
-- Indexes for table `ver_menu`
--
ALTER TABLE `ver_menu`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `idx_client_id_parent_id_alias_language` (`client_id`,`parent_id`,`alias`,`language`), ADD KEY `idx_componentid` (`component_id`,`menutype`,`published`,`access`), ADD KEY `idx_menutype` (`menutype`), ADD KEY `idx_left_right` (`lft`,`rgt`), ADD KEY `idx_alias` (`alias`), ADD KEY `idx_path` (`path`(255)), ADD KEY `idx_language` (`language`);

--
-- Indexes for table `ver_menu_types`
--
ALTER TABLE `ver_menu_types`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `idx_menutype` (`menutype`);

--
-- Indexes for table `ver_messages`
--
ALTER TABLE `ver_messages`
 ADD PRIMARY KEY (`message_id`), ADD KEY `useridto_state` (`user_id_to`,`state`);

--
-- Indexes for table `ver_messages_cfg`
--
ALTER TABLE `ver_messages_cfg`
 ADD UNIQUE KEY `idx_user_var_name` (`user_id`,`cfg_name`);

--
-- Indexes for table `ver_modules`
--
ALTER TABLE `ver_modules`
 ADD PRIMARY KEY (`id`), ADD KEY `published` (`published`,`access`), ADD KEY `newsfeeds` (`module`,`published`), ADD KEY `idx_language` (`language`);

--
-- Indexes for table `ver_modules_menu`
--
ALTER TABLE `ver_modules_menu`
 ADD PRIMARY KEY (`moduleid`,`menuid`);

--
-- Indexes for table `ver_newsfeeds`
--
ALTER TABLE `ver_newsfeeds`
 ADD PRIMARY KEY (`id`), ADD KEY `idx_access` (`access`), ADD KEY `idx_checkout` (`checked_out`), ADD KEY `idx_state` (`published`), ADD KEY `idx_catid` (`catid`), ADD KEY `idx_createdby` (`created_by`), ADD KEY `idx_language` (`language`), ADD KEY `idx_xreference` (`xreference`);

--
-- Indexes for table `ver_overrider`
--
ALTER TABLE `ver_overrider`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ver_profiler`
--
ALTER TABLE `ver_profiler`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ver_profiler_categories`
--
ALTER TABLE `ver_profiler_categories`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ver_profiler_fieldgroupprofile`
--
ALTER TABLE `ver_profiler_fieldgroupprofile`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ver_profiler_fieldprofile`
--
ALTER TABLE `ver_profiler_fieldprofile`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ver_profiler_fields`
--
ALTER TABLE `ver_profiler_fields`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`), ADD KEY `tabid_pub_prof_order` (`catid`), ADD KEY `readonly_published_tabid` (`catid`);

--
-- Indexes for table `ver_profiler_groups`
--
ALTER TABLE `ver_profiler_groups`
 ADD PRIMARY KEY (`groupid`), ADD KEY `idx_name` (`groupname`), ADD KEY `idx_block` (`groupblock`), ADD KEY `email` (`groupemail`);

--
-- Indexes for table `ver_profiler_import`
--
ALTER TABLE `ver_profiler_import`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ver_profiler_usergroup_map`
--
ALTER TABLE `ver_profiler_usergroup_map`
 ADD PRIMARY KEY (`user_id`,`group_id`);

--
-- Indexes for table `ver_profiler_users`
--
ALTER TABLE `ver_profiler_users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ver_redirect_links`
--
ALTER TABLE `ver_redirect_links`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `idx_link_old` (`old_url`), ADD KEY `idx_link_modifed` (`modified_date`);

--
-- Indexes for table `ver_rep_sales_target`
--
ALTER TABLE `ver_rep_sales_target`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ver_schemas`
--
ALTER TABLE `ver_schemas`
 ADD PRIMARY KEY (`extension_id`,`version_id`);

--
-- Indexes for table `ver_session`
--
ALTER TABLE `ver_session`
 ADD PRIMARY KEY (`session_id`), ADD KEY `whosonline` (`guest`,`usertype`), ADD KEY `userid` (`userid`), ADD KEY `time` (`time`);

--
-- Indexes for table `ver_template_styles`
--
ALTER TABLE `ver_template_styles`
 ADD PRIMARY KEY (`id`), ADD KEY `idx_template` (`template`), ADD KEY `idx_home` (`home`);

--
-- Indexes for table `ver_updates`
--
ALTER TABLE `ver_updates`
 ADD PRIMARY KEY (`update_id`);

--
-- Indexes for table `ver_update_categories`
--
ALTER TABLE `ver_update_categories`
 ADD PRIMARY KEY (`categoryid`);

--
-- Indexes for table `ver_update_sites`
--
ALTER TABLE `ver_update_sites`
 ADD PRIMARY KEY (`update_site_id`);

--
-- Indexes for table `ver_update_sites_extensions`
--
ALTER TABLE `ver_update_sites_extensions`
 ADD PRIMARY KEY (`update_site_id`,`extension_id`);

--
-- Indexes for table `ver_usergroups`
--
ALTER TABLE `ver_usergroups`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `idx_usergroup_parent_title_lookup` (`parent_id`,`title`), ADD KEY `idx_usergroup_title_lookup` (`title`), ADD KEY `idx_usergroup_adjacency_lookup` (`parent_id`), ADD KEY `idx_usergroup_nested_set_lookup` (`lft`,`rgt`);

--
-- Indexes for table `ver_users`
--
ALTER TABLE `ver_users`
 ADD PRIMARY KEY (`id`), ADD KEY `usertype` (`usertype`), ADD KEY `idx_name` (`name`), ADD KEY `idx_block` (`block`), ADD KEY `username` (`username`), ADD KEY `email` (`email`);

--
-- Indexes for table `ver_user_notes`
--
ALTER TABLE `ver_user_notes`
 ADD PRIMARY KEY (`id`), ADD KEY `idx_user_id` (`user_id`), ADD KEY `idx_category_id` (`catid`);

--
-- Indexes for table `ver_user_profiles`
--
ALTER TABLE `ver_user_profiles`
 ADD UNIQUE KEY `idx_user_id_profile_key` (`user_id`,`profile_key`);

--
-- Indexes for table `ver_user_usergroup_map`
--
ALTER TABLE `ver_user_usergroup_map`
 ADD PRIMARY KEY (`user_id`,`group_id`);

--
-- Indexes for table `ver_vergola_default_framework_items`
--
ALTER TABLE `ver_vergola_default_framework_items`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ver_vergola_default_framework_items_old1`
--
ALTER TABLE `ver_vergola_default_framework_items_old1`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ver_viewlevels`
--
ALTER TABLE `ver_viewlevels`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `idx_assetgroup_title_lookup` (`title`);

--
-- Indexes for table `ver_weblinks`
--
ALTER TABLE `ver_weblinks`
 ADD PRIMARY KEY (`id`), ADD KEY `idx_access` (`access`), ADD KEY `idx_checkout` (`checked_out`), ADD KEY `idx_state` (`state`), ADD KEY `idx_catid` (`catid`), ADD KEY `idx_createdby` (`created_by`), ADD KEY `idx_featured_catid` (`featured`,`catid`), ADD KEY `idx_language` (`language`), ADD KEY `idx_xreference` (`xreference`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accesslog`
--
ALTER TABLE `accesslog`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblactions`
--
ALTER TABLE `tblactions`
MODIFY `FID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tblbuilders`
--
ALTER TABLE `tblbuilders`
MODIFY `PID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tblcatcomposites`
--
ALTER TABLE `tblcatcomposites`
MODIFY `AID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=334;
--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
MODIFY `FID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `tblclientaction`
--
ALTER TABLE `tblclientaction`
MODIFY `PID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblclientactions`
--
ALTER TABLE `tblclientactions`
MODIFY `AID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tblclientnotes`
--
ALTER TABLE `tblclientnotes`
MODIFY `NID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tblclientpersonal`
--
ALTER TABLE `tblclientpersonal`
MODIFY `PID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1001;
--
-- AUTO_INCREMENT for table `tblcolour`
--
ALTER TABLE `tblcolour`
MODIFY `FID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tblconstructionkpi`
--
ALTER TABLE `tblconstructionkpi`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `tblcontractsummary`
--
ALTER TABLE `tblcontractsummary`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `tblcouncil`
--
ALTER TABLE `tblcouncil`
MODIFY `FID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbldefinedcomposites`
--
ALTER TABLE `tbldefinedcomposites`
MODIFY `AID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tblemployees`
--
ALTER TABLE `tblemployees`
MODIFY `UID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tblerectors`
--
ALTER TABLE `tblerectors`
MODIFY `FID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tblflashing`
--
ALTER TABLE `tblflashing`
MODIFY `FID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tblgutters`
--
ALTER TABLE `tblgutters`
MODIFY `FID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tblimages`
--
ALTER TABLE `tblimages`
MODIFY `FID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tblinventory`
--
ALTER TABLE `tblinventory`
MODIFY `AID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbljob`
--
ALTER TABLE `tbljob`
MODIFY `AID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=103;
--
-- AUTO_INCREMENT for table `tbljobcomposite`
--
ALTER TABLE `tbljobcomposite`
MODIFY `QAID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `tbljobflashinginfo`
--
ALTER TABLE `tbljobflashinginfo`
MODIFY `QAID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbljobgutterinfo`
--
ALTER TABLE `tbljobgutterinfo`
MODIFY `QAID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbljobstatus`
--
ALTER TABLE `tbljobstatus`
MODIFY `FID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tblleads`
--
ALTER TABLE `tblleads`
MODIFY `FID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tblletterssent`
--
ALTER TABLE `tblletterssent`
MODIFY `AID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tblmonths`
--
ALTER TABLE `tblmonths`
MODIFY `AID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tblquotecomposite`
--
ALTER TABLE `tblquotecomposite`
MODIFY `QAID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tblquotes`
--
ALTER TABLE `tblquotes`
MODIFY `AID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tblreps`
--
ALTER TABLE `tblreps`
MODIFY `UID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tblsaleskpi`
--
ALTER TABLE `tblsaleskpi`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=871;
--
-- AUTO_INCREMENT for table `tblsections`
--
ALTER TABLE `tblsections`
MODIFY `FID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tblsuburbs`
--
ALTER TABLE `tblsuburbs`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tblsummarydailysalesgeneral`
--
ALTER TABLE `tblsummarydailysalesgeneral`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4285668;
--
-- AUTO_INCREMENT for table `tblsummarydailysalesgeneral_temp`
--
ALTER TABLE `tblsummarydailysalesgeneral_temp`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4285668;
--
-- AUTO_INCREMENT for table `tblsummarydailysalesquote`
--
ALTER TABLE `tblsummarydailysalesquote`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5335818;
--
-- AUTO_INCREMENT for table `tblsummarydailysalesquote_temp`
--
ALTER TABLE `tblsummarydailysalesquote_temp`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5336757;
--
-- AUTO_INCREMENT for table `tblsummarydatelist`
--
ALTER TABLE `tblsummarydatelist`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5688660;
--
-- AUTO_INCREMENT for table `tblsummarydatelist_temp`
--
ALTER TABLE `tblsummarydatelist_temp`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5688660;
--
-- AUTO_INCREMENT for table `tblsuporders`
--
ALTER TABLE `tblsuporders`
MODIFY `AID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1004;
--
-- AUTO_INCREMENT for table `tblsuppliers`
--
ALTER TABLE `tblsuppliers`
MODIFY `AID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tblsystemtable`
--
ALTER TABLE `tblsystemtable`
MODIFY `SystemTableID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbltarget`
--
ALTER TABLE `tbltarget`
MODIFY `TargetID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbltemplates`
--
ALTER TABLE `tbltemplates`
MODIFY `TID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbltravel`
--
ALTER TABLE `tbltravel`
MODIFY `FID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tblyear`
--
ALTER TABLE `tblyear`
MODIFY `AID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `ver_ak_profiles`
--
ALTER TABLE `ver_ak_profiles`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ver_ak_stats`
--
ALTER TABLE `ver_ak_stats`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ver_assets`
--
ALTER TABLE `ver_assets`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `ver_banners`
--
ALTER TABLE `ver_banners`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ver_banner_clients`
--
ALTER TABLE `ver_banner_clients`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ver_categories`
--
ALTER TABLE `ver_categories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `ver_chronoforms`
--
ALTER TABLE `ver_chronoforms`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT for table `ver_chronoforms_data_builderpersonal_lookup`
--
ALTER TABLE `ver_chronoforms_data_builderpersonal_lookup`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `ver_chronoforms_data_builderpersonal_vic`
--
ALTER TABLE `ver_chronoforms_data_builderpersonal_vic`
MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1247;
--
-- AUTO_INCREMENT for table `ver_chronoforms_data_builder_vic`
--
ALTER TABLE `ver_chronoforms_data_builder_vic`
MODIFY `cf_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `ver_chronoforms_data_clientpersonal_vic`
--
ALTER TABLE `ver_chronoforms_data_clientpersonal_vic`
MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6609;
--
-- AUTO_INCREMENT for table `ver_chronoforms_data_colour_vic`
--
ALTER TABLE `ver_chronoforms_data_colour_vic`
MODIFY `cf_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `ver_chronoforms_data_contract_bom_meterial_vic`
--
ALTER TABLE `ver_chronoforms_data_contract_bom_meterial_vic`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1659;
--
-- AUTO_INCREMENT for table `ver_chronoforms_data_contract_bom_vic`
--
ALTER TABLE `ver_chronoforms_data_contract_bom_vic`
MODIFY `cf_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1396;
--
-- AUTO_INCREMENT for table `ver_chronoforms_data_contract_details_vic`
--
ALTER TABLE `ver_chronoforms_data_contract_details_vic`
MODIFY `cf_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=158;
--
-- AUTO_INCREMENT for table `ver_chronoforms_data_contract_items_default_deminsions`
--
ALTER TABLE `ver_chronoforms_data_contract_items_default_deminsions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `ver_chronoforms_data_contract_items_deminsions`
--
ALTER TABLE `ver_chronoforms_data_contract_items_deminsions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2331;
--
-- AUTO_INCREMENT for table `ver_chronoforms_data_contract_items_vic`
--
ALTER TABLE `ver_chronoforms_data_contract_items_vic`
MODIFY `cf_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37519;
--
-- AUTO_INCREMENT for table `ver_chronoforms_data_contract_list_vic`
--
ALTER TABLE `ver_chronoforms_data_contract_list_vic`
MODIFY `cf_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=939;
--
-- AUTO_INCREMENT for table `ver_chronoforms_data_contract_po_old_sys_vic`
--
ALTER TABLE `ver_chronoforms_data_contract_po_old_sys_vic`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5306;
--
-- AUTO_INCREMENT for table `ver_chronoforms_data_contract_statutory_vic`
--
ALTER TABLE `ver_chronoforms_data_contract_statutory_vic`
MODIFY `cf_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1878;
--
-- AUTO_INCREMENT for table `ver_chronoforms_data_contract_vergola_vic`
--
ALTER TABLE `ver_chronoforms_data_contract_vergola_vic`
MODIFY `cf_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1878;
--
-- AUTO_INCREMENT for table `ver_chronoforms_data_drawings_vic`
--
ALTER TABLE `ver_chronoforms_data_drawings_vic`
MODIFY `cf_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=102;
--
-- AUTO_INCREMENT for table `ver_chronoforms_data_followup_vic`
--
ALTER TABLE `ver_chronoforms_data_followup_vic`
MODIFY `cf_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8871;
--
-- AUTO_INCREMENT for table `ver_chronoforms_data_followup_vic_1`
--
ALTER TABLE `ver_chronoforms_data_followup_vic_1`
MODIFY `cf_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5749;
--
-- AUTO_INCREMENT for table `ver_chronoforms_data_image_vic`
--
ALTER TABLE `ver_chronoforms_data_image_vic`
MODIFY `cf_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `ver_chronoforms_data_installer_vic`
--
ALTER TABLE `ver_chronoforms_data_installer_vic`
MODIFY `cf_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ver_chronoforms_data_inventory_material_vic`
--
ALTER TABLE `ver_chronoforms_data_inventory_material_vic`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=888;
--
-- AUTO_INCREMENT for table `ver_chronoforms_data_inventory_vic`
--
ALTER TABLE `ver_chronoforms_data_inventory_vic`
MODIFY `cf_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=294;
--
-- AUTO_INCREMENT for table `ver_chronoforms_data_inventory_vic_old_system`
--
ALTER TABLE `ver_chronoforms_data_inventory_vic_old_system`
MODIFY `cf_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=250;
--
-- AUTO_INCREMENT for table `ver_chronoforms_data_lead_vic`
--
ALTER TABLE `ver_chronoforms_data_lead_vic`
MODIFY `cf_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `ver_chronoforms_data_letters_vic`
--
ALTER TABLE `ver_chronoforms_data_letters_vic`
MODIFY `cf_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1396;
--
-- AUTO_INCREMENT for table `ver_chronoforms_data_materials_vic`
--
ALTER TABLE `ver_chronoforms_data_materials_vic`
MODIFY `cf_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=188;
--
-- AUTO_INCREMENT for table `ver_chronoforms_data_material_default_supplier_vic`
--
ALTER TABLE `ver_chronoforms_data_material_default_supplier_vic`
MODIFY `cf_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=151;
--
-- AUTO_INCREMENT for table `ver_chronoforms_data_material_default_supplier_vic__x`
--
ALTER TABLE `ver_chronoforms_data_material_default_supplier_vic__x`
MODIFY `cf_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=151;
--
-- AUTO_INCREMENT for table `ver_chronoforms_data_material_supplier_vic`
--
ALTER TABLE `ver_chronoforms_data_material_supplier_vic`
MODIFY `cf_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1211;
--
-- AUTO_INCREMENT for table `ver_chronoforms_data_material_supplier_vic__x`
--
ALTER TABLE `ver_chronoforms_data_material_supplier_vic__x`
MODIFY `cf_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `ver_chronoforms_data_measurement_vic`
--
ALTER TABLE `ver_chronoforms_data_measurement_vic`
MODIFY `cf_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4134;
--
-- AUTO_INCREMENT for table `ver_chronoforms_data_notes_vic`
--
ALTER TABLE `ver_chronoforms_data_notes_vic`
MODIFY `cf_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5191;
--
-- AUTO_INCREMENT for table `ver_chronoforms_data_notes_vic_1`
--
ALTER TABLE `ver_chronoforms_data_notes_vic_1`
MODIFY `cf_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3967;
--
-- AUTO_INCREMENT for table `ver_chronoforms_data_pics_vic`
--
ALTER TABLE `ver_chronoforms_data_pics_vic`
MODIFY `cf_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=535;
--
-- AUTO_INCREMENT for table `ver_chronoforms_data_quote_vic`
--
ALTER TABLE `ver_chronoforms_data_quote_vic`
MODIFY `cf_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=166380;
--
-- AUTO_INCREMENT for table `ver_chronoforms_data_quote_vic_old_system`
--
ALTER TABLE `ver_chronoforms_data_quote_vic_old_system`
MODIFY `cf_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=223711;
--
-- AUTO_INCREMENT for table `ver_chronoforms_data_section_vic`
--
ALTER TABLE `ver_chronoforms_data_section_vic`
MODIFY `cf_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `ver_chronoforms_data_suburbs_vic`
--
ALTER TABLE `ver_chronoforms_data_suburbs_vic`
MODIFY `cf_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11386;
--
-- AUTO_INCREMENT for table `ver_chronoforms_data_suburbs_vic_state_sa`
--
ALTER TABLE `ver_chronoforms_data_suburbs_vic_state_sa`
MODIFY `cf_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1939;
--
-- AUTO_INCREMENT for table `ver_chronoforms_data_supplier_vic`
--
ALTER TABLE `ver_chronoforms_data_supplier_vic`
MODIFY `cf_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `ver_chronoforms_data_systable_vic`
--
ALTER TABLE `ver_chronoforms_data_systable_vic`
MODIFY `cf_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ver_chronoforms_data_travel_vic`
--
ALTER TABLE `ver_chronoforms_data_travel_vic`
MODIFY `cf_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ver_chronoform_actions`
--
ALTER TABLE `ver_chronoform_actions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4348;
--
-- AUTO_INCREMENT for table `ver_chronoform_maintenance_case_job_vic`
--
ALTER TABLE `ver_chronoform_maintenance_case_job_vic`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `ver_chronoform_maintenance_case_vic`
--
ALTER TABLE `ver_chronoform_maintenance_case_vic`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `ver_contact_details`
--
ALTER TABLE `ver_contact_details`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ver_content`
--
ALTER TABLE `ver_content`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ver_extensions`
--
ALTER TABLE `ver_extensions`
MODIFY `extension_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=865;
--
-- AUTO_INCREMENT for table `ver_finder_filters`
--
ALTER TABLE `ver_finder_filters`
MODIFY `filter_id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ver_finder_links`
--
ALTER TABLE `ver_finder_links`
MODIFY `link_id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ver_finder_taxonomy`
--
ALTER TABLE `ver_finder_taxonomy`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ver_finder_terms`
--
ALTER TABLE `ver_finder_terms`
MODIFY `term_id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ver_finder_types`
--
ALTER TABLE `ver_finder_types`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ver_languages`
--
ALTER TABLE `ver_languages`
MODIFY `lang_id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ver_menu`
--
ALTER TABLE `ver_menu`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=201;
--
-- AUTO_INCREMENT for table `ver_menu_types`
--
ALTER TABLE `ver_menu_types`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `ver_messages`
--
ALTER TABLE `ver_messages`
MODIFY `message_id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ver_modules`
--
ALTER TABLE `ver_modules`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=102;
--
-- AUTO_INCREMENT for table `ver_newsfeeds`
--
ALTER TABLE `ver_newsfeeds`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ver_overrider`
--
ALTER TABLE `ver_overrider`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';
--
-- AUTO_INCREMENT for table `ver_profiler_categories`
--
ALTER TABLE `ver_profiler_categories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `ver_profiler_fieldgroupprofile`
--
ALTER TABLE `ver_profiler_fieldgroupprofile`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ver_profiler_fieldprofile`
--
ALTER TABLE `ver_profiler_fieldprofile`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `ver_profiler_fields`
--
ALTER TABLE `ver_profiler_fields`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `ver_profiler_groups`
--
ALTER TABLE `ver_profiler_groups`
MODIFY `groupid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `ver_profiler_import`
--
ALTER TABLE `ver_profiler_import`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ver_profiler_users`
--
ALTER TABLE `ver_profiler_users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ver_redirect_links`
--
ALTER TABLE `ver_redirect_links`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT for table `ver_rep_sales_target`
--
ALTER TABLE `ver_rep_sales_target`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=672;
--
-- AUTO_INCREMENT for table `ver_template_styles`
--
ALTER TABLE `ver_template_styles`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `ver_updates`
--
ALTER TABLE `ver_updates`
MODIFY `update_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=381;
--
-- AUTO_INCREMENT for table `ver_update_categories`
--
ALTER TABLE `ver_update_categories`
MODIFY `categoryid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ver_update_sites`
--
ALTER TABLE `ver_update_sites`
MODIFY `update_site_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ver_usergroups`
--
ALTER TABLE `ver_usergroups`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `ver_users`
--
ALTER TABLE `ver_users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=99;
--
-- AUTO_INCREMENT for table `ver_user_notes`
--
ALTER TABLE `ver_user_notes`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ver_vergola_default_framework_items`
--
ALTER TABLE `ver_vergola_default_framework_items`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=758;
--
-- AUTO_INCREMENT for table `ver_vergola_default_framework_items_old1`
--
ALTER TABLE `ver_vergola_default_framework_items_old1`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=321;
--
-- AUTO_INCREMENT for table `ver_viewlevels`
--
ALTER TABLE `ver_viewlevels`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `ver_weblinks`
--
ALTER TABLE `ver_weblinks`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
