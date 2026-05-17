<?php
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