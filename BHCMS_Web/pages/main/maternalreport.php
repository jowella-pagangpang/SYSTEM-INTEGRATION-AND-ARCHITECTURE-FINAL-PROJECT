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
$objPHPExcel = $objReader->load("Classes/mytemplates-maternal-report.xlsx");

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
$maternal = mysqli_query($con, "SELECT maternal_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
fname, minitial, lname, purok, address, DATE_FORMAT(lmp,'%m-%d-%Y') AS lmpdate, g, p, DATE_FORMAT(edc,'%m-%d-%Y') AS edcdate, 
DATE_FORMAT(trimester1,'%m-%d-%Y') AS tri1, DATE_FORMAT(trimester1a,'%m-%d-%Y') AS tri1a, 
DATE_FORMAT(trimester2,'%m-%d-%Y') AS tri2, DATE_FORMAT(trimester2a,'%m-%d-%Y') AS tri2a, 
DATE_FORMAT(trimester3,'%m-%d-%Y') AS tri3, DATE_FORMAT(trimester3a,'%m-%d-%Y') AS tri3a, tetanus_status, DATE_FORMAT(tt1date,'%m-%d-%Y') AS tt1, DATE_FORMAT(tt2date,'%m-%d-%Y') AS tt2,
DATE_FORMAT(tt3date,'%m-%d-%Y') AS tt3, DATE_FORMAT(tt4date,'%m-%d-%Y') AS tt4, DATE_FORMAT(tt5date,'%m-%d-%Y') AS tt5,
DATE_FORMAT(iron1date,'%m-%d-%Y') AS iron1st, 1datenumber, DATE_FORMAT(iron2date,'%m-%d-%Y') AS iron2nd, 2datenumber,
DATE_FORMAT(iron3date,'%m-%d-%Y') AS iron3rd, 3datenumber, DATE_FORMAT(iron4date,'%m-%d-%Y') AS iron4th, 4datenumber,
DATE_FORMAT(iron5date,'%m-%d-%Y') AS iron5th, 5datenumber, DATE_FORMAT(iron6date,'%m-%d-%Y') AS iron6th, 6datenumber, DATE_FORMAT(sydate,'%m-%d-%Y') AS sy_date,
syresult, DATE_FORMAT(syresult_date,'%m-%d-%Y') AS result_date, given_penicillin, 
DATE_FORMAT(given_penicillin_date,'%m-%d-%Y') AS penicillin_date, 
DATE_FORMAT(date_terminated,'%m-%d-%Y') AS terminated_date, 
outcome, gender, birth_weight, facility, nid, attended, remarks, rem_tri1, rem_tri1a, rem_tri2, rem_tri2a, rem_tri3, rem_tri3a FROM maternal 
  INNER JOIN client ON maternal.patientid = client.id 
  WHERE 
    NOT (
      (trimester1 != '00-00-0000' OR trimester1a != '00-00-0000') AND 
      (trimester2 != '00-00-0000' OR trimester2a != '00-00-0000') AND 
      (trimester3 != '00-00-0000' OR trimester3a != '00-00-0000')
    )");


$userQuery = mysqli_query($con, "SELECT user_id, username, password, CONCAT(fname, ' ', lname) AS fullname from users WHERE type = 'bhw'");
$user = mysqli_fetch_assoc($userQuery);
$preparedByName = $user['fullname'];

if (mysqli_num_rows($maternal) > 0) {
while ($data = mysqli_fetch_array($maternal)) {
    $maternal_id = strip_tags($data['maternal_id']);
    $patientid = strip_tags($data['patientid']);
    $regdate = strip_tags($data['regdate']);
    $fname = strip_tags($data['fname']);
    $minitial = strip_tags($data['minitial']);
    $lname = strip_tags($data['lname']);
    $address = strip_tags($data['purok']) . ', ' . strip_tags($data['address']);
    $age = strip_tags($data['age']);
    $lmpdate = strip_tags($data['lmpdate']);
    $g = 'G' . strip_tags($data['g']) . ' ' . 'P' . strip_tags($data['p']);
    $edcdate = strip_tags($data['edcdate']);
    $tri1 = strip_tags($data['tri1']);
    $rem_tri1 = strip_tags($data['rem_tri1']);
    $tri1a = strip_tags($data['tri1a']);
    $rem_tri1a = strip_tags($data['rem_tri1a']);
    $tri2 = strip_tags($data['tri2']);
    $rem_tri2 = strip_tags($data['rem_tri2']);
    $tri2a = strip_tags($data['tri2a']);
    $rem_tri2a = strip_tags($data['rem_tri2a']);
    $tri3 = strip_tags($data['tri3']);
    $rem_tri3 = strip_tags($data['rem_tri3']);
    $tri3a = strip_tags($data['tri3a']);
    $rem_tri3a = strip_tags($data['rem_tri3a']);
    $tetanus_status = strip_tags($data['tetanus_status']);
    $tt1 = strip_tags($data['tt1']);
    $tt2 = strip_tags($data['tt2']);
    $tt3 = strip_tags($data['tt3']);
    $tt4 = strip_tags($data['tt4']);
    $tt5 = strip_tags($data['tt5']);
    $iron1st = strip_tags($data['iron1st']);
    $iron1stnum = strip_tags($data['1datenumber']);
    $iron2nd = strip_tags($data['iron2nd']);
    $iron2ndnum = strip_tags($data['2datenumber']);
    $iron3rd = strip_tags($data['iron3rd']);
    $iron3rdnum = strip_tags($data['3datenumber']);
    $iron4th = strip_tags($data['iron4th']);
    $iron4thnum = strip_tags($data['4datenumber']);
    $iron5th = strip_tags($data['iron5th']);
    $iron5thnum = strip_tags($data['5datenumber']);
    $iron6th = strip_tags($data['iron6th']);
    $iron6thnum = strip_tags($data['6datenumber']);
    $sy_date = strip_tags($data['sy_date']);
    $syresult = strip_tags($data['syresult']);
    $syresult1 = strip_tags($data['result_date']);
    $penicillin = strip_tags($data['given_penicillin']);
    $penicillin1 = strip_tags($data['penicillin_date']);
    $terminated_date = strip_tags($data['terminated_date']);
    $outcome = strip_tags($data['outcome']) . " \n " . strip_tags($data['gender']);
    $birth_weight = strip_tags($data['birth_weight']);
    $facility = strip_tags($data['facility']);
    $nid = strip_tags($data['nid']);
    $attended = strip_tags($data['attended']);
    $remarks = strip_tags($data['remarks']);


  if($minitial == "") {
    $fullname = strip_tags($data['fname']) . ' ' . strip_tags($data['lname']);
  } else {
    $fullname = strip_tags($data['fname']) . ' ' . strip_tags($data['minitial']) . ' ' . strip_tags($data['lname']);
  }


  if (
    $tri1 || $tri1a || $tri2 || $tri2a || $tri3 || $tri3a == '00-00-0000'
  ) {
    $status = "Follow-up";
  }


    $trimesters = '';

    if ($tri1 == '00-00-0000' && $tri1a == '00-00-0000') {
        $trimesters .= 'First Trimester' . "\n";
    }

    if ($tri2 == '00-00-0000' && $tri2a == '00-00-0000') {
        $trimesters .= 'Second Trimester' . "\n";
    }

    if ($tri3 == '00-00-0000' && $tri3a == '00-00-0000') {
        $trimesters .= 'Third Trimester' . "\n";
    }

    $trimesters = rtrim($trimesters);

    $remarks = array();

    if ($tri1 == '00-00-0000' && $remarks) {
        $remarks[] = $rem_tri1;
    }
    if ($tri1a == '00-00-0000' && $rem_tri1a) {
        $remarks[] = $rem_tri1a;
    }
    if ($tri2 == '00-00-0000' && $rem_tri2) {
        $remarks[] = $rem_tri2;
    }
    if ($tri2a == '00-00-0000' && $rem_tri2a) {
        $remarks[] = $rem_tri2a;
    }
    if ($tri3 == '00-00-0000' && $rem_tri3) {
        $remarks[] = $rem_tri3;
    }
    if ($tri3a == '00-00-0000' && $rem_tri3a) {
        $remarks[] = $rem_tri3a;
    }

    $remarksCell = implode("\n", $remarks);

    $objPHPExcel->getActiveSheet()
        ->setCellValue('A' . $cells, "$fullname")
        ->setCellValue('B' . $cells, "$regdate")
        ->setCellValue('C' . $cells, "$address")
        ->setCellValue('D' . $cells, "$status")
        ->setCellValue('E' . $cells, "$trimesters")
        ->setCellValue('F' . $cells, "$remarksCell");

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
header('Content-Disposition: attachment;filename="TCL-Maternal-Follow-up-Service.xlsx"');
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