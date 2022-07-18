<?php session_start();

include("../login/sesion_start.php");
include("../librerias/librerias.php");
include("../cabecera.php");
$conn=db_connect();
$dpo_ano=$_SESSION['ano'];

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
    <center>
      <form name="desaso" action="imprimir_dpo_consecucion_todos.php" method="post" style="text-align:-moz-center;">
        <table align="center" width="100%" class="tabla_introduccion">
        <tr>
          <td colspan="2" class="titulo negrita">IMPRIMIR CONSECUCIÓN DPO - SELECCIONAR USUARIOS</td>
        </tr>
        <tr>
          <td colspan="2"><table width="100%">
              <tr>
                <td align="center" colspan="4">
                	<select name="usr_id" id="usr_id">
                    	<option value="all">Todos</option>
                    	<optgroup label="Departamentos">
                    		<?php $query_dep="SELECT * FROM departamentos ORDER BY dep_nombre ASC";
							$result_dep=mysql_query($query_dep) or die("No se puede ejecutar la sentencia: ".$query_dep);
							while($row_dep=mysql_fetch_array($result_dep)){
								if($_SESSION['usr_perfil']=='Director General' or $_SESSION['usr_perfil']=='Administrador' or $_SESSION['usr_perfil']=='Director RRHH' or $_SESSION['usr_id']==$row_dep['dep_director_id']){?>
                    				<option value="dep_<?php echo $row_dep['dep_id'];?>"><?php echo utf8_encode($row_dep['dep_nombre']);?></option>
                    			<?php }
							}?>
                    	</optgroup>
                    	<optgroup label="Usuarios">
                    		<?php if($_SESSION['usr_perfil']=='Director General' or $_SESSION['usr_perfil']=='Administrador' or $_SESSION['usr_perfil']=='Director RRHH'){
								$query_usr="SELECT * FROM usuarios WHERE usr_baja=0 AND (usr_perfil='Usuario' OR usr_perfil='Director RRHH') ORDER BY usr_apellidos, usr_nombre ASC";
								$result_usr=mysql_query($query_usr) or die ("No se puede ejecutar la sentencia: ".$query_usr);
								while($row_usr=mysql_fetch_array($result_usr)){
									$query_dpo="SELECT * FROM dpo_cabeceras WHERE dpo_usr_id=".$row_usr['usr_id']." AND dpo_ano=".$dpo_ano;
									$result_dpo=mysql_query($query_dpo) or die ("No se puede ejecutar la sentencia: ".$query_dpo);
									$num_dpo=mysql_num_rows($result_dpo);
									if($num_dpo){?>
                    					<option value="<?php echo $row_usr['usr_id'];?>"<?php if($row_usr['usr_id']==$dpo_usr_id){?><?php }?>><?php echo utf8_encode($row_usr['usr_apellidos'].", ".$row_usr['usr_nombre']);?></option>
                    				<?php }
								}
							}else{
								$query_usr="SELECT * FROM usuarios WHERE usr_baja=0 AND (usr_perfil='Usuario' OR usr_perfil='Director RRHH') ORDER BY usr_apellidos, usr_nombre ASC";
								$result_usr=mysql_query($query_usr) or die ("No se puede ejecutar la sentencia: ".$query_usr);
								while($row_usr=mysql_fetch_array($result_usr)){
									if(superior($_SESSION['usr_id'],$row_usr['usr_id'])){
											$query_dpo="SELECT * FROM dpo_cabeceras WHERE dpo_usr_id=".$row_usr['usr_id']." AND dpo_ano=".$dpo_ano;
											$result_dpo=mysql_query($query_dpo) or die ("No se puede ejecutar la sentencia: ".$query_dpo);
											$num_dpo=mysql_num_rows($result_dpo);
											if($num_dpo){?>
                    							<option value="<?php echo $row_usr['usr_id'];?>"><?php echo utf8_encode($row_usr['usr_apellidos'].", ".$row_usr['usr_nombre']);?></option>
                    						<?php }
									}
								}
							}?>
                    	</optgroup>

                  	</select>
                  	<input type="submit" class="boton-crear" name="button" id="button" value="Generar" style="font-size:10px; height:19px;" onClick="javascript:AnadirUsuario('<?php echo $oa_id;?>');"></td>
              </tr>
            </table>
      </form>
    </center>
  </div>
</div>
<footer> </footer>
</body></html>
