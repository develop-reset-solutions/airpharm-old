<?php session_start();
include("../../../login/sesion_start.php");
include("../../../login/sesion_start_rrhh.php");
include("../../../librerias/librerias.php");
include("../../../cabecera-competencias.php");
$conn=db_connect();
$comp_id=$_REQUEST['comp_id'];
$act_id=$_REQUEST['act_id'];
$query="SELECT comp_nombre FROM com_comportamientos WHERE comp_id=".$comp_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
$row=mysql_fetch_array($result);
?>
<link href="/css/style.css" rel="stylesheet" type="text/css">
<div id="content">
<div style="width:100%;">
<center>   <form action="insert.php" method="post" onSubmit="return Valida(this);" style="text-align:-moz-center;">
    <table align="center" class="tabla_introduccion">
      <tr>
        <td colspan="2" class="titulo negrita">BORRAR COMPORTAMIENTOS</td>
      </tr>
      <tr>
        <td class="titulos_campos"> Comportamiento: </td>
        <td><?php echo utf8_encode($row['comp_nombre']);?></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><input type="button" value="Borrar" class="boton-crear" onClick="document.location.href = 'del.php?comp_id=<?php echo $comp_id;?>&act_id=<?php echo $act_id;?>'">&nbsp;
        <input type="button" value="Volver a la lista" class="boton-crear" onClick="document.location.href = 'index.php?act_id=<?php echo $act_id;?>'"></td>
      </tr>
    </table>
  </form></center>
  </div>
</div>
<footer> </footer>
</body></html>