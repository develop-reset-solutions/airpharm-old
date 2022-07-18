<?php session_start();
include("../../../login/sesion_start.php");
include("../../../login/sesion_start_rrhh.php");
include("../../../librerias/librerias.php");
include("../../../cabecera-competencias.php");
$conn=db_connect();

$dic_id=$_REQUEST['dic_id'];


$query="SELECT * FROM com_diccionarios WHERE dic_id=".$dic_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
$row=mysql_fetch_array($result);

$query="DELETE FROM com_diccionarios WHERE dic_id=".$dic_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);

$query_com_dic="SELECT * FROM com_com_dic WHERE cd_dic_id=".$dic_id;
$result_com_dic=mysql_query($query_com_dic) or die("No se puede ejecutar la sentencia: ".$query_com_dic);

$query_delete_com_dic="DELETE FROM com_com_dic WHERE cd_dic_id=".$dic_id;
//echo "query_delete_com_dic: ".$query_delete_com_dic."<br>";
$result=mysql_query($query_delete_com_dic) or die("No se puede ejecutar la sentencia: ".$query_delete_com_dic);

while($row_com_dic=mysql_fetch_array($result_com_dic)){
	$query_act_com_dic="SELECT * FROM com_act_com_dic WHERE acd_cd_id=".$row_com_dic['cd_id'];
	$result_act_com_dic=mysql_query($query_act_com_dic) or die("No se puede ejecutar la sentencia: ".$query_act_com_dic);
	
	$query_delete_act_dic="DELETE FROM com_act_com_dic WHERE acd_cd_id=".$row_com_dic['cd_id'];
	//echo "query_delete_act_dic: ".$query_delete_act_dic."<br>";
	$result=mysql_query($query_delete_act_dic) or die("No se puede ejecutar la sentencia: ".$query_delete_act_dic);

	while($row_act_com_dic=mysql_fetch_array($result_act_com_dic)){
	
		$query_delete_comp_dic="DELETE FROM com_comp_act_com_dic WHERE cacd_acd_id=".$row_act_com_dic['acd_id'];
		//echo "query_delete_comp_dic: ".$query_delete_comp_dic."<br>";
		$result=mysql_query($query_delete_comp_dic) or die("No se puede ejecutar la sentencia: ".$query_delete_comp_dic);
		
	}
}
header('Location: /competencias/diccionario/index.php');
?>
