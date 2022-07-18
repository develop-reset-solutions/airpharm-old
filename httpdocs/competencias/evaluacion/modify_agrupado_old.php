<?php session_start();
include("../../login/sesion_start.php");
include("../../librerias/librerias.php");
include("../../cabecera-competencias.php");
$conn=db_connect();
/*
$comp_1_1=$_REQUEST['comp_1_1'];
$comp_1_2=$_REQUEST['comp_1_2'];
$comp_1_3=$_REQUEST['comp_1_3'];
$comp_1_4=$_REQUEST['comp_1_4'];
$comp_2_1=$_REQUEST['comp_2_1'];
$comp_2_2=$_REQUEST['comp_2_2'];
$comp_2_3=$_REQUEST['comp_2_3'];
$comp_2_4=$_REQUEST['comp_2_4'];
$comp_3_1=$_REQUEST['comp_3_1'];
$comp_3_2=$_REQUEST['comp_3_2'];
$comp_3_3=$_REQUEST['comp_3_3'];
$comp_3_4=$_REQUEST['comp_3_4'];

$comp_id_1_1=$_REQUEST['comp_id_1_1'];
$comp_id_1_2=$_REQUEST['comp_id_1_2'];
$comp_id_1_3=$_REQUEST['comp_id_1_3'];
$comp_id_1_4=$_REQUEST['comp_id_1_4'];
$comp_id_2_1=$_REQUEST['comp_id_2_1'];
$comp_id_2_2=$_REQUEST['comp_id_2_2'];
$comp_id_2_3=$_REQUEST['comp_id_2_3'];
$comp_id_2_4=$_REQUEST['comp_id_2_4'];
$comp_id_3_1=$_REQUEST['comp_id_3_1'];
$comp_id_3_2=$_REQUEST['comp_id_3_2'];
$comp_id_3_3=$_REQUEST['comp_id_3_3'];
$comp_id_3_4=$_REQUEST['comp_id_3_4'];

echo $comp_1_1."<br>";
echo $comp_1_2."<br>";
echo $comp_1_3."<br>";
echo $comp_1_4."<br>";
echo $comp_2_1."<br>";
echo $comp_2_2."<br>";
echo $comp_2_3."<br>";
echo $comp_2_4."<br>";
echo $comp_3_1."<br>";
echo $comp_3_2."<br>";
echo $comp_3_3."<br>";
echo $comp_3_4."<br>";
echo $comp_id_1_1."<br>";
echo $comp_id_1_2."<br>";
echo $comp_id_1_3."<br>";
echo $comp_id_1_4."<br>";
echo $comp_id_2_1."<br>";
echo $comp_id_2_2."<br>";
echo $comp_id_2_3."<br>";
echo $comp_id_2_4."<br>";
echo $comp_id_3_1."<br>";
echo $comp_id_3_2."<br>";
echo $comp_id_3_3."<br>";
echo $comp_id_3_4."<br>";
*/

$comp_1=$_REQUEST['comp_1'];
$comp_2=$_REQUEST['comp_2'];
$comp_3=$_REQUEST['comp_3'];
$comp_4=$_REQUEST['comp_4'];
$comp_5=$_REQUEST['comp_5'];
$comp_6=$_REQUEST['comp_6'];
$comp_7=$_REQUEST['comp_7'];
$comp_8=$_REQUEST['comp_8'];
$comp_9=$_REQUEST['comp_9'];
$comp_10=$_REQUEST['comp_10'];
$comp_11=$_REQUEST['comp_11'];
$comp_12=$_REQUEST['comp_12'];
if($_REQUEST['comp_id_1']!=""){ 
	$comp_id_1=$_REQUEST['comp_id_1'];
} else{
	$comp_id_1="0";
}
if($_REQUEST['comp_id_2']!=""){ 
	$comp_id_2=$_REQUEST['comp_id_2'];
} else{
	$comp_id_2="0";
}
if($_REQUEST['comp_id_3']!=""){ 
	$comp_id_3=$_REQUEST['comp_id_3'];
} else{
	$comp_id_3="0";
}
if($_REQUEST['comp_id_4']!=""){ 
	$comp_id_4=$_REQUEST['comp_id_4'];
} else{
	$comp_id_4="0";
}
if($_REQUEST['comp_id_5']!=""){ 
	$comp_id_5=$_REQUEST['comp_id_5'];
} else{
	$comp_id_5="0";
}
if($_REQUEST['comp_id_6']!=""){ 
	$comp_id_6=$_REQUEST['comp_id_6'];
} else{
	$comp_id_6="0";
}
if($_REQUEST['comp_id_7']!=""){ 
	$comp_id_7=$_REQUEST['comp_id_7'];
} else{
	$comp_id_7="0";
}
if($_REQUEST['comp_id_8']!=""){ 
	$comp_id_8=$_REQUEST['comp_id_8'];
} else{
	$comp_id_8="0";
}
if($_REQUEST['comp_id_9']!=""){ 
	$comp_id_9=$_REQUEST['comp_id_9'];
} else{
	$comp_id_9="0";
}
if($_REQUEST['comp_id_10']!=""){ 
	$comp_id_10=$_REQUEST['comp_id_10'];
} else{
	$comp_id_10="0";
}
if($_REQUEST['comp_id_11']!=""){ 
	$comp_id_11=$_REQUEST['comp_id_11'];
} else{
	$comp_id_11="0";
}
if($_REQUEST['comp_id_12']!=""){ 
	$comp_id_12=$_REQUEST['comp_id_12'];
} else{
	$comp_id_12="0";
}

echo $comp_1."<br>";
echo $comp_2."<br>";
echo $comp_3."<br>";
echo $comp_4."<br>";
echo $comp_5."<br>";
echo $comp_6."<br>";
echo $comp_7."<br>";
echo $comp_8."<br>";
echo $comp_9."<br>";
echo $comp_10."<br>";
echo $comp_11."<br>";
echo $comp_12."<br>";
echo $comp_id_1."<br>";
echo $comp_id_2."<br>";
echo $comp_id_3."<br>";
echo $comp_id_4."<br>";
echo $comp_id_5."<br>";
echo $comp_id_6."<br>";
echo $comp_id_7."<br>";
echo $comp_id_8."<br>";
echo $comp_id_9."<br>";
echo $comp_id_10."<br>";
echo $comp_id_11."<br>";
echo $comp_id_12."<br>";

//$dic_id=$_REQUEST['dic_id'];
$com_id=$_REQUEST['com_id'];
$usr_id=$_REQUEST['usr_id'];
$grado=$_REQUEST['grado'];
$observaciones=mysql_real_escape_string(utf8_decode($_REQUEST['observaciones']));
$com_id_sig=$_REQUEST['com_id_sig'];
$dic_agrupado=$_REQUEST['dic_agrupado'];

$du_id=$_REQUEST['du_id'];

//echo "dic_id: ".$dic_id."<br>";
echo "com_id: ".$com_id."<br>";
echo "usr_id: ".$usr_id."<br>";
echo "com_id: ".$com_id."<br>";
echo "grado: ".$grado."<br>";
echo "observaciones: ".$observaciones."<br>";
echo "com_id_sig: ".$com_id_sig."<br>";
echo "guardar: ".$_REQUEST['Guardar']."<br>";
echo "du_id: ".$du_id."<br>";




//$query_cd ="SELECT * FROM com_dic_usr_com WHERE duc_dic_id=".$dic_id." AND duc_com_id=".$com_id." AND duc_usr_id=".$usr_id;
$query_cd ="SELECT * FROM com_dic_usr_com WHERE duc_du_id=".$du_id." AND duc_com_id=".$com_id;
$result_cd=mysql_query($query_cd) or die("No se puede ejecutar la sentencia: ".$query_cd);
$row_cd=mysql_fetch_array($result_cd);
$duc_id=$row_cd['duc_id'];


if ($duc_id){
	//UPDATE DE LA COMPETENCIA 
	//$query_u_duc="UPDATE com_dic_usr_com SET duc_grado='".$grado."', duc_observaciones='".$observaciones."' WHERE duc_dic_id=".$dic_id." AND duc_com_id=".$com_id." AND duc_usr_id=".$usr_id;
	$query_u_duc="UPDATE com_dic_usr_com SET duc_grado='".$grado."', duc_observaciones='".$observaciones."' WHERE duc_du_id=".$du_id." AND duc_com_id=".$com_id;
	$result=mysql_query($query_u_duc) or die("No se puede ejecutar la sentencia: ".$query_u_duc);
} else{
	//INSERT DE LA COMPETENCIA 
	$query_i_duc="INSERT INTO com_dic_usr_com (duc_du_id, duc_com_id, duc_grado, duc_observaciones) VALUES (".$du_id.", ".$com_id.", '".$grado."', '".$observaciones."')";
	$result=mysql_query($query_i_duc) or die("No se puede ejecutar la sentencia: ".$query_i_duc);	
}

	$query_ducp ="SELECT * FROM com_dic_usr_comp WHERE ducp_comp_id=".$comp_id_1." AND ducp_du_id=".$du_id;
	$result_ducp=mysql_query($query_ducp) or die("No se puede ejecutar la sentencia: ".$query_ducp);
	$row_ducp=mysql_fetch_array($result_ducp);
	$ducp_id=$row_ducp['ducp_id'];
	
	if ($ducp_id){
		$query_u_duc="UPDATE com_dic_usr_comp SET ducp_evaluacion='".$comp_1."' WHERE ducp_du_id=".$du_id." AND ducp_comp_id=".$comp_id_1;
		$result=mysql_query($query_u_duc) or die("No se puede ejecutar la sentencia: ".$query_u_duc);
	} else{
		$query_i_duc="INSERT INTO com_dic_usr_comp (ducp_du_id, ducp_comp_id, ducp_evaluacion ) 
		VALUES (".$du_id.", ".$comp_id_1.", '".$comp_1."')";
		$result=mysql_query($query_i_duc) or die("No se puede ejecutar la sentencia: ".$query_i_duc);	
	}
	
	$query_ducp ="SELECT * FROM com_dic_usr_comp WHERE ducp_comp_id=".$comp_id_2." AND ducp_du_id=".$du_id;
	$result_ducp=mysql_query($query_ducp) or die("No se puede ejecutar la sentencia: ".$query_ducp);
	$row_ducp=mysql_fetch_array($result_ducp);
	$ducp_id=$row_ducp['ducp_id'];
	
	if ($ducp_id){
		$query_u_duc="UPDATE com_dic_usr_comp SET ducp_evaluacion='".$comp_2."' WHERE ducp_du_id=".$du_id." AND ducp_comp_id=".$comp_id_2;
		$result=mysql_query($query_u_duc) or die("No se puede ejecutar la sentencia: ".$query_u_duc);
	} else{
		$query_i_duc="INSERT INTO com_dic_usr_comp (ducp_du_id, ducp_comp_id, ducp_evaluacion ) 
		VALUES (".$du_id.", ".$comp_id_2.", '".$comp_2."')";
		$result=mysql_query($query_i_duc) or die("No se puede ejecutar la sentencia: ".$query_i_duc);	
	}
	$query_ducp ="SELECT * FROM com_dic_usr_comp WHERE ducp_comp_id=".$comp_id_3." AND ducp_du_id=".$du_id;
	$result_ducp=mysql_query($query_ducp) or die("No se puede ejecutar la sentencia: ".$query_ducp);
	$row_ducp=mysql_fetch_array($result_ducp);
	$ducp_id=$row_ducp['ducp_id'];
	
	if ($ducp_id){
		$query_u_duc="UPDATE com_dic_usr_comp SET ducp_evaluacion='".$comp_3."' WHERE ducp_du_id=".$du_id." AND ducp_comp_id=".$comp_id_3;
		$result=mysql_query($query_u_duc) or die("No se puede ejecutar la sentencia: ".$query_u_duc);
	} else{
		$query_i_duc="INSERT INTO com_dic_usr_comp (ducp_du_id, ducp_comp_id, ducp_evaluacion ) 
		VALUES (".$du_id.", ".$comp_id_3.", '".$comp_3."')";
		$result=mysql_query($query_i_duc) or die("No se puede ejecutar la sentencia: ".$query_i_duc);	
	}
	$query_ducp ="SELECT * FROM com_dic_usr_comp WHERE ducp_comp_id=".$comp_id_4." AND ducp_du_id=".$du_id;
	$result_ducp=mysql_query($query_ducp) or die("No se puede ejecutar la sentencia: ".$query_ducp);
	$row_ducp=mysql_fetch_array($result_ducp);
	$ducp_id=$row_ducp['ducp_id'];
	
	if ($ducp_id){
		$query_u_duc="UPDATE com_dic_usr_comp SET ducp_evaluacion='".$comp_4."' WHERE ducp_du_id=".$du_id." AND ducp_comp_id=".$comp_id_4;
		$result=mysql_query($query_u_duc) or die("No se puede ejecutar la sentencia: ".$query_u_duc);
	} else{
		$query_i_duc="INSERT INTO com_dic_usr_comp (ducp_du_id, ducp_comp_id, ducp_evaluacion ) 
		VALUES (".$du_id.", ".$comp_id_4.", '".$comp_4."')";
		$result=mysql_query($query_i_duc) or die("No se puede ejecutar la sentencia: ".$query_i_duc);	
	}
	$query_ducp ="SELECT * FROM com_dic_usr_comp WHERE ducp_comp_id=".$comp_id_5." AND ducp_du_id=".$du_id;
	$result_ducp=mysql_query($query_ducp) or die("No se puede ejecutar la sentencia: ".$query_ducp);
	$row_ducp=mysql_fetch_array($result_ducp);
	$ducp_id=$row_ducp['ducp_id'];
	
	if ($ducp_id){
		$query_u_duc="UPDATE com_dic_usr_comp SET ducp_evaluacion='".$comp_5."' WHERE ducp_du_id=".$du_id." AND ducp_comp_id=".$comp_id_5;
		$result=mysql_query($query_u_duc) or die("No se puede ejecutar la sentencia: ".$query_u_duc);
	} else{
		$query_i_duc="INSERT INTO com_dic_usr_comp (ducp_du_id, ducp_comp_id, ducp_evaluacion ) 
		VALUES (".$du_id.", ".$comp_id_5.", '".$comp_5."')";
		$result=mysql_query($query_i_duc) or die("No se puede ejecutar la sentencia: ".$query_i_duc);	
	}
	$query_ducp ="SELECT * FROM com_dic_usr_comp WHERE ducp_comp_id=".$comp_id_6." AND ducp_du_id=".$du_id;
	$result_ducp=mysql_query($query_ducp) or die("No se puede ejecutar la sentencia: ".$query_ducp);
	$row_ducp=mysql_fetch_array($result_ducp);
	$ducp_id=$row_ducp['ducp_id'];
	
	if ($ducp_id){
		$query_u_duc="UPDATE com_dic_usr_comp SET ducp_evaluacion='".$comp_6."' WHERE ducp_du_id=".$du_id." AND ducp_comp_id=".$comp_id_6;
		$result=mysql_query($query_u_duc) or die("No se puede ejecutar la sentencia: ".$query_u_duc);
	} else{
		$query_i_duc="INSERT INTO com_dic_usr_comp (ducp_du_id, ducp_comp_id, ducp_evaluacion ) 
		VALUES (".$du_id.", ".$comp_id_6.", '".$comp_6."')";
		$result=mysql_query($query_i_duc) or die("No se puede ejecutar la sentencia: ".$query_i_duc);	
	}
	$query_ducp ="SELECT * FROM com_dic_usr_comp WHERE ducp_comp_id=".$comp_id_7." AND ducp_du_id=".$du_id;
	$result_ducp=mysql_query($query_ducp) or die("No se puede ejecutar la sentencia: ".$query_ducp);
	$row_ducp=mysql_fetch_array($result_ducp);
	$ducp_id=$row_ducp['ducp_id'];
	
	if ($ducp_id){
		$query_u_duc="UPDATE com_dic_usr_comp SET ducp_evaluacion='".$comp_7."' WHERE ducp_du_id=".$du_id." AND ducp_comp_id=".$comp_id_7;
		$result=mysql_query($query_u_duc) or die("No se puede ejecutar la sentencia: ".$query_u_duc);
	} else{
		$query_i_duc="INSERT INTO com_dic_usr_comp (ducp_du_id, ducp_comp_id, ducp_evaluacion ) 
		VALUES (".$du_id.", ".$comp_id_7.", '".$comp_7."')";
		$result=mysql_query($query_i_duc) or die("No se puede ejecutar la sentencia: ".$query_i_duc);	
	}
	$query_ducp ="SELECT * FROM com_dic_usr_comp WHERE ducp_comp_id=".$comp_id_8." AND ducp_du_id=".$du_id;
	$result_ducp=mysql_query($query_ducp) or die("No se puede ejecutar la sentencia: ".$query_ducp);
	$row_ducp=mysql_fetch_array($result_ducp);
	$ducp_id=$row_ducp['ducp_id'];
	
	if ($ducp_id){
		$query_u_duc="UPDATE com_dic_usr_comp SET ducp_evaluacion='".$comp_8."' WHERE ducp_du_id=".$du_id." AND ducp_comp_id=".$comp_id_8;
		$result=mysql_query($query_u_duc) or die("No se puede ejecutar la sentencia: ".$query_u_duc);
	} else{
		$query_i_duc="INSERT INTO com_dic_usr_comp (ducp_du_id, ducp_comp_id, ducp_evaluacion ) 
		VALUES (".$du_id.", ".$comp_id_8.", '".$comp_8."')";
		$result=mysql_query($query_i_duc) or die("No se puede ejecutar la sentencia: ".$query_i_duc);	
	}
	$query_ducp ="SELECT * FROM com_dic_usr_comp WHERE ducp_comp_id=".$comp_id_9." AND ducp_du_id=".$du_id;
	$result_ducp=mysql_query($query_ducp) or die("No se puede ejecutar la sentencia: ".$query_ducp);
	$row_ducp=mysql_fetch_array($result_ducp);
	$ducp_id=$row_ducp['ducp_id'];
	
	if ($ducp_id){
		$query_u_duc="UPDATE com_dic_usr_comp SET ducp_evaluacion='".$comp_9."' WHERE ducp_du_id=".$du_id." AND ducp_comp_id=".$comp_id_9;
		$result=mysql_query($query_u_duc) or die("No se puede ejecutar la sentencia: ".$query_u_duc);
	} else{
		$query_i_duc="INSERT INTO com_dic_usr_comp (ducp_du_id, ducp_comp_id, ducp_evaluacion ) 
		VALUES (".$du_id.", ".$comp_id_9.", '".$comp_9."')";
		$result=mysql_query($query_i_duc) or die("No se puede ejecutar la sentencia: ".$query_i_duc);	
	}
	$query_ducp ="SELECT * FROM com_dic_usr_comp WHERE ducp_comp_id=".$comp_id_10." AND ducp_du_id=".$du_id;
	$result_ducp=mysql_query($query_ducp) or die("No se puede ejecutar la sentencia: ".$query_ducp);
	$row_ducp=mysql_fetch_array($result_ducp);
	$ducp_id=$row_ducp['ducp_id'];
	
	if ($ducp_id){
		$query_u_duc="UPDATE com_dic_usr_comp SET ducp_evaluacion='".$comp_10."' WHERE ducp_du_id=".$du_id." AND ducp_comp_id=".$comp_id_10;
		$result=mysql_query($query_u_duc) or die("No se puede ejecutar la sentencia: ".$query_u_duc);
	} else{
		$query_i_duc="INSERT INTO com_dic_usr_comp (ducp_du_id, ducp_comp_id, ducp_evaluacion ) 
		VALUES (".$du_id.", ".$comp_id_10.", '".$comp_10."')";
		$result=mysql_query($query_i_duc) or die("No se puede ejecutar la sentencia: ".$query_i_duc);	
	}
	$query_ducp ="SELECT * FROM com_dic_usr_comp WHERE ducp_comp_id=".$comp_id_11." AND ducp_du_id=".$du_id;
	$result_ducp=mysql_query($query_ducp) or die("No se puede ejecutar la sentencia: ".$query_ducp);
	$row_ducp=mysql_fetch_array($result_ducp);
	$ducp_id=$row_ducp['ducp_id'];
	
	if ($ducp_id){
		$query_u_duc="UPDATE com_dic_usr_comp SET ducp_evaluacion='".$comp_11."' WHERE ducp_du_id=".$du_id." AND ducp_comp_id=".$comp_id_11;
		$result=mysql_query($query_u_duc) or die("No se puede ejecutar la sentencia: ".$query_u_duc);
	} else{
		$query_i_duc="INSERT INTO com_dic_usr_comp (ducp_du_id, ducp_comp_id, ducp_evaluacion ) 
		VALUES (".$du_id.", ".$comp_id_11.", '".$comp_11."')";
		$result=mysql_query($query_i_duc) or die("No se puede ejecutar la sentencia: ".$query_i_duc);	
	}
	$query_ducp ="SELECT * FROM com_dic_usr_comp WHERE ducp_comp_id=".$comp_id_12." AND ducp_du_id=".$du_id;
	$result_ducp=mysql_query($query_ducp) or die("No se puede ejecutar la sentencia: ".$query_ducp);
	$row_ducp=mysql_fetch_array($result_ducp);
	$ducp_id=$row_ducp['ducp_id'];
	
	if ($ducp_id){
		$query_u_duc="UPDATE com_dic_usr_comp SET ducp_evaluacion='".$comp_12."' WHERE ducp_du_id=".$du_id." AND ducp_comp_id=".$comp_id_12;
		$result=mysql_query($query_u_duc) or die("No se puede ejecutar la sentencia: ".$query_u_duc);
	} else{
		$query_i_duc="INSERT INTO com_dic_usr_comp (ducp_du_id, ducp_comp_id, ducp_evaluacion ) 
		VALUES (".$du_id.", ".$comp_id_12.", '".$comp_12."')";
		$result=mysql_query($query_i_duc) or die("No se puede ejecutar la sentencia: ".$query_i_duc);	
	}
		
$datetime=date("Y-m-d H:i:s");

$query_uua ="SELECT * FROM com_usr_ult_acceso WHERE uua_usr_id =".$_SESSION['usr_id']." AND uua_colaborador_id=".$usr_id." AND uua_com_id=".$com_id." AND uua_ano=".$_SESSION['ano'];
$result_uua=mysql_query($query_uua) or die("No se puede ejecutar la sentencia: ".$query_uua);
$row_uua=mysql_fetch_array($result_uua);

if ($row_uua){
	$query_u_uua="UPDATE com_usr_ult_acceso SET uua_fecha_mod='".$datetime."' WHERE uua_usr_id =".$_SESSION['usr_id']." AND uua_colaborador_id=".$usr_id." AND uua_com_id=".$com_id." AND uua_ano=".$_SESSION['ano'];
	$result_u_uua=mysql_query($query_u_uua) or die("No se puede ejecutar la sentencia: ".$query_u_uua);
} else {
	$query_i_uua="INSERT INTO com_usr_ult_acceso (uua_usr_id, uua_colaborador_id, uua_com_id, uua_fecha_mod, uua_ano ) 
	VALUES (".$_SESSION['usr_id'].", ".$usr_id.", ".$com_id.", '".$datetime."', '".$_SESSION['ano']."')";
	$result_i_uua=mysql_query($query_i_uua) or die("No se puede ejecutar la sentencia: ".$query_i_uua);	
	
}

if ($_REQUEST['Guardar']=="Guardar y seguir"){
	header('Location: edit_agrupado.php?com_id='.$com_id_sig.'&usr_id='.$usr_id);

} else if ($_REQUEST['Guardar']=="Guardar y salir"){
	header('Location: index.php');
} else {
	header('Location: edit_agrupado.php?usr_id='.$usr_id);

}

?>
