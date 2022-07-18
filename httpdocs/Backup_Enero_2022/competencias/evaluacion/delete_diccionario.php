<?php session_start();
include("../../login/sesion_start.php");
include("../../librerias/librerias.php");
include("../../cabecera.php");
$conn=db_connect();

$du_id=$_REQUEST['du_id'];

//$query_duc="SELECT * FROM com_dic_usr_com WHERE duc_usr_id=".$usr_id." AND duc_dic_id=".$dic_id;
$query_duc="SELECT * FROM com_dic_usr_com WHERE duc_du_id=".$du_id." AND duc_grado IS NOT NULL AND duc_observaciones IS NOT NULL";
$result_duc=mysql_query($query_duc) or die("No se puede ejecutar la sentencia: ".$query_duc);
//$row=mysql_fetch_array($result_duc);
$num_rows_duc = mysql_num_rows($result_duc);

$query_ducp="SELECT * FROM com_dic_usr_comp WHERE ducp_du_id=".$du_id." AND ducp_evaluacion IS NOT NULL";
$result_ducp=mysql_query($query_ducp) or die("No se puede ejecutar la sentencia: ".$query_ducp);
//$row=mysql_fetch_array($result_duc);
$num_rows_ducp = mysql_num_rows($result_ducp);

//$query="SELECT * FROM vcom_diccionarios_usuarios WHERE du_usr_id=".$usr_id." AND dic_id=".$dic_id;
$query="SELECT * FROM vcom_diccionarios_usuarios WHERE du_id=".$du_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
$row=mysql_fetch_array($result);

?>
<link href="/css/style.css" rel="stylesheet" type="text/css">
<div id="content">
<div style="width:100%;">
<center>   <form action="/usuarios/del_diccionario.php" method="post" style="text-align:-moz-center;">
    <table align="center" class="tabla_introduccion">
      <tr>
        <td colspan="2" class="titulo negrita">BORRAR DICCIONARIO ASOCIADO</td>
      </tr>
      <tr>
        <td class="titulos_campos"> Nombre: </td>
        <td><?php echo utf8_encode($row['nombre']." ".$row['apellidos']);?></td>
      </tr>
      <tr>
        <td class="titulos_campos"> Año: </td>
        <td><?php echo utf8_encode($row['dic_ano']);?></td>
      </tr>
      <tr>
        <td class="titulos_campos"> Diccionario: </td>
        <td><?php echo utf8_encode($row['dic_nombre']);?></td>
      </tr>
      <tr>
        <td class="titulos_campos"> Evaluador: </td>
        <td><?php echo utf8_encode($row['usr_nombre']." ".$row['usr_apellidos']);?></td>
      </tr>
      	<?php 
      	if ($num_rows_ducp>0 or $num_rows_duc>0){
			?>
             <tr>
                <td colspan="2" class="titulos_campos"> No se puede borrar por tener actitudes o comportamientos evaluados.</td>
              </tr>
            <?php
	  	}
	  	?>
      <tr>
        <td colspan="2" align="center">
        <?php 
      	if (!($num_rows_ducp>0 or $num_rows_duc>0)){
			?><input type="button" value="Borrar" class="boton-crear" onClick="document.location.href = 'del_diccionario.php?du_id=<?php echo $du_id;?>&usr_id=<?php echo $row['du_usr_id'];?>'">&nbsp;
            <?php
	  	}
	  	?>   
         <input type="button" value="Volver a la lista" class="boton-crear" onClick="document.location.href = 'index.php'"></td>
      </tr>
    </table>
  </form></center>
  </div>
</div>
<footer> </footer>
</body></html>