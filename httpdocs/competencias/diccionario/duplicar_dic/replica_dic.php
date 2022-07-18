<?php session_start();
include("../../../login/sesion_start.php");
include("../../../login/sesion_start_rrhh.php");
include("../../../librerias/librerias.php");
include("../../../cabecera-competencias.php");
$conn=db_connect();

$dic_id=$_REQUEST['dic_nombre_nuevo'];
$ano=$_REQUEST['dic_ano_duplicado'];

$query="SELECT * FROM com_diccionarios WHERE dic_id=".$dic_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
$row=mysql_fetch_array($result);

$query_insert="INSERT INTO com_diccionarios (dic_nombre, dic_ano, dic_agrupado, dic_cerrado) VALUES ('".$row['dic_nombre']."','".$ano."','".$row['dic_agrupado']."','no')";
$result_insert=mysql_query($query_insert) or die("No se puede ejecutar la sentencia: ".$query_insert);
$query_com_diccionarios="SELECT * FROM com_diccionarios WHERE dic_nombre='".$row['dic_nombre']."' AND dic_ano= '".$ano."' AND dic_agrupado='".$row['dic_agrupado']."' AND dic_cerrado='no'";
$result_com_diccionarios=mysql_query($query_com_diccionarios) or die("No se puede ejecutar la sentencia: ".$query_com_diccionarios);
$row_com_diccionarios=mysql_fetch_array($result_com_diccionarios);
//$dic_id_new es la nueva id del diccionario.
$dic_id_new=$row_com_diccionarios['dic_id'];

$query_com_dic="SELECT * FROM com_com_dic WHERE cd_dic_id=".$dic_id;
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
header('Location: /competencias/diccionario/index.php');
?>
