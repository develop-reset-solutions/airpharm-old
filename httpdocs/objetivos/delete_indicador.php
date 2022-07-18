<?php session_start();
include("../login/sesion_start.php");
include("../librerias/librerias.php");
include("../cabecera.php");
$conn=db_connect();
$oa_id=$_GET['oa_id'];
$query="SELECT * FROM vobjetivos_ano WHERE oa_id=".$oa_id;
$result=mysql_query($query) or die("No se puede ejecutar la sentencia: ".$query);
$row=mysql_fetch_array($result);
?>
<link href="/css/style.css" rel="stylesheet" type="text/css">
<div id="content">
<div style="width:100%;">
<center>
   <form action="del_indicador.php" method="post" onSubmit="return Valida(this);" style="text-align:-moz-center;">
    <table align="center" class="tabla_introduccion">
      <table align="center" class="tabla_introduccion" width="100%">
        <tr>
          <td colspan="2" class="titulo negrita">BORRAR INDICADOR</td>
        </tr>
        <tr>
          <td colspan="2"><span class="titulos_campos">Objetivo:</span> <?php echo utf8_encode($row['obj_descripcion']);?></td>
        </tr>
        <tr>
          <td colspan="2"><span class="titulos_campos">Indicador:</span> <?php echo utf8_encode($row['ind_nombre']);?></td>
        </tr>
        <tr>
         <td colspan="2"><span class="titulos_campos">Año:</span> <?php echo utf8_encode($row['oa_ano']);?></td>
      <tr>
        <td colspan="2" align="center"><input type="button" value="Borrar" class="boton-crear" onClick="document.location.href = 'del_indicador.php?oa_id=<?php echo $oa_id;?>'">&nbsp;<input type="button" value="Volver a la lista" class="boton-crear" onClick="document.location.href = 'index.php'"></td>
      </tr>
    </table>
  </form></center>
  </div>
</div>
<footer> </footer>
</body></html>