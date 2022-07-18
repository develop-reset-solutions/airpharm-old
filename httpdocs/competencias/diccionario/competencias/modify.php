<?php session_start();
include("../../../login/sesion_start.php");
include("../../../login/sesion_start_rrhh.php");
include("../../../librerias/librerias.php");
include("../../../cabecera-competencias.php");
$conn=db_connect();
$act_1=$_REQUEST['act_1'];
$act_2=$_REQUEST['act_2'];
$act_3=$_REQUEST['act_3'];
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
echo $act_1."<br>";
echo $act_2."<br>";
echo $act_3."<br>";
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

//No se pasan los datos
$dic_id=$_REQUEST['dic_id'];
$com_id=$_REQUEST['com_id'];
//echo "dic_id: ".$dic_id."<br>";
//echo "com_id: ".$com_id."<br>";
$dic_agrupado=$_REQUEST['dic_agrupado'];

//if ($dic_agrupado=="no"){
	$query_cd ="SELECT * FROM com_com_dic WHERE cd_dic_id=".$dic_id." AND cd_com_id=".$com_id;
	$result_cd=mysql_query($query_cd) or die("No se puede ejecutar la sentencia: ".$query_cd);
	$row_cd=mysql_fetch_array($result_cd);
	$cd_id=$row_cd['cd_id'];
	
	//echo "cd_id: ".$cd_id."<br>";
	//PRIMERA ACTITUD 
	//echo "PRIMERA ACTITUD";
	$query_acd1 ="SELECT * FROM com_act_com_dic WHERE acd_cd_id=".$cd_id." AND acd_grado='A'";
	$result_acd1=mysql_query($query_acd1) or die("No se puede ejecutar la sentencia: ".$query_acd1);
	$row_acd1=mysql_fetch_array($result_acd1);
	$acd_id1=$row_acd1['acd_id'];
	//echo "acd_id1: ".$acd_id1."<br>";
	if ($row_acd1){
		//UPDATE DE LA PRIMERA ACTITUD 
		//echo "UPDATE DE LA PRIMERA ACTITUD";
		$query_u_acd1="UPDATE com_act_com_dic SET acd_act_id=".$act_1." WHERE acd_cd_id=".$cd_id." AND acd_grado='A'";
		$result=mysql_query($query_u_acd1) or die("No se puede ejecutar la sentencia: ".$query_u_acd1);
		/*	
		$query_cacd11 ="SELECT * FROM com_comp_act_com_dic WHERE cacd_acd_id=".$acd_id1." AND cacd_numero=1";
		$result_cacd11=mysql_query($query_cacd11) or die("No se puede ejecutar la sentencia: ".$query_cacd11);
		$row_cacd11=mysql_fetch_array($result_cacd11);
		$cacd_id11=$row_cacd11['cacd_id'];
		*/
		//UPDATE DEL PRIMER COMPORTAMIENTO DE LA PRIMERA ACTITUD 
		//echo "UPDATE DEL PRIMER COMPORTAMIENTO DE LA PRIMERA ACTITUD ";
		$query_u_cacd11="UPDATE com_comp_act_com_dic SET cacd_comp_id=".$comp_1_1." WHERE cacd_acd_id=".$acd_id1." and cacd_numero=1";
		$result=mysql_query($query_u_cacd11) or die("No se puede ejecutar la sentencia: ".$query_u_cacd11);
		/*	
		$query_cacd12 ="SELECT * FROM com_comp_act_com_dic WHERE cacd_acd_id=".$acd_id1." AND cacd_numero=2";
		$result_cacd12=mysql_query($query_cacd12) or die("No se puede ejecutar la sentencia: ".$query_cacd12);
		$row_cacd12=mysql_fetch_array($result_cacd12);
		$cacd_id12=$row_cacd12['cacd_id'];
		*/
		//UPDATE DEL SEGUNDO COMPORTAMIENTO DE LA PRIMERA ACTITUD
		//echo "UPDATE DEL SEGUNDO COMPORTAMIENTO DE LA PRIMERA ACTITUD"; 
		$query_u_cacd12="UPDATE com_comp_act_com_dic SET cacd_comp_id=".$comp_1_2." WHERE cacd_acd_id=".$acd_id1." and cacd_numero=2";
		$result=mysql_query($query_u_cacd12) or die("No se puede ejecutar la sentencia: ".$query_u_cacd12);
		/*	
		$query_cacd13 ="SELECT * FROM com_comp_act_com_dic WHERE cacd_acd_id=".$acd_id1." AND cacd_numero=3";
		$result_cacd13=mysql_query($query_cacd13) or die("No se puede ejecutar la sentencia: ".$query_cacd13);
		$row_cacd13=mysql_fetch_array($result_cacd13);
		$cacd_id13=$row_cacd13['cacd_id'];
		*/
		//UPDATE DEL TERCER COMPORTAMIENTO DE LA PRIMERA ACTITUD 
		//echo "UPDATE DEL TERCER COMPORTAMIENTO DE LA PRIMERA ACTITUD";
		$query_u_cacd13="UPDATE com_comp_act_com_dic SET cacd_comp_id=".$comp_1_3." WHERE cacd_acd_id=".$acd_id1." and cacd_numero=3";
		$result=mysql_query($query_u_cacd13) or die("No se puede ejecutar la sentencia: ".$query_u_cacd13);
		/*	
		$query_cacd14 ="SELECT * FROM com_comp_act_com_dic WHERE cacd_acd_id=".$acd_id1." AND cacd_numero=4";
		$result_cacd14=mysql_query($query_cacd14) or die("No se puede ejecutar la sentencia: ".$query_cacd14);
		$row_cacd14=mysql_fetch_array($result_cacd14);
		$cacd_id14=$row_cacd14['cacd_id'];
		*/
		//UPDATE DEL CUARTO COMPORTAMIENTO DE LA PRIMERA ACTITUD 
		//echo "UPDATE DEL CUARTO COMPORTAMIENTO DE LA PRIMERA ACTITUD";
		$query_u_cacd14="UPDATE com_comp_act_com_dic SET cacd_comp_id=".$comp_1_4." WHERE cacd_acd_id=".$acd_id1." and  cacd_numero=4";
		$result=mysql_query($query_u_cacd14) or die("No se puede ejecutar la sentencia: ".$query_u_cacd14);
		
	}
	else{
		//INSERT DE LA PRIMERA ACTITUD 
		//echo "INSERT DE LA PRIMERA ACTITUD"."<br>";
		
		$query_i_acd1="INSERT INTO com_act_com_dic (acd_grado, acd_cd_id, acd_act_id ) VALUES ('A', '".$cd_id."', '".$act_1."')";
		$result=mysql_query($query_i_acd1) or die("No se puede ejecutar la sentencia: ".$query_i_acd1);	
		
		$query_acd1 ="SELECT * FROM com_act_com_dic WHERE acd_cd_id=".$cd_id." AND acd_act_id=".$act_1." AND acd_grado='A'";
		$result_acd1=mysql_query($query_acd1) or die("No se puede ejecutar la sentencia: ".$query_acd1);
		$row_acd1=mysql_fetch_array($result_acd1);
		$acd_id1=$row_acd1['acd_id'];
		//echo "acd_id1: ".$acd_id1."<br>";
		
		//INSERT DEL PRIMER COMPORTAMIENTO DE LA PRIMERA ACTITUD 
		//echo "INSERT DEL PRIMER COMPORTAMIENTO DE LA PRIMERA ACTITUD";
		$query_i_cacd11="INSERT INTO com_comp_act_com_dic (cacd_acd_id, cacd_comp_id, cacd_numero) VALUES (".$acd_id1.",".$comp_1_1.",1)";
		$result=mysql_query($query_i_cacd11) or die("No se puede ejecutar la sentencia: ".$query_i_cacd11);
		
		//INSERT DEL SEGUNDO COMPORTAMIENTO DE LA PRIMERA ACTITUD 
		//echo "INSERT DEL SEGUNDO COMPORTAMIENTO DE LA PRIMERA ACTITUD";
		$query_i_cacd12="INSERT INTO com_comp_act_com_dic (cacd_acd_id, cacd_comp_id, cacd_numero) VALUES (".$acd_id1.",".$comp_1_2.",2)";
		$result=mysql_query($query_i_cacd12) or die("No se puede ejecutar la sentencia: ".$query_i_cacd12);
		
		//INSERT DEL TERCER COMPORTAMIENTO DE LA PRIMERA ACTITUD 
		//echo "INSERT DEL TERCER COMPORTAMIENTO DE LA PRIMERA ACTITUD ";
		$query_i_cacd13="INSERT INTO com_comp_act_com_dic (cacd_acd_id, cacd_comp_id, cacd_numero) VALUES (".$acd_id1.",".$comp_1_3.",3)";
		$result=mysql_query($query_i_cacd13) or die("No se puede ejecutar la sentencia: ".$query_i_cacd13);
		
		
		//INSERT DEL CUARTO COMPORTAMIENTO DE LA PRIMERA ACTITUD 
		//echo "INSERT DEL CUARTO COMPORTAMIENTO DE LA PRIMERA ACTITUD ";
		$query_i_cacd14="INSERT INTO com_comp_act_com_dic (cacd_acd_id, cacd_comp_id, cacd_numero) VALUES (".$acd_id1.",".$comp_1_4.",4)";
		$result=mysql_query($query_i_cacd14) or die("No se puede ejecutar la sentencia: ".$query_i_cacd14);
		
	}
	
	//SEGUNDA ACTITUD 
	//echo "SEGUNDA ACTITUD ";
	$query_acd2 ="SELECT * FROM com_act_com_dic WHERE acd_cd_id=".$cd_id." AND acd_act_id=".$act_2;
	$result_acd2=mysql_query($query_acd2) or die("No se puede ejecutar la sentencia: ".$query_acd2);
	$row_acd2=mysql_fetch_array($result_acd2);
	$acd_id2=$row_acd2['acd_id'];
	
	if ($row_acd2){
		//UPDATE DE LA SEGUNDA ACTITUD 
		//echo "UPDATE DE LA SEGUNDA ACTITUD ";
		$query_u_acd2="UPDATE com_act_com_dic SET acd_act_id=".$act_2." WHERE acd_cd_id=".$cd_id." AND acd_grado='B'";
		$result=mysql_query($query_u_acd2) or die("No se puede ejecutar la sentencia: ".$query_u_acd2);
		/*	
		$query_cacd21 ="SELECT * FROM com_comp_act_com_dic WHERE cacd_acd_id=".$acd_id2." AND cacd_numero=1";
		$result_cacd21=mysql_query($query_cacd21) or die("No se puede ejecutar la sentencia: ".$query_cacd21);
		$row_cacd21=mysql_fetch_array($result_cacd21);
		$cacd_id21=$row_cacd21['cacd_id'];
		*/
		//UPDATE DEL PRIMER COMPORTAMIENTO DE LA SEGUNDA ACTITUD 
		//echo "UPDATE DEL PRIMER COMPORTAMIENTO DE LA SEGUNDA ACTITUD";
		$query_u_cacd21="UPDATE com_comp_act_com_dic SET cacd_comp_id=".$comp_2_1." WHERE cacd_acd_id=".$acd_id2." and cacd_numero=1";
		$result=mysql_query($query_u_cacd21) or die("No se puede ejecutar la sentencia: ".$query_u_cacd21);
		/*	
		$query_cacd22 ="SELECT * FROM com_comp_act_com_dic WHERE cacd_acd_id=".$acd_id2." AND cacd_numero=2";
		$result_cacd22=mysql_query($query_cacd22) or die("No se puede ejecutar la sentencia: ".$query_cacd22);
		$row_cacd22=mysql_fetch_array($result_cacd22);
		$cacd_id22=$row_cacd22['cacd_id'];
		*/
		//UPDATE DEL SEGUNDO COMPORTAMIENTO DE LA SEGUNDA ACTITUD 
		//echo "UPDATE DEL SEGUNDO COMPORTAMIENTO DE LA SEGUNDA ACTITUD ";
	
		$query_u_cacd22="UPDATE com_comp_act_com_dic SET cacd_comp_id=".$comp_2_2." WHERE cacd_acd_id=".$acd_id2." and cacd_numero=2";
		$result=mysql_query($query_u_cacd22) or die("No se puede ejecutar la sentencia: ".$query_u_cacd22);
		/*	
		$query_cacd23 ="SELECT * FROM com_comp_act_com_dic WHERE cacd_acd_id=".$acd_id2." AND cacd_numero=3";
		$result_cacd23=mysql_query($query_cacd23) or die("No se puede ejecutar la sentencia: ".$query_cacd23);
		$row_cacd23=mysql_fetch_array($result_cacd23);
		$cacd_id23=$row_cacd23['cacd_id'];
		*/
		//UPDATE DEL TERCER COMPORTAMIENTO DE LA SEGUNDA ACTITUD 
		//echo "UPDATE DEL TERCER COMPORTAMIENTO DE LA SEGUNDA ACTITUD";
	
		$query_u_cacd23="UPDATE com_comp_act_com_dic SET cacd_comp_id=".$comp_2_3." WHERE cacd_acd_id=".$acd_id2." and cacd_numero=3";
		$result=mysql_query($query_u_cacd23) or die("No se puede ejecutar la sentencia: ".$query_u_cacd23);
		/*	
		$query_cacd24 ="SELECT * FROM com_comp_act_com_dic WHERE cacd_acd_id=".$acd_id2." AND cacd_numero=4";
		$result_cacd24=mysql_query($query_cacd24) or die("No se puede ejecutar la sentencia: ".$query_cacd24);
		$row_cacd24=mysql_fetch_array($result_cacd24);
		$cacd_id24=$row_cacd24['cacd_id'];
		*/
		//UPDATE DEL CUARTO COMPORTAMIENTO DE LA SEGUNDA ACTITUD 
		//echo "UPDATE DEL CUARTO COMPORTAMIENTO DE LA SEGUNDA ACTITUD";
		$query_u_cacd24="UPDATE com_comp_act_com_dic SET cacd_comp_id=".$comp_2_4." WHERE cacd_acd_id=".$acd_id2." and cacd_numero=4";
		$result=mysql_query($query_u_cacd24) or die("No se puede ejecutar la sentencia: ".$query_u_cacd24);
		
	}
	else{
		//INSERT DE LA SEGUNDA ACTITUD 
		//echo "INSERT DE LA SEGUNDA ACTITUD ";
		$query_i_acd2="INSERT INTO com_act_com_dic (acd_grado, acd_cd_id, acd_act_id ) VALUES ('B', '".$cd_id."', '".$act_2."')";
		$result=mysql_query($query_i_acd2) or die("No se puede ejecutar la sentencia: ".$query_i_acd2);	
		
		$query_acd2 ="SELECT * FROM com_act_com_dic WHERE acd_cd_id=".$cd_id." AND acd_act_id=".$act_2." AND acd_grado='B'";
		$result_acd2=mysql_query($query_acd2) or die("No se puede ejecutar la sentencia: ".$query_acd2);
		$row_acd2=mysql_fetch_array($result_acd2);
		$acd_id2=$row_acd2['acd_id'];
		//echo "acd_id2: ".$acd_id2."<br>";
		
		//INSERT DEL PRIMER COMPORTAMIENTO DE LA SEGUNDA ACTITUD 
		//echo "INSERT DEL PRIMER COMPORTAMIENTO DE LA SEGUNDA ACTITUD ";
		$query_i_cacd21="INSERT INTO com_comp_act_com_dic (cacd_acd_id, cacd_comp_id, cacd_numero) VALUES (".$acd_id2.",".$comp_2_1.",1)";
		$result=mysql_query($query_i_cacd21) or die("No se puede ejecutar la sentencia: ".$query_i_cacd21);
		
		//INSERT DEL SEGUNDO COMPORTAMIENTO DE LA SEGUNDA ACTITUD 
		//echo "INSERT DEL SEGUNDO COMPORTAMIENTO DE LA SEGUNDA ACTITUD ";
		$query_i_cacd22="INSERT INTO com_comp_act_com_dic (cacd_acd_id, cacd_comp_id, cacd_numero) VALUES (".$acd_id2.",".$comp_2_2.",2)";
		$result=mysql_query($query_i_cacd22) or die("No se puede ejecutar la sentencia: ".$query_i_cacd22);
		
		//INSERT DEL TERCER COMPORTAMIENTO DE LA SEGUNDA ACTITUD 
		//echo "PRIMERA ACTITUD";
		$query_i_cacd23="INSERT INTO com_comp_act_com_dic (cacd_acd_id, cacd_comp_id, cacd_numero) VALUES (".$acd_id2.",".$comp_2_3.",3)";
		$result=mysql_query($query_i_cacd23) or die("No se puede ejecutar la sentencia: ".$query_i_cacd23);
		
		
		//INSERT DEL CUARTO COMPORTAMIENTO DE LA SEGUNDA ACTITUD 
		//echo "INSERT DEL CUARTO COMPORTAMIENTO DE LA SEGUNDA ACTITUD";
		$query_i_cacd24="INSERT INTO com_comp_act_com_dic (cacd_acd_id, cacd_comp_id, cacd_numero) VALUES (".$acd_id2.",".$comp_2_4.",4)";
		$result=mysql_query($query_i_cacd24) or die("No se puede ejecutar la sentencia: ".$query_i_cacd24);
		
	}
	//TERCERA ACTITUD 
	//echo "TERCERA ACTITUD ";
	$query_acd3 ="SELECT * FROM com_act_com_dic WHERE acd_cd_id=".$cd_id." AND acd_act_id=".$act_3;
	$result_acd3=mysql_query($query_acd3) or die("No se puede ejecutar la sentencia: ".$query_acd3);
	$row_acd3=mysql_fetch_array($result_acd3);
	$acd_id3=$row_acd3['acd_id'];
	
	if ($row_acd3){
		//UPDATE DE LA TERCERA ACTITUD 
		//echo "UPDATE DE LA TERCERA ACTITUD";
		$query_u_acd3="UPDATE com_act_com_dic SET acd_act_id=".$act_3." WHERE acd_cd_id=".$cd_id." AND acd_grado='C'";
		$result=mysql_query($query_u_acd3) or die("No se puede ejecutar la sentencia: ".$query_u_acd3);
		/*	
		$query_cacd31 ="SELECT * FROM com_comp_act_com_dic WHERE cacd_acd_id=".$acd_id3." AND cacd_numero=1";
		$result_cacd31=mysql_query($query_cacd31) or die("No se puede ejecutar la sentencia: ".$query_cacd31);
		$row_cacd31=mysql_fetch_array($result_cacd31);
		$cacd_id31=$row_cacd31['cacd_id'];
		*/
		//UPDATE DEL PRIMER COMPORTAMIENTO DE LA TERCERA ACTITUD 
		//echo "UPDATE DEL PRIMER COMPORTAMIENTO DE LA TERCERA ACTITUD ";
	
		$query_u_cacd31="UPDATE com_comp_act_com_dic SET cacd_comp_id=".$comp_3_1." WHERE cacd_acd_id=".$acd_id3." and cacd_numero=1";
		$result=mysql_query($query_u_cacd31) or die("No se puede ejecutar la sentencia: ".$query_u_cacd31);
		/*
		$query_cacd32 ="SELECT * FROM com_comp_act_com_dic WHERE cacd_acd_id=".$acd_id3." AND cacd_numero=2";
		$result_cacd32=mysql_query($query_cacd32) or die("No se puede ejecutar la sentencia: ".$query_cacd32);
		$row_cacd32=mysql_fetch_array($result_cacd32);
		$cacd_id32=$row_cacd32['cacd_id'];
		*/
		//UPDATE DEL SEGUNDO COMPORTAMIENTO DE LA TERCERA ACTITUD 
		//echo "UPDATE DEL SEGUNDO COMPORTAMIENTO DE LA TERCERA ACTITUD";
		
		$query_u_cacd32="UPDATE com_comp_act_com_dic SET cacd_comp_id=".$comp_3_2." WHERE cacd_acd_id=".$acd_id3." and cacd_numero=2";
		$result=mysql_query($query_u_cacd32) or die("No se puede ejecutar la sentencia: ".$query_u_cacd32);
		
		/*
		$query_cacd33 ="SELECT * FROM com_comp_act_com_dic WHERE cacd_acd_id=".$acd_id3." AND cacd_numero=3";
		$result_cacd33=mysql_query($query_cacd33) or die("No se puede ejecutar la sentencia: ".$query_cacd33);
		$row_cacd33=mysql_fetch_array($result_cacd33);
		$cacd_id33=$row_cacd33['cacd_id'];
		*/
		//UPDATE DEL TERCER COMPORTAMIENTO DE LA TERCERA ACTITUD 
		//echo "UPDATE DEL TERCER COMPORTAMIENTO DE LA TERCERA ACTITUD ";
		
		$query_u_cacd33="UPDATE com_comp_act_com_dic SET cacd_comp_id=".$comp_3_3." WHERE cacd_acd_id=".$acd_id3." and cacd_numero=3";
		$result=mysql_query($query_u_cacd33) or die("No se puede ejecutar la sentencia: ".$query_u_cacd33);
		/*
		$query_cacd34 ="SELECT * FROM com_comp_act_com_dic WHERE cacd_acd_id=".$acd_id3." AND cacd_numero=4";
		$result_cacd34=mysql_query($query_cacd34) or die("No se puede ejecutar la sentencia: ".$query_cacd34);
		$row_cacd34=mysql_fetch_array($result_cacd34);
		$cacd_id34=$row_cacd34['cacd_id'];
		*/
		//UPDATE DEL CUARTO COMPORTAMIENTO DE LA TERCERA ACTITUD 
		//echo "UPDATE DEL CUARTO COMPORTAMIENTO DE LA TERCERA ACTITUD ";
		$query_u_cacd34="UPDATE com_comp_act_com_dic SET cacd_comp_id=".$comp_3_4." WHERE cacd_acd_id=".$acd_id3." and cacd_numero=4";
		$result=mysql_query($query_u_cacd34) or die("No se puede ejecutar la sentencia: ".$query_u_cacd34);
		
	}
	else{
		//INSERT DE LA TERCERA ACTITUD 
		//echo "INSERT DE LA TERCERA ACTITUD";
		$query_i_acd3="INSERT INTO com_act_com_dic (acd_grado, acd_cd_id, acd_act_id ) VALUES ('C', '".$cd_id."', '".$act_3."')";
		$result=mysql_query($query_i_acd3) or die("No se puede ejecutar la sentencia: ".$query_i_acd3);	
		
		$query_acd3 ="SELECT * FROM com_act_com_dic WHERE acd_cd_id=".$cd_id." AND acd_act_id=".$act_3." AND acd_grado='C'";
		$result_acd3=mysql_query($query_acd3) or die("No se puede ejecutar la sentencia: ".$query_acd3);
		$row_acd3=mysql_fetch_array($result_acd3);
		$acd_id3=$row_acd3['acd_id'];
		//echo "acd_id3: ".$acd_id3."<br>";
		
		//INSERT DEL PRIMER COMPORTAMIENTO DE LA TERCERA ACTITUD 
		//echo "INSERT DEL PRIMER COMPORTAMIENTO DE LA TERCERA ACTITUD ";
		$query_i_cacd31="INSERT INTO com_comp_act_com_dic (cacd_acd_id, cacd_comp_id, cacd_numero) VALUES (".$acd_id3.",".$comp_3_1.",1)";
		$result=mysql_query($query_i_cacd31) or die("No se puede ejecutar la sentencia: ".$query_i_cacd31);
		
		//INSERT DEL SEGUNDO COMPORTAMIENTO DE LA TERCERA ACTITUD 
		//echo "INSERT DEL SEGUNDO COMPORTAMIENTO DE LA TERCERA ACTITUD";
		$query_i_cacd32="INSERT INTO com_comp_act_com_dic (cacd_acd_id, cacd_comp_id, cacd_numero) VALUES (".$acd_id3.",".$comp_3_2.",2)";
		$result=mysql_query($query_i_cacd32) or die("No se puede ejecutar la sentencia: ".$query_i_cacd32);
		
		//INSERT DEL TERCER COMPORTAMIENTO DE LA TERCERA ACTITUD 
		//echo "INSERT DEL TERCER COMPORTAMIENTO DE LA TERCERA ACTITUD";
		$query_i_cacd33="INSERT INTO com_comp_act_com_dic (cacd_acd_id, cacd_comp_id, cacd_numero) VALUES (".$acd_id3.",".$comp_3_3.",3)";
		$result=mysql_query($query_i_cacd33) or die("No se puede ejecutar la sentencia: ".$query_i_cacd33);
		
		
		//INSERT DEL CUARTO COMPORTAMIENTO DE LA TERCERA ACTITUD 
		//echo "INSERT DEL CUARTO COMPORTAMIENTO DE LA TERCERA ACTITUD";
		$query_i_cacd34="INSERT INTO com_comp_act_com_dic (cacd_acd_id, cacd_comp_id, cacd_numero) VALUES (".$acd_id3.",".$comp_3_4.",4)";
		$result=mysql_query($query_i_cacd34) or die("No se puede ejecutar la sentencia: ".$query_i_cacd34);
		
	}
/*} else if ($dic_agrupado=="si"){
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
	
	$query_cd ="SELECT * FROM com_com_dic WHERE cd_dic_id=".$dic_id." AND cd_com_id=".$com_id;
	echo $query_cd."<br>";
	$result_cd=mysql_query($query_cd) or die("No se puede ejecutar la sentencia: ".$query_cd);
	$row_cd=mysql_fetch_array($result_cd);
	$cd_id=$row_cd['cd_id'];
	
	$query_acd ="SELECT * FROM com_act_com_dic WHERE acd_cd_id=".$cd_id;
	echo $query_acd."<br>";
	$result_acd=mysql_query($query_acd) or die("No se puede ejecutar la sentencia: ".$query_acd);
	$row_acd=mysql_fetch_array($result_acd);
	$acd_id=$row_acd['acd_id'];
	
	if ($acd_id){
		$query_u_cacd1="UPDATE com_comp_act_com_dic SET cacd_comp_id=".$comp_1." WHERE cacd_acd_id=".$acd_id." and cacd_numero=1";
		$result=mysql_query($query_u_cacd1) or die("No se puede ejecutar la sentencia: ".$query_u_cacd1);
		$query_u_cacd2="UPDATE com_comp_act_com_dic SET cacd_comp_id=".$comp_2." WHERE cacd_acd_id=".$acd_id." and cacd_numero=2";
		$result=mysql_query($query_u_cacd2) or die("No se puede ejecutar la sentencia: ".$query_u_cacd2);
		$query_u_cacd3="UPDATE com_comp_act_com_dic SET cacd_comp_id=".$comp_3." WHERE cacd_acd_id=".$acd_id." and cacd_numero=3";
		$result=mysql_query($query_u_cacd3) or die("No se puede ejecutar la sentencia: ".$query_u_cacd3);
		$query_u_cacd4="UPDATE com_comp_act_com_dic SET cacd_comp_id=".$comp_4." WHERE cacd_acd_id=".$acd_id." and cacd_numero=4";
		$result=mysql_query($query_u_cacd4) or die("No se puede ejecutar la sentencia: ".$query_u_cacd4);
		$query_u_cacd5="UPDATE com_comp_act_com_dic SET cacd_comp_id=".$comp_5." WHERE cacd_acd_id=".$acd_id." and cacd_numero=5";
		$result=mysql_query($query_u_cacd5) or die("No se puede ejecutar la sentencia: ".$query_u_cacd5);
		$query_u_cacd6="UPDATE com_comp_act_com_dic SET cacd_comp_id=".$comp_6." WHERE cacd_acd_id=".$acd_id." and cacd_numero=6";
		$result=mysql_query($query_u_cacd6) or die("No se puede ejecutar la sentencia: ".$query_u_cacd6);
		$query_u_cacd7="UPDATE com_comp_act_com_dic SET cacd_comp_id=".$comp_7." WHERE cacd_acd_id=".$acd_id." and cacd_numero=7";
		$result=mysql_query($query_u_cacd7) or die("No se puede ejecutar la sentencia: ".$query_u_cacd7);
		$query_u_cacd8="UPDATE com_comp_act_com_dic SET cacd_comp_id=".$comp_8." WHERE cacd_acd_id=".$acd_id." and cacd_numero=8";
		$result=mysql_query($query_u_cacd8) or die("No se puede ejecutar la sentencia: ".$query_u_cacd8);
		$query_u_cacd9="UPDATE com_comp_act_com_dic SET cacd_comp_id=".$comp_9." WHERE cacd_acd_id=".$acd_id." and cacd_numero=9";
		$result=mysql_query($query_u_cacd9) or die("No se puede ejecutar la sentencia: ".$query_u_cacd9);
		$query_u_cacd10="UPDATE com_comp_act_com_dic SET cacd_comp_id=".$comp_10." WHERE cacd_acd_id=".$acd_id." and cacd_numero=10";
		$result=mysql_query($query_u_cacd10) or die("No se puede ejecutar la sentencia: ".$query_u_cacd10);
		$query_u_cacd11="UPDATE com_comp_act_com_dic SET cacd_comp_id=".$comp_11." WHERE cacd_acd_id=".$acd_id." and cacd_numero=11";
		$result=mysql_query($query_u_cacd11) or die("No se puede ejecutar la sentencia: ".$query_u_cacd11);
		$query_u_cacd12="UPDATE com_comp_act_com_dic SET cacd_comp_id=".$comp_12." WHERE cacd_acd_id=".$acd_id." and cacd_numero=12";
		$result=mysql_query($query_u_cacd12) or die("No se puede ejecutar la sentencia: ".$query_u_cacd12);
	} else{
	$query_i_acd="INSERT INTO com_act_com_dic (acd_cd_id) VALUES ('".$cd_id."')";
	
		$result=mysql_query($query_i_acd) or die("No se puede ejecutar la sentencia: ".$query_i_acd);	
	
	$query_acd ="SELECT * FROM com_act_com_dic WHERE acd_cd_id=".$cd_id;
		$result_acd=mysql_query($query_acd) or die("No se puede ejecutar la sentencia: ".$query_acd);
		$row_acd=mysql_fetch_array($result_acd);
		$acd_id=$row_acd['acd_id'];
	
	$query_i_cacd1="INSERT INTO com_comp_act_com_dic (cacd_acd_id, cacd_comp_id, cacd_numero) VALUES (".$acd_id.",".$comp_1.",1)";
	$result=mysql_query($query_i_cacd1) or die("No se puede ejecutar la sentencia: ".$query_i_cacd1);
	$query_i_cacd2="INSERT INTO com_comp_act_com_dic (cacd_acd_id, cacd_comp_id, cacd_numero) VALUES (".$acd_id.",".$comp_2.",2)";
	$result=mysql_query($query_i_cacd2) or die("No se puede ejecutar la sentencia: ".$query_i_cacd2);
	$query_i_cacd3="INSERT INTO com_comp_act_com_dic (cacd_acd_id, cacd_comp_id, cacd_numero) VALUES (".$acd_id.",".$comp_3.",3)";
	$result=mysql_query($query_i_cacd3) or die("No se puede ejecutar la sentencia: ".$query_i_cacd3);
	$query_i_cacd4="INSERT INTO com_comp_act_com_dic (cacd_acd_id, cacd_comp_id, cacd_numero) VALUES (".$acd_id.",".$comp_4.",4)";
	$result=mysql_query($query_i_cacd4) or die("No se puede ejecutar la sentencia: ".$query_i_cacd4);
	$query_i_cacd5="INSERT INTO com_comp_act_com_dic (cacd_acd_id, cacd_comp_id, cacd_numero) VALUES (".$acd_id.",".$comp_5.",5)";
	$result=mysql_query($query_i_cacd5) or die("No se puede ejecutar la sentencia: ".$query_i_cacd5);
	$query_i_cacd6="INSERT INTO com_comp_act_com_dic (cacd_acd_id, cacd_comp_id, cacd_numero) VALUES (".$acd_id.",".$comp_6.",6)";
	$result=mysql_query($query_i_cacd6) or die("No se puede ejecutar la sentencia: ".$query_i_cacd6);
	$query_i_cacd7="INSERT INTO com_comp_act_com_dic (cacd_acd_id, cacd_comp_id, cacd_numero) VALUES (".$acd_id.",".$comp_7.",7)";
	$result=mysql_query($query_i_cacd7) or die("No se puede ejecutar la sentencia: ".$query_i_cacd7);
	$query_i_cacd8="INSERT INTO com_comp_act_com_dic (cacd_acd_id, cacd_comp_id, cacd_numero) VALUES (".$acd_id.",".$comp_8.",8)";
	$result=mysql_query($query_i_cacd8) or die("No se puede ejecutar la sentencia: ".$query_i_cacd8);
	$query_i_cacd9="INSERT INTO com_comp_act_com_dic (cacd_acd_id, cacd_comp_id, cacd_numero) VALUES (".$acd_id.",".$comp_9.",9)";
	$result=mysql_query($query_i_cacd9) or die("No se puede ejecutar la sentencia: ".$query_i_cacd9);
	$query_i_cacd10="INSERT INTO com_comp_act_com_dic (cacd_acd_id, cacd_comp_id, cacd_numero) VALUES (".$acd_id.",".$comp_10.",10)";
	$result=mysql_query($query_i_cacd10) or die("No se puede ejecutar la sentencia: ".$query_i_cacd10);
	$query_i_cacd11="INSERT INTO com_comp_act_com_dic (cacd_acd_id, cacd_comp_id, cacd_numero) VALUES (".$acd_id.",".$comp_11.",11)";
	$result=mysql_query($query_i_cacd11) or die("No se puede ejecutar la sentencia: ".$query_i_cacd11);
	$query_i_cacd12="INSERT INTO com_comp_act_com_dic (cacd_acd_id, cacd_comp_id, cacd_numero) VALUES (".$acd_id.",".$comp_12.",12)";
	$result=mysql_query($query_i_cacd12) or die("No se puede ejecutar la sentencia: ".$query_i_cacd12);
	}
}*/
header('Location: show.php?com_id='.$com_id.'&dic_id='.$dic_id);
?>
