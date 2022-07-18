<?php
session_start();
require_once("../librerias/librerias.php");
require_once("../login/sesion_start.php");
$conn=db_connect();
require_once ("../librerias/phpexcel/PHPExcel.php");
$ano=$_SESSION['ano'];
$query="SELECT * FROM vdpo_cabeceras WHERE dpo_ano=".$ano;
if($_SESSION['usr_perfil']<>'Administrador' and $_SESSION['usr_perfil']<>'Director RRHH'){
	$query.=" AND (usr_superior_id=".$_SESSION['usr_id']." OR dpo_usr_id=".$_SESSION['usr_id'].")";
}
$query.=" ORDER BY dep_nombre ASC, usr_apellidos_sj ASC, usr_nombre_sj ASC, usr_apellidos ASC, usr_nombre ASC";
$result=mysql_query($query) or die ("No se puede ejecutar la sentencia: ".$query);
while($row=mysql_fetch_array($result)){
		$t1=0;
		$t2=0;
		$t3=0;
		$t4=0;
		$anual=0;
		$total=0;
		$query_lin="SELECT * FROM vdpo_lineas WHERE dl_dpo_id=".$row['dpo_id'].;
		$result_lin=mysql_query($query_lin) or die ("No se puede ejecutar la sentencia: ".$query_lin);
		echo $query_lin;
		while($row_lin=mysql_fetch_array($result_lin)){
			if($row_lin['dl_rdo_q1']<>''){
				$t1++;
			}
			if($row_lin['dl_rdo_q2']<>''){
				$t2++;
			}
			if($row_lin['dl_rdo_q3']<>''){
				$t3++;
			}
			if($row_lin['dl_rdo_q4']<>''){
				$t4++;
			}
			if($row_lin['dl_rdo_anual']<>''){
				$anual++;
			}
			$total++;
		}

echo $row['usr_apellidos']." ".$row['usr_nombre']."<br>";
echo $total."<br>";
echo number_format(($t1*100)/$total,2,',','.')."<br>";
echo number_format(($t2*100)/$total,2,',','.')."<br>";
echo number_format(($t3*100)/$total,2,',','.')."<br>";
echo number_format(($t4*100)/$total,2,',','.')."<br>";
echo number_format(($t5*100)/$total,2,',','.')."<br>";
}		
?>