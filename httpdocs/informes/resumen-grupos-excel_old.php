<?php
session_start();
require_once("../librerias/librerias.php");
require_once("../login/sesion_start.php");
$conn=db_connect();
foreach($_POST['usr_id'] as $valueSelected){
	$query="SELECT * FROM usuarios WHERE usr_id=".$valueSelected;
	$result=mysql_query($query) or die ("No se puede ejecutar la sentencia: ".$query);
	$row=mysql_fetch_array($result);
	echo $row['usr_apellidos'].", ".$row['usr_nombre'];
}

require_once ("../librerias/phpexcel/PHPExcel.php");
if (PHP_SAPI == 'cli')
	die('Este archivo solo se puede ver desde un navegador web');
// Se crea el objeto PHPExcel
ob_end_clean();
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("DPO Airfarm") //Autor
							 ->setLastModifiedBy("DPO Airfarm") //Ultimo usuario que lo modificó
							 ->setTitle("Resumen grupo")
							 ->setSubject("Resumen grupo")
							 ->setDescription("Resumen grupo")
							 ->setKeywords("Resumen grupo")
							 ->setCategory("Reporte excel");
$objPHPExcel->getDefaultStyle()->getFont()
    	->setName('Calibri')
    	->setSize(12);
$num_usr=0;
foreach($_POST['usr_id'] as $valueSelected){
	$num_usr++;
}
$tituloReporte = "Resumen grupo";
$borde_si=array(
	'borders' => array(
		'allborders' => array(
        	'style' => PHPExcel_Style_Border::BORDER_THIN
         )
     )
);
$celdasnegras = array(
	'font' => array(
    	'bold' => true,
		'color' => array(
			'rgb' => 'FFFFFF'
		),
	),
  'fill' => array(
  		'type'=> PHPExcel_Style_Fill::FILL_SOLID,
    	'color' => array(
			'rgb' => '000000'
		),
	),
);
$celdagris = array(
	'font' => array(
    	'bold' => true,
		'color' => array(
			'rgb' => 'FFFFFF'
		),
	),
  'fill' => array(
  		'type'=> PHPExcel_Style_Fill::FILL_SOLID,
    	'color' => array(
			'rgb' => '808080'
		),
	),
	'borders' => array(
		'allborders' => array(
        	'style' => PHPExcel_Style_Border::BORDER_NONE,
         )
     )
);
$celdaverde = array(
  'fill' => array(
  		'type'=> PHPExcel_Style_Fill::FILL_SOLID,
    	'color' => array(
			'rgb' => 'CCFFCC'
		),
	),
	'borders' => array(
		'allborders' => array(
        	'style' => PHPExcel_Style_Border::BORDER_THIN
         )
     ),
	 'alignment' => array(
	 	'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER
	),
);
$celdamarron = array(
  'fill' => array(
  		'type'=> PHPExcel_Style_Fill::FILL_SOLID,
    	'color' => array(
			'rgb' => 'DDD9C4'
		),
	),
	'borders' => array(
		'allborders' => array(
        	'style' => PHPExcel_Style_Border::BORDER_THIN
         )
     ),
	 'alignment' => array(
	 	'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER
	),
);
$celdaroja = array(
	'font' => array(
		'color' => array(
			'rgb' => 'FFFFFF'
		),
	),
  'fill' => array(
  		'type'=> PHPExcel_Style_Fill::FILL_SOLID,
    	'color' => array(
			'rgb' => 'FF0000'
		),
	),
	'borders' => array(
		'allborders' => array(
        	'style' => PHPExcel_Style_Border::BORDER_THIN
         )
     ),
	 'alignment' => array(
	 	'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER
	),
);
$normalcentrada = array(
	'borders' => array(
		'allborders' => array(
        	'style' => PHPExcel_Style_Border::BORDER_THIN
         )
     ),
	 'alignment' => array(
	 	'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER
	),
);
$normal = array(
	'borders' => array(
		'allborders' => array(
        	'style' => PHPExcel_Style_Border::BORDER_THIN
         )
     ),
);

$celdanegrita = array(
	'font' => array(
    	'bold' => true,
	),
);
$usuario=array();
$resumen=array();
unset ($usuario);
unset ($resumen);
$columnas=array('I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ','CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ');
// Se agregan los titulos del reporte
$n=0;
foreach($_POST['usr_id'] as $valueSelected){
	$query="SELECT * FROM usuarios WHERE usr_id=".$valueSelected;
	$result=mysql_query($query) or die ("No se puede ejecutar la sentencia: ".$query);
	$row=mysql_fetch_array($result);
	$objPHPExcel->setActiveSheetIndex(0)
    		    ->setCellValue($columnas[$n].'1',utf8_encode($row['usr_apellidos'].", ".$row['usr_nombre']));
	$objPHPExcel->getActiveSheet()->getStyle($columnas[$n].'1')->applyFromArray($celdanegrita);
	$objPHPExcel->getActiveSheet()->getStyle($columnas[$n].'1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$n++;
}
$n_usuarios=$n-1;
$query_oa="SELECT * FROM vobjetivos_ano WHERE oa_ano=".$_SESSION['ano']." ORDER BY obj_descripcion ASC";
$result_oa=mysql_query($query_oa) or die ("No se puede ejecutar la sentencia: ".$query_oa);
while($row_oa=mysql_fetch_array($result_oa)){
	foreach($_POST['usr_id'] as $valueSelected){
		$query_dl="SELECT * FROM vdpo_lineas WHERE dl_oa_id=".$row_oa['oa_id']." AND dpo_usr_id=".$valueSelected;
		$result_dl=mysql_query($query_dl) or die ("No se puede ejecutar la sentencia: ".$query_dl);
		$num_dl=mysql_num_rows($result_dl);
		if($num_dl){
		$row_dl=mysql_fetch_array($result_dl);
			$resumen[$row_oa['oa_id']]['peso'][$valueSelected]=$row_dl['dl_peso'];
			if(strncmp($row_oa['obj_tipo'],'Objetivo de compañia',7)==0){
					$usuario[$valueSelected]['compania']+=$row_dl['dl_peso'];
				}elseif(strncmp($row_oa['obj_tipo'],'Para el Comité de Dirección',4)==0 or $row_oa['obj_tipo']=='Mandos Intermedios'){
					$usuario[$valueSelected]['mandos']+=$row_dl['dl_peso'];
				}elseif($row_oa['obj_tipo']=='de departamento' or $row_oa['obj_tipo']=='Proyectos'){
					$usuario[$valueSelected]['departamento']+=$row_dl['dl_peso'];
				}elseif($row_oa['obj_tipo']=='Personal'){
					$usuario[$valueSelected]['personal']+=$row_dl['dl_peso'];
				}
			$usuario[$valueSelected]['total']+=$row_dl['dl_peso'];	
		}
	}
}
$fila=2;
$primero=true;
$query_oa="SELECT * FROM vobjetivos_ano WHERE obj_tipo LIKE '".utf8_decode('Objetivo de compañia')."' AND oa_ano=".$_SESSION['ano']." ORDER BY obj_descripcion ASC";
$result_oa=mysql_query($query_oa) or die ("No se puede ejecutar la sentencia: ".$query_oa);
while($row_oa=mysql_fetch_array($result_oa)){
	$tiene_usr=false;
	foreach($_POST['usr_id'] as $valueSelected){
		$query_dl="SELECT * FROM vdpo_lineas WHERE dl_oa_id=".$row_oa['oa_id']." AND dpo_usr_id=".$valueSelected;
		$result_dl=mysql_query($query_dl) or die ("No se puede ejecutar la sentencia: ".$query_dl);
		$num_dl=mysql_num_rows($result_dl);
		if($num_dl){
			$tiene_usr=true;
		}
	}
	if($tiene_usr){
		$query_ooe="SELECT * FROM vobjetivos_objetivos_estrategicos WHERE ooe_obj_id=".$row_oa['ind_obj_id']." ORDER BY oe_codigo";
		$result_ooe=mysql_query($query_ooe) or die ("No se puede ejecutar la sentencia: ".$query_ooe);
		$num_ooe=mysql_num_rows($result_ooe);
		$n=1;
		while($row_ooe=mysql_fetch_array($result_ooe)){
			$query_oe="SELECT * FROM objetivos_estrategicos WHERE oe_id=".$row_ooe['ooe_oe_id'];
			$result_oe=mysql_query($query_oe) or die ("No se puede ejecutar la sentencia: ".$query_oe);
			$row_oe=mysql_fetch_array($result_oe);
			$oe_codigo=$row_oe['oe_codigo'];
			if($n>0 and $n<$num_ooe){
				if($n==$num_ooe-1){
					$oe_codigo.="y";
				}else{
					$oe_codigo.=",";
				}
			}
			$n++;
		}
		$resumen[$row_oa['oa_id']]['oe_codigo']=$oe_codigo;
		
		if(strpos(utf8_encode($row_oa['obj_descripcion']),'<strong>')==0){
				$obj_descripcion=str_replace('<strong>','',utf8_encode($row_oa['obj_descripcion']));
				$obj_descripcion=str_replace('</strong>','',$obj_descripcion);
		}else{
			$obj_descripcion=utf8_encode($row_oa['obj_descripcion']);
		}
		$resumen[$row_oa['oa_id']]['obj_descripcion']=$obj_descripcion;
		$resumen[$row_oa['oa_id']]['ind_codigo']=$row_oa['ind_codigo'];
		$resumen[$row_oa['oa_id']]['ind_nombre']=utf8_encode($row_oa['ind_nombre']);
		$resumen[$row_oa['oa_id']]['oa_meta']=number_format($row_oa['oa_meta'],2,',','.');
		$resumen[$row_oa['oa_id']]['oa_horquilla_min']=number_format($row_oa['oa_horquilla_min'],2,',','.');
		$resumen[$row_oa['oa_id']]['oa_horquilla_max']=number_format($row_oa['oa_horquilla_max'],2,',','.');
		if($primero){
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$fila.':H'.$fila);
			$objPHPExcel->setActiveSheetIndex(0)
    			    	->setCellValue('A'.$fila,'A nivel de compañia');
   			$objPHPExcel->getActiveSheet()->getStyle('A'.$fila)->applyFromArray($celdasnegras);
			$n=0;
			foreach($_POST['usr_id'] as $valueSelected){
				$objPHPExcel->setActiveSheetIndex(0)
    			    		->setCellValue($columnas[$n].$fila,number_format($usuario[$valueSelected]['compania'],2,',','.'));
   				$objPHPExcel->getActiveSheet()->getStyle($columnas[$n].$fila)->applyFromArray($celdasnegras);
				$objPHPExcel->getActiveSheet()->getStyle($columnas[$n].$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$n++;
			}
			$fila++;
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('G'.$fila.':H'.$fila);
			$objPHPExcel->setActiveSheetIndex(0)
        			    ->setCellValue('A'.$fila,'Obj. Estrat.')
        			    ->setCellValue('B'.$fila,'Objetivo')
        			    ->setCellValue('C'.$fila,'Código Indicador')
        			    ->setCellValue('D'.$fila,'Indicador')
        			    ->setCellValue('E'.$fila,'Meta a alcanzar')
        			    ->setCellValue('F'.$fila,'')
        			    ->setCellValue('G'.$fila,'Horquilla');
			for($i=0;$i<=$n_usuarios;$i++){
       			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columnas[$i].$fila,'Peso');
				$objPHPExcel->getActiveSheet()->getStyle($columnas[$i].$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			}
			$objPHPExcel->getActiveSheet()->getStyle('F'.$fila)->applyFromArray($celdasnegras);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$fila.':E'.$fila)->applyFromArray($celdagris);
			$objPHPExcel->getActiveSheet()->getStyle('G'.$fila.':'.$columnas[$n-1].$fila)->applyFromArray($celdagris);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$fila.':G'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$fila++;
			$primero=false;
		}
		$objPHPExcel->setActiveSheetIndex(0)
	    	        ->setCellValue('A'.$fila,  $resumen[$row_oa['oa_id']]['oe_codigo']=$oe_codigo)
       			    ->setCellValue('B'.$fila,  $resumen[$row_oa['oa_id']]['obj_descripcion'])
       			    ->setCellValue('C'.$fila,  $resumen[$row_oa['oa_id']]['ind_codigo'])
       			    ->setCellValue('D'.$fila,  $resumen[$row_oa['oa_id']]['ind_nombre'])
       			    ->setCellValue('E'.$fila,  $resumen[$row_oa['oa_id']]['oa_meta'])
        		 	->setCellValue('F'.$fila,'')
       			    ->setCellValue('G'.$fila,  $resumen[$row_oa['oa_id']]['oa_horquilla_min'])
       			    ->setCellValue('H'.$fila,  $resumen[$row_oa['oa_id']]['oa_horquilla_max']);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$fila)->applyFromArray($normalcentrada);
		$objPHPExcel->getActiveSheet()->getStyle('B'.$fila)->applyFromArray($normal);
		$objPHPExcel->getActiveSheet()->getStyle('C'.$fila)->applyFromArray($normalcentrada);
		$objPHPExcel->getActiveSheet()->getStyle('D'.$fila)->applyFromArray($normal);
		$objPHPExcel->getActiveSheet()->getStyle('E'.$fila)->applyFromArray($celdaverde);
		$objPHPExcel->getActiveSheet()->getStyle('F'.$fila)->applyFromArray($celdasnegras);
		$objPHPExcel->getActiveSheet()->getStyle('G'.$fila.':H'.$fila)->applyFromArray($normalcentrada);
		$objPHPExcel->getActiveSheet()->getStyle('E'.$fila)->applyFromArray($celdaverde);
		$n=0;
		foreach($_POST['usr_id'] as $valueSelected){
			$peso='NO';
			if($resumen[$row_oa['oa_id']]['peso'][$valueSelected]){
				$peso=number_format($resumen[$row_oa['oa_id']]['peso'][$valueSelected],2,',','.');
				$objPHPExcel->getActiveSheet()->getStyle($columnas[$n].$fila)->applyFromArray($celdamarron);
			}else{
				$objPHPExcel->getActiveSheet()->getStyle($columnas[$n].$fila)->applyFromArray($celdaroja);
			}
			$objPHPExcel->setActiveSheetIndex(0)
    				    ->setCellValue($columnas[$n].$fila, $peso);
			$n++;
		}
		$fila++;
	}
}
$primero=true;
$query_oa="SELECT * FROM vobjetivos_ano WHERE (obj_tipo LIKE '".utf8_decode('Para el Comité de Dirección')."' OR obj_tipo LIKE 'Mandos Intermedios') AND oa_ano=".$_SESSION['ano']." ORDER BY obj_descripcion ASC";
$result_oa=mysql_query($query_oa) or die ("No se puede ejecutar la sentencia: ".$query_oa);
while($row_oa=mysql_fetch_array($result_oa)){
	$tiene_usr=false;
	foreach($_POST['usr_id'] as $valueSelected){
		$query_dl="SELECT * FROM vdpo_lineas WHERE dl_oa_id=".$row_oa['oa_id']." AND dpo_usr_id=".$valueSelected;
		$result_dl=mysql_query($query_dl) or die ("No se puede ejecutar la sentencia: ".$query_dl);
		$num_dl=mysql_num_rows($result_dl);
		if($num_dl){
			$tiene_usr=true;
		}
	}
	if($tiene_usr){
		$query_ooe="SELECT * FROM vobjetivos_objetivos_estrategicos WHERE ooe_obj_id=".$row_oa['ind_obj_id']." ORDER BY oe_codigo";
		$result_ooe=mysql_query($query_ooe) or die ("No se puede ejecutar la sentencia: ".$query_ooe);
		$num_ooe=mysql_num_rows($result_ooe);
		$n=1;
		while($row_ooe=mysql_fetch_array($result_ooe)){
			$query_oe="SELECT * FROM objetivos_estrategicos WHERE oe_id=".$row_ooe['ooe_oe_id'];
			$result_oe=mysql_query($query_oe) or die ("No se puede ejecutar la sentencia: ".$query_oe);
			$row_oe=mysql_fetch_array($result_oe);
			$oe_codigo=$row_oe['oe_codigo'];
			if($n>0 and $n<$num_ooe){
				if($n==$num_ooe-1){
					$oe_codigo.="y";
				}else{
					$oe_codigo.=",";
				}
			}
			$n++;
		}
		$resumen[$row_oa['oa_id']]['oe_codigo']=$oe_codigo;
		
		if(strpos(utf8_encode($row_oa['obj_descripcion']),'<strong>')==0){
				$obj_descripcion=str_replace('<strong>','',utf8_encode($row_oa['obj_descripcion']));
				$obj_descripcion=str_replace('</strong>','',$obj_descripcion);
		}else{
			$obj_descripcion=utf8_encode($row_oa['obj_descripcion']);
		}
		$resumen[$row_oa['oa_id']]['obj_descripcion']=$obj_descripcion;
		$resumen[$row_oa['oa_id']]['ind_codigo']=$row_oa['ind_codigo'];
		$resumen[$row_oa['oa_id']]['ind_nombre']=utf8_encode($row_oa['ind_nombre']);
		$resumen[$row_oa['oa_id']]['oa_meta']=number_format($row_oa['oa_meta'],2,',','.');
		$resumen[$row_oa['oa_id']]['oa_horquilla_min']=number_format($row_oa['oa_horquilla_min'],2,',','.');
		$resumen[$row_oa['oa_id']]['oa_horquilla_max']=number_format($row_oa['oa_horquilla_max'],2,',','.');
		if($primero){
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$fila.':H'.$fila);
			$objPHPExcel->setActiveSheetIndex(0)
    			    	->setCellValue(A.$fila,'Comite de dirección y mandos intermedios');
  			$objPHPExcel->getActiveSheet()->getStyle('A'.$fila)->applyFromArray($celdasnegras);
			$n=0;
			foreach($_POST['usr_id'] as $valueSelected){
				$objPHPExcel->setActiveSheetIndex(0)
    			    		->setCellValue($columnas[$n].$fila,number_format($usuario[$valueSelected]['mandos'],2,',','.'));
   				$objPHPExcel->getActiveSheet()->getStyle($columnas[$n].$fila)->applyFromArray($celdasnegras);
				$objPHPExcel->getActiveSheet()->getStyle($columnas[$n].$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$n++;
			}
			$fila++;
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('G'.$fila.':H'.$fila);
			$objPHPExcel->setActiveSheetIndex(0)
        			    ->setCellValue('A'.$fila,'Obj. Estrat.')
        			    ->setCellValue('B'.$fila,'Objetivo')
        			    ->setCellValue('C'.$fila,'Código Indicador')
        			    ->setCellValue('D'.$fila,'Indicador')
        			    ->setCellValue('E'.$fila,'Meta a alcanzar')
        			    ->setCellValue('F'.$fila,'')
        			    ->setCellValue('G'.$fila,'Horquilla');
			for($i=0;$i<=$n_usuarios;$i++){
       			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columnas[$i].$fila,'Peso');
				$objPHPExcel->getActiveSheet()->getStyle($columnas[$i].$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			}
			$objPHPExcel->getActiveSheet()->getStyle('F'.$fila)->applyFromArray($celdasnegras);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$fila.':E'.$fila)->applyFromArray($celdagris);
			$objPHPExcel->getActiveSheet()->getStyle('G'.$fila.':'.$columnas[$n-1].$fila)->applyFromArray($celdagris);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$fila.':G'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$fila++;
			$primero=false;
		}
		$objPHPExcel->setActiveSheetIndex(0)
	    	        ->setCellValue('A'.$fila,  $resumen[$row_oa['oa_id']]['oe_codigo']=$oe_codigo)
       			    ->setCellValue('B'.$fila,  $resumen[$row_oa['oa_id']]['obj_descripcion'])
       			    ->setCellValue('C'.$fila,  $resumen[$row_oa['oa_id']]['ind_codigo'])
       			    ->setCellValue('D'.$fila,  $resumen[$row_oa['oa_id']]['ind_nombre'])
       			    ->setCellValue('E'.$fila,  $resumen[$row_oa['oa_id']]['oa_meta'])
        		 	->setCellValue('F'.$fila,'')
       			    ->setCellValue('G'.$fila,  $resumen[$row_oa['oa_id']]['oa_horquilla_min'])
       			    ->setCellValue('H'.$fila,  $resumen[$row_oa['oa_id']]['oa_horquilla_max']);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$fila)->applyFromArray($normalcentrada);
		$objPHPExcel->getActiveSheet()->getStyle('B'.$fila)->applyFromArray($normal);
		$objPHPExcel->getActiveSheet()->getStyle('C'.$fila)->applyFromArray($normalcentrada);
		$objPHPExcel->getActiveSheet()->getStyle('D'.$fila)->applyFromArray($normal);
		$objPHPExcel->getActiveSheet()->getStyle('E'.$fila)->applyFromArray($celdaverde);
		$objPHPExcel->getActiveSheet()->getStyle('F'.$fila)->applyFromArray($celdasnegras);
		$objPHPExcel->getActiveSheet()->getStyle('G'.$fila.':H'.$fila)->applyFromArray($normalcentrada);
		$objPHPExcel->getActiveSheet()->getStyle('E'.$fila)->applyFromArray($celdaverde);
		$n=0;
		foreach($_POST['usr_id'] as $valueSelected){
			$peso='NO';
			if($resumen[$row_oa['oa_id']]['peso'][$valueSelected]){
				$peso=number_format($resumen[$row_oa['oa_id']]['peso'][$valueSelected],2,',','.');
				$objPHPExcel->getActiveSheet()->getStyle($columnas[$n].$fila)->applyFromArray($celdamarron);
			}else{
				$objPHPExcel->getActiveSheet()->getStyle($columnas[$n].$fila)->applyFromArray($celdaroja);
			}
			$objPHPExcel->setActiveSheetIndex(0)
    				    ->setCellValue($columnas[$n].$fila, $peso);
			$n++;
		}
		$fila++;
	}
}
$primero=true;
$query_oa="SELECT * FROM vobjetivos_ano WHERE (obj_tipo LIKE '".utf8_decode('de departamento')."' OR obj_tipo LIKE '".utf8_decode('Proyectos')."') AND oa_ano=".$_SESSION['ano']." ORDER BY obj_descripcion ASC";
$result_oa=mysql_query($query_oa) or die ("No se puede ejecutar la sentencia: ".$query_oa);
while($row_oa=mysql_fetch_array($result_oa)){
	$tiene_usr=false;
	foreach($_POST['usr_id'] as $valueSelected){
		$query_dl="SELECT * FROM vdpo_lineas WHERE dl_oa_id=".$row_oa['oa_id']." AND dpo_usr_id=".$valueSelected;
		$result_dl=mysql_query($query_dl) or die ("No se puede ejecutar la sentencia: ".$query_dl);
		$num_dl=mysql_num_rows($result_dl);
		if($num_dl){
			$tiene_usr=true;
		}
	}
	if($tiene_usr){
		$query_ooe="SELECT * FROM vobjetivos_objetivos_estrategicos WHERE ooe_obj_id=".$row_oa['ind_obj_id']." ORDER BY oe_codigo";
		$result_ooe=mysql_query($query_ooe) or die ("No se puede ejecutar la sentencia: ".$query_ooe);
		$num_ooe=mysql_num_rows($result_ooe);
		$n=1;
		while($row_ooe=mysql_fetch_array($result_ooe)){
			$query_oe="SELECT * FROM objetivos_estrategicos WHERE oe_id=".$row_ooe['ooe_oe_id'];
			$result_oe=mysql_query($query_oe) or die ("No se puede ejecutar la sentencia: ".$query_oe);
			$row_oe=mysql_fetch_array($result_oe);
			$oe_codigo=$row_oe['oe_codigo'];
			if($n>0 and $n<$num_ooe){
				if($n==$num_ooe-1){
					$oe_codigo.="y";
				}else{
					$oe_codigo.=",";
				}
			}
			$n++;
		}
		$resumen[$row_oa['oa_id']]['oe_codigo']=$oe_codigo;
		
		if(strpos(utf8_encode($row_oa['obj_descripcion']),'<strong>')==0){
				$obj_descripcion=str_replace('<strong>','',utf8_encode($row_oa['obj_descripcion']));
				$obj_descripcion=str_replace('</strong>','',$obj_descripcion);
		}else{
			$obj_descripcion=utf8_encode($row_oa['obj_descripcion']);
		}
		$resumen[$row_oa['oa_id']]['obj_descripcion']=$obj_descripcion;
		$resumen[$row_oa['oa_id']]['ind_codigo']=$row_oa['ind_codigo'];
		$resumen[$row_oa['oa_id']]['ind_nombre']=utf8_encode($row_oa['ind_nombre']);
		$resumen[$row_oa['oa_id']]['oa_meta']=number_format($row_oa['oa_meta'],2,',','.');
		$resumen[$row_oa['oa_id']]['oa_horquilla_min']=number_format($row_oa['oa_horquilla_min'],2,',','.');
		$resumen[$row_oa['oa_id']]['oa_horquilla_max']=number_format($row_oa['oa_horquilla_max'],2,',','.');
		if($primero){
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$fila.':H'.$fila);
			$objPHPExcel->setActiveSheetIndex(0)
    			    	->setCellValue(A.$fila,'De departamento');
  			$objPHPExcel->getActiveSheet()->getStyle('A'.$fila)->applyFromArray($celdasnegras);
			$n=0;
			foreach($_POST['usr_id'] as $valueSelected){
				$objPHPExcel->setActiveSheetIndex(0)
    			    		->setCellValue($columnas[$n].$fila,number_format($usuario[$valueSelected]['departamento'],2,',','.'));
   				$objPHPExcel->getActiveSheet()->getStyle($columnas[$n].$fila)->applyFromArray($celdasnegras);
				$objPHPExcel->getActiveSheet()->getStyle($columnas[$n].$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$n++;
			}
			$fila++;
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('G'.$fila.':H'.$fila);
			$objPHPExcel->setActiveSheetIndex(0)
        			    ->setCellValue('A'.$fila,'Obj. Estrat.')
        			    ->setCellValue('B'.$fila,'Objetivo')
        			    ->setCellValue('C'.$fila,'Código Indicador')
        			    ->setCellValue('D'.$fila,'Indicador')
        			    ->setCellValue('E'.$fila,'Meta a alcanzar')
        			    ->setCellValue('F'.$fila,'')
        			    ->setCellValue('G'.$fila,'Horquilla');
			for($i=0;$i<=$n_usuarios;$i++){
       			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columnas[$i].$fila,'Peso');
				$objPHPExcel->getActiveSheet()->getStyle($columnas[$i].$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			}
			$objPHPExcel->getActiveSheet()->getStyle('F'.$fila)->applyFromArray($celdasnegras);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$fila.':E'.$fila)->applyFromArray($celdagris);
			$objPHPExcel->getActiveSheet()->getStyle('G'.$fila.':'.$columnas[$n-1].$fila)->applyFromArray($celdagris);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$fila.':G'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$fila++;
			$primero=false;
		}
		$objPHPExcel->setActiveSheetIndex(0)
	    	        ->setCellValue('A'.$fila,  $resumen[$row_oa['oa_id']]['oe_codigo']=$oe_codigo)
       			    ->setCellValue('B'.$fila,  $resumen[$row_oa['oa_id']]['obj_descripcion'])
       			    ->setCellValue('C'.$fila,  $resumen[$row_oa['oa_id']]['ind_codigo'])
       			    ->setCellValue('D'.$fila,  $resumen[$row_oa['oa_id']]['ind_nombre'])
       			    ->setCellValue('E'.$fila,  $resumen[$row_oa['oa_id']]['oa_meta'])
        		 	->setCellValue('F'.$fila,'')
       			    ->setCellValue('G'.$fila,  $resumen[$row_oa['oa_id']]['oa_horquilla_min'])
       			    ->setCellValue('H'.$fila,  $resumen[$row_oa['oa_id']]['oa_horquilla_max']);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$fila)->applyFromArray($normalcentrada);
		$objPHPExcel->getActiveSheet()->getStyle('B'.$fila)->applyFromArray($normal);
		$objPHPExcel->getActiveSheet()->getStyle('C'.$fila)->applyFromArray($normalcentrada);
		$objPHPExcel->getActiveSheet()->getStyle('D'.$fila)->applyFromArray($normal);
		$objPHPExcel->getActiveSheet()->getStyle('E'.$fila)->applyFromArray($celdaverde);
		$objPHPExcel->getActiveSheet()->getStyle('F'.$fila)->applyFromArray($celdasnegras);
		$objPHPExcel->getActiveSheet()->getStyle('G'.$fila.':H'.$fila)->applyFromArray($normalcentrada);
		$objPHPExcel->getActiveSheet()->getStyle('E'.$fila)->applyFromArray($celdaverde);
		$n=0;
		foreach($_POST['usr_id'] as $valueSelected){
			$peso='NO';
			if($resumen[$row_oa['oa_id']]['peso'][$valueSelected]){
				$peso=number_format($resumen[$row_oa['oa_id']]['peso'][$valueSelected],2,',','.');
				$objPHPExcel->getActiveSheet()->getStyle($columnas[$n].$fila)->applyFromArray($celdamarron);
			}else{
				$objPHPExcel->getActiveSheet()->getStyle($columnas[$n].$fila)->applyFromArray($celdaroja);
			}
			$objPHPExcel->setActiveSheetIndex(0)
    				    ->setCellValue($columnas[$n].$fila, $peso);
			$n++;
		}
		$fila++;
	}
}
$primero=true;
$query_oa="SELECT * FROM vobjetivos_ano WHERE obj_tipo LIKE '".utf8_decode('Personal')."' AND oa_ano=".$_SESSION['ano']." ORDER BY obj_descripcion ASC";
$result_oa=mysql_query($query_oa) or die ("No se puede ejecutar la sentencia: ".$query_oa);
while($row_oa=mysql_fetch_array($result_oa)){
	$tiene_usr=false;
	foreach($_POST['usr_id'] as $valueSelected){
		$query_dl="SELECT * FROM vdpo_lineas WHERE dl_oa_id=".$row_oa['oa_id']." AND dpo_usr_id=".$valueSelected;
		$result_dl=mysql_query($query_dl) or die ("No se puede ejecutar la sentencia: ".$query_dl);
		$num_dl=mysql_num_rows($result_dl);
		if($num_dl){
			$tiene_usr=true;
		}
	}
	if($tiene_usr){
		$query_ooe="SELECT * FROM vobjetivos_objetivos_estrategicos WHERE ooe_obj_id=".$row_oa['ind_obj_id']." ORDER BY oe_codigo";
		$result_ooe=mysql_query($query_ooe) or die ("No se puede ejecutar la sentencia: ".$query_ooe);
		$num_ooe=mysql_num_rows($result_ooe);
		$n=1;
		while($row_ooe=mysql_fetch_array($result_ooe)){
			$query_oe="SELECT * FROM objetivos_estrategicos WHERE oe_id=".$row_ooe['ooe_oe_id'];
			$result_oe=mysql_query($query_oe) or die ("No se puede ejecutar la sentencia: ".$query_oe);
			$row_oe=mysql_fetch_array($result_oe);
			$oe_codigo=$row_oe['oe_codigo'];
			if($n>0 and $n<$num_ooe){
				if($n==$num_ooe-1){
					$oe_codigo.="y";
				}else{
					$oe_codigo.=",";
				}
			}
			$n++;
		}
		$resumen[$row_oa['oa_id']]['oe_codigo']=$oe_codigo;
		
		if(strpos($row_oa['obj_descripcion'],'<strong>')==0){
				$obj_descripcion=str_replace('<strong>','',utf8_encode($row_oa['obj_descripcion']));
				$obj_descripcion=str_replace('</strong>','',$obj_descripcion);
		}else{
			$obj_descripcion=utf8_encode($row_oa['obj_descripcion']);
		}
		$resumen[$row_oa['oa_id']]['obj_descripcion']=$obj_descripcion;
		$resumen[$row_oa['oa_id']]['ind_codigo']=$row_oa['ind_codigo'];
		$resumen[$row_oa['oa_id']]['ind_nombre']=utf8_encode($row_oa['ind_nombre']);
		$resumen[$row_oa['oa_id']]['oa_meta']=number_format($row_oa['oa_meta'],2,',','.');
		$resumen[$row_oa['oa_id']]['oa_horquilla_min']=number_format($row_oa['oa_horquilla_min'],2,',','.');
		$resumen[$row_oa['oa_id']]['oa_horquilla_max']=number_format($row_oa['oa_horquilla_max'],2,',','.');
		if($primero){
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$fila.':H'.$fila);
			$objPHPExcel->setActiveSheetIndex(0)
    			    	->setCellValue(A.$fila,'Personal');
   			$objPHPExcel->getActiveSheet()->getStyle('A'.$fila)->applyFromArray($celdasnegras);
			$n=0;
			foreach($_POST['usr_id'] as $valueSelected){
				$objPHPExcel->setActiveSheetIndex(0)
    			    		->setCellValue($columnas[$n].$fila,number_format($usuario[$valueSelected]['personal'],2,',','.'));
   				$objPHPExcel->getActiveSheet()->getStyle($columnas[$n].$fila)->applyFromArray($celdasnegras);
				$objPHPExcel->getActiveSheet()->getStyle($columnas[$n].$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$n++;
			}
			$fila++;
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('G'.$fila.':H'.$fila);
			$objPHPExcel->setActiveSheetIndex(0)
        			    ->setCellValue('A'.$fila,'Obj. Estrat.')
        			    ->setCellValue('B'.$fila,'Objetivo')
        			    ->setCellValue('C'.$fila,'Código Indicador')
        			    ->setCellValue('D'.$fila,'Indicador')
        			    ->setCellValue('E'.$fila,'Meta a alcanzar')
        			    ->setCellValue('F'.$fila,'')
        			    ->setCellValue('G'.$fila,'Horquilla');
			for($i=0;$i<=$n_usuarios;$i++){
       			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columnas[$i].$fila,'Peso');
				$objPHPExcel->getActiveSheet()->getStyle($columnas[$i].$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			}
			$objPHPExcel->getActiveSheet()->getStyle('F'.$fila)->applyFromArray($celdasnegras);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$fila.':E'.$fila)->applyFromArray($celdagris);
			$objPHPExcel->getActiveSheet()->getStyle('G'.$fila.':'.$columnas[$n-1].$fila)->applyFromArray($celdagris);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$fila.':G'.$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$fila++;
			$primero=false;
		}
		$objPHPExcel->setActiveSheetIndex(0)
	    	        ->setCellValue('A'.$fila,  $resumen[$row_oa['oa_id']]['oe_codigo']=$oe_codigo)
       			    ->setCellValue('B'.$fila,  $resumen[$row_oa['oa_id']]['obj_descripcion'])
       			    ->setCellValue('C'.$fila,  $resumen[$row_oa['oa_id']]['ind_codigo'])
       			    ->setCellValue('D'.$fila,  $resumen[$row_oa['oa_id']]['ind_nombre'])
       			    ->setCellValue('E'.$fila,  $resumen[$row_oa['oa_id']]['oa_meta'])
        		 	->setCellValue('F'.$fila,'')
       			    ->setCellValue('G'.$fila,  $resumen[$row_oa['oa_id']]['oa_horquilla_min'])
       			    ->setCellValue('H'.$fila,  $resumen[$row_oa['oa_id']]['oa_horquilla_max']);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$fila)->applyFromArray($normalcentrada);
		$objPHPExcel->getActiveSheet()->getStyle('B'.$fila)->applyFromArray($normal);
		$objPHPExcel->getActiveSheet()->getStyle('C'.$fila)->applyFromArray($normalcentrada);
		$objPHPExcel->getActiveSheet()->getStyle('D'.$fila)->applyFromArray($normal);
		$objPHPExcel->getActiveSheet()->getStyle('E'.$fila)->applyFromArray($celdaverde);
		$objPHPExcel->getActiveSheet()->getStyle('F'.$fila)->applyFromArray($celdasnegras);
		$objPHPExcel->getActiveSheet()->getStyle('G'.$fila.':H'.$fila)->applyFromArray($normalcentrada);
		$objPHPExcel->getActiveSheet()->getStyle('E'.$fila)->applyFromArray($celdaverde);
		$n=0;
		foreach($_POST['usr_id'] as $valueSelected){
			$peso='NO';
			if($resumen[$row_oa['oa_id']]['peso'][$valueSelected]){
				$peso=number_format($resumen[$row_oa['oa_id']]['peso'][$valueSelected],2,',','.');
				$objPHPExcel->getActiveSheet()->getStyle($columnas[$n].$fila)->applyFromArray($celdamarron);
			}else{
				$objPHPExcel->getActiveSheet()->getStyle($columnas[$n].$fila)->applyFromArray($celdaroja);
			}
			$objPHPExcel->setActiveSheetIndex(0)
    				    ->setCellValue($columnas[$n].$fila, $peso);
			$n++;
		}
		$fila++;
	}
}
$objPHPExcel->setActiveSheetIndex(0)
	    	->setCellValue(A.$fila,'Total');
$n=0;
foreach($_POST['usr_id'] as $valueSelected){
	$objPHPExcel->setActiveSheetIndex(0)
	    		->setCellValue($columnas[$n].$fila,number_format($usuario[$valueSelected]['total'],2,',','.'));
	$objPHPExcel->getActiveSheet()->getColumnDimension($columnas[$n])->setWidth(12);
	$objPHPExcel->getActiveSheet()->getStyle($columnas[$n].$fila)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$n++;
}
$objPHPExcel->getActiveSheet()->getStyle('A'.$fila.':'.$columnas[$n-1].$fila)->applyFromArray($celdasnegras);
$objPHPExcel->getActiveSheet()->getStyle('A1:'.$columnas[$n-1].$fila)->getAlignment()->setWrapText(true‌​);
$objPHPExcel->getActiveSheet()->getStyle('A1:'.$columnas[$n-1].$fila)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A1:'.$columnas[$n-1].$fila)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(7);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(65);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(65);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(2);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(12);
     
// Se asigna el nombre a la hoja
$objPHPExcel->getActiveSheet()->setTitle('Usuarios');
// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
$objPHPExcel->setActiveSheetIndex(0);
// Inmovilizar paneles 
//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
//$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);
// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="dpo.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;

?>