<?php session_start();
include("../../../login/sesion_start.php");
include("../../../login/sesion_start_rrhh.php");
include("../../../librerias/librerias.php");
include("../../../cabecera-competencias.php");
$conn=db_connect();
$com_id=$_POST['com_id'];
$com_nombre=mysql_real_escape_string($_POST['com_nombre']);
$com_descripcion=mysql_real_escape_string($_POST['com_descripcion']);
$query="UPDATE com_competencias SET com_nombre='".utf8_decode($com_nombre)."', com_descripcion='".utf8_decode($com_descripcion)."' WHERE com_id=".$com_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
header('Location: index.php');
?>
