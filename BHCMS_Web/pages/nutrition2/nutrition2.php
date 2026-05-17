<?php  
function fetch_data()  
{  
    $output = '';  
    $con = mysqli_connect("localhost", "root", "", "healthrecord");  
    $sql = "SELECT id, nutrition2_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
    DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, 
    weight, height, sex, 6to11mos, 12to59mos, mother_name, CONCAT(purok, ', ', address) AS caddress FROM nutrition2 
    INNER JOIN client ON nutrition2.patientid = client.id ORDER BY id ASC";  

    $result = mysqli_query($con, $sql);  
    while($row = mysqli_fetch_array($result))  
    {       

        $output .= '<tr>  
        <td>'.$row["nutrition2_id"].'</td>  
        <td>'.$row["regdate"].'</td>  
        <td>'.$row["birthdate"].'</td>  
        <td>'.$row["fullname"].'</td>
        <td>'.(isset($row["weight"]) && $row["weight"] > 0 ? $row["weight"] : '').'</td>
        <td>'.(isset($row["height"]) && $row["height"] > 0 ? $row["height"] : '').'</td>
        <td>'.$row["sex"].'</td>
        <td>'.$row["mother_name"].'</td>
        <td>'.$row["caddress"].'</td> 
        </tr>'; 
    }  
    return $output;
}

function fetch_data1()  
{  
    $output = '';  
    $con = mysqli_connect("localhost", "root", "", "healthrecord");  
    $sql = "SELECT nutrition2_id, patientid, DATE_FORMAT(vitamina,'%m-%d-%Y') AS vitamin, 
    DATE_FORMAT(vitamin1,'%m-%d-%Y') AS vitamindose1, DATE_FORMAT(vitamin2,'%m-%d-%Y') AS vitamindose2, 
    DATE_FORMAT(iron1,'%m-%d-%Y') AS irondose1, DATE_FORMAT(iron2,'%m-%d-%Y') AS irondose2, 
    DATE_FORMAT(mnp1,'%m-%d-%Y') AS mnpdose1, DATE_FORMAT(mnp2,'%m-%d-%Y') AS mnpdose2, 
    DATE_FORMAT(deworming,'%m-%d-%Y') AS dewormings, remarks, remarks1 FROM nutrition2 
    INNER JOIN client ON nutrition2.patientid = client.id ORDER BY id ASC";  

    $userQuery = mysqli_query($con, "SELECT user_id, username, password, CONCAT(fname, ' ', lname) AS fullname from users WHERE type = 'bhw'");
    $user = mysqli_fetch_assoc($userQuery);
    $preparedByName = $user['fullname'];

    $result = mysqli_query($con, $sql);  
    if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result))  
    {       

        $output .= '<tr>  
        <td>'.(isset($row["vitamin"]) && $row["vitamin"] != '00-00-0000' ? $row["vitamin"] : '').'</td>
        <td>'.(isset($row["vitamindose1"]) && $row["vitamindose1"] != '00-00-0000' ? $row["vitamindose1"] : '').'</td>
        <td>'.(isset($row["vitamindose2"]) && $row["vitamindose2"] != '00-00-0000' ? $row["vitamindose2"] : '').'</td>
        <td>'.(isset($row["irondose1"]) && $row["irondose1"] != '00-00-0000' ? $row["irondose1"] : '').'</td>
        <td>'.(isset($row["irondose2"]) && $row["irondose2"] != '00-00-0000' ? $row["irondose2"] : '').'</td>
        <td>'.(isset($row["mnpdose1"]) && $row["mnpdose1"] != '00-00-0000' ? $row["mnpdose1"] : '').'</td>
        <td>'.(isset($row["mnpdose2"]) && $row["mnpdose2"] != '00-00-0000' ? $row["mnpdose2"] : '').'</td>
        <td>'.(isset($row["dewormings"]) && $row["dewormings"] != '00-00-0000' ? $row["dewormings"] : '').'</td>     
        <td>' . (
            ($row['vitamin'] || $row['irondose1'] || $row['mnpdose1'] != '00-00-0000') ? nl2br($row['remarks1']) : ''
        ) . (
            ($row['vitamindose1'] || $row['vitamindose2'] || $row['irondose2'] || $row['mnpdose2'] || $row['dewormings'] != '00-00-0000') ? nl2br($row['remarks']) : ''
        ) . '</td>   
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
     $obj_pdf->SetTitle("TCL Nutrition EPI");  
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
          <th width="5%">No.</th>
          <th>Date of Registration</th>
          <th>Date of Birth</th>
          <th width="15%">Name of Child</th>
          <th>Weight</th>
          <th>Height</th>
          <th>Sex</th>
          <th>Name of Mother</th>
          <th width="15%">Complete Address</th>
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
    <br><h3 align="center">TARGET CLIENT LIST FOR NUTRITION AND EXPANDED PROGRAM FOR IMMUNIZATION</h3><br />
    <table border="1" cellspacing="0" cellpadding="3" style="width: 100%; text-align: center;">
        <tr style="font-weight: bold;">
            <th colspan="7">Micronutrient Supplementation</th>
            <th rowspan="2">Deworming</th>
            <th rowspan="4">Remarks</th>
        </tr>
        <tr style="font-weight: bold;">
            <th colspan="3">Vitamin A</th>
            <th colspan="2">Iron</th>
            <th colspan="2">MNP</th>
        </tr>
        <tr style="font-weight: bold;">
            <th rowspan="2">6-11 mos.</th>
            <th colspan="2">12-59 mos.</th>
            <th rowspan="2">6-11 mos.</th>
            <th rowspan="2">12-59 mos.</th>
            <th rowspan="2">6-11 mos.</th>
            <th rowspan="2">12-23 mos.</th>
            <th rowspan="2">12-59 mos.</th>
        </tr>
        <tr style="font-weight: bold;">
            <th>Dose 1</th>
            <th>Dose 2</th>
        </tr>';
    $content .= fetch_data1();
    $content .= '</table>';
    $obj_pdf->writeHTML($content);

    $obj_pdf->Output('TCL-Nutrition-EPI.pdf', 'D');  
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

    <title>Nutrition Program</title>
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
                      <a href="../nutrition2/nutrition2.php" class="nav-link active">
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
                  <h5 class="font-weight-bold text-center">TARGET CLIENT LIST FOR NUTRITION AND
                    EXPANDED PROGRAM FOR IMMUNIZATION</h5>

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
                            <a class="dropdown-item" href="../main/download-n2.php" style="font-size: 1.1em;">Excel Report</a>
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
                      $nutrition2 = mysqli_query($con, "SELECT nutrition2_id, patientid, DATE_FORMAT(reg_date,'%m-%d-%Y') AS regdate, 
                DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, 
                weight, height, sex, 6to11mos, 12to59mos, 
                mother_name, CONCAT(purok, ', ', address) AS caddress FROM nutrition2 
                INNER JOIN client ON nutrition2.patientid = client.id ORDER BY regdate DESC");
                      ?>

                          <table id="example" class="table table-bordered table-hover text-center" cellspacing="0"
                            width="100%">
                            <thead class="bg-light color-pallete">
                              <tr>
                                <th>Name of Child</th>
                                <th>Date of Registration</th>
                                <th>Sex</th>
                                <th class="font-weight-normal"><b>Weight</b> (kg)</th>
                                <th class="font-weight-normal"><b>Height</b> (cm)</th>
                                <th>View</th>
                              </tr>
                            </thead>
                            <tbody>

                              <?php
                              while ($data = mysqli_fetch_array($nutrition2)) { ?>

                                <tr>
                                  <td>
                              <a href="../nutrition2/nutrition-consult.php?nid=<?php echo $data['patientid']; ?>" class="default-link">
                                    <?php echo $data['fullname']; ?>
                                  </td>
                                  <td>
                                    <?php echo $data['regdate']; ?>
                                  </td>
                                  <td>
                                    <?php echo $data['sex']; ?>
                                  </td>
                                  <td>
                                    <?php if ($data['weight'] > 0) {
                                      echo $data['weight'] . ' kg';
                                    }
                                    ; ?>
                                  </td>
                                  <td>
                                    <?php if ($data['height'] > 0) {
                                      echo $data['height'] . ' cm';
                                    }
                                    ; ?>
                                  </td>
                                  <td>
                                      <a href="../client/nutrition2-record.php?id=<?php echo $data['patientid']; ?>">
                                        <button type="button" class="btn btn-primary btn-sm">
                                          <i class="nav-icon fas fa-eye"></i> </button>
                                      </a>
                                  </td>
                                </tr>

                                <?php
                              } ?>
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
        header("Location: ../../index.php");
      } ?>


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

      $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        $($.fn.dataTable.tables(true)).DataTable().columns.adjust().responsive.recalc();
      }); 
    </script>

  <?php } ?>

</body>

</html>