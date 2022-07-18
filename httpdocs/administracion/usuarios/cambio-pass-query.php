<?php 
session_start();

include("../../login/sesion_start.php");
include("../../librerias/librerias.php");

$conn=db_connect();


if($usr_pass=mysql_real_escape_string($_POST[pass]) == mysql_real_escape_string($_POST['pass-check'])){
	
	$query="UPDATE usuarios SET usr_password = '" .md5($usr_pass) ."' WHERE usr_id=".$_SESSION['usr_id'];
	
	$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
 

	if($result){
		header('Location: http://10.2.0.66/home.php');
	}
	
}