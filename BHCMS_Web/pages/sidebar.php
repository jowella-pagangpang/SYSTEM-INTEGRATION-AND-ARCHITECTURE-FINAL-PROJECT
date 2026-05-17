<?php include('dbcon.php'); ?>

<style>
.non-clickable {
    pointer-events: none;
}
</style>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars fa-lg"></i></a>
        </li>
    </ul>

            <?php
                if ($_SESSION['type'] == "Barangay Health Worker") {
                $user = mysqli_query($con, "SELECT user_id, CONCAT(fname, ' ', lname) AS fullname, username, password, type from users WHERE type = 'bhw'");

                while ($data = mysqli_fetch_array($user)) {
            ?>

    <!-- Right navbar links -->
<ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
        <a class="nav-link font-weight-bold" data-toggle="dropdown" style="font-size:15px">
            <i class="far fa-user-circle fa-lg mr-1"></i>  <?php echo $_SESSION['type']; ?>
            <i class="fa fa-caret-down fa-m"></i>
        </a>

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item non-clickable">
                <!-- Message Start -->
                <div class="media">
                    <img src="../../img/bhw.png" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                    <div class="media-body">
                        <h2 class="dropdown-item-title" style="font-size: 18px;">
                            <?php echo $data['fullname']; ?>
                        </h2>
                        <p style="font-size: 15px;"><?php echo $_SESSION['type']; ?></p>
                        <p class="text-muted" style="font-size: 15px;">Administrator</p>
                    </div>
                </div>
                <!-- Message End -->
            </a>
                <div class="dropdown-divider"></div>
                <a href="../main/user.php?id=<?php echo $data['user_id']; ?>" class="dropdown-item">
                    <p class="text-center" style="font-size: 15px;"><i class="fas fa-cog"></i> Settings</p>
                </a>
                <div class="dropdown-divider"></div>
                <a href="../logout.php" class="dropdown-item">
                    <p class="text-center" style="font-size: 15px;"><i class="fas fa-sign-out-alt"></i> Log out</p>
                </a>
            </div>

        <?php } ?>
        </li>
    </ul>

    <?php } elseif ($_SESSION['type'] == "Nurse") {
    $user = mysqli_query($con, "SELECT user_id, CONCAT(fname, ' ', lname) AS fullname, username, password, type from users 
    WHERE type = 'nurse'");
    $data = mysqli_fetch_array($user)
    ?>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link font-weight-bold" data-toggle="dropdown" style="font-size:15px">
                <i class="far fa-user-circle fa-lg mr-1"></i>  <?php echo $_SESSION['type']; ?>
            <i class="fa fa-caret-down fa-m"></i></a>

            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item non-clickable">
            <!-- Message Start -->
            <div class="media">
              <img src="../../img/nurse.png" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h2 class="dropdown-item-title" style="font-size: 16px;">
                    <?php echo $data['fullname']; ?>
                </h2>
                <p class="text-sm">Barangay <?php echo $_SESSION['type']; ?></p>
                <p class="text-sm text-muted"></p>
              </div>
            </div>
            <!-- Message End -->
          </a>
                <div class="dropdown-divider"></div>
                <a href="../main/user-nurse.php?id=<?php echo $data['user_id']; ?>" class="dropdown-item">
                    <p class="text-center" style="font-size: 15px;"><i class="fas fa-cog"></i> Settings</p>
                </a>
                <div class="dropdown-divider"></div>
                <a href="../logout.php" class="dropdown-item">
                    <p class="text-center" style="font-size: 15px;"><i class="fas fa-sign-out-alt"></i> Log out</p>
                </a>

<?php } ?>
</nav>
<!-- /.navbar -->
