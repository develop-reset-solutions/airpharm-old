<?php session_start();
include("../login/sesion_start.php");
include("../librerias/librerias.php");
include("../cabecera.php");
$conn=db_connect();
$obj_id=$_GET['obj_id'];
$dpo_id=$_GET['dpo_id'];
$query="SELECT * FROM vobjetivos WHERE obj_id=".$obj_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
$row=mysql_fetch_array($result);
$ano=$_SESSION['ano'];
$editable=true;
$query_ed="SELECT * FROM vobjetivos_ano WHERE oa_ano<>".$ano." AND ind_obj_id=".$obj_id;
$result_ed=mysql_query($query_ed) or die("No se puede ejecutar la sentencia: ".$query_ed);
$num_ed=mysql_num_rows($result_ed);
if($num_ed){
	$editable=false;
}
if($_SESSION['usr_perfil']=='Director RRHH'){
	$editable=true;
}
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


//-->
</script>
<link href="/css/style.css" rel="stylesheet" type="text/css">
<div id="content">
  <div style="width:100%;">
    <center>
      <form action="modify.php?dpo_id=<?php echo $dpo_id;?>" method="post" onSubmit="return Valida(this);" style="text-align:-moz-center;">
        <table align="center" class="tabla_introduccion">
          <tr>
            <td colspan="2" class="titulo negrita">EDITAR OBJETIVO</td>
          </tr>
          <tr>
            <td class="titulos_campos">Descripción: </td>
            <td colspan="3"><?php if($editable){?><input name="obj_descripcion" type="text" class="campo-doble" required="required" value="<?php echo utf8_encode($row['obj_descripcion']);?>"><?php }else{ echo utf8_encode($row['obj_descripcion']);}?>
              <input type="hidden" name="obj_id" value="<?php echo $obj_id;?>" /></td>
          </tr>
          <tr>
            <td class="titulos_campos">Responsable del objetivo: </td>
            <td><?php if($editable){ 
			if($_SESSION['usr_perfil']=='Usuario'){
	        echo utf8_encode($_SESSION['usr_nombre']." ".$_SESSION['usr_apellidos']);?>
              <input type="hidden" name="obj_lider_id" value="<?php echo $_SESSION['usr_id'];?>" />
              <?php }else{?>
              <select name="obj_lider_id" class="campo-largo" required>
                <option value="">Seleccionar responsable ...</option>
                <?php $query_usr="SELECT * FROM usuarios WHERE usr_baja=0 AND (usr_perfil<>'Director General' AND usr_perfil<>'Administrador') ORDER BY usr_apellidos, usr_nombre ASC";
				$result_usr=mysql_query($query_usr) or die ("No se puede ejecutar la sentencia: ".$query_usr);
				while($row_usr=mysql_fetch_array($result_usr)){?>
                <option value="<?php echo $row_usr['usr_id'];?>"<?php if($row_usr['usr_id']==$row['obj_lider_id']){?> selected="selected"<?php }?>><?php echo utf8_encode($row_usr['usr_apellidos'].", ".$row_usr['usr_nombre']);?></option>
                <?php }?>
              </select>
              <?php }
			  }else{ echo utf8_encode($row['usr_nombre']." ".$row['usr_apellidos']);}?></td>
          </tr>
          <tr>
            <td class="titulos_campos">Tipo de objetivo: </td>
            <td><?php if($editable){?><select name="obj_tipo" class="campo-largo" required>
                <option value="Objetivo de Compañía" <?php if(utf8_encode($row['obj_tipo'])=='Objetivo de Compañía'){?> selected="selected"<?php }?>>Objetivo de Compañía</option>
                <option value="Para el Comité de Dirección" <?php if(utf8_encode($row['obj_tipo'])=='Para el Comité de Dirección'){?> selected="selected"<?php }?>>Para el comité de dirección</option>
                <option value="Mandos Intermedios" <?php if(utf8_encode($row['obj_tipo'])=='Mandos Intermedios'){?> selected="selected"<?php }?>>Mandos Intermedios</option>
                <option value="de departamento" <?php if($row['obj_tipo']=='de departamento'){?> selected="selected"<?php }?>>de departamento</option>
                <option value="Proyectos" <?php if($row['obj_tipo']=='Proyectos'){?> selected="selected"<?php }?>>Proyectos</option>
                <option value="Personal" <?php if($row['obj_tipo']=='Personal'){?> selected="selected"<?php }?>>Personal</option>
              </select><?php }else{ echo utf8_encode($row['obj_tipo']);}?></td>
          </tr>
          <tr>
            <td colspan="2"><table width="100%">
                <tr>
                  <td colspan="6" align="center" class="subtitulo negrita borde_todo"> INDICADORES </td>
                <tr style="border-spacing:0; line-height:10px; font-weight:bold;">
                  <td colspan="3" class="borde_todo">&nbsp;</td>
                  <td colspan="2" class="borde_todo">Horquilla</td>
                  <td class="borde_todo">&nbsp;</td>
                </tr>
                <tr style="border-spacing:0; line-height:10px; font-weight:bold;">
                  <td width="68%" class="borde_todo">Indicador</td>
                  <td width="6%" class="borde_todo">Código</td>
                  <td width="6%" class="borde_todo">Meta</td>
                  <td width="6%" class="borde_todo">Min.</td>
                  <td width="6%" class="borde_todo">Max.</td>
                  <td width="8%" class="borde_todo">Acción</td>
                </tr>
                <?php
	  $query_ind="SELECT * FROM vobjetivos_ano WHERE ind_obj_id=".$obj_id." AND oa_ano=".$ano." ORDER BY ind_nombre ASC";

	  $result_ind=mysql_query($query_ind) or die ("No se puede ejecutar la sentencia: ".$query_ind);
	  while($row_ind=mysql_fetch_array($result_ind)){?>
                <tr class="filas_subtotal">
                  <td class="borde_todo"><?php echo utf8_encode($row_ind['ind_nombre']);?></td>
                  <td class="borde_todo"><?php echo utf8_encode($row_ind['ind_codigo']);?></td>
                  <td class="numerica borde_todo"><?php echo $row_ind['oa_meta'];?></td>
                  <td class="numerica borde_todo"><?php echo $row_ind['oa_horquilla_min'];?></td>
                  <td class="numerica borde_todo"><?php echo $row_ind['oa_horquilla_max'];?></td>
                  <td class="numerica borde_todo"><a href="/medicion_objetivos/show.php?oa_id=<?php echo $row_ind['oa_id'];?>"><img src="/img/ver.png" width="20" height="20" alt="Ver detalles" title="Ver detalles"></a>&nbsp;
                    <?php if($row['obj_lider_id']<>$_SESSION['usr_id']){?>
                    <a href="/medicion_objetivos/edit.php?oa_id=<?php echo $row_ind['oa_id'];?>"><img src="/img/editar.png" width="20" height="20" alt="Editar" title="Editar"></a>
                    <?php }?>
                    &nbsp;<?php if(!tiene_usuarios($row_ind['oa_id'])){?><a href="delete_indicador.php?oa_id=<?php echo $row_ind['oa_id'];?>"><img src="/img/borrar.png" width="20" height="20"></a><?php }?></td>
                </tr>
                <?php }?>
                <tr class="filas_subtotal">
                  <td colspan="6" align="center"><input type="button" value="Añadir indicador" class="boton-crear" onClick="document.location.href = 'create_indicador.php?obj_id=<?php echo $obj_id;?>&dpo_id=<?php echo $dpo_id;?>'"></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td colspan="2"><table width="100%">
                <tr>
                  <td colspan="2" align="center"> OBJETIVOS ESTRATÉGICOS </td>
                </tr>
                <?php
        $cont ==0;
		$query_oe="SELECT * FROM objetivos_estrategicos ORDER BY oe_codigo ASC";
		$result_oe=mysql_query($query_oe) or die ("No se puede ejecutar la sentencia: ".$query_oe);
		while ($row_oe = mysql_fetch_array($result_oe)){
			$query_ooe="SELECT * FROM objetivos_objetivos_estrategicos WHERE ooe_obj_id=".$obj_id." AND ooe_oe_id=".$row_oe['oe_id'];
			$result_ooe=mysql_query($query_ooe) or die ("No se puede ejecutar la sentencia: ".$query_ooe);
			$num_ooe=mysql_num_rows($result_ooe);
			$cont ++;
			if (($cont % 2)!=0){?>
                <tr>
                  <?php }?>
                  <td><label>
                      <input <?php if(!$editable){?>disabled<?php }?> type="checkbox" name="<?php echo $row_oe['oe_id'];?>" value="<?php echo $row_oe['oe_id'];?>" id="<?php echo $row_oe['oe_id'];?>"<?php if($num_ooe){?> checked="checked"<?php }?>/>
                      <?php echo $row_oe['oe_codigo']." ".utf8_encode($row_oe['oe_nombre']);?></label></td>
                  <?php if (($cont % 2) ==0){?>
                </tr>
                <?php }
		}
		if (($cont % 2) !=0){?>
                
                  <td>&nbsp;</td>
                </tr>
                <?php }
		?>
              </table></td>
          </tr>
          <tr>
            <td colspan="4" align="center"><?php if($editable){?><input type="submit" value="Guardar" class="boton-crear"><?php }else{?><input type="button" value="Volver" class="boton-crear" onClick="document.location.href = 'show.php?obj_id=<?php echo $obj_id;?>'"><?php }?>
              &nbsp;
              <input type="button" value="Volver a la dpo" class="boton-crear" onClick="document.location.href = '/dpo/index.php?dpo_id=<?php echo $dpo_id;?>'"> &nbsp;
              <input type="button" value="Volver a la lista" class="boton-crear" onClick="document.location.href = 'index.php'">
             </td>
          </tr>
        </table>
      </form>
    </center>
  </div>
</div>
<footer> </footer>
</body></html>