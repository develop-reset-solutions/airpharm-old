<?php session_start();
include("../login/sesion_start.php");
include("../librerias/librerias.php");
include("../cabecera.php");
$conn=db_connect();
$oau_usr_id=$_GET['oau_usr_id'];
$oau_oa_id=$_GET['oau_oa_id'];
if($oau_usr_id=='all'){
	$query="SELECT * FROM usuarios WHERE usr_baja=0 AND (usr_perfil='Director RRHH' OR usr_perfil='Usuario')";
	$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
	while($row=mysql_fetch_array($result)){
		$query_oau="SELECT * FROM obj_ano_usuarios WHERE oau_usr_id=".$row['usr_id']." AND oau_oa_id=".$oau_oa_id;
		$result_oau=mysql_query($query_oau) or die("No se puede ejecutar la sentencia: ".$query_oau);
		$num_oau=mysql_num_rows($result_oau);
		if(!$num_oau){
			$query_ioau="INSERT INTO obj_ano_usuarios (oau_usr_id, oau_oa_id) VALUES (".$row['usr_id'].", ".$oau_oa_id.")";
			$result_ioau=mysql_query($query_ioau) or die("No se puede ejecutar la sentencia: ".$query_ioau);
		}
	}
}elseif(substr($oau_usr_id,0,3)=='dep'){
	$query="SELECT * FROM usuarios WHERE usr_dep_id=".substr($oau_usr_id,4)." AND usr_baja=0 AND (usr_perfil='Director RRHH' OR usr_perfil='Usuario')";
	$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
	while($row=mysql_fetch_array($result)){
		$query_oau="SELECT * FROM obj_ano_usuarios WHERE oau_usr_id=".$row['usr_id']." AND oau_oa_id=".$oau_oa_id;
		$result_oau=mysql_query($query_oau) or die("No se puede ejecutar la sentencia: ".$query_oau);
		$num_oau=mysql_num_rows($result_oau);
		if(!$num_oau){
			$query_ioau="INSERT INTO obj_ano_usuarios (oau_usr_id, oau_oa_id) VALUES (".$row['usr_id'].", ".$oau_oa_id.")";
			$result_ioau=mysql_query($query_ioau) or die("No se puede ejecutar la sentencia: ".$query_ioau);
		}
	}
}else{
	$query="INSERT INTO obj_ano_usuarios (oau_usr_id, oau_oa_id) VALUES (".substr($oau_usr_id,4).", ".$oau_oa_id.")";
	$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
}
header('Location: edit.php?oa_id='.$oau_oa_id);?>