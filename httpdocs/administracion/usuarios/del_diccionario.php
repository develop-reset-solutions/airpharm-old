<?php session_start();
include("../../login/sesion_start.php");
include("../../librerias/librerias.php");
include("../../cabecera.php");
$conn=db_connect();
$usr_id=$_REQUEST['usr_id'];
//$dic_id=$_REQUEST['dic_id'];
$du_id=$_REQUEST['du_id'];
$query="DELETE FROM com_diccionarios_usuarios WHERE du_id=".$du_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);

$query_d_duc="DELETE FROM com_dic_usr_com WHERE duc_du_id=".$du_id;
//$query_d_duc="INSERT INTO com_dic_usr_com (duc_du_id, duc_com_id) VALUES (".$du_id.", ".$row_com_dic['cd_com_id'].")";
$result=mysql_query($query_d_duc) or die("No se puede ejecutar la sentencia: ".$query_d_duc);

$query_d_ducp="DELETE FROM com_dic_usr_comp WHERE ducp_du_id=".$du_id;
//$query_d_ducp="INSERT INTO com_dic_usr_comp (ducp_du_id, ducp_comp_id) VALUES (".$du_id.", ".$row_comp_act_com_dic['cacd_comp_id'].")";
$result=mysql_query($query_d_ducp) or die("No se puede ejecutar la sentencia: ".$query_d_ducp);	
	
header("Location: edit.php?usr_id=".$usr_id);
?>
