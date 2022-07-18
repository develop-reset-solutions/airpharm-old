<?php session_start();
include("../../login/sesion_start.php");
include("../../librerias/librerias.php");
include("../../cabecera.php");
$conn=db_connect();
$usr_id=$_GET['usr_id'];
$query="SELECT * FROM vusuarios WHERE usr_id=".$usr_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
$row=mysql_fetch_array($result);
$query_dep="SELECT * FROM departamentos ORDER BY dep_nombre ASC";
$result_dep=mysql_query($query_dep) or die ("No se puede ejecutar la sentencia: ".$query_dep);
$query_cen="SELECT * FROM centros ORDER BY cen_nombre ASC";
$result_cen=mysql_query($query_cen) or die ("No se puede ejecutar la sentencia: ".$query_cen);
$query_sup="SELECT * FROM usuarios ORDER BY usr_apellidos ASC, usr_nombre ASC";
$result_sup=mysql_query($query_sup) or die ("No se puede ejecutar la sentencia: ".$query_sup);
?>
<script language="javascript">
<!--
function vacio(q) {  
	for ( i = 0; i < q.length; i++ ) {  
		if ( q.charAt(i) != " " ) {  
			return true  
		}  
	}  
	return false  
}  

//comprueba direccion email
function email(txt){  
	//expresion regular  
	var b=/^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/; 
	return b.test(txt);
}  

function Valida( formulario ) {
	var error;
	var estado;
	estado=true;
	error='';
  	if( vacio(formulario.usr_nombre.value) == false ){
    	error+="Debe introducir el nombre del usuario.\n";
		estado=false;
  	}
	if(estado==false){
		alert (error);
	}
	return estado;
} 


//-->
</script>
<link href="/css/style.css" rel="stylesheet" type="text/css">
<div id="content">
<div style="width:100%;">
<center>   <form action="modify.php" method="post" onSubmit="return Valida(this);" style="text-align:-moz-center;">
    <table align="center" class="tabla_introduccion">
      <tr>
        <td colspan="4" class="titulo negrita">EDITAR USUARIO</td>
      </tr>
      <tr>
        <td class="titulos_campos"> Nombre: </td>
        <td><input name="usr_nombre" type="text" class="campo-largo"  required="required" value="<?php echo utf8_encode($row['usr_nombre']);?>">
        <input name="usr_id" type="hidden" value="<?php echo $row['usr_id'];?>" />
        </td>
        <td class="titulos_campos"> Apellidos: </td>
        <td><input name="usr_apellidos" type="text" class="campo-largo" required="required" value="<?php echo utf8_encode($row['usr_apellidos']);?>"></td>
      </tr>
      <tr>
        <td class="titulos_campos"> Nombre de usuario: </td>
        <td colspan="3"><input name="usr_login" type="text" class="campo-largo"  required="required" value="<?php echo utf8_encode($row['usr_login']);?>">
        </td>
      </tr>
      <tr>
        <td class="titulos_campos"> Email: </td>
        <td><input name="usr_email" type="text" class="campo-largo" required="required" value="<?php echo utf8_encode($row['usr_email']);?>"></td>
        <td class="titulos_campos"> DNI: </td>
        <td><input name="usr_dni" type="text" class="campo-corto" required="required" value="<?php echo utf8_encode($row['usr_dni']);?>"></td>
      </tr>
       <tr>
        <td class="titulos_campos">Superior jerárquico: </td>
        <td><select name="usr_superior_id" class="campo-largo">
        <option value="">Ninguno</option>
        <?php while($row_sup=mysql_fetch_array($result_sup)){?>
        <option value="<?php echo $row_sup['usr_id'];?>" <?php if($row_sup['usr_id']==$row['usr_superior_id']){?>selected="selected"<?php }?>><?php echo utf8_encode($row_sup['usr_apellidos'].', '.$row_sup['usr_nombre']);?></option>
        <?php }?>
        </select>
        </td>
        <td class="titulos_campos"> Categoría: </td>
        <td><select name="usr_categoria" class="campo-largo">
        <option value="">Ninguna</option>
        <option value="Dirección" <?php if(utf8_encode($row['usr_categoria'])=='Dirección'){?>selected="selected"<?php }?>>Dirección</option>
        <option value="Mando intermedio" <?php if(utf8_encode($row['usr_categoria'])=='Mando intermedio'){?>selected="selected"<?php }?>>Mando intermedio</option>
        <option value="Colaborador" <?php if(utf8_encode($row['usr_categoria'])=='Colaborador'){?>selected="selected"<?php }?>>Colaborador</option>
        </select>
        </td>
      </tr>
     <tr>
        <td class="titulos_campos"> Centro: </td>
        <td><select name="usr_cen_id" class="campo-largo" required>
        <?php while($row_cen=mysql_fetch_array($result_cen)){?>
        <option value="<?php echo $row_cen['cen_id'];?>" <?php if($row_cen['cen_id']==$row['usr_cen_id']){?>selected="selected"<?php }?>><?php echo utf8_encode($row_cen['cen_nombre']);?></option>
        <?php }?>
        </select>
        </td>
        <td class="titulos_campos"> Departamento: </td>
        <td><select name="usr_dep_id" class="campo-largo" required>
        <?php while($row_dep=mysql_fetch_array($result_dep)){?>
        <option value="<?php echo $row_dep['dep_id'];?>" <?php if($row_dep['dep_id']==$row['usr_dep_id']){?>selected="selected"<?php }?>><?php echo utf8_encode($row_dep['dep_nombre']);?></option>
        <?php }?>
        </select>
        </td>
      </tr>
      <tr>
      <td class="titulos_campos">Contraseña:</td>
      <td><input type="password" name="usr_password" id="usr_password" required="required" class="campo-largo" value="*****"/></td>
      <td class="titulos_campos">Repetir contraseña:</td>
      <td><input type="password" name="usr_password1" id="usr_password1" required="required" class="campo-largo" value="*****"/></td>
      <tr>
        <td class="titulos_campos"> Perfil: </td>
        <td><select name="usr_perfil" class="campo-largo" required>
        <option value="Administrador" <?php if($row['usr_perfil']=='Administrador'){?>selected="selected"<?php }?>>Administrador</option>
        <option value="Director General" <?php if($row['usr_perfil']=='Director General'){?>selected="selected"<?php }?>>Director General</option>
        <option value="Director RRHH" <?php if($row['usr_perfil']=='Director RRHH'){?>selected="selected"<?php }?>>Director RRHH</option>
        <option value="Usuario" <?php if($row['usr_perfil']=='Usuario'){?>selected="selected"<?php }?>>Usuario</option>
        </select>
        </td>
      <td class="titulos_campos">Baja:</td>
      <td><input type="checkbox" name="usr_baja" <?php if($row['usr_baja']){?>checked="checked"<?php }?> value="1"/></td>
      </tr>
      <tr>
        <td colspan="4" align="center"><input type="submit" value="Guardar" class="boton-crear">&nbsp;<input type="button" value="Volver a la lista" class="boton-crear" onClick="document.location.href = 'index.php'"></td>
      </tr>
    </table>
  </form></center>
  </div>
</div>
<footer> </footer>
</body></html>