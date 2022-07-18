<?php session_start();
include("login/sesion_start.php");
include("../../librerias/librerias.php");
include("../../cabecera-competencias.php");

?>
<link href="../../css/style.css" rel="stylesheet" type="text/css">
<div id="content">
  <div style="width:100%;">
        <center><table align="center">
        <tr>
            <td class="celda-home"><input type="button" class="boton-principal" value="Competencias" onClick="document.location.href = '/competencias/administracion/competencias'"></td>
            <td class="celda-home"><input type="button" class="boton-principal" value="Actitudes" onClick="document.location.href = '/competencias/administracion/actitudes'"></td>
            <td class="celda-home"><input type="button" class="boton-principal" value="Comportamientos" onClick="document.location.href = '/competencias/administracion/comportamientos'">																</td>
        </tr>
        <tr>
	        <td class="celda-home"><input type="button" class="boton-principal" value="Duplicar Año" onClick="document.location.href = '/competencias/administracion/duplicar'"></td>
      
         </tr>
        <!--
        <tr>
         <?php if($_SESSION['usr_perfil']=='Administrador' or $_SESSION['usr_categoria']==utf8_decode('Dirección') and $_SESSION['ano']>=2016){?><td class="celda-home"><input type="button" 			class="boton-principal" value="Crear/Duplicar DPO" onClick="document.location.href = 'dpo_creacion'"></td><?php }?>
		 <?php if($_SESSION['usr_perfil']=='Administrador' or $_SESSION['usr_perfil']=='Director RRHH' or $_SESSION['usr_categoria']==utf8_decode('Dirección')){?> 
      <td class="celda-home"><input type="button" class="boton-principal texto_verde" value="Informes" onClick="document.location.href = '/informes'"></td><?php }?>
		</tr>-->
        </table></center>
  </div>
  <div class="tabla_apartados">
  </div>
</div>
<footer> 
</footer>
</body></html>