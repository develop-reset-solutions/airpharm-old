<?php session_start();
include("../../../login/sesion_start.php");
include("../../../login/sesion_start_rrhh.php");
include("../../../librerias/librerias.php");
include("../../../cabecera-competencias.php");
$conn=db_connect();


$cd_orden=$_REQUEST['orden'];
$dic_id=$_REQUEST['dic_id'];

$query="SELECT * FROM com_com_dic WHERE cd_dic_id=".$dic_id." AND cd_orden=".$cd_orden;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
$row=mysql_fetch_array($result);

$query_com="SELECT * FROM com_competencias WHERE com_id=".$row['cd_com_id'];
$result_com=mysql_query($query_com) or die("No se puede ejecutar la sentencia: ".$query_com);
$row_com=mysql_fetch_array($result_com);

?>
<link href="/css/style.css" rel="stylesheet" type="text/css">
<div id="content">
<div style="width:100%;">
<center>   <form action="insert.php" method="post" onSubmit="return Valida(this);" style="text-align:-moz-center;">
    <table align="center" class="tabla_introduccion">
      <tr>
        <td colspan="2" class="titulo negrita">BORRAR COMPETENCIAS</td>
      </tr>
      <tr>
        <td class="titulos_campos"> Nombre: </td>
        <td><?php echo utf8_encode($row_com['com_nombre']);?></td>
      </tr>
      <tr>
        <td class="titulos_campos"> Número de orden: </td>
        <td><?php echo $cd_orden;?></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><input type="button" value="Borrar" class="boton-crear" onClick="document.location.href = 'del.php?orden=<?php echo $cd_orden;?>&dic_id=<?php echo $dic_id;?>'">&nbsp;
        <input type="button" value="Volver a la lista" class="boton-crear" onClick="document.location.href = 'create.php?dic_id=<?php echo $dic_id;?>'"></td>
      </tr>
    </table>
  </form></center>
  </div>
</div>
<footer> </footer>
</body></html>