<?php session_start();
include("../login/sesion_start.php");
include("../librerias/librerias.php");
include("../cabecera.php");

?>
<link href="../css/style.css" rel="stylesheet" type="text/css">
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
        <td width="50%" align="center"><button onclick="document.location.href = 'resumen-grupos.php'" class="boton-secundario">Informe definición DPO <br /> por grupos</button> <!--<input type="button" class="boton-secundario" value="Informe definición DPO&#13;&#10; por grupos" onClick="document.location.href = 'resumen-grupos.php'">--></td>
         <td width="50%" align="center"><button onclick="document.location.href = '/dpo/imprimir_dpo_todos_sel.php'" class="boton-secundario">Imprimir todas las<br />definiciones de DPO</button><!--<input type="button" class="boton-secundario" value="Imprimir todas las&#13;&#10;definiciones de DPO" onClick="document.location.href = '/dpo/imprimir_dpo_todos_sel.php'">--></td>
      </tr>
<tr>
        <td align="center"><button onclick="document.location.href = 'resultado-excel2.php'" class="boton-secundario">Informe de consecución<br />trimestral/anual</button><!--<input type="button" class="boton-secundario" value="Informe de consecución&#13;&#10;trimestral/anual" onClick="document.location.href = 'resultado-excel2.php'">--></td>
        <td align="center"><button onclick="document.location.href = '/dpo/imprimir_dpo_consecucion_todos_sel.php'" class="boton-secundario">Imprimir todas las<br />consecuciones de DPO</button><!--<input type="button" class="boton-secundario" value="Imprimir todas las&#13;&#10;consecuciones de DPO" onClick="document.location.href = '/dpo/imprimir_dpo_consecucion_todos_sel.php'">--></td>
</tr>
 	    </table>
  </div>
</div>
<footer> </footer>
</body></html>