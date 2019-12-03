<?php 
session_start();
include "admin/db/koneksi.php";

if(isset($_POST['login']) )
{
	$email = $_POST['email'];
	$password = $_POST['password'];

	$result = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan = '$email' AND password_pelanggan = '$password'");


	if(mysqli_num_rows($result) === 1)
	{
		$akun = $result->fetch_assoc();

		$_SESSION["pelanggan"] = $akun;

    if($_SESSION["keranjang"] == 0)
    {
      header("Location:index.php");
      exit;
    }
    else
    {
    header("Location:checkout.php");
    exit;
    }
	}
	else
	{
		$error = true;
	}

}


 ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Takase Murah</title>
  <!-- BOOTSTRAP STYLES-->
  <link href="admin/assets/css/bootstrap.css" rel="stylesheet" />
  <!-- FONTAWESOME STYLES-->
  <link href="admin/assets/css/font-awesome.css" rel="stylesheet" />
  <!-- CUSTOM STYLES-->
  <link href="admin/assets/css/custom.css" rel="stylesheet" />
  <!-- GOOGLE FONTS-->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
<!-- navbar -->
  <?php include "menu.php"; ?>
<!-- navbar -->
  <div class="container">
    <div class="row text-center ">
      <div class="col-md-12">
        <br /><br />
        <h2> Takase Murah: Login </h2>
        <h5>(Untuk Melanjutkan Pembelian)</h5>
        <br />
      </div>
    </div>
    <div class="row ">

      <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">
            <strong>   Masukkan Email dan Password untuk login </strong>  
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
              <input type="email" class="form-control" name="email" placeholder="Your Email " />
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
               <a href="#" >lupa Password ? </a> 
             </span>
           </div>
           <button class="btn btn-primary" name="login">Login</button>
           <hr />
          Silahkan Daftar Jika Belum Punya akun ? <a href="daftar.php" >Daftar</a> 
         </form>
       </div>

     </div>
   </div>


 </div>
</div>

<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
<!-- JQUERY SCRIPTS -->
<script src="admin/assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="admin/assets/js/bootstrap.min.js"></script>
<!-- METISMENU SCRIPTS -->
<script src="admin/assets/js/jquery.metisMenu.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="admin/assets/js/custom.js"></script>

</body>
</html>