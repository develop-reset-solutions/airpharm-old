<?php session_start();
include("../login/sesion_start.php");
include("../librerias/librerias.php");
include("../cabecera.php");
$conn=db_connect();
$oau_usr_id = $_GET['oau_usr_id'];
$oau_oa_id = $_GET['oau_oa_id'];
$query="DELETE FROM subtipos_desccontenidos WHERE oau_usr_id=$oau_usr_id AND oau_oa_id=$oau_oa_id";
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
header("location:edit.php?oa_id=$oau_oa_id"); 
exit;
?>