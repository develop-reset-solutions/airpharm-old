<?php session_start();
include("../login/sesion_start.php");
include("../librerias/librerias.php");
include("../cabecera.php");
$conn=db_connect();
$oa_id=$_POST['oa_id'];
$oa_horquilla_max=mysql_real_escape_string($_POST['oa_horquilla_max']);
$oa_horquilla_min=mysql_real_escape_string($_POST['oa_horquilla_min']);
$oa_meta=mysql_real_escape_string($_POST['oa_meta']);
$oa_observaciones=mysql_real_escape_string($_POST['oa_observaciones']);
$oa_status_id=mysql_real_escape_string($_POST['oa_status_id']);
$query="UPDATE objetivos_ano SET oa_horquilla_max='".utf8_decode($oa_horquilla_max)."', oa_horquilla_min='".utf8_decode($oa_horquilla_min)."', oa_meta='".utf8_decode($oa_meta)."', oa_observaciones='".utf8_decode($oa_observaciones)."', oa_status_id='".utf8_decode($oa_status_id)."' WHERE oa_id=".$oa_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
header('Location: show.php?oa_id='.$oa_id);
?>
