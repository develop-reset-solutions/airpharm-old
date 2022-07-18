<?php session_start();
include("../../../login/sesion_start.php");
include("../../../login/sesion_start_rrhh.php");
include("../../../librerias/librerias.php");
include("../../../cabecera-competencias.php");
$conn=db_connect();
$com_id=$_GET['com_id'];
$query="SELECT com_nombre, com_descripcion FROM com_competencias WHERE com_id=".$com_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
$row=mysql_fetch_array($result);
?>
<link href="/css/style.css" rel="stylesheet" type="text/css">
<div id="content">
<div style="width:100%;">
<center>   <form action="insert.php" method="post" onSubmit="return Valida(this);" style="text-align:-moz-center;">
    <table align="center" class="tabla_introduccion">
      <tr>
        <td colspan="2" class="titulo negrita">VER COMPETENCIAS</td>
      </tr>
      <tr>
        <td class="titulos_campos"> Nombre: </td>
        <td><?php echo utf8_encode($row['com_nombre']);?></td>
      </tr>
      <tr>
        <td class="titulos_campos"> Descripcion: </td>
        <td><?php echo utf8_encode($row['com_descripcion']);?></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><input type="button" value="Editar" class="boton-crear" onClick="document.location.href = 'edit.php?com_id=<?php echo $com_id;?>'">&nbsp;
        <input type="button" value="Volver a la lista" class="boton-crear" onClick="document.location.href = 'index.php'">&nbsp;
        <input type="button" value="Actitudes" class="boton-crear" onClick="document.location.href = '../actitudes/index.php?com_id=<?php echo $com_id;?>'"></td>
      </tr>
    </table>
  </form></center>
  </div>
</div>
<footer> </footer>
</body></html>