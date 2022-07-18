<?php session_start();
include("../login/sesion_start.php");
include("../librerias/librerias.php");
include("../cabecera.php");
$conn=db_connect();
$dpo_id=$_POST['dpo_id'];
if($_POST['Guardar']){
	$query_dpo="SELECT * FROM dpo_cabeceras WHERE dpo_id=".$dpo_id;
	$result_dpo=mysql_query($query_dpo) or die ("No se puede ejecutar la sentencia: ".$query_dpo);
	$row_dpo=mysql_fetch_array($result_dpo);
	$dpo_usr_id=$row_dpo['dpo_usr_id'];
	$query_lin="SELECT * FROM vdpo_lineas WHERE dl_dpo_id=".$dpo_id;
	$result_lin=mysql_query($query_lin) or die ("No se puede ejecutar la sentencia: ".$query_lin);
	while($row_lin=mysql_fetch_array($result_lin)){
		if($row_lin['ind_mide']==$_SESSION['usr_id'] or ($row_lin['ind_mide']==9999 and ($_SESSION['usr_id']<>$dpo_usr_id or utf8_encode($_SESSION['usr_categoria'])=='Dirección'))){
			$variable='dl_rdo_q1_'.$row_lin['dl_id'];
			$dl_rdo_q1=$_POST[$variable];
			$variable='dl_rdo_q2_'.$row_lin['dl_id'];
			$dl_rdo_q2=$_POST[$variable];
			$variable='dl_rdo_q3_'.$row_lin['dl_id'];
			$dl_rdo_q3=$_POST[$variable];
			$variable='dl_rdo_q4_'.$row_lin['dl_id'];
			$dl_rdo_q4=$_POST[$variable];
			$variable='dl_rdo_anual_'.$row_lin['dl_id'];
			$dl_rdo_anual=$_POST[$variable];
			if(utf8_encode($row_lin['ind_grupo_individual'])=='Grupo'){
				$query_dli="UPDATE dpo_lineas SET dl_rdo_q1='".$dl_rdo_q1."', dl_rdo_q2='".$dl_rdo_q2."', dl_rdo_q3='".$dl_rdo_q3."', dl_rdo_q4='".$dl_rdo_q4."', dl_rdo_anual='".$dl_rdo_anual."' WHERE dl_oa_id=".$row_lin['dl_oa_id'];
				$result_dli=mysql_query($query_dli) or die("No se puede ejecutar la sentencia: ".$query_dli);
			}else{
				$query_dli="UPDATE dpo_lineas SET dl_rdo_q1='".$dl_rdo_q1."', dl_rdo_q2='".$dl_rdo_q2."', dl_rdo_q3='".$dl_rdo_q3."', dl_rdo_q4='".$dl_rdo_q4."', dl_rdo_anual='".$dl_rdo_anual."' WHERE dl_id=".$row_lin['dl_id'];
				$result_dli=mysql_query($query_dli) or die("No se puede ejecutar la sentencia: ".$query_dli);
				echo $query_dli."<br>";
			}
		}
	}
}
/*$query_dpo="UPDATE dpo_cabeceras SET dpo_observaciones='".utf8_decode($dpo_observaciones)."' WHERE dpo_id=".$dpo_id;
$result_dpo=mysql_query($query_dpo) or die("No se puede ejecutar la sentencia: ".$query_dpo);*/
header('Location: index.php?dpo_id='.$dpo_id);
?>
