<?php  
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
            <td align="left"><img src="../../img/logo.jpg" alt="Logo 1" style="height: 50px;"></td>
            <td align="center" style="font-weight: bold;"><h4>Republic of the Philippines
            <br>Province of Cavite
            <br>TAGAYTAY CITY
            <br>BARANGAY MAHARLIKA EAST</h4></td>
            <td align="right"><img src="../../img/seal.jpg" alt="Logo 2" style="height: 50px;"></td>
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
?>