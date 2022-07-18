<?php session_start();
include("../login/sesion_start.php");
include("../librerias/librerias.php");
include("../cabecera.php");
$conn=db_connect();
$obj_id=$_GET['obj_id'];
$query="SELECT * FROM objetivos WHERE obj_id=".$obj_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
$row=mysql_fetch_array($result);
?>
<link href="/css/style.css" rel="stylesheet" type="text/css">
<div id="content">
<div style="width:100%;">
<center>
<?php $query_indn="SELECT * FROM vobjetivos_ano WHERE ind_obj_id=".$row['obj_id'];
	  $result_indn=mysql_query($query_indn) or die ("No se puede ejecutar la sentencia: ".$query_indn);
	  $num_indn=mysql_num_rows($result_indn);
?>
      	
   <form action="delete.php" method="post" onSubmit="return Valida(this);" style="text-align:-moz-center;">
    <table align="center" class="tabla_introduccion">
      <tr>
        <td colspan="2" class="titulo negrita">BORRAR OBJETIVO</td>
      </tr>
	<?php if($num_indn){?>
		<tr>
        <td colspan="2" class="titulo negrita" style="text-align:center;">Este objetivo no se puede borrar porque tiene indicadores asociados</td>
        </tr>
        <?php }?> 
		
      <tr>
        <td class="titulos_campos"> Descripción: </td>
        <td><?php echo utf8_encode($row['obj_descripcion']);?></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><?php if(!$num_indn){?><input type="button" value="Borrar" class="boton-crear" onClick="document.location.href = 'del.php?obj_id=<?php echo $obj_id;?>'"><?php }?>&nbsp;<input type="button" value="Volver a la lista" class="boton-crear" onClick="document.location.href = 'index.php'"></td>
      </tr>
    </table>
  </form></center>
  </div>
</div>
<footer> </footer>
</body></html>