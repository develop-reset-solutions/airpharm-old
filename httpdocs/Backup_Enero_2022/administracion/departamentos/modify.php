<?php session_start();
include("../../login/sesion_start.php");
include("../../librerias/librerias.php");
include("../../cabecera.php");
$conn=db_connect();
$dep_id=$_POST['dep_id'];
$dep_nombre=mysql_real_escape_string($_POST['dep_nombre']);
$dep_director_id=$_POST['dep_director_id'];
$query="UPDATE departamentos SET dep_nombre='".utf8_decode($dep_nombre)."', dep_director_id='".$dep_director_id."' WHERE dep_id=".$dep_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
header('Location: index.php');
?>
