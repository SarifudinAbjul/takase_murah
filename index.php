<?php
session_start();
include "admin/db/koneksi.php";

$result = $koneksi->query("SELECT * FROM produk");
$isi = $result->fetch_assoc();



 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Takase_Murah</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
<body>
<!-- navbar -->
<?php include "menu.php"; ?>
<!-- navbar -->

<!-- Konten -->
<section class="conten">
	<div class="container">
		<h2>Daftar Produk</h2>
		<div class="row">
			<?php foreach ($result as $produk):?>
				<div class="col-md-3">
					<div class="thumbnail">
						<img src="img/foto_produk/<?= $produk['foto_produk']; ?>">
						<div class="caption">
							<h3><?= $produk['nama_produk']; ?></h3>
							<h5>Rp. <?= number_format($produk['harga_produk']); ?></h5>
							<a href="beli.php?id=<?= $produk['id_produk']; ?>" class="btn btn-primary">Beli</a>
							<a href="detail.php?id=<?= $produk['id_produk']; ?>" class="btn btn-default">Detail</a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<!-- Konten -->
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