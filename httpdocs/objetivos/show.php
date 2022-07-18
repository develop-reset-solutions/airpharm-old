<?php session_start();
include("../login/sesion_start.php");
include("../librerias/librerias.php");
include("../cabecera.php");
$conn=db_connect();
$obj_id=$_GET['obj_id'];
$dpo_id=$_GET['dpo_id'];
$query="SELECT * FROM vobjetivos WHERE obj_id=".$obj_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
$row=mysql_fetch_array($result);
$ano=$_SESSION['ano'];
?>
<link href="/css/style.css" rel="stylesheet" type="text/css">
<div id="content">
  <div style="width:100%;">
    <center>
      <table align="center" class="tabla_introduccion" style="min-width:750px;">
        <tr>
          <td colspan="2" class="titulo negrita">VER OBJETIVO</td>
        </tr>
        <tr>
          <td class="titulos_campos" width="20%">Descripción: </td>
          <td><?php echo utf8_encode($row['obj_descripcion']);?></td>
        </tr>
        <tr>
          <td class="titulos_campos">Responsable del objetivo:</td>
          <td><?php echo utf8_encode($row['usr_nombre']." ".$row['usr_apellidos']);?></td>
        </tr>
        <tr>
          <td class="titulos_campos">Tipo de objetivo: </td>
          <td><?php echo utf8_encode($row['obj_tipo']);?></td>
        </tr>
        <tr>
      <td colspan="2">
      <table width="100%">
      <tr>
      <td colspan="6" align="center" class="subtitulo negrita borde_todo">
      INDICADORES
      </td>
      <tr style="border-spacing:0; line-height:10px; font-weight:bold;">
      	<td colspan="3" class="borde_todo">&nbsp;</td>
        <td colspan="2" class="borde_todo">Horquilla</td>
        <td class="borde_todo">&nbsp;</td>
</tr>
<tr style="border-spacing:0; line-height:10px; font-weight:bold;">
        <td width="68%" class="borde_todo">Indicador</td>
        <td width="6%" class="borde_todo">Código</td>
        <td width="6%" class="borde_todo">Meta</td>
        <td width="6%" class="borde_todo">Min.</td>
        <td width="6%" class="borde_todo">Max.</td>
        <td width="8%" class="borde_todo">Acción</td>
        </tr>
      <?php
	  $query_ind="SELECT * FROM vobjetivos_ano WHERE ind_obj_id=".$obj_id." AND oa_ano=".$ano." ORDER BY ind_nombre ASC";

	  $result_ind=mysql_query($query_ind) or die ("No se puede ejecutar la sentencia: ".$query_ind);
	  while($row_ind=mysql_fetch_array($result_ind)){?>
   	  <tr class="filas_subtotal">
        <td class="borde_todo"><?php echo utf8_encode($row_ind['ind_nombre']);?></td>
        <td class="borde_todo"><?php echo utf8_encode($row_ind['ind_codigo']);?></td>
        <td class="numerica borde_todo"><?php echo $row_ind['oa_meta'];?></td>
        <td class="numerica borde_todo"><?php echo $row_ind['oa_horquilla_min'];?></td>
        <td class="numerica borde_todo"><?php echo $row_ind['oa_horquilla_max'];?></td>
        <td class="numerica borde_todo"><!--<a href="/medicion_objetivos/show.php?oa_id=<?php echo $row_ind['oa_id'];?>"><img src="/img/ver.png" width="20" height="20" alt="Ver detalles" title="Ver detalles"></a>&nbsp;<?php if($row['obj_lider_id']<>$_SESSION['usr_id']){?><a href="/medicion_objetivos/edit.php?oa_id=<?php echo $row_ind['oa_id'];?>"><img src="/img/editar.png" width="20" height="20" alt="Editar" title="Editar"></a>&nbsp;<a href="/medicion_objetivos/delete.php?oa_id=<?php echo $row['oa_id'];?>"><img src="/img/aceptar.png" width="20" height="20"></a><?php }?>--></td>
      </tr>
 <?php }?>
<!-- 		<tr class="filas_subtotal">
        <td colspan="6" align="center"><input type="button" value="Añadir indicador" class="boton-crear" onClick="document.location.href = 'create_indicador.php?obj_id=<?php echo $obj_id;?>'"></td>
        </tr>
-->      </table>
      </td>
      </tr>
      <td colspan="2">
      <table width="100%">
      <tr>
      <td colspan="2" align="center" class="subtitulo negrita borde_todo">
      OBJETIVOS ESTRATÉGICOS
      </td>
      </tr>
        <?php
        $cont ==0;
		$query_ooe="SELECT * FROM objetivos_objetivos_estrategicos WHERE ooe_obj_id=".$obj_id." ORDER BY ooe_oe_id ASC";
		$result_ooe=mysql_query($query_ooe) or die ("No se puede ejecutar la sentencia: ".$query_ooe);
		while ($row_ooe = mysql_fetch_array($result_ooe)){
			$cont ++;
			if (($cont % 2)!=0){?>
				<tr>
			<?php }
			$query_oe="SELECT * FROM objetivos_estrategicos WHERE oe_id=".$row_ooe['ooe_oe_id'];
			$result_oe=mysql_query($query_oe) or die ("No se puede ejecutar la sentencia: ".$query_oe);
			$row_oe=mysql_fetch_array($result_oe);
			?><td class="borde_todo" width="50%"><?php echo utf8_encode($row_oe['oe_codigo'].' '.$row_oe['oe_nombre']);?></td>
			<?php if (($cont % 2) ==0){?>
				</tr>
			<?php }
		}
		if (($cont % 2) !=0){?>
			<td>&nbsp;  </td>
			</tr>
		<?php }
		?>
      </table>
      </td>
      </tr>
        <tr>
          <td colspan="2" align="center"><input type="button" value="Editar" class="boton-crear" onClick="document.location.href = 'edit.php?obj_id=<?php echo $obj_id;?>&dpo_id=<?php echo $dpo_id;?>'">
      &nbsp;
      <input type="button" value="Volver a la dpo" class="boton-crear" onClick="document.location.href = '/dpo/index.php?dpo_id=<?php echo $dpo_id;?>'">            &nbsp;
            <input type="button" value="Volver a la lista" class="boton-crear" onClick="document.location.href = 'index.php'"></td>
        </tr>
      </table>
    </center>
  </div>
</div>
<footer> </footer>
</body></html>