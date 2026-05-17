<?php
function fetch_data5()  
{  
    $output = '';  
    $con = mysqli_connect("localhost", "root", "", "healthrecord");  
    $sql = "SELECT id, immunization_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
    DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, se_status, CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, 
    sex, mother_name, CONCAT(purok, ', ', address) AS caddress, cpab1, cpab2, 
    DATE_FORMAT(initiated_breastfeed,'%m-%d-%Y') AS breastfeed, DATE_FORMAT(bcg,'%m-%d-%Y') AS bcgdate,
    DATE_FORMAT(hepab,'%m-%d-%Y') AS hepabdate, DATE_FORMAT(dpt_hib_hepb_1stdose,'%m-%d-%Y') AS dpt_hib_hepb1, 
    DATE_FORMAT(dpt_hib_hepb_2nddose,'%m-%d-%Y') AS dpt_hib_hepb2, DATE_FORMAT(dpt_hib_hepb_3rddose,'%m-%d-%Y') AS dpt_hib_hepb3,
    DATE_FORMAT(opv_1stdose,'%m-%d-%Y') AS opv1, DATE_FORMAT(opv_2nddose,'%m-%d-%Y') AS opv2,
    DATE_FORMAT(opv_3rddose,'%m-%d-%Y') AS opv3, DATE_FORMAT(pcv_1stdose,'%m-%d-%Y') AS pcv1, DATE_FORMAT(pcv_2nddose,'%m-%d-%Y') AS pcv2,
    DATE_FORMAT(pcv_3rddose,'%m-%d-%Y') AS pcv3, DATE_FORMAT(ipv,'%m-%d-%Y') AS ipvdate, DATE_FORMAT(mmr1stdose,'%m-%d-%Y') AS mmr1, 
    DATE_FORMAT(mmr2nddose,'%m-%d-%Y') AS mmr2, DATE_FORMAT(fic_date,'%m-%d-%Y') AS fic,
    remarks, remarks1, remarks2, remarks3, remarks4, remarks5, remarks6, remarks7 
    FROM immunization INNER JOIN client ON immunization.patientid = client.id 
    WHERE bcg IS NULL OR hepab IS NULL OR dpt_hib_hepb_1stdose IS NULL OR
    dpt_hib_hepb_2nddose IS NULL OR dpt_hib_hepb_3rddose IS NULL OR opv_1stdose IS NULL OR opv_2nddose IS NULL OR
    opv_3rddose IS NULL OR pcv_1stdose IS NULL OR pcv_2nddose IS NULL OR pcv_3rddose IS NULL OR ipv IS NULL OR
    mmr1stdose IS NULL OR mmr2nddose IS NULL OR fic_date IS NULL";  

    $userQuery = mysqli_query($con, "SELECT user_id, username, password, CONCAT(fname, ' ', lname) AS fullname from users WHERE type = 'bhw'");
    $user = mysqli_fetch_assoc($userQuery);
    $preparedByName = $user['fullname'];

    $result = mysqli_query($con, $sql);  
    if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result))  
    {       

        $bcgdate = $row['bcgdate'];
        $hepabdate = $row['hepabdate'];
        $dpt_hib_hepb1 = $row['dpt_hib_hepb1'];
        $dpt_hib_hepb2 = $row['dpt_hib_hepb2'];
        $dpt_hib_hepb3 = $row['dpt_hib_hepb3'];
        $opv1 = $row['opv1'];
        $opv2 = $row['opv2'];
        $opv3 = $row['opv3'];
        $pcv1 = $row['pcv1'];
        $pcv2 = $row['pcv2'];
        $pcv3 = $row['pcv3'];
        $ipvdate = $row['ipvdate'];
        $mmr1 = $row['mmr1'];
        $mmr2 = $row['mmr2'];
        $fic = $row['fic'];


        if (
            $bcgdate || $hepabdate || $dpt_hib_hepb1 || $dpt_hib_hepb2 || $dpt_hib_hepb3 ||
            $opv1 || $opv2 || $opv3 || $pcv1 || $pcv2 || $pcv3 || $ipvdate || $mmr1 || $mmr2 || $fic == '00-00-0000'
          ) {
            $status = "Follow-up";
          }
        
            $services = '';
            $remarksData = '';
        
            // Service information
            if ($bcgdate == '00-00-0000') {
                $services .= "BCG" . '<br>';
            }
            if ($hepabdate == '00-00-0000') {
                $services .= "Hepa B-BD" . '<br>';
            }
            if ($dpt_hib_hepb1 == '00-00-0000') {
                $services .= "DPT-HIB-HepB 1st dose" . '<br>';
            }
            if ($dpt_hib_hepb2 == '00-00-0000') {
                $services .= "DPT-HIB-HepB 2nd dose" . '<br>';
            }
            if ($dpt_hib_hepb3 == '00-00-0000') {
                $services .= "DPT-HIB-HepB 3rd dose" . '<br>';
            }
            if ($opv1 == '00-00-0000') {
                $services .= "OPV 1st dose" . '<br>';
            }
            if ($opv2 == '00-00-0000') {
                $services .= "OPV 2nd dose" . '<br>';
            }
            if ($opv3 == '00-00-0000') {
                $services .= "OPV 3rd dose" . '<br>';
            }
            if ($pcv1 == '00-00-0000') {
                $services .= "PCV 1st dose" . '<br>';
            }
            if ($pcv2 == '00-00-0000') {
                $services .= "PCV 2nd dose" . '<br>';
            }
            if ($pcv3 == '00-00-0000') {
                $services .= "PCV 3rd dose" . '<br>';
            }
            if ($ipvdate == '00-00-0000') {
                $services .= "IPV" . '<br>';
            }
            if ($mmr1 == '00-00-0000') {
                $services .= "MMR dose 1" . '<br>';
            }
            if ($mmr2 == '00-00-0000') {
                $services .= "MMR dose 2" . '<br>';
            }
            if ($fic == '00-00-0000') {
                $services .= "FIC";
            }
        
            // Remarks information
            if ($bcgdate == '00-00-0000') {
                $remarksData .= strip_tags($row['remarks']) . '<br>';
            }
            if ($hepabdate == '00-00-0000') {
                $remarksData .= strip_tags($row['remarks1']) . '<br>';
            }
            if ($dpt_hib_hepb1 || $dpt_hib_hepb2 || $dpt_hib_hepb3 == '00-00-0000') {
                $remarksData .= strip_tags($row['remarks2']) . '<br>';
            }
            if ($opv1 || $opv2 || $opv3 == '00-00-0000') {
                $remarksData .= strip_tags($row['remarks3']) . '<br>';
            }
            if ($pcv1 || $pcv2 || $pcv3 == '00-00-0000') {
                $remarksData .= strip_tags($row['remarks4']) . '<br>';
            }
            if ($ipvdate == '00-00-0000') {
                $remarksData .= strip_tags($row['remarks5']) . '<br>';
            }
            if ($mmr1 || $mmr2 == '00-00-0000') {
                $remarksData .= strip_tags($row['remarks6']) . '<br>';
            }
        
            // Remove the last newline character if it exists
            $services = rtrim($services);
            $remarksData = rtrim($remarksData);
        
        $lineCount = substr_count($services, '<br>') + 1;
        
        $output .= '<tr>    
        <td>'.$row["fullname"].'</td>   
        <td>'.$row["regdate"].'</td>   
        <td>'.$row["caddress"].'</td>
        <td>'.$status.'</td> 
        <td>'.$services.'</td> 
        <td>'.$remarksData.'</td> 
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
  $obj_pdf->SetTitle("TCL Immunization Follow-up Service");  
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
        <th>Name</th>
        <th>Registration Date</th>
        <th>Address</th>
        <th>Status</th>
        <th>Immunization</th>
        <th>Remarks</th>
      </tr>';

        $content .= fetch_data5();
        $content .= '</table>';
        $obj_pdf->writeHTML($content);

    $obj_pdf->Output('TCL-Immunization-Follow-up-Service.pdf', 'D');  
    exit;
}
?>