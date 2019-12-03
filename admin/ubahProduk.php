<?php 

	include "function.php";

	$id = $_GET['id'];

	$result = $koneksi->query("SELECT * FROM produk WHERE id_produk=$id");
	$data = $result->fetch_assoc();

	if(isset($_POST['save']) )
	{
		if(ubahProduk($_POST) > 0)
		{
			echo "<script>
					alert('Data Berhasil Diubah');
					document.location.href = 'index.php?halaman=produk';
				  </script>";
		}
		else
		{
			echo "<script>
					alert('Data Gagal Diubah');
				 </script>";
		}
	}

 ?>



<h2>Ubah Data Produk</h2>

<form method="post" enctype="multipart/form-data">
	<input type="hidden" name="id" value="<?= $data['id_produk']; ?>">
	<input type="hidden" name="fotolama" value="<?= $data['foto_produk']; ?>">
	<div class="form-group">
		<label>Nama</label>
		<input type="text" name="nama" class="form-control" value="<?= $data['nama_produk']; ?>">
	</div>
	<div class="form-group">
		<label>Harga (Rp)</label>
		<input type="number" name="harga" class="form-control" value="<?= $data['harga_produk']; ?>">
	</div>
	<div class="form-group">
		<label>Berat (Gr)</label>
		<input type="number" name="berat" class="form-control" value="<?= $data['berat_produk']; ?>">
	</div>
	<div class="form-group">
		<label>Stok</label>
		<input type="number" name="stok" class="form-control" value="<?= $data['stok_produk']; ?>">
	</div>
	<div class="form-group">
		<img src="../img/foto_produk/<?= $data['foto_produk']; ?>" width="100">
	</div>
	<div class="form-group">
		<label>Ganti Foto</label>
		<input type="file" name="foto" class="form-control">
	</div>
	<div class="form-group">
		<label>Deskripsi</label>
		<textarea name="deskripsi" class="form-control" rows="10"><?= $data['deskripsi_produk']; ?></textarea>
	</div>
	<button type="submit" name="save" class="btn btn-primary">Ubah</button>
</form>