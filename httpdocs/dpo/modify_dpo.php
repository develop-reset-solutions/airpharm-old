<?php session_start();
include("../login/sesion_start.php");
include("../librerias/librerias.php");
include("../cabecera.php");
$conn=db_connect();
$dpo_id=$_POST['dpo_id'];
if($_POST['Guardar']){
	$query_lin="SELECT * FROM vdpo_lineas WHERE dl_dpo_id=".$dpo_id;
	$result_lin=mysql_query($query_lin) or die ("No se puede ejecutar la sentencia: ".$query_lin);
	while($row_lin=mysql_fetch_array($result_lin)){
		$variable='dl_peso_'.$row_lin['dl_id'];
		$dl_peso=$_POST[$variable];
		$query_dli="UPDATE dpo_lineas SET dl_peso='".$dl_peso."' WHERE dl_id=".$row_lin['dl_id'];
		$result_dli=mysql_query($query_dli) or die("No se puede ejecutar la sentencia: ".$query_dli);
	}
}
/*$query_dpo="UPDATE dpo_cabeceras SET dpo_observaciones='".utf8_decode($dpo_observaciones)."' WHERE dpo_id=".$dpo_id;
$result_dpo=mysql_query($query_dpo) or die("No se puede ejecutar la sentencia: ".$query_dpo);*/
header('Location: index.php?dpo_id='.$dpo_id);
?>
