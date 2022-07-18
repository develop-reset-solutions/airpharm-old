<?php session_start();
include("../login/sesion_start.php");
include("../librerias/librerias.php");
include("../cabecera.php");
$conn=db_connect();
$filtros='';
if($_GET['filtrar']){
	$filtros.='&filtrar='.$_GET['filtrar'];
	$filtrar=$_GET['filtrar'];
	if($_GET['f_obj_descripcion']){
		$f_obj_descripcion=$_GET['f_obj_descripcion'];
		$filtros.='&f_obj_descripcion='.$f_obj_descripcion;
	}
	if($_GET['f_obj_tipo']<>'all'){
		$f_obj_tipo=$_GET['f_obj_tipo'];
		$filtros.='&f_obj_tipo='.$f_obj_tipo;
	}
}
?>
<link href="/css/style.css" rel="stylesheet" type="text/css">
<div id="content">
<div style="width:100%;">
<center>   <form action="insert.php" method="post" onSubmit="return validarPasswd()" style="text-align:-moz-center;">
    <table align="center" class="tabla_introduccion">
      <tr>
        <td colspan="2" class="titulo negrita">ALTA OBJETIVO</td>
      </tr>
      <tr>
        <td class="titulos_campos">Descripción: </td>
        <td><input name="obj_descripcion" type="text" class="campo-doble" required="required"></td>
      </tr>
      <tr>
        <td class="titulos_campos">Responsable del objetivo: </td>
        <td>
        <?php if($_SESSION['usr_perfil']=='Usuario'){
	        echo utf8_encode($_SESSION['usr_nombre']." ".$_SESSION['usr_apellidos']);?>
    	    <input type="hidden" name="obj_lider_id" value="<?php echo $_SESSION['usr_id'];?>" />
            <input type="hidden" name="filtrar" value="<?php echo $filtrar;?>" />
            <input type="hidden" name="f_obj_tipo" value="<?php echo $f_obj_tipo;?>" />
            <input type="hidden" name="f_obj_descripcion" value="<?php echo $f_obj_descripcion;?>" />
        <?php }else{?>
        	<select name="obj_lider_id" class="campo-largo" required>
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
        <td><select name="obj_tipo" class="campo-largo" required>
        <option value="">Seleccionar tipo ...</option>
        <option value="Objetivo de Compañía">Objetivo de Compañía</option>
        <option value="Para el Comité de Dirección">Para el comité de dirección</option>
        <option value="Mandos Intermedios">Mandos Intermedios</option>
        <option value="de departamento">de departamento</option>
        <option value="Proyectos">Proyectos</option>
        <option value="Personal">Personal</option>
        </select>
        </td>
      </tr>
      <tr>
      <td colspan="2">
      <table width="100%">
      <tr>
      <td colspan="2" align="center">
      OBJETIVOS ESTRATÉGICOS
      </td>
      </tr>
        <?php
        $cont ==0;
		$query_oe="SELECT * FROM objetivos_estrategicos ORDER BY oe_codigo ASC";
		$result_oe=mysql_query($query_oe) or die ("No se puede ejecutar la sentencia: ".$query_oe);
		while ($row_oe = mysql_fetch_array($result_oe)){
			$cont ++;
			if (($cont % 2)!=0){?>
				<tr>
			<?php }?>
			<td><label>
				<input type="checkbox" name="<?php echo $row_oe['oe_id'];?>" value="<?php echo $row_oe['oe_id'];?>" id="<?php echo $row_oe['oe_id'];?>"/>
			<?php echo $row_oe['oe_codigo']." ".utf8_encode($row_oe['oe_nombre']);?></label></td>
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
        <td colspan="2" align="center"><input type="submit" value="Crear" class="boton-crear">&nbsp;<input type="button" value="Volver a la lista" class="boton-crear" onClick="document.location.href = 'index.php?obj=obj<?php echo $filtros;?>'"></td>
      </tr>
    </table>
  </form></center>
  </div>
</div>
<footer> </footer>
</body></html>