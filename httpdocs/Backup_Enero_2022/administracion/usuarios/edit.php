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
function anadir_dic(){
	
	var usr_id=document.getElementById("usr_id").value;
	//alert (usr_id);
	//window.location="anadir_diccionario.php?usr_id="+usr_id;
	$.ajax({
		url: "anadir_diccionario.php",
		type: "POST",
		data:'usr_id='+usr_id,
		success: function(data){			
			$("#diccionario").html(data);
			//$("#actitud").html(data);
			
		}        
   	});
}

function editar_dic(val1, val2){
	alert("Si cambia el dicionario o el año perderá los datos de la evaluacion");
	$.ajax({
		url: "anadir_diccionario.php",
		type: "POST",
		data:'usr_id='+val1+'&dic_id='+val2,
		success: function(data){			
			$("#diccionario").html(data);
			
		}        
   	});
}

function aparece_diccionario(){
	var val=document.getElementById("dic_ano_nuevo").value;
	
	$.ajax({
		url: "diccionario_ano.php",
		type: "POST",
		data:'ano='+val,
		success: function(data){			
			$("#diccionario_ano").html(data);
		}        
   	});
}

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
        <input id="usr_id" name="usr_id" type="hidden" value="<?php echo $row['usr_id'];?>" />
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
        <td class="titulos_campos"> Acceso: </td>
        <td colspan="3"><input type="checkbox" name="usr_acc_dpo" <?php if($row['usr_acc_dpo']==1){?> checked="checked"<?php }?> value="1" >DPO<br/>
        <input type="checkbox" name="usr_acc_com" <?php if($row['usr_acc_com']==1){?> checked="checked"<?php }?> value="1">Competencias
        </td>
      </tr>
       <tr>
        <td colspan="4">
         <div id="diccionario" name="diccionario">
             <table width="100%">
             
			  <?php 
				$query_dic="SELECT * FROM vcom_diccionarios_usuarios WHERE du_usr_id=".$usr_id." ORDER BY dic_ano DESC";
				$result_dic=mysql_query($query_dic) or die ("No se puede ejecutar la sentencia (query_dic): ".$query_dic);
				$num_rows = mysql_num_rows($result_dic);
				if ($num_rows > 0){?>
                     <thead>
                        <td class="titulos_campos" width="10%">Año</td>
        		        <td class="titulos_campos" width="30%">Diccionario</td>
    	        	    <td class="titulos_campos" width="40%">Evaluador</td>
	                	<td class="titulos_campos" width="10%">Autoevaluable</td>
						<td class="titulos_campos" width="10%">Acciones</td>
                     </thead>
                        <?php
						while($row_dic=mysql_fetch_array($result_dic)){
							?>
							<tr>
                            	<td>
									<?php echo $row_dic['dic_ano'];?>
								</td>
								<td>
									<?php echo $row_dic['dic_nombre'];?>
								</td>
								
								<td>
									<?php echo utf8_encode($row_dic['usr_apellidos']).", ".utf8_encode($row_dic['usr_nombre']);?>
								</td>
                                 <td>
                                    <center><input type="checkbox" disabled="disabled" name="autoevaluable" <?php if($row_dic['du_autoevaluable']==1){echo  "checked=checked"; }?>   value="1" ></center>
                                </td>
                                <td>
                                	<a onclick="editar_dic(<?php echo $row['usr_id'];?>,<?php echo $dic_id= $row_dic['dic_id'];?> )" >
                                    <img src="/img/editar.png" width="20" height="20" alt="Editar" title="Editar"></a>&nbsp;
									<a href="delete_diccionario.php?du_id=<?php echo $row_dic['du_id'];?>">
                                    <img src="/img/borrar.png" width="20" height="20" alt="Borrar" title="Borrar"></a>
								</td>
							</tr>
							<?php
						}
					}
				
				 ?> 
                
             </table>
             </div>
        </td>
      </tr>
      <tr>
        <td colspan="4" align="center"><input type="submit" value="Guardar" class="boton-crear">&nbsp;<input type="button" value="Volver a la lista" class="boton-crear" onClick="document.location.href = 'index.php'">&nbsp;<input type="button" value="Añadir Diccionario" class="boton-crear" onClick="anadir_dic()"></td>
      </tr>
    </table>
  </form></center>
  </div>
</div>
<footer> </footer>
</body></html>