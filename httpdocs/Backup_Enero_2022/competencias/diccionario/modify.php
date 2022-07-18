<?php session_start();
include("../../login/sesion_start.php");
include("../../login/sesion_start_rrhh.php");
include("../../librerias/librerias.php");
include("../../cabecera-competencias.php");
$conn=db_connect();
$dic_id=$_REQUEST['dic_id'];
//$dic_id=$_REQUEST['dic_id'];
$dic_nombre=mysql_real_escape_string($_POST['dic_nombre']);
$query="UPDATE com_diccionarios SET dic_nombre='".utf8_decode($dic_nombre)."' WHERE dic_id=".$dic_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
header('Location: index.php?dic_id='.$dic_id);
?>
