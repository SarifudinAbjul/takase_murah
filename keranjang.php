<?php 
session_start();
include "admin/db/koneksi.php";

if(empty($_SESSION['keranjang']) || !isset($_SESSION['keranjang']))
{
	echo "<script>
    		alert('Keranjang Belanja Anda Kosong! silahkan Belanja Dulu!!!');
    		document.location.href='index.php';
    	 </script>";
    		 exit;

}

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Keranjang Belanja</title>
 	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
 </head>
 <body>
 <!-- navbar -->
<?php include "menu.php"; ?>
<!-- navbar -->

<!-- konten -->
<section class="konten">
<div class="container">
	<h1>Keranjang Belanja</h1>
	<hr>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Produk</th>
				<th>Harga </th>
				<th>Jumlah</th>
				<th>Subtotal</th>
				<th>Aksi</th>
			</tr>
		</thead>
	<?php $no = 1; ?>
	<?php foreach ($_SESSION['keranjang'] as $id_produk => $jumlah): ?>
		<!-- menampilkan produk berdasarkan id_produk -->
		<?php  
			$result = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk' ");
			$produk = $result->fetch_assoc();
			$subharga = $produk['harga_produk']*$jumlah;

		 ?>
		<tbody>
			<tr>
				<td><?= $no++; ?></td>
				<td><?= $produk['nama_produk']; ?></td>
				<td>Rp. <?= number_format($produk['harga_produk']); ?></td>
				<td><?= $jumlah; ?></td>
				<td>Rp. <?= number_format($subharga);?></td>
				<th>
					<a href="hapusKeranjang.php?id=<?= $id_produk; ?>" class="btn btn-danger">Hapus</a>
				</th>
			</tr>
		</tbody>
	<?php endforeach; ?>
	</table>
	<a href="index.php" class="btn btn-default">Lanjutkan Belanja</a>
	<a href="checkout.php" class="btn btn-primary">Checkout</a>
</div>
	
</section>
<!-- konten -->
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