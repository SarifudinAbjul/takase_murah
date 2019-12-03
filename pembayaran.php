<?php 
session_start();
include "admin/db/koneksi.php";

// cek apakah ada yg login
if(!isset($_SESSION["pelanggan"]) || empty($_SESSION["pelanggan"]) )
{
	echo "<script>
			alert('Silahkan Login Terlebih Dahulu');
			document.location.href='index.php';
		 </script>";
}

// mendapatkan Id Pembelian
$id_pembelian = $_GET['id'];
$idPem =$koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$id_pembelian'");
$detPem = $idPem->fetch_assoc();

// mendapatkan id Pelanggan pembelian
$id_pelanggan_beli = $detPem["id_pelanggan"];
// mendapatkan id Pelanggan Login
$id_pelanggan_login = $_SESSION["pelanggan"]["id_pelanggan"];
// cek apakah pembeli = pelanggan yg login
if($id_pelanggan_beli !== $id_pelanggan_login)
{
		echo "<script>
				document.location.href='riwayat.php';
		 	</script>";
}


// cek apakah tombol kirim sudah dipencet
if(isset($_POST["kirim"]) )
{

	// ambil inputan gambar
	$nama = $_FILES['bukti']['name'];
	$lokasi = $_FILES['bukti']['tmp_name'];
	$ukuran = $_FILES['bukti']['size'];
	$error = $_FILES['bukti']['error'];

	// cek apakah ada gambar yg diupload
	if($error === 4)
	{
		echo " <script>
 				 alert('Pilih Gambar Terlebih Dahulu');
 			   </script>";
 			return false;
	}

	// cek ekstensi gambar yg diupload
	$extensiValid = ['jpeg', 'jpg', 'png'];
	$extensiFoto = explode('.', $nama);
	$extensiFoto = strtolower(end($extensiFoto));
	if(!in_array($extensiFoto, $extensiValid) )
	{
		echo "<script>
				alert('Maaf yang anda masukkan bukan gambar');
			 </script>";

		return false;
	}

	// cek ukuran gambar
	if($ukuran > 1000000)
	{
		echo "<script>
				alert('Maaf Ukuran Gambar Terlalu Besar');
			 </script>";
	}
	// grenerate  nama baru
	$namaBaru = uniqid()."-".date("dmY");
	$namaBaru .= '.';
	$namaBaru .= $extensiFoto;
	move_uploaded_file($lokasi, 'img/foto_bukti/'.$namaBaru);

	$nama_penyetor = $_POST["nama"];
	$bank = $_POST["bank"];
	$jumlah = $_POST["jumlah"];
	$tanggal = date("d-m-Y/H:i:s");


// echo "<pre>";
// print_r($id_pembelian);
// echo "</pre>";
// echo "<pre>";
// print_r($jumlah);
// echo "</pre>";
// echo "<pre>";
// print_r($tanggal);
// echo "</pre>";
// echo "<pre>";
// print_r($namaBaru);
// echo "</pre>";
// echo "<pre>";
// print_r($bank);
// echo "</pre>";
// echo "<pre>";
// print_r($nama_penyetor);
// echo "</pre>";


// simpan pembayaran
$koneksi->query("INSERT INTO pembayaran VALUES (NULL, '$id_pembelian', '$nama_penyetor', '$bank', '$jumlah', '$tanggal', '$namaBaru')");
// update data pembelian pending jadi lunas
$koneksi->query("UPDATE pembelian SET status_pembelian='LUNAS' WHERE id_pembelian='$id_pembelian'");

	echo " <script>
 			alert('Terima kasih telah melakaukan pembayaran');
 			document.location.href='riwayat.php';
 		  </script>";

}



// echo "<pre>";
// print_r($detPem);
// echo "</pre>";
// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";



 ?>

<!DOCTYPE html>
<html>
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pembayaran</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="admin/assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="admin/assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="admin/assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="admin/assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
<?php include "menu.php"; ?>

<div class="container">

	<h3>Konfirmasi Pembayaran</h3>
	<p>Kirim Bukti Pembayaran anda disini</p>
	<div class="alert alert-info" role="alert">
		<p>total tagihan anda<strong> Rp. <?= number_format($detPem["total_pembelian"]); ?></strong></p>
	</div>

<form method="POST" enctype="multipart/form-data" >
	<div class="form_group">
		<label>Nama Penyetor</label>
		<input type="text" name="nama" class="form-control" required>
	</div>
	<div class="form_group">
		<label>Bank</label>
		<input type="text" name="bank" class="form-control" required>
	</div>
	<div class="form_group">
		<label>Jumlah</label>
		<input type="number" name="jumlah" class="form-control" required>
	</div>
	<div class="form_group">
		<label>Foto Bukti Pembayaran</label>
		<input type="file" name="bukti" class="form-control" required>
		<p style="color: red;">foto Bukti Pembayaran Max 2MB</p>
	</div>
	<button class="btn btn-primary" name="kirim">Kirim</button>
</form>



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