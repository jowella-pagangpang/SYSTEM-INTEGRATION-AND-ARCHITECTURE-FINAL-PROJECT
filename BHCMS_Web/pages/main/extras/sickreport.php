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
$objPHPExcel = $objReader->load("Classes/mytemplates-sickchildren-report.xlsx");

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
$sickchildren = mysqli_query($con, "SELECT sick_children_id, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
fname, minitial, lname, DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
purok, address, vitamin_6to11mos, vitamin_12to59mos, diagnosis, 
DATE_FORMAT(vitamin_supplementation_date,'%m-%d-%Y') AS vitamindate, diarrhea_age, DATE_FORMAT(diarrhea_ors_date,'%m-%d-%Y') AS orsdate, DATE_FORMAT(diarrhea_oralzinc_date,'%m-%d-%Y') AS oralzincdate, 
pneumonia_age, DATE_FORMAT(pneumonia_treatment_date,'%m-%d-%Y') AS pneumoniadate, 
remarks FROM sickchildren WHERE vitamin_supplementation_date IS NULL OR diarrhea_ors_date IS NULL OR
diarrhea_oralzinc_date IS NULL OR pneumonia_treatment_date IS NULL");

while ($data = mysqli_fetch_array($sickchildren)) {

  $sick_children_id = strip_tags($data['sick_children_id']);
  $regdate = strip_tags($data['regdate']);
  $fname = strip_tags($data['fname']);
  $minitial = strip_tags($data['minitial']);
  $lname = strip_tags($data['lname']);
  $birthdate = strip_tags($data['birthdate']);
  $address = strip_tags($data['purok']) . ', ' . strip_tags($data['address']);
  $se_status = strip_tags($data['se_status']);
  $vitamin_6to11mos = strip_tags($data['vitamin_6to11mos']);
  $vitamin_12to59mos = strip_tags($data['vitamin_12to59mos']);
  $diagnosis = strip_tags($data['diagnosis']);
  $vitamindate = strip_tags($data['vitamindate']);
  $diarrhea_age = strip_tags($data['diarrhea_age']);
  $orsdate = strip_tags($data['orsdate']);
  $oralzincdate = strip_tags($data['oralzincdate']);
  $pneumonia_age = strip_tags($data['pneumonia_age']);
  $pneumoniadate = strip_tags($data['pneumoniadate']);
  $remarks = strip_tags($data['remarks']);


  if($minitial == "") {
    $fullname = strip_tags($data['fname']) . ' ' . strip_tags($data['lname']);
  } else {
    $fullname = strip_tags($data['fname']) . ' ' . strip_tags($data['minitial']) . ' ' . strip_tags($data['lname']);
  }

  if($vitamindate == '00-00-0000' || $orsdate == '00-00-0000' || $oralzincdate == '00-00-0000' || $pneumoniadate == '00-00-0000') 
  {
    $status = "Follow-up";
    }

    $service1 = "";
    $service2 = "";
    $service3 = "";
    $service4 = "";

    if ($vitamindate == '00-00-0000') {
        $service1 = "Vitamin A Supplementation"."\n";
    }

    if ($orsdate == '00-00-0000') {
        $service2 = "Diarrhea Treatment: ORS"."\n";
    }

    if ($oralzincdate == '00-00-0000') {
        $service3 = "Diarrhea Treatment: Oral zinc drops or syrup"."\n";
    }

    if ($pneumoniadate == '00-00-0000') {
        $service4 = "Pneumonia Antibiotic Treatment";
    }


  $objPHPExcel->getActiveSheet()
    ->setCellValue('A' . $cells, "$fullname")
    ->setCellValue('B' . $cells, "$regdate")
    ->setCellValue('C' . $cells, "$address")
    ->setCellValue('D' . $cells, "$status")
    ->setCellValue('E' . $cells, "$service1$service2$service3$service4")
    ->setCellValue('F' . $cells, "$remarks");
  $cells++;
}


header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Sick-Children-Client-Report.xlsx"');
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