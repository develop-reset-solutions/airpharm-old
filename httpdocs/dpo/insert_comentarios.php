<?php session_start();
include("../login/sesion_start.php");
include("../librerias/librerias.php");
include("../cabecera.php");
$conn=db_connect();
$com_dpo_id=$_POST['com_dpo_id'];
$com_periodo=$_POST['com_periodo'];
$com_n_lin=$_POST['com_n_lin'];
$com_comentario=mysql_real_escape_string($_POST['com_comentario']);
$query="INSERT INTO dpo_comentarios (com_dpo_id,com_periodo,com_n_lin,com_comentario) VALUES ('".$com_dpo_id."','".$com_periodo."','".$com_n_lin."','".utf8_decode($com_comentario)."')";
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
header('Location: index.php?dpo_id='.$com_dpo_id.'#'.$com_periodo);
?>
