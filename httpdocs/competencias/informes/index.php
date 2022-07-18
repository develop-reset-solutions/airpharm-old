<?php 
session_start();
include("../../login/sesion_start.php");
include("../../librerias/librerias.php");
include("../../cabecera-competencias.php");

?>
<link href="/css/style.css" rel="stylesheet" type="text/css">
<div id="content">
  <div class="cabecera_apartados">
    <div class="filtros">
      <form method="post" action="#">
        <table align="center" width="100%">
        <tr>
        <td colspan="5">Informes</td>
        </tr>
        </table>
      </form>
    </div>
  </div>
  <div class="tabla_apartados">
    <table width="100%" style="text-align:center;">
   	  <tr>
        <td align="center" width="50%"><button onclick="document.location.href = 'resumen-grupos.php'" class="boton-secundario">Imprimir todas las<br />competencias</button></td>
        <td align="center" width="50%"><button onclick="document.location.href = 'imprimir_eval_competencias.php'" class="boton-secundario">Imprimir
			a excel las<br>competencias</button></td>
      </tr>
<tr>
        
</tr>
 	    </table>
  </div>
</div>
<footer> </footer>
</body></html>