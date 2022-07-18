<?php session_start();
include("../../../login/sesion_start.php");
include("../../../login/sesion_start_rrhh.php");
include("../../../librerias/librerias.php");
include("../../../cabecera-competencias.php");
$conn=db_connect();
$comp_id=$_GET['comp_id'];
$act_id=$_GET['act_id'];
$query="DELETE FROM com_comportamientos WHERE comp_id=".$comp_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
header('Location: index.php?act_id='.$act_id);
?>
