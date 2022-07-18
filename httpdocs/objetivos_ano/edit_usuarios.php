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
  	if( vacio(formulario.obj_nombre.value) == false ){
    	error+="Debe introducir el nombre del objetivo.\n";
		estado=false;
  	}
	if(estado==false){
		alert (error);
	}
	return estado;
} 
function EliminarUsuario(oau_usr_id, oau_oa_id){
	if (confirm('Seguro que desea desasociar este usuario')){
		pagina="modify_usuario.php?oau_usr_id="+oau_usr_id+"&oau_oa_id="+oau_oa_id;
		window.location=pagina;
	}
} 

function AnadirUsuario(oau_oa_id){
	oau_usr_id=document.getElementById('oa_usr_id').value;
	pagina="insert_usuario.php?oau_usr_id="+oau_usr_id+"&oau_oa_id="+oau_oa_id;
	window.location=pagina;
} 


//-->
</script>
<link href="/css/style.css" rel="stylesheet" type="text/css">
<div id="content">
<div style="width:100%;">
<center>   <form action="modify.php" method="post" onSubmit="return Valida(this);" style="text-align:-moz-center;">
    <table align="center" width="100%" class="tabla_introduccion">
      <tr>
        <td colspan="2" class="titulo negrita">EDITAR OBJETIVO</td>
      </tr>
        <tr>
          <td colspan="2"><span class="titulos_campos">Descripción:</span> <?php echo utf8_encode($row['obj_descripcion']);?></td>
        </tr>
         <tr>
          <td width="50%"><span class="titulos_campos">Tipo:</span> <?php echo utf8_encode($row['obj_tipo']);?></td>
         <td width="50%"><span class="titulos_campos">Año:</span> <?php echo utf8_encode($row['oa_ano']);?></td>
        </tr>
       <tr>
          <td><span class="titulos_campos">Responsable del objetivo:</span> <?php echo utf8_encode($row['usr_nombre']." ".$row['usr_apellidos']);?></td>
          <td><span class="titulos_campos">Unidades:</span> <?php echo utf8_encode($row['obj_polaridad']);?></td>
        </tr>
        <tr>
        </tr>
      <tr>
        <td><span class="titulos_campos">Horquilla mínima:</span> <input type="hidden" name="oa_id" value="<?php echo $oa_id;?>"><input type="text" name="oa_horquilla_min" class="campo-corto" value="<?php echo $row['oa_horquilla_min'];?>"></td>
        <td><span class="titulos_campos">Horquilla máxima:</span> <input type="text" name="oa_horquilla_man" class="campo-corto" value="<?php echo $row['oa_horquilla_max'];?>"></td>
      </tr>
      <tr>
        <td><span class="titulos_campos">Meta:</span> <input type="text" name="oa_meta" class="campo-corto" value="<?php echo $row['oa_meta'];?>"></td>
        <td rowspan="2"><span class="titulos_campos">Observaciones:</span> <textarea name="oa_observaciones" style="resize:none; height:80px; vertical-align:text-top; width:250px;"><?php echo utf8_encode($row['oa_observaciones']);?></textarea></td>
      </tr>
      <tr>
        <td><span class="titulos_campos">Estado:</span> <select name="oa_status_id">
        <?php $query_st="SELECT * FROM status_dpo ORDER BY sd_id";
$result_st=mysql_query($query_st) or die("No se puede ejecutar la sentencia: ".$query_st);
while($row_st=mysql_fetch_array($result_st)){?>
<option value="<?php echo $row_st['sd_id'];?>"<?php if($row['oa_status_id']==$row_st['sd_id']){?> selected<?php }?>><?php echo utf8_encode($row_st['sd_nombre']);?></option>
<?php }?>
		</td>
      </tr>
      <tr>
        <td colspan="2" align="center"><input type="submit" value="Guardar" class="boton-crear">&nbsp;<input type="button" value="Volver a la lista" class="boton-crear" onClick="document.location.href = 'index.php'"></td>
      </tr>
  </form>      <tr>
      <td colspan="2" align="center" class="titulos_campos">Usuarios</td>
      </tr>
      <tr>
      <td colspan="2">
		<table width="100%">
        <?php if(utf8_encode($row['obj_tipo'])=='Objetivo de Compañía'){?>
        <tr>
        <td>Todos</td>
        </tr>
        <?php }else{?>
        <tr>
        <td align="center" colspan="4"><select name="oa_usr_id" id="oa_usr_id">
        <?php if(utf8_encode($row['obj_tipo'])=='Para el Comité de Dirección'){
       		$query_usr="SELECT * FROM usuarios WHERE usr_baja=0 AND usr_categoria='".utf8_decode('Comité de dirección')."' AND (usr_perfil='Director RRHH' OR usr_perfil='Usuario') ORDER BY usr_apellidos, usr_nombre ASC";
			$result_usr=mysql_query($query_usr) or die("No se puede ejecutar la sentencia: ".$query_usr);
			while($row_usr=mysql_fetch_array($result_usr)){
        		$query_oa_usr="SELECT * FROM obj_ano_usuarios WHERE oau_oa_id=".$oa_id." AND oau_usr_id=".$row_usr['usr_id'];
				$result_oa_usr=mysql_query($query_oa_usr) or die("No se puede ejecutar la sentencia: ".$query_oa_usr);
				$num_oa_usr=mysql_num_rows($result_oa_usr);
				if(!$num_oa_usr){?>		
  					<option value="usr_<?php echo $row_usr['usr_id'];?>"><?php echo utf8_encode($row_usr['usr_apellidos'].', '.$row_usr['usr_nombre']);?></option>
<?php 				}
			}
		}elseif(utf8_encode($row['obj_tipo'])=='Mandos Intermedios'){
        	$query_usr="SELECT * FROM usuarios WHERE usr_baja=0 AND usr_categoria='Mando intermedio' AND (usr_perfil='Director RRHH' OR usr_perfil='Usuario') ORDER BY usr_apellidos, usr_nombre ASC";
			$result_usr=mysql_query($query_usr) or die("No se puede ejecutar la sentencia: ".$query_usr);
			while($row_usr=mysql_fetch_array($result_usr)){
        		$query_oa_usr="SELECT * FROM obj_ano_usuarios WHERE oau_oa_id=".$oa_id." AND oau_usr_id=".$row_usr['usr_id'];
				$result_oa_usr=mysql_query($query_oa_usr) or die("No se puede ejecutar la sentencia: ".$query_oa_usr);
				$num_oa_usr=mysql_num_rows($result_oa_usr);
				if(!$num_oa_usr){?>		
  			<option value="usr_<?php echo $row_usr['usr_id'];?>"><?php echo utf8_encode($row_usr['usr_apellidos'].', '.$row_usr['usr_nombre']);?></option>
<?php 				}
			}
		}else{?>
        <option value="all">Todos</option>
      <optgroup label="Departamentos">
		<?php $query_dep="SELECT * FROM departamentos ORDER BY dep_nombre ASC";
		$result_dep=mysql_query($query_dep) or die("No se puede ejecutar la sentencia: ".$query_dep);
		while($row_dep=mysql_fetch_array($result_dep)){?>
  <option value="dep_<?php echo $row_dep['dep_id'];?>"><?php echo utf8_encode($row_dep['dep_nombre']);?></option>
  		<?php }?>
        </optgroup>
        <optgroup label="Usuarios">
		<?php $query_usr="SELECT * FROM usuarios WHERE usr_baja=0 AND (usr_perfil='Director RRHH' OR usr_perfil='Usuario') ORDER BY usr_apellidos, usr_nombre ASC";
		$result_usr=mysql_query($query_usr) or die("No se puede ejecutar la sentencia: ".$query_usr);
		while($row_usr=mysql_fetch_array($result_usr)){
        $query_oa_usr="SELECT * FROM obj_ano_usuarios WHERE oau_oa_id=".$oa_id." AND oau_usr_id=".$row_usr['usr_id'];
		$result_oa_usr=mysql_query($query_oa_usr) or die("No se puede ejecutar la sentencia: ".$query_oa_usr);
		$num_oa_usr=mysql_num_rows($result_oa_usr);
		if(!$num_oa_usr){?>		
  			<option value="usr_<?php echo $row_usr['usr_id'];?>"><?php echo utf8_encode($row_usr['usr_apellidos'].', '.$row_usr['usr_nombre']);?></option>
  		<?php }
		}?>
        </optgroup>
        <?php }?>
 		</select>
<input type="button" class="boton-crear" name="button" id="button" value="Añadir" style="font-size:10px; height:19px;" onClick="javascript:AnadirUsuario('<?php echo $oa_id;?>');"></td>
       </tr>
        <?php $query_usr="SELECT * FROM vobj_ano_usuarios WHERE oau_oa_id=".$oa_id." ORDER BY usr_apellidos, usr_nombre ASC";
			$result_usr=mysql_query($query_usr) or die("No se puede ejecutar la sentencia: ".$query_usr);
	        $cont =1;
			while($row_usr=mysql_fetch_array($result_usr)){
  			if (($cont % 2)!=0){?>
				<tr>
            <?php }?>
            <td width="50%"><input type="button" name="button" id="button" class="boton-crear" value="Desasociar" style="font-size:10px; height:19px;" onClick="javascript:EliminarUsuario(<?php echo $row_usr['oau_usr_id'];?>,'<?php echo $oa_id;?>');">         
		
            <?php echo utf8_encode($row_usr['usr_apellidos'].", ".$row_usr['usr_nombre']);?></td>
			<?php if (($cont % 2) ==0){?>
				</tr>
			<?php }$cont++;
		}
		if (($cont % 2) !=0){?>
			<td>&nbsp;  </td>
			</tr>
		<?php }
		
		}?>	       
        </table>
        </td>
        </tr>      
    </table>
</center>
  </div>
</div>
<footer> </footer>
</body></html>