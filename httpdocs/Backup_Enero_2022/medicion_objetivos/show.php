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
      <table align="center" class="tabla_introduccion" width="100%">
        <tr>
          <td colspan="2" class="titulo negrita">VER MEDICIONES INDICADOR</td>
        </tr>
        <tr>
          <td colspan="2"><span class="titulos_campos">Objetivo:</span> <?php echo utf8_encode($row['obj_descripcion']);?></td>
        </tr>
        <tr>
          <td colspan="2"><span class="titulos_campos">Indicador:</span> <?php echo utf8_encode($row['ind_nombre']);?></td>
        </tr>
        <tr>
          <td colspan="2"><span class="titulos_campos">Código del indicador:</span> <?php echo utf8_encode($row['ind_codigo']);?></td>
        </tr>
        <tr>
         <td width="50%"><span class="titulos_campos">Año:</span> <?php echo utf8_encode($row['oa_ano']);?></td>
          <td width="50%"><span class="titulos_campos">Responsable del indicador:</span> <?php echo utf8_encode($row['usr_nombre']." ".$row['usr_apellidos']);?></td>
        </tr>
        <tr>
          <td width="50%" colspan="2"><span class="titulos_campos">Responsable de medición:</span> <?php echo utf8_encode($row['usr_nombre_mide']." ".$row['usr_apellido_mide']);?></td>
        </tr>
        <tr>
           <td><span class="titulos_campos">Horquilla mínima:</span> <?php echo utf8_encode($row['oa_horquilla_min']);?></td>
           <td><span class="titulos_campos">Horquilla máxima:</span> <?php echo utf8_encode($row['oa_horquilla_max']);?></td>
        </tr>
        <tr>
           <td><span class="titulos_campos">Unidad horquilla:</span> <?php echo utf8_encode($row['un_nombre_horq']);?></td>
            <td><span class="titulos_campos">Tipo medición:</span> <?php echo $row['ind_trim_acum'];?></td>
       </tr>
        <tr>
          <td><span class="titulos_campos">Meta:</span> <?php echo utf8_encode($row['oa_meta']);?></td>
          <td><span class="titulos_campos">Unidad meta:</span> <?php echo utf8_encode($row['un_nombre_meta']);?></td>
        </tr>
        <tr>
          <td><span class="titulos_campos">Tipo:</span> <?php echo utf8_encode($row['obj_tipo']);?></td>
          <td><span class="titulos_campos">Medición grupo/individual:</span> <?php echo utf8_encode($row['ind_grupo_individual']);?></td>
        </tr>
        <tr>
          <td colspan="2"><span class="titulos_campos">Observaciones:</span> <?php echo utf8_encode($row['oa_observaciones']);?></td>
        </tr>
        <tr>
        <td colspan="2" align="center"><span class="titulos_campos">Mediciones</span></td>
        </tr><tr>
        <td colspan="2" align="center">
            <table>
            <tr class="titulo_dpo">
            <td>
            </td>
			<td>
            T1</td>	
			<td>
            T2</td>	
			<td>
            T3</td>	
			<td>
            T4</td>
            <td>
            Final</td>
            </tr>
        <?php if(utf8_encode($row['ind_grupo_individual'])=='Grupo'){
			$query_dl="SELECT * FROM dpo_lineas WHERE dl_oa_id=".$oa_id;
			$result_dl=mysql_query($query_dl) or die("No se puede ejecutar la sentencia: ".$query_dl);
			$row_dl=mysql_fetch_array($result_dl);
			?>
            <tr class="filas_subtotal">
            <td class="celdas_subtotal">
            Total
            </td>
			<td class="celdas_meta celdas_subtotal">
            <?php echo $row_dl['dl_rdo_q1'];?></td>	
			<td class="celdas_meta celdas_subtotal">
            <?php echo $row_dl['dl_rdo_q2'];?></td>	
			<td class="celdas_meta celdas_subtotal">
            <?php echo $row_dl['dl_rdo_q3'];?></td>	
			<td class="celdas_meta celdas_subtotal">
            <?php echo $row_dl['dl_rdo_q4'];?></td>	
            <td class="celdas_meta celdas_subtotal">
            <?php echo $row_dl['dl_rdo_anual'];?></td>
            </tr>
		<?php }else{
			$query_dl="SELECT * FROM vdpo_lineas WHERE dl_oa_id=".$oa_id." ORDER BY usr_apellidos ASC, usr_nombre ASC";
			$result_dl=mysql_query($query_dl) or die("No se puede ejecutar la sentencia: ".$query_dl);
			while($row_dl=mysql_fetch_array($result_dl)){
			?>
            <tr class="filas_subtotal">
            <td class="celdas_subtotal">
            <?php echo utf8_encode($row_dl['usr_apellidos'].", ".$row_dl['usr_nombre']);?>
            </td>
			<td class="celdas_meta celdas_subtotal">
            <?php echo $row_dl['dl_rdo_q1'];?></td>	
			<td class="celdas_meta celdas_subtotal">
            <?php echo $row_dl['dl_rdo_q2'];?></td>	
			<td class="celdas_meta celdas_subtotal">
            <?php echo $row_dl['dl_rdo_q3'];?></td>	
			<td class="celdas_meta celdas_subtotal">
            <?php echo $row_dl['dl_rdo_q4'];?></td>	
            <td class="celdas_meta celdas_subtotal">
            <?php echo $row_dl['dl_rdo_anual'];?></td>
            </tr>
        <?php }}?>
       </table>		        </td>
        </tr>
        <tr>
          <td colspan="4" align="center"><input type="button" value="Editar" class="boton-crear" onClick="document.location.href = 'edit.php?oa_id=<?php echo $oa_id;?>&dpo_id=<?php echo $dpo_id;?>'">     &nbsp;
      <input type="button" value="Editar usuarios" class="boton-crear" onClick="document.location.href = '/objetivos/edit_usuarios.php?oa_id=<?php echo $oa_id;?>&dpo_id=<?php echo $dpo_id;?>'">      &nbsp;
      <input type="button" value="Volver a la dpo" class="boton-crear" onClick="document.location.href = '/dpo/index.php?dpo_id=<?php echo $dpo_id;?>'">
            &nbsp;
            <input type="button" value="Volver a la lista" class="boton-crear" onClick="document.location.href = 'index.php#ind_<?php echo $oa_id;?>'"></td>
        </tr>
      </table>
    </center>
  </div>
</div>
<footer> </footer>
</body></html>