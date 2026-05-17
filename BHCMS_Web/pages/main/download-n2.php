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
$objPHPExcel = $objReader->load("Classes/download-n2.xlsx");

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

$cells = 7;

$nutrition2 = mysqli_query($con, "SELECT nutrition2_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, fname, minitial, lname, 
weight, height, sex, 6to11mos, 12to59mos, mother_name, purok, address, DATE_FORMAT(vitamina,'%m-%d-%Y') AS vitamin, 
DATE_FORMAT(vitamin1,'%m-%d-%Y') AS vitamindose1, DATE_FORMAT(vitamin2,'%m-%d-%Y') AS vitamindose2, 
DATE_FORMAT(iron1,'%m-%d-%Y') AS irondose1, DATE_FORMAT(iron2,'%m-%d-%Y') AS irondose2, 
DATE_FORMAT(mnp1,'%m-%d-%Y') AS mnpdose1, DATE_FORMAT(mnp2,'%m-%d-%Y') AS mnpdose2, 
DATE_FORMAT(deworming,'%m-%d-%Y') AS dewormings, remarks FROM nutrition2 INNER JOIN client ON nutrition2.patientid = client.id");

$userQuery = mysqli_query($con, "SELECT user_id, username, password, CONCAT(fname, ' ', lname) AS fullname from users WHERE type = 'bhw'");
$user = mysqli_fetch_assoc($userQuery);
$preparedByName = $user['fullname'];


if (mysqli_num_rows($nutrition2) > 0) {
while ($data = mysqli_fetch_array($nutrition2)) {

  $nutrition2_id = strip_tags($data['nutrition2_id']);
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
  $vitamin = strip_tags($data['vitamin']);
  $vitamindose1 = strip_tags($data['vitamindose1']);
  $vitamindose2 = strip_tags($data['vitamindose2']);
  $irondose1 = strip_tags($data['irondose1']);
  $irondose2 = strip_tags($data['irondose2']);
  $mnpdose1 = strip_tags($data['mnpdose1']);
  $mnpdose2 = strip_tags($data['mnpdose2']);
  $dewormings = strip_tags($data['dewormings']);
  $remarks = strip_tags($data['remarks']);


  if ($minitial == "") {
    $fullname = strip_tags($data['fname']) . ' ' . strip_tags($data['lname']);
  } else {
    $fullname = strip_tags($data['fname']) . ' ' . strip_tags($data['minitial']) . ' ' . strip_tags($data['lname']);
  }

  if ($weight < 1) {
    $weight = "";
  }
  if ($height < 1) {
    $height = "";
  }
  if ($vitamin == '00-00-0000') {
    $vitamin = "";
  }
  if ($vitamindose1 == '00-00-0000') {
    $vitamindose1 = "";
  }
  if ($vitamindose2 == '00-00-0000') {
    $vitamindose2 = "";
  }
  if ($irondose1 == '00-00-0000') {
    $irondose1 = "";
  }
  if ($irondose2 == '00-00-0000') {
    $irondose2 = "";
  }
  if ($mnpdose1 == '00-00-0000') {
    $mnpdose1 = "";
  }
  if ($mnpdose2 == '00-00-0000') {
    $mnpdose2 = "";
  }
  if ($dewormings == '00-00-0000') {
    $dewormings = "";
  }

  $content = '';

  if ($data['vitamin'] || $data['irondose1'] || $data['mnpdose1'] != '00-00-0000') {
      $content .= nl2br($data['remarks1']);
  }

  if ($data['vitamindose1'] || $data['vitamindose2'] || $data['irondose2'] || $data['mnpdose2'] || $data['dewormings'] != '00-00-0000') {
      $content .= nl2br($data['remarks']);
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
    ->setCellValue('I' . $cells, "$vitamin")
    ->setCellValue('J' . $cells, "$vitamindose1")
    ->setCellValue('K' . $cells, "$vitamindose2")
    ->setCellValue('L' . $cells, "$irondose1")
    ->setCellValue('M' . $cells, "$irondose2")
    ->setCellValue('N' . $cells, "$mnpdose1")
    ->setCellValue('O' . $cells, "$mnpdose2")
    ->setCellValue('P' . $cells, "$dewormings")
    ->setCellValue('Q' . $cells, "$content");
  $cells++;
}

    $objPHPExcel->getActiveSheet()
        ->setCellValue('A' . ($cells + 2), "Prepared by: $preparedByName")
        ->mergeCells('A' . ($cells + 2) . ':Q' . ($cells + 2));

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
header('Content-Disposition: attachment;filename="TCL-Nutrition-EPI.xlsx"');
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