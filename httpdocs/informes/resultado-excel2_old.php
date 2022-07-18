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
$objPHPExcel->getDefaultStyle()->getFont()
    	->setName('Calibri')
    	->setSize(12);

		$tituloReporte = "Estado de situacion";
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
		$titulosColumnas = array('DNI','Profesional', 'Departamento', 'Superior Jerárquico', 'Alim. T1', 'Alim. T2', 'Alim. T3', 'Alim. T4', 'Alim. Anual', 'Cons. T1', 'Cons. T2', 'Cons. T3', 'Cons. T4', 'Cons. Anual');
		
/*		$objPHPExcel->setActiveSheetIndex(0)
        		    ->mergeCells('A1:I1');
*/						
		// Se agregan los titulos del reporte
		$objPHPExcel->setActiveSheetIndex(0)
		            ->setCellValue('A1',  $titulosColumnas[0])
		            ->setCellValue('B1',  $titulosColumnas[1])
        		    ->setCellValue('C1',  $titulosColumnas[2])
            		->setCellValue('D1',  $titulosColumnas[3])
					->setCellValue('E1',  $titulosColumnas[4])
					->setCellValue('F1',  $titulosColumnas[5])
					->setCellValue('G1',  $titulosColumnas[6])
					->setCellValue('H1',  $titulosColumnas[7])
					->setCellValue('I1',  $titulosColumnas[8])
					->setCellValue('J1',  $titulosColumnas[9])
					->setCellValue('K1',  $titulosColumnas[10])
					->setCellValue('L1',  $titulosColumnas[11])
					->setCellValue('M1',  $titulosColumnas[12])
					->setCellValue('N1',  $titulosColumnas[13]);
			$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($celdanegrita);
			$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($celdanegrita);
			$objPHPExcel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($celdanegrita);
		$objPHPExcel->getActiveSheet()->getStyle('C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($celdanegrita);
		$objPHPExcel->getActiveSheet()->getStyle('D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('E1')->applyFromArray($celdanegrita);
		$objPHPExcel->getActiveSheet()->getStyle('E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('F1')->applyFromArray($celdanegrita);
		$objPHPExcel->getActiveSheet()->getStyle('F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('G1')->applyFromArray($celdanegrita);
		$objPHPExcel->getActiveSheet()->getStyle('G1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('H1')->applyFromArray($celdanegrita);
		$objPHPExcel->getActiveSheet()->getStyle('H1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('I1')->applyFromArray($celdanegrita);
		$objPHPExcel->getActiveSheet()->getStyle('I1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('J1')->applyFromArray($celdanegrita);
		$objPHPExcel->getActiveSheet()->getStyle('J1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('K1')->applyFromArray($celdanegrita);
		$objPHPExcel->getActiveSheet()->getStyle('K1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('L1')->applyFromArray($celdanegrita);
		$objPHPExcel->getActiveSheet()->getStyle('L1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('M1')->applyFromArray($celdanegrita);
		$objPHPExcel->getActiveSheet()->getStyle('M1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('N1')->applyFromArray($celdanegrita);
		$objPHPExcel->getActiveSheet()->getStyle('N1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

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
		        ->setCellValue('C'.$i,  utf8_encode($row['dep_nombre']))
        	    ->setCellValue('D'.$i,  utf8_encode($row['usr_apellidos_sj'].", ".$row['usr_nombre_sj']))
        		->setCellValue('E'.$i,  number_format(($t1*100)/$total,2,',','.'))
        		->setCellValue('F'.$i,  number_format(($t2*100)/$total,2,',','.'))
        		->setCellValue('G'.$i,  number_format(($t3*100)/$total,2,',','.'))
       		    ->setCellValue('H'.$i,  number_format(($t4*100)/$total,2,',','.'))
       		    ->setCellValue('I'.$i,  number_format(($anual*100)/$total,2,',','.'))
        		->setCellValue('J'.$i,  number_format(($total_q1*100)/100,2,',','.'))
        		->setCellValue('K'.$i,  number_format(($total_q2*100)/100,2,',','.'))
        		->setCellValue('L'.$i,  number_format(($total_q3*100)/100,2,',','.'))
        		->setCellValue('M'.$i,  number_format(($total_q4*100)/100,2,',','.'))
        		->setCellValue('N'.$i,  ($total_anual)/100)
;
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
header('Content-Disposition: attachment;filename="dpo.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
		
?>