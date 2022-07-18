<?php session_start();
include("../../login/sesion_start.php");
include("../../librerias/librerias.php");
include("../../cabecera.php");
$conn=db_connect();
$usr_id=$_GET['usr_id'];
$query="DELETE FROM usuarios WHERE usr_id=".$usr_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
header('Location: index.php');
?>
