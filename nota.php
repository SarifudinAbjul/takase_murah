<?php 
session_start();
include "admin/db/koneksi.php";

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Nota Pembelian</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
<body>
<!-- navbar -->
<?php include "menu.php"; ?>
<!-- navbar -->
<!-- konten -->
<section class="konten">
	<div class="container">
		
<h2>Nota Pembelian</h2>
<?php 

$result = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan 
	ON pembelian.id_pelanggan=pelanggan.id_pelanggan
	WHERE pembelian.id_pembelian='$_GET[id];' ");

$data1 = $result->fetch_assoc();

// cek apakah pembeli sama dengan Pelanggan Yg Login
if($data1['id_pelanggan'] !== $_SESSION['pelanggan']['id_pelanggan'])
{
	header("Location:riwayat.php");
}

?>
<pre>
	<?php print_r($data1); ?>
</pre>
<pre>
	<?php print_r($_SESSION); ?>
</pre>


<div class="row">
	<div class="col-md-4">
		<h3>PEMBELIAN</h3>
		<p>
			Tanggal: <?= $data1['tanggal_pembelian']; ?><br>
			Total : Rp. <?= number_format($data1['total_pembelian']); ?>
		</p>
	</div>
	<div class="col-md-4">
		<h3>PELANGGAN</h3>
		<strong><?= $data1['nama_pelanggan']; ?></strong>
		<p>
			<?= $data1['telp_pelanggan']; ?><br>
			<?= $data1['email_pelanggan']; ?>
		</p>
	</div>
	<div class="col-md-4">
		<h3>PENGIRIMAN</h3>
		<strong><?= $data1['nama_kota']; ?></strong>
		<p>Ongkos Kirim :<?= $data1['tarif']; ?><br>
		<?= $data1['alamat_pengiriman']; ?></p>
	</div>
</div>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Produk</th>
			<th>Harga</th>
			<th>Berat</th>
			<th>Jumlah</th>
			<th>Subberat</th>
			<th>Subtotal</th>
		</tr>
	</thead>

	<?php 
		$result = $koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian='$_GET[id]'");
		$no = 1;
	 ?>

	<?php foreach ($result as $data2): ?>
		<tbody>
			<tr>
				<td><?= $no++; ?></td>
				<td><?= $data2['nama']; ?></td>
				<td><p>Rp. <?= number_format($data2['harga'] ); ?></p></td>
				<td><p><?= $data2['berat']; ?> Gr.</p></td>
				<td><?= $data2['jumlah']; ?></td>
				<td><p><?= $data2['subberat']; ?> Gr.</p></td>
				<td><p>Rp. <?= number_format($data2['subharga']); ?></p></td>
			</tr>
		</tbody>
	<?php endforeach; ?>
</table>

<div class="row">
	<div class="col-md-7">
		<div class="alert alert-info">
			<p>
				Silahkan Lakukan Pembayaran Rp. <?= number_format($data1['total_pembelian']); ?> Ke. <br>
				<strong>BANK BNI 083825121 AN. SARIFUDIN ABDJUL</strong>
				
			</p>

		</div>
	</div>
</div>

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