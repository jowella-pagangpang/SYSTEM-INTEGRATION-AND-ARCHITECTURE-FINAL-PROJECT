<?php  
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
?>