<?php 
session_start();
include("../login/sesion_start.php");
include("../librerias/librerias.php");
include("../cabecera.php");
$conn=db_connect();
$ano=$_SESSION['ano'];
if($_SESSION['usr_perfil']=='Director RRHH'){
	$query="SELECT * FROM vobjetivos WHERE obj_lider_id<>9999";
}else{
	$query="SELECT * FROM vobjetivos WHERE obj_lider_id=".$_SESSION['usr_id'];
}
if($_POST['filtrar']){
	if($_POST['f_obj_descripcion']){
		$f_obj_descripcion=$_POST['f_obj_descripcion'];
		$query.=" AND obj_descripcion LIKE '%".$f_obj_descripcion."%'";
	}
	if($_POST['f_obj_tipo']<>'all'){
		$f_obj_tipo=$_POST['f_obj_tipo'];
		$query.=" AND obj_tipo LIKE '".utf8_decode($f_obj_tipo)."'";
	}
}elseif($_POST['reset']){
	$f_obj_descripcion='';
	$f_obj_tipo='all';
	$query.="";
}else{
	if($_GET['filtrar']){
	if($_GET['f_obj_descripcion']){
		$f_obj_descripcion=$_GET['f_obj_descripcion'];
		$query.=" AND obj_descripcion LIKE '%".$f_obj_descripcion."%'";
	}
	if($_GET['f_obj_tipo']<>'all'){
		$f_obj_tipo=$_GET['f_obj_tipo'];
		$query.=" AND obj_tipo LIKE '".utf8_decode($f_obj_tipo)."'";
	}
}
}
$query.=" ORDER BY obj_descripcion ASC";
$filtros='';
if($_POST['filtrar']){
	$filtros.='&filtrar='.$_POST['filtrar'];
	if($_POST['f_obj_descripcion']){
		$filtros.='&f_obj_descripcion='.$f_obj_descripcion;
	}
	if($_POST['f_obj_tipo']){
		$filtros.='&f_obj_tipo='.$f_obj_tipo;
	}
}elseif($_GET['filtrar']){
	$filtros.='&filtrar='.$_GET['filtrar'];
	if($_GET['f_obj_descripcion']){
		$filtros.='&f_obj_descripcion='.$f_obj_descripcion;
	}
	if($_GET['f_obj_tipo']){
		$filtros.='&f_obj_tipo='.$f_obj_tipo;
	}
}
?>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<div id="content">
  <div class="cabecera_apartados">
    <div class="filtros">
      <form method="post" action="#">
        <table align="center" width="100%">
          <tr>
            <td colspan="6">Objetivos <?php echo $ano;?></td>
          <tr>
            <td><a href="create.php?obj='obj'<?php echo $filtros;?>" class="texto_10">Añadir Objetivo</a></td>
            <td style="background-color:#999999; width:400px;"></td>
            <td class="texto_10"> Tipo:
              <select name="f_obj_tipo" id="f_obj_tipo" class="texto_10">
                <option value="all">Todos</option>
                <option value="Objetivo de Compañía"<?php if($f_obj_tipo=='Objetivo de Compañía'){?> selected="selected"<?php }?>>Objetivo de Compañía</option>
                <option value="Para el Comité de Dirección"<?php if($f_obj_tipo=='Para el Comité de Dirección'){?> selected="selected"<?php }?>>Para el Comité de Dirección</option>
                <option value="Mandos Intermedios"<?php if($f_obj_tipo=='Mandos Intermedios'){?> selected="selected"<?php }?>>Mandos Intermedios</option>
                <option value="de departamento"<?php if($f_obj_tipo=='de departamento'){?> selected="selected"<?php }?>>De departamento</option>
                <option value="Proyectos"<?php if($f_obj_tipo=='Proyectos'){?> selected="selected"<?php }?>>Proyectos</option>
                <option value="Personal"<?php if($f_obj_tipo=='Personal'){?> selected="selected"<?php }?>>Personal</option>
              </select></td>
            <td class="texto_10"> Descripción:
              <input name="f_obj_descripcion" type="text" class="texto_10" value="<?php echo $f_obj_descripcion;?>"/></td>
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
        <tr>
          <td width="10%">OE</td>
          <td width="45%">Objetivo</td>
          <td width="15%">Tipo</td>
          <td width="22%">Responsable</td>
          <td width="8%">Acción</td>
        </tr>
      </thead>
      <?php
	  $result=mysql_query($query) or die ("No se puede ejecutar la sentencia: ".$query);
	  while($row=mysql_fetch_array($result)){
      $query_ind="SELECT * FROM vobjetivos_ano WHERE ind_obj_id=".$row['obj_id']." AND oa_ano=".$ano;
	  $result_ind=mysql_query($query_ind) or die ("No se puede ejecutar la sentencia: ".$query_ind);
	  $num_ind=mysql_num_rows($result_ind);
      $query_indn="SELECT * FROM vobjetivos_ano WHERE ind_obj_id=".$row['obj_id'];
	  $result_indn=mysql_query($query_indn) or die ("No se puede ejecutar la sentencia: ".$query_indn);
	  $num_indn=mysql_num_rows($result_indn);
	  if($num_ind or !$num_indn){
?>
      <tr class="filas_subtotal">
        <td><?php $query_ooe="SELECT * FROM objetivos_objetivos_estrategicos WHERE ooe_obj_id=".$row['obj_id']." ORDER BY ooe_oe_id ASC";
		$result_ooe=mysql_query($query_ooe) or die ("No se puede ejecutar la sentencia: ".$query_ooe);
		$num_ooe=mysql_num_rows($result_ooe);
		$n=1;
		while ($row_ooe = mysql_fetch_array($result_ooe)){
			$query_oe="SELECT * FROM objetivos_estrategicos WHERE oe_id=".$row_ooe['ooe_oe_id'];
			$result_oe=mysql_query($query_oe) or die ("No se puede ejecutar la sentencia: ".$query_oe);
			$row_oe=mysql_fetch_array($result_oe);
			echo $row_oe['oe_codigo'];
			if($n>0 and $n<$num_ooe){
				if($n==$num_ooe-1){
					echo " y ";
				}else{
					echo ", ";
				}
			}
			$n++;
		}?></td>
        <td><?php echo utf8_encode($row['obj_descripcion']);?></td>
        <td><?php echo utf8_encode($row['obj_tipo']);?></td>
        <td><?php echo utf8_encode($row['usr_nombre']." ".$row['usr_apellidos']);?></td>
        <td class="numerica"><a href="show.php?obj_id=<?php echo $row['obj_id'].$filtros;?>"><img src="/img/ver.png" width="20" height="20" alt="Ver detalles" title="Ver detalles"></a>&nbsp;<a href="edit.php?obj_id=<?php echo $row['obj_id'].$filtros;?>"><img src="/img/editar.png" width="20" height="20" alt="Editar" title="Editar"></a>&nbsp;<?php if(!tiene_indicadores($row['obj_id'])){?><a href="delete.php?obj_id=<?php echo $row['obj_id'].$filtros;?>"><img src="/img/borrar.png" width="20" height="20" alt="Borrar" title="Borrar"></a><?php }?></td>
      </tr>
      <?php }
	  }?>
    </table>
  </div>
</div>
<footer> </footer>
</body></html>