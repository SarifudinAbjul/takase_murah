<?php 

session_start();
require "db/koneksi.php";

// if(isset($_SESSION['login']))
// {
//   header('Location:index.php');
//   exit;
// }

if(isset($_POST['login']) )
{
  $username = $_POST['username'];
  $password = $_POST['password'];

  $result = $koneksi->query("SELECT * FROM admin WHERE username='$username'");
  
// cek username
  if(mysqli_num_rows($result) === 1 )
  {
    $row = $result->fetch_assoc();
      // cek password
      if(password_verify($password, $row["password"]))
      {

        $_SESSION['login'] = true;
        // set coockie
        // if(isset($_POST['remember']) )
        // {
          
        // }
        header('Location:index.php');
        exit;
      }

  }

  $error = true;

}
 ?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Takase Murah</title>
  <!-- BOOTSTRAP STYLES-->
  <link href="assets/css/bootstrap.css" rel="stylesheet" />
  <!-- FONTAWESOME STYLES-->
  <link href="assets/css/font-awesome.css" rel="stylesheet" />
  <!-- CUSTOM STYLES-->
  <link href="assets/css/custom.css" rel="stylesheet" />
  <!-- GOOGLE FONTS-->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
  <div class="container">
    <div class="row text-center ">
      <div class="col-md-12">
        <br /><br />
        <h2> Takase Murah: Login</h2>

        <h5>( Login yourself to get access )</h5>
        <br />
      </div>
    </div>
    <div class="row ">

      <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">
            <strong>   Enter Details To Login </strong>  
          </div>
          <?php if(isset($error)): ?>
            <div class="alert alert-danger" role="alert">
              <p>Password / Username Tidak sesuai</p>
            </div>
          <?php endif; ?>
          <div class="panel-body">
           <form role="form" method="post">
             <br />
             <div class="form-group input-group">
              <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
              <input type="text" class="form-control" name="username" placeholder="Your Username " />
            </div>
            <div class="form-group input-group">
              <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
              <input type="password" class="form-control" name="password"  placeholder="Your Password" />
            </div>
            <div class="form-group">
              <label class="checkbox-inline">
                <input type="checkbox" name="remember" /> Remember me
              </label>
              <span class="pull-right">
               <a href="#" >Forget password ? </a> 
             </span>
           </div>
           <button class="btn btn-primary" name="login">Login</button>
           <hr />
           Not register ? <a href="register.php" >click here </a> 
         </form>
       </div>

     </div>
   </div>


 </div>
</div>

<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
<!-- JQUERY SCRIPTS -->
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- METISMENU SCRIPTS -->
<script src="assets/js/jquery.metisMenu.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="assets/js/custom.js"></script>

</body>
</html>
