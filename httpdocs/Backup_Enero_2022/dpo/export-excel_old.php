<?php
session_start();
require_once("../librerias/librerias.php");
require_once("../login/sesion_start.php");
$conn=db_connect();
require_once ("../librerias/phpexcel/PHPExcel.php");
$dpo_id=$_GET['dpo_id'];
$query="SELECT * FROM vdpo_cabeceras WHERE dpo_id=".$dpo_id;
$result=mysql_query($query) or die ("No se puede ejecutar la sentencia: ".$query);
$row=mysql_fetch_array($result);
$query_lin="SELECT * FROM vdpo_lineas WHERE dl_dpo_id=".$row['dpo_id'];
$result_lin=mysql_query($query_lin) or die ("No se puede ejecutar la sentencia: ".$query_lin);
while($row_lin=mysql_fetch_array($result_lin)){
	$peso[$row_lin['obj_tipo']]+=$row_lin['dl_peso'];
	$peso['total']+=$row_lin['dl_peso'];
}
$nombre=utf8_encode($row['usr_nombre']).' '.utf8_encode($row['usr_apellidos']).' ('.$row['dpo_ano'].')';
if (PHP_SAPI == 'cli')
die('Este archivo solo se puede ver desde un navegador web');
// Se crea el objeto PHPExcel
ob_end_clean();
$objPHPExcel = new PHPExcel();
// Se asignan las propiedades del libro
$objPHPExcel->getProperties()->setCreator("DPO Airfarm") //Autor
							 ->setLastModifiedBy("DPO Airfarm") //Ultimo usuario que lo modificó
							 ->setTitle("DPO de".$nombre)
							 ->setSubject("DPO de".$nombre)
							 ->setDescription("DPO de".$nombre)
							 ->setKeywords("DPO de".$nombre)
							 ->setCategory("Reporte excel");

		$tituloReporte = "DPO de".$nombre;
		$titulosColumnas = array('Tipo', 'OE', 'Objetivo', 'C.I.', 'Indicador', 'Meta', 'Meta Un.', 'Horq. Max.', 'Horq. Min.', 'Horq. Un.', 'Peso');
		
/*		$objPHPExcel->setActiveSheetIndex(0)
        		    ->mergeCells('A1:I1');
*/						
		// Se agregan los titulos del reporte
		$objPHPExcel->setActiveSheetIndex(0)
        		    ->setCellValue('A1',  $tituloReporte)
		            ->setCellValue('A2',  $titulosColumnas[0])
		            ->setCellValue('B2',  $titulosColumnas[1])
        		    ->setCellValue('C2',  $titulosColumnas[2])
            		->setCellValue('D2',  $titulosColumnas[3])
					->setCellValue('E2',  $titulosColumnas[4])
					->setCellValue('F2',  $titulosColumnas[5])
					->setCellValue('G2',  $titulosColumnas[6])
					->setCellValue('H2',  $titulosColumnas[7])
					->setCellValue('I2',  $titulosColumnas[8])
					->setCellValue('J2',  $titulosColumnas[9])
					->setCellValue('K2',  $titulosColumnas[10]);
		
		//Se agregan los datos de los alumnos
		$i = 3;
		$query_lin="SELECT * FROM vdpo_lineas WHERE dl_dpo_id=".$dpo_id." AND obj_tipo LIKE '".utf8_decode('Objetivo de compañia')."' ORDER BY dl_peso DESC, obj_descripcion ASC";
		$result_lin=mysql_query($query_lin) or die ("No se puede ejecutar la sentencia: ".$query_lin);
		$num_lin=mysql_num_rows($result_lin);
		while($row_lin=mysql_fetch_array($result_lin)){
			$query_ooe="SELECT * FROM vobjetivos_objetivos_estrategicos WHERE ooe_obj_id=".$row_lin['ind_obj_id']." ORDER BY oe_codigo";
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
			if(strpos($row_lin['obj_descripcion'],'<strong>')==0){
				$obj_descripcion=str_replace('<strong>','',$row_lin['obj_descripcion']);
				$obj_descripcion=str_replace('</strong>','',$obj_descripcion);
			}else{
				$obj_descripcion=$row_lin['obj_descripcion'];
			}
			if($row_lin['ind_meta_un_abreviatura']=='&euro;'){
				$ind_meta_un_abreviatura='€';
			}else{
				$ind_meta_un_abreviatura=$row_lin['ind_meta_un_abreviatura'];
			}
			if($row_lin['ind_horq_un_abreviatura']=='&euro;'){
				$ind_horq_un_abreviatura='€';
			}else{
				$ind_horq_un_abreviatura=$row_lin['ind_horq_un_abreviatura'];
			}
			$objPHPExcel->setActiveSheetIndex(0)
        		    ->setCellValue('A'.$i,  'A nivel de compañia')
		            ->setCellValue('B'.$i,  $oe_codigo)
        		    ->setCellValue('C'.$i,  utf8_encode($obj_descripcion))
        		    ->setCellValue('D'.$i,  $row_lin['ind_codigo'])
        		    ->setCellValue('E'.$i,  utf8_encode($row_lin['ind_nombre']))
        		    ->setCellValue('F'.$i,  number_format($row_lin['oa_meta'],2,',','.'))
        		    ->setCellValue('G'.$i,  utf8_encode($ind_meta_un_abreviatura))
        		    ->setCellValue('H'.$i,  number_format($row_lin['oa_horquilla_min'],2,',','.'))
        		    ->setCellValue('I'.$i,  number_format($row_lin['oa_horquilla_max'],2,',','.'))
					->setCellValue('J'.$i,  utf8_encode($ind_horq_un_abreviatura))
					->setCellValue('K'.$i,  number_format($row_lin['dl_peso'],2,',','.'));
					$i++;
		}
		$query_lin="SELECT * FROM vdpo_lineas WHERE dl_dpo_id=".$row['dpo_id']." AND (obj_tipo LIKE 'Para el Comité de Dirección' OR obj_tipo LIKE 'Mandos Intermedios') ORDER BY dl_peso DESC, obj_descripcion ASC";
		$result_lin=mysql_query($query_lin) or die ("No se puede ejecutar la sentencia: ".$query_lin);
		$num_lin=mysql_num_rows($result_lin);
		while($row_lin=mysql_fetch_array($result_lin)){
			if($row['usr_categoria']==utf8_decode('Dirección')){
          		$tipo="A nivel de comité de dirección";
           	}else{
          		$tipo="A nivel de Mandos Intermedios";
          	}
			$query_ooe="SELECT * FROM vobjetivos_objetivos_estrategicos WHERE ooe_obj_id=".$row_lin['ind_obj_id']." ORDER BY oe_codigo";
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
			if(strpos($row_lin['obj_descripcion'],'<strong>')==0){
				$obj_descripcion=str_replace('<strong>','',$row_lin['obj_descripcion']);
				$obj_descripcion=str_replace('</strong>','',$obj_descripcion);
			}else{
				$obj_descripcion=$row_lin['obj_descripcion'];
			}
			if($row_lin['ind_meta_un_abreviatura']=='&euro;'){
				$ind_meta_un_abreviatura='€';
			}else{
				$ind_meta_un_abreviatura=$row_lin['ind_meta_un_abreviatura'];
			}
			if($row_lin['ind_horq_un_abreviatura']=='&euro;'){
				$ind_horq_un_abreviatura='€';
			}else{
				$ind_horq_un_abreviatura=$row_lin['ind_horq_un_abreviatura'];
			}
			$objPHPExcel->setActiveSheetIndex(0)
        		    ->setCellValue('A'.$i,  $tipo)
		            ->setCellValue('B'.$i,  $oe_codigo)
        		    ->setCellValue('C'.$i,  utf8_encode($obj_descripcion))
        		    ->setCellValue('D'.$i,  $row_lin['ind_codigo'])
        		    ->setCellValue('E'.$i,  utf8_encode($row_lin['ind_nombre']))
        		    ->setCellValue('F'.$i,  number_format($row_lin['oa_meta'],2,',','.'))
        		    ->setCellValue('G'.$i,  utf8_encode($ind_meta_un_abreviatura))
        		    ->setCellValue('H'.$i,  number_format($row_lin['oa_horquilla_min'],2,',','.'))
        		    ->setCellValue('I'.$i,  number_format($row_lin['oa_horquilla_max'],2,',','.'))
					->setCellValue('J'.$i,  utf8_encode($ind_horq_un_abreviatura))
					->setCellValue('K'.$i,  number_format($row_lin['dl_peso'],2,',','.'));
					$i++;
		}
		$query_lin="SELECT * FROM vdpo_lineas WHERE dl_dpo_id=".$row['dpo_id']." AND (obj_tipo LIKE '".utf8_decode('de departamento')."' OR obj_tipo LIKE '".utf8_decode('Proyectos')."') ORDER BY dl_peso DESC, obj_descripcion ASC";
		$result_lin=mysql_query($query_lin) or die ("No se puede ejecutar la sentencia: ".$query_lin);
		$num_lin=mysql_num_rows($result_lin);
		while($row_lin=mysql_fetch_array($result_lin)){
			$query_ooe="SELECT * FROM vobjetivos_objetivos_estrategicos WHERE ooe_obj_id=".$row_lin['ind_obj_id']." ORDER BY oe_codigo";
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
			if(strpos($row_lin['obj_descripcion'],'<strong>')==0){
				$obj_descripcion=str_replace('<strong>','',$row_lin['obj_descripcion']);
				$obj_descripcion=str_replace('</strong>','',$obj_descripcion);
			}else{
				$obj_descripcion=$row_lin['obj_descripcion'];
			}
			if($row_lin['ind_meta_un_abreviatura']=='&euro;'){
				$ind_meta_un_abreviatura='€';
			}else{
				$ind_meta_un_abreviatura=$row_lin['ind_meta_un_abreviatura'];
			}
			if($row_lin['ind_horq_un_abreviatura']=='&euro;'){
				$ind_horq_un_abreviatura='€';
			}else{
				$ind_horq_un_abreviatura=$row_lin['ind_horq_un_abreviatura'];
			}
			$objPHPExcel->setActiveSheetIndex(0)
        		    ->setCellValue('A'.$i,  'A nivel Departamental')
		            ->setCellValue('B'.$i,  $oe_codigo)
        		    ->setCellValue('C'.$i,  utf8_encode($obj_descripcion))
        		    ->setCellValue('D'.$i,  $row_lin['ind_codigo'])
        		    ->setCellValue('E'.$i,  utf8_encode($row_lin['ind_nombre']))
        		    ->setCellValue('F'.$i,  number_format($row_lin['oa_meta'],2,',','.'))
        		    ->setCellValue('G'.$i,  utf8_encode($ind_meta_un_abreviatura))
        		    ->setCellValue('H'.$i,  number_format($row_lin['oa_horquilla_min'],2,',','.'))
        		    ->setCellValue('I'.$i,  number_format($row_lin['oa_horquilla_max'],2,',','.'))
					->setCellValue('J'.$i,  utf8_encode($ind_horq_un_abreviatura))
					->setCellValue('K'.$i,  number_format($row_lin['dl_peso'],2,',','.'));
					$i++;
		}
		$query_lin="SELECT * FROM vdpo_lineas WHERE dl_dpo_id=".$row['dpo_id']." AND obj_tipo LIKE '".utf8_decode('Personal')."' ORDER BY dl_peso DESC, obj_descripcion ASC";
		$result_lin=mysql_query($query_lin) or die ("No se puede ejecutar la sentencia: ".$query_lin);
		$num_lin=mysql_num_rows($result_lin);
		while($row_lin=mysql_fetch_array($result_lin)){
			$query_ooe="SELECT * FROM vobjetivos_objetivos_estrategicos WHERE ooe_obj_id=".$row_lin['ind_obj_id']." ORDER BY oe_codigo";
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
			if(strpos($row_lin['obj_descripcion'],'<strong>')==0){
				$obj_descripcion=str_replace('<strong>','',$row_lin['obj_descripcion']);
				$obj_descripcion=str_replace('</strong>','',$obj_descripcion);
			}else{
				$obj_descripcion=$row_lin['obj_descripcion'];
			}
			if($row_lin['ind_meta_un_abreviatura']=='&euro;'){
				$ind_meta_un_abreviatura='€';
			}else{
				$ind_meta_un_abreviatura=$row_lin['ind_meta_un_abreviatura'];
			}
			if($row_lin['ind_horq_un_abreviatura']=='&euro;'){
				$ind_horq_un_abreviatura='€';
			}else{
				$ind_horq_un_abreviatura=$row_lin['ind_horq_un_abreviatura'];
			}
			$objPHPExcel->setActiveSheetIndex(0)
        		    ->setCellValue('A'.$i,  'A nivel Personal')
		            ->setCellValue('B'.$i,  $oe_codigo)
        		    ->setCellValue('C'.$i,  utf8_encode($obj_descripcion))
        		    ->setCellValue('D'.$i,  $row_lin['ind_codigo'])
        		    ->setCellValue('E'.$i,  utf8_encode($row_lin['ind_nombre']))
        		    ->setCellValue('F'.$i,  number_format($row_lin['oa_meta'],2,',','.'))
        		    ->setCellValue('G'.$i,  utf8_encode($ind_meta_un_abreviatura))
        		    ->setCellValue('H'.$i,  number_format($row_lin['oa_horquilla_min'],2,',','.'))
        		    ->setCellValue('I'.$i,  number_format($row_lin['oa_horquilla_max'],2,',','.'))
					->setCellValue('J'.$i,  utf8_encode($ind_horq_un_abreviatura))
					->setCellValue('K'.$i,  number_format($row_lin['dl_peso'],2,',','.'));
					$i++;
		}
		
/*		$estiloTituloReporte = array(
        	'font' => array(
	        	'name'      => 'Verdana',
    	        'bold'      => true,
        	    'italic'    => false,
                'strike'    => false,
               	'size' =>16,
	            	'color'     => array(
    	            	'rgb' => 'FFFFFF'
        	       	)
            ),
	        'fill' => array(
				'type'	=> PHPExcel_Style_Fill::FILL_SOLID,
				'color'	=> array('argb' => 'FF220835')
			),
            'borders' => array(
               	'allborders' => array(
                	'style' => PHPExcel_Style_Border::BORDER_NONE                    
               	)
            ), 
            'alignment' =>  array(
        			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        			'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        			'rotation'   => 0,
        			'wrap'          => TRUE
    		)
        );

		$estiloTituloColumnas = array(
            'font' => array(
                'name'      => 'Arial',
                'bold'      => true,                          
                'color'     => array(
                    'rgb' => '000000'
                )
            ),
            'fill' 	=> array(
				'type'		=> PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
				'rotation'   => 90,
        		'startcolor' => array(
            		'rgb' => 'FFFFFF'
        		),
        		'endcolor'   => array(
            		'argb' => 'FFFFFF'
        		)
			),
            'borders' => array(
            	'top'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                    'color' => array(
                        'rgb' => '000000'
                    )
                ),
                'bottom'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                    'color' => array(
                        'rgb' => '000000'
                    )
                )
            ),
			'alignment' =>  array(
        			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        			'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        			'wrap'          => TRUE
    		));*/
			
		$estiloInformacion = new PHPExcel_Style();
		$estiloInformacion->applyFromArray(
			array(
           		'font' => array(
               	'name'      => 'Arial',               
               	'color'     => array(
                   	'rgb' => '000000'
               	)
           	),
           	'fill' 	=> array(
				'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
				'color'		=> array('argb' => 'FFFFFF')
			),
           	'borders' => array(
               	'left'     => array(
                   	'style' => PHPExcel_Style_Border::BORDER_THIN ,
	                'color' => array(
    	            	'rgb' => '000'
                   	)
               	)             
           	)
        ));
		 
		/*$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($estiloTituloColumnas);	*/	
		$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A2:I".($i-1));
				
		for($i = 'A'; $i <= 'K'; $i++){
			$objPHPExcel->setActiveSheetIndex(0)			
				->getColumnDimension($i)->setAutoSize(TRUE);
		}
		
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