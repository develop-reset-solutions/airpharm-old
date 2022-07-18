<?php session_start();
include("login/sesion_start.php");
$_SESSION['ano']=$_POST['ano'];
header('Location: home.php');
?>
