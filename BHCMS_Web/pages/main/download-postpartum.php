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
$objPHPExcel = $objReader->load("Classes/download-postpartum.xlsx");

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

$cells = 6;

$postpartum = mysqli_query($con, "SELECT postpartum_id, patientid, DATE_FORMAT(delivery_date,'%m-%d-%Y') AS deliverydate, delivery_time, 
fname, minitial, lname, purok, address, 
DATE_FORMAT(date_visit_24hr,'%m-%d-%Y') AS visit24hr, DATE_FORMAT(date_visit_1week,'%m-%d-%Y') AS visit1week, 
DATE_FORMAT(date_breastfeed,'%m-%d-%Y') AS datebreastfeed, time_breastfeed, 
DATE_FORMAT(iron_supplementation_1stdate,'%m-%d-%Y') AS iron1stdate, 1stdate_tablets, 
DATE_FORMAT(iron_supplementation_2nddate,'%m-%d-%Y') AS iron2nddate, 2nddate_tablets, 
DATE_FORMAT(iron_supplementation_3rddate,'%m-%d-%Y') AS iron3rddate, 3rddate_tablets, 
DATE_FORMAT(vitamin_supplementation_date,'%m-%d-%Y') AS vitamindate, remarks FROM postpartum 
INNER JOIN client ON postpartum.patientid = client.id");

$userQuery = mysqli_query($con, "SELECT user_id, username, password, CONCAT(fname, ' ', lname) AS fullname from users WHERE type = 'bhw'");
$user = mysqli_fetch_assoc($userQuery);
$preparedByName = $user['fullname'];

if (mysqli_num_rows($postpartum) > 0) {

while ($data = mysqli_fetch_array($postpartum)) {

  $postpartum_id = strip_tags($data['postpartum_id']);
  $deliverydate = strip_tags($data['deliverydate']);
  $deliverytime = strip_tags($data['delivery_time']);
  $fname = strip_tags($data['fname']);
  $minitial = strip_tags($data['minitial']);
  $lname = strip_tags($data['lname']);
  $address = strip_tags($data['purok']) . ', ' . strip_tags($data['address']);
  $visit24hr = strip_tags($data['visit24hr']);
  $visit1week = strip_tags($data['visit1week']);
  $breastfeed = strip_tags($data['datebreastfeed']);
  $breastfeed1 = strip_tags($data['time_breastfeed']);
  $iron1stdate = strip_tags($data['iron1stdate']);
  $irontablet1 = strip_tags($data['1stdate_tablets']);
  $iron2nddate = strip_tags($data['iron2nddate']);
  $irontablet2 = strip_tags($data['2nddate_tablets']);
  $iron3rddate = strip_tags($data['iron3rddate']);
  $irontablet3 = strip_tags($data['3rddate_tablets']);
  $vitamindate = strip_tags($data['vitamindate']);
  $remarks = strip_tags($data['remarks']);


  if ($minitial == "") {
    $fullname = strip_tags($data['fname']) . ' ' . strip_tags($data['lname']);
  } else {
    $fullname = strip_tags($data['fname']) . ' ' . strip_tags($data['minitial']) . ' ' . strip_tags($data['lname']);
  }


  if ($visit24hr == '00-00-0000') {
    $visit24hr = "";
  }
  if ($visit1week == '00-00-0000') {
    $visit1week = "";
  }
  if ($breastfeed == '00-00-0000') {
    $breastfeed = "";
  }
  if ($breastfeed1 < 1) {
    $breastfeed1 = "";
  }
  if ($iron1stdate == '00-00-0000') {
    $iron1stdate = "";
  }
  if ($irontablet1 < 1) {
    $irontablet1 = "";
  }
  if ($iron2nddate == '00-00-0000') {
    $iron2nddate = "";
  }
  if ($irontablet2 < 1) {
    $irontablet2 = "";
  }
  if ($iron3rddate == '00-00-0000') {
    $iron3rddate = "";
  }
  if ($irontablet3 < 1) {
    $irontablet3 = "";
  }
  if ($vitamindate == '00-00-0000') {
    $vitamindate = "";
  }


  $objPHPExcel->getActiveSheet()
    ->setCellValue('A' . $cells, "$deliverydate \n $deliverytime")
    ->setCellValue('B' . $cells, "$fullname")
    ->setCellValue('C' . $cells, "$address")
    ->setCellValue('D' . $cells, "$visit24hr")
    ->setCellValue('E' . $cells, "$visit1week")
    ->setCellValue('F' . $cells, "$breastfeed \n $breastfeed1")
    ->setCellValue('G' . $cells, "$iron1stdate \n $irontablet1")
    ->setCellValue('H' . $cells, "$iron2nddate \n $irontablet2")
    ->setCellValue('I' . $cells, "$iron3rddate \n $irontablet3")
    ->setCellValue('J' . $cells, "$vitamindate")
    ->setCellValue('K' . $cells, "$remarks");
    
  $objPHPExcel->getActiveSheet()
    ->getRowDimension($cells)
    ->setRowHeight(35);

  $cells++;
}

    $objPHPExcel->getActiveSheet()
        ->setCellValue('A' . ($cells + 2), "Prepared by: $preparedByName")
        ->mergeCells('A' . ($cells + 2) . ':K' . ($cells + 2));

    $objPHPExcel->getActiveSheet()
        ->getStyle('A' . ($cells + 2))
        ->getFont()
        ->setSize(12);

    $objPHPExcel->getActiveSheet()
        ->getStyle('A' . ($cells + 2))
        ->getAlignment()
        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT)
        ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

    $objPHPExcel->getActiveSheet()
        ->getRowDimension($cells + 2)
        ->setRowHeight(35);

}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="TCL-Postpartum-Care.xlsx"');
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