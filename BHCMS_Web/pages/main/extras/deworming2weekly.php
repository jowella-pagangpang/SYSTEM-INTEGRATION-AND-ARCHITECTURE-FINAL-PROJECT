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
$objPHPExcel = $objReader->load("Classes/mytemplates-deworming2.xlsx");

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

  $datenow = $_GET['date'];

$cells = 4;
$newDate = date("Y/m/d", strtotime($datenow . " +7 days"));
$deworming2nd = mysqli_query($con, "SELECT deworming2_id, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
fname, minitial, lname, sex, mother_name, 
purok, address, age, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks 
FROM deworming2 WHERE reg_date between '$datenow' AND '$newDate'");

while ($data = mysqli_fetch_array($deworming2nd)) {
  $deworming2_id = strip_tags($data['deworming2_id']);
  $regdate = strip_tags($data['regdate']);
  $birthdate = strip_tags($data['birthdate']);
  $fname = strip_tags($data['fname']);
  $minitial = strip_tags($data['minitial']);
  $lname = strip_tags($data['lname']);
  $sex = strip_tags($data['sex']);
  $mother_name = strip_tags($data['mother_name']);
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

  
  if($firstdose<1)
  {
    $firstdose = "";
  }
  if($seconddose<1)
  {
    $seconddose = "";
  }


  $objPHPExcel->getActiveSheet()
    ->setCellValue('A' . $cells, "$regdate")
    ->setCellValue('B' . $cells, "$birthdate")
    ->setCellValue('C' . $cells, "$fullname")
    ->setCellValue('D' . $cells, "$sex")
    ->setCellValue('E' . $cells, "$mother_name")
    ->setCellValue('F' . $cells, "$address")
    ->setCellValue('G' . $cells, "$age")
    ->setCellValue('H' . $cells, "$firstdose")
    ->setCellValue('I' . $cells, "$seconddose")
    ->setCellValue('J' . $cells, "$remarks");
  $cells++;
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Deworming_5-9_Weekly_Report.xlsx"');
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