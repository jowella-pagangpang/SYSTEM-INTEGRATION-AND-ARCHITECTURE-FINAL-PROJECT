<?php  
function fetch_data()  
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
    remarks_1week FROM postpartum INNER JOIN client ON postpartum.patientid = client.id ORDER BY id ASC";  

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

if(isset($_POST["generate_pdf"]))  
{  
     require_once('../pdf_export/tcpdf/tcpdf.php');  
     $obj_pdf = new TCPDF('L', PDF_UNIT, 'LETTER', true, 'UTF-8', false);
     $obj_pdf->SetCreator(PDF_CREATOR);  
     $obj_pdf->SetTitle("TCL Postpartum Care");  
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
$content .= fetch_data();
$content .= '</table>';

     $obj_pdf->writeHTML($content);  
     $obj_pdf->Output('TCL-Postpartum-Care.pdf', 'D');  
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

    <title>Postpartum Care</title>
    <link rel="icon" href="../../img/logo.png">
    <style type="text/css">
      
        #example td {
          vertical-align: middle;
        }

      td {
        border: 1px solid #ccc;
        padding: 10px;
        position: relative;
        /* Important for absolute positioning */
      }

      .highlight:hover {
        background-color: #ffc107;
      }

      .tooltips-trigger {
        text-decoration: underline;
        cursor: pointer;
      }

      .tooltips {
        display: none;
        position: absolute;
        bottom: 60px;
        left: 0;
        background-color: #f9f9f9;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        z-index: 1;
        /* Ensure tooltips appears on top of other content */
      }

      .tooltips form {
        margin: 0;
      }

      .tooltips form label,
      .tooltips form textarea {
        display: block;
        margin-bottom: 10px;
        width: 200px;
        /* Adjust the width as needed */
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


      .tooltips-trigger1 {
        text-decoration: underline;
        cursor: pointer;
      }

      .tooltips1 {
        display: none;
        position: absolute;
        bottom: 60px;
        left: 0;
        background-color: #f9f9f9;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        z-index: 1;
        /* Ensure tooltips appears on top of other content */
      }

      .tooltips1 form {
        margin: 0;
      }

      .tooltips1 form label,
      .tooltips1 form textarea {
        display: block;
        margin-bottom: 10px;
        width: 200px;
        /* Adjust the width as needed */
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
                      <a href="../postpartum/postpartum.php" class="nav-link active">
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
                  <h5 class="font-weight-bold text-center">TARGET CLIENT LIST FOR POSTPARTUM CARE</h5>

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
                            <a class="dropdown-item" href="../main/download-postpartum.php" style="font-size: 1.1em;">Excel Report</a>
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
                    $postpartum = mysqli_query($con, "SELECT id, postpartum_id, patientid, DATE_FORMAT(delivery_date,'%m-%d-%Y') AS deliverydate, delivery_time, 
                    CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, purok, address, 
                    DATE_FORMAT(date_visit_24hr,'%m-%d-%Y') AS visit24hr, DATE_FORMAT(date_visit_1week,'%m-%d-%Y') AS visit1week, 
                    DATE_FORMAT(date_breastfeed,'%m-%d-%Y') AS datebreastfeed, time_breastfeed, 
                    DATE_FORMAT(iron_supplementation_1stdate,'%m-%d-%Y') AS iron1stdate, 1stdate_tablets, 
                    DATE_FORMAT(iron_supplementation_2nddate,'%m-%d-%Y') AS iron2nddate, 2nddate_tablets, 
                    DATE_FORMAT(iron_supplementation_3rddate,'%m-%d-%Y') AS iron3rddate, 3rddate_tablets, 
                    DATE_FORMAT(vitamin_supplementation_date,'%m-%d-%Y') AS vitamindate, remarks, remarks_24hr, 
                    remarks_1week FROM postpartum INNER JOIN client ON postpartum.patientid = client.id"); ?>

                    <table id="example" class="table table-bordered table-hover text-center">
                      <thead class="bg-light color-pallete"> 
                        <tr>
                          <th rowspan="2">Name</th>
                          <th rowspan="2">Date and Time of Delivery</th>
                          <th colspan="2">Date Postpartum Visits</th>
                          <th rowspan="2">Date and Time <br>Initiated Brestfeeding</th>
                          <th rowspan="2">View</th>
                        </tr>
                        <tr>
                          <th>Within 24 hours <br>after delivery</th>
                          <th>Within 1 week <br>after delivery</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php
                        while ($data = mysqli_fetch_array($postpartum)) { ?>

                          <tr>
                            <td>
                              <a href="../postpartum/postpartum-add-consult.php?pid=<?php echo $data['patientid']; ?>" class="default-link"> 
                              <?php echo $data['fullname']; ?>
                            </td>
                            <td>
                              <?php echo $data['deliverydate']; ?> <br>
                              <?php echo $data['delivery_time']; ?>
                            </td>
                            <td>
                            <?php if ($data['visit24hr'] != '00-00-0000') { ?>
                            <a class="tooltips-trigger highlight" data-tooltip-id="<?php echo $data['postpartum_id']; ?>-1" 
                              data-toggle="tooltip" data-placement="top" data-original-title="<?php echo $data['remarks_24hr']; ?>">
                              <?php echo $data['visit24hr']; ?>
                            </a>
                          <?php } ?>
                        <div class="tooltips" data-tooltip-id="<?php echo $data['postpartum_id']; ?>-1">
                          <?php
                          $remarks1 = $data['remarks_24hr'];
                          if ($remarks1 == NULL) { ?>
                            <form action="remarks.php" method="post">
                              <label>Remarks</label>
                              <p>Within 24 hours after delivery:</p>
                              <textarea id="remarks" name="remarks_24hr" rows="5"></textarea>
                              <input type="hidden" name="id" value="<?php echo $data['postpartum_id']; ?>">
                              <input type="submit" name="submit1" value="Enter">
                            </form>
                          <?php } else { ?>
                            <form action="remarks.php" method="post">
                              <label>Remarks</label>
                              <p>Within 24 hours after delivery:</p>
                              <textarea id="remarks" name="remarks_24hr" rows="5"><?php echo $remarks1; ?></textarea>
                              <input type="hidden" name="id" value="<?php echo $data['postpartum_id']; ?>">
                              <input type="submit" name="submit1" value="Enter">
                            </form>
                          <?php } ?>
                        </div>
                      </td>

                            <td>
                              <?php if ($data['visit1week'] != '00-00-0000') { ?>
                                  <a class="tooltips-trigger1 highlight" data-tooltip-id="<?php echo $data['postpartum_id']; ?>-2" 
                              data-toggle="tooltip" data-placement="top" data-original-title="<?php echo $data['remarks_1week']; ?>">
                                  <?php echo $data['visit1week']; ?></a>
                              <?php } ?>
                              <div class="tooltips1" data-tooltip-id="<?php echo $data['postpartum_id']; ?>-2">
                                <?php
                                $remarks2 = $data['remarks_1week'];
                                if ($remarks2 == NULL) { ?>
                                  <form action="remarks.php" method="post">
                                    <label>Remarks</label>
                                    <p>Within 1 week after delivery:</p>
                                    <textarea id="remarks" name="remarks_1week" rows="5"></textarea>
                                    <input type="hidden" name="id" value="<?php echo $data['postpartum_id']; ?>">
                                    <input type="submit" name="submit2" value="Enter">
                                  </form>
                                <?php } else { ?>
                                  <form action="remarks.php" method="post">
                                    <label>Remarks</label>
                                    <p>Within 1 week after delivery:</p>
                                    <textarea id="remarks" name="remarks_1week"
                                      rows="5"><?php echo $data['remarks_1week']; ?></textarea>
                                    <input type="hidden" name="id" value="<?php echo $data['postpartum_id']; ?>">
                                    <input type="submit" name="submit2" value="Enter">
                                  </form>
                                <?php } ?>
                              </div>
                            </td>
                            <td>
                              <?php if ($data['datebreastfeed'] != '00-00-0000') {
                                echo $data['datebreastfeed'];
                              }
                              ; ?> <br>
                              <?php if ($data['time_breastfeed'] > 0) {
                                echo $data['time_breastfeed'];
                              }
                              ; ?>
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
    <script src="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
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

document.addEventListener("DOMContentLoaded", function () {
    const tooltipsTriggers = document.querySelectorAll(".tooltips-trigger");
    const tooltips = document.querySelectorAll(".tooltips");
    const tooltipsTriggers1 = document.querySelectorAll(".tooltips-trigger1");
    const tooltips1 = document.querySelectorAll(".tooltips1");

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