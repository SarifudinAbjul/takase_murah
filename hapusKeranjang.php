<?php 
session_start();

$id_produk = $_GET['id'];

unset($_SESSION['keranjang'][$id_produk]);
	echo " <script>
 			alert('data berhasil dihapus');
 			document.location.href='keranjang.php';
 		  </script>";
		exit;



 ?>

