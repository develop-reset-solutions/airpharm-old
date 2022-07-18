<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php 
include("../login/sesion_start.php");
include("../librerias/librerias.php");
require('../fpdf/fpdf.php');
$conn=db_connect();
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
$fecha=date('d/m/Y');
class PDF extends FPDF
{
function Header()
{
		global $nombre;
    	$this->SetFont('Arial','B',10);
		$this->SetTextColor(0);
    	//Título
    	$this->Cell(0,4,'DPO de '.$nombre,'B');
		$this->Ln();
    	$this->SetFont('Arial','B',10);
/*    	$this->Cell(110,4,'Fecha informe:'.$fecha,0,0,'L');
    	$this->Cell(0,4,'Página:'.$this->PageNo().'/{nb}',0,0,'R');
		$this->Ln();
*/	
    	//Salto de línea
/*    	$this->Cell(0,2,'','B');
		$this->Ln();
    	$this->SetFont('Arial','B',8);
		$this->Cell(30,6,'Tipo',0,0,'C');
		$this->Cell(31,6,'Nombre',0,0,'C');
		$this->Cell(27,6,'Precio compra',0,0,'C');
		$this->Cell(27,6,'F. compra',0,0,'C');
		$this->Cell(27,6,'Rent. año',0,0,'C');
		$this->Cell(27,6,'Rent. acum.',0,0,'C');
		$this->Cell(27,6,'Valor actual',0,0,'C');
		$this->Cell(27,6,'TIR',0,0,'C');
		$this->Cell(27,6,'Sociedad',0,0,'C');
		$this->Cell(0,6,'% Total',0,0,'C');
		$this->Ln();
    	$this->Cell(0,2,'','B');
		$this->Ln();
*/}
function Footer()
{
	global $fecha;
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
$pdf->AddPage('L');
$n_lin=1;
$query_lin="SELECT * FROM vdpo_lineas WHERE dl_dpo_id=".$dpo_id." AND obj_tipo LIKE 'Objetivo de compañia' ORDER BY dl_peso DESC, obj_descripcion ASC";
$result_lin=mysql_query($query_lin) or die ("No se puede ejecutar la sentencia: ".$query_lin);
$num_lin=mysql_num_rows($result_lin);
if($num_lin){
	$pdf->SetFont('Arial','B',8);
	$pdf->SetTextColor(255);
	$pdf->SetFillColor(0);
	$pdf->Cell(200,4,'A nivel de compañia',0,0,'L',true);
	$pdf->Cell(0,4,$peso['Objetivo de Compañía'].' %',0,1,'R',true);
	$pdf->SetFillColor(120);
	$pdf->Cell(4,4,'',0,0,'C',true);
	$pdf->Cell(8,4,'OE',0,0,'C',true);
	$pdf->Cell(95,4,'Objetivo',0,0,'L',true);
	$pdf->Cell(12,4,'C.I.',0,0,'C',true);
	$pdf->Cell(95,4,'Indicador',0,0,'L',true);
	$pdf->Cell(13,4,'Meta',0,0,'C',true);
	$pdf->Cell(8,4,'Un',0,0,'C',true);
	$pdf->Cell(26,4,'Horquilla',0,0,'C',true);
	$pdf->Cell(8,4,'Un',0,0,'C',true);
	$pdf->Cell(0,4,'Peso',0,1,'C',true);
	$yfinal=$pdf->y;
}
	while($row_lin=mysql_fetch_array($result_lin)){
		if($pdf->y>170){
			$pdf->AddPage('L');			
			$yfinal=14;
		}
		$pdf->y=$yfinal;
		$yorigen=$pdf->y;
		$pdf->SetFont('Arial','',6);
		$pdf->SetTextColor(0);
		$pdf->Cell(4,4,$n_lin,0,0,'R');
		$n_lin++;
		$pdf->SetFont('Arial','',7);
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
		$pdf->Cell(8,4,$oe_codigo,0,0,'C');
		$yfinal=$pdf->y;
		if(strpos($row_lin['obj_descripcion'],'<strong>')==0){
			$obj_descripcion=str_replace('<strong>','',$row_lin['obj_descripcion']);
			$obj_descripcion=str_replace('</strong>','',$obj_descripcion);
			$pdf->MultiCell(90,4,$obj_descripcion);
		}else{
			$pdf->MultiCell(95,4,$row_lin['obj_descripcion']);
		}
		if($pdf->y>$yfinal){
			$yfinal=$pdf->y;
		}
		$pdf->x=117;
		$pdf->y=$yorigen;
		$pdf->MultiCell(12,4,$row_lin['ind_codigo']);
		if($pdf->y>$yfinal){
			$yfinal=$pdf->y;
		}
		$pdf->x=129;
		$pdf->y=$yorigen;
		$pdf->MultiCell(95,4,$row_lin['ind_nombre']);
		if($pdf->y>$yfinal){
			$yfinal=$pdf->y;
		}
		$pdf->x=224;
		$pdf->y=$yorigen;
		$pdf->MultiCell(13,4,number_format($row_lin['oa_meta'],2,',','.'));
		if($pdf->y>$yfinal){
			$yfinal=$pdf->y;
		}
		$pdf->x=237;
		$pdf->y=$yorigen;
		if($row_lin['ind_meta_un_abreviatura']=='&euro;'){
			$ind_meta_un_abreviatura='€';
		}else{
			$ind_meta_un_abreviatura=$row_lin['ind_meta_un_abreviatura'];
		}
		$pdf->MultiCell(8,4,$ind_meta_un_abreviatura);
		if($pdf->y>$yfinal){
			$yfinal=$pdf->y;
		}
		$pdf->x=245;
		$pdf->y=$yorigen;
		$pdf->MultiCell(13,4,number_format($row_lin['oa_horquilla_min'],2,',','.'));
		if($pdf->y>$yfinal){
			$yfinal=$pdf->y;
		}
		$pdf->x=258;
		$pdf->y=$yorigen;
		$pdf->MultiCell(13,4,number_format($row_lin['oa_horquilla_max'],2,',','.'));
		if($pdf->y>$yfinal){
			$yfinal=$pdf->y;
		}
		$pdf->x=271;
		$pdf->y=$yorigen;
		$pdf->MultiCell(8,4,$row_lin['ind_horq_un_abreviatura']);
		if($pdf->y>$yfinal){
			$yfinal=$pdf->y;
		}
		$pdf->x=279;
		$pdf->y=$yorigen;
		$pdf->MultiCell(0,4,number_format($row_lin['dl_peso'],2,',','.'));
		if($pdf->y>$yfinal){
			$yfinal=$pdf->y;
		}
		$altura=$yfinal-$yorigen;
		$pdf->y=$yorigen;
		$pdf->Cell(4,$altura,'',1);
		$pdf->x=14;
		$pdf->y=$yorigen;
		$pdf->Cell(8,$altura,'',1);
		$pdf->x=22;
		$pdf->y=$yorigen;
		$pdf->Cell(95,$altura,'',1);
		$pdf->x=117;
		$pdf->y=$yorigen;
		$pdf->Cell(12,$altura,'',1);
		$pdf->x=129;
		$pdf->y=$yorigen;
		$pdf->Cell(95,$altura,'',1);
		$pdf->x=224;
		$pdf->y=$yorigen;
		$pdf->SetFillColor(180,253,180);
		$pdf->Cell(13,$altura,number_format($row_lin['oa_meta'],2,',','.'),1,0,'R',true);
		$pdf->x=237;
		$pdf->y=$yorigen;
		$pdf->Cell(8,$altura,$row_lin['ind_meta_un_abreviatura'],1,0,'R',true);
		$pdf->x=245;
		$pdf->y=$yorigen;
		$pdf->SetFillColor(231,229,227);
		$pdf->Cell(13,$altura,number_format($row_lin['oa_horquilla_min'],2,',','.'),1,0,'R',true);
		$pdf->x=258;
		$pdf->y=$yorigen;
		$pdf->Cell(13,$altura,number_format($row_lin['oa_horquilla_max'],2,',','.'),1,0,'R',true);
		$pdf->x=271;
		$pdf->y=$yorigen;
		$pdf->Cell(8,$altura,$row_lin['ind_horq_un_abreviatura'],1,0,'R',true);
		$pdf->x=279;
		$pdf->SetFillColor(184,184,112);
		$pdf->y=$yorigen;
		$pdf->Cell(0,$altura,number_format($row_lin['dl_peso'],2,',','.'),1,1,'R',true);
 }
$query_lin="SELECT * FROM vdpo_lineas WHERE dl_dpo_id=".$row['dpo_id']." AND (obj_tipo LIKE 'Para el Comité de Dirección' OR obj_tipo LIKE 'Mandos Intermedios') ORDER BY dl_peso DESC, obj_descripcion ASC";
		$result_lin=mysql_query($query_lin) or die ("No se puede ejecutar la sentencia: ".$query_lin);
		$num_lin=mysql_num_rows($result_lin);
		if($num_lin){
	$pdf->SetFont('Arial','B',8);
	$pdf->SetTextColor(255);
	$pdf->SetFillColor(0);
		if($row['usr_categoria']=='Dirección'){
          $tipo="A nivel de comité de dirección";
           }else{
          $tipo="A nivel de Mandos Intermedios";
          }
	$pdf->Cell(200,4,$tipo,0,0,'L',true);
	$pdf->Cell(0,4,$peso['Para el Comité de Dirección']+$peso['Mandos Intermedios'].' %',0,1,'R',true);
	$pdf->SetFillColor(120);
	$pdf->Cell(4,4,'',0,0,'C',true);
	$pdf->Cell(8,4,'OE',0,0,'C',true);
	$pdf->Cell(95,4,'Objetivo',0,0,'L',true);
	$pdf->Cell(12,4,'C.I.',0,0,'C',true);
	$pdf->Cell(95,4,'Indicador',0,0,'L',true);
	$pdf->Cell(13,4,'Meta',0,0,'C',true);
	$pdf->Cell(8,4,'Un',0,0,'C',true);
	$pdf->Cell(26,4,'Horquilla',0,0,'C',true);
	$pdf->Cell(8,4,'Un',0,0,'C',true);
	$pdf->Cell(0,4,'Peso',0,1,'C',true);
	$yfinal=$pdf->y;
}
	while($row_lin=mysql_fetch_array($result_lin)){
		if($pdf->y>170){
			$pdf->AddPage('L');			
			$yfinal=14;
		}
		$pdf->y=$yfinal;
		$yorigen=$pdf->y;
		$pdf->SetFont('Arial','',6);
		$pdf->SetTextColor(0);
		$pdf->Cell(4,4,$n_lin,0,0,'R');
		$n_lin++;
		$pdf->SetFont('Arial','',7);
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
		$pdf->Cell(8,4,$oe_codigo,0,0,'C');
		$yfinal=$pdf->y;
		if(strpos($row_lin['obj_descripcion'],'<strong>')==0){
			$obj_descripcion=str_replace('<strong>','',$row_lin['obj_descripcion']);
			$obj_descripcion=str_replace('</strong>','',$obj_descripcion);
			$pdf->MultiCell(90,4,$obj_descripcion);
		}else{
			$pdf->MultiCell(95,4,$row_lin['obj_descripcion']);
		}
		if($pdf->y>$yfinal){
			$yfinal=$pdf->y;
		}
		$pdf->x=117;
		$pdf->y=$yorigen;
		$pdf->MultiCell(12,4,$row_lin['ind_codigo']);
		if($pdf->y>$yfinal){
			$yfinal=$pdf->y;
		}
		$pdf->x=129;
		$pdf->y=$yorigen;
		$pdf->MultiCell(95,4,$row_lin['ind_nombre']);
		if($pdf->y>$yfinal){
			$yfinal=$pdf->y;
		}
		$pdf->x=224;
		$pdf->y=$yorigen;
		$pdf->MultiCell(13,4,number_format($row_lin['oa_meta'],2,',','.'));
		if($pdf->y>$yfinal){
			$yfinal=$pdf->y;
		}
		$pdf->x=237;
		$pdf->y=$yorigen;
		if($row_lin['ind_meta_un_abreviatura']=='&euro;'){
			$ind_meta_un_abreviatura='€';
		}else{
			$ind_meta_un_abreviatura=$row_lin['ind_meta_un_abreviatura'];
		}
		$pdf->MultiCell(8,4,$ind_meta_un_abreviatura);
		if($pdf->y>$yfinal){
			$yfinal=$pdf->y;
		}
		$pdf->x=245;
		$pdf->y=$yorigen;
		$pdf->MultiCell(13,4,number_format($row_lin['oa_horquilla_min'],2,',','.'));
		if($pdf->y>$yfinal){
			$yfinal=$pdf->y;
		}
		$pdf->x=258;
		$pdf->y=$yorigen;
		$pdf->MultiCell(13,4,number_format($row_lin['oa_horquilla_max'],2,',','.'));
		if($pdf->y>$yfinal){
			$yfinal=$pdf->y;
		}
		$pdf->x=271;
		$pdf->y=$yorigen;
		$pdf->MultiCell(8,4,$row_lin['ind_horq_un_abreviatura']);
		if($pdf->y>$yfinal){
			$yfinal=$pdf->y;
		}
		$pdf->x=279;
		$pdf->y=$yorigen;
		$pdf->MultiCell(0,4,number_format($row_lin['dl_peso'],2,',','.'));
		if($pdf->y>$yfinal){
			$yfinal=$pdf->y;
		}
		$altura=$yfinal-$yorigen;
		$pdf->y=$yorigen;
		$pdf->Cell(4,$altura,'',1);
		$pdf->x=14;
		$pdf->y=$yorigen;
		$pdf->Cell(8,$altura,'',1);
		$pdf->x=22;
		$pdf->y=$yorigen;
		$pdf->Cell(95,$altura,'',1);
		$pdf->x=117;
		$pdf->y=$yorigen;
		$pdf->Cell(12,$altura,'',1);
		$pdf->x=129;
		$pdf->y=$yorigen;
		$pdf->Cell(95,$altura,'',1);
		$pdf->x=224;
		$pdf->y=$yorigen;
		$pdf->SetFillColor(180,253,180);
		$pdf->Cell(13,$altura,number_format($row_lin['oa_meta'],2,',','.'),1,0,'R',true);
		$pdf->x=237;
		$pdf->y=$yorigen;
		$pdf->Cell(8,$altura,$row_lin['ind_meta_un_abreviatura'],1,0,'R',true);
		$pdf->x=245;
		$pdf->y=$yorigen;
		$pdf->SetFillColor(231,229,227);
		$pdf->Cell(13,$altura,number_format($row_lin['oa_horquilla_min'],2,',','.'),1,0,'R',true);
		$pdf->x=258;
		$pdf->y=$yorigen;
		$pdf->Cell(13,$altura,number_format($row_lin['oa_horquilla_max'],2,',','.'),1,0,'R',true);
		$pdf->x=271;
		$pdf->y=$yorigen;
		$pdf->Cell(8,$altura,$row_lin['ind_horq_un_abreviatura'],1,0,'R',true);
		$pdf->x=279;
		$pdf->SetFillColor(184,184,112);
		$pdf->y=$yorigen;
		$pdf->Cell(0,$altura,number_format($row_lin['dl_peso'],2,',','.'),1,1,'R',true);
 }
		$query_lin="SELECT * FROM vdpo_lineas WHERE dl_dpo_id=".$row['dpo_id']." AND (obj_tipo LIKE '".utf8_decode('de departamento')."' OR obj_tipo LIKE '".utf8_decode('Proyectos')."') ORDER BY dl_peso DESC, obj_descripcion ASC";
		$result_lin=mysql_query($query_lin) or die ("No se puede ejecutar la sentencia: ".$query_lin);
		$num_lin=mysql_num_rows($result_lin);
if($num_lin){
	$pdf->SetFont('Arial','B',8);
	$pdf->SetTextColor(255);
	$pdf->SetFillColor(0);
	$pdf->Cell(200,4,'A nivel Departamental',0,0,'L',true);
	$pdf->Cell(0,4,$peso['de departamento']+$peso['Proyectos'].' %',0,1,'R',true);
	$pdf->SetFillColor(120);
	$pdf->Cell(4,4,'',0,0,'C',true);
	$pdf->Cell(8,4,'OE',0,0,'C',true);
	$pdf->Cell(95,4,'Objetivo',0,0,'L',true);
	$pdf->Cell(12,4,'C.I.',0,0,'C',true);
	$pdf->Cell(95,4,'Indicador',0,0,'L',true);
	$pdf->Cell(13,4,'Meta',0,0,'C',true);
	$pdf->Cell(8,4,'Un',0,0,'C',true);
	$pdf->Cell(26,4,'Horquilla',0,0,'C',true);
	$pdf->Cell(8,4,'Un',0,0,'C',true);
	$pdf->Cell(0,4,'Peso',0,1,'C',true);
	$yfinal=$pdf->y;
}
	while($row_lin=mysql_fetch_array($result_lin)){		
		if($pdf->y>170){
			$pdf->AddPage('L');			
			$yfinal=14;
		}
		$pdf->y=$yfinal;
		$yorigen=$pdf->y;
		$pdf->SetFont('Arial','',6);
		$pdf->SetTextColor(0);
		$pdf->Cell(4,4,$n_lin,0,0,'R');
		$n_lin++;
		$pdf->SetFont('Arial','',7);
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
		$pdf->Cell(8,4,$oe_codigo,0,0,'C');
		$yfinal=$pdf->y;
		if(strpos($row_lin['obj_descripcion'],'<strong>')==0){
			$obj_descripcion=str_replace('<strong>','',$row_lin['obj_descripcion']);
			$obj_descripcion=str_replace('</strong>','',$obj_descripcion);
			$pdf->MultiCell(90,4,$obj_descripcion);
		}else{
			$pdf->MultiCell(95,4,$row_lin['obj_descripcion']);
		}
		if($pdf->y>$yfinal){
			$yfinal=$pdf->y;
		}
		$pdf->x=117;
		$pdf->y=$yorigen;
		$pdf->MultiCell(12,4,$row_lin['ind_codigo']);
		if($pdf->y>$yfinal){
			$yfinal=$pdf->y;
		}
		$pdf->x=129;
		$pdf->y=$yorigen;
		$pdf->MultiCell(95,4,$row_lin['ind_nombre']);
		if($pdf->y>$yfinal){
			$yfinal=$pdf->y;
		}
		$pdf->x=224;
		$pdf->y=$yorigen;
		$pdf->MultiCell(13,4,number_format($row_lin['oa_meta'],2,',','.'));
		if($pdf->y>$yfinal){
			$yfinal=$pdf->y;
		}
		$pdf->x=237;
		$pdf->y=$yorigen;
		if($row_lin['ind_meta_un_abreviatura']=='&euro;'){
			$ind_meta_un_abreviatura='€';
		}else{
			$ind_meta_un_abreviatura=$row_lin['ind_meta_un_abreviatura'];
		}
		$pdf->MultiCell(8,4,$ind_meta_un_abreviatura);
		if($pdf->y>$yfinal){
			$yfinal=$pdf->y;
		}
		$pdf->x=245;
		$pdf->y=$yorigen;
		$pdf->MultiCell(13,4,number_format($row_lin['oa_horquilla_min'],2,',','.'));
		if($pdf->y>$yfinal){
			$yfinal=$pdf->y;
		}
		$pdf->x=258;
		$pdf->y=$yorigen;
		$pdf->MultiCell(13,4,number_format($row_lin['oa_horquilla_max'],2,',','.'));
		if($pdf->y>$yfinal){
			$yfinal=$pdf->y;
		}
		$pdf->x=271;
		$pdf->y=$yorigen;
		$pdf->MultiCell(8,4,$row_lin['ind_horq_un_abreviatura']);
		if($pdf->y>$yfinal){
			$yfinal=$pdf->y;
		}
		$pdf->x=279;
		$pdf->y=$yorigen;
		$pdf->MultiCell(0,4,number_format($row_lin['dl_peso'],2,',','.'));
		if($pdf->y>$yfinal){
			$yfinal=$pdf->y;
		}
		$altura=$yfinal-$yorigen;
		$pdf->y=$yorigen;
		$pdf->Cell(4,$altura,'',1);
		$pdf->x=14;
		$pdf->y=$yorigen;
		$pdf->Cell(8,$altura,'',1);
		$pdf->x=22;
		$pdf->y=$yorigen;
		$pdf->Cell(95,$altura,'',1);
		$pdf->x=117;
		$pdf->y=$yorigen;
		$pdf->Cell(12,$altura,'',1);
		$pdf->x=129;
		$pdf->y=$yorigen;
		$pdf->Cell(95,$altura,'',1);
		$pdf->x=224;
		$pdf->y=$yorigen;
		$pdf->SetFillColor(180,253,180);
		$pdf->Cell(13,$altura,number_format($row_lin['oa_meta'],2,',','.'),1,0,'R',true);
		$pdf->x=237;
		$pdf->y=$yorigen;
		$pdf->Cell(8,$altura,$row_lin['ind_meta_un_abreviatura'],1,0,'R',true);
		$pdf->x=245;
		$pdf->y=$yorigen;
		$pdf->SetFillColor(231,229,227);
		$pdf->Cell(13,$altura,number_format($row_lin['oa_horquilla_min'],2,',','.'),1,0,'R',true);
		$pdf->x=258;
		$pdf->y=$yorigen;
		$pdf->Cell(13,$altura,number_format($row_lin['oa_horquilla_max'],2,',','.'),1,0,'R',true);
		$pdf->x=271;
		$pdf->y=$yorigen;
		$pdf->Cell(8,$altura,$row_lin['ind_horq_un_abreviatura'],1,0,'R',true);
		$pdf->x=279;
		$pdf->SetFillColor(184,184,112);
		$pdf->y=$yorigen;
		$pdf->Cell(0,$altura,number_format($row_lin['dl_peso'],2,',','.'),1,1,'R',true);
 }
$query_lin="SELECT * FROM vdpo_lineas WHERE dl_dpo_id=".$row['dpo_id']." AND obj_tipo LIKE '".utf8_decode('Personal')."' ORDER BY dl_peso DESC, obj_descripcion ASC";
$result_lin=mysql_query($query_lin) or die ("No se puede ejecutar la sentencia: ".$query_lin);
$num_lin=mysql_num_rows($result_lin);
if($num_lin){
	$pdf->SetFont('Arial','B',8);
	$pdf->SetTextColor(255);
	$pdf->SetFillColor(0);
	$pdf->Cell(200,4,'A nivel Personal',0,0,'L',true);
	$pdf->Cell(0,4,$peso['Personal'].' %',0,1,'R',true);
	$pdf->SetFillColor(120);
	$pdf->Cell(4,4,'',0,0,'C',true);
	$pdf->Cell(8,4,'OE',0,0,'C',true);
	$pdf->Cell(95,4,'Objetivo',0,0,'L',true);
	$pdf->Cell(12,4,'C.I.',0,0,'C',true);
	$pdf->Cell(95,4,'Indicador',0,0,'L',true);
	$pdf->Cell(13,4,'Meta',0,0,'C',true);
	$pdf->Cell(8,4,'Un',0,0,'C',true);
	$pdf->Cell(26,4,'Horquilla',0,0,'C',true);
	$pdf->Cell(8,4,'Un',0,0,'C',true);
	$pdf->Cell(0,4,'Peso',0,1,'C',true);
	$yfinal=$pdf->y;
}
	while($row_lin=mysql_fetch_array($result_lin)){
		if($pdf->y>170){
			$pdf->AddPage('L');			
			$yfinal=14;
		}
		$pdf->y=$yfinal;
		$yorigen=$pdf->y;
		$pdf->SetFont('Arial','',6);
		$pdf->SetTextColor(0);
		$pdf->Cell(4,4,$n_lin,0,0,'R');
		$n_lin++;
		$pdf->SetFont('Arial','',7);
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
		$pdf->Cell(8,4,$oe_codigo,0,0,'C');
		$yfinal=$pdf->y;
		if(strpos($row_lin['obj_descripcion'],'<strong>')==0){
			$obj_descripcion=str_replace('<strong>','',$row_lin['obj_descripcion']);
			$obj_descripcion=str_replace('</strong>','',$obj_descripcion);
			$pdf->MultiCell(90,4,$obj_descripcion);
		}else{
			$pdf->MultiCell(95,4,$row_lin['obj_descripcion']);
		}
		if($pdf->y>$yfinal){
			$yfinal=$pdf->y;
		}
		$pdf->x=117;
		$pdf->y=$yorigen;
		$pdf->MultiCell(12,4,$row_lin['ind_codigo']);
		if($pdf->y>$yfinal){
			$yfinal=$pdf->y;
		}
		$pdf->x=129;
		$pdf->y=$yorigen;
		$pdf->MultiCell(95,4,$row_lin['ind_nombre']);
		if($pdf->y>$yfinal){
			$yfinal=$pdf->y;
		}
		$pdf->x=224;
		$pdf->y=$yorigen;
		$pdf->MultiCell(13,4,number_format($row_lin['oa_meta'],2,',','.'));
		if($pdf->y>$yfinal){
			$yfinal=$pdf->y;
		}
		$pdf->x=237;
		$pdf->y=$yorigen;
		if($row_lin['ind_meta_un_abreviatura']=='&euro;'){
			$ind_meta_un_abreviatura='€';
		}else{
			$ind_meta_un_abreviatura=$row_lin['ind_meta_un_abreviatura'];
		}
		$pdf->MultiCell(8,4,$ind_meta_un_abreviatura);
		if($pdf->y>$yfinal){
			$yfinal=$pdf->y;
		}
		$pdf->x=245;
		$pdf->y=$yorigen;
		$pdf->MultiCell(13,4,number_format($row_lin['oa_horquilla_min'],2,',','.'));
		if($pdf->y>$yfinal){
			$yfinal=$pdf->y;
		}
		$pdf->x=258;
		$pdf->y=$yorigen;
		$pdf->MultiCell(13,4,number_format($row_lin['oa_horquilla_max'],2,',','.'));
		if($pdf->y>$yfinal){
			$yfinal=$pdf->y;
		}
		$pdf->x=271;
		$pdf->y=$yorigen;
		$pdf->MultiCell(8,4,$row_lin['ind_horq_un_abreviatura']);
		if($pdf->y>$yfinal){
			$yfinal=$pdf->y;
		}
		$pdf->x=279;
		$pdf->y=$yorigen;
		$pdf->MultiCell(0,4,number_format($row_lin['dl_peso'],2,',','.'));
		if($pdf->y>$yfinal){
			$yfinal=$pdf->y;
		}
		$altura=$yfinal-$yorigen;
		$pdf->y=$yorigen;
		$pdf->Cell(4,$altura,'',1);
		$pdf->x=14;
		$pdf->y=$yorigen;
		$pdf->Cell(8,$altura,'',1);
		$pdf->x=22;
		$pdf->y=$yorigen;
		$pdf->Cell(95,$altura,'',1);
		$pdf->x=117;
		$pdf->y=$yorigen;
		$pdf->Cell(12,$altura,'',1);
		$pdf->x=129;
		$pdf->y=$yorigen;
		$pdf->Cell(95,$altura,'',1);
		$pdf->x=224;
		$pdf->y=$yorigen;
		$pdf->SetFillColor(180,253,180);
		$pdf->Cell(13,$altura,number_format($row_lin['oa_meta'],2,',','.'),1,0,'R',true);
		$pdf->x=237;
		$pdf->y=$yorigen;
		$pdf->Cell(8,$altura,$row_lin['ind_meta_un_abreviatura'],1,0,'R',true);
		$pdf->x=245;
		$pdf->y=$yorigen;
		$pdf->SetFillColor(231,229,227);
		$pdf->Cell(13,$altura,number_format($row_lin['oa_horquilla_min'],2,',','.'),1,0,'R',true);
		$pdf->x=258;
		$pdf->y=$yorigen;
		$pdf->Cell(13,$altura,number_format($row_lin['oa_horquilla_max'],2,',','.'),1,0,'R',true);
		$pdf->x=271;
		$pdf->y=$yorigen;
		$pdf->Cell(8,$altura,$row_lin['ind_horq_un_abreviatura'],1,0,'R',true);
		$pdf->x=279;
		$pdf->SetFillColor(184,184,112);
		$pdf->y=$yorigen;
		$pdf->Cell(0,$altura,number_format($row_lin['dl_peso'],2,',','.'),1,1,'R',true);
 }
	if($pdf->y>170){
		$pdf->AddPage('L');			
		$yfinal=14;
	}
	$pdf->SetFont('Arial','B',8);
	$pdf->SetTextColor(255);
	$pdf->SetFillColor(0);
	$pdf->Cell(200,4,'TOTAL',0,0,'L',true);
	$pdf->Cell(0,4,$peso['total'].' %',0,1,'R',true);

/*	$pdf->AddPage('L');
	$pdf->SetFont('Arial','B',8);
	$pdf->SetTextColor(255);
	$pdf->SetFillColor(0);
	$pdf->Cell(0,4,'Enero-Marzo',0,1,'L',true);
	$pdf->SetFillColor(120);
    $query_com="SELECT * FROM dpo_comentarios WHERE com_dpo_id=".$dpo_id." AND com_periodo='Enero-Marzo' ORDER BY com_n_lin ASC";
    $result_com=mysql_query($query_com) or die ("No se puede ejecutar la consulta: ".$query_com);
	while($row_com=mysql_fetch_array($result_com)){
		$pdf->SetFont('Arial','',7);
		$pdf->SetTextColor(0);
		$pdf->MultiCell(0,4,$row_com['com_n_lin'].'. '.$row_com['com_comentario'],1);
	}
	$pdf->SetFont('Arial','B',8);
	$pdf->SetTextColor(255);
	$pdf->SetFillColor(0);
	$pdf->Cell(0,4,'Abril-Junio',0,1,'L',true);
	$pdf->SetFillColor(120);
    $query_com="SELECT * FROM dpo_comentarios WHERE com_dpo_id=".$dpo_id." AND com_periodo='Abril-Junio' ORDER BY com_n_lin ASC";
    $result_com=mysql_query($query_com) or die ("No se puede ejecutar la consulta: ".$query_com);
	while($row_com=mysql_fetch_array($result_com)){
		$pdf->SetFont('Arial','',7);
		$pdf->SetTextColor(0);
		$pdf->MultiCell(0,4,$row_com['com_n_lin'].'. '.$row_com['com_comentario'],1);
	}
	$pdf->SetFont('Arial','B',8);
	$pdf->SetTextColor(255);
	$pdf->SetFillColor(0);
	$pdf->Cell(0,4,'Julio-Septiembre',0,1,'L',true);
	$pdf->SetFillColor(120);
    $query_com="SELECT * FROM dpo_comentarios WHERE com_dpo_id=".$dpo_id." AND com_periodo='Julio-Septiembre' ORDER BY com_n_lin ASC";
    $result_com=mysql_query($query_com) or die ("No se puede ejecutar la consulta: ".$query_com);
	while($row_com=mysql_fetch_array($result_com)){
		$pdf->SetFont('Arial','',7);
		$pdf->SetTextColor(0);
		$pdf->MultiCell(0,4,$row_com['com_n_lin'].'. '.$row_com['com_comentario'],1);
	}
	$pdf->SetFont('Arial','B',8);
	$pdf->SetTextColor(255);
	$pdf->SetFillColor(0);
	$pdf->Cell(0,4,'Octubre-Diciembre',0,1,'L',true);
	$pdf->SetFillColor(120);
    $query_com="SELECT * FROM dpo_comentarios WHERE com_dpo_id=".$dpo_id." AND com_periodo='Octubre-Diciembre' ORDER BY com_n_lin ASC";
    $result_com=mysql_query($query_com) or die ("No se puede ejecutar la consulta: ".$query_com);
	while($row_com=mysql_fetch_array($result_com)){
		$pdf->SetFont('Arial','',7);
		$pdf->SetTextColor(0);
		$pdf->MultiCell(0,4,$row_com['com_n_lin'].'. '.$row_com['com_comentario'],1);
	}
*/$pdf->Output();
?>

