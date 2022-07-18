<?php session_start();
include("../../login/sesion_start.php");
include("../../librerias/librerias.php");
include("../../cabecera.php");
$conn=db_connect();
$query_usr="SELECT * FROM usuarios ORDER BY usr_apellidos ASC";
$result_usr=mysql_query($query_usr) or die ("No se puede ejecutar la sentencia: ".$query_usr);
?>
<link href="/css/style.css" rel="stylesheet" type="text/css">
<div id="content">
<div style="width:100%;">
<center>   <form action="insert.php" method="post" style="text-align:-moz-center;">
    <table align="center" class="tabla_introduccion">
      <tr>
        <td colspan="2" class="titulo negrita">ALTA DEPARTAMENTO</td>
      </tr>
      <tr>
        <td class="titulos_campos"> Nombre: </td>
        <td><input name="dep_nombre" type="text" class="campo-largo" required="required"></td>
      </tr>
      <tr>
        <td class="titulos_campos"> Director/a: </td>
        <td><select name="dep_director_id" class="campo-largo">
        <option value=""></option>
        <?php while($row_usr=mysql_fetch_array($result_usr)){?>
        <option value="<?php echo $row_usr['usr_id'];?>"><?php echo utf8_encode($row_usr['usr_apellidos'].", ".$row_usr['usr_nombre']);?></option>
        <?php }?>
        </select>
        </td>
      </tr>
      <tr>
        <td colspan="4" align="center"><input type="submit" value="Crear" class="boton-crear"></td>
      </tr>
    </table>
  </form></center>
  </div>
</div>
<footer> </footer>
</body></html>