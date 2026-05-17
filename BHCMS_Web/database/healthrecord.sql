-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2023 at 06:29 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `healthrecord`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `minitial` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `sex` char(1) NOT NULL,
  `mother_name` varchar(255) NOT NULL,
  `purok` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `fname`, `minitial`, `lname`, `birth_date`, `sex`, `mother_name`, `purok`, `address`) VALUES
(1, 'Juan', 'A.', 'Dela Cruz', '2023-04-16', 'M', 'Anna Dela Cruz', 'Purok 94', 'Maharlika East, Tagaytay City'),
(2, 'Anna', '', 'Doe', '2022-08-18', 'F', '', 'Purok 93', 'Maharlika East, Tagaytay City'),
(3, 'Jane', '', 'Smith', '1996-10-18', 'F', '', 'Purok 96', 'Maharlika East, Tagaytay City'),
(4, 'Pedro', 'B.', 'Santos', '2017-10-18', 'M', 'Pedra B. Santos', 'Purok 97', 'Maharlika East, Tagaytay City'),
(7, 'daez', '', 'simeon', '2023-12-27', 'M', 'Anna A. Doe', 'Purok 93', 'Maharlika East, Tagaytay City'),
(8, 'John', '', 'Doe', '2016-03-11', 'M', '', 'Purok 96', 'Maharlika East, Tagaytay City'),
(9, 'Anne', '', 'Cruz', '2003-12-13', 'F', '', 'Purok 97', 'Maharlika East, Tagaytay City');

-- --------------------------------------------------------

--
-- Table structure for table `consultation`
--

CREATE TABLE `consultation` (
  `consult_id` int(11) NOT NULL,
  `patientid` int(100) NOT NULL,
  `date` date NOT NULL,
  `weight` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `diagnosis` text NOT NULL,
  `treatment` text NOT NULL,
  `remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consultation`
--

INSERT INTO `consultation` (`consult_id`, `patientid`, `date`, `weight`, `height`, `diagnosis`, `treatment`, `remarks`) VALUES
(1, 2, '2023-10-30', 40, 140, 'fever', 'medicine', ''),
(4, 3, '2023-12-12', 60, 150, 'example diagnosis', 'example treatment', ''),
(6, 1, '2023-12-13', 55, 150, 'fever', 'medicine', ''),
(8, 4, '2023-12-13', 60, 160, 'sahfhasj', 'sdkfsjf', ''),
(9, 8, '2023-12-13', 50, 140, 'rashes', 'medicine', 'done'),
(10, 9, '2023-12-14', 55, 150, 'diagnosis example', 'treatment example', '');

-- --------------------------------------------------------

--
-- Table structure for table `deworming`
--

CREATE TABLE `deworming` (
  `deworming_id` int(10) NOT NULL,
  `patientid` int(100) NOT NULL,
  `reg_date` date NOT NULL,
  `1stdose` date NOT NULL,
  `2nddose` date NOT NULL,
  `remarks` text NOT NULL,
  `remarks_1stdose` text NOT NULL,
  `remarks_2nddose` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deworming`
--

INSERT INTO `deworming` (`deworming_id`, `patientid`, `reg_date`, `1stdose`, `2nddose`, `remarks`, `remarks_1stdose`, `remarks_2nddose`) VALUES
(2, 4, '2023-10-18', '2023-10-18', '0000-00-00', '', '', ''),
(3, 2, '2023-10-18', '2023-10-25', '0000-00-00', '', '', ''),
(6, 8, '2023-12-12', '2023-12-12', '2023-12-13', 'remarks', '', ''),
(9, 9, '2023-12-14', '2023-12-14', '0000-00-00', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `immunization`
--

CREATE TABLE `immunization` (
  `immunization_id` int(11) NOT NULL,
  `patientid` int(100) NOT NULL,
  `reg_date` date NOT NULL,
  `se_status` char(1) NOT NULL,
  `cpab1` char(1) NOT NULL,
  `cpab2` char(1) NOT NULL,
  `length` int(10) NOT NULL,
  `weight` decimal(4,2) NOT NULL,
  `birth_weight_status` varchar(10) NOT NULL,
  `initiated_breastfeed` date NOT NULL,
  `bcg` date NOT NULL,
  `hepab` date NOT NULL,
  `dpt_hib_hepb_1stdose` date NOT NULL,
  `dpt_hib_hepb_2nddose` date NOT NULL,
  `dpt_hib_hepb_3rddose` date NOT NULL,
  `opv_1stdose` date NOT NULL,
  `opv_2nddose` date NOT NULL,
  `opv_3rddose` date NOT NULL,
  `pcv_1stdose` date NOT NULL,
  `pcv_2nddose` date NOT NULL,
  `pcv_3rddose` date NOT NULL,
  `ipv` date NOT NULL,
  `mmr1stdose` date NOT NULL,
  `mmr2nddose` date NOT NULL,
  `fic_date` date NOT NULL,
  `remarks` text NOT NULL,
  `remarks1` text NOT NULL,
  `remarks2` text NOT NULL,
  `remarks3` text NOT NULL,
  `remarks4` text NOT NULL,
  `remarks5` text NOT NULL,
  `remarks6` text NOT NULL,
  `remarks7` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `immunization`
--

INSERT INTO `immunization` (`immunization_id`, `patientid`, `reg_date`, `se_status`, `cpab1`, `cpab2`, `length`, `weight`, `birth_weight_status`, `initiated_breastfeed`, `bcg`, `hepab`, `dpt_hib_hepb_1stdose`, `dpt_hib_hepb_2nddose`, `dpt_hib_hepb_3rddose`, `opv_1stdose`, `opv_2nddose`, `opv_3rddose`, `pcv_1stdose`, `pcv_2nddose`, `pcv_3rddose`, `ipv`, `mmr1stdose`, `mmr2nddose`, `fic_date`, `remarks`, `remarks1`, `remarks2`, `remarks3`, `remarks4`, `remarks5`, `remarks6`, `remarks7`) VALUES
(1, 1, '2023-09-19', '2', '✓', '', 40, '40.00', 'N', '2023-07-19', '2023-07-18', '2023-07-18', '2023-08-18', '2023-09-18', '2023-10-18', '2023-08-18', '2023-09-18', '2023-10-18', '2023-07-18', '2023-09-18', '2023-10-18', '2023-10-18', '2023-10-21', '2023-10-21', '2023-11-30', '', 'follow up 1 month', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `maternal`
--

CREATE TABLE `maternal` (
  `maternal_id` int(11) NOT NULL,
  `patientid` int(100) NOT NULL,
  `reg_date` date NOT NULL,
  `lmp` date NOT NULL,
  `g` int(10) NOT NULL,
  `p` int(10) NOT NULL,
  `edc` date NOT NULL,
  `trimester1` date NOT NULL,
  `trimester1a` date NOT NULL,
  `trimester2` date NOT NULL,
  `trimester2a` date NOT NULL,
  `trimester3` date NOT NULL,
  `trimester3a` date NOT NULL,
  `tetanus_status` varchar(50) NOT NULL,
  `tt1date` date NOT NULL,
  `tt2date` date NOT NULL,
  `tt3date` date NOT NULL,
  `tt4date` date NOT NULL,
  `tt5date` date NOT NULL,
  `iron1date` date NOT NULL,
  `1datenumber` int(10) NOT NULL,
  `iron2date` date NOT NULL,
  `2datenumber` int(10) NOT NULL,
  `iron3date` date NOT NULL,
  `3datenumber` int(10) NOT NULL,
  `iron4date` date NOT NULL,
  `4datenumber` int(10) NOT NULL,
  `iron5date` date NOT NULL,
  `5datenumber` int(10) NOT NULL,
  `iron6date` date NOT NULL,
  `6datenumber` int(10) NOT NULL,
  `sydate` date NOT NULL,
  `syresult` varchar(50) NOT NULL,
  `syresult_date` date NOT NULL,
  `given_penicillin` char(1) NOT NULL,
  `given_penicillin_date` date NOT NULL,
  `date_terminated` date NOT NULL,
  `outcome` varchar(10) NOT NULL,
  `gender` char(1) NOT NULL,
  `birth_weight` int(10) NOT NULL,
  `facility` varchar(255) NOT NULL,
  `nid` varchar(255) NOT NULL,
  `attended` varchar(10) NOT NULL,
  `remarks` text NOT NULL,
  `rem_tri1` text NOT NULL,
  `rem_tri1a` text NOT NULL,
  `rem_tri2` text NOT NULL,
  `rem_tri2a` text NOT NULL,
  `rem_tri3` text NOT NULL,
  `rem_tri3a` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `maternal`
--

INSERT INTO `maternal` (`maternal_id`, `patientid`, `reg_date`, `lmp`, `g`, `p`, `edc`, `trimester1`, `trimester1a`, `trimester2`, `trimester2a`, `trimester3`, `trimester3a`, `tetanus_status`, `tt1date`, `tt2date`, `tt3date`, `tt4date`, `tt5date`, `iron1date`, `1datenumber`, `iron2date`, `2datenumber`, `iron3date`, `3datenumber`, `iron4date`, `4datenumber`, `iron5date`, `5datenumber`, `iron6date`, `6datenumber`, `sydate`, `syresult`, `syresult_date`, `given_penicillin`, `given_penicillin_date`, `date_terminated`, `outcome`, `gender`, `birth_weight`, `facility`, `nid`, `attended`, `remarks`, `rem_tri1`, `rem_tri1a`, `rem_tri2`, `rem_tri2a`, `rem_tri3`, `rem_tri3a`) VALUES
(1, 3, '2023-10-18', '2023-10-18', 1, 1, '2023-10-18', '2023-10-18', '2023-10-20', '2023-10-18', '0000-00-00', '2023-10-18', '0000-00-00', 'TT2', '2023-10-18', '2023-10-18', '0000-00-00', '0000-00-00', '0000-00-00', '2023-10-18', 30, '2023-10-18', 30, '2023-10-18', 30, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', '', '0000-00-00', '', '0000-00-00', '2023-10-18', 'LB', 'M', 2000, 'Lying-in', '', 'RM', '', 'example remarks', '', 'example remarks', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `nutrition1`
--

CREATE TABLE `nutrition1` (
  `nutrition1_id` int(10) NOT NULL,
  `patientid` int(100) NOT NULL,
  `reg_date` date NOT NULL,
  `weight` int(10) NOT NULL,
  `height` int(10) NOT NULL,
  `screening_done` date NOT NULL,
  `tetanus_status` varchar(10) NOT NULL,
  `date_ttstatus` date NOT NULL,
  `date_assess` date NOT NULL,
  `bcg` date NOT NULL,
  `hepab1` date NOT NULL,
  `pentavalent1st` date NOT NULL,
  `pentavalent2nd` date NOT NULL,
  `pentavalent3rd` date NOT NULL,
  `opv1st` date NOT NULL,
  `opv2nd` date NOT NULL,
  `opv3rd` date NOT NULL,
  `ipv` date NOT NULL,
  `mcv1` date NOT NULL,
  `mcv2` date NOT NULL,
  `ficdate` date NOT NULL,
  `breastfed1st` date NOT NULL,
  `breastfed2nd` date NOT NULL,
  `breastfed3rd` date NOT NULL,
  `breastfed4th` date NOT NULL,
  `breastfed5th` date NOT NULL,
  `breastfed6th` date NOT NULL,
  `complementary` date NOT NULL,
  `remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nutrition2`
--

CREATE TABLE `nutrition2` (
  `nutrition2_id` int(10) NOT NULL,
  `patientid` int(100) NOT NULL,
  `reg_date` date NOT NULL,
  `weight` decimal(4,2) NOT NULL,
  `height` int(10) NOT NULL,
  `6to11mos` char(1) NOT NULL,
  `12to59mos` char(1) NOT NULL,
  `vitamina` date NOT NULL,
  `vitamin1` date NOT NULL,
  `vitamin2` date NOT NULL,
  `iron1` date NOT NULL,
  `iron2` date NOT NULL,
  `mnp1` date NOT NULL,
  `mnp2` date NOT NULL,
  `deworming` date NOT NULL,
  `remarks` text NOT NULL,
  `remarks1` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nutrition2`
--

INSERT INTO `nutrition2` (`nutrition2_id`, `patientid`, `reg_date`, `weight`, `height`, `6to11mos`, `12to59mos`, `vitamina`, `vitamin1`, `vitamin2`, `iron1`, `iron2`, `mnp1`, `mnp2`, `deworming`, `remarks`, `remarks1`) VALUES
(1, 1, '2023-10-22', '50.10', 50, '✓', '', '2023-10-22', '0000-00-00', '0000-00-00', '2023-10-22', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 'testing'),
(2, 2, '2023-10-20', '0.00', 0, '', '✓', '0000-00-00', '2023-10-20', '2023-10-20', '0000-00-00', '2023-10-20', '0000-00-00', '0000-00-00', '0000-00-00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `postpartum`
--

CREATE TABLE `postpartum` (
  `postpartum_id` int(10) NOT NULL,
  `patientid` int(100) NOT NULL,
  `delivery_date` date NOT NULL,
  `delivery_time` varchar(50) NOT NULL,
  `date_visit_24hr` date NOT NULL,
  `date_visit_1week` date NOT NULL,
  `date_breastfeed` date NOT NULL,
  `time_breastfeed` varchar(50) NOT NULL,
  `iron_supplementation_1stdate` date NOT NULL,
  `1stdate_tablets` int(10) NOT NULL,
  `iron_supplementation_2nddate` date NOT NULL,
  `2nddate_tablets` int(10) NOT NULL,
  `iron_supplementation_3rddate` date NOT NULL,
  `3rddate_tablets` int(10) NOT NULL,
  `vitamin_supplementation_date` date NOT NULL,
  `remarks` text NOT NULL,
  `remarks_24hr` text NOT NULL,
  `remarks_1week` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `postpartum`
--

INSERT INTO `postpartum` (`postpartum_id`, `patientid`, `delivery_date`, `delivery_time`, `date_visit_24hr`, `date_visit_1week`, `date_breastfeed`, `time_breastfeed`, `iron_supplementation_1stdate`, `1stdate_tablets`, `iron_supplementation_2nddate`, `2nddate_tablets`, `iron_supplementation_3rddate`, `3rddate_tablets`, `vitamin_supplementation_date`, `remarks`, `remarks_24hr`, `remarks_1week`) VALUES
(1, 3, '2023-10-18', '10:00 AM', '2023-10-18', '2023-10-20', '2023-10-18', '11:00 AM', '2023-10-18', 30, '0000-00-00', 0, '0000-00-00', 0, '2023-10-18', '', 'follow up next week', 'example remarks');

-- --------------------------------------------------------

--
-- Table structure for table `sickchildren`
--

CREATE TABLE `sickchildren` (
  `sick_children_id` int(11) NOT NULL,
  `patientid` int(100) NOT NULL,
  `reg_date` date NOT NULL,
  `se_status` char(1) NOT NULL,
  `vitamin_6to11mos` char(1) NOT NULL,
  `vitamin_12to59mos` char(1) NOT NULL,
  `diagnosis` text NOT NULL,
  `vitamin_supplementation_date` date NOT NULL,
  `remarks1` text NOT NULL,
  `diarrhea_age` int(10) NOT NULL,
  `diarrhea_ors_date` date NOT NULL,
  `diarrhea_oralzinc_date` date NOT NULL,
  `remarks2` text NOT NULL,
  `pneumonia_age` int(10) NOT NULL,
  `pneumonia_treatment_date` date NOT NULL,
  `remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sickchildren`
--

INSERT INTO `sickchildren` (`sick_children_id`, `patientid`, `reg_date`, `se_status`, `vitamin_6to11mos`, `vitamin_12to59mos`, `diagnosis`, `vitamin_supplementation_date`, `remarks1`, `diarrhea_age`, `diarrhea_ors_date`, `diarrhea_oralzinc_date`, `remarks2`, `pneumonia_age`, `pneumonia_treatment_date`, `remarks`) VALUES
(1, 2, '2023-10-27', '2', '', '', '', '0000-00-00', '', 12, '2023-10-27', '2023-10-27', '', 0, '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fname`, `lname`, `username`, `password`, `type`) VALUES
(0, 'Emily', 'Zafra', 'bhwadmin', 'bhwpassword', 'bhw'),
(2, 'Edycel', 'Gloriani', 'nurse', 'nursepassword', 'nurse');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consultation`
--
ALTER TABLE `consultation`
  ADD PRIMARY KEY (`consult_id`);

--
-- Indexes for table `deworming`
--
ALTER TABLE `deworming`
  ADD PRIMARY KEY (`deworming_id`);

--
-- Indexes for table `immunization`
--
ALTER TABLE `immunization`
  ADD PRIMARY KEY (`immunization_id`);

--
-- Indexes for table `maternal`
--
ALTER TABLE `maternal`
  ADD PRIMARY KEY (`maternal_id`);

--
-- Indexes for table `nutrition1`
--
ALTER TABLE `nutrition1`
  ADD PRIMARY KEY (`nutrition1_id`);

--
-- Indexes for table `nutrition2`
--
ALTER TABLE `nutrition2`
  ADD PRIMARY KEY (`nutrition2_id`);

--
-- Indexes for table `postpartum`
--
ALTER TABLE `postpartum`
  ADD PRIMARY KEY (`postpartum_id`);

--
-- Indexes for table `sickchildren`
--
ALTER TABLE `sickchildren`
  ADD PRIMARY KEY (`sick_children_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `consultation`
--
ALTER TABLE `consultation`
  MODIFY `consult_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `deworming`
--
ALTER TABLE `deworming`
  MODIFY `deworming_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `immunization`
--
ALTER TABLE `immunization`
  MODIFY `immunization_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `maternal`
--
ALTER TABLE `maternal`
  MODIFY `maternal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nutrition1`
--
ALTER TABLE `nutrition1`
  MODIFY `nutrition1_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nutrition2`
--
ALTER TABLE `nutrition2`
  MODIFY `nutrition2_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `postpartum`
--
ALTER TABLE `postpartum`
  MODIFY `postpartum_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sickchildren`
--
ALTER TABLE `sickchildren`
  MODIFY `sick_children_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
