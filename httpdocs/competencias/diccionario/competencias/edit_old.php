<?php 
session_start();
include("../../../login/sesion_start.php");
include("../../../login/sesion_start_rrhh.php");
include("../../../librerias/librerias.php");
include("../../../cabecera-competencias.php");
$conn=db_connect();
?>
<script language="javascript">
	function cambiar_com_id(val,val2){
		window.location="show_c.php?com_id="+val+"&dic_id="+val2;
		}
	function guardar_cambio(val1,val2){	
	//No se como hacer para recuperar el valor del select para enviar
		var act_id=document.getElementById(val2).value;
		document.location.href = 'cambiar_act.php?cd_id='+val1+'&grado='+val2+'&act_id='+act_id
		}
</script>
<?php 
$com_id=$_REQUEST['com_id'];
$dic_id=$_REQUEST['dic_id'];
$query_dic="SELECT * FROM com_diccionarios WHERE dic_id=".$dic_id;
$result_dic=mysql_query($query_dic) or die ("No se puede ejecutar la sentencia: ".$query_dic);
$row_dic=mysql_fetch_array($result_dic)
?>
<link href="../../../css/style.css" rel="stylesheet" type="text/css">
<div id="content">
  <div class="cabecera_apartados">
    <div class="filtros">
    
      <form method="post" action="#">
        <table align="center" width="100%">
        <tr>
          <td colspan="7">Competencias de <?php echo $row_dic['dic_nombre'] ?></td>
        </tr>
        <tr>
        <!--
        <td class="texto_10">
        	<select name="com_id" onchange="cambiar_com_id(this.value,<?php echo $dic_id ?>)">
        		<?php 
				$query_com_dic="SELECT * FROM com_com_dic WHERE cd_dic_id=".$dic_id." order by cd_orden";
            	$result_com_dic=mysql_query($query_com_dic) or die ("No se puede ejecutar la sentencia: ".$query_com_dic);
           		while($row_com_dic=mysql_fetch_array($result_com_dic)){
					$query_com="SELECT * FROM com_competencias WHERE com_id=".$row_com_dic['cd_com_id'];
            		$result_com=mysql_query($query_com) or die ("No se puede ejecutar la sentencia: ".$query_com);
					$row_com=mysql_fetch_array($result_com)
					
					 ?>
					
					 <option value="<?php echo $row_com['com_id']?>" 
					 <?php if ($row_com['com_id']==$com_id){$com_nombre=$row_com['com_nombre']; $com_descripcion=$row_com['com_descripcion']; echo "selected";}?>>
					 <?php echo utf8_encode($row_com['com_nombre'])?></option> 
				<?php }?>
            </select></td>
            -->
            <td style="background-color:transparent; width:1200px;">
              </td>
		</tr>
        </table>
      </form>
      
    </div>
  </div>
  <div class="tabla_dpo">
   <form action="edit.php?com_id=<?php echo $com_id ?>&amp;dic_id=<?php echo $dic_id ?>" and cd_com_id=".$com_id?>" method="post" enctype="multipart/form-data">
    <table width="100%">
      
      <!--<input type="hidden" name="dpo_id" value="<?php echo $row['dpo_id'];?>" />-->
      <tr>
        <td colspan="2" class="titulo"><?php echo utf8_encode($com_nombre);?></td>
      </tr>
      <tr>
        <td colspan="2" class="filas_subtotal" style="font-size: 15px; padding: 15px 10px;"><?php echo utf8_encode($com_descripcion);?></td>
      </tr>
       <tr>
        <td colspan="2"></td>
      </tr>
      <?php //repasar los selects o mirar de hacerlo con la vista cuando vaya bien.
	  $query_com_dic="SELECT * FROM com_com_dic WHERE cd_dic_id=".$dic_id." and cd_com_id=".$com_id." order by cd_orden";
      $result_com_dic=mysql_query($query_com_dic) or die ("No se puede ejecutar la sentencia: ".$query_com_dic);
      $row_com_dic=mysql_fetch_array($result_com_dic);
	  $cd_id=$row_com_dic['cd_id'];
 	  $query_act_com_dic="SELECT * FROM com_act_com_dic WHERE acd_cd_id=".$cd_id;
	  $result_act_com_dic=mysql_query($query_act_com_dic) or die ("No se puede ejecutar la sentencia: ".$query_act_com_dic);
	  
	  while($row_act_com_dic=mysql_fetch_array($result_act_com_dic)){
		$grado=$row_act_com_dic['acd_grado'];
		/*
		$query_act="SELECT * FROM com_actitudes WHERE act_id=".$row_act_com_dic['acd_act_id'];
		$result_act=mysql_query($query_act) or die ("No se puede ejecutar la sentencia: ".$query_act);
		$row_act=mysql_fetch_array($result_act);
		*/
		 ?>
		<tr class="filas_subtotal">
			<td class="celdas_subtotal" style="text-align:left;"> Grado <?php echo $grado;?>. 
			<select name="com_id" id="<?php echo $grado;?>">
        		<?php 
				$query_actitud="SELECT * FROM com_actitudes";
            	$result_actitud=mysql_query($query_actitud) or die ("No se puede ejecutar la sentencia: ".$query_actitud);
           		while($row_actitud=mysql_fetch_array($result_actitud)){
					
					 ?>
					
					 <option value="<?php echo $row_actitud['act_id']?>" 
					 <?php if ($row_actitud['act_id']==$row_act_com_dic['acd_act_id']){ echo "selected";}?>>
					 <?php echo utf8_encode($row_actitud['act_nombre'])?></option> 
				<?php }?>
            </select>
			<!--<input type="button" class="boton-principal texto_verde" value="Informes" onClick="document.location.href = '/informes'">-->
            &nbsp;<input type="button" name="Guardar" id="Guardar" value="Guardar Cambio" onClick="guardar_cambio(<?php echo $cd_id?>,'<?php echo $grado;?>')"/>
            &nbsp;<input type="button" name="Modificar" id="Modificar" value="Modificar Comportamientos"/>
            	<!--<a href="edit_c.php?com_id=<?php echo $row_com['com_id'];?>"><img src="/img/editar.png" width="20" height="20" alt="Editar" title="Editar"></a>-->
            </td>
		</tr>				
		<?php /*$query_comp_act_com_dic="SELECT * FROM com_comp_act_com_dic WHERE cacd_acd_id=".$row_act_com_dic['acd_id'];
	  	$result_comp_act_com_dic=mysql_query($query_comp_act_com_dic) or die ("No se puede ejecutar la sentencia: ".$query_comp_act_com_dic);
	 	while($row_comp_act_com_dic=mysql_fetch_array($result_comp_act_com_dic)){
		$query_comp="SELECT * FROM com_comportamientos WHERE comp_id=".$row_comp_act_com_dic['cacd_comp_id'];
		$result_comp=mysql_query($query_comp) or die ("No se puede ejecutar la sentencia: ".$query_comp);
		$row_comp=mysql_fetch_array($result_comp);
		?>	
			<tr class="filas_subtotal">
				<td class="celdas_subtotal"> <?php echo utf8_encode($row_comp_act_com_dic['cacd_numero']);?>. <?php echo utf8_encode($row_comp['comp_nombre']);?></td>
				<td class="celdas_subtotal">
            		<a href="edit_c.php?com_id=<?php echo $row_com['com_id'];?>"><img src="/img/editar.png" width="20" height="20" alt="Editar" title="Editar"></a>
            	</td>
			</tr>	
		<?php }		
		*/
	  }
	  
	  ?>
     <!--
        <td colspan="2" class="filas_subtotal" align="center">
        	<input type="submit" name="Editar" id="Editar" value="Editar"/>
          <input type="button" name="Guardar" id="Guardar" value="Guardar"/>
          &nbsp;
          &nbsp;
          <input type="submit" name="Guardar" id="Guardar" value="Guardar y seguir" />
          &nbsp;
          &nbsp;
          <input type="submit" value="Descartar cambios" /></td>-->
      </tr>
    </table>
    </form>
    </td>
    </tr>
    </table>
  </div>
</div>
<footer> </footer>
</body></html>