<?php session_start();
include("../../login/sesion_start.php");
include("../../librerias/librerias.php");
include("../../cabecera.php");
$conn=db_connect();
$oe_id=$_GET['oe_id'];
$query="SELECT * FROM objetivos_estrategicos WHERE oe_id=".$oe_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
$row=mysql_fetch_array($result);
?>
<link href="/css/style.css" rel="stylesheet" type="text/css">
<div id="content">
<div style="width:100%;">
<center>   <form action="insert.php" method="post" onSubmit="return Valida(this);" style="text-align:-moz-center;">
    <table align="center" class="tabla_introduccion">
      <tr>
        <td colspan="2" class="titulo negrita">BORRAR OBJETIVO ESTRATÉGICO</td>
      </tr>
      <tr>
        <td class="titulos_campos"> Código: </td>
        <td><?php echo utf8_encode($row['oe_codigo']);?></td>
      </tr>
      <tr>
        <td class="titulos_campos"> Nombre: </td>
        <td><?php echo utf8_encode($row['oe_nombre']);?></td>
      </tr>
      <tr>
        <td class="titulos_campos"> Área: </td>
        <td><?php echo utf8_encode($row['oe_area']);?></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><input type="button" value="Borrar" class="boton-crear" onClick="document.location.href = 'del.php?oe_id=<?php echo $oe_id;?>'">&nbsp;<input type="button" value="Volver a la lista" class="boton-crear" onClick="document.location.href = 'index.php'"></td>
      </tr>
    </table>
  </form></center>
  </div>
</div>
<footer> </footer>
</body></html>