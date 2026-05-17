<?php
function fetch_data()  
{  
    $output = '';  
    $con = mysqli_connect("localhost", "root", "", "system_integration_db");  
    $sql = "SELECT id, immunization_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
    DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, se_status, CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, 
    sex, mother_name, CONCAT(purok, ', ', address) AS caddress, cpab1, cpab2 
    FROM immunization INNER JOIN client ON immunization.patientid = client.id ORDER BY id ASC";  

    $result = mysqli_query($con, $sql);  
    while($row = mysqli_fetch_array($result))  
    {       

        $output .= '<tr>    
        <td>'.$row["immunization_id"].'</td> 
        <td>'.$row["regdate"].'</td> 
        <td>'.$row["birthdate"].'</td>  
        <td>'.$row["se_status"].'</td>  
        <td>'.$row["fullname"].'</td>  
        <td>'.$row["sex"].'</td>  
        <td>'.$row["mother_name"].'</td>  
        <td>'.$row["caddress"].'</td>  
        <td style="font-family: dejavusans;">'.(isset($row["cpab1"]) && $row["cpab1"] != '✔' ? $row["cpab1"] : '').'</td>  
        <td style="font-family: dejavusans;">'.(isset($row["cpab2"]) && $row["cpab2"] != '✔' ? $row["cpab2"] : '').'</td> 
        </tr>'; 
    }  
    return $output;
}

function fetch_data1()  
{  
    $output = '';  
    $con = mysqli_connect("localhost", "root", "", "system_integration_db");  
    $sql = "SELECT id, immunization_id, patientid, length, weight, birth_weight_status, 
    DATE_FORMAT(initiated_breastfeed,'%m-%d-%Y') AS breastfeed, DATE_FORMAT(bcg,'%m-%d-%Y') AS bcgdate,
    DATE_FORMAT(hepab,'%m-%d-%Y') AS hepabdate, DATE_FORMAT(dpt_hib_hepb_1stdose,'%m-%d-%Y') AS dpt_hib_hepb1, 
    DATE_FORMAT(dpt_hib_hepb_2nddose,'%m-%d-%Y') AS dpt_hib_hepb2, DATE_FORMAT(dpt_hib_hepb_3rddose,'%m-%d-%Y') AS dpt_hib_hepb3 
    FROM immunization INNER JOIN client ON immunization.patientid = client.id ORDER BY id ASC";  

    $result = mysqli_query($con, $sql);  
    while($row = mysqli_fetch_array($result))  
    {       
        $output .= '<tr>   
        <td>'.(isset($row["length"]) && $row["length"] > 0 ? $row["length"] : '').'</td>
        <td>'.(isset($row["weight"]) && $row["weight"] > 0 ? $row["weight"] : '').'</td>
        <td>'.$row["birth_weight_status"].'</td>         
        <td>'.(isset($row["breastfeed"]) && $row["breastfeed"] != '00-00-0000' ? $row["breastfeed"] : '').'</td>
        <td>'.(isset($row["bcgdate"]) && $row["bcgdate"] != '00-00-0000' ? $row["bcgdate"] : '').'</td>
        <td>'.(isset($row["hepabdate"]) && $row["hepabdate"] != '00-00-0000' ? $row["hepabdate"] : '').'</td>
        <td>'.(isset($row["dpt_hib_hepb1"]) && $row["dpt_hib_hepb1"] != '00-00-0000' ? $row["dpt_hib_hepb1"] : '').'</td>
        <td>'.(isset($row["dpt_hib_hepb2"]) && $row["dpt_hib_hepb2"] != '00-00-0000' ? $row["dpt_hib_hepb2"] : '').'</td>
        <td>'.(isset($row["dpt_hib_hepb3"]) && $row["dpt_hib_hepb3"] != '00-00-0000' ? $row["dpt_hib_hepb3"] : '').'</td>
        </tr>'; 
    }  
    return $output;
}


function fetch_data2()  
{  
    $output = '';  
    $con = mysqli_connect("localhost", "root", "", "system_integration_db");  
    $sql = "SELECT id, immunization_id, patientid, DATE_FORMAT(opv_1stdose,'%m-%d-%Y') AS opv1, DATE_FORMAT(opv_2nddose,'%m-%d-%Y') AS opv2,
    DATE_FORMAT(opv_3rddose,'%m-%d-%Y') AS opv3, DATE_FORMAT(pcv_1stdose,'%m-%d-%Y') AS pcv1, DATE_FORMAT(pcv_2nddose,'%m-%d-%Y') AS pcv2,
    DATE_FORMAT(pcv_3rddose,'%m-%d-%Y') AS pcv3, DATE_FORMAT(ipv,'%m-%d-%Y') AS ipvdate, DATE_FORMAT(mmr1stdose,'%m-%d-%Y') AS mmr1, 
    DATE_FORMAT(mmr2nddose,'%m-%d-%Y') AS mmr2, DATE_FORMAT(fic_date,'%m-%d-%Y') AS fic,
    remarks, remarks1, remarks2, remarks3, remarks4, remarks5, remarks6, remarks7 
    FROM immunization INNER JOIN client ON immunization.patientid = client.id ORDER BY id ASC";  

    $userQuery = mysqli_query($con, "SELECT user_id, username, password, CONCAT(fname, ' ', lname) AS fullname from users WHERE type = 'bhw'");
    $user = mysqli_fetch_assoc($userQuery);
    $preparedByName = $user['fullname'];

    $result = mysqli_query($con, $sql);  
    if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result))  
    {       
        $output .= '<tr>    
        <td>'.(isset($row["opv1"]) && $row["opv1"] != '00-00-0000' ? $row["opv1"] : '').'</td>
        <td>'.(isset($row["opv2"]) && $row["opv2"] != '00-00-0000' ? $row["opv2"] : '').'</td>  
        <td>'.(isset($row["opv3"]) && $row["opv3"] != '00-00-0000' ? $row["opv3"] : '').'</td>
        <td>'.(isset($row["pcv1"]) && $row["pcv1"] != '00-00-0000' ? $row["pcv1"] : '').'</td>
        <td>'.(isset($row["pcv2"]) && $row["pcv2"] != '00-00-0000' ? $row["pcv2"] : '').'</td>  
        <td>'.(isset($row["pcv3"]) && $row["pcv3"] != '00-00-0000' ? $row["pcv3"] : '').'</td>  
        <td>'.(isset($row["ipvdate"]) && $row["ipvdate"] != '00-00-0000' ? $row["ipvdate"] : '').'</td>  
        <td>'.(isset($row["mmr1"]) && $row["mmr1"] != '00-00-0000' ? $row["mmr1"] : '').'</td>  
        <td>'.(isset($row["mmr2"]) && $row["mmr2"] != '00-00-0000' ? $row["mmr2"] : '').'</td>  
        <td>'.(isset($row["fic"]) && $row["fic"] != '00-00-0000' ? $row["fic"] : '').'</td> 
        <td>';
          $remarksArray = array(
            $row['remarks'],
            $row['remarks1'],
            $row['remarks2'],
            $row['remarks3'],
            $row['remarks4'],
            $row['remarks5'],
            $row['remarks6'],
            $row['remarks7']
          );

          foreach ($remarksArray as $remark) {
              if (!empty($remark)) {
                  $output .= nl2br($remark) . '<br>';
              }
          }

          $output .= '</td>    
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
  $obj_pdf->SetTitle("TCL Immunization Services");  
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
        <th rowspan="2" width="5%">No.</th>
        <th rowspan="2">Date of Registration</th>
        <th rowspan="2">Date of Birth</th>
        <th rowspan="2" style="font-weight: normal;"><b>SE Status</b>
          <br><b>1:</b> NHTS
          <br><b>2:</b> Non-NHTS
        </th>
        <th rowspan="2">Name of Child</th>
        <th rowspan="2">Sex</th>
        <th rowspan="2">Name of Mother</th>
        <th rowspan="2" width="15%">Complete Address</th>
        <th colspan="2">Child Protected at Birth (CPAB)</th>
      </tr>
      <tr>
        <th style="font-weight: normal;">TT2/Td2 given <br>to the mother <br>a month prior <br>to
          delivery <br>(for mothers <br>pregnant for the <br>first time)</th>
        <th style="font-weight: normal;">TT3/Td3 <br>to TT5/Td5 <br>(or TT1/Td1 <br>to TT5/Td5)
          <br>given to the <br>mother <br>anytime <br>prior to <br>delivery
        </th>
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
<br><h3 align="center">TARGET CLIENT LIST FOR IMMUNIZATION AND NUTRITION SERVICES FOR 0-12 MONTHS OLD</h3><br />
<table border="1" cellspacing="0" cellpadding="3" style="width: 100%; text-align: center;">
    <tr style="font-weight: bold;">
    <th colspan="6">NEWBORN (0-28 DAYS OLD)</th>
    <th colspan="3">1-3 MONTHS OLD</th>
</tr>
<tr style="font-weight: bold;">
    <th rowspan="3" style="font-weight: normal;"><b>Length at Birth</b> <br>(cm)</th>
    <th rowspan="3" style="font-weight: normal;"><b>Weight at Birth</b> <br>(kg)</th>
    <th>Status <br>(Birth Weight)</th>
    <th rowspan="3">Initiated breast feeding immediately after birth lasting for 90
        minutes</th>
    <th colspan="2">Immunization</th>
    <th colspan="3">Immunization</th>
</tr>
<tr style="font-weight: bold;">
    <th rowspan="2" style="font-weight: normal;"><b>L:</b> low: <br>
        <2,500 gms <br><b>N:</b> normal: <br>>2,500 gms <br><b>U:</b> unknown
    </th>
    <th rowspan="2">BCG</th>
    <th rowspan="2">Hepa B-BD</th>
    <th colspan="3">DPT-HIB-HepB</th>
</tr>
<tr>
    <th style="font-weight: normal;"><b>1st dose</b> <br>1 ½ mos</th>
    <th style="font-weight: normal;"><b>2nd dose</b> <br>2 ½ mos</th>
    <th style="font-weight: normal;"><b>3rd dose</b> <br>3 ½ mos</th>
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
<br><h3 align="center">TARGET CLIENT LIST FOR IMMUNIZATION AND NUTRITION SERVICES FOR 0-12 MONTHS OLD</h3><br />
<table border="1" cellspacing="0" cellpadding="3" style="width: 100%; text-align: center;">
    <tr style="font-weight: bold;">
    <th colspan="7">1-3 MONTHS OLD</th>
    <th>6-11 MONTHS OLD</th>
    <th colspan="2">12 MONTHS OLD</th>
    <th rowspan="4">Remarks</th>
</tr>
<tr style="font-weight: bold;">
    <th colspan="7">Immunization</th>
    <th rowspan="3">MMR Dose 1 at 9th month</th>
    <th rowspan="3">MMR Dose 2 at 12th month</th>
    <th rowspan="3">FIC</th>
</tr>
<tr style="font-weight: bold;">
    <th colspan="3">OPV</th>
    <th colspan="3">PCV</th>
    <th>IPV</th>
</tr>
<tr>
    <th><b>1st dose</b> <br>1 ½ mos</th>
    <th><b>2nd dose</b> <br>2 ½ mos</th>
    <th><b>3rd dose</b> <br>3 ½ mos</th>
    <th><b>1st dose</b> <br>1 ½ mos</th>
    <th><b>2nd dose</b> <br>2 ½ mos</th>
    <th><b>3rd dose</b> <br>3 ½ mos</th>
    <th>3 mos</th>
    </tr>';
 
    $content .= fetch_data2();
    $content .= '</table>';
    $obj_pdf->writeHTML($content);  

    $obj_pdf->Output('TCL-Immunization-Services.pdf', 'D');  
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

    <title>Immunization Services</title>
    <link rel="icon" href="../../img/logo.png">

    <style>
        #example td {
          vertical-align: middle;
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
                                <a href="../immunization/immunization.php" class="nav-link active">
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
              <h5 class="font-weight-bold text-center">TARGET CLIENT LIST FOR IMMUNIZATION AND
                NUTRITION SERVICES FOR 0-12 MONTHS OLD
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
                            <a class="dropdown-item" href="../main/download-immunization.php" style="font-size: 1.1em;">Excel Report</a>
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
                    $immunization = mysqli_query($con, "SELECT immunization_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
                    DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, se_status, CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, 
                    sex, mother_name, CONCAT(purok, ', ', address) AS caddress, cpab1, cpab2, length, weight, remarks FROM immunization 
                    INNER JOIN client ON immunization.patientid = client.id");
                    ?>

                        <table id="example" class="table table-bordered table-hover text-center" cellspacing="0"
                          width="100%">
                          <thead class="bg-light color-pallete">
                            <tr>
                              <th rowspan="2">Name of Child</th>
                              <th rowspan="2">Date of Registration</th>
                              <th rowspan="2">Sex</th>
                              <th rowspan="2" class="font-weight-normal"><b>Length at birth</b> <br>(cm)</th>
                              <th rowspan="2" class="font-weight-normal"><b>Weight at birth</b> <br>(kg)</th>
                              <th colspan="2">Child Protected at Birth (CPAB)</th>
                              <th rowspan="2">View</th>
                            </tr>
                            <tr>
                              <th class="font-weight-normal">TT2/Td2 given <br>to the mother</th>
                              <th class="font-weight-normal">TT3/Td3 to TT5/Td5 <br>(or TT1/Td1 to TT5/Td5)<br>
                                given to the mother
                              </th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php
                            while ($data = mysqli_fetch_array($immunization)) { ?>

                              <tr>
                                <td>
                              <a href="../immunization/immu-add-consult.php?id=<?php echo $data['patientid']; ?>" class="default-link"> 
                                  <?php echo $data['fullname']; ?>
                                </td>
                                <td>
                                  <?php echo $data['regdate']; ?>
                                </td>
                                <td>
                                  <?php echo $data['sex']; ?>
                                </td>
                                <td>
                                  <?php if ($data['length'] > 0) {
                                    echo $data['length'];
                                  }
                                  ; ?>
                                </td>
                                <td>
                                  <?php if ($data['weight'] > 0) {
                                    echo $data['weight'];
                                  }
                                  ; ?>
                                </td>
                                <td>
                                  <?php echo $data['cpab1']; ?>
                                </td>
                                <td>
                                  <?php echo $data['cpab2']; ?>
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
      header("Location: ../../index.php"); } ?>


  <!-- DataTables -->
  <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

  <!-- page script -->
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