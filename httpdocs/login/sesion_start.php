<?php 
   session_start();
if($_SESSION['access'] != true) 
   { 
	  header("location:http://10.2.0.66/login/error.php"); 
   } 
 
?>