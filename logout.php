<?php 
session_start();
$_SESSION['pelanggan'] = [];
session_unset();
session_destroy();

header("Location:login.php");
exit;


 ?>