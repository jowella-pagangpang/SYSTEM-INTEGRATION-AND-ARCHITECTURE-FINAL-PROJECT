<?php  


function fetch_data()  
{  
    $output = '';  

    $datenow = $_GET['date1'];
    $lastday = $_GET['date2'];
    $startdate = date("Y-m-d", strtotime($datenow));
    $enddate = date("Y-m-d", strtotime($lastday));

    $sql = "SELECT id, deworming_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
            DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
            CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, sex, mother_name, 
            CONCAT(purok, ', ', address) AS caddress, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
            DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks, remarks_1stdose, 
            remarks_2nddose FROM deworming INNER JOIN client ON deworming.patientid = client.id 
            AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 1 AND 4 WHERE reg_date between '$startdate' AND '$enddate' ORDER BY id ASC";  

    $userQuery = mysqli_query($con, "SELECT user_id, username, password, CONCAT(fname, ' ', lname) AS fullname from users WHERE type = 'bhw'");
    $user = mysqli_fetch_assoc($userQuery);
    $preparedByName = $user['fullname'];

    $result = mysqli_query($con, $sql);  
    if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result))  
    {       
        $birthdate = $row['birthdate'];
        $firstDose = $row['1st_dose'];
        $secondDose = $row['2nd_dose'];

        $output .= '<tr>  
                        <td>'.$row["regdate"].'</td>  
                        <td>'.$row["birthdate"].'</td>  
                        <td>'.$row["fullname"].'</td>  
                        <td>'.$row["sex"].'</td>  
                        <td>'.$row["mother_name"].'</td>  
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
                        <td>'.($firstDose != '00-00-0000' ? $row["1st_dose"] : '').'</td>  
                        <td>'.($secondDose != '00-00-0000' ? $row["2nd_dose"] : '').'</td>  
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

    $datenow = $_GET['date1'];
    $lastday = $_GET['date2'];
    $startdate = date("Y-m-d", strtotime($datenow));
    $enddate = date("Y-m-d", strtotime($lastday));

    $sql = "SELECT id, deworming_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
            DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
            CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, sex, mother_name, 
            CONCAT(purok, ', ', address) AS caddress, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
            DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks, remarks_1stdose, 
            remarks_2nddose FROM deworming INNER JOIN client ON deworming.patientid = client.id 
            AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 5 AND 9 WHERE reg_date between '$startdate' AND '$enddate' ORDER BY id ASC";  

    $userQuery = mysqli_query($con, "SELECT user_id, username, password, CONCAT(fname, ' ', lname) AS fullname from users WHERE type = 'bhw'");
    $user = mysqli_fetch_assoc($userQuery);
    $preparedByName = $user['fullname'];

    $result = mysqli_query($con, $sql);  
    if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result))  

    {       
        $birthdate = $row['birthdate'];
        $firstDose = $row['1st_dose'];
        $secondDose = $row['2nd_dose'];

        $output .= '<tr>  
                        <td>'.$row["regdate"].'</td>  
                        <td>'.$row["birthdate"].'</td>  
                        <td>'.$row["fullname"].'</td>  
                        <td>'.$row["sex"].'</td>  
                        <td>'.$row["mother_name"].'</td>  
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
                        <td>'.($firstDose != '00-00-0000' ? $row["1st_dose"] : '').'</td>  
                        <td>'.($secondDose != '00-00-0000' ? $row["2nd_dose"] : '').'</td>  
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

    $datenow = $_GET['date1'];
    $lastday = $_GET['date2'];
    $startdate = date("Y-m-d", strtotime($datenow));
    $enddate = date("Y-m-d", strtotime($lastday));

    $sql = "SELECT id, deworming_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
            DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
            CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, sex, mother_name, 
            CONCAT(purok, ', ', address) AS caddress, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
            DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks, remarks_1stdose, 
            remarks_2nddose FROM deworming INNER JOIN client ON deworming.patientid = client.id 
            AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 10 AND 19 WHERE reg_date between '$startdate' AND '$enddate' ORDER BY id ASC";  

    $userQuery = mysqli_query($con, "SELECT user_id, username, password, CONCAT(fname, ' ', lname) AS fullname from users WHERE type = 'bhw'");
    $user = mysqli_fetch_assoc($userQuery);
    $preparedByName = $user['fullname'];

    $result = mysqli_query($con, $sql);  
    if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result))  
    {       
        $birthdate = $row['birthdate'];
        $firstDose = $row['1st_dose'];
        $secondDose = $row['2nd_dose'];

        $output .= '<tr>  
                        <td>'.$row["regdate"].'</td>  
                        <td>'.$row["birthdate"].'</td>  
                        <td>'.$row["fullname"].'</td>  
                        <td>'.$row["sex"].'</td>  
                        <td>'.$row["mother_name"].'</td>  
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
                        <td>'.($firstDose != '00-00-0000' ? $row["1st_dose"] : '').'</td>  
                        <td>'.($secondDose != '00-00-0000' ? $row["2nd_dose"] : '').'</td>  
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
      $obj_pdf->SetTitle("TCL Deworming Services Report");  
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
            <th>Date of Registration</th>
            <th>Date of Birth</th>
            <th>Name of Child</th>
            <th width="5%">Sex</th>
            <th>Name of Mother</th>
            <th width="15%">Complete Address</th>
            <th>Age</th>
            <th>1st Dose (date given)</th>
            <th>2nd Dose (date given)</th>
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
            <th>Date of Registration</th>
            <th>Date of Birth</th>
            <th>Name of Child</th>
            <th width="5%">Sex</th>
            <th>Name of Mother</th>
            <th width="15%">Complete Address</th>
            <th>Age</th>
            <th>1st Dose (date given)</th>
            <th>2nd Dose (date given)</th>
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
            <th>Date of Registration</th>
            <th>Date of Birth</th>
            <th>Name of Child</th>
            <th width="5%">Sex</th>
            <th>Name of Mother</th>
            <th width="15%">Complete Address</th>
            <th>Age</th>
            <th>1st Dose (date given)</th>
            <th>2nd Dose (date given)</th>
            <th>Remarks</th>
        </tr>';
    $content .= fetch_data2();
    $content .= '</table>';
    $obj_pdf->writeHTML($content);

    $obj_pdf->Output('TCL-Deworming-Report.pdf', 'D');  
    exit;
}
?>