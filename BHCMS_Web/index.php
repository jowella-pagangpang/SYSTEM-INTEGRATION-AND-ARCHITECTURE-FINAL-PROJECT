<!DOCTYPE html>
<html>

<?php
ob_start();
session_start();
?>

<head>

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Health Record Management</title>

<link rel="icon" href="img/logo.png">

<link rel="stylesheet"
href="plugins/fontawesome-free/css/all.min.css">

<link rel="stylesheet"
href="dist/css/adminlte.min.css">

<link rel="stylesheet"
href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<style>

.card-header{
padding:0rem;
}

</style>

</head>

<body class="hold-transition login-page" style="background-image:url('img/brgyhall.jpg'); background-size:cover;">

  <div class="login-box" style="font-family:Helvetica; width:40%;">
    <div class="card card-dark card-tabs">
      <div class="card-body">
        <form method="post">
          <img src="img/basak logo.png" style="height:35%; width:35%;" class="login-box-msg rounded mx-auto d-block">
          <h5 class="text-center font-weight-bold">HEALTH RECORD MANAGEMENT<hr></h5>
          <p class="text-center font-weight-bold">Barangay Health Worker</p>
          <div class="input-group mb-3">
            <input type="text" class="form-control text-center" name="username" required value="bhwadmin">
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control text-center" name="password" id="password" required value="bhwpassword">
            <div class="input-group-append">
              <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
                <i id="eyeIcon" class="fas fa-eye"></i>
              </button>
            </div>
          </div>
          <button type="submit" class="btn btn-dark btn-block" name="login1">LOG IN</button>
          <?php
            if(isset($_POST['login1']))
            {
              $username = $_POST['username'];
              $password=$_POST['password'];
              if($username=="bhwadmin" && $password=="bhwpassword")
              {
                $_SESSION['type']="Barangay Health Worker";
                $_SESSION['uid']=1;
                header("location:pages/main/dashboard.php");
                exit();
              }else
              {
                echo
                "<script>
                  alert('Incorrect username or password');
                </script>";
              }
            }
          ?>
        </form>
      </div>
    </div>
  </div>

  <script>
  function togglePassword()
  {
    let password=document.getElementById("password");
    let eye=document.getElementById("eyeIcon");
    if(password.type==="password")
    {
      password.type="text";
      eye.classList.remove("fa-eye");
      eye.classList.add("fa-eye-slash");
    }else
    {
      password.type="password";
      eye.classList.remove("fa-eye-slash");
      eye.classList.add("fa-eye");
    }
  }

</script>

</body>

</html>