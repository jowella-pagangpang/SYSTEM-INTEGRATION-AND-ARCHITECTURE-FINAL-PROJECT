<?php
function fetch_data()  
{  
    $output = '';   

    $con = mysqli_connect("localhost", "root", "", "healthrecord");  
    $sql = "SELECT id, deworming_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
            DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
            CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, sex, mother_name, 
            CONCAT(purok, ', ', address) AS caddress, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
            DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks, remarks_1stdose, 
            remarks_2nddose FROM deworming INNER JOIN client ON deworming.patientid = client.id 
            AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 1 AND 4 WHERE 1stdose IS NULL OR 2nddose IS NULL";  

        $userQuery = mysqli_query($con, "SELECT user_id, username, password, CONCAT(fname, ' ', lname) AS fullname from users WHERE type = 'bhw'");
        $user = mysqli_fetch_assoc($userQuery);
        $preparedByName = $user['fullname'];

        $result = mysqli_query($con, $sql);  
        if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_array($result))
    {       

      $firstdose = $row["1st_dose"];
      $seconddose = $row["2nd_dose"];

        if ($firstdose || $seconddose == '00-00-0000') {
            $status = "Follow-up";
        }
        
        $services = '';
        
        if ($firstdose == '00-00-0000') {
            $services .= "1st dose" . '<br>';
        }
        
        if ($seconddose == '00-00-0000') {
            $services .= "2nd dose" . '<br>';
        }
        
        // Remove the last newline character if it exists
        $services = rtrim($services);
        
        $output .= '<tr>   
                        <td>'.$row["fullname"].'</td>
                        <td>'.$row["regdate"].'</td>     
                        <td>'.$row["caddress"].'</td>
                        <td>'.$status.'</td> 
                        <td>'.$services.'</td> 
                        <td>'.nl2br($row['remarks']).'</td>  
                    </tr>';  
    }  
    $output .= '<br><p align="left"><strong>Prepared by:</strong> ' . $preparedByName . '</p>';

    return $output;
  }
}

function fetch_data1()  
{  
    $output = '';    

    $con = mysqli_connect("localhost", "root", "", "healthrecord");  
    $sql = "SELECT id, deworming_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
            DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
            CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, sex, mother_name, 
            CONCAT(purok, ', ', address) AS caddress, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
            DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks, remarks_1stdose, 
            remarks_2nddose FROM deworming INNER JOIN client ON deworming.patientid = client.id 
            AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 5 AND 9 WHERE 1stdose IS NULL OR 2nddose IS NULL";  

    $userQuery = mysqli_query($con, "SELECT user_id, username, password, CONCAT(fname, ' ', lname) AS fullname from users WHERE type = 'bhw'");
    $user = mysqli_fetch_assoc($userQuery);
    $preparedByName = $user['fullname'];

    $result = mysqli_query($con, $sql);  
    if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result))   
    {       

      $firstdose = $row["1st_dose"];
      $seconddose = $row["2nd_dose"];

        if ($firstdose || $seconddose == '00-00-0000') {
            $status = "Follow-up";
        }
        
        $services = '';
        
        if ($firstdose == '00-00-0000') {
            $services .= "1st dose" . '<br>';
        }
        
        if ($seconddose == '00-00-0000') {
            $services .= "2nd dose" . '<br>';
        }
        
        // Remove the last newline character if it exists
        $services = rtrim($services);
        
        $output .= '<tr>   
                        <td>'.$row["fullname"].'</td> 
                        <td>'.$row["regdate"].'</td>    
                        <td>'.$row["caddress"].'</td>
                        <td>'.$status.'</td> 
                        <td>'.$services.'</td> 
                        <td>'.nl2br($row['remarks']).'</td>  
                    </tr>';  
    }  
    $output .= '<br><p align="left"><strong>Prepared by:</strong> ' . $preparedByName . '</p>';

    return $output;
  }
}

function fetch_data2()  
{  
    $output = '';    

    $con = mysqli_connect("localhost", "root", "", "healthrecord");  
    $sql = "SELECT id, deworming_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
            DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
            CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, sex, mother_name, 
            CONCAT(purok, ', ', address) AS caddress, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
            DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks, remarks_1stdose, 
            remarks_2nddose FROM deworming INNER JOIN client ON deworming.patientid = client.id 
            AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 10 AND 19 WHERE 1stdose IS NULL OR 2nddose IS NULL";  

    $userQuery = mysqli_query($con, "SELECT user_id, username, password, CONCAT(fname, ' ', lname) AS fullname from users WHERE type = 'bhw'");
    $user = mysqli_fetch_assoc($userQuery);
    $preparedByName = $user['fullname'];

    $result = mysqli_query($con, $sql);  
    if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result))    
    {       
      
      $firstdose = $row["1st_dose"];
      $seconddose = $row["2nd_dose"];

        if ($firstdose || $seconddose == '00-00-0000') {
            $status = "Follow-up";
        }
        
        $services = '';
        
        if ($firstdose == '00-00-0000') {
            $services .= "1st dose" . '<br>';
        }
        
        if ($seconddose == '00-00-0000') {
            $services .= "2nd dose" . '<br>';
        }
        
        // Remove the last newline character if it exists
        $services = rtrim($services);
        
        $output .= '<tr>  
                        <td>'.$row["fullname"].'</td>   
                        <td>'.$row["regdate"].'</td>   
                        <td>'.$row["caddress"].'</td>
                        <td>'.$status.'</td> 
                        <td>'.$services.'</td> 
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
      $obj_pdf->SetTitle("TCL Deworming Follow-up Service");  
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
    <table border="1" cellspacing="0" cellpadding="3" style="width: 100%; text-align: center;">
        <tr style="font-weight: bold;">
        <th>Name</th>
        <th>Registration Date</th>
        <th>Address</th>
        <th>Status</th>
        <th>Deworming</th>
        <th>Remarks</th>
        </tr>';
    $content .= fetch_data();
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
        <th>Name</th>
        <th>Registration Date</th>
        <th>Address</th>
        <th>Status</th>
        <th>Deworming</th>
        <th>Remarks</th>
        </tr>';
    $content .= fetch_data1();
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
        <th>Name</th>
        <th>Registration Date</th>
        <th>Address</th>
        <th>Status</th>
        <th>Deworming</th>
        <th>Remarks</th>
        </tr>';
    $content .= fetch_data2();
    $content .= '</table>';
    $obj_pdf->writeHTML($content);

    $obj_pdf->Output('TCL-Deworming-Follow-up-Service.pdf', 'D');  
    exit;
}


function fetch_data3()  
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
    remarks_1week FROM postpartum INNER JOIN client ON postpartum.patientid = client.id 
    WHERE iron_supplementation_1stdate IS NULL OR iron_supplementation_2nddate IS NULL OR iron_supplementation_3rddate 
    IS NULL OR vitamin_supplementation_date IS NULL";  

    $userQuery = mysqli_query($con, "SELECT user_id, username, password, CONCAT(fname, ' ', lname) AS fullname from users WHERE type = 'bhw'");
    $user = mysqli_fetch_assoc($userQuery);
    $preparedByName = $user['fullname'];

    $result = mysqli_query($con, $sql);  
    if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result)) 
    {

        
$iron1stdate = $row["iron1stdate"];
$iron2nddate = $row["iron2nddate"];
$iron3rddate = $row["iron3rddate"];
$vitamindate = $row["vitamindate"];

  if ($iron1stdate || $iron2nddate || $iron3rddate || $vitamindate == '00-00-0000') {
    $status = "Follow-up";
  }

    $services = '';

    if ($iron1stdate == '00-00-0000') {
        $services .= "1st Iron Supplementation" . '<br>';
    }
    if ($iron2nddate == '00-00-0000') {
        $services .= "2nd Iron Supplementation" . '<br>';
    }
    if ($iron3rddate == '00-00-0000') {
        $services .= "3rd Iron Supplementation" . '<br>';
    }
    if ($vitamindate == '00-00-0000') {
        $services .= "Vitamin A Supplementation";
    }

    $services = rtrim($services);


      $output .= '<tr>  
            <td>'.$row["deliverydate"].'</td>  
            <td>'.$row["fullname"].'</td>    
            <td>'.$row["caddress"].'</td>
            <td>'.$status.'</td> 
            <td>'.$services.'</td> 
            <td>'.nl2br($row['remarks']).'</td>  
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
     $obj_pdf->SetTitle("TCL Postpartum Care Follow-up Service");  
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
       <th>Name</th>
       <th>Registration Date</th>
       <th>Address</th>
       <th>Status</th>
       <th>Micronutrient Supplementation</th>
       <th>Remarks</th>
     </tr>
';
$content .= fetch_data3();
$content .= '</table>';

     $obj_pdf->writeHTML($content);  
     $obj_pdf->Output('TCL-Postpartum-Care-Follow-up-Service.pdf', 'D');  
     exit;
}


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


        if ($tri1 == '00-00-0000' || $tri1a == '00-00-0000' || $tri2 == '00-00-0000' || 
          $tri2a == '00-00-0000' || $tri3 == '00-00-0000' || $tri3a == '00-00-0000') {
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
        
            $remarksCell = ($row["remarks"]);


        $output .= '<tr>     
        <td>'.$row["fullname"].'</td>
        <td>'.$row["regdate"].'</td>     
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
    mmr1stdose IS NULL OR mmr2nddose IS NULL";  

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


        if (
            $bcgdate || $hepabdate || $dpt_hib_hepb1 || $dpt_hib_hepb2 || $dpt_hib_hepb3 ||
            $opv1 || $opv2 || $opv3 || $pcv1 || $pcv2 || $pcv3 || $ipvdate || $mmr1 || $mmr2 == '00-00-0000'
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

    $service = '';

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
        <td>'.$row["fullname"].'</td> 
        <td>'.$row["regdate"].'</td>     
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


<!DOCTYPE html>
<html lang="en">

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../dbcon.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $service = $_POST['service'];

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
if ($service == "maternal") {
    $title = "MATERNAL CARE";
}
if ($service == "postpartum") {
    $title = "POSTPARTUM CARE";
}

session_start();
if (!isset($_SESSION['type'])) {
    header("Location: ../../index.php");
} else {
    ob_start();
    ?>
  
          <head>
            <?php
            include('../headsidecss.php');
            ?>

            <!-- DataTables -->
            <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
            <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

            <title>Report</title>
            <link rel="icon" href="../../img/logo.png">

            <style>
            #example thead th,
            #example td {
              vertical-align: middle;
            }
            #example1 thead th,
            #example1 td {
              vertical-align: middle;
            }
            #example2 thead th,
            #example2 td {
              vertical-align: middle;
            }
            
        </style>

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
                <ul class="nav nav-pills nav-sidebar flex-column text-sm" data-widget="treeview" role="menu"
                  data-accordion="false">
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
            <a href="../main/report.php" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Custom Report</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../main/client.php" class="nav-link active">
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
                            <h4 class="font-weight-bold" style="font-family: Helvetica;">REPORT</h4>
                          </div>
                          <div class="col-2">
                          </div>
                          <div class="col-1">
                            <div class="form-group">
                              <a href="client.php" class="btn btn-dark bg-gradient-dark btn-block">Back</a>
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
                            <div class="row align-items-center">
                              <div class="col-10">
                                <h6 class="font-weight-bold">FOR FOLLOW-UP HEALTH SERVICE:
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
                              <a class="dropdown-item" href="dewormreport.php" style="font-size: 1.1em;">Excel Report</a>
                              <a class="dropdown-item" href="#" onclick="generatePDF('<?php echo $service; ?>')" style="font-size: 1.1em;">PDF Report</a>
                        </div>

                        <script>
                            function generatePDF(service) {
                                // Trigger the form submission to generate the PDF
                                document.getElementById("pdfForm_" + service).submit();
                            }
                        </script>

                        <!-- Hidden form for triggering PDF generation -->
                          <form id="pdfForm_<?php echo $service; ?>" method="post" style="display: none;">
                              <input type="hidden" name="generate_pdf" value="1" />
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
                          <a class="dropdown-item" href="immureport.php" style="font-size: 1.1em;">Excel Report</a>
                          <a class="dropdown-item" href="#" onclick="generatePDF3('<?php echo $service; ?>')" style="font-size: 1.1em;">PDF Report</a>
                        </div>

                        <script>
                            function generatePDF3(service) {
                                // Trigger the form submission to generate the PDF
                                document.getElementById("pdfForm3_" + service).submit();
                            }
                        </script>

                        <!-- Hidden form for triggering PDF generation -->
                          <form id="pdfForm3_<?php echo $service; ?>" method="post" style="display: none;">
                              <input type="hidden" name="generate_pdf3" value="1" />
                          </form>

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
                          <a class="dropdown-item" href="nutri2report.php" style="font-size: 1.1em;">Excel Report</a>
                          <a class="dropdown-item" href="#" onclick="generatePDF4('<?php echo $service; ?>')" style="font-size: 1.1em;">PDF Report</a>
                        </div>

                        <script>
                            function generatePDF4(service) {
                                // Trigger the form submission to generate the PDF
                                document.getElementById("pdfForm4_" + service).submit();
                            }
                        </script>

                        <!-- Hidden form for triggering PDF generation -->
                          <form id="pdfForm4_<?php echo $service; ?>" method="post" style="display: none;">
                              <input type="hidden" name="generate_pdf4" value="1" />
                          </form>

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
                          <a class="dropdown-item" href="maternalreport.php" style="font-size: 1.1em;">Excel Report</a>
                          <a class="dropdown-item" href="#" onclick="generatePDF2('<?php echo $service; ?>')" style="font-size: 1.1em;">PDF Report</a>
                        </div>

                        <script>
                            function generatePDF2(service) {
                                // Trigger the form submission to generate the PDF
                                document.getElementById("pdfForm2_" + service).submit();
                            }
                        </script>

                        <!-- Hidden form for triggering PDF generation -->
                          <form id="pdfForm2_<?php echo $service; ?>" method="post" style="display: none;">
                              <input type="hidden" name="generate_pdf2" value="1" />
                          </form>

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
                          <a class="dropdown-item" href="postpartumreport.php" style="font-size: 1.1em;">Excel Report</a>
                          <a class="dropdown-item" href="#" onclick="generatePDF1('<?php echo $service; ?>')" style="font-size: 1.1em;">PDF Report</a>
                        </div>

                        <script>
                            function generatePDF1(service) {
                                // Trigger the form submission to generate the PDF
                                document.getElementById("pdfForm1_" + service).submit();
                            }
                        </script>

                        <!-- Hidden form for triggering PDF generation -->
                          <form id="pdfForm1_<?php echo $service; ?>" method="post" style="display: none;">
                              <input type="hidden" name="generate_pdf1" value="1" />
                          </form>


                    </div>
                  </div>
            <?php } ?>

            </div>
                     

              
              <?php
              if ($service == "deworming") { ?>

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
              
                  <?php
                  $deworming1st = mysqli_query($con, "SELECT deworming_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
      CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, 
      purok, address, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
      DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks 
      FROM $service INNER JOIN client ON deworming.patientid = client.id 
      AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 1 AND 4 WHERE 1stdose IS NULL OR 2nddose IS NULL"); ?>

                  <br> 
                  <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-one-1-4" role="tabpanel" aria-labelledby="custom-tabs-one-1-4-tab">             
                  <h5 class="font-weight-bold" style="font-size: 1.1em;">DEWORMING SERVICES FOR 1-4 YEARS OLD
                  </h5>

                                            <table id="example" class="table table-bordered table-hover text-center">
                                              <thead>
                                    <tr>
                                      <th>Name</th>
                                      <th>Registration Date</th>
                                      <th>Status</th>
                                      <th>Deworming</th>
                                      <th>Remarks</th>
                                      <th></th>
                                    </tr>
                                  </thead>
                                  <tbody>

                  <?php
                  while ($data = mysqli_fetch_array($deworming1st)) { ?>

                              <tr>
                                <td>
                                  <?php echo $data['fullname']; ?>
                                </td>
                                <td>
                                  <?php echo $data['regdate']; ?>
                                </td>
                                <td>
                                  <?php if ($data['1st_dose'] || $data['2nd_dose'] == '00-00-0000') {
                                      echo '<span class="badge badge-warning">Follow-up</span>';
                                  } ?>
                                </td>
                                <td>
                                  <?php if ($data['1st_dose'] == '00-00-0000') {
                                      echo '1st dose<br>  ';
                                  }
                                  if ($data['2nd_dose'] == '00-00-0000') {
                                      echo '2nd dose<br> ';
                                  }
                                  ?>
                                </td>
                                <td>
                                  <?php echo nl2br($data['remarks']); ?>
                                </td>
                                <td>
                                  <a href="../client/deworming-record.php?id=<?php echo $data['patientid']; ?>">
                                    <button type="button" class="btn btn-primary btn-sm">
                                      <i class="nav-icon fas fa-eye"></i> </button>
                                  </a>
                                </td>
                              </tr>

                        <?php } ?>
                      </tbody>
                    </table>
                                </div>
           
                    <div class="tab-pane fade" id="custom-tabs-one-5-9" role="tabpanel" aria-labelledby="custom-tabs-one-5-9-tab">
                    <h5 class="font-weight-bold" style="font-size: 1.1em;">DEWORMING SERVICES FOR 5-9 YEARS OLD
                            </h5>

                        <?php
                        $deworming2nd = mysqli_query($con, "SELECT deworming_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
            DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
            CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, sex, mother_name, 
            purok, address, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
            DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks 
            FROM $service INNER JOIN client ON deworming.patientid = client.id 
            AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 5 AND 9 WHERE 1stdose IS NULL OR 2nddose IS NULL"); ?>

                  <table id="example1" class="table table-bordered table-hover text-center">
                    <thead>
                        <tr>
                          <th>Name</th>
                          <th>Registration Date</th>
                          <th>Status</th>
                          <th>Deworming</th>
                          <th>Remarks</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php
                        while ($data = mysqli_fetch_array($deworming2nd)) { ?>

                              <tr>
                                <td>
                                  <?php echo $data['fullname']; ?>
                                </td>
                                <td>
                                  <?php echo $data['regdate']; ?>
                                </td>
                                <td>
                                  <?php if ($data['1st_dose'] || $data['2nd_dose'] == '00-00-0000') {
                                      echo '<span class="badge badge-warning">Follow-up</span>';
                                  } ?>
                                </td>
                                <td>
                                  <?php if ($data['1st_dose'] == '00-00-0000') {
                                      echo '1st dose<br>  ';
                                  }
                                  if ($data['2nd_dose'] == '00-00-0000') {
                                      echo '2nd dose<br> ';
                                  }
                                  ?>
                                </td>
                                <td>
                                  <?php echo nl2br($data['remarks']); ?>
                                </td>
                                <td>
                                  <a href="../client/deworming-record.php?id=<?php echo $data['patientid']; ?>">
                                    <button type="button" class="btn btn-primary btn-sm">
                                      <i class="nav-icon fas fa-eye"></i> </button>
                                  </a>
                                </td>
                              </tr>

                        <?php } ?>
                      </tbody>
                    </table>
                                </div>

                    <div class="tab-pane fade" id="custom-tabs-one-10-19" role="tabpanel" aria-labelledby="custom-tabs-one-10-19-tab">
                  <h5 class="font-weight-bold" style="font-size: 1.1em;">DEWORMING SERVICES FOR 10-19 YEARS OLD
                  </h5>

                 <?php

                 $deworming3rd = mysqli_query($con, "SELECT deworming_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
      DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
      CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, sex, mother_name, 
      purok, address, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
      DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks 
      FROM $service INNER JOIN client ON deworming.patientid = client.id 
      AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 10 AND 19 WHERE 1stdose IS NULL OR 2nddose IS NULL"); ?>


                                            <table id="example2" class="table table-bordered table-hover text-center">
                                              <thead>
                        <tr>
                          <th>Name</th>
                          <th>Registration Date</th>
                          <th>Status</th>
                          <th>Deworming</th>
                          <th>Remarks</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
            <?php
            while ($data = mysqli_fetch_array($deworming3rd)) { ?>

                        <tr>
                          <td>
                            <?php echo $data['fullname']; ?>
                          </td>
                          <td>
                            <?php echo $data['regdate']; ?>
                          </td>
                          <td>
                            <?php if ($data['1st_dose'] || $data['2nd_dose'] == '00-00-0000') {
                                echo '<span class="badge badge-warning">Follow-up</span>';
                            } ?>
                          </td>
                          <td>
                            <?php if ($data['1st_dose'] == '00-00-0000') {
                                echo '1st dose<br>  ';
                            }
                            if ($data['2nd_dose'] == '00-00-0000') {
                                echo '2nd dose<br> ';
                            }
                            ?>
                          </td>
                          <td>
                            <?php echo nl2br($data['remarks']); ?>
                          </td>
                          <td>
                                  <a href="../client/deworming-record.php?id=<?php echo $data['patientid']; ?>">
                                    <button type="button" class="btn btn-primary btn-sm">
                                      <i class="nav-icon fas fa-eye"></i> </button>
                                  </a>
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
                $immunization = mysqli_query($con, "SELECT immunization_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
            DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, purok, address,
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
            mmr1stdose IS NULL OR mmr2nddose IS NULL"); ?>



                    <table id="example" class="table table-bordered table-hover text-center">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Registration Date</th>
                          <th>Status</th>
                          <th>Immunization</th>
                          <th>Remarks</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>

                  <?php
                  while ($data = mysqli_fetch_array($immunization)) { ?>

                              <tr>
                                <td>
                                  <?php echo $data['fullname']; ?>
                                </td>
                                <td>
                                  <?php echo $data['regdate']; ?>
                                </td>
                                <td>
                                  <?php if (
                                      $data['bcgdate'] || $data['hepabdate'] || $data['dpt_hib_hepb1']
                                      || $data['dpt_hib_hepb2'] || $data['dpt_hib_hepb3'] || $data['opv1']
                                      || $data['opv2'] || $data['opv3'] || $data['pcv1']
                                      || $data['pcv2'] || $data['pcv3'] || $data['ipvdate']
                                      || $data['mmr1'] || $data['mmr2'] == '00-00-0000'
                                  ) {
                                      echo '<span class="badge badge-warning">Follow-up</span>';
                                  } ?>
                                </td>
                                <td>
                                  <?php if ($data['bcgdate'] == '00-00-0000') {
                                      echo 'BCG<br>  ';
                                  }
                                  if ($data['hepabdate'] == '00-00-0000') {
                                      echo 'Hepa B-BD<br>  ';
                                  }
                                  if ($data['dpt_hib_hepb1'] == '00-00-0000') {
                                      echo 'DPT-HIB-HepB 1st dose<br> ';
                                  }
                                  if ($data['dpt_hib_hepb2'] == '00-00-0000') {
                                      echo 'DPT-HIB-HepB 2nd dose<br> ';
                                  }
                                  if ($data['dpt_hib_hepb3'] == '00-00-0000') {
                                      echo 'DPT-HIB-HepB 3rd dose<br> ';
                                  }
                                  if ($data['opv1'] == '00-00-0000') {
                                      echo 'OPV 1st dose<br> ';
                                  }
                                  if ($data['opv2'] == '00-00-0000') {
                                      echo 'OPV 2nd dose<br> ';
                                  }
                                  if ($data['opv3'] == '00-00-0000') {
                                      echo 'OPV 3rd dose<br> ';
                                  }
                                  if ($data['pcv1'] == '00-00-0000') {
                                      echo 'PCV 1st dose<br> ';
                                  }
                                  if ($data['pcv2'] == '00-00-0000') {
                                      echo 'PCV 2nd dose<br> ';
                                  }
                                  if ($data['pcv3'] == '00-00-0000') {
                                      echo 'PCV 3rd dose<br> ';
                                  }
                                  if ($data['ipvdate'] == '00-00-0000') {
                                      echo 'IPV<br> ';
                                  }
                                  if ($data['mmr1'] == '00-00-0000') {
                                      echo 'MMR dose 1<br> ';
                                  }
                                  if ($data['mmr2'] == '00-00-0000') {
                                      echo 'MMR dose 2<br> ';
                                  }
                                  ?>
                                </td>
                                <td>
                                  <?php 
                                  if ($data['bcgdate'] == '00-00-0000') {
                                      echo $data['remarks'] . '<br>';
                                  }
                                  if ($data['hepabdate'] == '00-00-0000') {
                                      echo $data['remarks1']  . '<br>';
                                  }
                                  if ($data['dpt_hib_hepb1'] || $data['dpt_hib_hepb2'] || $data['dpt_hib_hepb3'] == '00-00-0000') {
                                      echo $data['remarks2']  . '<br>';
                                  }
                                  if ($data['opv1'] || $data['opv2'] || $data['opv3'] == '00-00-0000') {
                                      echo $data['remarks3']  . '<br>';
                                  }
                                  if ($data['pcv1'] || $data['pcv2'] || $data['pcv3'] == '00-00-0000') {
                                      echo $data['remarks4']  . '<br>';
                                  }
                                  if ($data['ipvdate'] == '00-00-0000') {
                                      echo $data['remarks5']  . '<br>';
                                  }
                                  if ($data['mmr1'] || $data['mmr2'] == '00-00-0000') {
                                      echo $data['remarks6']  . '<br>';
                                  } ?>
                                </td>
                                <td>
                                  <a href="../client/immunization-record.php?id=<?php echo $data['patientid']; ?>">
                                    <button type="button" class="btn btn-primary btn-sm">
                                      <i class="nav-icon fas fa-eye"></i> </button>
                                  </a>
                                </td>
                              </tr>

                        <?php } ?>
                      </tbody>
                    </table>
                    <br>
            <?php } ?>


            <?php
            if ($service == "nutrition2") {
                $nutrition2 = mysqli_query($con, "SELECT nutrition2_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
      DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, 
      6to11mos, 12to59mos, purok, address, 
      DATE_FORMAT(vitamina,'%m-%d-%Y') AS vitamin, DATE_FORMAT(vitamin1,'%m-%d-%Y') AS vitamindose1, DATE_FORMAT(vitamin2,'%m-%d-%Y') AS vitamindose2, 
      DATE_FORMAT(iron1,'%m-%d-%Y') AS irondose1, DATE_FORMAT(iron2,'%m-%d-%Y') AS irondose2, 
      DATE_FORMAT(mnp1,'%m-%d-%Y') AS mnpdose1, DATE_FORMAT(mnp2,'%m-%d-%Y') AS mnpdose2, 
      DATE_FORMAT(deworming,'%m-%d-%Y') AS dewormings, remarks, remarks1 FROM nutrition2
      INNER JOIN client ON nutrition2.patientid = client.id
      WHERE vitamina IS NULL OR vitamin1 IS NULL OR vitamin2 IS NULL OR iron1 IS NULL OR iron2 IS NULL OR mnp1 IS NULL
      OR mnp2 IS NULL OR deworming IS NULL"); ?>


                        <table id="example" class="table table-bordered table-hover text-center" cellspacing="0"
                                                width="100%">
                                                <thead>
                        <tr>
                          <th>Name</th>
                          <th>Registration Date</th>
                          <th>Status</th>
                          <th>Micronutrient Supplementation</th>
                          <th>Remarks</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php
                        while ($data = mysqli_fetch_array($nutrition2)) {

                            $status = "";
                            $service = "";

                            if ($data['6to11mos'] && $data['vitamin'] == '00-00-0000') {
                                $status = '<span class="badge badge-warning">Follow-up</span>';
                                $service .= 'Vitamin A Supplementation (6-11 mos)<br>  ';
                            }
                            if ($data['6to11mos'] && $data['irondose1'] == '00-00-0000') {
                                $status = '<span class="badge badge-warning">Follow-up</span>';
                                $service .= 'Iron Supplementation (6-11 mos)<br>  ';
                            }
                            if ($data['6to11mos'] && $data['mnpdose1'] == '00-00-0000') {
                                $status = '<span class="badge badge-warning">Follow-up</span>';
                                $service .= 'MNP Supplementation (6-11 mos)<br>  ';
                            }

                            if ($data['12to59mos'] && $data['vitamindose1'] == '00-00-0000') {
                                $status = '<span class="badge badge-warning">Follow-up</span>';
                                $service .= 'Vitamin A Supplementation Dose 1 (12-59 mos)<br>  ';
                            }
                            if ($data['12to59mos'] && $data['vitamindose2'] == '00-00-0000') {
                                $status = '<span class="badge badge-warning">Follow-up</span>';
                                $service .= 'Vitamin A Supplementation Dose 2 (12-59 mos)<br>  ';
                            }
                            if ($data['12to59mos'] && $data['irondose2'] == '00-00-0000') {
                                $status = '<span class="badge badge-warning">Follow-up</span>';
                                $service .= 'Iron Supplementation (12-59 mos)<br>  ';
                            }
                            if ($data['12to59mos'] && $data['mnpdose2'] == '00-00-0000') {
                                $status = '<span class="badge badge-warning">Follow-up</span>';
                                $service .= 'MNP Supplementation (12-59 mos)<br>  ';
                            }
                            if ($data['12to59mos'] && $data['dewormings'] == '00-00-0000') {
                                $status = '<span class="badge badge-warning">Follow-up</span>';
                                $service .= 'Deworming (12-59 mos)<br>  ';
                            }
                            ?>

                            <?php
                            if (!empty($status) || !empty($service)) {
                                ?>

                                  <tr>
                                    <td>
                                      <?php echo $data['fullname']; ?>
                                    </td>
                                    <td>
                                      <?php echo $data['regdate']; ?>
                                    </td>
                            <!--        <td>
                  <?php
                      if ($data['6to11mos']) {
                          echo '6-11 mos.';
                      }
                      if ($data['12to59mos']) {
                          echo '12-59 mos.';
                      }
                      ?>
                </td> -->
                                    <td>
                                      <?php echo $status; ?>
                                    </td>
                                    <td>
                                      <?php echo $service; ?>
                                    </td>
                                    <td>
                                      <?php
                                          if ($data['vitamin'] || $data['irondose1'] 
                                          || $data['mnpdose1'] == '00-00-0000') {
                                            echo nl2br($data['remarks1']);
                                          } if ($data['vitamindose1'] || $data['vitamindose2'] 
                                          || $data['irondose2'] || $data['mnpdose2'] || $data['dewormings'] == '00-00-0000') {
                                            echo nl2br($data['remarks']);
                                          }
                                          ?>
                                    </td>
                                    <td>
                                  <a href="../client/nutrition2-record.php?id=<?php echo $data['patientid']; ?>">
                                    <button type="button" class="btn btn-primary btn-sm">
                                      <i class="nav-icon fas fa-eye"></i> </button>
                                  </a>
                                    </td>
                                  </tr>

                            <?php }
                        } ?>
                      </tbody>
                    </table>
                    <br>
            <?php } ?>


      <?php
            if ($service == "maternal") {
                $maternal = mysqli_query($con, "SELECT maternal_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
      CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, purok, address, 
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
    )"); ?>


                                            <table id="example" class="table table-bordered table-hover text-center" cellspacing="0"
                                              width="100%">
                                              <thead>
                        <tr>
                          <th>Name</th>
                          <th>Registration Date</th>
                          <th>Status</th>
                          <th>Prenatal Visit</th>
                          <th>Remarks</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php
                        while ($data = mysqli_fetch_array($maternal)) { ?>

                              <tr>
                                <td>
                                  <?php echo $data['fullname']; ?>
                                </td>
                                <td>
                                  <?php echo $data['regdate']; ?>
                                </td>
                                <td>
                                <?php 
                                  if (
                                    $data['tri1'] == '00-00-0000' || $data['tri1a'] == '00-00-0000' ||
                                    $data['tri2'] == '00-00-0000' || $data['tri2a'] == '00-00-0000' ||
                                    $data['tri3'] == '00-00-0000' || $data['tri3a'] == '00-00-0000'
                                  ) {
                                    echo '<span class="badge badge-warning">Follow-up</span>';
                                  }
                                  ?>

                                </td>
                                <td>
                                  <?php if ($data['tri1'] == '00-00-0000' && $data['tri1a'] == '00-00-0000') {
                                      echo 'First Trimester<br>  ';
                                  }
                                  if ($data['tri2'] == '00-00-0000' && $data['tri2a'] == '00-00-0000') {
                                      echo 'Second Trimester<br>  ';
                                  }
                                  if ($data['tri3'] == '00-00-0000' && $data['tri3a'] == '00-00-0000') {
                                      echo 'Third Trimester<br>  ';
                                  } ?>
                                </td>
                                <td>
                                <?php 
                                  $remarks = array();
                                  if ($data['tri1'] == '00-00-0000' && $data['rem_tri1']) {
                                      $remarks[] = $data['rem_tri1'];
                                  }
                                  if ($data['tri1a'] == '00-00-0000' && $data['rem_tri1a']) {
                                      $remarks[] = $data['rem_tri1a'];
                                  }
                                  if ($data['tri2'] == '00-00-0000' && $data['rem_tri2']) {
                                      $remarks[] = $data['rem_tri2'];
                                  }
                                  if ($data['tri2a'] == '00-00-0000' && $data['rem_tri2a']) {
                                      $remarks[] = $data['rem_tri2a'];
                                  }
                                  if ($data['tri3'] == '00-00-0000' && $data['rem_tri3']) {
                                      $remarks[] = $data['rem_tri3'];
                                  }
                                  if ($data['tri3a'] == '00-00-0000' && $data['rem_tri3a']) {
                                      $remarks[] = $data['rem_tri3a'];
                                  }
                                  
                                  echo implode('<br>', $remarks);
                                  ?>
                                </td>
                                <td>
                                  <a href="../client/maternal-record.php?id=<?php echo $data['patientid']; ?>">
                                    <button type="button" class="btn btn-primary btn-sm">
                                      <i class="nav-icon fas fa-eye"></i> </button>
                                  </a>
                                </td>
                              </tr>

                        <?php } ?>
                      </tbody>
                    </table>
                    <br>
            <?php } ?>



            <?php
            if ($service == "postpartum") {
                $postpartum = mysqli_query($con, "SELECT postpartum_id, patientid, DATE_FORMAT(delivery_date,'%m-%d-%Y') AS deliverydate, delivery_time, 
      CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, purok, address, 
      DATE_FORMAT(date_visit_24hr,'%m-%d-%Y') AS visit24hr, DATE_FORMAT(date_visit_1week,'%m-%d-%Y') AS visit1week, 
      DATE_FORMAT(date_breastfeed,'%m-%d-%Y') AS datebreastfeed, time_breastfeed, 
      DATE_FORMAT(iron_supplementation_1stdate,'%m-%d-%Y') AS iron1stdate, 1stdate_tablets, 
      DATE_FORMAT(iron_supplementation_2nddate,'%m-%d-%Y') AS iron2nddate, 2nddate_tablets, 
      DATE_FORMAT(iron_supplementation_3rddate,'%m-%d-%Y') AS iron3rddate, 3rddate_tablets, 
      DATE_FORMAT(vitamin_supplementation_date,'%m-%d-%Y') AS vitamindate, remarks FROM postpartum 
      INNER JOIN client ON postpartum.patientid = client.id 
      WHERE iron_supplementation_1stdate IS NULL OR iron_supplementation_2nddate IS NULL OR iron_supplementation_3rddate
      IS NULL OR vitamin_supplementation_date IS NULL"); ?>

                                      <table id="example" class="table table-bordered table-hover text-center">
                                        <thead>
                        <tr>
                          <th>Name</th>
                          <th>Delivery Date</th>
                          <th>Status</th>
                          <th>Micronutrient Supplementation</th>
                          <th>Remarks</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php
                        while ($data = mysqli_fetch_array($postpartum)) { ?>

                              <tr>
                                <td>
                                  <?php echo $data['fullname']; ?>
                                </td>
                                <td>
                                  <?php echo $data['deliverydate']; ?>
                                </td>
                                <td>
                                  <?php if (
                                      $data['iron1stdate'] || $data['iron2nddate']
                                      || $data['iron3rddate'] || $data['vitamindate'] == '00-00-0000'
                                  ) {
                                      echo '<span class="badge badge-warning">Follow-up</span>';
                                  } ?>
                                </td>
                                <td>
                                  <?php if ($data['iron1stdate'] == '00-00-0000') {
                                      echo '1st Iron Supplementation<br> ';
                                  }
                                  if ($data['iron2nddate'] == '00-00-0000') {
                                      echo '2nd Iron Supplementation<br> ';
                                  }
                                  if ($data['iron3rddate'] == '00-00-0000') {
                                      echo '3rd Iron Supplementation<br> ';
                                  }
                                  if ($data['vitamindate'] == '00-00-0000') {
                                      echo 'Vitamin A Supplementation<br> ';
                                  }
                                  ?>
                                </td>
                                <td>
                                  <?php echo nl2br($data['remarks']); ?>
                                </td>
                                <td>
                                  <a href="../client/postpartum-record.php?id=<?php echo $data['patientid']; ?>">
                                    <button type="button" class="btn btn-primary btn-sm">
                                      <i class="nav-icon fas fa-eye"></i> </button>
                                  </a>
                                </td>
                              </tr>

                        <?php } ?>
                      </tbody>
                    </table>
                    <br>
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
              "ordering": true,
              "info": true,
              "autoWidth": false,
              "responsive": true,
              "language": {
                "emptyTable": "No follow-up health service"
            }
            });
          });

          $(function () {
            $('#example1').DataTable({
              "paging": true,
              "lengthChange": false,
              "searching": false,
              "ordering": true,
              "info": true,
              "autoWidth": false,
              "responsive": true,
              "language": {
                "emptyTable": "No follow-up health service"
            }
            });
          });

          $(function () {
            $('#example2').DataTable({
              "paging": true,
              "lengthChange": false,
              "searching": false,
              "ordering": true,
              "info": true,
              "autoWidth": false,
              "responsive": true,
              "language": {
                "emptyTable": "No follow-up health service"
            }
            });
          });

        </script>

<?php } ?>

</body>

</html>