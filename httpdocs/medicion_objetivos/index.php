<?php 
session_start();
include("../login/sesion_start.php");
include("../librerias/librerias.php");
include("../cabecera.php");
$conn=db_connect();
$anyo=$_SESSION['ano'];
if($_POST['filtrar']){
	$_SESSION['obj_descripcion']=$_POST['obj_descripcion'];
	$_SESSION['obj_tipo']=$_POST['obj_tipo'];
}
if($_POST['reset']){
	$_SESSION['obj_descripcion']='';
	$_SESSION['obj_tipo']='all';
}
$obj_descripcion=$_SESSION['obj_descripcion'];
$obj_tipo=$_SESSION['obj_tipo'];
$query="SELECT * FROM vobjetivos_ano WHERE oa_ano=".$anyo;
if($_SESSION['usr_perfil']=='Usuario'){
	$query.=" AND (ind_responsable=".$_SESSION['usr_id']." OR ind_mide=".$_SESSION['usr_id'].")";
}
if($obj_descripcion){
	$query.=" AND obj_descripcion LIKE '%".$obj_descripcion."%'";
}
if($obj_tipo<>'all'){
	$query.=" AND obj_tipo LIKE '".utf8_decode($obj_tipo)."'";
}
$query.=" ORDER BY obj_tipo DESC";

?>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<div id="content">
  <div class="cabecera_apartados">
    <div class="filtros">
      <form method="post" action="#">
        <table align="center" width="100%">
        <tr>
        <td colspan="6">Indicadores <?php echo $anyo;?></td>
          <tr>
         <td>
        </td>
            <td class="texto_10"> Tipo:
              <select name="obj_tipo" id="obj_tipo" class="texto_10">
                <option value="all">Todos</option>
                <option value="Objetivo de Compañía"<?php if($obj_tipo=='Objetivo de Compañía'){?> selected="selected"<?php }?>>Objetivo de Compañía</option>
                <option value="Para el Comité de Dirección"<?php if($obj_tipo=='Para el Comité de Dirección'){?> selected="selected"<?php }?>>Para el Comité de Dirección</option>
                <option value="Mandos Intermedios"<?php if($obj_tipo=='Mandos Intermedios'){?> selected="selected"<?php }?>>Mandos Intermedios</option>
                <option value="de departamento"<?php if($obj_tipo=='de departamento'){?> selected="selected"<?php }?>>De departamento</option>
                <option value="Proyectos"<?php if($obj_tipo=='Proyectos'){?> selected="selected"<?php }?>>Proyectos</option>
                <option value="Personal"<?php if($obj_tipo=='Personal'){?> selected="selected"<?php }?>>Personal</option>
              </select>
              </td>
            <td class="texto_10"> Descripción:
              <input name="obj_descripcion" type="text" class="texto_10" value="<?php echo $obj_descripcion;?>"/></td>
            <td><input type="submit" name="filtrar" id="filtrar" value="Filtrar" class="texto_10"/></td>
            <td><input name="reset" type="submit" id="reset" value="Todos" class="texto_10" /></td>
          </tr>
        </table>
      </form>
    </div>
  </div>
  <div class="tabla_apartados">
    <table width="100%">
      <thead>
      <tr style="border-spacing:0; line-height:10px;">
      	<td colspan="5">&nbsp;</td>
        <td colspan="2">Horquilla</td>
        <td>&nbsp;</td>
</tr>
<tr>      	<td width="27%">Objetivo</td>
        <td width="10%">Cód. Indicador</td>
        <td width="22%">Indicador</td>
        <td width="15%">Tipo</td>
        <td width="6%">Meta</td>
        <td width="6%">Min.</td>
        <td width="6%">Max.</td>
        <td width="8%">Acción</td>
        </tr>
      </thead>
      <?php
	  $result=mysql_query($query) or die ("No se puede ejecutar la sentencia: ".$query);
	  while($row=mysql_fetch_array($result)){?>
   	  <tr class="filas_subtotal">
   	    <td><a name="ind_<?php echo $row['oa_id'];?>"></a><?php echo utf8_encode($row['obj_descripcion']);?></td>
        <td><?php echo $row['ind_codigo'];?></td>
        <td><?php echo utf8_encode($row['ind_nombre']);?></td>
        <td><?php echo utf8_encode($row['obj_tipo']);?></td>
        <td class="numerica"><?php echo $row['oa_meta'];?></td>
        <td class="numerica"><?php echo $row['oa_horquilla_min'];?></td>
        <td class="numerica"><?php echo $row['oa_horquilla_max'];?></td>
        <td class="numerica"><a href="show.php?oa_id=<?php echo $row['oa_id'];?>"><img src="/img/ver.png" width="20" height="20" alt="Ver detalles" title="Ver detalles"></a>&nbsp;<a href="edit.php?oa_id=<?php echo $row['oa_id'];?>"><img src="/img/editar.png" width="20" height="20" alt="Editar" title="Editar"></a>&nbsp;<?php if(!tiene_usuarios($row['oa_id'])){?><a href="/objetivos/delete_indicador.php?oa_id=<?php echo $row['oa_id'];?>"><img src="/img/borrar.png" width="20" height="20"></a><?php }?></td>
      </tr>
 <?php }?>
 	    </table>
  </div>
</div>
<footer> </footer>
</body></html>