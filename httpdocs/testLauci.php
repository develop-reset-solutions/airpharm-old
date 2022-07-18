<?php 

session_start();
include("login/sesion_start.php");
include("librerias/librerias.php");
include("cabecera_previa.php");
$conn=db_connect();

$query="SELECT usr_nombre,usr_apellidos,usr_email FROM usuarios;";
$result=mysql_query($query) or die ("No se puede ejecutar la sentencia: ".$query);

while($row=mysql_fetch_array($result)){
	echo " El nombre de usuario es: ". $row['usr_nombre']. '<br>';
	echo " El apellido de usuario es: ". $row['usr_apellidos']. '<br>';
	echo " El email de usuario es: ". $row['usr_email']. '<br>';
	
	
}



?>

<footer> 
</footer>
</body></html>