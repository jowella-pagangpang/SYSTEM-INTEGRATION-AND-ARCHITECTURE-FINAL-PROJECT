<?php  
function fetch_data6()  
{  
    $output = '';  
    $con = mysqli_connect("localhost", "root", "", "healthrecord");  

    $sql = "SELECT id, nutrition2_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
    DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, 
    weight, height, sex, 6to11mos, 12to59mos, mother_name, CONCAT(purok, ', ', address) AS caddress, 6to11mos, 12to59mos, 
    DATE_FORMAT(vitamina,'%m-%d-%Y') AS vitamin, 
    DATE_FORMAT(vitamin1,'%m-%d-%Y') AS vitamindose1, DATE_FORMAT(vitamin2,'%m-%d-%Y') AS vitamindose2, 
    DATE_FORMAT(iron1,'%m-%d-%Y') AS irondose1, DATE_FORMAT(iron2,'%m-%d-%Y') AS irondose2, 
    DATE_FORMAT(mnp1,'%m-%d-%Y') AS mnpdose1, DATE_FORMAT(mnp2,'%m-%d-%Y') AS mnpdose2, 
    DATE_FORMAT(deworming,'%m-%d-%Y') AS dewormings, remarks, remarks1 FROM nutrition2 
    INNER JOIN client ON nutrition2.patientid = client.id WHERE vitamina IS NULL OR vitamin1 IS NULL OR vitamin2 IS NULL 
    OR iron1 IS NULL OR iron2 IS NULL OR mnp1 IS NULL OR mnp2 IS NULL OR deworming IS NULL";  

    $userQuery = mysqli_query($con, "SELECT user_id, username, password, CONCAT(fname, ' ', lname) AS fullname from users WHERE type = 'bhw'");
    $user = mysqli_fetch_assoc($userQuery);
    $preparedByName = $user['fullname'];

    $result = mysqli_query($con, $sql);  
    if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result))
    {

        $age1 = $row['6to11mos'];
        $age2 = $row['12to59mos'];
        $vitamin = $row['vitamin'];
        $vitamindose1 = $row['vitamindose1'];
        $vitamindose2 = $row['vitamindose2'];
        $irondose1 = $row['irondose1'];
        $irondose2 = $row['irondose2'];
        $mnpdose1 = $row['mnpdose1'];
        $mnpdose2 = $row['mnpdose2'];
        $dewormings = $row['dewormings'];


    if ($row['6to11mos']) {
        $age = "6-11 mos.";
        if ($row['vitamin'] == '00-00-0000') {
            $status = "Follow-up";
            $service .= 'Vitamin A Supplementation (6-11 mos)' . "\n";
        }
        if ($row['irondose1'] == '00-00-0000') {
            $status = "Follow-up";
            $service .= 'Iron Supplementation (6-11 mos)' . "\n";
        }
        if ($row['mnpdose1'] == '00-00-0000') {
            $status = "Follow-up";
            $service .= 'MNP Supplementation (6-11 mos)' . "\n";
        }
    }

    if ($row['12to59mos']) {
        $age = "12-59 mos.";
        if ($row['vitamindose1'] == '00-00-0000') {
            $status = "Follow-up";
            $service .= 'Vitamin A Supplementation Dose 1 (12-59 mos)' . "\n";
        }
        if ($row['vitamindose2'] == '00-00-0000') {
            $status = "Follow-up";
            $service .= 'Vitamin A Supplementation Dose 2 (12-59 mos)' . "\n";
        }
        if ($row['irondose2'] == '00-00-0000') {
            $status = "Follow-up";
            $service .= 'Iron Supplementation (12-59 mos)' . "\n";
        }
        if ($row['mnpdose2'] == '00-00-0000') {
            $status = "Follow-up";
            $service .= 'MNP Supplementation (12-59 mos)' . "\n";
        }
        if ($row['dewormings'] == '00-00-0000') {
            $status = "Follow-up";
            $service .= 'Deworming (12-59 mos)' . "\n";
        }
    }

    $service = rtrim($service);

    $content = '';

    if ($row['vitamin'] || $row['irondose1'] || $row['mnpdose1'] == '00-00-0000') {
        $content .= nl2br($row['remarks1']);
    }

    if ($row['vitamindose1'] || $row['vitamindose2'] || $row['irondose2'] || $row['mnpdose2'] || $row['dewormings'] == '00-00-0000') {
        $content .= nl2br($row['remarks']);
    }

        $output .= '<tr>  
        <td>'.$row["regdate"].'</td>  
        <td>'.$row["fullname"].'</td>    
        <td>'.$row["caddress"].'</td>
        <td>'.$status.'</td> 
        <td>'.$service.'</td> 
        <td>'.$content.'</td>  
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
     $obj_pdf->SetTitle("TCL Nutrition Follow-up Service");  
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
        <th>Name</th>
        <th>Registration Date</th>
        <th>Address</th>
        <th>Status</th>
        <th>Micronutrient Supplementation</th>
        <th>Remarks</th>
        </tr>';
    $content .= fetch_data6();
    $content .= '</table>';
    $obj_pdf->writeHTML($content);

    $obj_pdf->Output('TCL-Nutrition-Follow-up-Service.pdf', 'D');  
    exit;
}
?>