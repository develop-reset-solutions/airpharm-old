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
function EliminarUsuario(dl_id){
	if (confirm('Seguro que desea desasociar este usuario')){
		pagina="modify_usuario.php?dl_id="+dl_id+"&dpo_id=<?php echo $dpo_id;?>";
		window.location=pagina;
	}
} 
function preguntar(){
	if (confirm('Seguro que desea desasociar los usuarios seleccionados')){
		document.desaso.submit();
	}
} 

function AnadirUsuario(oau_oa_id){
	if(document.getElementById('oa_usr_id').value=='all'){
		if(confirm('Seguro que desea asociar todos los colaboradores')){
			oau_usr_id=document.getElementById('oa_usr_id').value;
			pagina="insert_usuario.php?oau_usr_id="+oau_usr_id+"&oau_oa_id="+oau_oa_id+"&dpo_id=<?php echo $dpo_id;?>";
			window.location=pagina;
		}
	}else{
		oau_usr_id=document.getElementById('oa_usr_id').value;
		pagina="insert_usuario.php?oau_usr_id="+oau_usr_id+"&oau_oa_id="+oau_oa_id+"&dpo_id=<?php echo $dpo_id;?>";
		window.location=pagina;
	}
} 


//-->
</script>
<link href="/css/style.css" rel="stylesheet" type="text/css">
<div id="content">
<div style="width:100%;">
<center>   <form name="desaso" action="modify_usuari.php?dpo_id=<?php echo $dpo_id;?>" method="post" style="text-align:-moz-center;">
	<input type="hidden" name="oa_id" value="<?php echo $oa_id;?>">
    <input type="hidden" name="dpo_id" value="<?php echo $dpo_id;?>">
    <table align="center" width="100%" class="tabla_introduccion">
      <tr>
        <td colspan="2" class="titulo negrita">EDITAR USUARIOS</td>
      </tr>
        <tr>
          <td colspan="2"><span class="titulos_campos">Objetivo:</span> <?php echo utf8_encode($row['obj_descripcion']);?></td>
        </tr>
        <tr>
          <td colspan="2"><span class="titulos_campos">Indicador:</span> <?php echo utf8_encode($row['ind_nombre']);?></td>
        </tr>
         <tr>
         <td width="50%"><span class="titulos_campos">Año:</span> <?php echo utf8_encode($row['oa_ano']);?></td>
        </tr>
      <tr>
      <td colspan="2" align="center" class="titulos_campos">Usuarios</td>
      </tr>
      <tr>
      <td colspan="2">
		<table width="100%">
        <tr>
        <td align="center" colspan="4"><select name="oa_usr_id" id="oa_usr_id">
        <?php if(utf8_encode($row['obj_tipo'])=='Para el Comité de Dirección'){
       		$query_usr="SELECT * FROM usuarios WHERE usr_baja='0' AND usr_categoria='".utf8_decode('Comité de dirección')."' AND (usr_perfil='Director RRHH' OR usr_perfil='Usuario') ORDER BY usr_apellidos, usr_nombre ASC";
			$result_usr=mysql_query($query_usr) or die("No se puede ejecutar la sentencia: ".$query_usr);
			while($row_usr=mysql_fetch_array($result_usr)){
		        $query_oa_usr="SELECT * FROM vdpo_lineas WHERE dl_oa_id=".$oa_id." AND usr_baja='0' AND dpo_usr_id=".$row_usr['usr_id'];
				$result_oa_usr=mysql_query($query_oa_usr) or die("No se puede ejecutar la sentencia: ".$query_oa_usr);
				$num_oa_usr=mysql_num_rows($result_oa_usr);
				if(!$num_oa_usr){?>		
  					<option value="<?php echo $row_usr['usr_id'];?>"><?php echo utf8_encode($row_usr['usr_apellidos'].', '.$row_usr['usr_nombre']);?></option>
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
		<?php $query_usr="SELECT * FROM usuarios WHERE usr_baja='0' AND (usr_perfil='Director RRHH' OR usr_perfil='Usuario') ORDER BY usr_apellidos, usr_nombre ASC";
		$result_usr=mysql_query($query_usr) or die("No se puede ejecutar la sentencia: ".$query_usr);
		while($row_usr=mysql_fetch_array($result_usr)){
        $query_oa_usr="SELECT * FROM vdpo_lineas WHERE dl_oa_id=".$oa_id." AND usr_baja='0' AND dpo_usr_id=".$row_usr['usr_id'];
		$result_oa_usr=mysql_query($query_oa_usr) or die("No se puede ejecutar la sentencia: ".$query_oa_usr);
		$num_oa_usr=mysql_num_rows($result_oa_usr);
		if(!$num_oa_usr){?>		
  			<option value="<?php echo $row_usr['usr_id'];?>"><?php echo utf8_encode($row_usr['usr_apellidos'].', '.$row_usr['usr_nombre']);?></option>
  		<?php }
		}?>
        </optgroup>
        <?php }?>
 		</select>
<input type="button" class="boton-crear" name="button" id="button" value="Añadir" style="font-size:10px; height:19px;" onClick="javascript:AnadirUsuario('<?php echo $oa_id;?>');"></td>
       </tr>
        <?php $query_usr="SELECT * FROM vdpo_lineas WHERE dl_oa_id=".$oa_id." AND usr_baja='0' ORDER BY usr_apellidos, usr_nombre ASC";
			$result_usr=mysql_query($query_usr) or die("No se puede ejecutar la sentencia: ".$query_usr);
	        $cont =1;
			while($row_usr=mysql_fetch_array($result_usr)){
  			if (($cont % 2)!=0){?>
				<tr>
            <?php }?>
<td width="50%"><!--            <input type="button" name="button" id="button" class="boton-crear" value="Desasociar" style="font-size:10px; height:19px;" onClick="javascript:EliminarUsuario(<?php echo $row_usr['dl_id'];?>);">    -->     
		
            <input type="checkbox" name="dl_id[]" value="<?php echo $row_usr['dl_id'];?>">&nbsp;<?php echo utf8_encode($row_usr['usr_apellidos'].", ".$row_usr['usr_nombre']);?></td>
			<?php if (($cont % 2) ==0){?>
				</tr>
			<?php }$cont++;
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
        <td colspan="2" align="center"><input type="button" value="Desasociar seleccionados" class="boton-crear" onClick="preguntar()">&nbsp;&nbsp;<input type="button" value="Volver" class="boton-crear" onClick="document.location.href = '/medicion_objetivos/edit.php?oa_id=<?php echo $oa_id;?>&dpo_id=<?php echo $dpo_id;?>'"></td>
      </tr>
  </form>      <tr>
    </table>
</center>
  </div>
</div>
<footer> </footer>
</body></html>