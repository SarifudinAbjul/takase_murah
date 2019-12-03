<?php 

 require 'function.php';

$id = $_GET['id'];

if(hapusPelanggan($id) > 0)
{
	echo " <script>
 			  alert('Data Berhasil Dihapus');
 			  document.location.href = 'index.php?halaman=pelanggan';
 		  </script>";
}
else
{
	echo " <script>
 			 alert('Data Gagal Dihapus');
 			 document.location.href = 'index.php?halaman=pelanggan';
 		  </script>";
}

 ?>