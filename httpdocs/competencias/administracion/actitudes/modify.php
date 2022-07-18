<?php session_start();
include("../../../login/sesion_start.php");
include("../../../login/sesion_start_rrhh.php");
include("../../../librerias/librerias.php");
include("../../../cabecera-competencias.php");
$conn=db_connect();
$act_id=$_REQUEST['act_id'];
$com_id=$_REQUEST['com_id'];
$act_nombre=mysql_real_escape_string($_POST['act_nombre']);
$query="UPDATE com_actitudes SET act_nombre='".utf8_decode($act_nombre)."' WHERE act_id=".$act_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
header('Location: index.php?com_id='.$com_id);
?>
