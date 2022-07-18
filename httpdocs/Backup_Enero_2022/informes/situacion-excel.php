<?php
session_start();
require_once("../librerias/librerias.php");
require_once("../login/sesion_start.php");
$conn=db_connect();
require_once ("../librerias/phpexcel/PHPExcel.php");
$ano=$_SESSION['ano'];
$query="SELECT * FROM vdpo_cabeceras WHERE dpo_ano=".$ano." ORDER BY dep_nombre ASC, usr_apellidos_sj ASC, usr_nombre_sj ASC, usr_apellidos ASC, usr_nombre ASC";
$result=mysql_query($query) or die ("No se puede ejecutar la sentencia: ".$query);
if (PHP_SAPI == 'cli')
die('Este archivo solo se puede ver desde un navegador web');
// Se crea el objeto PHPExcel
ob_end_clean();
$objPHPExcel = new PHPExcel();
// Se asignan las propiedades del libro
$objPHPExcel->getProperties()->setCreator("DPO Airfarm") //Autor
							 ->setLastModifiedBy("DPO Airfarm") //Ultimo usuario que lo modificó
							 ->setTitle("Estado de situacion a".date("d/m/Y"))
							 ->setSubject("Estado de situacion")
							 ->setDescription("Estado de situacion")
							 ->setKeywords("Estado de situacion")
							 ->setCategory("Reporte excel");

		$tituloReporte = "Estado de situacion";
		$titulosColumnas = array('Profesional', 'Departamento', 'Superior Jerárquico', 'T1', 'T2', 'T3', 'T4', 'Anual');
		
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
					->setCellValue('H2',  $titulosColumnas[7]);
		
		$i = 3;
		while($row=mysql_fetch_array($result)){
			$t1=0;
			$t2=0;
			$t3=0;
			$t4=0;
			$anual=0;
			$total=0;
			$query_lin="SELECT * FROM vdpo_lineas WHERE dl_dpo_id=".$row['dpo_id'];
			$result_lin=mysql_query($query_lin) or die ("No se puede ejecutar la sentencia: ".$query_lin);
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
			$objPHPExcel->setActiveSheetIndex(0)
        	    ->setCellValue('A'.$i,  $row['usr_apellidos'].", ".$row['usr_nombre'])
		        ->setCellValue('B'.$i,  $row['dep_nombre'])
        	    ->setCellValue('C'.$i,  $row['usr_apellidos_sj'].", ".$row['usr_nombre_sj'])
        		->setCellValue('D'.$i,  number_format(($t1*100)/$total,2,',','.'))
        		->setCellValue('E'.$i,  number_format(($t2*100)/$total,2,',','.'))
        		->setCellValue('F'.$i,  number_format(($t3*100)/$total,2,',','.'))
       		    ->setCellValue('G'.$i,  number_format(($t4*100)/$total,2,',','.'))
       		    ->setCellValue('H'.$i,  number_format(($anual*100)/$total,2,',','.'));
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
		$objPHPExcel->getActiveSheet()->setTitle('Resumen');

		// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
		$objPHPExcel->setActiveSheetIndex(0);
		// Inmovilizar paneles 
		//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
		//$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

		// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="situacion.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
		
?>