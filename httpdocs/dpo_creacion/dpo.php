<?php
session_start();
include("../login/sesion_start.php");
include("../librerias/librerias.php");
include("../cabecera.php");
$conn=db_connect();
$dpo_ano=date('Y')+1;
$dpo_usr_id=$_SESSION['usr_id'];
if($_SESSION['usr_perfil']=='Director General' or $_SESSION['usr_perfil']=='Administrador'){
	$dpo_usr_id=4;
}
if($_POST['filtrar']){
	if($_POST['dpo_ano']){
		$dpo_ano=$_POST['dpo_ano'];
	}
	if($_POST['dpo_usr_id']){
		$dpo_usr_id=$_POST['dpo_usr_id'];
	}
}
if($_GET['dpo_ano']){
	$dpo_ano=$_GET['dpo_ano'];
}
if($_GET['dpo_usr_id']){
	$dpo_usr_id=$_GET['dpo_usr_id'];
}
$query="SELECT * FROM vdpo_cabeceras WHERE dpo_ano=".$dpo_ano." AND dpo_usr_id=".$dpo_usr_id;
$result=mysql_query($query) or die ("No se puede ejecutar la sentencia: ".$query);
$row=mysql_fetch_array($result);
$query_lin="SELECT * FROM vdpo_lineas WHERE dl_dpo_id=".$row['dpo_id'];
$result_lin=mysql_query($query_lin) or die ("No se puede ejecutar la sentencia: ".$query_lin);
while($row_lin=mysql_fetch_array($result_lin)){
	$peso[utf8_encode($row_lin['obj_tipo'])]+=$row_lin['dl_peso'];
	$peso['total']+=$row_lin['dl_peso'];
}
?>
<script language="javascript">
function EliminarLinea(dl_id,dpo_ano,dpo_usr_id){
	if (confirm('Seguro que desea eliminar esta objetivo de la dpo')){
		pagina="del_linea.php?dl_id="+dl_id+"&dpo_ano="+dpo_ano+"&dpo_usr_id="+dpo_usr_id;
		window.location=pagina;
	}
}
</script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<div id="content">
  <div class="cabecera_apartados">
    <div class="filtros">
      <form method="post" action="#">
        <table align="center" width="100%">
          <tr>
            <td colspan="5">DPO de <?php echo utf8_encode($row['usr_nombre']." ".$row['usr_apellidos']);?> (<?php echo $dpo_ano;?>)</td>
          <tr>
            <td style="background-color:#999999; width:540px;"></td>
            <td class="texto_10">Colaborador:
              <select name="dpo_usr_id" id="dpo_usr_id" class="texto_10">
                <option value="<?php echo $_SESSION['usr_id'];?>"><?php echo utf8_encode($_SESSION['usr_apellidos'].", ".$_SESSION['usr_nombre']);?></option>
                <?php if($_SESSION['usr_perfil']=='Director General' or $_SESSION['usr_perfil']=='Administrador' or $_SESSION['usr_perfil']=='Director RRHH'){$query_usr="SELECT * FROM usuarios WHERE usr_baja=0 AND (usr_perfil='Usuario' OR usr_perfil='Director RRHH') ORDER BY usr_apellidos, usr_nombre ASC";
				}else{
$query_usr="SELECT * FROM usuarios WHERE usr_baja=0 AND usr_superior_id=".$_SESSION['usr_id']." ORDER BY usr_apellidos, usr_nombre ASC";
				}
				$result_usr=mysql_query($query_usr) or die ("No se puede ejecutar la sentencia: ".$query_usr);
				while($row_usr=mysql_fetch_array($result_usr)){
				$query_dpo="SELECT * FROM dpo_cabeceras WHERE dpo_usr_id=".$row_usr['usr_id']." AND dpo_ano=".$dpo_ano;
				$result_dpo=mysql_query($query_dpo) or die ("No se puede ejecutar la sentencia: ".$query_dpo);
				$num_dpo=mysql_num_rows($result_dpo);
				if($num_dpo){
				?>
                <option value="<?php echo $row_usr['usr_id'];?>"<?php if($row_usr['usr_id']==$dpo_usr_id){?> selected="selected"<?php }?>><?php echo utf8_encode($row_usr['usr_apellidos'].", ".$row_usr['usr_nombre']);?></option>
                <?php
				}
				}?>
              </select></td>
            <td><input type="submit" name="filtrar" id="filtrar" value="Filtrar" class="texto_10"/></td>
            <td><input name="reset" type="submit" id="reset" value="Resetear" class="texto_10" /></td>
          </tr>
        </table>
      </form>
    </div>
  </div>
  <div class="tabla_dpo">
    <table width="100%">
      <tr class="titulo_grupo">
        <td colspan="8" style="text-align:left;">A nivel de compañia</td>
        <td colspan="2" class="numerica"><?php echo $peso['Objetivo de Compañía']." %";?></td>
        <td width="1%" class="titulo_grupo celdas_subtotal"></td>
        <td colspan="4">Valoración trimestral</td>
        <td>Punt.</td>
      </tr>
      <tr class="titulo_dpo">
        <td width="5%">Un.</td>
        <td width="20%">Objetivo</td>
        <td width="5%">Código Indicador</td>
        <td width="20%">Indicador</td>
        <td width="5%">Meta a Alcanzar</td>
        <td width="2%">Un.</td>        <td width="1%" class="titulo_grupo celdas_subtotal"></td>
        <td colspan="2" width="10%">Horquilla</td>
        <td width="2%">Un.</td>        <td width="4%">Peso</td>
        <td width="1%" class="titulo_grupo celdas_subtotal"></td>
        <td width="5%">T1</td>
        <td width="5%">T2</td>
        <td width="5%">T3</td>
        <td width="5%">T4</td>
        <td width="4%">Final</td>
      </tr>
      <?php
		$query_lin="SELECT * FROM vdpo_lineas WHERE dl_dpo_id=".$row['dpo_id']." AND obj_tipo LIKE '".utf8_decode('Objetivo de compañia')."'";
		$result_lin=mysql_query($query_lin) or die ("No se puede ejecutar la sentencia: ".$query_lin);
		$num_lin=mysql_num_rows($result_lin);
		while($row_lin=mysql_fetch_array($result_lin)){?>
      		<tr class="filas_subtotal">
        		<td class="celdas_subtotal"><?php
					$query_ooe="SELECT * FROM vobjetivos_objetivos_estrategicos WHERE ooe_obj_id=".$row_lin['oa_obj_id']." ORDER BY oe_codigo";
					$result_ooe=mysql_query($query_ooe) or die ("No se puede ejecutar la sentencia: ".$query_ooe);
					$n=1;
					while ($row_ooe = mysql_fetch_array($result_ooe)){
						$query_oe="SELECT * FROM objetivos_estrategicos WHERE oe_id=".$row_ooe['ooe_oe_id'];
						$result_oe=mysql_query($query_oe) or die ("No se puede ejecutar la sentencia: ".$query_oe);
						$row_oe=mysql_fetch_array($result_oe);
						echo $row_oe['oe_codigo'];
						if($n>0 and $n<$num_ooe){
							if($n==$num_ooe-1){
								echo " y ";
							}else{
								echo ", ";
							}
						}
						$n++;
					}?>
        </td>

        		<td class="celdas_subtotal"><?php echo utf8_encode($row_lin['obj_descripcion']);?></td>
<?php
					$query_oi="SELECT * FROM vobjetivos_indicadores WHERE oi_obj_id=".$row_lin['oa_obj_id']." ORDER BY ind_codigo";
					$result_oi=mysql_query($query_oi) or die ("No se puede ejecutar la sentencia: ".$query_oi);
					$num_oi=mysql_num_rows($result_oi);      ?>
                    <td class="celdas_subtotal <?php if(!$num_oi){?>celdas_vacias<?php }?>">
					<?php while($row_oi=mysql_fetch_array($result_oi)){
						echo $row_oi['ind_codigo']."<br>";
					}?>
              	</td>
        		<td class="celdas_subtotal"><?php
					if($num_oi){
						$query_oi="SELECT * FROM vobjetivos_indicadores WHERE oi_obj_id=".$row_lin['oa_obj_id']." ORDER BY ind_codigo";
						$result_oi=mysql_query($query_oi) or die ("No se puede ejecutar la sentencia: ".$query_oi);
						$num_oi=mysql_num_rows($result_oi);
					while($row_oi=mysql_fetch_array($result_oi)){
						echo utf8_encode($row_oi['ind_nombre'])."<br>";
			}
		}else{
			echo utf8_encode($row_lin['obj_indicador']);
		}?></td>
        <td class="numerica celdas_subtotal celdas_meta"><?php echo number_format($row_lin['oa_meta'],2,',','.')." %";?></td>
        <td class="titulo_grupo"></td>
        <td class="numerica celdas_subtotal"><?php echo number_format($row_lin['oa_horquilla_min'],2,',','.')." %";?></td>
        <td class="numerica celdas_subtotal"><?php echo number_format($row_lin['oa_horquilla_max'],2,',','.')." %";?></td>
        <td class="numerica celdas_subtotal celdas_peso"><input type="text" class="campo-corto-peso" value="<?php echo $row_lin['dl_peso'];?>" name="dl_peso"></td>
        <td class="celdas_subtotal celdas_peso"><a href="#" onClick="javascript:EliminarLinea(<?php echo $row_lin['dl_id'];?>,'<?php echo $dpo_ano;?>','<?php echo $dpo_usr_id;?>');"><img src="/img/borrar.png" width="20" height="20" alt="Borrar" title="Borrar"></a>
      </tr>
      <?php }
	  if(!$num_lin){?>
      <tr class="filas_vacias">
        <td class="celdas_subtotal"></td>
        <td class="celdas_subtotal"></td>
        <td class="celdas_subtotal"></td>
        <td class="celdas_subtotal"></td>
        <td class="celdas_subtotal"></td>
        <td class="titulo_grupo"></td>
        <td class="celdas_subtotal"></td>
        <td class="celdas_subtotal"></td>
        <td class="celdas_subtotal"></td>
        <td class="celdas_subtotal"></td>
      </tr>
      <?php }?>
      <tr>
        <td colspan="10"></td>
      </tr>
      <tr class="titulo_grupo">
        <td colspan="8" style="text-align:left;"><?php
		if(utf8_encode($row['usr_categoria'])=='Comité de dirección'){?>
          A nivel de comité de dirección
          <?php }else{?>
          A nivel de Mandos Intermedios
          <?php }?></td>
        <td colspan="2" class="numerica"><?php echo $peso['Para el Comité de Dirección']+$peso['Mandos Intermedios'].' %'?></td>
      </tr>
      <tr class="titulo_dpo">
        <td width="6%">Obj. Estrat.</td>
        <td width="31%">Objetivo</td>
        <td width="6%">Código Indicador</td>
        <td width="32%">Indicador</td>
        <td width="6%">Meta a Alcanzar</td>
        <td width="1%" class="titulo_grupo"></td>
        <td colspan="2" width="12%">Horquilla</td>
        <td width="6%">Peso</td>
        <td></td>
      </tr>
      <?php
		$query_lin="SELECT * FROM vdpo_lineas WHERE dl_dpo_id=".$row['dpo_id']." AND (obj_tipo LIKE '".utf8_decode('Para el Comité de Dirección')."' OR obj_tipo LIKE '".utf8_decode('Mandos Intermedios')."')";
		$result_lin=mysql_query($query_lin) or die ("No se puede ejecutar la sentencia: ".$query_lin);
		$num_lin=mysql_num_rows($result_lin);
		while($row_lin=mysql_fetch_array($result_lin)){?>
      <tr class="filas_subtotal">
        <td class="celdas_subtotal"><?php
		$query_ooe="SELECT * FROM vobjetivos_objetivos_estrategicos WHERE ooe_obj_id=".$row_lin['oa_obj_id']." ORDER BY oe_codigo";
		$result_ooe=mysql_query($query_ooe) or die ("No se puede ejecutar la sentencia: ".$query_ooe);
		while($row_ooe=mysql_fetch_array($result_ooe)){
			echo $row_ooe['oe_codigo']."<br>";
		}?></td>
        <td class="celdas_subtotal"><?php echo utf8_encode($row_lin['obj_descripcion']);?></td>
<?php
					$query_oi="SELECT * FROM vobjetivos_indicadores WHERE oi_obj_id=".$row_lin['oa_obj_id']." ORDER BY ind_codigo";
					$result_oi=mysql_query($query_oi) or die ("No se puede ejecutar la sentencia: ".$query_oi);
					$num_oi=mysql_num_rows($result_oi);      ?>
                    <td class="celdas_subtotal <?php if(!$num_oi){?>celdas_vacias<?php }?>">
					<?php while($row_oi=mysql_fetch_array($result_oi)){
						echo $row_oi['ind_codigo']."<br>";
					}?>
              	</td>
        <td class="celdas_subtotal"><?php
		if($num_oi){
			$query_oi="SELECT * FROM vobjetivos_indicadores WHERE oi_obj_id=".$row_lin['oa_obj_id']." ORDER BY ind_codigo";
			$result_oi=mysql_query($query_oi) or die ("No se puede ejecutar la sentencia: ".$query_oi);
			$num_oi=mysql_num_rows($result_oi);
			while($row_oi=mysql_fetch_array($result_oi)){
				echo utf8_encode($row_oi['ind_nombre'])."<br>";
			}
		}else{
			echo utf8_encode($row_lin['obj_indicador']);
		}?></td>
        <td class="numerica celdas_subtotal celdas_meta"><?php echo number_format($row_lin['oa_meta'],2,',','.')." %";?></td>
        <td class="titulo_grupo"></td>
        <td class="numerica celdas_subtotal"><?php echo number_format($row_lin['oa_horquilla_min'],2,',','.')." %";?></td>
        <td class="numerica celdas_subtotal"><?php echo number_format($row_lin['oa_horquilla_max'],2,',','.')." %";?></td>
        <td class="numerica celdas_subtotal celdas_peso"><input type="text" class="campo-corto-peso" value="<?php echo $row_lin['dl_peso'];?>" name="dl_peso"></td>
        <td class="celdas_subtotal celdas_peso"><a href="#" onClick="javascript:EliminarLinea(<?php echo $row_lin['dl_id'];?>,'<?php echo $dpo_ano;?>','<?php echo $dpo_usr_id;?>');"><img src="/img/borrar.png" width="20" height="20" alt="Borrar" title="Borrar"></a>
      </tr>
      <?php }
	  if(!$num_lin){?>
      <tr class="filas_vacias">
        <td class="celdas_subtotal"></td>
        <td class="celdas_subtotal"></td>
        <td class="celdas_subtotal"></td>
        <td class="celdas_subtotal"></td>
        <td class="celdas_subtotal"></td>
        <td class="titulo_grupo"></td>
        <td class="celdas_subtotal"></td>
        <td class="celdas_subtotal"></td>
        <td class="celdas_subtotal"></td>
        <td class="celdas_subtotal"></td>
      </tr>
      <?php }?>
      <tr>
        <td colspan="10"></td>
      </tr>
      <tr class="titulo_grupo">
        <td colspan="8" style="text-align:left;">A nivel Departamental</td>
        <td colspan="2" class="numerica"><?php echo $peso['de departamento']+$peso['Proyectos']." %";?></td>
      </tr>
      <tr class="titulo_dpo">
        <td width="6%">Obj. Estrat.</td>
        <td width="31%">Objetivo</td>
        <td width="6%">Código Indicador</td>
        <td width="32%">Indicador</td>
        <td width="6%">Meta a Alcanzar</td>
        <td width="1%" class="titulo_grupo celdas_subtotal"></td>
        <td colspan="2" width="12%">Horquilla</td>
        <td width="6%">Peso</td>
        <td></td>
      </tr>
      <?php
		$query_lin="SELECT * FROM vdpo_lineas WHERE dl_dpo_id=".$row['dpo_id']." AND (obj_tipo LIKE '".utf8_decode('de departamento')."' OR obj_tipo LIKE '".utf8_decode('Proyectos')."')";
		$result_lin=mysql_query($query_lin) or die ("No se puede ejecutar la sentencia: ".$query_lin);
		$num_lin=mysql_num_rows($result_lin);
		while($row_lin=mysql_fetch_array($result_lin)){?>
      		<tr class="filas_subtotal">
        		<td class="celdas_subtotal"><?php
					$query_ooe="SELECT * FROM vobjetivos_objetivos_estrategicos WHERE ooe_obj_id=".$row_lin['oa_obj_id']." ORDER BY oe_codigo";
					$result_ooe=mysql_query($query_ooe) or die ("No se puede ejecutar la sentencia: ".$query_ooe);
					while($row_ooe=mysql_fetch_array($result_ooe)){
						echo $row_ooe['oe_codigo']."<br>";
					}?>
             	</td>
        		<td class="celdas_subtotal"><?php echo utf8_encode($row_lin['obj_descripcion']);?></td>
<?php
					$query_oi="SELECT * FROM vobjetivos_indicadores WHERE oi_obj_id=".$row_lin['oa_obj_id']." ORDER BY ind_codigo";
					$result_oi=mysql_query($query_oi) or die ("No se puede ejecutar la sentencia: ".$query_oi);
					$num_oi=mysql_num_rows($result_oi);      ?>
                    <td class="celdas_subtotal <?php if(!$num_oi){?>celdas_vacias<?php }?>">
					<?php while($row_oi=mysql_fetch_array($result_oi)){
						echo $row_oi['ind_codigo']."<br>";
					}?>
              	</td>
        		<td class="celdas_subtotal"><?php
					if($num_oi){
						$query_oi="SELECT * FROM vobjetivos_indicadores WHERE oi_obj_id=".$row_lin['oa_obj_id']." ORDER BY ind_codigo";
						$result_oi=mysql_query($query_oi) or die ("No se puede ejecutar la sentencia: ".$query_oi);
						$num_oi=mysql_num_rows($result_oi);
					while($row_oi=mysql_fetch_array($result_oi)){
						echo utf8_encode($row_oi['ind_nombre'])."<br>";
			}
		}else{
			echo utf8_encode($row_lin['obj_indicador']);
		}?></td>
        <td class="numerica celdas_subtotal celdas_meta"><?php echo number_format($row_lin['oa_meta'],2,',','.')." %";?></td>
        <td class="titulo_grupo"></td>
        <td class="numerica celdas_subtotal"><?php echo number_format($row_lin['oa_horquilla_min'],2,',','.')." %";?></td>
        <td class="numerica celdas_subtotal"><?php echo number_format($row_lin['oa_horquilla_max'],2,',','.')." %";?></td>
        <td class="numerica celdas_subtotal celdas_peso"><input type="text" class="campo-corto-peso" value="<?php echo $row_lin['dl_peso'];?>" name="dl_peso"></td>
        <td class="celdas_subtotal celdas_peso"><a href="#" onClick="javascript:EliminarLinea(<?php echo $row_lin['dl_id'];?>,'<?php echo $dpo_ano;?>','<?php echo $dpo_usr_id;?>');"><img src="/img/borrar.png" width="20" height="20" alt="Borrar" title="Borrar"></a>
      </tr>
      <?php }
	  if(!$num_lin){?>
      <tr class="filas_vacias">
        <td class="celdas_subtotal"></td>
        <td class="celdas_subtotal"></td>
        <td class="celdas_subtotal"></td>
        <td class="celdas_subtotal"></td>
        <td class="celdas_subtotal"></td>
        <td class="titulo_grupo"></td>
        <td class="celdas_subtotal"></td>
        <td class="celdas_subtotal"></td>
        <td class="celdas_subtotal"></td>
        <td class="celdas_subtotal"></td>
      </tr>
      <?php }?>
      <tr>
        <td colspan="10"></td>
      </tr>
       <tr class="titulo_grupo">
        <td colspan="8" style="text-align:left;">A nivel Personal</td>
        <td colspan="2" class="numerica"><?php echo $peso['Personal']." %";?></td>
      </tr>
      <tr class="titulo_dpo">
        <td width="6%">Obj. Estrat.</td>
        <td width="31%">Objetivo</td>
        <td width="6%">Código Indicador</td>
        <td width="32%">Indicador</td>
        <td width="6%">Meta a Alcanzar</td>
        <td width="1%" class="titulo_grupo celdas_subtotal"></td>
        <td colspan="2" width="12%">Horquilla</td>
        <td width="6%">Peso</td>
        <td></td>
      </tr>
      <?php
		$query_lin="SELECT * FROM vdpo_lineas WHERE dl_dpo_id=".$row['dpo_id']." AND obj_tipo LIKE '".utf8_decode('Personal')."'";
		$result_lin=mysql_query($query_lin) or die ("No se puede ejecutar la sentencia: ".$query_lin);
		$num_lin=mysql_num_rows($result_lin);
		while($row_lin=mysql_fetch_array($result_lin)){?>
      		<tr class="filas_subtotal">
        		<td class="celdas_subtotal"><?php
					$query_ooe="SELECT * FROM vobjetivos_objetivos_estrategicos WHERE ooe_obj_id=".$row_lin['oa_obj_id']." ORDER BY oe_codigo";
					$result_ooe=mysql_query($query_ooe) or die ("No se puede ejecutar la sentencia: ".$query_ooe);
					while($row_ooe=mysql_fetch_array($result_ooe)){
						echo $row_ooe['oe_codigo']."<br>";
					}?>
             	</td>
        		<td class="celdas_subtotal"><?php echo utf8_encode($row_lin['obj_descripcion']);?></td>
<?php
					$query_oi="SELECT * FROM vobjetivos_indicadores WHERE oi_obj_id=".$row_lin['oa_obj_id']." ORDER BY ind_codigo";
					$result_oi=mysql_query($query_oi) or die ("No se puede ejecutar la sentencia: ".$query_oi);
					$num_oi=mysql_num_rows($result_oi);      ?>
                    <td class="celdas_subtotal <?php if(!$num_oi){?>celdas_vacias<?php }?>">
					<?php while($row_oi=mysql_fetch_array($result_oi)){
						echo $row_oi['ind_codigo']."<br>";
					}?>
              	</td>
        		<td class="celdas_subtotal"><?php
					if($num_oi){
						$query_oi="SELECT * FROM vobjetivos_indicadores WHERE oi_obj_id=".$row_lin['oa_obj_id']." ORDER BY ind_codigo";
						$result_oi=mysql_query($query_oi) or die ("No se puede ejecutar la sentencia: ".$query_oi);
						$num_oi=mysql_num_rows($result_oi);
					while($row_oi=mysql_fetch_array($result_oi)){
						echo utf8_encode($row_oi['ind_nombre'])."<br>";
			}
		}else{
			echo utf8_encode($row_lin['obj_indicador']);
		}?></td>
        <td class="numerica celdas_subtotal celdas_meta"><?php echo number_format($row_lin['oa_meta'],2,',','.')." %";?></td>
        <td class="titulo_grupo"></td>
        <td class="numerica celdas_subtotal"><?php echo number_format($row_lin['oa_horquilla_min'],2,',','.')." %";?></td>
        <td class="numerica celdas_subtotal"><?php echo number_format($row_lin['oa_horquilla_max'],2,',','.')." %";?></td>
        <td class="numerica celdas_subtotal celdas_peso"><input type="text" class="campo-corto-peso" value="<?php echo $row_lin['dl_peso'];?>" name="dl_peso"></td>
        <td class="celdas_subtotal celdas_peso"><a href="#" onClick="javascript:EliminarLinea(<?php echo $row_lin['dl_id'];?>,'<?php echo $dpo_ano;?>','<?php echo $dpo_usr_id;?>');"><img src="/img/borrar.png" width="20" height="20" alt="Borrar" title="Borrar"></a>
      </tr>
      <?php }
	  if(!$num_lin){?>
      <tr class="filas_vacias">
        <td class="celdas_subtotal"></td>
        <td class="celdas_subtotal"></td>
        <td class="celdas_subtotal"></td>
        <td class="celdas_subtotal"></td>
        <td class="celdas_subtotal"></td>
        <td class="titulo_grupo"></td>
        <td class="celdas_subtotal"></td>
        <td class="celdas_subtotal"></td>
        <td class="celdas_subtotal"></td>
        <td class="celdas_subtotal"></td>
      </tr>
      <?php }?>
       <tr>
        <td colspan="10"></td>
      </tr>
       <tr class="titulo_grupo">
        <td colspan="8" style="text-align:left;">TOTAL</td>
        <td colspan="2" class="numerica"><?php echo $peso['total']." %";?></td>
      </tr>
        <tr>
        <td colspan="9"></td>
      </tr>
      <tr class="filas_subtotal">
      <td colspan="3">Comentarios: <textarea name="dpo_observaciones" style="resize:none; vertical-align:text-top; width:300px; height:90px;"><?php echo utf8_encode($row['dpo_observaciones']);?></textarea></td>
      <td colspan="3">Estado: <select name="dpo_status_id">        <?php $query_st="SELECT * FROM status_dpo ORDER BY sd_id";
$result_st=mysql_query($query_st) or die("No se puede ejecutar la sentencia: ".$query_st);
while($row_st=mysql_fetch_array($result_st)){?>
<option value="<?php echo $row_st['sd_id'];?>"<?php if($row['dpo_status_id']==$row_st['sd_id']){?> selected<?php }?>><?php echo utf8_encode($row_st['sd_nombre']);?></option>
<?php }?>
</select>
	</td>
      <td colspan="4">Fecha último cambio: <?php echo cambiaf_a_normal($row['dpo_fecha_ultimo_cambio_status']);?></td>
     </tr>
     <tr class="filas_subtotal">
     <td colspan="10" align="center">
     <input type="button" value="Editar" class="boton-crear" onClick="document.location.href = 'edit.php?oa_id=<?php echo $oa_id;?>'">
            &nbsp;
            <input type="button" value="Volver a la lista" class="boton-crear" onClick="document.location.href = 'index.php'">
     </td>
     </tr>
 </table>
  </div>
</div>
<footer> </footer>
</body></html>
