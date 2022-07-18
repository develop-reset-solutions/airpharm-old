<?php session_start();
include("../../login/sesion_start.php");
include("../../librerias/librerias.php");
include("../../cabecera.php");
$conn=db_connect();
$dep_nombre=mysql_real_escape_string($_POST['dep_nombre']);
$dep_director_id=$_POST['dep_director_id'];
$query="INSERT INTO departamentos (dep_nombre, dep_director_id) VALUES ('".utf8_decode($dep_nombre)."', '".$dep_director_id."')";
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
header('Location: index.php');
?>
