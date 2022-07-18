<?php session_start();
include("../login/sesion_start.php");
include("../librerias/librerias.php");
include("../cabecera.php");
$conn=db_connect();
$filtros='';
if($_POST['filtrar']){
	$filtros.='&filtrar='.$_POST['filtrar'];
	$filtrar=$_POST['filtrar'];
	if($_POST['f_obj_descripcion']){
		$f_obj_descripcion=$_GET['f_obj_descripcion'];
		$filtros.='&f_obj_descripcion='.$f_obj_descripcion;
	}
	if($_GET['obj_tipo']<>'all'){
		$f_obj_tipo=$_GET['f_obj_tipo'];
		$filtros.='&f_obj_tipo='.$f_obj_tipof;
	}
}
$obj_descripcion=mysql_real_escape_string($_POST['obj_descripcion']);
$obj_tipo=mysql_real_escape_string($_POST['obj_tipo']);
$obj_lider_id=$_POST['obj_lider_id'];
$query_oe = "SELECT * FROM objetivos_estrategicos";
$result_oe=mysql_query($query_oe) or die ("No se puede ejecutar la sentencia: ".$query_oe);
$ooe_oe_id = array();
while ($row_oe = mysql_fetch_array($result_oe)){
	$n=$row_oe['oe_id'];
	array_push ($ooe_oe_id,$_POST[$n]);
}
$query="INSERT INTO objetivos (obj_descripcion, obj_tipo, obj_lider_id) VALUES ('".utf8_decode($obj_descripcion)."','".utf8_decode($obj_tipo)."',".$obj_lider_id.")";
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
$query_obj = "SELECT * FROM objetivos ORDER BY obj_id DESC";
$result_obj=mysql_query($query_obj) or die ("No se puede ejecutar la sentencia: ".$query_obj);
$row_obj=mysql_fetch_array($result_obj);
foreach ($ooe_oe_id as $i){
	if ($i){
		$sqlquery = "INSERT INTO objetivos_objetivos_estrategicos (ooe_obj_id, ooe_oe_id) VALUES (".$row_obj['obj_id'].", ".$i.")";
		$queryresult = mysql_query($sqlquery) or die ("No se puede ejecutar la sentencia Insert");
	}
}
$query = "SELECT * FROM objetivos ORDER BY obj_id DESC";
$result=mysql_query($query) or die ("No se puede ejecutar la sentencia: ".$query);
$row=mysql_fetch_array($result);
header('Location: show.php?obj_id='.$row['obj_id']);
?>