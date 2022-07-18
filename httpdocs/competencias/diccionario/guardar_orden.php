<?php session_start();
include("../../login/sesion_start.php");
include("../../login/sesion_start_rrhh.php");
include("../../librerias/librerias.php");
include("../../cabecera-competencias.php");
$conn=db_connect();
$num_max=$_REQUEST['num_max'];
$dic_id=$_REQUEST['dic_id'];
$i=1;

//$query_select="SELECT * FROM com_com_dic WHERE cd_dic_id=".$dic_id;
//$result_select=mysql_query($query_select) or die("No se puede ejecutar la sentencia: ".$query_select);
while ($i <= $num_max) {
//$i=0;	
//while($row_select=mysql_fetch_array($result_select)){
	//$i++;
    
	//echo $i." ".$_REQUEST['com_'.$i]."<br>";
	$query="UPDATE com_com_dic SET cd_orden=".$i." WHERE cd_dic_id=".$dic_id." AND cd_com_id=".$_REQUEST['com_'.$i];
	//echo $query."<br>";
	$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
	$i++;  
}


//$query="UPDATE com_diccionarios SET dic_nombre='".utf8_decode($dic_nombre)."' WHERE dic_id=".$dic_id;
//$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
header('Location: show.php?dic_id='.$dic_id);
?>
