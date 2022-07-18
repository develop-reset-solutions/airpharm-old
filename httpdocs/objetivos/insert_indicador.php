<?php 
session_start();
include("../login/sesion_start.php");
include("../librerias/librerias.php");
include("../cabecera.php");
$conn=db_connect();
$obj_id=$_POST['obj_id'];
$ind_nombre=mysql_real_escape_string($_POST['ind_nombre']);
$ind_codigo=mysql_real_escape_string($_POST['ind_codigo']);
$ind_mide=$_POST['ind_mide'];
$ind_responsable=$_POST['ind_responsable'];
$ind_trim_acum=mysql_real_escape_string($_POST['ind_trim_acum']);
$oa_horquilla_min=$_POST['oa_horquilla_min'];
$oa_horquilla_max=$_POST['oa_horquilla_max'];
$oa_meta=$_POST['oa_meta'];
$ind_meta_un_id=$_POST['ind_meta_un_id'];
$ind_grupo_individual=$_POST['ind_grupo_individual'];


/*$query="INSERT INTO indicadores (ind_obj_id, ind_nombre,ind_codigo,ind_mide,ind_responsable,ind_meta_un_id,ind_horq_un_id,ind_trim_acum) VALUES ('".$obj_id."','".utf8_decode($ind_nombre)."','".utf8_decode($ind_codigo)."','".$ind_mide."','".$ind_responsable."','".$ind_meta_un_id."','1','".utf8_decode($ind_trim_acum)."')";
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
$query_ind = "SELECT * FROM indicadores ORDER BY ind_id DESC";
$result_ind=mysql_query($query_ind) or die ("No se puede ejecutar la sentencia: ".$query_ind);
$row_ind=mysql_fetch_array($result_ind); 
*/

$query = "INSERT INTO objetivos_ano (oa_ano, oa_meta, oa_horquilla_min, oa_horquilla_max, ind_obj_id, ind_nombre, ind_codigo, ind_mide, ind_responsable, ind_meta_un_id, ind_horq_un_id, ind_trim_acum, ind_grupo_individual) VALUES ('".$_SESSION['ano']."','".$oa_meta."','".$oa_horquilla_min."','".$oa_horquilla_max."', '".$obj_id."','".utf8_decode($ind_nombre)."','".utf8_decode($ind_codigo)."','".$ind_mide."','".$ind_responsable."','".$ind_meta_un_id."', '1','".utf8_decode($ind_trim_acum)."','".utf8_decode($ind_grupo_individual)."')";
$result=mysql_query($query) or die ("No se puede ejecutar la sentencia: ".$query); 
$query_oa = "SELECT * FROM objetivos_ano ORDER BY oa_id DESC";
$result_oa=mysql_query($query_oa) or die ("No se puede ejecutar la sentencia: ".$query_oa);
$row_oa=mysql_fetch_array($result_oa);
header('Location: edit_usuarios.php?oa_id='.$row_oa['oa_id']);?>  