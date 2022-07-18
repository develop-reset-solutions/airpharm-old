<?php session_start();
include("../login/sesion_start.php");
include("../librerias/librerias.php");
include("../cabecera.php");
$conn=db_connect();
$ano_a=date('Y');
$ano_s=date('Y')+1;
$query="SELECT * FROM dpo_cabeceras WHERE dpo_ano=".$ano_a;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
while($row=mysql_fetch_array($result)){
	$query_u="SELECT * FROM usuarios WHERE usr_id=".$row['dpo_usr_id'];
	$result_u=mysql_query($query_u) or die("No se puede ejecutar la sentencia: ".$query_u);
	$row_u=mysql_fetch_array($result_u);
	if($row_u['usr_baja']==0){
		$query_dpo="SELECT * FROM dpo_cabeceras WHERE dpo_ano=".$ano_s." AND dpo_usr_id=".$row['dpo_usr_id'];
		$result_dpo=mysql_query($query_dpo) or die("No se puede ejecutar la sentencia: ".$query_dpo);
		$num_dpo=mysql_num_rows($result_dpo);
		if($num_dpo>0){
			$row_dpo=mysql_fetch_array($result_dpo);
			$dpo_id_s=$row_dpo['dpo_id'];
			$query_dpo_m="UPDATE dpo_cabeceras SET dpo_fecha_ultimo_cambio_status='".date('Y-m-d')."'";
			$result_dpo_m=mysql_query($query_dpo_m) or die("No se puede ejecutar la sentencia: ".$query_dpo_m);
		}else{
			$query_dpo_m="INSERT INTO dpo_cabeceras (dpo_usr_id, dpo_ano, dpo_status_id, dpo_fecha_ultimo_cambio_status) VALUES (".$row['dpo_usr_id'].",".$ano_s.",1,'".date('Y-m-d')."')";
			$result_dpo_m=mysql_query($query_dpo_m) or die("No se puede ejecutar la sentencia: ".$query_dpo_m);
			$query_dpo_s="SELECT * FROM dpo_cabeceras WHERE dpo_ano=".$ano_s." AND dpo_usr_id=".$row['dpo_usr_id'];
			$result_dpo_s=mysql_query($query_dpo_s) or die("No se puede ejecutar la sentencia: ".$query_dpo_s);
			$row_dpo_s=mysql_fetch_array($result_dpo_s);
			$dpo_id_s=$row_dpo_s['dpo_id'];
		}
		$query_d="DELETE FROM dpo_lineas WHERE dl_dpo_id=".$dpo_id_s;
		$result_d=mysql_query($query_d) or die("No se puede ejecutar la sentencia: ".$query_d);
		$query_l="SELECT * FROM dpo_lineas WHERE dl_dpo_id=".$row['dpo_id'];
		$result_l=mysql_query($query_l) or die("No se puede ejecutar la sentencia: ".$query_l);
		while($row_l=mysql_fetch_array($result_l)){
			$query_oa="SELECT * FROM vobjetivos_ano WHERE oa_id_ano_ant=".$row_l['dl_oa_id'];
			$result_oa=mysql_query($query_oa) or die("No se puede ejecutar la sentencia: ".$query_oa);
			$num_oa=mysql_num_rows($result_oa);
			if($num_oa>0){
				$row_oa=mysql_fetch_array($result_oa);
				$oa_id=$row_oa['oa_id'];
				$query_d="DELETE FROM obj_ano_usuarios WHERE oau_usr_id=".$row['dpo_usr_id']." AND oau_oa_id=".$oa_id;
				$result_d=mysql_query($query_d) or die("No se puede ejecutar la sentencia: ".$query_d);
			}else{
				$query_oa_a="SELECT * FROM objetivos_ano WHERE oa_id=".$row_l['dl_oa_id'];
				$result_oa_a=mysql_query($query_oa_a) or die("No se puede ejecutar la sentencia: ".$query_oa_a);
				$row_oa_a=mysql_fetch_array($result_oa_a);
				$query_oa_m="INSERT INTO objetivos_ano (oa_ano, oa_horquilla_max, oa_horquilla_min, oa_lider_id, oa_meta, ind_nombre, ind_codigo, ind_responsable, ind_mide,ind_meta_un_id,ind_horq_un_id,ind_trim_acum,ind_grupo_individual, ind_obj_id, oa_status_id, oa_id_ano_ant) VALUES (".$ano_s.",'".$row_oa_a['oa_horquilla_max']."','".$row_oa_a['oa_horquilla_min']."','".$row_oa_a['oa_lider_id']."','".$row_oa_a['oa_meta']."','".$row_oa_a['ind_nombre']."','".$row_oa_a['ind_codigo']."','".$row_oa_a['ind_responsable']."','".$row_oa_a['ind_mide']."','".$row_oa_a['ind_meta_un_id']."','".$row_oa_a['ind_horq_un_id']."','".$row_oa_a['ind_trim_acum']."','".$row_oa_a['ind_grupo_individual']."','".$row_oa_a['ind_obj_id']."',1,".$row_l['dl_oa_id'].")";
				$result_oa_m=mysql_query($query_oa_m) or die("No se puede ejecutar la sentencia: ".$query_oa_m);
				$query_oa_s="SELECT * FROM objetivos_ano WHERE oa_id_ano_ant=".$row_l['dl_oa_id'];
				$result_oa_s=mysql_query($query_oa_s) or die("No se puede ejecutar la sentencia: ".$query_oa_s);
				$row_oa_s=mysql_fetch_array($result_oa_s);
				$oa_id=$row_oa_s['oa_id'];
			}
			$query_ioau="INSERT INTO obj_ano_usuarios (oau_usr_id, oau_oa_id) VALUES (".$row['dpo_usr_id'].", ".$oa_id.")";
			$result_ioau=mysql_query($query_ioau) or die("No se puede ejecutar la sentencia: ".$query_ioau);
			if($row_oa['obj_tipo']==utf8_decode('Objetivo de Compañía') or $row_oa['obj_tipo']==utf8_decode('Para el Comité de Dirección') or utf8_encode($row_oa['obj_tipo'])=='Mandos Intermedios'){
				$query_oa_a="SELECT * FROM vobjetivos_ano WHERE oa_id=".$row_l['dl_oa_id'];
				$result_oa_a=mysql_query($query_oa_a) or die("No se puede ejecutar la sentencia: ".$query_oa_a);
				$row_oa_a=mysql_fetch_array($result_oa_a);
				$query_dlp="SELECT * FROM dpo_lineas WHERE dl_oa_id=".$row_oa_a['oa_id'];
				$result_dlp=mysql_query($query_dlp) or die ("No se puede ejecutar la sentencia: ".$query_dlp);
				$row_dlp=mysql_fetch_array($result_dlp);
				$query_li="INSERT INTO dpo_lineas (dl_dpo_id, dl_oa_id, dl_peso, dl_status) VALUES(".$dpo_id_s.",".$oa_id.",".$row_dlp['dl_peso'].",'Aprobado')";
				$result_li=mysql_query($query_li) or die ("No se puede ejecutar la sentencia: ".$query_li);
			}else{
				$query_li="INSERT INTO dpo_lineas (dl_dpo_id, dl_oa_id, dl_status) VALUES(".$dpo_id_s.",".$oa_id.",'Aprobado')";
				$result_li=mysql_query($query_li) or die ("No se puede ejecutar la sentencia: ".$query_li);
			}
		}
	}
}
echo "tot ok";
?>
