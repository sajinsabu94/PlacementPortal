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
-- Database: `u305071956_e2edb`
--

-- --------------------------------------------------------

--
-- Table structure for table `achievementstbl`
--

CREATE TABLE `achievementstbl` (
  `AchievementID` int(11) NOT NULL,
  `StudentID` varchar(255) NOT NULL,
  `Achievements` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `achievementstbl`
--

INSERT INTO `achievementstbl` (`AchievementID`, `StudentID`, `Achievements`) VALUES
(1, '317', 'None');

-- --------------------------------------------------------

--
-- Table structure for table `admineventtbl`
--

CREATE TABLE `admineventtbl` (
  `EventID` int(11) NOT NULL,
  `AdminID` varchar(255) DEFAULT NULL,
  `EventTitle` varchar(255) DEFAULT NULL,
  `EventDatef` varchar(255) DEFAULT NULL,
  `EventDatet` varchar(255) DEFAULT NULL,
  `Location` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Status` varchar(255) DEFAULT NULL,
  `ProfileImage` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admineventtbl`
--

INSERT INTO `admineventtbl` (`EventID`, `AdminID`, `EventTitle`, `EventDatef`, `EventDatet`, `Location`, `Description`, `Status`, `ProfileImage`) VALUES
(11, '101', 'Vipro Placement', '2017-01-04', '2017-04-04', 'TKMCE', 'Aptitude Test', NULL, 'ProfileImage/936e86a01c64176bbc2d1999e137b3d024054cf9ce4968e391cf4edf94a9cab25ccffe4a19ab6c58405bd14c3c2d8acf8ec31d4243906b9939f9b9c03d5a725a.png');

-- --------------------------------------------------------

--
-- Table structure for table `admintbl`
--

CREATE TABLE `admintbl` (
  `AdminID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `SaltedPassword` varchar(255) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `MiddleName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `Position` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `ContactNumber` varchar(255) NOT NULL,
  `Usertype` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admintbl`
--

INSERT INTO `admintbl` (`AdminID`, `Username`, `Password`, `SaltedPassword`, `FirstName`, `MiddleName`, `LastName`, `Position`, `Address`, `ContactNumber`, `Usertype`) VALUES
(101, 'admin', 'admin', 'admin', 'admin', ' ', ' ', 'admin', ' ', ' ', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `allowedtbl`
--

CREATE TABLE `allowedtbl` (
  `StudentID` varchar(255) NOT NULL,
  `isOk` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `applicationtbl`
--

CREATE TABLE `applicationtbl` (
  `ApplicationID` int(11) NOT NULL,
  `StudentID` varchar(255) NOT NULL,
  `Position` varchar(255) NOT NULL,
  `Company` varchar(255) NOT NULL,
  `Location` varchar(255) NOT NULL,
  `Applied` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `certificationtbl`
--

CREATE TABLE `certificationtbl` (
  `CertificationID` int(11) NOT NULL,
  `StudentID` varchar(255) NOT NULL,
  `Certification` varchar(255) NOT NULL,
  `YearTaken` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `certificationtbl`
--

INSERT INTO `certificationtbl` (`CertificationID`, `StudentID`, `Certification`, `YearTaken`) VALUES
(1, '317', 'CEH', '2015');

-- --------------------------------------------------------

--
-- Table structure for table `companyinfotbl`
--

CREATE TABLE `companyinfotbl` (
  `CompanyID` int(255) NOT NULL,
  `CompanyName` varchar(255) DEFAULT NULL,
  `Description` varchar(10000) DEFAULT NULL,
  `Industry` varchar(255) DEFAULT '',
  `Classification` varchar(255) DEFAULT NULL,
  `City` varchar(255) DEFAULT NULL,
  `PostalCode` varchar(255) DEFAULT NULL,
  `PhoneNum` varchar(255) DEFAULT NULL,
  `MobileNum` varchar(255) DEFAULT NULL,
  `Fax` varchar(255) DEFAULT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `MiddleName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `Position` varchar(255) DEFAULT NULL,
  `Department` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `SaltedPassword` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Status` varchar(255) DEFAULT NULL,
  `Website` varchar(255) DEFAULT NULL,
  `ProfileImage` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companyinfotbl`
--

INSERT INTO `companyinfotbl` (`CompanyID`, `CompanyName`, `Description`, `Industry`, `Classification`, `City`, `PostalCode`, `PhoneNum`, `MobileNum`, `Fax`, `FirstName`, `MiddleName`, `LastName`, `Position`, `Department`, `Email`, `Password`, `SaltedPassword`, `Address`, `Status`, `Website`, `ProfileImage`) VALUES
(1, 'Xeta', '', 'Computer / Information Technology (Software)', NULL, 'Kollam', '', '', '9876543210', '', 'Sajin', '', 'Sabu', 'qwerty', 'q', 'xeta@gmail.com', '37c79fb5b244b4eba78d458471410724b4c7df9ec0e37e99aa869b47de95cea201d6aef9c6fef31a5bb8b3755f7d938795c1a279a6db347025e775b33702e253', 'da3265669ffa5732f5f773adee3ab18742bbfe5d50d8aab53da4d3d89a61655f000ba1fa5f0f56a28be2efb0ab0780fde158a3306c71d6bf7c8dba40fd9aefed', '', 'Active', NULL, 'ProfileImage/1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `compeduclvltbl`
--

CREATE TABLE `compeduclvltbl` (
  `EducID` int(11) NOT NULL,
  `PositionID` varchar(255) DEFAULT NULL,
  `EducationalLevel` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `compeventtbl`
--

CREATE TABLE `compeventtbl` (
  `EventID` int(11) NOT NULL,
  `CompanyID` varchar(255) DEFAULT NULL,
  `EventTitle` varchar(255) DEFAULT NULL,
  `EventDatef` varchar(255) DEFAULT NULL,
  `EventDatet` varchar(255) DEFAULT NULL,
  `Location` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comppositiontbl`
--

CREATE TABLE `comppositiontbl` (
  `PositionID` int(11) NOT NULL,
  `CompanyID` varchar(50) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `PostingDateFrom` varchar(255) DEFAULT NULL,
  `PostingDateTo` varchar(255) DEFAULT NULL,
  `PositionTitle` varchar(255) DEFAULT NULL,
  `PositionLevel` varchar(255) DEFAULT NULL,
  `JobDescription` varchar(255) DEFAULT NULL,
  `JSpecialization` varchar(255) DEFAULT NULL,
  `EType` varchar(255) DEFAULT NULL,
  `AvPosition` varchar(255) DEFAULT NULL,
  `MonthlySalary` varchar(255) DEFAULT NULL,
  `YExperience` varchar(255) DEFAULT NULL,
  `DegreeLevel` varchar(255) DEFAULT NULL,
  `Languages` varchar(255) DEFAULT NULL,
  `ReqSkills` varchar(500) DEFAULT NULL,
  `Tags` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comppositiontbl`
--

INSERT INTO `comppositiontbl` (`PositionID`, `CompanyID`, `Email`, `PostingDateFrom`, `PostingDateTo`, `PositionTitle`, `PositionLevel`, `JobDescription`, `JSpecialization`, `EType`, `AvPosition`, `MonthlySalary`, `YExperience`, `DegreeLevel`, `Languages`, `ReqSkills`, `Tags`) VALUES
(73, '1', NULL, '2017-03-21', '2017-03-31', 'PROJECT TRAINEE', 'Trainee', 'MANAGE PROJECT', 'IT/Computer - Creative Design', 'Part Time', '20', '20,000 - 25,000', '0', 'Bachelor Degree, Masteral Degree, Doctorate Degree', NULL, NULL, NULL),
(74, '1', NULL, '2017-03-21', '2017-03-30', 'Project Head', 'Junior Executive', 'Project Head', 'IT/Computer - Project Management', 'Full Time', '2', '45,000 - 50,000', '6', 'Masteral Degree', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coursetbl`
--

CREATE TABLE `coursetbl` (
  `CourseID` int(11) NOT NULL,
  `CourseTitle` varchar(255) NOT NULL,
  `CourseCode` varchar(255) NOT NULL,
  `CourseDescription` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coursetbl`
--

INSERT INTO `coursetbl` (`CourseID`, `CourseTitle`, `CourseCode`, `CourseDescription`) VALUES
(1, 'MCA', '101', 'MCA'),
(2, 'MSc', '102', 'MSc'),
(3, 'BSc', '103', 'BSc'),
(4, 'BCom', '104', 'BCom');

-- --------------------------------------------------------

--
-- Table structure for table `filestbl`
--

CREATE TABLE `filestbl` (
  `id` int(11) NOT NULL,
  `StudentID` varchar(255) NOT NULL,
  `Filename` varchar(255) NOT NULL,
  `EncryptedFile` varchar(255) NOT NULL,
  `_Time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `filestbl`
--

INSERT INTO `filestbl` (`id`, `StudentID`, `Filename`, `EncryptedFile`, `_Time`) VALUES
(1, '317', 'Basic_Guitar_Chords_000.pdf', 'fileuploads/dHpraWNET2RGSm1kV2hDVVBGTXpGWVB5SmhTNFE3SWJ1cXNtY1FRN1MrST0=.pdf', '16:19:55');

-- --------------------------------------------------------

--
-- Table structure for table `jobfairtbl`
--

CREATE TABLE `jobfairtbl` (
  `id` int(11) NOT NULL,
  `CompanyName` varchar(255) NOT NULL,
  `CompanyAddress` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `Website` varchar(255) NOT NULL,
  `ContactPerson` varchar(255) NOT NULL,
  `Designation` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone1` varchar(255) NOT NULL,
  `Phone2` varchar(255) NOT NULL,
  `Phone3` varchar(255) NOT NULL,
  `MobileNumber` varchar(255) NOT NULL,
  `FaxNumber` varchar(255) NOT NULL,
  `Industry` varchar(255) NOT NULL,
  `Representative1` varchar(255) NOT NULL,
  `Representative2` varchar(255) NOT NULL,
  `MarketingMaterials` varchar(500) NOT NULL,
  `Others` varchar(255) NOT NULL,
  `Extras` varchar(255) NOT NULL,
  `OthersExtra` varchar(255) NOT NULL,
  `RoomForExam` varchar(255) NOT NULL,
  `DoorPrizes` varchar(255) NOT NULL,
  `ItemDescription` varchar(255) NOT NULL,
  `Participate` varchar(255) NOT NULL,
  `Requirements` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `languagetbl`
--

CREATE TABLE `languagetbl` (
  `LangID` int(11) NOT NULL,
  `StudentID` varchar(255) NOT NULL,
  `Language` varchar(255) NOT NULL,
  `WrittenProf` varchar(255) NOT NULL,
  `SpokenProf` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `languagetbl`
--

INSERT INTO `languagetbl` (`LangID`, `StudentID`, `Language`, `WrittenProf`, `SpokenProf`) VALUES
(1, '317', 'English', '5', '5');

-- --------------------------------------------------------

--
-- Table structure for table `listofindustrytbl`
--

CREATE TABLE `listofindustrytbl` (
  `id` int(255) NOT NULL,
  `Industry` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `listofindustrytbl`
--

INSERT INTO `listofindustrytbl` (`id`, `Industry`) VALUES
(1, 'Accounting / Audit / Tax Services'),
(2, 'Advertising / Marketing / Promotion / PR'),
(3, 'Aerospace / Aviation / Airline'),
(4, 'Agricultural / Plantation / Poultry / Fisheries'),
(5, 'Apparel / Fashion'),
(6, 'Architectural Services / Interior Designing'),
(7, 'Arts / Design'),
(8, 'Automobile / Automotive Ancillary / Vehicle'),
(9, 'Banking / Financial Services'),
(10, 'BioTechnology / Pharmaceutical / Clinical research'),
(11, 'Catering / Restaurant Service'),
(12, 'Chemical / Fertilizers / Pesticides'),
(13, 'Commodities Production / Distribution'),
(14, 'Computer / Information Technology (Hardware)'),
(15, 'Computer / Information Technology (Software)'),
(16, 'Construction / Building / Engineering'),
(17, 'Consulting (Business and Management)'),
(18, 'Consulting (IT, Science, Engineering and Technical)'),
(19, 'Consumer Products / FMCG'),
(20, 'Education'),
(21, 'Electrical and Electronics'),
(22, 'Entertainment / Media'),
(23, 'Environment / Health / Safety'),
(24, 'Exhibitions / Event Management / MICE'),
(25, 'Food and Beverage'),
(26, 'Gems / Jewellery'),
(27, 'General and Wholesale Trading'),
(28, 'Government'),
(29, 'Grooming / Beauty / Fitness'),
(30, 'Healthcare / Medical'),
(31, 'Heavy Industrial / Machinery / Equipment'),
(32, 'Home Furnishing / Furniture'),
(33, 'Hotel / Hospitality'),
(34, 'Human Resources Management / Consulting'),
(35, 'Insurance'),
(36, 'Journalism'),
(37, 'Law / Legal'),
(38, 'Library / Museum'),
(39, 'Manufacturing / Production'),
(40, 'Marine / Aquaculture'),
(41, 'Mining'),
(42, 'Non-Profit Organization / Social Services / NGO'),
(43, 'Oil / Gas / Petroleum'),
(44, 'Online / E-commerce Business'),
(45, 'Other'),
(46, 'Outsourcing (Call Center / BPO'),
(47, 'Polymer / Plastic / Rubber / Tyres'),
(48, 'Printing / Publishing'),
(49, 'Property / Real Estate'),
(50, 'Repair and Maintenance Services'),
(51, 'Research and Development'),
(52, 'Retail / Merchandising'),
(53, 'Science and Technology'),
(54, 'Security / Law Enforcement'),
(55, 'Semiconductor / Wafer Fabrication'),
(56, 'Sports'),
(57, 'Stockbroking / Securities'),
(58, 'Telecommunication'),
(59, 'Textiles / Garment'),
(60, 'Tobacco and Liquor'),
(61, 'Transportation / Logistics'),
(62, 'Travel / Tourism'),
(63, 'Utilities / Power'),
(64, 'Wood / Fibre / Paper');

-- --------------------------------------------------------

--
-- Table structure for table `listofpositiontbl`
--

CREATE TABLE `listofpositiontbl` (
  `id` int(11) NOT NULL,
  `Position` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `listofpositiontbl`
--

INSERT INTO `listofpositiontbl` (`id`, `Position`) VALUES
(1, 'Top Level Management'),
(2, 'Senior Manager'),
(3, 'Manager'),
(4, 'Sernior Executive / Supervisor'),
(5, 'Junior Executive'),
(6, 'Fresh / Entry Level'),
(7, 'Non-Executive'),
(8, 'Trainee');

-- --------------------------------------------------------

--
-- Table structure for table `listofsalaryrangetbl`
--

CREATE TABLE `listofsalaryrangetbl` (
  `id` int(11) NOT NULL,
  `SalaryRange` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `listofsalaryrangetbl`
--

INSERT INTO `listofsalaryrangetbl` (`id`, `SalaryRange`) VALUES
(1, '10,000 - 15,000'),
(2, '15,000 - 20,000'),
(3, '20,000 - 25,000'),
(4, '25,000 - 30,000'),
(5, '30,000 - 40,000'),
(6, '40,000 - 45,000'),
(7, '45,000 - 50,000'),
(8, 'Negotiable');

-- --------------------------------------------------------

--
-- Table structure for table `listofspecializationtbl`
--

CREATE TABLE `listofspecializationtbl` (
  `id` int(11) NOT NULL,
  `Specialization` varchar(255) NOT NULL,
  `RelatedCourses` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `listofspecializationtbl`
--

INSERT INTO `listofspecializationtbl` (`id`, `Specialization`, `RelatedCourses`) VALUES
(1, '\r\nAdvertising/Media Planning', 'A'),
(2, 'Arts/Creative/Graphics Design', 'B, C'),
(3, 'Banking/Financial Services', 'A, B'),
(4, 'BPO/Call Center', 'A, B'),
(5, 'Clerical/Administrative Support', 'A, B'),
(6, 'Corporate Strategy/Top Management', 'B,C'),
(7, 'Costing Management', 'C, D'),
(8, 'Customer Service/Customer Service (Technical)', 'A, C'),
(9, 'Design and Development', 'B, C'),
(10, 'Engineering - Electronics/Communication', 'C, D'),
(11, 'Finance - Audit/Taxation', 'B, D'),
(12, 'Finance - Corporate \r\r\nFinance/Investment/Merchant Banking', 'A, D'),
(13, 'Finance - General/Cost Accounting', 'A, C'),
(14, 'Food/Beverage/Restaurant Service', 'A, C, B'),
(15, 'Hotel Management/Tourism Services', 'A, B, C, D'),
(16, 'Human Resources', 'A, B, D'),
(17, 'IT/Computer - Creative Design', 'MCA, BSc'),
(18, 'IT/Computer - Hardware', 'A'),
(19, 'IT/Computer - Network/System/Database Admin', 'D'),
(20, 'IT/Computer - Project Management', 'A, B, C'),
(21, 'IT/Computer - Software Development', 'A, C, D'),
(22, '\r\nJournalist/Editor', 'A, B, C'),
(23, 'Manufacturing/Production Operation', 'C, D'),
(24, 'Marketing / Brand Management', 'C, D'),
(25, 'Marketing/Business Development', 'A, D'),
(26, 'Merchandising', 'BSBM, BSBA'),
(27, 'Project Management', 'BSCPE, BSCS, BSIT'),
(28, 'Public Relations/Communications', 'ABCOMM'),
(29, 'Sales - Engineering/Technical/IT', 'BSCPE, BSCS, BSIT'),
(30, 'Sales - Financial Services (Insurance, Unit Trust, \r\r\netc)', 'BSAT, BSBM, BSBA'),
(31, 'Secretarial/Executive and Personal Assistant', 'BSAT, BSBA, BSBM, ABCOMM, BSHRM'),
(32, 'Stockbroking', 'BSAT'),
(33, 'Technical and Helpdesk Support', 'BSIT, BSCS, BSBM');

-- --------------------------------------------------------

--
-- Table structure for table `logrequesttbl`
--

CREATE TABLE `logrequesttbl` (
  `LID` int(11) NOT NULL,
  `CompanyID` varchar(11) NOT NULL,
  `Courses` varchar(255) NOT NULL,
  `DateFrom` varchar(255) NOT NULL,
  `DateTo` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `DateRequested` varchar(255) NOT NULL,
  `PositionTitle` varchar(255) NOT NULL,
  `EmployeeClassification` varchar(255) NOT NULL,
  `PositionLevel` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Qualifications` varchar(255) NOT NULL,
  `Location` varchar(255) NOT NULL,
  `SalaryRange` varchar(255) NOT NULL,
  `RequiredYOE` varchar(255) NOT NULL,
  `CFG` varchar(255) NOT NULL,
  `DurationOfRequest` varchar(255) NOT NULL,
  `MarketingMaterials` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logrequesttbl`
--

INSERT INTO `logrequesttbl` (`LID`, `CompanyID`, `Courses`, `DateFrom`, `DateTo`, `Status`, `DateRequested`, `PositionTitle`, `EmployeeClassification`, `PositionLevel`, `Description`, `Qualifications`, `Location`, `SalaryRange`, `RequiredYOE`, `CFG`, `DurationOfRequest`, `MarketingMaterials`) VALUES
(2, '1', '101, 102, 103, 104', '2017-03-22', '2017-03-30', 'Accepted', '2017-03-22', 'PROJECT TRAINEE', 'Full Time, Part-Time, Contractual, Freelance, Project-based', 'Entry Level/Gen Staff, Officer, Supervisory, Management', 'Work in Project ', 'Webdesign', 'Kollam', '50000', '0', 'Yes', '15 Days', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `objectivetbl`
--

CREATE TABLE `objectivetbl` (
  `id` int(11) NOT NULL,
  `StudentID` varchar(255) NOT NULL,
  `Caption` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ojttbl`
--

CREATE TABLE `ojttbl` (
  `id` int(10) NOT NULL,
  `StudentID` varchar(11) NOT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `MiddleName` varchar(255) DEFAULT NULL,
  `Course` varchar(255) DEFAULT NULL,
  `CompanyName` varchar(255) DEFAULT NULL,
  `CompanyAddress` varchar(255) DEFAULT NULL,
  `Supervisor` varchar(255) DEFAULT NULL,
  `Position` varchar(255) DEFAULT NULL,
  `ContactNumber` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Remarks` varchar(255) DEFAULT NULL,
  `Hours` varchar(10) DEFAULT NULL,
  `Endorsement` varchar(10) DEFAULT NULL,
  `DTR` varchar(10) DEFAULT NULL,
  `Waiver` varchar(10) DEFAULT NULL,
  `TrainingPlan` varchar(10) DEFAULT NULL,
  `MOA` varchar(10) DEFAULT NULL,
  `Journal` varchar(10) DEFAULT NULL,
  `Integration` varchar(10) DEFAULT NULL,
  `PAF` varchar(10) DEFAULT NULL,
  `Certificate` varchar(255) DEFAULT NULL,
  `AdviserID` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `phototbl`
--

CREATE TABLE `phototbl` (
  `id` int(255) NOT NULL,
  `StudentID` varchar(255) NOT NULL,
  `Filename` varchar(255) NOT NULL,
  `EncryptedName` varchar(255) NOT NULL,
  `Caption` varchar(255) NOT NULL,
  `_Time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `progresstbl`
--

CREATE TABLE `progresstbl` (
  `id` int(255) NOT NULL,
  `StudentID` varchar(255) NOT NULL,
  `Progress` int(255) NOT NULL,
  `Pinfo` varchar(255) NOT NULL,
  `Cinfo` varchar(255) NOT NULL,
  `Objective` varchar(255) NOT NULL,
  `WorkXP` varchar(255) NOT NULL,
  `School` varchar(255) NOT NULL,
  `Certification` varchar(255) NOT NULL,
  `Achievements` varchar(255) NOT NULL,
  `Specialization` varchar(255) NOT NULL,
  `Languages` varchar(255) NOT NULL,
  `_References` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `progresstbl`
--

INSERT INTO `progresstbl` (`id`, `StudentID`, `Progress`, `Pinfo`, `Cinfo`, `Objective`, `WorkXP`, `School`, `Certification`, `Achievements`, `Specialization`, `Languages`, `_References`) VALUES
(1, '317', 0, 'ok', 'ok', 'ok', '', 'ok', 'ok', 'ok', 'ok', 'ok', 'ok'),
(2, '304', 0, 'ok', 'ok', 'ok', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `referencetbl`
--

CREATE TABLE `referencetbl` (
  `ReferenceID` int(11) NOT NULL,
  `StudentID` varchar(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Relationship` varchar(255) NOT NULL,
  `Company` varchar(255) NOT NULL,
  `Position` varchar(255) NOT NULL,
  `Phone` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Others` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `referencetbl`
--

INSERT INTO `referencetbl` (`ReferenceID`, `StudentID`, `Name`, `Relationship`, `Company`, `Position`, `Phone`, `Email`, `Others`) VALUES
(1, '317', 'ABC', 'Friend', 'None', 'Manager', '9696969699', 'mail@gmail.com', 'off');

-- --------------------------------------------------------

--
-- Table structure for table `requesttocompanytbl`
--

CREATE TABLE `requesttocompanytbl` (
  `RID` int(11) NOT NULL,
  `CompanyID` varchar(255) NOT NULL,
  `StudentID` varchar(255) NOT NULL,
  `PositionID` varchar(255) NOT NULL,
  `Status` varchar(10) NOT NULL,
  `DateSubmitted` varchar(255) NOT NULL,
  `_Date` varchar(255) NOT NULL,
  `Message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requesttocompanytbl`
--

INSERT INTO `requesttocompanytbl` (`RID`, `CompanyID`, `StudentID`, `PositionID`, `Status`, `DateSubmitted`, `_Date`, `Message`) VALUES
(1, '1', '317', '73', 'Accepted', '2017-03-21', '2017-03-21', 'You are welcomed');

-- --------------------------------------------------------

--
-- Table structure for table `schooltbl`
--

CREATE TABLE `schooltbl` (
  `SchoolID` int(11) NOT NULL,
  `StudentID` varchar(255) NOT NULL,
  `School` varchar(255) NOT NULL,
  `Attainment` varchar(255) NOT NULL,
  `Course` varchar(255) NOT NULL,
  `Graduated` varchar(255) NOT NULL,
  `_Default` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schooltbl`
--

INSERT INTO `schooltbl` (`SchoolID`, `StudentID`, `School`, `Attainment`, `Course`, `Graduated`, `_Default`) VALUES
(2, '317', 'UIT', 'UG', '103', '2019 - 2012', '0'),
(3, '317', 'TKM', 'PG', '101', '2012 - 2015', '0'),
(4, '304', 'STI College Caloocan', 'Bachelor''s/College Degree', '104', '03 2015', '1');

-- --------------------------------------------------------

--
-- Table structure for table `specializationtbl`
--

CREATE TABLE `specializationtbl` (
  `SID` int(11) NOT NULL,
  `StudentID` varchar(255) NOT NULL,
  `Specialization` varchar(255) NOT NULL,
  `YearOfExperience` varchar(255) NOT NULL,
  `Proficiency` varchar(255) NOT NULL,
  `Skills` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `specializationtbl`
--

INSERT INTO `specializationtbl` (`SID`, `StudentID`, `Specialization`, `YearOfExperience`, `Proficiency`, `Skills`) VALUES
(1, '317', '', '2', '4', 'CEH');

-- --------------------------------------------------------

--
-- Table structure for table `studcontactstbl`
--

CREATE TABLE `studcontactstbl` (
  `ContactsID` int(11) NOT NULL,
  `StudentID` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `MobileNumber` varchar(255) NOT NULL,
  `Region` varchar(255) NOT NULL,
  `HomeNumber` varchar(255) NOT NULL,
  `PostalCode` varchar(255) NOT NULL,
  `WorkNumber` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studcontactstbl`
--

INSERT INTO `studcontactstbl` (`ContactsID`, `StudentID`, `Email`, `Address`, `MobileNumber`, `Region`, `HomeNumber`, `PostalCode`, `WorkNumber`, `City`) VALUES
(1, '317', 'xetatria@mail.com', 'Kollam', '9876543210', '', '', '123456', '', 'Kollam'),
(2, '304', 'Test@GMAIL.COM', 'xyz', '9876543211', '', '', '', '', 'KOLLAM');

-- --------------------------------------------------------

--
-- Table structure for table `studentinfotbl`
--

CREATE TABLE `studentinfotbl` (
  `StudentID` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `SaltedPassword` varchar(255) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `MiddleName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `Birthdate` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `CivilStatus` varchar(255) NOT NULL,
  `Nationality` varchar(255) NOT NULL,
  `EmploymentStatus` varchar(255) NOT NULL,
  `FBLink` varchar(255) NOT NULL,
  `TwitterLink` varchar(255) NOT NULL,
  `ProfileImage` varchar(255) NOT NULL,
  `MajorCourse` varchar(255) NOT NULL,
  `Objectives` varchar(300) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentinfotbl`
--

INSERT INTO `studentinfotbl` (`StudentID`, `Password`, `SaltedPassword`, `FirstName`, `MiddleName`, `LastName`, `Gender`, `Birthdate`, `Status`, `CivilStatus`, `Nationality`, `EmploymentStatus`, `FBLink`, `TwitterLink`, `ProfileImage`, `MajorCourse`, `Objectives`) VALUES
('317', '3f6a51c0fa3485d0fa57e0d2c2f5172d90209eef903ff9bc737d6b306a423fe059d2030d68d55ca3a641b7f33065879315d468a6ead9188bfcaa70bff635732c', '775d60b1b979e08692b6ea9ab9475e2614bca1ab62ae0d17b5900f29a5f5fec7d60840e508e6163517fab2feb9b4dc6a741861ca022a3881c500fee6ec2bc510', 'Sajin', '', 'Sabu', 'Male', '1993-02-05', '', 'Single', 'Indian', '', 'http://www.facebook.com/', '', 'ProfileImages/cHZoZHpwcW1oeDUwMTlFYnJzTVNFUT09.jpg', '101', 'Manager XetaTia'),
('304', 'b200763a62a75754e1b08bacbf30c84b89846d687baa2352bffb17395f86fe3174e2fc81a82f8537a0a991eab23efe68df79b96faccbef3ca5556db5b1a7dcad', '484423e55a7fdd63023e9ff8b96c78c6573c5bdd83b8a3c8ca47733ed458cbaeff5aa1fb27209d2c584be2c0bb1d26955ae043d7428c846b83c96d550ba59f5d', 'test', '', 'Santhosh', 'Female', '1995-05-16', '', 'Married', 'Indian', '', 'http://www.facebook.com/', '', '', '104', 'I M A GOOD GIRL ... WITH PUNCTUALITY.... AND VERY RESPONSIBLE');

-- --------------------------------------------------------

--
-- Table structure for table `studnotificationtbl`
--

CREATE TABLE `studnotificationtbl` (
  `id` int(11) NOT NULL,
  `StudentID` varchar(255) NOT NULL,
  `Message` varchar(255) NOT NULL,
  `_From` varchar(255) NOT NULL,
  `_Date` varchar(255) NOT NULL,
  `Time` varchar(255) NOT NULL,
  `Seen` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studnotificationtbl`
--

INSERT INTO `studnotificationtbl` (`id`, `StudentID`, `Message`, `_From`, `_Date`, `Time`, `Seen`) VALUES
(1, '317', 'No new notification.', 'PlacementCell', '', '', 1),
(2, '304', 'No new notification.', 'PlacementCell', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `urltbl`
--

CREATE TABLE `urltbl` (
  `id` int(11) NOT NULL,
  `StudentID` varchar(255) NOT NULL,
  `URL` varchar(255) NOT NULL,
  `Caption` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `workexperiencetbl`
--

CREATE TABLE `workexperiencetbl` (
  `WorkID` int(11) NOT NULL,
  `StudentID` varchar(255) NOT NULL,
  `CompanyName` varchar(255) NOT NULL,
  `CompanyWebsite` varchar(255) NOT NULL,
  `Industry` varchar(255) NOT NULL,
  `Specialization` varchar(255) NOT NULL,
  `DateFromMonth` varchar(255) NOT NULL,
  `DateFromYear` varchar(255) NOT NULL,
  `DateToMonth` varchar(255) NOT NULL,
  `DateToYear` varchar(255) NOT NULL,
  `NatureOfWork` varchar(255) NOT NULL,
  `PositionLevel` varchar(255) NOT NULL,
  `MonthlySalary` varchar(255) NOT NULL,
  `PositionTitle` varchar(255) NOT NULL,
  `CompanyAddress` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achievementstbl`
--
ALTER TABLE `achievementstbl`
  ADD PRIMARY KEY (`AchievementID`);

--
-- Indexes for table `admineventtbl`
--
ALTER TABLE `admineventtbl`
  ADD PRIMARY KEY (`EventID`);

--
-- Indexes for table `admintbl`
--
ALTER TABLE `admintbl`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `allowedtbl`
--
ALTER TABLE `allowedtbl`
  ADD PRIMARY KEY (`StudentID`);

--
-- Indexes for table `applicationtbl`
--
ALTER TABLE `applicationtbl`
  ADD PRIMARY KEY (`ApplicationID`);

--
-- Indexes for table `certificationtbl`
--
ALTER TABLE `certificationtbl`
  ADD PRIMARY KEY (`CertificationID`);

--
-- Indexes for table `companyinfotbl`
--
ALTER TABLE `companyinfotbl`
  ADD PRIMARY KEY (`CompanyID`);

--
-- Indexes for table `compeduclvltbl`
--
ALTER TABLE `compeduclvltbl`
  ADD PRIMARY KEY (`EducID`);

--
-- Indexes for table `compeventtbl`
--
ALTER TABLE `compeventtbl`
  ADD PRIMARY KEY (`EventID`);

--
-- Indexes for table `comppositiontbl`
--
ALTER TABLE `comppositiontbl`
  ADD PRIMARY KEY (`PositionID`);

--
-- Indexes for table `coursetbl`
--
ALTER TABLE `coursetbl`
  ADD PRIMARY KEY (`CourseID`);

--
-- Indexes for table `filestbl`
--
ALTER TABLE `filestbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobfairtbl`
--
ALTER TABLE `jobfairtbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languagetbl`
--
ALTER TABLE `languagetbl`
  ADD PRIMARY KEY (`LangID`);

--
-- Indexes for table `listofindustrytbl`
--
ALTER TABLE `listofindustrytbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `listofpositiontbl`
--
ALTER TABLE `listofpositiontbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `listofsalaryrangetbl`
--
ALTER TABLE `listofsalaryrangetbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `listofspecializationtbl`
--
ALTER TABLE `listofspecializationtbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logrequesttbl`
--
ALTER TABLE `logrequesttbl`
  ADD PRIMARY KEY (`LID`);

--
-- Indexes for table `objectivetbl`
--
ALTER TABLE `objectivetbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ojttbl`
--
ALTER TABLE `ojttbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phototbl`
--
ALTER TABLE `phototbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `progresstbl`
--
ALTER TABLE `progresstbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referencetbl`
--
ALTER TABLE `referencetbl`
  ADD PRIMARY KEY (`ReferenceID`);

--
-- Indexes for table `requesttocompanytbl`
--
ALTER TABLE `requesttocompanytbl`
  ADD PRIMARY KEY (`RID`);

--
-- Indexes for table `schooltbl`
--
ALTER TABLE `schooltbl`
  ADD PRIMARY KEY (`SchoolID`);

--
-- Indexes for table `specializationtbl`
--
ALTER TABLE `specializationtbl`
  ADD PRIMARY KEY (`SID`);

--
-- Indexes for table `studcontactstbl`
--
ALTER TABLE `studcontactstbl`
  ADD PRIMARY KEY (`ContactsID`);

--
-- Indexes for table `studentinfotbl`
--
ALTER TABLE `studentinfotbl`
  ADD PRIMARY KEY (`StudentID`);

--
-- Indexes for table `studnotificationtbl`
--
ALTER TABLE `studnotificationtbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `urltbl`
--
ALTER TABLE `urltbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workexperiencetbl`
--
ALTER TABLE `workexperiencetbl`
  ADD PRIMARY KEY (`WorkID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `achievementstbl`
--
ALTER TABLE `achievementstbl`
  MODIFY `AchievementID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `admineventtbl`
--
ALTER TABLE `admineventtbl`
  MODIFY `EventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `admintbl`
--
ALTER TABLE `admintbl`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;
--
-- AUTO_INCREMENT for table `applicationtbl`
--
ALTER TABLE `applicationtbl`
  MODIFY `ApplicationID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `certificationtbl`
--
ALTER TABLE `certificationtbl`
  MODIFY `CertificationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `companyinfotbl`
--
ALTER TABLE `companyinfotbl`
  MODIFY `CompanyID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `compeduclvltbl`
--
ALTER TABLE `compeduclvltbl`
  MODIFY `EducID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `compeventtbl`
--
ALTER TABLE `compeventtbl`
  MODIFY `EventID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `comppositiontbl`
--
ALTER TABLE `comppositiontbl`
  MODIFY `PositionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT for table `coursetbl`
--
ALTER TABLE `coursetbl`
  MODIFY `CourseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `filestbl`
--
ALTER TABLE `filestbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `jobfairtbl`
--
ALTER TABLE `jobfairtbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `languagetbl`
--
ALTER TABLE `languagetbl`
  MODIFY `LangID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `listofindustrytbl`
--
ALTER TABLE `listofindustrytbl`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `listofpositiontbl`
--
ALTER TABLE `listofpositiontbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `listofsalaryrangetbl`
--
ALTER TABLE `listofsalaryrangetbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `listofspecializationtbl`
--
ALTER TABLE `listofspecializationtbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `logrequesttbl`
--
ALTER TABLE `logrequesttbl`
  MODIFY `LID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `objectivetbl`
--
ALTER TABLE `objectivetbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ojttbl`
--
ALTER TABLE `ojttbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `phototbl`
--
ALTER TABLE `phototbl`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `progresstbl`
--
ALTER TABLE `progresstbl`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `referencetbl`
--
ALTER TABLE `referencetbl`
  MODIFY `ReferenceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `requesttocompanytbl`
--
ALTER TABLE `requesttocompanytbl`
  MODIFY `RID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `schooltbl`
--
ALTER TABLE `schooltbl`
  MODIFY `SchoolID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `specializationtbl`
--
ALTER TABLE `specializationtbl`
  MODIFY `SID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `studcontactstbl`
--
ALTER TABLE `studcontactstbl`
  MODIFY `ContactsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `studnotificationtbl`
--
ALTER TABLE `studnotificationtbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `urltbl`
--
ALTER TABLE `urltbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `workexperiencetbl`
--
ALTER TABLE `workexperiencetbl`
  MODIFY `WorkID` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
