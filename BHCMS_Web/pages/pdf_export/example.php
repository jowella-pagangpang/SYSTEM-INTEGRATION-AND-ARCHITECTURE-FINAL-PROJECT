<?php  
function fetch_data()  
{  
    $output = '';  
    $con = mysqli_connect("localhost", "root", "", "system_integration_db");  
    $sql = "SELECT id, deworming_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
            DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
            CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, sex, mother_name, 
            CONCAT(purok, ', ', address) AS caddress, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
            DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks, remarks_1stdose, 
            remarks_2nddose FROM deworming INNER JOIN client ON deworming.patientid = client.id 
            AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 1 AND 4 ORDER BY id ASC";  

    $result = mysqli_query($con, $sql);  
    while($row = mysqli_fetch_array($result))  
    {       
        $birthdate = $row['birthdate'];
        $firstDose = $row['1st_dose'];
        $secondDose = $row['2nd_dose'];

        // Rest of the row data
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
                        <td>'.$row["remarks"].'</td>  
                    </tr>';  
    }  
    return $output;
}

 if(isset($_POST["generate_pdf"]))  
 {  
      require_once('tcpdf/tcpdf.php');  
      $obj_pdf = new TCPDF('L', PDF_UNIT, 'LETTER', true, 'UTF-8', false);
      $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetTitle("PHP Report Genaration");  
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
        </tr>
';
$content .= fetch_data();
$content .= '</table>';

      $obj_pdf->writeHTML($content);  
      $obj_pdf->Output('example.pdf', 'I');  
 }  
 ?>  
 
 <!DOCTYPE html>  
 <html>  
      <head>        
        
        <?php
        include('../headsidecss.php');
        ?>

        <title>PDF Report</title> 
        <link rel="icon" href="../../img/logo.png">
        <link rel="stylesheet" href="styles.css">       
      
      <style>

        th {
            text-align: center;
        }
      </style>

        </head>  
      <body>  
           <br />
           <div class="container text-sm" style="font-family: Helvetica;">  
                <h4 align="center" style="font-weight: bold;"> TARGET CLIENT LIST FOR DEWORMING SERVICES FOR 1-4 YEARS OLD</h4><br />  
                <div class="table-responsive">  
                	<div class="col-md-12" align="right">
                     <form method="post">  
                          <input type="submit" name="generate_pdf" class="btn btn-success" value="Get PDF" />  
                     </form>  
                     </div>
                     <br/>
                     <br/>
                     <table class="table table-bordered text-center">  
                          <tr>  
                        <th>Date of Registration</th>
                        <th>Date of Birth</th>
                        <th>Name of Child</th>
                        <th>Sex</th>
                        <th>Name of Mother</th>
                        <th>Complete Address</th>
                        <th>Age</th>
                        <th>1st Dose (date given)</th>
                        <th>2nd Dose (date given)</th>
                        <th>Remarks</th>
                          </tr>  
                     <?php  
                     echo fetch_data();  
                     ?>  
                     </table>  
                </div>  
           </div>  
      </body>  
 </html>  
