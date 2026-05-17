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
$objPHPExcel = $objReader->load("Classes/mytemplates-immunization.xlsx");

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

$cells = 6;
$newDate = date("Y/m/d", strtotime($datenow . " +7 days"));

$immunization = mysqli_query($con, "SELECT immunization_id, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, se_status, fname, minitial, lname, 
sex, mother_name, purok, address, cpab1, cpab2 
FROM immunization WHERE reg_date between '$datenow' AND '$newDate'");


while ($data = mysqli_fetch_array($immunization)) {
  $immunization_id = strip_tags($data['immunization_id']);
  $regdate = strip_tags($data['regdate']);
  $birthdate = strip_tags($data['birthdate']);
  $se_status = strip_tags($data['se_status']);
  $fname = strip_tags($data['fname']);
  $minitial = strip_tags($data['minitial']);
  $lname = strip_tags($data['lname']);
  $sex = strip_tags($data['sex']);
  $mother_name = strip_tags($data['mother_name']);
  $address = strip_tags($data['purok']) . ', ' . strip_tags($data['address']);
  $cpab1 = strip_tags($data['cpab1']);
  $cpab2 = strip_tags($data['cpab2']);

  if($minitial == "") {
    $fullname = strip_tags($data['fname']) . ' ' . strip_tags($data['lname']);
  } else {
    $fullname = strip_tags($data['fname']) . ' ' . strip_tags($data['minitial']) . ' ' . strip_tags($data['lname']);
  }

  $objPHPExcel->getActiveSheet()
    ->setCellValue('A' . $cells, "$regdate")
    ->setCellValue('B' . $cells, "$birthdate")
    ->setCellValue('C' . $cells, "$se_status")
    ->setCellValue('D' . $cells, "$fullname")
    ->setCellValue('E' . $cells, "$sex")
    ->setCellValue('F' . $cells, "$mother_name")
    ->setCellValue('G' . $cells, "$address")
    ->setCellValue('H' . $cells, "$cpab1")
    ->setCellValue('I' . $cells, "$cpab2");
  $cells++;
}


// Create a second sheet
echo date('H:i:s'), " Add data", EOL;
$objPHPExcel->setActiveSheetIndex(1);

  $datenow = $_GET['date']; 

$cells = 7;
$newDate = date("Y/m/d", strtotime($datenow . " +7 days"));

$immunization = mysqli_query($con, "SELECT immunization_id, reg_date, length, weight, birth_weight_status, 
DATE_FORMAT(initiated_breastfeed,'%m-%d-%Y') AS breastfeed, DATE_FORMAT(bcg,'%m-%d-%Y') AS bcgdate,
DATE_FORMAT(hepab,'%m-%d-%Y') AS hepabdate, DATE_FORMAT(dpt_hib_hepb_1stdose,'%m-%d-%Y') AS dpt_hib_hepb1, 
DATE_FORMAT(dpt_hib_hepb_2nddose,'%m-%d-%Y') AS dpt_hib_hepb2, DATE_FORMAT(dpt_hib_hepb_3rddose,'%m-%d-%Y') AS dpt_hib_hepb3,
DATE_FORMAT(opv_1stdose,'%m-%d-%Y') AS opv1, DATE_FORMAT(opv_2nddose,'%m-%d-%Y') AS opv2,
DATE_FORMAT(opv_3rddose,'%m-%d-%Y') AS opv3, DATE_FORMAT(pcv_1stdose,'%m-%d-%Y') AS pcv1, DATE_FORMAT(pcv_2nddose,'%m-%d-%Y') AS pcv2,
DATE_FORMAT(pcv_3rddose,'%m-%d-%Y') AS pcv3, DATE_FORMAT(ipv,'%m-%d-%Y') AS ipvdate, DATE_FORMAT(mmr1stdose,'%m-%d-%Y') AS mmr1, 
DATE_FORMAT(mmr2nddose,'%m-%d-%Y') AS mmr2, DATE_FORMAT(fic_date,'%m-%d-%Y') AS fic,
remarks FROM immunization WHERE reg_date between '$datenow' AND '$newDate'");


while ($data = mysqli_fetch_array($immunization)) {
  $immunization_id = strip_tags($data['immunization_id']);
  $length = strip_tags($data['length']);
  $weight = strip_tags($data['weight']);
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
  $remarks = strip_tags($data['remarks']);


  if ($length < 1) {
    $length = "";
  }
  if ($weight < 1) {
    $weight = "";
  }
  if ($breastfeed == '00-00-0000') {
    $breastfeed = "";
  }
  if ($bcgdate == '00-00-0000') {
    $bcgdate = "";
  }
  if ($hepabdate == '00-00-0000') {
    $hepabdate = "";
  }
  if ($dpt_hib_hepb1 == '00-00-0000') {
    $dpt_hib_hepb1 = "";
  }
  if ($dpt_hib_hepb2 == '00-00-0000') {
    $dpt_hib_hepb2 = "";
  }
  if ($dpt_hib_hepb3 == '00-00-0000') {
    $dpt_hib_hepb3 = "";
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
  if ($pcv1 == '00-00-0000') {
    $pcv1 = "";
  }
  if ($pcv2 == '00-00-0000') {
    $pcv2 = "";
  }
  if ($pcv3 == '00-00-0000') {
    $pcv3 = "";
  }
  if ($ipvdate == '00-00-0000') {
    $ipvdate = "";
  }
  if ($mmr1 == '00-00-0000') {
    $mmr1 = "";
  }
  if ($mmr2 == '00-00-0000') {
    $mmr2 = "";
  }
  if ($fic == '00-00-0000') {
    $fic = "";
  }


  $objPHPExcel->getActiveSheet()
    ->setCellValue('A' . $cells, "$length")
    ->setCellValue('B' . $cells, "$weight")
    ->setCellValue('C' . $cells, "$birth_weight_status")
    ->setCellValue('D' . $cells, "$breastfeed")
    ->setCellValue('E' . $cells, "$bcgdate")
    ->setCellValue('F' . $cells, "$hepabdate")
    ->setCellValue('G' . $cells, "$dpt_hib_hepb1")
    ->setCellValue('H' . $cells, "$dpt_hib_hepb2")
    ->setCellValue('I' . $cells, "$dpt_hib_hepb3")
    ->setCellValue('J' . $cells, "$opv1")
    ->setCellValue('K' . $cells, "$opv2")
    ->setCellValue('L' . $cells, "$opv3")
    ->setCellValue('M' . $cells, "$pcv1")
    ->setCellValue('N' . $cells, "$pcv2")
    ->setCellValue('O' . $cells, "$pcv3")
    ->setCellValue('P' . $cells, "$ipvdate")
    ->setCellValue('Q' . $cells, "$mmr1")
    ->setCellValue('R' . $cells, "$mmr2")
    ->setCellValue('S' . $cells, "$fic")
    ->setCellValue('T' . $cells, "$remarks");
  $cells++;
}



header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Immunization_0-12_months_Weekly_Report.xlsx"');
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