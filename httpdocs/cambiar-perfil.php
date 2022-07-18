<?php 
session_start();
if($_SESSION['usr_perfil']=='Director RRHH'){
	$_SESSION['usr_perfil']='Usuario';
}else{
	$_SESSION['usr_perfil']='Director RRHH';
}
header('Location:/home.php');

?>