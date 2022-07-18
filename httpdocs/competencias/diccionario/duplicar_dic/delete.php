<?php session_start();
include("../../../login/sesion_start.php");
include("../../../login/sesion_start_rrhh.php");
include("../../../librerias/librerias.php");
include("../../../cabecera-competencias.php");
$conn=db_connect();

$dic_id=$_REQUEST['dic_id'];

$query="SELECT * FROM com_diccionarios WHERE dic_id=".$dic_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
$row=mysql_fetch_array($result);


?>
<link href="/css/style.css" rel="stylesheet" type="text/css">
<div id="content">
<div style="width:100%;">
<center>   <form action="del.php" method="post" >
    <table align="center" class="tabla_introduccion">
      <tr>
        <td colspan="2" class="titulo negrita">BORRAR DICCIONARIO</td>
      </tr>
      <tr>
        <td class="titulos_campos"> Nombre: </td>
        <td><?php echo utf8_encode($row['dic_nombre']);?></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><input type="button" value="Borrar" class="boton-crear" onClick="document.location.href = 'del.php?dic_id=<?php echo $dic_id;?>'">&nbsp;
        <input type="button" value="Volver a la lista" class="boton-crear" onClick="document.location.href = '../index.php'"></td>
      </tr>
    </table>
  </form></center>
  </div>
</div>
<footer> </footer>
</body></html>