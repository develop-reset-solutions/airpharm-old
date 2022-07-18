<?php session_start();
include("../../login/sesion_start.php");
include("../../librerias/librerias.php");
include("../../cabecera.php");
$conn=db_connect();
$un_nombre=mysql_real_escape_string($_POST['un_nombre']);
$un_abreviatura=mysql_real_escape_string($_POST['un_abreviatura']);
$query="INSERT INTO unidades (un_nombre,un_abreviatura) VALUES ('".utf8_decode($un_nombre)."','".utf8_decode($un_abreviatura)."')";
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
header('Location: index.php');
?>
