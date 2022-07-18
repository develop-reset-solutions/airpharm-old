<?php 
session_start();
include("login/sesion_start.php");
include("librerias/librerias.php");
include("cabecera.php");
?>
<link href="/css/style.css" rel="stylesheet" type="text/css">
<div id="content">
  <div style="width:100%;">
        <center><table align="center">
        <tr>
        <td class="celda-home"><input type="button" class="boton-principal" value="Consultar/Editar DPO" onClick="document.location.href = 'dpo'"></td>
         <td class="celda-home"><input type="button" class="boton-principal" value="Objetivos" onClick="document.location.href = 'objetivos'"></td>
        <td class="celda-home"><input type="button" class="boton-principal" value="Indicadores <?php echo $_SESSION['ano'];?>" onClick="document.location.href = 'medicion_objetivos'"></td>
         </tr>
        <tr>
         <?php if($_SESSION['usr_perfil']=='Administrador' or $_SESSION['usr_categoria']==utf8_decode('Dirección') and $_SESSION['ano']==2016){?><td class="celda-home"><input type="button" class="boton-principal" value="Crear/Duplicar DPO" onClick="document.location.href = 'dpo_creacion'"></td><?php }?>
 <?php if($_SESSION['usr_perfil']=='Administrador' or $_SESSION['usr_perfil']=='Director RRHH' or $_SESSION['usr_categoria']==utf8_decode('Dirección')){?> 
      <td class="celda-home"><input type="button" class="boton-principal texto_verde" value="Informes" onClick="document.location.href = '/informes'"></td><?php }?>
</tr>
<tr>
<td colspan="3" align="center"><div style="background-color: red; color: white; font-size: 16px; padding: 40px; width: 400px;">Tienes pendientes mediciones del 1er. Trimestre<br>Tienes pendientes mediciones del 2o. Trimestre</div>
</td></tr>
        </table></center>
  </div>
  <div class="tabla_apartados">
  </div>
</div>
<footer> 
</footer>
</body></html>