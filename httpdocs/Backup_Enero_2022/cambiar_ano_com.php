<?php 
session_start();
include("login/sesion_start.php");
include("librerias/librerias.php");
include("cabecera-competencias.php");
?>
<link href="/css/style.css" rel="stylesheet" type="text/css">
<div id="content">
  <div style="width:100%;">
<center>   <form action="modify_ano_com.php" method="post" onSubmit="return Valida(this);" style="text-align:-moz-center;">
    <table align="center" class="tabla_introduccion">
      <tr>
        <td colspan="2" class="titulo negrita">CAMBIAR AÑO</td>
      </tr>
      <tr>
        <td class="titulos_campos">Año: </td>
        <td><select name="ano" class="campo-corto" required>
        	<?php for($i=2014;$i<=date('Y')+1;$i++){?>
        		<option value="<?php echo $i;?>"<?php if($_SESSION['ano']==$i){?> selected="selected"<?php }?>><?php echo $i;?></option>
			<?php }?>
        </select>
        </td>
      </tr>
     <tr>
        <td colspan="4" align="center"><input type="submit" value="Seleccionar" class="boton-crear">&nbsp;<input type="button" value="Volver a inicio" class="boton-crear" 
        onClick="document.location.href = 'competencias/index.php'"></td>
      </tr>
    </table>
  </form></center>  </div>
  <div class="tabla_apartados">
  </div>
</div>
<footer> 
</footer>
</body></html>