<?php session_start();
include("../login/sesion_start.php");
include("../librerias/librerias.php");
include("../cabecera.php");
$conn=db_connect();
$usr_id=$_POST['usr_id'];
$dpo_id=$_POST['dpo_id'];
$anomenosnum=$_SESSION['ano']-1;
$anomenos="_".$anomenosnum;
$origen_ant=false;
//echo $anomenos;
if(substr($dpo_id,-5)==$anomenos){
	$origen_ant=true;
	$dpo_id=substr($dpo_id,0,-5);

}
$query="SELECT * FROM dpo_cabeceras WHERE dpo_usr_id=".$usr_id." AND dpo_ano=".$_SESSION['ano'];
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
$num=mysql_num_rows($result);
if($num){
	$row=mysql_fetch_array($result);
	$dpo_id_new=$row['dpo_id'];
	$query_d="DELETE FROM dpo_lineas WHERE dl_dpo_id=".$dpo_id_new;
	$result_d=mysql_query($query_d) or die("No se puede ejecutar la sentencia: ".$query_d);
}else{
	$query="INSERT INTO dpo_cabeceras (dpo_usr_id, dpo_ano, dpo_status_id, dpo_fecha_ultimo_cambio_status) VALUES ('".$usr_id."','".$_SESSION['ano']."',1,'".date('Y-m-d')."')";
	$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
	$query_dpo="SELECT * FROM dpo_cabeceras WHERE dpo_usr_id=".$usr_id." AND dpo_ano=".$_SESSION['ano'];
	$result_dpo=mysql_query($query_dpo) or die("No se puede ejecutar la sentencia: ".$query_dpo);
	$row_dpo=mysql_fetch_array($result_dpo);
	$dpo_id_new=$row_dpo['dpo_id'];
}
if($dpo_id<>'vacia'){
	if($origen_ant){
		$query_dl="SELECT * FROM dpo_lineas WHERE dl_dpo_id=".$dpo_id;
		$result_dl=mysql_query($query_dl) or die("No se puede ejecutar la sentencia: ".$query_dl);
		while($row_dl=mysql_fetch_array($result_dl)){
			$query_oa="SELECT * FROM objetivos_ano WHERE oa_id_ano_ant=".$row_dl['dl_oa_id'];
			$result_oa=mysql_query($query_oa) or die("No se puede ejecutar la sentencia: ".$query_oa);
			$num_oa=mysql_num_rows($result_oa);
			if($num_oa>0){
				$row_oa=mysql_fetch_array($result_oa);
				$dl_oa_id=$row_oa['oa_id'];
			}else{
				$query_oa2="SELECT * FROM objetivos_ano WHERE oa_id=".$row_dl['dl_oa_id'];
				$result_oa2=mysql_query($query_oa2) or die("No se puede ejecutar la sentencia: ".$query_oa2);
				$row_oa2=mysql_fetch_array($result_oa2);
				$query_ioa="INSERT INTO objetivos_ano(oa_ind_id,oa_ano,oa_lider_id,oa_meta,oa_status_id,oa_observaciones,oa_horquilla_min,oa_horquilla_max,oa_peso,ind_nombre,ind_codigo,ind_responsable,ind_mide,ind_obj_id,ind_meta_un_id,ind_horq_un_id,ind_trim_acum,ind_grupo_individual,oa_id_ano_ant) VALUES ('".$row_oa2['oa_ind_id']."','".$_SESSION['ano']."','".$row_oa2['oa_lider_id']."','".$row_oa2['oa_meta']."','".$row_oa2['oa_status_id']."','".$row_oa2['oa_observaciones']."','".$row_oa2['oa_horquilla_min']."','".$row_oa2['oa_horquilla_max']."','".$row_oa2['oa_peso']."','".$row_oa2['ind_nombre']."','".$row_oa2['ind_codigo']."','".$row_oa2['ind_responsable']."','".$row_oa2['ind_mide']."','".$row_oa2['ind_obj_id']."','".$row_oa2['ind_meta_un_id']."','".$row_oa2['ind_horq_un_id']."','".$row_oa2['ind_trim_acum']."','".$row_oa2['ind_grupo_individual']."','".$row_oa2['oa_id']."')"; 
				$result_ioa=mysql_query($query_ioa) or die("No se puede ejecutar la sentencia: ".$query_ioa);
				$query_oaa="SELECT * FROM objetivos_ano WHERE oa_id_ano_ant=".$row_oa2['oa_id'];
				$result_oaa=mysql_query($query_oaa) or die("No se puede ejecutar la sentencia: ".$query_oaa);
				$row_oaa=mysql_fetch_array($result_oaa);
				$dl_oa_id=$row_oaa['oa_id'];
			}
			$query="INSERT INTO dpo_lineas (dl_dpo_id, dl_oa_id, dl_status,dl_peso) VALUES (".$dpo_id_new.",'".$dl_oa_id."','".$row_dl['dl_status']."','".$row_dl['dl_peso']."')";
			$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
		}
	}else{
		$query_dl="SELECT * FROM dpo_lineas WHERE dl_dpo_id=".$dpo_id;
		$result_dl=mysql_query($query_dl) or die("No se puede ejecutar la sentencia: ".$query_dl);
		while($row_dl=mysql_fetch_array($result_dl)){
			$query="INSERT INTO dpo_lineas (dl_dpo_id, dl_oa_id, dl_peso, dl_status,dl_rdo_q1,dl_rdo_q2,dl_rdo_q3,dl_rdo_q4,dl_rdo_anual) VALUES (".$dpo_id_new.",'".$row_dl['dl_oa_id']."','".$row_dl['dl_peso']."','".$row_dl['dl_status']."','".$row_dl['dl_rdo_q1']."','".$row_dl['dl_rdo_q2']."','".$row_dl['dl_rdo_q3']."','".$row_dl['dl_rdo_q4']."','".$row_dl['dl_rdo_anual']."')";
			$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
		}
	}
}
$query="SELECT * FROM usuarios WHERE usr_id=".$usr_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
$row=mysql_fetch_array($result);
if($dpo_id=='vacia'){
	crear_log("dpo_creacion/insert.php","Crear dpo ".$_SESSION['ano']." de ".$row['usr_nombre']." ".$row["usr_apellidos"]." con plantilla vacia");
}else{
	$query_dp="SELECT * FROM vdpo_cabeceras WHERE dpo_id=".$dpo_id;
	$result_dp=mysql_query($query_dp) or die("No se puede ejecutar la sentencia: ".$query_dp);
	$row_dp=mysql_fetch_array($result_dp);
	crear_log("dpo_creacion/insert.php","Crear dpo ".$_SESSION['ano']." de ".$row['usr_nombre']." ".$row["usr_apellidos"]." con dpo de ".$row_dp['usr_nombre']." ".$row_dp["usr_apellidos"]);
}
header('Location: ../dpo/index.php?dpo_id='.$dpo_id_new);
?>