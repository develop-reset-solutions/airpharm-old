<?php 
   session_start();
if($_SESSION['access'] != true) 
   { 
	  header("location:http://airpharmdpo.com/login/error.php"); 
   } 
 
?>