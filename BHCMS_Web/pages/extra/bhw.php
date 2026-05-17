
<?php
    if ($_SESSION['type'] == "Barangay Health Worker") {
        ?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <h1 class="brand-link text-center">
        <span class="brand-text font-weight-bold" style="font-family: Helvetica; font-size: 17px;">
            Health Record Management
        </span>
    </h1>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar panel -->
        <div class="user-panel pb-3 mb-3">
            <center><img src="../../img/logo.png" style="height: 45%; width: 45%;" alt="logo"></center>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2" style="font-family: Helvetica;">
                <ul class="nav nav-pills nav-sidebar flex-column text-sm" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="../main/dashboard.php" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
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
                                    <p>Immunization (0-12 mos. old)</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="../deworming1/deworming1-4.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Deworming (1-4 years old)</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="../deworming2/deworming5-9.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Deworming (5-9 years old)</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="../deworming3/deworming10-19.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Deworming (10-19 years old)</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="../nutrition1/nutrition1.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Nutrition and EPI Program I</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="../nutrition2/nutrition2.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Nutrition and EPI Program II</p>
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
                                <a href="../main/weekly.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Weekly Report</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="../main/monthly.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Monthly Report</p>
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





</div>
<!-- ./wrapper -->

<? } ?>