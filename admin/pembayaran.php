<?php 

$id_pembelian = $_GET['id'];

$ambil = $koneksi->query("SELECT * FROM pembayaran WHERE id_pembelian='$id_pembelian'");
$pembayaran = $ambil->fetch_assoc();

echo "<pre>";
	print_r($pembayaran);

echo "</pre>";
echo date("d-m-Y / H:i:s");

if(isset($_POST['proses']) )
{
	$resi = $_POST['resi'];
	$status = $_POST['status'];

	$koneksi->query("UPDATE pembelian SET status_pembelian='$status', resi_pengiriman='$resi' WHERE id_pembelian='$id_pembelian'");

}

?>


<div class="container">
	<h2 style="margin-bottom: 30px;">Data Pembayaran</h2>
  <div class="row">
	<div class="col-md-6">
		<table class="table">
			<tr>
				<th>Nama Penyetor</th>
				<td><?= $pembayaran['nama']; ?></td>
			</tr>
			<tr>
				<th>Bank</th>
				<td><?= strtoupper($pembayaran['bank']); ?></td>
			</tr>
			<tr>
				<th>Jumlah</th>
				<td>Rp. <?= number_format($pembayaran['jumlah']); ?></td>
			</tr>
			<tr>
				<th>Tanggal</th>
				<td><?= $pembayaran['tanggal']; ?></td>
			</tr>
		</table>
	</div>
	<div class="col-md-6">
		<img src="../img/foto_bukti/<?= $pembayaran['foto_bukti']; ?>">
	</div>
  </div>

 <form method="POST">
	<div class="form-group">
		<label>No Resi Pengiriman</label>
		<input type="text" name="resi" class="form-control">
	</div>
<div class="form-group">
	<label>Status</label>
	<select class="form-control" name="status">
		<option value="">Pilih Status</option>
		<option value="barang dikirim">Barang Dikirim</option>
		<option value="LUNAS">Lunas</option>
		<option value="GAGAL Dikirim" >GAGAL</option>
	</select>
</div>
<button class="btn btn-primary" name="proses">Proses</button>
</form>
</div>
