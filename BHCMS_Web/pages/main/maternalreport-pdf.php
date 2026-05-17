<?php
function fetch_data4()  
{  
    $output = '';  
    $con = mysqli_connect("localhost", "root", "", "healthrecord");  
    $sql = "SELECT id, maternal_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
    DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, CONCAT(purok, ', ', address) AS caddress, 
    DATE_FORMAT(lmp,'%m-%d-%Y') AS lmpdate, g, p, DATE_FORMAT(edc,'%m-%d-%Y') AS edcdate, 
    DATE_FORMAT(trimester1,'%m-%d-%Y') AS tri1, DATE_FORMAT(trimester1a,'%m-%d-%Y') AS tri1a, 
    DATE_FORMAT(trimester2,'%m-%d-%Y') AS tri2, DATE_FORMAT(trimester2a,'%m-%d-%Y') AS tri2a, 
    DATE_FORMAT(trimester3,'%m-%d-%Y') AS tri3, DATE_FORMAT(trimester3a,'%m-%d-%Y') AS tri3a, tetanus_status, DATE_FORMAT(tt1date,'%m-%d-%Y') AS tt1, DATE_FORMAT(tt2date,'%m-%d-%Y') AS tt2,
    DATE_FORMAT(tt3date,'%m-%d-%Y') AS tt3, DATE_FORMAT(tt4date,'%m-%d-%Y') AS tt4, DATE_FORMAT(tt5date,'%m-%d-%Y') AS tt5,
    DATE_FORMAT(iron1date,'%m-%d-%Y') AS iron1st, 1datenumber, DATE_FORMAT(iron2date,'%m-%d-%Y') AS iron2nd, 2datenumber,
    DATE_FORMAT(iron3date,'%m-%d-%Y') AS iron3rd, 3datenumber, DATE_FORMAT(iron4date,'%m-%d-%Y') AS iron4th, 4datenumber,
    DATE_FORMAT(iron5date,'%m-%d-%Y') AS iron5th, 5datenumber, DATE_FORMAT(iron6date,'%m-%d-%Y') AS iron6th, 6datenumber, DATE_FORMAT(sydate,'%m-%d-%Y') AS sy_date,
    syresult, DATE_FORMAT(syresult_date,'%m-%d-%Y') AS result_date, given_penicillin, 
    DATE_FORMAT(given_penicillin_date,'%m-%d-%Y') AS penicillin_date, remarks, rem_tri1, rem_tri1a, rem_tri2, rem_tri2a, rem_tri3, rem_tri3a FROM maternal 
    INNER JOIN client ON maternal.patientid = client.id 
    WHERE 
NOT (
    (trimester1 != '00-00-0000' OR trimester1a != '00-00-0000') AND 
    (trimester2 != '00-00-0000' OR trimester2a != '00-00-0000') AND 
    (trimester3 != '00-00-0000' OR trimester3a != '00-00-0000')
);";  

    $userQuery = mysqli_query($con, "SELECT user_id, username, password, CONCAT(fname, ' ', lname) AS fullname from users WHERE type = 'bhw'");
    $user = mysqli_fetch_assoc($userQuery);
    $preparedByName = $user['fullname'];

    $result = mysqli_query($con, $sql);  
    if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result))
    {       

        $tri1 = $row['tri1'];
        $rem_tri1 = $row['rem_tri1'];
        $tri1a = $row['tri1a'];
        $rem_tri1a = $row['rem_tri1a'];
        $tri2 = $row['tri2'];
        $rem_tri2 = $row['rem_tri2'];
        $tri2a = $row['tri2a'];
        $rem_tri2a = $row['rem_tri2a'];
        $tri3 = $row['tri3'];
        $rem_tri3 = $row['rem_tri3'];
        $tri3a = $row['tri3a'];
        $rem_tri3a = $row['rem_tri3a'];


        if (
            $tri1 || $tri1a || $tri2 || $tri2a || $tri3 || $tri3a == '00-00-0000'
          ) {
            $status = "Follow-up";
          }
        
            $trimesters = '';
        
            if ($tri1 == '00-00-0000' && $tri1a == '00-00-0000') {
                $trimesters .= 'First Trimester' . '<br>';
            }
        
            if ($tri2 == '00-00-0000' && $tri2a == '00-00-0000') {
                $trimesters .= 'Second Trimester' . '<br>';
            }
        
            if ($tri3 == '00-00-0000' && $tri3a == '00-00-0000') {
                $trimesters .= 'Third Trimester' . '<br>';
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
        
            $remarksCell = implode('<br>', $row["remarks"]);


        $output .= '<tr>    
        <td>'.$row["regdate"].'</td>  
        <td>'.$row["fullname"].'</td>    
        <td>'.$row["caddress"].'</td>
        <td>'.$status.'</td> 
        <td>'.$trimesters.'</td> 
        <td>'.$remarksCell.'</td>  
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
  $obj_pdf->SetTitle("TCL Maternal Care Follow-up Service");  
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
        <th>Name</th>
        <th>Registration Date</th>
        <th>Address</th>
        <th>Status</th>
        <th>Prenatal Visit</th>
        <th>Remarks</th>
        </tr>';

        $content .= fetch_data4();
        $content .= '</table>';
        $obj_pdf->writeHTML($content);

    $obj_pdf->Output('TCL-Maternal-Care-Follow-up-Service.pdf', 'D');  
    exit;
}
?>
