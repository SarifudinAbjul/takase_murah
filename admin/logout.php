<?php 
session_start();
$_SESSION['login'] = [];
session_unset();
session_destroy();

header("Location:login.php");
exit;


 ?>