<?php

function db_connect(){
   $result = mysql_pconnect("localhost", "airfarm_us", "Cpt39il8*");

   if ( !$result )
      return false;
   if (!mysql_select_db("airfarm_dpo"))
      return false;

   return $result;
}


function db_result_to_array( $result ){
   $res_array = array();

   for ($count=0; $row = @mysql_fetch_array($result); $count++)
     $res_array[$count] = $row;

   return $res_array;
}

?>
