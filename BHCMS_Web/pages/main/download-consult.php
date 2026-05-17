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

$cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_in_memory_gzip;
if (!PHPExcel_Settings::setCacheStorageMethod($cacheMethod)) {
  die($cacheMethod . " caching method is not available" . EOL);
}
echo date('H:i:s'), " Enable Cell Caching using ", $cacheMethod, " method", EOL;


// Create new PHPExcel object
$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objReader->load("Classes/download-consult.xlsx");

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

    $consult = mysqli_query($con, "SELECT id, consult_id, patientid, fname, minitial, lname, sex, DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, DATE_FORMAT(date,'%m-%d-%Y') AS consultdate, weight, height, diagnosis, treatment, remarks FROM consultation INNER JOIN client ON consultation.patientid = client.id");

$userQuery = mysqli_query($con, "SELECT user_id, username, password, CONCAT(fname, ' ', lname) AS fullname from users WHERE type = 'bhw'");
$user = mysqli_fetch_assoc($userQuery);
$preparedByName = $user['fullname'];

if (mysqli_num_rows($consult) > 0) {
while ($data = mysqli_fetch_array($consult)) {
  $consult_id = strip_tags($data['consult_id']);
  $patientid = strip_tags($data['patientid']);
  $fname = strip_tags($data['fname']);
  $minitial = strip_tags($data['minitial']);
  $lname = strip_tags($data['lname']);
  $sex = strip_tags($data['sex']);
  $birthdate = strip_tags($data['birthdate']);
  $consultdate = strip_tags($data['consultdate']);
  $weight = strip_tags($data['weight']);
  $height = strip_tags($data['height']);
  $diagnosis = strip_tags($data['diagnosis']);
  $treatment = strip_tags($data['treatment']);
  $remarks = strip_tags($data['remarks']);

$birthdate = $data['birthdate'];
                  $birthDateObj = DateTime::createFromFormat('m-d-Y', $birthdate);
                  
        if ($birthDateObj === false) {
          echo "Failed to parse the birthdate.";
        } else {
          $currentDateObj = new DateTime();
          $age = $birthDateObj->diff($currentDateObj);

          $years = $age->y;
          $months = $age->m;

        if ($years <= 19) {
            continue;
        }
}

  if($minitial == "") {
    $fullname = strip_tags($data['fname']) . ' ' . strip_tags($data['lname']);
  } else {
    $fullname = strip_tags($data['fname']) . ' ' . strip_tags($data['minitial']) . ' ' . strip_tags($data['lname']);
  }


  if($consultdate == '00-00-0000')
  {
    $consultdate = "";
  }


    if ($years == 1) {
        $ageToDisplay = '1 year old';
    } elseif ($years > 1) {
        $ageToDisplay = $years . ' years old';
    } elseif ($months == 1) {
        $ageToDisplay = '1 month old';
    } elseif ($months > 1) {
        $ageToDisplay = $months . ' months old';
    } elseif ($months == 0) {
        $ageToDisplay = '0 month';
    } else {
        $ageToDisplay = 'Unknown';
    }


    $objPHPExcel->getActiveSheet()
        ->setCellValue('A' . $cells, "$consultdate")
        ->setCellValue('B' . $cells, "$fullname")
        ->setCellValue('C' . $cells, "$ageToDisplay")
        ->setCellValue('D' . $cells, "$sex")
        ->setCellValue('E' . $cells, "$weight")
        ->setCellValue('F' . $cells, "$height")
        ->setCellValue('G' . $cells, "$diagnosis") 
        ->setCellValue('H' . $cells, "$treatment")
        ->setCellValue('I' . $cells, "$remarks");
    $cells++;
}

    $objPHPExcel->getActiveSheet()
        ->setCellValue('A' . ($cells + 2), "Prepared by: $preparedByName")
        ->mergeCells('A' . ($cells + 2) . ':I' . ($cells + 2));

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
header('Content-Disposition: attachment;filename="General-Consultation.xlsx"');
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