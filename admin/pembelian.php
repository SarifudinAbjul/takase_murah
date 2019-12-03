<h2> Daftar Pembelian</h2>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama pelanggan</th>
			<th>Tanggal</th>
			<th>Status Pembelian</th>
			<th>Total</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<?php $result=$koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan= pelanggan.id_pelanggan"); ?>
	<?php $no=1; ?>
	<?php foreach ($result as $data ):?>
		<tbody>
			<tr>
				<td><?= $no++; ?></td>
				<td><?= $data['nama_pelanggan']; ?></td>
				<td><?= $data['tanggal_pembelian']; ?></td>
				<td>
					<?= $data['status_pembelian']; ?><br>
					<?php if (!empty($data['resi_pengiriman'])): ?>
						<p><?= $data['resi_pengiriman']; ?></p>
					<?php endif; ?>
				</td>
				<td>Rp. <?= number_format($data['total_pembelian']); ?></td>
				<td>	
					<a href="index.php?halaman=detail&id=<?= $data['id_pembelian']; ?>" class="btn btn-info">Detail</a>
					<?php if ($data['status_pembelian'] !== 'pending'): ?>
						<a href="index.php?halaman=pembayaran&id=<?= $data['id_pembelian']; ?>" class="btn btn-success">Pembayaran</a>
					<?php endif; ?>
				</td>
			</tr>
		</tbody>
	<?php endforeach; ?>
</table>