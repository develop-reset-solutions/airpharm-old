<?php session_start();
include("../login/sesion_start.php");
include("../librerias/librerias.php");
include("../cabecera.php");
$conn=db_connect();
$dl_id=$_GET['dl_id'];
$dpo_id=$_GET['dpo_id'];
$query_dl = "SELECT * FROM dpo_lineas WHERE dl_id=".$dl_id;
$result_dl=mysql_query($query_dl) or die ("No se puede ejecutar la sentencia: ".$query_dl);
$row_dl = mysql_fetch_array($result_dl);
$oa_id=$row_dl['dl_oa_id'];
$query="DELETE FROM dpo_lineas WHERE dl_id=".$dl_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
$query="SELECT * FROM dpo_lineas WHERE dl_oa_id=".$oa_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
$num=mysql_num_rows($result);
if($num){
	header('Location: edit_usuarios.php?oa_id='.$oa_id.'&dpo_id='.$dpo_id);
}else{
	header('Location: ../objetivos/delete_indicador.php?oa_id='.$oa_id);
}
?>
