<?php session_start();
include("../../login/sesion_start.php");
include("../../login/sesion_start_rrhh.php");
include("../../librerias/librerias.php");
include("../../cabecera-competencias.php");
$conn=db_connect();
$dic_id=$_REQUEST['dic_id'];
$usr_id=$_REQUEST['usr_id'];
$fecha_cierre='null';
$query="UPDATE com_diccionarios_usuarios SET du_cerrado='0', du_fecha_cierre='".$fecha_cierre."' WHERE du_dic_id=".$dic_id." AND du_usr_id=".$usr_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);

header('Location: index.php');
?>
