<?php
//Convierte monedas a formato euro
function ConvNumEur($a,$b){
		echo number_format ($a,'2',',','.') . " ". $b;
}

//Convierte fecha y hora a timestamp
function conv_a_tstamp($fecha){
	$mifechasplit = explode(" ",$fecha);
	$mihora=explode(":",$mifechasplit[1]);
	$mifecha=explode("/",$mifechasplit[0]);
	return mktime($mihora[0],$mihora[1],0,$mifecha[1],$mifecha[0],$mifecha[2]);
}

//Devuelve mes
function mes($fecha){
    $mifecha=explode("/",$fecha);
    return $mifecha[1];
}
//Devuelve mes
function anyo($fecha){
    $mifecha=explode("/",$fecha);
    return $mifecha[2];
}


//Convierte fecha de mysql a normal
function cambiaf_a_normal($fecha){
    $mifecha=explode("-",$fecha);
    $lafecha=$mifecha[2]."/".$mifecha[1]."/".$mifecha[0];
    return $lafecha;
}

//Convierte fecha de normal a mysql
function cambiaf_a_mysql($fecha){
	$mifecha = explode("/",$fecha);
    $lafecha=$mifecha[2]."-".$mifecha[1]."-".$mifecha[0];
    return $lafecha;
}

//Convierte fecha y hora de mysql a normal
function cambiafh_a_normal($fecha){
	$mifechasplit = explode(" ",$fecha);
	$mihora=explode(":",$mifechasplit[1]);
	$mifecha=explode("-",$mifechasplit[0]);
	$lafecha=$mifecha[2]."/".$mifecha[1]."/".$mifecha[0]." ".$mihora[0].":".$mihora[1];
    return $lafecha;
}

//Convierte fecha y hora de normal a mysql
function cambiafh_a_mysql($fecha){
	$mifechasplit = explode(" ",$fecha);
	$mihora=explode(":",$mifechasplit[1]);
	$mifecha=explode("/",$mifechasplit[0]);
	$lafecha=$mifecha[2]."-".$mifecha[1]."-".$mifecha[0]." ".$mihora[0].":".$mihora[1];
    return $lafecha;
}

//Convierte hora a minseg
function cambiah_a_minseg($hora){
	$mihora = explode(":",$hora);
    $lahora=$mihora[0].":".$mihora[1];
    return $lahora;
}
//Devuelve fila TConfig
function configphp(){
	$sqlquery="SELECT * FROM config";
	$queryresult=mysql_query($sqlquery) or die ("No se puede ejecutar la Consulta a config");
	return mysql_fetch_array($queryresult);
}
//Calculo valor linea
function por_obtencion($dl_id,$trimestre){
	$query="SELECT * FROM vdpo_lineas WHERE dl_id=".$dl_id;+
	$result=mysql_query($query) or die ("No se puede ejecutar la sentencia: ".$query);
	$row=mysql_fetch_array($result);
	$medicion=false;
	$valor_medicion=0;
	$total=0;
	switch($trimestre){
		case 1:
			if(is_numeric(str_replace(',','.',$row['dl_rdo_q1']))){
				$total='Si';
				$medicion=true;
				$valor_medicion=str_replace(',','.',$row['dl_rdo_q1']);
			}
			break;
		case 2:
			if(is_numeric(str_replace(',','.',$row['dl_rdo_q2']))){
				$medicion=true;
				$valor_medicion=str_replace(',','.',$row['dl_rdo_q2']);
			}
			break;
		case 3:
			if(is_numeric(str_replace(',','.',$row['dl_rdo_q3']))){
				$medicion=true;
				$valor_medicion=str_replace(',','.',$row['dl_rdo_q3']);
			}
			break;
		case 4:
			if(is_numeric(str_replace(',','.',$row['dl_rdo_q4']))){
				$medicion=true;
				$valor_medicion=str_replace(',','.',$row['dl_rdo_q4']);
			}
			break;
		case 'Anual':
			if(is_numeric(str_replace(',','.',$row['dl_rdo_anual']))){
				$medicion=true;
				$valor_medicion=str_replace(',','.',$row['dl_rdo_anual']);
			}
			break;
		default:
			$n_tri=0;
			$valor_medicion=0;
			$ultimo=false;
			if(is_numeric(str_replace(',','.',$row['dl_rdo_q4']))){
				$n_tri++;
				$medicion=true;
				if($row['ind_trim_acum']=='Acumulado'){
					if(!$ultimo){
						$valor_medicion=str_replace(',','.',$row['dl_rdo_q4']);
						$ultimo=true;
					}
				}else{
					$valor_medicion+=str_replace(',','.',$row['dl_rdo_q4']);
				}
			}
			if(is_numeric(str_replace(',','.',$row['dl_rdo_q3']))){
				$n_tri++;
				$medicion=true;
				if($row['ind_trim_acum']=='Acumulado'){
					if(!$ultimo){
						$valor_medicion=str_replace(',','.',$row['dl_rdo_q3']);
						$ultimo=true;
					}
				}else{
					$valor_medicion+=str_replace(',','.',$row['dl_rdo_q3']);
				}
			}
			if(is_numeric(str_replace(',','.',$row['dl_rdo_q2']))){
				$n_tri++;
				$medicion=true;
				if($row['ind_trim_acum']=='Acumulado'){
					if(!$ultimo){
						$valor_medicion=str_replace(',','.',$row['dl_rdo_q2']);
						$ultimo=true;
					}
				}else{
					$valor_medicion+=str_replace(',','.',$row['dl_rdo_q2']);
				}
			}
			if(is_numeric(str_replace(',','.',$row['dl_rdo_q1']))){
				$n_tri++;
				$medicion=true;	
				if($row['ind_trim_acum']=='Acumulado'){
					if(!$ultimo){
						$valor_medicion=str_replace(',','.',$row['dl_rdo_q1']);
						$ultimo=true;
					}
				}else{
					$valor_medicion+=str_replace(',','.',$row['dl_rdo_q1']);
				}
			}
			if(is_numeric(str_replace(',','.',$row['dl_rdo_anual']))){
				$n_tri=1;
				$medicion=true;
				$valor_medicion=str_replace(',','.',$row['dl_rdo_anual']);
			}
			if($row['ind_trim_acum']=='Acumulado'){
				$n_tri=1;
			}
			$valor_medicion=$valor_medicion/$n_tri;
			break;
	}
	if($row['oa_horquilla_max']==110){
		$rango=100;
	}else{
		$rango=abs($row['oa_horquilla_max']-$row['oa_horquilla_min']);
	}
	$multiplicador=100/$rango;
	$valor_medicion=str_replace(',','.',$valor_medicion);
	if($medicion){
		if($row['oa_horquilla_max']>$row['oa_horquilla_min']){
			$valor=$valor_medicion-$row['oa_horquilla_min'];
		}else{
			$valor=$row['oa_horquilla_min']-$valor_medicion;
		}
		if($valor>0){
			if($row['oa_horquilla_max']==110){
				$rango=110;
			}
			if($valor>$rango){
				$valor=$rango;
			}
			$total=$valor*$multiplicador;
		}
		if($row['oa_horquilla_max']==$row['oa_horquilla_min']){
			if($valor_medicion>=$row['oa_horquilla_max']){
				$total=100;
			}else{
				$total=0;
			}
		}
	}
	$total=($total*$row['dl_peso'])/100;
	return $total;
}
function sim_anual($dl_id){
	$query="SELECT * FROM vdpo_lineas WHERE dl_id=".$dl_id;
	$result=mysql_query($query) or die ("No se puede ejecutar la sentencia: ".$query);
	$row=mysql_fetch_array($result);
	$n_tri=0;
	$valor_medicion=0;
	$ultimo=false;
	if(is_numeric(str_replace(',','.',$row['dl_rdo_q4']))){
		$n_tri++;
		$medicion=true;
		if($row['ind_trim_acum']=='Acumulado'){
			if(!$ultimo){
				$valor_medicion=str_replace(',','.',$row['dl_rdo_q4']);
				$ultimo=true;
			}
		}else{
			$valor_medicion+=str_replace(',','.',$row['dl_rdo_q4']);
		}
	}
	if(is_numeric(str_replace(',','.',$row['dl_rdo_q3']))){
		$n_tri++;
		$medicion=true;
		if($row['ind_trim_acum']=='Acumulado'){
			if(!$ultimo){
				$valor_medicion=str_replace(',','.',$row['dl_rdo_q3']);
				$ultimo=true;
			}
		}else{
			$valor_medicion+=str_replace(',','.',$row['dl_rdo_q3']);
		}
	}
	if(is_numeric(str_replace(',','.',$row['dl_rdo_q2']))){
		$n_tri++;
		$medicion=true;
		if($row['ind_trim_acum']=='Acumulado'){
			if(!$ultimo){
				$valor_medicion=str_replace(',','.',$row['dl_rdo_q2']);
				$ultimo=true;
			}
		}else{
			$valor_medicion+=str_replace(',','.',$row['dl_rdo_q2']);
		}
	}
	if(is_numeric(str_replace(',','.',$row['dl_rdo_q1']))){
		$n_tri++;
		$medicion=true;
		if($row['ind_trim_acum']=='Acumulado'){
			if(!$ultimo){
				$valor_medicion=str_replace(',','.',$row['dl_rdo_q1']);
				$ultimo=true;
			}
		}else{
			$valor_medicion+=str_replace(',','.',$row['dl_rdo_q1']);
		}
	}
	if(is_numeric(str_replace(',','.',$row['dl_rdo_anual']))){
		$n_tri=1;
		$medicion=true;
		$valor_medicion=str_replace(',','.',$row['dl_rdo_anual']);
	}
	if($row['ind_trim_acum']=='Acumulado'){
		$n_tri=1;
	}
	$valor_medicion=$valor_medicion/$n_tri;
	return $valor_medicion;
}
function imprimir_valor($valor){
	if($valor){
		$valor=str_replace(",",".",$valor);
		if(!is_numeric($valor)){
			$valor='N/A';
		}else{
			$valor=number_format($valor,2,',','.');
		}
	}
	return $valor;		
}
function superior($id_sup,$id_sub){
	$query_usr="SELECT * FROM usuarios WHERE usr_id=".$id_sub;
	$result_usr=mysql_query($query_usr) or die ("No se puede ejecutar la sentencia1: ".$query_usr);
	$row_usr=mysql_fetch_array($result_usr);
	$es_superior=false;
	$superior=$row_usr['usr_superior_id'];
	if($superior==$id_sup or ($id_sup==$id_sub and $superior==130)){
		$es_superior=true;
	}
	while($superior<>'130' and $es_superior==false and $superior<>''){
		$query_usr2="SELECT * FROM usuarios WHERE usr_id=".$superior;
		$result_usr2=mysql_query($query_usr2) or die ("No se puede ejecutar la sentencia: ".$query_usr2);
		$row_usr2=mysql_fetch_array($result_usr2);
		$superior=$row_usr2['usr_superior_id'];
		if($superior==$id_sup){
			$es_superior=true;
		}
	}
	return $es_superior;
}
/////////////////
function evaluador($id_sup,$id_sub,$ano){
	$query_usr="SELECT * FROM vcom_diccionarios_usuarios WHERE du_usr_id=".$id_sub." and du_responsable=".$id_sup." AND dic_ano=".$ano;
	$result_usr=mysql_query($query_usr) or die ("No se puede ejecutar la sentencia: ".$query_usr);
	$num_row = mysql_num_rows($result_usr);
	$es_evaluador=false;
	if($num_row>0){
		$es_evaluador=true;
	}
	
	return $es_evaluador;
}
////////////////////
function tiene_usuarios($oa_id){
	$query="SELECT * FROM dpo_lineas WHERE dl_oa_id=".$oa_id;
	$result=mysql_query($query) or die ("No se puede ejecutar la sentencia: ".$query);
	$num=mysql_num_rows($result);
	if($num){
		return true;
	}else{
		return false;
	}
}
function tiene_indicadores($obj_id){
	$query="SELECT * FROM objetivos_ano WHERE ind_obj_id=".$obj_id;
	$result=mysql_query($query) or die ("No se puede ejecutar la sentencia: ".$query);
	$num=mysql_num_rows($result);
	if($num){
		return true;
	}else{
		return false;
	}
}

function crear_log($pagina,$comentario){
	$ahora=date("Y-m-d H:i:s");
	$query_cr="INSERT INTO logs (log_usr,log_pagina,log_comentario,log_fecha) VALUES ('".utf8_decode($_SESSION["usr_nombre"]." ".$_SESSION["usr_apellidos"])."','".utf8_decode($pagina)."','".utf8_decode($comentario)."','".$ahora."')";
	$result_cr=mysql_query($query_cr) or die ("No se puede ejecutar la sentencia: ".$query_cr);
}
?>

