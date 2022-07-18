<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_airfarm2 = "82.194.91.37";
$database_airfarm2 = "airfarm_dpo";
$username_airfarm2 = "airfarm_us";
$password_airfarm2 = "Cpt39il8*";
$airfarm2 = mysql_connect($hostname_airfarm2, $username_airfarm2, $password_airfarm2) or trigger_error(mysql_error(),E_USER_ERROR); 
?>