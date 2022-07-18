<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php 
include("../../login/sesion_start.php");
include("../../login/sesion_start_rrhh.php");
include("../../librerias/librerias.php");
require('../../fpdf/fpdf.php');
$conn=db_connect();
$usr_id=$_POST['usr_id'];
//$dpo_id=$_GET['dpo_id'];
//$usr_id=$_REQUEST['usr_id'];

		class PDF extends FPDF
		{
		function Header()
		{
			global $nombre;
			global $cabecera;
			
			if($cabecera=="competencias"){
				$this->SetFillColor(204,204,153);
				$this->SetTextColor(0);
				$this->SetFont('Arial','B',10);
				$this->Cell(174,6,$nombre,'LRT',0,'C',true);
				$this->SetFont('Arial','B',8);
				$this->Cell(25,6,'ACTITUDES','LRT',0,'C',true);
				$this->Cell(40,6,'COMPORTAMIENTOS',1,0,'C',true);
				$this->Cell(30,6,'G. COMPETENCIAL',1,0,'C',true);
				$this->SetFillColor(254);
				$this->Cell(0,6,'',0,1,'C',true);
				
				$this->SetFont('Arial','B',8);
				$this->SetFillColor(204,204,153);
				$this->SetTextColor(0);
				$this->Cell(174,4,'','LRB',0,'L',true);
				$this->Cell(25,4,'','LRB',0,'L',true);
				$this->Cell(10,4,'1',1,0,'C',true);
				$this->Cell(10,4,'2',1,0,'C',true);
				$this->Cell(10,4,'3',1,0,'C',true);
				$this->Cell(10,4,'4',1,0,'C',true);
				$this->SetFillColor(72,142,72);
				$this->Cell(10,4,'A',1,0,'C',true);
				$this->SetFillColor(153,204,102);
				$this->Cell(10,4,'B',1,0,'C',true);
				$this->SetFillColor(230,255,204);
				$this->Cell(10,4,'C',1,0,'C',true);
				$this->SetFillColor(254);
				$this->Cell(0,4,'',0,1,'C',true);
			}
			if($cabecera=="observaciones"){
				$this->SetFillColor(204,204,153);
				$this->SetTextColor(0);
				$this->SetFont('Arial','B',10);
				$this->Cell(269,6,'OBSERVACIONES - COMPROMISOS','LRT',1,'C',true);
			}
		}
		
		function Footer()
		{
			global $fecha;
			/*
			global $nombre_evaluador;
			global $apellidos_evaluador;
			global $fecha_cierre;
			
			$this->SetTextColor(0,0,0);
   			$this->SetY(-15);
			$this->SetFont('Arial','B',8);
			$this->Cell(90,4,'Fecha informe: '.$fecha,'T',0,'L');
			$this->Cell(90,4,'Evaluador: '.$nombre_evaluador.' '.$apellidos_evaluador,'T',0,'L');
			$this->Cell(90,4,'Fecha cierre: '.$fecha_cierre.'','T',0,'L');
    		$this->Cell(0,4,'Página: '.$this->PageNo().'/{nb}','T',0,'R');
			*/
			$this->SetTextColor(0,0,0);
			$this->SetY(-15);
			$this->SetFont('Arial','B',8);
			$this->Cell(120,4,'Fecha informe: '.$fecha,'T',0,'L');
			$this->Cell(0,4,'Página: '.$this->PageNo().'/{nb}','T',0,'R');
		}
		}
		
		ob_end_clean();
		$pdf=new PDF();
		$num_pag=1;
		$pdf->AliasNbPages();
		//$pdf->AddPage('L');
		
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
			$query_usr_dic="SELECT * FROM vcom_diccionarios_usuarios WHERE usr_dep_id=".$dep_id." AND dic_ano=".$_POST['ejercicio']."  ORDER BY apellidos ASC, nombre ASC";
			$result_usr_dic=mysql_query($query_usr_dic) or die ("No se puede ejecutar la sentencia: ".$query_usr_dic);
		}else{
			$query_usr_dic="SELECT * FROM vcom_diccionarios_usuarios WHERE du_usr_id=".$usr_id." AND dic_ano=".$_POST['ejercicio'];
			$result_usr_dic=mysql_query($query_usr_dic) or die ("No se puede ejecutar la sentencia: ".$query_usr_dic);
		}
		  
		  
		/*  
		$query_usr1="SELECT * FROM usuarios WHERE usr_baja=0 ORDER BY usr_apellidos, usr_nombre ASC";
		$result_usr1=mysql_query($query_usr1) or die ("No se puede ejecutar la sentencia: ".$query_usr1);
		while($row_usr1=mysql_fetch_array($result_usr1)){

	
		$query_usr_dic="SELECT du_usr_id FROM com_diccionarios_usuarios WHERE du_responsable=".$row_usr1['usr_id'];
		$result_usr_dic=mysql_query($query_usr_dic) or die ("No se puede ejecutar la sentencia: ".$query_usr_dic);		
		*/
		while($row_usr_dic=mysql_fetch_array($result_usr_dic)){
		
			$usr_id=$row_usr_dic['du_usr_id'];
		
			//echo "usuario: ".$usr_id."<br>";
			
	
			$num=0;
			
				
			$query_vdic="SELECT * FROM vcom_diccionarios_usuarios WHERE du_usr_id=".$usr_id." AND dic_ano=".$_POST['ejercicio'];
			$result_vdic=mysql_query($query_vdic) or die ("No se puede ejecutar la sentencia: ".$query_vdic);
			$row_vdic=mysql_fetch_array($result_vdic);
			$du_id=$row_vdic['du_id'];
			// echo utf8_encode($row_vdic['dic_nombre']);
			if($row_vdic['dic_agrupado']=="no"){
					
				$query="SELECT * FROM usuarios WHERE usr_id=".$usr_id;
				$result=mysql_query($query) or die ("No se puede ejecutar la sentencia: ".$query);
				$row=mysql_fetch_array($result);
				$nombre=$row_vdic['dic_nombre'].' ('.$row_vdic['dic_ano'].')'.' de '.$row['usr_nombre'].' '.$row['usr_apellidos'];

				//$nombre=utf8_encode($row_vdic['dic_nombre']).' ('.$row_vdic['dic_ano'].')'.' de '.utf8_encode($row['usr_nombre']).' '.utf8_encode($row['usr_apellidos']);
				//$nombredic=utf8_encode($row_vdic['dic_nombre']);
				$fecha=date('d/m/Y');
				/*
				$nombre_evaluador_ant = $nombre_evaluador;
				$apellidos_evaluador_ant = $apellidos_evaluador;
				$fecha_cierre_ant = $fecha_cierre;
				
				$nombre_evaluador = $row_vdic["usr_nombre"];
				$apellidos_evaluador = $row_vdic["usr_apellidos"];
				if ($row_vdic["du_fecha_cierre"]!=""){
					$fecha_cierre = cambiaf_a_normal($row_vdic["du_fecha_cierre"]);
				} else{
					$fecha_cierre = '00/00/0000';
				}
				*/
				$cabecera="competencias";
			
				
					$pdf->AddPage('L');
					//$yfinal=$pdf->y;
					$num_obs=0;
					$observaciones= array();
					$com_obs= array();
					$com_antiguo="";
					$act_antiguo="";
					//$comp_antiguo="";
					if ($row_vdic['dic_id']==""){
							$row_vdic['dic_id']=0;
					}
					$query_lin="SELECT * FROM vcom_diccionario WHERE cd_dic_id=".$row_vdic['dic_id']." ORDER BY cd_orden  ASC, acd_grado DESC, cacd_numero ASC";
					$result_lin=mysql_query($query_lin) or die ("No se puede ejecutar la sentencia: ".$query_lin);
				
					while($row_lin=mysql_fetch_array($result_lin)){
						if ( $com_antiguo!=$row_lin['cd_orden']){
							if ($num==10){
								$pdf->AddPage('L');	
								$num=0;
							}
							$com_antiguo=$row_lin['cd_orden'];
							$pdf->SetFont('Arial','B',8);
							$pdf->SetFillColor(120);
							$pdf->SetTextColor(255);
							$pdf->Cell(269,4,$row_lin["com_nombre"],1,1,'L',true);
							//$pdf->SetFillColor(254);
							//$pdf->SetTextColor(0);
							//$pdf->Cell(0,4,'',0,1,'C',true);
							$num++;
							
						} else {
							if ($act_antiguo!=$row_lin['acd_grado']){
								$act_antiguo=$row_lin['acd_grado'];
								$pdf->SetFont('Arial','B',8);
								if ($row_lin['acd_grado']=="A"){				
									$pdf->SetFillColor(72,142,72);
								}
								if ($row_lin['acd_grado']=="B"){				
									$pdf->SetFillColor(153,204,102);
								}
								if ($row_lin['acd_grado']=="C"){				
									$pdf->SetFillColor(230,255,204);
								}
								$pdf->SetTextColor(0);
								$pdf->Cell(174,4,$row_lin["act_nombre"],1,0,'L',true);
								$pdf->SetFillColor(254);
								$pdf->Cell(25,4,'Grado '.$row_lin["acd_grado"],1,0,'C',true);
								
								
								$query_comp_act_com_dic="SELECT * FROM com_comp_act_com_dic WHERE cacd_acd_id=".$row_lin['cacd_acd_id']." ORDER BY cacd_numero";
								$result_comp_act_com_dic=mysql_query($query_comp_act_com_dic) or die ("No se puede ejecutar la sentencia: ".$query_comp_act_com_dic);
								
								
								
								while($row_comp_act_com_dic=mysql_fetch_array($result_comp_act_com_dic)){
								
									$query_comp="SELECT * FROM com_dic_usr_comp WHERE ducp_du_id=".$du_id." AND ducp_comp_id=".$row_comp_act_com_dic['cacd_comp_id'];
									$result_comp=mysql_query($query_comp) or die ("No se puede ejecutar la sentencia: ".$query_comp);
									$row_comp=mysql_fetch_array($result_comp);
									$pdf->Cell(10,4,$row_comp["ducp_evaluacion"],1,0,'C',true);
								}
								
								
								
								
								/*$query_comp="SELECT * FROM com_dic_usr_comp WHERE ducp_usr_id=".$usr_id." AND ducp_dic_id=".$row_vdic['dic_id']." AND ducp_com_id=".$row_lin['cd_com_id']." AND 
								ducp_actitud='".$row_lin["acd_grado"]."' AND ducp_comp_orden=".$row_lin['cacd_numero'];
								$result_comp=mysql_query($query_comp) or die ("No se puede ejecutar la sentencia: ".$query_comp);
								$row_comp=mysql_fetch_array($result_comp);*/
								//$pdf->Cell(10,4,$row_comp["ducp_evaluacion"],1,0,'C',true);
							
								/*$query_comp="SELECT * FROM com_dic_usr_comp WHERE ducp_usr_id=".$usr_id." AND ducp_dic_id=".$row_vdic['dic_id']." AND ducp_com_id=".$row_lin['cd_com_id']." AND 
								ducp_actitud='".$row_lin["acd_grado"]."' AND ducp_comp_orden=2";
								$result_comp=mysql_query($query_comp) or die ("No se puede ejecutar la sentencia: ".$query_comp);
								$row_comp=mysql_fetch_array($result_comp);*/
								//$pdf->Cell(10,4,$row_comp["ducp_evaluacion"],1,0,'C',true);
								/*
								$query_comp="SELECT * FROM com_dic_usr_comp WHERE ducp_usr_id=".$usr_id." AND ducp_dic_id=".$row_vdic['dic_id']." AND ducp_com_id=".$row_lin['cd_com_id']." AND 
								ducp_actitud='".$row_lin["acd_grado"]."' AND ducp_comp_orden=3";
								$result_comp=mysql_query($query_comp) or die ("No se puede ejecutar la sentencia: ".$query_comp);
								$row_comp=mysql_fetch_array($result_comp);*/
								//$pdf->Cell(10,4,$row_comp["ducp_evaluacion"],1,0,'C',true);
								/*
								$query_comp="SELECT * FROM com_dic_usr_comp WHERE ducp_usr_id=".$usr_id." AND ducp_dic_id=".$row_vdic['dic_id']." AND ducp_com_id=".$row_lin['cd_com_id']." AND 
								ducp_actitud='".$row_lin["acd_grado"]."' AND ducp_comp_orden=4";
								$result_comp=mysql_query($query_comp) or die ("No se puede ejecutar la sentencia: ".$query_comp);
								$row_comp=mysql_fetch_array($result_comp);*/
								//$pdf->Cell(10,4,$row_comp["ducp_evaluacion"],1,0,'C',true);
								
								if ($row_lin['acd_grado']=="A"){
									$pdf->SetFillColor(72,142,72);
									$pdf->Cell(10,4,'','LRT',0,'C',true);
									$pdf->SetFillColor(153,204,102);
									$pdf->Cell(10,4,'','LRT',0,'C',true);
									$pdf->SetFillColor(230,255,204);
									$pdf->Cell(10,4,'','LRT',1,'C',true);
									//$pdf->SetFillColor(254);
									//$pdf->Cell(0,4,'',0,1,'C',true);
									
								
								}
								if ($row_lin['acd_grado']=="B"){
									/*$query_com="SELECT * FROM com_dic_usr_com WHERE duc_usr_id=".$usr_id." AND duc_dic_id=".$row_vdic['dic_id']." AND duc_com_id=".$row_lin['cd_com_id'];
									$result_com=mysql_query($query_com) or die ("No se puede ejecutar la sentencia: ".$query_com);
									$row_com=mysql_fetch_array($result_com);*/
									$query_com="SELECT * FROM vcom_dic_usr_com WHERE duc_com_id=".$row_lin['cd_com_id']." AND du_id=". $du_id." AND dic_ano=".$_SESSION['ano'] ;
									$result_com=mysql_query($query_com) or die ("No se puede ejecutar la sentencia: ".$query_com);
									$row_com=mysql_fetch_array($result_com);
									$a="";
									$b="";
									$c="";
									
									if ($row_com['duc_grado']=="A"){
										$a="X";
									}
									if ($row_com['duc_grado']=="B"){
										$b="X";
									}
									if ($row_com['duc_grado']=="C"){
										$c="X";
									}
									
									$pdf->SetFillColor(72,142,72);
									$pdf->Cell(10,4,$a,'LR',0,'C',true);
									$pdf->SetFillColor(153,204,102);
									$pdf->Cell(10,4,$b,'LR',0,'C',true);
									$pdf->SetFillColor(230,255,204);
									$pdf->Cell(10,4,$c,'LR',1,'C',true);
									//$pdf->SetFillColor(254);
									//$pdf->Cell(0,4,'',0,1,'C',true);
									if ($row_com['duc_observaciones']!=""){
										$num_obs++;
										$observaciones[$num_obs]= $row_com['duc_observaciones'];
										$com_obs[$num_obs]= $row_lin["com_nombre"];
										
										}
								}
								if ($row_lin['acd_grado']=="C"){
									$pdf->SetFillColor(72,142,72);
									$pdf->Cell(10,4,'','LRB',0,'C',true);
									$pdf->SetFillColor(153,204,102);
									$pdf->Cell(10,4,'','LRB',0,'C',true);
									$pdf->SetFillColor(230,255,204);
									$pdf->Cell(10,4,'','LRB',1,'C',true);
									//$pdf->SetFillColor(254);
									//$pdf->Cell(0,4,'',0,1,'C',true);
								
								} 
							}
						}
					}
					/*
					$nombre_evaluador=$nombre_evaluador_ant;
					$apellidos_evaluador=$apellidos_evaluador_ant;
					$fecha_cierre=$fecha_cierre_ant;
					*/
					if ($num_obs!=0){
						$cabecera="observaciones";
						/*
						$nombre_evaluador=$nombre_evaluador_ant;
						$apellidos_evaluador=$apellidos_evaluador_ant;
						$fecha_cierre=$fecha_cierre_ant;
						*/
						$pdf->AddPage('L');	
						$i=1;
						while ($i <= $num_obs) {
							$pdf->SetFont('Arial','B',9);
							$pdf->SetFillColor(120);
							$pdf->SetTextColor(255);
							$pdf->Cell(269,4,$com_obs[$i],1,1,'L',true);
							$pdf->SetFont('Arial','B',8);
							$pdf->SetFillColor(230,255,204);
							$pdf->SetTextColor(0);
							$pdf->MultiCell(269,4,'  '.$observaciones[$i],1,1,'L',true);
							$i++;
						}
					} else {
						$cabecera="observaciones";
						/*
						$nombre_evaluador=$nombre_evaluador_ant;
						$apellidos_evaluador=$apellidos_evaluador_ant;
						$fecha_cierre=$fecha_cierre_ant;
						*/
						$pdf->AddPage('L');	
						$pdf->MultiCell(269,4,' ',1,1,'L',true);
					}
			 
			
		
		} else {
			$query="SELECT * FROM usuarios WHERE usr_id=".$usr_id;
				$result=mysql_query($query) or die ("No se puede ejecutar la sentencia: ".$query);
				$row=mysql_fetch_array($result);
				$nombre=$row_vdic['dic_nombre'].' ('.$row_vdic['dic_ano'].')'.' de '.$row['usr_nombre'].' '.$row['usr_apellidos'];
				
				//$nombre=utf8_encode($row_vdic['dic_nombre']).' ('.$row_vdic['dic_ano'].')'.' de '.utf8_encode($row['usr_nombre']).' '.utf8_encode($row['usr_apellidos']);
				//$nombredic=utf8_encode($row_vdic['dic_nombre']);
				$fecha=date('d/m/Y');
				/*
				$nombre_evaluador_ant = $nombre_evaluador;
				$apellidos_evaluador_ant = $apellidos_evaluador;
				$fecha_cierre_ant = $fecha_cierre;
				
				$nombre_evaluador = $row_vdic["usr_nombre"];
				$apellidos_evaluador = $row_vdic["usr_apellidos"];
				if ($row_vdic["du_fecha_cierre"]!=""){
					$fecha_cierre = cambiaf_a_normal($row_vdic["du_fecha_cierre"]);
				} else{
					$fecha_cierre = '00/00/0000';
				}
				*/
				$cabecera="competencias";
			
				
					$pdf->AddPage('L');
					//$yfinal=$pdf->y;
					$num_obs=0;
					$observaciones= array();
					$com_obs= array();
					$com_antiguo="";
					$act_antiguo="";
					//$comp_antiguo="";
					if ($row_vdic['dic_id']==""){
							$row_vdic['dic_id']=0;
					}
					$query_lin="SELECT * FROM vcom_diccionario WHERE cd_dic_id=".$row_vdic['dic_id']." ORDER BY cd_orden  ASC, acd_grado ASC, cacd_numero DESC";
					//$query_lin="SELECT * FROM vcom_diccionario WHERE cd_dic_id=".$row_vdic['dic_id']." ORDER BY cd_orden  ASC, acd_grado DESC, cacd_numero ASC";
					$result_lin=mysql_query($query_lin) or die ("No se puede ejecutar la sentencia: ".$query_lin);
				
					while($row_lin=mysql_fetch_array($result_lin)){
						if ( $com_antiguo!=$row_lin['cd_orden']){
							if ($num==10){
								$pdf->AddPage('L');	
								$num=0;
							}
							$com_antiguo=$row_lin['cd_orden'];
							$pdf->SetFont('Arial','B',8);
							$pdf->SetFillColor(120);
							$pdf->SetTextColor(255);
							$pdf->Cell(269,4,$row_lin["com_nombre"],1,1,'L',true);
							//$pdf->SetFillColor(254);
							//$pdf->SetTextColor(0);
							//$pdf->Cell(0,4,'',0,1,'C',true);
							$num++;
							
						} else {
							if ($act_antiguo!=$row_lin['acd_grado']){
								$act_antiguo=$row_lin['acd_grado'];
								$pdf->SetFont('Arial','B',8);
								if ($row_lin['acd_grado']=="A"){				
									$pdf->SetFillColor(72,142,72);
								}
								if ($row_lin['acd_grado']=="B"){				
									$pdf->SetFillColor(153,204,102);
								}
								if ($row_lin['acd_grado']=="C"){				
									$pdf->SetFillColor(230,255,204);
								}
								$pdf->SetTextColor(0);
								$pdf->Cell(174,4,$row_lin["act_nombre"],1,0,'L',true);
								$pdf->SetFillColor(254);
								$pdf->Cell(25,4,'Grado '.$row_lin["acd_grado"],1,0,'C',true);
								
								
								$query_comp_act_com_dic="SELECT * FROM com_comp_act_com_dic WHERE cacd_acd_id=".$row_lin['cacd_acd_id']." ORDER BY cacd_numero DESC";;
								$result_comp_act_com_dic=mysql_query($query_comp_act_com_dic) or die ("No se puede ejecutar la sentencia: ".$query_comp_act_com_dic);
								
								
								
								while($row_comp_act_com_dic=mysql_fetch_array($result_comp_act_com_dic)){
								
									$query_comp="SELECT * FROM com_dic_usr_comp WHERE ducp_du_id=".$du_id." AND ducp_comp_id=".$row_comp_act_com_dic['cacd_comp_id'];
									$result_comp=mysql_query($query_comp) or die ("No se puede ejecutar la sentencia: ".$query_comp);
									$row_comp=mysql_fetch_array($result_comp);
									$pdf->Cell(10,4,$row_comp["ducp_evaluacion"],1,0,'C',true);
								}
														
								
								
								/*$query_comp="SELECT * FROM com_dic_usr_comp WHERE ducp_usr_id=".$usr_id." AND ducp_dic_id=".$row_vdic['dic_id']." AND ducp_com_id=".$row_lin['cd_com_id']." AND 
								ducp_actitud='".$row_lin["acd_grado"]."' AND ducp_comp_orden=".$row_lin['cacd_numero'];
								$result_comp=mysql_query($query_comp) or die ("No se puede ejecutar la sentencia: ".$query_comp);
								$row_comp=mysql_fetch_array($result_comp);*/
								//$pdf->Cell(10,4,$row_comp["ducp_evaluacion"],1,0,'C',true);
							
								/*$query_comp="SELECT * FROM com_dic_usr_comp WHERE ducp_usr_id=".$usr_id." AND ducp_dic_id=".$row_vdic['dic_id']." AND ducp_com_id=".$row_lin['cd_com_id']." AND 
								ducp_actitud='".$row_lin["acd_grado"]."' AND ducp_comp_orden=2";
								$result_comp=mysql_query($query_comp) or die ("No se puede ejecutar la sentencia: ".$query_comp);
								$row_comp=mysql_fetch_array($result_comp);*/
								//$pdf->Cell(10,4,$row_comp["ducp_evaluacion"],1,0,'C',true);
								/*
								$query_comp="SELECT * FROM com_dic_usr_comp WHERE ducp_usr_id=".$usr_id." AND ducp_dic_id=".$row_vdic['dic_id']." AND ducp_com_id=".$row_lin['cd_com_id']." AND 
								ducp_actitud='".$row_lin["acd_grado"]."' AND ducp_comp_orden=3";
								$result_comp=mysql_query($query_comp) or die ("No se puede ejecutar la sentencia: ".$query_comp);
								$row_comp=mysql_fetch_array($result_comp);*/
								//$pdf->Cell(10,4,$row_comp["ducp_evaluacion"],1,0,'C',true);
								/*
								$query_comp="SELECT * FROM com_dic_usr_comp WHERE ducp_usr_id=".$usr_id." AND ducp_dic_id=".$row_vdic['dic_id']." AND ducp_com_id=".$row_lin['cd_com_id']." AND 
								ducp_actitud='".$row_lin["acd_grado"]."' AND ducp_comp_orden=4";
								$result_comp=mysql_query($query_comp) or die ("No se puede ejecutar la sentencia: ".$query_comp);
								$row_comp=mysql_fetch_array($result_comp);*/
								//$pdf->Cell(10,4,$row_comp["ducp_evaluacion"],1,0,'C',true);
								
								if ($row_lin['acd_grado']=="C"){
									$pdf->SetFillColor(72,142,72);
									$pdf->Cell(10,4,'','LRT',0,'C',true);
									$pdf->SetFillColor(153,204,102);
									$pdf->Cell(10,4,'','LRT',0,'C',true);
									$pdf->SetFillColor(230,255,204);
									$pdf->Cell(10,4,'','LRT',1,'C',true);
									//$pdf->SetFillColor(254);
									//$pdf->Cell(0,4,'',0,1,'C',true);
									
									
								}
								if ($row_lin['acd_grado']=="B"){
									/*$query_com="SELECT * FROM com_dic_usr_com WHERE duc_usr_id=".$usr_id." AND duc_dic_id=".$row_vdic['dic_id']." AND duc_com_id=".$row_lin['cd_com_id'];
									$result_com=mysql_query($query_com) or die ("No se puede ejecutar la sentencia: ".$query_com);
									$row_com=mysql_fetch_array($result_com);*/
									$query_com="SELECT * FROM vcom_dic_usr_com WHERE duc_com_id=".$row_lin['cd_com_id']." AND du_id=". $du_id." AND dic_ano=".$_SESSION['ano'] ;
									$result_com=mysql_query($query_com) or die ("No se puede ejecutar la sentencia: ".$query_com);
									$row_com=mysql_fetch_array($result_com);
									$a="";
									$b="";
									$c="";
									
									if ($row_com['duc_grado']=="A"){
										$a="X";
									}
									if ($row_com['duc_grado']=="B"){
										$b="X";
									}
									if ($row_com['duc_grado']=="C"){
										$c="X";
									}
									
									$pdf->SetFillColor(72,142,72);
									$pdf->Cell(10,4,$a,'LR',0,'C',true);
									$pdf->SetFillColor(153,204,102);
									$pdf->Cell(10,4,$b,'LR',0,'C',true);
									$pdf->SetFillColor(230,255,204);
									$pdf->Cell(10,4,$c,'LR',1,'C',true);
									//$pdf->SetFillColor(254);
									//$pdf->Cell(0,4,'',0,1,'C',true);
									if ($row_com['duc_observaciones']!=""){
										$num_obs++;
										$observaciones[$num_obs]= $row_com['duc_observaciones'];
										$com_obs[$num_obs]= $row_lin["com_nombre"];
										
										}
								}
								if ($row_lin['acd_grado']=="A"){
									$pdf->SetFillColor(72,142,72);
									$pdf->Cell(10,4,'','LRB',0,'C',true);
									$pdf->SetFillColor(153,204,102);
									$pdf->Cell(10,4,'','LRB',0,'C',true);
									$pdf->SetFillColor(230,255,204);
									$pdf->Cell(10,4,'','LRB',1,'C',true);
									//$pdf->SetFillColor(254);
									//$pdf->Cell(0,4,'',0,1,'C',true);
								} 
							}
						}
					}
					/*
					$nombre_evaluador=$nombre_evaluador_ant;
					$apellidos_evaluador=$apellidos_evaluador_ant;
					$fecha_cierre=$fecha_cierre_ant;
					*/
					if ($num_obs!=0){
						$cabecera="observaciones";
						/*
						$nombre_evaluador=$nombre_evaluador_ant;
						$apellidos_evaluador=$apellidos_evaluador_ant;
						$fecha_cierre=$fecha_cierre_ant;
						*/
						$pdf->AddPage('L');	
						$i=1;
						while ($i <= $num_obs) {
							$pdf->SetFont('Arial','B',9);
							$pdf->SetFillColor(120);
							$pdf->SetTextColor(255);
							$pdf->Cell(269,4,$com_obs[$i],1,1,'L',true);
							$pdf->SetFont('Arial','B',8);
							$pdf->SetFillColor(230,255,204);
							$pdf->SetTextColor(0);
							$pdf->MultiCell(269,4,'  '.$observaciones[$i],1,1,'L',true);
							$i++;
						}
					} else {
						$cabecera="observaciones";
						/*
						$nombre_evaluador=$nombre_evaluador_ant;
						$apellidos_evaluador=$apellidos_evaluador_ant;
						$fecha_cierre=$fecha_cierre_ant;
						*/
						$pdf->AddPage('L');	
						$pdf->MultiCell(269,4,' ',1,1,'L',true);
					}
			} 
			
		
		}
		  
	  } 
	
$pdf->Output();
?>

