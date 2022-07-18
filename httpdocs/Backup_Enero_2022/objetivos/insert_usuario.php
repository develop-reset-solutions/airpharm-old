<?php session_start();
include("../login/sesion_start.php");
include("../librerias/librerias.php");
include("../cabecera.php");
$conn=db_connect();
$oau_usr_id=$_GET['oau_usr_id'];
$oau_oa_id=$_GET['oau_oa_id'];
$dpo_id=$_GET['dpo_id'];
if($oau_usr_id=='all'){
	$query_dpo="SELECT * FROM dpo_cabeceras WHERE dpo_ano=".$_SESSION['ano'];
	$result_dpo=mysql_query($query_dpo) or die ("No se puede ejcutar la consulta: ".$query_dpo);
	while($row_dpo=mysql_fetch_array($result_dpo)){
		$query_dl="SELECT * FROM dpo_lineas WHERE dl_dpo_id=".$row_dpo['dpo_id']." AND dl_oa_id=".$oau_oa_id;
		$result_dl=mysql_query($query_dl) or die ("No se puede ejcutar la consulta: ".$query_dl);
		$num_dl=mysql_num_rows($result_dl);
		if(!$num_dl){
			$query="INSERT INTO dpo_lineas (dl_dpo_id, dl_oa_id,dl_peso,dl_status) VALUES ('".$row_dpo['dpo_id']."','".$oau_oa_id."',0,'Aprobado')";
			$result=mysql_query($query) or die ("No se puede ejcutar la consulta: ".$query);
		}
	}
}elseif(substr($oau_usr_id,0,3)=='dep'){
	$dep_id=substr($oau_usr_id,4,3);
	$query_dep="SELECT * FROM usuarios WHERE usr_dep_id=".$dep_id;
	$result_dep=mysql_query($query_dep) or die ("No se puede ejecutar la sentencia: ".$query_dep);
	while($row_dep=mysql_fetch_array($result_dep)){
		$query_dpo="SELECT * FROM dpo_cabeceras WHERE dpo_usr_id=".$row_dep['usr_id']." AND dpo_ano=".$_SESSION['ano'];
		$result_dpo=mysql_query($query_dpo) or die ("No se puede ejecutar la sentencia: ".$query_dpo);
		$num_dpo=mysql_num_rows($result_dpo);
		if($num_dpo){
			$row_dpo=mysql_fetch_array($result_dpo);
			$query_dl="SELECT * FROM dpo_lineas WHERE dl_dpo_id=".$row_dpo['dpo_id']." AND dl_oa_id=".$oau_oa_id;
			$result_dl=mysql_query($query_dl) or die ("No se puede ejcutar la consulta: ".$query_dl);
			$num_dl=mysql_num_rows($result_dl);
			if(!$num_dl){
				$query="INSERT INTO dpo_lineas (dl_dpo_id, dl_oa_id,dl_peso,dl_status) VALUES ('".$row_dpo['dpo_id']."','".$oau_oa_id."',0,'Aprobado')";
				$result=mysql_query($query) or die ("No se puede ejcutar la consulta: ".$query);
			}
		}
	}
}else{
	$query_dpo="SELECT * FROM dpo_cabeceras WHERE dpo_usr_id=".$oau_usr_id." AND dpo_ano=".$_SESSION['ano'];
	$result_dpo=mysql_query($query_dpo) or die ("No se puede ejecutar la sentencia: ".$query_dpo);
	$num_dpo=mysql_num_rows($result_dpo);
	if($num_dpo){
		$row_dpo=mysql_fetch_array($result_dpo);
		$query_dl="SELECT * FROM dpo_lineas WHERE dl_dpo_id=".$row_dpo['dpo_id']." AND dl_oa_id=".$oau_oa_id;
		$result_dl=mysql_query($query_dl) or die ("No se puede ejcutar la consulta: ".$query_dl);
		$num_dl=mysql_num_rows($result_dl);
		if(!$num_dl){
			$query="INSERT INTO dpo_lineas (dl_dpo_id, dl_oa_id,dl_peso,dl_status) VALUES ('".$row_dpo['dpo_id']."','".$oau_oa_id."',0,'Aprobado')";
			$result=mysql_query($query) or die ("No se puede ejcutar la consulta: ".$query);
		}
	}
}
header('Location: edit_usuarios.php?oa_id='.$oau_oa_id.'&dpo_id='.$dpo_id);?>