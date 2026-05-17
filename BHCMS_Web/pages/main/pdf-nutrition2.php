<?php  
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
    DATE_FORMAT(deworming,'%m-%d-%Y') AS dewormings, remarks FROM nutrition2 
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
        <td>'.nl2br($row['remarks']).'</td>  
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
?>