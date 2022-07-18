<?php session_start();
include("../login/sesion_start.php");
include("../librerias/librerias.php");
include("../cabecera.php");
$conn=db_connect();
$ano=2015;
$query="SELECT * FROM objetivos_ano WHERE oa_ano=".($ano-1)." AND oa_status_id=8";
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
while($row=mysql_fetch_array($result)){
	$query_1="SELECT * FROM objetivos_ano WHERE oa_ano=".$ano." AND oa_obj_id=".$row['oa_obj_id'];
	$result_1=mysql_query($query_1) or die("No se puede ejecutar la sentencia: ".$query_1);
	$num_1=mysql_num_rows($result_1);
	if(!$num_1){
		$query_2="INSERT INTO objetivos_ano (oa_ano, oa_horquilla_max, oa_horquilla_min, oa_lider_id, oa_meta, oa_obj_id, oa_status_id) VALUES (2015,'".$row['oa_horquilla_max']."','".$row['oa_horquilla_min']."','".$row['oa_lider_id']."','".$row['oa_meta']."','".$row['oa_horquilla_max']."',1)";
		$result_2=mysql_query($query_2) or die("No se puede ejecutar la sentencia: ".$query_2);
	}
	$query_1="SELECT * FROM obj_ano_usuarios WHERE oau_oa_id=".$row['oa_id'];
	$result_1=mysql_query($query_1) or die("No se puede ejecutar la sentencia: ".$query_1);
	$query_2="SELECT oa_id FROM objetivos_ano WHERE oa_ano=".$ano." AND oa_obj_id=".$row['oa_obj_id'];
	$result_2=mysql_query($query_2) or die("No se puede ejecutar la sentencia: ".$query_2);
	$row_2=mysql_fetch_array($result_2);
	while($row_1=mysql_fetch_array($result_1)){
		$query_oau="SELECT * FROM obj_ano_usuarios WHERE oau_usr_id=".$row_1['oau_usr_id']." AND oau_oa_id=".$row_2['oa_id'];
		$result_oau=mysql_query($query_oau) or die("No se puede ejecutar la sentencia: ".$query_oau);
		$num_oau=mysql_num_rows($result_oau);
		if(!$num_oau){
			$query_ioau="INSERT INTO obj_ano_usuarios (oau_usr_id, oau_oa_id) VALUES (".$row_1['oau_usr_id'].", ".$row_2['oa_id'].")";
			$result_ioau=mysql_query($query_ioau) or die("No se puede ejecutar la sentencia: ".$query_ioau);
		}
	}
}
echo "tot ok";
?>
