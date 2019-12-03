<?php 

include "db/koneksi.php";

function tambahProduk($data)
{
	global $koneksi;

	$namaProduk = htmlspecialchars($data['nama']);
	$harga = htmlspecialchars($data['harga']);
	$berat = htmlspecialchars($data['berat']);
	$stok = htmlspecialchars($data['stok']);
	$deskripsi = htmlspecialchars($data['deskripsi']);
	$foto = upload();

	if(!$foto)
	{
		return false;
	}

	$koneksi->query("INSERT INTO produk VALUES (NULL, '$namaProduk', '$harga', '$berat', '$foto', '$deskripsi', '$stok')");

	return mysqli_affected_rows($koneksi);
}
function tambahPelanggan($data)
{
	global $koneksi;

	$namaPelanggan = htmlspecialchars($data['nama']);
	$email = htmlspecialchars($data['email']);
	$pass = htmlspecialchars($data['password']);
	$telp = htmlspecialchars($data['telp']);

	$koneksi->query("INSERT INTO pelanggan VALUES (NULL, '$email', '$pass','$namaPelanggan', '$telp')");

	return mysqli_affected_rows($koneksi);
}

function upload()
{
	// ambil inputan gambar
	$nama = $_FILES['foto']['name'];
	$lokasi = $_FILES['foto']['tmp_name'];
	$ukuran = $_FILES['foto']['size'];
	$error = $_FILES['foto']['error'];

	// cek apakah ada gambar yg diupload
	if($error === 4)
	{
		echo " <script>
 				 alert('Pilih Gambar Terlebih Dahulu');
 			   </script>";
 			return false;
	}

	// cek ekstensi gambar yg diupload
	$extensiValid = ['jpeg', 'jpg', 'png'];
	$extensiFoto = explode('.', $nama);
	$extensiFoto = strtolower(end($extensiFoto));
	if(!in_array($extensiFoto, $extensiValid) )
	{
		echo "<script>
				alert('Maaf Yg anda masukkan Bukan Gambar');
			 </script>";

		return false;
	}

	// cek ukuran gambar
	if($ukuran > 1000000)
	{
		echo "<script>
				alert('Maaf Ukuran Gambar Terlalu Besar');
			 </script>";
	}
	// grenerate  nama baru
	$namaBaru = uniqid();
	$namaBaru .= '.';
	$namaBaru .= $extensiFoto;
	move_uploaded_file($lokasi, '../img/foto_produk/'.$namaBaru);

	return $namaBaru;
	return false;
}

function hapusProduk($id)
{
	global $koneksi;

	$data = $koneksi->query("SELECT * FROM produk WHERE id_produk=$id");
	$pecah = $data->fetch_assoc();
	$foto = $pecah['foto_produk'];

	
	if(file_exists("../img/foto_produk/$foto") )
	{
		// echo "ok";
		unlink("../img/foto_produk/$foto");
	}
	$hapus = "DELETE FROM produk WHERE id_produk=$id";

	// mysqli_query($koneksi, $hapus);
	$koneksi->query($hapus);
	return mysqli_affected_rows($koneksi);
	 // var_dump($isi);
	
}

function hapusPelanggan($id)
{
	global $koneksi;
	// $data = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan=$id");
	
	$hapus = "DELETE FROM pelanggan WHERE id_pelanggan=$id";
	$koneksi->query($hapus);
	return mysqli_affected_rows($koneksi);

}

function ubahProduk($data)
{
	global $koneksi;
	$id = $data['id'];
	$nama = htmlspecialchars($data['nama']);
	$harga = htmlspecialchars($data['harga']);
	$berat = htmlspecialchars($data['berat']);
	$stok = htmlspecialchars($data['stok']);
	$deskripsi = htmlspecialchars($data['deskripsi']);
	$fotolama = $data['fotolama'];
	if($_FILES['foto']['error'] === 4)
	{
		$foto = $fotolama;
	}
	else
	{
		$foto = upload();
	}

	$ubah = "UPDATE produk SET 
			nama_produk = '$nama',
			harga_produk = '$harga',
			berat_produk = '$berat',
			foto_produk = '$foto',
			deskripsi_produk = '$deskripsi',
			stok_produk = '$stok'
			WHERE id_produk= $id";

	if(file_exists("./img/foto_produk/$fotolama") )
	{
		unlink("./img/foto_produk/$fotolama");
	}
	$koneksi->query($ubah);
	return mysqli_affected_rows($koneksi);
}
function ubahPelanggan($data)
{
	global $koneksi;
	$id = $data['id'];
	$nama = htmlspecialchars($data['nama']);
	$email = htmlspecialchars($data['email']);
	$pass = htmlspecialchars($data['password']);
	$telp = htmlspecialchars($data['telp']);

	$ubah = "UPDATE pelanggan SET 
			nama_pelanggan = '$nama',
			email_pelanggan = '$email',
			password_pelanggan = '$pass',
			telp_pelanggan = '$telp'
			WHERE id_pelanggan = $id";

	$koneksi->query($ubah);
	return mysqli_affected_rows($koneksi);


}
function regisAdmin($data)
{
	global $koneksi;

	$username = strtolower(stripcslashes($data['username']));
	$pass1 = mysqli_real_escape_string($koneksi, $data['password']);
	$pass2 = mysqli_real_escape_string($koneksi, $data['password2']);
	$nama_lengkap = stripcslashes($data['nama_lengkap']);

	// cek username apakah sudah ada
	$result = $koneksi->query("SELECT username FROM admin WHERE username = '$username' ");

	if(mysqli_fetch_assoc($result) )
	{
		echo "<script>
			   alert('username Sudah digunakan');
			 </script>";
		return false;
	} 

	// cek konfirmasi password
	if($pass1 !== $pass2)
	{
		echo "<script>
			   alert('Konfirmasi Password tidak sesuai');
			 </script>";
		return false;
	}
	else
	{
		$password = password_hash($pass1, PASSWORD_DEFAULT);

		$koneksi->query("INSERT INTO admin VALUES(NULL, '$username', '$password', '$nama_lengkap')");

		return myaqli_affected_rows($koneksi);
	}







}














 ?>
