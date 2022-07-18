<?php session_start();
include("../login/sesion_start.php");
include("../librerias/librerias.php");
include("../cabecera.php");
$conn=db_connect();
$oa_id=$_GET['oa_id'];
$query="SELECT * FROM vobjetivos_ano WHERE oa_id=".$oa_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
$row=mysql_fetch_array($result);
$obj_id=$row['ind_obj_id'];
$query="DELETE FROM objetivos_ano WHERE oa_id=".$oa_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
header('Location: edit.php?obj_id='.$obj_id);
?>
