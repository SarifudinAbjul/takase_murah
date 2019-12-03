<?php 

  // $result = mysqli_query($koneksi, "SELECT * FROM produk");
	 $result = $koneksi->query("SELECT * FROM produk");
	// $data = $result->fetch_assoc();

 ?>
<h2>Daftar Produk</h2>
	<a href="index.php?halaman=tambahproduk" class="btn btn-primary" style="margin-bottom: 10px;">Tambah Produk</a>	

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama</th>
			<th>Harga</th>
			<th>Berat</th>
			<th>Stok</th>
			<th>Foto</th>
			<th>Aksi</th>
		</tr>
	</thead>
<?php 	$no = 1; ?>
<?php foreach ($result as $produk):?>
	<tbody>
		<tr>
			<td><?= $no++; ?></td>
			<td><?= $produk['nama_produk']; ?></td>
			<td>Rp. <?= number_format($produk['harga_produk']); ?></td>
			<td><?= $produk['berat_produk']; ?></td>
			<td><?= $produk['stok_produk']; ?></td>
			<td>
				<img src="../img/foto_produk/<?= $produk['foto_produk']; ?>" width="85">
			</td>
			<td>
				<a href="index.php?halaman=ubahproduk&id=<?= $produk['id_produk']; ?>" class="btn btn-warning">Ubah</a>
				<a href="index.php?halaman=hapusproduk&id=<?= $produk['id_produk']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Data INI ?');" class="btn btn-danger">Hapus</a>
			</td>
		</tr>
	</tbody>
<?php endforeach; ?>
</table>
