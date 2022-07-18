<?php session_start();
include("../../../login/sesion_start.php");
include("../../../login/sesion_start_rrhh.php");
include("../../../librerias/librerias.php");
include("../../../cabecera-competencias.php");
$conn=db_connect();
$comp_id=$_REQUEST['comp_id'];
$act_id=$_REQUEST['act_id'];
$comp_nombre=mysql_real_escape_string($_POST['comp_nombre']);
$query="UPDATE com_comportamientos SET comp_nombre='".utf8_decode($comp_nombre)."' WHERE comp_id=".$comp_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
header('Location: index.php?act_id='.$act_id);
?>
