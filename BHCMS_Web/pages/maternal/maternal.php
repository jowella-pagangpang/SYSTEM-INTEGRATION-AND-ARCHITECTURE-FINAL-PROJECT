<?php
function fetch_data()  
{  
    $output = '';  
    $con = mysqli_connect("localhost", "root", "", "healthrecord");  
    $sql = "SELECT id, maternal_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
    DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, CONCAT(purok, ', ', address) AS caddress, 
    DATE_FORMAT(lmp,'%m-%d-%Y') AS lmpdate, g, p, DATE_FORMAT(edc,'%m-%d-%Y') AS edcdate, 
    DATE_FORMAT(trimester1,'%m-%d-%Y') AS tri1, DATE_FORMAT(trimester1a,'%m-%d-%Y') AS tri1a, 
    DATE_FORMAT(trimester2,'%m-%d-%Y') AS tri2, DATE_FORMAT(trimester2a,'%m-%d-%Y') AS tri2a, 
    DATE_FORMAT(trimester3,'%m-%d-%Y') AS tri3, DATE_FORMAT(trimester3a,'%m-%d-%Y') AS tri3a FROM maternal 
    INNER JOIN client ON maternal.patientid = client.id ORDER BY id ASC";  

    $result = mysqli_query($con, $sql);  
    while($row = mysqli_fetch_array($result))  
    {       

      $birthdate = $row['birthdate'];

        $output .= '<tr>    
        <td>'.$row["maternal_id"].'</td> 
        <td>'.$row["regdate"].'</td> 
        <td>'.$row["fullname"].'</td>   
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
        <td>' . (isset($row['lmpdate']) && $row['lmpdate'] > 0 ? $row['lmpdate'] . '<br>G' . $row['g'] . ' P' . $row['p'] : '') . '</td>
        <td>'.(isset($row["edcdate"]) && $row["edcdate"] != '00-00-0000' ? $row["edcdate"] : '').'</td>
        <td>' . (isset($row["tri1"]) && $row["tri1"] != '00-00-0000' ? $row["tri1"] . '<br>' 
        . (($row["tri1a"]) && $row["tri1a"] > 0 ? $row["tri1a"] : '') : '') . '</td>
        <td>' . (isset($row["tri2"]) && $row["tri2"] != '00-00-0000' ? $row["tri2"] . '<br>' 
        . (($row["tri2a"]) && $row["tri2a"] > 0 ? $row["tri2a"] : '') : '') . '</td>
        <td>' . (isset($row["tri3"]) && $row["tri3"] != '00-00-0000' ? $row["tri3"] . '<br>' 
        . (($row["tri3a"]) && $row["tri3a"] > 0 ? $row["tri3a"] : '') : '') . '</td>
        </tr>'; 
    }  
    return $output;
}

function fetch_data1()  
{  
    $output = '';  
    $con = mysqli_connect("localhost", "root", "", "healthrecord");  
    $sql = "SELECT id, maternal_id, patientid, tetanus_status, DATE_FORMAT(tt1date,'%m-%d-%Y') AS tt1, DATE_FORMAT(tt2date,'%m-%d-%Y') AS tt2,
    DATE_FORMAT(tt3date,'%m-%d-%Y') AS tt3, DATE_FORMAT(tt4date,'%m-%d-%Y') AS tt4, DATE_FORMAT(tt5date,'%m-%d-%Y') AS tt5,
    DATE_FORMAT(iron1date,'%m-%d-%Y') AS iron1st, 1datenumber, DATE_FORMAT(iron2date,'%m-%d-%Y') AS iron2nd, 2datenumber,
    DATE_FORMAT(iron3date,'%m-%d-%Y') AS iron3rd, 3datenumber, DATE_FORMAT(iron4date,'%m-%d-%Y') AS iron4th, 4datenumber,
    DATE_FORMAT(iron5date,'%m-%d-%Y') AS iron5th, 5datenumber, DATE_FORMAT(iron6date,'%m-%d-%Y') AS iron6th, 6datenumber FROM maternal 
    INNER JOIN client ON maternal.patientid = client.id ORDER BY id ASC";  

    $result = mysqli_query($con, $sql);  
    while($row = mysqli_fetch_array($result))  
    {       
        $output .= '<tr>   
        <td>'.$row["tetanus_status"].'</td>         
        <td>'.(isset($row["tt1"]) && $row["tt1"] != '00-00-0000' ? $row["tt1"] : '').'</td>
        <td>'.(isset($row["tt2"]) && $row["tt2"] != '00-00-0000' ? $row["tt2"] : '').'</td>
        <td>'.(isset($row["tt3"]) && $row["tt3"] != '00-00-0000' ? $row["tt3"] : '').'</td>
        <td>'.(isset($row["tt4"]) && $row["tt4"] != '00-00-0000' ? $row["tt4"] : '').'</td>
        <td>'.(isset($row["tt5"]) && $row["tt5"] != '00-00-0000' ? $row["tt5"] : '').'</td>
        <td>' . (isset($row["iron1st"]) && $row["iron1st"] != '00-00-0000' ? $row["iron1st"] . '<br>' 
        . (($row["1datenumber"]) && $row["1datenumber"] > 0 ? $row["1datenumber"] : '') : '') . '</td>
        <td>' . (isset($row["iron2nd"]) && $row["iron2nd"] != '00-00-0000' ? $row["iron2nd"] . '<br>' 
        . (($row["2datenumber"]) && $row["2datenumber"] > 0 ? $row["2datenumber"] : '') : '') . '</td>
        <td>' . (isset($row["iron3rd"]) && $row["iron3rd"] != '00-00-0000' ? $row["iron3rd"] . '<br>' 
        . (($row["3datenumber"]) && $row["3datenumber"] > 0 ? $row["3datenumber"] : '') : '') . '</td>
        <td>' . (isset($row["iron4th"]) && $row["iron4th"] != '00-00-0000' ? $row["iron4th"] . '<br>' 
        . (($row["4datenumber"]) && $row["4datenumber"] > 0 ? $row["4datenumber"] : '') : '') . '</td>
        <td>' . (isset($row["iron5th"]) && $row["iron5th"] != '00-00-0000' ? $row["iron5th"] . '<br>' 
        . (($row["5datenumber"]) && $row["5datenumber"] > 0 ? $row["5datenumber"] : '') : '') . '</td>
        <td>' . (isset($row["iron6th"]) && $row["iron6th"] != '00-00-0000' ? $row["iron6th"] . '<br>' 
        . (($row["6datenumber"]) && $row["6datenumber"] > 0 ? $row["6datenumber"] : '') : '') . '</td>
        </tr>'; 
    }  
    return $output;
}


function fetch_data2()  
{  
    $output = '';  
    $con = mysqli_connect("localhost", "root", "", "healthrecord");  
    $sql = "SELECT id, maternal_id, patientid, DATE_FORMAT(sydate,'%m-%d-%Y') AS sy_date,
    syresult, DATE_FORMAT(syresult_date,'%m-%d-%Y') AS result_date, given_penicillin, 
    DATE_FORMAT(given_penicillin_date,'%m-%d-%Y') AS penicillin_date, 
    DATE_FORMAT(date_terminated,'%m-%d-%Y') AS terminated_date, 
    outcome, gender, birth_weight, facility, nid, attended, remarks FROM maternal 
    INNER JOIN client ON maternal.patientid = client.id ORDER BY id ASC";  

    $userQuery = mysqli_query($con, "SELECT user_id, username, password, CONCAT(fname, ' ', lname) AS fullname from users WHERE type = 'bhw'");
    $user = mysqli_fetch_assoc($userQuery);
    $preparedByName = $user['fullname'];

    $result = mysqli_query($con, $sql);  
    if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result))  
    {       
        $output .= '<tr>    
        <td>' . (isset($row['sy_date']) && $row['sy_date'] != '00-00-0000' ? $row['sy_date'] : '') . '</td>
        <td>' . $row['syresult'] . '<br>' . (isset($row['result_date']) && $row['result_date'] != '00-00-0000' ? $row['result_date'] : '') . '</td>
        <td>' . $row['given_penicillin'] . '<br>' . (isset($row['penicillin_date']) && $row['penicillin_date'] != '00-00-0000' ? $row['penicillin_date'] : '') . '</td>
        <td>' . (isset($row['terminated_date']) && $row['terminated_date'] != '00-00-0000' ? $row['terminated_date'] : '') . '</td>
        <td>' . $row['outcome'] . '<br>' . $row['gender'] . '</td>
        <td>' . ($row['birth_weight'] > 0 ? $row['birth_weight'] : '') . '</td>
        <td>' . $row['facility'] . '</td>
        <td>' . $row['nid'] . '</td>
        <td>' . $row['attended'] . '</td>
        <td>' . nl2br($row['remarks']) . '</td>           
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
  $obj_pdf->SetTitle("TCL Maternal Care");  
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
        <th rowspan="2" width="5%">No.</th>
        <th rowspan="2">Date of Registration</th>
        <th rowspan="2">Name</th>
        <th rowspan="2" width="15%">Address</th>
        <th rowspan="2">Age</th>
        <th rowspan="2">LMP <br>G-P</th>
        <th rowspan="2">EDC</th>
        <th colspan="3">Prenatal Visits</th>
      </tr>
      <tr style="font-weight: bold;">
        <th>First Trimester</th>
        <th>Second Trimester</th>
        <th>Third Trimester</th>
        </tr>';

        $content .= fetch_data();
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
<br><h3 align="center">TARGET CLIENT LIST FOR MATERNAL CARE</h3><br />
<table border="1" cellspacing="0" cellpadding="3" style="width: 100%; text-align: center;">
    <tr style="font-weight: bold;">
    <th rowspan="3" width="8%">Tetanus Status</th>
    <th colspan="5">Date Tetanus Toxoid Vaccine Given</th>
    <th colspan="6">Micronutrient Supplementation</th>
  </tr>
  <tr style="font-weight: bold;">
    <th rowspan="2">TT1</th>
    <th rowspan="2">TT2</th>
    <th rowspan="2">TT3</th>
    <th rowspan="2">TT4</th>
    <th rowspan="2">TT5</th>
    <th colspan="6">Date and Number Iron with Folic Acid was given</th>
  </tr>
  <tr>
    <th><br></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    </tr>';
 
    $content .= fetch_data1();
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
<br><h3 align="center">TARGET CLIENT LIST FOR MATERNAL CARE</h3><br />
<table border="1" cellspacing="0" cellpadding="3" style="width: 100%; text-align: center;">
    <tr style="font-weight: bold;">
    <th colspan="3">STI Surveillance</th>
    <th colspan="2">Pregnancy</th>
    <th colspan="4">Livebirths</th>
    <th rowspan="3">Remarks</th>
  </tr>
  <tr style="font-weight: bold;">
    <th>Tested for SY</th>
    <th>Result for SY Testing</th>
    <th>Given Penicillin</th>
    <th rowspan="2">Date Terminated</th>
    <th rowspan="2">Outcome / <br>Gender (M/F)</th>
    <th rowspan="2" class="font-weight-normal"><b>Birth <br>Weight</b> <br>(grams)</th>
    <th colspan="2">Place of</th>
    <th rowspan="2">Attended by</th>
  </tr>
  <tr style="font-weight: bold;">
    <th>Date</th>
    <th>(+/-) / <br>Date</th>
    <th>Y/N <br>Date</th>
    <th>Health Facility</th>
    <th>NID</th>
    </tr>';
 
    $content .= fetch_data2();
    $content .= '</table>';
    $obj_pdf->writeHTML($content);  

    $obj_pdf->Output('TCL-Maternal-Care.pdf', 'D');  
    exit;
}
?>



<!DOCTYPE html>
<html lang="en">

<?php
include('../dbcon.php');

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

    <title>Maternal Care</title>
    <link rel="icon" href="../../img/logo.png">
      <link rel="stylesheet" href="styles.css">

      <style type="text/css">

          #example td {
              vertical-align: middle;
          }
          td {
              border: 1px solid #ccc;
              padding: 10px;
              position: relative; /* Important for absolute positioning */
          }

          .highlight:hover {
            background-color: #ffc107;
          }

  /*tooltips*/
          .tooltips-trigger, .tooltips-trigger1, .tooltips-trigger2, .tooltips-trigger3, .tooltips-trigger4, .tooltips-trigger5 {
              text-decoration: underline;
              cursor: pointer;
          }

          .tooltips, .tooltips1, .tooltips2, .tooltips3, .tooltips4, .tooltips5 {
              display: none;
              position: absolute;
              bottom:60px;
              left: 0;
              background-color: #f9f9f9;
              border: 1px solid #ccc;
              border-radius: 5px;
              padding: 10px;
              box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
              z-index: 1; /* Ensure tooltips appears on top of other content */
          }

          .tooltips form {
              margin: 0;
          }

          .tooltips form label,
          .tooltips form textarea {
              display: block;
              margin-bottom: 10px;
              width: 200px; /* Adjust the width as needed */
          }

          .tooltips form input[type="submit"] {
              background-color: #007bff;
              color: #fff;
              border: none;
              padding: 8px 16px;
              border-radius: 4px;
              cursor: pointer;
          }

          .tooltips form input[type="submit"]:hover {
              background-color: #0056b3;
          }


  /*tooltips1*/

          .tooltips1 form {
              margin: 0;
          }

          .tooltips1 form label,
          .tooltips1 form textarea {
              display: block;
              margin-bottom: 10px;
              width: 200px; /* Adjust the width as needed */
          }

          .tooltips1 form input[type="submit"] {
              background-color: #007bff;
              color: #fff;
              border: none;
              padding: 8px 16px;
              border-radius: 4px;
              cursor: pointer;
          }

          .tooltips1 form input[type="submit"]:hover {
              background-color: #0056b3;
          }


  /*tooltips2*/

          .tooltips2 form {
              margin: 0;
          }

          .tooltips2 form label,
          .tooltips2 form textarea {
              display: block;
              margin-bottom: 10px;
              width: 200px; /* Adjust the width as needed */
          }

          .tooltips2 form input[type="submit"] {
              background-color: #007bff;
              color: #fff;
              border: none;
              padding: 8px 16px;
              border-radius: 4px;
              cursor: pointer;
          }

          .tooltips2 form input[type="submit"]:hover {
              background-color: #0056b3;
          }


  /*tooltips3*/

          .tooltips3 form {
              margin: 0;
          }

          .tooltips3 form label,
          .tooltips3 form textarea {
              display: block;
              margin-bottom: 10px;
              width: 200px; /* Adjust the width as needed */
          }

          .tooltips3 form input[type="submit"] {
              background-color: #007bff;
              color: #fff;
              border: none;
              padding: 8px 16px;
              border-radius: 4px;
              cursor: pointer;
          }

          .tooltips3 form input[type="submit"]:hover {
              background-color: #0056b3;
          }

  /*tooltips4*/

          .tooltips4 form {
              margin: 0;
          }

          .tooltips4 form label,
          .tooltips4 form textarea {
              display: block;
              margin-bottom: 10px;
              width: 200px; /* Adjust the width as needed */
          }

          .tooltips4 form input[type="submit"] {
              background-color: #007bff;
              color: #fff;
              border: none;
              padding: 8px 16px;
              border-radius: 4px;
              cursor: pointer;
          }

          .tooltips4 form input[type="submit"]:hover {
              background-color: #0056b3;
          }

  /*tooltips5*/

          .tooltips5 form {
              margin: 0;
          }

          .tooltips5 form label,
          .tooltips5 form textarea {
              display: block;
              margin-bottom: 10px;
              width: 200px; /* Adjust the width as needed */
          }

          .tooltips5 form input[type="submit"] {
              background-color: #007bff;
              color: #fff;
              border: none;
              padding: 8px 16px;
              border-radius: 4px;
              cursor: pointer;
          }

          .tooltips5 form input[type="submit"]:hover {
              background-color: #0056b3;
          }

          .tooltip-content {
              white-space: pre-line;
          }

      .default-link {
        color: inherit; 
        text-decoration: none; 
    }
      .default-link:hover {
        color: inherit; 
        background-color: #ffc107;
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
                    <ul class="nav nav-pills nav-sidebar flex-column text-sm" data-widget="treeview" role="menu" data-accordion="false">
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
                        <li class="nav-item has-treeview menu-open">
                            <a href="#" class="nav-link active">
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
                                    <a href="../maternal/maternal.php" class="nav-link active">
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
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
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
                                      <a href="../main/client.php" class="nav-link">
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
              <div class="col-8">
                <h4 class="font-weight-bold" style="font-family: Helvetica;">TARGET CLIENT LIST</h4>
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
                <h5 class="font-weight-bold text-center">TARGET CLIENT LIST FOR MATERNAL CARE
                </h5>

                  <div class="card-body d-flex flex-column">
                    <div class="card-block">
                      <div class="row">
                          <div class="col-2">
                            <div class="form-group">

                      <button id="healthServiceButton" class="btn btn-success bg-gradient-success btn-block btn-sm" type="button"
                          id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="nav-icon fas fa-download"></i> Download
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="../main/download-maternal.php" style="font-size: 1.1em;">Excel Report</a>
                            <a class="dropdown-item" href="#" onclick="generatePDF()" style="font-size: 1.1em;">PDF Report</a>
                      </div>

                      <script>
                          function generatePDF() {
                              // Trigger the form submission to generate the PDF
                              document.getElementById("pdfForm").submit();
                          }
                      </script>

                      <!-- Hidden form for triggering PDF generation -->
                      <form id="pdfForm" method="post" style="display: none;">
                          <input type="hidden" name="generate_pdf" value="1" />
                      </form>

                          </div>
                          </div>
    <!--                    <div class="col-9"></div>
                    <div class="col-1 text-right">
                        <button type="button" class="btn btn-outline-info" data-toggle="modal"
                        data-target="#maternal-info">
                        <i class="nav-icon fas fa-info"></i>
                      </button>
                    </div>  !-->
                      </div>
                    </div>

            <?php // include('info.php'); ?>

                      <?php
                      $maternal = mysqli_query($con, "SELECT id, maternal_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
                  DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, purok, address, 
                  DATE_FORMAT(lmp,'%m-%d-%Y') AS lmpdate, g, p, DATE_FORMAT(edc,'%m-%d-%Y') AS edcdate, 
                  DATE_FORMAT(trimester1,'%m-%d-%Y') AS tri1, rem_tri1, DATE_FORMAT(trimester1a,'%m-%d-%Y') AS tri1a, rem_tri1a, 
                  DATE_FORMAT(trimester2,'%m-%d-%Y') AS tri2, rem_tri2, DATE_FORMAT(trimester2a,'%m-%d-%Y') AS tri2a, rem_tri2a, 
                  DATE_FORMAT(trimester3,'%m-%d-%Y') AS tri3, rem_tri3, DATE_FORMAT(trimester3a,'%m-%d-%Y') AS tri3a, rem_tri3a, 
                  remarks FROM maternal INNER JOIN client ON maternal.patientid = client.id");
                      ?>

                          <table id="example" class="table table-bordered table-hover text-center" cellspacing="0"
                            width="100%">
                            <thead class="bg-light color-pallete">
                              <tr>
                                <th rowspan="2">Name</th>
                                <th rowspan="2">Date of Registration</th>
                                <th rowspan="2">Age</th>
                                <th colspan="3">Prenatal Visits</th>
                                <th rowspan="2">View</th>
                              </tr>
                              <tr>
                                <th>First Trimester</th>
                                <th>Second Trimester</th>
                                <th>Third Trimester</th>
                              </tr>
                            </thead>
                            <tbody>

                              <?php
                              while ($data = mysqli_fetch_array($maternal)) { ?>

                                  <tr>
                                    <td>
                                    <a href="../maternal/maternal-add-consult.php?mid=<?php echo $data['patientid']; ?>" class="default-link"> 
                                      <?php echo $data['fullname']; ?>
                                    </td>
                                    <td>
                                      <?php echo $data['regdate']; ?>
                                    </td>
                                      <?php
                                            $birthdate = $data['birthdate'];
                                            $birthDateObj = DateTime::createFromFormat('m-d-Y', $birthdate);

                                            if ($birthDateObj === false) {
                                              echo "Failed to parse the birthdate.";
                                            } else {
                                              $currentDateObj = new DateTime();
                                              $age = $birthDateObj->diff($currentDateObj);

                                              $years = $age->y;
                                              $months = $age->m;

                                              ?>
                                      <td>
                                  <?php
                                  if ($years == 0) {
                                    if ($months == 1) {
                                      echo "1 month";
                                    } elseif ($months == 0) {
                                      echo "0 month";
                                    } else {
                                      echo "$months months";
                                    }
                                  } elseif ($years == 1) {
                                    if ($months == 1) {
                                      echo "1 year old";
                                    } elseif ($months == 0) {
                                      echo "1 year old";
                                    } else {
                                      echo "1 year old";
                                    }
                                  } else {
                                    if ($months == 1) {
                                      echo "$years years old";
                                    } elseif ($months == 0) {
                                      echo "$years years old";
                                    } else {
                                      echo "$years years old";
                                    }
                                  }
                                    }
                                    ?>
                                    </td>
                                    <td>
                                    <?php if ($data['tri1'] != '00-00-0000') { ?>
                                              <a class="tooltips-trigger highlight" data-tooltip-id="<?php echo $data['maternal_id']; ?>-1"
                                          data-toggle="tooltip" data-placement="top" data-original-title="<?php echo $data['rem_tri1']; ?>">
                                          <?php echo $data['tri1']; ?></a>
                                          <?php } ?>
                                          <div class="tooltips" data-tooltip-id="<?php echo $data['maternal_id']; ?>-1">
                                            <?php
                                            $remarks1 = $data['rem_tri1'];
                                            if ($remarks1 == NULL) { ?>
                                                <form action="remarks.php" method="post">
                                                  <label>Remarks</label>
                                                  <p>First Trimester:</p>
                                                  <textarea id="remarks" name="rem_tri1" rows="5"></textarea>
                                                  <input type="hidden" name="id" value="<?php echo $data['maternal_id']; ?>">
                                                  <input type="submit" name="submit1" value="Enter">
                                                </form>
                                            <?php } else { ?>
                                                <form action="remarks.php" method="post">
                                                  <label>Remarks</label>
                                                  <p>First Trimester:</p>
                                                  <textarea id="remarks" name="rem_tri1" rows="5"><?php echo $data['rem_tri1']; ?></textarea>
                                                  <input type="hidden" name="id" value="<?php echo $data['maternal_id']; ?>">
                                                  <input type="submit" name="submit1" value="Enter">
                                                </form>
                                            <?php } ?>
                                          </div>
                                        <br>
                                        <?php if ($data['tri1a'] != '00-00-0000') { ?>
                                                  <a class="tooltips-trigger1 highlight" data-tooltip-id="<?php echo $data['maternal_id']; ?>-2"
                                              data-toggle="tooltip" data-placement="top" data-original-title="<?php echo $data['rem_tri1a']; ?>">
                                              <?php echo $data['tri1a']; ?></a>
                                              <?php } ?>
                                              <div class="tooltips1" data-tooltip-id="<?php echo $data['maternal_id']; ?>-2">
                                                <?php
                                                $remarks1a = $data['rem_tri1a'];
                                                if ($remarks1a == NULL) { ?>
                                                    <form action="remarks.php" method="post">
                                                      <label>Remarks</label>
                                                      <p>First Trimester:</p>
                                                      <textarea id="remarks" name="rem_tri1a" rows="5"></textarea>
                                                      <input type="hidden" name="id" value="<?php echo $data['maternal_id']; ?>">
                                                      <input type="submit" name="submit4" value="Enter">
                                                    </form>
                                                <?php } else { ?>
                                                    <form action="remarks.php" method="post">
                                                      <label>Remarks</label>
                                                      <p>First Trimester:</p>
                                                      <textarea id="remarks" name="rem_tri1a" rows="5"><?php echo $data['rem_tri1a']; ?></textarea>
                                                      <input type="hidden" name="id" value="<?php echo $data['maternal_id']; ?>">
                                                      <input type="submit" name="submit4" value="Enter">
                                                    </form>
                                                <?php } ?>
                                              </div>
                                          </td>
                                          <td>
                                          <?php if ($data['tri2'] != '00-00-0000') { ?>
                                                    <a class="tooltips-trigger2 highlight" data-tooltip-id="<?php echo $data['maternal_id']; ?>-3"
                                                data-toggle="tooltip" data-placement="top" data-original-title="<?php echo $data['rem_tri2']; ?>">
                                                <?php echo $data['tri2']; ?></a>
                                                <?php } ?>
                                                <div class="tooltips2" data-tooltip-id="<?php echo $data['maternal_id']; ?>-3">
                                                  <?php
                                                  $remarks2 = $data['rem_tri2'];
                                                  if ($remarks2 == NULL) { ?>
                                                      <form action="remarks.php" method="post">
                                                        <label>Remarks</label>
                                                        <p>Second Trimester:</p>
                                                        <textarea id="remarks" name="rem_tri2" rows="5"></textarea>
                                                        <input type="hidden" name="id" value="<?php echo $data['maternal_id']; ?>">
                                                        <input type="submit" name="submit2" value="Enter">
                                                      </form>
                                                  <?php } else { ?>
                                                      <form action="remarks.php" method="post">
                                                        <label>Remarks</label>
                                                        <p>Second Trimester:</p>
                                                        <textarea id="remarks" name="rem_tri2" rows="5"><?php echo $data['rem_tri2']; ?></textarea>
                                                        <input type="hidden" name="id" value="<?php echo $data['maternal_id']; ?>">
                                                        <input type="submit" name="submit2" value="Enter">
                                                      </form>
                                                  <?php } ?>
                                                </div>
                                        <br> 
                                        <?php if ($data['tri2a'] != '00-00-0000') { ?>
                                                  <a class="tooltips-trigger3 highlight" data-tooltip-id="<?php echo $data['maternal_id']; ?>-4"
                                              data-toggle="tooltip" data-placement="top" data-original-title="<?php echo $data['rem_tri2a']; ?>">
                                              <?php echo $data['tri2a']; ?></a>
                                              <?php } ?>
                                              <div class="tooltips3" data-tooltip-id="<?php echo $data['maternal_id']; ?>-4">
                                                <?php
                                                $remarks2 = $data['rem_tri2a'];
                                                if ($remarks2 == NULL) { ?>
                                                    <form action="remarks.php" method="post">
                                                      <label>Remarks</label>
                                                      <p>Second Trimester:</p>
                                                      <textarea id="remarks" name="rem_tri2a" rows="5"></textarea>
                                                      <input type="hidden" name="id" value="<?php echo $data['maternal_id']; ?>">
                                                      <input type="submit" name="submit5" value="Enter">
                                                    </form>
                                                <?php } else { ?>
                                                    <form action="remarks.php" method="post">
                                                      <label>Remarks</label>
                                                      <p>Second Trimester:</p>
                                                      <textarea id="remarks" name="rem_tri2a" rows="5"><?php echo $data['rem_tri2a']; ?></textarea>
                                                      <input type="hidden" name="id" value="<?php echo $data['maternal_id']; ?>">
                                                      <input type="submit" name="submit5" value="Enter">
                                                    </form>
                                                <?php } ?>
                                              </div>
                                          </td>
                                          <td>
                                          <?php if ($data['tri3'] != '00-00-0000') { ?>
                                                    <a class="tooltips-trigger4 highlight" data-tooltip-id="<?php echo $data['maternal_id']; ?>-5"
                                                data-toggle="tooltip" data-placement="top" data-original-title="<?php echo $data['rem_tri3']; ?>">
                                                <?php echo $data['tri3']; ?></a>
                                                <?php } ?>
                                                <div class="tooltips4" data-tooltip-id="<?php echo $data['maternal_id']; ?>-5">
                                                  <?php
                                                  $remarks1a = $data['rem_tri3'];
                                                  if ($remarks1a == NULL) { ?>
                                                      <form action="remarks.php" method="post">
                                                        <label>Remarks</label>
                                                        <p>Third Trimester:</p>
                                                        <textarea id="remarks" name="rem_tri3" rows="5"></textarea>
                                                        <input type="hidden" name="id" value="<?php echo $data['maternal_id']; ?>">
                                                        <input type="submit" name="submit3" value="Enter">
                                                      </form>
                                                  <?php } else { ?>
                                                      <form action="remarks.php" method="post">
                                                        <label>Remarks</label>
                                                        <p>Third Trimester:</p>
                                                        <textarea id="remarks" name="rem_tri3" rows="5"><?php echo $data['rem_tri3']; ?></textarea>
                                                        <input type="hidden" name="id" value="<?php echo $data['maternal_id']; ?>">
                                                        <input type="submit" name="submit3" value="Enter">
                                                      </form>
                                                  <?php } ?>
                                                </div>
                                        <br>
                                        <?php if ($data['tri3a'] != '00-00-0000') { ?>
                                                  <a class="tooltips-trigger5 highlight" data-tooltip-id="<?php echo $data['maternal_id']; ?>-6"
                                              data-toggle="tooltip" data-placement="top" data-original-title="<?php echo $data['rem_tri3a']; ?>">
                                              <?php echo $data['tri3a']; ?></a>
                                              <?php } ?>
                                              <div class="tooltips5" data-tooltip-id="<?php echo $data['maternal_id']; ?>-6">
                                                <?php
                                                $remarks1a = $data['rem_tri3a'];
                                                if ($remarks1a == NULL) { ?>
                                                    <form action="remarks.php" method="post">
                                                      <label>Remarks</label>
                                                      <p>Third Trimester:</p>
                                                      <textarea id="remarks" name="rem_tri3a" rows="5"></textarea>
                                                      <input type="hidden" name="id" value="<?php echo $data['maternal_id']; ?>">
                                                      <input type="submit" name="submit6" value="Enter">
                                                    </form>
                                                <?php } else { ?>
                                                    <form action="remarks.php" method="post">
                                                      <label>Remarks</label>
                                                      <p>Third Trimester:</p>
                                                      <textarea id="remarks" name="rem_tri3a" rows="5"><?php echo $data['rem_tri3a']; ?></textarea>
                                                      <input type="hidden" name="id" value="<?php echo $data['maternal_id']; ?>">
                                                      <input type="submit" name="submit6" value="Enter">
                                                    </form>
                                                <?php } ?>
                                              </div>
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

                        </div>

                      </div>
                    </div>
                  </div>

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
    $('.tooltips-trigger').tooltip({
      template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner tooltip-content"></div></div>'
    });
  });

  $(document).ready(function() {
    $('.tooltips-trigger1').tooltip({
      template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner tooltip-content"></div></div>'
    });
  });

  $(document).ready(function() {
    $('.tooltips-trigger2').tooltip({
      template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner tooltip-content"></div></div>'
    });
  });

  $(document).ready(function() {
    $('.tooltips-trigger3').tooltip({
      template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner tooltip-content"></div></div>'
    });
  });

  $(document).ready(function() {
    $('.tooltips-trigger4').tooltip({
      template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner tooltip-content"></div></div>'
    });
  });

  $(document).ready(function() {
    $('.tooltips-trigger5').tooltip({
      template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner tooltip-content"></div></div>'
    });
  });


  document.addEventListener("DOMContentLoaded", function () {
      const tooltipsTriggers = document.querySelectorAll(".tooltips-trigger");
      const tooltips = document.querySelectorAll(".tooltips");
      const tooltipsTriggers1 = document.querySelectorAll(".tooltips-trigger1");
      const tooltips1 = document.querySelectorAll(".tooltips1");
      const tooltipsTriggers2 = document.querySelectorAll(".tooltips-trigger2");
      const tooltips2 = document.querySelectorAll(".tooltips2");
      const tooltipsTriggers3 = document.querySelectorAll(".tooltips-trigger3");
      const tooltips3 = document.querySelectorAll(".tooltips3");
      const tooltipsTriggers4 = document.querySelectorAll(".tooltips-trigger4");
      const tooltips4 = document.querySelectorAll(".tooltips4");
      const tooltipsTriggers5 = document.querySelectorAll(".tooltips-trigger5");
      const tooltips5 = document.querySelectorAll(".tooltips5");


      tooltipsTriggers.forEach((trigger) => {
          trigger.addEventListener("click", function (event) {
              event.preventDefault();
              const tooltipId = trigger.getAttribute("data-tooltip-id");
              const tooltip = document.querySelector(`.tooltips[data-tooltip-id="${tooltipId}"]`);
              if (tooltip) {
                  tooltip.style.display = "block";
              }
          });

          // Close the tooltips if clicked outside
          document.addEventListener("click", function (event) {
              if (!trigger.contains(event.target)) {
                  const tooltipId = trigger.getAttribute("data-tooltip-id");
                  const tooltip = document.querySelector(`.tooltips[data-tooltip-id="${tooltipId}"]`);
                  if (tooltip && !tooltip.contains(event.target)) {
                      tooltip.style.display = "none";
                  }
              }
          });
      });


      tooltipsTriggers1.forEach((trigger) => {
          trigger.addEventListener("click", function (event) {
              event.preventDefault();
              const tooltipId = trigger.getAttribute("data-tooltip-id");
              const tooltip = document.querySelector(`.tooltips1[data-tooltip-id="${tooltipId}"]`);
              if (tooltip) {
                  tooltip.style.display = "block";
              }
          });

          // Close the tooltips if clicked outside
          document.addEventListener("click", function (event) {
              if (!trigger.contains(event.target)) {
                  const tooltipId = trigger.getAttribute("data-tooltip-id");
                  const tooltip = document.querySelector(`.tooltips1[data-tooltip-id="${tooltipId}"]`);
                  if (tooltip && !tooltip.contains(event.target)) {
                      tooltip.style.display = "none";
                  }
              }
          });
      });


      tooltipsTriggers2.forEach((trigger) => {
          trigger.addEventListener("click", function (event) {
              event.preventDefault();
              const tooltipId = trigger.getAttribute("data-tooltip-id");
              const tooltip = document.querySelector(`.tooltips2[data-tooltip-id="${tooltipId}"]`);
              if (tooltip) {
                  tooltip.style.display = "block";
              }
          });

          // Close the tooltips if clicked outside
          document.addEventListener("click", function (event) {
              if (!trigger.contains(event.target)) {
                  const tooltipId = trigger.getAttribute("data-tooltip-id");
                  const tooltip = document.querySelector(`.tooltips2[data-tooltip-id="${tooltipId}"]`);
                  if (tooltip && !tooltip.contains(event.target)) {
                      tooltip.style.display = "none";
                  }
              }
          });
      });

      tooltipsTriggers3.forEach((trigger) => {
          trigger.addEventListener("click", function (event) {
              event.preventDefault();
              const tooltipId = trigger.getAttribute("data-tooltip-id");
              const tooltip = document.querySelector(`.tooltips3[data-tooltip-id="${tooltipId}"]`);
              if (tooltip) {
                  tooltip.style.display = "block";
              }
          });

          // Close the tooltips if clicked outside
          document.addEventListener("click", function (event) {
              if (!trigger.contains(event.target)) {
                  const tooltipId = trigger.getAttribute("data-tooltip-id");
                  const tooltip = document.querySelector(`.tooltips3[data-tooltip-id="${tooltipId}"]`);
                  if (tooltip && !tooltip.contains(event.target)) {
                      tooltip.style.display = "none";
                  }
              }
          });
      });


      tooltipsTriggers4.forEach((trigger) => {
          trigger.addEventListener("click", function (event) {
              event.preventDefault();
              const tooltipId = trigger.getAttribute("data-tooltip-id");
              const tooltip = document.querySelector(`.tooltips4[data-tooltip-id="${tooltipId}"]`);
              if (tooltip) {
                  tooltip.style.display = "block";
              }
          });

          // Close the tooltips if clicked outside
          document.addEventListener("click", function (event) {
              if (!trigger.contains(event.target)) {
                  const tooltipId = trigger.getAttribute("data-tooltip-id");
                  const tooltip = document.querySelector(`.tooltips4[data-tooltip-id="${tooltipId}"]`);
                  if (tooltip && !tooltip.contains(event.target)) {
                      tooltip.style.display = "none";
                  }
              }
          });
      });


      tooltipsTriggers5.forEach((trigger) => {
          trigger.addEventListener("click", function (event) {
              event.preventDefault();
              const tooltipId = trigger.getAttribute("data-tooltip-id");
              const tooltip = document.querySelector(`.tooltips5[data-tooltip-id="${tooltipId}"]`);
              if (tooltip) {
                  tooltip.style.display = "block";
              }
          });

          // Close the tooltips if clicked outside
          document.addEventListener("click", function (event) {
              if (!trigger.contains(event.target)) {
                  const tooltipId = trigger.getAttribute("data-tooltip-id");
                  const tooltip = document.querySelector(`.tooltips5[data-tooltip-id="${tooltipId}"]`);
                  if (tooltip && !tooltip.contains(event.target)) {
                      tooltip.style.display = "none";
                  }
              }
          });
      });
  });
  </script>
    <script>
      $(function () {
        $('#example').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
          "order": [[1, 'desc']]
        });
            $(document).ready(function() {
                var table = $('#example').DataTable();

                $('#example_filter input').on('keyup', function() {
                    var searchTerm = this.value;
                
                    table.column([0]).search(searchTerm).draw();
                });

      $('[data-toggle="tooltip"]').tooltip();
      });

         $('[data-toggle="tooltip"]').tooltip();
            $('#healthServiceButton').tooltip({
                placement: 'top',
                trigger: 'hover'
            });
            $('#healthServiceButton').dropdown();
            });

    </script>
  <?php } ?>
</body>


</html>