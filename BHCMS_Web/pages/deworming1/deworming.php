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
            AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 1 AND 4 ORDER BY id ASC";  

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

function fetch_data_for_pdf()  
{  
    $output = '';  
    $con = mysqli_connect("localhost", "root", "", "healthrecord");  
    $sql = "SELECT id, deworming_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
            DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
            CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, sex, mother_name, 
            CONCAT(purok, ', ', address) AS caddress, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
            DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks, remarks_1stdose, 
            remarks_2nddose FROM deworming INNER JOIN client ON deworming.patientid = client.id 
            AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 5 AND 9 ORDER BY id ASC";  

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

function fetch_data_export()  
{  
    $output = '';  
    $con = mysqli_connect("localhost", "root", "", "healthrecord");  
    $sql = "SELECT id, deworming_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
            DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
            CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, sex, mother_name, 
            CONCAT(purok, ', ', address) AS caddress, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
            DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks, remarks_1stdose, 
            remarks_2nddose FROM deworming INNER JOIN client ON deworming.patientid = client.id 
            AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 10 AND 19 ORDER BY id ASC";  

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
      $obj_pdf->SetTitle("TCL Deworming Services 1-4 years old");  
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
      $obj_pdf->Output('TCL-Deworming-1-4.pdf', 'D');  
      exit;
 }  


 if(isset($_POST["generate_pdf1"]))  
 {  
      require_once('../pdf_export/tcpdf/tcpdf.php');  
      $obj_pdf = new TCPDF('L', PDF_UNIT, 'LETTER', true, 'UTF-8', false);
      $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetTitle("TCL Deworming Services 5-9 years old");  
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
        </tr>
';
$content .= fetch_data_for_pdf();
$content .= '</table>';

      $obj_pdf->writeHTML($content);  
      $obj_pdf->Output('TCL-Deworming-5-9.pdf', 'D');  
      exit;
 }  

 
 if(isset($_POST["generate_pdf2"]))  
 {  
      require_once('../pdf_export/tcpdf/tcpdf.php');  
      $obj_pdf = new TCPDF('L', PDF_UNIT, 'LETTER', true, 'UTF-8', false);
      $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetTitle("TCL Deworming Services 10-19 years old");  
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
        </tr>
';
$content .= fetch_data_export();
$content .= '</table>';

      $obj_pdf->writeHTML($content);  
      $obj_pdf->Output('TCL-Deworming-10-19.pdf', 'D');  
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

      <title>Deworming Services</title>
      <link rel="icon" href="../../img/logo.png">
      <link rel="stylesheet" href="styles.css">

      <style type="text/css">
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

          td {
              border: 1px solid #ccc;
              padding: 10px;
              position: relative; /* Important for absolute positioning */
          }

          .highlight:hover {
            background-color: #ffc107;
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
                                    <a href="../deworming1/deworming.php" class="nav-link active">
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
                  <div class="card card-secondary card-tabs">              
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

                      <div class="card-body d-flex flex-column">

                      <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade show active" id="custom-tabs-one-1-4" role="tabpanel" aria-labelledby="custom-tabs-one-1-4-tab">

                    <h5 class="font-weight-bold text-center">TARGET CLIENT LIST FOR DEWORMING SERVICES
                      FOR 1-4 YEARS OLD</h5><br>

                        <div class="card-block">
                          <div class="row">
                      <div class="col-2">
                        <div class="form-group">

                        <button id="healthServiceButton" class="btn btn-success bg-gradient-success btn-block btn-sm" type="button"
                          id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="nav-icon fas fa-download"></i> Download
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="../main/download-d1.php" style="font-size: 1.1em;">Excel Report</a>
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
                        </div>
                        </div>

                        <?php
$deworming1st = mysqli_query($con, "SELECT deworming_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
    CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, sex, mother_name, 
    purok, address, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
    DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks, remarks_1stdose, 
    remarks_2nddose FROM deworming INNER JOIN client ON deworming.patientid = client.id AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 1 AND 4");
?>

      <table id="example" class="table table-bordered table-hover text-center">
        <thead class="bg-light color-pallete">
          <tr>
            <th>Name of Child</th>
            <th>Date of Registration</th>
            <th>Sex</th>
            <th>Age</th>
            <th>1st Dose <br>(date given)</th>
            <th>2nd Dose <br>(date given)</th>
            <th>View</th>
          </tr>
        </thead>
        <tbody>

      <?php while ($data = mysqli_fetch_array($deworming1st)) {

          ?>

      <tr>
        <td>
          <a href="../deworming1/deworm-consult.php?did=<?php echo $data['patientid']; ?>" class="default-link"> 
          <?php echo $data['fullname']; ?>
        </td>
        <td>
          <?php echo $data['regdate']; ?>
        </td>
        <td>
          <?php echo $data['sex']; ?>
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
          <?php if ($data['1st_dose'] != '00-00-0000') {
            echo $data['1st_dose'];
          } ?>
        </td>
        <td>
          <?php if ($data['2nd_dose'] != '00-00-0000') {
            echo $data['2nd_dose'];
          }
          ; ?>
        </td>
        <td>
          <a href="../client/deworming-record.php?id=<?php echo $data['patientid']; ?>">
            <button type="button" class="btn btn-primary btn-sm">
              <i class="nav-icon fas fa-eye"></i> </button>
          </a>
        </td>
      </tr>

    <?php

    if ($years == 20) {
        continue;
    } ?>

<?php } ?>

    </tbody>

    </table>

  </div>



  <div class="tab-pane fade" id="custom-tabs-one-5-9" role="tabpanel" aria-labelledby="custom-tabs-one-5-9-tab">

    <h5 class="font-weight-bold text-center">TARGET CLIENT LIST FOR DEWORMING SERVICES
                    FOR 5-9 YEARS OLD</h5><br>

<div class="card-block">
                      <div class="row">
                      <div class="col-2">
                        <div class="form-group">

                        <button id="healthServiceButton" class="btn btn-success bg-gradient-success btn-block btn-sm" type="button"
                          id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="nav-icon fas fa-download"></i> Download
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="../main/download-d1.php" style="font-size: 1.1em;">Excel Report</a>
                            <a class="dropdown-item" href="#" onclick="generatePDF1()" style="font-size: 1.1em;">PDF Report</a>
                      </div>

                      <script>
                          function generatePDF1() {
                              // Trigger the form submission to generate the PDF
                              document.getElementById("pdfForm1").submit();
                          }
                      </script>

                      <!-- Hidden form for triggering PDF generation -->
                      <form id="pdfForm1" method="post" style="display: none;">
                          <input type="hidden" name="generate_pdf1" value="1" />
                      </form>

                      </div>
                      </div>
                      </div>
                    </div>
<?php

$deworming2nd = mysqli_query($con, "SELECT deworming_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
    DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
    CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, sex, mother_name, 
    purok, address, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
    DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks, remarks_1stdose, 
    remarks_2nddose FROM deworming INNER JOIN client ON deworming.patientid = client.id AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 5 AND 9");
?>

    <table id="example1" class="table table-bordered table-hover text-center">
      <thead class="bg-light color-pallete">
        <tr>
          <th>Name of Child</th>
          <th>Date of Registration</th>
          <th>Sex</th>
          <th>Age</th>
          <th>1st Dose <br>(date given)</th>
          <th>2nd Dose <br>(date given)</th>
          <th>View</th>
        </tr>
      </thead>
      <tbody>

        <?php
        while ($data = mysqli_fetch_array($deworming2nd)) { 
          $currentYear = date('Y');
          $birthYear = date('Y', strtotime($data['birthdate']));
          $age = $currentYear - $birthYear;
          ?>
          <tr>
            <td>
          <a href="../deworming1/deworm-consult.php?did=<?php echo $data['patientid']; ?>" class="default-link"> 
              <?php echo $data['fullname']; ?>
            </td>
            <td>
              <?php echo $data['regdate']; ?>
            </td>
            <td>
              <?php echo $data['sex']; ?>
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
            <?php if ($data['1st_dose'] != '00-00-0000') {
              echo $data['1st_dose'];
            } ?>
          </td>
          <td>
            <?php if ($data['2nd_dose'] != '00-00-0000') {
              echo $data['2nd_dose'];
            }
            ; ?>
          </td>
            <td>
          <a href="../client/deworming-record.php?id=<?php echo $data['patientid']; ?>">
            <button type="button" class="btn btn-primary btn-sm">
              <i class="nav-icon fas fa-eye"></i> </button>
          </a>
            </td>
          </tr>

    <?php

    if ($years == 20) {
        continue;
    } ?>

<?php } ?>

      </tbody>

    </table>
  </div>


                    <div class="tab-pane fade" id="custom-tabs-one-10-19" role="tabpanel" aria-labelledby="custom-tabs-one-10-19-tab">


                  <h5 class="font-weight-bold text-center">TARGET CLIENT LIST FOR DEWORMING SERVICES
                    FOR 10-19 YEARS OLD</h5><br>

                      <div class="card-block">
                        <div class="row">
                      <div class="col-2">
                        <div class="form-group">

                        <button id="healthServiceButton" class="btn btn-success bg-gradient-success btn-block btn-sm" type="button"
                          id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="nav-icon fas fa-download"></i> Download
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="../main/download-d1.php" style="font-size: 1.1em;">Excel Report</a>
                            <a class="dropdown-item" href="#" onclick="generatePDF2()" style="font-size: 1.1em;">PDF Report</a>
                      </div>

                      <script>
                          function generatePDF2() {
                              // Trigger the form submission to generate the PDF
                              document.getElementById("pdfForm2").submit();
                          }
                      </script>

                      <!-- Hidden form for triggering PDF generation -->
                      <form id="pdfForm2" method="post" style="display: none;">
                          <input type="hidden" name="generate_pdf2" value="1" />
                      </form>

                      </div>
                      </div>
                        </div>
                      </div>
<?php

$deworming3rd = mysqli_query($con, "SELECT deworming_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
    DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
    CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, sex, mother_name, 
    purok, address, DATE_FORMAT(1stdose,'%m-%d-%Y') AS 1st_dose, 
    DATE_FORMAT(2nddose,'%m-%d-%Y') AS 2nd_dose, remarks, remarks_1stdose, 
    remarks_2nddose FROM deworming INNER JOIN client ON deworming.patientid = client.id AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 10 AND 19");

?>

    <table id="example2" class="table table-bordered table-hover text-center">
      <thead class="bg-light color-pallete">
        <tr>
          <th>Name of Child</th>
          <th>Date of Registration</th>
          <th>Sex</th>
          <th>Age</th>
          <th>1st Dose <br>(date given)</th>
          <th>2nd Dose <br>(date given)</th>
          <th>View</th>
        </tr>
      </thead>
      <tbody>
<?php
    while ($data = mysqli_fetch_array($deworming3rd)) { 
          $currentYear = date('Y');
          $birthYear = date('Y', strtotime($data['birthdate']));
          $age = $currentYear - $birthYear;
          ?>
      <tr>
        <td>
          <a href="../deworming1/deworm-consult.php?did=<?php echo $data['patientid']; ?>" class="default-link"> 
          <?php echo $data['fullname']; ?>
        </td>
        <td>
          <?php echo $data['regdate']; ?>
        </td>
        <td>
          <?php echo $data['sex']; ?>
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
      <?php if ($data['1st_dose'] != '00-00-0000') {
        echo $data['1st_dose'];
      } ?>
    </td>
    <td>
      <?php if ($data['2nd_dose'] != '00-00-0000') {
        echo $data['2nd_dose'];
      }
      ; ?>
    </td>
        <td>
          <a href="../client/deworming-record.php?id=<?php echo $data['patientid']; ?>">
            <button type="button" class="btn btn-primary btn-sm">
              <i class="nav-icon fas fa-eye"></i> </button>
          </a>
        </td>
      </tr>

    <?php

    if ($years == 20) {
        continue;
    } ?>

<?php } ?>


    </tbody>

    </table>


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

        <script src="script.js"></script>

        <!-- DataTables -->
        <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>


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
          });
            $(document).ready(function() {
                var table = $('#example').DataTable();

                $('#example_filter input').on('keyup', function() {
                    var searchTerm = this.value;
                
                    table.column([0]).search(searchTerm).draw();
                });
              });

            $(function () {
            $('#example1').DataTable({
              "paging": true,
              "lengthChange": false,
              "searching": true,
              "ordering": true,
              "info": true,
              "autoWidth": false,
              "responsive": true,
              "order": [[1, 'desc']]
            });
          });
            $(document).ready(function() {
                var table = $('#example1').DataTable();

                $('#example1_filter input').on('keyup', function() {
                    var searchTerm = this.value;
                
                    table.column([0]).search(searchTerm).draw();
                });
            });


            $(function () {
            $('#example2').DataTable({
              "paging": true,
              "lengthChange": false,
              "searching": true,
              "ordering": true,
              "info": true,
              "autoWidth": false,
              "responsive": true,
              "order": [[1, 'desc']]
            });
          });
            $(document).ready(function() {
                var table = $('#example2').DataTable();

                $('#example2_filter input').on('keyup', function() {
                    var searchTerm = this.value;
                
                    table.column([0]).search(searchTerm).draw();
                });
            });
        </script>

  <?php } ?>
</body>

</html>