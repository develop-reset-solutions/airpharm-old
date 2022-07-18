<?php session_start();
include("../../login/sesion_start.php");
include("../../librerias/librerias.php");
include("../../cabecera.php");
$conn=db_connect();
$usr_id=$_POST['usr_id'];
$usr_password_n=$_POST['usr_password'];
$usr_password = md5($_POST['usr_password']);
$query="UPDATE usuarios SET usr_password='".$usr_password."' WHERE usr_id=".$usr_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
header('Location: /home.php');
?>
