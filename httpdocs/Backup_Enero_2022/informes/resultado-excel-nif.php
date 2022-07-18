<?php
session_start();
require_once("../librerias/librerias.php");
require_once("../login/sesion_start.php");
$conn=db_connect();
require_once ("../librerias/phpexcel/PHPExcel.php");
$ano=$_SESSION['ano'];
$query="SELECT * FROM vdpo_cabeceras WHERE dpo_ano=".$ano." ORDER BY usr_apellidos ASC, usr_nombre ASC";
$result=mysql_query($query) or die ("No se puede ejecutar la sentencia: ".$query);
if (PHP_SAPI == 'cli')
die('Este archivo solo se puede ver desde un navegador web');
// Se crea el objeto PHPExcel
ob_end_clean();
$objPHPExcel = new PHPExcel();
// Se asignan las propiedades del libro
$objPHPExcel->getProperties()->setCreator("DPO Airfarm") //Autor
							 ->setLastModifiedBy("DPO Airfarm") //Ultimo usuario que lo modificó
							 ->setTitle("Informe de consecución con NIF a".date("d/m/Y"))
							 ->setSubject("Informe de consecución con NIF")
							 ->setDescription("Informe de consecución con NIF")
							 ->setKeywords("Informe de consecución con NIF")
							 ->setCategory("Reporte excel");

		$tituloReporte = "Estado de situacion";
		$titulosColumnas = array('DNI','Profesional', 'Responsable', 'Cons. Anual');
		
/*		$objPHPExcel->setActiveSheetIndex(0)
        		    ->mergeCells('A1:C1');
*/						
		// Se agregan los titulos del reporte
		$objPHPExcel->setActiveSheetIndex(0)
		            ->setCellValue('A1',  $titulosColumnas[0])
		            ->setCellValue('B1',  $titulosColumnas[1])
		            ->setCellValue('C1',  $titulosColumnas[2])
        		    ->setCellValue('D1',  $titulosColumnas[3]);
		
		$i = 2;
		while($row=mysql_fetch_array($result)){
			$t1=0;
			$t2=0;
			$t3=0;
			$t4=0;
			$anual=0;
			$total=0;
			$total_q1=0;
			$total_q2=0;
			$total_q3=0;
			$total_q4=0;
			$total_anual=0;
			$query_lin="SELECT * FROM vdpo_lineas WHERE dl_dpo_id=".$row['dpo_id'];
			$result_lin=mysql_query($query_lin) or die ("No se puede ejecutar la sentencia: ".$query_lin);
			while($row_lin=mysql_fetch_array($result_lin)){
				$total_q1+=por_obtencion($row_lin['dl_id'],1);
				$total_q2+=por_obtencion($row_lin['dl_id'],2);
				$total_q3+=por_obtencion($row_lin['dl_id'],3);
				$total_q4+=por_obtencion($row_lin['dl_id'],4);
				$total_anual+=por_obtencion($row_lin['dl_id'],'Anual');
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
        	    ->setCellValue('A'.$i,  $row['usr_dni'])
        	    ->setCellValue('B'.$i,  utf8_encode($row['usr_apellidos'].", ".$row['usr_nombre']))
        	    ->setCellValue('C'.$i,  utf8_encode($row['usr_apellidos_sj'].", ".$row['usr_nombre_sj']))
  ;
   			$objPHPExcel->setActiveSheetIndex(0)->setCellValueExplicit('D'.$i,$total_anual,PHPExcel_Cell_DataType::TYPE_NUMERIC); 
			$objPHPExcel->setActiveSheetIndex(0)->getStyle('D'.$i)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE);
			$i++;
		}
	$estiloTituloReporte = array(
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
    		));
			
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
			),
           	'borders' => array(
               	'all'     => array(
                   	'style' => PHPExcel_Style_Border::BORDER_THIN ,
	                'color' => array(
    	            	'rgb' => 'ccc'
                   	)
               	)             
           	)
        ));
		$estiloAlimentacion = new PHPExcel_Style();
		$estiloAlimentacion->applyFromArray(
           	array(
				'fill' 	=> array(
					'color' => array(
						'rgb' => 'f00'
					)
				)
        	));
		 
//		$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($estiloTituloColumnas);
		$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A1:N".($i-1));
		$objPHPExcel->getActiveSheet()->setSharedStyle($estiloAlimentacion, "E1:I".($i-1));
				
		for($i = 'A'; $i <= 'N'; $i++){
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
		header('Content-Disposition: attachment;filename="Informe de consecucion con NIF.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
		
?>