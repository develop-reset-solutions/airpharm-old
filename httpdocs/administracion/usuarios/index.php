<?php session_start();
include("../../login/sesion_start.php");
include("../../librerias/librerias.php");
include("../../cabecera.php");
$conn=db_connect();
$query="SELECT * FROM vusuarios";
if($_POST['filtrar']){
	$primero=true;
	if($_POST['usr_apellidos']){
		$usr_apellidos=$_POST['usr_apellidos'];
		$query.=" WHERE usr_apellidos LIKE '%".$usr_apellidos."%'";
		$primero=false;
	}
	if($_POST['usr_categoria']<>'all'){
		if($primero){
			$query.=" WHERE";
		}else{
			$query.=" AND";
		}			
		$usr_categoria=utf8_decode($_POST['usr_categoria']);
		$query.=" usr_categoria='".$usr_categoria."'";
	}
}elseif($_POST['reset']){
	$usr_apellidos='';
	$usr_categoria='all';
	$query.="";
}
$query.=" ORDER BY usr_apellidos ASC";

?>
<link href="/css/style.css" rel="stylesheet" type="text/css">
<div id="content">
  <div class="cabecera_apartados">
    <div class="filtros">
        <table align="center" width="100%">
        <tr>
        <td colspan="7">Usuarios</td>
          <tr>
         <td><a href="create.php" class="texto_10">Añadir nuevo</a>
        </td>
      <form method="post" action="export-excel2.php">
            <td><input type="hidden" value="<?php echo $query;?>" name="query" />
            <input style="border:none; background-color:transparent;" type="submit" name="exportar" id="exportar" value="Exportar a excel" class="texto_10"/></td>
      </form>
          <td style="background-color:transparent; width:500px;">
          </td>
      <form method="post" action="#">
            <td class="texto_10"> Apellido:
              <input name="usr_apellidos" type="text" class="texto_10" value="<?php echo $usr_apellidos;?>"/></td>
            <td class="texto_10"> Categoría:
              <select name="usr_categoria" class="texto_10">
              <option value="all">Todas</option>
              <option value="Dirección"<?php if($usr_categoria=='Dirección'){?> selected="selected"<?php }?>>Dirección</option>
              <option value="Mando intermedio"<?php if($usr_categoria=='Mando intermedio'){?> selected="selected"<?php }?>>Mando intermedio</option>
              <option value="Colaborador"<?php if($usr_categoria=='Colaborador'){?> selected="selected"<?php }?>>Colaborador</option>
              </select></td>
            <td><input type="submit" name="filtrar" id="filtrar" value="Filtrar" class="texto_10"/></td>
            <td><input name="reset" type="submit" id="reset" value="Todas" class="texto_10" /></td>
      </form>
          </tr>
        </table>
    </div>
  </div>
  <div class="tabla_apartados">
    <table width="100%">
      <thead>
      	<td width="17%">Apellidos</td>
      	<td width="13%">Nombre</td>
      	<td width="15%">Email</td>
      	<td width="20%">Centro</td>
      	<td width="15%">Departamento</td>
      	<td width="10%">Categoría</td>
        <td width="10%">Acción</td>
      </thead>
      <?php
	  $result=mysql_query($query) or die ("No se puede ejecutar la sentencia: ".$query);
	  while($row=mysql_fetch_array($result)){?>
   	  <tr class="filas_subtotal">
   	    <td><?php echo utf8_encode($row['usr_apellidos']);?></td>
   	    <td><?php echo utf8_encode($row['usr_nombre']);?></td>
   	    <td><?php echo utf8_encode($row['usr_email']);?></td>
   	    <td><?php echo utf8_encode($row['cen_nombre']);?></td>
   	    <td><?php echo utf8_encode($row['dep_nombre']);?></td>
   	    <td><?php echo utf8_encode($row['usr_categoria']);?></td>
        <td class="numerica"><a href="show.php?usr_id=<?php echo $row['usr_id'];?>"><img src="/img/ver.png" width="20" height="20" alt="Ver detalles" title="Ver detalles"></a>&nbsp;<a href="edit.php?usr_id=<?php echo $row['usr_id'];?>"><img src="/img/editar.png" width="20" height="20" alt="Editar" title="Editar"></a>&nbsp;<a href="delete.php?usr_id=<?php echo $row['usr_id'];?>"><img src="/img/borrar.png" width="20" height="20" alt="Borrar" title="Borrar"></a></td>
      </tr>
 <?php }?>
 	    </table>
  </div>
</div>
<footer> </footer>
</body></html>