<?php 

require "function.php";

if (isset($_POST['save']) ) 
{

	if (tambahProduk($_POST) > 0)
	 {

		echo "
				<script>
					alert('Data berhasil ditambahkan');
					document.location.href = 'index.php?halaman=produk';
				</script>";

	}else{
			echo "
				<script>
					alert('Data gagal ditambahkan');
					document.location.href = 'index.php?halaman=tambahproduk';
				</script>";
	}

}

	// if(isset($_POST['save']) )
	// {
	// 	$namaProduk = $_POST['nama'];
	// 	$harga = $_POST['harga'];
	// 	$berat = $_POST['berat'];
	// 	$deskripsi = $_POST['deskripsi'];


	// 	$namaFoto = $_FILES['foto']['name'];
	// 	$lokasi = $_FILES['foto']['tmp_name'];
	// 	move_uploaded_file($lokasi, '../foto_produk/'.$namaFoto);
	// 	$values = $koneksi->query("INSERT INTO produk VALUES (NULL, '$namaProduk', '$harga', '$berat', '$namaFoto', '$deskripsi')");

	// 	$result = mysqli_affected_rows($values);
	// 	if($result > 0)
	// 	{
	// 	 echo "<script> 
 // 			 	alert('Produk Berhasil ditambahkan!!!');
 // 			  </script>";

	// 	}
	// 	 header("Location:index.php?halaman=produk");



	// }

 ?>
<h2>Tambah Produk</h2>
<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama Produk</label>
		<input type="text" name="nama" class="form-control">
	</div>
	<div class="form-group">
		<label>Harga (Rp)</label>
		<input type="number" name="harga" class="form-control">
	</div>
	<div class="form-group">
		<label>Berat (Gr)</label>
		<input type="number" name="berat" class="form-control">
	</div>
	<div class="form-group">
		<label>Stok Produk</label>
		<input type="number" name="stok" class="form-control">
	</div>
	<div class="form-group">
		<label>Deskripsi</label>
		<textarea class="form-control" rows="7" name="deskripsi"></textarea>
	</div>
	<div class="form-group">
		<label>Foto</label>
		<input type="file" name="foto" class="form-control">
	</div>
	<button class="btn btn-primary" name="save">Simpan</button>
</form>


