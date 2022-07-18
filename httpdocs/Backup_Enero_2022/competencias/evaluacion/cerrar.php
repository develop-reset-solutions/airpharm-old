<?php session_start();
include("../../login/sesion_start.php");
include("../../librerias/librerias.php");
include("../../cabecera-competencias.php");
$conn=db_connect();
$dic_id=$_REQUEST['dic_id'];
$usr_id=$_REQUEST['usr_id'];
//$hoy=date('Y-m-d');
$hoy=date('d/m/Y');
$query="SELECT * FROM vcom_diccionarios_usuarios WHERE dic_id=".$dic_id." AND du_usr_id=".$usr_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
$row=mysql_fetch_array($result);

$query_usuario="SELECT * FROM usuarios WHERE usr_id=".$usr_id;
$result_usuario=mysql_query($query_usuario) or die("No se puede ejecutar la sentencia: ".$query_usuario);
$row_usuario=mysql_fetch_array($result_usuario);
$nombre=utf8_encode($row['dic_nombre']).' ('.$row['dic_ano'].')'.' de '.utf8_encode($row_usuario['usr_nombre']).' '.utf8_encode($row_usuario['usr_apellidos']);
?>
<script language="javascript">
<!--
function isValidDate(dateString)
{
	// First check for the pattern
	if(!/^\d{1,2}\/\d{1,2}\/\d{4}$/.test(dateString))
		return false;

	// Parse the date parts to integers
	var parts = dateString.split("/");
	var day = parseInt(parts[0], 10);
	var month = parseInt(parts[1], 10);
	var year = parseInt(parts[2], 10);

	// Check the ranges of month and year
	if(year < 1000 || year > 3000 || month == 0 || month > 12)
		return false;

	var monthLength = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ];

	// Adjust for leap years
	if(year % 400 == 0 || (year % 100 != 0 && year % 4 == 0))
		monthLength[1] = 29;

	// Check the range of the day
	return day > 0 && day <= monthLength[month - 1];
}
 

$(document).ready(function () {
	$("#Cerrar").click(function (){
		if( $("#fecha_cierre").val() == "" || !isValidDate($("#fecha_cierre").val())  ){
            alert("Tienes que introducir la fecha de cierre correctamente.");
            return false;
		}
  });
});
</script>
<link href="../../css/style.css" rel="stylesheet" type="text/css">
<div id="content">
<div style="width:100%;">
<center>   <form action="cerrado.php?dic_id=<?php echo $dic_id;?>&usr_id=<?php echo $usr_id;?>" method="post" style="text-align:-moz-center;">
    <table align="center" class="tabla_introduccion">
      <tr>
        <td colspan="2" class="titulo negrita">CERRAR EVALUACIÓN</td>
      </tr>
      <tr>
        <td class="titulos_campos"> Evaluación: </td>
        <td><?php echo $nombre;?></td>
      </tr>
      <tr>
        <td class="titulos_campos"> Fecha: </td>
        <td> <input id="fecha_cierre" name="fecha_cierre"  value="<?php echo $hoy; ?>"/></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><input type="submit" id="Cerrar" nombre="Cerrar" value="Cerrar" class="boton-crear">&nbsp;
        <input type="button" value="Volver a la lista" class="boton-crear" onClick="document.location.href = 'index.php'"></td>
      </tr>
    </table>
  </form></center>
  </div>
</div>
<footer> </footer>
</body></html>