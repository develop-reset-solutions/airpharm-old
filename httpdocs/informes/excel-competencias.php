<?php
session_start();
require_once("../librerias/librerias.php");
require_once("../login/sesion_start.php");
$conn=db_connect();
require_once ("../librerias/phpexcel/PHPExcel.php");
if ($_SESSION['usr_perfil']=='Director RRHH'){
		if($usr_id=='all'){
			$query_usr_dic="SELECT * FROM vcom_diccionarios_usuarios WHERE dic_ano=".$_POST['ejercicio']." ORDER BY apellidos ASC, nombre ASC";
			$result_usr_dic=mysql_query($query_usr_dic) or die ("No se puede ejcutar la consulta: ".$query_usr_dic);
		}elseif(substr($usr_id,0,3)=='cen'){
			$cen_id=substr($usr_id,4,3);
			$query_usr_dic="SELECT * FROM vcom_diccionarios_usuarios WHERE usr_cen_id=".$cen_id." AND dic_ano=".$_POST['ejercicio']." ORDER BY apellidos ASC, nombre ASC";
			$result_usr_dic=mysql_query($query_usr_dic) or die ("No se puede ejecutar la sentencia: ".$query_usr_dic);
		}elseif(substr($usr_id,0,3)=='dep'){
			$dep_id=substr($usr_id,4,3);
			$query_usr_dic="SELECT * FROM vcom_diccionarios_usuarios WHERE usr_dep_id=".$dep_id." dic_ano=".$_POST['ejercicio']."  ORDER BY apellidos ASC, nombre ASC";
			$result_usr_dic=mysql_query($query_usr_dic) or die ("No se puede ejecutar la sentencia: ".$query_usr_dic);
		}else{
			$query_usr_dic="SELECT * FROM vcom_diccionarios_usuarios WHERE du_usr_id=".$usr_id." AND dic_ano=".$_POST['ejercicio'];
			$result_usr_dic=mysql_query($query_usr_dic) or die ("No se puede ejecutar la sentencia: ".$query_usr_dic);
		}
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

		$tituloReporte = "Evaluación de Competencias";
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
$celdagrisverde = array(
	'font' => array(
		'color' => array(
			'rgb' => '516f1f'
		),
	),
	 'alignment' => array(
	 	'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_RIGHT
	),
  'fill' => array(
  		'type'=> PHPExcel_Style_Fill::FILL_SOLID,
    	'color' => array(
			'rgb' => 'E2E2E2'
		),
	),
	'borders' => array(
		'allborders' => array(
        	'style' => PHPExcel_Style_Border::BORDER_THIN,
         )
     )
);
$celdagrisrojo = array(
	'font' => array(
		'color' => array(
			'rgb' => 'FF0000'
		),
	),
	 'alignment' => array(
	 	'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_RIGHT
	),
  'fill' => array(
  		'type'=> PHPExcel_Style_Fill::FILL_SOLID,
    	'color' => array(
			'rgb' => 'E2E2E2'
		),
	),
	'borders' => array(
		'allborders' => array(
        	'style' => PHPExcel_Style_Border::BORDER_THIN,
         )
     )
);
$celdagris = array(
	'font' => array(
		'color' => array(
			'rgb' => '000000'
		),
	),
	 'alignment' => array(
	 	'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_RIGHT
	),
  'fill' => array(
  		'type'=> PHPExcel_Style_Fill::FILL_SOLID,
    	'color' => array(
			'rgb' => 'E2E2E2'
		),
	),
	'borders' => array(
		'allborders' => array(
        	'style' => PHPExcel_Style_Border::BORDER_THIN,
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
$normalderechaverde = array(
	'font' => array(
		'color' => array(
			'rgb' => '516f1f'
		),
	),
	'borders' => array(
		'allborders' => array(
        	'style' => PHPExcel_Style_Border::BORDER_THIN
         )
     ),
	 'alignment' => array(
	 	'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_RIGHT
	),
);
$normalderecharojo = array(
	'font' => array(
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
	 	'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_RIGHT
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
				$objPHPExcel->getActiveSheet()->getStyle('A1:N1')->applyFromArray($celdasnegras);
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
			$query_lin="SELECT * FROM vdpo_lineas WHERE dl_dpo_id=".$row['dpo_id']." AND dl_peso>0";
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
        	    ->setCellValue('D'.$i,  utf8_encode($row['usr_apellidos_sj'].", ".$row['usr_nombre_sj']));
			$objPHPExcel->getActiveSheet()->getStyle('A'.$i.':D'.$i)->applyFromArray($normal);
			$objPHPExcel->setActiveSheetIndex(0)
        		->setCellValue('E'.$i,  number_format(($t1*100)/$total,2,',','.'));
			$objPHPExcel->setActiveSheetIndex(0)
        		->setCellValue('J'.$i,  number_format(($total_q1*100)/100,2,',','.'));
				if((($t1*100)/$total)==100){	
					$objPHPExcel->getActiveSheet()->getStyle('E'.$i)->applyFromArray($celdagrisverde);
					$objPHPExcel->getActiveSheet()->getStyle('J'.$i)->applyFromArray($normalderechaverde);
				}else{
					$objPHPExcel->getActiveSheet()->getStyle('E'.$i)->applyFromArray($celdagrisrojo);
					$objPHPExcel->getActiveSheet()->getStyle('J'.$i)->applyFromArray($normalderecharojo);
				}
			$objPHPExcel->setActiveSheetIndex(0)
        		->setCellValue('F'.$i,  number_format(($t2*100)/$total,2,',','.'));
			$objPHPExcel->setActiveSheetIndex(0)
        		->setCellValue('K'.$i,  number_format(($total_q2*100)/100,2,',','.'));
				if((($t2*100)/$total)==100){	
					$objPHPExcel->getActiveSheet()->getStyle('F'.$i)->applyFromArray($celdagrisverde);
					$objPHPExcel->getActiveSheet()->getStyle('K'.$i)->applyFromArray($normalderechaverde);
				}else{
					$objPHPExcel->getActiveSheet()->getStyle('F'.$i)->applyFromArray($celdagrisrojo);
					$objPHPExcel->getActiveSheet()->getStyle('K'.$i)->applyFromArray($normalderecharojo);
				}
			$objPHPExcel->setActiveSheetIndex(0)
        		->setCellValue('G'.$i,  number_format(($t3*100)/$total,2,',','.'));
			$objPHPExcel->setActiveSheetIndex(0)
        		->setCellValue('L'.$i,  number_format(($total_q3*100)/100,2,',','.'));
				if((($t3*100)/$total)==100){	
					$objPHPExcel->getActiveSheet()->getStyle('G'.$i)->applyFromArray($celdagrisverde);
					$objPHPExcel->getActiveSheet()->getStyle('L'.$i)->applyFromArray($normalderechaverde);
				}else{
					$objPHPExcel->getActiveSheet()->getStyle('G'.$i)->applyFromArray($celdagrisrojo);
					$objPHPExcel->getActiveSheet()->getStyle('L'.$i)->applyFromArray($normalderecharojo);
				}
			$objPHPExcel->setActiveSheetIndex(0)
       		    ->setCellValue('H'.$i,  number_format(($t4*100)/$total,2,',','.'));
			$objPHPExcel->setActiveSheetIndex(0)
        		->setCellValue('M'.$i,  number_format(($total_q4*100)/100,2,',','.'));
				if((($t4*100)/$total)==100){	
					$objPHPExcel->getActiveSheet()->getStyle('H'.$i)->applyFromArray($celdagrisverde);
					$objPHPExcel->getActiveSheet()->getStyle('M'.$i)->applyFromArray($normalderechaverde);
				}else{
					$objPHPExcel->getActiveSheet()->getStyle('H'.$i)->applyFromArray($celdagrisrojo);
					$objPHPExcel->getActiveSheet()->getStyle('M'.$i)->applyFromArray($normalderecharojo);
				}
			$objPHPExcel->setActiveSheetIndex(0)
       		    ->setCellValue('I'.$i,  number_format(($anual*100)/$total,2,',','.'));
			$objPHPExcel->setActiveSheetIndex(0)
        		->setCellValue('N'.$i,  ($total_anual)/100);
				if((($anual*100)/$total)==100){	
					$objPHPExcel->getActiveSheet()->getStyle('I'.$i)->applyFromArray($celdagrisverde);
					$objPHPExcel->getActiveSheet()->getStyle('N'.$i)->applyFromArray($normalderechaverde);
				}else{
					$objPHPExcel->getActiveSheet()->getStyle('I'.$i)->applyFromArray($celdagrisrojo);
					$objPHPExcel->getActiveSheet()->getStyle('N'.$i)->applyFromArray($normalderecharojo);
				}
				

			$i++;
		}
		$objPHPExcel->getActiveSheet()->getStyle('A1:N'.$i)->getAlignment()->setWrapText(true‌​);
		$objPHPExcel->getActiveSheet()->getStyle('A1:N'.$i)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A1:N'.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(12);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(32);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(32);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(8);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(8);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(8);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(8);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(8);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(8);
		$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(8);
		$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(8);
		$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(8);
		$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(8);

		
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