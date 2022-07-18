<?php
    session_start();
	include ('../librerias/librerias.php');
	$conn = db_connect();
	$login= $_POST[login];
	$pass = md5($_POST[pass]);
	
	//$hashfall = md5($passwordphp);
	
	//echo "Se quiere logear $usernamephp con el password $passwordphp<br>";
	//echo "--$database_hyg--";
	//exit;
		
	if (login($login, $pass)){
		//header("Location: ../home.php");
		header("Location: ../home_previa.php");
		
	}else { 
		echo "<script languaje='javascript'>alert ('No coinciden nombre de usuario y contrase\xf1a.');</script>";
		echo "<script languaje='javascript'>location.href=\"../index.php\";</script>"; 
	}

?>