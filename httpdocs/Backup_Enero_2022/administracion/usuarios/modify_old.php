<?php session_start();
include("../../login/sesion_start.php");
include("../../librerias/librerias.php");
include("../../cabecera.php");
$conn=db_connect();
$usr_id=$_POST['usr_id'];
$usr_nombre=mysql_real_escape_string($_POST['usr_nombre']);
$usr_apellidos=mysql_real_escape_string($_POST['usr_apellidos']);
$usr_login=mysql_real_escape_string($_POST['usr_login']);
$usr_email=mysql_real_escape_string($_POST['usr_email']);
$usr_dni=mysql_real_escape_string($_POST['usr_dni']);
$usr_perfil=mysql_real_escape_string($_POST['usr_perfil']);
$usr_categoria=mysql_real_escape_string($_POST['usr_categoria']);
$usr_dep_id=$_POST['usr_dep_id'];
$usr_cen_id=$_POST['usr_cen_id'];
$usr_baja=$_POST['usr_baja'];
$usr_superior_id=$_POST['usr_superior_id'];
$usr_password_n=$_POST['usr_password'];
$usr_password = md5($_POST['usr_password']);
$query="UPDATE usuarios SET usr_nombre='".utf8_decode($usr_nombre)."', usr_apellidos='".utf8_decode($usr_apellidos)."', usr_login='".utf8_decode($usr_login)."', usr_cen_id='".$usr_cen_id."', usr_dep_id='".$usr_dep_id."', usr_dni='".utf8_decode($usr_dni)."', usr_email='".utf8_decode($usr_email)."', usr_categoria='".utf8_decode($usr_categoria)."', usr_superior_id='".$usr_superior_id."'";
if($usr_password_n<>'*****'){
	$query.=", usr_password='".$usr_password."'";
}
$query.=", usr_perfil='".$usr_perfil."', usr_baja='".$usr_baja."' WHERE usr_id=".$usr_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
header('Location: index.php');
?>
