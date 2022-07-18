<?php

$hostname_airfarm = "localhost";
$database_airfarm = "airfarm_dpo";
$username_airfarm = "airfarm_us";
$password_airfarm = "Cpt39il8*";
$airfarm = mysql_connect($hostname_airfarm, $username_airfarm, $password_airfarm) or trigger_error(mysql_error(),E_USER_ERROR); 

?>