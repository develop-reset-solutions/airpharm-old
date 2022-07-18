<?php session_start();
include("../../../login/sesion_start.php");
include("../../../login/sesion_start_rrhh.php");
include("../../../librerias/librerias.php");
include("../../../cabecera-competencias.php");

$conn=db_connect();

$query="SELECT * FROM com_competencias";

if($_POST['filtrar']){
	$com_nombre=$_POST['com_nombre'];
	$query.=" WHERE com_nombre LIKE '%".utf8_decode($com_nombre)."%'";
	
}elseif($_POST['reset']){
	$com_nombre='';
	$query.="";
}
$query.=" ORDER BY com_nombre ASC";


?>
<link href="/css/style.css" rel="stylesheet" type="text/css">
<div id="content">
  <div class="cabecera_apartados">
    <div class="filtros">
      <form method="post" action="#">
        <table align="center" width="100%">
        <tr>
        <td colspan="5">Competencias</td>
          <tr>
         <td><a href="create.php" class="texto_10">Añadir nueva</a>
        </td>
          <td style="background-color:transparent; width:700px;">
          </td>
            <td class="texto_10"> COMPETENCIAS:
              <input name="com_nombre" type="text" class="texto_10" value="<?php echo $com_nombre;?>"/></td>
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
      	<td width="90%">Competencia</td>
        <td width="10%">Acción</td>
      </thead>
      <?php
	  $result=mysql_query($query) or die ("No se puede ejecutar la sentencia: ".$query);
	  while($row=mysql_fetch_array($result)){?>
   	  <tr class="filas_subtotal">
   	    <td><?php echo utf8_encode($row['com_nombre']);?></td>
        <td class="numerica"><a href="show.php?com_id=<?php echo $row['com_id'];?>"><img src="/img/ver.png" width="20" height="20" alt="Ver detalles" title="Ver detalles"></a>&nbsp;<a href="edit.php?com_id=<?php echo $row['com_id'];?>"><img src="/img/editar.png" width="20" height="20" alt="Editar" title="Editar"></a>&nbsp;<a href="delete.php?com_id=<?php echo $row['com_id'];?>"><img src="/img/borrar.png" width="20" height="20" alt="Borrar" title="Borrar"></a></td>
      </tr>
 <?php }?>
 	    </table>
  </div>
</div>
<footer> </footer>
</body></html>