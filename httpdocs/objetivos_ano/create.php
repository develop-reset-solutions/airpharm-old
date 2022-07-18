<?php session_start();
include("../login/sesion_start.php");
include("../librerias/librerias.php");
include("../cabecera.php");
$conn=db_connect();
?>
<link href="/css/style.css" rel="stylesheet" type="text/css">
<div id="content">
<div style="width:100%;">
<center>   <form action="insert.php" method="post" onSubmit="return validarPasswd()" style="text-align:-moz-center;">
    <table align="center" class="tabla_introduccion">
      <tr>
        <td colspan="4" class="titulo negrita">ALTA OBJETIVO</td>
      </tr>
      <tr>
        <td class="titulos_campos">Descripción: </td>
        <td colspan="3"><input name="obj_descripcion" type="text" class="campo-doble" required="required"></td>
      </tr>
      <tr>
        <td class="titulos_campos">Responsable del objetivo: </td>
        <td>
        <?php if($_SESSION['usr_perfil']=='Usuario'){
	        echo utf8_encode($_SESSION['usr_nombre']." ".$_SESSION['usr_apellidos']);?>
    	    <input type="hidden" name="obj_lider_id" value="<?php echo $_SESSION['usr_id'];?>" />
        <?php }else{?>
        	<select name="obj_lider_id" class="campo-largo" required="required">
        		<option value="">Seleccionar responsable ...</option>
            	<?php $query_usr="SELECT * FROM usuarios WHERE usr_baja=0 AND (usr_perfil<>'Director General' AND usr_perfil<>'Administrador') ORDER BY usr_apellidos, usr_nombre ASC";
				$result_usr=mysql_query($query_usr) or die ("No se puede ejecutar la sentencia: ".$query_usr);
				while($row_usr=mysql_fetch_array($result_usr)){?>
                	<option value="<?php echo $row_usr['usr_id'];?>"<?php if($row_usr['usr_id']==$_SESSION['usr_id']){?> selected="selected"<?php }?>><?php echo utf8_encode($row_usr['usr_apellidos'].", ".$row_usr['usr_nombre']);?></option>
<?php }?>
        </select>
        <?php }?>
        </td>
      </tr>
      <tr>
        <td class="titulos_campos">Tipo de objetivo: </td>
        <td><select name="obj_tipo" class="campo-largo" required="required">
        <option value="">Seleccionar tipo ...</option>
        <option value="Objetivo de Compañía">Objetivo de Compañía</option>
        <option value="Para el comité de dirección / mandos intermedios">Para el comité de dirección / mandos intermedios</option>
        <option value="de departamento">de departamento</option>
        <option value="Proyectos">Proyectos</option>
        <option value="Personal">Personal</option>
        </select>
        </td>
        <td class="titulos_campos"> Periodicidad de la medición: </td>
        <td><select name="obj_trim_acum" class="campo-largo" required="required">
        <option value="">Seleccionar periodicidad ...</option>
        <option value="Acumulado">Acumulado</option>
        <option value="Trimestral">Trimestral</option>
        </select>
        </td>
      </tr>
      <tr>
        <td class="titulos_campos"> Método de medición: </td>
        <td><select name="obj_cuan_cual" class="campo-largo" required="required">
        <option value="">Seleccionar metodo ...</option>
        <option value="Cualitativo">Cualitativo</option>
        <option value="Cuantitativo">Cuantitativo</option>
        </select>
        </td>
        <td class="titulos_campos">Polaridad: </td>
        <td><select name="obj_polaridad" class="campo-largo" required="required">
        <option value="">Seleccionar polaridad ...</option>
        <option value="Positiva">Positiva</option>
        <option value="Negativa">Negativa</option>
        </select>
        </td>
      </tr>
      <tr>
        <td colspan="4" align="center"><input type="submit" value="Crear" class="boton-crear"></td>
      </tr>
    </table>
  </form></center>
  </div>
</div>
<footer> </footer>
</body></html>