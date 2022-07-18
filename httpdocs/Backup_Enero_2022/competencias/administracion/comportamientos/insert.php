<?php session_start();
include("../../../login/sesion_start.php");
include("../../../login/sesion_start_rrhh.php");
include("../../../librerias/librerias.php");
include("../../../cabecera-competencias.php");
$conn=db_connect();
$act_id=$_REQUEST['act_id'];
$comp_nombre=mysql_real_escape_string($_POST['comp_nombre']);
$query="INSERT INTO com_comportamientos (comp_nombre, comp_act_id) VALUES ('".utf8_decode($comp_nombre)."', ".$act_id.")";
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
header('Location: index.php?act_id='.$act_id);
?>
