<?php session_start();
include("../../login/sesion_start.php");
include("../../login/sesion_start_rrhh.php");
include("../../librerias/librerias.php");
include("../../cabecera-competencias.php");
$conn=db_connect();
$dic_agrupado=$_REQUEST['dic_agrupado'];
$dic_nombre=mysql_real_escape_string($_REQUEST['dic_nombre']);
$query="INSERT INTO com_diccionarios (dic_nombre, dic_ano, dic_agrupado) VALUES ('".utf8_decode($dic_nombre)."', '".$_SESSION['ano']."', '".$dic_agrupado."')";
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
$query_select="SELECT * FROM com_diccionarios WHERE dic_nombre='".utf8_decode($dic_nombre)."'";
$result_select=mysql_query($query_select) or die ("No se puede ejecutar la sentencia: ".$query_select);
$row_select=mysql_fetch_array($result_select);

header('Location: index.php');
//header('Location: crear_c.php?dic_id='.utf8_decode($row_select['dic_id']));

?>
