<?php session_start();
include("../../../login/sesion_start.php");
include("../../../login/sesion_start_rrhh.php");
include("../../../librerias/librerias.php");
include("../../../cabecera-competencias.php");
$conn=db_connect();
$cd_orden=$_REQUEST['orden'];
$dic_id=$_REQUEST['dic_id'];
$query="DELETE FROM com_com_dic WHERE cd_dic_id=".$dic_id." AND cd_orden=".$cd_orden;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
header('Location: ../show.php?dic_id='.$dic_id);

?>
