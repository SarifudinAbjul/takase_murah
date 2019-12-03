<?php 

session_start();

$id_produk = $_GET['id'];


if(isset($_SESSION['keranjang'][$id_produk]) )
{
	// jika id produk sudah ada di keranjang tambahkan 1
	$_SESSION['keranjang'][$id_produk] += 1;
}
else
{
	// selain itu belum isi produk ke keranjang
	$_SESSION['keranjang'][$id_produk] = 1;
}
	
echo "<script>
 		alert('Produk Berhasil Ditambahkan Ke Keranjang');
 		document.location.href='keranjang.php';
 	  </script>";

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

 ?>