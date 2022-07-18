<?php session_start();
include("../../login/sesion_start.php");
include("../../login/sesion_start_rrhh.php");
include("../../librerias/librerias.php");
include("../../cabecera-competencias.php");
$conn=db_connect();
//cd_id, grado
$cd_id=$_REQUEST['cd_id'];
$grado=$_REQUEST['grado'];
$act_id=$_REQUEST['act_id'];
$query="UPDATE com_act_com_dic SET acd_act_id='".$act_id."' WHERE acd_cd_id=".$cd_id." AND acd_grado='".$grado."'" ;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
echo $query;
//header('Location: show_c.php?dic_id='.$dic_id);
?>
