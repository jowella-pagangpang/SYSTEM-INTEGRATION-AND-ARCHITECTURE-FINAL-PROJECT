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
$objPHPExcel = $objReader->load("Classes/mytemplates-nutrition1.xlsx");

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

$datenow = $_GET['date1'];
$lastday = $_GET['date2'];
$startdate = date("Y-m-d", strtotime($datenow));
$enddate = date("Y-m-d", strtotime($lastday));

$cells = 6;

$nutrition1 = mysqli_query($con, "SELECT nutrition1_id, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
fname, minitial, lname, weight, height, sex, mother_name, 
purok, address, DATE_FORMAT(screening_done,'%m-%d-%Y') AS done, tetanus_status, 
DATE_FORMAT(date_ttstatus,'%m-%d-%Y') AS datett, DATE_FORMAT(date_assess,'%m-%d-%Y') AS assess 
FROM nutrition1 WHERE reg_date between '$startdate' AND '$enddate'");

while ($data = mysqli_fetch_array($nutrition1)) {

  $nutrition1_id = strip_tags($data['nutrition1_id']);
  $regdate = strip_tags($data['regdate']);
  $birthdate = strip_tags($data['birthdate']);
  $fname = strip_tags($data['fname']);
  $minitial = strip_tags($data['minitial']);
  $lname = strip_tags($data['lname']);
  $weight = strip_tags($data['weight']);
  $height = strip_tags($data['height']);
  $sex = strip_tags($data['sex']);
  $mother_name = strip_tags($data['mother_name']);
  $address = strip_tags($data['purok']) . ', ' . strip_tags($data['address']);
  $done = strip_tags($data['done']);
  $ttstatus = strip_tags($data['tetanus_status']);
  $datett = strip_tags($data['datett']);
  $assess = strip_tags($data['assess']);

  if ($minitial == "") {
    $fullname = strip_tags($data['fname']) . ' ' . strip_tags($data['lname']);
  } else {
    $fullname = strip_tags($data['fname']) . ' ' . strip_tags($data['minitial']) . ' ' . strip_tags($data['lname']);
  }

  if ($done == '00-00-0000') {
    $done = "";
  }
  if ($datett == '00-00-0000') {
    $datett = "";
  }
  if ($assess == '00-00-0000') {
    $assess = "";
  }


  $objPHPExcel->getActiveSheet()
    ->setCellValue('A' . $cells, "$regdate")
    ->setCellValue('B' . $cells, "$birthdate")
    ->setCellValue('C' . $cells, "$fullname")
    ->setCellValue('D' . $cells, "$weight")
    ->setCellValue('E' . $cells, "$height")
    ->setCellValue('F' . $cells, "$sex")
    ->setCellValue('G' . $cells, "$mother_name")
    ->setCellValue('H' . $cells, "$address")
    ->setCellValue('I' . $cells, "$done")
    ->setCellValue('J' . $cells, "$ttstatus \n $datett")
    ->setCellValue('K' . $cells, "$assess");
  $cells++;
}


// Create a second sheet
echo date('H:i:s'), " Add data", EOL;
$objPHPExcel->setActiveSheetIndex(1);

$datenow = $_GET['date1'];
$lastday = $_GET['date2'];
$startdate = date("Y-m-d", strtotime($datenow));
$enddate = date("Y-m-d", strtotime($lastday));

$cells = 6;

$nutrition1 = mysqli_query($con, "SELECT nutrition1_id, reg_date, DATE_FORMAT(bcg,'%m-%d-%Y') AS bcgdate, 
DATE_FORMAT(hepab1,'%m-%d-%Y') AS hepadate, DATE_FORMAT(pentavalent1st,'%m-%d-%Y') AS penta1, 
DATE_FORMAT(pentavalent2nd,'%m-%d-%Y') AS penta2, DATE_FORMAT(pentavalent3rd, '%m-%d-%Y') AS penta3, 
DATE_FORMAT(opv1st,'%m-%d-%Y') AS opv1, DATE_FORMAT(opv2nd,'%m-%d-%Y') AS opv2, 
DATE_FORMAT(opv3rd,'%m-%d-%Y') AS opv3, DATE_FORMAT(ipv,'%m-%d-%Y') AS ipv1, 
DATE_FORMAT(mcv1,'%m-%d-%Y') AS mcv1st, DATE_FORMAT(mcv2,'%m-%d-%Y') AS mcv2nd, 
DATE_FORMAT(ficdate,'%m-%d-%Y') AS fic, DATE_FORMAT(breastfed1st,'%m-%d-%Y') AS breastfed1, 
DATE_FORMAT(breastfed2nd,'%m-%d-%Y') AS breastfed2, DATE_FORMAT(breastfed3rd,'%m-%d-%Y') AS breastfed3, 
DATE_FORMAT(breastfed4th, '%m-%d-%Y') AS breastfed4, DATE_FORMAT(breastfed5th,'%m-%d-%Y') AS breastfed5, 
DATE_FORMAT(breastfed6th,'%m-%d-%Y') AS breastfed6, 
DATE_FORMAT(complementary,'%m-%d-%Y') AS comple, remarks FROM nutrition1 
WHERE reg_date between '$startdate' AND '$enddate'");

while ($data = mysqli_fetch_array($nutrition1)) {

  $bcgdate = strip_tags($data['bcgdate']);
  $hepadate = strip_tags($data['hepadate']);
  $penta1 = strip_tags($data['penta1']);
  $penta2 = strip_tags($data['penta2']);
  $penta3 = strip_tags($data['penta3']);
  $opv1 = strip_tags($data['opv1']);
  $opv2 = strip_tags($data['opv2']);
  $opv3 = strip_tags($data['opv3']);
  $ipv1 = strip_tags($data['ipv1']);
  $mcv1st = strip_tags($data['mcv1st']);
  $mcv2nd = strip_tags($data['mcv2nd']);
  $fic = strip_tags($data['fic']);
  $breastfed1 = strip_tags($data['breastfed1']);
  $breastfed2 = strip_tags($data['breastfed2']);
  $breastfed3 = strip_tags($data['breastfed3']);
  $breastfed4 = strip_tags($data['breastfed4']);
  $breastfed5 = strip_tags($data['breastfed5']);
  $breastfed6 = strip_tags($data['breastfed6']);
  $comple = strip_tags($data['comple']);
  $remarks = strip_tags($data['remarks']);

  if ($bcgdate == '00-00-0000') {
    $bcgdate = "";
  }
  if ($hepadate == '00-00-0000') {
    $hepadate = "";
  }
  if ($penta1 == '00-00-0000') {
    $penta1 = "";
  }
  if ($penta2 == '00-00-0000') {
    $penta2 = "";
  }
  if ($penta3 == '00-00-0000') {
    $penta3 = "";
  }
  if ($opv1 == '00-00-0000') {
    $opv1 = "";
  }
  if ($opv2 == '00-00-0000') {
    $opv2 = "";
  }
  if ($opv3 == '00-00-0000') {
    $opv3 = "";
  }
  if ($ipv1 == '00-00-0000') {
    $ipv1 = "";
  }
  if ($mcv1st == '00-00-0000') {
    $mcv1st = "";
  }
  if ($mcv2nd == '00-00-0000') {
    $mcv2nd = "";
  }
  if ($fic == '00-00-0000') {
    $fic = "";
  }
  if ($breastfed1 == '00-00-0000') {
    $breastfed1 = "";
  }
  if ($breastfed2 == '00-00-0000') {
    $breastfed2 = "";
  }
  if ($breastfed3 == '00-00-0000') {
    $breastfed3 = "";
  }
  if ($breastfed4 == '00-00-0000') {
    $breastfed4 = "";
  }
  if ($breastfed5 == '00-00-0000') {
    $breastfed5 = "";
  }
  if ($breastfed6 == '00-00-0000') {
    $breastfed6 = "";
  }
  if ($comple == '00-00-0000') {
    $comple = "";
  }


  $objPHPExcel->getActiveSheet()
    ->setCellValue('A' . $cells, "$bcgdate")
    ->setCellValue('B' . $cells, "$hepadate")
    ->setCellValue('C' . $cells, "$penta1")
    ->setCellValue('D' . $cells, "$penta2")
    ->setCellValue('E' . $cells, "$penta3")
    ->setCellValue('F' . $cells, "$opv1")
    ->setCellValue('G' . $cells, "$opv2")
    ->setCellValue('H' . $cells, "$opv3")
    ->setCellValue('I' . $cells, "$ipv1")
    ->setCellValue('J' . $cells, "$mcv1st")
    ->setCellValue('K' . $cells, "$mcv2nd")
    ->setCellValue('L' . $cells, "$fic")
    ->setCellValue('M' . $cells, "$breastfed1")
    ->setCellValue('N' . $cells, "$breastfed2")
    ->setCellValue('O' . $cells, "$breastfed3")
    ->setCellValue('P' . $cells, "$breastfed4")
    ->setCellValue('Q' . $cells, "$breastfed5")
    ->setCellValue('R' . $cells, "$breastfed6")
    ->setCellValue('S' . $cells, "$comple")
    ->setCellValue('T' . $cells, "$remarks");
  $cells++;
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="TCL-Nutrition-EPI-I-Report.xlsx"');
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