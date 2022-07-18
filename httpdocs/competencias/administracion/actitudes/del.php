<?php session_start();
include("../../../login/sesion_start.php");
include("../../../login/sesion_start_rrhh.php");
include("../../../librerias/librerias.php");
include("../../../cabecera-competencias.php");
$conn=db_connect();
$act_id=$_GET['act_id'];
$com_id=$_GET['com_id'];
$query="DELETE FROM com_actitudes WHERE act_id=".$act_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
header('Location: index.php?com_id='.$com_id);
?>
