<?php session_start();
include("../../login/sesion_start.php");
include("../../login/sesion_start_rrhh.php");
include("../../librerias/librerias.php");
include("../../cabecera-competencias.php");
$conn=db_connect();
$dic_id=$_REQUEST['dic_id'];
$usr_id=$_REQUEST['usr_id'];
$query="SELECT * FROM vcom_diccionarios_usuarios WHERE dic_id=".$dic_id." AND du_usr_id=".$usr_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
$row=mysql_fetch_array($result);

$query_usuario="SELECT * FROM usuarios WHERE usr_id=".$usr_id;
$result_usuario=mysql_query($query_usuario) or die("No se puede ejecutar la sentencia: ".$query_usuario);
$row_usuario=mysql_fetch_array($result_usuario);
$nombre=utf8_encode($row['dic_nombre']).' ('.$row['dic_ano'].')'.' de '.utf8_encode($row_usuario['usr_nombre']).' '.utf8_encode($row_usuario['usr_apellidos']);
?>
<link href="../../css/style.css" rel="stylesheet" type="text/css">
<div id="content">
<div style="width:100%;">
<center>   <form action="abierto.php?dic_id=<?php echo $dic_id;?>&usr_id=<?php echo $usr_id;?>" method="post" onSubmit="return Valida(this);" style="text-align:-moz-center;">
    <table align="center" class="tabla_introduccion">
      <tr>
        <td colspan="2" class="titulo negrita">ABRIR EVALUACIÓN</td>
      </tr>
      <tr>
        <td class="titulos_campos"> Evaluación: </td>
        <td><?php echo $nombre;?></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><input type="submit" value="Abrir" class="boton-crear">&nbsp;
        <input type="button" value="Volver a la lista" class="boton-crear" onClick="document.location.href = 'index.php'"></td>
      </tr>
    </table>
  </form></center>
  </div>
</div>
<footer> </footer>
</body></html>