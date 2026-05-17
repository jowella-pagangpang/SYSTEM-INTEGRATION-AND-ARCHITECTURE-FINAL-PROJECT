<?php

include('../dbcon.php');

session_start();
if (!isset($_SESSION['type'])) {
  header("Location: ../../index.php");
} else {
  ob_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Initialize variables with default values
$date = '';
$newDate = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $service = isset($_POST['service']) ? $_POST['service'] : '';
    $frequency = isset($_POST['frequency']) ? $_POST['frequency'] : '';
    $week = isset($_POST['week']) ? $_POST['week'] : '';
    $month = isset($_POST['month']) ? $_POST['month'] : '';
    $year = isset($_POST['year']) ? $_POST['year'] : '';
    $fromDate = isset($_POST['fromDate']) ? $_POST['fromDate'] : '';
    $toDate = isset($_POST['toDate']) ? $_POST['toDate'] : '';

    // Update the values of $date and $newDate based on $frequency
    if ($frequency == 'weekly') {
        $date = date("Y-m-d", strtotime($week));
        $newDate = date("Y-m-d", strtotime($week . " +7 days"));
    } 
    elseif ($frequency == 'monthly') {
        $datestart = "$year-$month-01";
        $date = date('Y-m-d', strtotime($datestart));
        $newDate = date('Y-m-t', strtotime("$year-$month-01"));
    } 
    elseif ($frequency == 'range') {
        $date = $fromDate;
        $newDate = $toDate;
    }
}



if ($service == "deworming") {
  $title = "DEWORMING SERVICES";
}
if ($service == "immunization") {
  $title = "IMMUNIZATION AND NUTRITION SERVICES FOR 0-12 MONTHS OLD";
}
if ($service == "nutrition2") {
  $title = "NUTRITION AND EXPANDED PROGRAM FOR IMMUNIZATION";
}
if ($service == "sickchildren") {
  $title = "SICK CHILDREN";
}
if ($service == "maternal") {
  $title = "MATERNAL CARE";
}
if ($service == "postpartum") {
  $title = "POSTPARTUM CARE";
}

 
function fetch_data($date, $newDate)  
{  
    $output = '';  

    $con = mysqli_connect("localhost", "root", "", "healthrecord");  
    $sql = "SELECT id, deworming_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
            DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
            CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, sex, mother_name, 
            CONCAT(purok, ', ', address) AS caddress, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
            DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks, remarks_1stdose, 
            remarks_2nddose FROM deworming INNER JOIN client ON deworming.patientid = client.id 
            AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 1 AND 4 WHERE reg_date between '$date' AND '$newDate' ORDER BY id ASC";  

    $userQuery = mysqli_query($con, "SELECT user_id, username, password, CONCAT(fname, ' ', lname) AS fullname from users WHERE type = 'bhw'");
    $user = mysqli_fetch_assoc($userQuery);
    $preparedByName = $user['fullname'];

    $result = mysqli_query($con, $sql);  
    if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result))  
    {       
        $birthdate = $row['birthdate'];
        $firstDose = $row['1st_dose'];
        $secondDose = $row['2nd_dose'];

        $output .= '<tr>  
                        <td>'.$row["regdate"].'</td>  
                        <td>'.$row["birthdate"].'</td>  
                        <td>'.$row["fullname"].'</td>  
                        <td>'.$row["sex"].'</td>  
                        <td>'.$row["mother_name"].'</td>  
                        <td>'.$row["caddress"].'</td>' .
        
                        '<td>';
                    
                    if ($birthdate != '00-00-0000') {
                        $birthDateObj = DateTime::createFromFormat('m-d-Y', $birthdate);

                        if ($birthDateObj === false) {
                            echo "Failed to parse the birthdate.";
                        } else {
                            $currentDateObj = new DateTime();
                            $age = $birthDateObj->diff($currentDateObj);

                            $years = $age->y;
                            $months = $age->m;

                            if ($years == 0) {
                                if ($months == 1) {
                                    $output .= "1 month";
                                } elseif ($months == 0) {
                                    $output .= "0 month";
                                } else {
                                    $output .= "$months months";
                                }
                            } elseif ($years == 1) {
                                $output .= "1 year old";
                            } else {
                                $output .= "$years years old";
                            }
                        }
                    }

                $output .= '</td> 
                        <td>'.($firstDose != '00-00-0000' ? $row["1st_dose"] : '').'</td>  
                        <td>'.($secondDose != '00-00-0000' ? $row["2nd_dose"] : '').'</td>  
                        <td>'.nl2br($row['remarks']).'</td>  
                    </tr>';  
    }  
    $output .= '<br><p align="left"><strong>Prepared by:</strong> ' . $preparedByName . '</p>';

    return $output;
  }
}

function fetch_data1($date, $newDate)  
{  
    $output = '';  

    $con = mysqli_connect("localhost", "root", "", "healthrecord");  
    $sql = "SELECT id, deworming_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
            DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
            CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, sex, mother_name, 
            CONCAT(purok, ', ', address) AS caddress, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
            DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks, remarks_1stdose, 
            remarks_2nddose FROM deworming INNER JOIN client ON deworming.patientid = client.id 
            AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 5 AND 9 WHERE reg_date between '$date' AND '$newDate' ORDER BY id ASC";  

    $userQuery = mysqli_query($con, "SELECT user_id, username, password, CONCAT(fname, ' ', lname) AS fullname from users WHERE type = 'bhw'");
    $user = mysqli_fetch_assoc($userQuery);
    $preparedByName = $user['fullname'];

    $result = mysqli_query($con, $sql);  
    if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result))  

    {       
        $birthdate = $row['birthdate'];
        $firstDose = $row['1st_dose'];
        $secondDose = $row['2nd_dose'];

        $output .= '<tr>  
                        <td>'.$row["regdate"].'</td>  
                        <td>'.$row["birthdate"].'</td>  
                        <td>'.$row["fullname"].'</td>  
                        <td>'.$row["sex"].'</td>  
                        <td>'.$row["mother_name"].'</td>  
                        <td>'.$row["caddress"].'</td>' .
        
                        '<td>';
                    
                    if ($birthdate != '00-00-0000') {
                        $birthDateObj = DateTime::createFromFormat('m-d-Y', $birthdate);

                        if ($birthDateObj === false) {
                            echo "Failed to parse the birthdate.";
                        } else {
                            $currentDateObj = new DateTime();
                            $age = $birthDateObj->diff($currentDateObj);

                            $years = $age->y;
                            $months = $age->m;

                            if ($years == 0) {
                                if ($months == 1) {
                                    $output .= "1 month";
                                } elseif ($months == 0) {
                                    $output .= "0 month";
                                } else {
                                    $output .= "$months months";
                                }
                            } elseif ($years == 1) {
                                $output .= "1 year old";
                            } else {
                                $output .= "$years years old";
                            }
                        }
                    }

                $output .= '</td> 
                        <td>'.($firstDose != '00-00-0000' ? $row["1st_dose"] : '').'</td>  
                        <td>'.($secondDose != '00-00-0000' ? $row["2nd_dose"] : '').'</td>  
                        <td>'.nl2br($row['remarks']).'</td>  
                    </tr>';  
    }  
    $output .= '<br><p align="left"><strong>Prepared by:</strong> ' . $preparedByName . '</p>';

    return $output;
  }
}

function fetch_data2($date, $newDate)  
{  
    $output = '';   

    $con = mysqli_connect("localhost", "root", "", "healthrecord");  
    $sql = "SELECT id, deworming_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
            DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
            CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, sex, mother_name, 
            CONCAT(purok, ', ', address) AS caddress, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
            DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks, remarks_1stdose, 
            remarks_2nddose FROM deworming INNER JOIN client ON deworming.patientid = client.id 
            AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 10 AND 19 WHERE reg_date between '$date' AND '$newDate' ORDER BY id ASC";  

    $userQuery = mysqli_query($con, "SELECT user_id, username, password, CONCAT(fname, ' ', lname) AS fullname from users WHERE type = 'bhw'");
    $user = mysqli_fetch_assoc($userQuery);
    $preparedByName = $user['fullname'];

    $result = mysqli_query($con, $sql);  
    if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result))  
    {       
        $birthdate = $row['birthdate'];
        $firstDose = $row['1st_dose'];
        $secondDose = $row['2nd_dose'];

        $output .= '<tr>  
                        <td>'.$row["regdate"].'</td>  
                        <td>'.$row["birthdate"].'</td>  
                        <td>'.$row["fullname"].'</td>  
                        <td>'.$row["sex"].'</td>  
                        <td>'.$row["mother_name"].'</td>  
                        <td>'.$row["caddress"].'</td>' .
        
                        '<td>';
                    
                    if ($birthdate != '00-00-0000') {
                        $birthDateObj = DateTime::createFromFormat('m-d-Y', $birthdate);

                        if ($birthDateObj === false) {
                            echo "Failed to parse the birthdate.";
                        } else {
                            $currentDateObj = new DateTime();
                            $age = $birthDateObj->diff($currentDateObj);

                            $years = $age->y;
                            $months = $age->m;

                            if ($years == 0) {
                                if ($months == 1) {
                                    $output .= "1 month";
                                } elseif ($months == 0) {
                                    $output .= "0 month";
                                } else {
                                    $output .= "$months months";
                                }
                            } elseif ($years == 1) {
                                $output .= "1 year old";
                            } else {
                                $output .= "$years years old";
                            }
                        }
                    }

                $output .= '</td> 
                        <td>'.($firstDose != '00-00-0000' ? $row["1st_dose"] : '').'</td>  
                        <td>'.($secondDose != '00-00-0000' ? $row["2nd_dose"] : '').'</td>  
                        <td>'.nl2br($row['remarks']).'</td>  
                    </tr>';  
    }  
    $output .= '<br><p align="left"><strong>Prepared by:</strong> ' . $preparedByName . '</p>';

    return $output;
  }
}


if(isset($_POST["generate_pdf"]))  
 {  
      require_once('../pdf_export/tcpdf/tcpdf.php');  
      $obj_pdf = new TCPDF('L', PDF_UNIT, 'LETTER', true, 'UTF-8', false);
      $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetTitle("TCL Deworming Services Report");  
      $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
      $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
      $obj_pdf->SetDefaultMonospacedFont('helvetica');  
      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
      $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
      $obj_pdf->setPrintHeader(false);  
      $obj_pdf->setPrintFooter(false);  
      $obj_pdf->SetAutoPageBreak(TRUE, 10);  
      $obj_pdf->SetFont('helvetica', '', 11);

    // First Page
    $obj_pdf->AddPage();
    $content = ''; 
    $content .= '
    <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
        <tr>
            <td align="left"><img src="../../img/seal.jpg" alt="Logo 1" style="height: 50px;"></td>
            <td align="center" style="font-weight: bold;"><h4>Republic of the Philippines
            <br>Province of Cavite
            <br>TAGAYTAY CITY
            <br>BARANGAY MAHARLIKA EAST</h4></td>
            <td align="right"><img src="../../img/logo.png" alt="Logo 2" style="height: 50px;"></td>
        </tr>
    </table>
    <br><h3 align="center">TARGET CLIENT LIST FOR DEWORMING SERVICES FOR 1-4 YEARS OLD</h3><br />
    ';

    // $content .= '<h4 class="font-weight-bold">from ' . date('m-d-Y', strtotime($date)) . ' to ' . date('m-d-Y', strtotime($newDate)) . '</h4>';

    $content .= '
    <table border="1" cellspacing="0" cellpadding="3" style="width: 100%; text-align: center;">
        <tr style="font-weight: bold;">
            <th>Date of Registration</th>
            <th>Date of Birth</th>
            <th>Name of Child</th>
            <th width="5%">Sex</th>
            <th>Name of Mother</th>
            <th width="15%">Complete Address</th>
            <th>Age</th>
            <th>1st Dose (date given)</th>
            <th>2nd Dose (date given)</th>
            <th>Remarks</th>
        </tr>';
    $content .= fetch_data($date, $newDate);
    $content .= '</table>';
    $obj_pdf->writeHTML($content);


    // Second Page
    $obj_pdf->AddPage();
    $content = '';
    $content .= '
    <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
        <tr>
            <td align="left"><img src="../../img/seal.jpg" alt="Logo 1" style="height: 50px;"></td>
            <td align="center" style="font-weight: bold;"><h4>Republic of the Philippines
            <br>Province of Cavite
            <br>TAGAYTAY CITY
            <br>BARANGAY MAHARLIKA EAST</h4></td>
            <td align="right"><img src="../../img/logo.png" alt="Logo 2" style="height: 50px;"></td>
        </tr>
    </table>
    <br><h3 align="center">TARGET CLIENT LIST FOR DEWORMING SERVICES FOR 5-9 YEARS OLD</h3><br />
    <table border="1" cellspacing="0" cellpadding="3" style="width: 100%; text-align: center;">
        <tr style="font-weight: bold;">
            <th>Date of Registration</th>
            <th>Date of Birth</th>
            <th>Name of Child</th>
            <th width="5%">Sex</th>
            <th>Name of Mother</th>
            <th width="15%">Complete Address</th>
            <th>Age</th>
            <th>1st Dose (date given)</th>
            <th>2nd Dose (date given)</th>
            <th>Remarks</th>
        </tr>';
    $content .= fetch_data1($date, $newDate);
    $content .= '</table>';
    $obj_pdf->writeHTML($content);


    // Third Page
    $obj_pdf->AddPage();
    $content = '';
    $content .= '
    <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
        <tr>
            <td align="left"><img src="../../img/seal.jpg" alt="Logo 1" style="height: 50px;"></td>
            <td align="center" style="font-weight: bold;"><h4>Republic of the Philippines
            <br>Province of Cavite
            <br>TAGAYTAY CITY
            <br>BARANGAY MAHARLIKA EAST</h4></td>
            <td align="right"><img src="../../img/logo.png" alt="Logo 2" style="height: 50px;"></td>
        </tr>
    </table>
    <br><h3 align="center">TARGET CLIENT LIST FOR DEWORMING SERVICES FOR 10-19 YEARS OLD</h3><br />
    <table border="1" cellspacing="0" cellpadding="3" style="width: 100%; text-align: center;">
        <tr style="font-weight: bold;">
            <th>Date of Registration</th>
            <th>Date of Birth</th>
            <th>Name of Child</th>
            <th width="5%">Sex</th>
            <th>Name of Mother</th>
            <th width="15%">Complete Address</th>
            <th>Age</th>
            <th>1st Dose (date given)</th>
            <th>2nd Dose (date given)</th>
            <th>Remarks</th>
        </tr>';
    $content .= fetch_data2($date, $newDate);
    $content .= '</table>';
    $obj_pdf->writeHTML($content);

    $obj_pdf->Output('TCL-Deworming-Report.pdf', 'D');  
    exit;
}

function fetch_data3($date, $newDate)  
{  
    $output = '';  
    $con = mysqli_connect("localhost", "root", "", "healthrecord");  
    $sql = "SELECT id, postpartum_id, patientid, DATE_FORMAT(delivery_date,'%m-%d-%Y') AS deliverydate, delivery_time, 
    CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, CONCAT(purok, ', ', address) AS caddress, 
    DATE_FORMAT(date_visit_24hr,'%m-%d-%Y') AS visit24hr, DATE_FORMAT(date_visit_1week,'%m-%d-%Y') AS visit1week, 
    DATE_FORMAT(date_breastfeed,'%m-%d-%Y') AS datebreastfeed, time_breastfeed, 
    DATE_FORMAT(iron_supplementation_1stdate,'%m-%d-%Y') AS iron1stdate, 1stdate_tablets, 
    DATE_FORMAT(iron_supplementation_2nddate,'%m-%d-%Y') AS iron2nddate, 2nddate_tablets, 
    DATE_FORMAT(iron_supplementation_3rddate,'%m-%d-%Y') AS iron3rddate, 3rddate_tablets, 
    DATE_FORMAT(vitamin_supplementation_date,'%m-%d-%Y') AS vitamindate, remarks, remarks_24hr, 
    remarks_1week FROM postpartum INNER JOIN client ON postpartum.patientid = client.id WHERE delivery_date 
    between '$date' AND '$newDate' ORDER BY id ASC";  

    $userQuery = mysqli_query($con, "SELECT user_id, username, password, CONCAT(fname, ' ', lname) AS fullname from users WHERE type = 'bhw'");
    $user = mysqli_fetch_assoc($userQuery);
    $preparedByName = $user['fullname'];

    $result = mysqli_query($con, $sql);  
    if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result)) 
    {

      $output .= '<tr>  
          <td>' . $row["deliverydate"] . "\n" . $row["delivery_time"] . '</td>  
          <td>' . $row["fullname"] . '</td>  
          <td>' . $row["caddress"] . '</td>
          <td>' . (isset($row["visit24hr"]) && $row["visit24hr"] != '00-00-0000' ? $row["visit24hr"] : '') . '</td>  
          <td>' . (isset($row["visit1week"]) && $row["visit1week"] != '00-00-0000' ? $row["visit1week"] : '') . '</td>
          <td>' . (isset($row["datebreastfeed"]) && $row["datebreastfeed"] != '00-00-0000' ? $row["datebreastfeed"] . "\n" . $row["time_breastfeed"] : '') . '</td>
          <td>' . (isset($row["iron1stdate"]) && $row["iron1stdate"] != '00-00-0000' ? $row["iron1stdate"] . "\n" 
          . (($row["1stdate_tablets"]) && $row["1stdate_tablets"] > 0 ? $row["1stdate_tablets"] : '') : '') . '</td>
          <td>' . (isset($row["iron2nddate"]) && $row["iron2nddate"] != '00-00-0000' ? $row["iron2nddate"] . "\n" 
          . (($row["2nddate_tablets"]) && $row["2nddate_tablets"] > 0 ? $row["2nddate_tablets"] : '') : '') . '</td>
          <td>' . (isset($row["iron3rddate"]) && $row["iron3rddate"] != '00-00-0000' ? $row["iron3rddate"] . "\n" 
          . (($row["3rddate_tablets"]) && $row["3rddate_tablets"] > 0 ? $row["3rddate_tablets"] : '') : '') . '</td>  
          <td>' . (isset($row["vitamindate"]) && $row["vitamindate"] != '00-00-0000' ? $row["vitamindate"] : '') . '</td>     
          <td>' . nl2br($row['remarks']) . '</td>  
          </tr>';
  }
  $output .= '<br><p align="left"><strong>Prepared by:</strong> ' . $preparedByName . '</p>';

  return $output;
}
}

if(isset($_POST["generate_pdf1"]))  
{  
     require_once('../pdf_export/tcpdf/tcpdf.php');  
     $obj_pdf = new TCPDF('L', PDF_UNIT, 'LETTER', true, 'UTF-8', false);
     $obj_pdf->SetCreator(PDF_CREATOR);  
     $obj_pdf->SetTitle("TCL Postpartum Care Report");  
     $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
     $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
     $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
     $obj_pdf->SetDefaultMonospacedFont('helvetica');  
     $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
     $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
     $obj_pdf->setPrintHeader(false);  
     $obj_pdf->setPrintFooter(false);  
     $obj_pdf->SetAutoPageBreak(TRUE, 10);  
     $obj_pdf->SetFont('helvetica', '', 11);  
     $obj_pdf->AddPage();
     $content = ''; 
     $content .= '
   <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
       <tr>
            <td align="left"><img src="../../img/seal.jpg" alt="Logo 1" style="height: 50px;"></td>
            <td align="center" style="font-weight: bold;"><h4>Republic of the Philippines
            <br>Province of Cavite
            <br>TAGAYTAY CITY
            <br>BARANGAY MAHARLIKA EAST</h4></td>
            <td align="right"><img src="../../img/logo.png" alt="Logo 2" style="height: 50px;"></td>
       </tr>
   </table>
   <br><h3 align="center">TARGET CLIENT LIST FOR POSTPARTUM CARE</h3><br />
   <table border="1" cellspacing="0" cellpadding="3" style="width: 100%; text-align: center;">
       <tr style="font-weight: bold;">
       <th rowspan="3">Date <br>and Time <br>of Delivery</th>
       <th rowspan="3">Name</th>
       <th rowspan="3">Address</th>
       <th colspan="2">Date Postpartum Visits</th>
       <th rowspan="3">Date <br>and Time <br>Initiated <br>Brestfeeding</th>
       <th colspan="4">Micronutrient Supplementation</th>
       <th rowspan="3">Remarks</th>
     </tr>
     <tr style="font-weight: bold;">
       <th rowspan="2">Within <br>24 hours <br>after <br>delivery</th>
       <th rowspan="2">Within <br>1 week <br>after <br>delivery</th>
       <th colspan="3">Iron</th>
       <th>Vitamin A</th>
     </tr>
     <tr style="font-weight: bold;">
       <th colspan="3">Date / No. Tablets</th>
       <th>Date</th>
     </tr>
';
$content .= fetch_data3($date, $newDate);
$content .= '</table>';

     $obj_pdf->writeHTML($content);  
     $obj_pdf->Output('TCL-Postpartum-Care-Report.pdf', 'D');  
     exit;
}

function fetch_data4($date, $newDate)  
{  
    $output = '';  
    $con = mysqli_connect("localhost", "root", "", "healthrecord");  

    $sql = "SELECT id, nutrition2_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
    DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, 
    weight, height, sex, 6to11mos, 12to59mos, mother_name, CONCAT(purok, ', ', address) AS caddress FROM nutrition2 
    INNER JOIN client ON nutrition2.patientid = client.id WHERE reg_date between '$date' AND '$newDate' ORDER BY id ASC";  

    $result = mysqli_query($con, $sql);  
    while($row = mysqli_fetch_array($result))  
    {       

        $output .= '<tr>  
        <td>'.$row["nutrition2_id"].'</td>  
        <td>'.$row["regdate"].'</td>  
        <td>'.$row["birthdate"].'</td>  
        <td>'.$row["fullname"].'</td>
        <td>'.(isset($row["weight"]) && $row["weight"] > 0 ? $row["weight"] : '').'</td>
        <td>'.(isset($row["height"]) && $row["height"] > 0 ? $row["height"] : '').'</td>
        <td>'.$row["sex"].'</td>
        <td>'.$row["mother_name"].'</td>
        <td>'.$row["caddress"].'</td> 
        </tr>'; 
    }  
    return $output;
}

function fetch_data5($date, $newDate)  
{  
    $output = '';  
    $con = mysqli_connect("localhost", "root", "", "healthrecord");  

    $sql = "SELECT nutrition2_id, patientid, DATE_FORMAT(vitamina,'%m-%d-%Y') AS vitamin, 
    DATE_FORMAT(vitamin1,'%m-%d-%Y') AS vitamindose1, DATE_FORMAT(vitamin2,'%m-%d-%Y') AS vitamindose2, 
    DATE_FORMAT(iron1,'%m-%d-%Y') AS irondose1, DATE_FORMAT(iron2,'%m-%d-%Y') AS irondose2, 
    DATE_FORMAT(mnp1,'%m-%d-%Y') AS mnpdose1, DATE_FORMAT(mnp2,'%m-%d-%Y') AS mnpdose2, 
    DATE_FORMAT(deworming,'%m-%d-%Y') AS dewormings, remarks, remarks1 FROM nutrition2 
    INNER JOIN client ON nutrition2.patientid = client.id WHERE reg_date between '$date' AND '$newDate' ORDER BY id ASC";  

    $userQuery = mysqli_query($con, "SELECT user_id, username, password, CONCAT(fname, ' ', lname) AS fullname from users WHERE type = 'bhw'");
    $user = mysqli_fetch_assoc($userQuery);
    $preparedByName = $user['fullname'];

    $result = mysqli_query($con, $sql);  
    if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result))  
    {       

        $output .= '<tr>  
        <td>'.(isset($row["vitamin"]) && $row["vitamin"] != '00-00-0000' ? $row["vitamin"] : '').'</td>
        <td>'.(isset($row["vitamindose1"]) && $row["vitamindose1"] != '00-00-0000' ? $row["vitamindose1"] : '').'</td>
        <td>'.(isset($row["vitamindose2"]) && $row["vitamindose2"] != '00-00-0000' ? $row["vitamindose2"] : '').'</td>
        <td>'.(isset($row["irondose1"]) && $row["irondose1"] != '00-00-0000' ? $row["irondose1"] : '').'</td>
        <td>'.(isset($row["irondose2"]) && $row["irondose2"] != '00-00-0000' ? $row["irondose2"] : '').'</td>
        <td>'.(isset($row["mnpdose1"]) && $row["mnpdose1"] != '00-00-0000' ? $row["mnpdose1"] : '').'</td>
        <td>'.(isset($row["mnpdose2"]) && $row["mnpdose2"] != '00-00-0000' ? $row["mnpdose2"] : '').'</td>
        <td>'.(isset($row["dewormings"]) && $row["dewormings"] != '00-00-0000' ? $row["dewormings"] : '').'</td>     
        <td>' . (
            ($row['vitamin'] || $row['irondose1'] || $row['mnpdose1'] != '00-00-0000') ? nl2br($row['remarks1']) : ''
        ) . (
            ($row['vitamindose1'] || $row['vitamindose2'] || $row['irondose2'] || $row['mnpdose2'] || $row['dewormings'] != '00-00-0000') ? nl2br($row['remarks']) : ''
        ) . '</td>  
        </tr>'; 
    }  
    $output .= '<br><p align="left"><strong>Prepared by:</strong> ' . $preparedByName . '</p>';

    return $output;
  }
}


if(isset($_POST["generate_pdf2"]))  
{  
     require_once('../pdf_export/tcpdf/tcpdf.php');  
     $obj_pdf = new TCPDF('L', PDF_UNIT, 'LETTER', true, 'UTF-8', false);
     $obj_pdf->SetCreator(PDF_CREATOR);  
     $obj_pdf->SetTitle("TCL Nutrition EPI Report");  
     $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
     $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
     $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
     $obj_pdf->SetDefaultMonospacedFont('helvetica');  
     $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
     $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
     $obj_pdf->setPrintHeader(false);  
     $obj_pdf->setPrintFooter(false);  
     $obj_pdf->SetAutoPageBreak(TRUE, 10);  
     $obj_pdf->SetFont('helvetica', '', 11);  

    // First Page
    $obj_pdf->AddPage();
    $content = ''; 
    $content .= '
    <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
        <tr>
            <td align="left"><img src="../../img/seal.jpg" alt="Logo 1" style="height: 50px;"></td>
            <td align="center" style="font-weight: bold;"><h4>Republic of the Philippines
            <br>Province of Cavite
            <br>TAGAYTAY CITY
            <br>BARANGAY MAHARLIKA EAST</h4></td>
            <td align="right"><img src="../../img/logo.png" alt="Logo 2" style="height: 50px;"></td>
        </tr>
    </table>
    <br><h3 align="center">TARGET CLIENT LIST FOR NUTRITION AND EXPANDED PROGRAM FOR IMMUNIZATION</h3><br />
    <table border="1" cellspacing="0" cellpadding="3" style="width: 100%; text-align: center;">
        <tr style="font-weight: bold;">
          <th width="5%">No.</th>
          <th>Date of Registration</th>
          <th>Date of Birth</th>
          <th width="15%">Name of Child</th>
          <th>Weight</th>
          <th>Height</th>
          <th>Sex</th>
          <th>Name of Mother</th>
          <th width="15%">Complete Address</th>
        </tr>';
    $content .= fetch_data4($date, $newDate);
    $content .= '</table>';
    $obj_pdf->writeHTML($content);

    // Second Page
    $obj_pdf->AddPage();
    $content = '';
    $content .= '
    <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
        <tr>
            <td align="left"><img src="../../img/seal.jpg" alt="Logo 1" style="height: 50px;"></td>
            <td align="center" style="font-weight: bold;"><h4>Republic of the Philippines
            <br>Province of Cavite
            <br>TAGAYTAY CITY
            <br>BARANGAY MAHARLIKA EAST</h4></td>
            <td align="right"><img src="../../img/logo.png" alt="Logo 2" style="height: 50px;"></td>
        </tr>
    </table>
    <br><h3 align="center">TARGET CLIENT LIST FOR NUTRITION AND EXPANDED PROGRAM FOR IMMUNIZATION</h3><br />
    <table border="1" cellspacing="0" cellpadding="3" style="width: 100%; text-align: center;">
        <tr style="font-weight: bold;">
            <th colspan="7">Micronutrient Supplementation</th>
            <th rowspan="2">Deworming</th>
            <th rowspan="4">Remarks</th>
        </tr>
        <tr style="font-weight: bold;">
            <th colspan="3">Vitamin A</th>
            <th colspan="2">Iron</th>
            <th colspan="2">MNP</th>
        </tr>
        <tr style="font-weight: bold;">
            <th rowspan="2">6-11 mos.</th>
            <th colspan="2">12-59 mos.</th>
            <th rowspan="2">6-11 mos.</th>
            <th rowspan="2">12-59 mos.</th>
            <th rowspan="2">6-11 mos.</th>
            <th rowspan="2">12-23 mos.</th>
            <th rowspan="2">12-59 mos.</th>
        </tr>
        <tr style="font-weight: bold;">
            <th>Dose 1</th>
            <th>Dose 2</th>
        </tr>';
    $content .= fetch_data5($date, $newDate);
    $content .= '</table>';
    $obj_pdf->writeHTML($content);

    $obj_pdf->Output('TCL-Nutrition-Report.pdf', 'D');  
    exit;
}

function fetch_data6($date, $newDate)  
{  
    $output = '';  
    $con = mysqli_connect("localhost", "root", "", "healthrecord");  
    
    $sql = "SELECT id, sick_children_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
    CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
    sex, mother_name, CONCAT(purok, ', ', address) AS caddress, se_status, vitamin_6to11mos, vitamin_12to59mos, diagnosis, 
    DATE_FORMAT(vitamin_supplementation_date,'%m-%d-%Y') AS vitamindate, diarrhea_age, 
    DATE_FORMAT(diarrhea_ors_date,'%m-%d-%Y') AS orsdate, DATE_FORMAT(diarrhea_oralzinc_date,'%m-%d-%Y') AS oralzincdate, 
    pneumonia_age, DATE_FORMAT(pneumonia_treatment_date,'%m-%d-%Y') AS pneumoniadate, remarks, remarks1 FROM sickchildren 
    INNER JOIN client ON sickchildren.patientid = client.id WHERE reg_date between '$date' AND '$newDate'";  

    $result = mysqli_query($con, $sql);  
    while($row = mysqli_fetch_array($result))  
    {       

        $output .= '<tr>  
        <td>'.$row["sick_children_id"].'</td>  
        <td>'.$row["regdate"].'</td>  
        <td>'.$row["fullname"].'</td>
        <td>'.$row["birthdate"].'</td>  
        <td>'.$row["sex"].'</td>
        <td>'.$row["mother_name"].'</td>
        <td>'.$row["caddress"].'</td> 
        <td>'.$row["se_status"].'</td> 
        </tr>'; 
    }  
    return $output;
}

function fetch_data7($date, $newDate)  
{  
    $output = '';  
    $con = mysqli_connect("localhost", "root", "", "healthrecord"); 
    
    $sql = "SELECT id, sick_children_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
    CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
    sex, mother_name, CONCAT(purok, ', ', address) AS caddress, se_status, vitamin_6to11mos, vitamin_12to59mos, diagnosis, 
    DATE_FORMAT(vitamin_supplementation_date,'%m-%d-%Y') AS vitamindate, diarrhea_age, 
    DATE_FORMAT(diarrhea_ors_date,'%m-%d-%Y') AS orsdate, DATE_FORMAT(diarrhea_oralzinc_date,'%m-%d-%Y') AS oralzincdate, 
    pneumonia_age, DATE_FORMAT(pneumonia_treatment_date,'%m-%d-%Y') AS pneumoniadate, remarks, remarks1, remarks2 FROM sickchildren 
    INNER JOIN client ON sickchildren.patientid = client.id WHERE reg_date between '$date' AND '$newDate'";  

    $userQuery = mysqli_query($con, "SELECT user_id, username, password, CONCAT(fname, ' ', lname) AS fullname from users WHERE type = 'bhw'");
    $user = mysqli_fetch_assoc($userQuery);
    $preparedByName = $user['fullname'];

    $result = mysqli_query($con, $sql);  
    if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result)) 
    {       

        $output .= '<tr>  <td style="font-family: dejavusans;">'.(isset($row["vitamin_6to11mos"]) && $row["vitamin_6to11mos"] != '✔' ? $row["vitamin_6to11mos"] : '').'</td>  
        <td style="font-family: dejavusans;">'.(isset($row["vitamin_12to59mos"]) && $row["vitamin_12to59mos"] != '✔' ? $row["vitamin_12to59mos"] : '').'</td> 
        <td>' . $row["diagnosis"] . '</td>  
        <td>' . (isset($row["vitamindate"]) && $row["vitamindate"] != '00-00-0000' ? $row["vitamindate"] : '') . '</td>
        <td>' . (isset($row["diarrhea_age"]) && $row["diarrhea_age"] > 0 ? $row["diarrhea_age"] : '') . '</td>
        <td>' . (isset($row["orsdate"]) && $row["orsdate"] != '00-00-0000' ? $row["orsdate"] : '') . '</td>
        <td>' . (isset($row["oralzincdate"]) && $row["oralzincdate"] != '00-00-0000' ? $row["oralzincdate"] : '') . '</td>
        <td>' . (isset($row["pneumonia_age"]) && $row["pneumonia_age"] > 0 ? $row["pneumonia_age"] : '') . '</td>
        <td>' . (isset($row["pneumoniadate"]) && $row["pneumoniadate"] != '00-00-0000' ? $row["pneumoniadate"] : '') . '</td>  
        <td>';
          $remarksArray = array(
              $row['remarks'],
              $row['remarks1'],
              $row['remarks2']
          );

          foreach ($remarksArray as $remark) {
              if (!empty($remark)) {
                  $output .= nl2br($remark) . '<br>';
              }
          }

          $output .= '</td>  
        </tr>'; 
    }  
    $output .= '<br><p align="left"><strong>Prepared by:</strong> ' . $preparedByName . '</p>';

    return $output;
  }
}


if(isset($_POST["generate_pdf3"]))  
{  
     require_once('../pdf_export/tcpdf/tcpdf.php');  
     $obj_pdf = new TCPDF('L', PDF_UNIT, 'LETTER', true, 'UTF-8', false);
     $obj_pdf->SetCreator(PDF_CREATOR);  
     $obj_pdf->SetTitle("TCL Sick Children Report");  
     $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
     $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
     $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
     $obj_pdf->SetDefaultMonospacedFont('helvetica');  
     $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
     $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
     $obj_pdf->setPrintHeader(false);  
     $obj_pdf->setPrintFooter(false);  
     $obj_pdf->SetAutoPageBreak(TRUE, 10);  
     $obj_pdf->SetFont('helvetica', '', 11);  

    // First Page
    $obj_pdf->AddPage();
    $content = ''; 
    $content .= '
    <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
        <tr>
            <td align="left"><img src="../../img/seal.jpg" alt="Logo 1" style="height: 50px;"></td>
            <td align="center" style="font-weight: bold;"><h4>Republic of the Philippines
            <br>Province of Cavite
            <br>TAGAYTAY CITY
            <br>BARANGAY MAHARLIKA EAST</h4></td>
            <td align="right"><img src="../../img/logo.png" alt="Logo 2" style="height: 50px;"></td>
        </tr>
    </table>
    <br><h3 align="center">TARGET CLIENT LIST FOR SICK CHILDREN</h3><br />
    <table border="1" cellspacing="0" cellpadding="3" style="width: 100%; text-align: center;">
        <tr style="font-weight: bold;">
        <th width="9%">No.</th>
        <th>Date of Registration</th>
        <th>Name of Child</th>
        <th>Date of Birth</th>
        <th>Sex</th>
        <th>Name of Mother</th>
        <th width="15%">Complete Address</th>
        <th style="font-weight: normal;"><b>SE Status</b> 
        <br><b>1:</b> NHTS <br><b>2:</b> Non-NHTS</th>
        </tr>';
    $content .= fetch_data6($date, $newDate);
    $content .= '</table>';
    $obj_pdf->writeHTML($content);

    // Second Page
    $obj_pdf->AddPage();
    $content = '';
    $content .= '
    <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
        <tr>
            <td align="left"><img src="../../img/seal.jpg" alt="Logo 1" style="height: 50px;"></td>
            <td align="center" style="font-weight: bold;"><h4>Republic of the Philippines
            <br>Province of Cavite
            <br>TAGAYTAY CITY
            <br>BARANGAY MAHARLIKA EAST</h4></td>
            <td align="right"><img src="../../img/logo.png" alt="Logo 2" style="height: 50px;"></td>
        </tr>
    </table>
    <br><h3 align="center">TARGET CLIENT LIST FOR SICK CHILDREN</h3><br />
    <table border="1" cellspacing="0" cellpadding="3" style="width: 100%; text-align: center;">
        <tr style="font-weight: bold;">
        <th colspan="4">Vitamin A Supplementation</th>
        <th colspan="3">Diarrhea Cases Seen and Given Treatment</th>
        <th colspan="2">Pneumonia Cases Seen <br>and Given Treatment</th>
        <th rowspan="3">Remarks</th>
      </tr>
      <tr style="font-weight: bold;">
        <th colspan="2">Put a <b style="font-family: dejavusans;">(✓)</b></th>
        <th rowspan="2">Diagnosis/ <br>Findings</th>
        <th rowspan="2">Date Given</th>
        <th rowspan="2">Age in <br>Months</th>
        <th colspan="2">Date Given</th>
        <th rowspan="2">Age in <br>Months</th>
        <th rowspan="2">Date Given <br>Treatment</th>
      </tr>
      <tr style="font-weight: bold;">
        <th>6-11 mos.</th>
        <th>12-59 mos.</th>
        <th>ORS</th>
        <th>Oral zinc <br>drops or syrup</th>
        </tr>';
    $content .= fetch_data7($date, $newDate);
    $content .= '</table>';
    $obj_pdf->writeHTML($content);

    $obj_pdf->Output('TCL-Sick-Children-Report.pdf', 'D');  
    exit;
}

function fetch_data8($date, $newDate)  
{  
    $output = '';  
    $con = mysqli_connect("localhost", "root", "", "healthrecord");  

    $sql = "SELECT id, maternal_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
    DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, CONCAT(purok, ', ', address) AS caddress, 
    DATE_FORMAT(lmp,'%m-%d-%Y') AS lmpdate, g, p, DATE_FORMAT(edc,'%m-%d-%Y') AS edcdate, 
    DATE_FORMAT(trimester1,'%m-%d-%Y') AS tri1, DATE_FORMAT(trimester1a,'%m-%d-%Y') AS tri1a, 
    DATE_FORMAT(trimester2,'%m-%d-%Y') AS tri2, DATE_FORMAT(trimester2a,'%m-%d-%Y') AS tri2a, 
    DATE_FORMAT(trimester3,'%m-%d-%Y') AS tri3, DATE_FORMAT(trimester3a,'%m-%d-%Y') AS tri3a FROM maternal 
    INNER JOIN client ON maternal.patientid = client.id WHERE reg_date between '$date' AND '$newDate' ORDER BY id ASC";  

    $result = mysqli_query($con, $sql);  
    while($row = mysqli_fetch_array($result))  
    {       

      $birthdate = $row['birthdate'];

        $output .= '<tr>    
        <td>'.$row["maternal_id"].'</td> 
        <td>'.$row["regdate"].'</td> 
        <td>'.$row["fullname"].'</td>   
        <td>'.$row["caddress"].'</td>' .

        '<td>';
    
    if ($birthdate != '00-00-0000') {
        $birthDateObj = DateTime::createFromFormat('m-d-Y', $birthdate);

        if ($birthDateObj === false) {
            echo "Failed to parse the birthdate.";
        } else {
            $currentDateObj = new DateTime();
            $age = $birthDateObj->diff($currentDateObj);

            $years = $age->y;
            $months = $age->m;

            if ($years == 0) {
                if ($months == 1) {
                    $output .= "1 month";
                } elseif ($months == 0) {
                    $output .= "0 month";
                } else {
                    $output .= "$months months";
                }
            } elseif ($years == 1) {
                $output .= "1 year old";
            } else {
                $output .= "$years years old";
            }
        }
    }

        $output .= '</td> 
        <td>' . (isset($row['lmpdate']) && $row['lmpdate'] > 0 ? $row['lmpdate'] . '<br>G' . $row['g'] . ' P' . $row['p'] : '') . '</td>
        <td>'.(isset($row["edcdate"]) && $row["edcdate"] != '00-00-0000' ? $row["edcdate"] : '').'</td>
        <td>' . (isset($row["tri1"]) && $row["tri1"] != '00-00-0000' ? $row["tri1"] . '<br>' 
        . (($row["tri1a"]) && $row["tri1a"] > 0 ? $row["tri1a"] : '') : '') . '</td>
        <td>' . (isset($row["tri2"]) && $row["tri2"] != '00-00-0000' ? $row["tri2"] . '<br>' 
        . (($row["tri2a"]) && $row["tri2a"] > 0 ? $row["tri2a"] : '') : '') . '</td>
        <td>' . (isset($row["tri3"]) && $row["tri3"] != '00-00-0000' ? $row["tri3"] . '<br>' 
        . (($row["tri3a"]) && $row["tri3a"] > 0 ? $row["tri3a"] : '') : '') . '</td>
        </tr>'; 
    }  
    return $output;
}

function fetch_data9($date, $newDate)  
{  
    $output = '';  
    $con = mysqli_connect("localhost", "root", "", "healthrecord");  
        
    $sql = "SELECT id, maternal_id, patientid, tetanus_status, DATE_FORMAT(tt1date,'%m-%d-%Y') AS tt1, DATE_FORMAT(tt2date,'%m-%d-%Y') AS tt2,
    DATE_FORMAT(tt3date,'%m-%d-%Y') AS tt3, DATE_FORMAT(tt4date,'%m-%d-%Y') AS tt4, DATE_FORMAT(tt5date,'%m-%d-%Y') AS tt5,
    DATE_FORMAT(iron1date,'%m-%d-%Y') AS iron1st, 1datenumber, DATE_FORMAT(iron2date,'%m-%d-%Y') AS iron2nd, 2datenumber,
    DATE_FORMAT(iron3date,'%m-%d-%Y') AS iron3rd, 3datenumber, DATE_FORMAT(iron4date,'%m-%d-%Y') AS iron4th, 4datenumber,
    DATE_FORMAT(iron5date,'%m-%d-%Y') AS iron5th, 5datenumber, DATE_FORMAT(iron6date,'%m-%d-%Y') AS iron6th, 6datenumber FROM maternal 
    INNER JOIN client ON maternal.patientid = client.id WHERE reg_date between '$date' AND '$newDate' ORDER BY id ASC";  

    $result = mysqli_query($con, $sql);  
    while($row = mysqli_fetch_array($result))  
    {       
        $output .= '<tr>   
        <td>'.$row["tetanus_status"].'</td>         
        <td>'.(isset($row["tt1"]) && $row["tt1"] != '00-00-0000' ? $row["tt1"] : '').'</td>
        <td>'.(isset($row["tt2"]) && $row["tt2"] != '00-00-0000' ? $row["tt2"] : '').'</td>
        <td>'.(isset($row["tt3"]) && $row["tt3"] != '00-00-0000' ? $row["tt3"] : '').'</td>
        <td>'.(isset($row["tt4"]) && $row["tt4"] != '00-00-0000' ? $row["tt4"] : '').'</td>
        <td>'.(isset($row["tt5"]) && $row["tt5"] != '00-00-0000' ? $row["tt5"] : '').'</td>
        <td>' . (isset($row["iron1st"]) && $row["iron1st"] != '00-00-0000' ? $row["iron1st"] . '<br>' 
        . (($row["1datenumber"]) && $row["1datenumber"] > 0 ? $row["1datenumber"] : '') : '') . '</td>
        <td>' . (isset($row["iron2nd"]) && $row["iron2nd"] != '00-00-0000' ? $row["iron2nd"] . '<br>' 
        . (($row["2datenumber"]) && $row["2datenumber"] > 0 ? $row["2datenumber"] : '') : '') . '</td>
        <td>' . (isset($row["iron3rd"]) && $row["iron3rd"] != '00-00-0000' ? $row["iron3rd"] . '<br>' 
        . (($row["3datenumber"]) && $row["3datenumber"] > 0 ? $row["3datenumber"] : '') : '') . '</td>
        <td>' . (isset($row["iron4th"]) && $row["iron4th"] != '00-00-0000' ? $row["iron4th"] . '<br>' 
        . (($row["4datenumber"]) && $row["4datenumber"] > 0 ? $row["4datenumber"] : '') : '') . '</td>
        <td>' . (isset($row["iron5th"]) && $row["iron5th"] != '00-00-0000' ? $row["iron5th"] . '<br>' 
        . (($row["5datenumber"]) && $row["5datenumber"] > 0 ? $row["5datenumber"] : '') : '') . '</td>
        <td>' . (isset($row["iron6th"]) && $row["iron6th"] != '00-00-0000' ? $row["iron6th"] . '<br>' 
        . (($row["6datenumber"]) && $row["6datenumber"] > 0 ? $row["6datenumber"] : '') : '') . '</td>
        </tr>'; 
    }  
    return $output;
}


function fetch_data10($date, $newDate)  
{  
    $output = '';  
    $con = mysqli_connect("localhost", "root", "", "healthrecord");  

    $sql = "SELECT id, maternal_id, patientid, DATE_FORMAT(sydate,'%m-%d-%Y') AS sy_date,
    syresult, DATE_FORMAT(syresult_date,'%m-%d-%Y') AS result_date, given_penicillin, 
    DATE_FORMAT(given_penicillin_date,'%m-%d-%Y') AS penicillin_date, 
    DATE_FORMAT(date_terminated,'%m-%d-%Y') AS terminated_date, 
    outcome, gender, birth_weight, facility, nid, attended, remarks FROM maternal 
    INNER JOIN client ON maternal.patientid = client.id WHERE reg_date between '$date' AND '$newDate' ORDER BY id ASC";  

    $userQuery = mysqli_query($con, "SELECT user_id, username, password, CONCAT(fname, ' ', lname) AS fullname from users WHERE type = 'bhw'");
    $user = mysqli_fetch_assoc($userQuery);
    $preparedByName = $user['fullname'];

    $result = mysqli_query($con, $sql);  
    if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result))   
    {       
        $output .= '<tr>    
        <td>' . (isset($row['sy_date']) && $row['sy_date'] != '00-00-0000' ? $row['sy_date'] : '') . '</td>
        <td>' . $row['syresult'] . '<br>' . (isset($row['result_date']) && $row['result_date'] != '00-00-0000' ? $row['result_date'] : '') . '</td>
        <td>' . $row['given_penicillin'] . '<br>' . (isset($row['penicillin_date']) && $row['penicillin_date'] != '00-00-0000' ? $row['penicillin_date'] : '') . '</td>
        <td>' . (isset($row['terminated_date']) && $row['terminated_date'] != '00-00-0000' ? $row['terminated_date'] : '') . '</td>
        <td>' . $row['outcome'] . '<br>' . $row['gender'] . '</td>
        <td>' . ($row['birth_weight'] > 0 ? $row['birth_weight'] : '') . '</td>
        <td>' . $row['facility'] . '</td>
        <td>' . $row['nid'] . '</td>
        <td>' . $row['attended'] . '</td>
        <td>' . nl2br($row['remarks']) . '</td>           
        </tr>'; 
    }  
    $output .= '<br><p align="left"><strong>Prepared by:</strong> ' . $preparedByName . '</p>';

    return $output;
  }
}


if(isset($_POST["generate_pdf4"]))  
{  
  require_once('../pdf_export/tcpdf/tcpdf.php');  
  $obj_pdf = new TCPDF('L', PDF_UNIT, 'LETTER', true, 'UTF-8', false);
  $obj_pdf->SetCreator(PDF_CREATOR);  
  $obj_pdf->SetTitle("TCL Maternal Care Report");  
  $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
  $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
  $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
  $obj_pdf->SetDefaultMonospacedFont('helvetica');  
  $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
  $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
  $obj_pdf->setPrintHeader(false);  
  $obj_pdf->setPrintFooter(false);  
  $obj_pdf->SetAutoPageBreak(TRUE, 10);  
  $obj_pdf->SetFont('helvetica', '', 11);  

 // First Page
 $obj_pdf->AddPage();
 $content = ''; 
    $content .= '
    <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
        <tr>
            <td align="left"><img src="../../img/seal.jpg" alt="Logo 1" style="height: 50px;"></td>
            <td align="center" style="font-weight: bold;"><h4>Republic of the Philippines
            <br>Province of Cavite
            <br>TAGAYTAY CITY
            <br>BARANGAY MAHARLIKA EAST</h4></td>
            <td align="right"><img src="../../img/logo.png" alt="Logo 2" style="height: 50px;"></td>
        </tr>
    </table>
    <br><h3 align="center">TARGET CLIENT LIST FOR MATERNAL CARE</h3><br />
    <table border="1" cellspacing="0" cellpadding="3" style="width: 100%; text-align: center;">
        <tr style="font-weight: bold;">
        <th rowspan="2" width="5%">No.</th>
        <th rowspan="2">Date of Registration</th>
        <th rowspan="2">Name</th>
        <th rowspan="2" width="15%">Address</th>
        <th rowspan="2">Age</th>
        <th rowspan="2">LMP <br>G-P</th>
        <th rowspan="2">EDC</th>
        <th colspan="3">Prenatal Visits</th>
      </tr>
      <tr style="font-weight: bold;">
        <th>First Trimester</th>
        <th>Second Trimester</th>
        <th>Third Trimester</th>
        </tr>';

        $content .= fetch_data8($date, $newDate);
        $content .= '</table>';
        $obj_pdf->writeHTML($content);

    // Second page
    $obj_pdf->AddPage();
    $content = '';
    $content .= '<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
    <tr>
        <td align="left"><img src="../../img/seal.jpg" alt="Logo 1" style="height: 50px;"></td>
        <td align="center" style="font-weight: bold;"><h4>Republic of the Philippines
        <br>Province of Cavite
        <br>TAGAYTAY CITY
        <br>BARANGAY MAHARLIKA EAST</h4></td>
        <td align="right"><img src="../../img/logo.png" alt="Logo 2" style="height: 50px;"></td>
    </tr>
</table>
<br><h3 align="center">TARGET CLIENT LIST FOR MATERNAL CARE</h3><br />
<table border="1" cellspacing="0" cellpadding="3" style="width: 100%; text-align: center;">
    <tr style="font-weight: bold;">
    <th rowspan="3" width="8%">Tetanus Status</th>
    <th colspan="5">Date Tetanus Toxoid Vaccine Given</th>
    <th colspan="6">Micronutrient Supplementation</th>
  </tr>
  <tr style="font-weight: bold;">
    <th rowspan="2">TT1</th>
    <th rowspan="2">TT2</th>
    <th rowspan="2">TT3</th>
    <th rowspan="2">TT4</th>
    <th rowspan="2">TT5</th>
    <th colspan="6">Date and Number Iron with Folic Acid was given</th>
  </tr>
  <tr>
    <th><br></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    </tr>';
 
    $content .= fetch_data9($date, $newDate);
    $content .= '</table>';
    $obj_pdf->writeHTML($content);  

    // Third page
    $obj_pdf->AddPage();
    $content = '';
    $content .= '<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
    <tr>
        <td align="left"><img src="../../img/seal.jpg" alt="Logo 1" style="height: 50px;"></td>
        <td align="center" style="font-weight: bold;"><h4>Republic of the Philippines
        <br>Province of Cavite
        <br>TAGAYTAY CITY
        <br>BARANGAY MAHARLIKA EAST</h4></td>
        <td align="right"><img src="../../img/logo.png" alt="Logo 2" style="height: 50px;"></td>
    </tr>
</table>
<br><h3 align="center">TARGET CLIENT LIST FOR MATERNAL CARE</h3><br />
<table border="1" cellspacing="0" cellpadding="3" style="width: 100%; text-align: center;">
    <tr style="font-weight: bold;">
    <th colspan="3">STI Surveillance</th>
    <th colspan="2">Pregnancy</th>
    <th colspan="4">Livebirths</th>
    <th rowspan="3">Remarks</th>
  </tr>
  <tr style="font-weight: bold;">
    <th>Tested for SY</th>
    <th>Result for SY Testing</th>
    <th>Given Penicillin</th>
    <th rowspan="2">Date Terminated</th>
    <th rowspan="2">Outcome / <br>Gender (M/F)</th>
    <th rowspan="2" class="font-weight-normal"><b>Birth <br>Weight</b> <br>(grams)</th>
    <th colspan="2">Place of</th>
    <th rowspan="2">Attended by</th>
  </tr>
  <tr style="font-weight: bold;">
    <th>Date</th>
    <th>(+/-) / <br>Date</th>
    <th>Y/N <br>Date</th>
    <th>Health Facility</th>
    <th>NID</th>
    </tr>';
 
    $content .= fetch_data10($date, $newDate);
    $content .= '</table>';
    $obj_pdf->writeHTML($content);  

    $obj_pdf->Output('TCL-Maternal-Care-Report.pdf', 'D');  
    exit;
}

function fetch_data11($date, $newDate)  
{  
    $output = '';  
    $con = mysqli_connect("localhost", "root", "", "healthrecord");  

    $sql = "SELECT id, immunization_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
    DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, se_status, CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, 
    sex, mother_name, CONCAT(purok, ', ', address) AS caddress, cpab1, cpab2 
    FROM immunization INNER JOIN client ON immunization.patientid = client.id WHERE reg_date between '$date' AND '$newDate' ORDER BY id ASC";  

    $result = mysqli_query($con, $sql);  
    while($row = mysqli_fetch_array($result))  
    {       

        $output .= '<tr>    
        <td>'.$row["immunization_id"].'</td> 
        <td>'.$row["regdate"].'</td> 
        <td>'.$row["birthdate"].'</td>  
        <td>'.$row["se_status"].'</td>  
        <td>'.$row["fullname"].'</td>  
        <td>'.$row["sex"].'</td>  
        <td>'.$row["mother_name"].'</td>  
        <td>'.$row["caddress"].'</td>  
        <td style="font-family: dejavusans;">'.(isset($row["cpab1"]) && $row["cpab1"] != '✔' ? $row["cpab1"] : '').'</td>  
        <td style="font-family: dejavusans;">'.(isset($row["cpab2"]) && $row["cpab2"] != '✔' ? $row["cpab2"] : '').'</td> 
        </tr>'; 
    }  
    return $output;
}

function fetch_data12($date, $newDate)  
{  
    $output = '';  
    $con = mysqli_connect("localhost", "root", "", "healthrecord");  

    $sql = "SELECT id, immunization_id, patientid, length, weight, birth_weight_status, 
    DATE_FORMAT(initiated_breastfeed,'%m-%d-%Y') AS breastfeed, DATE_FORMAT(bcg,'%m-%d-%Y') AS bcgdate,
    DATE_FORMAT(hepab,'%m-%d-%Y') AS hepabdate, DATE_FORMAT(dpt_hib_hepb_1stdose,'%m-%d-%Y') AS dpt_hib_hepb1, 
    DATE_FORMAT(dpt_hib_hepb_2nddose,'%m-%d-%Y') AS dpt_hib_hepb2, DATE_FORMAT(dpt_hib_hepb_3rddose,'%m-%d-%Y') AS dpt_hib_hepb3 
    FROM immunization INNER JOIN client ON immunization.patientid = client.id WHERE reg_date between '$date' AND '$newDate' ORDER BY id ASC";  

    $result = mysqli_query($con, $sql);  
    while($row = mysqli_fetch_array($result))  
    {       
        $output .= '<tr>   
        <td>'.(isset($row["length"]) && $row["length"] > 0 ? $row["length"] : '').'</td>
        <td>'.(isset($row["weight"]) && $row["weight"] > 0 ? $row["weight"] : '').'</td>
        <td>'.$row["birth_weight_status"].'</td>         
        <td>'.(isset($row["breastfeed"]) && $row["breastfeed"] != '00-00-0000' ? $row["breastfeed"] : '').'</td>
        <td>'.(isset($row["bcgdate"]) && $row["bcgdate"] != '00-00-0000' ? $row["bcgdate"] : '').'</td>
        <td>'.(isset($row["hepabdate"]) && $row["hepabdate"] != '00-00-0000' ? $row["hepabdate"] : '').'</td>
        <td>'.(isset($row["dpt_hib_hepb1"]) && $row["dpt_hib_hepb1"] != '00-00-0000' ? $row["dpt_hib_hepb1"] : '').'</td>
        <td>'.(isset($row["dpt_hib_hepb2"]) && $row["dpt_hib_hepb2"] != '00-00-0000' ? $row["dpt_hib_hepb2"] : '').'</td>
        <td>'.(isset($row["dpt_hib_hepb3"]) && $row["dpt_hib_hepb3"] != '00-00-0000' ? $row["dpt_hib_hepb3"] : '').'</td>
        </tr>'; 
    }  
    return $output;
}


function fetch_data13($date, $newDate)  
{  
    $output = '';  
    $con = mysqli_connect("localhost", "root", "", "healthrecord");  

    $sql = "SELECT id, immunization_id, patientid, DATE_FORMAT(opv_1stdose,'%m-%d-%Y') AS opv1, DATE_FORMAT(opv_2nddose,'%m-%d-%Y') AS opv2,
    DATE_FORMAT(opv_3rddose,'%m-%d-%Y') AS opv3, DATE_FORMAT(pcv_1stdose,'%m-%d-%Y') AS pcv1, DATE_FORMAT(pcv_2nddose,'%m-%d-%Y') AS pcv2,
    DATE_FORMAT(pcv_3rddose,'%m-%d-%Y') AS pcv3, DATE_FORMAT(ipv,'%m-%d-%Y') AS ipvdate, DATE_FORMAT(mmr1stdose,'%m-%d-%Y') AS mmr1, 
    DATE_FORMAT(mmr2nddose,'%m-%d-%Y') AS mmr2, DATE_FORMAT(fic_date,'%m-%d-%Y') AS fic,
    remarks, remarks1, remarks2, remarks3, remarks4, remarks5, remarks6, remarks7 
    FROM immunization INNER JOIN client ON immunization.patientid = client.id WHERE reg_date between '$date' AND '$newDate' ORDER BY id ASC";  

    $userQuery = mysqli_query($con, "SELECT user_id, username, password, CONCAT(fname, ' ', lname) AS fullname from users WHERE type = 'bhw'");
    $user = mysqli_fetch_assoc($userQuery);
    $preparedByName = $user['fullname'];

    $result = mysqli_query($con, $sql);  
    if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result))  
    {       
        $output .= '<tr>    
        <td>'.(isset($row["opv1"]) && $row["opv1"] != '00-00-0000' ? $row["opv1"] : '').'</td>
        <td>'.(isset($row["opv2"]) && $row["opv2"] != '00-00-0000' ? $row["opv2"] : '').'</td>  
        <td>'.(isset($row["opv3"]) && $row["opv3"] != '00-00-0000' ? $row["opv3"] : '').'</td>
        <td>'.(isset($row["pcv1"]) && $row["pcv1"] != '00-00-0000' ? $row["pcv1"] : '').'</td>
        <td>'.(isset($row["pcv2"]) && $row["pcv2"] != '00-00-0000' ? $row["pcv2"] : '').'</td>  
        <td>'.(isset($row["pcv3"]) && $row["pcv3"] != '00-00-0000' ? $row["pcv3"] : '').'</td>  
        <td>'.(isset($row["ipvdate"]) && $row["ipvdate"] != '00-00-0000' ? $row["ipvdate"] : '').'</td>  
        <td>'.(isset($row["mmr1"]) && $row["mmr1"] != '00-00-0000' ? $row["mmr1"] : '').'</td>  
        <td>'.(isset($row["mmr2"]) && $row["mmr2"] != '00-00-0000' ? $row["mmr2"] : '').'</td>  
        <td>'.(isset($row["fic"]) && $row["fic"] != '00-00-0000' ? $row["fic"] : '').'</td> 
        <td>';
          $remarksArray = array(
            $row['remarks'],
            $row['remarks1'],
            $row['remarks2'],
            $row['remarks3'],
            $row['remarks4'],
            $row['remarks5'],
            $row['remarks6'],
            $row['remarks7']
          );

          foreach ($remarksArray as $remark) {
              if (!empty($remark)) {
                  $output .= nl2br($remark) . '<br>';
              }
          }

          $output .= '</td>    
        </tr>'; 
    }  
    $output .= '<br><p align="left"><strong>Prepared by:</strong> ' . $preparedByName . '</p>';

    return $output;
  }
}

if(isset($_POST["generate_pdf5"]))  
{  
  require_once('../pdf_export/tcpdf/tcpdf.php');  
  $obj_pdf = new TCPDF('L', PDF_UNIT, 'LETTER', true, 'UTF-8', false);
  $obj_pdf->SetCreator(PDF_CREATOR);  
  $obj_pdf->SetTitle("TCL Immunization Services Report");  
  $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
  $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
  $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
  $obj_pdf->SetDefaultMonospacedFont('helvetica');  
  $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
  $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
  $obj_pdf->setPrintHeader(false);  
  $obj_pdf->setPrintFooter(false);  
  $obj_pdf->SetAutoPageBreak(TRUE, 10);  
  $obj_pdf->SetFont('helvetica', '', 11);  

 // First Page
 $obj_pdf->AddPage();
 $content = ''; 
    $content .= '
    <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
        <tr>
            <td align="left"><img src="../../img/seal.jpg" alt="Logo 1" style="height: 50px;"></td>
            <td align="center" style="font-weight: bold;"><h4>Republic of the Philippines
            <br>Province of Cavite
            <br>TAGAYTAY CITY
            <br>BARANGAY MAHARLIKA EAST</h4></td>
            <td align="right"><img src="../../img/logo.png" alt="Logo 2" style="height: 50px;"></td>
        </tr>
    </table>
    <br><h3 align="center">TARGET CLIENT LIST FOR IMMUNIZATION AND NUTRITION SERVICES FOR 0-12 MONTHS OLD</h3><br />
    <table border="1" cellspacing="0" cellpadding="3" style="width: 100%; text-align: center;">
        <tr style="font-weight: bold;">
        <th rowspan="2" width="5%">No.</th>
        <th rowspan="2">Date of Registration</th>
        <th rowspan="2">Date of Birth</th>
        <th rowspan="2" style="font-weight: normal;"><b>SE Status</b>
          <br><b>1:</b> NHTS
          <br><b>2:</b> Non-NHTS
        </th>
        <th rowspan="2">Name of Child</th>
        <th rowspan="2">Sex</th>
        <th rowspan="2">Name of Mother</th>
        <th rowspan="2" width="15%">Complete Address</th>
        <th colspan="2">Child Protected at Birth (CPAB)</th>
      </tr>
      <tr>
        <th style="font-weight: normal;">TT2/Td2 given <br>to the mother <br>a month prior <br>to
          delivery <br>(for mothers <br>pregnant for the <br>first time)</th>
        <th style="font-weight: normal;">TT3/Td3 <br>to TT5/Td5 <br>(or TT1/Td1 <br>to TT5/Td5)
          <br>given to the <br>mother <br>anytime <br>prior to <br>delivery
        </th>
      </tr>';

        $content .= fetch_data11($date, $newDate);
        $content .= '</table>';
        $obj_pdf->writeHTML($content);

    // Second page
    $obj_pdf->AddPage();
    $content = '';
    $content .= '<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
    <tr>
        <td align="left"><img src="../../img/seal.jpg" alt="Logo 1" style="height: 50px;"></td>
        <td align="center" style="font-weight: bold;"><h4>Republic of the Philippines
        <br>Province of Cavite
        <br>TAGAYTAY CITY
        <br>BARANGAY MAHARLIKA EAST</h4></td>
        <td align="right"><img src="../../img/logo.png" alt="Logo 2" style="height: 50px;"></td>
    </tr>
</table>
<br><h3 align="center">TARGET CLIENT LIST FOR IMMUNIZATION AND NUTRITION SERVICES FOR 0-12 MONTHS OLD</h3><br />
<table border="1" cellspacing="0" cellpadding="3" style="width: 100%; text-align: center;">
    <tr style="font-weight: bold;">
    <th colspan="6">NEWBORN (0-28 DAYS OLD)</th>
    <th colspan="3">1-3 MONTHS OLD</th>
</tr>
<tr style="font-weight: bold;">
    <th rowspan="3" style="font-weight: normal;"><b>Length at Birth</b> <br>(cm)</th>
    <th rowspan="3" style="font-weight: normal;"><b>Weight at Birth</b> <br>(kg)</th>
    <th>Status <br>(Birth Weight)</th>
    <th rowspan="3">Initiated breast feeding immediately after birth lasting for 90
        minutes</th>
    <th colspan="2">Immunization</th>
    <th colspan="3">Immunization</th>
</tr>
<tr style="font-weight: bold;">
    <th rowspan="2" style="font-weight: normal;"><b>L:</b> low: <br>
        <2,500 gms <br><b>N:</b> normal: <br>>2,500 gms <br><b>U:</b> unknown
    </th>
    <th rowspan="2">BCG</th>
    <th rowspan="2">Hepa B-BD</th>
    <th colspan="3">DPT-HIB-HepB</th>
</tr>
<tr>
    <th style="font-weight: normal;"><b>1st dose</b> <br>1 ½ mos</th>
    <th style="font-weight: normal;"><b>2nd dose</b> <br>2 ½ mos</th>
    <th style="font-weight: normal;"><b>3rd dose</b> <br>3 ½ mos</th>
    </tr>';
 
    $content .= fetch_data12($date, $newDate);
    $content .= '</table>';
    $obj_pdf->writeHTML($content);  

    // Third page
    $obj_pdf->AddPage();
    $content = '';
    $content .= '<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
    <tr>
        <td align="left"><img src="../../img/seal.jpg" alt="Logo 1" style="height: 50px;"></td>
        <td align="center" style="font-weight: bold;"><h4>Republic of the Philippines
        <br>Province of Cavite
        <br>TAGAYTAY CITY
        <br>BARANGAY MAHARLIKA EAST</h4></td>
        <td align="right"><img src="../../img/logo.png" alt="Logo 2" style="height: 50px;"></td>
    </tr>
</table>
<br><h3 align="center">TARGET CLIENT LIST FOR IMMUNIZATION AND NUTRITION SERVICES FOR 0-12 MONTHS OLD</h3><br />
<table border="1" cellspacing="0" cellpadding="3" style="width: 100%; text-align: center;">
    <tr style="font-weight: bold;">
    <th colspan="7">1-3 MONTHS OLD</th>
    <th>6-11 MONTHS OLD</th>
    <th colspan="2">12 MONTHS OLD</th>
    <th rowspan="4">Remarks</th>
</tr>
<tr style="font-weight: bold;">
    <th colspan="7">Immunization</th>
    <th rowspan="3">MMR Dose 1 at 9th month</th>
    <th rowspan="3">MMR Dose 2 at 12th month</th>
    <th rowspan="3">FIC</th>
</tr>
<tr style="font-weight: bold;">
    <th colspan="3">OPV</th>
    <th colspan="3">PCV</th>
    <th>IPV</th>
</tr>
<tr>
    <th><b>1st dose</b> <br>1 ½ mos</th>
    <th><b>2nd dose</b> <br>2 ½ mos</th>
    <th><b>3rd dose</b> <br>3 ½ mos</th>
    <th><b>1st dose</b> <br>1 ½ mos</th>
    <th><b>2nd dose</b> <br>2 ½ mos</th>
    <th><b>3rd dose</b> <br>3 ½ mos</th>
    <th>3 mos</th>
    </tr>';
 
    $content .= fetch_data13($date, $newDate);
    $content .= '</table>';
    $obj_pdf->writeHTML($content);  

    $obj_pdf->Output('TCL-Immunization-0-12-Months-Report.pdf', 'D');  
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">

      <head>
        <?php
        include('../headsidecss.php');
        ?>

        <!-- DataTables -->
        <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

        <title>Report</title>
        <link rel="icon" href="../../img/logo.png">

      </head>

    <body class="hold-transition sidebar-mini">

      <div class="wrapper">
        <?php
        include('../sidebar.php');
        ?>

  <?php
  if ($_SESSION['type'] == "Barangay Health Worker") {
    ?>

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4 sidebar-no-expand">
        <h1 class="brand-link text-center">
            <span class="brand-text font-weight-bold" style="font-family: Helvetica; font-size: 17px;">
                Health Record Management
            </span>
        </h1>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar panel -->
            <div class="user-panel pb-3 mb-3">
                <center><img src="../../img/logo.png" style="height: 40%; width: 40%;" alt="logo"></center>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2" style="font-family: Helvetica;">
                    <ul class="nav nav-pills nav-sidebar flex-column text-sm" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item">
                                <a href="../main/dashboard.php" class="nav-link">
                                    <i class="nav-icon fas fa-home"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="../client/client-list.php" class="nav-link">
                                    <i class="nav-icon fas fa-user-plus"></i>
                                    <p>
                                        Client
                                    </p>
                                </a>
                            </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-notes-medical"></i>
                                <p>
                                    Health Services
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="../immunization/immunization.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Immunization Services</p>
                                    </a>
                                </li>
                            <li class="nav-item">
                                <a href="../deworming1/deworming.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Deworming Services</p>
                                </a>
                            </li>
                                <li class="nav-item">
                                    <a href="../nutrition2/nutrition2.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Nutrition Program</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../sickchildren/sickchildren.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Sick Children</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../maternal/maternal.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Maternal Care</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../postpartum/postpartum.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Postpartum Care</p>
                                    </a>
                                </li>
                            <li class="nav-item">
                                <a href="../client/general-consult.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>General Consultation</p>
                                </a>
                            </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    Report
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                      <a href="../main/report.php" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Custom Report</p>
                                      </a>
                                    </li>
                                    <li class="nav-item">
                                      <a href="../main/client.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Follow-up Health Service</p>
                                      </a>
                                    </li>
                            </ul>
                        </li>
                    </ul>

            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

          <!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-9">
                    <h4 class="font-weight-bold" style="font-family: Helvetica;">
                    <?php
                    if ($frequency == 'weekly') { ?>
                      WEEKLY REPORT</h4>                  
                    <?php } ?>
                    <?php
                    if ($frequency == 'monthly') { ?>
                      MONTHLY REPORT</h4>                  
                    <?php } ?>
                    <?php
                    if ($frequency == 'range') { ?>
                      DATE RANGE REPORT</h4>                  
                    <?php } ?>
                

                  </div>
                  <div class="col-2">
                  </div>
                  <div class="col-1">
                    <div class="form-group">
                      <a href="report.php" class="btn btn-dark bg-gradient-dark btn-block">Back</a>
                    </div>
                  </div>
                </div><!-- /.row -->
              </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <section class="content text-sm" style="font-family: Helvetica;">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <br>
                    <h5 class="font-weight-bold text-center">TARGET CLIENT LIST FOR
                      <?php echo $title; ?>
                    </h5>

                      <div class="card-body d-flex flex-column">
                        <div class="card-block">
                          <div class="row align-items-center">
                            <div class="col-10">
                              <h6 class="font-weight-bold">from
                                <?php echo $date; ?> to
                                <?php echo $newDate; ?>
                              </h6>
                            </div>

                        <?php if ($service == "deworming") { ?>
                            <div class="col-2">
                              <div class="form-group">


                          <button id="healthServiceButton" class="btn btn-success bg-gradient-success btn-block btn-sm" type="button"
                              id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="nav-icon fas fa-file"></i> Export Report
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="dewormingexcel.php?date1=<?php echo $date; ?>&date2=<?php echo $newDate; ?>" style="font-size: 1.1em;">Excel Report</a>
                                <a class="dropdown-item" href="#" onclick="generatePDF('<?php echo $service; ?>', '<?php echo $frequency; ?>', '<?php echo $month; ?>', '<?php echo $year; ?>', '<?php echo $week; ?>', '<?php echo $fromDate; ?>', '<?php echo $toDate; ?>')" style="font-size: 1.1em;">PDF Report</a>

                                <script>
                                    function generatePDF(service, frequency, month, year, week, fromDate, toDate) {
                                        document.getElementById("pdfFormService").value = service;
                                        document.getElementById("pdfFormFrequency").value = frequency;
                                        document.getElementById("pdfFormMonth").value = month;
                                        document.getElementById("pdfFormYear").value = year;
                                        document.getElementById("pdfFormWeek").value = week;
                                        document.getElementById("pdfFormFromDate").value = fromDate;
                                        document.getElementById("pdfFormToDate").value = toDate;

                                        document.getElementById("pdfForm").submit();
                                    }
                                </script>

                                <form id="pdfForm" method="post" style="display: none;">
                                    <input type="hidden" name="generate_pdf" value="1" />
                                    <input type="hidden" name="service" id="pdfFormService" value="" />
                                    <input type="hidden" name="frequency" id="pdfFormFrequency" value="" />
                                    <input type="hidden" name="month" id="pdfFormMonth" value="" />
                                    <input type="hidden" name="year" id="pdfFormYear" value="" />
                                    <input type="hidden" name="week" id="pdfFormWeek" value="" />
                                    <input type="hidden" name="fromDate" id="pdfFormFromDate" value="" />
                                    <input type="hidden" name="toDate" id="pdfFormToDate" value="" />
                                </form>

                            </div>
                            </div>
                          <?php } ?>


                          <?php if ($service == "immunization") { ?>
                            <div class="col-2">
                              <div class="form-group">

                          <button id="healthServiceButton" class="btn btn-success bg-gradient-success btn-block btn-sm" type="button"
                              id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="nav-icon fas fa-file"></i> Export Report
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="immunizationexcel.php?date1=<?php echo $date; ?>&date2=<?php echo $newDate; ?>" style="font-size: 1.1em;">Excel Report</a>
                                <a class="dropdown-item" href="#" onclick="generatePDF5('<?php echo $service; ?>', '<?php echo $frequency; ?>', '<?php echo $month; ?>', '<?php echo $year; ?>', '<?php echo $week; ?>', '<?php echo $fromDate; ?>', '<?php echo $toDate; ?>')" style="font-size: 1.1em;">PDF Report</a>

                                <script>
                                    function generatePDF5(service, frequency, month, year, week, fromDate, toDate) {
                                        document.getElementById("pdfFormService").value = service;
                                        document.getElementById("pdfFormFrequency").value = frequency;
                                        document.getElementById("pdfFormMonth").value = month;
                                        document.getElementById("pdfFormYear").value = year;
                                        document.getElementById("pdfFormWeek").value = week;
                                        document.getElementById("pdfFormFromDate").value = fromDate;
                                        document.getElementById("pdfFormToDate").value = toDate;

                                        document.getElementById("pdfForm5").submit();
                                    }
                                </script>

                                <form id="pdfForm5" method="post" style="display: none;">
                                    <input type="hidden" name="generate_pdf5" value="1" />
                                    <input type="hidden" name="service" id="pdfFormService" value="" />
                                    <input type="hidden" name="frequency" id="pdfFormFrequency" value="" />
                                    <input type="hidden" name="month" id="pdfFormMonth" value="" />
                                    <input type="hidden" name="year" id="pdfFormYear" value="" />
                                    <input type="hidden" name="week" id="pdfFormWeek" value="" />
                                    <input type="hidden" name="fromDate" id="pdfFormFromDate" value="" />
                                    <input type="hidden" name="toDate" id="pdfFormToDate" value="" />
                                </form>
                          </div>

                            </div>
                            </div>
                          <?php } ?>

                          <?php if ($service == "nutrition2") { ?>
                            <div class="col-2">
                              <div class="form-group">

                          <button id="healthServiceButton" class="btn btn-success bg-gradient-success btn-block btn-sm" type="button"
                              id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="nav-icon fas fa-file"></i> Export Report
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="nutrition2excel.php?date1=<?php echo $date; ?>&date2=<?php echo $newDate; ?>" style="font-size: 1.1em;">Excel Report</a>
                                <a class="dropdown-item" href="#" onclick="generatePDF2('<?php echo $service; ?>', '<?php echo $frequency; ?>', '<?php echo $month; ?>', '<?php echo $year; ?>', '<?php echo $week; ?>', '<?php echo $fromDate; ?>', '<?php echo $toDate; ?>')" style="font-size: 1.1em;">PDF Report</a>

                                <script>
                                    function generatePDF2(service, frequency, month, year, week, fromDate, toDate) {
                                        document.getElementById("pdfFormService").value = service;
                                        document.getElementById("pdfFormFrequency").value = frequency;
                                        document.getElementById("pdfFormMonth").value = month;
                                        document.getElementById("pdfFormYear").value = year;
                                        document.getElementById("pdfFormWeek").value = week;
                                        document.getElementById("pdfFormFromDate").value = fromDate;
                                        document.getElementById("pdfFormToDate").value = toDate;

                                        document.getElementById("pdfForm2").submit();
                                    }
                                </script>

                                <form id="pdfForm2" method="post" style="display: none;">
                                    <input type="hidden" name="generate_pdf2" value="1" />
                                    <input type="hidden" name="service" id="pdfFormService" value="" />
                                    <input type="hidden" name="frequency" id="pdfFormFrequency" value="" />
                                    <input type="hidden" name="month" id="pdfFormMonth" value="" />
                                    <input type="hidden" name="year" id="pdfFormYear" value="" />
                                    <input type="hidden" name="week" id="pdfFormWeek" value="" />
                                    <input type="hidden" name="fromDate" id="pdfFormFromDate" value="" />
                                    <input type="hidden" name="toDate" id="pdfFormToDate" value="" />
                                </form>
                          </div>
                          
                            </div>
                            </div>
                          <?php } ?>

                          <?php if ($service == "sickchildren") { ?>
                            <div class="col-2">
                              <div class="form-group">

                          <button id="healthServiceButton" class="btn btn-success bg-gradient-success btn-block btn-sm" type="button"
                              id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="nav-icon fas fa-file"></i> Export Report
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="sickchildrenexcel.php?date1=<?php echo $date; ?>&date2=<?php echo $newDate; ?>" style="font-size: 1.1em;">Excel Report</a>
                                <a class="dropdown-item" href="#" onclick="generatePDF3('<?php echo $service; ?>', '<?php echo $frequency; ?>', '<?php echo $month; ?>', '<?php echo $year; ?>', '<?php echo $week; ?>', '<?php echo $fromDate; ?>', '<?php echo $toDate; ?>')" style="font-size: 1.1em;">PDF Report</a>

                                <script>
                                    function generatePDF3(service, frequency, month, year, week, fromDate, toDate) {
                                        document.getElementById("pdfFormService").value = service;
                                        document.getElementById("pdfFormFrequency").value = frequency;
                                        document.getElementById("pdfFormMonth").value = month;
                                        document.getElementById("pdfFormYear").value = year;
                                        document.getElementById("pdfFormWeek").value = week;
                                        document.getElementById("pdfFormFromDate").value = fromDate;
                                        document.getElementById("pdfFormToDate").value = toDate;

                                        document.getElementById("pdfForm3").submit();
                                    }
                                </script>

                                <form id="pdfForm3" method="post" style="display: none;">
                                    <input type="hidden" name="generate_pdf3" value="1" />
                                    <input type="hidden" name="service" id="pdfFormService" value="" />
                                    <input type="hidden" name="frequency" id="pdfFormFrequency" value="" />
                                    <input type="hidden" name="month" id="pdfFormMonth" value="" />
                                    <input type="hidden" name="year" id="pdfFormYear" value="" />
                                    <input type="hidden" name="week" id="pdfFormWeek" value="" />
                                    <input type="hidden" name="fromDate" id="pdfFormFromDate" value="" />
                                    <input type="hidden" name="toDate" id="pdfFormToDate" value="" />
                                </form>
                          </div>

                            </div>
                            </div>
                          <?php } ?>

                          <?php if ($service == "maternal") { ?>
                            <div class="col-2">
                              <div class="form-group">

                          <button id="healthServiceButton" class="btn btn-success bg-gradient-success btn-block btn-sm" type="button"
                              id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="nav-icon fas fa-file"></i> Export Report
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="maternalexcel.php?date1=<?php echo $date; ?>&date2=<?php echo $newDate; ?>" style="font-size: 1.1em;">Excel Report</a>
                                <a class="dropdown-item" href="#" onclick="generatePDF4('<?php echo $service; ?>', '<?php echo $frequency; ?>', '<?php echo $month; ?>', '<?php echo $year; ?>', '<?php echo $week; ?>', '<?php echo $fromDate; ?>', '<?php echo $toDate; ?>')" style="font-size: 1.1em;">PDF Report</a>

                                <script>
                                    function generatePDF4(service, frequency, month, year, week, fromDate, toDate) {
                                        document.getElementById("pdfFormService").value = service;
                                        document.getElementById("pdfFormFrequency").value = frequency;
                                        document.getElementById("pdfFormMonth").value = month;
                                        document.getElementById("pdfFormYear").value = year;
                                        document.getElementById("pdfFormWeek").value = week;
                                        document.getElementById("pdfFormFromDate").value = fromDate;
                                        document.getElementById("pdfFormToDate").value = toDate;

                                        document.getElementById("pdfForm4").submit();
                                    }
                                </script>

                                <form id="pdfForm4" method="post" style="display: none;">
                                    <input type="hidden" name="generate_pdf4" value="1" />
                                    <input type="hidden" name="service" id="pdfFormService" value="" />
                                    <input type="hidden" name="frequency" id="pdfFormFrequency" value="" />
                                    <input type="hidden" name="month" id="pdfFormMonth" value="" />
                                    <input type="hidden" name="year" id="pdfFormYear" value="" />
                                    <input type="hidden" name="week" id="pdfFormWeek" value="" />
                                    <input type="hidden" name="fromDate" id="pdfFormFromDate" value="" />
                                    <input type="hidden" name="toDate" id="pdfFormToDate" value="" />
                                </form>
                          </div>
                          
                            </div>
                            </div>
                          <?php } ?>

                          <?php if ($service == "postpartum") { ?>
                            <div class="col-2">
                              <div class="form-group">

                          <button id="healthServiceButton" class="btn btn-success bg-gradient-success btn-block btn-sm" type="button"
                              id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="nav-icon fas fa-file"></i> Export Report
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="postpartumexcel.php?date1=<?php echo $date; ?>&date2=<?php echo $newDate; ?>" style="font-size: 1.1em;">Excel Report</a>
                                <a class="dropdown-item" href="#" onclick="generatePDF1('<?php echo $service; ?>', '<?php echo $frequency; ?>', '<?php echo $month; ?>', '<?php echo $year; ?>', '<?php echo $week; ?>', '<?php echo $fromDate; ?>', '<?php echo $toDate; ?>')" style="font-size: 1.1em;">PDF Report</a>

                                <script>
                                    function generatePDF1(service, frequency, month, year, week, fromDate, toDate) {
                                        document.getElementById("pdfFormService").value = service;
                                        document.getElementById("pdfFormFrequency").value = frequency;
                                        document.getElementById("pdfFormMonth").value = month;
                                        document.getElementById("pdfFormYear").value = year;
                                        document.getElementById("pdfFormWeek").value = week;
                                        document.getElementById("pdfFormFromDate").value = fromDate;
                                        document.getElementById("pdfFormToDate").value = toDate;

                                        document.getElementById("pdfForm1").submit();
                                    }
                                </script>

                                <form id="pdfForm1" method="post" style="display: none;">
                                    <input type="hidden" name="generate_pdf1" value="1" />
                                    <input type="hidden" name="service" id="pdfFormService" value="" />
                                    <input type="hidden" name="frequency" id="pdfFormFrequency" value="" />
                                    <input type="hidden" name="month" id="pdfFormMonth" value="" />
                                    <input type="hidden" name="year" id="pdfFormYear" value="" />
                                    <input type="hidden" name="week" id="pdfFormWeek" value="" />
                                    <input type="hidden" name="fromDate" id="pdfFormFromDate" value="" />
                                    <input type="hidden" name="toDate" id="pdfFormToDate" value="" />
                                </form>

                            </div>
                            </div>
                          <?php } ?>

                          </div>
                          </div>

                     
                          <?php
                          if ($service == "deworming") {
                            ?>

                       
              <div class="card-tabs card-secondary">
                  <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  <li class="nav-item" style="flex: 1; text-align: center;">
                    <a class="nav-link font-weight-bold active" id="custom-tabs-one-1-4-tab" data-toggle="pill" href="#custom-tabs-one-1-4" role="tab" aria-controls="custom-tabs-one-1-4" aria-selected="true" style="padding: 10px 10px;">1-4 YEARS OLD</a>
                  </li>
                  <li class="nav-item" style="flex: 1; text-align: center;">
                    <a class="nav-link font-weight-bold" id="custom-tabs-one-5-9-tab" data-toggle="pill" href="#custom-tabs-one-5-9" role="tab" aria-controls="custom-tabs-one-5-9" aria-selected="false" style="padding: 10px 10px;">5-9 YEARS OLD</a>
                  </li>
                  <li class="nav-item" style="flex: 1; text-align: center;">
                    <a class="nav-link font-weight-bold" id="custom-tabs-one-10-19-tab" data-toggle="pill" href="#custom-tabs-one-10-19" role="tab" aria-controls="custom-tabs-one-10-19" aria-selected="false" style="padding: 10px 10px;">10-19 YEARS OLD</a>
                  </li>
                </ul>
              </div>
                        
              <br> 
                  <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-one-1-4" role="tabpanel" aria-labelledby="custom-tabs-one-1-4-tab"> 
                      <h6 class="font-weight-bold" style="font-size: 1.1em;">DEWORMING SERVICES FOR 1-4 YEARS OLD
                      </h6>

                    <?php
                    $deworming1st = mysqli_query($con, "SELECT deworming_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate,  DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
            CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, sex, mother_name, 
            purok, address, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
            DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks, remarks_1stdose, 
            remarks_2nddose FROM $service INNER JOIN client ON deworming.patientid = client.id AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 1 AND 4 WHERE reg_date between '$date' AND '$newDate'");
                    ?>

                                <table id="example" class="table table-bordered table-hover text-center">
                                  <thead>
                                    <tr>
                                      <th>Date of Registration</th>
                                      <th>Date of Birth</th>
                                      <th>Name of Child</th>
                                      <th>Sex</th>
                                      <th>Name of Mother</th>
                                      <th>Complete Address</th>
                                      <th>Age</th>
                                      <th>1st Dose (date given)</th>
                                      <th>2nd Dose (date given)</th>
                                      <th>Remarks</th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                    <?php
                                    while ($data = mysqli_fetch_array($deworming1st)) { ?>

                                          <tr>
                                            <td>
                                              <?php echo $data['regdate']; ?>
                                            </td>
                                            <td>
                                              <?php echo $data['birthdate']; ?>
                                            </td>
                                            <td>
                                              <?php echo $data['fullname']; ?>
                                            </td>
                                            <td>
                                              <?php echo $data['sex']; ?>
                                            </td>
                                            <td>
                                              <?php echo $data['mother_name']; ?>
                                            </td>
                                            <td>
                                              <?php echo $data['purok']; ?>, 
                                              <?php echo $data['address']; ?>
                                            </td>
                                              <?php
                                              $birthdate = $data['birthdate'];
                                              $birthDateObj = DateTime::createFromFormat('m-d-Y', $birthdate);

                                              if ($birthDateObj === false) {
                                                echo "Failed to parse the birthdate.";
                                              } else {
                                                $currentDateObj = new DateTime();
                                                $age = $birthDateObj->diff($currentDateObj);

                                                $years = $age->y;
                                                $months = $age->m;

                                                ?>
                                                        <td>
                                                    <?php
                                                    if ($years == 0) {
                                                      if ($months == 1) {
                                                        echo "1 month";
                                                      } elseif ($months == 0) {
                                                        echo "0 month";
                                                      } else {
                                                        echo "$months months";
                                                      }
                                                    } elseif ($years == 1) {
                                                      if ($months == 1) {
                                                        echo "1 year old";
                                                      } elseif ($months == 0) {
                                                        echo "1 year old";
                                                      } else {
                                                        echo "1 year old";
                                                      }
                                                    } else {
                                                      if ($months == 1) {
                                                        echo "$years years old";
                                                      } elseif ($months == 0) {
                                                        echo "$years years old";
                                                      } else {
                                                        echo "$years years old";
                                                      }
                                                    }
                                              }
                                              ?>
                      </td>
                                                  <td>
                                                    <?php if ($data['1st_dose'] != '00-00-0000') {
                                                      echo $data['1st_dose'];
                                                    } ?>
                                                  </td>
                                                  <td>
                                                    <?php if ($data['2nd_dose'] != '00-00-0000') {
                                                      echo $data['2nd_dose'];
                                                    }
                                                    ; ?>
                                                  </td>
                                            <td>
                                              <?php echo nl2br($data['remarks']); ?>
                                            </td>
                                          </tr>

                                          <?php
                                    } ?>

                                  </tbody>
                                </table>    
                                  </div>

                    <div class="tab-pane fade" id="custom-tabs-one-5-9" role="tabpanel" aria-labelledby="custom-tabs-one-5-9-tab">
                      <h6 class="font-weight-bold" style="font-size: 1.1em;">DEWORMING SERVICES FOR 5-9 YEARS OLD
                      </h6>

                                <?php
                                $deworming2nd = mysqli_query($con, "SELECT deworming_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
                          DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
                          CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, sex, mother_name, 
                          purok, address, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
                          DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks, remarks_1stdose, 
                          remarks_2nddose FROM $service INNER JOIN client ON deworming.patientid = client.id AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 5 AND 9 WHERE reg_date between '$date' AND '$newDate'");
                                ?>

                                <table id="example1" class="table table-bordered table-hover text-center">
                                  <thead>
                                    <tr>
                                      <th>Date of Registration</th>
                                      <th>Date of Birth</th>
                                      <th>Name of Child</th>
                                      <th>Sex</th>
                                      <th>Name of Mother</th>
                                      <th>Complete Address</th>
                                      <th>Age</th>
                                      <th>1st Dose (date given)</th>
                                      <th>2nd Dose (date given)</th>
                                      <th>Remarks</th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                    <?php
                                    while ($data = mysqli_fetch_array($deworming2nd)) { ?>

                                          <tr>
                                            <td>
                                              <?php echo $data['regdate']; ?>
                                            </td>
                                            <td>
                                              <?php echo $data['birthdate']; ?>
                                            </td>
                                            <td>
                                              <?php echo $data['fullname']; ?>
                                            </td>
                                            <td>
                                              <?php echo $data['sex']; ?>
                                            </td>
                                            <td>
                                              <?php echo $data['mother_name']; ?>
                                            </td>
                                            <td>
                                              <?php echo $data['purok']; ?>, <?php echo $data['address']; ?>
                                            </td>
                                              <?php
                                              $birthdate = $data['birthdate'];
                                              $birthDateObj = DateTime::createFromFormat('m-d-Y', $birthdate);

                                              if ($birthDateObj === false) {
                                                echo "Failed to parse the birthdate.";
                                              } else {
                                                $currentDateObj = new DateTime();
                                                $age = $birthDateObj->diff($currentDateObj);

                                                $years = $age->y;
                                                $months = $age->m;

                                                ?>
                                                        <td>
                                                    <?php
                                                    if ($years == 0) {
                                                      if ($months == 1) {
                                                        echo "1 month";
                                                      } elseif ($months == 0) {
                                                        echo "0 month";
                                                      } else {
                                                        echo "$months months";
                                                      }
                                                    } elseif ($years == 1) {
                                                      if ($months == 1) {
                                                        echo "1 year old";
                                                      } elseif ($months == 0) {
                                                        echo "1 year old";
                                                      } else {
                                                        echo "1 year old";
                                                      }
                                                    } else {
                                                      if ($months == 1) {
                                                        echo "$years years old";
                                                      } elseif ($months == 0) {
                                                        echo "$years years old";
                                                      } else {
                                                        echo "$years years old";
                                                      }
                                                    }
                                              }
                                              ?>
                      </td>
                                                  <td>
                                                    <?php if ($data['1st_dose'] != '00-00-0000') {
                                                      echo $data['1st_dose'];
                                                    } ?>
                                                  </td>
                                                  <td>
                                                    <?php if ($data['2nd_dose'] != '00-00-0000') {
                                                      echo $data['2nd_dose'];
                                                    }
                                                    ; ?>
                                                  </td>
                                            <td>
                                              <?php echo nl2br($data['remarks']); ?>
                                            </td>
                                          </tr>

                                    <?php } ?>
                                  </tbody>
                                </table> 
                              </div>

                  <div class="tab-pane fade" id="custom-tabs-one-10-19" role="tabpanel" aria-labelledby="custom-tabs-one-10-19-tab">
                      <h6 class="font-weight-bold" style="font-size: 1.1em;">DEWORMING SERVICES FOR 10-19 YEARS OLD
                      </h6>

                                <?php
                                $deworming3rd = mysqli_query($con, "SELECT deworming_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
                          DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
                          CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, sex, mother_name, 
                          purok, address, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
                          DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks, remarks_1stdose, 
                          remarks_2nddose FROM $service INNER JOIN client ON deworming.patientid = client.id AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 10 AND 19 WHERE reg_date between '$date' AND '$newDate'");
                                ?>

                                <table id="example2" class="table table-bordered table-hover text-center">
                                  <thead>
                                    <tr>
                                      <th>Date of Registration</th>
                                      <th>Date of Birth</th>
                                      <th>Name of Child</th>
                                      <th>Sex</th>
                                      <th>Name of Mother</th>
                                      <th>Complete Address</th>
                                      <th>Age</th>
                                      <th>1st Dose (date given)</th>
                                      <th>2nd Dose (date given)</th>
                                      <th>Remarks</th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                    <?php
                                    while ($data = mysqli_fetch_array($deworming3rd)) { ?>

                                          <tr>
                                            <td>
                                              <?php echo $data['regdate']; ?>
                                            </td>
                                            <td>
                                              <?php echo $data['birthdate']; ?>
                                            </td>
                                            <td>
                                              <?php echo $data['fullname']; ?>
                                            </td>
                                            <td>
                                              <?php echo $data['sex']; ?>
                                            </td>
                                            <td>
                                              <?php echo $data['mother_name']; ?>
                                            </td>
                                            <td>
                                              <?php echo $data['purok']; ?>, <?php echo $data['address']; ?>
                                            </td>
                                              <?php
                                              $birthdate = $data['birthdate'];
                                              $birthDateObj = DateTime::createFromFormat('m-d-Y', $birthdate);

                                              if ($birthDateObj === false) {
                                                echo "Failed to parse the birthdate.";
                                              } else {
                                                $currentDateObj = new DateTime();
                                                $age = $birthDateObj->diff($currentDateObj);

                                                $years = $age->y;
                                                $months = $age->m;

                                                ?>
                                                        <td>
                                                    <?php
                                                    if ($years == 0) {
                                                      if ($months == 1) {
                                                        echo "1 month";
                                                      } elseif ($months == 0) {
                                                        echo "0 month";
                                                      } else {
                                                        echo "$months months";
                                                      }
                                                    } elseif ($years == 1) {
                                                      if ($months == 1) {
                                                        echo "1 year old";
                                                      } elseif ($months == 0) {
                                                        echo "1 year old";
                                                      } else {
                                                        echo "1 year old";
                                                      }
                                                    } else {
                                                      if ($months == 1) {
                                                        echo "$years years old";
                                                      } elseif ($months == 0) {
                                                        echo "$years years old";
                                                      } else {
                                                        echo "$years years old";
                                                      }
                                                    }
                                              }
                                              ?>
                      </td>
                                                  <td>
                                                    <?php if ($data['1st_dose'] != '00-00-0000') {
                                                      echo $data['1st_dose'];
                                                    } ?>
                                                  </td>
                                                  <td>
                                                    <?php if ($data['2nd_dose'] != '00-00-0000') {
                                                      echo $data['2nd_dose'];
                                                    }
                                                    ; ?>
                                                  </td>
                                            <td>
                                              <?php echo nl2br($data['remarks']); ?>
                                            </td>
                                          </tr>
                                    <?php } ?>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>

                          <?php } ?>


                          <?php
                          if ($service == "immunization") {
                            ?>

                                <div><br>
                                  <ul class="nav nav-tabs font-weight-bold">
                                    <li class="nav-item">
                                      <a data-toggle="tab" class="nav-link active" href="#page1">
                                        <i class="fa fa-file"></i> Page 1</a>
                                    </li>
                                    <li class="nav-item">
                                      <a data-toggle="tab" class="nav-link" href="#page2">
                                        <i class="fa fa-file"></i> Page 2</a>
                                    </li>
                                    <li class="nav-item">
                                      <a data-toggle="tab" class="nav-link" href="#page3">
                                        <i class="fa fa-file"></i> Page 3</a>
                                    </li>
                                    <li class="nav-item">
                                      <a data-toggle="tab" class="nav-link" href="#page4">
                                        <i class="fa fa-file"></i> Page 4</a>
                                    </li>
                                  </ul>

                                  <?php
                                  $immunization = mysqli_query($con, "SELECT immunization_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
                  DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, se_status, CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, 
                  sex, mother_name, CONCAT(purok, ', ', address) AS caddress, cpab1, cpab2 FROM $service INNER JOIN client ON immunization.patientid = client.id
                  WHERE reg_date between '$date' AND '$newDate'");
                                  ?>

                                  <!-- Tab panes -->
                                  <div class="tab-content">
                                    <div class="tab-pane active py-3" id="page1">
                                      <table id="example" class="table table-bordered table-hover text-center"
                                        cellspacing="0" width="100%">
                                        <thead>
                                          <tr>
                                            <th rowspan="2">Date of Registration</th>
                                            <th rowspan="2">Date of Birth</th>
                                            <th rowspan="2" class="font-weight-normal"><b>SE Status</b>
                                              <br><b>1:</b> NHTS <br><b>2:</b> Non-NHTS
                                            </th>
                                            <th rowspan="2">Name of Child</th>
                                            <th rowspan="2">Sex</th>
                                            <th rowspan="2">Name of Mother</th>
                                            <th rowspan="2">Complete Address</th>
                                            <th colspan="2">Child Protected at Birth (CPAB)</th>
                                          </tr>
                                          <tr>
                                            <th class="font-weight-normal">TT2/Td2 given <br>to the mother <br>a month prior <br>to
                                              delivery <br>(for mothers <br>pregnant for the <br>first time)</th>
                                            <th class="font-weight-normal">TT3/Td3 <br>to TT5/Td5 <br>(or TT1/Td1 <br>to TT5/Td5)
                                              <br>given to the <br>mother <br>anytime <br>prior to <br>delivery
                                            </th>
                                          </tr>
                                        </thead>
                                        <tbody>

                                          <?php
                                          while ($data = mysqli_fetch_array($immunization)) { ?>

                                                <tr>
                                                  <td>
                                                    <?php echo $data['regdate']; ?>
                                                  </td>
                                                  <td>
                                                    <?php echo $data['birthdate']; ?>
                                                  </td>
                                                  <td>
                                                    <?php echo $data['se_status']; ?>
                                                  </td>
                                                  <td>
                                                    <?php echo $data['fullname']; ?>
                                                  </td>
                                                  <td>
                                                    <?php echo $data['sex']; ?>
                                                  </td>
                                                  <td>
                                                    <?php echo $data['mother_name']; ?>
                                                  </td>
                                                  <td>
                                                    <?php echo $data['caddress']; ?>
                                                  </td>
                                                  <td>
                                                    <?php echo $data['cpab1']; ?>
                                                  </td>
                                                  <td>
                                                    <?php echo $data['cpab2']; ?>
                                                  </td>
                                                </tr>

                                          <?php } ?>
                                        </tbody>
                                      </table>
                                    </div>

                                    <?php
                                    $immunization = mysqli_query($con, "SELECT immunization_id, patientid, length, weight, birth_weight_status, 
                  DATE_FORMAT(initiated_breastfeed,'%m-%d-%Y') AS breastfeed, DATE_FORMAT(bcg,'%m-%d-%Y') AS bcgdate,
                  DATE_FORMAT(hepab,'%m-%d-%Y') AS hepabdate FROM $service INNER JOIN client ON immunization.patientid = client.id 
                  WHERE reg_date between '$date' AND '$newDate'");
                                    ?>

                                    <div class="tab-pane fade py-3" id="page2">
                                      <table id="example1" class="table table-bordered table-hover text-center" width="100%">
                                        <thead>
                                          <tr>
                                            <th colspan="6">NEWBORN (0-28 DAYS OLD)</th>
                                          </tr>
                                          <tr>
                                            <th rowspan="2" class="font-weight-normal"><b>Length <br>at Birth</b> <br>(cm)</th>
                                            <th rowspan="2" class="font-weight-normal"><b>Weight <br>at Birth</b> <br>(kg)</th>
                                            <th>Status <br>(Birth Weight)</th>
                                            <th rowspan="2">Initiated breast feeding <br>immediately after birth <br>lasting for 90
                                              minutes</th>
                                            <th colspan="2">Immunization</th>
                                          </tr>
                                          <tr>
                                            <th class="font-weight-normal"><b>L:</b> low: <br>
                                              <2,500 gms <br><b>N:</b> normal: <br>>2,500 gms <br><b>U:</b> unknown
                                            </th>
                                            <th>BCG</th>
                                            <th>Hepa B-BD</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <?php
                                          while ($data = mysqli_fetch_array($immunization)) { ?>

                                                <tr>
                                        <td>
                                          <?php if ($data['length'] > 0) {
                                            echo $data['length'];
                                          }
                                          ; ?>
                                        </td>
                                        <td>
                                          <?php if ($data['weight'] > 0) {
                                            echo $data['weight'];
                                          }
                                          ; ?>
                                        </td>
                                        <td>
                                          <?php echo $data['birth_weight_status']; ?>
                                        </td>
                                        <td>
                                          <?php if ($data['breastfeed'] != '00-00-0000') {
                                            echo $data['breastfeed'];
                                          }
                                          ; ?>
                                        </td>
                                        <td>
                                          <?php if ($data['bcgdate'] != '00-00-0000') {
                                            echo $data['bcgdate'];
                                          }
                                          ; ?>
                                        </td>
                                        <td>
                                          <?php if ($data['hepabdate'] != '00-00-0000') {
                                            echo $data['hepabdate'];
                                          }
                                          ; ?>
                                        </td>
                                                </tr>

                                          <?php } ?>

                                        </tbody>
                                      </table>
                                    </div>

                                    <?php
                                    $immunization = mysqli_query($con, "SELECT immunization_id, patientid, DATE_FORMAT(dpt_hib_hepb_1stdose,'%m-%d-%Y') AS dpt_hib_hepb1, 
                  DATE_FORMAT(dpt_hib_hepb_2nddose,'%m-%d-%Y') AS dpt_hib_hepb2, DATE_FORMAT(dpt_hib_hepb_3rddose,'%m-%d-%Y') AS dpt_hib_hepb3,
                  DATE_FORMAT(opv_1stdose,'%m-%d-%Y') AS opv1, DATE_FORMAT(opv_2nddose,'%m-%d-%Y') AS opv2,
                  DATE_FORMAT(opv_3rddose,'%m-%d-%Y') AS opv3, DATE_FORMAT(pcv_1stdose,'%m-%d-%Y') AS pcv1, DATE_FORMAT(pcv_2nddose,'%m-%d-%Y') AS pcv2,
                  DATE_FORMAT(pcv_3rddose,'%m-%d-%Y') AS pcv3, DATE_FORMAT(ipv,'%m-%d-%Y') AS ipvdate FROM $service 
                  INNER JOIN client ON immunization.patientid = client.id WHERE reg_date between '$date' AND '$newDate'");
                                    ?>

                                    <div class="tab-pane fade py-3" id="page3">
                                      <table id="example2" class="table table-bordered table-hover text-center" width="100%">
                                        <thead>
                                          <tr>
                                            <th colspan="10">1-3 MONTHS OLD</th>
                                          </tr>
                                          <tr>
                                            <th colspan="10">Immunization</th>
                                          </tr>
                                          <tr>
                                            <th colspan="3">DPT-HIB-HepB</th>
                                            <th colspan="3">OPV</th>
                                            <th colspan="3">PCV</th>
                                            <th>IPV</th>
                                          </tr>
                                          <tr>
                                            <th class="font-weight-normal"><b>1st dose</b> <br>1 ½ mos</th>
                                            <th class="font-weight-normal"><b>2nd dose</b> <br>2 ½ mos</th>
                                            <th class="font-weight-normal"><b>3rd dose</b> <br>3 ½ mos</th>
                                            <th class="font-weight-normal"><b>1st dose</b> <br>1 ½ mos</th>
                                            <th class="font-weight-normal"><b>2nd dose</b> <br>2 ½ mos</th>
                                            <th class="font-weight-normal"><b>3rd dose</b> <br>3 ½ mos</th>
                                            <th class="font-weight-normal"><b>1st dose</b> <br>1 ½ mos</th>
                                            <th class="font-weight-normal"><b>2nd dose</b> <br>2 ½ mos</th>
                                            <th class="font-weight-normal"><b>3rd dose</b> <br>3 ½ mos</th>
                                            <th>3 mos</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <?php
                                          while ($data = mysqli_fetch_array($immunization)) { ?>

                                                <tr>
                                        <td>
                                          <?php if ($data['dpt_hib_hepb1'] != '00-00-0000') {
                                            echo $data['dpt_hib_hepb1'];
                                          }
                                          ; ?>
                                        </td>
                                        <td>
                                          <?php if ($data['dpt_hib_hepb2'] != '00-00-0000') {
                                            echo $data['dpt_hib_hepb2'];
                                          }
                                          ; ?>
                                        </td>
                                        <td>
                                          <?php if ($data['dpt_hib_hepb3'] != '00-00-0000') {
                                            echo $data['dpt_hib_hepb3'];
                                          }
                                          ; ?>
                                        </td>
                                        <td>
                                          <?php if ($data['opv1'] != '00-00-0000') {
                                            echo $data['opv1'];
                                          }
                                          ; ?>
                                        </td>
                                        <td>
                                          <?php if ($data['opv2'] != '00-00-0000') {
                                            echo $data['opv2'];
                                          }
                                          ; ?>
                                        </td>
                                        <td>
                                          <?php if ($data['opv3'] != '00-00-0000') {
                                            echo $data['opv3'];
                                          }
                                          ; ?>
                                        </td>
                                        <td>
                                          <?php if ($data['pcv1'] != '00-00-0000') {
                                            echo $data['pcv1'];
                                          }
                                          ; ?>
                                        </td>
                                        <td>
                                          <?php if ($data['pcv2'] != '00-00-0000') {
                                            echo $data['pcv2'];
                                          }
                                          ; ?>
                                        </td>
                                        <td>
                                          <?php if ($data['pcv3'] != '00-00-0000') {
                                            echo $data['pcv3'];
                                          }
                                          ; ?>
                                        </td>
                                        <td>
                                          <?php if ($data['ipvdate'] != '00-00-0000') {
                                            echo $data['ipvdate'];
                                          }
                                          ; ?>
                                        </td>
                                                </tr>

                                          <?php } ?>

                                        </tbody>
                                      </table>
                                    </div>

                                    <?php
                                    $immunization = mysqli_query($con, "SELECT immunization_id, patientid, DATE_FORMAT(mmr1stdose,'%m-%d-%Y') AS mmr1, 
                  DATE_FORMAT(mmr2nddose,'%m-%d-%Y') AS mmr2, DATE_FORMAT(fic_date,'%m-%d-%Y') AS fic,
                  remarks, remarks1, remarks2, remarks3, remarks4, remarks5, remarks6, remarks7 
                  FROM $service INNER JOIN client ON immunization.patientid = client.id WHERE reg_date between '$date' AND '$newDate'");
                                    ?>

                                    <div class="tab-pane fade py-3" id="page4">
                                      <table id="example3" class="table table-bordered table-hover text-center" width="100%">
                                        <thead>
                                          <tr>
                                            <th>6-11 MONTHS OLD</th>
                                            <th colspan="2">12 MONTHS OLD</th>
                                            <th rowspan="2">Remarks</th>
                                          </tr>
                                          <tr>
                                            <th>MMR Dose 1 <br>at 9th month</th>
                                            <th>MMR Dose 2 <br>at 12th month</th>
                                            <th>FIC</th>
                                          </tr>
                                        </thead>
                                        <tbody>

                                          <?php
                                          while ($data = mysqli_fetch_array($immunization)) { ?>

                                                <tr>
                                        <td>
                                          <?php if ($data['mmr1'] != '00-00-0000') {
                                            echo $data['mmr1'];
                                          }
                                          ; ?>
                                        </td>
                                        <td>
                                          <?php if ($data['mmr2'] != '00-00-0000') {
                                            echo $data['mmr2'];
                                          }
                                          ; ?>
                                        </td>
                                        <td>
                                          <?php if ($data['fic'] != '00-00-0000') {
                                            echo $data['fic'];
                                          }
                                          ; ?>
                                        </td>
                                        <td>
                                        <?php
                                          $remarksArray = array(
                                            $data['remarks'],
                                            $data['remarks1'],
                                            $data['remarks2'],
                                            $data['remarks3'],
                                            $data['remarks4'],
                                            $data['remarks5'],
                                            $data['remarks6'],
                                            $data['remarks7']
                                          );

                                          foreach ($remarksArray as $remark) {
                                            if (!empty($remark)) {
                                              echo nl2br($remark) . '<br>';
                                            }
                                          }
                                          ?>
                                        </td>
                                                </tr>

                                          <?php } ?>

                                        </tbody>
                                      </table>

                                <?php } ?>


                            <?php
                            if ($service == "nutrition2") {
                              ?>

                              <br>
                              <ul class="nav nav-tabs font-weight-bold">
                                <li class="nav-item">
                                  <a data-toggle="tab" class="nav-link active" href="#page1">
                                    <icon class="fa fa-file"></icon> Page 1
                                  </a>
                                </li>
                                <li class="nav-item">
                                  <a data-toggle="tab" class="nav-link" href="#page2">
                                    <i class="fa fa-file"></i> Page 2</a>
                                </li>
                              </ul>

                              <?php
                              $nutrition2 = mysqli_query($con, "SELECT nutrition2_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
                DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, 
                weight, height, sex, 6to11mos, 12to59mos, mother_name, CONCAT(purok, ', ', address) AS caddress FROM $service 
                INNER JOIN client ON nutrition2.patientid = client.id WHERE reg_date between '$date' AND '$newDate'");
                              ?>

                              <!-- Tab panes -->
                              <div class="tab-content">
                                <div class="tab-pane active py-3" id="page1">
                                  <table id="example" class="table table-bordered table-hover text-center" cellspacing="0"
                                    width="100%">
                                    <thead>
                                      <tr>
                                        <th>Date of Registration</th>
                                        <th>Date of Birth</th>
                                        <th>Name of Child</th>
                                        <th>Weight</th>
                                        <th>Height</th>
                                        <th>Sex</th>
                                        <th>Name of Mother</th>
                                        <th>Complete Address</th>
                                      </tr>
                                    </thead>
                                    <tbody>

                                      <?php
                                      while ($data = mysqli_fetch_array($nutrition2)) { ?>

                                            <tr>
                                        <td>
                                          <?php echo $data['regdate']; ?>
                                        </td>
                                        <td>
                                          <?php echo $data['birthdate']; ?>
                                        </td>
                                        <td>
                                          <?php echo $data['fullname']; ?>
                                        </td>
                                        <td>
                                          <?php if ($data['weight'] > 0) {
                                            echo $data['weight'];
                                          }
                                          ; ?>
                                        </td>
                                        <td>
                                          <?php if ($data['height'] > 0) {
                                            echo $data['height'];
                                          }
                                          ; ?>
                                        </td>
                                        <td>
                                          <?php echo $data['sex']; ?>
                                        </td>
                                        <td>
                                          <?php echo $data['mother_name']; ?>
                                        </td>
                                        <td>
                                          <?php echo $data['caddress']; ?>
                                        </td>
                                                </tr>

                                            <?php
                                      } ?>
                                    </tbody>
                                  </table>
                                </div>

                                <?php
                                $nutrition2 = mysqli_query($con, "SELECT nutrition2_id, patientid, DATE_FORMAT(vitamina,'%m-%d-%Y') AS vitamin, 
                      DATE_FORMAT(vitamin1,'%m-%d-%Y') AS vitamindose1, DATE_FORMAT(vitamin2,'%m-%d-%Y') AS vitamindose2, 
                      DATE_FORMAT(iron1,'%m-%d-%Y') AS irondose1, DATE_FORMAT(iron2,'%m-%d-%Y') AS irondose2, 
                DATE_FORMAT(mnp1,'%m-%d-%Y') AS mnpdose1, DATE_FORMAT(mnp2,'%m-%d-%Y') AS mnpdose2, 
                DATE_FORMAT(deworming,'%m-%d-%Y') AS dewormings, remarks, remarks1 FROM $service 
                INNER JOIN client ON nutrition2.patientid = client.id WHERE reg_date between '$date' AND '$newDate'");
                                ?>

                                <div class="tab-pane fade py-3" id="page2">
                                  <table id="example1" class="table table-bordered table-hover text-center" width="100%">
                                    <thead>
                                      <tr>
                                        <th colspan="7">Micronutrient Supplementation</th>
                                        <th rowspan="2">Deworming</th>
                                        <th rowspan="4">Remarks</th>
                                      </tr>
                                      <tr>
                                        <th colspan="3">Vitamin A</th>
                                        <th colspan="2">Iron</th>
                                        <th colspan="2">MNP</th>
                                      </tr>
                                      <tr>
                                        <th rowspan="2">6-11 mos.</th>
                                        <th colspan="2">12-59 mos.</th>
                                        <th rowspan="2">6-11 mos.</th>
                                        <th rowspan="2">12-59 mos.</th>
                                        <th rowspan="2">6-11 mos.</th>
                                        <th rowspan="2">12-23 mos.</th>
                                        <th rowspan="2">12-59 mos.</th>
                                      </tr>
                                      <tr>
                                        <th>Dose 1</th>
                                        <th>Dose 2</th>
                                      </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    while ($data = mysqli_fetch_array($nutrition2)) { ?>

                                            <tr>
                                        <td>
                                          <?php if ($data['vitamin'] != '00-00-0000') {
                                            echo $data['vitamin'];
                                          }
                                          ; ?>
                                        </td>
                                        <td>
                                          <?php if ($data['vitamindose1'] != '00-00-0000') {
                                            echo $data['vitamindose1'];
                                          }
                                          ; ?>
                                        </td>
                                        <td>
                                          <?php if ($data['vitamindose2'] != '00-00-0000') {
                                            echo $data['vitamindose2'];
                                          }
                                          ; ?>
                                        </td>
                                        <td>
                                          <?php if ($data['irondose1'] != '00-00-0000') {
                                            echo $data['irondose1'];
                                          }
                                          ; ?>
                                        </td>
                                        <td>
                                          <?php if ($data['irondose2'] != '00-00-0000') {
                                            echo $data['irondose2'];
                                          }
                                          ; ?>
                                        </td>
                                        <td>
                                          <?php if ($data['mnpdose1'] != '00-00-0000') {
                                            echo $data['mnpdose1'];
                                          }
                                          ; ?>
                                        </td>
                                        <td>
                                          <?php if ($data['mnpdose2'] != '00-00-0000') {
                                            echo $data['mnpdose2'];
                                          }
                                          ; ?>
                                        </td>
                                        <td>
                                          <?php if ($data['dewormings'] != '00-00-0000') {
                                            echo $data['dewormings'];
                                          }
                                          ; ?>
                                        </td>
                                        <td>
                                          <?php
                                          if ($data['vitamin'] || $data['irondose1'] 
                                          || $data['mnpdose1'] != '00-00-0000') {
                                            echo nl2br($data['remarks1']);
                                          } if ($data['vitamindose1'] || $data['vitamindose2'] 
                                          || $data['irondose2'] || $data['mnpdose2'] || $data['dewormings'] != '00-00-0000') {
                                            echo nl2br($data['remarks']);
                                          }
                                          ?>
                                        </td>
                                            </tr>

                                            <?php
                                    } ?>

                                    </tbody>
                                  </table>

                            <?php } ?>



                            <?php
                            if ($service == "sickchildren") {
                              ?>

                          <br>
                            <ul class="nav nav-tabs font-weight-bold">
                              <li class="nav-item">
                                <a data-toggle="tab" class="nav-link active" href="#page1">
                                  <icon class="fa fa-file"></icon> Page 1
                                </a>
                              </li>
                              <li class="nav-item">
                                <a data-toggle="tab" class="nav-link" href="#page2">
                                  <i class="fa fa-file"></i> Page 2</a>
                              </li>
                            </ul>

                            <?php
                            $sickchildren = mysqli_query($con, "SELECT sick_children_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
                CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
                sex, mother_name, CONCAT(purok, ', ', address) AS caddress, se_status FROM $service 
                INNER JOIN client ON sickchildren.patientid = client.id WHERE reg_date between '$date' AND '$newDate'");
                            ?>

                            <!-- Tab panes -->
                            <div class="tab-content">
                              <div class="tab-pane active py-3" id="page1">
                                <table id="example" class="table table-bordered table-hover text-center" cellspacing="0"
                                  width="100%">
                                  <thead>
                                    <tr>
                                      <th>Date of Registration</th>
                                      <th>Name of Child</th>
                                      <th>Date of Birth</th>
                                      <th>Sex</th>
                                      <th>Name of Mother</th>
                                      <th>Complete Address</th>
                                      <th class="font-weight-normal"><b>SE Status</b> 
                                      <br><b>1:</b> NHTS <br><b>2:</b> Non-NHTS</th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                    <?php
                                    while ($data = mysqli_fetch_array($sickchildren)) { ?>

                                          <tr>
                                            <td>
                                              <?php echo $data['regdate']; ?>
                                            </td>
                                            <td>
                                              <?php echo $data['fullname']; ?>
                                            </td>
                                            <td>
                                              <?php echo $data['birthdate']; ?>
                                            </td>
                                            <td>
                                              <?php echo $data['sex']; ?>
                                            </td>
                                            <td>
                                              <?php echo $data['mother_name']; ?>
                                            </td>
                                            <td>
                                              <?php echo $data['caddress']; ?>
                                            </td>
                                            <td>
                                              <?php echo $data['se_status']; ?>
                                            </td>
                                          </tr>

                                          <?php
                                    } ?>

                                  </tbody>
                                </table>
                              </div>

                              <?php
                              $sickchildren = mysqli_query($con, "SELECT sick_children_id, patientid, vitamin_6to11mos, vitamin_12to59mos, diagnosis, 
                DATE_FORMAT(vitamin_supplementation_date,'%m-%d-%Y') AS vitamindate, diarrhea_age, 
                DATE_FORMAT(diarrhea_ors_date,'%m-%d-%Y') AS orsdate, DATE_FORMAT(diarrhea_oralzinc_date,'%m-%d-%Y') AS oralzincdate, 
                pneumonia_age, DATE_FORMAT(pneumonia_treatment_date,'%m-%d-%Y') AS pneumoniadate, remarks1, remarks2, remarks FROM $service 
                INNER JOIN client ON sickchildren.patientid = client.id WHERE reg_date between '$date' AND '$newDate'");
                              ?>

                              <div class="tab-pane fade py-3" id="page2">
                                <table id="example1" class="table table-bordered table-hover text-center" width="100%">
                                  <thead>
                                    <tr>
                                      <th colspan="4">Vitamin A Supplementation</th>
                                      <th colspan="3">Diarrhea Cases Seen and Given Treatment</th>
                                      <th colspan="2">Pneumonia Cases Seen <br>and Given Treatment</th>
                                      <th rowspan="3">Remarks</th>
                                    </tr>
                                    <tr>
                                      <th colspan="2">Put a (✓)</th>
                                      <th rowspan="2">Diagnosis/ <br>Findings</th>
                                      <th rowspan="2">Date Given
                                      <th rowspan="2">Age in <br>Months</th>
                                      <th colspan="2">Date Given</th>
                                      <th rowspan="2">Age in <br>Months</th>
                                      <th rowspan="2">Date Given <br>Treatment</th>
                                    </tr>
                                    <tr>
                                      <th>6-11 mos.</th>
                                      <th>12-59 mos.</th>
                                      <th>ORS</th>
                                      <th>Oral zinc <br>drops or syrup</th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                    <?php
                                    while ($data = mysqli_fetch_array($sickchildren)) { ?>

                                          <tr>
                                                      <td>
                                                      <?php echo $data['vitamin_6to11mos']; ?>
                                                    </td>
                                                    <td>
                                                      <?php echo $data['vitamin_12to59mos']; ?>
                                                    </td>
                                                    <td>
                                                      <?php echo $data['diagnosis']; ?>
                                                    </td>
                                                    <td>
                                                      <?php if ($data['vitamindate'] != '00-00-0000') {
                                                        echo $data['vitamindate'];
                                                      }
                                                      ; ?>
                                                    </td>
                                                    <td>
                                                      <?php if ($data['diarrhea_age'] > 0) {
                                                        echo $data['diarrhea_age'];
                                                      }
                                                      ; ?>
                                                    </td>
                                                    <td>
                                                      <?php if ($data['orsdate'] != '00-00-0000') {
                                                        echo $data['orsdate'];
                                                      }
                                                      ; ?>
                                                    </td>
                                                    <td>
                                                      <?php if ($data['oralzincdate'] != '00-00-0000') {
                                                        echo $data['oralzincdate'];
                                                      }
                                                      ; ?>
                                                    </td>
                                                    <td>
                                                      <?php if ($data['pneumonia_age'] > 0) {
                                                        echo $data['pneumonia_age'];
                                                      }
                                                      ; ?>
                                                    </td>
                                                    <td>
                                                      <?php if ($data['pneumoniadate'] != '00-00-0000') {
                                                        echo $data['pneumoniadate'];
                                                      }
                                                      ; ?>
                                                    </td>
                                                    <td>
                                                      <?php 
                                                        $remarksArray = array(
                                                          $data['remarks'],
                                                          $data['remarks1'],
                                                          $data['remarks2']
                                                        );

                                                        foreach ($remarksArray as $remark) {
                                                          if (!empty($remark)) {
                                                            echo nl2br($remark) . '<br>';
                                                          }
                                                        }
                                                        ?>
                                                    </td>
                                          </tr>

                                          <?php
                                    } ?>
                                  </tbody>
                                </table>

                            <?php } ?>



                            <?php
                            if ($service == "maternal") {
                              ?>

                          <br>
                            <ul class="nav nav-tabs font-weight-bold">
                              <li class="nav-item">
                                <a data-toggle="tab" class="nav-link active" href="#page1">
                                  <i class="fa fa-file"></i> Page 1</a>
                              </li>
                              <li class="nav-item">
                                <a data-toggle="tab" class="nav-link" href="#page2">
                                  <i class="fa fa-file"></i> Page 2</a>
                              </li>
                              <li class="nav-item">
                                <a data-toggle="tab" class="nav-link" href="#page3">
                                  <i class="fa fa-file"></i> Page 3</a>
                              </li>
                            </ul>

                            <?php
                            $maternal = mysqli_query($con, "SELECT maternal_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate,
                            DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
                            CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, purok, address, 
                            DATE_FORMAT(lmp,'%m-%d-%Y') AS lmpdate, g, p, DATE_FORMAT(edc,'%m-%d-%Y') AS edcdate, 
                            DATE_FORMAT(trimester1,'%m-%d-%Y') AS tri1, DATE_FORMAT(trimester1a,'%m-%d-%Y') AS tri1a, 
                            DATE_FORMAT(trimester2,'%m-%d-%Y') AS tri2, DATE_FORMAT(trimester2a,'%m-%d-%Y') AS tri2a, 
                            DATE_FORMAT(trimester3,'%m-%d-%Y') AS tri3, DATE_FORMAT(trimester3a,'%m-%d-%Y') AS tri3a FROM $service
                            INNER JOIN client ON maternal.patientid = client.id WHERE reg_date between '$date' AND '$newDate'");
                            ?>

                            <!-- Tab panes -->
                            <div class="tab-content">
                              <div class="tab-pane active py-3" id="page1">
                                <table id="example" class="table table-bordered table-hover text-center" cellspacing="0"
                                  width="100%">
                                  <thead>
                                    <tr>
                                      <th rowspan="2">Date of <br>Registration</th>
                                      <th rowspan="2">Name</th>
                                      <th rowspan="2">Address</th>
                                      <th rowspan="2">Age</th>
                                      <th rowspan="2">LMP <br>G-P</th>
                                      <th rowspan="2">EDC</th>
                                      <th colspan="3">Prenatal Visits</th>
                                    </tr>
                                    <tr>
                                      <th>First Trimester</th>
                                      <th>Second Trimester</th>
                                      <th>Third Trimester</th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                    <?php
                                    while ($data = mysqli_fetch_array($maternal)) { ?>

                                          <tr>
                                      <td>
                                        <?php echo $data['regdate']; ?>
                                      </td>
                                      <td>
                                        <?php echo $data['fullname']; ?>
                                      </td>
                                      <td>
                                        <?php echo $data['purok']; ?>, <br><?php echo $data['address']; ?>
                                      </td>
                                              <?php
                                              $birthdate = $data['birthdate'];
                                              $birthDateObj = DateTime::createFromFormat('m-d-Y', $birthdate);

                                              if ($birthDateObj === false) {
                                                echo "Failed to parse the birthdate.";
                                              } else {
                                                $currentDateObj = new DateTime();
                                                $age = $birthDateObj->diff($currentDateObj);

                                                $years = $age->y;
                                                $months = $age->m;

                                                ?>
                                                                  <td>
                                                              <?php
                                                              if ($years == 0) {
                                                                if ($months == 1) {
                                                                  echo "1 month";
                                                                } elseif ($months == 0) {
                                                                  echo "0 month";
                                                                } else {
                                                                  echo "$months months";
                                                                }
                                                              } elseif ($years == 1) {
                                                                if ($months == 1) {
                                                                  echo "1 year old";
                                                                } elseif ($months == 0) {
                                                                  echo "1 year old";
                                                                } else {
                                                                  echo "1 year old";
                                                                }
                                                              } else {
                                                                if ($months == 1) {
                                                                  echo "$years years old";
                                                                } elseif ($months == 0) {
                                                                  echo "$years years old";
                                                                } else {
                                                                  echo "$years years old";
                                                                }
                                                              }
                                              }
                                              ?>
                              </td>
                                      <td>
                                      <?php if ($data['lmpdate'] > 0) {
                                        echo $data['lmpdate'];
                                      }
                                      ; ?> 
                                        <br><?php echo 'G' . $data['g']; ?>
                                        <?php echo 'P' . $data['p']; ?>
                                      </td>
                                      <td>
                                        <?php if ($data['edcdate'] != '00-00-0000') {
                                          echo $data['edcdate'];
                                        }
                                        ; ?>
                                      </td>
                                      <td>
                                        <?php if ($data['tri1'] != '00-00-0000') {
                                          echo $data['tri1'];
                                        }
                                        ; ?> <br>
                                        <?php if ($data['tri1a'] != '00-00-0000') {
                                          echo $data['tri1a'];
                                        }
                                        ; ?>
                                      </td>
                                      <td>
                                        <?php if ($data['tri2'] != '00-00-0000') {
                                          echo $data['tri2'];
                                        }
                                        ; ?> <br>
                                        <?php if ($data['tri2a'] != '00-00-0000') {
                                          echo $data['tri2a'];
                                        }
                                        ; ?>
                                      </td>
                                      <td>
                                        <?php if ($data['tri3'] != '00-00-0000') {
                                          echo $data['tri3'];
                                        }
                                        ; ?> <br>
                                        <?php if ($data['tri3a'] != '00-00-0000') {
                                          echo $data['tri3a'];
                                        }
                                        ; ?>
                                      </td>
                                          </tr>

                                    <?php } ?>

                                  </tbody>
                                </table>
                              </div>


                              <?php
                              $maternal = mysqli_query($con, "SELECT maternal_id, patientid, tetanus_status, DATE_FORMAT(tt1date,'%m-%d-%Y') AS tt1, DATE_FORMAT(tt2date,'%m-%d-%Y') AS tt2,
                  DATE_FORMAT(tt3date,'%m-%d-%Y') AS tt3, DATE_FORMAT(tt4date,'%m-%d-%Y') AS tt4, DATE_FORMAT(tt5date,'%m-%d-%Y') AS tt5,
                  DATE_FORMAT(iron1date,'%m-%d-%Y') AS iron1st, 1datenumber, DATE_FORMAT(iron2date,'%m-%d-%Y') AS iron2nd, 2datenumber,
                  DATE_FORMAT(iron3date,'%m-%d-%Y') AS iron3rd, 3datenumber, DATE_FORMAT(iron4date,'%m-%d-%Y') AS iron4th, 4datenumber,
                  DATE_FORMAT(iron5date,'%m-%d-%Y') AS iron5th, 5datenumber, DATE_FORMAT(iron6date,'%m-%d-%Y') AS iron6th, 6datenumber
                  FROM $service INNER JOIN client ON maternal.patientid = client.id WHERE reg_date between '$date' AND '$newDate'");
                              ?>

                              <div class="tab-pane fade py-3" id="page2">
                                <table id="example1" class="table table-bordered table-hover text-center" width="100%">
                                  <thead>
                                    <tr>
                                      <th rowspan="3">Tetanus <br>Status</th>
                                      <th colspan="5">Date Tetanus Toxoid Vaccine Given</th>
                                      <th colspan="6">Micronutrient Supplementation</th>
                                    </tr>
                                    <tr>
                                      <th rowspan="2">TT1</th>
                                      <th rowspan="2">TT2</th>
                                      <th rowspan="2">TT3</th>
                                      <th rowspan="2">TT4</th>
                                      <th rowspan="2">TT5</th>
                                      <th colspan="6">Date and Number <br>Iron with Folic Acid was given</th>
                                    </tr>
                                    <tr>
                                      <th><br></th>
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                    <?php
                                    while ($data = mysqli_fetch_array($maternal)) { ?>

                                          <tr>
                                      <td>
                                        <?php echo $data['tetanus_status']; ?>
                                      </td>
                                      <td>
                                        <?php if ($data['tt1'] != '00-00-0000') {
                                          echo $data['tt1'];
                                        }
                                        ; ?>
                                      </td>
                                      <td>
                                        <?php if ($data['tt2'] != '00-00-0000') {
                                          echo $data['tt2'];
                                        }
                                        ; ?>
                                      </td>
                                      <td>
                                        <?php if ($data['tt3'] != '00-00-0000') {
                                          echo $data['tt3'];
                                        }
                                        ; ?>
                                      </td>
                                      <td>
                                        <?php if ($data['tt4'] != '00-00-0000') {
                                          echo $data['tt4'];
                                        }
                                        ; ?>
                                      </td>
                                      <td>
                                        <?php if ($data['tt5'] != '00-00-0000') {
                                          echo $data['tt5'];
                                        }
                                        ; ?>
                                      </td>
                                      <td>
                                        <?php if ($data['iron1st'] != '00-00-0000') {
                                          echo $data['iron1st'];
                                        }
                                        ; ?><br>
                                        <?php if ($data['1datenumber'] > 0) {
                                          echo $data['1datenumber'];
                                        }
                                        ; ?>
                                      </td>
                                      <td>
                                        <?php if ($data['iron2nd'] != '00-00-0000') {
                                          echo $data['iron2nd'];
                                        }
                                        ; ?><br>
                                        <?php if ($data['2datenumber'] > 0) {
                                          echo $data['2datenumber'];
                                        }
                                        ; ?>
                                      </td>
                                      <td>
                                        <?php if ($data['iron3rd'] != '00-00-0000') {
                                          echo $data['iron3rd'];
                                        }
                                        ; ?><br>
                                        <?php if ($data['3datenumber'] > 0) {
                                          echo $data['3datenumber'];
                                        }
                                        ; ?>
                                      </td>
                                      <td>
                                        <?php if ($data['iron4th'] != '00-00-0000') {
                                          echo $data['iron4th'];
                                        }
                                        ; ?><br>
                                        <?php if ($data['4datenumber'] > 0) {
                                          echo $data['4datenumber'];
                                        }
                                        ; ?>
                                      </td>
                                      <td>
                                        <?php if ($data['iron5th'] != '00-00-0000') {
                                          echo $data['iron5th'];
                                        }
                                        ; ?><br>
                                        <?php if ($data['5datenumber'] > 0) {
                                          echo $data['5datenumber'];
                                        }
                                        ; ?>
                                        </td>
                                        <td>
                                        <?php if ($data['iron6th'] != '00-00-0000') {
                                          echo $data['iron6th'];
                                        }
                                        ; ?><br>
                                        <?php if ($data['6datenumber'] > 0) {
                                          echo $data['6datenumber'];
                                        }
                                        ; ?>
                                        </td>
                                              </tr>

                                    <?php } ?>

                                  </tbody>
                                </table>
                              </div>


                              <?php
                              $maternal = mysqli_query($con, "SELECT maternal_id, patientid, DATE_FORMAT(sydate,'%m-%d-%Y') AS sy_date,
                  syresult, DATE_FORMAT(syresult_date,'%m-%d-%Y') AS result_date, given_penicillin, 
                  DATE_FORMAT(given_penicillin_date,'%m-%d-%Y') AS penicillin_date, 
                  DATE_FORMAT(date_terminated,'%m-%d-%Y') AS terminated_date, 
                  outcome, gender, birth_weight, facility, nid, attended, remarks FROM $service 
                  INNER JOIN client ON maternal.patientid = client.id WHERE reg_date between '$date' AND '$newDate'");
                              ?>


                              <div class="tab-pane fade py-3" id="page3">
                                <table id="example2" class="table table-bordered table-hover text-center" width="100%">
                                  <thead>
                                    <tr>
                                      <th colspan="3">STI Surveillance</th>
                                      <th colspan="2">Pregnancy</th>
                                      <th colspan="4">Livebirths</th>
                                      <th rowspan="3">Remarks</th>
                                    </tr>
                                    <tr>
                                      <th>Tested for SY</th>
                                      <th>Result for <br>SY Testing</th>
                                      <th>Given Penicillin</th>
                                      <th rowspan="2">Date Terminated</th>
                                      <th rowspan="2">Outcome / <br>Gender (M/F)</th>
                                      <th rowspan="2" class="font-weight-normal"><b>Birth <br>Weight</b> <br>(grams)</th>
                                      <th colspan="2">Place of</th>
                                      <th rowspan="2">Attended by</th>
                                    </tr>
                                    <tr>
                                      <th>Date</th>
                                      <th>(+/-) / <br>Date</th>
                                      <th>Y/N <br>Date</th>
                                      <th>Health Facility</th>
                                      <th>NID</th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                    <?php
                                    while ($data = mysqli_fetch_array($maternal)) { ?>

                                          <tr>
                                      <td>
                                        <?php if ($data['sy_date'] != '00-00-0000') {
                                          echo $data['sy_date'];
                                        }
                                        ; ?>
                                      </td>
                                      <td>
                                        <?php echo $data['syresult']; ?> <br>
                                        <?php if ($data['result_date'] != '00-00-0000') {
                                          echo $data['result_date'];
                                        }
                                        ; ?>
                                      </td>
                                      <td>
                                        <?php echo $data['given_penicillin']; ?> <br>
                                        <?php if ($data['penicillin_date'] != '00-00-0000') {
                                          echo $data['penicillin_date'];
                                        }
                                        ; ?>
                                      </td>
                                      <td>
                                        <?php if ($data['terminated_date'] != '00-00-0000') {
                                          echo $data['terminated_date'];
                                        }
                                        ; ?>
                                      </td>
                                      <td>
                                        <?php echo $data['outcome']; ?> <br>
                                        <?php echo $data['gender']; ?>
                                      </td>
                                      <td>
                                        <?php if ($data['birth_weight'] > 0) {
                                          echo $data['birth_weight'];
                                        }
                                        ; ?>
                                      </td>
                                      <td>
                                        <?php echo $data['facility']; ?>
                                      </td>
                                      <td>
                                        <?php echo $data['nid']; ?>
                                      </td>
                                      <td>
                                        <?php echo $data['attended']; ?>
                                      </td>
                                      <td>
                                        <?php echo nl2br($data['remarks']); ?>
                                      </td>
                                          </tr>

                                    <?php } ?>

                                  </tbody>
                                </table>

                            <?php } ?>


                            <?php
                            if ($service == "postpartum") {
                              ?>

                          <table id="example" class="table table-bordered table-hover text-center">
                            <thead>
                              <tr>
                                <th rowspan="3">Date <br>and Time <br>of Delivery</th>
                                <th rowspan="3">Name</th>
                                <th rowspan="3">Address</th>
                                <th colspan="2">Date Postpartum Visits</th>
                                <th rowspan="3">Date <br>and Time <br>Initiated <br>Brestfeeding</th>
                                <th colspan="4">Micronutrient Supplementation</th>
                                <th rowspan="3">Remarks</th>
                              </tr>
                              <tr>
                                <th rowspan="2">Within <br>24 hours <br>after <br>delivery</th>
                                <th rowspan="2">Within <br>1 week <br>after <br>delivery</th>
                                <th colspan="3">Iron</th>
                                <th>Vitamin A</th>
                              </tr>
                              <tr>
                                <th colspan="3">Date / No. Tablets</th>
                                <th>Date</th>
                              </tr>
                            </thead>
                            <tbody>

                              <?php
                              $postpartum = mysqli_query($con, "SELECT postpartum_id, patientid, DATE_FORMAT(delivery_date,'%m-%d-%Y') AS deliverydate, 
                    TIME_FORMAT(delivery_time, '%h:%i %p') AS deliverytime, 
                    CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, purok, address, 
                    DATE_FORMAT(date_visit_24hr,'%m-%d-%Y') AS visit24hr, DATE_FORMAT(date_visit_1week,'%m-%d-%Y') AS visit1week, 
                    DATE_FORMAT(date_breastfeed,'%m-%d-%Y') AS datebreastfeed, TIME_FORMAT(time_breastfeed, '%h:%i %p') AS timebreastfeed, 
                    DATE_FORMAT(iron_supplementation_1stdate,'%m-%d-%Y') AS iron1stdate, 1stdate_tablets, 
                    DATE_FORMAT(iron_supplementation_2nddate,'%m-%d-%Y') AS iron2nddate, 2nddate_tablets, 
                    DATE_FORMAT(iron_supplementation_3rddate,'%m-%d-%Y') AS iron3rddate, 3rddate_tablets, 
                    DATE_FORMAT(vitamin_supplementation_date,'%m-%d-%Y') AS vitamindate, remarks 
                    FROM $service INNER JOIN client ON postpartum.patientid = client.id WHERE delivery_date between '$date' AND '$newDate'");
                              while ($data = mysqli_fetch_array($postpartum)) { ?>

                                    <tr>
                                              <td>
                                              <?php echo $data['deliverydate']; ?> <br>
                                              <?php echo $data['deliverytime']; ?>
                                            </td>
                                            <td>
                                              <?php echo $data['fullname']; ?>
                                            </td>
                                            <td>
                                              <?php echo $data['purok']; ?>, <?php echo $data['address']; ?>
                                            </td>
                                            <td>
                                              <?php if ($data['visit24hr'] != '00-00-0000') {
                                                echo $data['visit24hr'];
                                              }
                                              ; ?>
                                            </td>
                                            <td>
                                              <?php if ($data['visit1week'] != '00-00-0000') {
                                                echo $data['visit1week'];
                                              }
                                              ; ?>
                                            </td>
                                            <td>
                                              <?php if ($data['datebreastfeed'] != '00-00-0000') {
                                                echo $data['datebreastfeed'];
                                              }
                                              ; ?> <br>
                                              <?php if ($data['timebreastfeed'] > 0) {
                                                echo $data['timebreastfeed'];
                                              }
                                              ; ?>
                                            </td>
                                            <td>
                                              <?php if ($data['iron1stdate'] != '00-00-0000') {
                                                echo $data['iron1stdate'];
                                              }
                                              ; ?> <br>
                                              <?php if ($data['1stdate_tablets'] > 0) {
                                                echo $data['1stdate_tablets'];
                                              }
                                              ; ?>
                                            </td>
                                            <td>
                                              <?php if ($data['iron2nddate'] != '00-00-0000') {
                                                echo $data['iron2nddate'];
                                              }
                                              ; ?> <br>
                                              <?php if ($data['2nddate_tablets'] > 0) {
                                                echo $data['2nddate_tablets'];
                                              }
                                              ; ?>
                                            </td>
                                            <td>
                                              <?php if ($data['iron3rddate'] != '00-00-0000') {
                                                echo $data['iron3rddate'];
                                              }
                                              ; ?> <br>
                                              <?php if ($data['3rddate_tablets'] > 0) {
                                                echo $data['3rddate_tablets'];
                                              }
                                              ; ?>
                                            </td>
                                            <td>
                                              <?php if ($data['vitamindate'] != '00-00-0000') {
                                                echo $data['vitamindate'];
                                              }
                                              ; ?>
                                            </td>
                                            <td>
                                              <?php echo nl2br($data['remarks']); ?>
                                            </td>
                                    </tr>

                              <?php } ?>

                            </tbody>

                          </table>

                            <?php } ?>

                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->


              </div>
          </div>
          </section>
          </div>
    </div>
    <!-- ./wrapper -->

        <?php } elseif ($_SESSION['type'] == "Nurse") {
    header("Location: ../../index.php");
  } ?>

    <!-- DataTables -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

    <!-- page script -->
    <script>

        $(document).ready(function() {

        $('[data-toggle="tooltip"]').tooltip();
        $('#healthServiceButton').tooltip({
            placement: 'top',
            trigger: 'hover'
        });
        $('#healthServiceButton').dropdown();
        });

      $(function () {
        $('#example').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": false,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });
      });

      $(function () {
        $('#example1').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": false,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });
      });

      $(function () {
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": false,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });
      });

      $(function () {
        $('#example3').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": false,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });
      });
    </script>

<?php } ?>

</body>

</html>