<?php session_start();
include("../../login/sesion_start.php");
include("../../librerias/librerias.php");
include("../../cabecera.php");
$conn=db_connect();
$oe_id=$_POST['oe_id'];
$oe_codigo=mysql_real_escape_string($_POST['oe_codigo']);
$oe_nombre=mysql_real_escape_string($_POST['oe_nombre']);
$oe_area=mysql_real_escape_string($_POST['oe_area']);
$query="UPDATE objetivos_estrategicos SET oe_codigo='".utf8_decode($oe_codigo)."', oe_nombre='".utf8_decode($oe_nombre)."', oe_area='".utf8_decode($oe_area)."' WHERE oe_id=".$oe_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
header('Location: index.php');
?>
