<?php session_start();
include("../../login/sesion_start.php");
include("../../librerias/librerias.php");
include("../../cabecera.php");
$conn=db_connect();
$query="SELECT * FROM vdepartamentos";
if($_POST['filtrar']){
	$dep_nombre=$_POST['dep_nombre'];
	$query.=" WHERE dep_nombre LIKE '%".$dep_nombre."%'";
}elseif($_POST['reset']){
	$dep_nombre='';
	$query.="";
}
$query.=" ORDER BY dep_nombre ASC";

?>
<link href="/css/style.css" rel="stylesheet" type="text/css">
<div id="content">
  <div class="cabecera_apartados">
    <div class="filtros">
      <form method="post" action="#">
        <table align="center" width="100%">
        <tr>
        <td colspan="5">Departamentos</td>
          <tr>
         <td><a href="create.php" class="texto_10">Añadir nuevo</a>
        </td>
          <td style="background-color:transparent; width:700px;">
          </td>
            <td class="texto_10"> Nombre:
              <input name="dep_nombre" type="text" class="texto_10" value="<?php echo $dep_nombre;?>"/></td>
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
      	<td width="45%">Departamento</td>
      	<td width="45%">Director/a</td>
        <td width="10%">Acción</td>
      </thead>
      <?php
	  $result=mysql_query($query) or die ("No se puede ejecutar la sentencia: ".$query);
	  while($row=mysql_fetch_array($result)){?>
   	  <tr class="filas_subtotal">
   	    <td><?php echo utf8_encode($row['dep_nombre']);?></td>
   	    <td><?php if($row['dep_director_id']){echo utf8_encode($row['usr_apellidos'].", ".$row['usr_nombre']);}?></td>
        <td class="numerica"><a href="show.php?dep_id=<?php echo $row['dep_id'];?>"><img src="/img/ver.png" width="20" height="20" alt="Ver detalles" title="Ver detalles"></a>&nbsp;<a href="edit.php?dep_id=<?php echo $row['dep_id'];?>"><img src="/img/editar.png" width="20" height="20" alt="Editar" title="Editar"></a>&nbsp;<a href="delete.php?dep_id=<?php echo $row['dep_id'];?>"><img src="/img/borrar.png" width="20" height="20" alt="Borrar" title="Borrar"></a></td>
      </tr>
 <?php }?>
 	    </table>
  </div>
</div>
<footer> </footer>
</body></html>