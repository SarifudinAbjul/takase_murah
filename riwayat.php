<?php 
session_start();
include "admin/db/koneksi.php";

// cek apakah ada yg login
if(!isset($_SESSION["pelanggan"]) || empty($_SESSION["pelanggan"]))
{
	echo "<script>
			alert('Silahkan Login Terlebih Dahulu');
			document.location.href='index.php';
		 </script>";
}

 ?>



<!DOCTYPE html>
<html>
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Riwayat Belanja</title>
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

<?php 
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
?>

<section class="riwayat">
	<div class="container">
		<table class="table table-bordered">
		  <div class="row">
			<tr>
				<th>No</th>
				<th>Tanggal</th>
				<th>Status</th>
				<th>Total</th>
				<th>Opsi</th>
			</tr>
		  </div>
		  <?php 
		  		$no = 1;
		  		$id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
		  		$result = $koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan'");

		  	while ($data = $result->fetch_assoc()):
		   ?>
		  <div class="row">
			<tr>
				<td><?= $no++; ?></td>
				<td><?= $data['tanggal_pembelian']; ?></td>
				<td>
					<?= $data['status_pembelian']; ?><br>
					<?php if(!empty($data['resi_pengiriman'])): ?>
						No Resi : <?= $data['resi_pengiriman']; ?>
					<?php endif; ?>		
				</td>
				<td>Rp. <?= number_format($data['total_pembelian']); ?></td>
				<td>
					<a href="nota.php?id=<?= $data['id_pembelian']; ?>" class="btn btn-info">Nota</a>
					<a href="pembayaran.php?id=<?= $data['id_pembelian']; ?>" class="btn btn-success">Pembayaran</a>
				</td>
			</tr>
		  </div>
		<?php endwhile; ?>
		</table>
	</div>
</section>
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