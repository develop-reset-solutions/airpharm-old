<?php session_start();
include("../../login/sesion_start.php");
include("../../librerias/librerias.php");
include("../../cabecera.php");
$conn=db_connect();
$query="SELECT * FROM unidades";
if($_POST['filtrar']){
	$un_nombre=$_POST['un_nombre'];
	$query.=" WHERE un_nombre LIKE '%".$un_nombre."%'";
}elseif($_POST['reset']){
	$un_nombre='';
	$query.="";
}
$query.=" ORDER BY un_nombre ASC";

?>
<link href="/css/style.css" rel="stylesheet" type="text/css">
<div id="content">
  <div class="cabecera_apartados">
    <div class="filtros">
      <form method="post" action="#">
        <table align="center" width="100%">
        <tr>
        <td colspan="5">Unidades</td>
          <tr>
         <td><a href="create.php" class="texto_10">Añadir nuevo</a>
        </td>
          <td style="background-color:transparent; width:700px;">
          </td>
            <td class="texto_10"> Unidad:
              <input name="un_nombre" type="text" class="texto_10" value="<?php echo $un_nombre;?>"/></td>
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
      	<td width="70%">Unidad</td>
      	<td width="20%">Abreviatura</td>
        <td width="10%">Acción</td>
      </thead>
      <?php
	  $result=mysql_query($query) or die ("No se puede ejecutar la sentencia: ".$query);
	  while($row=mysql_fetch_array($result)){?>
   	  <tr class="filas_subtotal">
   	    <td><?php echo utf8_encode($row['un_nombre']);?></td>
   	    <td><?php echo $row['un_abreviatura'];?></td>
        <td class="numerica"><a href="show.php?un_id=<?php echo $row['un_id'];?>"><img src="/img/ver.png" width="20" height="20" alt="Ver detalles" title="Ver detalles"></a>&nbsp;<a href="edit.php?un_id=<?php echo $row['un_id'];?>"><img src="/img/editar.png" width="20" height="20" alt="Editar" title="Editar"></a>&nbsp;<a href="delete.php?un_id=<?php echo $row['un_id'];?>"><img src="/img/borrar.png" width="20" height="20" alt="Borrar" title="Borrar"></a></td>
      </tr>
 <?php }?>
 	    </table>
  </div>
</div>
<footer> </footer>
</body></html>