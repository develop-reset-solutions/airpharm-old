<?php session_start();
include("../login/sesion_start.php");
include("../librerias/librerias.php");
include("../cabecera.php");
$conn=db_connect();
$oa_id=$_GET['oa_id'];
$dpo_id=$_GET['dpo_id'];
$query="SELECT * FROM vobjetivos_ano WHERE oa_id=".$oa_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
$row=mysql_fetch_array($result);
?>
<link href="/css/style.css" rel="stylesheet" type="text/css">
<div id="content">
<div style="width:100%;">
<center>
<form action="modify.php?dpo_id=<?php echo $dpo_id;?>" method="post" onSubmit="return Valida(this);" style="text-align:-moz-center;">
<table align="center" class="tabla_introduccion" width="100%">
  <tr>
    <td colspan="2" class="titulo negrita">EDITAR INDICADOR</td>
  </tr>
  <tr>
    <td colspan="2"><span class="titulos_campos">Objetivo:</span> <?php echo utf8_encode($row['obj_descripcion']);?></td>
  </tr>
  <tr>
    <td colspan="2"><span class="titulos_campos">Indicador:</span> <input type="text" name="ind_nombre" value="<?php echo utf8_encode($row['ind_nombre']);?>" class="campo-doble"></td>
  </tr>

  <tr>
    <td colspan="2"><span class="titulos_campos">Código del indicador:</span> <input type="text" name="ind_codigo" value="<?php echo utf8_encode($row['ind_codigo']);?>" class="campo-corto"></td>
  </tr>

  <tr>
    <td width="50%" colspan="2"><span class="titulos_campos">Año:</span> <?php echo utf8_encode($row['oa_ano']);?></td>
  </tr>
  <tr>
    <td width="50%"><span class="titulos_campos">Responsable de definición:</span>
      <?php if($_SESSION['usr_id']==$row['ind_responsable'] or $_SESSION['usr_perfil']=='Director RRHH'){?>
      <select name="ind_responsable" class="campo-largo" required>
        <option value="">Seleccionar responsable ...</option>
        <?php $query_usr="SELECT * FROM usuarios WHERE usr_baja=0 AND (usr_perfil<>'Director General' AND usr_perfil<>'Administrador') ORDER BY usr_apellidos, usr_nombre ASC";
				$result_usr=mysql_query($query_usr) or die ("No se puede ejecutar la sentencia: ".$query_usr);
				while($row_usr=mysql_fetch_array($result_usr)){?>
        <option value="<?php echo $row_usr['usr_id'];?>"<?php if($row_usr['usr_id']==$row['ind_responsable']){?> selected="selected"<?php }?>><?php echo utf8_encode($row_usr['usr_apellidos'].", ".$row_usr['usr_nombre']);?></option>
        <?php }?>
      </select>
      <?php }else{?>
      <input type="hidden" name="ind_responsable" value="<?php echo $row['ind_responsable'];?>">
      <?php echo utf8_encode($row['usr_apellidos'].", ".$row['usr_nombre']);}?></td>
    <td width="50%"><span class="titulos_campos">Responsable de medición:</span>
      <?php if($_SESSION['usr_id']==$row['ind_responsable'] or $_SESSION['usr_perfil']=='Director RRHH'){?>
      <select name="ind_mide" class="campo-largo" required>
        <option value="">Seleccionar responsable ...</option>
        <?php $query_usr="SELECT * FROM usuarios WHERE usr_baja=0 AND (usr_perfil<>'Director General' AND usr_perfil<>'Administrador') ORDER BY usr_apellidos, usr_nombre ASC";
				$result_usr=mysql_query($query_usr) or die ("No se puede ejecutar la sentencia: ".$query_usr);
				while($row_usr=mysql_fetch_array($result_usr)){?>
        <option value="<?php echo $row_usr['usr_id'];?>"<?php if($row_usr['usr_id']==$row['ind_mide']){?> selected="selected"<?php }?>><?php echo utf8_encode($row_usr['usr_apellidos'].", ".$row_usr['usr_nombre']);?></option>
        <?php }?>
      </select>
      <?php }else{?>
      <input type="hidden" name="ind_mide" value="<?php echo $row['ind_mide'];?>">
      <?php echo utf8_encode($row['usr_apellido_mide'].", ".$row['usr_nombre_mide']);}?></td>
  </tr>
  <tr>
    <td><span class="titulos_campos">Horquilla mínima:</span>
      <?php if($_SESSION['usr_id']==$row['ind_responsable'] or $_SESSION['usr_perfil']=='Director RRHH'){?>
      <input type="text" name="oa_horquilla_min" class="campo-corto" value="<?php echo $row['oa_horquilla_min'];?>">
      <?php }else{?>
      <input type="hidden" name="oa_horquilla_min" value="<?php echo $row['oa_horquilla_min'];?>">
      <?php echo $row['oa_horquilla_min'];}?></td>
    <td><span class="titulos_campos">Horquilla máxima:</span>
      <?php if($_SESSION['usr_id']==$row['ind_responsable'] or $_SESSION['usr_perfil']=='Director RRHH'){?>
      <input type="text" name="oa_horquilla_max" class="campo-corto" value="<?php echo $row['oa_horquilla_max'];?>">
      <?php }else{?>
      <input type="hidden" name="oa_horquilla_max" value="<?php echo $row['oa_horquilla_max'];?>">
      <?php echo $row['oa_horquilla_max'];}?></td>
  </tr>
  <tr>
      <td>
    <span class="titulos_campos">Unidad horquilla:</span>
    <select name="ind_horq_un_id" disabled>
      <option value="">Seleccionar unidad...</option>
      <?php $query_un="SELECT * FROM unidades ORDER BY un_nombre ASC";
				$result_un=mysql_query($query_un) or die ("No se puede ejecutar la sentencia: ".$query_un);
				while($row_un=mysql_fetch_array($result_un)){?>
      <option value="<?php echo $row_un['un_id'];?>"<?php if($row_un['un_id']==$row['ind_horq_un_id']){?> selected="selected"<?php }?>><?php echo utf8_encode($row_un['un_nombre']);?></option>
      <?php }?>
        </td>
        <td>
        <span class="titulos_campos">
        Tipo medición:
        </span>
      <?php if($_SESSION['usr_id']==$row['ind_responsable'] or $_SESSION['usr_perfil']=='Director RRHH'){?>
        <select name="ind_trim_acum" required>
      <option value="">Seleccionar tipo...</option>
      <option value="Acumulado"<?php if('Acumulado'==$row['ind_trim_acum']){?> selected="selected"<?php }?>>Acumulado</option>
      <option value="Trimestral"<?php if('Trimestral'==$row['ind_trim_acum']){?> selected="selected"<?php }?>>Trimestral</option>
    </select>
    <?php }else{?>
    <input type="hidden" name="ind_trim_acum" value="<?php echo $row['ind_trim_acum'];?>">
    <?php echo $row['ind_trim_acum'];}?>
      </td>
  </tr>
  <tr>
    <td><span class="titulos_campos">Meta:</span>
      <?php if($_SESSION['usr_id']==$row['ind_responsable'] or $_SESSION['usr_perfil']=='Director RRHH'){?>
      <input type="text" name="oa_meta" class="campo-corto" value="<?php echo $row['oa_meta'];?>">
      <?php }else{?>
      <input type="hidden" name="oa_meta" value="<?php echo $row['oa_meta'];?>">
      <?php echo $row['oa_meta'];}?></td>
    <td><span class="titulos_campos">Unidad meta:</span>
      <?php if($_SESSION['usr_id']==$row['ind_responsable'] or $_SESSION['usr_perfil']=='Director RRHH'){?>
      <select name="ind_meta_un_id" required>
        <option value="">Seleccionar unidad...</option>
        <?php $query_un="SELECT * FROM unidades ORDER BY un_nombre ASC";
				$result_un=mysql_query($query_un) or die ("No se puede ejecutar la sentencia: ".$query_un);
				while($row_un=mysql_fetch_array($result_un)){?>
        <option value="<?php echo $row_un['un_id'];?>"<?php if($row_un['un_id']==$row['ind_meta_un_id']){?> selected="selected"<?php }?>><?php echo utf8_encode($row_un['un_nombre']);?></option>
        <?php }?>
      </select>
      <?php }else{?>
      <input type="hidden" name="ind_meta_un_id" value="<?php echo $row['ind_meta_un_id'];?>">
      <?php echo $row['un_nombre_meta'];}?></td>
  </tr>
	<?php if($row['obj_tipo']==utf8_decode('Objetivo de Compañía') or $row['obj_tipo']==utf8_decode('Para el Comité de Dirección') or utf8_encode($row['obj_tipo'])=='Mandos Intermedios'){
		$query_dl="SELECT * FROM dpo_lineas WHERE dl_oa_id=".$oa_id;
		$result_dl=mysql_query($query_dl) or die ("No se puede ejecutar la sentencia: ".$query_dl);
		$row_dl=mysql_fetch_array($result_dl);?>

  <tr>
    <td><span class="titulos_campos">Peso:</span>
      <?php if($_SESSION['usr_id']==$row['ind_responsable'] or $_SESSION['usr_perfil']=='Director RRHH'){?>
      <input type="text" name="dl_peso" class="campo-corto" value="<?php echo $row_dl['dl_peso'];?>">
      <?php }else{?>
      <input type="hidden" name="dl_peso" value="<?php echo $row_dl['dl_peso'];?>">
      <?php echo $row_dl['dl_peso'];}?></td>
<?php }?>         <td>
        <span class="titulos_campos">
        Medición grupo/individual:
        </span>
      <?php if($_SESSION['usr_id']==$row['ind_responsable'] or $_SESSION['usr_perfil']=='Director RRHH'){?>
        <select name="ind_grupo_individual" required>
      <option value="">Seleccionar tipo...</option>
      <option value="Grupo"<?php if('Grupo'==$row['ind_grupo_individual']){?> selected="selected"<?php }?>>Grupo</option>
      <option value="Individual"<?php if('Individual'==$row['ind_grupo_individual']){?> selected="selected"<?php }?>>Individual</option>
    </select>
    <?php }else{?>
    <input type="hidden" name="ind_grupo_individual" value="<?php echo $row['ind_grupo_individual'];?>">
    <?php echo $row['ind_grupo_individual'];}?>
      </td>
 </tr>

  <tr>
    <td colspan="2"><span class="titulos_campos">Tipo:</span> <?php echo utf8_encode($row['obj_tipo']);?></td>
  </tr>
  <tr>
    <td colspan="2"><span class="titulos_campos" style="vertical-align:top">Observaciones:</span> <textarea style="width:910px; height:70px; resize:none;" name="oa_observaciones" id="oa_observaciones"><?php echo utf8_encode($row['oa_observaciones']);?></textarea></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><span class="titulos_campos">Mediciones</span></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center"><table>
        <tr class="titulo_dpo">
          <td></td>
          <td> T1</td>
          <td> T2</td>
          <td> T3</td>
          <td> T4</td>
          <td> Final</td>
        </tr>
        <input type="hidden" name="oa_id" value="<?php echo $oa_id;?>">
        <?php if(utf8_encode($row['ind_grupo_individual'])=='Grupo'){
			$query_dl="SELECT * FROM dpo_lineas WHERE dl_oa_id=".$oa_id;
			$result_dl=mysql_query($query_dl) or die("No se puede ejecutar la sentencia: ".$query_dl);
			$row_dl=mysql_fetch_array($result_dl);
			?>
        <tr class="filas_subtotal">
          <td class="celdas_subtotal"> Total </td>
          <td class="celdas_meta celdas_subtotal"><?php if($_SESSION['usr_id']==$row['ind_mide']){?>
            <input type="text" name="dl_rdo_q1_all" value="<?php echo $row_dl['dl_rdo_q1'];?>" >
            <?php }else{?>
            <input type="hidden" name="dl_rdo_q1_all" value="<?php echo $row_dl['dl_rdo_q1'];?>" >
            <?php echo $row_dl['dl_rdo_q1'];}?></td>
          <td class="celdas_meta celdas_subtotal"><?php if($_SESSION['usr_id']==$row['ind_mide']){?>
            <input type="text" name="dl_rdo_q2_all" value="<?php echo $row_dl['dl_rdo_q2'];?>" >
            <?php }else{?>
            <input type="hidden" name="dl_rdo_q2_all" value="<?php echo $row_dl['dl_rdo_q2'];?>" >
            <?php echo $row_dl['dl_rdo_q2'];}?></td>
          <td class="celdas_meta celdas_subtotal"><?php if($_SESSION['usr_id']==$row['ind_mide']){?>
            <input type="text" name="dl_rdo_q3_all" value="<?php echo $row_dl['dl_rdo_q3'];?>" >
            <?php }else{?>
            <input type="hidden" name="dl_rdo_q3_all" value="<?php echo $row_dl['dl_rdo_q3'];?>" >
            <?php echo $row_dl['dl_rdo_q3'];}?></td>
          <td class="celdas_meta celdas_subtotal"><?php if($_SESSION['usr_id']==$row['ind_mide']){?>
            <input type="text" name="dl_rdo_q4_all" value="<?php echo $row_dl['dl_rdo_q4'];?>" >
            <?php }else{?>
            <input type="hidden" name="dl_rdo_q4_all" value="<?php echo $row_dl['dl_rdo_q4'];?>" >
            <?php echo $row_dl['dl_rdo_q4'];}?></td>
          <td class="celdas_meta celdas_subtotal"><?php if($_SESSION['usr_id']==$row['ind_mide']){?>
            <input type="text" name="dl_rdo_anual_all" value="<?php echo $row_dl['dl_rdo_anual'];?>" >
            <?php }else{?>
            <input type="hidden" name="dl_rdo_anual_all" value="<?php echo $row_dl['dl_rdo_anual'];?>" >
            <?php echo $row_dl['dl_rdo_anual'];}?></td>
        </tr>
        <?php }else{
			$query_dl="SELECT * FROM vdpo_lineas WHERE dl_oa_id=".$oa_id." ORDER BY usr_apellidos ASC, usr_nombre ASC";
			$result_dl=mysql_query($query_dl) or die("No se puede ejecutar la sentencia: ".$query_dl);
			while($row_dl=mysql_fetch_array($result_dl)){
				$es_superior=false;
				if($row['ind_mide']==9999){
					$es_superior=superior($_SESSION['usr_id'],$row_dl['dpo_usr_id']);
				}
			?>
        <tr class="filas_subtotal">
          <td class="celdas_subtotal"><?php echo utf8_encode($row_dl['usr_apellidos'].", ".$row_dl['usr_nombre']);?></td>
          <td class="celdas_meta celdas_subtotal"><?php if($_SESSION['usr_id']==$row['ind_mide'] or $es_superior){?>
            <input type="text" name="dl_rdo_q1_<?php echo $row_dl['dl_id'];?>" value="<?php echo $row_dl['dl_rdo_q1'];?>">
            <?php }else{?>
            <input type="hidden" name="dl_rdo_q1_<?php echo $row_dl['dl_id'];?>" value="<?php echo $row_dl['dl_rdo_q1'];?>">
            <?php echo $row_dl['dl_rdo_q1'];}?></td>
          <td class="celdas_meta celdas_subtotal"><?php if($_SESSION['usr_id']==$row['ind_mide'] or $es_superior){?>
            <input type="text" name="dl_rdo_q2_<?php echo $row_dl['dl_id'];?>" value="<?php echo $row_dl['dl_rdo_q2'];?>">
            <?php }else{?>
            <input type="hidden" name="dl_rdo_q2_<?php echo $row_dl['dl_id'];?>" value="<?php echo $row_dl['dl_rdo_q2'];?>">
            <?php echo $row_dl['dl_rdo_q2'];}?></td>
          <td class="celdas_meta celdas_subtotal"><?php if($_SESSION['usr_id']==$row['ind_mide'] or $es_superior){?>
            <input type="text" name="dl_rdo_q3_<?php echo $row_dl['dl_id'];?>" value="<?php echo $row_dl['dl_rdo_q3'];?>">
            <?php }else{?>
            <input type="hidden" name="dl_rdo_q3_<?php echo $row_dl['dl_id'];?>" value="<?php echo $row_dl['dl_rdo_q3'];?>">
            <?php echo $row_dl['dl_rdo_q3'];}?></td>
          <td class="celdas_meta celdas_subtotal"><?php if($_SESSION['usr_id']==$row['ind_mide'] or $es_superior){?>
            <input type="text" name="dl_rdo_q4_<?php echo $row_dl['dl_id'];?>" value="<?php echo $row_dl['dl_rdo_q4'];?>">
            <?php }else{?>
            <input type="hidden" name="dl_rdo_q4_<?php echo $row_dl['dl_id'];?>" value="<?php echo $row_dl['dl_rdo_q4'];?>">
            <?php echo $row_dl['dl_rdo_q4'];}?></td>
          <td class="celdas_meta celdas_subtotal"><?php if($_SESSION['usr_id']==$row['ind_mide'] or $es_superior){?>
            <input type="text" name="dl_rdo_anual_<?php echo $row_dl['dl_id'];?>" value="<?php echo $row_dl['dl_rdo_anual'];?>">
            <?php }else{?>
            <input type="hidden" name="dl_rdo_anual_<?php echo $row_dl['dl_id'];?>" value="<?php echo $row_dl['dl_rdo_anual'];?>">
            <?php echo $row_dl['dl_rdo_anual'];}?></td>
        </tr>
        <?php }}?>
      </table>
    </td>

  </tr>
  <tr>
    <td colspan="4" align="center"><input type="submit" value="Guardar" class="boton-crear">
      &nbsp;
      <input type="button" value="Editar usuarios" class="boton-crear" onClick="document.location.href = '/objetivos/edit_usuarios.php?oa_id=<?php echo $oa_id;?>&dpo_id=<?php echo $dpo_id;?>'">
      &nbsp;
      <input type="button" value="Volver a la dpo" class="boton-crear" onClick="document.location.href = '/dpo/index.php?dpo_id=<?php echo $dpo_id;?>'">      &nbsp;
      <input type="button" value="Volver a la lista" class="boton-crear" onClick="document.location.href = 'index.php#ind_<?php echo $oa_id;?>'">
</td>
  </tr>
</table>
</center>
</div>
</div>
<footer> </footer>
</body>
</html>
