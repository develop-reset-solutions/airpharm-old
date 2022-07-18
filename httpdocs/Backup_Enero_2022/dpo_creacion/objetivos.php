<?php 
session_start();
include("../login/sesion_start.php");
include("../librerias/librerias.php");
include("../cabecera.php");
$conn=db_connect();
$anyo=date('Y')+1;
$query="SELECT * FROM vobjetivos_ano WHERE oa_ano=".$anyo;
if($_SESSION['usr_perfil']=='Usuario'){
	$query.=" AND obj_lider_id=".$_SESSION['usr_id'];
}
if($_POST['filtrar']){
	if($_POST['obj_descripcion']){
		$obj_descripcion=$_POST['obj_descripcion'];
		$query.=" AND obj_descripcion LIKE '%".$obj_descripcion."%'";
	}
	if($_POST['obj_tipo']<>'all'){
		$obj_tipo=$_POST['obj_tipo'];
		$query.=" AND obj_tipo LIKE '".utf8_decode($obj_tipo)."'";
	}
}elseif($_POST['reset']){
	$obj_descripcion='';
	$obj_tipo='all';
	$query.="";
}
$query.=" ORDER BY obj_tipo ASC";
?>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<div id="content">
  <div class="cabecera_apartados">
    <div class="filtros">
      <form method="post" action="#">
        <table align="center" width="100%">
        <tr>
        <td colspan="6">Objetivos</td>
          <tr>
         <td><a href="create.php" class="texto_10">Añadir Objetivo</a>
        </td>
          <td style="background-color:#999999; width:540px;">
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
            <td><input name="reset" type="submit" id="reset" value="Todas" class="texto_10" /></td>
          </tr>
        </table>
      </form>
    </div>
  </div>
  <div class="tabla_apartados">
    <table width="100%">
      <thead>
      <tr style="border-spacing:0; line-height:10px;">
      	<td colspan="4">&nbsp;</td>
        <td colspan="2">Horquilla</td>
        <td>&nbsp;</td>
</tr>
<tr>      	<td width="25%">Objetivo</td>
        <td width="10%">Cód. Indicador</td>
        <td width="30%">Indicador</td>
        <td width="15%">Tipo</td>
        <td width="6%">Min.</td>
        <td width="6%">Max.</td>
        <td width="8%">Acción</td>
        </tr>
      </thead>
      <?php
	  $result=mysql_query($query) or die ("No se puede ejecutar la sentencia: ".$query);
	  while($row=mysql_fetch_array($result)){?>
   	  <tr class="filas_subtotal">
   	    <td><?php echo utf8_encode($row['obj_descripcion']);?></td>
        <td><?php echo $row['obj_codigo_indicador'];?></td>
        <td><?php echo utf8_encode($row['obj_indicador']);?></td>
        <td><?php echo utf8_encode($row['obj_tipo']);?></td>
        <td><?php echo $row['obj_horquilla_min']." %";?></td>
        <td><?php echo $row['obj_horquilla_max']." %";?></td>
        <td class="numerica"><a href="show.php?oa_id=<?php echo $row['oa_id'];?>"><img src="/img/ver.png" width="20" height="20" alt="Ver detalles" title="Ver detalles"></a>&nbsp;<?php if($row['obj_lider_id']==$_SESSION['usr_id']){?><a href="edit.php?oa_id=<?php echo $row['oa_id'];?>"><img src="/img/editar.png" width="20" height="20" alt="Editar" title="Editar"></a>&nbsp;<a href="delete.php?oa_id=<?php echo $row['oa_id'];?>"><img src="/img/borrar.png" width="20" height="20" alt="Borrar" title="Borrar"></a><?php }?></td>
      </tr>
 <?php }?>
 	    </table>
  </div>
</div>
<footer> </footer>
</body></html>