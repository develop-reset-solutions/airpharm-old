<?php session_start();
include("../login/sesion_start.php");
include("../librerias/librerias.php");
include("../cabecera.php");
$conn=db_connect();
$oa_id=$_GET['oa_id'];
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
          <td colspan="2" class="titulo negrita">VER OBJETIVO</td>
        </tr>
        <tr>
          <td colspan="2"><span class="titulos_campos">Estado:</span> <?php echo utf8_encode($row['sd_nombre']);?></td>
        </tr>
        <tr>
          <td colspan="2"><span class="titulos_campos">Descripción:</span> <?php echo utf8_encode($row['obj_descripcion']);?></td>
        </tr>
        <tr>
         <td width="50%"><span class="titulos_campos">Año:</span> <?php echo utf8_encode($row['oa_ano']);?></td>
          <td width="50%"><span class="titulos_campos">Responsable del objetivo:</span> <?php echo utf8_encode($row['obj_nombre']." ".$row['obj_apellidos']);?></td>
        </tr>
        <tr>
           <td><span class="titulos_campos">Horquilla mínima:</span> <?php echo utf8_encode($row['oa_horquilla_min']);?></td>
           <td><span class="titulos_campos">Horquilla máxima:</span> <?php echo utf8_encode($row['oa_horquilla_max']);?></td>
        </tr>
        <tr>
          <td><span class="titulos_campos">Meta:</span> <?php echo utf8_encode($row['oa_meta']);?></td>
          <td><span class="titulos_campos">Unidad:</span> <?php echo utf8_encode($row['obj_unidad']);?></td>
        </tr>
        <tr>
          <td><span class="titulos_campos">Tipo:</span> <?php echo utf8_encode($row['obj_tipo']);?></td>
          <td><span class="titulos_campos">Observaciones:</span> <?php echo utf8_encode($row['oa_observaciones']);?></td>
        </tr>
        <tr>
        <td colspan="2" align="center"><span class="titulos_campos">Usuarios</span></td>
        </tr><tr>
        <td colspan="2">
        <?php if(utf8_encode($row['obj_tipo'])=='Objetivo de Compañía'){?>
		Todos        
		<?php }else{?>
        <table width="100%">
        <?php $query_usr="SELECT * FROM vobj_ano_usuarios WHERE oau_oa_id=".$oa_id." ORDER BY usr_apellidos, usr_nombre ASC";
			$result_usr=mysql_query($query_usr) or die("No se puede ejecutar la sentencia: ".$query_usr);
	        $cont =1;
			while($row_usr=mysql_fetch_array($result_usr)){
  			if (($cont % 2)!=0){?>
				<tr>
            <?php }?>
            <td>
            <?php echo utf8_encode($row_usr['usr_apellidos'].", ".$row_usr['usr_nombre']);?>          
		</td>
			<?php if (($cont % 2) ==0){?>
				</tr>
			<?php }
			$cont++;
		}
		if (($cont % 2) !=0){?>
			<td>&nbsp;  </td>
			</tr>
		<?php }
		?>
        
       </table>
       <?php }?>
		        </td>
        </tr>
        <tr>
          <td colspan="4" align="center"><input type="button" value="Editar" class="boton-crear" onClick="document.location.href = 'edit.php?oa_id=<?php echo $oa_id;?>'">
            &nbsp;
            <input type="button" value="Volver a la lista" class="boton-crear" onClick="document.location.href = 'index.php'"></td>
        </tr>
      </table>
    </center>
  </div>
</div>
<footer> </footer>
</body></html>