<?php 

$server = "localhost";
$username = "root";
$password = "password";
$database = "takase_murah";

$koneksi = mysqli_connect($server, $username, $password, $database);

if(!$koneksi)
{
	echo "Koneksi GAGAL...!!!";
}


 ?>