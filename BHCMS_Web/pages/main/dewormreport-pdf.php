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
            $services .= "1st dose" . "\n";
        }
        
        if ($seconddose == '00-00-0000') {
            $services .= "2nd dose" . "\n";
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
            $services .= "1st dose" . "\n";
        }
        
        if ($seconddose == '00-00-0000') {
            $services .= "2nd dose" . "\n";
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
            $services .= "1st dose" . "\n";
        }
        
        if ($seconddose == '00-00-0000') {
            $services .= "2nd dose" . "\n";
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
            <td align="left"><img src="../../img/logo.jpg" alt="Logo 1" style="height: 50px;"></td>
            <td align="center" style="font-weight: bold;"><h4>Republic of the Philippines
            <br>Province of Cavite
            <br>TAGAYTAY CITY
            <br>BARANGAY MAHARLIKA EAST</h4></td>
            <td align="right"><img src="../../img/seal.jpg" alt="Logo 2" style="height: 50px;"></td>
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
            <td align="left"><img src="../../img/logo.jpg" alt="Logo 1" style="height: 50px;"></td>
            <td align="center" style="font-weight: bold;"><h4>Republic of the Philippines
            <br>Province of Cavite
            <br>TAGAYTAY CITY
            <br>BARANGAY MAHARLIKA EAST</h4></td>
            <td align="right"><img src="../../img/seal.jpg" alt="Logo 2" style="height: 50px;"></td>
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
            <td align="left"><img src="../../img/logo.jpg" alt="Logo 1" style="height: 50px;"></td>
            <td align="center" style="font-weight: bold;"><h4>Republic of the Philippines
            <br>Province of Cavite
            <br>TAGAYTAY CITY
            <br>BARANGAY MAHARLIKA EAST</h4></td>
            <td align="right"><img src="../../img/seal.jpg" alt="Logo 2" style="height: 50px;"></td>
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
?>