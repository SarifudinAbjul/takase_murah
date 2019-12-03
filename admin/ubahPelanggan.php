
<?php

include  "function.php";
$id = $_GET['id'];
$result = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan=$id");
$data = $result->fetch_assoc();

if(isset($_POST['save']) )
{
	if(ubahPelanggan($_POST) > 0)
	{
		echo "<script>
				alert('Data Pelanggan Berhasil Diubah');
				document.location.href = 'index.php?halaman=pelanggan'; 
			</script>";
	}
	else
	{
		echo "<script>
				alert('Data Pelanggan Gagal Diubah');
				document.location.href = 'index.php?halaman=ubahPelanggan';
			</script>";
	}
}

 ?>
<h2 style="margin-bottom: 100px;">Ubah Data Pelanggan</h2>
<form method="post">
	<input type="hidden" name="id" value="<?= $data['id_pelanggan']; ?>" >
	<div class="form-group">
		<label>Nama</label>
		<input type="text" name="nama" class="form-control" value="<?= $data['nama_pelanggan']; ?>">
	</div>
	<div class="form-group">
		<label>Email</label>
		<input type="email" name="email" class="form-control" value="<?= $data['email_pelanggan']; ?>">
	</div>
	<div class="form-group">
		<label>Password</label>
		<input type="text" name="password" class="form-control" value="<?= $data['password_pelanggan']; ?>">
	</div>
	<div class="form-group">
		<label>No Telp / Hp</label>
		<input type="number" name="telp" class="form-control" value="<?= $data['telp_pelanggan']; ?>">
	</div>
	<button type="submit" name="save" class="btn btn-primary">Ubah</button>
</form>