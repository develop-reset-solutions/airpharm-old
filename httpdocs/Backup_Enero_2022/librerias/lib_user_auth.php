<?php

require_once("lib_db.php");

function login($login, $pass)
// comprueba el nombre del usuario y el password con la base de datos
// si sí, devuelve verdadero
// si no devueelve falso
{
  // conectar a la base de datos
  $conn = db_connect();
  if (!$conn)
    return 0;

  // comprobar que el nombre de usuario sea único
  $result = mysql_query("SELECT * FROM usuarios WHERE usr_login='$login' AND usr_password= '$pass'");
  if (!$result)
     return 0;

  if (mysql_num_rows($result)>0 and $login and $pass){
	 get_user_details($result);
     return 1;
  }else{
     return 0;
  }
}

function get_user_details($result){
	 $user=mysql_fetch_array($result);
	 $_SESSION["access"]=true;
	 $_SESSION["usr_nombre"]=$user['usr_nombre'];
	 $_SESSION["usr_apellidos"]=$user['usr_apellidos'];
	 $_SESSION["usr_tipo"]=$user['usr_tipo'];
	 $_SESSION["usr_email"]=$user['usr_email'];
	 $_SESSION["usr_id"]=$user['usr_id'];	 
	 $_SESSION["usr_categoria"]=$user['usr_categoria'];	 
	 $_SESSION["usr_perfil"]=$user['usr_perfil'];
	 $_SESSION["obj_tipo"]='all';
	 $_SESSION["ano"]=date('Y');
}

function check_email($email){
	$conn = db_connect();
  	if (!$conn)
    	return 0;
  	// comprobar que el nombre de usuario sea único
  	$result = mysql_query("SELECT * FROM customers WHERE email='$email'");
  	if (!$result)
     	return 0;
	if (mysql_num_rows($result)>0){
     	return 1;
  	}else{
     	return 0;
  	}
}


function check_admin_user()
// ver si alguien está logged in y notificárselo si no
{
  global $admin_user;
  if (session_is_registered("admin_user"))
    return true;
  else
    return false;
}

function change_password($username, $old_password, $new_password)
// cambiar contraseña para  username/old_password a nueva contraseña
// devuelve verdadero o falso
{
  // si la vieja contraseña es correcta
  // cambia su contraseña a nueva contraseña y devuelve verdadero
  // s no es así devuelve falso
  if (login($username, $old_password))
  {
    if (!($conn = db_connect()))
      return false;
    $result = mysql_query( "update admin
                            set password = password('$new_password')
                            where username = '$username'");
    if (!$result)
      return false;  // no cambiado
    else
      return true;  // cambiado correctamente
  }
  else
    return false; // la vieja contraseña estaba equivocada
}


?>