<?php


//$hostname_airfarm = "localhost";
//$database_airfarm = "airfarm_dpo";
//$username_airfarm = "airfarm_us";
//$password_airfarm = "Cpt39il8*";

//$airfarm = mysql_pconnect($hostname_airfarm, $username_airfarm, $password_airfarm) or

//trigger_error(mysql_error(),E_USER_ERROR);




function db_connect()
{
   $result = mysql_pconnect("localhost", "airfarm_us", "Cpt39il8*");
   if (!$result)
      return false;
   if (!mysql_select_db("airfarm_dpo"))
      return false;

   return $result;
}


// function db_connect(){
//    $result = mysqli_connect("mysql_old_airpharm", "root", "root");
//
//    if (!$result){
//      return false;
//    }
//
//    if (!mysqli_select_db("dbtest")){
//      return false;
//    }
//
//    return $result;
// }


function db_result_to_array($result)
{
   $res_array = array();

   for ($count=0; $row = @mysql_fetch_array($result); $count++)
     $res_array[$count] = $row;

   return $res_array;
}

?>
