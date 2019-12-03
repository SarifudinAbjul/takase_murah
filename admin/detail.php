<h2>Detail Pembelian</h2>
<?php 

$result = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan 
	ON pembelian.id_pelanggan=pelanggan.id_pelanggan
	WHERE pembelian.id_pembelian='$_GET[id];' ");

$data = $result->fetch_assoc();

// echo "<pre>";
// print_r($data);
// echo "</pre>";

 ?>




<div class="row">
	<div class="col-md-4">
		<h3>Pembelian</h3>
		<p>
			Total Pembelian : <strong>Rp. <?= number_format($data['total_pembelian']); ?></strong><br>
			Tanggal Pembelian : <?= $data['tanggal_pembelian']; ?><br>
			Resi Pengiriman : <?= $data['resi_pengiriman']; ?> <br>
			Status : <?= $data['status_pembelian']; ?>
		</p>
	</div>
	<div class="col-md-4">
		<h3>Pelanggan</h3>
		<p>
			Nama : <strong><?= $data['nama_pelanggan']; ?></strong><br>
			No Telp / Hp :<?= $data['telp_pelanggan']; ?><br>
			Email : <?= $data['email_pelanggan']; ?>
		</p>
	</div>
	<div class="col-md-4">
		<h3>Pengiriman</h3>
		<p>
			<strong><?= $data['nama_kota']; ?><br></strong>
			Rp. <?= number_format($data['tarif']); ?><br>
			<?= $data['alamat_pengiriman']; ?>
		</p>
	</div>
</div>


<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Produk</th>
			<th>Harga</th>
			<th>Jumlah</th>
			<th>Subtotal</th>
		</tr>
	</thead>

	<?php 
		$result = $koneksi->query("SELECT * FROM pembelian_produk JOIN produk 
			ON pembelian_produk.id_produk=produk.id_produk 
			WHERE pembelian_produk.id_pembelian='$_GET[id];'");
		$no = 1;
	 ?>

	<?php foreach ($result as $data): ?>
		<tbody>
			<tr>
				<td><?= $no++; ?></td>
				<td><?= $data['nama_produk']; ?></td>
				<td>Rp .<?= number_format($data['harga_produk']); ?></td>
				<td><?= $data['jumlah']; ?></td>
				<td>
					Rp. <?= number_format($data['harga_produk'] * $data['jumlah']); ?>
				</td>
			</tr>
		</tbody>
	<?php endforeach; ?>
</table>



