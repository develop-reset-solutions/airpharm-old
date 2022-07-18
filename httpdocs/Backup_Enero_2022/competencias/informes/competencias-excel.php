<?php
include("../../login/sesion_start.php");
require_once("../../librerias/librerias.php");
require_once("../../login/sesion_start.php");
$conn=db_connect();
require_once ("../../librerias/phpexcel/PHPExcel.php");

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
			'rgb' => '000000'
		),
	),
	 'alignment' => array(
	 	'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_RIGHT
	),
   'fill' => array(
  		'type'=> PHPExcel_Style_Fill::FILL_SOLID,
    	'color' => array(
			'rgb' => '94f696'
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
			'rgb' => 'ffffff'
		),
	),
	 'alignment' => array(
	 	'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_RIGHT
	),
  'fill' => array(
  		'type'=> PHPExcel_Style_Fill::FILL_SOLID,
    	'color' => array(
			'rgb' => '797e79'
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
			'rgb' => '158117'
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
$centrado = array(
	'alignment' => array(
		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
	),
);
$izquierda = array(
	'alignment' => array(
		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT
	),
);

	//Comprueba si el select hay algun valor seleccionado
	if(isset($_POST['usr_id'])){
		$select1 = $_POST['usr_id'];
		switch ($select1) { //Comprueva que valor tiene la opción seleccionada
			case 'all': //Generamos el excel de todos los seleccionados
				$query_usr_dic="SELECT * FROM vcom_diccionarios_usuarios WHERE dic_ano=".$_POST['ejercicio']." ORDER BY apellidos ASC, nombre ASC";
				$result_usr_dic=mysql_query($query_usr_dic) or die ("No se puede ejcutar la consulta: ".$query_usr_dic);
				break;
			case stristr($select1,'dep_'): //Generamos el excel del departamento seleccionado				
				$dep_id=substr($select1,4);
				$query_usr_dic="SELECT * FROM vcom_diccionarios_usuarios WHERE usr_dep_id=".$dep_id." AND dic_ano=".$_POST['ejercicio']." ORDER BY apellidos ASC";
				$result_usr_dic=mysql_query($query_usr_dic) or die ("No se puede ejcutar la consulta: ".$query_usr_dic);
				break;
			default: //Generamos el excel del usuario seleccionado
				$query_usr_dic="SELECT * FROM vcom_diccionarios_usuarios WHERE du_usr_id=".$_POST['usr_id']." AND dic_ano=".$_POST['ejercicio'];
				$result_usr_dic=mysql_query($query_usr_dic) or die ("No se puede ejecutar la sentencia: ".$query_usr_dic);
				break;
		}
							

		//if($_SESSION['usr_perfil']<>'Administrador' and $_SESSION['usr_perfil']<>'Director RRHH'){
			
		//} 
		$long=0;   
		$i = 2; 
		if (mysql_num_rows($result_usr_dic)!==0) {
			while($row_usr_dic=mysql_fetch_array($result_usr_dic)){
				
				$total_a=0;
				$total_b=0;
				$total_c=0;
				  
				$c=0;
				$contador=0; //Contador para movernos por las diferentes columnas 
				$columnas = range('B','Z'); //Creamos array para las casillas del excel
				$row=mysql_fetch_array($result_usr_dic);
				// Rellena la row solo con los datos de 1 usuario cada vez
				$usr_id=$row_usr_dic['du_usr_id'];

				$query_vdic="SELECT * FROM vcom_diccionarios_usuarios WHERE du_usr_id=".$usr_id." AND dic_ano=".$_POST['ejercicio'];
				$result_vdic=mysql_query($query_vdic) or die ("No se puede ejecutar la sentencia: ".$query_vdic);
				$row_vdic=mysql_fetch_array($result_vdic);

				$du_id=$row_vdic['du_id'];
				
				$query="SELECT * FROM usuarios WHERE usr_id=".$usr_id;
				$result=mysql_query($query) or die ("No se puede ejecutar la sentencia: ".$query);
				$row=mysql_fetch_array($result);
				$nombre=utf8_encode($row['usr_nombre'].' '.$row['usr_apellidos']);
				
				//Insertamos el tipo de diccionario que es 
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A1', $row_vdic['dic_ano'])
							->setCellValue('B'.$i, utf8_encode($row_vdic['dic_nombre']));
				$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($centrado);
					
				 
				//Cabecera competencias
				
				$objPHPExcel->setActiveSheetIndex(0) 
					->setCellValue($columnas[$c].'1', "Diccionario")
					->setCellValue('V1', "Total grado A")
					->setCellValue('W1', "Total grado B")
					->setCellValue('X1', "Total grado C");
				$objPHPExcel->getActiveSheet()->getStyle('V1:X1')->applyFromArray($centrado); 
				$c++; 
				
				$query_comp="SELECT DISTINCT com_nombre FROM vcom_diccionario ORDER BY cd_orden ASC";
				$result_comp=mysql_query($query_comp) or die ("No se puede ejecutar la sentencia: ".$query_comp);
				
				while($row_comp=mysql_fetch_array($result_comp)){
					
					$objPHPExcel->setActiveSheetIndex(0) 
						->setCellValue($columnas[$c].'1', utf8_encode($row_comp["com_nombre"]));
					$objPHPExcel->getActiveSheet()->getStyle($columnas[$c].'1')->applyFromArray($centrado);
					$c++;
					$long++;//Contador para saber cuantas competencias hay
				}
								 
				
				// Se agregan los titulos del reporte con el nombre del trabajador
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i, $nombre);				
				$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($celdamarron);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($izquierda);
				  
								
				// Comprobamos los registros que hay de ese usuario
				$com_antiguo=""; // Variables para saber en que nombre de competencia nos encontramos 
				$act_antiguo=""; 
				 
				$query_lin="SELECT * FROM vcom_diccionario WHERE cd_dic_id=".$row_vdic['dic_id']." ORDER BY cd_orden  ASC, acd_grado DESC, cacd_numero ASC";
				$result_lin=mysql_query($query_lin) or die ("No se puede ejecutar la sentencia: ".$query_lin);
				
								
				while($row_lin=mysql_fetch_array($result_lin)){
				  
					if ($com_antiguo!=$row_lin['cd_orden']){ //Comprueba que la competencia no se repita
						   
						$com_antiguo=$row_lin['cd_orden'];	
											   
						
					} else { 
						if ($act_antiguo!=$row_lin['acd_grado']){
							$act_antiguo=$row_lin['acd_grado'];						        						
							// Comprueba el grado de competencia
							$z=1;													   
								  
								$query_comp="SELECT DISTINCT com_nombre FROM vcom_diccionario ORDER BY cd_orden ASC";
								$result_comp=mysql_query($query_comp) or die ("No se puede ejecutar la sentencia: ".$query_comp);

								while($row_comp2=mysql_fetch_array($result_comp)){ //While para recorrer el array y saber en que posicion colocar el grado de competencia	  				
									if ($row_comp2["com_nombre"]==$row_lin["com_nombre"]){
										$contador_competencia=$z;													  			  
									}   								
									$z++;
																		
								}	
								
								
								$query_com="SELECT * FROM vcom_dic_usr_com WHERE duc_com_id=".$row_lin['cd_com_id']." AND du_id=".$du_id." AND dic_ano=".$_POST['ejercicio'] ;
								$result_com=mysql_query($query_com) or die ("No se puede ejecutar la sentencia: ".$query_com);
								$row_com=mysql_fetch_array($result_com);
								$a="";   
								$b="";
								$c="";   
																 
								if ($row_lin['acd_grado']=="B"){ 
									if ($row_com['duc_grado']=="A"){
										$a="A";
										$total_a++;
										$objPHPExcel->setActiveSheetIndex(0)
											->setCellValue($columnas[$contador_competencia].$i, $a);

										$objPHPExcel->getActiveSheet()->getStyle($columnas[$contador_competencia].$i)->applyFromArray($centrado);
										}
									if ($row_com['duc_grado']=="B"){
										$b="B";
										$total_b++;
										$objPHPExcel->setActiveSheetIndex(0)
											->setCellValue($columnas[$contador_competencia].$i, $b);

										$objPHPExcel->getActiveSheet()->getStyle($columnas[$contador_competencia].$i)->applyFromArray($centrado);
									}
									if ($row_com['duc_grado']=="C"){
										$c="C";
										$total_c++;
										$objPHPExcel->setActiveSheetIndex(0)
											->setCellValue($columnas[$contador_competencia].$i, $c);									
										$objPHPExcel->getActiveSheet()->getStyle($columnas[$contador_competencia].$i)->applyFromArray($centrado);
									}			
								}
							}
						    
						 //Restamos un valor para que vuelva a la fila anterior
					}  //Fin if    
					  
					        
				} //Fin while rowlin
				 
				$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('V'.$i, $total_a)
					->setCellValue('W'.$i, $total_b)
					->setCellValue('X'.$i, $total_c);
				   
				$i++; //Sumamos otra linea para el nuevo registro
				
			} // End while result_usr_dic
		$objPHPExcel->getActiveSheet()->getStyle('A1:N1')->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getStyle('A1:N1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A1:N1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
 		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(70); 
			
		for($col = 'B'; $col !== 'Z'; $col++) {
		$objPHPExcel->getActiveSheet()
			->getColumnDimension($col)
			->setAutoSize(true);
		}  
		
		// Se asigna el nombre a la hoja
		$objPHPExcel->getActiveSheet()->setTitle('Resumen');

		// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
		$objPHPExcel->setActiveSheetIndex(0);
		// Inmovilizar paneles 
		//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
		//$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

		// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=UTF-8');
		header('Content-Disposition: attachment;filename="evaluacion_competencias.xlsx"');
		header('Cache-Control: max-age=0');
		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
		$objWriter->save('php://output');
		exit;
		} else {
			echo'<script type="text/javascript">
					alert("No hay registros del campo seleccionado");
					window.history.go(-1);
				</script>';
		}
	}
?>