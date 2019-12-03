<?php 
session_start();
include "admin/db/koneksi.php";

if(isset($_POST['daftar']) )
{
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $telp = $_POST['telp'];
  $alamat = $_POST['alamat'];

  $result = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email'");

  if(mysqli_num_rows($result) == 1)
  {
    $error = true;
    // echo "<script>
    //         alert('pendaftaran gagal, email telah digunakan');
    //       </script>";
  }
  else
  {
    $koneksi->query("INSERT INTO pelanggan VALUES(NULL, '$email', '$password', '$nama', '$telp', '$alamat')");
    if(mysqli_affected_rows($koneksi) == 1)
    {
          echo "<script>
            alert('pendaftaran sukses, Silahkan Login sebagai Pelanggan');
            document.location.href='login.php';
          </script>";
    }
    else
    {
        echo "<script>
            alert('pendaftaran gagal,');
            document.location.href='daftar.php';
          </script>";
    }

  }


}




 ?>


<!-- document.location.href='daftar.php'; -->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar Pelanggan</title>
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
  <?php include "menu.php"; ?>
  <div class="container">
    <div class="row text-center ">
      <div class="col-md-12">
        <br /><br />
        <h2> Takase Murah:Daftar Pelanggan</h2>

        <br />
      </div>
    </div>
    <div class="row ">

      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">
            <strong> Masukkan Data Diri anda </strong>  
          </div>
        <?php if(isset($error)): ?>
          <div role="alert" class="alert alert-danger">
            <p>Pendaftaran Gagal, email Sudah Digunakan</p>
          </div>
        <?php endif; ?>
          <div class="panel-body">
           <form role="form" method="post">
             <br />
             <div class="form-group input-group">
              <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
              <input type="text" class="form-control" name="nama" placeholder="Nama " />
            </div>
            <div class="form-group input-group">
              <span class="input-group-addon"><i class="fa fa-envelope"  ></i></span>
              <input type="emial" class="form-control" name="email" placeholder="email" />
            </div>
            <div class="form-group input-group">
              <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
              <input type="password" class="form-control" name="password"  placeholder="Password" />
            </div>
            <div class="form-group input-group">
              <span class="input-group-addon"><i class="fa fa-phone"></i></span>
              <input type="text" class="form-control" name="telp" placeholder="Telp / Hp "></input>
            </div>
            <div class="form-group input-group">
              <span class="input-group-addon"><i class="fa fa-map-marker"  ></i></span>
              <textarea name="alamat" class="form-control" placeholder="alamat lengkap "></textarea>
            </div>

           <button class="btn btn-primary" name="daftar">Daftar</button>
           <hr />
           Jika Anda Sudah Punya Akun ? <a href="login.php" >click here </a> 
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
     <!-- MORRIS CHART SCRIPTS -->
     <script src="admin/assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="admin/assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="admin/assets/js/custom.js"></script>

</body>
</html>