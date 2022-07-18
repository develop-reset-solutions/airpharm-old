<?php session_start();
include("../../login/sesion_start.php");
include("../../librerias/librerias.php");
include("../../cabecera.php");
$conn=db_connect();
$gru_id=$_POST['gru_id'];
$gru_nombre=mysql_real_escape_string($_POST['gru_nombre']);
$query="UPDATE grupos SET gru_nombre='".utf8_decode($gru_nombre)."' WHERE gru_id=".$gru_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
header('Location: index.php');
?>
