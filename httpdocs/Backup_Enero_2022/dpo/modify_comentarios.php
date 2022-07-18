<?php session_start();
include("../login/sesion_start.php");
include("../librerias/librerias.php");
include("../cabecera.php");
$conn=db_connect();
$com_id=$_POST['com_id'];
$com_dpo_id=$_POST['com_dpo_id'];
$com_n_lin=$_POST['com_n_lin'];
$com_periodo=$_POST['com_periodo'];
$com_comentario=mysql_real_escape_string($_POST['com_comentario']);
if($_POST['modificar']){
	$query="UPDATE dpo_comentarios SET com_comentario='".utf8_decode($com_comentario)."', com_n_lin='".$com_n_lin."' WHERE com_id=".$com_id;
	$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
}elseif($_POST['borrar']){
	$query="DELETE FROM dpo_comentarios WHERE com_id=".$com_id;
	$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
}
header('Location: index.php?dpo_id='.$com_dpo_id.'#'.$com_periodo);
?>
