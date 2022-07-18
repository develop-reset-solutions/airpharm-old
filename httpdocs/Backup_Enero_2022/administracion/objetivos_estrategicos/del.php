<?php session_start();
include("../../login/sesion_start.php");
include("../../librerias/librerias.php");
include("../../cabecera.php");
$conn=db_connect();
$oe_id=$_GET['oe_id'];
$query="DELETE FROM objetivos_estrategicos WHERE oe_id=".$oe_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
header('Location: index.php');
?>
