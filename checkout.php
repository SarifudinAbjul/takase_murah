<?php 
session_start();

include "admin/db/koneksi.php";
    if(!isset($_SESSION['pelanggan']) )
    {
    	echo "<script>
    			alert('Untuk Melakukan Checkout Silahkan Login terlebih dahulu');
    			document.location.href='login.php';
    		 </script>";
        exit;
    }
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Checkout</title>
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
			</tr>
		</thead>
	<?php $no = 1; ?>
	<?php $totalBelanja = 0; ?>
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
			</tr>
	<?php $totalBelanja += $subharga;  ?>
	<?php endforeach; ?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan="4">Total Belanja</th>
				<th>Rp. <?= number_format($totalBelanja); ?></th>
			</tr>
		</tfoot>
	</table>
	<form method="POST">

		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<input type="text" readonly value="<?= $_SESSION['pelanggan']['nama_pelanggan']; ?>">
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<input type="text" readonly value="<?= $_SESSION['pelanggan']['telp_pelanggan']; ?>">
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<select class="form-control" name="id_ongkir">
						<option value="" name="kosong">Silahkan Pilih Ongkir</option>
						<?php 
							$result = $koneksi->query("SELECT * FROM ongkir");
							while($data = $result->fetch_assoc() ):

						 ?>
							<option value="<?= $data['id_ongkir']; ?>">
								<?= $data['nama_kota']; ?> - 
								Rp. <?= number_format($data['tarif']); ?>	
							</option>
						<?php endwhile; ?>
					</select>

				</div>
			</div>
		</div>
		<div class="form-group">
			<label>Alamat Lengkap Pengiriman</label>
			<textarea class="form-control" name="alamat_pengiriman" placeholder="Masukkan alamat lengkap Pengiriman termasuk KODE POS" required></textarea>
		</div>
		<button type="submit" class="btn btn-primary" name="checkout">Checkout</button>
	</form>
<?php 
	if(isset($_POST["checkout"]) )
	{
		$id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
		$id_ongkir = $_POST["id_ongkir"];
		$alamat_pengiriman = htmlspecialchars($_POST["alamat_pengiriman"]);
		$tanggal_pembelian = date("Y-m-d");
		$status_pembayaran = "pending";
		$resi = "";
		// untuk mendapatkan total pembelian, queri data tarif pada tabel ongkir
		$result = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'") ;
		$ongkir = $result->fetch_assoc();
		$tarif = $ongkir["tarif"];
		$nama_kota = $ongkir["nama_kota"];
		$total_pembelian = $totalBelanja + $tarif;



		if(empty($totalBelanja))
		{
				echo "<script>
					alert('Keranjang Belanja Anda Kosong');
					document.location.href='index.php';
				</script>";
				exit;
		}

		if($_POST['id_ongkir'] == $_POST['kosong'])
		{
			echo "<script>
					alert('Silahkan Pilih Ongkos Kirim Untuk Wilayah Anda..!!!');
				</script>";
				exit;
		}
		else
		{
		// simpan data pembelian ke tabel pembelian
		$koneksi->query("INSERT INTO pembelian 
							VALUES
						( NULL, 
						 '$id_pelanggan',
						 '$id_ongkir', 
						 '$tanggal_pembelian',
						 '$total_pembelian',
						 '$nama_kota',
						 '$tarif',
						 '$alamat_pengiriman',
						 '$status_pembayaran',
						 '$resi')");
		}

		// mendapatkan ID_PEMBELIAN yg barusan terjadi
		$id_pembelian_baru = $koneksi->insert_id;

		// echo "<pre>";
		// print_r($id_pembelian_baru);
		// echo "</pre>";
		// exit;
		foreach ($_SESSION['keranjang'] as $id_produk => $jumlah)
		{
			$perproduk = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
			$produk = $perproduk->fetch_assoc();

			$nama = $produk['nama_produk'];
			$harga= $produk['harga_produk'];
			$berat = $produk['berat_produk'];

			$subberat = $berat * $jumlah;
			$subharga = $harga * $jumlah; 

			$koneksi->query("INSERT INTO pembelian_produk VALUES (NULL, '$id_pembelian_baru', '$id_produk', '$nama', '$harga', '$berat', '$subberat', '$subharga', '$jumlah')");

			// update stok produk
			$koneksi->query("UPDATE produk SET stok_produk=stok_produk-$jumlah WHERE id_produk='$id_produk'");

			$_SESSION['keranjang'] = [];
			unset($_SESSION['keranjang']);
		}

		echo "<script>
				alert('Pembelian Sukses');
				document.location.href='nota.php?id=$id_pembelian_baru';
			 </script>";


	}



 ?>

</div>
</section>
<!-- konten -->

<!-- <?php 
echo "<pre>";

print_r($_SESSION);
echo "</pre>";
 ?> -->
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