

<?php 


session_start();
include("../login/sesion_start.php");
include("../librerias/librerias.php");
include("../cabecera.php");
$conn=db_connect();
$obj_id=$_GET['obj_id'];
$query="SELECT * FROM objetivos WHERE obj_id=".$obj_id;
$result=mysql_query($query) or die ("No se puede ejecutar la sentencia: ".$query);
$row=mysql_fetch_array($result);?>
<link href="/css/style.css" rel="stylesheet" type="text/css">
<div id="content">
<div style="width:100%;">
<center>   <form action="insert_indicador.php" method="post" onSubmit="return validarPasswd()" style="text-align:-moz-center;">
   <table align="center" class="tabla_introduccion">
      <tr>
        <td colspan="2" class="titulo negrita">ALTA INDICADOR</td>
      </tr>
      <tr>
        <td class="titulos_campos">Objetivo: </td>
        <td><?php echo utf8_encode($row['obj_descripcion']);?>
        <input type="hidden" name="obj_id" value="<?php echo $obj_id;?>"></td>
      </tr>
      <tr>
        <td class="titulos_campos">Nombre del indicador: </td>
        <td><input name="ind_nombre" type="text" class="campo-doble" required="required"></td>
      </tr>
      <tr>
        <td class="titulos_campos">Código del indicador: </td>
        <td><input name="ind_codigo" type="text" class="campo-corto"></td>
      </tr>
      <tr>
        <td class="titulos_campos">Responsable de definición: </td>
        <td>
        	<select name="ind_responsable" class="campo-largo" required>
        		<option value="">Seleccionar responsable ...</option>
            	<?php $query_usr="SELECT * FROM usuarios WHERE usr_baja=0 AND (usr_perfil<>'Director General' AND usr_perfil<>'Administrador') ORDER BY usr_apellidos, usr_nombre ASC";
				$result_usr=mysql_query($query_usr) or die ("No se puede ejecutar la sentencia: ".$query_usr);
				while($row_usr=mysql_fetch_array($result_usr)){?>
                	<option value="<?php echo $row_usr['usr_id'];?>"<?php if($row_usr['usr_id']==$_SESSION['usr_id']){?> selected="selected"<?php }?>><?php echo utf8_encode($row_usr['usr_apellidos'].", ".$row_usr['usr_nombre']);?></option>        <?php }?>

        </select>
        </td>
      </tr>
      <tr>
        <td class="titulos_campos">Responsable de medición: </td>
        <td>
        	<select name="ind_mide" class="campo-largo" required>
        		<option value="">Seleccionar responsable ...</option>
            	<?php $query_usr="SELECT * FROM usuarios WHERE usr_baja=0 AND (usr_perfil<>'Director General' AND usr_perfil<>'Administrador') ORDER BY usr_apellidos, usr_nombre ASC";
				$result_usr=mysql_query($query_usr) or die ("No se puede ejecutar la sentencia: ".$query_usr);
				while($row_usr=mysql_fetch_array($result_usr)){?>
                	<option value="<?php echo $row_usr['usr_id'];?>"<?php if($row_usr['usr_id']==$_SESSION['usr_id']){?> selected="selected"<?php }?>><?php echo utf8_encode($row_usr['usr_apellidos'].", ".$row_usr['usr_nombre']);?></option>        <?php }?>

        </select>
        </td>
      </tr>
      <tr>
        <td class="titulos_campos">Tipo de indicador: </td>
        <td><select name="ind_trim_acum" class="campo-largo" required>
        <option value="">Seleccionar tipo ...</option>
        <option value="Acumulado">Acumulado</option>
        <option value="Trimestral">Trimestral</option>
        </select>
        </td>
      </tr>
        <tr>
    <td class="titulos_campos">Horquilla mínima:</td>
<td>      <input type="text" name="oa_horquilla_min" class="campo-corto">
</td>
</tr>
<tr>
    <td class="titulos_campos">Horquilla máxima</td>
<td>      <input type="text" name="oa_horquilla_max" class="campo-corto">
</td>
  </tr>
  <tr>
    <td class="titulos_campos">Meta:</td>
<td>      <input type="text" name="oa_meta" class="campo-corto">
</td>
 </tr>
 <tr>   
 <td class="titulos_campos">Unidad meta:</td>
<td>        <select name="ind_meta_un_id" required>
        <option value="">Seleccionar unidad...</option>
        <?php $query_un="SELECT * FROM unidades ORDER BY un_nombre ASC";
				$result_un=mysql_query($query_un) or die ("No se puede ejecutar la sentencia: ".$query_un);
				while($row_un=mysql_fetch_array($result_un)){?>
        <option value="<?php echo $row_un['un_id'];?>"><?php echo utf8_encode($row_un['un_nombre']);?></option>
        <?php }?>
      </select>
  </td>
  </tr>
 <tr>   
 <td class="titulos_campos">Medición Grupo/Individual:</td>
<td>        <select name="ind_grupo_individual" required>
        <option value="">Seleccionar...</option>
        <option value="Grupo">Grupo</option>
        <option value="Individual">Individual</option>
       
      </select>
  </td>
  </tr>

      <tr>
        <td colspan="2" align="center"><input type="submit" value="Crear" class="boton-crear">&nbsp;<input type="button" value="Volver a la lista" class="boton-crear" onClick="document.location.href = 'index.php?obj=obj<?php echo $filtros;?>'"></td>
      </tr>
    </table>
  </form></center>
  </div>
</div>
<footer> </footer>
</body></html>