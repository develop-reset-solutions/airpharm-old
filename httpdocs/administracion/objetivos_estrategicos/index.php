<?php session_start();
include("../../login/sesion_start.php");
include("../../librerias/librerias.php");
include("../../cabecera.php");
$conn=db_connect();
$query="SELECT * FROM objetivos_estrategicos";
if($_POST['filtrar']){
	$oe_nombre=$_POST['oe_nombre'];
	$query.=" WHERE oe_nombre LIKE '%".$oe_nombre."%'";
}elseif($_POST['reset']){
	$oe_nombre='';
	$query.="";
}
$query.=" ORDER BY oe_codigo ASC";

?>
<link href="/css/style.css" rel="stylesheet" type="text/css">
<div id="content">
  <div class="cabecera_apartados">
    <div class="filtros">
      <form method="post" action="#">
        <table align="center" width="100%">
        <tr>
        <td colspan="5">Objetivos estratégicos</td>
          <tr>
         <td><a href="create.php" class="texto_10">Añadir nuevo</a>
        </td>
          <td style="background-color:transparent; width:700px;">
          </td>
            <td class="texto_10"> Objetivo estratégico:
              <input name="oe_nombre" type="text" class="texto_10" value="<?php echo $oe_nombre;?>"/></td>
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
      	<td width="10%">Código</td>
      	<td width="50%">Objetivo estratégico</td>
      	<td width="30%">Área</td>
        <td width="10%">Acción</td>
      </thead>
      <?php
	  $result=mysql_query($query) or die ("No se puede ejecutar la sentencia: ".$query);
	  while($row=mysql_fetch_array($result)){?>
   	  <tr class="filas_subtotal">
   	    <td><?php echo utf8_encode($row['oe_codigo']);?></td>
   	    <td><?php echo utf8_encode($row['oe_nombre']);?></td>
   	    <td><?php echo utf8_encode($row['oe_area']);?></td>
        <td class="numerica"><a href="show.php?oe_id=<?php echo $row['oe_id'];?>"><img src="/img/ver.png" width="20" height="20" alt="Ver detalles" title="Ver detalles"></a>&nbsp;<a href="edit.php?oe_id=<?php echo $row['oe_id'];?>"><img src="/img/editar.png" width="20" height="20" alt="Editar" title="Editar"></a>&nbsp;<a href="delete.php?oe_id=<?php echo $row['oe_id'];?>"><img src="/img/borrar.png" width="20" height="20" alt="Borrar" title="Borrar"></a></td>
      </tr>
 <?php }?>
 	    </table>
  </div>
</div>
<footer> </footer>
</body></html>