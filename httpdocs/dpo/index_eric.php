<?php 
session_start();
include("../login/sesion_start.php");
include("../librerias/librerias.php");
include("../cabecera.php");
$conn=db_connect();
$dpo_ano=$_SESSION['ano'];
if($_SESSION['usr_id']){
	$dpo_usr_id=$_SESSION['usr_id'];
}
if($_SESSION['usr_id']==129){
	$dpo_usr_id=64;
}
if($_SESSION['usr_perfil']=='Director General' or $_SESSION['usr_perfil']=='Administrador'){
	$query_dpo="SELECT * FROM dpo_cabeceras WHERE dpo_ano=".$dpo_ano." ORDER BY dpo_usr_id ASC";
	$result_dpo=mysql_query($query_dpo) or die ("No se puede ejecutar la sentencia: ".$query_dpo);
	$row_dpo=mysql_fetch_array($result_dpo);
	$dpo_usr_id=$row_dpo['dpo_usr_id'];
}


if($_GET['dpo_id']){
	$query_dpo="SELECT * FROM dpo_cabeceras WHERE dpo_id=".$_GET['dpo_id'];
	$result_dpo=mysql_query($query_dpo) or die ("No se puede ejecutar la sentencia: ".$query_dpo);
	$row_dpo=mysql_fetch_array($result_dpo);
	$dpo_usr_id=$row_dpo['dpo_usr_id'];
}



$valor_sim=$_POST['valor_sim'];
if($_POST['filtrar'] or $_POST['simular']){
	if($_POST['dpo_usr_id']){
		$dpo_usr_id=$_POST['dpo_usr_id'];
	}
}

echo "el identificador es: ".$dpo_usr_id;
echo "usr_perfil es: ".$_SESSION['usr_perfil'];


$query="SELECT * FROM vdpo_cabeceras WHERE dpo_ano=".$dpo_ano." AND dpo_usr_id=".$dpo_usr_id;
$result=mysql_query($query) or die ("No se puede ejecutar la sentencia: ".$query);
$row=mysql_fetch_array($result);
$query_lin="SELECT * FROM vdpo_lineas WHERE dl_dpo_id=".$row['dpo_id'];
$result_lin=mysql_query($query_lin) or die ("No se puede ejecutar la sentencia1: ".$query_lin);
while($row_lin=mysql_fetch_array($result_lin)){
	$peso[utf8_encode($row_lin['obj_tipo'])]+=$row_lin['dl_peso'];
	$peso['total']+=$row_lin['dl_peso'];
}
$total_q1=0;
$total_q2=0;
$total_q3=0;
$total_q4=0;
$total_anual=0;


?>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<div id="content">
  <div class="cabecera_apartados">
    <div class="filtros">
      <form method="post" action="#">
        <table align="center" width="100%">
        <tr>
          <td colspan="7">DPO de <?php echo utf8_encode($row['usr_nombre']." ".$row['usr_apellidos']);?> (<?php echo $dpo_ano;?>)</td>
        <tr>
<!--          <td class="texto_10"><?php if($_SESSION['usr_perfil']=='Director RRHH'){?><input type="button" onClick="document.location.href = '../dpo_creacion/'" value="Crear DPO" class="texto_10" ><?php };?></td>


-->          <td class="texto_10"><input type="button" onClick="window.open('imprimir_dpo.php?dpo_id=<?php echo $row['dpo_id'];?>','_newtab')" value="Imprimir DPO" class="texto_10" ></td>
          <td class="texto_10"><input type="button" onClick="window.open('export-excel.php?dpo_id=<?php echo $row['dpo_id'];?>','_newtab')" value="Excel DPO" class="texto_10" ></td>
          <td class="texto_10"><input type="button" onClick="window.open('imprimir_dpo_consecucion.php?dpo_id=<?php echo $row['dpo_id'];?>&valor_sim=<?php echo $valor_sim;  ?>','_newtab')" value="Imprimir consecución" class="texto_10" ></td>
          <td class="texto_10">Valor:&nbsp;
            <input type="text" name="valor_sim" id="valor_sim" value="<?php echo $valor_sim;?>" class="texto_10" style="width:50px;">
            <input type="hidden" name="dpo_usr_id" id="dpo_usr_id" value="<?php echo $dpo_usr_id;?>">
            &nbsp;
            <input type="submit" name="simular" id="simular" value="Simular" class="texto_10"/></td>
          <td style="background-color:#999999; width:195px;"></td>
          <td class="texto_10"> Colaborador:
            <select name="dpo_usr_id" id="dpo_usr_id" class="texto_10">
              <?php 
						
				
				if($_SESSION['usr_perfil']=='Director General' or $_SESSION['usr_perfil']=='Administrador' or $_SESSION['usr_perfil']=='Director RRHH')
					
				{
					$query_usr="SELECT * FROM usuarios WHERE usr_baja=0 AND (usr_perfil='Usuario' OR usr_perfil='Director RRHH') ORDER BY usr_apellidos, usr_nombre ASC";
					$result_usr=mysql_query($query_usr) or die ("No se puede ejecutar la sentencia: ".$query_usr);
					
					while($row_usr=mysql_fetch_array($result_usr)){
						$query_dpo="SELECT * FROM dpo_cabeceras WHERE dpo_usr_id=".$row_usr['usr_id']." AND dpo_ano=".$dpo_ano;
						$result_dpo=mysql_query($query_dpo) or die ("No se puede ejecutar la sentencia: ".$query_dpo);
						$num_dpo=mysql_num_rows($result_dpo);
						if($num_dpo){?>
              <option value="<?php echo $row_usr['usr_id'];?>"<?php if($row_usr['usr_id']==$dpo_usr_id){?> selected="selected"<?php }?>><?php echo utf8_encode($row_usr['usr_apellidos'].", ".$row_usr['usr_nombre']);?></option>
              <?php 		}
					}
				}
				else
				{		
					$query_usr="SELECT * FROM usuarios WHERE usr_baja=0 AND (usr_perfil='Usuario' OR usr_perfil='Director RRHH') ORDER BY usr_apellidos, usr_nombre ASC";
					
					$result_usr=mysql_query($query_usr) or die ("No se puede ejecutar la sentencia: ".$query_usr);
					
					while($row_usr=mysql_fetch_array($result_usr)){
						if($row_usr['usr_id']==$_SESSION['usr_id']){?>
              <option value="<?php echo $row_usr['usr_id'];?>"<?php if($row_usr['usr_id']==$dpo_usr_id){?> selected="selected"<?php }?>><?php echo utf8_encode($row_usr['usr_apellidos'].", ".$row_usr['usr_nombre']);?></option>
              <?php  }else{
						$es_superior=false;
						$superior=$row_usr['usr_superior_id'];
						
						if($superior==$_SESSION['usr_id']){
							$es_superior=true;
						}
						while($superior<>'130' and $es_superior==false and $superior<>''){
							
							$query_usr2="SELECT * FROM usuarios WHERE usr_id=".$superior;
							
							$result_usr2=mysql_query($query_usr2) or die ("No se puede ejecutar la sentencia: ".$query_usr2);
							$row_usr2=mysql_fetch_array($result_usr2);
							$superior=$row_usr2['usr_superior_id'];
							if($superior==$_SESSION['usr_id']){
								$es_superior=true;
							} 
						}
						
						if($es_superior){
							
							//$query_dpo="SELECT * FROM dpo_cabeceras WHERE dpo_usr_id=".$row_usr['usr_id']." AND dpo_ano=".$dpo_ano;
							$query_dpo="SELECT * FROM vdpo_cabeceras WHERE usr_superior_id=".$superior." AND dpo_ano=".$dpo_ano;
													
							$result_dpo=mysql_query($query_dpo) or die ("No se puede ejecutar la sentencia: ".$query_dpo);
							
							
							$num_dpo=mysql_num_rows($result_dpo);
							
							if($num_dpo){  
							while($row_usr=mysql_fetch_array($result_usr)){?>
							
							  <option value="<?php echo $row_usr['usr_id'];?>"<?php if($row_usr['usr_id']==$dpo_usr_id){?> selected="selected"<?php }?>><?php echo utf8_encode($row_usr['usr_apellidos'].", ".$row_usr['usr_nombre']);?></option>
							  <?php 	}
							}
						}
					}}
                }  ?>
            </select></td>
               <td><input type="submit" name="filtrar" id="filtrar" value="Filtrar" class="texto_10"/></td>
          <!--            <td><input name="reset" type="submit" id="reset" value="Resetear" class="texto_10" /></td>
--> </tr>
      </form>
      </table>
    </div>
  </div>
  <div class="tabla_dpo">
    <table width="100%">
		
      <form action="modify.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="dpo_id" value="<?php echo $row['dpo_id'];?>" />
		  <input value="<?php echo $superior; ?>">
        <?php
		  
	   	$n_lin=1;
		 echo "1"; 
		  
		$query_lin="SELECT * FROM vdpo_lineas WHERE dl_dpo_id=".$row['dpo_id']." AND obj_tipo LIKE '".utf8_decode('Objetivo de compañia')."' ORDER BY dl_peso DESC, obj_descripcion ASC";
		  	  
		  echo "2";
		  
		$result_lin=mysql_query($query_lin) or die ("No se puede ejecutar la sentencia: ".$query_lin);
		$num_lin=mysql_num_rows($result_lin);
		  
		if($num_lin){?>
        <tr class="titulo_grupo">
          <td colspan="10" style="text-align:left;">A nivel de compañia</td>
          <td colspan="2" class="numerica"><?php echo $peso['Objetivo de Compañía']." %";?></td>
          <td class="titulo_grupo celdas_subtotal"></td>
          <td colspan="4">Val. trimestral</td>
          <td>Punt.</td>
          <td></td>
          <td></td>
        </tr>
        <tr class="titulo_dpo">
          <td></td>
          <td>OE</td>
          <td>Objetivo</td>
          <td>Cód. In.</td>
          <td>Indicador</td>
          <td>Meta</td>
          <td>Un.</td>
          <td class="titulo_grupo celdas_subtotal"></td>
          <td colspan="2">Horquilla</td>
          <td>P.</td>
          <td class="titulo_grupo celdas_subtotal"></td>
          <td>&nbsp;</td>
          <td>T1</td>
          <td>T2</td>
          <td>T3</td>
          <td>T4</td>
          <td>Final</td>
          <td colspan="2">Simulación</td>
        </tr>
        <?php while($row_lin=mysql_fetch_array($result_lin)){?>
        <tr class="filas_subtotal">
          <td class="num_lin"><?php echo $n_lin; $n_lin++;?></td>
          <td class="celdas_subtotal"><?php 
					$query_ooe="SELECT * FROM vobjetivos_objetivos_estrategicos WHERE ooe_obj_id=".$row_lin['ind_obj_id']." ORDER BY oe_codigo";
					$result_ooe=mysql_query($query_ooe) or die ("No se puede ejecutar la sentencia: ".$query_ooe);
		$num_ooe=mysql_num_rows($result_ooe);
		$n=1;
					while($row_ooe=mysql_fetch_array($result_ooe)){
			$query_oe="SELECT * FROM objetivos_estrategicos WHERE oe_id=".$row_ooe['ooe_oe_id'];
			$result_oe=mysql_query($query_oe) or die ("No se puede ejecutar la sentencia: ".$query_oe);
			$row_oe=mysql_fetch_array($result_oe);
			echo $row_oe['oe_codigo'];
			if($n>0 and $n<$num_ooe){
				if($n==$num_ooe-1){
					echo "y";
				}else{
					echo ",";
				}
			}
			$n++;
					}?></td>
          <td class="celdas_subtotal"><?php if($row_lin['obj_lider_id']==$_SESSION['usr_id'] or $_SESSION['usr_perfil']=='Director RRHH'){?>
            <a href="/objetivos/show.php?obj_id=<?php echo $row_lin['ind_obj_id'];?>&dpo_id=<?php echo $row['dpo_id'];?>">
            <?php }?><?php echo utf8_encode($row_lin['obj_descripcion']);?>
                        <?php if($row_lin['obj_lider_id']==$_SESSION['usr_id'] or $_SESSION['usr_perfil']=='Director RRHH'){?>
            </a>
            <?php }?></td>
          <td class="celdas_subtotal"><?php echo utf8_encode($row_lin['ind_codigo']);?></td>
          <td class="celdas_subtotal"><?php if($row_lin['ind_responsable']==$_SESSION['usr_id'] or $_SESSION['usr_perfil']=='Director RRHH'){?>
            <a href="/medicion_objetivos/show.php?oa_id=<?php echo $row_lin['dl_oa_id'];?>&dpo_id=<?php echo $row['dpo_id'];?>">
            <?php }?>
            <?php if($row_lin['oa_observaciones']){?><img src="/img/ico_info.png" width="12" height="12" title="<?php echo utf8_encode($row_lin['oa_observaciones']);?>"/>&nbsp<?php }?><?php echo utf8_encode($row_lin['ind_nombre']);?>
            <?php if($row_lin['ind_responsable']==$_SESSION['usr_id'] or $_SESSION['usr_perfil']=='Director RRHH'){?>
            </a>
            <?php }?></td>
          <td class="numerica celdas_subtotal celdas_meta"><?php echo number_format($row_lin['oa_meta'],2,',','.');?></td>
          <td class="numerica celdas_subtotal"><?php echo utf8_encode($row_lin['ind_meta_un_abreviatura']);?></td>
          <td class="titulo_grupo"></td>
          <td class="numerica celdas_subtotal"><?php echo number_format($row_lin['oa_horquilla_min'],2,',','.');?></td>
          <td class="numerica celdas_subtotal"><?php echo number_format($row_lin['oa_horquilla_max'],2,',','.');?></td>
          <td class="numerica celdas_subtotal celdas_peso<?php if($row_lin['dl_peso']==0){?> error_peso<?php }?>"><?php echo number_format($row_lin['dl_peso'],1,',','.');?></td>
          <td class="titulo_grupo"></td>
          <td class="numerica celdas_subtotal"><?php if(utf8_encode($row_lin['ind_grupo_individual'])=='Grupo'){?>
            G
            <?php }else{?>
            I
            <?php }?></td>
          <td class="numerica celdas_subtotal"><?php if($row_lin['ind_mide']==$_SESSION['usr_id'] or ($row_lin['ind_mide']==9999 and ($_SESSION['usr_id']<>$dpo_usr_id or utf8_encode($_SESSION['usr_categoria'])=='Dirección'))){?>
            <input class="campo-dpo" name="dl_rdo_q1_<?php echo $row_lin['dl_id'];?>" value="<?php echo $row_lin['dl_rdo_q1'];?>" />
            <?php }else{ echo $row_lin['dl_rdo_q1'];}$total_q1+=por_obtencion($row_lin['dl_id'],1);?></td>
          <td class="numerica celdas_subtotal"><?php if($row_lin['ind_mide']==$_SESSION['usr_id'] or ($row_lin['ind_mide']==9999 and ($_SESSION['usr_id']<>$dpo_usr_id or utf8_encode($_SESSION['usr_categoria'])=='Dirección'))){?>
            <input class="campo-dpo" name="dl_rdo_q2_<?php echo $row_lin['dl_id'];?>" value="<?php echo $row_lin['dl_rdo_q2'];?>" />
            <?php }else{ echo $row_lin['dl_rdo_q2'];}$total_q2+=por_obtencion($row_lin['dl_id'],2);?></td>
          <td class="numerica celdas_subtotal"><?php if($row_lin['ind_mide']==$_SESSION['usr_id'] or ($row_lin['ind_mide']==9999 and ($_SESSION['usr_id']<>$dpo_usr_id or utf8_encode($_SESSION['usr_categoria'])=='Dirección'))){?>
            <input class="campo-dpo" name="dl_rdo_q3_<?php echo $row_lin['dl_id'];?>" value="<?php echo $row_lin['dl_rdo_q3'];?>" />
            <?php }else{ echo $row_lin['dl_rdo_q3'];}$total_q3+=por_obtencion($row_lin['dl_id'],3);?></td>
          <td class="numerica celdas_subtotal"><?php if($row_lin['ind_mide']==$_SESSION['usr_id'] or ($row_lin['ind_mide']==9999 and ($_SESSION['usr_id']<>$dpo_usr_id or utf8_encode($_SESSION['usr_categoria'])=='Dirección'))){?>
            <input class="campo-dpo" name="dl_rdo_q4_<?php echo $row_lin['dl_id'];?>" value="<?php echo $row_lin['dl_rdo_q4'];?>" />
            <?php }else{ echo $row_lin['dl_rdo_q4'];}$total_q4+=por_obtencion($row_lin['dl_id'],4);?></td>
          <td class="numerica celdas_subtotal celdas_meta" <?php if(((floatval ($row_lin['oa_horquilla_min'])<=floatval ($row_lin['oa_horquilla_max'])) and (floatval ($row_lin['dl_rdo_anual'])<floatval ($row_lin['oa_horquilla_max']))) or ((floatval ($row_lin['oa_horquilla_min'])>floatval ($row_lin['oa_horquilla_max'])) and (floatval ($row_lin['dl_rdo_anual'])>floatval ($row_lin['oa_horquilla_max'])))){?>style="color:red"<?php	}?>>
		  <?php if($row_lin['ind_mide']==$_SESSION['usr_id'] or ($row_lin['ind_mide']==9999 and ($_SESSION['usr_id']<>$dpo_usr_id or utf8_encode($_SESSION['usr_categoria'])=='Dirección'))){?>
            <input class="campo-dpo" name="dl_rdo_anual_<?php echo $row_lin['dl_id'];?>" value="<?php echo $row_lin['dl_rdo_anual'];?>" <?php if(((floatval ($row_lin['oa_horquilla_min'])<=floatval ($row_lin['oa_horquilla_max'])) and (floatval ($row_lin['dl_rdo_anual'])<floatval ($row_lin['oa_horquilla_max']))) or ((floatval ($row_lin['oa_horquilla_min'])>floatval ($row_lin['oa_horquilla_max'])) and (floatval ($row_lin['dl_rdo_anual'])>floatval ($row_lin['oa_horquilla_max'])))){?>style="color:red"<?php	}?>/>
            <?php }else{ echo $row_lin['dl_rdo_anual'];}$total_anual+=por_obtencion($row_lin['dl_id'],'Anual');?></td>
          <td class="numerica celdas_subtotal"><?php echo number_format(sim_anual($row_lin['dl_id']),2,',','.');$total_por_sim+=por_obtencion($row_lin['dl_id']);?></td>
          <td class="numerica celdas_subtotal celdas_meta"><?php echo number_format((por_obtencion($row_lin['dl_id'])*$valor_sim)/100,2,',','.').'€';$total_sim+=por_obtencion($row_lin['dl_id'])*$valor_sim/100;?></td>
        </tr>
        <?php }?>
        <tr>
          <td colspan="20"></td>
        </tr>
        <?php 
 }
 		$query_lin="SELECT * FROM vdpo_lineas WHERE dl_dpo_id=".$row['dpo_id']." AND (obj_tipo LIKE '".utf8_decode('Para el Comité de Dirección')."' OR obj_tipo LIKE '".utf8_decode('Mandos Intermedios')."') ORDER BY dl_peso DESC, obj_descripcion ASC";
		$result_lin=mysql_query($query_lin) or die ("No se puede ejecutar la sentencia: ".$query_lin);
		$num_lin=mysql_num_rows($result_lin);
		if($num_lin){
		?>
        <tr class="titulo_grupo">
          <td colspan="10" style="text-align:left;"><?php 
		if(utf8_encode($row['usr_categoria'])=='Dirección'){?>
            A nivel de comité de dirección
            <?php }else{?>
            A nivel de Mandos Intermedios
            <?php }?></td>
          <td colspan="2" class="numerica"><?php echo $peso['Para el Comité de Dirección']+$peso['Mandos Intermedios'].' %'?></td>
          <td width="1%" class="titulo_grupo celdas_subtotal"></td>
          <td colspan="4">Val. trimestral</td>
          <td>Punt.</td>
          <td></td>
          <td></td>
        </tr>
        <tr class="titulo_dpo">
          <td></td>
          <td>OE</td>
          <td>Objetivo</td>
          <td>Cód. In.</td>
          <td>Indicador</td>
          <td>Meta</td>
          <td>Un.</td>
          <td class="titulo_grupo celdas_subtotal"></td>
          <td colspan="2">Horquilla</td>
          <td>P.</td>
          <td class="titulo_grupo celdas_subtotal"></td>
          <td>&nbsp;</td>
          <td>T1</td>
          <td>T2</td>
          <td>T3</td>
          <td>T4</td>
          <td>Final</td>
          <td colspan="2">Simulación</td>
        </tr>
        <?php
		while($row_lin=mysql_fetch_array($result_lin)){?>
        <tr class="filas_subtotal">
          <td class="num_lin"><?php echo $n_lin; $n_lin++;?></td>
          <td class="celdas_subtotal"><?php 
					$query_ooe="SELECT * FROM vobjetivos_objetivos_estrategicos WHERE ooe_obj_id=".$row_lin['ind_obj_id']." ORDER BY oe_codigo";
					$result_ooe=mysql_query($query_ooe) or die ("No se puede ejecutar la sentencia: ".$query_ooe);
		$num_ooe=mysql_num_rows($result_ooe);
					$n=1;
					while($row_ooe=mysql_fetch_array($result_ooe)){
			$query_oe="SELECT * FROM objetivos_estrategicos WHERE oe_id=".$row_ooe['ooe_oe_id'];
			$result_oe=mysql_query($query_oe) or die ("No se puede ejecutar la sentencia: ".$query_oe);
			$row_oe=mysql_fetch_array($result_oe);
			echo $row_oe['oe_codigo'];
			if($n>0 and $n<$num_ooe){
				if($n==$num_ooe-1){
					echo "y";
				}else{
					echo ",";
				}
			}
			$n++;
					}?></td>
          <td class="celdas_subtotal"><?php if($row_lin['obj_lider_id']==$_SESSION['usr_id'] or $_SESSION['usr_perfil']=='Director RRHH'){?>
            <a href="/objetivos/show.php?obj_id=<?php echo $row_lin['ind_obj_id'];?>&dpo_id=<?php echo $row['dpo_id'];?>">
            <?php }?><?php echo utf8_encode($row_lin['obj_descripcion']);?>
                        <?php if($row_lin['obj_lider_id']==$_SESSION['usr_id'] or $_SESSION['usr_perfil']=='Director RRHH'){?>
            </a>
            <?php }?></td>
          <td class="celdas_subtotal"><?php echo utf8_encode($row_lin['ind_codigo']);?></td>
          <td class="celdas_subtotal"><?php if($row_lin['ind_responsable']==$_SESSION['usr_id'] or $_SESSION['usr_perfil']=='Director RRHH'){?>
            <a href="/medicion_objetivos/show.php?oa_id=<?php echo $row_lin['dl_oa_id'];?>&dpo_id=<?php echo $row['dpo_id'];?>">
            <?php }?>
            <?php if($row_lin['oa_observaciones']){?><img src="/img/ico_info.png" width="12" height="12" title="<?php echo utf8_encode($row_lin['oa_observaciones']);?>"/>&nbsp<?php }?><?php echo utf8_encode($row_lin['ind_nombre']);?>
            <?php if($row_lin['ind_responsable']==$_SESSION['usr_id']){?>
            </a>
            <?php }?></td>
          <td class="numerica celdas_subtotal celdas_meta"><?php echo number_format($row_lin['oa_meta'],2,',','.');?></td>
          <td class="numerica celdas_subtotal"><?php echo utf8_encode($row_lin['ind_meta_un_abreviatura']);?></td>
          <td class="titulo_grupo"></td>
          <td class="numerica celdas_subtotal"><?php echo number_format($row_lin['oa_horquilla_min'],2,',','.');?></td>
          <td class="numerica celdas_subtotal"><?php echo number_format($row_lin['oa_horquilla_max'],2,',','.');?></td>
          <td class="numerica celdas_subtotal celdas_peso<?php if($row_lin['dl_peso']==0){?> error_peso<?php }?>"><?php echo number_format($row_lin['dl_peso'],2,',','.');?></td>
          <td class="titulo_grupo"></td>
          <td class="numerica celdas_subtotal"><?php if(utf8_encode($row_lin['ind_grupo_individual'])=='Grupo'){?>
            G
            <?php }else{?>
            I
            <?php }?></td>
          <td class="numerica celdas_subtotal"><?php if($row_lin['ind_mide']==$_SESSION['usr_id'] or ($row_lin['ind_mide']==9999 and ($_SESSION['usr_id']<>$dpo_usr_id or utf8_encode($_SESSION['usr_categoria'])=='Dirección'))){?>
            <input class="campo-dpo" name="dl_rdo_q1_<?php echo $row_lin['dl_id'];?>" value="<?php echo $row_lin['dl_rdo_q1'];?>" />
            <?php }else{ echo $row_lin['dl_rdo_q1'];}$total_q1+=por_obtencion($row_lin['dl_id'],1);?></td>
          <td class="numerica celdas_subtotal"><?php if($row_lin['ind_mide']==$_SESSION['usr_id'] or ($row_lin['ind_mide']==9999 and ($_SESSION['usr_id']<>$dpo_usr_id or utf8_encode($_SESSION['usr_categoria'])=='Dirección'))){?>
            <input class="campo-dpo" name="dl_rdo_q2_<?php echo $row_lin['dl_id'];?>" value="<?php echo $row_lin['dl_rdo_q2'];?>" />
            <?php }else{ echo $row_lin['dl_rdo_q2'];}$total_q2+=por_obtencion($row_lin['dl_id'],2);?></td>
          <td class="numerica celdas_subtotal"><?php if($row_lin['ind_mide']==$_SESSION['usr_id'] or ($row_lin['ind_mide']==9999 and ($_SESSION['usr_id']<>$dpo_usr_id or utf8_encode($_SESSION['usr_categoria'])=='Dirección'))){?>
            <input class="campo-dpo" name="dl_rdo_q3_<?php echo $row_lin['dl_id'];?>" value="<?php echo $row_lin['dl_rdo_q3'];?>" />
            <?php }else{ echo $row_lin['dl_rdo_q3'];}$total_q3+=por_obtencion($row_lin['dl_id'],3);?></td>
          <td class="numerica celdas_subtotal"><?php if($row_lin['ind_mide']==$_SESSION['usr_id'] or ($row_lin['ind_mide']==9999 and ($_SESSION['usr_id']<>$dpo_usr_id or utf8_encode($_SESSION['usr_categoria'])=='Dirección'))){?>
            <input class="campo-dpo" name="dl_rdo_q4_<?php echo $row_lin['dl_id'];?>" value="<?php echo $row_lin['dl_rdo_q4'];?>" />
            <?php }else{ echo $row_lin['dl_rdo_q4'];}$total_q4+=por_obtencion($row_lin['dl_id'],4);?></td>
          <td class="numerica celdas_subtotal celdas_meta" <?php if(((floatval ($row_lin['oa_horquilla_min'])<=floatval ($row_lin['oa_horquilla_max'])) and (floatval ($row_lin['dl_rdo_anual'])<floatval ($row_lin['oa_horquilla_max']))) or ((floatval ($row_lin['oa_horquilla_min'])>floatval ($row_lin['oa_horquilla_max'])) and (floatval ($row_lin['dl_rdo_anual'])>floatval ($row_lin['oa_horquilla_max'])))){?>style="color:red"<?php	}?>><?php if($row_lin['ind_mide']==$_SESSION['usr_id'] or ($row_lin['ind_mide']==9999 and ($_SESSION['usr_id']<>$dpo_usr_id or utf8_encode($_SESSION['usr_categoria'])=='Dirección'))){?>
            <input class="campo-dpo" name="dl_rdo_anual_<?php echo $row_lin['dl_id'];?>" value="<?php echo $row_lin['dl_rdo_anual'];?>" <?php if(((floatval ($row_lin['oa_horquilla_min'])<=floatval ($row_lin['oa_horquilla_max'])) and (floatval ($row_lin['dl_rdo_anual'])<floatval ($row_lin['oa_horquilla_max']))) or ((floatval ($row_lin['oa_horquilla_min'])>floatval ($row_lin['oa_horquilla_max'])) and (floatval ($row_lin['dl_rdo_anual'])>floatval ($row_lin['oa_horquilla_max'])))){?>style="color:red"<?php	}?>/>
            <?php }else{ echo $row_lin['dl_rdo_anual'];}$total_anual+=por_obtencion($row_lin['dl_id'],'Anual');?></td>
          <td class="numerica celdas_subtotal"><?php echo number_format(sim_anual($row_lin['dl_id']),2,',','.');$total_por_sim+=por_obtencion($row_lin['dl_id']);?></td>
          <td class="numerica celdas_subtotal celdas_meta"><?php echo number_format((por_obtencion($row_lin['dl_id'])*$valor_sim)/100,2,',','.').'€';$total_sim+=por_obtencion($row_lin['dl_id'])*$valor_sim/100;?></td>
        </tr>
        <?php }?>
        <tr>
          <td colspan="20"></td>
        </tr>
        <?php 
}
		$query_lin="SELECT * FROM vdpo_lineas WHERE dl_dpo_id=".$row['dpo_id']." AND (obj_tipo LIKE '".utf8_decode('de departamento')."' OR obj_tipo LIKE '".utf8_decode('Proyectos')."') ORDER BY dl_peso DESC, obj_descripcion ASC";
		$result_lin=mysql_query($query_lin) or die ("No se puede ejecutar la sentencia: ".$query_lin);
		$num_lin=mysql_num_rows($result_lin);
		if($num_lin){
?>
        <tr class="titulo_grupo">
          <td colspan="10" style="text-align:left;">A nivel Departamental</td>
          <td colspan="2" class="numerica"><?php echo $peso['de departamento']+$peso['Proyectos']." %";?></td>
          <td width="1%" class="titulo_grupo celdas_subtotal"></td>
          <td colspan="4">Val. trimestral</td>
          <td>Punt.</td>
          <td></td>
          <td></td>
        </tr>
        <tr class="titulo_dpo">
          <td></td>
          <td>OE</td>
          <td>Objetivo</td>
          <td>Cód. In.</td>
          <td>Indicador</td>
          <td>Meta</td>
          <td>Un.</td>
          <td class="titulo_grupo celdas_subtotal"></td>
          <td colspan="2">Horquilla</td>
          <td>P.</td>
          <td class="titulo_grupo celdas_subtotal"></td>
          <td>&nbsp;</td>
          <td>T1</td>
          <td>T2</td>
          <td>T3</td>
          <td>T4</td>
          <td>Final</td>
          <td colspan="2">Simulación</td>
        </tr>
        <?php
		while($row_lin=mysql_fetch_array($result_lin)){?>
        <tr class="filas_subtotal">
          <td class="num_lin"><?php echo $n_lin; $n_lin++;?></td>
          <td class="celdas_subtotal"><?php 
					$query_ooe="SELECT * FROM vobjetivos_objetivos_estrategicos WHERE ooe_obj_id=".$row_lin['ind_obj_id']." ORDER BY oe_codigo";
					$result_ooe=mysql_query($query_ooe) or die ("No se puede ejecutar la sentencia: ".$query_ooe);
		$num_ooe=mysql_num_rows($result_ooe);
					$n=1;
					while($row_ooe=mysql_fetch_array($result_ooe)){
			$query_oe="SELECT * FROM objetivos_estrategicos WHERE oe_id=".$row_ooe['ooe_oe_id'];
			$result_oe=mysql_query($query_oe) or die ("No se puede ejecutar la sentencia: ".$query_oe);
			$row_oe=mysql_fetch_array($result_oe);
			echo $row_oe['oe_codigo'];
			if($n>0 and $n<$num_ooe){
				if($n==$num_ooe-1){
					echo "y";
				}else{
					echo ",";
				}
			}
			$n++;
					}?></td>
          <td class="celdas_subtotal"><?php if($row_lin['obj_lider_id']==$_SESSION['usr_id'] or $_SESSION['usr_perfil']=='Director RRHH'){?>
            <a href="/objetivos/show.php?obj_id=<?php echo $row_lin['ind_obj_id'];?>&dpo_id=<?php echo $row['dpo_id'];?>">
            <?php }?><?php echo utf8_encode($row_lin['obj_descripcion']);?>
                        <?php if($row_lin['obj_lider_id']==$_SESSION['usr_id'] or $_SESSION['usr_perfil']=='Director RRHH'){?>
            </a>
            <?php }?></td>
          <td class="celdas_subtotal"><?php echo utf8_encode($row_lin['ind_codigo']);?></td>
          <td class="celdas_subtotal"><?php if($row_lin['ind_responsable']==$_SESSION['usr_id'] or $_SESSION['usr_perfil']=='Director RRHH'){?>
            <a href="/medicion_objetivos/show.php?oa_id=<?php echo $row_lin['dl_oa_id'];?>&dpo_id=<?php echo $row['dpo_id'];?>">
            <?php }?>
            <?php if($row_lin['oa_observaciones']){?><img src="/img/ico_info.png" width="12" height="12" title="<?php echo utf8_encode($row_lin['oa_observaciones']);?>"/>&nbsp<?php }?><?php echo utf8_encode($row_lin['ind_nombre']);?>
            <?php if($row_lin['ind_responsable']==$_SESSION['usr_id']){?>
            </a>
            <?php }?></td>
          <td class="numerica celdas_subtotal celdas_meta"><?php echo number_format($row_lin['oa_meta'],2,',','.');?></td>
          <td class="numerica celdas_subtotal"><?php echo utf8_encode($row_lin['ind_meta_un_abreviatura']);?></td>
          <td class="titulo_grupo"></td>
          <td class="numerica celdas_subtotal"><?php echo number_format($row_lin['oa_horquilla_min'],2,',','.');?></td>
          <td class="numerica celdas_subtotal"><?php echo number_format($row_lin['oa_horquilla_max'],2,',','.');?></td>
          <td class="numerica celdas_subtotal celdas_peso<?php if($row_lin['dl_peso']==0){?> error_peso<?php }?>"><?php echo number_format($row_lin['dl_peso'],2,',','.');?></td>
          <td class="titulo_grupo"></td>
          <td class="numerica celdas_subtotal"><?php if(utf8_encode($row_lin['ind_grupo_individual'])=='Grupo'){?>
            G
            <?php }else{?>
            I
            <?php }?></td>
          <td class="numerica celdas_subtotal"><?php if($row_lin['ind_mide']==$_SESSION['usr_id'] or ($row_lin['ind_mide']==9999 and ($_SESSION['usr_id']<>$dpo_usr_id or utf8_encode($_SESSION['usr_categoria'])=='Dirección'))){?>
            <input class="campo-dpo" name="dl_rdo_q1_<?php echo $row_lin['dl_id'];?>" value="<?php echo $row_lin['dl_rdo_q1'];?>" />
            <?php }else{ echo $row_lin['dl_rdo_q1'];}$total_q1+=por_obtencion($row_lin['dl_id'],1);?></td>
          <td class="numerica celdas_subtotal"><?php if($row_lin['ind_mide']==$_SESSION['usr_id'] or ($row_lin['ind_mide']==9999 and ($_SESSION['usr_id']<>$dpo_usr_id or utf8_encode($_SESSION['usr_categoria'])=='Dirección'))){?>
            <input class="campo-dpo" name="dl_rdo_q2_<?php echo $row_lin['dl_id'];?>" value="<?php echo $row_lin['dl_rdo_q2'];?>" />
            <?php }else{ echo $row_lin['dl_rdo_q2'];}$total_q2+=por_obtencion($row_lin['dl_id'],2);?></td>
          <td class="numerica celdas_subtotal"><?php if($row_lin['ind_mide']==$_SESSION['usr_id'] or ($row_lin['ind_mide']==9999 and ($_SESSION['usr_id']<>$dpo_usr_id or utf8_encode($_SESSION['usr_categoria'])=='Dirección'))){?>
            <input class="campo-dpo" name="dl_rdo_q3_<?php echo $row_lin['dl_id'];?>" value="<?php echo $row_lin['dl_rdo_q3'];?>" />
            <?php }else{ echo $row_lin['dl_rdo_q3'];}$total_q3+=por_obtencion($row_lin['dl_id'],3);?></td>
          <td class="numerica celdas_subtotal"><?php if($row_lin['ind_mide']==$_SESSION['usr_id'] or ($row_lin['ind_mide']==9999 and ($_SESSION['usr_id']<>$dpo_usr_id or utf8_encode($_SESSION['usr_categoria'])=='Dirección'))){?>
            <input class="campo-dpo" name="dl_rdo_q4_<?php echo $row_lin['dl_id'];?>" value="<?php echo $row_lin['dl_rdo_q4'];?>" />
            <?php }else{ echo $row_lin['dl_rdo_q4'];}$total_q4+=por_obtencion($row_lin['dl_id'],4);?></td>
          <td class="numerica celdas_subtotal celdas_meta" <?php if(((floatval ($row_lin['oa_horquilla_min'])<=floatval ($row_lin['oa_horquilla_max'])) and (floatval ($row_lin['dl_rdo_anual'])<floatval ($row_lin['oa_horquilla_max']))) or ((floatval ($row_lin['oa_horquilla_min'])>floatval ($row_lin['oa_horquilla_max'])) and (floatval ($row_lin['dl_rdo_anual'])>floatval ($row_lin['oa_horquilla_max'])))){?>style="color:red"<?php	}?>><?php if($row_lin['ind_mide']==$_SESSION['usr_id'] or ($row_lin['ind_mide']==9999 and ($_SESSION['usr_id']<>$dpo_usr_id or utf8_encode($_SESSION['usr_categoria'])=='Dirección'))){?>
            <input class="campo-dpo" name="dl_rdo_anual_<?php echo $row_lin['dl_id'];?>" value="<?php echo $row_lin['dl_rdo_anual'];?>" <?php if(((floatval ($row_lin['oa_horquilla_min'])<=floatval ($row_lin['oa_horquilla_max'])) and (floatval ($row_lin['dl_rdo_anual'])<floatval ($row_lin['oa_horquilla_max']))) or ((floatval ($row_lin['oa_horquilla_min'])>floatval ($row_lin['oa_horquilla_max'])) and (floatval ($row_lin['dl_rdo_anual'])>floatval ($row_lin['oa_horquilla_max'])))){?>style="color:red"<?php	}?>/>
            <?php }else{ echo $row_lin['dl_rdo_anual'];}$total_anual+=por_obtencion($row_lin['dl_id'],'Anual');?></td>
          <td class="numerica celdas_subtotal"><?php echo number_format(sim_anual($row_lin['dl_id']),2,',','.');$total_por_sim+=por_obtencion($row_lin['dl_id']);?></td>
          <td class="numerica celdas_subtotal celdas_meta"><?php echo number_format((por_obtencion($row_lin['dl_id'])*$valor_sim)/100,2,',','.').'€';$total_sim+=por_obtencion($row_lin['dl_id'])*$valor_sim/100;?></td>
        </tr>
        <?php }?>
        <tr>
          <td colspan="20"></td>
        </tr>
        <?php  }
 		$query_lin="SELECT * FROM vdpo_lineas WHERE dl_dpo_id=".$row['dpo_id']." AND obj_tipo LIKE '".utf8_decode('Personal')."' ORDER BY dl_peso DESC, obj_descripcion ASC";
		$result_lin=mysql_query($query_lin) or die ("No se puede ejecutar la sentencia: ".$query_lin);
		$num_lin=mysql_num_rows($result_lin);
		if($num_lin){
?>
        <tr class="titulo_grupo">
          <td colspan="10" style="text-align:left;">A nivel Personal</td>
          <td colspan="2" class="numerica"><?php echo $peso['Personal']." %";?></td>
          <td width="1%" class="titulo_grupo celdas_subtotal"></td>
          <td colspan="4">Val. trimestral</td>
          <td>Punt.</td>
          <td></td>
          <td></td>
        </tr>
        <tr class="titulo_dpo">
          <td></td>
          <td>OE</td>
          <td>Objetivo</td>
          <td>Cód. In.</td>
          <td>Indicador</td>
          <td>Meta</td>
          <td>Un.</td>
          <td class="titulo_grupo celdas_subtotal"></td>
          <td colspan="2">Horquilla</td>
          <td>P.</td>
          <td class="titulo_grupo celdas_subtotal"></td>
          <td>&nbsp;</td>
          <td>T1</td>
          <td>T2</td>
          <td>T3</td>
          <td>T4</td>
          <td>Final</td>
          <td colspan="2">Simulación</td>
        </tr>
        <?php
		while($row_lin=mysql_fetch_array($result_lin)){?>
        <tr class="filas_subtotal">
          <td class="num_lin"><?php echo $n_lin; $n_lin++;?></td>
          <td class="celdas_subtotal"><?php 
					$query_ooe="SELECT * FROM vobjetivos_objetivos_estrategicos WHERE ooe_obj_id=".$row_lin['ind_obj_id']." ORDER BY oe_codigo";
					$result_ooe=mysql_query($query_ooe) or die ("No se puede ejecutar la sentencia: ".$query_ooe);
		$num_ooe=mysql_num_rows($result_ooe);
					$n=1;
					while($row_ooe=mysql_fetch_array($result_ooe)){
			$query_oe="SELECT * FROM objetivos_estrategicos WHERE oe_id=".$row_ooe['ooe_oe_id'];
			$result_oe=mysql_query($query_oe) or die ("No se puede ejecutar la sentencia: ".$query_oe);
			$row_oe=mysql_fetch_array($result_oe);
			echo $row_oe['oe_codigo'];
			if($n>0 and $n<$num_ooe){
				if($n==$num_ooe-1){
					echo "y";
				}else{
					echo ",";
				}
			}
			$n++;
					}?></td>
          <td class="celdas_subtotal"><?php if($row_lin['obj_lider_id']==$_SESSION['usr_id'] or $_SESSION['usr_perfil']=='Director RRHH'){?>
            <a href="/objetivos/show.php?obj_id=<?php echo $row_lin['ind_obj_id'];?>&dpo_id=<?php echo $row['dpo_id'];?>">
            <?php }?><?php echo utf8_encode($row_lin['obj_descripcion']);?>
                        <?php if($row_lin['obj_lider_id']==$_SESSION['usr_id'] or $_SESSION['usr_perfil']=='Director RRHH'){?>
            </a>
            <?php }?></td>
          <td class="celdas_subtotal"><?php echo utf8_encode($row_lin['ind_codigo']);?></td>
          <td class="celdas_subtotal"><?php if($row_lin['ind_responsable']==$_SESSION['usr_id'] or $_SESSION['usr_perfil']=='Director RRHH' ){?>
            <a href="/medicion_objetivos/show.php?oa_id=<?php echo $row_lin['dl_oa_id'];?>&dpo_id=<?php echo $row['dpo_id'];?>">
            <?php }?>
            <?php if($row_lin['oa_observaciones']){?><img src="/img/ico_info.png" width="12" height="12" title="<?php echo utf8_encode($row_lin['oa_observaciones']);?>"/>&nbsp<?php }?><?php echo utf8_encode($row_lin['ind_nombre']);?>
            <?php if($row_lin['ind_responsable']==$_SESSION['usr_id']){?>
            </a>
            <?php }?></td>
          <td class="numerica celdas_subtotal celdas_meta"><?php echo number_format($row_lin['oa_meta'],2,',','.');?></td>
          <td class="numerica celdas_subtotal"><?php echo utf8_encode($row_lin['ind_meta_un_abreviatura']);?></td>
          <td class="titulo_grupo"></td>
          <td class="numerica celdas_subtotal"><?php echo number_format($row_lin['oa_horquilla_min'],2,',','.');?></td>
          <td class="numerica celdas_subtotal"><?php echo number_format($row_lin['oa_horquilla_max'],2,',','.');?></td>
          <td class="numerica celdas_subtotal celdas_peso<?php if($row_lin['dl_peso']==0){?> error_peso<?php }?>"><?php echo number_format($row_lin['dl_peso'],2,',','.');?></td>
          <td class="titulo_grupo"></td>
          <td class="numerica celdas_subtotal"><?php if(utf8_encode($row_lin['ind_grupo_individual'])=='Grupo'){?>
            G
            <?php }else{?>
            I
            <?php }?></td>
          <td class="numerica celdas_subtotal"><?php if($row_lin['ind_mide']==$_SESSION['usr_id'] or ($row_lin['ind_mide']==9999 and ($_SESSION['usr_id']<>$dpo_usr_id or utf8_encode($_SESSION['usr_categoria'])=='Dirección'))){?>
            <input class="campo-dpo" name="dl_rdo_q1_<?php echo $row_lin['dl_id'];?>" value="<?php echo $row_lin['dl_rdo_q1'];?>" />
            <?php }else{ echo $row_lin['dl_rdo_q1'];}$total_q1+=por_obtencion($row_lin['dl_id'],1);?></td>
          <td class="numerica celdas_subtotal"><?php if($row_lin['ind_mide']==$_SESSION['usr_id'] or ($row_lin['ind_mide']==9999 and ($_SESSION['usr_id']<>$dpo_usr_id or utf8_encode($_SESSION['usr_categoria'])=='Dirección'))){?>
            <input class="campo-dpo" name="dl_rdo_q2_<?php echo $row_lin['dl_id'];?>" value="<?php echo $row_lin['dl_rdo_q2'];?>" />
            <?php }else{ echo $row_lin['dl_rdo_q2'];}$total_q2+=por_obtencion($row_lin['dl_id'],2);?></td>
          <td class="numerica celdas_subtotal"><?php if($row_lin['ind_mide']==$_SESSION['usr_id'] or ($row_lin['ind_mide']==9999 and ($_SESSION['usr_id']<>$dpo_usr_id or utf8_encode($_SESSION['usr_categoria'])=='Dirección'))){?>
            <input class="campo-dpo" name="dl_rdo_q3_<?php echo $row_lin['dl_id'];?>" value="<?php echo $row_lin['dl_rdo_q3'];?>" />
            <?php }else{ echo $row_lin['dl_rdo_q3'];}$total_q3+=por_obtencion($row_lin['dl_id'],3);?></td>
          <td class="numerica celdas_subtotal"><?php if($row_lin['ind_mide']==$_SESSION['usr_id'] or ($row_lin['ind_mide']==9999 and ($_SESSION['usr_id']<>$dpo_usr_id or utf8_encode($_SESSION['usr_categoria'])=='Dirección'))){?>
            <input class="campo-dpo" name="dl_rdo_q4_<?php echo $row_lin['dl_id'];?>" value="<?php echo $row_lin['dl_rdo_q4'];?>" />
            <?php }else{ echo $row_lin['dl_rdo_q4'];}$total_q4+=por_obtencion($row_lin['dl_id'],4);?></td>
          <td class="numerica celdas_subtotal celdas_meta" <?php if(((floatval ($row_lin['oa_horquilla_min'])<=floatval ($row_lin['oa_horquilla_max'])) and (floatval ($row_lin['dl_rdo_anual'])<floatval ($row_lin['oa_horquilla_max']))) or ((floatval ($row_lin['oa_horquilla_min'])>floatval ($row_lin['oa_horquilla_max'])) and (floatval ($row_lin['dl_rdo_anual'])>floatval ($row_lin['oa_horquilla_max'])))){?>style="color:red"<?php	}?>><?php if($row_lin['ind_mide']==$_SESSION['usr_id'] or ($row_lin['ind_mide']==9999 and ($_SESSION['usr_id']<>$dpo_usr_id or utf8_encode($_SESSION['usr_categoria'])=='Dirección'))){?>
            <input class="campo-dpo" name="dl_rdo_anual_<?php echo $row_lin['dl_id'];?>" value="<?php echo $row_lin['dl_rdo_anual'];?>" <?php if(((floatval ($row_lin['oa_horquilla_min'])<=floatval ($row_lin['oa_horquilla_max'])) and (floatval ($row_lin['dl_rdo_anual'])<floatval ($row_lin['oa_horquilla_max']))) or ((floatval ($row_lin['oa_horquilla_min'])>floatval ($row_lin['oa_horquilla_max'])) and (floatval ($row_lin['dl_rdo_anual'])>floatval ($row_lin['oa_horquilla_max'])))){?>style="color:red"<?php	}?>/>
            <?php }else{ echo $row_lin['dl_rdo_anual'];}$total_anual+=por_obtencion($row_lin['dl_id'],'Anual');?></td>
          <td class="numerica celdas_subtotal"><?php echo number_format(sim_anual($row_lin['dl_id']),2,',','.');$total_por_sim+=por_obtencion($row_lin['dl_id']);?></td>
          <td class="numerica celdas_subtotal celdas_meta"><?php echo number_format((por_obtencion($row_lin['dl_id'])*$valor_sim)/100,2,',','.').'€';$total_sim+=por_obtencion($row_lin['dl_id'])*$valor_sim/100;?></td>
        </tr>
        <?php }?>
        <tr>
          <td colspan="20"></td>
        </tr>
        <?php }?>
        <tr class="titulo_grupo">
          <td colspan="10" style="text-align:left;">TOTAL</td>
          <td colspan="2" class="numerica<?php if($peso['total']<100){?> error_peso<?php }?>"><?php echo $peso['total']." %";?></td>
          <td></td>
          <td class="numerica"><?php echo number_format($total_q1,2,',','.');?>%</td>
          <td class="numerica"><?php echo number_format($total_q2,2,',','.');?>%</td>
          <td class="numerica"><?php echo number_format($total_q3,2,',','.');?>%</td>
          <td class="numerica"><?php echo number_format($total_q4,2,',','.');?>%</td>
          <td class="numerica"><?php echo number_format($total_anual,2,',','.');?>%</td>
          <td class="numerica total_sim"><?php echo number_format($total_por_sim,2,',','.');?>%</td>
          <td class="numerica total_sim"><?php echo number_format($total_sim,2,',','.');?>€</td>
        </tr>
        <tr>
          <td colspan="20" class="filas_subtotal" align="center"><?php if(($_SESSION['usr_id']<>$dpo_usr_id or utf8_encode($_SESSION['usr_categoria'])=='Dirección' or $_SESSION['usr_perfil']=='Director RRHH') and $_SESSION['ano']>=2016){?><input type="button" name="Guardar" id="Guardar" value="Editar pesos" onClick="document.location.href = 'edit.php?dpo_id=<?php echo $row['dpo_id'];?>'"/>&nbsp;&nbsp;<?php }?><input type="submit" name="Guardar" id="Guardar" value="Guardar DPO" />
            &nbsp;&nbsp;
            <input type="submit" value="Descartar cambios" /></td>
        </tr>
        <tr>
          <td colspan="20"></td>
        </tr>
        <tr class="filas_subtotal">
          <td colspan="9">Comentarios:</td>
          <td colspan="5">Estado: <?php echo utf8_encode($row['sd_nombre']);?></td>
          <td colspan="6">Fecha último cambio: <?php echo cambiaf_a_normal($row['dpo_fecha_ultimo_cambio_status']);?></td>
        </tr>
      </form>
      <tr class="filas_subtotal">
        <td colspan="20"><table width="100%">
            <tr>
              <td colspan="3"  class="titulo_grupo"><a name="Enero-Marzo"></a>Enero-Marzo</td>
            </tr>
            <tr class="titulo_dpo">
              <td>Nº LINEA</td>
              <td>COMENTARIO</td>
              <td>ACCIÓN</td>
            </tr>
            <?php $query_com="SELECT * FROM dpo_comentarios WHERE com_dpo_id=".$row['dpo_id']." AND com_periodo='Enero-Marzo' ORDER BY com_n_lin ASC";
	  $result_com=mysql_query($query_com) or die ("No se puede ejecutar la consulta: ".$query_com);
	  while($row_com=mysql_fetch_array($result_com)){?>
            <form action="modify_comentarios.php" method="post">
              <tr>
                <td class="celdas_subtotal"><input type="hidden" name="com_id" value="<?php echo $row_com['com_id'];?>">
                  <input type="hidden" name="com_dpo_id" value="<?php echo $row['dpo_id'];?>">
                  <input type="hidden" name="com_periodo" value="Enero-Marzo">
                  <input name="com_n_lin" type="text" class="campo-ncomentario numerica" value="<?php echo $row_com['com_n_lin'];?>"></td>
                <td class="celdas_subtotal"><input name="com_comentario" type="text" class="campo-comentario" value="<?php echo utf8_encode($row_com['com_comentario']);?>"></td>
                <td class="celdas_subtotal"><input type="submit" name="modificar" value="Mod." class="boton-crear">
                  &nbsp;
                  <input type="submit" name="borrar" value="Bor." class="boton-crear"></td>
              </tr>
            </form>
            <?php }?>
              <form action="insert_comentarios.php" method="post">
            
            
              <td class="celdas_subtotal"><input type="hidden" name="com_dpo_id" value="<?php echo $row['dpo_id'];?>">
                <input type="hidden" name="com_periodo" value="Enero-Marzo">
                <input name="com_n_lin" type="text" class="campo-ncomentario numerica" value="<?php echo $row_com['com_n_lin'];?>"></td>
              <td class="celdas_subtotal"><input name="com_comentario" type="text" class="campo-comentario" value="<?php echo utf8_encode($row_com['com_comentario']);?>"></td>
              <td class="celdas_subtotal"><input type="submit" name="anyadir" value="Añadir" class="boton-crear"></td>
                </form>
            </tr>
            <tr>
              <td colspan="3"  class="titulo_grupo"><a name="Abril-Junio"></a>Abril-Junio</td>
            </tr>
            <tr class="titulo_dpo">
              <td>Nº LINEA</td>
              <td>COMENTARIO</td>
              <td>ACCIÓN</td>
            </tr>
            <?php $query_com="SELECT * FROM dpo_comentarios WHERE com_dpo_id=".$row['dpo_id']." AND com_periodo='Abril-Junio' ORDER BY com_n_lin ASC";
	  $result_com=mysql_query($query_com) or die ("No se puede ejecutar la consulta: ".$query_com);
	  while($row_com=mysql_fetch_array($result_com)){?>
            <form action="modify_comentarios.php" method="post">
              <tr>
                <td class="celdas_subtotal" width="20px;"><input type="hidden" name="com_id" value="<?php echo $row_com['com_id'];?>">
                  <input type="hidden" name="com_dpo_id" value="<?php echo $row['dpo_id'];?>">
                <input type="hidden" name="com_periodo" value="Abril-Junio">
                  <input name="com_n_lin" type="text" class="campo-ncomentario numerica" value="<?php echo $row_com['com_n_lin'];?>"></td>
                <td class="celdas_subtotal"><input name="com_comentario" type="text" class="campo-comentario" value="<?php echo utf8_encode($row_com['com_comentario']);?>"></td>
                <td class="celdas_subtotal"><input type="submit" name="modificar" value="Mod." class="boton-crear">
                  &nbsp;
                  <input type="submit" name="borrar" value="Bor." class="boton-crear"></td>
              </tr>
            </form>
            <?php }?>
              <form action="insert_comentarios.php" method="post">
            
            
              <td class="celdas_subtotal"><input type="hidden" name="com_dpo_id" value="<?php echo $row['dpo_id'];?>">
                <input type="hidden" name="com_periodo" value="Abril-Junio">
                <input name="com_n_lin" type="text" class="campo-ncomentario numerica" value="<?php echo $row_com['com_n_lin'];?>"></td>
              <td class="celdas_subtotal"><input name="com_comentario" type="text" class="campo-comentario" value="<?php echo utf8_encode($row_com['com_comentario']);?>"></td>
              <td class="celdas_subtotal"><input type="submit" name="anyadir" value="Añadir" class="boton-crear"></td>
                </form>
            </tr>
            <tr>
              <td colspan="3"  class="titulo_grupo"><a name="Julio-Septiembre"></a>Julio-Septiembre</td>
            </tr>
            <tr class="titulo_dpo">
              <td>Nº LINEA</td>
              <td>COMENTARIO</td>
              <td>ACCIÓN</td>
            </tr>
            <?php $query_com="SELECT * FROM dpo_comentarios WHERE com_dpo_id=".$row['dpo_id']." AND com_periodo='Julio-Septiembre' ORDER BY com_n_lin ASC";
	  $result_com=mysql_query($query_com) or die ("No se puede ejecutar la consulta: ".$query_com);
	  while($row_com=mysql_fetch_array($result_com)){?>
            <form action="modify_comentarios.php" method="post">
              <tr>
                <td class="celdas_subtotal"><input type="hidden" name="com_id" value="<?php echo $row_com['com_id'];?>">
                  <input type="hidden" name="com_dpo_id" value="<?php echo $row['dpo_id'];?>">
                 <input type="hidden" name="com_periodo" value="Julio-Septiembre">
                <input name="com_n_lin" type="text" class="campo-ncomentario numerica" value="<?php echo $row_com['com_n_lin'];?>"></td>
                <td class="celdas_subtotal"><input name="com_comentario" type="text" class="campo-comentario" value="<?php echo utf8_encode($row_com['com_comentario']);?>"></td>
                <td class="celdas_subtotal"><input type="submit" name="modificar" value="Mod." class="boton-crear">
                  &nbsp;
                  <input type="submit" name="borrar" value="Bor." class="boton-crear"></td>
              </tr>
            </form>
            <?php }?>
              <form action="insert_comentarios.php" method="post">
            
            
              <td class="celdas_subtotal"><input type="hidden" name="com_dpo_id" value="<?php echo $row['dpo_id'];?>">
                <input type="hidden" name="com_periodo" value="Julio-Septiembre">
                <input name="com_n_lin" type="text" class="campo-ncomentario numerica" value="<?php echo $row_com['com_n_lin'];?>"></td>
              <td class="celdas_subtotal"><input name="com_comentario" type="text" class="campo-comentario" value="<?php echo utf8_encode($row_com['com_comentario']);?>"></td>
              <td class="celdas_subtotal"><input type="submit" name="anyadir" value="Añadir" class="boton-crear"></td>
                </form>
            </tr>
            <tr>
              <td colspan="3"  class="titulo_grupo"><a name="Octubre-Diciembre"></a>Octubre-Diciembre</td>
            </tr>
            <tr class="titulo_dpo">
              <td>Nº LINEA</td>
              <td>COMENTARIO</td>
              <td>ACCIÓN</td>
            </tr>
            <?php $query_com="SELECT * FROM dpo_comentarios WHERE com_dpo_id=".$row['dpo_id']." AND com_periodo='Octubre-Diciembre' ORDER BY com_n_lin ASC";
	  $result_com=mysql_query($query_com) or die ("No se puede ejecutar la consulta: ".$query_com);
	  while($row_com=mysql_fetch_array($result_com)){?>
            <form action="modify_comentarios.php" method="post">
              <tr>
                <td class="celdas_subtotal"><input type="hidden" name="com_id" value="<?php echo $row_com['com_id'];?>">
                  <input type="hidden" name="com_dpo_id" value="<?php echo $row['dpo_id'];?>">
                <input type="hidden" name="com_periodo" value="Octubre-Diciembre">
                 <input name="com_n_lin" type="text" class="campo-ncomentario numerica" value="<?php echo $row_com['com_n_lin'];?>"></td>
                <td class="celdas_subtotal"><input name="com_comentario" type="text" class="campo-comentario" value="<?php echo utf8_encode($row_com['com_comentario']);?>"></td>
                <td class="celdas_subtotal"><input type="submit" name="modificar" value="Mod." class="boton-crear">
                  &nbsp;
                  <input type="submit" name="borrar" value="Bor." class="boton-crear"></td>
              </tr>
            </form>
            <?php }?>
              <form action="insert_comentarios.php" method="post">
            
            <tr>
              <td class="celdas_subtotal"><input type="hidden" name="com_dpo_id" value="<?php echo $row['dpo_id'];?>">
                <input type="hidden" name="com_periodo" value="Octubre-Diciembre">
                <input name="com_n_lin" type="text" class="campo-ncomentario numerica" value="<?php echo $row_com['com_n_lin'];?>"></td>
              <td class="celdas_subtotal"><input name="com_comentario" type="text" class="campo-comentario" value="<?php echo utf8_encode($row_com['com_comentario']);?>"></td>
              <td class="celdas_subtotal"><input type="submit" name="anyadir" value="Añadir" class="boton-crear"></td>
              </tr>
                </form>
            <tr>
              <td colspan="3"  class="titulo_grupo"><a name="Anuales"></a>Conclusiones Anuales</td>
            </tr>
            <tr class="titulo_dpo">
              <td>Nº LINEA</td>
              <td>COMENTARIO</td>
              <td>ACCIÓN</td>
            </tr>
            <?php $query_com="SELECT * FROM dpo_comentarios WHERE com_dpo_id=".$row['dpo_id']." AND com_periodo='Anuales' ORDER BY com_n_lin ASC";
	  $result_com=mysql_query($query_com) or die ("No se puede ejecutar la consulta: ".$query_com);
	  while($row_com=mysql_fetch_array($result_com)){?>
            <form action="modify_comentarios.php" method="post">
              <tr>
                <td class="celdas_subtotal"><input type="hidden" name="com_id" value="<?php echo $row_com['com_id'];?>">
                  <input type="hidden" name="com_dpo_id" value="<?php echo $row['dpo_id'];?>">
                 <input type="hidden" name="com_periodo" value="Anuales">
                <input name="com_n_lin" type="text" class="campo-ncomentario numerica" value="<?php echo $row_com['com_n_lin'];?>"></td>
                <td class="celdas_subtotal"><input name="com_comentario" type="text" class="campo-comentario" value="<?php echo utf8_encode($row_com['com_comentario']);?>"></td>
                <td class="celdas_subtotal"><input type="submit" name="modificar" value="Mod." class="boton-crear">
                  &nbsp;
                  <input type="submit" name="borrar" value="Bor." class="boton-crear"></td>
              </tr>
            </form>
            <?php }?>
              <form action="insert_comentarios.php" method="post">
            
            <tr>
              <td class="celdas_subtotal"><input type="hidden" name="com_dpo_id" value="<?php echo $row['dpo_id'];?>">
                <input type="hidden" name="com_periodo" value="Anuales">
                <input name="com_n_lin" type="text" class="campo-ncomentario numerica" value="<?php echo $row_com['com_n_lin'];?>"></td>
              <td class="celdas_subtotal"><input name="com_comentario" type="text" class="campo-comentario" value="<?php echo utf8_encode($row_com['com_comentario']);?>"></td>
              <td class="celdas_subtotal"><input type="submit" name="anyadir" value="Añadir" class="boton-crear"></td>
              </tr>
                </form>
          </table></td>
      </tr>
    </table>
  </div>
</div>
<footer> </footer>
</body></html>