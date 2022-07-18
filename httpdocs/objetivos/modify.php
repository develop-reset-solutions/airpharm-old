<?php session_start();
include("../login/sesion_start.php");
include("../librerias/librerias.php");
include("../cabecera.php");
$conn=db_connect();
$obj_id=$_POST['obj_id'];
$dpo_id=$_GET['dpo_id'];
$obj_descripcion=mysql_real_escape_string($_POST['obj_descripcion']);
$obj_tipo=mysql_real_escape_string($_POST['obj_tipo']);
$obj_lider_id=mysql_real_escape_string($_POST['obj_lider_id']);
$query_oe = "SELECT * FROM objetivos_estrategicos";
$result_oe=mysql_query($query_oe) or die ("No se puede ejecutar la sentencia: ".$query_oe);
$ooe_oe_id = array();
while ($row_oe = mysql_fetch_array($result_oe)){
	$n=$row_oe['oe_id'];
	array_push ($ooe_oe_id,$_POST[$n]);
}
$query="UPDATE objetivos SET obj_descripcion='".utf8_decode($obj_descripcion)."', obj_tipo='".utf8_decode($obj_tipo)."', obj_lider_id='".utf8_decode($obj_lider_id)."' WHERE obj_id=".$obj_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
$query_oe = "SELECT * FROM objetivos_estrategicos";
$result_oe = mysql_query($query_oe) or die ("No se puede ejecutar la sentencia: ".$query_oe);
while ($row_oe = mysql_fetch_array($result_oe)){
	$query_ooe="SELECT * FROM objetivos_objetivos_estrategicos WHERE ooe_oe_id=". $row_oe['oe_id']." AND ooe_obj_id=".$obj_id;
	$result_ooe= mysql_query($query_ooe) or die ("No se puede ejecutar la sentencia: ".$query_ooe);
	$num_ooe=mysql_num_rows($result_ooe);
	$marcado=false;
	foreach ($ooe_oe_id as $i){
		if ($i==$row_oe['oe_id']){
			$marcado=true;
		}
	}
	if ($marcado and $num_ooe==0){
		$query = "INSERT INTO objetivos_objetivos_estrategicos (ooe_oe_id, ooe_obj_id) VALUES ('" . $row_oe['oe_id'] . "', '".$obj_id."')";
		$result = mysql_query($query) or die ("No se puede ejecutar la sentencia: ".$query);
	}elseif( !$marcado and $num_ooe>0){
		$query = "DELETE FROM objetivos_objetivos_estrategicos WHERE ooe_oe_id=". $row_oe['oe_id']." AND ooe_obj_id='".$obj_id."'";
		$result = mysql_query($query) or die ("No se puede ejecutar la sentencia: ".$query);
	}
}
header('Location: show.php?dpo_id='.$dpo_id.'&obj_id='.$obj_id);
?>
