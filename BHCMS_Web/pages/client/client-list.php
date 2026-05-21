<!DOCTYPE html>
<html lang="en">

<?php include('../dbcon.php');

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

            <title>Client List</title>
            <link rel="icon" href="../../img/logo.png">
            <link rel="stylesheet" href="styles.css">

            <style> 
            #example thead th,
            #example td {
              vertical-align: middle;
            }
            .card-header {
                padding: 0.75rem 1.25rem;
                margin-bottom: 0;
                border-bottom: 1px solid rgba(0,0,0,.125) 
            }
        
            /* Tooltip container styles */
            .tooltip {
                position: relative;
                display: inline-block;
                cursor: pointer;
            }

            /* Tooltip text (hidden by default) */
            .tooltip .tooltiptext {
                visibility: hidden;
                width: 120px;
                background-color: #333;
                color: #fff;
                text-align: center;
                border-radius: 5px;
                padding: 5px;
                position: absolute;
                z-index: 1;
                top: -30px; /* Position above the button */
                left: 50%;
                transform: translateX(-50%);
                opacity: 0;
                transition: opacity 0.3s;
            }

            /* Show the tooltip when hovering over the button */
            .tooltip:hover .tooltiptext {
                visibility: visible;
                opacity: 1;
            }
            .dropdown-toggle::after {
                display: none; /* Hide the default arrow-down button */
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
                <center><img src="../../img/basak logo.png" style="height: 40%; width: 40%;" alt="logo"></center>
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
                        <a href="../client/client-list.php" class="nav-link active">
                            <i class="nav-icon fas fa-user-plus"></i>
                            <p>
                                Client
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="fas fa-notes-medical nav-icon"></i>
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

            <form method="post">
                <div class="card-body d-flex flex-column">
                    <div class="card-block">
                        <div class="row">
                            <div class="col-2">
                                <button type="button"
                                    class="btn btn-primary bg-gradient-primary btn-block btn-sm"
                                    data-toggle="modal" data-target="#add-client"><i
                                        class="nav-icon fas fa-user-plus"></i> Add new client
                                </button>
                            </div>
                        </div>
                    </div>

                    <br>
    
                    <table id="example" class="table table-bordered table-hover text-center">
                        <thead>
                            <tr class="bg-lightblue color-palette">
                                <th>Id</th>
                                <th>Name</th>
                                <th>Date of Birth</th>
                                <th>Sex</th>
                                <th>Name of Mother</th>
                                <th>Complete Address</th>
                                <th>Age</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                    <?php
                    $query = mysqli_query($con, "SELECT id, DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
            CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, sex, mother_name, 
            CONCAT(purok, ', ', address) AS caddress FROM client");

            while ($data = mysqli_fetch_array($query)) {
                $birthdate = $data['birthdate'];
                $birthDateObj = DateTime::createFromFormat('m-d-Y', $birthdate);

                if ($birthDateObj === false) {
                    echo "Failed to parse the birthdate.";
                } else {
                    $currentDateObj = new DateTime();
                    $age = $birthDateObj->diff($currentDateObj);

                    $years = $age->y;
                    $months = $age->m;

                    $data['age'] = $years;

                    ?>
                <tr>
                    <td>
                        <?php echo $data['id']; ?>
                    </td>
                    <td>
                        <?php echo $data['fullname']; ?>
                    </td>
                    <td>
                        <?php echo $data['birthdate']; ?>
                    </td>
                    <td>
                        <?php echo $data['sex']; ?>
                    </td>
                    <td>
                        <?php echo $data['mother_name']; ?>
                    </td>
                    <td>
                        <?php echo $data['caddress']; ?>
                    </td>
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
                              
                                <a href="editclient.php?id=<?php echo $data['id']; ?>">
                                <button type="button" class="btn btn-success btn-sm"
                                data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="nav-icon fas fa-pen" aria-hidden="true"></i>
                                </button>
                                </a>
                            <button id="healthServiceButton" class="dropdown btn btn-warning btn-sm dropdown-toggle" 
                                type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                data-placement="top" data-toggle="tooltip" title="Select health service">
                                <i class="nav-icon fas fa-plus"></i>
                            </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="immunization-record.php?id=<?php echo $data['id']; ?>" style="font-size: 1.1em;">Immunization Services</a>
                            <a class="dropdown-item" href="deworming-record.php?id=<?php echo $data['id']; ?>" style="font-size: 1.1em;">Deworming Services</a>
                            <a class="dropdown-item" href="nutrition2-record.php?id=<?php echo $data['id']; ?>" style="font-size: 1.1em;">Nutrition Program</a>

                            <?php
                            if ($data['age'] <= 19) {
                                ?>
                                <a class="dropdown-item" href="sickchildren-record.php?id=<?php echo $data['id']; ?>" style="font-size: 1.1em;">Sick Children</a>
                                <?php
                            } else {
                                ?>
                                <a class="dropdown-item" href="consult-record.php?id=<?php echo $data['id']; ?>" style="font-size: 1.1em;">General Consultation</a>
                                <?php
                            }
                            ?>
                            
                            <?php
                            // if the client is male
                            if ($data['sex'] == 'M') {
                                ?>
                                <a class="dropdown-item" href="maternal-record.php?id=<?php echo $data['id']; ?>" style="font-size: 1.1em; display: none;">Maternal Care</a>
                                <a class="dropdown-item" href="postpartum-record.php?id=<?php echo $data['id']; ?>" style="font-size: 1.1em; display: none;">Postpartum Care</a>
                                <?php
                            } else {
                                // if the client is female
                                ?>
                                <a class="dropdown-item" href="maternal-record.php?id=<?php echo $data['id']; ?>" style="font-size: 1.1em;">Maternal Care</a>
                                <a class="dropdown-item" href="postpartum-record.php?id=<?php echo $data['id']; ?>" style="font-size: 1.1em;">Postpartum Care</a>
                                <?php
                            }
                            ?>
                        </div>
                                <a href="client-record.php?id=<?php echo $data['id']; ?>">
                                    <button type="button" class="btn btn-sm bg-maroon color-palette" 
                                    data-toggle="tooltip" data-placement="top" title="Historical data">
                                    <i class="nav-icon fas fa-folder"></i></button>
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

        </form>

                        
            <?php include('add-new-client.php'); ?>

                </div>
            </div>
        </section>
    </div>
</div>
<!-- ./wrapper -->


<script src="script.js"></script>

<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>


<script>
    $(document).ready(function () {
        $('#example').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

        var table = $('#example').DataTable();
        $('#example_filter input').on('keyup', function() {
            var searchTerm = this.value;
            table.column([1]).search(searchTerm).draw();
        });

        $('[data-toggle="tooltip"]').tooltip();
        $('#healthServiceButton').tooltip({
            placement: 'top',
            trigger: 'hover'
        });
        $('#healthServiceButton').dropdown();
    });
</script>

            <?php } elseif ($_SESSION['type'] == "Nurse") { ?>


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
            <center><img src="../../img/basak logo.png" style="height: 40%; width: 40%;" alt="logo"></center>
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
                    <a href="../client/client-list.php" class="nav-link active">
                        <i class="nav-icon fas fa-user-plus"></i>
                        <p>
                            Client
                        </p>
                    </a>
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
                                <p> Custom Report</p>
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

        <form method="post">
            <div class="card-body d-flex flex-column">
                <div class="card-block">
                    <div class="row">
                    </div>
                </div>

                <br>

                <table id="example" class="table table-bordered table-hover text-center">
                    <thead>
                        <tr class="bg-lightblue color-palette">
                            <th>Id</th>
                            <th>Name</th>
                            <th>Date of Birth</th>
                            <th>Sex</th>
                            <th>Name of Mother</th>
                            <th>Complete Address</th>
                            <th>Age</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                <?php
                $query = mysqli_query($con, "SELECT id, DATE_FORMAT(birth_date,'%m-%d-%Y') AS birthdate, 
        CONCAT(fname, ' ', minitial, ' ', lname) AS fullname, sex, mother_name, 
        CONCAT(purok, ', ', address) AS caddress FROM client");

        while ($data = mysqli_fetch_array($query)) {
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
            <tr>
                <td>
                    <?php echo $data['id']; ?>
                </td>
                <td>
                    <?php echo $data['fullname']; ?>
                </td>
                <td>
                    <?php echo $data['birthdate']; ?>
                </td>
                <td>
                    <?php echo $data['sex']; ?>
                </td>
                <td>
                    <?php echo $data['mother_name']; ?>
                </td>
                <td>
                    <?php echo $data['caddress']; ?>
                </td>
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
                       
                            <a href="client-record.php?id=<?php echo $data['id']; ?>">
                                <button type="button" class="btn btn-sm bg-maroon color-palette" 
                                data-toggle="tooltip" data-placement="top" title="Historical data">
                                <i class="nav-icon fas fa-folder"></i></button>
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

    </form>


            </div>
        </div>
    </section>
</div>
</div>
<!-- ./wrapper -->


            <script src="script.js"></script>

            <!-- DataTables -->
            <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
            <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
            <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
            <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

            <script>
                $(function () {
                    $('#example').DataTable({
                        "paging": false,
                        "lengthChange": false,
                        "searching": false,
                        "ordering": false,
                        "info": false,
                        "autoWidth": false,
                        "responsive": true,
                    });
                });
                $(document).ready(function() {
                    var table = $('#example').DataTable();

                    $('#example_filter input').on('keyup', function() {
                        var searchTerm = this.value;
                
                        table.column([1]).search(searchTerm).draw();
                    });
                });

                $(function () {
                    $('[data-toggle="tooltip"]').tooltip()
                })
            </script>

<?php  } ?>
    <?php } ?>
</body>

</html>