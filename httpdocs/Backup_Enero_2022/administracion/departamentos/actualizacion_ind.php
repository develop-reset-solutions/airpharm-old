<?php session_start();
include("../../login/sesion_start.php");
include("../../librerias/librerias.php");
include("../../cabecera.php");
$conn=db_connect();
$query="SELECT * FROM objetivos_ano";
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
while($row=mysql_fetch_array($result)){
	$query_ind="SELECT * FROM indicadores WHERE ind_id=".$row['oa_ind_id'];
	$result_ind=mysql_query($query_ind) or die("No se puede ejecutar la sentencia: ".$query_ind);
	$row_ind=mysql_fetch_array($result_ind);
	$query_oa='UPDATE objetivos_ano SET ind_nombre="'.$row_ind['ind_nombre'].'",ind_codigo="'.$row_ind['ind_codigo'].'",ind_responsable="'.$row_ind['ind_responsable'].'",ind_mide="'.$row_ind['ind_mide'].'",ind_obj_id="'.$row_ind['ind_obj_id'].'",ind_meta_un_id="'.$row_ind['ind_meta_un_id'].'",ind_horq_un_id="'.$row_ind['ind_horq_un_id'].'",ind_trim_acum="'.$row_ind['ind_trim_acum'].'" WHERE oa_id='.$row['oa_id'];
	$result_oa=mysql_query($query_oa) or die("No se puede ejecutar la sentencia: ".$query_oa);
	echo "Actualizado oa_id= ".$row['oa_id']."<br>";
}
?>
