<?php session_start();
include("../../login/sesion_start.php");
include("../../librerias/librerias.php");
include("../../cabecera.php");
$conn=db_connect();
$cen_id=$_GET['cen_id'];
$query="DELETE FROM centros WHERE cen_id=".$cen_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
header('Location: index.php');
?>
