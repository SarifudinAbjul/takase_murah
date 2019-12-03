<?php 

require "function.php";

if(isset($_POST['save']) )
{
	if(tambahPelanggan($_POST) > 0)
	{
		echo "<script>
				alert('Data Pelanggan Berhasil Ditambahkan');
				document.location.href = 'index.php?halaman=pelanggan';
			  </script>";
	}
	else
	{
		echo "<script>
				alert('Data Pelanggan Gagal Ditambahkan');
				document.location.href = 'index.php?halaman=pelanggan';
			  </script>";

	}
	
}


 ?>

<h2>Tambah Pelanggan</h2>
<form method="post">
	<div class="form-group">
		<label>Nama Lengkap</label>
		<input type="text" name="nama" class="form-control" >
	</div>
	<div class="form-group">
		<label>Email</label>
		<input type="email" name="email" class="form-control" >
	</div>
	<div class="form-group">
		<label>Password</label>
		<input type="password" name="password" class="form-control" >
	</div>

	<div class="form-group">
		<label>No.Tlp/Hp</label>
		<input type="number" name="telp" class="form-control" >
	</div>
	<button type="submit" name="save" class="btn btn-primary">Simpan</button>
</form>

