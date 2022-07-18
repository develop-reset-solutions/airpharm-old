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
		$i = 1;
		
		if (mysql_num_rows($result_usr_dic)!==0) {
			while($row_usr_dic=mysql_fetch_array($result_usr_dic)){			
				
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
				$nombre=utf8_encode($row_vdic['dic_ano'].' de '.$row['usr_nombre'].' '.$row['usr_apellidos']);

				// Se agregan los titulos del reporte con el nombre del trabajador
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i, $nombre);				
				$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($celdamarron);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($centrado);
				 

				// Comprobamos los registros que hay de ese usuario
				$com_antiguo=""; // Variables para saber en que nombre de competencia nos encontramos 
				$act_antiguo="";

				$query_lin="SELECT * FROM vcom_diccionario WHERE cd_dic_id=".$row_vdic['dic_id']." ORDER BY cd_orden  ASC, acd_grado DESC, cacd_numero ASC";
				$result_lin=mysql_query($query_lin) or die ("No se puede ejecutar la sentencia: ".$query_lin);

				while($row_lin=mysql_fetch_array($result_lin)){
					  
					if ($com_antiguo!=$row_lin['cd_orden']){ //Comprueba que la competencia no se repita
						  
						$com_antiguo=$row_lin['cd_orden'];	
						// Insertamos los nombres de competencias 
						$objPHPExcel->setActiveSheetIndex(0) 
							->setCellValue($columnas[$contador].$i, utf8_encode($row_lin["com_nombre"]));
						
						$i++;
						$contador++;
					}  else {
						if ($act_antiguo!=$row_lin['acd_grado']){
							$act_antiguo=$row_lin['acd_grado'];
														  							
							// Comprueba el grado de competencia 
							/*
							if (!is_null($row_lin['acd_grado'])){
								
								$query_com="SELECT * FROM vcom_dic_usr_com WHERE duc_com_id=".$row_lin['cd_com_id']." AND du_id=". $du_id." AND dic_ano=".$_POST['ejercicio'] ;
								$result_com=mysql_query($query_com) or die ("No se puede ejecutar la sentencia: ".$query_com);
								$row_com=mysql_fetch_array($result_com);
								$a="";
								$b="";
								$c="";
																 
								/*
								if ($row_com['duc_grado']=="A"){
									$a="X";
									$objPHPExcel->setActiveSheetIndex(0)
										->setCellValue($columnas[$contador].$i, $a);
									}
								if ($row_com['duc_grado']=="B"){
									$b="X";									
									$objPHPExcel->setActiveSheetIndex(0)
										->setCellValue($columnas[$contador].$i, $b);
								}
								if ($row_com['duc_grado']=="C"){
									$c="X";
									$objPHPExcel->setActiveSheetIndex(0)
										->setCellValue($columnas[$contador].$i, $c);
								}
								*/  
								/*
								if ($row_com['duc_observaciones']!=""){
									$contador++;
									$i--;  
									$objPHPExcel->setActiveSheetIndex(0)
									->setCellValue($columnas[$contador].$i, "Observaciones");									
									$objPHPExcel->getActiveSheet()->getStyle('A'.$i.':I'.$i)->applyFromArray($centrado);
									
									$i++; 
									$objPHPExcel->setActiveSheetIndex(0)
									->setCellValue($columnas[$contador].$i, $row_com['duc_observaciones']);
								}								 
								 */ 
							}
							$contador++;
							
						}
					
					$i--; //Restamos un valor para que vuelva a la fila anterior
					$contador++; 
					} 
					
				} 
				
				$contador++;
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue($columnas[$contador].$i, $row_vdic['dic_nombre']);
				 
				$i=$i+3; // Numero de lineas entre usuario y siguiente usuario
				
				
			} // End while result_usr_dic
		$objPHPExcel->getActiveSheet()->getStyle('A1:N1')->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getStyle('A1:N1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A1:N1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(70);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(32);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(8);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(32);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(8);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(8);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(8);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(32);
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
<?php
echo "<mm:dwdrfml documentRoot=" . __FILE__ .">";$included_files = get_included_files();foreach ($included_files as $filename) { echo "<mm:IncludeFile path=" . $filename . " />"; } echo "</mm:dwdrfml>";
?>