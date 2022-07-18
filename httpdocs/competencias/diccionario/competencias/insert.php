<?php session_start();
include("../../../login/sesion_start.php");
include("../../../login/sesion_start_rrhh.php");
include("../../../librerias/librerias.php");
include("../../../cabecera-competencias.php");
$conn=db_connect();
$dic_id=$_REQUEST['dic_id'];
$com_id=$_REQUEST['com_id'];
$cd_orden=$_REQUEST['cd_orden'];

$query="INSERT INTO com_com_dic (cd_dic_id, cd_com_id, cd_orden) VALUES ('".$dic_id."', '".$com_id."', '".$cd_orden."')";

$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);


header('Location: create.php?dic_id='.$dic_id);

?>
