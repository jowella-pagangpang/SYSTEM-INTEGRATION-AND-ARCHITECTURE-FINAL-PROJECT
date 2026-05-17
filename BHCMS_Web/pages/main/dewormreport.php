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
$objPHPExcel = $objReader->load("Classes/mytemplates-deworming-report.xlsx");

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
$deworming1st = mysqli_query($con, "SELECT deworming_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
fname, minitial, lname, sex, mother_name, 
purok, address, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks 
FROM deworming INNER JOIN client ON deworming.patientid = client.id 
AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 1 AND 4 WHERE 1stdose IS NULL OR 2nddose IS NULL");

$userQuery = mysqli_query($con, "SELECT user_id, username, password, CONCAT(fname, ' ', lname) AS fullname from users WHERE type = 'bhw'");
$user = mysqli_fetch_assoc($userQuery);
$preparedByName = $user['fullname'];

                          
if (mysqli_num_rows($deworming1st) > 0) {
while ($data = mysqli_fetch_array($deworming1st)) {
  $deworming_id = strip_tags($data['deworming_id']);
  $patientid = strip_tags($data['patientid']);
  $regdate = strip_tags($data['regdate']);
  $fname = strip_tags($data['fname']);
  $minitial = strip_tags($data['minitial']);
  $lname = strip_tags($data['lname']);
  $address = strip_tags($data['purok']) . ', ' . strip_tags($data['address']);
  $age = strip_tags($data['age']);
  $firstdose = strip_tags($data['1st_dose']);
  $seconddose = strip_tags($data['2nd_dose']);
  $remarks = strip_tags($data['remarks']);


  if($minitial == "") {
    $fullname = strip_tags($data['fname']) . ' ' . strip_tags($data['lname']);
  } else {
    $fullname = strip_tags($data['fname']) . ' ' . strip_tags($data['minitial']) . ' ' . strip_tags($data['lname']);
  }

  if($firstdose || $seconddose == '00-00-0000')
  {
    $status = "Follow-up";
  }

    $services = ''; 

    if ($firstdose == '00-00-0000') {
        $services .= "1st dose" . "\n";
    }

    if ($seconddose == '00-00-0000') {
        $services .= "2nd dose" . "\n";
    }

    // Remove the last newline character if it exists
    $services = rtrim($services);

    $objPHPExcel->getActiveSheet()
        ->setCellValue('A' . $cells, "$fullname")
        ->setCellValue('B' . $cells, "$regdate")
        ->setCellValue('C' . $cells, "$address")
        ->setCellValue('D' . $cells, "$status")
        ->setCellValue('E' . $cells, "$services")
        ->setCellValue('F' . $cells, "$remarks");
    $objPHPExcel->getActiveSheet()->getStyle('E' . $cells)->getAlignment()->setWrapText(true);

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


// Create a second sheet
echo date('H:i:s'), " Add data", EOL;
$objPHPExcel->setActiveSheetIndex(1);

$cells = 4;
$deworming2nd = mysqli_query($con, "SELECT deworming_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
fname, minitial, lname, sex, mother_name, 
purok, address, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks 
FROM deworming INNER JOIN client ON deworming.patientid = client.id 
AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 5 AND 9 WHERE 1stdose IS NULL OR 2nddose IS NULL");


$userQuery = mysqli_query($con, "SELECT user_id, username, password, CONCAT(fname, ' ', lname) AS fullname from users WHERE type = 'bhw'");
$user = mysqli_fetch_assoc($userQuery);
$preparedByName = $user['fullname'];


if (mysqli_num_rows($deworming2nd) > 0) {
while ($data = mysqli_fetch_array($deworming2nd)) {
  $deworming_id = strip_tags($data['deworming_id']);
  $patientid = strip_tags($data['patientid']);
  $regdate = strip_tags($data['regdate']);
  $fname = strip_tags($data['fname']);
  $minitial = strip_tags($data['minitial']);
  $lname = strip_tags($data['lname']);
  $address = strip_tags($data['purok']) . ', ' . strip_tags($data['address']);
  $age = strip_tags($data['age']);
  $firstdose = strip_tags($data['1st_dose']);
  $seconddose = strip_tags($data['2nd_dose']);
  $remarks = strip_tags($data['remarks']);


  if($minitial == "") {
    $fullname = strip_tags($data['fname']) . ' ' . strip_tags($data['lname']);
  } else {
    $fullname = strip_tags($data['fname']) . ' ' . strip_tags($data['minitial']) . ' ' . strip_tags($data['lname']);
  }

  if($firstdose || $seconddose == '00-00-0000')
  {
    $status = "Follow-up";
  }

    $services = ''; 

    if ($firstdose == '00-00-0000') {
        $services .= "1st dose" . "\n";
    }

    if ($seconddose == '00-00-0000') {
        $services .= "2nd dose" . "\n";
    }

    // Remove the last newline character if it exists
    $services = rtrim($services);

    $objPHPExcel->getActiveSheet()
        ->setCellValue('A' . $cells, "$fullname")
        ->setCellValue('B' . $cells, "$regdate")
        ->setCellValue('C' . $cells, "$address")
        ->setCellValue('D' . $cells, "$status")
        ->setCellValue('E' . $cells, "$services")
        ->setCellValue('F' . $cells, "$remarks");
    $objPHPExcel->getActiveSheet()->getStyle('E' . $cells)->getAlignment()->setWrapText(true);

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


// Create a third sheet
echo date('H:i:s'), " Add data", EOL;
$objPHPExcel->setActiveSheetIndex(2);

$cells = 4;
$deworming3rd = mysqli_query($con, "SELECT deworming_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
fname, minitial, lname, sex, mother_name, 
purok, address, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks 
FROM deworming INNER JOIN client ON deworming.patientid = client.id 
AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 10 AND 19 WHERE 1stdose IS NULL OR 2nddose IS NULL");

$userQuery = mysqli_query($con, "SELECT user_id, username, password, CONCAT(fname, ' ', lname) AS fullname from users WHERE type = 'bhw'");
$user = mysqli_fetch_assoc($userQuery);
$preparedByName = $user['fullname'];


if (mysqli_num_rows($deworming3rd) > 0) {
while ($data = mysqli_fetch_array($deworming3rd)) {
  $deworming_id = strip_tags($data['deworming_id']);
  $patientid = strip_tags($data['patientid']);
  $regdate = strip_tags($data['regdate']);
  $fname = strip_tags($data['fname']);
  $minitial = strip_tags($data['minitial']);
  $lname = strip_tags($data['lname']);
  $address = strip_tags($data['purok']) . ', ' . strip_tags($data['address']);
  $age = strip_tags($data['age']);
  $firstdose = strip_tags($data['1st_dose']);
  $seconddose = strip_tags($data['2nd_dose']);
  $remarks = strip_tags($data['remarks']);


  if($minitial == "") {
    $fullname = strip_tags($data['fname']) . ' ' . strip_tags($data['lname']);
  } else {
    $fullname = strip_tags($data['fname']) . ' ' . strip_tags($data['minitial']) . ' ' . strip_tags($data['lname']);
  }

  if($firstdose || $seconddose == '00-00-0000')
  {
    $status = "Follow-up";
  }

    $services = ''; 

    if ($firstdose == '00-00-0000') {
        $services .= "1st dose" . "\n";
    }

    if ($seconddose == '00-00-0000') {
        $services .= "2nd dose" . "\n";
    }

    // Remove the last newline character if it exists
    $services = rtrim($services);

    $objPHPExcel->getActiveSheet()
        ->setCellValue('A' . $cells, "$fullname")
        ->setCellValue('B' . $cells, "$regdate")
        ->setCellValue('C' . $cells, "$address")
        ->setCellValue('D' . $cells, "$status")
        ->setCellValue('E' . $cells, "$services")
        ->setCellValue('F' . $cells, "$remarks");
    $objPHPExcel->getActiveSheet()->getStyle('E' . $cells)->getAlignment()->setWrapText(true);
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
header('Content-Disposition: attachment;filename="TCL-Deworming-Follow-up-Service.xlsx"');
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