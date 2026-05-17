<?php
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
        <td>'.(isset($row["tri1"]) && $row["tri1"] != '00-00-0000' ? $row["tri1"] : '').'</td>
        <td>'.(isset($row["tri2"]) && $row["tri2"] != '00-00-0000' ? $row["tri2"] : '').'</td>
        <td>'.(isset($row["tri3"]) && $row["tri3"] != '00-00-0000' ? $row["tri3"] : '').'</td>
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
            <td align="left"><img src="../../img/logo.jpg" alt="Logo 1" style="height: 50px;"></td>
            <td align="center" style="font-weight: bold;"><h4>Republic of the Philippines
            <br>Province of Cavite
            <br>TAGAYTAY CITY
            <br>BARANGAY MAHARLIKA EAST</h4></td>
            <td align="right"><img src="../../img/seal.jpg" alt="Logo 2" style="height: 50px;"></td>
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
        <td align="left"><img src="../../img/logo.jpg" alt="Logo 1" style="height: 50px;"></td>
        <td align="center" style="font-weight: bold;"><h4>Republic of the Philippines
        <br>Province of Cavite
        <br>TAGAYTAY CITY
        <br>BARANGAY MAHARLIKA EAST</h4></td>
        <td align="right"><img src="../../img/seal.jpg" alt="Logo 2" style="height: 50px;"></td>
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
        <td align="left"><img src="../../img/logo.jpg" alt="Logo 1" style="height: 50px;"></td>
        <td align="center" style="font-weight: bold;"><h4>Republic of the Philippines
        <br>Province of Cavite
        <br>TAGAYTAY CITY
        <br>BARANGAY MAHARLIKA EAST</h4></td>
        <td align="right"><img src="../../img/seal.jpg" alt="Logo 2" style="height: 50px;"></td>
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
?>
