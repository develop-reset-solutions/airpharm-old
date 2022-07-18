<?php session_start();
include("../login/sesion_start.php");
include("../librerias/librerias.php");
include("../cabecera.php");
$conn=db_connect();
$oa_id=$_POST['oa_id'];
$dpo_id=$_POST['dpo_id'];
if(isset($_POST['dl_id'])){
	$query_usr="SELECT * FROM vdpo_lineas WHERE dl_oa_id=".$oa_id;
	$result_usr=mysql_query($query_usr) or die("No se puede ejecutar la sentencia: ".$query_usr);
	while($row_usr=mysql_fetch_array($result_usr)){
        foreach($_POST['dl_id'] as $valueSelected){
            if($row_usr['dl_id']==$valueSelected){
				$query="DELETE FROM dpo_lineas WHERE dl_id=".$row_usr['dl_id'];
				$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
            }
        }
    }
}
/*$query_dl = "SELECT * FROM dpo_lineas WHERE dl_id=".$dl_id;
$result_dl=mysql_query($query_dl) or die ("No se puede ejecutar la sentencia: ".$query_dl);
$row_dl = mysql_fetch_array($result_dl);
$oa_id=$row_dl['dl_oa_id'];*/
$query="SELECT * FROM dpo_lineas WHERE dl_oa_id=".$oa_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
$num=mysql_num_rows($result);
if($num){
	header('Location: edit_usuarios.php?oa_id='.$oa_id.'&dpo_id='.$dpo_id);
}else{
	header('Location: ../objetivos/delete_indicador.php?oa_id='.$oa_id);
}
?>
