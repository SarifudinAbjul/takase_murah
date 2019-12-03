<?php 

	$result = $koneksi->query("SELECT * FROM pelanggan");



 ?>
<h2> Daftar Pelanggan</h2>
<a href="index.php?halaman=tambahpelanggan" class="btn btn-primary" style="margin-bottom: 10px;">Tambah Pelanggan</a>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Pelanggan</th>
			<th>Email</th>
			<th>Telp</th>
			<th>Alamat</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<?php $no = 1; ?>
	<?php foreach ($result as $data): ?>
	<tbody>
		<tr>
			<td><?= $no++; ?></td>
			<td><?= $data['nama_pelanggan']; ?></td>
			<td><?= $data['email_pelanggan']; ?></td>
			<td><?= $data['telp_pelanggan']; ?></td>
			<td><?= $data['alamat_pelanggan']; ?></td>
			<td>
				<a href="index.php?halaman=ubahPelanggan&id=<?= $data['id_pelanggan']; ?>" class="btn btn-warning">Ubah</a>
				<a href="index.php?halaman=hapusPelanggan&id=<?= $data['id_pelanggan']; ?>" class="btn btn-danger" onclick="return confirm('Anda yakin akan menghapus data pelanggan')" >Hapus</a>
			</td>
		</tr>
	</tbody>
<?php endforeach; ?>
</table>
