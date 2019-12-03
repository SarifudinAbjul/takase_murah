<?php
session_start();
include "admin/db/koneksi.php";
// mendapatkan id produk dari URL
$id_produk = $_GET['id'];

$result = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$produk = $result->fetch_assoc();

if(isset($_POST['beli']) )
{
	$jumlah = $_POST['jumlah'];
	// cek apakah keranjang belanja kosong
	if(empty($jumlah))
	{
		$error = true;
	}
	else
	{
	// simpan Jumlah Ke keranjang Belanja 
	$_SESSION["keranjang"][$id_produk] = $jumlah;

	echo "<script>
			alert('Produk Berhasil Ditambahkan Ke Keranjang');
			document.location.href='keranjang.php';
			</script>";

	}
}

echo "<pre>";
print_r($produk);
echo "</pre>";



?>

<!DOCTYPE html>
<html>
<head>
	<title>Detali Produk</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
<!-- navbar -->
<?php include "menu.php"; ?>
<!-- navbar -->
<!-- detail -->
<section class="detail">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<img src="img/foto_produk/<?= $produk['foto_produk']; ?>" class="img-responsive">
			</div>
			<div class="col-md-6">
				<h2><?= $produk['nama_produk']; ?></h2>
				<h3>Rp. <?= number_format($produk['harga_produk']); ?></h3>
				<p><?= $produk['berat_produk']; ?> Gr.</p>
				<h5>Stok Produk : <?= $produk['stok_produk']; ?></h5>
				<?php if(isset($error)): ?>
					<div class="alert alert-danger" role="alert">
						<h5>Silahkan Masukkan Jumlah Barang Yang akan di beli</h5>
					</div>
				<?php endif; ?>
				<form method="post">
					<div class="form-group">
						<div class="input-group">
							<input type="number" min="1" name="jumlah" class="form-control" max="<?= $produk['stok_produk']; ?>">
							<div class="input-group-btn">
								<button class="btn btn-primary" name="beli">Beli</button>
							</div>
						</div>
					</div>
				</form>
			 <p><?= $produk['deskripsi_produk']; ?></p>
			</div>
		</div>
	</div>
</section>
<!-- detail -->
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