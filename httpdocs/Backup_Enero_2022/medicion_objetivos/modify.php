<?php session_start();
include("../login/sesion_start.php");
include("../librerias/librerias.php");
include("../cabecera.php");
$conn=db_connect();
$dpo_id=$_GET['dpo_id'];
$oa_id=$_POST['oa_id'];
$ind_responsable=$_POST['ind_responsable'];
$ind_nombre=$_POST['ind_nombre'];
$ind_codigo=$_POST['ind_codigo'];
$oa_observaciones=$_POST['oa_observaciones'];
$ind_mide=$_POST['ind_mide'];
$ind_meta_un_id=$_POST['ind_meta_un_id'];
$ind_trim_acum=$_POST['ind_trim_acum'];
$oa_horquilla_min=$_POST['oa_horquilla_min'];
$oa_horquilla_max=$_POST['oa_horquilla_max'];
$oa_meta=$_POST['oa_meta'];
$dl_peso=$_POST['dl_peso'];
$ind_grupo_individual=$_POST['ind_grupo_individual'];
$query="SELECT * FROM vobjetivos_ano WHERE oa_id=".$oa_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
$row=mysql_fetch_array($result);
$query_oa="UPDATE objetivos_ano SET oa_horquilla_max='".$oa_horquilla_max."', oa_horquilla_min='".$oa_horquilla_min."', oa_meta='".$oa_meta."', ind_nombre='".utf8_decode($ind_nombre)."', ind_codigo='".utf8_decode($ind_codigo)."', oa_observaciones='".utf8_decode($oa_observaciones)."',ind_responsable='".$ind_responsable."',ind_mide='".$ind_mide."',ind_meta_un_id='".$ind_meta_un_id."',ind_trim_acum='".$ind_trim_acum."',ind_grupo_individual='".$ind_grupo_individual."' WHERE oa_id=".$oa_id;
$result_oa=mysql_query($query_oa) or die("No se puede ejecutar la sentencia: ".$query_oa);
/*$query_ind="UPDATE indicadores SET ind_nombre='".utf8_decode($ind_nombre)."',ind_responsable='".$ind_responsable."',ind_mide='".$ind_mide."',ind_meta_un_id='".$ind_meta_un_id."',ind_trim_acum='".$ind_trim_acum."' WHERE ind_id=".$row['oa_ind_id'];
$result_ind=mysql_query($query_ind) or die("No se puede ejecutar la sentencia: ".$query_ind);
*/if(utf8_encode($row['ind_grupo_individual'])=='Grupo'){
		$dl_rdo_q1_all=$_POST['dl_rdo_q1_all'];
		$dl_rdo_q2_all=$_POST['dl_rdo_q2_all'];
		$dl_rdo_q3_all=$_POST['dl_rdo_q3_all'];
		$dl_rdo_q4_all=$_POST['dl_rdo_q4_all'];
		$dl_rdo_anual_all=$_POST['dl_rdo_anual_all'];
		$query_dli="UPDATE dpo_lineas SET dl_rdo_q1='".$dl_rdo_q1_all."', dl_rdo_q2='".$dl_rdo_q2_all."', dl_rdo_q3='".$dl_rdo_q3_all."', dl_rdo_q4='".$dl_rdo_q4_all."', dl_rdo_anual='".$dl_rdo_anual_all."' WHERE dl_oa_id=".$oa_id;
		$result_dli=mysql_query($query_dli) or die("No se puede ejecutar la sentencia: ".$query_dli);
}else{
		$query_dl="SELECT * FROM vdpo_lineas WHERE dl_oa_id=".$oa_id;
		$result_dl=mysql_query($query_dl) or die("No se puede ejecutar la sentencia: ".$query_dl);

		while($row_dl=mysql_fetch_array($result_dl)){
				$q1='dl_rdo_q1_'.$row_dl['dl_id'];
				$q2='dl_rdo_q2_'.$row_dl['dl_id'];
				$q3='dl_rdo_q3_'.$row_dl['dl_id'];
				$q4='dl_rdo_q4_'.$row_dl['dl_id'];
				$dl_rdo_q1_all=$_POST[$q1];
				$dl_rdo_q2_all=$_POST[$q2];
				$dl_rdo_q3_all=$_POST[$q3];
				$dl_rdo_q4_all=$_POST[$q4];
				$anual='dl_rdo_anual_'.$row_dl['dl_id'];
				$dl_rdo_anual_all=$_POST[$anual];
		$query_dli="UPDATE dpo_lineas SET dl_rdo_q1='".$dl_rdo_q1_all."', dl_rdo_q2='".$dl_rdo_q2_all."', dl_rdo_q3='".$dl_rdo_q3_all."', dl_rdo_q4='".$dl_rdo_q4_all."', dl_rdo_anual='".$dl_rdo_anual_all."' WHERE dl_id=".$row_dl['dl_id'];
		$result_dli=mysql_query($query_dli) or die("No se puede ejecutar la sentencia: ".$query_dli);
	}
}
if(strncmp($row['obj_tipo'],'Objetivo de compañia',7)==0 or strncmp($row['obj_tipo'],'Para el Comité de Dirección',4)==0 or $row['obj_tipo']=='Mandos Intermedios'){
	$query_dl="UPDATE dpo_lineas SET dl_peso='".$dl_peso."' WHERE dl_oa_id=".$oa_id;
	$result_dl=mysql_query($query_dl) or die("No se puede ejecutar la sentencia: ".$query_dl);
}
header('Location: show.php?oa_id='.$oa_id.'&dpo_id='.$dpo_id);
?>
