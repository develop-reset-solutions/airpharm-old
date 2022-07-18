<?php session_start();
include("../../login/sesion_start.php");
include("../../librerias/librerias.php");
include("../../cabecera-competencias.php");
$conn=db_connect();
/*
$query_cd ="SELECT * FROM com_dic_usr_com"; 
$result_cd=mysql_query($query_cd) or die("No se puede ejecutar la sentencia: ".$query_cd);
while($row_cd=mysql_fetch_array($result_cd)){
	$query_du_id ="SELECT * FROM com_diccionarios_usuarios where du_dic_id=".$row_cd['duc_dic_id']." and du_usr_id=".$row_cd['duc_usr_id']; 
	$result_du_id=mysql_query($query_du_id) or die("No se puede ejecutar la sentencia: ".$query_du_id);
	$row_du_id=mysql_fetch_array($result_du_id);
	
	$query_u_duc="UPDATE com_dic_usr_com SET duc_du_id='".$row_du_id['du_id']."' where duc_id='".$row_cd['duc_id']."'";
	$result=mysql_query($query_u_duc) or die("No se puede ejecutar la sentencia: ".$query_u_duc);
	
}*/