<?php
/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2015 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt  LGPL
 * @version    ##VERSION##, ##DATE##
 */

/** Error reporting */
error_reporting(0);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

define('EOL', (PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

date_default_timezone_set('Asia/Manila');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/Classes/PHPExcel.php';
include('../dbcon.php');
include('../clientreport.php');

$cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_in_memory_gzip;
if (!PHPExcel_Settings::setCacheStorageMethod($cacheMethod)) {
  die($cacheMethod . " caching method is not available" . EOL);
}
echo date('H:i:s'), " Enable Cell Caching using ", $cacheMethod, " method", EOL;


// Create new PHPExcel object
$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objReader->load("Classes/mytemplates-immunization-report.xlsx");

// Set document properties
echo date('H:i:s'), " Set properties", EOL;
$objPHPExcel->getProperties()->setCreator("John Doe")
  ->setLastModifiedBy("John Doe")
  ->setTitle("Health Record Management")
  ->setSubject("Health Record Management")
  ->setDescription("Copyright by AIM")
  ->setKeywords("Health Record Management")
  ->setCategory("Health Record Management");


// Create a first sheet
echo date('H:i:s'), " Add data", EOL;
$objPHPExcel->setActiveSheetIndex(0);


$cells = 4;
$immunization = mysqli_query($con, "SELECT immunization_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, fname, minitial, lname, purok, address,
DATE_FORMAT(initiated_breastfeed,'%m-%d-%Y') AS breastfeed, DATE_FORMAT(bcg,'%m-%d-%Y') AS bcgdate,
DATE_FORMAT(hepab,'%m-%d-%Y') AS hepabdate, DATE_FORMAT(dpt_hib_hepb_1stdose,'%m-%d-%Y') AS dpt_hib_hepb1, 
DATE_FORMAT(dpt_hib_hepb_2nddose,'%m-%d-%Y') AS dpt_hib_hepb2, DATE_FORMAT(dpt_hib_hepb_3rddose,'%m-%d-%Y') AS dpt_hib_hepb3,
DATE_FORMAT(opv_1stdose,'%m-%d-%Y') AS opv1, DATE_FORMAT(opv_2nddose,'%m-%d-%Y') AS opv2,
DATE_FORMAT(opv_3rddose,'%m-%d-%Y') AS opv3, DATE_FORMAT(pcv_1stdose,'%m-%d-%Y') AS pcv1, DATE_FORMAT(pcv_2nddose,'%m-%d-%Y') AS pcv2,
DATE_FORMAT(pcv_3rddose,'%m-%d-%Y') AS pcv3, DATE_FORMAT(ipv,'%m-%d-%Y') AS ipvdate, DATE_FORMAT(mmr1stdose,'%m-%d-%Y') AS mmr1, 
DATE_FORMAT(mmr2nddose,'%m-%d-%Y') AS mmr2, DATE_FORMAT(fic_date,'%m-%d-%Y') AS fic,
remarks, remarks1, remarks2, remarks3, remarks4, remarks5, remarks6, remarks7 
FROM immunization INNER JOIN client ON immunization.patientid = client.id 
WHERE bcg IS NULL OR hepab IS NULL OR dpt_hib_hepb_1stdose IS NULL OR
dpt_hib_hepb_2nddose IS NULL OR dpt_hib_hepb_3rddose IS NULL OR opv_1stdose IS NULL OR opv_2nddose IS NULL OR
opv_3rddose IS NULL OR pcv_1stdose IS NULL OR pcv_2nddose IS NULL OR pcv_3rddose IS NULL OR ipv IS NULL OR
mmr1stdose IS NULL OR mmr2nddose IS NULL");


$userQuery = mysqli_query($con, "SELECT user_id, username, password, CONCAT(fname, ' ', lname) AS fullname from users WHERE type = 'bhw'");
$user = mysqli_fetch_assoc($userQuery);
$preparedByName = $user['fullname'];

if (mysqli_num_rows($immunization) > 0) {
while ($data = mysqli_fetch_array($immunization)) {
    $immunization_id = strip_tags($data['immunization_id']);
    $regdate = strip_tags($data['regdate']);
    $fname = strip_tags($data['fname']);
    $minitial = strip_tags($data['minitial']);
    $lname = strip_tags($data['lname']);
    $address = strip_tags($data['purok']) . ', ' . strip_tags($data['address']);
    $birth_weight_status = strip_tags($data['birth_weight_status']);
    $breastfeed = strip_tags($data['breastfeed']);
    $bcgdate = strip_tags($data['bcgdate']);
    $hepabdate = strip_tags($data['hepabdate']);
    $dpt_hib_hepb1 = strip_tags($data['dpt_hib_hepb1']);
    $dpt_hib_hepb2 = strip_tags($data['dpt_hib_hepb2']);
    $dpt_hib_hepb3 = strip_tags($data['dpt_hib_hepb3']);
    $opv1 = strip_tags($data['opv1']);
    $opv2 = strip_tags($data['opv2']);
    $opv3 = strip_tags($data['opv3']);
    $pcv1 = strip_tags($data['pcv1']);
    $pcv2 = strip_tags($data['pcv2']);
    $pcv3 = strip_tags($data['pcv3']);
    $ipvdate = strip_tags($data['ipvdate']);
    $mmr1 = strip_tags($data['mmr1']);
    $mmr2 = strip_tags($data['mmr2']);
    $fic = strip_tags($data['fic']);


  if($minitial == "") {
    $fullname = strip_tags($data['fname']) . ' ' . strip_tags($data['lname']);
  } else {
    $fullname = strip_tags($data['fname']) . ' ' . strip_tags($data['minitial']) . ' ' . strip_tags($data['lname']);
  }


  if (
    $bcgdate || $hepabdate || $dpt_hib_hepb1 || $dpt_hib_hepb2 || $dpt_hib_hepb3 ||
    $opv1 || $opv2 || $opv3 || $pcv1 || $pcv2 || $pcv3 || $ipvdate || $mmr1 || $mmr2 == '00-00-0000'
  ) {
    $status = "Follow-up";
  }

    $services = '';
    $remarksData = '';

    // Service information
    if ($bcgdate == '00-00-0000') {
        $services .= "BCG" . "\n";
    }
    if ($hepabdate == '00-00-0000') {
        $services .= "Hepa B-BD" . "\n";
    }
    if ($dpt_hib_hepb1 == '00-00-0000') {
        $services .= "DPT-HIB-HepB 1st dose" . "\n";
    }
    if ($dpt_hib_hepb2 == '00-00-0000') {
        $services .= "DPT-HIB-HepB 2nd dose" . "\n";
    }
    if ($dpt_hib_hepb3 == '00-00-0000') {
        $services .= "DPT-HIB-HepB 3rd dose" . "\n";
    }
    if ($opv1 == '00-00-0000') {
        $services .= "OPV 1st dose" . "\n";
    }
    if ($opv2 == '00-00-0000') {
        $services .= "OPV 2nd dose" . "\n";
    }
    if ($opv3 == '00-00-0000') {
        $services .= "OPV 3rd dose" . "\n";
    }
    if ($pcv1 == '00-00-0000') {
        $services .= "PCV 1st dose" . "\n";
    }
    if ($pcv2 == '00-00-0000') {
        $services .= "PCV 2nd dose" . "\n";
    }
    if ($pcv3 == '00-00-0000') {
        $services .= "PCV 3rd dose" . "\n";
    }
    if ($ipvdate == '00-00-0000') {
        $services .= "IPV" . "\n";
    }
    if ($mmr1 == '00-00-0000') {
        $services .= "MMR dose 1" . "\n";
    }
    if ($mmr2 == '00-00-0000') {
        $services .= "MMR dose 2" . "\n";
    }

    // Remarks information
    if ($bcgdate == '00-00-0000') {
        $remarksData .= strip_tags($data['remarks']) . "\n";
    }
    if ($hepabdate == '00-00-0000') {
        $remarksData .= strip_tags($data['remarks1']) . "\n";
    }
    if ($dpt_hib_hepb1 || $dpt_hib_hepb2 || $dpt_hib_hepb3 == '00-00-0000') {
        $remarksData .= strip_tags($data['remarks2']) . "\n";
    }
    if ($opv1 || $opv2 || $opv3 == '00-00-0000') {
        $remarksData .= strip_tags($data['remarks3']) . "\n";
    }
    if ($pcv1 || $pcv2 || $pcv3 == '00-00-0000') {
        $remarksData .= strip_tags($data['remarks4']) . "\n";
    }
    if ($ipvdate == '00-00-0000') {
        $remarksData .= strip_tags($data['remarks5']) . "\n";
    }
    if ($mmr1 || $mmr2 == '00-00-0000') {
        $remarksData .= strip_tags($data['remarks6']) . "\n";
    }

    // Remove the last newline character if it exists
    $services = rtrim($services);
    $remarksData = rtrim($remarksData);

$lineCount = substr_count($services, "\n") + 1;


$objPHPExcel->getActiveSheet()
    ->setCellValue('A' . $cells, "$fullname")
    ->setCellValue('B' . $cells, "$regdate")
    ->setCellValue('C' . $cells, "$address")
    ->setCellValue('D' . $cells, "$status")
    ->setCellValue('E' . $cells, "$services")
    ->setCellValue('F' . $cells, "$remarksData");

// Adjust row height based on the number of lines
$objPHPExcel->getActiveSheet()
    ->getRowDimension($cells)
    ->setRowHeight(-1); // Set to -1 to auto size row height

$cells++;
}

    $objPHPExcel->getActiveSheet()
        ->setCellValue('A' . ($cells + 2), "Prepared by: $preparedByName")
        ->mergeCells('A' . ($cells + 2) . ':F' . ($cells + 2));

    $objPHPExcel->getActiveSheet()
        ->getStyle('A' . ($cells + 2))
        ->getFont()
        ->setSize(12);

    $objPHPExcel->getActiveSheet()
        ->getStyle('A' . ($cells + 2))
        ->getAlignment()
        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT)
        ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="TCL-Immunization-0-12-Follow-up-Service.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
ob_end_clean();
$objWriter->save('php://output');

exit;