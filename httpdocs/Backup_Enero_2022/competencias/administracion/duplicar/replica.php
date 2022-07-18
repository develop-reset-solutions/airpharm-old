<?php session_start();
include("../../../login/sesion_start.php");
include("../../../login/sesion_start_rrhh.php");
include("../../../librerias/librerias.php");
include("../../../cabecera-competencias.php");
$conn=db_connect();

$ano_origen=$_REQUEST['ano_origen'];
$ano=$_REQUEST['ano_nuevo'];

//Selecciono los diccionarios del año de origen cerrados.
$query_dic="SELECT * FROM com_diccionarios WHERE dic_ano=".$ano_origen." AND dic_cerrado='si'";
$result_dic=mysql_query($query_dic) or die("No se puede ejecutar la sentencia: ".$query_dic);
while($row_dic=mysql_fetch_array($result_dic)){
	//selecciono un diccionario
	$dic_id_antiguo=$row_dic['dic_id'];
	$query="SELECT * FROM com_diccionarios WHERE dic_id=".$row_dic['dic_id'];
	$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
	$row=mysql_fetch_array($result);
	//Compruebo que no exita un diccionario del año nuevo con el mismo nombre cerrado
	$query_existe="SELECT * FROM com_diccionarios WHERE dic_nombre='".$row['dic_nombre']."' AND dic_ano=".$ano." AND dic_cerrado='si'";
	$result_existe=mysql_query($query_existe) or die("No se puede ejecutar la sentencia: ".$query_existe);
	$num_existe = mysql_num_rows($result_existe);
	$row_existe=mysql_fetch_array($result_existe);
	$dic_id_nuevo=$row_existe['dic_id'];
	/*
	echo "año: ".$ano."<br>";
	echo "nombre: ".$row['dic_nombre']."<br>";
	echo "dic_id_nuevo: ".$dic_id_nuevo."<br>";
	echo "num_existe: ".$num_existe."<br>";
	*/
	if($num_existe==0){
		$query_insert="INSERT INTO com_diccionarios (dic_nombre, dic_ano, dic_agrupado, dic_cerrado) VALUES ('".$row['dic_nombre']."','".$ano."','".$row['dic_agrupado']."','si')";
		$result_insert=mysql_query($query_insert) or die("No se puede ejecutar la sentencia: ".$query_insert);
		
		$query_com_diccionarios="SELECT * FROM com_diccionarios WHERE dic_nombre='".$row['dic_nombre']."' AND dic_ano= '".$ano."' AND dic_agrupado='".$row['dic_agrupado']."'";
		$result_com_diccionarios=mysql_query($query_com_diccionarios) or die("No se puede ejecutar la sentencia: ".$query_com_diccionarios);
		$row_com_diccionarios=mysql_fetch_array($result_com_diccionarios);
		//$dic_id_new es la nueva id del diccionario.
		$dic_id_new=$row_com_diccionarios['dic_id'];
		
		$query_com_dic="SELECT * FROM com_com_dic WHERE cd_dic_id=".$row_dic['dic_id'];
		$result_com_dic=mysql_query($query_com_dic) or die("No se puede ejecutar la sentencia: ".$query_com_dic);
		while($row_com_dic=mysql_fetch_array($result_com_dic)){
			//$row_com_dic son los resultados antiguos de la tabla com_com_dic
			
			$query_insert_com_dic="INSERT INTO com_com_dic (cd_dic_id, cd_com_id, cd_orden) VALUES ('".$dic_id_new."','".$row_com_dic['cd_com_id']."','".$row_com_dic['cd_orden']."')";
			$result_insert_com_dic=mysql_query($query_insert_com_dic) or die("No se puede ejecutar la sentencia: ".$query_insert_com_dic);
			
			$query_com_dic_new="SELECT * FROM com_com_dic WHERE cd_dic_id='".$dic_id_new."' AND  cd_com_id='".$row_com_dic['cd_com_id']."' AND cd_orden='".$row_com_dic['cd_orden']."'";
			$result_com_dic_new=mysql_query($query_com_dic_new) or die("No se puede ejecutar la sentencia: ".$query_com_dic_new);
			
			// no se a partir de aqui...
			while($row_com_dic_new=mysql_fetch_array($result_com_dic_new)){
				//$row_com_dic_new son los resultados nuevos de la tabla com_com_dic
			
				$query_act_com_dic="SELECT * FROM com_act_com_dic WHERE acd_cd_id=".$row_com_dic['cd_id'];
				//echo "query_act_com_dic: ".$query_act_com_dic."<br>";
				$result_act_com_dic=mysql_query($query_act_com_dic) or die("No se puede ejecutar la sentencia: ".$query_act_com_dic);
				while($row_act_com_dic=mysql_fetch_array($result_act_com_dic)){
					//$row_act_com_dic son los resultados antigos de la tabla com_act_com_dic
					
					$query_insert_act_com_dic="INSERT INTO com_act_com_dic (acd_cd_id, acd_act_id, acd_grado) 
					VALUES ('".$row_com_dic_new['cd_id']."','".$row_act_com_dic['acd_act_id']."','".$row_act_com_dic['acd_grado']."')";
					//echo "query_insert_act_com_dic: ".$query_insert_act_com_dic."<br>";
					$result_insert_act_com_dic=mysql_query($query_insert_act_com_dic) or die("No se puede ejecutar la sentencia: ".$query_insert_act_com_dic);	
		
					$query_act_dic_new="SELECT * FROM com_act_com_dic WHERE acd_cd_id='".$row_com_dic_new['cd_id']."' AND  acd_act_id='".$row_act_com_dic['acd_act_id']."' 
					AND acd_grado='".$row_act_com_dic['acd_grado']."'";
					//echo "query_act_dic_new: ".$query_act_dic_new."<br>";
					$result_act_dic_new=mysql_query($query_act_dic_new) or die("No se puede ejecutar la sentencia: ".$query_act_dic_new);
					while($row_act_dic_new=mysql_fetch_array($result_act_dic_new)){
						//$row_act_dic_new son los resultados nuevos de la tabla com_act_com_dic
						
						$query_comp_act_com_dic="SELECT * FROM com_comp_act_com_dic WHERE cacd_acd_id=".$row_act_com_dic['acd_id'];
						//echo "query_comp_act_com_dic: ".$query_comp_act_com_dic."<br>";
						$result_comp_act_com_dic=mysql_query($query_comp_act_com_dic) or die("No se puede ejecutar la sentencia: ".$query_comp_act_com_dic);
						while($row_comp_act_com_dic=mysql_fetch_array($result_comp_act_com_dic)){
							//$row_comp_act_com_dic son los resultados antigos de la tabla com_comp_act_com_dic
							
							$query_insert_comp_act_com_dic="INSERT INTO com_comp_act_com_dic (cacd_acd_id, cacd_comp_id, cacd_numero) 
							VALUES ('".$row_act_dic_new['acd_id']."','".$row_comp_act_com_dic['cacd_comp_id']."','".$row_comp_act_com_dic['cacd_numero']."')";
							//echo "query_insert_comp_act_com_dic: ".$query_insert_comp_act_com_dic."<br>";
							$result_insert_comp_act_com_dic=mysql_query($query_insert_comp_act_com_dic) or die("No se puede ejecutar la sentencia: ".$query_insert_comp_act_com_dic);	
						}
					}
				}
			}
		}
		//Selecciono los usuarios asignados a ese diccionario
		$query_usr_dic="SELECT * FROM com_diccionarios_usuarios WHERE du_dic_id=".$row_dic['dic_id'];
		$result_usr_dic=mysql_query($query_usr_dic) or die("No se puede ejecutar la sentencia: ".$query_usr_dic);
		
		while($row_usr_dic=mysql_fetch_array($result_usr_dic)){
			//Asigno los mismos valores exepto el cerrado
			$query_insert_usr_dic="INSERT INTO com_diccionarios_usuarios (du_dic_id, du_usr_id, du_responsable, du_autoevaluable, du_cerrado) 
			VALUES ('".$dic_id_new."','".$row_usr_dic['du_usr_id']."','".$row_usr_dic['du_responsable']."','".$row_usr_dic['du_autoevaluable']."', '0')";
			
			$result_insert_usr_dic=mysql_query($query_insert_usr_dic) or die("No se puede ejecutar la sentencia: ".$query_insert_usr_dic);	
		}
	} else{
	// si el diccionario existe signar igualmente a los usuarios
		$query_usr_dic="SELECT * FROM com_diccionarios_usuarios WHERE du_dic_id=".$dic_id_antiguo;
		$result_usr_dic=mysql_query($query_usr_dic) or die("No se puede ejecutar la sentencia: ".$query_usr_dic);
		
		//du_usr_id
		while($row_usr_dic=mysql_fetch_array($result_usr_dic)){
			$query_usr_dic_nuevo="SELECT * FROM com_diccionarios_usuarios WHERE du_dic_id=".$dic_id_nuevo." and du_usr_id=".$row_usr_dic['du_usr_id'];
			$result_usr_dic_nuevo=mysql_query($query_usr_dic_nuevo) or die("No se puede ejecutar la sentencia: ".$query_usr_dic_nuevo);
			$num_existe2 = mysql_num_rows($result_usr_dic_nuevo);
			if($num_existe2==0){
				//Asigno los mismos valores exepto el cerrado
				$query_insert_usr_dic="INSERT INTO com_diccionarios_usuarios (du_dic_id, du_usr_id, du_responsable, du_autoevaluable, du_cerrado) 
				VALUES ('".$dic_id_nuevo."','".$row_usr_dic['du_usr_id']."','".$row_usr_dic['du_responsable']."','".$row_usr_dic['du_autoevaluable']."', '0')";
				$result_insert_usr_dic=mysql_query($query_insert_usr_dic) or die("No se puede ejecutar la sentencia: ".$query_insert_usr_dic);	
			}
		}
		
	}
}
header('Location: ../index.php');
?>
