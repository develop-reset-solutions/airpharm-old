<?php 
   session_start(); 
   //echo "--$_SESSION[access]--$_SESSION[Tipo]--$_SESSION[NombreCompleto]--";
   if($_SESSION[access] != true) 
   { 
      //die ("No tienes acceso"); 
	  header("location:http://airpharmdpo.com/login/error.php");
   } 
   if ($_SESSION['usr_perfil']!='Director RRHH')
   {
      //die ("No tiene privilegios de administrador");
	  header("location:http://airpharmdpo.com/login/error_rrhh.php");
   }
/* if ($_SESSION[tipo] != "Administrador" and $_SESSION[tipo] != "Financiero" and $_SESSION[tipo] != "General" and $_SESSION[tipo] != "Oficina" and $_SESSION[tipo] != "Consultor" and $_SESSION[tipo] != "Comercial"){
	header("location:http://gestion.avantium.es/login/error_priv.php");
}
if ($_SESSION[tipo] == "Administrador" or $_SESSION[tipo] == "Financiero" or $_SESSION[tipo] == "General" or $_SESSION[tipo] == "Oficina" or $_SESSION[tipo] == "Consultor" or $_SESSION[tipo] == "Comercial"){
*/  
?>