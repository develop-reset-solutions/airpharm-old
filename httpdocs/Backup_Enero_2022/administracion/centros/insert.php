<?php session_start();
include("../../login/sesion_start.php");
include("../../librerias/librerias.php");
include("../../cabecera.php");
$conn=db_connect();
$cen_nombre=mysql_real_escape_string($_POST['cen_nombre']);
$query="INSERT INTO centros (cen_nombre) VALUES ('".utf8_decode($cen_nombre)."')";
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
header('Location: index.php');
?>
